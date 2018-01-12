<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/admincp');

$optionid = $_GET['opid'];
$prod = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=".$optionid);
if ($prod['tparent'] == 0) {
 	$query = DB::query("select * from ".DB::table('plugin_produce_type')." where tparent=".$prod['id']);
	while ($value = DB::fetch($query)) {
	   DB::query("DELETE FROM ".DB::table('plugin_produce_type')." WHERE id = ".$value['id']); 	
	}	
}
DB::query("DELETE FROM ".DB::table('plugin_produce_type')." WHERE id = ".$optionid);

cpmsg('É¾³ýÉèÖÃ³É¹¦', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type', 'succeed');
