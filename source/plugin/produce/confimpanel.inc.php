<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$prid = $_GET['prid'];
$puid = $_GET['puid'];

include template('produce:confimpanel');
