<?php

/**
 * @author JiangHong
 * @copyright 2015
 */
error_reporting(E_ALL^E_NOTICE);
global $_CONFIG, $jscount, $selectcount, $updatecount, $starttime, $dbslavecon, $dbcon, $otherlog;
$starttime = time();
include_once 'commonfunc.php';
$jscount = $selectcount = $updatecount = 0;
function exitfunc()
{
	global $jscount, $selectcount, $updatecount, $starttime, $dbslavecon, $dbcon, $otherlog;
	$dbslavecon && mysql_close($dbslavecon) && $dbslavecon != $dbcon && mysql_close($dbcon);
	$endtime = time();
	$usetime = $endtime - $starttime;
	$startday = date('Y-m-d H:i:s', $starttime);
	$endday = date('Y-m-d H:i:s', $endtime);
	echo <<<EOF
	
======================[{$startday}]计划任务启动======================
共耗时：{$usetime} 秒
共查询sql: {$selectcount} 条
共更新sql: {$updatecount} 条
其他日志：{$otherlog}
======================[{$endday}]计划任务完成======================

EOF;
	
}
register_shutdown_function('exitfunc');
if(!testSingleThread("fencictl.php"))
{
	$otherlog = "因上次进程未完成，当前进程结束等待下次启动。";
	exit();
}
$dbmaster = $_CONFIG['db']['1'];
if(!$dbmaster)
{
	exit('error config');
}
$dbcon = mysql_connect($dbmaster['dbhost'], $dbmaster['dbuser'], $dbmaster['dbpw']);
$dbslavecon = $dbcon;
if($_CONFIG['db']['slaveopen'])
{
	$dbslave = $_CONFIG['db']['slave']['1'];
	$dbslavecon = mysql_connect($dbslave['dbhost'], $dbslave['dbuser'], $dbslave['dbpw']);
	if(!$dbslavecon || !mysql_select_db($dbslave['dbname'], $dbslavecon))
	{
		$dbslavecon = $dbcon;
	}
}
if(!$dbcon)
{
	exit('error db connect');
}
if(!mysql_select_db($dbmaster['dbname'], $dbcon))
{
	exit('no datebase');
}
include_once realpath(dirname(__FILE__) . '/recordmodel.class.php');
include_once realpath(dirname(__FILE__) . '/wordsmodel.class.php');
include_once realpath(dirname(__FILE__) . '/keywordmodel.class.php');
$prelimit = 200;
$typearr = array('ip', 'user');
$ipwhere = $ifexists = array();
/**对10个字表分别进行查询并操作**/
for($i = 0; $i <= 9; $i++)
{
	$updateok = array();
	$updateer = array();
	foreach($typearr as $_type)
	{
		$q = mysql_query("SELECT * FROM " . recordmodel::_TABLENAME . "_{$_type}_{$i} WHERE `" . recordmodel::_STATUS . "` = 0 ORDER BY " . recordmodel::_TIME . " ASC limit {$prelimit}", $dbslavecon);
		$selectcount++;
		while($res = mysql_fetch_assoc($q))
		{
			##进行分词##
			$titlearr = wordsmodel::getkeywords($res[recordmodel::_TITLE]);
			if($titlearr)
			{				
				foreach($titlearr as $_keyarr)
				{
					$existskeyname = "{$_keyarr['word']}|{$_type}|" . ($_type == 'ip' ? $res[recordmodel::_IP] : $res[recordmodel::_UID]);
					if(!isset($ifexists[$existskeyname]))
					{
						$sql = "SELECT " . keywordmodel::_ID . " FROM " . keywordmodel::_TABLENAME . "_{$_type}_{$i} WHERE `" . keywordmodel::_KEYWORD . "` = '{$_keyarr['word']}' AND `" . ($_type == 'ip' ? keywordmodel::_IP : keywordmodel::_UID) . "` = " . ($_type == 'ip' ? "'" . $res[recordmodel::_IP] . "'" : $res[recordmodel::_UID]);
						//echo "<br />{$sql}";
						$_tmpres = mysql_query($sql, $dbslavecon);
						$selectcount++;
						$_tmpres = mysql_fetch_assoc($_tmpres);
						if($_tmpres)
						{
							$ifexists[$existskeyname] = $_tmpres[keywordmodel::_ID];
						}												
					}
					if($ifexists[$existskeyname] > 0)
					{
						$_kid = $ifexists[$existskeyname];
						$sql = "UPDATE " . keywordmodel::_TABLENAME . "_{$_type}_{$i} SET `" . keywordmodel::_COUNTS . "` = `" . keywordmodel::_COUNTS . "` + 1, `" . keywordmodel::_LASTTIME . "` = " . $res[recordmodel::_TIME] . " WHERE `" . keywordmodel::_ID . "` = {$_kid}";
						mysql_query($sql, $dbcon);
						if(mysql_affected_rows($dbcon) > 0)
						{
							$updatecount++;
							$updateok[] = $res[recordmodel::_ID];
						}else{
							$otherlog .= "[id:" . $res[recordmodel::_ID] . "|sql:{$sql}]";
						}
					}else{
						if($_type == 'ip')
						{
							if(!isset($ipwhere[$res[recordmodel::_IP]]))
							{
								##进行地区计算##
								$jscount++;
								$citycodearr = getCodeIdByIp($res[recordmodel::_IP], $dbcon);
								$_tmp_city = $citycodearr ? $citycodearr[0] : -1;
								$_tmp_province = $citycodearr ? $citycodearr[1] : -1;
								$ipwhere[$res[recordmodel::_IP]] = array(0 => $_tmp_city, 1 => $_tmp_province);
							}
							$sql = "INSERT INTO " . keywordmodel::_TABLENAME . "_{$_type}_{$i}(`" . keywordmodel::_IP . "`, `" . keywordmodel::_COUNTS . "`, `" . keywordmodel::_HASH . "`, `" . keywordmodel::_KEYWORD . "`, `" . keywordmodel::_KEYWORDATTR . "`, `" . keywordmodel::_KEYWORDWEIGHT . "`, `" . keywordmodel::_LASTTIME . "`, `" . keywordmodel::_PROVINCE . "`, `" . keywordmodel::_CITY . "`) VALUES('" . $res[recordmodel::_IP] . "', 1, '" . $res[recordmodel::_HASH] . "', '{$_keyarr['word']}', '{$_keyarr['attr']}', '{$_keyarr['weight']}', " .$res[recordmodel::_TIME] . ", " . $ipwhere[$res[recordmodel::_IP]][1] . ", " . $ipwhere[$res[recordmodel::_IP]][0] . ")";
						}elseif($_type == 'user'){
							$sql = "INSERT INTO " . keywordmodel::_TABLENAME . "_{$_type}_{$i}(`" . keywordmodel::_UID . "`, `" . keywordmodel::_COUNTS . "`, `" . keywordmodel::_HASH . "`, `" . keywordmodel::_KEYWORD . "`, `" . keywordmodel::_KEYWORDATTR . "`, `" . keywordmodel::_KEYWORDWEIGHT . "`, `" . keywordmodel::_LASTTIME . "`) VALUES(" . $res[recordmodel::_UID] . ", 1, '" . $res[recordmodel::_HASH] . "', '{$_keyarr['word']}','{$_keyarr['attr']}', '{$_keyarr['weight']}', " . $res[recordmodel::_TIME] . ")";
						}
						mysql_query($sql, $dbcon);
						$insertid = mysql_insert_id($dbcon);
						if($insertid > 0)
						{
							$updatecount++;
							$ifexists[$existskeyname] = $insertid;
							$updateok[] = $res[recordmodel::_ID];
						}else{
							$otherlog .= "[id:" . $res[recordmodel::_ID] . "|sql:{$sql}]";
						}
					} 
				}
			}else{
				$updateer[] = $res[recordmodel::_ID];
			}			
		}
		if($updateok){
			$sql = "UPDATE " . recordmodel::_TABLENAME . "_{$_type}_{$i} SET `" . recordmodel::_STATUS . "` = 1 WHERE `" . recordmodel::_ID . "` IN(" . implode(',', $updateok) . ")";
			mysql_query($sql, $dbcon);
			$updatecount++;
		}
		if($updateer){
			$sql = "UPDATE " . recordmodel::_TABLENAME . "_{$_type}_{$i} SET `" . recordmodel::_STATUS . "` = -1 WHERE `" . recordmodel::_ID . "` IN(" . implode(',', $updateer) . ")";
			mysql_query($sql, $dbcon);
			$updatecount++;
		}
	}
}