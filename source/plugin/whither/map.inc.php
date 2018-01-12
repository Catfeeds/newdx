<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$tid = $_GET['tid'];
if (!$tid) {
    showmessage('URL错误, 请重试', '/');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';

$forumoption_mudidi->recordUser();

$ralate = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE tid = '{$tid}'");
switch ($ralate['type']) {
	case '1':
		$tableName = 'mudidi_scape';
		break;
	case '2':
		$tableName = 'mudidi_scapearea';
		break;
	case '3':
		$tableName = 'mudidi_region';
		break;
	default:
		break;
}

if ($tableName) {
	$mudidi_data = DB::fetch_first("SELECT * FROM ".DB::table($tableName)." WHERE sn = '{$ralate['sn']}'");
	$mudidi_data['tid'] = $tid;
	$mudidi_data['subject'] = $mudidi_data['name'];
}

$pageTitle = "2015最新{$mudidi_data['subject']}地图在线浏览,{$mudidi_data['subject']}地图下载 - {$mudidi_data['subject']} - 户外资料网";

include template('whither:map');
