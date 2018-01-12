<?php

/**
 * ����������
 *
 * @author 8264TEAM
 * @usage none
 */
class BaseCtl extends Object {

	var $_view = null;
	var $_ctl = null;
	function __construct() {
//		$this->_run_cron();
	}

	/**
	 * ��ʼ��Session
	 *
	 * @author 8264TEAM
	 * @param none
	 * @return void
	 */
	function _init_session() {

	}

	/**
	 * ����ͼ���ݱ���
	 *
	 * @author 8264TEAM
	 * @param string $k
	 * @param mixed  $v
	 * @return void
	 */
	function assign($k, $v = null) {
		$this->_init_view();
		if (is_array($k)) {
			$args = func_get_args();
			// ��������
			foreach ($args as $arg) {
				// �������ݲ�������ͼ
				foreach ($arg as $key => $value) {
					$this->_view->assign($key, $value);
				}
			}
		} else {
			$this->_view->assign($k, $v);
		}
	}

	/**
	 * ��ʼ����ͼ����
	 *
	 * @author 8264TEAM
	 * @param none
	 * @return void
	 */
	function _init_view() {
		if ($this->_view === null) {
			$this->_view = v();
			$this->_config_view();
		}
	}

	/**
	 * ������ͼ
	 *
	 * @author 8264TEAM
	 * @return void
	 */
	function _config_view() {
		# code...
	}

	/**
	 * ת����ģ��
	 *
	 * @author 8264TEAM
	 * @param none
	 * @return void
	 */
	function do_action($action) {
		if ($action && $action{0} != '_' && method_exists($this, $action)) {
			$this->_curr_action = $action;
			// ���ж���
			$this->_run_action();
		} else {
			exit('missing_action');
		}
	}

	function _run_action() {
		if ($this->_hook('on_run_action')) {
			return;
		}

		$action = $this->_curr_action;
		$this->$action();

		if ($this->_hook('end_run_action')) {
			return;
		}
	}

	/**
	 * �������������к�ִ��
	 *
	 * @author 8264TEAM
	 * @return void
	 */
	function destruct() {

	}

	/**
	 * ���
	 *
	 * @author 8264TEAM
	 * @param none
	 * @return void
	 */
	function _hook($event, $data = array()) {
		static $plugins = null;
		if ($plugins === null) {
			// ��ȡ����б�
//			$plugins = get_setting('plugin');
//			$plugins = array('on_run_action' => array('demo' => array()));
			if (!is_array($plugins)) {
				$plugins = false;
			}
		}
		// ��ȡ���ò���б�
		$plugin_list = $plugins[$event];
		// �������б�û�з��ϸù��ӵĲ����ִ��
		if (!isset($plugin_list) || empty($plugin_list)) {
			return null;
		}

		foreach ($plugin_list as $plugin_name => $plugin_info) {
			// ���������ļ�
			$plugin_main_file = DISCUZ_ROOT . "/source/plugins/{$plugin_name}/main.plugin.php";
			if (is_file($plugin_main_file)) {
				include_once($plugin_main_file);
			}
			// ʵ�������
			$plugin_class_name = ucfirst($plugin_name) . 'Plugin';
			$plugin = new $plugin_class_name($data, $plugin_info);

			// ����һ���������Ҫֹͣ��ǰ������������᷵��true
			$stop_flow = $plugin->execute();

			// ֹͣԭ����������
			if ($stop_flow) {
				return $stop_flow;
			}
		}
	}

	/**
	 * ģ����ʾ
	 *
	 * @param string $f ģ���ļ�·��
	 */
	function display($f) {
		if ($this->_hook('on_display', array('display_file' => $f))) {
			return;
		}
		$this->_assign_query_info();

		$this->_init_view();
		$this->_view->display($f);

		if ($this->_hook('end_display', array('display_file' => $f))) {
			return;
		}
	}

	/**
	 * ҳ����ʾǰ���õ���Ϣ
	 *
	 * @author rinne 130826
	 */
	function _assign_query_info() {
		// �ڴ�ռ�����
		if (function_exists('memory_get_usage')) {
			$this->assign('memory_info', memory_get_usage() / 1048576);
		}

		//$this->assign('site_domain', urlencode(get_domain()));
	}

	/**
	 * �ƻ������ػ�����
	 *
	 * @author 8264TEAM
	 * @return void
	 */
	function _run_cron() {
//		register_shutdown_function(create_function('', ''));
	}
	
	/**
	 * ���ڻ�ȡ��ǰ��������
	 * @author JiangHong
	 */
	function __toString(){
		return $this->_ctl;
	}
	
	/**
	 * @todo ���ڷ��ظ���url����д������������ת
	 * @author JiangHong
	 * @param String $url
	 * @return String
	 */
	function _get_myRewrite($url){
		$this->_init_view();
		return $this->_view->getUrlRewrite($url);
	}
}

?>
