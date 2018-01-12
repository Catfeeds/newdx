<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: spacecp_friend.php 17282 2010-09-28 09:04:15Z zhangguosheng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/friend');

$op = empty($_GET['op'])?'':$_GET['op'];
$uid = empty($_GET['uid']) ? 0 : intval($_GET['uid']);

$space['key'] = space_key($space['uid']);

$actives = array($op=>' class="a"');

if($op == 'add') {
	if(! checkperm('allowfriend')) {
		showmessage('no_privilege', '', array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
	}
	if($uid == $_G['uid']) {
		showmessage('friend_self_error', '', array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
	}

	/*由于好友修改为粉丝, 以上判断维持好友的判断, 否则需要改动系统设置里关于好友的设置*/
	if(followed_by_me($_G['uid'], $uid)) {
		showmessage('you_have_followed_the_person', '', array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
	}

	$tospace = getspace($uid);
	if(empty($tospace)) {
		showmessage('space_does_not_exist', '', array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
	}

	if(isblacklist($tospace['uid'])) {
		showmessage('is_blacklist', '', array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
	}

	$groups = friend_group_list();

	space_merge($space, 'count');
	space_merge($space, 'field_home');

	$maxfriendnum = checkperm('maxfriendnum');
	$maxfriendnum = $maxfriendnum ? $maxfriendnum : 10000;
	if($maxfriendnum && $space['friends'] >= $maxfriendnum + $space['addfriend']) {
		if($_G['magic']['friendnum']) {
			showmessage('enough_of_the_number_of_friends_with_magic', '', array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
		} else {
			showmessage('enough_of_the_number_of_friends', '', array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
		}
	}
    //增加判断是会否为开启了自动加还有的商业用户
    if(friend_ver_auto($uid)!=""){//get data from pre_plugin_friendoption, but the data is null
        $_POST['gid'] = intval($_POST['gid']);
		//$_POST['note'] = censor($_POST['note']);
		friend_add($uid, $_POST['gid']);

		require_once libfile('function/mail');
		$values = array(
			'username' => $tospace['username'],
			'url' => getsiteurl().'home.php?mod=spacecp&ac=friend&amp;op=request'
		);
		notification_add($uid, 'friend', 'friend_add');
		showmessage('friends_add', dreferer(), array('username' => $tospace['username'], 'uid'=>$uid, 'from' => $_G['gp_from']), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
    }else{
		if($tospace['videophotostatus']) {
			ckvideophoto('friend', $tospace);
		}
		ckrealname('friend');//暂不明白该代码的作用
		if(submitcheck('addsubmit')) {
			$gid = intval($_POST['gid']);
			if(! $uid || ! $groups[$gid]) {
				showmessage('add_follow_failed', dreferer(), array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
			}
			$mutual = follow($_G['uid'], $uid, $gid, $_G['username']);

/*			require_once libfile('function/mail');
			$values = array(
				'username' => $tospace['username'],
				'url' => getsiteurl().'home.php?mod=spacecp&ac=friend&amp;op=request'
			);
			sendmail_touser($uid, lang('spacecp', 'friend_subject', $values), '', 'friend_add');//暂不明白该代码的作用*/
			showmessage('add_follow_successfully', dreferer(), array('mutual' => $mutual, 'uid' => $uid), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
			
		} else {
			include template('home/fans/add_follow');
			exit;
		}
    }
} elseif($op == 'ignore') {
	if($uid) {
		unfollow($_G['uid'], $uid);
		echo 'success';
		die;
	} elseif($_GET['key'] == $space['key']) {
		$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('home_friend_request')." WHERE uid='$_G[uid]'"), 0);
		if($count) {
			DB::delete('home_friend_request', array('uid'=>$_G['uid']));
			space_merge($space, 'count');
			$space['newprompt'] = intval($space['newprompt'] - $count);
			if($space['newprompt'] < 0) {
				$space['newprompt'] = 0;
			}
			DB::query("UPDATE ".DB::table('common_member_status')." SET pendingfriends='0' WHERE uid='$_G[uid]'");
			DB::query("UPDATE ".DB::table('common_member')." SET newprompt='$space[newprompt]' WHERE uid='$_G[uid]'");
			dsetcookie('promptstate_'.$_G['uid'], $space['newprompt'], 31536000);
		}
		showmessage('do_success', 'home.php?mod=spacecp&ac=friend&op=request');
	}
} elseif($_GET['op'] == 'ucignore') {//用于个人中心的取消关注
	if(submitcheck('deletefollowsubmit')) {
		if($uid) {
			unfollow($_G['uid'], $uid);
			showmessage('取消关注成功', dreferer(), array(), array('showdialog' => 1, 'showmsg' => true, 'closetime' => true));
		}
		showmessage('取消关注失败', '', array(), array('showdialog' => 1, 'showmsg' => true, 'closetime' => true));		
	}	
	
	$tospace = getspace($uid);
	if(empty($tospace)) {
		showmessage('space_does_not_exist', '', array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
	}
	
	include template('home/fans/deletefollow');
	die;
	
} elseif($op == 'addconfirm') {

	if(!checkperm('allowfriend')) {
		showmessage('no_privilege');
	}
	if($_GET['key'] == $space['key']) {

		$maxfriendnum = checkperm('maxfriendnum');
		space_merge($space, 'field_home');
		space_merge($space, 'count');

		if($maxfriendnum && $space['friends'] >= $maxfriendnum + $space['addfriend']) {
			if($_G['magic']['friendnum']) {
				showmessage('enough_of_the_number_of_friends_with_magic');
			} else {
				showmessage('enough_of_the_number_of_friends');
			}
		}

		$query = DB::query("SELECT fuid, fusername FROM ".DB::table('home_friend_request')." WHERE uid='$space[uid]' LIMIT 0,1");
		if($value = DB::fetch($query)) {
			friend_add($value['fuid']);
			showmessage('friend_addconfirm_next', 'home.php?mod=spacecp&ac=friend&op=addconfirm&key='.$space['key'], array('username' => $value['fusername']), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
		}
	}

	showmessage('do_success', 'home.php?mod=spacecp&ac=friend&op=request&quickforward=1');    
} elseif($op == 'changegroup') {
	$groups = friend_group_list();
	if(submitcheck('changegroupsubmit')) {
		$groupid = $_G['gp_group'];
		if($groups[$groupid]) {
			update_group($_G['uid'], $uid, $groupid);
			showmessage('设置成功', dreferer(), array('uid' => $uid, 'gname' => $groups[$groupid]), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
		}
		showmessage('specified_group_is_not_in_your_groups', '', array(), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
	}
	$selected_group = get_groupid($_G['uid'], $uid);
	include template('home/fans/groups');
	die;
} elseif($op == 'editnickname') {
	if(submitcheck('editnotesubmit')) {
		$note = getstr($_POST['note'], 20, 1, 1);
		$updated = update_nickname($_G['uid'], $uid, $note);
		
		if($updated == 'success') {
			showmessage('do_success', dreferer(), array('uid'=>$uid, 'note'=>$note), array('showdialog'=>1, 'msgtype' => 2, 'closetime' => true));
		}
		showmessage('specified_user_is_not_your_following');
	}
	$nickname = get_nickname($_G['uid'], $uid);
	include template('home/fans/editnickname');
	die;
} elseif($op == 'changenum') {

	if(submitcheck('changenumsubmit')) {
		$num = abs(intval($_POST['num']));
		if($num > 9999) $num = 9999;
		DB::update('home_friend', array('num'=>$num), array('uid'=>$_G['uid'], 'fuid'=>$uid));
		friend_cache($_G['uid']);
		showmessage('do_success', dreferer(), array('fuid'=>$uid, 'num'=>$num), array('showmsg' => true, 'timeout' => 3, 'return'=>1));
	}

	$query = DB::query("SELECT * FROM ".DB::table('home_friend')." WHERE uid='$_G[uid]' AND fuid='$uid'");
	if(!$friend = DB::fetch($query)) {
		showmessage('specified_user_is_not_your_following');
	}

} elseif($op == 'group') {

	if(submitcheck('groupsubmin')) {
		if(empty($_POST['fuids'])) {
			showmessage('please_correct_choice_groups_friend', dreferer());
		}
		$ids = dimplode($_POST['fuids']);
		$groupid = intval($_POST['group']);
		DB::update('home_friend', array('gid'=>$groupid), "uid='$_G[uid]' AND fuid IN ($ids)");
		friend_cache($_G['uid']);
		showmessage('do_success', dreferer());
	}

	$perpage = 50;
	$perpage = mob_perpage($perpage);

	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page = 1;
	$start = ($page-1)*$perpage;

	$list = array();
	$multi = $wheresql = '';

	space_merge($space, 'count');

	if($space['friends']) {

		$groups = friend_group_list();

		$theurl = 'home.php?mod=spacecp&ac=friend&op=group';
		$group = !isset($_GET['group'])?'-1':intval($_GET['group']);
		if($group > -1) {
			$wheresql = "AND main.gid='$group'";
			$theurl .= "&group=$group";
		}

		$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('home_friend')." main
			WHERE main.uid='$space[uid]' $wheresql"), 0);
		if($count) {
			$query = DB::query("SELECT main.fuid AS uid,main.fusername AS username, main.gid, main.num FROM ".DB::table('home_friend')." main
				WHERE main.uid='$space[uid]' $wheresql
				ORDER BY main.dateline DESC
				LIMIT $start,$perpage");
			while ($value = DB::fetch($query)) {
				$value['group'] = $groups[$value['gid']];
				$list[] = $value;
			}
		}
		$multi = multi($count, $perpage, $page, $theurl);
	}

	$actives = array('group'=>' class="a"');

} elseif($op == 'request') {

	if(submitcheck('requestsubmin')) {
		showmessage('do_success', dreferer());
	}

	$maxfriendnum = checkperm('maxfriendnum');
	if($maxfriendnum) {
		$maxfriendnum = $maxfriendnum + $space['addfriend'];
	}

	$perpage = 20;
	$perpage = mob_perpage($perpage);

	$page = empty($_GET['page'])?0:intval($_GET['page']);
	if($page<1) $page = 1;
	$start = ($page-1)*$perpage;

	$list = array();

	$count = getcount('home_friend_request', array('uid'=>$space['uid']));
	if($count) {
		$fuids = array();
		$query = DB::query("SELECT * FROM ".DB::table('home_friend_request')." WHERE uid='$space[uid]' ORDER BY dateline DESC LIMIT $start, $perpage");
		while ($value = DB::fetch($query)) {
			$fuids[$value['fuid']] = $value['fuid'];
			$list[$value['fuid']] = $value;
		}
	} else {

		space_merge($space, 'status');

		if($space['pendingfriends'] > 0) {
			DB::query("UPDATE ".DB::table('common_member_status')." SET pendingfriends=0 WHERE uid='$space[uid]'");
			$newprompt = $space['newprompt'] - $space['pendingfriends'];
			if($newprompt<1) $newprompt = 0;
			DB::query("UPDATE ".DB::table('common_member')." SET newprompt='$newprompt' WHERE uid='$space[uid]'");
			dsetcookie('promptstate_'.$space['uid'], $newprompt, 31536000);
		}

	}

	$multi = multi($count, $perpage, $page, "home.php?mod=spacecp&ac=friend&op=request");

	$navtitle = lang('core', 'title_friend_request');

} elseif($op == 'editgroupname') {
	$groups = friend_group_list();
	$group = intval($_GET['group']);

	if(! isset($groups[$group])) {
		showmessage('change_friend_groupname_error');
	}

	if(submitcheck('groupnamesubmit')) {
		space_merge($space, 'field_home');
		$space['privacy']['groupname'][$group] = getstr(trim($_POST['groupname']), 20, 1, 1);
		privacy_update();
		showmessage('do_success', dreferer(), array('gname' => $space['privacy']['groupname'][$group], 'gid' => $group), array('showdialog'=>1, 'showmsg' => true, 'closetime' => true));
	}
	include template('home/fans/editgroupname');
	die;
} elseif($op == 'blockgroup') {
	$groups = friend_group_list();
	$group = intval($_GET['group']);
	if(! isset($groups[$group])) {
		showmessage('change_friend_groupname_error');
	}
	space_merge($space, 'field_home');

	if(isset($space['privacy']['filter_gid'][$group])) {
		unset($space['privacy']['filter_gid'][$group]);
	} else {
		$space['privacy']['filter_gid'][$group] = $group;
	}
	
	privacy_update();
	refresh_feed_users($_G['uid'], $space['privacy']['filter_gid']);
	echo 'success';
	die;
} elseif($op == 'blacklist') {

	if($_GET['subop'] == 'delete') {
		$_GET['uid'] = intval($_GET['uid']);
		DB::query("DELETE FROM ".DB::table('home_blacklist')." WHERE uid='$space[uid]' AND buid='$_GET[uid]'");
		showmessage('do_success', "home.php?mod=space&uid=$_G[uid]&do=friend&view=blacklist&quickforward=1&start=$_GET[start]");
	}

	if(submitcheck('blacklistsubmit')) {
		$_POST['username'] = trim($_POST['username']);
		$query = DB::query("SELECT * FROM ".DB::table('common_member')." WHERE username='$_POST[username]'");
		if(!$tospace = DB::fetch($query)) {
			showmessage('space_does_not_exist');
		}
		if($tospace['uid'] == $space['uid']) {
			showmessage('unable_to_manage_self');
		}

		friend_delete($tospace['uid']);

		DB::insert('home_blacklist', array('uid'=>$space['uid'], 'buid'=>$tospace['uid'], 'dateline'=>$_G['timestamp']), 0, true);

		showmessage('do_success', "home.php?mod=space&uid=$_G[uid]&do=friend&view=blacklist&quickforward=1&start=$_GET[start]");
	}

} elseif($op == 'rand') {

	$userlist = $randuids = array();
	space_merge($space, 'count');
	if($space['friends']<5) {
		$query = DB::query("SELECT uid FROM ".DB::table('common_session')." LIMIT 0,100");
	} else {
		$query = DB::query("SELECT fuid as uid FROM ".DB::table('home_friend')." WHERE uid='$_G[uid]'");
	}
	while($value = DB::fetch($query)) {
		if($value['uid'] != $space['uid']) {
			$userlist[] = $value['uid'];
		}
	}
	$randuids = sarray_rand($userlist, 1);
	showmessage('do_success', "home.php?mod=space&quickforward=1&uid=".array_pop($randuids));

} elseif ($op == 'getcfriend') {

	$fuid = empty($_GET['fuid']) ? 0 : intval($_GET['fuid']);

	$list = array();
	if($fuid) {
		$friend = $friendlist = array();
		$query = DB::query("SELECT * FROM ".DB::table('home_friend')." WHERE uid='$space[uid]' OR uid='$fuid'");
		while($value = DB::fetch($query)) {
			$friendlist[$value['uid']][] = $value['fuid'];
			$friend[$value['fuid']] = $value;
		}
		if($friendlist[$_G['uid']] && $friendlist[$fuid]) {
			$cfriend = array_intersect($friendlist[$_G['uid']], $friendlist[$fuid]);
			$i = 0;
			foreach($cfriend as $key => $uid) {
				if(isset($friend[$uid])) {
					$list[] = array('uid' => $friend[$uid]['fuid'], 'username' => $friend[$uid]['fusername']);
					$i++;
					if($i >= 15) break;
				}
			}
		}

	}
} elseif($op == 'getinviteuser') {
	$perpage   = 1000;
	$start     = 0;
	$json      = array();
	$singlenum = 0;
	$gid  	   = isset($_G['gp_gid']) ? intval($_G['gp_gid']) : -1;
	
	$sql   = 'SELECT fwuid, fwusername FROM '. DB::table(get_user_table($_G['uid'])) . " WHERE uid='{$_G['uid']}' and mutual=2 ";
	$sql  .= $gid > -1 ? " and gid={$gid} " : '';
	$sql  .= " ORDER BY dateline DESC LIMIT {$start},{$perpage} " . getSlaveID();		
	$query = DB::query($sql);
	while($value = DB::fetch($query)) {
		$value['fwusername']  = dgbkaddslashes($value['fwusername']);
		$value['avatar'] 	  = avatar($value['fwuid'], 'small', true);
		$singlenum++;
		$json[$value['fwuid']] = "$value[fwuid]:{'uid':$value[fwuid], 'username':'$value[fwusername]', 'avatar':'$value[avatar]'}";
	}
	
	$sql = daddslashes($sql);
	
	$jsstr = "{'userdata':{".implode(',', $json)."}, 'maxfriendnum':'1000', 'singlenum':'$singlenum', 'sql':'$sql'}";	
	
} elseif($op == 'search') {

	$searchkey = stripsearchkey($_GET['searchkey']);
	if(strlen($searchkey) < 2) {
		showmessage('username_less_two_chars');
	}

	$list = array();
	$query = DB::query("SELECT * FROM ".DB::table('common_member')." WHERE username LIKE '%$searchkey%' LIMIT 0,100");
	while ($value = DB::fetch($query)) {
		$list[$value['uid']] = $value;
	}
	$navtitle = lang('core', 'title_search_friend');
} elseif ($op == 'getonequery') {
	$friendquery = DB::fetch_first("SELECT * FROM ".DB::table('home_friend_request')." WHERE uid='$_G[uid]' ORDER BY dateline DESC LIMIT 1, 1");
}

// lxp 20140319
if($_G['newtpl']){
	$invite_thread_count = $_G['member']['newinvite'];
	require_once libfile('class/task');
	$tasklib = & task::instance();
	$tasklist = $tasklib->tasklist('new');
	$taskcount = count($tasklist);
}
include template('home/spacecp_friend');

?>