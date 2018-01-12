<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1363', 'common/header_diy');
block_get('2482,2483,2484,2485,2486,2487');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php if(!empty($topic['title'])) { ?><?php echo $topic['title'];?><?php } if(!empty($navtitle)) { ?><?php echo $navtitle;?> -<?php } if($_G['setting']['bbname']) { ?><?php echo $_G['setting']['bbname'];?> -<?php } ?></title>
<meta name="Description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="Keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011sh_fair/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011sh_fair/css/style.css"/>
<!--[if IE 6]>
<script src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->
<!-- diy 开始 -->
<style id="diy_style" type="text/css">#frame34h8PE { background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_2482 { background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_2482 .content { margin:0px !important;}#frame694Btv { margin:0px !important;border:0px !important;}#portal_block_2483 { margin:0px !important;border:0px !important;}#portal_block_2483 .content { margin:0px !important;}#frameTDGy5k { margin:0px !important;border:0px !important;}#portal_block_2484 { margin:0px !important;border:0px !important;}#portal_block_2484 .content { margin:0px !important;}#framek1rK52 { margin:0px !important;border:0px !important;}#portal_block_2485 { margin:0px !important;border:0px !important;}#portal_block_2485 .content { margin:0px !important;}#frameF2dNO3 { margin:0px !important;border:0px !important;}#portal_block_2486 { margin:0px !important;border:0px !important;}#portal_block_2486 .content { margin:0px !important;}#frame2Z3yZo { margin:0px !important;border:0px !important;}#portal_block_2487 { margin:0px !important;border:0px !important;}#portal_block_2487 .content { margin:0px !important;}</style>
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
</head><body>
<!-- diy 开始 -->
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>
<!-- diy 结束 -->
<!-- head 开始 -->
<div class="clear"></div>
<div id="header_zt">
<div class="small_head">
<div id="top_pic">
<iframe src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/tab.htm" width="979" marginwidth="0" height="320" marginheight="0" align="top" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
</div>
</div>
</div>
<!-- head 结束 -->
<!-- main 开始 -->
<div id="main">
<div class="main_mod_l">
<div class="mod_actshow">
<div class="mod_tit">展会活动图文区</div>
<div class="mod_cont pic_147px">
<!--//t_l_1常用图片列表样式一ByAndes//-->
<!--[diy=t_l_1]--><div id="t_l_1" class="area"><div id="frame34h8PE" class=" frame move-span cl frame-1"><div id="frame34h8PE_left" class="column frame-1-c"><div id="frame34h8PE_left_temp" class="move-span temp"></div><?php block_display('2482'); ?></div></div></div><!--[/diy]-->
<!--//t_l_1常用图片列表样式一ByAndes//-->
</div>
</div>
</div>
<div class="main_mod_c">
<div class="mod_acthot">
<div class="mod_tit"><span class="fr">
<a href="#" title="更多..." target="_blank" class="more">更多</a>
</span>展会热点</div>
<div class="mod_cont art_350px">
<!--//t_c_1常用文章列表样式一ByAndes//-->
<!--[diy=t_c_1]--><div id="t_c_1" class="area"><div id="frame694Btv" class=" frame move-span cl frame-1"><div id="frame694Btv_left" class="column frame-1-c"><div id="frame694Btv_left_temp" class="move-span temp"></div><?php block_display('2483'); ?></div></div></div><!--[/diy]-->
<!--//t_c_1常用文章列表样式一ByAndes//-->
</div>
<div class="clear"></div>
</div>
<div class="mod_yellow">
<div class="mod_tit">展会新闻</div>
<div class="mod_cont art_350px">
<!--//t_c_2常用文章列表样式一ByAndes//-->
<!--[diy=t_c_2]--><div id="t_c_2" class="area"><div id="frameTDGy5k" class=" frame move-span cl frame-1"><div id="frameTDGy5k_left" class="column frame-1-c"><div id="frameTDGy5k_left_temp" class="move-span temp"></div><?php block_display('2484'); ?></div></div></div><!--[/diy]-->
<!--//t_c_1常用文章列表样式一ByAndes//-->
</div>
<div class="clear"></div>
</div>
</div>
<div class="main_mod_r">
<div class="mod_yellow border">
<div class="mod_tit tc">展会官网图片链接</div>
<div class="mod_cont art_260px p_10">
<a href="http://www.messefrankfurt.com.hk/fair_homepage.aspx?fair_id=40&amp;exhibition_id=42&amp;hdnlang=zh-cn" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/img/88.jpg" /></a>
</div>
<div class="clear"></div>
</div>
<div class="mod_yellow border">
<div class="mod_tit tc">展会参观时间安排</div>
<div class="mod_cont art_260px p_10">
<p><b>专业观众日：2011-6-23—2011-6-24</b></p>
<p><b> 参观时间：9:30-16:30</b></p>
<p><b> 公众日：2011-6-25</b></p>
<p><b> 参观时间：9:30-14:30</b></p>
</div>
<div class="clear"></div>
</div>
<div class="mod_yellow border">
<div class="mod_tit tc">参展手册</div>
<div align="center" class="mod_cont art_260px p_10">

<!--//展会介绍//-->
<a href="http://www.messefrankfurt.com.hk/fair_fairfacts.aspx?fair_id=40&amp;exhibition_id=42" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/img/Righttitle/zhjs.jpg" width="108" height="20" border="0" /></a>

<!--//展会活动//-->
<a href="http://www.messefrankfurt.com.hk/fair_special_events.aspx?fair_id=40&amp;exhibition_id=42" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/img/Righttitle/zhhd.jpg" width="108" height="20" border="0" /></a>

<!--//媒体中心//-->
<br>
<a href="http://www.messefrankfurt.com.hk/fair_media_centre.aspx?fair_id=40&amp;exhibition_id=42" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/img/Righttitle/mtzx.jpg" width="108" height="20" border="0" /></a>

<!--//资料下载//-->
<a href="http://www.messefrankfurt.com.hk/fair_promotional.aspx?fair_id=40&amp;exhibition_id=42" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/img/Righttitle/zlxz.jpg" width="108" height="20" border="0" /></a>

<!--//展商名录//-->
<br>
<a href="http://www.messefrankfurt.com.hk/fair_exhibitor.aspx?fair_id=40&amp;exhibition_id=42" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/img/Righttitle/czml.jpg" width="108" height="20" border="0" /></a>

<!--//展会交通//-->
<a href="http://www.messefrankfurt.com.hk/fair_travel_centre.aspx?fair_id=40&amp;exhibition_id=42" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/img/Righttitle/zgjt.jpg" width="108" height="20" border="0" /></a>

<!--//会务联络//-->
<br>
<a href="http://www.messefrankfurt.com.hk/fair_contacts.aspx?fair_id=40&amp;exhibition_id=42" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/img/Righttitle/hwll.jpg" width="108" height="20" border="0" /></a>

<!--//观众报名//-->
<a href="http://portal.messefrankfurt.com.hk/services/vor/registration_form_chi.aspx?exhibition_id=718&amp;language=zh-cn" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sh_fair/img/Righttitle/gzdj.jpg" width="108" height="20" border="0" /></a>
</div>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
<div class="mod_photoshow">
<div class="mod_tit">高端访问</div>
<div class="mod_cont pic_180px">
<!--//m_c_1常用图片列表样式一ByAndes//-->
<!--[diy=m_c_1]--><div id="m_c_1" class="area"><div id="framek1rK52" class=" frame move-span cl frame-1"><div id="framek1rK52_left" class="column frame-1-c"><div id="framek1rK52_left_temp" class="move-span temp"></div><?php block_display('2485'); ?></div></div></div><!--[/diy]-->
<!--//m_c_1常用图片列表样式一ByAndes//-->
</div>
<div class="clear"></div>
</div>
<div class="mod_photoshow">
<div class="mod_tit">展区/展品</div>
<div class="mod_cont pic_180px">
<!--//m_c_2常用图片列表样式一ByAndes//-->
<!--[diy=m_c_2]--><div id="m_c_2" class="area"><div id="frameF2dNO3" class=" frame move-span cl frame-1"><div id="frameF2dNO3_left" class="column frame-1-c"><div id="frameF2dNO3_left_temp" class="move-span temp"></div><?php block_display('2486'); ?></div></div></div><!--[/diy]-->
<!--//m_c_2常用图片列表样式一ByAndes//-->
</div>
<div class="clear"></div>
</div>
<div class="mod_photoshow">
<div class="mod_tit">展会花絮</div>
<div class="mod_cont pic_180px">
<!--//m_c_3常用图片列表样式一ByAndes//-->
<!--[diy=m_c_3]--><div id="m_c_3" class="area"><div id="frame2Z3yZo" class=" frame move-span cl frame-1"><div id="frame2Z3yZo_left" class="column frame-1-c"><div id="frame2Z3yZo_left_temp" class="move-span temp"></div><?php block_display('2487'); ?></div></div></div><!--[/diy]-->
<!--//m_c_3常用图片列表样式一ByAndes//-->
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<!-- main 结束 -->
<!-- footer 开始 -->
<div id="footer_zt">
<p class="top_m">
<a href="http://www.8264.com/ziliao/about/aboutus.php" target="_blank">关于我们</a>
|
<a href="http://www.8264.com/ziliao/about/aboutus.php" target="_blank">联系我们</a>
|
<a href="http://www.8264.com/8954.html" target="_blank">给我留言</a>
|
<a href="http://www.8264.com/ziliao/sitemap.html" target="_blank">网站地图</a>
|
<a href="http://www.8264.com/ziliao/ggservice/index.html" target="_blank">广告服务</a>
|
<a href="http://www.8264.com/list/531/" target="_blank">编辑部的故事</a>
|
<a href="http://www.8264.com/sitelink/index.html" target="_blank">友情连接</a>
</p>
<p>服务热线：022-23708264 | 传真：022-23708323 | 地址：天津市新技术产业园区华天道8号海泰信息广场C座1001号</p>
<p>户外活动有风险，8264提醒您购买 户外保险</p>
<p>除了脚印什么都不留下除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。
<a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-1</a>
</p>
</div>
<!-- footer 结束 -->
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
<!-- Andes Edition:2011-06-24 -->