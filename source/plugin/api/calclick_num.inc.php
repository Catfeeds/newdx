<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$type = $_GET['type'];
if($type=='iphone'){
	 DB::query("update ".DB::table('plugin_temp')." set url=url+1 WHERE id='6'");
	 echo 'success';
	 exit;
}elseif($type=='android'){
	 DB::query("update ".DB::table('plugin_temp')." set url=url+1 WHERE id='7'");
	 echo 'success';
	 exit;
}else{
	exit;
}

