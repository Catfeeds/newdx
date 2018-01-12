<?php
/*
   [Discuz!] (C)2001-2009 Comsenz Inc.
   This is NOT a freeware, use is subject to license terms

   $Id: connect.php 23006 2011-06-14 02:07:23Z monkey $
*/
if(isset($_GET['mod']) && $_GET['mod'] == 'register') {
    $_GET['mod'] = 'connect';
    $_GET['action'] = 'register';
    require_once 'member.php';
    exit;
}

define('APPTYPEID', 126);
define('CURSCRIPT', 'connect');

require_once './source/class/class_core.php';
require_once './source/plugin/logs/logs.class.php';
require_once './source/function/function_home.php';

$discuz = & discuz_core::instance();

$mod = $discuz->var['mod'];
$discuz->init();
//write current url into session, when error ocurrs, redirect to this url
session_start();
if(strpos($_SERVER['HTTP_REFERER'], 'connect') === false && strpos($_SERVER['HTTP_REFERER'], 'home-task-item-new') === false) {
    $_SERVER['HTTP_REFERER'] ? $_SESSION['connect_referer'] = $_SERVER['HTTP_REFERER'] : false;
}

if(strpos($_SESSION['connect_referer'], 'connect') || strpos($_SESSION['connect_referer'], 'home-task-item-new') || strpos($_SESSION['connect_referer'], 'logout') || strpos($_SESSION['connect_referer'], 'login')) {
    unset($_SESSION['connect_referer']);
}
$_SESSION['connect_referer'] = $_SESSION['connect_referer'] ? $_SESSION['connect_referer'] : 'http://' . $_SERVER['HTTP_HOST'] . '/index.php';
//if user has already logined successfully, redirect
if ($_G['uid']) {

    $referer = $_SESSION['connect_referer'];
    $param = array(
        'username' => $_G['member']['username'],
        'usergroup' => $_G['group']['grouptitle'],
        'uid' => $_G['member']['uid']);
    showmessage('login_succeed', $referer ? $referer : './', $param, array(
        'showdialog' => 1,
        'locationtime' => true,
        'extrajs' => $ucsynlogin));
}

//The third authorization to login
$connect_methods = array('qq', 'sina', 'wechat');
$connect_method = $_REQUEST['method'];
$action = $_REQUEST['action'] ? $_REQUEST['action'] : 'login';

switch ($connect_method) {
    //use 'sina' to do action
    case 'sina':
        $file_path = libfile('sinaconnect/' . $action, 'module');
        if(file_exists($file_path)) {
            $log = new logs('user_signup_record');
            require_once $file_path;
        }
        else {
            exit('weibo connect request error.');
        }
        break;

    //use wechat
    case 'wechat':
        $file_path = libfile('wechatconnect/' . $action, 'module');
        if(file_exists($file_path)) {
            $log = new logs('user_wechat_record');
            require_once $file_path;
        }
        else {
            exit('Wechat connect request error.');
        }
        break;

    //use 'qq' to do action
    default:
        define('IN_CONNECT', 1);
        if(!in_array($mod, array('config', 'login', 'feed'))) {
            showmessage('undefined_action');
        }

        if(!$_G['setting']['connect']['allow']) {
            showmessage('qqconnect_closed');
        }
        $_GET['referer'] = $_SESSION['connect_referer'];

        define('CURMODULE', $mod);
        runhooks();
        /*convert api from discuz to qqzone
        require_once libfile('connect/'.$mod, 'module');
        */
        $log = new logs('user_signup_record');
        require_once libfile('qqconnect/'.$mod, 'module');
        break;
}

?>
