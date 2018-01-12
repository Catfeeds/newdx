<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if (!$_G['uid'] || $_G['group']['radminid'] <= 0) {
    showmessage('您无权访问此页面', '/');
}

$infoid = $_GET['infoid'];
if (!$infoid) {
    showmessage('URL错误, 请重试', '/');
}

$ralation = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." AS r
							 LEFT JOIN ".DB::table('mudidi_info')." AS i ON r.sn = i.sn
							 WHERE i.id = $infoid");
if ($ralation['default'] == 0) {
	DB::query("DELETE FROM ".DB::table('mudidi_info')." WHERE id = $infoid AND `default` = 0");
	showmessage('删除成功', "/thread-{$ralation['tid']}-1-1.html");
} else {
	showmessage('默认信息禁止删除', "/whither-info-$infoid.html");
}
exit;
