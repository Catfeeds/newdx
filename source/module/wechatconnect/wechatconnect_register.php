<?php
define('WECHAT_CONNECT', dirname(__FILE__));
$wechat_user_id = getcookie('wechat_user_id');
//$wechat_user_id = 1;
if($wechat_user_id && $_REQUEST['isSubmit'] == 'no') {
    if($_SESSION['default_username']) {
        $default_username = $_SESSION['default_username'];
    }else {
        require_once $wechat_path = WECHAT_CONNECT . '/API/class/wechat.class.php';
        $wechat = new Wechat();
        $wechat_user = $wechat->user_show();
        $default_username = iconv('utf-8', 'gbk', $wechat_user->nickname);
        $_SESSION['default_username'] = $default_username;
    }
    $title = '完善帐号信息';
    $method= 'wechat';
    $action = 'register';
    $bg_num = rand(1, 5);

    include template('connect_member/register_wechat');
    exit;
}

require_once DISCUZ_ROOT . 'source/class/class_js.php';
require_once DISCUZ_ROOT . 'source/function/function_verify.php';
global $_G;
$referer = $_SESSION['connect_referer'] ? $_SESSION['connect_referer'] : ($_SERVER['HTTP_HOST'] . '/index.php');
if($_REQUEST['isSubmit'] == 'yes') {
	$username = $_REQUEST['siteRegName'];
//	$password = $_REQUEST['regPwd'];
//	$password_again = $_REQUEST['regPwdAgain'];
//	$email = $_REQUEST['siteRegEmail'];
    $password = $password_again = md5(random(10));
    $email = '';

	if(! check_input($username, $password, $password_again, $email) ) {
		showmessage('undefined_action');
		exit;
	}
    //加入验证码
    $secqaacheck = regIsAppearVerify($_G['clientip']);
    submitcheck('wechat_reg_submit', 1, 0, $secqaacheck);

	//if user has not finished registered in 2 minutes, or user accesses this page directly, the user is not be allowed to register.
	session_start();
	if(! $wechat_user_id || ! $_SESSION['WECHAT_UserData']['bind_info']['unionid'] || $wechat_user_id != $_SESSION['WECHAT_UserData']['bind_info']['unionid']) {
		require_once DISCUZ_ROOT . 'source/class/class_js.php';
		if($_REQUEST['inajax']) {
			$_G['gp_handlekey'] = 'register';
		}

		JS::alert_redirect('cookie 已过期!', "http://{$_SERVER['HTTP_HOST']}/connect.php?method=wechat&action=login&op=init");
		exit;
	}
	else {
		require_once dirname(__FILE__) . '/models/wechat_user.class.php';
		$wechat_user = new Wechat_User($wechat_user_id, $username, $password, $email);
		//check whether it is binded or not again.
		$buser = $wechat_user->get_wechat_user();
		$log->log_str(strtr('用户 wechat_user_id[%wechat_user_id] %username[new_user] 尝试使用wechat注册!', array(
					'%wechat_user_id' => $wechat_user_id,
					'%username' => $username,
				)));
		if(! $buser) {
			$register = $wechat_user->add_wechat_user();
			if($register > 0) {
				$log->log_str(strtr('用户 wechat_user_id[%wechat_user_id] %username[%user_id] 使用wechat注册成功!', array(
					'%wechat_user_id' => $wechat_user_id,
					'%username' => $username,
					'%user_id' => $register
				)));
				global $_G;
				$_G['inajax'] = 1;

				if(! try_login($wechat_user, $referer)) {
					$wechat_user->uid = $register;
					$wechat_user->deletewechatUser();

					$log->log_str(strtr('用户 wechat_user_id[%wechat_user_id] %username[%user_id] 使用wechat注册成功, 尝试登陆失败!', array(
							'%wechat_user_id' => $wechat_user_id,
							'%username' => $username,
							'%user_id' => $register
					)));
				}
				
			}
			else {
				$log->log_str(strtr('用户 wechat_user_id[%wechat_user_id] %username[%user_id] 使用wechat注册失败!', array(
					'%wechat_user_id' => $wechat_user_id,
					'%username' => $username,
					'%user_id' => $register
				)));

				if ($register == -1) {
					showmessage('profile_username_illegal');
				} elseif ($register == -2) {
					showmessage('profile_username_protect');
				} elseif ($register == -3) {
					showmessage('profile_username_duplicate');
				} elseif ($register == -4) {
					showmessage('profile_email_illegal');
				} elseif ($register == -5) {
					showmessage('profile_email_domain_illegal');
				} elseif ($register == -6) {
					showmessage('profile_email_duplicate');
				} else {
					$_G['gp_handlekey'] = 'register';
					showmessage('undefined_action', $referer);
				}
			}
			exit;
		}
		else {
			$wechat_user->uid = $buser['uid'];
			try_login($wechat_user, $referer);
		}
	}
}
else {
	JS::alert_redirect('服务器繁忙, 请求数据丢失, 请稍候再试!', $referer, 1000);
	exit;
}


function try_login($wechat_user, $referer) {
	global $_G;
	$try_login = $wechat_user->connect_login($wechat_user->uid);
	//login successfully
	if($try_login) {
		if($_G['setting']['allowsynlogin'] && 0 < $_G['uid']) {
            loaducenter();
            $ucsynlogin = $_G['setting']['allowsynlogin'] ? uc_user_synlogin($_G['uid']) : '';
            $param = array(
				'bbname' => $_G['setting']['bbname'] ,
				'username' => $_G['username'],
				'usergroup' => $_G['group']['grouptitle'],
				'uid' => $_G['uid'],
			);

            $_G['gp_handlekey'] = 'register';
            showmessage('register_succeed', $referer, $param, $ucsynlogin);
        }
        else {
            showmessage('register_succeed', $referer, array('username' => $_G['username'], 'uid' => 0, 'usergroup' => ''));
        }
        return true;
	}//login failed
	else {
		JS::alert('非常抱歉, 服务器忙, 请稍后再试, 我们将会尽快处理问题!');
		return false;
	}
}

//simple, easy validation, complex validation will be executed in ucenter
function check_input($username, $password, $password_again, $email) {
    if($password != $password_again || ! $username) return false;
	return true;
}

