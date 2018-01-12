<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';
$tid=$_GET['tid'];
$uid=$_GET['uid'];

if(!empty($tid)&&!empty($uid)){
	$oper = $_POST['oper'];
	$rank = $_POST['zbrank'];
	$user = DB::fetch_first("select * from ".DB::table('common_member')." where uid = $uid");
	if($oper=="+"){
		DB::query("update ".DB::table('plugin_produce_info')." set rank = rank+$rank WHERE tid ={$tid}");
		ForumOptionProduce::addOptionRecord($uid,$user['username'],$oper,$rank,$tid);
	}else if($oper=="-"){
		DB::query("update ".DB::table('plugin_produce_info')." set rank = rank-$rank WHERE tid ={$tid}");
		ForumOptionProduce::addOptionRecord($uid,$user['username'],$oper,$rank,$tid);
	}
	echo "success";
}else{
	echo "error";
}
