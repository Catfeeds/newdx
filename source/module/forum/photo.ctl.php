<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class PhotoCtl extends ForumCtl
{
	var $model;
	function __construct()
	{
		parent::__construct();
		$this->model = m('photo');
	}
	function _header()
	{
		return $_GET['inajax'] ? 'common/header_ajax' : 'common/header';
	}
	function _footer()
	{
		return $_GET['inajax'] ? 'common/footer_ajax' : 'common/footer';
	}
	/**
	 * 默认为显示
	 */
	function index()
	{
		$phid = intval($_GET['id']);
		$width = intval($_GET['width']);
		$height = intval($_GET['height']);
		$type = intval($_GET['type']);
		$_tmpinfo = $this->model->getPhotosById($phid, 2, $width, $height, $type);
		$data['configinfo'] = $_tmpinfo['photoinfo'];
		$data['imglist'] = $_tmpinfo['photolist'];
		if (empty($data['imglist']))
			$this->_showmessage('当前访问的图集不存在或正在审核。');
		$data['navtitle'] = '精彩图集 - ' . $_tmpinfo['photoinfo']['name'];
		$this->assign($data);
		$this->display($this->_header());
		! empty($data['configinfo']['templates']['view']) ? $this->display($data['configinfo']['templates']['view']) : $this->display('common/servers/photo/photo');
		$this->display($this->_footer());
	}
	/**
	 * 展示上传按钮
	 */
	function upload()
	{
		$data['fid'] = $this->model->fid;
		$data['editid'] = $_GET['id'] ? $_GET['id'] : 0;
		$data['editinfo'] = $this->model->get($data['editid']);
		$data['editinfo']['templates'] = unserialize($data['editinfo']['templates']);
		$this->assign($data);
		$this->display($this->_header());
		//$this->display('common/servers/photo/upload');
		! empty($data['editinfo']['templates']['post']) ? $this->display($data['editinfo']['templates']['post']) : $this->display('common/servers/photo/upload');
		$this->display($this->_footer());
	}
	/**
	 * 图片的列表页
	 */
	function imglist()
	{
		global $_G;
		$editid = intval($_G['gp_editid']);
		/*待附件模型建立后再修改*/
		require_once libfile('function/post');
		$attachlist = getattach(0);
		$data['imagelist'] = $attachlist['imgattachs']['unused'];
		$_tmpinfo = $this->model->getPhotosById($editid, 2);
		if($_tmpinfo !== false){
			$data['configinfo'] = $_tmpinfo['photoinfo'];
			$data['editimglist'] = $_tmpinfo['photolist'];
		}
		$data['editid'] = $editid;
		if (empty($data['imagelist']) && empty($data['editimglist']))
			$this->_showmessage('当前没有可编辑的图片或您没有权限编辑，请上传图片');
		$this->assign($data);
		//var_dump($data);exit;
		$this->display($this->_header());
		! empty($data['configinfo']['templates']['ajaxpost']) ? $this->display($data['configinfo']['templates']['ajaxpost']) : $this->display('common/servers/photo/imglist');
		$this->display($this->_footer());
	}
	/**
	 * 对图集的发布和编辑 
	 */
	function postphoto()
	{
		switch ($_POST['postmod']) {
			case 'addphoto':
				$this->addnew();
				break;
			case 'editphoto':
				$this->editphoto();
				break;
			default:
				$this->_showmessage('来路不明，请返回重新编辑');
		}
	}
	/**
	 * 新建图集
	 */
	function addnew()
	{
		$aids = $_POST['aids'];
		$urls = $_POST['urls'];
		$titles = $_POST['titles'];
		$templates = $_POST['template'];
		$name = $_POST['newphotoname'];
		$phid = $this->model->addNewPhoto($aids, $urls, $titles, $templates, $name);
		if ($phid > 0) {
			$this->_showmessage('新图集已经建立了。', '/forum.php?ctl=photo&id=' . $phid);
		}
		$this->_showmessage('建立失败，请重试');
	}
	/**
	 * 编辑图集
	 */
	function editphoto()
	{
		$aids = $_POST['aids'];
		$urls = $_POST['urls'];
		$titles = $_POST['titles'];
		$pids = $_POST['pids'];
		$phid = $_POST['editphotoid'];
		$templates = $_POST['template'];
		$name = $_POST['newphotoname'];
		if ($this->model->editPhoto($phid, $aids, $urls, $titles, $templates, $name)) {
			$this->_showmessage('图集已经编辑好了，等待审核后将会发布。', '/forum.php?ctl=photo&id=' . $phid);
		}
		$this->_showmessage('修改失败，请检查您是否有权限修改或图集是否存在');
	}
	/**
	 * 显示消息
	 */
	function _showmessage($message, $url = null, $args = array(), $extra = array())
	{
		if ($_GET['inajax']) {
			$this->display($this->_header());
			$js = empty($url) ? 'javascript:history.back();' : 'javascript:;';
			$url = empty($url) ? 'javascript:;' : $url;
			$data = compact('message', 'url', 'js');
			$this->assign($data);
			$this->display('common/servers/photo/message');
			$this->display($this->_footer());
		} else {
			showmessage($message, $url, $args, $extra);
		}
	}
}
?>