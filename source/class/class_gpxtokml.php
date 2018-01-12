<?php
/**
 * @author JiangHong
 * @copyright 2014
 */

class gpxtokml
{
	var $gpxall;
	var $lat_max = 0;
	var $lat_min = 0;
	var $lon_max = 0;
	var $lon_min = 0;
	var $citys = array();
	var $time_start = 0;
	var $time_end = 0;
	var $ele_max = 0;
	var $ele_min = 0;
	var $speed_max = 0;
	var $speed_min = 0;
	/**
	 * 载入gpx文件内容数组
	 */
	function load( $filearray )
	{
		if ( ! empty( $filearray ) )
		{
			$this->gpxall = $this->_iconvgpx( $filearray );
			$this->_initGpx();
		}
		else
		{
			return false;
		}
	}
	/**
	 * 对数据进行转码utf8 ==》 gbk
	 */
	function _iconvgpx( $filearray )
	{
		foreach ( $filearray as $_k => $_v )
		{
			if ( is_array( $_v ) )
			{
				$filearray[$_k] = $this->_iconvgpx( $_v );
			}
			else
			{
				$filearray[$_k] = iconv( 'utf-8', 'gbk', $_v );
			}
		}
		return $filearray;
	}
	/**
	 * 初始化gpx信息
	 */
	function _initGpx()
	{
		$this->_loadBounds();
		$this->_loadCitys();
	}
	/**
	 * 读取gpx中的边界信息
	 */
	function _loadBounds()
	{
		if ( ! empty( $this->gpxall['metadata']['bounds']['@attributes'] ) )
		{
			$_bounds = $this->gpxall['metadata']['bounds']['@attributes'];
		}
		elseif ( ! empty( $this->gpxall['bounds']['@attributes'] ) )
		{
			$_bounds = $this->gpxall['bounds']['@attributes'];
		}
		if ( ! empty( $_bounds ) )
		{
			$this->lat_max = $_bounds['maxlat'];
			$this->lat_min = $_bounds['minlat'];
			$this->lon_max = $_bounds['maxlon'];
			$this->lon_min = $_bounds['minlon'];
		}
	}
	/**
	 * 读取gpx经过的城市
	 */
	function _loadCitys()
	{
		$_int_i = 1;
		$_tempcity = array();
		while ( empty( $_tempcity ) && $this->lat_max > 0 && $this->lat_min > 0 && $this->lon_max > 0 && $this->lon_min > 0 && $_int_i <= 10 )
		{
			$q = DB::query( "SELECT * FROM " . DB::table( 'plugin_city_code' ) . " WHERE longitude >= {$this->lon_min} AND longitude <= {$this->lon_max} AND latitude >= {$this->lat_min} AND latitude <= {$this->lat_max}" );
			//echo "SELECT * FROM " . DB::table('plugin_city_code') . " WHERE longitude >= {$this->lon_min} AND longitude <= {$this->lon_max} AND latitude >= {$this->lat_min} AND latitude <= {$this->lat_max}";
			while ( $_v = DB::fetch( $q ) )
			{
				$_tempcity[$_v['codeid']] = $_v;
			}
			if ( empty( $_tempcity ) )
			{
				$_bet = floor( $_int_i / 2 ) / 20 + 0.1;
				/*每两次增加0.05，来扩大区域，找寻相近的城市坐标*/
				$this->lat_max += $_bet;
				$this->lat_min -= $_bet;
				$this->lon_max += $_bet;
				$this->lon_min -= $_bet;
			}
			//echo '<p>没有，增加' . $_bet . ' -- ' . $_int_i . '</p>';
			$_int_i++;
		}
		$_sheng = $_shi = $_xian = array();
		foreach ( $_tempcity as $_k => $_v )
		{
			switch ( $_v['level'] )
			{
				case 1:
					if ( ! in_array( $_v['codeid'], $_sheng ) )
					{
						$_sheng[] = $_v['codeid'];
					}
					break;
				case 2:
					if ( ! in_array( $_v['shengid'], $_sheng ) )
					{
						$_sheng[] = $_v['shengid'];
					}
					if ( ! in_array( $_v['codeid'], $_shi ) )
					{
						$_shi[] = $_v['codeid'];
					}
					break;
				case 3:
					if ( ! in_array( $_v['shengid'], $_sheng ) )
					{
						$_sheng[] = $_v['shengid'];
					}
					if ( ! in_array( $_v['shiid'], $_shi ) )
					{
						$_shi[] = $_v['shiid'];
					}
					if ( ! in_array( $_v['codeid'], $_xian ) )
					{
						$_xian[] = $_v['codeid'];
					}
					break;
			}
		}
		$q = DB::query( "SELECT * FROM " . DB::table( 'plugin_city_code' ) . " WHERE codeid IN(" . implode( ',', array_merge( $_sheng, $_shi, $_xian ) ) . ")" );
		while ( $v = DB::fetch( $q ) )
		{
			$_names[$v['codeid']] = $v['cityname'];
		}
		$_temparr = array(
			$_sheng,
			$_shi,
			$_xian );
		for ( $i = 0; $i < 3; $i++ )
		{
			foreach ( $_temparr[$i] as $_k => $_codeid )
			{
				$this->citys[$i][$_codeid] = $_names[$_codeid];
			}
		}
	}
}
?>