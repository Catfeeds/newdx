<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: class_mysql_slave.php 18454 2010-11-24 02:30:28Z cnteacher $
 */
class db_mysql_slave extends db_mysql
{
	var $slaveid = null;
	var $slaveexcept = false;
	var $excepttables = array();
	var $curlink_slave;

	function set_config($config)
	{
		parent::set_config($config);
		if (! empty($this->config['slave'])) {
			$sid = array_rand($this->config['slave']);
			$this->slaveid = 1000 + $sid;
			$this->config[$this->slaveid] = $this->config['slave'][$sid];
			if ($this->config['common']['slave_except_table']) {
				$this->excepttables = explode(',', str_replace(' ', '', $this->config['common']['slave_except_table']));
			}
			unset($this->config['slave']);
		}
	}
	function table_name($tablename)
	{
		if ($this->slaveid && ! $this->slaveexcept && $this->excepttables) {
			if (in_array($tablename, $this->excepttables)) {
				$this->slaveexcept = true;
			}
		}
		return parent::table_name($tablename);
	}
	function slave_connect()
	{
		if ($this->slaveid) {
			if (!isset($this->link[$this->slaveid])) {

				$this->link[$this->slaveid] = $this->_dbconnect(
						$this->config[$this->slaveid]['dbhost'],
						$this->config[$this->slaveid]['dbuser'],
						$this->config[$this->slaveid]['dbpw'],
						$this->config[$this->slaveid]['dbcharset'],
						$this->config[$this->slaveid]['dbname'],
						$this->config[$this->slaveid]['pconnect']
					);
			}
			$this->curlink_slave = $this->link[$this->slaveid];
		}
	}
	function query($sql, $type = '')
	{
		$openslave = getSlaveID();
		$count = 0;

		!empty($openslave) && $sql = str_replace($openslave, '', $sql, $count);

		if (! empty($openslave) && $this->slaveid && $count > 0 && ! $this->slaveexcept && strtoupper(substr($sql, 0, 6)) == 'SELECT') {

			$this->curlink = $this->curlink_slave ? $this->curlink_slave : $this->curlink_master;
		} else {
			$this->curlink = $this->curlink_master;
		}

		$this->slaveexcept = false;
		return parent::query($sql, $type);
	}
}
?>