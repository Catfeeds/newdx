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
$cate_letter = $dp_category['brand']['letter'];
$cate_region = $dp_category['brand']['region'];
$cate_ranklist = $dp_category['brand']['ranklist'];

require_once libfile('dianping/detail_brand', 'class');
require_once libfile('dianping/comment_brand', 'class');
require_once libfile('dianping/modlist', 'class');


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
$comment_obj = new comment_brand();
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


$detail_obj =  new detail_brand($tid);
$detail = $detail_obj->getdetail('brand', 'i.id,i.url,i.showimg,i.dir,i.serverid,i.cname,i.ename,i.nation,i.company,i.addr,i.ranklist,i.city,i.tel,i.url');

if(empty($detail) || $detail['fid'] != $dp_modules['brand']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); }

//��ȡ�����
$detail =array_merge($detail,DB::fetch_first("SELECT views, replies FROM ".DB::table('forum_thread')." WHERE tid = {$tid}"));

$list_obj = new modlist;

//���µ����
$detail_obj->updateviews();

//��ȡ��ϲ���û�
$like_users = $comment_obj->likelist($tid);
//��ϲ���û�����
$likenum = $comment_obj->likenum($tid,'likeit');
//�������û�����
$wantnum = $comment_obj->likenum($tid,'wantuse');

//��ȡ����װ��
$brand_eq = $list_obj->getlist('equipment','','i.ispublish=1 AND i.displayorder >= 0 AND i.brandtid='.$tid,0,45,' dateline DESC','',1);

//����װ������
$brand_eq_count = count($brand_eq);

//����װ����ʾ��ҳ
$block_num = ceil($brand_eq_count / 3);

//��ȡ����������Ϣ
$cacheindex = $detail_obj->get_cache_index($tid,'brand');
//���Ʒ���������
$brand_articles = $detail_obj->get_info_by_index("articles",$cacheindex);
//���Ʒ�ƿռ�
$brand_blogs = $detail_obj->get_info_by_index("blogs",$cacheindex);
//���Ʒ���������
$brand_bbs = $detail_obj->get_info_by_index("zb",$cacheindex);
//���Ʒ�����ר��
$brand_topics = $detail_obj->get_info_by_index("topics",$cacheindex);
//
$brand_photos = $detail_obj->get_info_by_index("photos",$cacheindex);
//SEO��Ϣ����
if($page > 1) { $page_str = "-��{$page}ҳ"; }
$pageTitle = "{$detail['subject']}������ƷƷ��ר��,{$detail['subject']}�����콢��,{$detail['subject']}��ô���ò��ÿڱ�����{$page_str} - {$_G['setting']['bbname']}";
$metakeywords = " {$detail['subject']}������Ʒ�ƴ�ȫ";
$metadescription = "{$detail['subject']}Ʒ�ƽ��ܣ���ϵ�绰��ַ��{$detail['subject']}�û��ڱ������ȴ�֣�����ȫ���˽�{$detail['subject']}";
$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//Ʒ������
$brand_rank = memory('get', 'dp_brand_ranklist_tid_' . $tid);
if (!$brand_rank || ($_G['adminid']==1 && $_GET['nocache']==1)) {
	$brand_rank=$detail_obj->getBrandRanking($cate_ranklist,$detail['ranklist'],$tid);
	memory('set', 'dp_brand_ranklist_tid_'.$tid, $brand_rank, 3600);
}

//��ȡͬ���а��Ʒ�ƣ����Ʒ�����ڶ�����а�ȡ���һ��ֵ��ͬ��Ʒ��
$cptop = explode(',',$detail['ranklist']);
$where = " FIND_IN_SET('{$cptop['0']}',ranklist)";
$rank_brand=$list_obj->getlist('brand', '',$where,0,10,'i.displayorder DESC,i.cnum DESC');

include template('dianping/brand_showview');
?>
