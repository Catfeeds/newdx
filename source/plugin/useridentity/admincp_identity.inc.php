<?php
/**
 * ��ݺ�̨����
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
		// ������ݷ���
		$arr_newi = $_POST['newidentity'];
		// �������Ĭ��ѡ��
		$arr_newe = $_POST['newentity'];
		// ����������ͣ�����/��ҵ��
		$arr_newt = $_POST['newtype'];
		// �����������
		$arr_newo = $_POST['neworder'];
		$arr_newd = $_POST['newdescription'];
		$arr_newr = $_POST['newremark'];

		// ���������ѡ��
		$arr_newis = $_POST['newis'];
		// �������������
		$arr_newos = $_POST['newos'];
		$arr_newds = $_POST['newds'];
		$arr_newrs = $_POST['newrs'];

		// ԭ����ݷ���
		$arr_i = $_POST['identity'];
		// ԭ�����ѡ��
		$arr_e = $_POST['entity'];
		// ԭ��������ͣ�����/��ҵ��
		$arr_t = $_POST['type'];
		// ԭ���������
		$arr_o = $_POST['order'];
		$arr_d = $_POST['description'];
		$arr_r = $_POST['remark'];
		// ԭ���ӷ���ѡ��
		$arr_is = $_POST['subidentity'];
		// ԭ���ӷ�������
		$arr_os = $_POST['suborder'];
		$arr_ds = $_POST['subdescription'];
		$arr_rs = $_POST['subremark'];

		// ������������
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
		// ��������������
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
		// �޸����������
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
		cpmsg('������óɹ���', $dreferer, 'succeed');
		break;
	case 'delete':
		$int_iid = intval($_G['gp_iid']);
		$str_type = trim($_G['gp_type']);
		if (!$int_iid || !$str_type) {
			cpmsg('��������', $dreferer, 'error');
		}
		if ($str_type == 'primary') {
			$int_del = DB::result_first("SELECT count(*) FROM " . DB::table('plugin_identity_detail')." pid WHERE pid.identity_id='$int_iid'");
			if ($int_del) {
				cpmsg('����ɾ��������������ݣ�', $dreferer, 'error');
			}
			DB::delete('plugin_identity', array('id' => $int_iid));
			DB::delete('plugin_user_identitys', array('identity_id' => $int_iid));
		} else {
			DB::delete('plugin_identity_detail', array('id' => $int_iid));
			DB::delete('plugin_user_identitys', array('detail_id' => $int_iid));
		}
		cpmsg('ɾ���ɹ���', $dreferer, 'succeed');
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
