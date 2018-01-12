<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';

if (!$_G['uid'] || $_G['group']['radminid'] <= 0) {
	showmessage('您无权访问此页面', '/');
}

$infoid = $_GET['infoid'];
$tid = $_GET['tid'];
if (!$tid) {
	showmessage('URL错误, 请重试', '/');
}

$ralation = DB::fetch_first("SELECT r.*, t.subject FROM ".DB::table('mudidi_thread_ralation')." AS r
							 LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
							 WHERE r.tid = $tid");
$sn = $ralation['sn'];

if (!$sn) {
	showmessage('URL错误, 请重试', '/');
}

if (!empty($_POST)) {
	$message = trim($_POST['message']);
	$name = trim($_POST['name']);
	$form_type = trim($_POST['form_type']);
	
	if ($form_type == 'modify') {
		DB::query("UPDATE ".DB::table('mudidi_info')." SET name='$name', message='$message' WHERE id = $infoid");
	} else {
		DB::query("INSERT INTO ".DB::table('mudidi_info')." (sn, name, message) VALUES ('$sn', '$name', '$message')");
		$infoid = DB::insert_id();
	}
	showmessage('提交成功', "/whither-info-$infoid.html");
}


$mudidi_info = array();
if ($infoid != NULL) {
	$form_type = 'modify';
	$mudidi_info = DB::fetch_first("SELECT i.*, r.tid FROM ".DB::table('mudidi_info')." AS i
									LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON i.sn = r.sn
									WHERE i.id = $infoid");
	$name = $mudidi_info['name'];
	$pageTitle = '编辑'.$thread['subject'].$name.'信息 - 目的地 - 户外资料网';
} else {
	$form_type = 'insert';
	$pageTitle = '发布'.$thread['subject'].'信息 - 目的地 - 户外资料网';
}


// 配置 来自forum_post.php
$_G['forum']['allowpostattach'] = isset($_G['forum']['allowpostattach']) ? $_G['forum']['allowpostattach'] : '';
$_G['group']['allowpostattach'] = $_G['forum']['allowpostattach'] != -1 && ($_G['forum']['allowpostattach'] == 1 || (!$_G['forum']['postattachperm'] && $_G['group']['allowpostattach']) || ($_G['forum']['postattachperm'] && forumperm($_G['forum']['postattachperm'])));
$_G['forum']['allowpostimage'] = isset($_G['forum']['allowpostimage']) ? $_G['forum']['allowpostimage'] : '';
$_G['group']['allowpostimage'] = $_G['forum']['allowpostimage'] != -1 && ($_G['forum']['allowpostimage'] == 1 || (!$_G['forum']['postimageperm'] && $_G['group']['allowpostimage']) || ($_G['forum']['postimageperm'] && forumperm($_G['forum']['postimageperm'])));
$_G['group']['attachextensions'] = $_G['forum']['attachextensions'] ? $_G['forum']['attachextensions'] : $_G['group']['attachextensions'];
if($_G['group']['attachextensions']) {
	$imgexts = explode(',', str_replace(' ', '', $_G['group']['attachextensions']));
	$imgexts = array_intersect(array('jpg','jpeg','gif','png','bmp'), $imgexts);
	$imgexts = implode(', ', $imgexts);
} else {
	$imgexts = 'jpg, jpeg, gif, png, bmp';
}
$allowuploadnum = TRUE;
if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
	if($_G['group']['maxattachnum']) {
		$allowuploadnum = $_G['group']['maxattachnum'] - DB::result_first("SELECT count(*) FROM ".DB::table('forum_attachment')." WHERE uid='$_G[uid]' AND pid>'0' AND dateline>'$_G[timestamp]'-86400");
		$allowuploadnum = $allowuploadnum < 0 ? 0 : $allowuploadnum;
	}
	if($_G['group']['maxsizeperday']) {
		$allowuploadsize = $_G['group']['maxsizeperday'] - intval(DB::result_first("SELECT SUM(filesize) FROM ".DB::table('forum_attachment')." WHERE uid='$_G[uid]' AND dateline>'$_G[timestamp]'-86400"));
		$allowuploadsize = $allowuploadsize < 0 ? 0 : $allowuploadsize;
		$allowuploadsize = $allowuploadsize / 1048576 >= 1 ? round(($allowuploadsize / 1048576), 1).'MB' : round(($allowuploadsize / 1024)).'KB';
	}
}
$allowpostimg = $_G['group']['allowpostimage'] && $imgexts;
$enctype = ($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) ? 'enctype="multipart/form-data"' : '';
$maxattachsize_mb = $_G['group']['maxattachsize'] / 1048576 >= 1 ? round(($_G['group']['maxattachsize'] / 1048576), 1).'MB' : round(($_G['group']['maxattachsize'] / 1024)).'KB';

$postcredits = $_G['forum']['postcredits'] ? $_G['forum']['postcredits'] : $_G['setting']['creditspolicy']['post'];
$replycredits = $_G['forum']['replycredits'] ? $_G['forum']['replycredits'] : $_G['setting']['creditspolicy']['reply'];
$digestcredits = $_G['forum']['digestcredits'] ? $_G['forum']['digestcredits'] : $_G['setting']['creditspolicy']['digest'];
$postattachcredits = $_G['forum']['postattachcredits'] ? $_G['forum']['postattachcredits'] : $_G['setting']['creditspolicy']['postattach'];

$_G['group']['maxprice'] = isset($_G['setting']['extcredits'][$_G['setting']['creditstrans']]) ? $_G['group']['maxprice'] : 0;

$editorid = 'e';
$_G['setting']['editoroptions'] = str_pad(decbin($_G['setting']['editoroptions']), 2, 0, STR_PAD_LEFT);
$editormode = $_G['setting']['editoroptions']{0};
$allowswitcheditor = $_G['setting']['editoroptions']{1};
$editor = array(
	'editormode' => $editormode,
	'allowswitcheditor' => $allowswitcheditor,
	'allowhtml' => 0,
	'allowsmilies' => 1,
	'allowbbcode' => 1,
	'allowimgcode' => 1,
	'allowresize' => 1,
	'textarea' => 'message',
	'simplemode' => !isset($_G['cookie']['editormode_'.$editorid]) ? 1 : $_G['cookie']['editormode_'.$editorid],
);
if($specialextra) {
	$special = 127;
}

require_once libfile('function/post');
$attachlist = getattach(0);
$attachs = $attachlist['attachs'];
$imgattachs = $attachlist['imgattachs'];
unset($attachlist);

include template('whither:pubinfo');