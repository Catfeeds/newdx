<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';
$forumoption_mudidi->forceRefreshCache = true;
$scapetypes = $forumoption_mudidi->getScapetype();

if (isset($_GET['tid'])) {
	$type = 1;
	$typeid = $_GET['tid'];
} elseif (isset($_GET['blogid'])) {
	$type = 2;
	$typeid = $_GET['blogid'];
}

include template('whither:pubguide');