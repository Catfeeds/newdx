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
	 * 读取所有省级
	 * @param Int $codeid 省的id，默认为0，此时将返回所有省
	 * @param Int $showlevel 显示级别，1为只返回当前级别，2为返回下一级，并将其信息放入child字段中，3为将再下一级也返回到对应父级的child中
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
						$_v['cityname'] = str_replace('省','',$_v['cityname']);
						$_v['cityname'] = str_replace('市','',$_v['cityname']);
						$_v['cityname'] = str_replace('回族','',$_v['cityname']);
						$_v['cityname'] = str_replace('壮族','',$_v['cityname']);
						$_v['cityname'] = str_replace('维吾尔','',$_v['cityname']);
						$_v['cityname'] = str_replace('自治区','',$_v['cityname']);
						$_v['cityname'] = str_replace('特别行政区','',$_v['cityname']);	
					}					
					$return[$_k] = $_v;
					break;
			}
		}
		//exit( '<pre>' . var_export( $return, true ) . '</pre>' );
		return $return;
	}	
	
	/**
	 * 得到所有省级城市的下一级
	 * @access public
	 * @param String $keyword 关键字
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
	
	//获取所有的省份, 该处影响行数较大,并且值是固定的,可以加缓存处理, 86400*29
	function getAllProvinces($fields='*') {
		$provinces = memory('get', 'all_provinces_in_citycode');
		
		if(! $provinces) {
			$provinces = $this->find(array(
				'fields' => $fields,
				'conditions' => 'level=1',
			));
			foreach ($provinces as $key => $value) {
				$provinces[$key]['cityname'] = str_replace('省', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('市','', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('回族', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('壮族', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('维吾尔', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('自治区', '', $provinces[$key]['cityname']);
				$provinces[$key]['cityname'] = str_replace('特别行政区', '', $provinces[$key]['cityname']);	
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
			//像香港这类下面没有城市的, 以省份作为城市
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