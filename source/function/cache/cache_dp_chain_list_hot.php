<?php

/**
 *  点评产品供应链列表页边栏
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_chain_list_hot()
{
    require_once libfile('dianping/modlist', 'class');
    $list_obj = new modlist;
    $sidebar_list_hot = $list_obj->getlist('chain', '', 'ispublish=1', 0, 4, 'cnum desc, score desc');
    memory('set', 'dp_chain_list_hot', $sidebar_list_hot, 86400);
}

?>
