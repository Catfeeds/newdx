<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

class linemod{
	/*define TABLENAME*/
	const TABLE_NAME		= 'pre_plugin_linemodel';
	const TABLE_NAME_NOPRE	= 'plugin_linemodel';
	/*define COLUMN*/
	const _ID				= 'lid';
	const _NAME				= 'linename';
	const _URL				= 'lineurl';
	const _TIME_START		= 'timestart';
	const _TIME_USED		= 'timeuse';
	const _TIME_CREATE		= 'dateline';
	const _TIME_BEFORE		= 'timebefore';
	const _TIME_LAST		= 'timelast';
	const _STATUS			= 'status';
	const _POS				= 'pos';
	const _GOODSID			= 'goodsid';
	const _FID				= 'fid';
	/*show name not in database*/
	const _POS_NAME			= 'posshowname';
	const _STATUS_NAME		= 'statusshowname';
	const _FID_NAME			= 'fidname';
	/*pos type*/
	public static $pos_type = array(1 => '通知页', 2 => '首页');
	/*status type*/
	public static $status_type = array(0 => '未审核', 1 => '开启中', 2 => '已过期', 3 => '已续期');
	/*设置推送时间在报名前几天*/
	public static $tuisongday = array();
	
	public static function getAllLine($limit, $start, $orderby = "", $where = ""){
		$return  = array();
		$sql = "SELECT * FROM " . self::TABLE_NAME . ($where ? " WHERE {$where}" : " ") . ($orderby ? " ORDER BY {$orderby} " : " ") . " LIMIT {$start}, {$limit}";
		$q = DB::query($sql);
		while($v = DB::fetch($q)){
			$v[self::_POS_NAME] = self::$pos_type[$v[self::_POS]];
			$v[self::_STATUS_NAME] = self::$status_type[$v[self::_STATUS]];
			if($v[self::_FID]){
				$tmpfidarr[] = $v[self::_FID];
			}
			$return[$v[self::_ID]] = $v;
		}
		if($tmpfidarr){
			$sql = "SELECT fid, name FROM " . DB::table('forum_forum') . " WHERE fid IN(" . implode($tmpfidarr, ',') . ") " . getSlaveID();
			$q = DB::query($sql);
			$fidarr = array();
			while($v = DB::fetch($q)){
				$fidarr[$v['fid']] = $v['name'];
			}
			foreach($return as $k => $v){
				$return[$k][self::_FID_NAME] = $fidarr[$v[self::_FID]];
			}
		}
		return $return;
	}
	
	public static function getMyLine($pos = 1){
		$return = array();
		//$tmp = DB::fetch_first("SELECT " . self::_ID . " FROM " . self::TABLE_NAME . " WHERE `" . self::_STATUS . "` = 1 AND `" . self::_TIME_START . "` >= " . time() + )		
		return $return;
	}
	
	public static function getMaxCount(){
		$return = DB::result_first("SELECT count(*) FROM " . self::TABLE_NAME . " " . getSlaveID());
		return intval($return);
	}
	
	public static function getDayLine($daystarttime, $pos = 1, $fid = 102){
		if($pos == 'all'){
			$where = "";
		}else{
			$pos = intval($pos);
			$pos = array_key_exists($pos, self::$pos_type) ? $pos : 1;
			$where = "`" . self::_FID . "` = {$fid} AND `" . self::_POS . "` = {$pos} AND `" . self::_STATUS . "` = 1 AND ";
		}
		if(self::$tuisongday){
			$timearr = array();
			foreach(self::$tuisongday as $_tday){
				$timearr[] = ($daystarttime + $_tday * 24 * 3600);
			}
			$where .= "`" . self::_TIME_LAST . "` IN(" . implode(',', $timearr) . ")";
		}else{
			$where .= "`" . self::_TIME_LAST . "` >= " . $daystarttime;
		}
		return self::getAllLine(100, 0, "", $where);
	}
}

?>