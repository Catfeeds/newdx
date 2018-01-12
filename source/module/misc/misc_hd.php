<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: misc_error.php 6790 2010-03-25 12:30:53Z cnteacher $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if($_G['gp_action'] == 'getformlist' && $_G['uid']) {
	require_once libfile('function/activity');	
	$return = array('status' => 0);
	
	$return['tpllist'] = getformtpllist($_G['uid']);
	if($return['tpllist']){
		$return['status'] = 1;
	}
	foreach ($return['tpllist'] as $key => $finfo) {
		$return['tpllist'][$key] = diconv($finfo['formname'], 'gbk', 'utf-8');
	}
	echo json_encode($return);
	die;
}elseif($_G['gp_action'] == 'gohd' && $_G['uid']){
	loaducenter();
	$ucsynlogin = uc_user_synlogin($_G['uid']);
	showmessage('即将带您去新建报名表', 'http://hd.8264.com/index.php?app=formtpl&act=addform&s=p', array(), array(
				'showdialog' => 1,
				'locationtime' => true,
				'extrajs' => $ucsynlogin));
}
?>