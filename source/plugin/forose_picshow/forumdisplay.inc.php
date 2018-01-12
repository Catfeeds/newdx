<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!isset($_G['cache']['plugin'])){
	loadcache('plugin');
}
if(isset($_G['cache']['plugin']['forose_picshow'])){
	@extract($_G['cache']['plugin']['forose_picshow']);
	$usefids=(array)unserialize($usefids);
	if(in_array($_G['fid'],$usefids)){
		$template="forose_picshow:forumdisplay_pic";
	}
}


?>