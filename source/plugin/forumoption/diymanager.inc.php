<?php
/**
 * @author JiangHong
 * ���ڹ���DIY�������ݣ����ʹ��
 */
 
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$perdel = 1000;//����ÿ��ɾ��1000��
if($_POST){
    $timenum = intval($_G['gp_deltime']);
    $deltime = time() - $timenum * 24 * 3600;
    $maxnum = DB::result_first("SELECT count(*) FROM ".DB::table('common_diy_bak')." WHERE updatetime < ".$deltime);
    $dels = ceil($maxnum / $perdel);
    echo '��ǰѡ���ɾ��������'.$maxnum.'��<br/>';
    memory('set' , 'plugin_forumoption_diymanager_maxs' , $maxnum , 1000);
    memory('set' , 'plugin_forumoption_diymanager_dels' , $dels , 1000);
    memory('set' , 'plugin_forumoption_diymanager_deltime' , $deltime , 1000);
}
if($delsm = memory('get' , 'plugin_forumoption_diymanager_dels')){
    if($deltimem = memory('get' , 'plugin_forumoption_diymanager_deltime')){
        $maxm = memory('get' , 'plugin_forumoption_diymanager_maxs');
        DB::delete('common_diy_bak' , ' updatetime < '.$deltimem , $perdel);
        memory('set' , 'plugin_forumoption_diymanager_dels' , $delsm-1);
        $url = ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=diymanager';
        $now = $perdel * $delsm;$before = $now - $perdel;
        echo <<<EOF
�� $maxm ������<br/>
��ǰ����ɾ���� $before ~ $now ����<br/>
�Ժ�����ִ�С���Ⱥ�<br/>
EOF;
        echo "<meta http-equiv='refresh'content=5;URL='$url'>";
    }else{
        memory('rm' , 'plugin_forumoption_diymanager_dels');
    }
}
$alldiy = array();
$query = DB::query("SELECT diyname , username , max(updatetime) as updatetime FROM ".DB::table('common_diy_bak')." GROUP BY diyname");
while($value = DB::fetch($query)){
    $alldiy[$value['diyname']]['last']['username'] = $value['username'];
    $alldiy[$value['diyname']]['last']['time'] = $value['updatetime'];
}
$query = DB::query("SELECT diyname , username , min(updatetime) as updatetime FROM ".DB::table('common_diy_bak')." GROUP BY diyname");
while($value = DB::fetch($query)){
    $alldiy[$value['diyname']]['start']['username'] = $value['username'];
    $alldiy[$value['diyname']]['start']['time'] = $value['updatetime'];
}
//$query = DB::result_first("SELECT count(diyname) FROM ".DB::table('common_diy_bak')." GROUP BY diyname");
include template('forumoption:diymanager');
showtableheader();
showtablerow('',array('style="color:blue;"','style="color:blue;"','style="color:blue;"'),array('DIYģ��','�ִ汸������ʱ��(�����û�)','���ڱ�������ʱ��(�����û�)'));
foreach($alldiy as $key => $values){
    showtablerow('',array(),array(
        $key,
        date('Y-m-d H:i:s',$values['start']['time']).'<b>('.$values['start']['username'].')</b>',
        date('Y-m-d H:i:s',$values['last']['time']).'<b>('.$values['last']['username'].')</b>',
    ));
}
showtablefooter();
?>