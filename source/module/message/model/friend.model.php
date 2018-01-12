<?php
class Friend_Model {
	var $table = 'home_friend_request';
	var $relatedUid;
	var $news;
	var $currentUid;
	var $toReadCount;

	function __construct($page=1, $perPage=10) {
		global $_G;
		$this->currentUid = $_G['uid'];
		$this->toReadCount = 0;
	}

	function getDataList($page, $perPage) {
		if(! $this->currentUid) return;
		$start = ($page - 1) * $perPage;
		$sql = ('SELECT * FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} ORDER BY new DESC, dateline DESC LIMIT {$start}, {$perPage} ") . getSlaveID();
		$resource = DB::query($sql);
		$list = array();
		while ($value = DB::fetch($resource)) {
			$list[] = $value;
			//if($value['new']) $this->news[] = $value['fuid'];
		}
		//$this->updateToReaded($this->news);
		return $list;
	}

	function updateToReaded($fromuids) {
		if(! $fromuids || ! $this->currentUid) return;
		$table = DB::table($this->table);
		if(is_array($fromuids)) {
			$this->toReadCount = count($fromuids);
			$fromstr = implode(',', $fromuids);
			if($fromstr) DB::query("UPDATE {$table} SET new=0 WHERE uid={$this->currentUid} AND fuid IN ({$fromstr})");
		}
		else {
			$this->toReadCount = 1;
			DB::query("UPDATE {$table} SET new=0 WHERE uid={$this->currentUid} AND fuid='{$fromuids}'");
		}
	}

	function multiPage($page, $perPage) {
		$totalCount = $this->getTotalCount();
		return multi($totalCount, $perPage, $page, 'home.php?mod=space&do=notice&type=friend');
	}

	function getTotalCount() {
		static $totalCount;
		if(! $totalCount) {
			$totalCount = $totalCount = DB::result_first('SELECT COUNT(*) FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} " . getSlaveID());
		}
		return $totalCount;
	}

	function delete_request($fuid) {
		if(! $this->currentUid || ! $fuid) return;
/*		$rsql = 'SELECT new FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} AND fuid={$fuid} LIMIT 1 " . getSlaveID();
		$request = DB::result_first($rsql);
		if($request) $this->toReadCount = 1;*/
		DB::query('DELETE FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} AND fuid={$fuid} LIMIT 1 ");
	}
}