<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home.php 16805 2010-09-15 03:56:11Z zhangguosheng $
 */

define('APPTYPEID', 1);
define('CURSCRIPT', 'home');
require_once './banip.php';
if(!empty($_GET['mod']) && ($_GET['mod'] == 'misc' || $_GET['mod'] == 'invite')) {
	define('ALLOWGUEST', 1);
}

require_once './source/class/class_core.php';
require_once './source/function/function_home.php';

$discuz = & discuz_core::instance();

$cachelist = array('magic','userapp','usergroups');
$discuz->cachelist = $cachelist;
$discuz->init();

$space = array();

$mod = getgpc('mod');
if(!in_array($mod, array('space', 'spacecp', 'misc', 'magic', 'editor', 'userapp', 'invite', 'task', 'medal', 'setting'))) {
	$mod = 'space';
	$_GET['do'] = 'home';
	if ($_G['uid'] == 0) {
		$_GET['view'] = 'all';
		$_GET['order'] = 'hot';
	}
}

define('CURMODULE', $mod);
runhooks();
checkusergroup(1);

//判断文件是否存在（20110627 edit by zhanghongliang）
if(file_exists('./source/plugin/domainset/indomain.php')){
   require './source/plugin/domainset/indomain.php';
}

// 访问统计插件
// if (file_exists(DISCUZ_ROOT.'./source/plugin/request_log/request.php')) {
    // include_once DISCUZ_ROOT.'./source/plugin/request_log/request.php';
// }

require_once libfile('home/'.$mod, 'module');
?>
