<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if (!empty($_GET['tagid'])) {
	DB::query("DELETE FROM ".DB::table('plugin_daily_picture_tags')." WHERE id = {$_GET['tagid']}");
	cpmsg('É¾³ý³É¹¦', 'action=plugins&operation=config&do='.$pluginid.'&identifier=dailypicture&pmod=admincp_tag', 'succeed');
}
