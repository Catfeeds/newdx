<?php
/**
 *	Ǳˮ����ҳ
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];

if($tid <= 0) { showmessage('��������'); }

require_once libfile('dianping/comment', 'class');

//��ȡ�����б�
//�����ҳ
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
//��½״̬�ҵĵ���
if($_G['uid'])
{
	$mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);
	//�ҵĵ��� Ϊ��ͳһģ�帳ֵ
	$comment['tid'] = $mycomment['tid'];
	$comment['pid'] = $mycomment['pid'];

	unset($commentlist[$mycomment['pid']]);
}

//AJAX���������б�����
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

if(empty($detail) || $detail['fid'] != $dp_modules['shop']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); }

//��ѯ��������
if ($detail['regionid']){
	$region_where=" where catid = {$detail['regionid']}";
}elseif($detail['provinceid']){
	$region_where=" where catid = {$detail['provinceid']}";
}
$regions=DB::fetch_first("SELECT * from ".DB::table("dianping_shop_region").$region_where);

//���м����
$subnav = make_nav();

if($page > 1) { $page_str = "-��{$page}ҳ"; }
//SEO��Ϣ����
$pageTitle = $metakeywords=$detail['subject']."������,��ô��,�ò���{$page_str} - {$_G['setting']['bbname']}";
$metadescription = "{$detail['subject']}��ַ,�绰��ϵ��ʽ,{$detail['subject']}�û���ʵ������ֿڱ�,����ȫ���˽�{$detail['subject']}";

//ͼƬ�ֲ�
require_once libfile('dianping/attach','class');
$attach = new attach();
$piclist = $attach->get_img($tid,$detail['pid'],'plugin');

//���û�и���ͼƬ��������showimgͼƬ
if(empty($piclist)){
	$piclist[0]['attachment'] = $detail['showimg'];
	$piclist[0]['url'] = 'http://'.$attach->attachlist[$detail['serverid']]['name'].'/'.$detail['dir'].'/';
	$piclist[0]['aid'] = '';
	$piclist[0]['serverid'] = $detail['serverid'];
	$piclist[0]['dir'] = $detail['dir'];
}


//��ȡ�����̳�Ʒ������
$_G['cache']['dp_shop_region'] ? $arr_region = $_G['cache']['dp_shop_region'] : updatecache('dp_shop_region');
//��ȡ�����е�Ʒ�ƺ��̳�
$brand_market=$list_obj->getBrandMarket('','',$arr_region);

//���µ����
$detail_obj->updateviews();

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

//ͬ����������
if($detail['cbrandid']){
	$cbrands=DB::fetch_first("SELECT * from ".DB::table("dianping_shop_cbrand")." where id = {$detail['cbrandid']} ");
	$shop_cbrand = $list_obj->getlist('shop', "","i.ispublish=1 and i.provinceid={$detail['provinceid']} and cbrandid={$detail['cbrandid']} and i.tid not in($tid) ",0,4,'i.score DESC');
}
//�����ĵ���
$longup = $detail['lon'] + 0.001;
$longdown = $detail['lon'] -0.01;
$latup = $detail['lat'] + 0.01;
$latdown = $detail['lat'] - 0.01;
$shop_near = $list_obj->getlist('shop', "","i.ispublish=1 and (i.lon BETWEEN '$longdown' and '$longup') and (i.lat between '$latdown' and '$latup') and i.tid not in($tid)",0,4,' i.tid DESC ');

//ͬ�����ŵ���
$shop_hot = $list_obj->getlist('shop', "","i.ispublish=1 and i.regionid={$detail['regionid']} and i.tid not in($tid)",0,4,'i.score DESC');

//ͬ�����µ���
$shop_new = $list_obj->getlist('shop', "","i.ispublish=1 and i.provinceid={$detail['provinceid']} and i.tid not in($tid)",0,4,'i.tid DESC');

include template('dianping/shop_showview');
?>
