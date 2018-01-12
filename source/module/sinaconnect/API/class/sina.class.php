<?php
session_start();
require_once SINA_CONNECT . '/API/class/oauth.class.php';

class Sina extends Oauth {
	private $apiList;
	private $requestParameters;
	function __construct() {
		parent::__construct();
		$this->requestParameters = array(
				'access_token' => $this->recorder->read('bind_info/access_token'),
			);
		$this->apiList = array(
			'user_show' => array(
					'https://api.weibo.com/2/users/show.json',
					array(
						'uid' => $this->recorder->read('bind_info/uid'),
						),
					'GET', 
					'JSON'
				),
			);
	}

	function __call($api, $params) {
		if(! $this->apiList[$api])  {
			error_log('Sina: call undefined API, ' . $api);
			return false;
		}
		$api_url = $this->apiList[$api][0];
		$api_params = $this->apiList[$api][1] + $params;
		$api_method = $this->apiList[$api][2];
		$api_format = $this->apiList[$api][3];
		if($api_format == 'JSON') {
			return  json_decode($this->_callAPI($api_url, $api_params, $api_method));
		}
		else{
			return $this->_callAPI($api_url, $api_params, $api_method);
		}
		
	}

	private function _callAPI($api_url, $api_params, $api_method='GET') {
		foreach ((array)$api_params as $key => $value) {
			$this->requestParameters[$key] = $value;
		}

		if($api_method == 'GET') {
			return $this->url->get($api_url, $this->requestParameters);
		}
		else {
			//to do
		}
	}

}