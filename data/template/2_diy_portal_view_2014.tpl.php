<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('view_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/portal/view_2014.htm', './template/8264/common/header_8264_new.htm', 1509517885, 'diy', './data/template/2_diy_portal_view_2014.tpl.php', './template/8264', 'portal/view_2014')
|| checktplrefresh('./template/8264/portal/view_2014.htm', './template/8264/common/zhidemai.htm', 1509517885, 'diy', './data/template/2_diy_portal_view_2014.tpl.php', './template/8264', 'portal/view_2014')
|| checktplrefresh('./template/8264/portal/view_2014.htm', './template/8264/common/camel_ad.htm', 1509517885, 'diy', './data/template/2_diy_portal_view_2014.tpl.php', './template/8264', 'portal/view_2014')
|| checktplrefresh('./template/8264/portal/view_2014.htm', './template/8264/common/footer_8264_new.htm', 1509517885, 'diy', './data/template/2_diy_portal_view_2014.tpl.php', './template/8264', 'portal/view_2014')
|| checktplrefresh('./template/8264/portal/view_2014.htm', './template/8264/common/header_common.htm', 1509517885, 'diy', './data/template/2_diy_portal_view_2014.tpl.php', './template/8264', 'portal/view_2014')
|| checktplrefresh('./template/8264/portal/view_2014.htm', './template/8264/common/index_ad_top.htm', 1509517885, 'diy', './data/template/2_diy_portal_view_2014.tpl.php', './template/8264', 'portal/view_2014')
;
block_get('6918,6921,6905');?>
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
<?php if($_GET['aid'] == 98960) { ?>
<style>
html {
filter:progid:DXImageTransForm.Microsoft.BasicImage(grayscale=1);
overflow-y:scroll;
-webkit-filter: grayscale(100%);
-moz-filter: grayscale(100%);
-ms-filter: grayscale(100%);
-o-filter: grayscale(100%);
filter: grayscale(100%);
filter: gray;
}
.ad_border{}
body {filter:gray}
</style>
<?php } ?>


<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/view.css?<?php echo VERHASH;?>" />
<style id="diy_style" type="text/css">#frameB4Qi5t {  margin:0px !important;border:0px none !important;}#portal_block_6918 {  margin:0px !important;border:0px none !important;}#portal_block_6918 .content {  margin:0px !important;}#frame4ro1Jb {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6921 {  margin:0px !important;border:none !important;}#portal_block_6921 .content {  margin:0px !important;}#frameY1sqdf {  margin:0px !important;border:none !important;}#portal_block_6966 {  margin:0px !important;border:none !important;}#portal_block_6966 .content {  margin:0px !important;}</style>
<script src="http://static.8264.com/static/js/forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
zoomstatus = parseInt(<?php echo $_G['setting']['zoomstatus'];?>), imagemaxwidth = '<?php echo IMAGEMAXWIDTH;?>', aimgcount = new Array();
jQuery(document).ready(function($){
$("#sidebar>a").hover(function(){
$(this).addClass("zhong").siblings().removeClass("zhong");
$("#sidebox>div").eq($(this).index()).show().siblings().hide();
});
var c_all=<?php echo $article['commentnum'];?>;
var c_count=$("#commentlist>li").length;
$("#more_cbtn").click(function(){
var c_show=$("#commentlist>li:visible").length;
if(c_count-c_show>0){
for(i=-1;i<33;i++){
$("#commentlist>li").eq(c_show+i).show();
}
if($("#commentlist>li:visible").length == c_count){
if(c_count == c_all){
$("#more_cbtn").text("没有更多评论了").unbind("click");
}
}
} else {
$("#more_clink").click();
}
});
$("#message").focus(function(){
if($(this).hasClass('t_note')){
$(this).removeClass('t_note');
$(this).val("");
}
}).blur(function(){
if($.trim($(this).val())==""){
$(this).addClass('t_note');
$(this).val("说点什么吧...");
}
});
});
</script>

<?php if($_G['groupid']=='1') { ?>
<script type="text/javascript">
function change_state(obj){
var aid = obj.id;
var state = obj.value;

var url = 'portal.php?mod=portalcp&ac=article&op=duestate&catid=<?php echo $_GET['catid'];?>&aid='+aid+'&state='+state;

jQuery.ajax({
type : 'GET',
url : url,
success:function(flag){
if(flag == 1){
if(state == 1){
jQuery("#"+aid).val("0").prev().css('text-decoration','none');
}else{
jQuery("#"+aid).val("1").prev().css('text-decoration','line-through');
}
}else{
alert("操作失败！");
}
}
});
}
</script>
<?php } ?>

<div class="w980 pt10">
    <div style="margin: 0 auto 5px auto;">
    	<div style="display:none;"><?php $bottom_ads = array('416', '409', '417'); $bottom_ad = rand(0, 2); $bottom_ad_id = $bottom_ads[$bottom_ad]; ?><?php echo adshow("custom_$bottom_ad_id"); ?></div>
<!-- 值得买 -->
        <?php include(DISCUZ_ROOT.'./source/plugin/skiing/hd_zw.php'); ?>        <?php $zhidemai_list = ForumOptionHuoDong::pianyi_sidebar(6, 'top', 'jiu', '10027'); ?>        <?php if($zhidemai_list) { ?>
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


<div class="clear_b pt10">
<div class="l_660">
<div class="fl_dh" style=" position:relative;">
<a href="http://www.8264.com/" class="syq">首页</a><?php if(is_array($cat['ups'])) foreach($cat['ups'] as $value) { ?><a href="http://www.8264.com/list/<?php echo $value['catid'];?>/" class="syq"><?php echo $value['catname'];?> </a>
<?php } ?>
<a href="http://www.8264.com/list/<?php echo $cat['catid'];?>/" class="dpdq"><?php echo $cat['catname'];?></a>
<a href="<?php echo $_G['config']['web']['portal'];?>viewnews-<?php echo $article['aid'];?>-page-1.html" class="zpdq"><?php echo $article['title'];?></a>
                <style>
.kongad{ width:50px; height:25px; display:block; position:absolute; top:0px; right:0px; z-index:10;}
.fl_dh div{ display:none;}
                </style>
                <div style="line-height:0px; height:0px; font-size:0px; clear:both;"></div>
</div>
<h1 class="titlebig">
<?php echo $article['title'];?>
<?php if($article['status'] == 1) { ?>
(待审核)
<?php } elseif($article['status'] == 2) { ?>
(已忽略)
<?php } if(in_array($_GET['catid'], array('867', '958', '959', '960', '961', '962', '963', '964', '965')) && $_G['groupid']=='1') { ?>
&nbsp;&nbsp;<input name="checkbox" type="checkbox" id="<?php echo $article['aid'];?>" value="<?php echo $article['duestate'];?>" onclick="change_state(this)" <?php if($article['duestate']) { ?> checked="checked" <?php } ?> />
<?php } ?>

</h1>
<div class="newsinfo">
<?php if($article['from']) { ?>
来源：
<?php if($article['fromurl']) { ?>
<a href="<?php echo $article['fromurl'];?>" target="_blank"><?php echo $article['from'];?></a>
<?php } else { ?>
<span><?php echo $article['from'];?></span>
<?php } } ?>
作者：
<?php if($article['author']) { ?>
<span><?php echo $article['author'];?></span>
<?php } else { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $article['uid'];?>"><?php echo $article['username'];?></a>
<?php } ?>
添加时间：<span><?php echo $article['dateline'];?></span>

<?php if($_G['group']['allowmanagearticle'] || ($_G['group']['allowpostarticle'] && $article['uid'] == $_G['uid'] && (empty($_G['group']['allowpostarticlemod']) || $_G['group']['allowpostarticlemod'] && $article['status'] == 1)) || $categoryperm[$value['catid']]['allowmanage']) { ?>
<script src="http://static.8264.com/static/js/pushoriginaltobaidu.js" type="text/javascript" type="text/javascript"></script>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;op=edit&amp;aid=<?php echo $article['aid'];?>&amp;page=<?php echo $_GET['page'];?>">编辑</a>
<?php if($article['status']> 0 && ($_G['group']['allowmanagearticle'] || $categoryperm[$value['catid']]['allowmanage'])) { ?>
<span>|</span><a href="portal.php?mod=portalcp&amp;ac=article&amp;op=verify&amp;aid=<?php echo $article['aid'];?>" id="article_verify_<?php echo $article['aid'];?>" onClick="showWindow(this.id, this.href, 'get', 0);">审核</a>
<?php } else { ?>
<span>|</span><a href="portal.php?mod=portalcp&amp;ac=article&amp;op=delete&amp;aid=<?php echo $article['aid'];?>" id="article_delete_<?php echo $article['aid'];?>" onClick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<?php } ?>
<span>|</span><a href="javascript:;" onclick="pushOriginalToBaidu();">推到百度原创</a>
<?php } ?>
</div>





<div>
            <?php echo adshow("custom_450"); ?></div>
<div class="newscon">
<?php if(file_exists(DISCUZ_ROOT.'./source/plugin/articlekeywords/include.php')) { ?><?php require_once DISCUZ_ROOT.'./source/plugin/articlekeywords/include.php'; ?><?php $articleKeywords = new ArticleKeywords(); ?><?php echo $articleKeywords->parseArticle($content[content]); } else { ?>
<?php echo $content['content'];?>
<?php } ?>
<div class="artPage clear_b"><?php if($multi) { ?><?php echo $multi;?><?php } ?></div>
</div>

            <div style="padding:0px 0px 30px 0px; text-align:center;"><img src="http://static.8264.com//static/images/moban/1024newslw/images/newewm.png" width="180"><img src="http://static.8264.com/static/images/moban/1024newslw/images/newewm2.png" width="180"></div>
<?php if($article['related']) { ?>
<div class="title_l_r clear_b"><span class="l">感兴趣的文章</span></div>
<div class="interest clear_b">
<ul><?php if(is_array($article['related'])) foreach($article['related'] as $value) { ?><li><a title="<?php echo $value['title'];?>" target="_blank" href="viewnews-<?php echo $value['aid'];?>-page-1.html?from=view"><?php echo $value['title'];?></a></li>
<?php } ?>
</ul>
</div>
<?php } ?>
            <div style="margin:10px 0;">
           <?php echo adshow("custom_344"); ?>            </div>
<div style="margin:10px 0; position:relative; width:660px; overflow:hidden; display:none;">
<!-- 广告位：文章详细_戈尔 404-->
<script type='text/javascript'><!--//<![CDATA[
                   var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
                   var m3_r = Math.floor(Math.random()*99999999999);
                   if (!document.MAX_used) document.MAX_used = ',';
                   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
                   document.write ("?zoneid=56");
                   document.write ('&amp;cb=' + m3_r);
                   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
                   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
                   document.write ("&amp;loc=" + escape(window.location));
                   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
                   if (document.context) document.write ("&context=" + escape(document.context));
                   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
                   document.write ("'><\/scr"+"ipt>");
                //]]>--></script>
                <span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
</div>
<div class="read_box">
<script type="text/javascript">
var uid = <?php echo $_G['uid'];?> ? <?php echo $_G['uid'];?> : 0;
var aid =<?php echo $_GET['aid'];?>;
var title ="<?php echo $article['title'];?>";
var url = "http://www.8264.com/viewnews-<?php echo $_GET['aid'];?>-page-1.html";
var pic = "<?php echo $article['pic'];?>";
if(pic=='http://bbs.8264.com/data/attachment/portal/'||pic=='http://image.8264.com/portal/'||pic.match(/^http:\/\/image1\.8264\.com\/(portal|forum)\/(!t\d+(w\d+h\d+)?(x\d+m\d+)?)?$/i) != null||pic==''){
pic = 'http://static.8264.com/static/image/common/nopic.gif';
}
var cat =new Array();
cat[0] = "<?php echo $cat['catname'];?>";
cat[1] = "<?php echo getportalcategoryurl($cat['catid']); ?>";
var cat1 = new Array();<?php if(is_array($cat['ups'])) foreach($cat['ups'] as $value) { ?>cat1[0] = "<?php echo $value['catname'];?>";
cat1[1] = "<?php echo getportalcategoryurl($value['catid']); ?>";
<?php } ?>
var   arr   =   new   Array();
arr[0] = cat;
arr[1] = cat1;
var catname = new Array();
catname[0]= cat1[0];
catname[1]= "<?php echo $cat['catname'];?>";
window["_BFD"] = window["_BFD"] || {};
_BFD.BFD_INFO = {
user_id : uid,	// 当前用户的user_id，string类型。注意：user_id不是用户的真实注册名，而是其注册名的编号,未登录用户统一使用0或者空值'';
iid : aid,  	//文章的id号
title : title,  			//当前文章的名称，string类型；
url : url,		// 当前文章的完整链接url，string类型
imgSrc : pic,//文章的缩略图
category : catname, 	// 当前文章的完整类别名称，一维数组
categoryDetail : arr//当前文章的完整类别名称和链接，二维数组
};
_BFD.script = document.createElement("script");
_BFD.script.type = 'text/javascript';
_BFD.script.async = true;
_BFD.script.charset = 'utf-8';
_BFD.script.src = (('https:' == document.location.protocol?'https://ssl-static1':'http://static1')+'.baifendian.com/service/huwaiziliao/hwzl_article.js');
document.getElementsByTagName("head")[0].appendChild(_BFD.script);
</script>
</div>
<?php if($article['allowcomment']==1) { ?>
<div class="hf_w">
<form id="cform" name="cform" action="<?php echo $form_url;?>" method="post" autocomplete="off" onsubmit="if(jQuery('#message').hasClass('t_note')||jQuery.trim(jQuery('#message').val())==''){return false;}">
<input type="hidden" name="portal_referer" value="portal.php?mod=view&amp;aid=<?php echo $aid;?>#comment">
<input type="hidden" name="aid" value="<?php echo $aid;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
<input type="hidden" name="replysubmit" value="true">
<input type="hidden" name="referer" value="portal.php?mod=view&amp;aid=<?php echo $aid;?>#comment" />
<input type="hidden" name="id" value="<?php echo $article['id'];?>" />
<input type="hidden" name="idtype" value="<?php echo $article['idtype'];?>" />
<input type="hidden" name="commentsubmit" value="true" />

<div class="hf">
<textarea name="message" rows="3" class="hf_textarea t_note" id="message" onkeydown="ctrlEnter(event, 'commentsubmit_btn');">说点什么吧...</textarea>
</div>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF

<sec><span id="sec<hash>" onclick="showMenu(this.id);"><sec></span>
<div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>

EOF;
?>
<div class="mtm mtm1 twyzm clear_b"><?php include template('common/seccheck'); ?></div>
<?php } ?>
<button type="submit" name="commentsubmit_btn" id="commentsubmit_btn" value="true" class="hfbutton">发布</button>
<!-- 手机绑定提示 -->
<?php if(!$_G['member']['telstatus']) { ?>
<style type="text/css">.tips-binding__inside{background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:4px 0 0 10px;font-size:14px;color:#585858}.tips-binding__inside a{color:#ff7038;font-size:14px}.tips-binding__inside a:hover{color:#ff7038;font-size:14px}</style>
<span class="tips-binding__inside">注：评论操作需绑定手机，<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">去绑定>></a></span>
<?php } ?>
<!-- //手机绑定提示 -->
</form>
</div>
<?php } ?>
<div class="pt25" id="comment">
<div class="title_l_r clear_b">
<span class="l">网友评论</span>
</div>
<?php if($commentlist) { ?>
<div class="pinluncon">
<ul id="commentlist"><?php $n=1; if(is_array($commentlist)) foreach($commentlist as $comment) { ?><li<?php if($n>33) { ?> style="display:none;"<?php } ?>>
<a name="comment_anchor_<?php echo $comment['cid'];?>"></a>
<?php if(!empty($comment['uid'])) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['uid'];?>" class="touxiang48"><?php echo $comment['avatar'];?></a>
<?php } ?>
<div class="pinglun_r">
<div class="pl_info_cz">
<span class="l">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['uid'];?>"><?php echo $comment['username'];?></a>
<span class="jgd">&#8226;</span>
<span><?php echo dgmdate($comment[dateline]); ?></span>
</span>
<?php if($comment['allowop']) { ?>
<span class="r">
<a href="javascript:;" onclick="portal_comment_requote(<?php echo $comment['cid'];?>);">引用</a>
<?php if(($_G['group']['allowmanagearticle'] || $_G['uid'] == $comment['uid']) && $_G['groupid'] != 7) { ?>
<a href="portal.php?mod=portalcp&amp;ac=comment&amp;op=edit&amp;cid=<?php echo $comment['cid'];?>" id="c_<?php echo $comment['cid'];?>_edit" onclick="showWindow(this.id, this.href, 'get', 0);">编辑</a>
<a href="portal.php?mod=portalcp&amp;ac=comment&amp;op=delete&amp;cid=<?php echo $comment['cid'];?>" id="c_<?php echo $comment['cid'];?>_delete" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<?php } ?>
</span>
<?php } ?>
</div>
<div class="pl_con">
<span><?php if($_G['adminid']==1 || $comment['uid']==$_G['uid'] || $comment['status']==0) { ?><?php echo $comment['message'];?><?php } else { ?>审核未通过<?php } ?></span>
</div>
</div>
</li>
<?php if(!empty($aimgs[$comment['cid']])) { ?>
<script type="text/javascript" reload="1">
aimgcount[<?php echo $comment['cid'];?>] = [<?php echo implode(',', $aimgs[$comment['cid']]);; ?>];attachimgshow(<?php echo $comment['cid'];?>);
</script>
<?php } ?><?php $n++; } ?>
</ul>
</div>
<?php if($article['commentnum'] > 33) { ?>
<div class="ckplmore" id="more_cbtn">查看更多评论</div>
<?php } } else { ?>
<div class="no_comment">
<img src="http://static.8264.com/static/images/portal/sofa.jpg" border="0"><br>
还没有评论，沙发等你来抢
</div>
<?php } ?>
</div>
</div>
<div class="r_260">
<div style=" position:relative;">
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=91");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script>
<span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
</div>

<div class="dslink ad_border" style="position:relative; display:none;"><?php echo adshow("custom_452"); ?><span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px; line-height:0px;"><img

src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span></div>

            <div class="dslink ad_border " style="position:relative; display:none;"><?php echo adshow("custom_23"); ?><span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px; line-height:0px;"><img

src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span></div>
<div  class="mt20" style=" position:relative; "><?php echo adshow("custom_474"); ?><span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
</div>

      <!--JD广告开始-->
      <!-- common/adv_jd_250 -->      <!--JD广告结束-->

<div class="mt20">
<div class="title_l_r clear_b"><span class="l">推荐文章</span></div>
<!--[diy=diybjtj]--><div id="diybjtj" class="area"><div id="frameB4Qi5t" class=" frame move-span cl frame-1"><div id="frameB4Qi5t_left" class="column frame-1-c"><div id="frameB4Qi5t_left_temp" class="move-span temp"></div><?php block_display('6918'); ?></div></div></div><!--[/diy]-->
</div>

<div class="mt20">
<div class="title_l_r clear_b"><span class="l">8264活动</span><a href="http://hd.8264.com/" class="ra">更多</a></div>
<style type="text/css">
.hd-external{background:url(http://static.8264.com/static/images/portal/hdxbg.jpg) no-repeat;width:260px;height:370px;}
.hd-external .left-wonderful{width:74px;float:left;}
.left-wonderful li{border-top:1px solid #f4e971;border-bottom:1px solid #cdbd0a;height:72px;text-align:center;}
.left-wonderful li.first{border-top:0 none;}
.left-wonderful li.last{border-bottom:0 none;}
.left-wonderful li a{font-size:12px;color:#000;display:block;overflow:hidden;}
.left-wonderful li a:hover{text-decoration:none;}
.left-wonderful i{background:url(http://static.8264.com/static/images/portal/exnal-play.png) no-repeat;width:30px;height:30px;display:block;margin: 12px auto 0;}
.left-wonderful i.icon-hiking{background-position:0 6px;}
.left-wonderful i.icon-camping{background-position:0 -66px;}
.left-wonderful i.icon-diving{background-position:0 -140px;}
.left-wonderful i.icon-climbing{background-position:0 -214px;}
.left-wonderful i.icon-training{background-position:0 -288px;}
.hd-external .right-list{padding:20px 10px 0 22px;overflow:hidden;}
.right-list li{float:left;padding-right:14px;padding-bottom:7px;}
.right-list li a{color:#d2d2d2;font-size:14px}
.right-list li a:hover{text-decoration:none;}
</style>
<div class="hd-external">
<ul class="left-wonderful">
<li class="first">
<a href="http://hd.8264.com/xianlu-4-0-0-0-1-1" target="_blank" title="徒步"><i class="icon-hiking"></i>徒步</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-7-0-0-0-1-1" target="_blank" title="露营"><i class="icon-camping"></i>露营</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-16-0-0-0-1-1" target="_blank" title="潜水"><i class="icon-diving"></i>潜水</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-51-0-0-0-1-1" target="_blank" title="登山"><i class="icon-climbing"></i>登山</a>
</li>
<li class="last">
<a href="http://hd.8264.com/xianlu-48-0-0-0-1-1" target="_blank" title="培训"><i class="icon-training"></i>培训</a>
</li>
</ul>
<ul class="right-list">
<li>
<a href="http://hd.8264.com/xianlu-52-0-0-0-1-1" target="_blank" title="攀岩">攀岩</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-78-0-0-0-1-1" target="_blank" title="亲子">亲子</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-70-0-0-0-1-1" target="_blank" title="真人CS">真人CS</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-85-0-0-0-1-1" target="_blank" title="越野">越野</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-11-0-0-0-1-1" target="_blank" title="包车">包车</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-62-0-0-0-1-1" target="_blank" title="皮划艇">皮划艇</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-5-0-0-0-1-1" target="_blank" title="骑行">骑行</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-36-0-0-0-1-1" target="_blank" title="飞行">飞行</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-76-0-0-0-1-1" target="_blank" title="热气球">热气球</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-79-0-0-0-1-1" target="_blank" title="沙漠">沙漠</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-69-0-0-0-1-1" target="_blank" title="射箭">射箭</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-60-0-0-0-1-1" target="_blank" title="高尔夫">高尔夫</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-9-0-0-0-1-1" target="_blank" title="摄影">摄影</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-72-0-0-0-1-1" target="_blank" title="溯溪">溯溪</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-59-0-0-0-1-1" target="_blank" title="滑翔伞">滑翔伞</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-71-0-0-0-1-1" target="_blank" title="漂流">漂流</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-63-0-0-0-1-1" target="_blank" title="骑马">骑马</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-75-0-0-0-1-1" target="_blank" title="马拉松">马拉松</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-13-0-0-0-1-1" target="_blank" title="海钓">海钓</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-61-0-0-0-1-1" target="_blank" title="邮轮">邮轮</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-50-0-0-0-1-1" target="_blank" title="越野跑">越野跑</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-83-0-0-0-1-1" target="_blank" title="转山">转山</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-67-0-0-0-1-1" target="_blank" title="速降">速降</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-45-0-0-0-1-1" target="_blank" title="深度游">深度游</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-66-0-0-0-1-1" target="_blank" title="帆船">帆船</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-73-0-0-0-1-1" target="_blank" title="浮潜">浮潜</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-68-0-0-0-1-1" target="_blank" title="实弹射击">实弹射击</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-53-0-0-0-1-1" target="_blank" title="冲浪">冲浪</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-64-0-0-0-1-1" target="_blank" title="探洞">探洞</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-74-0-0-0-1-1" target="_blank" title="风筝冲浪">风筝冲浪</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-77-0-0-0-1-1" target="_blank" title="蹦极">蹦极</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-82-0-0-0-1-1" target="_blank" title="跳伞">跳伞</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-6-0-0-0-1-1" target="_blank" title="滑雪">滑雪</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-54-0-0-0-1-1" target="_blank" title="狩猎">狩猎</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-58-0-0-0-1-1" target="_blank" title="房车">房车</a>
</li>
<li>
<a href="http://hd.8264.com/xianlu-80-0-0-0-1-1" target="_blank" title="帆板">帆板</a>
</li>
</ul>
</div>
</div>

<div class="mt20" style="display:none;">
<div class="title_l_r clear_b"><span class="l">徒步路线</span><a href="http://www.columbiasports.cn/campaign/" class="ra" target="_blank">更多</a></div>
<!--[diy=xltjxz]--><div id="xltjxz" class="area"><div id="frame4ro1Jb" class=" frame move-span cl frame-1"><div id="frame4ro1Jb_left" class="column frame-1-c"><div id="frame4ro1Jb_left_temp" class="move-span temp"></div><?php block_display('6921'); ?></div></div></div><!--[/diy]-->
</div>
<div class="gnlistwarpten pt20">
<div class="gnlist clear_b">
<a href="<?php echo $_G['config']['web']['portal'];?>list/842" target="_blank" class="mryt"></a>
<a href="<?php echo $_G['config']['web']['portal'];?>pp" target="_blank" class="kqmg"></a>
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei" target="_blank" class="zbtj"></a>
<a href="<?php echo $_G['config']['web']['portal'];?>list/880" target="_blank" class="yzxx"></a>
<a href="http://www.8264.com/xianlu" target="_blank" class="xltj"></a>
<a href="<?php echo $_G['config']['web']['portal'];?>list/871" target="_blank" class="ltjx"></a>
</div>
</div>
<div class="pt20">
<div class="title_l_r clear_b title_l_r_bt_n"><span class="l">口碑排行榜</span></div>
<div class="q_warpten" id="sidebar">
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei.html" target="_blank" class="zhong">装备库</a>
<a href="<?php echo $_G['config']['web']['portal'];?>pinpai" target="_blank">品牌</a>
<a href="<?php echo $_G['config']['web']['portal'];?>xianlu" target="_blank">线路</a>
<a href="<?php echo $_G['config']['web']['portal'];?>xuechang" target="_blank" class="end">滑雪场</a>
</div>
<div class="dpcon" id="sidebox">
<div class="hxc">
<ul><?php if(is_array($zb_list)) foreach($zb_list as $zb) { ?><li>
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei-<?php echo $zb['tid'];?>-1.html" class="xcimg" target="_blank" title="<?php echo $zb['subject'];?>"><img src="<?php echo getimagethumb(60,60,2,$zb['picpath'],$zb['aid'],$zb['serverid']); ?>"/></a>
<div class="xc_r">
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei-<?php echo $zb['tid'];?>-1.html" target="_blank" title="<?php echo $zb['subject'];?>"><?php echo $zb['subject'];?></a>
<div class="starwarpten">
<?php if($zb['score']!='0.0') { ?><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $zb['score']/2) { if($zb['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; ?><span class="fs"><?php echo $zb['score'];?></span>
<?php } else { ?>
<span class="no">暂无评分</span>
<?php } ?>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
<div class="hxc brand" style="display:none">
<ul><?php if(is_array($pp_list)) foreach($pp_list as $pp) { ?><li>
<a href="<?php echo $_G['config']['web']['portal'];?>pinpai-<?php echo $pp['tid'];?>" class="brand" target="_blank" title="<?php echo $pp['subject'];?>"><img src="http://image1.8264.com/<?php echo $pp['dir'];?>/<?php echo $pp['showimg'];?>" /></a>
<div class="xc_r brand_r">
<a href="<?php echo $_G['config']['web']['portal'];?>pinpai-<?php echo $pp['tid'];?>" target="_blank" title="<?php echo $pp['subject'];?>"><?php echo $pp['subject'];?></a>
<div class="starwarpten">
<?php if($pp['score']!='0.0') { ?><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $pp['score']/2) { if($pp['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; ?><span class="fs"><?php echo $pp['score'];?></span>
<?php } else { ?>
<span class="no">暂无评分</span>
<?php } ?>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
<div class="hxc dp" style="display:none">
<ul><?php if(is_array($xl_list)) foreach($xl_list as $xl) { ?><li>
<div class="xc_r dp_r">
<a href="<?php echo $_G['config']['web']['portal'];?>xianlu-<?php echo $xl['tid'];?>" target="_blank" title="<?php echo $xl['subject'];?>"><?php echo $xl['subject'];?></a>
<div class="starwarpten">
<?php if($xl['score']!='0.0') { ?><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $xl['score']/2) { if($xl['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; ?><span class="fs"><?php echo $xl['score'];?></span>
<?php } else { ?>
<span class="no">暂无评分</span>
<?php } ?>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
<div class="hxc" style="display:none">
<ul><?php if(is_array($xc_list)) foreach($xc_list as $xc) { ?><li>
<a href="<?php echo $_G['config']['web']['portal'];?>xuechang-<?php echo $xc['tid'];?>" class="xcimg" target="_blank" title="<?php echo $xc['subject'];?>"><img src="<?php echo getimagethumb(60,60,2,$xc['picpath'],$xc['aid'],$xc['serverid']); ?>"/></a>
<div class="xc_r">
<a href="<?php echo $_G['config']['web']['portal'];?>xuechang-<?php echo $xc['tid'];?>" target="_blank" title="<?php echo $xc['subject'];?>"><?php echo $xc['subject'];?></a>
<div class="starwarpten">
<?php if($xc['score']!='0.0') { ?><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $xc['score']/2) { if($xc['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; ?><span class="fs"><?php echo $xc['score'];?></span>
<?php } else { ?>
<span class="no">暂无评分</span>
<?php } ?>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer" style="position:relative;">
<div class="layout" style="padding: 20px 0px 26px 0px; position:relative">
<div class="topHill">顶部小山</div>
<div class="choiceness"><?php block_display('6905'); ?></div>
</div>
    <?php echo adshow("custom_443"); ?><div class="share_bd_warpten">
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
<li><a href="http://www.8264.com/list/<?php echo $article['catid'];?>/" class="bbsli" title="返回列表"></a></li>
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
<!-- Baidu Button END --></div>
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