<?php
/*
* Function: sina connection to login
* Author: linsheng.wu
* Date: 2014.6.11
*/
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('SINA_CONNECT', dirname(__FILE__));

$sina_path = SINA_CONNECT . '/API/class/sina.class.php';

if(! file_exists($sina_path)) {
	$err_msg = $sina_path . ' DOES NOT exist!';
	error_log($err_msg);
	exit($err_msg);
}

require_once $sina_path;
$op = $_G['gp_op'];

$sina = new Sina();

if($op == 'init') {
	$sina->sina_login();
}
elseif($_GET['state'] && $_GET['code']) {
//bbs.8264.com/connect.php?method=sina&state=edce31bdc60f93f8c434c2929c438429&code=9c8131a456d5266ecae417b9c80df4ff
	$state = $_GET['state'];
	$code = $_GET['code'];

	$bind_info = $sina->sina_callback($state);
	if($bind_info['uid']) {
		dsetcookie('sina_user_id', $bind_info['uid'], 120);
		require_once SINA_CONNECT . '/models/sina_user.class.php';
		$sina_user = new Sina_User();
		$sina_user_info = $sina_user->get_sina_user('sina_uid', $bind_info['uid']);
		require_once DISCUZ_ROOT . 'source/class/class_js.php';
		//not bind, show registeration dialog
		if(! $sina_user_info) {
			$params = array(
				'method' => 'sina',
				'action' => 'register',
				'isSubmit' => 'no'
				);
		
			header('Location: connect.php?' . http_build_query($params));
		}
		else {
			global $_G;
			$_G['clientip'] = $_SERVER['REMOTE_ADDR'];

			$try_login = $sina_user->connect_login($sina_user_info['uid']);

			$referer = $_SESSION['connect_referer'] ? $_SESSION['connect_referer'] : ($_SERVER['HTTP_HOST'] . '/index.php');

			$log->log_str(strtr('用户 %username[%user_id] 尝试使用sina登录', array(
				'%username' => 'sina_id',
				'%user_id' => $bind_info['uid']
				)));


			//login successfully
			if($try_login) {
				$log->log_str(strtr('用户 %username[%user_id] 尝试使用sina登录成功', array(
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
				JS::alert_redirect('使用新浪微博登录失败, 页面即将跳转!', $referer, 500);
				$log->log_str(strtr('用户 %username[%user_id] 尝试使用sina登录失败!', array(
					'%username' => 'sina_id',
					'%user_id' => $bind_info['uid']
				)));
			}
		}
	}
	else {
		//request sina error, to do
		require_once DISCUZ_ROOT . 'source/class/class_js.php';
		$red_url = $_SERVER['HTTP_HOST'] . '/index.php';
		JS::alert_redirect('新浪微博授权失败, 页面即将跳转!', $red_url);
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
    submitcheck('wb_bind_submit', 1, 0, $secqaacheck);

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
	
	$log->log_str(strtr('用户尝试使用 sina_id[%sina_id] 绑定本地用户 %username[%userid]!', array(
					'%sina_id' => getcookie('sina_user_id') ? getcookie('sina_user_id') : $_SESSION['SINA_UserData']['bind_info']['uid'],
					'%username' => $result['ucresult']['username'],
					'%userid' => $result['ucresult']['uid']
				)));

	$status = $result['status'];
	if($status == -1) {
		//to do, no user in table of common_member
	}

	if($result['member']['uid'] && $status == 1) {
		require_once SINA_CONNECT . '/models/sina_user.class.php';
		$sina_user = new Sina_User();
		$sina_user->uid = $result['member']['uid'];
		$sina_user->sina_id = getcookie('sina_user_id');
		$bind = $sina_user->bind_sina_user();
		if($bind == Sina_User::HAS_BINDED) {
			showmessage('user_had_binded_sina');
			exit;
		}
		if($bind == Sina_User::BIND_FAILED) {
			$log->log_str(strtr('用户使用 sina_id[%sina_id] 绑定本地用户 %username[%userid] 失败!', array(
					'%sina_id' => getcookie('sina_user_id') ? getcookie('sina_user_id') : $_SESSION['SINA_UserData']['bind_info']['uid'],
					'%username' => $result['ucresult']['username'],
					'%userid' => $result['ucresult']['uid']
				)));
			showmessage('connect_register_bind_invalid');
		}
		else {
			$log->log_str(strtr('用户使用 sina_id[%sina_id] 绑定本地用户 %username[%userid] 成功!', array(
					'%sina_id' => getcookie('sina_user_id') ? getcookie('sina_user_id') : $_SESSION['SINA_UserData']['bind_info']['uid'],
					'%username' => $result['ucresult']['username'],
					'%userid' => $result['ucresult']['uid']
				)));

			global $_G;
			$_G['clientip'] = $_SERVER['REMOTE_ADDR'];

			$try_login = $sina_user->connect_login($result['member']['uid']);

			$referer = $_SESSION['connect_referer'] ? $_SESSION['connect_referer'] : ($_SERVER['HTTP_HOST'] . '/index.php');
			//login successfully
			if($try_login) {
				$log->log_str(strtr('用户使用 sina_id[%sina_id] 绑定本地用户 %username[%userid] 成功, 登录成功!', array(
					'%sina_id' => getcookie('sina_user_id') ? getcookie('sina_user_id') : $_SESSION['SINA_UserData']['bind_info']['uid'],
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
				$log->log_str(strtr('用户使用 sina_id[%sina_id] 绑定本地用户 %username[%userid] 成功, 登录失败!', array(
					'%sina_id' => getcookie('sina_user_id') ? getcookie('sina_user_id') : $_SESSION['SINA_UserData']['bind_info']['uid'],
					'%username' => $result['ucresult']['username'],
					'%userid' => $result['ucresult']['uid']
				)));

				require_once DISCUZ_ROOT . 'source/class/class_js.php';
				JS::alert_redirect('使用新浪微博登录失败, 页面即将跳转!', $referer, 500);
			}
		}
	}
}

