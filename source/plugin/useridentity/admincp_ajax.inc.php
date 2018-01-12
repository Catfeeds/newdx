<?php

/**
 * 用户身份ajax处理
 *
 * @author wistar 120314
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once libfile('function/admincp');
switch ($_G['gp_op']) {
	case 'edit':
		$str_type = $_G['gp_type'];
		$int_uid = intval($_G['gp_uid']);
		if (!$str_type || !$int_uid) {
			echo 'param_err';
			exit;
		}
		switch ($str_type) {
			case 'is_b':
				$int_is_b = intval($_G['gp_is_b']);
				DB::update('plugin_userext', array('type' => $int_is_b, 'updatetime' => time()), array('uid' => $int_uid));
				echo 'success';
				break;
			case 'sort':
				$int_sort = intval($_G['gp_sort']);
				DB::update('plugin_userext', array('sort' => $int_sort, 'updatetime' => time()), array('uid' => $int_uid));
				echo 'success';
				break;
			case 'desc':
				$str_desc = trim($_G['gp_desc']);
				DB::update('plugin_userext', array('description' => $str_desc, 'updatetime' => time()), array('uid' => $int_uid));
				echo 'success';
				break;
			case 'identity':
				$int_uid = intval($_G['gp_hid_uid']);
				$arr_identity = $_G['gp_chk_identity'];
				$arr_detail = $_G['gp_chk_detail'];
				if (!$int_uid) {
					exit;
				}
				DB::delete('plugin_user_identitys', array('uid' => $int_uid));
				if (!$arr_identity) {
					echo '';
				} else {
					foreach ($arr_identity as $key => $value) {
						if (count($arr_detail[$key])) {
							DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $key, 'createtime' => time()));
							foreach ($arr_detail[$key] as $k => $v) {
								DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $key, 'detail_id' => $k, 'createtime' => time()));
								$arr_details[] = $k;
							}
							// 120525 wistar 计算该身份分组有几个高级身份
							$count_pro = DB::result_first('SELECT COUNT(id) FROM ' . DB::table('plugin_user_identitys') . " WHERE uid='{$int_uid}' and identity_id='{$key}' and	detail_id > 0");
							$count_pro && DB::query('update ' . DB::table('plugin_user_identitys') . " set has_pro={$count_pro} where uid='{$int_uid}' and identity_id='{$key}' and detail_id <= 0");
						} else {
							DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $key, 'createtime' => time()));
						}
					}
					$str_identitys = implode(',', array_keys($arr_identity));
					$str_details = $arr_details ? implode(',', $arr_details) : '0';
					$str_sql = "SELECT * FROM " . DB::table('plugin_identity') . " WHERE id in({$str_identitys}) ORDER BY `order`, id";
					$res_identity = DB::query($str_sql);
					$arr_identity = array();
					while ($value = DB::fetch($res_identity)) {
						$str_names .= '<span style=\"color:red\">' . $value['identity_name'] . ':</span>' . $value['identity_entity'];
						if ($value[id]) {
							$str_sql = "SELECT * FROM " . DB::table('plugin_identity_detail') . " WHERE identity_id='{$value['id']}' AND id in({$str_details}) ORDER BY `order`, id";
							$res_detail = DB::query($str_sql);
							while ($v = DB::fetch($res_detail)) {
								$str_names .= ' | ' . $v['subname'];
							}
						}
						$str_names .= '&nbsp;&nbsp; ';
					}
					echo "{\"iids\":\"{$str_identitys}\", \"idds\":\"{$str_details}\", \"names\":\"{$str_names}\"}";
				}
				break;
			default:
				break;
		}
		break;
	case 'user_search' :
		$str_uid = intval($_G['gp_uid']);
		$str_name = trim($_G['gp_username']);
		if (!$str_uid && !$str_name) {
			echo 'param_err';
			exit;
		}
		$str_sql1 = 'SELECT * FROM ' . DB::table('plugin_userext') . ' WHERE 1=1';
		$str_sql2 = 'SELECT uid, username FROM ' . DB::table('common_member') . ' WHERE 1=1';
		if ($str_uid) {
			$str_sql1 .= " AND uid='{$str_uid}'";
			$str_sql2 .= " AND uid='{$str_uid}'";
		} elseif ($str_name) {
			$str_sql1 .= " AND username='{$str_name}'";
			$str_sql2 .= " AND username='{$str_name}'";
		}
		$arr_user = DB::result_first($str_sql1);
		if ($arr_user) {
			echo 'exists';
			exit;
		}
		$query = DB::query($str_sql2);
		$arr_user = DB::fetch($query);
		if (!$arr_user) {
			echo 'no_user';
			exit;
		}
		echo $arr_user['uid'] . '~_~' . $arr_user['username'];
		break;
	case 'allow_apply':
		$int_appid = $_G['gp_appid'];
		$int_uid = $_G['gp_uid'];
		$int_iid = $_G['gp_iid'];
		$int_idd = $_G['gp_idd'];
		if (!$int_appid || !$int_uid || !$int_iid || !$int_idd) {
			cpmsg('参数错误！', dreferer(), 'error');
		}
		// 如果用户扩展信息表无此用户数据则执行插入
		$arr_userext = DB::fetch_first('SELECT * FROM ' . DB::table('plugin_userext') . " WHERE uid='{$int_uid}'");
		if (!$arr_userext) {
			$username = DB::fetch_first('SELECT username FROM ' . DB::table('common_member') . " WHERE uid='{$int_uid}'");
			DB::insert('plugin_userext', array('uid' => $int_uid, 'username' => $username['username'], 'type' => 1, 'description' => '', 'sort' => 255, 'createtime' => time()));
		}
		DB::update('plugin_user_apply_identity', array('status' => 2), array('id' => $int_appid));
		// 120611 wistar 先查询用户身份表，如果不存在与申请身份相应的主身份则插入一条住身份数据
		$arr_user_identitys = DB::fetch_first('select id from ' . DB::table('plugin_user_identitys') . " where uid='{$int_uid}' and identity_id='{$int_iid}' and detail_id='0'");
		if (!$arr_user_identitys) {
			DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $int_iid, 'detail_id' => 0, 'createtime' => time()));
		}

		// 120611 wistar 先查询用户身份表，如果不存在与申请身份相同的身份则插入数据，否则有可能是管理员已自行将该用户添加了该身份
		$arr_user_identitys = DB::fetch_first('select id from ' . DB::table('plugin_user_identitys') . " where uid='{$int_uid}' and identity_id='{$int_iid}' and detail_id='{$int_idd}'");
		if (!$arr_user_identitys) {
			DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $int_iid, 'detail_id' => $int_idd, 'createtime' => time()));
		}

		// 120525 wistar 计算该身份分组有几个高级身份
		$count_pro = DB::result_first('SELECT COUNT(id) FROM ' . DB::table('plugin_user_identitys') . " WHERE uid='{$int_uid}' and identity_id='{$int_iid}' and	detail_id > 0");
		$count_pro && DB::query('update ' . DB::table('plugin_user_identitys') . " set has_pro={$count_pro} where uid='{$int_uid}' and identity_id='{$int_iid}' and detail_id <= 0");
		echo "{\"status\":\"success\"}";
		break;
	case 'deny_apply':
		$int_appid = $_G['gp_appid'];
		$str_reason = iconv('utf-8', 'gbk', $_G['gp_reason']);;
		if (!$int_appid) {
			exit;
		}
		DB::update('plugin_user_apply_identity', array('status' => 3, 'deny_reason' => $str_reason), array('id' => $int_appid));
		echo "{\"status\":\"success\"}";
		break;
}
?>
