<?php
/**
 * 考试控制器基类
 */
class ExamCtl extends FrontendCtl
{
	var $_ctl = 'exam';
	function __construct()
	{
		parent::__construct();
	}
	function _run_action()
	{
		parent::_run_action();
	}
	function _config_view()
	{
		parent::_config_view();
	}
	/**
	 * 显示消息的方法
	 */
	function showmessage($message, $url_forward = '', $values = array(), $extraparam = array(), $custom = 0)
	{
		showmessage($message, $url_forward, $values, $extraparam, $custom);
	}

}

?>
