<?php

/**
 * 管理后台控制器
 *
 * @author Garbin
 * @usage none
 */
class BackendCtl extends BaseCtl {

	function __construct() {
		parent::__construct();
	}

	/**
	 *    后台的需要权限验证机制
	 *
	 *    @author    Garbin
	 *    @return    void
	 */
	function _run_action() {
		# 先判断是否登录
		# 登录后判断是否有权限

		// 运行
		parent::_run_action();
	}

	function _config_view() {
		parent::_config_view();
	}

	function display($tpl) {
		parent::display($tpl);
	}

}

?>
