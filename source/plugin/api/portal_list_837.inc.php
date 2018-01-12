<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$offset = $_GET['offset'] ? $_GET['offset'] : 0;
$limit = $_GET['limit'] ? $_GET['limit'] : 20;
$json = array(
    'error_code' => 1
);
/*加入附件服务器*/
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
$domainall = $attachserver->get_server_domain('all');
/*结束*/
$query = DB::query("SELECT aid, title, username, url, pic, remote,serverid FROM ".DB::table('portal_article_title')." WHERE catid IN (837, 838, 839, 840, 841) AND pic<>'' ORDER BY aid DESC LIMIT $limit OFFSET $offset");
$array = array();
require_once DISCUZ_ROOT.'./source/function/function_post.php';
while ($value = DB::fetch($query)) {
	$content = DB::result_first("SELECT content FROM ".DB::table('portal_article_content')." WHERE aid={$value['aid']} LIMIT 1");
	$content = messagecutstr($content, 300);
	$value['content'] = mb_convert_encoding(strip_tags(trim($content)), 'utf-8', 'gbk');
	$value['title'] = mb_convert_encoding($value['title'], 'utf-8', 'gbk');
	$value['pic'] = ($value['remote'] == 1 ? $_G['setting']['ftp']['attachurl'].'portal/' : ($value['serverid'] > 0 ? "http://".$domainall[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
	$array[] = $value;
}

if ($array) {
	$json['pics'] = $array;
	$json['count'] = count($array);
	$json['error_code'] = 0;
}

echo json_encode($json);