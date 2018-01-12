<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once libfile('function/discuzcode');

if (!$_GET['tid']) {
	echo json_encode(array(
		'err_code' => 1
	));
	exit;
}

$_GET['offset'] = $_GET['offset'] ? (int)$_GET['offset'] : 0;
$_GET['limit'] = $_GET['limit'] ? (int)$_GET['limit'] : 20;

$comments = array();
$query = DB::query("SELECT * FROM ".DB::table('forum_post').""
				   ." WHERE tid = '{$_GET['tid']}' AND first = 0 AND invisible = '0'"
				   ." ORDER BY pid DESC"
				   ." LIMIT {$_GET['limit']} OFFSET {$_GET['offset']}");
while ($value = DB::fetch($query)) {
  $value['message'] = discuzcode($value['message'], $value['smileyoff'], $value['bbcodeoff'], $value['htmlon'] & 1, 1, -1, 1, 0, 0, 0, $value['authorid'], 0/*, $value['pid']*/);
	$value['message'] = str_replace('thumbImg(this)', 'thumbImg(this,null,757)', $value["message"]);
	$value['author'] = mb_convert_encoding($value['author'], 'UTF-8', 'GBK');
	$value['message'] = mb_convert_encoding($value['message'], 'UTF-8', 'GBK');
	$value['dateline'] = mb_convert_encoding(dgmdate($value['dateline'], 'u'), 'UTF-8', 'GBK');
	$value['avatar'] = avatar($value['authorid'], 'small');
	$comments[] = $value;
}

echo json_encode(array(
	'count'    => count($comments),
	'comments' => $comments,
	'err_code' => 0
));
