<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';
$include_path = dirname(__file__).'/admincp/recommend/index.php';

if ($_GET['op']=='option') {
	$include_path = dirname(__file__).'/admincp/recommend/option.php';
} elseif ($_GET['op']=='newop') {
	$include_path = dirname(__file__).'/admincp/recommend/newoption.php';
} elseif ($_GET['op']=='editop') {
	$include_path = dirname(__file__).'/admincp/recommend/editoption.php';
} elseif ($_GET['op']=='delop') {
	$include_path = dirname(__file__).'/admincp/recommend/deloption.php';
}


include $include_path;
