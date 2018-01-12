<?php
/**
 *  装备点评筛选品牌列表缓存
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_equipment_brandlist()
{
	$query = DB::query("SELECT id,subject,tid,letter FROM ".DB::table('dianping_brand_info')." WHERE ispublish=1 ORDER BY cnum DESC");
	while ($row = DB::fetch($query)) {
		$brandlist[$row['id']] = $row;
	}

	memory('set', 'dp_equipment_brandlist', $brandlist, 259200);
}

?>
