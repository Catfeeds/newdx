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

//�ж���վ��ҳ
$is_site_index = true;

$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['portal']);
if(!$navtitle) {
	$navtitle = $_G['setting']['navs'][1]['navname'];
} else {
	$nobbname = true;
}

$pageTitle = "8264רҵ�Ļ����˶��ۺ�ƽ̨ - ����������8264.com";

$metakeywords = $_G['setting']['seokeywords']['portal'];
if(!$metakeywords) {
	$metakeywords = $_G['setting']['navs'][1]['navname'];
}

$metadescription = $_G['setting']['seodescription']['portal'];
if(!$metadescription) {
	$metadescription = $_G['setting']['navs'][1]['navname'];
}

//�õ�tids��pids
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

	/*�޸��������а񲿷֣����а񲿷ֽ�ֱ�ӵ����ѯ*/
	if($field == "tid"){
 		$dianpingList = $mod->getRank($limit);
	}elseif($field == "pid"){
		$dianpingList = $mod->getNewDianping($limit, $needpic);
	}

	return $dianpingList;
}

//��ҳƷ���б�
require_once DISCUZ_ROOT.'./source/plugin/dianping/dianping.fun.php';

$arrMd = array(
	"mdForumPost" => m('forum_post'),
	"mdEquipment" => m('equipment'),
	"mdSkiing" 	  => m('skiing'),
	"mdMountain"  => m('mountain'),
	"mdLine" 	  => m('line'),
);

//װ���б���ҳ�ײ���
$eqdiList = getcommons("equipment", 'tid', 8, $arrMd);

//��ѩ���б���ҳ�ײ���
$skidiList = getcommons("skiing", 'tid', 8, $arrMd);

//��·�б���ҳ�ײ���
$linediList = getcommons("line", 'tid', 8, $arrMd);

//ɽ���б���ҳ�ײ���
$mountainList = getcommons("mountain", 'tid', 8, $arrMd);

$isShouYe = true;

//��ҳ �μ� �������е�
$place_array = array("�Ĺ���ɽ","�书ɽ","��̨ɽ","����","����","�Ƕ�","��̫","���","����","����","����","�걣����","�Ⲽ��","�ຣ��","����ѩɽ");

$keyname = "cache_shouye_youji_place";
$place_result = memory('get', $keyname);

if(!$place_result || ($_G['gp_nocache'] == 1 && $_G['groupid'] == 1) ){
	$place_result = array();
	foreach($place_array as $v){
		$place = $v;
		$v = str_replace(array('�书ɽ','��̫','���','�걣����', '�Ⲽ��'), array('�书ɽ�羰��','��ɽ','�����','�걣������', '�Ⲽ��ɳĮ'), $v);
		$sql = "select count(*) as actnum, placeid, level from ".DB::table('forum_travelread_tid_place')." where name ='$v'".getSlaveID();
		$query = DB::query($sql);
		$row = DB::fetch($query);
		$place_result[$place]['placeid'] = $row['placeid'];
		$place_result[$place]['actnum'] = $row['actnum'];
		$place_result[$place]['level'] = $row['level'];
	}

	memory('set', $keyname, $place_result, 60 * 60 * 1);
}

//��ҳ ��· ����б�
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

//��ҳ ��· �Ҳ���ĩ��б� ����ip��ȡplaceinfo��Ϣ
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

//��ҳ ��· �Ҳ���ĩ�
$params = array(
	'appname' => $appname,
	'app' => 'search',
	'act' => 'recommend_5',
	'qt' => time(),
	'place' => json_encode( iconv_array($currcity, 'GBK', 'UTF-8') )
);

$xl_result_right = get_hd_data($params, $appsecret, "cache_shouye_xianlu_right_list_".$currcity['id'], 7200);

//��ҳ ��· �Ҳ�ײ� �����淨
$cate_array = array('ͽ��','��Ӱ','��ѩ','��ѵ','��ѩɽ','����','Ǳˮ','Ư��','����','¶Ӫ','����','����ɡ', 'ԽҰ��', '�߶���', '�����', '��', '���');
$params = array(
	'appname' => $appname,
	'app' => 'search',
	'act' => 'recommend_7',
	'qt' => time(),
	'cate' => json_encode( iconv_array($cate_array, 'GBK', 'UTF-8') )
);

$xl_result_right_bottom = get_hd_data($params, $appsecret, "cache_shouye_xianlu_right_bottom_cate", 7200);

//��ҳ �ʴ𡤵���
require DISCUZ_ROOT . '/source/function/function_discuzcode.php';
require DISCUZ_ROOT . '/source/function/function_readmodelTravel.php';
require DISCUZ_ROOT . '/source/function/function_question.php';

$question_list = getQuestionList();

include_once template('diy:portal/index');

?>
