<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      ����ϵͳ
 *      $Id: exam.php 2016-10-15 zhangwenchu $
 */


if($_SERVER['HTTP_HOST']!='www.8264.com'){
	header('Location: http://www.8264.com'.$_SERVER['REQUEST_URI']);
	die;
}




require_once './banip.php';

define('APPTYPEID', 0);
define('CURSCRIPT', 'exam');
//require("./external/fb.ext.php");
require './source/class/class_core.php';
require './source/function/function_core.php';
require './source/function/function_forum.php';
$discuz = & discuz_core::instance();
$discuz->init();

//if( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == true && $_GET['wx'] == 1 ){
//	if($_GET['openid'] && $_GET['sign'] && $_GET['sign'] == md5($_GET['unionid']."8264") ){
//        $wechat_user = array(
//            'openid' => $_GET['openid'],
//            'nickname' => diconv($_GET['nickname'], "utf-8", "gbk"),
//            'unionid' => $_GET['unionid']
//        );
//		dsetcookie("wechat_user_unionid", $_GET['unionid'], 86400*30);
//		dsetcookie("wechat_user_openid", $_GET['openid'], 86400*30);
//		dsetcookie("wechat_user_nickname", diconv($_GET['nickname'], "utf-8", "gbk"), 86400*30);
//	}else{
//		$wechat_user_unionid = getcookie("wechat_user_unionid");
//		if(!$wechat_user_unionid){
//            header('Location: http://front.qunawan.com/index.php?d=front&c=authorization_8264&m=index_test&item=exam_8264');
//			die;
//		}
//	}
//
//	header('Location: http://www.8264.com/xuexiao/');
//	die;
//}

//$openid = getcookie("8264_openid");
//echo $openid;

$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['question']);

// ����ҳ��װ�ʱ����ʹ��
if ($_GET['debug'] == 1) {
	error_reporting(E_ALL & ~E_NOTICE);
}
$ctl = array('topic');
if (in_array($_GET['ctl'], $ctl)) {
	// ƽ̨����
	$module = $_GET['pf'] ? trim($_GET['pf']) : 'exam';
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
