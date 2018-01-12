<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
define('PILLAR_HEIGHT', 60);

/*
* 返回我喜欢的人数列表
*/
function getWantitUsers() {
   global $_G;
   $users = array();
   $query = DB::query("SELECT b.id, b.uid, m.username FROM ".DB::table('plugin_produce_users')." AS b
					   LEFT JOIN ".DB::table('common_member')." AS m
					   ON b.uid = m.uid
					   WHERE b.tid = {$_G['tid']}
					   ORDER BY b.id DESC
					   LIMIT 20");
   while ($value = DB::fetch($query)) {
	   $value['avatar'] = avatar($value['uid'], 'small');
	   $users[] = $value;
   }
   return $users;
}

/*
* 返回个数
*/
function getMountionUsersNum($type) {
   global $_G;
   $query = DB::fetch_first("SELECT count(b.id) as num FROM ".DB::table('plugin_produce_users')." AS b
							WHERE b.tid = {$_G['tid']} AND b.type='$type'");   
   return $query['num'];
}

$user_attentions = array(
	'want' => 0,
	'used' => 0,
	'worth' => 0,
	'unworth' => 0,
);

if ($_G['uid']) {
	$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_users')." WHERE uid = {$_G['uid']} AND tid = {$_G['tid']}");
	while ($value = DB::fetch($query)) {
		$user_attentions[$value['type']] = $value;
	}
}

$likeitUsers = getWantitUsers();
$MountionUsersNum = array();
$MountionUsersNum['want'] = getMountionUsersNum('want');
$MountionUsersNum['used'] = getMountionUsersNum('used');
$MountionUsersNum['worth'] = getMountionUsersNum('worth');
$MountionUsersNum['unworth'] = getMountionUsersNum('unworth');

include template('brandusers:produce');