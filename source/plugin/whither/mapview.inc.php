<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$mapId = $_GET['mapid'];
if (!$mapId) {
    showmessage('URL����, ������', '/');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';

$forumoption_mudidi->recordUser();

$mapView = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_map')." WHERE id={$mapId}");
$ralate = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE sn = '{$mapView['sn']}'");
$tid = $ralate['tid'];

$mudidi_data = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid = '{$tid}'");
$mudidi_data['sn'] = $ralate['sn'];

$pageTitle = "2015����{$mudidi_data['subject']}��ͼ�������,{$mudidi_data['subject']}��ͼ���� - {$mudidi_data['subject']} - ����������";

include template('whither:mapview');
