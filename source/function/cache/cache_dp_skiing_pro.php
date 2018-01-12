<?php

/**
 *  点评滑雪场地区分类数量缓存
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_skiing_pro()
{
	$region[0] = array('name'=>'中国','num'=>0);
	$count_num = 0;

	$query = DB::query("SELECT i.provinceid AS catid, count(*) AS num, r.name FROM ".DB::table('dianping_skiing_info')." AS i LEFT JOIN ".DB::table('dianping_shop_region')." AS r ON i.provinceid=r.catid WHERE i.ispublish=1 AND r.upid=0 GROUP BY i.provinceid ORDER BY num DESC");
	while ($row = DB::fetch($query)) {
		if($row['num']>0)
		{
			$region[$row['catid']]['num'] = $row['num'];
			$region[$row['catid']]['name'] = $row['name'];
		}
		$row['catid'] != '1430' ? $count_num += $row['num'] : '';
	}
	$region[0]['num'] = $count_num;
	memory('set', 'dp_skiing_pro', $region, 259200);
}

?>
