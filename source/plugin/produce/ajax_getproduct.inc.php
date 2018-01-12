<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';

$condition = array();
if (!empty($_GET['brand'])) {
    $condition['brand'] = $_GET['brand'];
}
if (!empty($_GET['type'])) {
    $condition['type'] = $_GET['type'];
}

if (!empty($_GET['orderby'])) {
    $orderby = $_GET['orderby']." DESC";
} else {
    $orderby = 't.dateline DESC';
}

if (!empty($_GET['limit'])) {
    $limit = $_GET['limit'];
}

if (!empty($_GET['isdefault'])) {
	$array = ForumOptionProduce::getProductListDefault($limit);
} else {
	$array = ForumOptionProduce::getProductList($condition, $orderby, $limit);
}

foreach($array as $i => $item) {
	$array[$i]['author'] = mb_convert_encoding($array[$i]['author'], 'UTF-8', 'GBK');
	$array[$i]['subject'] = mb_convert_encoding($array[$i]['subject'], 'UTF-8', 'GBK');
	$array[$i]['message'] = mb_convert_encoding($array[$i]['message'], 'UTF-8', 'GBK');
}
echo json_encode($array);
