<?php

/**
 * 控制器基类
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
	 * 初始化Session
	 *
	 * @author 8264TEAM
	 * @param none
	 * @return void
	 */
	function _init_session() {

	}

	/**
	 * 给视图传递变量
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
			// 遍历参数
			foreach ($args as $arg) {
				// 遍历数据并传给视图
				foreach ($arg as $key => $value) {
					$this->_view->assign($key, $value);
				}
			}
		} else {
			$this->_view->assign($k, $v);
		}
	}

	/**
	 * 初始化视图连接
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
	 * 配置视图
	 *
	 * @author 8264TEAM
	 * @return void
	 */
	function _config_view() {
		# code...
	}

	/**
	 * 转发至模块
	 *
	 * @author 8264TEAM
	 * @param none
	 * @return void
	 */
	function do_action($action) {
		if ($action && $action{0} != '_' && method_exists($this, $action)) {
			$this->_curr_action = $action;
			// 运行动作
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
	 * 控制器结束运行后执行
	 *
	 * @author 8264TEAM
	 * @return void
	 */
	function destruct() {

	}

	/**
	 * 插件
	 *
	 * @author 8264TEAM
	 * @param none
	 * @return void
	 */
	function _hook($event, $data = array()) {
		static $plugins = null;
		if ($plugins === null) {
			// 获取插件列表
//			$plugins = get_setting('plugin');
//			$plugins = array('on_run_action' => array('demo' => array()));
			if (!is_array($plugins)) {
				$plugins = false;
			}
		}
		// 获取可用插件列表
		$plugin_list = $plugins[$event];
		// 如果插件列表没有符合该钩子的插件则不执行
		if (!isset($plugin_list) || empty($plugin_list)) {
			return null;
		}

		foreach ($plugin_list as $plugin_name => $plugin_info) {
			// 引入插件主文件
			$plugin_main_file = DISCUZ_ROOT . "/source/plugins/{$plugin_name}/main.plugin.php";
			if (is_file($plugin_main_file)) {
				include_once($plugin_main_file);
			}
			// 实例化插件
			$plugin_class_name = ucfirst($plugin_name) . 'Plugin';
			$plugin = new $plugin_class_name($data, $plugin_info);

			// 返回一个结果，若要停止当前控制器流程则会返回true
			$stop_flow = $plugin->execute();

			// 停止原控制器流程
			if ($stop_flow) {
				return $stop_flow;
			}
		}
	}

	/**
	 * 模板显示
	 *
	 * @param string $f 模板文件路径
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
	 * 页面显示前需获得的信息
	 *
	 * @author rinne 130826
	 */
	function _assign_query_info() {
		// 内存占用情况
		if (function_exists('memory_get_usage')) {
			$this->assign('memory_info', memory_get_usage() / 1048576);
		}

		//$this->assign('site_domain', urlencode(get_domain()));
	}

	/**
	 * 计划任务守护进程
	 *
	 * @author 8264TEAM
	 * @return void
	 */
	function _run_cron() {
//		register_shutdown_function(create_function('', ''));
	}
	
	/**
	 * 用于获取当前控制器名
	 * @author JiangHong
	 */
	function __toString(){
		return $this->_ctl;
	}
	
	/**
	 * @todo 用于返回个别url的重写，例如用于跳转
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
