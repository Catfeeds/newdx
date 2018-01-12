<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$optionid = $_GET['opid'];
DB::query("DELETE FROM ".DB::table('plugin_threadoption')." WHERE id = ".$optionid);
DB::query("DELETE FROM ".DB::table('plugin_threadoption_field')." WHERE optionid = ".$optionid);
cpmsg('É¾³ýÉèÖÃ³É¹¦', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread', 'succeed');
