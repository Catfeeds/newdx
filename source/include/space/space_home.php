<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_home.php 17249 2010-09-27 10:17:23Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

// 驴友录未登录时 -- 判断有没有$_G['gp_uid']。若有，则跳转到该用户的首页，否则跳转到登录页面
if (!$_G['uid']) {
	if ($_G['gp_uid']) {
		dheader("location: {$_G['config']['web']['home']}space-uid-{$_G['gp_uid']}.html");
	}
	dheader("location: member.php?mod=logging&action=login");
}

if (!isset($_GET['ismy'])) {
	dheader("location: {$_G['config']['web']['home']}my-{$_G['uid']}.html");
}

//若用户id和$_G['gp_uid']不一致时，则跳转到该用户的首页
if ($_G['uid'] != $_G['gp_uid']) {
	dheader("location: {$_G['config']['web']['home']}space-uid-{$_G['gp_uid']}.html");
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

//获得关注分组
require_once libfile('function/friend');
$groups = friend_group_list();

$list     	 = array();
$perpage  	 = 20;
$gid  	  	 = isset($_GET['gid']) ? intval($_GET['gid']) : -1;
$page        = max(intval($_GET['page']), 1);
$page     	 = $page > 8 ? 8 : $page;
$start    	 = ($page-1)*$perpage;
$realperpage = $page == 8 ? 10 : $perpage;
$theurl   	 = "home.php?mod=space&uid={$space['uid']}&do=home&ismy=1";
$theurl  	.= $gid > -1 ? "&gid={$gid}" : '';
$arrdate     = array();
$count       = 0;

require_once libfile('function/feed');
$sql   = "SELECT fwuid FROM "	. DB::table(get_user_table($_G['uid'])) . " WHERE uid={$_G['uid']} ";
$sql  .= $gid > -1 ? " and gid={$gid}" : '';  
$sql  .= " order by feedtime desc limit 0, 50 " . getSlaveID();
$query = DB::query($sql);
while ($v = DB::fetch($query)) {	
	$sqlfeed   = "SELECT feedid,dateline FROM ".DB::table('home_feed_ucenter')." feed WHERE feed.uid = {$v['fwuid']} ORDER BY feed.dateline DESC LIMIT 0,20 " . getSlaveID();
	$queryfeed = DB::query($sqlfeed);
	while ($val = DB::fetch($queryfeed)) {
		$arrdate[$val['dateline']] = $val['feedid'];
	}
	$count++;
}
$count = $count > 150 ? 150 : $count;
krsort($arrdate);
$feedids = array_slice($arrdate, $start, $realperpage);
if ($feedids) {
	$feedids = implode(',', $feedids);
	$sql   = "SELECT * FROM ".DB::table('home_feed_ucenter')." feed WHERE feed.feedid in ({$feedids}) " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		$v['message'] = dealmessage($v['message']);
		$list[$v['dateline']] = $v;
	}
	krsort($list);
}
$multi = multi($count, $perpage, $page, $theurl);


//若是不满一页，则调取推荐用户的数据
if($gid < 0 && $page == 1) {
	$followed_list_count = count($list);	
	if($followed_list_count < $perpage) {
		$recommend_list = get_recommonded_users('', $_G['uid'], 12, true);
		if($recommend_list) {
			$list_str = implode(',', array_keys($recommend_list));
			$query = DB::query('SELECT uid,threads FROM ' . DB::table('common_member_count') . " WHERE uid IN ({$list_str}) LIMIT 12 " . getSlaveID());
			while ($value = DB::fetch($query)) {
				$threads_statistic[$value['uid']] = $value['threads'];
			}
			
			$sql = 'SELECT m.uid,g.grouptitle FROM ' . DB::table('common_member') . ' m INNER JOIN ' . DB::table('common_usergroup') . ' g ON m.groupid=g.groupid '
			 . "WHERE m.uid IN ({$list_str}) LIMIT 12 " . getSlaveID();
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$groups_statistic[$value['uid']] = $value['grouptitle'];
			}
			$recommend_pages = ceil(count($recommend_list) / 3);
			$sql = 'SELECT uid,type,subject,message,username,fid,id FROM ' . DB::table('home_feed_ucenter') . ' WHERE uid IN (' .
				$list_str . ') ORDER BY dateline DESC LIMIT 12 ' . getSlaveID();
			$query = DB::query($sql);
			$complement = 20 - $followed_list_count;
			while ($value = DB::fetch($query)) {
				if($complement<=0) break;
				$value['message']  = dealmessage($value['message']);
				$value['dateline'] = '0';
				$list[] = $value;
				$complement--;
			}
		}
	}
}

$navtitle 		 = "{$space['username']}的首页，驴友动态";
$metakeywords 	 = $navtitle;
$metadescription = $navtitle;

include_once template('home/space_index');

?>