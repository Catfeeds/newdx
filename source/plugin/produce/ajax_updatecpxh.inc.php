<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';

$type=$_GET['cpxh'];
$tid=$_GET['tid'];

if(!empty($type)&&!empty($tid)){
	if($type=='zr'){
		DB::query("UPDATE ".DB::table('plugin_produce_info')." SET cpxh = 1 WHERE tid = {$tid}");
		//真人秀加分操作
		ForumOptionProduce::calPostRankEvent($tid,1);
		$thread=ForumOptionProduce::getTheardBytId($tid);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],4);
	}else if($type=='yg'){
		DB::query("UPDATE ".DB::table('plugin_produce_info')." SET cpxh = 2 WHERE tid = {$tid}");
	}else if($type=='qx'){
		DB::query("UPDATE ".DB::table('plugin_produce_info')." SET cpxh = 0 WHERE tid = {$tid}");
		//取消真人秀减分操作
		ForumOptionProduce::calPostRankEvent($tid,2);
		$thread=ForumOptionProduce::getTheardBytId($tid);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],5);
	}else{
		echo "cuowu";
	}
	echo "success";
}else{
	echo "error";
}
