<?php
/**
 * 统计搜索引擎关键字
 **/

require '../source/class/class_core.php';
require '../source/function/function_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

class analytic
{
	var $search_engines = array("baidu.com",
								"google.com",
								"so.com",
								"sogou.com",
								"youdao.com",
								"yahoo.com",
								"bing.com",
								);
	var $search_query = array("baidu.com" => "wd",
								"google.com" => "q",
								"so.com" => "q",
								"sogou.com" => "query",
								"youdao.com" => "q",
								"yahoo.com" => "p",
								"bing.com" => "q",
								);
	var $referrer;
	var $se;
	var $keywords;
	var $redis;
	var $type;	//主站=1;点评=2;资讯=3;点评评论页=4;游记攻略=5;问答系统=6

	function __construct()
	{
		$this->url = $_GET['url'];
		$this->title = diconv($_GET['title'], 'utf-8', 'gbk');
		$this->referrer = $_GET['referrer'];
		$this->fid = intval($_GET['fid']);
		$this->tid = intval($_GET['tid']);
		$this->pid = intval($_GET['pid']) ? intval($_GET['pid']) : 0;
		$this->type = in_array(intval($_GET['type']), array(1,2,3,4,5,6)) ? intval($_GET['type']) : 0;
	}

	function dbTable()
	{
		$table_name = DB::table('plugin_seo_analytic_');
		$table_name .= $this->tid ? substr($this->tid, -1) : 0;
		return $table_name;
	}

	function dbKwsTable($datetime)
	{
		$table_name = DB::table('plugin_seo_analytic_keywords_');
		$table_name .= $datetime ? substr($datetime, -1) : 0;
		return $table_name;
	}

	function redisInit()
	{
		require_once libfile('class/myredis');
		$this->redis = & myredis::instance(6381);
	}

	// 检测是否来源于搜索引擎
	function testSource()
	{
		if(empty($this->referrer)) return false;

		$domain = parse_url($this->referrer, PHP_URL_HOST);
		foreach ($this->search_engines as $value) {
			if(stristr($domain, $value) === false) {
				continue;
			} else {
				$this->se = $value;
				return true;
			}
		}

		return false;
	}

	// 匹配关键字
	function parseKeywords()
	{
		list($s, $query_string) = explode('?', $this->referrer);
		parse_str($query_string, $url_query);
		return $url_query[$this->search_query[$this->se]];
	}

	// 添加记录
	function addLog()
	{
		$keywords = $this->parseKeywords();
		$keywords = diconv(trim($keywords), 'utf-8', 'gbk');
		DB::query("INSERT INTO ".$this->dbTable()." SET `url`='$this->url',`title`='$this->title',`referrer`='$this->referrer',`keywords`='$keywords',`fid`='$this->fid',`tid`='$this->tid',`pid`='$this->pid',`type`='$this->type',`dateline`='".time()."'");
		$this->collect();
		if($this->fid) { $this->fidNums(); }
		if($this->se) { $this->seNums(); }
		if($keywords) { $this->kwNums($keywords); }
	}

	// 版块被搜索量计数
	function fidNums()
	{
		if(!$this->redis) {
			$this->redisInit();
		}

		$this->redis->obj->hincrby("seo_analytic_fidnums_".date("Ymd", time()), $this->fid, 1);
		//前一天的入库处理
		$day_before = date("Ymd", time()-86400);
		$fid_old = $this->redis->obj->hgetall('seo_analytic_fidnums_'.$day_before);
		$this->redis->obj->rename('seo_analytic_fidnums_'.$day_before, 'seo_analytic_fidnums_'.$day_before.'_bak');

		if($fid_old) {
			$sql = "SELECT fid, name FROM ".DB::table("forum_forum")." ".getSlaveID();
			$query = DB::query($sql);
			while($row = DB::fetch($query)){
				$forum[$row['fid']] = $row['name'];
			}

			foreach ($fid_old as $key => $value) {
				DB::query("INSERT INTO ".DB::table("plugin_seo_analytic_fids")." SET `datetime`='$day_before',`fid`='$key',`name`='$forum[$key]',`nums`='$value'");
			}
			$this->redis->obj->del('seo_analytic_fidnums_'.$day_before.'_bak');
		}
	}

	// 搜索引擎使用量计数
	function seNums()
	{
		if(!$this->redis) {
			$this->redisInit();
		}

		$this->redis->obj->hincrby("seo_analytic_senums_".date("Ymd", time()), $this->se, 1);
		//前一天的入库处理
		$day_before = date("Ymd", time()-86400);
		$ses_old = $this->redis->obj->hgetall('seo_analytic_senums_'.$day_before);
		$this->redis->obj->rename('seo_analytic_senums_'.$day_before, 'seo_analytic_senums_'.$day_before.'_bak');

		if($ses_old) {
			foreach ($ses_old as $key => $value) {
				DB::query("INSERT INTO ".DB::table("plugin_seo_analytic_ses")." SET `datetime`='$day_before',`ses`='$key',`nums`='$value'");
			}
			$this->redis->obj->del('seo_analytic_senums_'.$day_before.'_bak');
		}
	}

	// 关键字被搜索量计数
	function kwNums($keywords)
	{
		if(!$this->redis) {
			$this->redisInit();
		}

		$kws = array();
		$kws = explode(" ", preg_replace("/\s(?=\s)/", "\\1", $keywords));
		foreach ($kws as $key => $value) {
			$this->redis->obj->hincrby("seo_analytic_kwnums_".date("Ymd", time()), $value, 1);
		}
		//前一天的入库处理
		// $day_before = date("Ymd", time()-86400);
		// $kws_old = $this->redis->obj->hgetall('seo_analytic_kwnums_'.$day_before);
		// $this->redis->obj->rename('seo_analytic_kwnums_'.$day_before, 'seo_analytic_kwnums_'.$day_before.'_bak');
		// if($kws_old) {
		// 	$dbtable = $this->dbKwsTable($day_before);
		// 	foreach ($kws_old as $key => $value) {
		// 		DB::query("INSERT INTO $dbtable SET `datetime`='$day_before',`keywords`='$key',`nums`='$value'");
		// 	}
		// 	$this->redis->obj->del('seo_analytic_kwnums_'.$day_before.'_bak');
		// }
	}

	// 搜索记录汇总
	function collect()
	{
		if($this->tid) {
			DB::query("UPDATE ".DB::table("plugin_seo_analytic")." SET nums=nums+1 WHERE tid='$this->tid' AND type='$this->type'");
			if(DB::affected_rows() == 0) {
				if($this->type == 3) {	//资讯
					$dateline = DB::result_first("SELECT dateline FROM ".DB::table("portal_article_title")." WHERE aid='$this->tid'");
				} elseif($this->type == 6) {	//问答系统
					$dateline = DB::result_first("SELECT dateline FROM ".DB::table("question_topic")." WHERE topicid='$this->tid'");
				} else {
					$dateline = DB::result_first("SELECT dateline FROM ".DB::table("forum_thread")." WHERE tid='$this->tid'");
				}
				$dateline = $dateline ? $dateline : time();
				DB::query("INSERT INTO ".DB::table("plugin_seo_analytic")." SET `url`='$this->url',`title`='$this->title',`fid`='$this->fid',`tid`='$this->tid',`pid`='$this->pid',`type`='$this->type',`pubtime`='$dateline',`nums`='1'");
			}
		}
	}

	//输出1x1像素图片
	function echoGif()
	{
		$gif_data = array(
			chr(0x47),chr(0x49),chr(0x46),chr(0x38),chr(0x39),chr(0x61),
			chr(0x01),chr(0x00),chr(0x01),chr(0x00),chr(0x80),chr(0xff),
			chr(0x00),chr(0xff),chr(0xff),chr(0xff),chr(0x00),chr(0x00),
			chr(0x00),chr(0x2c),chr(0x00),chr(0x00),chr(0x00),chr(0x00),
			chr(0x01),chr(0x00),chr(0x01),chr(0x00),chr(0x00),chr(0x02),
			chr(0x02),chr(0x44),chr(0x01),chr(0x00),chr(0x3b)
		);

		header("Content-Type: image/gif");
		header("Cache-Control: " . "private, no-cache, no-cache=Set-Cookie, proxy-revalidate");
		header("Pragma: no-cache");
		header("Expires: Wed, 17 Sep 1975 21:32:10 GMT");

		echo join($gif_data);

		exit;
	}
}

$analytic = new analytic;

// 禁止非8264域名非法调用
if(stristr($_SERVER['HTTP_REFERER'], '8264.com') === false) { $analytic->echoGif(); }

if($analytic->testSource()) {
	$analytic->addLog();
}

$analytic->echoGif();
?>
