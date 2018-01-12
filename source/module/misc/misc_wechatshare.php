<?php

/**
 * @summary 活动微信分享相关的操作
 * @author shuaiquan
 * @copyright 2015
 */

if($_G['gp_action'] == 'setfollowgroup') {
	
	$_G['gp_tid'] 		= $_G['gp_tid'] ? intval($_G['gp_tid']) : 0;
	$_G['gp_groupids']  = $_G['gp_groupids'] ? $_G['gp_groupids'] : '';
	
	if (!$_G['gp_tid']) {
		echo '';
		exit();
	}
	
	DB::delete('common_share_follow_group',"tid = {$_G['gp_tid']}");	
	if ($_G['gp_groupids']) {
		DB::insert('common_share_follow_group', array('tid'=>$_G['gp_tid'], 'groups'=>$_G['gp_groupids']));
	}	
	
	echo $_G['gp_groupids'];
	exit();
}
?>