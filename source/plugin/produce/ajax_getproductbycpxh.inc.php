<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once libfile('function/discuzcode');
require_once libfile('function/post');
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';

$_GET['limit'] = $_GET['limit'] ? (int)$_GET['limit'] : 20;
$_GET['offset'] = $_GET['offset'] ? (int)$_GET['offset'] : 0;

$tid = $_GET['tid'];


if($tid){
$str = "SELECT r.*, i.cptp,i.serverid, i.cpjg, i.cpxh, i.index_height, t.*, p.message FROM ".DB::table('plugin_produce_relation')." AS r"
	   ." LEFT JOIN ".DB::table('plugin_produce_info')." AS i on i.tid = r.childId"
	   ." LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid"
	   ." LEFT JOIN ".DB::table('forum_post')." as p ON t.tid = p.tid and p.first=1"
	   ." WHERE i.isshow=1 AND t.displayorder >= 0 AND p.invisible>= 0 AND t.closed = 0 and i.isworth = 0 and i.type = 0 and r.parentId = $tid"
       ." LIMIT {$_GET['limit']} OFFSET {$_GET['offset']}";

$products = array();
$query = DB::query($str);
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
$alldomain = $attachserver->get_server_domain('all');
while ($value = DB::fetch($query)) {
	$value['message'] = preg_replace('/\r?\n/', '', $value['message']);
	$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
	$value['message'] = discuzcode($value['message']);
	$value['message'] = str_replace('¡¡','',$value['message']);
	$value['message'] = preg_replace('/(&nbsp;)+/', '', $value['message']);
	$value['message'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $value['message']);
	$value['message'] = trim($value['message']);
	$value['message'] = messagecutstr($value['message'],100);
	$value['avatar'] = avatar($value['authorid'], 'small');
	$value['dateline'] = date('Y-m-d H:i', $value['dateline']);
	$value['cpxh'] = is_numeric((int)$value['cpxh']) ? $value['cpxh'] : 0;
	$value['digest'] = is_numeric((int)$value['digest']) ? $value['digest'] : 0;
	$value['sharenum'] = ForumOptionProduce::getShareNumber($value['authorid']);
	$value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']] : "/data/attachment")."/plugin/".$value['cptp'];
	$value['author'] = mb_convert_encoding($value['author'], 'UTF-8', 'GBK');
	$value['subject'] = mb_convert_encoding($value['subject'], 'UTF-8', 'GBK');
	$value['message'] = mb_convert_encoding($value['message'], 'UTF-8', 'GBK');


	$products[] = $value;
}
echo json_encode(array(
	'count'    => count($products),
	'products' => $products,
	'err_code' => 0
));
}
