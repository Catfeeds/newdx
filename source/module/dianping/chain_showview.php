<?php
/**
 *	产品供应链详情页
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];
if($tid <= 0) { showmessage('参数错误'); }

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
require_once libfile('dianping/comment', 'class');
$comment_obj = new comment();
$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
$recordnum = $comment_obj->recordnum;
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showview&tid={$tid}");

//登陆状态我的点评
if($_G['uid'])
{
	$mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);
	//此两项用于管理处
	$comment['tid'] = $mycomment['tid'];
	$comment['pid'] = $mycomment['pid'];

	unset($commentlist[$mycomment['pid']]);
}

//AJAX返回评论列表数据
if($_GET['ajaxreply'] == 1)
{
	@header('Content-Type: text/html; charset=gbk');
	include template('dianping/chain_comment');
	exit;
}

$_G['cache']['dp_country_region'] ? $countries = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');

//获取内容详情
require_once libfile('dianping/detail', 'class');
$detail_obj =  new detail($tid);
$detail = $detail_obj->getdetail('chain', 'i.cid, cname, i.pcid, i.pcname, i.provinceid, i.cityid');

//面包屑导航
$subnav = make_nav(array(
					array('url'=>"&order=lastpost&pcid={$detail['pcid']}&cid=0&provinceid=0&cityid=0&page=1",'title'=>$detail['pcname']),
					array('url'=>"&order=lastpost&pcid={$detail['pcid']}&cid={$detail['cid']}&provinceid=0&cityid=0&page=1",'title'=>$detail['cname'])
				));

if(empty($detail) || $detail['fid'] != $dp_modules['chain']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('您要查看的内容不存在或未审核，请返回'); }

//SEO信息处理
$pageTitle = $detail['subject'].'测评点评'.($page>1 ? " - 第{$page}页" : '')." -  {$_G['setting']['bbname']}";
$metakeywords = $detail['subject'].'测评点评';
$metadescription = $detail['subject'].'使用心得、点评、评测，产品规格，价格，详细说明';

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//图片轮播
require_once libfile('dianping/attach','class');
$attach = new attach();
$piclist = $attach->get_img($tid,$detail['pid'],'plugin');

//更新点击量
$detail_obj->updateviews();

//边栏
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist;
//同地区
$sidebar_list_same = $list_obj->getlist($mod, '', 'i.ispublish=1 and provinceid='.$detail['provinceid']);

//热评
$sidebar_list_hot = $list_obj->getlist($mod, '', 'ispublish=1', 0, 10, 'cnum desc');

include template('dianping/chain_showview');
?>
