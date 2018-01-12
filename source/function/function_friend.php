<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_friend.php 16154 2010-09-01 03:11:58Z zhengqingpeng $
 */
/*@delete*/
function friend_list($uid, $limit, $start=0) {
	$list = array();
	$query = DB::query("SELECT * FROM ".DB::table('home_friend')."
		WHERE uid='$uid' ORDER BY num DESC, dateline DESC
		LIMIT $start, $limit");
	while ($value = DB::fetch($query)) {
		$list[$value['fuid']] = $value;
	}
	return $list;
}

function friend_group_list() {
	global $_G;

	$space = array('uid' => $_G['uid']);
	space_merge($space, 'field_home');

	$groups = array();
	$spacegroup = empty($space['privacy']['groupname'])?array():$space['privacy']['groupname'];
	for($i = 0; $i < $_G['setting']['friendgroupnum']; $i++) {
		if($i == 0) {
			$groups[0] = lang('friend', 'friend_group_default');
		} else {
			if(!empty($spacegroup[$i])) {
				$groups[$i] = $spacegroup[$i];
			} else {
				if($i<8) {
					$groups[$i] = lang('friend', 'friend_group_'.$i);
				} else {
					$groups[$i] = lang('friend', 'friend_group_more', array('num'=>$i));
				}
			}
		}
	}
	return $groups;
}
/*@delete*/
function friend_check($touids) {
	global $_G;

	if(empty($_G['uid'])) return false;
	if(is_array($touids)) {
		$query = DB::query("SELECT fuid FROM ".DB::table('home_friend')." WHERE uid='$_G[uid]' AND fuid IN (".dimplode($touids).")");
		while($value = DB::fetch($query)) {
			$touid = $value['fuid'];
			$var = "home_friend_{$_G['uid']}_{$touid}";
			$fvar = "home_friend_{$touid}_{$_G['uid']}";
			$_G[$var] = $_G[$fvar] = true;
		}
	} else {
		$touid = $touids;
		$var = "home_friend_{$_G['uid']}_{$touid}";
		$fvar = "home_friend_{$touid}_{$_G['uid']}";
		if(!isset($_G[$var])) {
			$friend = DB::fetch_first("SELECT fuid FROM ".DB::table('home_friend')." WHERE uid='$_G[uid]' AND fuid='$touid'");
			$_G[$var] = $_G[$fvar] = $friend?true:false;
		}
		return $_G[$var];
	}

}
/*imitate friend_check, but they are different.
*return an array of the friends by searching the database, treating the fuids as the criteria
*/
function check_followed_by_fwuid($uid, $fwuid) {
	if(! $uid || ! $fwuid) return;
	$table = get_user_table($uid);

	$followees = array();
	if(is_array($fwuid)) {
		$fuid = array_unique($fwuid);//fuid can contain the same values
		$query = DB::query('SELECT fwuid FROM ' . DB::table($table) . " WHERE uid='{$uid}' AND fwuid IN (" . implode(',', $fwuid) . ')');
		while($value = DB::fetch($query)) {
			$followees[$value['fwuid']] = 1;
		}
	}
	else {
		$fid = DB::fetch_first('SELECT fwuid FROM ' . DB::table($table) . " WHERE uid='{$uid}' AND fwuid='{$fwuid}'");
		if($fid) $followees[$fid] = 1;
	}
	return $followees;
}

function friend_request_check($touid) {
/*	global $_G;

	$var = "home_friend_request_{$touid}";
	if(!isset($_G[$var])) {
		$result = DB::fetch_first("SELECT fuid FROM ".DB::table('home_friend_request')." WHERE uid='$_G[uid]' AND fuid='$touid'");
		$_G[$var] = $result?true:false;
	}
	return $_G[$var];*/
}

function friend_add($touid, $gid=0, $note='') {
/*	global $_G;

	if($touid == $_G['uid']) return -2;
	if(friend_check($touid)) return -2;

	$freind_request = DB::fetch_first("SELECT * FROM ".DB::table('home_friend_request')." WHERE uid='$_G[uid]' AND fuid='$touid'");
    //增加判断若是为商业用户开启自动加好友功能
    $info = friend_ver_auto($touid);
	if($freind_request || $info!="") {
		$setarr = array(
			'uid' => $_G['uid'],
		//	'fuid' => $freind_request['fuid'],
            'fuid' => $touid,
		//	'fusername' => addslashes($freind_request['fusername']),
            'fusername' => ($info!="") ? addslashes($info['username']) : addslashes($freind_request['fusername']),
		//	'gid' => $gid,
            'gid' => $info['gid'],
			'dateline' => $_G['timestamp']
		);
		DB::insert('home_friend', $setarr);

		friend_request_delete($touid);

		friend_cache($_G['uid']);

		$setarr = array(
			'uid' => $touid,
			'fuid' => $_G['uid'],
			'fusername' => $_G['username'],
			//'gid' => $freind_request['gid'],
            'gid' => $info['gid'],
			'dateline' => $_G['timestamp']
		);
		DB::insert('home_friend', $setarr);

		addfriendlog($_G['uid'], $touid);
		friend_cache($touid);

	} else {

		$to_freind_request = DB::fetch_first("SELECT * FROM ".DB::table('home_friend_request')." WHERE uid='$touid' AND fuid='$_G[uid]'");
		if($to_freind_request) {
			return -1;
		}

		$setarr = array(
			'uid' => $touid,
			'fuid' => $_G['uid'],
			'fusername' => $_G['username'],
			'gid' => $gid,
			'note' => $note,
			'dateline' => $_G['timestamp']
		);
		DB::insert('home_friend_request', $setarr);
		
		DB::query("UPDATE ".DB::table('common_member_status')." SET pendingfriends=pendingfriends+1 WHERE uid='$touid'");
		DB::query("UPDATE ".DB::table('common_member')." SET newprompt=newprompt+1 WHERE uid='$touid'");
		
	}

	return 1;*/
}

function friend_make($touid, $tousername, $checkrequest=true) {
	global $_G;

	if($touid == $_G['uid']) return false;

	if($checkrequest) {
		$to_freind_request = DB::fetch_first("SELECT * FROM ".DB::table('home_friend_request')." WHERE uid='$touid' AND fuid='$_G[uid]'");
		if($to_freind_request) {
			DB::query("DELETE FROM ".DB::table('home_friend_request')." WHERE uid='$touid' AND fuid='$_G[uid]'");
			DB::query("UPDATE ".DB::table('common_member_status')." SET pendingfriends=pendingfriends-1 WHERE uid='$touid'");
		}

		$to_freind_request = DB::fetch_first("SELECT * FROM ".DB::table('home_friend_request')." WHERE uid='$_G[uid]' AND fuid='$touid'");
		if($to_freind_request) {
			DB::query("DELETE FROM ".DB::table('home_friend_request')." WHERE uid='$_G[uid]' AND fuid='$touid'");
			DB::query("UPDATE ".DB::table('common_member_status')." SET pendingfriends=pendingfriends-1 WHERE uid='$_G[uid]'");
		}
	}

	DB::query("REPLACE INTO ".DB::table('home_friend')." (uid,fuid,fusername,dateline)
		VALUES ('$touid', '$_G[uid]', '$_G[username]', '$_G[timestamp]'),
			('$_G[uid]', '$touid', '$tousername', '$_G[timestamp]')");

	addfriendlog($_G['uid'], $touid);
	friend_cache($touid);
	friend_cache($_G['uid']);
}

function addfriendlog($uid, $touid, $action = 'add') {
	global $_G;

	if($uid && $touid) {
		$flog = array(
				'uid' => $uid > $touid ? $uid : $touid,
				'fuid' => $uid > $touid ? $touid : $uid,
				'dateline' => $_G['timestamp'],
				'action' => $action
		);
		DB::insert('home_friendlog', $flog, false, true);
		return true;
	}

	return false;

}

function friend_addnum($touid) {
	global $_G;

	if($_G['uid'] && $_G['uid'] != $touid) {
		DB::query("UPDATE ".DB::table('home_friend')." SET num=num+1 WHERE uid='$_G[uid]' AND fuid='$touid'");
	}
}
/*@delete*/
function friend_cache($touid) {
	global $_G;

	$tospace = array('uid' => $touid);
	space_merge($tospace, 'field_home');

	$filtergids = empty($tospace['privacy']['filter_gid'])?array():$tospace['privacy']['filter_gid'];

	$uids = array();
	$count = 0;
	$fcount = 0;
	$query = DB::query("SELECT * FROM ".DB::table('home_friend')." WHERE uid='$touid' ORDER BY num DESC, dateline DESC");
	while ($value = DB::fetch($query)) {
		if($value['fuid'] == $touid) continue;
		if($fcount > 200) {
			$count = DB::num_rows($query);
			DB::free_result($query);
			break;
		} elseif(empty($filtergids) || !in_array($value['gid'], $filtergids)) {
			$uids[] = $value['fuid'];
			$fcount++;
		}
		$count++;
	}
	DB::update('common_member_field_home', array('feedfriend'=>implode(',', $uids)), array('uid'=>$touid));
	DB::update('common_member_count', array('friends'=>$count), array('uid'=>$touid));

}


function friend_request_delete($touid) {
	global $_G;

	DB::delete('home_friend_request', array('uid'=>$_G['uid'], 'fuid'=>$touid));

	if(DB::affected_rows()) {
		//DB::query("UPDATE ".DB::table('common_member_status')." SET pendingfriends=pendingfriends-'1' WHERE uid='$_G[uid]'");
		//DB::query("UPDATE ".DB::table('common_member')." SET newprompt=newprompt-'1' WHERE uid='$_G[uid]'");
		return true;
	}
	return false;
}
/*@delete*/
function friend_delete($touid) {
	global $_G;

	if(!friend_check($touid)) return false;

	DB::delete('home_friend', "(uid='$_G[uid]' AND fuid='$touid') OR (fuid='$_G[uid]' AND uid='$touid')");

	if(DB::affected_rows()) {
		addfriendlog($_G['uid'], $touid, 'delete');
		friend_cache($_G['uid']);
		friend_cache($touid);
	}
}

//增加函数：判断是否为自动添加好友
function friend_ver_auto($touid){
    $result = DB::fetch_first("SELECT * FROM ".DB::TABLE('plugin_friendoption')." WHERE uid=".$touid." AND friendsetting=1");
    return $result;
}

/*以下为好友改版后新增的方法, 以上方法可能都需要废弃, 由于没有与大家商量, 本次未能改变dz的目录结构, 希望日后能够按照模块开发, 废弃dz的目录结构, 
* 将以下方法提取到library文件夹下, 作为一个类的静态方法, 而不是直接function, 
* 这样加大了方法冲突的可能性, 也不符合软件的设计思想
* author: linsheng.wu, 2014.12.05
* 1 => 单向关注  2 => 双向关注
*/
//get the count of the people under my following
function get_following_count($uid) {
	if(! $uid) return;
	$count = DB::fetch_first('SELECT COUNT(*) as amount FROM ' . DB::table(get_user_table($uid)) . " WHERE uid={$uid} " . getSlaveID());
	return $count['amount'];
}

function get_following_count_by_username($uid, $username) {
	$count = DB::fetch_first('SELECT COUNT(*) as amount FROM ' . DB::table(get_user_table($uid)) . " WHERE uid='{$uid}' AND instr(fwusername, '{$username}')>0 " . getSlaveID());
	return $count['amount'];
}

function get_fans_count($uid) {
	if(! $uid) return;
	$count = DB::fetch_first('SELECT COUNT(*) as amount FROM ' . DB::table(get_user_table($uid, true)) . " WHERE uid={$uid} " . getSlaveID());
	return $count['amount'];
}

function get_fans_count_by_username($uid, $username) {
	if(! $uid || ! $username) return;
	$count = DB::fetch_first('SELECT COUNT(*) as amount FROM ' . DB::table(get_user_table($uid, true)) . " WHERE uid='{$uid}' AND instr(fanusername, '{$username}')>0 " . getSlaveID());
	return $count['amount'];
}
/*get the splited table according to the last number of User ID
passive true 我被关注的表 false 关注的表
*/
function get_user_table($uid, $passive=false) {
	if(! $uid) return;
	
	$end_num = substr($uid, -1);
	if(! $passive) {
		$table = ('home_follow_' . $end_num);
	}
	else {
		$table = ('home_followed_' . $end_num);
	}
	return $table;
}

/*get the users who are followed by me,*/
function get_following_users($uid, $page=1, $perpage=10) {
	$table = get_user_table($uid);
	if(! $table) return array();
	$start = ($page - 1) * $perpage;
	$p_sql = 'SELECT fwuid,gid,nickname,mutual, fwusername as username FROM %table WHERE uid=%uid ORDER BY intimacy DESC,dateline DESC  LIMIT %start,%perpage ' . getSlaveID();
	$sql = strtr($p_sql, array(
				'%uid' => $uid,
				'%table' => DB::table($table),
				'%start' => $start,
				'%perpage' => $perpage
		));

	$users = array();
	$query = DB::query($sql);
	while ($value = DB::fetch($query)) {
		$users[$value['fwuid']] = $value;
	}
	return $users;
}
/*get the users who follow me*/
function get_fan_users($uid, $page=1, $perpage=10){
	$table = get_user_table($uid, true);
	if(! $table) return array();
	$start = ($page - 1) * $perpage;
	$p_sql = 'SELECT fanuid,mutual,fanusername as username FROM %table WHERE uid=%uid ORDER BY dateline DESC  LIMIT %start,%perpage ' . getSlaveID();
	$sql = strtr($p_sql, array(
				'%uid' => $uid,
				'%table' => DB::table($table),
				'%start' => $start,
				'%perpage' => $perpage
		));

	$users = array();

	$query = DB::query($sql);
	while ($value = DB::fetch($query)) {
		$users[$value['fanuid']] = $value;
	}
	return $users;
}
/*recommond 6 users according to the new requirement,  the users next to you will be prioritied, then the users online */
function get_recommonded_users($ip, $uid, $usercount=6, $exclude=false) {
	if(! $uid) return;	
	$recommended_users = array();
	if($exclude) {
		//no more than 30
		$sql = 'SELECT uid, username FROM ' . DB::table('common_session') . ' WHERE uid>0 LIMIT 30 ' . getSlaveID();
		$query = DB::query($sql);
		while($value = DB::fetch($query)) {
			$recommended_users[$value['uid']] = $value;
		}

		if($recommended_users) {
			//exclude people that i have folllowed
			$uid_str = implode(',', array_keys($recommended_users));
			if($uid_str) {
				$sql_exclude = 'SELECT fwuid FROM ' . DB::table(get_user_table($uid)) . " WHERE uid={$uid} AND fwuid IN ({$uid_str})";
				$query = DB::query($sql_exclude);
				while($value = DB::fetch($query)) {
					unset($recommended_users[$value['fwuid']]);
				}
			}
			unset($recommended_users[$uid]);
		}
		$recommended_users = array_slice($recommended_users, 0, $usercount, true);
	}
	else {
		$m_key = 'recommended_users_to_' . $uid;
		if($recommended_users = memory('get', $m_key)) {
			return $recommended_users;
		}
		if(! $ip) return;
		$exclude_uid_str = ('0,' . $uid);
		$ip_arr = explode('.', $ip);
		$sql = 'SELECT uid, username FROM ' . DB::table('common_session') 
		. " WHERE uid NOT IN ($exclude_uid_str) AND ip1='{$ip_arr[0]}' AND ip2='{$ip_arr[1]}' AND ip3='{$ip_arr[2]}' LIMIT $usercount " . getSlaveID();
		$count = 0;
		$query = DB::query($sql);
		while($value = DB::fetch($query)) {
			$exclude_uid_str .= (',' . $value['uid']);
			$count++;
			$recommended_users[$value['uid']] = $value;
		}

		if($count < $usercount) {
			$sql = 'SELECT uid, username FROM ' . DB::table('common_session') 
			. " WHERE uid NOT IN ($exclude_uid_str) LIMIT " . ($usercount - $count) . ' ' . getSlaveID();
			$query = DB::query($sql);
			while($value = DB::fetch($query)) {
				$recommended_users[$value['uid']] = $value;
			}
		}
		$recommended_users = array_slice($recommended_users, 0, $usercount, true);
		memory('set', $m_key, $recommended_users, 60);
	}
	
	return $recommended_users;
}
/*search by username*/
function get_following_users_by_username($uid, $page=1, $perpage=10, $username) {
	$table = get_user_table($uid);
	if(! $table || ! $username) return array();
	$start = ($page - 1) * $perpage;
	$p_sql = 'SELECT fwuid,gid,nickname,mutual, fwusername as username FROM %table  WHERE uid=%uid AND instr(fwusername,' . "'{$username}'" . ')>0 ORDER BY intimacy DESC,dateline DESC LIMIT %start,%perpage ' . getSlaveID();
	$sql = strtr($p_sql, array(
				'%uid' => $uid,
				'%table' => DB::table($table),
				'%start' => $start,
				'%perpage' => $perpage,
				'%username' => $username
		));

	$users = array();
	$query = DB::query($sql);
	while ($value = DB::fetch($query)) {
		$users[$value['fwuid']] = $value;
	}
	return $users;
}

function get_following_uid_by_gid($uid, $page=1, $perpage=10, $gid=0) {
	$table = get_user_table($uid);
	if(! $table) return array();
	$start = ($page - 1) * $perpage;
	$p_sql = 'SELECT fwuid FROM %table  WHERE uid=%uid AND gid=%gid ORDER BY intimacy DESC,dateline DESC LIMIT %start,%perpage ' . getSlaveID();
	$sql = strtr($p_sql, array(
				'%uid' => $uid,
				'%table' => DB::table($table),
				'%start' => $start,
				'%perpage' => $perpage,
				'%gid' => $gid
		));

	$uid_arr = array();
	$query = DB::query($sql);
	while ($value = DB::fetch($query)) {
		$uid_arr[$value['fwuid']] = $value;
	}
	return $uid_arr;
}

function get_fan_users_by_username($uid, $page=1, $perpage=10, $username) {
	$table = get_user_table($uid, true);
	if(! $table || ! $username) return array();
	$start = ($page - 1) * $perpage;
	$p_sql = 'SELECT fanuid,mutual,fanusername as username FROM %table WHERE uid=%uid AND instr(fanusername,   ' . "'{$username}'" . ')>0 ORDER BY dateline DESC LIMIT %start,%perpage ' . getSlaveID();
	$sql = strtr($p_sql, array(
				'%uid' => $uid,
				'%table' => DB::table($table),
				'%start' => $start,
				'%perpage' => $perpage
		));

	$users = array();
	$query = DB::query($sql);
	while ($value = DB::fetch($query)) {
		$users[$value['fanuid']] = $value;
	}
	return $users;
}

function get_user_residence($uids) {
	if(! $uids) return;
	$uid_str = '';
	if(is_array($uids)) {
		$uid_str = $uids;
	}
	else {
		$uid_str = $uids;
	}
	$query = DB::query('SELECT uid, resideprovince FROM ' . DB::table('common_member_profile') . " WHERE uid IN({$uid_str}) " . getSlaveID());
	$arr = array();
	while ($value = DB::fetch($query)) {
		$arr[$value['uid']] = $value['resideprovince'];
	}
	return $arr;
}
function get_user_slogon($uids) {
	if(! $uids) return;
	$uid_str = '';
	if(is_array($uids)) {
		$uid_str = $uids;
	}
	else {
		$uid_str = $uids;
	}
	$query = DB::query('SELECT uid, recentnote FROM ' . DB::table('common_member_field_home') . " WHERE uid IN({$uid_str}) " . getSlaveID());
	$arr = array();
	while ($value = DB::fetch($query)) {
		$arr[$value['uid']] = trim($value['recentnote']);
	}
	return $arr;
}
function update_nickname($uid, $fwuid, $nickname) {
	$table = get_user_table($uid);
	if($table) {
		$followed_uid = DB::result_first('SELECT uid FROM ' . DB::table($table) . " WHERE uid={$uid} and fwuid={$fwuid} LIMIT 1 " . getSlaveID());
		if($followed_uid) {
			DB::query('UPDATE ' . DB::table($table) . " SET nickname='{$nickname}' WHERE uid={$uid} and fwuid={$fwuid} LIMIT 1");
			return 'success';
		}
		else {
			return 'unfolowed';
		}
	}
}
/*get the user's nickname, who is followed by me*/
function get_nickname($uid, $fwuid) {
	$table = get_user_table($uid);
	if($table) {
		$result = DB::result_first('SELECT nickname FROM ' . DB::table($table) . " WHERE uid='{$uid}' and fwuid='{$fwuid}' LIMIT 1 " . getSlaveID());
		return $result;
	}
}
/*return group id which I setted the user in*/
function get_groupid($uid, $fwuid) {
	$table = get_user_table($uid);
	if($table) {
		$result = DB::result_first('SELECT gid FROM ' . DB::table($table) . " WHERE uid='{$uid}' and fwuid='{$fwuid}' LIMIT 1 " . getSlaveID());
		return $result;
	}
}
/*update user's group id*/
function update_group($uid, $fwuid, $groupid) {
	$table = get_user_table($uid);
	if($table) {
		$result = DB::query('UPDATE ' . DB::table($table) . " SET gid='{$groupid}' WHERE uid='{$uid}' and fwuid='{$fwuid}' LIMIT 1");
		$privacy = get_privacy($uid);
		/*according to the previous function 'friend_cache', the maximun amount of uid  in common_member_field_home(feedfriend) is 200, 
		only if the user's(who is followed by me) groupid does not in privacy['filter_gid'] can accept feed*/
		if(! $privacy['filter_gid'] || ! isset($privacy['filter_gid'][$groupid])) {
			$uids =	DB::result_first('SELECT feedfriend FROM ' . DB::table('common_member_field_home') . " WHERE uid='{$uid}' LIMIT 1 " . getSlaveID());
			if(! $uids || (substr_count($uids, ',') < 199 && strpos($uids, ",{$fwuid},") === false && strpos($uids, "{$fwuid},") !== 0 && substr($uids, -strlen($fwuid)-1) != ",{$fwuid}" )) {
				$uid_str = $uids ? $uids . ',' . $fwuid : $fwuid;
				DB::update('common_member_field_home', array('feedfriend' => $uid_str), array('uid' => $uid));
			}
		}
		return $result;
	}
}
function get_privacy($uid) {
	$privacy = DB::result_first('SELECT privacy FROM ' . DB::table('common_member_field_home') . " WHERE uid='{$uid}' LIMIT 1 " . getSlaveID());
	if(! $privacy) return;
	$privacy_arr = unserialize($privacy);
	return $privacy_arr;
}
/*cancel the following to somebody*/
function unfollow($uid, $fwuid) {
	$table = get_user_table($uid);
	if($table) {
		DB::delete(get_user_table($fwuid, true), "uid='{$fwuid}' AND fanuid='{$uid}' LIMIT 1");
		DB::delete($table, "uid='{$uid}' AND fwuid='{$fwuid}' LIMIT 1");

		if(DB::affected_rows()) {
			DB::query('UPDATE ' . DB::table(get_user_table($fwuid)) . " SET mutual=1 WHERE uid={$fwuid} AND fwuid={$uid} LIMIT 1");
			DB::query('UPDATE ' . DB::table(get_user_table($uid, true)) . ' set mutual=0 ' . " WHERE uid={$uid} AND fanuid={$fwuid}" .' LIMIT 1');

			//update feedfriends and following number
			$feedfriends = DB::result_first('SELECT feedfriend FROM ' . DB::table('common_member_field_home') . " WHERE uid='{$uid}' LIMIT 1 " . getSlaveID());
			$feedfriend_str = '';
			if(strpos($feedfriends, $fwuid . ',') === 0) {
				$feedfriend_str = str_replace($fwuid . ',', '', $feedfriends);
			}
			elseif(strpos($feedfriends, ',' . $fwuid . ',') > 0) {
				$feedfriend_str = str_replace(',' . $fwuid, '', $feedfriends);
			}
			elseif(substr($feedfriends, -strlen($fwuid)-1) == ",{$fwuid}") {
				$feedfriend_str = str_replace(',' . $fwuid, '', $feedfriends);
			}
			else {
				$feedfriend_str = & $feedfriends;
			}
			DB::query('UPDATE ' . DB::table('common_member_field_home') . ' SET feedfriend=' . "'{$feedfriend_str}'" . '  WHERE uid='. $uid .' LIMIT 1');
			DB::query('UPDATE ' . DB::table('common_member_count') . ' SET friends=friends-1' . '  WHERE uid='. $uid .' LIMIT 1');
			DB::query('UPDATE ' . DB::table('common_member_count') . ' SET fans=fans-1' . '  WHERE uid='. $fwuid .' LIMIT 1');
		}
	}
}
/*follow somebody*/
function follow($uid, $fwuid, $gid, $myname='') {
	$table = get_user_table($uid);
	if($table) {
		//check whether the use has been followed or not
		/*$check = DB::result_first('SELECT uid FROM ' . DB::table($table) . " WHERE uid='{$uid}' AND fwuid='{$fwuid}' LIMIT 1 " . getSlaveID());*/
		$mutual   = followed_by_me($fwuid, $uid) ? 2 : 1;//2-双向关注 1-单向关注
		
		//动态最新更新时间
		$feedtime = DB::result_first('SELECT dateline FROM ' . DB::table('home_feed_ucenter') . " WHERE uid = {$fwuid} order by dateline desc LIMIT 1 " . getSlaveID());		
		
		//插入关注记录
		DB::insert($table, array(
			'uid' 		 => $uid,
			'fwuid' 	 => $fwuid,
			'fwusername' => get_username($fwuid),
			'gid' 		 => $gid,
			'dateline' 	 => time(),
			'mutual'     => $mutual,
			'feedtime'   => $feedtime
			));
		//插入对方被关注记录
		DB::insert(get_user_table($fwuid, true), array(
				'uid' => $fwuid,
				'fanuid' => $uid,
				'fanusername' => $myname,
				'mutual' => $mutual == 1 ? 0 : $mutual,
				'dateline' => time()
			));
		//如果该用户之前关注了我, 需要更新之前的值为双向关注
		if($mutual == 2) {
			DB::update(get_user_table($fwuid), array(
					'mutual' => $mutual
				), array(
					'uid' => $fwuid,
					'fwuid' => $uid
				));
			DB::update(get_user_table($uid, true), array(
					'mutual' => $mutual
				), array(
					'uid' => $uid,
					'fanuid' => $fwuid
				));
		}
		$feedfriends = DB::result_first('SELECT feedfriend FROM ' . DB::table('common_member_field_home') . " WHERE uid='{$uid}' LIMIT 1 " . getSlaveID());
		if(! $feedfriends || substr_count($feedfriends, ',') < 200) {
			$feedfriend_str = $feedfriends ? ($feedfriends . ',' . $fwuid) : $fwuid;
			DB::query('UPDATE ' . DB::table('common_member_field_home') . ' SET feedfriend=' . "'{$feedfriend_str}'" . '  WHERE uid='. $uid .' LIMIT 1');
		}
		DB::query('UPDATE ' . DB::table('common_member_count') . ' SET friends=friends+1' . '  WHERE uid='. $uid .' LIMIT 1');
		DB::query('UPDATE ' . DB::table('common_member_count') . ' SET fans=fans+1' . '  WHERE uid='. $fwuid .' LIMIT 1');
		//send notification
		notification_add($fwuid, 'follow', 'following_notify', '');
		return $mutual;
	}
}
function get_username($uid) {
	if(! $uid) return;
	$username = DB::result_first('SELECT username FROM ' . DB::table('common_member') . " WHERE uid='{$uid}' LIMIT 1 " . getSlaveID());
	return $username;
}
/*update the users*/
function refresh_feed_users($uid, $filtergid) {
	if(! $uid) return;
	if(! $filtergid) {
		$privacy = get_privacy($uid);
		$filtergid = $privacy['filter_gid'];
	}
	$table = get_user_table($uid);
	if($table) {
		$fw_uids = array();
		$sql = '';
		if($filtergid) {
			$filtergid_str = implode(',', $filtergid);
			$sql = 'SELECT fwuid FROM ' . DB::table($table) . " WHERE uid='{$uid}' AND gid NOT IN ({$filtergid_str}) ORDER BY intimacy DESC, dateline DESC LIMIT 200 " . getSlaveID();
		}
		else {
			$sql = 'SELECT fwuid FROM ' . DB::table($table) . " WHERE uid='{$uid}' ORDER BY intimacy DESC, dateline DESC LIMIT 200 " . getSlaveID();
		}

		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$fw_uids[] = $value['fwuid'];
		}
	}
	DB::update('common_member_field_home', array('feedfriend' => implode(',', $fw_uids)), array('uid' => $uid));
	/* not sure whether it is nessessary to correct the total amount of users followed by me or not
	DB::update('common_member_count', array('friends'=>$count), array('uid' => $uid));
	*/
}
/*check whether the user been followed by me or not*/
function followed_by_me($uid, $fwuid) {
	$table = get_user_table($uid);
	if($table) {
		$result = DB::result_first('SELECT mutual FROM ' . DB::table($table) . " WHERE uid='{$uid}' AND fwuid='{$fwuid}' LIMIT 1 " . getSlaveID());
		return $result;
	}
}

function increase_intimacy($uid, $fwuid, $dealt=1) {
	$table = get_user_table($uid);
	if($table) {
		DB::query('UPDATE ' . DB::table($table) . " SET intimacy=intimacy+{$dealt} WHERE uid='{$uid}' AND fwuid='{$fwuid}' LIMIT 1");
	}
}
function get_user_statistic($uids) {
	$uid_str = is_array($uids) ? implode(',', $uids) : $uids;
	$statistic = array();
	if($uid_str) {
		$count = substr_count($uid_str, ',') + 1;
		$query = DB::query('SELECT uid,friends as followee,fans FROM ' . DB::table('common_member_count') . " WHERE uid IN ($uid_str) LIMIT {$count} " . getSlaveID());
		while($value=DB::fetch($query)) {
			$statistic[$value['uid']] = array(
					'followee' => $value['followee'],
					'fans' => $value['fans']
				);
		}
	}
	return $statistic;
}
function correct_user_statistic($uid) {
	if(! $uid) return;
	$follow_t = get_user_table($uid);
	$fan_t = get_user_table($uid, true);

	$follow_c = DB::result_first('SELECT COUNT(*) FROM ' . DB::table($follow_t) . ' WHERE uid=' . $uid . ' ' . getSlaveID());
	$fan_c = DB::result_first('SELECT COUNT(*) FROM ' . DB::table($fan_t) . ' WHERE uid=' . $uid . ' ' . getSlaveID());
	DB::query('UPDATE ' . DB::table('common_member_count') . " SET fans={$fan_c}, friends={$follow_c} WHERE uid={$uid} LIMIT 1");
}
function fix_discrepency_relationship($uid, $ouid) {
	$my_table = get_user_table($uid);
	$object_table = get_user_table($ouid);
	if($my_table && $object_table) {
		$my_follow = DB::result_first('SELECT dateline,mutual,fwusername FROM ' . DB::table($my_table) . " WHERE uid={$uid} AND fwuid={$ouid} LIMIT 1 " . getSlaveID());
		$object_follow = DB::result_first('SELECT dateline,mutual,fwusername FROM ' . DB::table($object_table) . " WHERE uid={$ouid} AND fwuid={$uid} LIMIT 1 " . getSlaveID());
		//follow reciprocally
		if($my_follow && $object_follow) {
			if($my_follow['mutual'] != 2) {
				DB::query('UPDATE ' . DB::table($my_table) . ' SET mutual=2 ' . " WHERE uid={$uid} AND fwuid={$ouid} LIMIT 1");
			}
			if($object_follow['mutual'] != 2) {
				DB::query('UPDATE ' . DB::table($object_table) . ' SET mutual=2 ' . " WHERE uid={$ouid} AND fwuid={$uid} LIMIT 1");
			}
			DB::query('REPLACE INTO ' . DB::table(get_user_table($ouid, true)) . '(uid,fanuid,fanusername,mutual,dateline) VALUES(' . "{$ouid},{$uid},'{$object_follow[fwusername]}',2,{$my_follow[dateline]}" . ')');
			DB::query('REPLACE INTO ' . DB::table(get_user_table($uid, true)) . '(uid,fanuid,fanusername,mutual,dateline) VALUES(' . "{$uid},{$ouid},'{$my_follow[fwusername]}',2,{$object_follow[dateline]}" . ')');
			return;
		}

		//I have followed the person, but the person has not
		if($my_follow && ! $object_follow) {
			if($my_follow['mutual'] != 1) {
				DB::query('UPDATE ' . DB::table($my_table) . ' SET mutual=1 ' . " WHERE uid={$uid} AND fwuid={$ouid} LIMIT 1");
			}
			$username = get_username($uid);
			DB::query('REPLACE INTO ' . DB::table(get_user_table($ouid, true)) . '(uid,fanuid,fanusername,mutual,dateline) VALUES(' . "{$ouid},{$uid},'{$username}',0,{$my_follow[dateline]}" . ')');
			DB::query('DELETE FROM ' . DB::table(get_user_table($uid, true)) . " WHERE uid={$uid} AND fanuid={$ouid} LIMIT 1" );
			return;
		}

		//I have not followed the person, but the person has
		if(! $my_follow && $object_follow) {
			if($my_follow['mutual'] != 1) {
				DB::query('UPDATE ' . DB::table($object_follow) . ' SET mutual=1 ' . " WHERE uid={$ouid} AND fwuid={$uid} LIMIT 1");
			}
			$username = get_username($ouid);
			DB::query('REPLACE INTO ' . DB::table(get_user_table($uid, true)) . '(uid,fanuid,fanusername,mutual,dateline) VALUES(' . "{$uid},{$ouid},'{$username}',0,{$object_follow[dateline]}" . ')');
			DB::query('DELETE FROM ' . DB::table(get_user_table($ouid, true)) . " WHERE uid={$ouid} AND fanuid={$uid} LIMIT 1" );
			return;
		}
		
		/*neighter of them followed each other*/
		DB::query('DELETE FROM ' . DB::table(get_user_table($ouid, true)) . " WHERE uid={$ouid} AND fanuid={$uid} LIMIT 1" );
		DB::query('DELETE FROM ' . DB::table(get_user_table($uid, true)) . " WHERE uid={$uid} AND fanuid={$ouid} LIMIT 1" );
	}
}
?>