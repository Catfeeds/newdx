<?php

/**
 * 榜单文章自动生成url数据源
 * @author gtl 20160315
 */
set_time_limit(0);
define('DISCUZ_ROOT', dirname(__FILE__) . '/');
require DISCUZ_ROOT . 'source/class/class_core.php';
require DISCUZ_ROOT . 'source/function/function_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

#榜单数据环境
require DISCUZ_ROOT . './config/config_dianping.php';
include_once libfile('function/home');
include_once libfile('function/cloud');
include_once libfile('function/dianping');
#缓存加载
$cachelist = array(
	'dp_equipment_brandlist', //户外用品店
	'dp_country_region', //品牌
	'dp_shop_region', //户外店
	'dp_line_region', //线路
);
loadcache($cachelist);
$urls = array(); //用来存储生成的url
$empty_array = array(0 => array(0));
$empty_array2 = array(0);

#####################################################################################
# 户外用品库：http://www.8264.com/zhuangbei-类型-类型子类-品牌-排序-分页-价格.html		#
#####################################################################################
//数据源
$zb_category = $dp_category['equipment']['category']; //装备类型
$zb_price = array('', '-0-100', '-100-500', '-500-1000', '-1000-2000', '-2000-3000', '-3000-4000', '-4000-5000', '-5000-0'); //装备价格
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
$zb_brand = array_intersect_key($zb_brandlist, $eq); //装备品牌
$zb_order = array(1, 4); //排序[热度 评分]

//数据格式化
foreach ($zb_category as $key => $value) {
	$zb_category[$key] = array_merge($empty_array2, array_keys($value['child']));
}
$zb_category+=$empty_array;
$zb_brand+=$empty_array;

//url拼接
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
# 户外品牌：http://www.8264.com/pinpai-0-品牌国籍-排行榜-排序-1						#
#####################################################################################
//数据源
$pp_nats = $dp_category['brand']['region']; //品牌国籍;
$pp_cps = $dp_category['brand']['ranklist'];  //排行榜;
$pp_order = array(2, 3); //排序[热度 评分]

//数据格式化
$pp_nats+=$empty_array2;
$pp_cps+=$empty_array2;

//url拼接
foreach ($pp_nats as $nid => $nname) {
	foreach ($pp_cps as $cid => $cname) {
		foreach ($pp_order as $key => $order_type) {
			$urls['brand'][] = "http://www.8264.com/pinpai-0-{$nid}-{$cid}-{$order_type}-1";
		}
	}
}

#####################################################################################
# 户外店：http://www.8264.com/dianpu-所在地域-所在城市-分类-0-品牌-排序-1				#
#####################################################################################
////数据源
//$arr_region = $_G['cache']['dp_shop_region'];
//$shop_region[] = 0;
//
////格式化
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
# 线路：http://www.8264.com/xianlu-线路类型-线路时长-省份-城市-排序-1					#
#####################################################################################
//数据源
$xl_prolist = $_G['cache']['dp_line_region']['onlypro'];
$xl_cate_type = $dp_category['line']['type'];
$xl_order = array(1,2);

//数据格式化
$xl_cate_type = $xl_cate_type+$empty_array2;
foreach($xl_prolist as $pid=>$citys){
	$xl_prolist[$pid] = $citys+$empty_array2;
}
$xl_prolist = $xl_prolist+$empty_array;

//url拼接
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



