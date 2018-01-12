<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$include_path = dirname(__file__).'/admincp_category/index.php';

if ($_GET['op']=='new') {
	$include_path = dirname(__file__).'/admincp_category/new.php';
} elseif ($_GET['op']=='edit') {
	$include_path = dirname(__file__).'/admincp_category/edit.php';
} elseif ($_GET['op']=='del') {
	$include_path = dirname(__file__).'/admincp_category/del.php';
}

include $include_path;
