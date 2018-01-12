<?php

	if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}
	require_once(DISCUZ_ROOT.'./source/plugin/'.$pluginmodule['directory'].'./common.php');
	$auditnum = 2;
	$lastmonth = $_G['timestamp'] - 60*60*24*30;
		
	$allcount = DB::result_first("SELECT count(*) as count FROM ".DB::table('plugin_searchkey_searchindex')." WHERE state=0 and lasttime < '{$lastmonth}'");
	$keyslist = array();
	$query = DB::query("SELECT *  FROM ".DB::table('plugin_searchkey_searchindex') ." WHERE state=0 and lasttime < '{$lastmonth}' limit ".$auditnum);
	while($value = DB::fetch($query)){
		$keyslist[] = $value;
		$keys = $value['keywords'];
		$addwhere['portal'] = $addwhere['forum'] = $addwhere['blog'] = false;
		if (!empty($index['rule'])) {
			$rulestrarr = array('(', ')', '&&', '##');
			foreach ($rulestrarr as $rs) {
				$rulestrcount += substr_count($index['rule'], $rs);
			}
			if ($rulestrcount > 0) {
				$rulestr = str_replace($rulestrarr, array('', '', '&dfadf&', '&dfadf&'), $index['rule']);
				$rulearr = explode('&dfadf&', $rulestr);
				$addwhere['portal'] = createrulewhere($index['rule'], $rulearr, 'portal');
				$addwhere['forum'] = createrulewhere($index['rule'], $rulearr, 'forum');
				$addwhere['blog'] = createrulewhere($index['rule'], $rulearr, 'blog');					
			} else {
				$keys = $index['rule'];			
			}
		}
		
		if (!$addwhere['portal']) {
			$addwhere['portal'] = orstr($keys,"at.title LIKE");
		}
		$sql = "SELECT count(1) FROM ".DB::table('portal_article_title')." at where 1 AND {$addwhere['portal']} LIMIT 1";
		$portalcount = DB::result_first($sql);
		if ($portalcount > 0) {
			updatesearchkeystate($value['searchid'], 1);
			continue;
		}
		
		if (!$addwhere['blog']) {
			$addwhere['blog'] = orstr($keys,"b.subject like");
		}
		$sql = "SELECT count(1) FROM ".DB::table('home_blog')." b where 1 AND {$addwhere['blog']} LIMIT 1";
		$blogcount = DB::result_first($sql);
		if ($blogcount > 0) {
			updatesearchkeystate($value['searchid'], 1);
			continue;
		}

		if (!$addwhere['forum']) {
			$addwhere['forum'] = orstr($keys,"subject LIKE");
		}
		$sql = "SELECT count(1) FROM ".DB::table('forum_thread')." WHERE isgroup='0' AND displayorder>='0' AND {$addwhere['forum']} LIMIT 1";
		$forumcount = DB::result_first($sql);
		if ($forumcount > 0) {
			updatesearchkeystate($value['searchid'], 1);
			continue;
		}	
		updatesearchkeystate($value['searchid'], 0);
	}
	if ($keyslist) {
		showmessage('还有 '.($allcount-$auditnum).' 条未审核!', "plugin.php?id=searchindex:audit");
	} else {
		showmessage("自动审核完成!", "plugin.php?id=searchindex:adminsearch");
	}
?>
