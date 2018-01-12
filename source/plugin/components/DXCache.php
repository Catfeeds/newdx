<?php

abstract class DXCache {
	// Ä¬ÈÏ»º´æÊ±¼ä
	public $cacheTime = 3600;
	public $keys = array();
	public $content = null;
	public $options = array();
	public $disabled = false;
	public $prefix = '';
	
	protected $_expire = null;
	protected $_curTime;
	protected $_isCached = false;
	
	public function __construct () {
		$this->init();
	}
	
	public function init() {
		$this->_curTime = time();
	}
	
	public function beginCache($key, $options = array()) {
		$this->keys[] = $key;
		global $_G;
		if ($_G['uid'] == 1 && $_G['gp_newcache'] == 1){
			$this->delete($key);
		}
		if (!$this->disabled) {
			$this->content = $this->get($key);
			if (!empty($this->content)) {
				$this->_isCached = true;
				$this->endCache();
				return false;
			}
		}
		$this->options = $options;
		$this->_expire = $this->_curTime + ($this->options['cacheTime'] ? $this->options['cacheTime'] : $this->cacheTime);
		
		ob_start();
		ob_implicit_flush(false);
		return true;
	}
	
	public function endCache() {
		if ($this->_isCached == false) {
			$this->content = ob_get_clean();
			$this->set(array_pop($this->keys), $this->content);
		}
		echo $this->content;
		$this->content = null;
	}
	
	function setData($key, $data) {
		$data = serialize($data);
		return $this->set($key, $data);
	}
	
	function getData($key) {
		return unserialize($this->get($key));
	}
	
	abstract public function set($key, $value);
	abstract public function get($key);
	abstract public function delete($key);
}

class DXDbCache extends DXCache {
	protected $_db = 'dxcache';
	public $prefix = 'DXCACHE_MEMORY_';
	public $cacheTime = 10800;
	public function setDb($db) {
		$this->_db = $db;
	}
	
	public function getDb() {
		return $this->_db;
	}
	
	public function set($key, $value) {
		//$value = addslashes($value);
		$key = $this->prefix.$key;
		return memory('set', $key, $value, $this->cacheTime);
		//return DB::query("REPLACE INTO ".DB::table($this->_db)." (`key`, `value`, `expire`) VALUE ('$key', '$value', {$this->_expire})");
	}
	
	public function get($key) {
		$key = $this->prefix.$key;
		return memory('get', $key);
		//return DB::result_first("SELECT value FROM ".DB::table($this->_db)." WHERE `key` = '$key' AND `expire` > '{$this->_curTime}'");
	}
	
	public function delete($key) {
		$key = $this->prefix.$key;
		return memory('rm', $key);
		//return DB::query("DELETE FROM ".DB::table($this->_db)." WHERE `key` = '$key'");
	}
}

/*

class DXMemCache extends DXCache {
	protected $_cache = null;
	
	public function init() {
		parent::init();
		$this->_cache = new Memcache;
	}
	public function set($key, $value) {
		
	}
	
	public function get($key) {
		
	}
	
	public function delete($key) {
		
	}
}

*/