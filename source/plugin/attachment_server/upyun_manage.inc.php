<?php

/**
 * @author JiangHong
 * @copyright 2014
 * @todo 用于又拍云的文件管理
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once libfile( "class/upyun" );
$cdnname = $_G['gp_cdnname'];
$config = $_G['config']['cdn'][$cdnname];
if ( ! $config )
{
	$message = "请选择一个空间名";
}
else
{
	$upyun = new UpYun( $config['name'], $config['user'], $config['pwd'] );
	if ( empty( $_G['gp_path'] ) )
	{
		$path = '/';
	}
	else
	{
		$path = $_G['gp_path'] . '/';
		$path = rtrim( $path, '/' );
		$path .= '/';
		$upfolder = substr( $path, 0, strripos( substr( $path, 0, -1 ), '/' ) + 1 );
	}
	try
	{
		$list = $upyun->getList( $path );
	}
	catch ( exception $e )
	{
		echo $e->getCode() . "<br />" . $e->getMessage();
	}
	//var_dump($list);
	foreach ( $list as $value )
	{
		if ( $value['type'] == 'folder' )
		{
			$folder[] = $value;
		}
		else
		{
			$file[] = $value;
		}
	}
	$fd_length = count( $folder );
	$fl_length = count( $file );
}
function timeshow( $time )
{
	//return date( "Y-m-d H:i:s", $time );
	return dgmdate($time, 'dt');
}
function sizecal( $number )
{
	$arr = array( 'B', 'KB', 'MB', 'GB', 'TB' );
	return round( $number / pow( 1024, ($i = floor(log($number, 1024)))) ,2) . ' ' . $arr[$i];
}
/*require_once DISCUZ_ROOT . './source/plugin/attachment_server/attachment_server.class.php';
* $attachserver = new attachserver;
* var_dump($attachserver->get_thumb_args(null, 'home'));
* var_dump($attachserver->get_watermark_args('album'));
* var_dump( getUpYun(true, 400, 400, 4, 0, 1, false, 'test') );*/
include template( 'attachment_server:upyunmain' );
