<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$type = trim($_GET['type']);
$tid = trim($_GET['tid']);
$ord = trim($_GET['order']);
$mod = trim($_GET['mod']);
$tables = array('skiing' => 'dianping_skiing_info', 'equipment' => 'dianping_equipment_info');

if($type&&$tid){	
	if($_G['groupid']==1||$_G['groupid']==45){
		if($type=='px'){
			DB::query("UPDATE ".DB::table($tables[$mod])." SET orderby = $ord WHERE tid = {$tid}");	
		}else if($type=='pl'){
			DB::query("UPDATE ".DB::table('dianping_star_logs')." SET showorder = $ord WHERE pid = {$tid}");
		}
		echo "success";
	}else{
		echo "error";
	}		
}else{
	echo "errors";
}
