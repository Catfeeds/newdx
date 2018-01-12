<?php

/**
 * @author JiangHong
 * @copyright 2013
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
if($_G['gp_exportdatasubmit'] ==1){
    $starttime = strtotime($_G['gp_startdatapicker']);
    $endtime = strtotime($_G['gp_enddatapicker']);
    $file_type = "vnd.ms-excel";  // excel表头固定写法
    $file_ending = "xls"; // excel表的后缀名
    $types = $_G['gp_types'];
    $types = empty($_G['gp_typedl']) ? (empty($types) ? null : implode(',', $types)) : $_G['gp_typedl'];
    if(!empty($types)){
        header("Content-Type: application/$file_type"); 
        header("Content-Disposition: attachment; filename=8264_select_".date('Y_m_d' ,$starttime)."_".date('Y_m_d' ,$endtime).$file_ending); // agentfile到处的表名
        header("Pragma: no-cache"); // 缓存
        header("Expires: 0");
        echo "用户 \t IP(端口) \t 用户行为 \t 时间 \n";
        $query = DB::query("SELECT * FROM `".DB::table('plugin_query_about')."` WHERE `dateline` >= {$starttime} and `dateline` <= {$endtime} and `type` in({$types}) order by dateline asc");
        while($v = DB::fetch($query)){
            $v['username'] = str_replace("\n" ,'' ,$v['username']);
            $v['username'] = str_replace("\t" ,'' ,$v['username']);
            $v['comments'] = str_replace("\n" ,'' ,$v['comments']);
            $v['comments'] = str_replace("\t" ,'' ,$v['comments']);
            echo "<a href=\"{$_G[config][web][home]}{$v[uid]}\">{$v[username]}</a> \t {$v[ip]}:{$v[port]} \t {$v[comments]} \t ".date('Y-m-d H:i:s' ,$v['dateline'])." \n";
        }
        exit;
    }
}
if($_G['gp_exportsdate'] > 0){
    $file_type = "vnd.ms-excel";  // excel表头固定写法
    $file_ending = "xls"; // excel表的后缀名    
    header("Content-Type: application/$file_type");
    $filename = date('Y_m_d' ,$_G['gp_exportsdate']);
    header("Content-Disposition: attachment; filename=8264_{$filename}.$file_ending"); // agentfile到处的表名
    header("Pragma: no-cache"); // 缓存
    header("Expires: 0");
    echo "用户 \t IP(端口) \t 用户行为 \t 时间 \n";
    $query = DB::query("SELECT * FROM `".DB::table('plugin_query_about')."` WHERE `dateline` >= {$_G[gp_exportsdate]} and `dateline` <= ".($_G['gp_exportsdate']+3600*24)." order by dateline asc");
    $record = false;
    while($v = DB::fetch($query)){
        $v['username'] = str_replace("\n" ,'' ,$v['username']);
        $v['username'] = str_replace("\t" ,'' ,$v['username']);
        $v['comments'] = str_replace("\n" ,'' ,$v['comments']);
        $v['comments'] = str_replace("\t" ,'' ,$v['comments']);
        $record = true;
        echo "<a href=\"{$_G[config][web][home]}{$v[uid]}\">{$v[username]}</a> \t {$v[ip]}:{$v[port]} \t {$v[comments]} \t ".date('Y-m-d H:i:s' ,$v['dateline'])." \n";
    }
    if(!$record) echo "当前日期没有任何信息";
    exit;    
}
include template('common/header');
$can = false;
if($_COOKIE['8264queryDatapwdegsag5'] != '8264!@#123'){
    if($_G['gp_pass']!='8264!@#123'){
    	echo '密码错误';
        setcookie('8264queryDatapwdegsag5' ,null ,1);
    }else{
        setcookie('8264queryDatapwdegsag5' ,'8264!@#123' ,0);
        $can = true;
    }
}else{
    $can = true;
}
if($can){
    $types = $_G['gp_types'];
    $types = empty($_G['gp_typedl']) ? (empty($types) ? null : implode(',', $types)) : $_G['gp_typedl'];
    $dateline = $_G['gp_selecttime'];
    $page = max($_G['gp_page'] ,1);
    $perpage = 20;
    $nowpage = $perpage * ($page - 1);
    if($dateline >= 0 && !empty($types)){
        $count = DB::result_first("SELECT COUNT(*) FROM `".DB::table('plugin_query_about')."` WHERE `dateline` >= {$dateline} and `type` in({$types})");
        $multipage = multi($count ,$perpage ,$page ,"plugin.php?id=api:queryData&typedl={$types}&selecttime={$dateline}");
        $sql = "SELECT * FROM `".DB::table('plugin_query_about')."` WHERE `dateline` >= {$dateline} and `type` in({$types}) limit {$nowpage},{$perpage}";
        //echo $sql;
        $q = DB::query($sql);
        while($v = DB::fetch($q)){
            $result[] = $v;
        }
    }
    $multipage = isset($multipage) ? $multipage : '';
}
?>
<fieldset>
<form action="plugin.php?id=api:queryData" method="post" autocomplete="true">
<legend>查询选项</legend>
<?php if( ! $can){ ?>
<p>查询密码：<input type="password" name="pass" /></p>
<p><input type="submit" name="queryData" value="验证" /></p>
</form>
<?php }else{ ?>
<p>
<select name="selecttime">
    <option value="<?php echo strtotime('-1hour'); ?>">一小时内</option>
    <option value="<?php echo strtotime('-3hour'); ?>">三小时内</option>
    <option value="<?php echo strtotime('-12hour'); ?>">十二小时内</option>
    <option value="<?php echo strtotime('today'); ?>">今天</option>
    <option value="<?php echo strtotime('-3days'); ?>">三天内</option>
    <option value="<?php echo strtotime('-7days'); ?>">一周内</option>
    <option value="<?php echo strtotime('-1month'); ?>">一月内</option>
    <option value="0" <?php if($dateline==0) echo 'selected="true"' ?> >所有</option>
</select>
<input type="submit" name="queryData" value="查询"/>
</p>
<p>快捷选项：<span onclick="if(alllogin.checked==true){alllogin.checked=false}else{alllogin.checked=true}allchick('login' ,alllogin)"><input checked="true" disabled="true" id="alllogin" type="checkbox" onchange=""/>所有登陆</span><span onclick="if(allthread.checked==true){allthread.checked=false}else{allthread.checked=true}allchick('thread' ,allthread)"><input id="allthread" disabled="true"checked="true"  type="checkbox" />所有发帖</span></p>
<p id="optionlist">
<input checked="true" type="checkbox" value="1" name="types[]" class="login" />普通登陆
<input checked="true" type="checkbox" value="2" name="types[]" class="login" />QQ登陆
<input checked="true" type="checkbox" value="3" name="types[]" class="login" />微博登陆
<input checked="true" type="checkbox" value="10" name="types[]" class="thread" />普通发帖
<input checked="true" type="checkbox" value="11" name="types[]" class="thread" />手机发帖
<input checked="true" type="checkbox" value="12" name="types[]" class="thread" />分楼发帖
</p>
</form>
</fieldset>
<fieldset>
<legend>查询结果</legend>
<table width="100%">
<tr><td colspan="4">共有<?php echo $count; ?>条信息</td></tr>
<tr><td>用户</td><td>访问IP</td><td>用户行为</td><td>时间</td></tr>
<?php if(empty($result)){ ?>
<tr><td colspan="4">当前没有搜索结果，请换个条件查询！</td></tr>
<?php }else{
foreach($result as $line){    
?>
<tr><td width="15%"><a target="_blank" href="<?php echo $_G['config']['web']['home'].$line['uid']; ?>"><?php echo $line['username']; ?></a></td><td width="20%"><?php echo $line['ip'].':'.$line['port']; ?></td><td width="50%"><?php echo $line['comments']; ?></td><td width="15%"><?php echo date('Y-m-d H:i:s' ,$line['dateline']); ?></td></tr>
<?php } ?>
<tr><td colspan="4"><form id="exportdata" action="plugin.php?id=api:queryData" autocomplete="true" method="post"><b>开始时间:</b><input id="startdatapicker" name="startdatapicker" />  ---  <b>结束时间:</b><input id="enddatapicker" name="enddatapicker" />
<input checked="true" type="checkbox" value="1" name="types[]" class="login" />普通登陆
<input checked="true" type="checkbox" value="2" name="types[]" class="login" />QQ登陆
<input checked="true" type="checkbox" value="3" name="types[]" class="login" />微博登陆
<input checked="true" type="checkbox" value="10" name="types[]" class="thread" />普通发帖
<input checked="true" type="checkbox" value="11" name="types[]" class="thread" />手机发帖
<input checked="true" type="checkbox" value="12" name="types[]" class="thread" />分楼发帖
<input type="submit" value="导出" name="exportsj"/><input type="hidden" value="1" name="exportdatasubmit"/></form></td></tr>
<tr><td colspan="4"><?php echo $multipage; ?></td></tr>
<?php } ?>
</table>
</fieldset>
<style>
p input{margin:5px;}
p span{cursor:pointer;}
fieldset{padding:10px;}
fieldset table td{padding: 5px;margin: 5px;}
fieldset table tr{border:2px solid #ccc;}
fieldset a{color:blue;}
#exportdata b,#exportdata input{margin:0 5px;}
#exportdays li{float:left;margin-left: 10px;} 
</style>
<script>
function allchick(type ,my){
    var obj = document.getElementById('optionlist').getElementsByTagName('input');
    var status = my.checked;
    for(var i=0;i<obj.length;i++){
        if(obj.item(i).className==type){
            obj.item(i).checked = status;
        }
    }
}
</script>
<link rel="stylesheet" type="text/css" href="static/css/jquery-ui/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" type="text/css" href="static/css/jquery-ui/jquery-ui-timepicker-addon.css" />
<script src="static/js/jquery-1.6.1.min.js"></script>
<script src="static/js/jquery-ui-1.8.17.custom.min.js"></script>
<script src="static/js/jquery-ui-timepicker-zh-CN.js"></script>
<script src="static/js/jquery-ui-timepicker-addon.js"></script>
<script>
$(function() {

   $("#startdatapicker,#enddatapicker").datetimepicker({

        showSecond: false,
        timeFormat: 'hh:mm:ss',
        hour:0,
        minute:0,
        second:0
    });
 });
</script>
<?php
}
$i = 1;
echo '<ul id="exportdays"><li><a href="plugin.php?id=api:queryData&exportsdate='.strtotime(date('Y-m-d' ,strtotime('today'))).'">'.date('Y-m-d' ,strtotime('today')).'</a></li>';
while($i <= 30){
    $datetime = strtotime(date('Y-m-d' ,strtotime('-'.$i.' days')));
    echo '<li><a href="plugin.php?id=api:queryData&exportsdate='.$datetime.'">'.date('Y-m-d' ,$datetime).'</a></li>';
    $i++;
}
echo '</ul>';
include template('common/footer');