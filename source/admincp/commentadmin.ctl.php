<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_ADMINCP')) {
	exit('Access Denied');
}
class CommentadminCtl extends BackendCtl
{
	function getlist()
	{
		$commentsrv = m('commentsrv');
		$data['typeid'] = $_GET['typeid'];
		$data['type'] = $_GET['type'];
		$data['list'] = $commentsrv->getCommentByTypeid($_GET['typeid'], $_GET['type']);
		$data['title'] = urldecode($_GET['name']);
		$data['url'] = urldecode($_GET['url']);
		$data['message'] = "<p>�����ģ���뽨����<strong>8264/common/servers/comment/</strong>Ŀ¼�£�����Ϊ<strong>comment_���ģ����.htm</strong></p><p>ÿ�����ۿ򶼰���һ��classΪ <strong>newcomment</strong> ��һ�� <strong>cid_���</strong> ��div�У�<strong>newcomment</strong>ΪĬ����ʽ�������ر����ͨ�� <strong>cid_���</strong> ���class������д�µ�css</p><p>����css�ļ�����<strong>8264/common/servers/comment/comment_style.htm</strong>����</p><p>����JS�ļ�����<strong>8264/common/servers/comment/comment_javascript.htm</strong>���棬������Ҫ����jquery���������ã�������ļ���β���������ԭ��ajax�ύ�����Ƿ���Ӱ��</p>";
		$data['tips'] = <<< EOF
<p>1.����tid����д��Ҫ�����ӵ�tid��������<p>
<p>2.��������Ϊ��ʾ������������Ĭ��Ϊ5��</p>
<p>3.ģ���벻����Ա��Ҫ��д����ҳ��������Ĭ��Ϊdefaultģ�壬���轨����ģ����<a href="javascript:;" onclick="showDialog('{$data[message]}','info');">����鿴</a><p>
EOF;
		if (! empty($data['list'])) {
			$data['tips'] .= "<div><b class='blue'>˵��������Ҫ�������۵�ģ������Ҫ��λ�ü�������</b>&nbsp;&nbsp;<b class='green'>��ɫ����</b><br /><ul>";
			foreach ($data['list'] as $_id => $_val) {
				$data['tips'] .= "<li><b class='green'>&lt;!--{eval showcomment({$_id});}--&gt;</b>&nbsp;&nbsp;������tidΪ&nbsp;<b class='red'>{$_val[tid]}</b>&nbsp;�����ӵ����ۿ�</li>";
			}
			$data['tips'] .= "</ul></div>";
		}
		$this->assign($data);
		$this->display('common/header_ajax');
		$this->display('common/servers/comment/admin_list');
		$this->display('common/footer_ajax');
	}
	function delete()
	{
		$commentsrv = m('commentsrv');
		$commentsrv->drop($_GET['ctid']);
		$this->getlist();
	}
	function edit()
	{
		$newtid = intval($_GET['newtid']);
		$cid = intval($_GET['ctid']);
		$this->_getNotExists($newtid, $cid);
		if ($newtid > 0 && $cid > 0) {
			$commentsrv = m('commentsrv');
			$setting['template'] = empty($_GET['template']) ? 'common/servers/comment/comment_default' : $_GET['template'];
			$setting['num'] = intval($_GET['num']) > 0 ? $_GET['num'] : 5;
			$setting = serialize($setting);
			$commentsrv->edit($cid, array('tid' => $newtid, 'setting' => $setting));
		}
		$this->getlist();
	}
	function addnew()
	{
		$newtid = intval($_GET['newtid']);
		$this->_getNotExists($newtid);
		$typeid = $_GET['typeid'];
		$type = $_GET['type'];
		$setting['template'] = empty($_GET['template']) ? 'common/servers/comment/comment_default' : $_GET['template'];
		$setting['num'] = intval($_GET['num']) > 0 ? $_GET['num'] : 5;
		$setting = serialize($setting);
		if ($newtid > 0) {
			$commentsrv = m('commentsrv');
			$commentsrv->add(array(
				'tid' => $newtid,
				'type' => $type,
				'typeid' => $typeid,
				'setting' => $setting,
				'dateline' => time()));
		}
		$this->getlist();
	}
	function _getNotExists($tid, $cid = 0)
	{
		$commentsrv = m('commentsrv');
		$_info = $commentsrv->get("tid = {$tid}");
		$cid = intval($cid);
		if ($_info && $cid != $_info['cid']) {
			showmessage("�󶨵�����TID = {$tid} �Ѿ��� ���Ϊ $_info[typeid] �����°󶨣��������һ��������Ϊ��Ŀ�꣡��");
			return false;
		}
		return true;
	}
}
?>