<?php
require_once SINA_CONNECT . '/API/class/recorder.class.php';
require_once SINA_CONNECT . '/API/class/url.class.php';

class Oauth {
	public $recorder;
	public $url;
	/*
	https://api.weibo.com/oauth2/authorize?client_id=YOUR_CLIENT_ID&amp;response_type=code&amp;redirect_uri=YOUR_REGISTERED_REDIRECT_URI
	https://api.weibo.com/oauth2/access_token?client_id=YOUR_CLIENT_ID&client_secret=YOUR_CLIENT_SECRET&grant_type=authorization_code
	*/

	const GET_AUTHORIZATION_URL = 'https://api.weibo.com/oauth2/authorize';
	const GET_ACCESS_TOKEN_URL = 'https://api.weibo.com/oauth2/access_token';

	function __construct() {
		$this->recorder = new Recorder();
		$this->url = new Url();
	}

	function sina_login() {
		$client_id = $this->recorder->readInc('appid');
		$response_type = $this->recorder->readInc('response_type') ? $this->recorder->readInc('response_type') : 'code';
		$redirect_uri = $this->recorder->readInc('callback');

		/*用于第三方应用防止CSRF攻击，成功授权后回调时会原样带回*/
		$state = md5(uniqid(rand()));
		$this->recorder->write('state', $state);

		$params = array(
			'client_id' => $client_id,
			'response_type' => $response_type,
			'redirect_uri' => $redirect_uri,
			'state' => $state
			);

		$login_request_url = $this->url->build_url(self::GET_AUTHORIZATION_URL, $params);
		header("Location: {$login_request_url}");
	}

	//authorize successfully, then sina_callbck is called
	public function sina_callback($back_state) {
		/*written into SESSION or array*/
		$state = $this->recorder->read('state');

		if(! $back_state || ! $state || $state != $back_state) {
			//$this->error->showErrMsg(20000);
			exit('State code exception!');
		}

		$client_id = $this->recorder->readInc('appid');
		$client_secret = $this->recorder->readInc('client_secret');
		$redirect_uri = $this->recorder->readInc('callback');
		$paramsArr = array(
				'grant_type' => 'authorization_code',
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				'code' => $_GET['code'],
				'redirect_uri' => $redirect_uri
			);
		/*		
		$request_url = $this->url->build_url(self::GET_ACCESS_TOKEN_URL, $paramsArr);
		$content = $this->url->make_request($request_url);
		*/

		//POST is a must
		//{"error":"invalid_request","error_code":21323,"request":"/oauth2/access_token","error_uri":"/oauth2/access_token","error_description":"miss client id or secret"}
		//$content = $this->url->post(self::GET_ACCESS_TOKEN_URL, $paramsArr);

		$post_url = $this->url->build_url(self::GET_ACCESS_TOKEN_URL, $paramsArr);
		$content = $this->url->post($post_url, '');

		/*if(strpos($content, 'callback') !== false) {
			$lpos = strpos($content, '(');
			$rpos = strrpos($content, ')');
			$json_content = substr($content, $lpos + 1, $rpos- $lpos - 1);
			$msg = json_decode($json_content);

			if(isset($msg->error)) {
				//$this->error->showErrMsg($msg->error, $msg->error_description);
			}
		}*/

		/* {"access_token":"2.00JRXrNDEUqlXC9a59d67c2eqbsm_E","remind_in":"667060","expires_in":667060,"uid":"2953250163"}
			返回值字段 	字段类型 	字段说明
			access_token 	string 	用于调用access_token，接口获取授权后的access token。
			expires_in 	string 	access_token的生命周期，单位是秒数。
			remind_in 	string 	access_token的生命周期（该参数即将废弃，开发者请使用expires_in）。
			uid 	string 	当前授权用户的UID。
		*/
		$params = json_decode($content, true);

		//$access_token = $params['access_token'];

		$this->recorder->write('bind_info', $params);

		return $params;
	}

	function getInfo($info='access_token') {
		return $this->recorder->read($info);
	}
}