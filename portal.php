<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: portal.php 16832 2010-09-15 07:38:31Z wangjinbo $
 */

define('APPTYPEID', 4);
define('CURSCRIPT', 'portal');
require_once './banip.php';
require './source/class/class_core.php';
$discuz = & discuz_core::instance();

$cachelist = array('userapp', 'portalcategory');
$discuz->cachelist = $cachelist;
$discuz->init();

require DISCUZ_ROOT.'./source/function/function_home.php';
require DISCUZ_ROOT.'./source/function/function_portal.php';

if(empty($_GET['mod']) || !in_array($_GET['mod'], array('list', 'view', 'comment', 'portalcp', 'topic', 'attachment', 'rss', 'actplat'))) $_GET['mod'] = 'index';

define('CURMODULE', $_GET['mod']);
runhooks();

$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['portal']);

//判断文件是否存在（20110627 edit by zhanghongliang）
//if(file_exists('./source/plugin/domainset/indomain.php')){
//   require './source/plugin/domainset/indomain.php';
//}
// 访问统计插件
// if (file_exists(DISCUZ_ROOT.'./source/plugin/request_log/request.php')) {
    // include_once DISCUZ_ROOT.'./source/plugin/request_log/request.php';
// }

//判断是否由手机访问（20140526 edit by lishuaiquan）
$useragent   = strtolower($_SERVER['HTTP_USER_AGENT']);
$isphone     = strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false || strpos($useragent, 'android') !== false || strpos($useragent, 'windows phone') !== false ? true : false;

if (empty($_COOKIE["goWebFromM"]) && $isphone) {
	$url = "";
	if ($_GET['mod'] == "index") {
		$url = $_G["config"]['web']['mobile'];
	}
	if ($_GET['mod'] == "list") {
		$cateList = array("842"=>"每日一图","881"=>"线路推荐","880"=>"勇者先行","878"=>"铿锵玫瑰","912"=>"户外摄影师");
		$url = !isset($cateList[$_GET['catid']]) ? "{$_G["config"]['web']['mobile']}list/{$_GET['catid']}" : "";
	}
	if ($_GET['mod'] == "view") {
		$url = "{$_G["config"]['web']['mobile']}viewnews-{$_GET['aid']}-page-1.html";
	}
	if (!empty($url)) {
		header("Location:{$url}");
		exit();
	}
}
require_once libfile('portal/'.$_GET['mod'], 'module');

?>
