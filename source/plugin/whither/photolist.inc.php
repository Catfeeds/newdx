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

$page = max(1, intval($_G['gp_page']));

$ppp = 12;
$count = $forumoption_mudidi->getCountRalateAlbumByTid($tid);
$albumData = $forumoption_mudidi->getRalateAlbumByTid($tid, (($page - 1) * $ppp).", $ppp");

$mudidi_data = DB::fetch_first("SELECT t.*, r.* FROM ".DB::table('mudidi_thread_ralation')." AS r
								LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
							    WHERE r.tid = '{$tid}'");

$pageTitle = "{$mudidi_data['subject']}����ͼƬ - {$mudidi_data['subject']}������ͼƬ - {$mudidi_data['subject']}���ξ�����Ƭ - ����������";

include template('whither:photolist');
