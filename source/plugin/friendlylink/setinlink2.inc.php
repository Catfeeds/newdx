<?php

/**
 * http://www.8264.com/plugin.php?id=friendlylink:setinlink2
 * @author gtl
 * �������Ӻ�̨���� --- ���ݳ�ʼ��
 * ��Ѷ 1|gp_catid
 * ��̳ 2|gp_fid|gp_typeid
 * ���� 3|fid
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

//��·��������Ʒ�껺�����
$cachelist = array(
	'dp_line_region',
	'dp_equipment_brandlist',
	'dp_country_region'
);
loadcache($cachelist);

###########
#���ݸ�ʽ��#
###########

#####################################��·������Ϣ 494 �������� provinceid
$regionList = $_G['cache']['dp_country_region'];
$lineregion = $_G['cache']['dp_line_region'];
$onlypro = $lineregion['onlypro']; //ʡ�ݼӳ���
foreach($onlypro as $provinceid=>$areas){
	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$regionList[$provinceid]['cityname']}��·', 'http://www.8264.com/xianlu-0-0-{$provinceid}-0-4-1', '".P_FRIENDLYLINK_DIANPING."|494|provinceid:{$provinceid}', '2', {$nosetlink})";
//	foreach ($areas as $cityid => $cityinfo) {
//		$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '��·', 'http://www.8264.com/xianlu-0-0-{$provinceid}-{$cityid}-4-1', '".P_FRIENDLYLINK_DIANPING."|494|provinceid:{$provinceid}|cityid:{$cityid}', '1', {$nosetlink})";
//	}
}

######################################Ʒ�� 408
$nats = $dp_category['brand']['region']; //Ʒ�ƹ���;
$cps = $dp_category['brand']['ranklist'];  //���а�;
foreach($nats as $k=>$nat){
	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$nat}����Ʒ��', 'http://www.8264.com/pinpai-0-{$k}-0-4-1', '".P_FRIENDLYLINK_DIANPING."|408|nat:{$k}', '3', {$nosetlink})";
}
foreach($cps as $k=>$cp){
	$index = strpos($cp, '��');
	$index!==false && ($cp = substr($cp, 0, $index)); //ʹ�ò��������ŵ�����
	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$cp}', 'http://www.8264.com/pinpai-0-0-{$k}-4-1', '".P_FRIENDLYLINK_DIANPING."|408|cp:{$k}', '3', {$nosetlink})";
}

###################################������Ʒ�� 490
$pcids = $dp_category['equipment']['category']; //װ������
$bids = $_G['cache']['dp_equipment_brandlist']; //װ��Ʒ��
foreach($pcids as $k=>$pcid){
	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$pcid['name']}����', 'http://www.8264.com/zhuangbei-{$k}-0-0-5-1.html', '".P_FRIENDLYLINK_DIANPING."|490|pcid:{$k}', '2', {$nosetlink})";
	foreach($pcid['child'] as $chlidkey=> $chlid){
		$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '{$chlid}����', 'http://www.8264.com/zhuangbei-{$k}-{$chlidkey}-0-5-1.html', '".P_FRIENDLYLINK_DIANPING."|490|pcid:{$k}|cid:{$chlidkey}', '1', {$nosetlink})";
	}
}
//foreach($bids as $k=>$bid){
//	$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '����{$bid['subject']}', 'http://www.8264.com/zhuangbei-0-0-{$k}-5-1.html', '".P_FRIENDLYLINK_DIANPING."|490|bid:{$k}', '1', {$nosetlink})";
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
