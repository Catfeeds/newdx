<?php
/**
 * 邀请页面
 * @author lxp 20140425
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

// 邀请列表
$invite_thread = memory('get' , 'plugin_invite_cache_uid_'.$_G['uid']);
if(!$invite_thread){
	$invite_thread = array();
	$query = DB::query('SELECT im.* FROM '.DB::table('plugin_invite_relation').' ir
			LEFT JOIN '.DB::table('plugin_invite_message').' im ON ir.mid = im.mid
			WHERE ir.status = 1 AND ir.tousers LIKE \'%('.$_G['uid'].')%\' ORDER BY ir.dateline DESC');
	while($v = DB::fetch($query)){
		$reads_mid = memory('get' , 'plugin_invite_cache_mid_reads_'.$v['mid']);
		if(!$reads_mid){
			$midread = DB::result_first("SELECT readuid FROM ".DB::table('plugin_invite_readed')." WHERE mid = {$v[mid]}");
			$reads_mid = explode(',' ,$midread);
			memory('set' , 'plugin_invite_cache_mid_reads_'.$v['mid'] , $reads_mid , 3600);
		}
		if(in_array($_G['uid'] , $reads_mid)) continue;
		$invite_thread['invite_'.$v['mid']] = $v;
	}
	memory('set' , 'plugin_invite_cache_uid_'.$_G['uid'] , $invite_thread , 60);
	require_once libfile('class/myredis');
	$redis = & myredis::instance(6378);
	$redis->ZADD("common_member_invite_users_list", count($invite_thread), 'uid_' . $_G['uid']);
}
$invite_thread_count = count($invite_thread);
// 短消息数量
// loaducenter();
// $newpm = uc_pm_list($_G['uid']);
// 任务数量
/*$sql = "SELECT COUNT(*) AS count FROM ".DB::table('common_task')." t
		LEFT JOIN ".DB::table('common_mytask')." mt ON mt.taskid=t.taskid AND mt.uid='$_G[uid]'
		WHERE (mt.taskid IS NULL OR (ABS(mt.status)='1' AND t.period>0)) AND t.available='2' ORDER BY t.displayorder, t.taskid DESC";
$taskcount = DB::result_first($sql);*/
require_once libfile('class/task');
$tasklib = & task::instance();
$tasklist = $tasklib->tasklist('new');
$taskcount = count($tasklist);

member_status_view_update($taskcount);

include_once template("home/space_invite");

?>