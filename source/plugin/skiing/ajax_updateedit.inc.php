<?php
/**
 *   ajax更新标签和装备的关系
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


$tid =$_GET['tid'];
if($tid){
	$lng = $_POST['lng'];
	$lat = $_POST['lat'];	
	DB::query("UPDATE ".DB::table('dianping_skiing_info')." SET lon = '$lng',lat='$lat' WHERE tid = {$tid}");
	echo "success";
}else{
	echo "error";
}