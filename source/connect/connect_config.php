<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: discuz_version.php 16902 2010-09-16 09:18:28Z cnteacher $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(empty($_G['uid'])) {
	showmessage('to_login', '', array(), array('showmsg' => true, 'login' => 1));
}

$op = !empty($_G['gp_op']) ? $_G['gp_op'] : '';

if(submitcheck('connectsubmit')) {
	if($op == 'config') {
		// 设置参数
		$ispublishfeed = !empty($_G['gp_ispublishfeed']) ? 1 : 0;
		$ispublisht = !empty($_G['gp_ispublisht']) ? 1 : 0;
		DB::query("UPDATE ".DB::table('common_member')." SET conispublishfeed='$ispublishfeed',conispublisht='$ispublisht' WHERE uid='$_G[uid]'");
		showmessage('connect_config_success', dreferer());
	} elseif($op == 'unbind') {

		// 解绑
		if(!$_G['cookie']['client_token']) {
			showmessage('connect_config_unbind_failed', dreferer());
		}
		if($_G['member']['conisregister']) {			
			if($_G['gp_newpassword1'] !== $_G['gp_newpassword2']) {
				showmessage('profile_passwd_notmatch', dreferer());
			}

			if(!$_G['gp_newpassword1'] || $_G['gp_newpassword1'] != addslashes($_G['gp_newpassword1'])) {
				showmessage('profile_passwd_illegal', dreferer());
			}
		}

		require_once libfile('function/connect');
		$result = connect_user_unbind($_G['member']['conuin']);
		if(!$result || $result['errCode'] != 0) {
			showmessage('connect_config_unbind_busy', dreferer());
		}

		DB::query("INSERT INTO ".DB::table('connect_memberbindlog')." (uid, uin, type, dateline) VALUES ('$_G[uid]', '{$_G[member][conuin]}', '2', '$_G[timestamp]')");

		// 更改用户绑定状态
		DB::query("UPDATE ".DB::table('common_member')." SET conisbind='0', conuin='', conisregister='0' WHERE uid='$_G[uid]'");

		// 改密码
		if($_G['member']['conisregister']) {
			loaducenter();
			uc_user_edit($_G['member']['username'], null, $_G['gp_newpassword1'], null, 1);
		}

		foreach($_G['cookie'] as $k => $v) {
			dsetcookie($k);
		}

		include_once libfile('function/stat');
		updatestat('con_unbind_suc', 1);

		$_G['uid'] = $_G['adminid'] = 0;
		$_G['username'] = $_G['member']['password'] = '';	

		showmessage('connect_config_unbind_success', 'member.php?mod=logging&action=login');
	}
} else {
	$actives['qq'] = ' class="a"';
	// 显示
	$referer = str_replace($_G['siteurl'], '', dreferer());
	if(!empty($_G['gp_connect_autoshare'])) {
		if(strpos($referer, '?') !== false) {
			$referer .= '&connect_autoshare=1';
		} else {
			$referer .= '?connect_autoshare=1';
		}
	}

	$_G['connect']['redirect_url'] = $_G['siteurl'].'connect.php?mod=dispatch&referer='.urlencode($referer);
	$_G['connect']['loginbind_url'] = $_G['connect']['url'].'/discuz/login?s_id='.$_G['setting']['connectsiteid'].'&redirect_url='.urlencode($_G['connect']['redirect_url']).'&type=loginbind';

	include template('home/spacecp_connect');
}

?>