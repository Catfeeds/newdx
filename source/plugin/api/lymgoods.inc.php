<?php
$location = intval($_GET['location']) ? intval($_GET['location']) : 0;
if (!$location) {
	echo json_encode(array('error' => 'cache no-data'));
	exit;
}
$data = memory('get', "lymgoodsad_{$location}");

if (!$data) {
	// 调取电商商品信息改为获取json格式 2014.11.26
	/*  传递的参数
		pl 调用平台 1为8264论坛版块，2为8264装备分享
		mall_num 调用商城平台的数量
		tuan_num 调用团购平台的数量
		app 调用app
		act 调用act
		app_id 身份id
	*/
	function build_url($params){
		$spt_token = "92e27b6cd4c1aba63f653420f63a80ab";//"4s3=zUwv";
		ksort($params);
		reset($params);
		$str_q = http_build_query($params);
		$sign = md5($str_q.$spt_token);
		return '?'.$str_q.'&sign='.$sign;

	}

	$data = urlencode("pl=2&mall_num=5&tuan_num=5");
	$args = array('app'=>'grelase','act'=>'getGoodsRelease','app_id'=>39431385,'nt'=>time(),'data'=>$data);
	$url = "http://www.7jia2.com/services.php".build_url($args);

	try{
		$data = file_get_contents($url);
		memory('set', "lymgoodsad_{$location}", $data, 3600 * 1);
	} catch (Exception $e) {
		$data = json_encode(array('error' => 'Failed to get data'));
	}
}
@header('Content-Type: text/html; charset=utf-8');
echo $data;
exit;
?>
