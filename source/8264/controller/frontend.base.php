<?php
/**
 * 控制器前台基类
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
	 * 显示视图页面
	 *
	 * @param type $tpl
	 */
	function display($tpl)
	{
		parent::display($tpl);
	}
	/**
	 * 分页方法，套用原先核心函数的分页方法
	 */
	function multi($num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = false, $simple = false, $showinput = false)
	{
		return multi($num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = false, $simple = false, $showinput = false);
	}
}
?>
