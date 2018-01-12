<?php

/**
 *  点评滑雪场最新滑雪场缓存
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_skiing_sidebar_new()
{
	require_once libfile('dianping/modlist', 'class');
	$list_obj = new modlist();

	$sidebar_new = $list_obj->getlist('skiing', 'dateline', 'ispublish=1', 0, 6, 'id desc');
	memory('set', 'dp_skiing_sidebar_new', $sidebar_new, 259200);
}

?>
