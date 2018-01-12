<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
class spider{
    function &getredis(){
        require_once libfile('class/myredis');
        $newredis = & myredis::instance(6379);
		//change db
        $newredis->SELECTDB(1);
        return $newredis;
    }
    function &getkey($friend=0){
        global $_G;
        loadcache('plugin');
        $pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
        return $pre.'config_spider_'.($friend == 0 ? 'danger' : 'friend').'_zset';
    }
    function &add($name,$friend=0 ,$redisobj=null){
        $f = DB::fetch_first("SELECT sid, friend ,count(*) as count FROM ".DB::table('plugin_ipbanspider_spiders')." WHERE sname = '{$name}';");
        if(empty($redisobj)) $redisobj = spider::getredis();
        if($f['count']>0){
            if($f['friend']!=$friend){
                spider::edit($f['sid'] ,$friend ,$name ,$redisobj);
            }
        }else{
            DB::insert('plugin_ipbanspider_spiders' ,array('sname'=>$name ,'friend'=>intval($friend) ,'dateline'=>time()));
            $redisobj->ZADD(spider::getkey($friend) ,0 ,$name);
        }
    }
    function &edit($id ,$friend=0 ,$name='' ,$redisobj=null){
        $name = empty($name) ? DB::result_first('SELECT sname FROM '.DB::table('plugin_ipbanspider_spiders')." WHERE sid=$id") : $name;
        DB::update('plugin_ipbanspider_spiders' ,array('friend' => intval($friend)) ,array('sid'=>$id));
        if(empty($redisobj)) $redisobj = spider::getredis();
        $val = intval($redisobj->zScore(spider::getkey(1^$friend) ,$name));
        $redisobj->zRem(spider::getkey(1^$friend) ,$name);
        $redisobj->ZADD(spider::getkey($friend) ,intval($val) ,$name);
    }
    function &update($friend=0 ,$redisobj=null){
        $q = DB::query("SELECT * FROM ".DB::table('plugin_ipbanspider_spiders'));
        if(empty($redisobj)) $redisobj = spider::getredis();
        while($v = DB::fetch($q)){
            $redisobj->ZADD(spider::getkey($v['friend']) ,intval($redisobj->zScore(spider::getkey($v['friend']) ,$v['sname'])) ,$v['sname']);
        }
    }
    function &getval($friend ,$key ,$redisobj=null){
        if(empty($redisobj)) $redisobj = spider::getredis();
        spider::exists($redisobj);
        return $redisobj->zScore(spider::getkey($friend) ,$key);
    }
    function &exists($redisobj=null){
        if(empty($redisobj)) $redisobj = spider::getredis();
        if($redisobj->Exists(spider::getkey(1)) === false) spider::update(1 ,$redisobj);
        if($redisobj->Exists(spider::getkey(0)) === false) spider::update(0 ,$redisobj);
    }
    function &delete($id ,$redisobj=null){
        $id = intval($id);
        if($id>0){
            $info = DB::fetch_first("SELECT * FROM ".DB::table('plugin_ipbanspider_spiders')." WHERE sid = $id");
            DB::delete('plugin_ipbanspider_spiders' ,array('sid'=>$id));
            if(empty($redisobj)) $redisobj = spider::getredis();
            $redisobj->zRem(spider::getkey($info['friend']) ,$info['sname']);
        }
    }
    function &clear($redisobj=null){
        if(empty($redisobj)) $redisobj = spider::getredis();
        $redisobj->delete(spider::getkey(0) ,0);
        $redisobj->delete(spider::getkey(1) ,0);
    }
    function &addvisit($friend ,$name ,$redisobj=null){
        if(empty($redisobj)) $redisobj = spider::getredis();
        $redisobj->zIncrBy(spider::getkey(intval($friend)) ,1 ,$name);
    }
    function &getspiders($friend ,$redisobj=null){
        if(empty($redisobj)) $redisobj = spider::getredis();
        spider::exists($redisobj);
        return $redisobj->zRevRange(spider::getkey(intval($friend)) ,0 ,-1);
    }
    function &getmaybespider($redisobj=null){
        global $_G;
        loadcache('plugin');
        $pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
        if(empty($redisobj)) $redisobj = spider::getredis();
        spider::exists($redisobj);
        return $redisobj->zRevRange($pre.'config_allspider' ,0 ,-1 ,true);
    }
}

?>
