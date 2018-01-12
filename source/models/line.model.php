<?php

/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once 'dianpingmod.model.php';
Class LineModel extends DianpingmodModel{ 
	var $table = 'dianping_line_info';
	var $prikey = 'id';
	var $alias = 'line';
	var $_moduleid = 'line';
/*	var $_vars = array(
		'pk' 		=> 'id',
		'tid' 		=> 'tid',
		'name' 		=> 'lName',
		'pic' 		=> 'lPic',
		'lType' 	=> 'lType',
		'lTime' 	=> 'lTime',
		'enable' 	=> 'isPublish',
		'serverid' 	=> 'serverid',
		'orderby'  	=> 'orderby',
		'score'    	=> 'score',
		'num'		=> 'cnum',
		'lastrate'	=> 'lastrate',
		'lastscore' => 'lastscore',
	);*/
    var $_vars = array(
        'pk' 		=> 'id',
        'tid' 		=> 'tid',
        'name' 		=> 'subject',
        'pic' 		=> 'showimg',
        'lType' 	=> 'type',
        'lTime' 	=> 'timetype',
        'enable' 	=> 'ispublish',
        'serverid' 	=> 'serverid',
        'orderby'  	=> 'displayorder',
        'score'    	=> 'score',
        'num'		=> 'cnum',
        'lastrate'	=> 'lastrate',
        'lastscore' => 'lastscore',
        'posttime' => 'dateline',
    );
	
	/**
	 * ��ȡ������Ϣ--�ο�dianpingmod.model.php
	 */
	public function getRegions($catid = 0)
	{ 	
		$regions = array();
		require_once libfile('class/region');
		$region = region::instance();
		$regions = $region->getChild($catid);
		
		return $regions;
	}
	
	/**
	 * ����ģ������Ʒ���������
	 * @access public
	 * @param String $condition ��������
	 * @return Int
	 */
	function getMaxCount($condition = ''){
		if($this->_moduleinfo['maxcount'] > 0 && empty($condition)){
			return $this->_moduleinfo['maxcount'];
		}else{			
			$condition = empty($condition) ? '' : ' AND '.$condition;
			$sql  = "SELECT COUNT({$this->alias}.{$this->_vars[tid]}) totalCount FROM {$this->table} {$this->alias}  WHERE 1=1 {$condition}";
			$lineCount= $this->getAll($sql);
			return $lineCount[0]['totalCount'];
		}
	}
	
	/**
	 * ��ȡģ��ķ���--�ο�dianpingmod.model.php��Ӧ����
	 */
	function _getTypeClass(){
		$typelist = array();
		if(is_array($this->typeclass)){
			$mod_categorys = m('categorys');
			foreach ($this->typeclass as $k=>$v){
				$typelist[$k] = $mod_categorys->find(array(
					'fields' => 'cid, name',
					'conditions' => "fatherid = {$v} AND enable = 1",
					"order" => "cid asc"
				));
			}
		}
		return $typelist;
	}
	
	/**
	 * ���������Ʒ�����ʱ�ὫT���closed�޸�Ϊ0������Ʒ���ڵı��enable�޸�Ϊ1--�ο�dianpingmod.model.php��Ӧ����
	 * @param Int $tid
	 * @return Bool
	 */
	function checkThis($tid, $status = 1){
		$status = $status == 1 ? 1 : 0;
		if($tid > 0){
			$this->edit("{$this->_vars[tid]} = {$tid}", array($this->_vars['enable'] => $status));
			DB::update('forum_thread', array('closed' => ($status ^ 1)), array('tid' => $tid));
			$this->_updateCount();		
			
			//ͬ������������·����
			$mdLinecross   = m('linecross');
			//���¾�����·��ltype
			$mdLinecross->updateLtype($tid,$status);
			//����line_region�е���Ŀ
			$city_arr = $mdLinecross->getData("tid={$tid}", 'city');
			$count_city = count($city_arr);
			if($count_city) {
				$region = m('plugin_line_region');
				if($count_city == 1) {
					$region->updateRegionNumByCityId($city_arr[0]['city']);
				}
				else {
					$city_ids = array();
					foreach ($city_arr as $value) {
						$city_ids[] = $value['city'];
					}
					$region->updateRegionNumByCityId($city_ids);
				}
			}
			return true;
		}
		return false;
	}
	
	//ɾ����ǰ��·
	function deleteThis($tid){
		if($tid) {
			//��ȡ��Ӱ��ĳ���
			$mdLinecross   = m('linecross');
			$city_arr = $mdLinecross->getData("tid={$tid}", 'city');
			//ɾ����·
			$mdLinecross->drop("tid = {$tid}");
			parent::deleteThis($tid);

			//����line_region�е���Ŀ
			$count_city = count($city_arr);
			if($count_city) {
				$region = m('plugin_line_region');
				if($count_city == 1) {
					$region->updateRegionNumByCityId($city_arr[0]['city']);
				}
				else {
					$city_ids = array();
					foreach ($city_arr as $value) {
						$city_ids[] = $value['city'];
					}
					$region->updateRegionNumByCityId($city_ids);
				}
			}
		}
	}
	
}

?>