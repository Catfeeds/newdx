<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$cid = $_GET['cid'];
DB::query("DELETE FROM ".DB::table('plugin_articlekeywords_category')." WHERE id = ".$cid);
cpmsg('É¾³ý³É¹¦', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp_category', 'succeed');
