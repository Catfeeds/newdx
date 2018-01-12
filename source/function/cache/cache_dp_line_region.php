<?php

/**
 *  点评线路地区数据
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_line_region()
{
    include_once libfile('dianping/zone', 'class');
    $zone = new zone();
    //获取线路line_region表的信息，与line_cross表的cityid对应匹配城市名称
    $lineregion = $zone->getlineregion();
    memory('set', 'dp_line_region', $lineregion, 86400);
}

?>
