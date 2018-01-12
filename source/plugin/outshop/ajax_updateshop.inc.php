<?php
/**
 *   ajax更新标签和装备的关系
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$op = $_GET['op'];
$sid = $_GET['sid'];
$tid =$_GET['tid'];

if(!empty($op)&&$op=="shopname"){
	$shopname = $_GET['marketid'];
	DB::query("UPDATE ".DB::table('dianping_shop_info')." SET marketid = '$shopname' WHERE id = {$sid}");
	echo "success";
}else if(!empty($op)&&$op=="cbrand"){
	$cbrand = $_GET['cbrand'];
	DB::query("UPDATE ".DB::table('dianping_shop_info')." SET cbrandid = '$cbrand' WHERE id = {$sid}");
	echo "success";
}else if($tid){
	$lng = $_POST['lng'];
	$lat = $_POST['lat'];
	DB::query("UPDATE ".DB::table('dianping_shop_info')." SET lon = '$lng',latitude='$lat' WHERE tid = {$tid}");
	echo "success";
}else if(!empty($op)&&$op=="chainbrand"){
	$cbrand = trim($_GET['cbrand']);
	$cd = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_cbrand')." WHERE chainbrand = '$cbrand'");
	if($cd){
		echo "cunzai";
	}else{
		DB::query("UPDATE ".DB::table('dianping_shop_cbrand')." SET chainbrand = '$cbrand' WHERE id = {$sid}");
		echo "success";
	}
}else if(!empty($op)&&$op=="market"){
	$market = trim($_GET['market']);
	$mk = DB::fetch_first("SELECT * FROM ".DB::table('plugin_shop_market')." WHERE market = '$market'");
	if($mk){
		echo "cunzai";
	}else{
		DB::query("UPDATE ".DB::table('plugin_shop_market')." SET market = '$market' WHERE id = {$sid}");
		echo "success";
	}
}else if(!empty($op)&&$op=="brand"){
	$brand = trim($_GET['brand']);
	$bd = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_brand')." WHERE brand = '$brand'");
	if($bd){
		echo "cunzai";
	}else{
		DB::query("UPDATE ".DB::table('dianping_shop_brand')." SET brand = '$brand' WHERE id = {$sid}");
		echo "success";
	}
}else{
	echo "error";
}
