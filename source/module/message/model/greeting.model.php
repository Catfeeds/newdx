<?php
class Greeting_Model {
	var $table = 'home_poke';
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
		if(! $this->currentUid) return array();
		$start = ($page - 1) * $perPage;
		$sql = ('SELECT * FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} ORDER BY new DESC, dateline DESC LIMIT {$start}, {$perPage} ") . getSlaveID();
		$resource = DB::query($sql);
		$list = array();
		while ($value = DB::fetch($resource)) {
			$this->relatedUid[] = $value['fromuid'];//poke, fromuid
			$list[] = $value;
			if($value['new']) $this->news[] = $value['fromuid'];
		}
		$this->updateToReaded($this->news);
		return $list;
	}

	function updateToReaded($fromuids) {
		if(! $fromuids || ! $this->currentUid) return;
		$table = DB::table($this->table);
		if(is_array($fromuids)) {
			$this->toReadCount = count($fromuids);
			$fromuids = array_unique($fromuids);//the fromuids can contain the same value 'fromuid'
			$fromstr = implode(',', $fromuids);
			if($fromstr) DB::query("UPDATE {$table} SET new=0 WHERE uid={$this->currentUid} AND fromuid IN ({$fromstr})");
		}
		else {
			$this->toReadCount = 1;
			DB::query("UPDATE {$table} SET new=0 WHERE uid={$this->currentUid} AND fromuid='{$fromuids}'");
		}
	}

	function multiPage($page, $perPage) {
		$totalCount = $this->getTotalCount();
		return multi($totalCount, $perPage, $page, 'home.php?mod=space&do=notice&type=greeting');
	}

	function getTotalCount() {
		static $totalCount;
		if(! $totalCount) {
			$totalCount = $totalCount = DB::result_first('SELECT COUNT(*) FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} " . getSlaveID());
		}
		return $totalCount;
	}

	function delete_greeting($fuid) {
		if(! $this->currentUid || ! $fuid) return;
		$rsql = 'SELECT new FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} AND fromuid={$fuid} LIMIT 1 " . getSlaveID();
		$request = DB::result_first($rsql);
		if($request) $this->toReadCount = 1;
		DB::query('DELETE FROM ' . DB::table($this->table) . " WHERE uid={$this->currentUid} AND fromuid={$fuid} LIMIT 1 ");
	}

}