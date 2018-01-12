<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: misc_ajax.php 13315 2010-07-26 02:09:58Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$op=$_G['gp_op'];
$id = empty($_GET['id'])?0:intval($_GET['id']);
if($op == 'del_fav') {
	if(submitcheck('delimgsubmit')) {
		//showmessage($disp);
		$return = DB::query("delete FROM ".DB::table('yingyong_fav')." where id=$id");
		showmessage('do_success','fav.php',array());
	}
}elseif($op=='header'){
	$s_url=($_G['gp_url']);
	$nav_string=strtolower(substr(strrchr($s_url, '/'), 1, 10));
	
}
include template('yingyong/ajax');

?>