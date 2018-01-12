<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
$start = 1455508;
require_once libfile('class/myredis');
$redis = myredis::instance();
if($_G['uid'] == 1){
        if($start > 0){
            if($redis->obj->exists('thumbproduce_jh')===false){
                $sql = "SELECT cptp FROM ".DB::table('plugin_produce_info')." WHERE isin=1";
                $q = DB::query($sql);
                while($v = DB::fetch($q)){
                    $arr[] = $v;
                    if(!empty($v['cptp'])) $redis->obj->lPush('thumbproduce_jh' ,$v['cptp']);
                }
                var_dump($arr);
            }
        }
}
?>