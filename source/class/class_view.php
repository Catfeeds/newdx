<?php
/*author: linsheng.wu
* date: 2014.6.16
*/
class View {
	//get view from htm.
	static function v($path, $params) {
		$file = $path . '.htm';
		if(! file_exists($file)) {
			error_log("$file does not exist in your project!");
			return "Default View";
		}
		$params = is_array($params) ? $params : (array)$params;
		extract($params);
		ob_start();
		include_once $file;
		$content = ob_get_contents();
		ob_end_clean();
		return $content ? : 'Default View';
	}

	function __toString() {
		error_log('__toString');
	}
}