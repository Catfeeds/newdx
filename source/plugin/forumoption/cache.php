<?php
require_once libfile('function/cache');
define('FORUMOPTION_CACHEDIR', DISCUZ_ROOT.'./data/plugincache/');

class ForumOptionCache {
    static $filedir = FORUMOPTION_CACHEDIR;
    
    function loadCache($filename) {
		static $isfilecache, $allowmem;
		//Ôö¼Ómemcache»º´æÅĞ¶Ï modify by wangqi 20121011
		if($isfilecache === null) {
			$isfilecache = getglobal('config/cache/type') == 'file';
			$allowmem = memory('check');
		}
        $cache_array = array();
        $filepath = self::$filedir.'cache_plugin_forumoption_'.$filename.'.php';
		if ($allowmem){
			$cache_array = memory('get', 'plugincache_'.$filename);
		}
		if ($isfilecache && empty($cache_array)){
	        if (file_exists($filepath)) {
	            $cache_array = include($filepath);
	        }
		}
        
        if (is_array($cache_array)) {
            return $cache_array;
        } else {
            return array();
        }
		//end
    }
    
    function writeCache($filename, $value) {
		global $_G;
		static $isfilecache, $allowmem;
		//Ôö¼Ómemcache»º´æ modify by wangqi 20121011
		if($isfilecache === null) {
			$isfilecache = getglobal('config/cache/type') == 'file';
			$allowmem = memory('check');
		}

		$allowmem && (memory('set', 'plugincache_'.$filename, $value));
		if ($isfilecache){
	        if (is_array($value)) {
	            $value = 'return ' . self::arrayToString($value) . ';';
	        }        
	        writetocaches('plugin_forumoption_'.$filename, $value);
		}
		//end
    }
    
    function getCache($filename, $name) {
        $cache_array = self::loadCache($filename);
        if (isset($cache_array[$name])) {
            return $cache_array[$name];
        }
        return array();
    }
    //É¾³ı»º´æ
    function deleteCache($filename) {
		static $isfilecache, $allowmem;
		if($isfilecache === null) {
			$isfilecache = getglobal('config/cache/type') == 'file';
			$allowmem = memory('check');
		}

		$allowmem && (memory('rm', 'plugincache_'.$filename));
		$isfilecache && @unlink(DISCUZ_ROOT.'./data/cache/plugincache_'.$filename.'.php');
    }
    
    function arrayToString($value) {
        $str = 'array(';
        foreach ($value as $i => $item) {
            if (!is_numeric($i)) {
                $_i = "'$i'";
            } else {
                $_i = $i;
            }
            if (is_array($item)) {
                $str .= "$_i=>".self::arrayToString($item).',';
            } elseif (is_numeric($item)) {
                $str .= "$_i=>$item,";
            } else {
                $instr = addcslashes($item, "\\'");
                $str .= "$_i=>'".$instr."',";
            }
        }
        $str .= ')';        
        return $str;
    }
    
}