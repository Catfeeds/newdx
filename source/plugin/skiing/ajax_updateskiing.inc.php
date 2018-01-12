<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$type = trim($_GET['type']);
$tid = trim($_GET['tid']);
$ord = trim($_GET['order']);

if($type&&$tid){
	if($type=='cancel'){
		DB::query("UPDATE ".DB::table('dianping_skiing_info')." SET ispublish = 0 WHERE tid = {$tid}");
	}else if($type=='pass'){
		DB::query("UPDATE ".DB::table('dianping_skiing_info')." SET ispublish = 1 WHERE tid = {$tid}");
	}else if($type=='px'){
		DB::query("UPDATE ".DB::table('dianping_skiing_info')." SET displayorder = $ord WHERE tid = {$tid}");
	}
	echo "success";
}else{
	echo "error";
}


