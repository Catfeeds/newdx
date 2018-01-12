<?php


if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

$tid = $_G['gp_tid'];

if($tid <= 0) { showmessage('参数错误'); }

if (!$_G['uid']){

	echo "-1";
	exit;
}

global  $_G;
$postdata = array_merge($_GET, $_POST);
$postdata = iconv_array($postdata, 'UTF-8', 'GBK'); // jquery ajax提交转码
$modarray = array('equipment', 'brand', 'skiing', 'shop', 'line', 'mountain', 'climb', 'diving', 'fishing','club','hostel','chain');
$mod = in_array($_GET['model'], $modarray) ? $_GET['model'] : '';
if (!$mod && $_GET['do']!="editpost"){
	echo "-2";
	exit;
}
$fid=$dp_modules[$mod]['fid'];
require_once libfile('dianping/comment', 'class');
$comment_obj = new comment();

//避免发布的内容被注入script
foreach ($postdata as $key => $value) {
	$postdata[$key] = str_ireplace(array("body", "create", "script", "src"), array("bo dy", "cre ate", "scri pt", "sr c"), $value);
}

//发布点评
if($_G['gp_do']=="newsave"){
		$feedmessage=array();
		$star_num = intval($postdata['starnum']);

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
            'attachment' => $dp_modules[$mod]['allow_pic'] ? 1 : 0,
		));

        /*start----点评评论时添加图片上传*****************************/
        if($postdata['imgselect'] && $dp_modules[$mod]['allow_pic']){
            require_once libfile('dianping/attach', 'class');
            $attach = new attach();
            $attach->handle_comment_pic($postdata['imgselect'],$tid,$pid,$_G['uid']);
        }
        /*end----点评评论时添加图片上传*******************************/

		// 新增点评分数
		require_once libfile('function/post');

			$starid=getStarid($tid, $fid);

			//判断用户是否已点评
			$star_logs=DB::fetch_first("SELECT starid FROM ".DB::table('dianping_star_logs')."  where starid={$starid} and uid={$_G['uid']}");

			if($starid && $star_num && !$star_logs['starid']){

				$insertdata=array(
							'starid'=>$starid,
							'starnum'=>$star_num,
							'dateline'=>$_G['timestamp'],
							'uid' => $_G['uid'],
							'username' => $_G['username'],
							'pid' => $pid,
							'ip' => $_G['clientip'],
							'weakpoint' => trim(dhtmlspecialchars($postdata['weakpoint'])),
							'lastupdate' => $_G['timestamp']
				);

				$feedmessage['starnum']=$star_num;
				if($postdata['extdata']){
					$feedmessage['价格来源']=$extdata['price'] = trim(dhtmlspecialchars($postdata['extdata']));
					$insertdata['extdata']=addslashes(serialize(dstripslashes($extdata)));
				}
				if($postdata['ext1'] && $postdata['ext2']){
					$tempJiange = $postdata['ext2'] - $postdata['ext1'];
					if($mod=='mountain'){
						if($postdata['ext1']==$postdata['ext2'] && $postdata['startHour'] && $postdata['endHour']){
							$insertdata['ext1'] = $postdata['ext1']+($postdata['startHour']*3600);
							$insertdata['ext2'] = $postdata['ext2']+($postdata['endHour']*3600);
							$feedmessage['时间'] = date('Y-m-d',$postdata['ext1'])." ".$postdata['startHour']."时 - ".$postdata['endHour']."时 共".($postdata['endHour']-$postdata['startHour'])."时";
						}else {
							$insertdata['ext1'] = $postdata['ext1'];
							$insertdata['ext2'] = $postdata['ext2'];
							$feedmessage['时间'] = date('Y-m-d',$postdata['ext1'])." 至  ".date('Y-m-d',$postdata['ext2'])." 共".ceil($tempJiange/86400)."天";
						}
					}elseif($mod=='line'){

						if($postdata['ext1']==$postdata['ext2'] && $postdata['ext4'] && $postdata['ext5']){
							$insertdata['ext1'] = $postdata['ext1'];
							$insertdata['ext2'] = $postdata['ext2'];
							$feedmessage['时间'] = date('Y-m-d',$postdata['ext1'])." ".$postdata['ext4']."时 - ".$postdata['ext5']."时  共".($postdata['ext5']-$postdata['ext4'])."时";
						}else {
							$insertdata['ext1'] = $postdata['ext1'];
							$insertdata['ext2'] = $postdata['ext2'];
							$feedmessage['时间'] = date('Y-m-d',$postdata['ext1'])." 至  ".date('Y-m-d',$postdata['ext2'])." 共".ceil($tempJiange/86400)."天";
						}

					}
				}
				if($postdata['ext3']){
					$insertdata['ext3']=trim(dhtmlspecialchars($postdata['ext3']));
					if($mod=='line' ){
						$feedmessage['费用']=$insertdata['ext3'];
					}elseif($mod=='mountain'){
						$feedmessage['费用协作']=$insertdata['ext3'];
					}
				}
				if($postdata['ext4']){
					$insertdata['ext4']=$postdata['ext4'];
					if($mod=='mountain'){
						$feedmessage['我的建议']=$insertdata['ext4'];
					}
				}
				if($postdata['ext5']){
					$insertdata['ext5']=$postdata['ext5'];
				}
				if($mod=='line'){
					$feedmessage['注意']=trim(dhtmlspecialchars($postdata['weakpoint']));
				}elseif($mod!='mountain'){
					$feedmessage['不足']=trim(dhtmlspecialchars($postdata['weakpoint']));
				}


				if($postdata['goodpoint']){
					$feedmessage['优点'] = $insertdata['goodpoint'] = trim(dhtmlspecialchars($postdata['goodpoint']));

				}
				$logsid=DB::insert('dianping_star_logs',$insertdata);
			}
			$score = updateStar($starid);


			if($score){
				DB::update("dianping_{$mod}_info",array('score'=>$score,'lastpost'=>$_G['timestamp']),"tid={$tid}");
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
			updateNum($tid, $starid,"dianping_{$mod}_info");



			$array = DB::fetch_first("SELECT * FROM " . DB::table('forum_post') . " WHERE pid={$pid}");
			$mycomment = $comment_obj->getdetail($pid);
			//增加用户动态
			require_once libfile('function/feed');
			require_once libfile('function/dianping');
			//$feedurl=dp_rewrite("http://www.8264.com/dianping.php?mod=$mod&act=showview&tid={$tid}");
			//feed_add('dianping', 'feed_dianping_title', array('hash_data' => 'tid'.$tid), 'feed_dianping_body', array('subject' => '<a href="'.$feedurl.'">'.$thread['subject'].'</a>', 'starnum' => $star_num, 'mod' => $mod));

			$feedmessage['综合'] 	  = $postdata['message'] = trim($postdata['message']);
			$feedmessage['imagelist'] = $mycomment['attachlist'];
			$feedmessage['subject']   =  $thread['subject'];
			$feedarr=array(
						'uid' 	   => $_G['uid'],
						'username' => $_G['username'],
						'fid' 	   => $fid,
						'id' 	   => $tid,
						'pid'  	   => $pid,
						'type'     => 3,
						'subject'  => "发布新点评",
						'dateline' => $_G[timestamp],
						'message'  => serialize(dstripslashes($feedmessage)),
					  );
			feed_add_ucenter($feedarr);

			include template("dianping/{$mod}_mycomment");

}elseif ($_G['gp_do']=="editpost"){  //获取要修改的点评

	require_once libfile('dianping/comment', 'class');
	$comment_obj = new comment();
	$nowcomment = $comment_obj->getdetail($_G['gp_pid'],'','',1);
	if($nowcomment['extdata']){
		$extdata=unserialize($nowcomment['extdata']);
		$nowcomment['extdata']=$extdata['price'];
	}
	if($nowcomment['ext1'] && $nowcomment['ext2']){
		if(date("Y-m-d",$nowcomment['ext1'])==date("Y-m-d",$nowcomment['ext2'])){
			$nowcomment['startHour'] = date('G',$nowcomment['ext1']);
			$nowcomment['endHour'] = date('G',$nowcomment['ext2']);
		}
		$nowcomment['ext1'] = date('Y-m-d',$nowcomment['ext1']);
        $nowcomment['ext2'] = date('Y-m-d',$nowcomment['ext2']);
	}
	echo json_encode(iconv_array($nowcomment));

}elseif($_G['gp_do']=='editsave'){  //修改点评提交

	if ($_G['adminid'] == 1 || $_G['uid'] ) {

        /*start----点评评论时添加图片上传*****************************/
        if($postdata['imgselect'] && $dp_modules[$mod]['allow_pic']){
            require_once libfile('dianping/attach', 'class');
            $attach = new attach();
            $attach->handle_comment_pic($postdata['imgselect'],$tid,$_G['gp_pid'],$_G['uid']);
        }
        /*end----点评评论时添加图片上传*******************************/

		DB::update('forum_post',array('message'=>trim(dhtmlspecialchars($postdata['message'])),'attachment' => $dp_modules[$mod]['allow_pic'] ? 1 : 0,)," pid={$postdata['pid']}");
		$update_array=array(
							'starnum' => $postdata['starnum'],
							'weakpoint' => trim(dhtmlspecialchars($postdata['weakpoint'])),
							'lastupdate' => $_G['timestamp'],
                            );
		if($postdata['extdata']){
			$extdata['price'] = trim(dhtmlspecialchars($postdata['extdata']));
			$update_array['extdata']=addslashes(serialize(dstripslashes($extdata)));

		}
		if($postdata['ext1'] && $postdata['ext2']){
			if($postdata['ext1']==$postdata['ext2'] && $postdata['startHour'] && $postdata['endHour']){
				$update_array['ext1'] = $postdata['ext1']+$postdata['startHour']*3600;
				$update_array['ext2'] = $postdata['ext2']+$postdata['endHour']*3600;
			}else{
				$update_array['ext1'] = $postdata['ext1'];
				$update_array['ext2'] = $postdata['ext2'];
			}
		}
		if($postdata['ext3']){
			$update_array['ext3']=trim(dhtmlspecialchars($postdata['ext3']));
		}
		if($postdata['ext4']){
			$update_array['ext4']=$postdata['ext4'];
		}
		if($postdata['ext5']){
			$update_array['ext5']=$postdata['ext5'];
		}
		if($postdata['goodpoint']){
			$update_array['goodpoint']=trim(dhtmlspecialchars($postdata['goodpoint']));
		}
		DB::update('dianping_star_logs',$update_array,"pid={$postdata['pid']}");
		$starid=getStarid($tid,$fid);
		$score = updateStar($starid);
		if($score){
			DB::update("dianping_{$mod}_info",array('score'=>$score),"tid={$tid}");
		}
		$comment = $comment_obj->getdetail($_G['gp_pid']);
		$act="showview";

		include template("dianping/{$mod}_comment_item");
	}
}

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

function updateNum($tid, $starid = 0,$mod){
	if(!$tid){
		return false;
	}
	$res = DB::fetch_first("SELECT COUNT(starid) AS count FROM ".DB::table('dianping_star_logs')." where starid={$starid}");
	DB::update($mod,array('cnum'=>$res['count']),"tid={$tid}");
}
//判断是否已评分
function getStarid($tid,$fid){

	$stat=DB::fetch_first("SELECT id FROM ".DB::table('dianping_star_statistics')."  where typeid={$tid}");
	if($stat['id']){

		$starid=$stat['id'];

	}else{

		$starid=DB::insert('dianping_star_statistics',array('type'=>'forum','typeid'=>$tid,'fid' => $fid),1);

	}
	return $starid;
}

?>
