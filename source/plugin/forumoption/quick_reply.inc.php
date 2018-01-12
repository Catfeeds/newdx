<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$postdata = array_merge($_GET, $_POST);
$postdata = iconv_array($postdata, 'UTF-8', 'GBK');
extract($postdata);

//点评活动的说明文字 Get到的des_type为以下配置的键 注释中为此广告弹层位置
$des_type = in_array($postdata['des_type'],array(39,135,146,495,88,24)) ? $postdata['des_type'] : 0;
$des_css="<span style='display:inline-block;color:red;'>";
$des_text = array(
	0=> '点评你用过的'.$des_css.'户外装备</span>，优秀点评将能获得'.$des_css.'1枚</span>8264币！重复点评、抄袭或复制一律无效哦！',
	39=> '点评你用过的'.$des_css.'相机</span>或'.$des_css.'镜头</span>，优秀点评将能获得'.$des_css.'1枚</span>8264币！重复点评、抄袭或复制一律无效哦！',	
	135=> '点评你用过的'.$des_css.'攀岩装备</span>，或者其他你熟悉的装备，优秀点评将能获得'.$des_css.'1枚</span>8264币！重复点评、抄袭或复制一律无效哦！',
	146=> '点评你用过的'.$des_css.'炉头、餐具</span>等，或者其他你熟悉的装备，优秀点评将能获得'.$des_css.'1枚</span>8264币！重复点评、抄袭或复制一律无效哦！',
	495=> '点评你用过的'.$des_css.'跑步越野</span>装备，或者其他你熟悉的装备，优秀点评将能获得'.$des_css.'1枚</span>8264币！重复点评、抄袭或复制一律无效哦！',	
	88=> '点评你用过的'.$des_css.'骑行装备</span>，或者其他你熟悉的装备，优秀点评将能获得'.$des_css.'1枚</span>8264币！重复点评、抄袭或复制一律无效哦！',
	24=> '点评你用过的'.$des_css.'徒步攀登装备</span>，或者其他你熟悉的装备，优秀点评将能获得'.$des_css.'1枚</span>8264币！重复点评、抄袭或复制一律无效哦！',
	);

//保存提交数据
if($publishsubmit == 'yes' && $formhash == formhash() && in_array($mod, array("equipment"))) {
	if (!$_G['uid']) {
		exit("登陆后才能进行此操作");
	}
	$starnum = intval($postdata['starnum']);
	$subject = cutstr($postdata['eqname'], 50, '');
	$extdata = dhtmlspecialchars(daddslashes($postdata['extdata']));
	$weakpoint = dhtmlspecialchars(daddslashes($postdata['weakpoint']));
	$goodpoint = dhtmlspecialchars(daddslashes($postdata['goodpoint']));
	$message = dhtmlspecialchars(daddslashes($postdata['message']));
	$reply_origin=intval($postdata['reply_origin']);
	if(empty($starnum) || empty($subject) || empty($extdata) || empty($weakpoint) || empty($goodpoint) || empty($message)) {
		exit("必填数据不全");
	}

	//data1=价格来源, data2=不足, data3=优点, data4=综合
	DB::query("INSERT INTO ".DB::table("plugin_dianping_quick_reply")." (subject, authorid, authorname, starnum, data1, data2, data3, data4, useip, dateline, reply_origin) VALUES('$subject', '$_G[uid]', '$_G[username]', '$starnum', '$extdata', '$weakpoint', '$goodpoint', '$message', '$_G[clientip]', '$_G[timestamp]', '$reply_origin')");
	$result = DB::insert_id() ? '1' : '-2';
	exit($result);
}

//模板限制
if(!in_array($tpl, array("equipment"))) {
	exit("模块错误");
}

include template('forumoption:quick_reply_'.$tpl);
?>
