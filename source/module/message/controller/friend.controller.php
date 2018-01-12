<?php
require MESSAGE_DIR . 'model/' . $notify_type . '.model.php';
class Friend_Controller {
	var $mname = 'friend';
	var $model;
	function __construct() {
		$m = ucfirst($this->mname) . '_Model';
		$this->model = new $m;
	}
	function show() {
		$page = $_GET['page'] <= 0 ? 1 :  intval($_GET['page']);
		$perPage = 20;
		$datalist = $this->model->getDataList($page, $perPage);
		$count = $this->model->getTotalCount();
		if($count < $perPage) {
			return array('datalist' => $datalist);
		}
		else {
			return array('datalist' => $datalist, 'multi' => $this->model->multiPage($page, $perPage));
		}
		
	}
	//delete request: ajax
	function delete() {
		$fuid = $_GET['uid'];
		$this->model->delete_request($fuid);
		exit('success');
	}
}