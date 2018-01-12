<?php
/**
* @author JiangHong
* @version 2012.10.18
*/
Class postredis{
    var $redisHost;
    var $redisPort;
    var $redisPass;
    var $obj;
    var $connected;
    
    function init(){
        global $_G;
        $hasRedis = extension_loaded('redis');
        $this->connected = false;
        if(!$hasRedis){
        	return;
        }
        $this->redisHost = $_G['config']['memory']['redis']['server23'];;
        $this->redisPort = $_G['config']['memory']['redis']['port23'];
        $this->redisPass = $_G['config']['memory']['redis']['pwd'];
        if($hasRedis){
        	$this->obj = new redis;
        	$con = $this->obj->pconnect($this->redisHost,$this->redisPort);
        	if($con){
        		$this->connected = true;
        	}		
	        if(!empty($this->redisPass)){
				if(!$this->obj->auth($this->redisPass)){
					$this->connected = false;
				}
			}
        }
    }
    
    function &instance(){
        static $object;
        if(empty($object)){
            $object = new postredis();
            $object->init();
        }
        return $object;
    }    
        
    function hashset($modul ,$key ,$value ){
        if($this->connected){
			if($this->obj->hExists($modul,$key)){
				$this->hashdel($modul,$key);
			}
			return $this->obj->hSet($modul,$key,$value);
        }else{
            return false;
        }
    }
	function hashdel($modul ,$key){
        if($this->connected){
            return $this->obj->hDel($modul,$key);
        }else{
            return false;
        }
    }
    
    function hashget($modul,$key){
        if($this->obj->hExists($modul,$key)){
            return $this->obj->hGet($modul,$key);
        }else{
            return false;
        }
    }
    
    function islock_process($process,$ttl = 0){
        $ttl = $ttl < 1 ? 600 : intval($ttl);
        $process = 'lock_redis_'.$process;
		return self::status('get', $process) || self::find($process, $ttl);
    }
    
    function status($action, $process) {
		static $redis_lock = array();  
		switch ($action) {
			case 'set' : $redis_lock[$process] = true; break;
			case 'get' : return !empty($redis_lock[$process]); break;
			case 'rm' : $redis_lock[$process] = null; break;
			case 'clear' : $redis_lock = array(); break;
		}
		return true;
	}
    
    function find($name,$ttl){
		if(!$this->obj->get($name)){
			$this->obj->set($name,time(),$ttl);
			$ret = false;
		} else {
			$ret = true;
		}
		self::status('set', $name);
		return $ret;
	}
    
    function unlock($process) {
        $process = 'lock_redis_'.$process;
		self::status('rm', $process);
		$this->obj->del($process);
    }
    function keys($prefix){
        if($this->connected){
            return $this->obj->keys($prefix);
        }else{
            return false;
        }
    }
    function sIsMember($key ,$value){
        if($this->connected){
            return $this->obj->sIsMember($key ,$value);
        }else{
            return false;
        }
    }
    function zScore($key ,$value){
        if($this->connected){
            return $this->obj->zScore($key ,$value);
        }else{
            return false;
        }
    }
    function zRem($key ,$member){
        if($this->connected){
            return $this->obj->zRem($key ,$member);
        }else{
            return false;
        }
    }
    function zRange($key ,$start ,$end ,$withscores=false){
        if($this->connected){
            return $this->obj->zRange($key ,$start ,$end ,$withscores);
        }else{
            return false;
        }
    }
    function zCount($key ,$start ,$end){
        if($this->connected){
            return $this->obj->zCount($key ,$start ,$end);
        }else{
            return false;
        }
    }
    function sAdd($key ,$value){
        if($this->connected){
            return $this->obj->sAdd($key ,$value);
        }else{
            return false;
        }
    }
    function sRem($key ,$value){
        if($this->connected){
            return $this->obj->sRem($key ,$value);
        }else{
            return false;
        }
    }
    function Exists($key){
        if($this->connected){
            return $this->obj->Exists($key);
        }else{
            return false;
        }
    }
    function sMembers($key){
        if($this->connected){
            return $this->obj->sMembers($key);
        }else{
            return false;
        }
    }
    function sCard($key){
        if($this->connected){
            return $this->obj->sCard($key);
        }else{
            return false;
        }
    }
    function zIncrBy($key ,$increment ,$member){
        if($this->connected){
            return $this->obj->zIncrBy($key ,$increment ,$member);
        }else{
            return false;
        }
    }
    function zRevRange($key ,$start ,$end ,$withscores=false){
        if($this->connected){
            return $this->obj->zRevRange($key ,$start ,$end ,$withscores);
        }else{
            return false;
        }
    }
    //新加的几个redis操作   
    //同时将多个 field-value (域-值)对设置到哈希表 key 中。
    function HMSET($key,$arrl){
        if($this->connected){
            return $this->obj->HMSET($key,$arrl);
        }else{
            return false;
        }
    }
     //同时将多个 field-value (域-值)对设置到哈希表 key 中。
    function HMGET($key,$filed){
        if($this->connected){
            return $this->obj->hmget($key,$filed);
        }else{
            return false;
        }
    }
     //返回或保存给定列表、集合、有序集合 key 中经过排序的元素。
    function SORT($key,$arr){
        if($this->connected){
            return $this->obj->SORT($key,$arr);
        }else{
            return false;
        }
    }  
     
    function HGETALL($key){
        if($this->connected){
            return $this->obj->HGETALL($key);
        }else{
            return false;
        }
    }
    
    function EXPIRE($key,$times){
        if($this->connected){
            return $this->obj->EXPIRE($key,$times);
        }else{
            return false;
        }
    }
    
    function LRANGE($key,$start,$stop){
        if($this->connected){
            return $this->obj->LRANGE($key,$start,$stop);
        }else{
            return false;
        }
    }
    
    function MSET($key,$filed,$val){
        if($this->connected){
            return $this->obj->MSET($key,$filed,$val);
        }else{
            return false;
        }
    }
    function MGET($key){
        if($this->connected){
            return $this->obj->MGET($key);
        }else{
            return false;
        }
    }
    function ZADD($key ,$score ,$value){
        if($this->connected){
            return $this->obj->ZADD($key ,$score ,$value);
        }else{
            return false;
        }
    }
    function ZCARD($key){
        if($this->connected){
            return $this->obj->ZCARD($key);
        }else{
            return false;
        }
    }
    function SET($key,$val){
        if($this->connected){
            return $this->obj->SET($key,$val);
        }else{
            return false;
        }
    }
    
    function GET($key){
        if($this->connected){
            return $this->obj->GET($key);
        }else{
            return false;
        }
    }
    
    function DEL($key){
        if($this->connected){	   
	   return $this->obj->del($key); 	               
        }else{
            return false;
        }
    }   
    
    function RPUSH($key,$value){
        if($this->connected){
            return $this->obj->RPUSH($key,$value);
        }else{
            return false;
        }
    }
    
    function LREM($key,$num,$value){
        if($this->connected){
            return $this->obj->LREM($key,$num,$value);
        }else{
            return false;
        }
    }
    
    function LSIZE($key){
        if($this->connected){
            return $this->obj->LSIZE($key);
        }else{
            return false;
        }
    }
    
    function LREMOVE($key,$val,$num){
        if($this->connected){
            return $this->obj->lremove($key,$val,$num);
        }else{
            return false;
        }
    }
}
?>