<?php
/**
 * Class CachedataLogger
 * 
 * 将某个类的静态方法返回的结果缓存起来
 * 使用方法:
 * $cachedata = new CachedataLogger;
 * $cachedata->class = 'Class';
 * $cachedata->methods = array('method'=>array('cacheTime'=>60*60*24));
 * $cachedata->method($arguments); // 执行方法
 * 
 * @version 2011-11-25 15:36
 * @author MengJin
 *
 */
class CachedataLogger {
	public $methods;
	public $class;
	public $forceRefreshCache = false; // 是否强制刷新缓存
	private $_redis;
	protected $_time;

	public function __construct() {
		$this->_time = time();
		require_once libfile('class/myredis');
		$this->_redis = myredis::instance(6378);
	}

	public function __call($name, $arguments) {
		if ($this->class==null || count($this->methods)==0) return false;
		if (!isset($this->methods[$name])) return call_user_func_array(array($this->class, $name), $arguments);
		
		$key = $this->_getKey($name, $arguments);
		$methodinfo = $this->_encase($name, $arguments);
		$expire = $this->_time + $this->methods[$name]['cacheTime'];
		$cachedata = $this->_getData($key, $methodinfo, 'cachedata');
		if ($cachedata) {
			if ($this->forceRefreshCache) {
				$data = call_user_func_array(array($this->class, $name), $arguments);
				//$this->_updateData($cachedata['id'], serialize($data), $expire);
				$this->_insertData($key, $methodinfo, $data, $expire);
			} else {
				$cachedata = unserialize($cachedata);
				$data = $cachedata['value'];
				if ($cachedata['expire'] < $this->_time) {
					//$this->_logging($cachedata['id']); //缓存己过期, 记录但不更新
					$this->_redis->hashdel($key, $methodinfo);
				}
			}
		} else { //缓存不存在
			$data = call_user_func_array(array($this->class, $name), $arguments);
			$this->_insertData($key, $methodinfo, $data, $expire);
		}

		return $data;
	}

	protected function _getKey($name, $arguments) {
		/*$string = $this->class.'::'.$name." ";
		foreach ($arguments as $arg) {
			$string .= $arg;
		}
		return md5($string);*/
		return 'NEWCACHEDATA_' . $this->class . '_' . $name . '|HASH';
	}

	protected function _encase($name, $arguments) {
		/*$array = array(
			'class' => $this->class,
			'method' => $name,
			'arguments' => $arguments,
		);
		return serialize($array);*/
		return md5(serialize($arguments));
	}
	
	protected function _getData($key, $methodinfo, $table='cachedata') {
		/*$cachedataArray = array();
		$cachedata = NULL;
		$query = DB::query("SELECT * FROM ".DB::table("plugin_{$table}")." WHERE `key` = '$key'");
		
		while ($value = DB::fetch($query)) {
			$cachedataArray[] = $value;
		}
		
		//避免hash冲突, 匹配封装信息
		if ($cachedataArray) {
			foreach ($cachedataArray as $i => $data) {
				if ($data['methodinfo'] == $methodinfo) {
					$cachedata = $data;
					break;
				}
			}
		}
		return $cachedata;*/
		return $this->_redis->hashget($key, $methodinfo);
	}

	protected function _logging($id) {
		if ($id != null) {
			DB::query("UPDATE ".DB::table('plugin_cachedata')." SET logged=1, loggedtime='{$this->_time}' WHERE id = {$id}");
		}
	}

	protected function _insertData($key, $methodinfo, $value, $expire) {
		/*$methodinfo = addcslashes($methodinfo, "\\'");
		$value = addcslashes($value, "\\'");
		
		DB::query("INSERT INTO ".DB::table('plugin_cachedata')." (`key`, methodinfo, value, expire) VALUES ('$key', '$methodinfo', '$value', '$expire')");
		*/
		$this->_redis->hashset($key, $methodinfo, serialize(array('value' => $value, 'expire' => $expire)));
	}
	
	protected function _updateData($id, $value, $expire) {
		$value = addcslashes($value, "\\'");
		
		DB::query("UPDATE ".DB::table('plugin_cachedata')." SET value = '$value', expire = '$expire' WHERE id = '$id'");
	}
	
}
