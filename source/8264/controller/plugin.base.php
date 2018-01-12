<?php

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class BasePlugin extends Object {

	var $data = array();

	function __construct($data, $config) {
		$this->data = $data;
		$this->config = $config;
	}

	function execute() {
		# code...
	}

	function assign($k, $v) {
//		$app = & cc();
//		$app->assign($k, $v);
	}

	function display($f) {
		$app = & cc();
		$app->display($f);
	}

	/**
	 * ���������ƽ̨
	 *
	 * @author rinne 130604
	 * @param mixed $allow_pf ƽ̨���ƣ�������ַ������ַ�����','�ָ�
	 * @return boolean
	 */
	function is_inpf($allow_pf) {
		if (is_string($allow_pf)) {
			$allow_pf = explode(',', $allow_pf);
		}
		if (!is_array($allow_pf)) {
			return false;
		} else {
			foreach ($allow_pf as $value) {
				$pf = trim(strtoupper($value));
				if (defined($pf) && constant($pf) === true) {
					return true;
				}
			}
			return false;
		}
	}

}

?>