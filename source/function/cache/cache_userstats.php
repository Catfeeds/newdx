<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: cache_userstats.php 16696 2010-09-13 05:02:24Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_userstats() {
	$truetotalmembers = DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_member') . " " . getSlaveID());
	$newsetuser = DB::result_first("SELECT username FROM ".DB::table('common_member')." ORDER BY regdate DESC LIMIT 1 " . getSlaveID());

	//当前显示注册会员数
	$showtotalmembers = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='showtotalmembers' " . getSlaveID());

	//如遇意外，纠正数量
	if($showtotalmembers < $truetotalmembers) {
		$starttime = 1427299200;	//2015-03-26
		$dayadd = round((TIMESTAMP-$starttime)/86400)*5500;
		$showtotalmembers = 6527015+$dayadd;
		DB::query("REPLACE INTO ".DB::table('common_setting')." (`skey`, `svalue`) VALUES ('showtotalmembers', '$showtotalmembers')");
	}

	save_syscache('userstats', array('totalmembers' => $showtotalmembers, 'newsetuser' => $newsetuser));
}

?>
