<?php

/**
 * �������Զ�����url����Դ
 * @author gtl 20160315
 */
set_time_limit(0);
define('DISCUZ_ROOT', dirname(__FILE__) . '/');
require DISCUZ_ROOT . 'source/class/class_core.php';
require DISCUZ_ROOT . 'source/function/function_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

#�����ݻ���
require DISCUZ_ROOT . './config/config_dianping.php';
include_once libfile('function/home');
include_once libfile('function/cloud');
include_once libfile('function/dianping');
#�������
$cachelist = array(
	'dp_equipment_brandlist', //������Ʒ��
	'dp_country_region', //Ʒ��
	'dp_shop_region', //�����
	'dp_line_region', //��·
);
loadcache($cachelist);
$urls = array(); //�����洢���ɵ�url
$empty_array = array(0 => array(0));
$empty_array2 = array(0);

#####################################################################################
# ������Ʒ�⣺http://www.8264.com/zhuangbei-����-��������-Ʒ��-����-��ҳ-�۸�.html		#
#####################################################################################
//����Դ
$zb_category = $dp_category['equipment']['category']; //װ������
$zb_price = array('', '-0-100', '-100-500', '-500-1000', '-1000-2000', '-2000-3000', '-3000-4000', '-4000-5000', '-5000-0'); //װ���۸�
$zb_brandlist = $_G['cache']['dp_equipment_brandlist'];
$condition_select_brand = 'i.ispublish=1 GROUP BY brandid';
$eq = memory('get', 'dp_equipment_brand_select_' . substr(md5($condition_select_brand), 0, 5));
if (!$eq) {
	$query = DB::query("SELECT brandid FROM " . DB::table('dianping_equipment_info') . " AS i WHERE $condition_select_brand ORDER BY id ASC " . getSlaveID());
	while ($row = DB::fetch($query)) {
		$eq[$row['brandid']] = $row['brandid'];
	}
	memory('set', 'dp_equipment_brand_select_' . substr(md5($condition_select_brand), 0, 5), $eq, 3600);
}
$zb_brand = array_intersect_key($zb_brandlist, $eq); //װ��Ʒ��
$zb_order = array(1, 4); //����[�ȶ� ����]

//���ݸ�ʽ��
foreach ($zb_category as $key => $value) {
	$zb_category[$key] = array_merge($empty_array2, array_keys($value['child']));
}
$zb_category+=$empty_array;
$zb_brand+=$empty_array;

//urlƴ��
foreach ($zb_category as $pid => $child) {
	foreach ($child as $$child_index => $cid) {
		foreach ($zb_brand as $bid => $binfo) {
			foreach($zb_order as $ordertype){
				foreach ($zb_price as $pindex => $pinfo) {
					$urls['equipment'][] = "http://www.8264.com/zhuangbei-{$pid}-{$cid}-{$bid}-{$ordertype}-1{$pinfo}.html";
				}
			}
		}
	}
}

#####################################################################################
# ����Ʒ�ƣ�http://www.8264.com/pinpai-0-Ʒ�ƹ���-���а�-����-1						#
#####################################################################################
//����Դ
$pp_nats = $dp_category['brand']['region']; //Ʒ�ƹ���;
$pp_cps = $dp_category['brand']['ranklist'];  //���а�;
$pp_order = array(2, 3); //����[�ȶ� ����]

//���ݸ�ʽ��
$pp_nats+=$empty_array2;
$pp_cps+=$empty_array2;

//urlƴ��
foreach ($pp_nats as $nid => $nname) {
	foreach ($pp_cps as $cid => $cname) {
		foreach ($pp_order as $key => $order_type) {
			$urls['brand'][] = "http://www.8264.com/pinpai-0-{$nid}-{$cid}-{$order_type}-1";
		}
	}
}

#####################################################################################
# ����꣺http://www.8264.com/dianpu-���ڵ���-���ڳ���-����-0-Ʒ��-����-1				#
#####################################################################################
////����Դ
//$arr_region = $_G['cache']['dp_shop_region'];
//$shop_region[] = 0;
//
////��ʽ��
//foreach ($arr_region as $proid => $cityinfo) { //$proid
//	$shop_region[$proid][0] = array(
//		'market' => array(),
//		'brand' => array()
//	);
//	foreach ($cityinfo['city'] as $key => $value) {
//		unset($value['cityname']);
//		$shop_region[$proid][$key] = $value;
//		!empty($value['market']) && ($shop_region[$proid][0]['market'] = $shop_region[$proid][0]['market']+$value['market']);
//	}
//}
//
//
//print_r($shop_region);
//var_dump($arr_region);

#####################################################################################
# ��·��http://www.8264.com/xianlu-��·����-��·ʱ��-ʡ��-����-����-1					#
#####################################################################################
//����Դ
$xl_prolist = $_G['cache']['dp_line_region']['onlypro'];
$xl_cate_type = $dp_category['line']['type'];
$xl_order = array(1,2);

//���ݸ�ʽ��
$xl_cate_type = $xl_cate_type+$empty_array2;
foreach($xl_prolist as $pid=>$citys){
	$xl_prolist[$pid] = $citys+$empty_array2;
}
$xl_prolist = $xl_prolist+$empty_array;

//urlƴ��
foreach ($xl_cate_type as $cid => $cname) {
	foreach ($xl_prolist as $pid => $citys) {
		foreach ($citys as $cid => $cinfo) {
			foreach ($xl_order as $key => $order_type) {
				$urls['line'][] = "http://www.8264.com/xianlu-{$cid}-0-{$pid}-{$cid}-{$order_type}-1";
			}
		}
	}
}

//sql
foreach ($urls as $key=>$type) {
	$insert_sql = array();
	$i = 0;
	foreach ($type as $url) {
		$k = intval($i/1000);
		$insert_sql[$k][] = "('{$url}', '{$key}')";
		$i++;
	}
	
	foreach ($insert_sql as $k1 => $v1) {
		$insert_sql[$k1] = "INSERT INTO ".DB::table('portal_bangdan_url_source')."(`url`,`type`) VALUES". implode(',', $v1).';';
	}

	file_put_contents(DISCUZ_ROOT . 'data/dlogs/sql_'.$key.'.sql', implode("\r", $insert_sql));
}



