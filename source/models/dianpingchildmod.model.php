<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class DianpingchildmodModel extends BaseModel{
	var $table = 'plugin_dianping_childmodules';
	var $prikey = 'mdid';
	var $alias = 'mcm';
	
	/**
	 * ��ȡ������ģ��ı�ʶӢ��
	 * @access public
	 * @return Array
	 */
	function getKeyName(){
		$return = $this->find(array('fields' => 'keyname'));
		foreach($return as $_k => $_v){
			$_tmp[$_k] = $_v['keyname'];
		}
		return $_tmp;
	}
}
?>