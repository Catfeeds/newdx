<?php
/**
 * @author JiangHong
 * @copyright 2013
 * ���ڹ���ǰ�Ŀ�������
 */

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
if(!$_G['gp_inajax']){
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=doubt');
    echo '<br /><p>����IP��&nbsp;&nbsp;<input type="text" name="searchip" value="'.$_G['gp_searchip'].'"/>&nbsp;&nbsp;<input type="submit" name="submit" value="��ѯ"/>&nbsp;&nbsp;<b class="green">��ʾ����ѯ���Բ�ѯip�Σ����巽ʽΪ��*����,���磺131.*.14.* ��17.*.*.* �� 192.168.1.*</b></p>';
    showformfooter();
    echo '<br /><p>�Զ�ˢ��<input type="checkbox" checked id="autoref"/></p>';
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=doubt');
    echo '<div id="DOUBT_DIV">';
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
$doubttemp = $redis->sMembers($pre.'config_doubtip_set');
if(!empty($_G['gp_searchip'])){
    $grepip = str_replace('*' ,'\d{1,3}' ,$_G['gp_searchip']);
}
foreach($doubttemp as $n => $ip){
    if(!empty($grepip) && preg_match('#'.$grepip.'#i' ,$ip)==0) continue;
    $doubt[$ip] = $redis->ZCARD($pre.'history_ban_'.$ip);
}
arsort($doubt);
$blacklist = $redis->zRange($pre.'blacklist' ,0 ,-1);
echo '<br /><p><b>�˴���ʾΪ��ǰ���ɵ�IP��Ϣ����ǰ����Ϊÿ<b class="blue">'.($_G['cache']['plugin']['ipbanspider']['record_pertime'] > 0 ? $_G['cache']['plugin']['ipbanspider']['record_pertime'] : 5).'��</b>����<b class="red">'.($_G['cache']['plugin']['ipbanspider']['record_pernum'] > 0 ? $_G['cache']['plugin']['ipbanspider']['record_pernum'] : 10).'��</b>Ϊ����ip��</b><b class="red" onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=doubt&v=clear&other=\' ,\'update\')">���</b></p>';
if(!empty($doubt)){
    echo '<div id="update"></div><ul>';
    foreach($doubt as $dip => $num){
        echo '<li><div><span><b class="blue">'.$dip.'</b>'.(in_array($dip ,$blacklist)?'<b class="red">������</b>':'<b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=black&v=list&other='.$dip.'|doubt|ban\',\'update\')" class="red">���</b>').'<a class="blue" href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=history&searchip='.$dip.'">��</a><a class="blue" href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=select&searchip='.$dip.'">��</a></span>����<b class="red">'.$num.'</b>��<em class="red" onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=doubt&v=delete&other='.$dip.'\' ,\'update\')">X</em></div></li>';
    }
    echo '</ul>';
}else{
    echo '<br /><p><b class="green">��ǰû�п���IP</b></p>';
}
if($_G['gp_inajax']==1){
    include template('common/footer_ajax');
}else{
?>
</div>
</fieldset>
<style>
#update p{text-align: center;border:1px solid #F4E4B4;background: #FFFFE9;cursor: pointer;}
#update p a{color:#EFAA00;}
#update p b{margin:0 5px;}
.green,.red,.blue{margin: 0 3px;cursor: pointer;}
.green{color:green;}
.red{color:red;}
.blue{color:blue;}
#DOUBT_DIV ul li{float: left;}
#DOUBT_DIV ul li span{margin-left:10px;}
#DOUBT_DIV ul li div{border:1px dashed #0099CC;padding:5px;margin:10px 0 0 10px;}
fieldset{padding: 10px;margin-bottom: 20px;}
em{color:#39F;font-weight: 700;}
.blod{font-weight: bold;}
</style>
<script>
    function find_new(){
        if(document.getElementById('autoref').checked == true){
            ajaxget('plugin.php?id=ipbanspider:doubt' ,'DOUBT_DIV');
        }
    }
    setInterval(find_new,<?php echo $ajaxpertime*1000 ?>);
</script>
<?php } ?>
