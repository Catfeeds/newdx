<?php
/**
 * 身份后台管理
 *
 * @author wistar 120331
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once libfile('function/admincp');
$dreferer = "action=plugins&operation=config&do={$pluginid}&identifier=useridentity&pmod=admincp_identity";
switch ($_G['gp_op']) {
	case 'aoru':
		// 新添身份分组
		$arr_newi = $_POST['newidentity'];
		// 新添身份默认选项
		$arr_newe = $_POST['newentity'];
		// 新添身份类型（个人/企业）
		$arr_newt = $_POST['newtype'];
		// 新添身份排序
		$arr_newo = $_POST['neworder'];
		$arr_newd = $_POST['newdescription'];
		$arr_newr = $_POST['newremark'];

		// 新添子身份选项
		$arr_newis = $_POST['newis'];
		// 新添子身份排序
		$arr_newos = $_POST['newos'];
		$arr_newds = $_POST['newds'];
		$arr_newrs = $_POST['newrs'];

		// 原有身份分组
		$arr_i = $_POST['identity'];
		// 原有身份选项
		$arr_e = $_POST['entity'];
		// 原有身份类型（个人/企业）
		$arr_t = $_POST['type'];
		// 原有身份排序
		$arr_o = $_POST['order'];
		$arr_d = $_POST['description'];
		$arr_r = $_POST['remark'];
		// 原有子分类选项
		$arr_is = $_POST['subidentity'];
		// 原有子分类排序
		$arr_os = $_POST['suborder'];
		$arr_ds = $_POST['subdescription'];
		$arr_rs = $_POST['subremark'];

		// 如果有新添组别
		if ($arr_newi) {
			foreach ($arr_newi as $key => $value) {
				if (trim($value)) {
					$int_order = $arr_newo[$key] ? $arr_newo[$key] : 0;
					$str_entity = $arr_newe[$key] ? $arr_newe[$key] : $value;
					$int_type = $arr_newt[$key] ? $arr_newt[$key] : 1;
					DB::insert('plugin_identity', array('identity_name' => $value, 'identity_entity' => $str_entity, 'description' => $arr_newd[$key], 'remark' => $arr_newr[$key], 'order' => $int_order, 'type' => $int_type));
				}
			}
		}
		// 如果有新添子身份
		if ($arr_newis) {
			foreach ($arr_newis as $key => $value) {
				foreach ($value as $k => $v) {
					if (trim($v)) {
						$int_order = $arr_newos[$key][$k] ? $arr_newos[$key][$k] : 0;
						DB::insert('plugin_identity_detail', array('identity_id' => $key, 'subname' => $v, 'description' => $arr_newds[$key][$k], 'remark' => $arr_newrs[$key][$k], 'parent_id' => 0, 'order' => $int_order));
					}
				}
			}
		}
		// 修改现有身份组
		if ($arr_i) {
			foreach ($arr_i as $key => $value) {
				if (trim($value)) {
					$int_order = $arr_o[$key] ? $arr_o[$key] : 0;
					$str_entity = $arr_e[$key] ? $arr_e[$key] : $value;
					$int_type = $arr_t[$key] ? $arr_t[$key] : 1;
					DB::update('plugin_identity', array('identity_name' => $value, 'identity_entity' => $str_entity, 'description' => $arr_d[$key], 'remark' => $arr_r[$key], 'order' => $int_order, 'type' => $int_type), array('id' => $key));
				}
			}
			foreach ($arr_is as $key => $value) {
				if (trim($value)) {
					$int_order = $arr_os[$key] ? $arr_os[$key] : 0;
					DB::update('plugin_identity_detail', array('subname' => $value, 'description' => $arr_ds[$key], 'remark' => $arr_rs[$key], 'order' => $int_order), array('id' => $key));
				}
			}
		}
		cpmsg('身份设置成功！', $dreferer, 'succeed');
		break;
	case 'delete':
		$int_iid = intval($_G['gp_iid']);
		$str_type = trim($_G['gp_type']);
		if (!$int_iid || !$str_type) {
			cpmsg('参数错误！', $dreferer, 'error');
		}
		if ($str_type == 'primary') {
			$int_del = DB::result_first("SELECT count(*) FROM " . DB::table('plugin_identity_detail')." pid WHERE pid.identity_id='$int_iid'");
			if ($int_del) {
				cpmsg('请先删除其下所有子身份！', $dreferer, 'error');
			}
			DB::delete('plugin_identity', array('id' => $int_iid));
			DB::delete('plugin_user_identitys', array('identity_id' => $int_iid));
		} else {
			DB::delete('plugin_identity_detail', array('id' => $int_iid));
			DB::delete('plugin_user_identitys', array('detail_id' => $int_iid));
		}
		cpmsg('删除成功！', $dreferer, 'succeed');
		break;
	default:
		$str_sql = "SELECT * FROM " . DB::table('plugin_identity') . " pi ORDER BY pi.order, pi.id";
		$res_identity = DB::query($str_sql);
		$arr_identity = array();
		while($value = DB::fetch($res_identity)) {
			$str_sql = "SELECT * FROM " . DB::table('plugin_identity_detail') . " pid WHERE pid.identity_id='{$value['id']}' ORDER BY pid.order, pid.id";
			$res_sub = DB::query($str_sql);
			while($v = DB::fetch($res_sub)) {
				$value['sub'][] = $v;
			}
			$arr_identity[] = $value;
		}
		include template('useridentity:identity_list');
		break;
}
?>
