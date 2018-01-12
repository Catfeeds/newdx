<?php
/**
 * 新版设置处理页面
 **/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/spacecp');

$acs = array('savedata', 'password_save', 'question_save', 'getcity', 'resend', 'changemail', 'filter_cancel', 'privacy_save', 'sendtelcode', 'sendtelcodeold', 'bindtel', 'unbindtel', 'unbindtelold', 'sendtelcode2');

$ac = (empty($_G['gp_ac']) || !in_array($_G['gp_ac'], $acs)) ? '' : $_G['gp_ac'];

if(empty($_G['uid'])) {
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		dsetcookie('_refer', rawurlencode($_SERVER['REQUEST_URI']));
	} else {
		dsetcookie('_refer', rawurlencode('home.php?mod=setting'));
	}
	showmessage('to_login', '', array(), array('showmsg' => true, 'login' => 1));
}

$space = getspace($_G['uid']);
if(empty($space)) {
	showmessage('space_does_not_exist');
}
space_merge($space, 'field_home');

if(($space['status'] == -1 || in_array($space['groupid'], array(4, 5, 6)))) {
	showmessage('space_has_been_locked');
}

$navtitle = '用户设置';

if($ac == 'savedata' && submitcheck('dosave')){
	//更新个人信息
	$profile = $_POST['profile'];
	$member = $_POST['member'];
	DB::update('common_member_profile', $profile, array('uid'=>$_G['uid']));
	DB::update('common_member', $member, array('uid'=>$_G['uid']));

	//更新隐私设置
	$space['privacy']['view'] = array();
	$viewtype = array('index', 'friend', 'wall', 'doing', 'blog', 'album', 'share', 'home', 'videoviewphoto', 'videofriend', 'videopoke', 'videowall', 'videocomment');
	foreach ($_POST['privacy']['view'] as $key => $value) {
		if(in_array($key, $viewtype)) {
			$space['privacy']['view'][$key] = intval($value);
		}
	}

	$space['privacy']['feed'] = array();
	if(isset($_POST['privacy']['feed'])) {
		foreach ($_POST['privacy']['feed'] as $key => $value) {
			$space['privacy']['feed'][$key] = 1;
		}
	}
	/*动态屏蔽
	$space['privacy']['filter_icon'] = array();
	if(isset($_POST['privacy']['filter_icon'])) {
		foreach($_POST['privacy']['filter_icon'] as $key => $value) {
			$space['privacy']['filter_icon'][$key] = 1;
		}
	}
	*/
	$space['privacy']['filter_gid'] = array();
	if(isset($_POST['privacy']['filter_gid'])) {
		foreach ($_POST['privacy']['filter_gid'] as $key => $value) {
			$space['privacy']['filter_gid'][$key] = intval($value);
		}
	}
	/*通知屏蔽
	$space['privacy']['filter_note'] = array();
	if(isset($_POST['privacy']['filter_note'])) {
		foreach ($_POST['privacy']['filter_note'] as $key => $value) {
			$space['privacy']['filter_note'][$key] = 1;
		}
	}*/
	privacy_update();
	require_once libfile('function/friend');
	refresh_feed_users($_G['uid']);
	//更新隐私设置 END
	showmessage('保存成功', 'home-setting.html');
}
//重发邮件
if($ac == 'resend'){
	$resend = getcookie('resendemail');
	$resend = empty($resend) ? true : (TIMESTAMP - $resend) > 300;
	if ($resend) {
		//重新发送邮箱验证
		$toemail = $space['newemail'] ? $space['newemail'] : $space['email'];
		emailcheck_send($space['uid'], $toemail);
		dsetcookie('resendemail', TIMESTAMP);
		echo 1;
		exit;
	}else{
		exit(0);	//已经发送，请勿频繁发
	}
}
//修改Email，修改之后需要重新验证
if($ac == 'changemail' && submitcheck('dosave')){
	if(empty($_G['gp_oldpassword'])) { echo -2; exit; }
	if($_G['gp_oldemail'] == $_G['gp_email']) { echo -3; exit; }

	loaducenter();
	$ucresult = uc_user_edit($_G['username'], $_G['gp_oldpassword'], '', $_G['gp_email'], 0);
	if($ucresult != 1) { echo $ucresult; exit; }
	//修改后将论坛中邮箱置为未验证状态
	$member['emailstatus'] = 0;
	$member['email'] = $_G['gp_email'];
	DB::update('common_member', $member, array('uid'=>$_G['uid']));
	//发验证邮件
	emailcheck_send($space['uid'], $_G['gp_email']);
	echo 1; exit;
}
//AJAX取消动态/通知屏蔽
if($ac == 'filter_cancel'){
	if(empty($_G['gp_privacy_type']) || empty($_G['gp_privacy_str'])) {exit();}
	if($_G['gp_privacy_type']=='filter_icon') {
		unset($space['privacy']['filter_icon'][$_G[gp_privacy_str]]);
	}elseif($_G['gp_privacy_type']=='filter_note') {
		unset($space['privacy']['filter_note'][$_G[gp_privacy_str]]);
	}
	privacy_update();
	require_once libfile('function/friend');
	refresh_feed_users($_G['uid']);
	echo 1;	exit;
}
//保存保密设置
if($ac == 'privacy_save' && submitcheck('dosave')) {
	$viewtype = array('realname','residecity','mobile','qq','address','gender','idcard','zodiac','constellation','field1','field2');
	foreach ($_POST['privacy']['profile'] as $key => $value) {
		if(in_array($key, $viewtype)) {
			$space['privacy']['profile'][$key] = intval($value);
		}
	}
	privacy_update();
	require_once libfile('function/friend');
	refresh_feed_users($_G['uid']);
	echo 1; exit;
	//showmessage('保存成功', 'home-setting.html');
}
//修改密码 uc_user_edit参数顺序:用户名,旧密码,新密码,email,是否忽略密码,问题id,答案
if($ac == 'password_save' && submitcheck('dosave')) {
	if(empty($_G['gp_oldpassword'])) { echo -2; exit; }
	if($_G['gp_newpassword'] != $_G['gp_newpassword2']) { echo -3; exit; }
	$pwlen = strlen($_G['gp_newpassword']);
	if ($pwlen < 6 || $pwlen > 16 || preg_match('/^\d*$/', $_G['gp_newpassword'])) {
		echo -5; exit;
	}
	if(!empty($_G['gp_newpassword']) && $_G['gp_newpassword'] == addslashes($_G['gp_newpassword'])){
		loaducenter();
		$ucresult = uc_user_edit($_G['username'], $_G['gp_oldpassword'], $_G['gp_newpassword']);
		echo $ucresult; exit;
	}else{
		echo -4; exit;	//密码包含非法字符
	}
}
//修改保密问题
if($ac == 'question_save' && submitcheck('dosave')) {
	if(empty($_G['gp_oldpassword'])) { echo -2; exit; }
	if(isset($_G['gp_questionidnew'])) {
		if($_G['gp_questionidnew']>0 && empty($_G['gp_answernew'])) { echo -3; exit; }
		if(empty($_G['gp_questionidnew'])) { $_G['gp_answernew'] == ''; }
		loaducenter();
		$ucresult = uc_user_edit($_G['username'], $_G['gp_oldpassword'], '','',0,$_G['gp_questionidnew'],diconv($_G['gp_answernew'],'UTF-8','GBK'));
		echo $ucresult; exit;
	}
}
//获取短信验证码
if($ac == 'sendtelcode' && submitcheck('dosave')) {
	if(empty($_G['gp_telphone'])) { echo -1; exit; }
	if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/", $_G['gp_telphone'])) { echo -2; exit;}

    //检查该手机号是否绑定过账号
    $telcheck = DB::result_first('SELECT count(*) FROM '.DB::table('common_member')." WHERE telephone = '$_G[gp_telphone]'");
    if($telcheck) { echo -10; exit; }

	if(empty($_G['gp_geetest_challenge']) || empty($_G['gp_geetest_validate']) || empty($_G['gp_geetest_seccode'])) {
		echo -3; exit;
	} else {
		//校验滑动验证码，运营商要求，防批量垃圾短信
		$gt_test = array('geetest_challenge' => $_G['gp_geetest_challenge'], 'geetest_validate' => $_G['gp_geetest_validate'], 'geetest_seccode' => $_G['gp_geetest_seccode']);
		if(!check_geetest($gt_test)) {
			echo -4; exit;
		}
	}

	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);

	$sendcode_count = $redis->obj->get("bbsbindtel_count_".$_G['uid']);
	if($sendcode_count > 5) {
		echo -7; exit; //发送过于频繁
	}

	$telcode = mt_rand(1000, 9999);
	$redis->obj->set("bbsbindtel_".$_G['uid'], $_G['gp_telphone'].$telcode, 1200);

	require_once libfile('class/sms');
	$sms = new sms;

	$msg_data['mobile'] = $_G['gp_telphone'];
	$msg_data['text'] = "您的验证码是 {$telcode}，20分钟内有效，如非本人发送，请忽视";
	$sms_result = $sms->send($msg_data);
	if($sms_result['httpcode'] == 200) {
		if($sms_result['data']['code'] == 0) {
			$redis->obj->incr("bbsbindtel_count_".$_G['uid']);
			$redis->obj->expire("bbsbindtel_count_".$_G['uid'], 43200);

			$logs_msg = "pc|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('sendtelcode');
			$logs->log_str($logs_msg);

			echo 1; exit;
		}else{
			$logs_msg = "pc|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('sendtelcode');
			$logs->log_str($logs_msg);

			if($sms_result['data']['code'] == 33) {
				echo -8; exit;
			} else if($sms_result['data']['code'] == 22) {
				echo -9; exit;
			} else {
				echo -5; exit;
			}
		}
	}else{
		$logs_msg = "pc|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
		require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
		$logs = new logs('sendtelcode');
		$logs->log_str($logs_msg);
		echo -6; exit;
	}
}

//校验手机验证码
if($ac == 'bindtel' && submitcheck('dosave')) {
	if(empty($_G['gp_telphone'])) { echo -1; exit; }
	if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/", $_G['gp_telphone'])) { echo -2; exit;}
	if(empty($_G['gp_telcode'])) { echo -3; exit; }

	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);

	$codelog = $redis->obj->get("bbsbindtel_".$_G['uid']);
	$waittest = $_G['gp_telphone'].$_G['gp_telcode'];
	if($waittest != $codelog) { echo -4; exit; }
	//检查该手机号是否绑定过账号
	$telcheck = DB::result_first('SELECT count(*) FROM '.DB::table('common_member')." WHERE telephone = '$_G[gp_telphone]'");
	if($telcheck) { echo -5; exit; }

	DB::query('UPDATE '.DB::table('common_member')." SET telephone='$_G[gp_telphone]', telstatus=1 WHERE uid='$_G[uid]'");
	echo 1;exit;
}

//解绑发短信验证码
if($ac == 'sendtelcodeold' && submitcheck('dosave')) {
	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);

	$sendcode_count = $redis->obj->get("bbsbindtel_count_".$_G['uid']);
	if($sendcode_count > 5) {
		echo -7; exit; //发送过于频繁
	}

	$telcode = mt_rand(1000, 9999);
	$telephone = DB::result_first('SELECT telephone FROM '.DB::table('common_member')." WHERE uid = '$_G[uid]'");

	$redis->obj->set("bbsbindtelold_".$_G['uid'], $telephone.$telcode, 1200);

	require_once libfile('class/sms');
	$sms = new sms;

	$msg_data['mobile'] = $telephone;
	$msg_data['text'] = "您的验证码是 {$telcode}，20分钟内有效，如非本人发送，请忽视";
	$sms_result = $sms->send($msg_data);
	if($sms_result['httpcode'] == 200) {
		if($sms_result['data']['code'] == 0) {
			$redis->obj->incr("bbsbindtel_count_".$_G['uid']);
			$redis->obj->expire("bbsbindtel_count_".$_G['uid'], 43200);

			$logs_msg = "pc|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('sendtelcode');
			$logs->log_str($logs_msg);

			echo 1; exit;
		}else{
			$logs_msg = "pc|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('sendtelcode');
			$logs->log_str($logs_msg);

			if($sms_result['data']['code'] == 33) {
				echo -8; exit;
			} else if($sms_result['data']['code'] == 22) {
				echo -9; exit;
			} else {
				echo -5; exit;
			}
		}
	}else{
		$logs_msg = "pc|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
		require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
		$logs = new logs('sendtelcode');
		$logs->log_str($logs_msg);
		echo -6; exit;
	}
}
//校验旧手机验证码
if($ac == 'unbindtelold' && submitcheck('dosave')) {

	if(empty($_G['gp_telcode'])) { echo -3; exit; }
	$telephone = DB::result_first('SELECT telephone FROM '.DB::table('common_member')." WHERE uid = '$_G[uid]'");

	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);

	$codelog = $redis->obj->get("bbsbindtelold_".$_G['uid']);
	$waittest = $telephone.$_G['gp_telcode'];

	if($waittest != $codelog) { echo -4; exit; }

	echo 1;exit;
}
//校验手机验证码
if($ac == 'unbindtel' && submitcheck('dosave')) {
	if(empty($_G['gp_telphone'])) { echo -1; exit; }
	if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/", $_G['gp_telphone'])) { echo -2; exit;}
	if(empty($_G['gp_telcode'])) { echo -3; exit; }
	if(empty($_G['gp_telcodeold'])) { echo -4; exit; }

	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);

	//校验旧手机验证码
	$telephone = DB::result_first('SELECT telephone FROM '.DB::table('common_member')." WHERE uid = '$_G[uid]'");

	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);

	$codelog = $redis->obj->get("bbsbindtelold_".$_G['uid']);
	$waittest = $telephone.$_G['gp_telcodeold'];

	if($waittest != $codelog) { echo -5; exit; }
	//校验新手机验证码
	$codelog2 = $redis->obj->get("bbsbindtel_".$_G['uid']);
	$waittest2 = $_G['gp_telphone'].$_G['gp_telcode'];
	if($waittest2 != $codelog2) { echo -6; exit; }
	//检查该手机号是否绑定过账号
	$telcheck = DB::result_first('SELECT count(*) FROM '.DB::table('common_member')." WHERE telephone = '$_G[gp_telphone]'");
	if($telcheck) { echo -7; exit; }

	DB::query('UPDATE '.DB::table('common_member')." SET telephone='$_G[gp_telphone]', telstatus=1 WHERE uid='$_G[uid]'");
	echo 1;exit;
}
//获取短信验证码
if($ac == 'sendtelcode2' && submitcheck('dosave')) {
	if(empty($_G['gp_telphone'])) { echo -1; exit; }
	if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/", $_G['gp_telphone'])) { echo -2; exit;}

	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);

	$sendcode_count = $redis->obj->get("bbsbindtel_count_".$_G['uid']);
	if($sendcode_count > 5) {
		echo -7; exit; //发送过于频繁
	}
	$telcode = mt_rand(1000, 9999);
	$redis->obj->set("bbsbindtel_".$_G['uid'], $_G['gp_telphone'].$telcode, 1200);

	require_once libfile('class/sms');
	$sms = new sms;

	$msg_data['mobile'] = $_G['gp_telphone'];
	$msg_data['text'] = "您的验证码是 {$telcode}，20分钟内有效，如非本人发送，请忽视";
	$sms_result = $sms->send($msg_data);
	if($sms_result['httpcode'] == 200) {
		if($sms_result['data']['code'] == 0) {
			$redis->obj->incr("bbsbindtel_count_".$_G['uid']);
			$redis->obj->expire("bbsbindtel_count_".$_G['uid'], 43200);

			$logs_msg = "pc|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('sendtelcode');
			$logs->log_str($logs_msg);

			echo 1; exit;
		}else{
			$logs_msg = "pc|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('sendtelcode');
			$logs->log_str($logs_msg);

			if($sms_result['data']['code'] == 33) {
				echo -8; exit;
			} else {
				echo -5; exit;
			}
		}
	}else{
		$logs_msg = "pc|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
		require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
		$logs = new logs('sendtelcode');
		$logs->log_str($logs_msg);
		echo -6; exit;
	}
}
//获取地区信息，只取到二级，由于样式等问题，无法使用原系统的地区获取方法
function getprovince($province_name){
	$province_html = '<select name="profile[resideprovince]" id="province" class="city pull-left" onchange="changecity(this.value);"><option value="">省份</option>';
	$query = DB::query('SELECT * FROM '.DB::table('common_district')." WHERE level = 1 ORDER BY id ASC");
	while($row = DB::fetch($query)) {
		$province_html .= '<option value="'.$row['name'].'"'.($row['name']==$province_name ? ' selected="selected"' : '').'>'.$row['name'].'</option>';
	}
	$province_html .= '</select>';
	return $province_html;
}

function getcity($city_name, $province_name){
	$city_html = '<select name="profile[residecity]" id="city" class="city pull-right"><option value="">城市</option>';
	if($province_name){
		$province_id = DB::result_first("SELECT id FROM ".DB::table('common_district')." WHERE name = '$province_name' AND upid=0" . getSlaveID());
	}elseif($city_name){
		$province_id = DB::result_first("SELECT upid FROM ".DB::table('common_district')." WHERE name = '$city_name' AND upid>0" . getSlaveID());
	}else{
		return $city_html .= '</select>';
	}
	$sql = 'SELECT * FROM '.DB::table('common_district').' WHERE level = 2';
	if($province_id){
		$sql .= " AND upid = '$province_id'";
	}
	$sql .= ' ORDER BY id ASC' . getSlaveID();
	$query = DB::query($sql);
	while($row = DB::fetch($query)) {
		$city_html .= '<option value="'.$row['name'].'"'.($row['name']==$city_name ? ' selected="selected"' : '').'>'.$row['name'].'</option>';
	}
	$city_html .= '</select>';
	return $city_html;
}
//AJAX获取地区select
if($ac == 'getcity' && !empty($_G['gp_province'])){
	@header( 'Content-Type: text/html; charset=gbk' );
	echo getcity('', diconv($_G['gp_province'],'UTF-8','GBK'));
	exit;
}
//修改头像
if($ac == 'avatar'){
	if(submitcheck('avatarsubmit')) {
		showmessage('do_success', 'cp.php?ac=avatar&quickforward=1');
	}
}

//用户头像
loaducenter();
$uc_avatarflash = uc_avatar($_G['uid'], 'virtual', 0);
/*
 * 用户如果上传了头像，则在m表更改头像状态
 * 本地测试时，检测头像文件是否存在会比较慢。如线上发生同样情况，可以将此段暂时注释掉
 */
if(empty($space['avatarstatus']) && uc_check_avatar($_G['uid'], 'middle')) {
	DB::update('common_member', array('avatarstatus'=>'1'), array('uid'=>$_G['uid']));
	updatecreditbyaction('setavatar');
	if($_G['setting']['my_app_status']) manyoulog('user', $_G['uid'], 'update');
}

//用户头像 END
//个人信息
$profile_info = DB::fetch_first("SELECT realname, gender, resideprovince, residecity, mobile, idcard, address, qq, field1 AS used_email, field2 AS used_mobile FROM ".DB::table('common_member_profile')." WHERE uid='$_G[uid]'" . getSlaveID());

$province_html = getprovince($profile_info['resideprovince']);
$city_html = getcity($profile_info['residecity'],$profile_info['resideprovince']);
//获取用户是否设置安全提问
$secques_status = uc_user_checksecques($_G['uid']);

//filter显示处理 BEGIN
/*require_once libfile('function/friend');
$groups = friend_group_list();*/

$filter_icons = empty($space['privacy']['filter_icon'])?array():$space['privacy']['filter_icon'];
$filter_note = empty($space['privacy']['filter_note'])?array():$space['privacy']['filter_note'];
$iconnames = $appids = $icons = $uids = $users = array();
foreach ($filter_icons as $key => $value) {
	list($icon, $uid) = explode('|', $key);
	$icons[$key] = $icon;
	$uids[$key] = $uid;
	if(is_numeric($icon)) {
		$appids[$key] = $icon;
	}
}
foreach ($filter_note as $key => $value) {
	list($type, $uid) = explode('|', $key);
	$types[$key] = $type;
	$uids[$key] = $uid;
	if(is_numeric($type)) {
		$appids[$key] = $type;
	}
}
if($uids) {
	$query = DB::query("SELECT uid, username FROM ".DB::table('common_member')." WHERE uid IN (".dimplode($uids).")" . getSlaveID());
	while ($value = DB::fetch($query)) {
		$users[$value['uid']] = $value['username'];
	}
}
if($appids) {
	$query = DB::query("SELECT appid, appname FROM ".DB::table('common_myapp')." WHERE appid IN (".dimplode($appids).")" . getSlaveID());
	while ($value = DB::fetch($query)) {
		$iconnames[$value['appid']] = $value['appname'];
	}
}

//filter END

//处理隐私设置数据
$sels = array();
if($space['privacy']['view']) {
	foreach ($space['privacy']['view'] as $key => $value) {
		$sels['view'][$key] = array($value => ' selected');
	}
}
if($space['privacy']['feed']) {
	foreach ($space['privacy']['feed'] as $key => $value) {
		$sels['feed'][$key] = ' checked';
	}
}
//隐私设置 END

include template('home/spacecp_setting');
?>
