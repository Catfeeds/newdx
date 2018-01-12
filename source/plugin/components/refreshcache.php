<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum.php 16805 2010-09-15 03:56:11Z zhangguosheng $
 */
define('WEBSITEPATH', '/www/wwwroot/newdx');

define('APPTYPEID', 2);
define('CURSCRIPT', 'forum');

require WEBSITEPATH.'/source/class/class_core.php';
require WEBSITEPATH.'/source/function/function_forum.php';

$discuz = & discuz_core::instance();


$modarray = array('ajax','announcement','attachment','forumdisplay',
	'group','image','index','medal','misc','modcp','notice','post','redirect',
	'relatekw','relatethread','rss','topicadmin','trade','viewthread'
);

$modcachelist = array(
	'index'		=> array('announcements', 'onlinelist', 'forumlinks', 'advs_index',
			'heats', 'historyposts', 'onlinerecord', 'userstats'),
	'forumdisplay'	=> array('smilies', 'announcements_forum', 'globalstick', 'forums',
			'icons', 'onlinelist', 'forumstick','threadtable_info', 'threadtableids', 'stamps'),
	'viewthread'	=> array('smilies', 'smileytypes', 'forums', 'usergroups', 'ranks',
			'stamps', 'bbcodes', 'smilies',	'custominfo', 'groupicon', 'stamps',
			'threadtableids', 'threadtable_info'),
	'post'		=> array('bbcodes_display', 'bbcodes', 'smileycodes', 'smilies', 'smileytypes',
			'icons', 'domainwhitelist'),
	'space'		=> array('fields_required', 'fields_optional', 'custominfo'),
	'group'		=> array('grouptype'),
);

$mod = !in_array($discuz->var['mod'], $modarray) ? 'index' : $discuz->var['mod'];

define('CURMODULE', $mod != 'redirect' ? $mod : 'viewthread');
$cachelist = array();
if(isset($modcachelist[CURMODULE])) {
	$cachelist = $modcachelist[CURMODULE];
}
if($discuz->var['mod'] == 'group') {
	$_G['basescript'] = 'group';
}

$discuz->cachelist = $cachelist;
$discuz->init();

loadforum();
set_rssauth();
runhooks();
/*
error_reporting(E_ALL & ~E_NOTICE);
$output = exec('ps -ef|grep refreshcache.php|grep -v grep');
if (substr_count($output, 'refreshcache') > 1) exit;

date_default_timezone_set('PRC');
set_time_limit(360000);

require_once WEBSITEPATH.'/source/plugin/components/CachedataLogger.php';
require_once WEBSITEPATH.'/source/plugin/forumoption/mountion.php';
require_once WEBSITEPATH.'/source/plugin/forumoption/mudidi.php';
require_once WEBSITEPATH.'/source/plugin/forumoption/produce.php';
require_once WEBSITEPATH.'/source/plugin/forumoption/brand.php';
require_once WEBSITEPATH.'/source/plugin/searchindex/SearchKey.php';

function refreshCache() {
	$num = 0;
	$query = DB::query("SELECT * FROM ".DB::table('plugin_cachedata')." WHERE logged=1 ORDER BY loggedtime ASC LIMIT 20");

	while ($value = DB::fetch($query)) {
		$methodinfoArray = unserialize($value['methodinfo']);
		$data = call_user_func_array(array($methodinfoArray['class'], $methodinfoArray['method']), $methodinfoArray['arguments']);
		$cachetime = $CachedateLogger_config[$methodinfoArray['class']][$methodinfoArray['method']]['cacheTime'];
		if ($cachetime == NULL) {
			$cachetime = 0;
		}
		$serializeData = serialize($data);
		$serializeData = addcslashes($serializeData, "\\'");
		$expire = time() + $cachetime;

		DB::query("UPDATE ".DB::table('plugin_cachedata')." SET value='{$serializeData}', expire='$expire', logged=0, loggedtime=0 WHERE id = {$value['id']}");
		++$num;
	}

	return $num;
}

$total = 0;
while (true) {
	$num = refreshCache();
	$total += $num;

	$time = time();
	$begin_today = strtotime(date('Y-m-d', $time));
	$end_today = $begin_today + 86399;

	$log = DB::fetch_first("SELECT * FROM ".DB::table('plugin_cachedata_log')." WHERE datetime >= $begin_today AND datetime <= $end_today");
	if ($log && $log['id']) {
		DB::query("UPDATE ".DB::table('plugin_cachedata_log')." set datetime = $time, exednum = ".($num+intval($log['exednum']))." WHERE id={$log['id']}");
	} else {
		DB::query("INSERT INTO ".DB::table('plugin_cachedata_log')." (datetime, exednum) VALUES (".$time.", '{$total}')");
	}

	if ($num == 0 || date('G', time()) >= 18) break;
}

echo "Executed row of $total In ".date("Y-m-d H:i:s")."\n";
exit;
*/
