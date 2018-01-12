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
	 * Ĭ��Ϊ��ʾ
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
			$this->_showmessage('��ǰ���ʵ�ͼ�������ڻ�������ˡ�');
		$data['navtitle'] = '����ͼ�� - ' . $_tmpinfo['photoinfo']['name'];
		$this->assign($data);
		$this->display($this->_header());
		! empty($data['configinfo']['templates']['view']) ? $this->display($data['configinfo']['templates']['view']) : $this->display('common/servers/photo/photo');
		$this->display($this->_footer());
	}
	/**
	 * չʾ�ϴ���ť
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
	 * ͼƬ���б�ҳ
	 */
	function imglist()
	{
		global $_G;
		$editid = intval($_G['gp_editid']);
		/*������ģ�ͽ��������޸�*/
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
			$this->_showmessage('��ǰû�пɱ༭��ͼƬ����û��Ȩ�ޱ༭�����ϴ�ͼƬ');
		$this->assign($data);
		//var_dump($data);exit;
		$this->display($this->_header());
		! empty($data['configinfo']['templates']['ajaxpost']) ? $this->display($data['configinfo']['templates']['ajaxpost']) : $this->display('common/servers/photo/imglist');
		$this->display($this->_footer());
	}
	/**
	 * ��ͼ���ķ����ͱ༭ 
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
				$this->_showmessage('��·�������뷵�����±༭');
		}
	}
	/**
	 * �½�ͼ��
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
			$this->_showmessage('��ͼ���Ѿ������ˡ�', '/forum.php?ctl=photo&id=' . $phid);
		}
		$this->_showmessage('����ʧ�ܣ�������');
	}
	/**
	 * �༭ͼ��
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
			$this->_showmessage('ͼ���Ѿ��༭���ˣ��ȴ���˺󽫻ᷢ����', '/forum.php?ctl=photo&id=' . $phid);
		}
		$this->_showmessage('�޸�ʧ�ܣ��������Ƿ���Ȩ���޸Ļ�ͼ���Ƿ����');
	}
	/**
	 * ��ʾ��Ϣ
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