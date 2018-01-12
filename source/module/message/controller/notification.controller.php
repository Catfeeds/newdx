<?php
require MESSAGE_DIR . 'model/' . $notify_type . '.model.php';
class Notification_Controller {
	var $mname = 'notification';
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

		if($this->model->relatedUid) {
			require_once libfile('function/friend');
			$friends = check_followed_by_fwuid($this->model->currentUid, $this->model->relatedUid);
		}
		
		if($count < $perPage) {
			return array('datalist' => $datalist, 'toReadCount' => $this->model->toReadCount, 'status_key' => 'notifications', 'friends_list' => $friends);
		}
		else {
			return array('datalist' => $datalist, 'multi' => $this->model->multiPage($page, $perPage), 'toReadCount' => $this->model->toReadCount, 'status_key' => 'notifications', 'friends_list' => $friends);
		}
		
	}
}