<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

		
if (!empty($_GET['tid']) && $_G['uid']) {
	$tid = $_GET['tid'];
	$type = $_GET['type'];
	

	
	$attentions = array('want', 'wopandengguo');
	$query = DB::query("SELECT * FROM ".DB::table('plugin_mountion_users')." WHERE uid = {$_G['uid']} AND tid = {$tid}");
	$user_attentions = array();
	while ($value = DB::fetch($query)) {
		$user_attentions[$value['type']] = $value;
	}
	
	if ($_GET['op'] == 'new') {
		if (!$_G['uid'] || !$tid || !$type || !in_array($type, $attentions)) {
			echo 'error';
		} elseif (!empty($user_attentions[$type])) {
			echo 'repeat';
		} else {
			DB::query("INSERT INTO ".DB::table('plugin_mountion_users')." (uid, tid, type) VALUES ({$_G['uid']}, {$tid}, '{$type}')");
			/*if ($_POST['product_select']) {
				$query = DB::fetch_first("SELECT id FROM ".DB::table('plugin_mountion_users')." WHERE uid = {$_G['uid']} AND tid = {$tid} AND type = '{$type}' LIMIT 1");
				$id = $query['id'];
				$value = implode(",",$_POST['product_select']);
				//DB::query("INSERT INTO ".DB::table('plugin_brand_users_value')." (id, name, value) VALUES ({$id}, 'products', '{$value}')");
				
			}
			if ($_POST['pid']) {
				//DB::query("INSERT INTO ".DB::table('plugin_brand_users_value')." (id, name, value) VALUES ({$id}, 'pid', '{$_POST['pid']}')");
			}*/
			echo 'success';
		}
	}
}
