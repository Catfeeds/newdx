<?php

/**
 *  �������̵�������
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_shop_region()
{
    require_once libfile('dianping/modlist_shop', 'class');
    $list_obj = new modlist_shop();
    //��ȡ�����̳�Ʒ������
    $arr_region=$list_obj->getregion();
	memory('set', 'dp_shop_region', $arr_region, 86400);
}

?>
