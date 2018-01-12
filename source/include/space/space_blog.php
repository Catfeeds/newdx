<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_blog.php 19158 2010-12-20 08:21:50Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/space');
space_merge($space, 'count');

$minhot = $_G['setting']['feedhotmin'] < 1 ? 3 : $_G['setting']['feedhotmin'];
$page 	= empty($_GET['page']) ? 1 : intval($_GET['page']);
if($page < 1) $page = 1;
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);

if($id) {
	
	//日志详细
	
	$query = DB::query("SELECT bf.*, b.* FROM ".DB::table('home_blog')." b LEFT JOIN ".DB::table('home_blogfield')." bf ON bf.blogid=b.blogid WHERE b.blogid='$id' AND b.uid='$space[uid]'");
	$blog  = DB::fetch($query);
	if(!(!empty($blog) && ($blog['status'] == 0 || $blog['uid'] == $_G['uid'] || $_G['adminid'] == 1 || $_G['gp_modblogkey'] == modauthkey($blog['blogid'])))) {
		showmessage('view_to_info_did_not_exist');
	}
	
	if($_G['adminid'] != 1 && !$space['self'] && $blog['friend'] > 0) {		
		showmessage("由于 {$blog['username']} 的隐私设置，你不能访问当前内容",dreferer());
	}
	
	//个人分类
	$query 	  = DB::query("SELECT classid, classname FROM ".DB::table('home_class')." WHERE classid='$blog[classid]'");
	$classarr = DB::fetch($query);

	//日志内容
	require_once libfile('function/blog');
	$blog['message'] = blog_bbcode($blog['message']);
	$home_url = $_G['config']['web']['home']; // 请将此链接地址改为您的 UCHome 站点地址！！！
	$bbs_url  = $_G['config']['web']['forum']; // 请将此链接地址改为您的 BBS 站点地址！！！
	$findarr  = array(
	'<img src="attachment/',  //原uchmoe附件图片目录
	'<IMG src="'.$home_url.'attachment/',  // 原UCHome附件图片目录
	$bbs_url.'attachments/month',  // 原论坛附件图片目录
	);
	$replacearr = array(
	'<img src="'.$_G['config']['web']['attach'].'album/',
	'<IMG src="'.$_G['config']['web']['attach'].'album/',
	 $bbs_url.$_G['config']['web']['attach'].'forum/month',
	);
	$blog['message'] = str_replace($findarr, $replacearr, $blog['message']);

	//获得评论列表
	$perpage = 10;
	$perpage = mob_perpage($perpage);
	$start   = ($page-1) * $perpage;
	ckstart($start, $perpage);
	$count   = $blog['replynum'];
	$list 	 = array();
	if($count) {
		$query = DB::query("SELECT * FROM ".DB::table('home_comment')." WHERE id='{$id}' AND idtype='blogid' ORDER BY dateline desc LIMIT {$start},{$perpage}");
		while ($value = DB::fetch($query)) {
			$list[] = $value;
		}

		if(empty($list)) {
			$count = getcount('home_comment', array('id'=>$id, 'idtype'=>'blogid'));
			DB::update('home_blog', array('replynum'=>$count), array('blogid'=>$blog['blogid']));
		}
	}

	$multi = multi($count, $perpage, $page, "home.php?mod=space&uid=$blog[uid]&do=$do&id=$id#comment");	
	
	//更新浏览量
	DB::query("UPDATE ".DB::table('home_blog')." SET viewnum=viewnum+1 WHERE blogid='$blog[blogid]'");
	DB::query("UPDATE ".DB::table ('common_member_count')." SET views=views+1 WHERE uid='$blog[uid]'");
	
	//上一篇文章和下一篇文章
	$sql = "SELECT b.blogid,b.subject FROM pre_home_blog b WHERE b.uid='{$blog['uid']}' and b.dateline < '{$blog['dateline']}' ORDER BY b.dateline DESC LIMIT 0,1";
	$nextBlog = DB::fetch_first($sql);
	$sql = "SELECT b.blogid,b.subject FROM pre_home_blog b WHERE b.uid='{$blog['uid']}' and b.dateline > '{$blog['dateline']}' ORDER BY b.dateline asc LIMIT 0,1";
	$prevBlog = DB::fetch_first($sql);
	
	$hash 	= md5($blog['uid']."\t".$blog['dateline']);
	$id 	= $blog['blogid'];
	$idtype = 'blogid';

	$navtitle 			= $blog['subject'].' - '.lang('space', 'sb_blog', array('who' => $blog['username']));
	$metakeywords 		= $blog['tag'] ? $blog['tag'] : $blog['subject'];
	$metadescription 	= cutstr(strip_tags($blog['message']), 140);

	if ($_G['gp_tpl']) {
		include_once template("diy:home/space_blog_view20141208");
	} else {
		include_once template("home/space_blog_view");
	}

} else {
	
	//日志列表
	$onlyUc = $_G['gp_view'] == 'me' && $_GET['from'] == 'space' ? true : false;

	loadcache('blogcategory');
	$category = $_G['cache']['blogcategory'];

	if(empty($_GET['view'])) $_GET['view'] = 'we';

	$perpage = 10;
	$perpage = mob_perpage($perpage);
	$start 	 = ($page-1)*$perpage;
	ckstart($start, $perpage);

	$summarylen = 300;

	$classarr 	= array();
	$list 		= array();
	$userlist 	= array();
	$count 		= $pricount = 0;

	$gets = array(
		'mod' 		=> 'space',
		'uid' 		=> $space['uid'],
		'do' 		=> 'blog',
		'view' 		=> $_GET['view'],
		'order' 	=> $_GET['order'],
		'classid' 	=> $_GET['classid'],
		'catid' 	=> $_GET['catid'],
		'clickid' 	=> $_GET['clickid'],
		'fuid' 		=> $_GET['fuid'],
		'searchkey' => $_GET['searchkey'],
		'from' 		=> $_GET['from'],
		'friend' 	=> $_GET['friend']
	);
	
	//分页，解决classid为0的问题(默认分类)
	if ($onlyUc) {
		$theurl = 'home.php?';
		$arr = array();
		foreach ($gets as $key => $value) {
			if($value || (is_numeric($_GET['classid']) && $key == 'classid')) {
				$arr[] = $key.'='.urlencode(dstripslashes($value));
			}
		}
		$theurl .= implode('&', $arr);
	} else {
		$theurl = 'home.php?'.url_implode($gets);
	}	

	$wheresql 	  = '1';
	$f_index  	  = '';
	$ordersql 	  = 'b.dateline DESC';
	$need_count   = true;
	$privacyWhere = '';

	if($_GET['view'] == 'all') {
		if($_GET['order'] == 'hot') {
			$wheresql .= " AND b.hot>='$minhot'";

			$orderactives = array('hot' => ' class="a"');
		} else {
			$orderactives = array('dateline' => ' class="a"');
		}

	} elseif($_GET['view'] == 'me') {

		$wheresql .= " AND b.uid='$space[uid]'";

		$classid = empty($_GET['classid']) ? 0 : intval($_GET['classid']);
		if(is_numeric($_GET['classid'])) {
			$wheresql .= " AND b.classid='$classid'";
		}

		$privacyfriend = empty($_G['gp_friend']) ? 0 : intval($_G['gp_friend']);
		if($privacyfriend) {
			$wheresql .= " AND b.friend='$privacyfriend'";
		}
		
		//获得此用户的日志分类
		$classnumSql 	= array();
		$classnumList   = array();
		$allcount       = 0;
		$query = DB::query("SELECT classid, classname FROM ".DB::table('home_class')." WHERE uid='$space[uid]'");
		$privacyWhere = !ckperm() ? ' and status = 0 and friend = 0 ' : '';
		while ($value = DB::fetch($query)) {
			$classarr[$value['classid']] = $value['classname'];
			
			//获得每个分类的日志数
			if ($onlyUc) {			
				$classnumSql[] = "(select count(*) as count,{$value['classid']} as classid from " . DB::table('home_blog') . " where uid={$space['uid']} and classid={$value['classid']} {$privacyWhere})";
			}
		}
		
		//获得每个分类的日志数
		$classnumSql  = $classnumSql ? implode(' union all ', $classnumSql) : '';
		$sql  		  = "(select count(*) as count,0 as classid from " . DB::table('home_blog') . " where uid={$space['uid']} and classid=0 {$privacyWhere})";
		$sql 		 .= $classnumSql ? " union all " . $classnumSql  : "";
		$sql 	 	 .= ' '. getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$classnumList[$v['classid']] = $v['count'];
			$allcount += $v['count'];
		}

		if($_GET['from'] == 'space') $diymode = 1;

	} else {

		space_merge($space, 'field_home');

		if($space['feedfriend']) {

			$fuid_actives = array();

			require_once libfile('function/friend');
			$fuid = intval($_GET['fuid']);
			if($fuid && friend_check($fuid, $space['uid'])) {
				$wheresql = "b.uid='$fuid'";
				$fuid_actives = array($fuid=>' selected');
			} else {
				$wheresql = "b.uid IN ($space[feedfriend])";
				$theurl = "home.php?mod=space&uid=$space[uid]&do=$do&view=we";
				$f_index = 'USE INDEX(dateline)';
			}

			$query = DB::query("SELECT * FROM ".DB::table('home_friend')." WHERE uid='$space[uid]' ORDER BY num DESC LIMIT 0,100");
			while ($value = DB::fetch($query)) {
				$userlist[] = $value;
			}
		} else {
			$need_count = false;
		}
	}

	$actives = array($_GET['view'] =>' class="a"');

	if($need_count) {
		if($searchkey  = stripsearchkey($_GET['searchkey'])) {
			$wheresql .= " AND b.subject LIKE '%$searchkey%'";
			$searchkey = dhtmlspecialchars($searchkey);
		}

		$catid = empty($_GET['catid']) ? 0 : intval($_GET['catid']);
		if($catid) {
			$wheresql .= " AND b.catid='$catid'";
		}

		if ($onlyUc) {
			$count = is_numeric($_GET['classid']) ? $classnumList[$classid] : $allcount;
		} else {
			$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('home_blog')." b WHERE $wheresql"),0);
		}
		if($count) {
			$sql   = "SELECT bf.*, b.* FROM ".DB::table('home_blog')." b {$f_index} LEFT JOIN ".DB::table('home_blogfield')." bf ON bf.blogid=b.blogid WHERE {$wheresql}";
			$sql  .= $onlyUc ? $privacyWhere : '';
			$sql  .= " ORDER BY {$ordersql} LIMIT {$start},{$perpage}";		
			$query = DB::query($sql);
		}
	}
	
	/*读取所有附件服务器的域名*/
	require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
	$attachserver = new attachserver;
	$domain = $attachserver->get_server_domain('all');
	/*结束*/
	
	if($count) {
		while ($value = DB::fetch($query)) {
			if((ckperm($value) && !$onlyUc) || $onlyUc) {
				$value['message'] 	= getstr($value['message'], $summarylen, 0, 0, 0, -1);
				$value['message']   = preg_replace("/&[a-z]+\;/i", '', $value['message']);
				if($value['pic']) $value['pic'] = pic_cover_get($value['pic'], $value['picflag'], $domain[$value['serverid']]);
				$value['dateU'] 	= $value['dateline'];
				$value['dateline']  = dgmdate($value['dateline']);
				$list[] = $value;
			} else {
				$pricount++;
			}		
		}		

		$multi = multi($count, $perpage, $page, $theurl);
		
		//计算日志年份标签
		if ($onlyUc) {
			$arrYear = array();
			if ($page > 1) {
				$tempDateline = DB::result_first("SELECT dateline FROM ".DB::table('home_blog')." b WHERE dateline > '{$list[0]['dateU']}' ORDER BY b.dateline asc limit 0,1");
				$tempDateline = date('Y', $tempDateline);
				$arrYear[$tempDateline] = $tempDateline;
				unset($tempDateline);
			}
		}		
	}
	
	$classname = $classarr[$classid];
	$classname = $classid == 0 && isset($_G['gp_classid']) ? '个人' : $classname;
	
	$navtitle        = "{$space['username']}的{$classname}日志";
	$metakeywords    = $navtitle;
	$metadescription = $navtitle;

	space_merge($space, 'field_home');	
	
	if ($onlyUc) {
		//个人中心的日志模板不走原来的模板，梳理程序
		if ($_G['gp_tpl']) {
			include_once template("diy:home/space_blog_list");
		} else {
			include_once template("home/space_blog_list_uc");
		}
	} else {
		include_once template("diy:home/space_blog_list");
	}

}
?>
