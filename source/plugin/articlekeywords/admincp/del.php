<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$kid = $_GET['kid'];
DB::query("DELETE FROM ".DB::table('plugin_articlekeywords')." WHERE id = ".$kid);
cpmsg('ɾ�����óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp', 'succeed');
