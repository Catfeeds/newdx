<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/brand/brandusers.php';

$tid = $_GET['tid'];
$type = $_GET['type'];

$products = BrandUsers::getProductsByTidinNew($tid);
if($products==NULL){
	showmessage('此品牌不包含产品信息,无效点击',NULL);exit;
}
$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (!$_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (!$_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

if ($type == 'using') {
	include template('brand:using');
} else {
	include template('brand:productselect');
}
