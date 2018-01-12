<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$include_path = dirname(__file__).'/admincp/index.php';

if ($_GET['op']=='option') {
	$include_path = dirname(__file__).'/admincp/option.php';
} elseif ($_GET['op']=='newop') {
	$include_path = dirname(__file__).'/admincp/newoption.php';
} elseif ($_GET['op']=='editop') {
	$include_path = dirname(__file__).'/admincp/editoption.php';
} elseif ($_GET['op']=='delop') {
	$include_path = dirname(__file__).'/admincp/deloption.php';
}

include $include_path;

?>
