<?php

/**
 * ��֤��
 *
 * @author Garbin
 * @usage none
 */
class DemoCtl extends dianpingCtl {

	function index() {
		$this->assign('data', array('a','b','c'));
		$this->display('forum/demo');
	}

	/**
	 * �����֤��
	 *
	 * @return type
	 */
	function check_captcha() {
		echo "This action name is " . ACT;
	}

}

?>