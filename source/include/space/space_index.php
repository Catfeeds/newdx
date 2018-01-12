<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_index.php 17496 2010-10-20 03:03:15Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//模块处理功能
require_once libfile('function/space');
require_once libfile('function/post');	
require_once libfile('function/forum');	

//个人资料
space_merge($space, 'count');
space_merge($space, 'field_home');
space_merge($space, 'field_forum');
space_merge($space, 'profile');

$space['group'] = $_G['cache']['usergroups'][$space['groupid']];

//个人资料,这只调居住地,不考虑权限
loadcache('profilesetting');
include_once libfile('function/profile');
$profiles = array();
foreach($_G['cache']['profilesetting'] as $fieldid=>$field) {	
	$val = profile_show($fieldid, $space);
	if($val !== false) {
		$profiles[$fieldid] = array('title'=>$field['title'], 'value'=>$val);
	}
}
if($space['medals']) {
	$space['medals'] = explode("\t", $space['medals']);
    loadcache('medals');
    foreach($space['medals'] as $key => $medalid) {
        list($medalid, $medalexpiration) = explode("|", $medalid);
        if(isset($_G['cache']['medals'][$medalid]) && (!$medalexpiration || $medalexpiration > $timestamp)) {
            $space['medals'][$key] = $_G['cache']['medals'][$medalid];
        } else {
            unset($space['medals'][$key]);
        }
    }
}

if ($_GET['op'] == 'getmusiclist') {
	//得到音乐播放列表
	if(empty($space['uid'])) {
		exit();
	}
	
	$userdiy = getuserdiydata($space);
	
	$reauthcode = substr(md5($_G['authkey'].$space['uid']), 6, 16);
	if($reauthcode == $_GET['hash']) {
		space_merge($space,'field_home');
		$userdiy = getuserdiydata($space);
		$musicmsgs = $userdiy['parameters']['music'];
		$outxml = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
		$outxml .= '<playlist version="1">'."\n";
		$outxml .= '<mp3config>'."\n";
		$showmod = 'big' == $musicmsgs['config']['showmod'] ? 'true' : 'false';
		$outxml .= '<showdisplay>'.$showmod.'</showdisplay>'."\n";
		$outxml .= '<autostart>'.$musicmsgs['config']['autorun'].'</autostart>'."\n";
		$outxml .= '<showplaylist>true</showplaylist>'."\n";
		$outxml .= '<shuffle>'.$musicmsgs['config']['shuffle'].'</shuffle>'."\n";
		$outxml .= '<repeat>all</repeat>'."\n";
		$outxml .= '<volume>100</volume>';
		$outxml .= '<linktarget>_top</linktarget> '."\n";
		$outxml .= '<backcolor>0x'.substr($musicmsgs['config']['crontabcolor'], -6).'</backcolor> '."\n";
		$outxml .= '<frontcolor>0x'.substr($musicmsgs['config']['buttoncolor'], -6).'</frontcolor>'."\n";
		$outxml .= '<lightcolor>0x'.substr($musicmsgs['config']['fontcolor'], -6).'</lightcolor>'."\n";
		$outxml .= '<jpgfile>'.$musicmsgs['config']['crontabbj'].'</jpgfile>'."\n";
		$outxml .= '<callback></callback> '."\n";
		$outxml .= '</mp3config>'."\n";
		$outxml .= '<trackList>'."\n";
		foreach ($musicmsgs['mp3list'] as $value){
			$outxml .= '<track><annotation>'.$value['mp3name'].'</annotation><location>'.$value['mp3url'].'</location><image>'.$value['cdbj'].'</image></track>'."\n";
		}
		$outxml .= '</trackList></playlist>';
		$outxml = diconv($outxml, CHARSET, 'UTF-8');
		obclean();
		@header("Expires: -1");
		@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
		@header("Pragma: no-cache");
		@header("Content-type: application/xml; charset=utf-8");
		echo $outxml;
	}
	exit();
		
} else {	
	
	//若是管理员，则打开个人资料页
	if ($_G['adminid'] == 1 && empty($_G['gp_view'])) {
		dheader("location: {$_G['config']['web']['home']}home-space-uid-{$space['uid']}-do-profile.html");		
	}	
	
	//若是管理员，则自己的空间，则跳转
	if ($space['self']) {
		$gid  = isset($_GET['gid']) ? intval($_GET['gid']) : -1;
		$url  = "{$_G['config']['web']['home']}my-{$space['uid']}";
		$url .= $gid >= 0 ? "-ismy-1-gid-{$gid}" : "";
		$url .= '.html';
		dheader("location: {$url}");
	}
	
	//个人中心首页
	if($_G['setting']['realname'] && empty($_G['setting']['name_allowviewspace']) && $_G['adminid'] != 1) {
		space_merge($space, 'profile');
		if(!empty($space['realname'])) {
			require_once libfile('function/spacecp');
			//实名认证
			ckrealname('viewspace');
		}
	}

	//更新空间访问数 spaceviewnum
	$viewuids = $_G['cookie']['viewuids'] ? explode('_', $_G['cookie']['viewuids']) : array();
	if($_G['uid'] && !$space['self'] && !in_array($space['uid'], $viewuids)) {
		member_count_update($space['uid'], array('views' => 1));
		$viewuids[$space['uid']] = $space['uid'];
		dsetcookie('viewuids', implode('_', $viewuids));
	}

	//最近访客记录
	if(!$space['self'] && $_G['uid']) {
		$query = DB::query("SELECT dateline FROM ".DB::table('home_visitor')." WHERE uid='$space[uid]' AND vuid='$_G[uid]'");
		$visitor = DB::fetch($query);
		$is_anonymous = empty($_G['cookie']['anonymous_visit_'.$_G['uid'].'_'.$space['uid']]) ? 0 : 1;
		if(empty($visitor['dateline'])) {
			$setarr = array(
				'uid' => $space['uid'],
				'vuid' => $_G['uid'],
				'vusername' => $is_anonymous ? '' : $_G['username'],
				'dateline' => $_G['timestamp']
			);
			DB::insert('home_visitor', $setarr, 0, true);
			show_credit();//竞价排名
		} else {
			if($_G['timestamp'] - $visitor['dateline'] >= 300) {
				DB::update('home_visitor', array('dateline'=>$_G['timestamp'], 'vusername'=>$is_anonymous ? '' : $_G['username']), array('uid'=>$space['uid'], 'vuid'=>$_G['uid']));
			}
			if($_G['timestamp'] - $visitor['dateline'] >= 3600) {
				show_credit();//1小时后竞价排名
			}
		}
		
		//奖励访客
		updatecreditbyaction('visit', 0, array(), $space['uid']);
	}
	
	//获得已开启的点评模块列表
	$dpModList 		= array();
	require DISCUZ_ROOT . 'config/config_dianping.php';
	foreach ($dp_modules as $k=>$v) {
		if (!$v['enable']) {
			unset($dp_modules[$k]);
			continue;
		}
		$dpModList[$v['fid']] = $v;	
		$dpModList[$v['fid']]['star'] = $dp_star[$v['mname']];
	}
	
	//若是别人的空间，则显示个人首页
	$list 	  = array();
	$tids 	  = array();
	$arrType  = array('1'=>'post', '2'=>'reply', '3'=>'dianping', '4'=>'blog', '5'=>'album', '6'=>'activity', '7'=>'activity');
	
	//动态最多取50条
	$perpage  	  = 20;	
	$page     	  = max(intval($_GET['page']), 1);
	$page     	  = $page > 3 ? 3 : $page;
	$start    	  = ($page-1)*$perpage;
	$realperpage  = $page == 3 ? 10 : $perpage;
	$theurl   	  = "home.php?mod=space&uid={$space['uid']}";	
	$theurl  	 .= $_G['adminid'] == 1 ? "&view=admin" : '';	
	
	//论坛板块列表
	loadcache('forums');
	$forums = $_G['cache']['forums'];	
	
	$count = DB::result_first("select count(*) FROM ".DB::table('home_feed_ucenter')." f where f.uid={$space["uid"]} " . getSlaveID());
	$count = $count > 50 ? 50 : $count;
	if ($count) {
		$sql   = "select f.* FROM ".DB::table('home_feed_ucenter')." f 
           where f.uid={$space["uid"]} 
		   order by f.dateline desc limit {$start},{$realperpage} " . getSlaveID();
		$query   = DB::query($sql);	
		while($v = DB::fetch($query)) {		
			$v['typeen']  = $arrType[$v['type']];
			$v['tid']  	  = $v['id'];
			$v['message'] = dealmessage($v['message']);
			if ($v['message']) {
				$v['message']['message'] = cutstr($v['message']['message'], 200, '...');	
			}			
			$list[] = $v;
		}
		$multi = multi($count, $perpage, $page, $theurl);
	}
}

$navtitle 		 = "{$space['username']}的首页，{$space['username']}的动态";
$metakeywords 	 = $navtitle;
$metadescription = $navtitle;
if ($_G['gp_tpl']) {
	include_once(template('home/space_index20141215'));
} else {
	include_once(template('home/space_index'));
}

//竞价排名
function show_credit() {
	global $_G, $space;

	$showinfo = DB::fetch_first("SELECT credit, unitprice FROM ".DB::table('home_show')." WHERE uid='$space[uid]'");
	if($showinfo['credit'] > 0) {
		$showinfo['unitprice'] = intval($showinfo['unitprice']);
		if($showinfo['credit'] <= $showinfo['unitprice']) {
			//下榜通知
			notification_add($space['uid'], 'show', 'show_out');
			DB::delete('home_show', array('uid' => $space['uid']));
		} else {
			DB::query("UPDATE ".DB::table('home_show')." SET credit=credit-'$showinfo[unitprice]' WHERE uid='{$space[uid]}' AND credit>0");
		}
	}
}

?>