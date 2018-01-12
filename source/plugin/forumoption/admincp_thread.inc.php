<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$include_path = dirname(__file__).'/admincp_thread/index.php';

if ($_GET['op']=='option') {
	$include_path = dirname(__file__).'/admincp_thread/option.php';
} elseif ($_GET['op']=='newop') {
	$include_path = dirname(__file__).'/admincp_thread/newoption.php';
} elseif ($_GET['op']=='editop') {
	$include_path = dirname(__file__).'/admincp_thread/editoption.php';
} elseif ($_GET['op']=='delop') {
	$include_path = dirname(__file__).'/admincp_thread/deloption.php';
}

include $include_path;
