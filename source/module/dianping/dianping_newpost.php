<?php
/**
 *	潜水详情页
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

$tid = $_GET['tid'];

if($tid <= 0) { showmessage('参数错误'); }

global  $_G;
$postdata = array_merge($_GET, $_POST);
//$postdata = iconv_array($postdata, 'UTF-8', 'GBK'); // jquery ajax提交转码
$fid=$dp_modules[$_GET['model']]['fid'];
// 简单验证
$star_num = intval($postdata['starnum']);

$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
$pid = insertpost(array(
	'fid' => $fid,
	'tid' => $tid,
	'first' => '0',
	'author' => $_G['username'],
	'authorid' => $_G['uid'],
	'subject' => '',
	'dateline' => $_G['timestamp'],
	'message' => $postdata['message'],
	'useip' => $_G['clientip'],
	'attachment' => '0',
));
// 新增点评分数
require_once libfile('function/post');

	//判断是否已评分
	$stat=DB::fetch_first("SELECT id FROM ".DB::table('dianping_star_statistics')."  where typeid={$tid}");
	if($stat['id']){
		
		$starid=$stat['id'];
		
	}else{
		
		$starid=DB::insert('dianping_star_statistics',array('type'=>'forum','typeid'=>$tid,'fid' => $fid),1);
				
	}
	//判断用户是否已点评
	$star_logs=DB::fetch_first("SELECT starid FROM ".DB::table('dianping_star_logs')."  where starid={$starid} and uid={$_G['uid']}");

	if($starid && $star_num && !$star_logs['starid']){
		$logsid=DB::insert('dianping_star_logs',array(
								'starid'=>$starid,
								'starnum'=>$star_num,
								'dateline'=>$_G['timestamp'],
								'uid' => $_G['uid'],
								'username' => $_G['username'],
								'pid' => $pid,
								'ip' => $_G['clientip'],
								'goodpoint' => trim(dhtmlspecialchars($postdata['goodpoint'])),
								'weakpoint' => trim(dhtmlspecialchars($postdata['weakpoint'])),
								'lastupdate' => $_G['timestamp']
							));
	}
	$score = updateStar($starid);
	
	if($score){
		DB::update('dianping_shop_info',array('score'=>$score),"tid={$tid}");	
	}					
	//更新热度
	$thread = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid={$tid} ".getSlaveID());
	$heat = $thread['heats'];	
	if($thread['lastposter'] != $_G['member']['username']) {
		$posttable = getposttablebytid($tid);
		$userreplies = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid={$tid} AND first='0' AND authorid='$_G[uid]'");
		$thread['heats'] += fround($_G['setting']['heatthread']['reply'] * pow(0.8, $userreplies));		
		DB::query("UPDATE ".DB::table('forum_thread')." SET heats='$thread[heats]' WHERE tid={$tid}", 'UNBUFFERED');		
	}
	// 相关更新
	$lastpost = "{$tid}\t\t{$_G['timestamp']}\t{$_G['username']}";
	DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', posts=posts+1, todayposts=todayposts+1 WHERE fid={$fid}", 'UNBUFFERED');
	
	require_once libfile('function/stat');
	updatestat('post');
	$typeid = DB::result_first("SELECT typeid FROM ".DB::table('forum_thread')." WHERE tid='{$tid}'");
	
	DB::query("UPDATE ".DB::table('forum_threadclass')." SET todayposts=todayposts+1 WHERE typeid={$typeid}", 'UNBUFFERED');
	updatepostcredits('+', $_G['uid'], 'reply', $fid); // 更新积分
	
	DB::query("UPDATE ".DB::table('forum_thread')." SET replies=replies+1,lastpost='{$_G['timestamp']}',lastposter='{$_G['username']}' where tid={$tid}");
	// 更新点评人数
	updateNum($tid, $starid);
	
	$array = DB::fetch_first("SELECT * FROM " . DB::table('forum_post') . " WHERE pid={$pid}");	

/**
 * 
 * 更新评分
 * @param unknown_type $starid
 */
function updateStar($starid){
	

	$stararray=DB::query("SELECT starnum,COUNT(starnum) AS c FROM ".DB::table('dianping_star_logs')." where starid={$starid} GROUP BY starnum");
	
		while ($row=DB::fetch($stararray)){
			
			$countArray[$row['starnum']]=$row;
			
		}

	if(is_array($countArray)){
		$count = intval($countArray[1]['c'])+intval($countArray[2]['c'])+intval($countArray[3]['c'])+intval($countArray[4]['c'])+intval($countArray[5]['c']);
		$p1 = fround(intval($countArray[1]['c']) / $count * 100, 1);
		$p2 = fround(intval($countArray[2]['c']) / $count * 100, 1);
		$p3 = fround(intval($countArray[3]['c']) / $count * 100, 1);
		$p4 = fround(intval($countArray[4]['c']) / $count * 100, 1);
		$p5 = fround(intval($countArray[5]['c']) / $count * 100, 1);
		$price = fround($p5 / 100 * 10 + $p4 / 100 * 8 + $p3 / 100 * 6 + $p2 / 100 * 4 + $p1 / 100 * 2, 1);

		$nowdata = DB::fetch_first('SELECT * FROM '.DB::table('dianping_star_statistics').' where id='.$starid);
		$editarr = array(
				'percent1' => $p1,
				'percent2' => $p2,
				'percent3' => $p3,
				'percent4' => $p4,
				'percent5' => $p5,
				'count' => $count,
				'price' => $price
		);
		if((time() - $nowdata['lasttime']) >= 7*24*3600){
			$editarr['lasttime'] = time();
			$editarr['lastprice'] = $price;
		}
		if($nowdata['lastprice'] != $price){
			$editarr['lastchange'] = $nowdata['lastprice'] > $price ? -1 : 1;
		}else{
			$editarr['lastchange'] = 0;
		}
		if($nowdata['fid'] == 0){
			$editarr['fid'] = DB::result_first("SELECT fid FROM ".DB::table('forum_thread')." WHERE tid = {$nowdata['typeid']}");
		}
		DB::update('dianping_star_statistics',$editarr,"id={$starid}");
		return $price;
	}else{
	return 0;
	}
}

function fround($num, $precision) {
	$num = round($num, $precision);
	if (preg_match('/^\d+$/', $num)) {
		$num = $num.'.'.str_repeat('0', $precision);
	} elseif (preg_match('/^\d+\.(\d+)$/', $num, $m)) {
		$num = $num.str_repeat('0', $precision-$m[1]);
	}
	return $num;
}

function updateNum($tid, $starid = 0){
	if(!$tid){
		return false;
	}
	$res = DB::fetch_first("SELECT COUNT(starid) AS count FROM ".DB::table('dianping_star_logs')." where starid={$starid}");
	DB::update('dianping_shop_info',array('cnum'=>$res['count']),"tid={$tid}");
}
?>
