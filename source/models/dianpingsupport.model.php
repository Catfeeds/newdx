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
	 * ��ĳ�����������޳ɻ��޳ɲ���
	 */
	function SetSupport()
	{
		
	}
	/**
	 * ����ĳ���������е��޳���Ϣ
	 */
	function GetSupportByTid($tid)
	{
		
	}
	/**
	 * ����ĳ���û���������ͬ��Ϣ
	 */
	function GetSupportByUid($uid)
	{
		
	}

	/**
	 * ����û��Ƿ��޹�
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