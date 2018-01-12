<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/portal/index.htm', './template/8264/common/header_8264_new.htm', 1509517866, 'diy', './data/template/2_diy_portal_index.tpl.php', 'data/diy', 'portal/index')
|| checktplrefresh('./template/8264/portal/index.htm', './template/8264/common/zhidemai.htm', 1509517866, 'diy', './data/template/2_diy_portal_index.tpl.php', 'data/diy', 'portal/index')
|| checktplrefresh('./template/8264/portal/index.htm', './template/8264/common/header_common.htm', 1509517866, 'diy', './data/template/2_diy_portal_index.tpl.php', 'data/diy', 'portal/index')
|| checktplrefresh('./template/8264/portal/index.htm', './template/8264/common/index_ad_top.htm', 1509517866, 'diy', './data/template/2_diy_portal_index.tpl.php', 'data/diy', 'portal/index')
;
block_get('7111,6997,7113,7114,7132,7133,7134');?>
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
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/index2017.css">
<script src="http://static.8264.com/static/js/index_2017.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script>
<style id="diy_style" type="text/css">#portal_block_6 .content a {  color:#369 !important;}#portal_block_7 .content {  font-size:14px !important;}#portal_block_15 .content {  font-size:14px !important;}#portal_block_17 .content {  font-size:14px !important;}#portal_block_18 .content {  font-size:14px !important;}#portal_block_19 .content {  font-size:14px !important;}#portal_block_486 {  border:#ccc 1px solid !important;}#portal_block_486 .content {  margin:10px !important;}#portal_block_29 {  border:#ccc 1px solid !important;}#portal_block_29 .content {  margin:5px 5px 5px 15px !important;}#portal_block_30 {  border:#ccc 1px solid !important;}#portal_block_30 .content {  margin:10px !important;}#portal_block_14 .content a {  font-size:14px !important;}#portal_block_35 .content a {  color:#369 !important;}#portal_block_36 {  border:#cccccc 1px solid !important;}#portal_block_36 .content {  margin:5px !important;}#portal_block_37 .content {  font-size:14px !important;}#portal_block_38 .content {  font-size:14px !important;}#portal_block_47 .content a {  color:#369 !important;}#portal_block_50 .content a {  color:#369 !important;}#portal_block_51 {  border:#cccccc 1px solid !important;}#portal_block_51 .content {  margin:0px 10px 10px !important;}#portal_block_54 .content {  font-size:14px !important;}#portal_block_53 .content {  font-size:14px !important;}#frameu5gjz {  margin-left:10px !important;margin-right:10px !important;border:#ccc 1px solid !important;}#frameZfzgjw {  background-color:#f5f5f5 !important;margin-bottom:0px !important;border-top:#cccccc 1px solid !important;}#frameZ7KIL5 {  margin:10px !important;border:#cccccc 1px solid !important;}#frameJrpDUL {  background-color:#f5f5f5 !important;margin-bottom:0px !important;border-top:#cccccc 1px solid !important;}#frameCKnKug {  margin:10px !important;border:#cccccc 1px solid !important;}#portal_block_4 {  margin-left:30px !important;}#portal_block_4 .content {  color:#ff0000 !important;font-size:14px !important;}#portal_block_4 .content a {  color:#0000ff !important;font-size:14px !important;}#frameXRQYBB {  margin:0px !important;border:medium none !important;}#frame3C9vb4 {  margin:0px !important;border:medium none !important;}#framem41uT5 {  margin:0px !important;border:medium none !important;}#portal_block_275 {  margin:0px !important;border:medium none !important;}#portal_block_275 .content {  margin:0px !important;}#portal_block_276 {  margin:0px !important;border:medium none !important;}#portal_block_276 .content {  margin:0px !important;}#portal_block_277 {  margin:0px !important;border:medium none !important;}#portal_block_277 .content {  margin:0px !important;}#framextz5bM {  margin:0px !important;border:medium none !important;}#frameK5njup {  margin:0px !important;border:medium none !important;}#frameCKI1xW {  margin:0px !important;border:medium none !important;}#portal_block_278 {  margin:0px !important;border:medium none !important;}#portal_block_278 .content {  margin:0px !important;}#portal_block_279 {  margin:0px !important;border:medium none !important;}#portal_block_279 .content {  margin:0px !important;}#portal_block_280 {  margin:0px !important;border:medium none !important;}#portal_block_280 .content {  margin:0px !important;}#frameB2t68P {  margin:0px !important;border:medium none !important;}#frame5d9JDn {  margin:0px !important;border:medium none !important;}#framelfbcO5 {  margin:0px !important;border:medium none !important;}#portal_block_282 {  margin:0px !important;border:medium none !important;}#portal_block_282 .content {  margin:0px !important;}#portal_block_283 {  margin:0px !important;border:medium none !important;}#portal_block_283 .content {  margin:0px !important;}#portal_block_284 {  margin:0px !important;border:medium none !important;}#portal_block_284 .content {  margin:0px !important;}#frameZnP014 {  margin:0px !important;border:medium none !important;}#framevT8MS9 {  margin:0px !important;border:medium none !important;}#frame122lBF {  margin:0px !important;border:medium none !important;}#portal_block_297 {  margin:0px !important;border:medium none !important;}#portal_block_297 .content {  margin:0px !important;}#portal_block_298 {  margin:0px !important;border:medium none !important;}#portal_block_298 .content {  margin:0px !important;}#portal_block_299 {  margin:0px !important;border:medium none !important;}#portal_block_299 .content {  margin:0px !important;}#frameO1Ozoi {  margin:0px !important;border:medium none !important;}#framedIBvVY {  margin:0px !important;border:medium none !important;}#frameX4PA0e {  margin:0px !important;border:medium none !important;}#portal_block_306 {  margin:0px !important;border:medium none !important;}#portal_block_306 .content {  margin:0px !important;}#portal_block_307 {  margin:0px !important;border:medium none !important;}#portal_block_307 .content {  margin:0px !important;}#portal_block_308 {  margin:0px !important;border:medium none !important;}#portal_block_308 .content {  margin:0px !important;}#frameBgwEr3 {  margin:0px !important;border:medium none !important;}#frameI6RIdL {  margin:0px !important;border:medium none !important;}#framex6PnRw {  margin:0px !important;border:medium none !important;}#portal_block_321 {  margin:0px !important;border:medium none !important;}#portal_block_321 .content {  margin:0px !important;}#portal_block_322 {  margin:0px !important;border:medium none !important;}#portal_block_322 .content {  margin:0px !important;}#portal_block_323 {  margin:0px !important;border:medium none !important;}#portal_block_323 .content {  margin:0px !important;}#frameAquvx2 {  margin:0px !important;border:medium none !important;}#frame99Rfuw {  margin:0px !important;border:medium none !important;}#framezBsChp {  margin:0px !important;border:medium none !important;}#portal_block_334 {  margin:0px !important;border:medium none !important;}#portal_block_334 .content {  margin:0px !important;}#portal_block_335 {  margin:0px !important;border:medium none !important;}#portal_block_335 .content {  margin:0px !important;}#portal_block_336 {  margin:0px !important;border:medium none !important;}#portal_block_336 .content {  margin:0px !important;}#frameuB635A {  margin:0px !important;border:medium none !important;}#frameUsN3As {  margin:0px !important;border:medium none !important;}#framectnCQ8 {  margin:0px !important;border:medium none !important;}#portal_block_352 {  margin:0px !important;border:medium none !important;}#portal_block_352 .content {  margin:0px !important;}#portal_block_353 {  margin:0px !important;border:medium none !important;}#portal_block_353 .content {  margin:0px !important;}#portal_block_354 {  margin:0px !important;border:medium none !important;}#portal_block_354 .content {  margin:0px !important;}#framekzxgb1 {  margin:0px !important;border:medium none !important;}#frame5z3NHV {  margin:0px !important;border:medium none !important;}#frame2DrE1h {  margin:0px !important;border:medium none !important;}#portal_block_366 {  margin:0px !important;border:medium none !important;}#portal_block_366 .content {  margin:0px !important;}#portal_block_367 {  margin:0px !important;border:medium none !important;}#portal_block_367 .content {  margin:0px !important;}#portal_block_368 {  margin:0px !important;border:medium none !important;}#portal_block_368 .content {  margin:0px !important;}#frame284Nd5 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_374 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_374 .content {  margin:0px !important;}#frameboLwBJ {  margin:0px !important;border:medium none !important;}#frame7pQ98s {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_1799 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 !important;}#portal_block_1799 .content {  margin:0px !important;}#frameGs9H9g {  margin:0px !important;border:medium none !important;}#frameAWOgmz {  margin:0px !important;border:medium none !important;}#portal_block_1824 {  margin:0px !important;border:medium none !important;}#portal_block_1824 .content {  margin:0px !important;}#portal_block_1830 {  margin:0px !important;border:medium none !important;}#portal_block_1830 .content {  margin:0px !important;}#frameiTFqXr {  margin:0px !important;border:medium none !important;}#portal_block_2110 {  margin:0px !important;border:medium none !important;}#portal_block_2110 .content {  margin:0px !important;}#frame3t0eV9 {  margin:0px !important;border:medium none !important;}#portal_block_2111 {  margin:0px !important;border:medium none !important;}#portal_block_2111 .content {  margin:0px !important;}#frameFB37D3 {  margin:0px !important;border:medium none !important;}#portal_block_2112 {  margin:0px !important;border:medium none !important;}#portal_block_2112 .content {  margin:0px !important;}#portal_block_1880 {  margin:0px !important;border:0px !important;}#portal_block_1880 .content {  margin:0px !important;}#frame9iRjhK {  margin:0px !important;border:0px !important;}#portal_block_2113 {  margin:0px !important;border:0px !important;}#portal_block_2113 .content {  margin:0px !important;}#framej9RrDJ {  margin:0px !important;border:0px !important;}#portal_block_2114 {  margin:0px !important;border:0px !important;}#portal_block_2114 .content {  margin:0px !important;}#framehrFfEY {  margin:0px !important;border:0px !important;}#portal_block_2115 {  margin:0px !important;border:0px !important;}#portal_block_2115 .content {  margin:0px !important;}#frame28gnUu {  margin:0px !important;border:0px !important;}#frameJMnLF7 {  margin:0px !important;border:0px !important;}#frameYRsEEN {  margin:0px !important;border:0px !important;}#frame398eB3 {  margin:0px !important;border:0px !important;}#frameRu87U6 {  margin:0px !important;border:0px !important;}#frameitITLc {  margin:0px !important;border:0px !important;}#portal_block_2116 {  margin:0px !important;border:0px !important;}#portal_block_2116 .content {  margin:0px !important;}#portal_block_2117 {  margin:0px !important;border:0px !important;}#portal_block_2117 .content {  margin:0px !important;}#portal_block_2118 {  margin:0px !important;border:0px !important;}#portal_block_2118 .content {  margin:0px !important;}#portal_block_2119 {  margin:0px !important;border:0px !important;}#portal_block_2119 .content {  margin:0px !important;}#portal_block_2120 {  margin:0px !important;border:0px !important;}#portal_block_2120 .content {  margin:0px !important;}#portal_block_2121 {  margin:0px !important;border:0px !important;}#portal_block_2121 .content {  margin:0px !important;}#frameVdWm76 {  margin:0px !important;border:0px !important;}#portal_block_2122 {  margin:0px !important;border:0px !important;}#portal_block_2122 .content {  margin:0px !important;}#framey7Yc0n {  margin:0px !important;border:0px !important;}#portal_block_2123 {  margin:0px !important;border:0px !important;}#portal_block_2123 .content {  margin:0px !important;}#frameTCcuGM {  margin:0px !important;border:0px !important;}#portal_block_2124 {  margin:0px !important;border:0px !important;}#portal_block_2124 .content {  margin:0px !important;}#frameyFvIfs {  margin:0px !important;border:0px !important;}#portal_block_2125 {  margin:0px !important;border:0px !important;}#portal_block_2125 .content {  margin:0px !important;}#framefitKpt {  margin:0px !important;border:0px !important;}#portal_block_2126 {  margin:0px !important;border:0px !important;}#portal_block_2126 .content {  margin:0px !important;}#frameX8BIFf {  margin:0px !important;border:0px !important;}#portal_block_2127 {  margin:0px !important;border:0px !important;}#portal_block_2127 .content {  margin:0px !important;}#frameriGR8R {  margin:0px !important;border:#000000 0px !important;}#portal_block_2128 {  margin:0px !important;border:0px !important;}#portal_block_2128 .content {  margin:0px !important;}#frameC8G79r {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2138 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 !important;}#portal_block_2138 .content {  margin:0px !important;}#frame6zvt2C {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#frame5yaF4Z {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2157 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2157 .content {  margin:0px !important;}#framemPXY1a {  margin:0px !important;border:medium none !important;}#portal_block_2159 {  margin:0px !important;border:medium none !important;}#portal_block_2159 .content {  margin:0px !important;}#framef9ceVA {  margin:0px !important;border:medium none !important;}#portal_block_2160 {  margin:0px !important;border:medium none !important;}#portal_block_2160 .content {  margin:0px !important;}#framexA88ME {  margin:0px !important;border:medium none !important;}#portal_block_2163 {  margin:0px !important;border:medium none !important;}#portal_block_2163 .content {  margin:0px !important;}#portal_block_2164 {  margin:0px !important;border:medium none !important;}#portal_block_2164 .content {  margin:0px !important;}#portal_block_2223 {  margin:0px !important;border:medium none !important;}#portal_block_2223 .content {  margin:0px !important;}#framem1mTav {  margin:0px !important;border:medium none !important;}#portal_block_2228 {  margin:0px !important;border:medium none !important;}#portal_block_2228 .content {  margin:0px !important;}#frameR2UfKQ {  margin:0px !important;border:medium none !important;}#portal_block_2229 {  margin:0px !important;border:medium none !important;}#portal_block_2229 .content {  margin:0px !important;}#frameu2h2Q0 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#frame7lRR7o {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_1818 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_1818 .content {  margin:0px !important;}#framefoDovV {  margin:0px !important;border:medium none !important;}#portal_block_1820 {  margin:0px !important;border:medium none !important;}#portal_block_1820 .content {  margin:0px !important;}#frameFfHF3F {  margin:0px !important;border:medium none !important;}#portal_block_1825 {  margin:0px !important;border:medium none !important;}#portal_block_1825 .content {  margin:0px !important;}#frame8xz8Y8 {  margin:0px !important;border:medium none !important;}#portal_block_1873 {  margin:0px !important;border:medium none !important;}#portal_block_1873 .content {  margin:0px !important;}#frame4kBlGk {  margin:0px !important;border:medium none !important;}#portal_block_1874 {  margin:0px !important;border:medium none !important;}#portal_block_1874 .content {  margin:0px !important;}#framezw4m8G {  margin:0px !important;border:medium none !important;}#portal_block_1875 {  margin:0px !important;border:medium none !important;}#portal_block_1875 .content {  margin:0px !important;}#framenJ9I7w {  margin:0px !important;border:0px !important;}#portal_block_1887 {  margin:0px !important;border:0px !important;}#portal_block_1887 .content {  margin:0px !important;}#framexC18QY {  margin:0px !important;border:0px !important;}#portal_block_1888 {  margin:0px !important;border:0px !important;}#portal_block_1888 .content {  margin:0px !important;}#frame787Lt4 {  margin:0px !important;border:0px !important;}#framev5sE2V {  margin:0px !important;border:0px !important;}#frameSBm9l6 {  margin:0px !important;border:0px !important;}#frameTQu162 {  margin:0px !important;border:0px !important;}#portal_block_1891 {  margin:0px !important;border:0px !important;}#portal_block_1891 .content {  margin:0px !important;}#portal_block_1893 {  margin:0px !important;border:0px !important;}#portal_block_1893 .content {  margin:0px !important;}#portal_block_1894 {  margin:0px !important;border:0px !important;}#portal_block_1894 .content {  margin:0px !important;}#portal_block_1895 {  margin:0px !important;border:0px !important;}#portal_block_1895 .content {  margin:0px !important;}#frameLTcFS4 {  margin:0px !important;border:0px !important;}#portal_block_1896 {  margin:0px !important;border:0px !important;}#portal_block_1896 .content {  margin:0px !important;}#frameG6453n {  margin:0px !important;border:0px !important;}#portal_block_1897 {  margin:0px !important;border:0px !important;}#portal_block_1897 .content {  margin:0px !important;}#frameyU7rNQ {  margin:0px !important;border:0px !important;}#portal_block_1899 {  margin:0px !important;border:0px !important;}#portal_block_1899 .content {  margin:0px !important;}#frameEj3599 {  margin:0px !important;border:0px !important;}#portal_block_1901 {  margin:0px !important;border:0px !important;}#portal_block_1901 .content {  margin:0px !important;}#frame5yhqfZ {  margin:0px !important;border:medium none !important;}#framesH19Dp {  margin:0px !important;border:medium none !important;}#frameLJWxcL {  margin:0px !important;border:medium none !important;}#portal_block_2278 {  margin:0px !important;border:medium none !important;}#portal_block_2278 .content {  margin:0px !important;}#framee297py {  margin:0px !important;border:medium none !important;}#portal_block_2305 {  margin:0px !important;border:medium none !important;}#portal_block_2305 .content {  margin:0px !important;}#frame34U3XX {  margin:0px !important;border:medium none !important;}#frameD3UtMv {  margin:0px !important;border:medium none !important;}#portal_block_2759 {  margin:0px !important;border:medium none !important;}#portal_block_2759 .content {  margin:0px !important;}#frame10l14F {  margin:0px !important;border:medium none !important;}#portal_block_2760 {  margin:0px !important;border:medium none !important;}#portal_block_2760 .content {  margin:0px !important;}#frame664nNR {  margin:0px !important;border:medium none !important;}#portal_block_2761 {  margin:0px !important;border:medium none !important;}#portal_block_2761 .content {  margin:0px !important;}#frame5dYzX5 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2762 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2762 .content {  margin:0px !important;}#frameP7M1Bz {  margin:0px !important;border:medium none !important;}#portal_block_2763 {  margin:0px !important;border:medium none !important;}#portal_block_2763 .content {  margin:0px !important;}#frameOiQ3e9 {  margin:0px !important;border:medium none !important;}#frame9QLk57 {  margin:0px !important;border:medium none !important;}#frameMMvmsF {  margin:0px !important;border:medium none !important;}#portal_block_2764 {  margin:0px !important;border:medium none !important;}#portal_block_2764 .content {  margin:0px !important;}#portal_block_2765 {  margin:0px !important;border:medium none !important;}#portal_block_2765 .content {  margin:0px !important;}#portal_block_2766 {  margin:0px !important;border:medium none !important;}#portal_block_2766 .content {  margin:0px !important;}#frame9JSDjx {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2767 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2767 .content {  margin:0px !important;}#frameY6p3gD {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2768 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2768 .content {  margin:0px !important;}#framejHWjIX {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#frameeiqK99 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2772 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2772 .content {  margin:0px !important;}#frameGG5577 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2773 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2773 .content {  margin:0px !important;}#frame4Ks7kp {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2774 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2774 .content {  margin:0px !important;}#frameQBOSsw {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2775 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2775 .content {  margin:0px !important;}#frame2vLpLp {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2776 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2776 .content {  margin:0px !important;}#frameVeVWLC {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2778 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2778 .content {  margin:0px !important;}#framejZ7eJv {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2779 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2779 .content {  margin:0px !important;}#frame3S3kXC {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2780 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2780 .content {  margin:0px !important;}#framex20rpc {  margin:0px !important;border:medium none !important;}#frameko52u4 {  margin:0px !important;border:medium none !important;}#portal_block_2781 {  margin:0px !important;border:medium none !important;}#portal_block_2781 .content {  margin:0px !important;}#frameaEdPX4 {  margin:0px !important;border:medium none !important;}#portal_block_2782 {  margin:0px !important;border:#000000 !important;}#portal_block_2782 .content {  margin:0px !important;}#frame01OY7z {  margin:0px !important;border:medium none !important;}#portal_block_2783 {  margin:0px !important;border:medium none !important;}#portal_block_2783 .content {  margin:0px !important;}#frameT2dCe5 {  margin:0px !important;border:0px !important;}#frameQfKL2O {  margin:0px !important;border:0px !important;}#portal_block_2786 {  margin:0px !important;border:0px !important;}#portal_block_2786 .content {  margin:0px !important;}#portal_block_2787 {  margin:0px !important;border:0px !important;}#portal_block_2787 .content {  margin:0px !important;}#framepNxd4D {  margin:0px !important;border:0px !important;}#frame1tuiIl {  margin:0px !important;border:0px !important;}#portal_block_2788 {  margin:0px !important;border:0px !important;}#portal_block_2788 .content {  margin:0px !important;}#framemp7Q9m {  margin:0px !important;border:0px !important;}#portal_block_2789 {  margin:0px !important;border:0px !important;}#portal_block_2789 .content {  margin:0px !important;}#frame8c0i63 {  margin:0px !important;border:medium none !important;}#portal_block_2790 {  margin:0px !important;border:medium none !important;}#portal_block_2790 .content {  margin:0px !important;}#frame8hFEk7 {  margin:0px !important;border:medium none !important;}#portal_block_2791 {  margin:0px !important;border:medium none !important;}#portal_block_2791 .content {  margin:0px !important;}#frame9ke9Rs {  margin:0px !important;border:medium none !important;}#portal_block_2792 {  margin:0px !important;border:medium none !important;}#portal_block_2792 .content {  margin:0px !important;}#frameU8KOtJ {  margin:0px !important;border:medium none !important;}#frameUjAbMA {  margin:0px !important;border:medium none !important;}#portal_block_2794 {  margin:0px !important;border:#000000 !important;}#portal_block_2794 .content {  margin:0px !important;}#frame8Sf7Fk {  margin:0px !important;border:medium none !important;}#portal_block_2795 {  margin:0px !important;border:#000000 !important;}#portal_block_2795 .content {  margin:0px !important;}#framemM8gxV {  margin:0px !important;border:medium none !important;}#portal_block_2796 {  margin:0px !important;border:#000000 !important;}#portal_block_2796 .content {  margin:0px !important;}#frameETcRcs {  margin:0px !important;border:medium none !important;}#portal_block_2797 {  margin:0px !important;border:#000000 !important;}#portal_block_2797 .content {  margin:0px !important;}#frame3gBxUN {  margin:0px !important;border:medium none !important;}#portal_block_2798 {  margin:0px !important;border:medium none !important;}#portal_block_2798 .content {  margin:0px !important;}#portal_block_2799 {  margin:0px !important;border:medium none !important;}#portal_block_2799 .content {  margin:0px !important;}#frameWh7RMw {  margin:0px !important;border:medium none !important;}#portal_block_2800 {  margin:0px !important;border:#000000 !important;}#portal_block_2800 .content {  margin:0px !important;}#frameOBjF66 {  margin:0px !important;border:medium none !important;}#portal_block_2801 {  margin:0px !important;border:medium none !important;}#portal_block_2801 .content {  margin:0px !important;}#frame43X8t2 {  margin:0px !important;border:medium none !important;}#portal_block_2802 {  margin:0px !important;border:medium none !important;}#portal_block_2802 .content {  margin:0px !important;}#framehCuv6h {  margin:0px !important;border:medium none !important;}#portal_block_2803 {  margin:0px !important;border:medium none !important;}#portal_block_2803 .content {  margin:0px !important;}#portal_block_2805 {  margin:0px !important;border:medium none !important;}#portal_block_2805 .content {  margin:0px !important;}#frameG4yMg6 {  margin:0px !important;border:medium none !important;}#portal_block_2806 {  margin:0px !important;border:medium none !important;}#portal_block_2806 .content {  margin:0px !important;}#frameIAJ22H {  margin:0px !important;border:medium none !important;}#portal_block_2807 {  margin:0px !important;border:medium none !important;}#portal_block_2807 .content {  margin:0px !important;}#portal_block_2793 {  margin:0px !important;border:medium none !important;}#portal_block_2793 .content {  margin:0px !important;}#frameh4U7Kb {  margin:0px !important;border:medium none !important;}#portal_block_2810 {  margin:0px !important;border:medium none !important;}#portal_block_2810 .content {  margin:0px !important;}#framePoMmRE {  margin:0px !important;border:medium none !important;}#portal_block_2811 {  margin:0px !important;border:medium none !important;}#portal_block_2811 .content {  margin:0px !important;}#framepVemH4 {  margin:0px !important;border:medium none !important;}#portal_block_2812 {  margin:0px !important;border:medium none !important;}#portal_block_2812 .content {  margin:0px !important;}#frameWiMK4V {  margin:0px !important;border:medium none !important;}#portal_block_2814 {  margin:0px !important;border:medium none !important;}#portal_block_2814 .content {  margin:0px !important;}#frameaAEwU9 {  margin:0px !important;border:medium none !important;}#portal_block_2815 {  margin:0px !important;border:medium none !important;}#portal_block_2815 .content {  margin:0px !important;}#frameRB5gow {  margin:0px !important;border:medium none !important;}#portal_block_2816 {  margin:0px !important;border:medium none !important;}#portal_block_2816 .content {  margin:0px !important;}#frameFa7AfO {  margin:0px !important;border:medium none !important;}#portal_block_2817 {  margin:0px !important;border:medium none !important;}#portal_block_2817 .content {  margin:0px !important;}#framexPG4TH {  margin:0px !important;border:medium none !important;}#portal_block_2818 {  margin:0px !important;border:medium none !important;}#portal_block_2818 .content {  margin:0px !important;}#portal_block_2819 {  margin:0px !important;border:medium none !important;}#portal_block_2819 .content {  margin:0px !important;}#frame50h8e6 {  margin:0px !important;border:medium none !important;}#frameEGIGe9 {  margin:0px !important;border:medium none !important;}#portal_block_2821 {  margin:0px !important;border:medium none !important;}#portal_block_2821 .content {  margin:0px !important;}#portal_block_2820 {  margin:0px !important;border:medium none !important;}#portal_block_2820 .content {  margin:0px !important;}#frame3b251f {  margin:0px !important;border:medium none !important;}#portal_block_2826 {  margin:0px !important;border:medium none !important;}#portal_block_2826 .content {  margin:0px !important;}.bdSug_wpr {  z-index:9999 !important;position:absolute !important;padding-bottom:0px !important;line-height:normal !important;margin:0px !important;padding-left:0px !important;padding-right:0px !important;background:#fff !important;padding-top:0px !important;border:#817f82 1px solid !important;}.bdSug_wpr TABLE {  padding-bottom:0px !important;padding-left:0px !important;width:100% !important;padding-right:0px !important;background:#fff !important;cursor:default !important;padding-top:0px !important;}.bdSug_wpr TR {  padding-bottom:0px !important;margin:0px !important;padding-left:0px !important;padding-right:0px !important;padding-top:0px !important;}.bdSug_wpr TD {  text-align:left !important;padding-bottom:2px !important;text-indent:0px !important;margin:0px !important;padding-left:2px !important;padding-right:2px !important;font:14px verdana !important;vertical-align:middle !important;text-decoration:none !important;padding-top:2px !important;}.bdSug_mo {  background:#36c !important;color:#fff !important;}.bdSug_app {  padding-bottom:0px !important;margin:0px !important;padding-left:0px !important;padding-right:0px !important;background:#fff !important;padding-top:0px !important;}.bdSug_pre {  padding-bottom:0px !important;margin:0px !important;padding-left:0px !important;padding-right:0px !important;padding-top:0px !important;}.bdsug_copy {  padding-bottom:0px !important;margin:0px !important;padding-left:16px !important;padding-right:2px !important;background:url(http://www.baidu.com/img/bd.gif) no-repeat !important;color:#77c !important;font-size:13px !important;text-decoration:none !important;padding-top:0px !important;}#frame7cn6ye {  margin:0px !important;border:0px !important;}#portal_block_3862 {  margin:0px !important;border:0px !important;}#portal_block_3862 .content {  margin:0px !important;}#frame932E3F {  margin:0px !important;border:0px !important;}#portal_block_4075 {  margin:0px !important;border:0px !important;}#portal_block_4075 .content {  margin:0px !important;}#frame5K67sH {  margin:0px !important;border:medium none !important;}#portal_block_4149 {  margin:0px !important;border:medium none !important;}#portal_block_4149 .content {  margin:0px !important;}#frame85D6tN {  margin:0px !important;border:0px !important;}#portal_block_4592 {  margin:0px !important;border:0px !important;}#portal_block_4592 .content {  margin:0px !important;}#frame0uE5jx {  margin:0px !important;border:0px !important;}#portal_block_4593 {  margin:0px !important;border:medium none !important;}#portal_block_4593 .content {  margin:0px !important;}#framelD1et5 {  margin:0px !important;border:medium none !important;}#portal_block_4812 {  margin:0px !important;border:medium none !important;}#portal_block_4812 .content {  margin:0px !important;}#frame5yiPUP {  margin:0px !important;border:0px !important;}#frameW2Im8T {  margin:0px !important;border:0px !important;}#portal_block_4868 {  margin:0px !important;border:0px !important;}#portal_block_4868 .content {  margin:0px !important;}#portal_block_4867 {  margin:0px !important;border:0px !important;}#portal_block_4867 .content {  margin:0px !important;}#frameIDIbRU {  margin:0px !important;border:0px !important;}#portal_block_6546 {  margin:0px !important;border:0px !important;}#portal_block_6546 .content {  margin:0px !important;}#framessukPT {  margin:0px !important;border:0px !important;}#portal_block_6547 {  margin:0px !important;border:0px !important;}#portal_block_6547 .content {  margin:0px !important;}#frameXxndXp {  margin:0px !important;border:0px !important;}#portal_block_6548 {  margin:0px !important;border:0px !important;}#portal_block_6548 .content {  margin:0px !important;}#frameSku7o4 {  margin:0px !important;border:0px !important;}#portal_block_5098 {  margin:0px !important;border:0px !important;}#portal_block_5098 .content {  margin:0px !important;}#frame3Rz2w3 {  margin:0px !important;border:0px !important;}#portal_block_6550 {  margin:0px !important;border:0px !important;}#portal_block_6550 .content {  margin:0px !important;}#frameH2iUA3 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6551 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6551 .content {  margin:0px !important;}#framev1F11F {  margin:0px !important;border:0px !important;}#portal_block_6553 {  margin:0px !important;border:0px !important;}#portal_block_6553 .content {  margin:0px !important;}#framePWaEWR {  margin:0px !important;border:0px !important;}#portal_block_6554 {  margin:0px !important;border:0px !important;}#portal_block_6554 .content {  margin:0px !important;}#frameZi3ivb {  margin:0px !important;border:0px !important;}#portal_block_6556 {  margin:0px !important;border:0px !important;}#portal_block_6556 .content {  margin:0px !important;}#frameNC0Z0f {  margin:0px !important;border:0px !important;}#portal_block_6557 {  margin:0px !important;border:0px !important;}#portal_block_6557 .content {  margin:0px !important;}#frameLgwlL0 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6558 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6558 .content {  margin:0px !important;}#frameviM8m3 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6559 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6559 .content {  margin:0px !important;}#frameFm6e5m {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_6560 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6560 .content {  margin:0px !important;}#frameiLcdl3 {  margin:0px !important;border:0px !important;}#portal_block_6561 {  margin:0px !important;border:0px !important;}#portal_block_6561 .content {  margin:0px !important;}#frame6nKn0T {  margin:0px !important;border:0px !important;}#portal_block_6562 {  margin:0px !important;border:0px !important;}#portal_block_6562 .content {  margin:0px !important;}#frameHJBVf6 {  margin:0px !important;border:0px !important;}#portal_block_6563 {  margin:0px !important;border:0px !important;}#portal_block_6563 .content {  margin:0px !important;}#framekea7w5 {  margin:0px !important;border:0px !important;}#portal_block_6565 {  margin:0px !important;border:0px !important;}#portal_block_6565 .content {  margin:0px !important;}#frametMeWuL {  margin:0px !important;border:0px !important;}#portal_block_6566 {  margin:0px !important;border:0px !important;}#portal_block_6566 .content {  margin:0px !important;}#framelu3D3F {  margin:0px !important;border:0px !important;}#portal_block_6567 {  margin:0px !important;border:0px !important;}#portal_block_6567 .content {  margin:0px !important;}#framey537y5 {  margin:0px !important;border:medium none !important;}#portal_block_6568 {  margin:0px !important;border:medium none !important;}#portal_block_6568 .content {  margin:0px !important;}#frameZ8KUus {  margin:0px !important;border:medium none !important;}#portal_block_6569 {  margin:0px !important;border:medium none !important;}#portal_block_6569 .content {  margin:0px !important;}#frame56obK6 {  margin:0px !important;border:medium none !important;}#portal_block_6570 {  margin:0px !important;border:medium none !important;}#portal_block_6570 .content {  margin:0px !important;}#frameDyhHE0 {  margin:0px !important;border:medium none !important;}#portal_block_6571 {  margin:0px !important;border:medium none !important;}#portal_block_6571 .content {  margin:0px !important;}#frameA1q5u9 {  margin:0px !important;border:medium none !important;}#frame8PzYM6 {  margin:0px !important;border:medium none !important;}#portal_block_6572 {  margin:0px !important;border:medium none !important;}#portal_block_6572 .content {  margin:0px !important;}#portal_block_6573 {  margin:0px !important;border:medium none !important;}#portal_block_6573 .content {  margin:0px !important;}#frame1o6o5Z {  margin:0px !important;border:medium none !important;}#portal_block_6574 {  margin:0px !important;border:medium none !important;}#portal_block_6574 .content {  margin:0px !important;}#frame9777vj {  margin:0px !important;border:medium none !important;}#portal_block_6575 {  margin:0px !important;border:medium none !important;}#portal_block_6575 .content {  margin:0px !important;}#frameKoN6T7 {  margin:0px !important;border:medium none !important;}#portal_block_6576 {  margin:0px !important;border:medium none !important;}#portal_block_6576 .content {  margin:0px !important;}#frame5tQ0Ax {  margin:0px !important;border:medium none !important;}#framegI9I5E {  margin:0px !important;border:medium none !important;}#portal_block_6577 {  margin:0px !important;border:medium none !important;}#portal_block_6577 .content {  margin:0px !important;}#portal_block_6578 {  margin:0px !important;border:medium none !important;}#portal_block_6578 .content {  margin:0px !important;}#framepaQ5rQ {  margin:0px !important;border:medium none !important;}#portal_block_6579 {  margin:0px !important;border:medium none !important;}#portal_block_6579 .content {  margin:0px !important;}#framebB2U98 {  margin:0px !important;border:medium none !important;}#portal_block_6580 {  margin:0px !important;border:medium none !important;}#portal_block_6580 .content {  margin:0px !important;}#frame7TTD14 {  margin:0px !important;border:medium none !important;}#portal_block_6581 {  margin:0px !important;border:medium none !important;}#portal_block_6581 .content {  margin:0px !important;}#framebZ4i7h {  margin:0px !important;border:medium none !important;}#portal_block_6582 {  margin:0px !important;border:medium none !important;}#portal_block_6582 .content {  margin:0px !important;}#frameM1H1Vq {  margin:0px !important;border:medium none !important;}#portal_block_6583 {  margin:0px !important;border:medium none !important;}#portal_block_6583 .content {  margin:0px !important;}#frameTnxzew {  margin:0px !important;border:medium none !important;}#portal_block_6584 {  margin:0px !important;border:medium none !important;}#portal_block_6584 .content {  margin:0px !important;}#frameaaGjDW {  margin:0px !important;border:medium none !important;}#portal_block_6585 {  margin:0px !important;border:medium none !important;}#portal_block_6585 .content {  margin:0px !important;}#frameliiF6I {  margin:0px !important;border:medium none !important;}#portal_block_6586 {  margin:0px !important;border:medium none !important;}#portal_block_6586 .content {  margin:0px !important;}#frameKtFYJm {  margin:0px !important;border:medium none !important;}#frameM34mG8 {  margin:0px !important;border:medium none !important;}#frameM179IN {  margin:0px !important;border:medium none !important;}#portal_block_6588 {  margin:0px !important;border:medium none !important;}#portal_block_6588 .content {  margin:0px !important;}#portal_block_6315 {  margin:0px !important;border:medium none !important;}#portal_block_6315 .content {  margin:0px !important;}#frameqXXbTE {  margin:0px !important;border:medium none !important;}#portal_block_6589 {  margin:0px !important;border:medium none !important;}#portal_block_6589 .content {  margin:0px !important;}#frameBT12B0 {  margin:0px !important;border:medium none !important;}#portal_block_6590 {  margin:0px !important;border:medium none !important;}#portal_block_6590 .content {  margin:0px !important;}#frame3zqJE4 {  margin:0px !important;border:medium none !important;}#portal_block_6318 {  margin:0px !important;border:medium none !important;}#portal_block_6318 .content {  margin:0px !important;}#frame996K9S {  margin:0px !important;border:medium none !important;}#portal_block_6591 {  margin:0px !important;border:medium none !important;}#portal_block_6591 .content {  margin:0px !important;}#framek0MQzo {  margin:0px !important;border:medium none !important;}#portal_block_6592 {  margin:0px !important;border:medium none !important;}#portal_block_6592 .content {  margin:0px !important;}#frameUQJMwI {  margin:0px !important;border:medium none !important;}#portal_block_6593 {  margin:0px !important;border:medium none !important;}#portal_block_6593 .content {  margin:0px !important;}#framezw4544 {  margin:0px !important;border:medium none !important;}#portal_block_6594 {  margin:0px !important;border:medium none !important;}#portal_block_6594 .content {  margin:0px !important;}#frame452TTz {  margin:0px !important;border:medium none !important;}#portal_block_6595 {  margin:0px !important;border:medium none !important;}#portal_block_6595 .content {  margin:0px !important;}#portal_block_6596 {  margin:0px !important;border:medium none !important;}#portal_block_6596 .content {  margin:0px !important;}#frameZeODDe {  margin:0px !important;border:medium none !important;}#portal_block_6597 {  margin:0px !important;border:medium none !important;}#portal_block_6597 .content {  margin:0px !important;}#framedR6Mil {  margin:0px !important;border:medium none !important;}#framepQ699D {  margin:0px !important;border:medium none !important;}#portal_block_6598 {  margin:0px !important;border:medium none !important;}#portal_block_6598 .content {  margin:0px !important;}#frameZ777qt {  margin:0px !important;border:medium none !important;}#portal_block_6599 {  margin:0px !important;border:medium none !important;}#portal_block_6599 .content {  margin:0px !important;}#framexgnN1l {  margin:0px !important;border:medium none !important;}#portal_block_6600 {  margin:0px !important;border:medium none !important;}#portal_block_6600 .content {  margin:0px !important;}#framedUP3qz {  margin:0px !important;border:medium none !important;}#portal_block_6601 {  margin:0px !important;border:medium none !important;}#portal_block_6601 .content {  margin:0px !important;}#frameJyxx1v {  margin:0px !important;border:0px !important;}#portal_block_6364 {  margin:0px !important;border:0px !important;}#portal_block_6364 .content {  margin:0px !important;}#frame15Fsm3 {  margin:0px !important;border:0px !important;}#portal_block_6365 {  margin:0px !important;border:0px !important;}#portal_block_6365 .content {  margin:0px !important;}#frameqY1Rr2 {  margin:0px !important;border:0px !important;}#portal_block_6602 {  margin:0px !important;border:0px !important;}#portal_block_6602 .content {  margin:0px !important;}#frame9ZucC0 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6603 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6603 .content {  margin:0px !important;}#frame27iyK5 {  margin:0px !important;border:medium none !important;}#portal_block_6604 {  margin:0px !important;border:medium none !important;}#portal_block_6604 .content {  margin:0px !important;}#portal_block_6605 {  margin:0px !important;border:0px !important;}#portal_block_6605 .content {  margin:0px !important;}#framelyP8v2 {  margin:0px !important;border:0px !important;}#framePWW2v8 {  margin:0px !important;border:0px !important;}#portal_block_6606 {  margin:0px !important;border:0px !important;}#portal_block_6606 .content {  margin:0px !important;}#framego8ljU {  margin:0px !important;border:0px !important;}#portal_block_6613 {  margin:0px !important;border:0px !important;}#portal_block_6613 .content {  margin:0px !important;}#frameJ5bPgO {  margin:0px !important;border:medium none !important;}#portal_block_6618 {  margin:0px !important;border:medium none !important;}#portal_block_6618 .content {  margin:0px !important;}#frame3HwCsy {  margin:0px !important;border:medium none !important;}#portal_block_6620 {  margin:0px !important;border:medium none !important;}#portal_block_6620 .content {  margin:0px !important;}#framekg892Y {  margin:0px !important;border:0px !important;}#portal_block_6622 {  margin:0px !important;border:0px !important;}#portal_block_6622 .content {  margin:0px !important;}#frameBcJhJm {  margin:0px !important;border:0px !important;}#portal_block_6624 {  margin:0px !important;border:0px !important;}#portal_block_6624 .content {  margin:0px !important;}#frameyLozY2 {  margin:0px !important;border:#000000 !important;}#portal_block_6859 {  margin:0px !important;border:#000000 !important;}#portal_block_6859 .content {  margin:0px 0px 0px 10px !important;}#frame3g6tjI {  margin:0px !important;border:0px !important;}#portal_block_6878 {  margin:0px !important;border:0px !important;}#portal_block_6878 .content {  margin:0px !important;}#framec9J52W {  margin:0px !important;border:0px !important;}#portal_block_6879 {  margin:0px !important;border:0px !important;}#portal_block_6879 .content {  margin:0px !important;}#frameR57cqY {  margin:0px !important;border:medium none !important;}#portal_block_6884 {  margin:0px !important;border:medium none !important;}#portal_block_6884 .content {  margin:0px !important;}#frame7333pW {  margin:0px !important;border:0px !important;}#portal_block_6899 {  margin:0px !important;border:0px !important;}#portal_block_6899 .content {  margin:0px !important;}#framedPe1C2 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6903 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6903 .content {  margin:0px !important;}#portal_block_6920 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_6920 .content {  margin:0px !important;}#frameS86M48 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#frameQOsqfi {  margin:0px !important;border:0px !important;}#portal_block_6967 {  margin:0px !important;border:0px !important;}#portal_block_6967 .content {  margin:0px !important;}#frameX85ynu {  margin:0px !important;border:0px !important;}#portal_block_5095 {  margin:0px !important;border:0px !important;}#portal_block_5095 .content {  margin:0px !important;}#framen4n263 {  margin:0px !important;border:0px !important;}#portal_block_5096 {  margin:0px !important;border:0px !important;}#portal_block_5096 .content {  margin:0px !important;}#frameo8N1N5 {  margin:0px !important;border:0px !important;}#portal_block_5097 {  margin:0px !important;border:0px !important;}#portal_block_5097 .content {  margin:0px !important;}#frameJ5h8Rm {  margin:0px !important;border:0px !important;}#frameHNCF9J {  margin:0px !important;border:0px !important;}#portal_block_5099 {  margin:0px !important;border:0px !important;}#portal_block_5099 .content {  margin:0px !important;}#portal_block_5100 {  margin:0px !important;border:0px !important;}#portal_block_5100 .content {  margin:0px !important;}#frameb6k38M {  margin:0px !important;border:0px !important;}#portal_block_5101 {  margin:0px !important;border:0px !important;}#portal_block_5101 .content {  margin:0px !important;}#frameBJDL6S {  margin:0px !important;border:0px !important;}#portal_block_5102 {  margin:0px !important;border:0px !important;}#portal_block_5102 .content {  margin:0px !important;}#frameH6Yh59 {  margin:0px !important;border:0px !important;}#portal_block_5108 {  margin:0px !important;border:0px !important;}#portal_block_5108 .content {  margin:0px !important;}#framempq3VI {  margin:0px !important;border:0px !important;}#portal_block_5119 {  margin:0px !important;border:0px !important;}#portal_block_5119 .content {  margin:0px !important;}#frameOToMVm {  margin:0px !important;border:0px !important;}#portal_block_5120 {  margin:0px !important;border:0px !important;}#portal_block_5120 .content {  margin:0px !important;}#frameH21GQY {  margin:0px !important;border:0px !important;}#portal_block_5121 {  margin:0px !important;border:0px !important;}#portal_block_5121 .content {  margin:0px !important;}#framek1TxV1 {  margin:0px !important;border:0px !important;}#portal_block_5152 {  margin:0px !important;border:0px !important;}#portal_block_5152 .content {  margin:0px !important;}#frameqIj62v {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5153 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5153 .content {  margin:0px !important;}#frame3UjfG6 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5154 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5154 .content {  margin:0px !important;}#framey3Jsng {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_5155 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5155 .content {  margin:0px !important;}#frameIo6gEL {  margin:0px !important;border:0px !important;}#portal_block_5156 {  margin:0px !important;border:0px !important;}#portal_block_5156 .content {  margin:0px !important;}#framerpDB2g {  margin:0px !important;border:0px !important;}#portal_block_5157 {  margin:0px !important;border:0px !important;}#portal_block_5157 .content {  margin:0px !important;}#frame29Ol8W {  margin:0px !important;border:0px !important;}#portal_block_5158 {  margin:0px !important;border:0px !important;}#portal_block_5158 .content {  margin:0px !important;}#frame231hki {  margin:0px !important;border:0px !important;}#portal_block_5159 {  margin:0px !important;border:0px !important;}#portal_block_5159 .content {  margin:0px !important;}#frameJ8h461 {  margin:0px !important;border:0px !important;}#portal_block_5225 {  margin:0px !important;border:0px !important;}#portal_block_5225 .content {  margin:0px !important;}#frameGCLqcV {  margin:0px !important;border:0px !important;}#portal_block_5876 {  margin:0px !important;border:0px !important;}#portal_block_5876 .content {  margin:0px !important;}#frame99L9DO {  margin:0px !important;border:0px !important;}#portal_block_5877 {  margin:0px !important;border:0px !important;}#portal_block_5877 .content {  margin:0px !important;}#frame6jdMbC {  margin:0px !important;border:medium none !important;}#portal_block_6268 {  margin:0px !important;border:medium none !important;}#portal_block_6268 .content {  margin:0px !important;}#frameV7hB2B {  margin:0px !important;border:medium none !important;}#portal_block_6276 {  margin:0px !important;border:medium none !important;}#portal_block_6276 .content {  margin:0px !important;}#frameJIYq3z {  margin:0px !important;border:medium none !important;}#portal_block_6291 {  margin:0px !important;border:medium none !important;}#portal_block_6291 .content {  margin:0px !important;}#framewGkWlI {  margin:0px !important;border:medium none !important;}#portal_block_6292 {  margin:0px !important;border:medium none !important;}#portal_block_6292 .content {  margin:0px !important;}#framegeBx98 {  margin:0px !important;border:medium none !important;}#frameIZC5Dx {  margin:0px !important;border:medium none !important;}#portal_block_6293 {  margin:0px !important;border:medium none !important;}#portal_block_6293 .content {  margin:0px !important;}#portal_block_6295 {  margin:0px !important;border:medium none !important;}#portal_block_6295 .content {  margin:0px !important;}#frame5IxQ29 {  margin:0px !important;border:medium none !important;}#portal_block_6296 {  margin:0px !important;border:medium none !important;}#portal_block_6296 .content {  margin:0px !important;}#frameV7tcg7 {  margin:0px !important;border:medium none !important;}#portal_block_6297 {  margin:0px !important;border:medium none !important;}#portal_block_6297 .content {  margin:0px !important;}#frameWX441U {  margin:0px !important;border:medium none !important;}#portal_block_6298 {  margin:0px !important;border:medium none !important;}#portal_block_6298 .content {  margin:0px !important;}#frameE763r1 {  margin:0px !important;border:medium none !important;}#framed7wmR3 {  margin:0px !important;border:medium none !important;}#portal_block_6299 {  margin:0px !important;border:medium none !important;}#portal_block_6299 .content {  margin:0px !important;}#portal_block_6300 {  margin:0px !important;border:medium none !important;}#portal_block_6300 .content {  margin:0px !important;}#frame6e8eWP {  margin:0px !important;border:medium none !important;}#portal_block_6302 {  margin:0px !important;border:medium none !important;}#portal_block_6302 .content {  margin:0px !important;}#frameuPgWOC {  margin:0px !important;border:medium none !important;}#portal_block_6303 {  margin:0px !important;border:medium none !important;}#portal_block_6303 .content {  margin:0px !important;}#frameHr6Kco {  margin:0px !important;border:medium none !important;}#portal_block_6304 {  margin:0px !important;border:medium none !important;}#portal_block_6304 .content {  margin:0px !important;}#frame75N4s4 {  margin:0px !important;border:medium none !important;}#portal_block_6305 {  margin:0px !important;border:medium none !important;}#portal_block_6305 .content {  margin:0px !important;}#frame45fowP {  margin:0px !important;border:medium none !important;}#portal_block_6307 {  margin:0px !important;border:medium none !important;}#portal_block_6307 .content {  margin:0px !important;}#frameXVbP9P {  margin:0px !important;border:medium none !important;}#portal_block_6308 {  margin:0px !important;border:medium none !important;}#portal_block_6308 .content {  margin:0px !important;}#frame9B6v4F {  margin:0px !important;border:medium none !important;}#portal_block_6310 {  margin:0px !important;border:medium none !important;}#portal_block_6310 .content {  margin:0px !important;}#framenR8hX9 {  margin:0px !important;border:medium none !important;}#portal_block_6312 {  margin:0px !important;border:medium none !important;}#portal_block_6312 .content {  margin:0px !important;}#framee3qVls {  margin:0px !important;border:medium none !important;}#framedYm9Kz {  margin:0px !important;border:medium none !important;}#portal_block_6314 {  margin:0px !important;border:medium none !important;}#portal_block_6314 .content {  margin:0px !important;}#framev1kD1q {  margin:0px !important;border:medium none !important;}#portal_block_6316 {  margin:0px !important;border:medium none !important;}#portal_block_6316 .content {  margin:0px !important;}#frame8S7Whl {  margin:0px !important;border:medium none !important;}#portal_block_6317 {  margin:0px !important;border:medium none !important;}#portal_block_6317 .content {  margin:0px !important;}#framefet7Z5 {  margin:0px !important;border:medium none !important;}#portal_block_6319 {  margin:0px !important;border:medium none !important;}#portal_block_6319 .content {  margin:0px !important;}#frame3T9BOI {  margin:0px !important;border:medium none !important;}#portal_block_6320 {  margin:0px !important;border:medium none !important;}#portal_block_6320 .content {  margin:0px !important;}#frame7FvQ13 {  margin:0px !important;border:medium none !important;}#portal_block_6321 {  margin:0px !important;border:medium none !important;}#portal_block_6321 .content {  margin:0px !important;}#frameBN4OqZ {  margin:0px !important;border:medium none !important;}#portal_block_6322 {  margin:0px !important;border:medium none !important;}#portal_block_6322 .content {  margin:0px !important;}#frame3QSUgF {  margin:0px !important;border:medium none !important;}#portal_block_6323 {  margin:0px !important;border:medium none !important;}#portal_block_6323 .content {  margin:0px !important;}#portal_block_6324 {  margin:0px !important;border:medium none !important;}#portal_block_6324 .content {  margin:0px !important;}#frameJZKwL5 {  margin:0px !important;border:medium none !important;}#portal_block_6325 {  margin:0px !important;border:medium none !important;}#portal_block_6325 .content {  margin:0px !important;}#frameMFo5Y3 {  margin:0px !important;border:medium none !important;}#frame13L581 {  margin:0px !important;border:medium none !important;}#portal_block_6329 {  margin:0px !important;border:medium none !important;}#portal_block_6329 .content {  margin:0px !important;}#framezLiVwL {  margin:0px !important;border:medium none !important;}#portal_block_6330 {  margin:0px !important;border:medium none !important;}#portal_block_6330 .content {  margin:0px !important;}#frame8M5H96 {  margin:0px !important;border:medium none !important;}#portal_block_6332 {  margin:0px !important;border:medium none !important;}#portal_block_6332 .content {  margin:0px !important;}#framecrURSj {  margin:0px !important;border:medium none !important;}#portal_block_6334 {  margin:0px !important;border:medium none !important;}#portal_block_6334 .content {  margin:0px !important;}#frame21YgsU {  margin:0px !important;border:0px !important;}#portal_block_6366 {  margin:0px !important;border:0px !important;}#portal_block_6366 .content {  margin:0px !important;}#framePZX3vD {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6367 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6367 .content {  margin:0px !important;}#frame9ETWCp {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 !important;}#portal_block_6860 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 !important;}#portal_block_6860 .content {  margin:0px !important;}#framehIz6hi {  margin:0px !important;border:medium none !important;}#portal_block_6968 {  margin:0px !important;border:medium none !important;}#portal_block_6968 .content {  margin:0px !important;}#framevX4TBe {  margin:0px !important;border:medium none !important;}#portal_block_6969 {  margin:0px !important;border:medium none !important;}#portal_block_6969 .content {  margin:0px !important;}#frameq2vVns {  margin:0px !important;border:medium none !important;}#portal_block_6970 {  margin:0px !important;border:medium none !important;}#portal_block_6970 .content {  margin:0px !important;}#framenbEgnn {  margin:0px !important;border:medium none !important;}#portal_block_6971 {  margin:0px !important;border:medium none !important;}#portal_block_6971 .content {  margin:0px !important;}#frame8ffNnq {  margin:0px !important;border:medium none !important;}#portal_block_6972 {  margin:0px !important;border:medium none !important;}#portal_block_6972 .content {  margin:0px !important;}#frame09848R {  margin:0px !important;border:medium none !important;}#portal_block_6973 {  margin:0px !important;border:medium none !important;}#portal_block_6973 .content {  margin:0px !important;}#frameN1NPp1 {  margin:0px !important;border:medium none !important;}#portal_block_6974 {  margin:0px !important;border:medium none !important;}#portal_block_6974 .content {  margin:0px !important;}#frameHz0qNf {  margin:0px !important;border:medium none !important;}#portal_block_6975 {  margin:0px !important;border:medium none !important;}#portal_block_6975 .content {  margin:0px !important;}#frame35cR2e {  margin:0px !important;border:medium none !important;}#portal_block_6947 {  margin:0px !important;border:medium none !important;}#portal_block_6947 .content {  margin:0px !important;}#frameeaNBne {  margin:0px !important;border:medium none !important;}#portal_block_6976 {  margin:0px !important;border:medium none !important;}#portal_block_6976 .content {  margin:0px !important;}#framesj87Wo {  margin:0px !important;border:medium none !important;}#portal_block_6977 {  margin:0px !important;border:medium none !important;}#portal_block_6977 .content {  margin:0px !important;}#frame93xz5n {  margin:0px !important;border:medium none !important;}#portal_block_6978 {  margin:0px !important;border:medium none !important;}#portal_block_6978 .content {  margin:0px !important;}#frame9oC8NO {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_6979 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_6979 .content {  margin:0px !important;}#frameG84dfg {  margin:0px !important;border:none !important;}#portal_block_6997 {  margin:0px !important;border:none !important;}#portal_block_6997 .content {  margin:0px !important;}#framelHqGzh {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}</style>
</head>

<body>
    <div class="w1100 mt20">
    	<!--头部广告开始-->
<div class="clear_b">
        	<div class="adleft">
            	<!--首页8264logo下小方框SCARPA width="230" height="170" -->
            	<script type='text/javascript'><!--//<![CDATA[
               var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
               var m3_r = Math.floor(Math.random()*99999999999);
               if (!document.MAX_used) document.MAX_used = ',';
               document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
               document.write ("?zoneid=11");
               document.write ('&amp;cb=' + m3_r);
               if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
               document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
               document.write ("&amp;loc=" + escape(window.location));
               if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
               if (document.context) document.write ("&context=" + escape(document.context));
               if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
               document.write ("'><\/scr"+"ipt>");
            //]]>--></script>
                <span class="adtag"></span>
            </div>
            <div class="adright">
            	<div class="adbox">
                    <!--850_80-->
                    <script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=57");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script>
                	<span class="adtag"></span>
                </div>
                <div class="adbox mt10">
                    <!--850_80-->
                    <script type='text/javascript'><!--//<![CDATA[
                   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
                   var m3_r = Math.floor(Math.random()*99999999999);
                   if (!document.MAX_used) document.MAX_used = ',';
                   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
                   document.write ("?zoneid=19");
                   document.write ('&amp;cb=' + m3_r);
                   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
                   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
                   document.write ("&amp;loc=" + escape(window.location));
                   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
                   if (document.context) document.write ("&context=" + escape(document.context));
                   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
                   document.write ("'><\/scr"+"ipt>");
                //]]>--></script>
                	<span class="adtag"></span>
                </div>
            </div>
        </div>
        <!--头部广告结束-->
        <div class="clear_b mt20">
        	<div class="ztbox">
            	<div class="zttitle">
                	<a href="http://www.8264.com/topic_list/" target="_blank"><i></i>活动专题</a>
                </div>
                <div class="ztlist">
                	<ul>
                        <?php block_display('7111'); ?>                    </ul>
                </div>
            </div>
            <div class="adright gray">
            	<div class="fontad clear_b">
                	<ul>
                        <li><?php echo adshow("custom_274"); ?></li>
                        <li><?php echo adshow("custom_275"); ?></li>
                        <li><?php echo adshow("custom_276"); ?></li>
                        <li><?php echo adshow("custom_277"); ?></li>
                        <li><?php echo adshow("custom_278"); ?></li>
                        <li><?php echo adshow("custom_279"); ?></li>
                        <li><?php echo adshow("custom_280"); ?></li>
                        <li><?php echo adshow("custom_281"); ?></li>
                    </ul>
                    <span class="adtag"></span>
                </div>
                <div class="adbox plr50 mtb10 clear_b" style="margin:18px 0px 0px 0px; padding:0px;">
                    <div style="float:left; display:none">
                        <?php echo adshow("custom_453"); ?>                    </div>
                    <div style="float:right; display:none;">
                        <?php echo adshow("custom_454"); ?>                    </div>
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=87");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script>
                    <span class="adtag"></span></div>
            </div>
        </div>
        <!--资讯开始-->
        <div class="mt20">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">推荐</b>
                <div class="taglist">
                	<a href="http://www.8264.com/list/751/" target="_blank">资讯</a>
                	<a href="http://www.8264.com/list/204/" target="_blank">装备</a>
                    <a href="http://www.8264.com/list/489/" target="_blank">业界</a>
                    <a href="http://www.8264.com/list/733/" target="_blank">国际</a>
                    <a href="<?php echo $_G['config']['web']['forum'];?>forum-12-1.html" target="_blank">户外大厅</a>
                    <a href="http://www.ispo.com.cn/" target="_blank" rel="nofollow">来ISPO.看更多</a>
                </div>
                <a href="http://www.8264.com/list/751/" target="_blank" class="morelink">更多</a>
            </div>
            <div class=" clear_b">
            	<div class="w740">
                  <!--资讯开始-->
                  <div class="">
                 <?php block_display('6997'); ?>                    <!-- 户外学校广告 -->
                    <?php echo adshow("custom_475"); ?>                  </div>
                  <!--资讯结束-->
                </div>
                <div class="w300">
                	<div class="righttitle mt27" style="display:none;">装备资讯</div>
                    <div class="zbzxbox" style="display:none;">
                        <div class="zbzxcon">
                            <!--装备单条开始-->
                            <?php if(is_array($article204_array)) foreach($article204_array as $artcle204_date => $article204_item) { ?>                            <div class="zbone">
                                <div class="zbtimebox">
                                    <span class="zbtimecon"><?php echo $artcle204_date;?></span>
                                    <div class="zbconlist">
                                         <?php if(is_array($article204_item)) foreach($article204_item as $val) { ?>                                        <a href="http://www.8264.com/viewnews-<?php echo $val['aid'];?>-page-1.html" target="_blank"><?php echo $val['title'];?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!--装备单条结束-->

                        </div>
                	</div>
                    <div class="adbox" style="margin-top:27px;">
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=83");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script>
                        <span class="adtag"></span>
                    </div>
                    <div class="adbox" style="margin-top:15px;">
                        <?php echo adshow("custom_461"); ?>                    </div>
                </div>
            </div>
        </div>
        <!--资讯结束-->
        <div class="adbox mt10">
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=90");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script>
            <span class="adtag"></span>
        </div>
        <!--游记开始-->
        <div class="mt25">
        	<div class="bigtitlebox clear_b">
            	<b class="bigtitle">经典</b>
                <div class="taglist" style=" width:685px;">
                	<a href="http://www.8264.com/youji/list-370976926840480-2-1.html" target="_blank">四川</a>
                    <a href="http://www.8264.com/youji/list-370866516119456-2-1.html" target="_blank">云南</a>
                    <a href="http://www.8264.com/youji/list-371031142404000-2-1.html" target="_blank">西藏</a>
                    <a href="http://www.8264.com/youji/list-371010400521888-1-1.html" target="_blank">尼泊尔</a>
                    <a href="http://www.8264.com/list/881" target="_blank" class="xialudownload">100条线路攻略下载</a>
                    <a href="http://bbs.8264.com/forum-post-action-newthread-fid-52.html" target="_blank" style="float:right;border-left:none 0;">发布游记</a>
                </div>
                <a href="http://www.8264.com/youji/" target="_blank" class="morelink">更多</a>
            </div>
            <div class=" clear_b">
            	<div class="w740">
                    <div><?php block_display('7113'); ?>                    </div>
                </div>
                <div class="w300">
                	<div class="righttitle mt27">热门旅行地<a href="http://www.8264.com/youji/" target="_blank" class="alllink">全部</a></div>
                    <div class="hotmudidibox clear_b">
                        <ul>
                            <?php if(is_array($place_array)) foreach($place_array as $place_name) { ?>                            <li>
                                <a href="http://www.8264.com/youji/list-<?php echo $place_result[$place_name]['placeid'];?>-<?php echo $place_result[$place_name]['level'];?>-1.html" target="_blank">
                                    <span><?php echo $place_name;?></span>
                                    <em><?php echo $place_result[$place_name]['actnum'];?>篇</em>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="adbox" style="margin-top:15px;">
                    <?php echo adshow("custom_462"); ?>                    	<span class="adtag"></span>
                    </div>
                </div>
            </div>
        </div>
        <!--游记结束-->

         <div class="adbox mt30">
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=15");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script>
            <span class="adtag"></span>
        </div>


         <div class="adbox mt10">
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=81");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script><noscript><a href='http://stats.8264.com/www/delivery/ck.php?n=ab2c2fb4&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://stats.8264.com/www/delivery/avw.php?zoneid=81&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=ab2c2fb4' border='0' alt='' /></a></noscript>
            <span class="adtag"></span>
        </div>










        <div class="mt25">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">户外学校</b>
                <div class="taglist">
                	<a href="http://www.8264.com/list/242" target="_blank">徒步</a>
                    <a href="http://www.8264.com/list/919" target="_blank">滑雪</a>
                    <a href="http://www.8264.com/list/931" target="_blank">急救</a>
                    <a href="http://www.8264.com/list/917" target="_blank">骑行</a>
                    <a href="http://www.8264.com/list/952" target="_blank">潜水</a>
                </div>
                <a href="http://www.8264.com/list/238/" target="_blank" class="morelink">更多</a>
            </div>
            <div class=" clear_b">
            	<div class="w740">
                	<div class=""><?php block_display('7114'); ?>                    </div>
                </div>
                <div class="w300">
                	<div class="righttitle mt27">户外考试</div>
                    <div class="mt20">
                    	<style>
#kaoshiadbox{ width:300px; height:247px; display:block; position:relative;}
#kaoshiadbox span{ display:none;}
#kaoshiadbox:hover span{ position:absolute; display:block; top:0px; left:0px; right:0px; bottom:0px; width:100%; height:247px; display:block;}
</style>
                    	<a href="http://www.8264.com/xuexiao/" target="_blank" id="kaoshiadbox">
                        	<img src="http://static.8264.com/static/images/moban/indexnew/images/kaoshiad_1.jpg">
                            <span><img src="http://static.8264.com/static/images/moban/indexnew/images/kaoshiad_1_h.png"></span>
</a>
                    </div>
                    <div class="kaoshilist mt20 clear_b" style="display:none;">
                    	<ul>
                        	<li><a href="#"><span>安全急救</span><em>8</em></a></li>
                            <li><a href="#"><span>安全急救</span><em>23</em></a></li>
                            <li><a href="#"><span>安全急救</span><em>123</em></a></li>
                            <li><a href="#"><span>安全急救</span><em>123</em></a></li>
                            <li><a href="#"><span>安全急救</span><em>123</em></a></li>
                            <li><a href="#"><span>安全急救</span><em>123</em></a></li>
                            <li><a href="#"><span>安全急救</span><em>123</em></a></li>
                            <li><a href="#"><span>安全急救</span><em>123</em></a></li>
                            <li><a href="#"><span>安全急救</span><em>123</em></a></li>
                            <li><a href="#"><span>安全急救</span><em>123</em></a></li>
                        </ul>
                    </div>
                    <div class="kaoshilist clear_b" style="display:none;">
                    	<ul>
                        	<li><a href="http://www.8264.com/kaoshi/type-exam-cat-1.html" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/xuicon1.png"><span>户外基础</span></a></li>
                            <li><a href="http://www.8264.com/kaoshi/type-exam-cat-2.html" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/xuicon2.png"><span>安全急救</span></a></li>
                            <li class="end"><a href="http://www.8264.com/kaoshi/type-exam-cat-9.html" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/xuicon3.png"><span>滑雪</span></a></li>
                        </ul>
                    </div>
                    <div class="righttitle" style="margin-top:36px;">线下培训</div>
                    <div class="trainbox"><?php echo adshow("custom_455"); ?>                    </div>
                </div>
            </div>
        </div>
        <!--线路开始-->
        <div class="mt25">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">线路</b>
                <a href="http://hd.8264.com/" class="hdad" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/hdad.png"/></a>
                <a href="http://hd.8264.com/" class="morelink" target="_blank">更多</a>
            </div>
            <div class="clear_b">
            	<div class="w740">
                    <div class="hdtop clear_b">
                    <?php if(is_array($xl_result_left_one)) foreach($xl_result_left_one as $id => $item) { ?>                    	<div class="hdtopone <?php if($id>0) { ?> hdtoponeright <?php } ?>">
                            <?php if($item['goods_id']) { ?>
                                <div class="hdbigimg"><a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank"><img src="<?php echo $item['default_image'];?>" /></a></div>
                                <div class="hdtopinfobox">
                                    <a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank"><?php echo $item['title'];?></a>
                                    <div class="didian_datebox clear_b">
<span class="didianleft">
                                        	<b><i>&yen;</i><?php echo $item['price'];?></b>
                                            <em class="begin" style="display:none"><?php echo $item['start_place'];?></em>
                                            <em class="end" style="display:none;"><?php echo $item['end_place'];?></em>
                                        </span>
                                        <span class="dateright"><?php echo $item['start_place'];?>出发</span>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="hdbigimg"><a href="<?php echo $item['url_pc'];?>" target="_blank"><img src="<?php echo $item['default_image'];?>" /></a></div>
                                <div class="hdtopinfobox">
                                    <a href="<?php echo $item['url_pc'];?>" target="_blank"><?php echo $item['title'];?></a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="hdlistbox">
                        <?php if(is_array($xl_result_left_two)) foreach($xl_result_left_two as $id => $item) { ?>                            <div class="hdlistone">
                                <div class="hdlistimg">
                                        <a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank"><img src="<?php echo $item['default_image'];?>"></a>
                                </div>
                                <div class="newsinfo">
                                    <div class="hdtitlebox clear_b">
                                        <h2><a href="http://hd.8264.com/xianlu-<?php echo $item['cate_id'];?>-0-0-0-1" class="channel" target="_blank"><?php echo $item['cate_name'];?></a><a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank" alt="<?php echo $item['title'];?>" title="<?php echo $item['title'];?>"><?php echo $item['title'];?></a></h2>
                                    </div>
                                    <div class="hdinfocon">由<?php echo $item['store_name'];?>提供服务</div>
                                    <div class="hdinfobox clear_b">
<span class="didianleft" style="display:none;">
                                            <em class="begin"><?php echo $item['start_place'];?></em>
                                            <em class="end"><?php echo $item['end_place'];?></em>
                                        </span>
                                        <em class="timeicon"><?php echo $item['goods_spec']['m'];?>-<?php echo $item['goods_spec']['d'];?></em>
                                        <span class="liulan"><?php echo $item['start_place'];?>出发</span>
                                        <b><i>&yen;</i><?php echo $item['price'];?></b>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="w300">
                    <div class="righttitle mt27">周末活动<a href="http://hd.8264.com/xianlu-0-0-0-<?php echo $xl_result_right['placecode'];?>-0-3-1?start=1" class="mudidi" target="_blank"><?php echo $xl_result_right['city'];?></a></div>
                    <div class="weektitlebox" id="weektitlebox" style="display:none;">
                        <?php if(is_array($xl_result_right['data'])) foreach($xl_result_right['data'] as $id => $item) { ?>                            <a href="#" class="<?php if($id == 0) { ?> act <?php } ?>"><?php echo $item['date'];?>月</a>
                        <?php } ?>
                    </div>
                    <div id="weekbox">
                        <?php if(is_array($xl_result_right['data'])) foreach($xl_result_right['data'] as $id => $item) { ?>                        <div class="weekbox" >
                            <!--单条开始-->
                            <div class="weekcon">
                                <div class="weekdate">
                                    <b><?php echo $item['date'];?></b>
                                    <em><?php if($item['month']) { ?><?php echo $item['month'];?>月<?php } else { ?>日期<?php } ?></em>
                                </div>
                                <div class="weekinfo">
                                    <a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank"><?php echo $item['title'];?></a>
                                    <div class="weektxgz clear_b">
                                        <span><?php echo $item['store_name'];?></span>
                                    </div>
                                </div>
                            </div>
                            <!--单条结束-->
                        </div>
                        <?php } ?>
                    </div>
                    <div class="righttitle mt40">热门玩法</div>
                    <div class="hotmudidibox clear_b" style=" margin-top:30px;">
                        <ul>
                            <?php if(is_array($xl_result_right_bottom)) foreach($xl_result_right_bottom as $item) { ?>                            <li>
                                <a href="http://hd.8264.com/xianlu-<?php echo $item['cate_id'];?>-0-0-0-0-0-2-1" target="_blank">
                                    <span><?php echo $item['cate_name'];?></span>
                                    <em><?php echo $item['count'];?>条</em>
                                </a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="http://hd.8264.com/xianlu-0-0-0-0-0-0-2-1" target="_blank">
                                   <i>全部</i>
                                </a>
                            </li>
</ul>
                    </div>
                </div>
            </div>
        </div>
        <!--线路结束-->
        <!--值得买循环开始-->
        <?php include_once(DISCUZ_ROOT.'./source/plugin/skiing/hd_zw.php'); ?>        <?php $zhidemai_list = ForumOptionHuoDong::pianyi_sidebar(6, 'top', 'jiu', '10027'); ?>        <?php if($zhidemai_list) { ?>
        <div class="mt30">
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
        <!--值得买循环结束-->

        <!--问答点评开始-->
        <div class="mt25">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">问答·点评</b>
                <div class="taglist" style="width:620px;">
                	<a href="http://www.8264.com/wenda/list-0-10000062-1.html" target="_blank">户外运动</a>
                    <a href="http://www.8264.com/wenda/list-0-10000015-1.html" target="_blank">徒步</a>
                    <a href="http://www.8264.com/wenda/list-0-10000007-1.html" target="_blank">户外安全</a>
                    <a href="http://www.8264.com/wenda/list-0-10000034-1.html" target="_blank">骑行</a>
                    <a href="http://www.8264.com/wenda/list-0-10000064-1.html" target="_blank">登山</a>
                    <a href="http://www.8264.com/wenda/list-0-10000020-1.html" target="_blank">滑雪</a>
                    <a href="http://bbs.8264.com/forum-post-action-newthread-fid-12.html" target="_blank" style="float:right;border-left:none 0;">我要求助</a>
                </div>
                <a href="http://www.8264.com/wenda/" target="_blank" class="morelink">更多</a>
            </div>
            <div class=" clear_b mt25">
            	<div class="w740">
                	<!--问答开始-->
                	<div class="askbox clear_b">
                    	<div class="askcon">
                            <!--单条开始-->
                            <!-- <?php if(is_array($question_list)) foreach($question_list as $question_one) { ?> -->
                            <div class="askone">
                                <div class="asktop">
                                    <?php echo $question_one['textauthoravatar'];?>
                                    <div class="askinfo">
                                        <span><?php echo $question_one['textauthor'];?></span><em>回答了该问题</em>
                                        <a href="http://www.8264.com/wenda/<?php echo $question_one['topicid'];?>.html" target="_blank"><?php echo $question_one['title'];?></a>
                                    </div>
                                </div>
                                <div class="answerbox">
                                    <div class="answercon">
                                        <?php echo $question_one['textrcontent'];?>
                                    </div>
                                </div>
                            </div>
                            <!-- <?php } ?> -->
                            <!--单条结束-->
                        </div>
                    </div>
                    <!--问答结束-->
                </div>
                <div class="w300">
<div class="dianpinglist">
                    	<div class="dianpingtitle" id="dianpingtitle">
                            <a href="http://www.8264.com/xianlu" class="act" target="_blank">线路</a>
                            <a href="http://www.8264.com/zhuangbei" target="_blank">装备</a>
                            <a href="http://www.8264.com/shanfeng" target="_blank">山峰</a>
                            <a href="http://www.8264.com/xuechang" target="_blank">滑雪场</a>
                        </div>
                        <div id="dianpingcong">
                            <div class="dianpingcon">
                                <!-- <?php if(is_array($linediList)) foreach($linediList as $k => $v) { ?> -->
                                <div class="dianpingone">
                                	<em class="fenshu"><?php if($v['price'] < 10) { ?><?php echo $v['price'];?><?php } else { echo intval($v['price']); } ?></em>
                                    <div class="dianpininfo">
                                    	<a href="http://www.8264.com/xianlu-<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank"><?php echo $v['name'];?></a>
                                        <span class="score-value score-value-<?php echo floor($v['price']); ?>">
                                        	<em></em>
                                        </span>
                                    </div>
                                </div>
                                <!-- <?php } ?> -->
                            </div>

                            <div class="dianpingcon" style="display:none">
                                <!-- <?php if(is_array($eqdiList)) foreach($eqdiList as $k => $v) { ?> -->
                                <div class="dianpingone">
                                	<em class="fenshu"><?php if($v['price'] < 10) { ?><?php echo $v['price'];?><?php } else { echo intval($v['price']); } ?></em>
                                    <div class="dianpininfo">
                                    	<a href="http://www.8264.com/zhuangbei-<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank"><?php echo $v['name'];?></a>
                                        <span class="score-value score-value-<?php echo floor($v['price']); ?>">
                                        	<em></em>
                                        </span>
                                    </div>
                                </div>
                                <!-- <?php } ?> -->
                            </div>

                            <div class="dianpingcon" style="display:none">
                                <!-- <?php if(is_array($mountainList)) foreach($mountainList as $k => $v) { ?> -->
                                <div class="dianpingone">
                                	<em class="fenshu"><?php if($v['price'] < 10) { ?><?php echo $v['price'];?><?php } else { echo intval($v['price']); } ?></em>
                                    <div class="dianpininfo">
                                    	<a href="http://www.8264.com/shanfeng-<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank"><?php echo $v['name'];?></a>
                                        <span class="score-value score-value-<?php echo floor($v['price']); ?>">
                                        	<em></em>
                                        </span>
                                    </div>
                                </div>
                                <!-- <?php } ?> -->
                            </div>

                            <div class="dianpingcon" style="display:none">
                                <!-- <?php if(is_array($skidiList)) foreach($skidiList as $k => $v) { ?> -->
                                <div class="dianpingone">
                                	<em class="fenshu"><?php if($v['price'] < 10) { ?><?php echo $v['price'];?><?php } else { echo intval($v['price']); } ?></em>
                                    <div class="dianpininfo">
                                    	<a href="http://www.8264.com/xuechang-<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank"><?php echo $v['name'];?></a>
                                        <span class="score-value score-value-<?php echo floor($v['price']); ?>">
                                        	<em></em>
                                        </span>
                                    </div>
                                </div>
                                <!-- <?php } ?> -->
                            </div>



</div>
                    </div>
                </div>
            </div>
        </div>
        <!--问答点评结束-->
        <!--活动开始-->
        <div class="">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">8264活动</b>
                <a href="http://www.8264.com/link/marketing.html" target="_blank" class="morelink">更多</a>
            </div>
            <div class=" clear_b mt25"><?php echo adshow("custom_458"); ?>            </div>
            <div class="clear_b bbstschannel">
            	<a href="http://www.8264.com/list/842/" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/mryt.jpg"></a>
                <a href="http://www.8264.com/pp" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/kqmg.jpg"></a>
                <a href="http://www.8264.com/list/880/" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/yzxx.jpg"></a>
                <a href="http://www.8264.com/list/912/" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/hwsys.jpg"></a>
                <a href="http://www.8264.com/list/871/" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/sfc.jpg"></a>
            </div>
        </div>
        <!--活动结束-->
    </div>
    <div class="difangbanbox">
    	<!--地方开始-->
    	<div class="w1100 clear_b pb26">
        	<div class="dfbone first">
            	<div class="dfbtitle">综合版</div>
                <?php block_display('7132'); ?>            </div>
            <div class="dfbone middle">
            	<div class="dfbtitle">专业版</div><?php block_display('7133'); ?>            </div>
            <div class="dfbone end">
            	<div class="dfbtitle">地方版</div>
                <?php block_display('7134'); ?>            </div>
        </div>
        <!--地方结束-->
    </div>
    <div class="friendLinkbox">
    	<div class="w1100 border_t">
        	<div class="border_t_linght clear_b pt26">
            	<?php if(!empty($_G['setting']['pluginhooks']['global_friendlylink'])) echo $_G['setting']['pluginhooks']['global_friendlylink']; ?>
            </div>
        </div>
    </div>
    <!--底部开始-->
    <div class="footerbox">
    	<div class=" w1100 clear_b">
        	<div class="footleftbox">
            	<div class="foot_left_top">
                	户外有风险，8264提醒您购买<a href="http://bx.8264.com/?8264com" target="_blank">户外保险</a>
                    <a target="_blank" href="http://bbs.8264.com/member-clearcookies-formhash-d64f4f90.html" rel="nofollow">清除COOKIE</a>
                    |
                    <a target="_blank" href="http://bbs.8264.com/misc-stat.html" rel="nofollow">站点统计</a>
                    |
                    <a target="_blank" href="http://www.8264.com/about-contact.html" rel="nofollow">联系我们</a>
                    |
                    <a href="http://www.8264.com/about-contact.html#q4" rel="nofollow">8264招聘</a>
                    |
                    <a href="http://bbs.8264.com/misc-faq.html" rel="nofollow">帮助</a>
                    |
                    <a href="http://bbs.8264.com/thread-2317569-1-1.html" style="color:#00b4f9;">8264手机触屏版</a>
                </div>
                <div class="foot_left_bottom"><a href="http://www.miitbeian.gov.cn/" target="_blank">津ICP备05004140号-10</a>&nbsp;&nbsp;&nbsp;ICP证 津B2-20110106&nbsp;&nbsp;&nbsp;天津信一科技有限公司版权所有</div>
            </div>
            <div class="footrightbox">
            	<a class="qdcionbottom" href="http://na3.tjaic.gov.cn/netmonitor/query/ScrNetEntQuery/Display.do?show=1&amp;id=6eb59bd37f0000011ec3c0e5a59f7891-1-v-e-r-&amp;ztLOID=8b4b03e47f0000012b8f0a26c9a87e67" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/guohui.png" width="49px"></a>
            </div>
        </div>
    </div>
    <!--底部结束-->

<!-- 广告位：首页右下角骆驼广告开始 -->
<style>
.bottomclosebox{ height:15px;border:1px solid #e1e1e1; margin:0;padding:0;overflow:hidden; background:#f0f0f0;}
.closeltbutton{ background:url(http://static.8264.com/static/images/moban/index2013/images/closecamle.gif) 0 0 no-repeat; cursor: pointer;float: right;height: 13px; margin: 2px 5px 0 0;width: 39px;}
.closeltbutton:hover{ background:url(http://static.8264.com/static/images/moban/index2013/images/closecamle.gif) 0 -20px no-repeat; }
.smallcamelbox{ width:200px; height:217px; overflow: hidden; z-index: 2147483647; right: 0px; bottom: 0px; position: fixed!important; position: absolute;}
</style>
<div class="smallcamelbox" style="display:none;">
<!-- 广告位：骆驼双11首页右下角（小）390  -->
<script type='text/javascript'><!--//<![CDATA[
       var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
       var m3_r = Math.floor(Math.random()*99999999999);
       if (!document.MAX_used) document.MAX_used = ',';
       document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
       document.write ("?zoneid=7");
       document.write ('&amp;cb=' + m3_r);
       if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
       document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
       document.write ("&amp;loc=" + escape(window.location));
       if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
       if (document.context) document.write ("&context=" + escape(document.context));
       if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
       document.write ("'><\/scr"+"ipt>");
    //]]>--></script>
    <div class="bottomclosebox">
        <span class="closeltbutton"></span>
        <div style="clear:both; font-size:0px; line-height:0px; height:0px;"></div>
    </div>
</div>
<script type="text/javascript">
jQuery(function(){
jQuery(".closeltbutton").click(function(){
jQuery(".smallcamelbox").hide();
});
});
</script>
<!-- 广告位：首页右下角骆驼广告结束 --><?php echo adshow("custom_449"); ?><script type="text/javascript">
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

</body>
</html><?php output(); ?>