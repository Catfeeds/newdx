<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1371', 'common/header_diy');
block_get('2646,2647,2648,2649');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $topic['title'];?></title>
<meta name="Description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="Keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<!--[if IE 6]>
<script src="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->
<!-- diy 开始 -->
<style id="diy_style" type="text/css">#frame2pvLVu {  background-image:none !important;background-color:transparent !important;border:0px !important;}#frame5HYSoq {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#framedGPBsq {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#frame964EVv {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#frameMqEu8H {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_2646 {  margin:0px !important;border:0px !important;}#portal_block_2646 .content {  margin:0px !important;}#portal_block_2647 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_2647 .content {  margin:0px !important;}#portal_block_2648 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_2648 .content {  margin:0px !important;}#portal_block_2649 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_2649 .content {  margin:0px !important;}</style>
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
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<!-- diy 开始 -->
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>
<!-- diy 结束 -->
<!-- header_zt start -->
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/css/style.css"/>
<div id="header_zt">
<div class="big_box">
<a href="http://www.500to5000.com/about.php" target="_blank" class="tit_a">四姑娘登山节介绍</a>
<a href="http://www.8264.com/portal.php?mod=view&amp;aid=68995" target="_blank" class="tit_b">雪山音乐会</a>
<a href="#" target="_blank" class="tit_c">跨越雪山之巅</a>
<a href="http://www.8264.com/portal.php?mod=view&amp;aid=68996" target="_blank" class="tit_d">志愿者招募</a>
</div>
</div>
<!-- header_zt end -->
<!-- main_zt start -->
<div id="main_zt">
<div class="slide_box">
<div class="main_slide">
<!-- 大小 306x276 -->
<!--//hd幻灯//-->
<!--[diy=hd]--><div id="hd" class="area"><div id="frame2pvLVu" class=" frame move-span cl frame-1"><div id="frame2pvLVu_left" class="column frame-1-c"><div id="frame2pvLVu_left_temp" class="move-span temp"></div><?php block_display('2646'); ?></div></div></div><!--[/diy]-->
<!--//hd幻灯//-->
</div>
</div>
<div class="news_box">
<h2>
<a href="http://www.8264.com/viewnews-70367-page-1.html" target="_blank">2011四姑娘山登山节落幕 众山友圆雪山梦</a>
</h2>
<ul class="art_list">
        <!--
         <li>·
<a href="#" target="_blank">法渥贸易有限公司诚招品牌法渥贸易有限公司诚招品牌</a>
|
<a href="#" target="_blank">法渥贸易有限公司诚招品牌</a>
</li>
             -->
&nbsp&nbsp&nbsp&nbsp由四姑娘山风景名胜区管理局主办、四川省登山户外运动协会支持，著名户外品牌KAILAS和VAUDE赞助的“2011四姑娘山登山节”于2011年十一黄金周期间在美丽的四姑娘山成功举办，有近千名驴友参与到了本次登山节中...
            <br>
            <br>
            <!--
         <li>·
<li>·
<a href="#" target="_blank">法渥贸易有限公司诚招品牌法渥贸易有限公司诚招品牌</a>
|
<a href="#" target="_blank">法渥贸易有限公司诚招品牌</a>
</li>
<li>·
<a href="#" target="_blank">法渥贸易有限公司诚招品牌法渥贸易有限公司诚招品牌</a>
|
<a href="#" target="_blank">法渥贸易有限公司诚招品牌</a>
</li>
</li>
             -->

</ul>
<h3>
        <!--<a href="#" target="_blank">四姑娘登山节登山节热点动态</a>-->
<a  target="_blank">登山节热点动态</a>
</h3>
<!--//news_list列表//-->
<!--[diy=news_list]--><div id="news_list" class="area"><div id="frame964EVv" class=" frame move-span cl frame-1"><div id="frame964EVv_left" class="column frame-1-c"><div id="frame964EVv_left_temp" class="move-span temp"></div><?php block_display('2647'); ?></div></div></div><!--[/diy]-->
<!--//news_list列表//-->
</div>
<div class="news_r_box">
<div class="mod_tit"><a href="http://www.500to5000.com/">2011四姑娘山登山节官网</a></div>
<div class="mod_cont">
<a href="http://www.500to5000.com/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/img/news_r.jpg" /></a>
</div>
</div>
<div class="mod_all">
<div class="mod_tit">图文报道区</div>
<div class="mod_cont pic_170px">
<!--//twpic常用图片列表样式一ByAndes//-->
<!--[diy=twpic]--><div id="twpic" class="area"><div id="framedGPBsq" class=" frame move-span cl frame-1"><div id="framedGPBsq_left" class="column frame-1-c"><div id="framedGPBsq_left_temp" class="move-span temp"></div><?php block_display('2648'); ?></div></div></div><!--[/diy]-->
<!--//twpic常用图片列表样式一ByAndes//-->
<div class="clear"></div>
</div>
</div>
<div class="mod_all">
<div class="mod_tit">驴友们在四姑娘山上</div>
<div class="mod_cont pic_170px">
<!--//lypic常用图片列表样式一ByAndes//-->
<!--[diy=lypic]--><div id="lypic" class="area"><div id="frameMqEu8H" class=" frame move-span cl frame-1"><div id="frameMqEu8H_left" class="column frame-1-c"><div id="frameMqEu8H_left_temp" class="move-span temp"></div><?php block_display('2649'); ?></div></div></div><!--[/diy]-->
<!--//lypic常用图片列表样式一ByAndes//-->
<div class="clear"></div>
</div>
</div>
<div class="mod_all">
<div class="mod_tit"></div>
<div class="mod_cont tc_zt">
<div class="friend_link"></div>
</div>
</div>
<div class="clear"></div>
</div>
<!-- main_zt end -->
<!-- footer_zt start -->
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
<p> 服务热线：022-23708264 | 传真：022-23857291 | 地址：天津市华苑产业园区鑫茂民营科技园C2座6层AB单元</p>
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
<!-- Andes Edition:2011-08-16 -->