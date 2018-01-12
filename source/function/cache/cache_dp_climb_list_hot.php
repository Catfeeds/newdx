<?php

/**
 *  µãÆÀÅÊÅÀÓÒ²àÈÈÃÅ
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_climb_list_hot()
{
    require_once libfile('dianping/modlist', 'class');
    $list_obj = new modlist;
    $sidebar_list_hot = $list_obj->getlist('climb', '', 'ispublish=1', 0, 4, 'cnum desc, score desc');
    memory('set', 'dp_climb_list_hot', $sidebar_list_hot, 86400);
}

?>
