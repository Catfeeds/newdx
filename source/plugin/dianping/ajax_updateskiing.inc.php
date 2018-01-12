<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$type = trim($_GET['type']);
$tid = trim($_GET['tid']);
$ord = trim($_GET['order']);

if($type&&$tid){
	if($_G['groupid']==1){
		if($type=='px'){
			DB::query("UPDATE ".DB::table('dianping_skiing_info')." SET displayorder = $ord WHERE tid = {$tid}");
		}else if($type=='pl'){
			DB::query("UPDATE ".DB::table('dianping_star_logs')." SET showorder = $ord WHERE pid = {$tid}");
		}
		echo "success";
	}else{
		echo "error";
	}		
}else{
	echo "error";
}
