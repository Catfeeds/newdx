<?php

    if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}

	require_once(DISCUZ_ROOT.'./source/plugin/'.$pluginmodule['directory'].'./common.php');

	if($manager == 0) {
		showmessage('本页面需要管理权限', 'zhuanti', 1);
	}

	$navtitle = '8264户外热点列表 - 管理列表';
	if($_G['gp_operation'] == 'all'){
		$perpage = 50;
		$page = max(1, intval($_G['gp_page']));
		$start_limit = ($page - 1) * $perpage;
		$index = DB::fetch_first("SELECT COUNT(*) as count FROM ".DB::table('plugin_searchkey_searchindex').' where 1');
		$ing_lists = array();
		$ing_query = DB::query("SELECT searchid,keywords,srchmod,dateline,num,rule,state,lasttime FROM ".DB::table('plugin_searchkey_searchindex')." where 1 order by searchid desc LIMIT ". $start_limit .','.$perpage);
		$statearr = array('0'=>'否', '1'=>'是');
		while($value = DB::fetch($ing_query)){
			$value['dateline'] = dgmdate($value['dateline'], 'Y-m-d H:i');
			if ($value['lasttime']) {
				$value['lasttime'] = date($value['lasttime'], 'Y-m-d');
			}
			$ing_lists[] = $value;
		}
		$multipage = multi($index['count'], $perpage, $page, "plugin.php?id=searchindex:adminsearch&operation=all");
	}
	if($_G['gp_operation'] == 'delete'){

		$checkbox = $_POST['checkbox'];
		for($i=0;$i<=count($checkbox);$i++)
		{
			if(!is_null($checkbox[$i])){
				$chechvalue.=$checkbox[$i].',';
			}
		}
		$idlist=explode(',', $chechvalue);
		foreach ($idlist as $idrow) {
				if($idrow !=""){
					DB::query("DELETE FROM ".DB::table('plugin_searchkey_searchindex')." WHERE searchid='$idrow'");
				}
		}
		showmessage(lang('plugin/adminsearch', '删除成功！'), dreferer());

	}else if($_G['gp_operation'] == 'edit'){
		if(!$_G['gp_editsubmit']){
			$searchid = intval($_G['gp_searchid']);
			$keysinfo = DB::fetch_first("SELECT * FROM ".DB::table('plugin_searchkey_searchindex')." WHERE searchid='$searchid'");
			$navtitle = '8264户外热点列表 - 关键词编辑';
			include template('searchindex:edit');
			exit;
		}else{

			$fastsubmit = intval($_G['gp_fastsubmit']);
			$searchid = intval($_G['gp_searchid']);
			$keywords = dhtmlspecialchars($_G['gp_keywords']);
			$rule = str_replace(array('（','）','＆＆','＃＃'), array('(',')','&&','##'), $_G['gp_rule']);
			$rule = str_replace(array('(',')','&&','##'), array('searchrulekzuo','searchrulekyou','searchrulebing','searchrulehuo'), $rule);
			$rule = dhtmlspecialchars($rule);
			$rule = str_replace(array('searchrulekzuo','searchrulekyou','searchrulebing','searchrulehuo'), array('(',')','&&','##'), $rule);
			$portalids = dhtmlspecialchars($_G['gp_portalids']);
			$portalids = str_replace('，', ',', $portalids);
			$forumids = dhtmlspecialchars($_G['gp_forumids']);
			$forumids = str_replace('，', ',', $forumids);
			$blogids = dhtmlspecialchars($_G['gp_blogids']);
			$blogids = str_replace('，', ',', $blogids);
			$state = intval($_G['gp_state']);
			
			$index = DB::fetch_first("SELECT * FROM ".DB::table('plugin_searchkey_searchindex')." WHERE searchid='$searchid'");
			$keys = $index['keywords'];
			if (!empty($index['rule'])) {
				$rulestrarr = array('(', ')', '&&', '##');
				foreach ($rulestrarr as $rs) {
					$rulestrcount += substr_count($index['rule'], $rs);
				}
				if ($rulestrcount == 0) {
					$keys = $index['rule'];
				}
			}
			$ids = '';
			if (!$addwhere['forum']) {
				$addwhere['forum'] = orstr($keys,"subject LIKE");
			}
			$sql = "SELECT tid FROM ".DB::table('forum_thread')." WHERE isgroup='0' AND displayorder>='0' AND {$addwhere['forum']} ORDER BY tid DESC";
	        $query = DB::query($sql);
		    while($article = DB::fetch($query)){
				if (empty($ids)) {
					$ids .= $article['tid'];
				} else {
					$ids .= ','.$article['tid'];
				}
			}
			DB::query("update ".DB::table('plugin_searchkey_searchindex')." set ids='$ids' where searchid='$searchid'");
			
			
			if(empty($keywords) && !$fastsubmit){
				showmessage('关键字不能为空', "plugin.php?id=searchindex:adminsearch&operation=edit&searchid={$searchid}");
			} elseif (!empty($rule)) {
				$rulestrarr = array('(', ')', '&&', '##');
				foreach ($rulestrarr as $rs) {
					$rulestrcount += substr_count($rule, $rs);
				}
				if ($rulestrcount > 0) {
					$rulestr = str_replace($rulestrarr, array('', '', '&dfadf&', '&dfadf&'), $rule);
					$rulearr = explode('&dfadf&', $rulestr);
					if (is_array($rulearr)) {
						if (count($rulearr)<=1) {
							$ruleerror = '搜索规则错误,短语必须大于一';
						}
						foreach ($rulearr as $rs) {
							if (empty($rs)) {
								$ruleerror = '搜索规则错误,短语不能为空';
								break;
							}
							if (substr_count($rule, $rs) != 1) {
								$ruleerror = '搜索规则错误,短语只能出现一次';
								break;
							}
						}
					} else {
						$ruleerror = '搜索规则错误';
					}
					if ($ruleerror) {
						DB::query("INSERT INTO ".DB::table('plugin_searchkey_ruleerror')." (uid, searchid, rule, message, dateline) VALUES ('$_G[uid]', '$searchid', '$rule', '$ruleerror', '$_G[timestamp]')");
						showmessage($ruleerror, "plugin.php?id=searchindex:adminsearch&operation=edit&searchid={$searchid}");
					}
				}
			}
			
			
			if ($fastsubmit) {
				DB::query("UPDATE ".DB::table('plugin_searchkey_searchindex')." SET ids='$ids', keywords='$keywords', rule='$rule', state='$state' WHERE searchid='$searchid'");
				showmessage('修改关键字成功！', 'zhuanti/'.$searchid);
			} else {
				DB::query("UPDATE ".DB::table('plugin_searchkey_searchindex')." SET ids='$ids', keywords='$keywords', rule='$rule', portalids='$portalids', forumids='$forumids', blogids='$blogids', state='$state' WHERE searchid='$searchid'");
				showmessage('修改关键字成功！', dreferer());
			}

		}
	}
	else if($_G['gp_operation'] == 'select'){

	    $guanjianzi = $_G['gp_guanjianzi'];
		$shenhe = $_G['gp_shenhe'];
		$kaishi = $_G['gp_kaishi'];
		$jieshu = $_G['gp_jieshu'];
		$perpage = 50;
		$page = max(1, intval($_G['gp_page']));
		$start_limit = ($page - 1) * $perpage;
		$orderstr = $_G['gp_order'];
		$code = "php";
		switch($orderstr){
		 case "timehigh":
		  $sqlorderstr = " order by dateline desc ";
		  break;
		 case "timelow":
		  $sqlorderstr = " order by dateline ";
		  break;
	     case "keyshigh":
		  $sqlorderstr = " order by char_length(keywords) desc ";
		  break;
	     case "keyslow":
		  $sqlorderstr = " order by char_length(keywords) ";
		  break;
		}
		$index = DB::fetch_first("SELECT COUNT(*) as count FROM ".DB::table('plugin_searchkey_searchindex')." where 1=1 ". tiaojian($guanjianzi,$shenhe,$kaishi,$jieshu) ." {$sqlorderstr}");
		$ing_lists = array();
		$ing_query = DB::query("SELECT searchid,keywords,srchmod,dateline,num,rule,state,lasttime FROM ".DB::table('plugin_searchkey_searchindex')." where 1=1 ". tiaojian($guanjianzi,$shenhe,$kaishi,$jieshu) ." {$sqlorderstr} LIMIT ". $start_limit .','.$perpage);
		$statearr = array('0'=>'否', '1'=>'是');
		while($value = DB::fetch($ing_query)){
			$value['dateline'] = dgmdate($value['dateline'], 'Y-m-d H:i');
			if ($value['lasttime']) {
				$value['lasttime'] = date($value['lasttime'], 'Y-m-d');
			}
			$ing_lists[] = $value;
		}
		$multipage = multi($index['count'], $perpage, $page, "plugin.php?id=searchindex:adminsearch&operation=select&guanjianzi=$guanjianzi&shenhe=$shenhe&kaishi=$kaishi&jieshu=$jieshu&order=$orderstr");
	}
	function tiaojian($guanjianzi,$shenhe,$kaishi,$jieshu){
		$kai = strtotime($kaishi);
		$jie = strtotime($jieshu);
	    $tiiaojianzifuchuan;
		if(!empty($guanjianzi)){
			$tiiaojianzifuchuan.=" and keywords like '%$guanjianzi%' ";
		}
		if($shenhe!=null){
			$tiiaojianzifuchuan.="and state=".$shenhe;
		}
		if(!empty($kaishi) && !empty($jieshu)){
			$tiiaojianzifuchuan.=" and unix_timestamp(FROM_UNIXTIME(dateline,'%Y-%m-%d')) BETWEEN ".$kai." and ".$jie;
		}
		return $tiiaojianzifuchuan;
	}
    include template('searchindex:adminsearch');
?>