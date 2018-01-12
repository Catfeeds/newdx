<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_ADMINCP')) {
	exit('Access Denied');
}
class TemplateadminCtl extends BackendCtl
{
	function getlist($tips = '', $success = false)
	{
		$mod = m('templatesrv');
		$findarray = array();
		!empty($_GET['findname']) && $findarray['name'] = $_GET['findname'];
		!empty($_GET['finddir']) && $findarray['template'] = $_GET['finddir'];
		!empty($_GET['findmodel']) && $findarray['model'] = $_GET['findmodel'];
		!empty($_GET['mtype']) && $findarray['type'] = $_GET['mtype'];
		$data['list'] = $mod->getlist($findarray);
		if (! empty($tips)) {
			$data['tips'] = $tips . ($success ? '成功' : '出错');
			$data['color'] = $success ? 'green' : 'red';
		}
		$this->assign($data);
		$this->display('common/header_ajax');
		$this->display('common/servers/template/template_list');
		$this->display('common/footer_ajax');
	}
	function addnew()
	{
		$new_mod = empty($_GET['model']) ? '' : $_GET['model'];
		$new_type = empty($_GET['mtype']) ? '' : $_GET['mtype'];
		$new_template = empty($_GET['templatedir']) ? '' : $_GET['templatedir'];
		$new_name = empty($_GET['templatename']) ? '' : $_GET['templatename'];
		$return = false;
		if (! empty($new_mod) || ! empty($new_type) || ! empty($new_template)) {
			$mod = m('templatesrv');
			$return = $mod->AddTemplate($new_template, $new_type, $new_mod, $new_name);
		}
		unset($_GET['mtype']);
		$this->getlist($mod->message, $return);
	}
	function gettype()
	{
		$mod = m('templatesrv');
		$allmodel = array_keys($mod->modellist);
		if (in_array($_GET['mod'], $allmodel)) {
			$data['types'] = $mod->modellist[$_GET['mod']]['type'];
		}
		$data['selected'] = $_GET['selecttype'] ? $_GET['selecttype'] : '';
		$this->assign($data);
		$this->display('common/header_ajax');
		$this->display('common/servers/template/template_types');
		$this->display('common/footer_ajax');
	}
	function deltemplate()
	{
		$id = $_GET['tmpid'] > 0 ? $_GET['tmpid'] : 0;
		$return = false;
		if ($id > 0) {
			$mod = m('templatesrv');
			$return = $mod->drop($id);
		}
		unset($_GET['tmpid']);
		$this->getlist('删除模板', $return);
	}
	function editemplate()
	{
		$tmpid = intval($_GET['tmpid']);
		$mod = m('templatesrv');
		if ($tmpid > 0) {
			if ($_GET['editsubmit'] == 'yes') {
				$new_mod = empty($_GET['model']) ? '' : $_GET['model'];
				$new_type = empty($_GET['mtype']) ? '' : $_GET['mtype'];
				$new_template = empty($_GET['templatedir']) ? '' : $_GET['templatedir'];
				$new_name = empty($_GET['templatename']) ? '' : $_GET['templatename'];
				$return = false;
				if (! empty($new_mod) || ! empty($new_type) || ! empty($new_template)) {
					$mod = m('templatesrv');
					$return = $mod->EditTemplate($tmpid, $new_template, $new_type, $new_mod, $new_name);
				}
				unset($_GET['mtype']);
				$this->getlist($mod->message, $return);
			} else {
				$data['models'] = $mod->getmodels();
				$data['info'] = $mod->get($tmpid);
				$this->assign($data);
				$this->display('common/header_ajax');
				$this->display('common/servers/template/template_edit');
				$this->display('common/footer_ajax');
			}
		} else {
			showmessage('提交的参数错误');
		}
	}
}
?>