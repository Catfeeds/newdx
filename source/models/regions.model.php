<?php
/**
 * @author JiangHong
 * @copyright 2014
 */
if ( ! defined( 'IN_DISCUZ' ) )
{
	exit( 'Access Denied' );
}
class RegionsModel extends BaseModel
{
	var $table = 'plugin_city_code';
	var $prikey = 'codeid';
	var $alias = 'pccd';

	/**
	 * ��ȡ����ʡ��
	 * @param Int $codeid ʡ��id��Ĭ��Ϊ0����ʱ����������ʡ
	 * @param Int $showlevel ��ʾ����1Ϊֻ���ص�ǰ����2Ϊ������һ������������Ϣ����child�ֶ��У�3Ϊ������һ��Ҳ���ص���Ӧ������child��
	 * @return Array
	 */
	function getMyInfo( $codeid = 0, $showlevel = 1 )
	{
		$params = array( 'fields' => 'cityname, shengid, shiid' );
		$_where = '';
		$return = array();
		$mylevel = substr( $codeid, 2, 4 ) == '0000' ? 1 : ( substr( $codeid, 4, 2 ) == '00' ? 2 : 3 );
		if ( $codeid > 0 )
		{
			$_where = "codeid = {$codeid} ";
		}else{
			$_where = "level <= " . $showlevel;
		}
		if ( $mylevel < 3 )
		{
			switch ( $showlevel )
			{
				case 1:
					break;
				case 2:
					$_where .= $mylevel == 1 ? "OR (shengid = {$codeid} AND level = 2)" : "OR (shiid = {$codeid} AND level = 3)";
					break;
				case 3:
					$_where .= $mylevel == 1 ? "OR shengid = {$codeid}" : "OR shiid = {$codeid}";
					break;
			}
		}
		if ( ! empty( $_where ) )
		{
			$params['conditions'] = ltrim( $_where, 'OR' );
		}
		//exit($_where);
		$_temp = $this->find( $params );
		//echo( '<pre>' . var_export( $_temp, true ) . '</pre><hr/>' );
		foreach ( $_temp as $_k => $_v )
		{
			switch ( $mylevel )
			{
				case 1:
					if ( $_v['shengid'] == 0 )
					{						
						$return[$_k] = $_v;						
					}
					elseif ( $_v['shiid'] == 0 )
					{
						$return[$_v['shengid']]['child'][$_k] = $_v;
					}
					else
					{
						$return[$_v['shengid']]['child'][$_v['shiid']]['child'][$_k] = $_v;
					}
					break;
				case 2:
					//echo $_v;
					if ( $_v['shiid'] == 0 )
					{
						$return[$_k] = $_v;
					}
					else
					{
						$return[$_v['shiid']]['child'][$_k] = $_v;
					}
					break;
				case 3:
					if($_v['cityname']){
						$_v['cityname'] = str_replace('ʡ','',$_v['cityname']);
						$_v['cityname'] = str_replace('��','',$_v['cityname']);
						$_v['cityname'] = str_replace('����','',$_v['cityname']);
						$_v['cityname'] = str_replace('׳��','',$_v['cityname']);
						$_v['cityname'] = str_replace('ά���','',$_v['cityname']);
						$_v['cityname'] = str_replace('������','',$_v['cityname']);
						$_v['cityname'] = str_replace('�ر�������','',$_v['cityname']);	
					}					
					$return[$_k] = $_v;
					break;
			}
		}
		//exit( '<pre>' . var_export( $return, true ) . '</pre>' );
		return $return;
	}	
	
	/**
	 * �õ�����ʡ�����е���һ��
	 * @access public
	 * @param String $keyword �ؼ���
	 * @return array
	 */
	function getCity(){
		$result = array();
		$sql = "SELECT * FROM ".DB::table('plugin_city_code');
		$q = DB::query($sql);
		while ($v = DB::fetch($q))
		{
			if ($v["shengid"] == 0) {
				$result["province"][$v["codeid"]] = $v;
			} else {
				$result["city"][$v["shengid"]][$v["level"]][$v["codeid"]] = $v;
			} 
		}
		foreach ($result["city"] as $k=>$v) {
			$result["city"][$k] = isset($result["city"][$k][2]) ? $result["city"][$k][2] : $result["city"][$k][3];
		}
		return $result;
	}
	
	//��ȡ���е�ʡ��, �ô�Ӱ�������ϴ�,����ֵ�ǹ̶���,���Լӻ��洦��, 86400*29
	function getAllProvinces($fields='*') {
		$provinces = memory('get', 'all_provinces_in_citycode');
		
		if(! $provinces) {
			$provinces = $this->find(array(
				'fields' => $fields,
				'conditions' => 'level=1',
			));
			foreach ($provinces as $key => $value) {
				$provinces[$key]['cityname'] = str_replace('ʡ', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('��','', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('����', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('׳��', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('ά���', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('������', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('�ر�������', '', $provinces[$key]['cityname']);	
			}
			memory('set', 'all_provinces_in_citycode', $provinces,  2505600);
		}
		return $provinces;
	}

	function getCitiesByProvince($codeid) {
		if(! $codeid) return;
		$str = 'all_cities_inner_' . $codeid;
		$cities = memory('get', $str);
		if(! $cities) {
			$params = array(
				'fields' => 'codeid,cityname',
				'conditions' => "shengid={$codeid} AND level=2",
				'order' => 'codeid ASC',
			);
			$cities = $this->find($params);
			//�������������û�г��е�, ��ʡ����Ϊ����
			if(! $cities) {
				$provinces = $this->getAllProvinces('codeid,cityname');
				$cities[$codeid] = $provinces[$codeid];
			}
			memory('set', $str, $cities, 2505600);
		}
		
		return $cities;

	}
}
?>