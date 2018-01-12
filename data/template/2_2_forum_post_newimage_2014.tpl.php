<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post_newimage_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/forum/post_newimage_2014.htm', './template/8264/common/header_8264_new.htm', 1509517878, '2', './data/template/2_2_forum_post_newimage_2014.tpl.php', './template/8264', 'forum/post_newimage_2014')
|| checktplrefresh('./template/8264/forum/post_newimage_2014.htm', './template/8264/forum/post_newimage_2014_editor.htm', 1509517878, '2', './data/template/2_2_forum_post_newimage_2014.tpl.php', './template/8264', 'forum/post_newimage_2014')
|| checktplrefresh('./template/8264/forum/post_newimage_2014.htm', './template/8264/forum/editor_menu_forum_newimage_2014.htm', 1509517878, '2', './data/template/2_2_forum_post_newimage_2014.tpl.php', './template/8264', 'forum/post_newimage_2014')
|| checktplrefresh('./template/8264/forum/post_newimage_2014.htm', './template/8264/common/footer_8264_new.htm', 1509517878, '2', './data/template/2_2_forum_post_newimage_2014.tpl.php', './template/8264', 'forum/post_newimage_2014')
|| checktplrefresh('./template/8264/forum/post_newimage_2014.htm', './template/8264/common/header_common.htm', 1509517878, '2', './data/template/2_2_forum_post_newimage_2014.tpl.php', './template/8264', 'forum/post_newimage_2014')
|| checktplrefresh('./template/8264/forum/post_newimage_2014.htm', './template/8264/common/index_ad_top.htm', 1509517878, '2', './data/template/2_2_forum_post_newimage_2014.tpl.php', './template/8264', 'forum/post_newimage_2014')
|| checktplrefresh('./template/8264/forum/post_newimage_2014.htm', './template/8264/common/editor_2014.htm', 1509517878, '2', './data/template/2_2_forum_post_newimage_2014.tpl.php', './template/8264', 'forum/post_newimage_2014')
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
<link href="http://static.8264.com/static/css/forum/forum_post.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">

<?php if($_G['gp_action'] == 'edit') { ?><?php $editor[value] = $postinfo[message]; } else { ?><?php $editor[value] = $message; } ?>
<div class="header">
<div class="layout">
<div class="icoHill">山</div>
<div class="headerL">
<?php if($_G['forum']['extra']['localname']) { ?>
<div class="whereIs" style="display: none;"><?php echo $_G['forum']['extra']['localname'];?></div>
<?php } ?>
<h1><span class="country"><a href="<?php echo $returnurl;?>"><?php echo $_G['forum']['name'];?></a></span></h1>
<div class="site">
<a href="<?php echo $_G['config']['web']['portal'];?>" title="首页" id="fjump"<?php if($_G['setting']['forumjump'] == 1) { ?> onmouseover="showMenu({'ctrlid':this.id})"<?php } ?>>首页</a>
<?php echo $navigation;?>
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
</div>
</div>
</div>
<script src="http://static.8264.com/static/js/forum_post.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<!--<script src="http://static.8264.com/static/js/jquery.md5.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/jquery.base64.js" type="text/javascript"></script>-->
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/fu.css?<?php echo VERHASH;?>" />
<script type="text/javascript">
function addAttach(){}
function switchImagebutton(){}
function getimagethumbbyauto(width, height, type, filepath){
/*var returnurl = '';
jQuery.noConflict();
;(function($){
var md5str = $.md5(filepath);
var base64code = $.base64.btoa(filepath, false);
returnurl = 'thumbimg/' + md5str[0] + '/' + md5str[3] + '/' + parseInt(width).toString() + '/' + parseInt(height).toString() + '/' + parseInt(type).toString() + '/' + base64code + '.auto.jpg';
})(jQuery);
return returnurl;*/
}
var attachserver = "<?php if(empty($_G['config']['web']['attachauto'])) { ?><?php echo $_G['config']['web']['attach'];?><?php } else { ?><?php echo $_G['config']['web']['attachauto'];?><?php } ?>";
var attachserver_image = "http://<?php echo $_G['config']['cdn']['images']['cdnurl'];?>";
var posonshow = false;
function uploadsuccess(type, returndata) {
eval('var nattach = ' + returndata + ';');
jQuery.noConflict();
;(function($){
if(nattach.nowcount < 50 || type != 3){
if(document.getElementById('image_td_' + nattach.fileid) == null){
$('#imagetemp').clone().attr('id', 'image_td_' + nattach.fileid).attr('title', nattach.filename).appendTo('#uploadimagelist').show();
if(! posonshow){
var attachobj = $('#image_td_' + nattach.fileid);
var show_Windows = $('#uploadimagelist').parent();
var show_WindowsPos = {top: show_Windows.offset().top, bottom: show_Windows.offset().top + show_Windows.height()};
var attachPos = {top: attachobj.offset().top, bottom: attachobj.offset().top + attachobj.height()};
var nowScroll = show_Windows.scrollTop();
/*if(show_WindowsPos.top > attachPos.top){
posonshow = true;
show_Windows.scrollTop(nowScroll - show_WindowsPos.top + attachPos.top)
}else*/ if(show_WindowsPos.bottom < attachPos.bottom){
posonshow = true;
show_Windows.scrollTop(nowScroll + attachPos.bottom - show_WindowsPos.bottom)
}
}
}
}
if(isUndefined(nattach.bigthumbpic) || nattach.bigthumbpic == ''){
//nattach.bigthumbpic = attachserver + getimagethumbbyauto(300, 300, 1, nattach.type + "/" + nattach.pic);
if(nattach.thumbpic.match(/t2w\d+h\d+/) != null){
nattach.bigthumbpic = nattach.thumbpic.replace(/t2w\d+h\d+/, "t1w300h300");
}else{
nattach.bigthumbpic = nattach.thumbpic.replace(/\/\d\d+\/\d\d+\/2\//, "/300/300/1/");
}
}
var attachobj = $('#image_td_' + nattach.fileid);
var show_Windows = $('#uploadimagelist').parent();
var show_WindowsPos = {top: show_Windows.offset().top, bottom: show_Windows.offset().top + show_Windows.height()};
var attachPos = {top: attachobj.offset().top, bottom: attachobj.offset().top + attachobj.height()};
var nowScroll = show_Windows.scrollTop();
switch(type){
case 1:
case 2:
posonshow = false;
attachobj.find('.temppercent').remove();
attachobj.find('img').attr('id', 'image_' + nattach.aid).attr('aid', nattach.aid).attr('src', nattach.thumbpic).attr('bigthumb', nattach.bigthumbpic).click(function(){
if(! $(this).parent().hasClass('imgdeleted')){
insertAttachimgTag(nattach.aid);
$('#<?php echo $editorid;?>_iframe').contents().trigger('keyup');
}
}).one('error', function(){
$(this).attr('src', ' ');
$(this).attr('src', nattach.thumbpic);
}).show();
nattach.rename_id_fun = function(){
attachobj.attr('id', 'image_td_' + nattach.aid);
}
attachobj.find('a.close14_14_24w').click(function(){
delImgAttach(nattach.aid);
});
attachobj.find('input.description').attr('name', 'attachnew[' + nattach.aid + '][description]').attr('id', 'image_desc_' + nattach.aid).end().show();
$('#uploadimagediv').show().prev().hide();
setTimeout(nattach.rename_id_fun, 2000);
break;
case 3:
var percent = Math.floor((nattach.nowcount * 100) / nattach.maxcount);
if(percent > 100){
percent = 100;
}
attachobj.find('.temppercent').children('h5').text(nattach.text).end().find('b').text(percent + ' %');
$('#uploadimagediv').show().prev().hide();

break;
}
attachobj.find('input.albumabout').val(nattach.aid);
if($('#selectsavealbum input[name=insertall]').is(':checked')){
attachobj.find('input.albumabout').removeAttr('disabled');
}
})(jQuery);
}
</script>
<script type="text/javascript">
function validateextra(theform){
if(in_array($('postsubmit').name, ['topicsubmit', 'editsubmit'])) {
if(theform.typeid && theform.typeid.value == 0 && typerequired) {
showDialog('请选择主题对应的分类');
return false;
}
if(theform.sortid && theform.sortid.value == 0 && sortrequired) {
showDialog('请选择主题对应的分类信息');
return false;
}
}
if(jQuery('#selectsavealbum input.inputfx[name=insertall]').is(':checked')){
if(jQuery('#selectsavealbum input[name=uploadalbum]').val() == 0 && jQuery('#createnewalbum input.cjxctext[name=newalbum]').val().length < 3){
showDialog('您选择了将图片保存到相册，但并未选择保存相册名或未输入新相册名');
return false;
}
}
return true;
}
</script>
<script type="text/javascript">
function addattachlist(returndata){
eval('var nattach = ' + returndata + ';');
jQuery.noConflict();
;(function($){
var extpos = nattach.filename.lastIndexOf('.');
nattach.fileext = extpos == -1 ? '' : nattach.filename.substr(extpos + 1, nattach.filename.length).toLowerCase();
var objcontent = nattach.old == 1 ? '#attachlist_old' : '#attachlist';
$('#attachlisttmp').clone().attr('id', 'newattach_id_' + nattach.aid).prependTo(objcontent);
var obj_attachlt = $('#newattach_id_' + nattach.aid);
obj_attachlt.find('a.linkicon').click(function(){
insertText('attach://' + nattach.aid + '.' + nattach.fileext );
$('#<?php echo $editorid;?>_iframe').contents().trigger('keyup');
});
obj_attachlt.find('input.description').attr('name', 'attachnew[' + nattach.aid + '][description]');
obj_attachlt.find('a.nameicon').text(nattach.filename).attr('title', nattach.filename + "\n上传日期: " + nattach.uploadtime).click(function(){
insertAttachTag(nattach.aid);
$('#<?php echo $editorid;?>_iframe').contents().trigger('keyup');
});
<?php if($_G['group']['allowsetattachperm'] && ($_G['gp_action'] == 'newthread' || ($_G['gp_action'] == 'edit' && $isfirstpost))) { ?>
obj_attachlt.children('.readpowercon').css('z-index', 100).children('input.readperm').attr('name', 'attachnew[' + nattach.aid + '][readperm]');
obj_attachlt.find('.readtext_out').attr('id', nattach.aid + '_readperm_menu').attr('faid', nattach.aid).hide().appendTo('#append_parent');
obj_attachlt.find('.readtext').attr('mid', nattach.aid + '_readperm_menu');
if(nattach.readperm > 0){
obj_attachlt.find('>.readpowercon>input.readperm').val(nattach.readperm);
}
<?php } if($_G['gp_action'] == 'edit') { ?>
if(nattach.old == 0){
obj_attachlt.find('a.updateattachlink').click(function(){
var myname = $(this).siblings('a.nameicon');
uploadWindow(function(aid, url, name){
if(document.getElementById("attachupdate" + nattach.aid) == null){
obj_attachlt.append("<input name='attachupdate[" + nattach.aid + "]' type='hidden' id='attachupdate" + nattach.aid + "' />");
}
$('#attachupdate' + nattach.aid).val(aid);
myname.attr('title', '').html(name);
}, 'file');
}).show();
}
<?php } ?>
obj_attachlt.find('span.del').click(function(event){
$('#listofattach').append("<input type='hidden' name='attachdel[]' value='" + nattach.aid + "'/>");
$(this).parent('li').remove();
});
if(nattach.descr != null){
obj_attachlt.find('>.miaoshu>input.description').val(nattach.descr);
}
obj_attachlt.show();
$('#noattachtips').appendTo('#alltemplateobj');
//$('.fujiancon>.fujian_list.listattach').show();
if($('#listofattach').find('li').length > 6){
$('#listofattach').css({'overflow-y':'scroll',height:'300px'});
}else{
$('#listofattach').css('height', 'auto');
}
$('#<?php echo $editorid;?>_attachn').show();
})(jQuery);
}
</script>
<?php if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) { ?>
<!-- @提醒 -->
<script type="text/javascript">
function atlist_hide() {
jQuery(".atpop").hide();
}

function atlist_get(inputchar) {
var atList = document.getElementById("atlist");
var dom_li = '<li class="list-title">\u9009\u62e9\u6700\u8fd1@\u7684\u4eba\u6216\u5728\u4e0a\u65b9\u67e5\u8be2</li>';
var followlist = function(inputchar){
jQuery.getJSON(SITEURL+'forum.php', {mod:"misc", action:"followlist", username:inputchar}, function(followlist){
if(followlist.length > 0) {
for (var i = 0,len = followlist.length; i < len; i++) {
dom_li += '<li class="list-content">'+ followlist[i]+'</li>';
};
atList.innerHTML = dom_li;
atList.style.display = 'block';
} else {
atList.style.display = 'none';
}

var listClick = atList.getElementsByTagName("li");
for (var i = 1,len = listClick.length; i < len; i++) {
listClick[i].onmouseover = (function(i) {
return function() {
for (var l = 1; l < len; l++) {
listClick[l].className = 'list-content';
};
listClick[i].className = 'list-content list-active';
}
})(i);

listClick[i].onclick = (function(i) {
return function() {
insertText('@' + listClick[i].innerHTML + ' ', false);
atlist_hide();
}
})(i);
};

});
}
followlist(inputchar);
}

function atlist_show() {
atlist_get();
jQuery(".atpop").show();
}
</script>
<!-- //@提醒 -->
<?php } ?>
<div id="alltemplateobj" class="templist" style="display: none;visibility: hidden;">
<div style="display: none;visibility: hidden;">
<span id="<?php echo $editorid;?>_font"></span>
<span id="<?php echo $editorid;?>_size"></span>
<span id="<?php echo $editorid;?>_simple"></span>
<span id="<?php echo $editorid;?>_adv_s1"></span>
<span id="<?php echo $editorid;?>_adv_s2"></span>
<span id="<?php echo $editorid;?>_svdsecond" href="javascript:;"></span>
</div>
<ul><li id="imagetemp" style="display: none;"><img cwidth="112" style="display: none;" /><div class="temppercent"><h5></h5><p><b></b></p></div><a href="javascript:;" class="close14_14_24w closepostion"></a><input type="hidden" name="" class="description"/><input type="hidden" class="albumabout" name="albumaid[]" disabled="true" /></li></ul>
<div id="attachbtnhiddentmp" style="display:none"><span><form name="attachform" id="attachform" method="post" autocomplete="off" action="misc.php?mod=swfupload&amp;operation=upload&amp;simple=1&amp;newjq=1" target="attachframe" <?php echo $enctype;?>><input type="hidden" name="uid" value="<?php echo $_G['uid'];?>" /><input type="hidden" name="hash" value="<?php echo md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid']); ?>" /><input type="file" name="Filedata" size="45" class="fldt" /></form></span></div>
<ul><li id="attachbodyhiddentmp" style="display: none;"><span></span><em></em><input type="hidden" name="localid[]" /></li></ul>
<ul><li id="attachlisttmp" class="fujian_list_td clboth" style="display: none;">
<span class="filename">
<a href="javascript:void(0);" class="nameicon">1375868390680</a>
<a href="javascript:void(0);" title="添加附件地址" class="linkicon"></a>
<a href="javascript:void(0);" title="更新附件地址" class="updateattachlink" style="display: none;">更新</a>
</span>
<span class="readpowercon">
<?php if($_G['group']['allowsetattachperm'] && ($_G['gp_action'] == 'newthread' || ($_G['gp_action'] == 'edit' && $isfirstpost))) { ?>
<em class="readtext">不限</em>
<input type="hidden" class="readperm" name="" value="<?php echo $attach['readperm'];?>"/>
<em class="readtext_out">
<?php if($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost) { if(is_array($_G['cache']['groupreadaccess'])) foreach($_G['cache']['groupreadaccess'] as $val) { ?><a href="javascript:void(0);" readperm="<?php echo $val['readaccess'];?>" title="阅读权限: <?php echo $val['readaccess'];?>"><?php echo $val['grouptitle'];?></a>
<?php } } ?>
</em>
<?php } ?>
</span>
<span class="miaoshu"><input class="description" name="" type="text" /></span>
<span class="del"></span>
</li>
</ul>
</div><?php
$actiontitle = <<<EOF


EOF;
 if($_G['gp_action'] == 'newthread') { if($special == 0) { 
$actiontitle .= <<<EOF
发表帖子

EOF;
 } elseif($special == 1) { 
$actiontitle .= <<<EOF
发起投票

EOF;
 } elseif($special == 2) { 
$actiontitle .= <<<EOF
出售商品

EOF;
 } elseif($special == 3) { 
$actiontitle .= <<<EOF
发布悬赏

EOF;
 } elseif($special == 4) { 
$actiontitle .= <<<EOF
发起活动

EOF;
 } elseif($special == 5) { 
$actiontitle .= <<<EOF
发起辩论

EOF;
 } elseif($specialextra) { 
$actiontitle .= <<<EOF
{$_G['setting']['threadplugins'][$specialextra]['name']}

EOF;
 } } elseif($_G['gp_action'] == 'reply' && !empty($_G['gp_addtrade'])) { 
$actiontitle .= <<<EOF

添加商品

EOF;
 } elseif($_G['gp_action'] == 'reply') { 
$actiontitle .= <<<EOF

参与/回复主题

EOF;
 } elseif($_G['gp_action'] == 'edit') { if($special == 2) { 
$actiontitle .= <<<EOF
编辑商品
EOF;
 } else { 
$actiontitle .= <<<EOF
编辑帖子
EOF;
 } } 
$actiontitle .= <<<EOF


EOF;
?><?php
$icon = <<<EOF


EOF;
 if($special == 1) { 
$icon .= <<<EOF
poll

EOF;
 } elseif($special == 2) { 
$icon .= <<<EOF
trade

EOF;
 } elseif($special == 3) { 
$icon .= <<<EOF
reward

EOF;
 } elseif($special == 4) { 
$icon .= <<<EOF
activity

EOF;
 } elseif($special == 5) { 
$icon .= <<<EOF
debate

EOF;
 } elseif($isfirstpost && $sortid) { 
$icon .= <<<EOF
sort

EOF;
 } 
$icon .= <<<EOF


EOF;
?>

<?php if($_G['gp_action'] != 'newthread') { ?><?php $subjectcut = cutstr($thread[subject], 30); } ?><?php
$actionsubject = <<<EOF


EOF;
 if($_G['gp_action'] == 'reply') { 
$actionsubject .= <<<EOF

<em>&rsaquo;</em><a href="forum.php?mod=viewthread&amp;tid={$thread['tid']}">{$subjectcut}</a>

EOF;
 } elseif($_G['gp_action'] == 'edit') { 
$actionsubject .= <<<EOF

<em>&rsaquo;</em><a href="forum.php?mod=redirect&amp;goto=findpost&amp;ptid={$thread['tid']}&amp;pid={$pid}">{$subjectcut}</a>

EOF;
 } 
$actionsubject .= <<<EOF


EOF;
?><?php $adveditor = $isfirstpost && $special || $special == 2 && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'reply' && !empty($_G['gp_addtrade']) || $_G['gp_action'] == 'edit' && $thread['special'] == 2); ?><?php $advmore = !$showthreadsorts && !$special || $_G['gp_action'] == 'reply' && empty($_G['gp_addtrade']) || $_G['gp_action'] == 'edit' && !$isfirstpost && ($thread['special'] == 2 && !$special || $thread['special'] != 2); ?><div class="layout fu">
<div class="mn">
<form method="post" autocomplete="off" onsubmit="check_subject();return validate(this);" id="postform"
<?php if($_G['gp_action'] == 'newthread') { ?>action="forum.php?mod=post&amp;action=<?php if($special != 2) { ?>newthread<?php } else { ?>newtrade<?php } ?>&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $extra;?>&amp;topicsubmit=yes"
<?php } elseif($_G['gp_action'] == 'reply') { ?>action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $_G['gp_repquote'];?>&amp;postid=<?php echo $_G['gp_postid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=<?php echo $_G['gp_way'];?>&amp;cid=<?php echo $_G['gp_cid'];?>&amp;extra=<?php echo $extra;?>&amp;replysubmit=yes"
<?php } elseif($_G['gp_action'] == 'edit') { ?>action="forum.php?mod=post&amp;action=edit&amp;extra=<?php echo $extra;?>&amp;editsubmit=yes" <?php echo $enctype;?>
<?php } ?>
>
<input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="posttime" id="posttime" value="<?php echo TIMESTAMP;?>" />
<input style="display: none;" type="checkbox" id="allowimgcode" class="pc" disabled="disabled"<?php if($_G['forum']['allowimgcode']) { ?> checked="checked"<?php } ?> />
<input type="hidden" name="usesig" id="usesig" class="pc" value="1" <?php if(!$_G['group']['maxsigsize']) { ?>disabled <?php } else { ?><?php echo $usesigcheck;?> <?php } ?>/>
<?php if(!empty($_G['gp_modthreadkey'])) { ?><input type="hidden" name="modthreadkey" id="modthreadkey" value="<?php echo $_G['gp_modthreadkey'];?>" /><?php } ?>
<input type="hidden" name="wysiwyg" id="<?php echo $editorid;?>_mode" value="<?php echo $editormode;?>" />
<?php if($_G['gp_action'] == 'reply') { ?>
<input type="hidden" name="noticeauthor" value="<?php echo $noticeauthor;?>" />
<input type="hidden" name="noticetrimstr" value="<?php echo $noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $noticeauthormsg;?>" />
<?php if($_G['gp_reppost']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_G['gp_reppost'];?>" />
<?php } elseif($_G['gp_repquote']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_G['gp_repquote'];?>" />
<?php } } if($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit') { ?>
<input type="hidden" name="allownoticeauthor" value="1" />
<?php } if($_G['gp_action'] == 'edit') { ?>
<input type="hidden" name="fid" id="fid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="tid" value="<?php echo $_G['tid'];?>" />
<input type="hidden" name="pid" value="<?php echo $pid;?>" />
<input type="hidden" name="page" value="<?php echo $_G['gp_page'];?>" />
<?php } if($special) { ?>
<input type="hidden" name="special" value="<?php echo $special;?>" />
<?php } if($specialextra) { ?>
<input type="hidden" name="specialextra" value="<?php echo $specialextra;?>" />
<?php } ?>
<div class="bm bw0 cl"<?php if(!$showthreadsorts && !$adveditor) { ?> id="editorbox"<?php } ?>>
<h3 class="futitle" style="position:relative;">
<span id="returnmessage" style="display: inline-block; padding: 6px 0px 0px;">
<?php echo $actiontitle;?>
<?php if($showthreadsorts) { ?> <?php echo $_G['forum']['threadsorts']['types'][$sortid];?><?php } if($_G['gp_action'] == 'newthread' && $modnewthreads) { ?><span class="xg1">(需审核)</span><?php } if($_G['gp_action'] == 'reply' && $modnewreplies) { ?><span class="xg1">(需审核)</span><?php } if($_G['gp_action'] == 'edit' && $isfirstpost && $thread['displayorder'] == -4) { ?><span class="xg1">(草稿)</span><?php } ?>
</span>
<?php if($special==4) { ?><a href="http://bbs.8264.com/thread-5422622-1-1.html" target="_blank" style="position: absolute; left: 110px; top: 12px; font-size: 14px;">长期征集各地俱乐部团队户外活动作业（图文并茂） 8264帮你宣传俱乐部</a><?php } ?>
</h3>
<div id="postbox">
<?php if(!empty($_G['setting']['pluginhooks']['post_top'])) echo $_G['setting']['pluginhooks']['post_top']; ?>
<div class="pbt clboth">
<?php if(!$special && ($threadsorts = $_G['forum']['threadsorts']) && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost && !$thread['sortid'])) { ?>
<div class="pbt_select needdown">
<div class="pbt_select_option_box showdowndiv"><?php if(is_array($threadsorts['types'])) foreach($threadsorts['types'] as $tsortid => $name) { if($sortid == $tsortid) { ?><?php $nowselect_sortid = array('sorid' => $tsortid, 'name' => strip_tags($name)); } ?>
<a hid="<?php echo $tsortid;?>" href="javascript:;"><?php echo strip_tags($name);; ?></a>
<?php } ?>
</div>
<span>
<?php if($nowselect_sortid) { ?>
<input type="hidden" name="sortid" value="<?php echo $nowselect_sortid['sorid'];?>" /><span><?php echo $nowselect_sortid['name'];?></span>
<?php } else { ?>
<input type="hidden"  name="sortid" value="0"/><span>选择分类信息</span>
<?php } ?>
</span>
</div>
<?php } if($_G['gp_action'] == 'edit' && $isfirstpost && $sortid) { ?>
<input type="hidden" name="sortid" value="<?php echo $sortid;?>" />
<?php } if($isfirstpost && !empty($_G['forum']['threadtypes']['types']) && $special != 4) { ?>
<div class="pbt_select needdown">
<div class="pbt_select_option_box showdowndiv"><?php if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $typeid => $name) { if($thread['typeid'] == $typeid || $_G['gp_typeid'] == $typeid) { ?><?php $nowselect_typeid = array('typeid' => $typeid, 'name' => strip_tags($name)); } ?>
<a hid="<?php echo $typeid;?>" href="javascript:;"><?php echo strip_tags($name);; ?></a>
<?php } ?>
</div>
<span>
<?php if($nowselect_typeid) { ?>
<input type="hidden" name="typeid" value="<?php echo $nowselect_typeid['typeid'];?>" /><span><?php echo $nowselect_typeid['name'];?></span>
<?php } else { ?>
<input type="hidden"  name="typeid" value="0"/><span>选择分类信息</span>
<?php } ?>
</span>
</div>
<?php } if(!$isfirstpost && $thread['special'] == 5 && empty($firststand) && $_G['gp_action'] != 'edit') { ?>
<div class="pbt_select needdown">
<div class="pbt_select_option_box showdowndiv">
<a hid="0">中立</a>
<a hid="1"<?php if($stand == 1) { ?> selected="selected"<?php } ?>>正方</a>
<a hid="2"<?php if($stand == 2) { ?> selected="selected"<?php } ?>>反方</a>
</div>
<span>
<?php if($stand > 0) { ?>
<input type="hidden" name="stand" value="<?php echo $stand;?>"/><span><?php if($stand == 1) { ?>正方<?php } else { ?>反方<?php } ?></span>
<?php } elseif($stand == 0) { ?>
<input type="hidden" name="stand" value="<?php echo $stand;?>"/><span>中立</span>
<?php } else { ?>
<input type="hidden" name="stand" value=""/><span>选择观点</span>
<?php } ?>
</span>
</div>
<?php } if(!($special == 4 && $isfirstpost)) { ?>
<div class="pbt_title">
<?php if($_G['gp_action'] == 'reply' && !empty($_G['gp_addtrade']) || $_G['gp_action'] == 'edit' && $thread['special'] == 2 && !$postinfo['first']) { ?>
<input name="subject" type="hidden" value="" />
<?php } else { if($_G['gp_action'] == 'reply' || ($_G['gp_action'] == 'edit' && ! $isfirstpost)) { ?>
<span id="subjecthide" style="overflow: hidden;" class="z">RE: <?php echo $thread['subject'];?> <span style="display: none;">[<a href="javascript:;" onclick="display('subjecthide');display('subjectbox');$('subject').value='RE: <?php echo htmlspecialchars(str_replace('\'', '\\\'', $thread['subject'])); ?>';display('subjectchk');strLenCalc($('subject'), 'checklen', 80);">修改</a>]</span></span>
<span id="subjectbox" style="display:none"><input type="text" name="subject" id="subject" class="px" value="" onkeyup="strLenCalc(this, 'checklen', 80);" tabindex="1" /></span>
<?php } else { ?>
<span><input type="text" name="subject" id="subject" class="px" value="<?php echo $postinfo['subject'];?>" onkeyup="strLenCalc(this, 'checklen', 80);" tabindex="1" /></span>
<?php } } ?>
<input class="subject_tips" type="hidden" disabled="true" value="标题严禁使用【】等异形符号，违者删帖"/>
</div>
<span id="subjectchk" class="pbt_title_note" <?php if($_G['gp_action'] == 'reply') { ?> style="display:none"<?php } ?>>还可输入 <strong id="checklen">80</strong> 个字符</span>
<?php } ?>
<!--图片分楼按钮-->
<?php if($_G['fid'] != 53 && $special != 4) { ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_tpfl_return'])) echo $_G['setting']['pluginhooks']['post_tpfl_return']; } ?>
<!--图片分楼按钮 end-->
</div>
<?php if($showthreadsorts) { ?>
<div class="exfm cl" id="threadsorts">
<span id="threadsortswait"></span>
</div>
<?php } elseif($adveditor) { if($special == 1) { include template('forum/post_poll'); } elseif($special == 2 && ($_G['gp_action'] != 'edit' || ($_G['gp_action'] == 'edit' && ($thread['authorid'] == $_G['uid'] && $_G['group']['allowposttrade'] || $_G['group']['allowedittrade'])))) { ?><p class="xg1">添加商品信息，完成后可在本帖中继续添加多个商品</p><?php include template('forum/post_trade'); } elseif($special == 3) { include template('forum/post_reward'); } elseif($special == 4) { include template('forum/post_activity'); } elseif($special == 5) { include template('forum/post_debate'); } elseif($specialextra) { ?><div class="specialpost s_clear"><?php echo $threadplughtml;?></div>
<?php } } if($_G['gp_action'] == 'reply' && $quotemessage) { ?>
<div class="pbt cl"><?php echo $quotemessage;?></div>
<?php } ?>
<div id="rstnotice" style="display:none"></div>
<?php if($_G['gp_action'] == 'edit' && $isorigauthor && ($isfirstpost && $thread['replies'] < 1 || !$isfirstpost) && !$rushreply && $_G['setting']['editperdel']) { ?>
<div class="xzgl clboth"><input type="checkbox" name="delete" id="delete" value="1" title="删除本帖<?php if($thread['special'] == 3) { ?>，返还悬赏费用，不退还手续费。<?php } ?>" /><label for="delete"><span>勾选后，提交"保存"，即可删除本条帖子，删除后无法恢复。</span></label></div>
<?php } ?>

<!--编辑器-->
<?php if(!($adveditor && $special == 4)) { ?><div class="clboth pt26" id="<?php echo $editorid;?>_body">
<div class="fu_l">
<div class="editerbox">
<div id="<?php echo $editorid;?>_controls" class="edierbar clboth">
<a id="<?php echo $editorid;?>_bold" title="文字加粗" class="bold"></a>
<div class="font_size">
<a href="javascript:;" class="small" onclick="discuzcode('fontsize', 2);" title="小"  ></a>
<a href="javascript:;" class="medium" onclick="discuzcode('fontsize', 3);" title="中"  ></a>
<a href="javascript:;" class="large" onclick="discuzcode('fontsize', 4);" title="大"  ></a>
</div>

<div class="colorbox">
<a href="javascript:;" class="gray" title="灰色" onclick="discuzcode('forecolor', '#585858')" onmouseout="setEditorTip('')" onmouseover="setEditorTip('灰色')" ></a>
<a href="javascript:;" class="blue" title="蓝色" onclick="discuzcode('forecolor', 'Blue')" onmouseout="setEditorTip('')" onmouseover="setEditorTip('蓝色')" ></a>
<a href="javascript:;" class="red" title="红色" onclick="discuzcode('forecolor', 'Red')" onmouseout="setEditorTip('')" onmouseover="setEditorTip('红色')" ></a>
</div>

<div class="text_align">
<a id="<?php echo $editorid;?>_justifyleft" class="text_left" title="居左"></a>
<a id="<?php echo $editorid;?>_justifycenter" class="text_center" title="居中"></a>
</div>
<div class="fjicon">
<a title="添加链接" cate="link" class="linkicon" href="javascript:void(0);"></a>
<?php if($_G['forum']['allowmediacode']) { ?>
<a class="shipinicon" cate="shipin" title="添加视频" href="javascript:void(0);"></a>
<?php } if($_G['group']['allowpostattach']) { ?>
<a cate="fujian" class="fujianicon" title="添加附件" href="javascript:void(0);"><span class="tanhao" style="display: none;" id="<?php echo $editorid;?>_attachn"></span></a>
<?php } ?>
<div class="fujianout" cate="fujian" id="<?php echo $editorid;?>_attach_menu" style="display:none;<?php if(! $_G['forum']['allowmediacode']) { ?>left:40px;<?php } ?>">
<div class="bqtitle">
<a cate='listattach' href="javascript:;" class="zhong" >附件列表</a>
<?php if($allowuploadnum) { ?><a cate='uploadattach' href="javascript:;">普通上传</a><?php } ?>
<span class="close14_14_24w closepostion"></span>
</div>
<div class="fujiancon">
<div id="noattachtips" class="fujinaup listattach" <?php if(empty($attachs['used']) && empty($attachs['unused'])) { ?> style="display:block;"<?php } ?>>
<div class="imgupcon">
<p>本帖还没有附件</p>
<input name="" type="button" class="imgfjbutton" />
</div>
</div>
<div class="fujian_list listattach" <?php if(empty($attachs['used']) && empty($attachs['unused'])) { ?>style="display:none;"<?php } ?>>
<ul>
<li class="fujian_list_th clboth">
<span class="filename">文件名</span>
<span class="readpower needdown">
<?php if($_G['group']['allowsetattachperm']) { ?>
阅读权限
<em class="notecon showdowndiv">阅读权限按由高到低排列，高于或等于选中组的用户才可以阅读。</em>
<?php } ?>
</span>
<span class="info">描述</span>
</li>
</ul>
<span id="listofattach" style="display: block; position:relative">
<ul id="attachlist"></ul>
<div class="tsupfujian">以下是你上次上传但没有使用的附件</div>
<ul id="attachlist_old"></ul>
<div style="clear: both;"></div>
</span>
<div class="shuoming">点击文件名添加到帖子内容中，<em>"attach://"</em> 开头的附件地址支持任何人下载请谨慎添加</div>
</div>
<div class="fujinaup uploadattach" style="display:none;">
<ul class="clboth" id="attach_upload_body"></ul>
<div class="notice">
<p>
文件尺寸: 小于 8.7MB<br/>
可用扩展名: <?php echo str_replace(array('jpeg,','gif,','jpg,','png,') ,'' ,$_G['group']['attachextensions']) ?> <br/>
此处只允许上传除图片外的其他文件，上传图片请点击页面右侧上传按钮
</p>
<p id="attachbtn" style="text-align:center"></p>
<div class="noticetj" id="uploadbtn"><input name="" type="button" class="qxbutton" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="button" class="tjbutton" /></div>
<span id="uploadingtips">
<p style="text-align: center;"><img src="http://static.8264.com/static/image/common/uploading.gif" style="vertical-align: middle;"/></p>
<div class="noticeshangchuan">上传中，请稍后，您可以暂时关闭小窗口，上传完成后会提示您。</div>
</span>
</div>
</div>
</div>
</div>
<div class="shipinout" cate="shipin">
<div class="shipinclose"><span class="close14_14_24w closepostion"></span></div>
<div class="formshipin">
<span class="weblink"><input name="" type="text" class="input230" /><em>请输入视频文件地址</em></span>
<span class="w_h">
<em>宽：<input name="" type="text" class="input52" value="500" /></em>
<em>高：<input name="" type="text" class="input52" value="375" /></em>
</span>
<span class="fxauto clboth"><input name="" type="checkbox" value="" /><label>是否自动播放</label></span>
<span class="notice">支持优酷、土豆、56、酷六等视频网址<br>支持 wma avi rmvb mov swf flv 等音乐格式<br>示例：http://sever/movie.wma</span>
</div>
<div class="tjqx"><input name="" type="button" class="qxbutton" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="button" class="tjbutton tjb" /></div>
</div>
<div class="linkout" cate="link">
<div class="linkoutclose"><span class="close14_14_24w closepostion"></span></div>
<div class="formlink">
<span class="weblink"><input type="text" class="input230" /><em>请输入链接地址</em></span>
<span class="weblink"><input type="text" class="input230" /><em>请输入链接文字</em></span>
</div>
<div class="tjqx"><input type="button" class="qxbutton" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="tjbutton tjb" /></div>
</div>
</div>
<?php if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) { ?>
<!-- @提醒 -->
<div class="fjicon">
<a href="javascript:void(0);" class="aticon" onclick="atlist_show();"></a>
<div class="atpop out">
<div class="linkoutclose" onclick="javascript:atlist_hide();"><span class="close14_14_24w closepostion"></span></div>
<div class="formlink">
<span class="weblink"><input type="text" class="input230" name="username" onkeyup="atlist_get(this.value)" /><em>请输入您要@的用户名</em></span>
</div>
<div class="atlist" id="atlist"></div>
</div>
</div>
<!-- //@提醒 -->
<?php } ?>
<label id="<?php echo $editorid;?>_switcher" class="y" ><input id="<?php echo $editorid;?>_switchercheck" type="checkbox" class="pc" name="checkbox" value="0" <?php if(!$editor['editormode']) { ?>checked="checked"<?php } ?> onclick="switchEditor(this.checked?0:1)" />纯文本</label>
<div id="<?php echo $editorid;?>_button">
<div id="<?php echo $editorid;?>_adv_s0">
<a id="<?php echo $editorid;?>_paste"></a>
</div>
</div>
</div>
<div class="edt areatext" style="height: 400px;"><textarea name="<?php echo $editor['textarea'];?>" id="<?php echo $editorid;?>_textarea" class="pt" tabindex="2" rows="15"><?php echo $editor['value'];?></textarea></div><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/editor.css?<?php echo VERHASH;?>" />
<script src="http://static.8264.com/static/js/editor.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/bbcode.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var editorid = '<?php echo $editorid;?>';
var textobj = $(editorid + '_textarea');
var wysiwyg = (BROWSER.ie || BROWSER.firefox || (BROWSER.opera >= 9)) && parseInt('<?php echo $editor['editormode'];?>') == 1 ? 1 : 0;
var allowswitcheditor = parseInt('<?php echo $editor['allowswitcheditor'];?>');
var allowhtml = parseInt('<?php echo $editor['allowhtml'];?>');
var allowsmilies = parseInt('<?php echo $editor['allowsmilies'];?>');
var allowbbcode = parseInt('<?php echo $editor['allowbbcode'];?>');
var allowimgcode = parseInt('<?php echo $editor['allowimgcode'];?>');
var simplodemode = parseInt('<?php if($editor['simplemode'] > 0) { ?>1<?php } else { ?>0<?php } ?>');
var fontoptions = new Array("仿宋_GB2312", "黑体", "楷体_GB2312", "宋体", "新宋体", "微软雅黑", "Trebuchet MS", "Tahoma", "Arial", "Impact", "Verdana", "Times New Roman");
var custombbcodes = new Array();
<?php if($_G['cache']['bbcodes_display'][$_G['groupid']]) { if(is_array($_G['cache']['bbcodes_display'][$_G['groupid']])) foreach($_G['cache']['bbcodes_display'][$_G['groupid']] as $tag => $bbcode) { ?>custombbcodes["<?php echo $tag;?>"] = {'prompt' : '<?php echo $bbcode['prompt'];?>'};
<?php } } if($editor['simplemode'] > 0) { ?>
editorsimple();
<?php } ?>
</script>
<div class="aretzt clboth">
<span id="<?php echo $editorid;?>_tip" class="le"></span>
<span class="ri">
&nbsp;
<a href="javascript:;" onclick="discuzcode('svd');return false;" id="<?php echo $editorid;?>_svd">保存数据</a> |&nbsp;
<a href="javascript:;" onclick="discuzcode('rst');return false;" id="<?php echo $editorid;?>_rst">恢复数据</a>
</span>
</div></div>
</div>
<div class="fu_r">
<div class="imgfbbox" id="right_tools">
<div class="imgfbtitle">
<span class="zhong uploadpic">上传图片</span><span class="usealbum">使用相册</span>
</div>
<div class="uploadpicshow imgfbboxcon">
<div class="imgfbboxcon">
<div class="imgfbbox_1">
<div class="imgupbuttoncon">

<div style="margin:0 auto;width:208px;">
<input id="fid" value="<?php echo $_G['fid'];?>" type="hidden">
<input id="editorid" value="<?php echo $editorid;?>" type="hidden">
<input id="url_action" value="<?php echo $action;?>" type="hidden">
<input id="url_policy" value="<?php echo $policy;?>" type="hidden">
<input id="url_signature" value="<?php echo $sign;?>" type="hidden">

<div id="filePicker">请选择图片</div>
<div><p style="display:none;" id="uploadtips"></p></div>
</div>

<script src="http://static.8264.com/static/js/webuploader.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/webuploader_forum_start.js?<?php echo VERHASH;?>" type="text/javascript"></script>
</div>
<div class="imgmoreup">
<span class="imgmoreupicon"></span>
<span><img src="http://static.8264.com/static/images/common/imglistbg.jpg"/></span>
<span class="note">可批量上传50张图片<br/>单张图片不超过8.7M<br/>图片边长小于2500像素<br/>支持jpg、jpeg、gif、png格式</span>
</div>
<div style="display:none" id="uploadimagediv">
<div class="imglistcon clboth">
<ul id="uploadimagelist">
<?php if(!empty($imgattachs['used'])) { ?><?php $imagelist = $imgattachs['used']; include template('forum/ajax_imagelist'); ?>            				        <?php } ?>
                                    <?php if(!empty($imgattachs['unused'])) { ?>
                                    <?php $imagelist = $imgattachs['unused']; ?>                                    <?php include template('forum/ajax_imagelist'); ?>                                    <?php } ?>
</ul>
</div>
<span class="djaddtz">点击图片插入帖子，请勿拖拽</span>
<div class="bcxc">
<a href="javascript:;" id="savetoalbum">保存相册</a>
<a href="javascript:;" id="insertallimage">全部添加</a>
<div class="bcxcout_selectout" id="selectsavealbum" style="display:none;">
<div class="bcxcout_selectoutclose"><span class="close14_14_24w closepostion"></span></div>
<div class="xcselect needdown">
<span>请选择相册</span><input type="hidden" name="uploadalbum" value="0" />
<div class="xcselectout showdowndiv"><?php if(is_array($albumlist)) foreach($albumlist as $album) { ?><a href="javascript:;" albumid="<?php echo $album['albumid'];?>"><?php echo $album['albumname'];?></a>
<?php } ?>
<a href="javascript:;" albumid="0">+创建新相册</a>
</div>
</div>
<div class="xcgx clboth"><input name="insertall" type="checkbox" value="" class="inputfx"/><em>勾选可保存图片到您的相册</em></div>
</div>
<div class="bcxcout_selectout" id="createnewalbum" style="display:none;">
<div class="bcxcout_selectoutclose"><span class="close14_14_24w closepostion"></span></div>
<span class="cjxctitle">创建相册</span>
<div class="cjxcinput">
<input name="newalbum" type="text" class="cjxctext" />
</div>
<div class="cjxcbutton"><input name="" type="button" class="cjbutton"/>&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="button" class="qxbutton" /></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="usealbumshow imgfbboxcon" style="display:none;">
<?php if($albumlist) { ?>
<div class="xzxc needdown">
<span>选择相册</span>
<div class="xzxcout showdowndiv" style="display:none"><?php if(is_array($albumlist)) foreach($albumlist as $album) { ?>    					<a href="javascript:;" onclick="$('selectalbum_span').style.display = 'none';" albumid="<?php echo $album['albumid'];?>"><?php echo $album['albumname'];?></a>
    					<?php } ?>
</div>
</div>
<div class="b_a_dox" id="selectalbum_span">
<span class="imgmoreupicon_on"></span>
</div>
<div id="albumphoto">
<div class="imgmoreup_no">
<span><img src="http://static.8264.com/static/images/common/imglistbg_1.jpg"/></span>
<span class="cxwithoutimg_text">请从我的相册中选择图片</span>
</div>
</div>
<?php } else { ?>
<div class="imgmoreup_no">
<span><img src="http://static.8264.com/static/images/common/imglistbg_1.jpg"/></span>
<span class="cxwithoutimg_text">您的相册还没有照片</span>
</div>
<?php } ?>
</div>
</div>
</div>
<div style="clear: both;"></div>
</div>
<?php if($special != 4) { ?>
<style>    
.webuploader-container {
position: relative;
}
.webuploader-element-invisible {
position: absolute !important;
clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
    clip: rect(1px,1px,1px,1px);
}
.webuploader-pick {
position: relative;
display: inline-block;
cursor: pointer;
background: #00b7ee;
padding: 10px 15px;
font-size: 16px;
color: #fff;
text-align: center;
width:178px;
border-radius: 3px;
overflow: hidden;
}
.webuploader-pick-hover {
background: #00a2d4;
}

.webuploader-pick-disable {
opacity: 0.6;
pointer-events:none;
}
</style>
<?php } } ?>
<!--编辑器 end-->
<?php if(!empty($_G['setting']['pluginhooks']['post_middle'])) echo $_G['setting']['pluginhooks']['post_middle']; ?>
<!--AA相约版的联系方式-->
<?php if($_G['fid'] == 161 && !$pid) { ?>
<div class="pbt clboth">
<div class="pbt_title">
<span><input type="text" name="contact" id="contact" class="px" value="" /></span>
<input class="subject_tips" type="hidden" disabled="true" value="联系方式"/>
</div>
<span id="subjectchk" class="pbt_title_note">为保护您的隐私，联系方式回帖可见。</span>
</div>
<?php } ?>
<!--AA相约版的联系方式 end-->

<?php if($_G['group']['maxprice'] && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost)) { ?>
<div class="mtm">
<?php if($_G['setting']['maxincperthread']) { ?><img src="http://static.8264.com/static/image/common/arrow_right.gif" />主题出售最高收入上限为 <?php echo $_G['setting']['maxincperthread'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } if($_G['setting']['maxchargespan']) { ?><img src="http://static.8264.com/static/image/common/arrow_right.gif" />主题最多能销售 <?php echo $_G['setting']['maxchargespan'];?> 个小时<?php if($_G['gp_action'] == 'edit' && $freechargehours) { ?>，本主题还能销售 <?php echo $freechargehours;?> 个小时<?php } } ?>
</div>
<?php } if($_G['gp_action'] != 'edit' && checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="<classname>"><sec><i id="sec<hash>_menu" class="yzmimg" style="display:none"><sec></i></span>
EOF;
?>
<div class="twyzm clboth"><?php include template('common/seccheck'); ?></div>
<?php } ?>

<div class="tijiaobutton">
<?php if($_G['gp_action'] == 'newthread' && $_G['setting']['sitemessage']['newthread'] || $_G['gp_action'] == 'reply' && $_G['setting']['sitemessage']['reply']) { ?>
<span id="custominfo" class="y" style="cursor:pointer">&nbsp;<img src="http://static.8264.com/static/image/common/info_small.gif" alt="帮助" /></span>
<?php } if($_G['gp_action'] == 'newthread') { if(in_array($special, array(0, 1, 3))) { ?>
<button type="submit" id="postsubmit" class="pn pnc<?php if($special == 0) { ?> ft<?php } elseif($special == 1) { ?> tp<?php } elseif($special == 3) { ?> xs<?php } ?>" value="true" name="topicsubmit"></button>
<?php } elseif($special == 4) { } else { ?>
<button type="submit" id="postsubmit" class="pn pnc nopic" value="true" name="<?php if($_G['gp_action'] == 'newthread') { ?>topicsubmit<?php } elseif($_G['gp_action'] == 'reply') { ?>replysubmit<?php } elseif($_G['gp_action'] == 'edit') { ?>editsubmit<?php } ?>">
<?php if($special == 2) { ?><span>出售商品</span>
<?php } elseif($special == 5) { ?><span>发起辩论</span>
<?php } elseif($special == 127) { ?>
<span><?php if($buttontext) { ?><?php echo $buttontext;?><?php } else { ?>发表帖子<?php } ?></span>
<?php } ?>
</button>
<?php } } elseif($_G['gp_action'] == 'reply') { if(!empty($_G['gp_addtrade'])) { ?>
<button type="submit" id="postsubmit" class="pn pnc nopic" value="true" name="replysubmit"><span>添加商品</span></button>
<?php } else { ?>
<button type="submit" id="postsubmit" class="pn pnc cy" value="true" name="replysubmit"></button>
<?php } } elseif($_G['gp_action'] == 'edit') { if($special == 4) { if(!$isfirstpost) { ?>
<button type="submit" id="postsubmit" class="pn pnc save" value="true" name="editsubmit"></button>
<?php } } elseif($isfirstpost && $thread['displayorder'] == -4) { ?>
<button type="submit" id="postsubmit" class="pn pnc ft" value="true" name="editsubmit"></button>
<?php } else { ?>
<button type="submit" id="postsubmit" class="pn pnc save" value="true" name="editsubmit"></button>
<?php } } if($_G['uid']) { ?>
<input type="hidden" id="postsave" name="save" value="" />
<?php if($_G['gp_action'] == 'newthread' && !$modnewthreads || $_G['gp_action'] == 'edit' && $isfirstpost && !$modnewreplies && $thread['displayorder'] == -4) { ?>
<button  style="display:none;" type="button" id="postsubmit" class="pn" value="true" onclick="$('postsave').value = 1;$('postsubmit').click();" tabindex="4"><em>保存草稿</em></button>
<?php } } ?>
<span style="color:#999; padding:0 5px;vertical-align:middle;display: none;">每个贴子最多只能上传50张图片</span>
<?php if($special == 2) { ?><label><input type="checkbox" name="continueadd" value="yes" class="pc" /> 保存后继续添加下一个商品</label><?php } ?>
</div>

<?php if($_G['gp_action'] == 'newthread' && $savethreads) { ?>
<div class="bm bmn mtm">
<div class="mbn pbn bbda">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me&amp;type=thread&amp;from=&amp;filter=save" class="y xi2">查看所有草稿 &rsaquo;</a>
<h2>你在本版有<span class="xi1"> <?php echo $savethreadcount;?> </span>篇草稿 <span class="xw0">点击标题前的<em class="qsv">&nbsp;</em>可以直接引用该草稿内容</span></h2>
</div>
<ul><?php if(is_array($savethreads)) foreach($savethreads as $savethread) { ?><li class="mtn"><em class="qsv" title="引用" onclick="insertsave(<?php echo $savethread['pid'];?>)">&nbsp;</em> <a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $savethread['fid'];?>&amp;tid=<?php echo $savethread['tid'];?>&amp;pid=<?php echo $savethread['pid'];?>" class="xi2" target="_blank"><?php echo $savethread['subject'];?></a> <span class="xg1"><?php echo $savethread['dateline'];?></span></li>
<?php } ?>
</ul>
</div>
<?php } if($_G['gp_action'] == 'newthread' && $savethreadothers) { ?>
<div class="bm bmn mtm">
<div class="mbn pbn bbda">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me&amp;type=thread&amp;from=&amp;filter=save" class="y xi2">查看所有草稿 &rsaquo;</a>
<h2>你在本版有<span class="xi1"> <?php echo $savethreadothercount;?> </span>篇草稿 <span class="xw0">点击标题前的<em class="qsv">&nbsp;</em>可以直接引用该草稿内容</span></h2>
</div>
<ul><?php if(is_array($savethreadothers)) foreach($savethreadothers as $savethread) { ?><li class="mtn"><em class="qsv" title="引用" onclick="insertsave(<?php echo $savethread['pid'];?>)">&nbsp;</em> <a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $savethread['fid'];?>&amp;tid=<?php echo $savethread['tid'];?>&amp;pid=<?php echo $savethread['pid'];?>" class="xi2" target="_blank"><?php echo $savethread['subject'];?></a> <span class="xg1"><?php echo $savethread['dateline'];?></span></li>
<?php } ?>
</ul>
</div>
<?php } if(!empty($_G['setting']['pluginhooks']['post_sync_method'])) { ?>
<span>
将此主题同步到:
<?php if(!empty($_G['setting']['pluginhooks']['post_sync_method'])) echo $_G['setting']['pluginhooks']['post_sync_method']; ?>
</span>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['post_bottom'])) echo $_G['setting']['pluginhooks']['post_bottom']; ?>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['post_side_bottom'])) echo $_G['setting']['pluginhooks']['post_side_bottom']; ?>
</form>
</div>
</div>
<?php if($special) { ?>
<script src="http://static.8264.com/static/js/calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/forum_calendar.css?<?php echo VERHASH;?>" />
<?php } ?>

<!--编辑器-->
<div id="<?php echo $editorid;?>_menus" class="editorrow" style="overflow: hidden; margin-top: -5px; height: 0; border: none; background: transparent;">
<?php if($_G['group']['allowpostattach']) { if(!empty($attachs['used'])) { ?><?php $attachlist = $attachs['used'];$attachused = true; include template('forum/ajax_attachlist'); } if(!empty($attachs['unused'])) { ?><?php $attachlist = $attachs['unused'];$attachused = false; include template('forum/ajax_attachlist'); } } ?>

<script type="text/javascript">
if(wysiwyg) {
newEditor(1, bbcode2html(textobj.value));
} else {
newEditor(0, textobj.value);
}
var ATTACHNUM = {'imageused':0,'imageunused':0,'attachused':0,'attachunused':0};
function switchImagebutton(btn) {
var btns = ['www'<?php if($allowpostimg) { ?>, 'imgattachlist'<?php } ?>, 'albumlist'];
<?php if($allowpostimg) { if($_G['setting']['swfupload'] != 1) { ?>btns.push('local');<?php } if($_G['setting']['swfupload'] != 0) { ?>btns.push('multi');<?php } } ?>
//switchButton(btn, btns);
//$(editorid + '_image_menu').style.height = '';
}
<?php if($allowpostimg) { ?>
ATTACHNUM['imageused'] = <?php echo @count($imgattachs['used']); ?>;
ATTACHNUM['imageunused'] = <?php echo @count($imgattachs['unused']); ?>;
<?php if(!empty($imgattachs['used']) || !empty($imgattachs['unused'])) { ?>
switchImagebutton('imgattachlist');
//$(editorid + '_image').evt = false;
//updateattachnum('image');
<?php } else { ?>
switchImagebutton('<?php if($_G['setting']['swfupload'] != 0) { ?>multi<?php } else { ?>local<?php } ?>');
<?php } } if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) { ?>
function switchAttachbutton(btn) {
var btns = ['attachlist'];
<?php if($_G['setting']['swfupload'] != 1) { ?>btns.push('upload');<?php } if($_G['setting']['swfupload'] != 0) { ?>btns.push('swfupload');<?php } ?>
switchButton(btn, btns);
}
ATTACHNUM['attachused'] = <?php echo @count($attachs['used']); ?>;
ATTACHNUM['attachunused'] = <?php echo @count($attachs['unused']); ?>;
<?php if(!empty($attachs['used']) || !empty($attachs['unused'])) { ?>
//$(editorid + '_attach').evt = false;
//updateattachnum('attach');
<?php } else { ?>
//switchAttachbutton('<?php if($_G['setting']['swfupload'] != 0) { ?>swfupload<?php } else { ?>upload<?php } ?>');
<?php } } if(!empty($attachs['unused']) || !empty($imgattachs['unused'])) { ?>
var msg = '<form id="unusedform"><div class="c ufl" style="<?php if(count($attachs['unused']) + count($imgattachs['unused']) > 10) { ?>height:180px;<?php } ?>overflow-y:auto;overflow-x:hidden"><p class="xg2">以下是你上次上传但没有使用的附件:</p>'<?php if(is_array($attachs['unused'])) foreach($attachs['unused'] as $attach) { ?>+ '<p>' + (BROWSER.ie && BROWSER.ie <= 6 ? '' : '<a href="javascript:;" class="d" title="忽略">忽略</a><a href="javascript:;" class="d deletepic" title="删除" attachid="<?php echo $attach['aid'];?>">删除</a>') + '<label><input id="unused<?php echo $attach['aid'];?>" name="unused[]" value="<?php echo $attach['aid'];?>" checked type="checkbox" class="pc" /> <span title="<?php echo $attach['filenametitle'];?> <?php echo $attach['dateline'];?>"><?php echo $attach['filename'];?></span></label></p>'
<?php } if(is_array($imgattachs['unused'])) foreach($imgattachs['unused'] as $attach) { ?>+ '<p>' + (BROWSER.ie && BROWSER.ie <= 6 ? '' : '<a href="javascript:;" class="d" title="忽略">忽略</a><a href="javascript:;" class="d deletepic" title="删除"  attachid="<?php echo $attach['aid'];?>">删除</a>') + '<label><input id="unused<?php echo $attach['aid'];?>" name="unused[]" value="<?php echo $attach['aid'];?>" checked type="checkbox" class="pc" /> <span title="<?php echo $attach['filenametitle'];?> <?php echo $attach['dateline'];?>"><?php echo $attach['filename'];?></span></label></p>'
<?php } ?>
+ '</div><div class="o pns cl"><label class="z"><input type="checkbox" name="chkall" class="pc" checked="checked" onclick="checkall(this.form, \'unused\', \'chkall\')" /> 全选</label><button type="button" value="true" class="pn"><span>忽略</span></button> <button type="button" value="true" class="pn deletepic"><span>删除</span></button> <button type="button" value="true" class="pn pnc"><span>使用</span></button> </div></form>';
showDialog(msg, 'info', '', '', 1);
<?php } ?>
setCaretAtEnd();
if(BROWSER.ie >= 5 || BROWSER.firefox >= '2') {
_attachEvent(window, 'beforeunload', saveData);
}
<?php if(!empty($_G['gp_cedit']) && $_G['gp_cedit'] == 'yes') { ?>
loadData(1);		
$(editorid + '_switchercheck').checked = !wysiwyg;
<?php } ?>
</script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
$('#unusedform>.c.ufl>p>a.d').click(function(){
var a_aid = $(this).parent().find('input[type=checkbox]').val();
$('#newattach_id_' + a_aid).remove();
$('#image_td_' + a_aid).remove();
$(this).parent().remove();
});
})(jQuery);
</script>
<style>
.c a.deletepic{background-position: 0 -42px;}
.c a.deletepic:hover{background-position: 0 -62px;}
</style>
<div id="hiddenobj" style="visibility: hidden; display:none; width:0px;height:0px;"></div></div>
<div id="showbigpic" style="display: none;"><div id="tempimg"><img onload="thumbMyImg(this);" /></div></div>
<div id="hiddenobj" style="visibility: hidden; display:none; width:0px;height:0px;"></div>
<script src="http://static.8264.com/static/js/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript">
var editorsubmit = $('postsubmit');
var editorform = $('postform');
var allowpostattach = parseInt('<?php echo $_G['group']['allowpostattach'];?>');
var allowpostimg = parseInt('<?php echo $allowpostimg;?>');
var pid = parseInt('<?php echo $pid;?>');
var extensions = '<?php echo str_replace(array('jpeg,','gif,','jpg,','png,') ,'' ,$_G['group']['attachextensions']) ?>';
var imgexts = '<?php echo $imgexts;?>';
var postminchars = parseInt('<?php echo $_G['setting']['minpostsize'];?>');
var postmaxchars = parseInt('<?php echo $_G['setting']['maxpostsize'];?>');
var disablepostctrl = parseInt('<?php echo $_G['group']['disablepostctrl'];?>');
var seccodecheck = parseInt('<?php if(checkperm('seccode') && $seccodecheck) { ?>1<?php } else { ?>0<?php } ?>');
var secqaacheck = parseInt('<?php if(checkperm('seccode') && $secqaacheck) { ?>1<?php } else { ?>0<?php } ?>');
var typerequired = parseInt('<?php echo $_G['forum']['threadtypes']['required'];?>');
var sortrequired = parseInt('<?php echo $_G['forum']['threadsorts']['required'];?>');
var special = parseInt('<?php echo $special;?>');
var isfirstpost = <?php if($isfirstpost) { ?>1<?php } else { ?>0<?php } ?>;
var allowposttrade = parseInt('<?php echo $_G['group']['allowposttrade'];?>');
var allowpostreward = parseInt('<?php echo $_G['group']['allowpostreward'];?>');
var allowpostactivity = parseInt('<?php echo $_G['group']['allowpostactivity'];?>');
var sortid = parseInt('<?php echo $sortid;?>');
var fid = <?php echo $_G['fid'];?>;
<?php if($isfirstpost && !empty($_G['forum']['threadtypes']['types'])) { ?>
//simulateSelect('typeid');
<?php } if(!$isfirstpost && $thread['special'] == 5 && empty($firststand) && $_G['gp_action'] != 'edit') { ?>
//simulateSelect('stand');
<?php } if(!$special && $_G['forum']['threadsorts'] && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost && !$thread['sortid'])) { ?>
//simulateSelect('sortid');
function switchsort() {
if($('sortid').value) {
saveData(1);
<?php if($isfirstpost && $sortid) { ?>
ajaxget('forum.php?mod=post&action=threadsorts&sortid=' + $('sortid').value + '&fid=<?php echo $_G['fid'];?><?php if(!empty($modelid)) { ?>&modelid=<?php echo $modelid;?><?php } if(!empty($_G['gp_modthreadkey'])) { ?>&modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>', 'threadsorts', 'threadsortswait', null, null, function () { seteditorcontrolpos(); });
<?php } else { ?>
location.href = 'forum.php?mod=post&action=<?php echo $_G['gp_action'];?>&fid=<?php echo $_G['fid'];?><?php if(!empty($_G['tid'])) { ?>&tid=<?php echo $_G['tid'];?><?php } if(!empty($pid)) { ?>&pid=<?php echo $pid;?><?php } if(!empty($modelid)) { ?>&modelid=<?php echo $modelid;?><?php } ?>&extra=<?php echo $extra;?><?php if(!$sortid) { ?>&cedit=yes<?php } ?>&sortid=' + $('sortid').value;
<?php } ?>
Editorwin = 0;
}
}
<?php } if($isfirstpost) { if($sortid) { ?>
ajaxget('forum.php?mod=post&action=threadsorts&sortid=<?php echo $sortid;?>&fid=<?php echo $_G['fid'];?><?php if(!empty($_G['tid'])) { ?>&tid=<?php echo $_G['tid'];?><?php } ?>&inajax=1<?php if(!empty($_G['gp_modthreadkey'])) { ?>&modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>', 'threadsorts', 'threadsortswait', null, null, function () { seteditorcontrolpos(); });
<?php } elseif($_G['forum']['threadsorts']['required'] && !$special) { ?><?php $threadsortids = array_keys($threadsorts[types]); ?>ajaxget('forum.php?mod=post&action=threadsorts&sortid=<?php echo $threadsortids['0'];?>&fid=<?php echo $_G['fid'];?><?php if(!empty($_G['tid'])) { ?>&tid=<?php echo $_G['tid'];?><?php } ?>&inajax=1<?php if(!empty($_G['gp_modthreadkey'])) { ?>&modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>', 'threadsorts', 'threadsortswait', null, null, function () { seteditorcontrolpos(); });
<?php } } if($_G['gp_action'] == 'newthread' && $_G['setting']['sitemessage']['newthread'] || $_G['gp_action'] == 'reply' && $_G['setting']['sitemessage']['reply']) { ?>
showPrompt('custominfo', 'mouseover', '<?php if($_G['gp_action'] == 'newthread') { echo trim($_G['setting']['sitemessage']['newthread'][array_rand($_G['setting']['sitemessage']['newthread'])]); } elseif($_G['gp_action'] == 'reply') { echo trim($_G['setting']['sitemessage']['reply'][array_rand($_G['setting']['sitemessage']['reply'])]); } ?>', <?php echo $_G['setting']['sitemessage']['time'];?>);
<?php } if($_G['setting']['swfupload'] != 1 && $_G['group']['allowpostattach']) { ?>addAttach();<?php } if($_G['setting']['swfupload'] != 1 && $allowpostimg) { ?>addAttach('img');<?php } ?>
if($('subjectbox')) {
var tmp_obj = $('<?php echo $editorid;?>_textarea');
if(tmp_obj && tmp_obj.style.display == '') {
tmp_obj.focus();
}
} else if($('subject')) {
$('subject').focus();
}
</script>
<script>
jQuery.noConflict();
;(function($){
function newAttachFile(num){
$('#attachbtnhiddentmp').clone().attr('id', 'attachform_' + num).find('input[type=file]').attr('attnum', num).end().appendTo('#attachbtn').show();
}
newAttachFile(1);
$('.imgfbbox').on('click', '.imgfbtitle>span', function(event){
if(! $(this).hasClass('zhong')){
var myclassid = $(this).attr('class');
if(BROWSER.ie > 0 && BROWSER.ie <= 7){
$(this).addClass('zhong').siblings().removeClass('zhong').end().parent().siblings('.' + myclassid + 'show').show().siblings().not('.imgfbtitle').hide();
}else{
$(this).addClass('zhong').siblings().removeClass('zhong').end().parent().siblings('.' + myclassid + 'show').show().css({height:'auto', 'overflow' : ''}).siblings().not('.imgfbtitle').css({height:'0px', 'overflow' : 'hidden'});
}
}
});

$('.usealbumshow .xzxcout>a').on('click', function(event){
$(this).parent().siblings('span').text($(this).text());
var select_albumid = $(this).attr('albumid');
ajaxget('forum.php?mod=post&perpage=4&showpage=4&action=albumphoto&aid=' + select_albumid , 'albumphoto');
$(this).parent().hide();
});
$('#insertallimage').click(function(event){
var imagelistobj = $('#uploadimagelist>li:not(.imgdeleted) img');
var maximagepic = 50;
if(imagelistobj.length > maximagepic){
showDialog('你列表中的文件超过50张，超过50张的图片将会保存在列表内，您可以再次发帖时使用！');
}
var i = 0;
imagelistobj.each(function(){
i++;
if(i <= maximagepic){$(this).click();}

});
});
$('#savetoalbum').click(function(event){
$('#selectsavealbum').show();
});
$('.bcxcout_selectout>.bcxcout_selectoutclose>.close14_14_24w.closepostion').click(function(event){
$(this).parents('.bcxcout_selectout').hide();
});
$('#selectsavealbum>.xcgx.clboth>input[name=insertall]').click(function(event){
if($(this).is(':checked')){
$('#uploadimagelist>li>input.albumabout').removeAttr('disabled');
}else{
$('#uploadimagelist>li>input.albumabout').attr('disabled', true);
}
});
$('#selectsavealbum>.xcselect>.xcselectout>a').click(function(event){
$(this).parent().siblings('span').text($(this).text()).end().siblings('input[name=uploadalbum]').val($(this).attr('albumid')).end().hide();
if($(this).attr('albumid') == 0){
$('#createnewalbum').show();
}
});
$('#createnewalbum .cjxcbutton>input.cjbutton').click(function(event){
if($('#createnewalbum>div.cjxcinput>input.cjxctext').val().length < 3){
showDialog('您选择创建的新相册名不能为空或太短！');
}else{
$('#selectsavealbum').find('>div.xcselect>span').text($('#createnewalbum>div.cjxcinput>input.cjxctext').val());
$('#createnewalbum').hide();
}
})
$('#createnewalbum .cjxcbutton>input.qxbutton').click(function(event){
$('#createnewalbum').hide();
if($('#createnewalbum>div.cjxcinput>input.cjxctext').val().length > 0){$('#selectsavealbum').children('span').text('请选择相册').end().show();}
});
$('#<?php echo $editorid;?>_controls>.fjicon>div>div .weblink input').bind('focus blur', function(event){
switch(event.type){
case 'focus':
$(this).next('em').hide();break;
case 'blur':
if($(this).val().length == 0){$(this).next('em').show();}break;
}
});
var sel, selection;
$('#<?php echo $editorid;?>_controls>.fjicon>a').on('click', function(event){
var mycate = $(this).attr('cate');
var mycateout = $(this).siblings('.' + mycate + 'out');
if(mycateout.is(':hidden')){
checkFocus();
var str = '';
var pos = [0, 0];
var opentag = '[' + mycate + ']';
var closetag = '[/' + mycate + ']';
if(BROWSER.ie) {
sel = wysiwyg ? editdoc.selection.createRange() : document.selection.createRange();
pos = getCaret();
}
selection = sel ? (wysiwyg ? sel.htmlText : sel.text) : getSel();
if(mycate == 'link'){
if(selection){
mycateout.find('.weblink:eq(1)').hide();
}else{
mycateout.find('.weblink:eq(1)').show();
}
}
$(this).addClass(mycate + 'icon_hover').siblings('div').hide().end().siblings('a').each(function(){
$(this).removeClass($(this).attr('cate') + 'icon_hover');
}).end().siblings('.' + mycate + 'out').show();
function click_function_handle(){
if($(this).hasClass('tjbutton')){
switch(mycate){
case 'link':
var href = mycateout.find('input[type=text]:first').val();
href = (isEmail(href) ? 'mailto:' : '') + href;
if(href != '') {
var v = selection ? selection : (mycateout.find('input[type=text]:eq(1)').val() ? mycateout.find('input[type=text]:eq(1)').val() : href);
str = wysiwyg ? ('<a href="' + href + '">' + v + '</a>') : '[url=' + href + ']' + v + '[/url]';
if(wysiwyg) insertText(str, str.length - v.length, 0, (selection ? true : false), sel);
else insertText(str, str.length - v.length - 6, 6, (selection ? true : false), sel);
}
break;
case 'shipin':
var mediaUrl = mycateout.find('input[type=text]:first').val();
var auto = '';
var ext = mediaUrl.lastIndexOf('.') == -1 ? '' : mediaUrl.substr(mediaUrl.lastIndexOf('.') + 1, mb_strlen(mediaUrl)).toLowerCase();
ext = in_array(ext, ['mp3', 'wma', 'ra', 'rm', 'ram', 'mid', 'asx', 'wmv', 'avi', 'mpg', 'mpeg', 'rmvb', 'asf', 'mov', 'flv', 'swf']) ? ext : 'x';
if(ext == 'x') {
if(/^mms:\/\//.test(mediaUrl)) {
ext = 'mms';
} else if(/^(rtsp|pnm):\/\//.test(mediaUrl)) {
ext = 'rtsp';
}
}
var auto = mycateout.find('input[type=checkbox]:first').is(':checked') ? ',1' : '';
var str = '[media=' + ext + ',' + mycateout.find('input[type=text]:eq(1)').val() + ',' + mycateout.find('input[type=text]:eq(2)').val() + auto +']' + mediaUrl + '[/media]';
insertText(str, str.length, 0, false, sel);
break;
}
mycateout.find('input[type=text]').each(function(){
if(($(this)).next('em').text().length > 0){
$(this).val('').next('em').show();
}
}).end().find('input:checked').removeAttr('checked');
}
$(this).parent().parent().find('.close14_14_24w.closepostion').click();
}
mycateout.find('.tjqx>input[type=button]').bind('click', null, click_function_handle);
}else{
$(this).removeClass(mycate + 'icon_hover').siblings('.' + mycate + 'out').hide();
}
});
$('#<?php echo $editorid;?>_controls>.fjicon>div[class$=out] .close14_14_24w.closepostion').click(function(event){
var divshow = $(this).parent().parent();
divshow.hide().siblings('.' + divshow.attr('cate') + 'icon').removeClass(divshow.attr('cate') + 'icon_hover');
});
$('#<?php echo $editorid;?>_controls>.fjicon>div[class$=out] .weblink').mouseover(function(event){
$(this).children('input[type=text]').focus();
});
$('#<?php echo $editorid;?>_attach_menu').on('click', '>.bqtitle>a', function(event){
var cate = $(this).attr('cate');
$(this).addClass('zhong').siblings().removeClass('zhong').end().parent().next('.fujiancon').children('.' + cate + ':first').show().siblings().hide();
});
$('#attachbtn').on('change', 'input[type=file]', function(event){
var path = $(this).val();
var haveselect = false;
if($('#attachbtn>div:hidden>span>form').length >= 3){
showDialog('对不起，最多只能上传三个附件！');
haveselect = true;
}
if(! haveselect){
var extpos = path.lastIndexOf('.');
var ext = extpos == -1 ? '' : path.substr(extpos + 1, path.length).toLowerCase();
var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
if(extensions != '' && (re.exec(extensions) == null || ext == '')) {
showDialog('对不起，不支持上传此类扩展名的附件。如果您需要上传图片，请使用右侧的图片上传。');
haveselect = true;
}
}
if(! haveselect){
$('#attachbtn>div:hidden>span>form>input[type=file]').each(function(){
if($(this).val() == path){
haveselect = true;
showDialog('您选择的附件文件刚刚已经选择过了');
}
});
}
if(haveselect){
$(this).val('');
return;
}else{
var file_form_num = $(this).attr('attnum');
$('#attachbodyhiddentmp').clone().attr('id', 'wattingupload_' + file_form_num).find('input[type=hidden]').val(file_form_num).end().find('>span').text(path).end().appendTo('#attach_upload_body').show();
$("#attachform_" + file_form_num).hide();
newAttachFile(parseInt(file_form_num) + 1);
}
});
$('#attach_upload_body').on('click', '>li>em', function(event){
var file_form_num = $(this).siblings('input[type=hidden]').val();
$("#wattingupload_" + file_form_num).remove();
$("#attachform_" + file_form_num).remove();
});
$('#uploadbtn').on('click', '>input[type=button]', function(event){
if($(this).hasClass('qxbutton')){
$('#<?php echo $editorid;?>_attach_menu>.bqtitle>.close14_14_24w.closepostion').click();
}else if($(this).hasClass('tjbutton')){
var _errorcount = 0;
var _successcount = 0;
var _errormessage = '';
var _uploadfunction = function(){
$('#attachbtn>div:hidden>span>form:first').ajaxSubmit({type:'post', success: successAjaxHandle, error: errorAjaxHandle});
}
var _uploadcomplete = function(){
if($('#attachbtn>div:hidden>span>form').length > 0){
setTimeout(_uploadfunction, 500);
}else{
$('#uploadingtips').hide();
$('#attach_upload_body li').remove();
showDialog('文件上传完毕，共上传 ' + (_errorcount + _successcount) + ' 个文件，成功 ' + _successcount + ' 个，失败 ' + _errorcount + ' 个。' + (_errorcount > 0 ? _errormessage : ''));
$('#<?php echo $editorid;?>_attach_menu .bqtitle a:first').click();
}
}
var successAjaxHandle = function(data){
var re = new RegExp("^DISCUZUPLOAD\|\d\|\d+\|\d$", "i");
if(data != '' && re.test(data)){
var attnum = $('#attachbtn>div:hidden>span>form:first input[type=file]').attr('attnum');
var result = data.split('|');
var aid = result[2];
var errormsg = result[1];
var filename = $('#attachbtn>div:hidden>span>form:first input[type=file]').val();
var filearr = filename.split('\\');
filename = filearr[filearr.length - 1];
if(errormsg != 0){
_errorcount++;
var _error = filename + '上传失败，原因：' + STATUSMSG[errormsg];
_errormessage += " \n" + _error;
$('#wattingupload_' + attnum).addClass('uploadattacherror').attr('title', _error);
}else{
_successcount++;
var d = new Date();
var v_Year = d.getFullYear();
var v_Mon = d.getMonth() + 1;
var v_Day = d.getDate();
var v_h = d.getHours();
var v_m = d.getMinutes();
var v_time = v_Year + '-' + v_Mon + '-' + v_Day + ' ' + v_h + ':' + v_m;
addattachlist("{aid: " + aid + ", filename:'" + filename + "', uploadtime:'" + v_time + "', descr: '', readperm: 0}");
$('#wattingupload_' + attnum).addClass('uploadattachok');
}
$('#attachform_' + attnum).remove();
_uploadcomplete();
}else{
showDialog('文件' + filename + '上传失败，原因：内部错误。');
}
}
var errorAjaxHandle = function(data){
_errorcount++;
var attnum = $('#attachbtn>div:hidden>span>form:first input[type=file]').attr('attnum');
var _error = $('#attachbtn>div:hidden>span>form:first input[type=file]').val() + '上传失败，原因：' + '文件过大或通讯错误';
_errormessage += " \n" + _error;
$('#wattingupload_' + attnum).addClass('uploadattacherror').attr('title', _error);
$('#attachform_' + attnum).remove();
_uploadcomplete();
}
if($('#attachbtn>div:hidden>span>form').length > 0){
$('#uploadingtips').show();
_uploadfunction();
}else{
showDialog('请选择通过上访浏览文件，选择需要上传的文件。');
}
}
})
$('#<?php echo $editorid;?>_attach_menu').on('click', '>.fujiancon>.fujian_list.listattach>ul>li.fujian_list_td.clboth>span.del', function(event){
$(this).parents('li.fujian_list_td.clboth').remove();
});
<?php if($_G['group']['allowsetattachperm'] && ($_G['gp_action'] == 'newthread' || ($_G['gp_action'] == 'edit' && $isfirstpost))) { ?>
$('#listofattach').on('click mouseleave', '.readtext', function(event){
var mid = $(this).attr('mid');
var listHeight = document.getElementById('listofattach').offsetHeight;
var jiange_cha = $(this).parents('li').offset().top + 45 - $('#listofattach').offset().top - listHeight + 15;
if(jiange_cha > 0){
var c_top = $(this).offset().top - 102;
$('#' + mid).css({borderTopWidth : '1px', borderBottomWidth : '0px'});
}else{
var c_top = $(this).offset().top + 23;
$('#' + mid).css({borderTopWidth : '0px', borderBottomWidth : '1px'});
}
var c_left = $(this).offset().left;
$('#' + mid).css({top:c_top, left:c_left});
switch(event.type){
case 'click' :
$('#append_parent .readtext_out:visible').hide();
$('#' + mid).show();
break;
case 'mouseleave':
$('#' + mid).hide();break;
}
}).on('scroll', function(event){
$('#append_parent .readtext_out:visible').each(function(){
var fatobj = $('#newattach_id_' + $(this).attr('faid')).find('.readtext');
$(this).css({top: fatobj.offset().top + 23, left: fatobj.offset().left});
});
});
$('#append_parent .readtext_out').on('mouseenter mouseleave', function(event){
switch(event.type){
case 'mouseenter' :
$(this).show();break;
case 'mouseleave' :
$(this).hide();break;
}
}).on('click', 'a', function(event){
$(this).parent().hide();
$('#newattach_id_' + $(this).parent().attr('faid')).children('.readpowercon').children('.readtext').text($(this).text()).end().children('input.readperm').val($(this).attr('readperm'));
});
<?php } ?>
$('#noattachtips input.imgfjbutton').click(function(event){
$('#<?php echo $editorid;?>_attach_menu>.bqtitle>a:eq(1)').click();
});
$('#uploadimagelist').on('mouseover mouseout mousemove', '>li>img', function(event){
var objclass = $(this).attr('aid');
switch(event.type){
case 'mouseover':
if($('#showbigpic_' + objclass).find('img').width() > 300 || $('#showbigpic_' + objclass).find('img').height() > 300){
$('#showbigpic_' + objclass).find('img').hide();
thumbMyImg($($('#showbigpic_' + objclass).find('img')));
}
if(document.getElementById('showbigpic_' + objclass) == null){
$('#tempimg').clone().attr('id', 'showbigpic_' + objclass).appendTo('#showbigpic');
$('#showbigpic_' + objclass).find('img').attr('src', $(this).attr('bigthumb'))
}
$('#showbigpic_' + objclass).siblings().hide().end().parent().css({top : event.pageY - 320, left : event.pageX - 320}).show().end().show();
break;
case 'mouseout':
$('#showbigpic_' + objclass).hide();
$('#showbigpic').hide();
break;
case 'mousemove':
if($('#showbigpic_' + objclass).find('img').width() > 300 || $('#showbigpic_' + objclass).find('img').height() > 300){
$('#showbigpic_' + objclass).find('img').hide();
thumbMyImg($($('#showbigpic_' + objclass).find('img')));
}
if(document.getElementById('showbigpic_' + objclass) == null){
$('#tempimg').clone().attr('id', 'showbigpic_' + objclass).appendTo('#showbigpic');
$('#showbigpic_' + objclass).find('img').attr('src', $(this).attr('bigthumb'))
}
var thumbpic = {width: $('#showbigpic_' + objclass + ' img:first').width(), height: $('#showbigpic_' + objclass + ' img:first').height()};
$('#showbigpic').css({top : event.pageY - thumbpic.height - 20, left : event.pageX - thumbpic.width - 20}).show();
break;
}
});
<?php if($_G['gp_action'] != 'edit' && checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
$('#postbox>.twyzm.clboth>span').hover(function(event){
$('#' + this.id + '_menu').show();
}, function(event){
$('#' + this.id + '_menu').hide();
});
$(document).on('blur focusin focusout', '#postbox>.twyzm.clboth>span>input[type=text]', function(event){
switch(event.type){
case 'focusin':
$('#' + $(this).parent().attr('id') + '_menu').show();break;
case 'blur':
case 'focusout':
$('#' + $(this).parent().attr('id') + '_menu').hide();break;
}
})
<?php } ?>
$('#unusedform .deletepic').click(function(event){
var m_attach_id = $(this).attr('attachid');
if(m_attach_id > 0){
ajaxget('forum.php?mod=ajax&action=deletepic&picid=' + m_attach_id, "hiddenobj");
}
});
$('#unusedform>.o.pns.cl>button').click(function(event){
var ver_p = $(this).hasClass('pnc');
var ver_d = $(this).hasClass('deletepic');
$('#unusedform>div>p').find('input[type=checkbox]').each(function(){
if(ver_p && $(this).is(':checked')){
return;
}
if($(this).is(':checked')){
if(ver_d){
$(this).parents('p').find('a.deletepic').click();
}
$('#newattach_id_' + $(this).val()).remove();
$('#image_td_' + $(this).val()).remove();
}
});
if($('#listofattach>ul').children('li').length == 0){
$('#noattachtips').prependTo('#<?php echo $editorid;?>_attach_menu>.fujiancon').next('.fujian_list').hide();
$('#<?php echo $editorid;?>_attachn').hide();
  		}else if($('#attachlist_old').children('li').length == 0){
  			$('#attachlist_old').prev('.tsupfujian').hide();
  		}

  		if($('#listofattach').find('li').length <= 6){
  			$('#listofattach').height('auto');
  			$('#listofattach').css('overflow-y', 'auto');
  		}
  		if($('#uploadimagelist').children('li').length == 0){
$('#uploadimagediv').hide().prev('.imgmoreup').show();
  		}
  		hideMenu('fwin_dialog', 'dialog');
});
$('#<?php echo $editorid;?>_iframe').css('overflow-y', 'hidden').contents().bind('keyup', function(){
if(BROWSER.ie){
return;
}
$(this).find('body').css({'overflow-y' : 'hidden'});
$(this).find('body').height('auto');
var cont_s = $('#<?php echo $editorid;?>_iframe').contents().find('body').height();
var hex_s = $('#<?php echo $editorid;?>_iframe').height() - cont_s;
var pagehex = $(document).scrollTop();
if(hex_s < 30){
$('.edt.areatext').height(cont_s + 50);
editorsize('+', cont_s + 50);
if(pagehex > 0){
$(document).scrollTop(pagehex - hex_s + 50);
}
}else  if(hex_s > 50){
cont_s += 30;
cont_s = cont_s <= 400 ? 400 : cont_s;
$('.edt.areatext').height(cont_s);
editorsize('-', cont_s);
}else{
$('#<?php echo $editorid;?>_iframe').contents().find('body').height($('#<?php echo $editorid;?>_iframe').height());
}
});
$('#<?php echo $editorid;?>_controls .font_size>a').click(function(){
$(this).addClass('zhong').siblings().removeClass('zhong');
});
$('#albumphoto').on('click', 'ul li img', function(){
$('#<?php echo $editorid;?>_iframe').contents().trigger('keyup');
});

$(document).scroll(function(){
var tools_bar = $('#right_tools');
if($(document).scrollTop() > editorcontroltop && editorcurrentheight > 400) {
tools_bar.css({position: 'fixed', top: '0px', width: '262px'});
} else {
tools_bar.css({position: '', top: '', width: ''});
}
});
if($('#attachlist_old>li').length > 4){$('#listofattach').css({'overflow-y':'scroll',height:'300px'});}
if($('.usealbumshow .xzxc>.xzxcout>a').length > 7){$('.usealbumshow .xzxc>.xzxcout').css({height:'190px', 'overflow-y':'scroll'});}
$('#<?php echo $editorid;?>_svdsecond').prependTo('div.aretzt.clboth>span.ri');
setTimeout(function(){
$('#<?php echo $editorid;?>_iframe').contents().trigger('keyup');
}, 1000);
})(jQuery);
</script>
<style>
.edierbar #<?php echo $editorid;?>_bold{ width:24px; height:23px; background-position: 0px -301px; margin-left:4px;}
.edierbar #<?php echo $editorid;?>_bold:hover,
.edierbar #<?php echo $editorid;?>_bold.hover{ width:24px; height:23px; background-position: -25px -301px;}
#<?php echo $editorid;?>_button{display:none;}
<?php if(! $_G['forum']['ismoderator']) { ?>
#<?php echo $editorid;?>_switcher{display:none;}
<?php } else { ?>
#<?php echo $editorid;?>_switcher{margin-right:10px;height:23px;line-height:23px;}
<?php } ?>
.text_align #<?php echo $editorid;?>_justifyleft{ background-position:-53px -301px;}
.text_align #<?php echo $editorid;?>_justifyleft:hover,
.text_align #<?php echo $editorid;?>_justifyleft.hover{ background-position:-86px -301px;}
.text_align #<?php echo $editorid;?>_justifycenter{  background-position:-119px -301px;}
.text_align #<?php echo $editorid;?>_justifycenter:hover,
.text_align #<?php echo $editorid;?>_justifycenter.hover{  background-position:-152px -301px;}
#<?php echo $editorid;?>_attachn{display:block;left:auto; width:10px; height:10px; background:url(http://static.8264.com/static/images/common/tanhao.png)  no-repeat; position:absolute; top:-4px; right:-4px;}
</style>
<script type="text/javascript">
function thumbMyImg(objimg){
jQuery.noConflict();
;(function($){
var myobj = {width : $(objimg).width(), height : $(objimg).height()};
if(myobj.width > 300 || myobj.height > 300){
if(myobj.width > myobj.height){
var scale = myobj.height / myobj.width;
myobj.width = 300;
myobj.height = parseInt(300 * scale);
}else{
var scale = myobj.width / myobj.height;
myobj.height = 300;
myobj.width = parseInt(300 * scale);
}
$(objimg).width(myobj.width).height(myobj.height);
}
$(objimg).show();
})(jQuery);
}
<?php if($_G['forum']['ismoderator']) { ?>
$('<?php echo $editorid;?>_switcher').style.display = '';
<?php } ?>
</script>
<!--编辑器 end-->

<script type="text/javascript">
jQuery(function(){
jQuery('.needdown').hover(function(event){
jQuery(this).children('.showdowndiv').show();
}, function(event){
jQuery(this).children('.showdowndiv').hide();
});
jQuery('.pbt_select_option_box>a').click(function(event){
jQuery(this).parent().next('span').children('input[type=hidden]').val(jQuery(this).attr('hid')).siblings('span').text(jQuery(this).text());
jQuery(this).parent().hide();
});
if(jQuery('.pbt_select_option_box').height() > 500){jQuery('.pbt_select_option_box').height('500px');}

jQuery('.pbt_title input[type=text]').blur(function(){
var tempSubjecttips = jQuery(this).parents('.pbt_title').find('.subject_tips');
if(jQuery(this).val().length == 0){
jQuery(this).val(tempSubjecttips.val()).css('color', '#949494');
}
}).focus(function(){
var tempSubjecttips = jQuery(this).parents('.pbt_title').find('.subject_tips');
if(jQuery(this).val() == tempSubjecttips.val()){
jQuery(this).val('').css('color', '');
}
}).blur();
});

function check_subject(){
jQuery.noConflict();
;(function($){
$('.pbt_title').each(function(){
var tempSubject 	= jQuery(this).find('input[type=text]');
var tempSubjecttips = jQuery(this).find('.subject_tips');
if(tempSubject.val() == tempSubjecttips.val()){
tempSubject.val('');
setTimeout(function(){
tempSubject.val(tempSubjecttips.val());
},1000);
}
});
})(jQuery);
}
</script></div>
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