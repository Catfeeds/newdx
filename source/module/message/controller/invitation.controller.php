<?php
require MESSAGE_DIR . 'model/' . $notify_type . '.model.php';
class Invitation_Controller {
	var $mname = 'invitation';
	var $model;
	function __construct() {
		$m = ucfirst($this->mname) . '_Model';
		$this->model = new $m;
	}

	function show() {
		$page = max(intval($_GET['page']), 1);
		$perPage = 10;
		$totalCount = $this->model->getTotalCount();
		$datalist = $this->model->getDataList($page, $perPage);

		return array('datalist' => $datalist, 'multi' => multi($totalCount, $perPage, $page, 'home.php?mod=space&do=notice&type=invitation'), 'toReadCount' => $this->model->toReadCount, 'status_key' => 'newinvite');
	}

	function deleteAll() {
		$mids = $_POST['mids'];
		$this->model->delete($mids);
		exit('success');
	}

	function delete() {
		$mid = $_GET['mid'];
		$this->model->delete($mid);
		exit('success');
	}
}
