<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: topicadmin_banpost.php 16938 2010-09-17 04:37:59Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['group']['allowbanpost']) {
	showmessage('undefined_action', NULL);
}

$topiclist = $_G['gp_topiclist'];
$modpostsnum = count($topiclist);
if(!($banpids = dimplode($topiclist))) {
	showmessage('admin_banpost_invalid');
} elseif(!$_G['group']['allowbanpost'] || !$_G['tid']) {
	showmessage('admin_nopermission', NULL);
}

$posts = array();
$banstatus = 0;
$posttable = getposttablebytid($_G['tid']);
$query = DB::query("SELECT pid, first, authorid, status, dateline, message FROM ".DB::table($posttable)." WHERE pid IN ($banpids) AND tid='$_G[tid]'");
while($post = DB::fetch($query)) {
	$banstatus = ($post['status'] & 1) || $banstatus;
	$posts[] = $post;
}

if(!submitcheck('modsubmit')) {

	$banid = $checkunban = $checkban = '';
	foreach($topiclist as $id) {
		$banid .= '<input type="hidden" name="topiclist[]" value="'.$id.'" />';
	}

	$banstatus ? $checkunban = 'checked="checked"' : $checkban = 'checked="checked"';

	include template('forum/topicadmin_action');

} else {

	$banned = intval($_G['gp_banned']);
	$modaction = $banned ? 'BNP' : 'UBN';

	$reason = checkreasonpm();

	$pids = $comma = '';
	foreach($posts as $k => $post) {
		if($banned) {
			my_post_log('ban', array('pid' => $post['pid'], 'uid' => $post['authorid']));
			DB::query("UPDATE ".DB::table($posttable)." SET status=status|1 WHERE pid='$post[pid]'", 'UNBUFFERED');
			//2012-07-06 ��������������ʱ����Ӧ���ܻ���������β���
			if(DB::result_first("SELECT count(*) FROM ".DB::table('plugin_cache_brand_index')." WHERE pid='$post[pid]' " . getSlaveID())>0){
			    DB::query("UPDATE ".DB::table('plugin_cache_brand_index')." SET displayorder=-1 WHERE pid='$post[pid]'");
			}
			//����Ϊ2012-07-06����
		} else {
			my_post_log('unban', array('pid' => $post['pid'], 'uid' => $post['authorid']));
			DB::query("UPDATE ".DB::table($posttable)." SET status=status^1 WHERE pid='$post[pid]' AND status=status|1", 'UNBUFFERED');
			//2012-07-06 �����������������ʱ����Ӧ���ܻ�����н�����β���
			if(DB::result_first("SELECT count(*) FROM ".DB::table('plugin_cache_brand_index')." WHERE pid='$post[pid]' " . getSlaveID())>0){
			    DB::query("UPDATE ".DB::table('plugin_cache_brand_index')." SET displayorder=0 WHERE pid='$post[pid]'");
			}
			//����Ϊ2012-07-06����
		}
		$pids .= $comma.$post['pid'];
		$comma = ',';		
		//���redis����
		require_once libfile('class/postredis');
		$rd = & postredis::instance();
		$posts = DB::fetch_first("select * from ".DB::table($posttable)." WHERE pid='$post[pid]' limit 1");
		$a = $rd->HMSET('pid:'.$posts['pid'],$posts);
		//end
	}

	$resultarray = array(
	'redirect'	=> "forum.php?mod=viewthread&tid=$_G[tid]&page=$page",
	'reasonpm'	=> ($sendreasonpm ? array('data' => $posts, 'var' => 'post', 'item' => 'reason_ban_post') : array()),
	'reasonvar'	=> array('tid' => $thread['tid'], 'subject' => $thread['subject'], 'modaction' => $modaction, 'reason' => stripslashes($reason)),
	'modtids'	=> 0,
	'modlog'	=> $thread
	);

	procreportlog('', $pids);

}

?>