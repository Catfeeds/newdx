<?php

/**
 * authorize 验证授权
 */


if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class authorize
{
	public $redirect_url;
	public $state;
	protected $api_url;
	protected $app_api_url;
	protected $app_api_token;

	function __construct()
	{
		global $_G, $logs, $api_url;

		$this->timestamp = time();
		$this->api_url = $api_url;

		$this->redirect_url = $_GET['redirect_url'];	//如有必要可以对传送过来的重定向域名进行验证合法性
		$this->state = $_GET['state'];

		$this->app_api_url = $_G['config']['zaiwaiapi']['url'];
		$this->app_api_token = $_G['config']['zaiwaiapi']['token'];

		require DISCUZ_ROOT.'openid/openid_model.php';
		$this->openid = new openid;

		$this->logs = $logs;
	}

	//根据客户端code获取用户绑定信息，返回值包括uid,username,userkey
	public function token()
	{
		if(empty($_GET['md5str'])) {
			output_errorMsg(444, 'Invalid permissions.', '');
		}

		$result = $this->openid->token($_GET['md5str']);

		if($result) {
			$data['msg']  = array("code" => 200, "info" => "Return data success.");
			$data['data'] = $result;
			output_msg($data, true);
		} else {
			output_errorMsg(431, 'Get token failed.', '');
		}
	}

	// 绑定帐号
	public function token_bind()
	{
		$appuid = number_format($_GET['userid'], 0, ".", '');
		$appusername = $_GET['nickname'];
		// $appusername = diconv($_GET['nickname'],'UTF-8','GBK');

		$form_params = array('appname'=>'zaiwaiapp', 'qt'=> time(), 'c'=>'authorize', 'm'=>'login', 'redirect_url'=>$this->redirect_url, 'state'=>$this->state, 'appuid'=>$appuid, 'appusername'=>$appusername);
		$form_url = $this->api_url.$this->openid->build_url($form_params);

		include template('openid/login');exit;
	}

	// 解绑帐号
	public function token_unbind()
	{
		$appuid  = number_format($_GET['userid'], 0, ".", '');
		$userkey = urldecode($_GET['userkey']);

		if($appuid && $userkey) {
			file_put_contents(DISCUZ_ROOT.'data/dlogs/unbinduser.log', $userkey.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
			// $userinfo = authcode($userkey, 'DECODE');
			// list($uid, $username, $expriestime) = explode("\t", $userinfo);
			list($uid, $username) = explode("|", $userkey);
			//通知APP端解绑
			$unbind_user_result = requestRemoteData($this->app_api_url.'userService/unbindUser?type=5&userId='.$appuid.'&sToken='.$this->app_api_token);
			file_put_contents(DISCUZ_ROOT.'data/dlogs/unbinduser.log', $appuid.'|'.$unbind_user_result.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);

			file_put_contents(DISCUZ_ROOT.'data/dlogs/unbinduser.log', $userkey.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
			$unbind_user_result = json_decode($unbind_user_result, true);

			$result = '';
			if($unbind_user_result['result'] == 1) {	//接口解绑成功再解绑本地
				$result = $this->openid->token_unbind($uid, $appuid);
			} else {
				//若是8264论坛解绑失败，则把app重新绑定
				requestRemoteData($this->app_api_url.'userService/bindUser?type=5&osType=0&ext='.urlencode($userkey).'&userId='.$appuid.'&sToken='.$this->app_api_token);
				file_put_contents(DISCUZ_ROOT.'data/dlogs/binduser.log', $appuid.'|'.$bind_user_result.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
				output_errorMsg(432, 'Unbind failed on app.', 'app端解绑失败');
			}

			if($result) {
				output_msg('{"msg":{"code":200, "info":"Unbind success."}}');
			} else {
				output_errorMsg(432, 'Unbind failed on pc.', '8264论坛解绑失败');
			}
		} else {
			output_errorMsg(433, 'Unbind failed. appuid or userkey miss.', '解除绑定失败，请联系在外客服');
		}
		// output_errorMsg(450, 'Temporary non binding.', '暂时不能解绑8264账号');
	}

	// 延长授权过期时间 暂时不用
	public function token_refresh()
	{
		if($this->openid->token_refresh($_GET['userkey'])) {
			output_msg('{"msg":{"code":200, "info":"Refresh token success."}}');
		} else {
			output_errorMsg(430, 'Refresh token failed.', '');
		}
	}

	// 获取第三方应用获取API TOKEN
	public function access_token()
	{
		$appname = $_GET['appname'];
		$result  = $this->openid->access_token($appname);
		$data['msg']  = array("code" => 200, "info" => "Get access token success.");
		$data['data'] = $result;
		output_msg($data, true);
	}

	// 获取 在外app 微信公众号API TOKEN
	public function wechat_token()
	{
		$data['msg'] = array("code" => 200, "info" => "Get wechat token success.");
		$data['data'] = $this->openid->wechat_token();
		output_msg($data, true);
	}

	// 获取8264户外资料网 微信公众号API TOKEN
	public function wechat_token_8264()
	{
		$data['msg'] = array("code" => 200, "info" => "Get wechat token success.");
		$data['data'] = $this->openid->wechat_token_8264();
		output_msg($data, true);
	}

	// 获取8264活动平台 微信公众号API TOKEN
	public function wechat_token_8264_hd()
	{
		$data['msg'] = array("code" => 200, "info" => "Get wechat token success.");
		$data['data'] = $this->openid->wechat_token_8264_hd();
		output_msg($data, true);
	}

    // 获取8264服务号 微信公众号API TOKEN
    public function wechat_token_8264_fwh()
    {
        $data['msg'] = array("code" => 200, "info" => "Get wechat token success.");
        $data['data'] = $this->openid->wechat_token_8264_fwh();
        output_msg($data, true);
    }


	// 执行登陆操作
	public function login()
	{
		$username = diconv($_POST['username'],'UTF-8','GBK');
		$password = $_POST['password'];

		$appuid = number_format($_GET['appuid'], 0, ".", '');
		$appusername = diconv($_GET['appusername'],'UTF-8','GBK');

		if(empty($username) || empty($password)) {
			output_errorMsg(420, 'Invalid username or password.', '用户名或密码为空');
		}

		require DISCUZ_ROOT.'source/function/function_member.php';

		$result = userlogin($username, $password, '', '', 'username');
		$uid = $result['ucresult']['uid'];

		if ($result['status'] > 0) {
			$status  = $this->openid->isauth($uid);
			$status2 = $this->openid->isauthByAppuid($appuid);
			if($status || $status2) {
				if ($status && $status2 && $status == $status2) {
					//若是uid和appuid绑定的是同一个，则视为绑定成功
					$code = md5($uid.$appuid);
					$code = diconv($code, 'gbk', 'utf-8');
					header('Location:'.urldecode($this->redirect_url)."?state=".$this->state."&code=".$code);
				} else {
					//已经绑定过了
					output_errorMsg(422, 'The user is binded.', '8264账户已被绑定');
				}
			} else {
				$auth_result = $this->openid->allow($uid, $username, $appuid, $appusername, 1);
				if($auth_result) {
					header('Location:'.urldecode($this->redirect_url)."?state=".$this->state."&code=".$auth_result);
				} else {
					output_errorMsg(423, 'Authorization failed.', '绑定失败，请重新尝试');
				}
			}

		} else {
			output_errorMsg(421, 'Username or password error.', '用户名或密码错误');
		}

	}

	// APP原生界面绑定操作
	public function user_bind()
	{
		$username = diconv($_POST['username'],'UTF-8','GBK');
		$password = $_POST['password'];

		$appuid = number_format($_GET['appuid'], 0, ".", '');
		$appusername = diconv($_GET['appusername'],'UTF-8','GBK');

		if(empty($username) || empty($password)) {
			output_errorMsg(420, 'Invalid username or password.', '用户名或密码为空');
		}

		require DISCUZ_ROOT.'source/function/function_member.php';

		$result = userlogin($username, $password, '', '', 'username');
		$uid = $result['ucresult']['uid'];

		if ($result['status'] > 0) {
			$status  = $this->openid->isauth($uid);
			$status2 = $this->openid->isauthByAppuid($appuid);
			if($status || $status2) {
				if ($status && $status2 && $status == $status2) {
					//若是uid和appuid绑定的是同一个，则视为绑定成功
					$data['msg']  = array("code" => 200, "info" => "User bind success.");
					$userkey 	  = $uid."|".$username;
					$auth_result  = array("uid"=>$uid, "username"=>$username, "userkey"=>$userkey);
					$data['data'] = $auth_result;

					output_msg($data, true);
				} else {
					//已经绑定过了
					output_errorMsg(422, 'The user is binded.', '8264账户已被绑定');
				}
			} else {	//进行绑定，成功直接返回用户绑定数据
				//通知APP端进行相应帐号绑定
				$ext  = $uid.'|'.$_POST['username'];
				$ext  = diconv($ext, 'gbk', 'utf-8');
				$bind_user_result = requestRemoteData($this->app_api_url.'userService/bindUser?type=5&osType=0&ext='.urlencode($ext).'&userId='.$appuid.'&sToken='.$this->app_api_token);
				file_put_contents(DISCUZ_ROOT.'data/dlogs/binduser.log', $appuid.'|'.$bind_user_result.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);

				$auth_result = '';
				$bind_user_result = json_decode($bind_user_result, true);
				if($bind_user_result['result'] == 1) {	//接口绑定成功之后再进行本地绑定
					$auth_result = $this->openid->allow($uid, $username, $appuid, $appusername);
				}
				if($auth_result) {
					$data['msg']  = array("code" => 200, "info" => "User bind success.");
					$data['data'] = $auth_result;

					output_msg($data, true);
				} elseif($bind_user_result['result'] == 1) {
					//app绑定成功，论坛绑定失败，则APP解除绑定
					requestRemoteData($this->app_api_url.'userService/unbindUser?type=5&userId='.$appuid.'&sToken='.$this->app_api_token);
					output_errorMsg(423, 'User bind failed on pc.', '网络连接失败，请重新尝试');
				} else {
					output_errorMsg(423, 'User bind failed.', '网络连接失败，请重新登录再次尝试');
				}
			}

		} else {
			output_errorMsg(421, 'Username or password error.', '用户名或密码错误');
		}
	}

	//注册8264用户，并绑定
	public function regist()
	{
		global $_G;

		//引入ucenter相关文件
		loaducenter();

		$_POST       		= iconv_array($_POST, "UTF-8", "gbk//TRANSLIT");
		$appuid     		= number_format($_GET['appuid'], 0, ".", '');
		$appusername 		= diconv($_GET['appusername'],'UTF-8','gbk//TRANSLIT');
		$username 			= isset($_POST['username']) ? $_POST['username'] : '';
		$email 				= trim($_POST['email']);
		$_G['gp_password']	= trim($_POST['password']);

		// 验证用户是否已有授权记录
		if ($this->openid->isauthByAppuid($appuid)) {
			output_errorMsg(431, 'this appuid is authed.', '');
		}

		//start
		$bbrules 		= &$_G["setting"]['bbrules'];
		$bbrulesforce 	= &$_G["setting"]['bbrulesforce'];
		$bbrulestxt 	= &$_G["setting"]['bbrulestxt'];
		$welcomemsg 	= &$_G["setting"]['welcomemsg'];
		$welcomemsgtitle= &$_G["setting"]['welcomemsgtitle'];
		$welcomemsgtxt 	= &$_G["setting"]['welcomemsgtxt'];
		if ($_G["setting"]['regverify']) {
			if ($_G["setting"]['areaverifywhite']) {
				$location = $whitearea = '';
				$location = trim(convertip($_G['clientip'], "./"));
				if ($location) {
					$whitearea = preg_quote(trim($_G["setting"]['areaverifywhite']), '/');
					$whitearea = str_replace(array("\\*"), array('.*'), $whitearea);
					$whitearea = '.*' . $whitearea . '.*';
					$whitearea = '/^(' . str_replace(array("\r\n", ' '), array('.*|.*', ''), $whitearea) . ')$/i';
					if (@preg_match($whitearea, $location)) {
						$_G["setting"]['regverify'] = 0;
					}
				}
			}
			if ($_G['cache']['ipctrl']['ipverifywhite']) {
				foreach (explode("\n", $_G['cache']['ipctrl']['ipverifywhite']) as $ctrlip) {
					if (preg_match("/^(" . preg_quote(($ctrlip = trim($ctrlip)), '/') . ")/", $_G['clientip'])) {
						$_G["setting"]['regverify'] = 0;
						break;
					}
				}
			}
		}
		if ($_G["setting"]['regstatus'] == 2) {
			if ($_G["setting"]['inviteconfig']['inviteareawhite']) {
				$location = $whitearea = '';
				$location = trim(convertip($_G['clientip'], "./"));
				if ($location) {
					$whitearea = preg_quote(trim($_G["setting"]['inviteconfig']['inviteareawhite']), '/');
					$whitearea = str_replace(array("\\*"), array('.*'), $whitearea);
					$whitearea = '.*' . $whitearea . '.*';
					$whitearea = '/^(' . str_replace(array("\r\n", ' '), array('.*|.*', ''), $whitearea) . ')$/i';
				}
			}
		}
		$groupinfo = array();
		$groupinfo['groupid'] = $_G["setting"]['regverify'] ? 8 : $_G["setting"]['newusergroupid'];

		$bbrulehash = $bbrules ? substr(md5(FORMHASH), 0, 8) : '';

		//进入注册环节
		if ($bbrules && $bbrulehash != $_POST['agreebbrule']) {
			output_errorMsg(432, 'register_rules_agree.', '请同意用户注册协议');
		}

		$usernamelen = dstrlen($username);
		file_put_contents(DISCUZ_ROOT.'data/dlogs/unbinduser.log', 'regist|'.$usernamelen.'|'.$username.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
		if($usernamelen < 3 || $usernamelen > 15) {
			output_errorMsg(433, 'please input 3 to 15 words.', '请输入3-7位用户名');
		}

		$username = addslashes(trim(dstripslashes($username)));
		if (uc_get_user($username) && ! DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE username='$username'")) {
			output_errorMsg(434, 'profile_username_duplicate.', '用户名已注册');
		}

		if (empty($_G["setting"]['ignorepassword'])) {
			if (! $_G['gp_password'] || $_G['gp_password'] != addslashes($_G['gp_password'])) {
				output_errorMsg(435, 'profile_passwd_illegal.', '密码空或包含非法字符');
			}
			$password = $_G['gp_password'];
		} else {
			$password = md5(random(10));
		}

		$censorexp = '/^(' . str_replace(array(
			'\\*',
			"\r\n",
			' '), array(
			'.*',
			'|',
			''), preg_quote(($_G["setting"]['censoruser'] = trim($_G["setting"]['censoruser'])), '/')) . ')$/i';
		if ($_G["setting"]['censoruser'] && @preg_match($censorexp, $username)) {
			output_errorMsg(436, 'profile_username_protect.', '用户名包含被系统屏蔽的字符');
		}
		if ($_G["setting"]['regverify'] == 2 && ! trim($_G['gp_regmessage'])) {
			output_errorMsg(437, 'profile_required_info_invalid.', '请将账户信息填写完整');
		}
		if ($_G['cache']['ipctrl']['ipregctrl']) {
			foreach (explode("\n", $_G['cache']['ipctrl']['ipregctrl']) as $ctrlip) {
				if (preg_match("/^(" . preg_quote(($ctrlip = trim($ctrlip)), '/') . ")/", $_G['clientip'])) {
					$ctrlip = $ctrlip . '%';
					$_G["setting"]['regctrl'] = $_G["setting"]['ipregctrltime'];
					break;
				} else {
					$ctrlip = $_G['clientip'];
				}
			}
		} else {
			$ctrlip = $_G['clientip'];
		}
		if ($_G["setting"]['regctrl']) {
			$query = DB::query("SELECT ip FROM " . DB::table('common_regip') . " WHERE ip LIKE '$ctrlip' AND count='-1' AND dateline>$_G[timestamp]-'" . $_G["setting"]['regctrl'] . "'*3600 LIMIT 1");
			if (DB::num_rows($query)) {
				output_errorMsg(438, 'register_ctrl.', '60分钟内已成功注册过，请稍后再试');
			}
		}
		$regipsql = '';
		if ($_G["setting"]['regfloodctrl']) {
			if ($regattempts = DB::result_first("SELECT count FROM " . DB::table('common_regip') . " WHERE ip='$_G[clientip]' AND count>'0' AND dateline>'$_G[timestamp]'-86400")) {
				if ($regattempts >= $_G["setting"]['regfloodctrl']) {
					output_errorMsg(439, 'register_flood_ctrl.', '24小时内已注册过5次，请稍后再试');
				} else {
					$regipsql = "UPDATE " . DB::table('common_regip') . " SET count=count+1 WHERE ip='$_G[clientip]' AND count>'0'";
				}
			} else {
				$regipsql = "INSERT INTO " . DB::table('common_regip') . " (ip, count, dateline) VALUES ('$_G[clientip]', '1', '$_G[timestamp]')";
			}
		}
		$profile = $verifyarr = array();
		if (! $activation) {
			$uid = uc_user_register($username, $password, $email, $questionid, $answer, $_G['clientip']);
			if ($uid <= 0) {
				if ($uid == -1) {
					output_errorMsg(440, 'profile_username_illegal.', '用户名包含敏感字符');
				} elseif ($uid == -2) {
					output_errorMsg(441, 'profile_username_protect.', '用户名包含被系统屏蔽的字符');
				} elseif ($uid == -3) {
					output_errorMsg(442, 'profile_username_duplicate.', '用户名已注册');
				} elseif ($uid == -4) {
					output_errorMsg(443, 'profile_email_illegal.', '邮箱格式不正确');
				} elseif ($uid == -5) {
					output_errorMsg(444, 'profile_email_domain_illegal.', 'Email包含不可使用的邮箱域名');
				} elseif ($uid == -6) {
					output_errorMsg(445, 'profile_email_duplicate.', '该Email地址已经被注册');
				} else {
					output_errorMsg(446, 'undefined_action.', '');
				}
			}
		} else {
			list($uid, $username, $email) = $activation;
		}
		$_G['username'] = $username;
		if (DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE uid='$uid'")) {
			if (! $activation) {
				uc_user_delete($uid);
			}
			output_errorMsg(431, 'profile_uid_duplicate.', '用户id被占用');
		}
		$password = md5(random(10));
		$secques = $questionid > 0 ? random(8) : '';
		if ($regipsql) {
			DB::query($regipsql);
		}

		$init_arr = explode(',', $_G["setting"]['initcredits']);
		$userdata = array(
			'uid' 		 => $uid,
			'username' 	 => $username,
			'password' 	 => $password,
			'email' 	 => $email,
			'adminid' 	 => 0,
			'groupid' 	 => $groupinfo['groupid'],
			'regdate' 	 => TIMESTAMP,
			'credits' 	 => $init_arr[0],
			'timeoffset' => 9999
		);
		$status_data = array(
			'uid' 			=> $uid,
			'regip' 		=> $_G['clientip'],
			'lastip' 		=> $_G['clientip'],
			'lastvisit' 	=> TIMESTAMP,
			'lastactivity' 	=> TIMESTAMP,
			'lastpost' 		=> 0,
			'lastsendmail' 	=> 0,
		);
		$profile['uid'] 	= $uid;
		$field_forum['uid'] = $uid;
		$field_home['uid'] 	= $uid;
		DB::insert('common_member', $userdata);
		DB::insert('common_member_status', $status_data);
		DB::insert('common_member_profile', $profile);
		DB::insert('common_member_field_forum', $field_forum);
		DB::insert('common_member_field_home', $field_home);

		//start记录用户注册状态
		addrecorduserinfo($uid, 1);

		//绑定，授权
		$auth_result = $this->openid->allow($uid, $username, $appuid, $appusername);

		$querys = DB::query("SELECT uid,username FROM " . DB::table('home_specialuser') . " WHERE 1=1 ");
		while ($values = DB::fetch($querys)) {
			if ($values) {
				$dateline = TIMESTAMP;
				DB::query("insert into " . DB::table('home_friend') . " (uid, fuid, fusername, gid, num, dateline, note) values ('$uid','$values[uid]','$values[username]','0','0','$dateline','')");
				DB::query("insert into " . DB::table('home_friend') . " (uid, fuid, fusername, gid, num, dateline, note) values ('$values[uid]','$uid','$username','0','0','$dateline','')");
			}
		}
		if ($verifyarr) {
			$setverify = array(
				'uid' => $uid,
				'username' => $username,
				'verifytype' => '0',
				'field' => daddslashes(serialize($verifyarr)),
				'dateline' => TIMESTAMP,
				);
			DB::insert('common_member_verify_info', $setverify);
			DB::insert('common_member_verify', array('uid' => $uid));
		}
		$count_data = array(
			'uid' => $uid,
			'extcredits1' => $init_arr[1],
			'extcredits2' => $init_arr[2],
			'extcredits3' => $init_arr[3],
			'extcredits4' => $init_arr[4],
			'extcredits5' => $init_arr[5],
			'extcredits6' => $init_arr[6],
			'extcredits7' => $init_arr[7],
			'extcredits8' => $init_arr[8]);
		DB::insert('common_member_count', $count_data);
		manyoulog('user', $uid, 'add');

		$showtotalmembers = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='showtotalmembers' " . getSlaveID());
		$userstats = array('totalmembers' => $showtotalmembers, 'newsetuser' => $username);
		save_syscache('userstats', $userstats);
		if ($_G["setting"]['regctrl'] || $_G["setting"]['regfloodctrl']) {
			DB::query("DELETE FROM " . DB::table('common_regip') . " WHERE dateline<='$_G[timestamp]'-" . ($_G["setting"]['regctrl'] > 72 ? $_G["setting"]['regctrl'] : 72) . "*3600", 'UNBUFFERED');
			if ($_G["setting"]['regctrl']) {
				DB::query("INSERT INTO " . DB::table('common_regip') . " (ip, count, dateline) VALUES ('$_G[clientip]', '-1', '$_G[timestamp]')");
			}
		}
		$regmessage = dhtmlspecialchars($_G['gp_regmessage']);
		if ($_G["setting"]['regverify'] == 2) {
			DB::query("REPLACE INTO " . DB::table('common_member_validate') . " (uid, submitdate, moddate, admin, submittimes, status, message, remark)	VALUES ('$uid', '$_G[timestamp]', '0', '', '1', '0', '$regmessage', '')");
			manage_addnotify('verifyuser');
		}

		//记录用户状态,这里面记录了$_G["cookie"]["auth"]
		include_once libfile('function/member');
		setloginstatus(array(
			'uid' => $uid,
			'username' => dstripslashes($_G['username']),
			'password' => $password,
			'groupid' => $groupinfo['groupid'],
		), 0);

		include_once libfile('function/stat');
		updatestat('register');

		$query = DB::query("SELECT * FROM " . DB::table('common_setting') . " WHERE skey IN ('bbrules', 'bbrulesforce', 'bbrulestxt', 'welcomemsg', 'welcomemsgtitle', 'welcomemsgtxt', 'inviteconfig')");
		while ($setting = DB::fetch($query)) {
			$$setting['skey'] = $setting['svalue'];
		}
		if ($welcomemsg && ! empty($welcomemsgtxt)) {
			$welcomemsgtitle = addslashes(replacesitevar($welcomemsgtitle));
			$welcomemsgtxt   = addslashes(replacesitevar($welcomemsgtxt));
			if ($welcomemsg == 1) {
				$welcomemsgtxt = nl2br(str_replace(':', '&#58;', $welcomemsgtxt));
				notification_add($uid, 'system', $welcomemsgtxt, array(), 1);
			} elseif ($welcomemsg == 2) {
				sendmail_cron($email, $welcomemsgtitle, $welcomemsgtxt);
			} elseif ($welcomemsg == 3) {
				sendmail_cron($email, $welcomemsgtitle, $welcomemsgtxt);
				$welcomemsgtxt = nl2br(str_replace(':', '&#58;', $welcomemsgtxt));
				notification_add($uid, 'system', $welcomemsgtxt, array(), 1);
			}
		}
		dsetcookie('loginuser', '');
		dsetcookie('activationauth', '');
		dsetcookie('invite_auth', '');
		//end

		if($auth_result) {
			$data['msg']  = array("code" => 200, "info" => "User bind success.");
			$data['data'] = $auth_result;

			//通知APP端进行相应帐号绑定
			$auth_result = iconv_array($auth_result);
			$bind_user_result = requestRemoteData($this->app_api_url.'userService/bindUser?type=5&osType=0&ext='.urlencode($auth_result['userkey']).'&userId='.$appuid.'&sToken='.$this->app_api_token);
			file_put_contents(DISCUZ_ROOT.'data/dlogs/binduser.log', $appuid.'|'.$bind_user_result.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
			$bind_user_result = json_decode($bind_user_result, true);
			if($bind_user_result['result'] != 1) {	//如果接口请求失败，再重新绑定一次
				$bind_user_result2 = requestRemoteData($this->app_api_url.'userService/bindUser?type=5&osType=0&ext='.urlencode($auth_result['userkey']).'&userId='.$appuid.'&sToken='.$this->app_api_token);
				file_put_contents(DISCUZ_ROOT.'data/dlogs/binduser.log', 'retry:'.$appuid.'|'.$bind_user_result2.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
			}

			output_msg($data, true);
		} else {
			output_errorMsg(423, 'User bind failed.', '网络连接失败，请重新尝试');
		}
	}

	//微信绑定8264账号，并登录
	public function login_wechat()
	{
		$username       = diconv($_POST['username'],'UTF-8','GBK');
		$password 		= $_POST['password'];
		$wechatunionid  = $_POST['wechatunionid'];
		$wechatuserid   = $_POST['wechatuserid'];
		$wechatusername = diconv($_POST['wechatusername'],'UTF-8','GBK');

		if(empty($username) || empty($password) || empty($wechatunionid) || empty($wechatuserid) || empty($wechatusername)) {
			output_errorMsg(420, 'Param miss.', '请求失败，请联系8264客服');
		}

		require DISCUZ_ROOT.'source/function/function_member.php';

		$result = userlogin($username, $password, '', '', 'username');
		$uid    = $result['ucresult']['uid'];

		DB::update('common_openid_wechat', array('wechatusername' => $wechatusername), "wechatunionid='{$wechatunionid}'");
		DB::update('forum_activityapply', array('wechatusername' => $wechatusername), "wechatuserid='{$wechatuserid}'");

		if ($result['status'] > 0) {
			$status  = $this->openid->isWechatAuthByUid($uid);
			$status2 = $this->openid->isWechatAuthByUnionid($wechatunionid);
			if($status || $status2) {
				if ($status == $status2) {
					//若是uid和appuid绑定的是同一个，则视为绑定成功
					$data 			= array();
					$data['result'] = 1;
					$data['data'] 	= $this->openid->user_info_wechat($uid, $username);
					output_msg($data, true);
				} elseif ($status) {
					output_errorMsg(422, 'The user is binded on 8264.', '8264账户已被绑定');
				} elseif ($status2) {
					output_errorMsg(422, 'The user is binded on wechat.', '微信账户已被绑定');
				}
			} else {
				$auth_result = $this->openid->allow_wechat($uid, $username, $wechatunionid, $wechatuserid, $wechatusername);
				if ($auth_result) {
					$data 			= array();
					$data['result'] = 1;
					$data['data'] 	= $this->openid->user_info_wechat($uid, $username);
					output_msg($data, true);
				} else {
					output_errorMsg(423, 'Authorization failed.', '绑定失败，请重新尝试');
				}

			}
		} else {
			output_errorMsg(421, 'Username or password error.', '用户名或密码错误');
		}
	}

	//注册8264用户，并绑定(微信)
	public function regist_wechat()
	{
		global $_G;

		//引入ucenter相关文件
		loaducenter();

		$_POST       		= iconv_array($_POST, "UTF-8", "gbk//TRANSLIT");
		$wechatunionid  	= $_POST['wechatunionid'];
		$wechatuserid   	= $_POST['wechatuserid'];
		$wechatusername   	= $_POST['wechatusername'];
		$username 			= isset($_POST['username']) ? $_POST['username'] : '';
		$email 				= trim($_POST['email']);
		$_G['gp_password']	= trim($_POST['password']);

		if(empty($username) || empty($email) || empty($_G['gp_password']) || empty($wechatunionid) || empty($wechatuserid) || empty($wechatusername)) {
			output_errorMsg(420, 'Param miss.', '请求失败，请联系8264客服');
		}

		// 验证用户是否已有授权记录
		if ($this->openid->isWechatAuthByUnionid($wechatunionid)) {
			output_errorMsg(431, 'this wechatunionid is authed.', '');
		}

		//start
		$bbrules 		= &$_G["setting"]['bbrules'];
		$bbrulesforce 	= &$_G["setting"]['bbrulesforce'];
		$bbrulestxt 	= &$_G["setting"]['bbrulestxt'];
		$welcomemsg 	= &$_G["setting"]['welcomemsg'];
		$welcomemsgtitle= &$_G["setting"]['welcomemsgtitle'];
		$welcomemsgtxt 	= &$_G["setting"]['welcomemsgtxt'];
		if ($_G["setting"]['regverify']) {
			if ($_G["setting"]['areaverifywhite']) {
				$location = $whitearea = '';
				$location = trim(convertip($_G['clientip'], "./"));
				if ($location) {
					$whitearea = preg_quote(trim($_G["setting"]['areaverifywhite']), '/');
					$whitearea = str_replace(array("\\*"), array('.*'), $whitearea);
					$whitearea = '.*' . $whitearea . '.*';
					$whitearea = '/^(' . str_replace(array("\r\n", ' '), array('.*|.*', ''), $whitearea) . ')$/i';
					if (@preg_match($whitearea, $location)) {
						$_G["setting"]['regverify'] = 0;
					}
				}
			}
			if ($_G['cache']['ipctrl']['ipverifywhite']) {
				foreach (explode("\n", $_G['cache']['ipctrl']['ipverifywhite']) as $ctrlip) {
					if (preg_match("/^(" . preg_quote(($ctrlip = trim($ctrlip)), '/') . ")/", $_G['clientip'])) {
						$_G["setting"]['regverify'] = 0;
						break;
					}
				}
			}
		}
		if ($_G["setting"]['regstatus'] == 2) {
			if ($_G["setting"]['inviteconfig']['inviteareawhite']) {
				$location = $whitearea = '';
				$location = trim(convertip($_G['clientip'], "./"));
				if ($location) {
					$whitearea = preg_quote(trim($_G["setting"]['inviteconfig']['inviteareawhite']), '/');
					$whitearea = str_replace(array("\\*"), array('.*'), $whitearea);
					$whitearea = '.*' . $whitearea . '.*';
					$whitearea = '/^(' . str_replace(array("\r\n", ' '), array('.*|.*', ''), $whitearea) . ')$/i';
				}
			}
		}
		$groupinfo = array();
		$groupinfo['groupid'] = $_G["setting"]['regverify'] ? 8 : $_G["setting"]['newusergroupid'];

		$bbrulehash = $bbrules ? substr(md5(FORMHASH), 0, 8) : '';

		//进入注册环节
		if ($bbrules && $bbrulehash != $_POST['agreebbrule']) {
			output_errorMsg(432, 'register_rules_agree.', '请同意用户注册协议');
		}

		$usernamelen = dstrlen($username);
		file_put_contents(DISCUZ_ROOT.'data/dlogs/unbinduser.log', 'regist|'.$usernamelen.'|'.$username.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
		if($usernamelen < 3 || $usernamelen > 15) {
			output_errorMsg(433, 'please input 3 to 15 words.', '请输入3-7位用户名');
		}

		$username = addslashes(trim(dstripslashes($username)));
		if (uc_get_user($username) && ! DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE username='$username'")) {
			output_errorMsg(434, 'profile_username_duplicate.', '用户名已注册');
		}

		if (empty($_G["setting"]['ignorepassword'])) {
			if (! $_G['gp_password'] || $_G['gp_password'] != addslashes($_G['gp_password'])) {
				output_errorMsg(435, 'profile_passwd_illegal.', '密码空或包含非法字符');
			}
			$password = $_G['gp_password'];
		} else {
			$password = md5(random(10));
		}

		$censorexp = '/^(' . str_replace(array(
			'\\*',
			"\r\n",
			' '), array(
			'.*',
			'|',
			''), preg_quote(($_G["setting"]['censoruser'] = trim($_G["setting"]['censoruser'])), '/')) . ')$/i';
		if ($_G["setting"]['censoruser'] && @preg_match($censorexp, $username)) {
			output_errorMsg(436, 'profile_username_protect.', '用户名包含被系统屏蔽的字符');
		}
		if ($_G["setting"]['regverify'] == 2 && ! trim($_G['gp_regmessage'])) {
			output_errorMsg(437, 'profile_required_info_invalid.', '请将账户信息填写完整');
		}
		if ($_G['cache']['ipctrl']['ipregctrl']) {
			foreach (explode("\n", $_G['cache']['ipctrl']['ipregctrl']) as $ctrlip) {
				if (preg_match("/^(" . preg_quote(($ctrlip = trim($ctrlip)), '/') . ")/", $_G['clientip'])) {
					$ctrlip = $ctrlip . '%';
					$_G["setting"]['regctrl'] = $_G["setting"]['ipregctrltime'];
					break;
				} else {
					$ctrlip = $_G['clientip'];
				}
			}
		} else {
			$ctrlip = $_G['clientip'];
		}
		if ($_G["setting"]['regctrl']) {
			$query = DB::query("SELECT ip FROM " . DB::table('common_regip') . " WHERE ip LIKE '$ctrlip' AND count='-1' AND dateline>$_G[timestamp]-'" . $_G["setting"]['regctrl'] . "'*3600 LIMIT 1");
			if (DB::num_rows($query)) {
				output_errorMsg(438, 'register_ctrl.', '60分钟内已成功注册过，请稍后再试');
			}
		}
		$regipsql = '';
		if ($_G["setting"]['regfloodctrl']) {
			if ($regattempts = DB::result_first("SELECT count FROM " . DB::table('common_regip') . " WHERE ip='$_G[clientip]' AND count>'0' AND dateline>'$_G[timestamp]'-86400")) {
				if ($regattempts >= $_G["setting"]['regfloodctrl']) {
					output_errorMsg(439, 'register_flood_ctrl.', '24小时内已注册过5次，请稍后再试');
				} else {
					$regipsql = "UPDATE " . DB::table('common_regip') . " SET count=count+1 WHERE ip='$_G[clientip]' AND count>'0'";
				}
			} else {
				$regipsql = "INSERT INTO " . DB::table('common_regip') . " (ip, count, dateline) VALUES ('$_G[clientip]', '1', '$_G[timestamp]')";
			}
		}
		$profile = $verifyarr = array();
		if (! $activation) {
			$uid = uc_user_register($username, $password, $email, $questionid, $answer, $_G['clientip']);
			if ($uid <= 0) {
				if ($uid == -1) {
					output_errorMsg(440, 'profile_username_illegal.', '用户名包含敏感字符');
				} elseif ($uid == -2) {
					output_errorMsg(441, 'profile_username_protect.', '用户名包含被系统屏蔽的字符');
				} elseif ($uid == -3) {
					output_errorMsg(442, 'profile_username_duplicate.', '用户名已注册');
				} elseif ($uid == -4) {
					output_errorMsg(443, 'profile_email_illegal.', '邮箱格式不正确');
				} elseif ($uid == -5) {
					output_errorMsg(444, 'profile_email_domain_illegal.', 'Email包含不可使用的邮箱域名');
				} elseif ($uid == -6) {
					output_errorMsg(445, 'profile_email_duplicate.', '该Email地址已经被注册');
				} else {
					output_errorMsg(446, 'undefined_action.', '');
				}
			}
		} else {
			list($uid, $username, $email) = $activation;
		}
		$_G['username'] = $username;
		if (DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE uid='$uid'")) {
			if (! $activation) {
				uc_user_delete($uid);
			}
			output_errorMsg(431, 'profile_uid_duplicate.', '用户id被占用');
		}
		$password = md5(random(10));
		$secques = $questionid > 0 ? random(8) : '';
		if ($regipsql) {
			DB::query($regipsql);
		}

		$init_arr = explode(',', $_G["setting"]['initcredits']);
		$userdata = array(
			'uid' 		 => $uid,
			'username' 	 => $username,
			'password' 	 => $password,
			'email' 	 => $email,
			'adminid' 	 => 0,
			'groupid' 	 => $groupinfo['groupid'],
			'regdate' 	 => TIMESTAMP,
			'credits' 	 => $init_arr[0],
			'timeoffset' => 9999
		);
		$status_data = array(
			'uid' 			=> $uid,
			'regip' 		=> $_G['clientip'],
			'lastip' 		=> $_G['clientip'],
			'lastvisit' 	=> TIMESTAMP,
			'lastactivity' 	=> TIMESTAMP,
			'lastpost' 		=> 0,
			'lastsendmail' 	=> 0,
		);
		$profile['uid'] 	= $uid;
		$field_forum['uid'] = $uid;
		$field_home['uid'] 	= $uid;
		DB::insert('common_member', $userdata);
		DB::insert('common_member_status', $status_data);
		DB::insert('common_member_profile', $profile);
		DB::insert('common_member_field_forum', $field_forum);
		DB::insert('common_member_field_home', $field_home);

		//start记录用户注册状态
		addrecorduserinfo($uid, 1);

		$querys = DB::query("SELECT uid,username FROM " . DB::table('home_specialuser') . " WHERE 1=1 ");
		while ($values = DB::fetch($querys)) {
			if ($values) {
				$dateline = TIMESTAMP;
				DB::query("insert into " . DB::table('home_friend') . " (uid, fuid, fusername, gid, num, dateline, note) values ('$uid','$values[uid]','$values[username]','0','0','$dateline','')");
				DB::query("insert into " . DB::table('home_friend') . " (uid, fuid, fusername, gid, num, dateline, note) values ('$values[uid]','$uid','$username','0','0','$dateline','')");
			}
		}
		if ($verifyarr) {
			$setverify = array(
				'uid' => $uid,
				'username' => $username,
				'verifytype' => '0',
				'field' => daddslashes(serialize($verifyarr)),
				'dateline' => TIMESTAMP,
				);
			DB::insert('common_member_verify_info', $setverify);
			DB::insert('common_member_verify', array('uid' => $uid));
		}
		$count_data = array(
			'uid' => $uid,
			'extcredits1' => $init_arr[1],
			'extcredits2' => $init_arr[2],
			'extcredits3' => $init_arr[3],
			'extcredits4' => $init_arr[4],
			'extcredits5' => $init_arr[5],
			'extcredits6' => $init_arr[6],
			'extcredits7' => $init_arr[7],
			'extcredits8' => $init_arr[8]);
		DB::insert('common_member_count', $count_data);
		manyoulog('user', $uid, 'add');

		$showtotalmembers = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='showtotalmembers' " . getSlaveID());
		$userstats = array('totalmembers' => $showtotalmembers, 'newsetuser' => $username);
		save_syscache('userstats', $userstats);
		if ($_G["setting"]['regctrl'] || $_G["setting"]['regfloodctrl']) {
			DB::query("DELETE FROM " . DB::table('common_regip') . " WHERE dateline<='$_G[timestamp]'-" . ($_G["setting"]['regctrl'] > 72 ? $_G["setting"]['regctrl'] : 72) . "*3600", 'UNBUFFERED');
			if ($_G["setting"]['regctrl']) {
				DB::query("INSERT INTO " . DB::table('common_regip') . " (ip, count, dateline) VALUES ('$_G[clientip]', '-1', '$_G[timestamp]')");
			}
		}
		$regmessage = dhtmlspecialchars($_G['gp_regmessage']);
		if ($_G["setting"]['regverify'] == 2) {
			DB::query("REPLACE INTO " . DB::table('common_member_validate') . " (uid, submitdate, moddate, admin, submittimes, status, message, remark)	VALUES ('$uid', '$_G[timestamp]', '0', '', '1', '0', '$regmessage', '')");
			manage_addnotify('verifyuser');
		}

		//记录用户状态,这里面记录了$_G["cookie"]["auth"]
		include_once libfile('function/member');
		setloginstatus(array(
			'uid' => $uid,
			'username' => dstripslashes($_G['username']),
			'password' => $password,
			'groupid' => $groupinfo['groupid'],
		), 0);

		include_once libfile('function/stat');
		updatestat('register');

		$query = DB::query("SELECT * FROM " . DB::table('common_setting') . " WHERE skey IN ('bbrules', 'bbrulesforce', 'bbrulestxt', 'welcomemsg', 'welcomemsgtitle', 'welcomemsgtxt', 'inviteconfig')");
		while ($setting = DB::fetch($query)) {
			$$setting['skey'] = $setting['svalue'];
		}
		if ($welcomemsg && ! empty($welcomemsgtxt)) {
			$welcomemsgtitle = addslashes(replacesitevar($welcomemsgtitle));
			$welcomemsgtxt   = addslashes(replacesitevar($welcomemsgtxt));
			if ($welcomemsg == 1) {
				$welcomemsgtxt = nl2br(str_replace(':', '&#58;', $welcomemsgtxt));
				notification_add($uid, 'system', $welcomemsgtxt, array(), 1);
			} elseif ($welcomemsg == 2) {
				sendmail_cron($email, $welcomemsgtitle, $welcomemsgtxt);
			} elseif ($welcomemsg == 3) {
				sendmail_cron($email, $welcomemsgtitle, $welcomemsgtxt);
				$welcomemsgtxt = nl2br(str_replace(':', '&#58;', $welcomemsgtxt));
				notification_add($uid, 'system', $welcomemsgtxt, array(), 1);
			}
		}
		dsetcookie('loginuser', '');
		dsetcookie('activationauth', '');
		dsetcookie('invite_auth', '');
		//end

		//绑定，授权
		$auth_result = $this->openid->allow_wechat($uid, $username, $wechatunionid, $wechatuserid, $wechatusername);
		if($auth_result) {
			$data 			= array();
			$data['msg']    = array("code" => 200, "info" => "User bind success.");
			$data['data'] 	= $this->openid->user_info_wechat($uid, $username);
			output_msg($data, true);
		} else {
			output_errorMsg(423, 'User bind failed.', '网络连接失败，请重新尝试');
		}
	}

	//根据unionid获得用户信息(微信)
	public function user_info_wechatunionid()
	{
		$wechatunionid = $_POST['wechatunionid'];

		if(empty($wechatunionid)) {
			output_errorMsg(420, 'Param miss.', '请求失败，请联系8264客服');
		}

		$wechatShow  = $this->openid->user_info_wechatunionid($wechatunionid);
		if ($wechatShow) {
			$data 			= array();
			$data['result'] = 1;
			$data['data'] 	= $wechatShow;
			output_msg($data, true);
		} else {
			output_errorMsg(423, 'This unionid is not bind.', '这个微信账号还没绑定8264账号');
		}
	}

	//app修改appusername时，调用
	public function update_appusername()
	{

		$appuid = number_format($_GET['appuid'], 0, ".", '');
		$appusername = diconv($_GET['appusername'],'UTF-8','GBK');

		if(empty($appuid) || empty($appusername)) {
			output_errorMsg(420, 'Param miss.', '');
		}

		DB::update('common_openid', array('appusername' => $appusername), "appuid='{$appuid}'");
		DB::update('forum_activityapply', array('appusername' => $appusername), "appuserid='{$appuid}'");

		$data 			= array();
		$data['result'] = 1;
		output_msg($data, true);
	}

	// 接收8264账号密码返回登陆状态
	public function login_8264()
	{
		$username = diconv($_GET['username'],'UTF-8','GBK');
		$password = $_GET['password'];

		if(empty($username) || empty($password)) {
			output_errorMsg(420, 'Invalid username or password.', '用户名或密码为空');
		}

		require DISCUZ_ROOT.'source/function/function_member.php';

		$result = userlogin($username, $password, '', '', 'username');
		$uid = $result['ucresult']['uid'];

		if ($uid && $result['status'] > 0) {
			$data['msg']['info'] = 'Login success.';
			$data['msg']['code'] = 200;
			$data['data']['uid'] = $result['member']['uid'];
			$data['data']['email'] = $result['member']['email'];
			$data['data']['username'] = $result['member']['username'];
			output_msg($data, true);
		} else {
			output_errorMsg(421, 'Username or password error.', '用户名或密码错误');
		}

	}


        // 接收8264账号密码返回登陆状态
	public function regist_8264()
	{
            global $_G;
            //引入ucenter相关文件
            loaducenter();



            $username 			= diconv($_GET['username'],'UTF-8','GBK');
            $email 			= $username.'@hd8264.com';
            $password	= trim($_GET['password']);
            $_G['gp_password'] = $password;

            if(empty($username) || empty($password)) {
			output_errorMsg(420, 'Invalid username or password.', '用户名或密码为空');
            }

            //进入注册环节
            $usernamelen = dstrlen($username);
            file_put_contents(DISCUZ_ROOT.'data/dlogs/unbinduser.log', 'regist|'.$usernamelen.'|'.$username.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
            if($usernamelen < 3 || $usernamelen > 15) {
                    output_errorMsg(433, 'please input 3 to 15 words.', '请输入3-15位用户名');
            }

            $username = addslashes(trim(dstripslashes($username)));
            if (uc_get_user($username) && ! DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE username='$username'")) {
                    output_errorMsg(434, 'profile_username_duplicate.', '用户名已注册');
            }

            if (empty($_G["setting"]['ignorepassword'])) {
                    if (! $_G['gp_password'] || $_G['gp_password'] != addslashes($_G['gp_password'])) {
                            output_errorMsg(435, 'profile_passwd_illegal.', '密码空或包含非法字符');
                    }
                    $password = $_G['gp_password'];
            } else {
                    $password = md5(random(10));
            }

            $censorexp = '/^(' . str_replace(array(
			'\\*',
			"\r\n",
			' '), array(
			'.*',
			'|',
			''), preg_quote(($_G["setting"]['censoruser'] = trim($_G["setting"]['censoruser'])), '/')) . ')$/i';
            if ($_G["setting"]['censoruser'] && @preg_match($censorexp, $username)) {
                    output_errorMsg(436, 'profile_username_protect.', '用户名包含被系统屏蔽的字符');
            }
            if ($_G["setting"]['regverify'] == 2 && ! trim($_G['gp_regmessage'])) {
                    output_errorMsg(437, 'profile_required_info_invalid.', '请将账户信息填写完整');
            }
            if ($_G['cache']['ipctrl']['ipregctrl']) {
                    foreach (explode("\n", $_G['cache']['ipctrl']['ipregctrl']) as $ctrlip) {
                            if (preg_match("/^(" . preg_quote(($ctrlip = trim($ctrlip)), '/') . ")/", $_G['clientip'])) {
                                    $ctrlip = $ctrlip . '%';
                                    $_G["setting"]['regctrl'] = $_G["setting"]['ipregctrltime'];
                                    break;
                            } else {
                                    $ctrlip = $_G['clientip'];
                            }
                    }
            } else {
                    $ctrlip = $_G['clientip'];
            }


            if ($_G["setting"]['regctrl']) {
			$query = DB::query("SELECT ip FROM " . DB::table('common_regip') . " WHERE ip LIKE '$ctrlip' AND count='-1' AND dateline>$_G[timestamp]-'" . $_G["setting"]['regctrl'] . "'*3600 LIMIT 1");
			if (DB::num_rows($query)) {
				output_errorMsg(438, 'register_ctrl.', '60分钟内已成功注册过，请稍后再试');
			}
		}
            $regipsql = '';
            if ($_G["setting"]['regfloodctrl']) {
                    if ($regattempts = DB::result_first("SELECT count FROM " . DB::table('common_regip') . " WHERE ip='$_G[clientip]' AND count>'0' AND dateline>'$_G[timestamp]'-86400")) {
                            if ($regattempts >= $_G["setting"]['regfloodctrl']) {
                                    output_errorMsg(439, 'register_flood_ctrl.', '24小时内已注册过5次，请稍后再试');
                            } else {
                                    $regipsql = "UPDATE " . DB::table('common_regip') . " SET count=count+1 WHERE ip='$_G[clientip]' AND count>'0'";
                            }
                    } else {
                            $regipsql = "INSERT INTO " . DB::table('common_regip') . " (ip, count, dateline) VALUES ('$_G[clientip]', '1', '$_G[timestamp]')";
                    }
            }
            $profile = $verifyarr = array();
            if (! $activation) {
                    $uid = uc_user_register($username, $password, $email, $questionid, $answer, $_G['clientip']);
                    if ($uid <= 0) {
                            if ($uid == -1) {
                                    output_errorMsg(440, 'profile_username_illegal.', '用户名包含敏感字符');
                            } elseif ($uid == -2) {
                                    output_errorMsg(441, 'profile_username_protect.', '用户名包含被系统屏蔽的字符');
                            } elseif ($uid == -3) {
                                    output_errorMsg(442, 'profile_username_duplicate.', '用户名已注册');
                            } elseif ($uid == -4) {
                                    output_errorMsg(443, 'profile_email_illegal.', '邮箱格式不正确');
                            } elseif ($uid == -5) {
                                    output_errorMsg(444, 'profile_email_domain_illegal.', 'Email包含不可使用的邮箱域名');
                            } elseif ($uid == -6) {
                                    output_errorMsg(445, 'profile_email_duplicate.', '该Email地址已经被注册');
                            } else {
                                    output_errorMsg(446, 'undefined_action.', '');
                            }
                    }
            } else {
                    list($uid, $username, $email) = $activation;
            }
            $_G['username'] = $username;
            if (DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE uid='$uid'")) {
                    if (! $activation) {
                            uc_user_delete($uid);
                    }
                    output_errorMsg(431, 'profile_uid_duplicate.', '用户id被占用');
            }
            $password = md5(random(10));
            $secques = $questionid > 0 ? random(8) : '';
            if ($regipsql) {
                    DB::query($regipsql);
            }

            $init_arr = explode(',', $_G["setting"]['initcredits']);
            $userdata = array(
                    'uid' 		 => $uid,
                    'username' 	 => $username,
                    'password' 	 => $password,
                    'email' 	 => $email,
                    'adminid' 	 => 0,
                    'groupid' 	 => $groupinfo['groupid'],
                    'regdate' 	 => TIMESTAMP,
                    'credits' 	 => $init_arr[0],
                    'timeoffset' => 9999
            );
            $status_data = array(
                    'uid' 			=> $uid,
                    'regip' 		=> $_G['clientip'],
                    'lastip' 		=> $_G['clientip'],
                    'lastvisit' 	=> TIMESTAMP,
                    'lastactivity' 	=> TIMESTAMP,
                    'lastpost' 		=> 0,
                    'lastsendmail' 	=> 0,
            );
            $profile['uid'] 	= $uid;
            $field_forum['uid'] = $uid;
            $field_home['uid'] 	= $uid;
            DB::insert('common_member', $userdata);
            DB::insert('common_member_status', $status_data);
            DB::insert('common_member_profile', $profile);
            DB::insert('common_member_field_forum', $field_forum);
            DB::insert('common_member_field_home', $field_home);

            //start记录用户注册状态
            addrecorduserinfo($uid, 1);

            $querys = DB::query("SELECT uid,username FROM " . DB::table('home_specialuser') . " WHERE 1=1 ");
            while ($values = DB::fetch($querys)) {
                    if ($values) {
                            $dateline = TIMESTAMP;
                            DB::query("insert into " . DB::table('home_friend') . " (uid, fuid, fusername, gid, num, dateline, note) values ('$uid','$values[uid]','$values[username]','0','0','$dateline','')");
                            DB::query("insert into " . DB::table('home_friend') . " (uid, fuid, fusername, gid, num, dateline, note) values ('$values[uid]','$uid','$username','0','0','$dateline','')");
                    }
            }
            if ($verifyarr) {
                    $setverify = array(
                            'uid' => $uid,
                            'username' => $username,
                            'verifytype' => '0',
                            'field' => daddslashes(serialize($verifyarr)),
                            'dateline' => TIMESTAMP,
                            );
                    DB::insert('common_member_verify_info', $setverify);
                    DB::insert('common_member_verify', array('uid' => $uid));
            }
            $count_data = array(
                    'uid' => $uid,
                    'extcredits1' => $init_arr[1],
                    'extcredits2' => $init_arr[2],
                    'extcredits3' => $init_arr[3],
                    'extcredits4' => $init_arr[4],
                    'extcredits5' => $init_arr[5],
                    'extcredits6' => $init_arr[6],
                    'extcredits7' => $init_arr[7],
                    'extcredits8' => $init_arr[8]);
            DB::insert('common_member_count', $count_data);
            manyoulog('user', $uid, 'add');

            $showtotalmembers = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='showtotalmembers' " . getSlaveID());
            $userstats = array('totalmembers' => $showtotalmembers, 'newsetuser' => $username);
            save_syscache('userstats', $userstats);
            if ($_G["setting"]['regctrl'] || $_G["setting"]['regfloodctrl']) {
                    DB::query("DELETE FROM " . DB::table('common_regip') . " WHERE dateline<='$_G[timestamp]'-" . ($_G["setting"]['regctrl'] > 72 ? $_G["setting"]['regctrl'] : 72) . "*3600", 'UNBUFFERED');
                    if ($_G["setting"]['regctrl']) {
                            DB::query("INSERT INTO " . DB::table('common_regip') . " (ip, count, dateline) VALUES ('$_G[clientip]', '-1', '$_G[timestamp]')");
                    }
            }
            $regmessage = dhtmlspecialchars($_G['gp_regmessage']);
            if ($_G["setting"]['regverify'] == 2) {
                    DB::query("REPLACE INTO " . DB::table('common_member_validate') . " (uid, submitdate, moddate, admin, submittimes, status, message, remark)	VALUES ('$uid', '$_G[timestamp]', '0', '', '1', '0', '$regmessage', '')");
                    manage_addnotify('verifyuser');
            }

            //记录用户状态,这里面记录了$_G["cookie"]["auth"]
            include_once libfile('function/member');
            setloginstatus(array(
                    'uid' => $uid,
                    'username' => dstripslashes($_G['username']),
                    'password' => $password,
                    'groupid' => $groupinfo['groupid'],
            ), 0);

            include_once libfile('function/stat');
            updatestat('register');

            $query = DB::query("SELECT * FROM " . DB::table('common_setting') . " WHERE skey IN ('bbrules', 'bbrulesforce', 'bbrulestxt', 'welcomemsg', 'welcomemsgtitle', 'welcomemsgtxt', 'inviteconfig')");
            while ($setting = DB::fetch($query)) {
                    $$setting['skey'] = $setting['svalue'];
            }
            if ($welcomemsg && ! empty($welcomemsgtxt)) {
                    $welcomemsgtitle = addslashes(replacesitevar($welcomemsgtitle));
                    $welcomemsgtxt   = addslashes(replacesitevar($welcomemsgtxt));
                    if ($welcomemsg == 1) {
                            $welcomemsgtxt = nl2br(str_replace(':', '&#58;', $welcomemsgtxt));
                            notification_add($uid, 'system', $welcomemsgtxt, array(), 1);
                    } elseif ($welcomemsg == 2) {
                            sendmail_cron($email, $welcomemsgtitle, $welcomemsgtxt);
                    } elseif ($welcomemsg == 3) {
                            sendmail_cron($email, $welcomemsgtitle, $welcomemsgtxt);
                            $welcomemsgtxt = nl2br(str_replace(':', '&#58;', $welcomemsgtxt));
                            notification_add($uid, 'system', $welcomemsgtxt, array(), 1);
                    }
            }
            dsetcookie('loginuser', '');
            dsetcookie('activationauth', '');
            dsetcookie('invite_auth', '');
            //end

            if ($uid) {
                    $data['msg']['info'] = 'reg success.';
                    $data['msg']['code'] = 200;
                    $data['data']['uid'] = $uid;
                    $data['data']['email'] = $email;
                    $data['data']['username'] = $username;
                    output_msg($data, true);
            } else {
                    output_errorMsg(421, 'regist error.', '注册失败');
            }





        }

}
