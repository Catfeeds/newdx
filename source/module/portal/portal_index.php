<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: portal_index.php 16700 2010-09-13 05:46:20Z wangjinbo $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//判断网站首页
$is_site_index = true;

$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['portal']);
if(!$navtitle) {
	$navtitle = $_G['setting']['navs'][1]['navname'];
} else {
	$nobbname = true;
}

$pageTitle = "8264专业的户外运动综合平台 - 户外资料网8264.com";

$metakeywords = $_G['setting']['seokeywords']['portal'];
if(!$metakeywords) {
	$metakeywords = $_G['setting']['navs'][1]['navname'];
}

$metadescription = $_G['setting']['seodescription']['portal'];
if(!$metadescription) {
	$metadescription = $_G['setting']['navs'][1]['navname'];
}

//得到tids，pids
function getcommons($module, $field, $limit=5, $arrMd){
	global $_G;
	$dianpingList = array();

	extract($arrMd);
	$needpic = false;
	if ($module == "equipment") {
		$mod 	  = $mdEquipment;
		$needpic = true;
		$tempName = "subject";
	} elseif ($module == "mountain") {
		$mod 	  = $mdMountain;
		$tempName = "subject";
	} elseif ($module == "skiing") {
		$mod 	  = $mdSkiing;
		$tempName = "subject";
	}elseif ($module == "line") {
		$mod 	  = $mdLine;
		$tempName = "subject";
	}

	$fid    = !empty($_G["config"]['fids'][$module]) ? $_G["config"]['fids'][$module] : "";
	if (empty($fid)) {return array();}

	/*修改下面排行榜部分，排行榜部分将直接单表查询*/
	if($field == "tid"){
 		$dianpingList = $mod->getRank($limit);
	}elseif($field == "pid"){
		$dianpingList = $mod->getNewDianping($limit, $needpic);
	}

	return $dianpingList;
}

//首页品牌列表
require_once DISCUZ_ROOT.'./source/plugin/dianping/dianping.fun.php';

$arrMd = array(
	"mdForumPost" => m('forum_post'),
	"mdEquipment" => m('equipment'),
	"mdSkiing" 	  => m('skiing'),
	"mdMountain"  => m('mountain'),
	"mdLine" 	  => m('line'),
);

//装备列表（首页底部）
$eqdiList = getcommons("equipment", 'tid', 8, $arrMd);

//滑雪场列表（首页底部）
$skidiList = getcommons("skiing", 'tid', 8, $arrMd);

//线路列表（首页底部）
$linediList = getcommons("line", 'tid', 8, $arrMd);

//山峰列表（首页底部）
$mountainList = getcommons("mountain", 'tid', 8, $arrMd);

$isShouYe = true;

//首页 游记 热门旅行地
$place_array = array("四姑娘山","武功山","五台山","贡嘎","拉萨","亚丁","鳌太","雨崩","阿里","丽江","甘南","年保玉则","库布齐","青海湖","哈巴雪山");

$keyname = "cache_shouye_youji_place";
$place_result = memory('get', $keyname);

if(!$place_result || ($_G['gp_nocache'] == 1 && $_G['groupid'] == 1) ){
	$place_result = array();
	foreach($place_array as $v){
		$place = $v;
		$v = str_replace(array('武功山','鳌太','雨崩','年保玉则', '库布齐'), array('武功山风景区','鳌山','雨崩村','年保玉则景区', '库布齐沙漠'), $v);
		$sql = "select count(*) as actnum, placeid, level from ".DB::table('forum_travelread_tid_place')." where name ='$v'".getSlaveID();
		$query = DB::query($sql);
		$row = DB::fetch($query);
		$place_result[$place]['placeid'] = $row['placeid'];
		$place_result[$place]['actnum'] = $row['actnum'];
		$place_result[$place]['level'] = $row['level'];
	}

	memory('set', $keyname, $place_result, 60 * 60 * 1);
}

//首页 线路 左侧列表
global $_G;
$appname = $_G['config']['hdapikey']['8264com']['appname'];
$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
$params = array(
	'appname' => $appname,
	'app' => 'search',
	'act' => 'recommend_4',
	'qt' => time(),
	'xl_nums' => 6
);

$xl_result_left = get_hd_data($params, $appsecret, "cache_shouye_xianlu_left_list", 7200);

$xl_result_left_one = array_slice($xl_result_left, 0, 2);
foreach($xl_result_left_one as $k=>$v){
	if($v['goods_id']){
		$xl_result_left_one[$k]['default_image'] = str_replace('_1_1', '_2_1', $v['default_image']);
	}
}
$xl_result_left_two = array_slice($xl_result_left, 2, 6);


/*$params = array(
	'appname' => $appname,
	'app' => 'search',
	'act' => 'recommend_goods',
	'qt' => time(),
	'goods_id' => 5143
);

$xl_insert_data = get_hd_data($params, $appsecret, "cache_shouye_xianlu_insert_data", 7200);

if(is_array($xl_insert_data)){
	$insert_arr = array(
		'goods_id' => $xl_insert_data['goods_id'],
		'title' => $xl_insert_data['title'],
		'price' => number_format($xl_insert_data['price'], 0, '', ''),
		'store_name' => $xl_insert_data['store_name'],
		'cate_id' => explode(',', trim($xl_insert_data['cate_id'], ','))[0],
		'cate_name' => explode(',', trim($xl_insert_data['cate_name'], ','))[0],
		'start_place' => explode(',', trim($xl_insert_data['start_place'], ','))[0],
		'goods_spec' => array(
			'M' => explode(' ', date("M m d", $xl_insert_data['last_start_time']))[0],
			'm' => explode(' ', date("M m d", $xl_insert_data['last_start_time']))[1],
			'd' => explode(' ', date("M m d", $xl_insert_data['last_start_time']))[2]
		),
		'default_image' => "http://img.qunawan.com/".$xl_insert_data['default_image']
	);
}

if(!empty($insert_arr)){
	$insert_flag = 1;
	foreach($xl_result_left_two as $k=>$v){
		if($v['goods_id'] == '5143'){
			$insert_flag = 0;
		}
	}

	if($insert_flag){
		array_splice($xl_result_left_two, 0, 0, array($insert_arr));
	}
}
*/
$xl_result_left_two = array_slice($xl_result_left_two, 0, 4);

unset($xl_result_left);

//首页 线路 右侧周末活动列表 根据ip获取placeinfo信息
require_once DISCUZ_ROOT.'./source/plugin/components/ipdata/ipdata.php';
if($_G['uid'] == 1 && $_GET['ip']){
	$place = _convertip($_GET['ip']);
}else{
	$place = _convertip($_G['clientip']);
}

$params = array(
	'appname' => $appname,
	'app' => 'search',
	'act' => 'recommend_6',
	'qt' => time(),
	'id' => 1
);
$prolist = get_hd_data($params, $appsecret, "cache_shouye_xianlu_common_area_1", 86400);
foreach ($prolist as $pro) {
	$imhere = strpos($place, $pro['name']);
	if ($imhere !== false) {
		$currpro = $pro;
		if(!in_array($pro['id'], array(2,3,4,5))){
			$place = substr_replace($place, '', $imhere, strlen($pro['name']));
		}
		break;
	}
}

if(empty($currpro)){
	$currpro = $prolist[2];
}else{
	$params = array(
		'appname' => $appname,
		'app' => 'search',
		'act' => 'recommend_6',
		'qt' => time(),
		'id' => $currpro['id']
	);
	$citylist = get_hd_data($params, $appsecret, "cache_shouye_xianlu_common_area_".$currpro['id'], 86400);
	foreach ($citylist as $city) {
		$imhere = strpos($place, $city['name']);
		if ($imhere !== false){
			$currcity = $city;
			break;
		}
	}
}

if(empty($currcity)){
	$currcity = $currpro;
}

//首页 线路 右侧周末活动
$params = array(
	'appname' => $appname,
	'app' => 'search',
	'act' => 'recommend_5',
	'qt' => time(),
	'place' => json_encode( iconv_array($currcity, 'GBK', 'UTF-8') )
);

$xl_result_right = get_hd_data($params, $appsecret, "cache_shouye_xianlu_right_list_".$currcity['id'], 7200);

//首页 线路 右侧底部 热门玩法
$cate_array = array('徒步','摄影','滑雪','培训','登雪山','包车','潜水','漂流','海钓','露营','攀岩','滑翔伞', '越野车', '高尔夫', '深度游', '向导', '射箭');
$params = array(
	'appname' => $appname,
	'app' => 'search',
	'act' => 'recommend_7',
	'qt' => time(),
	'cate' => json_encode( iconv_array($cate_array, 'GBK', 'UTF-8') )
);

$xl_result_right_bottom = get_hd_data($params, $appsecret, "cache_shouye_xianlu_right_bottom_cate", 7200);

//首页 问答·点评
require DISCUZ_ROOT . '/source/function/function_discuzcode.php';
require DISCUZ_ROOT . '/source/function/function_readmodelTravel.php';
require DISCUZ_ROOT . '/source/function/function_question.php';

$question_list = getQuestionList();

include_once template('diy:portal/index');

?>
