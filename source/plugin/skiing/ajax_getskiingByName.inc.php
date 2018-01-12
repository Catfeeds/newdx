<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//用于滑雪场是否已经存在
$sub = $_GET['sub'];
//验证滑雪场是否已经存在
if($sub){	
	$sub =mb_convert_encoding($sub,'GBK', 'UTF-8');
	$sub =trim($sub);
	$sql = "select * from ".DB::table('dianping_skiing_info')." where subject='$sub'";
	$dm = DB::fetch_first($sql);
	if($dm){
		echo "repeat";exit;
	}else{
		echo "norepeat";exit;
	}	
}

