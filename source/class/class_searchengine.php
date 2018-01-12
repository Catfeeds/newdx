<?php

/**
 * @author JiangHong
 * @copyright 2015
 * 搜索引擎类，用于提供搜索结果。
 */
require_once 'sphinxapi.php';
class searchengine
{
	const SEARCH_TYPE_USER					= 1;
	const SEARCH_TYPE_THREADTITLE			= 2;
	const SEARCH_TYPE_THREADCONTENT 		= 4;
	const SEARCH_TYPE_PORTAL				= 3;
	const SEARCH_TYPE_BBS					= 5;
	const SEARCH_TYPE_ALL					= 0;

	const SEARCH_INDEX_ALL					= '*';
	const SEARCH_INDEX_MUDIDI				= 'mudidiindex';
	const SEARCH_INDEX_THREAD_POST			= 'threadmainindex threaddeltaindex postmainindex postdeltaindex';	
	const SEARCH_INDEX_USER_MAIN			= 'usermainindex';
	const SEARCH_INDEX_USER_DELTA			= 'userdeltaindex';
	const SEARCH_INDEX_USER					= 'usermainindex userdeltaindex';
	const SEARCH_INDEX_THREAD_MAIN			= 'threadmainindex';
	const SEARCH_INDEX_THREAD_DELTA			= 'threaddeltaindex';
	const SEARCH_INDEX_THREAD				= 'threadmainindex threaddeltaindex';
	const SEARCH_INDEX_POST_MAIN			= 'postmainindex';
	const SEARCH_INDEX_POST_DELTA			= 'postdeltaindex';
	const SEARCH_INDEX_POST					= 'postmainindex postdeltaindex';
	const SEARCH_INDEX_PORTAL_MAIN			= 'portalmainindex';
	const SEARCH_INDEX_PORTAL_DELTA			= 'portaldeltaindex';
	const SEARCH_INDEX_PORTAL				= 'portalmainindex portaldeltaindex';
	
	const RETURN_TYPE_ID					= 'id';
	const RETURN_TYPE_WEIGHT				= 'weight';
	const RETURN_TYPE_ATTR					= 'attrs';
	const RETURN_ATTR_TIME					= 'findtime';
	const RETURN_ATTR_TYPE					= 'findtype';
	
	private $searchmode = SPH_MATCH_ANY;
	private $returnarray = true;
	public $searchcore;
	private $host = '27.112.8.19';
	private $port = 9312;
	private $timeout = 5;
	
	public function __construct()
	{
		$this->searchcore = new SphinxClient;
	}
	
	public function setmatchmode($newmode)
	{
		$allmode = array(
					SPH_MATCH_ALL,
					SPH_MATCH_ANY,
					SPH_MATCH_BOOLEAN,
					SPH_MATCH_EXTENDED,
					SPH_MATCH_EXTENDED2,
					SPH_MATCH_FULLSCAN,
					SPH_MATCH_PHRASE);
		if(in_array($newmode, $allmode))
		{
			$this->searchmode = $newmode;
		}
	}
	
	public function setreturnarray($ifarray = true)
	{
		$this->returnarray = $ifarray;
	}
	
	public function sethost($host)
	{
		$this->host = $host;
	}
	
	public function setport($port)
	{
		$this->port = $port;
	}
	
	public function init()
	{
		$this->searchcore->SetServer($this->host, $this->port);
		$this->searchcore->SetMatchMode($this->searchmode);
		$this->setreturnarray($this->returnarray);
	}
	
	public function query($string, $type, $limit = 10, $offset = 0)
	{
		if(empty($this->host) || empty($this->port))
		{
			global $_G;
			$this->sethost($_G['config']['coreseek']['host']);
			$this->setport($_G['config']['coreseek']['port']);
		}		
		$this->searchcore->SetLimits($offset, $limit);
		$this->init();
		$string = iconv('GBK', 'UTF-8', $string);
		$result = $this->searchcore->Query($string, $type);
		foreach($result['words'] as $_k => $_v)
		{
			$result['words'][iconv('UTF-8', 'GBK', $_k)] = $_v;
			unset($result['words'][$_k]);
		}
		return $result;
	}
	
	public function setfilterrange($attr, $min, $max, $notin = false)
	{
		$this->searchcore->SetFilterRange($attr, $min, $max, $notin);
	}
	
	public static function simplequery($findstring, $type, $limit = 10, $offset = 0)
	{
		$core = new searchengine;
		return $core->query($findstring, $type, $limit, $offset);
	}
	
	public static function querythread($findstring, $limit = 10, $offset = 0)
	{
		$core = new searchengine;
		return $core->query($findstring, searchengine::SEARCH_INDEX_THREAD_MAIN, $limit, $offset);
	}
	
	public static function querypost($findstring, $limit = 10, $offset = 0)
	{
		$core = new searchengine;
		return $core->query($findstring, searchengine::SEARCH_INDEX_POST, $limit, $offset);
	}
	
	public static function queryuser($findstring, $limit = 10, $offset = 0)
	{
		$core = new searchengine;
		return $core->query($findstring, searchengine::SEARCH_INDEX_USER, $limit, $offset);
	}
	
	public static function queryportal($findstring, $limit = 10, $offset = 0)
	{
		$core = new searchengine;
		return $core->query($findstring, searchengine::SEARCH_INDEX_PORTAL, $limit, $offset);
	}
	
	public static function querybbs($findstring, $limit = 10, $offset = 0)
	{
		$core = new searchengine;
		return $core->query($findstring, searchengine::SEARCH_INDEX_THREAD_POST, $limit, $offset);
	}
	
	public static function querythreadbytime($findstring, $mintime, $maxtime, $limit, $offset = 0)
	{
		$core = new searchengine;
		if($maxtime == 0)
		{
			$maxtime = time();
		}
		$core->setfilterrange(self::RETURN_ATTR_TIME, $mintime, $maxtime);
		return $core->query($findstring, searchengine::SEARCH_INDEX_THREAD, $limit, $offset);
	}
	
	public static function querypostbytime($findstring, $mintime, $maxtime, $limit, $offset = 0)
	{
		$core = new searchengine;
		if($maxtime == 0)
		{
			$maxtime = time();
		}
		$core->setfilterrange(self::RETURN_ATTR_TIME, $mintime, $maxtime);
		return $core->query($findstring, searchengine::SEARCH_INDEX_POST, $limit, $offset);
	}
	
	public static function queryuserbytime($findstring, $mintime, $maxtime, $limit, $offset = 0)
	{
		$core = new searchengine;
		if($maxtime == 0)
		{
			$maxtime = time();
		}
		$core->setfilterrange(self::RETURN_ATTR_TIME, $mintime, $maxtime);
		return $core->query($findstring, searchengine::SEARCH_INDEX_USER, $limit, $offset);
	}
	
	public static function queryportalbytime($findstring, $mintime, $maxtime, $limit, $offset = 0)
	{
		$core = new searchengine;
		if($maxtime == 0)
		{
			$maxtime = time();
		}
		$core->setfilterrange(self::RETURN_ATTR_TIME, $mintime, $maxtime);
		return $core->query($findstring, searchengine::SEARCH_INDEX_PORTAL, $limit, $offset);
	}
	
	public static function querybbsbytime($findstring, $mintime, $maxtime, $limit, $offset = 0)
	{
		$core = new searchengine;
		if($maxtime == 0)
		{
			$maxtime = time();
		}
		$core->setfilterrange(self::RETURN_ATTR_TIME, $mintime, $maxtime);
		return $core->query($findstring, searchengine::SEARCH_INDEX_THREAD_POST, $limit, $offset);
	}
}