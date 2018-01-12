<?php
/**
 * 专题新模块数据调用接口
 * 与论坛原DIY block无关
 */

define('CURSCRIPT', 'api');

require_once('../source/class/class_core.php');

$cachelist = array();
$discuz = & discuz_core::instance();

$discuz->cachelist = $cachelist;
$discuz->init_cron = false;
$discuz->init_setting = true;
if(!$_GET['nocache'])
{
	$discuz->init_user = false;
}
$discuz->init_session = false;

$discuz->init();

$type = in_array($_GET['type'], array('json')) ? $_GET['type'] : 'json';
$bid = intval($_GET['bid']) ? intval($_GET['bid']) : 0;

if($bid && $type)
{
	$blockdata = new blockdata();
	$blockdata->bid = $bid;
	$blockdata->type = $type;
	if($_G['adminid'] == 1 && $_GET['nocache'] ==1)
	{
		$blockdata->updatecache();
	}
	header('Content-Type: text/html; charset=utf-8');
	echo $blockdata->get();
}
else
{
	echo "args error";
}


class blockdata
{
	var $bid = 0;
	var $type = 'json';
	var $msg;

	function cache()
	{
		if($this->bid)
		{
			$cachedata = memory('get', 'topic_block_data_'.$this->bid);
			if(!$cachedata)
			{
				$query = DB::query("SELECT * FROM ".DB::table('portal_topic_block_item')." WHERE bid='$this->bid' ORDER BY displayorder ASC");
				while($row = DB::fetch($query)){
					if($row['serverid']>0){
						require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
						$attachserver = new attachserver;
						$serverdomain = $attachserver->get_server_domain($row['serverid']);
					}
					$row['showimg'] = $row['showimg'] ? (($row['serverid']>0 ? "http://".$serverdomain."/".$row['dir']."/" : $_G['setting']['attachurl']).$row['showimg']) : '';
					$cachedata[] = $row;
				}
				if($cachedata)
				{
					memory('set', 'topic_block_data_'.$this->bid, $cachedata);
				}
			}
			return $cachedata;
		}
		else
		{
			$this->msg = 'args bid miss';
		}
	}

	function updatecache()
	{
		memory('rm', 'topic_block_data_'.$this->bid);
		$this->cache();
		return true;
	}

	function get()
	{
		$data = $this->cache();
		if($this->type == 'json')
		{
			foreach ($data as $key => $value) {
				$data[$key]['title'] = diconv($value['title'],'GBK','UTF-8');
				$data[$key]['description'] = diconv($value['description'],'GBK','UTF-8');
				$data[$key]['showdate'] = diconv($value['showdate'],'GBK','UTF-8');
			}
			$returndata = json_encode($data);
		}

		return $returndata;
	}
}
?>
