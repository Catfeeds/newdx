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
	 * ��ȡ������
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
	 * ����һ����Ʒ�ĵ�����¼
	 */
	public function addScore(){
		
	}
	
	/**
	 *����¼�¼
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
	 * ɾ��һ����Ʒ�����֣���ɾ����ص��û�����
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