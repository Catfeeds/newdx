<?php

/**
 * @author JiangHong
 * @copyright 2013
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}
if(!$_G['gp_inajax']){
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=blacklist');
    echo '<br /><p>搜索IP：&nbsp;&nbsp;<input type="text" name="searchip" value="'.$_G['gp_searchip'].'"/>&nbsp;&nbsp;<input type="submit" name="submit" value="查询"/>&nbsp;&nbsp;<b class="green">提示：查询可以查询ip段，具体方式为用*代替,例如：131.*.14.* 、17.*.*.* 、 192.168.1.*</b></p>';
    showformfooter();
    echo '<br /><p>自动刷新<input type="checkbox" checked id="autoref"/>&nbsp;过滤到期IP<input type="checkbox" checked id="gldqip" onclick="showhidden(\'tr\',\'overtime\');"/></p>';
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=blacklist');
    echo '<div id="BLACKLIST_DIV">';
}else{
    include template('common/header_ajax');
}
if($_G['gp_inajax'] && $_G['groupid']==1){
    include_once libfile('function/admincp');
}
loadcache('plugin');
$pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
$ajaxpertime = $_G['cache']['plugin']['ipbanspider']['ajax_per'] > 1 ? $_G['cache']['plugin']['ipbanspider']['ajax_per'] : 5;
require_once libfile('class/myredis');
$redis = & myredis::instance(6379);
//change db
$redis->SELECTDB(1);
$page = $_G['gp_page'] >= 1 ? $_G['gp_page'] : 1;
$perpage = $_G['cache']['plugin']['ipbanspider']['page_per'] ? $_G['cache']['plugin']['ipbanspider']['page_per'] : 15;
$nowpage = $perpage * ($page - 1) - 1;
$nowpage = $nowpage >= 0 ? $nowpage : 0;
if(empty($_G['gp_searchip'])){
    $count = $redis->ZCARD($pre.'blacklist');
    $multipage = multi($count, $perpage, $page, "admin.php?action=plugins&operation=config&do=$pluginid&identifier=ipbanspider&pmod=blacklist");
    $blacklist = $redis->zRevRange($pre.'blacklist' ,$nowpage ,$nowpage + $perpage ,true);
}else{
    $blacklist = $redis->zRevRange($pre.'blacklist' ,0 ,-1 ,true);
    $grepip = str_replace('*' ,'\d{1,3}' ,$_G['gp_searchip']);
    foreach($blacklist as $ip => $t){
        if(preg_match('#'.$grepip.'#i' ,$ip)==0) unset($blacklist[$ip]);
    }
}
$_G['gp_hidden'] = isset($_G['gp_hidden']) ? $_G['gp_hidden'] : 1;
$multipage = isset($multipage) ? $multipage : '';
$unbantime = $redis->HGETALL($pre.'unbantime');
showtableheader();
showsubtitle(array('' ,'IP' ,'被封时间' ,'解封时间' , '被封次数' , '详情'));
showtablerow('' ,array('colspan="6"') ,array('<p id="update"></p>'));
$overtime = 0;
if(!empty($blacklist)){
    foreach($blacklist as $k => $v){
        $ut = $unbantime[$k];
        if(time() >= $ut){
            $classname = 'class="overtime" '.($_G['gp_hidden'] ? 'style="display:none;"' : '');
            $ut = "<span class='green'>已经到期该IP下次访问时自动解封</span>";
            $overtime++;
        }else{
            $classname = '';
            $ut = date('Y-m-d H:i:s',$unbantime[$k]).'&nbsp;<b class="green">约'.ceil(($unbantime[$k]-time())/60).'分钟内</b>';
        }
        $ut .= '<br /><b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=black&v=list&other='.$k.'|blacklist|unban\',\'update\')" class="blue">解封</b>';
        //$ut = (time() >= $ut ? "<span class='green'>已经到期该IP下次访问时自动解封</span>" : date('Y-m-d H:i:s',$unbantime[$k]).'&nbsp;<b class="green">约'.ceil(($unbantime[$k]-time())/60).'分钟内</b>').'<br /><b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=black&v=list&other='.$k.'|blacklist|unban\',\'update\')" class="blue">解封</b>';
        $xq = $redis->zRevRange($pre.'history_ban_'.$k , 0, 0);
        showtablerow($classname ,array('','','','','','') ,array(
            "<input type=\"checkbox\" class=\"checkbox\" name=\"deletes[]\" value=\"$k\">",
            $k.'<a class="blue" href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=history&searchip='.$k.'">历</a><b onclick="getmessage(\''.$k.'\')" class="blue">详</b>' , date('Y-m-d H:i:s',$v), $ut, $redis->ZCARD($pre.'history_ban_'.$k) , $xq[0],
        ));
    }
    if($_G['gp_hidden'] && $overtime > 0) showtablerow('' ,array('colspan="5" style="text-align:center;"') ,array('<span id="tipshidden" onclick="gldqip.checked=false;showhidden(\'tr\',\'overtime\');">当前有<b class="blue">'.$overtime.'个</b>过期IP被隐藏显示</span>'));
}else{
    showtablerow('' ,array('','colspan="5"'),array('','当前没有IP被封'));
}
showsubmit('delete' ,'submit' ,'<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'deletes\')" /><label for="chkall">全选</label>' ,'' ,$multipage);
showtablefooter();
if(!$_G['gp_inajax']){
    if(submitcheck('delete')){
        echo '<script>';
        foreach($_G['gp_deletes'] as $dip){
            echo 'ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=black&v=list&other='.$dip.'|blacklist|unban\',\'update\');';
        }
        echo '</script>';
    }
    echo '</div>';
?>
<div id="message" style="display:none;">

</div>
<style>
#update p{text-align: center;border:1px solid #F4E4B4;background: #FFFFE9;cursor: pointer;}
#update p a{color:#EFAA00;}
#update p b{margin:0 5px;}
.green,.red,.blue{margin: 0 3px;cursor: pointer;}
.green{color:green;}
.red{color:red;}
.blue{color:blue;}
#message{position: absolute;top: 50px;left: 50px; width: 950px;height: 590px;border: 5px #CCC solid;background: white;}
#message #list{overflow-y: scroll;width: 950px;height: 420px;}
#message #user{overflow-y: scroll;width: 950px;height:70px;}
#message #allurl{overflow-y: scroll;width: 950px;height:70px;}
#message h3{text-align: center;}
#message h3 span{float:right;cursor: pointer;}
#message ul li{float:left;border:1px dashed #0099CC;padding:3px;margin:5px 0 0 5px;}
#message ul li span{margin-left:10px;}
</style>
<script>
    function showhidden(find ,classname){
        if(document.getElementById('gldqip').checked == true){
            result = 'none';
            tips = '';
        }else{
            result = '';
            tips = 'none';
        }
        var objs = document.getElementsByTagName(find);
        for(i=0 ;i<objs.length ;i++){
            if(objs.item(i).className.match(classname)!==null){
                objs.item(i).style.display = result;
            }
        }
        document.getElementById('tipshidden').style.display = tips;
    }
    function find_new(){
        var hide = document.getElementById('gldqip').checked == true ? '&hidden=1' : '&hidden=0';
        if(document.getElementById('autoref').checked == true){
            ajaxget('plugin.php?id=ipbanspider:blacklist&page=<?php echo $page; ?>&searchip=<?php echo $_G['gp_searchip'] ?>'+hide ,'BLACKLIST_DIV');
        }
    }
    function getmessage(ip){
        ajaxget('plugin.php?id=ipbanspider:ajaxget&m=select&v=find&other='+ip ,'message');
    }
    setInterval(find_new,<?php echo $ajaxpertime*1000 ?>);
</script>
<?php
}else{
    include template('common/footer_ajax');
}
?>
