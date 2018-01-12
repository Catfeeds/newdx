<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: cron_cleannotification.php 6757 2010-03-25 09:01:29Z cnteacher $
 *由于消息定期清理, 新的需求中加入了用户'新消息'数量的记录, 如果删除了新的消息则对应数量的用户'新消息'数量需要更新
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$deltime = $_G['timestamp'] - 172800;// 2 days
DB::query('DELETE FROM '.DB::table('home_notification')." WHERE dateline < '$deltime' AND new='0' AND `type` <> 'zw'");
$deltime = $_G['timestamp'] - 259200;//3 days
DB::query('DELETE FROM '.DB::table('home_poke')." WHERE dateline < '$deltime' AND new='0'");

$deltime = $_G['timestamp'] - 7776000;//90 days
/*$newNotification = DB::result_first('SELECT COUNT(*) FROM ' . DB::table('home_notification') . " WHERE dateline < {$deltime} AND new=1 " . getSlaveID());*/
DB::query('DELETE FROM '.DB::table('home_notification')." WHERE dateline < '$deltime' AND new='1'");

$deltime = $_G['timestamp'] - 604800;//7 days
DB::query('DELETE FROM '.DB::table('home_pokearchive')." WHERE dateline < '$deltime'");

$deltime = $_G['timestamp'] - 2592000;//30 days
/*$newPoke = DB::result_first('SELECT COUNT(*) FROM ' . DB::table('home_poke') . " WHERE dateline < {$deltime} AND new=1 " . getSlaveID());
DB::query('DELETE FROM '.DB::table('home_poke')." WHERE dateline < '$deltime' AND new='1'");*/
DB::query('OPTIMIZE TABLE '.DB::table('home_notification'), 'SILENT');

/*require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
$logs = new logs('cron_journal_log');
$nowtime = date('Y-m-d H:i:s', $_G['timestamp']);
$logs->log_str(strtr('execute cron_cleannotification.php time: %time, newNotification: %newNotification, newPoke: %newPoke', array(
	'%time' => $nowtime . "[{$_G['timestamp']}]",
	'%newNotification' => $newNotification,
	'%newPoke' => $newPoke
)));*/
?>
