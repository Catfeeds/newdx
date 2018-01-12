<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$kid = $_GET['kid'];
$article_keyword = DB::fetch_first("SELECT * FROM ".DB::table('plugin_articlekeywords')." WHERE id = {$kid}");

// 分类
$categorys = array();
$query = DB::query("SELECT * FROM ".DB::table('plugin_articlekeywords_category'));
while ($value = DB::fetch($query)) {
	$categorys[] = $value;
}

if (!empty($_POST)) {
	$repeat_num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_articlekeywords')." where id != {$kid} AND keyword = '{$_POST['keyword']}'");

	if ($repeat_num > 0) {
		cpmsg('关键字重复', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp&op=edit&kid='.$kid, 'error');
	} else {
		DB::query("UPDATE ".DB::table('plugin_articlekeywords')."
				   SET keyword = '{$_POST['keyword']}',
					   link = '{$_POST['link']}',
					   category = '{$_POST['category']}',
					   enabled = '{$_POST['enabled']}'
				   WHERE id = {$kid}");
		cpmsg('修改设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp', 'succeed');
	}
}
include dirname(__file__).'/views/postform.php';
