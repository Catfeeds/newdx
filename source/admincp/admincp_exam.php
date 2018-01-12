<?php

/**
 * 考试管理
 * @author zhang wenchu 20161008
 */
if (!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
    exit('Access Denied');
}
set_time_limit(0);
require DISCUZ_ROOT . './config/config_dianping.php';
include_once libfile('function/home');
include_once libfile('function/cloud');
include_once libfile('function/dianping');

require_once libfile('class/myredis');
$myredis = & myredis::instance();

if(empty($operation)) {
    $operation = 'questionlist';
}

if($operation == 'questionlist'){
    //页面展示
    cpheader();
    shownav('topic', '试题列表');
    top_nav(0);
    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $qids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation=questionlist&&perpage={$perpage}&page={$page}";

        if ($_G['gp_optype'] == 'trash' && $qids) {

            $query = DB::query("SELECT qid,catid FROM ". DB::table('exam_questions')." WHERE qid in ($qids) " .getSlaveID());
            while($raw = DB::fetch($query)){
                $qid_cat[$raw['qid']] = $raw['catid'];
            }

            foreach($qid_cat as $k=>$v){
                $myredis->sRem('exam_catid_'.$v, $k);
                $myredis->sRem('exam_all_ids', $k);
                $myredis->sRem('exam_noshow_ids', $k);
            }

            DB::delete('exam_questions', "qid in ({$qids})");
            cpmsg('删除成功', $url, 'succeed');
        } elseif ($_G['gp_optype'] == 'show' && $qids) {

            $query = DB::query("SELECT qid,catid FROM ". DB::table('exam_questions')." WHERE qid in ($qids) " .getSlaveID());
            while($raw = DB::fetch($query)){
                $qid_cat[$raw['qid']] = $raw['catid'];
            }



            foreach($qid_cat as $k=>$v){
                $myredis->sAdd('exam_all_ids', $k);
                $myredis->sAdd('exam_catid_'.$v, $k);
                $myredis->sRem('exam_noshow_ids', $k);
            }

            DB::update('exam_questions', array('is_show'=>1), "qid in ({$qids})");
            cpmsg('上线成功', $url, 'succeed');
        } elseif ($_G['gp_optype'] == 'noshow' && $qids) {
            $query = DB::query("SELECT qid,catid FROM ". DB::table('exam_questions')." WHERE qid in ($qids) " .getSlaveID());
            while($raw = DB::fetch($query)){
                $qid_cat[$raw['qid']] = $raw['catid'];
            }

            foreach($qid_cat as $k=>$v){
                $myredis->sRem('exam_catid_'.$v, $k);
                $myredis->sAdd('exam_noshow_ids', $k);
            }

            DB::update('exam_questions', array('is_show'=>0), "qid in ({$qids})");
            cpmsg('下线成功', $url, 'succeed');
        } elseif ($_G['gp_optype_se'] && $qids) {
            //移动分类
//                $mems = $myredis->sMembers("exam_catid_".$_G['gp_optype_se']);
//                print_r($mems);die();

            $query = DB::query("SELECT qid,catid FROM ". DB::table('exam_questions')." WHERE qid in ($qids) " .getSlaveID());
            while($raw = DB::fetch($query)){
                $qid_cat[$raw['qid']] = $raw['catid'];
            }

            foreach($qid_cat as $k=>$v){
                $myredis->sRem('exam_catid_'.$v, $k);
                $myredis->sAdd('exam_catid_'.$_G['gp_optype_se'], $k);
            }

            DB::update('exam_questions', array('catid'=>$_G['gp_optype_se']), "qid in ({$qids})");
            cpmsg('移动成功', $url, 'succeed');
        } else {
            cpmsg('article_choose_at_least_one_operation', $url, 'error');
        }
    }else{
        //表单框架
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function subcheck(obj) {
		//操作类别
		var op = jsTrim(jQuery("input[name=optype]:checked").val());
		if(op == 'trash'){
			if(confirm("删除是不可恢复的，你确认要删除吗？")){
                            return true;
                        }else{
                            return false;
                        }
		}
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
EOT;
        $cat_array = questiontype(1);

        $mpurl = ADMINSCRIPT . '?action=exam&operation=' . $operation;
        $perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
        $page = max($_G['gp_page'], 1);
        $qid = empty($_G['gp_qid']) ? 0 : intval($_G['gp_qid']);
        $searchtid 	 = empty($_G['gp_searchtid']) ? 0 : intval($_G['gp_searchtid']);
        $selectcat 	 = $_G['gp_selectcat'];
        if (!in_array($perpage, array(10, 20, 50, 100)))
            $perpage = 50;

        $start = ($page - 1) * $perpage;
        $mpurl .= '&perpage=' . $perpage;
        if($selectcat){
            $mpurl .= '&selectcat=' . $selectcat;
        }

        $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">试题ID&nbsp;&nbsp;';
        $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
        $extraStr .= '<input type="hidden" name="action" value="exam"/>';
        $extraStr .= '<input type="hidden" name="operation" value="questionlist"/>';
        $extraStr .= '<input type="text" name="qid" value="'.$qid.'" style="height:18px;width:85px;vertical-align:middle;" placeholder="填写问题ID" />&nbsp;&nbsp;';
        $extraStr .= '&nbsp;&nbsp;类别&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">请选择类别</option>';
        foreach ($cat_array as $k=>$v) {
            $selectStr = $selectcat == $k ? 'selected=\"selected\"' : '';
            $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
        }
        $extraStr .= '</select>&nbsp;&nbsp;';
        $extraStr .= '<input type="submit" value="查询" style="cursor:pointer;" /></form></div>';
        echo $extraStr;

        showformheader('exam&operation=questionlist','onsubmit="return subcheck(this);"');
        showtableheader();
        showsubtitle(array('', 'ID','类别', '标题', '答案', '创建时间', '有用', '无用', '操作'));

        $and = '';
        $multipage = '';

        if($qid){
            $and .= ' AND qid = '.$qid;
        }
        if($selectcat){
            $and .= ' AND catid = '.$selectcat;
        }
        $count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('exam_questions') . " WHERE is_show in (0,1) ". $and . getSlaveID());
        if($count){
            $sql = "SELECT * FROM " . DB::table('exam_questions') . " WHERE is_show in (0,1) ". $and ." ORDER BY qid DESC LIMIT {$start},{$perpage} " . getSlaveID();
            $query = DB::query($sql);
            while ($value = DB::fetch($query)) {
                $status = $value[is_show] ? '上线' : '<span style="color:red;">下线</span>';
                showtablerow('', array('class="td25"','width="30"','width="80"'), array(
                    "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[qid]\">",
                    "{$value[qid]}",
                    "{$cat_array[$value[catid]]}",
                    "<a href=\"\" target=\"_blank\">[{$status}]{$value[title]}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"admin.php?action=exam&operation=editquestion&qid=$value[qid]\" target=\"_blank\">[编辑]</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"exam.php?ctl=topic&act=yulan&qid=$value[qid]\" target=\"_blank\">[预览]</a>",
                    $value['right_answer'],
                    date('Y-m-d H:i',$value['createtime']),
                    $value['useful'],
                    $value['useless'],
                    "<a href=\"admin.php?action=exam&operation=editquestion&qid=$value[qid]\" target=\"_blank\">[编辑]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" onclick="radio_click(this)" /><label for="optype_trash">彻底删除</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_show" value="show" class="optype" onclick="radio_click(this)" /><label for="optype_show">上线</label>&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_noshow" value="noshow" class="optype" onclick="radio_click(this)" /><label for="optype_noshow">下线</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '批量移动到：&nbsp;&nbsp;<select id="movecat" name="optype_se" onchange="optype_select()">'
            . '<option value="0">请选择类别</option>';
        foreach ($cat_array as $k=>$v) {
            $optypehtml .= "<option value=\"{$k}\" >{$v}</option>";
        }
        $optypehtml .= '</select>&nbsp;&nbsp;';

        echo <<<EOT
        <script>
            function optype_select(){
                jQuery(".optype").attr("checked", false);
            }
            function radio_click(obj){
                jQuery("#movecat").val("0");
            }
	</script>
EOT;

        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
        showtablefooter();
        showformfooter();
    }

}

if($operation == 'addquestion'){
    //页面展示
    cpheader();
    shownav('topic', '添加试题');
    top_nav(1);

    if (submitcheck('addsubmit')) {
        $title = str_replace(array('"', "'"), "`", $_POST['title']);
        $catid = $_POST['catid'];
        $qtype = $_POST['qtype'];
        $questionanswers = trim(getstr($_POST['questionanswers'], 0, 1, 1, 0, 1));
        $questionanswers = str_replace(array('"', "'"), "`", $questionanswers);
        $rightanswers_arr = $_POST['rightanswers'];
        $analysis = str_replace(array('"', "'"), "`", $_POST['analysis']);
        $imgurl = str_replace(array('"', "'"), "", trim($_POST['imgurl']) );
        $videourl = str_replace(array('"', "'"), "", trim($_POST['videourl']) );
        $createtime = TIMESTAMP;

        $questionanswers = str_replace(array("\r\n", "\r", "\n"), "<br/>", $questionanswers);
        $analysis = str_replace(array("\r\n", "\r", "\n"), "<br/>", $analysis);

        $uid = $_G['uid'];

        $right_answer = '';
        if(!empty($rightanswers_arr)){
            foreach($rightanswers_arr as $v){
                $right_answer .= $v;
            }
        }
        DB::query("INSERT INTO " . DB::table('exam_questions') . "
			(catid, title, qtype, answers, right_answer, analysis, imgurl, videourl, uid, is_show, createtime)
			VALUES ('$catid', '{$title}', '{$qtype}', '{$questionanswers}', '{$right_answer}', '{$analysis}', '{$imgurl}', '{$videourl}', '$uid', '1', '$createtime')");
        $qid = DB::insert_id();


        $myredis->sAdd("exam_all_ids", $qid);
        $myredis->sAdd("exam_catid_".$catid, $qid);

        $url = preg_replace('/\/admin\.php\?/i', '', $url);
        cpmsg('发布成功！', $url, 'succeed');
    }
    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {	
		//标题
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('标题不能为空！');
			return false;
		}
    
                //分类
                var catid = jQuery("#catid").val();
                if(catid == '0'){
                        alert('请选择试题分类！');
                        return false;
                }
    
                //试题选项
                var questionanswers = jsTrim(jQuery("#questionanswers").val());
                if(questionanswers == ''){
                        alert('试题选项不能为空！');
                        return false;
                }
    
                //试题类型
                var qtype = jQuery("input[name=qtype]:checked").val();
                if(qtype == ''){
                        alert('请选择试题类型！');
                        return false;
                }
    
                //正确选项
                var rightanswers = jQuery("input[name=rightanswers[]]:checked").val();
                if(!rightanswers){
                    alert('请至少选中一个正确选项！');
                    return false;
                }
    
		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
EOT;

    showtips('<li>试题选项按顺序填写，以回车区分</li>');
    showformheader('exam&operation=addquestion', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('试题标题', 'title', '', 'text', '', '', '', 'style="width:547px;"');
    showsetting('试题分类', '', '', '<select id="catid" name="catid"><option value="0">'."请选择分类".'</option>'.questiontype(2).'</select>');
    showtablerow('', array('class="td27" colspan="2"'), array('试题选项：<font color="red">(请确保每行一个选项)</font><br><br><textarea id="questionanswers" name="questionanswers"  rows="6" cols="85" style=""></textarea>'));
    showsetting('试题类型', '', '', '<input type="radio" value="1" name="qtype">判断&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="2" name="qtype" checked>单选&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="3" name="qtype">多选');
    showsetting('正确选项', array('rightanswers', array(
        array('A','A'),
        array('B','B'),
        array('C','C'),
        array('D','D'),
        array('E','E'),
        array('F','F'),
    )), '', 'mcheckbox');
    //富文本编辑框不适合从Word直接粘贴
//    showtablerow('', array('class="td27" colspan="2"'), array('试题解析：<textarea class="userData" name="analysis" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
//    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showtablerow('', array('class="td27" colspan="2"'), array('试题解析：<br><br><textarea id="analysis" name="analysis"  rows="6" cols="85" style=""></textarea>'));
    showsetting('图片链接', 'imgurl', '', 'text', '', '', '', 'style="width:697px;"');
    showsetting('视频链接', 'videourl', '', 'text', '', '', '', 'style="width:697px;"');
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editquestion'){
    //页面展示
    cpheader();
    shownav('topic', '编辑试题');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $qid = empty($_G['gp_qid']) ? 0 : intval($_G['gp_qid']);

        $title = str_replace(array('"', "'"), "`", $_POST['title']);
        $catid = $_POST['catid'];
        $qtype = $_POST['qtype'];
        $questionanswers = trim(getstr($_POST['questionanswers'], 0, 1, 1, 0, 1), "|");
        $questionanswers = str_replace(array('"', "'"), "`", $questionanswers);
        $rightanswers_arr = $_POST['rightanswers'];
        $analysis = str_replace(array('"', "'"), "`", $_POST['analysis']);
        $analysis = str_replace(array("\r\n", "\r", "\n"), "<br/>", $analysis);
        $imgurl = str_replace(array('"', "'"), "", trim($_POST['imgurl']) );
        $videourl = str_replace(array('"', "'"), "", trim($_POST['videourl']) );

        $questionanswers = str_replace(array("\r\n", "\r", "\n"), "<br/>", $questionanswers);

        $uid = $_G['uid'];

        $right_answer = '';
        if(!empty($rightanswers_arr)){
            foreach($rightanswers_arr as $v){
                $right_answer .= $v;
            }
        }

        $createtime = TIMESTAMP;

        DB::update('exam_questions', array('catid' => $catid, 'title' => $title, 'qtype' => $qtype, 'answers' => $questionanswers, 'right_answer' => $right_answer, 'analysis' => $analysis, 'imgurl' => $imgurl, 'videourl' => $videourl, 'createtime' => $createtime), "qid='{$qid}'");

        $url = "action=exam&operation=questionlist";
        $url = preg_replace('/\/admin\.php\?/i', '', $url);
        cpmsg('修改成功！', $url, 'succeed');
    }

    $qid = empty($_G['gp_qid']) ? 0 : intval($_G['gp_qid']);
    if(!$qid){
        cpmsg('操作失败,qid非法', 'action=exam&operation=questionlist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_questions') ." WHERE qid = ".$qid.getSlaveID());
    $row = DB::fetch($query);

    $row['answers'] = str_replace("</br>", "\n", $row['answers']);

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		edit_save();
		window.onbeforeunload = null;
		//标题
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('标题不能为空！');
			return false;
		}
    
                //分类
                var catid = jQuery("#catid").val();
                if(catid == '0'){
                        alert('请选择试题分类！');
                        return false;
                }
    
                //试题选项
                var questionanswers = jsTrim(jQuery("#questionanswers").val());
                if(questionanswers == ''){
                        alert('试题选项不能为空！');
                        return false;
                }
    
                //试题类型
                var qtype = jQuery("input[name=qtype]:checked").val();
                if(qtype == ''){
                        alert('请选择试题类型！');
                        return false;
                }
    
                //正确选项
                var rightanswers = jQuery("input[name=rightanswers[]]:checked").val();
                if(!rightanswers){
                    alert('请至少选中一个正确选项！');
                    return false;
                }
    
		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
EOT;

    //showtips('<li>选项之间用“|”隔开。例如：A、是|B、否</li>');
    showformheader('exam&operation=editquestion&qid='.$qid, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('试题标题', 'title', "$row[title]", 'text', '', '', '', 'style="width:547px;"');
    showsetting('试题分类', '', '', '<select id="catid" name="catid"><option value="0">'."请选择分类".'</option>'.questiontype(2, $row['catid']).'</select>');
    showtablerow('', array('class="td27" colspan="2"'), array('试题选项：<br><br><textarea id="questionanswers" name="questionanswers"  rows="6" cols="85" style="" >'.$row[answers].'</textarea>'));
//    showsetting('正确选项', array('rightanswers', array(
//	array('A','A'),
//	array('B','B'),
//        array('C','C'),
//        array('D','D'),
//        array('E','E'),
//        array('F','F'),
//        array('G','G'),
//        array('H','H'),
//        array('I','I'),
//        array('J','J'),
//    )), '', 'mcheckbox');

    $radio ='<tr><td colspan="2" class="td27">试题类型:</td></tr>
        <tr class="noborder"><td class="vtop rowform">
        <input value="1" name="qtype" type="radio" '.ischecked("1", $row[qtype]).'>判断&nbsp;&nbsp;&nbsp;&nbsp;
        <input value="2" name="qtype" type="radio" '.ischecked("2", $row[qtype]).'>单选&nbsp;&nbsp;&nbsp;&nbsp;
        <input value="3" name="qtype" type="radio" '.ischecked("3", $row[qtype]).'>多选</td><td class="vtop tips2"></td></tr>';
    $selected = '
    <tr><td colspan="2" class="td27">正确选项:</td></tr>
    <tr class="noborder">
        <td colspan="2" class="vtop rowform">
            <ul class="nofloat" onmouseover="altStyle(this);" style="width: 830px">
                <li style="float: left; width: 18%"><input class="checkbox" name="rightanswers[]" value="A" type="checkbox" '.ischecked("A", $row[right_answer]).'>&nbsp;A</li>
                <li style="float: left; width: 18%"><input class="checkbox" name="rightanswers[]" value="B" type="checkbox" '.ischecked("B", $row[right_answer]).'>&nbsp;B</li>
                <li style="float: left; width: 18%"><input class="checkbox" name="rightanswers[]" value="C" type="checkbox" '.ischecked("C", $row[right_answer]).'>&nbsp;C</li>
                <li style="float: left; width: 18%"><input class="checkbox" name="rightanswers[]" value="D" type="checkbox" '.ischecked("D", $row[right_answer]).'>&nbsp;D</li>
                <li style="float: left; width: 18%"><input class="checkbox" name="rightanswers[]" value="E" type="checkbox" '.ischecked("E", $row[right_answer]).'>&nbsp;E</li>
                <li style="float: left; width: 18%"><input class="checkbox" name="rightanswers[]" value="F" type="checkbox" '.ischecked("F", $row[right_answer]).'>&nbsp;F</li>
            </ul>
        </td>
    </tr>
';
    echo $radio.$selected;
    //富文本编辑框不适合从Word直接粘贴
//    showtablerow('', array('class="td27" colspan="2"'), array('试题解析：<textarea class="userData" name="analysis" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
//    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showtablerow('', array('class="td27" colspan="2"'), array('试题解析：<br><br><textarea id="analysis" name="analysis"  rows="6" cols="85" style="">'.$row[analysis].'</textarea>'));
    showsetting('图片链接', 'imgurl', "$row[imgurl]", 'text', '', '', '', 'style="width:697px;"');
    showsetting('视频链接', 'videourl', "$row[videourl]", 'text', '', '', '', 'style="width:697px;"');
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'categorylist'){
    //页面展示

    // **************************************************
    // 删除分类操作注释了，暂时不提供该功能，涉及地方较多,未完成！
    // **************************************************

    cpheader();
    shownav('topic', '编辑试题');
    top_nav(2);

    $category = getcategory();

    if(!submitcheck('submit')) {

        showformheader('exam&operation=categorylist&do=edit');
        showtableheader();
        echo '<tr><td colspan="2">';
        showtableheader();
        showsubtitle(array('分类ID', '显示顺序(数字越大越靠前)', '分类名称', '是否显示', '操作'));
        $navlist = $subnavlist = $pluginsubnav = array();
        $query = DB::query("SELECT * FROM ".DB::table('exam_category')." ORDER BY is_show desc, displayorder desc,id asc");
        while($nav = DB::fetch($query)) {
            if($nav['fid']) {
                $subnavlist[$nav['fid']][] = $nav;
            } else {
                $navlist[$nav['id']] = $nav;
            }
        }

        foreach($navlist as $nav) {
            $navsubtype = array();
            $navsubtype[$nav['subtype']] = 'selected="selected"';
            $readonly = $nav['type'] == '4' ? ' readonly="readonly"' : '';
            $showflag = $nav['is_show'] ? "是" : "否" ;
            showtablerow('', array('class="td25"','', '', ''), array(
                "$nav[id]",
                "<input type=\"text\" class=\"txt\" size=\"2\" name=\"displayordernew[$nav[id]]\" value=\"$nav[displayorder]\">",
                "<div><input type=\"text\" class=\"txt\" size=\"15\" name=\"namenew[$nav[id]]\" value=\"".dhtmlspecialchars($nav['catname'])."\"$readonly>",
                // 添加二级分类功能，暂时隐藏。
                //($nav['level'] == 2 ? '' : "<a href=\"###\" onclick=\"addrowdirect=1;addrow(this, 1, $nav[id])\" class=\"addchildboard\">添加二级分类</a></div>"),
                "$showflag",
                "<a href=\"admin.php?action=exam&operation=editcategory&cid=$nav[id]\" target=\"_blank\">[编辑]</a>&nbsp;&nbsp;&nbsp;&nbsp;"
                ."<a href=\"admin.php?action=exam&operation=editarticlecategory&cid=$nav[id]\" target=\"_blank\">[文章]</a>"
                //."<a class=\"act dodelete". $nav['id'] ."\" onclick=\"delete_cate(". $nav['id'] .")\">删除</a>"
            ));
            if(!empty($subnavlist[$nav['id']])) {
                $subnavnum = count($subnavlist[$nav['id']]);
                foreach($subnavlist[$nav['id']] as $sub) {
                    $readonly = $sub['type'] == '4' ? ' readonly="readonly"' : '';
                    $showflag2 = $sub['is_show'] ? "显示" : "隐藏" ;
                    $subnavnum--;
                    showtablerow('', array('class="td25"', '', '', ''), array(
                        "$sub[id]",
                        "<input type=\"text\" class=\"txt\" size=\"2\" name=\"displayordernew[$sub[id]]\" value=\"$sub[displayorder]\">",
                        "<div class=\"".($subnavnum ? 'board' : 'lastboard')."\"><input type=\"text\" class=\"txt\" size=\"15\" name=\"namenew[$sub[id]]\" value=\"".dhtmlspecialchars($sub['catname'])."\"$readonly></div>",
                        "$showflag2",
                        "<a href=\"admin.php?action=exam&operation=editcategory&cid=$sub[id]\" target=\"_blank\">[编辑]</a>"
                        //. "<a class=\"act dodelete". $sub['id'] ."\" onclick=\"delete_cate(". $sub['id'] .")\">删除</a>"
                    ));
                }
            }
        }
        echo '<tr><td colspan="1"></td><td colspan="8"><div><a href="###" onclick="addrow(this, 0, 0)" class="addtr">添加分类</a></div></td></tr>';
        showsubmit('submit', 'submit', 'del');
        showtablefooter();
        showformfooter();

        $langs = array();
        $keys = array('albumcategory_addcategory', 'albumcategory_addsubcategory');
        foreach ($keys as $key) {
            $langs[$key] = cplang($key);
        }
        echo <<<SCRIPT
<script src="static/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">jQuery.noConflict();</script>                
<script type="text/Javascript">
var rowtypedata = [
	[[1,'', 'td25'], [1,'<input type="text" class="txt" name="neworder[{1}][]" value="0" />', ''], [3, '<div class="parentboard"><input type="text" class="txt" value="$lang[albumcategory_addcategory]" name="newname[{1}][]"/></div>']],
	[[1,'', 'td25'], [1,'<input type="text" class="txt" name="neworder[{1}][]" value="0" />', ''], [3, '<div class="board"><input type="text" class="txt" value="$lang[albumcategory_addsubcategory]" name="newname[{1}][]"/></div>']],
];
                        
function delete_cate(id){
    if(id == ''){
        return false;
    }
    
   jQuery.ajax({
            type : 'POST',
            url : '/admin.php?action=exam&operation=categoryedit&do=delete',
            data : {id:id},
            success:function(result){
                    result = eval("("+result+")");
                    if(result.flag == '1'){
                        jQuery(".dodelete"+result.id).parent().parent().remove();
                    }
            }
    });
}                        

</script>
SCRIPT;

    } else {

//            print_r($_POST);die();

        if($_G['gp_do'] == 'edit'){
            if($_POST['displayordernew']){
                $sql = "update ".DB::table('exam_category')." set displayorder = case id ";
                foreach($_POST['displayordernew'] as $k=>$v){
                    $v = trim($v);
                    $sql .= " when ".$k." then ".$v." ";
                }
                $sql .= " END";

                DB::query($sql);
            }

            if($_POST['namenew']){
                $sql = "update ".DB::table('exam_category')." set catname = case id ";
                foreach($_POST['namenew'] as $k=>$v){
                    $v = trim($v);
                    $sql .= " when ".$k." then '".$v."' ";
                }
                $sql .= " END";

                DB::query($sql);
            }

            if($_POST['neworder'] && $_POST['newname']){
                foreach($_POST['neworder'] as $k=>$v){
                    if($k == '0'){
                        if(is_array($v)){
                            foreach($v as $ke=>$va){
                                DB::insert('exam_category', array('fid' => 0, 'catname' => trim($_POST['newname'][$k][$ke]), 'displayorder'=>intval($va), 'createtime'=>time() ));
                            }
                        }
                    }else{
                        if(is_array($v)){
                            foreach($v as $ke=>$va){
                                DB::insert('exam_category', array('fid' => $k, 'catname' => trim($_POST['newname'][$k][$ke]), 'level'=>'2', 'displayorder'=>intval($va), 'createtime'=>time()));
                            }
                        }
                    }
                }
            }

            cpmsg('提交成功', 'action=exam&operation=categorylist', 'succeed');
        }

    }



}
if($operation == 'editcategory'){
    //页面展示
    cpheader();
    shownav('topic', '编辑分类');
    top_nav(2);

    if (submitcheck('addsubmit')) {
        $cid = intval($_POST['cid']);
        if(!$cid){
            cpmsg('操作失败,非法id', 'action=exam&operation=categorylist', 'error');
            die;
        }
        $title = str_replace(array('"', "'"), "`", $_POST['title']);
        if(!$title){
            cpmsg('操作失败,分类名不能为空', 'action=exam&operation=categorylist', 'error');
            die;
        }
        $join_nums = intval($_POST['join_nums']);

        $qtype = $_POST['qtype'];
        $imgurl = str_replace(array('"', "'"), "", trim($_POST['img']));
        $other = trim($_POST['other']);
        $other_url = trim($_POST['other_url']);
        DB::update('exam_category', array('catname' => $title, 'join_nums'=>$join_nums, 'is_show' => $qtype, 'img' => $imgurl, 'other' => $other, 'other_url' => $other_url), "id='{$cid}'");

        cpmsg('发布成功！', 'action=exam&operation=categorylist', 'succeed');
    }

    $cid = empty($_G['gp_cid']) ? 0 : intval($_G['gp_cid']);
    if(!$cid){
        cpmsg('操作失败,qid非法', 'action=exam&operation=categorylist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_category') ." WHERE id = ".$cid.getSlaveID());
    $row = DB::fetch($query);

    require_once libfile('class/upyun_form');
    $upyun = new UpYun($_G['config']['cdn']['form']['bucket_name'], $_G['config']['cdn']['form']['form_api_secret']);

    $opts = array();
    $opts['save-key'] = '/exam/{hour}{min}{sec}{random}{.suffix}';   // 保存路径
    $opts['allow-file-type'] = 'gif,jpg,jpeg,bmp,png';

    $policy = $upyun->policyCreate($opts);
    $sign = $upyun->signCreate($opts);
    $action = $upyun->action();
    $version = $upyun->version();

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    
    <script src="http://static.8264.com/static/js/webuploader.js" type="text/javascript"></script>
    <script>
        jQuery(function() {
            var $ = jQuery,
                // 优化retina, 在retina下这个值是2
                ratio = window.devicePixelRatio || 1,
                // 缩略图大小
                thumbnailWidth = 100 * ratio,
                thumbnailHeight = 100 * ratio,
                // Web Uploader实例
                uploader;
            // 初始化Web Uploader
            uploader = WebUploader.create({
        
                // 自动上传。
                auto: true,
                // swf文件路径
                swf: 'http://static.8264.com/static/flash/webuploader.swf',
                // 文件接收服务端。
                server: $("#action").val(),
                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick : {id : "#filePicker",
                    //只能选择一个文件上传
                    multiple: false},		
        
                //限制只能上传一个文件
                fileNumLimit: 1, 
                fileSizeLimit: 10000000,
                threads: 1,
                runtimeOrder: 'html5,flash',
                // 只允许选择文件，可选。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/jpg,image/jpeg,image/png,image/gif,image/bmp'
                },
                formData: {
                    policy: $("#policy").val(),
                    signature: $("#sign").val()
                }
            });
        
            // 文件上传upyun以后，从upyun服务器获取返回值
            uploader.on('uploadAccept', function(obj, ret){
                if(ret.code == '200'){
                    $("#value_img").val(ret.url);
                    $("#show_img").attr('src', "http://image1.8264.com/"+ret.url);
                }
            });
        
            // 当validate不通过时，会以派送错误事件的形式通知调用者。
            uploader.on('error', function( handler ) {
                if(handler == 'Q_EXCEED_SIZE_LIMIT'){
                    alert("文件太大，请选择小于9M的文件");
                }
            });
        });
    </script>

    <script>
	function validate(obj) {	
		//标题
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('分类名称不能为空！');
			return false;
		}

        //是否显示
        var qtype = jQuery("input[name=qtype]:checked").val();
        if(qtype == ''){
            alert('请选择是否显示！');
            return false;
        }
        
		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
	<style>
	    .webuploader-container {
            position: relative;
        }
        .webuploader-element-invisible {
            position: absolute !important;
            clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
            clip: rect(1px,1px,1px,1px);
        }
        .webuploader-pick {
            position: relative;
            display: inline-block;
            cursor: pointer;
            background: #00b7ee;
            padding: 8px 15px;
            font-size: 12px;
            color: #fff;
            text-align: center;
            width:85px;
            border-radius: 3px;
            overflow: hidden;
        }
        .webuploader-pick-hover {
            background: #00a2d4;
        }
        
        .webuploader-pick-disable {
            opacity: 0.6;
            pointer-events:none;
        }
	</style>
EOT;

    showformheader('exam&operation=editcategory', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('分类名称', 'title', "$row[catname]", 'text', '', '', '', 'style="width:547px;"');
    showsetting('参加人数', 'join_nums', "$row[join_nums]", 'text', '', '', '', 'style="width:547px;"');
    showsetting('相关展示名称', 'other', "$row[other]", 'text', '', '', '', 'style="width:547px;"');
    showsetting('相关展示链接(带http://)', 'other_url', "$row[other_url]", 'text', '', '', '', 'style="width:547px;"');

    $radio ='<tr><td colspan="2" class="td27">是否显示:</td></tr>
        <tr class="noborder">
            <td class="vtop rowform">
            <input value="1" name="qtype" type="radio" '.ischecked("1", $row[is_show]).'>是&nbsp;&nbsp;&nbsp;&nbsp;
            <input value="0" name="qtype" type="radio" '.ischecked("2", $row[is_show]+2).'>否&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td class="vtop tips2"></td>
        </tr>';
    echo $radio;

    $imgbox = '<tr><td colspan="2" class="td27">列表图片:</td></tr>
        <tr class="noborder">
            <td class="vtop rowform">
                <img id="show_img" src="http://image1.8264.com/'.$row[img].'" width="600">
                <input id="value_img" type="hidden" name="img" value="'.$row[img].'">
            </td>
            <td class="vtop">
                <input type="hidden" id="policy" value="'.$policy.'">
                <input type="hidden" id="sign" value="'.$sign.'">
                <input type="hidden" id="action" value="'.$action.'">
                
                <input type="hidden" id="cid" name="cid" value="'.$_GET[cid].'">
                
                <span id="filePicker">上传图片</span>
            </td>
        </tr>';
    echo $imgbox;


    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}


if($operation == 'peixunlist'){
    //页面展示
    cpheader();
    shownav('topic', '线下培训');
    top_nav(3);

    showformheader('exam&operation=questionlist','onsubmit="return subcheck(this);"');
    showtableheader();
    showsubtitle(array('', 'ID','标题', '活动地点', '活动时间', '创建时间', '操作'));

    $sql = "SELECT * FROM " . DB::table('exam_peixun') . " where is_show = 1 ORDER BY id DESC " . getSlaveID();
    $query = DB::query($sql);
    while ($value = DB::fetch($query)) {
        $date_arr = explode("-", $value['date']);
        showtablerow('', array('class="td25"','width="30"'), array(
            "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
            "{$value[id]}",
            "{$value[title]}",
            "<a href=\"$value[link]\" target=\"_blank\">{$value[address]}</a>",
            "$date_arr[0]月-$date_arr[1]日",
            date('Y-m-d H:i',$value['createtime']),
            "<a href=\"admin.php?action=exam&operation=editpeixun&id=$value[id]\" target=\"_blank\">[编辑]</a>"
            . "<a class=\"act dodelete". $value['id'] ."\" onclick=\"delete_peixun(". $value['id'] .")\">[删除]</a>"
        ));
    }
    echo <<<SCRIPT
<script src="static/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">jQuery.noConflict();</script> 
<script type="text/Javascript">
function delete_peixun(id){
    if(id == ''){
        return false;
    }

   jQuery.ajax({
            type : 'POST',
            url : '/admin.php?action=exam&operation=deletepeixun',
            data : {id:id},
            success:function(result){
                    result = eval("("+result+")");
                    if(result.flag == '1'){
                        jQuery(".dodelete"+result.id).parent().parent().remove();
                    }
            }
    });
}                        
</script>
SCRIPT;

    showtablefooter();
    echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=addpeixun\">增加线下培训</a></div>";
    showformfooter();
}

if($operation == 'editpeixun'){
    //页面展示
    cpheader();
    shownav('topic', '编辑培训');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);

        $title = $_POST['title'];
        $address = $_POST['address'];
        $img = $_POST['img'];
        $m = intval($_POST['m']);
        $d = intval($_POST['d']);
        $link = $_POST['link'];

        $url = "action=exam&operation=peixunlist";
        if(!$title || !$address || !$img || !$m || !$d || !$link){
            cpmsg('填写信息有误', $url, 'error');
        }
        $date = $m."-".$d;
        $datetime = strtotime(date('Y').'-'.$date.' 23:59:59');
        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $url, 'error');
        }
        DB::update('exam_peixun', array('title' => $title, 'address' => $address, 'img' => $img, 'date' => $date, 'datetime'=> $datetime, 'link' => $link ), "id='{$id}'");

        $url = preg_replace('/\/admin\.php\?/i', '', $url);
        cpmsg('修改成功！', $url, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('操作失败,id非法', 'action=exam&operation=peixunlist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_peixun') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);

    $date_arr = explode("-", $row['date']);

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//标题
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('标题不能为空！');
			return false;
		}
    
                //地点
                var address = jsTrim(jQuery("input[name=address]").val());
		jQuery("input[name=address]").val(address);
		if(address == ''){
			alert('地点不能为空！');
			return false;
		}
    
                //图片链接
                var img = jsTrim(jQuery("input[name=img]").val());
		jQuery("input[name=img]").val(img);
		if(img == ''){
			alert('图片链接不能为空！');
			return false;
		}
    
                //日期
                var m = jsTrim(jQuery("input[name=m]").val());
		jQuery("input[name=m]").val(m);
    
                var d = jsTrim(jQuery("input[name=d]").val());
		jQuery("input[name=d]").val(d);
		if(m == '' || d == ''){
			alert('日期不能为空！');
			return false;
		}
    
                //目标链接
                var link = jsTrim(jQuery("input[name=link]").val());
		jQuery("input[name=link]").val(link);
		if(link == ''){
			alert('目标链接不能为空！');
			return false;
		}
    
		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
    
        function yulanimg(){
            var img = jQuery("#img").val();
            jQuery("#yulan").attr('src', img);
        }
    
	</script>
EOT;

    //showtips('<li>选项之间用“|”隔开。例如：A、是|B、否</li>');
    showformheader('exam&operation=editpeixun&id='.$id, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('线下培训标题', 'title', "$row[title]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('线下培训地点', 'address', "$row[address]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">图片链接:(宽高：702*350，带 http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="$row[img]" height="200px" /></div>
        </td>
    </tr>
    <tr><td colspan="2" class="td27">培训日期:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div>
                <input name="m" value="$date_arr[0]" type="text" class="txt" style="width:30px;">月
                <input name="d" value="$date_arr[1]" type="text" class="txt" style="width:30px;">日
            </div>
        </td>
    </tr>
    <tr><td colspan="2" class="td27">目标链接:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input name="link" value="$row[link]" type="text" class="txt" style="width:600px;">
        </td>
    </tr>
    
EOT;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'addpeixun'){
    //页面展示
    cpheader();
    shownav('topic', '添加培训');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $title = $_POST['title'];
        $address = $_POST['address'];
        $img = $_POST['img'];
        $m = intval($_POST['m']);
        $d = intval($_POST['d']);
        $link = $_POST['link'];

        $url = "action=exam&operation=peixunlist";
        if(!$title || !$address || !$img || !$m || !$d || !$link){
            cpmsg('填写信息不全', $url, 'error');
        }
        $date = $m."-".$d;
        $datetime = strtotime(date('Y').'-'.$date.' 23:59:59');
        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $url, 'error');
        }

        $createtime = time();

        DB::query("INSERT INTO " . DB::table('exam_peixun') . "
			(title, address, img, date, datetime, link, uid, createtime)
			VALUES ('{$title}', '{$address}', '{$img}', '{$date}', '{$datetime}', '{$link}', '$uid', '$createtime')");
        $id = DB::insert_id();

        cpmsg('添加成功！', $url, 'succeed');
    }

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//标题
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('标题不能为空！');
			return false;
		}
    
                //地点
                var address = jsTrim(jQuery("input[name=address]").val());
		jQuery("input[name=address]").val(address);
		if(address == ''){
			alert('地点不能为空！');
			return false;
		}
    
                //图片链接
                var img = jsTrim(jQuery("input[name=img]").val());
		jQuery("input[name=img]").val(img);
		if(img == ''){
			alert('图片链接不能为空！');
			return false;
		}
    
                //日期
                var m = jsTrim(jQuery("input[name=m]").val());
		jQuery("input[name=m]").val(m);
    
                var d = jsTrim(jQuery("input[name=d]").val());
		jQuery("input[name=d]").val(d);
		if(m == '' || d == ''){
			alert('日期不能为空！');
			return false;
		}
    
                //目标链接
                var link = jsTrim(jQuery("input[name=link]").val());
		jQuery("input[name=link]").val(link);
		if(link == ''){
			alert('目标链接不能为空！');
			return false;
		}
    
		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
    
        function yulanimg(){
            var img = jQuery("#img").val();
            jQuery("#yulan").attr('src', img);
        }
    
	</script>
EOT;

    //showtips('<li>选项之间用“|”隔开。例如：A、是|B、否</li>');
    showformheader('exam&operation=addpeixun', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('线下培训标题', 'title', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('线下培训地点', 'address', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">图片链接: (宽高：702*350，带 http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
    <tr><td colspan="2" class="td27">培训日期:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div>
                <input name="m" value="" type="text" class="txt" style="width:30px;">月
                <input name="d" value="" type="text" class="txt" style="width:30px;">日
            </div>
        </td>
    </tr>
    <tr><td colspan="2" class="td27">目标链接: (带 http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input name="link" value="" type="text" class="txt" style="width:600px;">
        </td>
    </tr>
    
EOT;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'deletepeixun'){
    if($_POST['id'] && $_G['uid']){
        DB::update('exam_peixun', array('is_show' => 0), "id='{$_POST['id']}'");
        echo json_encode(array('id' => $_POST['id'], 'flag' => 1));die();
    }
}

if($operation == 'shizilist'){
    //页面展示
    cpheader();
    shownav('topic', '试题列表');
    top_nav(4);
    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation=shizilist&&perpage={$perpage}&page={$page}";

        if ($_G['gp_optype'] == 'trash' && $ids) {

            DB::update('exam_shizi', array('is_show'=>0), "id in ({$ids})");
            cpmsg('下线成功', $url, 'succeed');
        } else {
            cpmsg('article_choose_at_least_one_operation', $url, 'error');
        }
    }else{
        //表单框架
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function subcheck(obj) {
		//操作类别
		var op = jsTrim(jQuery("input[name=optype]:checked").val());
		if(op == 'trash'){
			if(confirm("删除是不可恢复的，你确认要删除吗？")){
                            return true;
                        }else{
                            return false;
                        }
		}
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
EOT;
        $cat_array = questiontype(1);

        $mpurl = ADMINSCRIPT . '?action=exam&operation=' . $operation;
        $perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
        $page = max($_G['gp_page'], 1);
        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        $searchtid 	 = empty($_G['gp_searchtid']) ? 0 : intval($_G['gp_searchtid']);
        $selectcat 	 = $_G['gp_selectcat'];
        if (!in_array($perpage, array(10, 20, 50, 100)))
            $perpage = 50;

        $start = ($page - 1) * $perpage;
        $mpurl .= '&perpage=' . $perpage;
        if($selectcat){
            $mpurl .= '&selectcat=' . $selectcat;
        }

        $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">师资ID&nbsp;&nbsp;';
        $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
        $extraStr .= '<input type="hidden" name="action" value="exam"/>';
        $extraStr .= '<input type="hidden" name="operation" value="shizilist"/>';
        $extraStr .= '<input type="text" name="id" value="'.$id.'" style="height:18px;width:85px;vertical-align:middle;" placeholder="填写ID" />&nbsp;&nbsp;';
        $extraStr .= '&nbsp;&nbsp;类别&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">请选择类别</option>';
        foreach ($cat_array as $k=>$v) {
            $selectStr = $selectcat == $k ? 'selected=\"selected\"' : '';
            $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
        }
        $extraStr .= '</select>&nbsp;&nbsp;';
        $extraStr .= '<input type="submit" value="查询" style="cursor:pointer;" /></form></div>';
        echo $extraStr;

        showformheader('exam&operation=shizilist','');
        showtableheader();
        showsubtitle(array('', 'ID','类别', '姓名', '俱乐部', '创建时间', '操作'));

        $and = '';
        $multipage = '';

        if($id){
            $and .= ' AND id = '.$id;
        }
        if($selectcat){
            $and .= ' AND catid = '.$selectcat;
        }
        $count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('exam_shizi') . " WHERE is_show=1 ". $and . getSlaveID());
        if($count){
            $sql = "SELECT * FROM " . DB::table('exam_shizi') . " WHERE is_show = 1 ". $and ." ORDER BY id DESC LIMIT {$start},{$perpage} " . getSlaveID();
            $query = DB::query($sql);
            while ($value = DB::fetch($query)) {
                showtablerow('', array('class="td25"','width="30"'), array(
                    "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
                    "{$value[id]}",
                    "{$cat_array[$value[catid]]}",
                    "<a href=\"\" target=\"_blank\">{$value[name]}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"admin.php?action=exam&operation=editshizi&id=$value[id]\" target=\"_blank\">[编辑]</a>",
                    $value['club'],
                    date('Y-m-d H:i',$value['createtime']),
                    "<a href=\"admin.php?action=exam&operation=editshizi&id=$value[id]\" target=\"_blank\">[编辑]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" onclick="radio_click(this)" /><label for="optype_trash">删除</label>&nbsp;&nbsp;&nbsp;&nbsp;';

        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
        showtablefooter();
        echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=addshizi\">增加师资力量</a></div>";
        showformfooter();
    }

}

if($operation == 'addshizi'){
    //页面展示
    cpheader();
    shownav('topic', '增加师资力量');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $name = trim($_POST['name']);
        $catid = intval($_POST['catid']);
        $intro = trim($_POST['intro']);
        $club = trim($_POST['club']);
        $img = trim($_POST['img']);

        $inst_id = (int)$_POST['inst_id'] > 0 ? $_POST['inst_id'] : 0;

        $url = "action=exam&operation=shizilist";

        if(!$name || !$catid || !$img || !$intro){
            cpmsg('填写信息不全', $url, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $url, 'error');
        }

        $createtime = time();

        DB::query("INSERT INTO " . DB::table('exam_shizi') . "
			(catid, name, intro, club, img, uid, is_show, createtime,inst_id)
			VALUES ('$catid', '{$name}', '{$intro}', '{$club}', '{$img}', '$uid', '1', '$createtime','$inst_id')");
        $id = DB::insert_id();

        $url = preg_replace('/\/admin\.php\?/i', '', $url);
        cpmsg('添加成功！', $url, 'succeed');
    }

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
	    edit_save();
		//标题
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('培训师不能为空！');
			return false;
		}
    
                //分类
                var catid = jQuery("#catid").val();
                if(catid == '0'){
                        alert('请选择试题分类！');
                        return false;
                }
    
                //简介
                var intro = jsTrim(jQuery(".intro").val());
                if(intro == ''){
                        alert('简介不能为空！');
                        return false;
                }
    
                //俱乐部
                var club = jsTrim(jQuery("input[name=club]").val());
                if(club == ''){
                        alert('俱乐部名不能为空！');
                        return false;
                }
    
                //图片
                var img = jsTrim(jQuery("input[name=img]").val());
                if(img == ''){
                        alert('图片链接不能为空！');
                        return false;
                }
    
		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
    
        function yulanimg(obj){
            var img = jQuery("#"+obj).val();
            jQuery("#yulan").attr('src', img);
        }
	</script>
EOT;

    showformheader('exam&operation=addshizi', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('培训师', 'name', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('培训类目', '', '', '<select id="catid" name="catid"><option value="0">'."请选择分类".'</option>'.questiontype(2, $row['catid']).'</select>');
    showsetting('合作机构(添加合作机构里面的师资的时候选中，其他的时候非必填)', '', '', '<select id="inst_id" name="inst_id"><option value="0">'."请选择合作机构".'</option>'.institutions(2, 0).'</select>');
    showtablerow('', array('class="td27" colspan="2"'), array('简介：<textarea class="intro" name="intro" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showsetting('俱乐部名', 'club', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOF
    <tr><td colspan="2" class="td27">封面图片链接:(宽高：190*270，带http:// )</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg('img')" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOF;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editshizi'){
    //页面展示
    cpheader();
    shownav('topic', '编辑师资');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        $name = trim($_POST['name']);
        $catid = intval($_POST['catid']);
        $intro = trim($_POST['intro']);
        $club = trim($_POST['club']);
        $img = trim($_POST['img']);

        $inst_id = (int)$_POST['inst_id'] > 0 ? $_POST['inst_id'] : 0;

        $url = "action=exam&operation=shizilist";

        if(!$name || !$catid || !$img || !$intro){
            cpmsg('填写信息不全', $url, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $url, 'error');
        }

        DB::update('exam_shizi', array('catid' => $catid, 'name' => $name, 'intro' => $intro, 'img' => $img, 'club' => $club, 'inst_id' => $inst_id), "id='{$id}'");

        $url = preg_replace('/\/admin\.php\?/i', '', $url);
        cpmsg('修改成功！', $url, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('操作失败,id非法', 'action=exam&operation=shizilist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_shizi') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
	    edit_save();
		//标题
		var name = jsTrim(jQuery("input[name=name]").val());
		if(name == ''){
			alert('培训师不能为空！');
			return false;
		}
    
                //分类
                var catid = jQuery("#catid").val();
                if(catid == '0'){
                        alert('11');
                        return false;
                }
    
                //简介
                var intro = jsTrim(jQuery(".intro").val());
                if(intro == ''){
                        alert('简介不能为空！');
                        return false;
                }

                //俱乐部
                var club = jsTrim(jQuery("input[name=club]").val());
                if(club == ''){
                        alert('俱乐部名不能为空！');
                        return false;
                }
    
                //图片
                var img = jsTrim(jQuery("input[name=img]").val());
                if(img == ''){
                        alert('图片链接不能为空！');
                        return false;
                }
    
		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
    function yulanimg(obj){
        var img = jQuery("#"+obj).val();
        jQuery("#yulan").attr('src', img);
    }
	</script>
EOT;

    //showtips('<li>选项之间用“|”隔开。例如：A、是|B、否</li>');
    showformheader('exam&operation=editshizi&id='.$id, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('培训师', 'name', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('培训类目', '', '', '<select id="catid" name="catid"><option value="0">'."请选择分类".'</option>'.questiontype(2, $row['catid']).'</select>');
    showsetting('合作机构(添加合作机构里面的师资的时候选中，其他的时候非必填)', '', '', '<select id="inst_id" name="inst_id"><option value="0">'."请选择合作机构".'</option>'.institutions(2, $row['inst_id']).'</select>');
    showtablerow('', array('class="td27" colspan="2"'), array('简介：<textarea class="intro" name="intro" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px">'.$row[intro].'</textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showsetting('俱乐部名', 'club', "$row[club]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOF
    <tr><td colspan="2" class="td27">封面图片链接:(宽高：190*270，带http:// )</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg('img')" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="$row[img]" height="200px" /></div>
        </td>
    </tr>
EOF;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editarticlecategory'){
    //页面展示
    cpheader();
    shownav('topic', '文章列表');
    top_nav(999);

    if(!submitcheck('submit')) {
        $catid = intval($_GET['cid']);

        if($catid > 0){
            $category = getcategory();
            $catname = $category[$catid]['catname'];
        }

        $tips = "<table class=\"tb tb2 \" id=\"tips\"><tbody><tr><th class=\"partition\">当前分类</th></tr><tr><td class=\"tipsblock\"><ul id=\"tipslis\"><li>".$catname."</li></ul></td></tr></tbody></table>";
        echo $tips;

        showformheader('exam&operation=editarticlecategory&do=edit');
        echo "<input type='hidden' name='cid' value=\"$catid\">";

        showtableheader();
        showsubtitle(array('分类ID', '显示顺序(数字越大越靠前)', '文章分类名称', '操作'));
        $navlist = $subnavlist = $pluginsubnav = array();
        $query = DB::query("SELECT * FROM ".DB::table('exam_article')." where catid = ".$catid." ORDER BY displayorder desc,id asc");
        while($nav = DB::fetch($query)) {
            if($nav['fid']) {
                $subnavlist[$nav['fid']][] = $nav;
            } else {
                $navlist[$nav['id']] = $nav;
            }
        }

        foreach($navlist as $nav) {
            $navsubtype = array();
            $navsubtype[$nav['subtype']] = 'selected="selected"';
            showtablerow('', array('class="td25"','', '', ''), array(
                "$nav[id]",
                "<input type=\"text\" class=\"txt\" size=\"2\" name=\"displayordernew[$nav[id]]\" value=\"$nav[displayorder]\">",
                "<div><input type=\"text\" class=\"txt\" size=\"15\" name=\"namenew[$nav[id]]\" value=\"".dhtmlspecialchars($nav['name'])."\">"
                ."<a href=\"###\" onclick=\"addrowdirect=1;addrow(this, 1, $nav[id])\" class=\"addchildboard\">添加文章</a></div>",
                "<a href='admin.php?action=exam&operation=deletearticlecategory&id=".$nav[id]."&cid=".$catid."'>删除</a>"
            ));
            if(!empty($subnavlist[$nav['id']])) {
                $subnavnum = count($subnavlist[$nav['id']]);
                foreach($subnavlist[$nav['id']] as $sub) {
                    $subnavnum--;
                    showtablerow('', array('class="td25"', '', '', ''), array(
                        "$sub[id]",
                        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" class=\"txt\" size=\"2\" name=\"displayordernew[$sub[id]]\" value=\"$sub[displayorder]\">",
                        "<div class=\"".($subnavnum ? 'board' : 'lastboard')."\"><input type=\"text\" class=\"txt\" size=\"15\" name=\"namenew[$sub[id]]\" value=\"".dhtmlspecialchars($sub['name'])."\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" class=\"txt\" size=\"15\" name=\"aidnew[$sub[id]]\" value=\"$sub[aid]\"></div>",
                        "<a href='admin.php?action=exam&operation=deletearticlecategory&id=".$sub[id]."&cid=".$catid."'>删除</a>"
                    ));
                }
            }
        }
        echo '<tr><td colspan="1"></td><td colspan="8"><div><a href="###" onclick="addrow(this, 0, 0)" class="addtr">添加分类</a></div></td></tr>';
        showsubmit('submit', 'submit', 'del');
        showtablefooter();
        showformfooter();

        $langs = array();
        $keys = array('albumcategory_addcategory', 'albumcategory_addsubcategory');
        foreach ($keys as $key) {
            $langs[$key] = cplang($key);
        }
        echo <<<SCRIPT
<script src="static/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">jQuery.noConflict();</script>                
<script type="text/Javascript">
var rowtypedata = [
	[[1,'', 'td25'], [1,'<input type="text" class="txt" name="neworder[{1}][]" value="0" />', ''], [3, '<div class="parentboard"><input type="text" class="txt" value="$lang[albumcategory_addcategory]" name="newname[{1}][]"/></div>']],
	[[1,'', 'td25'], [1,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="txt" name="neworder[{1}][]" value="0" />', ''], [3, '<div class="board"><input type="text" class="txt" value="添加文章名" name="newname[{1}][]"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="txt" size="15" name="newaid[{1}][]" value="添加文章id"></div>']],
];

</script>
SCRIPT;

    } else {

        if($_G['gp_do'] == 'edit'){
            $catid = intval($_POST["cid"]);

            if($_POST['displayordernew']){
                $sql = "update ".DB::table('exam_article')." set displayorder = case id ";
                foreach($_POST['displayordernew'] as $k=>$v){
                    $v = trim($v);
                    $sql .= " when ".$k." then ".$v." ";
                }
                $ids = implode(",", array_keys($_POST['displayordernew']));
                $sql .= " END where id in (".$ids.")";

                DB::query($sql);
            }

            if($_POST['namenew']){
                $sql = "update ".DB::table('exam_article')." set name = case id ";
                foreach($_POST['namenew'] as $k=>$v){
                    $v = trim($v);
                    $sql .= " when ".$k." then '".$v."' ";
                }
                $ids = implode(",", array_keys($_POST['namenew']));
                $sql .= " END where id in (".$ids.")";

                DB::query($sql);
            }

            if($_POST['aidnew']){
                $sql = "update ".DB::table('exam_article')." set aid = case id ";
                foreach($_POST['aidnew'] as $k=>$v){
                    $v = trim($v);
                    $sql .= " when ".$k." then '".$v."' ";
                }
                $ids = implode(",", array_keys($_POST['aidnew']));
                $sql .= " END where id in (".$ids.")";

                DB::query($sql);
            }

            if($_POST['neworder'] && $_POST['newname']){
                foreach($_POST['neworder'] as $k=>$v){
                    if($k == '0'){
                        if(is_array($v)){
                            foreach($v as $ke=>$va){
                                DB::insert('exam_article', array('fid' => 0, 'name' => trim($_POST['newname'][$k][$ke]), 'catid' => $catid, 'displayorder'=>intval($va), 'uid' => $_G['uid'], 'createtime'=>time() ));
                            }
                        }
                    }else{
                        if(is_array($v) && $_POST['newaid']){
                            foreach($v as $ke=>$va){
                                DB::insert('exam_article', array('fid' => $k, 'name' => trim($_POST['newname'][$k][$ke]), 'catid' => $catid, 'aid' => intval($_POST['newaid'][$k][$ke]), 'displayorder'=>intval($va), 'uid' => $_G['uid'], 'createtime'=>time()));
                            }
                        }
                    }
                }
            }

            cpmsg('提交成功', 'action=exam&operation=editarticlecategory&cid='.$catid, 'succeed');
        }

    }

}

if($operation == 'deletearticlecategory'){
    //页面展示
    cpheader();
    shownav('topic', '');
    top_nav(999);

    $catid = intval($_GET['cid']);
    $id = intval($_GET['id']);

    DB::query("delete from ".DB::table('exam_article')." where id = $id");
    DB::query("delete from ".DB::table('exam_article')." where fid = $id");


    cpmsg('删除成功', 'action=exam&operation=editarticlecategory&cid='.$catid, 'succeed');
}

if($operation == 'deletecorrection'){
    if($_POST['id'] && $_G['uid']){
        DB::delete('exam_correction', array('id' => $_POST['id']));
        echo json_encode(array('id' => $_POST['id'], 'flag' => 1));die();
    }
}

if($operation == 'examerror'){
    //页面展示
    cpheader();
    shownav('topic', '试题纠错');
    top_nav(5);
    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation={$operation}&&perpage={$perpage}&page={$page}";

        if($ids && $_G['gp_optype'] == 'trash'){
            DB::delete('exam_correction', "id in ({$ids})");
            cpmsg('删除成功', $url, 'succeed');
        }else{
            cpmsg('请选择信息！', $url, 'error');
        }
    }else{
        $mpurl = ADMINSCRIPT . '?action=exam&operation=' . $operation;
        $perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
        $page = max($_G['gp_page'], 1);
        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        $searchtid 	 = empty($_G['gp_searchtid']) ? 0 : intval($_G['gp_searchtid']);
        $selectcat 	 = $_G['gp_selectcat'];
        if (!in_array($perpage, array(10, 20, 50, 100)))
            $perpage = 50;

        $start = ($page - 1) * $perpage;
        $mpurl .= '&perpage=' . $perpage;

        if($selectcat){
            $mpurl .= '&selectcat=' . $selectcat;
        }
        showformheader('exam&operation=examerror','onsubmit="return subcheck(this);"');
        showtableheader();
        showsubtitle(array('', 'ID','标题', '纠错内容', '创建时间', '操作'));

        $count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('exam_correction') . getSlaveID());
        $multipage = multi($count, $perpage, $page, $mpurl);

        $sql = "SELECT * FROM " . DB::table('exam_correction') . " ORDER BY create_time DESC LIMIT {$start},{$perpage}" . getSlaveID();
        $query = DB::query($sql);
        while ($value = DB::fetch($query)) {

            showtablerow('', array('class="td25"','width="30"','width="500"','width="500"'), array(
                "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
                "{$value['qid']}",
                "{$value['question']}",
                "{$value['error_content']}",
                date('Y-m-d H:i',$value['create_time']),
                "<a href=\"admin.php?action=exam&operation=editquestion&qid=$value[qid]\" target=\"_blank\">[编辑]</a>"
                . "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"delete_correction(". $value['id'] .")\">[删除]</a>"
            ));
        }

        echo <<<SCRIPT
<script src="static/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script type="text/Javascript">
function delete_correction(id){
    if(id == ''){
        return false;
    }

   jQuery.ajax({
            type : 'POST',
            url : '/admin.php?action=exam&operation=deletecorrection',
            data : {id:id},
            success:function(result){
                    result = eval("("+result+")");
                    if(result.flag == '1'){
                        jQuery(".dodelete"+result.id).parent().parent().remove();
                    }
            }
    });
}
</script>
SCRIPT;
        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" /><label for="optype_trash">删除</label>&nbsp;&nbsp;&nbsp;&nbsp;';
        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);

        showtablefooter();
        showformfooter();
    }

}

if($operation == 'deletevideo'){
    if($_POST['id'] && $_G['uid']){
        DB::delete('exam_video', array('id' => $_POST['id']));
        echo json_encode(array('id' => $_POST['id'], 'flag' => 1));die();
    }
}

if($operation == 'updownvideo'){
    if($_POST['id'] && $_G['uid']){
        DB::update('exam_video', array('is_show' => $_POST['is_show']), "id='{$_POST['id']}'");
        echo json_encode(array('id' => $_POST['id'], 'flag' => 1));die();
    }
}

if($operation == 'videolist'){
    //页面展示
    cpheader();
    shownav('topic', '视频回顾列表');
    top_nav(6);
    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation=videolist&&perpage={$perpage}&page={$page}";

        if($ids){
            if($_G['gp_optype'] == 'trash'){
                DB::delete('exam_video', "id in ({$ids})");
                cpmsg('删除成功', $url, 'succeed');
            }elseif($_G['gp_optype'] == 'up'){
                DB::update('exam_video', array('is_show' => 1), "id in ({$ids})");
                cpmsg('上线成功', $url, 'succeed');
            }elseif($_G['gp_optype'] == 'down'){
                DB::update('exam_video', array('is_show' => 0), "id in ({$ids})");
                cpmsg('下线成功', $url, 'succeed');
            }else{
                cpmsg('请选择操作！', $url, 'error');
            }
        }else{
            cpmsg('请选择信息！', $url, 'error');
        }
    }else{
        //表单框架
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
        function subcheck(obj) {
            //操作类别
            var op = jsTrim(jQuery("input[name=optype]:checked").val());
            if(op == 'trash'){
                if(confirm("删除是不可恢复的，你确认要删除吗？")){
                                return true;
                            }else{
                                return false;
                            }
            }
        }
        //去除所有空格
        function jsTrimAll(str) {
            return str.replace(/\s+/g, '');
        }
        //去除两端空格
        function jsTrim(str) {
            return str.replace(/^\s+|\s+$/g, '');
        }
        function delete_video(id){
            if(id == ''){
                return false;
            }

           jQuery.ajax({
                    type : 'POST',
                    url : '/admin.php?action=exam&operation=deletevideo',
                    data : {id:id},
                    success:function(result){
                            result = eval("("+result+")");
                            if(result.flag == '1'){
                                jQuery(".dodelete"+result.id).parent().parent().remove();
                            }
                    }
            });
        }
        function up_down_video(id,is_show){
            if(id == ''){
                return false;
            }

           jQuery.ajax({
                    type : 'POST',
                    url : '/admin.php?action=exam&operation=updownvideo',
                    data : {id:id,is_show:is_show},
                    success:function(result){
                            result = eval("("+result+")");
                            if(result.flag == '1'){
                                window.location.reload();
                            }
                    }
            });
        }
	</script>
EOT;

        $mpurl = ADMINSCRIPT . '?action=exam&operation=' . $operation;
        $perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
        $page = max($_G['gp_page'], 1);
        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        $searchtid 	 = empty($_G['gp_searchtid']) ? 0 : intval($_G['gp_searchtid']);
        $selectcat 	 = $_G['gp_selectcat'];
        if (!in_array($perpage, array(10, 20, 50, 100)))
            $perpage = 50;

        $start = ($page - 1) * $perpage;
        $mpurl .= '&perpage=' . $perpage;
        if($selectcat){
            $mpurl .= '&selectcat=' . $selectcat;
        }

        showformheader('exam&operation=videolist','');
        showtableheader();
        showsubtitle(array('', 'ID','标题', '状态', 'vip观看次数','创建时间', '操作'));

        $multipage = '';

        $count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('exam_video') . getSlaveID());
        if($count){
            $sql = "SELECT * FROM " . DB::table('exam_video') . " ORDER BY id DESC LIMIT {$start},{$perpage} " . getSlaveID();
            $query = DB::query($sql);
            while ($value = DB::fetch($query)) {
                if($value['is_show'] == 1){
                    $op = "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"up_down_video(". $value['id'] .",0)\">[下线]</a>";
                    $status = '上线';
                }else{
                    $op = "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"up_down_video(". $value['id'] .",1)\">[上线]</a>";
                    $status = '下线';
                }
                showtablerow('', array('class="td25"','width="30"'), array(
                    "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
                    "{$value[id]}",
                    "{$value[name]}",
                    "{$status}",
                    "{$value['vip_view']}",
                    date('Y-m-d H:i',$value['createtime']),
                    "<a class='act' href=\"admin.php?action=exam&operation=editvideo&id=$value[id]\" target=\"_blank\">[编辑]</a>".
                    $op . "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"delete_video(". $value['id'] .")\">[删除]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="up" class="optype" /><label for="optype_trash">上线</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_trash" value="down" class="optype" /><label for="optype_trash">下线</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" /><label for="optype_trash">删除</label>&nbsp;&nbsp;&nbsp;&nbsp;';

        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
        showtablefooter();
        echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=addvideo\">增加视频</a></div>";
        showformfooter();
    }

}

if($operation == 'addvideo'){
    //页面展示
    cpheader();
    shownav('topic', '增加视频');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $name = trim($_POST['name']);
        $intro = trim($_POST['intro']);
        $url = trim($_POST['url']);
        $img = trim($_POST['img']);
        $view = trim($_POST['view']);
        $is_free = trim($_POST['is_free']);

        $back = "action=exam&operation=videolist";

        if(!$name || !$intro || !$url || !$img){
            cpmsg('填写信息不全', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $back, 'error');
        }

        $createtime = time();

        DB::query("INSERT INTO " . DB::table('exam_video') . "
			(name, intro, url, uid, img, view, is_show, createtime, is_free)
			VALUES ('{$name}', '{$intro}', '{$url}', '$uid', '$img', '$view', '1', '$createtime', '$is_free')");
        $id = DB::insert_id();

        $url = preg_replace('/\/admin\.php\?/i', '', $back);
        cpmsg('添加成功！', $back, 'succeed');
    }

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//标题
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('标题不能为空！');
			return false;
		}
        //视频
        var url = jsTrim(jQuery("input[name=url]").val());
        if(url == ''){
            alert('视频链接不能为空！');
            return false;
        }
        //简介
        var intro = jsTrim(jQuery("#intro").val());
        if(intro == ''){
                alert('简介不能为空！');
                return false;
        }

		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	 function yulanimg(){
        var img = jQuery("#img").val();
        jQuery("#yulan").attr('src', img);
    }
	</script>
EOT;

    showformheader('exam&operation=addvideo', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('标题', 'name', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('视频地址(mp4格式)', 'url', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">图片链接: (宽高：702*350 带 http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showsetting('观看人数', 'view', "", 'text', '', '', '', 'style="width:200px;"');
    showsetting('是否收费', '', '', '<input type="radio" value="1" name="is_free" checked>免费&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="2" name="is_free">收费');
    showtablerow('', array('class="td27" colspan="2"'), array('简介：<br><br><textarea id="intro" name="intro"  rows="6" cols="85" style=""></textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editvideo'){
    //页面展示
    cpheader();
    shownav('topic', '编辑视频');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $back = "action=exam&operation=videolist";

        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        if(!$id){
            cpmsg('非法id', $back, 'error');
        }
        $name = trim($_POST['name']);
        $intro = trim($_POST['intro']);
        $url = trim($_POST['url']);
        $img = trim($_POST['img']);
        $view = trim($_POST['view']);
        $is_free = trim($_POST['is_free']);

        if(!$name || !$intro || !$url || !$img || !$view){
            cpmsg('填写信息不全', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $back, 'error');
        }

        DB::update('exam_video', array('name' => $name, 'intro' => $intro, 'url' => $url, 'img' => $img, 'view' => $view, 'is_free' => $is_free), "id='{$id}'");

        $url = preg_replace('/\/admin\.php\?/i', '', $back);
        cpmsg('修改成功！', $back, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('操作失败,id非法', 'action=exam&operation=videolist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_video') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);
    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//标题
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('标题不能为空！');
			return false;
		}
        //视频
        var url = jsTrim(jQuery("input[name=url]").val());
        if(url == ''){
            alert('视频链接不能为空！');
            return false;
        }
        //简介
        var intro = jsTrim(jQuery("#intro").val());
        if(intro == ''){
                alert('简介不能为空！');
                return false;
        }

		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	 function yulanimg(){
        var img = jQuery("#img").val();
        jQuery("#yulan").attr('src', img);
    }
	</script>
EOT;

    showformheader('exam&operation=editvideo&id='.$id, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('标题', 'name', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('视频地址(mp4格式)', 'url', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">图片链接: (宽高：702*350 带 http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showsetting('观看人数', 'view', "$row[view]", 'text', '', '', '', 'style="width:200px;"');
    $radio ='<tr><td colspan="2" class="td27">是否收费:</td></tr>
        <tr class="noborder"><td class="vtop rowform">
        <input value="1" name="is_free" type="radio" '.ischecked("1", $row[is_free]).'>免费&nbsp;&nbsp;&nbsp;&nbsp;
        <input value="2" name="is_free" type="radio" '.ischecked("2", $row[is_free]).'>收费';
    echo $radio;
    showtablerow('', array('class="td27" colspan="2"'), array('简介：<br><br><textarea id="intro" name="intro"  rows="6" cols="85" style="">'.$row[intro].'</textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();
}

if($operation == 'deleteinstitutions'){
    if($_POST['id'] && $_G['uid']){
        DB::delete('exam_institutions', array('id' => $_POST['id']));
        echo json_encode(array('id' => $_POST['id'], 'flag' => 1));die();
    }
}

if($operation == 'updowninstitutions'){
    if($_POST['id'] && $_G['uid']){
        DB::update('exam_institutions', array('is_show' => $_POST['is_show']), "id='{$_POST['id']}'");
        echo json_encode(array('id' => $_POST['id'], 'flag' => 1));die();
    }
}

if($operation == 'institutionslist'){
    //页面展示
    cpheader();
    shownav('topic', '合作机构列表');
    top_nav(7);
    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation=institutionslist&&perpage={$perpage}&page={$page}";

        if($ids){
            if($_G['gp_optype'] == 'trash'){
                DB::delete('exam_institutions', "id in ({$ids})");
                cpmsg('删除成功', $url, 'succeed');
            }elseif($_G['gp_optype'] == 'up'){
                DB::update('exam_institutions', array('is_show' => 1), "id in ({$ids})");
                cpmsg('上线成功', $url, 'succeed');
            }elseif($_G['gp_optype'] == 'down'){
                DB::update('exam_institutions', array('is_show' => 0), "id in ({$ids})");
                cpmsg('下线成功', $url, 'succeed');
            }else{
                cpmsg('请选择操作！', $url, 'error');
            }
        }else{
            cpmsg('请选择信息！', $url, 'error');
        }
    }else{
        //表单框架
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
        function subcheck(obj) {
            //操作类别
            var op = jsTrim(jQuery("input[name=optype]:checked").val());
            if(op == 'trash'){
                if(confirm("删除是不可恢复的，你确认要删除吗？")){
                                return true;
                            }else{
                                return false;
                            }
            }
        }
        //去除所有空格
        function jsTrimAll(str) {
            return str.replace(/\s+/g, '');
        }
        //去除两端空格
        function jsTrim(str) {
            return str.replace(/^\s+|\s+$/g, '');
        }
        function delete_institutions(id){
            if(id == ''){
                return false;
            }

           jQuery.ajax({
                    type : 'POST',
                    url : '/admin.php?action=exam&operation=deleteinstitutions',
                    data : {id:id},
                    success:function(result){
                            result = eval("("+result+")");
                            if(result.flag == '1'){
                                jQuery(".dodelete"+result.id).parent().parent().remove();
                            }
                    }
            });
        }
        function up_down_institutions(id,is_show){
            if(id == ''){
                return false;
            }

           jQuery.ajax({
                    type : 'POST',
                    url : '/admin.php?action=exam&operation=updowninstitutions',
                    data : {id:id,is_show:is_show},
                    success:function(result){
                            result = eval("("+result+")");
                            if(result.flag == '1'){
                                window.location.reload();
                            }
                    }
            });
        }
	</script>
EOT;

        $mpurl = ADMINSCRIPT . '?action=exam&operation=' . $operation;
        $perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
        $page = max($_G['gp_page'], 1);
        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        $searchtid 	 = empty($_G['gp_searchtid']) ? 0 : intval($_G['gp_searchtid']);
        $selectcat 	 = $_G['gp_selectcat'];
        if (!in_array($perpage, array(10, 20, 50, 100)))
            $perpage = 50;

        $start = ($page - 1) * $perpage;
        $mpurl .= '&perpage=' . $perpage;

        showformheader('exam&operation=institutionslist','');
        showtableheader();
        showsubtitle(array('', 'ID','标题', '排序', '状态', '创建时间', '操作'));

        $multipage = '';

        $count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('exam_institutions') . getSlaveID());
        if($count){
            $sql = "SELECT * FROM " . DB::table('exam_institutions') . " ORDER BY sort DESC LIMIT {$start},{$perpage} " . getSlaveID();
            $query = DB::query($sql);
            while ($value = DB::fetch($query)) {
                if($value['is_show'] == 1){
                    $op = "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"up_down_institutions(". $value['id'] .",0)\">[下线]</a>";
                    $status = '上线';
                }else{
                    $op = "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"up_down_institutions(". $value['id'] .",1)\">[上线]</a>";
                    $status = '下线';
                }
                showtablerow('', array('class="td25"','width="30"'), array(
                    "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
                    "{$value[id]}",
                    "{$value[name]}",
                    "{$value[sort]}",
                    "{$status}",
                    date('Y-m-d H:i',$value['createtime']),
                    "<a class='act' href=\"admin.php?action=exam&operation=editinstitutions&id=$value[id]\" target=\"_blank\">[编辑]</a>".
                    $op . "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"delete_institutions(". $value['id'] .")\">[删除]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="up" class="optype" /><label for="optype_trash">上线</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_trash" value="down" class="optype" /><label for="optype_trash">下线</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" /><label for="optype_trash">删除</label>&nbsp;&nbsp;&nbsp;&nbsp;';

        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
        showtablefooter();
        echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=addinstitutions\">增加合作机构</a></div>";
        showformfooter();
    }

}

if($operation == 'addinstitutions'){
    //页面展示
    cpheader();
    shownav('topic', '增加合作机构');
    top_nav(999);

    if (submitcheck('addsubmit')) {

        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $intro = trim($_POST['intro']);
        $img = trim($_POST['img']);
        $province = $_POST['province'];
        $institutions = $_POST['institutions_type'];
        $other = trim($_POST['other']);
        $other_url = trim($_POST['other_url']);
        $sort = (int) $_POST['sort'];


        $url= "action=exam&operation=institutionslist";

        if(!$name || !$address || !$intro || !$img || !$province || !$institutions){
            cpmsg('填写信息不全', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $url, 'error');
        }

        $createtime = time();
        $data = array(
            'name' => $name,
            'address' => $address,
            'intro' => $intro,
            'img' => $img,
            'uid' => $uid,
            'createtime' => $createtime,
            'province' => $province,
            'province_zh' => get_province_name($province),
            'type_fx' => (int)$institutions['fx'],
            'type_sd' => (int)$institutions['sd'],
            'type_hzjg' => (int)$institutions['hzjg'],
            'other' => $other ? $other : '',
            'other_url' => $other_url ? $other_url : '',
            'sort' => $sort ? $sort : 0
        );
        $id = DB::insert('exam_institutions', $data);
        $id ? cpmsg('添加成功！', $url, 'succeed') : cpmsg('添加失败！请联系管理员', $url, 'error');
    }

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
        edit_save();
		//标题
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('标题不能为空！');
			return false;
		}
       //类型
        var type = jQuery(".checkbox:checked").val();
        if(!type){
            alert('请至少选中一个机构类型！');
            return false;
        }
        //省份
        var province = jQuery("select[name=province]").val();
        if(province == '0'){
                alert('请选择省份！');
                return false;
        }
        //地址
        var address = jsTrim(jQuery("input[name=address]").val());
        if(address == ''){
            alert('地址不能为空！');
            return false;
        }
        //图片
        var url = jsTrim(jQuery("input[name=img]").val());
        if(url == ''){
            alert('图片链接不能为空！');
            return false;
        }
        //简介
        var intro = jsTrim(jQuery(".intro").val());
        if(intro == ''){
                alert('简介不能为空！');
                return false;
        }

		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
    function yulanimg(){
        var img = jQuery("#img").val();
        jQuery("#yulan").attr('src', img);
    }
	</script>
EOT;

    showformheader('exam&operation=addinstitutions', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('标题', 'name', "", 'text', '', '', '', 'style="width:600px;"');
    $hzjg = '
            <tr><td colspan="2" class="td27">类型:</td></tr>
            <tr class="noborder">
                <td colspan="2" class="vtop rowform">
                    <ul class="nofloat" onmouseover="altStyle(this);" style="width: 830px">
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[fx]" value="1" type="checkbox">&nbsp;分校</li>
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[sd]" value="1" type="checkbox">&nbsp;试点</li>
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[hzjg]" value="1" type="checkbox">&nbsp;合作机构</li>
                    </ul>
                </td>
            </tr>';
    echo $hzjg;
    $pro  = province_select();

    showsetting('省份', array('province', $pro), '', 'select');
    showsetting('地址', 'address', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('其他展示', 'other', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('其他展示链接', 'other_url', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('排序(数字：值越大越靠前)', 'sort', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">图片链接: (宽高：190*190 带 http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showtablerow('', array('class="td27" colspan="2"'), array('简介：<textarea class="intro" name="intro" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editinstitutions'){
    //页面展示
    cpheader();
    shownav('topic', '编辑合作机构');
    top_nav(999);

    if (submitcheck('addsubmit')) {

        $url= "action=exam&operation=institutionslist";

        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        if(!$id){
            cpmsg('非法id', $url, 'error');
        }

        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $intro = trim($_POST['intro']);
        $img = trim($_POST['img']);
        $province = $_POST['province'];
        $institutions = $_POST['institutions_type'];
        $other = trim($_POST['other']);
        $other_url = trim($_POST['other_url']);
        $sort = (int) $_POST['sort'];

        if(!$name || !$address || !$intro || !$img || !$province || !$institutions){
            cpmsg('填写信息不全', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $url, 'error');
        }

        $data = array(
            'name' => $name,
            'address' => $address,
            'intro' => $intro,
            'img' => $img,
            'province' => $province,
            'province_zh' => get_province_name($province),
            'type_fx' => (int)$institutions['fx'],
            'type_sd' => (int)$institutions['sd'],
            'type_hzjg' => (int)$institutions['hzjg'],
            'other' => $other ? $other : '',
            'other_url' => $other_url ? $other_url : '',
            'sort' => $sort ? $sort : 0
        );

        DB::update('exam_institutions', $data, "id='{$id}'");
        cpmsg('编辑成功！', $url, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('操作失败,id非法', 'action=exam&operation=institutionslist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_institutions') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);


    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		edit_save();
		//标题
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('标题不能为空！');
			return false;
		}
       //类型
        var type = jQuery(".checkbox:checked").val();
        if(!type){
            alert('请至少选中一个机构类型！');
            return false;
        }
        //省份
        var province = jQuery("select[name=province]").val();
        if(province == '0'){
                alert('请选择省份！');
                return false;
        }
        //地址
        var address = jsTrim(jQuery("input[name=address]").val());
        if(address == ''){
            alert('地址不能为空！');
            return false;
        }
        //图片
        var url = jsTrim(jQuery("input[name=img]").val());
        if(url == ''){
            alert('图片链接不能为空！');
            return false;
        }
        //简介
        var intro = jsTrim(jQuery("#intro").val());
        if(intro == ''){
                alert('简介不能为空！');
                return false;
        }

		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
    function yulanimg(){
        var img = jQuery("#img").val();
        jQuery("#yulan").attr('src', img);
    }
    function jump(obj){
        var url = jQuery("#"+obj).attr('data-url');
        window.location.href=url;
    }
	</script>
EOT;

    showformheader('exam&operation=editinstitutions&id='.$id, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('标题', 'name', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
    $hzjg = '
            <tr><td colspan="2" class="td27">类型:</td></tr>
            <tr class="noborder">
                <td colspan="2" class="vtop rowform">
                    <ul class="nofloat" onmouseover="altStyle(this);" style="width: 830px">
                             <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[fx]" value="1" type="checkbox" '.ischecked("1", $row[type_fx]).'>&nbsp;分校</li>
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[sd]" value="1" type="checkbox" '.ischecked("1", $row[type_sd]).'>&nbsp;试点</li>
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[hzjg]" value="1" type="checkbox" '.ischecked("1", $row[type_hzjg]).'>&nbsp;合作机构</li>
                    </ul>
                </td>
            </tr>';
    echo $hzjg;
    $pro  = province_select();

    showsetting('省份', array('province', $pro), "$row[province]", 'select');
    showsetting('地址', 'address', "$row[address]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('其他展示', 'other', "$row[other]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('其他展示链接', 'other_url', "$row[other_url]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('排序(数字：值越大越靠前)', 'sort', "$row[sort]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">图片链接: (宽高：190*190 带 http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showtablerow('', array('class="td27" colspan="2"'), array('简介：<textarea class="intro" name="intro" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px">'.$row[intro].'</textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showtablerow('', array('class="td25" colspan="2"'), array(
        "<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>&nbsp;&nbsp;
        <input class='btn inst_btn' id='inst_banner' type='button' value='轮播图' data-url='/admin.php?action=exam&operation=inst_banner&id={$row['id']}' onclick=jump('inst_banner')>&nbsp;&nbsp;
        <input class='btn inst_btn' id='inst_activity' type='button' value='活动管理' data-url='/admin.php?action=exam&operation=inst_activity&id={$row['id']}' onclick=jump('inst_activity')>"
    ));
    showtablefooter();
    showformfooter();
}

if($operation == 'inst_banner') {
    cpheader();
    shownav('topic', '编辑或作机构轮播图');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $back = "action=exam&operation=institutionslist";

        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        if(!$id){
            cpmsg('非法id', $back, 'error');
        }
        $name = $_POST['name'];
        $url = $_POST['url'];
        $img = $_POST['img'];
        if(!$img){
            cpmsg('填写信息不全', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $back, 'error');
        }
        DB::delete('exam_institutions_other', "inst_id = {$id} and type = 1");
        foreach($img as $key => $val){
            if($val){
                $data = array(
                    'name' => $name[$key],
                    'url' => $url[$key],
                    'img' => $val,
                    'uid' => $uid,
                    'inst_id' => $id,
                    'createtime' => time(),
                    'type' => 1
                );
                DB::insert('exam_institutions_other', $data);
            }
        }
        $url = preg_replace('/\/admin\.php\?/i', '', $back);

        cpmsg('操作成功！', $url, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('操作失败,id非法', 'action=exam&operation=institutions', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_institutions_other') ." WHERE inst_id = ".$id. " and type=1 order by id asc".getSlaveID());
    $row = DB::fetch($query);
    if($row){
        showformheader('exam&operation=inst_banner&id='.$id, '', 'ksform');
        showtableheader();
        showsetting('图片描述1', 'name[1]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('跳转链接1', 'url[1]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('图片链接1: (宽高：750*380 带 http://)', 'img[1]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');
        $i=2;
        while($row = DB::fetch($query)){
            showsetting('图片描述'.$i, 'name['.$i.']', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
            showsetting('跳转链接'.$i, 'url['.$i.']', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
            showsetting('图片链接:'.$i.' (宽高：750*380 带 http://)', 'img['.$i.']', "$row[img]", 'text', '', '', '', 'style="width:600px;"');
            $i++;
        }
        $y = 5-$i;
        if($y > 0){
            for($i = $i;$i < 6; $i++){
                showsetting('图片描述'.$i, 'name['.$i.']', "", 'text', '', '', '', 'style="width:600px;"');
                showsetting('跳转链接'.$i, 'url['.$i.']', "", 'text', '', '', '', 'style="width:600px;"');
                showsetting('图片链接:'.$i.' (宽高：750*380 带 http://)', 'img['.$i.']', "", 'text', '', '', '', 'style="width:600px;"');
            }
        }
    }else{

        showformheader('exam&operation=inst_banner&id='.$id, '', 'ksform');
        showtableheader();
        showsetting('图片描述1', 'name[1]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('跳转链接1', 'url[1]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('图片链接1: (宽高：750*380 带 http://)', 'img[1]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');

        showsetting('图片描述2', 'name[2]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('跳转链接2', 'url[2]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('图片链接2: (宽高：750*380 带 http://)', 'img[2]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');

        showsetting('图片描述3', 'name[3]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('跳转链接3', 'url[3]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('图片链接3: (宽高：750*380 带 http://)', 'img[3]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');

        showsetting('图片描述4', 'name[4]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('跳转链接4', 'url[4]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('图片链接4: (宽高：750*380 带 http://)', 'img[4]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');

        showsetting('图片描述5', 'name[5]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('跳转链接5', 'url[5]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('图片链接5: (宽高：750*380 带 http://)', 'img[5]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');
    }

    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();
}

if($operation == 'inst_activity'){
    //页面展示
    cpheader();
    shownav('topic', '合作机构活动管理');
    top_nav(7);
    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);

    if(!$id){
        cpmsg('缺少参数', $_SERVER['HTTP_REFERER'], 'error');
    }

    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation=inst_activity&id={$id}&&perpage={$perpage}&page={$page}";

        if($ids){
            if($_G['gp_optype'] == 'trash'){
                DB::delete('exam_institutions_other', "id in ({$ids})");
                cpmsg('删除成功', $url, 'succeed');
            }else{
                cpmsg('请选择操作！', $url, 'error');
            }
        }else{
            cpmsg('请选择信息！', $url, 'error');
        }
    }else{
        //表单框架
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
        function subcheck(obj) {
            //操作类别
            var op = jsTrim(jQuery("input[name=optype]:checked").val());
            if(op == 'trash'){
                if(confirm("删除是不可恢复的，你确认要删除吗？")){
                                return true;
                            }else{
                                return false;
                            }
            }
        }
        //去除所有空格
        function jsTrimAll(str) {
            return str.replace(/\s+/g, '');
        }
        //去除两端空格
        function jsTrim(str) {
            return str.replace(/^\s+|\s+$/g, '');
        }
        function delete_inst_activity(id){
            if(id == ''){
                return false;
            }

           jQuery.ajax({
                    type : 'POST',
                    url : '/admin.php?action=exam&operation=delete_inst_activity',
                    data : {id:id},
                    success:function(result){
                            result = eval("("+result+")");
                            if(result.flag == '1'){
                                jQuery(".dodelete"+result.id).parent().parent().remove();
                            }
                    }
            });
        }
	</script>
EOT;

        $perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
        $page = max($_G['gp_page'], 1);
        $mpurl = ADMINSCRIPT . '?action=exam&operation=' . $operation.'&id='.$id;

        $searchtid 	 = empty($_G['gp_searchtid']) ? 0 : intval($_G['gp_searchtid']);
        $selectcat 	 = $_G['gp_selectcat'];
        if (!in_array($perpage, array(10, 20, 50, 100)))
            $perpage = 50;

        $start = ($page - 1) * $perpage;
        $mpurl .= '&perpage=' . $perpage;
        if($selectcat){
            $mpurl .= '&selectcat=' . $selectcat;
        }

        showformheader('exam&operation=inst_activity&id='.$id, '');
        showtableheader();
        showsubtitle(array('', 'ID','标题', '创建时间', '操作'));

        $multipage = '';

        $count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('exam_institutions_other') . " where inst_id = {$id} and type = 2 " .getSlaveID());
        if($count){
            $sql = "SELECT * FROM " . DB::table('exam_institutions_other') . " where inst_id = {$id} and type = 2 ORDER BY id DESC LIMIT {$start},{$perpage} " . getSlaveID();
            $query = DB::query($sql);
            while ($value = DB::fetch($query)) {
                showtablerow('', array('class="td25"','width="30"'), array(
                    "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
                    "{$value[id]}",
                    "{$value[name]}",
                    date('Y-m-d H:i',$value['createtime']),
                    "<a class='act' href=\"admin.php?action=exam&operation=edit_inst_activity&id=$value[id]\" target=\"_blank\">[编辑]</a>".
                    $op . "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"delete_inst_activity(". $value['id'] .")\">[删除]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" /><label for="optype_trash">删除</label>&nbsp;&nbsp;&nbsp;&nbsp;';

        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
        showtablefooter();
        echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=inst_activity_add&id=".$id."\">增加活动</a></div>";
        showformfooter();
    }
}

if($operation == 'inst_activity_add'){

    cpheader();
    shownav('topic', '增加合作机构活动');
    top_nav(7);
    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('缺少参数', $_SERVER['HTTP_REFERER'], 'error');
    }

    if (submitcheck('addsubmit')) {
        $name = trim($_POST['name']);
        $url = trim($_POST['url']);
        $img = trim($_POST['img']);

        $back = "action=exam&operation=inst_activity&id=".$id;

        if(!$name || !$url || !$img){
            cpmsg('填写信息不全', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $back, 'error');
        }

        $createtime = time();

        DB::query("INSERT INTO " . DB::table('exam_institutions_other') . "
			(name, url, uid, img, type, createtime, inst_id)
			VALUES ('{$name}', '{$url}', '$uid', '$img', '2', '$createtime', '$id')");
        $id = DB::insert_id();

        $url = preg_replace('/\/admin\.php\?/i', '', $back);
        cpmsg('添加成功！', $back, 'succeed');
    }

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//标题
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('标题不能为空！');
			return false;
		}
        //视频
        var url = jsTrim(jQuery("input[name=url]").val());
        if(url == ''){
            alert('链接不能为空！');
            return false;
        }
        //简介
        var img = jsTrim(jQuery("input[name=img]").val());
        if(img == ''){
                alert('图片链接不能为空！');
                return false;
        }

		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	 function yulanimg(){
        var img = jQuery("#img").val();
        jQuery("#yulan").attr('src', img);
    }
	</script>
EOT;

    showformheader('exam&operation=inst_activity_add&id='.$id, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('标题', 'name', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('链接', 'url', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">图片链接: (宽高：702*350 带 http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();
}

if($operation == 'delete_inst_activity'){
    if($_POST['id'] && $_G['uid']){
        DB::delete('exam_institutions_other', array('id' => $_POST['id']));
        echo json_encode(array('id' => $_POST['id'], 'flag' => 1));die();
    }
}

if($operation == 'edit_inst_activity'){

    cpheader();
    shownav('topic', '编辑合作机构活动');
    top_nav(7);
    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('缺少参数', $_SERVER['HTTP_REFERER'], 'error');
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_institutions_other') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);

    if (submitcheck('addsubmit')) {
        $name = trim($_POST['name']);
        $url = trim($_POST['url']);
        $img = trim($_POST['img']);

        $back = "action=exam&operation=inst_activity&id=".$row['inst_id'];

        if(!$name || !$url || !$img){
            cpmsg('填写信息不全', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('非法uid', $back, 'error');
        }

        $createtime = time();
        $hd_data = array(
            'name' => $name,
            'url' => $url,
            'img' => $img
        );
        DB::update('exam_institutions_other', $hd_data, "id={$id}");

        $url = preg_replace('/\/admin\.php\?/i', '', $back);
        cpmsg('编辑成功！', $back, 'succeed');
    }

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//标题
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('标题不能为空！');
			return false;
		}
        //视频
        var url = jsTrim(jQuery("input[name=url]").val());
        if(url == ''){
            alert('链接不能为空！');
            return false;
        }
        //简介
        var img = jsTrim(jQuery("input[name=img]").val());
        if(img == ''){
                alert('图片链接不能为空！');
                return false;
        }

		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	 function yulanimg(){
        var img = jQuery("#img").val();
        jQuery("#yulan").attr('src', img);
    }
	</script>
EOT;

    showformheader('exam&operation=edit_inst_activity&id='.$id, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('标题', 'name', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('链接', 'url', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">图片链接: (宽高：702*350 带 http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="预览" /></td>
    </tr>
    <tr><td colspan="2" class="td27">图片预览:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();
}

if($operation == 'wechat_user'){
    //页面展示
    cpheader();
    shownav('topic', '微信用户列表');
    top_nav(8);

    $mpurl = ADMINSCRIPT . '?action=exam&operation=' . $operation;
    $perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
    $page = max($_G['gp_page'], 1);
    $UID = empty($_G['gp_UID']) ? '' : intval($_G['gp_UID']);
    $nickname = empty($_G['gp_nickname']) ? '' : trim($_G['gp_nickname']);
    $mobile = empty($_G['gp_mobile']) ? '' : trim($_G['gp_mobile']);
    $selectcat 	 = $_G['gp_selectcat'];
    if (!in_array($perpage, array(10, 20, 50, 100)))
        $perpage = 50;

    $start = ($page - 1) * $perpage;
    if($selectcat){
        $mpurl .= '&selectcat=' . $selectcat;
    }

    $mpurl .= '&perpage=' . $perpage;

    $cat_array = array(1=>'是',2=>'否');

    $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">UID&nbsp;&nbsp;';
    $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
    $extraStr .= '<input type="hidden" name="action" value="exam"/>';
    $extraStr .= '<input type="hidden" name="operation" value="wechat_user"/>';
    $extraStr .= '<input type="text" name="UID" value="'.$UID.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;微信昵称&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="nickname" value="'.$nickname.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;手机号&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="mobile" value="'.$mobile.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;付费状态&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">请选择</option>';
    foreach ($cat_array as $k=>$v) {
        $selectStr = $selectcat == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';
    $extraStr .= '<input type="submit" value="查询" style="cursor:pointer;" /></form></div>';
    echo $extraStr;

    showtableheader();
    showsubtitle(array( 'UID','微信昵称', '手机号', '付费状态', '付费到期','操作'));

    $multipage = '';
    $where = '1=1';
    if($UID){
        $where .= " and uid = '{$UID}'";
        $mpurl .= '&UID='.$UID;
    }
    if($nickname){
        $nickname = base64_encode($nickname);
        $where .= " and nickname = '{$nickname}'";
        $nickname = base64_decode($nickname);
        $mpurl .= '&nickname='.$nickname;
    }
    if($mobile){
        $where .= " and mobile = '{$mobile}'";
        $mpurl .= '&mobile='.$mobile;
    }
    if($selectcat == 1){
        $where .= ' and vip_end > 0';
    }elseif($selectcat == 2){
        $where .= ' and vip_end = 0';
    }
    $count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('common_member_connect_wechat') .' where '. $where . getSlaveID());
    if($count){
        $sql = "SELECT * FROM " . DB::table('common_member_connect_wechat') . ' where '.$where ." ORDER BY bind_time DESC LIMIT {$start},{$perpage} " . getSlaveID();
        $query = DB::query($sql);
        while ($value = DB::fetch($query)) {
            if($value['vip_end'] > 0){
                $status = '是';
                $vip_end = date('Y-m-d H:i',$value['vip_end']);
                $op = '<span style="color: lightgrey">已开通会员</span>';
            }else{
                $status = '否';
                $vip_end = '';
                $op ="<a href=\"admin.php?action=exam&operation=add_vip_user&uid=$value[uid]&mobile=$value[mobile]\">[开通会员]</a>";
            }
            showtablerow('', array(), array(
                "{$value[uid]}",
                base64_decode($value[nickname]),
                "{$value[mobile]}",
                "{$status}",
                $vip_end,
                $op,
            ));
        }
        $multipage = multi($count, $perpage, $page, $mpurl);
    }

    showsubmit('', '', '', '', $multipage);

    showtablefooter();

}

if($operation == 'pay_record'){
    //页面展示
    cpheader();
    shownav('topic', '付费记录');
    top_nav(9);

    $mpurl = ADMINSCRIPT . '?action=exam&operation=' . $operation;
    $perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
    $page = max($_G['gp_page'], 1);
    $nickname = empty($_G['gp_nickname']) ? '' : trim($_G['gp_nickname']);
    $UID = empty($_G['gp_UID']) ? '' : intval($_G['gp_UID']);
    $mobile = empty($_G['gp_mobile']) ? '' : trim($_G['gp_mobile']);
    $transaction_id = empty($_G['gp_transaction_id']) ? '' : trim($_G['gp_transaction_id']);
    $selectcat 	 = $_G['gp_selectcat'];
    $select_pay_type 	 = $_G['gp_select_pay_type'];
    if (!in_array($perpage, array(10, 20, 50, 100)))
        $perpage = 50;

    $start = ($page - 1) * $perpage;
    if($selectcat){
        $mpurl .= '&selectcat=' . $selectcat;
    }

    if($select_pay_type){
        $mpurl .= '&select_pay_type=' . $select_pay_type;
    }
    $mpurl .= '&perpage=' . $perpage;

    $cat_array = array(1=>'自主充值',2=>'后台添加');
    $pay_type_array = array(1=>'会员',2=>'视频');

    $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">UID&nbsp;&nbsp;';
    $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
    $extraStr .= '<input type="hidden" name="action" value="exam"/>';
    $extraStr .= '<input type="hidden" name="operation" value="pay_record"/>';
    $extraStr .= '<input type="text" name="UID" value="'.$UID.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;微信昵称&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="nickname" value="'.$nickname.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;手机号&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="mobile" value="'.$mobile.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;充值渠道&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">请选择</option>';
    foreach ($cat_array as $k=>$v) {
        $selectStr = $selectcat == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';

    $extraStr .= '&nbsp;&nbsp;充值类型&nbsp;&nbsp;<select id="select_pay_type" name="select_pay_type"><option value="0">请选择</option>';
    foreach ($pay_type_array as $k=>$v) {
        $selectStr = $select_pay_type == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;微信支付订单号&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="transaction_id" value="'.$transaction_id.'" style="height:18px;width:250px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '<input type="submit" value="查询" style="cursor:pointer;" /></form></div>';
    echo $extraStr;

    showtableheader();
    showsubtitle(array( 'UID','微信昵称', '手机号', '微信支付订单号', '订单金额(元)','订单类型','创建时间'));

    $multipage = '';
    $where = '1=1';
    if($UID){
        $where .= " and r.uid = '{$UID}'";
        $mpurl .= '&UID='.$UID;
    }
    if($nickname){
        $nickname = base64_encode($nickname);
        $where .= " and nickname = '{$nickname}'";
        $nickname = base64_decode($nickname);
        $mpurl .= '&nickname='.$nickname;
    }
    if($mobile){
        $where .= " and mobile = '{$mobile}'";
        $mpurl .= '&mobile='.$mobile;
    }
    if($transaction_id){
        $where .= " and transaction_id = '{$transaction_id}'";
        $mpurl .= '&mobile='.$transaction_id;
    }
    if($selectcat == 1){
        $where .= ' and transaction_id != 8264';
    }elseif($selectcat == 2){
        $where .= ' and transaction_id = 8264';
    }
    if($select_pay_type)    $where .= " and type = '{$select_pay_type}'";

    $count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('exam_pay_record')." as r LEFT JOIN ".DB::table('common_member_connect_wechat')." as u on r.uid=u.uid " .' where '. $where . getSlaveID());
    if($count){
        $sql = "SELECT u.uid,u.nickname,u.mobile,r.cash_fee,r.type,r.transaction_id,r.pay_id,r.create_time FROM ".DB::table('exam_pay_record')." as r LEFT JOIN ".DB::table('common_member_connect_wechat')." as u on r.uid=u.uid  where ".$where ." ORDER BY create_time DESC LIMIT {$start},{$perpage} " . getSlaveID();
        $query = DB::query($sql);
        while ($value = DB::fetch($query)) {
            $create_time = date('Y-m-d H:i',$value['create_time']);
            $cash_fee = $value['cash_fee']/100;
            if($value['type'] == 1){
                $type_zh = '会员年费';
            }else{
                $type_zh = '视频购买(视频ID:'.$value['pay_id'].')';
            }
            showtablerow('', array(), array(
                "{$value[uid]}",
                base64_decode($value[nickname]),
                "{$value[mobile]}",
                "{$value[transaction_id]}",
                $cash_fee,
                $type_zh,
                $create_time,
            ));
        }
        $multipage = multi($count, $perpage, $page, $mpurl);
    }
    showsubmit('', '', '', '', $multipage);

    showtablefooter();

}

if($operation == 'equipment_order_status'){
    if($_POST['id'] && $_G['uid']){
        $res = DB::update('exam_equipment_order', array('status'=>2), "id={$_POST['id']}");
        if($res){
            echo json_encode(array('id' => $_POST['id'], 'flag' => 1));
        }else{
            echo json_encode(array('id' => $_POST['id'], 'flag' => 2));
        }
    }
}

if($operation == 'equipment_order'){
    //页面展示
    cpheader();
    shownav('topic', '装备邮寄');
    top_nav(10);
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function order_status(id) {
		//操作类别
			if(confirm("状态更改是不可恢复的，你确认要更改吗？")){
			     jQuery.ajax({
                    type : 'POST',
                    url : '/admin.php?action=exam&operation=equipment_order_status',
                    data : {id:id},
                    success:function(result){
                            result = eval("("+result+")");
                            if(result.flag == '1'){
                                window.location.reload();
                            }else{
                                alert('系统繁忙！请稍候再试')
                            }
                    }
                });
            }else{
                return false;
            }
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
EOT;
    $mpurl = ADMINSCRIPT . '?action=exam&operation=' . $operation;
    $perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
    $page = max($_G['gp_page'], 1);
    $nickname = empty($_G['gp_nickname']) ? '' : trim($_G['gp_nickname']);
    $UID = empty($_G['gp_UID']) ? '' : intval($_G['gp_UID']);
    $mobile = empty($_G['gp_mobile']) ? '' : trim($_G['gp_mobile']);
    $selectcat = empty($_G['gp_selectcat']) ? 0 : intval($_G['gp_selectcat']);
    $select_channel = empty($_G['gp_select_channel']) ? 0 : intval($_G['gp_select_channel']);

    if (!in_array($perpage, array(10, 20, 50, 100)))
        $perpage = 50;

    $start = ($page - 1) * $perpage;

    $mpurl .= '&perpage=' . $perpage;

    $cat_array = array(1=>'未邮寄',2=>'已邮寄');
    $channel_array = array(1=>'自主充值',2=>'后台添加');

    $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">UID&nbsp;&nbsp;';
    $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
    $extraStr .= '<input type="hidden" name="action" value="exam"/>';
    $extraStr .= '<input type="hidden" name="operation" value="equipment_order"/>';
    $extraStr .= '<input type="text" name="UID" value="'.$UID.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;微信昵称&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="nickname" value="'.$nickname.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;手机号&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="mobile" value="'.$mobile.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;充值渠道&nbsp;&nbsp;<select id="select_channel" name="select_channel"><option value="0">请选择</option>';
    foreach ($channel_array as $k=>$v) {
        $selectStr = $select_channel == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;邮寄状态&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">请选择</option>';
    foreach ($cat_array as $k=>$v) {
        $selectStr1 = $selectcat == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr1}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';
    $extraStr .= '<input type="submit" value="查询" style="cursor:pointer;" /></form></div>';
    echo $extraStr;

    showtableheader();
    showsubtitle(array( 'UID','微信昵称','收件人','手机号','地址','充值渠道','状态','创建时间'));

    $multipage = '';
    $where = '1=1';
    if($UID){
        $where .= " and r.uid = '{$UID}'";
        $mpurl .= '&UID='.$UID;
    }
    if($nickname){
        $nickname = base64_encode($nickname);
        $where .= " and nickname = '{$nickname}'";
        $nickname = base64_decode($nickname);
        $mpurl .= '&nickname='.$nickname;
    }
    if($mobile){
        $where .= " and mobile = '{$mobile}'";
        $mpurl .= '&mobile='.$mobile;
    }
    if($selectcat){
        $where .= ' and r.status ='.$selectcat;
        $mpurl .= '&selectcat='.$selectcat;
    }
    if($select_channel){
        if($select_channel == 1){
            $where .= ' and op_uid = 0';

        }elseif($select_channel == 2){
            $where .= ' and op_uid > 0';
        }
        $mpurl .= '&select_channel='.$select_channel;
    }

    $count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('exam_equipment_order')." as r LEFT JOIN ".DB::table('common_member_connect_wechat')." as u on r.uid=u.uid " .' where '. $where . getSlaveID());
    if($count){
        $sql = "SELECT u.uid,u.nickname,u.op_uid,r.id,r.username,r.phone,r.address,r.status,r.create_time FROM ".DB::table('exam_equipment_order')." as r LEFT JOIN ".DB::table('common_member_connect_wechat')." as u on r.uid=u.uid  where ".$where ." ORDER BY r.create_time DESC LIMIT {$start},{$perpage} " . getSlaveID();
        $query = DB::query($sql);
        while ($value = DB::fetch($query)) {
            $create_time = date('Y-m-d H:i',$value['create_time']);
            if($value['status'] == 1){
                $type_zh = "<a href=\"javascript:///\" onclick='order_status($value[id])' target=\"_blank\">[未邮寄]</a>";
            }else{
                $type_zh = '已邮寄';
            }
            if($value['op_uid'] > 0){
                $op_add = '<span style="color: red">后台添加</span>';
            }else{
                $op_add = '自主充值';
            }
            showtablerow('', array(), array(
                "{$value[uid]}",
                base64_decode($value[nickname]),
                "{$value[username]}",
                "{$value[phone]}",
                "{$value[address]}",
                $op_add,
                $type_zh,
                $create_time
            ));
        }
        $multipage = multi($count, $perpage, $page, $mpurl);
    }
    showsubmit('', '', '', '', $multipage);

    showtablefooter();

}

if($operation == 'add_vip_user'){
    //页面展示
    cpheader();
    shownav('topic', '增加vip会员');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $mobile = trim($_POST['mobile']);

        $back = $_SERVER['HTTP_REFERER'];

        $add_refer = trim($_POST['add_refer']);

        $user_id = trim($_POST['uid']);

        if(strpos($add_refer,'wechat_user') == false){
            cpmsg('来源错误', $back, 'error');
        }
        if(!$mobile){
            cpmsg('填写信息不全', $back, 'error');
        }
        if(!$user_id){
            cpmsg('用户不存在', $back, 'error');
        }

        if(!$_G['uid']){
            cpmsg('非法uid', $back, 'error');
        }

        $vip_begin = time();
        $data = array();
        $data['vip_begin'] = strtotime(date('Y-m-d',$vip_begin));
        $data['vip_end'] = strtotime("+1 year",$data['vip_begin']);
        $data['op_uid'] = $_G['uid'];
        $data['mobile'] = $mobile;

        //更新手机号、vip时间、手动状态
        $res = DB::update('common_member_connect_wechat', $data, "uid = ({$user_id})");
        if($res !== false){
            $pay_record = array(
                'uid' => $user_id,
                'cash_fee' => 39900,
                'transaction_id' => '8264',
                'type' => 1,
                'pay_id' => 0,
                'create_time' => $vip_begin
            );
            DB::insert('exam_pay_record',$pay_record);
            if(DB::insert_id()){
                cpmsg('开通成功！', $add_refer, 'succeed');
            }else{
                $data['vip_begin'] = $data['vip_end'] = $data['op_uid'] = 0;
                DB::update('common_member_connect_wechat', $data, "uid = ({$user_id})");
                cpmsg('开通失败,请联系管理员！', $back, 'error');
            }
        }else{
            cpmsg('开通失败,请联系管理员！', $back, 'error');
        }
    }

    //表单框架
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//标题
		var mobile = jsTrim(jQuery("input[name=mobile]").val());
		if(mobile == ''){
			alert('手机号不能为空！');
			return false;
		}
        if(!(/^1[3|4|5|7|8]\d{9}$/.test(mobile))){
                alert("请输入正确手机号");
                return false;
        }
		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
EOT;
    $uid = $_G['gp_uid'];
    if(!$uid){
        cpmsg('非法uid', '', 'error');
    }
    $mobile = trim($_GET['mobile']);

    $add_refer = $_SERVER['HTTP_REFERER'];

    showformheader('exam&operation=add_vip_user', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    echo '<tr><td colspan="2" class="td27">UID:</td></tr>';
    echo '<tr class="noborder"><td class="vtop rowform">'.$uid.'</td><td class="vtop tips2"></td></tr>';
    showsetting('手机号', 'mobile', $mobile?$mobile:'', 'text', '', '', '', 'style="width:200px;"');
    echo "<input type='hidden' name='add_refer' value=\"$add_refer\">";
    echo "<input type='hidden' name='uid' value=\"$uid\">";

    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='成为会员'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

//获取试题分类列表，type=1 返回数组，type=2 返回HTML option
function questiontype($type=1, $catid=0){
    $query = DB::query("SELECT id,catname FROM ". DB::table('exam_category').getSlaveID());
    while($raw = DB::fetch($query)){
        $kaoshi_cat_array[$raw['id']] = $raw['catname'];
    }

    $optionlist = '';
    if($type == 1){
        return $kaoshi_cat_array;
    }
    if($type == 2){
        foreach($kaoshi_cat_array as $k=>$v){
            $selected = $catid == $k ? ' selected=\"selected\"' : "";
            $optionlist .= "<option value=".$k.$selected. ">".$v."</option>";
        }
        return $optionlist;
    }

}
//pre_exam_institutions
//合作机构列表 type=1 返回数组，type=2 返回HTML option
function institutions($type=1, $inst_id){
    $query = DB::query("SELECT id,name FROM ". DB::table('exam_institutions').getSlaveID());
    while($raw = DB::fetch($query)){
        $institutions_array[$raw['id']] = $raw['name'];
    }

    $optionlist = '';
    if($type == 1){
        return $institutions_array;
    }
    if($type == 2){
        foreach($institutions_array as $k=>$v){
            $selected = $inst_id == $k ? ' selected=\"selected\"' : "";
            $optionlist .= "<option value=".$k.$selected. ">".$v."</option>";
        }
        return $optionlist;
    }

}

function getcategory(){
    $query = DB::query("SELECT * FROM ". DB::table('exam_category').getSlaveID());
    while($raw = DB::fetch($query)){
        $category[$raw[id]] = $raw;
    }
    return $category;
}

function ischecked($letter, $right_answer){
    if(strstr($right_answer, $letter)){
        return "checked";
    }
    return "";
}

function top_nav($index){
    $nav = array(
        array('试题列表', 'exam&operation=questionlist', 0), //第三个参数代表是否是当前菜单
        array('添加试题', 'exam&operation=addquestion', 0),
        array('分类列表', 'exam&operation=categorylist', 0),
        array('线下培训', 'exam&operation=peixunlist', 0),
        array('师资力量', 'exam&operation=shizilist', 0),
        array('试题纠错', 'exam&operation=examerror', 0),
        array('视频回顾', 'exam&operation=videolist', 0),
        array('合作机构', 'exam&operation=institutionslist', 0),
        array('微信用户', 'exam&operation=wechat_user', 0),
        array('付费记录', 'exam&operation=pay_record', 0),
        array('装备邮寄', 'exam&operation=equipment_order', 0)
    );
    if($index != 999){
        $nav[$index][2] = 1;
    }
    showsubmenu('考试管理',$nav);
}

function province_select(){
    $arr = array(
        array('0','请选择省份')
    );
    $query = DB::query("SELECT * FROM ". DB::table('common_district') ." WHERE level = 1 ".getSlaveID());
    while($row = DB::fetch($query)){
        $arr[] = array($row['id'], $row['name']);
    }
    return $arr;
}

function get_province_name($id){

    $query = DB::query("SELECT * FROM ". DB::table('common_district') ." WHERE id = ".$id  .getSlaveID());
    $row = DB::fetch($query);
    return $row['name'];
}