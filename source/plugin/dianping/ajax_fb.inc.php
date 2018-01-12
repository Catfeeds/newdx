<?php
/**
 * 有奖点评信息发布到点评管理中
 * ver 0.1
 * update: 2016.06.15
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$quick_id = trim($_GET['quick_id']);
$tid = trim($_GET['tid']);
$quick_sql = "SELECT * FROM ".DB::table('plugin_dianping_quick_reply')." WHERE id='".$quick_id."'";
$quick_info = DB::fetch_first($quick_sql);
$authorid = $quick_info['authorid'];
$authorname = $quick_info['authorname'];
$star_num = $quick_info['starnum'];

if($_G['groupid']==1){
	$sql = "SELECT * FROM ".DB::table('forum_thread')." WHERE tid=".$tid;
	$query = DB::query($sql);
	if(DB::num_rows($query)){
		$sql_author = "SELECT * FROM ".DB::table('forum_post')." WHERE authorid=".$authorid." AND first=0 AND tid='".$tid."'";
		$query_author = DB::query($sql_author);
			
		$thread = DB::fetch_first($sql);
		$fid = $thread["fid"];
		$fids = array("490"=>"equipment","477"=>"skiing","408"=>"brand","471"=>"shop","392"=>"mountain","494"=>"line","497"=>"climb","498"=>"diving","499"=>"fishing");
		$mod = $fid=='' ? '' : $fids[$fid];
		//每个用户只能评价一次
		if(DB::num_rows($query_author)>0){
			echo "re_authorid";
		}else{
			DB::query("UPDATE ".DB::table('plugin_dianping_quick_reply')." SET tid={$tid},exportdate={$_G[timestamp]},opuid={$_G['uid']},opusername='".$_G['username']."'  WHERE id='".$quick_id."'");
			$feedmessage=array();
			$pid = insertpost(array(
					'fid' => $fid,
					'tid' => $tid,
					'first' => '0',
					'author' => $authorname,
					'authorid' => $authorid,
					'subject' => '',
					'dateline' => $quick_info['dateline'],
					'message' => $quick_info['data4'],
					'useip' => $quick_info['useip'],
					'attachment' => 0
			));
			$feedmessage['starnum']=$star_num;
			$sql_statistics = "SELECT id FROM ".DB::table('dianping_star_statistics')." WHERE typeid='".$tid."'";
			$starid=DB::result_first($sql_statistics);
			$insertdata=array(
					'starid' => $starid,
					'starnum' => $star_num,
					'dateline' => $quick_info['dateline'],
					'uid' => $authorid,
					'username' => $authorname,
					'pid' => $pid,
					'ip' => $quick_info['useip']
			);
			if($quick_info['data1']){
				if($fid=='392'||$fid=='494'){
					//时间格式2016-06-01至2016-06-01,1-18
					$date_info = explode(',',$quick_info['data1']);
					$dates = explode('至', $date_info[0]);
					$hours = explode('-',$date_info[1]);
					$starthour = intval($hours[0]);
					$endhour = intval($hours[1]);
					$ext1 = strtotime($dates[0]);
					$ext2 = strtotime($dates[1]);
					$tempJiange = $ext2 - $ext1;
					if($ext1 == $ext2&&$starthour&&$endhour){
						if($fid=='494'){
							$insertdata['ext1'] = $ext1;
							$insertdata['ext2'] = $ext2;
							$insertdata['ext4'] = $starthour;
							$insertdata['ext5'] = $endhour;
						}else{
							$insertdata['ext1'] = $ext1+($starthour*3600);
							$insertdata['ext2'] = $ext2+($endhour*3600);
						}
						$feedmessage['时间'] = date('Y-m-d',$ext1)." ".$starthour."时 - ".$endhour."时 共".($endhour-$starthour)."时";
					}else{
						$insertdata['ext1'] = $ext1;
						$insertdata['ext2'] = $ext2;
						$feedmessage['时间'] = date('Y-m-d',$ext1)." 至  ".date('Y-m-d',$ext2)." 共".ceil($tempJiange/86400)."天";
					}
				}else if($fid=='490'){
					//$fid!='408'&&$fid!='471'&&$fid!='477'&&$fid!='497'&&$fid!='498'&&$fid!='499'
					$extdata['price'] = $quick_info['data1'];
					$insertdata['extdata'] = addslashes(serialize(dstripslashes($extdata)));
					$feedmessage['价格来源']=$extdata['price'] = trim(dhtmlspecialchars($quick_info['data1']));
				}
			}
			if($quick_info['data2']){
				if($fid=='392'){
					$insertdata['ext3']=$quick_info['data2'];
					$feedmessage['费用协作']=$insertdata['ext3'];
				}else if($fid=='494'){
					$insertdata['ext3']=$quick_info['data2'];
					$feedmessage['费用']=$insertdata['ext3'];
				}else{
					$insertdata['weakpoint']=$quick_info['data2'];
					$feedmessage['不足']=$quick_info['data2'];
				}
			}
			if($quick_info['data3']){
				if($fid=='392'){
					$insertdata['ext4']=$quick_info['data3'];
					$feedmessage['我的建议']=$quick_info['data3'];
				}else if($fid=='494'){
					$insertdata['weakpoint']=$quick_info['data3'];
					$feedmessage['注意']=$quick_info['data3'];
				}else{
					$insertdata['goodpoint']=$quick_info['data3'];
					$feedmessage['优点']=$quick_info['data3'];
				}
			}
			$logsid = DB::insert('dianping_star_logs',$insertdata);
			//更新点评统计信息
			$score = updateStar($starid);
			//更新点评装备信息表
			if($score){
				DB::update("dianping_{$mod}_info",array('score'=>$score,'lastpost'=>$_G['timestamp']),"tid={$tid}");
			}
			//更新点评热度
			$thread = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid={$tid} ".getSlaveID());
			$heat = $thread['heats'];
			if($thread['lastposter'] != $authorid) {
				$posttable = getposttablebytid($tid);
				$userreplies = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid={$tid} AND first='0' AND authorid='$authorid'");
				$thread['heats'] += fround($_G['setting']['heatthread']['reply'] * pow(0.8, $userreplies));
				DB::query("UPDATE ".DB::table('forum_thread')." SET heats='$thread[heats]' WHERE tid={$tid}", 'UNBUFFERED');
			}
			//相关更新
			$lastpost = "{$tid}\t\t{$_G['timestamp']}\t{$authorname}";
			DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', posts=posts+1, todayposts=todayposts+1 WHERE fid={$fid}", 'UNBUFFERED');

			require_once libfile('function/stat');
			updatestat('post');
			$typeid = DB::result_first("SELECT typeid FROM ".DB::table('forum_thread')." WHERE tid='{$tid}'");

			DB::query("UPDATE ".DB::table('forum_threadclass')." SET todayposts=todayposts+1 WHERE typeid={$typeid}", 'UNBUFFERED');
			require_once libfile('function/post');
			updatepostcredits('+', $authorid, 'reply', $fid); // 更新积分

			DB::query("UPDATE ".DB::table('forum_thread')." SET replies=replies+1,lastpost='{$_G['timestamp']}',lastposter='{$authorname}' WHERE tid={$tid}");
			// 更新点评人数
			updateNum($tid, $starid,"dianping_{$mod}_info");
			
			//增加用户动态
			require_once libfile('function/feed');
			require_once libfile('function/dianping');
			//$feedurl=dp_rewrite("http://www.8264.com/dianping.php?mod=$mod&act=showview&tid={$tid}");
			//feed_add('dianping', 'feed_dianping_title', array('hash_data' => 'tid'.$tid), 'feed_dianping_body', array('subject' => '<a href="'.$feedurl.'">'.$thread['subject'].'</a>', 'starnum' => $star_num, 'mod' => $mod));
				
			$feedmessage['综合'] 	= $quick_info['data4'];
			$feedmessage['subject'] = $quick_info['subject'];
			$feedarr=array(
					'uid' 	   => $authorid,
					'username' => $authorname,
					'fid' 	   => $fid,
					'id' 	   => $tid,
					'pid'  	   => $pid,
					'type'     => 3,
					'subject'  => "发布新点评",
					'dateline' => $_G[timestamp],
					'message'  => serialize(dstripslashes($feedmessage)),
			);
			feed_add_ucenter($feedarr);
			echo "ok";
		}
	}else{
		echo "no_tid";
	}
}else{
	echo "error";
}	

/**
 *
 * 更新评分
 * @param unknown_type $starid
 */
function updateStar($starid){

	$stararray=DB::query("SELECT starnum,COUNT(starnum) AS c FROM ".DB::table('dianping_star_logs')." WHERE starid={$starid} GROUP BY starnum");

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

		$nowdata = DB::fetch_first('SELECT * FROM '.DB::table('dianping_star_statistics').' WHERE id='.$starid);
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

function updateNum($tid, $starid = 0,$mod){
	if(!$tid){
		return false;
	}
	$res = DB::fetch_first("SELECT COUNT(starid) AS count FROM ".DB::table('dianping_star_logs')." WHERE starid={$starid}");
	DB::update($mod,array('cnum'=>$res['count']),"tid={$tid}");
}