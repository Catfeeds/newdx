<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class DianpingsupportModel extends BaseModel
{
	var $table = 'dianping_support';
	var $alias = 'dst';
	var $prikey = 'pid, uid';
	/**
	 * 对某条点评进行赞成或不赞成操作
	 */
	function SetSupport()
	{
		
	}
	/**
	 * 返回某个帖子所有的赞成信息
	 */
	function GetSupportByTid($tid)
	{
		
	}
	/**
	 * 返回某个用户的所有赞同信息
	 */
	function GetSupportByUid($uid)
	{
		
	}

	/**
	 * 检测用户是否赞过
	 * 
	 * @author lxp 20130918
	 * @param int $pid
	 * @param int $uid
	 * @return boolean
	 */
	function isSupport($pid, $uid){
		return !$this->get(array(
				'conditions' => "pid = {$pid} AND uid = {$uid}",
				'index_key'  => 'no_key'
		));
	}
}
?>