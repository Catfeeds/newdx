<?php
/**
 * @author JiangHong
 * @copyright 2013
 * º¯Êý¿â
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
class ipbanspiderrules{
    public $redis;
    public $pre = "BanIpSpider_";
    private $rule;
    function ipbanspiderrules(){
        require_once libfile('class/myredis');
        $this->redis = & myredis::instance(6379);
		//change db
        $this->redis->SELECTDB(1);
        loadcache('plugin');
        if($_G['cache']['plugin']['ipbanspider']['redis_per']) $this->pre = $_G['cache']['plugin']['ipbanspider']['redis_per'];
        self::rules_load();
    }
    function rules_to_cache(){
        $q = DB::query("SELECT * FROM ".DB::table('plugin_ipbanspider_rules'));
        while($v = DB::fetch($q)){
            $this->redis->hashset($this->pre.'config_rules' ,$v['rid'] ,serialize($v));
        }
    }

    function rules_load(){
        $this->redis->Exists($this->pre.'config_rules') ? $this->rule = $this->redis->HGETALL($this->pre.'config_rules') : self::rules_to_cache();
    }

    function rules_delete(){
        if(!empty($this->rule)){
            $this->redis->delete($this->pre.'config_rules');
        }
    }

    function get_rule(){
        return $this->rule;
    }
}
?>
