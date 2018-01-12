<?php
/**
 * @author lvshuo
 * @copyright 2017
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class PortalSchoolCtl extends FrontendCtl{

	private $mdArticleTitle;
	private $mdArticleContent;
	private $mdForumThread;
	private $mdArticleCount;
	private $mdForumPost;
	private $mdForumAttachment;

	function __construct()
	{
		parent::__construct();

		$this->mdArticleTitle		= m("portal_article_title");
		$this->mdArticleContent		= m("portal_article_content");
		$this->mdForumThread		= m("forum_thread");
		$this->mdArticleCount		= m("portal_article_count");
		$this->mdForumPost			= m("forum_post");
		$this->mdForumAttachment	= m("forum_attachment");
	}


	//����ѧУ��ҳ
	function showindex()
	{
		global $_G;
		global $returnData;

		//ͷ��
		$_G['gp_uid'] = max(0,intval($_G['gp_uid']));
		$returnData["avatar"]  = avatar($_G['gp_uid'],'middle');

        //��ҳ֪ʶ��ʼ
        require_once libfile('function/portalcp');
        $catid = 238;
        $catShow = category_remake($catid);
        $catShow["children"][] =  $catid;
        $where   = "{$this->mdArticleTitle->alias}.status='0' and {$this->mdArticleTitle->alias}.catid IN (".dimplode($catShow["children"]).")";
        $rcTotal = $this->mdArticleTitle->getCount($where);
        if ($rcTotal) {
            $articleList = $this->mdArticleTitle->find(array("fields"=>"{$this->mdArticleTitle->alias}.*", "conditions"=>$where, "order"=>"{$this->mdArticleTitle->alias}.stickstate desc,{$this->mdArticleTitle->alias}.dateline desc", "limit"=>"0,3"), false);
        }

        $aids = array();
        foreach ($articleList as $k=>$v) {
            if ($catid == 902) {
                //����ѡ��ԭͼ����ͼƬ����,��һ������������ֵ,�ڶ�������Ϊ0,����������Ϊ5
                $v['pic']  = getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, 'portal/'.$v['pic'], 0, $v['serverid']);
                $aids[$v['aid']] = $v['aid'];
            } else {
                $v['pic'] 	  = $v['pic'] ? getimagethumb(130,90,22,'portal/'.$v['pic'], 0, $v['serverid']) : "";
                $aids[$v['aid']] = $v['aid'];
            }
            $v['catname'] = $v['catid'] == $catShow['catid'] ? $catShow['catname'] : $portalcategory[$v['catid']]['catname'];
            $articleList[$k] = $v;
        }

        //��ȡ����ͳ����Ϣ
        if ($aids) {
            $aids = implode(",", $aids);
            $articleCountList = $this->mdArticleCount->find(array("fields"=>'viewnum', "conditions"=>"aid in ({$aids})"));
            $returnData["articleCountList"] = $articleCountList;
        }

        $returnData["articleList"] 		= $articleList;
        $returnData["catname"] 			= $catShow["catname"];
        //��ҳ֪ʶ����


        //��ҳ�ʴ�ʼ
        $returnData["wenda"] = $this->getWendaDataforSchool();
        //var_dump($returnData["wenda"]);die;
        //��ҳ�ʴ����

        //��ҳ���Կ�ʼ
        $returnData["kaoshi"] = $this->getKaoshiDataforSchool();
        //var_dump($returnData["kaoshi"]);die;
        //��ҳ���Խ���


        //��ҳ��ѵ��ʼ
        $returnData["peixun"] = $this->getHdPeixunData();
        //��ҳ��ѵ����


		encodeData($returnData);

	}




    function getWendaDataforSchool(){
        global $_G;
        require DISCUZ_ROOT . '/source/function/function_discuzcode.php';
        $wenda_sql ="SELECT topicid,title, replynum,upreplyid FROM ".DB::table("question_topic")." WHERE title != '' AND isshow ='1' AND replynum != '0' AND upreplyid != '0' ORDER BY displayorder DESC,pubdateline DESC,replynum DESC,topicid DESC LIMIT 0, 4 ".getSlaveID();
        $query = DB::query($wenda_sql);
        while ($v = DB::fetch($query)) {
            if($v['upreplyid']){
                $replyOne =DB::fetch_first("SELECT * FROM " . DB::table('question_reply') . " where replyid ='{$v[upreplyid]}' " . getSlaveID());
                if($replyOne['tid']&&$replyOne['tiddata']){
                    $replyOne['tiddata'] =json_decode($replyOne['tiddata'], true);
                    for($i=0;$i<count($replyOne['tiddata']);$i++){
                        $postOne =DB::fetch_first("SELECT message FROM " . DB::table('forum_post') . " where pid={$replyOne['tiddata'][$i]} " . getSlaveID());
                        $postOne['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios]����iPhone�ͻ���[/url]', '', $postOne['message']);
                        $postOne['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=ios/]����iPhone�ͻ���[/url]', '', $postOne['message']);
                        $postOne['message']=str_replace('[url=www.8264.com/app/]����iPhone�ͻ���[/url]', '', $postOne['message']);
                        $postOne['message']=str_replace('[url=http://www.8264.com/app/]����iPhone�ͻ���[/url]', '', $postOne['message']);
                        $postOne['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android]����Android�ͻ���[/url]', '', $postOne['message']);
                        $postOne['message']=str_replace('[url=http://mobile.8264.com/public.php?mod=app&platform=android/]����Android�ͻ���[/url]', '', $postOne['message']);
                        $postOne['message']=str_replace('[url=www.8264.com/app/]����Android�ͻ���[/url]', '', $postOne['message']);
                        $postOne['message']=str_replace('[url=http://www.8264.com/app/]����Android�ͻ���[/url]', '', $postOne['message']);
                        $postOne['message']=str_replace('[p=24, null, left]', '', $postOne['message']);
                        $postOne['message']=str_replace('[/p]', '', $postOne['message']);
                        $postOne['message'] = preg_replace('/\[quote\]\[size=2\](.*)������(.*)static\/image\/common\/back\.gif(.*)\[\/size\](.*)\[\/quote\]/isU', '', $postOne['message']);
                        $postOne['message'] = preg_replace('/\[quote\]ԭ����(.*)\[\/quote\]/isU', '', $postOne['message']);

                        if($i==(count($replyOne['tiddata'])-1)){
                            $replyOne['rcontent'] .=$postOne['message'];
                        }else{
                            $replyOne['rcontent'] .=$postOne['message'].'<br/>';
                        }
                    }

                    $replyOne['rcontent'] = questionmodelMessage_wap($replyOne['rcontent']);
                    $replyOne['rcontent'] = htmlspecialchars_decode($replyOne['rcontent']);
                    $replyOne['rcontent'] = _removingPBR_wap($replyOne['rcontent']);
                    $replyOne['textrcontent'] = preg_replace("/<img.*\/>/i", '', $replyOne['rcontent']);
                    $replyOne['textrcontent']=str_replace('&nbsp;', '', $replyOne['textrcontent']);
                    $qian=array(" ","��","\t","\n","\r");
                    $hou=array("","","","","");
                    $replyOne['textrcontent'] =str_replace($qian,$hou,$replyOne['textrcontent']);
                    $replyOne['textrcontent'] = strip_tags($replyOne['textrcontent'], "<table><tbody><tr><th><td><span><script>");
                }else{
                    $replyOne['rcontent'] = discuzcode($replyOne['rcontent']);
                    $replyOne['rcontent'] = thumb_all_pic(800, 0, $replyOne['rcontent']);
                    $replyOne['rcontent'] = _removingPBR_wap($replyOne['rcontent']);
                    $replyOne['textrcontent'] = preg_replace("/<img.*\/>/i", '', $replyOne['rcontent']);
                    $replyOne['textrcontent']=str_replace('&nbsp;', '', $replyOne['textrcontent']);
                    $replyOne['textrcontent']=str_replace('&nbsp;', '', $replyOne['textrcontent']);
                    $qian=array(" ","��","\t","\n","\r");
                    $hou=array("","","","","");
                    $replyOne['textrcontent'] =str_replace($qian,$hou,$replyOne['textrcontent']);
                    $replyOne['textrcontent'] = strip_tags($replyOne['textrcontent'], "<table><tbody><tr><th><td><span><script>");
                }

                $v['textrcontent'] = cutstr($replyOne['textrcontent'],80,'...');
                $v['textauthor'] = $replyOne['author'];
                $v['textauthorid'] = $replyOne['authorid'];
                $v["reply_avatar"]  = avatar($v[textauthorid],'middle');
            }
            $list[] 		= $v;
        }

        return $list;
    }



function getKaoshiDataforSchool(){
    require_once libfile('class/myredis');
    $myredis = & myredis::instance();

    //��ȫ���� catid=2   ������� catid=1     ��ѩ catid=9

    $myredis->sInterStore("exam_catid_2", "exam_catid_2", "exam_all_ids");
    $jijiu_arr_ids = $myredis->sDiff("exam_catid_2", "exam_noshow_ids");

    $myredis->sInterStore("exam_catid_1", "exam_catid_1", "exam_all_ids");
    $huwai_arr_ids = $myredis->sDiff("exam_catid_1", "exam_noshow_ids");

    $myredis->sInterStore("exam_catid_9", "exam_catid_9", "exam_all_ids");
    $huaxue_arr_ids = $myredis->sDiff("exam_catid_9", "exam_noshow_ids");

    $data[1] = array('catid'=>1,'counts'=>count($huwai_arr_ids));
    $data[2] = array('catid'=>2,'counts'=>count($jijiu_arr_ids));
    $data[9] = array('catid'=>9,'counts'=>count($huaxue_arr_ids));
    return $data;
}







    //���ݵ�ǰ�����ȡ�Ƽ�����
    function getHdPeixunData(){
        $random = 5;
        global $_G;
        $appname = $_G['config']['hdapikey']['8264com']['appname'];
        $appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
        $params = array(
            'appname' => $appname,
            'app' => 'search',
            'act' => 'indexlist',
            'qt' => time(),
            'cate' => '48',
            'order'=>2
        );
        $url = $this->build_url($params, $appsecret);
        $json_data = file_get_contents($url);
        $data = json_decode($json_data, true);
        if($data['errorCode'] == 0){
            $data = iconv_array($data['result'], 'UTF-8', 'GBK');
            return $data['list'];
        }



        return false;
    }
    function build_url($params, $appsecret, $apiurl = 'http://hd.8264.com/api/index.php') {
        ksort($params);
        reset($params);
        $str_q = http_build_query($params);
        $sign = md5($str_q . $appsecret);
        return $apiurl . '?' . $str_q . '&sign=' . $sign;
    }




    //����ѧУ��ҳ
    function showlist()
    {
        global $_G;
        global $returnData;

        //��������
        $_G['gp_catid'] = $catid = max(0,intval($_G['gp_catid']));
        $perpage = $_G['gp_perpage'] ? intval($_G['gp_perpage']) : 15;
        $page 	 = $_G['gp_page'] ? max(1,intval($_G['gp_page'])) : 1;
        $start 	 = ($page - 1) * $perpage;

        if(empty($catid)) {
            encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'list_choose_category')));
        }

        //ͷ��
        $_G['gp_uid'] = max(0,intval($_G['gp_uid']));
        $page==1&&$returnData["avatar"]  = avatar($_G['gp_uid'],'middle');

        //֪ʶ�б�ʼ
        require_once libfile('function/portalcp');
        //$catid = 238;
        $catShow = category_remake($catid);
        $catShow["children"][] =  $catid;
        $where   = "{$this->mdArticleTitle->alias}.status='0' and {$this->mdArticleTitle->alias}.catid IN (".dimplode($catShow["children"]).")";
        $rcTotal = $this->mdArticleTitle->getCount($where);
        if ($rcTotal) {
            $articleList = $this->mdArticleTitle->find(array("fields"=>"{$this->mdArticleTitle->alias}.*", "conditions"=>$where, "order"=>"{$this->mdArticleTitle->alias}.stickstate desc,{$this->mdArticleTitle->alias}.dateline desc", "limit"=>"$start,$perpage"), false);
        }

        $aids = array();
        foreach ($articleList as $k=>$v) {
            if ($catid == 902) {
                //����ѡ��ԭͼ����ͼƬ����,��һ������������ֵ,�ڶ�������Ϊ0,����������Ϊ5
                $v['pic']  = getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, 'portal/'.$v['pic'], 0, $v['serverid']);
                $aids[$v['aid']] = $v['aid'];
            } else {
                $v['pic'] 	  = $v['pic'] ? getimagethumb(130,90,22,'portal/'.$v['pic'], 0, $v['serverid']) : "";
                $aids[$v['aid']] = $v['aid'];
            }
            $v['catname'] = $v['catid'] == $catShow['catid'] ? $catShow['catname'] : $portalcategory[$v['catid']]['catname'];
            $articleList[$k] = $v;
            $articleList_new[$v['aid']] = $v;
        }

        //��ȡ����ͳ����Ϣ
        if ($aids) {
            $aids = implode(",", $aids);
            $articleCountList = $this->mdArticleCount->find(array("fields"=>'viewnum', "conditions"=>"aid in ({$aids})"));
            //$returnData["articleCountList"] = $articleCountList;
            foreach($articleCountList as $k=>$v){
                $articleList_new[$k]['viewnum'] = $v['viewnum'];
            }
        }

        //$returnData["articleList"] 		= $articleList;
        $returnData["articleList"] 		= $articleList_new;
        $returnData["catname"] 			= $catShow["catname"];
        //֪ʶ�б����

        encodeData($returnData);

    }

}
?>
