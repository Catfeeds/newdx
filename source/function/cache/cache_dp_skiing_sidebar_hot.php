<?php

/**
 *  点评滑雪场地区分类数量缓存
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_skiing_sidebar_hot()
{
	require_once libfile('dianping/modlist', 'class');
	$list_obj = new modlist();

	$sidebar_hot = $list_obj->getlist('skiing', '', 'ispublish=1', 0, 6, 'cnum desc');
	memory('set', 'dp_skiing_sidebar_hot', $sidebar_hot, 259200);
}

?>
