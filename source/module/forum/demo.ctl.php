<?php

/**
 * 验证码
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
	 * 检查验证码
	 *
	 * @return type
	 */
	function check_captcha() {
		echo "This action name is " . ACT;
	}

}

?>