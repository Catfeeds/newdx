<?php


class DemoCtl extends BackendCtl {
	function index() {
		$mod_m = m('demo');
		shownav('modules', 'nav_modules_demo');
		$arr_m = $mod_m->find();
		$this->assign('data', $arr_m);
		$this->display('forum/demo');
	}
	function test() {
		cpmsg('update_cache_succeed', 'ctl=demo', 'succeed');
	}
}

?>