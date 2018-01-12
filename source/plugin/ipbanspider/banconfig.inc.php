<?php

/**
 * @author JiangHong
 * @copyright 2013
 * �������ͳ�Ƴ����ҳ��Ƕ��
 * @filesource ipbanspider.class.php
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}
global $timetype;
$timetype = array(1 => '��' ,1*60 => '����' ,60*60 => 'Сʱ' ,24*60*60 => '��' ,7*24*60*60 => '��' ,30*7*24*60*60 => '��');
if($_G['gp_deleterid'] > 0){
    DB::delete('plugin_ipbanspider_rules' ,array('rid' => $_G['gp_deleterid']));
    require_once dirname(__FILE__).'/ipbanspiderrules.class.php';
    $ibpr = new ipbanspiderrules;
    $ibpr->rules_delete();
    cpmsg('ɾ�����', 'action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=banconfig', 'succeed');
}
if($_POST){
    $post = $_G['gp_rules'];
    if(!is_numeric($post['pertime']) || $post['pertime'] < 1 || !is_numeric($post['pertimetype']) || $post['pertimetype'] < 1 || !is_numeric($post['bantime']) || $post['bantime'] < 1 || !is_numeric($post['bantimetype']) || $post['bantimetype'] < 1 ) cpmsg('�ύ��������', 'action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=banconfig', 'error');
    $rules  = array(
        'name' => 'ÿ '.$post['pertime'].' '.$timetype[$post['pertimetype']].' ���� '.$post['num'].' �� ��� '.$post['bantime'].' '.$timetype[$post['bantimetype']] ,
        'pertime' => $post['pertime']*$post['pertimetype'] ,
        'num' => $post['num'] ,
        'bantime' => $post['bantime']*$post['bantimetype'] ,
        'dateline' => $post['dateline']>0 ? $post['dateline'] : TIMESTAMP ,
    );
    $post['ruleid'] > 0 ? DB::update('plugin_ipbanspider_rules' ,$rules ,array('rid'=>$post['ruleid'])) : DB::insert('plugin_ipbanspider_rules' ,$rules);
    require_once dirname(__FILE__).'/ipbanspiderrules.class.php';
    $ibpr = new ipbanspiderrules;
    $ibpr->rules_delete();
    cpmsg('�������', 'action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=banconfig', 'succeed');
}
$sltime = gettimeselect();
showtableheader();
showsubtitle(array('ID' ,'����' ,'ʱ���' ,'���ʴ���' ,'���ʱ��' ,'����ʱ��' ,'����'));
showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=banconfig' ,'' ,'rules' ,'post');
showtablerow('' ,array('class=\'td25\'') ,array('' ,'�Զ�����' ,'<input type=\'text\' name=\'rules[pertime]\' value=\'\' /><select name=\'rules[pertimetype]\'>'.$sltime.'</select>' ,'<input type=\'text\' name=\'rules[num]\' value=\'\' /> ��' ,'<input type=\'text\' name=\'rules[bantime]\' value=\'\' /><select name=\'rules[bantimetype]\'>'.$sltime.'</select>' ,date('Y-m-d H:i' ,TIMESTAMP) ,'<input type=\'submit\' name=\'submit\' value=\'���\' />'));
showformfooter();
$q = DB::query("SELECT * FROM ".DB::table('plugin_ipbanspider_rules'));
while($v = DB::fetch($q)){
    $pertime = gettimetype($v['pertime']);
    $bantime = gettimetype($v['bantime']);
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=banconfig' ,'' ,'rules'.$v['rid'] ,'post');
    showhiddenfields(array('rules[ruleid]' => $v['rid'] ,'rules[dateline]' => $v['dateline']));
    showtablerow('',array('class=\'td25\'') ,array($v['rid'] ,$v['name'] ,'<input type=\'text\' name=\'rules[pertime]\' value=\''.$pertime['time'].'\' /><select name=\'rules[pertimetype]\'>'.gettimeselect($pertime['type']).'</select>' ,'<input type=\'text\' name=\'rules[num]\' value=\''.$v['num'].'\' /> ��' ,'<input type=\'text\' name=\'rules[bantime]\' value=\''.$bantime['time'].'\' /><select name=\'rules[bantimetype]\'>'.gettimeselect($bantime['type']).'</select>' ,date('Y-m-d H:i' ,$v['dateline']) ,'<input type=\'submit\' name=\'submit\' value=\'�޸�\' />'.'<a href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=banconfig&deleterid='.$v['rid'].'" class="red">ɾ��</a>'));
    showformfooter();
}
showtablefooter();
function gettimetype($time){
    global $timetype;
    foreach($timetype as $k => $v){
        if($time/$k >= 1){
            $last = $k;
        }else{
            $m = $time/$last;
        }
    }
    return array('time' => $m ,'type' => $last);
}
function gettimeselect($default = ''){
    global $timetype;
    $sltime = '';
    foreach($timetype as $k => $v){
        $sltime .= "<option ".($k==$default?'selected':'')." value='{$k}'>$v</option>";
    }
    return $sltime;
}
?>
<style>
.green,.red,.blue{margin: 0 5px;cursor: pointer;}
.green{color:green;}
.red{color:red;}
.blue{color:blue;}
table tr td select{float: right;}
.change{border:1px solid red;}
</style>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script>
jQuery.noConflict();
;(function($){
    function changecolor(){
        $(this).parents('tr').addClass('change').attr('title' ,'�����Ѿ����ģ�������汣��');
    }
    $('table tr td select').change(changecolor);
    $('table tr td input').click(changecolor);
})(jQuery);
</script>
