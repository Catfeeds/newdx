<?php

/**
 *  点评潜水列表页边栏
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_country_region()
{
    include_once libfile('dianping/zone', 'class');
    $foreigndb = new zone();
    //  国内省及市信息读取
    $regionList = $foreigndb->get_region(0, 2);
    // （国外）国家信息读取
    $foreign_countrys = $foreigndb->get_foreign('codeid', 'cityname');
    //用一次精简循环过滤获取有点评内容的国内省市列表
    $countries = $regionList + $foreign_countrys;
    memory('set', 'dp_country_region', $countries, 86400);
}

?>
