<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('PILLAR_HEIGHT', 60);
/*
* 返回攀登山峰人数列表
*/
function getWantitUsers() {
   global $_G;
   $users = array();
   $query = DB::query("SELECT b.id, b.uid, m.username FROM ".DB::table('plugin_mountion_users')." AS b
					   LEFT JOIN ".DB::table('common_member')." AS m
						   ON b.uid = m.uid
					   WHERE b.tid = {$_G['tid']} AND b.type='wopandengguo'
					   ORDER BY b.id DESC
					   LIMIT 20");
   while ($value = DB::fetch($query)) {
	   $value['avatar'] = avatar($value['uid'], 'small');
	   $users[] = $value;
   }
   return $users;
}

/*
* 返回攀登的个数
*/
function getMountionUsersNum($type) {
   global $_G;
   $query = DB::fetch_first("SELECT count(b.id) as num FROM ".DB::table('plugin_mountion_users')." AS b
					   WHERE b.tid = {$_G['tid']} AND b.type='$type'");
   
   return $query['num'];
}

$user_attentions = array(
	'want' => NULL,
	'wopandengguo' => NULL,
);

if ($_G['uid']) {
	$query = DB::query("SELECT * FROM ".DB::table('plugin_mountion_users')." WHERE uid = {$_G['uid']} AND tid = {$_G['tid']}");
	while ($value = DB::fetch($query)) {
		$user_attentions[$value['type']] = $value;
	}
}

$likeitUsers = getWantitUsers();
$MountionUsersNum = array();
$MountionUsersNum['want'] = getMountionUsersNum('want');
$MountionUsersNum['wopandengguo'] = getMountionUsersNum('wopandengguo');


include template('brandusers:mountion');