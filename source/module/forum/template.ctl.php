<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class TemplateCtl extends ForumCtl
{
	var $_modeltypes = array(
		'dianping' => array(
			'list' => '1',
			'view' => '2',
			'post' => '3',
			'replylist' => '4',
			'imagelist' => '5',),
		'photo' => array(
			'list' => '1',
			'view' => '2',
			'post' => '3',
			'ajaxpost' => '4',
			),
		'comment' => array('list' => '1'),
		);
	function gettemplate()
	{
		$_modelname = ! empty($_GET['model']) ? $_GET['model'] : '';
		$_typename = ! empty($_GET['typename']) ? $_GET['typename'] : '';
		if (in_array($_modelname, array_keys($this->_modeltypes)) && in_array($_typename, array_keys($this->_modeltypes[$_modelname]))) {
			$templateclass = m('templatesrv');
			$_typeid = $this->_modeltypes[$_modelname][$_typename];
			$data['templates'] = $templateclass->getlist(array('type' => $_typeid, 'model' => $_modelname));
			$data['usemodel'] = $_modelname;
			$data['typeid'] = $_typeid;
			$data['typename'] = $_typename;
			$data['selected'] = $_GET['selected'];
			$data['formname'] = $_GET['formname'] ? $_GET['formname'] : "template[{$_typename}]";
			$this->assign($data);
			$_GET['inajax'] = 1;
			$this->display('common/header_ajax');
			$this->display('common/servers/template/template_select');
			$this->display('common/footer_ajax');
		} else {
			showmessage("提交的参数错误");
		}
	}
}
?>