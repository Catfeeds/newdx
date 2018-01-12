<?php
	
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: stopspam.class.php 16840 2011-03-15 08:19:59Z Niexinyuan $
 */
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('THREAD_RECYCLE', -1);
define('THREAD_VERIFY', -2);
define('MEMBER_BANPOST', 4);
define('MEMBER_BANVISIT', 5);

function checktime($allowedtime = 1, $now = TIMESTAMP) {
	$time = getdate($now);
	switch($allowedtime) {
		case 1:
			return ($time['wday'] >= 1 && $time['wday'] <= 5) && ($time['hours'] >= 9 && $time['hours'] <= 18);
		case 2:
			return ($time['wday'] < 1 || $time['wday'] > 5) || ($time['hours'] < 9 || $time['hours'] > 18);
		case 3:
			return true;
		case 0:
			return false;
	}
	return false;
}
  
function comparesubject($content, $contentobject) {
	similar_text($content, $contentobject, $percent);
	return $percent;
} 

function chkunicode($content) {
	return preg_match('/&#[A-Za-z0-9]+/', $content);
}

function updatethread($tids, $action = 'default') {
	if($tids) {
		$tids = is_array($tids) ? dimplode($tids) : $tids;
	} else {
		return false;
	}
	switch($action){
		case 'verify':
			DB::query("UPDATE ".DB::table('forum_post')." SET invisible='".THREAD_VERIFY."' WHERE tid in ($tids)");
			DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder='".THREAD_VERIFY."' WHERE tid in ($tids)");
			return DB::affected_rows();
		case 'recycle':
			addthreadmod($tids, $action = 'DEL', 'reason');
			updatepost(array('invisible' => THREAD_RECYCLE), "tid IN ($tids)");                    
			DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder='".THREAD_RECYCLE."', digest='0', moderated='1' WHERE tid IN ($tids)");          
			return DB::affected_rows();
		case 'recover':
			DB::query("UPDATE ".DB::table('forum_post')." SET invisible='0' WHERE tid in ($tids)");					
			DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder='0' WHERE tid in ($tids)");
			return DB::affected_rows();
		default :
			break;            
	}
	return true;   
}

function updateuser($uid, $action = 'default', $extraparam = array()) {
	if(!$uid || is_array($uid)) {
		return false;
	}
	$param = array(
		'expiry' => 86400,
	);
	foreach($extraparam as $k => $v) {
		$param[$k] = $v;
	}
	if($action == 'banpost' || $action == 'banvisit') {
		$groupid = $action == 'banpost' ? MEMBER_BANPOST : MEMBER_BANVISIT;
		if($param['expiry'] != 0) {
			DB::query("UPDATE ".DB::table('common_member')." SET groupid='$groupid', groupexpiry='$param[expiry]' WHERE uid = '$uid'");
			$groupterms['main'] = array('time' => $param['expiry']); 
			$groupterms['ext'][$groupid] = $groupexpiry;     
			$grouptermsnew = addslashes(serialize($groupterms)); 
			DB::query("UPDATE ".DB::table('common_member_field_forum')." SET groupterms='$grouptermsnew' WHERE uid='$uid'");
		} else {
			return false;
		}      
	} elseif ($action == 'recover') {
		$user = DB::fetch_first("SELECT uid, credits FROM ".DB::table('common_member')." WHERE uid = $uid");
		$usergroup = DB::result_first("SELECT groupid FROM ".DB::table('common_usergroup')." WHERE type = 'member' AND creditshigher <= $user[credits] AND creditslower > $user[credits]");
		DB::query("UPDATE ".DB::table('common_member')." SET groupid='$usergroup' WHERE uid='$uid'");
		DB::query("UPDATE ".DB::table('common_member_field_forum')." SET groupterms='' WHERE uid='$uid'");            
	}
	return true;
}

function addthreadmod($threadmodlist, $action = 'DEL', $reason = '') {
	$reason = lang('plugin/stopspam', $reason);
	foreach(explode(',', str_replace(array('\'', ' '), array('', ''), $threadmodlist)) as $tid) {
		if($tid) {
			$data .= "{$comma} ('$tid', '0', 'stopspam', '".TIMESTAMP."', '$action', '0', '1', '$reason')";
			$comma = ',';
		}
	}
	!empty($data) && DB::query("INSERT INTO ".DB::table('forum_threadmod')." (tid, uid, username, dateline, action, expiration, status, reason) VALUES $data", 'UNBUFFERED');
}

?>