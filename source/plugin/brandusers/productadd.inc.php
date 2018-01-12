<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$tid = $_GET['tid'];
$type = $_GET['type'];

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (!$_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (!$_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

include template('brandusers:productadd');
