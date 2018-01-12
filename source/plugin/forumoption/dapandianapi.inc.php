<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$return = 0;
$arr = array(
	'1' => 'plugin_dpd_dzqd',
	'2' => 'plugin_dpd_zyqd',
	'3' => 'plugin_dpd_dppp',
	'4' => 'plugin_dpd_zhpp',
	'5' => 'plugin_dpd_zhpp',
	'6' => 'plugin_dpd_equi',
	);
if ($_POST && $_G['inajax']) {
	if ($_G['gp_dtype'] < 1 && $_G['gp_dtype'] > 6) {
		echo 0;
		exit;
	}
	//¹Ø±Õ´óÅÌµã
	echo -2;exit;
	$hcount = DB::result_first("SELECT count(*) FROM " . DB::table($arr[$_G['gp_dtype']]) . " WHERE ip = '{$_G[clientip]}' AND dateline > " . ($_G['timestamp'] - 300) . ($_G['gp_dtype'] == 4 || $_G['gp_dtype'] == 5 ? " AND dtype = {$_G[gp_dtype]}" : ""));
	if($hcount > 1){echo -1;exit;}
	switch ($_G['gp_dtype']) {
		case 1:
			$insert_arr = array(
				'name' => $_G['gp_name'],
				'region' => $_G['gp_region'],
				'brandnum' => $_G['gp_brandnum'],
				'brand' => $_G['gp_brand'],
				'revenue' => $_G['gp_revenue'],
				'storenum' => $_G['gp_storenum'],
				'tuiguang' => $_G['gp_tuiguang'],
				);
			break;
		case 2:
			$insert_arr = array(
				'name' => $_G['gp_name'],
				'region' => $_G['gp_region'],
				'brandnum' => $_G['gp_brandnum'],
				'brandarea' => $_G['gp_brandarea'],
				'revenue' => $_G['gp_revenue'],
				'if_online' => $_G['gp_online'],
				'onlinerevenue' => $_G['gp_onlinerevenue'],
				'if_outdoorclub' => $_G['gp_outdoorclub'],
				'outdoorclubname' => $_G['gp_outdoorclubname'],
				'outdoorclubmember' => $_G['gp_outdoorclubmember'],
				);
			break;
		case 3:
			$insert_arr = array(
				'cname' => $_G['gp_cname'],
				'name' => $_G['gp_name'],
				'position' => $_G['gp_position'],
				'tel' => $_G['gp_tel'],
				'email' => $_G['gp_email'],
				'marketshares_type' => $_G['gp_marketshares'],
				'marketsharestrue' => $_G['gp_marketshares_true'],
				'marketsharesrise_type' => $_G['gp_marketsharesrise'],
				'marketsharesrisetrue' => $_G['gp_marketsharesrise_true'],
				'storecount' => $_G['gp_storecount'],
				'contribution' => $_G['gp_contribution'],
				'future' => $_G['gp_future'],
				);
			break;
		case 4:
		case 5:
			$insert_arr = array(
				'dtype' => $_G['gp_dtype'],
				'cname' => $_G['gp_cname'],
				'name' => $_G['gp_name'],
				'position' => $_G['gp_position'],
				'tel' => $_G['gp_tel'],
				'email' => $_G['gp_email'],
				'sales_type' => $_G['gp_sales'],
				'salestrue' => $_G['gp_sales_true'],
				'salesincrease_type' => $_G['gp_salesincrease'],
				'salesincreasetrue' => $_G['gp_salesincrease_true'],
				'storecount_type' => $_G['gp_storecount'],
				'storecounttrue' => $_G['gp_storecount_true'],
				'contribution' => $_G['gp_contribution'],
				'future' => $_G['gp_future'],
				);
			break;
	}
	foreach($insert_arr as $k => $v){
		$insert_arr[$k] = iconv('utf-8', 'gbk', $v);
	}
	require_once libfile('function/misc');
	$city = convertip($_G['clientip']);
	if ($_G['gp_dtype'] == 6) {
		for ($i = 0; $i < 3; $i++) {
			DB::insert($arr[$_G['gp_dtype']], array(
				'name' => iconv('utf-8', 'gbk', $_G['gp_name'][$i]),
				'money' => iconv('utf-8', 'gbk', $_G['gp_money'][$i]),
				'brand' => iconv('utf-8', 'gbk', $_G['gp_brand'][$i]),
				'detail' => iconv('utf-8', 'gbk', $_G['gp_detail'][$i]),
				'reason' => iconv('utf-8', 'gbk', $_G['gp_reason'][$i]),
				'sort' => $i + 1,
				'ip' => $_G['clientip'],
				'dateline' => $_G['timestamp'],
				'uid' => $_G['uid'],
				'username' => $_G['username'],
				'site' => $city,
				));
		}
	} else {
		$insert_arr = array_merge($insert_arr, array(
			'ip' => $_G['clientip'],
			'dateline' => $_G['timestamp'],
			'uid' => $_G['uid'],
			'username' => $_G['username'],
			'site' => $city,
			));
		DB::insert($arr[$_G['gp_dtype']], $insert_arr);
	}
	$return = 1;
}
echo $return;
?>