<?php
$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
$mobile_type = checkmobile();
// echo $useragent;
// echo "<hr/>";
// echo $mobile_type;
// die();
if(isset($_GET['info'])){
	$mobile_type = false;
}

if($mobile_type === 'iphone'){
	header("Location: http://itunes.apple.com/app/8264/id492167976?mt=8");
	die();
} elseif ($mobile_type === 'android'){
	header("Location: http://image.8264.com/app/8264v3New.apk");
	die();
} else {
// 	echo $mobile_type;
// 	echo "<hr/>";
// 	echo $useragent;
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    <title>8264手机客户端 下载</title>
	<style type="text/css">
	.d_link { text-align: center; color: #454545;}
	.d_link a { text-decoration: none; text-align: center; font-size: medium; width: 60%; padding: 10px 0; margin: 20px auto; border-radius: 3px; display: block; color: #fff;}
	.i_btn { background-color: #646464; }
	.a_btn { background-color: #669966; }
	</style>
</head>
<body>

<div class="d_link">
	<h3>8264 手机客户端下载</h3>
	<a href="http://itunes.apple.com/app/8264/id492167976?mt=8" class="i_btn">iPhone 版下载</a>
	<a href="http://image.8264.com/app/8264v3New.apk" class="a_btn">Android 版下载</a>
	<?php if(isset($_GET['info'])){ ?>
	<p><?= $mobile_type; ?></p>
	<p><?= $useragent; ?></p>
	<?php } ?>
</div>

</body>
</html>

<?php
	die();
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