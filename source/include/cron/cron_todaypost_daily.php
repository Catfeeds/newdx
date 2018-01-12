<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: cron_todaypost_daily.php 12220 2010-07-01 06:10:53Z wangjinbo $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

date_default_timezone_set('PRC');
$yesterdayposts = intval(DB::result_first("SELECT sum(todayposts) FROM ".DB::table('forum_forum').""));

$historypost = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='historyposts'");

$hpostarray = explode("\t", $historypost);
$_G['setting']['historyposts'] = $hpostarray[1] < $yesterdayposts ? "$yesterdayposts\t$yesterdayposts" : "$yesterdayposts\t$hpostarray[1]";

DB::query("REPLACE INTO ".DB::table('common_setting')." (skey, svalue) VALUES ('historyposts', '".$_G['setting']['historyposts']."')");
$date = date('Y-m-d', TIMESTAMP - 86400);

// $now = time();
// $detaildate = date('Y-m-d', $now - 86400);

DB::query("REPLACE INTO ".DB::table('forum_statlog')."(logdate, fid, `type`, `value`)
	SELECT '$date', fid, '1', todayposts FROM ".DB::table('forum_forum')." WHERE `type`<>'group' AND `status`<>'3'");

DB::query("REPLACE INTO ".DB::table('plugin_statlog_detail')."(logdate, typeid, `type`, `value`)
	SELECT '$date', typeid, '1', todayposts FROM ".DB::table('forum_threadclass'));

DB::query("UPDATE ".DB::table('forum_forum')." SET todayposts='0'");

DB::query("UPDATE ".DB::table('forum_threadclass')." SET todayposts='0'");

save_syscache('historyposts', $_G['setting']['historyposts']);

// $memcache = new Memcache;
// $servers = explode('|', $_G['config']['memory']['memcache']['server']);
// $server_count = count($servers);
// for($i=0; $i<$server_count; $i++)
// {
// 	$connect_server = $servers[$i];
// 	$memcache->connect($connect_server, $_G['config']['memory']['memcache']['port']);
// 	$memcache->set('cEogns_historyposts', array($_G['setting']['historyposts']));
// 	$memcache->close();
// }

//RUN LOG
$logs_msg = '['.$_SERVER["SERVER_ADDR"].'] 运行时间:'.date('Y-m-d H:i:s', TIMESTAMP).', ['.TIMESTAMP.'], 执行用户:'.($_G['username'] ? $_G['username'] : 'system');
require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
$logs = new logs('cron_todaypost_daily');
$logs->log_str($logs_msg);
?>
