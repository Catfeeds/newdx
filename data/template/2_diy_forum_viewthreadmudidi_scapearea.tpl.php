<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthreadmudidi_scapearea', 'common/header_8264_new');
0
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/8264/common/header_8264_new.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/default/common/simplesearchform.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/8264/forum/viewthread_node_2014.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/default/forum/mudidi_guide.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/default/forum/viewthread_nodebrand.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/default/forum/viewthread_fastpostbrand.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/default/forum/mudidi_footer.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/8264/common/footer_8264_new.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/8264/common/header_common.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/8264/common/index_ad_top.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/8264/forum/viewthread_node_body_2014.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/8264/forum/viewthread_node_body_2014.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
|| checktplrefresh('./template/default/forum/viewthreadmudidi_scapearea.htm', './template/8264/common/seditor_2014.htm', 1509517915, 'diy', './data/template/2_diy_forum_viewthreadmudidi_scapearea.tpl.php', './template/8264', 'forum/viewthreadmudidi_scapearea')
;?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
    <meta name="apple-itunes-app" content="app-id=492167976">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <link rel="dns-prefetch" href="http://stats.8264.com/">
<title>
<?php if(isset($forumOption)) { ?><?php $forumOption->initPageTitle(); } if($pageTitle) { ?><?php echo $pageTitle; } elseif($_G['basescript']=='portal' && $_G['gp_mod']=='list' && $metakeywords && $_G['catid']!=874 ) { if($_G['catid']==878) { ?>
户外美女图片_驴友图片_最健康的户外美女照片
<?php } else { ?>
            <?php echo $metakeywords;?>
            <?php if($_G['setting']['bbname']) { ?> - <?php echo $_G['setting']['bbname'];?><?php } } } else { ?>
            <?php if($_GET['do']=="produce"&&$_G['uid']) { ?>
               <?php echo $navtitle;?><?php echo "的装备分享"; ?>             <?php } elseif($_G['basescript']=='group') { if($_G['uid']) { ?>
<?php echo $navtitle;?>
<?php } else { ?><?php $navtitle ='群组 - 8264'; ?><?php echo $navtitle;?>
<?php } } else { ?><?php $navtitle = preg_replace('/的记录/', '的微博', $navtitle); if(!empty($topic['title'])) { ?><?php echo $topic['title'];?><?php } if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if($_G['setting']['bbname']) { ?><?php echo $_G['setting']['bbname'];?><?php } ?>
            <?php } } ?>
</title>
<?php echo $_G['setting']['seohead'];?>
    <meta name="keywords" content="<?php if(!empty($metakeywords)) { ?> <?php echo htmlspecialchars($metakeywords, ENT_COMPAT | ENT_HTML401, GB2312); ?> <?php } ?>" />
<meta name="description" content="<?php if(!empty($metadescription)) { ?> <?php echo htmlspecialchars($metadescription, ENT_COMPAT | ENT_HTML401, GB2312); ?>,<?php echo $_G['setting']['bbname'];?> <?php } ?>" />
<meta name="author" content="8264.com" />
<meta name="copyright" content="2001-2010" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<?php if($_G['basescript']=='portal') { if($_G['gp_mod']=='list') { if($_G['catid'] == '849') { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/topic">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/list/<?php echo $_G['catid'];?>">
<?php } } elseif($_G['gp_aid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/viewnews-<?php echo $_G['gp_aid'];?>-page-1.html">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/">
<?php } } elseif($_G['basescript']=='forum') { if($_G['gp_mod']=='viewthread' && $_G['tid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/thread-<?php echo $_G['tid'];?>-<?php echo $page;?>.html">
<?php } elseif($_G['fid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/bbs-<?php echo $_G['fid'];?>-1.html">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/bbs">
<?php } ?>
        <?php } elseif($_G['basescript']=='dianping') { if($_G['url_mod'] && $_G['tid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/<?php echo $_G['url_mod'];?>/<?php echo $_G['tid'];?>.html">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/<?php echo $_G['url_mod'];?>/">
<?php } } if(isset($forumOption)) { ?><?php $flag = $forumOption->getSiteUrlbyUrl($_G['siteurl']); if(($flag==1)) { ?><?php $_G['siteurl'] = "http://bbs.8264.com/"; } else { ?><?php $_G['siteurl'] = $_G['siteurl']; } } ?>
<base href="<?php echo $_G['siteurl'];?>" />
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/common.css?<?php echo VERHASH;?>" />
<script type="text/javascript">
var STYLEID = '<?php echo STYLEID;?>',
STATICURL = '<?php echo STATICURL;?>',
IMGDIR = 'http://static.8264.com/static/image/common',
VERHASH = '<?php echo VERHASH;?>',
charset = '<?php echo CHARSET;?>',
discuz_uid = '<?php echo $_G['uid'];?>',
cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>',
cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>',
cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>',
showusercard = '<?php echo $_G['setting']['showusercard'];?>',
attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>',
disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>',
creditnotice = '<?php if($_G['setting ']['creditnotice ']) { ?><?php echo $_G;?>['setting ']['creditnames ']<?php } ?>',
defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>',
REPORTURL = '<?php echo $_G['currenturl_encode'];?>',
SITEURL = '<?php echo $_G['siteurl'];?>';
</script>
<script src="http://static.8264.com/static/js/common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<style>
/* 头部广告文字 */
.textAdBox { float: left; width: 978px; border: 1px solid #f0f0f0; border-bottom: 0 none; overflow: hidden; }
.textAdBox ul { float: left; width: 100%; margin-left: -1px; }
.textAdBox ul li { float: left; width:20%; padding: 4px 0; border-bottom: 1px solid #f0f0f0; }
.textAdBox a { display: block; font-size:12px; line-height:24px; font-family: "Microsoft Yahei"; height: 24px; color: #585858; text-align: center; border-left: 1px dashed #d6d6d6; overflow: hidden; }
.textAdBox a:hover { color: #162833; }
.textAdBox .cRed,
.textAdBox .cRed:hover { color: #ff0000; }
.layout:after,
.hd:after,
.bd:after,
.ft:after,
.layoutLeft:after,
.layoutRight:after,
.w980:after { content: ""; display: block; clear: both; visibility: hidden; }
.layout,
.hd,
.bd,
.ft,
.layoutLeft,
.layoutRight,
.w980 { zoom: 1; }
/* 论坛首页 Start */
.layout { width: 980px; margin: 0 auto; }
.layoutLeft { float: left; display: inline; width: 660px; }
.layoutRight { float: right; display: inline; width: 260px; }
.w980 { width: 980px; margin: 0 auto; }
.oldad .textAdBox{width: 100%;}
.wp .oldad{width: 98%;}

/* 头部广告文字 */
.a_t #textadbox_old { border: 1px solid #cdcdcd; border-bottom: 0 none; overflow: hidden; width:100%; float:none;}
.a_t #textadbox_old ul {  width: 100%; margin-left: -1px; }
.a_t #textadbox_old ul li { float: left; width: 20%; padding:0px; border-bottom: 1px solid #cdcdcd }
.a_t #textadbox_old a { display: block; font: 14px; font-family: Tahoma,Helvetica,SimSun,sans-serif,Hei; height: 28px; color: #333; text-align: center; border-left: 1px solid #cdcdcd; overflow: hidden; line-height: 28px;}
.a_t #textadbox_old a:hover { color: #162833; }
.a_t #textadbox_old .cRed,
.a_t #textadbox_old .cRed:hover { color: #ff0000; }
</style>
<?php if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?><?php echo $rsshead;?><?php } if($_G['basescript'] == 'forum') { ?>
<script src="http://static.8264.com/static/js/forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="http://static.8264.com/static/js/home.js?<?php echo VERHASH;?>" type="text/javascript" ></script>

<?php } elseif($_G['basescript'] == 'portal') { ?>
<script src="http://static.8264.com/static/js/portal.js?<?php echo VERHASH;?>" type="text/javascript" ></script>
<?php } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<script src="http://static.8264.com/static/js/portal.js?<?php echo VERHASH;?>" type="text/javascript" ></script>
<?php } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/diy.css?<?php echo VERHASH;?>" />
<?php } ?><?php $user_IP = ($_SERVER["HTTP_CDN_SRC_IP"]); ?><style type="text/css">
.textAdBox ul { width:980px; overflow:hidden; }
.textAdBox ul li { width:196px; }
</style>
<!--[if lt ie 9]>
    <style type="text/css">
    .card-box input[type="checkbox"]{opacity:1!important; filter:alpha(opacity=100)!important;}
    .card-box .input-hack{display:none;}
    </style>
    <![endif]-->
<link href="http://static.8264.com/static/css/common/reset.css" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/common_head_bottom.css" rel="stylesheet" type="text/css">
<!--[if IE 6]>
<script src="http://static.8264.com/static/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript" type="text/javascript"></script>
<script>var timer_showmsg = null;</script>
<script src="http://static.8264.com/static/js/common_head_bottom.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<?php if($_G['fid'] == 433 || $identifier == 'whither') { ?>
<script>
//统计旧版目的地
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?2d3beaebd73cbb25bb5cfb5c1c9c0c37";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
<?php } elseif(($_G['fid']==489 || $_GET['fid']==489 || $_G['fid']==500 || $_GET['fid']==500)) { ?>
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "//hm.baidu.com/hm.js?022bd0feae65e018f92448fc5e4517d8";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script>
<?php } ?>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" style="z-index:9999" href="javascript:openDiy();" title="打开 DIY 面板"><img src="http://static.8264.com/static/image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } ?>
    <!--头部广告处理--><div>
<?php if($isShouYe == "index") { ?>    
<!--头部弹出开始-->
<script type="text/javascript">
jQuery(function(){
setTimeout(function(){jQuery("#adtopbig").hide();jQuery("#adtop_r").show();},7000);
jQuery("#close_top").click(function(){
jQuery("#adtopbig").hide();
jQuery("#adtop_r").show();
});
});
</script>
<style>
.adtop{ width:1100px; height:300px; position:relative; margin:0 auto;}
.close_top{ width:79px; height:37px; position:absolute; bottom:-7px; right:-7px; cursor:pointer;}
.adtop_r{ width:1100px; height:50px; display:none; margin:0 auto; position:relative;}
</style>
<div class="adtop" id="adtopbig">
<!-- 首页顶部弹窗（大）-->
<script type='text/javascript'><!--//<![CDATA[
           var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
           var m3_r = Math.floor(Math.random()*99999999999);
           if (!document.MAX_used) document.MAX_used = ',';
           document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
           document.write ("?zoneid=10");
           document.write ('&amp;cb=' + m3_r);
           if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
           document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
           document.write ("&amp;loc=" + escape(window.location));
           if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
           if (document.context) document.write ("&context=" + escape(document.context));
           if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
           document.write ("'><\/scr"+"ipt>");
        //]]>--></script>
<span class="close_top" id="close_top"><img width="79" height="37" border="0" src="http://static.8264.com/static/images/moban/indexnew/images/close.gif" /></span>
    <span style="width:26px; height:13px; position:absolute; bottom:0px; left:0px; font-size:0px; line-height:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
</div>
<div class="adtop_r" id="adtop_r">
<!--首页顶部弹窗（小）-->
<script type='text/javascript'><!--//<![CDATA[
           var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
           var m3_r = Math.floor(Math.random()*99999999999);
           if (!document.MAX_used) document.MAX_used = ',';
           document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
           document.write ("?zoneid=1");
           document.write ('&amp;cb=' + m3_r);
           if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
           document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
           document.write ("&amp;loc=" + escape(window.location));
           if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
           if (document.context) document.write ("&context=" + escape(document.context));
           if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
           document.write ("'><\/scr"+"ipt>");
        //]]>--></script>
<span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px; line-height:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
</div>
<!--头部弹出结束-->	
<?php } ?>
</div><!--头部广告处理 end-->
<div class="headerNav">
<div class="layout" id="heardnew">
<div class="logo">
<a href="<?php echo $_G['config']['web']['portal'];?>">
<img src="http://static.8264.com/static/image/common/bbs_logo.png" alt="8264" titile="8264" />
</a>
</div>
<ul class="nav">
<li>
<a href="<?php echo $_G['config']['web']['portal'];?>list/238/" class="topLink">知识</a>
<dl>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>list/751/" class="first">业界资讯</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['forum'];?>forum-12-1.html" class="first">户外大厅</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>list/238/">知识</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>list/204/">户外装备</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>topic_list/" class="last">专题</a>
</dd>
</dl>
</li>
<li>
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei.html" class="topLink">点评</a>
<dl>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei.html" class="first">户外用品</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>pinpai">品牌</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>dianpu">户外店</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>xuechang">滑雪场</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>shanfeng">山峰</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>xianlu">线路</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>panpa/">攀爬</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>qianshui/">潜水点</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>diaoyu/">钓鱼场地</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>julebu/">户外俱乐部</a>
</dd>
                        <dd>
<a href="<?php echo $_G['config']['web']['portal'];?>kezhan/" class="last">旅舍客栈</a>
</dd>
</dl>
</li>
<li>
<a href="<?php echo $_G['config']['web']['forum'];?>" class="topLink">论坛</a>
<dl>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>list/871/" class="first">精选</a>
</dd>
                        <dd>
<a href="<?php echo $_G['config']['web']['portal'];?>youji/?from=bbstop">游记</a>
</dd>
                        <dd>
<a href="<?php echo $_G['config']['web']['portal'];?>wenda/?from=bbstop">问答</a>
</dd>
                        <dd>
<a href="http://www.8264.com/list/842">每日一图</a>
</dd>
                        <dd>
<a href="http://www.8264.com/pp">铿锵玫瑰</a>
</dd>
                        <dd>
<a href="http://www.8264.com/list/912">户外摄影师</a>
</dd>
                        <dd>
<a href="http://www.8264.com/list/880" class="last">勇者先行</a>
</dd>
</dl>
</li>
                <li class="wan" style="width:82px;" id="schoolpoplink"><a href="http://www.8264.com/xuexiao/?from=indexnavtop" class="topLink topLink_w_bg wkuan" target="_blank">户外学校</a><div class="navschoolpop"><img src="http://static.8264.com/static/image/common/xuexiaopop.png"></div></li>
                <li>
                	<a href="http://hd.8264.com/?from=bbstop" class="topLink" target="_blank">活动</a>
                    <dl>
                        <dd>
<a href="http://bbs.8264.com/forum-161-1.html" class="first last" target="_blank">结伴</a>
</dd>

</dl>
                </li>
        <li class="wan" style="width:67px;"><a href="http://www.8264.net/?from=top" class="topLink topLink_w_bg wkuan" target="_blank">值得买</a></li>
<li class="wan"><a href="http://bx.8264.com/?bbsbxnew" class="topLink topLink_w_bg wkuan" target="_blank">保险</a></li>
</ul>
<?php if($_G['uid']) { ?>
<ul class="head_login_info">
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1']; ?>
<li id="usermessagetips" style="z-index:21;"  class="notHover"><?php $counts= $_G[member][newprompt]+$_G[member][newpm]; ?><a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice" class="head_login_icon24_24 nohover"><span class="newimg <?php if($counts==0) { ?>nimg<?php } ?>"><?php if($counts>99) { ?>99+<?php } else { ?><?php echo $counts;?><?php } ?><i></i></span></a>
</li>
<li>
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="head_login_icon24_24 tx"><?php echo avatar($_G[uid], 'small', false, false, false, '', true); ?></a>
<div class="myidnamewarpten"  style="display:none;">
<div class="myidname clearfix">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>"><?php echo $_G['username'];?></a>
<?php if($_G['member']['extcredits5']) { ?>
<a href="<?php echo $_G['config']['web']['forum'];?>forum.php?mod=forumdisplay&fid=483" class="bicon" target="_blank" title="你现在有<?php echo $_G['member']['extcredits5'];?>枚8264币，点此去兑换礼品">
<?php } else { ?>
<a href="<?php echo $_G['config']['web']['forum'];?>forum.php?mod=viewthread&tid=1641700" class="bicon" target="_blank" title="您现在暂无8264币，点击教您如何赚取">
<?php } ?><?php echo $_G['member']['extcredits5'];?>枚
</a>
</div>
<ul class="myidcz">
<li><a class="wdtz" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-uid-<?php echo $_G['uid'];?>-do-thread-view-me-from-space.html">我的帖子</a></li>
<li><a class="wdxc" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-uid-<?php echo $_G['uid'];?>-do-album-view-me.html">我的相册</a></li>
<li><a class="myLog" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-uid-<?php echo $_G['uid'];?>-do-blog-view-me-from-space.html">我的日志</a></li>
<li><a class="myFriend" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-uid-<?php echo $_G['uid'];?>-do-friend.html">我的关注</a></li>
<li><a class="sc" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-do-favorite.html">我的收藏</a></li>
<li><a class="myrenwu" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-task-item-new.html">我的任务</a></li>
<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?>
<li><a class="myDoor" target="_blank" href="<?php echo $_G['config']['web']['portal'];?>portal.php?mod=portalcp">门户管理</a></li>
<?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?>
<li><a class="myCenter" target="_blank" href="<?php echo $_G['config']['web']['forum'];?>admin.php">管理中心</a></li>
<?php } ?>
<li><a class="myAccount" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-setting.html">账户管理</a></li>
<li><a class="myQuit" href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a></li>
</ul>
</div>
</li>
</ul>
<?php } else { ?>
<ul class="noLogin">
<li><a href="<?php echo $_G['config']['web']['forum'];?>member.php?mod=logging&action=login" onClick="showWindow('login', this.href);hideWindow('register');" class="loginIco">登录</a></li>
<li><a href="<?php echo $_G['config']['web']['forum'];?>member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href);hideWindow('login');" href="" class="regIco"><?php echo $_G['setting']['reglinkname'];?></a></li>
</ul>
<?php } ?>
<div class="searchTopNav">
<form id="scform" autocomplete="off" action="http://so.8264.com/cse/search" target="_blank">
<input type="hidden" name="s" value="9963133823733045431" />
<?php if(CURSCRIPT == 'forum') { ?><input type="hidden" name="nsid" value="2" /><?php } if(CURSCRIPT == 'question') { ?><input type="hidden" name="nsid" value="4" /><?php } ?>
<span id="searchTips" class="tips">搜索</span>
<input id="searchText" class="text" type="text" value="" name="q"/>
<input class="subButton" type="submit" value=""/>
</form>
</div>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; ?>
<div id="wp">
<!-- 手机绑定提示 -->
<?php if($_G['uid'] && !$_G['member']['telstatus']) { ?>
<style type="text/css">.realName{background-color:#fff2e5;box-shadow:0 0 1px #f5e2cf inset}.realName__container{width:980px;margin:0 auto;position:relative}.realName__close{position:absolute;right:0;overflow:hidden;top:22px}.realName__close--button{width:15px;height:15px;background:url(http://static.8264.com/static/images/close.png) no-repeat;text-indent:-99em;display:block}.realName__content{padding:15px 0;text-align:center}.realName__text{color:#4b3627;font-size:14px;background:url(http://static.8264.com/static/images/sos.png) no-repeat 0 50%;padding-left:30px}.realName__button--binding{display:inline-block;width:82px;height:28px;line-height:28px;border-radius:14px;font-size:14px;background-color:#ff5e33;color:#fefefe;box-shadow:0 4px 10px rgba(255,94,51,.44);margin-left:10px}.realName__button--binding:hover{color:#fefefe;text-decoration: none;}</style>
<div class="realName">
<div class="realName__container">
<div class="realName__close">
<a href="javascript:void(0);" class="realName__close--button">x</a>
</div>
<div class="realName__content">
<span class="realName__text">根据国家相关规定，发帖等操作需先完成手机号绑定！</span>
<a href="http://u.8264.com/home-setting.html#account-security" class="realName__button--binding">去绑定</a>
</div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
$('.realName__close').bind('click', function(event) {
$(this).parents('.realName').hide()
});
});
</script>
<?php } ?>
<!-- //手机绑定提示 -->
<link rel="stylesheet" href="/source/plugin/whither/css/main.css?3" />
<script src="http://www.8264.com/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
</script>
<script type="text/javascript">var fid = parseInt('<?php echo $_G['fid'];?>'), tid = parseInt('<?php echo $_G['tid'];?>');</script>
<?php if($modmenu['thread'] || $modmenu['post']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>

<script src="<?php echo $_G['setting']['jspath'];?>forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">zoomstatus = parseInt(<?php echo $_G['setting']['zoomstatus'];?>);var imagemaxwidth = '<?php echo IMAGEMAXWIDTH;?>';var aimgcount = new Array();</script>

<div style="overflow:hidden;padding-bottom:5px;height:35px;overflow:hidden;width:100%;"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="搜索本版">搜索本版</label></li>
EOF;
?><?php } if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><input type="radio" id="mod_article" class="pr" name="mod" value="portal"
EOF;
 if(CURSCRIPT == 'portal') { 
$slist[portal] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[portal] .= <<<EOF
 /><label for="mod_article" title="搜索文章">文章</label></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><input type="radio" id="mod_thread" class="pr" name="mod" value="forum"
EOF;
 if(CURSCRIPT == 'forum' && !$_G['fid']) { 
$slist[forum] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[forum] .= <<<EOF
 /><label for="mod_thread" title="搜索{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
EOF;
?><?php } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><input type="radio" id="mod_blog" class="pr" name="mod" value="blog"
EOF;
 if(CURSCRIPT == 'home' && $do != 'album') { 
$slist[blog] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[blog] .= <<<EOF
 /><label for="mod_blog" title="搜索日志">日志</label></li>
EOF;
?><?php } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><input type="radio" id="mod_album" class="pr" name="mod" value="album"
EOF;
 if(CURSCRIPT == 'home' && $do == 'album') { 
$slist[album] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[album] .= <<<EOF
 /><label for="mod_album" title="搜索相册">相册</label></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><input type="radio" id="mod_group" class="pr" name="mod" value="group"
EOF;
 if(CURSCRIPT == 'group' || $_G['basescript']=='group') { 
$slist[group] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[group] .= <<<EOF
 /><label for="mod_group" title="搜索{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="搜索用户">用户</label></li>
EOF;
?>
<?php if($slist) { ?>
<div id="sc" class="y">
<form id="scform" method="post" autocomplete="off" onsubmit="searchFocus($('srchtxt'))" action="<?php echo $_G['siteurl'];?>search.php?searchsubmit=yes" target="_blank">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<table cellspacing="0" cellpadding="0">
<tr>
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">搜索</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="请输入搜索内容" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">搜索</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?><div class="z" style="line-height:30px;"><?php echo $forumoption_mudidi->getBreadcrumbNavByTid($_G['tid']); ?></div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_top'])) echo $_G['setting']['pluginhooks']['viewthread_top']; ?>

<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="wp cl">
<?php if($_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
<ul class="p_pop" id="newspecial_menu" style="display: none">
<?php if(!$_G['forum']['allowspecialonly']) { ?><li><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>">发表帖子</a></li><?php } if($_G['group']['allowpostpoll']) { ?><li class="poll"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">发起投票</a></li><?php } if($_G['group']['allowpostreward']) { ?><li class="reward"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">发布悬赏</a></li><?php } if($_G['group']['allowpostdebate']) { ?><li class="debate"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">发起辩论</a></li><?php } if($_G['group']['allowpostactivity']) { ?><li class="activity"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=4">发起活动</a></li><?php } if($_G['group']['allowposttrade']) { ?><li class="trade"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=2">出售商品</a></li><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<li class="popupmenu_option"<?php if($_G['setting']['threadplugins'][$tpid]['icon']) { ?> style="background-image:url(<?php echo $_G['setting']['threadplugins'][$tpid]['icon'];?>)"<?php } ?>><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a></li>
<?php } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<li class="popupmenu_option"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;sortid=<?php echo $id;?>"><?php echo $threadsorts;?></a></li>
<?php } } } ?>
</ul>
<?php } if($modmenu['post']) { ?>
<div id="mdly" class="fwinmask" style="display:none;">
<table cellspacing="0" cellpadding="0" class="fwin">
<tr>
<td class="t_l"></td>
<td class="t_c"></td>
<td class="t_r"></td>
</tr>
<tr>
<td class="m_l">&nbsp;&nbsp;</td>
<td class="m_c">
<div class="f_c">
<div class="c">
<h3>选中&nbsp;<strong id="mdct" class="xi1"></strong>&nbsp;篇: </h3>
<?php if($_G['forum']['ismoderator']) { if($_G['group']['allowwarnpost']) { ?><a href="javascript:;" onclick="modaction('warn')">警告</a><span class="pipe">|</span><?php } if($_G['group']['allowbanpost']) { ?><a href="javascript:;" onclick="modaction('banpost')">屏蔽</a><span class="pipe">|</span><?php } if($_G['group']['allowdelpost']) { ?><a href="javascript:;" onclick="modaction('delpost')">删除</a><span class="pipe">|</span><?php } if($_G['group']['allowstickreply']) { ?><a href="javascript:;" onclick="modaction('stickreply')">置顶</a><span class="pipe">|</span><?php } } if($_G['forum_thread']['pushedaid'] && $allowpostarticle) { ?><a href="javascript:;" onclick="modaction('pushplus', '', 'aid=<?php echo $_G['forum_thread']['pushedaid'];?>', 'portal.php?mod=portalcp&ac=article&op=pushplus')">文章连载</a><span class="pipe">|</span><?php } ?>
</div>
</div>
</td>
<td class="m_r"></td>
</tr>
<tr>
<td class="b_l"></td>
<td class="b_c"></td>
<td class="b_r"></td>
</tr>
</table>
</div>
<?php } ?>

<div id="postlist" class="pl" style="overflow:hidden;">
<div class="container"><?php $scapeareaData = $forumoption_mudidi->getScapeareaByTid($_G['tid']); ?><?php $postcount = 0; if(is_array($postlist)) foreach($postlist as $i => $post) { if($post['first']) { ?><?php $mudidiData = $post; ?><div class="mudidi_view_top"></div>
<div class="mudidi_view">
<div class="mudidi_box">
<h4>
<span style="float:right; font-size:12px; font-weight:normal; padding-top:11px;">
<a href="javascript:void();" class="mudidiPostMessageMore link_blue">显示全部</a>
</span>
<?php echo $post['subject'];?>
<span style="font-size:12px; font-weight:normal; padding-left:8px;">
<?php if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>
<a class="" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_G['gp_modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<?php } else { ?>编辑</a><?php } } if($_G['group']['allowdelpost']) { ?><?php $modopt++ ?><span class="pipe">|</span><a href="javascript:;" onclick="modthreads(3, 'delete')">删除</a><?php } ?>
</span>
</h4>

<div class="info">
<div id="mudidiPostMessageMini"><?php $mini_message = messagecutstr($post['message'], 250); ?><?php $mini_message = preg_replace('/(\s|　)+/', '', $mini_message); ?><?php echo $mini_message;?>
</div>
<div id="mudidiPostMessage" style="display:none;">
<?php echo $post['message'];?>
</div>
<p style="text-align:right;padding-right:3px;">
<a href="javascript:void();" class="mudidiPostMessageMore mudidiPostMessageMoreBottom link_blue" style="display:none;">显示全部</a>
</p>
</div>

<script type="text/javascript">
;(function($){
<?php if(strlen($post['message']) <= 1000) { ?>
$('#mudidiPostMessageMini').hide();
$('#mudidiPostMessage').show();
$('.mudidiPostMessageMore').text('关闭全部').hide();
<?php } else { ?>
function toggleMudidiPostMessage() {
if ($('#mudidiPostMessageMini').css('display') != 'none') {
$('#mudidiPostMessageMini').hide();
$('#mudidiPostMessage').show();
$('.mudidiPostMessageMore').text('关闭全部');
$('.mudidiPostMessageMoreBottom').show();
} else {
$('#mudidiPostMessageMini').show();
$('#mudidiPostMessage').hide();
$('.mudidiPostMessageMore').text('显示全部');
$('.mudidiPostMessageMoreBottom').hide();
}
return false;
}
$('.mudidiPostMessageMore').click(toggleMudidiPostMessage);
$('.mudidiPostMessageMoreBottom').click(function(){
$(document).scrollTop(220);
});
<?php } ?>
})(jQuery);
</script>
<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>

</div>
<div class="mudidi_box"><?php $mudidiInfoList = $forumoption_mudidi->getSubScapeByTid($_G['tid'], 20); ?><?php $detailScapeNum = 0; ?><div class="mudidi_info_detail_show"><?php if(is_array($mudidiInfoList)) foreach($mudidiInfoList as $i => $scape) { if($detailScapeNum == 3) { ?><?php break; } ?>
<p class="row">
<strong><a href="/thread-<?php echo $scape['tid'];?>-1-1.html"><?php echo $scape['name'];?></a> </strong>
<span class="quotes_begin">
<span class="quotes_end"><?php $str = messagecutstr($scape['message'], 75); ?><?php $str = preg_replace('/^[　]+|\s+/', '', $str); ?><?php $str = preg_replace('/^暂无相关内容$/', '', $str); ?><?php $str = str_replace('　', '', $str); ?><?php echo $str; ?></span>
</span>
</p><?php unset($mudidiInfoList[$i]); ?><?php ++$detailScapeNum; } ?>
</div>

<?php if($mudidiInfoList) { ?>
<div class="info scapeList" style="height:22px;overflow:hidden;position:relative;padding-right:55px;">
<div class="more" style="position:absolute;top:3px;right:2px;font-size:12px;text-align:right;width:55px;height:22px;overflow:hidden;">
<a href="/whither-scapelist-<?php echo $_G['tid'];?>-1.html" style="float:none;margin:0;" class="link_blue">更多景点</a>
</div><?php if(is_array($mudidiInfoList)) foreach($mudidiInfoList as $i => $scape) { ?><a href="/thread-<?php echo $scape['tid'];?>-1-1.html" style="margin-right:10px;"><?php echo $scape['name'];?></a>
<?php } ?>
</div>
<?php } ?>

</div>
</div><?php break; } ?>

<div id="post_<?php echo $post['pid'];?>"><div class="lxch_new clboth" id="post_<?php echo $post['pid'];?>">
<div id="pid<?php echo $post['pid'];?>"><?php $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']); ?><?php
$authorverifys = <<<EOF


EOF;
 if($_G['setting']['verify']['enabled']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && $post['verify'.$vid] == 1) { 
$authorverifys .= <<<EOF

<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid={$vid}" target="_blank">
EOF;
 if($verify['icon']) { 
$authorverifys .= <<<EOF
<img src="{$verify['icon']}" class="vm" alt="{$verify['title']}" title="{$verify['title']}" />
EOF;
 } else { 
$authorverifys .= <<<EOF
{$verify['title']}
EOF;
 } 
$authorverifys .= <<<EOF
</a>&nbsp;

EOF;
 } } } 
$authorverifys .= <<<EOF


EOF;
?>

<div class="lxch_l">
<?php echo $post['newpostanchor'];?> <?php echo $post['lastpostanchor'];?>
<?php if($post['authorid'] && $post['username'] && !$post['anonymous']) { if($_G['setting']['authoronleft']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="name_id_new" rel="nofollow"><?php echo $post['author'];?></a><?php echo $authorverifys;?>
<?php } } ?>

<div class="t_img_new" id="uboxbtn_<?php echo $post['pid'];?>" style="z-index:2;">
<?php if($_G['setting']['bannedmessages'] & 2 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || ($post['status'] & 1))) { ?>
<!--<span>头像被屏蔽</span>--><?php echo avatar(0); } elseif($post['avatar'] && $showavatars) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank"  rel="nofollow"><?php echo avatar($post['authorid']); ?></a>
<div class="lctx_t" id="ubox_<?php echo $post['pid'];?>">
<div class="lctx_tcon">
<div class="lctx_tcon_n">
<div class="cltx_head clboth">
<div class="cltxbox"><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" rel="nofollow"><?php echo avatar($post['authorid'], small); ?></a></div>
<div class="clnameinfo">
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="name" rel="nofollow"><?php echo $post['author'];?></a>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;gid=<?php echo $post['groupid'];?>" target="_blank" rel="nofollow"><?php echo $post['authortitle'];?></a>
<?php if($post['medals']) { ?>
<span class="riicon"><?php if(is_array($post['medals'])) foreach($post['medals'] as $medal) { ?><img src="http://static.8264.com/static/image/common/<?php echo $medal['image'];?>" alt="<?php echo $medal['name'];?>" title="<?php echo $medal['name'];?>" />
<?php } ?>
</span>
<?php } ?>
</div>
</div>
<div class="ueser_forum_info">
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=thread&amp;type=thread&amp;view=me&amp;from=space" rel="nofollow">主题<span><?php echo $post['threads'];?></span></a>
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=thread&amp;type=reply&amp;view=me&amp;from=space" rel="nofollow">回帖<span><?php echo $post['posts'];?></span></a>
<!--						<a href="forum.php?mod=viewthread&amp;tid=1641700">8264币<span><?php echo $post['extcredits5'];?></span></a>-->
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=friend" class="withoutb_r" rel="nofollow">关注<span><?php echo $post['friends'];?></span></a>
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=friend&amp;view=fans" class="withoutb_r" rel="nofollow">粉丝<span><?php echo $post['fans'];?></span></a>
</div>
<div class="send_friend clboth">
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $post['authorid'];?>&amp;touid=<?php echo $post['authorid'];?>&amp;pmid=0&amp;daterange=2&amp;pid=<?php echo $post['pid'];?>" onclick="hideMenu('userinfo<?php echo $post['pid'];?>');showWindow(<?php if(!$_G['uid']) { ?>'login','member.php?mod=logging&action=login'<?php } else { ?>'sendpm', this.href<?php } ?>)" title="发短消息" class="send">发短信</a>
<div class="update_ucache" id="updateuserinfo_<?php echo $post['pid'];?>"><a href="javascript:;" onclick="ajaxget('plugin.php?id=api:userinfoupdate&uid=<?php echo $post['authorid'];?>' ,'updateuserinfo_<?php echo $post['pid'];?>');">刷新缓存</a></div>
<?php if($post['authorid'] != $_G['uid']) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>&amp;handlekey=addfriendhk_<?php echo $post['authorid'];?>" id="a_friend_li_<?php echo $post['pid'];?>" onclick="showWindow(<?php if(!$_G['uid']) { ?>'login','member.php?mod=logging&action=login'<?php } else { ?>this.id, this.href, 'get', 1, {'ctrlid':this.id,'pos':'00'}<?php } ?>);" class="friend">关注</a>
<?php } ?>
</div>
</div>
</div>
</div>
<?php } ?>
</div>

<?php if($post['medals']) { ?>
<span class="hzicon_1"><?php if(is_array($post['medals'])) foreach($post['medals'] as $medal) { ?><img src="http://static.8264.com/static/image/common/<?php echo $medal['image'];?>" alt="<?php echo $medal['name'];?>" title="<?php echo $medal['name'];?>" /><?php } ?>
</span>
<?php } if($post['extcredits5']) { ?><a href="forum.php?mod=viewthread&amp;tid=1641700" class="info_new orangelink">8264币 <i class="orange"><?php echo $post['extcredits5'];?></i> <?php echo $_G['setting']['extcredits']['5']['unit'];?></a><?php } ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=thread&amp;type=reply&amp;view=me&amp;from=space" target="_blank" class="info_new alink" rel="nofollow">发帖：<?php echo $post['threads']+$post['posts']; ?> 帖</a>
<span class="info_new">在线：<?php echo $post['oltime'];?> 小时</span>
<span class="info_new">注册：<?php echo $post['regdate'];?></span>

<?php if($_G['group']['allowedituser'] || $_G['group']['allowbanuser'] || ($_G['forum']['ismoderator'] && $_G['group']['allowviewip'] && !$post['first'])) { ?>
<span class="info_new">
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowviewip']) { ?>
<a href="forum.php?mod=topicadmin&amp;action=getip&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="ajaxmenu(this, 0, 0, 2);doane(event)">IP</a>&nbsp;
<?php } if($_G['group']['allowedituser']) { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?frames=yes&action=members&operation=search&uid=<?php echo $post['authorid'];?>&submit=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?php echo $post['authorid'];?><?php } ?>" target="_blank">编辑</a>&nbsp;
<?php } if($_G['group']['allowbanuser']) { if($_G['adminid'] == 1) { ?>
<a href="admin.php?action=members&amp;operation=ban&amp;username=<?php echo $post['usernameenc'];?>&amp;frames=yes" target="_blank">禁止</a>&nbsp;
<?php } else { ?>
<a href="forum.php?mod=modcp&amp;action=member&amp;op=ban&amp;uid=<?php echo $post['authorid'];?>" target="_blank">禁止</a>&nbsp;
<?php } } ?>
<a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?php echo $post['usernameenc'];?>" target="_blank">帖子</a>
</span>
<?php } ?>
</div>

<div class="lxch_r">
<div class="lc_bs_new clboth">
<?php if($post['authorid'] && !$post['anonymous']) { if(!$_G['setting']['authoronleft']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="xi2" rel="nofollow"><?php echo $post['author'];?></a><?php echo $authorverifys;?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
匿名
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; } elseif(!$post['authorid'] && !$post['username']) { ?>
游客
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; } ?>
<span class="fby" id="authorposton<?php echo $post['pid'];?>">
<style type="text/css">
.lc_bs_new span.fby div{display:inline;}
.fby a{ color:#949494;}
</style>
<?php if($postcount==0) { ?>
发表于
<?php } else { ?>
发表于
<?php } ?>
<?php echo $post['dateline'];?>


</span>

<!--关注关系-->
<?php if($post['first'] == 1 && $_G['uid'] != $post['authorid']) { ?>
<style type="text/css">
.first-follow .btn-28 {
    border-radius: 2px;
    float: left;
    font-size: 12px;
    height: 28px;
    line-height: 28px;
    margin-left: 8px;
    padding: 0 12px;
    text-align: center;
    margin-top:3px;
}
.first-follow .p-btn-d {
    background-color: #fff;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}
.first-follow .p-btn-c {
    background-color: #ff7e00;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    color: #fff;
}
.first-follow .icon-f {
    background: rgba(0, 0, 0, 0) url("http://static.8264.com/static/images/icon/attent_15x59.png") no-repeat scroll 0 0;
    display: inline-block;
    height: 13px;
    margin: -2px 5px 0 0;
    vertical-align: middle;
    width: 13px;
}
.first-follow .icon-add-f {
    background-position: -1px -48px;
}
.first-follow .icon-focus-f {
    background-position: -1px -24px;
}
.first-follow .layer-list {
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.17);
    position: absolute;
    text-align: center;
    width: 100px;
    z-index: 101;
}
.first-follow .layer-list a {
    display: block;
    font-size: 14px;
    height: 28px;
    line-height: 28px;
}
.first-follow .layer-list a:hover {
    background-color:#f3f3f3;
    color:#ff7e00;
}
</style>
<div style="float:left;position:relative;z-index:1;" class="first-follow">
<?php if(empty($post['mutual'])) { if($_G['uid']) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>" class="p-btn-c btn-28 addfollow" id="ajax_follow_me_<?php echo $post['authorid'];?>">
<?php } else { ?>
<a href="member.php?mod=logging&amp;action=login" class="p-btn-c btn-28">
<?php } ?>
<i class="icon-f icon-add-f"></i>关注
</a>

<?php } elseif($post['mutual'] == 1) { ?>
<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" onmouseover="showMenu_uc(this.id,'35','1');" id="followselect">
<i class="icon-f icon-focus-f"></i>已关注
</a>
<?php } elseif($post['mutual'] == 2) { ?>
<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" onmouseover="showMenu_uc(this.id,'35','1');" id="followselect">
<i class="icon-f icon-addtwo-f"></i>互相关注
</a>
<?php } if($post['mutual']) { ?>
<div class="layer-list" id="followselect_menu" style="display:none;">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=<?php echo $post['authorid'];?>" id="friend_group_<?php echo $post['authorid'];?>" class="setgroup">
<span class="t">设置分组</span>
</a>
<a href="javascript:void(0);" rel="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?php echo $post['authorid'];?>&amp;confirm=1"  class="unfollow">
<span class="t">取消关注</span>
</a>
</div>
<?php } ?>
</div>
<script type="text/javascript">
jQuery(function(){
//添加关注
jQuery(".first-follow").delegate(".addfollow","click",function(){
showWindow(jQuery(this).attr('id'), jQuery(this).attr('href'), 'get', 0);
});

//取消关注
jQuery(".layer-list").delegate(".unfollow","click",function(){
var url = jQuery(this).attr('rel');
dconfirm('取消关注', '确认取消关注吗?', function() {
jQuery.post(url, '', function(data) {
if(data == 'success') {
var html = '<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>" class="p-btn-c btn-28 addfollow" id="ajax_follow_me_<?php echo $post['authorid'];?>"><i class="icon-f icon-add-f"></i>关注</a>';
jQuery('.first-follow').html('').html(html);
showDialog("<p>取消关注成功</p>", 'notice', '','' , 0, '', '', '', '', 2);
}
});
});
});

//设置分组
jQuery(".layer-list").delegate(".setgroup","click",function(){
showWindow(jQuery(this).attr('id'), jQuery(this).attr('href'), 'get', 0);
});
});
function showMenu_uc(id,top,left) {
showMenu(id);
jQuery('#'+id+'_menu').css({'top':top+'px'});
if (left) {
jQuery('#'+id+'_menu').css({'left':left+'px'});
}
}
function callback_follow_successfully(mutual, uid) {
if (mutual == 1) {
var html = '<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" id="followselect"><i class="icon-f icon-focus-f"></i>已关注</a>';
} else if (mutual == 2) {
var html = '<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" id="followselect"><i class="icon-f icon-addtwo-f"></i>互相关注</a>';
}
html += '<div class="layer-list" id="followselect_menu" style="display:none;">';
html += '<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=';
//			html += uid;
html += uid;
html += '" id="friend_group_'+uid+'" class="setgroup"><span class="t">设置分组</span></a>';
html += '<a href="javascript:void(0);" rel="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid='+uid+'&amp;confirm=1"  class="unfollow"><span class="t">取消关注</span></a>';
html += '</div>';
jQuery('.first-follow').html('').html(html);
jQuery('.first-follow .button_hover').mouseover(function(){
showMenu_uc(jQuery(this).attr('id'),'35','1');
});
//取消关注
jQuery(".layer-list").delegate(".unfollow","click",function(){
var url = jQuery(this).attr('rel');
dconfirm('取消关注', '确认取消关注吗?', function() {
jQuery.post(url, '', function(data) {
if(data == 'success') {
var html = '<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>" class="p-btn-c btn-28 addfollow" id="ajax_follow_me_<?php echo $post['authorid'];?>"><i class="icon-f icon-add-f"></i>关注</a>';
jQuery('.first-follow').html('').html(html);
showDialog("<p>取消关注成功</p>", 'notice', '','' , 0, '', '', '', '', 2);
}
});
});
});
//设置分组
jQuery(".layer-list").delegate(".setgroup","click",function(){
showWindow(jQuery(this).attr('id'), jQuery(this).attr('href'), 'get', 0);
});
}
</script>
<?php } ?>
<!--关注关系 end-->

<?php if(!IS_ROBOT) { ?>
<a href="<?php echo $_G['siteurl'];?><?php if($post['first']) { ?>forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?><?php echo $fromuid;?><?php } else { ?>forum.php?mod=redirect&goto=findpost&ptid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?><?php echo $fromuid;?><?php } ?>" class="lc_bs_no" title="复制本帖链接" id="postnum<?php echo $post['pid'];?>" onclick="setCopy(this.href, '帖子地址已经复制到剪贴板');return false;">
<?php if(!empty($postno[$post['number']])) { ?><?php echo $postno[$post['number']];?><?php } else { ?><em><?php echo $post['number'];?></em><?php echo $postno['0'];?><?php } ?>
</a>
<?php } ?>

<span class="tzgn">
<?php if($post['authorid'] && !$post['anonymous']) { if($post['invisible'] == 0) { if(!IS_ROBOT && !$_G['gp_authorid'] && !$_G['forum_thread']['archiveid']) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>&amp;authorid=<?php echo $post['authorid'];?>" rel="nofollow">只看该作者</a>
<?php } elseif(!$_G['forum_thread']['archiveid']) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>" rel="nofollow">显示全部帖子</a>
<?php } } } if(!IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']) { if($ordertype != 1) { ?>
| <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;ordertype=1" rel="nofollow">倒序浏览</a>
<?php } else { ?>
| <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;ordertype=2" rel="nofollow">正序浏览</a>
<?php } if($post['invisible'] == 0) { } if($_G['forum_thread']['readperm']) { ?>| <em class="xg2">阅读权限 <?php echo $_G['forum_thread']['readperm'];?></em><?php } } if($_G['forum_scan_way_button'] == 1 && $post['first'] ) { ?>
| <a href="tupian-<?php echo $_G['tid'];?>.html#pic" target="_blank">只看本帖大图</a>
<?php } ?>
</span>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_sidetop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_sidetop'][$postcount]; ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_sidebottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_sidebottom'][$postcount]; if($post['first']) { if($_G['forum_threadstamp']) { ?><div id="threadstamp"><img src="http://static.8264.com/static/image/stamp/<?php echo $_G['forum_threadstamp']['url'];?>" title="<?php echo $_G['forum_threadstamp']['text'];?>" /></div><?php } } if(!$post['first'] && $_G['forum_thread']['special'] == 5) { ?>
<label class="pdbts pdbts_<?php echo intval($post['stand']); ?>">
<?php if($post['stand'] == 1) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=1" title="只看正方">正方</a>
<?php } elseif($post['stand'] == 2) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=2" title="只看反方">反方</a>
<?php } else { ?><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=0" title="只看中立">中立</a><?php } if($post['stand']) { ?>
<a class="b" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" id="voterdebate_<?php echo $post['pid'];?>" onclick="ajaxmenu(this);doane(event);">支持 <?php echo $post['voters'];?></a>
<?php } ?>
</label>
<?php } ?>

<div class="clboth">
<div class="ad_info">
<?php if($post['number']<6) { ?><?php echo adshow("thread/a_pt/2/$postcount"); } if($_G['forum_thread']['readmodel'] ==1&&$post['first']) { ?>
    <div style="text-align:center; padding:30px 0px 10px 0px;">
<a target="_blank" href="http://www.8264.com/youji/<?php echo $_G['tid'];?>.html?from=8264bbs">
<img  src="http://static.8264.com/static/image/common/ydbicon.png">
</a>
</div>
<?php } if($_G['forum_thread']['readmodel'] ==2&&$post['first']) { ?>
    <div style="text-align:center; padding:30px 0px 10px 0px;">
<a target="_blank" href="http://www.8264.com/wenzhang/<?php echo $_G['tid'];?>.html?from=8264bbs">
<img  src="http://static.8264.com/static/image/common/wzbicon.png">
</a>
</div>
<?php } if($post['first']) { if($post['tags'] || $relatedkeywords) { ?>
<div class="ptg">
<?php if($post['tags']) { ?><?php echo $post['tags'];?><?php } if($relatedkeywords) { ?><span><?php echo $relatedkeywords;?></span><?php } ?>
</div>
<?php } } ?>
</div>
</div><div class="bjcon_new">
<?php if($post['warned']) { ?>
<span class="y"><a href="forum.php?mod=misc&amp;action=viewwarning&amp;tid=<?php echo $_G['tid'];?>&amp;uid=<?php echo $post['authorid'];?>" title="受到警告" onclick="showWindow('viewwarning', this.href)"><img src="http://static.8264.com/static/image/common/warning.gif" alt="受到警告" /></a></span>
<?php } if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽</em></div>
<?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽</em></div>
<?php } elseif($needhiddenreply) { ?>
<div class="locked">此帖仅作者可见</div>
<?php } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop'][$postcount]; if($_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽，只有管理员可见</em></div>
<?php } elseif($post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽，只有管理员可见</em></div>
<?php } if($post['first']) { if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
<div class="locked">
<em class="y"><a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" onclick="showWindow('pay', this.href)">记录</a></em>
付费主题, 价格: <strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?> </strong>
</div>
<?php } if($threadsort && $threadsortshow) { if($threadsortshow['typetemplate']) { ?>
<?php echo $threadsortshow['typetemplate'];?>
<?php } elseif($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
<div class="typeoption">
<?php if($threadsortshow['optionlist'] == 'expire') { ?>
该信息已经过期
<?php } else { ?>
<table summary="分类信息" cellpadding="0" cellspacing="0" class="cgtl mbm">
<caption><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></caption>
<tbody><?php if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { if($option['type'] != 'info') { ?>
<tr>
<th><?php echo $option['title'];?>:</th>
<td><?php if($option['value']) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?>-<?php } ?></td>
</tr>
<?php } } ?>
</tbody>
</table>
<?php } ?>
</div>
<?php } } } ?>

<div class="t_fsz_new <?php if(!$_G['forum_thread']['special']) { } else { } ?>">
<?php if($post['first']) { if(!$_G['forum_thread']['special']) { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } elseif($_G['forum_thread']['special'] == 1) { include template('forum/viewthread_poll'); } elseif($_G['forum_thread']['special'] == 2) { include template('forum/viewthread_trade'); } elseif($_G['forum_thread']['special'] == 3) { include template('forum/viewthread_reward'); } elseif($_G['forum_thread']['special'] == 4) { include template('forum/viewthread_activity'); } elseif($_G['forum_thread']['special'] == 5) { include template('forum/viewthread_debate'); } elseif($threadplughtml) { ?>
<?php echo $threadplughtml;?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } } else { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } if($post['attachment']) { ?>
<div class="locked">附件: <em><?php if($_G['uid']) { ?>你所在的用户组无法下载或查看附件<?php } else { ?>你需要<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);return false;">登录</a>才可以下载或查看附件。没有账号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="注册账号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em></div>
<?php } elseif(($post['imagelist'] || $post['attachlist'])) { if(!($post['first'] && $_G['forum_thread']['special'] == 4)) { ?>
<div class="pattl">
zxZX
<?php if($post['imagelist']) { ?>
<?php echo $post['imagelist'];?>
<?php } if($post['attachlist']) { ?>
<?php echo $post['attachlist'];?>
<?php } ?>
</div>
<?php } } ?>
</div>

<?php if($post['first'] && $sticklist) { ?>
<div>
<h3 class="psth xs1">回帖推荐</h3><?php if(is_array($sticklist)) foreach($sticklist as $rpost) { ?><div class="pstl xs1">
<div class="psta" style='z-index:1;position:absolute'><a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" c="1" rel="nofollow"><?php echo $rpost['avatar'];?></a></div>
<div class="psti">
<p>
<a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" class="xi2 xw1" rel="nofollow"><?php echo $rpost['author'];?></a>
                        发表于<?php echo $rpost['position'];?>楼
<span class="xi2">
&nbsp;<a href="javascript:;" onclick="window.open('forum.php?mod=redirect&goto=findpost&ptid=<?php echo $rpost['tid'];?>&pid=<?php echo $rpost['pid'];?>')" class="xi2">查看完整内容</a>
<?php if($_G['group']['allowstickreply']) { ?>&nbsp;<a href="javascript:;" onclick="modaction('stickreply', <?php echo $rpost['pid'];?>, '&undo=yes')" class="xi2">解除置顶</a><?php } ?>
</span>
</p>
<div class="mtn"><?php echo $rpost['message'];?></div>
</div>
</div>
<?php } ?>
</div>
<?php } if($post['number']==1 && $_G['uid'] && 1!=1) { ?>
<!-- 波总要求取消1楼快速回复，如后面需要再恢复，去掉上面条件 && 1!=1 -->
<form method="post" autocomplete="off" id="fastreplyform" onsubmit="$('fastreplysubmit').disabled=true;jQuery('#fastreplymessage').focus();ajaxpost('fastreplyform', 'return_fastreply', 'return_fastreply', 'onerror', 'fastreplysubmit', fastreply_refun);return false;" action="forum.php?mod=post&amp;infloat=yes&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;replysubmit=yes">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" fwin="reply">
<input type="hidden" name="handlekey" value="reply">
<input type="hidden" name="noticeauthor" value="q|<?php echo $post['authorid'];?>|<?php echo $post['author'];?>">
<input type="hidden" name="noticetrimstr" value="<?php echo $fastreply_noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $fastreply_noticeauthormsg;?>" />
<input type="hidden" name="reppost" value="<?php echo $post['pid'];?>">

<div class="lchf">
<div id="return_fastreply"></div>
<div style="overflow: hidden; height: 100px;">
<textarea name="message" class="t_note" id="fastreplymessage">楼主说的太精彩了，快来点评一下！</textarea>
<div class="areatext" id="fastreply-message-hidden" contenteditable="true"></div>
<div id="fastreply-atlist"></div>
</div>
<div class="lcksfu clboth">
<span class="lcksfu_l" id="fastreply_btnbox">
<button class="lcksfubotton" value="true" name="replysubmit" id="fastreplysubmit" type="submit"></button>
<!-- 手机绑定提示 -->
<?php if(!$_G['member']['telstatus']) { ?>
<style type="text/css">.tips-binding__inside{float:left;background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:4px 0 0 10px;font-size:14px;color:#585858}.tips-binding__inside a{color:#ff7038;font-size:14px}.tips-binding__inside a:hover{color:#ff7038;font-size:14px}</style>
<span class="tips-binding__inside">注：回帖操作需绑定手机，<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">去绑定>></a></span>
<?php } ?>
<!-- //手机绑定提示 -->
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="<classname>"><sec><i id="sec<hash>_menu" class="yzmimg" style="display:none"><sec></i></span>
EOF;
?>
<div class="twyzm clboth fastreplysec"><?php include template('common/seccheck'); ?></div>
<?php } ?>
</span>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;repquote=<?php echo $post['pid'];?>" onclick="switchAdvanceMode(this.href);doane(event);" class="lcksfu_r">高级模式</a>
</div>
</div>
</form>
<script type="text/javascript">
jQuery("#fastreplymessage").focus(function(){
if(jQuery(this).attr('class')=='t_note'){
jQuery(this).removeClass('t_note');
jQuery(this).val('');
}
});
function fastreply_refun(){
jQuery('#fastreplymessage').val('');
$('fastreplysubmit').disabled=false;
var body=(window.opera) ? (document.compatMode == "CSS1Compat" ? jQuery('html') : jQuery('body')) : jQuery('html,body');
if(jQuery('#return_fastreply').html().indexOf('succeed')>-1){
body.animate({scrollTop:jQuery('#comment_<?php echo $post['pid'];?>').position().top-100},0);
}
}
</script>
<?php } if(!empty($post['ratelog'])) { ?>
<div class="clboth mt16" id="ratelog_<?php echo $post['pid'];?>">
<?php if(!$_G['setting']['ratelogon']) { ?>
<div class="pftitle clboth">
<span class="pficon16_16"></span>
<span class="pfnum"><?php echo count($postlist[$post['pid']]['totalrate']);; ?>人</span>
<span class="pfzi">评分</span>
<span class="pficon6_11"></span>
<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)">查看全部评分</a>
</div>
<?php } ?>
<div id="post_rate_<?php echo $post['pid'];?>"></div>
<?php if($_G['setting']['ratelogon']) { ?>
<table class="ratl">
<tr>
<th class="xw1" width="120"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分">已有 <span class="xi1"><?php echo count($postlist[$post['pid']]['totalrate']);; ?></span> 人评分</a></th><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { ?><th width="50"><i><?php echo $_G['setting']['extcredits'][$id]['title'];?></i></th>
<?php } ?>
<th>
<a href="javascript:;" onclick="toggleRatelogCollapse('ratelog_<?php echo $post['pid'];?>', this);" class="y xi2 op"><?php if(!empty($_G['cookie']['ratecollapse'])) { ?>展开<?php } else { ?>收起<?php } ?></a>
<i>理由</i>
</th>
</tr>
<tbody class="ratl_l"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><tr id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>">
<td>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a> <a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" rel="nofollow"><?php echo $ratelog['username'];?></a>
</td><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($ratelog['score'][$id] > 0) { ?>
<td class="xi1"> + <?php echo $ratelog['score'][$id];?></td>
<?php } else { ?>
<td class="xg1"><?php echo $ratelog['score'][$id];?></td>
<?php } } ?>
<td class="xg1"><?php echo $ratelog['reason'];?></td>
</tr>
<?php } ?>
</tbody>
</table>
<p class="ratc">
总评分:&nbsp;<?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($score > 0) { ?>
<span class="xi1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?></span>&nbsp;
<?php } else { ?>
<span class="xg1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?></span>&nbsp;
<?php } } ?>
&nbsp;<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分" class="xi2">查看全部评分</a>
</p>
<?php } else { ?>
<div class="clboth">
<ul class="pftoulist clboth"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><li>
<div id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>_menu" class="attp" style="display: none;">
<p class="crly"><?php echo $ratelog['reason'];?> &nbsp;&nbsp;<?php if(is_array($ratelog['score'])) foreach($ratelog['score'] as $id => $score) { if($score > 0) { ?>
<em><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></em>
<?php } else { ?>
<span><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></span>
<?php } } ?>
</p>
<p class="mncr"></p>
</div>
<p id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="tx"><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a></p>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" class="name" rel="nofollow"><?php echo $ratelog['username'];?></a>
</li>
<?php } ?>
<div style="clear:both;"></div>
</ul>
</div>
<?php } ?>
</div>
<?php } else { ?>
<div id="post_rate_div_<?php echo $post['pid'];?>"></div>
<?php } ?>

<div class="clboth mt16">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<div class="dptitle clboth">
<span class="dpicon16_16"></span>
<?php if($commentcount[$post['pid']]) { ?><span class="dpnum"><?php echo $commentcount[$post['pid']];?>人</span><?php } ?>
<span class="dpzi">点评</span>
<span class="dpicon6_11"></span>
<a href="javascript:;" class="shouqi" id="clist_btn_<?php echo $post['pid'];?>">收起</a>
</div>
<?php } ?>
<div class="clboth" id="comment_<?php echo $post['pid'];?>">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<ul class="dplistcon"><?php if(is_array($comments[$post['pid']])) foreach($comments[$post['pid']] as $comment) { ?><li id="comments_<?php echo $comment['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $comment['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="name" rel="nofollow"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $comment['comment'];?></span>
</span>
<?php if($comment['forpid'] <> 0) { ?>
<span class="second" style="display:none;">
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;postid=<?php echo $comment['pid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $comment['forpid'];?>&amp;cid=<?php echo $comment['id'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=commentreply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">回复</a>
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $comment['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<?php } ?>
<span class="hfreveiw">
<span class="time"><?php echo $comment['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_comreply('delcomment', <?php echo $comment['id'];?>,'','',<?php echo count($comment['replyComment']) ?>);"></a>
<?php } ?>
</span>
</li>
<?php if(!empty($comment['replyComment'])) { if(is_array($comment['replyComment'])) foreach($comment['replyComment'] as $reply) { ?><li id="comments_<?php echo $reply['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $reply['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="name" rel="nofollow"><?php echo $reply['author'];?></a>
<span class="hf">回复</span>
<a href="#" target="_blank" class="name_second"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $reply['comment'];?></span>
</span>
<span class="second" style="display:none;">
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $reply['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<span class="hfreveiw">
<span class="time"><?php echo $reply['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_delcomreply('delcomment', <?php echo $part['id'];?>,'','',<?php echo $comment['pid'];?>)"></a>
<?php } ?>
</span>
</li>
<?php } } } ?>
</ul>
<?php if($commentcount[$post['pid']] > $_G['setting']['commentnumber']) { ?>
<div class="dpfy clboth">
<div class="pg"><a href="javascript:;" onclick="ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>&page=2', 'comment_<?php echo $post['pid'];?>')">下一页</a></div>
</div>
<?php } } ?>
</div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount]; } ?>
</div>
<?php if(!IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']) { if(!empty($lastmod['modaction']) && $_G['groupid'] == 1) { ?>
<div class="gldivfst clboth" ><a href="forum.php?mod=misc&amp;action=viewthreadmod&amp;tid=<?php echo $_G['tid'];?>" title="帖子模式" onclick="showWindow('viewthreadmod', this.href)">本主题由 <?php echo $lastmod['modusername'];?> 于 <?php echo $lastmod['moddateline'];?> <?php echo $lastmod['modaction'];?></a></div>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_useraction'])) echo $_G['setting']['pluginhooks']['viewthread_useraction']; } } ?>

<div class="lcbottom clboth">
<?php if(!$_G['forum_thread']['archiveid']) { ?>
<div class="gldiv_l">
<?php if($post['invisible'] == 0) { if($allowpostreply) { ?>
<a class="hficon" href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=reply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">回复</a>
<?php } } if($_G['group']['raterange'] && $post['authorid'] && !$post['first'] && $post['invisible'] == 0) { ?>
<a id="p_rate_btn" class="pficon" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?>', 'get', -1);return false;">评分</a>
<?php } if($_G['group']['raterange'] && $post['authorid'] && $post['first']) { ?>
<a id="p_rate_btn" class="pficon" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?>', 'get', -1);return false;" title="<?php echo count($postlist[$post['pid']]['totalrate']);; ?> 人评分">评分</a>
<?php } if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>
<a id="p_edit_btn" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_G['gp_modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<?php } else { ?>编辑<?php } ?></a>
<?php } ?>
</div>
<div class="gldiv_r">
<?php if($post['invisible'] == -2 && !$post['first']) { ?>
<span class="xg1">(待审核)</span>
<?php } if($post['first'] && $post['invisible'] == -3) { ?>
<a href="forum.php?mod=misc&amp;action=pubsave&amp;tid=<?php echo $_G['tid'];?>">发表</a>
<?php } if(!(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'])) && $_G['uid'] && $post['authorid'] == $_G['uid']) { ?>
<a href="forum.php?mod=misc&amp;action=postappend&amp;tid=<?php echo $post['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;page=<?php echo $page;?>" onClick="showPostWin('postappend', this.href)">补充</a>
<?php } if(!$post['first'] && $modmenu['post']) { ?>
<span>
<label for="manage<?php echo $post['pid'];?>">
<input type="checkbox" id="manage<?php echo $post['pid'];?>" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $post['pid'];?>)" value="<?php echo $post['pid'];?>" autocomplete="off" />管理
</label>
</span>
<?php } if($post['invisible'] == 0) { if($post['first'] && $_G['uid'] && $_G['uid'] == $post['authorid'] && !in_array($_G['fid'], array(7,378))) { ?>
<a href="misc.php?mod=invite&amp;action=thread&amp;id=<?php echo $_G['tid'];?>" onclick="showWindow('invite', this.href, 'get', 0);">邀请</a>
<?php } if($_G['forum_thread']['special'] == 3 && ($_G['forum']['ismoderator'] && (!$_G['setting']['rewardexpiration'] || $_G['setting']['rewardexpiration'] > 0 && ($_G['timestamp'] - $_G['forum_thread']['dateline']) / 86400 > $_G['setting']['rewardexpiration']) || $_G['forum_thread']['authorid'] == $_G['uid']) && $post['authorid'] != $_G['forum_thread']['authorid'] && $post['first'] == 0 && $_G['uid'] != $post['authorid'] && $_G['forum_thread']['price'] > 0) { ?>
<a href="javascript:;" onclick="setanswer(<?php echo $post['pid'];?>, '<?php echo $_G['gp_from'];?>')">最佳答案</a>
<?php } if($post['rate'] && $_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $page;?>" onclick="showWindow('rate', this.href, 'get', -1)">撤销评分</a>
<?php } if($post['authorid'] != $_G['uid'] && $_G['uid']) { ?>
<a href="javascript:;" onclick="showWindow('miscreport<?php echo $post['pid'];?>', 'misc.php?mod=report&rtype=post&rid=<?php echo $post['pid'];?>', 'get', -1);return false;" id="report_btn" style="display: none;">举报</a>
<?php } } if($post['first']) { ?>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" id="m_k_favorite" onclick="showWindow(<?php if($_G['uid']) { ?>this.id, this.href, 'get', 0<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>);" title="<?php echo $_G['forum_thread']['favtimes'];?>人收藏" style="display: none;">收藏(<b id="favoritenumber"><?php echo $_G['forum_thread']['favtimes'];?></b>)</a>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postfooter'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postfooter'][$postcount]; ?>
</div>
<div style="clear:both;"></div>
<?php } ?>
</div>

<?php if($post['first'] && $_G['forum_thread']['special'] == 5 && $_G['forum_thread']['displayorder'] >= 0) { ?>
<ul class="ttp cl">
<li style="display:inline;margin-left:12px"><strong class="bw0">按立场筛选: </strong></li>
<li<?php if(!isset($_G['gp_stand'])) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>" hidefocus="true">全部</a></li>
<li<?php if($_G['gp_stand'] == 1) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;stand=1" hidefocus="true">正方</a></li>
<li<?php if($_G['gp_stand'] == 2) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;stand=2" hidefocus="true">反方</a></li>
<li<?php if(isset($_G['gp_stand']) && $_G['gp_stand'] == 0) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;stand=0" hidefocus="true">中立</a></li>
</ul>
<?php } ?>
</div>

<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_endline'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_endline'][$postcount]; ?>

</div>
</div>
</div><?php $postcount++; } ?><?php $guideData = $forumoption_mudidi->getGuideByTid($_G['tid'], 8); ?><?php $guide_title = $scapeareaData['name'].'攻略大全'; ?><?php $pub_guide_link = 'http://bbs.8264.com/forum-post-action-newthread-fid-52.html?mtid='.$_G['tid']; ?><div class="bm vw pl guide_list">
<div class="bm_h cl">
<h2>
<?php echo $guide_title;?>
<span class="pub_guide">
<a href="<?php echo $pub_guide_link;?>">发布攻略</a>
</span>
</h2>
</div>
<div class="bm_c">
<?php if(count($guideData) > 0) { if(is_array($guideData)) foreach($guideData as $guideid => $guide) { if($guide['type'] == 1) { ?><?php $link = "/thread-".$guide['typeid']."-1-1.html"; } elseif($guide['type'] == 2) { ?><?php $link = "http://u.8264.com/home-space-uid-".$guide['uid']."-do-blog-id-".$guide['typeid'].".html"; } ?>
<div class="row">
<div class="detail">
<h5>
<span class="status">
<img src="http://bbs.8264.com/source/plugin/whither/css/images/icon1.png" title="回复" />
<a href="<?php echo $link;?>" title="回复" target="_blank"><?php echo $guide['replies'];?></a>
<img src="http://bbs.8264.com/source/plugin/whither/css/images/icon2.png" title="查看" class="icon2" />
<a href="<?php echo $link;?>" title="查看" target="_blank"><?php echo $guide['views'];?></a>
</span>
<a href="<?php echo $link;?>" target="_blank"><?php echo $guide['subject'];?></a>
</h5>
<div class="author_info">
<div class="author">
<a href="http://u.8264.com/home-space-uid-<?php echo $guide['authorid'];?>-do-profile.html"><?php echo avatar($guide['authorid'], 'small'); ?></a>
作者: <a href="http://u.8264.com/home-space-uid-<?php echo $guide['authorid'];?>-do-profile.html"><?php echo $guide['author'];?></a>
</div>
<div class="lastposter">
<a href="http://u.8264.com/home-space-uid-<?php echo $guide['lastposterid'];?>-do-profile.html"><?php echo avatar($guide['lastposterid'], 'small'); ?></a>
回复: <a href="http://u.8264.com/home-space-uid-<?php echo $guide['lastposterid'];?>-do-profile.html"><?php echo $guide['lastposter'];?></a>
<span class="gray"><?php echo dgmdate($guide['lastpost'], 'u'); ?></span>
</div>
</div>
<div class="content">
<?php if($guide['firstPicture'] != NULL) { ?>
<div class="image">
<a href="<?php echo $link;?>" target="_blank">
<img src="<?php echo $guide['firstPicture'];?>" alt="" />
</a>
</div>
<?php } ?><?php echo messagecutstr($guide['message'], 200); ?></div>
</div>
</div>
<?php } } else { ?>
<div class="empty_info">
<a href="<?php echo $pub_guide_link;?>" class="pub_button">点击发布攻略</a>
</div>
<?php } ?>
</div>
</div><?php $activityData = $forumoption_mudidi->getRalateActivityByKeyword($scapeareaData['name'], 6); if($activityData) { ?>
<div class="bm vw pl" id="comment" style="width:690px;">
<table class="ralateActivety">
<thead>
<tr>
<th class="tl" width="55%"><?php echo $scapeareaData['name'];?>活动&nbsp;|&nbsp;<a href="http://bbs.8264.com/forum-5-1.html"><font color="#0000FF">更多</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://bbs.8264.com/home-space-do-activity-view-all-order-hot-date-default-class.html?from=mudidi"><font color="#0000FF">发布新活动</font></a></th>
<th class="tl" width="20%">发起者</th>
<th width="15%">回复/查看</th>
<th width="10%">报名</th>
</tr>
</thead>
<tbody>
  <?php if(is_array($activityData)) foreach($activityData as $activity) { ?><tr>
<td class="tl">
<span class="dot"></span>
<a href="/thread-<?php echo $activity['tid'];?>-1-1.html" class="ralateActivetyTitle" title="<?php echo $activity['subject'];?>"><?php echo $activity['subject'];?></a>
</td>
<td class="tl">
<div class="userFace"><?php echo avatar($activity['authorid'], 'small'); ?><?php echo $activity['author'];?>
</div>
</td>
<td><?php echo $activity['replies'];?>/<?php echo $activity['views'];?></td>
<td><a href="/thread-<?php echo $activity['tid'];?>-1-1.html" class="hlink">报名</a></td>
</tr>
  <?php } ?>
</tbody>
</table>
</div>
<?php } ?>


<div class="bm vw pl">
<div class="bm_h cl">
<h2>最新评论</h2>
</div>
<div class="bm_c">
            <div id="postlistreply" class="xld xlda mbm"><div id="post_new" class="viewthread_table" style="display: none; border: none;"></div></div><?php if(is_array($postlist)) foreach($postlist as $i => $post) { if(!$post['first']) { ?>
<div id="post_<?php echo $post['pid'];?>" class="xld xlda mbm"><?php $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']); ?><?php
$authorverifys = <<<EOF


EOF;
 if($_G['setting']['verify']['enabled']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && $post['verify'.$vid] == 1) { 
$authorverifys .= <<<EOF

<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid={$vid}" target="_blank">
EOF;
 if($verify['icon']) { 
$authorverifys .= <<<EOF
<img src="{$verify['icon']}" class="vm" alt="{$verify['title']}" title="{$verify['title']}" />
EOF;
 } else { 
$authorverifys .= <<<EOF
{$verify['title']}
EOF;
 } 
$authorverifys .= <<<EOF
</a>&nbsp;

EOF;
 } } } 
$authorverifys .= <<<EOF


EOF;
?>
<dl class="bbda cl" id="pid<?php echo $post['pid'];?>" style="width:605px;overflow:hidden;">
<?php if($post['author'] && !$post['anonymous']) { ?>
<dd class="m avt" style="margin-bottom:0;padding-bottom:8px;"><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>"><?php echo avatar($post[authorid], small); ?></a></dd>
<?php } else { ?>
<dd class="m avt" style="margin-bottom:0;padding-bottom:8px;"><img src="<?php echo STATICURL;?>image/magic/hidden.gif" alt="hidden" /></dd>
<?php } ?>
<dt>
<span class="y xw0">
<?php if(!$post['first'] && $_G['forum_thread']['special'] == 5) { ?>
<label class="pdbts pdbts_<?php echo intval($post['stand']); ?>">
<?php if($post['stand'] == 1) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=1<?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" title="只看正方">正方</a>
<?php } elseif($post['stand'] == 2) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=2<?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" title="只看反方">反方</a>
<?php } else { ?><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=0<?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" title="只看中立">中立</a><?php } if($post['stand']) { ?>
<a class="b" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" id="voterdebate_<?php echo $post['pid'];?>" onclick="ajaxmenu(this);doane(event);">支持 <?php echo $post['voters'];?></a>
<?php } ?>
</label>
<?php } if($_G['forum_thread']['special'] == 3 && ($_G['forum']['ismoderator'] && (!$_G['setting']['rewardexpiration'] || $_G['setting']['rewardexpiration'] > 0 && ($_G['timestamp'] - $_G['forum_thread']['dateline']) / 86400 > $_G['setting']['rewardexpiration']) || $_G['forum_thread']['authorid'] == $_G['uid']) && $post['authorid'] != $_G['forum_thread']['authorid'] && $post['first'] == 0 && $_G['uid'] != $post['authorid'] && $_G['forum_thread']['price'] > 0) { ?>
<a href="javascript:;" onclick="setanswer(<?php echo $post['pid'];?>, '<?php echo $_G['gp_from'];?>')">最佳答案</a>
<?php } if($allowpostreply && $post['invisible'] == 0) { ?>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;reppost=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="showWindow('reply', this.href)">回复</a>
<?php if(!$needhiddenreply) { ?>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="showWindow('reply', this.href)">引用</a>
<?php } } if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>
<a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_G['gp_modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<?php } else { ?>编辑</a><?php } } ?>
</span>
<?php if($post['authorid'] && !$post['anonymous']) { if(!$_G['setting']['authoronleft']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="xi2"><?php echo $post['author'];?></a><?php echo $authorverifys;?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="author_<?php echo $post['pid'];?>"><?php echo $post['author'];?></em>
<?php } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
匿名
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="author_<?php echo $post['pid'];?>">发表于</em>
<?php } elseif(!$post['authorid'] && !$post['username']) { ?>
游客
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="author_<?php echo $post['pid'];?>">发表于</em>
<?php } ?>
<span class="xg1 xw0"><?php echo $post['dateline'];?></span>
</dt>
<dd class="z"><div class="bjcon_new">
<?php if($post['warned']) { ?>
<span class="y"><a href="forum.php?mod=misc&amp;action=viewwarning&amp;tid=<?php echo $_G['tid'];?>&amp;uid=<?php echo $post['authorid'];?>" title="受到警告" onclick="showWindow('viewwarning', this.href)"><img src="http://static.8264.com/static/image/common/warning.gif" alt="受到警告" /></a></span>
<?php } if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽</em></div>
<?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽</em></div>
<?php } elseif($needhiddenreply) { ?>
<div class="locked">此帖仅作者可见</div>
<?php } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop'][$postcount]; if($_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽，只有管理员可见</em></div>
<?php } elseif($post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽，只有管理员可见</em></div>
<?php } if($post['first']) { if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
<div class="locked">
<em class="y"><a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" onclick="showWindow('pay', this.href)">记录</a></em>
付费主题, 价格: <strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?> </strong>
</div>
<?php } if($threadsort && $threadsortshow) { if($threadsortshow['typetemplate']) { ?>
<?php echo $threadsortshow['typetemplate'];?>
<?php } elseif($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
<div class="typeoption">
<?php if($threadsortshow['optionlist'] == 'expire') { ?>
该信息已经过期
<?php } else { ?>
<table summary="分类信息" cellpadding="0" cellspacing="0" class="cgtl mbm">
<caption><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></caption>
<tbody><?php if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { if($option['type'] != 'info') { ?>
<tr>
<th><?php echo $option['title'];?>:</th>
<td><?php if($option['value']) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?>-<?php } ?></td>
</tr>
<?php } } ?>
</tbody>
</table>
<?php } ?>
</div>
<?php } } } ?>

<div class="t_fsz_new <?php if(!$_G['forum_thread']['special']) { } else { } ?>">
<?php if($post['first']) { if(!$_G['forum_thread']['special']) { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } elseif($_G['forum_thread']['special'] == 1) { include template('forum/viewthread_poll'); } elseif($_G['forum_thread']['special'] == 2) { include template('forum/viewthread_trade'); } elseif($_G['forum_thread']['special'] == 3) { include template('forum/viewthread_reward'); } elseif($_G['forum_thread']['special'] == 4) { include template('forum/viewthread_activity'); } elseif($_G['forum_thread']['special'] == 5) { include template('forum/viewthread_debate'); } elseif($threadplughtml) { ?>
<?php echo $threadplughtml;?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } } else { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } if($post['attachment']) { ?>
<div class="locked">附件: <em><?php if($_G['uid']) { ?>你所在的用户组无法下载或查看附件<?php } else { ?>你需要<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);return false;">登录</a>才可以下载或查看附件。没有账号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="注册账号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em></div>
<?php } elseif(($post['imagelist'] || $post['attachlist'])) { if(!($post['first'] && $_G['forum_thread']['special'] == 4)) { ?>
<div class="pattl">
zxZX
<?php if($post['imagelist']) { ?>
<?php echo $post['imagelist'];?>
<?php } if($post['attachlist']) { ?>
<?php echo $post['attachlist'];?>
<?php } ?>
</div>
<?php } } ?>
</div>

<?php if($post['first'] && $sticklist) { ?>
<div>
<h3 class="psth xs1">回帖推荐</h3><?php if(is_array($sticklist)) foreach($sticklist as $rpost) { ?><div class="pstl xs1">
<div class="psta" style='z-index:1;position:absolute'><a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" c="1" rel="nofollow"><?php echo $rpost['avatar'];?></a></div>
<div class="psti">
<p>
<a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" class="xi2 xw1" rel="nofollow"><?php echo $rpost['author'];?></a>
                        发表于<?php echo $rpost['position'];?>楼
<span class="xi2">
&nbsp;<a href="javascript:;" onclick="window.open('forum.php?mod=redirect&goto=findpost&ptid=<?php echo $rpost['tid'];?>&pid=<?php echo $rpost['pid'];?>')" class="xi2">查看完整内容</a>
<?php if($_G['group']['allowstickreply']) { ?>&nbsp;<a href="javascript:;" onclick="modaction('stickreply', <?php echo $rpost['pid'];?>, '&undo=yes')" class="xi2">解除置顶</a><?php } ?>
</span>
</p>
<div class="mtn"><?php echo $rpost['message'];?></div>
</div>
</div>
<?php } ?>
</div>
<?php } if($post['number']==1 && $_G['uid'] && 1!=1) { ?>
<!-- 波总要求取消1楼快速回复，如后面需要再恢复，去掉上面条件 && 1!=1 -->
<form method="post" autocomplete="off" id="fastreplyform" onsubmit="$('fastreplysubmit').disabled=true;jQuery('#fastreplymessage').focus();ajaxpost('fastreplyform', 'return_fastreply', 'return_fastreply', 'onerror', 'fastreplysubmit', fastreply_refun);return false;" action="forum.php?mod=post&amp;infloat=yes&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;replysubmit=yes">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" fwin="reply">
<input type="hidden" name="handlekey" value="reply">
<input type="hidden" name="noticeauthor" value="q|<?php echo $post['authorid'];?>|<?php echo $post['author'];?>">
<input type="hidden" name="noticetrimstr" value="<?php echo $fastreply_noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $fastreply_noticeauthormsg;?>" />
<input type="hidden" name="reppost" value="<?php echo $post['pid'];?>">

<div class="lchf">
<div id="return_fastreply"></div>
<div style="overflow: hidden; height: 100px;">
<textarea name="message" class="t_note" id="fastreplymessage">楼主说的太精彩了，快来点评一下！</textarea>
<div class="areatext" id="fastreply-message-hidden" contenteditable="true"></div>
<div id="fastreply-atlist"></div>
</div>
<div class="lcksfu clboth">
<span class="lcksfu_l" id="fastreply_btnbox">
<button class="lcksfubotton" value="true" name="replysubmit" id="fastreplysubmit" type="submit"></button>
<!-- 手机绑定提示 -->
<?php if(!$_G['member']['telstatus']) { ?>
<style type="text/css">.tips-binding__inside{float:left;background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:4px 0 0 10px;font-size:14px;color:#585858}.tips-binding__inside a{color:#ff7038;font-size:14px}.tips-binding__inside a:hover{color:#ff7038;font-size:14px}</style>
<span class="tips-binding__inside">注：回帖操作需绑定手机，<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">去绑定>></a></span>
<?php } ?>
<!-- //手机绑定提示 -->
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="<classname>"><sec><i id="sec<hash>_menu" class="yzmimg" style="display:none"><sec></i></span>
EOF;
?>
<div class="twyzm clboth fastreplysec"><?php include template('common/seccheck'); ?></div>
<?php } ?>
</span>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;repquote=<?php echo $post['pid'];?>" onclick="switchAdvanceMode(this.href);doane(event);" class="lcksfu_r">高级模式</a>
</div>
</div>
</form>
<script type="text/javascript">
jQuery("#fastreplymessage").focus(function(){
if(jQuery(this).attr('class')=='t_note'){
jQuery(this).removeClass('t_note');
jQuery(this).val('');
}
});
function fastreply_refun(){
jQuery('#fastreplymessage').val('');
$('fastreplysubmit').disabled=false;
var body=(window.opera) ? (document.compatMode == "CSS1Compat" ? jQuery('html') : jQuery('body')) : jQuery('html,body');
if(jQuery('#return_fastreply').html().indexOf('succeed')>-1){
body.animate({scrollTop:jQuery('#comment_<?php echo $post['pid'];?>').position().top-100},0);
}
}
</script>
<?php } if(!empty($post['ratelog'])) { ?>
<div class="clboth mt16" id="ratelog_<?php echo $post['pid'];?>">
<?php if(!$_G['setting']['ratelogon']) { ?>
<div class="pftitle clboth">
<span class="pficon16_16"></span>
<span class="pfnum"><?php echo count($postlist[$post['pid']]['totalrate']);; ?>人</span>
<span class="pfzi">评分</span>
<span class="pficon6_11"></span>
<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)">查看全部评分</a>
</div>
<?php } ?>
<div id="post_rate_<?php echo $post['pid'];?>"></div>
<?php if($_G['setting']['ratelogon']) { ?>
<table class="ratl">
<tr>
<th class="xw1" width="120"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分">已有 <span class="xi1"><?php echo count($postlist[$post['pid']]['totalrate']);; ?></span> 人评分</a></th><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { ?><th width="50"><i><?php echo $_G['setting']['extcredits'][$id]['title'];?></i></th>
<?php } ?>
<th>
<a href="javascript:;" onclick="toggleRatelogCollapse('ratelog_<?php echo $post['pid'];?>', this);" class="y xi2 op"><?php if(!empty($_G['cookie']['ratecollapse'])) { ?>展开<?php } else { ?>收起<?php } ?></a>
<i>理由</i>
</th>
</tr>
<tbody class="ratl_l"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><tr id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>">
<td>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a> <a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" rel="nofollow"><?php echo $ratelog['username'];?></a>
</td><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($ratelog['score'][$id] > 0) { ?>
<td class="xi1"> + <?php echo $ratelog['score'][$id];?></td>
<?php } else { ?>
<td class="xg1"><?php echo $ratelog['score'][$id];?></td>
<?php } } ?>
<td class="xg1"><?php echo $ratelog['reason'];?></td>
</tr>
<?php } ?>
</tbody>
</table>
<p class="ratc">
总评分:&nbsp;<?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($score > 0) { ?>
<span class="xi1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?></span>&nbsp;
<?php } else { ?>
<span class="xg1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?></span>&nbsp;
<?php } } ?>
&nbsp;<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分" class="xi2">查看全部评分</a>
</p>
<?php } else { ?>
<div class="clboth">
<ul class="pftoulist clboth"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><li>
<div id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>_menu" class="attp" style="display: none;">
<p class="crly"><?php echo $ratelog['reason'];?> &nbsp;&nbsp;<?php if(is_array($ratelog['score'])) foreach($ratelog['score'] as $id => $score) { if($score > 0) { ?>
<em><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></em>
<?php } else { ?>
<span><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></span>
<?php } } ?>
</p>
<p class="mncr"></p>
</div>
<p id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="tx"><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a></p>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" class="name" rel="nofollow"><?php echo $ratelog['username'];?></a>
</li>
<?php } ?>
<div style="clear:both;"></div>
</ul>
</div>
<?php } ?>
</div>
<?php } else { ?>
<div id="post_rate_div_<?php echo $post['pid'];?>"></div>
<?php } ?>

<div class="clboth mt16">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<div class="dptitle clboth">
<span class="dpicon16_16"></span>
<?php if($commentcount[$post['pid']]) { ?><span class="dpnum"><?php echo $commentcount[$post['pid']];?>人</span><?php } ?>
<span class="dpzi">点评</span>
<span class="dpicon6_11"></span>
<a href="javascript:;" class="shouqi" id="clist_btn_<?php echo $post['pid'];?>">收起</a>
</div>
<?php } ?>
<div class="clboth" id="comment_<?php echo $post['pid'];?>">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<ul class="dplistcon"><?php if(is_array($comments[$post['pid']])) foreach($comments[$post['pid']] as $comment) { ?><li id="comments_<?php echo $comment['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $comment['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="name" rel="nofollow"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $comment['comment'];?></span>
</span>
<?php if($comment['forpid'] <> 0) { ?>
<span class="second" style="display:none;">
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;postid=<?php echo $comment['pid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $comment['forpid'];?>&amp;cid=<?php echo $comment['id'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=commentreply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">回复</a>
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $comment['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<?php } ?>
<span class="hfreveiw">
<span class="time"><?php echo $comment['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_comreply('delcomment', <?php echo $comment['id'];?>,'','',<?php echo count($comment['replyComment']) ?>);"></a>
<?php } ?>
</span>
</li>
<?php if(!empty($comment['replyComment'])) { if(is_array($comment['replyComment'])) foreach($comment['replyComment'] as $reply) { ?><li id="comments_<?php echo $reply['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $reply['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="name" rel="nofollow"><?php echo $reply['author'];?></a>
<span class="hf">回复</span>
<a href="#" target="_blank" class="name_second"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $reply['comment'];?></span>
</span>
<span class="second" style="display:none;">
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $reply['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<span class="hfreveiw">
<span class="time"><?php echo $reply['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_delcomreply('delcomment', <?php echo $part['id'];?>,'','',<?php echo $comment['pid'];?>)"></a>
<?php } ?>
</span>
</li>
<?php } } } ?>
</ul>
<?php if($commentcount[$post['pid']] > $_G['setting']['commentnumber']) { ?>
<div class="dpfy clboth">
<div class="pg"><a href="javascript:;" onclick="ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>&page=2', 'comment_<?php echo $post['pid'];?>')">下一页</a></div>
</div>
<?php } } ?>
</div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount]; } ?>
</div>
<div style="text-align:right;">
<?php if(!$post['first'] && $modmenu['post']) { ?>
<span>
<label for="manage<?php echo $post['pid'];?>">
<input type="checkbox" id="manage<?php echo $post['pid'];?>" class="pc" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $post['pid'];?>)" value="<?php echo $post['pid'];?>" autocomplete="off" />
管理
</label>
</span>
<?php } ?>
</div>
</dd>

</dl>

<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_endline'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_endline'][$postcount]; ?></div>
<?php } ?><?php $postcount++; } ?>
</div>
</div>

<?php if($_G['setting']['fastpost'] && $allowpostreply && !$_G['forum_thread']['archiveid'] && ($_G['forum']['status'] != 3 || $_G['isgroupuser'])) { ?><script type="text/javascript">
var postminchars = parseInt(50);
var postmaxchars = parseInt('<?php echo $_G['setting']['maxpostsize'];?>');
var disablepostctrl = parseInt('<?php echo $_G['group']['disablepostctrl'];?>');
</script>

<div id="f_pst" class="pl<?php if(empty($_G['gp_from'])) { ?> bm bmw<?php } ?>">
<form method="post" autocomplete="off" id="fastpostform" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes<?php if($_G['gp_ordertype'] != 1) { ?>&amp;infloat=yes&amp;handlekey=fastpost<?php } if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>"<?php if($_G['gp_ordertype'] != 1) { ?> onSubmit="return fastpostvalidatenosymbol(this)"<?php } ?>>
<?php if(empty($_G['gp_from'])) { ?>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="plc">
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_content'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_content']; ?>

<span id="fastpostreturn"></span>

<?php if($_G['forum_thread']['special'] == 5 && empty($firststand)) { ?>
<div class="pbt cl">
<div class="ftid sslt">
<select id="stand" name="stand">
<option value="">选择观点</option>
<option value="0">中立</option>
<option value="1">正方</option>
<option value="2">反方</option>
</select>
</div>
<script type="text/javascript">simulateSelect('stand');</script>
</div>
<?php } ?>

<div class="cl">
<?php if(empty($_G['gp_from']) && $_G['setting']['fastsmilies']) { ?><div id="fastsmiliesdiv" class="y"><div id="fastsmiliesdiv_data"></div></div><?php } ?>
<div<?php if(empty($_G['gp_from']) && $_G['setting']['fastsmilies']) { ?> class="hasfsl"<?php } ?>>
<?php if($_G['uid'] && !$forumOption->isStared('forum', $_G['tid'], $_G['uid'])) { ?>
<style type="text/css">
.starselect_box{ overflow: hidden; margin: 0 0 5px;}
.starselect_box strong { margin-right: 10px;}
.starselect_box label { margin-right: 6px;}
.starselect_box .radio { vertical-align: middle;}
</style>
<div class="starselect_box" id="starselect_box">
<strong>品牌评价:</strong>
<label for="starselect_5">
<input type="radio" name="starselect" value="5" id="starselect_5" class="radio" />
力荐（五星）
</label>
<label for="starselect_4">
<input type="radio" name="starselect" value="4" id="starselect_4" class="radio" />
推荐（四星）
</label>
<label for="starselect_3">
<input type="radio" name="starselect" value="3" id="starselect_3" class="radio" />
还行（三星）
</label>
<label for="starselect_2">
<input type="radio" name="starselect" value="2" id="starselect_2" class="radio" />
较差（二星）
</label>
<label for="starselect_1">
<input type="radio" name="starselect" value="1" id="starselect_1" class="radio" />
很差（一星）
</label>
</div>
<?php } ?>
<div class="tedt<?php if(!($_G['forum_thread']['special'] == 5 && empty($firststand))) { ?> mtn<?php } ?>">
<div class="bar">
<span class="y">
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_func_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_func_extra']; if($_G['setting']['magicstatus'] && !empty($_G['setting']['magics']['doodle'])) { ?>
<a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=fastpostmessage&amp;from=fastpost" onclick="showWindow(this.id, this.href, 'get', 0)"><?php echo $_G['setting']['magics']['doodle'];?></a>
<span class="pipe">|</span>
<?php } ?>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="return switchAdvanceMode(this.href)">上传图片请点击高级模式</a>

</span><?php $seditor = array('fastpost', array('bold', 'color', 'img', 'link', 'quote', 'code', 'smilies'), $guestreply ? 1 : 0); ?><?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra']; if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="深灰色"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="蓝色"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="红色"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<style type="text/css">
#pmimg_menu #pmimg_param_1 {width:93%!important;}
</style>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?> style="margin-left:5px;">图片</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>表情</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } ?></div>
<div class="area">
<?php if(!$guestreply) { ?>
<textarea rows="5" cols="80" name="message" id="fastpostmessage" onKeyDown="seditor_ctlent(event, <?php if($_G['gp_ordertype'] != 1) { ?>'fastpostvalidate($(\'fastpostform\'))'<?php } else { ?>'$(\'fastpostform\').submit()'<?php } ?>);" tabindex="4" class="pt"></textarea>
<?php } else { ?>
<div class="pt hm">你需要登录后才可以回帖 <a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">登录</a> | <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="showWindow('register', this.href)" class="xi2"><?php echo $_G['setting']['reglinkname'];?></a><?php if($_G['setting']['connect']['allow']) { ?> | <a href="<?php echo $_G['connect']['login_url'];?>&statfrom=viewthread_fastpostbrand" target="_top" rel="nofollow"><img src="<?php echo IMGDIR;?>/qq_login.gif" class="vm" /></a><?php } ?></div>
<?php } ?>
</div>
</div>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id)"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm sec"><?php include template('common/seccheck'); ?></div>
<?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="subject" value="" />
                        <div style="padding-top:4px;">希望您的评论，能为大家提供一个全面并客观的参考意见。所以请不要发任何无实际意义的评论内容。</div>
<p class="ptm">
<button <?php if(!$guestreply) { ?>type="submit" <?php } else { ?>type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')" <?php } ?>name="replysubmit" id="fastpostsubmit" class="pn vm" value="replysubmit" tabindex="5"><strong>发表回复</strong></button>
</p>
</div>
</div>
<?php if(empty($_G['gp_from'])) { ?>
</td>
       
</tr>
</table>
<?php } ?>
</form>
</div><?php } ?>
</div>

<div class="sidebar" style="position:relative;z-index:2;">
<div class="mudidi_info_nav"><?php $scapeareaSn = $forumoption_mudidi->getSnByTid($_G['tid']); ?><?php $mudidi_info_list = $forumoption_mudidi->getInfoNav($scapeareaSn); ?><h2 class="mudidi_info_title"><?php echo $scapeareaData['name'];?>旅游信息</h2>
<dl class="mudidi_info_list" id="mudidi_info_list"><?php if(is_array($mudidi_info_list)) foreach($mudidi_info_list as $list) { ?><dt><a href="/whither-info-<?php echo $list['id'];?>.html"><?php echo $list['name'];?></a></dt>
<?php } ?>
</dl>

<h2 class="mudidi_info_title mudidi_info_margin_top"><?php echo $scapeareaData['name'];?>旅游导航</h2>
<dl class="mudidi_info_list mudidi_info_list2">
<dt><a href="/whither-scapelist-<?php echo $_G['tid'];?>-1.html" title="<?php echo $scapeareaData['name'];?>旅游景点">景点</a></dt>
<dt class="even"><a href="/whither-guidelist-<?php echo $_G['tid'];?>-1.html" title="<?php echo $scapeareaData['name'];?>旅游攻略">攻略</a></dt>
<dt><a href="/whither-photolist-<?php echo $_G['tid'];?>-1.html" title="<?php echo $scapeareaData['name'];?>照片图片">相册</a></dt>
<dt class="even"><a href="http://u.8264.com/home-space-do-activity-view-all-date-week-class--area-0.html" title="<?php echo $scapeareaData['name'];?>户外活动">活动</a></dt>
<dt>
<?php if($regionData['hotelUrl']) { ?>
<a href="<?php echo $regionData['hotelUrl'];?>" title="<?php echo $scapeareaData['name'];?>酒店住宿" target="_blank">旅舍</a>
<?php } else { ?>
<a href="javascript:void(0);" title="此景区暂无旅舍推荐">旅舍</a>
<?php } ?>
</dt>
<dt class="even"><a href="http://bx.8264.com/?8264com" title="<?php echo $scapeareaData['name'];?>户外保险" target="_blank">保险</a></dt>
<dt><a href="/whither-weather-<?php echo $_G['tid'];?>.html" title="<?php echo $scapeareaData['name'];?>天气预报">天气</a></dt>
<dt class="even"><a href="/whither-map-<?php echo $_G['tid'];?>.html" title="<?php echo $scapeareaData['name'];?>地图">地图</a></dt>
</dl>
</div>
<script type="text/javascript">
jQuery('#mudidi_info_list dt a').click(function(){
                <?php if(($_G['uid'] && $_G['group']['radminid'] > 0)) { ?>
                var isAdmin = true;
                <?php } else { ?>
                var isAdmin = false;
                <?php } ?>
                var tid = <?php echo $_G['tid'];?>;
var ddMinHeight = jQuery('#mudidi_info_list dt').size() * 33 + 9;

jQuery(this).blur();
var dt = jQuery(this).parent('dt');
if (!dt.is('.ajaxed')) {
var infoid = /info-(\d+).html$/.exec(jQuery(this).attr('href'))[1];
                    jQuery.ajax({
type: "GET",
dataType: 'json',
async: false,
url: "/plugin.php?id=whither:ajaxgetinfo",
data: "infoid="+infoid,
success: function(data) {
if (!data['message']) {
                                data['message'] = '<p style="padding:20px 0;text-align:center;">'+data['subject']+'暂无内容</p>';
}
dt.after(jQuery('<dd><div class="mudidi_info_dropdown_info"><h1><a href="javascript:void();" class="close flbc">关闭</a><span class="htitle">'+data['subject']+'&nbsp;&nbsp;'+(isAdmin?'<a href="http://bbs.8264.com/plugin.php?id=whither:pubinfo&amp;tid='+tid+'&amp;infoid='+infoid+'" class="opearte">编辑</a><span class="pipe">|</span>':'')+'<a href="/whither-info-'+infoid+'.html" class="opearte">查看详细</a></span></h1><div class="content">'+data['message']+'</div></div></dd>'));
dt.addClass('ajaxed');
}
});
                }
if (!dt.next().is('dd')) {
jQuery('.mudidi_info_nav a').removeClass('with_dropdown');
jQuery('.mudidi_info_nav dd').hide();
return false;
}
jQuery('.mudidi_info_nav a').removeClass('with_dropdown');
jQuery('.mudidi_info_nav dd').hide();
jQuery(this).addClass('with_dropdown');
dt.next('dd').show();
if (dt.next('dd').children('div').height() < ddMinHeight) {
dt.next('dd').children('div').height(ddMinHeight)
}

return false;
});

jQuery('.mudidi_info_nav dd').live('click', function(){
jQuery(this).prev('dt').children('a').addClass('with_dropdown');
jQuery(this).show();
});

jQuery('.mudidi_info_nav .close').live('click', function(){
var dd = jQuery(this).parent('h1').parent('div').parent('dd');
dd.prev('dt').children('a').removeClass('with_dropdown');
dd.hide();
return false;
});

jQuery('body').click(function(){
jQuery('.mudidi_info_nav a').removeClass('with_dropdown');
jQuery('.mudidi_info_nav dd').hide();
});
</script>

<?php if($scapeareaData['lat'] && $scapeareaData['long']) { ?>
<div class="sidebar_box">
<div class="sidebar_box_title">
                <a href="/whither-map-<?php echo $_G['tid'];?>.html" class="more">查看详细</a>
<h5><?php echo $scapeareaData['name'];?>地图</h5>
</div>
<div class="sidebar_box_content">
<div id="mapContainer" style="width:250px;height:250px;">
</div>
</div>
            <script src="http://api.map.baidu.com/api?v=1.2&services=true" type="text/javascript"></script>
            <script type="text/javascript">
                var map = new BMap.Map("mapContainer");
                var point = new BMap.Point(<?php echo $scapeareaData['long'];?>, <?php echo $scapeareaData['lat'];?>);
                map.centerAndZoom(point, 9);
                //map.disableDragging(); // 禁用地图拖拽
                //map.disableDoubleClickZoom(); // 禁用双击放大
                map.addControl(new BMap.NavigationControl());
                var marker = new BMap.Marker(point);  // 创建标注
                map.addOverlay(marker);              // 将标注添加到地图中
            </script>
</div>
<?php } if($scapeareaData['lat'] && $scapeareaData['long']) { ?><?php $weathers = $forumoption_mudidi->getWeatherInfo($scapeareaData['long'], $scapeareaData['lat']); if($weathers) { ?>
<div class="sidebar_box">
<div class="sidebar_box_title">
    	<a href="/whither-weather-<?php echo $_G['tid'];?>.html" class="more">查看详细</a>
<h5><?php echo $scapeareaData['name'];?>天气</h5>
</div>
<div class="sidebar_box_content">
<div class="weather"><?php if(is_array($weathers)) foreach($weathers as $weatherid => $weather) { ?><div class="item">
<span><?php echo $weather['day_of_week'];?></span>
<span><img src="http://www.google.com<?php echo $weather['icon'];?>" alt="" /></span>
<span><?php echo $weather['condition'];?></span>
<span><?php echo $weather['high'];?>℃/<?php echo $weather['low'];?>℃</span>
</div>
<?php if($weatherid == 2) { ?><?php break; } } ?>
</div>
</div>
</div>
<?php } } ?><?php $albumData = $forumoption_mudidi->getRalateAlbumByTid($_G['tid'], 9); if($albumData) { ?>
<div class="sidebar_box">
<div class="sidebar_box_title">
                <span class="more">
                    <a style="color:#000" target="_blank" href="http://u.8264.com/home-spacecp-ac-upload.html">发布新照片</a>
                    <img src="/static/image/common/faq.gif" onmouseover="showTip(this)" tip="发布新照片时请把相册名称设置为景点名称，这样更容易让网友浏览到您所发布的照片！" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_mudidi">
                    <a href="/whither-photolist-<?php echo $_G['tid'];?>-1.html">更多</a>
                </span>
<h5><?php echo $scapeareaData['name'];?>照片</h5>
</div>
<div class="sidebar_box_content">
<ul class="photolist1"><?php if(is_array($albumData)) foreach($albumData as $albumid => $album) { ?><li>
<div class="image">
<a href="http://u.8264.com/home-space-uid-<?php echo $album['uid'];?>-do-album-id-<?php echo $album['albumid'];?>.html">
<img src="<?php echo $album['trueurl'];?>" alt="" />
</a>
</div>
<div class="text">
<a href="http://u.8264.com/home-space-uid-<?php echo $album['uid'];?>-do-album-id-<?php echo $album['albumid'];?>.html"><?php echo $album['albumname'];?></a>
</div>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>

</div>
</div>

<div class="clear"></div>
<?php if($scapeareaData['hotelName']) { ?>
<div class="bm vw pl">
<div class="bm_h cl">
<?php if($scapeareaData['hotelUrl']) { ?>
<a href="<?php echo $scapeareaData['hotelUrl'];?>" class="more">更多旅舍</a>
<?php } ?>
<h2><?php echo $scapeareaData['hotelName'];?>旅舍</h2>
</div>
<div style="padding:10px 0;">
<script src="http://hoteldistr.yododo.com/sale/distr_backoffice/adCodeJump_gbk.jsp?distrid=1&width=960&height=120&styletype=wide&areaname=<?php echo $scapeareaData['hotelName'];?>" type="text/javascript"></script>
</div>
</div>
<?php } ?>                <div class="clear"></div><?php $tem_prefix = $dxCache->prefix; ?><?php $dxCache->prefix = 'mudidi_'; if($dxCache->beginCache('footer')) { ?>
<div class="mudidi_scapenav"><?php $mudidiHotScape = ForumOptionMudidi::getHotScape(45); ?><h3 class="scape_title">热门旅行景点：</h3>
<ul class="scape_list"><?php if(is_array($mudidiHotScape)) foreach($mudidiHotScape as $mudidi) { ?><li><a href="/thread-<?php echo $mudidi['tid'];?>-1-1.html"><?php echo $mudidi['subject'];?></a></li>
<?php } ?>
</ul><?php $mudidiNav = ForumOptionMudidi::getRegionInMudidiNav(); ?><h3 class="scape_title">目的地导航：</h3>
<ul class="scape_list"><?php if(is_array($mudidiNav)) foreach($mudidiNav as $mudidi) { ?><li><a href="/thread-<?php echo $mudidi['tid'];?>-1-1.html"><?php echo $mudidi['name'];?></a></li>
<?php } ?>
</ul>
</div><?php $dxCache->endCache(); } ?><?php $dxCache->prefix = $tem_prefix; ?><form method="post" autocomplete="off" name="modactions" id="modactions">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="optgroup" />
<input type="hidden" name="operation" />
<input type="hidden" name="listextra" value="<?php echo $_G['gp_extra'];?>" />
</form>

<?php echo $_G['forum_tagscript'];?>

<!--[diy=diyfastposttop]--><div id="diyfastposttop" class="area"></div><!--[/diy]-->

<?php if($_G['setting']['visitedforums'] || $oldthreads) { ?>
<div id="visitedforums_menu" class="<?php if($oldthreads) { ?>visited_w <?php } ?>p_pop blk cl" style="display: none;">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if($_G['setting']['visitedforums']) { ?>
<td id="v_forums">
<h3 class="mbn pbn bbda xg1">浏览过的版块</h3>
<ul>
<?php echo $_G['setting']['visitedforums'];?>
</ul>
</td>
<?php } if($oldthreads) { ?>
<td id="v_threads">
<h3 class="mbn pbn bbda xg1">浏览过的帖子</h3>
<ul class="xl"><?php if(is_array($oldthreads)) foreach($oldthreads as $oldtid => $oldsubject) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $oldtid;?>"><?php echo $oldsubject;?></a></li>
<?php } ?>
</ul>
</td>
<?php } ?>
</tr>
</table>
</div>
<?php } if($_G['setting']['forumjump']) { ?>
<div class="p_pop" id="fjump_menu" style="display: none">
<?php echo $forummenu;?>
</div>
<?php } if(!IS_ROBOT && $_G['setting']['threadmaxpages'] > 1) { ?>
<script type="text/javascript">document.onkeyup = function(e){keyPageScroll(e, <?php if($page > 1) { ?>1<?php } else { ?>0<?php } ?>, <?php if($page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']) { ?>1<?php } else { ?>0<?php } ?>, 'forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?><?php if($_G['gp_authorid']) { ?>&authorid=<?php echo $_G['gp_authorid'];?><?php } ?>', <?php echo $page;?>);}</script>
<?php } ?>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>
<div style="display:none;">
<script src="http://s84.cnzz.com/stat.php?id=3496107&web_id=3496107&show=pic1" type="text/javascript" language="JavaScript"></script>
</div></div>
<!-- 友情链接 -->
<style>
.friendLink{ background: #0f1f2b; padding: 15px 0 18px 0px;}
.friendLink a { color: #807f7f; display: inline; margin-right: 10px; white-space: nowrap; font-size:12px;}
.friendLink a:hover { color: #fff; text-decoration:none;}
</style>
<div class="friendLink">
<div class="layout w980">
<?php if(!empty($_G['setting']['pluginhooks']['global_friendlylink'])) echo $_G['setting']['pluginhooks']['global_friendlylink']; ?>
</div>
</div>
<div class="bottomNav">
<div class="layout" style="position:relative;">
<div class="copyright">
<p><a href="http://www.miitbeian.gov.cn/" target="_blank">津ICP备05004140号-10</a> ICP证 津B2-20110106&nbsp;&nbsp;&nbsp;天津信一科技有限公司版权所有</p>
<p>户外有风险，8264提醒您购买<a href="http://bx.8264.com/?8264com" target="_blank">户外保险</a></p>
</div>
<div class="someLink">
<a target="_blank" href="http://bbs.8264.com/member-clearcookies-formhash-d64f4f90.html" rel="nofollow">清除COOKIE</a>
|
<?php if($_G['group']['allowstatdata']) { ?>
<a target="_blank" href="http://bbs.8264.com/misc-stat.html" rel="nofollow">站点统计</a> |
<?php } ?>
<a target="_blank" href="http://www.8264.com/about-contact.html" rel="nofollow">联系我们</a>
|
<a href="http://www.8264.com/about-contact.html#q4" rel="nofollow">8264招聘</a>
|
<a href="http://bbs.8264.com/misc-faq.html" rel="nofollow">帮助</a>
<span class="app">
<a href="http://bbs.8264.com/thread-2317569-1-1.html" target="_blank" class="appIco_95x27" rel="nofollow"></a>
</span>
</div>


        <?php if($_GET['mod'] =='index') { ?>
        <style>
.qdcionbottom{ position:absolute; left:509px; top:0px;}
.qdcionbottom img{ width:49px; height:44px;}
        </style>
        <a href='http://na3.tjaic.gov.cn/netmonitor/query/ScrNetEntQuery/Display.do?show=1&id=6eb59bd37f0000011ec3c0e5a59f7891-1-v-e-r-&ztLOID=8b4b03e47f0000012b8f0a26c9a87e67' class="qdcionbottom" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/guohui.png" /></a>
        <?php } ?>



</div>
</div>
<?php if($nobottomad !== false) { ?>
<!-- 页面底部弹出新闻表 -->
<script src="http://static.8264.com/static/js/jquery.cookie.js" type="text/javascript" type="text/javascript"></script>
<style>
  .newswarpten{ position:absolute; position:fixed!important; bottom:0px; display:none; left:50%;z-index: 999}
  .newstopone{ height:46px;  font-size:14px; background: url(http://static.8264.com/static/image/common/kxbg.png) 0px -1px no-repeat #fffff6; border:#e0d3be solid 1px;  float:left; border-right:0 none;}
  .newstopone .linktitle_4587{ float:left; margin:12px 0px 0px 70px; display:inline;}
  .newstopone .linktitle_4587 a{ font-size:16px; color:#064361; text-decoration:none;}
  .newstopone .linktitle_4587 a:hover{ font-size:16px; color:#ff7e00; text-decoration:none;}
  .newstopone .close16_16{ width:16px; height:16px; float:right; cursor:pointer; background:url(http://static.8264.com/static/image/common/kxbgarrowclose.png) -47px -1px no-repeat; margin:16px 0px 0px 10px; display:inline;}
  .newstopone .close16_16:hover{background:url(http://static.8264.com/static/image/common/kxbgarrowclose.png) -1px -1px no-repeat;}
  .newsarrow{ width:18px; height:48px; background:url(http://static.8264.com/static/image/common/kxbgarrow.png) left top no-repeat; float:right;}
</style>
<body>
<div class="newswarpten">
  <div class="newstopone">
    <div style="display: inline-block;padding-left: 70px;height: 46px;line-height: 46px;"><?php echo adshow("custom_294"); ?></div>
    <span class="close16_16"></span>
  </div>
  <div class="newsarrow"></div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
  var tiao = jQuery(".newswarpten").width();
  jQuery(".newswarpten").css( 'margin-left' , -tiao/2 );
  var t_time = Date.parse(new Date());
  var cookietime = jQuery.cookie('showboxtime');
  if(!cookietime){
    jQuery(".newswarpten").show();
  };
  if(t_time >= cookietime){
     jQuery(".newswarpten").show();
  };
  jQuery('.close16_16,.linktitle_4587 a').click(function(){
    var t_time = Date.parse(new Date());
    jQuery.cookie('showboxtime',t_time+3600*24*1000,{expires:30,domain:'8264.com',path:'/'});
    jQuery(".newswarpten").hide();
  });
});
</script>
<!-- //页面底部弹出新闻表 -->
<?php } if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
    <div class="crly">
        积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分
    </div>
    <div class="mncr"></div>
    </div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; if(!$_G['setting']['bbclosed']) { ?> <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
    <script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script src="http://static.8264.com/static/js/space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F49299785f8cc72bacc96c9a5109227da' type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- 链接自动推送 -->
<script type="text/javascript">
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<!-- //链接自动推送 -->
<?php if(($_G['mod'] == 'viewthread' || $_GET['act'] == 'showview' || $_GET['act'] == 'commentdetail' || $_G['mod'] == 'view' || $_GET['ctl'] == 'topic')) { ?>
<script type="text/javascript">
var _gaq = _gaq || [];
<?php if($_G['mod'] == 'view') { ?>
_gaq.push(['tid', '<?php echo $_GET['aid'];?>']);
_gaq.push(['type', '3']);
<?php } elseif($_GET['ctl'] == 'topic') { ?><?php $_G['tid'] = $topic['topicid'] ? $topic['topicid'] : 1; ?>_gaq.push(['tid', '<?php echo $_G['tid'];?>']);
_gaq.push(['type', '6']);
<?php } else { ?>
_gaq.push(['fid', '<?php echo $_G['fid'];?>']);
_gaq.push(['tid', '<?php echo $_G['tid'];?>']);
<?php } if($_G['mod'] == 'viewthread') { ?>
_gaq.push(['type', '1']);
<?php } elseif($_GET['act'] == 'showview') { ?>
_gaq.push(['type', '2']);
<?php } elseif($_GET['act'] == 'commentdetail') { ?>
_gaq.push(['pid', '<?php echo $pid;?>']);
_gaq.push(['type', '4']);
<?php } ?>

(function(d, t) {
var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
g.type = 'text/javascript'; g.async = true;
g.src = 'http://static.8264.com/static/js/ga.js?<?php echo VERHASH;?>';
s.parentNode.insertBefore(g, s);
})(document, 'script');
</script>
<?php } ?>
</body>
</html><?php output(); ?>