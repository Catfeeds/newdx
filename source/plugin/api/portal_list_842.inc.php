<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$offset = $_GET['offset'] ? $_GET['offset'] : 0;
$limit = $_GET['limit'] ? $_GET['limit'] : 20;
$array = array();
$json = array(
    'error_code' => 1
);

$query = DB::query("SELECT aid, title, username, url, pic, remote,serverid FROM ".DB::table('portal_article_title')." WHERE catid=842 AND pic<>'' ORDER BY aid DESC LIMIT $limit OFFSET $offset");
/*加入附件服务器*/
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
$domainall = $attachserver->get_server_domain('all');
/*结束*/
while ($value = DB::fetch($query)) {
	$content = DB::result_first("SELECT content FROM ".DB::table('portal_article_content')." WHERE aid={$value['aid']} LIMIT 1");
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