<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 用于清理新版的邀请信息，仅保留15天的邀请信息
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/*$time = strtotime(date('Y-m-d', strtotime('-15days')));
$counts = DB::result_first('SELECT COUNT(*) FROM '.DB::table('plugin_invite_message')." WHERE `dateline` < {$time}");
DB::delete('plugin_invite_message', "dateline < {$time}");
DB::delete('plugin_invite_readed', "dateline < {$time}");
DB::delete('plugin_invite_relation', "dateline < {$time}");
require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
$logs = new logs('cron_delete_invite');
$nowtime = date('Y-m-d H:i:s', $_G['timestamp']);
$logs->log_str("当前时间 {$nowtime} ,执行删除邀请功能，共删除 ".date('Y-m-d H:i:s' ,$time)."({$time})前的 {$counts} 条邀请信息");*/
?>