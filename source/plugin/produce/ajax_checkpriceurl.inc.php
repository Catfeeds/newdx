<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';


$url = mb_convert_encoding($_GET['url'],'GBK','UTF-8');

if($url){
	$query = DB::query("select * from ".DB::table('plugin_produce_priceurl')." where isused = 1");
	while ($value = DB::fetch($query)){
		$key = $value['words'];
		$str = strpos($url,$key);
		if($str){
			echo "used";exit;
		}
	}
	echo "pass";exit;
}


