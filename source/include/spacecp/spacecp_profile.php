<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: spacecp_profile.php 23747 2011-08-09 03:10:08Z zhengqingpeng $
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$tt = $_GET['t'];
$operation = in_array($_GET['op'], array(
	'base',
	'contact',
	'edu',
	'work',
	'info',
	'bbs',
	'password',
	'verify',
	'identity')) ? trim($_GET['op']) : 'base';
$space = getspace($_G['uid']);
space_merge($space, 'field_home');
space_merge($space, 'profile');
//note 发帖时是否显示验证码或者验证问答
$seccodecheck = $_G['setting']['seccodestatus'] & 8;
$secqaacheck = $_G['setting']['secqaa']['status'] & 4;
$_G['group']['seccode'] = 1;
@include_once DISCUZ_ROOT.'./data/cache/cache_domain.php';
$spacedomain = isset($rootdomain['home']) && $rootdomain['home'] ? $rootdomain['home'] : array();
if ($operation != 'password') {
	include_once libfile('function/profile');
	// 获取 profile setting
	loadcache('profilesetting');
	if (empty($_G['cache']['profilesetting'])) {
		require_once libfile('function/cache');
		updatecache('profilesetting');
		loadcache('profilesetting');
	}
}
// 是否允许自定义个人头衔
$allowcstatus = ! empty($_G['group']['allowcstatus']) ? true : false;
$verify = DB::fetch_first("SELECT * FROM ".DB::table("common_member_verify")." WHERE uid='$_G[uid]'");
$validate = array();
if ($_G['setting']['regverify'] == 2 && $_G['groupid'] == 8) {
	$validate = DB::fetch_first("SELECT * FROM ".DB::table('common_member_validate')." WHERE uid='$_G[uid]' AND status='1'");
}
$conisregister = $operation == 'password' && $_G['setting']['connect']['allow'] && DB::result_first("SELECT conisregister FROM ".DB::table('common_member_connect')." WHERE uid='$_G[uid]'");
// 120409 wistar ajax方式修改身份
if ($_G['gp_req_type'] == 'ajax') {
	// 添加主身份，无需申请
	if ($_G['gp_op'] == 'add_identity') {
		// 如果没有identity_id则直接退出ajax
		$_G['gp_iid'] || exit;
		// 如果用户扩展信息表无此用户数据则执行插入
		$arr_userext = DB::fetch_first('SELECT * FROM '.DB::table('plugin_userext')." WHERE uid='{$_G['uid']}'");
		$arr_userext || DB::insert('plugin_userext', array(
			'uid' => $_G['uid'],
			'username' => $_G['username'],
			'type' => 1,
			'description' => '',
			'sort' => 255,
			'createtime' => time()));
		// 如果该用户已存在此身份则直接退出ajax
		$arr_user_identitys = DB::fetch_first('SELECT id FROM '.DB::table('plugin_user_identitys')." WHERE uid='{$_G['uid']}' AND identity_id='{$_G['gp_iid']}' AND detail_id='0'");
		$arr_user_identitys && exit;
		// 全部判定条件无误则向用户身份表插入该条主身份
		DB::insert('plugin_user_identitys', array(
			'uid' => $_G['uid'],
			'identity_id' => $_G['gp_iid'],
			'detail_id' => '0',
			'createtime' => time()));
		echo "{\"status\":\"success\"}";
	} else
		if ($_G['gp_op'] == 'app_detail') {
			// 申请子身份，如果没有identity_id和detail_id则直接退出
			if (! $_G['gp_iid'] || ! $_G['gp_idd']) {
				exit;
			}
			//		$str_appreason = unescape($_G['gp_app_reason']);
			$str_appreason = iconv('utf-8', 'gbk', $_G['gp_app_reason']);
			//		// 如果用户扩展信息表无此用户数据则执行插入
			//		$arr_userext = DB::fetch_first('SELECT * FROM ' . DB::table('plugin_userext') . " WHERE uid='{$_G['uid']}'");
			//		$arr_userext || DB::insert('plugin_userext', array('uid' => $_G['uid'], 'username' => $_G['username'], 'type' => 1, 'description' => '', 'sort' => 255, 'createtime' => time()));
			// 查询当前申请的身份是否已申请正在等待审核，如果有则直接退出ajax
			$user_appid = DB::result_first('SELECT id FROM '.DB::table('plugin_user_apply_identity')." WHERE uid='{$_G['uid']}' AND detail_id='{$_G['gp_idd']}' AND status='1'");
			$user_appid && exit;
			// 如果已拒绝，用户没有点击‘知道了’而继续申请，则将status置为0：拒绝过
			$user_appid = DB::result_first('SELECT id FROM '.DB::table('plugin_user_apply_identity')." WHERE uid='{$_G['uid']}' AND detail_id='{$_G['gp_idd']}' AND status='3'");
			if ($user_appid) {
				DB::update('plugin_user_apply_identity', array('status' => 0), array('id' => $_G['gp_idd']));
			}
			DB::insert('plugin_user_apply_identity', array(
				'uid' => $_G['uid'],
				'identity_id' => $_G['gp_iid'],
				'detail_id' => $_G['gp_idd'],
				'status' => '1',
				'app_reason' => $str_appreason,
				'apptime' => time()));
			echo "{\"status\":\"success\"}";
		} else
			if ($_G['gp_op'] == 'cancel_tip') {
				if (! $_G['gp_app_id']) {
					exit;
				}
				DB::update('plugin_user_apply_identity', array('status' => 0), array('id' => $_G['gp_app_id']));
				echo "{\"status\":\"success\"}";
			} else {
				exit;
			}
			exit;
} else
	if ($_G['gp_req_type'] == 'ajax_submit') {
		//	$user_appid = DB::result_first('SELECT id FROM ' . DB::table('plugin_user_apply') . " WHERE uid='{$_G['uid']}' AND type='identity' AND status='1'");
		//	if ($user_appid) {
		//		echo "{\"status\":\"err\", \"err_msg\":\"您提交的申请正在审核中，请等待...\"}";
		//		exit;
		//	}
		//	$int_appid = DB::insert('plugin_user_apply', array('uid' => $_G['uid'], 'type' => 'identity', 'status' => '1', 'apptime' =>time()), true);
		//	$arr_detail = $_G['gp_chk_detail'];
		//	if (!$arr_detail) {
		//		exit;
		//	} else {
		//		foreach ($arr_detail as $key => $value) {
		//			foreach ($value as $k => $v) {
		//				DB::insert('plugin_user_apply_identity', array('apply_id' => $int_appid, 'identity_id' => $key, 'detail_id' => $k));
		//			}
		//		}
		//		echo "{\"status\":\"success\"}";
		//	}
		include template("home/spacecp_profile");
		exit;
	}
/**
 * 获取身份id
 *
 * @author wistar 120410
 * @global array $_G
 * @return type
 */
//function get_ids() {
//	global $_G;
//	$str_sql_identitys = 'SELECT * FROM ' . DB::table('plugin_user_identitys') . " WHERE uid='{$_G['uid']}'";
//	$res_identitys = DB::query($str_sql_identitys);
//	while ($identitys = DB::fetch($res_identitys)) {
//		$arr_identity_ids[] = $identitys['identity_id'];
//		$identitys['detail_id'] && $arr_detail_ids[] = $identitys['detail_id'];
//	}
//	$str_iids = implode(',', array_unique($arr_identity_ids));
//	$str_idds = implode(',', $arr_detail_ids);
//	return array('iids' => $str_iids ? $str_iids : '', 'idds' => $str_idds ? $str_idds : '');
//}
if (submitcheck('profilesubmit')) { // 更新用户资料
	require_once libfile('function/discuzcode');
	$forum = $setarr = $verifyarr = $errorarr = array();
	$forumfield = array('customstatus', 'sightml');
	if (! class_exists('discuz_censor')) {
		include libfile('class/censor');
	}
	$censor = discuz_censor::instance();
	//取认证的资料
	if ($_G['gp_vid']) {
		$vid = intval($_G['gp_vid']);
		$verifyconfig = $_G['setting']['verify'][$vid];
		if ($verifyconfig['available']) {
			//取出未通过的记录
			$verifyinfo = DB::fetch_first("SELECT * FROM ".DB::table("common_member_verify_info")." WHERE uid='$_G[uid]' AND verifytype='$vid'");
			if (! empty($verifyinfo)) {
				$verifyinfo['field'] = unserialize($verifyinfo['field']);
			}
			foreach ($verifyconfig['field'] as $key => $field) {
				if (! isset($verifyinfo['field'][$key])) {
					$verifyinfo['field'][$key] = $key;
				}
			}
		} else {
			$vid = 0;
		}
	}
	//特殊处理,当有提交省级变更
	if (! empty($_POST['birthprovince'])) {
		$initcity = array(
			'birthprovince',
			'birthcity',
			'birthdist',
			'birthcommunity');
		foreach ($initcity as $key) {
			$_POST[$key] = ! empty($_POST[$key]) ? $_POST[$key] : '';
		}
	}
	if (! empty($_POST['resideprovince'])) {
		$initcity = array(
			'resideprovince',
			'residecity',
			'residedist',
			'residecommunity');
		foreach ($initcity as $key) {
			$_POST[$key] = ! empty($_POST[$key]) ? $_POST[$key] : '';
		}
	}
	foreach ($_POST as $key => $value) {
		$field = $_G['cache']['profilesetting'][$key];
		if (in_array($key, $forumfield)) { // 论坛项
			$censor->check($value);
			if ($censor->modbanned()) {
				profile_showerror($key, lang('spacecp', 'profile_censor'));
			}
			if ($key == 'sightml') {
				loadcache(array('smilies', 'smileytypes'));
				//截取签名长度
				$value = cutstr($value, $_G['group']['maxsigsize'], '');
				foreach ($_G['cache']['smilies']['replacearray'] as $skey => $smiley) {
					$_G['cache']['smilies']['replacearray'][$skey] = '[img]'.$_G['siteurl'].'static/image/smiley/'.$_G['cache']['smileytypes'][$_G['cache']['smilies']['typearray'][$skey]]['directory'].'/'.$smiley.'[/img]';
				}
				$value = preg_replace($_G['cache']['smilies']['searcharray'], $_G['cache']['smilies']['replacearray'], trim($value));
				$forum[$key] = addslashes(discuzcode(stripslashes($value), 1, 0, 0, 0, $_G['group']['allowsigbbcode'], $_G['group']['allowsigimgcode'], 0, 0, 1));
			} elseif ($key == 'customstatus' && $allowcstatus) { // 个人头衔
				$forum[$key] = dhtmlspecialchars(trim($value));
			}
			continue;
		} elseif ($field && ! $field['available']) { //未启用的资料项
			continue;
		} elseif ($key == 'timeoffset') {
			DB::update('common_member', array('timeoffset' => intval($value)), array('uid' => $_G['uid']));
		}
		//处理file类型的字段
		if ($field['formtype'] == 'file') {
			if ((! empty($_FILES[$key]) && $_FILES[$key]['error'] == 0) || (! empty($space[$key]) && empty($_G['gp_deletefile'][$key]))) {
				$value = '1';
			} else {
				$value = '';
			}
		}
		if (empty($field)) { //非资料项数据
			continue;
		} elseif (profile_check($key, $value, $space)) { //有效数据
			// 检查敏感词
			$censor->check($value);
			if ($censor->modbanned()) {
				profile_showerror($key, lang('spacecp', 'profile_censor'));
			}
			$setarr[$key] = dhtmlspecialchars(trim($value));
		} else { // 有误
			if ($key == 'birthprovince') {
				$key = 'birthcity';
			} elseif ($key == 'resideprovince' || $key == 'residecommunity' || $key == 'residedist') {
				$key = 'residecity';
			} elseif ($key == 'birthyear' || $key == 'birthmonth') {
				$key = 'birthday';
			}
			profile_showerror($key);
		}
		//删除文件类型的内容
		if ($field['formtype'] == 'file') {
			unset($setarr[$key]);
		}
		//判断是否为认证数据
		if ($vid && $verifyconfig['available'] && isset($verifyconfig['field'][$key])) {
			if (isset($verifyinfo['field'][$key]) && $setarr[$key] !== $space[$key]) {
				$verifyarr[$key] = $setarr[$key];
			}
			unset($setarr[$key]);
		}
		// 该项合法但需要审核
		if (isset($setarr[$key]) && $_G['cache']['profilesetting'][$key]['needverify']) {
			if ($setarr[$key] !== $space[$key]) {
				$verifyarr[$key] = $setarr[$key];
			}
			unset($setarr[$key]);
		}
	}
	//note 删除图片
	if ($_G['gp_deletefile'] && is_array($_G['gp_deletefile'])) {
		foreach ($_G['gp_deletefile'] as $key => $value) {
			@unlink(getglobal('setting/attachdir').'./profile/'.$space[$key]);
			@unlink(getglobal('setting/attachdir').'./profile/'.$verifyinfo['field'][$key]);
			$verifyarr[$key] = $setarr[$key] = '';
		}
	}
	if ($_FILES) {
		require_once libfile('class/upload');
		$upload = new discuz_upload();
		foreach ($_FILES as $key => $file) {
			$upload->init($file, 'profile');
			$attach = $upload->attach;
			if (! $upload->error()) {
				$upload->save();
				//验证写入的文件是否是图片，不是删除
				if (! $upload->get_image_info($attach['target'])) {
					@unlink($attach['target']);
					continue;
				}
				$setarr[$key] = '';
				$attach['attachment'] = dhtmlspecialchars(trim($attach['attachment']));
				//判断是否为认证数据
				if ($vid && $verifyconfig['available'] && isset($verifyconfig['field'][$key])) {
					if (isset($verifyinfo['field'][$key])) {
						@unlink(getglobal('setting/attachdir').'./profile/'.$verifyinfo['field'][$key]);
						$verifyarr[$key] = $attach['attachment'];
					}
					continue;
				}
				// 该项合法但需要审核
				if (isset($setarr[$key]) && $_G['cache']['profilesetting'][$key]['needverify']) {
					@unlink(getglobal('setting/attachdir').'./profile/'.$verifyinfo['field'][$key]);
					$verifyarr[$key] = $attach['attachment'];
					continue;
				}
				//删除原图片
				@unlink(getglobal('setting/attachdir').'./profile/'.$space[$key]);
				$setarr[$key] = $attach['attachment'];
			}
		}
	}
	//如果图片保持默认，将值复制回审核资料中
	if ($vid && ! empty($verifyinfo['field']) && is_array($verifyinfo['field'])) {
		foreach ($verifyinfo['field'] as $key => $fvalue) {
			if (empty($verifyarr[$key]) && ! isset($verifyarr[$key]) && isset($verifyinfo['field'][$key])) {
				$verifyarr[$key] = ! empty($fvalue) && $key != $fvalue ? $fvalue : $space[$key];
			}
		}
	}
	if ($forum) {
		//关闭签名清空签名内容
		if (! $_G['group']['maxsigsize']) {
			$forum['sightml'] = '';
		}
		DB::update('common_member_field_forum', $forum, array('uid' => $_G['uid']));
	}
	if (isset($_POST['birthmonth']) && ($space['birthmonth'] != $_POST['birthmonth'] || $space['birthday'] != $_POST['birthday'])) { //计算星座
		$setarr['constellation'] = get_constellation($_POST['birthmonth'], $_POST['birthday']);
	}
	if (isset($_POST['birthyear']) && $space['birthyear'] != $_POST['birthyear']) { // 计算生肖
		$setarr['zodiac'] = get_zodiac($_POST['birthyear']);
	}
	// 直接修改
	if ($setarr) {
		DB::update('common_member_profile', $setarr, array('uid' => $_G['uid']));
		//start记录用户修改资料
		addrecorduserinfo($_G['uid'], 2);
		//end
	}
	// 需要审核的字段
	if ($verifyarr) {
		DB::query('DELETE FROM '.DB::table('common_member_verify_info')." WHERE uid='$_G[uid]' AND verifytype='$vid'");
		$setverify = array(
			'uid' => $_G['uid'],
			'username' => $_G['username'],
			'verifytype' => $vid,
			'field' => daddslashes(serialize($verifyarr)),
			'dateline' => $_G['timestamp']);
		DB::insert('common_member_verify_info', $setverify);
		$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('common_member_verify')." WHERE uid='$_G[uid]'"), 0);
		if (! $count) {
			DB::insert('common_member_verify', array('uid' => $_G['uid']));
		}
	}
	// privacy
	if (isset($_POST['privacy'])) {
		foreach ($_POST['privacy'] as $key => $value) {
			if (isset($_G['cache']['profilesetting'][$key])) {
				$space['privacy']['profile'][$key] = intval($value);
			}
		}
		DB::update('common_member_field_home', array('privacy' => addslashes(serialize($space['privacy']))), array('uid' => $space['uid']));
	}
	//变更记录
	if ($_G['setting']['my_app_status'])
		manyoulog('user', $_G['uid'], 'update');
	/* 取消资料更新feed modify by wangqi
	* include_once libfile('function/feed');
	* feed_add('profile', 'feed_profile_update_'.$operation, array('hash_data'=>'profile'));
	*/
	profile_showsuccess();
} elseif (submitcheck('passwordsubmit', 0, $seccodecheck, $secqaacheck)) {
	$membersql = $memberfieldsql = $authstradd1 = $authstradd2 = $newpasswdadd = '';
	$setarr = array();
	$emailnew = dhtmlspecialchars($_G['gp_emailnew']);
	$ignorepassword = 0;
	if ($_G['setting']['connect']['allow'] && DB::result_first("SELECT conisregister FROM ".DB::table('common_member_connect')." WHERE uid='$_G[uid]'")) {
		$_G['gp_oldpassword'] = '';
		$ignorepassword = 1;
		if (empty($_G['gp_newpassword'])) {
			showmessage('profile_passwd_empty');
		}
	}
	if ($_G['gp_questionidnew'] === '') {
		$_G['gp_questionidnew'] = $_G['gp_answernew'] = '';
	} else {
		$secquesnew = $_G['gp_questionidnew'] > 0 ? random(8) : '';
	}
	//note 不在前台判断了，改在后台登录时
	/*
	* if(($_G['adminid'] == 1 || $_G['adminid'] == 2 || $_G['adminid'] == 3) && $_G['config']['admincp']['forcesecques']) {
	* showmessage('profile_admin_security_invalid');
	* }
	*/
	if (! empty($_G['gp_newpassword']) && $_G['gp_newpassword'] != $_G['gp_newpassword2']) {
		showmessage('profile_passwd_notmatch', '', array(), array('return' => true));
	}
	loaducenter();
	$ucresult = uc_user_edit($_G['username'], $_G['gp_oldpassword'], $_G['gp_newpassword'], $emailnew != $_G['member']['email'] ? $emailnew : '', $ignorepassword, $_G['gp_questionidnew'], $_G['gp_answernew']);
	if ($ucresult == -1) {
		showmessage('profile_passwd_wrong', '', array(), array('return' => true));
	} elseif ($ucresult == -4) {
		showmessage('profile_email_illegal', '', array(), array('return' => true));
	} elseif ($ucresult == -5) {
		showmessage('profile_email_domain_illegal', '', array(), array('return' => true));
	} elseif ($ucresult == -6) {
		showmessage('profile_email_duplicate', '', array(), array('return' => true));
	}
	if ($emailnew != $_G['member']['email']) {
		$setarr['email'] = $emailnew;
		$setarr['emailstatus'] = 0;
	}
	if (! empty($_G['gp_newpassword']) || $secquesnew) {
		$setarr['password'] = md5(random(10));
	}
	if ($_G['setting']['connect']['allow']) {
		DB::update('common_member_connect', array('conisregister' => 0), array('uid' => $_G['uid']));
	}
	$authstr = false;
	if ($_G['adminid'] == 0 && $emailnew != $_G['member']['email']) {
		if ($_G['setting']['regverify'] == 1 && (($_G['group']['grouptype'] == 'member' && $_G['adminid'] == 0) || $_G['groupid'] == 8)) {
			$idstring = random(6);
			$setarr['groupid'] = $groupid = 8;
			loadcache('usergroup_8');
			$authstr = true;
			DB::update('common_member_field_forum', array('authstr' => TIMESTAMP."\t2\t".$idstring), array('uid' => $_G['uid']));
			$verifyurl = "{$_G[siteurl]}member.php?mod=activate&amp;uid={$_G[uid]}&amp;id=$idstring";
			$email_verify_message = lang('email', 'email_verify_message', array(
				'username' => $_G['member']['username'],
				'bbname' => $_G['setting']['bbname'],
				'siteurl' => $_G['siteurl'],
				'url' => $verifyurl));
			include_once libfile('function/mail');
			sendmail("{$_G[member][username]} <$emailnew>", lang('email', 'email_verify_subject'), $email_verify_message);
		} else {
			emailcheck_send($space['uid'], $emailnew);
		}
	}
	if ($setarr) {
		DB::update('common_member', $setarr, array('uid' => $_G['uid']));
	}
	if ($authstr) {
		showmessage('profile_email_verify', 'home.php?mod=spacecp&ac=profile&op=password');
	} else {
		showmessage('profile_succeed', 'home.php?mod=spacecp&ac=profile&op=password');
	}
}
if ($operation == 'password') {
	//showmessage('此功能暂时关闭,给您带来不便敬请谅解！', 'home.php?mod=spacecp');
	//exit;
	$resend = getcookie('resendemail');
	$resend = empty($resend) ? true : (TIMESTAMP - $resend) > 300;
	if ($_G['gp_resend'] && $resend) {
		//重新发送邮箱验证
		$toemail = $space['newemail'] ? $space['newemail'] : $space['email'];
		emailcheck_send($space['uid'], $toemail);
		dsetcookie('resendemail', TIMESTAMP);
		showmessage('send_activate_mail_succeed', "home.php?mod=spacecp&ac=profile&op=password");
	} elseif ($_G['gp_resend']) {
		showmessage('send_activate_mail_error', "home.php?mod=spacecp&ac=profile&op=password");
	}
	$actives = array('password' => ' class="a"');
	$navtitle = lang('core', 'title_password_security');
} else {
	space_merge($space, 'field_home');
	space_merge($space, 'field_forum');
	require_once libfile('function/editor');
	$space['sightml'] = html2bbcode($space['sightml']);
	$vid = $_G['gp_vid'] ? intval($_G['gp_vid']) : 0;
	// 隐私
	$privacy = $space['privacy']['profile'] ? $space['privacy']['profile'] : array();
	$_G['setting']['privacy'] = $_G['setting']['privacy'] ? $_G['setting']['privacy'] : array();
	$_G['setting']['privacy'] = is_array($_G['setting']['privacy']) ? $_G['setting']['privacy'] : unserialize($_G['setting']['privacy']);
	$_G['setting']['privacy']['profile'] = ! empty($_G['setting']['privacy']['profile']) ? $_G['setting']['privacy']['profile'] : array();
	$privacy = array_merge($_G['setting']['privacy']['profile'], $privacy);
	$actives = array('profile' => ' class="a"');
	$opactives = array($operation => ' class="a"');
	//归类选项
	$allowitems = array();
	if ($operation == 'base') {
		$allowitems = array(
			'realname',
			'gender',
			'birthday',
			'birthcity',
			'residecity',
			'residedist',
			'affectivestatus',
			'lookingfor',
			'bloodtype',
			'field1',
			'field2',
			'field3',
			'field4',
			'field5',
			'field6',
			'field7',
			'field8');
	} elseif ($operation == 'contact') {
		$allowitems = array(
			'telephone',
			'mobile',
			'alipay',
			'icq',
			'qq',
			'yahoo',
			'msn',
			'taobao');
	} elseif ($operation == 'edu') {
		$allowitems = array('graduateschool', 'education');
	} elseif ($operation == 'work') {
		$allowitems = array(
			'occupation',
			'company',
			'position',
			'revenue');
	} elseif ($operation == 'info') {
		//		$allowitems = array('idcardtype', 'idcard', 'address', 'zipcode', 'nationality', 'residecommunity', 'residesuite', 'height', 'weight', 'site', 'bio', 'interest', 'identity');
		$allowitems = array(
			'idcardtype',
			'idcard',
			'address',
			'zipcode',
			'nationality',
			'residecommunity',
			'residesuite',
			'height',
			'weight',
			'site',
			'bio',
			'interest');
	} elseif ($operation == 'identity') {
		//		$allowitems = array('idcardtype', 'idcard', 'address', 'zipcode', 'nationality', 'residecommunity', 'residesuite', 'height', 'weight', 'site', 'bio', 'interest', 'identity');
		$allowitems = array('identity');
	} elseif ($operation == 'verify') {
		//如果为空默认取一个
		if ($vid == 0) {
			foreach ($_G['setting']['verify'] as $key => $setting) {
				if ($setting['available']) {
					$_G['gp_vid'] = $vid = $key;
					break;
				}
			}
		}
		$actives = array('verify' => ' class="a"');
		$opactives = array($operation.$vid => ' class="a"');
		$allowitems = $_G['setting']['verify'][$vid]['field'];
	}
	$showbtn = ($vid && $verify['verify'.$vid] != 1) || empty($vid);
	//取出认证通过的资料，禁止修改
	if (! empty($verify) && is_array($verify)) {
		foreach ($verify as $key => $flag) {
			if (in_array($key, array(
				'verify1',
				'verify2',
				'verify3',
				'verify4',
				'verify5')) && $flag == 1) {
				$verifyid = intval(substr($key, -1, 1));
				if ($_G['setting']['verify'][$verifyid]['available']) {
					foreach ($_G['setting']['verify'][$verifyid]['field'] as $field) {
						$_G['cache']['profilesetting'][$field]['unchangeable'] = 1;
					}
				}
			}
		}
	}
	//如果是认证页面直接显示提交的值
	if ($vid) {
		$query = DB::query('SELECT field FROM '.DB::table('common_member_verify_info')." WHERE uid='$_G[uid]' AND verifytype='$vid'");
		while ($value = DB::fetch($query)) {
			$field = unserialize($value['field']);
			foreach ($field as $key => $fvalue) {
				$space[$key] = $fvalue;
			}
		}
	}
	$htmls = $settings = array();
	foreach ($allowitems as $fieldid) {
		$html = profile_setting($fieldid, $space, $vid ? false : true);
		if ($html) {
			$settings[$fieldid] = $_G['cache']['profilesetting'][$fieldid];
			$htmls[$fieldid] = $html;
		}
	}
	// 120320 wistar 添加用户身份选项
	if ($_G['gp_op'] == 'identity') {
		$arr_userext = DB::fetch_first('SELECT * FROM '.DB::table('plugin_userext')." WHERE uid='{$_G['uid']}'");
		// 初始默认用户类型为个人用户
		$int_type = 1;
		// 如果查到用户则取出该用户所有身份，否则在userext表中新增用户数据，默认为个人用户
		if ($arr_userext) {
			$int_type = $arr_userext['type'];
			$str_sql_identitys = 'SELECT pui.*, pi.identity_entity, pid.subname FROM '.DB::table('plugin_user_identitys').' pui '.'LEFT JOIN '.DB::table('plugin_identity').' pi on pui.identity_id=pi.id '.'LEFT JOIN '.DB::table('plugin_identity_detail').' pid on pui.detail_id=pid.id '."WHERE uid='{$_G['uid']}' ORDER BY detail_id, identity_id";
			$res_identitys = DB::query($str_sql_identitys);
			$arr_detail_id = array();
			$arr_identity_id = array();
			$arr_identitys = array();
			$str_identitys = '';
			$int_iter = 1;
			while ($identitys = DB::fetch($res_identitys)) {
				if ($identitys['detail_id']) {
					$arr_detail_id[] = $identitys['detail_id'];
					$arr_identitys[] = array('identity_name' => $identitys['subname'], 'iter' => $int_iter);
				} else {
					$arr_identity_id[] = $identitys['identity_id'];
					$arr_identitys[] = array('identity_name' => $identitys['identity_entity'], 'iter' => $int_iter);
				}
				$str_identitys = implode(',', $arr_identity_id);
				$int_iter++;
			}
		} else {
			//			DB::insert('plugin_userext', array('uid' => $_G['uid'], 'username' => $_G['username'], 'type' => 1, 'description' => '', 'sort' => 255, 'createtime' => time()));
		}
		// 获取已申请中和已拒绝两种状态的子身份ID，以区分申请列表中申请按钮的状态
		$res_appid = DB::query('SELECT * FROM '.DB::table('plugin_user_apply_identity')." WHERE uid='{$_G['uid']}' AND (status='1' or status='3')");
		$arr_app = array();
		$arr_app_detail_id = array();
		while ($value = DB::fetch($res_appid)) {
			$arr_app[$value['detail_id']] = $value;
			$arr_app_detail_id[] = $value['detail_id'];
		}
		$str_sql = "SELECT * FROM ".DB::table('plugin_identity')." WHERE type={$int_type} ORDER BY id";
		$res_identity = DB::query($str_sql);
		$arr_identity = array();
		while ($value = DB::fetch($res_identity)) {
			if ($value['id']) {
				$str_sql = "SELECT * FROM ".DB::table('plugin_identity_detail')." WHERE identity_id='{$value['id']}'{$con_idd} ORDER BY id, is_conditions";
				$res_detail = DB::query($str_sql);
				while ($v = DB::fetch($res_detail)) {
					// 判断此身份ID是否为已申请过的身份ID，1：已申请过ID
					if (in_array($v['id'], $arr_detail_id)) {
						$v['identity_status'] = 1;
					} else
						if (in_array($v['id'], $arr_app_detail_id)) {
							// 判断该身份ID是否为申请中或申请已拒绝状态，2：申请中；3：申请拒绝
							if ($arr_app[$v['id']]['status'] == 1) {
								$v['identity_status'] = 2;
							} else
								if ($arr_app[$v['id']]['status'] == 3) {
									$v['identity_status'] = 3;
									$v['app_id'] = $arr_app[$v['id']]['id'];
									$v['deny_reason'] = $arr_app[$v['id']]['deny_reason'];
								}
						} else {
							$v['identity_status'] = 0;
						}
						$v['identity'] = $value;
					$arr_detail[] = $v;
				}
			}
			// 判断此身份ID是否为已申请通过的身份ID，1：已申请过ID
			if (in_array($value['id'], $arr_identity_id)) {
				$value['identity_status'] = 1;
			} else {
				$value['identity_status'] = 0;
			}
			$arr_identity[] = $value;
		}
	}
}
include template("home/spacecp_profile");
function profile_showerror($key, $extrainfo)
{
	echo '<script>';
	echo 'parent.show_error("'.$key.'", "'.$extrainfo.'");';
	echo '</script>';
	exit();
}
function profile_showsuccess()
{
	echo '<script type="text/javascript">';
	echo 'parent.show_success();';
	echo '</script>';
	exit();
}
?>