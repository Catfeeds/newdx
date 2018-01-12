<?php

/**
 * @author JiangHong
 * @copyright 2013
 * �������ͳ�Ƴ����ҳ��Ƕ��
 * @filesource ipbanspider.class.php
 */

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
if($_G['gp_inajax']==1){
    include template('common/header_ajax');
}else{
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=spider');
?>
<br />
<fieldset>
<legend>���ģ��</legend>
<p>֩������<input type="text" name="name" size="20" maxlength="25" />&nbsp;<select name="friend"><option value="0">���Ѻ�</option><option value="1">�Ѻ�</option></select>&nbsp;<input type="submit" name="submit" value="���"/></p>
<br />
<span class="blue" onclick="if(confirm('��պ���������ķ��ʼ��������������¼��㣡�Ƿ�ȷ�ϣ�'))ajaxget('plugin.php?id=ipbanspider:ajaxget&m=spider&v=clear' ,'updates');">��ջ���(<b class="red">��صķ����������</b>)</span>
<br /><p><span class="blue">�Զ�ˢ��<input type="checkbox" id="autoref"/></span><span onclick="ajaxget('plugin.php?id=ipbanspider:spider' ,'SPIDER_DIV');" class="green">ˢ��</span></p>
</fieldset>
<?php showformfooter(); ?>
<fieldset>
<legend>����ģ��</legend>
<div id="SPIDER_DIV">
<?php
}
require dirname(__FILE__).'/spider.class.php';
if($_POST){
    if(strlen($_G['gp_name']) > 0){
        spider::add($_G['gp_name'] ,$_G['gp_friend']);
    }else{
        cpmsg('�ύ֩��������Ϊ��', 'action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=spider', 'error');
    }
}
loadcache('plugin');
$ajaxpertime = $_G['cache']['plugin']['ipbanspider']['ajax_per'] > 1 ? $_G['cache']['plugin']['ipbanspider']['ajax_per'] : 5;
$q = DB::query("SELECT * FROM ".DB::table('plugin_ipbanspider_spiders'));
while($v = DB::fetch($q)){
    $spiders[] = $v;
}
?>
<?php if(!empty($spiders)){ ?>
    <div id="updates"></div>
    <ul>
        <?php
        foreach($spiders as $f){
            $num = spider::getval($f['friend'] ,$f['sname']);
        ?>
        <li><div><b class="blue"><?php echo $f['sname']; ?></b><span><?php echo $f['friend']==1 ? '<b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=spider&v=update&other='.$f['sid'].'|0\',\'updates\');" class="green">�Ѻ�</b>' : '<b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=spider&v=update&other='.$f['sid'].'|1\',\'updates\');" class="red">���Ѻ�</b>'; ?></span><em><?php echo $num; ?></em><span onclick="ajaxget('plugin.php?id=ipbanspider:ajaxget&m=spider&v=delete&other=<?php echo $f['sid'];?>|0','updates');" class="red bold">X</span></div></li>
        <?php } ?>
    </ul>
    <p style="clear: both;" class="red"><br />��������֩��</p>
    <ul>
        <?php
        foreach(spider::getmaybespider() as $k => $v){
        ?>
            <li><div><b class="blue"><?php echo $k ?></b><em><?php echo $v; ?></em></div></li>
        <?php
        }
        ?>
    </ul>
<?php }else{ ?>
    <p>��ǰû��֩����Ϣ</p>
<?php }
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
#SPIDER_DIV ul li{float: left;}
#SPIDER_DIV ul li span{margin-left:10px;}
#SPIDER_DIV ul li div{border:1px dashed #0099CC;padding:5px;margin:10px 0 0 10px;}
fieldset{padding: 10px;margin-bottom: 20px;}
em{color:#39F;font-weight: 700;}
.blod{font-weight: bold;}
</style>
<script>
    function find_new(){
        if(document.getElementById('autoref').checked == true){
            ajaxget('plugin.php?id=ipbanspider:spider' ,'SPIDER_DIV');
        }
    }
    setInterval(find_new,<?php echo $ajaxpertime*1000 ?>);
</script>
<?php } ?>
