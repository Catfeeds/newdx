<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: spacecp_search.php 19158 2010-12-20 08:21:50Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$myfields = array('uid','gender','birthyear','birthmonth','birthday','birthprovince','birthcity','resideprovince','residecity', 'residedist', 'residecommunity');

loadcache('profilesetting');
$fields = array();
foreach ($_G['cache']['profilesetting'] as $key => $value) {
	if($value['title'] && $value['available'] && $value['allowsearch'] && !in_array($key, $myfields)) {
		$fields[$value['fieldid']] = $value;
	}
}

$nowy = dgmdate($_G['timestamp'], 'Y');

if(!empty($_GET['searchsubmit']) || !empty($_GET['searchmode'])) {
	$_GET['searchsubmit'] = $_GET['searchmode'] = 1;
	$wherearr = $fromarr = $uidjoin = array();
	$fsql = '';

	$fromarr['member'] = DB::table('common_member').' s';

	if($searchkey = stripsearchkey($_GET['searchkey'])) {
		$wherearr[] = "s.username='$searchkey'";
		$searchkey = dhtmlspecialchars($searchkey);
	} else {
		foreach (array('uid','username','videophotostatus','avatarstatus') as $value) {
			if($_GET[$value]) {
				if($value == 'username') {
					$_GET[$value] = stripsearchkey($_GET[$value]);
					$wherearr[] = "s.$value LIKE '%{$_GET[$value]}%'";
				} else {
					$wherearr[] = "s.$value='{$_GET[$value]}'";
				}
			}
		}
	}

	$startage = $endage = 0;
	if($_GET['endage']) {
		$startage = $nowy - intval($_GET['endage']);
	}
	if($_GET['startage']) {
		$endage = $nowy - intval($_GET['startage']);
	}

	if($startage && $endage && $endage > $startage) {
		$wherearr[] = '(sf.birthyear>='.$startage.' AND sf.birthyear<='.$endage.')';
	} else if($startage && empty($endage)) {
		$wherearr[] = 'sf.birthyear>='.$startage;
	} else if(empty($startage) && $endage) {
		$wherearr[] = 'sf.birthyear<='.$endage;
	}

	$havefield = 0;
	foreach ($myfields as $fkey) {
		$_GET[$fkey] = trim($_GET[$fkey]);
		if($_GET[$fkey]) {
			$havefield = 1;
			$wherearr[] = "sf.$fkey = '$_GET[$fkey]'";
		}
	}

	foreach ($fields as $fkey => $fvalue) {
		$_GET['field_'.$fkey] = empty($_GET['field_'.$fkey])?'':stripsearchkey($_GET['field_'.$fkey]);
		if($_GET['field_'.$fkey]) {
			$havefield = 1;
			$wherearr[] = "sf.$fkey LIKE '%".$_GET['field_'.$fkey]."%'";
		}
	}

	if($havefield || $startage || $endage) {
		$fromarr['profile'] = DB::table('common_member_profile').' sf';
		$wherearr['profile'] = "sf.uid=s.uid";
	}

	$list = array();
	if($wherearr) {

		$space['friends'] = array();
		$query = DB::query("SELECT fuid, fusername FROM ".DB::table('home_friend')." WHERE uid='$_G[uid]'");
		while ($value = DB::fetch($query)) {
			$space['friends'][$value['fuid']] = $value['fuid'];
		}

		$query = DB::query("SELECT s.* $fsql FROM ".implode(',', $fromarr)." WHERE ".implode(' AND ', $wherearr)." LIMIT 0,100");
		while ($value = DB::fetch($query)) {
			$value['isfriend'] = ($value['uid']==$space['uid'] || $space['friends'][$value['uid']])?1:0;
			$list[$value['uid']] = $value;
		}
	}


} else {

	$yearhtml = '';

	for ($i=0; $i<50; $i++) {
		$they = $nowy - $i;
		$yearhtml .= "<option value=\"$they\">$they</option>";
	}

	$sexarr = array($space['sex']=>' checked=\"checked\"');

	$birthyeayhtml = '';
	for ($i=0; $i<100; $i++) {
		$they = $nowy - $i;
		if(empty($_GET['all'])) $selectstr = $they == $space['birthyear']?' selected=\"selected\"':'';
		$birthyeayhtml .= "<option value=\"$they\"$selectstr>$they</option>";
	}
	$birthmonthhtml = '';
	for ($i=1; $i<13; $i++) {
		if(empty($_GET['all'])) $selectstr = $i == $space['birthmonth']?' selected=\"selected\"':'';
		$birthmonthhtml .= "<option value=\"$i\"$selectstr>$i</option>";
	}
	$birthdayhtml = '';
	for ($i=1; $i<29; $i++) {
		if(empty($_GET['all'])) $selectstr = $i == $space['birthday']?' selected=\"selected\"':'';
		$birthdayhtml .= "<option value=\"$i\"$selectstr>$i</option>";
	}
	$bloodhtml = '';
	foreach (array('A','B','O','AB') as $value) {
		if(empty($_GET['all'])) $selectstr = $value == $space['blood']?' selected=\"selected\"':'';
		$bloodhtml .= "<option value=\"$value\"$selectstr>$value</option>";
	}
	$marryarr = array($space['marry'] => ' selected');

	include_once libfile('function/profile');
	$birthcityhtml = showdistrict(array(0,0), array('birthprovince', 'birthcity'), 'birthcitybox');
	$residecityhtml = showdistrict(array(0,0, 0, 0), array('resideprovince', 'residecity', 'residedist', 'residecommunity'), 'residecitybox');

	foreach ($fields as $fkey => $fvalue) {
		if(empty($fvalue['choices'])) {
			$fvalue['html'] = '<input type="text" name="field_'.$fkey.'" value="" class="px" />';
		} else {
			$fvalue['html'] = "<select name=\"field_$fkey\"><option value=\"\">---</option>";
			$optionarr = explode("\n", $fvalue['choices']);
			foreach ($optionarr as $ov) {
				$ov = trim($ov);
				if($ov) {
					$fvalue['html'] .= "<option value=\"$ov\">$ov</option>";
				}
			}
			$fvalue['html'] .= "</select>";
		}
		$fields[$fkey] = $fvalue;
	}
}

$navtitle = lang('core', 'title_search_friend');

$actives = array($op=>' class="a"');

// lxp 20140318
if($_G['newtpl']){
	// 邀请列表
	/*$invite_thread = memory('get' , 'plugin_invite_cache_uid_'.$_G['uid']);
	if(!$invite_thread){
		$invite_thread = array();
		$query = DB::query('SELECT im.* FROM '.DB::table('plugin_invite_relation').' ir
			LEFT JOIN '.DB::table('plugin_invite_message').' im ON ir.mid = im.mid
			WHERE ir.status = 1 AND ir.tousers LIKE \'%('.$_G['uid'].')%\' ORDER BY ir.dateline DESC');
		while($v = DB::fetch($query)){
			$reads_mid = memory('get' , 'plugin_invite_cache_mid_reads_'.$v['mid']);
			if(!$reads_mid){
				$midread = DB::result_first("SELECT readuid FROM ".DB::table('plugin_invite_readed')." WHERE mid = {$v[mid]}");
				$reads_mid = explode(',' ,$midread);
				memory('set' , 'plugin_invite_cache_mid_reads_'.$v['mid'] , $reads_mid , 3600);
			}
			if(in_array($_G['uid'] , $reads_mid)) continue;
			$invite_thread['invite_'.$v['mid']] = $v;
		}
		memory('set' , 'plugin_invite_cache_uid_'.$_G['uid'] , $invite_thread , 60);
	}
	$invite_thread_count = count($invite_thread);*/
	$invite_thread_count = $_G['member']['newinvite'];
	// 短消息数量
// 	loaducenter();
// 	$newpm = uc_pm_list($_G['uid']);
	// 任务数量
	/*$sql = "SELECT COUNT(*) AS count FROM ".DB::table('common_task')." t
		LEFT JOIN ".DB::table('common_mytask')." mt ON mt.taskid=t.taskid AND mt.uid='$_G[uid]'
		WHERE (mt.taskid IS NULL OR (ABS(mt.status)='1' AND t.period>0)) AND t.available='2' ORDER BY t.displayorder, t.taskid DESC";
		$taskcount = DB::result_first($sql);*/
	require_once libfile('class/task');
	$tasklib = & task::instance();
	$tasklist = $tasklib->tasklist('new');
	$taskcount = count($tasklist);
}
include template('home/spacecp_search');

?>