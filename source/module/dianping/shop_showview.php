<?php
/**
 *	潜水详情页
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];

if($tid <= 0) { showmessage('参数错误'); }

require_once libfile('dianping/comment', 'class');

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

$comment_obj = new comment();
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

require_once libfile('dianping/modlist_shop', 'class');
$list_obj = new modlist_shop;
require_once libfile('dianping/detail', 'class');
$detail_obj =  new detail($tid);
$detail = $detail_obj->getdetail('shop', 'i.showimg,i.dir,i.addr,i.lon,i.lat,i.marketid,i.sbrandid,i.cbrandid,i.tel,i.serverid,i.regionid,i.provinceid,i.dir');

if(empty($detail) || $detail['fid'] != $dp_modules['shop']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('您要查看的内容不存在或未审核，请返回'); }

//查询地区区号
if ($detail['regionid']){
	$region_where=" where catid = {$detail['regionid']}";
}elseif($detail['provinceid']){
	$region_where=" where catid = {$detail['provinceid']}";
}
$regions=DB::fetch_first("SELECT * from ".DB::table("dianping_shop_region").$region_where);

//面包屑导航
$subnav = make_nav();

if($page > 1) { $page_str = "-第{$page}页"; }
//SEO信息处理
$pageTitle = $metakeywords=$detail['subject']."在哪里,怎么样,好不好{$page_str} - {$_G['setting']['bbname']}";
$metadescription = "{$detail['subject']}地址,电话联系方式,{$detail['subject']}用户真实点评打分口碑,帮你全面了解{$detail['subject']}";

//图片轮播
require_once libfile('dianping/attach','class');
$attach = new attach();
$piclist = $attach->get_img($tid,$detail['pid'],'plugin');

//如果没有附件图片调用帖子showimg图片
if(empty($piclist)){
	$piclist[0]['attachment'] = $detail['showimg'];
	$piclist[0]['url'] = 'http://'.$attach->attachlist[$detail['serverid']]['name'].'/'.$detail['dir'].'/';
	$piclist[0]['aid'] = '';
	$piclist[0]['serverid'] = $detail['serverid'];
	$piclist[0]['dir'] = $detail['dir'];
}


//获取地区商场品牌数组
$_G['cache']['dp_shop_region'] ? $arr_region = $_G['cache']['dp_shop_region'] : updatecache('dp_shop_region');
//获取缓存中的品牌和商场
$brand_market=$list_obj->getBrandMarket('','',$arr_region);

//更新点击量
$detail_obj->updateviews();

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

//同城连锁店铺
if($detail['cbrandid']){
	$cbrands=DB::fetch_first("SELECT * from ".DB::table("dianping_shop_cbrand")." where id = {$detail['cbrandid']} ");
	$shop_cbrand = $list_obj->getlist('shop', "","i.ispublish=1 and i.provinceid={$detail['provinceid']} and cbrandid={$detail['cbrandid']} and i.tid not in($tid) ",0,4,'i.score DESC');
}
//附近的店铺
$longup = $detail['lon'] + 0.001;
$longdown = $detail['lon'] -0.01;
$latup = $detail['lat'] + 0.01;
$latdown = $detail['lat'] - 0.01;
$shop_near = $list_obj->getlist('shop', "","i.ispublish=1 and (i.lon BETWEEN '$longdown' and '$longup') and (i.lat between '$latdown' and '$latup') and i.tid not in($tid)",0,4,' i.tid DESC ');

//同城热门店铺
$shop_hot = $list_obj->getlist('shop', "","i.ispublish=1 and i.regionid={$detail['regionid']} and i.tid not in($tid)",0,4,'i.score DESC');

//同城最新店铺
$shop_new = $list_obj->getlist('shop', "","i.ispublish=1 and i.provinceid={$detail['provinceid']} and i.tid not in($tid)",0,4,'i.tid DESC');

include template('dianping/shop_showview');
?>
