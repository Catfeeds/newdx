<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$cid = $_GET['cid'];
$category = DB::fetch_first("SELECT * FROM ".DB::table('plugin_articlekeywords_category')." WHERE id = {$cid}");

if (!empty($_POST)) {
	$repeat_num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_articlekeywords_category')." WHERE id != {$cid} AND name='{$_POST['name']}'");

	if ($repeat_num > 1) {
		cpmsg('分类重复', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp_category&op=edit&cid='.$cid, 'error');
	} else {
		DB::query("UPDATE ".DB::table('plugin_articlekeywords_category')."
				   SET name = '{$_POST['name']}'
				   WHERE id = {$cid}");
		cpmsg('修改成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp_category', 'succeed');
	}
}
include dirname(__file__).'/views/postform.php';
