<?php
/**
 * ���Կ���������
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
	 * ��ʾ��Ϣ�ķ���
	 */
	function showmessage($message, $url_forward = '', $values = array(), $extraparam = array(), $custom = 0)
	{
		showmessage($message, $url_forward, $values, $extraparam, $custom);
	}

}

?>
