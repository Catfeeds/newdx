<?php
/**
 *    ɽ������ҳ
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];
if ($tid <= 0) {
    showmessage('��������');
}

//��������ҳ��ajax��ҳ����
$page = max(1, $_G['gp_page']);
$perpage = 10;
$start = ($page - 1) * $perpage;
$where="";
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
if ($_G['uid']) {
    $mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);
    //�ҵĵ��� Ϊ��ͳһģ�帳ֵ
    $comment['tid'] = $mycomment['tid'];
    $comment['pid'] = $mycomment['pid'];
    unset($commentlist[$mycomment['pid']]);
}
//AJAX���������б�����
if ($_GET['ajaxreply'] == 1) {
    @header('Content-Type: text/html; charset=gbk');
    include template('dianping/club_comment');
    exit;
}

//��������
$cate_type = $dp_category['club']['type'];
$cate_placetype = $dp_category['club']['placetype'];
//��ϸҳ��Ϣ��ȡ
require_once libfile('dianping/detail', 'class');
$detail_obj = new detail($tid);
$detail = $detail_obj->getdetail('club', 'i.author_id,i.ispublish,i.uids,i.contact,i.weixin,i.qq,i.lon, i.lat, i.addr,i.tel,i.provinceid,i.placetype,i.type,i.cityid,i.serverid');
if($detail['ispublish']==0 && $detail['author_id']!=$_G['uid'] && $_G['adminid']!=1){
    showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); 
}
//if(empty($detail) || $detail['fid'] != $dp_modules['club']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); }

//title, description, keywords
$pageTitle= $detail['subject']."���ֲ���ַ|�绰|��ô��-������ֲ����� - ����������8264.com";
if($page>1){
    $pageTitle = strtr($pageTitle,'[page]',' ��'.$page.'ҳ -');
}else{
    $pageTitle = str_replace('[page]','',$pageTitle);
}
$metadescription = $detail['subject'].'���ֲ���ϸ���ܰ�����ַ����ϵ��ʽ������ˮƽ�Լ���ʵ�û��������ܣ�Ϊ¿�ѳ����ṩȨ�����׵���Ϣ�ο�';
$metakeywords= $detail['subject'];

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//���µ����
$detail_obj->updateviews();

//�����б�ͬ�����б�
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist;
$_G['cache']['dp_club_list_hot'] ? $sidebar_list_hot = $_G['cache']['dp_club_list_hot'] : updatecache('dp_club_list_hot');

if ($detail['provinceid']) {
    $sidebar_list_same = $list_obj->getlist($mod, '', 'ispublish=1 and provinceid=' . $detail['provinceid'], 0, 4, 'id asc');
}

$modlistall = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum', 'ispublish>=0', $start, '', $orderby, '', 0);
/*start----Ϊʡ�У����ǹ��������У���ȡ����ʡ�н��й���,info����ڲŽ�����ʾ����***************************/
$allcodeList = array();
foreach ($modlistall as $key => $val) {
    $allcodeList[$val['provinceid']] = 1;
    $allcodeList[$val['cityid']] = 1;
}
$_G['cache']['dp_country_region'] ? $countries = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');
foreach ($countries as $rk => $rv) {
    if (!$allcodeList[$rk]) {
        unset($countries[$rk]);
        continue;
    }
    if (!$rv['shengid']) {
        $proList[$rk] = $rv;
    }
}

//��÷���name
if($detail['type']){
	$type_array=explode(',', $detail['type']);
	$typename='';
	foreach ($type_array as $value){
		$typename.="<a href=\"http://www.8264.com/dianping.php?mod={$mod}&act=showlist&order=lastpost&type={$value}&placetype=0&provinceid=0&cityid=0&page=1\" target=\"_brank\">{$cate_type[$value]}</a> ";
	}
}
/*���п�ʼ����������ҳͷͼlogoͼ����ϸ������ͼƬ�Ļ�ȡ**********************/
if ($detail_obj->attach) {
    $piclist = $detail_obj->attach->get_img($tid, $detail['pid'], 'plugin');
} else {
    require_once libfile('dianping/attach','class');
    $attach = new attach();
    $piclist = $attach->get_img($tid, $detail['pid'], 'plugin');
}
/*���н�������������ҳͷͼlogoͼ����ϸ������ͼƬ�Ļ�ȡ**********************/
//��ȡ��Ӧ�û����Ļ�б�
//$filemtime = memory('get', 'sendmail_lock');
//if(){
//    
//}
$list = array();
if($detail['uids']){
    $uids = explode(",",$detail['uids']);
    foreach($uids as $k=>$v){
        $sql_name = DB::result_first("SELECT uid FROM ".DB::table('common_member')." where username = '{$v}'".getSlaveID());
        if($sql_name){
            $name_arr[] = $sql_name;
        }
    }
    $name = implode(",",$name_arr);
    if($name){
        $sql   = "select a.*, t.subject, t.dateline from ";
        $sql  .= DB::table('forum_activity')." a ";
        $sql  .= " inner join ".DB::table('forum_thread')." t ON t.tid=a.tid";
        $sql  .= " WHERE t.displayorder>'-1' and a.uid in ({$name}) and t.special=4 ";
        $sql  .= " order by t.dateline desc limit 5" . getSlaveID();
        $query = DB::query($sql);
        while ($v = DB::fetch($query)) {
            $list[] = $v;
            $tids[$v['tid']] = $v['tid'];
            $aids[$v['aid']] = $v['aid'];	
        }
        //��ûͼƬ����Ϣ
        if ($aids) {
                $aids  = implode(',', $aids);
                $sql   = "select a.aid, a.attachment, a.serverid, a.dir from ".DB::table('forum_attachment')." a where a.aid in ({$aids})";
                $query = DB::query($sql);
                while ($v = DB::fetch($query)) {				
                        if ($v['serverid'] > 50) {
                                $attachList[$v['aid']] = getimagethumb(60 ,60 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
                        } else {
                                $attachList[$v['aid']] = getimagethumb(60 ,60 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
                        }				
                }
        }
        //memory('set', $m_key, $list,  1296000);
        
    }
    
}
include template('dianping/club_showview');
?>
