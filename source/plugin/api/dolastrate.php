<?php
/**
 * @author JiangHong
 * @copyright 2014
 */

$limit = 500;
if ( $_G['groupid'] != 1 )
{
	exit( "û��Ȩ��" );
}
$tablename_arr = array(
	'skiing' => "��ѩ��",
	'brand' => "Ʒ��",
	'equipment' => "װ��",
	'line' => "��·",
	'mountain' => "ɽ��",
	'shop' => "����" );
$tidname_arr = array(
	'skiing' => "tid",
	'brand' => "tid",
	'equipment' => "tid",
	'line' => "tid",
	'mountain' => "tid",
	'shop' => "tid" );
$pkyname_arr = array(
	'skiing' => "kid",
	'brand' => "bid",
	'equipment' => "kid",
	'line' => "id",
	'mountain' => "id",
	'shop' => "sid" );
echo "ѡ�����ģ�飺<br />";
foreach ( $tablename_arr as $vss => $sss )
{
	echo "<a href='plugin.php?id=api:dolastrate&modname={$vss}'>{$sss}" . ($_G['gp_modname'] == $vss ? "������" : "") . "</a>&nbsp;&nbsp;&nbsp;&nbsp;";
}
echo "<br /><hr /><br />";
if ( in_array( $_G['gp_modname'], $tablename_arr ) )
{
	$nexturl = "http://bbs.8264.com/plugin.php?id=api:dolastrate&modname={$_G[gp_modname]}";
	$tablename = "plugin_{$_G['gp_modname']}_info";
	$prmkey = $pkyname_arr[$_G['gp_modname']];
	$tidname = $tidname_arr[$_G['gp_modname']];
	$q = DB::query( "SELECT {$prmkey} as id, {$tidname} as tid FROM " . DB::table( $tablename ) . " WHERE lastrate = 0 limit $limit" );
	$_t_i = 0;
	while ( $v = DB::fetch( $q ) )
	{
		$last_time = DB::result_first( "SELECT MAX(dateline) FROM " . DB::table( "forum_ratelog" ) . " WHERE tid = {$v[tid]}" );
		DB::update( $tablename, array( 'lastrate' => $last_time ), "{$prmkey} = {$v[id]}" );
		$_t_i++;
	}
	if ( $_t_i == 0 )
	{
		exit( '�������' );
	}
	echo "����{$_t_i}����䣬<b id='timeout'>{$timeout}</b>�����<a href='{$nexturl}'>��һ����</a>��<a href='javascript:;' id='stopbtn' onclick='stoprun()'>�����ͣ</a>";
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
}
