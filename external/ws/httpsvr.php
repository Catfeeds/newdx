<?php
/**
 * 获取主站数据http
 * 
 * @author rinne 120812
 */

require_once '../../source/class/class_core.php';
require_once '../../source/function/function_forum.php';
$discuz = & discuz_core::instance();
$discuz->init();

define('LVYOUMALL_AUTH', 'lvyoumall_extc');

$auth = empty($_GET['auth']) ? '' : $_GET['auth'];
if (empty($auth) || x_crypt(urldecode($auth)) != LVYOUMALL_AUTH) {
	echo json_encode(array('err_no' => 'auth_err'));
	exit;
}

$act = empty($_GET['act']) ? '' : trim($_GET['act']);
$uid = intval($_GET['uid']) ? $_GET['uid'] : 0;
if (!uid) {
	echo json_encode(array('err_no' => 'uid_err'));
	exit;
}

function x_crypt ($str) {
	$int_len = strlen($str);
	$arr_key = array('8', '2', '6', '4', 'x');
	$key_len = count($arr_key);
	for($i = 0; $i < $int_len; $i++) {
		$str_chr = substr($str, $i, 1);
		$str_str .= chr(ord($str_chr) + $arr_key[$i % $key_len]);
	}
	return $str_str;
}

function iconv_deep($source_lang, $target_lang, $value) {
	if (empty($value)) {
		return $value;
	} else {
		if (is_array($value)) {
			foreach ($value as $k => $v) {
				$value[$k] = iconv_deep($source_lang, $target_lang, $v);
			}
			return $value;
		} elseif (is_string($value)) {
			return iconv($source_lang, $target_lang, $value);
		} else {
			return $value;
		}
	}
}

switch ($act) {
	case 'ges':
		$arr_extcs = DB::fetch_first('SELECT * FROM ' . DB::table('common_member_count') . " WHERE uid='{$uid}'");
		echo json_encode($arr_extcs);
		break;
	case 'ses':
		$extc2 = isset($_GET['extc2']) ? intval($_GET['extc2']) : '';
		if ($extc2 == '') {
			echo json_encode(array('err_no' => 'extc2_err'));
			exit;
		}
		// 将剩余驴币设置到用户信息统计表
		DB::update('common_member_count', array('extcredits2' => $extc2), array('uid' => $uid));
		// 取出计算表达式
		$exp = DB::fetch_first('SELECT svalue FROM ' . DB::table('common_setting') . " WHERE skey = 'creditsformula'");
		// 取出用户统计信息
		$user_status = DB::fetch_first('SELECT * FROM ' . DB::table('common_member_count') . " WHERE uid = '{$uid}'");
		// 重新组合键值对应
		$key = array('digestposts', 'threads', 'posts', 'oltime', 'friends', 'doings', 'blogs', 'albums', 'sharings', 'extcredits1', 'extcredits2', 'extcredits3', 'extcredits4', 'extcredits5', 'extcredits6', 'extcredits7', 'extcredits8');
		$val = array($user_status['digestposts'], $user_status['threads'], $user_status['posts'], $user_status['oltime'], $user_status['friends'], $user_status['doings'], $user_status['blogs'], $user_status['albums'], $user_status['sharings'], $user_status['extcredits1'], $user_status['extcredits2'], $user_status['extcredits3'], $user_status['extcredits4'], $user_status['extcredits5'], $user_status['extcredits6'], $user_status['extcredits7'], $user_status['extcredits8']);
		$express = str_replace($key, $val, $exp['svalue']);
		// 总分值计算并写回member表
		eval('\$credits = '.$express.';');
		DB::update('common_member', array('credits' => $credits), array('uid' => $uid));
		echo json_encode(array('suc_no' => 'extc2_suc'));
		break;
	default:
		echo json_encode(array('err_no' => 'act_err'));
		break;
}
exit;
?>