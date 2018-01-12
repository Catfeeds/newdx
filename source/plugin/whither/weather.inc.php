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

if (!in_array($ralate['type'], array(2, 3))) {
	showmessage('URL错误, 请重试', '/');
}
$templateName = $mudidiTableName = '';
switch ($ralate['type']) {
    case 3:
		$templateName = 'whither:weather_region';
        $mudidiTableName = 'mudidi_region';
        break;
    case 2:
		$templateName = 'whither:weather_scapearea';
        $mudidiTableName = 'mudidi_scapearea';
        break;
    default:
        break;
}


$mudidi_data = DB::fetch_first("SELECT * FROM ".DB::table($mudidiTableName)." WHERE sn = '{$ralate['sn']}'");
$mudidi_data['tid'] = $tid;
$mudidi_data['subject'] = $mudidi_data['name'];

$pageTitle = "最新{$mudidi_data['subject']}天气预报 - {$mudidi_data['subject']}一周天气预报查询 - {$mudidi_data['subject']}上级地区 - 户外资料网";

include template($templateName);