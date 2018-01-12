<?php

/**
 * @author JiangHong
 * @copyright 2013
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}

if(!$_G['gp_inajax']){
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=history');
    echo '<br /><p>����IP��&nbsp;&nbsp;<input type="text" name="searchip" value="'.$_G['gp_searchip'].'"/>&nbsp;&nbsp;<input type="submit" name="submit" value="��ѯ"/>&nbsp;&nbsp;<b class="green">��ʾ����ѯ���Բ�ѯip�Σ����巽ʽΪ��*����,���磺131.*.14.* ��17.*.*.* �� 192.168.1.*</b></p>';
    showformfooter();
    echo '<br /><p>�Զ�ˢ��<input type="checkbox" id="autoref"/></p>';
    echo '<div id="HISTORY_DIV">';
}else{
    include template('common/header_ajax');
}
if($_G['gp_inajax'] && $_G['groupid']==1){
    include_once libfile('function/admincp');
}
require_once libfile('class/myredis');
$redis = & myredis::instance(6379);
//change db
$redis->SELECTDB(1);
$pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
$ajaxpertime = $_G['cache']['plugin']['ipbanspider']['ajax_per'] > 1 ? $_G['cache']['plugin']['ipbanspider']['ajax_per'] : 5;
loadcache('plugin');
$numbercount = 0;
$showmaxcount=200;
function gethistory($type ,$ip=''){
    global $_G,$redis,$pre, $numbercount,$showmaxcount;
    if(! $ip && $numbercount > $showmaxcount){
    	return;
    }
    $ip = empty($ip) ? '*' : $ip;
    foreach($redis->keys($pre.'history_'.$type.'_'.$ip) as $k){
        $p = str_replace($pre.'history_'.$type.'_' ,'' ,$k);
        $historylist[$p] = $redis->zRevRange($k ,0 ,-1 ,true);
        $numbercount += count($historylist[$p]);
        if( $ip == '*' && $numbercount > $showmaxcount){
	    	break;
	    }
    }
    return $historylist;
}
$search = $_G['gp_search'] ? $_G['gp_search'] : '';
$page = $_G['gp_page'] >= 1 ? $_G['gp_page'] : 1;
$perpage = $_G['cache']['plugin']['ipbanspider']['page_per'] ? $_G['cache']['plugin']['ipbanspider']['page_per'] : 15;
$nowpage = $perpage * ($page - 1) - 1;
$nowpage = $nowpage >= 0 ? $nowpage : 0;
$microtime = microtime(true);
//echo '<pre>'.print_r(gethistory('ban'),true);
showtableheader();
showsubtitle(array('IP' ,'����' ,'ʱ��' ,'��־'),array('class="td25"' ,'class="td25"'));
$historytype = array('ban' => '<b class="red">�����־</b>' ,'unban' => '<b class="green">�����־</b>' ,'safe' => '<b class="green">���������</b>' ,'unsafe' => '<b class="red">�߳�������</b>');
$blacklist = $redis->zRange($pre.'blacklist' ,0 ,-1);
$whitelist = $redis->sMembers($pre.'whitelist');

foreach($historytype as $ty => $name){
    echo '<tbody>';
    foreach(gethistory($ty ,$_G['gp_searchip']) as $bp => $bh){
        $num = count($bh);$first = 1;
        foreach($bh as $bt => $bjt){
            if($first==1) echo '<td rowspan="'.$num.'">'.$bp.(in_array($bp ,$blacklist) ? '<b class="red">(��)</b>' : (in_array($bp ,$whitelist) ? '<b class="green">(��)</b>' : '')).'<br />(<b class="red">'.$num.'</b>��)<br /><br /><b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=black&v=list&other='.$bp.'|select|'.(in_array($bp ,$blacklist) ? 'unban\',\'update\')" class="green">���' : 'ban\',\'update\')" class="red">���').'</b>'.'|<b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=white&v=list&other='.$bp.'|select|'.(in_array($bp ,$whitelist) ? 'unsafe\',\'update\')" class="red">�Ƴ�������' : 'safe\',\'update\')" class="green">���������').'</b></td>';
            echo '<td>'.$name.'</td><td>'.date('Y-m-d H:i:s' ,$bjt).'</td><td>'.$bt.'</td></tr>';
            $first++;
        }
    }
    echo '</tbody>';
    if($numbercount > $showmaxcount && ! $_G['gp_searchip']){
    	echo "<tbody><tr><td colspan='4'><p style='text-align:center;'><b>����{$showmaxcount}����¼��ʣ�½�����ʾ������鿴��ȫ����ʹ��ip����ѯ</b></p></td></tr></tbody>";
    	break;
    }
}
showtablefooter();
if($_G['gp_inajax']==1){
    include template('common/footer_ajax');
}else{
    echo '</div>';
?>
<style>
#update p{text-align: center;border:1px solid #F4E4B4;background: #FFFFE9;cursor: pointer;}
#update p a{color:#EFAA00;}
#update p b{margin:0 5px;}
.green,.red,.blue{margin: 0 5px;cursor: pointer;}
.green{color:green;}
.red{color:red;}
.blue{color:blue;}
#message{position: absolute;top: 50px;left: 50px; width: 950px;height: 620px;border: 5px #CCC solid;background: white;}
#message #list{overflow-y: scroll;width: 950px;height: 520px;}
#message #user{overflow-y: scroll;width: 950px;height:70px;}
#message h3{text-align: center;}
#message h3 span{float:right;cursor: pointer;}
#message ul li{float:left;border:1px dashed #0099CC;padding:3px;margin:5px 0 0 5px;}
#message ul li span{margin-left:10px;}
</style>
<script>
function find_new(){
    if(document.getElementById('autoref').checked == true){
        ajaxget('plugin.php?id=ipbanspider:history&searchip=<?php echo $_G['gp_searchip']; ?>' ,'HISTORY_DIV');
    }
}
setInterval(find_new ,<?php echo $ajaxpertime*1000 ?>);
</script>
<?php
}
?>
