<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class DianpingmodulesModel extends BaseModel{
	var $table = 'plugin_dianping_modules';
	var $prikey = 'mid';
	var $alias = 'dpmdl';
	/**
	 * 读取模块的配置信息
	 * @access public
	 * @param Int $mid
	 * @param String $srcid
	 * @return Array
	 */
	function getConfig($mid, $srcid = ''){
		if($mid > 0){
			return $this->get($mid);
		}else{
			if(!empty($srcid)){
				return $this->get(array('conditions' => "{$this->alias}.srcid = '{$srcid}'"));
			}
			return array();
		}
	}
	/**
	 * 修改配置
	 * @access public
	 * @param mixed $condition
	 * @param String $editsome
	 * @return void
	 */
	function setConfig($condition, $editsome){
		$this->edit($condition, $editsome);
	}
	/**
	 * 修改模块的自定义设置信息
	 */
	function editSetting($mid, $key, $value, $type = 'settings'){
		$nowconfig = $this->get($mid);
		if($nowconfig){
			$nowconfig = unserialize($nowconfig[$type]);
			$nowconfig[$key] = $value;
			$this->edit($mid, array($type => serialize($nowconfig)));
		}		
	}
}

?>