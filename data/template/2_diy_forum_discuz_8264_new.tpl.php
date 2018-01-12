<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('discuz_8264_new', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/forum/discuz_8264_new.htm', './template/8264/common/header_8264_new.htm', 1509517867, 'diy', './data/template/2_diy_forum_discuz_8264_new.tpl.php', 'data/diy', 'forum/discuz_8264_new')
|| checktplrefresh('./template/8264/forum/discuz_8264_new.htm', './template/8264/common/fastnavigation.htm', 1509517867, 'diy', './data/template/2_diy_forum_discuz_8264_new.tpl.php', 'data/diy', 'forum/discuz_8264_new')
|| checktplrefresh('./template/8264/forum/discuz_8264_new.htm', './template/8264/common/weixin_share_bottom.htm', 1509517867, 'diy', './data/template/2_diy_forum_discuz_8264_new.tpl.php', 'data/diy', 'forum/discuz_8264_new')
|| checktplrefresh('./template/8264/forum/discuz_8264_new.htm', './template/8264/common/camel_ad.htm', 1509517867, 'diy', './data/template/2_diy_forum_discuz_8264_new.tpl.php', 'data/diy', 'forum/discuz_8264_new')
|| checktplrefresh('./template/8264/forum/discuz_8264_new.htm', './template/8264/common/footer_forum_8264_new.htm', 1509517867, 'diy', './data/template/2_diy_forum_discuz_8264_new.tpl.php', 'data/diy', 'forum/discuz_8264_new')
|| checktplrefresh('./template/8264/forum/discuz_8264_new.htm', './template/8264/common/header_common.htm', 1509517867, 'diy', './data/template/2_diy_forum_discuz_8264_new.tpl.php', 'data/diy', 'forum/discuz_8264_new')
|| checktplrefresh('./template/8264/forum/discuz_8264_new.htm', './template/8264/common/index_ad_top.htm', 1509517867, 'diy', './data/template/2_diy_forum_discuz_8264_new.tpl.php', 'data/diy', 'forum/discuz_8264_new')
|| checktplrefresh('./template/8264/forum/discuz_8264_new.htm', './template/8264/common/footer_8264_new.htm', 1509517867, 'diy', './data/template/2_diy_forum_discuz_8264_new.tpl.php', 'data/diy', 'forum/discuz_8264_new')
;
block_get('6905');?>
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
<style id="diy_style" type="text/css"></style>
<link href="http://static.8264.com/static/css/forum/forum_index.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/discuz_index.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<script src="http://static.8264.com/static/js/header_index.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script>
<div class="wFull_">
<!-- 头部 -->
<div class="header">
<div class="layout">
<div class="icoHill">山</div>
<style>
.dsad{ position:absolute; left:168px; top:18px;}
.dsad1{ position:absolute; left:432px; top:18px;}
</style>
<div class="dsad"><?php echo adshow("custom_252"); ?></div>
<div class="dsad1"><?php echo adshow("custom_301"); ?></div>
<div class="headerL">
<h1>
<span class="country">驴友论坛</span>
</h1>
<div class="site">
<a href="<?php echo $_G['config']['web']['portal'];?>">首页</a>
<em>&rsaquo;</em>
<span class="xlsj">驴友论坛</span>
</div>
</div>
<div class="headerR">
<div class="bbsNumCount">
<div class="numBox">
<p class="num"><?php echo $_G['cache']['userstats']['totalmembers'];?></p>
<p class="day">会员</p>
</div>
<div class="numBox">
<p class="num"><?php echo $posts;?></p>
<p class="day">帖子</p>
</div>
<div class="numBox" style="display:none;">
<p class="num"><?php echo $postdata['0'];?></p>
<p class="day">昨日</p>
</div>
<div class="numBox" style="display:none;">
<p class="num"><?php echo $todayposts;?></p>
<p class="day">今日</p>
</div>
</div>
</div><style>
.nav_t_p_a{ width:980px; border:#d8d8d8 solid 1px; position:absolute; top:52px; right:0px;z-index: 6363;background: #fff; box-shadow: 0 2px 5px #CCCCCC}
.nav_t_p_a dl{ display:table; border-bottom:#d8d8d8 solid 1px; width:100%; margin:0;  padding:11px 0px 6px 0px; background:url(http://static.8264.com/static/image/common/bbsnavbg.jpg) -21px 0px repeat-y;}
.nav_t_p_a dl.without_b{ border-bottom:none 0;}
.nav_t_p_a dt{ float:left; width:94px; margin:0px; padding:0px; text-indent:15px; height:100%;font-size:12px; color:#fff;}
.nav_t_p_a dd{ margin:0px; padding:0px; overflow:hidden;}
.nav_t_p_a dd a{ margin:0px 20px 5px 0px; display:inline-block; white-space: nowrap;}
.nav_t_p_a dd a:hover{ color:#43A6DF;}
.headerL .site .xlsj{ padding:0px 16px 0px 0px; background:url(http://static.8264.com/static/image/common/arrow_xl.jpg) 51px 7px no-repeat; }
.headerL .site .xlsj_down{ padding:0px 16px 0px 0px; background:url(http://static.8264.com/static/image/common/arrow_xl.jpg) 51px -8px no-repeat; }

</style>
<?php if($catlist) { ?>
<div class="nav_t_p_a" style="display: none;"><?php if(is_array($catlist)) foreach($catlist as $key => $cat) { ?><dl <?php if($cat['extra']['classname']) { ?>class="bg"<?php } ?>>
<dt><?php echo $cat['name'];?></dt>		
<?php if($cat['forumcolumns'] == 0) { ?>
<dd><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { ?><?php $forum['domain']=$alldomainwithfid[$forumid]; ?> <?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forumid; ?><a href="<?php echo $forumurl;?>">
<i><?php echo $forumlist[$forumid]['name'];?></i>								
</a>
<?php } ?>
</dd>
<?php } else { ?>
<dd><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { ?><?php $forum['domain']=$alldomainwithfid[$forumid]; ?> <?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forumid; ?> 

<?php if($forumlist[$forumid]['extra']['localname'] != '') { } else { } ?>

<a href="<?php if($forumlist[$forumid]['redirect']) { ?><?php echo $forumlist[$forumid]['redirect'];?>" target="_blank"<?php } else { ?><?php echo $forumurl;?>"<?php } ?> ><?php echo $forumlist[$forumid]['name'];?> <?php if($forumid == 493) { } else { } ?></a>



<?php } ?>
</dd>
<?php } ?>		
</dl>

<?php } ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){	
$('.site .xlsj, .nav_t_p_a').hover(function(){	
clearTimeout(window.acCtrl);		
$(".nav_t_p_a").show();
},function(){		
window.acCtrl=setTimeout(function(){$(".nav_t_p_a").hide();},300);
});
})
</script>
<?php } ?>		

</div>
</div>

        <div class="layout mt10" style="background:#fff; position:relative">
<script type='text/javascript'><!--//<![CDATA[
               var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
               var m3_r = Math.floor(Math.random()*99999999999);
               if (!document.MAX_used) document.MAX_used = ',';
               document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
               document.write ("?zoneid=73");
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






<!-- 文字广告 -->
<div class="layout mt10" style="background:#fff; position:relative;"><?php echo adshow("text/layout"); ?>            <span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px; line-height:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
</div>





        <div class="layout mt10" style="background:#fff; position:relative;">
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=85");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script><noscript><a href='http://stats.8264.com/www/delivery/ck.php?n=a4e559a6&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://stats.8264.com/www/delivery/avw.php?zoneid=85&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a4e559a6' border='0' alt='' /></a></noscript>
            <span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px; line-height:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
</div>

<!--[diy=diy0]--><div id="diy0" class="area"></div><!--[/diy]--><?php $alldomainwithfid = $forumOption->getdomainbyfid('all'); if(is_array($catlist)) foreach($catlist as $key => $cat) { ?><div class="layout mt10" id="category_<?php echo $cat['fid'];?>">
<div <?php if($cat['extra']['classname']) { ?>class="<?php echo $cat['extra']['classname'];?>"<?php } ?> >
<div class="hd">
<h1 class="indexH1"<?php if($cat['fid'] == 76) { ?> style="position: relative;"<?php } ?>><?php echo $cat['name'];?><?php if($cat['fid'] == 76) { } ?></h1>
</div>
<div class="bd">
<?php if($cat['forumcolumns'] == 0) { ?>
<div class="spRecIcon"><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { ?><?php $forum['domain']=$alldomainwithfid[$forumid]; ?><?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forumid; ?><a href="<?php echo $forumurl;?>" <?php if($forumlist[$forumid]['extra']['classname']) { ?>class="<?php echo $forumlist[$forumid]['extra']['classname'];?>"<?php } ?> >
<i><?php echo $forumlist[$forumid]['name'];?>(<?php echo $forumlist[$forumid]['todayposts'];?>)</i>
<br>
<em><?php echo $forumlist[$forumid]['description'];?></em>
</a>
<?php } ?>
</div>
<?php } else { ?>
<ul class="<?php if($cat['forumcolumns'] >=5) { ?>localForumList<?php } else { ?>row_<?php echo $cat['forumcolumns'];?>_980_list<?php } ?>"><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { ?><?php $forum['domain']=$alldomainwithfid[$forumid]; ?><?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forumid; ?><li>
<?php if($forumlist[$forumid]['extra']['localname'] != '') { ?>
<a class="leftPic" href="<?php if($forumlist[$forumid]['redirect']) { ?><?php echo $forumlist[$forumid]['redirect'];?>" target="_blank<?php } else { ?><?php echo $forumurl;?><?php } ?>" <?php if($cat['extra']['backpicclass']) { ?>class="<?php echo $cat['extra']['backpicclass'];?>"<?php } ?> >
<?php echo $forumlist[$forumid]['extra']['localname'];?>
</a>
<?php } else { ?>
<a href="<?php if($forumlist[$forumid]['redirect']) { ?><?php echo $forumlist[$forumid]['redirect'];?>" target="_blank<?php } else { ?><?php echo $forumurl;?><?php } ?>" <?php if($cat['extra']['backpicclass']) { ?>class="<?php echo $cat['extra']['backpicclass'];?>"<?php } ?> >
<img src="<?php echo $forumlist[$forumid]['iconsrc'];?>" <?php if(!$cat['extra']['backpicclass']) { ?>class="leftPic"<?php } ?> />
</a>
<?php } ?>
<div class="titText" <?php if($forumid == 493) { ?>style="height:52px;"<?php } ?>>
<h2>
<a href="<?php if($forumlist[$forumid]['redirect']) { ?><?php echo $forumlist[$forumid]['redirect'];?>" target="_blank"<?php } else { ?><?php echo $forumurl;?>"<?php } ?> ><?php echo $forumlist[$forumid]['name'];?> <?php if($forumid == 493 || $forumid == 169 || $forumid == 504 || $forumid == 489 || $forumid == 505) { } else { ?><span>(<?php echo $forumlist[$forumid]['todayposts'];?>)</span><?php } ?></a>
</h2>
<h3><?php echo $forumlist[$forumid]['description'];?></h3>
</div>
<?php if($cat['forumcolumns'] <4) { ?>
<div class="countNum">
                <?php if($forumid == 504 || $forumid == 489 || $forumid == 505) { } elseif($forumid == 493) { ?>
<a target="_blank" href="http://tuan.7jia2.com/?from=8264daohang"><img src="<?php echo $_G['config']['web']['static'];?>common/otherweb/lvyoumall_38x25.jpg" /></a>
<?php } elseif($forumid == 169) { ?>
<a href="https://detail.tmall.com/item.htm?id=536408071204" target="_blank">爆款三合一冲锋衣疯抢</a>
<?php } else { ?>
<span class="cmt"><?php echo $forumlist[$forumid]['threads'];?></span>
<span class="read"><?php echo $forumlist[$forumid]['posts'];?></span>
<?php } ?>
</div>
<?php } ?>
</li>
<?php } ?>
</ul>
<?php } ?>
</div>
</div>
</div>

        <?php if($cat['fid'] == 180 && $gid == 0) { ?>
<div class="layout" style="position:relative">
        	<!-- 论坛地方版上面 户外装备下面 位置广告 --><?php echo adshow("custom_437"); ?>            <span style="width:26px; height:13px; position:absolute; bottom:0px; right:0px; font-size:0px; line-height:0px;"><img src="http://static.8264.com/static/images/common/ad_logo_update_IAB.gif"></span>
</div>
<?php } if($cat['fid'] == 67 && $gid == 0) { ?><?php $arr = gettasklistbyindex(); if($arr) { ?>
<style>
.bbsrwlist li:after,.bbsrwlist b:after{content: ""; display: block; clear: both; visibility: hidden;}
.bbsrwlist li,.bbsrwlist b{ zoom: 1;}
.bbsrwlist li{ width:184px; height:84px; float:left; display:inline; font-size:12px; margin:0px 12px 0px 0px; display:inline;}
.bbsrwlist li a{ display:block; height:84px; color:#fff; font-size:}
.bbsrwlist li a:hover{ background:#1a2b38}
.bbsrwlist li .blue_1{ background:#43A6DF;}
.bbsrwlist .end{ margin-right:0px;}
.bbsrwlist span{ height:38px; padding:12px 15px 0px 15px; display:block; overflow:hidden;}
.bbsrwlist b{ display:block; font-weight:normal; font-size:18px; padding:0px 15px;}
.bbsrwlist b em{ color:#9cd5f5; font-style:normal; font-size:12px; float:left; padding:6px 5px 0px 0px;}
.bbsrwlist strong{ font-weight:normal; float:right; padding-right:5px;}
.bbsrwlist .fr{ float:right;}
</style>
<div class="layout mt10">
<ul class="bbsrwlist"><?php if(is_array($arr)) foreach($arr as $task) { ?><li>
<a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="blue_1">
<span><?php echo $task['name'];?></span>
<b>
<em>奖励</em>
<em class="fr">枚</em>
<strong><?php echo $task['rnum'];?></strong>
<em class="fr"><?php echo $task['reward'];?></em>
</b>
</a>
</li>
<?php } ?>
</ul>
</div>
<?php } } if($cat['fid'] == 38 && $gid == 0) { ?>
<div class="layout mt10 mb26">
        	<ul class="jxtj">
            	<li>论坛精选<?php if($newlistcount['871'] > 0) { ?><span class="number" ><?php echo $newlistcount['871'];?></span><?php } ?><a href="<?php echo $_G['config']['web']['portal'];?>list/871" onclick="newtipsban('871', <?php echo $portallist_array['871'];?>);" class="first"></a></li>
                <li>每日一图<?php if($newlistcount['842'] > 0) { ?><span class="number"><?php echo $newlistcount['842'];?></span><?php } ?><a href="<?php echo $_G['config']['web']['portal'];?>list/842" onclick="newtipsban('842', <?php echo $portallist_array['842'];?>);" class="second"></a></li>
                <li>户外摄影师<?php if($newlistcount['912'] > 0) { ?><span class="number"><?php echo $newlistcount['912'];?></span><?php } ?><a href="<?php echo $_G['config']['web']['portal'];?>list/912" onclick="newtipsban('912', <?php echo $portallist_array['912'];?>);"  class="third"></a></li>
                <li>铿锵玫瑰<?php if($newlistcount['878'] > 0) { ?><span class="number"><?php echo $newlistcount['878'];?></span><?php } ?><a href="<?php echo $_G['config']['web']['portal'];?>pp" onclick="newtipsban('878', <?php echo $portallist_array['878'];?>);" class="forth"></a></li>
                <li>线路推荐<?php if($newlistcount['881'] > 0) { ?><span class="number" style="display:none;"><?php echo $newlistcount['881'];?></span><?php } ?><a href="<?php echo $_G['config']['web']['portal'];?>list/881" onclick="newtipsban('881', <?php echo $portallist_array['881'];?>);" class="fifth"></a></li>
                <li  class="end">勇者先行<a href="http://www.8264.com/list/880" target="_blank" class="sixth"></a></li>
            </ul>
        </div>
        <?php } } ?>
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
<?php if(!empty($_G['setting']['pluginhooks']['index_middle'])) echo $_G['setting']['pluginhooks']['index_middle']; ?>
<!-- 彩色广告 -->
<?php if(!empty($_G['setting']['pluginhooks']['index_bottom'])) echo $_G['setting']['pluginhooks']['index_bottom']; ?>
</div>
<script>
function newtipsban(listid, newnum){
setcookie('8264portallistcount_' + listid, newnum, 2592000);
}
</script><?php echo adshow("custom_446"); ?><!-- 右侧客服 -->
<style type="text/css">
.share_bd_warpten{ width:50px; position:absolute; float:right; position: fixed !important;  position: absolute; z-index: 1; bottom:60px; right: 30px; background:#fff;}
.bbs_share_sc{ width:50px;}
.bbs_share_sc li{ width:50px; height:51px;}
.bbs_share_sc li.ps_re{ position:relative;}
.bbs_share_sc li a{ background:url(http://static.8264.com/static/images/common/baidushare.jpg) no-repeat; display:block; }
.bbs_share_sc li .share{ width:50px; height:50px; background-position:0px 0px;}
.bbs_share_sc li .share:hover{ width:50px; height:50px; background-position:0px -204px;}
.bbs_share_sc li .sc{ width:50px; height:50px; background-position:0px -51px;}
.bbs_share_sc li .sc:hover{ width:50px; height:50px; background-position:0px -255px;}
.bbs_share_sc li .bbsli{ width:50px; height:50px; background-position:0px -102px;}
.bbs_share_sc li .bbsli:hover{ width:50px; height:50px; background-position:0px -306px;}
.bbs_share_sc li .gotop_50{ width:50px; height:50px; background-position:0px -153px;}
.bbs_share_sc li .gotop_50:hover{ width:50px; height:50px; background-position:0px -357px;}
.bbs_share_sc li .kfhelf{ width:50px; height:50px; background-position:0 -867px;}
.bbs_share_sc li .kfhelf:hover{ width:50px; height:50px; background-position:0 -816px;}
.share_bd{ width:200px; position:absolute; height:50px; top:-6px; right:50px; font-size:0px; display:none;}
.bbs_share_sc li .share_bd a{ width:50px; height:50px; background:url(http://static.8264.com/static/images/common/baidushare.jpg) no-repeat; display:inline-block; _display:inline; _zoom:1;}
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
<div class="share_bd_warpten">
  <ul class="bbs_share_sc">
    <li>
      <a href="http://bbs.8264.com/forum-post-action-newthread-fid-12.html" class="p-btn-c btn-28">
        <img src="http://static.8264.com/static/images/common/yjdp1.gif?<?php echo VERHASH;?>"/>
      </a>
    </li>
    <li><a href="http://bbs.8264.com/thread-791154-1-1.html" target="_blank" class="kfhelf"></a></li>
    <li id="gotop_50"><a style="display: none;" href="javascript:;" class="gotop_50"></a></li>
  </ul>
</div>
<script>
(function($){
  var ww=$(window).width();
  var s_bd_r=Math.max((ww-980)/2-60,0);
  $(".share_bd_warpten").css("right",s_bd_r);
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
<!-- //右侧客服 --><style type="text/css">
    .side-float{
        position: fixed;
        width: 161px;
        height: 149px;
        bottom: 85px;
        margin-left: 500px;
        background: url(http://static.8264.com/static/images/tps/v1/scan-161-149.png) no-repeat;
        display: none;
    }
    .side-a{
        display: block;
        width: 100%;
        height: 100%;
    }
    .side-float .side-close{
        position: absolute;
        width: 10px;
        height: 10px;
        right: 1px;
        top: 8px;
        cursor: pointer;
        z-index: 999999;
    }
</style>

<div class="side-float">
    <a class="side-a" href="http://u.8264.com/home-task-do-view-id-1264.html" target="_blank" id="qr_src"></a>
    <span class="side-close"></span>
</div>
<script>
    /*jQuery.get("home.php?mod=task", {is_qr_display:1},function(data) {
        if(data.taskid > 0){
            jQuery('#qr_src').attr('href','home.php?mod=task&do=view&id='+data.taskid);
        }
    },'json');*/

//鍏堟敞閲婃帀
   // if(!getcookie("qr-dialog")) {
//        jQuery(".side-float").show();
//    }
//    jQuery(".side-close").click(function (){
//        jQuery(".side-float").hide();
//        setcookie("qr-dialog", 1, 86400);
//    });
//    jQuery(function(){
//        var width_q = jQuery(window).width();
//        var r_z = (width_q-980)/2 -170;
//        if(r_z<0){
//            jQuery(".side-float").css("right",'0px');
//        }else{
//            jQuery(".side-float").css("right",r_z);
//        };
//    });
</script><?php echo adshow("custom_443"); ?><div class="clearfix"></div>
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