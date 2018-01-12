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

$page = max(1, intval($_G['gp_page']));

$ppp = 12;
$count = $forumoption_mudidi->getCountMapBySn($ralate['sn']);
$mapData = $forumoption_mudidi->getMapBySn($ralate['sn'], (($page - 1) * $ppp).", $ppp");

$mudidi_data = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid={$ralate['tid']}");
$mudidi_data['sn'] = $ralate['sn'];

$pageTitle = "2015最新{$mudidi_data['subject']}地图在线浏览,{$mudidi_data['subject']}地图下载 - {$mudidi_data['subject']} - 户外资料网";

include template('whither:maplist');
