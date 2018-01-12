<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';


if (!empty($_GET['limit'])) {
    $limit = $_GET['limit'];
}
if (!empty($_GET['uid'])) {
    $uid = $_GET['uid'];
}
if (!empty($_GET['type'])) {
    $view = $_GET['type'];
}
$array = ForumOptionProduce::getProduceAtHome($limit,$uid);

/*if($view!='me'){
$array = ForumOptionProduce::getProduceAtHomeByType($limit,$uid,$view);
}else {

}*/
foreach($array as $i => $item) {
	$array[$i]['subject'] = mb_convert_encoding($array[$i]['subject'], 'UTF-8', 'GBK');
}
echo json_encode($array);
