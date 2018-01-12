<?php
/**
 *	山峰详情页
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];

if($tid <= 0) { showmessage('参数错误'); }
$cate_letter = $dp_category['brand']['letter'];
$cate_region = $dp_category['brand']['region'];
$cate_ranklist = $dp_category['brand']['ranklist'];

require_once libfile('dianping/detail_brand', 'class');
require_once libfile('dianping/comment_brand', 'class');
require_once libfile('dianping/modlist', 'class');


//获取点评列表
//处理分页
$page = max(1, $_G['gp_page']);
$perpage = 10;
$start = ($page - 1) * $perpage;
$where = " ";
if($_G['gp_starnum']){
	$where.=' and starnum='.$_G['gp_starnum'].' ';
	$starnum=$_G['gp_starnum'];
}
$comment_obj = new comment_brand();
$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
$recordnum = $comment_obj->recordnum;
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showview&tid={$tid}");
//登陆状态我的点评
if($_G['uid'])
{
	$mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);

	//我的点评 为了统一模板赋值
	$comment['tid'] = $mycomment['tid'];
	$comment['pid'] = $mycomment['pid'];

	unset($commentlist[$mycomment['pid']]);
}

//AJAX返回评论列表数据
if($_GET['ajaxreply'] == 1)
{
	@header('Content-Type: text/html; charset=gbk');
	include template('dianping/skiing_comment');
	exit;
}


$detail_obj =  new detail_brand($tid);
$detail = $detail_obj->getdetail('brand', 'i.id,i.url,i.showimg,i.dir,i.serverid,i.cname,i.ename,i.nation,i.company,i.addr,i.ranklist,i.city,i.tel,i.url');

if(empty($detail) || $detail['fid'] != $dp_modules['brand']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('您要查看的内容不存在或未审核，请返回'); }

//获取点击量
$detail =array_merge($detail,DB::fetch_first("SELECT views, replies FROM ".DB::table('forum_thread')." WHERE tid = {$tid}"));

$list_obj = new modlist;

//更新点击量
$detail_obj->updateviews();

//获取我喜欢用户
$like_users = $comment_obj->likelist($tid);
//我喜欢用户数量
$likenum = $comment_obj->likenum($tid,'likeit');
//我想用用户数量
$wantnum = $comment_obj->likenum($tid,'wantuse');

//获取分享装备
$brand_eq = $list_obj->getlist('equipment','','i.ispublish=1 AND i.displayorder >= 0 AND i.brandtid='.$tid,0,45,' dateline DESC','',1);

//分享装备数量
$brand_eq_count = count($brand_eq);

//分享装备显示分页
$block_num = ceil($brand_eq_count / 3);

//读取缓存索引信息
$cacheindex = $detail_obj->get_cache_index($tid,'brand');
//左侧品牌相关新闻
$brand_articles = $detail_obj->get_info_by_index("articles",$cacheindex);
//左侧品牌空间
$brand_blogs = $detail_obj->get_info_by_index("blogs",$cacheindex);
//左侧品牌相关讨论
$brand_bbs = $detail_obj->get_info_by_index("zb",$cacheindex);
//左侧品牌相关专题
$brand_topics = $detail_obj->get_info_by_index("topics",$cacheindex);
//
$brand_photos = $detail_obj->get_info_by_index("photos",$cacheindex);
//SEO信息处理
if($page > 1) { $page_str = "-第{$page}页"; }
$pageTitle = "{$detail['subject']}户外用品品牌专题,{$detail['subject']}官网旗舰店,{$detail['subject']}怎么样好不好口碑点评{$page_str} - {$_G['setting']['bbname']}";
$metakeywords = " {$detail['subject']}，户外品牌大全";
$metadescription = "{$detail['subject']}品牌介绍，联系电话地址，{$detail['subject']}用户口碑好评度打分，帮你全面了解{$detail['subject']}";
$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//品牌排行
$brand_rank = memory('get', 'dp_brand_ranklist_tid_' . $tid);
if (!$brand_rank || ($_G['adminid']==1 && $_GET['nocache']==1)) {
	$brand_rank=$detail_obj->getBrandRanking($cate_ranklist,$detail['ranklist'],$tid);
	memory('set', 'dp_brand_ranklist_tid_'.$tid, $brand_rank, 3600);
}

//获取同排行榜的品牌，如果品牌属于多个排行榜取与第一个值相同的品牌
$cptop = explode(',',$detail['ranklist']);
$where = " FIND_IN_SET('{$cptop['0']}',ranklist)";
$rank_brand=$list_obj->getlist('brand', '',$where,0,10,'i.displayorder DESC,i.cnum DESC');

include template('dianping/brand_showview');
?>
