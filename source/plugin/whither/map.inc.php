<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$tid = $_GET['tid'];
if (!$tid) {
    showmessage('URL����, ������', '/');
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

$pageTitle = "2015����{$mudidi_data['subject']}��ͼ�������,{$mudidi_data['subject']}��ͼ���� - {$mudidi_data['subject']} - ����������";

include template('whither:map');
