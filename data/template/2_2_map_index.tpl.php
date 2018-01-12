<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index', 'common/header_8264_new');
0
|| checktplrefresh('./template/default/map/index.htm', './template/8264/common/header_8264_new.htm', 1509517894, '2', './data/template/2_2_map_index.tpl.php', './template/8264', 'map/index')
|| checktplrefresh('./template/default/map/index.htm', './template/8264/common/zhidemai.htm', 1509517894, '2', './data/template/2_2_map_index.tpl.php', './template/8264', 'map/index')
|| checktplrefresh('./template/default/map/index.htm', './template/8264/common/hd_zw_new.htm', 1509517894, '2', './data/template/2_2_map_index.tpl.php', './template/8264', 'map/index')
|| checktplrefresh('./template/default/map/index.htm', './template/8264/common/footer_8264_new.htm', 1509517894, '2', './data/template/2_2_map_index.tpl.php', './template/8264', 'map/index')
|| checktplrefresh('./template/default/map/index.htm', './template/8264/common/header_common.htm', 1509517894, '2', './data/template/2_2_map_index.tpl.php', './template/8264', 'map/index')
|| checktplrefresh('./template/default/map/index.htm', './template/8264/common/index_ad_top.htm', 1509517894, '2', './data/template/2_2_map_index.tpl.php', './template/8264', 'map/index')
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
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/map/style/style.css?20140411">
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/common_head_bottom.css?20140411">
<div class="header">
    <div class="layout">
        <div class="icoHill">&nbsp;</div>
        <div class="headerL">
            <h1><span class="country">地图</span></h1>
            <div class="site">
                <a href="http://www.8264.com" target="_blank">首页</a><a href="http://www.8264.com/ditu/" target="_blank">地图</a><?php if($result_detail['continent']!='') { if($continent_nav['0']['link']!='') { ?><a href="http://www.8264.com/ditu/<?php echo $continent_nav['0']['link'];?>.htm" target="_blank"><?php echo $result_detail['continent'];?></a><?php } else { ?><a href="http://www.8264.com/ditu/<?php echo $continent_id;?>.htm" target="_blank"><?php echo $result_detail['continent'];?></a><?php } } if($result_detail['nation']!='') { if($nation_nav['0']['link']!='') { ?><a href="http://www.8264.com/ditu/<?php echo $nation_nav['0']['link'];?>.htm" target="_blank"><?php echo $result_detail['nation'];?></a><?php } else { ?><a href="http://www.8264.com/ditu/<?php echo $nation_id;?>.htm" target="_blank"><?php echo $result_detail['nation'];?></a><?php } } if($result_detail['provience']!='') { if($provience_nav['0']['link']!='') { ?><a href="http://www.8264.com/ditu/<?php echo $provience_nav['0']['link'];?>.htm" target="_blank"><?php echo $result_detail['provience'];?></a><?php } else { ?><a href="http://www.8264.com/ditu/<?php echo $provience_id;?>.htm" target="_blank"><?php echo $result_detail['provience'];?></a><?php } } if($result_detail['city']!='') { if($result_detail['link']!='') { ?><a href="http://www.8264.com/ditu/<?php echo $result_detail['link'];?>.htm"><?php echo $result_detail['city'];?></a><?php } else { ?><a href="http://www.8264.com/ditu/<?php echo $result_detail['id'];?>.htm"><?php echo $result_detail['city'];?></a><?php } } if($result_detail['area']!='') { ?><a href="#"><?php echo $result_detail['area'];?></a><?php } ?><?php echo $result_detail['map_name'];?>
            </div>
        </div>
    </div>
</div>
<div class="layout">
    <!-- 值得买 -->
    <?php include(DISCUZ_ROOT.'./source/plugin/skiing/hd_zw.php'); ?>    <?php $zhidemai_list = ForumOptionHuoDong::pianyi_sidebar(6, 'top', 'jiu', '10027'); ?>    <?php if($zhidemai_list) { ?>
    <div style="margin: 20px auto 10px auto;">
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
    <!-- 活动推荐 -->
    <?php $huodong_zaiwai = ForumOptionHuoDong::categoryData(); ?>    <?php if($huodong_zaiwai) { ?>
    <div style="margin: 10px auto 0 auto;">
    <style>
.hd980{ width:978px; margin:0 auto; background:#f6f8fa; padding:0px 0px 15px 0px; border:#e5e5e5 solid 1px;}
.title_hd980{ text-align:center; padding:20px 0px;}
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.hdone{ width:164px; height:112px; background:#fff; border:#eeeeef solid 1px; float:left; position:relative; font-size:0px; line-height:0px; border:#eeeeee solid 1px; padding:7px; margin:0px 0px 0px 13px;}
.hdone img{ width:164px; height:112px;}
.ftpop{ width:164px; height:112px; position:absolute; left:7px; top:7px; line-height:1.5; text-align:center;}
.hdone a{ width:164px; height:112px; display:block;  text-decoration:none; background: #000; opacity: 0; filter: alpha(opacity=0); position: absolute; top:7px; left:7px; z-index:20;}
.hdone a:hover{ text-decoration:none;}
.ftpop span{ color:#fff; font-size:16px; position:relative; text-align:center; display:inline-block; _display:inline; _zoom:1; margin:38px 0px 0px 0px;}
.ftpop em{ color:#fff; font-size:12px; text-align:center; display:block; font-style:normal;}
.ftpop i{ background:url(http://static.8264.com/static/images/zw/hot.jpg) 0px 0px no-repeat; width:10px; height:10px; position:absolute; top:0px; right:-13px; font-size:0px;}
.ftpop i.newicon{ background:url(http://static.8264.com/static/images/zw/new.jpg) 0px 0px no-repeat;}
.bgfff{ background:#fff; border-top:#e5e5e5 solid 1px; border-bottom:#e5e5e5 solid 1px; margin:14px 13px 0px 13px; height:60px; overflow:hidden;}
.bgfff a{ font-size:14px; color:#55c5f9; text-decoration:none; margin:0px 0px 0px 15px; height:60px; line-height:60px; display: inline; white-space: nowrap; display:inline-block; _display:inline; _zoom:1;}
.bgfff span{ height:60px; display:inline-block; _display:inline; _zoom:1; line-height:60px;}
.zbt_icon{ background:url(http://static.8264.com/static/images/zw/dian.png) 27px 22px no-repeat; font-size:16px; color:#333; padding:0px 0px 2px 48px;}
.djhot_icon{ background:url(http://static.8264.com/static/images/zw/fenlei.png) 27px 24px no-repeat; font-size:16px; color:#333; padding:0px 0px 2px 48px;}
</style>
<body>
<div class="hd980" style="display:none;">
<div class="title_hd980"><img src="http://static.8264.com/static/images/zw/titlehd.png"/></div>
    <div class="hdlist clear_b">
    <?php if(is_array($huodong_zaiwai['pic'])) foreach($huodong_zaiwai['pic'] as $id => $cate) { ?>    	<div class="hdone">
        	<img src="http://static.8264.com/static/images/zw/logo_<?php echo $id;?>.jpg">
            <div class="ftpop">
                <span><?php echo $cate['name'];?><?php if(in_array($id, array(4, 7, 71))) { ?><i></i><?php } if(in_array($id, array(52, 16))) { ?><i class="newicon"></i><?php } ?></span>
                <em><?php echo $cate['ename'];?></em>
            </div>
            <a href="http://hd.8264.com/xianlu-<?php echo $id;?>-0-0-0?utm_source=s14363562&utm_campaign=p16195123" target="_blank"></a>
        </div>
        <?php } ?>
    </div>
    <div class="bgfff">
    	<div class="zby">
        	<span class="zbt_icon"><?php echo $huodong_zaiwai['state'];?>周边推荐</span>
            <?php if(is_array($huodong_zaiwai['state_cate']['cates'])) foreach($huodong_zaiwai['state_cate']['cates'] as $id => $name) { ?><a href="http://hd.8264.com/xianlu-<?php echo $id;?>-0-0-<?php echo $huodong_zaiwai['state_cate']['py'];?>-0-3-1?start=1&utm_source=s14363562&utm_campaign=p16195123" target="_blank"><?php echo $name;?></a><?php } ?>
            <span class="djhot_icon">当季热门推荐</span>
            <?php if(is_array($huodong_zaiwai['other'])) foreach($huodong_zaiwai['other'] as $id => $cate) { ?><a href="http://hd.8264.com/xianlu-<?php echo $id;?>-0-0-0?utm_source=s14363562&utm_campaign=p16195123" target="_blank"><?php echo $cate['name'];?></a><?php } ?>
        </div>
    </div>
</div>





<!-- 户外学校广告 -->
<style>
.hotmudidibox{border:#e0e7eb solid 1px; border-bottom:0px; border-right:0px; margin-top:15px; width:980px;background-color: #fff;}
.hotmudidibox li{ width:139px; border-bottom:#e0e7eb solid 1px; border-right:#e0e7eb solid 1px; height:70px; float:left;}
.hotmudidibox li a{ display:block; height:72px; width:133px; text-align:center; overflow:hidden;}
.hotmudidibox li a:hover{text-decoration:none;}
.hotmudidibox li:hover,.hotmudidibox li.hover{ background:#508eff;}
.hotmudidibox li:hover span,.hotmudidibox li.hover span{ color:#fff;}
.hotmudidibox li:hover em,.hotmudidibox li.hover em{ color:#fff;}
.hotmudidibox li span{ font-size:16px; color:#31424e; display: block; width:100%; padding:13px 0px 0px 0px;}
.hotmudidibox li em{ font-size:12px; color:#93a4b0; display:block; width:100%;}
.hotmudidibox li i{ font-size:16px; color:#31424e; display: block; width:100%; line-height:70px; height:72px; font-style:normal;}
.hotmudidibox li:hover i,.hotmudidibox li.hover i{ color:#fff;}
</style>
<div class="hotmudidibox clear_b">
    <ul>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-2.html" target="_blank">
                <span>安全急救考试</span>
                <em>268题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-1.html" target="_blank">
                <span>户外基础考试</span>
                <em>187题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-18.html" target="_blank">
                <span>野外生存考试</span>
                <em>91题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-15.html" target="_blank">
                <span>徒步知识考试</span>
                <em>77题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-5.html" target="_blank">
                <span>登山知识考试</span>
                <em>49题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-3.html" target="_blank">
                <span>攀岩知识考试</span>
                <em>43题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-8.html" target="_blank">
                <span>跑步知识考试</span>
                <em>71题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-16.html" target="_blank">
                <span>露营知识考试</span>
                <em>56题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-21.html" target="_blank">
                <span>户外装备考试</span>
                <em>72题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-24.html" target="_blank">
                <span>户外摄影考试</span>
                <em>84题</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-14.html" target="_blank">
                <span>绳索知识考试</span>
                <em>89题</em>
            </a>
        </li>

        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-37.html" target="_blank">
                <span>运动营养考试</span>
                <em>104题</em>
            </a>
        </li>

        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-39.html" target="_blank">
                <span>马术考试</span>
                <em>69题</em>
            </a>
        </li>

        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-17.html" target="_blank">
                <span>瑜伽考试</span>
                <em>103题</em>
            </a>
        </li>

    </ul>
</div>
<!-- //户外学校广告 -->
    </div>
    <?php } ?>
    <!-- //活动推荐 -->
    <div class="bigtitle clear_b"><?php echo $result_detail['map_name'];?>
        <!-- 活动二维码 -->
        <style>
        .gzhboxheardbox{float:right; cursor:pointer;position:relative; line-height:1.1; margin-right:15px;}
        .gzhboxheardbox .gzhspan{color:#585858;font-size:14px;display:inline-block;margin:0px 0 0 10px;background:url(http://static.8264.com/hd/pc/images/tps/v1/gzhdownarrow.png) right center no-repeat;padding:0 14px 0px 10px; line-height:1}
        .gzhboxheardbox:hover .gzhpopcon{display:none;}
        .gzhpopcon{width:250px;height:120px;position:absolute;top:34px;right:0px;background:rgba(242,242,242,.8);display:block;box-shadow:0 12px 10px rgba(12,4,7,.4)}
        .gzhpopcon img{width:100px;height:100px;float:left;margin:10px 0 0 10px}
        .gzhpopcon p{text-align:center;overflow:hidden;padding:22px 0 0 0;color:#666; font-size:14px;}
        .gzhpopcon b{font-size:18px;font-weight:700;display:block;padding:0 0 8px 0;color:#000}
        </style>
        <div class="gzhboxheardbox">
            <span class="gzhspan" style="color: #000;"><?php echo $result_detail['provience'];?>精彩活动推荐</span>
            <div class="gzhpopcon">
                <img src="http://static.8264.com/hd/pc/images/tps/v1/gzh8264.jpg" height="100" width="100">
                <p><b>扫一扫</b>关注微信号<br>精彩活动每天看</p>
            </div>
        </div>
        <!-- //活动二维码 -->
        <a href="javascript:void(0);" id="download_btn" title="<?php echo $result_detail['map_name'];?>" <?php if($result_detail['provience'] =='天津'||$result_detail['provience'] =='台湾') { ?>style="display:none;"<?php } ?>><?php echo $down_load_name;?>下载</a>
    </div>
    <div class="dituimg" <?php if($result_detail['provience'] =='天津'||$result_detail['provience'] =='台湾') { ?>style="display:none;"<?php } ?> >
        <a href="<?php echo $result_detail['map_img'];?>" target="_blank"><img src="<?php echo $result_detail['map_img'];?>"/></a>
        <div class="updatebox"><?php echo $update_date;?>更新</div>
    </div>

    <?php if($other_list_res) { ?>
    <div class="zbcitylistover4 clear_b">
        <?php if(is_array($other_list_res)) foreach($other_list_res as $others) { ?>        <?php if($others['from']==1) { ?>
        <a href="http://www.8264.com/ditu/<?php echo $others['link'];?>.htm" title="<?php echo $others['map_name'];?>" target="_blank"><?php echo $others['map_name'];?></a>
        <?php } else { ?>
        <a href="http://www.8264.com/ditu/<?php echo $others['id'];?>.htm" title="<?php echo $others['map_name'];?>" target="_blank"><?php echo $others['map_name'];?></a>
        <?php } ?>

        <?php } ?>
    </div>
    <?php } ?>
    <?php if($is_continent==true) { ?>
    <div class="liebiao">
        <div class="liebiaotitle clear_b">
            <span><?php echo $result_detail['continent'];?>各国地图</span>
        </div>
        <div class="zbcitylistover4 clear_b">
            <?php if(is_array($nation_list)) foreach($nation_list as $nations) { ?>            <?php if($nations['from']==1) { ?>
            <a href="http://www.8264.com/ditu/<?php echo $nations['link'];?>.htm" title="<?php echo $nations['nation'];?>地图" target="_blank"><?php echo $nations['nation'];?>地图</a>
            <?php } else { ?>
            <a href="http://www.8264.com/ditu/<?php echo $nations['id'];?>.htm" title="<?php echo $nations['nation'];?>地图" target="_blank"><?php echo $nations['nation'];?>地图</a>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if($is_nation==true) { ?>
    <div class="liebiao">
        <div class="liebiaotitle clear_b">
            <span><?php echo $result_detail['nation'];?>各省地图</span><a href="http://www.8264.com/ditu/" target="_blank">更多</a>
        </div>
        <div class="zbcitylistover4 clear_b">
            <?php if(is_array($provience_list)) foreach($provience_list as $provience) { ?>            <?php if($provience['from']==1) { ?>
            <a href="http://www.8264.com/ditu/<?php echo $provience['link'];?>.htm" title="<?php echo $provience['provience'];?>地图" target="_blank"><?php echo $provience['provience'];?>地图</a>
            <?php } else { ?>
            <a href="http://www.8264.com/ditu/<?php echo $provience['id'];?>.htm" title="<?php echo $provience['provience'];?>地图" target="_blank"><?php echo $provience['provience'];?>地图</a>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if($is_provience==true) { ?>
    <div class="liebiao">
        <div class="liebiaotitle clear_b">
            <span><?php echo $result_detail['provience'];?>各市地图</span><a href="http://www.8264.com/ditu/" target="_blank">更多</a>
        </div>
        <div class="zbcitylistover4 clear_b">
            <?php if(is_array($city_list)) foreach($city_list as $city) { ?>            <?php if($city['from']==1) { ?>
            <a href="http://www.8264.com/ditu/<?php echo $city['link'];?>.htm" title="<?php echo $city['city'];?>地图" target="_blank"><?php echo $city['city'];?>地图</a>
            <?php } else { ?>
            <a href="http://www.8264.com/ditu/<?php echo $city['id'];?>.htm" title="<?php echo $city['city'];?>地图" target="_blank"><?php echo $city['city'];?>地图</a>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if($other_rec_list) { ?>
    <div class="liebiao mb40">
        <div class="liebiaotitle clear_b">
            <span>热门地图</span><a href="http://www.8264.com/ditu/" target="_blank">更多</a>
        </div>
        <div class="zbcitylistover4 clear_b">
            <?php if(is_array($other_rec_list)) foreach($other_rec_list as $others) { ?>            <?php if($others['from']==1) { ?>
            <a href="http://www.8264.com/ditu/<?php echo $others['link'];?>.htm" title="<?php echo $others['map_name'];?>" target="_blank"><?php echo $others['map_name'];?></a>
            <?php } else { ?>
            <a href="http://www.8264.com/ditu/<?php echo $others['id'];?>.htm" title="<?php echo $others['map_name'];?>" target="_blank"><?php echo $others['map_name'];?></a>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>
<!--嵌入公用底部开始--></div>
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
</html><?php output(); ?><script type="text/javascript">
    //特殊字符转换方法，兼容模式
    function escape2Html(str) {
        var arrEntities={'lt':'<','gt':'>','nbsp':' ','amp':'&','quot':'"'};
        return str.replace(/&(lt|gt|nbsp|amp|quot);/ig,function(all,t){return arrEntities[t];});
    }
jQuery(document).ready(function(){
  jQuery("#download_btn").click(function(){
      var gourl = "http://www.8264.com/map.php?ctl=download&amp;map_name="+(jQuery(this).attr("title"))+"&map_img="+(jQuery(".dituimg img").attr("src"));
      window.location.href=escape2Html(gourl);
  });
});
</script>
<!--广告代码开始-->
<div style=" position: absolute; top:140px; left:0px; width:160px;">
<script type="text/javascript"><!--

google_ad_client = "pub-1295541823364623";

/* 160x600, 创建于 10-4-16 */

google_ad_slot = "0916668078";

google_ad_width = 160;

google_ad_height = 600;

//-->

</script>
<script src="http://pagead2.googlesyndication.com/pagead/show_ads.js" type="text/javascript"></script>
</div>
<div style=" position: absolute; top:140px; right:0px; width:160px;">
<script type="text/javascript"><!--

google_ad_client = "pub-1295541823364623";

/* 160x600, 创建于 10-4-16 */

google_ad_slot = "0916668078";

google_ad_width = 160;

google_ad_height = 600;

//-->

</script>
<script src="http://pagead2.googlesyndication.com/pagead/show_ads.js" type="text/javascript"></script>
</div>
<!--广告代码结束-->








