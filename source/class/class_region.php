<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 地区库类
 */

class region
{

	private $regionTree;

	public function init()
	{
		$regions = memory('get', 'cache_region_data');
		require_once libfile('class/tree');
		$this->regionTree = new tree;
		if (! $regions)
		{
			$q = DB::query("SELECT * FROM ".DB::table('dianping_shop_region'));
			while ($v = DB::fetch($q))
			{
				$regions[$v['catid']] = $v;
			}
			memory('set', 'cache_region_data', $regions, 3600 * 24);
		}
		foreach ($regions as $k => $v)
		{
			$this->regionTree->setNode($k, $v['upid'], $v['name']);
		}
	}

	public static function instance()
	{
		static $regionobj;
		if (empty($regionobj))
		{
			$regionobj = new region;
			$regionobj->init();
		}
		return $regionobj;
	}

	public function getNameById($id)
	{
		return $this->regionTree->getValue($id);
	}

	public function getChild($id, $returncount = false, $sort = false)
	{
		$childs = $this->regionTree->getChild($id);
		$return = array();
		foreach ($childs as $child)
		{
			$returncount && $return[$child]['count'] = count($this->regionTree->getChild($child));
			$return[$child]['name'] = self::getNameById($child);
		}
		$sort && uasort($return, array($this, 'comparecount'));
		return $return;
	}

	public function getParent($id){
		$parent = $this->regionTree->getParent($id);
		return $parent >= 0 ? $parent : 0;
	}

	private function comparecount($a, $b)
	{
		if ($a['count'] == $b['count'])
			return 0;
		return $a['count'] > $b['count'] ? -1 : 1;
	}
	
	public function getRegionByIp($ip){
		require_once libfile('function/misc');
		$cityname = trim(convertip($ip));
		$defaultcity = array('name' => '北京');
		foreach($this->regionTree->data as $id => $name){
			if(stripos($cityname, $name) !== false){
				return array('id' => $id, 'name' => $name);
			}
			if($name == $defaultcity['name']) $defaultcity['id'] = $id;
		}
		return $defaultcity;
	}
}

?>