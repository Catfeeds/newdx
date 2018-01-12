<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/admincp');

$optionid = $_GET['opid'];
DB::query("DELETE FROM ".DB::table('plugin_domainset')." WHERE id = ".$optionid);
memory('rm','domainset_indomain');
cpmsg('É¾³ýÉèÖÃ³É¹¦', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain', 'succeed');
