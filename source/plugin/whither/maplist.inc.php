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

$page = max(1, intval($_G['gp_page']));

$ppp = 12;
$count = $forumoption_mudidi->getCountMapBySn($ralate['sn']);
$mapData = $forumoption_mudidi->getMapBySn($ralate['sn'], (($page - 1) * $ppp).", $ppp");

$mudidi_data = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid={$ralate['tid']}");
$mudidi_data['sn'] = $ralate['sn'];

$pageTitle = "2015����{$mudidi_data['subject']}��ͼ�������,{$mudidi_data['subject']}��ͼ���� - {$mudidi_data['subject']} - ����������";

include template('whither:maplist');
