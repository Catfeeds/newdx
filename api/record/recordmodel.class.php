<?php

/**
 * @author JiangHong
 * @copyright 2015
 * 记录用户浏览的模型 
 */

class recordmodel
{
	const _TABLENAME		= 'pre_plugin_browsehistory';
	const _TABLENAME_NOPRE	= 'plugin_browsehistory';
	const _ID				= 'rid';
	const _HASH				= 'hashid';
	const _FID				= 'fid';
	const _TID				= 'tid';
	const _TIME     		= 'time';
	const _IP				= 'ip';
	const _UID				= 'uid';
	const _TITLE			= 'title';
	const _AGENT			= 'agent';
	/*此状态用于表示此条记录是否已经被分词处理并入用户行为库*/
	const _STATUS			= 'status';
	const _STARTTIME		= 'starttime';
	const _ENDTIME			= 'endtime';
	const _BROWSER_VERSION 	= 'browserversion';
	const _BROWSER_NAME		= 'browsername';
	static $browser			= array(
								'MSIE\s' => 'Internet Explorer',
								'FireFox\/' => 'FireFox',
								'rv:' => 'Internet Explorer',
								'Chrome\/' => 'Chrome',
								'Opera\s' => 'Opera',
								'UCBrowser\/' => 'UCBrowser',
								'QQBrowser\/' => 'QQBrowser',
								'Safari\/' => 'Safari'
								); 
	
	public static function createsql($insertarr = array(), $type = 'ip')
	{
		$sql = "";
		if(!empty($insertarr))
		{
			$tablename = self::_TABLENAME;
			if($type == 'ip')
			{
				//$tablename .= "_{$type}_" . substr($insertarr[self::_IP], -1, 1);
				$tablename = self::getTableName($type, $insertarr[self::_IP]);
			}else{
				//$tablename .= "_{$type}_" . substr($insertarr[self::_UID], -1, 1);
				$tablename = self::getTableName($type, $insertarr[self::_UID]);
			}
			$sql = "INSERT INTO " . $tablename . "(";
			$_tmpk = $_tmpv = array();
			foreach($insertarr as $k => $v)
			{
				$_tmpk[] = "`{$k}`";
				$_tmpv[] = "'{$v}'";
			}
			$sql .= implode(',' , $_tmpk);
			$sql .= ") VALUES(";
			$sql .= implode(',', $_tmpv);
			$sql .= ");";
		}
		return $sql;
	}
	
	public static function getTableName($type, $val)
	{
		return self::_TABLENAME . "_{$type}_" . substr($val, -1, 1);
	}
	
	public static function rebuildbrowser($agent)
	{
		$return = array();
		if($agent)
		{
			foreach(recordmodel::$browser as $key => $val)
			{
				if (preg_match('/' . $key . '([^\s|;|\)]+)/i', $agent, $matches))
				{
					$return[recordmodel::_BROWSER_NAME] = $val;
					$return[recordmodel::_BROWSER_VERSION] = $matches[1];
					break;
				}
			}
		}
		return $return;
	}
}