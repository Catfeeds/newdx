<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';

$tid = $_GET['tid'];
$uid = $_G['uid'];

$pro = ForumOptionProduce::getProduceLxbytid($tid);
$record = ForumOptionProduce::getRecordByTid($tid);

include template('produce:rankpanel');
