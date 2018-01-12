<?php
/**
 * @author JiangHong
 * @copyright 2014
 */

if ( ! defined( 'IN_DISCUZ' ) )
{
	exit( 'Access Denied' );
}
@set_time_limit( 1000 );
@ignore_user_abort( true );
date_default_timezone_set( "Asia/Shanghai" );
$time = time();
$hour = intval( date( "Hm", $time ) );
//程序在2点30 - 4点30运行
// require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
// $logs = new logs("views_cron");
// $logs->log_str("TIMESTAMP:" . $time . "|hour:" . $hour . "|cron:todatabase");
$time_con = $hour >= 230 && $hour <= 430;
$user_con = $_G['uid'] == 1;
$runlimit = $time_con ? 2000 : 1;
if ( $time_con || $user_con )
{
	require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
	$logs = new logs( "views_cron" );
	$logs->log_str( "到达时间执行计划任务。队列===》数据库" );
	require_once libfile( 'class/redisqueue' );
	try
	{
		$redisqueue = new redisqueue( 6382 );
		$redisqueue->doQueue( 'viewstodatabase', $runlimit );
	}
	catch ( exception $e )
	{
		require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
		$logs = new logs( 'views_cron' );
		$logs->log_str( "error:" . $e->getMessage() );
	}

}
