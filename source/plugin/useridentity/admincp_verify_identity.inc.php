<?php

/**
 * 用户身份审核
 *
 * @author wistar 120412
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once libfile('function/admincp');
switch ($_G['gp_op']) {
//	case 'allow_apply':
//		$int_id = $_G['gp_id'];
//		$int_uid = $_G['gp_uid'];
//		$int_iid = $_G['gp_iid'];
//		$int_idd = $_G['gp_idd'];
//		if (!$int_id || !$int_uid || !$int_iid || !$int_idd) {
//			cpmsg('参数错误！', dreferer(), 'error');
//		}
//		DB::update('plugin_user_apply_identity', array('status' => 2), array('id' => $int_id));
//		$arr_user_identitys = DB::fetch_first('select id from ' . DB::table('plugin_user_identitys') . " where identity_id='{$int_iid}' and detail_id='0'");
//		if (!$arr_user_identitys) {
//			DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $int_iid, 'detail_id' => 0, 'createtime' => time()));
//		}
//		DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $int_iid, 'detail_id' => $int_idd, 'createtime' => time()));
////		$res_appids = DB::query($str_sql);
////		while ($value = DB::fetch($res_appids)) {
////			DB::insert('plugin_user_identitys', array('uid' => $int_uid, 'identity_id' => $value['identity_id'], 'detail_id' => $value['detail_id'], 'createtime' => time()));
////		}
//		cpmsg('审核已通过！', dreferer(), 'succeed');
//		break;
//	case 'delete':
//		$int_uid = $_G['gp_uid'];
//		if (!$int_uid) {
//			cpmsg('参数错误！', dreferer(), 'error');
//		}
//		DB::delete('plugin_userext', array('uid' => $int_uid));
//		DB::delete('plugin_user_identitys', array('uid' => $int_uid));
//		cpmsg('删除成功！', dreferer(), 'succeed');
//		break;
	default:
		// 分页参数
		$ppp = 20;
		$page = max(1, intval($_G['gp_page']));
		$start = ($page - 1) * $ppp;
		$str_sql = 'SELECT puai.*, cm.username, pid.subname FROM ' . DB::table('plugin_user_apply_identity') . ' puai LEFT JOIN ' . DB::table('common_member') . ' cm ON puai.uid=cm.uid LEFT JOIN ' . DB::table('plugin_identity_detail') . " pid ON puai.detail_id=pid.id WHERE 1=1 ";
		$str_sql_count = 'SELECT count(puai.uid) FROM ' . DB::table('plugin_user_apply_identity') . ' puai LEFT JOIN ' . DB::table('common_member') . ' cm ON puai.uid=cm.uid LEFT JOIN ' . DB::table('plugin_identity_detail') . " pid ON puai.detail_id=pid.id WHERE 1=1 ";
		$str_uid = intval($_G['gp_txt_uid']) == 0 ? '' : intval($_G['gp_txt_uid']);
		$str_name = trim($_G['gp_txt_name']);
		$int_status = intval($_G['gp_slt_status']);
		if ($str_uid) {
			$str_sql .= "AND puai.uid='{$str_uid}' ";
			$str_sql_count .= "AND puai.uid='{$str_uid}' ";
		}
		if ($str_name) {
			$str_sql .= "AND cm.username='{$str_name}' ";
			$str_sql_count .= "AND cm.username='{$str_name}' ";
		}
		if ($int_status) {
			$str_sql .= "AND puai.status='{$int_status}' ";
			$str_sql_count .= "AND puai.status='{$int_status}' ";
		}
		$str_sql .= "ORDER BY puai.apptime DESC  LIMIT {$start}, {$ppp}";
		$res_userapp = DB::query($str_sql);
		$count = DB::result_first($str_sql_count);
		while($value = DB::fetch($res_userapp)) {
			$value['apptime'] = date('Y-m-d', $value['apptime']);
			$arr_userapp[] = $value;
//			$count++;
		}
		$url = ADMINSCRIPT . "?action=plugins&operation=config&do={$pluginid}&identifier=useridentity&pmod=admincp_verify_identity";
		$int_status && $url .= "&slt_status={$int_status}";
		$str_page = multi($count, $ppp, $page, $url);
		include template('useridentity:verify_identity');
		break;
}
?>
