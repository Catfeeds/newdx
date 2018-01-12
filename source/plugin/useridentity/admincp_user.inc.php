<?php

/**
 * 用户身份后台管理
 *
 * @author wistar 120314
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once libfile('function/admincp');
switch ($_G['gp_op']) {
	case 'add':
		if (!$_G['gp_addsubmit']) {
			$arr_identity = get_identitys();
			include template('useridentity:user_add');
		} else {
			$int_uid = intval($_G['gp_hid_uid']);
			$str_username = trim($_G['gp_hid_username']);
			$arr_identity = $_G['gp_chk_identity'];
			$arr_detail = $_G['gp_chk_detail'];
			$str_b = $_G['gp_chk_b'];
			$int_sort = intval($_G['gp_txt_sort']);
			$int_type = $str_b ? 2 : 1;
			foreach ($arr_identity as $key => $value) {
				if (is_array($arr_detail[$key])) {
					foreach ($arr_detail[$key] as $k => $v) {
						DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $key, 'detail_id' => $k, 'createtime' => time()));
					}
					// 120525 wistar 计算该身份分组有几个高级身份
					$count_pro = DB::result_first('SELECT COUNT(id) FROM ' . DB::table('plugin_user_identitys') . " WHERE uid='{$int_uid}' and identity_id='{$key}' and	detail_id > 0");
					$count_pro && DB::query('update ' . DB::table('plugin_user_identitys') . " set has_pro={$count_pro} where uid='{$int_uid}' and identity_id='{$key}' and detail_id <= 0");
				} else {
					DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $key, 'createtime' => time()));
				}
			}
			DB::insert('plugin_userext', array('uid' => $int_uid, 'username' => $str_username, 'type' => $int_type, 'description' => '', 'sort' => $int_sort, 'createtime' => time()));

			cpmsg('用户身份添加成功！', dreferer(), 'succeed');
		}
		break;
	case 'delete_bat':
		$arr_uid = $_G['gp_chk_uid'];
		if (!$arr_uid) {
			cpmsg('参数错误！', dreferer(), 'error');
		}
		$str_uid = implode(',', array_keys($arr_uid));
		DB::query('DELETE FROM ' . DB::table('plugin_userext') . ' WHERE uid in(' . $str_uid . ')');
		DB::query('DELETE FROM ' . DB::table('plugin_user_identitys') . ' WHERE uid in(' . $str_uid . ')');
		cpmsg('删除成功！', dreferer(), 'succeed');
		break;
	case 'delete':
		$int_uid = $_G['gp_uid'];
		if (!$int_uid) {
			cpmsg('参数错误！', dreferer(), 'error');
		}
		DB::delete('plugin_userext', array('uid' => $int_uid));
		DB::delete('plugin_user_identitys', array('uid' => $int_uid));
		cpmsg('删除成功！', dreferer(), 'succeed');
		break;
	default:
		// 分页参数
		$ppp = 20;
		$page = max(1, intval($_G['gp_page']));
		$start = ($page - 1) * $ppp;
		// 获取uid、username等查询参数
		$str_uid = intval($_G['gp_txt_uid']) == 0 ? '' : intval($_G['gp_txt_uid']);
		$str_name = trim($_G['gp_txt_name']);
		$int_identity = intval($_G['gp_slt_identity']);
		$int_detail = intval($_G['gp_slt_detail']);
		// 取结果sql
		$str_sql = "SELECT * FROM " . DB::table('plugin_userext') . ' WHERE 1=1';
		$str_sql_count = "SELECT count(uid) FROM " . DB::table('plugin_userext') . ' WHERE 1=1';
		// 分别为总计sql和取结果sql拼接条件
		if ($str_uid) {
			$str_sql .= " AND uid='{$str_uid}'";
			$str_sql_count .= " AND uid='{$str_uid}'";
		}
		if ($str_name) {
			$str_sql .= " AND username = '{$str_name}'";
			$str_sql_count .= " AND username = '{$str_name}'";
		}

		if ($int_identity) {
			$tmp_sql = 'SELECT uid FROM ' . DB::table('plugin_user_identitys') . " WHERE identity_id='{$int_identity}'";
			if ($int_detail) {
				$tmp_sql .= " AND detail_id='{$int_detail}'";
			}
			$res_query = DB::query($tmp_sql);
			while ($value = DB::fetch($res_query)) {
				$arr_uids[] = $value['uid'];
			}
			$str_uids = implode(',', $arr_uids);
			if ($str_uids) {
				$str_sql .= " AND uid in({$str_uids})";
				$str_sql_count .= " AND uid in({$str_uids})";
			} else {
				$str_sql .= " AND 1=2";
				$str_sql_count .= " AND 1=2";
			}
		}

		$count = DB::result_first($str_sql_count);
		// 拼接排序和limit
		$str_sql .= " ORDER BY updatetime DESC LIMIT {$start}, {$ppp}";
		// 获取结果集
		$res_query = DB::query($str_sql);
		while ($value = DB::fetch($res_query)) {
			$res_qiid = DB::query('SELECT identity_id, detail_id FROM ' . DB::table('plugin_user_identitys') . " WHERE uid='{$value['uid']}' ORDER BY identity_id, detail_id");
			$arr_iids = array();
			$arr_idds = array();
			while ($v_id = DB::fetch($res_qiid)) {
				$arr_iids[] = $v_id['identity_id'];
				$v_id['detail_id'] && $arr_idds[] = $v_id['detail_id'];
			}
			$str_iids = implode(',', array_unique($arr_iids));
			$str_idds = implode(',', array_unique($arr_idds));
			if ($str_iids) {
				if ($str_idds) {
					$value['identitys'] = get_identitys("and id in({$str_iids})", " and id in({$str_idds})");
				} else {
					$value['identitys'] = get_identitys("and id in({$str_iids})", " and id='0'");
				}
				$value['iids'] = $str_iids;
				$value['idds'] = $str_idds;
			}
			$arr_users[] = $value;
		}
		$arr_identity = get_identitys();
		$json_identity = json_encode(iconv_array($arr_identity));
		$url = ADMINSCRIPT . "?action=plugins&operation=config&op=config&do={$pluginid}&identifier=useridentity&pmod=admincp_user";
		if ($int_identity) {
			$url .= "&slt_identity={$int_identity}";
			if ($int_detail) {
				$url .= "&slt_detail={$int_detail}";
			}
		}

		$str_page = multi($count, $ppp, $page, $url);
		include template('useridentity:user_list');
		break;
}

/**
 * 获取身份集合
 *
 * @author wistar 120319
 * @param type $conditions 当适用于单个用户时，传入所属用户的identity_id
 * @return type
 */
function get_identitys($con_iid = '', $con_idd = ' AND 1=1') {
	$str_sql = "SELECT * FROM " . DB::table('plugin_identity') . " WHERE 1=1 {$con_iid} ORDER BY `order`, id";
	$res_identity = DB::query($str_sql);
	$arr_identity = array();
	while ($value = DB::fetch($res_identity)) {
		if ($value[id]) {
			$str_sql = "SELECT * FROM " . DB::table('plugin_identity_detail') . " WHERE identity_id='{$value['id']}'{$con_idd} ORDER BY `order`, id";
			$res_detail = DB::query($str_sql);
			while ($v = DB::fetch($res_detail)) {
				$value['sub'][] = $v;
			}
		}
		$arr_identity[] = $value;
	}
	return $arr_identity;
}

?>
