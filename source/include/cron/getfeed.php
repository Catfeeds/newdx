<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: getfeed.php 12304 2009-06-03 07:29:34Z liguode $
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include_once(DISCUZ_ROOT.'./config/config_ucenter.php');
include_once(DISCUZ_ROOT.'./uc_client/client.php');

function sstripslashes($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = sstripslashes($val);
		}
	} else {
		$string = stripslashes($string);
	}
	return $string;
}

if($results = uc_feed_get(10)) {

	$cols = array('uid','username','appid','icon','dateline','hash_template','hash_data','title_template','title_data','body_template','body_data','body_general','image_1','image_1_link','image_2','image_2_link','image_3','image_3_link','image_4','image_4_link','target_ids');
	
	$inserts = array();
	foreach ($results as $value) {
		if(empty($value['uid']) || empty($value['username'])) continue;
		
		$vs = array();
		foreach ($cols as $key) {
			if(is_array($value[$key])) {
				$value[$key] = addslashes(serialize(sstripslashes($value[$key])));
			} else {
				$value[$key] = addslashes(sstripslashes($value[$key]));
			}
			$vs[] = '\''.$value[$key].'\'';
		}
		$inserts[] = '('.implode(',', $vs).')';
	}
	
	if($inserts) {
		DB::query("INSERT INTO ".DB::table('home_feed')." (".implode(',', $cols).") VALUES ".implode(',', $inserts));
	}
}
?>