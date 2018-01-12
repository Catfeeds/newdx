<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$category = array();
if (!empty($_POST)) {
	$repeat_num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_articlekeywords_category')." WHERE name='{$_POST['name']}'");

	if ($repeat_num > 0) {
		cpmsg('分类己存在', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp_category&op=new', 'error');
	} else {
		DB::query("INSERT INTO ".DB::table('plugin_articlekeywords_category')."
				  (name) VALUES ('{$_POST['name']}')");
		cpmsg('新建成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp_category', 'succeed');
	}
}

include dirname(__file__).'/views/postform.php';
