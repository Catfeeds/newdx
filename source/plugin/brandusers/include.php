<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('PILLAR_HEIGHT', 60);
/*
* 返回我喜欢头像列表
*/
function getLikeitUsers() {
   global $_G;
   $users = array();
   $query = DB::query("SELECT b.id, b.uid, m.username FROM ".DB::table('dianping_brand_users')." AS b
					   LEFT JOIN ".DB::table('common_member')." AS m
						   ON b.uid = m.uid
					   WHERE b.tid = {$_G['tid']} AND b.type='likeit'
					   ORDER BY b.id DESC
					   LIMIT 20");
   while ($value = DB::fetch($query)) {
	   $value['avatar'] = avatar($value['uid'], 'small');
	   $users[] = $value;
   }
   return $users;
}

/*
* 返回我喜欢个数
*/
function getBrandUsersNum($type) {
   global $_G;
   $query = DB::fetch_first("SELECT count(b.id) as num FROM ".DB::table('dianping_brand_users')." AS b
					   WHERE b.tid = {$_G['tid']} AND b.type='$type'");
   
   return $query['num'];
}

$user_attentions = array(
	'likeit' => NULL,
	'wantuse' => NULL,
	'using' => NULL,
);

if ($_G['uid']) {
	$query = DB::query("SELECT * FROM ".DB::table('dianping_brand_users')." WHERE uid = {$_G['uid']} AND tid = {$_G['tid']}");
	while ($value = DB::fetch($query)) {
		$user_attentions[$value['type']] = $value;
	}
}

$likeitUsers = getLikeitUsers();
$brandUsersNum = array();
$brandUsersNum['likeit'] = getBrandUsersNum('likeit');
$brandUsersNum['wantuse'] = getBrandUsersNum('wantuse');
$brandUsersNum['using'] = getBrandUsersNum('using');

include template('brandusers:include');