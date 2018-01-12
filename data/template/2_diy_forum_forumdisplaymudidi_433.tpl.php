<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplaymudidi_433', 'common/header_8264_new');
0
|| checktplrefresh('./template/default/forum/forumdisplaymudidi_433.htm', './template/8264/common/header_8264_new.htm', 1508287639, 'diy', './data/template/2_diy_forum_forumdisplaymudidi_433.tpl.php', 'data/diy', 'forum/forumdisplaymudidi_433')
|| checktplrefresh('./template/default/forum/forumdisplaymudidi_433.htm', './template/default/forum/recommend.htm', 1508287639, 'diy', './data/template/2_diy_forum_forumdisplaymudidi_433.tpl.php', 'data/diy', 'forum/forumdisplaymudidi_433')
|| checktplrefresh('./template/default/forum/forumdisplaymudidi_433.htm', './template/default/forum/mudidi_guide.htm', 1508287639, 'diy', './data/template/2_diy_forum_forumdisplaymudidi_433.tpl.php', 'data/diy', 'forum/forumdisplaymudidi_433')
|| checktplrefresh('./template/default/forum/forumdisplaymudidi_433.htm', './template/default/forum/mudidi_footer.htm', 1508287639, 'diy', './data/template/2_diy_forum_forumdisplaymudidi_433.tpl.php', 'data/diy', 'forum/forumdisplaymudidi_433')
|| checktplrefresh('./template/default/forum/forumdisplaymudidi_433.htm', './template/8264/common/footer_8264_new.htm', 1508287639, 'diy', './data/template/2_diy_forum_forumdisplaymudidi_433.tpl.php', 'data/diy', 'forum/forumdisplaymudidi_433')
|| checktplrefresh('./template/default/forum/forumdisplaymudidi_433.htm', './template/8264/common/header_common.htm', 1508287639, 'diy', './data/template/2_diy_forum_forumdisplaymudidi_433.tpl.php', 'data/diy', 'forum/forumdisplaymudidi_433')
|| checktplrefresh('./template/default/forum/forumdisplaymudidi_433.htm', './template/8264/common/index_ad_top.htm', 1508287639, 'diy', './data/template/2_diy_forum_forumdisplaymudidi_433.tpl.php', 'data/diy', 'forum/forumdisplaymudidi_433')
;
block_get('2833');?>
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
<!-- //手机绑定提示 --><?php require_once DISCUZ_ROOT.'./source/function/function_post.php'; ?><link rel="stylesheet" href="/source/plugin/whither/css/main.css?v=1" />
<script src="http://www.8264.com/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
</script>
<?php if($_G['forum']['ismoderator']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>

<style id="diy_style" type="text/css">#framepykg9F {  border:#000000 none !important;margin-top:0px !important;margin-right:0px !important;margin-bottom:10px !important;margin-left:0px !important;}#blockD7I5zV {  margin:0px !important;border:none !important;}#blockD7I5zV .content {  margin:0px !important;}#portal_block_2833 {  margin:0px !important;}#portal_block_2833 .content {  margin:0px !important;}</style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"><div id="framepykg9F" class=" frame move-span cl frame-1"><div id="framepykg9F_left" class="column frame-1-c"><div id="framepykg9F_left_temp" class="move-span temp"></div><?php block_display('2833'); ?></div></div></div><!--[/diy]-->
</div>
<div id="ct" class="wp cl<?php if($_G['forum']['allowside']) { ?> ct2<?php } ?>">
<div class="mn">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_top'])) echo $_G['setting']['pluginhooks']['forumdisplay_top']; if($subexists && $_G['page'] == 1) { include template('forum/forumdisplay_subforum'); } ?>

<div class="drag">
<!--[diy=diy4]--><div id="diy4" class="area"></div><!--[/diy]-->
</div>

<?php if(!empty($_G['forum']['recommendlist'])) { ?>
<div class="bm bmw">
<div class="bm_h cl">
<h2>推荐主题</h2>
</div>
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
<div class="bm_h cl">
<h2>推荐<?php echo $_G['setting']['navs']['3']['navname'];?></h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($recommendgroups)) foreach($recommendgroups as $key => $group) { ?><li>
<a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" title="<?php echo $group['name'];?>" target="_blank" class="avt"><img src="<?php echo $group['icon'];?>" alt="<?php echo $group['name'];?>"></a>
<p><a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" target="_blank"><?php echo $group['name'];?></a></p>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($threadmodcount) { ?><div class="bm bmn hm xi2"><strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me&amp;type=thread&amp;from=&amp;filter=aduit">你有 <?php echo $threadmodcount;?> 个主题正等待审核中，点击查看</a></strong></div><?php } ?>


<div class="mudidi_index">
<div class="mudidi_index_section">
<div class="sidebar" style="position:relative;z-index:2">
<div class="mudidi_info_nav">
<h2 class="mudidi_info_title">出行目的地</h2>
<dl class="mudidi_info_list">

<dt><a href="#" onclick="return false;">国内出行</a></dt>
<dd>
<div class="mudidi_info_dropdown_index">
<ul class="dropdown_list">
<li>
<h6>都市</h6>
<p>
<a href="/thread-892114-1-1.html">北京</a>
<a href="/thread-892139-1-1.html">天津</a>
<a href="/thread-892137-1-1.html">上海</a>
<a href="/thread-892144-1-1.html">重庆</a>
<a href="/thread-892147-1-1.html">台湾</a>
<a href="/thread-892145-1-1.html">香港</a>
<a href="/thread-892146-1-1.html">澳门</a>
</p>
</li><?php $navChinaRegionTids = array(
'四川' => '892138',
'西藏' => '892140',
'新疆' => 892141,
'云南' => '892142',
'浙江' => '892143',
'安徽' => '892113',
'内蒙古' => '892131',
'宁夏' => 892132,
'福建' => '892115',
'甘肃' => 892116,
'黑龙江' => '892123',
'辽宁' => 892130,
'湖北' => 892125,
'湖南' => '892126',
'吉林' => 892127,
'江苏' => '892128',
'江西' => '892129',
'青海' => '892133',
'山东' => '892134',
'山西' => 892135,
'陕西' => 892136,
'广东' => '892117',
'广西' => '892118',
'贵州' => '892119',
'河北' => 892121,
'河南' => 892122,
'海南' => '892120',
); if(is_array($navChinaRegionTids)) foreach($navChinaRegionTids as $regionName => $tid) { ?><?php $navChinaRegionData = $forumoption_mudidi->getSubScapeareaByTid($tid, 15); ?><li>
<h6><a href="/thread-<?php echo $tid;?>-1-1.html"><?php echo $regionName;?></a></h6>
<p><?php if(is_array($navChinaRegionData)) foreach($navChinaRegionData as $region) { ?><a href="/thread-<?php echo $region['tid'];?>-1-1.html"><?php echo $region['name'];?></a>
<?php } ?>
</p>
</li>
<?php } ?>
</ul>
</div>
</dd>
<dt><a href="#" onclick="return false;">国外出行</a></dt>
<dd>
<div class="mudidi_info_dropdown_index">
<ul class="dropdown_list"><?php $navWorldRegionTids = array(
'亚洲' => '892106',
'欧洲' => '892108',
'非洲' => '892109',
'大洋洲' => '892110',
'南美洲' => '892111',
'北美洲' => '892112',
); if(is_array($navWorldRegionTids)) foreach($navWorldRegionTids as $regionName => $tid) { ?><?php $navWorldRegionData = $forumoption_mudidi->getSubRegionByTid($tid, 15); ?><li>
<h6><a href="/thread-<?php echo $tid;?>-1-1.html"><?php echo $regionName;?></a></h6>
<p><?php if(is_array($navWorldRegionData)) foreach($navWorldRegionData as $region) { ?><a href="/thread-<?php echo $region['tid'];?>-1-1.html"><?php echo $region['name'];?></a>
<?php } ?>
</p>
</li>
<?php } ?>
</ul>
</div>
</dd>
<dt><a href="/forum-ski.html">滑雪场</a></dt>
<dt><a href="/forum-392-1.html">山峰查询系统</a></dt>
</dl>
</div>
<script type="text/javascript">
jQuery('.mudidi_info_nav dt').mouseover(function(){
if (!jQuery(this).next().is('dd')) return;
jQuery(this).children('a').addClass('with_dropdown');
jQuery(this).next('dd').show();
}).mouseout(function(){
if (!jQuery(this).next().is('dd')) return;
jQuery(this).children('a').removeClass('with_dropdown');
jQuery(this).next('dd').hide();
});

jQuery('.mudidi_info_nav dd').mouseover(function(){
jQuery(this).prev('dt').children('a').addClass('with_dropdown');
jQuery(this).show();
}).mouseout(function(){
jQuery(this).prev('dt').children('a').removeClass('with_dropdown');
jQuery(this).hide();
})
</script>
<div class="index-sidebar-ad"><?php echo adshow("custom_77"); ?></div>
<div class="mudidi_button2">
<h4 class="item2">
<a href="http://bx.8264.com/?from=mudidi_index" target="_blank">户外保险</a>
</h4>
<h4 class="item3">
<a href="http://bbs.8264.com/forum-440-1.html" target="_blank">旅舍预定</a>
</h4>
</div>

<div id="pt">
<?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
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
<td style="display:none;"><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">搜索</a></td>
<td><input style="width:177px;" type="text" name="srchtxt" id="srchtxt" class="px z" value="请输入搜索内容" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">搜索</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?>
</div>
<div class="index-sidebar-ad"><?php echo adshow("custom_58"); ?></div>
<div class="index-sidebar-ad"><?php echo adshow("custom_49"); ?></div>
<div class="index-sidebar-ad"><?php echo adshow("custom_123"); ?></div><?php $commercectivityData = $forumoption_mudidi->getCommercectivityData(10); if($commercectivityData) { ?>
<div class="sidebar_box">
<div class="sidebar_box_title">
<a href="http://bbs.8264.com/forum-5-1.html" class="more">更多</a>
<h5>商业活动</h5>
</div>
<div class="sidebar_box_content">
<ul class="list2"><?php if(is_array($commercectivityData)) foreach($commercectivityData as $activityeid => $activity) { ?><li>
<div class="image">
<a href="/thread-<?php echo $activity['tid'];?>-1-1.html"><?php echo avatar($activity['authorid'], 'small'); ?></a>
</div>
<div class="text">
<h6><a href="/thread-<?php echo $activity['tid'];?>-1-1.html"><?php echo $activity['subject'];?></a></h6>
<p class="color_gray">
<span style="float:right;">
<a href="/thread-<?php echo $activity['tid'];?>-1-1.html" title="查看"><?php echo $activity['views'];?></a>/<a href="/thread-<?php echo $activity['tid'];?>-1-1.html" title="回复"><?php echo $activity['replies'];?></a>
</span>
<a href="http://u.8264.com/home-space-uid-<?php echo $activity['authorid'];?>-do-profile.html">
<?php echo $activity['author'];?>
</a>
</p>
</div>
</li>
<?php } ?>
</script>
</ul>
</div>
</div>
<?php } ?>

<div class="mudidi_button">
<h4 class="item1">
<a href="/forum-52-1.html" target="_blank">游记攻略</a>
</h4>
<h4 class="item2">
<a href="/forum-187-1.html" target="_blank">路线大全</a>
</h4>
<h4 class="item3">
<a href="/forum-39-1.html" target="_blank">户外摄影</a>
</h4>
<h4 class="item4">
<a href="/forum-56-1.html" target="_blank">我秀我户外</a>
</h4>
</div>

</div>

<div class="section_right" style="width:692px;">
<div class="" style="margin-bottom:10px;">
                            <div id="map">
                                <object width="692" height="351" data="/source/plugin/whither/images/newmap.swf" type="application/x-shockwave-flash">
                    	<param value="/source/plugin/whither/images/newmap.swf" name="movie">
                        <param value="transparent" name="wmode">
                        </object>
                            </div>
</div>
<div style="margin-bottom:10px;overflow:hidden;width:692px;"><?php echo adshow("custom_83"); ?></div>
<div style="margin-bottom:10px;overflow:hidden;width:692px;"><?php echo adshow("custom_97"); ?></div><?php $guideData = $forumoption_mudidi->getLastedGuide(8); ?><?php $guide_title = '最新攻略列表'; ?><?php $pub_guide_link = 'http://bbs.8264.com/forum-post-action-newthread-fid-52.html?mtid=892106'; ?><div class="bm vw pl guide_list">
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
</div><?php $activityData = $forumoption_mudidi->getLastedActivity('a.applynumber DESC', 6); if($activityData) { ?>
<div class="bm vw pl" id="comment" style="width:690px;">
<table class="ralateActivety">
<thead>
<tr>
<th class="tl" width="55%">最新活动&nbsp;|&nbsp;<a href="http://bbs.8264.com/forum-5-1.html" target="_blank"><font color="#0000FF">更多</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://bbs.8264.com/home-space-do-activity-view-all-order-hot-date-default-class.html?from=mudidi" target="_blank"><font color="#0000FF">发布新活动</font></a></th>
<th class="tl" width="20%">发起者</th>
<th width="15%">回复/查看</th>
<th width="10%">报名</th>
</tr>
</thead>
<tbody>
  <?php if(is_array($activityData)) foreach($activityData as $activity) { ?><tr>
<td class="tl">
<span class="dot"></span>
<a href="/thread-<?php echo $activity['tid'];?>-1-1.html" class="ralateActivetyTitle" target="_blank" title="<?php echo $activity['subject'];?>"><?php echo $activity['subject'];?></a>
</td>
<td class="tl">
<div class="userFace"><?php echo avatar($activity['authorid'], 'small'); ?><?php echo $activity['author'];?>
</div>
</td>
<td><?php echo $activity['replies'];?>/<?php echo $activity['views'];?></td>
<td><a href="/thread-<?php echo $activity['tid'];?>-1-1.html" class="hlink" target="_blank">报名</a></td>
</tr>
  <?php } ?>
</tbody>
</table>
</div>
<?php } ?>
</div>
<div class="clear"></div>
</div>                <div class="clear"></div><?php $tem_prefix = $dxCache->prefix; ?><?php $dxCache->prefix = 'mudidi_'; if($dxCache->beginCache('footer')) { ?>
<div class="mudidi_scapenav"><?php $mudidiHotScape = ForumOptionMudidi::getHotScape(45); ?><h3 class="scape_title">热门旅行景点：</h3>
<ul class="scape_list"><?php if(is_array($mudidiHotScape)) foreach($mudidiHotScape as $mudidi) { ?><li><a href="/thread-<?php echo $mudidi['tid'];?>-1-1.html"><?php echo $mudidi['subject'];?></a></li>
<?php } ?>
</ul><?php $mudidiNav = ForumOptionMudidi::getRegionInMudidiNav(); ?><h3 class="scape_title">目的地导航：</h3>
<ul class="scape_list"><?php if(is_array($mudidiNav)) foreach($mudidiNav as $mudidi) { ?><li><a href="/thread-<?php echo $mudidi['tid'];?>-1-1.html"><?php echo $mudidi['name'];?></a></li>
<?php } ?>
</ul>
</div><?php $dxCache->endCache(); } ?><?php $dxCache->prefix = $tem_prefix; ?></div>

<?php } ?>
<!--[diy=diyfastposttop]--><div id="diyfastposttop" class="area"></div><!--[/diy]-->

<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_bottom'])) echo $_G['setting']['pluginhooks']['forumdisplay_bottom']; ?>
<!--[diy=diyforumdisplaybottom]--><div id="diyforumdisplaybottom" class="area"></div><!--[/diy]-->
</div>

<?php if($_G['forum']['allowside']) { ?>
<div class="sd">
<?php if(!$subforumonly) { ?>
<div class="bm">
<div class="bm_h">
<h2>所属分类: <?php echo cutstr($_G['cache']['forums'][$_G['forum']['fup']]['name'], 22, '') ?></h2>
</div>
<div class="bm_c">
<ul class="xl xl2 cl"><?php if(is_array($_G['cache']['forums'])) foreach($_G['cache']['forums'] as $bforum) { if($bforum['fup'] == $_G['forum']['fup'] && $bforum['status']) { ?>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $bforum['fid'];?>"><?php echo $bforum['name'];?></a></li>
<?php } } ?>
</ul>
</div>
</div>

<?php if($recommendgroups) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>推荐<?php echo $_G['setting']['navs']['3']['navname'];?></h2>
</div>
<div class="bm_c cl">
<ul class="ml mls cl"><?php if(is_array($recommendgroups)) foreach($recommendgroups as $key => $group) { ?><li>
<a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" title="<?php echo $group['name'];?>" target="_blank" class="avt"><img src="<?php echo $group['icon'];?>" alt="<?php echo $group['name'];?>"></a>
<p><a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" target="_blank"><?php echo $group['name'];?></a></p>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if(!($_G['forum']['simple'] & 1) && $_G['setting']['whosonlinestatus']) { ?>
<div class="bm">
<?php if($detailstatus) { ?>
<div class="bm_h cl">
<span class="o y"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;page=<?php echo $page;?>&amp;showoldetails=no#online"><img src="<?php echo IMGDIR;?>/collapsed_no.gif" alt="" /></a></span>
<h2>正在浏览此版块的会员 (<?php echo $onlinenum;?>)</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($whosonline)) foreach($whosonline as $key => $online) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $online['uid'];?>" class="avt"><?php echo avatar($online[uid],small); ?></a>
<?php if($online['uid']) { ?>
<p><a href="home.php?mod=space&amp;uid=<?php echo $online['uid'];?>"><?php echo $online['username'];?></a></p>
<?php } else { ?>
<p><?php echo $online['username'];?></p>
<?php } ?>
<span><?php echo $online['lastactivity'];?><?php echo "\n";?></span>
</li>
<?php } ?>
</ul>
</div>
<?php } else { ?>
<div class="bm_h cl">
<span class="o y"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;page=<?php echo $page;?>&amp;showoldetails=yes#online" class="nobdr"><img src="<?php echo IMGDIR;?>/collapsed_yes.gif" alt="" /></a></span>
<h2>正在浏览此版块的会员 (<?php echo $onlinenum;?>)</h2>
</div>
<?php } ?>
</div>
<?php } } ?>
<div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_side_bottom'])) echo $_G['setting']['pluginhooks']['forumdisplay_side_bottom']; ?>
</div>
<?php } ?>
</div>
<?php if($_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
<ul class="p_pop" id="newspecial_menu" style="display: none">
<?php if(!$_G['forum']['allowspecialonly']) { ?><li><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>">发表帖子</a></li><?php } if($_G['group']['allowpostpoll']) { ?><li class="poll"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">发起投票</a></li><?php } if($_G['group']['allowpostreward']) { ?><li class="reward"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">发布悬赏</a></li><?php } if($_G['group']['allowpostdebate']) { ?><li class="debate"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">发起辩论</a></li><?php } if($_G['group']['allowpostactivity']) { ?><li class="activity"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=4">发起活动</a></li><?php } if($_G['group']['allowposttrade']) { ?><li class="trade"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=2">出售商品</a></li><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<li class="popupmenu_option"<?php if($_G['setting']['threadplugins'][$tpid]['icon']) { ?> style="background-image:url(<?php echo $_G['setting']['threadplugins'][$tpid]['icon'];?>)"<?php } ?>><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a></li>
<?php } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<li class="popupmenu_option"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $extra;?>&amp;sortid=<?php echo $id;?>"><?php echo $threadsorts;?></a></li>
<?php } } } ?>
</ul>
<?php } if($_G['setting']['visitedforums'] || $oldthreads) { ?>
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
<?php } if($_G['setting']['threadmaxpages'] > 1 && $page && !$subforumonly) { ?>
<script type="text/javascript">document.onkeyup = function(e){keyPageScroll(e, <?php if($page > 1) { ?>1<?php } else { ?>0<?php } ?>, <?php if($page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']) { ?>1<?php } else { ?>0<?php } ?>, 'forum.php?mod=forumdisplay&fid=<?php echo $_G['fid'];?>&filter=<?php echo $filter;?>&orderby=<?php echo $_G['gp_orderby'];?><?php echo $forumdisplayadd['page'];?>&<?php echo $multipage_archive;?>', <?php echo $page;?>);}</script>
<?php } ?>

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