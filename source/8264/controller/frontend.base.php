<?php
/**
 * ������ǰ̨����
 *
 * @author 8264TEAM
 * @usage none
 */
class FrontendCtl extends BaseCtl
{
	function __construct()
	{
		parent::__construct();
	}
	function _config_view()
	{
		parent::_config_view();
	}
	/**
	 * ��ʾ��ͼҳ��
	 *
	 * @param type $tpl
	 */
	function display($tpl)
	{
		parent::display($tpl);
	}
	/**
	 * ��ҳ����������ԭ�Ⱥ��ĺ����ķ�ҳ����
	 */
	function multi($num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = false, $simple = false, $showinput = false)
	{
		return multi($num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = false, $simple = false, $showinput = false);
	}
}
?>
