<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_activity.php 22550 2011-05-12 05:21:39Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/space');
space_merge($space, 'count');

$page 		= empty($_GET['page']) ? 1 : intval($_GET['page']);
$perpage 	= 10;
$perpage 	= mob_perpage($perpage);
$start      = ($page-1)*$perpage;

$fid 		= empty($_G['gp_fid']) ? 0 : intval($_G['gp_fid']);

$gets = array(
	'mod' 	=> 'space',
	'uid' 	=> $space['uid'],
	'do' 	=> 'dianping',
	'fid' 	=> $fid
);
$theurl = 'home.php?'.url_implode($gets);

//获得已开启的点评模块列表
$dpModList 		= array();
$dianpingFids 	= array();
$allcount       = 0;
require DISCUZ_ROOT . 'config/config_dianping.php';
foreach ($dp_modules as $k=>$v) {
	if (!$v['enable']) {
		unset($dp_modules[$k]);
		continue;
	}
	
	$dpModList[$v['fid']] 			= $v;	
	$dpModList[$v['fid']]['star']   = $dp_star[$v['mname']];
	$dpModList[$v['fid']]['count']  = 0;
	
	$dianpingFids[$v['fid']] = $v['fid'];
}

$dianpingFids = implode(',', $dianpingFids);

//获得点评列表
$list  		 = array();
$pids  		 = array();
$tids  		 = array();
$threadList	 = array();
$supportlist = array();
	
//查dianping_star_logs
$sql   = "select f_p.pid, f_p.fid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message, f_p.rate from " . DB::table('dianping_star_logs');
$sql  .= " s_l left join " . DB::table('forum_post');
$sql  .= " f_p on s_l.pid=f_p.pid where s_l.uid={$space['uid']}";
$sql  .= " order by s_l.dateline desc ";
$sql  .= " limit 200 " . getSlaveID();
$query = DB::query($sql);
while ($v = DB::fetch($query)) {
	if (!isset($dpModList[$v['fid']])) {continue;}
		
	$isAdd = empty($fid) || ($fid && $fid == $v['fid']) ? true : false;
	if ($isAdd && !empty($v['pid'])) {
		$pids[$v['pid']] = $v['pid'];
		$tids[$v['tid']] = $v['tid'];
		$list[$v['pid']] = $v;		
	}
		
	$dpModList[$v['fid']]['count']++;
	$allcount++;
}

$count = !empty($fid) ? $dpModList[$fid]['count'] : $allcount;

if ($count) {
	$list    = array_slice($list, $start, $perpage, true);
	$pids    = array_slice($pids, $start, $perpage, true);
	$tids    = array_slice($tids, $start, $perpage, true);
	$pids  	 = implode(',', $pids);
	$tids    = implode(',', $tids);
} else {
	$pids  = '0';
	$tids  = '0';
}

//查forum_thread
$sql   = "select f_t.subject, f_t.tid from " . DB::table('forum_thread');
$sql  .= " f_t where f_t.tid in ({$tids}) " . getSlaveID();	
$query = DB::query($sql);
while ($v = DB::fetch($query)) {
	$threadList[$v['tid']] = $v;
}

//查dianping_star_logs
$sql   = "select sl.pid, sl.starid, sl.starnum, sl.ext1, sl.ext2, sl.ext3, sl.ext4, sl.ext5, sl.weakpoint, sl.goodpoint, sl.supports, sl.extdata from " . DB::table('dianping_star_logs');
$sql  .= " sl where sl.pid in ({$pids}) " . getSlaveID();
$query = DB::query($sql);
while ($v = DB::fetch($query)) {
	if ($dp_modules['mountain']['fid'] == $list[$v['pid']]['fid']) {
		if(date("Y-m-d",$v['ext1']) == date("Y-m-d",$v['ext2'])){
			$date 			= floor($v['ext2']-$v['ext1'])/3600;
			$v['time'] 		= $date."&nbsp;小时";
			$v['starHour']  = date('G',$v['ext1']);
			$v['endHour']   = date('G',$v['ext2']);					
		}else{
			$date 			= floor($v['ext2']-$v['ext1'])/86400;
			$v['time'] 		= $date."&nbsp;天";
		}
		$v['ext1'] = date("Y-m-d",$v['ext1']);
		$v['ext2'] = date("Y-m-d",$v['ext2']);
	} elseif ($dp_modules['line']['fid'] == $list[$v['pid']]['fid']) {
		$tempJiange = $v['ext2'] - $v['ext1'];
		$v['ext1']	= $v['ext1_show'] = $v['ext1'] ? date("Y-m-d", $v['ext1']) : "";
		$v['ext2']	= $v['ext2_show'] = $v['ext2'] ? date("Y-m-d", $v['ext2']) : "";
		$v['timeTotal']   = "";
		if ($tempJiange >= 86400) {
			$v['timeTotal'] .= ceil($tempJiange/86400)."天";
			$v['isTian']     = 1;
		} else {
			$v['timeTotal'] .= ($v['ext5'] - $v['ext4'])."小时";
			$v['isTian']     = 0;
		}
	}
	
	if ($dp_modules['equipment']['fid'] == $list[$v['pid']]['fid']) {
		$v['extdata'] = unserialize($v['extdata']);
	}
	
	$list[$v['pid']] = array_merge($list[$v['pid']], $v);
}

//获得已点赞列表
if ($_G['uid'] && !$space['self']) {
	$sql   = "select pid from " . DB::table('dianping_support') . " where uid='{$_G['uid']}' and pid in ({$pids})";
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		$supportlist[$v['pid']] = $v['pid'];
	}
}

$multi = multi($count, $perpage, $page, $theurl);

$navtitle = "{$space['username']}的{$dpModList[$fid]['cname']}点评";
include_once template("home/space_dianping");

?>