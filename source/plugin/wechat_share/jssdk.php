<?php

class JSSDK {

	private $appId;
	private $appSecret;
	private $dir_access_token;
	private $dir_jsapi_ticket;

	public function __construct($appId, $appSecret, $dir_access_token, $dir_jsapi_ticket) {
		$this->appId = $appId;
		$this->appSecret = $appSecret;
		$this->dir_access_token = $dir_access_token;
		$this->dir_jsapi_ticket = $dir_jsapi_ticket;
	}

	public function getSignPackage() {
		$jsapiTicket = $this->getJsApiTicket();
		
		// 注意 URL 一定要动态获取，不能 hardcode.
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$timestamp = time();
		$nonceStr = $this->createNonceStr();

		// 这里参数的顺序要按照 key 值 ASCII 码升序排序
		$string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

		$signature = sha1($string);

		$signPackage = array(
			"appId" => $this->appId,
			"nonceStr" => $nonceStr,
			"timestamp" => $timestamp,
			"url" => $url,
			"signature" => $signature,
			"rawString" => $string
		);
		return $signPackage;
	}

	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	private function getJsApiTicket() {
		// jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
		$data = json_decode(file_get_contents($this->dir_jsapi_ticket."jsapi_ticket.json"));
		if ($data->expire_time < time()) {
			$accessToken = $this->getAccessToken();
			// 如果是企业号用以下 URL 获取 ticket
			// $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
			$res = json_decode($this->httpGet($url));
			$ticket = $res->ticket;
			if ($ticket) {
				$data->expire_time = time() + 7000;
				$data->jsapi_ticket = $ticket;
				$fp = fopen($this->dir_jsapi_ticket."jsapi_ticket.json", "w");
				fwrite($fp, json_encode($data));
				fclose($fp);
			}
			$this->sdk_log($ticket, 'jsapi_ticket_cache',1);
		} else {
			$ticket = $data->jsapi_ticket;
			$this->sdk_log($ticket, 'jsapi_ticket_cache',1);
		}
		return $ticket;
	}

	private function getAccessToken() {
		// access_token 应该全局存储与更新，以下代码以写入到文件中做示例
		$data = json_decode(file_get_contents($this->dir_access_token."access_token.json"));
		if ($data->expire_time < time()) {
			$param = array(
				'appname' => 'zaiwaiapp',
				'c' => 'authorize',
				'm' => 'wechat_token_8264',
				'qt' => time(),
			);
			$url = 'http://api.8264.com/openid/' . $this->build_url($param);
			$returnData = $this->httpGet($url);
			$res = json_decode($returnData, true);
			$access_token = $res['data']['wechat_token'];
			if ($access_token) {
				$data->expire_time = $res['data']['expires_time'];
				$data->access_token = $access_token;
				$fp = fopen($this->dir_access_token."access_token.json", "w");
				fwrite($fp, json_encode($data));
				fclose($fp);
			}
			$this->sdk_log($access_token, 'access_token_cache',1);
		} else {
			$access_token = $data->access_token;
			$this->sdk_log($access_token, 'access_token_cache',1);
		}
		return $access_token;
	}

	private function httpGet($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 500);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_URL, $url);

		$res = curl_exec($curl);
		curl_close($curl);
		return $res;
	}

	function sdk_log($msg,$filename,$line=0){
		return false;
		error_log($msg."\r\n",3,"./application/libraries/wechat_share/{$filename}.log");
		if($line){
			error_log("---------------------\r\n",3,"./application/libraries/wechat_share/{$filename}.log");
		}
	}

	function build_url($param) {
		ksort($param);
		reset($param);
		$str_q = http_build_query($param);
		$sign = md5($str_q . "VaKeCtYCo1");
		return '?' . $str_q . '&sign=' . $sign;
	}

}
