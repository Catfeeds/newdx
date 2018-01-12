<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

$messagetip = "";
$page = intval($_G['gp_page']);
$page = max(1, $page);
$limit = 50;
$start = ($page - 1) * $limit;
require_once DISCUZ_ROOT . './api/record/recordmodel.class.php';
if($_G['gp_submitsearch'] == 1)
{
	$searchuid = $_G['gp_searchuid'];
	$searchip = $_G['gp_searchip'];
	if($searchuid || $searchip){
		if($searchuid){
			if(!is_numeric($searchuid)){
				$uid = DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE username = '" . $searchuid . "' LIMIT 1" . getSlaveID());
			}else{
				$uid = DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE uid = " . $searchuid . " LIMIT 1" . getSlaveID());
			}
			if(!$uid){
				$messagetip = "<font color='red'>uid或用户名错误，不存在这个用户，请重新确认</font>";
			}else{
				$sql = "SELECT * FROM " . recordmodel::getTableName('user', $uid) . " WHERE uid = {$uid} ORDER BY " . recordmodel::_TIME . " DESC LIMIT {$start}, {$limit}";
				$max = DB::result_first("SELECT count(*) FROM " . recordmodel::getTableName('user', $uid) . " WHERE uid = {$uid}");
				$multi = multi($max, $limit, $page, "/admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=userhistory&submitsearch=1&searchuid={$searchuid}");
			}
		}elseif($searchip){
			if(!preg_match("/^(\d{1,3}\.){1,3}\d{1,3}$/i", $searchip)){
				$messagetip = "<font color='red'>IP错误，请重新确认</font>";
			}else{
				$sql = "SELECT * FROM " . recordmodel::getTableName('ip', $searchip) . " WHERE ip = '{$searchip}' ORDER BY " . recordmodel::_TIME . " DESC LIMIT {$start}, {$limit}";
				$max = DB::result_first("SELECT count(*) FROM " . recordmodel::getTableName('ip', $searchip) . " WHERE ip = '{$searchip}'");
				$multi = multi($max, $limit, $page, "/admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=userhistory&submitsearch=1&searchip={$searchip}");
			}			
		}else{
			$messagetip = "<font color='red'>请通过ip或用户来查找</font>";
		}
		if($sql){
			$showdata = array();
			$q = DB::query($sql);
			while($v = DB::fetch($q)){
				if($v[recordmodel::_UID] > 0){
					$uidarr[] = $v[recordmodel::_UID];
				}
				if($v[recordmodel::_FID] > 0){
					$fidarr[] = $v[recordmodel::_FID];
				}
				$showdata[] = $v;
			}
			if($fidarr){
				$q = DB::query("SELECT name, fid FROM " . DB::table('forum_forum') . " WHERE fid IN(" . implode(',', $fidarr) . ")");
				while($vv = DB::fetch($q)){
					$fidname[$vv['fid']] = $vv['name'];
				}
			}
			if($uidarr){
				$q = DB::query("SELECT username, uid FROM " . DB::table('common_member') . " WHERE uid IN(" . implode(',', $uidarr) . ")");
				while($vv = DB::fetch($q)){
					$allusername[$vv['uid']] = $vv['username'];
				}
			}
		}
	}else{
		$messagetip = "<font color='red'>请通过ip或用户来查找</font>";
	}
}
include_once template('interests:userhistorylist');