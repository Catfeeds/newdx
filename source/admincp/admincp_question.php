<?php

/**
 *      问答管理
 *      by lvshuo
 */
if (!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
	exit('Access Denied');
}
set_time_limit(0);
include_once libfile('function/discuzcode');
include_once libfile('function/readmodelTravel');
include_once libfile('function/question');
$operation = in_array($operation, array('addexportquestion','multiadd','editquestion','ajaxOpertionpid_daan','ajaxOpertion_daan_new','ajaxOpertionupuid','ajaxUpdatercontent','addquestion','newReply','operationlog')) ? $operation : 'questionlist';
cpheader();
showsubmenu('问题管理', array(
	array('问题列表', "question&operation=questionlist", $operation == 'questionlist'),
	array('导入帖子问题', "question&operation=addexportquestion", $operation == 'addexportquestion'),
	array('批量导入', "question&operation=multiadd", $operation == 'multiadd'),
	array('新增问题', "question&operation=addquestion", $operation == 'addquestion'),
	array('新回答内容管理', "question&operation=newReply", $operation == 'newReply'),
	array('pid隐藏记录', "question&operation=operationlog", $operation == 'operationlog')
));

if ($operation == 'questionlist') {

	if (submitcheck('questionsubmit')) {

		$perpage = intval($_G['gp_hiddenperpage']);
		$page = intval($_G['gp_hiddenpage']);

		$topicids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
		$url = "action=question&operation=questionlist&&perpage={$perpage}&page={$page}";

		if ($_G['gp_optype'] == 'trash' && $topicids) {

			//DB::delete('question_topic', "topicid in ({$topicids})");
			DB::update('question_topic', array('isshow'=>2), "topicid in ({$topicids})");		
			cpmsg('删除成功', $url, 'succeed');
		} elseif ($_G['gp_optype'] == 'show' && $topicids) {	
			DB::update('question_topic', array('isshow'=>1,'pubdateline'=>TIMESTAMP), "topicid in ({$topicids})");		
			cpmsg('上线成功', $url, 'succeed');
		} elseif ($_G['gp_optype'] == 'noshow' && $topicids) {	
			DB::update('question_topic', array('isshow'=>0), "topicid in ({$topicids})");		
			cpmsg('下线成功', $url, 'succeed');
		} else {
			cpmsg('article_choose_at_least_one_operation', $url, 'error');
		}
	} else {

		include_once libfile('function/portalcp');

		$mpurl = ADMINSCRIPT . '?action=question&operation=' . $operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page = max($_G['gp_page'], 1);
		$topicid 	 = empty($_G['gp_topicid']) ? 0 : intval($_G['gp_topicid']);
		$searchtid 	 = empty($_G['gp_searchtid']) ? 0 : intval($_G['gp_searchtid']);
		$selectadminmember 	 = $_G['gp_selectadminmember'];
		if (!in_array($perpage, array(10, 20, 50, 100)))
			$perpage = 50;

		$start = ($page - 1) * $perpage;
		$mpurl .= '&perpage=' . $perpage;
		if($selectadminmember){
			$mpurl .= '&selectadminmember=' . $selectadminmember;
		}
		
		$query = DB::query("SELECT a.uid,m.username FROM ".DB::table('common_admincp_member'). " AS a ". "LEFT JOIN " . DB::table("common_member") . " AS m ". "ON a.uid=m.uid " . getSlaveID());
		$adminmembers = array('admin');
		while($adminmember = DB::fetch($query)) {
			$adminmembers[] = $adminmember['username'];
		}
		
		$extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">问题ID&nbsp;&nbsp;';
		$extraStr .= '&nbsp;&nbsp;<form action="admin.php" method="GET" style="display:inline;" >';
		$extraStr .= '<input type="hidden" name="action" value="question"/>';
		$extraStr .= '<input type="hidden" name="operation" value="questionlist"/>';
		$extraStr .= '<input type="text" name="topicid" value="'.$topicid.'" style="height:20px;width:85px;" placeholder="填写问题ID" />&nbsp;&nbsp;';
		$extraStr .= '帖子ID&nbsp;&nbsp;<input type="text" name="searchtid" value="'.$searchtid.'" style="height:20px;width:85px;" placeholder="填写帖子ID" />&nbsp;&nbsp;';
		$extraStr .= '&nbsp;&nbsp;操作人<select id="selectadminmember" name="selectadminmember"><option value="">请选择操作人</option>';
		foreach ($adminmembers as $v) {
			$selectStr = $selectadminmember == $v ? 'selected=\"selected\"' : '';
			$extraStr .= "<option value=\"{$v}\" {$selectStr}>{$v}</option>";
		}
		$extraStr .= '</select>&nbsp;&nbsp;';
		$extraStr .= '<input type="submit" value="查询" style="cursor:pointer;" /></form></div>';
		echo $extraStr;

		showformheader('question&operation=questionlist');
		showtableheader();
		showsubtitle(array('','ID', '标题','操作人', '作者', '导入时间', '是否帖子导入', '操作'));

		$multipage = '';
		
		$selectadminmembercond ='';
		if ($topicid) {
			if($selectadminmember){
				$selectadminmembercond .= "AND opadmin= '{$selectadminmember}'";
			}
			if($searchtid){
				$selectadminmembercond .= "AND tid= '{$searchtid}'";
			}
			
			$sql = "SELECT * FROM " . DB::table('question_topic') . " WHERE topicid = {$topicid} AND isshow in (0,1) {$selectadminmembercond} " . getSlaveID();
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$status = $value[isshow] ? '上线' : '<span style="color:red;">下线</span>';
				showtablerow('', array('class="td25"','width="30"', 'width="480"', 'class="td28"'), array(
					"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[topicid]\">",
					"{$value[topicid]}",
					"<a href=\"http://www.8264.com/wenda/$value[topicid].html\" target=\"_blank\">[{$status}]{$value[title]}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"admin.php?action=question&operation=editquestion&topicid=$value[topicid]\" target=\"_blank\">[编辑]</a>",
					$value['opadmin'],
					$value['author'],
					date('Y-m-d H:i',$value['expdateline']),
					$value['tid'] > 0 ? '是  (tid:'.$value['tid'].')' : '否',
					"<a oldhref=\"http://www.8264.com/question.php?ctl=topic&act=exportquestion&tid=$value[tid]\"  href=\"admin.php?action=question&operation=editquestion&topicid=$value[topicid]\"  target=\"_blank\">编辑</a>"
				));
			}
			
		}else{
				if($selectadminmember){
					$selectadminmembercond .= "AND opadmin= '{$selectadminmember}'";
				}
				if($searchtid){
					$selectadminmembercond .= "AND tid= '{$searchtid}'";
				}
				$count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('question_topic') . " WHERE  isshow in (0,1) {$selectadminmembercond} " . getSlaveID());
				if ($count) {
					$sql = "SELECT * FROM " . DB::table('question_topic') . " WHERE isshow in (0,1) {$selectadminmembercond} order by expdateline desc,topicid desc LIMIT {$start},{$perpage} " . getSlaveID();
					$query = DB::query($sql);
					while ($value = DB::fetch($query)) {
						$status = $value[isshow] ? '上线' : '<span style="color:red;">下线</span>';
						showtablerow('', array('class="td25"','width="30"', 'width="480"', 'class="td28"'), array(
							"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[topicid]\">",
							"{$value[topicid]}",
							"<a href=\"http://www.8264.com/wenda/$value[topicid].html\" target=\"_blank\">[{$status}]{$value[title]}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"admin.php?action=question&operation=editquestion&topicid=$value[topicid]\" target=\"_blank\">[编辑]</a>",
							$value['opadmin'],
							$value['author'],
							date('Y-m-d H:i',$value['expdateline']),
							$value['tid'] > 0 ? '是  (tid:'.$value['tid'].')' : '否',
							"<a oldhref=\"http://www.8264.com/question.php?ctl=topic&act=exportquestion&tid=$value[tid]\"  href=\"admin.php?action=question&operation=editquestion&topicid=$value[topicid]\"  target=\"_blank\">编辑</a>"
						));
					}
					$multipage = multi($count, $perpage, $page, $mpurl);
				}
		
		}

		$optypehtml = ''
			. '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/><input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/><input type="radio" name="optype" id="optype_trash" value="trash" class="radio" /><label for="optype_trash">彻底删除</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="optype" id="optype_show" value="show" class="radio" /><label for="optype_show">上线</label>&nbsp;&nbsp;<input type="radio" name="optype" id="optype_noshow" value="noshow" class="radio" /><label for="optype_noshow">下线</label>&nbsp;&nbsp;';
		showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
		showtablefooter();
		showformfooter();
	}
} elseif($operation == 'multiadd') {	
	if(submitcheck('multiaddsubmit')) {		
		$perpage = intval($_G['gp_hiddenperpage']);
		$page    = intval($_G['gp_hiddenpage']);

		$tids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? $_G['gp_ids'] : "";		
		$url  = "action=question&operation=multiadd&&perpage={$perpage}&page={$page}";
		$opadmin= $_G['member']['username'];
		
		if ($_G['gp_optype'] == 'add' && $tids) {
			
			$url     = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "action=question&operation={$operation}";			
			foreach ($tids as $v) {
				$tid = intval($v);
				if (empty($tid)) {continue;}					
				$threadShow = DB::fetch_first("SELECT t.authorid, t.author, t.subject, t.tid FROM ".DB::table('forum_thread')." t where tid = {$tid} " . getSlaveID());				
				$questionOne = DB::fetch_first("SELECT topicid,isshow FROM " . DB::table('question_topic') . " where tid={$tid} AND isshow in (0,1) ORDER BY topicid DESC " . getSlaveID());
					
				if (empty($threadShow)) {continue;}
				if ($questionOne) {continue;}
				exportOneQuestion($tid,$opadmin);				
			    usleep(0.2*1000000);
			}
			
			cpmsg('批量导入成功', $url, 'succeed');
		} else {
			cpmsg('article_choose_at_least_one_operation', $url, 'error');
		}
	} else {;
		//获得问答的板块
		$fids    = getQuestionFids();
		$fid     = empty($_G['gp_fid']) ? 0 : intval($_G['gp_fid']);
		$serkeyword   = $_G['gp_serkeyword'];
		$isask  = $_G['gp_isask'];
		
		
		$mpurl   = ADMINSCRIPT.'?action=question&operation='.$operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page    = max($_G['gp_page'], 1);
		if(!in_array($perpage, array(10,20,50,100))) $perpage = 50;
		
		$start  = ($page-1) * $perpage;
		$mpurl .= '&perpage='.$perpage;		
		
		$extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">问答版&nbsp;&nbsp;<select id="selectFid"><option value="">请选择板块</option>';
		foreach ($fids as $k=>$v) {
			$selectStr = $fid == $k ? 'selected=\"selected\"' : '';
			$extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
		}
		$isaskStr= $isask> 0 ? 'checked=\"checked\"' : '';

		$extraStr .= '</select>&nbsp;&nbsp;';
		$extraStr .= '<label for="serkeyword">关键词</label>';
		$extraStr .= "<input type=\"input\" name=\"serkeyword\" id=\"serkeyword\" value=\"{$serkeyword}\" style=\"vertical-align:-1px;\"  />";
		$extraStr .= "&nbsp;&nbsp;<input type=\"button\" name=\"serbutton\" id=\"serbutton\" value=\"筛选\" class=\"btn\"  onclick=\"doSerch()\"  />";
		$extraStr .= "&nbsp;&nbsp;<input type=\"checkbox\" name=\"isask\" id=\"isask\" value=\"1\" style=\"vertical-align:-1px;\" {$isaskStr} /><label for=\"isask\">可能问答?</label> </div>";
		echo $extraStr;
		showformheader('question&operation=multiadd');
		showtableheader();		
		showsubtitle(array('', '文章标题', '作者', '发布时间', '回复数'));
		
		if ($fid) {
			$multipage = '';
			$where  = " t.fid={$fid} AND t.displayorder > -1 ";
			if($serkeyword){
			$where .= " AND  subject LIKE '%{$serkeyword}%' ";
			}
			if($isask){
			$where .= " AND  (";
			$where .= " (instr(`subject`, '？')>0 )";
			$where .= " OR (instr(`subject`,  '?')>0 )";
			$where .= " OR (instr(`subject`,  '怎样')>0 )";
			$where .= " OR (instr(`subject`,  '怎么')>0 )";
			$where .= " OR (instr(`subject`,  '如何')>0 )";
			$where .= " OR (instr(`subject`,  '哪些')>0 )";
			$where .= " OR (instr(`subject`,  '为什么')>0 )";
			$where .= " OR (instr(`subject`,  '经验')>0 )";
			$where .= " OR (instr(`subject`,  '技巧')>0 )";
			$where .= " OR (instr(`subject`,  '知识')>0 )";
			$where .= " OR (instr(`subject`,  '使用的')>0 )";
			$where .= " OR (instr(`subject`,  '方法')>0 )";
			$where .= " )";
			}
			$count  = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('forum_thread')." t WHERE {$where} " . getSlaveID());
			if($count) {
				$sql   = "SELECT tid, subject, author, authorid, dateline, replies, readmodel FROM ".DB::table('forum_thread')." t WHERE {$where} ORDER BY t.replies desc LIMIT {$start},{$perpage} " . getSlaveID();
				$query = DB::query($sql);
				while ($v = DB::fetch($query)) {
	
					$v[subject]=str_replace('？', '<font style="color:red;">？</font>', $v[subject]);
					$v[subject]=str_replace('?', '<font style="color:red;">?</font>', $v[subject]);
					$v[subject]=str_replace('怎样', '<font style="color:red;">怎样</font>', $v[subject]);
					$v[subject]=str_replace('怎么', '<font style="color:red;">怎么</font>', $v[subject]);
					$v[subject]=str_replace('如何', '<font style="color:red;">如何</font>', $v[subject]);
					$v[subject]=str_replace('哪些', '<font style="color:red;">哪些</font>', $v[subject]);
					$v[subject]=str_replace('为什么', '<font style="color:red;">为什么</font>', $v[subject]);
					$v[subject]=str_replace('经验', '<font style="color:red;">经验</font>', $v[subject]);
					$v[subject]=str_replace('技巧', '<font style="color:red;">技巧</font>', $v[subject]);
					$v[subject]=str_replace('知识', '<font style="color:red;">知识</font>', $v[subject]);
					$v[subject]=str_replace('使用的', '<font style="color:red;">使用的</font>', $v[subject]);
					$v[subject]=str_replace('方法', '<font style="color:red;">方法</font>', $v[subject]);
							
					$questionOne = DB::fetch_first("SELECT topicid,isshow FROM " . DB::table('question_topic') . " where tid={$v[tid]} ORDER BY topicid DESC " . getSlaveID());
					if ($questionOne) {
						if($questionOne['isshow'] == 1){
							$status = '<span style="color:red;">问答版上线</span>';
						}elseif($questionOne['isshow'] == 2) {
							$status = '<span style="color:red;">问答版删除</span>';
						}else{
							$status = '<span style="color:red;">问答版下线</span>';
						}
						
						showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
							"&nbsp;",
							"<a href=\"forum.php?mod=viewthread&tid=$v[tid]\" target=\"_blank\">[{$status}]{$v[subject]}</a>",
							"<a href=\"home.php?mod=space&uid=$v[authorid]\" target=\"_blank\">$v[author]</a>",
							date("Y-m-d H:i:s", $v['dateline']),
							"<span>$v[replies]</span>"
						));	
					} else {
						showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
							"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$v[tid]\">",
							"<a href=\"forum.php?mod=viewthread&tid=$v[tid]\" target=\"_blank\">{$v[subject]}</a>",
							"<a href=\"home.php?mod=space&uid=$v[authorid]\" target=\"_blank\">$v[author]</a>",
							date("Y-m-d H:i:s", $v['dateline']),
							"<span>$v[replies]</span>"
						));
					}
				}				
				$multipage = multi($count, $perpage, $page, "{$mpurl}&fid={$fid}&serkeyword={$serkeyword}&isask={$isask}");
			}
	
			$optypehtml = ''
				.'<input type="hidden" name="hiddenpage" id="hiddenpage" value="'.$page.'"/><input type="hidden" name="hiddenperpage" id="hiddenperpage" value="'.$perpage.'"/><input type="radio" name="optype" id="optype_add" value="add" class="radio" /><label for="optype_add">批量问答版</label>&nbsp;&nbsp;';
			showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;'.$optypehtml.'<input type="submit" class="btn" name="multiaddsubmit" value="'.cplang('submit').'" />', $multipage);	
		}
		
		showtablefooter();
		showformfooter();	
		echo <<<READMODEL
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
function doSerch(){
	 var fid = jQuery('#selectFid').val();
	 if(fid){
	 	 var serkeyword =jQuery.trim(jQuery('#serkeyword').val());
		 var isaskchecked=$('#isask').is(':checked');
		 var isask = isaskchecked? 1:0;
		 location.href = 'http://'+'$_SERVER[HTTP_HOST]'+'/'+'$mpurl'+'&fid='+fid+'&serkeyword='+serkeyword+'&isask='+isask;	
	 }else{
	    alert('请选择板块');
		return false;
     }
   }		
		
</script>
READMODEL;
	}	
		
} elseif ($operation == 'addexportquestion') {

	if (submitcheck('quessubmit')) {
		$tid = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
		if ($tid) {
				
			$threadShow = DB::fetch_first("SELECT t.authorid, t.author, t.subject, t.tid FROM ".DB::table('forum_thread')." t where tid = {$tid} " . getSlaveID());				
			if(empty($threadShow)) {
				cpmsg('输入的tid(' . $tid . ')非法 ', 'action=question&operation=addexportquestion', 'error');
				die;	
			}
			$questionOne = DB::fetch_first("SELECT topicid,isshow FROM " . DB::table('question_topic') . " where tid={$tid} AND isshow in (0,1) ORDER BY topicid DESC " . getSlaveID());
			if ($questionOne) {
				cpmsg('发布失败,帖子ID已存在', 'action=question&operation=addexportquestion', 'error');
				die;
				
			}
			$opadmin= $_G['member']['username'];
			exportOneQuestion($tid,$opadmin);	
			
			cpmsg('发布成功', 'action=question&operation=questionlist', 'succeed');
		} else {
			cpmsg('请输入帖子ID', 'action=question&operation=addexportquestion', 'error');
		}
	} else {
		$adminscript = ADMINSCRIPT;
		$random = random(4);
		$formhash = FORMHASH;
		$tid = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
		$questionShow = array();
		$picstr = '';
		$picnum = 0;
		if ($tid) {
			$questionShow = DB::fetch_first("SELECT * FROM " . DB::table('question_topic') . " where tid={$tid}" . getSlaveID());
			if ($questionShow) {
				
			}
		}


		showformheader("question&operation={$operation}");
		echo <<<ZBLUNBO
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/equipmentstyle.css?admin" />
<style>
.pubDt50 th {vertical-align:middle;width:100px;text-align:center;}

</style>


<div style="margin-top:8px;">
	<table cellspacing="3" cellpadding="3">
		<tr class="pubDt50">
			<th>帖子ID</th><td><input type="text" name="tid" class="inputText" value="{$questionShow['tid']}" /><input type="hidden" name="tidold" value="{$questionShow['tid']}" /></td>
		</tr>
		
		
				
		
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td>
				<input type="hidden" name="quessubmit" value="true" />
				<input type="hidden" name="formhash" id="formhash" value="{$formhash}" />
				<input type="submit" value=" " class="publish182x43_1" />
			</td>
		</tr>
	</table>
</div>
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>

ZBLUNBO;
		showformfooter();
	}
} elseif($operation == 'editquestion') {
	
	if(submitcheck('questionsubmit')) {
		$topicid 		=  intval($_G['gp_topicid']);
		if ($topicid) {
			
			$questionShowOld = DB::fetch_first("SELECT * FROM ".DB::table('question_topic')." where topicid ={$topicid}" . getSlaveID());
			
			$pic1_attachid   = !empty($_G['gp_imgselect'][0]) ? intval($_G['gp_imgselect'][0]) : 0;
			$pic2_attachid   = !empty($_G['gp_imgselect'][1]) ? intval($_G['gp_imgselect'][1]) : 0;
			$pic3_attachid   = !empty($_G['gp_imgselect'][2]) ? intval($_G['gp_imgselect'][2]) : 0;
			$pic4_attachid   = !empty($_G['gp_imgselect'][3]) ? intval($_G['gp_imgselect'][3]) : 0;
			
			$data = array();
			$data['pic1'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic1_attachid} " . getSlaveID());
			$data['pic2'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic2_attachid} " . getSlaveID());
			$data['pic3'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic3_attachid} " . getSlaveID());
			$data['pic4'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic4_attachid} " . getSlaveID());
			$data['pic1_attachid'] = $pic1_attachid;
			$data['pic2_attachid'] = $pic2_attachid;
			$data['pic3_attachid'] = $pic3_attachid;
			$data['pic4_attachid'] = $pic4_attachid;
			
			$data['title'] 	=  trim($_G['gp_title']);
			$lable = '';
//			if ($_G['gp_label']) {
//				$labels = str_replace("，", ",", $_G['gp_label']);
//				$labels_arr = explode(",", $labels);
//				$count = count($labels_arr);
//				for ($i = 0; $i < $count; $i++) {
//					$lable_value = trim($labels_arr[$i]);
//					if ($lable_value) {
//						$lablesql = "SELECT * FROM " . DB::table("question_lable") . " WHERE lable_value = '{$lable_value}' " . getSlaveID();
//						$lable_arr = DB::fetch_first($lablesql);
//						if (!$lable_arr) {
//							DB::insert('question_lable', array('lable_value' => $lable_value));
//							$lable_arr['lable_id'] = DB::insert_id();
//						}
//						$lable .=$lable_arr['lable_id'] . ',';
//					}
//				}
//				$lable = substr($lable, 0, strlen($lable) - 1);
//			}
			$j = 0;
			for ($i = 1; $i < 4; $i++) {
				$labeltemp =$_G['gp_label'.$i];
				if($labeltemp){
					$lable .= $labeltemp. ',';
					$j++;
				}
			}
			$lable =$j>0? substr($lable, 0, strlen($lable) - 1):$lable;
			if($lable){
				$data['lable'] = $lable;
			}
			$data['content'] 	=  trim($_G['gp_content']);
			$data['notindex'] = trim($_G['gp_notindex']);
			
			
			if ($questionShowOld) {	
				DB::update('question_topic', $data, "topicid={$topicid}");
				cpmsg('修改成功', "action=question&operation=editquestion&topicid={$topicid}", 'succeed');	
			} else {
				cpmsg('操作失败,topicid非法', 'action=question&operation=questionlist', 'error');	
				die;	
			}				
		}			
	} else {
		$select_lables =getQuestionLables();
		$select_lables_str='';
		foreach ($select_lables as $k=>$v) {
			$select_lables_str .= "<option value=\"{$k}\" >{$v}</option>";
		}
		
		$adminscript = ADMINSCRIPT;
		$random      = random(4);
		$formhash    = FORMHASH;
		$topicid 		 =intval($_G['gp_topicid']);
		if(!$topicid){
			cpmsg('topicid不能为空', 'action=question&operation=questionlist', 'error');
			die;
		}
		$questionShow = array();
		$picstr		 = '';
		$picnum  	 = 0;

		$questionShow = DB::fetch_first("SELECT * FROM " . DB::table('question_topic') . " where topicid={$topicid}" . getSlaveID());	
		if ($questionShow) {
			$questionShow['showlable'] = '';
			$questionShow['showlableid'] = array();
			if ($questionShow['lable']) {
					$questionShow['lable_forsql'] = trim($questionShow['lable'],',');
					$lable_array =explode(',', $questionShow['lable_forsql']);
					foreach ($lable_array as $lableidtemp){
						$showlable_query = DB::fetch_first("SELECT lable_id,lable_value FROM " . DB::table('question_lable') . " WHERE lable_id =({$lableidtemp})" . getSlaveID());
					    $questionShow['showlableid'][]=$showlable_query['lable_id'];
					    $questionShow['showlable'] .='<span class="autowidthspan"><strong class="place-name"><a>'.$showlable_query[lable_value].'</a></strong></span>&nbsp;';
					}
				
			}
			
			for($i=1;$i<=4;$i++){
				if ($questionShow['pic'.$i]) {			
					$questionShow['pic'.$i] = getimagethumb(60,60,2,'plugin/'.$questionShow['pic'.$i], 0, 99);
					$picstr .= '<span id="imagelist_id_'.$questionShow['pic'.$i.'_attachid'].'">';
					$picstr .= '<img src="'.$questionShow['pic'.$i].'" />';
					$picstr .= '<b class="deleteimg">删除</b>';
					$picstr .= '<input type="hidden" value="'.$questionShow['pic'.$i.'_attachid'].'" name="imgselect[]">';
					$picstr .= '</span>';
					$picnum++;
				}
			}
			
			
			if($questionShow['content']==''){
				$wentisql = "SELECT t.fid, t.typeid,tc.name,p.* FROM " . DB::table("forum_thread") . " AS t "
				. "LEFT JOIN " . DB::table("forum_post") . " AS p "
				. "ON t.tid=p.tid "
				. "LEFT JOIN " . DB::table("forum_threadclass") . " AS tc "
				. "ON t.typeid=tc.typeid "
				. " WHERE t.tid = '{$questionShow[tid]}' AND p.first='1' AND t.displayorder >= 0 AND p.invisible = '0' " . getSlaveID();

			    $wenti = DB::fetch_first($wentisql);
			    $wenti['message'] = questionmodelMessage($wenti['message']);
			    $wenti['message'] = htmlspecialchars_decode($wenti['message']);
				$wenti['message'] = removingPBR($wenti['message']);
				$wenti['message'] = preg_replace("/<img.*\/>/i", '', $wenti['message']);
				$wenti['message']=str_replace('&nbsp;', '', $wenti['message']);
				$qian=array(" ","　","\t","\n","\r");
				$hou=array("","","","","");
				$wenti['message'] =str_replace($qian,$hou,$wenti['message']); 
				$wenti['message'] = strip_tags($wenti['message'], "<table><tbody><tr><th><td><span><script>");
				$questionShow['content'] = $wenti['message'];
			}
			$questionShow['tidtrisshow'] = $questionShow['tid']>0?'':'style="display:none;"';
			
		}else{
			cpmsg('topicid非法', 'action=question&operation=questionlist', 'error');
			die;
		}

		
		/*编辑框*/
		showformheader("question&operation={$operation}");		
		echo <<<ZBLUNBO
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/equipmentstyle.css?admin" />
<style>
.pubDt50 {
    float: left;
    margin-bottom: 1px;
    width: 100%;
}
.pubDt50 .inputText {padding:2px;font-size:12px;}
.pubDt50 th {vertical-align:middle;width:100px;text-align:center;}
.place-multiLine {display: none;margin-bottom: 15px;margin-top: 3px;overflow: hidden;}
.place-component-block {background-color: #e1eaef;border-radius: 2px;cursor: pointer;height: 30px;line-height: 30px;margin-right: 8px;padding: 0 12px;}
.place-component-block .place-name {color: #31586e;font-weight: 400;}
.autowidthspan {min-width:50px;width:auto;background-color: #e1eaef;border-radius: 2px;cursor: pointer;height: 30px;line-height: 30px;padding: 5px 12px;}

</style>


<div style="margin-top:8px;">
	<table cellspacing="3" cellpadding="3">
		<tr class="pubDt50" {$questionShow['tidtrisshow']}>
			<th>帖子ID</th><td><input type="text" id="tid" name="tid" class="inputText" value="{$questionShow['tid']}" readonly /> <input type="hidden" name="topicid" value="{$questionShow['topicid']}" /></td><td><div class="place-component-block"><strong class="place-name"><a href="http://bbs.8264.com/thread-{$questionShow['tid']}-1-1.html" target="_blank">打开原帖子页面</a></strong></div></td>
		</tr>
		<tr class="pubDt50">
			<th>标题</th><td>
			   <input type="text" name="title" id="title" class="inputText" value="{$questionShow['title']}" style="width:500px;" /></td>
		</tr>
			<tr class="pubDt50">
			<th>禁止首页显示</th>
			<td>
				<input type="radio" name="notindex" id="notindex_yes" value="1" class="radio" 
ZBLUNBO;
				if($questionShow['notindex'] == '1'){ echo "checked"; }
				echo <<<ZBLUNBO
   /><label for="optype_show">是</label>&nbsp;&nbsp;
				<input type="radio" name="notindex" id="notindex_no" value="0" class="radio" 
ZBLUNBO;
				if($questionShow['notindex'] == '0'){ echo "checked"; }
				echo <<<ZBLUNBO
   /><label for="optype_show">否</label>&nbsp;&nbsp;
			</td>
		</tr>
		<tr class="pubDt50">
			<th>标签</th><td colspan="2">
				{$questionShow['showlable']} &nbsp;<br/>
				修改标签：<select name='label1' id='label1'>
				<option value="">请选择分类</option>
				{$select_lables_str}
				</select>&nbsp;
				<select name='label2' id='label2'>
				<option value="">请选择分类</option>
				{$select_lables_str}
				</select>&nbsp;
				<select name='label3' id='label3'>
				<option value="">请选择分类</option>
				{$select_lables_str}
				</select>
				</td>
		</tr>		
		<tr class="pubDt50">
			<th>内容描述</th><td colspan="2">
				<textarea rows="3" cols="200" id="content" name="content" class="inputText" style="width:600px;min-height:80px;">{$questionShow['content']}</textarea></td>
		</tr>
		<tr class="pubDt50">
			<th>内容配图</th>
			<td colspan="2">
				<input id="numimage" type="hidden" name="uploadfile" value="{$picnum}"/>
				<div id="pic_upload_multiimg">
					此内容需要 Adobe Flash Player 11.1.0 或更高版本
					<script type="text/javascript">
						var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
						document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
					</script>
				</div>				
			</td>
		</tr>
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td colspan="2">	
				最多上传4张，只保存前4张
				<div id="imglist" class="readyPic">{$picstr}</div>
			</td>
		</tr>
		
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td colspan="2">
				<input type="hidden" name="questionsubmit" value="true" />
				<input type="hidden" name="formhash" id="formhash" value="{$formhash}" />
				<input type="submit" value="" class="publish182x43_1" />
			</td>
		</tr>
	</table>
</div>
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="static/js/newswfobject.js"></script>
<script type="text/javascript">
	var params = {site:"{$_G[siteroot]}misc.php%3fmod=swfupload%26type=image%26fid=0%26mtype=plugin%26twidth=60%26theight=60%26back=uploadsuccess_back%26random={$random}",buttonimg:"{$_G[siteroot]}static/image/common/uploadnew.png"};
	swfobject.embedSWF("static/flash/uploadforum.swf", "pic_upload_multiimg", "208", "50", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
	swfobject.createCSS("#pic_upload_multiimg", "text-align:left;");
</script>
<script>
var maxpic = 4;
function uploadsuccess_back(type, returndata) {
	eval("var nattach = " + returndata + ";");
	jQuery.noConflict();
	;(function(jQuery){
		switch(type){
			case 1:
			case 2:
				var html = '';
				html 	+= '<span id="imagelist_id_'+nattach.aid+'">';
				html 	+= '<img src="' + nattach.thumbpic + '" />';
				html 	+= '<b class="deleteimg">删除</b>';
				html 	+= '<input type="hidden" value="'+nattach.aid+'" name="imgselect[]">';
				html 	+= '</span>';

				jQuery("#imglist").append(html);
				var attachobj = jQuery('#imagelist_id_' + nattach.aid);
				attachobj.find('input').removeAttr('disabled').end().show();

				attachobj.find('img').one('error', function(){
					jQuery(this).attr('src', ' ');
					jQuery(this).attr('src', nattach.thumbpic);
				}).show();
				break;
			case 3:
				break;
		}
		jQuery('#imglist').find('span:gt(' + (maxpic - 1) + ')').addClass("overlimit").find('input').attr('disabled', true);
		//算下上传图片数
		jQuery("#numimage").attr("value", jQuery('#imglist').find("span:not('.overlimit')").length);
	})(jQuery);
}
jQuery(function(){
	jQuery(document).on("click", "#imglist .deleteimg", function() {
		jQuery(this).parent().remove();
		if(jQuery("#imglist .overlimit").length > 0){
			jQuery("#imglist .overlimit:first").removeClass('overlimit').find('input:hidden').removeAttr('disabled');
		}else{
			jQuery("#numimage").val(jQuery("#numimage").val() - 1);
		}
	});
});
	
	jQuery(function(){
	    jQuery("#label1").val({$questionShow['showlableid'][0]});
	    jQuery("#label2").val({$questionShow['showlableid'][1]});
	    jQuery("#label3").val({$questionShow['showlableid'][2]});
	});
</script>
ZBLUNBO;
showformfooter();
/*编辑框 end*/
	echo '<input type="hidden" id="nomore" value="0" />';
	showformheader();
	showtableheader($questionShow['title']);
	
	showsubtitle(array('序号', '作者', '内容', '发布时间', '操作'));
	
	
	//答案list遍历开始
	
	$replysql = "SELECT  * FROM " . DB::table("question_reply") . " WHERE ( (rcontent!='' AND tid= '0' AND ishidden= '0') OR ( tid > 0 AND tiddata NOT IN ('','[]')) ) AND ref_topicid = '{$topicid}' ORDER BY isup DESC,dateline DESC " . getSlaveID();
		$query = DB::query($replysql);

		$list = array();
		$index = 1;
		while ($row = DB::fetch($query)) {
			$rcontentStr = '';
			if($row['tid']>0){
				$row['tiddata'] =json_decode($row['tiddata'], true);
				for($i=0;$i<count($row['tiddata']);$i++){
					$postOne =DB::fetch_first("SELECT pid,message FROM " . DB::table('forum_post') . " where pid={$row['tiddata'][$i]} " . getSlaveID());
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
		
					$postOne['message'] = questionmodelMessage($postOne['message']);
					$postOne['message'] = htmlspecialchars_decode($postOne['message']);
					$postOne['message'] = removingPBR($postOne['message']);
					//过滤开头<br/>
					$tmp = strpos($postOne['message'], '<br/>');
					if($tmp<=2&&$tmp!==false){
						$postOne['message'] = substr($postOne['message'],6); 
					}
					$tmp = strpos($postOne['message'], '>');
					if($tmp<=0&&$tmp!==false){
						$postOne['message'] = substr($postOne['message'],1); 
					}
					$rcontentStr .=  "<div class=\"onedaandiv\"><div><span><a>#$postOne[pid]</a></span><a id=\"ycbigbutton$postOne[pid]\" style=\"float:right;\" onclick=\"doYcbigbutton('$postOne[pid]', 'hidden','$row[authorid]','1')\" href=\"javascript:void(0)\">隐藏</a></div><div style=\"display:block;\">$postOne[message]</div></div>";
				}
				
				$row['daannum'] = count($row['tiddata']);

			}else{
				$row['rcontent_old'] = $row['rcontent'];
				$row['rcontent'] = discuzcode($row['rcontent']);
				$row['rcontent'] = thumb_all_pic(800, 0, $row['rcontent']);
				$row['rcontent'] = removingPBR($row['rcontent']);
				//过滤开头<br/>
				$tmp = strpos($row['rcontent'], '<br/>');
				if($tmp<=2&&$tmp!==false){
					$row['rcontent'] = substr($row['rcontent'],6); 
				}
				$tmp = strpos($row['rcontent'], '>');
				if($tmp<=0&&$tmp!==false){
					$row['rcontent'] = substr($row['rcontent'],1); 
				}
				$rcontentStr =  "<div class=\"onedaandiv\"><div><span><a>#新回答$row[replyid]</a></span><a id=\"ycbigbuttonNew$row[replyid]\" style=\"float:right;\" onclick=\"doYcbigbuttonNew('$row[replyid]', 'hidden','$row[authorid]')\" href=\"javascript:void(0)\">隐藏</a><a style=\"float:right; padding-right:30px;\" onclick=\"baocunupdate('$row[replyid]')\"  href=\"javascript:void(0)\">保存修改</a></div><div style=\"display:block;\"><textarea class=\"inputText\" style=\"width:100%;min-height:80px;\" id=\"textarea_danan_$row[replyid]\">$row[rcontent_old]</textarea></div></div>";
				$row['daannum'] = 1;
			}
			
			$zhidingStr=$row['isup']==1?"[<a id=\"zhiding_a_$row[replyid]\" class=\"zhiding_a\" onclick=\"doZhiding('$row[replyid]','$row[authorid]')\" href=\"javascript:void(0)\">已置顶</a>]":"[<a id=\"zhiding_a_$row[replyid]\" class=\"zhiding_a\" onclick=\"doZhiding('$row[replyid]','$row[authorid]')\" href=\"javascript:void(0)\">置顶</a>]";
			$zhidingStr_hou=$row['isup']==1?"[<a id=\"zhiding_a_hou_$row[replyid]\" class=\"zhiding_a\" onclick=\"doZhiding('$row[replyid]','$row[authorid]')\" href=\"javascript:void(0)\">已置顶</a>]":"[<a id=\"zhiding_a_hou_$row[replyid]\" class=\"zhiding_a\" onclick=\"doZhiding('$row[replyid]','$row[authorid]')\" href=\"javascript:void(0)\">置顶</a>]";
			
			//$list[] = $row;
			
			showtablerow('', array('width="5%"',  'width="100" style="white-space:nowrap;"','width="70%" style="font-size:14px;"', 'class="td28"', 'style="white-space:nowrap;"'), array(
				$index.$zhidingStr,
				"<a id='authorid{$row[authorid]}' daannum='{$row['daannum']}'>{$row[author]}</a>",
				"{$rcontentStr}",
				date("Y-m-d H:i:s", $row['dateline']),
				$zhidingStr_hou
			));
			$index++;
		}
		//var_dump($list);
	
	
	
	
	
	
	
	
	//答案list遍历结束
	

	
	
	showtablefooter();
	showformfooter();
	
	echo <<<READMODEL
<style>
	#cpform img {max-width:100px;max-height:100px; margin-bottom:5px;display:block;border:0;}
	#cpform img {height: expression(this.width > 100 ? this.height = this.height * 100 / this.width : "auto");width: expression(this.width > 100 ? "100px" : "auto");max-width:100px;}
	#cpform a {color:#2366a8;}	
	#zoom{position:absolute;border:none;background:#333;padding:0px;display:none;color:#fff;}
	#zoom img {max-width:400px;max-height:400px; }
	#zoom img {height: expression(this.width > 400 ? this.height = this.height * 400 / this.width : "auto");width: expression(this.width > 400 ? "400px" : "auto");max-width:400px;}
	.onedaandiv:hover{background-color:#abd7ff;display:block;border:0;}
</style>
<script type="text/javascript" src="static/js/jquery.scrollExtend.js"></script>
<script src="http://static.8264.com/static/js/jquery.lazyload.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function (){
    //图片延时加载
    $(".lazy").lazyload({
    	effect:"fadeIn",
    	appear: function(){
		}
    }); 
    
    //内容展开收起
    $('#cpcontainer').delegate('.j-rw-toggleDown', 'click', function(){
		var obj = $(this).prev();
		var btn = $(this);
	    obj.animate({ 
			height: "100%"
		}, 1000 ,function(){	
			setTimeout(function(){
				if (obj.height() <= 50) {
					btn.remove();
				}
			}, 200);
		});
		btn.addClass('j-rw-toggleUp').removeClass('j-rw-toggleDown');
		btn.html('').html('收起');		
	});
	$('#cpcontainer').delegate('.j-rw-toggleUp', 'click', function(){
	    $(this).prev().animate({
			height: "50px"
		}, 1000 );
		$(this).addClass('j-rw-toggleDown').removeClass('j-rw-toggleUp');
		$(this).html('').html('展开');
	});
});
	
	
	function doYcbigbutton(pid, tooperation,uid,js_message='') {
		jQuery.get("{$adminscript}?action=question&operation=ajaxOpertionpid_daan&topicid=" + {$topicid} + "&pid=" + pid + "&tooperation=" + tooperation+ "&uid=" + uid+ "&js_message=" + js_message, function(data) {
			var dealstr = data.match(/<data class="jsonHtml">([\s\S]*)<\/data>/g);
			dealstr     = String(dealstr);
			dealstr     = dealstr.replace('<data class="jsonHtml">', '').replace('</data>', '');		
			if (dealstr == '10') {
				jQuery("#ycbigbutton"+pid).parent().parent().remove();
				daannum = parseInt(jQuery("#authorid"+uid).attr('daannum'));
		        daannum  = daannum -1;
				jQuery("#authorid"+uid).attr('daannum',daannum);
				if(daannum==0){
					jQuery("#authorid"+uid).parent().parent().remove();
				}
	
			}
		});
	}
		
		
	function doYcbigbuttonNew(replyid, tooperation,uid) {
		jQuery.get("{$adminscript}?action=question&operation=ajaxOpertion_daan_new&topicid=" + {$topicid}+"&replyid=" + replyid + "&tooperation=" + tooperation+ "&uid=" + uid, function(data) {
			var dealstr = data.match(/<data class="jsonHtml">([\s\S]*)<\/data>/g);
			dealstr     = String(dealstr);
			dealstr     = dealstr.replace('<data class="jsonHtml">', '').replace('</data>', '');		
			if (dealstr == '10') {
				daannum = parseInt(jQuery("#authorid"+uid).attr('daannum'));
		        daannum  = daannum -1;
				jQuery("#authorid"+uid).attr('daannum',daannum);
				if(daannum==0){
					jQuery("#authorid"+uid).parent().parent().remove();
				}
	
			}
		});
	}
		
	//答案置顶
	function doZhiding(upreplyid,upuid) {
		jQuery.get("{$adminscript}?action=question&operation=ajaxOpertionupuid&topicid=" + {$topicid} + "&upreplyid=" + upreplyid+ "&upuid=" + upuid, function(data) {
			var dealstr = data.match(/<data class="jsonHtml">([\s\S]*)<\/data>/g);
			dealstr     = String(dealstr);
			dealstr     = dealstr.replace('<data class="jsonHtml">', '').replace('</data>', '');		
			if (dealstr == '11') {
				jQuery("#cpcontainer").find(".zhiding_a").text("置顶");
				jQuery("#zhiding_a_"+upreplyid).text("已置顶");
				jQuery("#zhiding_a_hou_"+upreplyid).text("已置顶");		
			}else if (dealstr == '10'){
				return false;
			}
		});
	}
		
	//修改答案
	function baocunupdate(replyid) {
		var rcontent= jQuery.trim(jQuery("#textarea_danan_"+replyid).val());
		if(rcontent==''){
		   alert('答案内容不能为空！');
		   return false;
		}
		jQuery.post("{$adminscript}?action=question&operation=ajaxUpdatercontent&replyid=" + replyid,{rcontent:rcontent},function(data) {
				var dealstr = data.match(/<data class="jsonHtml">([\s\S]*)<\/data>/g);
				dealstr     = String(dealstr);
				dealstr     = dealstr.replace('<data class="jsonHtml">', '').replace('</data>', '');	
				if (dealstr == '1') {
					alert('修改成功！');
				}else if (dealstr == '-1'){
					return false;
				}
		});
		
}
</script>

<script type="text/javascript">
	this.imageZoom = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 30;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	jQuery("img.zoom").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		jQuery("body").append("<div id='zoom'><img src='"+ this.src +"' alt='Image zoom' />"+ c +"</div>");								 
		jQuery("#zoom")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		jQuery("#zoom").remove();
    });	
	jQuery("img.zoom").mousemove(function(e){
		jQuery("#zoom")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


// starting the script on page load
jQuery(document).ready(function(){
	imageZoom();
});
</script>
READMODEL;
	}
		
}elseif($operation == 'ajaxOpertionpid_daan') {
	
	$topicid = intval($_GET['topicid']);
	$pid = intval($_GET['pid']);
	$tooperation = trim($_GET['tooperation']);
	$uid = intval($_GET['uid']);
	$js_message = intval($_GET['js_message']);

	$questionShow = DB::fetch_first("SELECT topicid,tid,replynum, showpid,upuid FROM " . DB::table('question_topic') . " where topicid={$topicid}" . getSlaveID());
	if ($questionShow) {

		if ($questionShow['showpid']) {
			$questionShow['showpid'] = json_decode($questionShow['showpid'], true);
			if ($tooperation == 'show') {
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


						echo '<data class="jsonHtml">11</data>';
						exit();
					}
				}
			} elseif ($tooperation == 'hidden') {
				//if (in_array($pid, $questionShow['showpid'])) {
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
						
						//记录论坛隐藏pid开始
						if($js_message){					
							$postOne =DB::fetch_first("SELECT pid,message FROM " . DB::table('forum_post') . " where pid={$pid} " . getSlaveID());
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

							$postOne['message'] = questionmodelMessage($postOne['message']);
							$postOne['message'] = htmlspecialchars_decode($postOne['message']);
							$postOne['message'] = removingPBR($postOne['message']);
							//过滤开头<br/>
							$tmp = strpos($postOne['message'], '<br/>');
							if($tmp<=2&&$tmp!==false){
								$postOne['message'] = substr($postOne['message'],6); 
							}
							$tmp = strpos($postOne['message'], '>');
							if($tmp<=0&&$tmp!==false){
								$postOne['message'] = substr($postOne['message'],1); 
							}
							
							DB::insert('question_operation_log', array('topicid'=>$topicid,'replyid'=>$replyOne['replyid'],'pid'=>$pid,'message'=>daddslashes($postOne['message']),'type'=>'hiddenpid','dateline'=>TIMESTAMP,'opadmin'=>$_G['member']['username']));
						}
						//记录论坛隐藏pid结束
						
						echo '<data class="jsonHtml">10</data>';
						exit();
					}
				//}
			}
		} else {
			if ($tooperation == 'show') {
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

					echo '<data class="jsonHtml">11</data>';
					exit();
				}
			}
		}
	} else {
		echo '<data class="jsonHtml">-1</data>';
		exit();
	}
}elseif($operation == 'ajaxOpertion_daan_new') {
	$topicid = intval($_GET['topicid']);
	$replyid = intval($_GET['replyid']);
	$tooperation = trim($_GET['tooperation']);
	$uid = intval($_GET['uid']);
	$questionShow = DB::fetch_first("SELECT topicid,replynum FROM " . DB::table('question_topic') . " where topicid={$topicid}" . getSlaveID());
	$replyOne =DB::fetch_first("SELECT replyid FROM " . DB::table('question_reply') . " where replyid ='{$replyid}' and authorid = {$uid} and ishidden = '0' " . getSlaveID());
	if($questionShow&&$replyOne&&$tooperation=='hidden'){
		DB::update('question_reply', array('ishidden'=>1), "replyid={$replyid}");
		DB::update('question_topic', array('replynum'=>intval($questionShow['replynum'])- 1), "topicid={$topicid}");
		echo '<data class="jsonHtml">10</data>';
		exit();
	}
						
}elseif($operation == 'ajaxOpertionupuid') {
	$topicid = intval($_GET['topicid']);
	$upreplyid= intval($_GET['upreplyid']);
	$upuid = intval($_GET['upuid']);

	$questionShow = DB::fetch_first("SELECT topicid,upuid,upreplyid FROM " . DB::table('question_topic') . " where topicid={$topicid}" . getSlaveID());
	if ($questionShow&&$topicid&&$upreplyid&&$upuid) {
		if($questionShow['upreplyid'] ==$upreplyid){
			echo '<data class="jsonHtml">10</data>';
			exit();
		}else{
			$data = array();
			$data['upuid'] = $upuid;
			$data['upreplyid'] = $upreplyid;
			if (DB::update('question_topic', $data, "topicid={$topicid}")) {
				DB::update('question_reply', array('isup'=>1), "replyid={$upreplyid}");
				if($questionShow['upreplyid']){
					DB::update('question_reply', array('isup'=>0), "replyid={$questionShow['upreplyid']}");
				}
				echo '<data class="jsonHtml">11</data>';
				exit();
			}
		}

	} else {
		echo '<data class="jsonHtml">-1</data>';
		exit();
	}
}elseif($operation == 'ajaxUpdatercontent') {
	$replyid= intval($_GET['replyid']);
	$rcontent = trim($_POST['rcontent']);
	if ($replyid&&$rcontent) {
		    $rcontent = daddslashes(diconv($rcontent, 'utf-8','gbk'));
			if(DB::update('question_reply', array('rcontent'=>$rcontent), "replyid={$replyid}")){
				echo '<data class="jsonHtml">1</data>';
				exit();
			}else{
				echo '<data class="jsonHtml">-1</data>';
				exit();
			}
	} else {
		echo '<data class="jsonHtml">-1</data>';
		exit();
	}
	


}elseif($operation == 'addquestion') {
	
	if(submitcheck('questionsubmit')) {
		
			
			$pic1_attachid   = !empty($_G['gp_imgselect'][0]) ? intval($_G['gp_imgselect'][0]) : 0;
			$pic2_attachid   = !empty($_G['gp_imgselect'][1]) ? intval($_G['gp_imgselect'][1]) : 0;
			$pic3_attachid   = !empty($_G['gp_imgselect'][2]) ? intval($_G['gp_imgselect'][2]) : 0;
			$pic4_attachid   = !empty($_G['gp_imgselect'][3]) ? intval($_G['gp_imgselect'][3]) : 0;
			
			$data = array();
			$data['pic1'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic1_attachid} " . getSlaveID());
			$data['pic2'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic2_attachid} " . getSlaveID());
			$data['pic3'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic3_attachid} " . getSlaveID());
			$data['pic4'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic4_attachid} " . getSlaveID());
			$data['pic1_attachid'] = $pic1_attachid;
			$data['pic2_attachid'] = $pic2_attachid;
			$data['pic3_attachid'] = $pic3_attachid;
			$data['pic4_attachid'] = $pic4_attachid;
			
			$data['title'] 	=  trim($_G['gp_title']);
			$lable = '';

			$j = 0;
			for ($i = 1; $i < 4; $i++) {
				$labeltemp =$_G['gp_label'.$i];
				if($labeltemp){
					$lable .= $labeltemp. ',';
					$j++;
				}
			}
			$lable =$j>0? substr($lable, 0, strlen($lable) - 1):$lable;
			if($lable){
				$data['lable'] = $lable;
			}
			$data['content'] 	=  trim($_G['gp_content']);
			$data['authorid'] 	=  $_G['uid'];
			$data['author'] 	=  $_G['username'];
			$data['dateline'] = TIMESTAMP;
			$data['expdateline'] = TIMESTAMP;
			$data['opadmin'] = $_G['username'];
			
			

			DB::insert('question_topic', $data);
			cpmsg('修改成功', "action=question&operation=questionlist", 'succeed');	
			
					
	} else {
		
		$select_lables =getQuestionLables();
		$select_lables_str='';
		foreach ($select_lables as $k=>$v) {
			$select_lables_str .= "<option value=\"{$k}\" >{$v}</option>";
		}
		$adminscript = ADMINSCRIPT;
		$random      = random(4);
		$formhash    = FORMHASH;

		$questionShow = array();
		$picstr		 = '';
		$picnum  	 = 0;



		
		/*编辑框*/
		showformheader("question&operation={$operation}");		
		echo <<<ZBLUNBO
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/equipmentstyle.css?admin" />
<style>
.pubDt50 {
    float: left;
    margin-bottom: 1px;
    width: 100%;
}
.pubDt50 .inputText {padding:2px;font-size:12px;}
.pubDt50 th {vertical-align:middle;width:100px;text-align:center;}
.place-multiLine {display: none;margin-bottom: 15px;margin-top: 3px;overflow: hidden;}
.place-component-block {background-color: #e1eaef;border-radius: 2px;cursor: pointer;height: 30px;line-height: 30px;margin-right: 8px;padding: 0 12px;}
.place-component-block .place-name {color: #31586e;font-weight: 400;}
.autowidthspan {min-width:50px;width:auto;background-color: #e1eaef;border-radius: 2px;cursor: pointer;height: 30px;line-height: 30px;padding: 5px 12px;}

</style>


<div style="margin-top:8px;">
	<table cellspacing="3" cellpadding="3">

		<tr class="pubDt50">
			<th>标题</th><td>
			   <input type="text" name="title" id="title" class="inputText" value="" style="width:500px;" /></td>
		</tr>
		<tr class="pubDt50">
			<th>标签</th><td colspan="2">
				<select name='label1' id='label1'>
				<option value="">请选择分类</option>
				{$select_lables_str}
				</select>&nbsp;
				<select name='label2' id='label2'>
				<option value="">请选择分类</option>
				{$select_lables_str}
				</select>&nbsp;
				<select name='label3' id='label3'>
				<option value="">请选择分类</option>
				{$select_lables_str}
				</select>
				</td>
		</tr>		
		<tr class="pubDt50">
			<th>内容描述</th><td colspan="2">
				<textarea rows="3" cols="200" id="content" name="content" class="inputText" style="width:600px;min-height:80px;"></textarea></td>
		</tr>
		<tr class="pubDt50">
			<th>内容配图</th>
			<td colspan="2">
				<input id="numimage" type="hidden" name="uploadfile" value="{$picnum}"/>
				<div id="pic_upload_multiimg">
					此内容需要 Adobe Flash Player 11.1.0 或更高版本
					<script type="text/javascript">
						var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
						document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
					</script>
				</div>				
			</td>
		</tr>
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td colspan="2">	
				最多上传4张，只保存前4张
				<div id="imglist" class="readyPic">{$picstr}</div>
			</td>
		</tr>
		
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td colspan="2">
				<input type="hidden" name="questionsubmit" value="true" />
				<input type="hidden" name="formhash" id="formhash" value="{$formhash}" />
				<input type="submit" value="" class="publish182x43_1" />
			</td>
		</tr>
	</table>
</div>
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="static/js/newswfobject.js"></script>
<script type="text/javascript">
	var params = {site:"{$_G[siteroot]}misc.php%3fmod=swfupload%26type=image%26fid=0%26mtype=plugin%26twidth=60%26theight=60%26back=uploadsuccess_back%26random={$random}",buttonimg:"{$_G[siteroot]}static/image/common/uploadnew.png"};
	swfobject.embedSWF("static/flash/uploadforum.swf", "pic_upload_multiimg", "208", "50", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
	swfobject.createCSS("#pic_upload_multiimg", "text-align:left;");
</script>
<script>
var maxpic = 4;
function uploadsuccess_back(type, returndata) {
	eval("var nattach = " + returndata + ";");
	jQuery.noConflict();
	;(function(jQuery){
		switch(type){
			case 1:
			case 2:
				var html = '';
				html 	+= '<span id="imagelist_id_'+nattach.aid+'">';
				html 	+= '<img src="' + nattach.thumbpic + '" />';
				html 	+= '<b class="deleteimg">删除</b>';
				html 	+= '<input type="hidden" value="'+nattach.aid+'" name="imgselect[]">';
				html 	+= '</span>';

				jQuery("#imglist").append(html);
				var attachobj = jQuery('#imagelist_id_' + nattach.aid);
				attachobj.find('input').removeAttr('disabled').end().show();

				attachobj.find('img').one('error', function(){
					jQuery(this).attr('src', ' ');
					jQuery(this).attr('src', nattach.thumbpic);
				}).show();
				break;
			case 3:
				break;
		}
		jQuery('#imglist').find('span:gt(' + (maxpic - 1) + ')').addClass("overlimit").find('input').attr('disabled', true);
		//算下上传图片数
		jQuery("#numimage").attr("value", jQuery('#imglist').find("span:not('.overlimit')").length);
	})(jQuery);
}
jQuery(function(){
	jQuery(document).on("click", "#imglist .deleteimg", function() {
		jQuery(this).parent().remove();
		if(jQuery("#imglist .overlimit").length > 0){
			jQuery("#imglist .overlimit:first").removeClass('overlimit').find('input:hidden').removeAttr('disabled');
		}else{
			jQuery("#numimage").val(jQuery("#numimage").val() - 1);
		}
	});
});
	

</script>
ZBLUNBO;
showformfooter();

	}
		
}elseif($operation == 'newReply') {

		include_once libfile('function/portalcp');

		$mpurl = ADMINSCRIPT . '?action=question&operation=' . $operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page = max($_G['gp_page'], 1);
		$topicid 	 = empty($_G['gp_topicid']) ? 0 : intval($_G['gp_topicid']);
		$searchauthor 	 = $_G['gp_searchauthor'];
		if (!in_array($perpage, array(10, 20, 50, 100)))
			$perpage = 50;

		$start = ($page - 1) * $perpage;
		$mpurl .= '&perpage=' . $perpage;
		
		if($searchauthor){
			$mpurl .= '&searchauthor=' . $searchauthor;
		}
		
		$starttime = $_G['gp_starttime'];
		$endtime = $_G['gp_endtime'];
		if($starttime){
			$mpurl .= '&starttime=' . $starttime;
		}
		if($endtime){
			$mpurl .= '&endtime=' . $endtime;
		}
		$starttime = !preg_match("/^(0|\d{4}\-\d{1,2}\-\d{1,2})$/", $starttime) ? dgmdate(TIMESTAMP - 86400 * 7, 'Y-n-j') : $starttime;
		$endtime = $_G['adminid'] == 3 || !preg_match("/^(0|\d{4}\-\d{1,2}\-\d{1,2})$/", $endtime) ? dgmdate(TIMESTAMP, 'Y-n-j') : $endtime;
		
		echo '<link  type="text/css" rel="stylesheet" href="http://static.8264.com/static/css/forum/forum_calendar.css">';
		echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
		$extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">';
		$extraStr .= '&nbsp;&nbsp;<form action="admin.php" method="GET" style="display:inline;" >';
		$extraStr .= '<input type="hidden" name="action" value="question"/>';
		$extraStr .= '<input type="hidden" name="operation" value="newReply"/>';
		$extraStr .= '发布时间范围:<input  type="text" onclick="showcalendar(event, this)" style="width: 80px; height:20px;" value="'.$starttime.'" name="starttime"> -- ';
		$extraStr .= '<input  type="text" onclick="showcalendar(event, this)" style="width: 80px;height:20px;" value="'.$endtime.'" name="endtime">&nbsp;&nbsp&nbsp;&nbsp';
		
		$extraStr .= '问题ID&nbsp;&nbsp;<input type="text" name="topicid" value="'.$topicid.'" style="width: 85px;height:20px;" placeholder="填写问题ID" />&nbsp;&nbsp;';
		$extraStr .= '用户名&nbsp;&nbsp;';
		$extraStr .= '<input type="text" name="searchauthor" value="'.$searchauthor.'" style="height:20px;" placeholder="填写用户名" />&nbsp;&nbsp;';

		$extraStr .= '<input type="submit" value="查询" style="cursor:pointer;" /></form></div>';
		echo $extraStr;

		showformheader('question&operation=newReply');
		showtableheader();
		showsubtitle(array('','ID', '回答内容','问题', '操作', '排序', '用户名', '发布时间'));

		$multipage = '';
		
			
			  $search_cond=" AND r.dateline<".(strtotime($endtime)+86400)." AND r.dateline >".strtotime($starttime);
			  if($topicid) {
				  $search_cond .=" AND r.ref_topicid = {$topicid}";
			  }
			  if($searchauthor){
				  $search_cond .=" AND r.author = '{$searchauthor}'";
			  }
			
			$count_sql ="SELECT COUNT(r.replyid) as count FROM " . DB::table('question_reply') . " AS r "
									. "LEFT JOIN ".DB::table("question_topic")." AS t "
									. "ON r.ref_topicid=t.topicid "
									." WHERE  t.isshow =1 AND r.ref_replyid = 0 AND r.rcontent != '' AND r.tid = 0 AND r.ishidden = 0  {$search_cond} " . getSlaveID();
			$count = DB::result_first($count_sql);
			if ($count) {
				$sql ="SELECT r.*,t.title  FROM " . DB::table('question_reply') . " AS r "
									. "LEFT JOIN ".DB::table("question_topic")." AS t "
									. "ON r.ref_topicid=t.topicid "
									." WHERE  t.isshow =1 AND r.ref_replyid = 0 AND r.rcontent != '' AND r.tid = 0 AND r.ishidden = 0  {$search_cond} order by dateline desc,replyid desc LIMIT {$start},{$perpage} " . getSlaveID();
				$query = DB::query($sql);
				while ($value = DB::fetch($query)) {
					    $status = '上线';
						$zhidingStr=$value['isup']==1?"[<a id=\"zhiding_a_$value[replyid]\" onclick=\"doZhiding('$value[replyid]','$value[authorid]','$value[ref_topicid]')\" href=\"javascript:void(0)\">已置顶</a>]":"[<a id=\"zhiding_a_$value[replyid]\" onclick=\"doZhiding('$value[replyid]','$value[authorid]','$value[ref_topicid]')\" href=\"javascript:void(0)\">置顶</a>]";
						showtablerow("id='daantr_{$value[replyid]}'", array('class="td25"','width="30"', 'width="480"', 'class="td28"', 'width="50"', 'width="50"'), array(
						"",
						"{$value[replyid]}",
						"{$value[rcontent]}",
						"<a href=\"http://www.8264.com/wenda/$value[ref_topicid].html\" target=\"_blank\">[{$status}]{$value[title]}</a>",	
						"<a href=\"javascript:void(0)\" onclick=\"doYcbigbuttonNew('$value[replyid]', 'hidden','$value[authorid]','$value[ref_topicid]')\">[删除]</a><br/><a href=\"admin.php?action=question&operation=editquestion&topicid=$value[ref_topicid]\" target=\"_blank\">[编辑]</a>",
						$zhidingStr,
						$value['author'],
						date('Y-m-d H:i',$value['dateline'])
					));
				}
				$multipage = multi($count, $perpage, $page, $mpurl);
			}
		
	
		showsubmit('', '', '', '', $multipage);
		showtablefooter();
		showformfooter();
		
echo <<<READMODEL
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
		var jq=jQuery.noConflict();
function doYcbigbuttonNew(replyid, tooperation,uid,ref_topicid) {
		jQuery.get("{$adminscript}?action=question&operation=ajaxOpertion_daan_new&topicid=" +ref_topicid+"&replyid=" + replyid + "&tooperation=" + tooperation+ "&uid=" + uid, function(data) {
			var dealstr = data.match(/<data class="jsonHtml">([\s\S]*)<\/data>/g);
			dealstr     = String(dealstr);
			dealstr     = dealstr.replace('<data class="jsonHtml">', '').replace('</data>', '');		
			if (dealstr == '10') {
					jQuery("#daantr_"+replyid).remove();

	
			}
		});
	}
		
		
		
//答案置顶
	function doZhiding(upreplyid,upuid,ref_topicid) {
		jQuery.get("{$adminscript}?action=question&operation=ajaxOpertionupuid&topicid=" + ref_topicid + "&upreplyid=" + upreplyid+ "&upuid=" + upuid, function(data) {
			var dealstr = data.match(/<data class="jsonHtml">([\s\S]*)<\/data>/g);
			dealstr     = String(dealstr);
			dealstr     = dealstr.replace('<data class="jsonHtml">', '').replace('</data>', '');		
			if (dealstr == '11') {
				jQuery("#zhiding_a_"+upreplyid).text("已置顶");	
			}else if (dealstr == '10'){
				return false;
			}
		});
	}
		
		
</script>
READMODEL;
	
}elseif($operation == 'operationlog') {
	$mpurl = ADMINSCRIPT . '?action=question&operation=' . $operation;
	$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
	$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
	$page = max($_G['gp_page'], 1);
	if (!in_array($perpage, array(10, 20, 50, 100)))
			$perpage = 50;
	$start = ($page - 1) * $perpage;
	$mpurl .= '&perpage=' . $perpage;
	
	$count = DB::result_first("SELECT COUNT(s.id) 
			FROM ".DB::table("question_operation_log")." AS s
			WHERE s.type= 'hiddenpid' ".getSlaveID());
	
	$query = DB::query("SELECT s.*, t.title 
			FROM ".DB::table("question_operation_log")." AS s
			LEFT JOIN ".DB::table("question_topic")." AS t ON s.topicid=t.topicid
			WHERE s.type= 'hiddenpid'
			ORDER BY  s.dateline DESC,s.topicid DESC,s.replyid DESC 
			LIMIT {$start},{$perpage} ".getSlaveID());
	

	showformheader();
	showtableheader('pid隐藏记录');
	
	showsubtitle(array('序号', '问答ID','问答标题','答案ID', '内容','操作人||操作时间'));
	
	
	//答案list遍历开始
		while ($row = DB::fetch($query)) {
			
			showtablerow('', array('width="5%"', 'class="td28"', 'width="100" style="white-space:nowrap;"', 'style="white-space:nowrap;"','width="70%" style="font-size:14px;"','width="100" style="white-space:nowrap;"'), array(
				$row['id'],
				$row['topicid'],
				$row['title'],
				$row['replyid'],
				$row['message'],
				$row['opadmin']."||".date("Y-m-d H:i:s", $row['dateline'])
			));
		}
		$multipage = multi($count, $perpage, $page, $mpurl);

	//答案list遍历结束
	
	showsubmit('', '', '', '', $multipage);
	showtablefooter();
	showformfooter();
	
	echo <<<READMODEL
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<style>
	#cpform img {max-width:100px;max-height:100px; margin-bottom:5px;display:block;border:0;}
	#cpform img {height: expression(this.width > 100 ? this.height = this.height * 100 / this.width : "auto");width: expression(this.width > 100 ? "100px" : "auto");max-width:100px;}
	#cpform a {color:#2366a8;}	
	#zoom{position:absolute;border:none;background:#333;padding:0px;display:none;color:#fff;}
	#zoom img {max-width:400px;max-height:400px; }
	#zoom img {height: expression(this.width > 400 ? this.height = this.height * 400 / this.width : "auto");width: expression(this.width > 400 ? "400px" : "auto");max-width:400px;}
	.onedaandiv:hover{background-color:#abd7ff;display:block;border:0;}
</style>
<script type="text/javascript" src="static/js/jquery.scrollExtend.js"></script>
<script src="http://static.8264.com/static/js/jquery.lazyload.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function (){
    //图片延时加载
    $(".lazy").lazyload({
    	effect:"fadeIn",
    	appear: function(){
		}
    }); 
});
	
	
</script>

<script type="text/javascript">
	this.imageZoom = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 30;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	jQuery("img.zoom").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		jQuery("body").append("<div id='zoom'><img src='"+ this.src +"' alt='Image zoom' />"+ c +"</div>");								 
		jQuery("#zoom")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		jQuery("#zoom").remove();
    });	
	jQuery("img.zoom").mousemove(function(e){
		jQuery("#zoom")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


// starting the script on page load
jQuery(document).ready(function(){
	imageZoom();
});
</script>
READMODEL;
}

?>
