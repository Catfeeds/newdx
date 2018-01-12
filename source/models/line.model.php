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
	 * 读取地区信息--参考dianpingmod.model.php
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
	 * 返回模块内商品的最大数量
	 * @access public
	 * @param String $condition 过滤条件
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
	 * 读取模块的分类--参考dianpingmod.model.php相应方法
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
	 * 用于审核商品，审核时会将T表的closed修改为0，将商品所在的表的enable修改为1--参考dianpingmod.model.php相应方法
	 * @param Int $tid
	 * @return Bool
	 */
	function checkThis($tid, $status = 1){
		$status = $status == 1 ? 1 : 0;
		if($tid > 0){
			$this->edit("{$this->_vars[tid]} = {$tid}", array($this->_vars['enable'] => $status));
			DB::update('forum_thread', array('closed' => ($status ^ 1)), array('tid' => $tid));
			$this->_updateCount();		
			
			//同步地名经过的路线数
			$mdLinecross   = m('linecross');
			//更新经过线路的ltype
			$mdLinecross->updateLtype($tid,$status);
			//更新line_region中的数目
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
	
	//删除当前线路
	function deleteThis($tid){
		if($tid) {
			//获取受影响的城市
			$mdLinecross   = m('linecross');
			$city_arr = $mdLinecross->getData("tid={$tid}", 'city');
			//删除线路
			$mdLinecross->drop("tid = {$tid}");
			parent::deleteThis($tid);

			//更新line_region中的数目
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