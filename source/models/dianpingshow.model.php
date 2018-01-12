<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class DianpingshowModel extends BaseModel{
	var $table = 'dianping_star_statistics';
	var $prikey = 'id';
	var $alias = 'ss';
	
	/**
	 * 获取表数据
	 * @access public
	 * @param int $typeid
	 * @param String $type
	 * @return Array
	 */
	public function getData($typeid, $find = '*', $type = 'forum'){
		if(!is_array($typeid)){
			$typeid = intval($typeid);
			return $this->get(array('fields' => $find, 'conditions' => "{$this->alias}.type = 'forum' AND {$this->alias}.typeid = {$typeid}"));
		}else{
			$typeid = implode($typeid);
			return $this->find(array('fields' => $find, 'conditions' => "{$this->alias}.type = 'forum' AND {$this->alias}.typeid IN ({$typeid})"));
		}
	}
	/**
	 * 增加一个商品的点评记录
	 */
	public function addScore(){
		
	}
	
	/**
	 *添加新纪录
	 */
	public function _add($arr){
		if(is_array($arr)){
			$obj = $this->add($arr);
			return $obj;
		}else{
			return null;
		}		
	}
	
	
	/**
	 * 删除一个商品的评分，并删除相关的用户评分
	 * @param Int $id
	 * @param String $type
	 * @return boolean
	 */
	public function deleteScore($id, $type = 'forum'){
		$dianping = m('dianping');
		if($id){
			$starid = $dianping->_getStarid($id, $type);
			if($starid){
				$dianping->drop("starid = {$starid}");
				$this->drop($starid);
				return true; 		
			}
			return false;
		}else{
			return false;
		}		
	}
}
?>