<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if ($_POST['sn'] && $_GET['type'] && $_GET['typeid'] && $_G['uid']) {
	if ($_GET['type'] == 1) {
		$post = DB::fetch_first("SELECT dateline FROM ".DB::table('forum_post')." WHERE tid = {$_GET['typeid']} AND first = 1");
		$dateline = $post['dateline'];
	} else {
		$blog = DB::fetch_first("SELECT dateline FROM ".DB::table('home_blog')." WHERE blogid = {$_GET['typeid']}");
		$dateline = $blog['dateline'];
	}
	
	$guide = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_guide')."
							  WHERE sn = '{$_POST['sn']}' AND type = {$_GET['type']} AND typeid = {$_GET['typeid']} AND uid = {$_G['uid']}");
	if (!$guide) {
		$time = time();
		DB::query("INSERT INTO ".DB::table('mudidi_guide')." (sn, type, typeid, dateline, state, uid, posttime)
				   VALUES ('{$_POST['sn']}', {$_GET['type']}, {$_GET['typeid']}, $dateline, 0, {$_G['uid']}, {$time})");
	}
	echo 1;
	exit;
}
echo 0;
exit;
