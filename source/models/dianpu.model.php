<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once 'Dianpingmod.model.php';
Class DianpuModel extends DianpingmodModel{
	var $table = 'plugin_shop_info';
	var $prikey = 'sid';
	var $alias = 'shp';
	var $_moduleid = 'dianpu';
	var $_vars = array(
		'pk' => 'sid',
		'tid' => 'tid',
		'name' => 'sName',
		'pic' => 'sPic',
		'pro' => 'sRegion',
		'address' => 'sAddress',
		'phone' => 'link',
		'enable' => 'ispublish',
		'serverid' => 'serverid',
		'orderby' => 'orderby',
		'mapx' => 'longitude',
		'mapy' => 'latitude',
		'score' => 'score',
		'num' => 'snum',
		);
}

?>