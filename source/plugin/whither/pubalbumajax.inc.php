<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if ($_POST['areaSelect'] && $_GET['albumid'] && $_G['uid']) {
	$sn = $_POST['scapeareaSelect'] != 0 ? $_POST['scapeareaSelect'] : $_POST['areaSelect'];
	$time = time();
	
	DB::query("INSERT INTO ".DB::table('mudidi_album')." (sn, albumid, state, uid, posttime)
			   VALUES ('{$sn}', {$_GET['albumid']}, 0, {$_G['uid']}, {$time})");
	echo 1;
	exit;
}
echo 0;
exit;
