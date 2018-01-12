<?php
/**
 * @author zhangwenchu
 * @copyright 2017
 * @户外学校
 */

set_time_limit(0);
define('SITE_ROOT', substr(dirname(__FILE__), 0, -19));

require SITE_ROOT . 'source/class/class_core.php';
require SITE_ROOT . 'source/function/function_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

require_once libfile('class/myredis');
$myredis = myredis::instance();

//户外学校参加人数每日增加
$query = DB::query("select * from ".DB::table("exam_category")." where is_show = 1 ");
while ($row = DB::fetch($query)) {
	$result[$row['id']] = $row['join_nums'];
}

foreach($result as $k=>$v){
	$add = rand(100,200);
	DB::update('exam_category', array('join_nums'=>$v+$add), "id=$k");
	$myredis->SET("xuexiao_catid_".$k."_nums", $v+$add);
}