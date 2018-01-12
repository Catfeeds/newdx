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

error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('PRC');
set_time_limit(360000);

require_once WEBSITEPATH.'/source/plugin/forumoption/produce.php';
DB::query("UPDATE ".DB::table('plugin_produce_info')." SET rank = rank - 40 WHERE rank > 0");
DB::query("UPDATE ".DB::table('plugin_produce_info')." SET rank = 0 WHERE rank < 0");
DB::query("UPDATE ".DB::table('plugin_produce_publichers')." SET rank = 0 WHERE rank < 0");



//file_put_contents(WEBSITEPATH.'/source/plugin/components/product_rank.log', "Executed In ".date("Y-m-d H:i:s")."\n", FILE_APPEND);
