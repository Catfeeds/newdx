<?php

/**
 * 程序启动类
 *
 * @author rinne 130822
 */
class Launcher {

	// 启动
	static function startup($config = array()) {
		// 加载控制器基类
		require (DISCUZ_ROOT . '/source/8264/controller/controller.base.php');
		// 加载模型基类
		require (DISCUZ_ROOT . '/source/8264/model/model.base.php');

		// 加载扩展类库
		if (!empty($config['external_libs'])) {
			foreach ($config['external_libs'] as $lib) {
				require ($lib);
			}
		}
		// 控制器名称、方法名称
		$default_ctl = $config['default_ctl'] ? $config['default_ctl'] : 'default';
		$default_act = $config['default_act'] ? $config['default_act'] : 'index';

		$ctl = isset($_REQUEST['ctl']) ? preg_replace('/(\W+)/', '', $_REQUEST['ctl']) : $default_ctl;
		$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : $default_act;

		// 请求控制器文件
		$app_file = $config['ctl_root'] . "/{$ctl}.ctl.php";
		if (!is_file($app_file)) {
			exit('Missing controller');
		}
		require ($app_file);
		define('CTL', $ctl);
		define('ACT', $act);

		// 实例化控制器，执行请求方法
		$ctl_class_name = ucfirst($ctl) . 'Ctl';
		$obj_ctl = new $ctl_class_name();
		c($obj_ctl);
		$obj_ctl->do_action($act);
		$obj_ctl->destruct();
	}

}

/**
 * 所有类的基础类
 *
 * @author Garbin
 * @usage none
 */
class Object {

	var $_errors = array();
	var $_errnum = 0;

	function __construct() {
		$this->Object();
	}

	function Object() {
		#TODO
	}

	/**
	 * 触发错误
	 *
	 * @author Garbin
	 * @param  string $errmsg
	 * @return void
	 */
	function _error($msg, $obj = '') {
		if (is_array($msg)) {
			$this->_errors = array_merge($this->_errors, $msg);
			$this->_errnum += count($msg);
		} else {
			$this->_errors[] = compact('msg', 'obj');
			$this->_errnum++;
		}
	}

	/**
	 * 检查是否存在错误
	 *
	 * @author Garbin
	 * @return int
	 */
	function has_error() {
		return $this->_errnum;
	}

	/**
	 * 获取错误列表
	 *
	 * @author Garbin
	 * @return array
	 */
	function get_error() {
		return $this->_errors;
	}

}

/**
 *  获取模型实例
 *
 *  @author rinne 130822
 *  @param string $model_name 模型名称
 *  @param array $params 模型成员变量默认值
 *  @param book $is_new 是否强行创建新实例
 *  @return object
 */
function m($model_name, $params = array(), $is_new = false) {
	static $models = array();
	$model_hash = md5($model_name . var_export($params, true));
	if ($is_new || !isset($models[$model_hash])) {
		$model_file = DISCUZ_ROOT . '/source/models/' . $model_name . '.model.php';
		if (!is_file($model_file)) {
			return false;
		}
		include_once ($model_file);
		$model_name = ucfirst($model_name) . 'Model';
		if ($is_new) {
			return new $model_name($params, db());
		}
		$models[$model_hash] = new $model_name($params, db());
	}

	return $models[$model_hash];
}

/**
 * 获取视图链接
 *
 * @author Garbin
 * @param  string $engine
 * @return object
 */
function v($is_new = false, $engine = 'default') {
	include_once (DISCUZ_ROOT . '/source/8264/view/template.php');
	if ($is_new) {
		return new TemplateBase();
	} else {
		static $v = null;
		if ($v === null) {
			switch ($engine) {
				case 'default':
					$v = new TemplateBase();
					break;
			}
		}

		return $v;
	}
}

/**
 * 存储当前控制器实例
 *
 * @author Garbin
 * @return void
 */
function c($ctl) {
	$GLOBALS['8264_CTL'] = $ctl;
}

/**
 * 获取当前控制器
 *
 * @author Garbin
 * @return Object
 */
function cc() {
	return $GLOBALS['8264_CTL'];
}

/**
 * 实例化数据库对象
 *
 * @author rinne 130822
 * @return object
 */
function db() {
//	include_once (DISCUZ_ROOT . '/source/8264/model/mysql.php');
	static $db = null;
	if ($db === null) {
		$dx = discuz_core::instance();
		$db = new db_mysql();
		$db->set_config($dx->config['db']);
		$db->connect();
	}

	return $db;
}

/**
 * 创建像这样的查询: "IN('a','b')";
 *
 * @access   public
 * @param mix   $item_list   列表数组或字符串,如果为字符串时,字符串只接受数字串
 * @param string   $field_name  字段名称
 * @author   wj
 *
 * @return   void
 */
function db_create_in($item_list, $field_name = '') {
	if (empty($item_list)) {
		return $field_name . " IN ('') ";
	} else {
		if (!is_array($item_list)) {
			$item_list = explode(',', $item_list);
			foreach ($item_list as $k => $v) {
				$item_list[$k] = intval($v);
			}
		}

		$item_list = array_unique($item_list);
		$item_list_tmp = '';
		foreach ($item_list as $item) {
			if ($item !== '') {
				$item_list_tmp .= $item_list_tmp ? ",'$item'" : "'$item'";
			}
		}
		if (empty($item_list_tmp)) {
			return $field_name . " IN ('') ";
		} else {
			return $field_name . ' IN (' . $item_list_tmp . ') ';
		}
	}
}

?>
