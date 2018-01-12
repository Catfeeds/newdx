<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

/*
* 获得添加价格的人员列表
*/
$_G['tid']=$_GET['tid'];
$num=DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_price')." AS p
					    LEFT JOIN ".DB::table('common_member')." AS m ON p.uid = m.uid
        			    WHERE p.tid = {$_G['tid']} 				    
					    ORDER BY p.id");

function getaddPriceUsersList() {
   global $_G;  
   $users = array();  
   $query = DB::query("SELECT p.*, m.username FROM ".DB::table('plugin_produce_price')." AS p
					   LEFT JOIN ".DB::table('common_member')." AS m
					   ON p.uid = m.uid
					   WHERE p.tid = {$_G['tid']} and p.isdelete=0
					   ORDER BY p.id DESC");
    while ($value = DB::fetch($query)) {  
	   $value['avatar'] = avatar($value['uid'], 'small');
	   $value['price']=(float)$value['price'];
	   if($value['url']==""){
		$value['url']=$_G['config']['web']['portal']."#";
	   }	   
	   $users[] = $value;
   }   
   return $users;   
}

$forbidprice_power = 0;
$user_attentions=array();
if ($_G['uid']) {
	$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_price')." WHERE uid = {$_G['uid']} AND tid = {$_G['tid']}");
	while ($value = DB::fetch($query)) {
		$user_attentions[] = $value;
	}
	//判断用户是否有权限使用添加价格功能
	$forbidprice = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_publishers')." WHERE uid = {$_G['uid']} and forbidprice = 1");
	if($forbidprice){
		$forbidprice_power = 1;			  
	}
}



$count=count($user_attentions);
$userlist = getaddPriceUsersList();
	
include template('produce:price');	


