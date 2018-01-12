<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$tagid = $_GET['tagid'];
if (!empty($tagid)) {
	DB::query('DELETE FROM '.DB::table('mudidi_tags')." WHERE tagid={$tagid}");
	cpmsg('操作成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_tags', 'succeed');
} else {
	cpmsg('来路不正确, 请联系技术人员', 'action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_tags', 'error');
}
