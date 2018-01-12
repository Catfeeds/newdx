<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admin.php 23291 2011-07-04 01:30:46Z cnteacher $
 */
define('IN_ADMINCP', TRUE);
define('NOROBOT', TRUE);
define('ADMINSCRIPT', basename(__FILE__));
define('CURSCRIPT', 'admin');
define('APPTYPEID', 0);

//====================================
// 基础文件引入， 其他程序引导文件可能不需要
// class_forum.php 和 function_forum.php
// 请根据实际需要确定是否引入
//====================================

require './source/class/class_core.php';
require './source/class/class_admincp.php';
require './source/function/function_misc.php';
require './source/function/function_forum.php';
require './source/function/function_admincp.php';
require './source/function/function_cache.php';

$discuz = & discuz_core::instance();
$discuz->init();

$admincp = new discuz_admincp();
$admincp->core = & $discuz;
$admincp->init();
//====================================
// 后台动作定义
//====================================
// if (file_exists('./source/plugin/domainset/indomain.php')) {
// 	require './source/plugin/domainset/indomain.php';
// }
$admincp_actions_founder = array('templates', 'db', 'founder', 'postsplit', 'threadsplit');
$admincp_actions_normal = array('index', 'setting', 'members', 'profilefields', 'admingroup', 'usergroups',
	'forums', 'threadtypes', 'threads', 'moderate', 'attach', 'smilies', 'recyclebin', 'prune',
	'styles', 'addons', 'plugins', 'tasks', 'magics', 'medals', 'google', 'announce', 'faq', 'ec',
	'tradelog', 'jswizard', 'project', 'counter', 'misc', 'adv', 'logs', 'tools', 'portalperm',
	'checktools', 'search', 'upgrade', 'article', 'block', 'blockstyle', 'portalcategory', 'blogcategory', 'albumcategory', 'topic', 'topic_block', 'credits',
	'doing', 'group', 'blog', 'feed', 'album', 'pic', 'comment', 'share', 'click', 'specialuser', 'postsplit', 'threadsplit', 'report',
	'district', 'diytemplate', 'verify', 'nav', 'domain', 'demo', 'zblunbo', 'collecthddemand', 'actplatform', 'analytic', 'dianping', 'readmodelTravel', 'question', 'readmodelArticle', 'bangdan', 'exam', 'hotlistimg');
if ($_GET['debug'] == 1) {
	error_reporting(E_ALL & ~E_NOTICE);
}
$action = htmlspecialchars(getgpc('action'));
$operation = htmlspecialchars(getgpc('operation'));
$do = htmlspecialchars(getgpc('do'));
$frames = htmlspecialchars(getgpc('frames'));
lang('admincp');
$lang = & $_G['lang']['admincp'];
$page = max(1, intval(getgpc('page')));
$isfounder = $admincp->isfounder;

// 130827 rinne 定义可走控制器流程的菜单项
$GLOBALS['ca'] = array('modules');
// 130827 rinne 定义可走控制器流程的控制器
$ctl = array('commentadmin', 'templateadmin', 'categorysadmin', 'cssadmin');

if ((empty($action) || $frames != null) && empty($_GET['ctl'])) {
	$admincp->show_admincp_main();
} elseif ($action == 'logout') {
	$admincp->do_admin_logout();
	dheader("Location: ./index.php");
} elseif (in_array($action, $admincp_actions_normal) || ($admincp->isfounder && in_array($action, $admincp_actions_founder))) {
	if ($admincp->allow($action, $operation, $do) || $action == 'index') {
		require $admincp->admincpfile($action);
	} else {
		cpheader();
		cpmsg('action_noaccess', '', 'error');
	}
} elseif (in_array($_GET['ctl'], $ctl)) {
	// 定义后台应用
	define('IN_BACKEND', true);

	include(DISCUZ_ROOT . '/source/8264/launcher.php');

	// 启动管理后台
	Launcher::startup(array(
		'ctl_root' => DISCUZ_ROOT . '/source/admincp',
		'external_libs' => array(
			DISCUZ_ROOT . '/source/8264/controller/backend.base.php',
			DISCUZ_ROOT . '/source/8264/controller/plugin.base.php'
		),
	));
} else {
	cpheader();
	cpmsg('action_noaccess', '', 'error');
}
?>
