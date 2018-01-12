<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class RegisterCtl extends FrontendCtl{

	function __construct()
	{
		parent::__construct();

		require_once libfile('function/misc');
        require_once libfile('function/verify');

        //引入ucenter相关文件
		loaducenter();
	}

	//注册表单
	function form() 
	{	
		global $_G;
		global $returnData;

		$returnData["isYzm"] = regIsAppearVerify($_G['gp_ip']);
		encodeData($returnData);
		
	}	
	
	//检查用户名--源自source/module/forum/forum_ajax.php
	function ajaxCheckusername()
	{
		global $_G;
		global $returnData;

		$username    = iconv("utf-8","gbk//TRANSLIT",$_G['gp_username']);
		$username 	 = trim($username);
		$usernamelen = dstrlen($username);
		if($usernamelen < 3 || $usernamelen > 15) {
			encodeData(array('error'=>true , 'errorinfo'=>'请输入3-15个字符！'));
		}

		$ucresult = uc_user_checkname($username);

		if($ucresult == -1) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_username_illegal')));
		} elseif($ucresult == -2) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_username_protect')));
		} elseif($ucresult == -3) {
			if(DB::result_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$username'")) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('forum/wap_new', 'register_check_found')));
			} else {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'register_activation')));
			}
		}

		encodeData($returnData);
	}

	//检查邮箱--源自source/module/forum/forum_ajax.php
	function ajaxCheckemail()
	{
		global $_G;
		global $returnData;

		$email = trim($_G['gp_email']);

		$ucresult = uc_user_checkemail($email);

		if($ucresult == -4) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_email_illegal')));
		} elseif($ucresult == -5) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_email_domain_illegal')));
		} elseif($ucresult == -6) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_email_duplicate')));
		}

		encodeData($returnData);
	}

	//注册--源自class/class_member.php的on_register()
	function doRegister()
	{
		global $_G;
		global $returnData;

		if ($_G['uid'] && ! $_G["setting"]['regclosed'] && (! $_G["setting"]['regstatus'] || ! $_G["setting"]['ucactivation'])) {
			if ($_G['gp_action'] == 'activation' || $_G["setting"]['gp_activationauth']) {
				if (! $_G["setting"]['ucactivation'] && ! $_G["setting"]['closedallowactivation']) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'register_disable_activation')));
				}
			} elseif (! $_G["setting"]['regstatus']) {
				$message = ! $_G["setting"]['regclosemessage'] ? lang('message', 'register_disable') : str_replace(array("\r", "\n"), '', $_G["setting"]['regclosemessage']);
				encodeData(array('error'=>true , 'errorinfo'=>$message));
			}
		}
		$bbrules 		= &$_G["setting"]['bbrules'];
		$bbrulesforce 	= &$_G["setting"]['bbrulesforce'];
		$bbrulestxt 	= &$_G["setting"]['bbrulestxt'];
		$welcomemsg 	= &$_G["setting"]['welcomemsg'];
		$welcomemsgtitle= &$_G["setting"]['welcomemsgtitle'];
		$welcomemsgtxt 	= &$_G["setting"]['welcomemsgtxt'];
		$regname 		= $_G["setting"]['regname'];
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
		$invitestatus = false;
		if ($_G["setting"]['regstatus'] == 2) {
			if ($_G["setting"]['inviteconfig']['inviteareawhite']) {
				$location = $whitearea = '';
				$location = trim(convertip($_G['clientip'], "./"));
				if ($location) {
					$whitearea = preg_quote(trim($_G["setting"]['inviteconfig']['inviteareawhite']), '/');
					$whitearea = str_replace(array("\\*"), array('.*'), $whitearea);
					$whitearea = '.*' . $whitearea . '.*';
					$whitearea = '/^(' . str_replace(array("\r\n", ' '), array('.*|.*', ''), $whitearea) . ')$/i';
					if (@preg_match($whitearea, $location)) {
						$invitestatus = true;
					}
				}
			}
			if ($_G["setting"]['inviteconfig']['inviteipwhite']) {
				foreach (explode("\n", $_G["setting"]['inviteconfig']['inviteipwhite']) as $ctrlip) {
					if (preg_match("/^(" . preg_quote(($ctrlip = trim($ctrlip)), '/') . ")/", $_G['clientip'])) {
						$invitestatus = true;
						break;
					}
				}
			}
		}
		$groupinfo = array();
		if ($_G["setting"]['regverify']) {
			$groupinfo['groupid'] = 8;
		} else {
			$groupinfo['groupid'] = $_G["setting"]['newusergroupid'];
		}
		$secqaacheck 	= regIsAppearVerify($_G['gp_ip']);
		$fromuid  		= ! empty($_G['cookie']['promotion']) && $_G["setting"]['creditspolicy']['promotion_register'] ? intval($_G['cookie']['promotion']) : 0;
		$username 		= isset($_G['gp_username']) ? iconv("utf-8","gbk//TRANSLIT",$_G['gp_username']) : '';
		$bbrulehash 	= $bbrules ? substr(md5(FORMHASH), 0, 8) : '';
		$auth 			= $_G['gp_auth'];
		if (! $invitestatus) {
			$invite = getinvite();
		}
		//进入注册环节
		if (submitcheck('reg_submit', 0, 0, $secqaacheck, 'wap')) {

			//接下由客户端那边得到的真实ip
			$_G[clientip] = $_G['gp_ip'];

			if ($_G["setting"]['regstatus'] == 2 && empty($invite) && ! $invitestatus) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'not_open_registration_invite')));
			}
			if ($bbrules && $bbrulehash != $_POST['agreebbrule']) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'register_rules_agree')));
			}
			$activation = array();
			if (isset($_G['gp_activationauth'])) {
				$activationauth = explode("\t", authcode($_G['gp_activationauth'], 'DECODE'));
				if ($activationauth[1] == FORMHASH && ! ($activation = daddslashes(uc_get_user($activationauth[0]), 1))) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'register_activation_invalid')));
				}
			}
			if (! $activation) {
				$usernamelen = dstrlen($username);
				if($usernamelen < 3 || $usernamelen > 15) {
					encodeData(array('error'=>true , 'errorinfo'=>'请输入3-15个字符！'));
				}
                //密码长度限定在6-16位，且非全数字
                $pwlen = strlen($_G['gp_password']);
                if ($pwlen < 6 || $pwlen > 16 || preg_match('/^\d*$/', $_G['gp_password'])) {
                        //showmessage('密码长度需在6-16位之内，且非全数字');
                        encodeData(array('error'=>true , 'errorinfo'=>'密码长度需在6-16位之内，且非全数字'));
                }

				$username = addslashes(trim(dstripslashes($username)));
				if (uc_get_user($username) && ! DB::result_first("SELECT uid FROM " . DB::table('common_member') . " WHERE username='$username'")) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_username_duplicate')));
				}
				$email = trim($_G['gp_email']);
				if (empty($_G["setting"]['ignorepassword'])) {
					if (! $_G['gp_password'] || $_G['gp_password'] != addslashes($_G['gp_password'])) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_passwd_illegal')));
					}
					$password = $_G['gp_password'];
				} else {
					$password = md5(random(10));
				}
			}
			$censorexp = '/^(' . str_replace(array(
				'\\*',
				"\r\n",
				' '), array(
				'.*',
				'|',
				''), preg_quote(($_G["setting"]['censoruser'] = trim($_G["setting"]['censoruser'])), '/')) . ')$/i';
			if ($_G["setting"]['censoruser'] && @preg_match($censorexp, $username)) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_username_protect')));
			}
			if ($_G["setting"]['regverify'] == 2 && ! trim($_G['gp_regmessage'])) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_required_info_invalid')));
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
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'register_ctrl', array('regctrl' => $_G["setting"]['regctrl']))));
				}
			}
			$regipsql = '';
			if ($_G["setting"]['regfloodctrl']) {
				if ($regattempts = DB::result_first("SELECT count FROM " . DB::table('common_regip') . " WHERE ip='$_G[clientip]' AND count>'0' AND dateline>'$_G[timestamp]'-86400")) {
					if ($regattempts >= $_G["setting"]['regfloodctrl']) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'register_flood_ctrl', array('regfloodctrl' => $_G["setting"]['regfloodctrl']))));
					} else {
						$regipsql = "UPDATE " . DB::table('common_regip') . " SET count=count+1 WHERE ip='$_G[clientip]' AND count>'0'";
					}
				} else {
					$regipsql = "INSERT INTO " . DB::table('common_regip') . " (ip, count, dateline) VALUES ('$_G[clientip]', '1', '$_G[timestamp]')";
				}
			}
			$profile = $verifyarr = array();

			if (! $activation) {
				$uid = uc_user_register($username, $password, $email, '', '', $_G['clientip']);
				if ($uid <= 0) {
					if ($uid == -1) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_username_illegal')));
					} elseif ($uid == -2) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_username_protect')));
					} elseif ($uid == -3) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_username_duplicate')));
					} elseif ($uid == -4) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_email_illegal')));
					} elseif ($uid == -5) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_email_domain_illegal')));
					} elseif ($uid == -6) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_email_duplicate')));
					} else {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'undefined_action')));
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
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'profile_uid_duplicate', array('uid' => $uid))));
			}
			$password = md5(random(10));

            if ($regipsql) {
				DB::query($regipsql);
			}
			if ($invite && $_G["setting"]['inviteconfig']['invitegroupid']) {
				$groupinfo['groupid'] = $_G["setting"]['inviteconfig']['invitegroupid'];
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

            //qq注册
            $openid = !empty($_G['gp_openid']) ? $_G['gp_openid'] : "";
            if($openid){
                $qq_data = array(
                    'uid' =>$uid,
                    'conopenid' => $openid,
                    'conisregister' => 1,

                );
                $userdata['conisbind']= 1;

                $connect_member = DB::fetch_first("SELECT uid FROM " . DB::table('common_member_connect') . " WHERE uid='$uid'");
                if ($connect_member) {
                    DB::query("UPDATE " . DB::table('common_member_connect') . " SET conopenid='$openid' WHERE uid='$uid'");
                } else {
                    DB::insert('common_member_connect', $qq_data);
                }
                $bind_log = array(
                    'uid' =>$uid,
                    'type' => 1,
                    'dateline' => $_G['timestamp'],
                );
                DB::insert('connect_memberbindlog', $bind_log);
            }
            //微博注册

            $wb = !empty($_G['gp_wb']) ? $_G['gp_wb'] : "";
            $access_token = !empty($_G['gp_access_token']) ? $_G['gp_access_token'] : "";
            $sina_uid = !empty($_G['gp_sina_uid']) ? $_G['gp_sina_uid'] : "";
            if($wb){
                $connect_member = DB::fetch_first("SELECT uid FROM " . DB::table('xwb_bind_info') . " WHERE uid='$uid'");
                if ($connect_member) {
                    DB::query("UPDATE " . DB::table('common_member_connect') . " SET sina_uid='$sina_uid',token='$access_token' WHERE uid='$uid'");
                } else {
                    $wb_data = array(
                        'uid' => $uid,
                        'sina_uid' => $sina_uid,
                        'token' => $access_token,
                        'tsecret' => '',
                        'profile' => '[]'

                    );
                    DB::insert('xwb_bind_info', $wb_data);
                }
            }
            //微信注册
            $unionid = !empty($_G['gp_unionid']) ? $_G['gp_unionid'] : "";
            if($unionid){
                $connect_member = DB::fetch_first("SELECT uid FROM " . DB::table('common_member_connect_wechat') . " WHERE uid='$uid'");
                if($connect_member){
                    DB::query("UPDATE " . DB::table('common_member_connect_wechat') . " SET unionid='$unionid',bind_time='$_G[timestamp]' WHERE uid='$uid'");
                }else{
                    $wechat_data = array(
                        'uid' => $uid,
                        'unionid' => $unionid,
                        'bind_time' => $_G['timestamp']
                    );
                    DB::insert('common_member_connect_wechat', $wechat_data);
                }
            }

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
			// $totalmembers = DB::result_first("SELECT COUNT(*) FROM " . DB::table('common_member'));
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
			setloginstatus(array(
				'uid' => $uid,
				'username' => dstripslashes($_G['username']),
				'password' => $password,
				'groupid' => $groupinfo['groupid'],
			), 0);

			$returnData['uid'] = $uid;
			$returnData['username'] = $username;
			$returnData['G']['member']	  = $_G['member'];
			$returnData['G']['group']  	  = $_G['group'];
			$returnData['G']['formhash']  = formhash();
			$returnData["G"]["auth"] 	  = !empty($_G["cookie"]["auth"]) ? $_G["cookie"]["auth"] : "";

			include_once libfile('function/stat');
			updatestat('register');
			if ($invite['id']) {
				$result = DB::result_first("SELECT COUNT(*) FROM " . DB::table('common_invite') . " WHERE uid='$invite[uid]' AND fuid='$uid'");
				if (! $result) {
					DB::update("common_invite", array(
						'fuid' => $uid,
						'fusername' => $_G['username'],
						'regdateline' => $_G['timestamp'],
						'status' => 2), array('id' => $invite['id']));
					updatestat('invite');
				} else {
					$invite = array();
				}
			}
			if ($invite['uid']) {
				if ($_G["setting"]['inviteconfig']['inviteaddcredit']) {
					updatemembercount($uid, array($_G["setting"]['inviteconfig']['inviterewardcredit'] => $_G["setting"]['inviteconfig']['inviteaddcredit']));
				}
				if ($_G["setting"]['inviteconfig']['invitedaddcredit']) {
					updatemembercount($invite['uid'], array($_G["setting"]['inviteconfig']['inviterewardcredit'] => $_G["setting"]['inviteconfig']['invitedaddcredit']));
				}
				require_once libfile('function/friend');
				friend_make($invite['uid'], $invite['username'], false);
				notification_add($invite['uid'], 'friend', 'invite_friend', array('actor' => '<a href="home.php?mod=space&uid=' . $invite['uid'] . '" target="_blank">' . $invite['username'] . '</a>'), 1);
				space_merge($invite, 'field_home');
				if ($invite['appid']) {
					updatestat('appinvite');
				}
			}
			$inviteconfig = array();
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
			if ($fromuid) {
				updatecreditbyaction('promotion_register', $fromuid);
				dsetcookie('promotion', '');
			}
			dsetcookie('loginuser', '');
			dsetcookie('activationauth', '');
			dsetcookie('invite_auth', '');
			switch ($_G["setting"]['regverify']) {
				case 1:
					$idstring = random(6);
					$authstr = $_G["setting"]['regverify'] == 1 ? "$_G[timestamp]\t2\t$idstring" : '';
					DB::query("UPDATE " . DB::table('common_member_field_forum') . " SET authstr='$authstr' WHERE uid='$_G[uid]'");
					$verifyurl = "{$_G[siteurl]}member.php?mod=activate&amp;uid={$_G[uid]}&amp;id=$idstring";
					$email_verify_message = lang('email', 'email_verify_message', array(
						'username' => $_G['member']['username'],
						'bbname' => $_G["setting"]['bbname'],
						'siteurl' => $_G['siteurl'],
						'url' => $verifyurl));
					sendmail("$username <$email>", lang('email', 'email_verify_subject'), $email_verify_message);
					$message = 'register_email_verify';
					$locationmessage = 'register_email_verify_location';
					break;
				case 2:
					$message = 'register_manual_verify';
					$locationmessage = 'register_manual_verify_location';
					break;
				default:
					$message = 'register_succeed';
					$locationmessage = 'register_succeed_location';
					break;
			}
		}

		encodeData($returnData);
	}

}
?>
