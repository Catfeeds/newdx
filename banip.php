<?php
//防模拟爬虫攻击
// $spiders_key = 'Bot|Crawl|Spider|slurp|sohu-search|lycos|robozilla';
// if ($_SERVER["SERVER_ADDR"] != '27.112.8.17' && preg_match("/($spiders_key)/i", $_SERVER['HTTP_USER_AGENT'])) {
// 	header('HTTP/1.1 503 Service Temporarily Unavailable');
// 	header('Status: 503 Service Temporarily Unavailable');
// 	header('Retry-After:300');
// 	echo '503 Service Temporarily Unavailable';
// 	exit;
// }

global $myipconfigs;
require_once 'config/config_global.php';
$myipconfigs = $_config;
function get_client_ip() {
	$ip = $_SERVER['REMOTE_ADDR'];
	if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
		foreach ($matches[0] AS $xip) {
			if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
				$ip = $xip;
				break;
			}
		}
	}
	return $ip;
}
function outauthcode( $string, $operation = 'DECODE', $key = '', $expiry = 0 )
{
	global $myipconfigs;
	$ckey_length = 4;
	$key = md5( $key != '' ? $key : md5($myipconfigs['security']['authkey']) );
	$keya = md5( substr( $key, 0, 16 ) );
	$keyb = md5( substr( $key, 16, 16 ) );
	$keyc = $ckey_length ? ( $operation == 'DECODE' ? substr( $string, 0, $ckey_length ) : substr( md5( microtime() ), -$ckey_length ) ) : '';

	$cryptkey = $keya . md5( $keya . $keyc );
	$key_length = strlen( $cryptkey );

	$string = $operation == 'DECODE' ? base64_decode( substr( $string, $ckey_length ) ) : sprintf( '%010d', $expiry ? $expiry + time() : 0 ) . substr( md5( $string . $keyb ), 0, 16 ) . $string;
	$string_length = strlen( $string );

	$result = '';
	$box = range( 0, 255 );

	$rndkey = array();
	for ( $i = 0; $i <= 255; $i++ )
	{
		$rndkey[$i] = ord( $cryptkey[$i % $key_length] );
	}

	for ( $j = $i = 0; $i < 256; $i++ )
	{
		$j = ( $j + $box[$i] + $rndkey[$i] ) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for ( $a = $j = $i = 0; $i < $string_length; $i++ )
	{
		$a = ( $a + 1 ) % 256;
		$j = ( $j + $box[$a] ) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr( ord( $string[$i] ) ^ ( $box[( $box[$a] + $box[$j] ) % 256] ) );
	}

	if ( $operation == 'DECODE' )
	{
		if ( ( substr( $result, 0, 10 ) == 0 || substr( $result, 0, 10 ) - time() > 0 ) && substr( $result, 10, 16 ) == substr( md5( substr( $result, 26 ) . $keyb ), 0, 16 ) )
		{
			return substr( $result, 26 );
		}
		else
		{
			return '';
		}
	}
	else
	{
		return $keyc . str_replace( '=', '', base64_encode( $result ) );
	}

}
function outdaddslashes( $string, $force = 1 )
{
	if ( is_array( $string ) )
	{
		foreach ( $string as $key => $val )
		{
			unset( $string[$key] );
			$string[addslashes( $key )] = outdaddslashes( $val, $force );
		}
	}
	else
	{
		$string = addslashes( $string );
	}
	return $string;
}

function getcookies($key)
{
	global $myipconfigs;
	if(substr($myipconfigs['cookie']['cookiepath'], 0, 1) != '/') {
		$myipconfigs['cookie']['cookiepath'] = '/'.$myipconfigs['cookie']['cookiepath'];
	}
	$myipconfigs['cookie']['cookiepre'] = $myipconfigs['cookie']['cookiepre'].substr(md5($myipconfigs['cookie']['cookiepath'].'|'.$myipconfigs['cookie']['cookiedomain']), 0, 4).'_';
	return isset($_COOKIE[$myipconfigs['cookie']['cookiepre'] . $key]) ? $_COOKIE[$myipconfigs['cookie']['cookiepre'] . $key] : '';
}
function outgetly($str , $need, $url, $type = true){
    $return = true;
    $f = $type;
    $strarr = explode($need ,$str);
    foreach($strarr as $s){
        $s = trim($s);
        if(empty($s)) continue;
        if($type && $return===false) return false;
        if(strpos($s ,'&&')!==false){
            $return = $return && outgetly($s ,'&&' ,false);
        }
        $f = $type ? ($f && stripos($url ,$s) === false) : ($f || stripos($url ,$s) === false) ;
    }
    return $return && $f;
}
$no_url = '&inajax=1||member.php?mod=logging&action=login||member.php?mod=register||mod=image&&size=||mod=swfupload||ac=pm&&op=checknewpm||ac=sendmail||mod=seccode||id=tuaninvoke:block||ipbanspider:userunban||ac=swfupload';
$nowurl = $_SERVER['SERVER_NAME'].($_SERVER['REQUEST_URI']=='/' ? '':$_SERVER['REQUEST_URI']);
$black = false;
$nowip = get_client_ip();
$agent = isset($_SERVER['HTTP_USER_AGENT']) ? trim($_SERVER['HTTP_USER_AGENT']) : '';
$reffer = isset($_SERVER['HTTP_REFERER']) ? trim($_SERVER['HTTP_REFERER']) : '';
if(outgetly($no_url ,'||', $nowurl) !== false)
{
	$redispre = 'BanIpSpider_';
	$auth = getcookies('auth');
	$auth = outdaddslashes(explode("\t", outauthcode($auth, 'DECODE')));
	list($discuz_pw, $discuz_uid) = empty($auth) || count($auth) < 2 ? array('', '') : $auth;
	$md5bs_logon = md5("{$nowip}_{$discuz_uid}_{$agent}");
	$md5bs_nologon = md5("{$nowip}_nolog_{$agent}");
	$redis = new redis;
	$host = $myipconfigs['memory']['redis'][6379]['server'];
	$port = $myipconfigs['memory']['redis'][6379]['port'];
	$redispwd = $myipconfigs['memory']['redis'][6379]['pwd'];
	$rediscon = $redis->connect($host, $port);
	$redis->auth($redispwd);
	if($rediscon)
	{
		$redis->select(1);
		if($redis->sIsMember($redispre.'whitelist_linshi_logon_' . str_replace('.', '_', $nowip), $md5bs_logon) || $redis->sIsMember($redispre.'whitelist_linshi_nologon_' . str_replace('.', '_', $nowip), $md5bs_nologon))
		{
        	$black = false;
        }elseif($discuz_uid > 0 && $redis->sIsMember($redispre.'whitelist_by_uid', $discuz_uid))
		{
        	$black = false;
        }elseif($redis->sIsMember($redispre.'whitelist' ,$nowip))
        {
        	$black = false;
        }elseif($redis->zScore($redispre.'blacklist' ,$nowip)!==false && time() < $redis->hget($redispre.'unbantime' , $nowip))
        {
        	$black = true;
        }
	}
}

$iplist = @file('drop_ip.txt');
if(@in_array($nowip, $iplist) || @in_array($nowip."\r\n", $iplist) || (stripos($agent, 'Baiduspider')!== false && $reffer == 'http://baidu.com') || $black)
{
	if($black)
	{
		 //require 'errortips.htm';
		 header('location: http://bbs.8264.com/errortips.htm');
	}else{
		header('HTTP/1.1 503 Service Temporarily Unavailable');
		header('Status: 503 Service Temporarily Unavailable');
		header('Retry-After:300');
		echo '503 Service Temporarily Unavailable';
	}
	exit();
}
