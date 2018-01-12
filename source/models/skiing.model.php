<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once 'dianpingmod.model.php';
Class SkiingModel extends DianpingmodModel{
	var $table = 'dianping_skiing_info';
	var $prikey = 'id';
	var $alias = 'ski';
	var $_moduleid = 'skiing';
	/*var $_vars = array(
		'pk' => 'kid',
		'tid' => 'tid',
		'name' => 'kName',
		'pic' => 'kPic',
		'pro' => 'kProvince',
		'address' => 'kAddress',
		'url' => 'kUrl',
		'phone' => 'kLink',
		'enable' => 'ispublish',
		'serverid' => 'serverid',
		'orderby' => 'orderby',
		'mapx' => 'longitude',
		'mapy' => 'latitude',
		'score' => 'score',
		'num' => 'cnum',
		'lastrate' => 'lastrate',
		'lastscore' => 'lastscore',
	);*/
    var $_vars = array(
        'pk' => 'id',//
        'tid' => 'tid',
        'name' => 'subject',//
        'pic' => 'showimg',//
        'pro' => 'provinceid',//
        'address' => 'addr',//
        'url' => 'url',//
        'phone' => 'tel',//
        'enable' => 'ispublish',
        'serverid' => 'serverid',
        'orderby' => 'displayorder',//
        'mapx' => 'lon',//
        'mapy' => 'lat',//
        'posttime' => 'dateline',//
        'score' => 'score',
        'num' => 'cnum',
        'lastrate' => 'lastrate',
        'lastscore' => 'lastscore',
        'dgurl' =>'dgurl',
    );
}

?>
