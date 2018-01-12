<?php

/**
 * @author JiangHong
 * @copyright 2015
 */
require_once libfile('class/myredis');
/*读取所有推送用户*/
$myredis = myredis::instance(6382);
$allkey = $myredis->keys('plugin_tuisong_user_array_fid_*');
foreach($allkey as $keynameee){
	if(preg_match('/^plugin_tuisong_user_array_fid_(\d+)$/i', $keynameee, $matchesme) == 0){
		continue;
	}
	if(($fid = intval($matchesme[1])) > 0){
		$allusers = $myredis->HGETALL($keynameee);
		$alluid = array_keys($allusers);
		if($alluid){
			$todaytime = strtotime('today');
			$nowtime = time();
			$todayline = array();
			require_once DISCUZ_ROOT . './source/plugin/interests/model/linemod.php';
			$todayline = linemod::getDayLine($todaytime, $pos, $fid);
			if(!empty($todayline)){
				require_once DISCUZ_ROOT . './source/plugin/interests/model/couponmod.php';
				//echo "<pre>" . var_export($todayline, true) . "</pre>";exit;
				foreach($todayline as $_tmplineid => $_tmplineinfo){
					if($_tmplineinfo[linemod::_GOODSID] > 0){
						/*线路的在外id合法*/
						$keyname = "plugin_interests_user_sended_today_{$todaytime}_lineid_{$_tmplineid}";
						$ztemp = $myredis->zRange($keyname, 0, -1, true);
						//$sendmsg = date('m 月 d日', $_tmplineinfo[linemod::_TIME_START]) . " <a target='_blank' href='" . $_G['config']['web']['forum'] . "plugin.php?id=interests:go&goid=" . $_tmplineinfo[linemod::_ID] . "'>" . $_tmplineinfo[linemod::_NAME] . "</a> 开始招募啦，你可以<a target='_blank' href='" . $_G['config']['web']['forum'] . "plugin.php?id=interests:go&goid=" . $_tmplineinfo[linemod::_ID] . "'>去看看</a>。";
						$basearr = array(
								'time' => $_tmplineinfo[linemod::_TIME_START],
								'lineid' => $_tmplineinfo[linemod::_ID],
								'linename' => urlencode($_tmplineinfo[linemod::_NAME])
								);
						if($ztemp){
							foreach($alluid as $_uid){
								if($ztemp['uid_' . $_uid] > 0){
									continue;
								}else{
									/*检测当前线路是否已经发送过优惠券了*/
									$couponid = couponmod::getIfUserCouponSend($_tmplineinfo[linemod::_GOODSID], $_uid);
									$newcouponid = false;
									if(!$couponid){
										/*读取一个优惠券*/
										$couponid = couponmod::getOneCoupon($_tmplineinfo[linemod::_GOODSID]);
										$newcouponid = true;	
									}						
									if($couponid){
										$sendarr = $basearr;
										$sendarr['couponcode'] = $couponid[couponmod::_COUPON_NUMBER];
										$sendarr['couponmoney'] = $couponid[couponmod::_MONEY];
										$sendarr['couponid'] = $couponid[couponmod::_COUPON_ID];
										$sendarr['newcouponid'] = $newcouponid ? 1 : 0;
										$msginfo = json_encode($sendarr);
										if($newcouponid && couponmod::sendtouser($couponid[couponmod::_ID], $_uid) > 0){
											notification_add($_uid, 'zw', $msginfo, array(), 1);
											$myredis->ZADD($keyname, $nowtime, 'uid_' . $_uid);
											$myredis->EXPIRE($keyname, 24 * 3600);
										}else{
											/*此处为已经发送情况，可以做些提醒之类*/
											//notification_add($_uid, 'zw', $msginfo, array(), 1);
										}
									}
									//notification_add($_uid, 'zw_' . $_tmplineid, $sendmsg, array(), 1);
									//$myredis->ZADD($keyname, $nowtime, 'uid_' . $_uid);
								}
							}
						}else{
							foreach($alluid as $_uid){
								/*检测当前线路是否已经发送过优惠券了*/
								$couponid = couponmod::getIfUserCouponSend($_tmplineinfo[linemod::_GOODSID], $_uid);
								$newcouponid = false;
								if(!$couponid){
									/*读取一个优惠券*/
									$newcouponid = true;
									$couponid = couponmod::getOneCoupon($_tmplineinfo[linemod::_GOODSID]);
								}
								if($couponid){
									$sendarr = $basearr;
									$sendarr['couponcode'] = $couponid[couponmod::_COUPON_NUMBER];
									$sendarr['couponmoney'] = $couponid[couponmod::_MONEY];
									$sendarr['couponid'] = $couponid[couponmod::_COUPON_ID];
									$sendarr['newcouponid'] = $newcouponid ? 1 : 0;
									$msginfo = json_encode($sendarr);
									if($newcouponid && couponmod::sendtouser($couponid[couponmod::_ID], $_uid) > 0){
										notification_add($_uid, 'zw', $msginfo, array(), 1);
										$myredis->ZADD($keyname, $nowtime, 'uid_' . $_uid);
										$myredis->EXPIRE($keyname, 24 * 3600);
									}else{
										/*此处为已经发送情况，可以做些提醒之类*/
										//notification_add($_uid, 'zw', $msginfo, array(), 1);
									}
								}
							}
						}
					}
				}
			}
		}
	}
}