<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1397', 'common/header_diy');
block_get('3880,3884,3874,3875,3881,3883,3876,3877,3882,3878,3879');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<title>ISPO BEIJING |运动展|时尚展|户外展|体育展|体育用品展| 亚洲运动用品与时尚展| 2012 ispo</title>
<?php echo $_G['setting']['seohead'];?>

<meta name="keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="generator" content="8264" />
<meta name="author" content="8264.com" />
<meta name="copyright" content="2001-2010" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<base href="<?php echo $_G['siteurl'];?>" />
<!--自己js开始-->
<script src="http://static.8264.com/oldcms/moban/zt/2012ispo/js/common.js" type="text/javascript" type="text/javascript" language="javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2012ispo/js/jquery-1.4.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2012ispo/js/jquery.lazy-1.3.1.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function(){
  jQuery.lazy({src:'http://static.8264.com/oldcms/moban/zt/2012ispo/js/jquery.darizi.js',name:'darizi',dependencies:{js:['http://static.8264.com/oldcms/moban/zt/2012ispo/js/jquery.countdown.js']},cache:true});
  // 大日子
  var ndate = new Date(2012,1,22); 
  jQuery('.darizi').darizi({ bigDay:ndate,last:3});

});
</script>
<!--自己js结束--><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
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
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>   
<!--dx代码结束-->
<!--diy样式开始-->
<style id="diy_style" type="text/css">#frameJLaWDL {  margin:0px !important;border:medium none !important;}#portal_block_3874 {  margin:0px !important;border:medium none !important;}#portal_block_3874 .content {  margin:0px !important;}#frame4MG42a {  margin:0px !important;border:medium none !important;}#portal_block_3875 {  margin:0px !important;border:medium none !important;}#portal_block_3875 .content {  margin:0px !important;}#frames8esue {  margin:0px !important;border:medium none !important;}#portal_block_3876 {  margin:0px !important;border:medium none !important;}#portal_block_3876 .content {  margin:0px !important;}#frameo4k4j4 {  margin:0px !important;border:medium none !important;}#portal_block_3877 {  margin:0px !important;border:medium none !important;}#portal_block_3877 .content {  margin:0px !important;}#frameNJXzx8 {  margin:0px !important;border:medium none !important;}#portal_block_3878 {  margin:0px !important;border:medium none !important;}#portal_block_3878 .content {  margin:0px !important;}#framewc9NaI {  margin:0px !important;border:medium none !important;}#portal_block_3879 {  margin:0px !important;border:medium none !important;}#portal_block_3879 .content {  margin:0px !important;}#frameA7EoO4 {  margin:0px !important;border:medium none !important;}#portal_block_3880 {  margin:0px !important;border:medium none !important;}#portal_block_3880 .content {  margin:0px !important;}#frameGKBOz7 {  margin:0px !important;border:medium none !important;}#portal_block_3881 {  margin:0px !important;border:medium none !important;}#portal_block_3881 .content {  margin:0px !important;}#frame5arRTv {  margin:0px !important;border:medium none !important;}#portal_block_3882 {  margin:0px !important;border:medium none !important;}#portal_block_3882 .content {  margin:0px !important;}#frameYjAK3o {  margin:0px !important;border:medium none !important;}#portal_block_3883 {  margin:0px !important;border:medium none !important;}#portal_block_3883 .content {  margin:0px !important;}#frame214221 {  margin:0px !important;border:medium none !important;}#portal_block_3884 {  margin:0px !important;border:medium none !important;}#portal_block_3884 .content {  margin:0px !important;}</style>
<!--diy样式结束-->
<!--自己样式开始-->
<link href="http://static.8264.com/oldcms/moban/zt/2012ispo/style/style.css" rel="stylesheet" type="text/css" />
<!--自己样式结束-->
<div class="warpper">
<div class="warpper_960">
        <!--导航开始-->
        <div class="navall"><a href="http://www.8264.com/" target="_blank">8264首页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/topic/1397.html#n1">展会动态</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n2">展会地图</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n10">展位风采</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n3">互动专区</a>&nbsp;|&nbsp;<a href="http://www.8264.com/topic/1397.html#n4">专访</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n5">新品</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n6">驴友看ispo</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n7">视频</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n8">花絮</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n9">美女</a></div>
        <!--导航结束-->
        <!--第一部分开始-->
        <div class="mid">
        	<div class="l">
            	<!--轮播开始-->
            	<div class="lunboall">
                	<div class="ltitle1">焦点关注</div>
                    <div class="lunbo">
                        <!--//轮播//-->
            			<!--[diy=lunbo]--><div id="lunbo" class="area"><div id="frameA7EoO4" class=" frame move-span cl frame-1"><div id="frameA7EoO4_left" class="column frame-1-c"><div id="frameA7EoO4_left_temp" class="move-span temp"></div><?php block_display('3880'); ?></div></div></div><!--[/diy]-->
                    </div>
                </div>
                <!--轮播结束-->
                <div class="l2">
                	<div class="zhinantitle">观展指南</div>
                    <div class="zn">
                    	<ul>
                        	<li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73366" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn1.jpg"></a></li>
                            <li><a href="http://j.map.baidu.com/XIE3" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn2.jpg"></a></li>
                            <li><a href="http://j.map.baidu.com/oIE3" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn3.jpg"></a></li>
                            <li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73367" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn4.jpg"></a></li>
                            <li><a href="http://www.weather.com.cn/weather/101010100.shtml" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn5.jpg"></a></li>
                            <li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73368" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn6.jpg"></a></li>
                        </ul>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </div>
            <div class="m">
            	<div class="m1">
                	<div class="mtitle">展会头条</div>
                    <div class="mcon">
<div class="toutiaocon">第八届亚洲运动用品与时尚展于2012年2月22日至25日期间举行，8264报道小组将会为您带来第一手展会资讯，各品牌装备新品资讯，欢迎您关注本专题。</div>
                        <!--//展会头条 10条 标题长度30//-->
            			<!--[diy=zhtt]--><div id="zhtt" class="area"><div id="frame214221" class=" frame move-span cl frame-1"><div id="frame214221_left" class="column frame-1-c"><div id="frame214221_left_temp" class="move-span temp"></div><?php block_display('3884'); ?></div></div></div><!--[/diy]-->
 </div>
                </div>
                <div class="m1">
                	<div class="mtitle">展会快讯<a name="n1"></a></div>
                    <div class="toutiaolist">
                        <!--//头条列表 12条 标题长度30//-->
            			<!--[diy=ttlist]--><div id="ttlist" class="area"><div id="frameJLaWDL" class=" frame move-span cl frame-1"><div id="frameJLaWDL_left" class="column frame-1-c"><div id="frameJLaWDL_left_temp" class="move-span temp"></div><?php block_display('3874'); ?></div></div></div><!--[/diy]-->
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div class="r">
                <div class="darizi">
                    <div class="zhengjishi"><span class="shu"></span></div>
                    <div class="daojishi"><span class="shu"></span></div>
                    <div class="jieshule"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/bm.gif"></div>
                </div>
                <div class="r1">
                	<ul>
                    	<li><a href="http://www.ispo.com.cn/beijing/templates_home_article.aspx?classid=928777282620"  style="color:#FF0000" target="_blank">驴友在线注册预约观展</a></li>
                        <li><a href="http://bbs.8264.com/thread-1145472-1-1.html" style="color:#FF0000" target="_blank">第二届8264驴友公益晚宴</a></li>
                        <li><a href="http://bbs.8264.com/forum-viewthread-tid-1141385-fromuid-34143033.html" target="_blank">8264每日一图全国巡回展</a></li>
<li><a href="http://bbs.8264.com/thread-1002655-1-1.html" target="_blank">2012露营大会诚邀合作</a></li>
                        <li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73373" target="_blank">2012 中国户外零售商论坛</a></li>
<li><a href="http://www.8264.com/viewnews-73751-page-1.html" target="_blank">第六届金犀牛奖颁奖典礼</a></li>
<li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73369" target="_blank">KAILAS央莫龙首登分享会</a></li>
<li><a href="http://bbs.8264.com/forum-viewthread-tid-1150917-fromuid-34170351.html" target="_blank">26日东灵山一日穿越</a></li>

                    </ul>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--第一部分结束-->
        <!--专访开始-->
        <div class="mid">
        	<div class="title960"><a href="http://www.8264.com/portal-list-catid-746.html">展会访谈</a><a name="n4"></a></div>
            <div class="zf">
                <div class="zf_l">
                    <div class="zfimgbg1" id="sh_tip1" onmousemove="slide_ty(1)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/herundong.jpg"></div>
                    <div class="zfimgbg" id="sh_tip2" onmousemove="slide_ty(2)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/phenix.jpg"></div>
                    <div class="zfimgbg" id="sh_tip3" onmousemove="slide_ty(3)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/toread.jpg"></div>

                    <div class="zfimgbg" id="sh_tip4" onmousemove="slide_ty(4)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kingcamp.jpg"></div>
                    <div class="zfimgbg" id="sh_tip5" onmousemove="slide_ty(5)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/northland.jpg"></div>
                    <div class="zfimgbg" id="sh_tip6" onmousemove="slide_ty(6)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/Kroceus.jpg"></div>
                    <div class="zfimgbg" id="sh_tip7" onmousemove="slide_ty(7)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/youdo.jpg"></div>
                    <div class="zfimgbg" id="sh_tip8" onmousemove="slide_ty(8)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/vb.jpg"></div>
                    <div class="zfimgbg" id="sh_tip9" onmousemove="slide_ty(9)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/shanlinlu.jpg"></div>
                    <div class="zfimgbg" id="sh_tip10" onmousemove="slide_ty(10)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kolumb.jpg"></div>
                    <div class="zfimgbg" id="sh_tip11" onmousemove="slide_ty(11)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/yisijia.jpg"></div>
                    <div class="zfimgbg" id="sh_tip12" onmousemove="slide_ty(12)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/huofeng.jpg"></div>
<div class="zfimgbg" id="sh_tip13" onmousemove="slide_ty(13)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/Gregory.jpg"></div>
<div class="zfimgbg" id="sh_tip14" onmousemove="slide_ty(14)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ACTIONFOX.jpg"></div>
<div class="zfimgbg" id="sh_tip15" onmousemove="slide_ty(15)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kingcamp2.jpg"></div>
<div class="zfimgbg" id="sh_tip16" onmousemove="slide_ty(16)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ZEROFIT.jpg"></div>
<div class="zfimgbg" id="sh_tip17" onmousemove="slide_ty(17)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/phenix2.jpg"></div>
<div class="zfimgbg" id="sh_tip18" onmousemove="slide_ty(18)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kailas.jpg"></div>
<div class="zfimgbg" id="sh_tip19" onmousemove="slide_ty(19)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ozark.jpg"></div>
<div class="zfimgbg" id="sh_tip20" onmousemove="slide_ty(20)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/DexShell.jpg"></div>
<div class="zfimgbg" id="sh_tip21" onmousemove="slide_ty(21)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/shuxingke.jpg"></div>
<div class="zfimgbg" id="sh_tip22" onmousemove="slide_ty(22)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/CORDURA.jpg"></div>
<div class="zfimgbg" id="sh_tip23" onmousemove="slide_ty(23)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/scarpa.jpg"></div>
<div class="zfimgbg" id="sh_tip24" onmousemove="slide_ty(24)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/dauter.jpg"></div>
                    <div style="clear:both"></div>
                </div>
                <div class="zf_r" id="sh_ce_p">
<div class="zf_r_one" id="ce_pic1" onmousemove="slide_ty(1)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73730.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/herundongd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73730.html" target="_blank">8264独家专访 牧高笛形象大使何润东[视频]</a></h1>					 ISPO BEIJING 2012展会进行到第二天，牧高笛形象代言人、著名影星何润东莅临展会，出席牧高笛“绿色行动 绿动全城”公益环保行动的首次发布仪式..</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic2" onmousemove="slide_ty(2)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73721.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/phenixd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73721.html" target="_blank">Phenix服装色彩搭配师冈部 产品功能美学化</a></h1>					
日本户外时尚潮流沉淀下来一点，现在正在向前发展的过程中。现在，户外生活日常化，也是潮流的大势所趋。通过你们这样的媒体进行宣导...</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic3" onmousemove="slide_ty(3)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73691.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/toreadd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73691.html" target="_blank">ISPO BEIJING 2012 采访探路者总经理彭昕</a></h1>2月22-25日，2012 ISPO BEIJING在国家会议中心举行，8264对此进行报道采访。以下是8264对探路者总经理彭昕采访...。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic4" onmousemove="slide_ty(4)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73696.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kingcampd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73696.html" target="_blank">康尔健野徐国庆 提升品牌形象 倡导家庭户外</a></h1>					2012年，康尔健野在产品系列开发上将突出重点，其主题、品类、品种将围绕营销做进一步的减法。2010年，康尔健野率先提出“家庭户外”理念，并围绕家庭户外做了一系列的主题活动</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic5" onmousemove="slide_ty(5)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73694" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/northlandd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73694.html" target="_blank">专访诺诗兰王凡 2012是品牌规划首个执行年</a></h1>					2011年，诺诗兰品牌明确了品牌发展目标与长远规划。2012年将是诺诗兰品牌发展规划的第一个执行年。这将包括诺诗兰品牌提升，销售渠道优化，供应链整合等多方面的新举措。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic6" onmousemove="slide_ty(6)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73706.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/Kroceusd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73706.html" target="_blank">访KROCEUS 扩展销售渠道占有更多的市场份额</a></h1>					KROCEUS主要是渠道的开拓，重点发展新市场，提升市场份额。集中精力发展东北市场，去年下半年开店8、9家，进入一些有代表性的户外店，在渠道拓展方面取得一定的突破。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic7" onmousemove="slide_ty(7)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73676.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/youdod.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73676.html" target="_blank">悠度品牌全新定位 ISPO BEIJING2112悠度专访</a></h1>	
第一，悠度在直营店方面更大的尝试，在厦门建立两家样板店。第二，悠度将品牌定位由原来的"短途户外休闲"扩展为"周末户外休闲装备第一品牌"...</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic8" onmousemove="slide_ty(8)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73738.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/vbm.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73738.html" target="_blank">Vibram中国总经理马帝 带你了解最新五指鞋</a></h1>					8264对Vibram中国总经理马帝和中国销售总经理Joe进行采访，最新五指鞋介绍、哪些中国的外品牌在使用Vibram鞋底以及合作标准、五指鞋在中国的销售渠道等..</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic9" onmousemove="slide_ty(9)">
                    <div class="zf_imgb"><a href="http://www.8264.com/viewnews-73736-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/shanlinlud.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/viewnews-73736-page-1.html" target="_blank">山林路专访 未来五年山林路要跻身行业三甲</a></h1>	
　山林路品牌于1992年由我们家族在美国创立，主要生产和销售户外运动服饰。1996年为了公司的全球化战略，在湖北成立了生产基地，现有员工近2000人...</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic10" onmousemove="slide_ty(10)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73732.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kolumbd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73732.html" target="_blank">Kolumb李维军 夯实运营基础 抓好价值链两端</a></h1>
在注册Kolumb品牌的时候，与航海家“哥伦布”的字音关联，“发现和探索”是航海的精神，但我们更关注户外运动过程中的乐趣，因此Kolumb品牌的口号是“乐在发现”</div>
                    </div>
<div class="zf_r_one" id="ce_pic11" onmousemove="slide_ty(11)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73654.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/yisijiad.jpg"/></a></div>
                    <div class="zf_imginfo">
                    <h1><a href="http://www.8264.com/73654.html" target="_blank">伊思佳宋全昌 全系列产品 商场渠道 追求上市</a></h1>本届ISPO展会，伊思佳品牌将重点展示2012春夏新款皮肤风衣类产品，该类产品是伊思佳最早从日本引进，目前国内需求也非常大</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic12" onmousemove="slide_ty(12)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73653.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/huofengd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73653.html" target="_blank">打造中国户外炉炊具NO.1 专访火枫吕旗顶</a></h1>	
    火枫品牌致力于专业户外炉炊具方向新产品的研发，做专业的户外炉炊具品牌，并在该领域有很高的市场占有率。然而销售额不是火枫品牌的近期目标，火枫品牌将立足长远...</div>
                    </div>
<div class="zf_r_one" id="ce_pic13" onmousemove="slide_ty(13)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73655.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/Gregoryd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73655.html" target="_blank">Gregory孟云 2012年将重点主推城市款背包</a></h1>	
Gregory进入中国七年，前五年主推技术款；2011年，引进了城市款产品，2012年，将重点推广城市款产品...</div>
                    </div>
<div class="zf_r_one" id="ce_pic14" onmousemove="slide_ty(14)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73843.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ACTIONFOXd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73843.html" target="_blank">Actionfox携新品射出鞋参展ispo努力延伸产品线</a></h1>	
2011年度Actionfox已经完成销售目标，店铺销售业绩稳步增长，也实现全年销售的稳步增长...</div>
                    </div>
<div class="zf_r_one" id="ce_pic15" onmousemove="slide_ty(15)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73821.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kingcamp2d.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73821.html" target="_blank">KingCamp创始人徐国庆谈十年创业发展历程</a></h1>	
　2002年初冬，从事业单位离职的徐国庆创立了户外品牌KingCamp，“将它做成国际品牌”这是他最初的梦想...</div>
                    </div>
<div class="zf_r_one" id="ce_pic16" onmousemove="slide_ty(16)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73826.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ZEROFITd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73826.html" target="_blank">独特专利 ZEROFIT打造高端户外压缩功能内衣</a></h1>	
庄启华先生在专访中介绍了压缩运动内衣的全球发展史、其功能特性以及ZEROFIT品牌最具特色的不同弹性面料无缝接合技术...</div>
                    </div>
<div class="zf_r_one" id="ce_pic17" onmousemove="slide_ty(17)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73825.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/phenixd2.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73825.html" target="_blank">PHENIX孙建军 用“功能美学”理念影响户外人</a></h1>	
PHENIX品牌总经理孙建军来到8264展位接受了记者的专访，对PHENIX品牌对户外和时尚的态度...</div>
                    </div>
<div class="zf_r_one" id="ce_pic18" onmousemove="slide_ty(18)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73824.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kailasd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73824.html" target="_blank">KAILAS未来之路：致力打造专业技术攀登品牌</a></h1>	
采访中KAILAS品牌市场总监付显凯谈及了很多关于户外行业及KAILAS的发展趋势及未来的定位以及2012年渠道拓展规划、各大活动...</div>
                    </div>
<div class="zf_r_one" id="ce_pic19" onmousemove="slide_ty(19)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73823.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ozarkd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73823.html" target="_blank">Ozark品牌总监贾旭 推动Ozark多元化稳健发展</a></h1>	
奥索卡品牌总监贾旭来到8264展位接受了记者的专访，对新年中奥索卡品牌的发展思路、新产品特点和电子商务等问题回答了记者的提问...</div>
                    </div>
<div class="zf_r_one" id="ce_pic20" onmousemove="slide_ty(20)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73819.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/DexShelld.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73819.html" target="_blank">DexShell戴适防水透湿为核心 提供专业户外配饰</a></h1>	
随着户外运动服饰的不断走向成熟，深化，细化，西方的户外领域对配件方面也提出了这一功能性要求，因此出现了类似Goretex防水鞋靴...</div>
                    </div>
<div class="zf_r_one" id="ce_pic21" onmousemove="slide_ty(21)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73814.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/shuxingked.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73814.html" target="_blank">数星客总经理叶培坤 加强投资重视品牌推广</a></h1>	
第一，在品牌推广方面，以北京ISPO、南京亚洲户外展为品牌营销和展示平台，同时赞助瓦萨赛事、武功山帐篷节...</div>
                    </div>
<div class="zf_r_one" id="ce_pic22" onmousemove="slide_ty(22)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73803.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/CORDURAd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/7803.html" target="_blank">8264专访CORDURA全球市场总监Cindy McNaull</a></h1>	
体育用品和鞋袜类是我们扩展的重点。我们已经和运动品牌ADIDAS,PUMA，鞋类品牌CONVERSE等品牌有一些徒步/远足类别的产品上有合作...</div>
                    </div>
<div class="zf_r_one" id="ce_pic23" onmousemove="slide_ty(23)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73747.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/scarpad.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73747.html" target="_blank">Scarpa CEO Sandro 为中国驴友带来更多新品</a></h1>	
SCARPA首席执行官Sandro和中国总经理黄贻铨先生主要就2012年在中国如何进行发展规划、新品介绍、今年全球鞋品发展趋势等...</div>
                    </div>
<div class="zf_r_one" id="ce_pic24" onmousemove="slide_ty(23)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73746.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/dauterd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73746.html" target="_blank">Deuter两名高管 今年最新主打产品欣赏[视频]</a></h1>	
Deuter（多特）全球销售经理Jones和中国总经理黄仁华先生，主要介绍了多特南北方的发展情况、在中国的自身发展优势...</div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <script language="javascript">
                var _tnum;
                var tMyMar;
                var tSize=24;
                function slide_ty(v){
                for(i=1;i<=tSize;i++){
                document.getElementById("ce_pic"+i).style.display="none";
                document.getElementById("sh_tip"+i).className="zfimgbg1";
                }
                document.getElementById("ce_pic"+v).style.display="";
                document.getElementById("sh_tip"+v).className="zfimgbg";
                _tnum=v; 
                clearInterval(tMyMar);
                tMyMar=setInterval("tGunDong()",1000);
                }
                function tGunDong(){
                if((_tnum+1)>tSize)
                _tnum=1;
                else	
                _tnum=_tnum+1;
                slide_ty(_tnum);
                }
                slide_ty(1);
                </script>
        <!--专访结束-->
        <!--互动专区开始-->
        <div class="mid">
        	<div class="title960">互动专区<a name="n3"></a></div>
            <div class="fangtan">
            	<div class="hudongl">
                	<div id="hotttdiv5_2" onmouseover="setttHotph_2(5);"><div id="hotttdiv5_3" class="sheqian"></div></div>
                	<div id="hotttdiv1_2" onmouseover="setttHotph_2(1);"><div id="hotttdiv1_3" class="sheqian1"></div></div>
            		<div id="hotttdiv2_2" onmouseover="setttHotph_2(2);"><div id="hotttdiv2_3" class="sheqian1"></div></div>
            		<div id="hotttdiv3_2" onmouseover="setttHotph_2(3);"><div id="hotttdiv3_3" class="sheqian1"></div></div>
            		<div id="hotttdiv4_2" onmouseover="setttHotph_2(4);"><div id="hotttdiv4_3" class="sheqian1"></div></div>
                </div>
                <script language="javascript">
function setttHotph_2(i)
{
 selectttHot2(i);
}
function selectttHot2(i)
{
  for(var id = 1;id<=5;id++)
 {
  var bbb="hotttcomment0"+id;
  if(id==i)
  document.getElementById(bbb).style.display="";
  else
  document.getElementById(bbb).style.display="none";
 } 
  for(var id = 1;id<=5;id++)
 {
  var bb="hotttdiv"+id+"_3";
  if(id==i)
  document.getElementById(bb).className="sheqian1";
  else
  document.getElementById(bb).className="sheqian";
 } 
}
</script>
<div class="hudongr" style=" display:;" id="hotttcomment05">
    <div class="hudongall">
                    	<div class="hudongimg"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/waiguan.jpg" width="120" height="80" border="0" /></div>
                        <div class="hudongwen"><span style="color:#F00">展会展馆外景</span><br>地点：北京国家会议中心<br>时间：2月22-25日</div>
                        <div style="clear:both;"></div>
                    </div>
      <div class="hudongall">
                    	<div class="hudongimg"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/8264zw.jpg" width="120" height="80" border="0" /></div>
                        <div class="hudongwen">8264展位欣赏<br>地点：B3.111<br>时间：2月22-25日</div>
                        <div style="clear:both;"></div>
                    </div>
    
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-1145472-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/lvyoujuhui.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-1145472-1-1.html" style="color:#F00"target="_blank">8264公益爱心晚宴</a><br>地点：国家会议中心<br>时间：23日晚6点</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://u.8264.com/home-space-uid-34144490-do-album-picid-2608334.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/meiriyitu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://u.8264.com/home-space-uid-34144490-do-album-picid-2608334.html"  style="color:#F00"target="_blank">8264特色：每日一图</a></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/topic/1396.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/campingxiaotu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/topic/1396.html" style="color:#F00" target="_blank">8264露营大会</a></div>
                        <div style="clear:both;"></div>
                    </div>
<!--div class="hudongall">
                    	<div class="hudongimg"><a href="http://bx.8264.com/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/baoxian.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bx.8264.com/" target="_blank">户外保险</a><br>专门针对驴友设计<br></div>
                        <div style="clear:both;"></div>
                    </div-->
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment01">
            <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_home_list.aspx?classid=008801888650" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/qiatan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_home_list.aspx?classid=008801888650" style="color:#F00"target="_blank">海外品牌代理洽谈区</a><br>
                          地点：B1.103展位<br>时间：2011年2月22-24日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                   	  <div class="hudongimg"><a href="http://www.8264.com/viewnews-73366-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/liuxingqushi.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73366-page-1.html" style="color:#F00" target="_blank">流行趋势发布区
</a><br>地点：B1.116展位<br>时间：2月22-24日</div>
                        <div style="clear:both;"></div>
                  </div>
                    <div class="hudongall">
                   	  <div class="hudongimg"><a href="http://www.8264.com/viewnews-73366-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zpqu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73366-page-1.html" style="color:#F00" target="_blank">帐篷区</a><br>地点：B2.222展位<br>时间：2月22-24日</div>
                        <div style="clear:both;"></div>
                  </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment02">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=140" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/yataixue.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=140" style="color:#F00"target="_blank">亚太雪地产业论坛</a><br>地点：会议区E306A会议室<br>时间：2月23日全天<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=159" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/lingshoult.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=159" style="color:#F00"target="_blank">零售商论坛</a><br>地点：展览区E-232会议室<br>时间：2月25日全天<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=160" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shishangyundongqushi.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=160" style="color:#F00" target="_blank">中国运动时尚流行趋势论坛</a><br>地点：展览区E-232会议室<br>时间：2月22日全天</div>
                        <div style="clear:both;"></div>
                    </div>
                	<div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=161" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/huwaichanyelt.jpg" width="120" height="80" border="0" /></a></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=161" style="color:#F00" target="_blank">中国户外产业论坛</a><br>地点：展览区E-232会议室<br>时间：2月24日全天<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/viewnews-73574-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/CORDURA_lunta.jpg" width="120" height="80" border="0" /></a></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73574-page-1.html" style="color:#F00" target="_blank">CORDURA户外装备中外研讨会</a><br>
                      地点：展区２楼的会议区<br>时间：2月23日 9:00</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both;"></div>
                 </div>
       
                <div class="hudongr" style=" display:none;" id="hotttcomment03">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/viewnews-73366-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/sifei.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73366-page-1.html"style="color:#F00" target="_blank">NATOOKE X速旷文化极速PK</a><br>地点：0.001展位死飞区<br>
                        时间：2月22-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=192" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/paobu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=192" target="_blank">北京冬季跑步嘉年华</a><br>地点：B1.118展位舞台区<br>时间：2月22-25日<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=189" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/huaban.jpg" width="120" height="80" border="0" /></a></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=189" style="color:#F00"target="_blank">极限运动滑板系列赛
</a><br>
地点：0.122展位滑板区<br>
时间：2月22-24日<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment04">
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=162" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/banfu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=162" style="color:#FF0000" target="_blank">班夫山地电影节推介及专场</a><br> 地点：B1.118展位 舞台区<br>
                        时间：2月22-24日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/viewnews-73366-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73366-page-1.html" style="color:#FF0000" target="_blank">南蒂罗尔-高山缆车救援演</a><br>
                        地点：1号馆入口处<br>
                        时间：2月22-25日 每日4次</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                   	  <div class="hudongimg"><a href="http://u.8264.com/home.php?mod=space&amp;uid=125851&amp;do=album&amp;picid=1386452&amp;goto=down#pic_block" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zouxiu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://u.8264.com/home.php?mod=space&amp;uid=125851&amp;do=album&amp;picid=1386452&amp;goto=down#pic_block" style="color:#F00" target="_blank">时装表演装备发布秀</a><br>地点：B1.118展位 舞台区<br>时间：2月22-23日<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                  </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/viewnews-73751-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/jinxiniu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73751-page-1.html" style="color:#F00" target="_blank">金犀牛奖颁奖典礼</a><br>地点：会议区多功能A厅<br>
                        时间：2月234日17:30</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <!--互动专区结束-->
        <!--装备开始-->
        <div class="mid">
        	<div class="title960">展会装备<a name="n5"></a></div>
            <div class="zball">
            	<div class="zbgun" style="display:none">
                	<div class="gun" id="de">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td id="de1">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63667.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb008.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63667.html" target="_blank">户外面料透气性测试</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63666.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb009.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63666.html" target="_blank">香港盈威品牌专利伞包</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63658.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb010.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63658.html" target="_blank">天然蔺草会呼吸防潮垫</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63662.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb011.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63662.html" target="_blank">Trezeta“百叶窗”登山鞋</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63664.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb012.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63664.html" target="_blank">kailas会呼吸的冲锋衣</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td id="de2">&nbsp;</td>
                            </tr>
                        </table>
                        <SCRIPT language=JavaScript type=text/javascript>
                            function GetObj01(objName){
                                if(document.getElementById){
                                    return eval('document.getElementById("' + objName + '")');
                                }else if(document.layers){
                                    return eval("document.layers['" + objName +"']");
                                }else{
                                    return eval('document.all.' + objName);
                                }
                            }
                              var speed01=20//速度数值越大速度越慢
                              GetObj01("de2").innerHTML=GetObj01("de1").innerHTML
                              function Marquee01(){
                                  if(GetObj01("de").scrollLeft<=0)
                                  GetObj01("de").scrollLeft=GetObj01("de1").offsetWidth
                                  else{
                                    GetObj01("de").scrollLeft--
                                  }
                              }
                              var MyMar01=setInterval(Marquee01,speed01)
                              GetObj01("de").onmouseover=function() {clearInterval(MyMar01)}
                              GetObj01("de").onmouseout=function() {MyMar01=setInterval(Marquee01,speed01)}
                              </SCRIPT>
</div>
                </div>
            	<div>
                    <div class="mid7con_l">
                        <div class="zhantu"><a href="http://www.8264.com/73723.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuangbei/d2.jpg" width="390" height="220" border="0" /></a></div>
                        <div class="zhantutitle">
                            <div class="zhantutitle_l">8264直击--装备新品</div>
                            <div class="zhantutitle_r"><a href="http://www.8264.com/73723.html" target="_blank">KAILAS展位攀登器材介绍</a></div>
                            <div style="clear:both;"></div>
                        </div>
                        <div class="zhantunew">
                            <!--//装备文字列表 12条 //-->
                            <!--[diy=zblist]--><div id="zblist" class="area"><div id="frame4MG42a" class=" frame move-span cl frame-1"><div id="frame4MG42a_left" class="column frame-1-c"><div id="frame4MG42a_left_temp" class="move-span temp"></div><?php block_display('3875'); ?></div></div></div><!--[/diy]-->
                            <div style="clear:both;"></div>
                      </div>
                    </div>
                    <div class="mid7con_r">
                    <!--//装备图文 9条 //-->
                    <!--[diy=zblisttw]--><div id="zblisttw" class="area"><div id="frameGKBOz7" class=" frame move-span cl frame-1"><div id="frameGKBOz7_left" class="column frame-1-c"><div id="frameGKBOz7_left_temp" class="move-span temp"></div><?php block_display('3881'); ?></div></div></div><!--[/diy]-->
                </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="zhuangbeinew">
<!--//展会装备图文列表 //-->
<!--[diy=zhzblistimg]--><div id="zhzblistimg" class="area"><div id="frameYjAK3o" class=" frame move-span cl frame-1"><div id="frameYjAK3o_left" class="column frame-1-c"><div id="frameYjAK3o_left_temp" class="move-span temp"></div><?php block_display('3883'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
        <!--装备结束-->
        <!--视频开始-->
        <div class="mid">
        	<div class="title960">给力视频<a name="n7"></a></div>
            <div class="shipinall">
            	<div class="shipin_l"><a href="http://www.8264.com/73730.html" target="_blank" title="8264独家专访 牧高笛形象大使何润东"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/d2.jpg" width="370" height="275" /></a></div>
                <div class="shipin_r">
                	<ul>
                        <li><a href="http://www.8264.com/73730.html" target="_blank" title="哥仑布品牌展位视频欣赏"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp1.jpg"/></a></li>
                        <li><a href="http://www.8264.com/73687.html" target="_blank" title="KingCamp品牌展位视频赏析"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp2.jpg"/></a></li>
                        <li><a href="http://www.8264.com/73688.html" target="_blank" title="火枫FMS-F3—超轻的“引擎”分体式野营油炉"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp3.jpg"/></a></li>
                        <li><a href="http://www.8264.com/73689.html" target="_blank" title="走在科技前沿 Clorts未上市可充电的鞋子曝光"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp4.jpg"/></a></li>
                        <li><a href="http://www.8264.com/73723.html" target="_blank" title="ISPO BEIJING 2012 KAILAS展位攀登器材介绍"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp5.jpg"/></a></li>
<li><a href="http://www.8264.com/737230.html" target="_blank" title="ISPO BEIJING2012 VAUDE（沃得）展位视频讲解"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp6.jpg"/></a></li>
<li><a href="http://www.8264.com/73733.html" target="_blank" title="山林路（BOULEVARD）男款冲锋衣"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp7.jpg"/></a></li>
<li><a href="http://www.8264.com/73754.html" target="_blank" title="G-1000面料及新品"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp8.jpg"/></a></li>
<li><a href="http://www.8264.com/73729.html" target="_blank" title="一双可以两穿的溯溪鞋"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp9.jpg"/></a></li>
<li><a href="http://www.8264.com/73728.html" target="_blank" title="鲁滨逊王爵登山杖全新亮相"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp10.jpg"/></a></li>
<li><a href="http://www.8264.com/73722.html" target="_blank" title="朗界RG860户外三防手机"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp11.jpg"/></a></li>
<li><a href="http://www.8264.com/73734.html" target="_blank" title="将环保理念进行到底 SanSegal超轻包系列"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp12.jpg"/></a></li>
                        
                    </ul>
                    <div style="clear:both;"></div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
        <!--视频结束-->
        <!--博客花絮开始-->
        <div class="mid">
        	<div class="mid3_l">
            	<div class="mid3_l_title">驴友观展<a name="n6"></a></div>
                <div class="boke">
                    <!--//博客评论列表 24条 //-->
                    <!--[diy=bklist]--><div id="bklist" class="area"><div id="frames8esue" class=" frame move-span cl frame-1"><div id="frames8esue_left" class="column frame-1-c"><div id="frames8esue_left_temp" class="move-span temp"></div><?php block_display('3876'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
</div>
            <div class="mid3_r">
            	<div class="mid3_r_title">展会瞬间<a name="n8"></a></div>
                <div class="hxone">
                	<!--//花絮列表 3条 //-->
<!--[diy=hxlist]--><div id="hxlist" class="area"><div id="frameo4k4j4" class=" frame move-span cl frame-1"><div id="frameo4k4j4_left" class="column frame-1-c"><div id="frameo4k4j4_left_temp" class="move-span temp"></div><?php block_display('3877'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
            </div>
        	<div style="clear:both"></div>
        </div>
        <!--博客花絮结束-->
        <!--展台和往届回顾开始-->
        <div class="mid">
        	<div class="mid3_l">
            	<div class="mid3_l_title">网上展厅<a name="n2"></a></div>
                <div class="mid3_l_con">
                	<div class="mid3_l_con_one">
                        <div class="ztconall">
                            <!--虚拟展厅开始-->
                            <div class="ztcon" id="hhotcomment1" style="text-align:center; padding:10px 0;">
                                <a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/dall.jpg" width="585" height="350" border="0"/></a>
                            </div>
                            <!--虚拟展厅结束-->
                            <!--1号展厅-->
                            <div class="ztcon" style="display:none" id="hhotcomment2">
                                <div class="ztconimg"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/d1.jpg" /></a></div>
                                <div class="ztcon_r">
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-799129-1-1.html " target="_blank" title="展位A1.508"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/06/067ca75f07e29bc8daf2798531a7b14f.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-799188-1-1.html " target="_blank" title="展位A1.620"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/34/34af0f061ba5b8332bd0d4d6ecaca109.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-800688-1-1.html " target="_blank" title="展位A1.142"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c8/c8e33843d12b9a5b5d4c6d977ad73d1e.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-886439-1-1.html " target="_blank" title="展位A1.509"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/8a/8a31768baa473ab5045dbf155998f147.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-831314-1-1.html " target="_blank" title="展位A1.146"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/36/36185219f06458751547e9be37338f8a.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-802734-1-1.html " target="_blank" title="展位A1.511"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/2f/2ff2956d48346bdbfd0e4670bf872cfd.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-890460-1-1.html " target="_blank" title="展位A1.420"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/8a/8a3f19c62c43a31532a5d8da9dfd2ffc.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-877297-1-1.html " target="_blank" title="展位A1.136"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/47/47d9a392cf73761df66fe8db8b75eedc.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-1074696-1-1.html " target="_blank" title="展位A1.405"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/23/23937194c5e180d1f091e7babdbd313a.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-825526-1-1.html " target="_blank" title="展位A1.307"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f9/f959a9f109bae0f8bbe98991c3b8a4c5.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-831845-1-1.html " target="_blank" title="展位A1.206"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f3/f3127593553b4420b91afff27a55cb7b.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-880037-1-1.html " target="_blank" title="展位A1.207"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c8/c856d1925d15a31737b5836eb3724e1a.jpg"></a></div>
                                    
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--1号展厅结束-->
                            <!--2号展厅-->
                            <div class="ztcon" style="display:none" id="hhotcomment3">
                                <div class="ztconimg"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/d2.jpg" /></a></div>
                                <div class="ztcon_r">
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-800772-1-1.html " target="_blank" title="展位A2.502"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c7/c7fae000f2d0c6a5ddee4f944ed665c8.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-877153-1-1.html " target="_blank" title="展位A2.506"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/60/6015d359ed8dd1cced2e0b91dab59e99.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-800839-1-1.html " target="_blank" title="展位A2.408"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/80/80bdae0b3cc642138de2fd05e421b000.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-834858-1-1.html " target="_blank" title="展位A2.403"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/33/337c4d02302fc5b6c7708e0ba3314ca0.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-1129952-1-1.html " target="_blank" title="展位A2.306"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/bd/bdd9e5082096488d1dce05df58f40dea.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-820173-1-1.html " target="_blank" title="展位A2.305"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/3c/3c6c4e02465db91e4db0bf40c2577327.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-825388-1-1.html " target="_blank" title="展位A2.208"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/11/11018cbe16bc66039654303abeba099d.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-799344-1-1.html " target="_blank" title="展位A2.205"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/18/181c7eb7ce794b88e81ec0df6c9aedf3.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-801521-1-1.html " target="_blank" title="展位A2.102"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/cd/cd4d13c38d2d7885f45660292c9900bc.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-802589-1-1.html  " target="_blank" title="展位A2.106"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/6b/6bd27b90b4af0ac88deac913e5da0615.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-799222-1-1.html  " target="_blank" title="展位A2.108"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/26/262af4de8528628259ac9c6bb3ba386e.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-799156-1-1.html   " target="_blank" title="展位A2.108"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c2/c23d7495a40b74b7573c839da2e2d1bf.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-799131-1-1.html  " target="_blank" title="展位A2.210"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/4c/4cda895353f6f15ef70ba618b0785b75.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-829753-1-1.html " target="_blank" title="展位A2.203"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/57/5756e9402f909efb76bb525a1a4bbdfb.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--2号展厅结束-->
                            <!--3号展厅-->
                            <div class="ztcon" style="display:none" id="hhotcomment4">
                                <div class="ztconimg"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/d3.jpg" /></a></div>
                                <div class="ztcon_r">
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-807406-1-1.html " target="_blank" title="展位A3.206"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/55/55031f41a6c6481c1d001bf285ccd091.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-801379-1-1.html " target="_blank" title="展位A3.202"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/24/24772dd6c636d6052479957c01e19e9a.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-820061-1-1.html " target="_blank" title="展位A3.310"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/88/883f1efea8879feff1b3c71c0e641e8d.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-820184-1-1.html " target="_blank" title="展位A3.310"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/d9/d9202769059a4d9ea03a286432b660da.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799188-1-1.html " target="_blank" title="展位A3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/34/34af0f061ba5b8332bd0d4d6ecaca109.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-1049662-1-1.html " target="_blank" title="展位A3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/9d/9d4e79c33e72c3fd42bdeaef69cbc720.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799166-1-1.html " target="_blank" title="展位A3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/3b/3b3fdab5a2f17db9daa11764a2f19a14.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799128-1-1.html " target="_blank" title="展位A3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/7e/7e2a6f127bab6b1e17ca11f2ab13d4ce.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799110-1-1.html " target="_blank" title="展位A3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/ad/ad18507bc95b2b5b7696ebb0d1e5f46b.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799178-1-1.html " target="_blank" title="展位A3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/32/3262c7286e42a09dfc0fb6920ddfa9f8.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-802511-1-1.html " target="_blank" title="展位A3.305"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/77/7733e3ae377b9150db0eebd2c8a50e20.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-825457-1-1.html " target="_blank" title="展位A3.301"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/01/016c82efb75983d0e5d72e848f1cdba7.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-838604-1-1.html " target="_blank" title="展位A3.412"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/1b/1b72c12ccd1ca32157e743796e0ea47d.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-836621-1-1.html " target="_blank" title="展位A3.412"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/60/6041c6e5ddc778244ef69f4fe6e868a7.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-839252-1-1.html " target="_blank" title="展位A3.201"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/5a/5a5537623ba49951e3cc80ebc654f383.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799145-1-1.html " target="_blank" title="展位A3.102"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/da/dab65ac402878a610353950ab66ec203.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-808638-1-1.html " target="_blank" title="展位A3.308"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/2d/2d99f11db0b4896dd9dd1358a390535f.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-808633-1-1.html " target="_blank" title="展位A3.308"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/02/02a3681a74c858067589f50fbbe0cc3a.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-808639-1-1.html " target="_blank" title="展位A3.308"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f9/f91c423264bd41be1431fbf33acbd99b.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-800821-1-1.html " target="_blank" title="展位A3.402"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/ef/ef891ea4223f3955e02c3e38c022e6a3.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-872545-1-1.html " target="_blank" title="展位A3.207"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/61/611865afa58c03afb98e5ddc4c4f531e.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-829820-1-1.html " target="_blank" title="展位A3.207"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/a0/a031cc3f4517cd0ea3bcf8fc7b39c8fc.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-807443-1-1.html " target="_blank" title="展位A3.108"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/03/0328995b5c09f2cd390c6198b25273e5.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--3号展厅结束-->
                            <!--4号展厅-->
                            <div class="ztcon" style="display:none" id="hhotcomment5">
                                <div class="ztconimg"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/d4.jpg" /></a></div>
                                <div class="ztcon_r">
                                    
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-848961-1-1.html " target="_blank" title="展位A4.402"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/78/7855047181d57882d9aa014f32909391.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-1007350-1-1.html " target="_blank" title="展位A4.503"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/64/64cc27b54cd40df2151eadd5ccacc8d6.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-801554-1-1.html " target="_blank" title="展位A4.302"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/26/2684e1bdd20b42b3119eb877851c1dbe.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-801286-1-1.html " target="_blank" title="展位A4.302"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/66/669f344d01f92d1c7d107f057518c753.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-890607-1-1.html " target="_blank" title="展位A4.306"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/00/00953ed3f13b12156259ad0b97b2d0ca.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-811068-1-1.html " target="_blank" title="展位A4.308"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/90/90857862ec279112a99bfef8563d5da8.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-819947-1-1.html " target="_blank" title="展位A4.301"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/89/895f54a153edb8be8600c8ed92cad504.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-1109747-1-1.html " target="_blank" title="展位A4.301"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/11/11faf2f055a2b40e2053a919a086633d.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-801564-1-1.html " target="_blank" title="展位A4.301A"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/b6/b67d86098f60e577c1abf724182ff3fd.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-807454-1-1.html " target="_blank" title="展位A4.202"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/64/64567675de48952365b78d42a64fa382.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-830375-1-1.html " target="_blank" title="展位A4.206"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/1a/1a9acd44545e08ef8b278089fc58105c.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-806043-1-1.html " target="_blank" title="展位A4.208"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/96/9644d37d68133a23048e909cbe89953a.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-862654-1-1.html " target="_blank" title="展位A4.212"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/75/75cbf791d590527dcfbe61dd741884b1.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-949985-1-1.html " target="_blank" title="展位A4.102"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/83/83df5c73b779ec4d00351606ae73a165.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-1040187-1-1.html" target="_blank" title="展位A4.106"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/10/10f55450c96eee1b7cbe4db5a2e373d2.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-802747-1-1.html " target="_blank" title="展位A4.110"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f4/f4e22436ee090f427d2da9442f4bcb63.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-825630-1-1.html " target="_blank" title="展位A4.103"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/27/2708883d8a87131769b662198d89312c.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-872441-1-1.html  " target="_blank" title="展位A4.120"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c1/c1bfa898fda76b1fde1ab37c9210bc98.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-886651-1-1.html " target="_blank" title="展位A4.203"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c2/c2c357e282ca3fb250bba6ba6a6259c8.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--4号展厅结束-->
                            <!--B1/B2/B3展厅-->
                            <div class="ztcon" style="display:none" id="hhotcomment6">
                                <div class="ztconimg1"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/db.jpg" /></a></div>
                                <div class="ztcon_r1">
                                <div class="brandall"><a href="http://bbs.8264.com/thread-835056-1-1.html " target="_blank" title="展位B1.101"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/8a/8aaaad48fcf5d3351b680c13ff5da9f0.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-964835-1-1.html " target="_blank" title="展位B1.101"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/89/89a33cc59e1cbdff677decbfd5c9f0ec.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-833405-1-1.html " target="_blank" title="展位B1.107"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/97/9749995fbff0c1a08fb2eaf11cbe071d.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-839974-1-1.html " target="_blank" title="展位B2.102"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/a6/a61c0dfe1a32776acdde5c2a6de096e6.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-806844-1-1.html " target="_blank" title="展位B2.101"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/16/16ce993b76cbba09673b885dc847d1cb.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-849156-1-1.html " target="_blank" title="展位B2.106"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f5/f5c9402b1bc4ddb8c39d30ea77cd5699.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-890677-1-1.html " target="_blank" title="展位B2.110"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/ff/ffbb35baa17ee999fd07027b76a30242.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-886671-1-1.html " target="_blank" title="展位B2.120"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/22/2262b6aa3cdbab2cbd53146916e1b747.jpg"></a></div> 
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--B1/B2/B3展厅结束-->
                        </div>
                        <script language="javascript">
                function settHotph_2(i)
                {
                 selecttHot2(i);
                }
                function selecttHot2(i)
                {
                  for(var id = 1;id<=6;id++)
                 {
                  var bb="hhotcomment"+id;
                  if(id==i)
                  document.getElementById(bb).style.display="";
                  else
                  document.getElementById(bb).style.display="none";
                 } 
                  for(var id = 1;id<=6;id++)
                 {
                  var bb="hhotdiv"+id+"_2";
                  if(id==i)
                  document.getElementById(bb).className="zg";
                  else
                  document.getElementById(bb).className="zg1";
                 } 
                }
                </script>
                        <div class="ztr">
                            <div class="zg" id="hhotdiv1_2" onmouseover="settHotph_2(1);"><a href="javascript:void(0)" target="_self">展馆全景</a></div>
                            <div class="zg1" id="hhotdiv2_2" onmouseover="settHotph_2(2);"><a href="javascript:void(0)" target="_self">A1号馆</a></div>
                            <div class="zg1" id="hhotdiv3_2" onmouseover="settHotph_2(3);"><a href="javascript:void(0)" target="_self">A2号馆</a></div>
                            <div class="zg1" id="hhotdiv4_2" onmouseover="settHotph_2(4);"><a href="javascript:void(0)" target="_self">A3号馆</a></div>
                            <div class="zg1" id="hhotdiv5_2" onmouseover="settHotph_2(5);"><a href="javascript:void(0)" target="_self">A4号馆</a></div>
                            <div class="zg1" id="hhotdiv6_2" onmouseover="settHotph_2(6);"><a href="javascript:void(0)" target="_self">B1/B2/B3</a></div>
                            <div style="clear:both;"></div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div class="mid3_r">
            	<div class="mid3_r_title">往届回顾</div>
                <div class="mid3_r_con">
                	<ul>
                    	<li><a href="http://www.8264.com/topic/1346.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo6.jpg"></a><br><a href="http://www.8264.com/topic/1346.html" target="_blank">ispo china 2011专题</a></li>
<li><a href="http://www.8264.com/portal-topic-topicid-1301.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo1.jpg"></a><br><a href="http://www.8264.com/portal-topic-topicid-1301.html" target="_blank">ispo china 2010专题</a></li>
                        <li><a href="http://www.8264.com/topic/1215.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo2.jpg"></a><br><a href="http://www.8264.com/topic/1215.html" target="_blank">ispo china 2009专题</a></li>
                        <li><a href="http://www.8264.com/topic/1076.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo3.jpg"></a><br><a href="http://www.8264.com/topic/1076.html" target="_blank">ispo china 2008专题</a></li>
                        <li><a href="http://www.8264.com/topic/593.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo4.jpg" /></a><br>
                      <a href="http://www.8264.com/topic/593.html" target="_blank">ispo china 2007专题</a></li>
                    </ul>
              </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--展台和往届回顾结束-->
<!--展位图片开始-->
        <div class="mid">
        	<div class="title960">展位图片<a name="n10"></a></div>
            <div class="zwall">               
                <!--//展位图片 10条 //-->
                <!--[diy=zwtp]--><div id="zwtp" class="area"><div id="frame5arRTv" class=" frame move-span cl frame-1"><div id="frame5arRTv_left" class="column frame-1-c"><div id="frame5arRTv_left_temp" class="move-span temp"></div><?php block_display('3882'); ?></div></div></div><!--[/diy]-->
                <div style="clear:both"></div>
            </div>
        </div>
        <!--展位图片结束-->
        <!--美女开始-->
        <div class="mid">
        	<div class="title960">展会美女<a name="n9"></a></div>
            <div class="meinvall">
            	<div>
                	<div class="meinv_l"><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=1156476&amp;page=1#pid17234233" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/meinvd2.jpg"></a></div>
                    <div class="meinv_r">
                        <!--//美女上右侧 12条 //-->
                        <!--[diy=mvuplist]--><div id="mvuplist" class="area"><div id="frameNJXzx8" class=" frame move-span cl frame-1"><div id="frameNJXzx8_left" class="column frame-1-c"><div id="frameNJXzx8_left_temp" class="move-span temp"></div><?php block_display('3878'); ?></div></div></div><!--[/diy]-->
                        <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div>
                    <!--//美女下面一行 12条 //-->
                    <!--[diy=mvdownlist]--><div id="mvdownlist" class="area"><div id="framewc9NaI" class=" frame move-span cl frame-1"><div id="framewc9NaI_left" class="column frame-1-c"><div id="framewc9NaI_left_temp" class="move-span temp"></div><?php block_display('3879'); ?></div></div></div><!--[/diy]-->
<div style="clear:both;"></div>  
                </div>
            </div>
        </div>
        <!--美女结束-->
        <!--底部开始-->
        <div class="bottom"><a href="/template/8264/about/aboutus.htm" target="_blank">8264简介</a>&nbsp;|&nbsp;<a href="/template/8264/about/ggservice/index.html" target="_blank" style="color:#FF0000;">广告服务</a>&nbsp;|&nbsp;<a href="/list/531/" target="_blank">编辑部的故事</a>&nbsp;|&nbsp;<a href="/template/8264/about/sitemap.html" target="_blank">站点地图</a>&nbsp;|&nbsp;<a href="/template/8264/about/aboutus.htm" target="_blank">联系方式</a>&nbsp;|&nbsp;<a href="http://buy.8264.com/" target="_blank">户外网购</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/thread-457062-1-1.html" target="_blank" style="color:#FF0000;">QQ群联盟</a>&nbsp;|&nbsp;<a href="http://8.8264.com/job/" target="_blank">8264招聘</a>&nbsp;|&nbsp;<a href="/template/8264/about/link/link.htm" target="_blank">友情链接</a><br>服务热线：022-23708264&nbsp;|&nbsp;传真：022-23708323&nbsp;|&nbsp;地址：天津市新技术产业园华苑产业区华天道8号海泰信息广场C座1001号<br><a href="http://bx.8264.com" target="_blank" style="color:#53792e;">户外活动有风险，8264提醒您购买</a> <a href="http://bx.8264.com" style="color:#53792e;">户外保险</a><br>除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264&nbsp;版权所有   <a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-1</a></div>
        <!--底部结束-->
</div>
    
    
    
<!--dx代码开始-->  
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?><!--dx代码结束-->
    
</div>
<!--dx代码开始-->



<!--//waper结束//-->
<?php if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb">
<em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?></em>
<span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="关闭">关闭</a></span>
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
