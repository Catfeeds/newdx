<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/admincp');

$optionid = $_GET['id'];

$del = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_recommend')." where id=$optionid");

$sql="SELECT cptp,tid FROM ".DB::table('plugin_produce_info')." WHERE tid in($del[tids])";
$query=DB::query($sql);
while($value = DB::fetch($query)) {
	$mc=strtr($value['cptp'],"/",".");	
	$path1=DISCUZ_ROOT."./data/attachment/plugin/thumb/".$mc;
	if(file_exists($path1)){
		@unlink($path1);
	}
}
DB::query("DELETE FROM ".DB::table('plugin_produce_recommend')." WHERE id = ".$optionid);

cpmsg('É¾³ý³É¹¦', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_commend', 'succeed');
