<?php
//cache_domain缓存失败后数据库取值
//add by wangqi 20120910

function getdata_cache_domain(){
	require('./config/config_global.php');
	$memcache = new Memcache;
	$memcache->addServer($_config['memory']['memcache']['server'], $_config['memory']['memcache']['port']);
	$memcache->connect($_config['memory']['memcache']['server'], $_config['memory']['memcache']['port']) or die("Memcache can't connect");
	$domain = $memcache->get('vjPs0B_domain');
	if(!$domain || $domain==''){
		database_connect($_config['db']['1']['dbhost'], $_config['db']['1']['dbuser'], $_config['db']['1']['dbpw'], $_config['db']['1']['dbcharset'], $_config['db']['1']['dbname'], $_config['db']['1']['pconnect']);
		$result = data_query("SELECT * FROM pre_common_setting WHERE skey = 'domain'");
		while($setting = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$data[$setting['skey']] = $setting['svalue'];
		}
		$domain = unserialize(stripslashes($data['domain']));
		$mydomain_result = data_query("SELECT * FROM pre_plugin_domain where 1");
		while ($value = mysql_fetch_array($mydomain_result, MYSQL_ASSOC)) {
			$domain['list'][$value['domain'].'.'.$_config['alldomain']['forum']] = array('id'=>$value['fid'],'idtype'=>'forum','filter'=>'typeid','typeid'=>$value['typeid']);
		}
		$memcache->set('vjPs0B_domain', $domain, 0);
	}
	return $domain;
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

?>
