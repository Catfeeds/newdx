<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once libfile('function/discuzcode');
require_once libfile('function/post');
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';
//需要改逻辑&&只提供最新的查询
$_GET['limit'] = $_GET['limit'] ? (int)$_GET['limit'] : 20;
$_GET['offset'] = $_GET['offset'] ? (int)$_GET['offset'] : 0;
$_GET['orderby'] = $_GET['orderby'] ? $_GET['orderby'] : 't.dateline';
if($_GET['filter']=="isworth"){
	$_GET['orderby'] = 't.dateline';
}
if($_G['uid']==1) memory('rm' ,'cache_products_ajax_list');
$products = memory('get' ,'cache_products_ajax_list'.$_GET['type'].'_'.$_GET['limit'].'_'.$_GET['offset']);
if (isset($_GET['default']) && $_GET['default'] == 1) {
	$dateline = time() - 172800;
	$limit = $_GET['limit'];
	$offset = $_GET['offset'];
	$products = ForumOptionProduce::loadCacheArrayByAjax('ajax',$limit,$offset);
	echo json_encode(array(
	'count'    => count($products),
	'products' => $products,
	'err_code' => 0
	));	exit;
}elseif(!$products){
	if($_GET['type']){
		$str = "select * from ".DB::table('plugin_produce_type')." where id=$_GET[type]";
		$type = DB::fetch_first($str);
		if($type['tparent']){
			$where = " i.cplx={$_GET['type']} ";
		}else{
			$where = " i.cpdl={$_GET['type']} ";
		}
	}
	/*$sql = "SELECT i.cptp,i.serverid, i.cpjg, i.cpxh, i.index_height, t.* FROM ".DB::table('plugin_produce_info')." AS i"
		." LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid"
		." WHERE i.isshow=1 AND i.type = 0 "
		.($_GET['filter']=='cpxh' ? " AND i.cpxh = 1" : "")
		.($_GET['filter']=='digest' ? " AND t.digest = 1" : "")
		.($_GET['filter']=='isworth' ? " AND i.isworth = 1" : "")
		.($_GET['brand'] ? " AND i.cppp = {$_GET['brand']}" : "")
		.($_GET['type'] ? " AND {$where}" : "")
		." ORDER BY {$_GET['orderby']} DESC"
		." LIMIT {$_GET['limit']} OFFSET {$_GET['offset']}";*/
    $sql = "SELECT i.cptp,i.serverid, i.cpjg, i.cpxh, i.index_height, t.* FROM ".DB::table('plugin_produce_info')." AS i"
		." LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid"
		." WHERE i.isshow=1 AND i.isin=0 AND i.type = 0 ORDER BY t.dateline DESC LIMIT {$_GET['limit']} OFFSET {$_GET['offset']}";
$query = DB::query($sql);
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
$alldomain = $attachserver->get_server_domain('all');
while ($value = DB::fetch($query)) {
	/*
	if($value['tid']){
		$str = "select * from ".DB::table('forum_post')." where `first`=1 and tid=$value[tid] limit 1";
		$post = DB::fetch_first($str);
		if($post){
			$value['message'] = $post['message'];
			$value['message'] = preg_replace('/\r?\n/', '', $value['message']);
			$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
			$value['message'] = discuzcode($value['message']);
			$value['message'] = str_replace('　','',$value['message']);
			$value['message'] = preg_replace('/(&nbsp;)+/', '', $value['message']);
			$value['message'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $value['message']);
			$value['message'] = trim($value['message']);
			$value['message'] = messagecutstr($value['message'],100);
		}
	}*/
    $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']] : "/data/attachment")."/plugin/".$value['cptp'];
	$value['avatar'] = avatar($value['authorid'], 'small');
	$value['dateline'] = date('Y-m-d H:i', $value['dateline']);
	$value['cpxh'] = is_numeric((int)$value['cpxh']) ? $value['cpxh'] : 0;
	$value['digest'] = is_numeric((int)$value['digest']) ? $value['digest'] : 0;
	$value['sharenum'] = ForumOptionProduce::getShareNumber($value['authorid']);

	$value['author'] = mb_convert_encoding($value['author'], 'UTF-8', 'GBK');
	$value['subject'] = mb_convert_encoding($value['subject'], 'UTF-8', 'GBK');
	$value['message'] = mb_convert_encoding($value['message'], 'UTF-8', 'GBK');

	$products[] = $value;
}
memory('set' ,'cache_products_ajax_list'.$_GET['type'].'_'.$_GET['limit'].'_'.$_GET['offset'] ,3600);
}
echo json_encode(array(
'count'    => count($products),
'products' => $products,
'err_code' => 0
));


