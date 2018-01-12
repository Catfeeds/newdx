<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class record
{
	var $redis;
	var $_vars;
	var $_datas;
	var $_relation;
	var $_typename = 'record';
	function _init($classname)
	{
		$this->_typename = strtoupper($classname);
		require_once libfile('class/myredis');
		$this->redis = myredis::instance(6382);
	}
	public static function instance($name = 'record')
	{
		static $discuzclass;
		$classname = $name;
		if (empty($discuzclass[$classname])) {
			//$classname = get_called_class();
			$discuzclass[$classname] = new $classname;
			$discuzclass[$classname]->_init($classname);
		}
		$discuzclass[$classname]->redis->SELECTDB(0);
		return $discuzclass[$classname];
	}
	function recorddata($data)
	{
		$data = self::_handle_relation($data);
		if (! empty($this->_vars) && ! empty($data)) {
			foreach ($this->_vars as $_name => $_enable) {
				if (empty($data[$_name]) && $_enable)
					return array('result' => false, 'errormessage' => $_name.' is empty');
				if (method_exists($this, 'data_'.$_name.'_handle')) {
					$tmp = call_user_func_array(array($this, 'data_'.$_name.'_handle'), array($data[$_name]));
					$this->_datas[$_name] = str_replace(array(
						"\\r",
						"\\n",
						"\\t",
						"\t",
						"\n",
						"\r"), " ", $tmp);
				} else {
					$this->_datas[$_name] = str_replace(array(
						"\\r",
						"\\n",
						"\\t",
						"\t",
						"\n",
						"\r"), " ", $data[$_name]);
				}
			}
			return array('result' => $this->_save());
		}
		return array('result' => false, 'errormessage' => 'data is empty');
	}
	function _save()
	{
		$savestring = implode("\t", $this->_datas)."\n";
		$savestring = iconv('gbk', 'utf-8', $savestring);
		// file_put_contents(DISCUZ_ROOT."./threadfile/record.bcp", $savestring, FILE_APPEND);
		return $this->redis->RPUSH("TJHYZL_RECORD_{$this->_typename}|LIST", $savestring);
	}
	function _handle_relation($data)
	{
		extract($data);
		if (! empty($this->_relation)) {
			foreach ($this->_relation as $_name => $_ourkey) {
				if (method_exists($this, 'relation_'.$_name.'_handle')) {
					$_tmp = call_user_func_array(array($this, 'relation_'.$_name.'_handle'), array($data));
					eval("\$".$_name." = \$_tmp;");
				} else {
					eval("\$".$_name." = \$".$_ourkey.";");
				}
			}
		}
		eval("\$datas = compact(".dimplode(array_keys($this->_vars)).");");
		return $datas;
	}
	function relation_capturetime_handle()
	{
		global $_G;
		return $_G['timestamp'];
	}
	function data_ip_handle($ip)
	{
		return ip2long($ip);
	}
	function _savefile($filename, $content)
	{
		$this->redis->hashset("TJHYZL_SAVE_FILES", $filename, $content);
		// file_put_contents(DISCUZ_ROOT."./threadfile/".$filename, $content);
	}
}
?>