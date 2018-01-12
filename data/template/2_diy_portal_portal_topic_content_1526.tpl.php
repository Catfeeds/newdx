<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1526', 'common/header_diy');
block_get('6953,6954,6956,6955,6957,6959,6962,6963,6964,6965');?>
<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title><?php if(!empty($topic['title'])) { ?><?php echo $topic['title'];?> <?php } if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if($_G['setting']['bbname']) { ?><?php echo $_G['setting']['bbname'];?> - <?php } ?></title>
<?php echo $_G['setting']['seohead'];?>

<meta name="keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="generator" content="8264" />
<meta name="author" content="8264.com" />
<meta name="copyright" content="2001-2010" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<base href="<?php echo $_G['siteurl'];?>" />
<script src="http://static.8264.com/oldcms/moban/zt/2014yz/js/jquery-1.9.1.min.js" type="text/javascript" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2014yz/js/jquery.easing.1.3.js" type="text/javascript" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2014yz/js/base.js" type="text/javascript" type="text/javascript"></script><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
 
 	<?php if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?><?php echo $rsshead;?><?php } if($_G['basescript'] == 'forum') { if(!empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
<link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_widthauto.css?<?php echo VERHASH;?>" />
<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
<?php } ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'portal') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_css_diy.css?<?php echo VERHASH;?>" />
<?php } ?>
<link href="http://static.8264.com/oldcms/moban/zt/2014yz/css/base.css" rel="stylesheet" type="text/css">
</head>

<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>   
<!--dx代码结束-->
<!--diy样式开始-->
<style id="diy_style" type="text/css">#frame6DP222 {  margin:0px !important;border:#000000 none !important;background-color:transparent !important;background-image:none !important;}#portal_block_6953 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6953 .content {  margin:0px !important;}#frame2U2Wye {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6954 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6954 .content {  margin:0px !important;}#frame7L3BB4 {  background-color:#ffffff !important;background-image:none !important;margin:0px !important;border:none !important;}#framesSiN4f {  background-color:#ffffff !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6956 {  margin:0px !important;border:none !important;}#portal_block_6956 .content {  margin:0px !important;}#portal_block_6955 {  margin:0px !important;border:none !important;}#portal_block_6955 .content {  margin:0px !important;}#frameqwlbg1 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6957 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6957 .content {  margin:0px !important;}#frameCE2s2f {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6959 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6959 .content {  margin:0px !important;}#frame6OrD9C {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6962 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6962 .content {  margin:0px !important;}#frameC9DwvV {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6963 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6963 .content {  margin:0px !important;}#frameb5sMXm {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6964 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6964 .content {  margin:0px !important;}#frame1kh211 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6965 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6965 .content {  margin:0px !important;}</style>
<!--diy样式结束-->
<div class="banner">
<img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/banner.png" alt="">
</div>
<div id="content" class="yz-masthead">
<div class="container">
<div class="row">
<div class="col-md-1">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>宣传视频</span>
<em>/ Promotional Video</em>
</a>
</div>
<div class="yz-bd video-wrap">
<embed src="http://static.video.qq.com/TPout.swf?vid=u01456bpz7i&amp;auto=0" allowFullScreen="true" quality="high" width="320" height="230" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
</div>
</div>
<div class="col-md-2">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>新闻头条</span>
<em>/ News Headlines</em>
</a>
</div>
<div class="yz-bd hl-news-wrap">
<!--[diy=diyhln]--><div id="diyhln" class="area"><div id="frame6DP222" class=" frame move-span cl frame-1"><div id="frame6DP222_left" class="column frame-1-c"><div id="frame6DP222_left_temp" class="move-span temp"></div><?php block_display('6953'); ?></div></div></div><!--[/diy]-->
</div>
</div>
<div class="col-md-3">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>会展新闻</span>
<em>/ Exhibition News</em>
</a>
</div>
<div class="yz-bd news-link">
<a href="http://www.asian-outdoor.com/exhibit.php?about=1" target="_blank" alt="2014亚洲户外展展会新闻">2014亚洲户外展展会新闻</a>
</div>
</div>
<div class="col-md-3 exbn">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>观展手册</span>
<em>/ Exhibition News</em>
</a>
</div>
<div class="yz-bd exbn-wrap">
<a href="http://www.asian-outdoor.com/audience.php?about=2" target="_blank" alt="日程"><i class="icon icon-1"></i>日程</a>
<a href="http://www.asian-outdoor.com/live.php?about=2" target="_blank" alt="住宿"><i class="icon icon-2"></i>住宿</a>
<a href="http://www.asian-outdoor.com/live.php?about=1" target="_blank" alt="交通"><i class="icon icon-3"></i>交通</a>
<a href="http://www.asian-outdoor.com/audience.php?about=4" target="_blank" alt="注册"><i class="icon icon-4"></i>注册</a>
</div>
</div>
</div>
<div class="row">
<div class="col-md-1">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>活动日程表</span>
<em>/ Events Calendar</em>
</a>
</div>
<div class="yz-bd events-cal">
<ul class="cal-box">
<li class="curr">
<a href="javascript:void(0);">7月23日</a>
</li>
<li>
<a href="javascript:void(0);">7月24日</a>
</li>
<li>
<a href="javascript:void(0);">7月25日</a>
</li>
<li>
<a href="javascript:void(0);">7月26日</a>
</li>
</ul>
<div class="cal-cont">
<div class="yz-info">
<p>时间：09:00~10:00</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：2014亚洲户外展开幕式</p>
<p>时间：10:00~10:40</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：服装秀</p>
<p>时间：10:15~10:30</p>
<p>地点：C厅攀岩区</p>
<p>活动内容：2014亚洲户外展攀石公开赛开幕式</p>
<p>时间：10:50~11:50</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：亚洲户外展、COA、中国户外产业报告发布会</p>
<p>时间：12:30~13:30</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：分享时代的移动营销体验—《山野中国户外》</p>
<p>时间：13:30~14:10</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：服装秀</p>
<p>时间：14:20~15:20</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：休闲潜水产业的商机—中国户外产业与潜水产业协同发展—帕迪潜水五星教练发展中心总经理罗春明</p>
<p>时间：15:30~17:00</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：2014亚洲户外产业大奖颁奖</p>
</div>
<div class="yz-info">
<p>时间：10:00~10:40</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：服装秀</p>
<p>时间：10:50~11:20</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：2014"NORTHLAND诺诗兰杯"三夫户外"量山好汉"紫金山荧光跑新闻发布会</p>
<p>时间：11:00~11:50</p>
<p>地点：二层B02会议室</p>
<p>活动内容：拒绝有毒物质，确保户外产品无毒和功能性—国家纺织品服装服饰产品质量监督检验中心（广州）高级工程师，国内纺织服装行业知名检测与标准化专家饶剑辉</p>
<p>时间：11:20~12:00</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：户外技能培训公开课—绿野</p>
<p>时间：12:00~13:00</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：《遥远的山》全国巡展—亚洲户外展专场</p>
<p>时间：13:00~13:40</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：服装秀</p>
<p>时间：13:00~13:50</p>
<p>地点：二层B02会议室</p>
<p>活动内容：新品市场推广策略——GORE-TEX</p>
<p>时间：14:00~15:30</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：中国跑步产业论坛——权威行业媒体、领军品牌、著名运动员、知名经销商，共议中国跑步产业发展趋势</p>
<p>时间：15:00~15:50</p>
<p>地点：二层B02会议室</p>
<p>活动内容：电商对多品牌户外经销商的积极与消极影响—三夫户外网络销售经理赵孟懿</p>
<p>时间：15:30~16:10</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：服装秀</p>
<p>时间：16:00~16:50</p>
<p>地点：登山在美国—Mountain Hardwear</p>
<p>时间：16:00~18:00</p>
<p>地点：C厅连廊</p>
<p>活动内容：亚洲户外展下午茶及中国户外先锋聚会</p>
<p>时间：16:10~17:00</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：先锋无限一起出发—8264、戈尔、巅峰学校</p>
</div>
<div class="yz-info">
<p>时间：10:00~10:40</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：服装秀 </p>
<p>时间：10:50~11:50</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：现代皮划艇介绍及中国皮划艇发展展望—昆山耀和体育用品有限公司副总经理林权 </p>
<p>时间：11:00~11:45</p>
<p>地点：跑步专区</p>
<p>活动内容：跑步与时尚健康—益跑网 </p>
<p>时间：11:00~11:50</p>
<p>地点：二层B02会议室</p>
<p>活动内容：时尚户外:视觉传达店铺灵魂—弥腾建筑设计咨询（上海）有限公司创意总监Stephen Cowles </p>
<p>时间：13:00~13:40</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：服装秀 </p>
<p>时间：14:00~15:30</p>
<p>地点：二层B02会议室</p>
<p>活动内容：绿野网领队交流会暨六只脚百大卓越户外线路评选启动 </p>
<p>时间：14:30~15:30</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：《遥远的山》全国巡展—亚洲户外展专场 </p>
<p>时间：15:30~16:10</p>
<p>地点：AB登陆厅舞台区</p>
<p>活动内容：服装秀 </p>
<p>时间：17:30~21:30</p>
<p>地点：紫金山</p>
<p>活动内容：2014"NORTHLAND诺诗兰杯"三夫户外"量山好汉"紫金山荧光跑</p>
</div>
<div class="yz-info">
时间：10:00~10:40
地点：AB登陆厅舞台区
活动内容：服装秀 
时间：12:00~13:00
地点：AB登陆厅舞台区
活动内容：服装秀
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>会展动态</span>
<em>/ Exhibition Dynamic</em>
</a>
</div>
<div class="yz-bd exh-dyn-box">
<div class="dyn-pic-box">
<!--[diy=diypiccon]--><div id="diypiccon" class="area"><div id="frame2U2Wye" class=" frame move-span cl frame-1"><div id="frame2U2Wye_left" class="column frame-1-c"><div id="frame2U2Wye_left_temp" class="move-span temp"></div><?php block_display('6954'); ?></div></div></div><!--[/diy]-->
</div>
<div class="dyn-news-list">
<!--[diy=diydynews]--><div id="diydynews" class="area"><div id="framesSiN4f" class=" frame move-span cl frame-1"><div id="framesSiN4f_left" class="column frame-1-c"><div id="framesSiN4f_left_temp" class="move-span temp"></div><?php block_display('6956'); ?></div></div></div><!--[/diy]-->

<!--[diy=diypnewslist]--><div id="diypnewslist" class="area"><div id="frame7L3BB4" class=" frame move-span cl frame-1"><div id="frame7L3BB4_left" class="column frame-1-c"><div id="frame7L3BB4_left_temp" class="move-span temp"></div><?php block_display('6955'); ?></div></div></div><!--[/diy]-->
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>网上展厅</span>
<em>/ Online Showroom</em>
</a>
</div>
<div class="yz-bd online-room">
<ul>
<li><a href="http://static.8264.com/oldcms/moban/zt/2014yz/images/room1_b.jpg" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/room1.jpg" alt=""></a></li>
<li><a href="http://static.8264.com/oldcms/moban/zt/2014yz/images/room2_b.jpg" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/room2.jpg" alt=""></a></li>
<li><a href="http://static.8264.com/oldcms/moban/zt/2014yz/images/room3_b.jpg" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/room3.jpg" alt=""></a></li>
<li><a href="http://static.8264.com/oldcms/moban/zt/2014yz/images/room4_b.jpg" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/room4.jpg" alt=""></a></li>
</ul>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>2014亚洲户外展官方活动</span>
<em>/ Official Activities</em>
</a>
</div>
</div>
<div class="yz-bd ofcl-act">
<ul>
<li>
<div class="pic-box">
<a href="http://www.asian-outdoor.com/activity.php?about=1&id=7" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/Xi1l.jpg" alt=""><span class="title">跑步专区</span></a>
  </div>
<div class="des-con">
<p>时间：7月23日</p>
<p>地点：展会现场A厅</p>
</div>
</li>
<li>
<div class="pic-box">
<a href="http://www.asian-outdoor.com/activity.php?about=1&id=9" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/Xi2l.jpg" alt=""><span class="title">水上用品专区</span></a>
  </div>
<div class="des-con">
<p>时间：7月23日</p>
<p>地点：展会现场A厅</p>
</div>
</li>
<li>
<div class="pic-box">
<a href="http://www.asian-outdoor.com/activity.php?about=1&id=3" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/Xi3l.jpg" alt=""><span class="title">服装秀</span></a>
  </div>
<div class="des-con">
<p>时间：7月23日</p>
<p>地点：展会现场</p>
</div>
</li>
<li>
<div class="pic-box">
<a href="http://www.asian-outdoor.com/activity.php?about=1&id=4" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/Xi4l.jpg" alt=""><span class="title">帐篷区</span></a>
  </div>
<div class="des-con">
<p>时间：全展期</p>
<p>地点：帐篷集中区域</p>
</div>
</li>
<li>
<div class="pic-box">
<a href="http://www.asian-outdoor.com/activity.php?about=1&id=1" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/Xi5l.jpg" alt=""><span class="title">亚洲户外产业大奖</span></a>
  </div>
<div class="des-con">
<p>时间：7月23日</p>
<p>地点：展会现场</p>
</div>
</li>
<li>
<div class="pic-box">
<a href="http://www.asian-outdoor.com/activity.php?about=1&id=2" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/Xi6l.jpg" alt=""><span class="title">亚洲户外产业论坛</span></a>
  </div>
<div class="des-con">
<p>时间：7月23日-7月25日</p>
<p>地点：展会二层会议室</p>
</div>
</li>
</ul>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>2014亚洲户外展8264展位图集</span>
<em>/ Atlas Booth</em>
</a>
</div>
<div class="yz-bd yz-pics">
<img src="http://static.8264.com/oldcms/moban/zt/2014yz/images/t8u2j6i4.png" alt="">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>2014欧洲户外展</span>
<em>/ European Outdoor Exhibition</em>
</a>
</div>
<div class="yz-bd eru-odshow">
<div class="odshow-left">
<!--[diy=diypodshowleft]--><div id="diypodshowleft" class="area"><div id="frameqwlbg1" class=" frame move-span cl frame-1"><div id="frameqwlbg1_left" class="column frame-1-c"><div id="frameqwlbg1_left_temp" class="move-span temp"></div><?php block_display('6957'); ?></div></div></div><!--[/diy]-->
</div>
<div class="odshow-center">
<!--[diy=diypodshowcenter]--><div id="diypodshowcenter" class="area"><div id="frameCE2s2f" class=" frame move-span cl frame-1"><div id="frameCE2s2f_left" class="column frame-1-c"><div id="frameCE2s2f_left_temp" class="move-span temp"></div><?php block_display('6959'); ?></div></div></div><!--[/diy]-->
</div>


<div class="odshow-right">
<!--[diy=diypodshowright]--><div id="diypodshowright" class="area"><div id="frame6OrD9C" class=" frame move-span cl frame-1"><div id="frame6OrD9C_left" class="column frame-1-c"><div id="frame6OrD9C_left_temp" class="move-span temp"></div><?php block_display('6962'); ?></div></div></div><!--[/diy]-->
</div>

</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>2014高端访谈</span>
<em>/ High-end Interview</em>
</a>
</div>
<div class="yz-bd high-inter">
<!--[diy=diyhighinter]--><div id="diyhighinter" class="area"><div id="frameC9DwvV" class=" frame move-span cl frame-1"><div id="frameC9DwvV_left" class="column frame-1-c"><div id="frameC9DwvV_left_temp" class="move-span temp"></div><?php block_display('6963'); ?></div></div></div><!--[/diy]-->
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="yz-hd">
<a href="javascript:void(0);" class="pro-title">
<span>2014亚洲户外展装备新品</span>
<em>/ New Equipment</em>
</a>
</div>
<div class="yz-bd new-equit">
<div class="equit-accrod">
<!--[diy=diypicon]--><div id="diypicon" class="area"><div id="frameb5sMXm" class=" frame move-span cl frame-1"><div id="frameb5sMXm_left" class="column frame-1-c"><div id="frameb5sMXm_left_temp" class="move-span temp"></div><?php block_display('6964'); ?></div></div></div><!--[/diy]-->
</div>
<div class="equit-list">
<!--[diy=diyequitlist]--><div id="diyequitlist" class="area"><div id="frame1kh211" class=" frame move-span cl frame-1"><div id="frame1kh211_left" class="column frame-1-c"><div id="frame1kh211_left_temp" class="move-span temp"></div><?php block_display('6965'); ?></div></div></div><!--[/diy]-->
</div>
</div>
</div>
</div>
<div class="footer">
<div class="layout">
<div class="copyRight">
<p class="pull-right clearfix">
<a target="_blank" href="http://www.8264.com/about-index.html">8264简介</a>|
<a target="_blank" href="http://www.8264.com/about-contact.html">联系我们</a>|
<a target="_blank" href="http://www.8264.com/about-adservice.html">广告服务</a>|
<a target="_blank" href="http://www.8264.com/list/885">户外网址大全</a>|
<a target="_blank" href="http://www.8264.com/sitemap">网站地图</a>
</p>
<p>8264 版权所有 津ICP备05004140号-10   ICP证 津B2-20110106</p>
<p>户外有风险，8264提醒您购买<a style=" color:#2A85E8;" target="_blank" href="http://bx.8264.com">户外保险</a></p>
</div>
</div>
</div>
</div>
</div>
<?php if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb">
<em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?></em>
<span><a href="javascript:;" onClick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="关闭">关闭</a></span>
</h3>
<hr class="l" />
<div class="detail">
<h4><a href="<?php echo $focus['url'];?>" target="_blank"><?php echo $focus['subject'];?></a></h4>
<p>
<?php if($focus['image']) { ?>
<a href="<?php echo $focus['url'];?>" target="_blank"><img src="<?php echo $focus['image'];?>" onload="thumbImg(this, 1)" _width="58" _height="58" /></a>
<?php } ?>
<?php echo $focus['summary'];?>
</p>
</div>
<hr class="l" />
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">查看</a>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; } ?>

<ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>

<?php if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly">
积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分
</div>
<div class="mncr"></div>
</div>
<?php } if(!$_G['setting']['bbclosed']) { if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_G['gp_do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<?php } ?><?php output(); ?><!--dx代码结束-->
</body>
</html>
