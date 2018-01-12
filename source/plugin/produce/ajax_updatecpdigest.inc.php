<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';
$lx=$_GET['op'];
$tid=$_GET['tid'];

if(!empty($lx)&&!empty($tid)){
	if($lx=='set'){
		DB::query("UPDATE ".DB::table('forum_thread')." SET digest = 1 WHERE tid = {$tid}");
		//精华加分操作
		ForumOptionProduce::calPostRankEvent($tid,3);
		$thread=ForumOptionProduce::getTheardBytId($tid);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],6);
	}else if($lx=='cancel'){
		DB::query("UPDATE ".DB::table('forum_thread')." SET digest = 0 WHERE tid = {$tid}");
		//取消精华减分操作
		ForumOptionProduce::calPostRankEvent($tid,4);
		$thread=ForumOptionProduce::getTheardBytId($tid);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],7);
	}else if($lx=='setzd'){
		DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder = 1 WHERE tid = {$tid}");
	}else if($lx=='cancelzd'){
		DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder = 0 WHERE tid = {$tid}");
	}else{
		echo "cuowu";
	}
	echo "success";
}else{
	echo "error";
}
