<?php
/**
 *	��Ʒ��Ӧ������ҳ
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];
if($tid <= 0) { showmessage('��������'); }

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
require_once libfile('dianping/comment', 'class');
$comment_obj = new comment();
$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
$recordnum = $comment_obj->recordnum;
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showview&tid={$tid}");

//��½״̬�ҵĵ���
if($_G['uid'])
{
	$mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);
	//���������ڹ���
	$comment['tid'] = $mycomment['tid'];
	$comment['pid'] = $mycomment['pid'];

	unset($commentlist[$mycomment['pid']]);
}

//AJAX���������б�����
if($_GET['ajaxreply'] == 1)
{
	@header('Content-Type: text/html; charset=gbk');
	include template('dianping/chain_comment');
	exit;
}

$_G['cache']['dp_country_region'] ? $countries = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');

//��ȡ��������
require_once libfile('dianping/detail', 'class');
$detail_obj =  new detail($tid);
$detail = $detail_obj->getdetail('chain', 'i.cid, cname, i.pcid, i.pcname, i.provinceid, i.cityid');

//���м����
$subnav = make_nav(array(
					array('url'=>"&order=lastpost&pcid={$detail['pcid']}&cid=0&provinceid=0&cityid=0&page=1",'title'=>$detail['pcname']),
					array('url'=>"&order=lastpost&pcid={$detail['pcid']}&cid={$detail['cid']}&provinceid=0&cityid=0&page=1",'title'=>$detail['cname'])
				));

if(empty($detail) || $detail['fid'] != $dp_modules['chain']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); }

//SEO��Ϣ����
$pageTitle = $detail['subject'].'��������'.($page>1 ? " - ��{$page}ҳ" : '')." -  {$_G['setting']['bbname']}";
$metakeywords = $detail['subject'].'��������';
$metadescription = $detail['subject'].'ʹ���ĵá����������⣬��Ʒ��񣬼۸���ϸ˵��';

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//ͼƬ�ֲ�
require_once libfile('dianping/attach','class');
$attach = new attach();
$piclist = $attach->get_img($tid,$detail['pid'],'plugin');

//���µ����
$detail_obj->updateviews();

//����
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist;
//ͬ����
$sidebar_list_same = $list_obj->getlist($mod, '', 'i.ispublish=1 and provinceid='.$detail['provinceid']);

//����
$sidebar_list_hot = $list_obj->getlist($mod, '', 'ispublish=1', 0, 10, 'cnum desc');

include template('dianping/chain_showview');
?>
