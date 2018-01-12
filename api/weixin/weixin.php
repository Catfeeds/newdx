<?php
error_reporting(0);
set_time_limit(0);

//require_once('../../external/fb.ext.php');
require_once('../../source/class/class_core.php');
require_once('../../source/class/class_sockpost.php');

$discuz = & discuz_core::instance();
$discuz->init();

define("TOKEN", "8264com");

$wechatObj = new wechatCallbackapiTest();
if ($wechatObj->valid()) {
	$wechatObj->responseMsg();
}

class wechatCallbackapiTest
{
	public function valid()
    {
        return $this->checkSignature();
    }

    public function responseMsg()
    {
    	global $_G;

		$postStr = file_get_contents('php://input');

		if (!empty($postStr)){
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$msgType = trim($postObj->MsgType);
			$date	 = date('Y_m_d');
			$content = array();
			$tip 	 = '';

			require_once('../../source/plugin/dianping/dianping.fun.php');
			$mdArticleTitle	= m("portal_article_title");

			//����redis����
	        require_once libfile('class/myredis');
			$myredis = & myredis::instance(6381);

			switch ($msgType){
			    case "event":
			        switch ($postObj->Event){
		            	case "CLICK":
			                switch ($postObj->EventKey){
		                        case 'ltjx':
		                        	//��̳��ѡ
		                        	$memKey 	= 'cache_weixin_ltjx_list_'.$date;
		                        	$redisKey 	= 'weixin_ltjx_page_'.$date;
//									memory('rm', $memKey);
									//����mencache�ѵ��ڣ������»���
									if (!$ltjxList = memory('get', $memKey)) {
										$aids = array("871", "886", "887", "888", "889", "890", "891", "892", "893", "894", "895", "896", "897", "898", "899", "900", "901");
										$where    = "{$mdArticleTitle->alias}.status=0 and {$mdArticleTitle->alias}.catid in (".dimplode($aids).") and {$mdArticleTitle->alias}.pic <> {$mdArticleTitle->alias}.mpic and {$mdArticleTitle->alias}.mpic <> '' and {$mdArticleTitle->alias}.pic <> ''";

										$ltjxList = $mdArticleTitle->find(array("fields"=>"{$mdArticleTitle->alias}.*", "conditions"=>$where, "order"=>"{$mdArticleTitle->alias}.dateline desc", "limit"=>"0,60"), false);

										//ɾ��ǰһ���redis
										$prevDate = strtotime('-1 days');
										$prevDate = date('Y_m_d', $prevDate);
										$myredis->delete('weixin_ltjx_page_'.$prevDate);

										//�ѽ����ҳ������
										$myredis->hashset($redisKey, $postObj->FromUserName, 0);

										memory('set', $memKey, $ltjxList, 3600*4);
									}

									//redis���¡���ȡҳ��
							        $myredis->obj->hIncrBy($redisKey, $postObj->FromUserName,1);
							        $page  		= $myredis->hashget($redisKey, $postObj->FromUserName);
							        $perpage	= 6;
							        $start 		= ($page-1)*$perpage;

									$ltjxList = array_slice($ltjxList, $start, $perpage);
									foreach ($ltjxList as $k=>$v) {
										if ($k == 0) {
											$v['pic']  = $v['mpic'] ? getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, 'portal/'.$v['mpic'], 0, $v['serverid']) : "";
										} else {
											$v['pic']  = $v['pic'] ? getimagethumb(150, 150, 22, 'portal/'.$v['pic'], 0, $v['serverid']) : "";
										}
										$content[] = array("Title"=>$v['title'], "Description"=>$v['summary'], "PicUrl"=>$v['pic'], "Url" =>$v["url"]);
									}

									$tip = '�װ���¿�ѣ���������һ�����ʣ������Ե���������ӣ�����������ӣ�<a href="http://m.8264.com/bbs">http://m.8264.com/bbs</a>';
		                        break;
		                        case 'lxfs':
		                        	//��ϵ��ʽ
		                        	$tip    = "���������\n 1683088552��QQ��\n";
		                			$tip   .= "Ͷ�����䣺\n 1480438854@qq.com��Ŀǰ�޸�ѣ�\n";
		                			$tip   .= "���ⷴ����\n 022-2370 8264-8011\n";
		                        break;
								case 'lxkf':
		                        	//��ϵ��ʽ
		                        	$tip    = "QQ��\n 2534155085/718214661\n";
		                			$tip   .= "�绰��\n 022-23708264-8013/8014\n";
		                			$tip   .= "��ϵ�ˣ��ϱ�/��ɫ��ӡ";
		                        break;
			                }
	                	break;
	                	case "subscribe":
		                	$tip 	= '��ӭ��ע��
���ǽ����������רҵ�Ļ���֪ʶ������Ƥ�Ļ�����
�滧�⣬����8264�ƽ̨��
5000+������·���ڵ���
�������http://hd.8264.com/';
		                break;
			        }

			        if(!empty($content)){
				        $result = $this->replyNews($postObj, $content);
			        } else {
			        	$result = $this->replyText($postObj, $tip);
			        }
		        break;
                case 'text':
                	$keyword = iconv('UTF-8', 'GBK', $postObj->Content);
                	$keyword = trim($keyword);

            		$arrKeyword = array(
            			/*
                         * ��վ����
                        "1" => array('data_type'=>'category', 'type_id'=>4, 'limit'=>'0-7', 'catid'=>1),
            			"2" => array('data_type'=>'category', 'type_id'=>16, 'limit'=>'0-7', 'catid'=>2),
            			"3" => array('data_type'=>'category', 'type_id'=>1, 'limit'=>'0-7', 'catid'=>3),
            			"4" => array('data_type'=>'category', 'type_id'=>6, 'limit'=>'0-7', 'catid'=>4),
            			"5" => array('data_type'=>'category', 'type_id'=>7, 'limit'=>'0-7', 'catid'=>5),
            			"6" => array('data_type'=>'good', 'type_id'=>445, 'catid'=>6),
                         *
                         */
                        '�Ĵ�'=>array('url'=>'http://m.hd.8264.com/xianlu-0-0-0-0','catid'=>'mudidi'),
                        '���ɹ�'=>array('url'=>'http://m.hd.8264.com/xianlu-0-1-0-0','catid'=>'mudidi'),
                        '�ຣ'=>array('url'=>'http://m.hd.8264.com/xianlu-0-2-0-0','catid'=>'mudidi'),
                        '�㽭'=>array('url'=>'http://m.hd.8264.com/xianlu-0-3-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-4-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-5-0-0','catid'=>'mudidi'),
                        '�㶫'=>array('url'=>'http://m.hd.8264.com/xianlu-0-6-0-0','catid'=>'mudidi'),
                        '�½�'=>array('url'=>'http://m.hd.8264.com/xianlu-0-7-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-8-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-9-0-0','catid'=>'mudidi'),
                        '�ӱ�'=>array('url'=>'http://m.hd.8264.com/xianlu-0-10-0-0','catid'=>'mudidi'),
                        'ɽ��'=>array('url'=>'http://m.hd.8264.com/xianlu-0-11-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-12-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-13-0-0','catid'=>'mudidi'),
                        '�Ϻ�'=>array('url'=>'http://m.hd.8264.com/xianlu-0-14-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-15-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-16-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-17-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-18-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-19-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-20-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-21-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-22-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-23-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-24-0-0','catid'=>'mudidi'),
                        '������'=>array('url'=>'http://m.hd.8264.com/xianlu-0-25-0-0','catid'=>'mudidi'),
                        '���'=>array('url'=>'http://m.hd.8264.com/xianlu-0-26-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-27-0-0','catid'=>'mudidi'),
                        'ɽ��'=>array('url'=>'http://m.hd.8264.com/xianlu-0-28-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-29-0-0','catid'=>'mudidi'),
                        '���'=>array('url'=>'http://m.hd.8264.com/xianlu-0-30-0-0','catid'=>'mudidi'),
                        '̨��'=>array('url'=>'http://m.hd.8264.com/xianlu-0-31-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-32-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-33-0-0','catid'=>'mudidi'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-0-35-0-0','catid'=>'mudidi'),
                        'ͽ��'=>array('url'=>'http://m.hd.8264.com/xianlu-4-0-0-0','catid'=>'wanfa'),
                        'Ư��'=>array('url'=>'http://m.hd.8264.com/xianlu-71-0-0-0','catid'=>'wanfa'),
                        '¶Ӫ'=>array('url'=>'http://m.hd.8264.com/xianlu-7-0-0-0','catid'=>'wanfa'),
                        '����&��ͧ'=>array('url'=>'http://m.hd.8264.com/xianlu-61-0-0-0','catid'=>'wanfa'),
                        'Ǳˮ'=>array('url'=>'http://m.hd.8264.com/xianlu-16-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-36-0-0-0','catid'=>'wanfa'),
                        '��ѵ'=>array('url'=>'http://m.hd.8264.com/xianlu-48-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-11-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-63-0-0-0','catid'=>'wanfa'),
                        '���ӻ���'=>array('url'=>'http://m.hd.8264.com/xianlu-78-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-88-0-0-0','catid'=>'wanfa'),
                        '��ѩɽ'=>array('url'=>'http://m.hd.8264.com/xianlu-51-0-0-0','catid'=>'wanfa'),
                        '��Ϫ'=>array('url'=>'http://m.hd.8264.com/xianlu-72-0-0-0','catid'=>'wanfa'),
                        'ԽҰ�Լ�'=>array('url'=>'http://m.hd.8264.com/xianlu-85-0-0-0','catid'=>'wanfa'),
                        '��ɡ'=>array('url'=>'http://m.hd.8264.com/xianlu-82-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-13-0-0-0','catid'=>'wanfa'),
                        '����CS'=>array('url'=>'http://m.hd.8264.com/xianlu-70-0-0-0','catid'=>'wanfa'),
                        '�߶���'=>array('url'=>'http://m.hd.8264.com/xianlu-60-0-0-0','catid'=>'wanfa'),
                        '����ɡ'=>array('url'=>'http://m.hd.8264.com/xianlu-59-0-0-0','catid'=>'wanfa'),
                        '��'=>array('url'=>'http://m.hd.8264.com/xianlu-87-0-0-0','catid'=>'wanfa'),
                        '���'=>array('url'=>'http://m.hd.8264.com/xianlu-69-0-0-0','catid'=>'wanfa'),
                        '��Ӱ'=>array('url'=>'http://m.hd.8264.com/xianlu-9-0-0-0','catid'=>'wanfa'),
                        '������'=>array('url'=>'http://m.hd.8264.com/xianlu-76-0-0-0','catid'=>'wanfa'),
                        '������'=>array('url'=>'http://m.hd.8264.com/xianlu-75-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-5-0-0-0','catid'=>'wanfa'),
                        '��Ǳ'=>array('url'=>'http://m.hd.8264.com/xianlu-73-0-0-0','catid'=>'wanfa'),
                        'ʵ�����'=>array('url'=>'http://m.hd.8264.com/xianlu-68-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-52-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-66-0-0-0','catid'=>'wanfa'),
                        '���ⶨ��'=>array('url'=>'http://m.hd.8264.com/xianlu-89-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-58-0-0-0','catid'=>'wanfa'),
                        'Ƥ��ͧ'=>array('url'=>'http://m.hd.8264.com/xianlu-62-0-0-0','catid'=>'wanfa'),
                        'ɳĮ'=>array('url'=>'http://m.hd.8264.com/xianlu-79-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-53-0-0-0','catid'=>'wanfa'),
                        '��ѩ'=>array('url'=>'http://m.hd.8264.com/xianlu-6-0-0-0','catid'=>'wanfa'),
                        'ԽҰ��'=>array('url'=>'http://m.hd.8264.com/xianlu-50-0-0-0','catid'=>'wanfa'),
                        'תɽ'=>array('url'=>'http://m.hd.8264.com/xianlu-83-0-0-0','catid'=>'wanfa'),
                        '�ļ�'=>array('url'=>'http://m.hd.8264.com/xianlu-77-0-0-0','catid'=>'wanfa'),
                        '�ٽ�'=>array('url'=>'http://m.hd.8264.com/xianlu-67-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-80-0-0-0','catid'=>'wanfa'),
                        '�ϱ���'=>array('url'=>'http://m.hd.8264.com/xianlu-90-0-0-0','catid'=>'wanfa'),
                        '����'=>array('url'=>'http://m.hd.8264.com/xianlu-54-0-0-0','catid'=>'wanfa'),
                        '̽��'=>array('url'=>'http://m.hd.8264.com/xianlu-64-0-0-0','catid'=>'wanfa'),
                        '���ݳ���'=>array('url'=>'http://m.hd.8264.com/xianlu-74-0-0-0','catid'=>'wanfa'),
                        '��ˮ'=>array('url'=>'http://m.hd.8264.com/xianlu-91-0-0-0','catid'=>'wanfa'),
                        '�����'=>array('url'=>'http://m.hd.8264.com/xianlu-45-0-0-0','catid'=>'wanfa'),
            		);
            		if (isset($arrKeyword[$keyword])) {
//                        if($arrKeyword[$keyword]['catid'] !=1 || $arrKeyword[$keyword]['catid'] !=2 || $arrKeyword[$keyword]['catid'] !=3 || $arrKeyword[$keyword]['catid'] !=4 || $arrKeyword[$keyword]['catid'] !=5 || $arrKeyword[$keyword]['catid'] !=6){
                            $tip = $keyword.'��������'.$arrKeyword[$keyword]['url'];
                            $result = $this->replyText($postObj, $tip);
                        /*

                        }else{
                            //����mencache�ѵ��ڣ������»���
//							memory('rm', $memKey);
                            $memKey = 'cache_weixin_wan_list_'.$arrKeyword[$keyword]['catid'];
                            if (!$content = memory('get', $memKey)) {
                                $url = 'http://m.zaiwai.com/wap.php?app=api&act=getData';
                                foreach ($arrKeyword[$keyword] as $k=>$v) {
                                    $url .= $k == 'catid' ? '' : "&{$k}={$v}";
                                }
                                $res = @file_get_contents($url);
                                $res = json_decode($res, true);
                                if (!empty($res)) {
                                    $index = 0;
                                    foreach ($res as $v) {
                                        $v['pic'] 	= $v['default_image'];
                                        $v['title']	= iconv('UTF-8', 'GBK', $v['title']);
                                        $v['url']	= iconv('UTF-8', 'GBK', $v['url']);
                                        $v['pic']	= iconv('UTF-8', 'GBK', $v['pic']);
                                        $v['pic']	= str_replace('http://image.8264.com/', '', $v['pic']);
                                        $v['pic']	= $v['pic'] ? "http://img.qunawan.com/{$v['pic']}" : '';
                                        if ($index == 0) {
                                            $v['pic']  .= $v['pic'] ? "!wap" : '';
                                        } else {
                                            $v['pic']  .= $v['pic'] ? "!t2w150h150" : '';
                                        }
                                        $content[]  = array("Title"=>$v['title'], "Description"=>'', "PicUrl"=>$v['pic'], "Url" =>$v["url"]);
                                        $index++;
                                    }
                                    memory('set', $memKey, $content, 3600);
                                }

                            } else {
                                $content = memory('get', $memKey);
                            }
                        }

						if (!empty($content)) {
							$result = $this->replyNews($postObj, $content);
						}
                         *
                         */
            		/*} elseif ($keyword == '7') {
            			$title 		 = '�㻹��������������ˣ�����ֱ����ͷ¿��';
            			$description = '�����⡱С��¿~~�쵽����������';
            			$pic 		 = 'https://mmbiz.qlogo.cn/mmbiz/Dr9icM5Ah8gOuSIZc4ibvXYWxibibxKyOsicPicvtkf7WURFbLLA7jONricCZaddL5DnRY5TgIIy7AXw7E9DrKYZW8iaibg/0?wx_fmt=jpeg';
            			$url 		 = 'http://mp.weixin.qq.com/s?__biz=MzA4MjE2OTcwNA==&mid=209144922&idx=1&sn=e9eea2a67aec5d5199cc987c85b8affe#rd';
						$content[]   = array("Title"=>$title, "Description"=>$description, "PicUrl"=>$pic, "Url" =>$url);
						$result = $this->replyNews($postObj, $content);*/
            		} else {
            			preg_match_all('/��ҪѩƱ|ѩƱ/isU', $keyword, $matA);
            			preg_match_all('/ͶƱ|kol/isU', $keyword, $matB);
                        preg_match_all('/װ����/isU', $keyword, $matC);
						preg_match_all('/��֤�˺�/isU', $keyword, $matD);

            			if (!empty($matA[0])) {
            				$tip = "��ע��qunawan_8264���ٷ�΢�ţ����ظ�����ҪѩƱ+����+��ϵ��ʽ����";
            			} elseif ($matB[0]) {
            				$tip = '��ӭ�μ�2015���KOL��ѡ������<a href="http://front.qunawan.com/vote_list">ͶƱ�������</a>';
            			} elseif ($matC[0]) {
            				$tip = '<a href="http://m.8264.com/thread-5301540-1.html">http://m.8264.com/thread-5301540-1.html</a>';
            			} elseif ($matD[0]) {
                            //΢�ŷ�����֤�˺����� ��ʽ( ��֤�˺�:�û��� )
                            $keyword = str_replace(array('��', ' '), array(':', ''), $keyword);
                            $keyword_arr = explode(':', $keyword);
                            $username = diconv(trim($keyword_arr[1]), 'utf-8', 'gbk');
                            $userinfo = DB::fetch_first("SELECT uid, status FROM ".DB::table("common_member")." WHERE username='$username'");
                            if($userinfo['uid'] && $userinfo['status'] > 0) {
                                $userwx = DB::fetch_first("SELECT uid, wechatunionid FROM ".DB::table("common_openid_wechat")." WHERE uid='$userinfo[uid]'");
                                if(!$userwx['wechatunionid']) {
                                    $tip = '���Ȱ�΢���˺ţ��ٽ�����֤';
                                } else {

                                    require_once DISCUZ_ROOT.'openid/openid_model.php';
                                    $openid = new openid;
                                    $access_token = $openid->wechat_token_8264();

                                    //$postObj->FromUserNameΪOpenID ���ô�ȥ���û�unionid
                                    //https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140839
                                    $wxapi = requestRemoteData("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token['wechat_token']."&openid=".$postObj->FromUserName."&lang=zh_CN");
                                    $wxinfo = $wxapi ? json_decode($wxapi, true) : array();
                                    if($userwx['wechatunionid'] == $wxinfo['unionid']) {    //��֤���û��ǰ󶨵��� ��֤�ɹ�
                                        DB::query("UPDATE ".DB::table("common_member")." SET status=0 WHERE uid='$userinfo[uid]'");
                                        $tip = '�˺���ͨ����֤';
                                    }
                                }
                            } elseif (!$userinfo['uid']) {
                                $tip = 'δ�ҵ������˺ţ������ԡ�';
                            } elseif ($userinfo['status'] == 0) {
                                $tip = '�˺���ͨ����֤';
                            }

                        } else {
                            /*
            				$tip    = "��֪��ȥ���棿������Ҫ��ظ����鿴���໧��������·��\r\n";
                			$tip   .= "�ظ���1��ͽ��\r\n";
                			$tip   .= "�ظ���2��Ǳˮ\r\n";
                			$tip   .= "�ظ���3����ɽ\r\n";
                			$tip   .= "�ظ���4����ѩ\r\n";
                			$tip   .= "�ظ���5��¶Ӫ\r\n";
                			$tip   .= "�ظ���6���ؼۣ����������ؼ���·\r\n";
//                			$tip   .= "�ظ���7���μ�ӮȡС¿�\r\n";
                             *
                             */
                            $tip = "����ʡ�ݻ����淨��������Ҫ�ĻŶ~";
            			}
            			$result = $this->replyText($postObj, $tip);
            		}
                break;
                case 'image':
                case 'location':
                case 'voice':
                case 'video':
                default:
                	$tip 	= '��л��ע8264������������2015����������н������������⡷�����<a href="http://a.app.qq.com/o/simple.jsp?pkgname=com.bj8264.zaiwai.android">��������app</a>��������';
                	$result = $this->replyText($postObj, $tip);
                break;
			}
			if (!empty($result)) {
	        	$result	= iconv('GBK', 'UTF-8', $result);
	        	echo $result;
	        }
		}else {
			echo "";
		}
		exit();
    }

    //��֤��Ϣ
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce 	   = $_GET["nonce"];

		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

	//�ظ��ı���Ϣ
	private function replyText($postObj, $tip)
	{
		$xmlTpl =  "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					</xml>";
        return sprintf($xmlTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $tip);
	}

	//�ظ�ͼ����Ϣ
	private function replyNews($postObj, $content)
	{
		$itemTpl = "<item>
			        <Title><![CDATA[%s]]></Title>
			        <Description><![CDATA[%s]]></Description>
			        <PicUrl><![CDATA[%s]]></PicUrl>
			        <Url><![CDATA[%s]]></Url>
				    </item>";
        $item_str = "";
        foreach ($content as $v){

//				        	$v['Title'] = '��ͼ��1����';
//				        	$v['Description'] = '��ͼ��1����';
//				        	$v['PicUrl'] = 'http://discuz.comli.com/weixin/weather/icon/cartoon.jpg';
//				        	$v['Url'] = 'http://m.cnblogs.com/?u=txw1958';

            $item_str .= sprintf($itemTpl, $v['Title'], $v['Description'], $v['PicUrl'], $v['Url']);
        }
        $xmlTpl =  "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>%s</ArticleCount>
					<Articles>
					$item_str
        			</Articles>
					</xml>";
        return sprintf($xmlTpl, $postObj->FromUserName, $postObj->ToUserName, time(), count($content));
	}
}
