<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$view = (!empty($_GET['view']) && in_array($_GET['view'], array('userapp')))?$_GET['view']:'notice';
if(!$_G['newtpl'] || $view == 'userapp'){
	include_once 'space_notice_old.php';
	die();
}
include template('home/space_notice_new');