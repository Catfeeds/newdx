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

if(empty($_G['gp_con_access_token']) || !$_G['gp_con_uin']) {
	showmessage('connect_authorized_faild');
}

$params = $_GET;

if(!connect_valid($params, $connect_params)) {
	showmessage('connect_register_bind_miss_uin');
}
//
//if($_G['gp_sig'] != substr(md5($_G['sid'].'|'.$_G['setting']['connectsiteid'].'|'.$_G['config']['security']['authkey']), 8)) {
//	showmessage('connect_register_bind_miss_sig');
//}

unset($connect_params['sig']);

$cookie_expires = 2592000;
dsetcookie('client_created', TIMESTAMP, $cookie_expires);
dsetcookie('client_token', $connect_params['access_token'], $cookie_expires);
dsetcookie('client_expires_in', $connect_params['expires_in'], $cookie_expires);

$user = DB::fetch_first("SELECT uid FROM ".DB::table('common_member')." WHERE conuin='$connect_params[uin]' AND conisbind='1'");
$connect_is_unbind = $connect_params['is_unbind'] == 1 ? 1 : 0;
if($connect_is_unbind && $user && !$_G['uid']) {
	dsetcookie('connect_js_name', 'user_bind', 86400);
	dsetcookie('connect_js_params', base64_encode(serialize(array('type' => 'registerbind'))), 86400);
}

$referer = $_G['gp_referer'] && strpos($referer, 'logging') === false ? $_G['gp_referer'] : 'index.php';
if($_G['uid']) {

	if(DB::result_first("SELECT conisbind FROM ".DB::table('common_member')." WHERE uid='$_G[uid]' AND conuin!='$connect_params[uin]'")) {
		showmessage('connect_register_bind_already', $referer);
	}
	if($user && $user['uid'] != $_G['uid']) {
		showmessage('connect_register_bind_uin_already', $referer);
	}

	DB::query("UPDATE ".DB::table('common_member')." SET conuin='$connect_params[uin]', conisbind='1', conispublishfeed='1', conispublisht='1', conisregister='0', conisqzoneavatar='0' WHERE uid='$_G[uid]'");

	dsetcookie('connect_js_name', 'user_bind', 86400);
	dsetcookie('connect_js_params', base64_encode(serialize(array('type' => 'loginbind'))), 86400);
	dsetcookie('connect_login', 1, 31536000);
	dsetcookie('connect_is_bind', '1', 31536000);
	dsetcookie('connect_uin', $connect_uin, 31536000);
	$_G['member']['conisbind'] = 1;
	$_G['member']['conuin'] = $connect_params['uin'];

	DB::query("INSERT INTO ".DB::table('connect_memberbindlog')." (uid, uin, type, dateline) VALUES ('$_G[uid]', '$connect_params[uin]', '1', '$_G[timestamp]')");

	include_once libfile('function/stat');
	updatestat('con_bind_suc', 1);

	showmessage('connect_register_bind_success', $referer);

} else {
	if($user && $user['uid']) {
		$params['mod'] = 'login';
		connect_login($connect_params['uin']);

		loadcache('usergroups');
		$usergroups = $_G['cache']['usergroups'][$_G['groupid']]['grouptitle'];
		$param = array('username' => $_G['member']['username']);

		DB::query("UPDATE ".DB::table('common_member_status')." SET lastip='".$_G['clientip']."', lastvisit='".time()."' WHERE uid='$_G[uid]'");
		$ucsynlogin = '';
		if($_G['setting']['allowsynlogin']) {
			loaducenter();
			$ucsynlogin = uc_user_synlogin($_G['uid']);
		}

		showmessage('login_succeed', dreferer(), $param, array('extrajs' => $ucsynlogin));
	} else {
		$params['mod'] = 'register';
		$params['referer'] = $referer;
		$redirect = 'connect.php?'.http_build_query($params);
		dheader("Location: $redirect");
	}
}

function connect_login($uin) {
	global $_G;

	$member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE conuin='$uin' AND conisbind='1'");
	if(!$member) {
		return false;
	}

	require_once libfile('function/member');
	$cookietime = 1296000;
	setloginstatus($member, $cookietime);
	$_G['cookie']['connect_login'] = 1;
	dsetcookie('connect_login', 1, $cookietime);

	include_once libfile('function/stat');
	updatestat('login', 1);
	updatestat('con_login_suc');
	updatestat('con_login_user_suc', 1);

	updatecreditbyaction('daylogin', $_G['uid']);
	checkusergroup($_G['uid']);
	return true;
}

?>