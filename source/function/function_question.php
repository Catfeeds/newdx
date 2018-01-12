<?php

/**
 * @author lvhsuo
 * @copyright 2016
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function getxgTopicLables($topicLable) {
	$return_str = '';
	$lables_array =explode(',', $topicLable);
	$lables_temp = array();
	foreach($lables_array as $v){
		$tempdisorder = DB::result_first("SELECT disorder FROM " . DB::table("question_lable") . " WHERE isshow = '1' AND lable_id = '$v' " . getSlaveID());
		if($tempdisorder !==false){
		$showlable_query = DB::query("SELECT lable_id,lable_value FROM " . DB::table('question_lable') . " WHERE isshow = '1' AND disorder={$tempdisorder} " . getSlaveID());
		while ($row = DB::fetch($showlable_query)){
			$lables_temp[$row['lable_id']] = $row['lable_value'];
		}
		}
		
	}
	
	foreach($lables_temp as $k=>$v){
		$return_str .='<a  href="wenda/list-0-'.$k.'-1.html" target="_blank">'.$v.'</a>';
	}
	return $return_str;
}



function getTopicLables($topicLable) {
	$return_str = '';
	$lables_array =explode(',', $topicLable);
	//var_dump($lables_array);
	$lables_temp = $lables_array;
	foreach($lables_array as $v){
		$templables_str = DB::result_first("SELECT up_value FROM " . DB::table("question_lable") . " WHERE isshow = '1' AND lable_id = '$v' " . getSlaveID());
		$templables_str_array =explode(',', $templables_str);
		foreach($templables_str_array as $vv){
			if($vv){
				$lables_temp[]= $vv;
			}
		}
	}
    $lables_temp = array_unique($lables_temp);
	foreach($lables_temp as $v){
		$return_str .=$v.',';
	}
	if($return_str){
	$return_str = substr($return_str, 0, strlen($return_str) - 1);
	}
    return $return_str;
}


//获得问答的分类
function getQuestionLables() {
	$showlables_query = DB::query("SELECT lable_id,lable_value FROM " . DB::table("question_lable") . " WHERE isshow = '1' ORDER BY disorder asc " . getSlaveID());
	$list = array();
	while ($row = DB::fetch($showlables_query)) {
		$list[$row[lable_id]]= $row[lable_value];
	}
	return $list;
}


//获得问答的分类按问题数排序
function getQuestionLablesBycounts() {
	$lables = getQuestionLables();
	//var_dump($lables);
	$returnarr = array();
	foreach($lables as $k=>$v){
		$temp_arr = array();
		$temp_arr[] = $k;
		$templables_query = DB::query("SELECT lable_id,lable_value FROM " . DB::table("question_lable") . " WHERE isshow = '1' AND up_value like '%{$k}%' " . getSlaveID());
		$list = array();
		while ($row = DB::fetch($templables_query)) {
			$temp_arr[] = intval($row[lable_id]);
		}
		$where = " AND  ( ";
		$where .= " (instr(`lable`, '{$k}')>0 )";
		for($ii=1;$ii<count($temp_arr);$ii++){
			$where .= "  OR (instr(`lable`, '{$temp_arr[$ii]}')>0 )";
		}
		$where .= " )";
		$wenticount  = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('question_topic')." WHERE title != '' AND isshow ='1' {$where} " . getSlaveID());
		$returnarr[$k]=$wenticount;
	}
	arsort($returnarr);
	$newreturnarr = array();
	foreach ($returnarr as $k=>$v){
		$newreturnarr[$k]=array('name'=>$lables[$k],'num'=>$v);
	}
	return $newreturnarr;
}

// 问答列表设置关注数
function setWendaGuanzhuCache($lablestr,$uid) {
	if($lablestr&&$uid){
		global $_G;
		require_once libfile('class/myredis');
		$redis  = & myredis::instance(6381);
		
		$lables_array =explode(',', $lablestr);
		if($lables_array){
			foreach($lables_array as $v){
				$guanzhuNum = 0;
				$guanzhuNum = $redis->obj->hGet('wenda_showlist_lable_guanzhu', 'lable_guanzhu_'.$v);
				$guanzhuNum++;
				$redis->obj->hdel('wenda_showlist_lable_guanzhu', 'lable_guanzhu_'.$v);
				$redis->obj->hSet('wenda_showlist_lable_guanzhu', 'lable_guanzhu_'.$v,$guanzhuNum);
				
				$redis->obj->hdel('wenda_showlist_lable_guanzhuimg_'.$v, 'uid_'.$uid);
				$redis->obj->hSet('wenda_showlist_lable_guanzhuimg_'.$v, 'uid_'.$uid,$uid);
			}
		
		    $zguanzhuNum = 0;
			$zguanzhuNum = $redis->obj->hGet('wenda_showlist_lable_guanzhu', 'lable_guanzhu_0');
			$zguanzhuNum++;
			$redis->obj->hdel('wenda_showlist_lable_guanzhu', 'lable_guanzhu_0');
			$redis->obj->hSet('wenda_showlist_lable_guanzhu', 'lable_guanzhu_0',$zguanzhuNum);
			
			
			$redis->obj->hdel('wenda_showlist_lable_guanzhuimg_0', 'uid_'.$uid);
			$redis->obj->hSet('wenda_showlist_lable_guanzhuimg_0', 'uid_'.$uid,$uid);
		
		}
	}
}


// 问答列表关注数
function getWendaGuanzhuCache($lable) {
	global $_G;
	
	require_once libfile('class/myredis');
	$redis  = & myredis::instance(6381);
	

	$key   = "wenda_showlist_lable_guanzhu";
	$prev   = "lable_guanzhu_";
	
	$guanzhuNum = $redis->obj->hGet($key, $prev.$lable);
	
	if($guanzhuNum<1000){
		if($lable==0){
			$guanzhuNum =mt_rand(68005,88005);
		}elseif($lable==10000062){
			$guanzhuNum =mt_rand(58005,68005);
		}elseif($lable==10000007){
			$guanzhuNum =mt_rand(18005,28005);
		}elseif($lable==10000031){
			$guanzhuNum =mt_rand(18005,28005);
		}elseif($lable==10000127){
			$guanzhuNum =mt_rand(18005,28005);
		}elseif($lable==10000020){
			$guanzhuNum =mt_rand(11005,12005);
		}else{
			$guanzhuNum =mt_rand(3005,8005);
		}
		$redis->obj->hdel($key, $prev.$lable);
		$redis->obj->hSet($key, $prev.$lable, $guanzhuNum);
	}
	
	return $guanzhuNum;
}


// 问答列表关注头像
function getWendaGuanzhuImgCache($lable,$min) {
	global $_G;
	
	require_once libfile('class/myredis');
	$redis  = & myredis::instance(6381);
	$lable = $lable?$lable:10000062;
	
	$uids =  array(34580208,34579525,34584350,34591519,34601139,34634293,34658450,34662174,34669571,34732759,34765037,34765948,34827390,34904368,34917534,33923076,34162277,34171897,34177772,34187409,34246381,34310721,34321028,34489764,34506056,34974326,35057226,35100093,35303332,35406372,35461288,35494020,35594130,35609394,35783338,35784530,35898171,35941107,35962608,36031128,36039945,36050500,36202932,36267751,36295870,36313785,36313802,36335766,36342768,36361460);

	$key   = "wenda_showlist_lable_guanzhuimg_".$lable;
	$prev   = "uid_";
	
	$cnt = $redis->obj->hlen($key);
	if ($cnt < $min && !empty($uids)) {
		$iscycle = true;
		$usercnt = count($uids) - 1;
		while ($iscycle) {
			$rand = rand(0, $usercnt);
			$temp = !empty($uids[$rand]) ? $uids[$rand] : '';
			if (empty($temp)) {continue;}
			$redis->obj->hdel($key, $prev.$temp);
			$redis->obj->hSet($key, $prev.$temp, $temp);
			$cnt++;
			$iscycle = $cnt >= $min ? false : true;
		}
	}
	

	$list  = $redis->obj->hgetall($key);	
	$list  = array_reverse($list);
	$list  = array_slice($list, 0, $min);
	return $list;
}




//获得问答的板块
function getQuestionFids() {
	return array(
		"12" => '户外大厅',
		"39" => '户外摄影',
		"163" => '有问必答',
		"88" => '骑行天下',
		"186" => '滑雪',
		"179" => '钓鱼',
		"178" => '探洞|绳索运用',
		"66" => '自驾|拼车',
		"135" => '岩壁芭蕾',
		"495" => '跑步|越野跑',
		"489" => '户外先锋营',
		"24" => '山伍成群',
		"7" => '装备天下'
	);
}




// 问答游览数
function getWendaViewCache($topicid) {
	global $_G;
	
	require_once libfile('class/myredis');
	$redis  = & myredis::instance(6381);

	$key   = "wenda_topicid_view".$topicid;
	$prev   = "viewtopicid_";
	
	$viewtopicid = $redis->obj->hGet($key, $prev.$topicid);
	
	if(!$viewtopicid){
		$viewtopicid =mt_rand(391,18005);
		$redis->obj->hdel($key, $prev.$topicid);
		$redis->obj->hSet($key, $prev.$topicid, $viewtopicid);
	}else{
		$viewtopicid =  $viewtopicid +1;
		$redis->obj->hdel($key, $prev.$topicid);
		$redis->obj->hSet($key, $prev.$topicid,$viewtopicid);
	}
	
	return $viewtopicid;
}





// 分享过的用户列表//数量
function getWendaShareCache($topicid, $min) {	
	global $_G;
	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);
	$uids =  array(34580208,34579525,34584350,34591519,34601139,34634293,34658450,34662174,34669571,34732759,34765037,34765948,34827390,34904368,34917534,33923076,34162277,34171897,34177772,34187409,34246381,34310721,34321028,34489764,34506056,34974326,35057226,35100093,35303332,35406372,35461288,35494020,35594130,35609394,35783338,35784530,35898171,35941107,35962608,36031128,36039945,36050500,36202932,36267751,36295870,36313785,36313802,36335766,36342768,36361460);
	$key   = "wenda_topicid_share".$topicid;
	$prev   = "shareuid_";
	
	$cnt = $redis->obj->hlen($key);
	if ($cnt < $min && !empty($uids)) {
		$iscycle = true;
		$usercnt = count($uids) - 1;
		while ($iscycle) {
			$rand = rand(0, $usercnt);
			$temp = !empty($uids[$rand]) ? $uids[$rand] : '';
			if (empty($temp)) {continue;}
			$redis->obj->hdel($key, $prev.$temp);
			$redis->obj->hSet($key, $prev.$temp, $temp);
			$cnt++;
			$iscycle = $cnt >= $min ? false : true;
		}
		
		$sharetopicid =mt_rand(21,49);
		$redis->obj->hdel($key."sharenum", 'sharetopicid_'.$topicid);
		$redis->obj->hSet($key."sharenum", 'sharetopicid_'.$topicid, $sharetopicid);
	}
	
	$sharenum = $sharetopicid>0 ? $sharetopicid:$redis->obj->hGet($key."sharenum", 'sharetopicid_'.$topicid);
	
	$list  = $redis->obj->hgetall($key);	
	$list  = array_reverse($list);
	$list  = array_slice($list, 0, $min);
	return array('sharenum' =>$sharenum,'list'=>$list);
}


// 新分享用户
function setNewWendaShareCache($topicid, $shareuid) {	
	global $_G;
	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);
	$key   = "wenda_topicid_share".$topicid;
	$prev   = "shareuid_";
	
	if($shareuid&&!($redis->obj->hGet($key, $prev.$shareuid))){
		$redis->obj->hdel($key, $prev.$shareuid);
		$redis->obj->hSet($key, $prev.$shareuid, $shareuid);
		$sharenum = $redis->obj->hGet($key."sharenum", 'sharetopicid_'.$topicid);
		$sharenum++;
		
		$redis->obj->hdel($key."sharenum", 'sharetopicid_'.$topicid);
        $redis->obj->hSet($key."sharenum", 'sharetopicid_'.$topicid, $sharenum);
	}
	
	
}



//导入帖子问答版
function exportOneQuestion($tid,$opadmin) {
	//$questionShow = DB::fetch_first("SELECT * FROM " . DB::table('question_topic') . " where tid={$tid} " . getSlaveID());
	$wentisql = "SELECT  t.fid,t.typeid,t.dateline as dbdateline,tc.name,p.subject,p.authorid,p.author,p.dateline,p.message,p.pid,p.comment FROM " . DB::table("forum_thread") . " AS t "
		. "LEFT JOIN " . DB::table("forum_post") . " AS p "
		. "ON t.tid=p.tid "
		. "LEFT JOIN " . DB::table("forum_threadclass") . " AS tc "
		. "ON t.typeid=tc.typeid "
		. " WHERE t.tid = '{$tid}' AND p.first='1' AND t.displayorder >= 0 AND p.invisible = '0' " . getSlaveID();

	$wenti = DB::fetch_first($wentisql);


	$lablesql = "SELECT * FROM " . DB::table("question_lable") . " WHERE lable_value = '{$wenti['name']}' " . getSlaveID();
	$lable_arr = DB::fetch_first($lablesql);
	if (!$lable_arr) {
		DB::insert('question_lable', array('lable_value' => trim($wenti['name'])));
		$lable_arr['lable_id'] = DB::insert_id();
	}


	$data = array();
	$data['tid'] = $tid;
	$data['title'] = daddslashes($wenti['subject']);
	$data['authorid'] = $wenti['authorid'];
	$data['author'] = daddslashes($wenti['author']);
	$data['lable'] = $lable_arr['lable_id'];
	$data['dateline'] = $wenti['dateline'];
	$data['expdateline'] = TIMESTAMP;
	$data['opadmin'] = $opadmin;

	DB::insert('question_topic', $data);
	$topicid = DB::insert_id();


	//答案开始
	if ($wenti['fid'] == 163) {
		$daansql = "SELECT  p.subject,p.authorid,p.author,p.dateline,p.message,p.pid,p.comment FROM " . DB::table("forum_thread") . " AS t "
			. "LEFT JOIN " . DB::table("forum_post") . " AS p "
			. "ON t.tid=p.tid "
			. " WHERE t.tid = '{$tid}' AND p.first !='1' AND t.displayorder >= 0 AND p.invisible = '0' AND p.authorid != '" . $wenti['authorid'] . "' ORDER BY p.dateline ASC " . getSlaveID();
	} else {
		$daansql = "SELECT  p.subject,p.authorid,p.author,p.dateline,p.message,p.pid,p.comment FROM " . DB::table("forum_thread") . " AS t "
			. "LEFT JOIN " . DB::table("forum_post") . " AS p "
			. "ON t.tid=p.tid "
			. " WHERE t.tid = '{$tid}'  AND t.displayorder >= 0 AND p.invisible = '0' ORDER BY p.dateline ASC " . getSlaveID();
	}
	$daan_query = DB::query($daansql);

	$daanlist = array();
	while ($row = DB::fetch($daan_query)) {
		$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios]来自iPhone客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios/]来自iPhone客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=www.8264.com/app/]来自iPhone客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://www.8264.com/app/]来自iPhone客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android]来自Android客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android/]来自Android客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=www.8264.com/app/]来自Android客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://www.8264.com/app/]来自Android客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[p=24, null, left]', '', $row['message']);
		$row['message']=str_replace('[/p]', '', $row['message']);
		$row['message'] = preg_replace('/\[quote\](.*)\[size=2\](.*)发表于(.*)static\/image\/common\/back\.gif(.*)\[\/size\](.*)\[\/quote\]/isU', '', $row['message']);
		$row['message'] = preg_replace('/\[quote\]原帖由(.*)\[\/quote\]/isU', '', $row['message']);
		$row['messagenew'] = questionmodelMessage($row['message']);
		$row['messagenew'] = htmlspecialchars_decode($row['messagenew']);
		$row['messagenew'] = removingPBR($row['messagenew']);
		$row['messagenew'] = preg_replace("/<img.*\/>/i", '', $row['messagenew']);
		$row['messagenew']=str_replace('&nbsp;', '', $row['messagenew']);
		$qian=array(" ","　","\t","\n","\r");
		$hou=array("","","","","");
		$row['messagenew'] =str_replace($qian,$hou,$row['messagenew']); 
		$row['messagenew'] = strip_tags($row['messagenew'], "<table><tbody><tr><th><td><span><script>");
		if ((mb_strlen($row['message'], 'GBK') >= 30 &&mb_strlen($row['messagenew'], 'GBK') >= 30 ) || preg_match("/\[attach\](\d+)\[\/attach\]/is", $row['message'])|| preg_match("/\[img\](.*)\[\/img\]/is", $row['message'])) {
			//$row['message'] = readmodelMessage($row['message']);
			$daanlist[] = $row;
		}
	}
	//var_dump($daanlist);

	$commentsql = "SELECT * FROM " . DB::table("forum_postcomment") . " WHERE tid = '{$tid}' AND forpid !=0 AND isshow = '1' " . getSlaveID();
	$comment_query = DB::query($commentsql);
	$commentlist = array();
	$commentpid = array();
	while ($row = DB::fetch($comment_query)) {
		//$row['comment'] =   ltrim(readmodelMessage($row['comment']),'<br/>');
		$commentlist[$row['pid']][] = $row;
		$commentpid[] = $row['forpid'];
	}
	
	//有问必答板块保留最佳答案(是回复)pid
	if ($wenti['fid'] == 163) {
		$zj_dateline=$wenti['dbdateline'] +1;
		$zj_pid =DB::fetch_first("SELECT pid FROM " . DB::table('forum_post') . " WHERE tid = '{$tid}' AND dateline = '{$zj_dateline}' " . getSlaveID());
		$zj_pid = $zj_pid['pid'];
		if($zj_pid){
			$keykey = array_search($zj_pid, $commentpid);
			if ($keykey !== false) {
				array_splice($commentpid, $keykey, 1);
			}
		}
	}

	//var_dump($commentpid);
	//var_dump($commentlist);

	$showdaanlist = array();
	for ($i = 0; $i < count($daanlist); $i++) {
		if (!in_array($daanlist[$i]['pid'], $commentpid)) {

			if ($daanlist[$i]['comment'] > 0) {
				$daanlist[$i]['commentarr'] = $commentlist[$daanlist[$i]['pid']];
				$showdaanlist[$daanlist[$i]['authorid']]['comment'][] = $commentlist[$daanlist[$i]['pid']];
			}
			$showdaanlist[$daanlist[$i]['authorid']]['author'] = $daanlist[$i]['author'];
			$showdaanlist[$daanlist[$i]['authorid']]['arr'][] = $daanlist[$i];
		}
	}

	//var_dump($showdaanlist);die;
	$showpid = array();

	foreach ($showdaanlist as $sk => $sv) {


		$insert_data = array();
		$insert_data['ref_topicid'] = $topicid;
		$insert_data['authorid'] = $sk;
		$insert_data['author'] = daddslashes($sv['author']);
		$insert_data['dateline'] = $sv['arr'][0]['dateline'];
		$insert_data['tid'] = $tid;

		$tiddata = array();
		for ($i = 0; $i < count($sv['arr']); $i++) {
			$tiddata[] = intval($sv['arr'][$i]['pid']);
			$showpid[] = intval($sv['arr'][$i]['pid']);
		}
		if (count($tiddata)) {
			$insert_data['tiddata'] = json_encode($tiddata);
		}


		$tiddatacomment = array();
		for ($i = 0; $i < count($sv['comment'][0]); $i++) {
			$tiddatacomment[] = intval($sv['comment'][0][$i]['forpid']);
			$showpid[] = intval($sv['comment'][0][$i]['forpid']);
		}
		if (count($tiddatacomment)) {
			$insert_data['tiddatacomment'] = json_encode($tiddatacomment);
		}

		$insert_data['replynum'] = count($sv['comment'][0]);


		DB::insert('question_reply', $insert_data);
	}

	$update_data = array();
	if (count($showdaanlist)) {
		$update_data['replynum'] = count($showdaanlist);
	}
	if (count($showpid)) {
		$update_data['showpid'] = json_encode($showpid);
	}
	if (count($update_data)) {
		DB::update('question_topic', $update_data, "topicid={$topicid}");
	}

	//答案结束
}


function removingPBR($message){
		$message=str_replace('align="center"', '', $message);
		$message = preg_replace('/回复(.*)<a href="http:\/\/(www|bbs)\.8264\.com\/forum\.php\?mod=redirect&goto=findpost&pid=(\d+)&ptid=(\d+)"(.*)>(.*)的帖子<\/a><br\/>/isU', '', $message);
		$message = preg_replace('/回复(.*)<a href="http:\/\/(www|bbs)\.8264\.com\/forum\.php\?mod=redirect&goto=findpost&pid=(\d+)&ptid=(\d+)"(.*)>(.*)的帖子<\/a>/isU', '', $message);
		$message = preg_replace('/<img(.*)src="http:\/\/static\.(8264|zaiwai)\.com\/static\/image\/smiley\/default\/(.*)\.gif"(.*)>/isU', '', $message);
		
		$message = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $message);//n个连续<br/>
		$message = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $message);//<p><br/></p>
		$message = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $message);//<p><br/>
		$message = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $message);//</p><br/>
		return $message;
	}
	
	
	
	
	//导入帖子问答版 cron
function exportOneQuestionCron($tid,$opadmin) {
	//$questionShow = DB::fetch_first("SELECT * FROM " . DB::table('question_topic') . " where tid={$tid} " . getSlaveID());
	$wentisql = "SELECT  t.fid,t.typeid,t.dateline as dbdateline,tc.name,p.subject,p.authorid,p.author,p.dateline,p.message,p.pid,p.comment FROM " . DB::table("forum_thread") . " AS t "
		. "LEFT JOIN " . DB::table("forum_post") . " AS p "
		. "ON t.tid=p.tid "
		. "LEFT JOIN " . DB::table("forum_threadclass") . " AS tc "
		. "ON t.typeid=tc.typeid "
		. " WHERE t.tid = '{$tid}' AND p.first='1' AND t.displayorder >= 0 AND p.invisible = '0' " . getSlaveID();

	$wenti = DB::fetch_first($wentisql);
	
	//过滤标题
	if (!strpos($wenti['subject'],'参加')===false) {return;}
	if (!strpos($wenti['subject'],'比赛')===false) {return;}
		
	
	//组装lable
	$lable_transform= array(
							'88'=>array('骑行天下','骑行','10000034')
							);
	
	$lable_arr['lable_id'][] = $lable_transform[$wenti['fid']][2];
	
	if (!strpos($wenti['subject'],'滑雪')===false){ $lable_arr['lable_id'][] = 10000020;}
	if (!strpos($wenti['subject'],'钓鱼')===false){ $lable_arr['lable_id'][] = 10000044;}
	if (!strpos($wenti['subject'],'徒步')===false){ $lable_arr['lable_id'][] = 10000015;}
	if (!strpos($wenti['subject'],'露营')===false){ $lable_arr['lable_id'][] = 10000056;}
	if (!strpos($wenti['subject'],'骑行')===false){ $lable_arr['lable_id'][] = 10000034;}
	if (!strpos($wenti['subject'],'自驾拼车')===false){ $lable_arr['lable_id'][] = 10000117;}
	if (!strpos($wenti['subject'],'跑步')===false){ $lable_arr['lable_id'][] = 10000119;}
	if (!strpos($wenti['subject'],'攀岩攀壁')===false){ $lable_arr['lable_id'][] = 10000120;}
	if (!strpos($wenti['subject'],'登山')===false){ $lable_arr['lable_id'][] = 10000064;}
	if (!strpos($wenti['subject'],'水上运动')===false){ $lable_arr['lable_id'][] = 10000130;}
	if (!strpos($wenti['subject'],'探洞')===false){ $lable_arr['lable_id'][] = 10000131;}
	if (!strpos($wenti['subject'],'绳索运动')===false){ $lable_arr['lable_id'][] = 10000131;}
	
	if (!strpos($wenti['subject'],'鞋')===false||!strpos($wenti['subject'],'包')===false||!strpos($wenti['subject'],'杖')===false||!strpos($wenti['subject'],'水壶')===false||!strpos($wenti['subject'],'服')===false||!strpos($wenti['subject'],'裤')===false||!strpos($wenti['subject'],'衣')===false||!strpos($wenti['subject'],'巾')===false){
		$lable_arr['lable_id'][] = 10000031;
	}

	

	
	$lable_arr['lable_id'] =array_unique($lable_arr['lable_id']);
	$lable_arr['lable_id'] = implode(',',$lable_arr['lable_id']);
//	$lablesql = "SELECT * FROM " . DB::table("question_lable") . " WHERE lable_value = '{$wenti['name']}' " . getSlaveID();
//	$lable_arr = DB::fetch_first($lablesql);
//	if (!$lable_arr) {
//		DB::insert('question_lable', array('lable_value' => trim($wenti['name'])));
//		$lable_arr['lable_id'] = DB::insert_id();
//	}


	$data = array();
	$data['tid'] = $tid;
	$data['title'] = daddslashes($wenti['subject']);
	$data['authorid'] = $wenti['authorid'];
	$data['author'] = daddslashes($wenti['author']);
	$data['lable'] = $lable_arr['lable_id'];
	$data['dateline'] = $wenti['dateline'];
	$data['expdateline'] = TIMESTAMP;
	$data['opadmin'] = $opadmin;
	$data['displayorder'] = 6;

	DB::insert('question_topic', $data);
	$topicid = DB::insert_id();


	//答案开始
	if ($wenti['fid'] == 163) {
		$daansql = "SELECT  p.subject,p.authorid,p.author,p.dateline,p.message,p.pid,p.comment FROM " . DB::table("forum_thread") . " AS t "
			. "LEFT JOIN " . DB::table("forum_post") . " AS p "
			. "ON t.tid=p.tid "
			. " WHERE t.tid = '{$tid}' AND p.first !='1' AND t.displayorder >= 0 AND p.invisible = '0' AND p.authorid != '" . $wenti['authorid'] . "' ORDER BY p.dateline ASC " . getSlaveID();
	} else {
		$daansql = "SELECT  p.subject,p.authorid,p.author,p.dateline,p.message,p.pid,p.comment FROM " . DB::table("forum_thread") . " AS t "
			. "LEFT JOIN " . DB::table("forum_post") . " AS p "
			. "ON t.tid=p.tid "
			. " WHERE t.tid = '{$tid}'  AND t.displayorder >= 0 AND p.invisible = '0' ORDER BY p.dateline ASC " . getSlaveID();
	}
	$daan_query = DB::query($daansql);

	$daanlist = array();
	while ($row = DB::fetch($daan_query)) {
		$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios]来自iPhone客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios/]来自iPhone客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=www.8264.com/app/]来自iPhone客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://www.8264.com/app/]来自iPhone客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android]来自Android客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android/]来自Android客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=www.8264.com/app/]来自Android客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[url=http://www.8264.com/app/]来自Android客户端[/url]', '', $row['message']);
		$row['message']=str_replace('[p=24, null, left]', '', $row['message']);
		$row['message']=str_replace('[/p]', '', $row['message']);
		$row['message'] = preg_replace('/\[quote\](.*)\[size=2\](.*)发表于(.*)static\/image\/common\/back\.gif(.*)\[\/size\](.*)\[\/quote\]/isU', '', $row['message']);
		$row['message'] = preg_replace('/\[quote\]原帖由(.*)\[\/quote\]/isU', '', $row['message']);
		$row['messagenew'] = questionmodelMessage($row['message']);
		$row['messagenew'] = htmlspecialchars_decode($row['messagenew']);
		$row['messagenew'] = removingPBR($row['messagenew']);
		$row['messagenew'] = preg_replace("/<img.*\/>/i", '', $row['messagenew']);
		$row['messagenew']=str_replace('&nbsp;', '', $row['messagenew']);
		$qian=array(" ","　","\t","\n","\r");
		$hou=array("","","","","");
		$row['messagenew'] =str_replace($qian,$hou,$row['messagenew']); 
		$row['messagenew'] = strip_tags($row['messagenew'], "<table><tbody><tr><th><td><span><script>");
		if ((mb_strlen($row['message'], 'GBK') >= 30 &&mb_strlen($row['messagenew'], 'GBK') >= 30 ) || preg_match("/\[attach\](\d+)\[\/attach\]/is", $row['message'])|| preg_match("/\[img\](.*)\[\/img\]/is", $row['message'])) {
			//$row['message'] = readmodelMessage($row['message']);
			//过滤答案			
			if (strpos($row['message'],'学习')===false&&strpos($row['message'],'支持')===false&&strpos($row['message'],'手机号')===false&&strpos($row['message'],'代理')===false&&strpos($row['message'],'加QQ')===false&&strpos($row['message'],'加qq')===false&&strpos($row['message'],'经销')===false&&!preg_match("/1[34578]{1}\d{9}/",$row['message'])){ 
				$daanlist[] = $row;
			}
		}
		
	}
	//var_dump($daanlist);

	$commentsql = "SELECT * FROM " . DB::table("forum_postcomment") . " WHERE tid = '{$tid}' AND forpid !=0 AND isshow = '1' " . getSlaveID();
	$comment_query = DB::query($commentsql);
	$commentlist = array();
	$commentpid = array();
	while ($row = DB::fetch($comment_query)) {
		//$row['comment'] =   ltrim(readmodelMessage($row['comment']),'<br/>');
		$commentlist[$row['pid']][] = $row;
		$commentpid[] = $row['forpid'];
	}
	
	//有问必答板块保留最佳答案(是回复)pid
	if ($wenti['fid'] == 163) {
		$zj_dateline=$wenti['dbdateline'] +1;
		$zj_pid =DB::fetch_first("SELECT pid FROM " . DB::table('forum_post') . " WHERE tid = '{$tid}' AND dateline = '{$zj_dateline}' " . getSlaveID());
		$zj_pid = $zj_pid['pid'];
		if($zj_pid){
			$keykey = array_search($zj_pid, $commentpid);
			if ($keykey !== false) {
				array_splice($commentpid, $keykey, 1);
			}
		}
	}

	//var_dump($commentpid);
	//var_dump($commentlist);

	$showdaanlist = array();
	for ($i = 0; $i < count($daanlist); $i++) {
		if (!in_array($daanlist[$i]['pid'], $commentpid)) {

			if ($daanlist[$i]['comment'] > 0) {
				$daanlist[$i]['commentarr'] = $commentlist[$daanlist[$i]['pid']];
				$showdaanlist[$daanlist[$i]['authorid']]['comment'][] = $commentlist[$daanlist[$i]['pid']];
			}
			$showdaanlist[$daanlist[$i]['authorid']]['author'] = $daanlist[$i]['author'];
			$showdaanlist[$daanlist[$i]['authorid']]['arr'][] = $daanlist[$i];
		}
	}

	//var_dump($showdaanlist);die;
	$showpid = array();

	foreach ($showdaanlist as $sk => $sv) {


		$insert_data = array();
		$insert_data['ref_topicid'] = $topicid;
		$insert_data['authorid'] = $sk;
		$insert_data['author'] = daddslashes($sv['author']);
		$insert_data['dateline'] = $sv['arr'][0]['dateline'];
		$insert_data['tid'] = $tid;

		$tiddata = array();
		for ($i = 0; $i < count($sv['arr']); $i++) {
			$tiddata[] = intval($sv['arr'][$i]['pid']);
			$showpid[] = intval($sv['arr'][$i]['pid']);
		}
		if (count($tiddata)) {
			$insert_data['tiddata'] = json_encode($tiddata);
		}


		$tiddatacomment = array();
		for ($i = 0; $i < count($sv['comment'][0]); $i++) {
			$tiddatacomment[] = intval($sv['comment'][0][$i]['forpid']);
			$showpid[] = intval($sv['comment'][0][$i]['forpid']);
		}
		if (count($tiddatacomment)) {
			$insert_data['tiddatacomment'] = json_encode($tiddatacomment);
		}

		$insert_data['replynum'] = count($sv['comment'][0]);


		DB::insert('question_reply', $insert_data);
	}

	$update_data = array();
	if (count($showdaanlist)) {
		$update_data['replynum'] = count($showdaanlist);
	}
	if (count($showpid)) {
		$update_data['showpid'] = json_encode($showpid);
	}
	if (count($update_data)) {
		DB::update('question_topic', $update_data, "topicid={$topicid}");
	}

	//答案结束
}




//获得分类二维码广告
function getLableQrAd($lable) {
    if($lable){
        $mapping_array =array(
              //8264活动
              '10000007'=>array('hd.jpg','8264活动'),
              '10000031'=>array('hd.jpg','8264活动'),
              '10000062'=>array('hd.jpg','8264活动'),
              '10000127'=>array('hd.jpg','8264活动'),
             //钓鱼
             '10000044'=>array('diaoyu.jpg','钓鱼'),
             '10000045'=>array('diaoyu.jpg','钓鱼'),
             '10000132'=>array('diaoyu.jpg','钓鱼'),
            //徒步
             '10000015'=>array('tubu.jpg','徒步'),
             '10000133'=>array('tubu.jpg','徒步'),
             '10000134'=>array('tubu.jpg','徒步'),
            //骑行
             '10000034'=>array('qixing.jpg','骑行'),
             '10000009'=>array('qixing.jpg','骑行'),
             '10000010'=>array('qixing.jpg','骑行'),
            
            //跑步
             '10000119'=>array('paobu.jpg','跑步'),
             '10000118'=>array('paobu.jpg','跑步'),
            
            //极限运动
             '10000117'=>array('jixianyundong.jpg','极限运动'),
             '10000120'=>array('jixianyundong.jpg','极限运动'),
             '10000136'=>array('jixianyundong.jpg','极限运动'),
            
            //登山
             '10000064'=>array('dengshan.jpg','登山'),
             '10000065'=>array('dengshan.jpg','登山'),
             '10000137'=>array('dengshan.jpg','登山'),
            
            //潜水
             '10000138'=>array('qianshui.jpg','潜水'),
             '10000130'=>array('qianshui.jpg','潜水'),
             '10000139'=>array('qianshui.jpg','潜水'),
        );
        
        if($mapping_array[$lable]){
            return array('isshowQrAd'=>1,'isshowQrimg'=>$mapping_array[$lable]);
        }else{
            return array('isshowQrAd'=>1,'isshowQrimg'=>array('hd.jpg','8264活动'));
        }
        
        
    }else{
        return array('isshowQrAd'=>1,'isshowQrimg'=>array('hd.jpg','8264活动'));
    }
    
}

//主站首页问答列表 add by zhangwenchu 20160105
function getQuestionList(){
	global $_G;
	$keyname = "cache_shouye_question_list";
	$fin_question_list = memory('get', $keyname);

	if(!$fin_question_list || ($_G['gp_nocache'] == 1 && $_G['groupid'] == 1) ){
		$sql = "select topicid,title from ".DB::table("question_topic")." where isshow = 1 and replynum > 5 and notindex = 0 "
				. "order by displayorder DESC,pubdateline DESC,replynum DESC,topicid DESC limit 100 ".getSlaveID();
		$query = DB::query($sql);
		while($v = DB::fetch($query)){
			$replyOne =DB::fetch_first("SELECT * FROM " . DB::table('question_reply') . " where ishidden = 0 and ref_topicid ='{$v[topicid]}' order by isup desc, goodnum desc, replyid desc" . getSlaveID());
			if($replyOne['tid']&&$replyOne['tiddata']){
				$replyOne['tiddata'] =json_decode($replyOne['tiddata'], true);
				for($i=0;$i<count($replyOne['tiddata']);$i++){
					$postOne =DB::fetch_first("SELECT message FROM " . DB::table('forum_post') . " where pid={$replyOne['tiddata'][$i]} " . getSlaveID());
					$postOne['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios]来自iPhone客户端[/url]', '', $postOne['message']);
					$postOne['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios/]来自iPhone客户端[/url]', '', $postOne['message']);
					$postOne['message']=str_replace('[url=www.8264.com/app/]来自iPhone客户端[/url]', '', $postOne['message']);
					$postOne['message']=str_replace('[url=http://www.8264.com/app/]来自iPhone客户端[/url]', '', $postOne['message']);
					$postOne['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android]来自Android客户端[/url]', '', $postOne['message']);
					$postOne['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android/]来自Android客户端[/url]', '', $postOne['message']);
					$postOne['message']=str_replace('[url=www.8264.com/app/]来自Android客户端[/url]', '', $postOne['message']);
					$postOne['message']=str_replace('[url=http://www.8264.com/app/]来自Android客户端[/url]', '', $postOne['message']);
					$postOne['message']=str_replace('[p=24, null, left]', '', $postOne['message']);
					$postOne['message']=str_replace('[/p]', '', $postOne['message']);
					$postOne['message'] = preg_replace('/\[quote\]\[size=2\](.*)发表于(.*)static\/image\/common\/back\.gif(.*)\[\/size\](.*)\[\/quote\]/isU', '', $postOne['message']);
					$postOne['message'] = preg_replace('/\[quote\]原帖由(.*)\[\/quote\]/isU', '', $postOne['message']);

					if($i==(count($replyOne['tiddata'])-1)){
						$replyOne['rcontent'] .=$postOne['message'];
					}else{
						$replyOne['rcontent'] .=$postOne['message'].'<br/>';
					}
				}

				$replyOne['rcontent'] = questionmodelMessage($replyOne['rcontent']);
				$replyOne['rcontent'] = htmlspecialchars_decode($replyOne['rcontent']);
				$replyOne['rcontent'] = removingPBR($replyOne['rcontent']);
				$replyOne['textrcontent'] = preg_replace("/<img.*\/>/i", '', $replyOne['rcontent']);
				$replyOne['textrcontent']=str_replace('&nbsp;', '', $replyOne['textrcontent']);
				$qian=array(" ","　","\t","\n","\r");
				$hou=array("","","","","");
				$replyOne['textrcontent'] =str_replace($qian,$hou,$replyOne['textrcontent']);
				$replyOne['textrcontent'] = strip_tags($replyOne['textrcontent'], "<table><tbody><tr><th><td><span><script>");
			}else{
				$replyOne['rcontent'] = discuzcode($replyOne['rcontent']);
				$replyOne['rcontent'] = thumb_all_pic(800, 0, $replyOne['rcontent']);
				$replyOne['rcontent'] = removingPBR($replyOne['rcontent']);
				$replyOne['textrcontent'] = preg_replace("/<img.*\/>/i", '', $replyOne['rcontent']);
				$replyOne['textrcontent']=str_replace('&nbsp;', '', $replyOne['textrcontent']);
				$replyOne['textrcontent']=str_replace('&nbsp;', '', $replyOne['textrcontent']);
				$qian=array(" ","　","\t","\n","\r");
				$hou=array("","","","","");
				$replyOne['textrcontent'] =str_replace($qian,$hou,$replyOne['textrcontent']);
				$replyOne['textrcontent'] = strip_tags($replyOne['textrcontent'], "<table><tbody><tr><th><td><span><script>");
			}
			$v['textrcontent'] = cutstr($replyOne['textrcontent'],132,'...');
			$v['textauthor'] = $replyOne['author'];
			$v['textauthorid'] = $replyOne['authorid'];
			$v['textauthoravatar'] = avatar($replyOne['authorid'], 'middle', false, false, false, '', true);

			$question_list[] 		= $v;
		}
		foreach($question_list as $k=>$v){
			if( mb_strlen($v['textrcontent'], 'GBK') <= 40  ){
				unset($question_list[$k]);
			}
		}
		shuffle($question_list);
		$fin_question_list = array_slice($question_list, 0, 6);
		memory('set', $keyname, $fin_question_list, 3600);
		return $fin_question_list;
	}else{
		return $fin_question_list;
	}
}

	
?>