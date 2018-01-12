<?php
require MESSAGE_DIR . 'model/' . $notify_type . '.model.php';
class Greeting_Controller {
	var $mname = 'greeting';
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
		//template: home/spacecp_poke_type
		$icons = array(
					0 => '���ö���',
					1 => '<img alt="cyx" src="http://static.8264.com/static/image/poke/cyx.gif" class="vm" /> ��һ��',
					2 => '<img alt="wgs" src="http://static.8264.com/static/image/poke/wgs.gif" class="vm" /> �ո���',
					3 => '<img alt="wx" src="http://static.8264.com/static/image/poke/wx.gif" class="vm" /> ΢Ц',
					4 => '<img alt="jy" src="http://static.8264.com/static/image/poke/jy.gif" class="vm" /> ����',
					5 => '<img alt="pmy" src="http://static.8264.com/static/image/poke/pmy.gif" class="vm" /> ������',
					6 => '<img alt="yb" src="http://static.8264.com/static/image/poke/yb.gif" class="vm" /> ӵ��',
					7 => '<img alt="fw" src="http://static.8264.com/static/image/poke/fw.gif" class="vm" /> ����',
					8 => '<img alt="nyy" src="http://static.8264.com/static/image/poke/nyy.gif" class="vm" /> ������',
					9 => '<img alt="gyq" src="http://static.8264.com/static/image/poke/gyq.gif" class="vm" /> ��һȭ',
					10 => '<img alt="dyx" src="http://static.8264.com/static/image/poke/dyx.gif" class="vm" /> ��һ��',
					11 => '<img alt="yw" src="http://static.8264.com/static/image/poke/yw.gif" class="vm" /> ����',
					12 => '<img alt="ppjb" src="http://static.8264.com/static/image/poke/ppjb.gif" class="vm" /> ���ļ��',
					13 => '<img alt="yyk" src="http://static.8264.com/static/image/poke/yyk.gif" class="vm" /> ҧһ��'
				);
		if($count < $perPage) {
			return array('datalist' => $datalist, 'toReadCount' => $this->model->toReadCount, 'status_key' => 'pokes',
				'friends_list' => $friends, 'icons' => $icons);
		}
		else {
			return array('datalist' => $datalist, 'multi' => $this->model->multiPage($page, $perPage), 'toReadCount' => $this->model->toReadCount,
				'status_key' => 'pokes', 'friends_list' => $friends, 'icons' => $icons);
		}

	}
	//delete request: ajax
	function delete() {
		$fuid = $_GET['uid'];
		$this->model->delete_greeting($fuid);
		if($this->model->toReadCount) {
			return array('toReadCount' => $this->model->toReadCount, 'status_key' => 'pokes', 'exit' => 'success');
		}
		else {
			exit('success');
		}
	}
}
