<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: myrepeats.class.php 22550 2011-05-12 05:21:39Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_myrepeats {
	public $list_all;
	private $norepeates;
	function plugin_myrepeats() {
		global $_G;
		$this->norepeates = false;
		if(!$_G['uid']) {
			return;
		}

		$myrepeatsusergroups = (array)unserialize($_G['cache']['plugin']['myrepeats']['usergroups']);
		if(in_array('', $myrepeatsusergroups)) {
			$myrepeatsusergroups = array();
		}
		if(!in_array($_G['groupid'], $myrepeatsusergroups)) {
			if(isset($_G['cookie']['mrn'])) {
				$count = $_G['cookie']['mrn'];
			} else {
				$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('myrepeats')." WHERE username='$_G[username]'");
				dsetcookie('mrn', $count, 3600);
			}
			if(!$count) {
				unset($_G['setting']['plugins']['spacecp']['myrepeats:memcp']);
				$this->norepeates = true;
				return;
			}
		}

		if(isset($_G['cookie']['mrd'])) {
			$userlist = explode("\t", $_G['cookie']['mrd']);
		} else {
			$userlist = array();
			$query = DB::query("SELECT username FROM ".DB::table('myrepeats')." WHERE uid='$_G[uid]'");
			while($user = DB::fetch($query)) {
				$userlist[] = $user['username'];
			}
			if(count($userlist) <= 20 && !empty($userlist)){
				$cookievalue = implode("\t", $userlist);
				dsetcookie('mrd', $cookievalue ? $cookievalue : "\t", 3600);
			}
		}
		foreach($userlist as $_k => $_user){
			$_user = stripslashes($_user);
			$nuserlist[$_k]['name'] = $_user;
			$nuserlist[$_k]['uname'] = rawurlencode($_user);
		}
		$this->list_all = $nuserlist;
		return $nuserlist;
	}

	function global_usernav_extra1($params) {
		if($this->norepeates){
			return;
		}
		$nuserlist = $this->list_all;
		$language = lang('plugin/myrepeats');
		global $_G;
	 	$nowtpl = $_G['newtpl'];
	 	if(strpos($params['header'], '_new') !== false && $nowtpl || strpos($params['header'], 'dianping/header') !== false || strpos($params['header'], 'common/header_8264_new') !== false){
	 		include template('myrepeats:myheader_2014');
	 	}else{
		 	$_G['newtpl'] = false;
	 		include template('myrepeats:myheader');
	 		$_G['newtpl'] = $nowtpl;
	 	}
		return $myheader;
	}
	

	function global_footer($params) {
		if($this->norepeates){
			return;
		}
		$nuserlist = $this->list_all;
		global $_G;
		$language = lang('plugin/myrepeats');
		$nowtpl = $_G['newtpl'];
	 	if(strpos($params['header'], '_new') !== false && $nowtpl || strpos($params['header'], 'dianping/header') !== false || strpos($params['header'], 'common/header_8264_new') !== false){
	 		include template('myrepeats:myfooter_2014');
	 	}else{
	 		$_G['newtpl'] = false;
	 		include template('myrepeats:myfooter');
	 		$_G['newtpl'] = $nowtpl;
	 	}
		return $myfooter;
	}
	

}

class plugin_myrepeats_member extends plugin_myrepeats {

	function logging_myrepeats_output() {
		dsetcookie('mrn', '');
		dsetcookie('mrd', '');
	}

}
