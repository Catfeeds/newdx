<?php

/**
 * @author JiangHong
 * @copyright 2015
 */
exit;
header("Access-Control-Allow-Origin: http://m.8264.com");
$fid = $_POST['fid'];
$tid = $_POST['tid'];
$agent = $_POST['agent'];
$ip = $_POST['ip'];
$uid = $_POST['uid'];
$starttime = ceil($_POST['stime'] / 1000);
$endtime = ceil($_POST['etime'] / 1000);
$userhash = md5($uid.$ip.$agent);
$title = $_POST['title'];
$title = iconv('utf-8', 'gbk', $title);
//echo "fid:{$fid}|tid:{$tid}|agent:{$agent}|ip:{$ip}|$uid:{$uid}|hash:{$userhash}\n";
//$configdir = realpath(dirname(__FILE__) . '/../../config/config_global.php');
//include_once $configdir;
include_once 'commonfunc.php';
global $_CONFIG;
$dbmaster = $_CONFIG['db']['1'];
if(!$dbmaster)
{
	exit('error config');
}
$dbcon = mysql_connect($dbmaster['dbhost'], $dbmaster['dbuser'], $dbmaster['dbpw']);
if(!$dbcon)
{
	exit('error db connect');
}
if(!mysql_select_db($dbmaster['dbname'], $dbcon))
{
	exit('no datebase');
}
if(!$ip){
	exit('no ip');
}
if(!$tid){
	exit('no_tid');
}
if(!$title){
	exit('no_title');
}
include_once 'recordmodel.class.php';
$insertarr = array(
				recordmodel::_FID 		=> $fid,
				recordmodel::_AGENT 	=> $agent,
				recordmodel::_IP		=> $ip,
				recordmodel::_UID		=> $uid,
				recordmodel::_TITLE		=> $title,
				recordmodel::_TID		=> $tid,
				recordmodel::_HASH		=> $userhash,
				recordmodel::_STATUS	=> 0,
				recordmodel::_TIME		=> time(),
				recordmodel::_STARTTIME => $starttime,
				recordmodel::_ENDTIME	=> $endtime
				);
$browser = recordmodel::rebuildbrowser($agent);
if($browser)
{
	$insertarr = array_merge($insertarr, $browser);
}
$sql = recordmodel::createsql($insertarr, 'ip');
if(do_query_safe($sql) == 1)
{
	$q = mysql_query($sql, $dbcon);
	$id = mysql_insert_id($dbcon);
	echo "{$id}";
	if($uid > 0)
	{
		$sql = recordmodel::createsql($insertarr, 'user');
		$q = mysql_query($sql, $dbcon);
		$id = mysql_insert_id($dbcon);
		echo "-{$id}";
	}
}
//$dbslave = $_config['db']['slaveopen'] ? $_config['db']['slave']['1'] : array();
?>