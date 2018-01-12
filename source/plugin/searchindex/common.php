<?php

	//header("Location: http://www.8264.com");
	//exit;

	if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}
	//header('HTTP/1.1 503 Service Temporarily Unavailable');
	//header('服务器正在维护，稍后开放');
	//header('Retry-After: 6000');
	//exit;
	/**$_G['extcnzz'][] = '<script src="http://s21.cnzz.com/stat.php?id=3070731&web_id=3070731&show=pic1" language="JavaScript"></script>';*/
	$adminarray = array(1,4,125851,34172959);
	if(in_array($_G['uid'], $adminarray)) {
		$manager = 1;
	} else {
		$manager = 0;
	}
	//蜘蛛判断程序
	/*	$searchbot = get_naps_bot();
	if ($searchbot) {
		$url_this ="http://".$_SERVER ['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
		$insertarr = array(
			'rtype'=>$searchbot,
			'ptype'=>'searchkey',
			'dateline'=>$_G['timestamp'],
			'date'=>date("Y-m-d.G:i:s"),
			'time'=>date("Ymd"),
			'url'=>$url_this
		);
		DB::query("INSERT INTO ".DB::table('ext_robot')." (rtype, ptype, dateline, date, time, url) VALUES ('$insertarr[rtype]', '$insertarr[ptype]', '$insertarr[dateline]', '$insertarr[date]', '$insertarr[time]', '$insertarr[url]')");
	}
	
	function get_naps_bot()
	{
		$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
		if (strpos($useragent, 'googlebot') !== false){
			return 'Googlebot';
		}
		if (strpos($useragent, 'baiduspider') !== false){
			return 'Baiduspider';
		}
		return false;
	}
	*/
	function orstr($keys,$or){
		$keys = addslashes($keys);
		$orlist;
		$nbsps = "/[\s]+/";
		$keyslist=preg_split($nbsps,$keys);
        if(count($keyslist)>1){
			foreach ($keyslist as $keysrow) {
				if($keysrow !=""){
					$orlist.= "or ".$or."'%$keysrow%'";
				}
		    }
			return substr($orlist,2);
		}else{
			$orlist=$or."'%$keys%'";
			return $orlist;
		}
	}
    
    function createrulewhere($rule, $rulearr, $where='portal') {
    	$wherearr = array(
    		'portal'=>'at.title LIKE',
    		'forum'=>'t.subject LIKE',
    		'blog'=>'b.subject LIKE'
    	);
    	$rule = str_replace(array('(', ')', '&&', '##'), array(' ( ', ' ) ', ' AND ', ' OR '), $rule);
    	if (is_array($rulearr)) {
    		foreach ($rulearr as $rs) {
    			if (!empty($rs)) {
    				$rule = str_replace($rs, $wherearr[$where]." '%{$rs}%'", $rule);
    			} else {
    				return false;
    			}
    		}
    		return $rule;
    	} else {
    		return false;
    	}
    }
    
    function updatesearchkeystate($searchid, $state) {
		global $_G;
		DB::fetch_first("UPDATE ".DB::table('plugin_searchkey_searchindex')." SET state='{$state}' ,lasttime=".$_G['timestamp']." WHERE searchid = '{$searchid}'");
	}
	
?>