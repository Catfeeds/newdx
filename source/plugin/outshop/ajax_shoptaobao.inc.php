<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/shop.php';

$nc = trim($_GET['nc']);
$uid = $_GET['uid'];
$username = $_GET['username'];
$time = time();
if($nc&&$uid&&$username){
	$nic = ForumOptionShop::checkNickByNick($nc);
	if($nic){
		echo "repeat";exit;
	}
	$tb = ForumOptionShop::getShopInfo($nc);
	if($tb&&$tb['code']){
		echo $tb['sub_msg'];
	}else{
		DB::query("insert into ".DB::table('plugin_shop_taobao')." (id,nick,uid,username,dateline,isshow) values (null,'$nc','$uid','$username','$time',0)");
		echo "success";
	}
}
