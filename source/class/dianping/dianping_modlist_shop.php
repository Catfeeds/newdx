<?php
/**
 * 点评列表处理
 */

if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/class/dianping/dianping_modlist.php';
class modlist_shop extends modlist
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
			$this->recordnum = DB::result(DB::query("SELECT count(*) FROM ".DB::table("dianping_{$modname}_info")." AS i ".
			($leftjoin ? $leftjoin : '')."
			WHERE $where ".getSlaveID()));
		}
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;
	}
	function getregion(){
		$array=array();
		$regionsql ='SELECT * FROM '.DB::table('dianping_shop_region').' ORDER BY catid ASC '.getSlaveID();
		$region_array=DB::query($regionsql);

		while ($row = DB::fetch($region_array)){
			if($row['upid']==0){
				$array[$row['catid']]['name']=$row['name'];
			}elseif($row['upid']!=0) {
				$array[$row['upid']]['city'][$row['catid']]['cityname'] = $row['name'];
			}

		}
		$marketsql ='SELECT i.provinceid,i.regionid,m.* FROM '.
					DB::table('dianping_shop_info').' as i left join '.
					DB::table('dianping_shop_market').' as m on i.marketid=m.id where i.ispublish=1 group by i.marketid '.getSlaveID();
		$market_array=DB::query($marketsql);

		while ($row = DB::fetch($market_array)){
			$array[$row['provinceid']]['city'][$row['regionid']]['market'][$row['id']] = $row['market'];
		}

		$brandtsql ='SELECT  i.provinceid,i.regionid,b.* FROM '.
					DB::table('dianping_shop_info').' as i left join '.
					DB::table('dianping_shop_brand').' as b on i.sbrandid=b.id where i.ispublish=1 group by i.sbrandid '.getSlaveID();
		$brandarray=DB::query($brandtsql);

		while ($row = DB::fetch($brandarray)){
			$array[$row['provinceid']]['city'][$row['regionid']]['brand'][$row['id']] = $row['brand'];
		}

		return $array;

	}

	/***
	 * 获得商场和品牌信息
	 */
	public function getBrandMarket($pid=0,$rid=0,$region_array){
		$brand_array = array();
		if($pid!=0 && $rid!=0){
			$market_array = array();
			$market_array= $region_array[$pid]['city'][$rid]['market'];
			$brand_array = $region_array[$pid]['city'][$rid]['brand'];
		}elseif($pid!=0){
				$market_array = array();
				foreach ($region_array[$pid]['city'] as $value){

					if ($value['market']){
						$market_array=$market_array+$value['market'];

					}
					if ($value['brand']){
						$brand_array = $brand_array+$value['brand'];
					}

				}
		}elseif($rid==0 && $pid == 0){

			foreach ($region_array as $key=>$value){

				if($value['city']){

					foreach ($value['city'] as $k=>$v){

						if ($v['brand']){
							$brand_array = $brand_array+$v['brand'];;
						}
					}
				}
			}

		}
		return  array('brand_array'=>$brand_array,'market_array'=>$market_array);

	}


}
?>
