<?php
/**
 * @author JiangHong
 * @version 2012.10.18
 */
//ini_set('default_socket_timeout', -1);
class myredis
{
	var $obj;
	var $connected;
	var $_port;
	function init($port = 0)
	{
		global $_G;
		$hasRedis = extension_loaded('redis');
		$this->connected = false;
		if (! $hasRedis) {
			return false;
		}
		$port = intval($port) > 0 ? $port : $_G['config']['memory']['redis']['default_port'];
		$config = $_G['config']['memory']['redis'][$port];
		if ($hasRedis) {
			try {
				$this->obj = new Redis();
				if($config['pconnect']) {
					$con = @$this->obj->pconnect($config['server'], $config['port']);
				} else {
					$con = @$this->obj->connect($config['server'], $config['port']);
				}
				if (! empty($config['pwd'])) {
					if (! @$this->obj->auth($config['pwd'])) {
						$this->connected = false;
						return false;
					}
				}
			} catch (RedisException $e) {
				return false;
			}
			if ($con) {
				$this->connected = true;
			} else {
				return false;
			}
		}
		$this->_port = $config['port'];
		if(! $config['pconnect']) {
			register_shutdown_function(array($this, 'CLOSE'));
		}
	}
	function SELECTDB($index)
	{
		if ($this->connected) {
			return $this->obj->SELECT($index);
		} else {
			return false;
		}
	}
	function delete($key)
	{
		if ($this->connected) {
			return $this->obj->delete($key);
		} else {
			return false;
		}
	}
	function &instance($port = 0)
	{
		static $objectredis;
		if (empty($objectredis[$port])) {
			$objectredis[$port] = new myredis();
			$objectredis[$port]->init($port);
		}
		return $objectredis[$port];
	}
	function incrBy($key, $num)
	{
		if ($this->connected) {
			return $this->obj->incrBy($key, $num);
		} else {
			return false;
		}
	}
	function incr($key)
	{
		if ($this->connected) {
			return $this->obj->incr($key);
		} else {
			return false;
		}
	}
	function ttl($key)
	{
		if ($this->connected) {
			return $this->obj->ttl($key);
		} else {
			return false;
		}
	}
	function hashset($modul, $key, $value)
	{
		if ($this->connected) {
			$this->hashdel($modul, $key);
			return $this->obj->hSet($modul, $key, $value);
		} else {
			return false;
		}
	}
	function hashdel($modul, $key)
	{
		if ($this->connected) {
			return $this->obj->hDel($modul, $key);
		} else {
			return false;
		}
	}
	function hashget($modul, $key)
	{
		if ($this->connected) {
			return $this->obj->hGet($modul, $key);
		} else {
			return false;
		}
	}
	function islock_process($process, $ttl = 0)
	{
		$ttl = $ttl < 1 ? 600 : intval($ttl);
		$process = 'lock_redis_' . $process;
		return self::status('get', $process) || self::find($process, $ttl);
	}
	function status($action, $process)
	{
		static $redis_lock = array();
		switch ($action) {
			case 'set':
				$redis_lock[$process] = true;
				break;
			case 'get':
				return ! empty($redis_lock[$process]);
				break;
			case 'rm':
				$redis_lock[$process] = null;
				break;
			case 'clear':
				$redis_lock = array();
				break;
		}
		return true;
	}
	function find($name, $ttl)
	{
		if (! $this->obj->get($name)) {
			$this->obj->set($name, time(), $ttl);
			$ret = false;
		} else {
			$ret = true;
		}
		self::status('set', $name);
		return $ret;
	}
	function unlock($process)
	{
		$process = 'lock_redis_' . $process;
		self::status('rm', $process);
		$this->obj->del($process);
	}
	function keys($prefix)
	{
		if ($this->connected) {
			return $this->obj->keys($prefix);
		} else {
			return false;
		}
	}
	function sIsMember($key, $value)
	{
		if ($this->connected) {
			return $this->obj->sIsMember($key, $value);
		} else {
			return false;
		}
	}
	function zScore($key, $value)
	{
		if ($this->connected) {
			return $this->obj->zScore($key, $value);
		} else {
			return false;
		}
	}
	function zRem($key, $member)
	{
		if ($this->connected) {
			return $this->obj->zRem($key, $member);
		} else {
			return false;
		}
	}
	function zRange($key, $start, $end, $withscores = false)
	{
		if ($this->connected) {
			return $this->obj->zRange($key, $start, $end, $withscores);
		} else {
			return false;
		}
	}
	function zCount($key, $start, $end)
	{
		if ($this->connected) {
			return $this->obj->zCount($key, $start, $end);
		} else {
			return false;
		}
	}
	function sAdd($key, $value)
	{
		if ($this->connected) {
			return $this->obj->sAdd($key, $value);
		} else {
			return false;
		}
	}
	function sRem($key, $value)
	{
		if ($this->connected) {
			return $this->obj->sRem($key, $value);
		} else {
			return false;
		}
	}
	function Exists($key)
	{
		if ($this->connected) {
			return $this->obj->Exists($key);
		} else {
			return false;
		}
	}
	function sMembers($key)
	{
		if ($this->connected) {
			return $this->obj->sMembers($key);
		} else {
			return false;
		}
	}
	function sRANDMEMBER($key, $count='1'){
		if ($this->connected) {
			if($count == 1){
				return $this->obj->sRANDMEMBER($key);
			}else{
				return $this->obj->sRANDMEMBER($key, $count);
			}
		} else {
			return false;
		}
	}
	function sCard($key)
	{
		if ($this->connected) {
			return $this->obj->sCard($key);
		} else {
			return false;
		}
	}
        //新添加的几个SET操作
        function sDiff($key1, $key2){
                if ($this->connected) {
			return $this->obj->sDiff($key1, $key2);
		} else {
			return false;
		}
        }
        function sDiffStore($newkey, $key1, $key2){
                if ($this->connected) {
			return $this->obj->sDiffStore($newkey, $key1, $key2);
		} else {
			return false;
		}
        }
        function sInter($key1, $key2){
                if ($this->connected) {
			return $this->obj->sInter($key1, $key2);
		} else {
			return false;
		}
        }
        function sInterStore($newkey, $key1, $key2){
                if ($this->connected) {
			return $this->obj->sInterStore($newkey, $key1, $key2);
		} else {
			return false;
		}
        }
	function zIncrBy($key, $increment, $member)
	{
		if ($this->connected) {
			return $this->obj->zIncrBy($key, $increment, $member);
		} else {
			return false;
		}
	}
	function zRevRange($key, $start, $end, $withscores = false)
	{
		if ($this->connected) {
			return $this->obj->zRevRange($key, $start, $end, $withscores);
		} else {
			return false;
		}
	}
	function zRemRangeByScore($key, $start, $end)
	{
		if ($this->connected) {
			return $this->obj->zRemRangeByScore($key, $start, $end);
		} else {
			return false;
		}
	}
	function zRangeByScore($key, $start, $end, $option = array())
	{
		if ($this->connected) {
			return $this->obj->zRangeByScore($key, $start, $end, $option);
		} else {
			return false;
		}
	}
	//新加的几个redis操作
	//同时将多个 field-value (域-值)对设置到哈希表 key 中。
	function HMSET($key, $arrl)
	{
		if ($this->connected) {
			return $this->obj->HMSET($key, $arrl);
		} else {
			return false;
		}
	}
	//同时将多个 field-value (域-值)对设置到哈希表 key 中。
	function HMGET($key, $filed)
	{
		if ($this->connected) {
			return $this->obj->hmget($key, $filed);
		} else {
			return false;
		}
	}
	//get the value of a certain field from the key of the hash
	function HGET($key, $field)
	{
		if ($this->connected) {
			return $this->obj->hget($key, $field);
		} else {
			return false;
		}
	}
	//set the value of a certain field from the key of the hash
	function HSET($key, $field, $value) {
		if ($this->connected) {
			return $this->obj->hset($key, $field, $value);
		} else {
			return false;
		}
	}

	//返回或保存给定列表、集合、有序集合 key 中经过排序的元素。
	function SORT($key, $arr)
	{
		if ($this->connected) {
			return $this->obj->SORT($key, $arr);
		} else {
			return false;
		}
	}
	function HGETALL($key)
	{
		if ($this->connected) {
			return $this->obj->HGETALL($key);
		} else {
			return false;
		}
	}
	function EXPIRE($key, $times)
	{
		if ($this->connected) {
			return $this->obj->EXPIRE($key, $times);
		} else {
			return false;
		}
	}
	function LRANGE($key, $start, $stop)
	{
		if ($this->connected) {
			return $this->obj->LRANGE($key, $start, $stop);
		} else {
			return false;
		}
	}
	function MSET($key, $filed, $val)
	{
		if ($this->connected) {
			return $this->obj->MSET($key, $filed, $val);
		} else {
			return false;
		}
	}
	function MGET($key)
	{
		if ($this->connected) {
			return $this->obj->MGET($key);
		} else {
			return false;
		}
	}
	function ZADD($key, $score, $value)
	{
		if ($this->connected) {
			return $this->obj->ZADD($key, $score, $value);
		} else {
			return false;
		}
	}
	function ZCARD($key)
	{
		if ($this->connected) {
			return $this->obj->ZCARD($key);
		} else {
			return false;
		}
	}
	function SET($key, $val)
	{
		if ($this->connected) {
			return $this->obj->SET($key, $val);
		} else {
			return false;
		}
	}
	function GET($key)
	{
		if ($this->connected) {
			return $this->obj->GET($key);
		} else {
			return false;
		}
	}
	function DEL($key)
	{
		if ($this->connected) {
			return $this->obj->del($key);
		} else {
			return false;
		}
	}
	function RPUSH($key, $value)
	{
		if ($this->connected) {
			return $this->obj->RPUSH($key, $value);
		} else {
			return false;
		}
	}
	function LREM($key, $num, $value)
	{
		if ($this->connected) {
			return $this->obj->LREM($key, $num, $value);
		} else {
			return false;
		}
	}
	function LSIZE($key)
	{
		if ($this->connected) {
			return $this->obj->LSIZE($key);
		} else {
			return false;
		}
	}
	function LREMOVE($key, $val, $num)
	{
		if ($this->connected) {
			return $this->obj->lremove($key, $val, $num);
		} else {
			return false;
		}
	}
	function LPOP($key){
		if ($this->connected) {
			return $this->obj->lpop($key);
		} else {
			return false;
		}
	}
	function CLOSE(){
		if ($this->connected) {
			$this->obj->close();
		}
	}
}
?>