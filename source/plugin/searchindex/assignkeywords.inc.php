<?php

    if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}

	require_once(DISCUZ_ROOT.'./source/plugin/'.$pluginmodule['directory'].'./common.php');
	
	$op = $_G['gp_op'];
	$limit = 50;
	

	$sql = "SELECT keywords,searchid FROM ".DB::table('plugin_searchkey_searchindex')." where state = 1";
	if ($op == 'search') {
		$searchkey = $_G['gp_searchkey'];
		if (!empty($searchkey)) {
			$sql .= " AND keywords like '%{$searchkey}%'";
		}
	} elseif ($op == 'add' || $op == 'get') {
		$relatedid = $_G['gp_relatedid'];
		$sql .= " AND searchid in ({$relatedid})";
	} 
	$sql .= " order by searchid DESC";
	
	if ($op != 'add') {
		$sql .= " LIMIT {$limit}";
	}
	
	$keywords_query = DB::query($sql);
	
	while($value = DB::fetch($keywords_query)){
		$keywords[] = $value;
	}
	$count = count($keywords);
	
	
    include template('searchindex:assignkeywords');
