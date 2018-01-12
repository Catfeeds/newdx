<?php

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$cpxh=$_GET['lxid'];
$cpid=$_GET['cpid'];


if ($cpid) {		
	$query = DB::result_first("SELECT * FROM ".DB::table('plugin_produce_info')." WHERE id='{$cpid}'");
	if($query['cpxh']==$cpxh){	  
	  DB::query("UPDATE ".DB::table('plugin_produce_info')." SET cpxh = 0 WHERE id = {$cpid}");
	  echo "quxiao";
	}else{
	   DB::query("UPDATE ".DB::table('plugin_produce_info')." SET cpxh ='{$cplx}' WHERE id = {$cpid}");	
	   echo "chenggong";
	}	
} else {
	echo 'error';
}




exit;
