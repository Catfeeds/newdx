<?php
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class Recorder {

	private static $data;
	private $error;
	private $inc;

	function __construct() {
		require_once WECHAT_CONNECT . '/API/comm/inc.php';

		$this->inc = json_decode(str_replace('httphost', $_SERVER['HTTP_HOST'], $config));

		if(empty($_SESSION['WECHAT_UserData'])) {
			self::$data = array();
		}
		else {
			self::$data = $_SESSION['WECHAT_UserData'];
		}
	}

	//read element from configuration file.
	function readInc($element) {
		return $element ? $this->inc->$element : $this->inc;
	}

	/**/
	public function write($name, $value) {
		 //error_log("write $name: " .  'session_id: ' . session_id());
		self::$data[$name] = $value;
	}
	/**/
	public function read($name) {
		//error_log("read $name: " .  'session_id: ' . session_id());
		if(stripos($name, '/') === false) {
			return empty(self::$data[$name]) ? null : self::$data[$name];
		}
		else {
			list($k, $v) = explode('/', $name);
			return empty(self::$data[$k][$v]) ? null : self::$data[$k][$v];
		}
	}

	function __destruct() {
		//error_log('destruct: ' . session_id());
		$_SESSION['WECHAT_UserData'] = self::$data;
	}


}
