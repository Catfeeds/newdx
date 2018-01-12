<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$puid=$_GET['puid'];
$uuid=$_GET['uuid'];
$ttid=$_GET['ttid'];

if(!empty($puid)&&!empty($uuid)&&!empty($ttid)){
	DB::query("delete from ".DB::table('plugin_produce_relevance')." WHERE tid ={$ttid} AND uid={$uuid}");
	DB::query("delete from ".DB::table('plugin_produce_users')." WHERE id={$puid}");
	echo "success";
}else{
	echo "error";
}
