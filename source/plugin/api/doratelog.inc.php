<?php
/**
 * @author JiangHong
 * @copyright 2014
 */

$nowid = max( intval( $_G['gp_nowid'] ), 0 );
$limit = 1000;
$nextid = $nowid + $limit;
$nexturl = "{$_G[config][web][forum]}plugin.php?id=api:doratelog&nowid={$nextid}";
$now = time();
$timeout = 10;
$q = DB::query("SELECT pid FROM " . DB::table("forum_ratelog") . " WHERE fid < 10 AND tid < 10 AND fid >= 0 AND tid >= 0 limit {$limit}");
$num = 0;
while($v = DB::fetch($q)){
	$num++;
	$_find = DB::fetch_first("SELECT tid,fid FROM " . DB::table("forum_post") . " WHERE pid = {$v[pid]}");
	if(! $_find){
		DB::update("forum_ratelog", array('fid' => -1, 'tid' => -1), "pid = {$v[pid]}");
	}else{
		$_find['fid'] = $_find['fid'] > 0 ? $_find['fid'] : 0;
		if($_find['tid'] > 0 || $_find['fid'] > 0){
			DB::update("forum_ratelog", array('fid' => $_find['fid'], 'tid' => $_find['tid']), "pid = {$v[pid]}");
		}
	}
}
if($num == 0){
	echo "全部完成";
}else{
echo "完成{$num}个";
echo "，<b id='timeout'>{$timeout}</b>后进入<a href='{$nexturl}'>下一区间</a>。<a href='javascript:;' id='stopbtn' onclick='stoprun()'>点击暂停</a>";

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