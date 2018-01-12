<?php
/**
 * @author JiangHong
 * 用于管理DIY备份数据，清除使用
 */
 
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$perdel = 1000;//定义每次删除1000条
if($_POST){
    $timenum = intval($_G['gp_deltime']);
    $deltime = time() - $timenum * 24 * 3600;
    $maxnum = DB::result_first("SELECT count(*) FROM ".DB::table('common_diy_bak')." WHERE updatetime < ".$deltime);
    $dels = ceil($maxnum / $perdel);
    echo '当前选择的删除数据有'.$maxnum.'个<br/>';
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
共 $maxm 条数据<br/>
当前正在删除第 $before ~ $now 数据<br/>
稍后会继续执行。请等候<br/>
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
showtablerow('',array('style="color:blue;"','style="color:blue;"','style="color:blue;"'),array('DIY模块','现存备份最早时间(备份用户)','现在备份最新时间(备份用户)'));
foreach($alldiy as $key => $values){
    showtablerow('',array(),array(
        $key,
        date('Y-m-d H:i:s',$values['start']['time']).'<b>('.$values['start']['username'].')</b>',
        date('Y-m-d H:i:s',$values['last']['time']).'<b>('.$values['last']['username'].')</b>',
    ));
}
showtablefooter();
?>