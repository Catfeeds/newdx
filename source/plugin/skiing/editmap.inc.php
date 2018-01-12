<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/skiing.php';
$tid = $_GET['tid'];
if($tid){
	$ski = ForumOptionSkiing::getskiingEditmapBytId($tid);	
}
include template('skiing:editmap');