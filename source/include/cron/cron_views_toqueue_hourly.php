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
//������1��30 - 3��30����
// require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
// $logs = new logs("views_cron");
// $logs->log_str("TIMESTAMP:" . $time . "|hour:" . $hour . "|cron:toqueue");
if ( $hour >= 130 && $hour <= 330 )
{
	require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
	$logs = new logs( 'views_cron' );
	require_once libfile( 'function/misc' );
	updateviews_redis( 'forum_thread', 'tid', 'views', 'viewthread', true );
	updateviews_redis( 'forum_attachment', 'aid', 'downloads', 'attachment', true );
	$logs->log_str( "time:" . date( 'Y-m-d H:i:s', TIMESTAMP ) . '|���мƻ����������' );
}
