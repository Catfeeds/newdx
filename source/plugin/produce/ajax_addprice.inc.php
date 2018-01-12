<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';
if (!empty($_GET['tid']) && $_G['uid']) {
	$tid = $_GET['tid'];
	$uid = $_GET['uid'];

	$price=mb_convert_encoding($_POST['price'],'GBK','UTF-8');
	$addvalue=mb_convert_encoding($_POST['url'],'GBK','UTF-8');
	$comments=mb_convert_encoding($_POST['comment'],'GBK','UTF-8');

	$query = DB::query("select * from ".DB::table('plugin_produce_priceurl')." where isused = 1");
	while ($value = DB::fetch($query)){
		$key = $value['words'];
		$str = strpos($url,$key);
		if($str){
			echo "error";exit;
		}
	}
	$urls=substr($addvalue,0,4);
	if($urls=="http"&&strpos($addvalue,"://")&&strpos($addvalue,".")){
	   $addvalue=$addvalue;
	}elseif($urls!="http"&&!strpos($addvalue,"://")&&!empty($addvalue)&&strpos($addvalue,".")){
	   $addvalue="http://".$addvalue;
	}else{
	   $addvalue="";
	}

	$dateline=time();
	DB::query("INSERT INTO ".DB::table('plugin_produce_price')." (uid, tid, price,url,comment,dateline,isdelete) VALUES ({$uid}, {$tid}, '{$price}','$addvalue','$comments',$dateline,0)");
	//完善价格加分操作
	ForumOptionProduce::calPostRankEvent($tid,5);
	$thread=ForumOptionProduce::getTheardBytId($tid);
	ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],2);
	echo "success";
}
