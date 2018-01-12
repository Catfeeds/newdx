<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$tid = $_GET['tid'];
if (!$tid) {
    showmessage('URL错误, 请重试', '/');
}

require_once DISCUZ_ROOT.'./source/function/function_post.php';
require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';

$forumoption_mudidi->recordUser();

$page = max(1, intval($_G['gp_page']));

$ppp = 12;
$count = $forumoption_mudidi->getCountSubScapeByTid($tid);
$scapeData = $forumoption_mudidi->getSubScapeByTid($tid, (($page - 1) * $ppp).", $ppp");

$mudidi_data = DB::fetch_first("SELECT t.*, r.* FROM ".DB::table('mudidi_thread_ralation')." AS r
								LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
							    WHERE r.tid = '{$tid}'");

$pageTitle = "{$mudidi_data['subject']}旅游景点介绍 - {$mudidi_data['subject']}有什么好玩的 - {$mudidi_data['subject']}旅游景点大全 - 户外资料网";

include template('whither:scapelist');
