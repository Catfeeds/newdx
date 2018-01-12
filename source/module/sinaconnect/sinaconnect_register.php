<?php
define('SINA_CONNECT', dirname(__FILE__));
$sina_id = getcookie('sina_user_id');
//$sina_id = 1;
if($sina_id && $_REQUEST['isSubmit'] == 'no') {
	if($_SESSION[$sina_id]) {
		$default_username = $_SESSION[$sina_id];
	}
	else {
		require_once $sina_path = SINA_CONNECT . '/API/class/sina.class.php';
		$sina = new Sina();
		$weibo_user = $sina->user_show();
		$default_username = iconv('utf-8', 'gbk', $weibo_user->screen_name);
		$_SESSION[$sina_id] = $default_username;
	}
	$title = '�����ʺ���Ϣ';
	//$tip = '�����˺�? <a href="javascript: change_manipulation(\'r_bind\', \'r_main\');">���ҵ��˺�</a>';
	//$top_message = '<img alt="weibo" src="static/image/common/weibo.png"> ����ʹ��΢���˺�ע�᱾վ';
	$method= 'sina';
	$action = 'register';
	//$bind_top_message = '����ʹ��΢���˺ű�վ�˺�';
	$bg_num = rand(1, 5);
	
	include template('connect_member/register');
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
    //������֤��
    $secqaacheck = regIsAppearVerify($_G['clientip']);
    submitcheck('wb_reg_submit', 1, 0, $secqaacheck);

	//if user has not finished registered in 2 minutes, or user accesses this page directly, the user is not be allowed to register.
	session_start();
	if(! $sina_id || ! $_SESSION['SINA_UserData']['bind_info']['uid'] || $sina_id != $_SESSION['SINA_UserData']['bind_info']['uid']) {
		require_once DISCUZ_ROOT . 'source/class/class_js.php';
		if($_REQUEST['inajax']) {
			$_G['gp_handlekey'] = 'register';
		}

		JS::alert_redirect('cookie �ѹ���!', "http://{$_SERVER['HTTP_HOST']}/connect.php?method=sina&action=login&op=init");
		exit;
	}
	else {
		require_once dirname(__FILE__) . '/models/sina_user.class.php';
		$sina_user = new Sina_User($sina_id, $username, $password, $email);
		//check whether it is binded or not again.
		$buser = $sina_user->get_sina_user();

		$log->log_str(strtr('�û� sina_id[%sina_id] %username[new_user] ����ʹ��sinaע��!', array(
					'%sina_id' => $sina_id,
					'%username' => $username,
				)));
		if(! $buser) {
			$register = $sina_user->add_sina_user();
			if($register > 0) {
				$log->log_str(strtr('�û� sina_id[%sina_id] %username[%user_id] ʹ��sinaע��ɹ�!', array(
					'%sina_id' => $sina_id,
					'%username' => $username,
					'%user_id' => $register
				)));
				global $_G;
				$_G['inajax'] = 1;

				if(! try_login($sina_user, $referer)) {
					$sina_user->uid = $register;
					$sina_user->deleteSinaUser();

					$log->log_str(strtr('�û� sina_id[%sina_id] %username[%user_id] ʹ��sinaע��ɹ�, ���Ե�½ʧ��!', array(
							'%sina_id' => $sina_id,
							'%username' => $username,
							'%user_id' => $register
					)));
				}
				
			}
			else {
				$log->log_str(strtr('�û� sina_id[%sina_id] %username[%user_id] ʹ��sinaע��ʧ��!', array(
					'%sina_id' => $sina_id,
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
			$sina_user->uid = $buser['uid'];
			try_login($sina_user, $referer);
		}
	}
}
else {
	JS::alert_redirect('��������æ, �������ݶ�ʧ, ���Ժ�����!', $referer, 1000);
	exit;
}


function try_login($sina_user, $referer) {
	global $_G;
	$try_login = $sina_user->connect_login($sina_user->uid);
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
		JS::alert('�ǳ���Ǹ, ������æ, ���Ժ�����, ���ǽ��ᾡ�촦������!');
		return false;
	}
}

//simple, easy validation, complex validation will be executed in ucenter
function check_input($username, $password, $password_again, $email) {
	//if($password != $password_again || ! $username || ! $email) return false;
	if($password != $password_again || ! $username) return false;
	return true;
}

