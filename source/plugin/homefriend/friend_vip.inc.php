<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$info = array();
$pagesize = 10;
if(isset($_GET['delid'])){
    DB::query("DELETE from ".DB::TABLE('plugin_friendoption')." WHERE uid=".$_GET['delid']);
    $returntext = "删除完成";
}
$default_group = isset($_POST['group_add']) ? $_POST['group_add'] : 1;
if(isset($_POST['type_group']) && isset($_POST['group_uid'])){
    DB::query("UPDATE ".DB::TABLE('plugin_friendoption')." SET gid=".$_POST['type_group']." , dateline=".time()." WHERE uid=".$_POST['group_uid']);
    $returntext = "分组修改完成";
}
if(isset($_POST['other']) && isset($_POST['other_uid'])){
    DB::query("UPDATE ".DB::TABLE('plugin_friendoption')." SET other='".$_POST['other']."' , dateline=".time()." WHERE uid=".$_POST['other_uid']);
    $returntext = "商业用户名称修改完成";
}
if(isset($_POST['add_type']) && isset($_POST['add_value']) && isset($_POST['add_setting']) && isset($_POST['group_add'])){
    $where_member = $_POST['add_type']=='uid' ? " where uid = ".$_POST['add_value'] : " where username= '".$_POST['add_value']."'";
    //echo "select uid,username from ucenter.uc_members ".$where_member;
    $res = mysql_query("select uid,username from ucenter.uc_members ".$where_member);
    $result = mysql_fetch_assoc($res);
    if ($result['uid'] ==""){
        echo "<script>alert('当前添加的账户不存在，请核查')</script>";
    }
    else{
        $resu = DB::result_first("SELECT count(*) FROM ".DB::TABLE('plugin_friendoption')." ".$where_member);
        if($resu>0){
            echo "<script>alert('当前添加的账户已经添加过，请通过上面的查找来查询')</script>";
        }else{
            DB::query("insert into ".DB::TABLE('plugin_friendoption')." values(".$result['uid'].",'".$result['username']."',".$_POST['add_setting'].",".time().",".$_POST['group_add'].",'".$_POST['add_other']."')");
            $returntext = "添加完成";
        }
    }
}
if(isset($_GET['updateid']) && isset($_GET['updatestate'])){
    DB::query("UPDATE ".DB::TABLE('plugin_friendoption')." SET friendsetting = ".$_GET['updatestate']." , dateline= ".time()." WHERE uid=".$_GET['updateid']);
    $returntext = "状态修改完成";
}
$nowpage = isset($_GET['nowpage']) ? $_GET['nowpage'] : 1;
$order_type = isset($_GET['order_type']) ? $_GET['order_type'] : "dateline";
$order_sort = (isset($_GET['order_sort']) && $_GET['order_sort']==1) ? " ASC" : " DESC";
$search_type = (isset($_POST['search_type']) && $_POST['search_word']!="请输入查询的内容") ? " where ".$_POST['search_type']."=" : "where 1= ";
$search_word = (isset($_POST['search_word']) && $_POST['search_word']!="请输入查询的内容") ? (!is_numeric($_POST['search_word']) ? "'".$_POST['search_word']."'" : $_POST['search_word']) : " 1";
//echo "SELECT * FROM ".DB::TABLE('plugin_friendoption')." ".$search_type.$search_word." order by ".$order_type.$order_sort." limit ".(($nowpage-1)*$pagesize).",".$pagesize;
$maxdata = DB::result_first("SELECT count(*) FROM ".DB::TABLE('plugin_friendoption')." ".$search_type.$search_word);
$query = DB::query("SELECT * FROM ".DB::TABLE('plugin_friendoption')." ".$search_type.$search_word." order by ".$order_type.$order_sort." limit ".(($nowpage-1)*$pagesize).",".$pagesize);
while($value = DB::fetch($query)){
    $info[] = $value;
}
$maxpage =  ($maxdata - $maxdata%$pagesize)/$pagesize+($maxdata%$pagesize>0 ? 1 : 0);
$u_url = ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=homefriend&pmod=friend_vip&order_type=".$order_type."&order_sort=".asc_desc_to_num($order_sort);
function totext($state){
    return $state==1 ? "<span style='color:green;'>启用中</span>" : "<span style='color:red;'>关闭中</span>";
}
function tosort($type,$value=0){
    $url_this = ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=homefriend&pmod=friend_vip";
    return $url_this."&order_type=".$type."&order_sort=".$value;
}
function sort_text($state){
    return $state==1 ? "<b style='color:green'>∧</b>" : "<b style='color:red'>∨</b>";
}
function changestate($state){
    return $state==1 ? 0:1;
}
function asc_desc_to_num($state){
    return $state==" ASC" ? 1 : 0 ;
}
function checkstate($time){
	$t = time() - $time;
	if ($t <= 15) {
		return true;
	}
	return false;
}
function getgroupname($gid){
    return ($gid==0 || $gid>=8 ) ? lang('friend', 'friend_group_default') : lang('friend', 'friend_group_'.$gid);
}
require dirname(__FILE__)."/template/friendvip.html.php";
?>
