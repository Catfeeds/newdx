<?php

/**
 *  ������·��������
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_line_region()
{
    include_once libfile('dianping/zone', 'class');
    $zone = new zone();
    //��ȡ��·line_region�����Ϣ����line_cross���cityid��Ӧƥ���������
    $lineregion = $zone->getlineregion();
    memory('set', 'dp_line_region', $lineregion, 86400);
}

?>
