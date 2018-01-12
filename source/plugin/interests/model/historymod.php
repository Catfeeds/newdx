<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

class historymod{
	const _TABLE					= 'pre_plugin_linehistory';
	const _TABLE_NOPRE				= 'plugin_linehistory';
	const _TIME						= 'htime';
	const _UID						= 'uid';
	const _IP						= 'ip';
	const _LINEID					= 'lid';
	const _LINEPOS					= 'lpos';
	const _USERSELECT				= 'ustatus';
	const _USERSELECTNAME			= 'ustatusname';
	const _ID						= 'hid';
	public static $statusnamearr 	= array(
										0 => '忽略通知',
										1 => '点击链接',
										2 => '进入通知');
	
	public static function recordhistory($uid, $lid, $ip, $pos, $status = 1){
		$insertarr = array(
						//self::_ID => self::createId($uid, $pos, $lid),
						self::_UID => $uid,
						self::_IP => $ip,
						self::_LINEID => $lid,
						self::_USERSELECT => $status,
						self::_LINEPOS => $pos,
						self::_TIME => time());
		try{
			$insertid = DB::insert(self::_TABLE_NOPRE, $insertarr, true);
			if($insertid > 0){
				dsetcookie("hidden_line_id_" . $lid, 1, 3 * 3600);
			}
			if($status == 0){
				require_once libfile('class/myredis');
				$todayend = strtotime('today') + 24*3600;
				$myredis = myredis::instance(6382);
				$myredis->hashdel('plugin_lineinfo_' . $pos . '_time_' . $todayend, $uid);
			}
		}catch(Exception $e){
			
		}
		//echo $insertid;
	}
	
	public static function createId($uid, $pos, $lineid){
		return "U" . $uid . "_P" . $pos . "_L" . $lineid;
	}
	
	public static function getClickedCount($lidarr = array(), $clicked = true){
		$return = array();
		if($lidarr){
			$q = DB::query("SELECT count(*) AS count, " . self::_LINEID . " FROM " . self::_TABLE . " WHERE `" . self::_USERSELECT . "` = " . ($clicked ? 1 : 2) . " AND `" . self::_LINEID . "` IN(" . implode(',', $lidarr) . ") GROUP BY `" . self::_LINEID . "`");
			while($v = DB::fetch($q)){
				$return[$v[self::_LINEID]] = $v['count'];
			}
		}
		return $return;
	}
	public static function getAllCount($lidarr = array()){
		$return = array();
		if($lidarr){
			$q = DB::query("SELECT count(*) AS count, " . self::_LINEID . " FROM " . self::_TABLE . " WHERE `" . self::_LINEID . "` IN(" . implode(',', $lidarr) . ") GROUP BY `" . self::_LINEID . "`");
			while($v = DB::fetch($q)){
				$return[$v[self::_LINEID]] = $v['count'];
			}
		}
		return $return;
	}
}