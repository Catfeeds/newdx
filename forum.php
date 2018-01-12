<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum.php 16805 2010-09-15 03:56:11Z zhangguosheng $
 */
define('APPTYPEID', 2);
define('CURSCRIPT', 'forum');
require_once './banip.php';
//require("./external/fb.ext.php");
require './source/class/class_core.php';
require './source/function/function_forum.php';
$discuz = & discuz_core::instance();

$modarray = array('ajax', 'announcement', 'attachment', 'forumdisplay', 'dianping',
	'group', 'image', 'index', 'medal', 'misc', 'modcp', 'notice', 'post', 'redirect',
	'relatekw', 'relatethread', 'rss', 'topicadmin', 'trade', 'viewthread', 'picture', 'readmodeltravel', 'readmodelarticle','bbs_new'
);

$modcachelist = array(
	'index'		=> array('announcements', 'onlinelist', 'advs_index',
			'heats', 'historyposts', 'onlinerecord', 'userstats'),
        'bbs_new'       => array('announcements', 'onlinelist', 'advs_index',
			'heats', 'historyposts', 'onlinerecord', 'userstats'),
	'forumdisplay'	=> array('smilies', 'announcements_forum', 'globalstick', 'forums',
			'icons', 'onlinelist', 'forumstick','threadtable_info', 'threadtableids', 'stamps'),
	'viewthread'	=> array('smilies', 'smileytypes', 'forums', 'usergroups', 'ranks',
			'stamps', 'bbcodes', 'smilies',	'custominfo', 'groupicon', 'stamps',
			'threadtableids', 'threadtable_info'),
	'post'		=> array('bbcodes_display', 'bbcodes', 'smileycodes', 'smilies', 'smileytypes',
			'icons', 'domainwhitelist'),
	'space'		=> array('fields_required', 'fields_optional', 'custominfo'),
	'group'		=> array('grouptype'),
);


$mod = !in_array($discuz->var['mod'], $modarray) ? 'index' : $discuz->var['mod'];

define('CURMODULE', $mod != 'redirect' ? $mod : 'viewthread');
$cachelist = array();
if (isset($modcachelist[CURMODULE])) {
	$cachelist = $modcachelist[CURMODULE];
}
if ($discuz->var['mod'] == 'group') {
	$_G['basescript'] = 'group';
}

$discuz->cachelist = $cachelist;
$discuz->init();
loadforum();
set_rssauth();
runhooks();

$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['forum']);

//{20110126 edit by wufujun
dsetcookie('editormode_e','-1');
//}

// 便于页面白板时调试使用
if ($_GET['debug'] == 1) {
	error_reporting(E_ALL & ~E_NOTICE);
}
$_G[tid] = $_G['gp_tid'];
$ctl = array('skiing', 'comment', 'template', 'equipment', 'brand', 'line', 'mountain','shop', 'climb','diving','fishing','club','hostel','chain');
if (in_array($_GET['ctl'], $ctl)) {

	// 平台参数
	$module = $_GET['pf'] ? trim($_GET['pf']) : 'forum';
	// 默认平台
	$ctl_root = "/source/module/{$module}";
	// 应用基类
	$base_path = "/{$module}.base.php";
	// 各平台控制器根路径
	define('CTL_ROOT', DISCUZ_ROOT . "/source/module/{$module}");
	// 定义控制器根路径，区分插件作用域
	define('IN_' . strtoupper($module), true);

	include(DISCUZ_ROOT . '/source/8264/launcher.php');
	Launcher::startup(array(
		'ctl_root' => DISCUZ_ROOT . $ctl_root,
		'external_libs' => array(
			DISCUZ_ROOT . '/source/8264/controller/frontend.base.php',
			DISCUZ_ROOT . '/source/8264/controller/plugin.base.php',
			DISCUZ_ROOT . $ctl_root . $base_path,
		)
	));
} else {
	//if(! in_array($mod, array('dianping')) || ! in_array($_G['fid'], $_G['config']['fids'])){
	if (file_exists(DISCUZ_ROOT.'./source/plugin/forumoption/include.php')) {
		include_once DISCUZ_ROOT.'./source/plugin/forumoption/include.php';
	}
	//判断文件是否存在（20110627 edit by zhanghongliang）
	if(file_exists('./source/plugin/domainset/indomain.php')){
		require './source/plugin/domainset/indomain.php';
	}

	//判断是否由手机访问（20140728 edit by lishuaiquan）
	$useragent   = strtolower($_SERVER['HTTP_USER_AGENT']);
	$isphone     = strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false || strpos($useragent, 'android') !== false || strpos($useragent, 'windows phone') !== false ? true : false;

	if (empty($_COOKIE["goWebFromM"]) && $isphone) {
		$noCycleCateList = array("490"=>"装备库","408"=>"户外品牌排行榜","493"=>"驴友商城","467"=>"巅峰领队嘉园","43"=>"版主中心","42"=>"视频|下载");
		$url = "";
		if ($mod == "index") {
			$url = "{$_G['config']['web']['mobile']}bbs";
		}

		$_G['gp_page']   	= max(intval($_G['gp_page']), 1);
		if ($mod == "forumdisplay" && $_G['forum']['status'] != 3 && !isset($noCycleCateList[$_G['gp_fid']])) {
			$_G['gp_fid'] 	 	= max(intval($_G['gp_fid']), 0);
			$_G['gp_typeid'] 	= max(intval($_G['gp_typeid']), 0);
			$_G['gp_digest'] 	= max(intval($_G['gp_digest']), 0);
			$_G['gp_filter'] 	= !empty($_G['gp_filter']) ? $_G['gp_filter'] : ($_G['gp_typeid'] ? 'typeid' : '');
			$_G['gp_orderby'] 	= !empty($_G['gp_orderby']) ? $_G['gp_orderby'] : 'lastpost';
			$url = empty($_G['gp_filter']) ? "{$_G['config']['web']['mobile']}bbs-{$_G['gp_fid']}-{$_G['gp_page']}.html" : "{$_G['config']['web']['mobile']}bbs-{$_G['gp_fid']}-{$_G['gp_filter']}-{$_G['gp_orderby']}-{$_G['gp_typeid']}-{$_G['gp_digest']}-{$_G['gp_specialtype']}-{$_G['gp_page']}.html";
		}
		if ($mod == "viewthread" && $_G['forum']['status'] != 3) {
			$_G['gp_tid']  		= max(intval($_G['gp_tid']), 0);
                        $_G['gp_taskid']  		= max(intval($_G['gp_taskid']), 0);
                        $_G['gp_zhuzhanuser'] = max(intval($_G['gp_zhuzhanuser']), 0);
			$_G['gp_authorid']  = max(intval($_G['gp_authorid']), 0);
                        if($_G['gp_taskid']){
                            $url = "{$_G['config']['web']['mobile']}thread-{$_G['gp_tid']}-{$_G['gp_page']}.html?iszhuzhan=1&taskid={$_G['gp_taskid']}&zhuzhanuser={$_G['gp_zhuzhanuser']}";
                        }else{
                            $url = empty($_G['gp_authorid']) ? "{$_G['config']['web']['mobile']}thread-{$_G['gp_tid']}-{$_G['gp_page']}.html" : "{$_G['config']['web']['mobile']}thread-{$_G['gp_tid']}-{$_G['gp_page']}-{$_G['gp_authorid']}.html";
                        }

		}

		if (!empty($url)) {
			header("Location:{$url}");
			exit();
		}
	}
	require DISCUZ_ROOT.'./source/module/forum/forum_'.$mod.'.php';
}
?>
