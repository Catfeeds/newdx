<?php

/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class LinecrossModel extends BaseModel{ 
	var $table  = 'dianping_line_cross';
	var $alias  = 'lc';
	var $prikey = 'id';
	var $_vars  = array(
		'pk' 		=> 'id',
		'tid' 		=> 'tid',
		'province' 	=> 'province',
		'city' 		=> 'city',
		'ltype'     => 'ltype',
		'ltime' => 'ltime',
	);	
	
	/**
	 * 返回帖子ids
	 * @access public
	 * @param String $keyword 关键字
	 * @return string
	 */
	function getTids($keyword = ""){
		$result = array();
		$sql = "SELECT * FROM ".DB::table('plugin_city_code')." where cityname regexp '({$keyword})'";
		$q = DB::query($sql);
		while ($v = DB::fetch($q))
		{
			if ($v["shengid"] == 0) {
				$result["province"][$v["codeid"]] = $v["codeid"];
			} else {
				$result["city"][$v["codeid"]] = $v["codeid"];
			}
		}
		$where = array();
		if ($result["province"]) {
			$result["province"] = implode(",", $result["province"]);
			$where["province"]  = " province in ({$result["province"]})";			
		}
		if ($result["city"]) {
			$result["city"] = implode(",", $result["city"]);
			$where["city"]  = " city in ({$result["city"]})";			
		}		
		$where 		= implode(" or ", $where);
		$crossList  = array();
		if ($where) {
			$crossList = $this->find(array('fields'=>"{$this->alias}.{$this->_vars["tid"]}",'conditions' => $where));			
		}
		$arrTid = array();
		foreach ($crossList as $v) {
			$arrTid[$v["tid"]] = $v["tid"];			
		}		
		return implode(",", $arrTid);
	}
	
	/**
	 * 根据帖子id获取表数据
	 * @access public
	 * @param int $tid
	 * @return Array
	 */
	public function getDataByTid($tid){
		$tid = intval($tid);
		return $this->find(array('conditions' => "{$this->alias}.{$this->_vars['tid']} = '{$tid}'",'order' => 'id asc'), false);
	}
	
	/**
	 * 获取表数据
	 * @access public
	 * @param int $tid
	 * @return Array
	 */
	public function getData($where, $fields='*'){
		$arrParam = array();
		if ($where) {
			$arrParam['conditions'] = $where;
		}

		$arrParam['order'] = 'id asc';
		$arrParam['fields'] = $fields;
		return $this->find($arrParam, false);
	}
	/**
	 * 更新数据
	 */
	public function updateLtype($tid,$status){
		if ($tid) {	
			if($status == 0){
				$this->edit("tid = {$tid}",array('ltype'=>0));	
			}else {							
				$mdLine = m('line');
				$line   = $mdLine->get(array('conditions' => "tid = {$tid}"));
				$this->edit("tid = {$tid}",array('ltype'=>$line['type']));
			}					
		}
	}
}
?>