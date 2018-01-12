<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

require_once DISCUZ_ROOT . './source/plugin/interests/model/linemod.php';
$todaytime = strtotime('today');
$todayline = linemod::getDayLine($todaytime, $pos);
if(!$todayline){
	/*如果今日没有线路推送，就不获取任何优惠码*/
	exit;
}
$zaiwaiids = array();
foreach($todayline as $_v){
	$zaiwaiids[] = $_v[linemod::_GOODSID];
}
$hashbase = "$41%aT#@G13C6HA0aNa1^3";
$nowtime = time();
$sendhash = "&hash=" . md5($nowtime.$hashbase.$nowtime) . "&time=" . $nowtime;
$apiurl = "http://m.zaiwai.com/?app=api&act=getCouponList" . $sendhash;
$resultcontent = dfsockopen($apiurl);
$resultcontent = json_decode($resultcontent, true);
define('SEARCH_MAX', 30);
if($resultcontent){
	require_once DISCUZ_ROOT . "./source/plugin/interests/model/couponmod.php";
	$tmpcouponlist = $resultcontent;
	$sqlarr = $tmp = array();
	$i = 0;
	foreach($resultcontent as $k => $val){
		$i++;
		if($val[couponmod::API_GOODSID] > 0){
			$tmp[] = $val[couponmod::API_ID];
			if($i >= SEARCH_MAX){
				$sql = "SELECT " . couponmod::_COUPON_ID . " FROM " . couponmod::TABLE_NAME . " WHERE `" . couponmod::_COUPON_ID . "` IN(" . implode(',', $tmp) . ")";
				$q = DB::query($sql);
				$tmp = array();
				$i = 0;
				while($v = DB::fetch($q)){
					$exists[] = $v[couponmod::_COUPON_ID];
				}
			}
		}else{
			unset($tmpcouponlist[$k]);
		}
	}
	if($tmp){
		$sql = "SELECT " . couponmod::_COUPON_ID . " FROM " . couponmod::TABLE_NAME . " WHERE `" . couponmod::_COUPON_ID . "` IN(" . implode(',', $tmp) . ")";
		$q = DB::query($sql);
		$tmp = array();
		$i = 0;
		while($v = DB::fetch($q)){
			$exists[] = $v[couponmod::_COUPON_ID];
		}
	}
	foreach($resultcontent as $k => $val){
		if(in_array($val[couponmod::API_ID], $exists)){
			unset($tmpcouponlist[$val[couponmod::API_ID]]);
		}
	}
	if($tmpcouponlist){
		foreach($tmpcouponlist as $kk => $vv){
			couponmod::insertCoupon($vv[couponmod::API_CODE], $vv[couponmod::API_DATE_END], $vv[couponmod::API_URL], iconv('utf-8', 'gbk', $vv[couponmod::API_NAME]), $vv[couponmod::API_PRICE], $vv[couponmod::API_ID], $vv[couponmod::API_GOODSID]);
			//$allgoods[] = $vv[couponmod::API_GOODSID];
		}
	}
	if($zaiwaiids){
		foreach($zaiwaiids as $_tmpid){
			couponmod::refreshCoupon($_tmpid);
		}
	}	
}
/*获取使用的优惠券*/
$apiurl = "http://m.zaiwai.com/?app=api&act=getUsedCouponList";
$resultcontent = dfsockopen($apiurl);
$resultcontent = json_decode($resultcontent, true);
if($resultcontent){
	$updateid = array();
	foreach($resultcontent as $vv){
		$updateid[] = $vv['id'];
	}
	if($updateid){
		require_once DISCUZ_ROOT . "./source/plugin/interests/model/couponmod.php";
		DB::query("UPDATE " . couponmod::TABLE_NAME . " SET `" . couponmod::_USED . "` = 1 WHERE `" . couponmod::_COUPON_ID . "` IN(" . implode(',', $updateid) . ")");
	}
}
