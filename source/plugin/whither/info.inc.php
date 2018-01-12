<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';
$forumoption_mudidi->recordUser();

$infoid = $_GET['infoid'];

if ($infoid === NULL) {
    showmessage('URL¥ÌŒÛ, «Î÷ÿ ‘', '/');
}

require_once libfile('function/discuzcode');
$mudidi_info = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_info')." AS i
							    LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON i.sn = r.sn
								WHERE id = '$infoid'");


if ($mudidi_info) {
    $mudidi_info['message'] = discuzcode($mudidi_info['message'], -1, 0);
}

$mudidi_data = DB::fetch_first("SELECT t.*, r.* FROM ".DB::table('mudidi_thread_ralation')." AS r
								LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
							    WHERE r.sn = '{$mudidi_info['sn']}'");
$tid = $mudidi_data['tid'];

switch ($mudidi_data['type']) {
	case 1:
		$scapeareaSn = $forumoption_mudidi->getParentSn($mudidi_data['sn']);
		$scapeareaTid = $forumoption_mudidi->getTidBySn($scapeareaSn);
		break;
	case 2:
		$scapeareaTid = $mudidi_info['tid'];
		break;
	case 3:
		break;
	default:
		break;
}

// …Ë÷√pageTitle
$pageTitle = "{$mudidi_info['name']} - ";

include template('whither:info');
