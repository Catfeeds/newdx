<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

$configdir = realpath(dirname(__FILE__) . '/../../config/config_global.php');
include_once $configdir;
global $_CONFIG;
$_CONFIG = $_config;
function do_query_safe($sql) {
	global $_CONFIG;
	$sql = str_replace(array('\\\\', '\\\'', '\\"', '\'\''), '', $sql);
	$mark = $clean = '';
	if(strpos($sql, '/') === false && strpos($sql, '#') === false && strpos($sql, '-- ') === false) {
		$clean = preg_replace("/'(.+?)'/s", '', $sql);
	} else {
		$len = strlen($sql);
		$mark = $clean = '';
		for ($i = 0; $i <$len; $i++) {
			$str = $sql[$i];
			switch ($str) {
				case '\'':
					if(!$mark) {
						$mark = '\'';
						$clean .= $str;
					} elseif ($mark == '\'') {
						$mark = '';
					}
					break;
				case '/':
					if(empty($mark) && $sql[$i+1] == '*') {
						$mark = '/*';
						$clean .= $mark;
						$i++;
					} elseif($mark == '/*' && $sql[$i -1] == '*') {
						$mark = '';
						$clean .= '*';
					}
					break;
				case '#':
					if(empty($mark)) {
						$mark = $str;
						$clean .= $str;
					}
					break;
				case "\n":
					if($mark == '#' || $mark == '--') {
						$mark = '';
					}
					break;
				case '-':
					if(empty($mark)&& substr($sql, $i, 3) == '-- ') {
						$mark = '-- ';
						$clean .= $mark;
					}
					break;

				default:

					break;
			}
			$clean .= $mark ? '' : $str;
		}
	}

	$clean = preg_replace("/[^a-z0-9_\-\(\)#\*\/\"]+/is", "", strtolower($clean));

	if($_CONFIG['security']['querysafe']['afullnote']) {
		$clean = str_replace('/**/','',$clean);
	}

	if(is_array($_CONFIG['security']['querysafe']['dfunction'])) {
		foreach($_CONFIG['security']['querysafe']['dfunction'] as $fun) {
			if(strpos($clean, $fun.'(') !== false) return '-1';
		}
	}

	if(is_array($_CONFIG['security']['querysafe']['daction'])) {
		foreach($_CONFIG['security']['querysafe']['daction'] as $action) {
			if(strpos($clean,$action) !== false) return '-3';
		}
	}

	if($_CONFIG['security']['querysafe']['dlikehex'] && strpos($clean, 'like0x')) {
		return '-2';
	}

	if(is_array($_CONFIG['security']['querysafe']['dnote'])) {
		foreach($_CONFIG['security']['querysafe']['dnote'] as $note) {
			if(strpos($clean,$note) !== false) return '-4';
		}
	}

	return 1;

}

function convertip($ip, $full = false, $justaddr = false) {

	$return = '';

	if(preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $ip)) {

		$iparray = explode('.', $ip);

		if($iparray[0] == 10 || $iparray[0] == 127 || ($iparray[0] == 192 && $iparray[1] == 168) || ($iparray[0] == 172 && ($iparray[1] >= 16 && $iparray[1] <= 31))) {
			$return = '- LAN';
		} elseif($iparray[0] > 255 || $iparray[1] > 255 || $iparray[2] > 255 || $iparray[3] > 255) {
			$return = '- Invalid IP Address';
		} else {
			$tinyipfile = realpath(dirname(__FILE__) . '/../../data/ipdata/tinyipdata.dat');
			$fullipfile = realpath(dirname(__FILE__) . '/../../data/ipdata/wry.dat');
			if($full && @file_exists($fullipfile)){
				return convertip_full($ip, $fullipfile, $justaddr);
			}
			if(@file_exists($tinyipfile)) {
				$return = convertip_tiny($ip, $tinyipfile);
			} elseif(@file_exists($fullipfile)) {
				$return = convertip_full($ip, $fullipfile);
			}
		}
	}

	return $return;

}

function convertip_tiny($ip, $ipdatafile) {

	static $fp = NULL, $offset = array(), $index = NULL;

	$ipdot = explode('.', $ip);
	$ip    = pack('N', ip2long($ip));

	$ipdot[0] = (int)$ipdot[0];
	$ipdot[1] = (int)$ipdot[1];

	if($fp === NULL && $fp = @fopen($ipdatafile, 'rb')) {
		$offset = @unpack('Nlen', @fread($fp, 4));
		$index  = @fread($fp, $offset['len'] - 4);
	} elseif($fp == FALSE) {
		return  '- Invalid IP data file';
	}

	$length = $offset['len'] - 1028;
	$start  = @unpack('Vlen', $index[$ipdot[0] * 4] . $index[$ipdot[0] * 4 + 1] . $index[$ipdot[0] * 4 + 2] . $index[$ipdot[0] * 4 + 3]);

	for ($start = $start['len'] * 8 + 1024; $start < $length; $start += 8) {

		if ($index{$start} . $index{$start + 1} . $index{$start + 2} . $index{$start + 3} >= $ip) {
			$index_offset = @unpack('Vlen', $index{$start + 4} . $index{$start + 5} . $index{$start + 6} . "\x0");
			$index_length = @unpack('Clen', $index{$start + 7});
			break;
		}
	}

	@fseek($fp, $offset['len'] + $index_offset['len'] - 1024);
	if($index_length['len']) {
		return '- '.@fread($fp, $index_length['len']);
	} else {
		return '- Unknown';
	}

}

function convertip_full($ip, $ipdatafile, $justaddr = false) {

	if(!$fd = @fopen($ipdatafile, 'rb')) {
		return '- Invalid IP data file';
	}

	$ip = explode('.', $ip);
	$ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];

	if(!($DataBegin = fread($fd, 4)) || !($DataEnd = fread($fd, 4)) ) return;
	@$ipbegin = implode('', unpack('L', $DataBegin));
	if($ipbegin < 0) $ipbegin += pow(2, 32);
	@$ipend = implode('', unpack('L', $DataEnd));
	if($ipend < 0) $ipend += pow(2, 32);
	$ipAllNum = ($ipend - $ipbegin) / 7 + 1;

	$BeginNum = $ip2num = $ip1num = 0;
	$ipAddr1 = $ipAddr2 = '';
	$EndNum = $ipAllNum;

	while($ip1num > $ipNum || $ip2num < $ipNum) {
		$Middle= intval(($EndNum + $BeginNum) / 2);

		fseek($fd, $ipbegin + 7 * $Middle);
		$ipData1 = fread($fd, 4);
		if(strlen($ipData1) < 4) {
			fclose($fd);
			return '- System Error';
		}
		$ip1num = implode('', unpack('L', $ipData1));
		if($ip1num < 0) $ip1num += pow(2, 32);

		if($ip1num > $ipNum) {
			$EndNum = $Middle;
			continue;
		}

		$DataSeek = fread($fd, 3);
		if(strlen($DataSeek) < 3) {
			fclose($fd);
			return '- System Error';
		}
		$DataSeek = implode('', unpack('L', $DataSeek.chr(0)));
		fseek($fd, $DataSeek);
		$ipData2 = fread($fd, 4);
		if(strlen($ipData2) < 4) {
			fclose($fd);
			return '- System Error';
		}
		$ip2num = implode('', unpack('L', $ipData2));
		if($ip2num < 0) $ip2num += pow(2, 32);

		if($ip2num < $ipNum) {
			if($Middle == $BeginNum) {
				fclose($fd);
				return '- Unknown';
			}
			$BeginNum = $Middle;
		}
	}

	$ipFlag = fread($fd, 1);
	if($ipFlag == chr(1)) {
		$ipSeek = fread($fd, 3);
		if(strlen($ipSeek) < 3) {
			fclose($fd);
			return '- System Error';
		}
		$ipSeek = implode('', unpack('L', $ipSeek.chr(0)));
		fseek($fd, $ipSeek);
		$ipFlag = fread($fd, 1);
	}

	if($ipFlag == chr(2)) {
		$AddrSeek = fread($fd, 3);
		if(strlen($AddrSeek) < 3) {
			fclose($fd);
			return '- System Error';
		}
		$ipFlag = fread($fd, 1);
		if($ipFlag == chr(2)) {
			$AddrSeek2 = fread($fd, 3);
			if(strlen($AddrSeek2) < 3) {
				fclose($fd);
				return '- System Error';
			}
			$AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
			fseek($fd, $AddrSeek2);
		} else {
			fseek($fd, -1, SEEK_CUR);
		}

		while(($char = fread($fd, 1)) != chr(0))
		$ipAddr2 .= $char;

		$AddrSeek = implode('', unpack('L', $AddrSeek.chr(0)));
		fseek($fd, $AddrSeek);

		while(($char = fread($fd, 1)) != chr(0))
		$ipAddr1 .= $char;
	} else {
		fseek($fd, -1, SEEK_CUR);
		while(($char = fread($fd, 1)) != chr(0))
		$ipAddr1 .= $char;

		$ipFlag = fread($fd, 1);
		if($ipFlag == chr(2)) {
			$AddrSeek2 = fread($fd, 3);
			if(strlen($AddrSeek2) < 3) {
				fclose($fd);
				return '- System Error';
			}
			$AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
			fseek($fd, $AddrSeek2);
		} else {
			fseek($fd, -1, SEEK_CUR);
		}
		while(($char = fread($fd, 1)) != chr(0))
		$ipAddr2 .= $char;
	}
	fclose($fd);

	if(preg_match('/http/i', $ipAddr2)) {
		$ipAddr2 = '';
	}
	if($justaddr){
		$ipAddr1 = preg_replace('/CZ88\.NET/is', '', $ipAddr1);
		$ipAddr1 = preg_replace('/^\s*/is', '', $ipAddr1);
		$ipAddr1 = preg_replace('/\s*$/is', '', $ipAddr1);
		return $ipAddr1;
	}
	$ipaddr = "$ipAddr1 $ipAddr2";
	$ipaddr = preg_replace('/CZ88\.NET/is', '', $ipaddr);
	$ipaddr = preg_replace('/^\s*/is', '', $ipaddr);
	$ipaddr = preg_replace('/\s*$/is', '', $ipaddr);
	if(preg_match('/http/i', $ipaddr) || $ipaddr == '') {
		$ipaddr = '- Unknown';
	}

	return '- '.$ipaddr;

}
function citytocode($city, $dbconnect){
	$_pos_xian = strpos($city, '县');
	$_pos_shi = strpos($city, '市');
	$_pos_sheng = strpos($city, '省');
	$_pos_meng = strpos($city, '盟');
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
	$res = mysql_query("SELECT codeid, shengid, shiid, level FROM pre_plugin_city_code WHERE cityname = '{$city}'");
	$res = mysql_fetch_assoc($res);
	$code = $res['codeid'];
	if(intval($code) <= 0){
		$res = mysql_query("SELECT codeid, shengid, shiid, level FROM pre_plugin_city_code WHERE cityname LIKE '{$city}%'");
		$res = mysql_fetch_assoc($res);
		$code = $res['codeid'];
	}
	if($code > 0)
	{
		switch($res['level'])
		{
			case 1:
				return array(0 => $res['codeid'], 1 => $res['codeid']);break;
			case 2:
				return array(0 => $res['codeid'], 1 => $res['shengid']);break;
			case 3:
				return array(0 => $res['shiid'], 1 => $res['shengid']);break;
		}
	}
	return array();
}
/**
 * 通过ip查询相关的地区省会id和地方id
 * 返回数组，0为地方id，1为省会id
 * @param String $ip
 * @return array
 */
function getCodeIdByIp($ip, $dbconnect)
{
	$return = array();
	$localname = convertip($ip, true, true);
	$allids = citytocode($localname, $dbconnect);
	return $allids;
}
/**
 * 测试是否为单线程
 * @param String $threadname 线程名
 * @return boolean
 */
function testSingleThread($threadname)
{
	$threadcount = exec("ps aux|grep -c {$threadname}$", $returnarr);
	/*$oneshell = substr($returnarr[0], strrpos($returnarr[0], '/www/wwwroot/'));
	$othershell = substr($returnarr[1], strrpos($returnarr[1], '/www/wwwroot/'));*/
	return ($threadcount > 1) ? false : true;
}
?>