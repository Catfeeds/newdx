<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('upload_index', 'common/header_8264_new');
0
|| checktplrefresh('./source/plugin/picupload/template/upload_index.htm', './template/8264/common/header_8264_new.htm', 1509432478, 'picupload', './data/template/2_picupload_upload_index.tpl.php', './source/plugin/picupload/template', 'upload_index')
|| checktplrefresh('./source/plugin/picupload/template/upload_index.htm', './template/8264/common/footer_8264_new.htm', 1509432478, 'picupload', './data/template/2_picupload_upload_index.tpl.php', './source/plugin/picupload/template', 'upload_index')
|| checktplrefresh('./source/plugin/picupload/template/upload_index.htm', './template/8264/common/header_common.htm', 1509432478, 'picupload', './data/template/2_picupload_upload_index.tpl.php', './source/plugin/picupload/template', 'upload_index')
|| checktplrefresh('./source/plugin/picupload/template/upload_index.htm', './template/8264/common/index_ad_top.htm', 1509432478, 'picupload', './data/template/2_picupload_upload_index.tpl.php', './source/plugin/picupload/template', 'upload_index')
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
<link rel="stylesheet" href="/source/plugin/picupload/style/style.css?<?php echo VERHASH;?>" />

<!--引入JS-->
<script src="http://static.8264.com/static/js/webuploader.js" type="text/javascript"></script>

<div class="wrap">
<form id="newpost" method="post" onsubmit="return false;" autocomplete="off" action="plugin.php?id=picupload:post&amp;fid=<?php echo $_G['fid'];?>">
<div class="wraptitle">
<script type="text/javascript">
var maxnum = <?php echo $maxpic;?>;
var attachserver = "http://<?php echo $_G['config']['cdn']['images']['cdnurl'];?>";
var formactiontype = '<?php echo $_G['gp_action'];?>';
</script>
<span style="float:left"><?php echo $navigation;?></span>
<span style="float:right;font-size:13px;font-weight:300;"><a style="color:#0691D3;" href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>" onclick="return confirm('<?php if($_G['cache']['plugin']['picupload']['tipstext']) { ?><?php echo $_G['cache']['plugin']['picupload']['tipstext'];?><?php } else { ?>您当前编辑的文字信息将会丢失<?php } ?>');">切换到普通发帖</a><a style="color:#0691D3;margin-left:10px;" href="<?php echo $returnurl;?>">返回&nbsp;<?php echo $_G['forum']['name'];?></a></span>
<div style="clear:both;"></div>
</div>
<div class="ft tools_background" id="tools_top" style="width:960px;">
<?php if(!empty($_G['forum']['threadtypes']['types'])) { ?>
<div class="selectft" <?php if($_G['gp_action']!='reply') { ?>onclick="typeidlist.style.display = 'block';"<?php } ?>>
<input type="hidden" name="typeid" value="<?php if($_G['gp_action']=='reply') { ?><?php echo $thread['typeid'];?><?php } else { ?>0<?php } ?>" id="typeid"/><span id="typeid_txt"><?php if($_G['gp_action']=='reply') { ?><?php echo $_G['forum']['threadtypes']['types'][$thread['typeid']];?><?php } else { ?>选择主题分类<?php } ?></span>
<?php if($_G['gp_action']!='reply') { ?>
<div id="typeidlist" class="selecttan"><?php if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $typeid => $name) { ?><a href="javascript:;" typeid="<?php echo $typeid;?>" target="_self" onclick="dosort(this,'typeid',event)"><?php echo strip_tags($name);; ?></a>
<?php } ?>
</div>
<?php } ?>
</div>
<?php } ?>
<div class="textft">
<?php if($_G['gp_action'] != 'reply') { ?>
<input type="text" id="subject" name="subject" onkeyup="strLenCalc(this, 'checklen', 80);" id="textfield" class="textft_name" />
<?php } else { ?>
<span id="subjecthide" class="z">RE: <?php echo strlen($thread[subject])>55 ? substr($thread[subject],0,55)."..." : $thread[subject] ?>&nbsp;</span>
<span>[<a href="javascript:;" onclick="display('subjecthide');display('subjectbox');$('subject').value='RE: <?php echo htmlspecialchars(str_replace('\'', '\\\'', $thread['subject'])); ?>';display('subjectchk');strLenCalc($('subject'), 'checklen', 80);"><?php echo lang('forum/template','modify') ?></a>]</span>
<span id="subjectbox" style="display:none">
<input type="text" id="subject" name="subject" onkeyup="strLenCalc(this, 'checklen', 80);" value="RE: <?php echo $thread['subject'];?>" class="textft_name" /></span>
<?php } ?>
<span id="subjectchk"<?php if($_G['gp_action'] == 'reply') { ?> style="display:none"<?php } ?>>&nbsp;&nbsp;<?php echo lang('forum/template','comment_message1') ?> <strong id="checklen"> 80 </strong><?php echo lang('forum/template','comment_message2') ?></span>
</div>
<input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="posttime" id="posttime" value="<?php echo TIMESTAMP;?>" />
<input type="hidden" name="fid" id="fid" value="<?php echo $_G['fid'];?>"/>
<input type="hidden" name="tid" id="tid" value="<?php if($_G['gp_action']=='reply') { ?><?php echo $_G['tid'];?><?php } else { ?>0<?php } ?>"/>
<input type="hidden" name="action" id="action" value="<?php echo $_G['gp_action'];?>"/>
<?php if(!empty($_G['gp_modthreadkey'])) { ?><input type="hidden" name="modthreadkey" id="modthreadkey" value="<?php echo $_G['gp_modthreadkey'];?>" /><?php } ?>
<input type="hidden" name="wysiwyg" id="<?php echo $editorid;?>_mode" value="<?php echo $editormode;?>" />
<?php if($_G['gp_action'] == 'reply') { ?>
<input type="hidden" name="noticeauthor" value="<?php echo $noticeauthor;?>" />
<input type="hidden" name="noticetrimstr" value="<?php echo $noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $noticeauthormsg;?>" />
<?php } ?>
</div>
</form>
<div class="col_main">
<div id="righttool" class="col_side_l tools_background">
<!--左侧标签title开始-->
<div class="col_side_l_title">
<ul>
<li class="upimg_z" id="selectupload_menu" onclick="if(!this.className.match('_z')){this.className = 'upimg_z';selectalbum_menu.className = 'album';use_album.style.display='none';use_upload.style.display='block';}">上传照片</li>
<li class="album" id="selectalbum_menu" onclick="if(!this.className.match('_z')){this.className = 'album_z';selectupload_menu.className = 'upimg';use_album.style.display='block';use_upload.style.display='none';}">使用相册</li>
</ul>
</div>
<!--左侧标签title结束-->
<div class="col_side_layout">
<form autocomplete="off" action="plugin.php?id=picupload:post" method="post">
<!--状态相册开始-->
<div id="use_album" class="col_side_l_con" style="display:none;">
<div class="note">从我的相册中选择图片</div>
<div class="selectalbumwrap">
<div class="selectalbum" onclick="useajaxalbum.style.display='block';">
<input id="ajaxalbum" type="hidden" value="0"/><span id="ajaxalbum_txt">请选择相册</span>
<div id="useajaxalbum" class="selectalbumtan"><?php if(is_array($albumlist)) foreach($albumlist as $album) { ?><a href="javascript:;" ajaxalbum="<?php echo $album['albumid'];?>" onclick="dosort(this,'ajaxalbum',event);ajaxget('plugin.php?id=picupload:albumlist&abid=' + this.getAttribute('ajaxalbum'),'albumlist_ajax','');" target="_self"><?php echo $album['albumname'];?>&nbsp;(<strong class="xi1 album_num"><?php echo $album['picnum'];?></strong>)</a>
<?php } ?>
</div>
</div>
</div>
<!--相册状态初始开始-->
<div id="albumlist_ajax" class="col_side_main"><img src="http://static.8264.com/static/images/photobg.jpg"/></div>
<!--相册状态初始结束-->
</div>
<!--状态相册结束-->
<!--状态上传开始-->
<div style="margin:0 auto;width:208px;">
<input id="url_action" value="<?php echo $action;?>" type="hidden">
<input id="url_policy" value="<?php echo $policy;?>" type="hidden">
<input id="url_signature" value="<?php echo $sign;?>" type="hidden">

<div id="filePicker">请选择图片</div>
<div><p style="display:none;" id="uploadtips"></p></div>
</div>
<div id="use_upload" class="col_side_l_con">
<div class="upnote">还可上传 <b id="img_sy"><?php echo $maxpic;?></b> 张图片</div>
<div class="bcdxc">
<input id="savetoalbum" name="savetoalbum" type="checkbox" value="1" /><label>保存图片到相册</label>
                    <div id="newalbum_tips" class="tjalbum" style="display:none;">
                        <table width="185" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="tjalumtestwarp"><input id="newalbumname" name="newalbumname" type="text" class="tjalbumtext" /></td>
                            </tr>
                            <tr>
                              <td class="tjalbumbuttomwarp"><input onclick="albumid_txt.innerHTML = newalbumname.value+'<span class=\'red\'>  (New!)  </span>';newalbum_tips.style.display='none';" name="" type="button" class="tjalbumbuttom" />&nbsp;&nbsp;<input name="" onclick="newalbum_tips.style.display='none';" type="reset" class="tjalbumbuttom_reset" value="" /></td>
                            </tr>
                        </table>
                    </div>
</div>
<div class="selectalbumwrap_save">
<div class="selectalbum_save" onclick="selectalbum_list.style.display='block';this.style.zIndex = 10;">
<input id="albumid" type="hidden" name="albumid" value="0"/><span id="albumid_txt">请选择相册</span>
<div id="selectalbum_list" class="selectalbumtan_save" style="display:none;"><?php if(is_array($albumlist)) foreach($albumlist as $album) { ?><a href="javascript:;" albumid="<?php echo $album['albumid'];?>" onclick="dosort(this,'albumid',event)" target="_self"><?php echo $album['albumname'];?>&nbsp;(<strong class="xi1 album_num"><?php echo $album['picnum'];?></strong>)</a>
<?php } ?>
<a href="javascript:;" id="createname" albumid="0" onclick="dosort(this,'albumid',event);newalbum_tips.style.display='';newalbumname.focus();">+创建新相册</a>
</div>
  </div>
</div>
</div>
<!--状态上传开始-->
</form>
</div>
<input type="button" style="border:0px;cursor:pointer;" class="tjbuttom" id="tjbuttom" />
<div style="clear:both;"></div>
</div>
<div class="col_side_r smallpiclist">
<form autocomplete="off" action="plugin.php?id=picupload:post" method="post">
<div class="cztop tools_background" id="pic_tools_tips" style="display:none;width:710px;">
<div class="cztop_l">
<input type="checkbox" id="descriptionallpic" />&nbsp;<label style="margin-right: 10px;">描述图片</label>
<span id="descriptionSelect"><input id="beforeattach" name="beforeattach" type="checkbox" value="1" />&nbsp;<label>描述在图片前</label></span>
</div>
<input id="temp_notic" type="hidden" name="reply_notice" value="1" checked="true"/>
<input type="hidden" name="addfeed" value="1" checked="true"/>
<input type="hidden" name="usesig" value="1" checked="true"/>
<div class="cztop_r"><span style="display: none;visibility: hidden;">当前共有<b id="img_num">0</b>个图片,</span><span>拖动图片可重新排序</span></div>
</div>
</form>

<div id="watting" class="wattingdiv side_r_one side_r_one_float loading">
<form autocomplete="off" action="plugin.php?id=picupload:ajaxpost&amp;inajax=1" method="post">
<div class="side_r_one_img">
<img onload='showmynext(this);' class="attachpic_load attachimg" />
<!--<img style="display: none;" class="attachshows" src="static/image/discuz6/imageloading.gif" />-->
<input type="hidden" class="attach_new"/>
<input type="hidden" class="attachimage" name="attachimage[]" />
<p class="wattingtitle wattings"></p>
<p class="wattings"><b class="wattingpercent"></b></p>
</div>
<div class="side_r_one_text">
<textarea class="texttips attachshows" style="display: none;">请输入描述</textarea>
<textarea class="textshow" style="display:none;" cols="" rows="" ></textarea>
<div class="messagetips wattings"></div>
</div>
<div style="display: none;" class="side_r_one_dele"></div>
<div class="deletepicbtn x_buttom"><input type="hidden" class="attach_delete" name="attachnew[][delete]" value="0" /></div>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="posttime" value="<?php echo TIMESTAMP;?>" />
<input type="hidden" name="fid" value="<?php echo $_G['fid'];?>"/>
<input type="hidden" name="tid" value="<?php if($_G['gp_action']=='reply') { ?><?php echo $_G['tid'];?><?php } else { ?>0<?php } ?>"/>
<input type="hidden" name="action" value="<?php echo $_G['gp_action'];?>"/>
<input type="hidden" name="beforeattach" value="0" />
<input type="hidden" class="albumtype" disabled="true"/>
<input type="hidden" class="albumurl" disabled="true" />
<input type="hidden" value="1" name="savetoalbum" disabled="true" />
<input type="hidden" value="0" name="albumid" disabled="true"/>
<input type="hidden" value="0" name="typeid" disabled="true" />
<?php if(!empty($_G['gp_modthreadkey'])) { ?><input type="hidden" name="modthreadkey" id="modthreadkey" value="<?php echo $_G['gp_modthreadkey'];?>" /><?php } ?>
<div style="clear:both;"></div>
</form>
</div>

<div id="temp_imglist"><div><form action="plugin.php?id=picupload:ajaxpost&amp;inajax=1" method="post"><div class="side_r_one"><input type="hidden" value="album" /><div class="side_r_one_img"><img onload='showmynext(this);' class="attachpic_load attachimg" /><img src="http://static.8264.com/static/image/discuz6/imageloading.gif" /><input type="hidden" value=''/></div><div class="side_r_one_text"><textarea onclick="show_focus(this);">请输入描述</textarea><textarea style="display:none;" onblur="this.parentNode.parentNode.className='side_r_one';" onfocus="this.parentNode.parentNode.className='side_r_one_z';" cols="" rows=""></textarea></div><div class="x_buttom_z" onmouseover="this.className='x_buttom';" onmouseout="this.className='x_buttom_z';" onclick="albumpicdel(this);" id="delid"></div></div></form></div></div><div id='postlist'><div id="imgattachlist"></div></div></div>
</div>
<div style="clear:both;"></div>
</div>
<div id="albumaddexiststips">当前图片已经被添加到这里啦!</div>
<script src="http://static.8264.com/static/js/jquery.form.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script type="text/javascript">var ajaxper = <?php echo $ajaxper;?>;</script>
<script src="source/plugin/picupload/js/picupload.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/webuploader_start.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<!--<script src="static/js/newswfobject.js" type="text/javascript"></script>-->
<script type="text/javascript">
//    var params = {site:"<?php echo $_G['siteroot'];?>misc.php%3fmod=swfupload%26type=image%26fid=<?php echo $fid;?>%26twidth=100%26theight=100%26random=<?php echo random(4); ?>",buttonimg:"http://static.8264.com/static/image/common/uploadnew.png"};
//    swfobject.embedSWF("static/flash/uploadforum.swf", "pic_upload_multiimg", "208", "50", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
//    swfobject.createCSS("#pic_upload_multiimg", "display:block;text-align:left;z-index:200");
ajaxget('plugin.php?id=picupload:imagelist', 'imgattachlist');
</script>
<style>
#watting{display:none;}
#attachtemp{display:none;}
.wattingdiv p{font-size:16px;line-height:18px;text-align:center;margin:13px 5px;}
.wattingdiv .wattingpercent{font-size:24px;line-height:26px;}
.wattingdiv .messagetips{font-size:20px;line-height:100px;}
.attachimg{display:none;}
#flashloading{background: url('http://static.8264.com/static/image/common/uploadnew.png') no-repeat; width:208px;height:50px;line-height:50px;font-size:16px;text-align:center;color:white;font-family: 微软雅黑;position:absolute;}
#flashloading b{margin-left:15px;}
#descriptionSelect{display:none;}
#pic_upload_multiimg{width:208px;height:50px;}
#albumaddexiststips{display:none;padding:10px 18px 15px 10px;line-height:20px;position:absolute;background:url('http://static.8264.com/static/image/common/tips_album.png') no-repeat; width:150px;height:70px;z-index:999;font-size:14px;color:white;font-family:微软雅黑;}

#uploadtips{color:blue;text-align:center;}
#nv_plugin{height:auto;}
#type_select{display:none;}
.album_num{color:#E87C1A;}
#albumid_select{background:#CCC}
#showlist{height:520px;padding-top:10px;}
.floatleft{float:left;}
.img_show{width:120px;height:110px;}
.img_show,.img_des,.img_contrl{margin-left:10px;padding:5px;line-height:110px;text-align:center;}
.imgdeleted {opacity: 0.5;}
#albumlist{height:350px;width:210px;}
#albumlist table td{padding:5px;}
#temp_imglist{display:none;}
.albumaddimg{max-width:100px;max-height:100px;}
.albumaddimg_ie6{width:100px;height:100px;}
.cztop_r b{font-size:15px;margin:0 3px;}
#process{background:#4BB6EA;width:0px;height:40px;}
.red{color:red;}
#tips_tzjx{width:710px;}
.forprocess .alert_info{line-height:100%;padding-left:100px;padding-top:0;padding-bottom:0;min-height:25px;background-image:url("http://static.8264.com/static/image/common/info1.png");font-size:16px;background-position: 0 0;}
.forprocess .alert_info div.ttt{text-align:right;height:25px;line-height:25px;font-weight:700;font-family:"Microsoft YaHei",Tahoma,Helvetica,SimSun,sans-serif}
.forprocess .c.altw{padding:10px 15px;}
.forprocess .t_l,.forprocess .t_c,.forprocess .t_r,.forprocess .m_l,.forprocess .m_r,.forprocess .b_l,.forprocess .b_c,.forprocess .b_r{background-color:#fff;opacity:0.6;}
#tpisoffl{color:#8C8C8C;}
#backgroundprocess{background:#EFEFEF;border:1px #D9D9D9 solid;margin-top:5px;}

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


</style></div>
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