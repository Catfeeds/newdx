<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$article_keyword = $category = array();

// ����
$query = DB::query("SELECT * FROM ".DB::table('plugin_articlekeywords_category'));
while ($value = DB::fetch($query)) {
	$categorys[] = $value;
}
if (!empty($_POST)) {
	$repeat_num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_articlekeywords')." where keyword = '{$_POST['keyword']}'");

	if ($repeat_num > 0) {
		cpmsg('�ؼ����ظ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp&op=new', 'error');
	} else {
		DB::query("INSERT INTO ".DB::table('plugin_articlekeywords')."
				  (keyword, link, category, enabled) VALUES ('{$_POST['keyword']}', '{$_POST['link']}', '{$_POST['category']}', '{$_POST['enabled']}')");
		cpmsg('�½��ؼ��ֳɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp', 'succeed');
	}
}

include dirname(__file__).'/views/postform.php';
