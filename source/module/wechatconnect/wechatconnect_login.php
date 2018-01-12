<?php
/*
* 微信登陆
*/
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('WECHAT_CONNECT', dirname(__FILE__));

$wechat_path = WECHAT_CONNECT . '/API/class/wechat.class.php';
if(! file_exists($wechat_path)) {
	$err_msg = $wechat_path . ' DOES NOT exist!';
	error_log($err_msg);
	exit($err_msg);
}

require_once $wechat_path;
$op = $_G['gp_op'];
$wechat = new Wechat();
if($op == 'init') {
	$wechat->wechat_login();
}
elseif($_GET['state'] && $_GET['code']) {

	$state = $_GET['state'];
	$code = $_GET['code'];

	$bind_info = $wechat->wechat_callback($state);
	if($bind_info['openid'] && $bind_info['unionid']) {
		dsetcookie('wechat_user_id', $bind_info['unionid'], 120);
		require_once WECHAT_CONNECT . '/models/wechat_user.class.php';
		$wechat_user = new Wechat_User();
		$wechat_user_info = $wechat_user->get_wechat_user('unionid', $bind_info['unionid']);
		require_once DISCUZ_ROOT . 'source/class/class_js.php';
		//not bind, show registeration dialog
		if(! $wechat_user_info) {
			$params = array(
				'method' => 'wechat',
				'action' => 'register',
				'isSubmit' => 'no'
				);
			header('Location: connect.php?' . http_build_query($params));
		}else {
			global $_G;
			$_G['clientip'] = $_SERVER['REMOTE_ADDR'];

			$try_login = $wechat_user->connect_login($wechat_user_info['uid']);

			$referer = $_SESSION['connect_referer'] ? $_SESSION['connect_referer'] : ($_SERVER['HTTP_HOST'] . '/index.php');

			$log->log_str(strtr('用户 %username[%user_id] 尝试使用wechat登录', array(
				'%username' => 'wechat_id',
				'%user_id' => $bind_info['unionid']
				)));


			//login successfully
			if($try_login) {
				$log->log_str(strtr('用户 %username[%user_id] 尝试使用wechat登录成功', array(
					'%username' => $_G['username'],
					'%user_id' => $_G['uid']
				)));
				if($_G['setting']['allowsynlogin'] && 0 < $_G['uid']) {
	                loaducenter();
	                $ucsynlogin = $_G['setting']['allowsynlogin'] ? uc_user_synlogin($_G['uid']) : '';
	                $param = array('username' => $_G['username'], 'uid' => $_G['uid'], 'usergroup' => '');
	                showmessage('login_succeed', $referer, $param);
	            }
	            else {
	                showmessage('login_succeed', $referer, array('username' => $_G['username'], 'uid' => 0, 'usergroup' => ''));
	            }
			}//login failed
			else {
				JS::alert_redirect('使用微信登录失败, 页面即将跳转!', $referer, 500);
				$log->log_str(strtr('用户 %username[%user_id] 尝试使用wechat登录失败!', array(
					'%username' => 'wechat_id',
					'%user_id' => $bind_info['uid']
				)));
			}
		}
	}
	else {
		//request wechat error, to do
		require_once DISCUZ_ROOT . 'source/class/class_js.php';
		$red_url = $_SERVER['HTTP_HOST'] . '/index.php';
        showmessage('授权失败, 请稍后再试');
	}
}
elseif($op == 'bind') {
	if(! $_G['gp_username'] || ! $_G['gp_password']) {
		showmessage('login_userinfo_empty');
		exit;
	}
	if($_G['gp_questionid'] && ! $_G['gp_answer']) {
		showmessage('login_question_empty');
		exit;
	}
    //加入验证码
    require_once DISCUZ_ROOT . 'source/function/function_verify.php';
    $secqaacheck = loginIsAppearVerify($_G['clientip'], $_G['gp_username']);
    submitcheck('wechat_bind_submit', 1, 0, $secqaacheck);

	require_once DISCUZ_ROOT . 'source/function/function_member.php';

    if (!logincheck($_G['gp_username'])) {
        showmessage('login_strike');
    }

	$result = userlogin($_G['gp_username'], $_G['gp_password'], $_G['gp_questionid'], $_G['gp_answer'], 'username');
	$uid = $result['ucresult']['uid'];
	if( $uid <= 0) {
        loginfailed($_G['gp_username']);
        $num = logincheck($_G['gp_username'], $_G['clientip']);
        showmessage('login_invalid', '', array('loginperm' => $num));
	}

	$log->log_str(strtr('用户尝试使用 wechat_id[%wechat_id] 绑定本地用户 %username[%userid]!', array(
					'%wechat_id' => getcookie('wechat_user_id') ? getcookie('wechat_user_id') : $_SESSION['WECHAT_UserData']['bind_info']['uid'],
					'%username' => $result['ucresult']['username'],
					'%userid' => $result['ucresult']['uid']
				)));

	$status = $result['status'];
	if($status == -1) {
		//to do, no user in table of common_member
	}

	if($result['member']['uid'] && $status == 1) {

		require_once WECHAT_CONNECT . '/models/wechat_user.class.php';
		$wechat_user = new Wechat_User();
		$wechat_user->uid = $result['member']['uid'];
		$wechat_user->wechat_id = getcookie('wechat_user_id');
		$bind = $wechat_user->bind_wechat_user();

		if($bind == Wechat_User::HAS_BINDED) {
			showmessage('该用户已经绑定了微信');
			exit;
		}
		if($bind == Wechat_User::BIND_FAILED) {
			$log->log_str(strtr('用户使用 wechat_id[%wechat_id] 绑定本地用户 %username[%userid] 失败!', array(
					'%wechat_id' => getcookie('wechat_user_id') ? getcookie('wechat_user_id') : $_SESSION['WECHAT_UserData']['bind_info']['uid'],
					'%username' => $result['ucresult']['username'],
					'%userid' => $result['ucresult']['uid']
				)));
			showmessage('connect_register_bind_invalid');
		}
		else {
			$log->log_str(strtr('用户使用 wechat_id[%wechat_id] 绑定本地用户 %username[%userid] 成功!', array(
					'%wechat_id' => getcookie('wechat_user_id') ? getcookie('wechat_user_id') : $_SESSION['WECHAT_UserData']['bind_info']['uid'],
					'%username' => $result['ucresult']['username'],
					'%userid' => $result['ucresult']['uid']
				)));

			global $_G;
			$_G['clientip'] = $_SERVER['REMOTE_ADDR'];

			$try_login = $wechat_user->connect_login($result['member']['uid']);

			$referer = $_SESSION['connect_referer'] ? $_SESSION['connect_referer'] : ($_SERVER['HTTP_HOST'] . '/index.php');
			//login successfully
			if($try_login) {
				$log->log_str(strtr('用户使用 wechat_id[%wechat_id] 绑定本地用户 %username[%userid] 成功, 登录成功!', array(
					'%wechat_id' => getcookie('wechat_user_id') ? getcookie('wechat_user_id') : $_SESSION['WECHAT_UserData']['bind_info']['uid'],
					'%username' => $_G['username'],
					'%userid' => $_G['uid']
				)));

				$_G['gp_handlekey'] = 'register';
				if($_G['setting']['allowsynlogin'] && 0 < $_G['uid']) {
	                loaducenter();
	                $ucsynlogin = $_G['setting']['allowsynlogin'] ? uc_user_synlogin($_G['uid']) : '';

	                 $param = array(
							'bbname' => $_G['setting']['bbname'] ,
							'username' => $_G['username'],
							'usergroup' => $_G['group']['grouptitle'],
							'uid' => $_G['uid']
						);
	                showmessage('register_succeed', $referer, $param, $ucsynlogin);
	            }
	            else {
	                showmessage('register_succeed', $referer, array('username' => $_G['username'], 'uid' => 0, 'usergroup' => ''));
	            }
			}//login failed
			else {
				$log->log_str(strtr('用户使用 wechat_id[%wechat_id] 绑定本地用户 %username[%userid] 成功, 登录失败!', array(
					'%wechat_id' => getcookie('wechat_user_id') ? getcookie('wechat_user_id') : $_SESSION['WECHAT_UserData']['bind_info']['uid'],
					'%username' => $result['ucresult']['username'],
					'%userid' => $result['ucresult']['uid']
				)));

				require_once DISCUZ_ROOT . 'source/class/class_js.php';
				JS::alert_redirect('使用微信登录失败, 页面即将跳转!', $referer, 500);
			}
		}
	}
}

