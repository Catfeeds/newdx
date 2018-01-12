<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('mountainview', 'forum/dianping/header');
0
|| checktplrefresh('./template/8264/forum/dianping/mountainview.htm', './template/8264/forum/dianping/header.htm', 1498938414, 'diy', './data/template/2_diy_forum_dianping_mountainview.tpl.php', 'data/diy', 'forum/dianping/mountainview')
|| checktplrefresh('./template/8264/forum/dianping/mountainview.htm', './template/8264/forum/dianping/dpad.htm', 1498938414, 'diy', './data/template/2_diy_forum_dianping_mountainview.tpl.php', 'data/diy', 'forum/dianping/mountainview')
|| checktplrefresh('./template/8264/forum/dianping/mountainview.htm', './template/8264/forum/dianping/footer.htm', 1498938414, 'diy', './data/template/2_diy_forum_dianping_mountainview.tpl.php', 'data/diy', 'forum/dianping/mountainview')
|| checktplrefresh('./template/8264/forum/dianping/mountainview.htm', './template/8264/common/header_8264_new.htm', 1498938414, 'diy', './data/template/2_diy_forum_dianping_mountainview.tpl.php', 'data/diy', 'forum/dianping/mountainview')
|| checktplrefresh('./template/8264/forum/dianping/mountainview.htm', './template/8264/common/ewm_r.htm', 1498938414, 'diy', './data/template/2_diy_forum_dianping_mountainview.tpl.php', 'data/diy', 'forum/dianping/mountainview')
|| checktplrefresh('./template/8264/forum/dianping/mountainview.htm', './template/8264/common/footer_8264_new.htm', 1498938414, 'diy', './data/template/2_diy_forum_dianping_mountainview.tpl.php', 'data/diy', 'forum/dianping/mountainview')
|| checktplrefresh('./template/8264/forum/dianping/mountainview.htm', './template/8264/common/header_common.htm', 1498938414, 'diy', './data/template/2_diy_forum_dianping_mountainview.tpl.php', 'data/diy', 'forum/dianping/mountainview')
|| checktplrefresh('./template/8264/forum/dianping/mountainview.htm', './template/8264/common/index_ad_top.htm', 1498938414, 'diy', './data/template/2_diy_forum_dianping_mountainview.tpl.php', 'data/diy', 'forum/dianping/mountainview')
|| checktplrefresh('./template/8264/forum/dianping/mountainview.htm', './template/8264/common/taobao_ad_alert.htm', 1498938414, 'diy', './data/template/2_diy_forum_dianping_mountainview.tpl.php', 'data/diy', 'forum/dianping/mountainview')
;
block_get('6991');?>
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
<?php if(!$is_site_index) { ?><li class="wan" style="width:67px;"><a href="http://pianyi.8264.com/?from=top" class="topLink topLink_w_bg wkuan" target="_blank">值得买</a></li><?php } ?>
<li class="wan"><a href="http://bx.8264.com/?bbsbxnew" class="topLink topLink_w_bg wkuan" target="_blank">保险</a></li>
<li class="shop8264nav">
<a href="https://8264.tmall.com/" class="topLink" target="_blank">8264商城</a>
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
<script type="text/javascript">var fid = <?php echo $_G['fid'];?>, tid = <?php echo $_G['tid'];?>;</script>
<script src="<?php echo $_G['setting']['jspath'];?>forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script src="static/js/formValidator-4.0.1.js" type="text/javascript" type="text/javascript"></script>
<script src="static/js/dianping/line_help.js" type="text/javascript"></script>
<style id="diy_style" type="text/css">#frameEfYZpz {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6991 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6991 .content {  margin:0px !important;}</style>
<script src="static/js/calendar.js" type="text/javascript"></script>
<style type="text/css">
#mdly { margin: 20px 0 0 10px; padding: 0; width: 200px; height: auto; background: none; }
.share_bd_warpten{ width:50px; position:absolute; float:right; position: fixed !important;  position: absolute; z-index: 1; bottom:20px; right: 30px; background:#fff;}
.bbs_share_sc{ width:50px;}
.bbs_share_sc li{ width:50px; height:51px;}
.bbs_share_sc li.ps_re{ position:relative;}
.bbs_share_sc li a{ background:url('http://www.8264.com/static/images/common/baidushare.jpg') no-repeat; display:block; }
.bbs_share_sc li .share{ width:50px; height:50px; background-position:0px 0px;}
.bbs_share_sc li .share:hover{ width:50px; height:50px; background-position:0px -204px;}
.bbs_share_sc li .sc{ width:50px; height:50px; background-position:0px -51px;}
.bbs_share_sc li .sc:hover{ width:50px; height:50px; background-position:0px -255px;}
.bbs_share_sc li .bbsli{ width:50px; height:50px; background-position:0px -102px;}
.bbs_share_sc li .bbsli:hover{ width:50px; height:50px; background-position:0px -306px;}
.bbs_share_sc li .gotop_50{ width:50px; height:50px; background-position:0px -153px;}
.bbs_share_sc li .gotop_50:hover{ width:50px; height:50px; background-position:0px -357px;}
.share_bd{ width:200px; position:absolute; height:50px; top:0px; right:50px; font-size:0px; display:none;}
.bbs_share_sc li .share_bd a{ width:50px; height:50px; background:url('http://www.8264.com/static/images/common/baidushare.jpg') no-repeat; display:inline-block; _display:inline; _zoom:1;}
.bbs_share_sc li .share_bd a.sina{ background-position:0 -408px;}
.bbs_share_sc li .share_bd a.sina:hover{ background-position:0 -612px;}
.bbs_share_sc li .share_bd a.qq{ background-position: 0px -459px;}
.bbs_share_sc li .share_bd a.qq:hover{ background-position: 0px -663px;}
.bbs_share_sc li .share_bd a.wb{ background-position: 0px -510px;}
.bbs_share_sc li .share_bd a.wb:hover{ background-position: 0px -714px;}
.bbs_share_sc li .share_bd a.wx{ background-position: 0px -561px;}
.bbs_share_sc li .share_bd a.wx:hover{ background-position: 0px -765px;}
.bdshare-button-style0-32 a{padding:0;margin:0;}
</style>
<script type="text/javascript">
var ie6=false;
if(/msie/.test(navigator.userAgent.toLowerCase()) && 'undefined' == typeof(document.body.style.maxHeight)){
ie6=true;
}

var initmsg = jQuery('#f_pricedesc').val();
var initmsg = jQuery('#f_comment').val();
var initmsg = jQuery('#f_message').val();


var postminchars = parseInt(0);
var postmaxchars = parseInt(0);
var disablepostctrl = parseInt('<?php echo $_G['group']['disablepostctrl'];?>');
var tid = <?php echo $viewdata['tid'];?>;
jQuery(document).ready(function($) {

$('#f_pricedesc').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});

$('#f_comment').focus(function(){
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


/*
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
});*/

$("#bv_closeBtn").click(function(){
$("#div_black, #box_view").fadeOut(200);
});
$("#bm_closeBtn").click(function(){
$("#div_black, #box_map").fadeOut(200);
});

$("#lunbosmall li").eq(0).find('.black_48_48').hide();
$("#lunbosmall li").hover(function() {
$(this).find('.black_48_48').hide();
$(this).siblings().find('.black_48_48').show();
var index = $(this).index();
$('#lunbobig li').eq(index).stop(true).fadeIn(0).siblings().delay(100).fadeOut(0);
});

var p_height = $("#info_p").height();
if(p_height > 160){
$("#info_p").height(160);
$("#slidemore").click(function() {
if ($("#info_p").height() > 160) {
$("#info_p").animate({
height: 160
}, 300);
$("#slidemore").text("查看更多").removeClass("p_more_1");
} else {
$("#info_p").animate({
height: p_height
}, 300);
$("#slidemore").text("收起").addClass("p_more_1");
}
});
} else {
$("#slidemore").hide();
}

$("#starBox>span").click(function(){
$(this).prevAll().addBack().css({"background-position": "0 0"});
$(this).nextAll().css({"background-position": "-17px 0"});
if (ie6) {
$("#form_starNum").val(($(this).index()+1)/3);
} else {
$("#form_starNum").val($(this).index()+1);
}

});
$("#bv_starBox>span").click(function(){
$(this).prevAll().addBack().css({"background-position": "0 0"});
$(this).nextAll().css({"background-position": "-17px 0"});
$("#bv_starBox").next().html($(this).attr('title'));
if (ie6) {
$("#bv_starNum").val(($(this).index()+1)/3);
} else {
$("#bv_starNum").val($(this).index()+1);
}
});

$(document).on('click',"span[id^=editBtn_]",function(){
var p = $(this).parents('dl');
$("#box_view #pid").val(this.id.replace('editBtn_',''));
var star = p.find('#starnum').val() || 1;
var starDom = $("#bv_starBox>span").eq(star-1);
starDom.prevAll().addBack().css({"background-position": "0 0"});
starDom.nextAll().css({"background-position": "-17px 0"});
$("#bv_starBox").next().html(starDom.attr('title'));
$("#bv_starNum").val(star);
//$("#box_view input[name='datapicker[]']").eq(0).val(p.find('#startTime').val());
//$("#box_view input[name='datapicker[]']").eq(1).val(p.find('#endTime').val());
//$("#box_view input[name='datapicker[]']").eq(2).val(p.find('#startHour').val());
//$("#box_view input[name='datapicker[]']").eq(3).val(p.find('#endHour').val());
if(p.find('#startHour').html()&&p.find('#endHour').html()){
p.find('#f_starttime').html() && $("#box_view input[name='datapicker[]']").eq(0).val(p.find('#f_starttime').html());
p.find('#f_starttime').html() && $("#box_view input[name='datapicker[]']").eq(1).val(p.find('#f_starttime').html());
p.find('#startHour').html()&& $("#box_view input[name='datapicker[]']").eq(2).val(p.find('#startHour').html());
p.find('#endHour').html() && $("#box_view input[name='datapicker[]']").eq(3).val(p.find('#endHour').html());
$("#box_view .timeHour").show();
}else{
p.find('#f_starttime').html() && $("#box_view input[name='datapicker[]']").eq(0).val(p.find('#f_starttime').html());
p.find('#f_endtime').html() && $("#box_view input[name='datapicker[]']").eq(1).val(p.find('#f_endtime').html());
}

p.find('#pricedesc') && $("#box_view #f_pricedesc").val(p.find('#pricedesc').html().replace(/<br[^>]*>/gi,"\r\n"));
p.find('#mycomments') && $("#box_view #f_comment").val(p.find('#mycomments').html().replace(/<br[^>]*>/gi,"\r\n"));
p.find('#tolmsg') && $("#box_view #f_message").val(p.find('#tolmsg').html().replace(/<br[^>]*>/gi,"\r\n"));
$("#div_black, #box_view").fadeIn(200);
});
$("#boxSubmit").click(function(){
$('#bv_error').html('').hide();
var startTime = $("#box_view input[name='datapicker[]']").eq(0).val();
var endTime   = $("#box_view input[name='datapicker[]']").eq(1).val();
var starHour  = $("#box_view input[name='datapicker[]']").eq(2).val();
var endHour   = $("#box_view input[name='datapicker[]']").eq(3).val();
var pricedesc = $("#box_view #f_pricedesc").val();
var mycomment = $("#box_view #f_comment").val();
var message = $("#box_view #f_message").val();
var starnum = $("#bv_starNum").val();
var pid = $("#box_view #pid").val();
//把时间转为时间戳
var intStartTime 	= getNumberTime(startTime);
var intEndTime 		= getNumberTime(endTime);
var intStartHour	= getFormatHour(starHour);
var intEndHour		= getFormatHour(endHour);

if(!checkText(intStartTime, intEndTime,intStartHour,intEndHour, pricedesc,mycomment,message,'bv_error')){
return false;
}
$("#div_black, #box_view").fadeOut(200);
$.post('forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=reply&ext=edit&tid=<?php echo $_G['tid'];?>&inajax=1',
{pid:pid,starnum:starnum,f_starttime:intStartTime,f_endtime:intEndTime,f_starhour:intStartHour,f_endhour:intEndHour,f_pricedesc:pricedesc,f_comment:mycomment,message:message,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes'},function(data){
if(data=='ok'){
_showmsg('修改成功');
} else if($($(data).find('root'))) {
_showmsg($(data).children('root').text().replace(/<script.*>.*<\/script>/i, ''));
} else {
_showmsg('发生错误请重试！');
}
});

var comment = $("#editBtn_"+pid).parents('dl');
comment.find('#starnum').val(starnum);
var starDom = comment.find('.starBox>span').eq(starnum-1);
starDom.prevAll().addBack().css({"background-position": "0 0"});
starDom.nextAll().css({"background-position": "-17px 0"});
comment.find('#tipss').remove();
comment.find('#f_starttime').html() && comment.find('#f_starttime').html(startTime.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('#f_endtime').html() && comment.find('#f_endtime').html(endTime.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('#ddt').html() && comment.find('#ddt').remove();
comment.find('#pricedesc').html() && comment.find('#pricedesc').html(pricedesc.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('#mycomments').html() && comment.find('#mycomments').html(mycomment.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('#tolmsg').html() && comment.find('#tolmsg').html(message.replace(/(\r\n)|(\n)/gi,"<br/>"));
$("#bv_closeBtn").click();
});

$(document).on('click', "span[id^=supportBtn_]", function(){
var sid = this.id;
var pid = sid.replace('supportBtn_','');
var s_c = $(this).find('em').text() ? parseInt($(this).find('em').text().replace(/[^0-9]/ig, "")) : 0;
if(s_c == 0) $(this).addClass('active');
$(this).find('em').text('('+parseInt(s_c+1)+')');
$(this).attr('id', '');
$.get('forum.php?ctl=<?php echo $modstr;?>&act=support',{tid:'<?php echo $_G['tid'];?>',pid:pid},function(data){});
});

//选择小时
$(".dataHour").change(function(){
var obj  = $(this).parent();
var hour = $(this).val();
hour	 = getFormatHour(hour);
$(this).val(hour);

if (!$(this).hasClass("startHour") && !$(this).hasClass("endHour")) {
return false;
}
if (obj.attr("class").indexOf("post") == -1) {
return false;
}

if ($(this).hasClass("startHour")) {
var startHour = hour;
var endHour   = obj.find(".endHour").val();
endHour	 	  = getFormatHour(endHour);
var sign  	  = "开始";
if(!startHour && startHour!=0){
jQuery('#date_error').html("请填写攀登<?php echo $modname;?>的开始时间");
return false;
}
} else {
var startHour = obj.find(".startHour").val();
startHour	  = getFormatHour(startHour);
var endHour   = hour;
var sign  	  = "结束";
if(!endHour){
jQuery('#date_error').html("请填写攀登<?php echo $modname;?>的结束时间");
return false;
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
jQuery('#date_error').html("<?php echo $modname;?>的"+sign+"时间需小于当前时间");
return false;
}
}

if ((startHour || startHour==0) && endHour && startHour >= endHour) {
$(this).val("");
jQuery('#date_error').html("攀登<?php echo $modname;?>的结束时间需大于开始时间");
return false;
}else if((startHour || startHour==0) && endHour && endHour >= startHour){
jQuery('#date_error').html('<div class="correct"></div>');
}
});

$("#from_post").submit(function(){
var starnum = $("#form_starNum").val();
var starttimes = $("#from_post input[name='datapicker[]']").eq(0).val();
var endtimes   = $("#from_post input[name='datapicker[]']").eq(1).val();
var starHour  = $("#from_post input[name='datapicker[]']").eq(2).val();
var endHour   = $("#from_post input[name='datapicker[]']").eq(3).val();
var pricedesc = $(".writeCmt #f_pricedesc").val();
var mycomment = $(".writeCmt #f_comment").val();
var message = $(".writeCmt #f_message").val();

closecalendar();

var starttime 	= getNumberTime(starttimes);
var endtime     = getNumberTime(endtimes);
var starHour	= getFormatHour(starHour);
var endHour	= getFormatHour(endHour);


if(!checkText(starttime, endtime,starHour,endHour,pricedesc,mycomment,message,'bv_errors')){
if(!parseInt(starnum))
show_errors('star_error', '请填写对此山峰的难度评价');
focus_on_date($('#from_post'), starttime, endtime, starHour, endHour);
return false;
}

showDialog('', 'info', '<img src="' + IMGDIR + '/loading.gif"> 请稍候...');
$('#from_post').parent('.writeCmt').hide();
$.post('forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=reply&tid=<?php echo $_G['tid'];?>&inajax=1',
{starnum:starnum,f_starttime:starttime,f_endtime:endtime,f_starhour:starHour,f_endhour:endHour,f_pricedesc:pricedesc,f_comment:mycomment,message:message,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes'},function(data){
hideMenu('fwin_dialog', 'dialog');
if(data=='ok'){
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
$('#myComment #time').html(starttimes+"至"+endtimes);
$('#myComment #pricedesc').html(pricedesc.replace(/(\r\n)|(\n)/gi,"<br/>"));
$('#myComment #mycomments').html(mycomment.replace(/(\r\n)|(\n)/gi,"<br/>"));
$('#myComment #tolmsg').html(message.replace(/(\r\n)|(\n)/gi,"<br/>"));
var d=new Date();
$('#myComment .date').html('发表于 '+d.getFullYear()+'-'+(parseInt(d.getMonth())+1)+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes());
$('#from_post').parent('.writeCmt').remove();
_showmsg('点评成功');
} else if($($(data).find('root'))) {
$('#from_post').parent('.writeCmt').show();
_showmsg($(data).children('root').text().replace(/<script.*>.*<\/script>/i, ''));
} else {
$('#from_post').parent('.writeCmt').show();
_showmsg('发生错误请重试！');
}
});
return false;
});
function bv_error(msg){
$('#bv_error').html(msg).show();
}
function bv_errors(msg){
$('#bv_errors').html(msg).show();
}
function checkText(start,end,startHour,endHour,price,mymsg,msg,fun){
price = $.trim(price);
mymsg = $.trim(mymsg);
msg = $.trim(msg);
if(!fun){
fun = '_showmsg'
}
var date 	  = new Date();
var curTime    	  = Math.floor(date.getTime()/1000);

if(!start){
fun == 'bv_errors' ?  show_errors("date_error", "请选择攀登<?php echo $modname;?>的开始时间") : eval(fun+'("请选择攀登<?php echo $modname;?>的开始时间")');
//eval(fun+'("请选择攀登<?php echo $modname;?>开始时间")');
return false;
}
if (start > curTime) {
fun == 'bv_errors' ?  show_errors("date_error", "攀登<?php echo $modname;?>开始时间需小于当前时间") : eval(fun+'("攀登<?php echo $modname;?>开始时间需小于当前时间")');
//eval(fun+'("攀登<?php echo $modname;?>开始时间需小于当前时间")');
return false;
}
if(!end){
fun == 'bv_errors' ?  show_errors("date_error", "请选择攀登<?php echo $modname;?>结束时间") : eval(fun+'("请选择攀登<?php echo $modname;?>结束时间")');
//eval(fun+'("请选择攀登<?php echo $modname;?>结束时间")');
return false;
}
if (end > curTime) {
fun == 'bv_errors' ?  show_errors("date_error", "攀登的结束时间需小于当前时间") : eval(fun+'("攀登的结束时间需小于当前时间")');
//eval(fun+'("攀登的结束时间需小于当前时间")');
return false;
}
if(start > end){
fun == 'bv_errors' ?  show_errors("date_error", "攀登的结束时间需小于当前时间") : eval(fun+'("攀登的结束时间需小于当前时间")');
//eval(fun+'("攀登的结束时间需大于开始时间")');
return false;
}
if(start && end){
var temp = Math.ceil((end - start)/ 86400);
if(temp>60){
fun == 'bv_errors' ?  show_errors("date_error", "攀登周期不得超过60天") : eval(fun+'("攀登周期不得超过60天")');
//eval(fun+'("攀登周期不得超过60天")');
return false;
}

}
if(start == end){
var curHour 	= date.getHours();
var tempJiange  = curTime - start;
if(!startHour && startHour!=0){
fun == 'bv_errors' ?  show_errors("date_error", "请填写攀登<?php echo $modname;?>的开始时间") : eval(fun+'("请填写攀登<?php echo $modname;?>的开始时间")');
//eval(fun+'("请填写攀登<?php echo $modname;?>的开始时间")');
return false;
}
//当天才需要判断
if (tempJiange < 86400) {
if (startHour > curHour) {
fun == 'bv_errors' ?  show_errors("date_error", "攀登<?php echo $modname;?>的开始时间需小于当前时间") : eval(fun+'("攀登<?php echo $modname;?>的开始时间需小于当前时间")');
//eval(fun+'("攀登<?php echo $modname;?>的开始时间需小于当前时间")');
return false;
}
}
if(!endHour){
fun == 'bv_errors' ?  show_errors("date_error", "请填写攀登<?php echo $modname;?>的结束时间") : eval(fun+'("请填写攀登<?php echo $modname;?>的结束时间")');
//eval(fun+'("请填写攀登<?php echo $modname;?>的结束时间")');
return false;
}
//当天才需要判断
if (tempJiange < 86400) {
if (endHour > curHour) {
fun == 'bv_errors' ?  show_errors("date_error", "{攀登<?php echo $modname;?>}的结束时间需小于当前时间") : eval(fun+'("{攀登<?php echo $modname;?>}的结束时间需小于当前时间")');
//eval(fun+'("{攀登<?php echo $modname;?>}的结束时间需小于当前时间")');
return false;
}
}
if (startHour >= endHour) {
fun == 'bv_errors' ?  show_errors("date_error", "攀登<?php echo $modname;?>的结束时间需大于开始时间") : eval(fun+'("攀登<?php echo $modname;?>的结束时间需大于开始时间")');
//eval(fun+'("攀登<?php echo $modname;?>的结束时间需大于开始时间")');
return false;
}
}
if(price.length<10){
eval(fun+'("请准确填写此次攀登所用费及商业队情况")');
return false;
}
if(!mymsg){
eval(fun+'("请填写您对未来攀登此山峰的攀登者的建议和经验")');
return false;
}
if(mymsg.length<10){
eval(fun+'("请填写您对未来攀登此山峰的攀登者的建议和经验，不能少于10个字符")');
return false;
}
if(msg.length<50){
eval(fun+'("请填写综合总结，不少于50字")');
return false;
}
return true;
}
<?php if(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) || ($_G['groupid'] == 1 ||$_G['groupid']== 45))) { ?>
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
var msg = '操作失败！';
var success = false;
switch(status){
case '1':
msg='操作成功！';success=true;break;
case '-1':
msg='您没有权限操作！';break;
}
showDialog(msg);return success;
}
<?php } if(( $_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) )) { ?>
$('#glistBox').hover(function(){
$('#glist').show();
},function(){
$('#glist').hide();
});
<?php } ?>
$('.wydp_orangelink, .wydp_warpten').hover(function(){
clearTimeout(window.wydpCtrl);
$(".wydp_warpten").show();
},function(){
window.wydpCtrl=setTimeout(function(){$(".wydp_warpten").hide();},300);
});


$.formValidator.initConfig({formID:"from_post",debug:false,submitOnce:false,
onError:function(msg,obj,errorlist){
$("#errorlist").empty();
$.map(errorlist,function(msg){
//	$("#errorlist").append("<li>" + msg + "</li>")
});
},
submitAfterAjaxPrompt : '有数据正在异步验证，请稍等...'
});

//$("#f_start").formValidator({onShow:"",onFocus:"请选择",onCorrect:"<div class=correct></div>",defaultValue:""}).inputValidator({min:10,onError:"<div class=wrong><div class=lft></div><div class=rht>请选择攀登开始时间</div></div>"});
//$("#f_end").formValidator({onShow:"",onFocus:"",onCorrect:"<div class=correct></div>",defaultValue:""}).inputValidator({min:10,onError:"<div class=wrong><div class=lft></div><div class=rht>请选择开始或者结束时间</div></div>"});

$("#f_pricedesc").formValidator({onShow:"",onFocus:"<div class=information><div class=lft></div><div class=rht>请描述本次攀登参加的哪支商业队，费用多少钱。自主攀登请描述向导、马匹等费用情况</div></div>",onCorrect:"<div class=correct></div>",defaultValue:""}).inputValidator({min:20,onError:"<div class=wrong><div class=lft></div><div class=rht>您的描述还不足够详细，请详细描述</div></div>"});
$("#f_comment").formValidator({onShow:"",onFocus:"<div class=information><div class=lft></div><div class=rht>请从装备选用、体能分配、攀登注意事项等方面给出您的建议，不少于50字</div></div>",onCorrect:"<div class=correct></div>",defaultValue:""}).inputValidator({min:100,onError:"<div class=wrong><div class=lft></div><div class=rht>请详细填写 我的建议 不少于50字</div></div>"});
$("#f_message").formValidator({onShow:"",onFocus:"<div class=information><div class=lft></div><div class=rht>请从天气情况、日程安排、营地住宿、攀登线路等方面综合描述本次攀登，不少于100字。如已发布相关帖子，请在最后附上帖子链接。抄袭他人点评扣除2个8264币</div></div>",onCorrect:"<div class=correct></div>",defaultValue:""}).inputValidator({min:200,onError:"<div class=wrong><div class=lft></div><div class=rht>请详细填写攀登综述，不少于100字</div></div>"});

$("#starBox .graystar").hover(
function(){
$('#showtp').text(this.title);
},
function(){
$('#showtp').text('');
}
);

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

function loadUnloginData(name,id){
var ld = loadUserdata(name);
if(ld != '' && ld != null){
$(id).value = ld;
}
}
</script>
<div class="layout mt50">
<div class="layoutLeft">
<h1 class="skiName">
<span class="tit"><a href="<?php echo $url;?>&act=showview&tid=<?php echo $viewdata['tid'];?>" title="<?php echo $viewdata['subject'];?>"><?php echo $viewdata['subject'];?></a></span>
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
<li><?php if($_G['group']['allowdelpost']) { ?><a href="forum.php?ctl=<?php echo $modstr;?>&amp;act=deleteit&amp;tid=<?php echo $_G['tid'];?>" onclick="return confirm('确认删除这个<?php echo $modname;?>？删除后将不可恢复！');">删除</a><?php } ?></li>
<?php if(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) || ($_G['groupid'] == 1 ||$_G['groupid']== 45))) { ?>
<li class="setpass" <?php if($viewdata['enable']==1) { ?>style="display:none;"<?php } ?>><a class="tgsh" href="javascript:;">通过审核</a></li>
<li class="setcancel" <?php if($viewdata['enable']==0) { ?>style="display:none;"<?php } ?>><a class="qxsh" href="javascript:;">取消审核</a></li>
<?php } ?>
                    </ul>
                </div>
</div>
<?php } ?>
</h1>
<div class="picShow mb35">
<div class="picShowL">
<!--轮播开始-->
<div class="lunbo">
<div class="lunbobig" id="lunbobig">
<ul><?php if(is_array($piclist)) foreach($piclist as $pic) { ?><li><a title="点击查看原图" target="_blank" href="<?php echo $pic['url'];?><?php echo $pic['attachment'];?>"><img src="<?php echo getimagethumb(322,244,2,'plugin/'.$pic['attachment'], $pic['aid'], $pic['serverid']); ?>" /></a></li>
<?php } ?>
</ul>
</div>
<div class="lunbosmall" id="lunbosmall">
<ul><?php if(is_array($piclist)) foreach($piclist as $pic) { ?><li>
<a href="javascript:;" target="_blank"><img src="<?php echo getimagethumb(48,48,2,'plugin/'.$pic['attachment'], $pic['aid'], $pic['serverid']); ?>"/></a>
<div class="black_48_48"></div>
</li>
<?php } ?>
</ul>
</div>
</div>
<!--轮播结束-->
</div>
<div class="picShowR">
<div class="pingf">
<div class="interest_sectl" id="interest_sectl">
<div class="star_show"><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $star_data['price']/2) { if($star_data['price']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?> colorstar"></span><?php endfor; ?><span class="num"><?php echo $star_data['price'];?></span>
<span class="text"></span>
</div>
<div class="peoples">(<span class="num"><?php if($star_data['count']) { ?><?php echo $star_data['count'];?><?php } else { ?>0<?php } ?></span>人评分)</div>
<div class="star_list">
<div class="star" title="非常困难">
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent5']*0.8 ?>px;"></span>
<span class="num"><?php if($star_data['percent5']) { ?><?php echo $star_data['percent5'];?><?php } else { ?>0.0<?php } ?>%</span>
<span>(非常困难)</span>
</div>
<div class="star" title="困难">
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="graystar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent4']*0.8 ?>px;"></span>
<span class="num"><?php if($star_data['percent4']) { ?><?php echo $star_data['percent4'];?><?php } else { ?>0.0<?php } ?>%</span>
<span>(困难)</span>
</div>
<div class="star" title="难">
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent3']*0.8 ?>px;"></span>
<span class="num"><?php if($star_data['percent3']) { ?><?php echo $star_data['percent3'];?><?php } else { ?>0.0<?php } ?>%</span>
<span>(难)</span>
</div>
<div class="star" title="简单">
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent2']*0.8 ?>px;"></span>
<span class="num"><?php if($star_data['percent2']) { ?><?php echo $star_data['percent2'];?><?php } else { ?>0.0<?php } ?>%</span>
<span>(简单)</span>
</div>
<div class="star" title="非常简单">
<span class="redstar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent1']*0.8 ?>px;"></span>
<span class="num"><?php if($star_data['percent1']) { ?><?php echo $star_data['percent1'];?><?php } else { ?>0.0<?php } ?>%</span>
<span>(非常简单)</span>
</div>
</div>
</div>
                </div>

<div class="webTel">
<div><span class="longitude">经度：<?php echo $viewdata['lon'];?></span><span class="latitude">纬度：<?php echo $viewdata['lat'];?></span></div>
<div><span class="altitude">高度：<?php echo $viewdata['height'];?></span></div>
<div><span class="season">攀登季节：<?php echo $viewdata['season'];?></span></div>
<div><span class="address">所在地址：<?php echo $viewdata['region'];?></span></div>
</div>
<div class="addr"><?php echo $viewdata['newaddress'];?></div>
</div>
</div>
<?php if($viewdata['message']) { ?>
<div class="intro mb25">
<h2 class="h2Titip">
<span><?php echo $viewdata['subject'];?>简介</span>
<a href="/shanfeng-<?php echo $viewdata['tid'];?>#writecommon" class="wydp_orangelink">我要点评</a>
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
<div class="bd">
<div class="info" id="info_p"><p><?php echo $viewdata['message'];?></p></div>
<div class="p_more" id="slidemore">查看更多</div>
</div>
<div><?php echo adshow("custom_309"); ?></div>
</div>
<?php } ?><style>
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
</script><div class="commentBox" id="myComment"<?php if(!$my_comment) { ?> style="display:none;"<?php } ?>>
<h2 class="h2Tit">我的点评&nbsp;&nbsp;&nbsp;<span>假如您的点评没有奖励8264币，请联系工作人员QQ7171608询问原因</span></h2>
<dl class="cmtDl">
<dd class="avatar"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>"><?php echo avatar($_G['uid'], small); ?></a></dd>
<dd class="cmtCont">
<div class="tit">
<span class="usrName"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" class="usrName"><?php echo $_G['username'];?></a></span>
                        <span style="color:#A8A8A8;float: left">点评了<a href="forum.php?ctl=mountain&amp;act=showview&amp;tid=<?php echo $viewdata['tid'];?>" style="color:#A8A8A8;" title="<?php echo $viewdata['subject'];?>"><?php echo $viewdata['subject'];?></a>，</span>
                        <span class="date">发表于 <?php echo $my_comment['dateline'];?></span>
<?php if($my_comment['rate']) { ?>
<span class="bi"><a href="http://bbs.8264.com/forum-483-1.html" target="blank"><img align="absmiddle" title="奖励8264币" alt="奖励8264币" src="static/image/common/8264b.gif"></a></span>
<?php } ?>
<input type="hidden" name="" id="starnum" value="<?php echo $my_comment['starnum'];?>" />
</div>
<ul class="goodBad">
<li> <span class="leftIco date2">攀登日期</span>
<div class="cont">
<?php if($my_comment['ext1']==$my_comment['ext2']) { ?>
<p id="time"><span id="f_starttime"><?php echo $my_comment['ext1'];?></span><span id="f_endtime"></span><span id="ddt">&nbsp;&nbsp;<span id="startHour"><?php echo $my_comment['starHour'];?></span>时至<span id="endHour"><?php echo $my_comment['endHour'];?></span>时&nbsp; 共用 <?php echo $my_comment['time'];?></span></p>
<?php } else { ?>
<p id="time"><span id="f_starttime"><?php echo $my_comment['ext1'];?></span> 至 <span id="f_endtime"><?php echo $my_comment['ext2'];?></span><span id="ddt">&nbsp;共用 <?php echo $my_comment['time'];?></span></p>
<?php } ?>
</div>
</li>
<li <?php if(!$my_comment['ext3']) { ?> style="display:none;"<?php } ?>>
<span class="leftIco cost">费用协作</span>
<div class="cont">
<p id="pricedesc"><?php echo $my_comment['ext3'];?></p>
</div>
</li>
<li <?php if(!$my_comment['ext4']) { ?> style="display:none;"<?php } ?>>
<span class="leftIco suggest">我的建议</span>
<div class="cont">
<p id="mycomments"><?php echo $my_comment['ext4'];?></p>
</div>
</li>
<li> <span class="leftIco summary">综述总结</span>
<div class="cont">
<p id="tolmsg"><?php echo $my_comment['message'];?></p>
</div>
</li>
<li> <span class="leftIco hard">难度评价</span>
<div class="cont">
<span class="starBox" <?php if(!$my_comment['starnum']) { ?> style="display: none;"<?php } ?>><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $my_comment['starnum']) { ?>redstar<?php } else { ?>graystar<?php } ?>" <?php if($i==0 ) { ?>title="非常简单"<?php } elseif($i==1) { ?>title="简单"<?php } elseif($i==2) { ?>title="难"<?php } elseif($i==3) { ?>title="困难"<?php } elseif($i==4) { ?>title="非常困难"<?php } ?>></span><?php endfor; ?>&nbsp;<span id="tipss"><?php if($my_comment['starnum']==1) { ?>(非常简单)<?php } elseif($my_comment['starnum']==2) { ?>(简单)<?php } elseif($my_comment['starnum']==3) { ?>(难)<?php } elseif($my_comment['starnum']==4) { ?>(困难)<?php } elseif($my_comment['starnum']==5) { ?>(非常困难)<?php } ?>
</span>
</span>
</div>
</li>

</ul>
</dd>
<dd class="bottomCont">
<span class="useful<?php if($my_comment['supports']>0) { ?> active<?php } ?>" title="你不能评价自己的点评"><i></i>有用<?php if(!$my_comment['supports']) { } else { ?>(<?php echo $my_comment['supports'];?>)<?php } ?></span>
<span class="ans" id="editBtn_<?php echo $my_comment['pid'];?>"><a href="javascript:;">修改</a></span>
<?php if($_G['adminid'] == 1 && !$my_comment['first']) { ?>
<span class="normal">
<label for="manage<?php echo $comment['pid'];?>">
<input type="checkbox" id="manage<?php echo $my_comment['pid'];?>" class="pc" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $my_comment['pid'];?>)" value="<?php echo $my_comment['pid'];?>" autocomplete="off" />
管理
</label>&nbsp;
<a id="k_rate" style="color: #666;" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $my_comment['pid'];?>', 'get', -1);return false;" title="加8264币">评分&nbsp;</a>
<?php if($my_comment['rate'] && $_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $my_comment['pid'];?>&amp;page=<?php echo $page;?>" onclick="showWindow('rate', this.href, 'get', -1)">撤销评分</a>
<?php } ?>
</span>
<?php } ?>
</dd>
</dl>
</div>
<div class="commentBox" id="commentsList"><a id="comment"></a>
<?php if($replylist) { ?>
<h2 class="h2Tit"><?php echo $viewdata['subject'];?>点评</h2><?php if(is_array($replylist)) foreach($replylist as $comment) { ?><dl class="cmtDl">
<dd class="avatar"><a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" target="_blank" rel="nofollow" ><?php echo avatar($comment[authorid], small); ?></a></dd>
<dd class="cmtCont">
<div class="tit">
<span class="usrName"><a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" rel="nofollow" target="_blank" class="usrName"><?php echo $comment['author'];?></a></span>
<span class="date">发表于 <?php echo $comment['dateline'];?></span>
<?php if($comment['rate']) { ?>
<span class="bi"><a href="http://bbs.8264.com/forum-483-1.html" target="blank"><img align="absmiddle" title="奖励8264币" alt="奖励8264币" src="static/image/common/8264b.gif"></a></span>
<?php } ?>
<input type="hidden" name="" id="starnum" value="<?php echo $comment['starnum'];?>" />

</div>
<ul class="goodBad">
<?php if($comment['ext1']&&$comment['ext2']) { ?>
<li> <span class="leftIco date2">攀登日期</span>
<div class="cont">
<?php if($comment['ext1']==$comment['ext2']) { ?>
<p id="time"><span id="f_starttime"><?php echo $comment['ext1'];?></span> &nbsp;&nbsp;<span id="startHour"><?php echo $comment['starHour'];?></span>时至<span id="endHour"><?php echo $comment['endHour'];?></span>时&nbsp;共用 <?php echo $comment['time'];?></p>
<?php } else { ?>
<p id="time"><span id="f_starttime"><?php echo $comment['ext1'];?></span> 至 <span id="f_endtime"><?php echo $comment['ext2'];?></span> &nbsp;<span id="ddt">共用 <?php echo $comment['time'];?></span></p>
<?php } ?>
</div>
</li>
<?php } if($comment['ext3']) { ?>
<li>
<span class="leftIco cost">费用协作</span>
<div class="cont">
<p id="pricedesc"><?php echo $comment['ext3'];?></p>
</div>
</li>
<?php } if($comment['ext4']) { ?>
<li>
<span class="leftIco suggest">我的建议</span>
<div class="cont">
<p id="mycomments"><?php echo $comment['ext4'];?></p>
</div>
</li>
<?php } ?>
<li> <span class="leftIco summary">综述总结</span>
<div class="cont">
<p id="tolmsg"><?php echo $comment['message'];?></p>
</div>
</li>
<?php if($comment['starnum']) { ?>
<li> <span class="leftIco hard">难度评价</span>
<div class="cont">
<span class="starBox" <?php if(!$comment['starnum']) { ?> style="display: none;"<?php } ?>><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $comment['starnum']) { ?>redstar<?php } else { ?>graystar<?php } ?>" <?php if($i==0 ) { ?>title="非常简单"<?php } elseif($i==1) { ?>title="简单"<?php } elseif($i==2) { ?>title="难"<?php } elseif($i==3) { ?>title="困难"<?php } elseif($i==4) { ?>title="非常困难"<?php } ?>></span><?php endfor; ?>&nbsp;<span id="tipss"><?php if($comment['starnum']==1) { ?>(非常简单)<?php } elseif($comment['starnum']==2) { ?>(简单)<?php } elseif($comment['starnum']==3) { ?>(难)<?php } elseif($comment['starnum']==4) { ?>(困难)<?php } elseif($comment['starnum']==5) { ?>(非常困难)<?php } ?>
</span>
</span>

</div>
</li>
<?php } ?>
</ul>
</dd>
<dd class="bottomCont">
<span class="useful<?php if($comment['supports']>0) { ?> active<?php } ?>"
<?php if($_G['uid'] && !$supportlist[$comment['pid']]) { ?> id="supportBtn_<?php echo $comment['pid'];?>"<?php } if(!$_G['uid']) { ?> onclick="javascript:window.location.href = '<?php echo $_G['siteurl'];?>member.php?mod=logging&action=login';return false;"<?php } if($_G['uid']) { if($supportlist[$comment['pid']]) { ?>
title="你已经评价过了"
<?php } else { ?>
title="有用"
<?php } } else { ?>
title="登录后才能进行评价"
<?php } ?>><i></i>有用<em><?php if(!$comment['supports']) { } else { ?>(<?php echo $comment['supports'];?>)<?php } ?></em></span>
<?php if($_G['adminid'] == 1) { ?>
<span class="ans" id="editBtn_<?php echo $comment['pid'];?>"><a href="javascript:;">修改</a></span>
<?php } if($_G['adminid'] == 1 && !$comment['first']) { ?>
<span class="normal">
<label for="manage<?php echo $comment['pid'];?>">
<input type="checkbox" id="manage<?php echo $comment['pid'];?>" class="pc" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $comment['pid'];?>)" value="<?php echo $comment['pid'];?>" autocomplete="off" />
管理
</label>&nbsp;
<a id="k_rate" style="color: #666;" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $comment['pid'];?>', 'get', -1);return false;" title="加8264币">评分&nbsp;</a>
<?php if($comment['rate'] && $_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $comment['pid'];?>&amp;page=<?php echo $page;?>" onclick="showWindow('rate', this.href, 'get', -1)">撤销评分</a>
<?php } ?>
</span>
<?php } ?>
</dd>
</dl>
<?php } ?>
<div class="pageBox mb25"><?php echo $replymulti;?></div>
<?php } ?>
</div>
<div id="writecommon"></div>
<?php if($myrate!=1 && $viewdata['enable']==1) { ?>
<div class="writeCmt" id="writeCmt_dw">
            <h2 class="h2Tit">我要点评<?php echo $viewdata['subject'];?>
<span>&nbsp;&nbsp;&nbsp;注：转山线路不再山峰点评范围之内，山峰点评仅针对攀登进行点评</span>
</h2>
<span id="fastpostreturn" style="margin-left: 10px;"></span>
<div style="color: red; display: none;" id="bv_errors"></div>
<form method="post" id="from_post" autocomplete="off" action="<?php echo $url;?>&act=dopost&do=reply&tid=<?php echo $_G['tid'];?>">
<ul class="writeGoodBad">
<li class="mb30">
<span class="leftIco date2">
<img src="static/images/dianping/date.jpg">
</span>
<div class="cont post">
<input name="datapicker[]" readonly class="timeText datapicker startPicker" onclick="showcalendar(event, this, '', '', '', 28);" onchange="changeDate()"/> --- <input name="datapicker[]" readonly class="timeText datapicker endPicker" onclick="showcalendar(event, this, '', '', '', 28);"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input name="datapicker[]" class="timeText timeHour dataHour startHour" maxlength="2"/><span class="timeHour">时 --- </span><input name="datapicker[]" class="timeText timeHour dataHour endHour" maxlength="2"/><span class="timeHour">时</span>
<span id="f_startTip"></span>
<div id="date_error" style="padding-top:7px;"></div>
</div>
</li>
<li class="mb30">
<span class="leftIco  cost"></span>
<div class="cont">
<label class="fs14">请描述本次攀登参加的哪支商业队，费用多少钱。自主攀登请描述向导、马匹等费用情况</label>
<textarea name="f_pricedesc" rows="2" class="line3Area" id="f_pricedesc"></textarea>
<div id="f_pricedescTip"></div>
</div>
</li>
<li class="mb30">
<span class="leftIco suggest"></span>
<div class="cont">
<label class="fs14">请从装备选用、体能分配、攀登注意事项等方面给出您的建议，不少于50字</label>
<textarea name="f_comment" rows="2" class="line3Area" id="f_comment"></textarea>
<div id="f_commentTip"></div>
</div>
</li>
<li class="mb18">
<span class="leftIco summary"></span>
<div class="cont">
<label class="fs14">请从天气情况、日程安排、营地住宿、攀登线路等方面综合描述本次攀登，不少于100字。如已发布相关帖子，请在最后附上帖子链接。抄袭他人点评扣除2个8264币</label>
<textarea name="message" id="f_message" rows="6" class="line5Area "></textarea>
<div id="f_messageTip"></div>
</div>
</li>
<li class="mb30" style="z-index: 50;">
<span class="leftIco hard"></span>
<div class="cont">
<span class="starBox" id="starBox">
<span class="graystar" title="非常简单"></span>
<span class="graystar" title="简单"></span>
<span class="graystar" title="难"></span>
<span class="graystar" title="困难"></span>
<span class="graystar" title="非常困难"></span>
</span>
<span id="showtp"></span>
<div id="star_error"></div>
</div>
</li>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
<li class="mb25">
<span class="leftArea">验证码</span>
<div class="cont">
<input type="text" name="captcha" id="captcha" class="codeNum" />
<a href="#" id="refreshCaptcha" title="点击刷新图片"><img src="/plugin.php?id=dailypicture:captcha" alt="点击刷新图片" /></a>
<input type="hidden" value="" id="yzm" name="yzm">
<span id="jg"></span>
<span class="tips">用户发帖少于3个小时，需要填写验证码</span>
</div>
</li>
<?php } ?>
<li>
<div class="cont"><input <?php if($_G['uid']) { ?>type="submit"<?php } else { ?>type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')"<?php } ?> value="" class="publish182x43"></div>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="replypostsubmit" value="yes">
<input type="hidden" name="subject" value="" />
<input type="hidden" name="starnum" id="form_starNum" value="0" />
</li>
</ul>
</form>
</div>

<?php } ?>
</div>
<div class="layoutRight">

<div><?php echo adshow("custom_269"); ?></div>


<?php if($hotmore) { ?>
<div class="hotArt mt30">
<h2 class="h2Tit">热门</h2>
<div class="bd">
<ul class="hostArtList"><?php $j=1; if(is_array($hotmore)) foreach($hotmore as $fj) { ?><li>
<a href="/forum.php?ctl=<?php echo $modstr;?>&amp;act=showview&amp;tid=<?php echo $fj['tid'];?>" target="_blank"><img src="<?php echo getimagethumb(60, 60, 2, $fj['picpath'], $fj['aid'], $fj['serverid']); ?>" class="pic" /></a>
<div class="text">
<h4><a href="/forum.php?ctl=<?php echo $modstr;?>&amp;act=showview&amp;tid=<?php echo $fj['tid'];?>" title="<?php echo $fj['name'];?>" target="_blank"<?php if($j==1) echo " class=\"cBlue\"";if($j==2||$j==3) echo " class=\"cOrange\""; ?>><?php echo $fj['shortsubjectmore'];?></a></h4>
<p class="starBox"><?php for ($i = 0; $i < 6; $i++): ?><span class="<?php if($i < $fj['score']/2) { if($fj['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; if($fj['score']!='0.0') { ?> <?php echo $fj['score'];?><?php } else { ?> 暂无评分<?php } ?>
</p>
<p class="cmt"><?php echo $fj['replies'];?>参与点评</p>
</div>
<div class="icoBox"><span class="<?php if($j==1) echo "blueIco";if($j==2||$j==3) echo "orangeIco";if($j>3) echo "greyIco"; ?>"></span></div>
</li><?php $j++; } ?>
</ul>
</div>
</div>
<?php } if($listpro) { ?>
<div class="hotArt">
            <h2 class="h2Tit"><?php echo $viewdata['subject'];?>周边山峰</h2>
<div class="bd">
<ul class="hostArtList"><?php $j=1; if(is_array($listpro)) foreach($listpro as $fj) { ?><li>
<a href="/forum.php?ctl=<?php echo $modstr;?>&amp;act=showview&amp;tid=<?php echo $fj['tid'];?>" target="_blank"><img src="<?php echo getimagethumb(60, 60, 2, $fj['picpath']); ?>" class="pic" /></a>
<div class="text">
<h4><a href="/forum.php?ctl=<?php echo $modstr;?>&amp;act=showview&amp;tid=<?php echo $fj['tid'];?>" title="<?php echo $fj['name'];?>" target="_blank"<?php if($j==1) echo " class=\"cBlue\"";if($j==2||$j==3) echo " class=\"cOrange\""; ?>><?php echo $fj['shortsubjectmore'];?></a></h4>
<p class="starBox"><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $fj['score']/2) { if($fj['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; if($fj['score']!='0.0') { ?> <?php echo $fj['score'];?><?php } else { ?> 暂无评分<?php } ?>
</p>
<p class="cmt"><?php echo $fj['replies'];?>参与点评</p>
</div>
</li><?php $j++; } ?>
</ul>
</div>
</div>
<?php } if($listpro) { ?>
<div class="sameArea" style="display: none;">
<h2 class="h2Tit">同地区</h2>
<ul class="artLRList"><?php $i=1; if(is_array($listpro)) foreach($listpro as $fj) { ?><li>
<span class="tit">
<a href="/forum.php?ctl=<?php echo $modstr;?>&amp;act=showview&amp;tid=<?php echo $fj['tid'];?>" target="_blank"<?php if($i==1) echo " class=\"cOrange\"";if($i==2||$i==3) echo " class=\"cBlue\""; ?>><?php echo $fj['shortsubject'];?></a>
</span>
<span class="right"><?php for ($m = 0; $m < 5; $m++): ?><span class="<?php if($m < $fj['score']/2) { if($fj['score']/2-$m<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; ?></span>
</li><?php $i++; } ?>
</ul>
</div>
<?php } ?>
</div>
</div>

<div class="popBox" id="box_view">
<div class="bd">
<div class="popWriteCmt">
<h2>
<span class="tit">修改点评</span>

</h2>
<div style="color: red; display: none;" id="bv_error"></div>
<form method="post" autocomplete="off" id="postform" action="<?php echo $url;?>&act=dopost&do=reply&ext=edit&page=<?php echo $_G['page'];?>&tid=<?php echo $_G['tid'];?>">
<ul class="writeGoodBad">
<li class="mb30">
<span class="leftIco date2">
<img src="static/images/dianping/date.jpg">
</span>
<div class="cont post">
<input name="datapicker[]" readonly class="timeText datapicker startPicker" onclick="showcalendar(event, this, '', '', '', 28);" onchange="changeDate()"/> --- <input name="datapicker[]" readonly class="timeText datapicker endPicker" onclick="showcalendar(event, this, '', '', '', 28);"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input name="datapicker[]" class="timeText timeHour dataHour startHour" maxlength="2"/><span class="timeHour">时 --- </span><input name="datapicker[]" class="timeText timeHour dataHour endHour" maxlength="2"/><span class="timeHour">时</span>
<span id="f_startTip"></span>
</div>
</li>


<li class="mb30">
<span class="leftIco  cost"></span>
<div class="cont">
<label class="fs14"></label>
<textarea name="f_pricedesc" rows="2" class="line3Area" id="f_pricedesc"></textarea>
<div id="f_pricedescTip"></div>
</div>
</li>


<li class="mb30">
<span class="leftIco suggest"></span>
<div class="cont">
<label class="fs14"></label>
<textarea name="f_comment" rows="2" class="line3Area" id="f_comment"></textarea>
<div id="f_commentTip"></div>
</div>
</li>

<li class="mb18">
<span class="leftIco summary"></span>
<div class="cont">
<label class="fs14"></label>
<textarea name="message" id="f_message" rows="6" class="line5Area "></textarea>
<div id="f_messageTip"></div>
</div>
</li>

<li class="mb30" style="z-index: 50;">
<span class="leftIco hard"></span>
<div class="cont">
<span class="starBox" id="bv_starBox">
<span class="graystar" title="非常简单"></span>
<span class="graystar" title="简单"></span>
<span class="graystar" title="难"></span>
<span class="graystar" title="困难"></span>
<span class="graystar" title="非常困难"></span>
</span>
<span class="starTextTips"></span>
<input type="hidden" name="" id="bv_starNum" value="0" />
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
<script>
var tta = document.getElementsByTagName('textarea');
for(var i=0; i<tta.length; i++){
if(!isUndefined(tta[i].id)){
loadUnloginData(tta[i].id + tid, tta[i].id);
}
}
</script>
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
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>" class="bbsli" title="返回山峰首页"></a></li>
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
//_showmsg("攀登的"+sign+"时间需小于当前时间");
show_errors("date_error", "攀登的"+sign+"时间需小于当前时间")
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
datapicker[0].blur();
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
//_showmsg("攀登的结束时间需大于开始时间");
show_errors("date_error", "攀登的结束时间需大于开始时间")
var tttt = setInterval(function(){
var div_black = document.getElementById("div_black");
if (div_black.style.display == "none") {
clearInterval(tttt);
obj.click();
}
},200);
return false;
}
if (intStartTime && intEndTime  && parentObj.className.indexOf("post") != -1){
var temp = Math.ceil((intEndTime - intStartTime)/ 86400);
//alert(document.getElementById("f_startTip").innerHTML);
if(temp>60){
obj.value = "";
//_showmsg("攀登周期不得超过60天");
show_errors("date_error", "攀登周期不得超过60天")
var tttt = setInterval(function(){
var div_black = document.getElementById("div_black");
if (div_black.style.display == "none") {
clearInterval(tttt);
obj.click();
}
},200);
return false;
}else{
document.getElementById("f_startTip").innerHTML="";
document.getElementById("f_startTip").innerHTML="共用 "+temp+" 天";
if( parentObj.className.indexOf("post") != -1) {
   intStartTime == intEndTime ? jQuery('#date_error').html('') : jQuery('#date_error').html('<div class="correct"></div>');
}
}
}
}

//化为时间戳
function getNumberTime(time){
time 		= time.replace(/-/g,"/");
var date 	= new Date(time);
time 		= Math.floor(date.getTime()/1000);
return time;
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

<style type="text/css">
.friendLink { background:#0f1f2b; padding: 15px 0; font: 12px/20px "Microsoft Yahei"; margin-top:20px; margin:0 auto;}
.friendLinkcon{ width:980px; margin:0 auto;}
.friendLink span{ display:block; font-size:16px; line-height:18px; padding-bottom: 5px; color:#807f7f;}
.friendLink a { color: #807f7f; margin-right: 10px; display: inline; white-space: nowrap; text-decoration:none;}
.friendLink a:hover { color: #FFF; }
</style>
<div class="friendLink">
<!--[diy=linkmore]--><div id="linkmore" class="area"><div id="frameEfYZpz" class=" frame move-span cl frame-1"><div id="frameEfYZpz_left" class="column frame-1-c"><div id="frameEfYZpz_left_temp" class="move-span temp"></div><?php block_display('6991'); ?></div></div></div><!--[/diy]-->
</div><div class="layout mt30"></div><?php $this->myoutput(); ?><style>
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
        
        	<div style=" display:none;">
                <div class="zhidemaititle_y"><img src="http://static.8264.com/static/images/coupon/slogen.png"></div>
                <?php echo adshow("custom_472"); ?>                <div class="zhidemaimorelink"><a href="http://pianyi.8264.com/goods/list-jiu-cid-10027.html" target="_blank">查看更多优惠券产品></a></div>
            </div>
            <a href="https://s.click.taobao.com/dcxaFhw" target="_blank"><img src="http://static.8264.com/static/ad/782-498.jpg"/></a>
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
<!--广告结束-->
<?php } ?>


</body>
</html><?php output(); ?>