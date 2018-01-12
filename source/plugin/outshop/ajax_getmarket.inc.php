<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


$reg = $_GET['reg'];
$parentId = $_GET['parentId'];
$sreg = $_GET['sreg'];

//用于验证店铺名称是否已经存在
$sub = $_GET['sub'];

if($reg){
	$sql = "select DISTINCT(marketid) from ".DB::table('dianping_shop_info')." where regionid = '$reg' and marketid!=0 and ispublish =1 limit 5";
	$arr=array();
	$query = DB::query($sql);
	while ($row = DB::fetch($query)) {
		$market = DB::fetch_first("SELECT * FROM ".DB::table('plugin_shop_market')." WHERE id = $row[marketid]");
		$row['id']  = $market['id'];
		$row['marketid']  = $market['market'];
		$arr[] = array('sid'=>mb_convert_encoding($row['id'],'UTF-8', 'GBK'),'marketid'=>mb_convert_encoding($row['marketid'],'UTF-8', 'GBK'));
	}
	echo json_encode($arr);exit;
}
if($parentId){
	$sql = "select * from ".DB::table('dianping_shop_region')." where upid=$parentId";
	$arr=array();
	$query = DB::query($sql);
	while ($row = DB::fetch($query)) {
		$arr[] = array('catid'=>mb_convert_encoding($row['catid'],'UTF-8', 'GBK'),'name'=>mb_convert_encoding($row['name'],'UTF-8', 'GBK'));
	}
	echo json_encode($arr);exit;
}
if($sreg){
	$sql = "select * from ".DB::table('dianping_shop_region')." where catid=$sreg limit 1";
	$dq = DB::fetch_first($sql);
	echo json_encode($dq['areacode']);exit;
}
//验证店铺名称是否已经存在
if($sub){
	$sub =mb_convert_encoding($sub,'GBK', 'UTF-8');
	$sub =trim($sub);
	$sql = "select * from ".DB::table('dianping_shop_info')." where subject='$sub'";
	$dm = DB::fetch_first($sql);
	if($dm){
		echo "repeat";exit;
	}else{
		echo "norepeat";exit;
	}
}

