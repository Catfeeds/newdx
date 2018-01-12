<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/admincp');

$optionid = $_GET['opid'];
DB::query("DELETE FROM ".DB::table('plugin_forumoption')." WHERE id = ".$optionid);
DB::query("DELETE FROM ".DB::table('plugin_forumoption_field')." WHERE optionid = ".$optionid);
memory('rm', 'oBmjvS_fid');
cpmsg('É¾³ýÉèÖÃ³É¹¦', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp', 'succeed');
