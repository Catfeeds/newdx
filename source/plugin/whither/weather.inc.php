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

if (!in_array($ralate['type'], array(2, 3))) {
	showmessage('URL����, ������', '/');
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

$pageTitle = "����{$mudidi_data['subject']}����Ԥ�� - {$mudidi_data['subject']}һ������Ԥ����ѯ - {$mudidi_data['subject']}�ϼ����� - ����������";

include template($templateName);