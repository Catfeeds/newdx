<?php

/**
 *  点评山峰详情页右侧热门山峰缓存
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_mountain_sidebar_hot()
{
	require_once libfile('dianping/modlist', 'class');
	$list_obj = new modlist();

	$sidebar_hot = $list_obj->getlist('mountain', '', 'ispublish=1', 0, 6, 'cnum desc');
	memory('set', 'dp_mountain_sidebar_hot', $sidebar_hot, 86400);
}

?>
