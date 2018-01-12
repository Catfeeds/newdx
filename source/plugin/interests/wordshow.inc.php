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
require_once DISCUZ_ROOT . './api/record/wordsmodel.class.php';
$allattr = array();
foreach(wordsmodel::$wordattr as $k => $v){
	$allattr[$k] = iconv('utf-8', 'gbk', $v);
}
$cixing = $_G['gp_cixing'] && array_key_exists($_G['gp_cixing'], $allattr) ? $_G['gp_cixing'] : 0;
if($_G['gp_submitsearch'] == 1)
{
	$searchuid = $_G['gp_searchuid'];
	$searchip = $_G['gp_searchip'];
	if($searchuid || $searchip){
		require_once DISCUZ_ROOT . './api/record/keywordmodel.class.php';
		$addwhere = $cixing === 0 ? "" : " AND " . keywordmodel::_KEYWORDATTR . " = '{$cixing}' ";
		if($searchuid){
			if(!is_numeric($searchuid)){
				$uid = DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE username = '" . $searchuid . "' LIMIT 1" . getSlaveID());
			}else{
				$uid = DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE uid = " . $searchuid . " LIMIT 1" . getSlaveID());
			}
			if(!$uid){
				$messagetip = "<font color='red'>uid或用户名错误，不存在这个用户，请重新确认</font>";
			}else{
				$sql = "SELECT " . keywordmodel::_KEYWORD . ", " . keywordmodel::_COUNTS . ", " . keywordmodel::_KEYWORDWEIGHT . ", " . keywordmodel::_KEYWORDATTR . ", " . keywordmodel::_LASTTIME . ", " . keywordmodel::getHeatsMath() . " FROM " . keywordmodel::getTableName('user', $uid) . " WHERE uid = {$uid}{$addwhere} ORDER BY " . keywordmodel::_MYHEAT . " DESC LIMIT {$start}, {$limit}";
				$max = DB::result_first("SELECT count(*) FROM " . keywordmodel::getTableName('user', $uid) . " WHERE uid = {$uid}{$addwhere} " . getSlaveID());
				$multi = multi($max, $limit, $page, "/admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=wordshow&submitsearch=1&searchuid={$searchuid}");
			}
		}elseif($searchip){
			if(!preg_match("/^(\d{1,3}\.){1,3}\d{1,3}$/i", $searchip)){
				$messagetip = "<font color='red'>IP错误，请重新确认</font>";
			}else{
				$sql = "SELECT " . keywordmodel::_KEYWORD . ", " . keywordmodel::_COUNTS . ", " . keywordmodel::_KEYWORDWEIGHT . ", " . keywordmodel::_KEYWORDATTR . ", " . keywordmodel::_LASTTIME . ", " . keywordmodel::getHeatsMath() . " FROM " . keywordmodel::getTableName('ip', $searchip) . " WHERE ip = '{$searchip}'{$addwhere} ORDER BY " . keywordmodel::_MYHEAT . " DESC LIMIT {$start}, {$limit}";
				$max = DB::result_first("SELECT count(*) FROM " . keywordmodel::getTableName('ip', $searchip) . " WHERE ip = '{$searchip}'{$addwhere} " . getSlaveID());
				$multi = multi($max, $limit, $page, "/admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=wordshow&submitsearch=1&searchip={$searchip}");
			}			
		}else{
			$messagetip = "<font color='red'>请通过ip或用户来查找</font>";
		}
		if($sql){
			$showdata = array();
			$q = DB::query($sql);
			while($v = DB::fetch($q)){
				$showdata[] = $v;
			}
		}
	}else{
		$messagetip = "<font color='red'>请通过ip或用户来查找</font>";
	}
}
include_once template('interests:wordshowlist');