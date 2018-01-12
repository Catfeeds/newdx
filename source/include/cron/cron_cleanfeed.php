<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: cron_cleanfeed.php 6757 2010-03-25 09:01:29Z cnteacher $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if($_G['setting']['feedday'] < 3) $_G['setting']['feedday'] = 3;
$deltime = $_G['timestamp'] - $_G['setting']['feedday']*86400;
$f_deltime = $_G['timestamp'] - 259200;	//3*3600*24
$s_deltime = $_G['timestamp'] - 2592000;	//30*3600*24	30天以前的记录全部删除 2014.10.29

DB::query("DELETE FROM ".DB::table('home_feed')." WHERE dateline < '$s_deltime' AND hot=0");
DB::query("DELETE FROM ".DB::table('home_feed')." WHERE dateline < '$s_deltime'");
DB::query("DELETE FROM ".DB::table('home_feed_app')." WHERE dateline < '$s_deltime'");
DB::query("OPTIMIZE TABLE ".DB::table('home_feed'), 'SILENT');
DB::query("OPTIMIZE TABLE ".DB::table('home_feed_app'), 'SILENT');


?>
