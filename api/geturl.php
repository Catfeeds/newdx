<?php
/**
 * 随机跳转url
 */

$type = intval($_GET['type']);
// 1=所有版块地址 2=所有新资讯100 3=精选帖子100 4=手动添加
$type = in_array($type, array(1,2,3,4)) ? $type : 1;
$debug = intval($_GET['debug']) ? intval($_GET['debug']) : 0;

require('../config/config_global.php');
$memcache = new Memcache;
$memcache->addServer($_config['memory']['memcache']['server'], $_config['memory']['memcache']['port']);
$memcache->connect($_config['memory']['memcache']['server'], $_config['memory']['memcache']['port'], $_config['memory']['memcache']['timeout']) or die("Memcache can't connect");
if($debug == 1) {
	$memcache->delete('plugin_geturls_1');
	$memcache->delete('plugin_geturls_2');
	$memcache->delete('plugin_geturls_3');
	$memcache->delete('plugin_geturls_4');
}

function jump($data) {
	$count = count($data)-1;
	$key = rand(0, $count);
	header("location:{$data[$key]}");
	exit;
}

function database_connect($dbhost, $dbuser, $dbpw, $dbcharset, $dbname, $pconnect) {
	$link = null;
	$func = empty($pconnect) ? 'mysql_connect' : 'mysql_pconnect';
	if(!$link = @$func($dbhost, $dbuser, $dbpw, 1)) {
		echo('not connect');
		exit;
	} else {
		if(mysql_get_server_info($link) > '4.1') {
			$serverset = 'character_set_connection='.$dbcharset.', character_set_results='.$dbcharset.', character_set_client=binary';
			$serverset .= mysql_get_server_info($link) > '5.0.1' ? ((empty($serverset) ? '' : ',').'sql_mode=\'\'') : '';
			$serverset && mysql_query("SET $serverset", $link);
		}
		$dbname && @mysql_select_db($dbname, $link);
	}
	return $link;
}

function data_query($sql, $type = '') {
	$func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ?
	'mysql_unbuffered_query' : 'mysql_query';
	$result = $func($sql);
	return $result;
}

if ($type == 1) {
	$data = $memcache->get('plugin_geturls_1');
	if(!$data) {
		$data = array('http://bbs.8264.com/',
					'http://bbs.8264.com/forum-12-1.html',
					'http://bbs.8264.com/forum-5-1.html',
					'http://bbs.8264.com/forum-161-1.html',
					'http://bbs.8264.com/forum-52-1.html',
					'http://bbs.8264.com/forum-39-1.html',
					'http://bbs.8264.com/forum-56-1.html',
					'http://bbs.8264.com/forum-69-1.html',
					'http://bbs.8264.com/forum-146-1.html',
					'http://bbs.8264.com/forum-163-1.html',
					'http://bbs.8264.com/',
					'http://bbs.8264.com/forum-42-1.html',
					'http://bbs.8264.com/forum-58-1.html',
					'http://bbs.8264.com/forum-24-1.html',
					'http://bbs.8264.com/forum-135-1.html',
					'http://bbs.8264.com/forum-178-1.html',
					'http://bbs.8264.com/forum-447-1.html',
					'http://bbs.8264.com/forum-66-1.html',
					'http://bbs.8264.com/forum-495-1.html',
					'http://bbs.8264.com/forum-7-1.html',
					'http://bbs.8264.com/',
					'http://bbs.8264.com/forum-490-1.html',
					'http://bbs.8264.com/forum-53-1.html',
					'http://bbs.8264.com/forum-408-1.html',
					'http://bbs.8264.com/forum-169-1.html',
					'http://qixing.8264.com/',
					'http://diaoyu.8264.com/',
					'http://huaxue.8264.com/',
					'http://dengshan.8264.com/',
					'http://bbs.8264.com/',
					'http://ah.8264.com/',
					'http://bj.8264.com/',
					'http://cq.8264.com/',
					'http://fj.8264.com/',
					'http://gs.8264.com/',
					'http://gd.8264.com/',
					'http://gx.8264.com/',
					'http://gz.8264.com/',
					'http://hn.8264.com/',
					'http://hb.8264.com/',
					'http://bbs.8264.com/',
					'http://hn.8264.com/',
					'http://hubei.8264.com/',
					'http://hunan.8264.com/',
					'http://hlj.8264.com/',
					'http://jl.8264.com/',
					'http://js.8264.com/',
					'http://jx.8264.com/',
					'http://ln.8264.com/',
					'http://nmg.8264.com/',
					'http://nx.8264.com/',
					'http://qh.8264.com/',
					'http://bbs.8264.com/',
					'http://sd.8264.com/',
					'http://sx.8264.com/',
					'http://shanxi.8264.com/',
					'http://sh.8264.com/',
					'http://sc.8264.com/',
					'http://tj.8264.com/',
					'http://xj.8264.com/',
					'http://yn.8264.com/',
					'http://bbs.8264.com/',
					'http://zj.8264.com/',
					'http://bbs.8264.com/forum-468.html',
					'http://bbs.8264.com/forum-170.html',
					'http://bbs.8264.com/forum-394.html',
					'http://bbs.8264.com/forum-60-1.html',
					'http://bbs.8264.com/forum-425.html',
					'http://bbs.8264.com/',
					);
		database_connect($_config['db']['1']['dbhost'], $_config['db']['1']['dbuser'], $_config['db']['1']['dbpw'], $_config['db']['1']['dbcharset'], $_config['db']['1']['dbname'], $_config['db']['1']['pconnect']);

		$query = data_query("SELECT fid, typeid FROM pre_forum_threadclass WHERE displayorder > 0 ");
		$i = 0;
		while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
			if($i%5 == 0) { $data[] = "http://bbs.8264.com/"; }
			$data[] = "http://bbs.8264.com/forum-forumdisplay-fid-{$row['fid']}-typeid-{$row['typeid']}-filter-typeid.html";
			$i++;
		}
		//论坛精选
		$query = data_query("SELECT url FROM pre_portal_article_title WHERE catid>885 AND catid<902 ORDER BY aid DESC LIMIT 50");
		while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
			if($i%5 == 0) { $data[] = "http://bbs.8264.com/"; }
			if(strpos($row['url'], 'picture') !== false) continue;
			$data[] = $row['url'];
			$data[] = $row['url'];
			$i++;
		}
		$memcache->set('plugin_geturls_1', $data, MEMCACHE_COMPRESSED, 1800);
	}
	if($debug == 1) {
		echo '<pre>';
		print_r($data);
		exit;
	}
	jump($data);

} elseif ($type ==2) {
	$data = $memcache->get('plugin_geturls_2');
	if(!$data) {
		database_connect($_config['db']['1']['dbhost'], $_config['db']['1']['dbuser'], $_config['db']['1']['dbpw'], $_config['db']['1']['dbcharset'], $_config['db']['1']['dbname'], $_config['db']['1']['pconnect']);
		$query = data_query("SELECT aid FROM pre_portal_article_title WHERE catid != 910 AND url='' AND id = 0 ORDER BY aid DESC LIMIT 50");
		while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
			$data[] = "http://www.8264.com/viewnews-{$row['aid']}-page-1.html";
		}
		$memcache->set('plugin_geturls_2', $data, MEMCACHE_COMPRESSED, 600);
	}
	if($debug == 1) {
		echo '<pre>';
		print_r($data);
		exit;
	}
	jump($data);
} elseif ($type ==3) {
	$data = $memcache->get('plugin_geturls_3');
	if(!$data) {
		database_connect($_config['db']['1']['dbhost'], $_config['db']['1']['dbuser'], $_config['db']['1']['dbpw'], $_config['db']['1']['dbcharset'], $_config['db']['1']['dbname'], $_config['db']['1']['pconnect']);
		// $query = data_query("SELECT tid, fid FROM pre_forum_thread WHERE displayorder > 0 ORDER BY tid DESC LIMIT 100");
		// while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
		// 	if(in_array($row['fid'], array(408, 471, 392, 477, 490, 494,497, 498, 499))) continue;	//过滤点评内容
		// 	$data[]='http://bbs.8264.com/thread-'.$row['tid'].'-1-1.html';
		// }
		//论坛精选
		$query = data_query("SELECT url FROM pre_portal_article_title WHERE catid>885 AND catid<902 ORDER BY aid DESC LIMIT 50");
		while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
			if(strpos($row['url'], 'picture') !== false) continue;
			$data[] = $row['url'];
		}
		$memcache->set('plugin_geturls_3', $data, MEMCACHE_COMPRESSED, 600);
	}
	if($debug == 1) {
		echo '<pre>';
		print_r($data);
		exit;
	}
	jump($data);
} elseif ($type == 4) {
	$data = $memcache->get('plugin_geturls_4');
	if(!$data) {
		database_connect($_config['db']['1']['dbhost'], $_config['db']['1']['dbuser'], $_config['db']['1']['dbpw'], $_config['db']['1']['dbcharset'], $_config['db']['1']['dbname'], $_config['db']['1']['pconnect']);

		//手动添加链接
		$query = data_query("SELECT `values` FROM pre_plugin_css_cache WHERE filename = 'plugin_api_geturl'");
		$data_value =  @mysql_result($query, 0);
		$data = explode("\n", $data_value);
		$memcache->set('plugin_geturls_4', $data, MEMCACHE_COMPRESSED, 3600);
	}
	if($debug == 1) {
		echo '<pre>';
		print_r($data);
		exit;
	}
	jump($data);
}
