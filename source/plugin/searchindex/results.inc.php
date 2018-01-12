<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once(DISCUZ_ROOT.'./source/plugin/'.$pluginmodule['directory'].'./common.php');
require_once(DISCUZ_ROOT.'source/function/function_post.php');
require_once(DISCUZ_ROOT.'source/function/function_misc.php');
require_once DISCUZ_ROOT.'./source/plugin/'.$pluginmodule['directory'].'./SearchKey.php';
require_once libfile('function/home');

$searchindex = $forumoption_key->getKeywordByKid($_G['gp_searchid']);

if (!$manager && $searchindex['state'] == 0) {
	showmessage('您访问的内容并不存在', 'zhuanti', 2);
}
if($searchindex['searchid']=='5187') {
	showmessage('您访问的内容并不存在', 'zhuanti', 2);
}

$addwhere = $forumoption_key->getAddwhereByKeyArr($searchindex);
$neighborKeys = $forumoption_key->getNeighborSearchKeyByKid($searchindex['searchid']);
$ing = $forumoption_key->getBlodsByKeyArr($searchindex, $addwhere['blog']);
$forum = $forumoption_key->getForumsByKeyArr($searchindex, $addwhere['forum']);
$portal = $forumoption_key->getPortalByKeyArr($searchindex, $addwhere['portal']);
$three = array_slice($portal, 0, 3);
$thirteen = array_slice($portal, 3);

$navtitle = $searchindex['keywords'].'_'.'专题';

// 140124 rinne 调取电商程序关键字广告接口
$ginfo = memory('get', "searchindexad_{$searchindex['searchid']}");
if (!$ginfo) {
	require_once DISCUZ_ROOT . './external/hprose4p/HproseHttpClient.php';
	$rpc_c = new HproseHttpClient();
	$args = array('app' => 'zhtad', 'app_id' => 39431385, 'nt' => time());
	$url_query = build_spt_url($args);
	$rpc_c->useService('http://www.lvyoumall.com/services.php' . $url_query);
	try{
		$ginfo = $rpc_c->getGoodsAd($searchindex['keywords'], $searchindex['rule']);
		memory('set', "searchindexad_{$searchindex['searchid']}", $ginfo, 3600 * 1);
	} catch (Exception $e) {
		$ginfo = array();
	}
}

include template('searchindex:results');
