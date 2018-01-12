<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$users = array();
$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_publishers')." WHERE blocked <> 1 ORDER BY rank DESC LIMIT 999");
while ($value = DB::fetch($query)) {
	$users[] = $value;
}
$pageTitle = '户外装备分享贡献榜  - 装备分享 - 户外资料网';
include template('produce:userrank');