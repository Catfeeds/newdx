<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1366', 'common/header_diy');
block_get('2496,2495,2497,2508,2663,2669,2664,2651,2667,2655,2668');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php if(!empty($topic['title'])) { ?><?php echo $topic['title'];?><?php } if(!empty($navtitle)) { ?><?php echo $navtitle;?> -<?php } if($_G['setting']['bbname']) { ?><?php echo $_G['setting']['bbname'];?> -<?php } ?></title>
<meta name="Description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="Keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />

<!--[if IE 6]>

<script src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>

<script src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/js/DD_belatedPNG_css.js" type="text/javascript"></script>

<![endif]-->

<!-- diy 开始 -->

<style id="diy_style" type="text/css">#frameS1L8nI {  margin:0px !important;border:0px !important;}#portal_block_2495 {  margin:0px !important;border:0px !important;}#portal_block_2495 .content {  margin:0px !important;}#frameT6ZUUF {  margin:0px !important;border:0px !important;}#portal_block_2496 {  margin:0px !important;border:0px !important;}#portal_block_2496 .content {  margin:0px !important;}#frame9u37Qf {  margin:0px !important;border:0px !important;}#portal_block_2497 {  margin:0px !important;border:0px !important;}#portal_block_2497 .content {  margin:0px !important;}#frameT5vP61 {  margin:0px !important;border:0px !important;}#portal_block_2508 {  margin:0px !important;border:0px !important;}#portal_block_2508 .content {  margin:0px !important;}#frameqvE5SB {  margin:0px !important;}#frame3wyJ94 {  margin:0px !important;}#frame2s13pX {  margin:0px !important;}#frameh4nED9 {  margin:0px !important;}#frame9E47uR {  margin:0px !important;}</style>
<base href="<?php echo $_G['siteurl'];?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<?php if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?>
<?php echo $rsshead;?><?php } if($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') { if($_G['basescript'] == 'forum' && !empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
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

<!-- diy 结束 -->

</head><body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;" style="background: url(http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/bg_y_all.jpg) repeat-y center top;">

<!-- diy 开始 -->

<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>

<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>

<?php } ?>

<div id="append_parent"></div>
<div id="ajaxwaitid"></div>

<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>

<!-- diy 结束 -->

<!-- header_zt start -->

<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011tents_congress/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011tents_congress/css/style_20110720.css"/>
<div id="header_zt">
</div>

<!-- header_zt end -->

<!-- main_zt start -->

<div id="main_zt">
<div class="main_zt_l">
<div id="main_slide">

<!--//hd幻灯//-->

<!--[diy=hd]--><div id="hd" class="area"><div id="frameT6ZUUF" class=" frame move-span cl frame-1"><div id="frameT6ZUUF_left" class="column frame-1-c"><div id="frameT6ZUUF_left_temp" class="move-span temp"></div><?php block_display('2496'); ?></div></div><div id="frame73n8DI" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1框架</span></div><div id="frame73n8DI_left" class="column frame-1-c"><div id="frame73n8DI_left_temp" class="move-span temp"></div></div></div><div id="framewh6Gvs" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1框架</span></div><div id="framewh6Gvs_left" class="column frame-1-c"><div id="framewh6Gvs_left_temp" class="move-span temp"></div></div></div><div id="framec3hwIT" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1框架</span></div><div id="framec3hwIT_left" class="column frame-1-c"><div id="framec3hwIT_left_temp" class="move-span temp"></div></div></div><div id="framerf8u7b" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1框架</span></div><div id="framerf8u7b_left" class="column frame-1-c"><div id="framerf8u7b_left_temp" class="move-span temp"></div></div></div><div id="frameUClHU2" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1框架</span></div><div id="frameUClHU2_left" class="column frame-1-c"><div id="frameUClHU2_left_temp" class="move-span temp"></div></div></div></div><!--[/diy]-->

<!--//hd幻灯//-->

</div>
</div>
<div class="main_zt_c">
<div class="news_c">
<h2>
<a href="http://bbs.8264.com/thread-787548-1-1.html" style="color:#FF0000" target="_blank">8264露营大会各分站火热报名中</a>
</h2>
<p> 2011年6月，8264全国露营大会全面启动。时至今日，已陆续在全国7个省市成功举办，驴友们参与积极，反响强烈。目前全国各分站还在火热报名中，驴友们还在等什么，快来报名吧。 <b>报名链接</b>:
<a href="http://bbs.8264.com/forum-viewthread-tid-1046240-fromuid-34143033.html" class="more" target="_blank"></a>
</p>
<h3>
<a href="http://bbs.8264.com/forum-viewthread-tid-827599-fromuid-34170351.html" target="_blank">2012年8264全国露营大会各地合作伙伴招募中</a>
</h3>
<p>2011年，8264全国露营大会在各地受到驴友们的热情支持与参与。转眼年末，2012年的8264全国露营大会也开始有条不紊的筹备起来了，现诚招各地分站合作伙伴，详情咨询，8264露营大会负责人：阿索 电话：13920440860 </p>
</div>
</div>
<div class="main_zt_r">
<div class="news_r">
<div class="mod_tit">最新资讯</div>
<div class="mod_cont art_275px">

<!--//zzzx常用文章列表样式一ByAndes//-->

<!--[diy=zzzx]--><div id="zzzx" class="area"><div id="frameS1L8nI" class=" frame move-span cl frame-1"><div id="frameS1L8nI_left" class="column frame-1-c"><div id="frameS1L8nI_left_temp" class="move-span temp"></div><?php block_display('2495'); ?></div></div></div><!--[/diy]-->

<!--//zzzx常用文章列表样式一ByAndes//-->

</div>
</div>
</div>
<div class="main_zt_all">
<div class="mod_tit bg2">全国分站</div>
<div class="mod_cont pic_225px">
<div class="pic_box">
<a href="http://bbs.8264.com/thread-793394-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/fenz/1.jpg" ></a>
<p><b>第一站:京津冀站(已结束)</b></p>
<p>时　间：6月18日-19日</p>
<p>地　点：秦皇岛蟠桃峪景区</p>
<p>人　数：501人　
<a href="http://bbs.8264.com/thread-793394-1-1.html" target="_blank" style="color:#0000FF">图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-787309-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/fenz/2.jpg" ></a>
<p><b>第二站:东北站</b></p>
<p>时　间：7月23-24日</p>
<p>地　点：辽宁丹东金沙谷</p>
<p>人　数：312人　
<a href="http://bbs.8264.com/forum-viewthread-tid-827599-fromuid-34170351.html" target="_blank" style="color:#0000FF">图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-813132-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn84.jpg" border="0" ></a>
<p><b>第三站:哈尔滨站</b></p>
<p>时　间：8月13-14日</p>
<p>地　点：哈尔滨冰雪大世界园区</p>
<p>
<a href="http://bbs.8264.com/thread-842743-4-1.html" class="more" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-781549-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn86.jpg" ></a>
<p><b>第四站:贵州站</b></p>
<p>时　间：8月20日-21日</p>
<p>地　点：贵阳市清镇市红枫湖风景区</p>
<p>
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=876382&amp;page=2#pid14357960" class="more" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-795303-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn87.jpg" ></a>
<p><b>第五站:内蒙古站</b></p>
<p>时　间：8月13日-14日</p>
<p>地　点：内蒙古包头希拉穆仁草原景区</p>
<p>
<a href="http://bbs.8264.com/thread-842587-1-1.html" class="more" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-819168-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn88.jpg" ></a>
<p><b>第六站:青岛站</b></p>
<p>时　间：8月6日-7日</p>
<p>地　点：青岛市开发区金沙滩</p>
<p>
<a href="http://bbs.8264.com/thread-961201-1-1.html" class="more" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-817853-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/fenz/7.jpg" ></a>
<p><b>第七站:福建站</b></p>
<p>时　间：8月27日-28日</p>
<p>地　点：福建省福州市潭坛南湾沙滩</p>
<p>
<a href="http://bbs.8264.com/thread-876497-1-1.html" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-819106-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn36.jpg" ></a>
<p><b>第八站:云南站</b></p>
<p>时　间：9月10日-11日</p>
<p>地　点：云南省香格里拉依拉草原景区</p>
<p>
<a href="http://bbs.8264.com/thread-949670-1-1.html" class="more" target="_blank" style="color:#0000FF">图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-825721-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn89.jpg" ></a>
<p><b>第九站:山东济南站</b></p>
<p>时　间：8月6日-7日</p>
<p>地　点：山东省济南长清园博园正门</p>
<p>
<a href="http://bbs.8264.com/thread-838350-1-1.html" class="more" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-830380-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn80.jpg" ></a>
<p><b>第十站:秦皇岛站</b></p>
<p>时　间：9月10日-11日</p>
<p>地　点：河北省济秦皇岛及翡翠岛</p>
<p>
<a href="http://bbs.8264.com/thread-949662-1-1.html" class="more" target="_blank"  style="color:#0000FF">图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-835206-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn85.jpg" ></a>
<p><b>第十一站:宁夏站</b></p>
<p>时　间：8月27日-28日</p>
<p>地　点：宁夏 黄沙古渡</p>
<p>
<a href="http://bbs.8264.com/thread-876459-1-1.html" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-842051-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn90.jpg" ></a>
<p><b>第十二站:新疆站</b></p>
<p>时　间：9月8日-10日</p>
<p>地　点：新疆哈密</p>
<p>
<a href="http://bbs.8264.com/thread-949665-1-1.html" class="more" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-848710-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn81.jpg" ></a>
<p><b>第十三站:青岛崂山站</b></p>
<p>时　间：9月17日-18日</p>
<p>地　点：新青岛崂山流清河海滩</p>
<p>
<a href="http://bbs.8264.com/thread-961201-1-1.html" class="more" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-1023818-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn91.jpg" ></a>
<p><b>第十四站:湖南湘西站</b></p>
<p>时　间：10月29日-30日</p>
<p>地　点：湖南湘西龙山县里耶镇及八面山风景区</p>
<p>
<a href="http://bbs.8264.com/thread-1023818-1-1.html" class="more" target="_blank" style="color:#00F">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-890779-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn75.jpg" ></a>
<p><b>第十五站:山东枣庄站</b></p>
<p>时　间：9月17日-18日</p>
<p>地　点：山东省枣庄市峄城区冠世榴园景区</p>
<p>
<a href="http://bbs.8264.com/thread-890779-15-1.html" class="more" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-957273-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/fenz/16.jpg" ></a>
<p><b>第十六站:河南信阳站</b></p>
<p>时　间：9月24日-25日</p>
<p>地　点：信阳市罗山县灵山风景区</p>
<p>
<a href="http://bbs.8264.com/thread-974716-1-1.html" class="more" target="_blank" style="color:#0000FF">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-1050803-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn107.jpg" ></a>
<p><b>第十七站:湖北武汉站</b></p>
<p>时　间：11月19日-20日</p>
<p>地　点：武汉市黄陂区木兰天池风景区</p>
<p>
<a href="http://bbs.8264.com/thread-1050803-1-1.html" class="more" target="_blank" style="color:#00F">点击查看现场图集</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-1057408-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn124.jpg" ></a>
<p><b>第十八站:贵州站</b></p>
<p>时　间：11月26日-27日</p>
<p>地　点：贵州.龙里.龙架山国家森林公园</p>
<p>
<a href="http://bbs.8264.com/thread-1057408-1-1.html" class="more" target="_blank" style="color:#00F">点击查看现场图集</a>
</p>
</div>
<div class="clear"></div>
</div>
</div>
<div class="main_zt_all">
<div class="mod_tit bg1" id="tab_box">
<div class="sheqian2">
<span class="tit">分站图集</span>
<div class="tib_l" id="roll_button_left"></div>
<div class="tic">
<div id="roll" style="width:783px;height:35px;padding-left:5px;overflow:hidden; position:relative;">
<div id="roll_inner" style="overflow:hidden;">
<a href="javascript:void(0)" class="tab old_zhan" id="s1">京津冀站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s2">东北站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s3">哈尔滨站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s4">贵州站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s5">内蒙古站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s6">青岛站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s7">福建站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s8">云南站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s9">济南站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s10">秦皇岛站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s11">宁夏站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s12">新疆站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s13">崂山站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s14">湖南站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s15">枣庄站</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s16">信阳站</a>
<a href="javascript:void(0)" class="tab active" id="s17">湖北站</a>
<a href="javascript:void(0)" class="tab" id="s18">贵州站</a>
</div>
</div>
</div>
<div class="tib_r" id="roll_button_right"></div>
<div style="clear:both;"></div>
<script src="http://www.8264.com/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

jQuery.noConflict();

;(function($){



var button_num = $('#roll a').length;

var button_width = 87;



if (button_num > 9) {

$('#roll_inner').css({width: button_width*button_num+"px"});



$('#roll_button_left').click(function(){

$('#roll').stop(1,1);

var scroll_left = $('#roll').scrollLeft() - button_width;

$('#roll').animate({

scrollLeft: scroll_left+"px"

}, 500)

});



$('#roll_button_right').click(function(){

$('#roll').stop(1,1);

var scroll_left = $('#roll').scrollLeft() + button_width;

$('#roll').animate({

scrollLeft: scroll_left+"px"

}, 500)

});

}

$('#roll').scrollLeft(button_width * 5);

})(jQuery);

</script>
</div>
</div>
<div class="sheqianbody">
<div class="mod_cont pic_165px neirong" id="sq-s1">

<!--//fzpic常用图片列表样式一ByAndes//-->

<!--[diy=fzpic]--><div id="fzpic" class="area"><div id="frame9u37Qf" class=" frame move-span cl frame-1"><div id="frame9u37Qf_left" class="column frame-1-c"><div id="frame9u37Qf_left_temp" class="move-span temp"></div><?php block_display('2497'); ?></div></div></div><!--[/diy]-->

<!--//fzpic常用图片列表样式一ByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s2">

<!--//fzpic2常用图片列表样式一ByAndes//-->

<!--[diy=fzpic2]--><div id="fzpic2" class="area"><div id="frameT5vP61" class=" frame move-span cl frame-1"><div id="frameT5vP61_left" class="column frame-1-c"><div id="frameT5vP61_left_temp" class="move-span temp"></div><?php block_display('2508'); ?></div></div></div><!--[/diy]-->

<!--//fzpic2常用图片列表样式一ByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s3">

<!--//fzpic3常用图片列表样式一ByAndes//-->

<!--[diy=fzpic3]--><div id="fzpic3" class="area"><div id="frame3wyJ94" class=" frame move-span cl frame-1"><div id="frame3wyJ94_left" class="column frame-1-c"><div id="frame3wyJ94_left_temp" class="move-span temp"></div><?php block_display('2663'); ?></div></div></div><!--[/diy]-->

<!--//fzpic3常用图片列表样式一ByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s4">

<!--//fzpic4常用图片列表样式一ByAndes//-->

<!--[diy=fzpic4]--><div id="fzpic4" class="area"><div id="frame9E47uR" class=" frame move-span cl frame-1"><div id="frame9E47uR_left" class="column frame-1-c"><div id="frame9E47uR_left_temp" class="move-span temp"></div><?php block_display('2669'); ?></div></div></div><!--[/diy]-->

<!--//fzpic4常用图片列表样式一ByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s5">

<!--//fzpic5常用图片列表样式一ByAndes//-->

<!--[diy=fzpic5]--><div id="fzpic5" class="area"><div id="frame53p5er" class="frame move-span cl frame-1"><div id="frame53p5er_left" class="column frame-1-c"><div id="frame53p5er_left_temp" class="move-span temp"></div><?php block_display('2664'); ?></div></div></div><!--[/diy]-->

<!--//fzpic5常用图片列表样式一ByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s6">

<!--//fzpic6常用图片列表样式一ByAndes//-->

<!--[diy=fzpic6]--><div id="fzpic6" class="area"><div id="frameP2Q2EC" class="frame move-span cl frame-1"><div id="frameP2Q2EC_left" class="column frame-1-c"><div id="frameP2Q2EC_left_temp" class="move-span temp"></div><?php block_display('2651'); ?></div></div></div><!--[/diy]-->

<!--//fzpic6常用图片列表样式一ByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s7">

<!--//fzpic7常用图片列表样式一ByAndes//-->

<!--[diy=fzpic7]--><div id="fzpic7" class="area"><div id="frame2s13pX" class=" frame move-span cl frame-1"><div id="frame2s13pX_left" class="column frame-1-c"><div id="frame2s13pX_left_temp" class="move-span temp"></div><?php block_display('2667'); ?></div></div></div><!--[/diy]-->

<!--//fzpic7常用图片列表样式一ByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s8">

<!-- 报名期间代码开始 上线请删除此区间代码 -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-949670-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn1.jpg" alt="云南露营大会全满成功" /></a>
<a href="http://bbs.8264.com/forum-viewthread-tid-949670-fromuid-34626185.html" target="_blank" class="text">云南露营大会全满成功</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14652404-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn2.jpg" alt="热情的驴友们接受着欢乐" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14652404-fromuid-34626185.html" target="_blank" class="text">热情的驴友们接受着欢乐</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14652420-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn3.jpg" alt="具有民族特色的大帐" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14652420-fromuid-34626185.html" target="_blank" class="text">具有民族特色的大帐</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14668007-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn4.jpg" alt="露营在辽阔的草原一角" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14668007-fromuid-34626185.html" target="_blank" class="text">露营在辽阔的草原一角</a>

</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14668069-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn5.jpg" alt="当地的驴友们用歌声来迎接" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14668069-fromuid-34626185.html" target="_blank" class="text">当地的驴友们用歌声来迎接</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14670748-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn6.jpg" alt="云南驴友大本营" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14670748-fromuid-34626185.html" target="_blank" class="text">云南驴友大本营</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14670985-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn7.jpg" alt="驴友们享受着美食与歌声" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14670985-fromuid-34626185.html" target="_blank" class="text">驴友们享受着美食与歌声</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14671544-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn8.jpg" alt="依拉草原欢迎8264的驴友们" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14671544-fromuid-34626185.html" target="_blank" class="text">依拉草原欢迎8264的驴友们</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14671870-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn9.jpg" alt="草原上的"彩色"" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14671870-fromuid-34626185.html" target="_blank" class="text">草原上的“彩色”</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14676154-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn10.jpg" alt="活动的在热闹中进行" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14676154-fromuid-34626185.html" target="_blank" class="text">活动的在热闹中进行</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14676230-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn11.jpg" alt="乐疯的游戏项目" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14676230-fromuid-34626185.html" target="_blank" class="text">乐疯的游戏项目</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14690336-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn12.jpg" alt="依拉草原的美景" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14690336-fromuid-34626185.html" target="_blank" class="text">依拉草原的美景</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14690498-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn13.jpg" alt="露营大会驴友的力量" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14690498-fromuid-34626185.html" target="_blank" class="text">露营大会驴友的力量</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14691174-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn14.jpg" alt="活动的场面延续着" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14691174-fromuid-34626185.html" target="_blank" class="text">活动的场面延续着</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14692553-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn15.jpg" alt="齐声祝贺露营大会" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14692553-fromuid-34626185.html" target="_blank" class="text">齐声祝贺露营大会</a>
</div>

<!-- 报名期间代码结束 上线请删除此区间代码 -->

<div style="display:none">

<!--//fzpic8常用图片列表样式一ByAndes//-->

<!--[diy=fzpic8]--><div id="fzpic8" class="area"></div><!--[/diy]-->

<!--//fzpic8常用图片列表样式一ByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s9">

<!--//fzpic9常用图片列表样式一ByAndes//-->

<!--[diy=fzpic9]--><div id="fzpic9" class="area"><div id="frameqvE5SB" class=" frame move-span cl frame-1"><div id="frameqvE5SB_left" class="column frame-1-c"><div id="frameqvE5SB_left_temp" class="move-span temp"></div><?php block_display('2655'); ?></div></div></div><!--[/diy]-->

<!--//fzpic9常用图片列表样式一ByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s10">

<!-- 报名期间代码开始 上线请删除此区间代码 -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644226-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn16.jpg" alt="露营大会的现场景象" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644226-fromuid-34626185.html" target="_blank" class="text">露营大会的现场景象</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644903-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn17.jpg" alt="8264露营大会忠实粉丝" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644903-fromuid-34626185.html" target="_blank" class="text">8264露营大会忠实粉丝</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644927-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn18.jpg" alt="活动比赛热身中" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644927-fromuid-34626185.html" target="_blank" class="text">活动比赛热身中</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645052-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn19.jpg" alt="8264赞助沙滩跑比赛" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645052-fromuid-34626185.html" target="_blank" class="text">8264赞助沙滩跑比赛</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645094-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn20.jpg" alt="也让狗狗感受户外的力量" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645094-fromuid-34626185.html" target="_blank" class="text">也让狗狗感受户外的力量</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645108-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn21.jpg" alt="为驴友们颁奖" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645108-fromuid-34626185.html" target="_blank" class="text">为驴友们颁奖</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645173-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn22.jpg" alt="8264标志性的大旗" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645173-fromuid-34626185.html" target="_blank" class="text">8264标志性的大旗</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645287-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn23.jpg" alt="翡翠岛的壮观营地" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645287-fromuid-34626185.html" target="_blank" class="text">翡翠岛的壮观营地</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645502-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn24.jpg" alt="驴友们纷纷留下签名纪念" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645502-fromuid-34626185.html" target="_blank" class="text">驴友们纷纷留下签名纪念</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645582-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn25.jpg" alt="接收8264礼品的美女们" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645582-fromuid-34626185.html" target="_blank" class="text">接收8264礼品的美女们</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645920-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn26.jpg" alt="露营晚会共同欢乐" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645920-fromuid-34626185.html" target="_blank" class="text">露营晚会共同欢乐</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646163-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn27.jpg" alt="驴友们早起看日出" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646163-fromuid-34626185.html" target="_blank" class="text">驴友们早起看日出</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646203-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn28.jpg" alt="同聚8264" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646203-fromuid-34626185.html" target="_blank" class="text">同聚8264</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14647854-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn29.jpg" alt="蓝天救援队参加露营大会" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14647854-fromuid-34626185.html" target="_blank" class="text">蓝天救援队参加露营大会</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653398-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn30.jpg" alt="激情的比赛开始" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653398-fromuid-34626185.html" target="_blank" class="text">激情的比赛开始</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14647944-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn31.jpg" alt="享受着美食的驴友" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14647944-fromuid-34626185.html" target="_blank" class="text">享受着美食的驴友</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653579-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn32.jpg" alt="外国美女参加露营大会" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653579-fromuid-34626185.html" target="_blank" class="text">外国美女参加露营大会</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653593-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn33.jpg" alt="缤纷色彩的帐篷" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653593-fromuid-34626185.html" target="_blank" class="text">缤纷色彩的帐篷</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645999-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn34.jpg" alt="送给外国有人8264每日一图" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645999-fromuid-34626185.html" target="_blank" class="text">送给外国有人8264每日一图</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646163-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn35.jpg" alt="清晨宁静的沙滩" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646163-fromuid-34626185.html" target="_blank" class="text">清晨宁静的沙滩</a>
</div>

<!-- 报名期间代码结束 上线请删除此区间代码 -->

<div style="display:none">

<!--//fzpic10常用图片列表样式一ByAndes//-->

<!--[diy=fzpic10]--><div id="fzpic10" class="area"></div><!--[/diy]-->

<!--//fzpic10常用图片列表样式一ByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s11">

<!-- 报名期间代码结束 上线请删除此区间代码 -->

<!--//fzpic11常用图片列表样式一ByAndes//-->

<!--[diy=fzpic11]--><div id="fzpic11" class="area"><div id="frameh4nED9" class=" frame move-span cl frame-1"><div id="frameh4nED9_left" class="column frame-1-c"><div id="frameh4nED9_left_temp" class="move-span temp"></div><?php block_display('2668'); ?></div></div></div><!--[/diy]-->

<!--//fzpic11常用图片列表样式一ByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s12">

<!-- 报名期间代码开始 上线请删除此区间代码 -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn37.jpg" alt="独显8264大旗" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="text">独显8264大旗</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn38.jpg" alt="露营大会进行中" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="text">露营大会进行中</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893924-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn39.jpg" alt="壮观的开幕式" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893924-fromuid-34626185.html" target="_blank" class="text">壮观的开幕式</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893936-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn40.jpg" alt="武僧的惊人表演" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893936-fromuid-34626185.html" target="_blank" class="text">武僧的惊人表演</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893945-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn41.jpg" alt="少数民族的热情自愿者" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893945-fromuid-34626185.html" target="_blank" class="text">少数民族的热情自愿者</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn42.jpg" alt="月下的美丽景色" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="text">月下的美丽景色</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893928-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn43.jpg" alt="欢乐的小驴" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893928-fromuid-34626185.html" target="_blank" class="text">欢乐的小驴</a>
</div>

<!-- 报名期间代码结束 上线请删除此区间代码 -->

<div style="display:none">

<!--//fzpic12常用图片列表样式一ByAndes//-->

<!--[diy=fzpic12]--><div id="fzpic12" class="area"></div><!--[/diy]-->

<!--//fzpic12常用图片列表样式一ByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s13">

<!-- 报名期间代码开始 上线请删除此区间代码 -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14747901-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn46.jpg" alt="露营大会全景" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14747901-fromuid-34626185.html" target="_blank" class="text">露营大会全景</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14747935-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn47.jpg" alt="场面热闹非凡" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14747935-fromuid-34626185.html" target="_blank" class="text">场面热闹非凡</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748009-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn48.jpg" alt="驴友们陆续的进行" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748009-fromuid-34626185.html" target="_blank" class="text">驴友们陆续的进行</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748097-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn49.jpg" alt="享受着海风的热情" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748097-fromuid-34626185.html" target="_blank" class="text">享受着海风的热情</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748119-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn50.jpg" alt="8264大旗带领驴友晨跑" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748119-fromuid-34626185.html" target="_blank" class="text">8264大旗带领驴友晨跑</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748154-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn51.jpg" alt="大会开幕式" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748154-fromuid-34626185.html" target="_blank" class="text">大会开幕式</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748220-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn52.jpg" alt="全国驴友合影" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748220-fromuid-34626185.html" target="_blank" class="text">全国驴友合影</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755105-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn53.jpg" alt="夜色下的露营更迷人" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755105-fromuid-34626185.html" target="_blank" class="text">夜色下的露营更迷人</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755124-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn54.jpg" alt="余晖下色彩斑斓的帐篷" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755124-fromuid-34626185.html" target="_blank" class="text">余晖下色彩斑斓的帐篷</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755148-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn55.jpg" alt="艳丽的长"龙"" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755148-fromuid-34626185.html" target="_blank" class="text">艳丽的长“龙”</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14766543-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn56.jpg" alt="热闹非凡" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14766543-fromuid-34626185.html" target="_blank" class="text">热闹非凡</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14767998-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn57.jpg" alt="驴友们享受着美食" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14767998-fromuid-34626185.html" target="_blank" class="text">驴友们享受着美食</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14768033-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn58.jpg" alt="全家欢乐融融" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14768033-fromuid-34626185.html" target="_blank" class="text">全家欢乐融融</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14768087-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn59.jpg" alt="同庆8264举办露营大会" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14768087-fromuid-34626185.html" target="_blank" class="text">同庆8264举办露营大会</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961195-pid-14771657-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn82.jpg" alt="拔河比赛也很激情啊" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961195-pid-14771657-fromuid-34626185.html" target="_blank" class="text">拔河比赛也很激情啊</a>
</div>

<!-- 报名期间代码结束 上线请删除此区间代码 -->

<div style="display:none">

<!--//fzpic13常用图片列表样式一ByAndes//-->

<!--[diy=fzpic13]--><div id="fzpic13" class="area"></div><!--[/diy]-->

<!--//fzpic13常用图片列表样式一ByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s14">

<!-- 报名期间代码开始 上线请删除此区间代码 -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453281-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn92.jpg" alt="驴友们陆续扎营" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453281-fromuid-34626185.html" target="_blank" class="text">驴友们陆续扎营</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453364-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn93.jpg" alt="参加比赛的驴友们" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453364-fromuid-34626185.html" target="_blank" class="text">参加比赛的驴友们</a><a href="http://www.sunrisetj.com" title="天津进口车"></a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453376-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn94.jpg" alt="晚会现场舞台" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453376-fromuid-34626185.html" target="_blank" class="text">晚会现场舞台</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454040-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn95.jpg" alt="浩浩荡荡的车队" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454040-fromuid-34626185.html" target="_blank" class="text">浩浩荡荡的车队</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454137-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn96.jpg" alt="负重15公里爬山比赛" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454137-fromuid-34626185.html" target="_blank" class="text">负重15公里爬山比赛</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454246-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn97.jpg" alt="出发了加油！" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454246-fromuid-34626185.html" target="_blank" class="text">出发了加油！</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454246-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn98.jpg" alt="幸福像花一样的驴友们" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454246-fromuid-34626185.html" target="_blank" class="text">幸福像花一样的驴友们</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454405-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn99.jpg" alt="美女裁判员们" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454405-fromuid-34626185.html" target="_blank" class="text">美女裁判员们</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454405-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn100.jpg" alt="爬山 签到 快乐着" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454405-fromuid-34626185.html" target="_blank" class="text">爬山 签到 快乐着</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15456907-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn101.jpg" alt="温暖红茶"加油站"" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15456907-fromuid-34626185.html" target="_blank" class="text">温暖红茶“加油站”</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15457820-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn102.jpg" alt="壮观的场面" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15457820-fromuid-34626185.html" target="_blank" class="text">壮观的场面</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15457918-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn103.jpg" alt="

晨光中的帐蓬" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15457918-fromuid-34626185.html" target="_blank" class="text"> 晨光中的帐蓬</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465533-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn104.jpg" alt="和谐就业的贺词" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465533-fromuid-34626185.html" target="_blank" class="text">和谐就业的贺词</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465645-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn105.jpg" alt="活动现场" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465645-fromuid-34626185.html" target="_blank" class="text">活动现场</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465905-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn106.jpg" alt="全家福哈！" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465905-fromuid-34626185.html" target="_blank" class="text">全家福哈！</a>
</div>

<!-- 报名期间代码结束 上线请删除此区间代码 -->

<div style="display:none">

<!--//fzpic14常用图片列表样式一ByAndes//-->

<!--[diy=fzpic14]--><div id="fzpic14" class="area"></div><!--[/diy]-->

<!--//fzpic14常用图片列表样式一ByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s15">

<!-- 报名期间代码开始 上线请删除此区间代码 -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14779553-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn73.jpg" alt="活动在雨中进行着" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14779553-fromuid-34626185.html" target="_blank" class="text">活动在雨中进行着</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14779885-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn74.jpg" alt="雨中的帐篷搭建比赛" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14779885-fromuid-34626185.html" target="_blank" class="text">雨中的帐篷搭建比赛</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818453-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn76.jpg" alt="驴友们依然热情的进行着" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818453-fromuid-34626185.html" target="_blank" class="text">驴友们依然热情的进行着</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818123-fromuid-34626185.html" target="_blank" class="pic"><img src="images/jiangpin/yn77.jpg" alt="露营大会开幕式" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818123-fromuid-34626185.html" target="_blank" class="text">露营大会开幕式</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818259-fromuid-34626185.html" target="_blank" class="pic"><img src="images/jiangpin/yn78.jpg" alt="驴友们留下了自己的名字" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818259-fromuid-34626185.html" target="_blank" class="text">驴友们留下了自己的名字</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818411-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn79.jpg" alt="台儿庄古城以喜剧来表达" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818411-fromuid-34626185.html" target="_blank" class="text">台儿庄古城以喜剧来表达</a>
</div>

<!-- 报名期间代码结束 上线请删除此区间代码 -->

<div style="display:none">

<!--//fzpic14常用图片列表样式一ByAndes//-->

<!--[diy=fzpic14]--><div id="fzpic14" class="area"></div><!--[/diy]-->

<!--//fzpic14常用图片列表样式一ByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s16">

<!-- 报名期间代码开始 上线请删除此区间代码 -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931658-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn60.jpg" alt="8264最给力的帐篷" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931658-fromuid-34626185.html" target="_blank" class="text">8264最给力的帐篷</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=974716&amp;page=2#pid14931765" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn61.jpg" alt="驴友们雨中的笑脸" /></a>
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=974716&amp;page=2#pid14931765" target="_blank" class="text">驴友们雨中的笑脸</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=974716&amp;page=2#pid14931779" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn62.jpg" alt="现场的活动" /></a>
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=974716&amp;page=2#pid14931779" target="_blank" class="text">现场的活动</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931886-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn63.jpg" alt="七彩场虹" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931886-fromuid-34626185.html" target="_blank" class="text">七彩场虹</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931894-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn64.jpg" alt="气魄场景" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931894-fromuid-34626185.html" target="_blank" class="text">气魄场景</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932071-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn65.jpg" alt="露营大会开幕式" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932071-fromuid-34626185.html" target="_blank" class="text">露营大会开幕式</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932095-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn66.jpg" alt="夜色下的景色" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932095-fromuid-34626185.html" target="_blank" class="text">夜色下的景色</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934260-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn67.jpg" alt="记者的现场报道" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934260-fromuid-34626185.html" target="_blank" class="text">记者的现场报道</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934397-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn68.jpg" alt="现场仪式" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934397-fromuid-34626185.html" target="_blank" class="text">现场仪式</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934448-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn69.jpg" alt="给驴友们办法奖品" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934448-fromuid-34626185.html" target="_blank" class="text">给驴友们办法奖品</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923754-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn70.jpg" alt="雨中的露营更美丽" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923754-fromuid-34626185.html" target="_blank" class="text">雨中的露营更美丽</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923771-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn71.jpg" alt="各地驴友汇聚一堂" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923771-fromuid-34626185.html" target="_blank" class="text">各地驴友汇聚一堂</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923997-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn72.jpg" alt="驴友们共喝晚会" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923997-fromuid-34626185.html" target="_blank" class="text">驴友们共喝晚会</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932095-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn66.jpg" alt="夜色下的景色" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932095-fromuid-34626185.html" target="_blank" class="text">夜色下的景色</a>
</div>

<!-- 报名期间代码结束 上线请删除此区间代码 -->

<div style="display:none">

<!--//fzpic16常用图片列表样式一ByAndes//-->

<!--[diy=fzpic16]--><div id="fzpic16" class="area"></div><!--[/diy]-->

<!--//fzpic16常用图片列表样式一ByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong active" id="sq-s17">

<!-- 报名期间代码开始 上线请删除此区间代码 -->
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-1050803-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn108.jpg" alt="祝福语，大会成功" /></a>
<a href="http://bbs.8264.com/forum-viewthread-tid-1050803-fromuid-34626185.html" target="_blank" class="text">祝福语，大会成功</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15798910-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn109.jpg" alt="志愿者家属报个到" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15798910-fromuid-34626185.html" target="_blank" class="text">志愿者家属报个到</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15800322-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn110.jpg" alt="清晨驴友们一起瑜伽" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15800322-fromuid-34626185.html" target="_blank" class="text">清晨驴友们一起瑜伽</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15805221-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn111.jpg" alt="大旗围绕这帐篷" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15805221-fromuid-34626185.html" target="_blank" class="text">大旗围绕这帐篷</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807355-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn112.jpg" alt=""画"中的户外" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807355-fromuid-34626185.html" target="_blank" class="text">“画”中的户外</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807492-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn113.jpg" alt="木兰草原露营场地" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807492-fromuid-34626185.html" target="_blank" class="text">木兰草原露营场地</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807559-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn114.jpg" alt="8264霸气刀旗" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807559-fromuid-34626185.html" target="_blank" class="text">8264霸气刀旗</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807635-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn115.jpg" alt="老余的歌声" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807635-fromuid-34626185.html" target="_blank" class="text">老余的歌声</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807635-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn116.jpg" alt="DJ手让现场气氛达到高潮" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807635-fromuid-34626185.html" target="_blank" class="text">DJ手让现场气氛达到高潮</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807665-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn117.jpg" alt="开心的驴友们" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807665-fromuid-34626185.html" target="_blank" class="text">开心的驴友们</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807962-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn118.jpg" alt="营地游戏中" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807962-fromuid-34626185.html" target="_blank" class="text">营地游戏中</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807962-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn119.jpg" alt="晚会进行中" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807962-fromuid-34626185.html" target="_blank" class="text">晚会进行中</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15808425-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn120.jpg" alt="迎来了第一缕晨光" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15808425-fromuid-34626185.html" target="_blank" class="text">迎来了第一缕晨光</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15833527-fromuid-34626185.htmlt" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn121.jpg" alt="在户外只有开心..." /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15833527-fromuid-34626185.html" target="_blank" class="text">在户外只有开心...</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15833704-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn122.jpg" alt="真人CS于露营融合喽！" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15833704-fromuid-34626185.html" target="_blank" class="text">真人CS于露营融合喽！</a>
</div>

<!-- 报名期间代码结束 上线请删除此区间代码 -->

<div style="display:none">

<!--//fzpic14常用图片列表样式一ByAndes//-->

<!--[diy=fzpic14]--><div id="fzpic14" class="area"></div><!--[/diy]-->

<!--//fzpic14常用图片列表样式一ByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s18">

<!-- 报名期间代码开始 上线请删除此区间代码 -->
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-1057408-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn125.jpg" alt="晚会现场" /></a>
<a href="http://bbs.8264.com/forum-viewthread-tid-1057408-fromuid-34626185.html" target="_blank" class="text">晚会现场</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899337-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn126.jpg" alt="大会报到处" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899337-fromuid-34626185.html" target="_blank" class="text">大会报到处</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899373-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn127.jpg" alt="露营大会活动现场" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899373-fromuid-34626185.html" target="_blank" class="text">露营大会活动现场</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899373-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn128.jpg" alt="音乐会的准备" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899373-fromuid-34626185.html" target="_blank" class="text">音乐会的准备</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899381-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn129.jpg" alt="参加美食的驴友们" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899381-fromuid-34626185.html" target="_blank" class="text">参加美食的驴友们</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn130.jpg" alt="具有特色的现场灯光" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="text">具有特色的现场灯光</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn131.jpg" alt="乐队的完美表演" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="text">乐队的完美表演</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899424-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn132.jpg" alt="民族特色的手鼓表演" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899424-fromuid-34626185.htmll" target="_blank" class="text">民族特色的手鼓表演</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899438-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn133.jpg" alt="晚会的抽奖环节" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899438-fromuid-34626185.html" target="_blank" class="text">晚会的抽奖环节</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899445-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn134.jpg" alt="小驴友们也参与其中" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899445-fromuid-34626185.html" target="_blank" class="text">小驴友们也参与其中</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899460-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn135.jpg" alt="激情四起的夜晚" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899460-fromuid-34626185.html" target="_blank" class="text">激情四起的夜晚</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899460-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn136.jpg" alt="欢快的驴友们" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899460-fromuid-34626185.html" target="_blank" class="text">欢快的驴友们</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15909919-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn137.jpg" alt="亦驴亦演大合奏" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15909919-fromuid-34626185.html" target="_blank" class="text">亦驴亦演大合奏</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15909919-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn138.jpg" alt="活动现场人头涌动" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15909919-fromuid-34626185.html" target="_blank" class="text">活动现场人头涌动</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn139.jpg" alt="《国王与狗》石头的风范" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="text">《国王与狗》石头的风范</a>
</div>
<!-- 报名期间代码结束 上线请删除此区间代码 -->

<div style="display:none">

<!--//fzpic14常用图片列表样式一ByAndes//-->

<!--[diy=fzpic14]--><div id="fzpic14" class="area"></div><!--[/diy]-->

<!--//fzpic14常用图片列表样式一ByAndes//-->

</div>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
<div class="main_zt_all">
<div class="mod_tit bg2">全年合作伙伴<span class="tit_textad">合作洽谈：阿索	电话：13920440860</span></div>
<div class="support pic_100px">
<a href="http://www.kailas.com.cn" target="_blank" class="pic"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/03/032f60fc2b41b046508fe6884d8acbaf.jpg" title="KAILAS（凯乐石）户外装备" /></a>
<a href="http://www.jack-wolfskin.com/" target="_blank" class="pic"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/a5/a574a5c82bb4d07176a5d972803653a9.jpg" title="JACK WOLFSKIN（狼爪） 户外装备" /></a>
<a href="http://www.ten-thirty.com" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/tenthirty.jpg" title="Ten-Thirty手表" /></a>
<a href="http://www.ruggear.net" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/langjie.jpg" title="朗界户外三防手机" /></a>
<a href="http://www.xmjoin-tech.com" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/zhenyi.jpg" title="BOTOO户外三防手机" /></a>
<a href="http://www.robinsonoutdoor.cn" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/robinson.jpg" title="鲁滨逊手杖" /></a>
<a href="http://www.highrock.com.cn" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/highrock.jpg" title="天石羽绒" /></a>
<a href="http://www.cnbulin.com/index1.asp" target="_blank" class="pic"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/d8/d8182a14187f0c477c874b086cde5b3c.jpg" title="勇敢者炊具" /></a>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
</div>

<!-- main_zt end -->

<!-- footer_zt start -->

<div class="clear"></div>
<script src="http://www.8264.com/template/8264/js/common.js" type="text/javascript" type="text/javascript"></script>
<div id="footer_zt">
<p class="top_m">
<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264简介</a>
|
<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank">广告服务</a>
|
<a href="http://www.8264.com/list/531/" target="_blank">编辑部的故事</a>
|
<a href="http://www.8264.com/template/8264/about/sitemap.html" target="_blank">站点地图</a>
|
<a href="http://www.8264.com/zhuanti" target="_blank">户外热点</a>
|
<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">联系方式</a>
|
<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank">QQ群联盟</a>
|
<a href="http://8.8264.com/job/" target="_blank">8264招聘</a>
|
<a href="http://www.8264.com/link/" target="_blank">友情链接</a>
</p>
<p> 服务热线：022-23708264 | 传真：022-23708264 | 地址：天津市华苑产业园区鑫茂民营科技园C2座6层AB单元</p>
<p>
<a href="http://bx.8264.com" target="_blank">户外活动有风险，8264提醒您购买</a>
<a href="http://bx.8264.com">户外保险</a>
</p>
<p> 除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264 版权所有
<a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-10</a>
<a href="http://www.8264.com/template/8264/image/icp.jpg" target="_blank">ICP证 津B2-20110106</a>
</p>
</div>

<!-- footer_zt end -->

<!-- diy 开始 -->

<?php if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>

<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>

<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<?php } ?>

<!-- diy 结束 -->

</body>
</html>

<!-- Andes Edition:2011-07-13 -->