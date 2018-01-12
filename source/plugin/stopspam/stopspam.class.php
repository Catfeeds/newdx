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

include_once 'function_stopspam.php';

class plugin_stopspam {
	
	var $statisticstime = 3600;		
	var $threadnumberpertime = 5;	
	var $smpercent = 60;			
	
	function plugin_stopspam() {
		global $_G;	
		$this->threadnumberpertime = $_G['cache']['plugin']['stopspam']['threadnumberpertime'];
		$this->statisticstime = $_G['cache']['plugin']['stopspam']['time'];
		$this->smpercent = $_G['cache']['plugin']['stopspam']['percent'];
		return;
	}
}

class plugin_stopspam_forum extends plugin_stopspam {

	function post_stopspam() {
		global $_G;
		if(!checktime($_G['cache']['plugin']['stopspam']['allowtime'], TIMESTAMP) || $_G['config']['admincp']['founder'] == $_G['uid']){
			return false;
		}
		if($_G['cache']['plugin']['stopspam']['filterunicode'] && chkunicode($_G['gp_subject'])) {
			showmessage(lang('plugin/stopspam', 'post_unicode'));
		}
		if($_G['gp_action'] == 'reply') {
			return false;
		}
		$ingroups = unserialize($_G['cache']['plugin']['stopspam']['ingroups']);
		$inforums = unserialize($_G['cache']['plugin']['stopspam']['inforums']);
		if(!in_array($_G['groupid'], $ingroups) || !(in_array($_G['fid'], $inforums) || in_array(0, $inforums))){
			return false;
		}  
		$sql = "b.authorid='$_G[uid]' AND a.tid=b.tid AND b.dateline>=".(TIMESTAMP - $this->statisticstime);
		if($_G['tid']) {
			$sql .= " AND a.tid != '$_G[tid]'";
		}
		$query = DB::query("SELECT DISTINCT a.subject,a.tid FROM ".DB::table('forum_thread')." a, ".DB::table('forum_post')." b WHERE  $sql");
		$threadcountpertime = DB::num_rows($query);
		if($threadcountpertime < $this->threadnumberpertime) {
			return false;
		}
		while ($result = DB::fetch($query)) {
			if ($this->smpercent <= comparesubject($_G['gp_subject'], $result['subject'])) { 
				$tidlist[] = $result['tid']; 
			}		
		}
		if(empty($tidlist)) {
			return false;
		}
		$tids = dimplode($tidlist);
		if($_G['cache']['plugin']['stopspam']['dispose'] == 0) {
			updatethread($tids, 'recycle');
		} elseif($_G['cache']['plugin']['stopspam']['dispose'] == 1) { 
			updatethread($tids, 'verify');
		} 
		$dispose = $_G['cache']['plugin']['stopspam']['bannedtype'] == 1 ? 'banpost' : 'banvisit';
		$expiry = TIMESTAMP + $_G['cache']['plugin']['stopspam']['bannedtime'];
		updateuser($_G['uid'], $dispose, array('expiry' => $expiry));
		
		foreach($tidlist as $tid) {
			$data = array('tid' => $tid, 'authorid' => $_G['uid']); 
			DB::result_first("SELECT COUNT(*) FROM ".DB::table('stopspam_thread')." WHERE tid = $tid") || DB::insert('stopspam_thread', $data);
		} 
		
		DB::result_first("SELECT COUNT(*) FROM ".DB::table('stopspam_user')." WHERE uid='$_G[uid]'") == 0 ?
		DB::query("INSERT INTO ".DB::table('stopspam_user')." (uid, username, lastsubject, bandate, dispose) VALUES ('$_G[uid]', '$_G[username]', '$_G[gp_subject]', '".TIMESTAMP."', '".$_G['cache']['plugin']['stopspam']['bannedtype']."')") :
		DB::query("UPDATE ".DB::table('stopspam_user')." SET lastsubject='$_G[gp_subject]', bandate = '".TIMESTAMP."', dispose = '".$_G['cache']['plugin']['stopspam']['bannedtype']."' WHERE uid='$_G[uid]'");
		
		showmessage(lang('plugin/stopspam', 'post_failed'), "forum.php?mod=forumdisplay&fid=$_G[fid]");
	}
}

?>