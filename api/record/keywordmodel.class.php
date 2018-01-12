<?php

/**
 * @author JiangHong
 * @copyright 2015
 * 用户访问的热门分词模型
 */

class keywordmodel
{
	const _TABLENAME			= 'pre_plugin_browsekeyword';
	const _TABLENAME_NOPRE		= 'plugin_browsekeyword';
	const _ID					= 'kid';
	const _UID					= 'uid';
	const _PROVINCE				= 'province';
	const _CITY					= 'city';
	const _IP					= 'ip';
	/*此HASH为 agent ip uid的hash 用于登陆用户的精确推送*/
	/**
	 * @deprecated 此字段已经删除，不再使用
	 */
	const _HASHA				= 'khash';
	/*此HASH为 agent ip 的hash，用于未登陆用户的推送*/
	/**
	 * @deprecated 此字段已经删除，不再使用
	 */
	const _HASHB				= 'bhash';
	const _HASH					= 'hashid';
	const _KEYWORD				= 'keyword';
	const _COUNTS				= 'counts';
	/**
	 * @deprecated 此字段已经删除，不再使用
	 */
	const _HEATS				= 'heats';
	const _LASTTIME				= 'lasttime';
	/*此字段用户记录当前词汇的最后更新热度时间。此字段仅在处理用户搜索记录时做更新。*/
	const _LASTSEARCH			= 'lastsearch';
	const _KEYWORDATTR			= 'kattr';
	const _KEYWORDWEIGHT		= 'weight';
	const _MYHEAT				= 'myheats';
	public static $allversion	= array(
								1 => "(1000/(UNIX_TIMESTAMP() - `lasttime`)*counts * 0.1 * weight) as myheats");
	
	public static function recordword($wordarr, $dbcon = false)
	{
		global $_CONFIG;
		if(!$dbcon)
		{
			$dbmaster = $_CONFIG['db']['1'];
			if(!$dbmaster)
			{
				echo('error config');return false;
			}
			$dbcon = mysql_connect($dbmaster['dbhost'], $dbmaster['dbuser'], $dbmaster['dbpw']);
			if(!$dbcon)
			{
				echo('error db connect');return false;
			}
			if(!mysql_select_db($dbmaster['dbname'], $dbcon))
			{
				echo('no datebase');return false;
			}
		}
		if($wordarr['word'])
		{
			
		}
	}
	
	public static function getTableName($type, $val){
		return self::_TABLENAME . "_{$type}_" . substr($val, -1, 1);
	}
	
	public static function getHeatsMath($version = 1)
	{
		$version = intval($version);
		$defaultversion = 1;
		if(!self::$allversion[$version]){
			$version = $defaultversion;
		}
		return self::$allversion[$version];
	}
}