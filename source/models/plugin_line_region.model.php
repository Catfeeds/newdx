<?php

/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class Plugin_line_regionModel extends BaseModel{ 
	var $table  = 'dianping_line_region';
	var $alias  = 'p_l_r';
	var $prikey = 'id';
	
	/**
	 * ��ȡ������
	 * @access public
	 * @param int $provinceid
	 * @return Array
	 */
	public function getList($provinceid){
		$provinceid = intval($provinceid);
		return $this->find(array('conditions' => "{$this->alias}.num>0 and {$this->alias}.provinceid = '{$provinceid}'",'order' => 'num desc, id asc'));
	}
	
	
	/**
	 * ��ȡ������
	 * @access public
	 * @param int $provinceid
	 * @return Array
	 */
	public function getListbyId($where, $index = false){
		$arrParam = array();
		$_result = array();
		if (!empty($where)) {
			$arrParam["conditions"] = $where;
		}
		$arrParam["order"] = "id asc";
		$_result = $this->find($arrParam, $index);
		return $_result;
	}
	
	
	/**
	 * ��ȡ������
	 * @access public
	 * @param array $where
	 * @return Array
	 */
	public function getAllList($where){
		$arrParam = array();
		if (!empty($where)) {
			$arrParam["conditions"] = $where;
		}
		$arrParam["order"] = "num desc, id asc";	
		
		$result  = array("list"=>array(), "num"=>array());
		$_result = $this->find($arrParam, false);
		foreach ($_result as $v) {
			$result["list"][$v["provinceid"]][$v["id"]] = $v;
			$result["num"][$v["provinceid"]] += $v["num"];
			$result["city"][$v["id"]] = $v;
		}
		return $result;
	}
	
	/**
	 * ��������
	 * @access public
	 * @param array $data
	 * @param int $tid
	 * @return Array
	 */
	public function doData($data, $tid){
		global $_G;
		$tid			= intval($tid);
		$hasIn			= array();
		$logLineRegion	= array();
		
		if (empty($tid)) {return false;}
		
		$mdLine 	   = m('line');		
		$lineShow	   = $mdLine->get(array('conditions' => "tid = {$tid}", 'limit'=>'0,1'));
		$mdLinecross   = m('linecross');
		/*�����б䶯��������line_cross�е����ݱ�ɾ���ˣ��޷��ҵ���������ǰ�����ĳ��У�ɾ��֮ǰ��Ҫ�ҵ�line_region��Ӱ�������*/
		$old_cross_cities = $mdLinecross->getData("tid={$tid}", 'city');
		$old_cross_city_ids = array();
		if($old_cross_cities) {
			foreach ((array)$old_cross_cities as $value) {
				$old_cross_city_ids[$value['city']] = $value['city'];
			}
		}

		
		$mdLinecross->drop("tid = {$tid}");
		$lType = $lineShow['ispublish'] == 1 ? $lineShow['type'] : 0 ;
		$ltime = $lineShow['timetype'];
		$new_cross_city_ids = array();
		foreach ($data['province'] as $k=>$v) {
			if (empty($v) || empty($data['cityname'][$k])) {continue;}
			$where  		= "provinceid = {$v} and name = '{$data['cityname'][$k]}'";
			$lineRegionShow = $this->get(array('conditions' => $where, 'limit'=>'0,1'));

			if (!empty($lineRegionShow)) {
				
				//���ݿ����쳣
				if (!empty($data['city'][$k]) && $data['city'][$k] != $lineRegionShow['id']) {continue;}				
				
				$city 		= $lineRegionShow['id'];
				$cityname	= $lineRegionShow['name'];
			} else {
				if (!empty($data['city'][$k])) {
					$temp = $this->get(array('conditions' => "id = {$data['city'][$k]}", 'limit'=>'0,1'));
					$this->edit("id = {$data['city'][$k]}", array('name' => $data['cityname'][$k]));
					$city		= $data['city'][$k];
					$cityname	= $data['cityname'][$k];
					$logLineRegion[] = array(
						'id' 	  	 => $data['city'][$k],
						'newname' 	 => $data['cityname'][$k],
						'oldname' 	 => $temp['name'],						
						'provinceid' => $temp['provinceid'],					
						'uid' 		 => $_G['uid'],					
						'username' 	 => $_G['username'],						
						'tid' 	 	 => $tid				
					);
				} else {
					//û��cityid��Ҳû��������������µ���������
					$city 		= $this->add(array('provinceid' => $v, 'name' => $data['cityname'][$k] , 'dateline' => time()));
					$cityname	= $data['cityname'][$k];
					
					$logLineRegion[] = array(
						'id' 	  	 => $city,
						'newname' 	 => $data['cityname'][$k],					
						'provinceid' => $v,
						'uid' 		 => $_G['uid'],					
						'username' 	 => $_G['username'],
						'tid' 	 	 => $tid					
					);
				}
			}

			//��plugin_line_cross�����¼
			if (isset($hasIn[$city])) {continue;}
			$new_cross_city_ids[$city] = $city;

			$mdLinecross->add(array('tid' => $tid, 'province' => $v , 'city' => $city,'ltype' => $lType, 'ltime' => $ltime));
			$hasIn[$city] = $city;			
		}

		//ͨ���Ƚ���Ӱ��ĳ��У�����������µ����ݿ�
		$affect_cross_city_ids = array();
		foreach ($old_cross_city_ids as  $ov) {
			if(! isset($new_cross_city_ids[$ov])) {
				$affect_cross_city_ids[] = $ov;
			}
		}
		foreach ($new_cross_city_ids as $nv) {
			if(! isset($old_cross_city_ids[$nv])) {
				$affect_cross_city_ids[] = $nv;
			}
		}
		//ͬ������������·����
		$affect_nums = count($affect_cross_city_ids);
		if($affect_nums) {
			if($affect_nums == 1) {
				$this->updateRegionNumByCityId($affect_cross_city_ids[0]);
			}
			else {
				$this->updateRegionNumByCityId($affect_cross_city_ids);
			}
		}
		
	
		//�ӵ�����־
		if (!empty($logLineRegion)) {
			require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('lineRegion');
			$newlogs->log_array($logLineRegion, 'lineRegion');
		}
	}
	/*����䶯ʱ���������Ӧ��·����Ŀ������Ӧ�ı仯*/
	public function updateRegionNumByCityId($city) {
		$mdLinecross = m('linecross');

		if(is_array($city)) {
			$cities_str = implode(',', $city);
			//select city, count(distinct tid) num from pre_plugin_line_cross where ltype > 0 and  city in (41,1718,1719,352,1720,1721,1722,1723) group by city;
			$sql = "SELECT city, count(tid) num FROM {$mdLinecross->table} WHERE ltype>0 AND city IN ({$cities_str}) GROUP BY city";
			$city_nums = DB::query($sql);
			$city_num_arr = array();
			while ($city_num = mysql_fetch_assoc($city_nums)) {
				$city_num_arr[$city_num['city']] = $city_num['num'];
			}
			
			//��ȡplugin_line_region��ȡ������
			$region_nums = $this->find(array('fields' => 'num',
					'conditions' => "id IN ({$cities_str})"

				));
			//ͨ���Ƚ�'��ȡ������'��'�����������'�����´�ȡ�����ݺͲ���������ݲ�һ�µ�plugin_line_region(������δ����������)
			foreach ($city_num_arr as $key => $value) {
				if($region_nums[$key] && $region_nums[$key]['num'] != $value) {
					$this->edit("id={$key}", "num={$value}");
				}
			}
			//line_cross��û�е�����Ϊ0
			foreach ($region_nums as $key => $value) {
				if(! isset($city_num_arr[$key])) {
					$this->edit("id={$key}", 'num=0');
				}
			}
		}
		else {
                    //��·����������ʾ����  ltype����û��ʲô����
			$lines = $mdLinecross->getData("city={$city} AND ltype >= 0", 'tid');
			foreach ($lines as $k => $v) {
				$tids[$v['tid']] = 1;
			}
			$this->edit('id=' . $city, array(
					'num' => count($tids),
				));
		}
	}
}
?>