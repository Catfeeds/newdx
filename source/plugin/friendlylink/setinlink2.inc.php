<?php

/**
 * http://www.8264.com/plugin.php?id=friendlylink:setinlink2
 * @author gtl
 * 友情链接后台管理 --- 数据初始化
 * 资讯 1|gp_catid
 * 论坛 2|gp_fid|gp_typeid
 * 点评 3|fid
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require DISCUZ_ROOT.'./config/config_dianping.php';
include_once libfile('function/dianping');
include_once libfile('function/cache');
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/config.inc.php';
require_once DISCUZ_ROOT . './source/plugin/friendlylink/flink.func.php';
$nosetlink = 0;

//线路、户外用品店缓存加载
$cachelist = array(
	'dp_line_region',
	'dp_equipment_brandlist',
	'dp_country_region'
);
loadcache($cachelist);

###########
#数据格式化#
###########

#####################################线路地域信息 494 所在区域 provinceid
$regionList = $_G['cache']['dp_country_region'];
$lineregion = $_G['cache']['dp_line_region'];
$onlypro = $lineregion['onlypro']; //省份加城市
foreach($onlypro as $provinceid=>$areas){
	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$regionList[$provinceid]['cityname']}线路', 'http://www.8264.com/xianlu-0-0-{$provinceid}-0-4-1', '".P_FRIENDLYLINK_DIANPING."|494|provinceid:{$provinceid}', '2', {$nosetlink})";
//	foreach ($areas as $cityid => $cityinfo) {
//		$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '线路', 'http://www.8264.com/xianlu-0-0-{$provinceid}-{$cityid}-4-1', '".P_FRIENDLYLINK_DIANPING."|494|provinceid:{$provinceid}|cityid:{$cityid}', '1', {$nosetlink})";
//	}
}

######################################品牌 408
$nats = $dp_category['brand']['region']; //品牌国籍;
$cps = $dp_category['brand']['ranklist'];  //排行榜;
foreach($nats as $k=>$nat){
	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$nat}户外品牌', 'http://www.8264.com/pinpai-0-{$k}-0-4-1', '".P_FRIENDLYLINK_DIANPING."|408|nat:{$k}', '3', {$nosetlink})";
}
foreach($cps as $k=>$cp){
	$index = strpos($cp, '（');
	$index!==false && ($cp = substr($cp, 0, $index)); //使用不包括括号的内容
	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$cp}', 'http://www.8264.com/pinpai-0-0-{$k}-4-1', '".P_FRIENDLYLINK_DIANPING."|408|cp:{$k}', '3', {$nosetlink})";
}

###################################户外用品库 490
$pcids = $dp_category['equipment']['category']; //装备类型
$bids = $_G['cache']['dp_equipment_brandlist']; //装备品牌
foreach($pcids as $k=>$pcid){
	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$pcid['name']}点评', 'http://www.8264.com/zhuangbei-{$k}-0-0-5-1.html', '".P_FRIENDLYLINK_DIANPING."|490|pcid:{$k}', '2', {$nosetlink})";
	foreach($pcid['child'] as $chlidkey=> $chlid){
		$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$chlid}点评', 'http://www.8264.com/zhuangbei-{$k}-{$chlidkey}-0-5-1.html', '".P_FRIENDLYLINK_DIANPING."|490|pcid:{$k}|cid:{$chlidkey}', '1', {$nosetlink})";
	}
}
//foreach($bids as $k=>$bid){
//	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '点评{$bid['subject']}', 'http://www.8264.com/zhuangbei-0-0-{$k}-5-1.html', '".P_FRIENDLYLINK_DIANPING."|490|bid:{$k}', '1', {$nosetlink})";
//}

$sql = "INSERT INTO " . DB::table('common_friendlink2_inlink') . "(`group`, `keyword`, `url`, `identifie`, `weight`, `setinlink`) VALUES".  implode($insert_data, ',');
if($_GET['type'] == 1){
	print_r($insert_data);
}else{
	echo $sql;
}

//$query = DB::query($sql);
//
//var_dump($query);
