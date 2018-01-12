<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$type = trim($_GET['type']);
$tid = trim($_GET['tid']);

if($type&&$tid){
	if($type=='cancel'){
		DB::query("UPDATE ".DB::table('dianping_shop_info')." SET ispublish = 0 WHERE tid = {$tid}");
	}else if($type=='pass'){
		DB::query("UPDATE ".DB::table('dianping_shop_info')." SET ispublish = 1 WHERE tid = {$tid}");
	}
	echo "success";
}else{
	echo "error";
}


