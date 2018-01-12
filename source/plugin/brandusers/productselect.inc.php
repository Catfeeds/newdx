<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/brandusers/brandusers.php';

$tid = $_GET['tid'];
$type = $_GET['type'];

$products = BrandUsers::getProductsByTidinNew($tid);

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (!$_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (!$_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

if ($type == 'using') {
	include template('brandusers:using');
} else {
	include template('brandusers:productselect');
}
