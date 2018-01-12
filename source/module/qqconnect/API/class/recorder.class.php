<?php
class Recorder {
	private static $data;
	private $inc;
	private $error;

	function __construct() {

        require_once QQCONNECT . '/API/comm/inc.php';


		$this->inc = json_decode(str_replace('httphost', $_SERVER['HTTP_HOST'], $config));

		if(empty($this->inc)) {
			//can not get config content
			showmessage('configuration_file_empty', $_SESSION['connect_referer']);
		} 

		if(empty($_SESSION['QC_UserData'])) {
			self::$data = array();
		}
		else {
			self::$data = $_SESSION['QC_UserData'];
		}
	}
	/*read value from configuration file*/
	public function readInc($name) {	
		return $this->inc->$name;
	}
	/**/
	public function write($name, $value) {
		 //error_log("write $name: " .  'session_id: ' . session_id());
		self::$data[$name] = $value;
	}
	/**/
	public function read($name) {
		//error_log("read $name: " .  'session_id: ' . session_id());
		return empty(self::$data[$name]) ? null : self::$data[$name];
	}

	function __destruct() {
		//error_log('destruct: ' . session_id());
		$_SESSION['QC_UserData'] = self::$data;
	}
}