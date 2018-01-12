<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_core.php 23920 2011-08-16 09:11:43Z cnteacher $
 */

if ( ! defined( 'IN_DISCUZ' ) )
{
	exit( 'Access Denied' );
}

define( 'DISCUZ_CORE_FUNCTION', true );

function system_error( $message, $show = true, $save = true, $halt = true )
{
	require_once libfile( 'class/error' );
	discuz_error::system_error( $message, $show, $save, $halt );
}

function ChildView($path, $params) {
	$file = DISCUZ_ROOT . TPLDIR . '/'. $path . '.htm';
	if(! file_exists($file)) {
		return  "$file does not exist in your project!";
	}
	$params = (array)$params;
	extract($params);
	ob_start();
	include_once $file;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

}

function updatesession( $force = false )
{

	global $_G;
	static $updated = false;
	if ( ! $updated )
	{
		if ( $_G['uid'] )
		{
			if ( $_G['cookie']['ulastactivity'] )
			{
				$ulastactivity = authcode( $_G['cookie']['ulastactivity'], 'DECODE' );
			}
			else
			{
				$ulastactivity = getuserprofile( 'lastactivity' );
				dsetcookie( 'ulastactivity', authcode( $ulastactivity, 'ENCODE' ), 31536000 );
			}
		}
		$discuz = &discuz_core::instance();
		$oltimespan = $_G['setting']['oltimespan'];
		$lastolupdate = $discuz->session->var['lastolupdate'];
		if ( $_G['uid'] && $oltimespan && TIMESTAMP - ( $lastolupdate ? $lastolupdate : $ulastactivity ) > $oltimespan * 60 )
		{
			DB::query( "UPDATE " . DB::table( 'common_onlinetime' ) . "
				SET total=total+'$oltimespan', thismonth=thismonth+'$oltimespan', lastupdate='" . TIMESTAMP . "'
				WHERE uid='{$_G['uid']}'" );
			if ( ! DB::affected_rows() )
			{
				DB::insert( 'common_onlinetime', array(
					'uid' => $_G['uid'],
					'thismonth' => $oltimespan,
					'total' => $oltimespan,
					'lastupdate' => TIMESTAMP,
					) );
			}
			$discuz->session->set( 'lastolupdate', TIMESTAMP );
		}
		foreach ( $discuz->session->var as $k => $v )
		{
			if ( isset( $_G['member'][$k] ) && $k != 'lastactivity' )
			{
				$discuz->session->set( $k, $_G['member'][$k] );
			}
		}

		foreach ( $_G['action'] as $k => $v )
		{
			$discuz->session->set( $k, $v );
		}

		$discuz->session->update();

		$updated = true;

		if ( $_G['uid'] && TIMESTAMP - $ulastactivity > 10800 )
		{
			if ( $oltimespan && TIMESTAMP - $ulastactivity > 21600 )
			{
				$total = DB::result_first( "SELECT total FROM " . DB::table( 'common_onlinetime' ) . " WHERE uid='$_G[uid]'" );
				DB::update( 'common_member_count', array( 'oltime' => round( intval( $total ) / 60 ) ), "uid='$_G[uid]'", 1 );
			}
			dsetcookie( 'ulastactivity', authcode( TIMESTAMP, 'ENCODE' ), 31536000 );
			DB::update( 'common_member_status', array(
				'lastip' => $_G['clientip'],
				'lastactivity' => TIMESTAMP,
				'lastvisit' => TIMESTAMP ), "uid='$_G[uid]'", 1 );
		}
	}
	return $updated;
}

function dmicrotime()
{
	return array_sum( explode( ' ', microtime() ) );
}

function setglobal( $key, $value, $group = null )
{
	global $_G;
	$k = explode( '/', $group === null ? $key : $group . '/' . $key );
	switch ( count( $k ) )
	{
		case 1:
			$_G[$k[0]] = $value;
			break;
		case 2:
			$_G[$k[0]][$k[1]] = $value;
			break;
		case 3:
			$_G[$k[0]][$k[1]][$k[2]] = $value;
			break;
		case 4:
			$_G[$k[0]][$k[1]][$k[2]][$k[3]] = $value;
			break;
		case 5:
			$_G[$k[0]][$k[1]][$k[2]][$k[3]][$k[4]] = $value;
			break;
	}
	return true;
}

function getglobal( $key, $group = null )
{
	global $_G;
	$k = explode( '/', $group === null ? $key : $group . '/' . $key );
	switch ( count( $k ) )
	{
		case 1:
			return isset( $_G[$k[0]] ) ? $_G[$k[0]] : null;
			break;
		case 2:
			return isset( $_G[$k[0]][$k[1]] ) ? $_G[$k[0]][$k[1]] : null;
			break;
		case 3:
			return isset( $_G[$k[0]][$k[1]][$k[2]] ) ? $_G[$k[0]][$k[1]][$k[2]] : null;
			break;
		case 4:
			return isset( $_G[$k[0]][$k[1]][$k[2]][$k[3]] ) ? $_G[$k[0]][$k[1]][$k[2]][$k[3]] : null;
			break;
		case 5:
			return isset( $_G[$k[0]][$k[1]][$k[2]][$k[3]][$k[4]] ) ? $_G[$k[0]][$k[1]][$k[2]][$k[3]][$k[4]] : null;
			break;
	}
	return null;
}

function getgpc( $k, $type = 'GP' )
{
	$type = strtoupper( $type );
	switch ( $type )
	{
		case 'G':
			$var = &$_GET;
			break;
		case 'P':
			$var = &$_POST;
			break;
		case 'C':
			$var = &$_COOKIE;
			break;
		default:
			if ( isset( $_GET[$k] ) )
			{
				$var = &$_GET;
			}
			else
			{
				$var = &$_POST;
			}
			break;
	}

	return isset( $var[$k] ) ? $var[$k] : null;

}

function getuserbyuid( $uid )
{
	static $users = array();
	if ( empty( $users[$uid] ) )
	{
		$users[$uid] = DB::fetch_first( "SELECT mc.*, ms.*, m.* FROM " . DB::table( 'common_member' ) . " m
			LEFT JOIN " . DB::table( 'common_member_count' ) . " mc USING(uid)
			LEFT JOIN " . DB::table( 'common_member_status' ) . " ms USING(uid)
			WHERE m.uid='$uid'" );
	}
	return $users[$uid];
}

function getuserprofile( $field )
{
	global $_G;
	if ( isset( $_G['member'][$field] ) )
	{
		return $_G['member'][$field];
	}
	static $tablefields = array(
		'count' => array(
			'extcredits1',
			'extcredits2',
			'extcredits3',
			'extcredits4',
			'extcredits5',
			'extcredits6',
			'extcredits7',
			'extcredits8',
			'friends',
			'posts',
			'threads',
			'digestposts',
			'doings',
			'blogs',
			'albums',
			'sharings',
			'attachsize',
			'views',
			'oltime' ),
		'status' => array(
			'regip',
			'lastip',
			'lastvisit',
			'lastactivity',
			'lastpost',
			'lastsendmail',
			'notifications',
			'myinvitations',
			'pokes',
			'pendingfriends',
			'invisible',
			'buyercredit',
			'sellercredit',
			'favtimes',
			'newinvite',
			'sharetimes' ),
		'field_forum' => array(
			'publishfeed',
			'customshow',
			'customstatus',
			'medals',
			'sightml',
			'groupterms',
			'authstr',
			'groups',
			'attentiongroup' ),
		'field_home' => array(
			'videophoto',
			'spacename',
			'spacedescription',
			'domain',
			'addsize',
			'addfriend',
			'menunum',
			'theme',
			'spacecss',
			'blockposition',
			'recentnote',
			'spacenote',
			'privacy',
			'feedfriend',
			'acceptemail',
			'magicgift' ),
		'profile' => array(
			'realname',
			'gender',
			'birthyear',
			'birthmonth',
			'birthday',
			'constellation',
			'zodiac',
			'telephone',
			'mobile',
			'idcardtype',
			'idcard',
			'address',
			'zipcode',
			'nationality',
			'birthprovince',
			'birthcity',
			'resideprovince',
			'residecity',
			'residedist',
			'residecommunity',
			'residesuite',
			'graduateschool',
			'company',
			'education',
			'occupation',
			'position',
			'revenue',
			'affectivestatus',
			'lookingfor',
			'bloodtype',
			'height',
			'weight',
			'alipay',
			'icq',
			'qq',
			'yahoo',
			'msn',
			'taobao',
			'site',
			'bio',
			'interest',
			'field1',
			'field2',
			'field3',
			'field4',
			'field5',
			'field6',
			'field7',
			'field8' ),
		'verify' => array(
			'verify1',
			'verify2',
			'verify3',
			'verify4',
			'verify5' ),
		);
	$profiletable = '';
	foreach ( $tablefields as $table => $fields )
	{
		if ( in_array( $field, $fields ) )
		{
			$profiletable = $table;
			break;
		}
	}
	if ( $profiletable )
	{
		$data = DB::fetch_first( "SELECT " . implode( ', ', $tablefields[$profiletable] ) . " FROM " . DB::table( 'common_member_' . $profiletable ) . " WHERE uid='$_G[uid]'" );
		if ( ! $data )
		{
			foreach ( $tablefields[$profiletable] as $k )
			{
				$data[$k] = '';
			}
		}
		$_G['member'] = array_merge( is_array( $_G['member'] ) ? $_G['member'] : array(), $data );
		return $_G['member'][$field];
	}
}

function daddslashes( $string, $force = 1 )
{
	if ( is_array( $string ) )
	{
		foreach ( $string as $key => $val )
		{
			unset( $string[$key] );
			$string[addslashes( $key )] = daddslashes( $val, $force );
		}
	}
	else
	{
		$string = addslashes( $string );
	}
	return $string;
}

function dgbkaddslashes( $string )
{
	if ( is_array( $string ) )
	{
		foreach ( $string as $key => $val )
		{
			unset( $string[$key] );
			$string[addslashes( $key )] = dgbkaddslashes( $val, $force );
		}
	}
	else
	{
		$new_string = '';
		$str_count = strlen( $string );

		for ( $i = 0; $i < $str_count; )
		{
			if ( ord( $string[$i] ) > 0x80 && ord( $string[$i] ) < 0xFF )
			{
				$new_string .= $string[$i] . $string[$i + 1];
				$i += 2;
			}
			else
			{
				$new_string .= addslashes( $string[$i] );
				$i += 1;
			}
		}
		$string = $new_string;
	}
	return $new_string;
}

function authcode( $string, $operation = 'DECODE', $key = '', $expiry = 0 )
{
	$ckey_length = 4;
	$key = md5( $key != '' ? $key : getglobal( 'authkey' ) );
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

function dfsockopen( $url, $limit = 0, $post = '', $cookie = '', $bysocket = false, $ip = '', $timeout = 15, $block = true )
{
	require_once libfile( 'function/filesock' );
	return _dfsockopen( $url, $limit, $post, $cookie, $bysocket, $ip, $timeout, $block );
}

function dhtmlspecialchars( $string )
{
	if ( is_array( $string ) )
	{
		foreach ( $string as $key => $val )
		{
			$string[$key] = dhtmlspecialchars( $val );
		}
	}
	else
	{
		$string = preg_replace( '/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', str_replace( array(
			'&',
			'"',
			'<',
			'>' ), array(
			'&amp;',
			'&quot;',
			'&lt;',
			'&gt;' ), $string ) );
	}
	return $string;
}

function dexit( $message = '' )
{
	echo $message;
	output();
	exit();
}

function dheader( $string, $replace = true, $http_response_code = 0 )
{
	//noteX (IN_MOBILE)
	if ( defined( 'IN_MOBILE' ) && strpos( $string, 'mobile' ) === false && preg_match( '/^\s*location:/is', $string ) )
	{
		if ( strpos( $string, '?' ) === false )
		{
			$string = $string . '?mobile=yes';
		}
		else
		{
			if ( strpos( $string, '#' ) === false )
			{
				$string = $string . '&mobile=yes';
			}
			else
			{
				$str_arr = explode( '#', $string );
				$str_arr[0] = $str_arr[0] . '&mobile=yes';
				$string = implode( '#', $str_arr );
			}
		}
	}
	$string = str_replace( array( "\r", "\n" ), array( '', '' ), $string );
	if ( empty( $http_response_code ) || PHP_VERSION < '4.3' )
	{
		@header( $string, $replace );
	}
	else
	{
		@header( $string, $replace, $http_response_code );
	}
	if ( preg_match( '/^\s*location:/is', $string ) )
	{
		exit();
	}
}

function dsetcookie( $var, $value = '', $life = 0, $prefix = 1, $httponly = false )
{

	global $_G;

	$config = $_G['config']['cookie'];

	$_G['cookie'][$var] = $value;
	$var = ( $prefix ? $config['cookiepre'] : '' ) . $var;
	$_COOKIE[$var] = $var;

	if ( $value == '' || $life < 0 )
	{
		$value = '';
		$life = -1;
	}

	$life = $life > 0 ? getglobal( 'timestamp' ) + $life : ( $life < 0 ? getglobal( 'timestamp' ) - 31536000 : 0 );
	$path = $httponly && PHP_VERSION < '5.2.0' ? $config['cookiepath'] . '; HttpOnly' : $config['cookiepath'];

	$secure = $_SERVER['SERVER_PORT'] == 443 ? 1 : 0;
	if ( PHP_VERSION < '5.2.0' )
	{
		setcookie( $var, $value, $life, $path, $config['cookiedomain'], $secure );
	}
	else
	{
		setcookie( $var, $value, $life, $path, $config['cookiedomain'], $secure, $httponly );
	}
}

function getcookie( $key )
{
	global $_G;
	return isset( $_G['cookie'][$key] ) ? $_G['cookie'][$key] : '';
}

function fileext( $filename )
{
	return addslashes( trim( substr( strrchr( $filename, '.' ), 1, 10 ) ) );
}

function formhash( $specialadd = '' )
{
	global $_G;
	$hashadd = defined( 'IN_ADMINCP' ) ? 'Only For Discuz! Admin Control Panel' : '';
	return substr( md5( substr( $_G['timestamp'], 0, -7 ) . $_G['username'] . $_G['uid'] . $_G['authkey'] . $hashadd . $specialadd ), 8, 8 );
}

function checkrobot( $useragent = '' )
{
	static $kw_spiders = 'Bot|Crawl|Spider|slurp|sohu-search|lycos|robozilla';
	static $kw_browsers = 'MSIE|Netscape|Opera|Konqueror|Mozilla';

	$useragent = empty( $useragent ) ? $_SERVER['HTTP_USER_AGENT'] : $useragent;

	if ( ! strexists( $useragent, 'http://' ) && preg_match( "/($kw_browsers)/i", $useragent ) )
	{
		return false;
	}
	elseif ( preg_match( "/($kw_spiders)/i", $useragent ) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

/**
 * (IN_MOBILE)
 */
function checkmobile()
{
	global $_G;
	$mobile = array();
	static $mobilebrowser_list = 'iPhone|Android|WAP|NetFront|JAVA|Opera\sMini|UCWEB|Windows\sCE|Symbian|Series|webOS|SonyEricsson|Sony|BlackBerry|Cellphone|dopod|Nokia|samsung|PalmSource|Xphone|Xda|Smartphone|PIEPlus|MEIZU|MIDP|CLDC';
	//note &#545;&#1467;
	if ( preg_match( "/$mobilebrowser_list/i", $_SERVER['HTTP_USER_AGENT'], $mobile ) )
	{
		$_G['mobile'] = $mobile[0];
		return true;
	}
	else
	{
		if ( preg_match( '/(mozilla|chrome|safari|opera|m3gate|winwap|openwave)/i', $_SERVER['HTTP_USER_AGENT'] ) )
		{
			return false;
		}
		else
		{
			$_G['mobile'] = 'unknown';
			if ( $_GET['mobile'] === 'yes' )
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}

function isemail( $email )
{
	return strlen( $email ) > 6 && preg_match( "/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email );
}

function quescrypt( $questionid, $answer )
{
	return $questionid > 0 && $answer != '' ? substr( md5( $answer . md5( $questionid ) ), 16, 8 ) : '';
}

function random( $length, $numeric = 0 )
{
	$seed = base_convert( md5( microtime() . $_SERVER['DOCUMENT_ROOT'] ), 16, $numeric ? 10 : 35 );
	$seed = $numeric ? ( str_replace( '0', '', $seed ) . '012340567890' ) : ( $seed . 'zZ' . strtoupper( $seed ) );
	$hash = '';
	$max = strlen( $seed ) - 1;
	for ( $i = 0; $i < $length; $i++ )
	{
		$hash .= $seed{mt_rand( 0, $max )};
	}
	return $hash;
}

function strexists( $string, $find )
{
	return ! ( strpos( $string, $find ) === false );
}

function avatar( $uid, $size = 'middle', $returnsrc = false, $real = false, $static = false, $ucenterurl = '', $rand = false )
{
	global $_G;
	static $staticavatar;
	if ( $staticavatar === null )
	{
		$staticavatar = $_G['setting']['avatarmethod'];
	}

	$ucenterurl = empty( $ucenterurl ) ? $_G['setting']['ucenterurl'] : $ucenterurl;
	$size = in_array( $size, array(
		'big',
		'middle',
		'small' ) ) ? $size : 'middle';
	$uid = abs( intval( $uid ) );
	if ( ! $staticavatar && ! $static )
	{
		return $returnsrc ? $ucenterurl . '/avatar.php?uid=' . $uid . '&size=' . $size : '<img src="' . $ucenterurl . '/avatar.php?uid=' . $uid . '&size=' . $size . ( $real ? '&type=real' : '' ) . '" />';
	}
	else
	{
		$uid = sprintf( "%09d", $uid );
		$dir1 = substr( $uid, 0, 3 );
		$dir2 = substr( $uid, 3, 2 );
		$dir3 = substr( $uid, 5, 2 );
		$file = 'data/avatar/' . $dir1 . '/' . $dir2 . '/' . $dir3 . '/' . substr( $uid, -2 ) . ( $real ? '_real' : '' ) . '_avatar_' . $size . '.jpg';
        var_dump($file);exit();
		$url = $_G['config']['web']['avatar'] . $file;
		// if(($op = @fopen($url,'rb')) && ($str = @fread($op , 300)) && fclose($op) && strlen($str)>=300){
		$file = $url;
		// }else{
		// $file = $ucenterurl.'/'.$file;
		// }
		$file .= $rand ? '?' . random( 6 ) : '';




		return $returnsrc ? $file : '<img src="' . $file . '" onerror="this.onerror=null;this.src=\'' . $ucenterurl . '/images/noavatar_' . $size . '.gif\'" />';
	}
}

function lang( $file, $langvar = null, $vars = array(), $default = null )
{
	global $_G;
	list( $path, $file ) = explode( '/', $file );
	if ( ! $file )
	{
		$file = $path;
		$path = '';
	}

	if ( $path != 'plugin' )
	{
		$key = $path == '' ? $file : $path . '_' . $file;
		if ( ! isset( $_G['lang'][$key] ) )
		{
			include DISCUZ_ROOT . './source/language/' . ( $path == '' ? '' : $path . '/' ) . 'lang_' . $file . '.php';
			$_G['lang'][$key] = $lang;
		}

		//noteX (IN_MOBILE)
		if ( defined( 'IN_MOBILE' ) && ! defined( 'TPL_DEFAULT' ) )
		{
			include DISCUZ_ROOT . './source/language/mobile/lang_template.php';
			$_G['lang'][$key] = array_merge( $_G['lang'][$key], $lang );
		}

		$returnvalue = &$_G['lang'];
	}
	else
	{
		if ( empty( $_G['config']['plugindeveloper'] ) )
		{
			loadcache( 'pluginlanguage_script' );
		}
		elseif ( ! isset( $_G['cache']['pluginlanguage_script'][$file] ) && preg_match( "/^[a-z]+[a-z0-9_]*$/i", $file ) )
		{
			if ( @include ( DISCUZ_ROOT . './data/plugindata/' . $file . '.lang.php' ) )
			{
				$_G['cache']['pluginlanguage_script'][$file] = $scriptlang[$file];
			}
			else
			{
				loadcache( 'pluginlanguage_script' );
			}
		}
		$returnvalue = &$_G['cache']['pluginlanguage_script'];
		$key = &$file;
	}
	$return = $langvar !== null ? ( isset( $returnvalue[$key][$langvar] ) ? $returnvalue[$key][$langvar] : null ) : $returnvalue[$key];
	$return = $return === null ? ( $default !== null ? $default : $langvar ) : $return;
	$searchs = $replaces = array();
	if ( $vars && is_array( $vars ) )
	{
		foreach ( $vars as $k => $v )
		{
			$searchs[] = '{' . $k . '}';
			$replaces[] = $v;
		}
	}
	if ( is_string( $return ) && strpos( $return, '{_G/' ) !== false )
	{
		preg_match_all( '/\{_G\/(.+?)\}/', $return, $gvar );
		foreach ( $gvar[0] as $k => $v )
		{
			$searchs[] = $v;
			$replaces[] = getglobal( $gvar[1][$k] );
		}
	}
	$return = str_replace( $searchs, $replaces, $return );
	return $return;
}

function checktplrefresh( $maintpl, $subtpl, $timecompare, $templateid, $cachefile, $tpldir, $file )
{
	static $tplrefresh, $timestamp;
	global $_G;
	if ( $tplrefresh === null )
	{
		$tplrefresh = getglobal( 'config/output/tplrefresh' );
		$timestamp = getglobal( 'timestamp' );
	}
	if ( empty( $timecompare ) || $tplrefresh == 1 || ( $tplrefresh > 1 && ! ( $timestamp % $tplrefresh ) ) )
	{
		if ( empty( $timecompare ) || @filemtime( DISCUZ_ROOT . $subtpl ) > $timecompare || $_G['template_last_update_time'] > $timecompare )
		{
			require_once DISCUZ_ROOT . '/source/class/class_template.php';
			$template = new template();
			$template->parse_template( $maintpl, $templateid, $tpldir, $file, $cachefile );
			return true;
		}
	}
	return false;
}

function template( $file, $templateid = 0, $tpldir = '', $gettplfile = 0, $primaltpl = '' )
{
	global $_G;
	static $_init_style = false;
	if ( $_init_style === false )
	{
		$discuz = &discuz_core::instance();
		$discuz->_init_style();
		$_init_style = true;
	}
	if ( strexists( $file, ':' ) )
	{
		$clonefile = '';
		list( $templateid, $file, $clonefile ) = explode( ':', $file );
		$oldfile = $file;
		$file = empty( $clonefile ) || STYLEID != $_G['cache']['style_default']['styleid'] ? $file : $file . '_' . $clonefile;
		if ( $templateid == 'diy' && STYLEID == $_G['cache']['style_default']['styleid'] )
		{
			$_G['style']['prefile'] = '';
			$diypath = DISCUZ_ROOT . './data/diy/';
			$preend = '_diy_preview';
			$previewname = $diypath . $file . $preend . '.htm';
			$_G['gp_preview'] = ! empty( $_G['gp_preview'] ) ? $_G['gp_preview'] : '';
			$curtplname = $oldfile;

			$dateline = DB::result_first( "SELECT dateline FROM " . DB::table( 'common_diy' ) . " WHERE diyname = 'data/diy/{$file}.htm'" );
			if ( $dateline )
			{
				$tpldir = 'data/diy';
				$curtplname = $file;
				$flag = file_exists( $previewname );
				if ( $_G['gp_preview'] == 'yes' )
				{
					$file .= $flag ? $preend : '';
				}
				else
				{
					$_G['style']['prefile'] = $flag ? 1 : '';
				}
			}
			else
			{
				$file = $primaltpl ? $primaltpl : $oldfile;
			}

			if ( $_G['uid'] == 1 )
			{
				updatediytemplate( $file );
			}
			$tplrefresh = $_G['config']['output']['tplrefresh'];
			if ( file_exists( DISCUZ_ROOT . TPLDIR . '/' . ( $primaltpl ? $primaltpl : $oldfile ) . '.htm' ) )
			{
				$tplotime = @filemtime( DISCUZ_ROOT . TPLDIR . '/' . ( $primaltpl ? $primaltpl : $oldfile ) . '.htm' );
			}
			else
			{
				$tplotime = @filemtime( DISCUZ_ROOT . './template/default' . '/' . ( $primaltpl ? $primaltpl : $oldfile ) . '.htm' );
			}
			if ( $tpldir == 'data/diy' && ( $tplrefresh == 1 || ( $tplrefresh > 1 && ! ( $_G['timestamp'] % $tplrefresh ) ) ) && $dateline && $dateline < $tplotime )
			{
				if ( ! updatediytemplate( $file ) )
				{
					DB::delete( 'common_diy', array( "diyname" => "data/diy/$file.htm" ) );
					$tpldir = '';
				}
			}
			if ( ! $gettplfile && empty( $_G['style']['tplfile'] ) )
			{
				$_G['style']['tplfile'] = empty( $clonefile ) ? $curtplname : $oldfile . ':' . $clonefile;
			}
			$_G['style']['prefile'] = ! empty( $_G['gp_preview'] ) && $_G['gp_preview'] == 'yes' ? '' : $_G['style']['prefile'];
		}
		else
		{
			$tpldir = './source/plugin/' . $templateid . '/template';
		}
	}

	//noteX (IN_MOBILE)
	if ( defined( 'IN_MOBILE' ) && ! defined( 'TPL_DEFAULT' ) || $_G['forcemobilemessage'] )
	{
		$file = 'mobile/' . $file;
	}

	// lxp 20131204
	$ajaxTpl = array('common/header', 'common/footer', 'common/header_8264_new', 'common/footer_8264_new');
	$file .= !empty($_G['inajax']) && in_array($file, $ajaxTpl) ? '_ajax' : '';

	$tpldir = $tpldir ? $tpldir : ( defined( 'TPLDIR' ) ? TPLDIR : '' );

	$templateid = $templateid ? $templateid : ( defined( 'TEMPLATEID' ) ? TEMPLATEID : '' );
	$tplfile = ( $tpldir ? $tpldir . '/' : './template/' ) . $file . '.htm';
	$filebak = $file;
	$file == 'common/header' && defined( 'CURMODULE' ) && CURMODULE && $file = 'common/header_' . $_G['basescript'] . '_' . CURMODULE;

	//noteX (IN_MOBILE)
	if ( defined( 'IN_MOBILE' ) && ! defined( 'TPL_DEFAULT' ) )
	{
		if ( strpos( $tpldir, 'plugin' ) )
		{
			if ( ! file_exists( DISCUZ_ROOT . $tpldir . '/' . $file . '.htm' ) )
			{
				return;
			}
			else
			{
				$mobiletplfile = $tpldir . '/' . $file . '.htm';
			}
		}
		elseif ( $tpldir == 'data/diy' )
		{
			if ( preg_match( "/_\\d+/i", $file, $matchs ) )
			{
				$tplfile_diy_ext = $matchs[0];
				$file = str_replace( $tplfile_diy_ext, '', $file );
			}
		}
		! $mobiletplfile && $mobiletplfile = $file . '.htm';
		if ( strpos( $tpldir, 'plugin' ) && file_exists( DISCUZ_ROOT . $mobiletplfile ) )
		{
			$tplfile = $mobiletplfile;
		}
		elseif ( ! file_exists( DISCUZ_ROOT . TPLDIR . '/' . $mobiletplfile ) )
		{
			$mobiletplfile = './template/default/' . $mobiletplfile;
			if ( ! file_exists( DISCUZ_ROOT . $mobiletplfile ) && ! $_G['forcemobilemessage'] )
			{
				$tplfile = str_replace( 'mobile/', '', $tplfile );
				$file = str_replace( 'mobile/', '', $file );
				$cachefile = str_replace( 'mobile_', '', $cachefile );
				define( 'TPL_DEFAULT', true );
			}
			else
			{
				$tplfile = $mobiletplfile;
			}
		}
		else
		{
			$tplfile = TPLDIR . '/' . $mobiletplfile;
		}
	}
	//新版判断
	if($_G['newtpl'] && file_exists(DISCUZ_ROOT . $tpldir . '/' . $filebak . '_2014.htm')){
		$tplfile = $tpldir . '/' . $filebak . '_2014.htm';
		$file .= '_2014';
	}
	$cachefile = './data/template/' . ( defined( 'STYLEID' ) ? STYLEID . '_' : '_' ) . $templateid . '_' . str_replace( '/', '_', $file ) . '.tpl.php';
	if ( $templateid != 1 && ! file_exists( DISCUZ_ROOT . $tplfile ) )
	{
		if ( file_exists( DISCUZ_ROOT . './template/8264/' . $filebak . '.htm' ) ){
			$tplfile = './template/8264/' . $filebak . '.htm';
		} else {
			$tplfile = './template/default/' . $filebak . '.htm';
		}
	}
	if ( $gettplfile )
	{
		return $tplfile;
	}
	checktplrefresh( $tplfile, $tplfile, @filemtime( DISCUZ_ROOT . $cachefile ), $templateid, $cachefile, $tpldir, $file );
	return DISCUZ_ROOT . $cachefile;
}

function modauthkey( $id )
{
	global $_G;
	return md5( $_G['username'] . $_G['uid'] . $_G['authkey'] . substr( TIMESTAMP, 0, -7 ) . $id );
}

function getcurrentnav()
{
	global $_G;
	if ( ! empty( $_G['mnid'] ) )
	{
		return $_G['mnid'];
	}
	$mnid = '';
	$_G['basefilename'] = $_G['basefilename'] == $_G['basescript'] ? $_G['basefilename'] : $_G['basescript'] . '.php';
	if ( array_key_exists( $_G['basefilename'], $_G['setting']['navmns'] ) )
	{
		foreach ( $_G['setting']['navmns'][$_G['basefilename']] as $navmn )
		{
			if ( $navmn[0] == array_intersect_assoc( $navmn[0], $_GET ) )
			{
				$mnid = $navmn[1];
			}
		}
	}
	if ( ! $mnid && isset( $_G['setting']['navdms'] ) )
	{
		foreach ( $_G['setting']['navdms'] as $navdm => $navid )
		{
			if ( strexists( strtolower( $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ), $navdm ) )
			{
				$mnid = $navid;
				break;
			}
		}
	}
	if ( ! $mnid && isset( $_G['setting']['navmn'][$_G['basefilename']] ) )
	{
		$mnid = $_G['setting']['navmn'][$_G['basefilename']];
	}
	return $mnid;
}

function loaducenter()
{
	require_once DISCUZ_ROOT . './config/config_ucenter.php';
	require_once DISCUZ_ROOT . './uc_client/client.php';
}

function loadcache( $cachenames, $force = false )
{
	global $_G;
	static $loadedcache = array();
	$cachenames = is_array( $cachenames ) ? $cachenames : array( $cachenames );
	$caches = array();
	foreach ( $cachenames as $k )
	{
		if ( ! isset( $loadedcache[$k] ) || $force )
		{
			$caches[] = $k;
			$loadedcache[$k] = true;
		}
	}

	if ( ! empty( $caches ) )
	{
		$cachedata = cachedata( $caches );
		foreach ( $cachedata as $cname => $data )
		{
			if ( $cname == 'setting' )
			{
				$_G['setting'] = $data;
			}
			elseif ( strexists( $cname, 'usergroup_' . $_G['groupid'] ) )
			{
				$_G['cache'][$cname] = $_G['perm'] = $_G['group'] = $data;
			}
			elseif ( ! $_G['uid'] && strexists( $cname, $_G['setting']['newusergroupid'] ) )
			{
				$_G['perm'] = $data;
			}
			elseif ( $cname == 'style_default' )
			{
				$_G['cache'][$cname] = $_G['style'] = $data;
			}
			elseif ( $cname == 'grouplevels' )
			{
				$_G['grouplevels'] = $data;
			}
			else
			{
				$_G['cache'][$cname] = $data;
			}
		}
	}
	return true;
}

function cachedata( $cachenames )
{
	global $_G;
	static $isfilecache, $allowmem;

	if ( $isfilecache === null )
	{
		$isfilecache = getglobal( 'config/cache/type' ) == 'file';
		$allowmem = memory( 'check' );
	}

	$data = array();
	$cachenames = is_array( $cachenames ) ? $cachenames : array( $cachenames );

	if ( $allowmem )
	{
		$newarray = array();
		foreach ( $cachenames as $name )
		{
			$data[$name] = memory( 'get', $name );
			if ( $data[$name] === null )
			{
				$data[$name] = null;
				$newarray[] = $name;
			}
		}
		if ( empty( $newarray ) )
		{
			return $data;
		}
		else
		{
			$cachenames = $newarray;
		}
	}

	if ( $isfilecache )
	{
		$lostcaches = array();
		foreach ( $cachenames as $cachename )
		{
			if ( ! @include_once ( DISCUZ_ROOT . './data/cache/cache_' . $cachename . '.php' ) )
			{
				$lostcaches[] = $cachename;
			}
		}
		if ( ! $lostcaches )
		{
			return $data;
		}
		$cachenames = $lostcaches;
		unset( $lostcaches );
	}

	$query = DB::query( "SELECT * FROM " . DB::table( 'common_syscache' ) . " WHERE cname IN ('" . implode( "','", $cachenames ) . "')" );
	while ( $syscache = DB::fetch( $query ) )
	{
		$data[$syscache['cname']] = $syscache['ctype'] ? unserialize( $syscache['data'] ) : $syscache['data'];
		$allowmem && ( memory( 'set', $syscache['cname'], $data[$syscache['cname']] ) );
		if ( $isfilecache )
		{
			$cachedata = '$data[\'' . $syscache['cname'] . '\'] = ' . var_export( $data[$syscache['cname']], true ) . ";\n\n";
			if ( $fp = @fopen( DISCUZ_ROOT . './data/cache/cache_' . $syscache['cname'] . '.php', 'wb' ) )
			{
				fwrite( $fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: " . md5( $syscache['cname'] . $cachedata . $_G['config']['security']['authkey'] ) . "\n\n$cachedata?>" );
				fclose( $fp );
			}
		}
	}

	foreach ( $cachenames as $name )
	{
		if ( $data[$name] === null )
		{
			$data[$name] = null;
			$allowmem && ( memory( 'set', $name, array() ) );
		}
	}
	return $data;
}

function dgmdate( $timestamp, $format = 'dt', $timeoffset = '9999', $uformat = '' )
{
	global $_G;
	$format == 'u' && ! $_G['setting']['dateconvert'] && $format = 'dt';
	static $dformat, $tformat, $dtformat, $offset, $lang;
	if ( $dformat === null )
	{
		$dformat = getglobal( 'setting/dateformat' );
		$tformat = getglobal( 'setting/timeformat' );
		$dtformat = $dformat . ' ' . $tformat;
		$offset = getglobal( 'member/timeoffset' );
		$lang = lang( 'core', 'date' );
	}
	$timeoffset = $timeoffset == 9999 ? $offset : $timeoffset;
	$timestamp += $timeoffset * 3600;
	$format = empty( $format ) || $format == 'dt' ? $dtformat : ( $format == 'd' ? $dformat : ( $format == 't' ? $tformat : $format ) );
	if ( $format == 'u' )
	{
		$todaytimestamp = TIMESTAMP - ( TIMESTAMP + $timeoffset * 3600 ) % 86400 + $timeoffset * 3600;
		$s = gmdate( ! $uformat ? $dtformat : $uformat, $timestamp );
		$time = TIMESTAMP + $timeoffset * 3600 - $timestamp;
		if ( $timestamp >= $todaytimestamp )
		{
			if ( $time > 3600 )
			{
				return '<span title="' . $s . '">' . intval( $time / 3600 ) . '&nbsp;' . $lang['hour'] . $lang['before'] . '</span>';
			}
			elseif ( $time > 1800 )
			{
				return '<span title="' . $s . '">' . $lang['half'] . $lang['hour'] . $lang['before'] . '</span>';
			}
			elseif ( $time > 60 )
			{
				return '<span title="' . $s . '">' . intval( $time / 60 ) . '&nbsp;' . $lang['min'] . $lang['before'] . '</span>';
			}
			elseif ( $time > 0 )
			{
				return '<span title="' . $s . '">' . $time . '&nbsp;' . $lang['sec'] . $lang['before'] . '</span>';
			}
			elseif ( $time == 0 )
			{
				return '<span title="' . $s . '">' . $lang['now'] . '</span>';
			}
			else
			{
				return $s;
			}
		}
		elseif ( ( $days = intval( ( $todaytimestamp - $timestamp ) / 86400 ) ) >= 0 && $days < 7 )
		{
			if ( $days == 0 )
			{
				return '<span title="' . $s . '">' . $lang['yday'] . '&nbsp;' . gmdate( $tformat, $timestamp ) . '</span>';
			}
			elseif ( $days == 1 )
			{
				return '<span title="' . $s . '">' . $lang['byday'] . '&nbsp;' . gmdate( $tformat, $timestamp ) . '</span>';
			}
			else
			{
				return '<span title="' . $s . '">' . ( $days + 1 ) . '&nbsp;' . $lang['day'] . $lang['before'] . '</span>';
			}
		}
		else
		{
			return $s;
		}
	}
	else
	{
		return gmdate( $format, $timestamp );
	}
}

function dmktime( $date )
{
	if ( strpos( $date, '-' ) )
	{
		$time = explode( '-', $date );
		return mktime( 0, 0, 0, $time[1], $time[2], $time[0] );
	}
	return 0;
}

function save_syscache( $cachename, $data )
{
	static $isfilecache, $allowmem;
	if ( $isfilecache === null )
	{
		$isfilecache = getglobal( 'config/cache/type' ) == 'file';
		$allowmem = memory( 'check' );
	}

	$olddata = $data;
	if ( is_array( $data ) )
	{
		$ctype = 1;
		$data = addslashes( serialize( $data ) );
	}
	else
	{
		$ctype = 0;
	}

	DB::query( "REPLACE INTO " . DB::table( 'common_syscache' ) . " (cname, ctype, dateline, data) VALUES ('$cachename', '$ctype', '" . TIMESTAMP . "', '$data')" );

	// 	$allowmem && memory('rm', $cachename);
	$allowmem && memory( 'set', $cachename, $olddata ); // lxp 20131106
	$isfilecache && @unlink( DISCUZ_ROOT . './data/cache/cache_' . $cachename . '.php' );
}

function block_get( $parameter )
{
	global $_G;
	static $allowmem;
	if ( $allowmem === null )
	{
		include_once libfile( 'function/block' );
		$allowmem = getglobal( 'setting/memory/diyblock/enable' ) && memory( 'check' );
	}
	if ( $parameter == '4837' )
	{
		$usemem = false;
	}
	else
		$usemem = true;
	if ( ! $allowmem || ! usemem )
	{
		block_get_batch( $parameter );
		return true;
	}

	$blockids = explode( ',', $parameter );
	$lostbids = array();
	foreach ( $blockids as $bid )
	{
		$bid = intval( $bid );
		if ( $bid )
		{
			$_G['block'][$bid] = memory( 'get', 'blockcache_' . $bid );
			if ( $_G['block'][$bid] === null )
			{
				$lostbids[] = $bid;
			}
			else
			{
				$styleid = $_G['block'][$bid]['styleid'];
				if ( $styleid && ! isset( $_G['blockstyle_' . $styleid] ) )
				{
					$_G['blockstyle_' . $styleid] = memory( 'get', 'blockstylecache_' . $styleid );
				}
			}
		}
	}

	if ( $lostbids )
	{
		block_get_batch( implode( ',', $lostbids ) );
		foreach ( $lostbids as $bid )
		{
			if ( isset( $_G['block'][$bid] ) )
			{
				memory( 'set', 'blockcache_' . $bid, $_G['block'][$bid], getglobal( 'setting/memory/diyblock/ttl' ) );
				$styleid = $_G['block'][$bid]['styleid'];
				if ( $styleid && $_G['blockstyle_' . $styleid] )
				{
					memory( 'set', 'blockstylecache_' . $styleid, $_G['blockstyle_' . $styleid], getglobal( 'setting/memory/diyblock/ttl' ) );
				}
			}
		}
	}
}

function block_display( $bid )
{
	include_once libfile( 'function/block' );
	block_display_batch( $bid );
}

function dimplode( $array )
{
	if ( ! empty( $array ) )
	{
		return "'" . implode( "','", is_array( $array ) ? $array : array( $array ) ) . "'";
	}
	else
	{
		return 0;
	}
}

function libfile( $libname, $folder = '' )
{
	$libpath = DISCUZ_ROOT . '/source/' . $folder;
	if ( strstr( $libname, '/' ) )
	{
		list( $pre, $name ) = explode( '/', $libname );
		return realpath( "{$libpath}/{$pre}/{$pre}_{$name}.php" );
	}
	else
	{
		return realpath( "{$libpath}/{$libname}.php" );
	}
}

function dstrlen( $str )
{
	if ( strtolower( CHARSET ) != 'utf-8' )
	{
		return strlen( $str );
	}
	$count = 0;
	for ( $i = 0; $i < strlen( $str ); $i++ )
	{
		$value = ord( $str[$i] );
		if ( $value > 127 )
		{
			$count++;
			if ( $value >= 192 && $value <= 223 )
				$i++;
			elseif ( $value >= 224 && $value <= 239 )
				$i = $i + 2;
			elseif ( $value >= 240 && $value <= 247 )
				$i = $i + 3;
		}
		$count++;
	}
	return $count;
}

function cutstr( $string, $length, $dot = ' ...' )
{
	if ( strlen( $string ) <= $length )
	{
		return $string;
	}

	$pre = chr( 1 );
	$end = chr( 1 );
	$string = str_replace( array(
		'&amp;',
		'&quot;',
		'&lt;',
		'&gt;' ), array(
		$pre . '&' . $end,
		$pre . '"' . $end,
		$pre . '<' . $end,
		$pre . '>' . $end ), $string );

	$strcut = '';
	if ( strtolower( CHARSET ) == 'utf-8' )
	{

		$n = $tn = $noc = 0;
		while ( $n < strlen( $string ) )
		{

			$t = ord( $string[$n] );
			if ( $t == 9 || $t == 10 || ( 32 <= $t && $t <= 126 ) )
			{
				$tn = 1;
				$n++;
				$noc++;
			}
			elseif ( 194 <= $t && $t <= 223 )
			{
				$tn = 2;
				$n += 2;
				$noc += 2;
			}
			elseif ( 224 <= $t && $t <= 239 )
			{
				$tn = 3;
				$n += 3;
				$noc += 2;
			}
			elseif ( 240 <= $t && $t <= 247 )
			{
				$tn = 4;
				$n += 4;
				$noc += 2;
			}
			elseif ( 248 <= $t && $t <= 251 )
			{
				$tn = 5;
				$n += 5;
				$noc += 2;
			}
			elseif ( $t == 252 || $t == 253 )
			{
				$tn = 6;
				$n += 6;
				$noc += 2;
			}
			else
			{
				$n++;
			}

			if ( $noc >= $length )
			{
				break;
			}

		}
		if ( $noc > $length )
		{
			$n -= $tn;
		}

		$strcut = substr( $string, 0, $n );

	}
	else
	{
		for ( $i = 0; $i < $length; $i++ )
		{
			$strcut .= ord( $string[$i] ) > 127 ? $string[$i] . $string[++$i] : $string[$i];
		}
	}

	$strcut = str_replace( array(
		$pre . '&' . $end,
		$pre . '"' . $end,
		$pre . '<' . $end,
		$pre . '>' . $end ), array(
		'&amp;',
		'&quot;',
		'&lt;',
		'&gt;' ), $strcut );

	$pos = strrpos( $strcut, chr( 1 ) );
	if ( $pos !== false )
	{
		$strcut = substr( $strcut, 0, $pos );
	}
	return $strcut . $dot;
}

function dstripslashes( $string )
{
	if ( is_array( $string ) )
	{
		foreach ( $string as $key => $val )
		{
			$string[$key] = dstripslashes( $val );
		}
	}
	else
	{
		$string = stripslashes( $string );
	}
	return $string;
}

function aidencode( $aid, $type = 0 )
{
	global $_G;
	$s = ! $type ? $aid . '|' . substr( md5( $aid . md5( $_G['config']['security']['authkey'] ) . TIMESTAMP . $_G['uid'] ), 0, 8 ) . '|' . TIMESTAMP . '|' . $_G['uid'] : $aid . '|' . md5( $aid . md5( $_G['config']['security']['authkey'] ) . TIMESTAMP ) . '|' . TIMESTAMP;
	return rawurlencode( base64_encode( $s ) );
}

function getforumimg( $aid, $nocache = 0, $w = 140, $h = 140, $type = '' )
{
	global $_G;
	$key = authcode( "$aid\t$w\t$h", 'ENCODE', $_G['config']['security']['authkey'] );
	return 'forum.php?mod=image&aid=' . $aid . '&size=' . $w . 'x' . $h . '&key=' . rawurlencode( $key ) . ( $nocache ? '&nocache=yes' : '' ) . ( $type ? '&type=' . $type : '' );
}

function rewritedata()
{
	global $_G;
	$data = array();
	if ( ! defined( 'IN_ADMINCP' ) )
	{
		if ( in_array( 'portal_topic', $_G['setting']['rewritestatus'] ) )
		{
			$data['search']['portal_topic'] = "/" . $_G['domain']['pregxprw']['portal'] . "\?mod\=topic&(amp;)?topic\=(.+?)?\"([^\>]*)\>/e";
			$data['replace']['portal_topic'] = "rewriteoutput('portal_topic', 0, '\\1', '\\3', '\\4')";
		}

		if ( in_array( 'portal_article', $_G['setting']['rewritestatus'] ) )
		{
			$data['search']['portal_article'] = "/" . $_G['domain']['pregxprw']['portal'] . "\?mod\=view&(amp;)?aid\=(\d+)(&amp;page\=(\d+))?\"([^\>]*)\>/e";
			$data['replace']['portal_article'] = "rewriteoutput('portal_article', 0, '\\1', '\\3', '\\5', '\\6')";
		}

		if ( in_array( 'forum_forumdisplay', $_G['setting']['rewritestatus'] ) )
		{
			$data['search']['forum_forumdisplay'] = "/" . $_G['domain']['pregxprw']['forum'] . "\?mod\=forumdisplay&(amp;)?fid\=(\w+)(&amp;page\=(\d+))?\"([^\>]*)\>/e";
			$data['replace']['forum_forumdisplay'] = "rewriteoutput('forum_forumdisplay', 0, '\\1', '\\3', '\\5', '\\6')";
		}

		if ( in_array( 'forum_viewthread', $_G['setting']['rewritestatus'] ) )
		{
			$data['search']['forum_viewthread'] = "/" . $_G['domain']['pregxprw']['forum'] . "\?mod\=viewthread&(amp;)?tid\=(\d+)(&amp;extra\=(page\%3D(\d+))?)?(&amp;page\=(\d+))?\"([^\>]*)\>/e";
			$data['replace']['forum_viewthread'] = "rewriteoutput('forum_viewthread', 0, '\\1', '\\3', '\\8', '\\6', '\\9')";
		}

		if ( in_array( 'group_group', $_G['setting']['rewritestatus'] ) )
		{
			$data['search']['group_group'] = "/" . $_G['domain']['pregxprw']['forum'] . "\?mod\=group&(amp;)?fid\=(\d+)(&amp;page\=(\d+))?\"([^\>]*)\>/e";
			$data['replace']['group_group'] = "rewriteoutput('group_group', 0, '\\1', '\\3', '\\5', '\\6')";
		}

		if ( in_array( 'home_space', $_G['setting']['rewritestatus'] ) )
		{
			$data['search']['home_space'] = "/" . $_G['domain']['pregxprw']['home'] . "\?mod=space&(amp;)?(uid\=(\d+)|username\=([^&]+?))\"([^\>]*)\>/e";
			$data['replace']['home_space'] = "rewriteoutput('home_space', 0, '\\1', '\\4', '\\5', '\\6')";
		}
		//每日一图重写规则
		if ( in_array( 'forum_picture', $_G['setting']['rewritestatus'] ) )
		{
			$data['search']['forum_picture'] = "/" . $_G['domain']['pregxprw']['forum'] . "\?mod\=picture&(amp;)?tid\=(\d+)(&amp;extra\=(page\%3D(\d+))?)?(&amp;page\=(\d+))?\"([^\>]*)\>/e";
			$data['replace']['forum_picture'] = "rewriteoutput('forum_picture', 0, '\\1', '\\3', '\\8', '\\6', '\\9')";
		}
		if ( in_array( 'all_script', $_G['setting']['rewritestatus'] ) )
		{
			$data['search']['all_script'] = "/" . $_G['domain']['pregxprw']['all_script'] . "(([a-z]+)\.php)?\?mod=([^\"]+?)\"([^\>]*)?\>/e";
			$data['replace']['all_script'] = "rewriteoutput('all_script', 0, '\\1', '\\4', '\\5', '\\6', '\\7')";
		}
		if ( $_G['config']['cssversion']['opend'] === true )
		{
			$cssversion = memory( 'get', 'cache_plugin_cssversion' );
			if ( ! $cssversion )
			{
				$q = DB::query( "SELECT * FROM " . DB::table( 'plugin_servers_css' ) );
				while( $v = DB::fetch( $q ) )
				{
					$cssversion[] = array('cssid' => $v['cssid'], 'name' => '\/' . str_replace('/', '\/', $v['name']), 'version' => $v['version']);
				}
				if( ! empty( $cssversion) )
				{
					memory( 'set', 'cache_plugin_cssversion', $cssversion, 24 * 3600);
				}
			}
			foreach( $cssversion as $_css )
			{
				$data['search']['css_' . $_css['cssid']] = "/(" . $_css['name'] . ")(\?(\\w|\\d)*)?('|\")+/i";
				$data['replace']['css_' . $_css['cssid']] = "\\1?vers_" . $_css['version'] . "\\4";
			}

		}
	}
	else
	{
		$data['rulesearch']['portal_topic'] = 'topic-{name}.html';
		$data['rulereplace']['portal_topic'] = 'portal.php?mod=topic&topic={name}';
		$data['rulevars']['portal_topic']['{name}'] = '(.+)';

		$data['rulesearch']['portal_article'] = 'article-{id}-{page}.html';
		$data['rulereplace']['portal_article'] = 'portal.php?mod=view&aid={id}&page={page}';
		$data['rulevars']['portal_article']['{id}'] = '([0-9]+)';
		$data['rulevars']['portal_article']['{page}'] = '([0-9]+)';

		$data['rulesearch']['forum_forumdisplay'] = 'forum-{fid}-{page}.html';
		$data['rulereplace']['forum_forumdisplay'] = 'forum.php?mod=forumdisplay&fid={fid}&page={page}';
		$data['rulevars']['forum_forumdisplay']['{fid}'] = '(\w+)';
		$data['rulevars']['forum_forumdisplay']['{page}'] = '([0-9]+)';

		$data['rulesearch']['forum_viewthread'] = 'thread-{tid}-{page}-{prevpage}.html';
		$data['rulereplace']['forum_viewthread'] = 'forum.php?mod=viewthread&tid={tid}&extra=page\%3D{prevpage}&page={page}';
		$data['rulevars']['forum_viewthread']['{tid}'] = '([0-9]+)';
		$data['rulevars']['forum_viewthread']['{page}'] = '([0-9]+)';
		$data['rulevars']['forum_viewthread']['{prevpage}'] = '([0-9]+)';

		$data['rulesearch']['group_group'] = 'group-{fid}-{page}.html';
		$data['rulereplace']['group_group'] = 'forum.php?mod=group&fid={fid}&page={page}';
		$data['rulevars']['group_group']['{fid}'] = '([0-9]+)';
		$data['rulevars']['group_group']['{page}'] = '([0-9]+)';

		$data['rulesearch']['home_space'] = 'space-{user}-{value}.html';
		$data['rulereplace']['home_space'] = 'home.php?mod=space&{user}={value}';
		$data['rulevars']['home_space']['{user}'] = '(username|uid)';
		$data['rulevars']['home_space']['{value}'] = '(.+)';

		$data['rulesearch']['forum_picture'] = 'picture-{tid}-{page}-{prevpage}.html';
		$data['rulereplace']['forum_picture'] = 'forum.php?mod=picture&tid={tid}&extra=page\%3D{prevpage}&page={page}';
		$data['rulevars']['forum_picture']['{tid}'] = '([0-9]+)';
		$data['rulevars']['forum_picture']['{page}'] = '([0-9]+)';
		$data['rulevars']['forum_picture']['{prevpage}'] = '([0-9]+)';

		$data['rulesearch']['all_script'] = '{script}-{param}.html';
		$data['rulereplace']['all_script'] = '{script}.php?rewrite={param}';
		$data['rulevars']['all_script']['{script}'] = '([a-z]+)';
		$data['rulevars']['all_script']['{param}'] = '(.+)';
	}
	return $data;
}

function rewriteoutput( $type, $returntype, $host )
{
	global $_G;
	$host = $host ? 'http://' . $host : '';
	$fextra = '';
	if ( $type == 'forum_forumdisplay' )
	{
		list( , , , $fid, $page, $extra ) = func_get_args();
		$r = array(
			'{fid}' => empty( $_G['setting']['forumkeys'][$fid] ) ? $fid : $_G['setting']['forumkeys'][$fid],
			'{page}' => $page ? $page : 1,
			);
	}
	elseif ( $type == 'forum_viewthread' )
	{
		list( , , , $tid, $page, $prevpage, $extra ) = func_get_args();
		$r = array(
			'{tid}' => $tid,
			'{page}' => $page ? $page : 1,
			'{prevpage}' => $prevpage && ! IS_ROBOT ? $prevpage : 1,
			);
	}
	elseif ( $type == 'home_space' )
	{
		list( , , , $uid, $username, $extra ) = func_get_args();
		$_G['setting']['rewritecompatible'] && $username = rawurlencode( $username );
		$r = array(
			'{user}' => $uid ? 'uid' : 'username',
			'{value}' => $uid ? $uid : $username,
			);
	}
	elseif ( $type == 'group_group' )
	{
		list( , , , $fid, $page, $extra ) = func_get_args();
		$r = array(
			'{fid}' => $fid,
			'{page}' => $page ? $page : 1,
			);
	}
	elseif ( $type == 'portal_topic' )
	{
		list( , , , $name, $extra ) = func_get_args();
		$r = array( '{name}' => $name, );
	}
	elseif ( $type == 'portal_article' )
	{
		list( , , , $id, $page, $extra ) = func_get_args();
		$r = array(
			'{id}' => $id,
			'{page}' => $page ? $page : 1,
			);
	}
	elseif ( $type == 'forum_picture' )
	{
		list( , , , $tid, $page, $prevpage, $extra ) = func_get_args();
		$r = array(
			'{tid}' => $tid,
			'{page}' => $page ? $page : 1,
			'{prevpage}' => $prevpage && ! IS_ROBOT ? $prevpage : 1,
			);
	}
	elseif ( $type == 'all_script' )
	{
		list( , , , $script, $param, $extra ) = func_get_args();
		if ( ! $script )
			$script = 'index';
		if ( preg_match( '/^space&(amp;)?u[^&]+$/', $param ) )
		{
			$extra .= ' c=1';
		}
		if ( strexists( $extra, 'showWindow' ) || strexists( $extra, 'ajax' ) || strexists( $param, '/' ) || strexists( $param, '%2F' ) || strexists( $param, '-' ) )
		{
			return '<a href="' . $script . '.php?mod=' . $param . '"' . dstripslashes( $extra ) . '>';
		}
		if ( ( $apos = strrpos( $param, '#' ) ) !== false )
		{
			$fextra = substr( $param, $apos );
			$param = substr( $param, 0, $apos );
		}
		$param = str_replace( '&amp;', '&', $param );
		parse_str( $param, $params );
		$param = $comma = '';
		$i = 0;
		foreach ( $params as $k => $v )
		{
			if ( $i )
			{
				$param .= $comma . $k . '-' . rawurlencode( $v );
				$comma = '-';
			}
			else
			{
				$param .= $k . '-';
				$i++;
			}
		}
		$r = array(
			'{script}' => $script,
			'{param}' => substr( $param, -1 ) != '-' ? $param : substr( $param, 0, strlen( $param ) - 1 ),
			);
	}
	elseif ( $type == 'site_default' )
	{
		list( , , , $url ) = func_get_args();
		if ( ! preg_match( '/^\w+\.php/i', $url ) )
		{
			$host = '';
		}
		if ( ! $returntype )
		{
			return '<a href="' . $host . $url . '"';
		}
		else
		{
			return $host . $url;
		}
	}
	$href = str_replace( array_keys( $r ), $r, $_G['setting']['rewriterule'][$type] ) . $fextra;
	if ( ! $returntype )
	{
		return '<a href="' . $host . $href . '"' . dstripslashes( $extra ) . '>';
	}
	else
	{
		return $host . $href;
	}
}

function mobilereplace( $file, $replace )
{
	global $_G;
	$findm = strpos( $replace, 'mobile=' );
	if ( $findm === false )
	{
		$findmark = strpos( $replace, '?' );
		if ( $findmark === false )
		{
			$replace = 'href="' . $file . $replace . '?mobile=yes"';
		}
		else
		{
			$replace = 'href="' . $file . $replace . '&mobile=yes"';
		}
		return $replace;
	}
	else
	{
		return 'href="' . $file . $replace . '"';
	}
}

function mobileoutput()
{
	global $_G;
	if ( defined( 'IN_MOBILE' ) && ! defined( 'TPL_DEFAULT' ) )
	{
		$content = ob_get_contents();
		ob_end_clean();
		$content = preg_replace( "/href=\"(\w+\.php)(.*?)\"/e", "mobilereplace('\\1', '\\2')", $content );

		ob_start();
		$content = '<?xml version="1.0" encoding="utf-8"?>' . $content;
		if ( 'utf-8' != CHARSET )
		{
			@header( 'Content-Type: text/html; charset=utf-8' );
			$content = diconv( $content, CHARSET, 'utf-8' );
		}
		echo $content;
		exit();
	}
	elseif ( defined( 'IN_MOBILE' ) && defined( 'TPL_DEFAULT' ) && ! $_G['cookie']['dismobilemessage'] && $_G['mobile'] )
	{
		ob_end_clean();
		ob_start();
		$_G['forcemobilemessage'] = true;
		$query_sting_tmp = str_replace( array( '&mobile=yes', 'mobile=yes' ), array( '' ), $_SERVER['QUERY_STRING'] );
		$_G['setting']['mobile']['pageurl'] = $_G['siteurl'] . substr( $_G['PHP_SELF'], 1 ) . ( $query_sting_tmp ? '?' . $query_sting_tmp . '&mobile=no' : '?mobile=no' );
		unset( $query_sting_tmp );
		dsetcookie( 'dismobilemessage', '1', 3600 );
		showmessage( 'not_in_mobile' );
		exit;
	}
}

function output()
{

	global $_G;

	if ( defined( 'DISCUZ_OUTPUTED' ) )
	{
		return;
	}
	else
	{
		define( 'DISCUZ_OUTPUTED', 1 );
	}

	if ( ! empty( $_G['blockupdate'] ) )
	{
		block_updatecache( $_G['blockupdate']['bid'] );
	}
	if ( empty( $_G['setting']['domain']['app']['default'] ) )
	{
		$temp = parse_url( $_G['siteurl'] );
		$_G['setting']['domain']['app']['default'] = $temp['host'];
	}
	$_G['domain'] = array();
	$port = empty( $_SERVER['SERVER_PORT'] ) || $_SERVER['SERVER_PORT'] == '80' ? '' : ':' . $_SERVER['SERVER_PORT'];

	//noteX (IN_MOBILE)
	mobileoutput();

	if ( is_array( $_G['setting']['domain']['app'] ) )
	{
		foreach ( $_G['setting']['domain']['app'] as $app => $domain )
		{
			if ( $domain || $_G['setting']['domain']['app']['default'] )
			{
				$appphp = "{$app}.php";
				if ( ! $domain )
				{
					$domain = $_G['setting']['domain']['app']['default'];
				}
				$_G['domain']['search'][$app] = "<a href=\"{$app}.php";
				$_G['domain']['replace'][$app] = '<a href="http://' . $domain . $port . $_G['siteroot'] . $appphp;
				$_G['domain']['pregxprw'][$app] = '<a href\="http\:\/\/(' . preg_quote( $domain . $port . $_G['siteroot'], '/' ) . ')' . $appphp;
			}
			else
			{
				$_G['domain']['pregxprw'][$app] = "<a href\=\"(){$app}.php";
			}
		}
		$_G['domain']['pregxprw']['all_script'] .= '<a href\="http\:\/\/((' . implode( '|', $_G['setting']['domain']['app'] ) . ')' . preg_quote( $port . $_G['siteroot'], '/' ) . ')';
	}

	if ( $_G['setting']['rewritestatus'] || $_G['domain']['search'] )
	{
		$content = ob_get_contents();

		$_G['domain']['search'] && $content = str_replace( $_G['domain']['search'], $_G['domain']['replace'], $content );

		$_G['setting']['domain']['app']['default'] && $content = preg_replace( "/<a href=\"([^\"]+)\"/e", "rewriteoutput('site_default', 0, '" . $_G['setting']['domain']['app']['default'] . $port . $_G['siteroot'] . "', '\\1')", $content );

		if ( $_G['setting']['rewritestatus'] && ! defined( 'IN_MODCP' ) && ! defined( 'IN_ADMINCP' ) )
		{
			$searcharray = $replacearray = array();
			$array = rewritedata();
			$content = preg_replace( $array['search'], $array['replace'], $content );
		}

		ob_end_clean();
		$_G['gzipcompress'] ? ob_start( 'ob_gzhandler' ) : ob_start();

		echo $content;
		echo "<!--test ob_get_contents2-->";
	}

	if ( $_G['setting']['ftp']['connid'] )
	{
		@ftp_close( $_G['setting']['ftp']['connid'] );
	}
	$_G['setting']['ftp'] = array();
	if ( defined( 'CACHE_FILE' ) && CACHE_FILE && ! defined( 'CACHE_FORBIDDEN' ) )
	{
		memory_redis( 'set', CACHE_FILE, empty( $content ) ? ob_get_contents() : $content, 900, 6376 );
		/*global $_G;
		* if(diskfreespace(DISCUZ_ROOT.'./'.$_G['setting']['cachethreaddir']) > 1000000) {
		* if($fp = @fopen(CACHE_FILE, 'w')) {
		* flock($fp, LOCK_EX);
		* fwrite($fp, empty($content) ? ob_get_contents() : $content);
		* }
		* @fclose($fp);
		* chmod(CACHE_FILE, 0777);
		* }*/
	}

	if ( defined( 'DISCUZ_DEBUG' ) && DISCUZ_DEBUG && @include ( libfile( 'function/debug' ) ) )
	{
		function_exists( 'debugmessage' ) && debugmessage();
	}
}

function output_ajax()
{
	$s = ob_get_contents();
	ob_end_clean();
	$s = preg_replace( "/([\\x01-\\x08\\x0b-\\x0c\\x0e-\\x1f])+/", ' ', $s );
	$s = str_replace( array( chr( 0 ), ']]>' ), array( ' ', ']]&gt;' ), $s );
	if ( defined( 'DISCUZ_DEBUG' ) && DISCUZ_DEBUG && @include ( libfile( 'function/debug' ) ) )
	{
		function_exists( 'debugmessage' ) && $s .= debugmessage( 1 );
	}
	return $s;
}

function runhooks()
{
	if ( ! defined( 'HOOKTYPE' ) )
	{
		define( 'HOOKTYPE', ! defined( 'IN_MOBILE' ) ? 'hookscript' : 'hookscriptmobile' );
	}
	if ( defined( 'CURMODULE' ) )
	{
		global $_G;
		if ( $_G['setting']['plugins'][HOOKTYPE . '_common'] )
		{
			hookscript( 'common', 'global', 'funcs', array(), 'common' );
		}
		hookscript( CURMODULE, $_G['basescript'] );
	}
}

function hookscript( $script, $hscript, $type = 'funcs', $param = array(), $func = '' )
{
	global $_G;
	static $pluginclasses;
	if ( $hscript == 'home' )
	{
		if ( $script != 'spacecp' )
		{
			$script = 'space_' . ( ! empty( $_G['gp_do'] ) ? $_G['gp_do'] : ( ! empty( $_GET['do'] ) ? $_GET['do'] : '' ) );
		}
		else
		{
			$script .= ! empty( $_G['gp_ac'] ) ? '_' . $_G['gp_ac'] : ( ! empty( $_GET['ac'] ) ? '_' . $_GET['ac'] : '' );
		}
	}
	if ( ! isset( $_G['setting'][HOOKTYPE][$hscript][$script][$type] ) )
	{
		return;
	}
	if ( ! isset( $_G['cache']['plugin'] ) )
	{
		loadcache( 'plugin' );
	}
	foreach ( ( array )$_G['setting'][HOOKTYPE][$hscript][$script]['module'] as $identifier => $include )
	{
		$hooksadminid[$identifier] = ! $_G['setting'][HOOKTYPE][$hscript][$script]['adminid'][$identifier] || ( $_G['setting'][HOOKTYPE][$hscript][$script]['adminid'][$identifier] && $_G['adminid'] > 0 && $_G['setting']['hookscript'][$hscript][$script]['adminid'][$identifier] >= $_G['adminid'] );
		if ( $hooksadminid[$identifier] )
		{
			@include_once DISCUZ_ROOT . './source/plugin/' . $include . '.class.php';
		}
	}
	if ( @is_array( $_G['setting'][HOOKTYPE][$hscript][$script][$type] ) )
	{
		$_G['inhookscript'] = true;
		$funcs = ! $func ? $_G['setting'][HOOKTYPE][$hscript][$script][$type] : array( $func => $_G['setting'][HOOKTYPE][$hscript][$script][$type][$func] );
		foreach ( $funcs as $hookkey => $hookfuncs )
		{
			foreach ( $hookfuncs as $hookfunc )
			{
				if ( $hooksadminid[$hookfunc[0]] )
				{
					$classkey = ( HOOKTYPE != 'hookscriptmobile' ? '' : 'mobile' ) . 'plugin_' . ( $hookfunc[0] . ( $hscript != 'global' ? '_' . $hscript : '' ) );
					if ( ! class_exists( $classkey ) )
					{
						continue;
					}
					if ( ! isset( $pluginclasses[$classkey] ) )
					{
						$pluginclasses[$classkey] = new $classkey;
					}
					if ( ! method_exists( $pluginclasses[$classkey], $hookfunc[1] ) )
					{
						continue;
					}
					$return = $pluginclasses[$classkey]->$hookfunc[1]( $param );

					if ( is_array( $return ) )
					{
						if ( ! isset( $_G['setting']['pluginhooks'][$hookkey] ) || is_array( $_G['setting']['pluginhooks'][$hookkey] ) )
						{
							foreach ( $return as $k => $v )
							{
								$_G['setting']['pluginhooks'][$hookkey][$k] .= $v;
							}
						}
					}
					else
					{
						if ( ! is_array( $_G['setting']['pluginhooks'][$hookkey] ) )
						{
							$_G['setting']['pluginhooks'][$hookkey] .= $return;
						}
						else
						{
							foreach ( $_G['setting']['pluginhooks'][$hookkey] as $k => $v )
							{
								$_G['setting']['pluginhooks'][$hookkey][$k] .= $return;
							}
						}
					}
				}
			}
		}
	}
	$_G['inhookscript'] = false;
}

function hookscriptoutput( $tplfile, $templateheader = '')
{
	global $_G;
	if ( ! empty( $_G['hookscriptoutput'] ) )
	{
		return;
	}
	if ( ! empty( $_G['gp_mobiledata'] ) )
	{
		require_once libfile( 'class/mobiledata' );
		$mobiledata = new mobiledata();
		if ( $mobiledata->validator() )
		{
			$mobiledata->outputvariables();
		}
	}
	hookscript( 'global', 'global' , 'funcs', array('template' => $tplfile, 'header' => $templateheader));
	if ( defined( 'CURMODULE' ) )
	{
		$param = array(
			'template' => $tplfile,
			'message' => $_G['hookscriptmessage'],
			'values' => $_G['hookscriptvalues'],
			'header' => $templateheader );
		hookscript( CURMODULE, $_G['basescript'], 'outputfuncs', $param );
	}
	$_G['hookscriptoutput'] = true;
}

function pluginmodule( $pluginid, $type )
{
	global $_G;
	if ( ! isset( $_G['cache']['plugin'] ) )
	{
		loadcache( 'plugin' );
	}
	list( $identifier, $module ) = explode( ':', $pluginid );
	if ( ! is_array( $_G['setting']['plugins'][$type] ) || ! array_key_exists( $pluginid, $_G['setting']['plugins'][$type] ) )
	{
		showmessage( 'undefined_action' );
	}
	if ( ! empty( $_G['setting']['plugins'][$type][$pluginid]['url'] ) )
	{
		dheader( 'location: ' . $_G['setting']['plugins'][$type][$pluginid]['url'] );
	}
	$directory = $_G['setting']['plugins'][$type][$pluginid]['directory'];
	if ( empty( $identifier ) || ! preg_match( "/^[a-z]+[a-z0-9_]*\/$/i", $directory ) || ! preg_match( "/^[a-z0-9_\-]+$/i", $module ) )
	{
		showmessage( 'undefined_action' );
	}
	if ( @! file_exists( DISCUZ_ROOT . ( $modfile = './source/plugin/' . $directory . $module . '.inc.php' ) ) )
	{
		showmessage( 'plugin_module_nonexistence', '', array( 'mod' => $modfile ) );
	}
	return DISCUZ_ROOT . $modfile;
}
function updatecreditbyaction( $action, $uid = 0, $extrasql = array(), $needle = '', $coef = 1, $update = 1, $fid = 0 )
{

	include_once libfile( 'class/credit' );
	$credit = &credit::instance();
	if ( $extrasql )
	{
		$credit->extrasql = $extrasql;
	}
	return $credit->execrule( $action, $uid, $needle, $coef, $update, $fid );
}

function checklowerlimit( $action, $uid = 0, $coef = 1, $fid = 0, $returnonly = 0 )
{
	global $_G;

	include_once libfile( 'class/credit' );
	$credit = &credit::instance();
	$limit = $credit->lowerlimit( $action, $uid, $coef, $fid );
	if ( $returnonly )
		return $limit;
	if ( $limit !== true )
	{
		$GLOBALS['id'] = $limit;
		$lowerlimit = is_array( $action ) && $action['extcredits' . $limit] ? abs( $action['extcredits' . $limit] ) + $_G['setting']['creditspolicy']['lowerlimit'][$limit] : $_G['setting']['creditspolicy']['lowerlimit'][$limit];
		$rulecredit = array();
		if ( ! is_array( $action ) )
		{
			$rule = $credit->getrule( $action, $fid );
			foreach ( $_G['setting']['extcredits'] as $extcreditid => $extcredit )
			{
				if ( $rule['extcredits' . $extcreditid] )
				{
					$rulecredit[] = $extcredit['title'] . ( $rule['extcredits' . $extcreditid] > 0 ? '+' . $rule['extcredits' . $extcreditid] : $rule['extcredits' . $extcreditid] );
				}
			}
		}
		else
		{
			$rule = array();
		}
		$values = array(
			'title' => $_G['setting']['extcredits'][$limit]['title'],
			'lowerlimit' => $lowerlimit,
			'unit' => $_G['setting']['extcredits'][$limit]['unit'],
			'ruletext' => $rule['rulename'],
			'rulecredit' => implode( ', ', $rulecredit ) );
		if ( ! is_array( $action ) )
		{
			if ( ! $fid )
			{
				showmessage( 'credits_policy_lowerlimit', '', $values );
			}
			else
			{
				showmessage( 'credits_policy_lowerlimit_fid', '', $values );
			}
		}
		else
		{
			showmessage( 'credits_policy_lowerlimit_norule', '', $values );
		}
	}
}

function batchupdatecredit( $action, $uids = 0, $extrasql = array(), $coef = 1, $fid = 0 )
{

	include_once libfile( 'class/credit' );
	$credit = &credit::instance();
	if ( $extrasql )
	{
		$credit->extrasql = $extrasql;
	}
	return $credit->updatecreditbyrule( $action, $uids, $coef, $fid );
}

function updatemembercount( $uids, $dataarr = array(), $checkgroup = true, $operation = '', $relatedid = 0, $ruletxt = '' )
{
	if ( empty( $uids ) )
		return;
	if ( ! is_array( $dataarr ) || empty( $dataarr ) )
		return;
	if ( $operation && $relatedid )
	{
		$writelog = true;
		$log = array(
			'uid' => $uids,
			'operation' => $operation,
			'relatedid' => $relatedid,
			'dateline' => time(),
			);
	}
	else
	{
		$writelog = false;
	}
	$data = array();
	foreach ( $dataarr as $key => $val )
	{
		if ( empty( $val ) )
			continue;
		$val = intval( $val );
		$id = intval( $key );
		if ( 0 < $id && $id < 9 )
		{
			$data['extcredits' . $id] = $val;
			$writelog && $log['extcredits' . $id] = $val;
		}
		else
		{
			$data[$key] = $val;
		}
	}
	if ( $writelog )
	{
		DB::insert( 'common_credit_log', $log );
	}
	if ( $data )
	{
		include_once libfile( 'class/credit' );
		$credit = &credit::instance();
		$credit->updatemembercount( $data, $uids, $checkgroup, $ruletxt );
	}
}

function checkusergroup( $uid = 0 )
{
	include_once libfile( 'class/credit' );
	$credit = &credit::instance();
	$credit->checkusergroup( $uid );
}

function checkformulasyntax( $formula, $operators, $tokens )
{
	$var = implode( '|', $tokens );
	$operator = implode( '', $operators );

	$operator = str_replace( array(
		'+',
		'-',
		'*',
		'/',
		'(',
		')',
		'{',
		'}',
		'\'' ), array(
		'\+',
		'\-',
		'\*',
		'\/',
		'\(',
		'\)',
		'\{',
		'\}',
		'\\\'' ), $operator );

	if ( ! empty( $formula ) )
	{
		if ( ! preg_match( "/^([$operator\.\d\(\)]|(($var)([$operator\(\)]|$)+))+$/", $formula ) || ! is_null( eval( preg_replace( "/($var)/", "\$\\1", $formula ) . ';' ) ) )
		{
			return false;
		}
	}
	return true;
}

function checkformulacredits( $formula )
{
	return checkformulasyntax( $formula, array(
		'+',
		'-',
		'*',
		'/',
		' ' ), array(
		'extcredits[1-8]',
		'digestposts',
		'posts',
		'threads',
		'oltime',
		'friends',
		'doings',
		'polls',
		'blogs',
		'albums',
		'sharings' ) );
}

function debug( $var = null )
{
	echo '<pre>';
	if ( $var === null )
	{
		print_r( $GLOBALS );
	}
	else
	{
		print_r( $var );
	}
	exit();
}

function debuginfo()
{
	global $_G;
	if ( getglobal( 'setting/debug' ) )
	{
		$db = &DB::object();
		$_G['debuginfo'] = array(
			'time' => number_format( ( dmicrotime() - $_G['starttime'] ), 6 ),
			'queries' => $db->querynum,
			'memory' => ucwords( $_G['memory'] ) );
		return true;
	}
	else
	{
		return false;
	}
}

function getfocus_rand( $module )
{
	global $_G;

	if ( empty( $_G['setting']['focus'] ) || ! array_key_exists( $module, $_G['setting']['focus'] ) )
	{
		return null;
	}
	do
	{
		$focusid = $_G['setting']['focus'][$module][array_rand( $_G['setting']['focus'][$module] )];
		if ( ! empty( $_G['cookie']['nofocus_' . $focusid] ) )
		{
			unset( $_G['setting']['focus'][$module][$focusid] );
			$continue = 1;
		}
		else
		{
			$continue = 0;
		}
	} while ( ! empty( $_G['setting']['focus'][$module] ) && $continue );
	if ( ! $_G['setting']['focus'][$module] )
	{
		return null;
	}
	loadcache( 'focus' );
	if ( empty( $_G['cache']['focus']['data'] ) || ! is_array( $_G['cache']['focus']['data'] ) )
	{
		return null;
	}
	return $focusid;
}

function check_seccode( $value, $idhash )
{
	global $_G;
	if ( ! $_G['setting']['seccodestatus'] )
	{
		return true;
	}
	if ( ! isset( $_G['cookie']['seccode' . $idhash] ) )
	{
		return false;
	}
	list( $checkvalue, $checktime, $checkidhash, $checkformhash ) = explode( "\t", authcode( $_G['cookie']['seccode' . $idhash], 'DECODE', $_G['config']['security']['authkey'] ) );
	return $checkvalue == strtoupper( $value ) && TIMESTAMP - 180 > $checktime && $checkidhash == $idhash && FORMHASH == $checkformhash;
}

function check_secqaa( $value, $idhash )
{
	global $_G;
	if ( ! $_G['setting']['secqaa'] )
	{
		return true;
	}
	if ( ! isset( $_G['cookie']['secqaa' . $idhash] ) )
	{
		return false;
	}
	loadcache( 'secqaa' );
	list( $checkvalue, $checktime, $checkidhash, $checkformhash ) = explode( "\t", authcode( $_G['cookie']['secqaa' . $idhash], 'DECODE', $_G['config']['security']['authkey'] ) );
	return $checkvalue == md5( $value ) && TIMESTAMP - 180 > $checktime && $checkidhash == $idhash && FORMHASH == $checkformhash;
}

function check_geetest($parm)
{
	require_once DISCUZ_ROOT . '/source/plugin/ipbanspider/geetestlib.php';
	$validate_response = '';
	if(function_exists('geetest_validate')){
		$validate_response = geetest_validate($parm['geetest_challenge'], $parm['geetest_validate'], $parm['geetest_seccode']);
	}
	if ($validate_response) {
		return true;
	} else {
		return false;
	}
}

function adshow( $parameter )
{
	global $_G;
	if ( $_G['inajax'] )
	{
		return;
	}
	$params = explode( '/', $parameter );
	$customid = 0;
	$customc = explode( '_', $params[0] );
	if ( $customc[0] == 'custom' )
	{
		$params[0] = $customc[0];
		$customid = $customc[1];
	}
	$adcontent = null;
	if ( empty( $_G['setting']['advtype'] ) || ! in_array( $params[0], $_G['setting']['advtype'] ) )
	{
		$adcontent = '';
	}
	if ( $adcontent === null )
	{
		loadcache( 'advs' );
		$adids = array();
		$evalcode = &$_G['cache']['advs']['evalcode'][$params[0]];
		$parameters = &$_G['cache']['advs']['parameters'][$params[0]];
		$codes = &$_G['cache']['advs']['code'][$_G['basescript']][$params[0]];
		if ( ! empty( $codes ) )
		{
			foreach ( $codes as $adid => $code )
			{
				$parameter = &$parameters[$adid];
				$checked = true;
				@eval( $evalcode['check'] );
				if ( $checked )
				{
					$adids[] = $adid;
				}
			}
			if ( ! empty( $adids ) )
			{
				$adcode = $extra = '';
				@eval( $evalcode['create'] );
				if ( empty( $notag ) )
				{
					$adcontent = '<div' . ( $params[1] != '' ? ' class="' . $params[1] . '"' : '' ) . $extra . '>' . $adcode . '</div>';

				}
				else
				{
					$adcontent = $adcode;
				}
			}
		}
	}
	$adfunc = 'ad_' . $params[0];
	$_G['setting']['pluginhooks'][$adfunc] = null;
	$hscript = $_G['basescript'] . ( ( $do = ! empty( $_G['gp_do'] ) ? $_G['gp_do'] : ( ! empty( $_GET['do'] ) ? $_GET['do'] : '' ) ) ? '_' . $do : '' );
	hookscript( 'ad', 'global', 'funcs', array( 'params' => $params, 'content' => $adcontent ), $adfunc );
	hookscript( 'ad', $hscript, 'funcs', array( 'params' => $params, 'content' => $adcontent ), $adfunc );
	return $_G['setting']['pluginhooks'][$adfunc] === null ? $adcontent : $_G['setting']['pluginhooks'][$adfunc];
}

function showmessage( $message, $url_forward = '', $values = array(), $extraparam = array(), $custom = 0 )
{
	global $_G, $show_message;
	$_G['messageparam'] = func_get_args();
	if ( empty( $_G['inhookscript'] ) && defined( 'CURMODULE' ) )
	{
		hookscript( CURMODULE, $_G['basescript'], 'messagefuncs', array( 'param' => $_G['messageparam'] ) );
	}
	$_G['inshowmessage'] = true;

	//note
	$param = array(
		'header' => false,
		'timeout' => null,
		'refreshtime' => null,
		'closetime' => null,
		'locationtime' => null,
		'alert' => null,
		'return' => false,
		'redirectmsg' => 0,
		'msgtype' => 1,
		'showmsg' => true,
		'showdialog' => false,
		'login' => false,
		'handle' => false,
		'extrajs' => '',
		'striptags' => true,
		);

	$navtitle = lang( 'core', 'title_board_message' );

	if ( $custom )
	{
		$alerttype = 'alert_info';
		$show_message = $message;
		include template( 'common/showmessage' );
		dexit();
	}

	define( 'CACHE_FORBIDDEN', true );
	$_G['setting']['msgforward'] = @unserialize( $_G['setting']['msgforward'] );
	$handlekey = $leftmsg = '';

	//noteX ajax(IN_MOBILE)
	if ( defined( 'IN_MOBILE' ) )
	{
		$_G['inajax'] = 0;
		$_G[gp_referer] && $url_forward = $_G[gp_referer];
		if ( ! empty( $url_forward ) && strpos( $url_forward, 'mobile' ) === false )
		{
			$url_forward_arr = explode( "#", $url_forward );
			if ( strpos( $url_forward_arr[0], '?' ) !== false )
			{
				$url_forward_arr[0] = $url_forward_arr[0] . '&mobile=yes';
			}
			else
			{
				$url_forward_arr[0] = $url_forward_arr[0] . '?mobile=yes';
			}
			$url_forward = implode( "#", $url_forward_arr );
		}
	}

	if ( empty( $_G['inajax'] ) && ( ! empty( $_G['gp_quickforward'] ) || $_G['setting']['msgforward']['quick'] && $_G['setting']['msgforward']['messages'] && @in_array( $message, $_G['setting']['msgforward']['messages'] ) ) )
	{
		$param['header'] = true;
	}
	$_G['gp_handlekey'] = ! empty( $_G['gp_handlekey'] ) && preg_match( '/^\w+$/', $_G['gp_handlekey'] ) ? $_G['gp_handlekey'] : '';
	if ( ! empty( $_G['inajax'] ) )
	{
		$handlekey = $_G['gp_handlekey'] = ! empty( $_G['gp_handlekey'] ) ? htmlspecialchars( $_G['gp_handlekey'] ) : '';
		$param['handle'] = true;
	}
	if ( ! empty( $_G['inajax'] ) )
	{
		$param['msgtype'] = empty( $_G['gp_ajaxmenu'] ) && ( empty( $_POST ) || ! empty( $_G['gp_nopost'] ) ) ? 2 : 3;
	}
	if ( $url_forward )
	{
		$param['timeout'] = true;
		if ( $param['handle'] && ! empty( $_G['inajax'] ) )
		{
			$param['showmsg'] = false;
		}
	}

	//note
	foreach ( $extraparam as $k => $v )
	{
		$param[$k] = $v;
	}
	if ( array_key_exists( 'set', $extraparam ) )
	{
		$setdata = array( '1' => array( 'msgtype' => 3 ) );
		if ( $setdata[$extraparam['set']] )
		{
			foreach ( $setdata[$extraparam['set']] as $k => $v )
			{
				$param[$k] = $v;
			}
		}
	}

	$timedefault = intval( $param['refreshtime'] === null ? $_G['setting']['msgforward']['refreshtime'] : $param['refreshtime'] );
	if ( $param['timeout'] !== null )
	{
		$refreshsecond = ! empty( $timedefault ) ? $timedefault : 3;
		$refreshtime = $refreshsecond * 1000;
	}
	else
	{
		$refreshtime = $refreshsecond = 0;
	}

	if ( $param['login'] && $_G['uid'] || $url_forward )
	{
		$param['login'] = false;
	}

	$param['header'] = $url_forward && $param['header'] ? true : false;

	//note
	if ( $param['header'] )
	{
		header( "HTTP/1.1 301 Moved Permanently" );
		dheader( "location: " . str_replace( '&amp;', '&', $url_forward ) );
	}
	if ( $param['location'] && ! empty( $_G['inajax'] ) )
	{
		include template( 'common/header_ajax' );
		echo '<script type="text/javascript" reload="1">window.location.href=\'' . str_replace( "'", "\'", $url_forward ) . '\';</script>';
		include template( 'common/footer_ajax' );
		dexit();
	}

	$_G['hookscriptmessage'] = $message;
	$_G['hookscriptvalues'] = $values;
	$vars = explode( ':', $message );

	if ( count( $vars ) == 2 )
	{
		$show_message = lang( 'plugin/' . $vars[0], $vars[1], $values );
	}
	else
	{
		$show_message = lang( 'message', $message, $values );
	}

	if ( $param['msgtype'] == 2 && $param['login'] )
	{
		dheader( 'location: member.php?mod=logging&action=login&handlekey=' . $handlekey . '&infloat=yes&inajax=yes&guestmessage=yes' );
	}

	$show_jsmessage = str_replace( "'", "\\'", $param['striptags'] ? strip_tags( $show_message ) : $show_message );

	if ( ( ! $param['showmsg'] || $param['showid'] ) && ! defined( 'IN_MOBILE' ) )
	{
		$show_message = '';
	}

	$allowreturn = ! $param['timeout'] && ! $url_forward && ! $param['login'] || $param['return'] ? true : false;
	if ( $param['alert'] === null )
	{
		$alerttype = $url_forward ? ( preg_match( '/\_(succeed|success)$/', $message ) ? 'alert_right' : 'alert_info' ) : ( $allowreturn ? 'alert_error' : 'alert_info' );
	}
	else
	{
		$alerttype = 'alert_' . $param['alert'];
	}

	$extra = '';
	if ( $param['showid'] )
	{
		$extra .= 'if($(\'' . $param['showid'] . '\')) {$(\'' . $param['showid'] . '\').innerHTML = \'' . $show_jsmessage . '\';}';
	}
	if ( $param['handle'] )
	{
		$valuesjs = $comma = $subjs = '';
		foreach ( $values as $k => $v )
		{
			$v = daddslashes( $v );
			if ( is_array( $v ) )
			{
				$subcomma = '';
				foreach ( $v as $subk => $subv )
				{
					$subjs .= $subcomma . '\'' . $subk . '\':\'' . $subv . '\'';
					$subcomma = ',';
				}
				$valuesjs .= $comma . '\'' . $k . '\':{' . $subjs . '}';
			}
			else
			{
				$valuesjs .= $comma . '\'' . $k . '\':\'' . $v . '\'';
			}
			$comma = ',';
		}
		$valuesjs = '{' . $valuesjs . '}';
		if ( $url_forward )
		{
			$extra .= 'if(typeof succeedhandle_' . $handlekey . '==\'function\') {succeedhandle_' . $handlekey . '(\'' . $url_forward . '\', \'' . $show_jsmessage . '\', ' . $valuesjs . ');}';
		}
		else
		{
			$extra .= 'if(typeof errorhandle_' . $handlekey . '==\'function\') {errorhandle_' . $handlekey . '(\'' . $show_jsmessage . '\', ' . $valuesjs . ');}';
		}
	}
	if ( $param['closetime'] !== null )
	{
		$param['closetime'] = $param['closetime'] === true ? $timedefault : $param['closetime'];
	}
	if ( $param['locationtime'] !== null )
	{
		$param['locationtime'] = $param['locationtime'] === true ? $timedefault : $param['locationtime'];
	}
	if ( $handlekey )
	{
		if ( $param['showdialog'] )
		{
			$extra .= 'hideWindow(\'' . $handlekey . '\');showDialog(\'' . $show_jsmessage . '\', \'notice\', null, ' . ( $param['locationtime'] !== null ? 'function () { window.location.href =\'' . $url_forward . '\'; }' : 'null' ) . ', 0, null, null, null, null, ' . ( $param['closetime'] ? $param['closetime'] : 'null' ) . ', ' . ( $param['locationtime'] ? $param['locationtime'] : 'null' ) . ');';
			$param['closetime'] = null;
			$st = '';
		}
		if ( $param['closetime'] !== null )
		{
			$extra .= 'setTimeout("hideWindow(\'' . $handlekey . '\')", ' . ( $param['closetime'] * 1000 ) . ');';
		}
	}
	else
	{
		$st = $param['locationtime'] !== null ? 'setTimeout("window.location.href =\'' . $url_forward . '\';", ' . ( $param['locationtime'] * 1000 ) . ');' : '';
	}
	if ( ! $extra && $param['timeout'] && ! defined( 'IN_MOBILE' ) )
	{
		$extra .= 'setTimeout("window.location.href =\'' . $url_forward . '\';", ' . $refreshtime . ');';
	}
	// 新模板样式 lxp 20131230
	if($_G['newtpl'] && $message == 'login_succeed'){
		$show_message = '欢迎您回来，现在将转入登录前页面。';
	}
	$show_message .= $extra ? '<script type="text/javascript" reload="1">' . $extra . $st . '</script>' : '';
	$show_message .= $param['extrajs'] ? $param['extrajs'] : '';

	include template( 'common/showmessage' );
	dexit();
}

function submitcheck( $var, $allowget = 0, $seccodecheck = 0, $secqaacheck = 0, $source = 'pc' )
{
	if ( ! getgpc( $var ) )
	{
		return false;
	}
	else
	{
        global $_G;
		if ( $allowget || ( $_SERVER['REQUEST_METHOD'] == 'POST' && ! empty( $_G['gp_formhash'] ) && $_G['gp_formhash'] == formhash() && empty( $_SERVER['HTTP_X_FLASH_VERSION'] ) && ( !isset( $_SERVER['HTTP_REFERER'] ) || preg_replace( "/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER'] ) == preg_replace( "/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'] ) ) ) )
		{
			if ( checkperm( 'seccode' ) )
			{
				// 添加特殊规则版块列表 lxp 20131121
				$special_fids = array(
					$_G['config']['fids']['dianpu'],
					$_G['config']['fids']['skiing'],
					$_G['config']['fids']['produce'],
					$_G['config']['fids']['equipment'],
					$_G['config']['fids']['brand'],
					$_G['config']['fids']['line'],
					$_G['config']['fids']['climb'],
					$_G['config']['fids']['diving'],
					$_G['config']['fids']['fishing'],
					$_G['config']['fids']['mountain']
				);
				// if ( $secqaacheck && ! check_secqaa( $_G['gp_secanswer'], $_G['gp_sechash'] ) )
				$gt_test = array('geetest_challenge' => $_G['gp_geetest_challenge'], 'geetest_validate' => $_G['gp_geetest_validate'], 'geetest_seccode' => $_G['gp_geetest_seccode']);
				if ( $secqaacheck && ! check_geetest($gt_test) )
				{
					if ( in_array( $_G['fid'], $special_fids ) )
					{
						return true;
					}
					else
					{
                        if($source == 'wap'){
                            encodeData(array('error' => true, 'errorinfo' => lang('message', 'submit_seccode_invalid')));
                        }
						showmessage( 'submit_seccode_invalid' );
					}
				}
				if ( $seccodecheck && ! check_seccode( $_G['gp_seccodeverify'], $_G['gp_sechash'] ) )
				{
					if ( in_array( $_G['fid'], $special_fids ) )
					{
						return true;
					}
					else
					{
                        if($source == 'wap'){
                            encodeData(array('error' => true, 'errorinfo' => lang('message', 'submit_seccode_invalid')));
                        }
						showmessage( 'submit_seccode_invalid' );
					}
				}
			}
			return true;
		}
		else
		{

			//加调试日志
			require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('submit_invalid');
			$newlogs->log_array(array("time"=>date("Y-m-d H:i:s"),'server'=>$_SERVER,'gp_formhash'=>$_G['gp_formhash'],'formhash'=>formhash(),'replace1'=>preg_replace( "/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER'] ),'replace2'=>preg_replace( "/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'] )), 'submit_invalid');

			showmessage( 'submit_invalid' );
		}
	}
}

function multi( $num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = false, $simple = false, $showinput = false )
{
	global $_G;
	$ajaxtarget = ! empty( $_G['gp_ajaxtarget'] ) ? " ajaxtarget=\"" . htmlspecialchars( $_G['gp_ajaxtarget'] ) . "\" onclick=\"return false;\" " : '';

	$a_name = '';
	if ( strpos( $mpurl, '#' ) !== false )
	{
		$a_strs = explode( '#', $mpurl );
		$mpurl = $a_strs[0];
		$a_name = '#' . $a_strs[1];
	}

	if ( defined( 'IN_ADMINCP' ) )
	{
		$shownum = $showkbd = true;
		$showpagejump = false;
		$lang['prev'] = '&lsaquo;&lsaquo;';
		$lang['next'] = '&rsaquo;&rsaquo;';
	}
	else
	{
		$shownum = $showkbd = false;
		$showpagejump = true;
		if ( defined( 'IN_MOBILE' ) && ! defined( 'TPL_DEFAULT' ) )
		{
			$lang['prev'] = lang( 'core', 'prevpage' );
			$lang['next'] = lang( 'core', 'nextpage' );
		}
		else
		{
			$lang['prev'] = '&nbsp;&nbsp;';
			$lang['next'] = lang( 'core', 'nextpage' );
		}
	}
	if ( defined( 'IN_MOBILE' ) && ! defined( 'TPL_DEFAULT' ) )
	{
		$dot = '..';
		$page = intval( $page ) < 10 && intval( $page ) > 0 ? $page : 4;
	}
	else
	{
		$dot = '...';
	}

	$multipage = '';
	$mpurl .= strpos( $mpurl, '?' ) !== false ? '&amp;' : '?';

	$realpages = 1;
	$_G['page_next'] = 0;
	$page -= strlen( $curpage ) - 1;
	if ( $page <= 0 )
	{
		$page = 1;
	}
	if ( $num > $perpage )
	{

		$offset = floor( $page * 0.5 );

		$realpages = @ceil( $num / $perpage );
		$pages = $maxpages && $maxpages < $realpages ? $maxpages : $realpages;

		if ( $page > $pages )
		{
			$from = 1;
			$to = $pages;
		}
		else
		{
			$from = $curpage - $offset;
			$to = $from + $page - 1;
			if ( $from < 1 )
			{
				$to = $curpage + 1 - $from;
				$from = 1;
				if ( $to - $from < $page )
				{
					$to = $page;
				}
			}
			elseif ( $to > $pages )
			{
				$from = $pages - $page + 1;
				$to = $pages;
			}
		}
		$_G['page_next'] = $to;
		if ( $htmlstate == 1 )
		{
			$pagestr = 'page-';
		}
		else
		{
			$pagestr = 'page=';
		}

		$multipage = ( $curpage - $offset > 1 && $pages > $page ? '<a href="' . $mpurl . $pagestr . '1' . $a_name . '" class="first"' . $ajaxtarget . '>1 ' . $dot . '</a>' : '' ) . ( $curpage > 1 && ! $simple ? '<a href="' . $mpurl . $pagestr . ( $curpage - 1 ) . $a_name . '" class="prev"' . $ajaxtarget . '>' . $lang['prev'] . '</a>' : '' );
		for ( $i = $from; $i <= $to; $i++ )
		{
			$multipage .= $i == $curpage ? '<strong>' . $i . '</strong>' : '<a href="' . $mpurl . 'page=' . $i . ( $ajaxtarget && $i == $pages && $autogoto ? '#' : $a_name ) . '"' . $ajaxtarget . '>' . $i . '</a>';
		}

		$multipage .= ( $to < $pages ? '<a href="' . $mpurl . $pagestr . $pages . $a_name . '" class="last"' . $ajaxtarget . '>' . $dot . ' ' . $realpages . '</a>' : '' ) . ( $showinput && $showpagejump && ! $simple && ! $ajaxtarget ? '<label style="float:left;border: 1px solid #C2D5E3;margin-left: 4px;padding: 0 8px;"><input style="line-height: 16px;height: 16px;" type="text" name="custompage"  size="2" title="' . $lang['pagejumptip'] . '" value="' . $curpage . '" onkeydown="if(event.keyCode==13) {window.location=\'' . $mpurl . 'page=\'+this.value; doane(event);}" /><span title="' . $lang['total'] . ' ' . $pages . ' ' . $lang['pageunit'] . '"> / ' . $pages . ' ' . $lang['pageunit'] . '</span></label>' : '' ) . ( $curpage < $pages && ! $simple ? '<a href="' . $mpurl . $pagestr . ( $curpage + 1 ) .
			$a_name . '" class="nxt"' . $ajaxtarget . '>' . $lang['next'] . '</a>' : '' ) . ( $showkbd && ! $simple && $pages > $page && ! $ajaxtarget ? '<kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location=\'' . $mpurl . 'page=\'+this.value; doane(event);}" /></kbd>' : '' );

		$multipage = $multipage ? '<div class="pg">' . ( $shownum && ! $simple ? '<em>&nbsp;' . $num . '&nbsp;</em>' : '' ) . $multipage . '</div>' : '';
	}
	$maxpage = $realpages;
	return $multipage;
}

function multis( $num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = false, $simple = false )
{
	global $_G;
	$ajaxtarget = ! empty( $_G['gp_ajaxtarget'] ) ? " ajaxtarget=\"" . htmlspecialchars( $_G['gp_ajaxtarget'] ) . "\" onclick=\"return false;\" " : '';

	$a_name = '';
	if ( strpos( $mpurl, '#' ) !== false )
	{
		$a_strs = explode( '#', $mpurl );
		$mpurl = $a_strs[0];
		$a_name = '#' . $a_strs[1];
	}

	if ( defined( 'IN_ADMINCP' ) )
	{
		$shownum = $showkbd = true;
		$lang['prev'] = '&lsaquo;&lsaquo;';
		$lang['next'] = '&rsaquo;&rsaquo;';
	}
	else
	{
		$shownum = $showkbd = false;
		if ( defined( 'IN_MOBILE' ) && ! defined( 'TPL_DEFAULT' ) )
		{
			$lang['prev'] = lang( 'core', 'prevpage' );
			$lang['next'] = lang( 'core', 'nextpage' );
		}
		else
		{
			$lang['prev'] = '&nbsp;&nbsp;';
			$lang['next'] = lang( 'core', 'nextpage' );
		}
	}
	if ( defined( 'IN_MOBILE' ) && ! defined( 'TPL_DEFAULT' ) )
	{
		$dot = '..';
		$page = intval( $page ) < 10 && intval( $page ) > 0 ? $page : 4;
	}
	else
	{
		$dot = '...';
	}

	$multipage = '';
	$mpurl .= strpos( $mpurl, '?' ) !== false ? '&amp;' : '-';

	$realpages = 1;
	$_G['page_next'] = 0;
	$page -= strlen( $curpage ) - 1;
	if ( $page <= 0 )
	{
		$page = 1;
	}
	if ( $num > $perpage )
	{

		$offset = floor( $page * 0.5 );

		$realpages = @ceil( $num / $perpage );
		$pages = $maxpages && $maxpages < $realpages ? $maxpages : $realpages;

		if ( $page > $pages )
		{
			$from = 1;
			$to = $pages;
		}
		else
		{
			$from = $curpage - $offset;
			$to = $from + $page - 1;
			if ( $from < 1 )
			{
				$to = $curpage + 1 - $from;
				$from = 1;
				if ( $to - $from < $page )
				{
					$to = $page;
				}
			}
			elseif ( $to > $pages )
			{
				$from = $pages - $page + 1;
				$to = $pages;
			}
		}
		$_G['page_next'] = $to;
		if ( $htmlstate == 1 )
		{
			$pagestr = '';
		}
		else
		{
			$pagestr = '';
		}
		$multipage = ( $curpage - $offset > 1 && $pages > $page ? '<a href="' . $mpurl . $pagestr . '1' . $a_name . '" class="first"' . $ajaxtarget . '>1 ' . $dot . '</a>' : '' ) . ( $curpage > 1 && ! $simple ? '<a href="' . $mpurl . $pagestr . ( $curpage - 1 ) . $a_name . '" class="prev"' . $ajaxtarget . '>' . $lang['prev'] . '</a>' : '' );
		for ( $i = $from; $i <= $to; $i++ )
		{
			$multipage .= $i == $curpage ? '<strong>' . $i . '</strong>' : '<a href="' . $mpurl . '' . $i . ( $ajaxtarget && $i == $pages && $autogoto ? '#' : $a_name ) . '"' . $ajaxtarget . '>' . $i . '</a>';
		}
		$multipage .= ( $to < $pages ? '<a href="' . $mpurl . $pagestr . $pages . $a_name . '" class="last"' . $ajaxtarget . '>' . $dot . ' ' . $realpages . '</a>' : '' ) . ( $curpage < $pages && ! $simple ? '<a href="' . $mpurl . $pagestr . ( $curpage + 1 ) . $a_name . '" class="nxt"' . $ajaxtarget . '>' . $lang['next'] . '</a>' : '' ) . ( $showkbd && ! $simple && $pages > $page && ! $ajaxtarget ? '<kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location=\'' . $mpurl . 'page=\'+this.value; doane(event);}" /></kbd>' : '' );

		$multipage = $multipage ? '<div class="pg">' . ( $shownum && ! $simple ? '<em>&nbsp;' . $num . '&nbsp;</em>' : '' ) . $multipage . '</div>' : '';
	}
	$maxpage = $realpages;
	return $multipage;
}

function simplepage( $num, $perpage, $curpage, $mpurl )
{
	$return = '';
	$lang['next'] = lang( 'core', 'nextpage' );
	$lang['prev'] = lang( 'core', 'prevpage' );
	$next = $num == $perpage ? '<a href="' . $mpurl . '&amp;page=' . ( $curpage + 1 ) . '" class="nxt">' . $lang['next'] . '</a>' : '';
	$prev = $curpage > 1 ? '<span class="pgb"><a href="' . $mpurl . '&amp;page=' . ( $curpage - 1 ) . '">' . $lang['prev'] . '</a></span>' : '';
	if ( $next || $prev )
	{
		$return = '<div class="pg">' . $prev . $next . '</div>';
	}
	return $return;
}

function censor( $message, $modword = null, $return = false )
{
	// 禁止类似 &#x6C88;&#x9633; 的html实体汉字提交
	if(preg_match('/[&amp;|&]#x(\w+);/', $message)) { showmessage( 'word_banned' ); }
	require_once libfile( 'class/censor' );
	$censor = discuz_censor::instance();
	$censor->check( $message, $modword );
	if ( $censor->modbanned() )
	{
		$wordbanned = implode( ', ', $censor->words_found );
		if ( $return )
		{
			return array( 'message' => lang( 'message', 'word_banned', array( 'wordbanned' => $wordbanned ) ) );
		}
		showmessage( 'word_banned', '', array( 'wordbanned' => $wordbanned ) );
	}
	return $message;
}
//ajax提交判断是否是关键字---图片分楼
function censor_ajax( $message, $modword = null, $return = false )
{
	// 禁止类似 &#x6C88;&#x9633; 的html实体汉字提交
	if(preg_match('/[&amp;|&]#x(\w+);/', $message)) { showmessage( 'word_banned' ); }
	require_once libfile( 'class/censor' );
	$censor = discuz_censor::instance();
	$censor->check( $message, $modword );
	if ( $censor->modbanned() )
	{
		$wordbanned = implode( ', ', $censor->words_found );
		if ( $return )
		{
			return array( 'message' => lang( 'message', 'word_banned', array( 'wordbanned' => $wordbanned ) ) );
		}
                return 1;
	}

	return $message;
}

function censormod( $message )
{
	global $_G;
	if ( $_G['group']['ignorecensor'] )
	{
		return false;
	}

	require_once libfile( 'class/censor' );
	$censor = discuz_censor::instance();
	$censor->check( $message );
	return $censor->modmoderated();
}

function space_merge( &$values, $tablename )
{
	global $_G;

	$uid = empty( $values['uid'] ) ? $_G['uid'] : $values['uid'];
	$var = "member_{$uid}_{$tablename}";
	if ( $uid )
	{
		if ( ! isset( $_G[$var] ) )
		{
			$query = DB::query( "SELECT * FROM " . DB::table( 'common_member_' . $tablename ) . " WHERE uid='$uid'" );
			if ( $_G[$var] = DB::fetch( $query ) )
			{
				if ( $tablename == 'field_home' )
				{
					$_G['setting']['privacy'] = empty( $_G['setting']['privacy'] ) ? array() : ( is_array( $_G['setting']['privacy'] ) ? $_G['setting']['privacy'] : unserialize( $_G['setting']['privacy'] ) );
					$_G[$var]['privacy'] = empty( $_G[$var]['privacy'] ) ? array() : is_array( $_G[$var]['privacy'] ) ? $_G[$var]['privacy'] : unserialize( $_G[$var]['privacy'] );
					foreach ( array(
						'feed',
						'view',
						'profile' ) as $pkey )
					{
						if ( empty( $_G[$var]['privacy'][$pkey] ) && ! isset( $_G[$var]['privacy'][$pkey] ) )
						{
							$_G[$var]['privacy'][$pkey] = isset( $_G['setting']['privacy'][$pkey] ) ? $_G['setting']['privacy'][$pkey] : array(); //&#545;&#1406;&#300;
						}
					}
					$_G[$var]['acceptemail'] = empty( $_G[$var]['acceptemail'] ) ? array() : unserialize( $_G[$var]['acceptemail'] );
					if ( empty( $_G[$var]['acceptemail'] ) )
					{
						$_G[$var]['acceptemail'] = empty( $_G['setting']['acceptemail'] ) ? array() : unserialize( $_G['setting']['acceptemail'] );
					}
				}
			}
			else
			{
				DB::insert( 'common_member_' . $tablename, array( 'uid' => $uid ) );
				$_G[$var] = array();
			}
		}
		$values = array_merge( $values, $_G[$var] );
	}
}

/**
 * log
 */
function runlog( $file, $message, $halt = 0 )
{
	global $_G;
	$nowurl = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : ( $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'] );
	$logtxt = dgmdate( $_G['timestamp'], 'Y-m-d H:i:s' ) . "\t" . $_G['clientip'] . "\t{$_G['uid']}\t{$nowurl}\t" . str_replace( array( "\r", "\n" ), array( ' ', ' ' ), trim( $message ) ) . "\n";
	$logtxt = str_replace( "\t", "[--log--]", $logtxt );
	require_once libfile( 'class/myredis' );
	$myredis = &myredis::instance( 6382 );
	if ( $myredis )
	{
		$yearmonth = dgmdate( TIMESTAMP, 'Ymd' );
		$yesterday = date( 'Ymd', strtotime( '-1day', TIMESTAMP ) );
		if ( $myredis->obj->exists( $file . '_' . $yesterday ) )
		{
			if ( $myredis->obj->rename( $file . '_' . $yesterday, $file . '_' . $yesterday . '_doing' ) )
			{
				$redislogarr = $myredis->obj->lRange( $file . '_' . $yesterday . '_doing', 0, -1 );
				$logvalue = base64_encode( serialize( $redislogarr ) );
				DB::query( "REPLACE INTO " . DB::table( 'common_redislog' ) . " (`datetime`, `filename`, `logvalue`) VALUES ('$yesterday', '$file', '$logvalue')" );
				$myredis->obj->expire( $file . '_' . $yesterday . '_doing', 1 );
			}
		}
		$myredis->obj->rPush( $file . '_' . $yearmonth, $logtxt );
	}
	/* 取消文件式log
	* else{
	* $yearmonth = dgmdate($_G['timestamp'], 'Ym');
	* $logdir = DISCUZ_ROOT.'./data/log/';
	* if(!is_dir($logdir)) mkdir($logdir, 0777);
	* $logfile = $logdir.$yearmonth.'_'.$file.'.php';
	* if(@filesize($logfile) > 2048000) {
	* $dir = opendir($logdir);
	* $length = strlen($file);
	* $maxid = $id = 0;
	* while($entry = readdir($dir)) {
	* if(strexists($entry, $yearmonth.'_'.$file)) {
	* $id = intval(substr($entry, $length + 8, -4));
	* $id > $maxid && $maxid = $id;
	* }
	* }
	* closedir($dir);
	* $logfilebak = $logdir.$yearmonth.'_'.$file.'_'.($maxid + 1).'.php';
	* @rename($logfile, $logfilebak);
	* }
	* if($fp = @fopen($logfile, 'a')) {
	* @flock($fp, 2);
	* fwrite($fp, "<?PHP exit;?>\t".str_replace(array('<?', '?>', "\r", "\n"), '', $log)."\n");
	* fclose($fp);
	* }
	* }*/
	if ( $halt )
		exit();
}

function stripsearchkey( $string )
{
	$string = trim( $string );
	$string = str_replace( '*', '%', addcslashes( $string, '%_' ) );
	$string = str_replace( '_', '\_', $string );
	return $string;
}

function dmkdir( $dir, $mode = 0777, $makeindex = true )
{
	if ( ! is_dir( $dir ) )
	{
		dmkdir( dirname( $dir ) );
		@mkdir( $dir, $mode );
		if ( ! empty( $makeindex ) )
		{
			@touch( $dir . '/index.html' );
			@chmod( $dir . '/index.html', 0777 );
		}
	}
	return true;
}

function dreferer( $default = '' )
{
	global $_G;

	$default = empty( $default ) ? $GLOBALS['_t_curapp'] : '';
	if ( empty( $_G['referer'] ) )
	{
		$referer = ! empty( $_G['gp_referer'] ) ? $_G['gp_referer'] : $_SERVER['HTTP_REFERER'];
		$_G['referer'] = preg_replace( "/([\?&])((sid\=[a-z0-9]{6})(&|$))/i", '\\1', $referer );
		$_G['referer'] = substr( $_G['referer'], -1 ) == '?' ? substr( $_G['referer'], 0, -1 ) : $_G['referer'];
	}

	if ( strpos( $_G['referer'], 'member.php?mod=logging' ) )
	{
		$_G['referer'] = $default;
	}
	$_G['referer'] = htmlspecialchars( $_G['referer'] );
	$_G['referer'] = str_replace( '&amp;', '&', $_G['referer'] );
	$reurl = parse_url( $_G['referer'] );
	if ( ! empty( $reurl['host'] ) && ! in_array( $reurl['host'], array( $_SERVER['HTTP_HOST'], 'www.' . $_SERVER['HTTP_HOST'] ) ) && ! in_array( $_SERVER['HTTP_HOST'], array( $reurl['host'], 'www.' . $reurl['host'] ) ) )
	{
		if ( ! in_array( $reurl['host'], $_G['setting']['domain']['app'] ) && ! isset( $_G['setting']['domain']['list'][$reurl['host']] ) )
		{
			$domainroot = substr( $_SERVER['HTTP_HOST'], strpos( $_SERVER['HTTP_HOST'], '.' ) + 1 );
			if ( is_array( $_G['setting']['domain']['root'] ) && ! in_array( $domainroot, $_G['setting']['domain']['root'] ) )
			{
				$_G['referer'] = $_G['setting']['domain']['defaultindex'] ? $_G['setting']['domain']['defaultindex'] : 'index.php';
			}
		}
	}
	elseif ( empty( $reurl['host'] ) )
	{
		$_G['referer'] = $_G['siteurl'] . './' . $_G['referer'];
	}
	return strip_tags( $_G['referer'] );
}

function ftpcmd( $cmd, $arg1 = '' )
{
	static $ftp;
	$ftpon = getglobal( 'setting/ftp/on' );
	if ( ! $ftpon )
	{
		return $cmd == 'error' ? -101 : 0;
	}
	elseif ( $ftp == null )
	{
		require_once libfile( 'class/ftp' );
		$ftp = &discuz_ftp::instance();
	}
	if ( ! $ftp->enabled )
	{
		return 0;
	}
	elseif ( $ftp->enabled && ! $ftp->connectid )
	{
		$ftp->connect();
	}
	switch ( $cmd )
	{
		case 'upload':
			return $ftp->upload( getglobal( 'setting/attachdir' ) . '/' . $arg1, $arg1 );
			break;
		case 'delete':
			return $ftp->ftp_delete( $arg1 );
			break;
		case 'close':
			return $ftp->ftp_close();
			break;
		case 'error':
			return $ftp->error();
			break;
		case 'object':
			return $ftp;
			break;
		default:
			return false;
	}

}

function diconv( $str, $in_charset, $out_charset = CHARSET, $ForceTable = false )
{
	global $_G;

	$in_charset = strtoupper( $in_charset );
	$out_charset = strtoupper( $out_charset );
	if ( $in_charset != $out_charset )
	{
		require_once libfile( 'class/chinese' );
		$chinese = new Chinese( $in_charset, $out_charset, $ForceTable );
		$strnew = $chinese->Convert( $str );
		if ( ! $ForceTable && ! $strnew && $str )
		{
			$chinese = new Chinese( $in_charset, $out_charset, 1 );
			$strnew = $chinese->Convert( $str );
		}
		return $strnew;
	}
	else
	{
		return $str;
	}
}

function renum( $array )
{
	$newnums = $nums = array();
	foreach ( $array as $id => $num )
	{
		$newnums[$num][] = $id;
		$nums[$num] = $num;
	}
	return array( $nums, $newnums );
}

function getonlinenum( $fid = 0, $tid = 0 )
{

	if ( $fid )
	{
		$sql = " AND fid='$fid'";
	}
	if ( $tid )
	{
		$sql = " AND tid='$tid'";
	}
	return DB::result_first( 'SELECT count(*) FROM ' . DB::table( "common_session" ) . " WHERE 1 $sql" );
}

function sizecount( $size )
{
	if ( $size >= 1073741824 )
	{
		$size = ( round( $size / 1073741824 * 100 ) / 100 ) . ' GB';
	}
	elseif ( $size >= 1048576 )
	{
		$size = ( round( $size / 1048576 * 100 ) / 100 ) . ' MB';
	}
	elseif ( $size >= 1024 )
	{
		$size = ( round( $size / 1024 * 100 ) / 100 ) . ' KB';
	}
	else
	{
		$size = $size . ' Bytes';
	}
	return $size;
}

function swapclass( $class1, $class2 = '' )
{
	static $swapc = null;
	$swapc = isset( $swapc ) && $swapc != $class1 ? $class1 : $class2;
	return $swapc;
}

function writelog( $file, $log )
{
	global $_G;
	require_once libfile( 'class/myredis' );
	$myredis = &myredis::instance( 6382 );
	if ( $myredis )
	{
		//redis式log modify by wangqi 20121031
		//原本按月log 改为按日log
		$yearmonth = dgmdate( TIMESTAMP, 'Ymd' );

		$yesterday = date( 'Ymd', strtotime( '-1day', TIMESTAMP ) );

		if ( $myredis->obj->exists( $file . '_' . $yesterday ) )
		{

			if ( $myredis->obj->rename( $file . '_' . $yesterday, $file . '_' . $yesterday . '_doing' ) )
			{

				$redislogarr = $myredis->obj->lRange( $file . '_' . $yesterday . '_doing', 0, -1 );
				$myredis->obj->del($file . '_' . $yesterday . '_doing');

				$logvalue = base64_encode( serialize( $redislogarr ) );
				DB::query( "REPLACE INTO " . DB::table( 'common_redislog' ) . " (`datetime`, `filename`, `logvalue`) VALUES ('$yesterday', '$file', '$logvalue')" );
			}
		}
		$logstr = is_array( $log ) ? $log[0] : $log;
		$logstr = str_replace( "\t", "[--log--]", $logstr );
		$myredis->obj->rPush( $file . '_' . $yearmonth, $logstr );
	}
	/*取消文件式log
	* else {
	* $yearmonth = dgmdate(TIMESTAMP, 'Ym', $_G['setting']['timeoffset']);
	* $logdir = DISCUZ_ROOT.'./data/log/';
	* $logfile = $logdir.$yearmonth.'_'.$file.'.php';
	*
	* if(@filesize($logfile) > 2048000) {
	* $dir = opendir($logdir);
	* $length = strlen($file);
	* $maxid = $id = 0;
	* while($entry = readdir($dir)) {
	* if(strexists($entry, $yearmonth.'_'.$file)) {
	* $id = intval(substr($entry, $length + 8, -4));
	* $id > $maxid && $maxid = $id;
	* }
	* }
	* closedir($dir);
	*
	* $logfilebak = $logdir.$yearmonth.'_'.$file.'_'.($maxid + 1).'.php';
	* @rename($logfile, $logfilebak);
	* }
	* if($fp = @fopen($logfile, 'a')) {
	* @flock($fp, 2);
	* $log = is_array($log) ? $log : array($log);
	* foreach($log as $tmp) {
	* fwrite($fp, "<?PHP exit;?>\t".str_replace(array('<?', '?>'), '', $tmp)."\n");
	* }
	* fclose($fp);
	* }
	* }*/
}

function getcolorpalette( $colorid, $id, $background, $fun = '' )
{
	return "<input id=\"c$colorid\" onclick=\"c{$colorid}_frame.location='static/image/admincp/getcolor.htm?c{$colorid}|{$id}|{$fun}';showMenu({'ctrlid':'c$colorid'})\" type=\"button\" class=\"colorwd\" value=\"\" style=\"background: $background\"><span id=\"c{$colorid}_menu\" style=\"display: none\"><iframe name=\"c{$colorid}_frame\" src=\"\" frameborder=\"0\" width=\"210\" height=\"148\" scrolling=\"no\"></iframe></span>";
}

function notification_add( $touid, $type, $note, $notevars = array(), $system = 0 )
{
	global $_G;

	$tospace = array( 'uid' => $touid );
	space_merge( $tospace, 'field_home' );
	$filter = empty( $tospace['privacy']['filter_note'] ) ? array() : array_keys( $tospace['privacy']['filter_note'] );

	if ( $filter && ( in_array( $type . '|0', $filter ) || in_array( $type . '|' . $_G['uid'], $filter ) ) )
	{
		return false;
	}

	$notevars['actor'] = "<a href=\"home.php?mod=space&uid=$_G[uid]\">" . $_G['member']['username'] . "</a>";

	if ( ! is_numeric( $type ) )
	{
		$vars = explode( ':', $note );
		if ( count( $vars ) == 2 )
		{
			$notestring = lang( 'plugin/' . $vars[0], $vars[1], $notevars );
		}
		else
		{
			$notestring = lang( 'notification', $note, $notevars );
		}
	}
	else
	{
		$notestring = $note;
	}

	$oldnote = array();
	if ( $notevars['from_id'] && $notevars['from_idtype'] )
	{
		$oldnote = DB::fetch_first( "SELECT * FROM " . DB::table( 'home_notification' ) . "
			WHERE uid='$touid' AND from_id='$notevars[from_id]' AND from_idtype='$notevars[from_idtype]'" );
	}
	if ( empty( $oldnote['from_num'] ) )
		$oldnote['from_num'] = 0;

	$setarr = array(
		'uid' => $touid,
		'type' => $type,
		'new' => 1,
		'authorid' => $_G['uid'],
		'author' => $_G['username'],
		'note' => addslashes( $notestring ),
		'dateline' => $_G['timestamp'],
		'from_id' => $notevars['from_id'],
		'from_idtype' => $notevars['from_idtype'],
		'from_num' => ( $oldnote['from_num'] + 1 ) );
	if ( $system )
	{
		$setarr['authorid'] = 0;
		$setarr['author'] = '';
	}

	if ( $oldnote['id'] )
	{
		DB::update( 'home_notification', $setarr, array( 'id' => $oldnote['id'] ) );
	}
	else
	{
		$oldnote['new'] = 0;
		DB::insert( 'home_notification', $setarr );
	}

	if ( empty( $oldnote['new'] ) )
	{
		DB::query( "UPDATE " . DB::table( 'common_member_status' ) . " SET notifications=notifications+1 WHERE uid='$touid'" );
		DB::query( "UPDATE " . DB::table( 'common_member' ) . " SET newprompt=newprompt+1 WHERE uid='$touid'" );

		require_once libfile( 'function/mail' );
		$mail_subject = lang( 'notification', 'mail_to_user' );
		sendmail_touser( $touid, $mail_subject, $notestring, $type );
	}

	if ( ! $system && $_G['uid'] && $touid != $_G['uid'] )
	{
		require_once libfile('function/friend');
		increase_intimacy($_G['uid'], $touid);
		//DB::query( "UPDATE " . DB::table( 'home_friend' ) . " SET num=num+1 WHERE uid='$_G[uid]' AND fuid='$touid'" );
	}
}

function sendpm( $toid, $subject, $message, $fromid = '' )
{
	global $_G;
	if ( $fromid === '' )
	{
		$fromid = $_G['uid'];
	}
	loaducenter();
	uc_pm_send( $fromid, $toid, $subject, $message );
}

function g_icon( $groupid, $return = 0 )
{
	global $_G;
	if ( empty( $_G['cache']['usergroups'][$groupid]['icon'] ) )
	{
		$s = '';
	}
	else
	{
		if ( substr( $_G['cache']['usergroups'][$groupid]['icon'], 0, 5 ) == 'http:' )
		{
			$s = '<img src="' . $_G['cache']['usergroups'][$groupid]['icon'] . '" align="absmiddle">';
		}
		else
		{
			$s = '<img src="' . $_G['setting']['attachurl'] . 'common/' . $_G['cache']['usergroups'][$groupid]['icon'] . '" align="absmiddle">';
		}
	}
	if ( $return )
	{
		return $s;
	}
	else
	{
		echo $s;
	}
}

function updatediytemplate( $targettplname = '' )
{
	global $_G;
	$r = false;
	$where = empty( $targettplname ) ? '' : " WHERE targettplname='$targettplname'";
	$query = DB::query( "SELECT * FROM " . DB::table( 'common_diy_data' ) . "$where" );
	require_once libfile( 'function/portalcp' );
	while ( $value = DB::fetch( $query ) )
	{
		$r = save_diy_data( $value['primaltplname'], $value['targettplname'], unserialize( $value['diycontent'] ) );
	}
	return $r;
}

function space_key( $uid, $appid = 0 )
{
	global $_G;

	$siteuniqueid = DB::result_first( "SELECT svalue FROM " . DB::table( 'common_setting' ) . " WHERE skey='siteuniqueid'" );
	return substr( md5( $siteuniqueid . '|' . $uid . ( empty( $appid ) ? '' : '|' . $appid ) ), 8, 16 );
}

function getposttablebytid( $tid )
{
	global $_G;
	loadcache( 'threadtableids' );
	$threadtableids = ! empty( $_G['cache']['threadtableids'] ) ? $_G['cache']['threadtableids'] : array();
	if ( ! in_array( 0, $threadtableids ) )
	{
		$threadtableids = array_merge( array( 0 ), $threadtableids );
	}

	foreach ( $threadtableids as $tableid )
	{
		$threadtable = $tableid ? "forum_thread_$tableid" : 'forum_thread';
		$posttableid = DB::result_first( "SELECT posttableid FROM " . DB::table( $threadtable ) . " WHERE tid='$tid'" );
		if ( $posttableid !== false )
		{
			break;
		}
	}
	if ( ! $posttableid )
	{
		return 'forum_post';
	}
	return 'forum_post_' . $posttableid;
}

function getposttableid( $type )
{
	global $_G;
	loadcache( 'posttable_info' );
	if ( $type == 'a' )
	{
		$tabletype = 'addition';
	}
	else
	{
		$tabletype = 'primary';
	}
	if ( ! empty( $_G['cache']['posttable_info'] ) )
	{
		foreach ( $_G['cache']['posttable_info'] as $key => $value )
		{
			if ( $value['type'] == $tabletype )
			{
				return $key;
			}
		}
	}
	return null;
}

function getposttable( $type, $noprefix = true )
{
	$tableid = getposttableid( $type );
	if ( $type == 'a' && $tableid === null )
	{
		return null;
	}
	if ( $tableid )
	{
		$tablename = "forum_post_$tableid";
	}
	else
	{
		$tablename = 'forum_post';
	}

	if ( ! $noprefix )
	{
		$tablename = DB::table( $tablename );
	}
	return $tablename;
}

function getcountofposts( $from, $condition )
{
	$ptable = getposttable( 'p' );
	$atable = getposttable( 'a' );

	$from_clause = str_replace( DB::table( 'forum_post' ), DB::table( $ptable ), $from );
	$sum = DB::result_first( "SELECT COUNT(*) FROM $from_clause WHERE $condition" );
	if ( $atable )
	{
		$from_clause = str_replace( DB::table( 'forum_post' ), DB::table( $atable ), $from );
		$sum += DB::result_first( "SELECT COUNT(*) FROM $from_clause WHERE $condition" );
	}
	return $sum;
}

function getfieldsofposts( $field, $condition )
{
	$ptable = getposttable( 'p' );
	$atable = getposttable( 'a' );

	$query = DB::query( "SELECT $field FROM " . DB::table( $ptable ) . " WHERE $condition" );
	$result = array();
	while ( $post = DB::fetch( $query ) )
	{
		$result[] = $post;
	}
	if ( $atable )
	{
		$query = DB::query( "SELECT $field FROM " . DB::table( $atable ) . " WHERE $condition" );
		while ( $post = DB::fetch( $query ) )
		{
			$result[] = $post;
		}
	}
	return $result;
}

function getallwithposts( $sqlstruct, $onlyprimarytable = false )
{
	$ptable = getposttable( 'p' );
	$atable = getposttable( 'a' );
	$result = array();

	$from_clause = str_replace( DB::table( 'forum_post' ), DB::table( $ptable ), $sqlstruct['from'] );
	$sql = "SELECT {$sqlstruct['select']} FROM $from_clause WHERE {$sqlstruct['where']}";
	$sqladd = '';
	if ( ! empty( $sqlstruct['order'] ) )
	{
		$sqladd .= " ORDER BY {$sqlstruct['order']}";
	}
	if ( ! empty( $sqlstruct['limit'] ) )
	{
		$sqladd .= " LIMIT {$sqlstruct['limit']}";
	}
	$sql = $sql . $sqladd;
	$query = DB::query( $sql . " " . getSlaveID() );
	while ( $row = DB::fetch( $query ) )
	{
		$result[] = $row;
	}

	if ( ! $onlyprimarytable && $atable !== null )
	{
		$from_clause = str_replace( DB::table( 'forum_post' ), DB::table( $atable ), $sqlstruct['from'] );
		$sql = "SELECT {$sqlstruct['select']} FROM $from_clause WHERE {$sqlstruct['where']}";
		$sql = $sql . $sqladd;

		$query = DB::query( $sql );
		while ( $row = DB::fetch( $query ) )
		{
			$result[] = $row;
		}
	}
	return $result;
}

function insertpost( $data )
{
	if ( isset( $data['tid'] ) )
	{
		$tableid = DB::result_first( "SELECT posttableid FROM " . DB::table( 'forum_thread' ) . " WHERE tid='{$data['tid']}'" );
	}
	else
	{
		$tableid = getposttableid( 'p' );
		$data['tid'] = 0;
	}
	$pid = DB::insert( 'forum_post_tableid', array( 'pid' => null ), true );

	if ( ! $tableid )
	{
		$tablename = 'forum_post';
	}
	else
	{
		$tablename = "forum_post_$tableid";
	}

	$data = array_merge( $data, array( 'pid' => $pid ) );

	DB::insert( $tablename, $data );
	if ( $pid % 1024 == 0 )
	{
		DB::delete( 'forum_post_tableid', "pid<$pid" );
	}
	save_syscache( 'max_post_id', $pid );
	return $pid;
}

function updatepost( $data, $condition, $unbuffered = false )
{
	global $_G;
	loadcache( 'posttableids' );
	$affected_rows = 0;
	if ( ! empty( $_G['cache']['posttableids'] ) )
	{
		$posttableids = $_G['cache']['posttableids'];
	}
	else
	{
		$posttableids = array( '0' );
	}
	foreach ( $posttableids as $id )
	{
		if ( $id == 0 )
		{
			DB::update( 'forum_post', $data, $condition, $unbuffered );
		}
		else
		{
			DB::update( "forum_post_$id", $data, $condition, $unbuffered );
		}
		$affected_rows += DB::affected_rows();
	}
	return $affected_rows;
}

function memory( $cmd, $key = '', $value = '', $ttl = 0 )
{
	$discuz = &discuz_core::instance();
	if ( $cmd == 'check' )
	{
		return $discuz->mem->enable ? $discuz->mem->type : '';
	}
	elseif ( $discuz->mem->enable && in_array( $cmd, array(
		'set',
		'get',
		'rm' ) ) )
	{
		$key = ($discuz->mem->prefix).$key;
		//计算key所在服务器
		$node = $discuz->mem->server_hash->getNode($key);
		$memory = &discuz_memcache::instance($node);

		switch ( $cmd )
		{
			case 'set':
				return $memory->set( $key, $value, $ttl );
				break;
			case 'get':
				return $memory->get( $key );
				break;
			case 'rm':
				return $memory->rm( $key );
				break;
		}
	}
	return null;
}

function memory_redis( $cmd, $key = '', $value = '', $ttl = 0, $port = 6377 )
{
	require_once libfile('class/myredis');
	$redis = &myredis::instance($port);

	if ($redis->connected && in_array($cmd, array('set', 'get', 'delete' )))
	{
		switch ( $cmd )
		{
			case 'set':
				return $redis->obj->set( $key, $value, $ttl );
				break;
			case 'get':
				return $redis->obj->get( $key );
				break;
			case 'delete':
				return $redis->obj->delete( $key );
				break;
		}
	}
	return null;
}

function ipaccess( $ip, $accesslist )
{
	return preg_match( "/^(" . str_replace( array( "\r\n", ' ' ), array( '|', '' ), preg_quote( $accesslist, '/' ) ) . ")/", $ip );
}

function ipbanned( $onlineip )
{
	global $_G;

	if ( $_G['setting']['ipaccess'] && ! ipaccess( $onlineip, $_G['setting']['ipaccess'] ) )
	{
		return true;
	}

	loadcache( 'ipbanned' );
	if ( empty( $_G['cache']['ipbanned'] ) )
	{
		return false;
	}
	else
	{
		if ( $_G['cache']['ipbanned']['expiration'] < TIMESTAMP )
		{
			require_once libfile( 'function/cache' );
			updatecache( 'ipbanned' );
		}
		return preg_match( "/^(" . $_G['cache']['ipbanned']['regexp'] . ")$/", $onlineip );
	}
}

function getcount( $tablename, $condition )
{
	if ( empty( $condition ) )
	{
		$where = '1';
	}
	elseif ( is_array( $condition ) )
	{
		$where = DB::implode_field_value( $condition, ' AND ' );
	}
	else
	{
		$where = $condition;
	}
	$row = DB::fetch_first( "SELECT COUNT(*) AS num FROM " . DB::table( $tablename ) . " WHERE $where " . getSlaveID() );
	return $row['num'];
}

function sysmessage( $message )
{
	require libfile( 'function/sysmessage' );
	show_system_message( $message );
}

function forumperm( $permstr, $groupid = 0 )
{
	global $_G;

	$groupidarray = array( $_G['groupid'] );
	if ( $groupid )
	{
		return preg_match( "/(^|\t)(" . $groupid . ")(\t|$)/", $permstr );
	}
	foreach ( explode( "\t", $_G['member']['extgroupids'] ) as $extgroupid )
	{
		if ( $extgroupid = intval( trim( $extgroupid ) ) )
		{
			$groupidarray[] = $extgroupid;
		}
	}
	if ( $_G['setting']['verify']['enabled'] )
	{
		getuserprofile( 'verify1' );
		for ( $i = 1; $i < 6; $i++ )
		{
			if ( $_G['member']['verify' . $i] == 1 )
			{
				$groupidarray[] = 'v' . $i;
			}
		}
	}
	return preg_match( "/(^|\t)(" . implode( '|', $groupidarray ) . ")(\t|$)/", $permstr );
}

if ( ! function_exists( 'file_put_contents' ) )
{
	if ( ! defined( 'FILE_APPEND' ) )
		define( 'FILE_APPEND', 8 );
	function file_put_contents( $filename, $data, $flag = 0 )
	{
		$return = false;
		if ( $fp = @fopen( $filename, $flag != FILE_APPEND ? 'w' : 'a' ) )
		{
			if ( $flag == LOCK_EX )
				@flock( $fp, LOCK_EX );
			$return = fwrite( $fp, is_array( $data ) ? implode( '', $data ) : $data );
			fclose( $fp );
		}
		return $return;
	}
}

function checkperm( $perm )
{
	global $_G;
	return ( empty( $_G['group'][$perm] ) ? '' : $_G['group'][$perm] );
}

function periodscheck( $periods, $showmessage = 1 )
{
	global $_G;

	if ( ! $_G['group']['disableperiodctrl'] && $_G['setting'][$periods] )
	{
		$now = dgmdate( TIMESTAMP, 'G.i' );
		foreach ( explode( "\r\n", str_replace( ':', '.', $_G['setting'][$periods] ) ) as $period )
		{
			list( $periodbegin, $periodend ) = explode( '-', $period );
			if ( ( $periodbegin > $periodend && ( $now >= $periodbegin || $now < $periodend ) ) || ( $periodbegin < $periodend && $now >= $periodbegin && $now < $periodend ) )
			{
				$banperiods = str_replace( "\r\n", ', ', $_G['setting'][$periods] );
				if ( $showmessage )
				{
					showmessage( 'period_nopermission', null, array( 'banperiods' => $banperiods ), array( 'login' => 1 ) );
				}
				else
				{
					return true;
				}
			}
		}
	}
	return false;
}

function cknewuser( $return = 0 )
{
	global $_G;

	$result = true;

	if ( ! $_G['uid'] )
		return true;

	if ( checkperm( 'disablepostctrl' ) )
	{
		return $result;
	}
	$ckuser = $_G['member'];

	if ( $_G['setting']['newbiespan'] && $_G['timestamp'] - $ckuser['regdate'] < $_G['setting']['newbiespan'] * 60 )
	{
		if ( empty( $return ) )
			showmessage( 'no_privilege_newbiespan', '', array( 'newbiespan' => $_G['setting']['newbiespan'] ), array( 'return' => true ) );
		$result = false;
	}

	if ( $_G['setting']['need_avatar'] && empty( $ckuser['avatarstatus'] ) )
	{
		if ( empty( $return ) )
			showmessage( 'no_privilege_avatar', '', array(), array( 'return' => true ) );
		$result = false;
	}

	if ( $_G['setting']['need_email'] && empty( $ckuser['emailstatus'] ) )
	{
		if ( empty( $return ) )
			showmessage( 'no_privilege_email', '', array(), array( 'return' => true ) );
		$result = false;
	}

	if ( $_G['setting']['need_friendnum'] )
	{
		space_merge( $ckuser, 'count' );
		if ( $ckuser['friends'] < $_G['setting']['need_friendnum'] )
		{
			if ( empty( $return ) )
				showmessage( 'no_privilege_friendnum', '', array( 'friendnum' => $_G['setting']['need_friendnum'] ), array( 'return' => true ) );
			$result = false;
		}
	}
	return $result;
}

function manyoulog( $logtype, $uids, $action, $fid = '' )
{
	global $_G;

	$action = daddslashes( $action );
	if ( $logtype == 'user' )
	{
		$values = array();
		$uids = is_array( $uids ) ? $uids : array( $uids );
		foreach ( $uids as $uid )
		{
			$uid = intval( $uid );
			$values[$uid] = "('$uid', '$action', '" . TIMESTAMP . "')";
		}
		if ( $values )
		{
			DB::query( "REPLACE INTO " . DB::table( 'common_member_log' ) . " (`uid`, `action`, `dateline`) VALUES " . implode( ',', $values ) );
		}
	}
}

function getuserapp( $panel = 0 )
{
	require_once libfile( 'function/manyou' );
	manyou_getuserapp( $panel );
	return true;
}

function getmyappiconpath( $appid, $iconstatus = 0 )
{
	if ( $iconstatus > 0 )
	{
		return getglobal( 'config/web/attach' ) . 'myapp/icon/' . $appid . '.jpg';
		//return getglobal('setting/attachurl').'./'.'myapp/icon/'.$appid.'.jpg';
	}
	return 'http://appicon.manyou.com/icons/' . $appid;
}

function getexpiration()
{
	global $_G;
	$date = getdate( $_G['timestamp'] );
	return mktime( 0, 0, 0, $date['mon'], $date['mday'], $date['year'] ) + 86400;
}

function return_bytes( $val )
{
	$val = trim( $val );
	$last = strtolower( $val{strlen( $val ) - 1} );
	switch ( $last )
	{
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}
	return $val;
}

function getonlinemember( $uids )
{
	global $_G;
	if ( $uids && is_array( $uids ) && empty( $_G['ols'] ) )
	{
		$_G['ols'] = array();
		$query = DB::query( "SELECT * FROM " . DB::table( 'common_session' ) . " WHERE uid IN (" . dimplode( $uids ) . ")" );
		while ( $value = DB::fetch( $query ) )
		{
			if ( ! $value['invisible'] )
			{
				$_G['ols'][$value['uid']] = $value['lastactivity'];
			}
		}
	}
}
/**
 * 数组转码
 *
 * @author wistar 111205
 * @param array $arr
 * @param string $in
 * @param string $out
 * @return array
 */
function iconv_array( $arr, $in = "GBK", $out = "UTF-8" )
{
	$func = create_function( '&$value, $key, $act', '$act=explode("|", $act); $value=iconv($act[0], $act[1], $value);' );
	array_walk_recursive( $arr, $func, "$in|$out" );
	return $arr;
}

/**
 * 解码javascript中用escape编码的字符串
 *
 * @author wistar 120412
 * @return string
 */
function unescape( $str )
{
	$decodedStr = "";
	$pos = 0;
	$len = strlen( $str );
	while ( $pos < $len )
	{
		$charAt = substr( $str, $pos, 1 );
		if ( $charAt == '%' )
		{
			$pos++;
			$charAt = substr( $str, $pos, 1 );
			if ( $charAt == 'u' )
			{
				// we got a unicode character
				$pos++;
				$unicodeHexVal = substr( $str, $pos, 4 );
				$unicode = hexdec( $unicodeHexVal );
				$entity = "&#" . $unicode . ';';
				$decodedStr .= utf8_encode( $entity );
				$pos += 4;
			}
			else
			{
				// we have an escaped ascii character
				$hexVal = substr( $str, $pos, 2 );
				$decodedStr .= chr( hexdec( $hexVal ) );
				$pos += 2;
			}
		}
		else
		{
			$decodedStr .= $charAt;
			$pos++;
		}
	}
	return $decodedStr;
}

/**
 * 判断远程文件是否存在
 *
 * @author wistar 111205
 *
 * @param string $url
 * @return boolean
 */
function check_remote_file_exists( $url )
{
	$curl = curl_init( $url );
	// 不取回数据
	curl_setopt( $curl, CURLOPT_NOBODY, true );
	curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'GET' );
	// 发送请求
	$result = curl_exec( $curl );
	$found = false;
	// 如果请求没有发送失败
	if ( $result !== false )
	{
		// 再检查http响应码是否为200
		$statusCode = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
		if ( $statusCode == 200 )
		{
			$found = true;
		}
	}
	curl_close( $curl );
	return $found;
}

/**
 * @author JiangHong
 * @param int 高度
 * @param int 宽度
 * @param int 类型(1为不裁剪按比例缩放，2为裁剪)
 * @param string 文件名（包含目录）
 * @param int aid 默认为空，若大于0则去数据库查询文件名，而不使用前面参数提供的文件名
 */
function getimagethumb( $width, $height, $type, $filename, $aid = 0, $serverid = 1 )
{
	global $_G;
	if ( $aid > 0 && empty($filename) )
	{
		$args = DB::fetch_first( 'SELECT attachment, dir, serverid, uid FROM `' . DB::table( 'forum_attachment' ) . "` WHERE aid = '{$aid}'" );
		$filename = $args['dir'] . '/' . $args['attachment'];
		$serverid = $args['serverid'];
	}
	if( $serverid > 50 ) {
		$config = $_G['config']['cdn'][$_G['config']['cdns']['ids'][$serverid]];
		if( $config ) {
			switch($type){
			case 11:
				$mtype = 3;break;
			case 12:
				$mtype = 4;break;
			default:
				$mtype = $type;break;
			}
			$config['id'] = $config['id'] ? $config['id'] : '!';
			if( stripos( $filename, $config['id'] ) !== false ) {
				$filename = preg_replace("/{$config[id]}(t\d+w\d+h\d+)?(x\d+m\d+)?/i", "", $filename);
			}
			//$number = ord(substr($filename, strrpos($filename, '.') - 1, 1))%9 + 1;/*取image1~image9*/
			return ( $config['cdnurl'] ? "http://".$config['cdnurl']."/" : "http://{$config[name]}.b0.upaiyun.com/" ) . "{$filename}" . getUpYun( true, $width, $height, $mtype, 0, 1, true, $_G['config']['cdns']['ids'][$serverid]);
			//return ( $config['cdnurl'] ? "http://image{$number}.8264.com/" : "http://{$config[name]}.b0.upaiyun.com/" ) . "{$filename}" . getUpYun( true, $width, $height, $mtype, 0, 1, true, $_G['config']['cdns']['ids'][$serverid]);
		}
	}
	$md5 = md5( $filename );
	$attchdomain = empty($_G['config']['web']['attachauto']) ? $_G['config']['web']['attach'] : $_G['config']['web']['attachauto'];
	return $attchdomain . 'thumbimg/' . $md5[0] . '/' . $md5[3] . '/' . intval( $width ) . '/' . intval( $height ) . '/' . intval( $type ) . '/' . base64_encode( $filename ) . '.auto.jpg';
}
/**
 * 显示一个评论框
 */
function showcomment( $id, $desc = true )
{
	global $_G;
	$id = intval( $id );
	if ( $id > 0 )
	{
		echo "<div id='commentsrv_{$id}'><script>ajaxget('/forum.php?ctl=comment&act=showcomment&id={$id}&page={$_G[gp_page]}&desc=1', 'commentsrv_{$id}')</script></div>";
		return;
	}
}
/**
 * 新增用于数据监控系统的内容记录。此方法不直接调用，使用每个数据类型文件单独的记录函数记录
 * @author JiangHong
 * @param String $type 类型
 * @param Array $data 记录的数据
 * @return bool
 */
function addRecordByType( $type, $data )
{
	$files = ( libfile( 'record/' . $type, 'class' ) );
	if ( $files )
	{
		require_once $files;
		eval( "\$recordclass = $type::instance('{$type}');" );
		$return = call_user_func_array( array( $recordclass, 'recorddata' ), array( $data ) );
		return $return['result'];
	}
	else
	{
		exit( $files . ' not_exists' );
	}
}
/**
 * 记录用户信息
 * @author JiangHong
 * @param int $uid
 * @param int $action 1：注册 2：修改基本资料
 * @return void
 */
function addrecorduserinfo( $uid, $action )
{
	if ( ! empty( $uid ) )
	{
		$userinfo = DB::fetch_first( "SELECT m.*,p.* FROM " . DB::table( 'common_member' ) . " m LEFT JOIN " . DB::table( 'common_member_profile' ) . " p ON m.uid = p.uid WHERE m.uid = {$uid}" );
		$userinfo['action'] = in_array( $action, array( 1, 2 ) ) ? $action : 2;
		addRecordByType( 'userinfo', $userinfo );
	}
}
/**
 * 记录版块信息
 * @author JiangHong
 * @param int $fid 版块ID
 * @param int $action 1：增加版块 2：删除版块 3：修改版块信息
 * @return void
 */
function addrecordforuminfo( $fid, $action, $args = array() )
{
	global $_G;
	loadcache( 'forums' );
	$data = $_G['cache']['forums'][$fid];
	if ( ! empty( $data ) )
	{
		$foruminfo = array(
			'fid' => $fid,
			'name' => $data['name'],
			'level' => 1 );
		$foruminfo['action'] = in_array( $action, array(
			1,
			2,
			3 ) ) ? $action : 3;
		if ( $data['fup'] > 0 )
		{
			$upforuminfo = $_G['cache']['forums'][$data['fup']];
		}
		if ( $data['type'] == 'sub' )
		{
			$foruminfo['boardlevel3'] = $foruminfo['name'];
			$foruminfo['boardlevel2'] = $upforuminfo['name'];
			$foruminfo['boardlevel1'] = $_G['cache']['forums'][$upforuminfo['fup']]['name'];
			$foruminfo['level'] = 3;
		}
		elseif ( $data['type'] == 'forum' && $data['fup'] > 0 )
		{
			$foruminfo['boardlevel2'] = $foruminfo['name'];
			$foruminfo['boardlevel1'] = $upforuminfo['name'];
			$foruminfo['level'] = 2;
		}
		if ( ! empty( $_G['forum'] ) )
		{
			$info = array(
				'todayposts' => $_G['forum']['todayposts'],
				'threads' => $_G['forum']['threads'],
				'posts' => $_G['forum']['posts'],
				'lastpost' => $_G['forum']['lastpost'],
				);
		}
		else
		{
			$info = DB::fetch_first( "SELECT todayposts, threads, posts ,lastpost FROM " . DB::table( 'forum_forum' ) . " WHERE fid = {$fid}" );
		}
		$_tmp = explode( "\t", $info['lastpost'] );
		$info['lastpost'] = $_tmp[2];
		$info['todayposts'] += empty( $args['posts'] ) ? 0 : $args['posts'];
		$info['posts'] += empty( $args['posts'] ) ? 0 : $args['posts'];
		$info['threads'] += empty( $args['threads'] ) ? 0 : $args['threads'];
		$info['lastpost'] = empty( $args['lastpost'] ) ? $info['lastpost'] : $args['lastpost'];
		$foruminfo = array_merge( $foruminfo, $info );
		addRecordByType( 'fmboardinfo', $foruminfo );
	}
}
/**
 * 记录版主信息
 * @author JiangHong
 * @param array $data
 * @param int $action 1：增加版主 2：撤销版主
 * @return void
 */
function addrecordadminchange( $data, $action )
{
	if ( ! empty( $data ) )
	{
		$admininfo['fid'] = $data['fid'];
		$admininfo['name'] = empty( $data['name'] ) ? DB::result_first( "SELECT name FROM " . DB::table( 'forum_forum' ) . " WHERE fid = {$data[fid]}" ) : $data['name'];
		$admininfo['adminuid'] = $data['uid'];
		$admininfo['adminusername'] = empty( $data['username'] ) ? DB::result_first( 'SELECT username FROM ' . DB::table( 'common_member' ) . " WHERE uid = {$data[uid]}" ) : $data['username'];
		$admininfo['action'] = in_array( $action, array( 1, 2 ) ) ? $action : 1;
		addRecordByType( 'fmboardadmin', $admininfo );
	}
}
/**
 * 记录帖子的信息
 * @author JiangHong
 * @param array $data
 * @param int $action 1：发帖 2：修改 3：回帖
 * @return void
 */
function addrecordthread( $data, $action )
{
	if ( ! empty( $data ) && $data['tid'] > 0 && $data['uid'] > 0 && in_array( $action, array(
		1,
		2,
		3 ) ) )
	{
		$data['fid'] = $data['fid'] > 0 ? $data['fid'] : DB::result_first( "SELECT fid FROM " . DB::table( 'forum_thread' ) . " WHERE tid = {$data[tid]}" );
		$data['name'] = ! empty( $data['name'] ) ? $data['name'] : DB::result_first( "SELECT name FROM " . DB::table( 'forum_forum' ) . " WHERE fid = {$data[fid]}" );
		$data['username'] = ! empty( $data['username'] ) ? $data['username'] : DB::result_first( 'SELECT username FROM ' . DB::table( 'common_member' ) . " WHERE uid = {$data[uid]}" );
		if ( $action == 1 || $data['picupload'] == 1 )
		{
			$data['replies'] = $data['replies'] > 0 ? $data['replies'] : 0;
			$data['views'] = 0;
			$data['lastposter'] = $data['username'];
			global $_G;
			$data['lastpost'] = ! empty( $data['lastpost'] ) ? $data['lastpost'] : $_G['timestamp'];
		}
		else
		{
			$postinfo = DB::fetch_first( "SELECT subject, replies, views, lastposter, lastpost FROM " . DB::table( 'forum_thread' ) . " WHERE tid = {$data[tid]}" );
			require_once libfile( 'function/forumlist' );
			$postinfo['views'] += get_redis_views( $data['tid'], 'viewthread' );
			$data = array_merge( $data, $postinfo );
		}
		$data['action'] = $action;
		addRecordByType( 'fmpostinfo', $data );
	}
}
/**
 * 记录帖子的状态信息
 * @author JiangHong
 * @param array $data
 * @param int $action 1：删除 2：加精 3：取消加精 4：置顶 5：取消置顶
 * @return void
 */
function addrecordthreadstatus( $data, $action )
{
	if ( ! empty( $data ) && ! empty( $data['username'] ) && $data['tid'] > 0 && in_array( $action, array(
		1,
		2,
		3,
		4,
		5 ) ) )
	{
		$data['fid'] = $data['fid'] > 0 ? $data['fid'] : DB::result_first( "SELECT fid FROM " . DB::table( 'forum_thread' ) . " WHERE tid = {$data[tid]}" );
		$data['name'] = ! empty( $data['name'] ) ? $data['name'] : DB::result_first( "SELECT name FROM " . DB::table( 'forum_forum' ) . " WHERE fid = {$data[fid]}" );
		$data['pid'] = $data['pid'] > 0 ? $data['pid'] : DB::result_first( "SELECT pid FROM " . DB::table( 'forum_post' ) . " WHERE tid = {$data[tid]} AND first = 1 LIMIT 1" );
		$data['action'] = $action;
		addRecordByType( 'fmpoststatus', $data );
	}
}
/**
 * 记录用户上下线操作
 * @param array $arr action - 1：登陆 2：退出
 */
function addrecorduserupdownlog( $arr )
{
	global $_G;
	if ( $arr )
	{
		$data = array(
			'uid' => $_G['uid'],
			'username' => $_G['username'],
			'ip' => $_G['clientip'],
			'port' => $_SERVER['REMOTE_PORT'],
			'logontype' => $arr['logontype'],
			'action' => $arr['action'] );
		addRecordByType( 'userupdownlog', $data );
	}
}

/**
 * 构建服务接口调用参数
 *
 * @author rinne 140320
 * @param array $params 参数数组
 * @param boolean $passBase 是否忽略基类回调
 */
function build_spt_url($params) {
	// 电商token
	$spt_token = '92e27b6cd4c1aba63f653420f63a80ab';
	ksort($params);
	reset($params);
	$str_q = http_build_query($params);
	$sign = md5($str_q . $spt_token);
	return '?' . $str_q . '&sign=' . $sign;
}

function getSlaveID(){
	global $_G;
	return $_G['config']['db']['slaveopen'] === true ? "((SLAVE))" : "";
}
/**
 * @todo			读取相关参数
 * @author			JiangHong
 * @copyright		2014
 * @param			Boolean		$thumb
 * @param			Int			$width
 * @param			Int			$height
 * @param			Int			$thumbtype				缩放种类：
 * 															1:保持比例，限定宽高。
 * 															2:裁剪图片，限定宽高。
 * 															3:限制宽度，高度自适应
 * 															4:限制高度，宽度自适应
 * 															5:限制最长边，短边自适应
 * 															6:限制最短边，长边自适应
 * @param			Int			$waterposion			水印位置
 * @param			Int			$watertype				水印的种类，（新闻用的水印和论坛不同）
 * @param			Boolean		$returnurl				是否仅返回url
 * @param			String		$name		cdn空间名
 * @return			mixed
 */
function getUpYun( $thumb = false, $width = 0, $height = 0, $thumbtype = 1, $waterposion = 0, $watertype = 1, $returnurl = true, $name = 'images' )
{
	global $_G;
	$config = $_G['config']['cdn'][$name];
	$return = '';
	if ( $thumb ) {
		$width = intval( $width );
		$height = intval( $height );
		switch( $thumbtype ) {
			case 2:
				$return .= "t2";break;
			case 3:
				$return .= "t3";$height = 0;break;
			case 4:
				$return .= "t4";$width = 0;break;
			case 5:
				$return .= "t5";$width = $height = max( $width, $height );break;
			case 6:
				$return .= "t5";$width = $height = min( $width, $height );break;
			case 12:
				$return .= "t12";break;
			default:
				$return .= "t1";break;
		}
		$return .= "w{$width}h{$height}";
	}
	$waterposion = intval( $waterposion );
	$waterposion = $waterposion <= 9 && $waterposion >= 0 ? $waterposion : 9;
	if ( $waterposion > 0 ) {
		switch( $waterposion ) {
			case 1:
				$return .= "x1";break;
			default:
				$return .= "x9";break;
		}
		$watertype = intval( $watertype );
		switch( $watertype ) {
			case 2:
				$return .= "m2";break;
			case 3:
		 		$return .= "m3";break;
			default:
				$return .= "m1";break;
		}
	}
	$return = testUpYunUrl( $return, $name, $returnurl );
	return $return;
}
/**
 * @todo			检测是否为在线已经配置的自定义版本,并自动转到相应近似的版本
 * @author			JiangHong
 * @param			String		$url
 * @param			String		$name		cdn空间名
 * @return			String
 */
function testUpYunUrl( $url, $name = 'test', $returnurl = true )
{
	global $_G;
	//echo "<p>源<font color='red'>{$url}</font></p>";
	$config = $_G['config']['cdn'][$name];
	$_jgf = $config['id'] ? $config['id'] : '!';
	if ( $url && is_array( $config['custom'] ) ) {
		if ( ! in_array( $url, $config['custom'] ) ) {
			preg_match_all( "/(t\d+)w(\d+)h(\d+)(x\d+m\d+)?/i", $url, $matches, PREG_SET_ORDER );
			$nowconfig = $matches[0];
			$url = '';
			if( ! empty( $nowconfig ) ) {
				$custom = memory( 'get', 'upyun_config_custom' );
				if( ! $custom ){
					$custom = array();
					foreach( $config['custom'] as $_custom ) {
						$_matchs = $_tmp = array();
						preg_match_all( "/(t\d+)w(\d+)h(\d+)(x\d+m\d+)?/i", $_custom, $_matchs, PREG_SET_ORDER );
						if( ! empty( $_matchs[0] ) ) {
							list( $_tmp['source'], $_tmp['thumbtype'], $_tmp['width'], $_tmp['heigh'], $_tmp['water'] ) = $_matchs[0];
							$custom[] = $_tmp;
						}
					}
					memory( 'set', 'upyun_config_custom', $custom, $config['timeout'] > 10 ? $config['timeout'] : 10 );
				}
				//var_dump($nowconfig);
				$findconfig = array();
				foreach( $custom as $_value ) {
					/*如果缩略图不要水印，则对有水印的缩略图，跳过  */
					if( empty( $nowconfig[4] ) && ! empty( $_value['water'] ) ) {
						continue;
					}
					if( $nowconfig[2] == 0 ) {
						$_cmp1 = $findconfig['height'];
						$_cmp2 = $nowconfig[3];
						$_key = $_value['height'];
					} else {
						$_cmp1 = $findconfig['width'];
						$_cmp2 = $nowconfig[2];
						$_key = $_value['width'];
					}
					if ( $nowconfig[2] !== $nowconfig[3] && $nowconfig[2] > 0 && $nowconfig[3] > 0 ) {
						/*此处当宽高不同的时候，将按比例计算*/
						$_now_fixed = sprintf( "%1.2f", $nowconfig[3] / $nowconfig[2] );
						$_cus_fixed = sprintf( "%1.2f", $_value['height'] / $_value['width'] );
						if( abs( $_now_fixed - $_custom ) < 0.02 ){
							continue;
						}
					}
					if( $_value['thumbtype'] == $nowconfig[1] ) {
						if( $_cmp1 > 0 ) {
							if( $_cmp1 > $_cmp2 ) {
								if( $_key > $_cmp2 && $_key < $_cmp1 ) {
									$findconfig = $_value;
								}
							}else{
								if( $_key > $_cmp1 ) {
									$findconfig = $_value;
								}
							}
						} else {
							$findconfig = $_value;
						}
					}
				}
				if( $findconfig ) {
					$url = $findconfig['source'];
				}
			}
		}
		//var_dump($findconfig);
		if( $url ) {
			if( $returnurl ) {
				return  $_jgf . $url;
			} else {
				require_once libfile('class/upyun');
				return array( UpYun::X_GMKERL_THUMBNAIL => $url );
			}
		}
	}
	return $returnurl ? '' : array();
}
/**
 * @todo 生成原图保护的安全标识
 * @param Int		$authorid		作者id
 * @param String	$attachment		文件名（不到type目录，为attachment表内存的）
 * @param String	$dir			文件存的type目录
 * @return String
 */
function getSecureStr( $authorid = 0, $attachment = '', $dir = '', $aid = 0 )
{
	global $_G;
	if( $authorid <= 0 || empty( $attachment ) || empty( $dir ) ) {
		if( $aid > 0 ) {
			$info = DB::result_first( "SELECT uid, attachment, dir FROM " . DB::table( 'forum_attachment' ) . " WHERE aid = '{$aid}'" );
			if( $info ) {
				$authorid = $info['aid'];
				$attachment = $info['attachment'];
				$dir = $info['dir'];
			}
		}
	}
	if( $authorid > 0 && $attachment && $dir ) {
		$string = md5( "{$authorid}|{$dir}|{$attachment}" );
		return substr( $string, 3, 3 ) . substr( $string, 15, 3) . substr( $string, 27, 3);
	}
	return '';
}

/**
 * @todo 用于对内容中的图片进行缩略图处理，仅处理站内
 */
function thumb_all_pic($width, $height, $content){
	$content = preg_replace("/<img(.*)src=[\"|'](.[^>]*)[\"|'](.*)>/iseU", "_thumb_image('\\2','\\1', '\\3', $width, $height)", $content);
	return $content;
}
/**
 * @todo 用于对图片的正则处理
 * @author JiangHong
 */
function _thumb_image($imgsrc, $srcbefore, $srcafter, $width, $height){
	global $_G;
	$orgsrc = $imgsrc;
	if(($pos = stripos($imgsrc, "#")) !== false){
		$imgsrc = substr($imgsrc, 0, $pos);
	}
	if(stripos($imgsrc, $_G['config']['web']['attach']) === 0){
		$imgsrc = str_replace($_G['config']['web']['attach'], '', $imgsrc);
		$imgsrc = getimagethumb($width, $height, 1, $imgsrc);
	}elseif(preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)){
		$_t = substr($imgsrc, ($p1 = strpos($imgsrc, '/', 8) + 1), ($p2 = strrpos($imgsrc, '!')) > 0 ? ($p2 - $p1) : (strlen($imgsrc) - $p1));
		$imgsrc = getimagethumb($width, $height, 1, $_t, 0, 99);
	}
	$srcbefore = str_replace("\\", "", $srcbefore);
	$srcafter = str_replace("\\", "", $srcafter);
	return '<img ' . $srcbefore . ' src="' . $imgsrc . '" ' . $srcafter. ' bigpic="' . $orgsrc . '" class="thumbautopic" />';
}
/**
 * 用户返回用户线路推荐
 */
function getMyLine($pos, $uid, $returnarr = false, $random = false, $isastrictday = true)
{
	require_once libfile('class/myredis');
	$myredis = myredis::instance(6382);
	$tuisonguser = $myredis->hashget('plugin_tuisong_user_array', $uid);
	if($tuisonguser){
		$todaystart = strtotime('today');
		$todayend = $todaystart + 24*3600;
		$linfo = $myredis->HGET('plugin_lineinfo_' . $pos . '_time_' . $todayend, $uid);
		//$linfo = memory('get', 'plugin_lineinfo_' . $pos . '_time_' . $todayend);
		require_once DISCUZ_ROOT . './source/plugin/interests/model/linemod.php';
		if(!$linfo){
			require_once DISCUZ_ROOT . './source/plugin/interests/model/historymod.php';
			$daywhere = "";
			if($isastrictday){
				foreach(linemod::$tuisongday as $_day){
					$daywhere .= "OR lm.`" . linemod::_TIME_LAST . "` = " . ($todaystart + $_day * 24 * 3600) . " ";
				}
			}
			if($daywhere){
				$daywhere = "(" . substr($daywhere, 3) . ")";
			}else{
				$daywhere = "`" . linemod::_TIME_LAST . "` >= " . $todayend;
			}
			$sql = "SELECT lm.* FROM " . linemod::TABLE_NAME . " AS lm WHERE lm.`" . linemod::_STATUS . "` = 1 AND lm.`" . linemod::_POS . "` = {$pos} AND lm.`" . linemod::_ID . "` NOT IN (SELECT lh." . historymod::_LINEID . " FROM " . historymod::_TABLE . " AS lh WHERE lh.`" . historymod::_UID . "` = {$uid} AND lh.`" . historymod::_LINEPOS . "` = {$pos} AND lh.`" . historymod::_USERSELECT . "` = 0) AND {$daywhere} ORDER BY `" . linemod::_TIME_START . "` ASC " . getSlaveID();
			$dbobj = DB::object();
			$qq = $dbobj->query($sql);
			while($vaa = $dbobj->fetch_array($qq)){
				$linfo[] = $vaa;
			}
			//memory('set', 'plugin_lineinfo_' . $pos . '_time_' . $todayend, $linfo, 1800);
			$myredis->HSET('plugin_lineinfo_' . $pos . '_time_' . $todayend, $uid, serialize($linfo));
			$myredis->EXPIRE('plugin_lineinfo_' . $pos . '_time_' . $todayend, 24*3600);
		}else{
			$linfo = $linfo ? unserialize($linfo) : $linfo;
		}
		if($linfo){
			if($returnarr){
				return $linfo;
			}
			if($random){
				$key = rand(0, count($linfo) - 1);
				return $linfo[$key];
			}
			return $linfo[0];
		}
		//'plugin_linehistory_readed_uid_' . $uid . '_lid_' . $lid . '_pos_' . $pos
		/*$tmpuid = memory('get', 'plugin_linehistory_readed_uid_' . $uid . '_lid_' . $linfo[linemod::_ID] . '_pos_' . $linfo[linemod::_POS]);
		if(!$tmpuid){
			require_once DISCUZ_ROOT . './source/plugin/interests/model/historymod.php';
			$tmpuid = DB::result_first("SELECT `" . historymod::_ID . "` FROM " . historymod::_TABLE . " WHERE `" . historymod::_UID . "` = {$uid} AND `" . historymod::_LINEID . "` = " . $linfo[linemod::_ID] . " AND `" . historymod::_LINEPOS . "` = {$pos} AND `" . historymod::_USERSELECT . "` = 0 " . getSlaveID());
			if(!$tmpuid){
				$tmpuid = -1;
			}
			memory('set', 'plugin_linehistory_readed_uid_' . $uid . '_lid_' . $linfo[linemod::_ID] . '_pos_' . $linfo[linemod::_POS], $tmpuid, 3600);
		}
		if($tmpuid === -1){
			return $linfo;
		}
		return false;*/
	}
	return false;
}

/*
 * 获取远程数据，如访问API接口
 */
function requestRemoteData($url, $method = 'GET', $postdata = array())
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	if(strtoupper($method) == 'POST') {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	}
	//请求https
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	//设置cURL允许执行的最长秒数
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$data = curl_exec($ch);

	//curl请求失败的处理
	$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if (curl_errno($ch) || $status != 200) {
		$data = '';
	}

	curl_close($ch);
	return $data;
}

/**
 * 签名方法
 * app对应的key在config_global中配置
 * qt:请求发出时的时间戳 单位:秒 必须
 * sign:请求的签名 必须
 * 签名生成规则：按请求URI的参数名(含qt)正序排序后的md5值
 */
function sign_test($appname, $sign)
{
	global $_G;

	// 验证KEY是否存在
	$key_search = array_keys($_G['config']['apikey']);
	if(in_array($appname, $key_search)) {
		$secret = $_G['config']['apikey'][$appname];
	} else {
		return false;
	}

	parse_str($_SERVER['QUERY_STRING'], $url_query);

	$timestamp = time();
	if(abs($timestamp - $url_query['qt']) > 3600) {
		return false;
	}
	unset($url_query['sign']);
	ksort($url_query);
	reset($url_query);

	$sign_check = md5(http_build_query($url_query).$secret);
	return $sign == $sign_check ? true : false;
}

/**
 * 构建接口参数
 * @author gtl 20161017
 * @param array $params
 * @param sting $appsecret
 * @param string $apiurl
 * @return string
 */
function global_build_url($params, $appsecret, $apiurl = 'http://hd.8264.com/api/index.php') {
	ksort($params);
	reset($params);
	$str_q = http_build_query($params);
	$sign = md5($str_q . $appsecret);
	return $apiurl . '?' . $str_q . '&sign=' . $sign;
}

/**
 * @param string $op
 * @param $jwt
 * @param $prams
 * @param string $jwt_type
 * @return array|string
 * @throws BeforeValidException
 * @throws ExpiredException
 * @throws SignatureInvalidException
 */
function _jwt($op = 'encode', $jwt, $prams = array(), $jwt_type = 'unionid')
{
    require_once DISCUZ_ROOT . './source/class/jwt/JWT.php';
    require_once DISCUZ_ROOT . './source/class/jwt/BeforeValidException.php';
    require_once DISCUZ_ROOT . './source/class/jwt/ExpiredException.php';
    require_once DISCUZ_ROOT . './source/class/jwt/SignatureInvalidException.php';
    $privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICXgIBAAKBgQCwI4oWwXlrEGI3S6vea7e/ArWQZMxvSME8DFY5oTntZM0dT/20
ppbX4SbqxRhh9tM4sAikUPCfkMh9g87bIgM4n1QMmx/mxQqB+2j+jM26nLeMW89L
c19T2kOZsoD10hAY0Fv338DFsBMlqYfIj35P7BAP+57i0dHcB1cxRKEFLQIDAQAB
AoGBAK5zdJgXJXeJsY0MsHvJeiJ/v230t5ncmC4uFdRcP7BErvZCPIgImsvTnqTV
ctHMEeVKTDTaSYfwcPIHcwAMTtzGfELR46uNmDHGi3AzBt4/Uij6PDxSAPsfssCX
SLntb042FfnFvaKjNu+/qB4deIZIJUBEYh18ARDhFlgI4ajNAkEA6B4bqQ75bfTX
ZPGLlomrclkzCMI7sePZ/TghfpyZQnarnMp87lAaBxdlydomKQ+TtDW4jDCzw0x2
eq5s5yH+qwJBAMJC+I2MPu6oJv5s2kPP63CuJnoeiP8wTqF6tFoszskzRVqU2FNw
SFTbIQQBvqH9+EdImhMCcU6p8i7zBx/HK4cCQQCiiSqvSAgLIe6OBcHMCNzf9mwR
DwmD+FwVv29c3EVJUBW9deDjc322R4EERliAWiMAhrmSmSvXbrxsDaW+d4R/AkBb
dv7iXpsu8VtSxdvKu/Xl2wlgzEnCpXMQUt7h6mD+mLZZ3OUx/BcCZR5ZbZzdVt/0
aDmrI6ZH3HqcIm9DRhq3AkEAun+nLeLOq4k5Vh2ESLWyJYX6VBKbwMsXNUxQ5RGv
ltYoxVGahGcl60QL42D3ethbVK3/mBSrJE3QcMSTj9UumQ==
-----END RSA PRIVATE KEY-----
EOD;

    $publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCwI4oWwXlrEGI3S6vea7e/ArWQ
ZMxvSME8DFY5oTntZM0dT/20ppbX4SbqxRhh9tM4sAikUPCfkMh9g87bIgM4n1QM
mx/mxQqB+2j+jM26nLeMW89Lc19T2kOZsoD10hAY0Fv338DFsBMlqYfIj35P7BAP
+57i0dHcB1cxRKEFLQIDAQAB
-----END PUBLIC KEY-----
EOD;
    if ($op == 'encode') {
        $token = array(
            "iss" => "8264.com",
            "iat" => time()
        );
        if ($jwt_type == 'unionid') {
            $token['exp'] = $token['iat'] + 300;
            $token['unionid'] = $prams['unionid'];
        } else {
            $token['exp'] = $token['iat'] + 864000;
            $token['uid'] = $prams['uid'];
            $token['username'] = diconv($prams['username'], 'gbk', 'utf-8');
        }
        $jwt = JWT::encode($token, $privateKey, 'RS256');
        return $jwt;
    }

    if ($op == 'decode' && $jwt) {
        $decoded = JWT::decode($jwt, $publicKey, array('RS256'));
        $decoded_array = (array)$decoded;
        return $decoded_array;
    }
}
?>
