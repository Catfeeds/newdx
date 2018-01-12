<?php
/**
 *   ajax更新标签和装备的关系
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';
require_once libfile('function/admincp');

$op = $_GET['op'];


if(!empty($op)&&$op=="add"){
	$chk_tid = $_GET['chk_detail'];
	$tid =  $_GET['tid'];
	DB::query("DELETE FROM ".DB::table('plugin_produce_relation')." WHERE childId={$tid}");
	if($chk_tid){
		foreach ($chk_tid as $value){
			DB::query("Replace INTO ".DB::table('plugin_produce_relation')." (parentId,childId) VALUES ($value,{$tid})");
		}
	}
	echo "success";
}else if(!empty($op)&&$op=="edit"){
	$tid =  $_GET['tid'];
	$info = DB::query("SELECT * FROM ".DB::table('plugin_produce_relation')." WHERE childId = '{$tid}'");
	while ($value = DB::fetch($info)) {
		$arr[] = $value['parentId'];
	}
	echo json_encode($arr);
}else{
	echo "error";
}
