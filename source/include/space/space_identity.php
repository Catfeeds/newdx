<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_thread.php 19203 2010-12-22 02:55:50Z monkey $
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$arr_userext = DB::fetch_first('SELECT * FROM ' . DB::table('plugin_userext') . " WHERE uid='{$_G['uid']}'");
// 初始默认用户类型为个人用户
$int_type = 1;
// 如果查到用户则取出该用户所有身份，否则在userext表中新增用户数据，默认为个人用户
if ($arr_userext) {
	$int_type = $arr_userext['type'];
	$str_sql_identitys = 'SELECT pui.*, pi.identity_entity, pid.subname FROM ' . DB::table('plugin_user_identitys') . ' pui ' .
			'LEFT JOIN ' . DB::table('plugin_identity') . ' pi on pui.identity_id=pi.id ' .
			'LEFT JOIN ' . DB::table('plugin_identity_detail') . ' pid on pui.detail_id=pid.id ' .
			"WHERE uid='{$_G['uid']}' ORDER BY detail_id, identity_id";
	$res_identitys = DB::query($str_sql_identitys);
	$arr_identitys = array();
	while ($identitys = DB::fetch($res_identitys)) {
		$arr_identitys[] = $identitys['detail_id'] ? $identitys['subname'] : $identitys['identity_entity'];
	}
}

// 分页参数
$ppp = 10;
$page = max(1, intval($_G['gp_page']));
$start = ($page - 1) * $ppp;
// 获取uid、username等查询参数
$int_identity = intval($_G['gp_identity']);
$int_detail = intval($_G['gp_detail']);
// 取结果sql
//$str_sql = "SELECT * FROM " . DB::table('plugin_userext') . ' WHERE type=1';
//$str_sql_count = "SELECT count(uid) FROM " . DB::table('plugin_userext') . ' WHERE type=1';
//// 分别为总计sql和取结果sql拼接条件
//if ($int_identity || $int_detail) {
//	$tmp_sql = 'SELECT uid FROM ' . DB::table('plugin_user_identitys') . ' WHERE 1=1';
//	if ($int_identity) {
//		$tmp_sql .= " AND identity_id='{$int_identity}'";
//		$str_top_name = DB::result_first('select identity_entity from ' . DB::table('plugin_identity') . " where id='{$int_identity}'");
//	}
//	if ($int_detail) {
//		$tmp_sql .= " AND detail_id='{$int_detail}'";
//		$str_top_name = DB::result_first('select subname from ' . DB::table('plugin_identity_detail') . " where id='{$int_detail}'");
//	}
//	$res_query = DB::query($tmp_sql);
//	while ($value = DB::fetch($res_query)) {
//		$arr_uids[] = $value['uid'];
//	}
//	$str_uids = implode(',', $arr_uids);
//	if ($str_uids) {
//		$str_sql .= " AND uid in({$str_uids})";
//		$str_sql_count .= " AND uid in({$str_uids})";
//	} else {
//		$str_sql .= " AND 1=2";
//		$str_sql_count .= " AND 1=2";
//	}
//}

//
// 取结果sql
$str_sql = 'SELECT pu.* FROM ' . DB::table('plugin_userext') . ' pu';
$where = ' WHERE type=1';
$str_sql_count = "SELECT count(pu.uid) FROM " . DB::table('plugin_userext') . ' pu';
// 分别为总计sql和取结果sql拼接条件
if ($int_identity || $int_detail) {
	if ($int_identity) {
		$str_sql .= ' LEFT JOIN ' . DB::table('plugin_user_identitys') . ' pui ON pu.uid=pui.uid' .
					$where . " AND identity_id='{$int_identity}' AND (detail_id='0' or detail_id='-1')" .
					" ORDER BY pu.sort, pui.has_pro desc, pu.createtime LIMIT {$start}, {$ppp}";
		$str_sql_count .= ' LEFT JOIN ' . DB::table('plugin_user_identitys') . ' pui ON pu.uid=pui.uid' . $where . " AND identity_id='{$int_identity}' AND (detail_id='0' or detail_id='-1')";
		$str_top_name = DB::result_first('select identity_entity from ' . DB::table('plugin_identity') . " where id='{$int_identity}'");
	} elseif ($int_detail) {
		$str_sql .= ' LEFT JOIN ' . DB::table('plugin_user_identitys') . ' pui ON pu.uid=pui.uid' .
					$where . " AND detail_id='{$int_detail}'" .
					" ORDER BY sort, createtime LIMIT {$start}, {$ppp}";
		$str_sql_count .= ' LEFT JOIN ' . DB::table('plugin_user_identitys') . ' pui ON pu.uid=pui.uid' . $where . " AND detail_id='{$int_detail}'";
		$str_top_name = DB::result_first('select subname from ' . DB::table('plugin_identity_detail') . " where id='{$int_detail}'");
	} else {
		$str_sql .= $where . " ORDER BY sort, createtime LIMIT {$start}, {$ppp}";
	}
} else {
	$str_sql .= $where . " ORDER BY sort, createtime LIMIT {$start}, {$ppp}";
}

$count = DB::result_first($str_sql_count);

// 获取结果集
$res_query = DB::query($str_sql);

// 查找好友
$query = DB::query("SELECT fuid, fusername FROM " . DB::table('home_friend') . " WHERE uid='$_G[uid]'");
while ($value = DB::fetch($query)) {
	$myfuids[$value['fuid']] = $value['fuid'];
}
$myfuids[$_G['uid']] = $_G['uid'];
// 好友数
$int_friend_num = DB::result_first('SELECT friends FROM '.DB::table('common_member_count')." WHERE uid={$_G['uid']}");

// 计算结果集总和
$top = $start;
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
	}
	$value['inames'] = '';
	$int_iter = 1;
	foreach ($value['identitys'] as $k => $v) {
		$value['inames'] .= "<a href=\"home.php?mod=space&do=identity&identity={$v['id']}\">" . $v['identity_entity'] . '</a>&nbsp;';
		$int_iter++;
		$int_iter = $int_iter > 3 ? 1 : $int_iter;
		foreach ($v['sub'] as $sk => $sv) {
			$value['inames'] .= "<a href=\"home.php?mod=space&do=identity&detail={$sv['id']}\">" . $sv['subname'] . '</a>&nbsp;';
			$int_iter++;
			$int_iter = $int_iter > 3 ? 1 : $int_iter;
		}
	}
	$value['inames'] = $value['inames'];
	$value['iter'] = ++$top;
	$value['isfriend'] = empty($myfuids[$value['uid']]) ? 0 : 1;
	$arr_users[] = $value;
}
$arr_identity_list = get_identitys();
//$json_identity = json_encode(iconv_array($arr_identity_list));
$url = 'home.php?mod=space&do=identity';
$int_identity && $url .= "&identity={$int_identity}";
$int_detail && $url .= "&detail={$int_detail}";
$multi = multi($count, $ppp, $page, $url);

//$str_date = date("Y年m月d日", time());

/**
 * 获取身份集合
 * 
 * @author wistar 120319
 * @param type $conditions 当适用于单个用户时，传入所属用户的identity_id
 * @return type 
 */
function get_identitys($con_iid = '', $con_idd = ' AND 1=1') {
	$str_sql = "SELECT * FROM " . DB::table('plugin_identity') . " WHERE type=1 {$con_iid} ORDER BY `order`, id";
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

include_once template("diy:home/space_identity");
?>