<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('skiing_commentdetail', 'dianping/header');
0
|| checktplrefresh('./template/8264/dianping/skiing_commentdetail.htm', './template/8264/dianping/header.htm', 1509517919, '2', './data/template/2_2_dianping_skiing_commentdetail.tpl.php', './template/8264', 'dianping/skiing_commentdetail')
|| checktplrefresh('./template/8264/dianping/skiing_commentdetail.htm', './template/8264/dianping/nav_comment.htm', 1509517919, '2', './data/template/2_2_dianping_skiing_commentdetail.tpl.php', './template/8264', 'dianping/skiing_commentdetail')
|| checktplrefresh('./template/8264/dianping/skiing_commentdetail.htm', './template/8264/dianping/footer.htm', 1509517919, '2', './data/template/2_2_dianping_skiing_commentdetail.tpl.php', './template/8264', 'dianping/skiing_commentdetail')
|| checktplrefresh('./template/8264/dianping/skiing_commentdetail.htm', './template/8264/common/header_8264_new.htm', 1509517919, '2', './data/template/2_2_dianping_skiing_commentdetail.tpl.php', './template/8264', 'dianping/skiing_commentdetail')
|| checktplrefresh('./template/8264/dianping/skiing_commentdetail.htm', './template/8264/common/ewm_r.htm', 1509517919, '2', './data/template/2_2_dianping_skiing_commentdetail.tpl.php', './template/8264', 'dianping/skiing_commentdetail')
|| checktplrefresh('./template/8264/dianping/skiing_commentdetail.htm', './template/8264/common/weixin_share.htm', 1509517919, '2', './data/template/2_2_dianping_skiing_commentdetail.tpl.php', './template/8264', 'dianping/skiing_commentdetail')
|| checktplrefresh('./template/8264/dianping/skiing_commentdetail.htm', './template/8264/common/footer_8264_new.htm', 1509517919, '2', './data/template/2_2_dianping_skiing_commentdetail.tpl.php', './template/8264', 'dianping/skiing_commentdetail')
|| checktplrefresh('./template/8264/dianping/skiing_commentdetail.htm', './template/8264/common/header_common.htm', 1509517919, '2', './data/template/2_2_dianping_skiing_commentdetail.tpl.php', './template/8264', 'dianping/skiing_commentdetail')
|| checktplrefresh('./template/8264/dianping/skiing_commentdetail.htm', './template/8264/common/index_ad_top.htm', 1509517919, '2', './data/template/2_2_dianping_skiing_commentdetail.tpl.php', './template/8264', 'dianping/skiing_commentdetail')
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
<!-- 新点评开始 -->
<link rel="stylesheet" href="http://static.8264.com/dianping/style/layout_review.css?<?php echo VERHASH;?>">
<script src="http://static.8264.com/dianping/js/common.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script>
<?php if($act == 'showview' && $_G['adminid'] == 1) { ?>
<script type="text/javascript">var fid = parseInt('<?php echo $dp_modules[$mod]['fid'];?>'), tid = parseInt('<?php echo $tid;?>');</script>
<script src="http://static.8264.com/static/js/forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/forum_moderator.css?<?php echo VERHASH;?>" />
<?php } ?>
<script src="http://static.8264.com/static/js/newswfobject.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/dianping/easydialog.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/dianping/pro_city.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/formValidator-4.0.1.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/forum_calendar.css?<?php echo VERHASH;?>" />
<div id="container" class="ui-container">
<div class="global-common-header">
<div class="module">
<div class="global-marks">
<div class="ui-block ui-block-title">
<div class="ui-title">
<h2><?php echo $dp_modules[$mod]['cname'];?></h2>
</div>
</div>
<div class="ui-crumbs ui-crumbs-box textoverflow">
<a href="http://www.8264.com/" title="网站首页">首页</a>
<span>&gt;</span>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist" title="<?php echo $dp_modules[$mod]['cname'];?>"><?php echo $dp_modules[$mod]['cname'];?></a>
<?php echo $subnav;?>
<?php if($tid && $detail['subject']) { ?>
<span>&gt;</span>
<strong><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>" title="<?php echo $detail['subject'];?>" style="background:url('http://static.8264.com/dianping/images/icon/data/crumb_bg.gif') 100% 50% no-repeat;"><?php echo $detail['subject'];?></a></strong>
<?php } ?>
                                <?php if($tid && $commentlist['author']) { ?>
                                        <?php echo $commentlist['author'];?>的点评
<?php } if($bid) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=<?php echo $order;?>&amp;pcid=<?php echo $pcid;?>&amp;cid=<?php echo $cid;?>&amp;bid=0<?php if($min || $max) { ?>&amp;min=<?php echo $min;?>&amp;max=<?php echo $max;?><?php } ?>&amp;page=1" class="condition"><?php echo $brandlist[$bid]['subject'];?></a><?php } ?>
</div>
<?php if($act=='showview') { if($mod=='skiing' && $act=='showview') { ?>
<em class="city-change">
<em class="city-blue">（切换城市）</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($region)) foreach($region as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;pro=<?php echo $k;?>&amp;page=1"><?php echo $v['name'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='shop') { ?>
<em class="city-change">
<em class="city-blue">（切换城市）</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($arr_region)) foreach($arr_region as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;pid=<?php echo $k;?>&amp;rid=0&amp;sid=0&amp;cid=0&amp;bid=0&amp;order=lastpost&amp;page=1"><?php echo $v['name'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='climb' ) { ?>
<em class="city-change">
<em class="city-blue">（切换城市）</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($proList)) foreach($proList as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;type=0&amp;placetype=0&amp;provinceid=<?php echo $k;?>&amp;cityid=0&amp;page=1"><?php echo $v['cityname'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='diving') { ?>
<em class="city-change">
<em class="city-blue">（切换城市）</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($proList)) foreach($proList as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;type=0&amp;provinceid=<?php echo $k;?>&amp;cityid=0&amp;page=1"><?php echo $v['cityname'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='mountain') { ?>
<em class="city-change">
<em class="city-blue">（切换城市）</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($cate_dq)) foreach($cate_dq as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;dq=<?php echo $k;?>&amp;gd=0&amp;page=1"><?php echo $v;?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='line') { ?>
<em class="city-change">
<em class="city-blue">（切换城市）</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($proList)) foreach($proList as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;type=0&amp;timetype=0&amp;provinceid=<?php echo $k;?>&amp;cityid=0&amp;page=1"><?php echo $regionList[$k]['cityname'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='fishing') { ?>
<em class="city-change">
<em class="city-blue">（切换城市）</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($proList)) foreach($proList as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;type=0&amp;isfree=0&amp;provinceid=<?php echo $k;?>&amp;cityid=0&amp;order=lastpost&amp;page=1"><?php echo $v['cityname'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } } ?>

</div>
<ul class="global-nav"><?php if(is_array($dp_modules)) foreach($dp_modules as $v) { if($v['enable']==1) { ?>
<li class="global-nav-item<?php if($v['mname']==$mod) { ?> global-nav-item-current<?php } ?>">
<a href="http://www.8264.com/dianping.php?mod=<?php echo $v['mname'];?>&amp;act=showlist" title="<?php echo $v['cname'];?>"><?php echo $v['cname'];?></a>
</li>
<?php } } ?>
</ul>
<div class="hill-icon"></div>
</div>
</div>
<link rel="stylesheet" id="css_widthauto" type="text/css" href="./static/css/dianping/style_comment.css" />
<div class="global-common-content">
    <div class="module">
        <!--左侧开始-->
        <div class="col-main">
            <div class="main-wrap">
            	<!--单条评论开始-->
                <div class="ui-grid-6 ui-grid-left">
                    <div class="review-comment-box">
                        <div class="">   
                            <div class="comment-main">
                                <div class="comment-list-box">
<!--                                    <div class="avatar-box">
                                    <a rel="nofollow" target="_blank" class="user-avatar" href="home.php?mod=space&amp;uid=<?php echo $commentlist['authorid'];?>">
                                        <?php echo avatar($commentlist['authorid'], small); ?>                                        <span class="user-name"><?php echo $commentlist['author'];?></span>
                                    </a>
                                    </div>-->
                                    <div>
                                        <?php if($commentlist['starnum']) { ?>
                                            <div class="rows-content row-color-1">
                                                <div class="commAttr">
                                                <i class="attrs-icon comm"></i>推荐
                                                </div>
                                                <div class="attrValues">
                                                    <div class="rating-level big-rating">
                                                        <span class="score-value score-value-<?php echo $commentlist['starnum']*2; ?>">
                                                        <em></em>
                                                        </span>
                                                        <span>(<?php if($commentlist['starnum']==1) { ?>很差<?php } elseif($commentlist['starnum']==2) { ?>较差<?php } elseif($commentlist['starnum']==3) { ?>还行<?php } elseif($commentlist['starnum']==4) { ?>推荐<?php } elseif($commentlist['starnum']==5) { ?>力荐<?php } ?>)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($commentlist['weakpoint']) { ?>
                                            <div class="rows-content row-color-3">
                                                <div class="commAttr">
                                                <i class="attrs-icon note"></i>不足
                                                </div>
                                                <div class="attrValues">
                                                <p><?php echo $commentlist['weakpoint'];?></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($commentlist['goodpoint']) { ?>
                                            <div class="rows-content row-color-4">
                                            <div class="commAttr">
                                            <i class="attrs-icon date"></i>优点
                                            </div>
                                            <div class="attrValues">
                                            <p><?php echo $commentlist['goodpoint'];?></p>
                                            </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($commentlist['message']) { ?>
                                            <div class="rows-content row-color-5">
                                                <div class="commAttr">
                                                <i class="attrs-icon complex"></i>综合
                                                </div>
                                                <div class="attrValues">
                                                <p><?php echo $commentlist['message'];?></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($commentlist['attachlist']) { ?>
                                            <div class="rows-content row-color-6">
                                                <div class="commAttr">
                                                    <i class="attrs-icon picture"></i>图片
                                                </div>
                                                <div class="attrValues">
                                                    <ul class="attrPic-list">
                                                        <?php if(is_array($commentlist['attachlist'])) foreach($commentlist['attachlist'] as $item) { ?>                                                        <li>
                                                            <a href="http://<?php if($item['serverid']==1) { ?>image<?php } elseif($item['serverid']==99) { ?>image1<?php } ?>.8264.com/<?php echo $item['dir'];?>/<?php echo $item['attachment'];?>" target="_blank" title="点击查看大图"><img src="<?php echo getimagethumb(80,80,2, $item['dir'].'/'.$item['attachment'], '', $item['serverid']); ?>" alt="<?php echo $comment['subject'];?>"></a>
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php } ?>
                                    <div class="rows-content">
                                    <div class="attrValues rows-detail">
                                    <span class="rows-time"><?php echo dgmdate($commentlist['dateline']); ?></span>
                                    <span class="rows-title"><a target="_blank" title="<?php echo $commentlist['subject'];?>" href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $commentlist['tid'];?>"><?php echo $commentlist['subject'];?></a></span>
                                    
                                    </div>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--单条评论结束-->
                <div class="ui-grid-6 ui-grid-left">
                	<div class="morecommenttitle clear_b">
                    	<span>更多<?php echo $commentlist['subject'];?>的点评</span>
                        <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $commentlist['tid'];?>" target="_blank">全部点评（共<?php echo $detail['cnum'];?>条）></a>
                    </div>
                    <div class="review-comment-box">
                    	<!--单条循环开始-->
                        <?php if($comm_pre) { ?>
                        <?php if(is_array($comm_pre)) foreach($comm_pre as $pre) { ?>                        <div class="ui-block ui-block-content">
                            <div class="comment-main">
                                <div class="comment-list-box">
                                    <div class="avatar-box">
                                    <a rel="nofollow" target="_blank" class="user-avatar" href="home.php?mod=space&amp;uid=<?php echo $pre['authorid'];?>">
                                        <?php echo avatar($pre['authorid'], small); ?>                                    </a>
                                    </div>
                                    <div class="comment-word">
                                        <div class="plname clear_b">
                                        	<span><?php echo $pre['author'];?></span>
                                            <em><?php echo dgmdate($pre['dateline'],'Y-m-d'); ?></em>
                                        </div>
                                        <div class="attrValues">
                                            <div class="rating-level big-rating">
                                                <span class="score-value score-value-<?php echo $pre['starnum']*2; ?>">
                                                    <em></em>
                                                </span>
                                                <span>(<?php if($pre['starnum']==1) { ?>很差<?php } elseif($pre['starnum']==2) { ?>较差<?php } elseif($pre['starnum']==3) { ?>还行<?php } elseif($pre['starnum']==4) { ?>推荐<?php } elseif($pre['starnum']==5) { ?>力荐<?php } ?>)</span>
                                            </div>
                                        </div>
                                        <div class="attrValues pt15">
                                            <p><?php echo $pre['message'];?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=commentdetail&amp;tid=<?php echo $pre['tid'];?>&amp;pid=<?php echo $pre['pid'];?>&amp;uid=<?php echo $pre['uid'];?>" target="_blank" class="morelink">显示全文</a></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <?php if($comm_next) { ?>
                        <?php if(is_array($comm_next)) foreach($comm_next as $next) { ?>                        <div class="ui-block ui-block-content">
                            <div class="comment-main">
                                <div class="comment-list-box">
                                    <div class="avatar-box">
                                    <a rel="nofollow" target="_blank" class="user-avatar" href="home.php?mod=space&amp;uid=<?php echo $next['authorid'];?>">
                                        <?php echo avatar($next['authorid'], small); ?>                                    </a>
                                    </div>
                                    <div class="comment-word">
                                        <div class="plname clear_b">
                                        	<span><?php echo $next['author'];?></span>
                                            <em><?php echo dgmdate($next['dateline'],'Y-m-d'); ?></em>
                                        </div>
                                        <div class="attrValues">
                                            <div class="rating-level big-rating">
                                                <span class="score-value score-value-<?php echo $next['starnum']*2; ?>">
                                                    <em></em>
                                                </span>
                                                <span>(<?php if($next['starnum']==1) { ?>很差<?php } elseif($next['starnum']==2) { ?>较差<?php } elseif($next['starnum']==3) { ?>还行<?php } elseif($next['starnum']==4) { ?>推荐<?php } elseif($next['starnum']==5) { ?>力荐<?php } ?>)</span>
                                            </div>
                                        </div>
                                        <div class="attrValues pt15">
                                            <p><?php echo $next['message'];?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=commentdetail&amp;tid=<?php echo $next['tid'];?>&amp;pid=<?php echo $next['pid'];?>&amp;uid=<?php echo $next['uid'];?>" target="_blank" class="morelink">显示全文</a></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <!--单条循环结束-->
                    </div>
                </div>
            </div>
        </div>
        <!--左侧结束-->
        <!--右边侧开始-->
        <div class="col-sider">
        	<div class="morecommenttitle clear_b">点评对象</div>
                <div class="porductimg">
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $detail['tid'];?>" target="_blank" class="morelink">
                <img src="<?php echo getimagethumb(200,200,2, $detail['dir'].'/'.$detail['showimg'], '', $detail['serverid']); ?>" style="width: 200px;height: 200px;">
                </a>
                </div>
            <div class="porductname">
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $detail['tid'];?>" target="_blank" class="morelink">
                <?php echo $commentlist['subject'];?>
                </a>
            </div>
            <div class="stardpbox clear_b">
            	<div class="rating-level small-rating req-rating">
                    <span class="score-value score-value-<?php echo floor($detail['score']); ?>">
                    	<em></em>
                    </span>
                    <strong><?php echo $detail['score'];?></strong>
                    <i class="dpnum"><?php echo $detail['cnum'];?>人点评</i>
                </div>
            </div>
            <div class="taglist clear_b">
            	<a href="http://www.8264.com/xuechang" target="_blank">滑雪场</a>
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;pro=<?php echo $detail['provinceid'];?>&amp;page=1" target="_blank">
                    <?php echo $region[$detail['provinceid']]['name'];?>
                </a>
                
            </div>
            <div class="morecommenttitle clear_b">关于作者</div>
            <div class="authorlist">
            	<div class="authorone clear_b">
                	<a href="home.php?mod=space&amp;uid=<?php echo $commentlist['authorid'];?>&amp;do=dianping" target="_blank">
                <?php echo avatar($commentlist['authorid'], small); ?>                    <p>
                    	<span><?php echo $commentlist['author'];?></span>
                        <em><?php echo $allcount;?>条点评 ></em>
                    </p>
                    </a>
                </div>
            </div>
        </div>
        <!--右侧结束-->
    </div>
</div><?php if($act=='showview') { ?>
<script src="http://static.8264.com/static/js/dianping/showview.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script>
<?php if($_G['adminid']==1) { ?><script src="http://static.8264.com/static/js/dianping/manage.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script><?php } } ?><style>
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
<?php if($act=='showview') { ?>
<li><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $tid;?>" id="m_k_favorite" onclick="showWindow(<?php if($_G['uid']) { ?>this.id, this.href, 'get', 0<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>);" class="sc"><b style="display: none;" id="favoritenumber"></b></a></li>
<?php } ?>
<li><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist" class="bbsli" title="返回<?php echo $dp_modules[$mod]['cname'];?>首页"></a></li>
<li id="gotop_50"><a  href="javascript:;" class="gotop_50"></a></li>
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
if($(window).scrollTop() > 10){$("#gotop_50").show();}	
$(window).scroll( function(){
if($(window).scrollTop()>10){
$("#gotop_50").show();
}else{
$("#gotop_50").hide();	
}
});
$("#gotop_50").click(function(){ 
$("html,body").animate({ scrollTop: 0 },500);
});		
})(jQuery);
</script>
<script type="text/javascript"> 
document.body.onselectstart=function(){ return false;}
</script><style type="text/css">
    .side-float{
        position: fixed;
        width: 161px;
        height: 149px;
        bottom: 260px;
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

//先注释掉
//    if(!getcookie("qr-dialog")) {
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
</script><?php dp_output(); ?></div>
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