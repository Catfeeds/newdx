<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: question.php 16805 2010-09-15 03:56:11Z zhangguosheng $
 */

if($_SERVER['HTTP_HOST']!='www.8264.com'){
	header('Location: http://www.8264.com'.$_SERVER['REQUEST_URI']);
	die;
}
require_once './banip.php';


define('APPTYPEID', 7);
define('CURSCRIPT', 'question');
//require("./external/fb.ext.php");
require './source/class/class_core.php';
require './source/function/function_forum.php';
$discuz = & discuz_core::instance();

$discuz->init();


$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['question']);


//{20110126 edit by wufujun
dsetcookie('editormode_e','-1');
//}

// ����ҳ��װ�ʱ����ʹ��
if ($_GET['debug'] == 1) {
	error_reporting(E_ALL & ~E_NOTICE);
}
$ctl = array('answer','topic');
if (in_array($_GET['ctl'], $ctl)) {
	// ƽ̨����
	$module = $_GET['pf'] ? trim($_GET['pf']) : 'question';
	// Ĭ��ƽ̨
	$ctl_root = "/source/module/{$module}";
	// Ӧ�û���
	$base_path = "/{$module}.base.php";
	// ��ƽ̨��������·��
	define('CTL_ROOT', DISCUZ_ROOT . "/source/module/{$module}");
	// �����������·�������ֲ��������
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
	echo 'CTL_ERROR!';
}
?>
