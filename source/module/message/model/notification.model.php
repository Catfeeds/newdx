<?php
class Notification_Model {
	var $table = 'home_notification';
	var $relatedUid;
	var $news;
	var $currentUid;
	var $toReadCount;
	var $currentIp;

	function __construct() {
		global $_G;
		$this->currentUid = $_G['uid'];
		$this->toReadCount = 0;
		$this->currentIp = $_G['clientip'];
	}
	function getDataList($page, $perPage) {
		if(! $this->currentUid) return array();
		$start = ($page- 1) * $perPage;
		$sql = 'SELECT * FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} ORDER BY new DESC, dateline DESC LIMIT {$start}, {$perPage} " . getSlaveID();
		$resource = DB::query($sql);
		$list = array();
		/*$myline = getMyLine(1, $this->currentUid, true);
		if($myline){
			foreach($myline as $vv){
				if(getcookie('hidden_line_id_' . $vv[linemod::_ID]) != 1){
					$list[] = array(
							'type' => 'system',
							'id' => 'line_' . $vv[linemod::_ID],
							'new' => 1,
							'othertype' => 'lineplugin',
							'lineid' => $vv[linemod::_ID],
							'linepos' => $vv[linemod::_POS],
							'dateline' => time(),
							'note' => ltrim(date('m 月 d 日', $vv[linemod::_TIME_START]), '0') . "<a href='http://bbs.8264.com/plugin.php?id=interests:go&goid=" . $vv[linemod::_ID] . "' target='_blank'>" . $vv[linemod::_NAME] . "</a>开始招募，快来报名吧！");
					}
				}
		}*/
		$recordme = false;
		while ($value = DB::fetch($resource)) {
			$this->relatedUid[] = $value['authorid'];
			if($value['type'] == 'zw'){
				if(!$recordme){
					require_once DISCUZ_ROOT . "./source/plugin/interests/model/historymod.php";
					$recordme = true;
				}
				$value['linepos'] = 1;
				$value['infoobj'] = json_decode($value['note'], true);
				$value['infoobj']['linename'] = urldecode($value['infoobj']['linename']);
				historymod::recordhistory($this->currentUid, $value['infoobj']['lineid'], $this->currentIp, 1, 2);
				//echo "<pre>";var_dump($value);echo "</pre>";
			}
			$list[] = $value;
			if($value['new']) $this->news[] = $value['id'];
		}
		$this->updateToReaded($this->news);
		return $list;
	}

	function updateToReaded($fromids, $type='notification') {
		if(! $fromids || ! $this->currentUid) return;
		$table = DB::table($this->table);

		if(is_array($fromids)) {
			$this->toReadCount = count($fromids);
			$fromstr = implode(',', $fromids);
			if($fromstr) DB::query("UPDATE {$table} SET new=0, from_num=0 WHERE id IN ({$fromstr})");
		}
		else {
			$this->toReadCount = 1;
			DB::query("UPDATE {$table} SET new=0, from_num=0 WHERE id='{$fromids}'");
		}
	}

	function multiPage($page=1, $perPage=10) {
		$totalCount = $this->getTotalCount();
		return multi($totalCount, $perPage, $page, 'home.php?mod=space&do=notice&type=notification');
	}

	function getTotalCount() {
		static $totalCount;
		if(! $totalCount) {
			$totalCount = DB::result_first('SELECT COUNT(*) FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} " . getSlaveID());
		}
		return $totalCount;
	}
}