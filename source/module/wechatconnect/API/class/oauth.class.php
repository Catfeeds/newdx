<?php
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once WECHAT_CONNECT . '/API/class/recorder.class.php';
require_once WECHAT_CONNECT . '/API/class/url.class.php';

class Oauth {
	public $recorder;
	public $url;
	/*
	https://open.weixin.qq.com/connect/qrconnect?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
	*/

	const GET_AUTHORIZATION_URL = 'https://open.weixin.qq.com/connect/qrconnect';
	const GET_ACCESS_TOKEN_URL = 'https://api.weixin.qq.com/sns/oauth2/access_token';	//通过code换取access_token、refresh_token和已授权scope
	const REFRESH_TOKEN_URL = 'https://api.weixin.qq.com/sns/oauth2/refresh_token';	//刷新或续期access_token使用
	//refresh_token拥有较长的有效期（30天），当refresh_token失效的后，需要用户重新授权，所以，请开发者在refresh_token即将过期时（如第29天时），进行定时的自动刷新并保存好它。
	const AUTH_TOKEN_URL = 'https://api.weixin.qq.com/sns/auth';	//检查access_token有效性
	const GET_USERINFO_URL = 'https://api.weixin.qq.com/sns/userinfo';	//获取用户个人信息

	function __construct() {
		$this->recorder = new Recorder();
		$this->url = new Url();
	}

	function wechat_login() {
		$appid = $this->recorder->readInc('appid');
		$response_type = $this->recorder->readInc('response_type') ? $this->recorder->readInc('response_type') : 'code';
		$redirect_uri = $this->recorder->readInc('callback');
		/*用于第三方应用防止CSRF攻击，成功授权后回调时会原样带回*/
		$state = md5(uniqid(rand()));
		$this->recorder->write('state', $state);

		$params = array(
			'appid' => $appid,
            'redirect_uri' => $redirect_uri,
			'response_type' => $response_type,
			'scope' => 'snsapi_login',
			'state' => $state
			);
		$login_request_url = $this->url->build_url(self::GET_AUTHORIZATION_URL, $params) .'#wechat_redirect';
		header("Location: {$login_request_url}");
	}

	//验证成功，回调地址
	public function wechat_callback($back_state) {

		$state = $this->recorder->read('state');

		if(! $back_state || ! $state || $state != $back_state) {
			exit('State code exception!');
		}

		$appid = $this->recorder->readInc('appid');
		$client_secret = $this->recorder->readInc('client_secret');
		$paramsArr = array(
            'appid' => $appid,
            'secret' => $client_secret,
            'code' => $_GET['code'],
            'grant_type' => 'authorization_code',
        );

		$request_url = $this->url->build_url(self::GET_ACCESS_TOKEN_URL, $paramsArr);
		$content = $this->url->make_request($request_url);

		/*
		{
			"access_token":"ACCESS_TOKEN", //接口调用凭证
			"expires_in":7200, //access_token接口调用凭证超时时间，单位（秒）
			"refresh_token":"REFRESH_TOKEN", //用户刷新access_token
			"openid":"OPENID", //授权用户唯一标识
			"scope":"SCOPE", //用户授权的作用域，使用逗号（,）分隔 snsapi_base=基础接口 snsapi_userinfo=获取用户个人信息
			"unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL" //当且仅当该网站应用已获得该用户的userinfo授权时，才会出现该字段。
		}
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
