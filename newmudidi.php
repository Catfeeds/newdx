<?php

/**
 * @author JiangHong
 * @copyright 2015
 */
exit(); //�رշ���
define('CURSCRIPT', 'newmudidi');
define('BASEMUDIDI', dirname(__file__) . '/newmudidi/');
require_once './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->_init_db();
$discuz->_init_memory();
/****�˴�Ϊ����sitemap����****/
/*if($_GET['xmlcreate'] == 1)
{
	$q = DB::query("SELECT tid FROM " . DB::table('forum_thread') . " WHERE fid = 433 AND displayorder >= 0");
	$outstring = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.baidu.com/schemas/sitemap-mobile/1/">
EOF;
	$urlstring = "";
	while($v = DB::fetch($q))
	{
		$_tid = $v['tid'];
		$urlstring .= <<<EOF

	<url>
		<loc>http://bbs.8264.com/whither-{$_tid}.html</loc>
		<changefreq>hourly</changefreq>
		<priority>1.0</priority>
	</url>
	<url>
		<loc>http://bbs.8264.com/whither-weather-{$_tid}.html</loc>
		<changefreq>hourly</changefreq>
		<priority>1.0</priority>
	</url>
	<url>
		<loc>http://bbs.8264.com/whither-map-{$_tid}.html</loc>
		<changefreq>hourly</changefreq>
		<priority>1.0</priority>
	</url>
	<url>
		<loc>http://bbs.8264.com/whither-guidelist-{$_tid}-1.html</loc>
		<changefreq>hourly</changefreq>
		<priority>1.0</priority>
	</url>
	<url>
		<loc>http://bbs.8264.com/whither-scapelist-{$_tid}-1.html</loc>
		<changefreq>hourly</changefreq>
		<priority>1.0</priority>
	</url>
	<url>
		<loc>http://bbs.8264.com)/whither-scapearealist-{$_tid}-1.html</loc>
		<changefreq>hourly</changefreq>
		<priority>1.0</priority>
	</url>
EOF;
	}
	$qq = DB::query("SELECT id FROM " . DB::table('mudidi_info'));
	while($v = DB::fetch($qq))
	{
		$_id = $v['id'];
		$urlstring .= <<<EOF

	<url>
		<loc>http://bbs.8264.com)/whither-info-{$_id}.html</loc>
		<changefreq>hourly</changefreq>
		<priority>1.0</priority>
	</url>
EOF;
	}
	$outstring .= <<<EOF
{$urlstring}
</urlset>
EOF;
	file_put_contents(DISCUZ_ROOT . './sitecreate.xml', $outstring);exit;

}	*/
$travellimit = 10;
$page = max(intval($_G['gp_page']), 1);
$traveloffset = ($page - 1) * $travellimit;
//require_once libfile('class/weather');

$modlist = array('content', 'index');
$mod = in_array($_G['gp_mod'], $modlist) ? $_G['gp_mod'] : 'index';
require_once libfile('class/searchengine');
$searchengine = new searchengine();
$searchtime = 0;
$searchengine->setmatchmode(SPH_MATCH_EXTENDED2);
/*�˴�����һ�����е���ϵͳ��fid��Ϊ������Ч�ʲ���ȥ���ݿ��ѯ����Ϊ���ϵ�fid*/
$dianpingfid = array(477, 408, 490, 494, 392, 471, 497, 498, 499);
if($mod == 'index')
{
	$searchengine->searchcore->SetSortMode(SPH_SORT_ATTR_DESC, 'findtime');
	/*�˴����ӹ��˵�����ϵͳ������*/
	$searchengine->searchcore->SetFilter('fid', $dianpingfid, true);
	$tmp = $searchengine->query("�μ� | ���� -��", searchengine::SEARCH_INDEX_THREAD, $travellimit, $traveloffset);
	$searchtime += $tmp['time'];
	$travellist = array();
	if($tmp['total'] > 0)
	{
		$arrlist = array_keys($tmp['matches']);
		if(!empty($arrlist))
		{
			$q = DB::query("SELECT t.tid, t.subject, t.authorid, t.author FROM " . DB::table('forum_thread') . " AS t WHERE t.tid IN(" . implode(',', $arrlist) . ") AND displayorder >= 0 " . getSlaveID());
			while($v = DB::fetch($q))
			{
				$v['avatar'] = avatar($v['authorid'], 'small', true, false, true, $_G['config']['web']['avatar']);
				$tt[$v['tid']] = $v;
			}
			foreach($arrlist as $k)
			{
				if($tt[$k]){
					$travellist[] = $tt[$k];
				}
			}
		}
	}
	$lvyoulist = array();
	$lvyoulist = memory('get', 'newmudidi_index_newlist');
	if(!$lvyoulist)
	{
		// require_once libfile('function/filesock');
		// $lvyoulist = _dfsockopen("http://m.zaiwai.com/?app=api&act=get_new_list");
		// $lvyoulist = json_decode($lvyoulist, true);
		// if(!empty($lvyoulist))
		// {
		// 	$lvyoulist = iconv_array($lvyoulist, 'utf-8', 'gbk');
		// 	memory('set', 'newmudidi_index_newlist', $lvyoulist, 600);
		// }
	}
	$i = 0;
	$leftarr = $rightarr = array();
	foreach($lvyoulist as $val)
	{
		$i++;
		$val['hot'] = in_array($i, array(1,2)) ? true : false;
		$val['yh'] = in_array($i, array(5,9,10)) ? true : false;
		if($i%2 == 1)
		{
			$leftarr[] = $val;
		}else{
			$rightarr[] = $val;
		}
	}
	$title = "��·�Ƽ� ������·��ȫ �����μǹ���";
	$descriptions = "�°�Ŀ�ĵ� - ����������";
	$keywords = "Ŀ�ĵ�,����������";
	include_once BASEMUDIDI . 'index.php';
}elseif($mod == 'content'){
	$ifdefault = false;
	$tid = $_G['gp_tid'];
	$infoid = $_G['gp_infoid'];
	$mpid = $_G['gp_mapid'];
	if($infoid){
		$tmpinfo = DB::fetch_first("SELECT r.tid, r.type, m.* FROM " . DB::table('mudidi_thread_ralation') . " r LEFT JOIN " . DB::table('mudidi_info') . " m ON r.sn = m.sn WHERE m.id = {$infoid} " . getSlaveID());
		$tid = $tmpinfo['tid'];
	}elseif($mpid){
		$mapinfo = DB::fetch_first("SELECT * FROM " . DB::table('mudidi_map') . " WHERE id = {$mpid}");
		$tmpinfo = DB::fetch_first("SELECT r.tid, r.type, m.* FROM " . DB::table('mudidi_thread_ralation') . " r LEFT JOIN " . DB::table('mudidi_info') . " m ON r.sn = m.sn WHERE r.sn = '{$mapinfo['sn']}'" . getSlaveID());
		$tid = $tmpinfo['tid'];
	}elseif($tid > 0)
	{
		$tmpinfo = DB::fetch_first("SELECT m.*, r.type FROM " . DB::table('mudidi_thread_ralation') . " r LEFT JOIN " . DB::table('mudidi_info') . " m ON r.sn = m.sn WHERE r.tid = {$tid} " . getSlaveID());
		$ifdefault = true;
	}
	$searchtype = $_G['gp_stype'];
	/*if(!$searchtype)
	{
	    header('HTTP/1.1 404 Not Found');
	    header("status: 404 Not Found");
	}*/
	if(!$tid && !empty($_G['gp_search']))
	{
		$searchtext = iconv('utf-8', 'gbk', $_G['gp_search']);
		$result = $searchengine->query($searchtext, searchengine::SEARCH_INDEX_MUDIDI, 1);
		$searchtime += $result['time'];
		if($result['total'] > 0)
		{
			/*�˴���ת����Ӧ����ȷurl����ʱֹͣ��ת*/
			$tid = current(array_keys($result['matches']));
			/*
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$_G[config][web][forum]}thread-{$tid}-{$searchtype}-1.html");
			//header("Location: {$_G[config][web][forum]}newmudidi.php?tid={$tid}&stype={$searchtype}");*/
		}
	}
	if($tid)
	{
		require_once libfile('function/filesock');
		//require_once DISCUZ_ROOT . './api/record/wordsmodel.class.php';
		$mudidiname = DB::result_first("SELECT subject FROM " . DB::table('forum_thread') . " WHERE tid = {$tid} " . getSlaveID());
		//$mudidinameeng = wordsmodel::Pinyin($mudidiname);
		$mudidicode = DB::result_first("SELECT sn FROM " . DB::table('mudidi_thread_ralation') . " WHERE tid = {$tid}");
		$topcode = explode('-', $mudidicode);
		$topcode = $topcode[0] . '-' . $topcode[1] . '-' . $topcode[2];
		$toptid = DB::result_first("SELECT tid FROM " . DB::table('mudidi_thread_ralation') . " WHERE sn = '{$topcode}' AND type = 3 " . getSlaveID());
		$topmudidiname = $toptid ? DB::result_first("SELECT subject FROM " . DB::table('forum_thread') . " WHERE tid = {$toptid} " . getSlaveID()) : $mudidiname;
		// $urls = _dfsockopen("http://m.zaiwai.com/?app=api&act=get_url&area=" . urlencode(iconv('gbk', 'utf-8', $mudidiname)));
		// $urlstop = _dfsockopen("http://m.zaiwai.com/?app=api&act=get_url&area=" . urlencode(iconv('gbk', 'utf-8', $topmudidiname)));
		// $urls = json_decode($urls, true);
		// $urlstop = json_decode($urlstop, true);
		// if(empty($urls))
		// {
		// 	$urls = $urlstop;
		// }
		/*$topmudidieng = wordsmodel::Pinyin($topmudidiname);
		if($topmudidiname == "����")
		{
			$topmudidieng = 'chongqing';
		}*/
		// $lvtmp = _dfsockopen("http://m.zaiwai.com/?app=api&act=get_good_list&tag=" . urlencode(iconv('gbk', 'utf-8', $mudidiname)));
		// $lvtmp = json_decode($lvtmp, true);
		if(!empty($lvtmp))
		{
			$lvyoulist = iconv_array($lvtmp, 'utf-8', 'gbk');
			$leftlist = array();
			$rightlist = array();
			$i = 0;
			foreach($lvyoulist as $k => $v)
			{
				$i++;
				$v['hot'] = in_array($i, array(1,4,8,9)) ? true : false;
				if($i%2 == 1){
					$leftlist[] = $v;
				}else{
					$rightlist[] = $v;
				}
			}
			//echo "<pre>" . var_export($lvyoulist, true) . "</pre>";
		}
		//echo "<pre>" . var_export($lvtmp, true) . "</pre>";
		$searchengine->searchcore->SetSortMode(SPH_SORT_ATTR_DESC, 'lasttime');
		/*�˴����ӹ��˵�����ϵͳ������*/
		//$searchengine->searchcore->SetFilter('fid', $dianpingfid, true);
		//$tmp = $searchengine->query("({$mudidiname}�μ�) | ({$mudidiname}����) -��", searchengine::SEARCH_INDEX_THREAD, $travellimit, $traveloffset);
		$searchengine->searchcore->SetFilter('fid', array('52', '69', '24', '186', '135', '88', '66', '447'));
		$tmp = $searchengine->query("{$mudidiname} -��", searchengine::SEARCH_INDEX_THREAD, $travellimit, $traveloffset);
		$searchtime += $tmp['time'];
		$travellist = array();
		if($tmp['total'] > 0)
		{
			$arrlist = array_keys($tmp['matches']);
			if(!empty($arrlist))
			{
				$q = DB::query("SELECT t.tid, t.subject, t.authorid, t.author, p.message FROM " . DB::table('forum_thread') . " AS t LEFT JOIN " . DB::table('forum_post') . " AS p ON t.tid = p.tid WHERE t.tid IN(" . implode(',', $arrlist) . ") AND p.first = 1 AND t.displayorder >= 0 " . getSlaveID());
				while($v = DB::fetch($q))
				{
					$v['avatar'] = avatar($v['authorid'], 'small', true, false, true, $_G['config']['web']['avatar']);
					$tt[$v['tid']] = $v;
				}
				foreach($arrlist as $k)
				{
					if($tt[$k]){
						$tt[$k]['message'] = preg_replace("/\[attach\][^\[]*\[\/attach\]/is", "", $tt[$k]['message']);
						$tt[$k]['message'] = preg_replace("/\[[^\]]*\]/is", "", $tt[$k]['message']);
						$tt[$k]['message'] = preg_replace("/\[\/[^\]]*\]/is", "", $tt[$k]['message']);
						$tt[$k]['message'] = preg_replace("/\����.*�༭/is", "", $tt[$k]['message']);
						$tt[$k]['message'] = cutstr($tt[$k]['message'], 165);
						$travellist[] = $tt[$k];
					}
				}
			}
		}
		$descriptions = date('Y', time()) . "��{$mudidiname}�������ι��ԣ�8264����Ϊ���ṩ��ȫ���{$mudidiname}�����ι���,{$mudidiname}��·�г�,{$mudidiname}���ξ�����ܡ��˽����{$mudidiname}������Ϣ���ϻ���������Ŀ�ĵ�ϵͳ��";
		$keywords = "{$mudidiname}�������ι���,{$mudidiname}���ξ����ȫ,{$mudidiname}��·,{$mudidiname}����";
		switch($searchtype)
		{
			case 'weather':
				/*��ʾ����*/
				$showtext = "��������";
				require_once libfile('class/weather');
				$weatherarr = weather::getweather($mudidiname);
				$title = date('Y', time()) . "����{$mudidiname}����Ԥ�� - {$mudidiname}һ������Ԥ����ѯ - ����������";

				break;
			case 'guidelist':
				$showtext = false;
				$title = date('Y', time()) . "����{$mudidiname}���ι������� - {$mudidiname}�����ι��� - {$mudidiname}�����й��� - ����������";
				break;
			case 'map':
				$showtext = "{$mudidiname}��ͼ";
				switch ($tmpinfo['type']) {
					case '1':
						$tableName = 'mudidi_scape';
						break;
					case '2':
						$tableName = 'mudidi_scapearea';
						break;
					case '3':
						$tableName = 'mudidi_region';
						break;
					default:
						break;
				}
				if ($tableName) {
					$mudidi_data = DB::fetch_first("SELECT * FROM ".DB::table($tableName)." WHERE sn = '{$tmpinfo['sn']}'");
				}
				$title = date('Y', time()) . "����{$mudidiname}��ͼ����Ԥ�� - {$mudidiname}��ͼ���� - {$mudidiname} - ����������";
				$maplevel = $tmpinfo['type'] == 3 ? 5 : 7;
				$wenhua = <<<EOF
<div id="map" style="width:100%;height:400px;"></div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2&services=true"></script>
<script type="text/javascript">
var map = new BMap.Map("map");
var point = new BMap.Point({$mudidi_data['long']}, {$mudidi_data['lat']});
map.centerAndZoom(point, {$maplevel});
map.addControl(new BMap.NavigationControl());
var marker = new BMap.Marker(point);  // ������ע
map.addOverlay(marker);              // ����ע��ӵ���ͼ��
</script>
EOF;
				break;
			case 'maplist':
				$mplist = memory('get', 'newmudidi_maplist_' . $tid);
				if(!$mplist)
				{
					$q = DB::query("SELECT id, subject, filepath FROM " . DB::table('mudidi_map') . " WHERE sn = '{$tmpinfo['sn']}'");
					while($v = DB::fetch($q))
					{
						$v['pic'] = getimagethumb(100, 100, 2, 'mudidi/' . $v['filepath'], 0, 99);
						$mplist[$v['id']] = $v;
					}
					memory('set', 'newmudidi_maplist_' . $tid, $mplist, 30 * 24 * 3600);
				}
				$showtext = "{$mudidiname}��ͼ�б�";
				$title = date('Y', time()) . "����{$mudidiname}��ͼ����Ԥ�� - {$mudidiname}��ͼ���� - {$mudidiname} - ����������";
				break;
			case 'mapview':
				if($mapinfo){
					$showtext = $mapinfo['message'];
					$title = date('Y', time()) . "����{$mudidiname}��ͼ����Ԥ�� - {$mudidiname}��ͼ���� - {$mudidiname} - ����������";
					$mapinfo['pic'] = getimagethumb(1500, 1500, 1, 'mudidi/' . $mapinfo['filepath'], 0, 99);
					$mapinfo['thumbpic'] = getimagethumb(600, 600, 1, 'mudidi/' . $mapinfo['filepath'], 0, 99);
				}
				break;
			case 'scapelist':
				$sclist = array();
				$showtext = "{$mudidiname}����";
				$title = "{$mudidiname}���ξ������ - {$mudidiname}��ʲô����� - {$mudidiname}���ξ����ȫ - ����������";
				$memkeyname = 'newmudidi_scapelist_' . $tid;
				$sctable = 'mudidi_scape';
				$memdata = memory('get', $memkeyname);
				if(!$memdata)
				{
					require_once libfile('function/post');
					$sql = "SELECT t.subject, s.*, r.tid, p.message FROM ".DB::table('forum_thread')." AS t
							LEFT JOIN ".DB::table('forum_post')." AS p ON p.tid = t.tid AND p.first = 1
							RIGHT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.tid = t.tid
							RIGHT JOIN ".DB::table($sctable)." AS s ON s.sn = r.sn
							WHERE r.sn LIKE '{$mudidicode}-%' " . getSlaveID();
					$q = DB::query($sql);
					while($v = DB::fetch($q))
					{
						$v['message'] = messagecutstr($v['message'], 180);
						$memdata[] = $v;
					}
					memory('set', $memkeyname, $memdata, 30 * 24 * 3600);
				}
				$randkey = array_rand($memdata, 10);
				foreach($randkey as $_key)
				{
					$sclist[] = $memdata[$_key];
				}
				break;
			case 'scapearealist':
				$sclist = array();
				$showtext = "{$mudidiname}����";
				$title = "{$mudidiname}���ξ������ - {$mudidiname}��ʲô����� - {$mudidiname}���ξ����ȫ - ����������";
				$memkeyname = 'newmudidi_scapearealist_' . $tid;
				$sctable = 'mudidi_scapearea';
				$memdata = memory('get', $memkeyname);
				if(!$memdata)
				{
					require_once libfile('function/post');
					$sql = 	"SELECT t.subject, s.*, r.tid, p.message FROM ".DB::table($sctable)." AS s
							RIGHT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = s.sn
							LEFT JOIN ".DB::table('forum_post')." AS p ON p.tid = r.tid AND p.first = 1
							LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
							WHERE r.type = 2 AND r.sn LIKE '{$mudidicode}-%' " . getSlaveID();
					$q = DB::query($sql);
					while($v = DB::fetch($q))
					{
						$v['message'] = messagecutstr($v['message'], 180);
						$memdata[] = $v;
					}
					memory('set', $memkeyname, $memdata, 30 * 24 * 3600);
				}
				$randkey = array_rand($memdata, 10);
				foreach($randkey as $_key)
				{
					$sclist[] = $memdata[$_key];
				}
				break;
			default:
				$editurl = $_G['config']['web']['forum'] . "plugin.php?id=whither:pubinfo&tid={$tid}&infoid={$tmpinfo[id]}";
				/*Ĭ����ʾ�Ļ�*/
				//$showtext = "�Ļ�";
				//$wenhua = DB::result_first("SELECT message FROM " . DB::table('forum_post') . " WHERE tid={$tid} AND first = 1 LIMIT 1");
				require_once libfile('function/discuzcode');
				$showtext = $tmpinfo['name'];
				$wenhua = discuzcode($tmpinfo['message']);
				$title = $tmpinfo['name'] ? $tmpinfo['name'] . " - ����������" : "{$mudidiname} - ����������";
				$keywords = "{$tmpinfo['name']},{$mudidiname}���ξ����ȫ,{$mudidiname}��·,{$mudidiname}����";
				if($ifdefault)
				{
		 			$title = date('Y', time()) . $mudidiname . "�������ι���,{$mudidiname}���ξ����ȫ,8264{$mudidiname}��·�г̹���-����������";
				}
				break;
		}
		//$title = "{$mudidiname} - {$topmudidiname} - {$showtext} - ��·�Ƽ� - ��{$page}ҳ";
		include_once BASEMUDIDI . 'content.php';
	}else{
		/*�����ڵĵ�������ת����ҳ*/
		//echo "�����ڣ�����ת";
		header("location:" . $_G['config']['web']['forum']);
	}
}
