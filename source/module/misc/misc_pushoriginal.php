<?php
//推送原创内容到百度

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

/**
 *
 *  百度接口返回值说明
 *  ------------------
	success	是	int	成功推送的url条数
	remain	是	int	当天剩余的可推送url条数
	not_same_site	否	array	由于不是本站url而未处理的url列表
	not_valid	否	array	不合法的url列表
	------------------
	error	是	int	错误码，与状态码相同
	message	是	string	错误描述
 */
if($_G['groupid'] ==1 && $_GET['url'] && stristr($_GET['url'], '8264.com') !== false) {
	$url_hash = md5($_GET['url']);
	$is_pushed = DB::result_first("SELECT id FROM ".DB::table('plugin_pushoriginal')." WHERE md5='$url_hash'");
	if($is_pushed > 0) {
		echo '{"error":410, "message":"此地址推送过了"}';exit;
	}

	$api = 'http://data.zz.baidu.com/urls?site=http://www.8264.com/&token=HmPYx1L8wxnNfo6e&type=original';
	$ch = curl_init();
	$options =  array(
		CURLOPT_URL => $api,
		CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => $_GET['url'],
		CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
	);
	curl_setopt_array($ch, $options);
	$result = curl_exec($ch);

	$data = json_decode($result);
	if($data->success == 1) {
		//入库记录
		DB::query("INSERT INTO ".DB::table("plugin_pushoriginal")." SET `md5`='$url_hash', `url`='$_GET[url]', `uid`='$_G[uid]', `dateline`='".time()."'");
	}

	echo $result;exit;
}
