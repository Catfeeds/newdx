<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 点评系统后台管理 --- 系统管理
 */

if(! defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}
include 'dianping.fun.php';
$dianpingmodules = m('dianpingmodules');
$module = $dianpingmodules->findAll();

if($_GET['op']=='new'){
include 'newsys.php';exit;
}
if($_GET['op']=='edit'){
include 'editsys.php';exit;
}
$url = $_SERVER['REQUEST_URI'];
foreach($module as $value){
	$value['asktime'] = date('Y-m-d H:i', $value['asktime']);
	$value['status'] = $value['status']==1 ? '<span style="color:green">已启用</span>':'<span style="color:red">已关闭</span>';
	$modules[]= $value;
}
include template('dianping:manager');
?>
