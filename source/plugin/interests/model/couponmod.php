<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

class couponmod{
	const TABLE_NAME		= 'pre_plugin_linecoupon';
	const TABLE_NAME_NO_PRE	= 'plugin_linecoupon';
	const _ID				= 'coid';
	const _UID				= 'uid';
	const _COUPON_ID		= 'copid';
	const _COUPON_NUMBER	= 'snnumber';
	const _TIME_END			= 'enddate';
	const _TIME_CREATE		= 'createdate';
	const _URL				= 'url';
	const _NAME				= 'name';
	const _MONEY			= 'money';
	const _ZAIWAIID			= 'zaiwaiid';
	const _TIME_TOUSER		= 'tousertime';
	const _USED				= 'ifused';
	/*API KEY INDEX*/
	const API_ID			= 'id';
	const API_URL			= 'url';
	const API_NAME			= 'goods_name';
	const API_CODE			= 'cut_code';
	const API_PRICE			= 'cut_price';
	const API_DATE_END		= 'start_date';
	const API_GOODSID		= 'goods_id';
	/*REDIS CACHE NAME*/
	const CACHE_KEY_REDIS	= 'plugin_coupon_list|queue';
	
	public static function insertCoupon($coupon, $timeend, $url, $name, $money, $copid, $goodsid){
		$insertarr = array(
						self::_COUPON_NUMBER => $coupon,
					 	self::_TIME_END => $timeend,
						self::_TIME_CREATE => time(),
						self::_URL => $url,
						self::_NAME => $name,
						self::_MONEY => $money,
						self::_COUPON_ID => $copid,
						self::_ZAIWAIID => $goodsid);
		return DB::insert(self::TABLE_NAME_NO_PRE, $insertarr);
	}
	public static function sendtouser($couponid, $uid){
		$updatearr = array(self::_UID => $uid, self::_TIME_TOUSER => time());
		$wherearr = array(self::_ID => $couponid);
		DB::update(self::TABLE_NAME_NO_PRE, $updatearr, $wherearr);
		return DB::affected_rows();
	}
	public static function refreshCoupon($goodsid){
		require_once libfile('class/myredis');
		$myredis = myredis::instance(6382);
		$keyname = self::CACHE_KEY_REDIS . "|goodsid_" . $goodsid;
		$myredis->EXPIRE($keyname, 0);
		$q = DB::query("SELECT " . self::_COUPON_ID . " FROM " . self::TABLE_NAME . " WHERE `" . self::_UID . "` = 0 AND `" . self::_ZAIWAIID .  "` = {$goodsid}");
		while($v = DB::fetch($q)){
			$myredis->RPUSH($keyname, $v[self::_COUPON_ID]);
		}
	}
	public static function getIfUserCouponSend($zaiwaiid, $uid){
		 return DB::fetch_first("SELECT * FROM " . self::TABLE_NAME . " WHERE `" . self::_UID . "` = {$uid} AND `" . self::_ZAIWAIID . "` = {$zaiwaiid} LIMIT 1");
	}
	public static function getOneCoupon($goodsid){
		require_once libfile('class/myredis');
		$myredis = myredis::instance(6382);
		$keyname = self::CACHE_KEY_REDIS . "|goodsid_" . $goodsid;
		$couponid = $myredis->LPOP($keyname);
		$couponarr = array();
		if($couponid > 0){
			$couponarr = DB::fetch_first("SELECT * FROM " . self::TABLE_NAME . " WHERE `" . self::_COUPON_ID . "` = {$couponid}");			
		}
		return $couponarr ? $couponarr : array();
	}
}