<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('class/record');
class userupdownlog extends record
{
	var $_vars = array(
		'uid' => true,
		'username' => true,
		'ip' => false,
		'port' => false,
		'mac' => false,
		'logonareaid' => false,
		'logontype' => false,
		'mobile' => false,
		'longitude' => false,
		'latitude' => false,
		'action' => true,
		'capturetime' => true,
		);
	var $_relation = array(
		'logonareaid' => 'ip',
		'capturetime' => 'capturetime',
		);
	var $_typename = 'userupdownlog';
	function data_logonareaid_handle($ip)
	{
		require_once libfile('function/misc');
		$city = convertip($ip, true, true);
		$city = $this->citytocode($city);
		if ($city) {
			return $city;
		} else {
			return;
		}
	}
	function citytocode($city){
		$_pos_xian = strpos($city, 'œÿ');
		$_pos_shi = strpos($city, ' –');
		$_pos_sheng = strpos($city, ' °');
		$_pos_meng = strpos($city, '√À');
		if($_pos_xian !== false){
			if($_pos_shi !== false){
				$city = substr($city, $_pos_shi + 2, $_pos_xian - $_pos_shi);
			}elseif($_pos_sheng !== false){
				$city = substr($city, $_pos_sheng + 2, $_pos_xian - $_pos_sheng);
			}else{
				$city = substr($city, 0, $_pos_xian);
			}
		}elseif($_pos_shi !== false){
			if($_pos_sheng !== false){
				$city = substr($city, $_pos_sheng + 2, $_pos_shi - $_pos_sheng);
			}elseif($_pos_meng !== false){
				$city = substr($city, $_pos_meng + 2, $_pos_shi - $_pos_meng);
			}else{
				$city = substr($city, 0, $_pos_shi + 2);
			}
		}elseif($_pos_sheng !== false){
			$city = substr($city, 0, $_pos_sheng + 2);
		}elseif($_pos_meng !== false){
			$city = substr($city, 0, $_pos_meng + 2);
		}
		$code = DB::result_first("SELECT codeid FROM " . DB::table('plugin_city_code') . " WHERE cityname = '{$city}'");
		if(intval($code) <= 0) $code = DB::result_first("SELECT codeid FROM " . DB::table('plugin_city_code') . " WHERE cityname LIKE '{$city}%' " . getSlaveID());
		return $code > 0 ? $code : $city;
	}
}
?>