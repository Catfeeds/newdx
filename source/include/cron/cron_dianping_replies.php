<?php

/**
 *	整理点评系统回复数
 *	fid:滑雪场477,品牌408,装备490,线路494,山峰392,店铺471
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$dianping_table = array(
	392 => 'dianping_mountain_info',
	//408 => 'dianping_brand_info',
	//471 => 'dianping_shop_info',
	//477 => 'dianping_skiing_info',
	//490 => 'dianping_equipment_info',
	//494 => 'dianping_line_info'
);

foreach($dianping_table as $fid => $dpt){
	$query = DB::query("SELECT tid FROM ".DB::table('forum_thread')." WHERE fid='$fid'");
	while($row = DB::fetch($query)) {
		$thread[] = $row['tid'];
	}
	foreach($thread as $tid) {
		$query = DB::query("SELECT count FROM ".DB::table('dianping_star_statistics')." WHERE typeid='$tid'");
		while($row = DB::fetch($query)) {
			$cnum[] = $row['count'];
		}
		foreach($cnum as $v) {
			//$cnum = DB::result_first("SELECT count(*) FROM `pre_plugin_star_logs` where starid='$id'");
			DB::query("UPDATE ".DB::table($dpt)." SET cnum='$v' WHERE tid = '$tid'", 'UNBUFFERED');
		}
	}
}
?>