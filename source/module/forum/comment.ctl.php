<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
Class CommentCtl extends BaseCtl{
	function showcomment(){
		global $_G;
		$commentobj = m('commentsrv');
		$id = intval($_G['gp_id']);
		$page = max(intval($_G['gp_page']), 1);
		$desc = $_G['gp_desc'] == 1 ? true : false;
		$data = $commentobj->getOneCommentByid($id, $page, $desc);
		if($data['commentcount'] > $data['comment']['setting']['num']){
	 		$data['multi'] = multi($data['commentcount'], $data['comment']['setting']['num'], $page, "forum.php?ctl=comment&id={$id}&desc={$_G[gp_desc]}&act=showcomment");
		}
		$this->assign($data);
		$this->display('common/header_ajax');
		if(!empty($data['template'])){
			//$this->display('common/servers/comment/comment_style');
			//$this->display('common/servers/comment/comment_javascript');
			$this->display($data['template']);
		}
		$this->display('common/footer_ajax');
	}
}
?>