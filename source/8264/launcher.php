<?php

/**
 * ����������
 *
 * @author rinne 130822
 */
class Launcher {

	// ����
	static function startup($config = array()) {
		// ���ؿ���������
		require (DISCUZ_ROOT . '/source/8264/controller/controller.base.php');
		// ����ģ�ͻ���
		require (DISCUZ_ROOT . '/source/8264/model/model.base.php');

		// ������չ���
		if (!empty($config['external_libs'])) {
			foreach ($config['external_libs'] as $lib) {
				require ($lib);
			}
		}
		// ���������ơ���������
		$default_ctl = $config['default_ctl'] ? $config['default_ctl'] : 'default';
		$default_act = $config['default_act'] ? $config['default_act'] : 'index';

		$ctl = isset($_REQUEST['ctl']) ? preg_replace('/(\W+)/', '', $_REQUEST['ctl']) : $default_ctl;
		$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : $default_act;

		// ����������ļ�
		$app_file = $config['ctl_root'] . "/{$ctl}.ctl.php";
		if (!is_file($app_file)) {
			exit('Missing controller');
		}
		require ($app_file);
		define('CTL', $ctl);
		define('ACT', $act);

		// ʵ������������ִ�����󷽷�
		$ctl_class_name = ucfirst($ctl) . 'Ctl';
		$obj_ctl = new $ctl_class_name();
		c($obj_ctl);
		$obj_ctl->do_action($act);
		$obj_ctl->destruct();
	}

}

/**
 * ������Ļ�����
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
	 * ��������
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
	 * ����Ƿ���ڴ���
	 *
	 * @author Garbin
	 * @return int
	 */
	function has_error() {
		return $this->_errnum;
	}

	/**
	 * ��ȡ�����б�
	 *
	 * @author Garbin
	 * @return array
	 */
	function get_error() {
		return $this->_errors;
	}

}

/**
 *  ��ȡģ��ʵ��
 *
 *  @author rinne 130822
 *  @param string $model_name ģ������
 *  @param array $params ģ�ͳ�Ա����Ĭ��ֵ
 *  @param book $is_new �Ƿ�ǿ�д�����ʵ��
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
 * ��ȡ��ͼ����
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
 * �洢��ǰ������ʵ��
 *
 * @author Garbin
 * @return void
 */
function c($ctl) {
	$GLOBALS['8264_CTL'] = $ctl;
}

/**
 * ��ȡ��ǰ������
 *
 * @author Garbin
 * @return Object
 */
function cc() {
	return $GLOBALS['8264_CTL'];
}

/**
 * ʵ�������ݿ����
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
 * �����������Ĳ�ѯ: "IN('a','b')";
 *
 * @access   public
 * @param mix   $item_list   �б�������ַ���,���Ϊ�ַ���ʱ,�ַ���ֻ�������ִ�
 * @param string   $field_name  �ֶ�����
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
