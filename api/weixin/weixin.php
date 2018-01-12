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

			//生成redis对象
	        require_once libfile('class/myredis');
			$myredis = & myredis::instance(6381);

			switch ($msgType){
			    case "event":
			        switch ($postObj->Event){
		            	case "CLICK":
			                switch ($postObj->EventKey){
		                        case 'ltjx':
		                        	//论坛精选
		                        	$memKey 	= 'cache_weixin_ltjx_list_'.$date;
		                        	$redisKey 	= 'weixin_ltjx_page_'.$date;
//									memory('rm', $memKey);
									//若是mencache已到期，则重新缓存
									if (!$ltjxList = memory('get', $memKey)) {
										$aids = array("871", "886", "887", "888", "889", "890", "891", "892", "893", "894", "895", "896", "897", "898", "899", "900", "901");
										$where    = "{$mdArticleTitle->alias}.status=0 and {$mdArticleTitle->alias}.catid in (".dimplode($aids).") and {$mdArticleTitle->alias}.pic <> {$mdArticleTitle->alias}.mpic and {$mdArticleTitle->alias}.mpic <> '' and {$mdArticleTitle->alias}.pic <> ''";

										$ltjxList = $mdArticleTitle->find(array("fields"=>"{$mdArticleTitle->alias}.*", "conditions"=>$where, "order"=>"{$mdArticleTitle->alias}.dateline desc", "limit"=>"0,60"), false);

										//删掉前一天的redis
										$prevDate = strtotime('-1 days');
										$prevDate = date('Y_m_d', $prevDate);
										$myredis->delete('weixin_ltjx_page_'.$prevDate);

										//把今天的页数重置
										$myredis->hashset($redisKey, $postObj->FromUserName, 0);

										memory('set', $memKey, $ltjxList, 3600*4);
									}

									//redis更新、读取页数
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

									$tip = '亲爱的驴友，其他帖子一样精彩，您可以点击以下链接，浏览更多帖子：<a href="http://m.8264.com/bbs">http://m.8264.com/bbs</a>';
		                        break;
		                        case 'lxfs':
		                        	//联系方式
		                        	$tip    = "商务合作：\n 1683088552（QQ）\n";
		                			$tip   .= "投稿邮箱：\n 1480438854@qq.com（目前无稿费）\n";
		                			$tip   .= "问题反馈：\n 022-2370 8264-8011\n";
		                        break;
								case 'lxkf':
		                        	//联系方式
		                        	$tip    = "QQ：\n 2534155085/718214661\n";
		                			$tip   .= "电话：\n 022-23708264-8013/8014\n";
		                			$tip   .= "联系人：孟彬/金色脚印";
		                        break;
			                }
	                	break;
	                	case "subscribe":
		                	$tip 	= '欢迎关注！
我们将给你带来最专业的户外知识，最嗨皮的户外活动！
玩户外，就上8264活动平台！
5000+条户外路线在等你
点击进入http://hd.8264.com/';
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
                         * 主站帖子
                        "1" => array('data_type'=>'category', 'type_id'=>4, 'limit'=>'0-7', 'catid'=>1),
            			"2" => array('data_type'=>'category', 'type_id'=>16, 'limit'=>'0-7', 'catid'=>2),
            			"3" => array('data_type'=>'category', 'type_id'=>1, 'limit'=>'0-7', 'catid'=>3),
            			"4" => array('data_type'=>'category', 'type_id'=>6, 'limit'=>'0-7', 'catid'=>4),
            			"5" => array('data_type'=>'category', 'type_id'=>7, 'limit'=>'0-7', 'catid'=>5),
            			"6" => array('data_type'=>'good', 'type_id'=>445, 'catid'=>6),
                         *
                         */
                        '四川'=>array('url'=>'http://m.hd.8264.com/xianlu-0-0-0-0','catid'=>'mudidi'),
                        '内蒙古'=>array('url'=>'http://m.hd.8264.com/xianlu-0-1-0-0','catid'=>'mudidi'),
                        '青海'=>array('url'=>'http://m.hd.8264.com/xianlu-0-2-0-0','catid'=>'mudidi'),
                        '浙江'=>array('url'=>'http://m.hd.8264.com/xianlu-0-3-0-0','catid'=>'mudidi'),
                        '北京'=>array('url'=>'http://m.hd.8264.com/xianlu-0-4-0-0','catid'=>'mudidi'),
                        '西藏'=>array('url'=>'http://m.hd.8264.com/xianlu-0-5-0-0','catid'=>'mudidi'),
                        '广东'=>array('url'=>'http://m.hd.8264.com/xianlu-0-6-0-0','catid'=>'mudidi'),
                        '新疆'=>array('url'=>'http://m.hd.8264.com/xianlu-0-7-0-0','catid'=>'mudidi'),
                        '云南'=>array('url'=>'http://m.hd.8264.com/xianlu-0-8-0-0','catid'=>'mudidi'),
                        '甘肃'=>array('url'=>'http://m.hd.8264.com/xianlu-0-9-0-0','catid'=>'mudidi'),
                        '河北'=>array('url'=>'http://m.hd.8264.com/xianlu-0-10-0-0','catid'=>'mudidi'),
                        '山东'=>array('url'=>'http://m.hd.8264.com/xianlu-0-11-0-0','catid'=>'mudidi'),
                        '湖南'=>array('url'=>'http://m.hd.8264.com/xianlu-0-12-0-0','catid'=>'mudidi'),
                        '辽宁'=>array('url'=>'http://m.hd.8264.com/xianlu-0-13-0-0','catid'=>'mudidi'),
                        '上海'=>array('url'=>'http://m.hd.8264.com/xianlu-0-14-0-0','catid'=>'mudidi'),
                        '广西'=>array('url'=>'http://m.hd.8264.com/xianlu-0-15-0-0','catid'=>'mudidi'),
                        '湖北'=>array('url'=>'http://m.hd.8264.com/xianlu-0-16-0-0','catid'=>'mudidi'),
                        '安徽'=>array('url'=>'http://m.hd.8264.com/xianlu-0-17-0-0','catid'=>'mudidi'),
                        '陕西'=>array('url'=>'http://m.hd.8264.com/xianlu-0-18-0-0','catid'=>'mudidi'),
                        '福建'=>array('url'=>'http://m.hd.8264.com/xianlu-0-19-0-0','catid'=>'mudidi'),
                        '河南'=>array('url'=>'http://m.hd.8264.com/xianlu-0-20-0-0','catid'=>'mudidi'),
                        '江西'=>array('url'=>'http://m.hd.8264.com/xianlu-0-21-0-0','catid'=>'mudidi'),
                        '海南'=>array('url'=>'http://m.hd.8264.com/xianlu-0-22-0-0','catid'=>'mudidi'),
                        '贵州'=>array('url'=>'http://m.hd.8264.com/xianlu-0-23-0-0','catid'=>'mudidi'),
                        '江苏'=>array('url'=>'http://m.hd.8264.com/xianlu-0-24-0-0','catid'=>'mudidi'),
                        '黑龙江'=>array('url'=>'http://m.hd.8264.com/xianlu-0-25-0-0','catid'=>'mudidi'),
                        '天津'=>array('url'=>'http://m.hd.8264.com/xianlu-0-26-0-0','catid'=>'mudidi'),
                        '吉林'=>array('url'=>'http://m.hd.8264.com/xianlu-0-27-0-0','catid'=>'mudidi'),
                        '山西'=>array('url'=>'http://m.hd.8264.com/xianlu-0-28-0-0','catid'=>'mudidi'),
                        '宁夏'=>array('url'=>'http://m.hd.8264.com/xianlu-0-29-0-0','catid'=>'mudidi'),
                        '香港'=>array('url'=>'http://m.hd.8264.com/xianlu-0-30-0-0','catid'=>'mudidi'),
                        '台湾'=>array('url'=>'http://m.hd.8264.com/xianlu-0-31-0-0','catid'=>'mudidi'),
                        '重庆'=>array('url'=>'http://m.hd.8264.com/xianlu-0-32-0-0','catid'=>'mudidi'),
                        '澳门'=>array('url'=>'http://m.hd.8264.com/xianlu-0-33-0-0','catid'=>'mudidi'),
                        '国外'=>array('url'=>'http://m.hd.8264.com/xianlu-0-35-0-0','catid'=>'mudidi'),
                        '徒步'=>array('url'=>'http://m.hd.8264.com/xianlu-4-0-0-0','catid'=>'wanfa'),
                        '漂流'=>array('url'=>'http://m.hd.8264.com/xianlu-71-0-0-0','catid'=>'wanfa'),
                        '露营'=>array('url'=>'http://m.hd.8264.com/xianlu-7-0-0-0','catid'=>'wanfa'),
                        '邮轮&游艇'=>array('url'=>'http://m.hd.8264.com/xianlu-61-0-0-0','catid'=>'wanfa'),
                        '潜水'=>array('url'=>'http://m.hd.8264.com/xianlu-16-0-0-0','catid'=>'wanfa'),
                        '飞行'=>array('url'=>'http://m.hd.8264.com/xianlu-36-0-0-0','catid'=>'wanfa'),
                        '培训'=>array('url'=>'http://m.hd.8264.com/xianlu-48-0-0-0','catid'=>'wanfa'),
                        '包车'=>array('url'=>'http://m.hd.8264.com/xianlu-11-0-0-0','catid'=>'wanfa'),
                        '骑马'=>array('url'=>'http://m.hd.8264.com/xianlu-63-0-0-0','catid'=>'wanfa'),
                        '亲子户外'=>array('url'=>'http://m.hd.8264.com/xianlu-78-0-0-0','catid'=>'wanfa'),
                        '海岛'=>array('url'=>'http://m.hd.8264.com/xianlu-88-0-0-0','catid'=>'wanfa'),
                        '登雪山'=>array('url'=>'http://m.hd.8264.com/xianlu-51-0-0-0','catid'=>'wanfa'),
                        '溯溪'=>array('url'=>'http://m.hd.8264.com/xianlu-72-0-0-0','catid'=>'wanfa'),
                        '越野自驾'=>array('url'=>'http://m.hd.8264.com/xianlu-85-0-0-0','catid'=>'wanfa'),
                        '跳伞'=>array('url'=>'http://m.hd.8264.com/xianlu-82-0-0-0','catid'=>'wanfa'),
                        '海钓'=>array('url'=>'http://m.hd.8264.com/xianlu-13-0-0-0','catid'=>'wanfa'),
                        '真人CS'=>array('url'=>'http://m.hd.8264.com/xianlu-70-0-0-0','catid'=>'wanfa'),
                        '高尔夫'=>array('url'=>'http://m.hd.8264.com/xianlu-60-0-0-0','catid'=>'wanfa'),
                        '滑翔伞'=>array('url'=>'http://m.hd.8264.com/xianlu-59-0-0-0','catid'=>'wanfa'),
                        '向导'=>array('url'=>'http://m.hd.8264.com/xianlu-87-0-0-0','catid'=>'wanfa'),
                        '射箭'=>array('url'=>'http://m.hd.8264.com/xianlu-69-0-0-0','catid'=>'wanfa'),
                        '摄影'=>array('url'=>'http://m.hd.8264.com/xianlu-9-0-0-0','catid'=>'wanfa'),
                        '热气球'=>array('url'=>'http://m.hd.8264.com/xianlu-76-0-0-0','catid'=>'wanfa'),
                        '马拉松'=>array('url'=>'http://m.hd.8264.com/xianlu-75-0-0-0','catid'=>'wanfa'),
                        '骑行'=>array('url'=>'http://m.hd.8264.com/xianlu-5-0-0-0','catid'=>'wanfa'),
                        '浮潜'=>array('url'=>'http://m.hd.8264.com/xianlu-73-0-0-0','catid'=>'wanfa'),
                        '实弹射击'=>array('url'=>'http://m.hd.8264.com/xianlu-68-0-0-0','catid'=>'wanfa'),
                        '攀岩'=>array('url'=>'http://m.hd.8264.com/xianlu-52-0-0-0','catid'=>'wanfa'),
                        '帆船'=>array('url'=>'http://m.hd.8264.com/xianlu-66-0-0-0','catid'=>'wanfa'),
                        '户外定制'=>array('url'=>'http://m.hd.8264.com/xianlu-89-0-0-0','catid'=>'wanfa'),
                        '房车'=>array('url'=>'http://m.hd.8264.com/xianlu-58-0-0-0','catid'=>'wanfa'),
                        '皮划艇'=>array('url'=>'http://m.hd.8264.com/xianlu-62-0-0-0','catid'=>'wanfa'),
                        '沙漠'=>array('url'=>'http://m.hd.8264.com/xianlu-79-0-0-0','catid'=>'wanfa'),
                        '冲浪'=>array('url'=>'http://m.hd.8264.com/xianlu-53-0-0-0','catid'=>'wanfa'),
                        '滑雪'=>array('url'=>'http://m.hd.8264.com/xianlu-6-0-0-0','catid'=>'wanfa'),
                        '越野跑'=>array('url'=>'http://m.hd.8264.com/xianlu-50-0-0-0','catid'=>'wanfa'),
                        '转山'=>array('url'=>'http://m.hd.8264.com/xianlu-83-0-0-0','catid'=>'wanfa'),
                        '蹦极'=>array('url'=>'http://m.hd.8264.com/xianlu-77-0-0-0','catid'=>'wanfa'),
                        '速降'=>array('url'=>'http://m.hd.8264.com/xianlu-67-0-0-0','catid'=>'wanfa'),
                        '帆板'=>array('url'=>'http://m.hd.8264.com/xianlu-80-0-0-0','catid'=>'wanfa'),
                        '南北极'=>array('url'=>'http://m.hd.8264.com/xianlu-90-0-0-0','catid'=>'wanfa'),
                        '狩猎'=>array('url'=>'http://m.hd.8264.com/xianlu-54-0-0-0','catid'=>'wanfa'),
                        '探洞'=>array('url'=>'http://m.hd.8264.com/xianlu-64-0-0-0','catid'=>'wanfa'),
                        '风筝冲浪'=>array('url'=>'http://m.hd.8264.com/xianlu-74-0-0-0','catid'=>'wanfa'),
                        '滑水'=>array('url'=>'http://m.hd.8264.com/xianlu-91-0-0-0','catid'=>'wanfa'),
                        '深度游'=>array('url'=>'http://m.hd.8264.com/xianlu-45-0-0-0','catid'=>'wanfa'),
            		);
            		if (isset($arrKeyword[$keyword])) {
//                        if($arrKeyword[$keyword]['catid'] !=1 || $arrKeyword[$keyword]['catid'] !=2 || $arrKeyword[$keyword]['catid'] !=3 || $arrKeyword[$keyword]['catid'] !=4 || $arrKeyword[$keyword]['catid'] !=5 || $arrKeyword[$keyword]['catid'] !=6){
                            $tip = $keyword.'活动点击进入'.$arrKeyword[$keyword]['url'];
                            $result = $this->replyText($postObj, $tip);
                        /*

                        }else{
                            //若是mencache已到期，则重新缓存
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
            			$title 		 = '你还在抢红包？弱爆了！在外直接送头驴！';
            			$description = '“在外”小萌驴~~快到家里来！！';
            			$pic 		 = 'https://mmbiz.qlogo.cn/mmbiz/Dr9icM5Ah8gOuSIZc4ibvXYWxibibxKyOsicPicvtkf7WURFbLLA7jONricCZaddL5DnRY5TgIIy7AXw7E9DrKYZW8iaibg/0?wx_fmt=jpeg';
            			$url 		 = 'http://mp.weixin.qq.com/s?__biz=MzA4MjE2OTcwNA==&mid=209144922&idx=1&sn=e9eea2a67aec5d5199cc987c85b8affe#rd';
						$content[]   = array("Title"=>$title, "Description"=>$description, "PicUrl"=>$pic, "Url" =>$url);
						$result = $this->replyNews($postObj, $content);*/
            		} else {
            			preg_match_all('/我要雪票|雪票/isU', $keyword, $matA);
            			preg_match_all('/投票|kol/isU', $keyword, $matB);
                        preg_match_all('/装备节/isU', $keyword, $matC);
						preg_match_all('/验证账号/isU', $keyword, $matD);

            			if (!empty($matA[0])) {
            				$tip = "关注“qunawan_8264”官方微信，并回复“我要雪票+姓名+联系方式”。";
            			} elseif ($matB[0]) {
            				$tip = '欢迎参加2015年度KOL评选大赛，<a href="http://front.qunawan.com/vote_list">投票请点这里</a>';
            			} elseif ($matC[0]) {
            				$tip = '<a href="http://m.8264.com/thread-5301540-1.html">http://m.8264.com/thread-5301540-1.html</a>';
            			} elseif ($matD[0]) {
                            //微信发送验证账号请求 格式( 验证账号:用户名 )
                            $keyword = str_replace(array('：', ' '), array(':', ''), $keyword);
                            $keyword_arr = explode(':', $keyword);
                            $username = diconv(trim($keyword_arr[1]), 'utf-8', 'gbk');
                            $userinfo = DB::fetch_first("SELECT uid, status FROM ".DB::table("common_member")." WHERE username='$username'");
                            if($userinfo['uid'] && $userinfo['status'] > 0) {
                                $userwx = DB::fetch_first("SELECT uid, wechatunionid FROM ".DB::table("common_openid_wechat")." WHERE uid='$userinfo[uid]'");
                                if(!$userwx['wechatunionid']) {
                                    $tip = '请先绑定微信账号，再进行验证';
                                } else {

                                    require_once DISCUZ_ROOT.'openid/openid_model.php';
                                    $openid = new openid;
                                    $access_token = $openid->wechat_token_8264();

                                    //$postObj->FromUserName为OpenID 需用此去查用户unionid
                                    //https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140839
                                    $wxapi = requestRemoteData("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token['wechat_token']."&openid=".$postObj->FromUserName."&lang=zh_CN");
                                    $wxinfo = $wxapi ? json_decode($wxapi, true) : array();
                                    if($userwx['wechatunionid'] == $wxinfo['unionid']) {    //验证的用户是绑定的人 验证成功
                                        DB::query("UPDATE ".DB::table("common_member")." SET status=0 WHERE uid='$userinfo[uid]'");
                                        $tip = '账号已通过验证';
                                    }
                                }
                            } elseif (!$userinfo['uid']) {
                                $tip = '未找到您的账号，请重试。';
                            } elseif ($userinfo['status'] == 0) {
                                $tip = '账号已通过验证';
                            }

                        } else {
                            /*
            				$tip    = "不知道去哪玩？按下面要求回复，查看各类户外旅行线路：\r\n";
                			$tip   .= "回复“1”徒步\r\n";
                			$tip   .= "回复“2”潜水\r\n";
                			$tip   .= "回复“3”登山\r\n";
                			$tip   .= "回复“4”滑雪\r\n";
                			$tip   .= "回复“5”露营\r\n";
                			$tip   .= "回复“6”特价，抢购热销特价线路\r\n";
//                			$tip   .= "回复“7”参加赢取小驴活动\r\n";
                             *
                             */
                            $tip = "输入省份或者玩法，有你想要的活动哦~";
            			}
            			$result = $this->replyText($postObj, $tip);
            		}
                break;
                case 'image':
                case 'location':
                case 'voice':
                case 'video':
                default:
                	$tip 	= '感谢关注8264户外资料网，2015年最火户外旅行交友神器《在外》，点击<a href="http://a.app.qq.com/o/simple.jsp?pkgname=com.bj8264.zaiwai.android">下载在外app</a>进行下载';
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

    //验证信息
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

	//回复文本信息
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

	//回复图文信息
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

//				        	$v['Title'] = '多图文1标题';
//				        	$v['Description'] = '多图文1标题';
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
