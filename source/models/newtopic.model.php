<?php
/**
 * @author JiangHong
 * @copyright 2013
 * ��ר��ģ�ͣ���ʹ����̳������Ϊ������
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class NewtopicModel extends BaseModel
{
	var $table = 'plugin_newtopic';
	var $alias = 'pnt';
	var $prikey = 'tpid';
	var $topicname;
	var $_fid;
	function __construct()
	{
		global $_G;
		parent::__construct();
		if (! empty($this->topicname)) {
			$this->_fid = $_G['config']['fids'][$this->topicname];
		}
	}
}
?>