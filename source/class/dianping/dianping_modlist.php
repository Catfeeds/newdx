<?php
/**
 * 点评列表处理
 */

if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

class modlist
{
	var $recordnum = 0;

	function getlist($modname, $cols, $where = 1, $start = 0, $limit = 5, $orderby, $leftjoin, $multipage = 0)
	{
		$cols = $cols ? ','.$cols : '';
		$sql = "SELECT i.tid, i.subject, i.showimg, i.dir, i.serverid, i.score, i.cnum $cols FROM ".DB::table("dianping_{$modname}_info")." AS i ".
			($leftjoin ? $leftjoin : '')."
			WHERE $where
			".($orderby ? ' ORDER BY '.$orderby : '').
			($limit ? " LIMIT $start, $limit " : ' ').getSlaveID();
		if($multipage)
		{
			$this->recordnum = memory('get','dp_'.$modname.'_recordnum_'.substr(md5($where), 0, 5));
			if(!$this->recordnum) {
				$this->recordnum = DB::result(DB::query("SELECT count(*) FROM ".DB::table("dianping_{$modname}_info")." AS i ".
					($leftjoin ? $leftjoin : '')."
					WHERE $where ".getSlaveID()));
				memory('set','dp_'.$modname.'_recordnum_'.substr(md5($where), 0, 5), $this->recordnum, 3600);
			}
		}
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;
	}
	function getbrand_name($letter1,$letter2,$letter3,$letter4,$letter5,$letter6,$letter7){
		
		$sql = "select id,subject from ".DB::table("dianping_brand_info")." where letter = '".$letter1."' or letter = '".$letter2."' 
				or letter = '".$letter3."' or letter = '".$letter4."' or letter = '".$letter5."' or letter = '".$letter6."' or letter = '".$letter7."' order by letter asc";
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;
		
	}
	function getbrandname($brandname){
		
		$sql = "select id,subject from ".DB::table("dianping_brand_info")." where subject like '%".$brandname."%' order by id asc";
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;
		
	}
	function getbrandindex(){
		$sql = "SELECT distinct i.tid, i.subject, i.showimg, i.dir,i.cname,i.nation, i.serverid, i.score, i.cnum FROM ".DB::table("dianping_brand_info")." as i LEFT JOIN ".DB::table("forum_post")." as p on i.tid= p.tid where p.fid='408' and p.rate=1 ORDER BY p.pid desc limit 0,3";
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;

	}
	function getequipmentindex(){
		$sql = "SELECT distinct i.tid, i.subject, i.showimg, i.brandname,i.brandid,i.pcname,i.dir,i.serverid,i.score, i.cnum FROM ".DB::table("dianping_equipment_info")." as i LEFT JOIN ".DB::table("forum_post")." as p on i.tid= p.tid where p.fid='490' and p.rate=1 ORDER BY p.pid desc limit 0,3";
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;

	}
	function getmountainindex(){
		$sql = "SELECT distinct i.tid, i.subject, i.showimg,i.type,i.height,i.season,i.dir,i.serverid,i.score, i.cnum FROM ".DB::table("dianping_mountain_info")." as i LEFT JOIN ".DB::table("forum_post")." as p on i.tid= p.tid where p.fid='392' and p.rate=1 ORDER BY p.pid desc limit 0,3";
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;

	}
	function getdivingindex(){
		$sql = "SELECT distinct i.tid, i.subject, i.showimg,i.type,i.provinceid,i.cityid,i.dir,i.serverid,i.score, i.cnum FROM ".DB::table("dianping_diving_info")." as i LEFT JOIN ".DB::table("forum_post")." as p on i.tid= p.tid where p.fid='498' and p.rate=1 ORDER BY p.pid desc limit 0,3";
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;

	}

	function getclimbindex($lat,$lng){
		$blng = $lng +50;
		$slng = $lng -50;
		$blat = $lat +20;
		$slat = $lat-5;
		$sql = "SELECT i.tid, i.subject, i.showimg,i.type,i.placetype,i.provinceid,i.cityid,i.dir,i.serverid,i.score, i.cnum FROM ".DB::table("dianping_climb_info")." as i 
		LEFT JOIN ".DB::table("forum_post")." as p on i.tid= p.tid where i.lon<'".$blng."' and i.lon>'".$slng."' and i.lat<'".$blat."' and i.lat>'".$slat."' and p.fid='497' and p.rate=1 ORDER BY p.pid desc limit 0,1";
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;
	}
	function getskiingindex($lat,$lng){
		$blng = $lng +50;
		$slng = $lng -50;
		$blat = $lat +20;
		$slat = $lat-5;
		$sql = "SELECT i.tid, i.subject, i.showimg,i.dir,i.serverid,i.score, i.cnum FROM ".DB::table("dianping_skiing_info")." as i 
		LEFT JOIN ".DB::table("forum_post")." as p on i.tid= p.tid where i.lon<'".$blng."' and i.lon>'".$slng."' and i.lat<'".$blat."' and i.lat>'".$slat."' and p.fid='477' and p.rate=1 ORDER BY p.pid desc limit 0,1";
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;
	}
	function getbrandename($brandid){
		$sql = "select ename from ".DB::table("dianping_brand_info")." where id = '".$brandid."'";
		$query = DB::query($sql);
		$row = DB::fetch($query);
		return $row;
	}

}
?>
