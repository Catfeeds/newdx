<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplay_fid_489', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/forum/forumdisplay_fid_489.htm', './template/8264/common/header_8264_new.htm', 1497488766, 'diy', './data/template/2_diy_forum_forumdisplay_fid_489.tpl.php', 'data/diy', 'forum/forumdisplay_fid_489')
|| checktplrefresh('./template/8264/forum/forumdisplay_fid_489.htm', './template/8264/common/footer_forum_8264_new.htm', 1497488766, 'diy', './data/template/2_diy_forum_forumdisplay_fid_489.tpl.php', 'data/diy', 'forum/forumdisplay_fid_489')
|| checktplrefresh('./template/8264/forum/forumdisplay_fid_489.htm', './template/8264/common/header_common.htm', 1497488766, 'diy', './data/template/2_diy_forum_forumdisplay_fid_489.tpl.php', 'data/diy', 'forum/forumdisplay_fid_489')
|| checktplrefresh('./template/8264/forum/forumdisplay_fid_489.htm', './template/8264/common/index_ad_top.htm', 1497488766, 'diy', './data/template/2_diy_forum_forumdisplay_fid_489.tpl.php', 'data/diy', 'forum/forumdisplay_fid_489')
|| checktplrefresh('./template/8264/forum/forumdisplay_fid_489.htm', './template/8264/common/footer_8264_new.htm', 1497488766, 'diy', './data/template/2_diy_forum_forumdisplay_fid_489.tpl.php', 'data/diy', 'forum/forumdisplay_fid_489')
|| checktplrefresh('./template/8264/forum/forumdisplay_fid_489.htm', './template/8264/common/taobao_ad_alert.htm', 1497488766, 'diy', './data/template/2_diy_forum_forumdisplay_fid_489.tpl.php', 'data/diy', 'forum/forumdisplay_fid_489')
;
block_get('6984,6985,6986,6987,6988,6998,6989,6905');?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
    <meta name="apple-itunes-app" content="app-id=492167976">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
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
<a href="<?php echo $_G['config']['web']['portal'];?>wenda/?from=bbstop"  class="last">问答</a>
</dd>
</dl>
</li>
                <li class="wan" style="width:82px;" id="schoolpoplink"><a href="http://www.8264.com/xuexiao/?from=indexnavtop" class="topLink topLink_w_bg wkuan" target="_blank">户外学校</a><div class="navschoolpop"><img src="http://static.8264.com/static/image/common/xuexiaopop.png"></div></li>
                <li class="wan"><a href="http://hd.8264.com/?from=bbstop" class="topLink topLink_w_bg wkuan" target="_blank">活动</a></li>
<li class="wan" style=" width:67px;"><a href="http://pianyi.8264.com/goods/list-jiu-cid-10002.html" class="topLink topLink_w_bg wkuan" target="_blank">值得买</a></li>
<li class="wan"><a href="http://bx.8264.com/?bbsbxnew" class="topLink topLink_w_bg wkuan" target="_blank">保险</a></li>
<li class="shop8264nav">
<a href="https://shop440022528.taobao.com/" class="topLink" target="_blank">8264商城</a>
<dl>
                        <dd>
<a href="https://8264.tmall.com/" class="first" target="_blank">8264天猫</a>
</dd>
                        <dd>
<a href="https://shop440022528.taobao.com/" target="_blank">8264淘宝</a>
</dd>
                         <dd>
<a href="https://mall.jd.com/index-650855.html" class="last"  target="_blank">8264京东</a>
</dd>
</dl>
</li>
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
<style id="diy_style" type="text/css">#frameSXz7Yb {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6984 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6984 .content {  margin:0px !important;}#framehS4VMy {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6985 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6985 .content {  margin:0px !important;}#frameFTM9jw {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6986 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6986 .content {  margin:0px !important;}#framem5YY3z {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6987 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6987 .content {  margin:0px !important;}#frameFKkZ97 {  margin:0px !important;border:none !important;}#portal_block_6988 {  margin:0px !important;border:none !important;}#portal_block_6988 .content {  margin:0px !important;}#framef497s5 {  margin:0px !important;border:none !important;}#portal_block_6989 {  margin:0px !important;border:none !important;}#portal_block_6989 .content {  margin:0px !important;}#frame1p88nc {  margin:0px !important;border:none !important;}#portal_block_6998 {  margin:0px !important;border:none !important;}#portal_block_6998 .content {  margin:0px !important;}</style>
<link href="http://static.8264.com/static/css/forum/forum_forumdisplay.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/forum/forumdisplay_489.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<script src="http://static.8264.com/static/js/common/forumdisplay.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/forum_489.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php if($_G['forum']['ismoderator']) { ?><script src="http://static.8264.com/static/js/forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php } ?>
<div class="layout w980 mt20">
<div class="branner">
<div class="id487p_a">
<span class="jrdate"><?php echo $_G['forum']['todayposts'];?><br>今日</span>
<span class="ztdate"><?php echo $_G['forum']['posts'];?><br>总贴</span>
</div>
</div>
<div class="layout mt20" id="threadlist" style="position: relative;">
<div class=" f_l w660">
<div class="clear_b">
<div class="lunbocon">
<!--[diy=gorelb]--><div id="gorelb" class="area"><div id="frameSXz7Yb" class=" frame move-span cl frame-1"><div id="frameSXz7Yb_left" class="column frame-1-c"><div id="frameSXz7Yb_left_temp" class="move-span temp"></div><?php block_display('6984'); ?></div></div></div><!--[/diy]-->
</div>
<div class="geerinfo">
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;户外先锋营是由戈尔公司、8264及巅峰户外运动学校三方联合组织，旨在通过品牌的力量和广大户外精英的积极推动，帮助户外爱好者提高自我户外技术及户外知识，并通过集体的努力让中国的户外运动文化得到更好的传递和分享。</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;户外先锋是指具备一定户外经验的户外爱好者，只要你热爱户外且渴望提升户外知识与技能即可申请加入户外先锋营。 <a href="http://bbs.8264.com/thread-1917397-1-1.html" target="_blank">详情</a></p>
<div class="clear_b cz_buttoncon">
<?php if($xianfeng_vip) { if($level_is_upgrade) { ?>
<a href="home.php?mod=medal" target="_blank" class="sj_b153_43">去升级</a>
<?php } else { ?>
<a class="sj_g153_43">已加入</a>
<?php } } else { ?>
<a href="http://bbs.8264.com/thread-5194634-1-1.html" target="_blank" class="sq153_43" rel="nofollow">申请加入</a>
<?php } ?>
<a href="http://bbs.8264.com/thread-2426934-1-1.html" class="gz153_43" target="_blank">活动规则</a>
</div>
</div>
</div>
<!--版块列表begin-->
<form method="post" autocomplete="off" name="moderate" id="moderate" action="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?><?php if($_G['gp_typeid']) { ?>&amp;typeid=<?php echo $_G['gp_typeid'];?><?php } ?>&amp;infloat=yes&amp;nopost=yes">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="listextra" value="<?php echo $extra;?>" /><?php if(is_array($forum_threadlist)) foreach($forum_threadlist as $typeid => $forum) { ?><div class="bbscon_geer mt20">
<div class="bbscon_geer_title clear_b">
<span class="title16_1a2b38_b"><?php echo $forum['typename'];?></span>
<?php if($_G['forum']['threadtypes']['childtypes'][$typeid]) { ?>
<!-- <?php echo $forum['typename'];?>子分类 --><?php if(is_array($_G['forum']['threadtypes']['childtypes'][$typeid])) foreach($_G['forum']['threadtypes']['childtypes'][$typeid] as $id => $name) { ?><a href="<?php echo $_G['forum']['threadtypes']['url'][$id];?>" target="_blank" class="zlei"><?php echo $name;?></a>
<?php } } ?>
<div class="bbsfb_geer">
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>" class="fxtbutton_93_28">发新帖</a>
<em class="forum_post_out89">
<em class="forum_post_out w89">
<?php if(!$_G['forum']['allowspecialonly']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>">发表帖子</a><?php } if($_G['group']['allowpostpoll']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">发起投票</a><?php } if($_G['group']['allowpostreward']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">发布悬赏</a><?php } if($_G['group']['allowpostdebate']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">发起辩论</a><?php } if($_G['group']['allowpostactivity']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=4">发起活动</a><?php } if($_G['group']['allowposttrade']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=2">出售商品</a><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a>
<?php } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $extra;?>&amp;sortid=<?php echo $id;?>"><?php echo $threadsorts;?></a>
<?php } } } ?>
</em>
</em>
</div>
</div>
<?php if($typeid == 1550) { ?>
<!--[diy=goreimg1]--><div id="goreimg1" class="area"><div id="framehS4VMy" class=" frame move-span cl frame-1"><div id="framehS4VMy_left" class="column frame-1-c"><div id="framehS4VMy_left_temp" class="move-span temp"></div><?php block_display('6985'); ?></div></div></div><!--[/diy]-->
<?php } elseif($typeid == 1551) { ?>
<!--[diy=goreimg2]--><div id="goreimg2" class="area"><div id="frameFTM9jw" class=" frame move-span cl frame-1"><div id="frameFTM9jw_left" class="column frame-1-c"><div id="frameFTM9jw_left_temp" class="move-span temp"></div><?php block_display('6986'); ?></div></div></div><!--[/diy]-->
<?php } elseif($typeid == 1552) { ?>
<!--[diy=goreimg3]--><div id="goreimg3" class="area"><div id="framem5YY3z" class=" frame move-span cl frame-1"><div id="framem5YY3z_left" class="column frame-1-c"><div id="framem5YY3z_left_temp" class="move-span temp"></div><?php block_display('6987'); ?></div></div></div><!--[/diy]-->
<?php } elseif($typeid == 1553) { ?>
<!--[diy=goreimg4]--><div id="goreimg4" class="area"><div id="frameFKkZ97" class=" frame move-span cl frame-1"><div id="frameFKkZ97_left" class="column frame-1-c"><div id="frameFKkZ97_left_temp" class="move-span temp"></div><?php block_display('6988'); ?></div></div></div><!--[/diy]-->
<?php } elseif($typeid == 1590) { ?>
<!--[diy=goreimg6]--><div id="goreimg6" class="area"><div id="frame1p88nc" class=" frame move-span cl frame-1"><div id="frame1p88nc_left" class="column frame-1-c"><div id="frame1p88nc_left_temp" class="move-span temp"></div><?php block_display('6998'); ?></div></div></div><!--[/diy]-->
<?php } elseif($typeid == 1554) { ?>
<!--[diy=goreimg5]--><div id="goreimg5" class="area"><div id="framef497s5" class=" frame move-span cl frame-1"><div id="framef497s5_left" class="column frame-1-c"><div id="framef497s5_left_temp" class="move-span temp"></div><?php block_display('6989'); ?></div></div></div><!--[/diy]-->
<?php } ?>
<div class="bbslistcongeer mt20">
<ul><?php if(is_array($forum['thread'])) foreach($forum['thread'] as $k => $v) { ?><li<?php if($k==0) { ?> class="withoutbt"<?php } ?>>
<div class="upline clear_b">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $v['icontid'];?>&amp;<?php if($_G['gp_archiveid']) { ?>archiveid=<?php echo $_G['gp_archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>" title="<?php if(in_array($v['displayorder'], array(1, 2, 3, 4,'p'))) { if($v['displayorder'] == 1) { ?>本版置顶主题 - <?php } elseif($v['displayorder'] == 2) { ?>分类置顶主题 - <?php } elseif($v['displayorder'] == 3) { ?>全局置顶主题 - <?php } elseif($v['displayorder'] == 4) { ?>多版置顶主题 - <?php } elseif($v['displayorder'] == 'p') { ?>地区置顶主题 - <?php } } ?>新窗口打开" target="_blank" class="icon17_17">
<?php if($v['folder'] == 'lock') { ?>
<img src="http://static.8264.com/static/image/common/folder_lock.gif" />
<?php } elseif($v['special'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/pollsmall.gif" alt="投票" />
<?php } elseif($v['special'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/tradesmall.gif" alt="商品" />
<?php } elseif($v['special'] == 3) { ?>
<img src="http://static.8264.com/static/image/common/rewardsmall.gif" alt="悬赏" />
<?php } elseif($v['special'] == 4) { ?>
<img src="http://static.8264.com/static/image/common/activitysmall.gif" alt="活动" />
<?php } elseif($v['special'] == 5) { ?>
<img src="http://static.8264.com/static/image/common/debatesmall.gif" alt="辩论" />
<?php } elseif(in_array($v['displayorder'], array(1, 2, 3, 4,'p'))) { ?>
<img src="http://static.8264.com/static/image/common/pin_<?php echo $v['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$v['displayorder']];?>" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/folder_<?php echo $v['folder'];?>.gif" />
<?php } ?>
</a>
<?php if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']==1) { ?>
<span class="czcheckbox">
<?php if($v['fid'] == $_G['fid']) { if($v['displayorder'] <= 3 || $v['displayorder']=='p' || $_G['adminid'] == 1) { ?>
<input onclick="tmodclick(this)" type="checkbox" name="moderate[]" value="<?php echo $v['tid'];?>" />
<?php } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } ?>
</span>
<?php } ?>
<a href="<?php echo $_G['forum']['threadtypes']['url'][$v['typeid']];?>" target="_blank" class="zfenlei">[<?php if($_G['forum']['threadtypes']['types'][$v['typeid']]) { ?><?php echo $_G['forum']['threadtypes']['types'][$v['typeid']];?><?php } else { ?><?php echo $_G['forum']['threadtypes']['childtypes'][$_G['forum']['threadtypes']['fatherid'][$v['typeid']]][$v['typeid']];?><?php } ?>]</a><a href="forum.php?mod=viewthread&amp;tid=<?php echo $v['tid'];?>&amp;<?php if($_G['gp_archiveid']) { ?>archiveid=<?php echo $_G['gp_archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>"<?php echo $v['highlight'];?> target="_blank" class="title14"><?php echo $v['subject'];?></a>
<?php if($v['multipage']) { ?><span class="tps"><?php echo $v['multipage'];?></span><?php } if($v['readperm']) { ?> [阅读权限 <span class="bold"><?php echo $v['readperm'];?></span>]<?php } if($v['price'] > 0) { if($v['special'] == '3') { ?>
<span style="color: #C60">
悬赏<?php echo $v['price'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?>
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
</span>
<?php } else { ?>
[售价 <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>
<span class="bold"><?php echo $v['price'];?></span>
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>]
<?php } } elseif($v['special'] == '3' && $v['price'] < 0) { ?>
<span style="color: #C60">[已解决]</span>
<?php } if($v['attachment'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/th_img.jpg" title="图片附件" style="display: none;" />
<?php } elseif($v['attachment'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/th_fj.jpg" title="附件" style="display: none;" />
<?php } if($v['stamp']==0 && $v['rate']>0) { ?><img src="http://static.8264.com/static/image/common/th_b.jpg" title="奖励8264币" /><?php } if($v['weeknew']) { ?><a href="forum.php?mod=redirect&amp;tid=<?php echo $thread['tid'];?>&amp;goto=lastpost#lastpost" class="newicon" style="display: none;" target="_blank">NEW</a><?php } ?>
</div>
<div class="downline clear_b">
<em>作者：<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" target="_blank"><?php echo $v['author'];?></a></em>
<em>发表于：<a <?php echo $v['color'];?>><?php echo $v['dateline'];?></a></em>
<em>最后回复：<?php if($v['lastposter']) { ?><a href="home.php?mod=space&amp;username=<?php echo $v['lastposterenc'];?>" target="_blank"><?php echo $v['lastposter'];?></a><?php } else { ?>匿名<?php } ?> <a href="forum.php?mod=redirect&amp;tid=<?php echo $v['tid'];?>&amp;goto=lastpost#lastpost" class="dateend" target="_blank"><?php echo $v['lastpost'];?></a></em>
<em class="review"><?php echo $v['views'];?></em>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $v['tid'];?>&amp;extra=<?php echo $extra;?>" class="hfs" target="_blank"><?php echo $v['replies'];?></a>
</div>
</li>
<?php } ?>
<div id="threadmore_<?php echo $typeid;?>">
<a href="javascript:void(0);" onclick="ajaxget('forum.php?mod=ajax&action=loadthreadlist&fid=<?php echo $_G['fid'];?>&typeid=<?php echo $typeid;?>&page=2', 'threadmore_<?php echo $typeid;?>');" class="addmore">点击加载更多</a>
</div>
</ul>
</div>
</div>
<?php } if($_G['forum']['ismoderator'] && $_G['forum_threadcount']) { include template('forum/topicadmin_modlayer'); } ?>
</form>
<!--版块列表end-->
</div>
<div class=" f_r w260" id="f_r_h">
<div id="f_r_p">
<?php if($_G['uid'] && $xianfeng_vip && $_G['member']['extcredits6'] >= 20) { ?>
<div class="rwtop clear_b">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" class="txgeer"><?php echo avatar($_G[uid], 'middle'); ?></a>
<p>
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="name141a2b38"><?php echo $_G['username'];?></a>
<span>已活跃 <i><?php echo $_G['member']['activedate'];?></i> 天</span>
<span>先锋币 <i class="orange"><?php echo $_G['member']['extcredits6'];?></i> 枚</span>
<img src="http://static.8264.com/static/image/common/<?php echo $xianfeng_medal['image'];?>"/>
</p>
</div>
<?php } ?>
<div class="geerlogo mt20 clear_b">
<a href="http://www.gore-tex.com.cn/" target="_blank"><img src="http://static.8264.com/static/images/xianfengying/logo1.jpg"/></a>
<a href="http://www.8264.com/" target="_blank"><img src="http://static.8264.com/static/images/xianfengying/logo2.jpg"/></a>
<a href="http://www.summitedu.org/" target="_blank" class="f_r mr0"><img src="http://static.8264.com/static/images/xianfengying/logo3.jpg"/></a>
</div>
<div class="mt20">
<div class="bbscon_geer_title clear_b">
<span class="title16_1a2b38">特邀导师</span>
</div>
<div class="tx84 clear_b mt20">
<ul>
<li><img src="http://static.8264.com/static/images/xianfengying/ds-1.jpg" /><span>王鑫</span><a href="http://bbs.8264.com/thread-2163469-1-1.html" title="王鑫" target="_blank"><img src="http://static.8264.com/static/images/xianfengying/yziconsmall.png"/></a></li>
<li><img src="http://static.8264.com/static/images/xianfengying/ds-2.jpg" /><span>孙灵野</span><a href="http://bbs.8264.com/thread-2163469-1-1.html#pid49326279" title="孙灵野" target="_blank"><img src="http://static.8264.com/static/images/xianfengying/yziconsmall.png"/></a></li>
<li><img src="http://static.8264.com/static/images/xianfengying/ds-3.jpg" /><span>孙斌</span><a href="http://bbs.8264.com/thread-2163469-1-1.html#pid49326228" title="孙斌" target="_blank"><img src="http://static.8264.com/static/images/xianfengying/yziconsmall.png"/></a></li>
<li><img src="http://static.8264.com/static/images/xianfengying/ds-4.jpg" /><span>十一郎</span><a href="http://bbs.8264.com/thread-2163469-1-1.html#pid49326321" title="十一郎" target="_blank"><img src="http://static.8264.com/static/images/xianfengying/yziconsmall.png"/></a></li>
<li><img src="http://static.8264.com/static/images/xianfengying/ds-5.jpg" /><span>赵嘉</span><a href="http://bbs.8264.com/thread-2163469-1-1.html#pid49326379" title="赵嘉" target="_blank"><img src="http://static.8264.com/static/images/xianfengying/yziconsmall.png"/></a></li>
<li><img src="http://static.8264.com/static/images/xianfengying/ds-6.jpg" /><span>蔡石</span><a href="http://bbs.8264.com/thread-2163469-1-1.html#pid49326424" title="蔡石" target="_blank"><img src="http://static.8264.com/static/images/xianfengying/yziconsmall.png"/></a></li>
</ul>
</div>
</div>
<div class="mt20">
<div class="bbscon_geer_title clear_b">
<span class="title16_1a2b38">先锋导师</span>
</div>
<div class="tx48 clear_b mt20">
<ul>
<li><a href="home.php?mod=space&amp;uid=16833910" title="绝情坑坑主" target="_blank"><?php echo avatar(16833910, 'middle'); ?></a></li>
<li><a href="home.php?mod=space&amp;uid=106876" title="野战军" target="_blank"><?php echo avatar(106876, 'middle'); ?></a></li>
<li><a href="home.php?mod=space&amp;uid=127363" title="老尹" target="_blank"><?php echo avatar(127363, 'middle'); ?></a></li>
<li><a href="home.php?mod=space&amp;uid=126956" title="老橡皮" target="_blank"><?php echo avatar(126956, 'middle'); ?></a></li>
<li><a href="home.php?mod=space&amp;uid=38999202" title="王七叔叔" target="_blank"><?php echo avatar(38999202, 'middle'); ?></a></li>
<li><a href="home.php?mod=space&amp;uid=95958" title="断肠草" target="_blank"><?php echo avatar(95958, 'middle'); ?></a></li>
<li><a href="home.php?mod=space&amp;uid=16768067" title="heibao_07" target="_blank"><?php echo avatar(16768067, 'middle'); ?></a></li>
<li><a href="home.php?mod=space&amp;uid=33756332" title="古袅袅" target="_blank"><?php echo avatar(33756332, 'middle'); ?></a></li>
                        <li><a href="home.php?mod=space&amp;uid=35898890" title="黑里透着辉" target="_blank"><?php echo avatar(35898890, 'middle'); ?></a></li>
                        <li><a href="home.php?mod=space&amp;uid=33775843" title="柴达木人" target="_blank"><?php echo avatar(33775843, 'middle'); ?></a></li>
                        <li><a href="home.php?mod=space&amp;uid=40067960" title="phip" target="_blank"><?php echo avatar(40067960, 'middle'); ?></a></li>
</ul>
</div>
</div>
<div class="mt20">
<div class="bbscon_geer_title clear_b">
<span class="title16_1a2b38">最新活动</span>
</div>
<div class="h170img mt20">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread_active['0']['tid'];?>" target="_blank"><img src="<?php echo $attachpath;?>"></a>
<span><?php echo cutstr($thread_active['0']['subject'],36); ?></span>
</div>
<div class="list_news_25 clear_b mt20">
<ul><?php if(is_array($thread_active)) foreach($thread_active as $k => $v) { if($k>0) { ?>
<li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $v['tid'];?>" target="_blank"><?php echo cutstr($v['subject'],36); ?></a></li>
<?php } } ?>
</ul>
</div>
</div>
<div class="mt20">
<div class="bbscon_geer_title clear_b">
<span class="title16_1a2b38">新加入</span>
</div>
<div class="tx32 clear_b mt20">
<ul><?php if(is_array($vip_new)) foreach($vip_new as $k => $v) { ?><li><a href="home.php?mod=space&amp;uid=<?php echo $v['uid'];?>" title="<?php echo $v['username'];?>" target="_blank"><?php echo avatar($v[uid], 'small'); ?></a></li>
<?php } ?>
</ul>
</div>
</div>
<div class="mt20">
<div class="bbscon_geer_title clear_b">
<span class="title16_1a2b38">活跃先锋</span>
</div>
<div class="tx32 clear_b mt20">
<ul><?php if(is_array($vip_active)) foreach($vip_active as $k => $v) { ?><li><a href="home.php?mod=space&amp;uid=<?php echo $v['uid'];?>" title="<?php echo $v['username'];?>" target="_blank"><?php echo avatar($v[uid], 'small'); ?></a></li>
<?php } ?>
</ul>
</div>
</div>
</div>
<div id="dignwei"></div>
</div>
</div>
</div>
<!-- 广告位：戈尔先锋营旗版块帜广告 403 -->
<script type="text/javascript">
jQuery(function(){
var isiOS 	  = navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod');
    var isAndroid = navigator.userAgent.match('Android');
    if (!isiOS && !isAndroid) {
    	jQuery(".ewmbox").show();
jQuery(".close_ewm").click(function(){
jQuery(".ewmbox").hide();
});
    }

jQuery('.close_ewm').click(function(){
jQuery(".ewmbox").hide();
});

var ww = jQuery(window).width();
var r_z = (ww-980)/2 -120;

if(r_z<0){
jQuery(".ewmbox").css("left",'0px');
}else{
jQuery(".ewmbox").css("left",r_z);
}
});
</script>
<!--天猫广告开始-->
<style>
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.h13_ewm{ height:13px;}
.ewmbox{ width:100px; position: fixed !important; top: 215px; position: absolute; z-index: 10; float:right; color:#585858; display:none;}
.close_ewm{ width:11px; height:11px; background:url(http://static.8264.com/static/images/common/ewmclose.jpg) left top no-repeat; float:right; margin-bottom:2px;}
.close_ewm:hover{  background:url(http://static.8264.com/static/images/common/ewmclose_hover.jpg) left top no-repeat;}
</style>
<div class="ewmbox" style="display:none;">
<div class="clear_b h13_ewm"><a href="javascript:void(0)" class="close_ewm"></a></div>
<!-- 论坛先锋营_左侧浮动403 -->
<div style="position:relative;">
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=37");
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
</div><div class="clearfix"></div>
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
<p>津ICP备05004140号-10 ICP证 津B2-20110106&nbsp;&nbsp;&nbsp;天津信一科技有限公司版权所有</p>
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
<?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
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
<?php } if(!($_G['siteurl'] == 'http://bbs.8264.com/' &&$_G['PHP_SELF'] == '/index.php' )) { ?><?php include(DISCUZ_ROOT.'./source/plugin/skiing/zhidemai_ad.php'); ?><?php $zhidemai_list_alert = ZhidemaiPianyiAd::pianyi_alert(10, 'top', 'jiu', '10027'); ?><!--广告开始-->
<style>.zhidemaipopbox_y{bottom:0;height:100%;overflow:auto;position:fixed;right:0;top:0;width:100%;overflow-y:scroll;z-index:1902}.balckbg85popbg{background:#000000;bottom:0;left:0;opacity:0.85;position:fixed;right:0;top:0;z-index:1901}.zhidemaipopcon_y{position:relative;width:782px;margin:100px auto}.zhidemaititle_y{position:relative;text-align:center;border-radius:10px 10px 0 0}.zhidemaipopconlist_y{background:#fff;border-radius:0px 0px 10px 10px;overflow:hidden}.zhidemaimorelink{text-align:center;padding:23px 0px 0px 0px}.zhidemaimorelink a{font-size:16px;color:#ff6f53;border:#ff6f53 solid 1px;border-radius:30px;text-align:center;display:inline-block;padding:10px 90px;text-decoration:none}.zhidemaicloselink{background:url(http://static.8264.com/static/images/coupon/close-x.png) no-repeat;height:19px;width:22px;cursor:pointer;position:absolute;right:-32px;top:8px;display:block;z-index:99999}.product-item{width:300px;float:left;padding:25px 45px 45px}.item-price{margin-top:15px}.item-button{color:#fff;line-height:40px;font-size:0;margin-top:15px}.item-button a{width:144px;height:40px;font-size:16px;border-radius:20px;display:inline-block;text-align:center}.coupon-button{color:#fff;background-color:#ff512f;box-shadow:0 9px 18px rgba(198,60,33,.43)}.buy-button{color:#ff512f;background-color:#ffe0c1;margin-left:12px}
</style>
<div class="zhidemaiadpopbox_qianduan" style="display: none;">
<div class="balckbg85popbg"></div>
    <div class="zhidemaipopbox_y">
        <div class="zhidemaipopcon_y">
            <div class="zhidemaititle_y"><img src="http://static.8264.com/static/images/coupon/slogen.png"></div>
            <?php echo adshow("custom_472"); ?>            <div class="zhidemaimorelink"><a href="http://pianyi.8264.com/goods/list-jiu-cid-10027.html" target="_blank">查看更多优惠券产品></a></div>
            <i class="zhidemaicloselink"></i>
        </div>
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
getcookie('couponAds_1') ? '' : $(".zhidemaiadpopbox_qianduan").show();
$(".zhidemaiadpopbox_qianduan").is(":hidden") ? "" : $("body").css("overflow","hidden");
$(".zhidemaicloselink").click(function() {
setcookie("couponAds_1", 1, 43200);
$("body").removeAttr("style");
$(".zhidemaiadpopbox_qianduan").hide();
});
});
</script>
<!--广告结束--><?php } ?>


</body>
</html><?php output(); ?>