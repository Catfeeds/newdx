<?php
	if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}
	
	//header('HTTP/1.1 503 Service Temporarily Unavailable');
	//header('服务器正在维护，稍后开放');
	//header('Retry-After: 6000');
	//exit;
	
	
	require_once DISCUZ_ROOT.'./source/plugin/'.$pluginmodule['directory'].'./common.php';
	require_once DISCUZ_ROOT.'./source/plugin/'.$pluginmodule['directory'].'./SearchKey.php';
	
	$perpage = 90;
	$page = max(1, intval($_G['gp_page']));
	$start_limit = ($page - 1) * $perpage;
	$count = $forumoption_key->getKeywordsCount();
	
	$ing_lists = $forumoption_key->getKeywords(null, $start_limit.','.$perpage);
	$multipage = multi($count, $perpage, $page, "zhuanti");
	$a = intval(($count/$perpage + (bool)($count%$perpage)) / 10);
	if ($a > 1) {
		for ($i=1;$i<=$a;$i++) {
			$pagelist[$i]['page'] = 10*$i;
			$pagelist[$i]['url'] = 'zhuanti-page-'.($pagelist[$i]['page']);
		}
	}
	$navtitle = '8264户外热点列表';

    include template('searchindex:searchindex');