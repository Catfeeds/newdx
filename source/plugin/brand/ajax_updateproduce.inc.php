<?php
/**
 *   ajax更新标签和装备的关系
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$op = $_GET['op'];



if($op=="update"){
	$sid = $_GET['sid'];
	$produce = $_GET['produce'];
	DB::query("UPDATE ".DB::table('plugin_brand_produce')." SET produce = '$produce' WHERE id = {$sid}");
	echo "success";
}elseif($op=="edit"){
	$chk_tid = $_GET['chk_detail'];
	$tid = $_GET['tidd'];
	if($chk_tid){
		$ids=implode(",",$chk_tid);
		DB::query("UPDATE ".DB::table('dianping_brand_info')." SET ranklist = '$ids' WHERE tid = {$tid}");
		echo "success";exit;
	}else{
		DB::query("UPDATE ".DB::table('dianping_brand_info')." SET ranklist = '' WHERE tid = {$tid}");
		echo "success";exit;
	}
}elseif($op=="getids"){
	$tid =  $_GET['tid'];
	$info = DB::fetch_first("SELECT ranklist FROM ".DB::table('dianping_brand_info')." WHERE tid = '{$tid}'");
	if($info){
		$qq = DB::query("SELECT id FROM ".DB::table('plugin_brand_produce')." WHERE  id in ({$info[ranklist]})");
		while ($value = DB::fetch($qq)) {
			$arr[] = $value['id'];
		}
		echo json_encode($arr);
	}
}elseif($op=="zhiding"){
	$tid =  $_GET['tid'];
	$info = DB::fetch_first("SELECT tid,displayorder FROM ".DB::table('forum_thread')." WHERE tid = '{$tid}'");
	if($info['displayorder']==1){
		DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder = '0' WHERE tid = {$info['tid']}");
		echo "success";
	}elseif($info['displayorder']==0){
		DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder = '1' WHERE tid = {$info['tid']}");
		echo "success";
	}else{
		echo "error";
	}
}elseif($op=="zhaoshang"){
	$bid =  $_GET['bid'];
	$dh = $_GET['dh'];
	DB::query("UPDATE ".DB::table('dianping_brand_info')." SET zstel = '".$dh."' WHERE id = $bid");
	echo "success";
}else{
	echo "error";
}
