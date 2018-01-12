<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$tid = $_GET['tid'];
$uid = $_GET['uid'];

include template('produce:addpanel');
