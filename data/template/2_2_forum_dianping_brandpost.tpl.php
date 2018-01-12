<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('brandpost', 'forum/dianping/header');
0
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/forum/dianping/header.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/forum/dianping/editor.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/forum/dianping/footer.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/common/header_8264_new.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/common/editor_2014.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/common/editor_menu_2014.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/common/ewm_r.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/common/footer_8264_new.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/common/header_common.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
|| checktplrefresh('./template/8264/forum/dianping/brandpost.htm', './template/8264/common/index_ad_top.htm', 1508743388, '2', './data/template/2_2_forum_dianping_brandpost.tpl.php', './template/8264', 'forum/dianping/brandpost')
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
<!--[if lte IE 7]>
 <script src="http://static.8264.com/static/js/dianping/json2.js" type="text/javascript"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/<?php echo $modstr;?>style.css?<?php echo VERHASH;?>" />
<div class="blackLayout" id="div_black"></div>
<div class="popBox" id="box_msg" style="display:none;">
<div class="bd w420">
<div class="popMessage">
<div class="messageText" id="bmsg_text"></div>
<button class="sureBlueBtn_182x43" id="bmsg_ok"></button>
</div>
<span class="closeBtn" id="bmsg_closeBtn">关闭</span>
</div>
</div>


<script type="text/javascript">
document.body.onselectstart=function(){ return false;}
document.body.style="-moz-user-select:none";
</script>



<script type="text/javascript">
jQuery(document).ready(function($) {
$("#bmsg_ok, #bmsg_closeBtn").click(function(){
$("#div_black, #box_msg").hide();
});
$('#div_black').appendTo('body');
$("#div_black").css({ opacity: 0.8 });
$('#box_msg').appendTo('body');
var bodyheight = $("body").height();
$("#div_black").height(bodyheight);
$("#div_black").hide();
});
function _showmsg(text){
jQuery("#bmsg_text").text(text);
jQuery("#div_black, #box_msg").show();
}
</script>
<div class="header">
<div class="layout">
<div class="icoHill">&nbsp;</div>
<div class="headerL">
<h1><span class="country"><?php echo $modname;?></span></h1>
<div>
<div class="site">
<a href="<?php echo $_G['config']['web']['portal'];?>">首页</a>
<?php if($modstr) { ?>
> <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist"><?php echo $modname;?></a>
<?php } if($viewdata['proname']&&$modstr!='shop') { ?>
> <strong><a href="<?php echo $url;?>&act=showlist&order=heats&page=1&pro=<?php echo $viewdata['pro'];?>"><?php echo $viewdata['proname'];?></a></strong>
<?php } elseif($pcid && $modstr=='equipment') { ?>
> <strong><a href="<?php echo $url;?>&act=showlist&order=heats&pcid=<?php echo $pcid;?>&cid=0&bid=0&page=1"><?php echo $pcname;?></a></strong>
<?php if($cid) { ?>> <a href="<?php echo $url;?>&act=showlist&order=heats&pcid=<?php echo $pcid;?>&cid=<?php echo $cid;?>&bid=0&page=1"><?php echo $cname;?></a><?php } } elseif($viewdata['pcname'] && $modstr=='equipment') { ?>
> <a href="<?php echo $url;?>&act=showlist&order=heats&pcid=<?php echo $viewdata['pcid'];?>&cid=0&bid=0&page=1"><?php echo $viewdata['pcname'];?></a>
> <strong><a href="<?php echo $url;?>&act=showlist&order=heats&pcid=<?php echo $viewdata['pcid'];?>&cid=<?php echo $viewdata['cid'];?>&bid=0&page=1"><?php echo $viewdata['cname'];?></a></strong>
<?php } elseif($viewdata['cname']  && $modstr=='equipment') { ?>
> <a href="<?php echo $url;?>&act=showlist&order=heats&cid=<?php echo $viewdata['cid'];?>&page=1"><?php echo $viewdata['cname'];?></a>

<?php } if($viewdata['shortsubject'] && $modstr!='equipment') { ?>
> <strong><a href="<?php echo $url;?>&act=showview&tid=<?php echo $viewdata['tid'];?>"><?php echo $viewdata['shortsubject'];?></a></strong>
<?php } if($modstr=='brand' && $pro) { ?>
><strong><a href="<?php echo $oldurl;?>&act=showlist&let=0&nat=0&cp=<?php echo $pro['id'];?>&order=score&page=1"><?php echo $pro['produce'];?></a></strong>
<?php } if($modstr=="line") { if($province) { ?>
>
<?php } elseif($city) { ?>
>
<?php } elseif($lType) { ?>
>
<?php } ?>
                    <!--线路和旅游自定义字段处理 by lgt at 20140815-->
                    <?php if(($city || $province) && $lType==0) { ?>
                    <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist&order=lastpost&lType=0&lTime=<?php echo $lTime;?>&province=<?php echo $province;?>&city=<?php echo $city;?>&page=1">
                        <strong><?php echo $regionsList[$province]["cityname"];?><?php echo $cityList[$province][$city]["name"];?>旅游攻略</strong>
                    </a>
                    <?php } elseif($city || $province) { ?>
                    <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist&order=lastpost&lType=<?php echo $lType;?>&lTime=<?php echo $lTime;?>&province=<?php echo $province;?>&city=<?php echo $city;?>&page=1">
                        <strong><?php echo $regionsList[$province]["cityname"];?><?php echo $cityList[$province][$city]["name"];?>周边<?php echo $typelist[$lType]['name'];?>线路攻略</strong>
                    </a>
                    <?php } ?>
                    <!--线路和旅游自定义字段处理 by lgt at 20140815-->
                    <?php } ?>
                <?php if($modstr=="diving" && $action !='new' && $action!='edit') { ?>
                    <?php if(($city || $province) && $type==0) { ?>
                    >
                        <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist&order=lastpost&type=0&provinceid=<?php echo $province;?>&cityid=<?php echo $city;?>&page=1">
                            <strong>2014<?php echo $proList[$province]["cityname"];?><?php echo $cityList[$province][$city]["cityname"];?><?php echo $modname;?>点评</strong>
                        </a>
                    <?php } elseif($city || $province) { ?>
                    >
                        <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist&order=lastpost&type=<?php echo $type;?>&provinceid=<?php echo $province;?>&cityid=<?php echo $city;?>&page=1">
                            <strong>2014<?php echo $proList[$province]["cityname"];?><?php echo $cityList[$province][$city]["cityname"];?><?php echo $divtypeList[$type]['name'];?>点评</strong>
                        </a>
                    <?php } ?>
                <?php } ?>
</div>
<?php if($regions && $citychange) { ?>
<span class="cityChange"><span id="cBtn">（切换城市）</span>
<div class="cityList" id="cList">
<div class="list">
<a href="forum.php?ctl=<?php echo $modstr;?>&amp;act=showlist&amp;order=heats&amp;page=1">中国</a><?php if(is_array($regions)) foreach($regions as $type) { if($type['count']>0) { ?><a href="forum.php?ctl=<?php echo $modstr;?>&amp;act=showlist&amp;order=heats&amp;page=1&amp;pro=<?php echo $type['pro'];?>"><?php echo $type['name'];?></a><?php } } ?>
</div>
<span class="topJJ">◆</span><span class="topJJWrite">◆</span>
</div>
</span>
<script type="text/javascript">
jQuery(document).ready(function($){
$('#cBtn').click(function(){
$('#cList').show();
});
$('#cList').mouseleave(function(){
$(this).hide();
});
});
</script>
<?php } ?>
</div>
</div>
<?php if($dianpingmodules) { ?>
<div class="headerR">
<div class="colNameList"><?php if(is_array($dianpingmodules)) foreach($dianpingmodules as $dm) { ?>                                        <?php if($dm['src']!="shop" && $dm['src']!="fishing" && $dm['src']!="diving" && $dm['src']!="climb") { ?>
                                        <a <?php if($modstr == $dm['src']) { ?>class="nowmod"<?php } ?> href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $dm['src'];?>&act=showlist"><?php echo $dm['name'];?></a>
                                        <?php } } ?>
</div>
</div>
<?php } ?>
</div>
</div>
<script src="<?php echo $_G['setting']['jspath'];?>forum_post.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php if($_G['gp_action'] == 'edit') { ?><?php $editor[value] = $postinfo[message]; } else { ?><?php $editor[value] = $message; } ?>

<link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_forum_post.css?<?php echo VERHASH;?>" />
<!--[if IE 6]>
<script src="/source/plugin/outshop/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="/source/plugin/outshop/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->
<style type="text/css">
#imglist .overlimit{display:none;}
#pic_upload_multiimg { vertical-align: middle; }
.bm, .bn{margin-bottom: 0px;}
</style>

<script type="text/javascript">
maxpicnumber = 0;
jQuery(document).ready(function($) {
$(document).on("click", "#imglist .deleteimg", function() {
$(this).parent().remove();
if($("#imglist .overlimit").length > 0){
$("#imglist .overlimit:first").removeClass('overlimit').find('input:hidden').removeAttr('disabled');
}else{
$("#numimage").val($("#numimage").val() - 1);
}
});
$('#subject').focus(function(){
$('#brand').hide();
}).blur(function(){
$(this).val() || $('#brand').show();
});

$('#bEn').focus(function(){
$('#benTip').hide();
}).blur(function(){
$(this).val() || $('#benTip').show();
});

$('#bCn').focus(function(){
$('#bcnTip').hide();
}).blur(function(){
$(this).val() || $('#bcnTip').show();
});

$('#company').focus(function(){
$('#companyTip').hide();
}).blur(function(){
$(this).val() || $('#companyTip').show();
});

$('#link').focus(function(){
$('#linkTip').hide();
}).blur(function(){
$(this).val() || $('#linkTip').show();
});

$('#city').focus(function(){
$('#cityTip').hide();
}).blur(function(){
$(this).val() || $('#cityTip').show();
});

$('#url').focus(function(){
$('#urlTip').hide();
}).blur(function(){
$(this).val() || $('#urlTip').show();
});

$('#address').focus(function(){
$('#addressTip').hide();
}).blur(function(){
$(this).val() || $('#addressTip').show();
});

$('.pubDt50 .gjselect_note').click(function(){
$('.gjdiv').toggle();
});
$('.gjdiv a').click(function(){
$('.pubDt50 .gjselect_note').text($(this).text());
$('#nation').val($(this).attr('rid'));
$('#cname').val($(this).text());
$('.gjdiv').hide();
});

});
function brand_validate(theform) {
var message = wysiwyg ? html2bbcode(getEditorContents()) : (!theform.parseurloff.checked ? parseurl(theform.message.value) : theform.message.value);
theform.message.value = message;
<?php if($_G['gp_action'] != 'edit') { ?>
if(($('postsubmit').name != 'replysubmit' && !($('postsubmit').name == 'editsubmit' && !isfirstpost) && theform.subject.value == "")) {
showDialog('请填写户外品牌名称');
return false;
} else if(mb_strlen(theform.subject.value) > 80) {
showDialog('品牌名称超过 80 个字符的限制');
return false;
} else if(trim(theform.subject.value) == ""){
showDialog('请填写户外品牌名称');
return false;
}

if (theform.bEn.value=="") {
showDialog('请填写品牌的英文名称');
return false;
}
//	if (theform.company.value=="") {
//		showDialog('请填写品牌所属的公司名称');
//		return false;
//	}
if (theform.nation.value=="0"||theform.nation.value=="") {
showDialog('请选择品牌所属的国籍');
return false;
}
var flag = false;
for(var i = 0;i < theform.lett.length;i++){
   if(theform.lett[i].checked){
flag = true;
   }
}
if (!flag){
showDialog('请选择品牌首字母');
 return false;
}

if (theform.city.value=="") {
showDialog('请填写总部所在城市');
return false;
}
if (theform.url.value=="") {
showDialog('请填写官方网站');
return false;
}
var url = theform.url.value;
if(url){
var regexp = new RegExp("(http[s]{0,1}|ftp)://[a-zA-Z0-9\\.\\-]+\\.([a-zA-Z]{2,4})(:\\d+)?(/[a-zA-Z0-9\\.\\-~!@#$%^&amp;*+?:_/=<>]*)?", "gi");
var urls = url.match(regexp);
if(!urls){
showDialog('网站地址填写不正确');
return false;
}
}

    /*if (theform.uploadfile.value==""||theform.uploadfile.value==0) {
     showDialog('请上传品牌logo图片');
     return false;
     }*/
    /*编辑页面取得logo图片*/
    if (jQuery('#imglist').find("span:not('.overlimit')").length==0) {
        showDialog('请上传品牌logo图片');
        return false;
    }
if (parseInt(theform.uploadfile.value)>=2) {
showDialog('品牌logo图片上传一张即可');
return false;
}
if (!theform.upfile.value) {
showDialog('请上传品牌logo图片');
return false;
}
if(!/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(theform.upfile.value)){
showDialog('您上传的图片格式不正确');
return false;
}
if (trim(theform.message.value)=="") {
showDialog('请填写品牌介绍');
return false;
}
<?php } else { ?>
if (theform.bEn.value=="") {
showDialog('请填写品牌的英文名称');
return false;
}
//	if (theform.company.value=="") {
//		showDialog('请填写品牌所属的公司名称');
//		return false;
//	}
if (theform.nation.value=="0"||theform.nation.value=="") {
showDialog('请选择品牌所属的国籍');
return false;
}
var flag = false;
for(var i = 0;i < theform.lett.length;i++){
   if(theform.lett[i].checked){
flag = true;
   }
}
if (!flag){
showDialog('请选择品牌首字母');
 return false;
}

if (theform.city.value=="") {
showDialog('请填写总部所在城市');
return false;
}
if (theform.url.value=="") {
showDialog('请填写官方网站');
return false;
}
var url = theform.url.value;
if(url){
var regexp = new RegExp("(http[s]{0,1}|ftp)://[a-zA-Z0-9\\.\\-]+\\.([a-zA-Z]{2,4})(:\\d+)?(/[a-zA-Z0-9\\.\\-~!@#$%^&amp;*+?:_/=<>]*)?", "gi");
var urls = url.match(regexp);
if(!urls){
showDialog('网站地址填写不正确');
return false;
}
}
/*if (theform.uploadfile.value==""||theform.uploadfile.value==0) {
showDialog('请上传品牌logo图片');
return false;
}*/
    /*编辑页面取得logo图片*/
    if (jQuery('#imglist').find("span:not('.overlimit')").length==0) {
        showDialog('请上传品牌logo图片');
        return false;
    }
if (parseInt(theform.uploadfile.value)>=2) {
showDialog('品牌logo图片上传一张即可');
return false;
}
<?php } ?>
if($('postsubmit').name == 'editsubmit') {
return true;
}else if(in_array($('postsubmit').name, ['topicsubmit', 'replysubmit','postsubmit'])) {
postsubmit(theform);
}
return false;
}
</script><?php $adveditor = $isfirstpost && $special || $special == 2 && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'reply' && !empty($_G['gp_addtrade']) || $_G['gp_action'] == 'edit' && $thread['special'] == 2); ?><?php $advmore = !$showthreadsorts && !$special || $_G['gp_action'] == 'reply' && empty($_G['gp_addtrade']) || $_G['gp_action'] == 'edit' && !$isfirstpost && ($thread['special'] == 2 && !$special || $thread['special'] != 2); ?><div class="layout mt50" style="">
<form method="post" autocomplete="off" id="postform" onsubmit="return brand_validate(this);"
action="<?php if($_GET['do']=='new') { ?>forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=new&arg=save
<?php } elseif($_GET['do']=='reply') { ?>forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=reply&tid=<?php echo $_G['tid'];?><?php } elseif($_GET['do']=='edit') { ?>
forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=edit&tid=<?php echo $_G['tid'];?><?php } ?>">
<div id="postbox">
<div class="pubWeb">
<div class="publishLayout">
<h1 class="tit20 mb45"><?php if(($action=='new')) { ?>发布<?php echo $modname;?><?php } else { ?>编辑<?php echo $modname;?><?php } ?><b class="note">新品牌付费收录,5000元永久收录 联系qq:3278817818</b></h1>
<div class="bd">
<?php if(!empty($_G['gp_modthreadkey'])) { ?><input type="hidden" name="modthreadkey" id="modthreadkey" value="<?php echo $_G['gp_modthreadkey'];?>" /><?php } ?>
<input type="hidden" name="page" value="<?php echo $_G['gp_page'];?>" />
<input type="hidden" name="fid" id="fid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="posttime" id="posttime" value="<?php echo TIMESTAMP;?>" />
<?php if($_GET['do']=='edit') { ?><input type="hidden" name="pid" id="pid" value="<?php echo $editdata['pid'];?>" /><?php } ?>
<dl class="pubDt50">
<dt><span class="name48_43"></span></dt>
<dd>
<span class="inputTipsText">
<label class="fs16" id="brand" <?php if($editdata['subject']) { ?> style="display: none;"<?php } ?>>户外品牌</label>
<input type="text" class="inputText w270" onkeyup="strLenCalc(this, 'checklen', 80);" id="subject" name="subject" <?php if($action=='edit') { ?> value="<?php echo $editdata['subject'];?>" readonly="readonly"<?php } ?>/>
</span>
<span class="icoRedStar">*</span>
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="englishname48_43"></span></dt>
<dd>
<span class="inputTipsText">
<label class="fs16" id="benTip" <?php if($editdata['bEn']) { ?> style="display: none;"<?php } ?>>请填写品牌的英文名称</label>
<input type="text" class="inputText w270" id="bEn" name="ename"   value="<?php echo $editdata['ename'];?>" />
</span>
<span class="icoRedStar">*</span>
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="chinesename48_43"></span></dt>
<dd>
<span class="inputTipsText">
<label class="fs16" id="bcnTip" <?php if($editdata['cname']) { ?> style="display: none;"<?php } ?>>请填写品牌的中文名称，如没有中文名称请留空</label>
<input type="text" class="inputText w360" id="bCn" name="cname" value="<?php echo $editdata['cname'];?>"/>
</span>
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="dl48_43"></span></dt>
<dd>
<span class="inputTipsText">
<label class="fs16" id="companyTip" <?php if($editdata['company']) { ?> style="display: none;"<?php } ?>>国内品牌请填所属公司，国外品牌的国内代理，请填写国内总代理</label>
<input type="text" class="inputText w500" id="company" name="company"  value="<?php echo $editdata['company'];?>"/>
</span>
<!--								<span class="icoRedStar">*</span>-->
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="tel48_43"></span></dt>
<dd>
<span class="inputTipsText">
<label class="fs16" id="linkTip" <?php if($editdata['tel']) { ?> style="display: none;"<?php } ?>>联系电话</label>
<input type="text" class="inputText w270" id="link" name="link" value="<?php echo $editdata['tel'];?>"/>
</span>
<!--								<span class="icoRedStar">*</span>-->
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="gj48_43"></span></dt>
<dd>
<span class="inputTipsText" style="z-index:10;">
<div class="gjselect_note w270"><?php if($editdata['nation']) { ?><?php echo $editdata['nation'];?><?php } else { ?>品牌国籍<?php } ?></div>
<input type="hidden" name="nation" id="nation" value="<?php echo $editdata['nationid'];?>"/>
<div class="gjdiv">
<?php if($brandlist) { if(is_array($brandlist)) foreach($brandlist as $brand) { ?><a href="javascript:;" rid="<?php echo $brand['rid'];?>"><?php echo $brand['area'];?></a>
<?php } } ?>
</div>
</span>
<span class="icoRedStar">*</span>
</dd>
</dl>
<div class="zmlist">
<h3 class="tit14">品牌首字母</h3>
<?php if($letlist) { if(is_array($letlist)) foreach($letlist as $key => $let) { ?><span><input type="radio" name="lett" value="<?php echo $key;?>" id="lett[]" <?php if($key==$editdata['letter']) { ?>checked="checked"<?php } ?>/><label for="<?php echo $let;?>"><?php echo $let;?></label></span>
<?php } } ?>
</div>
                                                <dl class="pubDt50">
<dt><span class="dz48_43"></span></dt>
<dd>
<span class="inputTipsText">
<label class="fs16" id="addressTip" <?php if($editdata['addr']) { ?> style="display: none;"<?php } ?>>联系地址</label>
<input type="text" class="inputText w270" id="address" name="address" value="<?php echo $editdata['addr'];?>"/>
</span>
<!--								<span class="icoRedStar">*</span>-->
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="zb48_43"></span></dt>
<dd>
<span class="inputTipsText">
<label class="fs16" id="cityTip" <?php if($editdata['city']) { ?> style="display: none;"<?php } ?>>总部所在城市</label>
<input type="text" class="inputText w270" id="city" name="city"  value="<?php echo $editdata['city'];?>"/>
</span>
<span class="icoRedStar">*</span>
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="web48_43"></span></dt>
<dd>
<span class="inputTipsText">
<label class="fs16" id="urlTip" <?php if($editdata['url']) { ?> style="display: none;"<?php } ?>>官方网站前请加 http://</label>
<input type="text" class="inputText w270" id="url" name="url" value="<?php echo $editdata['url'];?>"/>
</span>
<span class="icoRedStar">*</span>
</dd>
</dl>

<dl class="pubDt50">
<dt><span class="logo48_43"></span></dt>
<dd>
<input id="numimage" type="hidden" name="uploadfile" value="0"/>
<div id="pic_upload_multiimg">
此内容需要 Adobe Flash Player 10.0.0 或更高版本
<script type="text/javascript">
var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"
+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
</script>
</div>
<span class="icoRedStar">*</span>
<div id="imglist" class="readyPic">
                                    <?php if($editdata['pic'] && $editdata['dir']) { ?>
                                    <span id="imagelist_id_<?php echo $editdata['baid'];?>">
                                        <img src="<?php echo getimagethumb(60,60,2,$editdata['dir'].'/'.$editdata['pic'], $editdata['baid'], $editdata['serverid']); ?>">
                                        <b class="deleteimg">删除</b>
                                        <input type="hidden" name="imgselect[]" value="<?php echo $editdata['baid'];?>">
                                    </span>
                                    <?php } ?>
</div>
</dd>
</dl>
</div>
</div>
</div>
<div class="layout mt15"><?php $editor['value'] = $editdata['message']; ?><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_forum_post.css?<?php echo VERHASH;?>" />
<script src="<?php echo $_G['setting']['jspath'];?>forum_post.js?<?php echo VERHASH;?>" type="text/javascript"></script>

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
<?php } } if($_G['gp_action'] == 'edit') { ?>
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
<div id="postbox">
<?php if($showthreadsorts) { ?>
<div class="exfm cl" id="threadsorts">
<span id="threadsortswait"></span>
</div>
<?php } elseif($adveditor) { if($special == 1) { include template('forum/post_poll'); } elseif($special == 2 && ($_G['gp_action'] != 'edit' || ($_G['gp_action'] == 'edit' && ($thread['authorid'] == $_G['uid'] && $_G['group']['allowposttrade'] || $_G['group']['allowedittrade'])))) { ?><p class="xg1">添加商品信息，完成后可在本帖中继续添加多个商品</p><?php include template('forum/post_trade'); } elseif($special == 3) { include template('forum/post_reward'); } elseif($special == 4) { include template('forum/post_activity'); } elseif($special == 5) { include template('forum/post_debate'); } elseif($specialextra) { ?><div class="specialpost s_clear"><?php echo $threadplughtml;?></div>
<?php } } ?>
<div id="rstnotice" style="display:none"></div>
<div class="edt" id="<?php echo $editorid;?>_body">
<div id="<?php echo $editorid;?>_controls" class="bar">
<div class="y">
<div class="b2r nbl nbr" id="<?php echo $editorid;?>_adv_5">
<p>
<a id="<?php echo $editorid;?>_undo" title="撤销">Undo</a>
</p>
<p>
<a id="<?php echo $editorid;?>_redo" title="重做">Redo</a>
</p>
</div>
<div class="z">
<span class="mbn"><a id="<?php echo $editorid;?>_fullswitcher"></a><a id="<?php echo $editorid;?>_simple"></a></span>
<label id="<?php echo $editorid;?>_switcher" class="bar_swch ptn"><input id="<?php echo $editorid;?>_switchercheck" type="checkbox" class="pc" name="checkbox" value="0" <?php if(!$editor['editormode']) { ?>checked="checked"<?php } ?> onclick="switchEditor(this.checked?0:1)" />纯文本</label>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_right'])) { ?>
<div class="y"><?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_right'])) echo $_G['setting']['pluginhooks']['post_editorctrl_right']; ?></div>
<?php } ?>
<div id="<?php echo $editorid;?>_button" class="btn cl">
<div class="b1r" id="<?php echo $editorid;?>_adv_s0">
<a id="<?php echo $editorid;?>_paste" title="粘贴">粘贴</a>
</div>
<div class="b2r nbr" id="<?php echo $editorid;?>_adv_s2">
<a id="<?php echo $editorid;?>_fontname" class="dp" title="设置字体"><span id="<?php echo $editorid;?>_font">字体</span></a>
<a id="<?php echo $editorid;?>_fontsize" class="dp" title="设置文字大小"><span id="<?php echo $editorid;?>_size">大小</span></a>
<br id="<?php echo $editorid;?>_adv_1" />
<a id="<?php echo $editorid;?>_bold" title="文字加粗">B</a>
<a id="<?php echo $editorid;?>_italic" title="文字斜体">I</a>
<a id="<?php echo $editorid;?>_underline" title="文字加下划线">U</a>
<a id="<?php echo $editorid;?>_forecolor" title="设置文字颜色">Color</a>
<a id="<?php echo $editorid;?>_url" title="添加链接">Url</a>
<span id="<?php echo $editorid;?>_adv_8">
<a id="<?php echo $editorid;?>_unlink" title="移除链接">Unlink</a>
<a id="<?php echo $editorid;?>_inserthorizontalrule" title="分隔线">Hr</a>
</span>
</div>
<div class="b2r nbl" id="<?php echo $editorid;?>_adv_2">
<p id="<?php echo $editorid;?>_adv_3">
<a id="<?php echo $editorid;?>_tbl" title="添加表格">Table</a>
</p>
<p>
<a id="<?php echo $editorid;?>_removeformat" title="清除文本格式">Removeformat</a>
</p>
</div>
<div class="b2r">
<p>
<a id="<?php echo $editorid;?>_justifyleft" title="居左">Left</a>
<a id="<?php echo $editorid;?>_justifycenter" title="居中">Center</a>
<a id="<?php echo $editorid;?>_justifyright" title="居右">Right</a>
</p>
<p id="<?php echo $editorid;?>_adv_4">
<a id="<?php echo $editorid;?>_autotypeset" title="自动排版">Autotypeset</a>
<a id="<?php echo $editorid;?>_insertorderedlist" title="排序的列表">Orderedlist</a>
<a id="<?php echo $editorid;?>_insertunorderedlist" title="未排序列表">Unorderedlist</a>
</p>
</div>
<div class="b1r" id="<?php echo $editorid;?>_adv_s1" style="display: none;">
<a id="<?php echo $editorid;?>_sml" title="添加表情">表情</a>
<div id="<?php echo $editorid;?>_imagen" style="display:none">!</div>
<a id="<?php echo $editorid;?>_image" title="添加图片">图片</a>
<?php if($_G['group']['allowpostattach']) { ?>
<div id="<?php echo $editorid;?>_attachn" style="display:none">!</div>
<a id="<?php echo $editorid;?>_attach" title="添加附件">附件</a>
<?php } if($_G['forum']['allowmediacode']) { ?>
<a id="<?php echo $editorid;?>_aud" title="添加音乐">音乐</a>
<a id="<?php echo $editorid;?>_vid" title="添加视频">视频</a>

<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_left'])) echo $_G['setting']['pluginhooks']['post_editorctrl_left']; ?>
</div>
<div class="b2r<?php if($_G['cache']['bbcodes_display'][$_G['groupid']]) { ?> nbr<?php } ?>" id="<?php echo $editorid;?>_adv_6">
<p>
<a id="<?php echo $editorid;?>_code" title="添加代码文字">代码</a>
<?php if($isfirstpost && $_G['group']['allowhidecode']) { ?><a id="<?php echo $editorid;?>_hide" title="添加隐藏内容">Hide</a><?php } ?>
</p>
<p>
<a id="<?php echo $editorid;?>_quote" title="添加引用文字">引用</a>
<?php if($isfirstpost) { ?><a id="<?php echo $editorid;?>_free" title="添加免费信息">Free</a><?php } ?>
</p>
</div>
<?php if($_G['cache']['bbcodes_display'][$_G['groupid']]) { ?>
<div class="b2r nbl"><?php if(is_array($_G['cache']['bbcodes_display'][$_G['groupid']])) foreach($_G['cache']['bbcodes_display'][$_G['groupid']] as $tag => $bbcode) { if($bbcode['i'] % 2 != 0) { ?><a id="<?php echo $editorid;?>_cst<?php echo $bbcode['params'];?>_<?php echo $tag;?>" class="cst" title="<?php echo $bbcode['explanation'];?>"><img src="<?php echo STATICURL;?>image/common/<?php echo $bbcode['icon'];?>" title="<?php echo $bbcode['explanation'];?>" alt="<?php echo $tag;?>" /></a><?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_top'])) echo $_G['setting']['pluginhooks']['post_editorctrl_top']; ?>
<br id="<?php echo $editorid;?>_adv_7" /><?php if(is_array($_G['cache']['bbcodes_display'][$_G['groupid']])) foreach($_G['cache']['bbcodes_display'][$_G['groupid']] as $tag => $bbcode) { if($bbcode['i'] % 2 == 0) { ?><a id="<?php echo $editorid;?>_cst<?php echo $bbcode['params'];?>_<?php echo $tag;?>" class="cst" title="<?php echo $bbcode['explanation'];?>"><img src="<?php echo STATICURL;?>image/common/<?php echo $bbcode['icon'];?>" title="<?php echo $bbcode['explanation'];?>" alt="<?php echo $tag;?>" /></a><?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_bottom'])) echo $_G['setting']['pluginhooks']['post_editorctrl_bottom']; ?>
</div>
<?php } if($_G['setting']['magicstatus'] && !empty($_G['setting']['magics']['doodle'])) { ?>
<div class="b2r">
<a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=<?php echo $editorid;?>_textarea&amp;from=forumeditor" class="cst" onclick="showWindow(this.id, this.href, 'get', 0)"><img src="<?php echo STATICURL;?>image/magic/doodle.small.gif" alt="doodle" title="<?php echo $_G['setting']['magics']['doodle'];?>" style="margin-top:2px" /></a>
</div>
<?php } ?>
</div>
</div>
                <style>
                #upload_newimage_tools h4 span{padding: 0 5px;display: block;float: left;cursor:pointer;font-size:13px;font-weight: bold;border:1px solid #F6F6F6;border-bottom-width:1px;border-bottom-color: #CCC;margin-right:5px;position: relative;top: 1px;font-family: Arial,PMingLiU,sans-serif;}
                #upload_newimage_tools h4{height:30px;line-height: 28px;padding-top:2px;padding-left:5px;border-bottom: 1px solid #CCC;background:#FFF}
                #tips_limit{position: absolute;background:#FFF;border:5px solid #CCC;display: none;}
#uploadtips{color:blue;text-align:center;}
                </style>
                <div id="tips_limit">
                    <div class="notice upnf">
                        照片可以多个选取，批量上传
    						<br />照片大小：小于8.7MB,边长小于2500像素，否则无法上传。
                        <?php if($_G['group']['maxattachnum'] || $_G['group']['maxsizeperday']) { ?>
                        <br />上传限制: <?php if($_G['group']['maxattachnum']) { ?><strong><?php echo $allowuploadnum;?></strong> 个文件&nbsp;<?php } if($_G['group']['maxsizeperday']) { ?><strong><?php echo $allowuploadsize;?></strong>&nbsp;<?php } ?>
    					<?php } ?>
    					<?php if($imgexts) { ?>
    						<br />可用扩展名: <strong><?php echo $imgexts;?></strong>&nbsp;
    					<?php } ?>
    					<?php if($creditstring) { ?>
    						<br /><a href="forum.php?mod=faq&amp;action=credits&amp;fid=<?php echo $_G['fid'];?>" target="_blank" title="积分说明">每上传一个附件你的&nbsp;<?php echo $creditstring;?></a>
    					<?php } ?>
    				</div>
                </div>
<div class="area">
<div style="float: left;width:75%;"><textarea name="<?php echo $editor['textarea'];?>" id="<?php echo $editorid;?>_textarea" class="pt" tabindex="2" rows="15"><?php echo $editor['value'];?></textarea></div>
                    <div id="upload_newimage_tools" style="float: right;width: 228px;border-left: 1px solid #EBEBEB;background: #F6F6F6;height:400px;">
                        <h4><span>上传图片</span><span>使用相册</span><!--<span>网络图片</span>--></h4>
                            <div class="p_opt" unselectable="on" id="<?php echo $editorid;?>_multi" style="display: none;">
                				<div class="fswf" id="<?php echo $editorid;?>_multiimg" style="width: 100%;height:100%;overflow: hidden;margin: 0 auto;border:0px">
                                    <div id="<?php echo $editorid;?>_multiimg_swf" style="width: 100%;height: 30px;text-align: left;background: #FFF;">
                                        <div style="background:url('../../static/image/common/upload_img_new.jpg') no-repeat;;font-size:20px;color:#FFF;text-align: center;font-weight:bold;overflow: hidden;cursor:pointer;width:208px;height:30px;"></div>
                                    </div>
                                    <script src="static/js/swfobject.js" type="text/javascript"></script>
                                    <script type="text/javascript">
var params = {site:"<?php echo $_G['siteroot'];?>misc.php%3fmod=swfupload%26type=image%26fid=<?php echo $_G['fid'];?>%26random=<?php echo random(4); ?>"};
swfobject.embedSWF("static/image/common/newupload.swf", "<?php echo $editorid;?>_multiimg_swf", "208", "52", "11.1.0", "playerProductInstall.swf", params, {wmode:"transparent"});
swfobject.createCSS("#<?php echo $editorid;?>_multiimg_swf", "display:block;text-align:left;");
                                    </script>
<div><p style="margin-top:1px;display:none;" id="uploadtips"></p></div>
                                    <div id="<?php echo $editorid;?>_imgattachlist" style='background:#fff;width: 208px;border:1px soild #ccc;'>
                                        <div class="upfilelist">
                                            <div style="background:url('../../static/image/common/list_img_new.jpg') no-repeat;font-size:20px;color:#FFF;text-align: center;font-weight:bold;overflow: hidden;cursor:pointer;height:30px;width:208px"></div>
                                            <div id="photolist_upload" style="overflow: scroll;overFlow-x: hidden;width:208px;padding-top:10px;">
                                                <?php if(!empty($imgattachs['used'])) { ?><?php $imagelist = $imgattachs['used']; ?>                        					       <?php include template('forum/ajax_imagelist_newimage'); ?>                        				        <?php } ?>
                                                <div id="imgattachlist" style="width: 200px;">
                                                <?php if(empty($imgattachs['used']) && empty($imgattachs['unused'])) { ?>
                                                	<p class="notice">本帖还没有图片附件<?php if($allowuploadnum) { ?>, 请先上传<?php } ?></p>
                                                <?php } ?>
                                                </div>
                                                <div id="unusedimgattachlist"  style="width: 200px;">
                                                <?php if(!empty($imgattachs['unused'])) { ?>
                                                <?php $imagelist = $imgattachs['unused']; ?>                                                <?php include template('forum/ajax_imagelist_newimage'); ?>                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="height:40px;background: #FFF;padding-top:5px;">
                                        <div style="color:#F26C4F;height:20px;font-weight: bold;">点击图片添加到帖子内容中</div>
                                        <div style="background: #FFF;height:20px"><span id="save_to_album" style="font-weight:bolder;color:#336699;cursor: pointer;">保存到相册</span><span id="insert_all_imagelist" style="font-size: 12px;height:20px;position:relative;font-weight: bold;cursor: pointer;background: #FFF;margin-left:10px;">全部添加</span></div>
                                        <div id="album_contrl" style="position: relative;border: 5px solid #CCC;top:-130px;z-index:999;padding:5px;background:#FFF;display: none;">
                                        <?php if($_G['group']['allowupload']) { ?>
                                        <input type="checkbox" id='all_insert_alb' value='insertall'/>保存选中的图片到相册:<div onclick="this.parentNode.style.display='none'" style="float:right;background:url('../../static/image/common/op.png') no-repeat scroll 0 -2px transparent;height:20px;width:20px;cursor: pointer;"></div>
                                        <select name="uploadalbum" onclick="if(!this.value) {$('newalbum').style.display = ''} else {$('newalbum').style.display = 'none'}">
                                        <?php if(is_array($albumlist)) foreach($albumlist as $album) { ?>                                        		<option value="<?php echo $album['albumid'];?>"><?php echo $album['albumname'];?></option>
                                        	<?php } ?>
                                        	<option value="">+创建新相册</option>
                                        </select>
                                        <input type="text" name="newalbum" id="newalbum" class="px mtn" size="20" value="" style="display:none" />
                                        <?php } ?>
                                        </div>
                                        </div>
                                    </div>
                				</div>
                			</div>
                            <div class="p_opt" unselectable="on" id="<?php echo $editorid;?>_albumlist" style="display: none;">
                        		<div class="upfilelist">
                        			从我的相册中选择图片:
                        			<select onchange="if(this.value) {ajaxget('forum.php?mod=post&new_image_template=1&action=albumphoto&aid='+this.value, 'albumphoto');}">
                        				<option value="">选择相册</option>
                        <?php if(is_array($albumlist)) foreach($albumlist as $album) { ?>                        					<option value="<?php echo $album['albumid'];?>"><?php echo $album['albumname'];?></option>
                        				<?php } ?>
                        			</select>
                        			<div id="albumphoto"></div>
                        		</div>
                        		<p class="notice xi1 xw1">点击图片添加到帖子内容中</p>
                        	</div>
                            <div class="p_opt popupfix" unselectable="on" id="<?php echo $editorid;?>_www" style="display: none;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                            			<th width="74%">请输入图片地址</th>
                            			<th width="13%">宽(可选)</th>
                            			<th width="13%">高(可选)</th>
                            		</tr>
                            		<tr>
                            			<td><input type="text" id="<?php echo $editorid;?>_image_param_1" onchange="loadimgsize(this.value)" style="width: 95%;" value="" class="px" autocomplete="off" /></td>
                            			<td><input id="<?php echo $editorid;?>_image_param_2" size="1" value="" class="px p_fre" autocomplete="off" /></td>
                            			<td><input id="<?php echo $editorid;?>_image_param_3" size="1" value="" class="px p_fre" autocomplete="off" /></td>
                            		</tr>
                            <tr>
                            			<td colspan="3" class="pns mtn">
                            				<button type="button" class="pn pnc" id="<?php echo $editorid;?>_image_submit"><strong>提交</strong></button>
                            				<button type="button" class="pn" onclick="hideMenu();"><em>取消</em></button>
                            			</td>
                            		</tr>
                                </table>
                            </div>
                    </div>
                    <div style="clear: both;"></div>
</div><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/editor.css?<?php echo VERHASH;?>" />
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

<?php if(!empty($_G['setting']['pluginhooks']['post_middle'])) echo $_G['setting']['pluginhooks']['post_middle']; if($_G['group']['maxprice'] && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost)) { ?>
<div class="mtm">
<?php if($_G['setting']['maxincperthread']) { ?><img src="<?php echo IMGDIR;?>/arrow_right.gif" />主题出售最高收入上限为 <?php echo $_G['setting']['maxincperthread'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } if($_G['setting']['maxchargespan']) { ?><img src="<?php echo IMGDIR;?>/arrow_right.gif" />主题最多能销售 <?php echo $_G['setting']['maxchargespan'];?> 个小时<?php if($_G['gp_action'] == 'edit' && $freechargehours) { ?>，本主题还能销售 <?php echo $freechargehours;?> 个小时<?php } } ?>
</div>
<?php } if($_G['gp_action'] != 'edit' && checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id);"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm"><?php include template('common/seccheck'); ?></div>
<?php } if($_G['gp_action'] == 'newthread' && $savethreads) { ?>
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

</div>
</div>


<div id="<?php echo $editorid;?>_menus" class="editorrow" style="overflow: hidden; margin-top: -5px; height: 0; border: none; background: transparent;"><div id="<?php echo $editorid;?>_editortoolbar" class="editortoolbar"><?php $fontoptions = array("仿宋_GB2312", "黑体", "楷体_GB2312", "宋体", "新宋体", "微软雅黑", "Trebuchet MS", "Tahoma", "Arial", "Impact", "Verdana", "Times New Roman") ?><div class="p_pop fnm" id="<?php echo $editorid;?>_fontname_menu" style="display: none">
<ul unselectable="on"><?php if(is_array($fontoptions)) foreach($fontoptions as $fontname) { ?><li onclick="discuzcode('fontname', '<?php echo $fontname;?>')" style="font-family: <?php echo $fontname;?>" unselectable="on"><a href="javascript:;" title="<?php echo $fontname;?>"><?php echo $fontname;?></a></li>
<?php } ?>
</ul>
</div><?php $sizeoptions = array(1, 2, 3, 4, 5, 6, 7) ?><div class="p_pop fszm" id="<?php echo $editorid;?>_fontsize_menu" style="display: none">
<ul unselectable="on"><?php if(is_array($sizeoptions)) foreach($sizeoptions as $size) { ?><li onclick="discuzcode('fontsize', <?php echo $size;?>)" unselectable="on"><a href="javascript:;" title="<?php echo $size;?>"><font size="<?php echo $size;?>" unselectable="on"><?php echo $size;?></font></a></li>
<?php } ?>
</ul>
</div>

</div>

<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">smilies_show('smiliesdiv', <?php echo $_G['setting']['smcols'];?>, editorid + '_');</script><div class="p_pof" id="<?php echo $editorid;?>_image_menu" style="display: none;visibility: hidden;" unselectable="on">
<iframe name="attachframe" id="attachframe" style="display: none;" onload="uploadNextAttach();"></iframe>
</div>
<?php if($_G['group']['allowpostattach']) { ?>
<div class="p_pof upf" id="<?php echo $editorid;?>_attach_menu" style="display: none" unselectable="on">
<span class="y"><a href="javascript:;" class="flbc" onclick="hideMenu()">关闭</a></span>
<ul class="imguptype" id="<?php echo $editorid;?>_attach_ctrl">
<li><a href="javascript:;" hidefocus="true" class="current" id="<?php echo $editorid;?>_btn_attachlist" onclick="switchAttachbutton('attachlist');">附件列表</a></li>
<?php if($_G['setting']['swfupload'] != 1 && $allowuploadnum) { ?><li><a href="javascript:;" hidefocus="true" id="<?php echo $editorid;?>_btn_upload" onclick="switchAttachbutton('upload');">普通上传</a></li><?php } if($_G['setting']['swfupload'] != 0 && $allowuploadnum) { ?><li><a href="javascript:;" hidefocus="true" id="<?php echo $editorid;?>_btn_swfupload" onclick="switchAttachbutton('swfupload');">批量上传</a></li><?php } ?>
</ul>

<div class="p_opt post_tablelist" unselectable="on" id="<?php echo $editorid;?>_attachlist">
<table cellpadding="0" cellspacing="0" border="0" width="100%" id="attach_tblheader"<?php if(empty($attachs['used']) && empty($attachs['unused'])) { ?> style="display: none"<?php } ?>>
<tr>
<td class="atnu"></td>
<td class="atna">文件名</td>
<td class="atds">描述</td>
<?php if($_G['group']['allowsetattachperm']) { ?>
<td class="attv">
阅读权限
<img src="http://static.8264.com/static/image/common/faq.gif" alt="Tip" class="vm" style="margin: 0;" onmouseover="showTip(this)" tip="阅读权限按由高到低排列，高于或等于选中组的用户才可以阅读。" />
</td>
<?php } if($_G['group']['maxprice']) { ?><td class="attp"><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?></td><?php } ?>
<td class="attc"></td>
</tr>
</table>
<div class="upfl">
<?php if(!empty($attachs['used'])) { ?><?php $attachlist = $attachs['used']; include template('forum/ajax_attachlist'); } ?>
<div id="attachlist">
<?php if(empty($attachs['used']) && empty($attachs['unused'])) { ?>
<p class="notice">本帖还没有附件<?php if($allowuploadnum) { ?>, <a href="javascript:;" onclick="switchAttachbutton('<?php if($_G['setting']['swfupload'] != 0) { ?>swfupload<?php } else { ?>upload<?php } ?>');">点击这里</a>上传<?php } ?></p>
<?php } ?>
</div>
<div id="unusedattachlist">
<?php if(!empty($attachs['unused'])) { ?><?php $attachlist = $attachs['unused']; ?><table cellpadding="0" cellspacing="0" width="100%"><tr><td class="attachnum"></td><td>以下是你上次上传但没有使用的附件:</td></tr></table><?php include template('forum/ajax_attachlist'); } ?>
</div>
</div>
<p class="ptm" id="attach_notice"<?php if(empty($attachs['used']) && empty($attachs['unused'])) { ?> style="display: none"<?php } ?>>点击文件名添加到帖子内容中<?php if($_G['setting']['allowattachurl']) { ?>，"attach://" 开头的附件地址支持任何人下载请谨慎添加<?php } ?></p>
<?php if($_G['group']['maxprice'] && $_G['setting']['maxincperthread']) { ?><p class="notice">附件出售最高收入上限为 <?php echo $_G['setting']['maxincperthread'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>&nbsp;&nbsp;&nbsp;&nbsp;</p><?php } ?>
</div>
</div>
<?php } ?>

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
switchButton(btn, btns);
$(editorid + '_image_menu').style.height = '';
}
<?php if($allowpostimg) { ?>
ATTACHNUM['imageused'] = <?php echo @count($imgattachs['used']); ?>;
ATTACHNUM['imageunused'] = <?php echo @count($imgattachs['unused']); ?>;
<?php if(!empty($imgattachs['used']) || !empty($imgattachs['unused'])) { ?>
switchImagebutton('imgattachlist');
$(editorid + '_image').evt = false;
updateattachnum('image');
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
$(editorid + '_attach').evt = false;
updateattachnum('attach');
<?php } else { ?>
switchAttachbutton('<?php if($_G['setting']['swfupload'] != 0) { ?>swfupload<?php } else { ?>upload<?php } ?>');
<?php } } if(!empty($attachs['unused']) || !empty($imgattachs['unused'])) { ?>
var msg = '<form id="unusedform"><div class="c ufl" style="<?php if(count($attachs['unused']) + count($imgattachs['unused']) > 10) { ?>height:180px;<?php } ?>overflow-y:auto;overflow-x:hidden"><p class="xg2">以下是你上次上传但没有使用的附件:</p>'<?php if(is_array($attachs['unused'])) foreach($attachs['unused'] as $attach) { ?>+ '<p id="unusedrow<?php echo $attach['aid'];?>"><a href="javascript:;" class="d" title="忽略" onclick="unusedoption(2, <?php echo $attach['aid'];?>)">忽略</a><a href="javascript:;" class="d deletepic" title="删除" attachid="<?php echo $attach['aid'];?>">删除</a><label><input id="unused<?php echo $attach['aid'];?>" name="unused[]" value="<?php echo $attach['aid'];?>" checked type="checkbox" class="pc" /> <span title="<?php echo $attach['filenametitle'];?> <?php echo $attach['dateline'];?>"><?php echo $attach['filename'];?></span></label></p>'
<?php } if(is_array($imgattachs['unused'])) foreach($imgattachs['unused'] as $attach) { ?>+ '<p id="unusedrow<?php echo $attach['aid'];?>"><a href="javascript:;" class="d" title="忽略" onclick="unusedoption(3, <?php echo $attach['aid'];?>)">忽略</a><a href="javascript:;" class="d deletepic" title="删除" attachid="<?php echo $attach['aid'];?>">删除</a><label><input id="unused<?php echo $attach['aid'];?>" name="unused[]" value="<?php echo $attach['aid'];?>" checked type="checkbox" class="pc" /> <span title="<?php echo $attach['filenametitle'];?> <?php echo $attach['dateline'];?>"><?php echo $attach['filename'];?></span></label></p>'
<?php } ?>
+ '</div><div class="o pns cl"><label class="z"><input type="checkbox" name="chkall" class="pc" checked="checked" onclick="checkall(this.form, \'unused\', \'chkall\')" /> 全选</label><button type="button" value="true" class="pn" onclick="unusedoption(0)"><span>忽略</span></button> <button type="button" value="true" class="pn deletepic"><span>删除</span></button> <button type="button" value="true" class="pn pnc" onclick="unusedoption(1)"><span>使用</span></button> </div></form>';
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
<style>
.c a.deletepic{background-position: 0 -42px;}
.c a.deletepic:hover{background-position: 0 -62px;}
</style>
</div>

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
var special = parseInt('<?php echo $special;?>');
var fid = <?php echo $fid;?>;

<?php if($isfirstpost && !empty($_G['forum']['threadtypes']['types'])) { ?>
simulateSelect('typeid');
<?php } if(!$isfirstpost && $thread['special'] == 5 && empty($firststand) && $_G['gp_action'] != 'edit') { ?>
simulateSelect('stand');
<?php } if(!$special && $_G['forum']['threadsorts'] && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost && !$thread['sortid'])) { ?>
simulateSelect('sortid');
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
var tmp_obj = $('e_textarea');
if(tmp_obj && tmp_obj.style.display == '') {
tmp_obj.focus();
}
} else if($('subject')) {
$('subject').focus();
}
function uploadsuccess(num,type) {
ajaxget('forum.php?mod=ajax&action=imagelist&new_template=1', 'imgattachlist');
}
</script>
<script type="text/javascript">
;(function($){
    $("#psd").hide().css('top','215px').show();
    $("#fujia_tools").click(function(){
        if($("#fujia_tools span").html()=='-'){
            $("#fujia_tools span").html('+');
            $("#fujia_tools").attr('title','点击显示');
            $("#fujia_tools").next().hide();
            $("#fujia_tools").removeClass('bbs pbm mbm');
            $("#ct .mn").css('width',$("#wp").width());
            $("#<?php echo $editorid;?>_iframe").parent().width($("#<?php echo $editorid;?>_iframe").parent().parent().width()-$("#upload_newimage_tools").width()-10);
        }else{
            $("#fujia_tools span").html('-');
            $("#fujia_tools").attr('title','点击隐藏');
            $("#fujia_tools").next().show();
            $("#fujia_tools").addClass('bbs pbm mbm');
            $("#ct .mn").css('width',$("#wp").width()-150);
            $("#<?php echo $editorid;?>_iframe").parent().width($("#<?php echo $editorid;?>_iframe").parent().parent().width()-$("#upload_newimage_tools").width()-10);
        }
    });
    $("#nv_forum").one('mouseover',function(){
        if($("#fujia_tools span").html()=='-'){
            $("#ct .mn").css('width',$("#wp").width()-150);
        }else{
            $("#ct .mn").css('width',$("#wp").width());
        }
        if($("#wp").width()>960){
$("#stip").css('right','295px');
            $("#psd").css('right','165px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','205px');}
        }else{
$("#stip").css('right','460px');
            $("#psd").css('right','230px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','375px');}
        }
        $("#<?php echo $editorid;?>_iframe").parent().width($("#<?php echo $editorid;?>_iframe").parent().parent().width()-$("#upload_newimage_tools").width()-10);
    });
    $(document).on('click mouseleave',"#wh",function(){
        if($("#fujia_tools span").html()=='-'){
            $("#ct .mn").css('width',$("#wp").width()-150);
        }else{
            $("#ct .mn").css('width',$("#wp").width());
        }
        if($("#wp").width()>960){
$("#stip").css('right','295px');
            $("#psd").css('right','165px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','205px');}
        }else{
$("#stip").css('right','460px');
            $("#psd").css('right','230px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','375px');}
        }
        $("#wp").one('mouseenter',function(){
            if($("#fujia_tools span").html()=='-'){
                $("#ct .mn").css('width',$("#wp").width()-150);
            }else{
                $("#ct .mn").css('width',$("#wp").width());
            }
            if($("#wp").width()>960){
$("#stip").css('right','295px');
                $("#psd").css('right','165px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','205px');}
            }else{
$("#stip").css('right','460px');
                $("#psd").css('right','230px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','375px');}
            }
        });
        $("#<?php echo $editorid;?>_iframe").parent().width($("#<?php echo $editorid;?>_iframe").parent().parent().width()-$("#upload_newimage_tools").width()-10);
        change__multi_height();
    });

    $("#stip").click(function(){
$(this).hide();
    });
    $("#<?php echo $editorid;?>_image").click(function(){
        if($("#upload_newimage_tools").css('display')=='none'){
            $("#upload_newimage_tools").show();
            $("#<?php echo $editorid;?>_iframe").parent().width('75%');
        }else{
            $("#upload_newimage_tools").hide();
            $("#<?php echo $editorid;?>_iframe").width('99%');
            $("#<?php echo $editorid;?>_iframe").parent().width('99%');
        }
    });
    $("#upload_newimage_tools h4 span").click(function(){
        $(this).css({'border-color':'#CCC','border-bottom-color':'#F2F2F2','background':'#F2F2F2'}).siblings().css({'border-color':'#FFF','border-bottom-color':'#CCC','background':'#FFF'}).end().parent().css({'border-bottom-color':'#CCC'}).end();
        var select_mod=$(this).index();
        switch(select_mod){
            case 0:
            var displaymod='multi';
            break;
            case 1:
            var displaymod='albumlist';
            break;
            default:
            return false;
            break;
        }
        $('#<?php echo $editorid;?>_'+displaymod).show().siblings(':not(h4)').hide();
    });
    function change__multi_height(){
        var zong_height=$("#upload_newimage_tools").height();
        var h4_height=$("#upload_newimage_tools :first").outerHeight();
        var multi_height=zong_height-h4_height-20;
        $("#<?php echo $editorid;?>_multi").height(multi_height);
        $("#<?php echo $editorid;?>_imgattachlist").height($("#<?php echo $editorid;?>_multiimg").height()-$("#<?php echo $editorid;?>_multiimg_swf").height());
        var imgattachlist_height=$("#<?php echo $editorid;?>_imgattachlist").height();
        $("#<?php echo $editorid;?>_imgattachlist :first").height(imgattachlist_height-45-5);
        var upfiles_height=$("#<?php echo $editorid;?>_imgattachlist :first").height();
        $("#photolist_upload").height(upfiles_height-30-5);
    }
    $(document).on('mouseleave','#photolist_upload tr td',function(){
        $(this).children('.delimg_icon').css('visibility','hidden');
    });
    $(document).on('mouseover','#photolist_upload tr td',function(){
        $(this).children('.delimg_icon').css('visibility','visible');
    });
    $(document).on('mouseenter','#upload_newimage_tools img',function(){
        $('#img_display_view').remove();
        var img_src=$(this).attr('src');
        if($(this).parents('#albumphoto').attr('id')=='albumphoto' && img_src.indexOf('.thumb.')>=0){
            img_src=img_src.substr(0,(img_src.length-10));
        }
        var off_left=$("#upload_newimage_tools").offset().left-330;
        var off_top=$("#upload_newimage_tools").offset().top+50;
        $("#<?php echo $editorid;?>_body").append("<div id='img_display_view' style='float:right;display:none;border:5px solid #BBB;padding:10px;background:#FFF;position:absolute;top:"+off_top+"px;left:"+off_left+"px;width:150px;height:30px;z-index:999'><div id='tips_loading' style='font-weight:bold;position:inherit;z-index:101;width:150px;height:30px;font-size:16px;line-height:30px;text-align:center;'>正在载入...</div><img src='"+img_src+"' onload=document.getElementById('tips_loading').style.display='none'; style='display:none;float:left;max-width:300px;max-height:300px;position:inherit'/><div>");
        $("#img_display_view img").error(function(){
            var top_error=$("#<?php echo $editorid;?>_body").offset().top+300;
            $(this).prev().text('载入失败').parent().css({'left':'508px','top':top_error}).end().end().remove();
            var parent_width=$('#tips_loading').width();
            var parent_height=$('#tips_loading').height();
            $('#img_display_view').width(parent_width).height(parent_height).fadeIn(500);
        });
        $('#img_display_view img').load(function(){
            var img_width=$('#img_display_view').offset().left+(300-$(this).width());
            $(this).prev().remove().end().parent().css({'left':img_width});
            var parent_width=$(this).width();
            var parent_height=$(this).height();
            $(this).show();
            $('#img_display_view').width(parent_width).height(parent_height).fadeIn(500);
        });
        $("#img_display_view").fadeIn(500);
    });
    $(document).on('mouseleave','#upload_newimage_tools img',function(){
        $('#img_display_view').remove();
    });
    if(/webkit/.test(navigator.userAgent.toLowerCase()) || /opera/.test(navigator.userAgent.toLowerCase())){
        $(document).on('click',"#<?php echo $editorid;?>_multiimg_swf",function(){
            //$(this).height('150px');
            $("#<?php echo $editorid;?>_multiimg_swf :first").slideUp(300).siblings().show();
            change__multi_height();
        });
        $(document).on('mouseenter',"#<?php echo $editorid;?>_multiimg_swf",function(){
            dis_tips();
            $("#tips_limit").show();
        });
        $(document).on('click',"#<?php echo $editorid;?>_imgattachlist",function(){
            $("#<?php echo $editorid;?>_multiimg_swf").height('52px');
            $("#<?php echo $editorid;?>_multiimg_swf :first").slideDown(300).siblings().hide();
            change__multi_height();
            dis_tips();
            $("#tips_limit").hide();
        });
        $(document).on('mousemove',"#upload_newimage_tools",function(){
            change__multi_height();
        })
    }else{
        $(document).on('mouseenter',"#<?php echo $editorid;?>_multiimg_swf",function(){
            //$(this).height('150px');
            change__multi_height();
            $("#<?php echo $editorid;?>_multiimg_swf :first").slideUp(300).siblings().show();
            dis_tips();
            $("#tips_limit").show();
        });
        $(document).on('mouseenter',"#<?php echo $editorid;?>_imgattachlist",function(){
            $("#<?php echo $editorid;?>_multiimg_swf").height('52px');
            change__multi_height();
            $("#<?php echo $editorid;?>_multiimg_swf :first").slideDown(300).siblings().hide();
        });
    }
    $(document).on('mouseleave',"#<?php echo $editorid;?>_multiimg_swf",function(){
        dis_tips();
        $("#tips_limit").hide();
    });
    function dis_tips(){
        var tips_left=$("#<?php echo $editorid;?>_multiimg_swf").offset().left-$("#tips_limit").width()-20;
        var tips_top=$("#<?php echo $editorid;?>_multiimg_swf").offset().top+20;
        $("#tips_limit").css({"left":tips_left,"top":tips_top});
    }
    $(document).on('click',"#insert_all_imagelist",function(){
        var have_img_len=$("#<?php echo $editorid;?>_iframe").contents().find('body img').length;
        var len_img=$('.imgl td:not(.imgdeleted) img').length;
        if(len_img>3){
            showDialog('你列表中的文件超过三张，超过三张的图片将会保存在列表内，您可以再次发帖时使用！');
        }
        for(i=0;i<(3-have_img_len);i++){
            $('.imgl td:not(.imgdeleted) img:eq('+i+')').click();
            if(have_img_len>0){
                //$("#<?php echo $editorid;?>_iframe").contents().find('body img:last').before('<br/>');
            }else{
                if(i>=1){
                    //$("#<?php echo $editorid;?>_iframe").contents().find('body img:last').before('<br/>');
                }
            }
        }
    });
    $(document).on('click',"#all_insert_alb",function(){
        $("#photolist_upload input:checkbox").click();
        if($("#photolist_upload input:hidden.pc").val()=="" && $("#all_insert_alb").attr('checked')=='checked'){
            $("#photolist_upload input:checkbox").click();
        }
    });
    $(document).on('mouseenter',"#<?php echo $editorid;?>_fullswitcher",function(){
        $("#e_iframe").parent().width("75%");
        $(".area").one('mouseover mousemove',function(){
            change__multi_height();
        });
    });
    $("#save_to_album").click(function(){
        $("#album_contrl").toggle();
    });
    function img_width_fix(){
        $("#<?php echo $editorid;?>_iframe").contents().find('body').children('img').load(function(){
            $(this).removeAttr('width');
        });
    }
    img_width_fix();
    if(/msie/.test(navigator.userAgent.toLowerCase())){
        $("#<?php echo $editorid;?>_iframe").one("mousemove",function(){
            img_width_fix();
        });
    }
    $("#<?php echo $editorid;?>_multiimg_swf :eq(1)").hide();
    $("#upload_newimage_tools h4 span:first").click();
    $('#fujia_tools').click();
    $("#<?php echo $editorid;?>_multiimg_swf").click();
    change__multi_height();
$('#unusedform>.o.pns.cl>button.deletepic').click(function(event){
$('#unusedform>div>p').find('input[type=checkbox]').each(function(){
if($(this).is(':checked')){
$(this).parents('p').find('a.deletepic').click();
}
});
  		hideMenu('fwin_dialog', 'dialog');
});
$('#unusedform .deletepic').click(function(event){
var m_attach_id = $(this).attr('attachid');
if(m_attach_id > 0){
ajaxget('forum.php?mod=ajax&action=deletepic&picid=' + m_attach_id, "hiddenobj");
$('#unusedrow' + m_attach_id).remove();
}
});
})(jQuery);
</script>
<div class="mtm mbm">
<button type="submit" id="postsubmit" class="tj182_43" value="true" name="<?php if($_GET['do'] == 'new') { ?>topicsubmit<?php } elseif($_G['gp_action'] == 'reply') { ?>replysubmit<?php } elseif($_GET['do'] == 'edit') { ?>editsubmit<?php } ?>"></button>

</div>
</div>
</div>
</form>
</div>
<script src="static/js/newswfobject.js" type="text/javascript"></script>
<script type="text/javascript">
//上传图片
var params = {site:"<?php echo $_G['siteroot'];?>misc.php%3fmod=swfupload%26type=image%26fid=<?php echo $fid;?>%26mtype=plugin%26twidth=60%26theight=60%26back=uploadpic%26random=<?php echo random(4); ?>",buttonimg:"<?php echo $_G['siteroot'];?>static/image/common/uploadnew.png"};
swfobject.embedSWF("static/flash/uploadforum.swf", "pic_upload_multiimg", "208", "50", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
swfobject.createCSS("#pic_upload_multiimg", "text-align:left;");
/*<?php if(($action=='edit')) { ?>
ajaxget('forum.php?ctl=<?php echo $modstr;?>&act=getimglist&type=forum<?php if($editdata['tid']) { ?>&tid=<?php echo $editdata['tid'];?><?php } if($editdata['pid']) { ?>&pid=<?php echo $editdata['pid'];?><?php } ?>', 'imglist');
<?php } ?>*/

</script>
<script type="text/javascript">
var maxpic = 1;
function uploadpic(type, returndata) {
eval("var nattach = " + returndata + ";");
jQuery.noConflict();
;(function($){
switch(type){
case 1:
case 2:
var html = '';
html 	+= '<span id="imagelist_id_'+nattach.aid+'">';
html 	+= '<img src="' + nattach.thumbpic + '" />';
html 	+= '<b class="deleteimg">删除</b>';
html 	+= '<input type="hidden" value="'+nattach.aid+'" name="imgselect[]">';
html 	+= '</span>';
                                //让图片只显示最后上传的。
$("#imglist").prepend(html);
                                //$("#imglist").append(html);
var attachobj = $('#imagelist_id_' + nattach.aid);
attachobj.find('input').removeAttr('disabled').end().show();

attachobj.find('img').one('error', function(){
$(this).attr('src', ' ');
$(this).attr('src', nattach.thumbpic);
}).show();
break;
case 3:
break;
}
$('#imglist').find('span:gt(' + (maxpic - 1) + ')').addClass("overlimit").find('input').attr('disabled', true);
//算下上传图片数
$("#numimage").attr("value", $('#imglist').find("span:not('.overlimit')").length);
})(jQuery);
}
</script><div class="layout mt30"></div><?php $this->myoutput(); ?><style>
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.h13_ewm{ height:13px;}
.ewmbox{ width:160px; position: fixed !important; top: 215px; position: absolute; z-index: 10; float:right; color:#585858; }
.close_ewm{ width:11px; height:11px; background:url(http://static.8264.com/static/images/common/ewmclose.jpg) left top no-repeat; float:right; margin-bottom:2px; display:none;}
.close_ewm:hover{  background:url(http://static.8264.com/static/images/common/ewmclose_hover.jpg) left top no-repeat;}


</style>
<div class="ewmbox" style="display:none;">
<div class="clear_b h13_ewm"><a href="javascript:void(0)" class="close_ewm"></a></div><?php echo adshow("custom_468"); ?></div>
<script type="text/javascript">

//jQuery(function(){	
//	var isiOS 	  = navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod');
//    var isAndroid = navigator.userAgent.match('Android');
//    if (!isiOS && !isAndroid) {
//    	jQuery(".ewmbox").show();    	
//    	jQuery(".ewmbox").hover(
//			function () {
//			jQuery(".close_ewm",this).show();
//		  },
//		  function () {
//			jQuery(".close_ewm",this).hide();
//		  }
//		);
//		jQuery(".close_ewm").click(function(){
//			jQuery(".ewmbox").hide();
//		});   	
//    }
//	var ww = jQuery(window).width();   
//	var r_z = (ww-980)/2 -180;
//	if(r_z<0){
//		jQuery(".ewmbox").css("left",'0px');
//	}else{
//		jQuery(".ewmbox").css("left",r_z);
//	};
//	if(ww>1350){
//		jQuery(".ewmbox").show();
//	}else{
//		jQuery(".ewmbox").hide();
//	}	
//});

</script>
</div>
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