<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_pm.php 15030 2010-08-18 06:34:38Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

loaducenter();
$pageTitle = "{$_G[username]}的短消息 - 户外资料网";
$list      = array();
$now_pot   = $_G['member']['newprompt'];
$now_pm    = $_G['member']['newpm'];
$pmid      = empty($_GET['pmid']) ? 0 : floatval($_GET['pmid']);
$touid     = empty($_GET['touid']) ? 0 : intval($_GET['touid']);
if($_GET['subop'] == 'view') {
	
	$daterange = empty($_GET['daterange'])? 1 : intval($_GET['daterange']);
	
	if($touid) {
			
		$is_new = uc_pm_is_new($_G['uid'], $touid);
		if($is_new) {
			DB::query('UPDATE ' . DB::table('common_member') . " SET newpm=newpm-1 WHERE uid='{$_G['uid']}'");
		}

		$list = uc_pm_view($_G['uid'], 0, $touid, $daterange);
		
		//若是$_G['uid']和$touid没有对话，则跳转到发送新消息页面
		if (empty($list)) {	
			dheader("location: {$_G['config']['web']['home']}home-spacecp-ac-pm-touid-{$touid}.html");
		}
		
		//若是点击查看更多历史记录，若是没加载上，则进一步读取
		$lastcount = empty($_G['gp_count']) ? 0 : intval($_G['gp_count']);
		$count     = count($list);		
		while ($lastcount >= $count && $daterange < 5) {
			$daterange++;
			$list = uc_pm_view($_G['uid'], 0, $touid, $daterange);
			$lastcount = $count;
			$count     = count($list);			
		}
		
		foreach($list as $_k => $_v){
			$list[$_k]['message'] = thumb_all_pic(300, 300, $list[$_k]['message']); 
		}
		$pmid  = empty($list) ? 0 : $list[0]['pmid'];
		
	} elseif($pmid) {
		$is_new = uc_pm_is_new($_G['uid'], 0, $pmid);
		if($is_new) {
			DB::query('UPDATE ' . DB::table('common_member') . " SET newpm=newpm-1 WHERE uid='{$_G['uid']}'");
		}
		$list = uc_pm_view($_G['uid'], $pmid);
		if(!empty($_G['gp_from']) && $_G['gp_from'] == 'privatepm') {
			dsetcookie('viewannouncepmid', $pmid, 31536000);
		}
	}
	
	$nextrage = $daterange+1;
	$actives = array($daterange=>' class="a"');
} elseif($_GET['subop'] == 'ignore') {
	$ignorelist = uc_pm_blackls_get($_G['uid']);
	$actives = array('ignore'=>' class="a"');
}

$vsmeusername = '';
if($list) {
	foreach ($list as $key => $value) {
		if($vsmeusername == '' || $vsmeusername == $_G['username']){
			$vsmeusername = $value['msgfrom'];
		}
	}
}

if($_G['newtpl']){
	if($_G['inajax']){
		include template("common/header");
		$datas = $newdata[0];
		include template("home/space_pm_list_new");
		include template("common/footer");
	}else{
		//系统的短消息点击查看时并不打开新页面, 直接在元素下方显示, dz架构比较混乱, 目前最好的解决方法是在此加一个判断, 会执行很多不必要的方法.
		if($_GET['ajax']) {
			echo $list ? $list[0]['message'] : '';
			exit;
		}
		else {
			include_once template("diy:home/space_pm_new");
		}
	}
} else {
	include_once template("diy:home/space_pm");
}

?>