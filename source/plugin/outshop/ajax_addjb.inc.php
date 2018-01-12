<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$tid = trim($_GET['tid']);
if($tid){
	$title = iconv("UTF-8", "gbk", $_POST['title']);
	$uid = $_POST['uid'];
	$uname = iconv("UTF-8", "gbk", $_POST['uname']);
	$content = iconv("UTF-8", "gbk", $_POST['content']);
	$time = time();
	if($uid==''||$title==''||$content==''){
		echo 'error';exit;
	}
	DB::query("INSERT INTO ".DB::table('plugin_jb_info')." (title, content, uid, username, dateline, tid) ".
						  "VALUE ('$title', '$content', $uid, '$uname', $time,$tid)");
	echo "success";
}else{
	echo "error";
}


