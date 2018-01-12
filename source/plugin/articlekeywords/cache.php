<?php
require_once libfile('function/cache');
define('FORUMOPTION_CACHEDIR', DISCUZ_ROOT.'./data/cache/');

class PluginCache {
    public $filedir = FORUMOPTION_CACHEDIR;
    public $filename_pre = '';
    
    function loadCache($filename) {
        $cache_array = array();
        $filepath = $this->filedir.'cache_'.$this->filename_pre.$filename.'.php';
        if (file_exists($filepath)) {
            $cache_array = include($filepath);
        }
        if (is_array($cache_array)) {
            return $cache_array;
        } else {
            return array();
        }
    }
    
    function writeCache($filename, $value) {
        if (is_array($value)) {
            $value = 'return ' . self::arrayToString($value) . ';';
        }
        
        writetocache($this->filename_pre.$filename, $value);
    }
    
    function arrayToString($value) {
        $str = "array(\n";
        foreach ($value as $i => $item) {
            if (!is_numeric($i)) {
                $_i = addcslashes($i, "\\'");
                $_i = "'$_i'";
            } else {
                $_i = $i;
            }
            if (is_array($item)) {
                $str .= "$_i=>".self::arrayToString($item).",\n";
            } elseif (is_numeric($item)) {
                $str .= "$_i=>$item,\n";
            } else {
                $instr = addcslashes($item, "\\'");
                $str .= "$_i=>'".$instr."',\n";
            }
        }
        $str .= ')';
        
        return $str;
    }
    
}