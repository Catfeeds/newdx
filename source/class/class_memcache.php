<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: class_memcache.php 22550 2011-05-12 05:21:39Z monkey $
 */

class discuz_memcache
{
	var $enable;
	var $obj;

	function discuz_memcache() {

	}

	function init($config) {
		if(!empty($config['server'])) {
			$this->obj = new Memcache;

			$config['server'] = $config['server'];

			if($config['pconnect']) {
				$connect = @$this->obj->pconnect($config['server'], $config['port']);
			} else {
				$connect = @$this->obj->connect($config['server'], $config['port']);
			}
			$this->enable = $connect ? true : false;
		}
	}

	// $server = '192.168.1.23:11211';
	function &instance($server, $pconnect = 1)
	{
		static $memcache_object;
		if (empty($memcache_object[$server])) {
			$memcache_object[$server] = new discuz_memcache();
			list($config['server'], $config['port']) = explode(':', $server);
			$config['pconnect'] = $pconnect;
			$memcache_object[$server]->init($config);
		}
		return $memcache_object[$server];
	}

	function get($key) {
		$result = $this->obj->get($key);
		if($result === false) {
			return null;
		} else {
			return $result;
		}
	}

	function set($key, $value, $ttl = 0) {
		return $this->obj->set($key, $value, MEMCACHE_COMPRESSED, $ttl);
	}

	function rm($key) {
		return $this->obj->delete($key);
	}

}

// 分布式一致性哈希算法
class server_hash{

	//虚拟节点数
	private $_virtualCounts = 2;
	//虚拟节点集合
	private $_circleNodes = array();
	//实际节点
	private $_serverNode = array();
	//实际节点数
	private $_serverCount = 0;
	//虚实节点对应关系
	private $_nodeRealKey = array();
	//是否需要排序
	private $needSort = false;

	public function __construct(){

	}

	//添加节点
	public function addNode($node){

		if( isset( $this->_serverNode[$node]) ){
			throw new Exception("node exists");
		}
		$this->_serverNode[$node] = array();
		for( $i = 0; $i < $this->_virtualCounts; $i++ ){
			 $_virturalKey = $this->myHash($node.$i);
			 $this->_circleNodes[$_virturalKey] = $node;
			 $this->_nodeRealKey[$node][] = $_virturalKey;
		}
		$this->needSort = true;
		$this->_serverCount++;
	}

	//移除节点
	public function removeNode($node){

		if( !isset($this->_serverNode[$node]) ){
			throw new Exception("node is not exists");
		}
		foreach( $this->_nodeRealKey[$node] as $key){
			unset($this->_circleNodes[$key]);
		}
		unset($this->_serverNode[$node]);
		$this->_serverCount--;
	}

	//获取节点
	public function getNode($str){

		if($this->needSort){
			$this->sortNodes();
		}

		$_sk = $this->myHash($str);
		foreach($this->_circleNodes as $key => $node){

			if($key > $_sk){
				return $node;
			}
		}
		$ret = array_values(array_slice($this->_circleNodes , 0 ,1));
		return $ret[0];

	}

	private function sortNodes(){
		 ksort($this->_circleNodes, SORT_STRING);
		 $this->needSort = false;
	}

	private function myHash($key)
	{
		$md5 = substr(md5($key), 0, 8);
		$seed = 31;
		$hash = 0;

		for($i = 0; $i < 8; $i++){
			$hash = $hash * $seed + ord($md5{$i});
			$i++;
		}
		return $hash & 0x7FFFFFFF;
	}
}
?>
