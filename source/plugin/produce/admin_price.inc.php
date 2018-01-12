<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';
$include_path = dirname(__file__).'/admincp/price/index.php';

if ($_GET['op']=='option') {
	$include_path = dirname(__file__).'/admincp/price/option.php';
} elseif ($_GET['op']=='urllist') {
	$include_path = dirname(__file__).'/admincp/price/urllist.php';
} elseif ($_GET['op']=='editop') {
	$include_path = dirname(__file__).'/admincp/price/editoption.php';
} elseif ($_GET['op']=='delop') {
	$include_path = dirname(__file__).'/admincp/price/deloption.php';
}

include $include_path;
