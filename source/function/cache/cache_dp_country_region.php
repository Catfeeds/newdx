<?php

/**
 *  ����Ǳˮ�б�ҳ����
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_country_region()
{
    include_once libfile('dianping/zone', 'class');
    $foreigndb = new zone();
    //  ����ʡ������Ϣ��ȡ
    $regionList = $foreigndb->get_region(0, 2);
    // �����⣩������Ϣ��ȡ
    $foreign_countrys = $foreigndb->get_foreign('codeid', 'cityname');
    //��һ�ξ���ѭ�����˻�ȡ�е������ݵĹ���ʡ���б�
    $countries = $regionList + $foreign_countrys;
    memory('set', 'dp_country_region', $countries, 86400);
}

?>
