<?php
/**
 *	��������ҳ
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];
$pid = $_G['gp_pid'];
$uid = $_G['gp_uid'];

if($tid <= 0) { showmessage('��������'); }
$cate_type = $dp_category['club']['type'];
require_once libfile('dianping/detail_brand', 'class');
require_once libfile('dianping/comment_brand', 'class');
require_once libfile('dianping/modlist', 'class');
require_once libfile('dianping/comment', 'class');
$comment_obj = new comment();
$commentlist = $comment_obj->getdetail($pid,$tid,$uid,0);
if(empty($commentlist) || $commentlist['uid'] != $uid || $commentlist['pid'] != $pid || $commentlist['tid'] != $tid) { 
    showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); 
}
//��ȡ�ϼ��������¼�������
$max = $comment_obj->get_max($tid);
$min = $comment_obj->get_min($tid);
$comm_next = "";
$comm_pre = "";
if($min < $pid && $pid <$max){
    $comm_next = $comment_obj->getpre_next($pid, '>', $tid,'asc', 2);
    $comm_pre = $comment_obj->getpre_next($pid, '<',$tid,'desc', 2);
    if(count($comm_next)==1){
        $comm_pre = $comment_obj->getpre_next($pid, '<',$tid,'desc', 3);
    }else{
        $comm_pre = $comment_obj->getpre_next($pid, '<',$tid,'desc', 2);
    }
    if(count($comm_pre)==1){
        $comm_next = $comment_obj->getpre_next($pid, '>', $tid,'asc', 3);
    }else{
        $comm_next = $comment_obj->getpre_next($pid, '>', $tid,'asc', 2);
    }
}else if($pid == $min){
    $comm_next = $comment_obj->getpre_next($pid, '>', $tid,'asc', 4);
}else if($pid == $max){
    $comm_pre = $comment_obj->getpre_next($pid, '<',$tid,'desc', 4);
}
$detail_obj =  new detail_brand($tid);
$detail = $detail_obj->getdetail('club', 'i.chenglishijian,i.lingduinum,i.gongsitype,i.lon, i.lat, i.addr,i.tel,i.provinceid,i.placetype,i.type,i.cityid,i.dir,i.serverid');
$pageTitle= "{$detail['subject']}-{$commentlist['author']}�ĵ���/����/����-{$_G['setting']['bbname']}";
$list_obj = new modlist;
$modlistall = $list_obj->getlist('club', 'chenglishijian,lingduinum,gongsitype,type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);

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
//$recordnum = $comment_obj->recordnum;
//$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showview&tid={$tid}");
$allcount = 0;
//��dianping_star_logs
$sql   = "select f_p.pid, f_p.fid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message, f_p.rate from " . DB::table('dianping_star_logs');
$sql  .= " s_l left join " . DB::table('forum_post');
$sql  .= " f_p on s_l.pid=f_p.pid where s_l.uid={$uid}";
$sql  .= " order by s_l.dateline desc ";
$sql  .= " limit 200 " . getSlaveID();
$query = DB::query($sql);
while ($v = DB::fetch($query)) {
	
    $allcount++;
}
if ($detail_obj->attach) {
    $piclist = $detail_obj->attach->get_img($tid, $detail['pid'], 'plugin');
} else {
    require_once libfile('dianping/attach','class');
    $attach = new attach();
    $piclist = $attach->get_img($tid, $detail['pid'], 'plugin');
}
include template('dianping/club_commentdetail');
?>