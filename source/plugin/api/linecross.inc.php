<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
set_time_limit(0);

require_once DISCUZ_ROOT.'./source/plugin/dianping/dianping.fun.php';

$mdLinecross   = m("linecross");
$mdLine		   = m("line");

$lineList = $mdLine->find(array('conditions' => "isPublish = 1"), false);
foreach ($lineList as $v) {
	echo "<br/>".$v["tid"];
	$lineCrossList = $mdLinecross->getDataByTid($v["tid"]);
	
	//���¾�����·
	$mdLinecross->updateLtype($v["tid"],1);
	if (empty($lineCrossList)) {
		return false;
	}			
	$mdLine->setRegionNum($lineCrossList, $mdLinecross);	
}

