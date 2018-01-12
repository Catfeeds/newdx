<?php

/**
 * ���Թ���
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
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�����б�');
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
            cpmsg('ɾ���ɹ�', $url, 'succeed');
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
            cpmsg('���߳ɹ�', $url, 'succeed');
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
            cpmsg('���߳ɹ�', $url, 'succeed');
        } elseif ($_G['gp_optype_se'] && $qids) {
            //�ƶ�����
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
            cpmsg('�ƶ��ɹ�', $url, 'succeed');
        } else {
            cpmsg('article_choose_at_least_one_operation', $url, 'error');
        }
    }else{
        //�����
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function subcheck(obj) {
		//�������
		var op = jsTrim(jQuery("input[name=optype]:checked").val());
		if(op == 'trash'){
			if(confirm("ɾ���ǲ��ɻָ��ģ���ȷ��Ҫɾ����")){
                            return true;
                        }else{
                            return false;
                        }
		}
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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

        $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">����ID&nbsp;&nbsp;';
        $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
        $extraStr .= '<input type="hidden" name="action" value="exam"/>';
        $extraStr .= '<input type="hidden" name="operation" value="questionlist"/>';
        $extraStr .= '<input type="text" name="qid" value="'.$qid.'" style="height:18px;width:85px;vertical-align:middle;" placeholder="��д����ID" />&nbsp;&nbsp;';
        $extraStr .= '&nbsp;&nbsp;���&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">��ѡ�����</option>';
        foreach ($cat_array as $k=>$v) {
            $selectStr = $selectcat == $k ? 'selected=\"selected\"' : '';
            $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
        }
        $extraStr .= '</select>&nbsp;&nbsp;';
        $extraStr .= '<input type="submit" value="��ѯ" style="cursor:pointer;" /></form></div>';
        echo $extraStr;

        showformheader('exam&operation=questionlist','onsubmit="return subcheck(this);"');
        showtableheader();
        showsubtitle(array('', 'ID','���', '����', '��', '����ʱ��', '����', '����', '����'));

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
                $status = $value[is_show] ? '����' : '<span style="color:red;">����</span>';
                showtablerow('', array('class="td25"','width="30"','width="80"'), array(
                    "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[qid]\">",
                    "{$value[qid]}",
                    "{$cat_array[$value[catid]]}",
                    "<a href=\"\" target=\"_blank\">[{$status}]{$value[title]}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"admin.php?action=exam&operation=editquestion&qid=$value[qid]\" target=\"_blank\">[�༭]</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"exam.php?ctl=topic&act=yulan&qid=$value[qid]\" target=\"_blank\">[Ԥ��]</a>",
                    $value['right_answer'],
                    date('Y-m-d H:i',$value['createtime']),
                    $value['useful'],
                    $value['useless'],
                    "<a href=\"admin.php?action=exam&operation=editquestion&qid=$value[qid]\" target=\"_blank\">[�༭]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" onclick="radio_click(this)" /><label for="optype_trash">����ɾ��</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_show" value="show" class="optype" onclick="radio_click(this)" /><label for="optype_show">����</label>&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_noshow" value="noshow" class="optype" onclick="radio_click(this)" /><label for="optype_noshow">����</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '�����ƶ�����&nbsp;&nbsp;<select id="movecat" name="optype_se" onchange="optype_select()">'
            . '<option value="0">��ѡ�����</option>';
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
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�������');
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
        cpmsg('�����ɹ���', $url, 'succeed');
    }
    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {	
		//����
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
    
                //����
                var catid = jQuery("#catid").val();
                if(catid == '0'){
                        alert('��ѡ��������࣡');
                        return false;
                }
    
                //����ѡ��
                var questionanswers = jsTrim(jQuery("#questionanswers").val());
                if(questionanswers == ''){
                        alert('����ѡ���Ϊ�գ�');
                        return false;
                }
    
                //��������
                var qtype = jQuery("input[name=qtype]:checked").val();
                if(qtype == ''){
                        alert('��ѡ���������ͣ�');
                        return false;
                }
    
                //��ȷѡ��
                var rightanswers = jQuery("input[name=rightanswers[]]:checked").val();
                if(!rightanswers){
                    alert('������ѡ��һ����ȷѡ�');
                    return false;
                }
    
		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
EOT;

    showtips('<li>����ѡ�˳����д���Իس�����</li>');
    showformheader('exam&operation=addquestion', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('�������', 'title', '', 'text', '', '', '', 'style="width:547px;"');
    showsetting('�������', '', '', '<select id="catid" name="catid"><option value="0">'."��ѡ�����".'</option>'.questiontype(2).'</select>');
    showtablerow('', array('class="td27" colspan="2"'), array('����ѡ�<font color="red">(��ȷ��ÿ��һ��ѡ��)</font><br><br><textarea id="questionanswers" name="questionanswers"  rows="6" cols="85" style=""></textarea>'));
    showsetting('��������', '', '', '<input type="radio" value="1" name="qtype">�ж�&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="2" name="qtype" checked>��ѡ&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="3" name="qtype">��ѡ');
    showsetting('��ȷѡ��', array('rightanswers', array(
        array('A','A'),
        array('B','B'),
        array('C','C'),
        array('D','D'),
        array('E','E'),
        array('F','F'),
    )), '', 'mcheckbox');
    //���ı��༭���ʺϴ�Wordֱ��ճ��
//    showtablerow('', array('class="td27" colspan="2"'), array('���������<textarea class="userData" name="analysis" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
//    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showtablerow('', array('class="td27" colspan="2"'), array('���������<br><br><textarea id="analysis" name="analysis"  rows="6" cols="85" style=""></textarea>'));
    showsetting('ͼƬ����', 'imgurl', '', 'text', '', '', '', 'style="width:697px;"');
    showsetting('��Ƶ����', 'videourl', '', 'text', '', '', '', 'style="width:697px;"');
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editquestion'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�༭����');
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
        cpmsg('�޸ĳɹ���', $url, 'succeed');
    }

    $qid = empty($_G['gp_qid']) ? 0 : intval($_G['gp_qid']);
    if(!$qid){
        cpmsg('����ʧ��,qid�Ƿ�', 'action=exam&operation=questionlist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_questions') ." WHERE qid = ".$qid.getSlaveID());
    $row = DB::fetch($query);

    $row['answers'] = str_replace("</br>", "\n", $row['answers']);

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		edit_save();
		window.onbeforeunload = null;
		//����
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
    
                //����
                var catid = jQuery("#catid").val();
                if(catid == '0'){
                        alert('��ѡ��������࣡');
                        return false;
                }
    
                //����ѡ��
                var questionanswers = jsTrim(jQuery("#questionanswers").val());
                if(questionanswers == ''){
                        alert('����ѡ���Ϊ�գ�');
                        return false;
                }
    
                //��������
                var qtype = jQuery("input[name=qtype]:checked").val();
                if(qtype == ''){
                        alert('��ѡ���������ͣ�');
                        return false;
                }
    
                //��ȷѡ��
                var rightanswers = jQuery("input[name=rightanswers[]]:checked").val();
                if(!rightanswers){
                    alert('������ѡ��һ����ȷѡ�');
                    return false;
                }
    
		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
EOT;

    //showtips('<li>ѡ��֮���á�|�����������磺A����|B����</li>');
    showformheader('exam&operation=editquestion&qid='.$qid, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('�������', 'title', "$row[title]", 'text', '', '', '', 'style="width:547px;"');
    showsetting('�������', '', '', '<select id="catid" name="catid"><option value="0">'."��ѡ�����".'</option>'.questiontype(2, $row['catid']).'</select>');
    showtablerow('', array('class="td27" colspan="2"'), array('����ѡ�<br><br><textarea id="questionanswers" name="questionanswers"  rows="6" cols="85" style="" >'.$row[answers].'</textarea>'));
//    showsetting('��ȷѡ��', array('rightanswers', array(
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

    $radio ='<tr><td colspan="2" class="td27">��������:</td></tr>
        <tr class="noborder"><td class="vtop rowform">
        <input value="1" name="qtype" type="radio" '.ischecked("1", $row[qtype]).'>�ж�&nbsp;&nbsp;&nbsp;&nbsp;
        <input value="2" name="qtype" type="radio" '.ischecked("2", $row[qtype]).'>��ѡ&nbsp;&nbsp;&nbsp;&nbsp;
        <input value="3" name="qtype" type="radio" '.ischecked("3", $row[qtype]).'>��ѡ</td><td class="vtop tips2"></td></tr>';
    $selected = '
    <tr><td colspan="2" class="td27">��ȷѡ��:</td></tr>
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
    //���ı��༭���ʺϴ�Wordֱ��ճ��
//    showtablerow('', array('class="td27" colspan="2"'), array('���������<textarea class="userData" name="analysis" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
//    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showtablerow('', array('class="td27" colspan="2"'), array('���������<br><br><textarea id="analysis" name="analysis"  rows="6" cols="85" style="">'.$row[analysis].'</textarea>'));
    showsetting('ͼƬ����', 'imgurl', "$row[imgurl]", 'text', '', '', '', 'style="width:697px;"');
    showsetting('��Ƶ����', 'videourl', "$row[videourl]", 'text', '', '', '', 'style="width:697px;"');
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'categorylist'){
    //ҳ��չʾ

    // **************************************************
    // ɾ���������ע���ˣ���ʱ���ṩ�ù��ܣ��漰�ط��϶�,δ��ɣ�
    // **************************************************

    cpheader();
    shownav('topic', '�༭����');
    top_nav(2);

    $category = getcategory();

    if(!submitcheck('submit')) {

        showformheader('exam&operation=categorylist&do=edit');
        showtableheader();
        echo '<tr><td colspan="2">';
        showtableheader();
        showsubtitle(array('����ID', '��ʾ˳��(����Խ��Խ��ǰ)', '��������', '�Ƿ���ʾ', '����'));
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
            $showflag = $nav['is_show'] ? "��" : "��" ;
            showtablerow('', array('class="td25"','', '', ''), array(
                "$nav[id]",
                "<input type=\"text\" class=\"txt\" size=\"2\" name=\"displayordernew[$nav[id]]\" value=\"$nav[displayorder]\">",
                "<div><input type=\"text\" class=\"txt\" size=\"15\" name=\"namenew[$nav[id]]\" value=\"".dhtmlspecialchars($nav['catname'])."\"$readonly>",
                // ��Ӷ������๦�ܣ���ʱ���ء�
                //($nav['level'] == 2 ? '' : "<a href=\"###\" onclick=\"addrowdirect=1;addrow(this, 1, $nav[id])\" class=\"addchildboard\">��Ӷ�������</a></div>"),
                "$showflag",
                "<a href=\"admin.php?action=exam&operation=editcategory&cid=$nav[id]\" target=\"_blank\">[�༭]</a>&nbsp;&nbsp;&nbsp;&nbsp;"
                ."<a href=\"admin.php?action=exam&operation=editarticlecategory&cid=$nav[id]\" target=\"_blank\">[����]</a>"
                //."<a class=\"act dodelete". $nav['id'] ."\" onclick=\"delete_cate(". $nav['id'] .")\">ɾ��</a>"
            ));
            if(!empty($subnavlist[$nav['id']])) {
                $subnavnum = count($subnavlist[$nav['id']]);
                foreach($subnavlist[$nav['id']] as $sub) {
                    $readonly = $sub['type'] == '4' ? ' readonly="readonly"' : '';
                    $showflag2 = $sub['is_show'] ? "��ʾ" : "����" ;
                    $subnavnum--;
                    showtablerow('', array('class="td25"', '', '', ''), array(
                        "$sub[id]",
                        "<input type=\"text\" class=\"txt\" size=\"2\" name=\"displayordernew[$sub[id]]\" value=\"$sub[displayorder]\">",
                        "<div class=\"".($subnavnum ? 'board' : 'lastboard')."\"><input type=\"text\" class=\"txt\" size=\"15\" name=\"namenew[$sub[id]]\" value=\"".dhtmlspecialchars($sub['catname'])."\"$readonly></div>",
                        "$showflag2",
                        "<a href=\"admin.php?action=exam&operation=editcategory&cid=$sub[id]\" target=\"_blank\">[�༭]</a>"
                        //. "<a class=\"act dodelete". $sub['id'] ."\" onclick=\"delete_cate(". $sub['id'] .")\">ɾ��</a>"
                    ));
                }
            }
        }
        echo '<tr><td colspan="1"></td><td colspan="8"><div><a href="###" onclick="addrow(this, 0, 0)" class="addtr">��ӷ���</a></div></td></tr>';
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

            cpmsg('�ύ�ɹ�', 'action=exam&operation=categorylist', 'succeed');
        }

    }



}
if($operation == 'editcategory'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�༭����');
    top_nav(2);

    if (submitcheck('addsubmit')) {
        $cid = intval($_POST['cid']);
        if(!$cid){
            cpmsg('����ʧ��,�Ƿ�id', 'action=exam&operation=categorylist', 'error');
            die;
        }
        $title = str_replace(array('"', "'"), "`", $_POST['title']);
        if(!$title){
            cpmsg('����ʧ��,����������Ϊ��', 'action=exam&operation=categorylist', 'error');
            die;
        }
        $join_nums = intval($_POST['join_nums']);

        $qtype = $_POST['qtype'];
        $imgurl = str_replace(array('"', "'"), "", trim($_POST['img']));
        $other = trim($_POST['other']);
        $other_url = trim($_POST['other_url']);
        DB::update('exam_category', array('catname' => $title, 'join_nums'=>$join_nums, 'is_show' => $qtype, 'img' => $imgurl, 'other' => $other, 'other_url' => $other_url), "id='{$cid}'");

        cpmsg('�����ɹ���', 'action=exam&operation=categorylist', 'succeed');
    }

    $cid = empty($_G['gp_cid']) ? 0 : intval($_G['gp_cid']);
    if(!$cid){
        cpmsg('����ʧ��,qid�Ƿ�', 'action=exam&operation=categorylist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_category') ." WHERE id = ".$cid.getSlaveID());
    $row = DB::fetch($query);

    require_once libfile('class/upyun_form');
    $upyun = new UpYun($_G['config']['cdn']['form']['bucket_name'], $_G['config']['cdn']['form']['form_api_secret']);

    $opts = array();
    $opts['save-key'] = '/exam/{hour}{min}{sec}{random}{.suffix}';   // ����·��
    $opts['allow-file-type'] = 'gif,jpg,jpeg,bmp,png';

    $policy = $upyun->policyCreate($opts);
    $sign = $upyun->signCreate($opts);
    $action = $upyun->action();
    $version = $upyun->version();

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    
    <script src="http://static.8264.com/static/js/webuploader.js" type="text/javascript"></script>
    <script>
        jQuery(function() {
            var $ = jQuery,
                // �Ż�retina, ��retina�����ֵ��2
                ratio = window.devicePixelRatio || 1,
                // ����ͼ��С
                thumbnailWidth = 100 * ratio,
                thumbnailHeight = 100 * ratio,
                // Web Uploaderʵ��
                uploader;
            // ��ʼ��Web Uploader
            uploader = WebUploader.create({
        
                // �Զ��ϴ���
                auto: true,
                // swf�ļ�·��
                swf: 'http://static.8264.com/static/flash/webuploader.swf',
                // �ļ����շ���ˡ�
                server: $("#action").val(),
                // ѡ���ļ��İ�ť����ѡ��
                // �ڲ����ݵ�ǰ�����Ǵ�����������inputԪ�أ�Ҳ������flash.
                pick : {id : "#filePicker",
                    //ֻ��ѡ��һ���ļ��ϴ�
                    multiple: false},		
        
                //����ֻ���ϴ�һ���ļ�
                fileNumLimit: 1, 
                fileSizeLimit: 10000000,
                threads: 1,
                runtimeOrder: 'html5,flash',
                // ֻ����ѡ���ļ�����ѡ��
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
        
            // �ļ��ϴ�upyun�Ժ󣬴�upyun��������ȡ����ֵ
            uploader.on('uploadAccept', function(obj, ret){
                if(ret.code == '200'){
                    $("#value_img").val(ret.url);
                    $("#show_img").attr('src', "http://image1.8264.com/"+ret.url);
                }
            });
        
            // ��validate��ͨ��ʱ���������ʹ����¼�����ʽ֪ͨ�����ߡ�
            uploader.on('error', function( handler ) {
                if(handler == 'Q_EXCEED_SIZE_LIMIT'){
                    alert("�ļ�̫����ѡ��С��9M���ļ�");
                }
            });
        });
    </script>

    <script>
	function validate(obj) {	
		//����
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('�������Ʋ���Ϊ�գ�');
			return false;
		}

        //�Ƿ���ʾ
        var qtype = jQuery("input[name=qtype]:checked").val();
        if(qtype == ''){
            alert('��ѡ���Ƿ���ʾ��');
            return false;
        }
        
		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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
    showsetting('��������', 'title', "$row[catname]", 'text', '', '', '', 'style="width:547px;"');
    showsetting('�μ�����', 'join_nums', "$row[join_nums]", 'text', '', '', '', 'style="width:547px;"');
    showsetting('���չʾ����', 'other', "$row[other]", 'text', '', '', '', 'style="width:547px;"');
    showsetting('���չʾ����(��http://)', 'other_url', "$row[other_url]", 'text', '', '', '', 'style="width:547px;"');

    $radio ='<tr><td colspan="2" class="td27">�Ƿ���ʾ:</td></tr>
        <tr class="noborder">
            <td class="vtop rowform">
            <input value="1" name="qtype" type="radio" '.ischecked("1", $row[is_show]).'>��&nbsp;&nbsp;&nbsp;&nbsp;
            <input value="0" name="qtype" type="radio" '.ischecked("2", $row[is_show]+2).'>��&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td class="vtop tips2"></td>
        </tr>';
    echo $radio;

    $imgbox = '<tr><td colspan="2" class="td27">�б�ͼƬ:</td></tr>
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
                
                <span id="filePicker">�ϴ�ͼƬ</span>
            </td>
        </tr>';
    echo $imgbox;


    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}


if($operation == 'peixunlist'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '������ѵ');
    top_nav(3);

    showformheader('exam&operation=questionlist','onsubmit="return subcheck(this);"');
    showtableheader();
    showsubtitle(array('', 'ID','����', '��ص�', '�ʱ��', '����ʱ��', '����'));

    $sql = "SELECT * FROM " . DB::table('exam_peixun') . " where is_show = 1 ORDER BY id DESC " . getSlaveID();
    $query = DB::query($sql);
    while ($value = DB::fetch($query)) {
        $date_arr = explode("-", $value['date']);
        showtablerow('', array('class="td25"','width="30"'), array(
            "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
            "{$value[id]}",
            "{$value[title]}",
            "<a href=\"$value[link]\" target=\"_blank\">{$value[address]}</a>",
            "$date_arr[0]��-$date_arr[1]��",
            date('Y-m-d H:i',$value['createtime']),
            "<a href=\"admin.php?action=exam&operation=editpeixun&id=$value[id]\" target=\"_blank\">[�༭]</a>"
            . "<a class=\"act dodelete". $value['id'] ."\" onclick=\"delete_peixun(". $value['id'] .")\">[ɾ��]</a>"
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
    echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=addpeixun\">����������ѵ</a></div>";
    showformfooter();
}

if($operation == 'editpeixun'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�༭��ѵ');
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
            cpmsg('��д��Ϣ����', $url, 'error');
        }
        $date = $m."-".$d;
        $datetime = strtotime(date('Y').'-'.$date.' 23:59:59');
        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $url, 'error');
        }
        DB::update('exam_peixun', array('title' => $title, 'address' => $address, 'img' => $img, 'date' => $date, 'datetime'=> $datetime, 'link' => $link ), "id='{$id}'");

        $url = preg_replace('/\/admin\.php\?/i', '', $url);
        cpmsg('�޸ĳɹ���', $url, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('����ʧ��,id�Ƿ�', 'action=exam&operation=peixunlist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_peixun') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);

    $date_arr = explode("-", $row['date']);

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//����
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
    
                //�ص�
                var address = jsTrim(jQuery("input[name=address]").val());
		jQuery("input[name=address]").val(address);
		if(address == ''){
			alert('�ص㲻��Ϊ�գ�');
			return false;
		}
    
                //ͼƬ����
                var img = jsTrim(jQuery("input[name=img]").val());
		jQuery("input[name=img]").val(img);
		if(img == ''){
			alert('ͼƬ���Ӳ���Ϊ�գ�');
			return false;
		}
    
                //����
                var m = jsTrim(jQuery("input[name=m]").val());
		jQuery("input[name=m]").val(m);
    
                var d = jsTrim(jQuery("input[name=d]").val());
		jQuery("input[name=d]").val(d);
		if(m == '' || d == ''){
			alert('���ڲ���Ϊ�գ�');
			return false;
		}
    
                //Ŀ������
                var link = jsTrim(jQuery("input[name=link]").val());
		jQuery("input[name=link]").val(link);
		if(link == ''){
			alert('Ŀ�����Ӳ���Ϊ�գ�');
			return false;
		}
    
		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
    
        function yulanimg(){
            var img = jQuery("#img").val();
            jQuery("#yulan").attr('src', img);
        }
    
	</script>
EOT;

    //showtips('<li>ѡ��֮���á�|�����������磺A����|B����</li>');
    showformheader('exam&operation=editpeixun&id='.$id, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('������ѵ����', 'title', "$row[title]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('������ѵ�ص�', 'address', "$row[address]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">ͼƬ����:(��ߣ�702*350���� http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="$row[img]" height="200px" /></div>
        </td>
    </tr>
    <tr><td colspan="2" class="td27">��ѵ����:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div>
                <input name="m" value="$date_arr[0]" type="text" class="txt" style="width:30px;">��
                <input name="d" value="$date_arr[1]" type="text" class="txt" style="width:30px;">��
            </div>
        </td>
    </tr>
    <tr><td colspan="2" class="td27">Ŀ������:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input name="link" value="$row[link]" type="text" class="txt" style="width:600px;">
        </td>
    </tr>
    
EOT;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'addpeixun'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�����ѵ');
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
            cpmsg('��д��Ϣ��ȫ', $url, 'error');
        }
        $date = $m."-".$d;
        $datetime = strtotime(date('Y').'-'.$date.' 23:59:59');
        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $url, 'error');
        }

        $createtime = time();

        DB::query("INSERT INTO " . DB::table('exam_peixun') . "
			(title, address, img, date, datetime, link, uid, createtime)
			VALUES ('{$title}', '{$address}', '{$img}', '{$date}', '{$datetime}', '{$link}', '$uid', '$createtime')");
        $id = DB::insert_id();

        cpmsg('��ӳɹ���', $url, 'succeed');
    }

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//����
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
    
                //�ص�
                var address = jsTrim(jQuery("input[name=address]").val());
		jQuery("input[name=address]").val(address);
		if(address == ''){
			alert('�ص㲻��Ϊ�գ�');
			return false;
		}
    
                //ͼƬ����
                var img = jsTrim(jQuery("input[name=img]").val());
		jQuery("input[name=img]").val(img);
		if(img == ''){
			alert('ͼƬ���Ӳ���Ϊ�գ�');
			return false;
		}
    
                //����
                var m = jsTrim(jQuery("input[name=m]").val());
		jQuery("input[name=m]").val(m);
    
                var d = jsTrim(jQuery("input[name=d]").val());
		jQuery("input[name=d]").val(d);
		if(m == '' || d == ''){
			alert('���ڲ���Ϊ�գ�');
			return false;
		}
    
                //Ŀ������
                var link = jsTrim(jQuery("input[name=link]").val());
		jQuery("input[name=link]").val(link);
		if(link == ''){
			alert('Ŀ�����Ӳ���Ϊ�գ�');
			return false;
		}
    
		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
    
        function yulanimg(){
            var img = jQuery("#img").val();
            jQuery("#yulan").attr('src', img);
        }
    
	</script>
EOT;

    //showtips('<li>ѡ��֮���á�|�����������磺A����|B����</li>');
    showformheader('exam&operation=addpeixun', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('������ѵ����', 'title', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('������ѵ�ص�', 'address', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">ͼƬ����: (��ߣ�702*350���� http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
    <tr><td colspan="2" class="td27">��ѵ����:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div>
                <input name="m" value="" type="text" class="txt" style="width:30px;">��
                <input name="d" value="" type="text" class="txt" style="width:30px;">��
            </div>
        </td>
    </tr>
    <tr><td colspan="2" class="td27">Ŀ������: (�� http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input name="link" value="" type="text" class="txt" style="width:600px;">
        </td>
    </tr>
    
EOT;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
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
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�����б�');
    top_nav(4);
    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation=shizilist&&perpage={$perpage}&page={$page}";

        if ($_G['gp_optype'] == 'trash' && $ids) {

            DB::update('exam_shizi', array('is_show'=>0), "id in ({$ids})");
            cpmsg('���߳ɹ�', $url, 'succeed');
        } else {
            cpmsg('article_choose_at_least_one_operation', $url, 'error');
        }
    }else{
        //�����
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function subcheck(obj) {
		//�������
		var op = jsTrim(jQuery("input[name=optype]:checked").val());
		if(op == 'trash'){
			if(confirm("ɾ���ǲ��ɻָ��ģ���ȷ��Ҫɾ����")){
                            return true;
                        }else{
                            return false;
                        }
		}
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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

        $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">ʦ��ID&nbsp;&nbsp;';
        $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
        $extraStr .= '<input type="hidden" name="action" value="exam"/>';
        $extraStr .= '<input type="hidden" name="operation" value="shizilist"/>';
        $extraStr .= '<input type="text" name="id" value="'.$id.'" style="height:18px;width:85px;vertical-align:middle;" placeholder="��дID" />&nbsp;&nbsp;';
        $extraStr .= '&nbsp;&nbsp;���&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">��ѡ�����</option>';
        foreach ($cat_array as $k=>$v) {
            $selectStr = $selectcat == $k ? 'selected=\"selected\"' : '';
            $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
        }
        $extraStr .= '</select>&nbsp;&nbsp;';
        $extraStr .= '<input type="submit" value="��ѯ" style="cursor:pointer;" /></form></div>';
        echo $extraStr;

        showformheader('exam&operation=shizilist','');
        showtableheader();
        showsubtitle(array('', 'ID','���', '����', '���ֲ�', '����ʱ��', '����'));

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
                    "<a href=\"\" target=\"_blank\">{$value[name]}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"admin.php?action=exam&operation=editshizi&id=$value[id]\" target=\"_blank\">[�༭]</a>",
                    $value['club'],
                    date('Y-m-d H:i',$value['createtime']),
                    "<a href=\"admin.php?action=exam&operation=editshizi&id=$value[id]\" target=\"_blank\">[�༭]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" onclick="radio_click(this)" /><label for="optype_trash">ɾ��</label>&nbsp;&nbsp;&nbsp;&nbsp;';

        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
        showtablefooter();
        echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=addshizi\">����ʦ������</a></div>";
        showformfooter();
    }

}

if($operation == 'addshizi'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '����ʦ������');
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
            cpmsg('��д��Ϣ��ȫ', $url, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $url, 'error');
        }

        $createtime = time();

        DB::query("INSERT INTO " . DB::table('exam_shizi') . "
			(catid, name, intro, club, img, uid, is_show, createtime,inst_id)
			VALUES ('$catid', '{$name}', '{$intro}', '{$club}', '{$img}', '$uid', '1', '$createtime','$inst_id')");
        $id = DB::insert_id();

        $url = preg_replace('/\/admin\.php\?/i', '', $url);
        cpmsg('��ӳɹ���', $url, 'succeed');
    }

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
	    edit_save();
		//����
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('��ѵʦ����Ϊ�գ�');
			return false;
		}
    
                //����
                var catid = jQuery("#catid").val();
                if(catid == '0'){
                        alert('��ѡ��������࣡');
                        return false;
                }
    
                //���
                var intro = jsTrim(jQuery(".intro").val());
                if(intro == ''){
                        alert('��鲻��Ϊ�գ�');
                        return false;
                }
    
                //���ֲ�
                var club = jsTrim(jQuery("input[name=club]").val());
                if(club == ''){
                        alert('���ֲ�������Ϊ�գ�');
                        return false;
                }
    
                //ͼƬ
                var img = jsTrim(jQuery("input[name=img]").val());
                if(img == ''){
                        alert('ͼƬ���Ӳ���Ϊ�գ�');
                        return false;
                }
    
		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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
    showsetting('��ѵʦ', 'name', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('��ѵ��Ŀ', '', '', '<select id="catid" name="catid"><option value="0">'."��ѡ�����".'</option>'.questiontype(2, $row['catid']).'</select>');
    showsetting('��������(��Ӻ������������ʦ�ʵ�ʱ��ѡ�У�������ʱ��Ǳ���)', '', '', '<select id="inst_id" name="inst_id"><option value="0">'."��ѡ���������".'</option>'.institutions(2, 0).'</select>');
    showtablerow('', array('class="td27" colspan="2"'), array('��飺<textarea class="intro" name="intro" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showsetting('���ֲ���', 'club', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOF
    <tr><td colspan="2" class="td27">����ͼƬ����:(��ߣ�190*270����http:// )</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg('img')" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOF;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editshizi'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�༭ʦ��');
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
            cpmsg('��д��Ϣ��ȫ', $url, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $url, 'error');
        }

        DB::update('exam_shizi', array('catid' => $catid, 'name' => $name, 'intro' => $intro, 'img' => $img, 'club' => $club, 'inst_id' => $inst_id), "id='{$id}'");

        $url = preg_replace('/\/admin\.php\?/i', '', $url);
        cpmsg('�޸ĳɹ���', $url, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('����ʧ��,id�Ƿ�', 'action=exam&operation=shizilist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_shizi') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
	    edit_save();
		//����
		var name = jsTrim(jQuery("input[name=name]").val());
		if(name == ''){
			alert('��ѵʦ����Ϊ�գ�');
			return false;
		}
    
                //����
                var catid = jQuery("#catid").val();
                if(catid == '0'){
                        alert('11');
                        return false;
                }
    
                //���
                var intro = jsTrim(jQuery(".intro").val());
                if(intro == ''){
                        alert('��鲻��Ϊ�գ�');
                        return false;
                }

                //���ֲ�
                var club = jsTrim(jQuery("input[name=club]").val());
                if(club == ''){
                        alert('���ֲ�������Ϊ�գ�');
                        return false;
                }
    
                //ͼƬ
                var img = jsTrim(jQuery("input[name=img]").val());
                if(img == ''){
                        alert('ͼƬ���Ӳ���Ϊ�գ�');
                        return false;
                }
    
		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
    function yulanimg(obj){
        var img = jQuery("#"+obj).val();
        jQuery("#yulan").attr('src', img);
    }
	</script>
EOT;

    //showtips('<li>ѡ��֮���á�|�����������磺A����|B����</li>');
    showformheader('exam&operation=editshizi&id='.$id, 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    showsetting('��ѵʦ', 'name', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('��ѵ��Ŀ', '', '', '<select id="catid" name="catid"><option value="0">'."��ѡ�����".'</option>'.questiontype(2, $row['catid']).'</select>');
    showsetting('��������(��Ӻ������������ʦ�ʵ�ʱ��ѡ�У�������ʱ��Ǳ���)', '', '', '<select id="inst_id" name="inst_id"><option value="0">'."��ѡ���������".'</option>'.institutions(2, $row['inst_id']).'</select>');
    showtablerow('', array('class="td27" colspan="2"'), array('��飺<textarea class="intro" name="intro" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px">'.$row[intro].'</textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showsetting('���ֲ���', 'club', "$row[club]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOF
    <tr><td colspan="2" class="td27">����ͼƬ����:(��ߣ�190*270����http:// )</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg('img')" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="$row[img]" height="200px" /></div>
        </td>
    </tr>
EOF;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editarticlecategory'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�����б�');
    top_nav(999);

    if(!submitcheck('submit')) {
        $catid = intval($_GET['cid']);

        if($catid > 0){
            $category = getcategory();
            $catname = $category[$catid]['catname'];
        }

        $tips = "<table class=\"tb tb2 \" id=\"tips\"><tbody><tr><th class=\"partition\">��ǰ����</th></tr><tr><td class=\"tipsblock\"><ul id=\"tipslis\"><li>".$catname."</li></ul></td></tr></tbody></table>";
        echo $tips;

        showformheader('exam&operation=editarticlecategory&do=edit');
        echo "<input type='hidden' name='cid' value=\"$catid\">";

        showtableheader();
        showsubtitle(array('����ID', '��ʾ˳��(����Խ��Խ��ǰ)', '���·�������', '����'));
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
                ."<a href=\"###\" onclick=\"addrowdirect=1;addrow(this, 1, $nav[id])\" class=\"addchildboard\">�������</a></div>",
                "<a href='admin.php?action=exam&operation=deletearticlecategory&id=".$nav[id]."&cid=".$catid."'>ɾ��</a>"
            ));
            if(!empty($subnavlist[$nav['id']])) {
                $subnavnum = count($subnavlist[$nav['id']]);
                foreach($subnavlist[$nav['id']] as $sub) {
                    $subnavnum--;
                    showtablerow('', array('class="td25"', '', '', ''), array(
                        "$sub[id]",
                        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" class=\"txt\" size=\"2\" name=\"displayordernew[$sub[id]]\" value=\"$sub[displayorder]\">",
                        "<div class=\"".($subnavnum ? 'board' : 'lastboard')."\"><input type=\"text\" class=\"txt\" size=\"15\" name=\"namenew[$sub[id]]\" value=\"".dhtmlspecialchars($sub['name'])."\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" class=\"txt\" size=\"15\" name=\"aidnew[$sub[id]]\" value=\"$sub[aid]\"></div>",
                        "<a href='admin.php?action=exam&operation=deletearticlecategory&id=".$sub[id]."&cid=".$catid."'>ɾ��</a>"
                    ));
                }
            }
        }
        echo '<tr><td colspan="1"></td><td colspan="8"><div><a href="###" onclick="addrow(this, 0, 0)" class="addtr">��ӷ���</a></div></td></tr>';
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
	[[1,'', 'td25'], [1,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="txt" name="neworder[{1}][]" value="0" />', ''], [3, '<div class="board"><input type="text" class="txt" value="���������" name="newname[{1}][]"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="txt" size="15" name="newaid[{1}][]" value="�������id"></div>']],
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

            cpmsg('�ύ�ɹ�', 'action=exam&operation=editarticlecategory&cid='.$catid, 'succeed');
        }

    }

}

if($operation == 'deletearticlecategory'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '');
    top_nav(999);

    $catid = intval($_GET['cid']);
    $id = intval($_GET['id']);

    DB::query("delete from ".DB::table('exam_article')." where id = $id");
    DB::query("delete from ".DB::table('exam_article')." where fid = $id");


    cpmsg('ɾ���ɹ�', 'action=exam&operation=editarticlecategory&cid='.$catid, 'succeed');
}

if($operation == 'deletecorrection'){
    if($_POST['id'] && $_G['uid']){
        DB::delete('exam_correction', array('id' => $_POST['id']));
        echo json_encode(array('id' => $_POST['id'], 'flag' => 1));die();
    }
}

if($operation == 'examerror'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�������');
    top_nav(5);
    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation={$operation}&&perpage={$perpage}&page={$page}";

        if($ids && $_G['gp_optype'] == 'trash'){
            DB::delete('exam_correction', "id in ({$ids})");
            cpmsg('ɾ���ɹ�', $url, 'succeed');
        }else{
            cpmsg('��ѡ����Ϣ��', $url, 'error');
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
        showsubtitle(array('', 'ID','����', '��������', '����ʱ��', '����'));

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
                "<a href=\"admin.php?action=exam&operation=editquestion&qid=$value[qid]\" target=\"_blank\">[�༭]</a>"
                . "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"delete_correction(". $value['id'] .")\">[ɾ��]</a>"
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
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" /><label for="optype_trash">ɾ��</label>&nbsp;&nbsp;&nbsp;&nbsp;';
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
    //ҳ��չʾ
    cpheader();
    shownav('topic', '��Ƶ�ع��б�');
    top_nav(6);
    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation=videolist&&perpage={$perpage}&page={$page}";

        if($ids){
            if($_G['gp_optype'] == 'trash'){
                DB::delete('exam_video', "id in ({$ids})");
                cpmsg('ɾ���ɹ�', $url, 'succeed');
            }elseif($_G['gp_optype'] == 'up'){
                DB::update('exam_video', array('is_show' => 1), "id in ({$ids})");
                cpmsg('���߳ɹ�', $url, 'succeed');
            }elseif($_G['gp_optype'] == 'down'){
                DB::update('exam_video', array('is_show' => 0), "id in ({$ids})");
                cpmsg('���߳ɹ�', $url, 'succeed');
            }else{
                cpmsg('��ѡ�������', $url, 'error');
            }
        }else{
            cpmsg('��ѡ����Ϣ��', $url, 'error');
        }
    }else{
        //�����
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
        function subcheck(obj) {
            //�������
            var op = jsTrim(jQuery("input[name=optype]:checked").val());
            if(op == 'trash'){
                if(confirm("ɾ���ǲ��ɻָ��ģ���ȷ��Ҫɾ����")){
                                return true;
                            }else{
                                return false;
                            }
            }
        }
        //ȥ�����пո�
        function jsTrimAll(str) {
            return str.replace(/\s+/g, '');
        }
        //ȥ�����˿ո�
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
        showsubtitle(array('', 'ID','����', '״̬', 'vip�ۿ�����','����ʱ��', '����'));

        $multipage = '';

        $count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('exam_video') . getSlaveID());
        if($count){
            $sql = "SELECT * FROM " . DB::table('exam_video') . " ORDER BY id DESC LIMIT {$start},{$perpage} " . getSlaveID();
            $query = DB::query($sql);
            while ($value = DB::fetch($query)) {
                if($value['is_show'] == 1){
                    $op = "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"up_down_video(". $value['id'] .",0)\">[����]</a>";
                    $status = '����';
                }else{
                    $op = "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"up_down_video(". $value['id'] .",1)\">[����]</a>";
                    $status = '����';
                }
                showtablerow('', array('class="td25"','width="30"'), array(
                    "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
                    "{$value[id]}",
                    "{$value[name]}",
                    "{$status}",
                    "{$value['vip_view']}",
                    date('Y-m-d H:i',$value['createtime']),
                    "<a class='act' href=\"admin.php?action=exam&operation=editvideo&id=$value[id]\" target=\"_blank\">[�༭]</a>".
                    $op . "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"delete_video(". $value['id'] .")\">[ɾ��]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="up" class="optype" /><label for="optype_trash">����</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_trash" value="down" class="optype" /><label for="optype_trash">����</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" /><label for="optype_trash">ɾ��</label>&nbsp;&nbsp;&nbsp;&nbsp;';

        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
        showtablefooter();
        echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=addvideo\">������Ƶ</a></div>";
        showformfooter();
    }

}

if($operation == 'addvideo'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '������Ƶ');
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
            cpmsg('��д��Ϣ��ȫ', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $back, 'error');
        }

        $createtime = time();

        DB::query("INSERT INTO " . DB::table('exam_video') . "
			(name, intro, url, uid, img, view, is_show, createtime, is_free)
			VALUES ('{$name}', '{$intro}', '{$url}', '$uid', '$img', '$view', '1', '$createtime', '$is_free')");
        $id = DB::insert_id();

        $url = preg_replace('/\/admin\.php\?/i', '', $back);
        cpmsg('��ӳɹ���', $back, 'succeed');
    }

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//����
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
        //��Ƶ
        var url = jsTrim(jQuery("input[name=url]").val());
        if(url == ''){
            alert('��Ƶ���Ӳ���Ϊ�գ�');
            return false;
        }
        //���
        var intro = jsTrim(jQuery("#intro").val());
        if(intro == ''){
                alert('��鲻��Ϊ�գ�');
                return false;
        }

		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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
    showsetting('����', 'name', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('��Ƶ��ַ(mp4��ʽ)', 'url', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">ͼƬ����: (��ߣ�702*350 �� http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showsetting('�ۿ�����', 'view', "", 'text', '', '', '', 'style="width:200px;"');
    showsetting('�Ƿ��շ�', '', '', '<input type="radio" value="1" name="is_free" checked>���&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="2" name="is_free">�շ�');
    showtablerow('', array('class="td27" colspan="2"'), array('��飺<br><br><textarea id="intro" name="intro"  rows="6" cols="85" style=""></textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editvideo'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�༭��Ƶ');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $back = "action=exam&operation=videolist";

        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        if(!$id){
            cpmsg('�Ƿ�id', $back, 'error');
        }
        $name = trim($_POST['name']);
        $intro = trim($_POST['intro']);
        $url = trim($_POST['url']);
        $img = trim($_POST['img']);
        $view = trim($_POST['view']);
        $is_free = trim($_POST['is_free']);

        if(!$name || !$intro || !$url || !$img || !$view){
            cpmsg('��д��Ϣ��ȫ', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $back, 'error');
        }

        DB::update('exam_video', array('name' => $name, 'intro' => $intro, 'url' => $url, 'img' => $img, 'view' => $view, 'is_free' => $is_free), "id='{$id}'");

        $url = preg_replace('/\/admin\.php\?/i', '', $back);
        cpmsg('�޸ĳɹ���', $back, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('����ʧ��,id�Ƿ�', 'action=exam&operation=videolist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_video') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);
    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//����
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
        //��Ƶ
        var url = jsTrim(jQuery("input[name=url]").val());
        if(url == ''){
            alert('��Ƶ���Ӳ���Ϊ�գ�');
            return false;
        }
        //���
        var intro = jsTrim(jQuery("#intro").val());
        if(intro == ''){
                alert('��鲻��Ϊ�գ�');
                return false;
        }

		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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
    showsetting('����', 'name', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('��Ƶ��ַ(mp4��ʽ)', 'url', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">ͼƬ����: (��ߣ�702*350 �� http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showsetting('�ۿ�����', 'view', "$row[view]", 'text', '', '', '', 'style="width:200px;"');
    $radio ='<tr><td colspan="2" class="td27">�Ƿ��շ�:</td></tr>
        <tr class="noborder"><td class="vtop rowform">
        <input value="1" name="is_free" type="radio" '.ischecked("1", $row[is_free]).'>���&nbsp;&nbsp;&nbsp;&nbsp;
        <input value="2" name="is_free" type="radio" '.ischecked("2", $row[is_free]).'>�շ�';
    echo $radio;
    showtablerow('', array('class="td27" colspan="2"'), array('��飺<br><br><textarea id="intro" name="intro"  rows="6" cols="85" style="">'.$row[intro].'</textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
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
    //ҳ��չʾ
    cpheader();
    shownav('topic', '���������б�');
    top_nav(7);
    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation=institutionslist&&perpage={$perpage}&page={$page}";

        if($ids){
            if($_G['gp_optype'] == 'trash'){
                DB::delete('exam_institutions', "id in ({$ids})");
                cpmsg('ɾ���ɹ�', $url, 'succeed');
            }elseif($_G['gp_optype'] == 'up'){
                DB::update('exam_institutions', array('is_show' => 1), "id in ({$ids})");
                cpmsg('���߳ɹ�', $url, 'succeed');
            }elseif($_G['gp_optype'] == 'down'){
                DB::update('exam_institutions', array('is_show' => 0), "id in ({$ids})");
                cpmsg('���߳ɹ�', $url, 'succeed');
            }else{
                cpmsg('��ѡ�������', $url, 'error');
            }
        }else{
            cpmsg('��ѡ����Ϣ��', $url, 'error');
        }
    }else{
        //�����
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
        function subcheck(obj) {
            //�������
            var op = jsTrim(jQuery("input[name=optype]:checked").val());
            if(op == 'trash'){
                if(confirm("ɾ���ǲ��ɻָ��ģ���ȷ��Ҫɾ����")){
                                return true;
                            }else{
                                return false;
                            }
            }
        }
        //ȥ�����пո�
        function jsTrimAll(str) {
            return str.replace(/\s+/g, '');
        }
        //ȥ�����˿ո�
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
        showsubtitle(array('', 'ID','����', '����', '״̬', '����ʱ��', '����'));

        $multipage = '';

        $count = DB::result_first("SELECT COUNT(*) as count FROM " . DB::table('exam_institutions') . getSlaveID());
        if($count){
            $sql = "SELECT * FROM " . DB::table('exam_institutions') . " ORDER BY sort DESC LIMIT {$start},{$perpage} " . getSlaveID();
            $query = DB::query($sql);
            while ($value = DB::fetch($query)) {
                if($value['is_show'] == 1){
                    $op = "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"up_down_institutions(". $value['id'] .",0)\">[����]</a>";
                    $status = '����';
                }else{
                    $op = "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"up_down_institutions(". $value['id'] .",1)\">[����]</a>";
                    $status = '����';
                }
                showtablerow('', array('class="td25"','width="30"'), array(
                    "<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
                    "{$value[id]}",
                    "{$value[name]}",
                    "{$value[sort]}",
                    "{$status}",
                    date('Y-m-d H:i',$value['createtime']),
                    "<a class='act' href=\"admin.php?action=exam&operation=editinstitutions&id=$value[id]\" target=\"_blank\">[�༭]</a>".
                    $op . "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"delete_institutions(". $value['id'] .")\">[ɾ��]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="up" class="optype" /><label for="optype_trash">����</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_trash" value="down" class="optype" /><label for="optype_trash">����</label>&nbsp;&nbsp;&nbsp;&nbsp;'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" /><label for="optype_trash">ɾ��</label>&nbsp;&nbsp;&nbsp;&nbsp;';

        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
        showtablefooter();
        echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=addinstitutions\">���Ӻ�������</a></div>";
        showformfooter();
    }

}

if($operation == 'addinstitutions'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '���Ӻ�������');
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
            cpmsg('��д��Ϣ��ȫ', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $url, 'error');
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
        $id ? cpmsg('��ӳɹ���', $url, 'succeed') : cpmsg('���ʧ�ܣ�����ϵ����Ա', $url, 'error');
    }

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
        edit_save();
		//����
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
       //����
        var type = jQuery(".checkbox:checked").val();
        if(!type){
            alert('������ѡ��һ���������ͣ�');
            return false;
        }
        //ʡ��
        var province = jQuery("select[name=province]").val();
        if(province == '0'){
                alert('��ѡ��ʡ�ݣ�');
                return false;
        }
        //��ַ
        var address = jsTrim(jQuery("input[name=address]").val());
        if(address == ''){
            alert('��ַ����Ϊ�գ�');
            return false;
        }
        //ͼƬ
        var url = jsTrim(jQuery("input[name=img]").val());
        if(url == ''){
            alert('ͼƬ���Ӳ���Ϊ�գ�');
            return false;
        }
        //���
        var intro = jsTrim(jQuery(".intro").val());
        if(intro == ''){
                alert('��鲻��Ϊ�գ�');
                return false;
        }

		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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
    showsetting('����', 'name', "", 'text', '', '', '', 'style="width:600px;"');
    $hzjg = '
            <tr><td colspan="2" class="td27">����:</td></tr>
            <tr class="noborder">
                <td colspan="2" class="vtop rowform">
                    <ul class="nofloat" onmouseover="altStyle(this);" style="width: 830px">
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[fx]" value="1" type="checkbox">&nbsp;��У</li>
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[sd]" value="1" type="checkbox">&nbsp;�Ե�</li>
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[hzjg]" value="1" type="checkbox">&nbsp;��������</li>
                    </ul>
                </td>
            </tr>';
    echo $hzjg;
    $pro  = province_select();

    showsetting('ʡ��', array('province', $pro), '', 'select');
    showsetting('��ַ', 'address', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('����չʾ', 'other', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('����չʾ����', 'other_url', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('����(���֣�ֵԽ��Խ��ǰ)', 'sort', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">ͼƬ����: (��ߣ�190*190 �� http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showtablerow('', array('class="td27" colspan="2"'), array('��飺<textarea class="intro" name="intro" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

if($operation == 'editinstitutions'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�༭��������');
    top_nav(999);

    if (submitcheck('addsubmit')) {

        $url= "action=exam&operation=institutionslist";

        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        if(!$id){
            cpmsg('�Ƿ�id', $url, 'error');
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
            cpmsg('��д��Ϣ��ȫ', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $url, 'error');
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
        cpmsg('�༭�ɹ���', $url, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('����ʧ��,id�Ƿ�', 'action=exam&operation=institutionslist', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_institutions') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);


    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		edit_save();
		//����
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
       //����
        var type = jQuery(".checkbox:checked").val();
        if(!type){
            alert('������ѡ��һ���������ͣ�');
            return false;
        }
        //ʡ��
        var province = jQuery("select[name=province]").val();
        if(province == '0'){
                alert('��ѡ��ʡ�ݣ�');
                return false;
        }
        //��ַ
        var address = jsTrim(jQuery("input[name=address]").val());
        if(address == ''){
            alert('��ַ����Ϊ�գ�');
            return false;
        }
        //ͼƬ
        var url = jsTrim(jQuery("input[name=img]").val());
        if(url == ''){
            alert('ͼƬ���Ӳ���Ϊ�գ�');
            return false;
        }
        //���
        var intro = jsTrim(jQuery("#intro").val());
        if(intro == ''){
                alert('��鲻��Ϊ�գ�');
                return false;
        }

		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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
    showsetting('����', 'name', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
    $hzjg = '
            <tr><td colspan="2" class="td27">����:</td></tr>
            <tr class="noborder">
                <td colspan="2" class="vtop rowform">
                    <ul class="nofloat" onmouseover="altStyle(this);" style="width: 830px">
                             <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[fx]" value="1" type="checkbox" '.ischecked("1", $row[type_fx]).'>&nbsp;��У</li>
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[sd]" value="1" type="checkbox" '.ischecked("1", $row[type_sd]).'>&nbsp;�Ե�</li>
                        <li style="float: left; width: 10%"><input class="checkbox" name="institutions_type[hzjg]" value="1" type="checkbox" '.ischecked("1", $row[type_hzjg]).'>&nbsp;��������</li>
                    </ul>
                </td>
            </tr>';
    echo $hzjg;
    $pro  = province_select();

    showsetting('ʡ��', array('province', $pro), "$row[province]", 'select');
    showsetting('��ַ', 'address', "$row[address]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('����չʾ', 'other', "$row[other]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('����չʾ����', 'other_url', "$row[other_url]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('����(���֣�ֵԽ��Խ��ǰ)', 'sort', "$row[sort]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">ͼƬ����: (��ߣ�190*190 �� http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showtablerow('', array('class="td27" colspan="2"'), array('��飺<textarea class="intro" name="intro" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px">'.$row[intro].'</textarea>'));
    showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
    showtablerow('', array('class="td25" colspan="2"'), array(
        "<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>&nbsp;&nbsp;
        <input class='btn inst_btn' id='inst_banner' type='button' value='�ֲ�ͼ' data-url='/admin.php?action=exam&operation=inst_banner&id={$row['id']}' onclick=jump('inst_banner')>&nbsp;&nbsp;
        <input class='btn inst_btn' id='inst_activity' type='button' value='�����' data-url='/admin.php?action=exam&operation=inst_activity&id={$row['id']}' onclick=jump('inst_activity')>"
    ));
    showtablefooter();
    showformfooter();
}

if($operation == 'inst_banner') {
    cpheader();
    shownav('topic', '�༭���������ֲ�ͼ');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $back = "action=exam&operation=institutionslist";

        $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
        if(!$id){
            cpmsg('�Ƿ�id', $back, 'error');
        }
        $name = $_POST['name'];
        $url = $_POST['url'];
        $img = $_POST['img'];
        if(!$img){
            cpmsg('��д��Ϣ��ȫ', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $back, 'error');
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

        cpmsg('�����ɹ���', $url, 'succeed');
    }

    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('����ʧ��,id�Ƿ�', 'action=exam&operation=institutions', 'error');
        die;
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_institutions_other') ." WHERE inst_id = ".$id. " and type=1 order by id asc".getSlaveID());
    $row = DB::fetch($query);
    if($row){
        showformheader('exam&operation=inst_banner&id='.$id, '', 'ksform');
        showtableheader();
        showsetting('ͼƬ����1', 'name[1]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('��ת����1', 'url[1]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('ͼƬ����1: (��ߣ�750*380 �� http://)', 'img[1]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');
        $i=2;
        while($row = DB::fetch($query)){
            showsetting('ͼƬ����'.$i, 'name['.$i.']', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
            showsetting('��ת����'.$i, 'url['.$i.']', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
            showsetting('ͼƬ����:'.$i.' (��ߣ�750*380 �� http://)', 'img['.$i.']', "$row[img]", 'text', '', '', '', 'style="width:600px;"');
            $i++;
        }
        $y = 5-$i;
        if($y > 0){
            for($i = $i;$i < 6; $i++){
                showsetting('ͼƬ����'.$i, 'name['.$i.']', "", 'text', '', '', '', 'style="width:600px;"');
                showsetting('��ת����'.$i, 'url['.$i.']', "", 'text', '', '', '', 'style="width:600px;"');
                showsetting('ͼƬ����:'.$i.' (��ߣ�750*380 �� http://)', 'img['.$i.']', "", 'text', '', '', '', 'style="width:600px;"');
            }
        }
    }else{

        showformheader('exam&operation=inst_banner&id='.$id, '', 'ksform');
        showtableheader();
        showsetting('ͼƬ����1', 'name[1]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('��ת����1', 'url[1]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('ͼƬ����1: (��ߣ�750*380 �� http://)', 'img[1]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');

        showsetting('ͼƬ����2', 'name[2]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('��ת����2', 'url[2]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('ͼƬ����2: (��ߣ�750*380 �� http://)', 'img[2]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');

        showsetting('ͼƬ����3', 'name[3]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('��ת����3', 'url[3]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('ͼƬ����3: (��ߣ�750*380 �� http://)', 'img[3]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');

        showsetting('ͼƬ����4', 'name[4]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('��ת����4', 'url[4]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('ͼƬ����4: (��ߣ�750*380 �� http://)', 'img[4]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');

        showsetting('ͼƬ����5', 'name[5]', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('��ת����5', 'url[5]', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
        showsetting('ͼƬ����5: (��ߣ�750*380 �� http://)', 'img[5]', "$row[img]", 'text', '', '', '', 'style="width:600px;"');
    }

    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();
}

if($operation == 'inst_activity'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '�������������');
    top_nav(7);
    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);

    if(!$id){
        cpmsg('ȱ�ٲ���', $_SERVER['HTTP_REFERER'], 'error');
    }

    if (submitcheck('questionsubmit')) {
        $perpage = intval($_G['gp_hiddenperpage']);
        $page = intval($_G['gp_hiddenpage']);

        $ids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";
        $url = "action=exam&operation=inst_activity&id={$id}&&perpage={$perpage}&page={$page}";

        if($ids){
            if($_G['gp_optype'] == 'trash'){
                DB::delete('exam_institutions_other', "id in ({$ids})");
                cpmsg('ɾ���ɹ�', $url, 'succeed');
            }else{
                cpmsg('��ѡ�������', $url, 'error');
            }
        }else{
            cpmsg('��ѡ����Ϣ��', $url, 'error');
        }
    }else{
        //�����
        echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
        function subcheck(obj) {
            //�������
            var op = jsTrim(jQuery("input[name=optype]:checked").val());
            if(op == 'trash'){
                if(confirm("ɾ���ǲ��ɻָ��ģ���ȷ��Ҫɾ����")){
                                return true;
                            }else{
                                return false;
                            }
            }
        }
        //ȥ�����пո�
        function jsTrimAll(str) {
            return str.replace(/\s+/g, '');
        }
        //ȥ�����˿ո�
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
        showsubtitle(array('', 'ID','����', '����ʱ��', '����'));

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
                    "<a class='act' href=\"admin.php?action=exam&operation=edit_inst_activity&id=$value[id]\" target=\"_blank\">[�༭]</a>".
                    $op . "<a  class=\"act dodelete". $value['id'] ."\" onclick=\"delete_inst_activity(". $value['id'] .")\">[ɾ��]</a>"
                ));
            }
            $multipage = multi($count, $perpage, $page, $mpurl);
        }

        $optypehtml = ''
            . '<input type="hidden" name="hiddenpage" id="hiddenpage" value="' . $page . '"/>'
            . '<input type="hidden" name="hiddenperpage" id="hiddenperpage" value="' . $perpage . '"/>'
            . '<input type="radio" name="optype" id="optype_trash" value="trash" class="optype" /><label for="optype_trash">ɾ��</label>&nbsp;&nbsp;&nbsp;&nbsp;';

        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">' . cplang('select_all') . '</label>&nbsp;&nbsp;' . $optypehtml . '<input type="submit" class="btn" name="questionsubmit" value="' . cplang('submit') . '" />', $multipage);
        showtablefooter();
        echo "<div style='padding-top:30px;'></div><hr><div style='padding-left:65px;padding-top:5px;'><a href=\"admin.php?action=exam&operation=inst_activity_add&id=".$id."\">���ӻ</a></div>";
        showformfooter();
    }
}

if($operation == 'inst_activity_add'){

    cpheader();
    shownav('topic', '���Ӻ��������');
    top_nav(7);
    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('ȱ�ٲ���', $_SERVER['HTTP_REFERER'], 'error');
    }

    if (submitcheck('addsubmit')) {
        $name = trim($_POST['name']);
        $url = trim($_POST['url']);
        $img = trim($_POST['img']);

        $back = "action=exam&operation=inst_activity&id=".$id;

        if(!$name || !$url || !$img){
            cpmsg('��д��Ϣ��ȫ', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $back, 'error');
        }

        $createtime = time();

        DB::query("INSERT INTO " . DB::table('exam_institutions_other') . "
			(name, url, uid, img, type, createtime, inst_id)
			VALUES ('{$name}', '{$url}', '$uid', '$img', '2', '$createtime', '$id')");
        $id = DB::insert_id();

        $url = preg_replace('/\/admin\.php\?/i', '', $back);
        cpmsg('��ӳɹ���', $back, 'succeed');
    }

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//����
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
        //��Ƶ
        var url = jsTrim(jQuery("input[name=url]").val());
        if(url == ''){
            alert('���Ӳ���Ϊ�գ�');
            return false;
        }
        //���
        var img = jsTrim(jQuery("input[name=img]").val());
        if(img == ''){
                alert('ͼƬ���Ӳ���Ϊ�գ�');
                return false;
        }

		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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
    showsetting('����', 'name', "", 'text', '', '', '', 'style="width:600px;"');
    showsetting('����', 'url', "", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">ͼƬ����: (��ߣ�702*350 �� http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
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
    shownav('topic', '�༭���������');
    top_nav(7);
    $id = empty($_G['gp_id']) ? 0 : intval($_G['gp_id']);
    if(!$id){
        cpmsg('ȱ�ٲ���', $_SERVER['HTTP_REFERER'], 'error');
    }
    $query = DB::query("SELECT * FROM ". DB::table('exam_institutions_other') ." WHERE id = ".$id.getSlaveID());
    $row = DB::fetch($query);

    if (submitcheck('addsubmit')) {
        $name = trim($_POST['name']);
        $url = trim($_POST['url']);
        $img = trim($_POST['img']);

        $back = "action=exam&operation=inst_activity&id=".$row['inst_id'];

        if(!$name || !$url || !$img){
            cpmsg('��д��Ϣ��ȫ', $back, 'error');
        }

        $uid = $_G['uid'];
        if(!$uid){
            cpmsg('�Ƿ�uid', $back, 'error');
        }

        $createtime = time();
        $hd_data = array(
            'name' => $name,
            'url' => $url,
            'img' => $img
        );
        DB::update('exam_institutions_other', $hd_data, "id={$id}");

        $url = preg_replace('/\/admin\.php\?/i', '', $back);
        cpmsg('�༭�ɹ���', $back, 'succeed');
    }

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//����
		var name = jsTrim(jQuery("input[name=name]").val());
		jQuery("input[name=name]").val(name);
		if(name == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
        //��Ƶ
        var url = jsTrim(jQuery("input[name=url]").val());
        if(url == ''){
            alert('���Ӳ���Ϊ�գ�');
            return false;
        }
        //���
        var img = jsTrim(jQuery("input[name=img]").val());
        if(img == ''){
                alert('ͼƬ���Ӳ���Ϊ�գ�');
                return false;
        }

		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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
    showsetting('����', 'name', "$row[name]", 'text', '', '', '', 'style="width:600px;"');
    showsetting('����', 'url', "$row[url]", 'text', '', '', '', 'style="width:600px;"');
    echo <<<EOT
    <tr><td colspan="2" class="td27">ͼƬ����: (��ߣ�702*350 �� http://)</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
        <input id="img" name="img" value="$row[img]" type="text" class="txt" style="width:600px;">
        </td>
        <td class="vtop tips2"><input class='btn' type="button" onclick="yulanimg()" value="Ԥ��" /></td>
    </tr>
    <tr><td colspan="2" class="td27">ͼƬԤ��:</td></tr>
    <tr class="noborder">
        <td class="vtop rowform">
            <div><img id="yulan" src="" height="200px" /></div>
        </td>
    </tr>
EOT;
    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();
}

if($operation == 'wechat_user'){
    //ҳ��չʾ
    cpheader();
    shownav('topic', '΢���û��б�');
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

    $cat_array = array(1=>'��',2=>'��');

    $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">UID&nbsp;&nbsp;';
    $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
    $extraStr .= '<input type="hidden" name="action" value="exam"/>';
    $extraStr .= '<input type="hidden" name="operation" value="wechat_user"/>';
    $extraStr .= '<input type="text" name="UID" value="'.$UID.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;΢���ǳ�&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="nickname" value="'.$nickname.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;�ֻ���&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="mobile" value="'.$mobile.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;����״̬&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">��ѡ��</option>';
    foreach ($cat_array as $k=>$v) {
        $selectStr = $selectcat == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';
    $extraStr .= '<input type="submit" value="��ѯ" style="cursor:pointer;" /></form></div>';
    echo $extraStr;

    showtableheader();
    showsubtitle(array( 'UID','΢���ǳ�', '�ֻ���', '����״̬', '���ѵ���','����'));

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
                $status = '��';
                $vip_end = date('Y-m-d H:i',$value['vip_end']);
                $op = '<span style="color: lightgrey">�ѿ�ͨ��Ա</span>';
            }else{
                $status = '��';
                $vip_end = '';
                $op ="<a href=\"admin.php?action=exam&operation=add_vip_user&uid=$value[uid]&mobile=$value[mobile]\">[��ͨ��Ա]</a>";
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
    //ҳ��չʾ
    cpheader();
    shownav('topic', '���Ѽ�¼');
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

    $cat_array = array(1=>'������ֵ',2=>'��̨���');
    $pay_type_array = array(1=>'��Ա',2=>'��Ƶ');

    $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">UID&nbsp;&nbsp;';
    $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
    $extraStr .= '<input type="hidden" name="action" value="exam"/>';
    $extraStr .= '<input type="hidden" name="operation" value="pay_record"/>';
    $extraStr .= '<input type="text" name="UID" value="'.$UID.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;΢���ǳ�&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="nickname" value="'.$nickname.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;�ֻ���&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="mobile" value="'.$mobile.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;��ֵ����&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">��ѡ��</option>';
    foreach ($cat_array as $k=>$v) {
        $selectStr = $selectcat == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';

    $extraStr .= '&nbsp;&nbsp;��ֵ����&nbsp;&nbsp;<select id="select_pay_type" name="select_pay_type"><option value="0">��ѡ��</option>';
    foreach ($pay_type_array as $k=>$v) {
        $selectStr = $select_pay_type == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;΢��֧��������&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="transaction_id" value="'.$transaction_id.'" style="height:18px;width:250px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '<input type="submit" value="��ѯ" style="cursor:pointer;" /></form></div>';
    echo $extraStr;

    showtableheader();
    showsubtitle(array( 'UID','΢���ǳ�', '�ֻ���', '΢��֧��������', '�������(Ԫ)','��������','����ʱ��'));

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
                $type_zh = '��Ա���';
            }else{
                $type_zh = '��Ƶ����(��ƵID:'.$value['pay_id'].')';
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
    //ҳ��չʾ
    cpheader();
    shownav('topic', 'װ���ʼ�');
    top_nav(10);
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function order_status(id) {
		//�������
			if(confirm("״̬�����ǲ��ɻָ��ģ���ȷ��Ҫ������")){
			     jQuery.ajax({
                    type : 'POST',
                    url : '/admin.php?action=exam&operation=equipment_order_status',
                    data : {id:id},
                    success:function(result){
                            result = eval("("+result+")");
                            if(result.flag == '1'){
                                window.location.reload();
                            }else{
                                alert('ϵͳ��æ�����Ժ�����')
                            }
                    }
                });
            }else{
                return false;
            }
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
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

    $cat_array = array(1=>'δ�ʼ�',2=>'���ʼ�');
    $channel_array = array(1=>'������ֵ',2=>'��̨���');

    $extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">UID&nbsp;&nbsp;';
    $extraStr .= '&nbsp;<form action="admin.php" method="GET" style="display:inline;">';
    $extraStr .= '<input type="hidden" name="action" value="exam"/>';
    $extraStr .= '<input type="hidden" name="operation" value="equipment_order"/>';
    $extraStr .= '<input type="text" name="UID" value="'.$UID.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;΢���ǳ�&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="nickname" value="'.$nickname.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;�ֻ���&nbsp;&nbsp;';
    $extraStr .= '<input type="text" name="mobile" value="'.$mobile.'" style="height:18px;width:85px;vertical-align:middle;"/>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;��ֵ����&nbsp;&nbsp;<select id="select_channel" name="select_channel"><option value="0">��ѡ��</option>';
    foreach ($channel_array as $k=>$v) {
        $selectStr = $select_channel == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';
    $extraStr .= '&nbsp;&nbsp;�ʼ�״̬&nbsp;&nbsp;<select id="selectcat" name="selectcat"><option value="0">��ѡ��</option>';
    foreach ($cat_array as $k=>$v) {
        $selectStr1 = $selectcat == $k ? 'selected=\"selected\"' : '';
        $extraStr .= "<option value=\"{$k}\" {$selectStr1}>{$v}</option>";
    }
    $extraStr .= '</select>&nbsp;&nbsp;';
    $extraStr .= '<input type="submit" value="��ѯ" style="cursor:pointer;" /></form></div>';
    echo $extraStr;

    showtableheader();
    showsubtitle(array( 'UID','΢���ǳ�','�ռ���','�ֻ���','��ַ','��ֵ����','״̬','����ʱ��'));

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
                $type_zh = "<a href=\"javascript:///\" onclick='order_status($value[id])' target=\"_blank\">[δ�ʼ�]</a>";
            }else{
                $type_zh = '���ʼ�';
            }
            if($value['op_uid'] > 0){
                $op_add = '<span style="color: red">��̨���</span>';
            }else{
                $op_add = '������ֵ';
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
    //ҳ��չʾ
    cpheader();
    shownav('topic', '����vip��Ա');
    top_nav(999);

    if (submitcheck('addsubmit')) {
        $mobile = trim($_POST['mobile']);

        $back = $_SERVER['HTTP_REFERER'];

        $add_refer = trim($_POST['add_refer']);

        $user_id = trim($_POST['uid']);

        if(strpos($add_refer,'wechat_user') == false){
            cpmsg('��Դ����', $back, 'error');
        }
        if(!$mobile){
            cpmsg('��д��Ϣ��ȫ', $back, 'error');
        }
        if(!$user_id){
            cpmsg('�û�������', $back, 'error');
        }

        if(!$_G['uid']){
            cpmsg('�Ƿ�uid', $back, 'error');
        }

        $vip_begin = time();
        $data = array();
        $data['vip_begin'] = strtotime(date('Y-m-d',$vip_begin));
        $data['vip_end'] = strtotime("+1 year",$data['vip_begin']);
        $data['op_uid'] = $_G['uid'];
        $data['mobile'] = $mobile;

        //�����ֻ��š�vipʱ�䡢�ֶ�״̬
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
                cpmsg('��ͨ�ɹ���', $add_refer, 'succeed');
            }else{
                $data['vip_begin'] = $data['vip_end'] = $data['op_uid'] = 0;
                DB::update('common_member_connect_wechat', $data, "uid = ({$user_id})");
                cpmsg('��ͨʧ��,����ϵ����Ա��', $back, 'error');
            }
        }else{
            cpmsg('��ͨʧ��,����ϵ����Ա��', $back, 'error');
        }
    }

    //�����
    echo <<<EOT
    <script src="static/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
    <script src="static/image/editor/editor_function.js"></script>
    <script>
	function validate(obj) {
		//����
		var mobile = jsTrim(jQuery("input[name=mobile]").val());
		if(mobile == ''){
			alert('�ֻ��Ų���Ϊ�գ�');
			return false;
		}
        if(!(/^1[3|4|5|7|8]\d{9}$/.test(mobile))){
                alert("��������ȷ�ֻ���");
                return false;
        }
		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	</script>
EOT;
    $uid = $_G['gp_uid'];
    if(!$uid){
        cpmsg('�Ƿ�uid', '', 'error');
    }
    $mobile = trim($_GET['mobile']);

    $add_refer = $_SERVER['HTTP_REFERER'];

    showformheader('exam&operation=add_vip_user', 'onsubmit="return validate(this);"', 'ksform');
    showtableheader();
    echo '<tr><td colspan="2" class="td27">UID:</td></tr>';
    echo '<tr class="noborder"><td class="vtop rowform">'.$uid.'</td><td class="vtop tips2"></td></tr>';
    showsetting('�ֻ���', 'mobile', $mobile?$mobile:'', 'text', '', '', '', 'style="width:200px;"');
    echo "<input type='hidden' name='add_refer' value=\"$add_refer\">";
    echo "<input type='hidden' name='uid' value=\"$uid\">";

    showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='��Ϊ��Ա'  name='addsubmit'>"));
    showtablefooter();
    showformfooter();

}

//��ȡ��������б�type=1 �������飬type=2 ����HTML option
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
//���������б� type=1 �������飬type=2 ����HTML option
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
        array('�����б�', 'exam&operation=questionlist', 0), //���������������Ƿ��ǵ�ǰ�˵�
        array('�������', 'exam&operation=addquestion', 0),
        array('�����б�', 'exam&operation=categorylist', 0),
        array('������ѵ', 'exam&operation=peixunlist', 0),
        array('ʦ������', 'exam&operation=shizilist', 0),
        array('�������', 'exam&operation=examerror', 0),
        array('��Ƶ�ع�', 'exam&operation=videolist', 0),
        array('��������', 'exam&operation=institutionslist', 0),
        array('΢���û�', 'exam&operation=wechat_user', 0),
        array('���Ѽ�¼', 'exam&operation=pay_record', 0),
        array('װ���ʼ�', 'exam&operation=equipment_order', 0)
    );
    if($index != 999){
        $nav[$index][2] = 1;
    }
    showsubmenu('���Թ���',$nav);
}

function province_select(){
    $arr = array(
        array('0','��ѡ��ʡ��')
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