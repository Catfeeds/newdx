<?php

/**
 * @author lvshuo
 * @copyright 2016
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

Class TopicCtl extends QuestionCtl {

	var $modname = 'topic';

	function showlist(){
		global $_G;
		require DISCUZ_ROOT . '/source/function/function_discuzcode.php';
		require DISCUZ_ROOT . '/source/function/function_readmodelTravel.php';
		require DISCUZ_ROOT . '/source/function/function_question.php';
		$hot  = $_G['gp_hot'] ? $_G['gp_hot'] : 0;
		$lable  = $_G['gp_lable'] ? $_G['gp_lable'] : 0;

                $data['outputlableQrimg'] =getLableQrAd($lable);
		if($lable){
			$temp_query = DB::query("SELECT lable_id FROM " . DB::table('question_lable') . " WHERE isshow = '1' AND  up_value like '%$lable%' " . getSlaveID());
			$lablewhere = " AND  ( ";
			$lablewhere .= " (instr(`lable`, '{$lable}')>0 )";
			while ($row = DB::fetch($temp_query)) {
				$lablewhere .= "  OR (instr(`lable`, '{$row[lable_id]}')>0 )";
			}
			$lablewhere .= " )";
		}

		$outputlables =getQuestionLablesBycounts();
		$data['outputlables'] = $outputlables;

		$hot  = $_G['gp_hot'] ? $_G['gp_hot'] : 0;
		$lable  = $_G['gp_lable'] ? $_G['gp_lable'] : 0;

		$data['guanzhuNum'] = getWendaGuanzhuCache($lable);
		$data['guanzhuImg'] = getWendaGuanzhuImgCache($lable,20);


		//问题列表
		$perpage  = 20;
		$page  = $_G['gp_page'] ? $_G['gp_page'] : 1;
		$start = ($page-1)*$perpage;
		if($start < 0) $start = 0;
		$multi    = '';
		$list     = array();
		$hotwhere ="";
		if(!$hot){
			$hotwhere .= " AND replynum != '0' ";
		}
		$sql   = "SELECT COUNT(*) AS count FROM ".DB::table('question_topic')." WHERE title != '' AND isshow ='1' $hotwhere $lablewhere " . getSlaveID();
		$count = DB::result_first($sql);
		if($count) {

			$where = "title != '' AND isshow ='1'";
			if($lable){
				$where .= $lablewhere;
			}
			if(!$hot){
				$where .= $hotwhere;
			}
			if($hot){
				//$orderby ="displayorder DESC,topicid DESC";
				$orderby ="topicid DESC";
			}else{
				//$orderby ="displayorder DESC,pubdateline DESC,replynum DESC,topicid DESC";
				$orderby ="pubdateline DESC,topicid DESC,replynum DESC";
			}
			$sql ="SELECT topicid,title, replynum,upreplyid FROM ".DB::table("question_topic")." WHERE $where ORDER BY $orderby LIMIT $start, $perpage ".getSlaveID();
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {
				if($v['upreplyid']){
					$replyOne =DB::fetch_first("SELECT * FROM " . DB::table('question_reply') . " where replyid ='{$v[upreplyid]}' " . getSlaveID());
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
							$replyOne['rcontent'] = $this->_removingPBR($replyOne['rcontent']);
							$replyOne['textrcontent'] = preg_replace("/<img.*\/>/i", '', $replyOne['rcontent']);
							$replyOne['textrcontent']=str_replace('&nbsp;', '', $replyOne['textrcontent']);
							$qian=array(" ","　","\t","\n","\r");
							$hou=array("","","","","");
							$replyOne['textrcontent'] =str_replace($qian,$hou,$replyOne['textrcontent']);
							$replyOne['textrcontent'] = strip_tags($replyOne['textrcontent'], "<table><tbody><tr><th><td><span><script>");
					}else{
						$replyOne['rcontent'] = discuzcode($replyOne['rcontent']);
						$replyOne['rcontent'] = thumb_all_pic(800, 0, $replyOne['rcontent']);
						$replyOne['rcontent'] = $this->_removingPBR($replyOne['rcontent']);
						$replyOne['textrcontent'] = preg_replace("/<img.*\/>/i", '', $replyOne['rcontent']);
						$replyOne['textrcontent']=str_replace('&nbsp;', '', $replyOne['textrcontent']);
						$replyOne['textrcontent']=str_replace('&nbsp;', '', $replyOne['textrcontent']);
						$qian=array(" ","　","\t","\n","\r");
						$hou=array("","","","","");
						$replyOne['textrcontent'] =str_replace($qian,$hou,$replyOne['textrcontent']);
						$replyOne['textrcontent'] = strip_tags($replyOne['textrcontent'], "<table><tbody><tr><th><td><span><script>");
					}

					$v['textrcontent'] = cutstr($replyOne['textrcontent'],260,'...');
					$v['textauthor'] = $replyOne['author'];
					$v['textauthorid'] = $replyOne['authorid'];
				}

				$list[] 		= $v;
			}
			$multi = multi($count, $perpage, $page, "question.php?ctl=topic&act=showlist&hot={$hot}&lable={$lable}");
			$multi  = str_replace('&amp;', '&', $multi);
			$multi  = preg_replace('/question\.php\?ctl=topic&act=showlist&hot=(\d+)&lable=(\d+)&page=(\d+)/ise', "\$this->_rewriteUrl('\\1', '\\2', '\\3')", $multi);

		}


		$xgsql = "SELECT  topicid,title,author,replynum FROM " . DB::table("question_topic") . " WHERE  isshow ='1' ORDER BY replynum ASC  LIMIT 5" . getSlaveID();
		$xgtopic = DB::query($xgsql);
		$xgtopiclist = array();
		while ($row = DB::fetch($xgtopic)) {
			$xgtopiclist[] = $row;
		}

		$gxsql = "SELECT  COUNT(authorid),authorid,author FROM " . DB::table("question_reply") . " WHERE ref_replyid = '0' and authorid !='1'  GROUP BY authorid ORDER BY COUNT( authorid ) DESC LIMIT 5 " . getSlaveID();
		$gxuser = DB::query($gxsql);
		$gxuserlist = array();
		while ($row = DB::fetch($gxuser)) {
			$gxuserlist[] = $row;
		}

		$data['xgtopiclist'] = $xgtopiclist;
		$data['gxuserlist'] = $gxuserlist;
		if($lable){
			$lables_str = DB::result_first("SELECT lable_value FROM " . DB::table("question_lable") . " WHERE isshow = '1' AND lable_id = '$lable' " . getSlaveID());
		    $data['navtitle'] = $lables_str.'问答列表';
		}else{
			$data['navtitle'] = '户外问答列表';
		}

		if($page>1){
			$data['navtitle'] .= ' - 第'.$page.'页';
		}

		$data['list'] = $list;
		$data['multi'] = $multi;
		$data['hot'] = $hot;
		$data['lable'] = $lable;
		$this->assign($data);
		$this->display('question/topic/list');
	}

	function _rewriteUrl($hot,$lable, $page) {
		return "/wenda/list-{$hot}-{$lable}-{$page}.html";
	}

	function index() {
		global $_G;

		require DISCUZ_ROOT . '/source/function/function_discuzcode.php';
		require DISCUZ_ROOT . '/source/function/function_readmodelTravel.php';
		require DISCUZ_ROOT . '/source/function/function_question.php';


		$topicid = $_G['gp_topicid'];
		if (!$topicid) {
			$this->showmessage('topicid不能为空!');
		}

		$where = "topicid = '{$topicid}' AND isshow !='2'";

		$sql = "SELECT  * FROM " . DB::table("question_topic") . " WHERE $where ORDER BY dateline DESC " . getSlaveID();
		$topic = DB::fetch_first($sql);
		if(!$topic){
			header("HTTP/1.1 404 Not Found");
			header('Status: 404');
			exit;
		}

		if($topic['isshow'] == 0 && $_G['adminid'] <= 0) {
			showmessage('您要查看的内容不存在或未审核，请返回');
		}


		//若是扫的二维码，则跳转
		if ($_G['gp_is_wei']) {
			if($_G['gp_shareuid']){
				setNewWendaShareCache($topicid, $_G['gp_shareuid']);
			}

			if($_G['gp_is_wei']==1){
				dheader("location:{$_G['siteurl']}wenda/{$topicid}.html");
			}
		}

		$topic['viewnum'] = getWendaViewCache($topicid);
		$wendaShare = getWendaShareCache($topicid, 4);
		$topic['sharenum'] =$wendaShare['sharenum'];
		$topic['shareuids'] =$wendaShare['list'];



		$topic['lable'] = getTopicLables($topic['lable']);

		$topic['xgshowlable'] = getxgTopicLables($topic['lable']);

		setWendaGuanzhuCache($topic['lable'],$_G['uid']);

		$topic['showlable'] = '';
		$topic['topshowlable'] = '';
		$topic['firstlable'] = "AND (";
		if ($topic['lable']) {
			$topic[lable_forsql] = trim($topic[lable],',');
			$showlable_query = DB::query("SELECT lable_id,lable_value FROM " . DB::table('question_lable') . " WHERE lable_id in({$topic[lable_forsql]}) ORDER BY disorder DESC LIMIT 5" . getSlaveID());
			$allowlable= getQuestionLables();
			while ($row = DB::fetch($showlable_query)){
				if(array_key_exists($row[lable_id],$allowlable)){
				 $topic['showlable'] .='<a class="tagiconone" href="wenda/list-0-'.$row[lable_id].'-1.html" target="_blank">'.$row[lable_value].'</a>';
				}else{
				  $topic['showlable'] .='<a class="tagiconone" >'.$row[lable_value].'</a>';
				}
				if(!$topic['topshowlable']){
						if(array_key_exists($row[lable_id],$allowlable)){
							$topic['topshowlable'] ='<a  href="wenda/list-0-'.$row[lable_id].'-1.html">'.$row[lable_value].'</a>';
						}
				}
				if($topic['firstlable'] == "AND ("){
				$topic['firstlable'] .="(instr(`lable`, '{$row[lable_id]}')>0 )";
				}else{
				 $topic['firstlable'] .="  OR (instr(`lable`, '{$row[lable_id]}')>0 )";
				}
			}

		}

		$topic['firstlable'] .= ")";
		//var_dump($topic['firstlable']);


		$topic['content'] =questionmodelMessage($topic['content']);
		$topic['pic1'] =$topic['pic1']? getimagethumb(1500,1500,1,'plugin/'.$topic['pic1'], 0, 99):'';
		$topic['pic2'] =$topic['pic2']? getimagethumb(1500,1500,1,'plugin/'.$topic['pic2'], 0, 99):'';
		$topic['pic3'] =$topic['pic3']? getimagethumb(1500,1500,1,'plugin/'.$topic['pic3'], 0, 99):'';
		$topic['pic4'] =$topic['pic4']? getimagethumb(1500,1500,1,'plugin/'.$topic['pic4'], 0, 99):'';

		$replysql = "SELECT  * FROM " . DB::table("question_reply") . " WHERE ( (rcontent!='' AND tid= '0' AND ishidden= '0') OR ( tid > 0 AND tiddata NOT IN ('','[]')) ) AND ref_topicid = '{$topicid}' ORDER BY isup DESC,dateline DESC " . getSlaveID();
		$query = DB::query($replysql);

		$list = array();
		$replyuser_list = array();
		while ($row = DB::fetch($query)) {
			$row['imgcount'] = 0;
			if($row['tid']>0){
				$row['tiddata'] =json_decode($row['tiddata'], true);
				for($i=0;$i<count($row['tiddata']);$i++){
					$postOne =DB::fetch_first("SELECT message FROM " . DB::table('forum_post') . " where pid={$row['tiddata'][$i]} " . getSlaveID());
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
					$postOne['message'] = preg_replace('/\[quote\](.*)\[size=2\](.*)发表于(.*)static\/image\/common\/back\.gif(.*)\[\/size\](.*)\[\/quote\]/isU', '', $postOne['message']);
					$postOne['message'] = preg_replace('/\[quote\]原帖由(.*)\[\/quote\]/isU', '', $postOne['message']);

					if($i==(count($row['tiddata'])-1)){
					$row['rcontent'] .=$postOne['message'];
					}else{
					$row['rcontent'] .=$postOne['message'].'<br/>';
					}
				}

				$row['rcontent'] = questionmodelMessage($row['rcontent']);
				$row['rcontent'] = htmlspecialchars_decode($row['rcontent']);
				$row['rcontent'] = $this->_removingPBR($row['rcontent']);
				//var_dump($row['rcontent']);
				preg_match_all("/<img.*class='lazy.*'.*(w1500h1500'|.jpg')\/>/i",$row['rcontent'], $arr);
				if($arr[0]){
					$row['imgcount']= count($arr[0]);
					$row['imgfirst'] = $arr[0][0];
					$temp = explode('/>',$row['imgfirst']);
					$row['imgfirst'] = $temp[0].'/>';
				}

			}else{
				$row['rcontent'] = discuzcode($row['rcontent']);
				$row['rcontent'] = thumb_all_pic(800, 0, $row['rcontent']);
				$row['rcontent'] = $this->_removingPBR($row['rcontent']);
				preg_match_all("/<img.*class=\"zoom\".*\/>/iseU",$row['rcontent'], $arr);
				if($arr[0]){
					$row['imgcount']= count($arr[0]);
					$row['imgfirst'] = $arr[0][0];
					$temp = explode('/>',$row['imgfirst']);
					$row['imgfirst'] = $temp[0].'/>';
				}
			}
			$row['gooddata'] = json_decode($row['gooddata'], true);

			$row['newrcontent'] = $row['rcontent'];
			$row['newrcontent'] = preg_replace('/<br\/>/is', '', $row['newrcontent']);
			$row['newrcontent'] = preg_replace('/<br \/>/is', '', $row['newrcontent']);
			$row['newrcontent'] = preg_replace('/<br>/is', '', $row['newrcontent']);
			$row['newrcontent'] = preg_replace('/<br >/is', '', $row['newrcontent']);


			$row['textrcontent'] = preg_replace("/<img.*\/>/i", '', $row['newrcontent']);
			$row['textrcontent'] = strip_tags($row['newrcontent'], "<a><table><tbody><tr><th><td><span><script><br>");

			//过滤开头<br/>
			$tmp = strpos($row['rcontent'], '<br/>');
			if($tmp<=2&&$tmp!==false){
				$row['rcontent'] = substr($row['rcontent'],6);
			}
			$tmp = strpos($row['rcontent'], '>');
			if($tmp<=0&&$tmp!==false){
				$row['rcontent'] = substr($row['rcontent'],1);
			}
			$list[] = $row;
			$replyuser_list[] = $row['authorid'];
		}
		//var_dump($list);
		$topic[firstlable] = $topic[firstlable] =="AND ()"? "":$topic[firstlable];
		$xgsql = "SELECT  topicid,title,author,replynum FROM " . DB::table("question_topic") . " WHERE  isshow ='1' {$topic[firstlable]}  ORDER BY replynum DESC  LIMIT 5" . getSlaveID();

		$xgtopic = DB::query($xgsql);
		$xgtopiclist = array();
		while ($row = DB::fetch($xgtopic)) {
			$xgtopiclist[] = $row;
		}

		$gxsql = "SELECT  COUNT(authorid),authorid,author FROM " . DB::table("question_reply") . " WHERE ref_replyid = '0' and authorid !='1'  GROUP BY authorid ORDER BY COUNT( authorid ) DESC LIMIT 5 " . getSlaveID();
		$gxuser = DB::query($gxsql);
		$gxuserlist = array();
		while ($row = DB::fetch($gxuser)) {
			$gxuserlist[] = $row;
		}

		$true_replynum = count($list);
		if($topic['replynum']!=$true_replynum){
			DB::update('question_topic', array('replynum'=>$true_replynum), "topicid={$topicid}");
			$topic['replynum']=$true_replynum;
		}


		$data['topic'] = $topic;
		$data['replylist'] = $list;
		$data['replyuserlist'] = $replyuser_list;
		$data['xgtopiclist'] = $xgtopiclist;
		$data['gxuserlist'] = $gxuserlist;
		$data['navtitle'] = ' - 问答';
		$data['taskid'] = $_G['gp_taskid'];
		$data['channel'] = $_G['gp_channel'];
		$this->assign($data);
		$this->display('question/topic/index');
	}


	function ajaxCommentlist(){
		$ref_topicid = intval($_GET['ref_topicid']);
		$replyid = intval($_GET['replyid']);
		$list = array();
		if($ref_topicid&&$replyid){
			$replyOne =DB::fetch_first("SELECT replyid,tiddatacomment FROM " . DB::table('question_reply') . " where replyid={$replyid} " . getSlaveID());
			if($replyOne){

				$commentsql = "SELECT replyid,rcontent,dateline,author FROM " . DB::table("question_reply") . " WHERE ref_replyid = '{$replyid}' ORDER BY dateline DESC " . getSlaveID();
				$commentlist = DB::query($commentsql);
				while ($row = DB::fetch($commentlist)) {
					$row['rcontent'] = diconv($row['rcontent'], 'gbk', 'utf-8');
					$row['author'] = diconv($row['author'], 'gbk', 'utf-8');
					$row['dateline'] = date('Y-m-d H:i',$row['dateline']);
					$list[] = $row;
				}

				if($replyOne['tiddatacomment']!=''&&$replyOne['tiddatacomment']!='[]'){
					$tiddatacomment =json_decode($replyOne['tiddatacomment'], true);

					if(count($tiddatacomment)){
						$inforpid='';
						for($i=0;$i<count($tiddatacomment);$i++){
							$inforpid .="'{$tiddatacomment[$i]}',";
						}
						$inforpid = substr($inforpid, 0, strlen($inforpid) - 1);
						$postOne =DB::query("SELECT comment AS rcontent,dateline,author FROM " . DB::table('forum_postcomment') . " WHERE forpid IN ({$inforpid}) ORDER BY dateline DESC " . getSlaveID());
						while ($row = DB::fetch($postOne)) {
							$row['rcontent'] = diconv($row['rcontent'], 'gbk', 'utf-8');
							$row['author'] = diconv($row['author'], 'gbk', 'utf-8');
							$row['dateline'] = date('Y-m-d H:i',$row['dateline']);
							$list[] = $row;
						}

					}

				}

				//过滤工资钱包广告
				if($list){
					$list_new = array();
					foreach ($list as $lk => $lv) {
						
						$rcontent_temp = diconv($lv['rcontent'], 'utf-8', 'gbk');
						if(mb_strpos($rcontent_temp, '工资钱包')===false&&mb_strpos($rcontent_temp, '公积金')===false){
							$list_new[] =$lv;
						}
					}
					$list = $list_new;
				}
				//过滤工资钱包广告

			    echo json_encode($list);
				exit();
			}
		}

	}


	function ajaxpostComment(){
		$ref_topicid = intval($_GET['topicid']);
		$replyid = intval($_GET['replyid']);
		global $_G;
		if(!$_G['uid']){
			echo json_encode(array('nologin'=>1));
			exit();
		}

		if ($_G['groupid'] <= 0 || in_array($_G['groupid'], array(4, 5, 6, 7, 8))) {
			echo json_encode(array('nocomment'=>1));
			exit;
		}

		$rcontent = $_G['gp_rcontent'];
		$rcontent = diconv($rcontent, 'utf-8', 'gbk');

		$insert_data = array();
		$insert_data['ref_replyid'] = $replyid;
		$insert_data['rcontent'] = $rcontent;
		$insert_data['authorid'] = $_G['uid'];
		$insert_data['author'] = $_G['username'];
		$dateline = $_G['timestamp'];
		$insert_data['dateline'] = $dateline;
		DB::insert('question_reply', $insert_data);
		$returnreplyid= DB::insert_id();
		$replyOne = DB::fetch_first("SELECT  replynum FROM " . DB::table("question_reply") . " WHERE replyid = '{$replyid}' " . getSlaveID());
		DB::update('question_reply', $data = array('replynum' => $replyOne['replynum'] + 1), "replyid={$replyid}");

		$list = array(
			    'replyid'=>$returnreplyid,
			    'rcontent'=>$_G['gp_rcontent'],
				'author'=> $_G['username'],
		        'dateline'=>date('Y-m-d H:i',$dateline),
			    'replynum'=>($replyOne['replynum'] + 1)
		);
		echo json_encode($list);
		exit();

	}


	function ajaxpostGood(){
		global $_G;
		if(!$_G['uid']){
			echo json_encode(array('nologin'=>1));
			exit();
		}
		$uid = intval($_G['uid']);
		$replyid = intval($_G['gp_replyid']);
		if($replyid){
			$replyOne = DB::fetch_first("SELECT  goodnum, gooddata FROM " . DB::table("question_reply") . " WHERE replyid = '{$replyid}' " . getSlaveID());
			if($replyOne['gooddata']!=''&&$replyOne['gooddata']!='[]'){
				$gooddata =json_decode($replyOne['gooddata'], true);
				if (!in_array($uid,$gooddata)) {
					$gooddata[] = $uid;
					$update_data = array();
					$update_data['goodnum'] = $replyOne['goodnum'] + 1;
					$update_data['gooddata'] = json_encode($gooddata);
					DB::update('question_reply', $update_data, "replyid={$replyid}");
					echo json_encode(array('goodnum'=>$update_data['goodnum'],'dogood'=>1));
					exit();
				}else{
					$key = array_search($uid, $gooddata);
					if ($key !== false) {
						array_splice($gooddata, $key, 1);
					}
					$update_data = array();
					$update_data['goodnum'] = $replyOne['goodnum'] - 1;
					$update_data['gooddata'] = json_encode($gooddata);
					DB::update('question_reply', $update_data, "replyid={$replyid}");
					echo json_encode(array('goodnum'=>$update_data['goodnum'],'dogood'=>-1));
					exit();

				}

			}else{
				$update_data = array();
				$update_data['goodnum'] = $replyOne['goodnum'] + 1;
				$update_data['gooddata'] = json_encode(array($uid));
				DB::update('question_reply', $update_data, "replyid={$replyid}");
				echo json_encode(array('goodnum'=>$update_data['goodnum'],'dogood'=>1));
				exit();
			}
		}
	}


	function reply() {
		global $_G;

		require DISCUZ_ROOT . '/source/function/function_discuzcode.php';
		require DISCUZ_ROOT . '/source/function/function_readmodelTravel.php';


		$topicid = $_G['gp_topicid'];
		if (!$topicid) {
			$this->showmessage('topicid not found!');
		}

		$where = "topicid = '{$topicid}'";

		$sql = "SELECT  * FROM " . DB::table("question_topic") . " WHERE $where ORDER BY dateline DESC " . getSlaveID();
		$topic = DB::fetch_first($sql);
		$topic['content'] =readmodelMessage($topic['content']);

		$replysql = "SELECT  * FROM " . DB::table("question_reply") . " WHERE ref_topicid = '{$topicid}' AND authorid='{$_G['uid']}' ORDER BY replyid DESC " . getSlaveID();
		$query = DB::query($replysql);

		$list = array();
		while ($row = DB::fetch($query)) {
			$row['rcontent'] = discuzcode($row['rcontent']);
			$row['rcontent'] = thumb_all_pic(800, 0, $row['rcontent']);
			$list[] = $row;
		}

		$xgsql = "SELECT  topicid,title,author FROM " . DB::table("question_topic") . " WHERE topicid != '{$topicid}' ORDER BY dateline DESC  LIMIT 5" . getSlaveID();
		$xgtopic = DB::query($xgsql);
		$xgtopiclist = array();
		while ($row = DB::fetch($xgtopic)) {
			$xgtopiclist[] = $row;
		}

		$data['topic'] = $topic;
		$data['replylist'] = $list;
		$data['xgtopiclist'] = $xgtopiclist;
		$data['navtitle'] = '回答问题';
		$data['taskid'] = $_G['gp_taskid'];
		$data['channel'] = $_G['gp_channel'];
		$this->assign($data);
		$this->display('question/topic/answer');
	}

	function doreply() {
		//此处只剩新增回复，编辑回复改由 function ajaxdoreply 执行          20161111 zhangwenchu
		global $_G;

		if ($_G['uid'] == 0) {
			showmessage('not_loggedin', NULL, array(), array('login' => 1));
		}

		$topicid = $_G['gp_topicid'];
		if (!$topicid) {
			$this->showmessage('topicid not found!');
		}

		if ($_G['groupid'] <= 0 || in_array($_G['groupid'], array(4, 5, 6, 7, 8))) {
			$this->showmessage('抱歉，您无权限回复内容!');
		}

		$rcontent = trim($_G['gp_message']);
		if (!$rcontent) {
			$this->showmessage('回复内容不能为空!');
		}

		$data = array();
		$data['ref_topicid'] = $topicid;
		$data['rcontent'] = $rcontent;
		$data['authorid'] = $_G['uid'];
		$data['author'] = $_G['username'];
		$data['dateline'] = $_G['timestamp'];

		$replyid = $_G['gp_editreplyid'];
		if ($replyid) {
			//修改

			/*
			$replysql = "SELECT  * FROM " . DB::table("question_reply") . " WHERE ref_topicid = '{$topicid}' AND replyid='{$replyid}' AND authorid='{$_G['uid']}' " . getSlaveID();
			$query = DB::query($replysql);

			$list = array();
			while ($row = DB::fetch($query)) {
				$list[] = $row;
			}
			if (empty($list)) {
				$this->showmessage('replyid not found!');
			}

			DB::update('question_reply', $data, "replyid={$replyid}");
			showmessage('编辑成功', 'wenda/'.$topicid.'.html#answerone'.$_G['uid']);
			*/
		} else {
			//新增
			$data['channel'] = $_G['gp_channel'];
			DB::insert('question_reply', $data);
			$sql = "SELECT  replynum,title FROM " . DB::table("question_topic") . " WHERE topicid = '{$topicid}' ORDER BY dateline DESC " . getSlaveID();
			$replynum = DB::fetch_first($sql);
			DB::update('question_topic', $data = array('replynum' => $replynum['replynum'] + 1), "topicid={$topicid}");

			 //回答问题加驴币
				updatemembercount($_G['uid'], array(2 => 10),1, $operation = 'doreply');
				notification_add($_G['uid'], 'system', '奖励10驴币，感谢您回答问题 <a href="question.php?ctl=topic&act=reply&topicid='.$topicid.'" target="_blank">'.$replynum['title'].'</a>', array(), 1);


			showmessage('回复成功', 'wenda/' . $topicid.'.html');
		}
	}

		function ajaxdoreply() {
		global $_G;

		if ($_G['uid'] == 0) {
			$data = array('flag' => 0,'content' => '对不起，你还未登录，无法进行此操作。' );
					echo json_encode($data);die();
		}

		$topicid = $_G['gp_topicid'];
		if (!$topicid) {
			$data = array('flag' => 0,'content' => 'topicid not found!' );
					echo json_encode($data);die();
		}

		$rcontent = trim($_G['gp_message']);
				$rcontent = diconv($rcontent,'UTF-8', 'GBK');

		if (!$rcontent) {
				$data = array('flag' => 0,'content' => '回复内容不能为空!' );
				echo json_encode($data);die();
		}

		$data = array();
		$data['ref_topicid'] = $topicid;
		$data['rcontent'] = $rcontent;
		$data['dateline'] = $_G['timestamp'];

		$replyid = $_G['gp_editreplyid'];
		if ($replyid) {
			//修改
			$replysql = "SELECT  * FROM " . DB::table("question_reply") . " WHERE ref_topicid = '{$topicid}' AND replyid='{$replyid}' " . getSlaveID();
			$query = DB::query($replysql);

			$list = array();
			while ($row = DB::fetch($query)) {
				$list[] = $row;
			}
			if (empty($list)) {
				$data = array('flag' => 0,'content' => 'replyid not found!' );
							echo json_encode($data);die();
			}

			if($_G['groupid'] != 1 && $_G['uid'] != $list[0]['authorid']){
				$data = array('flag' => 0,'content' => 'edit not allowed' );
				echo json_encode($data);die();
			}

			DB::update('question_reply', $data, "replyid={$replyid}");
					$data = array('flag' => 1 );
					echo json_encode($data);die();
		} else {
			$data = array('flag' => 0,'content' => 'replyid not found!' );
					echo json_encode($data);die();
		}
	}

		function ajaxdodelete() {
		global $_G;

		if ($_G['uid'] == 0) {
			$data = array('flag' => 0,'content' => '对不起，你还未登录，无法进行此操作。' );
					echo json_encode($data);die();
		}

		if($_G['groupid'] != 1){
				$data = array('flag' => 0,'content' => '对不起，你没有权限进行此操作。' );
				echo json_encode($data);die();
		}

		$replyid = $_G['gp_replyid'];
		if (!$replyid) {
			$data = array('flag' => 0,'content' => 'replyid not found!' );
				echo json_encode($data);die();
		}
		$topicid = $_G['gp_topicid'];
		if (!$topicid) {
			$data = array('flag' => 0,'content' => 'topicid not found!' );
				echo json_encode($data);die();
		}
		$authorid = $_G['gp_authorid'];
		if (!$authorid) {
			$data = array('flag' => 0,'content' => 'authorid not found!' );
				echo json_encode($data);die();
		}

		$result_id = DB::result_first("select replyid from ".DB::table('question_reply')." where replyid = ".$replyid." and ref_topicid = ".$topicid." and authorid = ".$authorid);
		if($result_id){
			
			DB::delete('question_reply', "replyid='$result_id'");
			
			$data = array('flag' => 1 );
			echo json_encode($data);die();
		}else{
			$data = array('flag' => 0,'content' => 'replyid not found!' );
			echo json_encode($data);die();
		}
	}

	function ajaxdoupdown() {
		global $_G;

		if ($_G['uid'] == 0) {
			$data = array('flag' => 0,'content' => '对不起，你还未登录，无法进行此操作。' );
				echo json_encode($data);die();
		}

		if($_G['groupid'] != 1){
				$data = array('flag' => 0,'content' => '对不起，你没有权限进行此操作。' );
				echo json_encode($data);die();
		}
		
		$replyid = $_G['gp_replyid'];
		if (!$replyid) {
			$data = array('flag' => 0,'content' => 'replyid not found!' );
				echo json_encode($data);die();
		}

		$isup = $_G['gp_isup'];
		if (!in_array($isup, array(0,1)) ) {
			$data = array('flag' => 0,'content' => 'state not found!' );
			echo json_encode($data);die();
		}

		DB::update('question_reply', array('isup'=>$isup), array('replyid'=>$replyid));

		$data = array('flag' => 1,'content' => $isup );
		echo json_encode($data);die();
	}

	function editreply() {
		global $_G;

		require DISCUZ_ROOT . '/source/function/function_discuzcode.php';
		require DISCUZ_ROOT . '/source/function/function_readmodelTravel.php';
		require DISCUZ_ROOT . '/source/function/function_question.php';

	//修改编辑系统。由跳转页面改为弹窗样式。
	//20161110 zhangwenchu

		if ($_G['uid'] == 0) {
			$data = array('flag' => 0,'content' => '对不起，你还未登录，无法进行此操作。' );
			echo json_encode($data);die();
		}

		$topicid = $_G['gp_topicid'];
		if (!$topicid) {
			$data = array('flag' => 0,'content' => 'topicid not found!' );
			echo json_encode($data);die();
		}

		$replyid = $_G['gp_replyid'];
		if (!$replyid) {
			$data = array('flag' => 0,'content' => 'replyid not found!' );
			echo json_encode($data);die();
		}

		$where = "topicid = '{$topicid}'";

		$sql = "SELECT  * FROM " . DB::table("question_topic") . " WHERE $where ORDER BY dateline DESC " . getSlaveID();
		$topic = DB::fetch_first($sql);

		setWendaGuanzhuCache($topic['lable'],$_G['uid']);

		$replysql = "SELECT  * FROM " . DB::table("question_reply") . " WHERE ref_topicid = '{$topicid}' AND replyid='{$replyid}' " . getSlaveID();
		$query = DB::query($replysql);

		$list = array();
		while ($row = DB::fetch($query)) {
			$list[] = $row;
		}

		if (empty($list)) {
			$data = array('flag' => 0,'content' => 'replyid not found!' );
			echo json_encode($data);die();
		}

		$data = array('flag' => 1, 'content' => mb_convert_encoding($list[0]['rcontent'],'UTF-8', 'GBK') );
		echo json_encode($data);die();
	}

	function exportquestion($data) {
		global $_G;
		require DISCUZ_ROOT . '/source/function/function_readmodelTravel.php';

		if ($_G['uid'] == 0) {
			showmessage('not_loggedin', NULL, array(), array('login' => 1));
		}

		if ($_G['adminid'] <= 0) {
			showmessage('您当前的用户组 ( ' . $_G['group']['grouptitle'] . ' )，不能执行此操作。', NULL);
		}

		//表单
		$data['url'] = $_G['config']['web']['portal'] . "question.php?ctl={$this->modname}";
		$data['action'] = 'exportquestion';
		$data['timelist'] = !empty($typelist[1]) ? $typelist[1] : array();

		// 初始化编辑器相关设置
		$data['editorid'] = 'e';
		$_G['setting']['editoroptions'] = str_pad(decbin($_G['setting']['editoroptions']), 2, 0, STR_PAD_LEFT);
		$data['editor'] = array(
			'editormode' => $_G['setting']['editoroptions']{0},
			'allowswitcheditor' => $_G['setting']['editoroptions']{1},
			'allowhtml' => 1,
			'allowsmilies' => 0,
			'allowbbcode' => 1,
			'allowimgcode' => 1,
			'allowresize' => 1,
			'textarea' => 'message',
			'simplemode' => !isset($_G['cookie']['editormode_' . $data['editorid']]) ? 1 : $_G['cookie']['editormode_' . $data['editorid']],
		);

		if ($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
			require_once libfile('function/post');
			$data['attachlist'] = getattach(0);
			$data['attachs'] = $data['attachlist']['attachs'];
			$data['imgattachs'] = $data['attachlist']['imgattachs'];
			unset($data['attachlist']);

			//个人相册加载
			$albumlist = array();
			if ($_G['uid']) {
				$query = DB::query("SELECT albumid, albumname, picnum FROM " . DB::table('home_album') . " WHERE uid='$_G[uid]' ORDER BY updatetime DESC");
				while ($value = DB::fetch($query)) {
					if ($value['picnum']) {
						$albumlist[] = $value;
					}
				}
			}
			$data['albumlist'] = $albumlist;
		}

		if ($_G['gp_tid']) {
			$tid = $_G['gp_tid'];
			$wentisql = "SELECT t.fid, t.typeid,tc.name,p.subject,p.authorid,p.author,p.dateline,p.message,p.pid,p.comment FROM " . DB::table("forum_thread") . " AS t "
				. "LEFT JOIN " . DB::table("forum_post") . " AS p "
				. "ON t.tid=p.tid "
				. "LEFT JOIN " . DB::table("forum_threadclass") . " AS tc "
				. "ON t.typeid=tc.typeid "
				. " WHERE t.tid = '{$tid}' AND p.first='1' AND t.displayorder >= 0 AND p.invisible = '0' " . getSlaveID();

			$data['wenti'] = DB::fetch_first($wentisql);
			if (!$data['wenti']) {
				showmessage('输入的tid(' . $tid . ')非法 ', 'question.php?ctl=topic&act=exportquestion');
				die;
			}


			$data['questionShow'] = DB::fetch_first("SELECT topicid,title,content, hiddenpid,showpid,upuid,lable FROM " . DB::table('question_topic') . " where tid={$tid}" . getSlaveID());
			if (!$data['questionShow']) {
				showmessage('输入的tid(' . $tid . ')异常 ', 'question.php?ctl=topic&act=exportquestion');
				die;
			}

			$data['questionShow']['showlable'] = '';
			if ($data['questionShow']['lable']) {
				$showlable_query = DB::query("SELECT lable_value FROM " . DB::table('question_lable') . " WHERE lable_id IN ({$data['questionShow']['lable']})" . getSlaveID());
				while ($value = DB::fetch($showlable_query)) {
					$data['questionShow']['showlable'] .= $value['lable_value'] . ',';
				}
				$data['questionShow']['showlable'] = substr($data['questionShow']['showlable'], 0, strlen($data['questionShow']['showlable']) - 1);
			}


			if ($data['questionShow']['hiddenpid']) {
				$data['questionShow']['hiddenpid'] = json_decode($data['questionShow']['hiddenpid'], true);
			}
			if ($data['questionShow']['showpid']) {
				$data['questionShow']['showpid'] = json_decode($data['questionShow']['showpid'], true);
			}

			if ($data['questionShow']['content']) {
				$data['wenti']['message'] = $data['questionShow']['content'];
				$content_aids = array();
				preg_match_all("/\[attach\](\d+)\[\/attach\]/is", $data['questionShow']['content'], $content_aids);
				$content_aids = $content_aids[1];
				$imgattachs_unsed_new = $this->_getattach($content_aids);
				//var_dump($imgattachs_unsed_new);
			}

			//var_dump($data['questionShow']);

			$data['wenti']['message'] = dhtmlspecialchars($data['wenti']['message']);
			$pid = $data['wenti']['pid'];

			require_once libfile('function/post');
			//if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
			$data['attachlist'] = getattach($pid);
			$data['attachs'] = $data['attachlist']['attachs'];
			$data['imgattachs'] = $data['attachlist']['imgattachs'];
			unset($data['attachlist']);
			$attachfind = $attachreplace = array();
			if (!empty($data['attachs']['used'])) {
				foreach ($data['attachs']['used'] as $attach) {
					if ($attach['isimage']) {
						$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
						$attachreplace[] = '[attachimg]' . $attach['aid'] . '[/attachimg]';
					}
				}
			}
			if (!empty($data['imgattachs']['used'])) {
				foreach ($data['imgattachs']['used'] as $attach) {
					$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
					$attachreplace[] = '[attachimg]' . $attach['aid'] . '[/attachimg]';
				}
			}
			$attachfind && $data['wenti']['message'] = preg_replace($attachfind, $attachreplace, $data['wenti']['message']);

			$data['wenti']['message'] = preg_replace('/\[attach\](\d+)\[\/attach\]/is', '[attachimg]\1[/attachimg]', $data['wenti']['message']);
			for ($i = 0; $i < count($imgattachs_unsed_new['imgattachs_unused']); $i++) {
				$data['imgattachs']['used'][] = $imgattachs_unsed_new['imgattachs_unused'][$i];
			}

			//var_dump($data['imgattachs']);
			//答案开始
			if ($data['wenti']['fid'] == 163) {
				$daansql = "SELECT  p.subject,p.authorid,p.author,p.dateline,p.message,p.pid,p.comment FROM " . DB::table("forum_thread") . " AS t "
					. "LEFT JOIN " . DB::table("forum_post") . " AS p "
					. "ON t.tid=p.tid "
					. " WHERE t.tid = '{$tid}' AND p.first !='1' AND t.displayorder >= 0 AND p.invisible = '0' AND p.authorid != '" . $data['wenti']['authorid'] . "' ORDER BY p.dateline DESC " . getSlaveID();
			} else {
				$daansql = "SELECT  p.subject,p.authorid,p.author,p.dateline,p.message,p.pid,p.comment FROM " . DB::table("forum_thread") . " AS t "
					. "LEFT JOIN " . DB::table("forum_post") . " AS p "
					. "ON t.tid=p.tid "
					. " WHERE t.tid = '{$tid}'  AND t.displayorder >= 0 AND p.invisible = '0' ORDER BY p.dateline DESC " . getSlaveID();

			}
			$daan_query = DB::query($daansql);

			$daanlist = array();
			while ($row = DB::fetch($daan_query)) {
				//var_dump($row['pid'].":".preg_match("/\[attach\](\d+)\[\/attach\]/is", $row['message']));
				$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios]来自iPhone客户端[/url]', '', $row['message']);
				$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios/]来自iPhone客户端[/url]', '', $row['message']);
				$row['message']=str_replace('[url=www.8264.com/app/]来自iPhone客户端[/url]', '', $row['message']);
				$row['message']=str_replace('[url=http://www.8264.com/app/]来自iPhone客户端[/url]', '', $row['message']);
				$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android]来自Android客户端[/url]', '', $row['message']);
				$row['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android/]来自Android客户端[/url]', '', $row['message']);
				$row['message']=str_replace('[url=www.8264.com/app/]来自Android客户端[/url]', '', $row['message']);
				$row['message']=str_replace('[url=http://www.8264.com/app/]来自Android客户端[/url]', '', $row['message']);
				$row['message'] = preg_replace('/\[quote\](.*)\[size=2\](.*)发表于(.*)static\/image\/common\/back\.gif(.*)\[\/size\](.*)\[\/quote\]/isU', '', $row['message']);
				if (mb_strlen($row['message'], 'GBK') >= 30 || preg_match("/\[attach\](\d+)\[\/attach\]/is", $row['message'])) {
					$row['message'] = questionmodelMessage($row['message']);
					$row['message'] = $this->_removingPBR($row['message']);
					$daanlist[] = $row;
				}
			}
			//var_dump($daanlist);

			$commentsql = "SELECT * FROM " . DB::table("forum_postcomment") . " WHERE tid = '{$tid}' AND forpid !=0  AND isshow = '1' " . getSlaveID();
			$comment_query = DB::query($commentsql);
			$commentlist = array();
			$commentpid = array();
			while ($row = DB::fetch($comment_query)) {
				$row['comment'] =   ltrim(questionmodelMessage($row['comment']),'<br/>');
				$commentlist[$row['pid']][] = $row;
				$commentpid[] = $row['forpid'];
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
					$showdaanlist[$daanlist[$i]['authorid']]['arr'][$daanlist[$i]['pid']] = $daanlist[$i];
					asort($showdaanlist[$daanlist[$i]['authorid']]['arr']);

				}
			}
			//var_dump($showdaanlist);

			$data['showdaanlist'] = $showdaanlist;
			//答案结束
			//}
		}


		$data['navtitle'] = '导入帖子 - '.$data['questionShow']['title'];
		$data['action'] = 'exportquestion';
		if($data['questionShow']['content'] == ''){
			$data['wenti']['message'] = questionmodelMessage($data['wenti']['message']);
			$data['wenti']['message'] = htmlspecialchars_decode($data['wenti']['message']);
			$data['wenti']['message'] = $this->_removingPBR($data['wenti']['message']);
			$data['wenti']['message'] = preg_replace("/<img.*\/>/i", '', $data['wenti']['message']);
			$data['wenti']['message']=str_replace('&nbsp;', '', $data['wenti']['message']);
			$qian=array(" ","　","\t","\n","\r");
			$hou=array("","","","","");
			$data['wenti']['message'] =str_replace($qian,$hou,$data['wenti']['message']);
			$data['wenti']['message'] = strip_tags($data['wenti']['message'], "<table><tbody><tr><th><td><span><script>");
		}
		$this->assign($data);
		$this->display('question/topic/export');
	}

	function doexportquestion() {
		global $_G;

		if ($_G['uid'] == 0) {
			showmessage('not_loggedin', NULL, array(), array('login' => 1));
		}

		if ($_G['adminid'] <= 0) {
			showmessage('您当前的用户组 ( ' . $_G['group']['grouptitle'] . ' )，不能执行此操作。', NULL);
		}

		$postdata = array_merge($_GET, $_POST);
		$topicid = $postdata['hiddentopicid'];
		$postdata['message'] = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $postdata['message']);
		$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
		$data = array();
		$data['title'] = $postdata['subject'];
		$data['content'] = $postdata['message'];
		//$data['upuid'] = $_POST['zhidingradio'];

		$lable = '';
		if ($postdata['label']) {
			$labels = str_replace("，", ",", $postdata['label']);
			$labels_arr = explode(",", $labels);
			$count = count($labels_arr);
			for ($i = 0; $i < $count; $i++) {
				$lable_value = trim($labels_arr[$i]);
				if ($lable_value) {
					$lablesql = "SELECT * FROM " . DB::table("question_lable") . " WHERE lable_value = '{$lable_value}' " . getSlaveID();
					$lable_arr = DB::fetch_first($lablesql);
					if (!$lable_arr) {
						DB::insert('question_lable', array('lable_value' => $lable_value));
						$lable_arr['lable_id'] = DB::insert_id();
					}
					$lable .=$lable_arr['lable_id'] . ',';
				}
			}
			$lable = substr($lable, 0, strlen($lable) - 1);
		}
		$data['lable'] = $lable;

		DB::update('question_topic', $data, "topicid={$topicid}");
		showmessage('编辑成功 ', 'question.php?ctl=topic&act=exportquestion&tid=' . $postdata['hiddentid']);
	}

	function ajaxOpertionpid() {
		$topicid = intval($_GET['topicid']);
		$pid = intval($_GET['pid']);
		$operation = trim($_GET['tooperation']);

		$questionShow = DB::fetch_first("SELECT topicid, hiddenpid,upuid FROM " . DB::table('question_topic') . " where topicid={$topicid}" . getSlaveID());
		if ($questionShow) {

			if ($questionShow['hiddenpid']) {
				$questionShow['hiddenpid'] = json_decode($questionShow['hiddenpid'], true);
				if ($operation == 'hidden') {
					if (!in_array($pid, $questionShow['hiddenpid'])) {
						$questionShow['hiddenpid'][] = $pid;
						$data = array();
						$data['hiddenpid'] = json_encode($questionShow['hiddenpid']);
						if (DB::update('question_topic', $data, "topicid={$topicid}")) {
							echo 11;
						}
					}
				} elseif ($operation == 'show') {
					if (in_array($pid, $questionShow['hiddenpid'])) {
						$key = array_search($pid, $questionShow['hiddenpid']);
						if ($key !== false) {
							array_splice($questionShow['hiddenpid'], $key, 1);
						}
						$data = array();
						$data['hiddenpid'] = json_encode($questionShow['hiddenpid']);
						if (DB::update('question_topic', $data, "topicid={$topicid}")) {
							echo 10;
						}
					}
				}
			} else {
				if ($operation == 'hidden') {
					$hiddenpid = array($pid);
					$hiddenpid = json_encode($hiddenpid);
					$data = array();
					$data['hiddenpid'] = $hiddenpid;
					if (DB::update('question_topic', $data, "topicid={$topicid}")) {
						echo 11;
					}
				}
			}
		} else {
			echo -1;
		}
	}



	//答案pid隐藏
	function ajaxOpertionpid_daan() {
		$topicid = intval($_GET['topicid']);
		$pid = intval($_GET['pid']);
		$operation = trim($_GET['tooperation']);
		$uid = intval($_GET['uid']);

		$questionShow = DB::fetch_first("SELECT topicid,tid,replynum, showpid,upuid FROM " . DB::table('question_topic') . " where topicid={$topicid}" . getSlaveID());
		if ($questionShow) {

			if ($questionShow['showpid']) {
				$questionShow['showpid'] = json_decode($questionShow['showpid'], true);
				if ($operation == 'show') {
					if (!in_array($pid, $questionShow['showpid'])) {
						$questionShow['showpid'][] = $pid;
						$data = array();
						$data['showpid'] = json_encode($questionShow['showpid']);
						//$data['replynum'] = intval($questionShow['replynum'])+ 1;
						if (DB::update('question_topic', $data, "topicid={$topicid}")) {
							$replyOne =DB::fetch_first("SELECT replyid,tiddata FROM " . DB::table('question_reply') . " where ref_topicid={$topicid} and tid= {$questionShow[tid]} and authorid = {$uid}" . getSlaveID());
							if(!$replyOne){
								$postOne =DB::fetch_first("SELECT * FROM " . DB::table('forum_post') . " where pid={$pid} " . getSlaveID());
								$insert_data = array();
								$insert_data['ref_topicid'] = $topicid;
								$insert_data['authorid'] = $postOne['authorid'];
								$insert_data['author'] = $postOne['author'];
								$insert_data['dateline'] = $postOne['dateline'];
								$insert_data['tid'] = $questionShow['tid'];
								$insert_data['tiddata'] = $showpid;
								DB::insert('question_reply', $insert_data);
								DB::update('question_topic', array('replynum'=>intval($questionShow['replynum'])+ 1), "topicid={$topicid}");
							}else{
								$update_data = array();
								if($replyOne['tiddata']){
									if($replyOne['tiddata']=='[]'){
										DB::update('question_topic', array('replynum'=>intval($questionShow['replynum'])+ 1), "topicid={$topicid}");
									}
									$replyOne['tiddata'] = json_decode($replyOne['tiddata'], true);
									$replyOne['tiddata'][] = $pid;
									asort($replyOne['tiddata']);
									$update_data['tiddata'] = json_encode($replyOne['tiddata']);
								}else{
									$update_data['tiddata'] = $showpid;
									DB::update('question_topic', array('replynum'=>intval($questionShow['replynum'])+ 1), "topicid={$topicid}");
								}
								DB::update('question_reply', $update_data, "replyid={$replyOne['replyid']}");
							}


							echo 11;
						}
					}
				} elseif ($operation == 'hidden') {
					if (in_array($pid, $questionShow['showpid'])) {
						$key = array_search($pid, $questionShow['showpid']);
						if ($key !== false) {
							array_splice($questionShow['showpid'], $key, 1);
						}
						$data = array();
						$data['showpid'] = json_encode($questionShow['showpid']);
						//$data['replynum'] = intval($questionShow['replynum'])- 1;
						if (DB::update('question_topic', $data, "topicid={$topicid}")) {
							$replyOne =DB::fetch_first("SELECT replyid,tiddata FROM " . DB::table('question_reply') . " where ref_topicid={$topicid} and tid= {$questionShow[tid]} and authorid = {$uid}" . getSlaveID());
							$replyOne['tiddata'] = json_decode($replyOne['tiddata'], true);
							$keykey = array_search($pid, $replyOne['tiddata']);
							if ($keykey !== false) {
								array_splice($replyOne['tiddata'], $keykey, 1);
							}
							asort($replyOne['tiddata']);
							$update_data = array();
							$update_data['tiddata'] = json_encode($replyOne['tiddata']);
							if($update_data['tiddata']=='[]'||$update_data['tiddata']==''){
								DB::update('question_topic', array('replynum'=>intval($questionShow['replynum'])- 1), "topicid={$topicid}");
							}
							DB::update('question_reply', $update_data, "replyid={$replyOne['replyid']}");
							echo 10;
						}
					}
				}
			} else {
				if ($operation == 'show') {
					$showpid = array($pid);
					$showpid = json_encode($showpid);
					$data = array();
					$data['showpid'] = $showpid;
					//$data['replynum'] = intval($questionShow['replynum'])+ 1;
					if (DB::update('question_topic', $data, "topicid={$topicid}")) {
							$replyOne =DB::fetch_first("SELECT replyid,tiddata FROM " . DB::table('question_reply') . " where ref_topicid={$topicid} and tid= {$questionShow[tid]} and authorid = {$uid}" . getSlaveID());
							if(!$replyOne){
								$postOne =DB::fetch_first("SELECT * FROM " . DB::table('forum_post') . " where pid={$pid} " . getSlaveID());
								$insert_data = array();
								$insert_data['ref_topicid'] = $topicid;
								$insert_data['authorid'] = $postOne['authorid'];
								$insert_data['author'] = $postOne['author'];
								$insert_data['dateline'] = $postOne['dateline'];
								$insert_data['tid'] = $questionShow['tid'];
								$insert_data['tiddata'] = $showpid;
								//var_dump($insert_data['tiddata']);die;
								DB::insert('question_reply', $insert_data);
								DB::update('question_topic', array('replynum'=>intval($questionShow['replynum'])+ 1), "topicid={$topicid}");
							}else{
								$update_data = array();
								if($replyOne['tiddata']){
									if($replyOne['tiddata']=='[]'){
										DB::update('question_topic', array('replynum'=>intval($questionShow['replynum'])+ 1), "topicid={$topicid}");
									}
									$replyOne['tiddata'] = json_decode($replyOne['tiddata'], true);
									$replyOne['tiddata'][] = $pid;
									asort($replyOne['tiddata']);
									$update_data['tiddata'] = json_encode($replyOne['tiddata']);
								}else{
									$update_data['tiddata'] = $showpid;
									DB::update('question_topic', array('replynum'=>intval($questionShow['replynum'])+ 1), "topicid={$topicid}");
								}
								DB::update('question_reply', $update_data, "replyid={$replyOne['replyid']}");
							}

						echo 11;
					}
				}
			}
		} else {
			echo -1;
		}
	}




	//答案回复pid隐藏
	function ajaxOpertionpid_comment() {
		$topicid = intval($_GET['topicid']);
		$pid = intval($_GET['pid']);
		$operation = trim($_GET['tooperation']);
		$uid = intval($_GET['uid']);

		$questionShow = DB::fetch_first("SELECT topicid,tid,replynum, showpid,upuid FROM " . DB::table('question_topic') . " where topicid={$topicid}" . getSlaveID());
		if ($questionShow) {

			if ($questionShow['showpid']) {
				$questionShow['showpid'] = json_decode($questionShow['showpid'], true);

				$replyOne =DB::fetch_first("SELECT replyid,replynum,tiddatacomment FROM " . DB::table('question_reply') . " where ref_topicid={$topicid} and tid= {$questionShow[tid]} and authorid = {$uid}" . getSlaveID());

				if(!$replyOne){
					//必须有答案先被选中才能选回复
					echo 9;
					die;
				}

				if ($operation == 'show') {
					if (!in_array($pid, $questionShow['showpid'])) {
						$questionShow['showpid'][] = $pid;
						$data = array();
						$data['showpid'] = json_encode($questionShow['showpid']);
						if (DB::update('question_topic', $data, "topicid={$topicid}")) {

							$update_data = array();
							if($replyOne['tiddatacomment']){
								$replyOne['tiddatacomment'] = json_decode($replyOne['tiddatacomment'], true);
								$replyOne['tiddatacomment'][] = $pid;
								$update_data['tiddatacomment'] = json_encode($replyOne['tiddatacomment']);
							}else{
								$update_data['tiddatacomment'] = $showpid;
							}
							$update_data['replynum'] = intval($replyOne['replynum'])+1;
							DB::update('question_reply', $update_data, "replyid={$replyOne['replyid']}");



							echo 11;
						}
					}
				} elseif ($operation == 'hidden') {
					if (in_array($pid, $questionShow['showpid'])) {
						$key = array_search($pid, $questionShow['showpid']);
						if ($key !== false) {
							array_splice($questionShow['showpid'], $key, 1);
						}
						$data = array();
						$data['showpid'] = json_encode($questionShow['showpid']);
						if (DB::update('question_topic', $data, "topicid={$topicid}")) {
							$replyOne['tiddatacomment'] = json_decode($replyOne['tiddatacomment'], true);
							$keykey = array_search($pid, $replyOne['tiddatacomment']);
							if ($keykey !== false) {
								array_splice($replyOne['tiddatacomment'], $keykey, 1);
							}
							$update_data = array();
							$update_data['tiddatacomment'] = json_encode($replyOne['tiddatacomment']);
							$update_data['replynum'] = intval($replyOne['replynum'])-1;
							DB::update('question_reply', $update_data, "replyid={$replyOne['replyid']}");
							echo 10;
						}
					}
				}
			} else {
			    //必须有答案先被选中才能选回复
				echo 9;
			}
		} else {
			echo -1;
		}
	}


	function ajaxOpertionupuid() {
		$topicid = intval($_GET['topicid']);
		$upuid = intval($_GET['upuid']);

		$questionShow = DB::fetch_first("SELECT topicid,tid, hiddenpid,upuid,upreplyid FROM " . DB::table('question_topic') . " where topicid={$topicid}" . getSlaveID());
		if ($questionShow&&$topicid&&$upuid) {
			if($questionShow['upuid'] ==$upuid){
				echo 10;
			}else{
				$replyOne =DB::fetch_first("SELECT replyid FROM " . DB::table('question_reply') . " where ref_topicid={$topicid} and tid= {$questionShow[tid]} and authorid = {$upuid}" . getSlaveID());
				$data = array();
				$data['upuid'] = $upuid;
				$data['upreplyid'] = $replyOne['replyid'];
				if (DB::update('question_topic', $data, "topicid={$topicid}")) {
					DB::update('question_reply', array('isup'=>1), "replyid={$replyOne['replyid']}");
					if($questionShow['upreplyid']){
						DB::update('question_reply', array('isup'=>0), "replyid={$questionShow['upreplyid']}");
					}
					echo 11;
				}
			}

		} else {
			echo -1;
		}
	}



	function _getattach($content_aids = array(), $posttime = 0, $showdir = 'forum', $limit = 100) {
		global $_G;
		$inaids = '';
		if (is_array($content_aids)) {
			for ($i = 0; $i < count($content_aids); $i++) {
				$ninaids .="'" . $content_aids[$i] . "',";
			}
			$inaids = substr($ninaids, 0, strlen($ninaids) - 1);
		}

		if (!$inaids) {
			return array('imgattachs_unused' => '');
		}

		require_once libfile('function/attachment');
		$attachs = $imgattachs = array();
		$sqladd1 = $posttime > 0 ? "AND a.dateline>'$posttime'" : '';
		if ($showdir != 'all') {
			$sqladd1 .= " AND a.dir = '{$showdir}'";
		}

		$query = DB::query("SELECT a.*, af.description
		FROM " . DB::table('forum_attachment') . " a
		LEFT JOIN " . DB::table('forum_attachmentfield') . " af USING(aid)
		WHERE a.aid in($inaids) $sqladd1 ORDER BY a.aid ASC LIMIT {$limit}");
		if (!empty($_G['fid']) && $_G['forum']['attachextensions']) {
			$allowext = str_replace(' ', '', $_G['forum']['attachextensions']);
			$allowext = explode(',', $allowext);
		} else {
			$allowext = '';
		}
		/* 增加读取帖子附件时对附件服务器的判定 */
		require_once DISCUZ_ROOT . "./source/plugin/attachment_server/attachment_server.class.php";
		$attachment = new attachserver;
		$domain_all = $attachment->get_server_domain('all');
		/* 结束 */
		while ($attach = DB::fetch($query)) {
			if ($attach['dir'] != $showdir && $showdir != 'all') {
				continue;
			}
			$attach['filenametitle'] = $attach['filename'];
			$attach['ext'] = fileext($attach['filename']);
			if ($allowext && !in_array($attach['ext'], $allowext)) {
				continue;
			}
			$attach['filename'] = cutstr($attach['filename'], $_G['setting']['allowattachurl'] ? 25 : 30);
			$attach['attachsize'] = sizecount($attach['filesize']);
			$attach['dateline'] = dgmdate($attach['dateline']);
			$attach['filetype'] = attachtype($attach['ext'] . "\t" . $attach['filetype']);
			if ($attach['isimage'] < 1) {
				if ($attach['isimage']) {
					$attach['url'] = $attach['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl'];
					$attach['width'] = $attach['width'] > 300 ? 300 : $attach['width'];
				}
				if ($attach['pid']) {
					$attachs['used'][] = $attach;
				} else {
					$attachs['unused'][] = $attach;
				}
			} else {
				$attach['url'] = ($attach['remote'] ? $_G['setting']['ftp']['attachurl'] : ( $attach['serverid'] > 0 ? "http://" . $domain_all[$attach['serverid']] . "/" : $_G['setting']['attachurl'])) . '/forum';
				$attach['width'] = $attach['width'] > 300 ? 300 : $attach['width'];
				if ($attach['pid']) {
					$imgattachs['used'][] = $attach;
				} else {
					$imgattachs['unused'][] = $attach;
				}
			}
		}
		return array('imgattachs_unused' => $imgattachs['unused']);
	}


	function _removingPBR($message){
		$message=str_replace('align="center"', '', $message);
		$message = preg_replace('/回复(.*)<a href="http:\/\/www\.8264\.com\/forum\.php\?mod=redirect&goto=findpost&pid=(\d+)&ptid=(\d+)"(.*)>(.*)的帖子<\/a><br\/>/isU', '', $message);
		$message = preg_replace('/回复(.*)<a href="http:\/\/www\.8264\.com\/forum\.php\?mod=redirect&goto=findpost&pid=(\d+)&ptid=(\d+)"(.*)>(.*)的帖子<\/a>/isU', '', $message);
		$message = preg_replace('/<img(.*)src="http:\/\/static\.(8264|zaiwai)\.com\/static\/image\/smiley\/default\/(.*)\.gif"(.*)>/isU', '', $message);

		$message = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $message);//n个连续<br/>
		$message = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $message);//<p><br/></p>
		$message = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $message);//<p><br/>
		$message = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $message);//</p><br/>
		return $message;
	}

}

?>
