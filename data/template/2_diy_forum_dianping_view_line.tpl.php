<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('view_line', 'forum/dianping/header');
0
|| checktplrefresh('./template/8264/forum/dianping/view_line.htm', './template/8264/forum/dianping/header.htm', 1508242837, 'diy', './data/template/2_diy_forum_dianping_view_line.tpl.php', './template/8264', 'forum/dianping/view_line')
|| checktplrefresh('./template/8264/forum/dianping/view_line.htm', './template/8264/forum/dianping/dpad.htm', 1508242837, 'diy', './data/template/2_diy_forum_dianping_view_line.tpl.php', './template/8264', 'forum/dianping/view_line')
|| checktplrefresh('./template/8264/forum/dianping/view_line.htm', './template/8264/forum/dianping/footer.htm', 1508242837, 'diy', './data/template/2_diy_forum_dianping_view_line.tpl.php', './template/8264', 'forum/dianping/view_line')
|| checktplrefresh('./template/8264/forum/dianping/view_line.htm', './template/8264/common/header_8264_new.htm', 1508242837, 'diy', './data/template/2_diy_forum_dianping_view_line.tpl.php', './template/8264', 'forum/dianping/view_line')
|| checktplrefresh('./template/8264/forum/dianping/view_line.htm', './template/8264/common/ewm_r.htm', 1508242837, 'diy', './data/template/2_diy_forum_dianping_view_line.tpl.php', './template/8264', 'forum/dianping/view_line')
|| checktplrefresh('./template/8264/forum/dianping/view_line.htm', './template/8264/common/footer_8264_new.htm', 1508242837, 'diy', './data/template/2_diy_forum_dianping_view_line.tpl.php', './template/8264', 'forum/dianping/view_line')
|| checktplrefresh('./template/8264/forum/dianping/view_line.htm', './template/8264/common/header_common.htm', 1508242837, 'diy', './data/template/2_diy_forum_dianping_view_line.tpl.php', './template/8264', 'forum/dianping/view_line')
|| checktplrefresh('./template/8264/forum/dianping/view_line.htm', './template/8264/common/index_ad_top.htm', 1508242837, 'diy', './data/template/2_diy_forum_dianping_view_line.tpl.php', './template/8264', 'forum/dianping/view_line')
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
<link rel="stylesheet" type="text/css" href="<?php echo $_G['siteurl'];?><?php echo STATICURL;?>css/dianping/xl_detail.css?<?php echo VERHASH;?>" />
<style type="text/css">
#mdly { margin: 20px 0 0 10px; padding: 0; width: 200px; height: auto; background: none!important; }
</style>
<script src="<?php echo $_G['setting']['jspath'];?>forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="static/js/formValidator-4.0.1.js" type="text/javascript"></script>
<script src="static/js/dianping/line_help.js" type="text/javascript"></script>
<script type="text/javascript">
var ie6=false;
if(/msie/.test(navigator.userAgent.toLowerCase()) && 'undefined' == typeof(document.body.style.maxHeight)){
ie6=true;
}
var initmsg = "";
var tid 	= <?php echo $viewdata['tid'];?>;
var fid 	= <?php echo $_G['fid'];?>;
</script><?php $arrStar = array("5"=>"吐血推荐","4"=>"重点推荐","3"=>"一般推荐","2"=>"最好别去","1"=>"千万别去"); ?><div id="wp">
<div class="layout mt50">
<div>
<h1 class="skiName">
<span class="tit"><a href="<?php echo $url;?>&act=showview&tid=<?php echo $viewdata['tid'];?>" title="<?php echo $viewdata['name'];?>"><?php echo $viewdata['name'];?></a></span>
<!--管理权限-->
<?php if(( $_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) )) { ?>
<div class="guanli" id="glistBox">
<a class="gl"></a>
<div class="gl_list" id="glist">
                	<ul>
<li>
<?php if(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'])) { ?>
<a href="<?php echo $url;?>&act=dopost&do=edit&tid=<?php echo $_G['tid'];?>&pid=<?php echo $viewdata['pid'];?>&page=1<?php if(!empty($_G['gp_modthreadkey'])) { ?>&modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>">编辑</a>
<?php } ?>
</li>
<li><?php if($_G['group']['allowdelpost']) { ?><a href="<?php echo $url;?>&act=deleteit&tid=<?php echo $_G['tid'];?>" onclick="return confirm('确认删除这个<?php echo $modname;?>？删除后将不可恢复！');">删除</a><?php } ?></li>
<?php if(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) || ($_G['groupid'] == 1 ||$_G['groupid']== 45))) { ?>
<li class="setpass" <?php if($viewdata['enable']==1) { ?>style="display:none;"<?php } ?>><a class="tgsh" href="javascript:;">通过审核</a></li>
<li class="setcancel" <?php if($viewdata['enable']==0) { ?>style="display:none;"<?php } ?>><a class="qxsh" href="javascript:;">取消审核</a></li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
<!--管理权限end-->
</h1>
</div>
<!--左边-->
<div class="layoutLeft">
<!--简介-->
<div class="intro mb25">
<h2 class="h2Titip">
<div class="hovertab tab"><?php echo $modname;?>简介</div>
<a href="<?php echo $url;?>&act=showview&tid=<?php echo $viewdata['tid'];?>#writecommon" class="wydp_orangelink">我要点评</a>
<div class="wydp_warpten" style="display: none;">
<div class="wydp_border">
<div class="wydp_arrow"></div>
<div class="wydp_bluebg">写点评兑换礼品</div>
<div class="wydp_info">
<ul>
<li>
<span class="num_blue">1</span>
<span class="wydp_info_con">请写下自己的真实感受，严禁抄袭</span>
<div class="clboth_0"></div>
</li>
<li>
<span class="num_blue">2</span>
<span class="wydp_info_con">点评被奖励8264币后，请到论坛兑换礼品</span>
<div class="clboth_0"></div>
</li>
</ul>
</div>
<a href="http://bbs.8264.com/forum-483-1.html" target="_blank" class="dh_bule"></a>
</div>
</div>
<div class="clboth_0"></div>
</h2>
<div class="bd tab_rel">
<?php if($cityids) { ?>
经过地域：<?php $_t_index = 0; if(is_array($cityids)) foreach($cityids as $b => $c) { if($_t_index > 0) { ?>
--
<?php } ?>
<a target="_blank" href="<?php echo $url;?>&act=showlist&order=lastpost&lType=0&lTime=0&province=<?php echo $crossregin[$c]['provinceid'];?>&city=<?php echo $crossregin[$c]['id'];?>&page=1"><?php echo $crossregin[$c]['name'];?></a><?php $_t_index++; } } ?>
<div><br></div>
<div class="info" id="info_p">
<p><?php echo $viewdata['message'];?></p>
</div>
<div class="p_more" id="slidemore" style="display:none;">查看更多</div>
</div>
<?php if($viewdata["map"]) { ?>
<div class="tab_rel" style="padding:0;">
<div class="map">
<iframe id="mapiframe" style='height:450px;width:100%;border:none;overflow: hidden;' src='<?php echo $viewdata["map"];?>'></iframe>
</div>
</div>
<?php } ?>
</div>
<!--简介end--><style>
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.dianpingad{ border:#fde1d9 solid 1px; padding:22px; background:#fffcfa; font-size:14px; line-height:1.5; font-family: "Microsoft Yahei",Tahoma,Helvetica,SimSun,sans-serif; margin-bottom:25px;}
.dianpingad .fl_ad{ float:left; width:385px;}
.dianpingad .fl_ad b{ display:block; color:#f98260; font-size:16px;}
.dianpingad .fl_ad p{ margin:0px; padding:12px 0px;}
.dianpingad .fl_ad .link_cz{ margin:0px;}
.dianpingad .fl_ad .link_cz a{ color:#43a6df; font-size:12px; float:left; text-decoration:none; margin:16px 25px 0px 0px; display:inline;}
.dianpingad .fl_ad .link_cz a:hover{  color:#43a6df; font-size:12px; text-decoration:none;}
.dianpingad .fl_ad .link_cz a.button_orange{ font-size:14px; background:#f98260; border-radius:3px; padding:5px 25px 7px 25px; color:#fff; margin-top:0px;} 
.dianpingad .fr_image{ float:right; border-left:#fde1d9 solid 1px; padding-left:22px; position:relative;}
.dianpingad .fr_image:after{ border-color: transparent transparent transparent #fffcfa; border-style:solid solid solid dashed  ; border-width: 10px;   top:50%; content: ""; left:-2px; margin-top: -10px; position: absolute;}
.dianpingad .fr_image:before{ border-color: transparent transparent transparent #fde1d9 ; border-style:solid solid solid dashed ; border-width: 10px;   top:50%; content: ""; left:0px; margin-top: -10px; position: absolute;}
</style>

<div class="dianpingad clear_b">
<div class="fl_ad">
<b>参与点评赚8264币</b>
<p>点评任意产品，均有可能获得8264币的奖励，可以用来兑换精美奖品的哦。</p>
<div class="link_cz clear_b">
<a href="javascript:void(0)" class="button_orange">去写点评</a>
<a href="http://bbs.8264.com/forum-483-1.html" target="_blank">奖品列表</a>
<a href="http://bbs.8264.com/thread-1641700-1-1.html" target="_blank">详细规则</a>
</div>
</div>
<div class="fr_image">
<img src="http://www.8264.com/static/css/dianping/images/dpad.png"/>
</div>
</div>

<script>
jQuery(function(){
jQuery(".button_orange").click(function() {
var writeCmt_dw = jQuery("#writeCmt_dw").offset().top;
jQuery(window).scrollTop( writeCmt_dw );
});
});
</script><!--我的点评-->
<div class="commentBox" id="myComment"<?php if(!$my_comment) { ?> style="display:none;"<?php } ?>>
<h2 class="h2Tit">我的点评&nbsp;&nbsp;&nbsp;<span>假如您的点评没有奖励8264币，请联系工作人员QQ1919501975询问原因</span></h2>
<dl class="cmtDl">
<dd class="avatar"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" ><?php echo avatar($_G['uid'], small); ?></a></dd>
<dd class="cmtCont">
<div class="tit">
<span class="usrName"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank"  class="usrName"><?php echo $_G['username'];?></a></span>
<span class="date">发表于 <?php echo $my_comment['dateline'];?></span>
<?php if($my_comment['rate']) { ?>
<span class="bi"><a href="http://bbs.8264.com/forum-483-1.html" target="blank"><img align="absmiddle" title="奖励8264币" alt="奖励8264币" src="static/image/common/8264b.gif"></a></span>
<?php } ?>
<input type="hidden" name="" id="starnum" value="<?php echo $my_comment['starnum'];?>" />
</div>
<ul class="goodBad">
<li <?php if(!$my_comment['ext1']) { ?> style="display:none;"<?php } ?>>
<span class="leftIco good">时间</span>
<div class="cont"><p id="goodpoint">
<?php if($my_comment['isTian']) { ?>
<?php echo $my_comment['ext1_show'];?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $my_comment['ext2_show'];?>&nbsp;&nbsp;&nbsp;&nbsp;共计<?php echo $my_comment['timeTotal'];?>
<?php } else { ?>
<?php echo $my_comment['ext1_show'];?>&nbsp;&nbsp;<?php echo $my_comment['ext4'];?>时&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $my_comment['ext5'];?>时&nbsp;&nbsp;&nbsp;&nbsp;共计<?php echo $my_comment['timeTotal'];?>
<?php } ?>
</p></div>
<input type="hidden" id="startTime" value="<?php echo $my_comment['ext1'];?>"/>
<input type="hidden" id="endTime" value="<?php echo $my_comment['ext2'];?>"/>
<input type="hidden" id="startHour" value="<?php echo $my_comment['ext4'];?>"/>
<input type="hidden" id="endHour" value="<?php echo $my_comment['ext5'];?>"/>
<input type="hidden" id="isTian" value="<?php echo $my_comment['isTian'];?>"/>
</li>
<li <?php if(!$my_comment['ext3']) { ?> style="display:none;"<?php } ?>>
<span class="leftIco price">费用</span>
<div class="cont"><p id="price"><?php echo $my_comment['ext3'];?></p></div>
</li>
<li <?php if(!$my_comment['weakpoint']) { ?> style="display:none;"<?php } ?>>
<span class="leftIco bad">注意</span>
<div class="cont"><p id="weakpoint"><?php echo $my_comment['weakpoint'];?></p></div>
</li>
<li>
<span class="leftIco all">综合</span>
<div class="cont"><p id="message"><?php echo $my_comment['message'];?></p></div>
</li>
<li>
<span class="leftIco recommend">推荐</span>
<div class="cont">
<span class="starBox"<?php if(!$my_comment['starnum']) { ?> style="display: none;"<?php } ?>><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $my_comment['starnum']) { ?>redstar<?php } else { ?>graystar<?php } ?>"></span><?php endfor; ?><i class="diff"><?php echo $arrStar[$my_comment['starnum']];?></i>
</span>
</div>
</li>
</ul>
</dd>
<dd class="bottomCont">
<!--赞-->
<span class="useful<?php if($my_comment['supports']>0) { ?> active<?php } ?>" title="你不能评价自己的点评"><i></i><?php if(!$my_comment['supports']) { ?>0<?php } else { ?><?php echo $my_comment['supports'];?><?php } ?></span>
<!--赞 end-->
<!--修改-->
<span class="ans" id="editBtn_<?php echo $my_comment['pid'];?>"><a href="javascript:;">修改</a></span>
<!--修改 end-->
<?php if($my_comment && $_G['adminid'] == 1 && !$my_comment['first']) { ?>
<span class="normal">
<!--管理-->
<label for="manage<?php echo $my_comment['pid'];?>">
<input type="checkbox" id="manage<?php echo $my_comment['pid'];?>" class="pc" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $my_comment['pid'];?>)" value="<?php echo $my_comment['pid'];?>" autocomplete="off" />
管理
</label>&nbsp;
<!--管理 end-->
<!--评分-->
<a id="k_rate" style="color: #666;" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $my_comment['pid'];?>', 'get', -1);return false;" title="加8264币">评分&nbsp;</a>
<!--评分end-->
<!--撤销评分-->
<?php if($my_comment['rate'] && $_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $my_comment['pid'];?>&amp;page=<?php echo $page;?>" onclick="showWindow('rate', this.href, 'get', -1)">撤销评分</a>
<?php } ?>
<!--撤销评分end-->
</span>
<?php } ?>
</dd>
</dl>
</div>
<!--我的点评 end-->
<!--点评列表-->
<?php if($replylist) { ?>
<div class="commentBox" id="commentsList">
                <h2 class="h2Tit"><?php echo $viewdata['subject'];?>的点评</h2><?php if(is_array($replylist)) foreach($replylist as $v) { ?><dl class="cmtDl">
<dd class="avatar"><a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" target="_blank" rel="nofollow" ><?php echo avatar($v[authorid], small); ?></a></dd>
<dd class="cmtCont">
<div class="tit">
<span class="usrName"><a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" target="_blank" rel="nofollow"  class="usrName"><?php echo $v['author'];?></a></span>
                            <span style="color:#A8A8A8;float: left">点评了<a href="forum.php?ctl=line&amp;act=showview&amp;tid=<?php echo $viewdata['tid'];?>" style="color:#A8A8A8;" title="<?php echo $viewdata['subject'];?>"><?php echo $viewdata['subject'];?></a>,</span>
<span class="date">发表于 <?php echo $v['dateline'];?></span>
<?php if($v['rate']) { ?>
<span class="bi"><a href="http://bbs.8264.com/forum-483-1.html" target="blank"><img align="absmiddle" title="奖励8264币" alt="奖励8264币" src="static/image/common/8264b.gif"></a></span>
<?php } ?>
</div>
<ul class="goodBad">
<li <?php if(!$v['ext1']) { ?> style="display:none;"<?php } ?>>
<span class="leftIco good">时间</span>
<div class="cont"><p id="goodpoint">
<?php if($v['isTian']) { ?>
<?php echo $v['ext1_show'];?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $v['ext2_show'];?>&nbsp;&nbsp;&nbsp;&nbsp;共计<?php echo $v['timeTotal'];?>
<?php } else { ?>
<?php echo $v['ext1_show'];?>&nbsp;&nbsp;<?php echo $v['ext4'];?>时&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $v['ext5'];?>时&nbsp;&nbsp;&nbsp;&nbsp;共计<?php echo $v['timeTotal'];?>
<?php } ?>
</p></div>
<input type="hidden" id="startTime" value="<?php echo $v['ext1'];?>"/>
<input type="hidden" id="endTime" value="<?php echo $v['ext2'];?>"/>
<input type="hidden" id="startHour" value="<?php echo $v['ext4'];?>"/>
<input type="hidden" id="endHour" value="<?php echo $v['ext5'];?>"/>
<input type="hidden" id="isTian" value="<?php echo $v['isTian'];?>"/>
</li>
<li class="priceli" <?php if(!$v['ext3']) { ?> style="display:none;"<?php } ?>>
<span class="leftIco price">费用</span>
<div class="cont"><p id="price"><?php echo $v['ext3'];?></p></div>
</li>
<li>
<span class="leftIco bad">明细</span>
<div class="cont">
<p id="weakpoint"><?php echo $v['weakpoint'];?></p>
</div>
</li>
<li>
<span class="leftIco all">综合</span>
<div class="cont">
<p id="message"><?php echo $v['message'];?></p>
</div>
</li>
<li>
<span class="leftIco recommend">推荐</span>
<div class="cont">
<span class="starBox"><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $v['starnum']) { ?>redstar<?php } else { ?>graystar<?php } ?>"></span><?php endfor; ?><i class="diff"><?php echo $arrStar[$v['starnum']];?></i>
</span>
<input type="hidden" name="" id="starnum" value="<?php echo $v['starnum'];?>" />
</div>
</li>
</ul>
</dd>
<dd class="bottomCont">
<!--赞-->
<span class="useful<?php if($v['supports']>0) { ?> active<?php } ?>"
<?php if($_G['uid'] && !$supportlist[$v['pid']]) { ?> id="supportBtn_<?php echo $v['pid'];?>"<?php } if(!$_G['uid']) { ?> onclick="javascript:window.location.href = '<?php echo $_G['siteurl'];?>member.php?mod=logging&action=login';return false;"<?php } if($_G['uid']) { if($supportlist[$v['pid']]) { ?>
title="你已经评价过了"
<?php } else { ?>
title="有用"
<?php } } else { ?>
title="登录后才能进行评价"
<?php } ?>><i></i>有用<em><?php if(!$v['supports']) { } else { ?>(<?php echo $v['supports'];?>)<?php } ?></em></span>
<!--赞 end-->
<!--修改-->
<?php if($_G['adminid'] == 1) { ?>
<span class="ans" id="editBtn_<?php echo $v['pid'];?>"><a href="javascript:;">修改</a></span>
<?php } ?>
<!--修改 end-->
<?php if($_G['adminid'] == 1 && !$v['first']) { ?>
<span class="normal">
<!--管理-->
<label for="manage<?php echo $v['pid'];?>">
<input type="checkbox" id="manage<?php echo $v['pid'];?>" class="pc" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $v['pid'];?>)" value="<?php echo $v['pid'];?>" autocomplete="off" />
管理
</label>&nbsp;
<!--管理 end-->
<!--评分-->
<a id="k_rate" style="color: #666;" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $v['pid'];?>', 'get', -1);return false;" title="加8264币">评分&nbsp;</a>
<!--评分end-->
<!--撤销评分-->
<?php if($v['rate'] && $_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $v['pid'];?>&amp;page=<?php echo $page;?>" onclick="showWindow('rate', this.href, 'get', -1)">撤销评分</a>
<?php } ?>
<!--撤销评分end-->
</span>
<?php } ?>
</dd>
</dl>
<?php } ?>
<!--分页-->
<div class="pageBox mb25"><?php echo $multipage;?></div>
<!--分页end-->
</div>
<?php } ?>
<!--点评列表end-->
<!--写点评-->
<div id="writecommon"></div>
<?php if(!$my_comment && $viewdata['enable']==1) { ?>
            <?php $coment_ele_arr = array(
                        'f_price_focus_des' => $modsetting[initdianping],
                        'f_price_blur_error' => '您的费用描述不够详细，请列举出行的各项费用',
                        'f_weakpoint_focus_des' => '提醒他人需要注意的关键事项，如露营点、水源地、岔路口等',
                        'f_weakpoint_blur_error' => '请详细填写 注意事项 不少于50字',
                        'f_message_focus_des' => $modsetting[initpost],
                        'f_message_blur_error' => '请填写综合信息，文字200字以上',

            ); ?><div class="writeCmt" id="writeCmt_dw">
                <h2 class="h2Tit">我要点评<?php echo $viewdata['subject'];?></h2>
                <span id="fastpostreturn" style="margin-left: 10px;"></span>
<form method="post" id="from_post" autocomplete="off" action="">
<ul class="writeGoodBad">
<li class="mb30">
<span class="leftIco good">时间</span>
<div class="cont post">
<input name="datapicker[]" readonly class="timeText datapicker startPicker" onclick="showcalendar(event, this, '', '', '', 28);" onchange="changeDate()"/> --- <input name="datapicker[]" readonly class="timeText datapicker endPicker" onclick="showcalendar(event, this, '', '', '', 28);"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input name="datapicker[]" class="timeText timeHour dataHour startHour" maxlength="2"/><span class="timeHour">时 --- </span><input name="datapicker[]" class="timeText timeHour dataHour endHour" maxlength="2"/><span class="timeHour">时</span>
                                <div id="date_error" style="padding-top:7px;"></div>
</div>
</li>
<li class="mb30">
<span class="leftIco price">费用</span>
<div class="cont">
<label class="fs14"><?php echo $coment_ele_arr['f_price_focus_des'];?></label>
<textarea name="price" id="f_price" rows="2" class="line5Area"></textarea>
                                <div id="f_priceTip"></div>
</div>
</li>
<li class="mb30">
<span class="leftIco bad">注意</span>
<div class="cont">
<label class="fs14"><?php echo $coment_ele_arr['f_weakpoint_focus_des'];?></label>
<textarea name="weakpoint" id="f_weakpoint" rows="2" class="line5Area"></textarea>
                                <div id="f_weakpointTip"></div>
</div>
</li>
<li class="mb18">
<span class="leftIco all">综合</span>
<div class="cont">
<label class="fs14"><?php echo $coment_ele_arr['f_message_focus_des'];?></label>
<textarea name="message" id="f_message" rows="6" class="line5Area "></textarea>
                                <div id="f_messageTip"></div>
</div>
</li>
<li class="mb30">
<span class="leftIco recommend">推荐</span>
<div class="cont">
<span class="starBox starBoxEdit addComment">
<span class="graystar" title="千万别去"></span>
<span class="graystar" title="最好别去"></span>
<span class="graystar" title="一般推荐"></span>
<span class="graystar" title="重点推荐"></span>
<span class="graystar" title="吐血推荐"></span>
</span>
<input type="hidden" name="starnum" id="starnum" value="0" />
                                <div id="star_error"></div>
</div>
</li>
<li class="sub">
<input <?php if(!$_G['uid']) { ?> type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')" <?php } else { ?> type="submit" id="postBtn" <?php } ?> value="" class="publish182x43" />
</li>
</ul>
</form>
                <script type="text/javascript">
                jQuery(document).ready(function($) {
                       $.formValidator.initConfig({
                           formID: "from_post",
                           debug: false,
                           submitOnce: false,
                           onError:function(msg,obj,errorlist){
                                },
                           submitAfterAjaxPrompt: '有数据正在异步验证，请稍等...'
                       });

                    //费用
                    $('#f_price')
                    .formValidator(
                            {
                            onShow: "",
                            onFocus: "<div class=information><div class=lft></div><div class=rht><?php echo $coment_ele_arr['f_price_focus_des'];?></div></div>",
                            onCorrect: "<div class=correct></div>",
                            defaultValue: ""})
                    .inputValidator(
                                {
                                min: 20,
                                onError: "<div class=wrong><div class=lft></div><div class=rht><?php echo $coment_ele_arr['f_price_blur_error'];?></div></div>"
                            });
                    //注意
                    $('#f_weakpoint')
                    .formValidator(
                            {
                            onShow: "",
                            onFocus: "<div class=information><div class=lft></div><div class=rht><?php echo $coment_ele_arr['f_weakpoint_focus_des'];?></div></div>",
                            onCorrect: "<div class=correct></div>",
                            defaultValue: ""})
                    .inputValidator(
                                {
                                min: 100,
                                onError: "<div class=wrong><div class=lft></div><div class=rht><?php echo $coment_ele_arr['f_weakpoint_blur_error'];?></div></div>"
                            });
                    //综合
                    $('#f_message')
                    .formValidator(
                            {
                            onShow: "",
                            onFocus: "<div class=information><div class=lft></div><div class=rht><?php echo $coment_ele_arr['f_message_focus_des'];?></div></div>",
                            onCorrect: "<div class=correct></div>",
                            defaultValue: ""})
                    .inputValidator(
                                {
                                min: 400,
                                onError: "<div class=wrong><div class=lft></div><div class=rht><?php echo $coment_ele_arr['f_message_blur_error'];?></div></div>"
                            });
                });
                </script>
</div>
<?php } ?>
<!--写点评end-->
</div>
<!--左边 end-->
<!--右边-->
<div class="layoutRight">
<div style="margin-bottom:30px;"><?php echo adshow("custom_268"); ?></div>
<h4 class="r_title_h4">线路评分</h4>
<!--评分-->
<div class="picShowR">
<div class="pingf">
<div class="interest_sectl" id="interest_sectl">
<div class="star_show"><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $star_data['price']/2) { if($star_data['price']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?> colorstar"></span><?php if($i < $star_data['price']/2) { if($star_data['price']/2-$i<1) { ?>&nbsp;<?php } } ?><?php endfor; ?><span class="num"><?php echo $star_data['price'];?></span>
<span class="text"></span>
</div>
<div class="peoples">(<span class="num"><?php echo $star_data['count'];?></span>人评分)</div>
<div class="star_list"><?php if(is_array($arrStar)) foreach($arrStar as $k => $v) { ?><div class="star" title="<?php echo $v;?>"><?php for ($i = 0; $i < $k; $i++): ?><span class="redstar2"></span>&nbsp;<?php endfor; ?><?php for ($i = 0; $i < 5 - $k; $i++): ?><span class="graystar2"></span>&nbsp;<?php endfor; ?><span class="percent" style="width:<?php echo $star_data['percent'.$k]*0.8 ?>px;"></span>
<span class="num"><?php echo $star_data['percent'.$k];?>%</span>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
<!--评分 end-->




<!--下载按钮-->
<?php if($viewdata["map"]) { ?>
<div class="view_line_fb mb15" style="">
<?php if($gpsShow["filetype"] == 'kml') { ?>
<a href="<?php echo $url;?>&act=downloadGps&aid=<?php echo $gpsShow['aidencode'];?>" target="_blank" class="btn_downgps"></a>
<?php } else { ?>
<a href="javascript:void(0);" class="btn_downgps btn_gps"></a>
<div class="crly">
<a href="<?php echo $url;?>&act=downloadGps&aid=<?php echo $gpsShow['aidencode'];?>" target="_blank">gpx格式</a>
<a href="<?php echo $url;?>&act=downloadGps&aid=<?php echo $gpsShow['aidencode'];?>&iskml=1" target="_blank">kml格式</a>
</div>
<div class="mncr"></div>
<script type="text/javascript">
jQuery(document).ready(function($) {
$('.btn_gps, .mncr, .crly').hover(function(){
clearTimeout(window.gpsBoxCtrl);
$(".mncr").show();$(".crly").show();
},function(){
window.gpsBoxCtrl=setTimeout(function(){$(".mncr").hide();$(".crly").hide();},300);
});
});
</script>
<?php } ?>
</div>
<?php } ?>
<!--下载按钮 end-->
<!--详细右侧list2开始-->
<?php if($listheats) { ?>
<div class="r_list">
<h4 class="r_title_h4">热门线路</h4>
<ul><?php if(is_array($listheats)) foreach($listheats as $v) { ?><li>
<p>
<a href="<?php echo $url;?>&act=showview&tid=<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank" class="t_c_s"><?php echo $v['subject'];?></a>
<span class="star_s"><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $v['score']/2) { if($v['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; if($v['score']!='0.0') { ?><b style="color:#F98361;"><?php echo $v['score'];?></b><?php } else { ?><b style="color:#a8a8a8;">0.0</b><?php } ?>
</span>
</p>
</li>
<?php } ?>
</ul>
</div>
<?php } ?>
<!--详细右侧list2结束-->
<!--详细右侧list1开始-->
<?php if($listprovince) { ?>
<div class="r_list mb15">
<h4 class="r_title_h4">同地区<?php echo $modname;?></h4>
<ul id="tdqli"><?php if(is_array($listprovince)) foreach($listprovince as $v) { ?><li style="display:none;">
<p>
<a href="<?php echo $url;?>&act=showview&tid=<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank" class="t_c_s"><?php echo $v['subject'];?></a>
<span class="star_s"><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $v['score']/2) { if($v['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; if($v['score']!='0.0') { ?><b style="color:#F98361;"><?php echo $v['score'];?></b><?php } else { ?><b style="color:#a8a8a8;">0.0</b><?php } ?>
</span>
</p>
</li>
<?php } ?>
</ul>
<div class="addmore">加载更多</div>
</div>
<?php } ?>
<!--详细右侧list1结束-->
</div>
<!--右边end-->
</div>
</div>

<!--点评修改框-->
<div class="popBox" id="box_view">
<div class="bd">
<div class="popWriteCmt">
<h2><span class="tit">修改点评</span>	</h2>
<div style="color: red; display: none;" id="bv_error"></div>
<form method="post" autocomplete="off" id="postform">
<ul class="writeGoodBad">
<li class="mb30">
<span class="leftIco good">时间</span>
<div class="cont">
<input name="datapicker[]" readonly class="timeText datapicker startPicker"  onclick="showcalendar(event, this, '', '', '', 28);"/> ---
                        <input name="datapicker[]" readonly class="timeText datapicker endPicker"  onclick="showcalendar(event, this, '', '', '', 28);"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input name="datapicker[]" class="timeText timeHour dataHour" maxlength="2"/>
                        <span class="timeHour">时 --- </span>
                        <input name="datapicker[]" class="timeText timeHour dataHour" maxlength="2"/>
                        <span class="timeHour">时</span>
</div>
</li>
<li class="mb30">
<span class="leftIco price">费用</span>
<div class="cont"><textarea name="price" id="price" rows="2" class="line5Area"></textarea></div>
                    <div id="priceTip"> </div>
</li>
<li class="mb30">
<span class="leftIco bad">注意</span>
<div class="cont"><textarea name="weakpoint" id="weakpoint" rows="2" class="line5Area"></textarea></div>
</li>
<li class="mb18">
<span class="leftIco all">综合</span>
<div class="cont"><textarea name="message" id="message" rows="6" class="line5Area "></textarea></div>
</li>
<li class="mb18">
<span class="leftIco recommend">推荐</span>
<div class="cont">
<span class="starBox starBoxEdit">
<span class="graystar" title="千万别去"></span>
<span class="graystar" title="最好别去"></span>
<span class="graystar" title="一般推荐"></span>
<span class="graystar" title="重点推荐"></span>
<span class="graystar" title="吐血推荐"></span>
</span>
<span class="starTextTips"></span>
<input type="hidden" name="" id="starnum" value="0" />
</div>
</li>

<li class="sub"><input type="button" value="" id="boxSubmit" class="modifi182x43"></li>
</ul>
<input type="hidden" name="pid" id="pid" value="0" />
</form>
</div>
<span class="closeBtn" id="bv_closeBtn">关闭</span>
</div>
</div>
<!--点评修改框end-->
<!--管理框-->
<form method="post" autocomplete="off" name="modactions" id="modactions">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="optgroup" />
<input type="hidden" name="operation" />
<input type="hidden" name="listextra" value="<?php echo $_G['gp_extra'];?>" />
</form>
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
<?php if($_G['forum']['ismoderator']) { if($_G['group']['allowdelpost']) { ?><a href="javascript:;" onclick="modaction('delpost', '', '', 'forum.php?ctl=<?php echo $modstr;?>&act=moderator')">删除</a><span class="pipe">|</span><?php } if($_G['group']['allowstickreply']) { ?><a href="javascript:;" onclick="modaction('stickreply', '', '', 'forum.php?ctl=<?php echo $modstr;?>&act=moderator')">置顶</a><?php } } if($_G['forum_thread']['pushedaid'] && $allowpostarticle) { ?><a href="javascript:;" onclick="modaction('pushplus', '', 'aid=<?php echo $_G['forum_thread']['pushedaid'];?>', 'portal.php?mod=portalcp&ac=article&op=pushplus')">文章连载</a><span class="pipe">|</span><?php } ?>
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
<!--管理框end-->

<div class="share_bd_warpten">
<ul class="bbs_share_sc">
<li class="ps_re" id="share">
<a href="javascript:;" class="share"></a>
<div class="bdsharebuttonbox share_bd" data-tag="share_1">
<a href="javascript:;" class="sina" data-cmd="tsina"></a>
<a href="javascript:;" class="qq" data-cmd="qzone"></a>
<a href="javascript:;" class="wb" data-cmd="tqq"></a>
<a href="javascript:;" class="wx" data-cmd="weixin"></a>
</div>
</li>
<li><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" id="m_k_favorite" onclick="showWindow(<?php if($_G['uid']) { ?>this.id, this.href, 'get', 0<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>);" class="sc"><b style="display: none;" id="favoritenumber"></b></a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>" class="bbsli" title="返回线路首页"></a></li>
<li id="gotop_50"><a style="display: none;" href="javascript:;" class="gotop_50"></a></li>
</ul>
</div>
<script>
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
})(jQuery);
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {



//查看更多简介
getMoreMessage();

//ajax分页
$("#commentsList").on('click',".pg>a",function(e){
e.preventDefault();
var tempArr = this.href.split('-');
$.get('<?php echo $url;?>',{act:'ajaxreply',tid:parseInt(tempArr[1]),page:parseInt(tempArr[2])},function(data){
$("#commentsList>.h2Tit").nextAll().remove();
data && $("#commentsList>.h2Tit").after(data);
});
$("#commentsList>.h2Tit").after('<div style="padding: 0 0 10px 6px;"><img src="<?php echo $_G['siteurl'];?><?php echo STATICURL;?>image/common/loading.gif" style="vertical-align: top;"> 数据读取中...</div>');
$("#commentsList dl").remove();
$(document).scrollTop($('#commentsList').offset().top-60);
});

//我要点评
$('.wydp_orangelink').click(function() {
$('.wydp_warpten').hide();
window.location.href = '/forum.php?ctl=<?php echo $modstr;?>&act=showview&tid=<?php echo $viewdata['tid'];?>#writecommon';
});

$('.wydp_orangelink, .wydp_warpten').hover(function(){
clearTimeout(window.wydpCtrl);
$(".wydp_warpten").show();
},function(){
window.wydpCtrl=setTimeout(function(){$(".wydp_warpten").hide();},300);
});

//点评提交-新
$('#f_price').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$('#f_weakpoint').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$('#f_message').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$(".starBoxEdit>span").click(function(){
var topParent = $(this).parent().parent();
$(this).removeClass("graystar").addClass("redstar");
$(this).prevAll().removeClass("graystar").addClass("redstar");
$(this).nextAll().removeClass("redstar").addClass("graystar");
topParent.find(".starTextTips").html($(this).attr('title'));
topParent.find("#starnum").val($(this).index()+1);
if($(this).parent().hasClass('addComment')) {
    $('#star_error').html('');
}
});
//选择小时
$(".dataHour").change(function(){
if (!$(this).hasClass("startHour") && !$(this).hasClass("endHour")) {
return false;
}

var obj  = $(this).parent();
if (obj.attr("class").indexOf("post") == -1) {
return false;
}
var hour = $(this).val();
hour	 = getFormatHour(hour);
$(this).val(hour);
if ($(this).hasClass("startHour")) {
var startHour = hour;
var endHour   = obj.find(".endHour").val();
endHour	 	  = getFormatHour(endHour);
var sign  	  = "开始";
if(!startHour && startHour!=0){
show_errors("date_error", "请填写<?php echo $modname;?>的开始时间");
return false;
} else {
jQuery('#date_error').html('');
}
} else {
var startHour = obj.find(".startHour").val();
startHour	  = getFormatHour(startHour);
var endHour   = hour;
var sign  	  = "结束";
if(!endHour){
show_errors("date_error", "请填写<?php echo $modname;?>的结束时间");
return false;
}else {
    jQuery('#date_error').html('');
}
}

var date 	      = new Date();
var curTime    	  = Math.floor(date.getTime()/1000);
var startTime 	  = obj.find(".startPicker").val();
var intStartTime  = getNumberTime(startTime);
var tempJiange    = curTime - intStartTime;
//当天才需要判断
if (tempJiange < 86400) {
var curHour = date.getHours();
if (hour > curHour) {
$(this).val("");
show_errors("date_error", "<?php echo $modname;?>的"+sign+"时间需小于当前时间");
return false;
}
}else {
    jQuery('#date_error').html('');
}

if ((startHour || startHour==0) && endHour && startHour >= endHour) {
$(this).val("");
show_errors("date_error", "<?php echo $modname;?>的结束时间需大于开始时间");
return false;
}else {
    endHour > startHour ? jQuery('#date_error').html('<div class="correct"></div>') : '';
}

});
$("#from_post").submit(function(){
var starnum   = $("#from_post").find("#starnum").val();
var startTime = $("#from_post input[name='datapicker[]']").eq(0).val();
var endTime   = $("#from_post input[name='datapicker[]']").eq(1).val();
var starHour  = $("#from_post input[name='datapicker[]']").eq(2).val();
var endHour   = $("#from_post input[name='datapicker[]']").eq(3).val();
var weakpoint = $("#f_weakpoint").val();
var message   = $("#f_message").val();
var price 	  = $("#f_price").val();

//关闭时间选择框
closecalendar();

//把时间转为时间戳
var intStartTime 	= getNumberTime(startTime);
var intEndTime 		= getNumberTime(endTime);
var intStartHour	= getFormatHour(starHour);
var intEndHour		= getFormatHour(endHour);

if(!checkText(intStartTime, intEndTime, intStartHour, intEndHour, weakpoint, message, price, 'show_errors') || !parseInt(starnum)){
if(!parseInt(starnum))  show_errors('star_error', '请点击星星图标进行点评');
focus_on_date($('#from_post'), intStartTime, intEndTime, intStartHour, intEndHour);
return false;
}

showDialog('', 'info', '<img src="' + IMGDIR + '/loading.gif"> 请稍候...');
$('#from_post').parent('.writeCmt').hide();

$.post('forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=reply&tid=<?php echo $_G['tid'];?>&inajax=1',
{starnum:starnum,ext1:startTime,ext2:endTime,ext4:starHour,ext5:endHour,weakpoint:weakpoint,message:message,price:price,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes'},function(data){
hideMenu('fwin_dialog', 'dialog');
if(data.msg=='ok'){
$('#myComment, #myComment li, #myComment .starBox').show();
$('#myComment .bottomCont>.ans').hide();
$('#myComment #starnum').val(starnum);
var starHtml = '';
for(var i=0;i<5;i++){
if(i<starnum){
starHtml += '<span class="redstar"></span>';
} else {
starHtml += '<span class="graystar"></span>';
}
}
$('#myComment .starBox').html(starHtml);

startTime 	   = startTime.substr(0,10);
endTime   	   = endTime.substr(0,10);
$('#myComment #startTime').val(startTime);
$('#myComment #endTime').val(endTime);
$('#myComment #startHour').val(intStartHour);
$('#myComment #endHour').val(intEndHour);

var tempJiange = intEndTime - intStartTime;
var tempTime   = "";
if (tempJiange >= 86400) {
tempTime += Math.ceil(tempJiange/86400)+"天";
$('#myComment #isTian').val("1");
$('#myComment #goodpoint').html(startTime+"&nbsp;&nbsp;-&nbsp;&nbsp;"+endTime+"&nbsp;&nbsp;&nbsp;&nbsp;共计"+tempTime);
} else {
tempTime += (intEndHour - intStartHour)+"小时";
$('#myComment #isTian').val("0");
$('#myComment #goodpoint').html(startTime+"&nbsp;&nbsp;"+intStartHour+"时&nbsp;&nbsp;-&nbsp;&nbsp;"+intEndHour+"时&nbsp;&nbsp;&nbsp;&nbsp;共计"+tempTime);
}

$('#myComment #price').html(price.replace(/(\r\n)|(\n)/gi,"<br/>"));
$('#myComment #weakpoint').html(weakpoint.replace(/(\r\n)|(\n)/gi,"<br/>"));
$('#myComment #message').html(message.replace(/(\r\n)|(\n)/gi,"<br/>"));

var d=new Date();
$('#myComment .date').html('发表于 '+d.getFullYear()+'-'+(parseInt(d.getMonth())+1)+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes());
$('#from_post').parent('.writeCmt').remove();

$('#myComment').find(".ans").attr("id","editBtn_"+data.pid).show();

_showmsg('点评成功');
} else if($($(data).find('root'))) {
$('#from_post').parent('.writeCmt').show();
_showmsg($(data).children('root').text().replace(/<script.*>.*<\/script>/i, ''));
} else {
$('#from_post').parent('.writeCmt').show();
_showmsg('发生错误请重试！');
}
},"json");
return false;
});
//点评提交-修改
$(document).on('click',"span[id^=editBtn_]",function(){
//小分辨率修改按钮样式
var nH = $(window).height();
var aH = $("#box_view").height();
if (aH >= nH) {
$("#box_view .popWriteCmt").css({
"overflow-y": 'scroll',
"overflow-x": 'hidden',
"height": (nH-145)+"px"
});
}else if(aH < nH) {
$("#box_view .popWriteCmt").removeAttr("style");
}

$('#bv_error').html('').hide();
var p = $(this).parents('dl');
$("#box_view #pid").val(this.id.replace('editBtn_',''));
var star = p.find('#starnum').val() || 1;
var starDom = $("#box_view .starBox>span").eq(star-1);
starDom.removeClass("graystar").addClass("redstar");
starDom.prevAll().removeClass("graystar").addClass("redstar");
starDom.nextAll().removeClass("redstar").addClass("graystar");
$("#box_view .starTextTips").html(starDom.attr('title'));
$("#box_view #starnum").val(star);
$("#box_view input[name='datapicker[]']").eq(0).val(p.find('#startTime').val());
$("#box_view input[name='datapicker[]']").eq(1).val(p.find('#endTime').val());
$("#box_view input[name='datapicker[]']").eq(2).val(p.find('#startHour').val());
$("#box_view input[name='datapicker[]']").eq(3).val(p.find('#endHour').val());
if (p.find('#isTian').val() == 0) {
$("#box_view .timeHour").show();
}else {
$("#box_view .timeHour").hide();
}

$("#box_view #price").val(p.find('#price').html().replace(/<br[^>]*>/gi,"\r\n"));
$("#box_view #weakpoint").val(p.find('#weakpoint').html().replace(/<br[^>]*>/gi,"\r\n"));
$("#box_view #message").val(p.find('#message').html().replace(/<br[^>]*>/gi,"\r\n"));
$("#div_black, #box_view").fadeIn(200);
});

$("#boxSubmit").click(function(){
$('#bv_error').html('').hide();
var weakpoint = $("#box_view #weakpoint").val();
var message   = $("#box_view #message").val();
var starnum   = $("#box_view #starnum").val();
var pid 	  = $("#box_view #pid").val();
var price 	  = $("#box_view #price").val();
var startTime = $("#box_view input[name='datapicker[]']").eq(0).val();
var endTime   = $("#box_view input[name='datapicker[]']").eq(1).val();
var starHour  = $("#box_view input[name='datapicker[]']").eq(2).val();
var endHour   = $("#box_view input[name='datapicker[]']").eq(3).val();

//把时间转为时间戳
var intStartTime 	= getNumberTime(startTime);
var intEndTime 		= getNumberTime(endTime);
var intStartHour	= getFormatHour(starHour);
var intEndHour		= getFormatHour(endHour);

//关闭时间选择框
closecalendar();

if(!checkText(intStartTime, intEndTime, intStartHour, intEndHour, weakpoint, message, price, 'bv_error')){
return false;
}

$("#div_black, #box_view").fadeOut(200);
showDialog('', 'info', '<img src="' + IMGDIR + '/loading.gif"> 请稍候...');

$.post('forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=reply&ext=edit&tid=<?php echo $_G['tid'];?>&inajax=1',
{pid:pid,starnum:starnum,ext1:startTime,ext2:endTime,ext4:starHour,ext5:endHour,weakpoint:weakpoint,message:message,price:price,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes'},function(data){
hideMenu('fwin_dialog', 'dialog');
$("#div_black").fadeIn(200);
if(data.msg=='ok'){
var comment = $("#editBtn_"+pid).parents('dl');
comment.find('#starnum').val(starnum);
var starHtml = '';
for(var i=0;i<5;i++){
if(i<starnum){
starHtml += '<span class="redstar"></span>';
} else {
starHtml += '<span class="graystar"></span>';
}
}
comment.find(".starBox").html("").html(starHtml);

startTime 	   = startTime.substr(0,10);
endTime   	   = endTime.substr(0,10);

comment.find('#startTime').val(startTime);
comment.find('#endTime').val(endTime);
comment.find('#startHour').val(intStartHour);
comment.find('#endHour').val(intEndHour);

var tempJiange = intEndTime - intStartTime;
var tempTime   = "";
if (tempJiange >= 86400) {
tempTime += Math.ceil(tempJiange/86400)+"天";
comment.find('#isTian').val("1");
comment.find('#goodpoint').html(startTime+"&nbsp;&nbsp;-&nbsp;&nbsp;"+endTime+"&nbsp;&nbsp;&nbsp;&nbsp;共计"+tempTime);
} else {
tempTime += (intEndHour - intStartHour)+"小时";
comment.find('#isTian').val("0");
comment.find('#goodpoint').html(startTime+"&nbsp;&nbsp;"+intStartHour+"时&nbsp;&nbsp;-&nbsp;&nbsp;"+intEndHour+"时&nbsp;&nbsp;&nbsp;&nbsp;共计"+tempTime);
}

comment.find('#price').html(price.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('#weakpoint').html(weakpoint.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('#message').html(message.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('li').show();
_showmsg('修改成功');
} else if($($(data).find('root'))) {
_showmsg($(data).children('root').text().replace(/<script.*>.*<\/script>/i, ''));
} else {
_showmsg('发生错误请重试！');
}
},"json");
});

$("#bv_closeBtn").click(function(){
$("#div_black, #box_view").fadeOut(200);
});

//管理员操作
<?php if(( $_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) )) { ?>
$('#glistBox').hover(function(){
$('#glist').show();
},function(){
$('#glist').hide();
});
<?php } if(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) || ($_G['groupid'] == 1 ||$_G['groupid']== 45))) { ?>
//取消审核操作
$('.guanli .setcancel').click(function(){
jQuery.ajax({
type: 'get',
url: 'forum.php?ctl=<?php echo $modstr;?>&act=checkit&type=0&tid='+tid,
success: function(html) {
if(checkreturn(html)){
jQuery('.guanli .setcancel').hide();
jQuery('.guanli .setpass').show();
jQuery('.skiName .tit').append('(未审核)');
}
}});
return false;
});
//审核通过操作
$('.guanli .setpass').click(function(){
jQuery.ajax({
type: 'get',
url: 'forum.php?ctl=<?php echo $modstr;?>&act=checkit&type=1&tid='+tid,
success: function(html) {
if(checkreturn(html)){
jQuery('.guanli .setcancel').show();
jQuery('.guanli .setpass').hide();
jQuery('.skiName .tit').text(jQuery('.skiName .tit').text().replace('(未审核)',''));
}
}});
return false;
});
var checkreturn = function (status) {
var msg 	= '操作失败！';
var success = false;
var mode 	= "right";
switch(status){
case '1':
msg='操作成功！';success=true;break;
case '-1':
msg='您没有权限操作！';var mode = "alert";break;
}
showDialog(msg, mode);return success;
}
<?php } ?>

//赞
$(document).on('click', "span[id^=supportBtn_]", function(){
var sid = this.id;
var pid = sid.replace('supportBtn_','');
var s_c = $(this).find('em').text() ? parseInt($(this).find('em').text().replace(/[^0-9]/ig, "")) : 0;
if(s_c == 0) $(this).addClass('active');
$(this).find('em').text('('+parseInt(s_c+1)+')');
$(this).attr('id', '');
$.get('forum.php?ctl=<?php echo $modstr;?>&act=support',{tid:'<?php echo $_G['tid'];?>',pid:pid},function(data){});
});

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
$(".tishi").hover(function(event){
$(this).find('[class$=_ts]').show();
},
function(event){
$(this).find('[class$=_ts]').hide();
});
});

function bv_error(msg){
jQuery('#bv_error').html(msg).show();
}

//表单验证前的检验
function checkText(startTime,endTime,startHour,endHour,weak,msg,price,fun){
weak 		= jQuery.trim(weak);
price 		= jQuery.trim(price);
msg  		= jQuery.trim(msg);
if(!fun){
fun = '_showmsg'
}

var date 	      = new Date();
var curTime    	  = Math.floor(date.getTime()/1000);

if(!startTime){
    fun == 'show_errors' ?  eval(fun+'("date_error", "请选择<?php echo $modname;?>的开始时间")') : eval(fun+'("请选择<?php echo $modname;?>的开始时间")');
return false
}
if (startTime > curTime) {
fun == 'show_errors' ?  eval(fun+'("date_error", "<?php echo $modname;?>的开始时间需小于当前时间")') : eval(fun+'("<?php echo $modname;?>的开始时间需小于当前时间")');
return false;
}
if(!endTime){
    fun == 'show_errors' ?  eval(fun+'("date_error", "请选择<?php echo $modname;?>的结束时间")') : eval(fun+'("请选择<?php echo $modname;?>的结束时间")');
return false;
}
if (endTime > curTime) {
    fun == 'show_errors' ?  eval(fun+'("date_error", "<?php echo $modname;?>的结束时间需小于当前时间")') : eval(fun+'("<?php echo $modname;?>的结束时间需小于当前时间")');
return false;
}
if(startTime > endTime){
    fun == 'show_errors' ?  eval(fun+'("date_error", "<?php echo $modname;?>的结束时间需大于开始时间")') : eval(fun+'("<?php echo $modname;?>的结束时间需大于开始时间")');
return false;
}

if(startTime == endTime){
var curHour 	= date.getHours();
var tempJiange  = curTime - startTime;
if(!startHour && startHour!=0){
fun == 'show_errors' ?  eval(fun+'("date_error", "请填写<?php echo $modname;?>的开始时间")') : eval(fun+'("请填写<?php echo $modname;?>的开始时间")');
return false;
}
//当天才需要判断
if (tempJiange < 86400) {
if (startHour > curHour) {
                fun == 'show_errors' ?  eval(fun+'("date_error", "<?php echo $modname;?>的开始时间需小于当前时间")') : eval(fun+'(<?php echo $modname;?>的开始时间需小于当前时间")');
return false;
}
}
if(!endHour){
            fun == 'show_errors' ? eval(fun+'("date_error", "请填写<?php echo $modname;?>的结束时间")') : eval(fun+'("请填写<?php echo $modname;?>的结束时间")');
return false;
}
//当天才需要判断
if (tempJiange < 86400) {
if (endHour > curHour) {
                fun == 'show_errors' ?  eval(fun+'("date_error", "<?php echo $modname;?>的结束时间需小于当前时间")') : eval(fun+'("<?php echo $modname;?>的结束时间需小于当前时间")');
return false;
}
}
if (startHour >= endHour) {
            fun == 'show_errors' ?  eval(fun+'("date_error", "<?php echo $modname;?>的结束时间需大于开始时间")') : eval(fun+'("<?php echo $modname;?>的结束时间需大于开始时间")');
return false;
}
}
if(!price){
eval(fun+'("请填写<?php echo $modname;?>的费用")');
return false;
}
if(!weak){
eval(fun+'("请填写<?php echo $modname;?>的注意事项")');
return false;
}
if(weak.length<10){
eval(fun+'("请认真填写<?php echo $modname;?>的注意事项，不能少于10个字符")');
return false;
}
if(!msg){
eval(fun+'("请填写对<?php echo $modname;?>的综合评价")');
return false;
}
<?php if($myrate!=1 && $viewdata['enable']==1) { ?>
if(initmsg && msg == initmsg){
eval(fun+'("请填写对<?php echo $modname;?>的综合评价")');
return false;
}
<?php } ?>
//	if(msg.length<200){
//		eval(fun+'("请认真填写对<?php echo $modname;?>的综合评价，不能少于200个字符")');
//		return false;
//	}
return true;
}

//查看更多简介
function getMoreMessage(){
var p_height = jQuery("#info_p").height();
if (jQuery("#slidemore").css("display") != "none") {
return false;
}
if(p_height > 160){
jQuery("#info_p").height(160);
jQuery("#slidemore").click(function() {
if (jQuery("#info_p").height() > 160) {
jQuery("#info_p").animate({
height: 160
}, 300);
jQuery("#slidemore").text("查看更多").removeClass("p_more_1");
} else {
jQuery("#info_p").animate({
height: p_height
}, 300);
jQuery("#slidemore").text("收起").addClass("p_more_1");
}
});
jQuery("#slidemore").show();
} else {
jQuery("#slidemore").hide();
}
}

//使小时数在0-24
function getFormatHour(hour){
hour = parseInt(hour, 10);
hour = isNaN(hour) ? 0 : hour;
hour = hour < 0 ? 0 : hour;
hour = hour > 24 ? 24 : hour;
return hour;
}

</script>
<script type="text/javascript">
function calendarCallback(obj){
var parentObj  = obj.parentNode;
var childNodes = parentObj.childNodes;
//	var datapicker = parentObj.getElementsByClassName("timeText");
//	var timeHour   = parentObj.getElementsByClassName("timeHour");
var isStart    = obj.className.indexOf("startPicker") != -1 ? true : false;
var datapicker = new Array();
var timeHour   = new Array();
var dIndex = 0;
var tIndex = 0;
for(var i = 0; i < childNodes.length; i++){
var temp = childNodes[i].className;
if (temp) {
if(temp.indexOf("timeText") != -1){
datapicker[dIndex] = childNodes[i];
dIndex++;
}
if(temp.indexOf("timeHour") != -1){
timeHour[tIndex] = childNodes[i];
tIndex++;
}
}
}

var startTime  = datapicker[0].value;
var endTime	   = datapicker[1].value;

datapicker[2].value = "";
datapicker[3].value = "";

var date 	      = new Date();
var curTime    	  = Math.floor(date.getTime()/1000);
var selectTime 	  = obj.value;
var intSelectTime = getNumberTime(selectTime);
if (intSelectTime > curTime && parentObj.className.indexOf("post") != -1 ) {
obj.value = "";
var sign  = isStart ? "开始" : "结束";
show_errors("date_error", "<?php echo $modname;?>的"+sign+"时间需小于当前时间");
var tttt = setInterval(function(){
var div_black = document.getElementById("div_black");
if (div_black.style.display == "none") {
clearInterval(tttt);
obj.click();
}
},200);
return false;
}else{
if(parentObj.className.indexOf("post") != -1) {
    jQuery('#date_error').html('');
}
}

if (startTime) {
if(isStart){
datapicker[1].click();
}
}
if (!startTime || !endTime) {
return false;
}
//把时间转为时间戳
var intStartTime 	= getNumberTime(startTime);
var intEndTime 		= getNumberTime(endTime);

if (intStartTime == intEndTime) {
for(var i = 0; i < timeHour.length; i++){
timeHour[i].style.display = "inline";
}
} else {
for(var i = 0; i < timeHour.length; i++){
timeHour[i].style.display = "none";
}
}

if (intStartTime > intEndTime && parentObj.className.indexOf("post") != -1) {
obj.value = "";
show_errors("date_error", "<?php echo $modname;?>的结束时间需大于开始时间");
var tttt = setInterval(function(){
var div_black = document.getElementById("div_black");
if (div_black.style.display == "none") {
clearInterval(tttt);
obj.click();
}
},200);
return false;
}
    else{
        if( parentObj.className.indexOf("post") != -1) {
           intStartTime == intEndTime ? jQuery('#date_error').html('') : jQuery('#date_error').html('<div class="correct"></div>');
        }
    }
}
</script>
<script type="text/javascript">
jQuery(function(){
jQuery("#tdqli li:lt(5)").show();
var no_i = 1;
var shu_no = jQuery("#tdqli li").size();
var sl_ddd = 0 ;
jQuery(".addmore").click(function(){
if( sl_ddd < shu_no){
no_i++;
sl_ddd = no_i*5;
jQuery("#tdqli li:lt("+sl_ddd+")").show();

}else{
jQuery(".addmore").text("别点了，已经都显示了");
}
});

jQuery(".r_list li:last-child").addClass("without");



});
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