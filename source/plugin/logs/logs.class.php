<?php
/**
 * @author JiangHong
 * @todo 用于记录日志
 * @version 2012.09.14
 * @example 使用方法，先引入此类文件,然后声明 $logs = new logs(命名的日志文件名，方便查询);
 * @example 1.$logs->set_filename(命名的日志文件名，方便查询，若前面声明时设置则不用再次使用此函数，也可以使用此函数改变文件名)
 * @example 2.$logs->log_str(记录的字符串信息，不用记录时间，已经自动加入时间)
 * @example 3.$logs->log_array(记录数组的所有值信息，第一参数为数组，第二参数为数组名称，同样已经加入时间无需再记录)
 * @example 查询时进入后台的插件列表找寻日志调试插件，去查询。
 */
class logs
{
	private $log;
	private $save_path;
	private $log_key;
	private $log_ym;
	private $log_d;
	var $redis;
	function logs($filename = '')
	{
		require_once libfile('class/myredis');
		$this->redis = &myredis::instance(6378);
		$this->log_key = empty($filename) ? 'default' : $filename;
		date_default_timezone_set("Asia/Shanghai");
		$this->log_ym = date("Ym", time());
		$this->log_d = date('d', time());
	}
	function set_filename($filename)
	{
		$this->log_key = $filename;
	}
	function log_str($str)
	{
		$this->log = "time:" . date("H:i:s", time()) . "  ---  " . $str;
		self::write_logs();
	}
	function log_array($array, $array_name)
	{
		if (is_array($array)) {
			$this->log = "<pre>\${$array_name} = " . var_export($array, true) . "</pre>";
		} else {
			$this->log = ("\${$array_name} = " . $array);
		}
		self::log_str($this->log);
	}
	/**
	 * @param type,yearmonth,day
	 */
	function get_logs($argment)
	{
		extract($argment);
		$return = array();
		if (! empty($type)) {
			if (empty($yearmonth)) {
				$yearmonth = $this->redis->obj->sMembers('plugin_logs_key_ym_' . $type);
			} else {
				$yearmonth = array($yearmonth);
			}
			foreach ($yearmonth as $ym) {
				if (empty($day)) {
					$day = $this->redis->obj->sMembers('plugin_logs_key_d_' . $type . '_' . $ym);
				} else {
					$day = array($day);
				}
				foreach ($day as $key_d) {
					$return[$ym][$key_d] = self::read_logs('plugin_logs_value_' . $type . '_' . $ym . '_' . $key_d);
				}
			}
		} else {
			return false;
		}
	}
	function read_logs($key, $start = 0, $end = -1)
	{
		return $this->redis->obj->lrange('plugin_logs_value_' . $key, $start, $end);
	}
	function getlogslen($key)
	{
		return $this->redis->obj->llen('plugin_logs_value_' . $key);
	}
	private function write_logs()
	{
		if (! $this->redis->obj->sIsMember('plugin_logs_type', $this->log_key) && ! $this->redis->obj->sAdd('plugin_logs_type', $this->log_key)) {
			return false;
		} elseif (! $this->redis->obj->sIsMember('plugin_logs_key_ym_' . $this->log_key, $this->log_ym) && ! $this->redis->obj->sAdd('plugin_logs_key_ym_' . $this->log_key, $this->log_ym)) {
			return false;
		} elseif (! $this->redis->obj->sIsMember('plugin_logs_key_d_' . $this->log_key . '_' . $this->log_ym, $this->log_d) && ! $this->redis->obj->sAdd('plugin_logs_key_d_' . $this->log_key . '_' . $this->log_ym, $this->log_d)) {
			return false;
		} elseif (! $this->redis->obj->lpush('plugin_logs_value_' . $this->log_key . '_' . $this->log_ym . '_' . $this->log_d, $this->log)) {
			return false;
		} else {
			return true;
		}
	}
	function get_logs_set($type)
	{
		return $this->redis->obj->sMembers('plugin_logs_' . $type);
	}
	function del_logs_type($type, $yms = '', $dy = '')
	{
		$yearmonth = empty($yms) ? self::get_logs_set('key_ym_' . $type) : array($yms);
		foreach ($yearmonth as $ym) {
			$days = (empty($yms) || empty($dy)) ? self::get_logs_set('key_d_' . $type . '_' . $ym) : array($dy);
			foreach ($days as $day) {
				if (self::del_logs_value('plugin_logs_value_' . $type . '_' . $ym . '_' . $day)) {
					self::del_logs_set('plugin_logs_key_d_' . $type . '_' . $ym, $day);
				}
			}
			if ($this->redis->obj->scard('plugin_logs_key_d_' . $type . '_' . $ym) == 0)
				self::del_logs_set('plugin_logs_key_ym_' . $type, $ym);
		}
		if ($this->redis->obj->scard('plugin_logs_key_ym_' . $type) == 0)
			self::del_logs_set('plugin_logs_type', $type);
		return true;
	}
	function del_logs_set($key, $value)
	{
		if (! $this->redis->obj->sRem($key, $value)) {
			return false;
		}
		return true;
	}
	function del_logs_value($key)
	{
		return $this->redis->obj->expire($key, 0);
	}
	function get_logs_type($type, $yms = '', $dy = '')
	{
		$return = array();
		$limit = 500;
		$yearmonth = empty($yms) ? self::get_logs_set('key_ym_' . $type) : array($yms);
		foreach ($yearmonth as $ym) {
			$days = (empty($yms) || empty($dy)) ? self::get_logs_set('key_d_' . $type . '_' . $ym) : array($dy);
			foreach ($days as $day) {
				$nowcount = count($return);
				if ($nowcount > $limit) {
					$return[] = '<b class="red">注意:</b><b>当前超过' . $limit . '条记录，会被隐藏，请点击详细的月份，日期后，将会有对当天记录做分页处理</b>';
					break;
				}
				$temp = self::read_logs($type . '_' . $ym . '_' . $day);
				$ucount = $limit - $nowcount;
				if (count($temp) > $ucount) {
					$temp = array_chunk($temp, $ucount, true);
					$temp = $temp[0];
					$return[] = '<b class="red">注意:</b><b>当前超过' . $limit . '条记录，会被隐藏，请点击详细的月份，日期后，将会有对当天记录做分页处理</b>';
				}
				$temp = empty($temp) ? array('<b>当日无日志</b>') : $temp;
				$return = array_merge($return, array('<b>历史日志:时间:' . $ym . $day . '</b>'), $temp);
			}
		}
		return $return;
	}
}
?>