<?php
/**
 * @author JiangHong
 * @copyright 2013
 * ��ʾ��ǰ���е���Ϣ
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}
loadcache('plugin');
if(!$_G['gp_inajax']){
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=select');
    echo '<br /><p>����IP��&nbsp;&nbsp;<input type="text" name="searchip" value="'.$_G['gp_searchip'].'"/>&nbsp;&nbsp;<input type="submit" name="submit" value="��ѯ"/>&nbsp;&nbsp;<b class="green">��ʾ����ѯ���Բ�ѯip�Σ����巽ʽΪ��*����,���磺131.*.14.* ��17.*.*.* �� 192.168.1.*</b></p>';
    showformfooter();
    echo '<br /><p>�Զ�ˢ��<input type="checkbox" checked id="autoref"/></p>';
    echo '<br /><p><b>�˴���ʾΪ��ǰ���ɵ�IP�ķ�����Ϣ����ǰ����Ϊÿ<b class="blue">'.($_G['cache']['plugin']['ipbanspider']['record_pertime'] > 0 ? $_G['cache']['plugin']['ipbanspider']['record_pertime'] : 5).'��</b>����<b class="red">'.($_G['cache']['plugin']['ipbanspider']['record_pernum'] > 0 ? $_G['cache']['plugin']['ipbanspider']['record_pernum'] : 10).'��</b>Ϊ����ip��</b></p>';
    echo '<div id="SELECT_DIV">';
}else{
    include template('common/header_ajax');
}
if($_G['gp_inajax'] && $_G['groupid']==1){
    include_once libfile('function/admincp');
}
$pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
$ajaxpertime = $_G['cache']['plugin']['ipbanspider']['ajax_per'] > 1 ? $_G['cache']['plugin']['ipbanspider']['ajax_per'] : 5;
require_once libfile('class/myredis');
$redis = & myredis::instance(6379);
//change db
$redis->SELECTDB(1);
$search = $_G['gp_searchip'] ? $_G['gp_searchip'] : '';
$page = $_G['gp_page'] >= 1 ? $_G['gp_page'] : 1;
$perpage = $_G['cache']['plugin']['ipbanspider']['page_per'] ? $_G['cache']['plugin']['ipbanspider']['page_per'] : 15;
$nowpage = $perpage * ($page - 1) - 1;
$nowpage = $nowpage >= 0 ? $nowpage : 0;
$microtime = microtime(true);
$cachetime = $_G['cache']['plugin']['ipbanspider']['tjtime']>0 ? $_G['cache']['plugin']['ipbanspider']['tjtime'] : 10;
//$allip = $redis->zRevRange($pre.'ALLIP' ,0 ,-1 ,true);
$allip = $redis->zRangeByScore($pre.'ALLIP' ,($microtime - $cachetime*60) ,$microtime ,array('withscores' => true));
if(empty($search)){
    //$allip = $redis->zRevRange($pre.'ALLIP' ,$nowpage ,$nowpage + $perpage ,true);
    $count = $redis->zCount($pre.'ALLIP' ,($microtime - $cachetime*60) ,$microtime);
    $multipage = multi($count, $perpage, $page, "admin.php?action=plugins&operation=config&do=$pluginid&identifier=ipbanspider&pmod=select");
}else{
    $grepip = str_replace('*' ,'\d{1,3}' ,$_G['gp_searchip']);
    $grepip = str_replace('.' ,'\.' ,$grepip);
    foreach($allip as $ip => $t){
        if(preg_match('/'.$grepip.'/i' ,$ip)==0) unset($allip[$ip]);
    }
}
$multipage = isset($multipage) ? $multipage : '';
$info = array();
$blacklist = $redis->zRange($pre.'blacklist' ,0 ,-1);
$whitelist = $redis->sMembers($pre.'whitelist');
showtableheader();
showsubtitle(array('IP' ,'���ʴ���(<b class="blue">'.$cachetime.'</b>������)' , '������ʱ��' , '����'));
showtablerow('' ,array('colspan="4"') ,array('<p id="update"></p>'));
$tablerow = '';
if(!empty($allip)){
    foreach($allip as $ip => $t){
        $selectips[$ip] = $redis->ZCARD($pre.'COMMON_IP_'.$ip.'_zset');
    }
    arsort($selectips);
    $i = 0;
    foreach($selectips as $ip => $num){
        $i++;
        if($i<($nowpage+1)) continue;
        if($i>($nowpage+$perpage))break;
        /*$nowcount = count($redis->keys($pre.'COMMON_IP_'.$ip.'_*'));*/
        //$nowcount = $redis->ZCARD($pre.'COMMON_IP_'.$ip.'_zset');
        $newvistor = (time()-$allip[$ip]) < 10 ? 'class="new"' : '';
        $tablerow .=$num > 0 ? showtablerow($newvistor ,array('','','','') ,array(
            '<em>'.$ip.(in_array($ip ,$blacklist) ? '<b class="red">����</b><a class="blue" href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=blacklist&searchip='.$ip.'">��</a>' : (in_array($ip ,$whitelist) ? '<b class="green">��ȫ</b><a class="blue" href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=whitelist&searchip='.$ip.'">��</a>' : '')).'<a class="blue" href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=history&searchip='.$ip.'">��</a></em>' , '<em>'.$num.'</em>', '<em>'.date('Y-m-d H:i:s',$allip[$ip]).'</em>',
            '<b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=black&v=list&other='.$ip.'|select|'.(in_array($ip ,$blacklist) ? 'unban\',\'update\')" class="green">���' : 'ban\',\'update\')" class="red">���').'</b>'.'|<b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=white&v=list&other='.$ip.'|select|'.(in_array($ip ,$whitelist) ? 'unsafe\',\'update\')" class="red">�Ƴ�������' : 'safe\',\'update\')" class="green">���������').'</b>|<b onclick="getmessage(\''.$ip.'\')" class="blue">��ϸ��Ϣ</b>',
        ),true) : '';
    }
    echo $tablerow;
}else{
    showtablerow('' ,array('','colspan="4"'),array('','��ǰû��IPͳ����Ϣ'));
}
showsubmit('delete' ,'submit' ,'<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'updates\')" /><label for="chkall">ȫѡ</label>' ,'' ,$multipage);
showtablefooter();
if(!$_G['gp_inajax']){
    echo '</div>';
?>
<div id="message" style="display:none;">

</div>
<style>
#update p{text-align: center;border:1px solid #F4E4B4;background: #FFFFE9;cursor: pointer;}
#update p a{color:#EFAA00;}
#update p b{margin:0 5px;}
.green,.red,.blue{margin: 0 5px;cursor: pointer;}
.green{color:green;}
.red{color:red;}
.blue{color:blue;}
.new em{color:red;}
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
function find_new(){
    if(document.getElementById('autoref').checked == true){
        ajaxget('plugin.php?id=ipbanspider:select&page=<?php echo $page; ?>&searchip=<?php echo $_G['gp_searchip']; ?>' ,'SELECT_DIV');
    }
}
function getmessage(ip){
    ajaxget('plugin.php?id=ipbanspider:ajaxget&m=select&v=find&other='+ip ,'message');
}
setInterval(find_new ,<?php echo $ajaxpertime*1000 ?>);
</script>
<?php
}else{
    include template('common/footer_ajax');
}
?>
