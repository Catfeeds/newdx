<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$users = array();
$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_publishers')." WHERE blocked <> 1 ORDER BY rank DESC LIMIT 999");
while ($value = DB::fetch($query)) {
	$users[] = $value;
}
$pageTitle = '����װ�������װ�  - װ������ - ����������';
include template('produce:userrank');