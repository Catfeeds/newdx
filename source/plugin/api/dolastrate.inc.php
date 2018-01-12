<?php
/**
 * @author JiangHong
 * @copyright 2014
 */

$limit = 500;
$nowpage = intval( $_G['gp_nowid'] );
$nowpage = max( $nowpage, 1 );
$startid = ( $nowpage - 1 ) * $limit;
$nextid = $nowpage + 1;
$timeout = 10;
$nexturl = "http://bbs.8264.com/plugin.php?id=api:dolastrate&modname={$_G[gp_modname]}&nowid={$nextid}";
if ( $_G['groupid'] != 1 )
{
	exit( "没有权限" );
}
$tablename_arr = array(
	'skiing' => "滑雪场",
	'brand' => "品牌",
	'equipment' => "装备",
	'line' => "线路",
	'mountain' => "山峰",
	'shop' => "店铺" );
$tidname_arr = array(
	'skiing' => "tid",
	'brand' => "tid",
	'equipment' => "tid",
	'line' => "tid",
	'mountain' => "tid",
	'shop' => "tid" );
$pkyname_arr = array(
	'skiing' => "id",
	'brand' => "id",
	'equipment' => "id",
	'line' => "id",
	'mountain' => "id",
	'shop' => "id" );
$numbs_arr = array(
	'skiing' => "cnum",
	'brand' => "cnum",
	'equipment' => "cnum",
	'line' => "cnum",
	'mountain' => "cnum",
	'shop' => "cnum",
	);
echo "选择操作模块：<br />";
foreach ( $tablename_arr as $vss => $sss )
{
	echo "<a href='plugin.php?id=api:dolastrate&modname={$vss}'>{$sss}" . ( $_G['gp_modname'] == $vss ? "运行中" : "" ) . "</a>&nbsp;&nbsp;&nbsp;&nbsp;";
}
echo "<br /><hr /><br />";
if ( array_key_exists( $_G['gp_modname'], $tablename_arr ) )
{
	$_t_i = 0;
	$tablename = "plugin_{$_G['gp_modname']}_info";
	$prmkey = $pkyname_arr[$_G['gp_modname']];
	$tidname = $tidname_arr[$_G['gp_modname']];
	$numname = $numbs_arr[$_G['gp_modname']];
	/**此段程序用于导入加币的最新时间**/
	$sql = "SELECT {$prmkey} as id, {$tidname} as tid FROM " . DB::table( $tablename ) . " limit {$startid}, $limit";
	$q = DB::query( $sql );
	//echo "<p>{$sql}</p>";
	/*此段成功用于导入上次记录的评分*/
	//	$q = DB::query("SELECT {$prmkey} as id, {$tidname} as tid FROM " . DB::table($tablename) . " WHERE lastscore = 0 AND {$numname} > 0 LIMIT {$startid}, $limit");
	while ( $v = DB::fetch( $q ) )
	{
		/**此段程序用于导入加币的最新时间**/
		/*$last_pid = DB::result_first( "SELECT MAX(pid) FROM " . DB::table( "forum_ratelog" ) . " WHERE tid = {$v[tid]}" );
		if($last_pid > 0){
			$last_time = DB::result_first( "SELECT dateline FROM " . DB::table( "forum_post" ) . " WHERE pid = {$last_pid}" );
		}*/
		$last_time = DB::result_first("SELECT MAX(p.dateline) FROM " . DB::table('forum_ratelog') . " r INNER JOIN " . DB::table('forum_post') . " p ON p.pid = r.pid WHERE p.tid = {$v[tid]}");
		$last_time = $last_time > 0 ? $last_time : -1;
		//echo "<p>tid:{$v[tid]}|time:{$last_time}|table:$tablename|{$prmkey} = {$v[id]}</p>";
		DB::update( $tablename, array( 'lastrate' => $last_time ), "{$prmkey} = {$v[id]}" );
		/*此段成功用于导入上次记录的评分*/
		$lastprice = DB::result_first("SELECT lastprice FROM " . DB::table('dianping_star_statistics') . " WHERE type = 'forum' AND typeid = {$v[tid]}");
		$lastprice = $lastprice > 0 ? $lastprice : -1;
		DB::update( $tablename, array( 'lastscore' => $lastprice ), "{$prmkey} = {$v[id]}" );
		$_t_i++;
	}
	if ( $_t_i == 0 )
	{
		exit( '处理完成' );
	}
	echo "处理{$_t_i}条语句，<b id='timeout'>{$timeout}</b>后进入<a href='{$nexturl}'>下一区间</a>。<a href='javascript:;' id='stopbtn' onclick='stoprun()'>点击暂停</a>";
	echo <<< EOF
<script>
var stop = false;
var timenum = {$timeout};
function stoprun(){
	if(stop){
		stop = false;
		document.getElementById('stopbtn').innerHTML = "点击暂停";
	}else{
		stop = true;
		document.getElementById('stopbtn').innerHTML = "点击运行";
	}
}
function timeoutshow(){
	if(stop == false){
		timenum--;
	}
	if(timenum == 0){
		window.location.href = "{$nexturl}";
	}else{
		document.getElementById('timeout').innerHTML = timenum;
		if(timenum > 0){
			setTimeout(timeoutshow, 1000);
		}
	}
}
setTimeout(timeoutshow, 1000);
</script>
EOF;
}
