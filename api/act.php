<?php

/**
 *  论坛活动新版接口
 */

//监测程序运行速度
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

require '../source/class/class_core.php';
require '../source/function/function_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

$time_start = microtime_float();

define("API_URL", "http://bbs.8264.com/api/activity.php");
define("ZAIWAI_API_URL", $_G['config']['zaiwaiapi']['url']);
define("ZAIWAI_API_TOKEN", $_G['config']['zaiwaiapi']['token']);

$location = $_GET['location'];//118.813408,32.116688

/*$result = requestRemoteData("http://api.map.baidu.com/geoconv/v1/?coords={$location}&from=3&to=5&ak=kPPtRU331p8sFr6ewML5sN53");
$result_data = json_decode($result, true);
$result_data = iconv_array($result_data, 'utf-8', 'gbk');
var_dump($result_data);
if (empty($result_data['status'])) {
	$result = requestRemoteData("http://api.map.baidu.com/geocoder/v2/?ak=kPPtRU331p8sFr6ewML5sN53&location={$result_data['result'][0]['y']},{$result_data['result'][0]['x']}&output=json");
	$result_data = json_decode($result, true);
	$result_data = iconv_array($result_data, 'utf-8', 'gbk');
	var_dump($result_data);
}*/

list($lng, $lat) = explode(',', $location);  

$lng = doubleval($lng);
$lat = doubleval($lat);

//echo "=={$lng}={$lat}";

$result = requestRemoteData("http://api.map.baidu.com/geocoder/v2/?ak=kPPtRU331p8sFr6ewML5sN53&location={$lat},{$lng}&output=json");
$result_data = json_decode($result, true);
$result_data = iconv_array($result_data, 'utf-8', 'gbk');
var_dump($result_data);

exit();




?>
