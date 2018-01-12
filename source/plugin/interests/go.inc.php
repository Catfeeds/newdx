<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

require_once dirname(__FILE__) . "/model/linemod.php";
$urlid = $_G['gp_goid'];
$uid = $_G['uid'];
$ip = $_G['clientip'];
$couponid = $_G['gp_couponid'];
$lineinfo = false;
if($urlid > 0 && $uid > 0){
	$lineinfo = DB::fetch_first("SELECT * FROM " . linemod::TABLE_NAME . " WHERE `" . linemod::_ID . "` = {$urlid}");
}
if(!$lineinfo || !$lineinfo[linemod::_URL])
{
	echo "<script>history.back(-1);</script>";
}else{
	require_once dirname(__FILE__) . "/model/historymod.php";
	historymod::recordhistory($uid, $urlid, $ip, $lineinfo[linemod::_POS], 1);
	$gourl = stripos($lineinfo[linemod::_URL], 'http://') === 0 ? $lineinfo[linemod::_URL] : 'http://' . $lineinfo[linemod::_URL];
	@header("location: " . $gourl . "?uid=" . $_G['uid'] . "&couponid={$couponid}&username=" . $_G['username']);
}