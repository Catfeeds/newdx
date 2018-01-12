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
		$data['message'] = "<p>添加新模板请建立在<strong>8264/common/servers/comment/</strong>目录下，命名为<strong>comment_你的模板名.htm</strong></p><p>每个评论框都绑定在一个class为 <strong>newcomment</strong> 和一个 <strong>cid_编号</strong> 的div中，<strong>newcomment</strong>为默认样式，如需特别可以通过 <strong>cid_编号</strong> 这个class里重新写新的css</p><p>所有css文件放在<strong>8264/common/servers/comment/comment_style.htm</strong>里面</p><p>所有JS文件放在<strong>8264/common/servers/comment/comment_javascript.htm</strong>里面，尽量不要引用jquery，如需引用，请放在文件结尾并多测试下原先ajax提交评论是否受影响</p>";
		$data['tips'] = <<< EOF
<p>1.请在tid中填写需要绑定帖子的tid来绑定帖子<p>
<p>2.评论条数为显示的评论条数，默认为5条</p>
<p>3.模板请不懂人员不要填写，由页面来管理。默认为default模板，如需建立新模板请<a href="javascript:;" onclick="showDialog('{$data[message]}','info');">点击查看</a><p>
EOF;
		if (! empty($data['list'])) {
			$data['tips'] .= "<div><b class='blue'>说明：在需要加入评论的模板中需要的位置加入以下</b>&nbsp;&nbsp;<b class='green'>绿色部分</b><br /><ul>";
			foreach ($data['list'] as $_id => $_val) {
				$data['tips'] .= "<li><b class='green'>&lt;!--{eval showcomment({$_id});}--&gt;</b>&nbsp;&nbsp;来引用tid为&nbsp;<b class='red'>{$_val[tid]}</b>&nbsp;的帖子的评论框</li>";
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
			showmessage("绑定的帖子TID = {$tid} 已经与 编号为 $_info[typeid] 的文章绑定，请更换另一个帖子作为绑定目标！！");
			return false;
		}
		return true;
	}
}
?>