<?php
/**
 * @author JiangHong
 * @copyright 2014
 */

$nowid = max( intval( $_G['gp_nowid'] ), 0 );
$limit = 1000;
$nextid = $nowid + $limit;
$nexturl = "{$_G[config][web][forum]}plugin.php?id=api:donoti&nowid={$nextid}";
$now = time();
if($_G['uid'] !== 1){
	exit('Access Denied');
}
$time_30day = $now - 30 * 24 * 3600;
$time_2day = $now - 2 * 24 * 3600;
$timeout = 7;
DB::query("DELETE FROM " . DB::table( 'home_notification' ) . " WHERE id > {$nowid} AND id <= {$nextid} AND dateline <= {$time_2day} AND new = 0");
$num = DB::affected_rows();
DB::query("DELETE FROM " . DB::table( 'home_notification' ) . " WHERE id > {$nowid} AND id <= {$nextid} AND dateline <= {$time_30day} AND new = 1");
$num += DB::affected_rows();
echo "��ɾ��{$num}������";
if($num < $limit * 0.6){
	$timeout = 2;
}
/*$time = time() - 30 * 24 * 3600;
$timeout = 7;
$sql = "REPLACE INTO " . DB::table('plugin_notification_history') . " SELECT * FROM " . DB::table( 'home_notification' ) . " WHERE id > {$nowid} AND id <= {$nextid} AND dateline <= {$time}";
DB::query($sql);
$num = DB::affected_rows();
echo "<h3>��Ӱ��{$num}��</h3>";
if($num > 0){
	DB::query("DELETE FROM " . DB::table( 'home_notification' ) . " WHERE id > {$nowid} AND id <= {$nextid} AND dateline <= {$time}");
	$num_d = DB::affected_rows();
	echo "<h3>��ɾ��{$num_d}��</h3>";
}*/
echo "{$nowid} ~ {$nextid} ��ɾ����ɣ�<b id='timeout'>{$timeout}</b>�����<a href='{$nexturl}'>��һ����</a>��<a href='javascript:;' id='stopbtn' onclick='stoprun()'>�����ͣ</a>";

echo <<< EOF
<script>
var stop = false;
var timenum = {$timeout};
function stoprun(){
	if(stop){
		stop = false;
		document.getElementById('stopbtn').innerHTML = "�����ͣ";
	}else{
		stop = true;
		document.getElementById('stopbtn').innerHTML = "�������";
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
