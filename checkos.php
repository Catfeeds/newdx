<?php
$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
$mobile_type = checkmobile();
// echo $useragent;

switch ($mobile_type){
	case 'iphone':
		header("Location: http://itunes.apple.com/app/8264/id492167976?mt=8");
		break;
	case 'android':
		header("Location: http://image.8264.com/app/8264v3New.apk");
		break;
	default:
		break;
}

function checkmobile() {
	global $useragent;
	$mobile = array();
	static $touchbrowser_list =array('iphone', 'android', 'phone', 'mobile', 'wap', 'netfront', 'java', 'opera mobi', 'opera mini',
			'ucweb', 'windows ce', 'symbian', 'series', 'webos', 'sony', 'blackberry', 'dopod', 'nokia', 'samsung',
			'palmsource', 'xda', 'pieplus', 'meizu', 'midp', 'cldc', 'motorola', 'foma', 'docomo', 'up.browser',
			'up.link', 'blazer', 'helio', 'hosin', 'huawei', 'novarra', 'coolpad', 'webos', 'techfaith', 'palmsource',
			'alcatel', 'amoi', 'ktouch', 'nexian', 'ericsson', 'philips', 'sagem', 'wellcom', 'bunjalloo', 'maui', 'smartphone',
			'iemobile', 'spice', 'bird', 'zte-', 'longcos', 'pantech', 'gionee', 'portalmmm', 'jig browser', 'hiptop',
			'benq', 'haier', '^lct', '320x320', '240x320', '176x220');
	static $mobilebrowser_list =array('windows phone');
	static $wmlbrowser_list = array('cect', 'compal', 'ctl', 'lg', 'nec', 'tcl', 'alcatel', 'ericsson', 'bird', 'daxian', 'dbtel', 'eastcom',
			'pantech', 'dopod', 'philips', 'haier', 'konka', 'kejian', 'lenovo', 'benq', 'mot', 'soutec', 'nokia', 'sagem', 'sgh',
			'sed', 'capitel', 'panasonic', 'sonyericsson', 'sharp', 'amoi', 'panda', 'zte');

	$pad_list = array('pad', 'gt-p1000');

	if(dstrpos($useragent, $pad_list)) {
		return 'pad';
	}
	if(($v = dstrpos($useragent, $mobilebrowser_list, true))){
		return $v;
	}
	if(($v = dstrpos($useragent, $touchbrowser_list, true))){
		return $v;
	}
	if(($v = dstrpos($useragent, $wmlbrowser_list))) {
		return $v;
	}
	$brower = array('mozilla', 'chrome', 'safari', 'opera', 'm3gate', 'winwap', 'openwave', 'myop');
	if($v = dstrpos($useragent, $brower)) return $v;

	return false;
}

function dstrpos($string, $arr, $returnvalue = false) {
	if(empty($string)) return false;
	foreach((array)$arr as $v) {
		if(strpos($string, $v) !== false) {
			$return = $returnvalue ? $v : true;
			return $return;
		}
	}
	return false;
}