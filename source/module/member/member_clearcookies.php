<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: member_clearcookies.php 12326 2010-07-05 06:42:42Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('NOROBOT', TRUE);

if(is_array($_COOKIE) && (empty($_G['uid']) || ($_G['uid'] && $_G['formhash'] == formhash()))) {
	/*foreach($_G['cookie'] as $key => $val) {*/
		/*dsetcookie($key, '', -1, 0);*/
        /*临时解决清除COOKIES 502问题*/
        /*setcookie($key,null);*/
        /*END*/
	/*}*/
	clearcookies();
	$_G['groupid'] = $_G['member']['groupid'] = 7;
	$_G['uid'] = $_G['member']['uid'] = 0;
	$_G['username'] = $_G['member']['username'] = $_G['member']['password'] = '';
    /*临时解决清楚COOKIES 502问题*/
    echo "<meta http-equiv='refresh'content=0;URL='".$_G['config']['web']['forum']."'>";exit();
    /*END*/
	foreach($_COOKIE as $key => $val) {
		setcookie($key, '', -1, $_G['config']['cookie']['cookiepath'], '');
	}
}

showmessage('login_clearcookie', 'forum.php', array(), $_G['inajax'] ? array('msgtype' => 3, 'showmsg' => true) : array());

?>