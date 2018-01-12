<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

require_once dirname(__FILE__) . '/model/linemod.php';
$page = intval($_G['gp_page']);
$page = max(1, $page);
$limit = 50;
$start = ($page - 1) * $limit;
$method = $_G['gp_method'];
$method_arr = array('list', 'add', 'history', 'edit', 'openclose', 'restart');
$method = in_array($method, $method_arr) ? $method : "list";
require_once libfile('class/myredis');
$myredis = myredis::instance(6382);
//$tuisonguser = $myredis->HGETALL('plugin_tuisong_user_array');
$todaystart = strtotime('today');
$todayend = $todaystart + 24*3600;
/*$allkey = $myredis->keys('plugin_tuisong_user_array_fid_*');
foreach($allkey as $keyname){
	echo "<br /><pre>====<br />";
	var_dump($keyname);
	var_dump(preg_match('/^plugin_tuisong_user_array_fid_(\d+)$/i', $keyname, $matchesme));
	var_dump($matchesme);
	if(($fid = intval($matchesme[1])) > 0){
		var_dump(linemod::getDayLine($todayend, 1, $fid));
	}
	echo "<br />===</pre>";
}*/
/*将过期线路制空*/
DB::update(linemod::TABLE_NAME_NOPRE, array(linemod::_STATUS => 2), "`" . linemod::_STATUS . "` = 1 AND `" . linemod::_TIME_LAST . "` < {$todaystart}");
switch($method){
	case 'add':
	case 'edit':
		$messagetips = array();
		$allfidname = array();
		$sql = "SELECT fid, name FROM " . DB::table('forum_forum') . " WHERE `status` = 1 AND `type` = 'forum' " . getSlaveID();
		$q = DB::query($sql);
		while($v = DB::fetch($q)){
			$allfidname[$v['fid']] = $v['name'];
		}
		if($_POST['submit'] == 1)
		{
			if(!$_POST['linename']){
				$messagetips['linename'] = "线路名不能为空";
			}
			if(!$_POST['lineurl']){
				$messagetips['lineurl'] = "线路URL不能为空";
			}
			if(preg_match("/^http:\/\/www\.zaiwai\.com\/xianlu-(\d+)$/i", $_POST['lineurl'], $matches) == 0){
				$messagetips['lineurl'] = "线路URL必须为在外链接，请检查链接是否正确";
			}
			$goods_id = $matches[1];		
			if(!$_POST['linestart']){
				$messagetips['linestart'] = "请选择线路开始时间";
			}
			if(strtotime($_POST['linestart']) - time() <= 24*3600){
				$messagetips['linestart'] = "开始时间必须在当前日期一天以后";
			}
			if(!$_POST['lineuse']){
				$messagetips['lineuse'] = "请选择线路结束时间";
			}
			if(!$_POST['linebefore']){
				$messagetips['linebefore'] = "请选择线路提前报名时间";
			}
			if(!$_POST['linepos']){
				$messagetips['linepos'] = "请选择推送位置";
			}
			if(!$_POST['linefid']){
				$messagetips['linefid'] = "请选择线路版块";
			}
			if($method == 'edit'){
				$nowid = intval($_G['gp_editid']);
				$nowinfo = DB::fetch_first("SELECT * FROM " . linemod::TABLE_NAME . " WHERE `" . linemod::_ID . "` = {$nowid} AND `" . linemod::_STATUS . "` <= 1");
				if(!$nowinfo){
					cpmsg("参数错误，返回列表页重新选择", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'error');
				}
			}
			if(!$messagetips){
				if($method == 'add'){
					$insertarr = array(
								linemod::_NAME => $_POST['linename'],
								linemod::_FID => $_POST['linefid'],
								linemod::_URL => $_POST['lineurl'],
								linemod::_TIME_CREATE => time(),
								linemod::_STATUS => 0,
								linemod::_TIME_BEFORE => $_POST['linebefore'],
								linemod::_TIME_LAST => strtotime($_POST['linestart']) - $_POST['linebefore'] * 24 * 3600,
								linemod::_POS => $_POST['linepos'],
								linemod::_TIME_START => strtotime($_POST['linestart']),
								linemod::_GOODSID => $goods_id,
								linemod::_TIME_USED => $_POST['lineuse']);
					$insertid = DB::insert(linemod::TABLE_NAME_NOPRE, $insertarr);
					if($insertid > 0){
						//memory('rm', 'plugin_lineinfo_' . $_POST['linepos'] . '_time_' . $todayend);
						$myredis->EXPIRE('plugin_lineinfo_' . $pos . '_time_' . $todayend, 0);
						cpmsg("添加完毕，即将跳转到列表页", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'succeed');
					}
				}elseif($method == 'edit'){
					$editarr = array(
								linemod::_NAME => $_POST['linename'],
								linemod::_URL => $_POST['lineurl'],
								linemod::_STATUS => 0,
								linemod::_FID => $_POST['linefid'],
								linemod::_TIME_BEFORE => $_POST['linebefore'],
								linemod::_POS => $_POST['linepos'],
								linemod::_TIME_LAST => strtotime($_POST['linestart']) - $_POST['linebefore'] * 24 * 3600,
								linemod::_TIME_START => strtotime($_POST['linestart']),
								linemod::_GOODSID => $goods_id,
								linemod::_TIME_USED => $_POST['lineuse']);
					DB::update(linemod::TABLE_NAME_NOPRE, $editarr, array(linemod::_ID => $nowinfo[linemod::_ID]));
					//memory('rm', 'plugin_lineinfo_' . $_POST['linepos'] . '_time_' . $todayend);
					$myredis->EXPIRE('plugin_lineinfo_' . $pos . '_time_' . $todayend, 0);
					//if(DB::affected_rows() > 0){
						cpmsg("修改完毕，状态调整为未审核，请注意审核，即将跳转到列表页", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'succeed');
					//}
				}
			}
		}elseif($method == 'edit'){
			$nowid = intval($_G['gp_editid']);
			$nowinfo = DB::fetch_first("SELECT * FROM " . linemod::TABLE_NAME . " WHERE `" . linemod::_ID . "` = {$nowid} AND `" . linemod::_STATUS . "` <= 1");
			if(!$nowinfo){
				cpmsg("参数错误，返回列表页重新选择", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'error');
			}
			$_POST['linename'] = $nowinfo[linemod::_NAME];
			$_POST['lineurl'] = $nowinfo[linemod::_URL];
			$_POST['linefid'] = $nowinfo[linemod::_FID];
			$_POST['linestart'] = date('Y-m-d', $nowinfo[linemod::_TIME_START]);
			$_POST['lineuse'] = $nowinfo[linemod::_TIME_USED];
			$_POST['linepos'] = $nowinfo[linemod::_POS];
			$_POST['linebefore'] = $nowinfo[linemod::_TIME_BEFORE];
		}
		include template('interests:add');
		break;
	case 'restart':
		$nowid = intval($_G['gp_editid']);
		$nowinfo = DB::fetch_first("SELECT * FROM " . linemod::TABLE_NAME . " WHERE `" . linemod::_ID . "` = {$nowid} AND `" . linemod::_STATUS . "` = 2");
		if(!$nowinfo){
			cpmsg("参数错误，返回列表页重新选择", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'error');
		}
		require_once dirname(__FILE__) . '/model/historymod.php';
		$historycount = DB::result_first("SELECT count(*) FROM " . historymod::_TABLE . " WHERE `" . historymod::_LINEID . "` = {$nowid}");
		if($_POST['submit'] == 1)
		{
			if(!$_POST['linestart']){
				$messagetips['linestart'] = "请选择线路开始时间";
			}
			if(preg_match("/^http:\/\/www\.zaiwai\.com\/xianlu-(\d+)$/i", $nowinfo[linemod::_URL], $matches) == 0){
				$messagetips['lineurl'] = "线路URL必须为在外链接，请检查链接是否正确";
			}
			$goods_id = $matches[1];
			if($historycount > 0){
				$insertarr = array(
							linemod::_NAME => $nowinfo[linemod::_NAME],
							linemod::_FID => $nowinfo[linemod::_FID],
							linemod::_URL => $nowinfo[linemod::_URL],
							linemod::_STATUS => 0,
							linemod::_TIME_BEFORE => $nowinfo[linemod::_TIME_BEFORE],
							linemod::_POS => $nowinfo[linemod::_POS],
							linemod::_TIME_START => strtotime($_POST['linestart']),
							linemod::_TIME_CREATE => time(),
							linemod::_TIME_USED => $nowinfo[linemod::_TIME_USED],
							linemod::_GOODSID => $goods_id,
							linemod::_TIME_LAST => strtotime($_POST['linestart']) - $nowinfo[linemod::_TIME_BEFORE] * 24 * 3600
							);
				$insertid = DB::insert(linemod::TABLE_NAME_NOPRE, $insertarr);
				if($insertid > 0){
					DB::update(linemod::TABLE_NAME_NOPRE, array(linemod::_STATUS => 3), array(linemod::_ID => $nowid));
					$myredis->EXPIRE('plugin_lineinfo_' . $pos . '_time_' . $todayend, 0);
					cpmsg("续期成功，因原先线路有历史记录，将生成一条新的记录，即将跳转到列表页", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'succeed');
				}
			}else{
				$updatearr = array(
							linemod::_STATUS => 0,
							linemod::_TIME_START => strtotime($_POST['linestart']),
							linemod::_TIME_CREATE => time(),
							linemod::_TIME_LAST => strtotime($_POST['linestart']) - $nowinfo[linemod::_TIME_BEFORE] * 24 * 3600
							);
				$wherearr = array(
							linemod::_ID => $nowid
							);
				DB::update(linemod::TABLE_NAME_NOPRE, $updatearr, $wherearr);
				$myredis->EXPIRE('plugin_lineinfo_' . $pos . '_time_' . $todayend, 0);
				cpmsg("续期完毕，状态调整为未审核，请注意审核，即将跳转到列表页", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'succeed');
			}
		}
		include template('interests:restart');
		break;
	case 'history':
		$historyid = $_G['gp_historyid'];
		$tmp = DB::fetch_first("SELECT * FROM " . linemod::TABLE_NAME . " WHERE `" . linemod::_ID . "` = {$historyid}");
		if(!$tmp){
			cpmsg("参数错误，请返回列表页重新选择", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'error');
		}
		require_once dirname(__FILE__) . '/model/historymod.php';
		$q = DB::query("SELECT * FROM " . historymod::_TABLE . " WHERE `" . historymod::_LINEID . "` = " . $historyid . " ORDER BY `" . historymod::_TIME . "` DESC LIMIT {$start},{$limit}");
		while($v = DB::fetch($q)){
			$v['showtime'] = date('Y-m-d H:i:s', $v[historymod::_TIME]);
			$v['lineurl'] = $tmp[linemod::_URL];
			$v['linename'] = $tmp[linemod::_NAME];
			$v['linepos'] = linemod::$pos_type[$v[historymod::_LINEPOS]];
			$v['actiontype'] = "<font color='" . ($v[historymod::_USERSELECT] == 1 ? 'green' : 'red') . "'>" . historymod::$statusnamearr[$v[historymod::_USERSELECT]] . "</font>";
			$v['uid'] = $v[historymod::_UID];
			$v['ip'] = $v[historymod::_IP];
			$useridarr[] = $v[historymod::_UID];
			$datalist[] = $v;
		}
		if($useridarr){
			$query = DB::query("SELECT username, uid FROM " . DB::table('common_member') . " WHERE uid IN(" . implode(',', $useridarr) .")");
			while($value = DB::fetch($query)){
				$usernamearr[$value['uid']] = $value['username'];
			}
			$tmp = historymod::getAllCount(array($historyid));
			$maxcount = intval($tmp[$historyid]);
			$multi = multi($maxcount, $limit, $page, "/admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=history&historyid={$historyid}");
		}
		include template('interests:history');
		break;
	case 'openclose':
		$nowid = intval($_G['gp_ocid']);
		$nowinfo = DB::fetch_first("SELECT * FROM " . linemod::TABLE_NAME . " WHERE `" . linemod::_ID . "` = {$nowid} AND `" . linemod::_STATUS . "` <= 1");
		if(!$nowinfo){
			cpmsg("参数错误，返回列表页重新选择", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'error');
		}
		DB::update(linemod::TABLE_NAME_NOPRE, array(linemod::_STATUS => $nowinfo[linemod::_STATUS] == 0 ? 1 : 0), array(linemod::_ID => $nowinfo[linemod::_ID]));
		//memory('rm', 'plugin_lineinfo_' . $nowinfo[linemod::_POS] . '_time_' . $todayend);
		$myredis->EXPIRE('plugin_lineinfo_' . $nowinfo[linemod::_POS] . '_time_' . $todayend, 0);
		$myredis->EXPIRE("plugin_interests_user_sended_today_{$todaystart}_lineid_{$nowid}", 0);
		//if(DB::affected_rows() > 0){
			cpmsg("状态变化完毕，即将跳转到列表页", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'succeed');
		//}else{
			//cpmsg("状态变化失败，请返回列表页重新操作", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list", 'error');
		//}
		break;
	default:
		$showcolor = array(0 => 'red', 1 => 'green', 2 => '#525F69');
		require_once dirname(__FILE__) . '/model/historymod.php';
		$showarr = linemod::getAllLine($limit, $start, linemod::_TIME_CREATE . " DESC");
		$maxcount = linemod::getMaxCount();
		if($showarr){
			$idarr = array_keys($showarr);
			$allcount = historymod::getClickedCount($idarr, false);
			$clickcount = historymod::getClickedCount($idarr);
			$multi = multi($maxcount, $limit, $page, "/admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=linemanagerment&method=list");
		}
		$tuisongtimearr = array();
		foreach(linemod::$tuisongday as $vvv){
			$tuisongtimearr[$todaystart + $vvv * 24 * 3600] = $vvv;
		}
		include template('interests:list');
		break;
}