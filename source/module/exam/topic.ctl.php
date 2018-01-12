<?php

/**
 * @author zhang wenchu
 * @copyright 2016
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('QUESTION_LEVEL_1', 5);
define('QUESTION_LEVEL_2', 10);
define('QUESTION_LEVEL_3', 20);
define('EXAM_WECHAT', true);

Class TopicCtl extends ExamCtl {

	var $modname = 'topic';
    var $isWechat = 0;
    var $wx_share_img = 'http://static.8264.com/static/images/exam/wxshare.jpg';
    var $pc_wechat_login = 'http://www.8264.com/connect.php?method=wechat&action=login&op=init';
    var $wechat_user_unionid;
    var $wechat_user_openid;
    var $pay_content = array(
        1 => '����ѧУ-����vip',
        2 => '����ѧУ-������Ƶ'
    );
    var $total_fee = array(
        1 => 39900,
        2 => 990
    );
    var $neiren = array(
        'oO2EFj54wE4Km0e3xMXJ8G8DDtvU',
        'oO2EFj3Po9zdfNRJEUqxt8zv-MHs',
        'oO2EFj45sMd7tqXMms3s0IkDqHHI',
        'oO2EFj-3VY2VqytBmu1n2-XL7QfE',
        'oO2EFj95KPkJizHMFGpbewTYNZws',
        'oO2EFjy4nYVxST2BKKa-o7e-qn1o',
        'oO2EFjw45vvzlNCE5_lLmNlDmtOM',
        'oO2EFj09tGEv_JkYIC28mbrVSHg8',
        'oO2EFj0uHhbUzAC8NKXsCGblTAhk'
    );
	function __construct()
	{
		parent::__construct();
        if(strpos($_SERVER['REQUEST_URI'],'ajax_check_order') == false and strpos($_SERVER['REQUEST_URI'],'ajaxMobilesend') == false and strpos($_SERVER['REQUEST_URI'],'ajaxcheckcode') == false and strpos($_SERVER['REQUEST_URI'],'get_wechat_info') == false and strpos($_SERVER['REQUEST_URI'],'rights') == false and strpos($_SERVER['REQUEST_URI'],'check_mobile') == false and strpos($_SERVER['REQUEST_URI'],'pay') == false and strpos($_SERVER['REQUEST_URI'],'is_vip') == false and strpos($_SERVER['REQUEST_URI'],'tmpdelete') == false and strpos($_SERVER['REQUEST_URI'],'up_info') == false){
            $http_referer = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            dsetcookie("exam_http_referer", $http_referer, 1800);
        }
        if( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == true ){
			$this->isWechat = 1;

			$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
			if (strpos($agent, 'android')) {
				$this->phonetype = 'android';
			} else {
				$this->phonetype = 'ios';
			}
			$this->assign("phonetype",$this->phonetype);
			$this->assign("isWechat",$this->isWechat);

            $back_url = $_SERVER['HTTP_REFERER'];
            $this->assign("back_url",$back_url);

            $this->wechat_user_unionid = getcookie('wechat_user_unionid');
            $this->wechat_user_openid  = getcookie('wechat_user_openid');
            //�����û�����
//            if(in_array($this->wechat_user_unionid, $this->neiren)){
//                $this->assign("is_show_nav",1);
//            }
            if((!$this->wechat_user_unionid or !$this->wechat_user_openid) and strpos($_SERVER['REQUEST_URI'],'tmpdelete') == false){
                $this->authorization();
            }
		}else{
            $this->isWechat = 0;
        }
	}

	function showlist(){
		global $_G;
		require_once libfile('class/myredis');
		$myredis = & myredis::instance();

		//������ѵ
		$peixun_result = array();
		$peixun_result = memory('get', 'exam_peixun_result');
		if(!$peixun_result || $_G['group'] == 1){
            $query = DB::query("SELECT * FROM " . DB::table('exam_institutions') . " WHERE is_show = 1 order by sort desc limit 4 " . getSlaveID());
            while ($row = DB::fetch($query)) {
                $inst_other = DB::fetch(DB::query("SELECT * FROM ".DB::table('exam_institutions_other')." where inst_id = ".$row['id']." ORDER BY id ASC limit 1"));
                $row['img'] = $inst_other['img'];
                $peixun_result[] = $row;
            }
			memory('set', 'exam_peixun_result', $peixun_result, 300);
		}

        //΢�ŷ���
        $data['signPackage'] = $this->_get_share_params();
        $data['wxshareImg'] = $this->wx_share_img;
//        print_r($data['signPackage']);die();

//		$data['exam_arr'] = $exam_arr;
//		$data['practice_arr'] = $practice_arr;
		$data['navtitle'] = '�����˶�֪ʶѧϰ�Ϳ���ϵͳ';
		$data['peixun_result'] = $peixun_result;


		$list_arr = memory('get', 'exam_kaoshi_list_array');
		if(!$list_arr || $_G['group'] == 1) {
			$query = DB::query("SELECT * FROM " . DB::table('exam_category') . " WHERE is_show = 1 order by displayorder desc, id desc " . getSlaveID());
			while ($raw = DB::fetch($query)) {
				$list_arr[] = $raw;
			}

			memory('set', 'exam_kaoshi_list_array', $list_arr, 300);
		}

		foreach($list_arr as $v){
			$join_nums = $myredis->GET("xuexiao_catid_".$v[id]."_nums");
			if(!$join_nums || $join_nums != $v['join_nums']){
				$myredis->SET("xuexiao_catid_".$v[id]."_nums", $v['join_nums']);
			}
		}

		$data['list_arr'] = $list_arr;
		$data['isWechat'] = $this->isWechat;

		$this->assign($data);

		$this->display('exam/topic/list');
	}
        
        function fenxiang(){
            $id = max(0, intval($_GET['id']));
            if($id){
                $res = DB::fetch_first("select uid,scores from ".DB::table('exam_record')." where id = ".$id.  getSlaveID());
            }else{
                $this->showmessage('�Ƿ�id!');
            }
            $str =  "uid�ǣ�".$res['uid']."<br> �����ǣ�".$res['scores']."<br> �����ǣ�XXXXXXXXXXX"."<br> �����ǣ�http://www.8264.com/kaoshi";
            
            $data['navtitle'] = '�����˶�֪ʶѧϰ�Ϳ���ϵͳ';
            $data['scores'] = $res['scores'];
            
            if($res['scores']>=0 && $res['scores']<=28){
                $data['pingyu'] = "�꣬��ǧ��Ҫ˵���滧���ѽ";
            }elseif($res['scores']>=30 && $res['scores']<=48){
                $data['pingyu'] = "�ţ����аɣ����Լ�ȥ��ɣ���԰���Сɽ�±Ƚ��ʺ���";
            }elseif($res['scores']>=50 && $res['scores']<=68){
                $data['pingyu'] = "���ϣ�����Ŷ����̫·�ϴ�����";
            }elseif($res['scores']>=70 && $res['scores']<=88){
                $data['pingyu'] = "�����ˣ�wold�磨�㣩������ȥ����ѩɽզ��";
            }elseif($res['scores']>=90 && $res['scores']<=100){
                $data['pingyu'] = "���������ҵ�ϥ�ǣ���Ҫ��������";
            }else{
                $data['pingyu'] = "8264.com";
            }
            
            
            $this->assign($data);
            $this->display('exam/topic/fenxiang');
        }

		function login(){
            $this->is_wechat();
            $this->xuexiao_wechat_info();
		}

		function catinfo(){
			global $_G;

			require_once libfile('class/myredis');
			$myredis = & myredis::instance();

			$kaoshi_cat_array = memory('get', 'exam_kaoshi_cat_array');
			if(!$kaoshi_cat_array || $_G['group'] == 1){
				$query = DB::query("SELECT id,catname FROM ". DB::table('exam_category')." WHERE is_show = 1 " .getSlaveID());
				while($raw = DB::fetch($query)){
					$kaoshi_cat_array[$raw['id']] = $raw['catname'];
				}

				memory('set', 'exam_kaoshi_cat_array', $kaoshi_cat_array, 300);
			}

			$catid = max(0, intval($_GET['cat']));
            $cate_query = DB::query("SELECT id,catname,other,other_url FROM ". DB::table('exam_category')." WHERE is_show = 1 and id = $catid " .getSlaveID());
            $cate = DB::fetch($cate_query);
            if(!$cate){
                $this->showmessage('�Ƿ�cat!');
            }
			$catname = $kaoshi_cat_array[$catid];

			//ʦ������
			$shizi_result = memory('get', 'exam_shizi_result_'.$catid);
			if(!$shizi_result || $_G['group'] == 1){
				$shizi_query = DB::query("SELECT * FROM ".DB::table('exam_shizi')." where is_show = 1 and catid = $catid ORDER BY id DESC ");
				while($value = DB::fetch($shizi_query)){
					$shizi_result[] = $value;
				}

				memory('set', 'exam_shizi_result_'.$catid, $shizi_result, 300);
			}

			//ѧϰ����
			$xuexi_result = memory('get', 'exam_xuexi_result_'.$catid);
			if(!$xuexi_result || $_G['group'] == 1){
				$xuexi_tmp = array();
				$xuexi_list_query = DB::query("select * from ".DB::table('exam_article')." where catid = $catid order by displayorder desc, id desc");
				while($value = DB::fetch($xuexi_list_query)){
					$xuexi_tmp[$value['id']] = $value;
				}

				foreach($xuexi_tmp as $k=>$v){
					if($v['fid'] == 0){
						$xuexi_result['first'][$v['id']] = $v;
					}else{
						$xuexi_result['second'][$v['fid']][] = $v;
					}
				}

				foreach($xuexi_result['first'] as $k=>$v){
					if( is_array($xuexi_result['second'][$k]) ){
						$xuexi_result['first'][$k]['counts'] = count($xuexi_result['second'][$k]);
					}else{
						$xuexi_result['first'][$k]['counts'] = 0;
					}
				}
				memory('set', 'exam_xuexi_result_'.$catid, $xuexi_result, 300);
			}

			$data['catid'] = $catid;
			$data['catname'] = $catname;
			$data['shizi_result'] = $shizi_result;
			$data['num'] = $myredis->GET("xuexiao_catid_".$catid."_nums");

			$data['xuexi_result'] = $xuexi_result;

            $data['isWechat'] = $this->isWechat;

			$data['back_url'] = "http://www.8264.com/xuexiao/";

            $data['other'] = $cate['other'];
            $data['other_url'] = $cate['other_url'];

            //΢�ŷ���
            $data['signPackage'] = $this->_get_share_params();
            $data['wxshareImg'] = $this->wx_share_img;
			$this->assign($data);
			$this->display('exam/topic/catinfo');
		}

	function getarticle(){
		global $_G;

		$aid = intval($_POST['aid']);
		if($aid > 0){
			$article_content = memory('get', 'exam_article_'.$aid);
			if(!$article_content || $_G['group'] == 1){
				$article_query = DB::query("select content from ".DB::table('portal_article_content')." where aid = $aid order by pageorder asc");
				while($value = DB::fetch($article_query)){
					$article_content .= $value['content'];
				}

				$article_content = preg_replace("/\[flash\=?(media|real)*\](.+?)\[\/flash\]/i", "<embed width=\"520\" height=\"390\" allownetworking=\"internal\" allowscriptaccess=\"none\" src='\\2'  quality=\"high\" bgcolor=\"#ffffff\" wmode=\"transparent\" allowfullscreen=\"true\" type=\"application/x-shockwave-flash\">", $article_content);

				memory('set', 'exam_article_'.$aid, $article_content, 300);
			}

			echo json_encode(array('flag'=>1, 'aid'=>$aid, 'content'=>iconv("gbk", "utf-8", $article_content)));
		}else{
			echo json_encode(array('flag'=>0));
		}
	}
	
	function index() {
		global $_G;
        if($this->isWechat == 0){
            if(!$_G['uid']){
                $this->pc_login();
            }
        }
		$kaoshi_cat_array = memory('get', 'exam_kaoshi_cat_array');
		if(!$kaoshi_cat_array || $_G['group'] == 1){
			$query = DB::query("SELECT id,catname FROM ". DB::table('exam_category')." WHERE is_show = 1 " .getSlaveID());
			while($raw = DB::fetch($query)){
				$kaoshi_cat_array[$raw['id']] = $raw['catname'];
			}

			memory('set', 'exam_kaoshi_cat_array', $kaoshi_cat_array, 300);
		}

		if($_GET['dotest'] == 1){
			print_r($kaoshi_cat_array);die;
		}

		require_once libfile('class/myredis');
		$myredis = & myredis::instance();


		if(empty($_GET['type']) || !in_array($_GET['type'], array('exam', 'practice'))) $_GET['type'] = 'exam';
		$catid = max(0, intval($_GET['cat']));

		if($catid != '0' && !in_array($catid, array_keys($kaoshi_cat_array)) ){
			$this->showmessage('�Ƿ�cat!');
		}
		if($catid){
			$myredis->sInterStore("exam_catid_".$catid, "exam_catid_".$catid, "exam_all_ids");
			$qids_arr = $myredis->sDiff("exam_catid_".$catid, "exam_noshow_ids");

			$catname = $kaoshi_cat_array[$catid];
		}else{
			$qids_arr = $myredis->sDiff("exam_all_ids", "exam_noshow_ids");
		}

		if($_GET['dotest'] == 2){
			print_r($qids_arr);die;
		}

		if($_GET['type'] == 'exam'){

			$base = (int)$_GET['base'];
			$base = in_array($base, array('1','2','3')) ? $base : 1;

			switch($base){
				case 1:
					$qcount = QUESTION_LEVEL_1;
					$basename = "����";
					break;
				case 2:
					$qcount = QUESTION_LEVEL_2;
					$basename = "�м�";
					break;
				case 3:
					$qcount = QUESTION_LEVEL_3;
					$basename = "�߼�";
					break;
			}
			if(!empty($qids_arr)){
				$qids_arr = array_slice($qids_arr, 0, $qcount);

				$qids = implode(",", $qids_arr);

				$question_query = DB::query("SELECT qid,title,qtype,answers,right_answer,analysis,imgurl,videourl FROM ". DB::table('exam_questions') ." WHERE  qid IN (".$qids.") ". getSlaveID() );
                        while($row = DB::fetch($question_query)){
                            $questions[] = $row;
                            $db_qids[] = $row['qid'];
                        }
                        
                        $diff_qids = array_diff($qids_arr, $db_qids);
                        if(!empty($diff_qids)){
                            foreach($diff_qids as $v){
                                $myredis->sRem("exam_all_ids", $v);
                            }
                        }
                        unset($qids_arr);
                        unset($db_qids);
                        unset($diff_qids);
                        
                        shuffle($questions);

						if($_GET['dotest'] == 3){
							print_r($questions);die;
						}

                        //ƴ���ַ���                  
                        $str = "[,";
                        $dot = '';
                        foreach($questions as $v){
                            $str .=$dot. "[\"$v[qid]\", \"$v[qtype]\", \"$v[title]<br/>$v[answers]\", \"$v[imgurl]\", \"$v[right_answer]\", \"$v[qid]\", \"$v[analysis]\", \"$v[videourl]\"]";
                            $dot = ',';
                        }
                        $str .="]";
                    }

					if($_GET['dotest'] == 4){
						print_r($str);die;
					}

                    $data['type'] = $_GET['type'];
                    $data['catid'] = $catid;
                    $data['catname'] = $catname;
                    $data['mode'] = "����";
                    $data['basename'] = $basename;
                    $data['base'] = $base;
                    $data['count'] = count($questions);
                    $data['catname'] = $catid ? $kaoshi_cat_array[$catid] : '�ۺϲ���';
                    $data['str'] = $str;
                    $data['navtitle'] = '�����˶�֪ʶѧϰ�Ϳ���ϵͳ';

                    $data['isWechat'] = $this->isWechat;
                    $data['signPackage'] = $this->_get_share_params();
                    $data['wxshareImg'] = $this->wx_share_img;
                    $this->assign($data);
                    $this->display('exam/topic/index');
                }elseif($_GET['type'] == 'practice'){
                    if($catid == '0'){
                        $this->showmessage('�Ƿ�cat!');
                    }

                    shuffle($qids_arr);

                    $str = "[0,";
                    $dot = '';
                    foreach($qids_arr as $v){
                        $str .=$dot. "\"$v\"";
                        $dot = ',';
                    }
                    $str .= "]";

                    $qids_count = count($qids_arr);
                    unset($qids_arr);

//                    $REs_arr = $myredis->HGETALL("exam_practice_".$userinfo['uid']."_".$catid."_REs");
//
//                    foreach($REs_arr as $k=>$v){
//                        $new_REs[] = array($k, $v);
//                    }



                    $new_REs = array();

                    $data['type'] = $_GET['type'];
                    $data['catid'] = $catid;
                    $data['catname'] = $catname;
                    $data['mode'] = "ѧϰ";
                    $data['basename'] = "";
                    $data['catname'] = $kaoshi_cat_array[$catid];
                    $data['count'] = $qids_count;
                    $data['str'] = $str;
                    $data['REs'] = json_encode($new_REs);
                    $data['navtitle'] = '�����˶�֪ʶѧϰ�Ϳ���ϵͳ';
                    $data['signPackage'] = $this->_get_share_params();
                    $data['wxshareImg'] = $this->wx_share_img;
                    $data['isWechat'] = $this->isWechat;
                    $this->assign($data);
                    $this->display('exam/topic/index');
                }
	}
        
        function yulan(){
            global $_G;
            
            if($_G['uid']){
                //ȡ����
                if($_GET['qid']){
                    $question = DB::fetch_first("SELECT qid,catid,qtype,title,answers,right_answer,analysis,imgurl,videourl FROM " . DB::table('exam_questions') . " WHERE qid=".$_GET[qid].getSlaveID());
                    if(!empty($question)){
                        $answers = $question['answers'];
                        $an_arr = explode('<br/>', $answers);
                        
                        $data['question'] = $question;
                        $data['an_arr'] = $an_arr;
                        $this->assign($data);
                        $this->display('exam/topic/yulan');
                    }else{
                        $this->showmessage('����¼��ʧ�ܣ����ݿ��в�����!');
                    }
                }else{
                    $this->showmessage('û�л�ȡ��qid!');
                }
            }else{
                $this->showmessage('û�е�¼!');
            }
        }
        
        //�û��㡰�����Ժ�ajax�ύ���Է���
        function postpoint(){
            global $_G;

            $data = array();

            $data['catid'] = max(0, intval($_POST['catid']));
            $data['base'] = max(0, intval($_POST['base']));
            $data['scores'] = max(0, intval($_POST['points']));
            $data['begintime'] = $_POST['begintime'];
            $data['endtime'] = $_POST['endtime'];



            if(!$_G['uid']) {
                echo "-1";die;
            }

            $data['uid'] = $_G['uid'];

            
            if($_G['uid']){
                DB::insert('exam_record', $data);
                echo DB::insert_id();die();
            }else{
                echo "0";die();
            }
        }

        //��ϰģʽ��ȡ���Ⲣ��¼��ϰ���ĵ���
        function getquestion(){
            global $_G;
            
            require_once libfile('class/myredis');
            $myredis = & myredis::instance();
            

            //ȡ����
            if($_POST['qid']){
                $question = DB::fetch_first("SELECT qid,catid,qtype,title,answers,right_answer,analysis,imgurl,videourl FROM " . DB::table('exam_questions') . " WHERE qid=".$_POST[qid].getSlaveID());
                if(!empty($question)){
                    $question['flag'] = 1;
                    echo json_encode(iconv_array($question));
                    die();
                }else{
                    $myredis->sRem('exam_all_ids', $_POST['qid']);
                    echo json_encode(array('flag' =>2));
                    die();
                }
            }

            /*$kaoshi_cat_array = array();
            $kaoshi_cat_array = memory('get', 'exam_kaoshi_cat_array');
            if(!$kaoshi_cat_array || $_G['group'] == 1){
                $query = DB::query("SELECT id,catname FROM ". DB::table('exam_category')." WHERE is_show = 1 " .getSlaveID());
                while($raw = DB::fetch($query)){
                    $kaoshi_cat_array[$raw['id']] = $raw['catname'];
                }

                memory('set', 'exam_kaoshi_cat_array', $kaoshi_cat_array, 300);
            }

            $catid = max(0, intval($_POST['catid']));
            if( in_array($catid, array_keys($kaoshi_cat_array) ) ){
                $myredis->sInterStore("exam_catid_".$catid, "exam_catid_".$catid, "exam_all_ids");
                $question_id = $myredis->sRANDMEMBER("exam_catid_".$catid);

                $question = DB::fetch_first("SELECT qid,catid,qtype,title,answers,right_answer,analysis,imgurl,videourl FROM " . DB::table('exam_questions') . " WHERE qid=".$question_id.getSlaveID());
                if(!empty($question)){
                    $question['flag'] = 1;
                    echo json_encode(iconv_array($question));
                    die();
                }else{
                    $myredis->sRem('exam_all_ids', $_POST['qid']);
                    echo json_encode(array('flag' =>2));
                    die();
                }
            }else{
                echo json_encode(array('flag' => 0));
                die();
            }*/


        }

        //��¼�û���ϰ����
        function practice_record(){
            global $_G;
            
            require_once libfile('class/myredis');
            $myredis = & myredis::instance();
            
            $uid = $this->checkLogin();
            if(!$uid) {
                dheader("Location: ./login.html");
            }
            
            if($uid){
                //exam_practice_uid_catid �û��𰸼�¼��hash�ṹ
                //����ѧУ�°棬ֻ��¼��ϰλ��
                //$myredis->HSET("exam_practice_".$_G['uid']."_".$_POST['catid']."_result", $_POST['qid'], $_POST['ExamDaSel']);
                
                //exam_practice_uid_catid_record ��¼�û���ϰλ��
                $myredis->SET("exam_practice_".$uid."_".$_POST['catid']."_record", $_POST['order']);
                
                //��¼�����Ƿ���ϰ��
                $myredis->HSET("exam_practice_".$uid."_".$_POST['catid']."_REs", 1, "Y");
                $myredis->HSET("exam_practice_".$uid."_".$_POST['catid']."_REs", $_POST['qid'], "Y");
            }
        }
        
        //��ѯ�û���ϰ����
        function get_practice_record(){
            global $_G;
            
            require_once libfile('class/myredis');
            $myredis = & myredis::instance();

            $uid = $this->checkLogin();
            if(!$uid) {
                dheader("Location: ./login.html");
            }
            
            if($uid['uid']){
                $record_id = $myredis->GET("exam_practice_".$uid."_".$_POST['catid']."_record");
                echo $record_id;die();
            }
        }
        
        //����û���ϰ��¼
        function clear_practice_record(){
            
            global $_G;
            
            require_once libfile('class/myredis');
            $myredis = & myredis::instance();

            $uid = $this->checkLogin();
            if(!$uid) {
                dheader("Location: ./login.html");
            }
            
            if($uid && $_POST['catid']){
                if($myredis->DEL("exam_practice_".$uid."_".$_POST['catid']."_record") && $myredis->hashdelall("exam_practice_".$uid."_".$_POST['catid']."_result") && $myredis->hashdelall("exam_practice_".$uid."_".$_POST['catid']."_REs")){
                    echo "1";die();
                }else{
                    echo "0";die();
                }
                
            }
        }
        
        function ajaxMobilesend(){
            global $_G;
            
            //ͬipһ�����������һ��
            $last_minute = time() - 60;
            $phone = trim($_POST['phone']);
            
            $msg_id = DB::result_first("SELECT id FROM ".DB::table('exam_validate')." WHERE mobile='{$phone}' and send_time > '{$last_minute}' ");

            if ($msg_id) {
                //̫Ƶ��
                echo json_encode(array('return_state' => -1));
                exit;
            }

            $code = $this->get_code();
            $signature = iconv("gbk", "utf-8", "��8264����ѧУ��");
            $message ="��֤�룺{$code}��������ע��8264����ѧУ��60��������Ч��";
            $content = iconv("gbk", "utf-8", $message);
            
            $res = file_get_contents("http://m.hd.8264.com/wap.php?app=api&act=send_msg&tel={$phone}&content={$content}&signature={$signature}");
            
            $result = (array)json_decode($res);
            if($result['ret'] == 1){
                    $data = array();
                    $data['mobile'] = $phone;
                    $data['message'] = $message;
                    $data['code'] = $code;
                    $data['ip'] = $_G['clientip'];
                    $data['send_time'] = time();
                    $data['expires_time'] = time() + 86400;

                    DB::insert('exam_validate', $data);
                    
                    echo json_encode(array('return_state' => 1));
                    exit;
            }else{
                    //���ŷ���ʧ��
                    echo json_encode(array('return_state' => -2));
                    exit;
            }
            
        }
        
        /**
        * ��ȡ��֤��
        */
       function get_code($len = 4) {
           $chars = '0123456789';
           for ($i = 0, $count = strlen($chars); $i < $count; $i++) {
               $arr[$i] = $chars[$i];
           }

           mt_srand((double) microtime() * 1000000);
           shuffle($arr);
           $code = substr(implode('', $arr), 5, $len);
           return $code;
       }
       
       function ajaxcheckcode(){
            $phone = trim($_POST['phone']);
            $code = trim($_POST['code']);
            
            if(!$code || !$phone){
                echo "-3";
                exit;
            }
            
            $res = DB::fetch_first("SELECT code,expires_time FROM ".DB::table('exam_validate')." WHERE mobile='{$phone}' order by id desc limit 1 ");
            
            if($code && $code == $res['code'] && $res['expires_time'] > time() ){
                $vcode = md5($phone."8264ajax");
                echo json_encode(array('return_state' => 1, 'vcode' => $vcode));
                exit;
            }else{
                if($code != $res['code']){
                    echo json_encode(array('return_state' => -1));
                    exit;
                }else{
                    //��֤�����
                    echo json_encode(array('return_state' => -2));
                    exit;
                }

            }
       }
       
    function up_info(){
        $phone = trim($_POST['phone']);
        $vcode = trim($_POST['vcode']);

        if($vcode != md5($phone."8264ajax") ){
            echo json_encode(array('flag' => -1));
            exit;
        }else{
            $uid = $this->get_uid();
            if($uid){
                $data = array(
                    'mobile' => $phone
                );

		        DB::update('common_member_connect_wechat', $data, "uid='{$uid}'");

                echo json_encode(array('flag' => 1));
            }else{
                echo json_encode(array('flag' => -2));
            }
        }
    }
    
    
    function checkLogin(){
        global $_G;
        if($this->isWechat == 0){
            if(!$_G['uid']){
                $this->pc_login();
            }
        }else{
            $this->is_wechat();

            if(!$_G['uid']){
                $this->xuexiao_wechat_info();
            }
        }
        return $_G['uid'];
    }

    function ajaxcheckLogin(){
        $b = max(0, intval($_POST['b']));
        dsetcookie("exam_b", $b, 300);

        $userinfo = $this->checkLogin();
        if(!$userinfo) {
            echo "0";die;
        }else{
            echo "1";die;
        }
    }
    
    function getimage(){
            global $_G;
            
            $catid = (int)$_POST['catid'];
            $base = (int)$_POST['base'];
            
            $kaoshi_cat_array = array();
            $kaoshi_cat_array = memory('get', 'exam_kaoshi_cat_array');
            if(!$kaoshi_cat_array || $_G['group'] == 1){
                $query = DB::query("SELECT id,catname FROM ". DB::table('exam_category')." WHERE is_show = 1 " .getSlaveID());
                while($raw = DB::fetch($query)){
                    $kaoshi_cat_array[$raw['id']] = $raw['catname'];
                }

                memory('set', 'exam_kaoshi_cat_array', $kaoshi_cat_array, 300);
            }
            
            if(!in_array($catid, array_keys($kaoshi_cat_array)) || !in_array($base, array("1", "2", "3")) ){
                    //�Ƿ�����
                    echo json_encode(array('flag' => -1));
                    exit;
            }
            
            $base_arr = array(
                '1' => "����",
                '2' => "�м�",
                '3' => "�߼�"
            );
            
            $userinfo = $this->checkLogin();
            if(!$userinfo) {
                dheader("Location: ./login.html");
            }
            
            $catname = $kaoshi_cat_array[$catid];
            
            $basename = $base_arr[$base];
            
            $title = iconv("gbk", "utf-8", $catname.$basename."֤��");
            if($this->isWechat){
                $name = iconv("gbk", "utf-8", base64_decode(getcookie('wechat_user_nickname')));
            }else{
                $name = iconv("gbk", "utf-8", $_G['username']);
            }

            $cat = iconv("gbk", "utf-8", $catname);
            $st = iconv("gbk", "utf-8", $basename);

            $font_bold = DISCUZ_ROOT."/static/font/pingfangbold.ttf";
            $font_heavy = DISCUZ_ROOT."/static/font/pingfangheavy.ttf";

            $cat_length = mb_strlen($cat, "utf8");

            switch($cat_length){
                    case 2:
                            $img = DISCUZ_ROOT."/static/images/exam/watermark/2.jpg";
                            $cat_x = 72;
                            $st_x = 350;
                            break;
                    case 3:
                            $img = DISCUZ_ROOT."/static/images/exam/watermark/3.jpg";
                            $cat_x = 72;
                            $st_x = 398;
                            break;
                    case 4:
                            $img = DISCUZ_ROOT."/static/images/exam/watermark/4.jpg";
                            $cat_x = 72;
                            $st_x = 445;
                            break;
                    default:
                            $img = DISCUZ_ROOT."/static/images/exam/watermark/4.jpg";
            }

            $image_width = 750;

            $source = imagecreatefromstring(file_get_contents($img));



            //����
            $title_fontsize = 48;

            $title_box = imagettfbbox($title_fontsize, 0, $font_heavy, $title);
            $title_width = abs($title_box[4]) + abs($title_box[6]);
            $title_x = ceil( ($image_width - $title_width) / 2);
            $title_color = imagecolorallocate($source, 40, 40, 40);

            imagettftext($source, $title_fontsize, 0, $title_x, 260, $title_color, $font_heavy, $title);

            //����
            $name_fontsize = 38;

            $name_box = imagettfbbox($name_fontsize, 0, $font_bold, $name);
            $name_width = abs($name_box[4]) + abs($name_box[6]);
            $name_x = ceil( ($image_width - $name_width) / 2);
            $name_color = imagecolorallocate($source, 61, 61, 61);

            imagettftext($source, $name_fontsize, 0, $name_x, 510, $name_color, $font_bold, $name);

            //���
            $cat_fontsize = 34;

            $cat_color = imagecolorallocate($source, 170, 130, 64);

            imagettftext($source, $cat_fontsize, 0, $cat_x, 695, $cat_color, $font_bold, $cat);

            //�ȼ�
            $st_fontsize = 34;

            $st_color = imagecolorallocate($source, 170, 130, 64);

            imagettftext($source, $st_fontsize, 0, $st_x, 695, $st_color, $font_bold, $st);
            
            $dir = DISCUZ_ROOT."/examimg/".date("Ymd");
            if(!is_dir($dir)) {
		@mkdir($dir, 0777, true);
            }
        

            header("Content-type:image/jpeg");

            $time = time();
            
            imagejpeg($source,$dir."/".$userinfo.$time.'.jpg');
            
            imagedestroy($source);
            
            $exam_auth = md5($userinfo);

            require_once libfile('class/myredis');
            $myredis = & myredis::instance();
            
            $url = "http://www.8264.com/examimg/".date("Ymd")."/".$userinfo.$time.".jpg";

            $myredis->HSET("exam_auth_".$exam_auth, "url", $url );
            
            echo json_encode(array('flag' => 1 ));
            exit;
            
    }
    
    public function jiangzhuang(){
        $userinfo = $this->checkLogin();
        if(!$userinfo) {
            dheader("Location: ./login.html");

        }
        require_once libfile('class/myredis');
        $myredis = & myredis::instance();

        $exam_auth = md5($userinfo);

        $data['url'] = $myredis->HGET("exam_auth_".$exam_auth, "url");
            
        $catid = substr($_SERVER["HTTP_REFERER"], strpos($_SERVER["HTTP_REFERER"], ".html")-1,1);
        $data['ref'] = "http://www.8264.com/xuexiao/catinfo-".$catid.".html";

        if(!$data['ref']){
            $data['ref'] = "http://www.8264.com/xuexiao/";
        }

        $data['isWechat'] = $this->isWechat;

        $this->assign($data);
        $this->display('exam/topic/jiangzhuang');
    }
    
    public function tmpdelete(){
        $exam_auth = getcookie('exam_auth');
        if($exam_auth){
            require_once libfile('class/myredis');
            $myredis = & myredis::instance();
            $res = $myredis->DEL("exam_auth_".$exam_auth);
            dsetcookie("wechat_user_unionid", "");
            dsetcookie("wechat_user_nickname", "");
            dsetcookie("wechat_user_openid", "");
            dsetcookie("exam_auth", "");
            echo $res;die();
        }
    }

    function _get_share_params() {
        require_once DISCUZ_ROOT."/source/plugin/wechat_share/jssdk.php";
        $dir = DISCUZ_ROOT."/source/plugin/wechat_share/";
        $jssdk = new JSSDK("wxed48effe86e38ed2", "f220ee7d1a9b25ccdb13bca07678b182", $dir, $dir);
        $signPackage = $jssdk->getSignPackage();

        return $signPackage;
    }

    public function do_useful(){

        $qid = max(0, intval($_POST['qid']));
        $flag = max(0, intval($_POST['flag']));

        if($qid){
            if( !getcookie("qid_do_useful_".$qid) ){

                if($flag){
                    DB::query("update ".DB::table('exam_questions')." set useful = useful + 1 where qid = ".$qid);
                }else{
                    DB::query("update ".DB::table('exam_questions')." set useless = useless + 1 where qid = ".$qid);
                }

                dsetcookie("qid_do_useful_".$qid, 1, 300);

                echo "1";
                exit;
            }else{
                echo "-1";
                exit;
            }
        }
    }
        
    public function seo_xuexiao(){
        global $_G;
        $qid = intval($_GET['qid']);
        require_once libfile('class/myredis');
        $myredis = & myredis::instance();
        $cache_key = 'exam_seo_id_' . $qid;
        $data = $myredis->GET($cache_key);
        if($data){
            $data = unserialize($data);
        }else{
            $question = DB::fetch_first("SELECT qid,catid,qtype,title,answers,right_answer,analysis,imgurl,videourl FROM " . DB::table('exam_questions') . " WHERE qid=".$qid.getSlaveID());
            if($question){
                $question['answer_arr'] = explode('<br/>', $question['answers']);
                //��һҳ ��һҳ
                $pre = DB::fetch_first("SELECT qid FROM " . DB::table('exam_questions') . " WHERE qid <".$qid." and catid=".$question['catid']. ' order by qid asc'. getSlaveID());
                $next = DB::fetch_first("SELECT qid FROM " . DB::table('exam_questions') . " WHERE qid >".$qid." and catid=".$question['catid']. ' order by qid asc'. getSlaveID());
                if($pre){
                    $question['pre_url'] = $_G['config']['web']['portal'] . 'xuexiao/' . $pre['qid'] . '.html';
                    $question['pre_title'] = $pre['title'];
                }else{
                    $question['pre_url'] = $_G['config']['web']['portal'] . 'xuexiao/';
                    $question['pre_title'] = '8264�����˶�ѧУ';
                }
                if($next){
                    $question['next_url'] = $_G['config']['web']['portal'] . 'xuexiao/' . $next['qid'] . '.html';
                    $question['next_title'] = $next['title'];
                }else{
                    $question['next_url'] = $_G['config']['web']['portal'] . 'xuexiao/';
                    $question['next_title'] = '8264�����˶�ѧУ';
                }
                $cate_id = $question['catid'];
                $key = 'exam_catid_' . $cate_id;
                $cache_ids = $myredis->sMembers($key);
                $rand = array_rand($cache_ids, 4);
                $rand_id = array();
                foreach($rand as $val){
                    $rand_id[] = $cache_ids[$val];
                }
                $rand_id = implode(',',$rand_id);
                $query = DB::query("SELECT qid,catid,qtype,title,answers,right_answer,analysis,imgurl,videourl FROM " . DB::table('exam_questions') . " WHERE qid in ($rand_id)".getSlaveID());
                $other_question = array();
                while($other = DB::fetch($query)){
                    $other['answer_arr'] = explode('<br/>', $other['answers']);
                    $other_question[] = $other;
                }
                $data = array(
                    'main' => $question,
                    'other' => $other_question
                );
                $myredis->set($cache_key, serialize($data));
            }else{
                header('HTTP/1.1 404 Not Found');
            }
        }
        $kaoshi_cat_array = memory('get', 'exam_kaoshi_cat_array');
        if(!$kaoshi_cat_array || $_G['group'] == 1){
            $query = DB::query("SELECT id,catname FROM ". DB::table('exam_category')." WHERE is_show = 1 " .getSlaveID());
            while($raw = DB::fetch($query)){
                $kaoshi_cat_array[$raw['id']] = $raw['catname'];
            }

            memory('set', 'exam_kaoshi_cat_array', $kaoshi_cat_array, 300);
        }
        $data['cate'] = $kaoshi_cat_array[$data['main']['catid']];
        $data['navtitle'] = $data['main']['title'].' - ����ѧУ';
        $this->assign($data);
        $this->display('exam/topic/seo_xuexiao');
    }

    function correction(){
        global $_G;
        if(!$_G['uid']){
            $this->pc_login();
        }
        if($_POST['qid'] && $_POST['error_content']){
            $data = DB::fetch_first("SELECT qid,title FROM " . DB::table('exam_questions') . " WHERE qid=".$_POST['qid'].getSlaveID());
            if($data){
                $arr = array(
                    'qid' => $_POST['qid'],
                    'question' => $data['title'],
                    'uid' => $_G['uid'],
                    'username' => $_G['username'],
                    'error_content' => dhtmlspecialchars(iconv("utf-8", "gbk", $_POST['error_content'])),
                    'create_time' => time()
                );
                $res = DB::insert('exam_correction', $arr);
                if($res){
                    echo json_encode(array('code'=>0));die;
                }else{
                    echo json_encode(array('code'=>2));die;
                }
            }else{
                echo json_encode(array('code'=>1));die;
            }
        }else{
            $qid = intval($_GET['qid']);
            if(!empty($qid) && $qid > 0 ){
                $data = DB::fetch_first("SELECT qid,title FROM " . DB::table('exam_questions') . " WHERE qid=".$qid.getSlaveID());
                if($data){
                    $this->assign($data);
                    $this->display('exam/topic/correction');
                }else{
                    $this->showmessage('���ⲻ����!');
                }
            }else{
                $this->showmessage('�Ƿ�����!');
            }
        }

    }

    function video(){
        $video = array();
        $query = DB::query("SELECT * FROM " . DB::table('exam_video') . " WHERE is_show = 1 order by createtime desc " . getSlaveID());
        while ($row = DB::fetch($query)) {
            $video['data'][] = $row;
        }
        $video['signPackage'] = $this->_get_share_params();
        $video['wxshareImg'] = $this->wx_share_img;
        $this->assign($video);
        $this->display('exam/topic/video');
    }

    function video_detail(){

        $id = intval($_GET['id']);
        $data = DB::fetch_first("SELECT * FROM " . DB::table('exam_video') . " WHERE id=".$id.getSlaveID());

        if($data){
            if($this->isWechat){
                $user = $this->get_user_info();
                if($user['vip_end'] > 0){
                    $data['is_vip'] = 1;
                    DB::update('exam_video', array('vip_view' => $data['vip_view'] + 1), "id='{$id}'");
                }else{
                    $data['is_vip'] = 0;
                }
                if($data['is_free'] == 2 && $data['is_vip'] == 0){
                    if($user['mobile']){
                        //���ֻ���ֱ����������Ƶ
                        $is_pay_video = DB::fetch_first("SELECT * FROM " . DB::table('exam_pay_record') . " WHERE uid=".$user['uid']." and type=2 and pay_id=".$id.getSlaveID());
                        if(!$is_pay_video){
                            header('Location: http://www.8264.com/xuexiao/wechat_pay/pay.html?attach=2');
                        }
                    }else{
                        //û���ֻ�����ʾ���ֻ��� ��������ת����Ƶ
                        header('Location: http://www.8264.com/exam.php?ctl=topic&act=check_mobile');
                    }
                }
            }else{
                if($_GET['sign'] == '15ce2f3d25cc2c806353aadadbb84570'){
                    global $_G;
                    if($data['is_free'] == 2){
                        if(!$_G['uid']){
                            $this->pc_login();
                        }
                        $is_pay_video = DB::fetch_first("SELECT * FROM " . DB::table('exam_pay_record') . " WHERE uid=".$_G['uid']." and type=2 and pay_id=".$id.getSlaveID());
                        if(!$is_pay_video){
                            header('Location: http://www.8264.com/exam.php?ctl=topic&act=qrcode_pay&attach=2&sign=15ce2f3d25cc2c806353aadadbb84570');
                        }

                    }
                }else{
                    if($data['is_free'] == 2){
                        $this->is_wechat();
                    }
                }

            }

            $data['signPackage'] = $this->_get_share_params();
            $data['wxshareImg'] = $this->wx_share_img;
            $this->assign($data);
            $this->display('exam/topic/video_detail');
        }else{
            $this->showmessage('��Ƶ������!');
        }
    }

    function video_view(){
        $id = intval($_POST['id']);
        $data = DB::fetch_first("SELECT * FROM " . DB::table('exam_video') . " WHERE id=".$id.getSlaveID());

        if($data){
            DB::update('exam_video', array('view' => $data['view'] + 1), "id='{$id}'");
        }
    }

    function institutions(){
        $video = array();
        $query = DB::query("SELECT * FROM " . DB::table('exam_institutions') . " WHERE is_show = 1 order by sort desc " . getSlaveID());
        while ($row = DB::fetch($query)) {
            $video['data'][] = $row;
        }
        $video['signPackage'] = $this->_get_share_params();
        $video['wxshareImg'] = $this->wx_share_img;
        $this->assign($video);
        $this->display('exam/topic/institutions');
    }

    function peixun(){
        $now = time();
        $peixun_query = DB::query("SELECT * FROM ".DB::table('exam_peixun')." where is_show = 1 ORDER BY datetime DESC");
        while($value = DB::fetch($peixun_query)){
            list($value['m'], $value['d']) = explode("-", $value['date']);
            if($value['datetime'] > $now){
                $peixun_result['new'][] = $value;
            }else{
                $peixun_result['old'][] = $value;
            }
        }
        $peixun_result['signPackage'] = $this->_get_share_params();
        $peixun_result['wxshareImg'] = $this->wx_share_img;
        $this->assign($peixun_result);
        $this->display('exam/topic/peixun');
    }

    function shizi_detail(){
        $id = intval($_GET['id']);
        $data = DB::fetch_first("SELECT * FROM " . DB::table('exam_shizi') . " WHERE id=".$id.getSlaveID());

        if($data){
            $data['signPackage'] = $this->_get_share_params();
            $data['wxshareImg'] = $this->wx_share_img;
            $this->assign($data);
            $this->display('exam/topic/shizi_detail');
        }else{
            $this->showmessage('ʦ�ʲ�����!');
        }
    }

    function institutions_detail(){
        $id = intval($_GET['id']);
        $data = DB::fetch_first("SELECT * FROM " . DB::table('exam_institutions') . " WHERE id=".$id.getSlaveID());

        if($data){
            $data['signPackage'] = $this->_get_share_params();
            $data['wxshareImg'] = $this->wx_share_img;
            $inst_other = DB::query("SELECT * FROM ".DB::table('exam_institutions_other')." where inst_id = ".$id." ORDER BY id ASC");
            while($value = DB::fetch($inst_other)){
                if($value['type'] == 1){
                    $data['banner'][] = $value;
                }else{
                    $data['activity'][] = $value;
                }
            }
            $data['activity'] = array_reverse($data['activity']);
            $shizi = DB::query("SELECT * FROM ".DB::table('exam_shizi')." where inst_id = ".$id." and is_show = 1 ORDER BY id desc");
            while($row = DB::fetch($shizi)) {
                if($row){
                    $data['shizi'][] = $row;
                }
            }
            $this->assign($data);
            $this->display('exam/topic/inst_detail');
        }else{
            $this->showmessage('ʦ�ʲ�����!');
        }
    }

    private function xuexiao_wechat_info(){
        $wechat_user_unionid = getcookie("wechat_user_unionid");
        $wechat_user_nickname = getcookie('wechat_user_nickname');
        $wechat_user_openid = getcookie('wechat_user_openid');

        if($wechat_user_unionid && $wechat_user_nickname && $wechat_user_openid){
            include DISCUZ_ROOT .'/source/module/wechatconnect/models/wechat_user.class.php';
            $wechat_user = new Wechat_User();
            $wechat_user_info = $wechat_user->get_wechat_user('unionid', $wechat_user_unionid);
            if($wechat_user_info){
                global $_G;
                $_G['clientip'] = $_SERVER['REMOTE_ADDR'];
                $uid = $wechat_user_info['uid'];
                if(!$wechat_user_info['nickname']){
                    DB::update('common_member_connect_wechat', array('nickname' => $wechat_user_nickname), "uid='{$wechat_user_info['uid']}'");
                }
                if($wechat_user_info['vip_end'] < time()){
                    DB::update('common_member_connect_wechat', array('vip_begin' => 0, 'vip_end' => 0), "uid='{$wechat_user_info['uid']}'");
                }
                $wechat_user->connect_login($wechat_user_info['uid']);

            }else{
                $username = $wechat_user_nickname;
                $reg_name = 'wx8264'.random(8);
                //ע��һ��
                $password = md5(random(10));
                $email = '';
                $wechat_user = new Wechat_User($wechat_user_unionid, $reg_name, $password, $email);
                $uid = $wechat_user->add_wechat_user($username, 'exam',$wechat_user_unionid);
                if($uid == -3){
                    $reg_name = 'wx8264'.random(8);
                    $username = base64_encode(base64_decode($wechat_user_nickname).random(4));
                    $wechat_user = new Wechat_User($wechat_user_unionid, $reg_name, $password, $email);
                    $uid = $wechat_user->add_wechat_user($username, 'exam', $wechat_user_unionid);
                }
                $wechat_user->connect_login($uid);

            }
            $exam_auth = md5($uid);
            dsetcookie("exam_auth", $exam_auth, 3600);
            require_once libfile('class/myredis');
            $myredis = & myredis::instance();
            $myredis->HSET("exam_auth_".$exam_auth, "uid", $uid);
            return $uid;
        }else{
            $this->authorization();
        }

    }

    function is_wechat(){
        if(!$this->isWechat){
            $this->display('exam/topic/qr_code');
            exit;
        }
    }

    function user_info(){

        $data = $this->get_user_info();
        $data['nickname'] = base64_decode($data['nickname']);
        $data['signPackage'] = $this->_get_share_params();
        $this->assign($data);
        $this->display('exam/topic/user');
    }


    private function get_user_info(){
        $this->is_wechat();
        $uid = $this->get_uid();

        $data = DB::fetch_first("select * from ".DB::table('common_member_connect_wechat')." where uid = ".$uid.  getSlaveID());
        $nickname = getcookie('wechat_user_nickname');
        if(!$data['nickname']){
            DB::update('common_member_connect_wechat', array('nickname' => $nickname), "uid='{$uid}'");
        }
        $data['headimg'] = getcookie('wechat_user_headimgurl');
        $data['nickname'] = $nickname;
        if($data['vip_end'] < time()){
            $data['vip_status'] = 0;  //����
            $data['vip_zh'] = '��δ��ͨ';  //����
        }else{
            $data['vip_status'] = 1;
            $data['vip_zh'] = date('Y-m-d', $data['vip_end']).'����';
        }
        $data['total_fee'] = $this->total_fee[1];
        $data['total_fee_show'] = $this->total_fee[1]/100;
        if($data['uid']){
            $res = DB::fetch_first("SELECT uid FROM " . DB::table('exam_equipment_order') . " WHERE uid=".$data['uid'].getSlaveID());
            if($res){
                $data['equipment_order'] = 1;
            }else{
                $data['equipment_order'] = 0;
            }
        }else{
            $data['equipment_order'] = 0;
        }

        return $data;
    }

    public function wechat_pay(){
        $this->is_wechat();
        $uid = $this->get_uid();
        if(!$uid){
            $this->showmessage('�˺��쳣,����ϵ����Ա');
        }
        $attach = (int)$_GET['attach'];
        if(!in_array($attach,array_keys($this->pay_content))){
            $this->showmessage('��������!');
        }
        if($attach == 1){
            $exam_http_referer = 'http://www.8264.com/exam.php?ctl=topic&act=pay_success';
            $attach_ext = $attach.'-'.$uid;
        }else{
            $exam_http_referer = getcookie('exam_http_referer');
            if(!preg_match('/video-(\d+)/',$exam_http_referer,$info)){
                $this->showmessage('��Դ��������ϵ����Ա');
            }
            $video_id = $info[1];
            $video = DB::fetch_first("SELECT name FROM " . DB::table('exam_video') . " WHERE id=".$video_id.getSlaveID());
            if(!$video){
                $this->showmessage('��Ƶ�����ڣ�����ϵ����Ա');
            }
            $video_title = $video['name'];
            $attach_ext = $attach.'-'.$uid.'-'.$video_id;
        }
        $data = $this->base_wechat_pay($this->pay_content[$attach], $attach_ext);
        $data['total_fee'] = $this->total_fee[$attach]/100;
        $data['attach'] = $attach;
        $data['exam_http_referer'] = $exam_http_referer;
        $data['video_title'] = $video_title;
        $this->assign($data);
        $this->display('exam/topic/wechat_pay');
    }

    public function qrcode_pay(){
        if($_GET['sign'] != '15ce2f3d25cc2c806353aadadbb84570') {
            exit;
        }
        global $_G;
        if(!$_G['uid']){
            $this->pc_login();
        }
        $uid = $_G['uid'];
        require_once DISCUZ_ROOT ."/source/module/wxpay/lib/WxPay.Api.php";
        require_once DISCUZ_ROOT ."/source/module/wxpay/example/WxPay.NativePay.php";
        $attach = (int)$_GET['attach'];
        if(!in_array($attach,array_keys($this->pay_content))){
            $this->showmessage('��������!');
        }
        if($attach == 1){
            $exam_http_referer = 'http://www.8264.com/exam.php?ctl=topic&act=pay_success';
            $attach_ext = $attach.'-'.$uid;
            $product_id = 1;
        }else{
            $exam_http_referer = getcookie('exam_http_referer');
            if(!preg_match('/video-(\d+)/',$exam_http_referer,$info)){
                $this->showmessage('��Դ��������ϵ����Ա');
            }
            $video_id = $info[1];
            $video = DB::fetch_first("SELECT name FROM " . DB::table('exam_video') . " WHERE id=".$video_id.getSlaveID());
            if(!$video){
                $this->showmessage('��Ƶ�����ڣ�����ϵ����Ա');
            }
            $video_title = $video['name'];
            $attach_ext = $attach.'-'.$uid.'-'.$video_id;
            $product_id = $video_id;
        }
        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        $input->SetBody(diconv($this->pay_content[$attach], "gbk","utf-8"));
        $input->SetAttach($attach_ext);
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($this->total_fee[$attach]);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetNotify_url("http://www.8264.com/xuexiao/wechat_pay/notify.html");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($product_id);
        $result = $notify->GetPayUrl($input);
        if($result['return_code'] == 'FAIL'){
            $logs_msg = "pc|{$uid}|".var_export(diconv($result['return_msg'],"utf-8","gbk"), true);
            require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
            $logs = new logs('pc_qr_code_pay');
            $logs->log_str($logs_msg);
            $this->showmessage('΢��֧��ͨ�Ŵ���!���Ժ�����');
        }
        $data['url2'] = urlencode($result["code_url"]);
        $data['video_title'] = $video_title;
        $data['total_fee'] = $this->total_fee[$attach]/100;
        $data['attach'] = $attach;
        $data['exam_http_referer'] = $exam_http_referer;
        $data['video_title'] = $video_title;
        $data['product_id'] = $product_id;
        $this->assign($data);
        $this->display('exam/topic/qr_code_wechat_pay');

    }

    /**
     * @param $body //����ѧУ-vip��Ա
     * @param $attach //1-��Ա�� 2-��Ƶ
     * @return array
     * @throws WxPayException
     */
    private function base_wechat_pay($body,$attach){

        $this->is_wechat();
        $tmp = explode('-',$attach);
        require_once DISCUZ_ROOT ."/source/module/wxpay/lib/WxPay.Api.php";
        require_once DISCUZ_ROOT ."/source/module/wxpay/example/WxPay.JsApiPay.php";

        $openId = getcookie('wechat_user_openid');
        $input = new WxPayUnifiedOrder();
        $input->SetBody(diconv($body,  "gbk","utf-8"));
        $input->SetAttach($attach);
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($this->total_fee[$tmp[0]]);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetNotify_url("http://www.8264.com/xuexiao/wechat_pay/notify.html");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        if($order['return_code'] !== 'SUCCESS'){
            $logs_msg = "wechat|{$tmp[1]}|".var_export(diconv($order['return_msg'],"utf-8","gbk"), true);
            require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
            $logs = new logs('wechat_gzzh_pay');
            $logs->log_str($logs_msg);
            //��ʼ����־
            $this->showmessage('΢��֧��ͨ�Ŵ���!���Ժ�����');

        }
        $tools = new JsApiPay();

        $jsApiParameters = $tools->GetJsApiParameters($order);
        $editAddress = $tools->GetEditAddressParameters();
        $data = array(
            'jsApiParameters' => $jsApiParameters,
            'editAddress' => $editAddress
        );
        return $data;
    }

    function notify()
    {
        require_once DISCUZ_ROOT .'/source/module/exam/notify.php';

        $notify = new PayNotifyCallBack();
        $notify->Handle(false);

        return $notify->GetValues();

    }

    private function authorization($snsapi = 'snsapi_base'){
        require_once DISCUZ_ROOT ."/source/module/wxpay/lib/WxPay.Config.php";
        $conf = array(
            'APPID' => WxPayConfig::APPID,
            'APPSECRET' => WxPayConfig::APPSECRET
        );
        $redirect_uri = urlencode("http://www.8264.com/exam.php?ctl=topic&act=get_wechat_info&code=" . date("Ymd"));
        header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid={$conf['APPID']}&redirect_uri={$redirect_uri}&response_type=code&scope={$snsapi}&state=1#wechat_redirect");
    }

    function get_wechat_info(){
        require_once DISCUZ_ROOT ."/source/module/wxpay/lib/WxPay.Config.php";
        $conf = array(
            'APPID' => WxPayConfig::APPID,
            'APPSECRET' => WxPayConfig::APPSECRET
        );
        $code = trim($_GET['code']);
        $tmp = ($this->getOpenAPI("https://api.weixin.qq.com/sns/oauth2/access_token?appid={$conf['APPID']}&secret={$conf['APPSECRET']}&code={$code}&grant_type=authorization_code&time=".time()));
        if($tmp['access_token'] && $tmp['openid']){
            $r = $this->getOpenAPI("https://api.weixin.qq.com/sns/userinfo?access_token={$tmp['access_token']}&openid={$tmp['openid']}&lang=zh_CN");
            if($r['openid'] && $r['nickname'] && $r['unionid']){
                dsetcookie("wechat_user_unionid", $r['unionid'], 3600);
                dsetcookie("wechat_user_openid", $r['openid'], 3600);
                dsetcookie("wechat_user_headimgurl", $r['headimgurl'], 3600);
                dsetcookie("wechat_user_nickname", base64_encode(diconv($r['nickname'], "utf-8", "gbk")), 3600);
                $exam_http_referer = getcookie('exam_http_referer');
                header("Location:".$exam_http_referer);
            }elseif($r['errcode'] == 48001){
                $this->authorization('snsapi_userinfo');
            }
            exit;
        }
    }

    //�������ݽӿ�
    private function getOpenAPI($url, $data = "") {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);   //url��ַ
        curl_setopt($ch, CURLOPT_POST, true);   //�Ƿ�post����
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);   //���ó�ʱ
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //post���󴫵ݵ�����
        curl_setopt($ch, CURLOPT_HEADER, 0);          //����header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //���ػ�ȡ������ı���
        $response = curl_exec($ch);      //��ȡ���ص�����
        curl_close($ch);

        //$response = "";
        if (empty($response)) {
            $response = file_get_contents($url);
        }
        $dataSet = json_decode($response, true);
        return $dataSet;
    }

//    function rights(){
//        $data = $this->get_user_info();
//        $data['total_fee'] = $this->total_fee[1];
//        $data['total_fee_show'] = $this->total_fee[1]/100;
//        $this->assign($data);
//        $this->display('exam/topic/rights');
//    }

    function is_vip(){
        $data = $this->get_user_info();
        if(!$data['mobile']){
            echo json_encode(array('res'=>1)); //����δ����
        }elseif($data['vip_end'] > 0){
            echo json_encode(array('res'=>2)); //�Ѿ���vip
        }else{
            echo json_encode(array('res'=>0)); //����
        }
    }

    function steward(){
        $type = $_GET['type'];
        if(!in_array($type,array(1,2,3,4))){
            $type = 1;
        }
        switch($type){
            case 2:
                $steward_zh = '�ҹܼ���ȡ���Ż��롿';
                break;
            case 3:
                $steward_zh = '�����ճ��к���25%';
                break;
            case 4 :
                $steward_zh = '�ҹܼ�����·�߼��γ��Ż��ۿ�';
                break;
            default:
                $steward_zh = '';
        }
        $this->assign('steward_zh', $steward_zh);
        $this->display('exam/topic/steward');
    }

    function equipment(){
        $data = $this->get_user_info();
        $this->assign($data);
        $type = trim($_GET['page']);
        if($type == 'form'){
            $this->display('exam/topic/equipment_form');
        }else{
            $this->display('exam/topic/equipment');
        }
    }

    function equipment_order(){
        $res = array('code' => 0);

        if($_POST['username'] && $_POST['phone'] && $_POST['address']){
            if(!preg_match('/^1[3|4|5|7|8][0-9]\d{8}$/',$_POST['phone'])){
                $res['code'] = 4;
                echo json_encode($res);exit;
            }
            $uid = $this->get_uid();
            $data = DB::fetch_first("SELECT uid FROM " . DB::table('exam_equipment_order') . " WHERE uid=".$uid.getSlaveID());
            if(!$data){
                $arr = array(
                    'uid' => $uid,
                    'username' => dhtmlspecialchars(iconv("utf-8", "gbk", $_POST['username'])),
                    'address' => dhtmlspecialchars(iconv("utf-8", "gbk", $_POST['address'])),
                    'phone' => $_POST['phone'],
                    'status' => 1,
                    'create_time' => time()
                );
                if(!DB::insert('exam_equipment_order', $arr)){
                    $res['code'] = 3;
                }
            }else{
                $res['code'] = 2;
            }
        }else{
            $res['code'] = 1;
        }
        echo json_encode($res);
    }

    function pay_success(){
        $this->get_user_info();
        $this->display('exam/topic/pay_success');
    }

    function check_mobile(){
        $this->get_user_info();
        $this->display('exam/topic/check_mobile');
    }

    function ajax_check_order(){
        global $_G;
        if(!$_G['uid']){
            echo json_encode(array('return_state' => 1));exit;
        }
        $attach = (int)$_POST['attach'];
        if(!in_array($attach,array_keys($this->pay_content))){
            echo json_encode(array('return_state' => 2));exit;
        }
        $product_id = (int) $_POST['product_id'];
        if(!$product_id){
            echo json_encode(array('return_state' => 3));exit;
        }
        if($product_id == 1) $product_id = 0;
        $is_pay = DB::fetch_first("SELECT * FROM " . DB::table('exam_pay_record') . " WHERE uid=".$_G['uid']." and type=".$attach." and pay_id=".$product_id.getSlaveID());

        if($is_pay){
            echo json_encode(array('return_state' => 0, 'pay' => 1));
            exit;
        }else{
            echo json_encode(array('return_state' => 0, 'pay' => 0));
            exit;
        }
    }

    private function get_uid(){
        $exam_auth = getcookie('exam_auth');
        require_once libfile('class/myredis');
        $myredis = & myredis::instance();
        $uid = $myredis->HGET("exam_auth_".$exam_auth,'uid');
        if(!$uid){
            return $this->xuexiao_wechat_info();
        }else{
            return $uid;
        }
    }

    private function curPageURL()
    {
        global $_G;
        $pageURL = 'http';

        if ($_SERVER["HTTPS"] == "on")
        {
            $pageURL .= "s";
        }
        $pageURL .= "://";

        if ($_SERVER["SERVER_PORT"] != "80")
        {
            $pageURL .= $_G['config']['host']['portal']. ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }
        else
        {
            $pageURL .= $_G['config']['host']['portal'].$_SERVER['REQUEST_URI'];
        }
        return $pageURL;
    }

    private function pc_login(){
        session_start();
        $_SESSION['connect_referer'] = $this->curPageURL();
        header('Location: '.$this->pc_wechat_login);
    }

    private function is_wap(){
        $useragent   = strtolower($_SERVER['HTTP_USER_AGENT']);
        return strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false || strpos($useragent, 'android') !== false || strpos($useragent, 'windows phone') !== false ? true : false;
    }
}
?>
