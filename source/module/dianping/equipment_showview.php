<?php
/**
 *	ɽ������ҳ
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
	include template('dianping/equipment_comment');
	exit;
}

//��ȡ��������
require_once libfile('dianping/detail', 'class');
$detail_obj =  new detail($tid);
$detail = $detail_obj->getdetail('equipment', 'i.cid, i.cname, i.pcid, i.pcname, i.price, i.relatedtid, i.brandid, i.brandname, i.brandtid, i.dgurl');

//���м����
$subnav = make_nav(array(
					array('url'=>"&order=lastpost&pcid={$detail['pcid']}&cid=0&bid=0&page=1",'title'=>$detail['pcname']),
					array('url'=>"&order=lastpost&pcid={$detail['pcid']}&cid={$detail['cid']}&bid=0&page=1",'title'=>$detail['cname'])
				));

if(empty($detail) || $detail['fid'] != $dp_modules['equipment']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); }

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

//�������·���
$hddata = gethddata('zhuangbei', $detail['pcid'], $detail['cid'], 7);

//����
//���Ѳ���
if($detail['relatedtid'])
{
	//��Ҫ�����ݽ��д��������ѯ����
	$tids_str = str_replace('��', ',', $detail['relatedtid']);
	$tids_array = explode(',', $tids_str);
	foreach ($tids_array as $k => $relate_tid){
		$tids_array[$k] = intval($relate_tid);
		if(!$tids_array[$k]){
			unset($tids_array[$k]);
		}
	}
	$tids = implode(',', $tids_array);
	if($tids)
	{
		$query = DB::query("SELECT tid, authorid, subject, views, replies FROM ".DB::table("forum_thread")." WHERE tid IN ($tids)".getSlaveID());
		while ($row = DB::fetch($query)) {
			$relatedthread[] = $row;
		}
	}
}

require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist;
//ͬ��װ��
$sidebar_cate = $list_obj->getlist($mod, '', 'i.ispublish=1 and cid='.$detail['cid']);
//ͬƷ��װ��
$sidebar_brand = $list_obj->getlist($mod, '', 'ispublish=1 and brandid='.$detail['brandid'].' and tid!='.$detail['tid']);
//����װ��
$sidebar_hot = $list_obj->getlist($mod, '', 'ispublish=1', 0, 10, 'cnum desc');
//Ʒ���б���
//ȡ���������������ݣ���������ɸѡ�б�
$condition_select_brand = 'i.cid=113 and i.ispublish=1  GROUP BY brandid';
$query = DB::query("SELECT brandid,brandname,brandtid,brandid FROM ".DB::table('dianping_equipment_info')." AS i WHERE $condition_select_brand ORDER BY id ASC ".getSlaveID());
while ($row = DB::fetch($query)) {
        $data[] = $row;
}
memory('set','dp_equipment_brand_select_view', $data, 3600);
$show_all_brand = memory('get','dp_equipment_brand_select_view');

//�������Ʒ���µ� ÿҳ��ʾ4��ץȡ��������߾�ͷ������
$tid_sub = intval(substr($tid,-3));
$count_id = 485;

$cacheid = $tid_sub >= $count_id ? 1 : $tid_sub + 1;
$hot_xiangji = memory('get', 'cache_rand_equiment_xiangji'.$cacheid);

if(!$hot_xiangji){
    $start_cache = ($cacheid - 1) *4;
    $query_rand = DB::query("SELECT tid,subject FROM ".DB::table('dianping_equipment_info')." AS i WHERE i.cull=1 and i.cid=113 and i.ispublish=1 order by tid desc LIMIT $start_cache,4 ".getSlaveID());
    while ($row_rand = DB::fetch($query_rand)) {
        $hot_xiangji[] = $row_rand;
    }

    memory('set', 'cache_rand_equiment_xiangji'.$cacheid, $hot_xiangji, 86400);
}
//�������Ʒ���µ� ÿҳ��ʾ4��ץȡ��������߾�ͷ������
include template('dianping/equipment_showview');
?>
