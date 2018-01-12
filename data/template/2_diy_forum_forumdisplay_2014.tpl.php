<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplay_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/common/header_8264_new.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/common/fastnavigation.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/default/forum/recommend.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/common/zhidemai.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/forum/forumdisplay_difangxianlu.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/forum/forumdisplay_list_2014.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/common/weixin_share.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/common/camel_ad.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/common/footer_forum_8264_new.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/common/header_common.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/common/index_ad_top.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/forum/forumdisplay_thread_2014.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/default/forum/search_sortoption.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/forum/forumdisplay_thread_2014.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/forum/forumdisplay_thread_2014.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
|| checktplrefresh('./template/8264/forum/forumdisplay_2014.htm', './template/8264/common/footer_8264_new.htm', 1509517867, 'diy', './data/template/2_diy_forum_forumdisplay_2014.tpl.php', './template/8264', 'forum/forumdisplay_2014')
;
block_get('6906,7035,6905');?>
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
<link href="http://static.8264.com/static/css/forum/forum_forumdisplay.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<script src="http://static.8264.com/static/js/common/forumdisplay.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
var body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
var go_top=0;
<?php if($_G['gp_typeid'] || $_G['gp_sortid'] || $filter || $_G['gp_digest'] || $_G['gp_orderby'] == 'dateline') { ?>
go_top=$("#threadlist").position().top;
<?php } if($page>1) { ?>
go_top=$("#threadlist_top").position().top;
<?php } ?>
go_top&&body.animate({scrollTop:go_top},0);
});
</script>

<div class="header">
<div class="layout">
<style>
.dsad{ position:absolute; left:168px; top:18px;}
.dsad1{ position:absolute; left:432px; top:18px;}
</style>
<div class="dsad"><?php echo adshow("custom_252"); ?></div>
<div class="dsad1"><?php echo adshow("custom_322"); ?></div>
<div class="icoHill">山</div>
<div class="headerL">
<?php if($_G['forum']['extra']['localname']) { ?>
<div class="whereIs" style="display: none;"><?php echo $_G['forum']['extra']['localname'];?></div>
<?php } if($_G['gp_typeid']) { ?>
<h5><span class="country"><a href="<?php echo $forumnameurl;?>"><?php echo $_G['forum']['name'];?></a></span></h5>
<?php } else { ?>
<h1><span class="country"><a href="<?php echo $forumnameurl;?>"><?php echo $_G['forum']['name'];?></a></span></h1>
<?php } ?>
<div class="site">
<a href="<?php echo $_G['config']['web']['portal'];?>" title="首页" id="fjump"<?php if($_G['setting']['forumjump'] == 1) { ?> onmouseover="showMenu({'ctrlid':this.id})"<?php } ?>>首页</a>
<?php echo $navigation;?>
<?php if($thistypefatherid > 0) { ?>
 <em>&rsaquo;</em> <a href="<?php echo $_G['forum']['threadtypes']['url'][$thistypefatherid];?>"><?php echo $_G['forum']['threadtypes']['types'][$thistypefatherid];?></a>
<?php if($_G['gp_typeid'] > 0 && $_G['gp_typeid'] != $thistypefatherid) { ?>
 <em>&rsaquo;</em> <a href="<?php echo $_G['forum']['threadtypes']['url'][$_G['gp_typeid']];?>"><?php echo $_G['forum']['threadtypes']['childtypes'][$thistypefatherid][$_G['gp_typeid']];?></a>
<?php } } ?>
</div>
</div>
<div class="headerR">
<div class="bbsNumCount">
<div class="numBox">
<p class="num"><?php echo $_G['forum']['threads'];?></p>
<p class="day">主题</p>
</div>
<div class="numBox">
<p class="num"><?php echo $_G['forum']['todayposts'];?></p>
<p class="day">今日</p>
</div>
</div>
</div><style>
.nav_t_p_a{ width:980px; border:#d8d8d8 solid 1px; position:absolute; top:52px; right:0px;z-index: 6363;background: #fff; box-shadow: 0 2px 5px #CCCCCC}
.nav_t_p_a dl{ display:table; border-bottom:#d8d8d8 solid 1px; width:100%; margin:0;  padding:11px 0px 6px 0px; background:url(http://static.8264.com/static/image/common/bbsnavbg.jpg) -21px 0px repeat-y;}
.nav_t_p_a dl.without_b{ border-bottom:none 0;}
.nav_t_p_a dt{ float:left; width:94px; margin:0px; padding:0px; text-indent:15px; height:100%;font-size:12px; color:#fff;}
.nav_t_p_a dd{ margin:0px; padding:0px; overflow:hidden;}
.nav_t_p_a dd a{ margin:0px 20px 5px 0px; display:inline-block; white-space: nowrap;}
.nav_t_p_a dd a:hover{ color:#43A6DF;}
.headerL .site .xlsj{ padding:0px 16px 0px 0px; background:url(http://static.8264.com/static/image/common/arrow_xl.jpg) 51px 7px no-repeat; }
.headerL .site .xlsj_down{ padding:0px 16px 0px 0px; background:url(http://static.8264.com/static/image/common/arrow_xl.jpg) 51px -8px no-repeat; }

</style>
<?php if($catlist) { ?>
<div class="nav_t_p_a" style="display: none;"><?php if(is_array($catlist)) foreach($catlist as $key => $cat) { ?><dl <?php if($cat['extra']['classname']) { ?>class="bg"<?php } ?>>
<dt><?php echo $cat['name'];?></dt>		
<?php if($cat['forumcolumns'] == 0) { ?>
<dd><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { ?><?php $forum['domain']=$alldomainwithfid[$forumid]; ?> <?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forumid; ?><a href="<?php echo $forumurl;?>">
<i><?php echo $forumlist[$forumid]['name'];?></i>								
</a>
<?php } ?>
</dd>
<?php } else { ?>
<dd><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { ?><?php $forum['domain']=$alldomainwithfid[$forumid]; ?> <?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forumid; ?> 

<?php if($forumlist[$forumid]['extra']['localname'] != '') { } else { } ?>

<a href="<?php if($forumlist[$forumid]['redirect']) { ?><?php echo $forumlist[$forumid]['redirect'];?>" target="_blank"<?php } else { ?><?php echo $forumurl;?>"<?php } ?> ><?php echo $forumlist[$forumid]['name'];?> <?php if($forumid == 493) { } else { } ?></a>



<?php } ?>
</dd>
<?php } ?>		
</dl>

<?php } ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){	
$('.site .xlsj, .nav_t_p_a').hover(function(){	
clearTimeout(window.acCtrl);		
$(".nav_t_p_a").show();
},function(){		
window.acCtrl=setTimeout(function(){$(".nav_t_p_a").hide();},300);
});
})
</script>
<?php } ?>		

</div>
</div>
<?php if($_G['forum']['ismoderator']) { ?>
<script src="http://static.8264.com/static/js/forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/forum_moderator.css?<?php echo VERHASH;?>" />
<?php } ?>


<!--//头部广告//-->
<div style="padding:0px 0px 0px 0px; width:980px; margin:0 auto;"><?php echo adshow("custom_374"); ?></div>
<div class="layout mt10" style=" position:relative"><?php echo adshow("custom_486"); ?></div>
<?php if($_GET['typeid']==1080) { ?>
<div class="layout mt10" style=" position:relative"><?php echo adshow("custom_418"); ?><span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px; line-height:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
</div>
<?php } ?>
<!-- 文字广告 -->
<div class="layout mt10"><?php echo adshow("text/layout"); ?></div>


<div class="layout mt10" style=" position:relative; "><?php echo adshow("custom_476"); ?></div>





<style id="diy_style" type="text/css"></style>
<!--//通栏广告//-->

<div class="wp"></div>

<?php if(($_G['cookie']['widthauto']==2)) { ?>
<link rel="stylesheet" href="http://static.8264.com/static/plugin/produce/css/style.css" />
<div id="goTop"><a href="#" class="cursor" onclick="javascript:void(0)"></a></div>
<script src="http://static.8264.com/static/plugin/produce/js/jQuery-gotop.js" type="text/javascript"></script>
<script type="text/javascript">jQuery('#goTop').goTop();</script>
<?php } ?>

<div class="layout mt10" style="display:none;">
<div class="list_forum_explain">
<h3>
<div class="bt">本版必读</div>
<div class="bdsharebuttonbox" style="display:none;">
<a href="#" class="bds_more" data-cmd="more"></a>
<a href="#" class="bds_tsina" data-cmd="tsina"></a>
<a href="#" class="bds_qzone" data-cmd="qzone"></a>
<a href="#" class="bds_tqq" data-cmd="tqq"></a>
<a href="#" class="bds_weixin" data-cmd="weixin"></a>
<a class="bds_count" data-cmd="count" style="display: none;"></a>
</div>
<script>
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};
with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
<style type="text/css">
.bdsharebuttonbox{float:right; padding-left:10px; *margin-top:-37px;}
.bdsharebuttonbox a,.bdsharebuttonbox a:hover{ float:left!important;  margin-top:6px!important;}
a.bds_more,a.bds_more:hover{ margin-right:0px!important; }
</style>

<?php if($_G['forum']['ismoderator']) { if($_G['forum']['modworks']) { if($modnum) { ?><a href="forum.php?mod=modcp&amp;action=moderate&amp;op=threads&amp;fid=<?php echo $_G['fid'];?>" target="_blank">待审核帖(<?php echo $modnum;?>)</a><?php } if($modusernum) { ?><a href="forum.php?mod=modcp&amp;action=moderate&amp;op=members&amp;fid=<?php echo $_G['fid'];?>" target="_blank">待审核用户(<?php echo $modusernum;?>)</a><?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_modlink'])) echo $_G['setting']['pluginhooks']['forumdisplay_modlink']; if(!$_G['gp_archiveid']) { ?>
<strong><?php if($_G['forum']['status'] != 3) { ?><a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>">管理面板</a><?php } else { ?><a href="forum.php?mod=group&amp;action=manage&amp;fid=<?php echo $_G['fid'];?>">管理面板</a><?php } ?></strong>
<?php } if($_G['forum']['recyclebin']) { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?mod=forum&action=recyclebin&frames=yes<?php } elseif($_G['forum']['ismoderator']) { ?>forum.php?mod=modcp&action=recyclebins&fid=<?php echo $_G['fid'];?><?php } ?>" target="_blank" style="display: none;">回收站</a>
<?php } } ?>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=forum&amp;id=<?php echo $_G['fid'];?>&amp;handlekey=favoriteforum" id="a_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" style="display: none;">收藏本版</a>
<div style="clear:both;"></div>
</h3>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_forumaction'])) echo $_G['setting']['pluginhooks']['forumdisplay_forumaction']; ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_modlink'])) echo $_G['setting']['pluginhooks']['forumdisplay_modlink']; ?>

<p><?php echo $_G['forum']['rules'];?></p>

<?php if(!empty($_G['forum']['domain']) && !empty($_G['setting']['domain']['root']['forum'])) { ?>
<b>本版域名:<a href="http://<?php echo $_G['forum']['domain'];?>.<?php echo $_G['setting']['domain']['root']['forum'];?>" id="group_link" title="<?php echo $_G['forum']['domain'];?>">http://<?php echo $_G['forum']['domain'];?>.<?php echo $_G['setting']['domain']['root']['forum'];?></a></b>
<?php } if($nowtype_moderator['moderator_type']) { ?>
<b><?php echo $nowtype_moderator['name'];?>版主: <span class="xi2"><?php echo $nowtype_moderator['moderator_type'];?></span></b>
<?php } elseif($fathertype_moderator['moderator_type']) { ?>
<b><?php echo $fathertype_moderator['name'];?>版主: <span class="xi2"><?php echo $fathertype_moderator['moderator_type'];?></span></b>
<?php } elseif($moderatedby) { ?>
<b><?php if(!empty($bkname)) { ?><?php echo $bkname;?><?php } ?>版主: <span class="xi2"><?php echo $moderatedby;?></span></b>
<?php } ?>
</div>
<div class="list_forum_explain_r_ad">
<div class="ad_l_260">
<!-- 广告位：论坛列表页——飞耐时 -->

</div>
<div class="ad_r_260">
<!-- 广告位：论坛列表页LA -->

</div>
</div>
<div id="forumarchive_menu" class="p_pop" style="display:none">
<ul>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>">全部主题</a></li><?php if(is_array($forumarchive)) foreach($forumarchive as $id => $info) { ?><li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;archiveid=<?php echo $id;?>"><?php echo $info['displayname'];?> (<?php echo $info['threads'];?>)</a></li>
<?php } ?>
</ul>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_top'])) echo $_G['setting']['pluginhooks']['forumdisplay_top']; if($_G['fid'] == 483) { ?>
<style>
.dhlp{ width:980px; height:84px; font-family:"Microsoft Yahei",Tahoma,Helvetica,SimSun,sans-serif; overflow:hidden; margin:16px auto 0px auto;}
.dhlp .f_l{ float:left; width:640px; font-size:22px; color:#fff; background:#1e6d9b; height:84px; line-height:84px; text-align:center;}
.dhlp .see_details{ background:#e3e3e3; color:#949494; font-size:16px; width:85px; float:left; position:relative; height:65px; padding-top:19px; position:relative; text-align:center; text-decoration:none; font-weight:bold;}
.dhlp .see_details:before{ content:""; border-color: transparent #e3e3e3  transparent transparent ; border-style:solid; border-width:10px; top:50%; left:-17px; position:absolute; margin-top:-10px; }
.dhlp .see_details:hover{ color:#1e6d9b;}
.dhlp .f_r{ float:right; text-align:right; font-size:0;}
.dhlp .f_r b{ font-weight:normal; color:#949494; font-size:24px; display:block;}
.dhlp .f_r span{ display:block; padding-top:2px;}
.dhlp .f_r i{ width:46px; height:45px; line-height:44px; border-radius:50%; background:#e3e3e3; display:block; float:left; text-align:center; font-size:28px; color:#949494; font-style:normal; margin-right:17px; font-weight:900;}
.dhlp .f_r i.orange{ background:#ff7e00; color:#fff;}
.dhlp .f_r em{ font-size:36px; color:#949494; font-style:normal; font-weight:600;}
</style>
<div class="dhlp"><?php $myextcredits5 = sprintf("%03d",$_G['member']['extcredits5']);$myec5 = str_split($myextcredits5); ?><div class="f_l">在本版可以使用8264币兑换各种精美礼品，如何获得8264币</div>
<a href="http://bbs.8264.com/thread-1641700-1-1.html" target="_blank" class="see_details">查看<br>详情</a>

<div class="f_r">
<b>您现在共拥有8264币</b>
<span>
<i<?php if($myec5['0'] > 0) { ?> class="orange"<?php } ?>><?php echo $myec5['0'];?></i>
<i<?php if($myec5['1'] > 0) { ?> class="orange"<?php } ?>><?php echo $myec5['1'];?></i>
<i<?php if($myec5['2'] > 0) { ?> class="orange"<?php } ?>><?php echo $myec5['2'];?></i>
<em>枚</em>
</span>
</div>
</div>
<?php } if($_G['fid'] == 186 ) { ?>
<div style="width: 960px; margin: 0 auto 10px;">
<div style="float: left;"><?php echo adshow("custom_222"); ?></div>
<div style="float: right"><?php echo adshow("custom_223"); ?></div>
<div style="clear:both;"></div>
</div>
<?php } if($_G['fid'] == 58 ) { ?>
<div style="padding: 8px 0px 0px 0px;text-align: center;"><?php echo adshow("custom_143"); ?></div>
<?php } if(!empty($_G['forum']['recommendlist'])) { ?>
<div class="bm bmw">
<div class="bm_h cl"><h2>推荐主题</h2></div>
<div class="bm_c cl"><?php if($_G['forum']['recommendlist']['images'] && $_G['forum']['modrecommend']['imagenum']) { ?>
<div class="cl" style="width: <?php echo $_G['forum']['modrecommend']['imagewidth'];?>px; margin: 0 auto; float:left;">
<script type="text/javascript">
var slideSpeed = 5000;
var slideImgsize = [<?php echo $_G['forum']['modrecommend']['imagewidth'];?>,<?php echo $_G['forum']['modrecommend']['imageheight'];?>];
var slideBorderColor = '<?php echo SPECIALBORDER;?>';
var slideBgColor = '<?php echo COMMONBG;?>';
var slideImgs = new Array();
var slideImgLinks = new Array();
var slideImgTexts = new Array();
var slideSwitchColor = '<?php echo TABLETEXT;?>';
var slideSwitchbgColor = '<?php echo COMMONBG;?>';
var slideSwitchHiColor = '<?php echo SPECIALBORDER;?>';<?php if(is_array($_G['forum']['recommendlist']['images'])) foreach($_G['forum']['recommendlist']['images'] as $k => $imginfo) { ?>slideImgs[<?php echo $k+1; ?>] = '<?php echo $imginfo['filename'];?>';
slideImgLinks[<?php echo $k+1; ?>] = 'forum.php?mod=viewthread&tid=<?php echo $imginfo['tid'];?>';
slideImgTexts[<?php echo $k+1; ?>] = '<?php echo $imginfo['subject'];?>';
<?php } ?>
</script>
<script src="<?php echo $_G['setting']['jspath'];?>forum_slide.js?<?php echo VERHASH;?>" type="text/javascript"></script>
</div>
<?php } ?>
<div class="cl"<?php if($_G['forum']['recommendlist']['images'] && $_G['forum']['modrecommend']['imagenum']) { ?> style="margin-left: <?php echo $_G['forum']['modrecommend']['imagewidth'];?>px; padding-left: 20px;"<?php } ?>><?php unset($_G['forum']['recommendlist']['images']); ?><ul class="xl<?php if(!$_G['forum']['allowside']) { ?> xl2<?php } ?> cl"><?php if(is_array($_G['forum']['recommendlist'])) foreach($_G['forum']['recommendlist'] as $rtid => $recommend) { ?><li>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $rtid;?>" <?php echo $recommend['subjectstyles'];?> target="_blank"><?php echo $recommend['subject'];?></a>
</li>
<?php } ?>
</ul>
</div></div>
</div>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_middle'])) echo $_G['setting']['pluginhooks']['forumdisplay_middle']; if(!$subforumonly) { if($recommendgroups && !$_G['forum']['allowside']) { ?>
<div class="bm">
<div class="bm_h cl"><h2>推荐<?php echo $_G['setting']['navs']['3']['navname'];?></h2></div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($recommendgroups)) foreach($recommendgroups as $key => $group) { ?><li>
<a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" title="<?php echo $group['name'];?>" target="_blank" class="avt"><img src="<?php echo $group['icon'];?>" alt="<?php echo $group['name'];?>"></a>
<p><a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" target="_blank"><?php echo $group['name'];?></a></p>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($threadmodcount) { ?><div class="layout mt10"  style="border:1px #C2D5E3  solid; background:#E5EDF2; text-align:center; padding:10px 0px; color:#1e6d9b; font-size:12px;"><strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me&amp;type=thread&amp;from=&amp;filter=aduit">你有 <?php echo $threadmodcount;?> 个主题正等待审核中，点击查看</a></strong></div><?php } if($_G['fid'] == 107 ) { ?>
<div style="margin-bottom: 8px;text-align: center;"><?php echo adshow("custom_199"); ?></div>
<?php } if($_G['mod'] == 'forumdisplay' && $_G['fid'] == 56) { ?><?php block_display('6906'); } elseif($_G['mod'] == 'forumdisplay' && $_G['fid'] == 39) { ?><?php block_display('7035'); } elseif($_G['mod'] == 'forumdisplay' && $_G['fid'] == 186) { ?><?php include(DISCUZ_ROOT.'./source/plugin/skiing/skiing.php'); ?><?php $hxc=ForumOptionSkiing::getSkiiingHeatsby(5); if($hxc) { ?>
<div class="layout warpten980" style="display:none;">
<h5 class="tt_title">
<b style="color: #1a2b38;font-size: 16px;">滑雪场</b>
<span style="padding-top:4px;">全国滑雪场信息查询、口碑点评</span>
<a href="http://www.8264.com/xuechang" target="_blank" class="bkmore" style="color:#7b94a4;">更多滑雪场</a>
</h5>
<div class="clboth">
<ul class="hxccon"><?php if(is_array($hxc)) foreach($hxc as $xc) { ?><li>
<a href="<?php echo PORTAL_HOST;?>xuechang-<?php echo $xc['tid'];?>" target="_blank" title="<?php echo $xc['subject'];?>"><img src="<?php echo $xc['showimg'];?>"/></a>
<a href="<?php echo PORTAL_HOST;?>xuechang-<?php echo $xc['tid'];?>" target="_blank" title="<?php echo $xc['subject'];?>" class="name"><?php echo $xc['subject'];?></a>
<span class="q_x p_t_hx"><?php echo $xc['score'];?></span>
<div class="d_h clboth"><?php echo $xc['replies'];?>点评</div>
</li>
<?php } ?>
</ul>
</div>
</div>
<style>
.hxccon li { height:200px;}
</style><?php echo adshow("custom_315"); } } else { ?>
        <div class="layout mt10">
        	<div style="display:none;">
        <?php $bottom_ads = array('416', '409', '417'); $bottom_ad = rand(0, 2); $bottom_ad_id = $bottom_ads[$bottom_ad]; ?><?php echo adshow("custom_$bottom_ad_id"); ?></div>
<!-- 值得买 -->
            <?php include(DISCUZ_ROOT.'./source/plugin/skiing/hd_zw.php'); ?>            <?php $zhidemai_list = ForumOptionHuoDong::pianyi_sidebar(6, 'top', 'jiu', '10027'); ?>            <?php if($zhidemai_list) { ?>
            <div>
            <style>
                .zhidemaiwidth{ width:980px;}
                .zhidemaibox .zhidemailist_new li{width:144px; overflow:hidden;}
                .zhidemaibox .zhidemailist_new li img{ width:144px;}
            </style>
            <style>
/*
.zhidemaibox{ width:1100px;}

.zhidemaibox{width:980px;}
.zhidemaibox .zhidemailist_new li{width:144px; overflow:hidden;}
.zhidemaibox .zhidemailist_new li img{ width:144px;}
*/
.zhidemaibox{margin:0 auto; overflow: hidden;}
.zhidemailist_new a:hover{ text-decoration:none;}
i{ font-style:normal;}
img{ border:0;}
.zhidemailist_new:after{content: ""; display: block; clear: both; visibility: hidden;}
.zhidemailist_new{ zoom: 1;}
.zhidemailist_new{ width:1100px; overflow:hidden; margin:0 auto;}
.zhidemailist_new ul{ width:1200px;height: 268px;overflow: hidden;}
.zhidemailist_new li{ float:left; width:164px; border:#e5e5e5 solid 1px; padding:6px; margin:0px 6px 0px 0px; display:inline; position:relative;}
.zhidemailist_new li img{ width:164px;}
.zhidemailist_new li .zbname_b{ display:block; text-align:center; font-size:12px; color:#585858; margin-top:8px; height:22px; overflow:hidden; line-height:1.6;}
.zhidemailist_new li .zbname_b i{ color:#e14150;}
.zhidemailist_new li .zbinfo_c{ font-size:14px; color:#e14150; display:block; height:30px; overflow:hidden; text-align:center; font-weight:bold;}
.count_down{ font-size:14px; text-align:center; position: absolute;  color:#fff; position:absolute; top:0px; left:0px; right:0px; bottom:0px; width:100%; background:rgba(0,0,0,.7);}
.count_down_con{ z-index: 1; position:absolute; left:0px; right:0px; top:25%; }
.count_down_con b{ display:block; font-weight:normal; padding:0px 0px 5px 0px;}
.count_down em{ background:#232323; border-radius:3px; display:inline-block; font-size:14px; color:#fadf00; text-align:center; margin:0px 5px; padding:0px 3px; font-weight:bold; font-style:normal;}
.twolink a{ width:49%; float:left; height:30px; line-height:30px; color:#fff; text-align:center; font-size:12px; background:#f42f02;}
.twolink a.rightlink{ width:49%; float:right;}
.onelink a{ width:100%; float:left; height:30px; line-height:30px; color:#fff; text-align:center; font-size:12px; background:#f42f02;}
.onelink b{ width:100%; float:left; height:30px; line-height:30px; color:#fff; text-align:center; font-size:12px; background:#aaa; font-weight:normal;}
.onelink em{ font-style:normal;}
.zhidemaititlebox{ background: url(http://static.8264.com/static/images/common/zdmtitletongtiao.jpg) top center no-repeat; height: 46px;  width: 100%; padding: 0px 0px 10px 0px;}
.zhidemaititlebox a{ height:46px; display:block;}
</style>

<div class="zhidemaibox zhidemaiwidth">
    <div class="zhidemaititlebox" style="display:none;"><a href="https://8264.tmall.com/search.htm?spm=a220o.1000855.w11360013-15189811505.5.4732a2bdxZPV2E&amp;search=y&amp;orderType=defaultSort" target="_blank"></a></div>
    <div class="zhidemailist_new">
        <ul>

        <?php if(is_array($zhidemai_list)) foreach($zhidemai_list as $k => $item) { ?>            <?php if(!$item['union_url'] && !$item['lq_url'] && !$item['price_jian']) $item['url'] = $item['tg_url']; ?>            <?php if($k <= 5) { ?>
            <li>
                <a href="<?php echo $item['url'];?>" target="_blank">
                    <img src="<?php echo $item['img'];?>">
                    <span class="zbname_b"><?php echo $item['title'];?></span>
                    <span class="zbinfo_c">到手价&yen;<?php echo number_format(($item['discount_price']-$item['price_jian']), 1);; ?></span>
                </a>
                <?php if($item['lq_url']) { ?>
                    <?php if($item['union_url']) { ?>
                    <div class="twolink"><a href="<?php echo $item['union_url'];?>" target="_blank" rel="nofollow" style="width:100%;">领劵<?php echo number_format($item['price_jian']);; ?>元并购买</a></div>
                    <?php } else { ?>
                    <div class="twolink"><a href="<?php echo $item['lq_url'];?>" target="_blank" rel="nofollow">领劵&yen;<?php echo number_format($item['price_jian']);; ?></a><a href="<?php echo $item['tg_url'];?>" class="rightlink" target="_blank" rel="nofollow">去购买</a></div>
                    <?php } ?>
                <?php } else { ?>
                <div class="onelink"><a href="<?php echo $item['tg_url'];?>" target="_blank" rel="nofollow">立即购买</a></div>
                <?php } ?>
                <?php if($item['starttime'] > $_G['timestamp']) { ?>
                <div class="count_down">
                    <div class="count_down_con">
                    <b>距离抢购开始还有</b>
                    <span class="countdown" starttime="<?php echo $_G['timestamp'];?>" endtime="<?php echo $item['starttime'];?>"></span>
                    <div><a href="<?php echo $item['tg_url'];?>" target="_blank" style="padding: 12px 0 0; display: inline-block; color: #f96015; text-align: center; text-shadow: 1px 2px 2px rgba(8, 8, 8, 0.85);letter-spacing: 1px;font-size: 13px;border-bottom: 1px solid #f96015;line-height: 1.3">直接购买</a></div>
                    </div>
                </div>
                <?php } ?>
            </li>
            <?php } ?>
        <?php } ?>
        </ul>
    </div>
</div>
<script src="http://static.8264.com/static/js/jquery.countdown.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
//dom加载完执行
jQuery(function($){
    $('.countdown').each(function(i, v) {
        if (!$(this).attr('endtime')){
            return;
        }
        var _this = this;
        var str = '';
        new N.countDown({
            startTime : $(this).attr('starttime') * 1000,
            endTime : $(this).attr('endtime') * 1000,
            callback : function(day, hour, minute, second) {
                str = '<span>' + (day != 0 ? '<em>' + day + '</em>' + "天" : '') + '<em>' + formatNum(hour) + '</em>' + ":" + '<em>' + formatNum(minute) + '</em>' + ":" + '<em>' + formatNum(second) + '</em></span>';

                $(_this).html(str);

                if (day == 0 && hour == 0 && minute == 0 && second == 0) {
                    window.location.reload();
                }
            }
        });
        function formatNum(n) {
            return n < 10 ? '0' + n : n;
        }
    });
});
</script>
            </div>
            <?php } ?>
            <!-- //值得买 -->
        </div>
<?php } ?>
    
    

    
    
    
    
    
<div class="layout ptb16 hght" id="threadlist_top" style="position:relative;">
<div class="forum_post">
<?php if($_G['group']['allowpost'] || ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
<span class="forum_post_button" id="btn_box">
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>" style="display: block; width:133px; height:43px;"></a>
<em class="forum_post_outcon" id="btn_list">
<em class="forum_post_out">
<?php if(!$_G['forum']['allowspecialonly']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>">发表帖子</a><?php } if($_G['group']['allowpostpoll'] && $_G['forum']['allowpostspecial']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">发起投票</a><?php } if($_G['group']['allowpostreward'] && $_G['forum']['allowpostspecial']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">发布悬赏</a><?php } if($_G['group']['allowpostdebate'] && $_G['forum']['allowpostspecial']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">发起辩论</a><?php } if($_G['group']['allowposttrade'] && $_G['forum']['allowpostspecial']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=2">出售商品</a><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a>
<?php } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $extra;?>&amp;sortid=<?php echo $id;?>"><?php echo $threadsorts;?></a>
<?php } } } ?>
</em>
</em>
</span>
<?php if($_G['group']['allowpostactivity'] && $_G['forum']['allowpostspecial']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=4" class="fbhdbutton"></a><?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_postbutton_top'])) echo $_G['setting']['pluginhooks']['forumdisplay_postbutton_top']; ?>
</div><style>
.dfxlcon{float: left;margin-top: 13px;margin-left: 10px;}
.dfxlcon a{ color:#585858; text-decoration:none;}
.dfxlcon a:hover{ color:#162833; text-decoration:none;}
</style>
<div class="dfxlcon">
<?php if($xianluAD_difang) { ?>
<a href="http://www.zaiwai.com/xianlu-<?php echo $xianluAD_difang['goods_id'];?>?utm_source=s14363562&utm_campaign=p15027560" target="_blank" title="<?php echo diconv($xianluAD_difang['title'],'UTF-8','GBK'); ?>"><?php echo cutstr(diconv($xianluAD_difang['title'],'UTF-8','GBK'), 40); ?></a>
<?php } ?>
</div>
        <span style="position:absolute; top:30px; right:450px; display:block; width:15px; height:15px; overflow:hidden;"><script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=40");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script></span>

<div class="list_pager"><?php echo $multipage;?></div>
</div><form method="post" autocomplete="off" name="moderate" id="moderate" action="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?><?php if($_G['gp_typeid']) { ?>&amp;typeid=<?php echo $_G['gp_typeid'];?><?php } ?>&amp;infloat=yes&amp;nopost=yes">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="listextra" value="<?php echo $extra;?>" />

<div class="layout n_m_s_t" id="threadlist" style="position: relative;">
<?php if(($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable']) || $_G['forum']['threadsorts']) { ?>
<div class="layout forum_category">
<a href="<?php if($dom) { ?>http://<?php echo $dom;?>.8264.com<?php } else { ?>forum.php?mod=forumdisplay&fid=<?php echo $_G['fid'];?><?php if($_G['gp_archiveid']) { ?>&archiveid=<?php echo $_G['gp_archiveid'];?><?php } } ?>"<?php if(!$_G['gp_typeid'] && !$_G['gp_sortid']) { ?> class="zhong"<?php } ?>>全部</a>
<?php if($_G['forum']['threadtypes']) { if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $id => $name) { if($id == $thistypefatherid) { ?><h1><a href="<?php echo $_G['forum']['threadtypes']['url'][$id];?>" class="zhong">
<?php if($_G['forum']['threadtypes']['icons'][$id] && $_G['forum']['threadtypes']['prefix'] == 2) { ?><img class="vm" src="<?php echo $_G['forum']['threadtypes']['icons'][$id];?>" alt="" /><?php } ?><?php echo $name;?>
</a></h1>
<?php } else { ?>
<a href="<?php echo $_G['forum']['threadtypes']['url'][$id];?>">
<?php if($_G['forum']['threadtypes']['icons'][$id] && $_G['forum']['threadtypes']['prefix'] == 2) { ?><img class="vm" src="<?php echo $_G['forum']['threadtypes']['icons'][$id];?>" alt="" /><?php } ?><?php echo $name;?>
</a>
<?php } } } ?>
            <a href="http://www.8264.com/xuexiao/" target="_blank" style="background-color: #ff3144;color: #fff;">户外学校</a>
</div>
<?php if($_G['forum']['threadsorts']) { ?>
<div class="layout forum_category" style="border-top: none; padding: 0px 0px 10px 0px; margin-top: -6px;"><?php if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $name) { ?><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=sortid&amp;sortid=<?php echo $id;?><?php echo $forumdisplayadd['sortid'];?><?php if($_G['gp_archiveid']) { ?>&amp;archiveid=<?php echo $_G['gp_archiveid'];?><?php } ?>"<?php if($_G['gp_sortid'] == $id) { ?> class="zhong"<?php } ?>><?php echo $name;?></a>
<?php } ?>
</div>
<?php } if($_G['forum']['threadtypes']['childtypes'][$thistypefatherid]) { ?>
<div class="layout forum_category_chird">
<a href="<?php echo $_G['forum']['threadtypes']['url'][$_G['forum']['threadtypes']['fatherid'][$_G['gp_typeid']]];?>"<?php if($_G['gp_typeid'] == $thistypefatherid && !$_G['gp_sortid']) { ?> class="zhong"<?php } ?>>全部</a><?php if(is_array($_G['forum']['threadtypes']['childtypes'][$thistypefatherid])) foreach($_G['forum']['threadtypes']['childtypes'][$thistypefatherid] as $id => $name) { ?><a href="<?php echo $_G['forum']['threadtypes']['url'][$id];?>"<?php if($_G['gp_typeid'] == $id) { ?> class="zhong" <?php } ?>><?php if($_G['forum']['threadtypes']['icons'][$id] && $_G['forum']['threadtypes']['prefix'] == 2) { ?><img class="vm" src="<?php echo $_G['forum']['threadtypes']['icons'][$id];?>" alt="" /> <?php } ?><?php echo $name;?></a>
<?php } ?>
</div>
<?php } } if($_G['forum_threadcount'] && $_G['forum_toplist']) { ?>
<div class="list_forum_top_fg"><span></span></div>

<table width="0" border="0" cellspacing="0" cellpadding="0" class="bbslistbox"><?php if(is_array($_G['forum_toplist'])) foreach($_G['forum_toplist'] as $key => $thread) { ?><tr id="<?php echo $thread['id'];?>">
<td class="tb_">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['icontid'];?>&amp;<?php if($_G['gp_archiveid']) { ?>archiveid=<?php echo $_G['gp_archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>" title="<?php if(in_array($thread['displayorder'], array(1, 2, 3, 4,'p'))) { if($thread['displayorder'] == 1) { ?>本版置顶主题 - <?php } elseif($thread['displayorder'] == 2) { ?>分类置顶主题 - <?php } elseif($thread['displayorder'] == 3) { ?>全局置顶主题 - <?php } elseif($thread['displayorder'] == 4) { ?>多版置顶主题 - <?php } elseif($thread['displayorder'] == 'p') { ?>地区置顶主题 - <?php } } ?>新窗口打开" target="_blank">
<?php if($thread['folder'] == 'lock') { ?>
<img src="http://static.8264.com/static/image/common/folder_lock.gif" />
<?php } elseif($thread['special'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/pollsmall.gif" alt="投票" />
<?php } elseif($thread['special'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/tradesmall.gif" alt="商品" />
<?php } elseif($thread['special'] == 3) { ?>
<img src="http://static.8264.com/static/image/common/rewardsmall.gif" alt="悬赏" />
<?php } elseif($thread['special'] == 4) { ?>
<img src="http://static.8264.com/static/image/common/activitysmall.gif" alt="活动" />
<?php } elseif($thread['special'] == 5) { ?>
<img src="http://static.8264.com/static/image/common/debatesmall.gif" alt="辩论" />
<?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4,'p'))) { ?>
<img src="http://static.8264.com/static/image/common/pin_<?php echo $thread['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$thread['displayorder']];?>" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/folder_<?php echo $thread['folder'];?>.gif" />
<?php } ?>
</a>
</td>
<?php if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']==1) { ?>
<td class="glfx">
<?php if($thread['fid'] == $_G['fid']) { if($thread['displayorder'] <= 3 || $thread['displayorder']=='p' || $_G['adminid'] == 1) { ?>
<input onclick="tmodclick(this)" type="checkbox" name="moderate[]" value="<?php echo $thread['tid'];?>" />
<?php } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } ?>
</td>
<?php } ?>
<td class="w660">
<table width="0" border="0" cellspacing="0" cellpadding="0" class="titletable">
<tr>
<?php if(!in_array($thread['displayorder'], array(2,3,4))) { ?>
<td class="fl_17_no"><?php echo $thread['sorthtml'];?></td>
<td class="fl_17_no"><?php echo $thread['typehtml'];?></td>
<?php } ?>
<td>
<div class="title_o_t_s">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_thread'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_thread'][$key]; if($thread['moved']) { ?>移动:<?php $thread[tid]=$thread[closed]; } if($thread['isgroup'] == 1) { ?><?php $thread[tid]=$thread[closed]; ?>[<a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $groupnames[$thread['tid']]['fid'];?>" target="_blank"><?php echo $groupnames[$thread['tid']]['name'];?></a>]
<?php } ?>

<h2 style="display:inline"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;<?php if($_G['gp_archiveid']) { ?>archiveid=<?php echo $_G['gp_archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>"<?php echo $thread['highlight'];?> target="_blank" class="f_16"><?php echo $thread['subject'];?></a></h2>
<?php if($thread['multipage']) { ?><span class="tps"><?php echo $thread['multipage'];?></span><?php } if($stemplate && $sortid) { ?><?php echo $stemplate[$sortid][$thread['tid']];?><?php } if($thread['readperm']) { ?> [阅读权限 <span class="bold"><?php echo $thread['readperm'];?></span>]<?php } if($thread['price'] > 0) { if($thread['special'] == '3') { ?>
<span style="color: #C60">
悬赏<?php echo $thread['price'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?>
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
</span>
<?php } else { ?>
[售价 <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>
<span class="bold"><?php echo $thread['price'];?></span>
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>]
<?php } } elseif($thread['special'] == '3' && $thread['price'] < 0) { ?>
<span style="color: #C60">[已解决]</span>
<?php } if($thread['attachment'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/th_img.jpg" title="图片附件" style="display: none;" />
<?php } elseif($thread['attachment'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/th_fj.jpg" title="附件" style="display: none;" />
<?php } if($thread['stamp']==0 && $thread['rate']>0) { ?><img src="http://static.8264.com/static/image/common/th_b.jpg" title="奖励8264币" /><?php } if($thread['weeknew']) { ?><a href="forum.php?mod=redirect&amp;tid=<?php echo $thread['tid'];?>&amp;goto=lastpost#lastpost" class="newicon" style="display: none;">NEW</a><?php } ?>
</div>
</td>
</tr>
</table>
</td>
<td class="w105">
<span class="d_block">
<?php if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" rel="nofollow"><?php echo $thread['author'];?></a>
<?php if(!empty($verify[$thread['authorid']])) { ?><?php echo $verify[$thread['authorid']];?><?php } } else { if($_G['forum']['ismoderator']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" rel="nofollow">匿名</a><?php } else { ?>匿名<?php } } ?>
</span>
<em class="d_block" <?php if($thread['color']) { ?><?php echo $thread['color'];?><?php } ?>><?php echo $thread['dateline'];?></em>
</td>
<td class="w70">
<span class="d_block"><a class="blue"><?php echo $thread['replies'];?></a></span>
<em class="d_block"><?php if($thread['isgroup'] != 1) { ?><?php echo $thread['views'];?><?php } else { ?><?php echo $groupnames[$thread['tid']]['views'];?><?php } ?></em>
</td>
<td class="w105">
<span class="d_block">
<?php if($thread['lastposter']) { ?>
<a href="<?php if($thread['digest'] != -2) { ?>home.php?mod=space&username=<?php echo $thread['lastposterenc'];?><?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>" class="blue" c="1" rel="nofollow"><?php echo $thread['lastposter'];?></a>
<?php } else { ?>
匿名
<?php } ?>
</span>
<span class="d_block"><a href="<?php if($thread['digest'] != -2) { ?>forum.php?mod=redirect&tid=<?php echo $thread['tid'];?>&goto=lastpost<?php echo $highlight;?>#lastpost<?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>" class="gray" rel="nofollow"><?php echo $thread['lastpost'];?></a></span>
</td>
</tr>
<?php } ?>
</table>

<div class="t_ad">
    </div>
<?php } ?>

<div class="layout mt10" style="margin-bottom:10px; position:relative; display:none;">
    <!-- 广告位：戈尔先锋营 397-->
<script type='text/javascript'><!--//<![CDATA[
           var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
           var m3_r = Math.floor(Math.random()*99999999999);
           if (!document.MAX_used) document.MAX_used = ',';
           document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
           document.write ("?zoneid=38");
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
<?php if($quicksearchlist && !$_G['gp_archiveid']) { ?><div class="bbs">
<form method="post" autocomplete="off" name="searhsort" id="searhsort" class="bm_c pns mfm bbda cl" action="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=sortid&amp;sortid=<?php echo $_G['gp_sortid'];?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" /><?php if(is_array($quicksearchlist)) foreach($quicksearchlist as $optionid => $option) { ?><span class="mtm z">
<?php if(!in_array($option['type'], array('select', 'radio', 'range'))) { ?><strong><?php echo $option['title'];?>: </strong><?php } if(in_array($option['type'], array('radio', 'checkbox', 'select', 'range'))) { if($option['type'] != 'checkbox') { ?>
<span class="ftid">
<select name="searchoption[<?php echo $optionid;?>][value]" id="<?php echo $option['identifier'];?>">
<option value="0"><?php echo $option['title'];?>不限</option><?php if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { ?><option value="<?php echo $id;?>" <?php if($_G['gp_searchoption'][$optionid]['value'] == $id) { ?>selected="selected"<?php } ?>><?php echo $value;?></option>
<?php } ?>
</select>
</span>
<input type="hidden" name="searchoption[<?php echo $optionid;?>][type]" value="<?php echo $option['type'];?>">
<script type="text/javascript" reload="1">simulateSelect('<?php echo $option['identifier'];?>'<?php if($option['type'] == 'range') { ?>, 90<?php } ?>);</script>
<?php } else { if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { ?><input type="checkbox" class="pc" name="searchoption[<?php echo $optionid;?>][value][<?php echo $id;?>]" value="<?php echo $id;?>" <?php if($_G['gp_searchoption'][$optionid]['value'][$id]) { ?>checked="checked"<?php } ?>> <?php echo $value;?> 
<?php } ?>
<input type="hidden" name="searchoption[<?php echo $optionid;?>][type]" value="checkbox">
<?php } } else { if($option['type'] == 'calendar') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<input type="text" name="searchoption[<?php echo $optionid;?>][value]" size="15" class="px vm" value="<?php echo $_G['gp_searchoption'][$optionid]['value'];?>" onclick="showcalendar(event, this, false)" />
<?php } else { ?>
<input type="text" name="searchoption[<?php echo $optionid;?>][value]" size="15" class="px vm" value="<?php echo $_G['gp_searchoption'][$optionid]['value'];?>" />
<?php } } ?>
</span>
<?php } ?>
<span class="mtm z"><button type="submit" class="pn pnp vm" name="searchsortsubmit"><em>搜索</em></button></span>
</form>
<dl class="bm_c ptm tsm cl"><?php if(is_array($quicksearchlist)) foreach($quicksearchlist as $option) { ?><dt><?php echo $option['title'];?>:</dt>
<dd>
<ul>
<li<?php if($_G['gp_'.$option['identifier']] == 'all') { ?> class="a"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=sortid&amp;sortid=<?php echo $_G['gp_sortid'];?>&amp;searchsort=1<?php echo $filterurladd;?>&amp;<?php echo $option['identifier'];?>=all<?php echo $sorturladdarray[$option['identifier']];?>" class="xi2">不限</a></li><?php if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { ?><li<?php if($_G['gp_'.$option['identifier']] && $id == $_G['gp_'.$option['identifier']]) { ?> class="a"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=sortid&amp;sortid=<?php echo $_G['gp_sortid'];?>&amp;searchsort=1&amp;<?php echo $option['identifier'];?>=<?php echo $id;?><?php echo $sorturladdarray[$option['identifier']];?>" class="xi2"><?php echo $value;?></a></li>
<?php } ?>
</ul>
</dd>
<?php } ?>
</dl>
</div><?php } ?>

<div class=" layout forum_screeningwarpten">
<div class="forum_screening_l">
<a href="http://bbs.8264.com/forum-<?php if($forumOption->isDigested($_G['fid'])) { ?>forumdisplay-fid-<?php echo $_G['fid'];?>-all<?php } else { ?><?php echo $_G['fid'];?><?php } ?>-1.html"<?php if(!in_array($filter,array('digest','heat','recommend','specialtype')) && !$_G['gp_digest'] && !$_G['gp_specialtype']) { ?> class="zhong"<?php } ?>>全部</a>
<a href="http://bbs.8264.com/forum-forumdisplay-fid-<?php echo $_G['fid'];?>-filter-digest-digest-1.html"<?php if($filter == 'digest' || $_G['gp_digest']) { ?> class="zhong"<?php } ?>>精华</a>
<a href="http://bbs.8264.com/forum-forumdisplay-fid-<?php echo $_G['fid'];?>-filter-heat-orderby-heats.html"<?php if($filter == 'heat') { ?> class="zhong"<?php } ?>>热门</a>

<?php if((in_array($_G['fid'],array(158,101,166,113,110,112,108,176,117,104,106,109,111,115,170,143,177,103,165,107,48,102,100,139,171,105,147,164,114,159,116)))) { ?>
<a href="http://bbs.8264.com/forum-forumdisplay-fid-<?php echo $_G['fid'];?>-filter-specialtype-specialtype-activity.html"<?php if($filter == 'specialtype' || $_G['gp_specialtype']) { ?> class="zhong"<?php } ?>>最新活动</a>
<?php } if($_G['fid'] == 24 ) { ?><a href="http://bbs.8264.com/forum-forumdisplay-fid-5-filter-typeid-typeid-556.html" target="_blank">登山活动</a><?php } if($_G['fid'] == 69 ) { ?><a href="http://bbs.8264.com/forum-161-1.html" target="_blank">出国约伴</a><?php } if($forumOption->isDigested($_G['fid'])) { if($_G['gp_all']==1) { ?>
<a href="http://bbs.8264.com/forum-forumdisplay-fid-<?php echo $_G['fid'];?>.html">精品推荐</a>
<?php } } if(!empty($_G['setting']['recommendthread']['status'])) { ?>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=recommend&amp;orderby=recommends&amp;recommend=1<?php echo $forumdisplayadd['recommend'];?><?php if($_G['gp_archiveid']) { ?>&amp;archiveid=<?php echo $_G['gp_archiveid'];?><?php } ?>"<?php if($filter == 'recommend') { ?> class="zhong"<?php } ?>>推荐</a>
<?php } if($subexists && $_G['page'] == 1) { ?><?php $subCount = count($sublist);$i=1; if(is_array($sublist)) foreach($sublist as $sub) { ?><?php $forumurl = !empty($sub['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$sub['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$sub['fid']; ?><a href="<?php echo $forumurl;?>"<?php if(!empty($sub['redirect'])) { ?> target="_blank"<?php } ?>><span><?php echo $sub['name'];?></span><span>(<?php echo $sub['todayposts'];?>)</span><span class="zbk"></span></a><?php $i++; } } ?>
</div>
<div class="forum_screening_r">
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=lastpost&amp;orderby=lastpost<?php echo $forumdisplayadd['lastpost'];?><?php if($_G['gp_archiveid']) { ?>&amp;archiveid=<?php echo $_G['gp_archiveid'];?><?php } ?>" class="reply<?php if($_G['gp_orderby'] == 'lastpost') { ?> zhong<?php } ?>"></a>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=author&amp;orderby=dateline<?php echo $forumdisplayadd['author'];?><?php if($_G['gp_archiveid']) { ?>&amp;archiveid=<?php echo $_G['gp_archiveid'];?><?php } ?>" class="publish<?php if($_G['gp_orderby'] == 'dateline') { ?> zhong<?php } ?>"></a>
</div>
</div>

<?php if($_G['forum_threadcount'] && $_G['forum_middlelist']) { ?>
<table width="0" border="0" cellspacing="0" cellpadding="0" class="bbslistbox">
<tr>
<th colspan="<?php if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']==1) { ?>3<?php } else { ?>2<?php } ?>" class="t_i26"><?php echo $_G['forum']['name'];?>论坛 本版置顶</th>
<th>作者/发布时间</th>
<th>回复/查看</th>
<th>最后回复</th>
</tr><?php if(is_array($_G['forum_middlelist'])) foreach($_G['forum_middlelist'] as $key => $thread) { ?><tr id="<?php echo $thread['id'];?>">
<td class="tb_">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['icontid'];?>&amp;<?php if($_G['gp_archiveid']) { ?>archiveid=<?php echo $_G['gp_archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>" title="<?php if(in_array($thread['displayorder'], array(1, 2, 3, 4,'p'))) { if($thread['displayorder'] == 1) { ?>本版置顶主题 - <?php } elseif($thread['displayorder'] == 2) { ?>分类置顶主题 - <?php } elseif($thread['displayorder'] == 3) { ?>全局置顶主题 - <?php } elseif($thread['displayorder'] == 4) { ?>多版置顶主题 - <?php } elseif($thread['displayorder'] == 'p') { ?>地区置顶主题 - <?php } } ?>新窗口打开" target="_blank">
<?php if($thread['folder'] == 'lock') { ?>
<img src="http://static.8264.com/static/image/common/folder_lock.gif" />
<?php } elseif($thread['special'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/pollsmall.gif" alt="投票" />
<?php } elseif($thread['special'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/tradesmall.gif" alt="商品" />
<?php } elseif($thread['special'] == 3) { ?>
<img src="http://static.8264.com/static/image/common/rewardsmall.gif" alt="悬赏" />
<?php } elseif($thread['special'] == 4) { ?>
<img src="http://static.8264.com/static/image/common/activitysmall.gif" alt="活动" />
<?php } elseif($thread['special'] == 5) { ?>
<img src="http://static.8264.com/static/image/common/debatesmall.gif" alt="辩论" />
<?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4,'p'))) { ?>
<img src="http://static.8264.com/static/image/common/pin_<?php echo $thread['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$thread['displayorder']];?>" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/folder_<?php echo $thread['folder'];?>.gif" />
<?php } ?>
</a>
</td>
<?php if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']==1) { ?>
<td class="glfx">
<?php if($thread['fid'] == $_G['fid']) { if($thread['displayorder'] <= 3 || $thread['displayorder']=='p' || $_G['adminid'] == 1) { ?>
<input onclick="tmodclick(this)" type="checkbox" name="moderate[]" value="<?php echo $thread['tid'];?>" />
<?php } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } ?>
</td>
<?php } ?>
<td class="w660">
<table width="0" border="0" cellspacing="0" cellpadding="0" class="titletable">
<tr>
<?php if(!in_array($thread['displayorder'], array(2,3,4))) { ?>
<td class="fl_17_no"><?php echo $thread['sorthtml'];?></td>
<td class="fl_17_no"><?php echo $thread['typehtml'];?></td>
<?php } ?>
<td>
<div class="title_o_t_s">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_thread'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_thread'][$key]; if($thread['moved']) { ?>移动:<?php $thread[tid]=$thread[closed]; } if($thread['isgroup'] == 1) { ?><?php $thread[tid]=$thread[closed]; ?>[<a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $groupnames[$thread['tid']]['fid'];?>" target="_blank"><?php echo $groupnames[$thread['tid']]['name'];?></a>]
<?php } ?>

<h2 style="display:inline"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;<?php if($_G['gp_archiveid']) { ?>archiveid=<?php echo $_G['gp_archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>"<?php echo $thread['highlight'];?> target="_blank" class="f_16"><?php echo $thread['subject'];?></a></h2>
<?php if($thread['multipage']) { ?><span class="tps"><?php echo $thread['multipage'];?></span><?php } if($stemplate && $sortid) { ?><?php echo $stemplate[$sortid][$thread['tid']];?><?php } if($thread['readperm']) { ?> [阅读权限 <span class="bold"><?php echo $thread['readperm'];?></span>]<?php } if($thread['price'] > 0) { if($thread['special'] == '3') { ?>
<span style="color: #C60">
悬赏<?php echo $thread['price'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?>
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
</span>
<?php } else { ?>
[售价 <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>
<span class="bold"><?php echo $thread['price'];?></span>
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>]
<?php } } elseif($thread['special'] == '3' && $thread['price'] < 0) { ?>
<span style="color: #C60">[已解决]</span>
<?php } if($thread['attachment'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/th_img.jpg" title="图片附件" style="display: none;" />
<?php } elseif($thread['attachment'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/th_fj.jpg" title="附件" style="display: none;" />
<?php } if($thread['stamp']==0 && $thread['rate']>0) { ?><img src="http://static.8264.com/static/image/common/th_b.jpg" title="奖励8264币" /><?php } if($thread['weeknew']) { ?><a href="forum.php?mod=redirect&amp;tid=<?php echo $thread['tid'];?>&amp;goto=lastpost#lastpost" class="newicon" style="display: none;">NEW</a><?php } ?>
</div>
</td>
</tr>
</table>
</td>
<td class="w105">
<span class="d_block">
<?php if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" rel="nofollow"><?php echo $thread['author'];?></a>
<?php if(!empty($verify[$thread['authorid']])) { ?><?php echo $verify[$thread['authorid']];?><?php } } else { if($_G['forum']['ismoderator']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" rel="nofollow">匿名</a><?php } else { ?>匿名<?php } } ?>
</span>
<em class="d_block" <?php if($thread['color']) { ?><?php echo $thread['color'];?><?php } ?>><?php echo $thread['dateline'];?></em>
</td>
<td class="w70">
<span class="d_block"><a class="blue"><?php echo $thread['replies'];?></a></span>
<em class="d_block"><?php if($thread['isgroup'] != 1) { ?><?php echo $thread['views'];?><?php } else { ?><?php echo $groupnames[$thread['tid']]['views'];?><?php } ?></em>
</td>
<td class="w105">
<span class="d_block">
<?php if($thread['lastposter']) { ?>
<a href="<?php if($thread['digest'] != -2) { ?>home.php?mod=space&username=<?php echo $thread['lastposterenc'];?><?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>" class="blue" c="1" rel="nofollow"><?php echo $thread['lastposter'];?></a>
<?php } else { ?>
匿名
<?php } ?>
</span>
<span class="d_block"><a href="<?php if($thread['digest'] != -2) { ?>forum.php?mod=redirect&tid=<?php echo $thread['tid'];?>&goto=lastpost<?php echo $highlight;?>#lastpost<?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>" class="gray" rel="nofollow"><?php echo $thread['lastpost'];?></a></span>
</td>
</tr>
<?php } ?>
</table>
<?php } ?>
<!-- 本版二维码 -->
<style type="text/css">
.blk-adv{float:right;margin-right:12px;position:relative; display:none;}
.blk-adv a{padding-left:15px;background:url(http://static.8264.com/static/images/forum/qr.png) no-repeat;}
.code-content{position:absolute;display:none;padding:12px 12px 8px;width:118px;background-color:#4e5b64;right:-12px;z-index: 999;text-indent:0;}
.code-content p{font-size:12px;color:#fff;line-height:16px;text-align:center;padding-top:8px;}
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {
$(".blk-adv").hover(function() {
$(".code-content", this).show();
}, function() {
$(".code-content", this).hide();
});
});
</script>
<!-- //本版二维码 -->



    <?php if($_G['fid'] == 24 ) { ?>
    <div class="layout mt10" style="margin-bottom:10px; position:relative; display:none;">
    <?php echo adshow("custom_463"); ?>    <span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px; line-height:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
    </div>
    <?php } ?>


    <?php if($_G['fid'] == 135 ) { ?>
    <div class="layout mt10" style="margin-bottom:10px; position:relative; display:none;">
    <?php echo adshow("custom_464"); ?>    <span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px; line-height:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
    </div>
    <?php } if($_G['forum_threadcount'] && $_G['forum_mainlist']) { ?>
<table width="0" border="0" cellspacing="0" cellpadding="0" class="bbslistbox">
<tr>
<?php if($_G['forum_threadcount'] && $_G['forum_middlelist']) { ?>
<th colspan="<?php if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']==1) { ?>6<?php } else { ?>5<?php } ?>" class="t_i26"><?php echo $_G['forum']['name'];?>论坛 帖子标题
<!-- 本版二维码 -->
<?php if(in_array($_G['fid'], array('24', '88', '179', '186', '447', '495'))) { ?>
<div class="blk-adv">
<a href="javascript(0);"><?php echo $_G['forum']['name'];?>版微信公众号</a>
<div class="code-content" style="display: none;">
<img src="http://static.8264.com/static/images/erweima/<?php echo $_G['fid'];?>.jpg" alt="" width="118">
<p>打开微信扫一扫，精彩内容天天推</p>
</div>
</div>
<?php } ?>
<!-- //本版二维码 -->
</th>
<?php } else { ?>
<th colspan="<?php if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']==1) { ?>3<?php } else { ?>2<?php } ?>" class="t_i26"><?php echo $_G['forum']['name'];?>论坛 帖子标题</th>
<th>作者/发布时间</th>
<th>回复/查看</th>
<th>最后回复</th>
<?php } ?>
</tr><?php if(is_array($_G['forum_mainlist'])) foreach($_G['forum_mainlist'] as $key => $thread) { ?><?php echo adshow("threadlist"); ?><tr id="<?php echo $thread['id'];?>">
<td class="tb_">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['icontid'];?>&amp;<?php if($_G['gp_archiveid']) { ?>archiveid=<?php echo $_G['gp_archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>" title="<?php if(in_array($thread['displayorder'], array(1, 2, 3, 4,'p'))) { if($thread['displayorder'] == 1) { ?>本版置顶主题 - <?php } elseif($thread['displayorder'] == 2) { ?>分类置顶主题 - <?php } elseif($thread['displayorder'] == 3) { ?>全局置顶主题 - <?php } elseif($thread['displayorder'] == 4) { ?>多版置顶主题 - <?php } elseif($thread['displayorder'] == 'p') { ?>地区置顶主题 - <?php } } ?>新窗口打开" target="_blank">
<?php if($thread['folder'] == 'lock') { ?>
<img src="http://static.8264.com/static/image/common/folder_lock.gif" />
<?php } elseif($thread['special'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/pollsmall.gif" alt="投票" />
<?php } elseif($thread['special'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/tradesmall.gif" alt="商品" />
<?php } elseif($thread['special'] == 3) { ?>
<img src="http://static.8264.com/static/image/common/rewardsmall.gif" alt="悬赏" />
<?php } elseif($thread['special'] == 4) { ?>
<img src="http://static.8264.com/static/image/common/activitysmall.gif" alt="活动" />
<?php } elseif($thread['special'] == 5) { ?>
<img src="http://static.8264.com/static/image/common/debatesmall.gif" alt="辩论" />
<?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4,'p'))) { ?>
<img src="http://static.8264.com/static/image/common/pin_<?php echo $thread['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$thread['displayorder']];?>" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/folder_<?php echo $thread['folder'];?>.gif" />
<?php } ?>
</a>
</td>
<?php if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']==1) { ?>
<td class="glfx">
<?php if($thread['fid'] == $_G['fid']) { if($thread['displayorder'] <= 3 || $thread['displayorder']=='p' || $_G['adminid'] == 1) { ?>
<input onclick="tmodclick(this)" type="checkbox" name="moderate[]" value="<?php echo $thread['tid'];?>" />
<?php } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } ?>
</td>
<?php } ?>
<td class="w660">
<table width="0" border="0" cellspacing="0" cellpadding="0" class="titletable">
<tr>
<?php if(!in_array($thread['displayorder'], array(2,3,4))) { ?>
<td class="fl_17_no"><?php echo $thread['sorthtml'];?></td>
<td class="fl_17_no"><?php echo $thread['typehtml'];?></td>
<?php } ?>
<td>
<div class="title_o_t_s">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_thread'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_thread'][$key]; if($thread['moved']) { ?>移动:<?php $thread[tid]=$thread[closed]; } if($thread['isgroup'] == 1) { ?><?php $thread[tid]=$thread[closed]; ?>[<a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $groupnames[$thread['tid']]['fid'];?>" target="_blank"><?php echo $groupnames[$thread['tid']]['name'];?></a>]
<?php } ?>

<h2 style="display:inline"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;<?php if($_G['gp_archiveid']) { ?>archiveid=<?php echo $_G['gp_archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>"<?php echo $thread['highlight'];?> target="_blank" class="f_16"><?php echo $thread['subject'];?></a></h2>
<?php if($thread['multipage']) { ?><span class="tps"><?php echo $thread['multipage'];?></span><?php } if($stemplate && $sortid) { ?><?php echo $stemplate[$sortid][$thread['tid']];?><?php } if($thread['readperm']) { ?> [阅读权限 <span class="bold"><?php echo $thread['readperm'];?></span>]<?php } if($thread['price'] > 0) { if($thread['special'] == '3') { ?>
<span style="color: #C60">
悬赏<?php echo $thread['price'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?>
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
</span>
<?php } else { ?>
[售价 <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>
<span class="bold"><?php echo $thread['price'];?></span>
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>]
<?php } } elseif($thread['special'] == '3' && $thread['price'] < 0) { ?>
<span style="color: #C60">[已解决]</span>
<?php } if($thread['attachment'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/th_img.jpg" title="图片附件" style="display: none;" />
<?php } elseif($thread['attachment'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/th_fj.jpg" title="附件" style="display: none;" />
<?php } if($thread['stamp']==0 && $thread['rate']>0) { ?><img src="http://static.8264.com/static/image/common/th_b.jpg" title="奖励8264币" /><?php } if($thread['weeknew']) { ?><a href="forum.php?mod=redirect&amp;tid=<?php echo $thread['tid'];?>&amp;goto=lastpost#lastpost" class="newicon" style="display: none;">NEW</a><?php } ?>
</div>
</td>
</tr>
</table>
</td>
<td class="w105">
<span class="d_block">
<?php if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" rel="nofollow"><?php echo $thread['author'];?></a>
<?php if(!empty($verify[$thread['authorid']])) { ?><?php echo $verify[$thread['authorid']];?><?php } } else { if($_G['forum']['ismoderator']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" rel="nofollow">匿名</a><?php } else { ?>匿名<?php } } ?>
</span>
<em class="d_block" <?php if($thread['color']) { ?><?php echo $thread['color'];?><?php } ?>><?php echo $thread['dateline'];?></em>
</td>
<td class="w70">
<span class="d_block"><a class="blue"><?php echo $thread['replies'];?></a></span>
<em class="d_block"><?php if($thread['isgroup'] != 1) { ?><?php echo $thread['views'];?><?php } else { ?><?php echo $groupnames[$thread['tid']]['views'];?><?php } ?></em>
</td>
<td class="w105">
<span class="d_block">
<?php if($thread['lastposter']) { ?>
<a href="<?php if($thread['digest'] != -2) { ?>home.php?mod=space&username=<?php echo $thread['lastposterenc'];?><?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>" class="blue" c="1" rel="nofollow"><?php echo $thread['lastposter'];?></a>
<?php } else { ?>
匿名
<?php } ?>
</span>
<span class="d_block"><a href="<?php if($thread['digest'] != -2) { ?>forum.php?mod=redirect&tid=<?php echo $thread['tid'];?>&goto=lastpost<?php echo $highlight;?>#lastpost<?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>" class="gray" rel="nofollow"><?php echo $thread['lastpost'];?></a></span>
</td>
</tr>
<?php } ?>
</table>
<?php } if($_G['forum']['ismoderator'] && $_G['forum_threadcount']) { include template('forum/topicadmin_modlayer'); } ?>

</div>

</form>


<div class="layout ptb16">
<div class="forum_post">
<?php if($_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
<span class="forum_post_button" id="btn_box_down">
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>" style="display: block; width:133px; height:43px;"></a>
<em class="forum_post_outcon" id="btn_list_down">
<em class="forum_post_out">
<?php if(!$_G['forum']['allowspecialonly']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>">发表帖子</a><?php } if($_G['group']['allowpostpoll']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">发起投票</a><?php } if($_G['group']['allowpostreward']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">发布悬赏</a><?php } if($_G['group']['allowpostdebate']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">发起辩论</a><?php } if($_G['group']['allowpostactivity']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=4">发起活动</a><?php } if($_G['group']['allowposttrade']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=2">出售商品</a><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a>
<?php } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $extra;?>&amp;sortid=<?php echo $id;?>"><?php echo $threadsorts;?></a>
<?php } } } ?>
</em>
</em>
</span>
<?php } ?>
</div>
<div class="list_pager"><?php echo $multipage;?></div>
</div>

<div class="share_bd_warpten">
<ul class="bbs_share_sc">
<li>
<a href="http://bbs.8264.com/forum-post-action-newthread-fid-12.html" class="p-btn-c btn-28">
<img src="http://static.8264.com/static/images/common/yjdp1.gif?<?php echo VERHASH;?>"/>
</a>
</li>
<li><a href="http://bbs.8264.com/thread-791154-1-1.html" target="_blank" class="kfhelf"></a></li>
<li class="ps_re" id="share">
<a href="javascript:;" class="share"></a>
<div class="bdsharebuttonbox share_bd" data-tag="share_1">
<a href="javascript:;" class="sina" data-cmd="tsina"></a>
<a href="javascript:;" class="qq" data-cmd="qzone"></a>
<a href="javascript:;" class="wb" data-cmd="tqq"></a>
<a href="javascript:;" class="wx" data-cmd="weixin"></a>
</div>
</li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>" class="bbsli" title="返回帖子列表"></a></li>
<li id="gotop_50"><a style="display: none;" href="javascript:;" class="gotop_50"></a></li>
</ul>
</div>
<script src="http://static.8264.com/static/js/layer/layer.js" type="text/javascript" type="text/javascript"></script>
<script>
function quick_reply_form() {
    layer.open({
      type: 2,
      title: '点评户外装备',
      shadeClose: false,
      shade: 0.8,
      area: ['710px', '600px'],
      content: 'plugin.php?id=forumoption:quick_reply&tpl=equipment&mod=equipment&des_type=<?php echo $_G['fid'];?>'
    });
}
window._bd_share_config = {
common : {
//此处放置通用设置
},
share : [
//此处放置分享按钮设置
{"tag" : "share_1", "bdSize" : 32}
]
}
with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
(function($){
var ww=$(window).width();
var s_bd_r=Math.max((ww-980)/2-60,0);
$(".share_bd_warpten").css("right",s_bd_r);

//鼠标移入分享后向左边弹出分享按钮
$("#share").hover(
function () {
$(".share_bd",this).show();
},
function () {
$(".share_bd",this).hide();
}
);
//返回顶部按钮
if($(window).scrollTop() > 10){$("#gotop_50 a").show();}
$(window).scroll( function(){
if($(window).scrollTop()>10){
$("#gotop_50 a").show();
}else{
$("#gotop_50 a").hide();
}
});
$("#gotop_50").click(function(){
$("html,body").animate({ scrollTop: 0 },500);
});




})(jQuery);
</script>
<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=button&amp;mini=1&amp;uid=39357" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<!-- Baidu Button END -->
<?php if($_G['fid'] == 186 ) { ?><?php echo adshow("custom_447"); } } ?>
<!--[diy=diyfastposttop]--><div id="diyfastposttop" class="area"></div><!--[/diy]-->


<div id="fastpost" style="display: none;">
<?php if($fastpost && $_G['group']['allowpost']) { include template('forum/forumdisplay_fastpost'); } ?>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_bottom'])) echo $_G['setting']['pluginhooks']['forumdisplay_bottom']; ?>
<!--[diy=diyforumdisplaybottom]--><div id="diyforumdisplaybottom" class="area"></div><!--[/diy]-->
<!-- </div></div> -->

<?php if($_G['setting']['visitedforums'] || $oldthreads) { ?>
<div id="visitedforums_menu" class="<?php if($oldthreads) { ?>visited_w <?php } ?>p_pop blk cl" style="display: none;">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if($_G['setting']['visitedforums']) { ?>
<td id="v_forums"><h3 class="mbn pbn bbda xg1">浏览过的版块</h3><ul><?php echo $_G['setting']['visitedforums'];?></ul></td>
<?php } if($oldthreads) { ?>
<td id="v_threads"><h3 class="mbn pbn bbda xg1">浏览过的帖子</h3>
<ul class="xl"><?php if(is_array($oldthreads)) foreach($oldthreads as $oldtid => $oldsubject) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $oldtid;?>"><?php echo $oldsubject;?></a></li>
<?php } ?>
</ul>
</td>
<?php } ?>
</tr>
</table>
</div>
<?php } if($_G['setting']['forumjump']) { ?><div class="p_pop" id="fjump_menu" style="display: none"><?php echo $forummenu;?></div><?php } if($_G['setting']['threadmaxpages'] > 1 && $page) { ?>
<script type="text/javascript">
document.onkeyup = function(e){
keyPageScroll(e, <?php if($page > 1) { ?>1<?php } else { ?>0<?php } ?>, <?php if($page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']) { ?>1<?php } else { ?>0<?php } ?>, 'forum.php?mod=forumdisplay&fid=<?php echo $_G['fid'];?>&filter=<?php echo $filter;?>&orderby=<?php echo $_G['gp_orderby'];?><?php echo $forumdisplayadd['page'];?>&<?php echo $multipage_archive;?>', <?php echo $page;?>);
}
</script>
<?php } ?>
<div class="wp mtn"><!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]--></div>

<?php if($fiter_string) { ?>
<script type="text/javascript">
var hidden_id = new Array();
var display_or_not=1;
var tipstring = "个新人报道未显示";
window.onload=checkcookie();
function checkcookie(){
if(getcookie('hidden_fiter')==1){
changestyle(0);
}else{
fiter_forum();
}
}
function changestyle(stated){
    if(stated == 1){
        document.getElementById("fiter_forum").style.backgroundPosition = " 0 2px";
        display_or_not = 0;
    }else{
        document.getElementById("fiter_forum").style.backgroundPosition = "0 -37px";
        display_or_not = 1;
    }
}
function getClassName(n) {
    var arr = document.getElementById("moderate").getElementsByTagName("a");
var retarr = new Array();
var num=0;
for(i=0;i<arr.length;i++){
var fff = arr.item(i);
if(fff.className==n){
retarr[num]=fff;
num++;
}
}
return retarr;
}
function display_fiternum(){
    if(document.getElementById("fiter_forum").getAttribute("title")!="" && document.getElementById("fiter_forum").getAttribute("title")!="0"+tipstring){

} else{
document.getElementById("fiter_forum").removeAttribute("title");
}
}
function fiter_forum(){
if(display_or_not == 1){
var classname = getClassName("xst");
var len = classname.length;
var fiterstr = [<?php echo $fiter_string;?>];
var hidden_len = 0;
for(i=<?php echo $startnum;?>;i<len;i++){
var thissubject = classname[i];
for(j=0;j<fiterstr.length;j++){
if(thissubject.innerHTML.indexOf(fiterstr[j])!=-1){
thissubject.parentNode.parentNode.parentNode.setAttribute("style","display:none");
hidden_id[hidden_len] = thissubject.parentNode.parentNode.parentNode
hidden_len++;
j=fiterstr.length;
}
}
}
        changestyle(1);
document.getElementById("fiter_forum").setAttribute("title",hidden_id.length+tipstring);
        display_fiternum();
setcookie('hidden_fiter', 0, 86400);
}
}

function get_display_len(){
var num=0;
for(i=0;i<hidden_id.length;i++){
var hid_or_vi = hidden_id[i];
if(hid_or_vi.getAttribute("style")=="display:none"){
num++;
}
}
return num;
}
function display_hidden(){
var h_len = hidden_id.length;
if(h_len>0){
for(i=0;i<h_len;i++){
var hid_or_vi = hidden_id[i];
hid_or_vi.setAttribute("style","display:table-row-group")
}
hidden_id=[];
document.getElementById("fiter_forum").setAttribute("title",get_display_len()+tipstring);
        display_fiternum();
setcookie('hidden_fiter', 1, 86400);
        changestyle(0);
} else {
fiter_forum();
}
}
</script>


<?php if(($_G['fid']==53||$_G['fid']==169)) { ?>
<div><div style="text-align:center;"><iframe src="/plugin.php?id=tuaninvoke:goods" frameBorder=0 name="iframe"  scrolling="no" height="260" width="100%" marginheight="0" marginwidth="0"></iframe></div></div>
<?php } } ?>

</div><!-- End wp --><style type="text/css">
    .side-float{
        position: fixed;
        width: 161px;
        height: 149px;
        bottom: 260px;
        margin-left: 500px;
        background: url(http://static.8264.com/static/images/tps/v1/scan-161-149.png) no-repeat;
        display: none;
    }
    .side-a{
        display: block;
        width: 100%;
        height: 100%;
    }
    .side-float .side-close{
        position: absolute;
        width: 10px;
        height: 10px;
        right: 1px;
        top: 8px;
        cursor: pointer;
        z-index: 999999;
    }
</style>

<div class="side-float">
    <a class="side-a" href="http://u.8264.com/home-task-do-view-id-1264.html" target="_blank" id="qr_src"></a>
    <span class="side-close"></span>
</div>
<script>
    /*jQuery.get("home.php?mod=task", {is_qr_display:1},function(data) {
        if(data.taskid > 0){
            jQuery('#qr_src').attr('href','home.php?mod=task&do=view&id='+data.taskid);
        }
    },'json');*/

//先注释掉
//    if(!getcookie("qr-dialog")) {
//        jQuery(".side-float").show();
//    }
//    jQuery(".side-close").click(function (){
//        jQuery(".side-float").hide();
//        setcookie("qr-dialog", 1, 86400);
//    });
//    jQuery(function(){
//        var width_q = jQuery(window).width();
//        var r_z = (width_q-980)/2 -170;
//        if(r_z<0){
//            jQuery(".side-float").css("right",'0px');
//        }else{
//            jQuery(".side-float").css("right",r_z);
//        };
//    });
</script><?php echo adshow("custom_443"); ?><div class="clearfix"></div>
<div class="footer">
<div class="layout" style="padding: 26px 0px 26px 0px; position:relative;">
<div class="topHill">顶部小山</div>
<!-- 精选 -->
<div class="choiceness"><?php block_display('6905'); ?></div>
</div>

<?php if(empty($gid) && empty($_G['fid']) && ($_G['cache']['forumlinks']['forum']['index']['0'] || $_G['cache']['forumlinks']['forum']['index']['1'] || $_G['cache']['forumlinks']['forum']['index']['2'])) { ?>
<div class="friendLink">
<div class="layout">
<ul>
<?php if($_G['cache']['forumlinks']['forum']['index']['0']) { ?>
<?php echo $_G['cache']['forumlinks']['forum']['index']['0'];?>
<?php } if($_G['cache']['forumlinks']['forum']['index']['1']) { ?>
<?php echo $_G['cache']['forumlinks']['forum']['index']['1'];?>
<?php } if($_G['cache']['forumlinks']['forum']['index']['2']) { ?>
<?php echo $_G['cache']['forumlinks']['forum']['index']['2'];?>
<?php } ?>
</ul>
</div>
</div>
<?php } if($_G['fid'] && ($_G['cache']['forumlinks']['forum'][$_G['fid']]['0'] || $_G['cache']['forumlinks']['forum'][$_G['fid']]['1'] || $_G['cache']['forumlinks']['forum'][$_G['fid']]['2'])) { ?>
<div class="friendLink">
<div class="layout">
<ul>
<?php if($_G['cache']['forumlinks']['forum'][$_G['fid']]['0']) { ?>
<?php echo $_G['cache']['forumlinks']['forum'][$_G['fid']]['0'];?>
<?php } if($_G['cache']['forumlinks']['forum'][$_G['fid']]['1']) { ?>
<?php echo $_G['cache']['forumlinks']['forum'][$_G['fid']]['1'];?>
<?php } if($_G['cache']['forumlinks']['forum'][$_G['fid']]['2']) { ?>
<?php echo $_G['cache']['forumlinks']['forum'][$_G['fid']]['2'];?>
<?php } ?>
</ul>
</div>
</div>
<?php } ?></div>
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