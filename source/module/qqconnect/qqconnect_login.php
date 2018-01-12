<?php

/*inspect access permission*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/connect');

/*define qqconnect path*/
define('QQCONNECT', dirname(__FILE__));

require_once QQCONNECT . '/API/entrance.php';
$op = !empty($_G['gp_op']) ? $_G['gp_op'] : '';
$referer = $_GET['referer'];
//preg_match('/^(http|https|ftp|javascript):/i', $referer, $matches);
//if($matches) {
//	$referer = 'forum.php';
//}

$code = $_GET['code'];
$qc = new QC();

if ($op == 'init') {
	$qc->qq_login();
}
elseif(! $op && $code) {

	$back_state = $_GET['state'];
	$access_token = $qc->qq_callback($back_state);
	/*make requests to get access_token and open_id, if error occurs(can not get access_token or open_id), alert error*/
	if($access_token) {
		$openid = $qc->get_openid($access_token);
	}
	else {
		showmessage('qqconnect:connect_get_access_token_failed', $referer);
	}
	$log->log_str(strtr('用户尝试使用 open_id[%open_id] qq登录!', array(
				'%open_id' => $openid
			)));


	if($openid) {
		$connect_member = DB::fetch_first("SELECT uid, conopenid FROM ". DB::table('common_member_connect')." WHERE conopenid='$openid'");
	}
	else {
		showmessage('qqconnect:connect_get_access_token_failed', $referer);
	}
	if($connect_member) {
		$member = DB::fetch_first("SELECT uid, conisbind FROM ".DB::table('common_member')." WHERE uid='$connect_member[uid]'");
		if($member) {
			if(! $member['conisbind']) {
				unset($connect_member);
			} else {
				$connect_member['conisbind'] = $member['conisbind'];
			}
		} else {
			DB::delete('common_member_connect', array('uid' => $connect_member['uid']));
			unset($connect_member);
		}
	}
	if($_G['uid']) {
		//todo
		if($connect_member['uid'] && $_G['uid'] != $connect_member['uid']) {
			//todo
		}

		$current_connect_member = DB::fetch_first("SELECT * FROM ".DB::table('common_member_connect')." WHERE uid='$_G[uid]'");
		if(! $current_connect_member) {
			DB::query("INSERT INTO ".DB::table('common_member_connect')." (uid,  conopenid) VALUES ('$_G[uid]', '$openid'");
			// TODO
		}
		DB::query("UPDATE ".DB::table('common_member')." SET conisbind='1' WHERE uid='$_G[uid]'");

		// DB::query("INSERT INTO ".DB::table('connect_memberbindlog')." (uid, uin, type, dateline) VALUES ('$_G[uid]', '$conuin', '1', '$_G[timestamp]')");

		showmessage('qqconnect:connect_register_bind_success', $referer);
	}
	else {
		if($connect_member) {
            $log->log_str(strtr('用户使用 open_id[%open_id] qq登录, %username[%userid] 登录成功!', array(
				'%open_id' => $openid,
				'%username' => $member['username'],
				'%userid' => $member['uid']
			)));

			//to_do
			connect_login($connect_member);

			loadcache('usergroups');
			$usergroups = $_G['cache']['usergroups'][$_G['groupid']]['grouptitle'];
			$param = array('username' => $_G['member']['username'], 'usergroup' => $_G['group']['grouptitle']);

			DB::query("UPDATE ".DB::table('common_member_status')." SET lastip='".$_G['clientip']."', lastvisit='".time()."' WHERE uid='$connect_member[uid]'");
			$ucsynlogin = '';
			if($_G['setting']['allowsynlogin']) {
				loaducenter();
				$ucsynlogin = uc_user_synlogin($_G['uid']);
			}

			showmessage('login_succeed', $referer, $param, array('extrajs' => $ucsynlogin));
		} else {
			$log->log_str(strtr('用户使用 open_id[%open_id] qq登录, 跳转至注册页面!', array(
				'%open_id' => $openid
			)));

			//to_do
			$params = array();

			$auth_hash = authcode($openid, 'ENCODE');
			dsetcookie('con_auth_hash', $auth_hash);
			$params['con_auth_hash'] = $auth_hash;

			$params['mod'] = 'register';
			$params['referer'] = $referer;
            $params['nickname'] = $qc->get_user_info($access_token, $openid);
			//connect.php?mod=register&referer=forum.php
			//connect.php?receive=yes&mod=register&referer=forum.php&con_is_user_info=1&con_is_feed=1&con_sig=44a97ca1e0efc86313e3a08ff7b441c4&diy=&con_auth_hash=522agWEFhJJLokpr8%2B7cWIhwgrYbIigJKu576k3aju0mnIBTJIAB2ghGA2t9s4B%2FzdZ05puYES78dzTdSCftoNtIxunWSPgXnB%2Bnmmg5D62zZc41JeOVeMsVNQjlzvS1WiWEfK%2FnhEtH9jKxLbtTqdLi%2Frt2hdEbsVLv4QUlrzKaR%2B9%2F%2BoKB599loS0J8reaccH6h3je%2FK0k0FmLXmpHSYqcwDIYIk9esRKiH7mWUSZFl1RLUSWT6Bs3qY1Q4CVr8RKeMZmhDKsjj%2FCshyrRmp2fABX7RbmN2al49sTSX5IGbxNbJ%2F4uaMKrZij1H6eXl8FZUGVaof%2FJQOIeDfbKidIGOIxIsJtzbEL67T6OfIPzLA
			$redirect = 'connect.php?' . cloud_http_build_query($params, '', '&');
            dheader("Location: $redirect");
		}
	}
}
elseif($op == 'change') {
	$qc->qq_login();
}




function connect_login($connect_member) {
	global $_G;

	$member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE uid='$connect_member[uid]'");
	if(!$member) {
		return false;
	}

	require_once libfile('function/member');
	$cookietime = 1296000;
	setloginstatus($member, $cookietime);

	dsetcookie('connect_login', 1, $cookietime);
	dsetcookie('connect_is_bind', 1, 31536000);
	dsetcookie('connect_uin', $connect_member['conopenid'], 31536000);

	include_once libfile('function/stat');
	updatestat('login', 1);

	updatecreditbyaction('daylogin', $_G['uid']);
	checkusergroup($_G['uid']);
	return true;
}
