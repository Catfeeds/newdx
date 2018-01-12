<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
include template( 'common/header' );
$enable = getcookie( 'albumerror_kill_' . $_G['gp_authorid'] );
if ( $enable == 1 )
{
	echo '<b style="color:red;">太频繁请稍后再试</b>';
}
elseif ( $_G['uid'] && $_G['inajax'] && ( $_G['uid'] == $_G['gp_authorid'] || $_G['adminid'] > 0 ) )
{
	require_once libfile( 'function/spacecp' );
	require_once libfile( 'function/home' );
	$q = DB::query( "SELECT albumid FROM " . DB::table( 'home_album' ) . " WHERE uid = {$_G[gp_authorid]}" );
	while ( $v = DB::fetch( $q ) )
	{
		album_update_pic( $v['albumid'] );
	}
	dsetcookie( 'albumerror_kill_' . $_G['gp_authorid'], 1, 300 );
	//echo '<script>window.location.href="home.php?mod=space&uid=' . $_G['uid'] . '&do=album&view=me"</script>';
	echo "<b style=\"color:green;\" onclick=\"window.location.href='home.php?mod=space&uid={$_G['gp_authorid']}&do=album&view=me'\">已更新，请手动刷新或点击此处刷新页面查看</b>";
}
else
{
	echo '请刷新页面';
}
include template( 'common/footer' );
?>