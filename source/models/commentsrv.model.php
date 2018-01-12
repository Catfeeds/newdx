<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class CommentsrvModel extends BaseModel
{
	var $table = 'plugin_servers_comment';
	var $prikey = 'cid';
	var $alias = 'sct';
	/**
	 * 通过id读取相关的评论信息
	 * @param Int $typeid
	 * @param Int $type
	 * @return Array
	 */
	function getCommentByTypeid($typeid, $type = 1)
	{
		$typeid = intval($typeid);
		$type = intval($type);
		$return = array();
		if ($typeid > 0 && $type > 0) {
			$return = $this->find("typeid = {$typeid} AND type = {$type}");
			foreach ($return as $_k => $_v) {
				$return[$_k]['time'] = date('Y-m-d H:i:s', $_v['dateline']);
				! empty($return[$_k]['setting']) && $return[$_k]['setting'] = unserialize($return[$_k]['setting']);
			}
		}
		return $return;
	}
	/**
	 * 通过id读取一条评论框
	 * @param Int $id
	 * @param Int $page
	 * @param Bool $desc
	 * @return Array 
	 */
	function getOneCommentByid($id, $page = 1, $desc = true)
	{
		global $_G;
		$id = intval($id);
		$return = array();
		$page = intval($page) >= 1 ? $page : 1;
		if ($id > 0) {
			$comment = $this->get($id);
			$comment['setting'] = unserialize($comment['setting']);
			$limit = $comment['setting']['num'] > 0 ? $comment['setting']['num'] : 5;
			$start = ($page - 1) * $limit;
			$template = ! empty($comment['setting']['template']) ? $comment['setting']['template'] : 'common/servers/comment/comment_default';
			/*此处待p表模型建立后完善，暂使用DB*/
			$q = DB::query("SELECT pid, message, author, authorid, dateline FROM ".DB::table('forum_post')." WHERE first = 0 AND tid = {$comment[tid]} AND status = 0 ORDER BY dateline ".($desc ? "DESC" : "ASC")." LIMIT {$start},{$limit}");
			while ($v = DB::fetch($q)) {
				$v['avatar'] = avatar($v['authorid'], 'small');
				$v['message'] = preg_replace("/\[size=\d+\]/i","",$v['message']);
	            $v['message'] = preg_replace("/\[\/size\]/i","",$v['message']);
	            $v['message'] = preg_replace("/\[img\].*\[\/img\]/i","",$v['message']);
	            $v['message'] = preg_replace("/\[color=#\d+\].*\[\/color\]/i","",$v['message']);
	            $v['message'] = preg_replace("/\[url=([a-z0-9=?&\.]*)\]\[\/url\]/i","",$v['message']);
	            $v['yw_message']=$v['message'];
            	$v['yw_message']=preg_replace("/\[quote\].*\[\/quote\]/","",$v['yw_message']);
	            if(stripos($v['message'], '[attach]') !== false && stripos($v['message'], '[/attach]') !== false) $v['message'] = preg_replace("/\[attach\]\d+\[\/attach\]/i","&nbsp;[图片]&nbsp;", $v['message']) . "<a target='_blank' href='{$_G[config][web][forum]}forum.php?mod=redirect&goto=findpost&ptid={$comment[tid]}&pid={$v[pid]}&extra=#pid{$v[pid]}'>去查看图片</a>";
				if(strlen($v['message']) > 300) $v['message'] = cutstr($v['message'], 300, "...<a target='_blank' href='{$_G[config][web][forum]}forum.php?mod=redirect&goto=findpost&ptid={$comment[tid]}&pid={$v[pid]}&extra=#pid{$v[pid]}'>查看原文</a>");
				if(preg_match("/\[quote\]/i",$v['message'])){
	                $v['message']=preg_replace("/\[quote\]/i","<div class='quote'><blockquote>",$v['message']);
	                $v['message']=preg_replace("/\[\/quote\]/i","</blockquote></div><span>",$v['message']);
	            }else{
	                $v['message']="<span>".$v['message'];
	            }
	            $v['message'].="</span>";
	            $v['time'] = date('Y-m-d H:i', $v['dateline']);
				$commentlist[] = $v;
			}
			$threadinfo = DB::fetch_first("SELECT replies, fid FROM ".DB::table('forum_thread')." WHERE tid = {$comment[tid]}");
			$commentcount = $threadinfo['replies'];
			$commentfid = $threadinfo['fid'];
			$return = compact('template', 'comment', 'commentlist', 'commentcount', 'commentfid');
		}
		return $return;
	}
}
?>