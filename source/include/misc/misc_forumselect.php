<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: misc_forumselect.php 8331 2010-04-20 02:20:39Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!isset($_G['cache']['forums'])) {
	loadcache('forums');
}


$grouplist = $commonlist = array();
$forumlist = $subforumlist = $fids = $forumfieldlist = array();

//常用板块
if ($_G['cookie']['visitedfid']) {
	$commonfids = explode('D', $_G['cookie']['visitedfid']);
	
	foreach($commonfids as $k => $fid) {
		if($_G['cache']['forums'][$fid]['type'] == 'sub') {
			$commonfids[] = $_G['cache']['forums'][$fid]['fup'];
			unset($commonfids[$k]);
		}
	}

	$commonfids = array_unique($commonfids);

	foreach($commonfids as $fid) {
		$commonlist[] = $_G['cache']['forums'][$fid];
	}
}

//获得已开启的点评模块列表
include_once libfile('function/space');
$dianpingFids = getdianpingfids();

foreach($_G['cache']['forums'] as $forum) {
	if(!$forum['status'] || $forum['status'] == 2) {
		continue;
	}
	if($forum['type'] != 'group') {
		$allow = false;
		if(!$forum['postperm'] || $forum['postperm'] && forumperm($forum['postperm'])) {
			$allow = true;
		}
		if(!$allow) {
			continue;
		}
	}
	
	if ($forum['fid'] == 493 || isset($dianpingFids[$forum['fid']])) {continue;}
	
	if($forum['type'] == 'group') {
		$grouplist[$forum['fid']] = $forum;	
	} elseif($forum['type'] == 'forum') {
		$forumlist[$forum['nfup']][] = $forum;
		$fids[$forum['fid']] = $forum['fid'];
	}
}

if ($fids) {
	$fids  = implode(',', $fids);
	$sql   = "SELECT ff.fid, ff.icon FROM ". DB::table('forum_forumfield')." ff WHERE ff.fid in ({$fids})";
	$query = DB::query($sql);
	while($forum = DB::fetch($query)) {
		$forumfieldlist[$forum['fid']] = $forum;
	}
}

unset($grouplist[191], $forumlist[191]);

//调取发布活动的分组
$query  =DB::query("select f.fid,f.fup,f.type,f.name,f.status,f.allowpostspecial,ff.icon,ff.description from ".DB::table('forum_forum')." as f left join ".DB::table('forum_forumfield')." as ff on f.fid = ff.fid where f.type='group' and f.status=1 order by f.fid asc");
while($row = DB::fetch($query)){
    $forum_grouplist[] = $row;
}


//调取发布活动的相应版块
$query  =DB::query("select f.fid,f.fup,f.type,f.name,f.status,f.allowpostspecial,ff.icon,ff.description from ".DB::table('forum_forum')." as f left join ".DB::table('forum_forumfield')." as ff on f.fid = ff.fid where  f.status=1");
while($row = DB::fetch($query)){
    $forum_actlist[] = $row;
}
$fids_actlist = array();
foreach($forum_actlist as $k=>$v){
    
    $str_er =  decbin($v['allowpostspecial']);
    $strlen =  strlen($str_er);
    if($strlen == 4){
        $str_if = substr($str_er, 0,1);
        if($str_if ==1){
            $fids_actlist[] =$v['fid']; 
        }
    }else if($strlen ==5){
        $str_if = substr($str_er, 1, 1);
        if($str_if ==1){
            $fids_actlist[] =$v['fid']; 
        }
    }else if($strlen == 6){
        $str_if = substr($str_er, 2, 1);
        if($str_if ==1){
            $fids_actlist[] =$v['fid']; 
        }
    }
}

$fids_act  = implode(',', $fids_actlist);
$query  =DB::query("select f.fid,f.fup,f.type,f.name,f.status,f.allowpostspecial,ff.icon,ff.description,ff.extra from ".DB::table('forum_forum')." as f left join ".DB::table('forum_forumfield')." as ff on f.fid = ff.fid where f.type='forum' and  f.status=1 and f.fid in ($fids_act) order by f.fup asc");
while($row = DB::fetch($query)){
    $forumactlist[] = $row;
}
foreach($forumactlist as $key=>$v){
    $v['extra'] = unserialize($v['extra']);
    if($v['type'] == 'group') {
		$forum_grouplist[$v['fid']] = $v;	
	} elseif($v['type'] == 'forum') {
		$forumactlist_chongzu[$v['fup']][] = $v;
	}
}

if($_G['gp_action'] == 'navnewactlist'){
    include template('forum/post_forumactselect');
}else{
    include template('forum/post_forumselect');
}
exit;

?>