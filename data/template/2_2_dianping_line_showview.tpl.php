<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('line_showview', 'dianping/header');
0
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/dianping/header.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/dianping/nav.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/common/zhidemai.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/dianping/showview_content.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/dianping/showview_credit.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/dianping/line_mycomment.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/dianping/line_comment.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/dianping/replyedit_pic_upload.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/dianping/reply_pic_upload.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/common/hd_ad.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/dianping/footer.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/common/header_8264_new.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/common/ewm_r.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/common/weixin_share.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/common/footer_8264_new.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/common/header_common.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
|| checktplrefresh('./template/8264/dianping/line_showview.htm', './template/8264/common/index_ad_top.htm', 1509517999, '2', './data/template/2_2_dianping_line_showview.tpl.php', './template/8264', 'dianping/line_showview')
;
block_get('6905,7009');?>
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
<strong><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>" title="<?php echo $detail['subject'];?>" class="last"><?php echo $detail['subject'];?></a></strong>
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
<ul class="global-nav"><?php if(is_array($dp_modules)) foreach($dp_modules as $v) { ?>                        <?php if($v['enable']==1 && $v['mname']!="shop" && $v['mname']!="fishing" && $v['mname']!="diving" && $v['mname']!="climb") { ?>
                        <li class="global-nav-item<?php if($v['mname']==$mod) { ?> global-nav-item-current<?php } ?>">
                                <a href="http://www.8264.com/dianping.php?mod=<?php echo $v['mname'];?>&amp;act=showlist" title="<?php echo $v['cname'];?>"><?php echo $v['cname'];?></a>
                        </li>
                        <?php } } ?>
</ul>
<div class="hill-icon"></div>
</div>
</div>

<!--滑雪通条广告开始-->

<?php if(($_G['fid'] != 490)) { ?>
<style>
.global-common-content{ margin:0px 0px 30px;}
</style>
<?php } ?>
<div class="global-common-content">
<div class="module">
<!-- 值得买 --><?php include(DISCUZ_ROOT.'./source/plugin/skiing/hd_zw.php'); ?><?php $zhidemai_list = ForumOptionHuoDong::pianyi_sidebar(6, 'top', 'jiu', '10027'); if($zhidemai_list) { ?>
<div class="ui-grid-12 ui-grid-full" style="margin-top:20px;">
<style>
    .zhidemaiwidth{ width:980px;}
    .zhidemaibox .zhidemailist_new li{width:144px; overflow:hidden;}
    .zhidemaibox .zhidemailist_new li img{ width:144px;}
</style><style>
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
    <div style="margin-top:20px;display: none;">
        <?php $bottom_ads = array('416', '409', '417'); $bottom_ad = rand(0, 2); $bottom_ad_id = $bottom_ads[$bottom_ad]; ?>        <?php echo adshow("custom_$bottom_ad_id"); ?>    </div>
    <div style=" width:980px; margin:10px auto 10px auto;"><?php echo adshow("custom_432"); ?></div>


<div class="col-main">
<div class="main-wrap">
<div class="ui-grid-6 ui-grid-left">
    <!--detail-->
    <div class="review-left-top">
        <div class="ui-block ui-block-title">
            <div class="ui-title">
                <h1><?php echo $detail['subject'];?> <span id="info_status" <?php if($detail['ispublish']==1) { ?>style="display:none;"<?php } ?>>(未审核)</span></h1>
                <?php if($_G['adminid']==1) { ?>
                <?php include template('dianping/cplist_thread'); ?>                <?php } ?>
            </div>
        </div>
    </div>
    <!-- //detail -->
</div>
<div class="ui-grid-6 ui-grid-left">
    <!-- content --><?php $detail['subject'] = '线路' ?>    <div class="review-intro">
<div class="ui-block ui-block-title">
<div class="ui-title ui-title-line" style="zoom:1;">
<h3><?php echo $detail['subject'];?><?php if($mod=='brand') { ?>品牌<?php } ?>简介</h3>
                        <?php if($detail['ispublish']!=0) { ?>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>#write" class="ui-title-link"><i class="ui-icon ui-review-icon"></i>我要点评</a>
                        <?php } ?>
<!--我要点评下拉开始-->
<div class="wydp_warpten">
<div class="wydp_arrow"></div>
<div class="wydp_bluebg">写点评兑换礼品</div>
<div class="wydp_info">
<ul>
<li><span class="num_blue">1</span><span class="wydp_info_con">请写下自己的真实感受，严禁抄袭</span></li>
<li>
<span class="num_blue">2</span>
<span class="wydp_info_con">点评被奖励8264币后，请到论坛兑换礼品</span>
</li>
</ul>
</div>
<a class="dh_bule" target="_blank" href="http://bbs.8264.com/forum-483-1.html">去兑换</a>
</div>
<!--我要点评下拉结束-->
<div style=" font-size:0px; clear:both; height:0px; line-height:0px;"></div>
</div>
</div>
<div class="ui-block ui-block-content">
<div class="intro-main">
<?php echo $plug_content_top;?>
<p>
<?php echo $detail['message'];?>
</p>
<div class="J-more view-more" style="display:none;"><a href="javascript:void(0)">查看更多</a></div>
</div>
</div>
</div>
    <?php if($gps_map) { ?>
    <div class="tab_rel" style="padding:0;">
        <div class="map">
            <iframe id="mapiframe" style='height:450px;width:100%;border:none;overflow: hidden;' src='<?php echo $gps_map;?>'></iframe>
        </div>
    </div>
    <?php } ?>
    <!-- //content -->
</div>

<!-- AD -->
<div style="margin:35px 0px;"><?php echo adshow("custom_342"); ?></div>
<div>
    <div>
        <div><!--滑雪场广告开始-->
            <style type="text/css">
                .clear_b:after{content:"";display:block;clear:both;visibility:hidden}
                .clear_b{zoom:1}
                .adhxwarpten{width:660px;margin-top:25px}
                .adhxwarpten a{text-decoration:none}
                .adhx{padding-bottom:10px}
                .adhx span{float:left;font-size:16px;color:#000;margin:2px 0 0}
                .adhx a{ float:right; color:#43a6df; font-size:12px;  padding-top:5px}
                .line-search{background-color:#6192f6;border-radius:3px;padding:10px 10px 18px}
                .search-combobox{position:relative;background-color:#fff;border-radius:3px;padding:10px;height:24px}
                .search-combobox .searchtext{width:100%;height:24px;line-height:24px;color:#949494;font-size:16px;border:0 none;border-radius:3px}
                .search-combobox .searchbutton{width:24px;height:24px;background:url(http://static.8264.com/dianping/images/icon/data/searchicon.png) center center no-repeat;border:0 none;position:absolute;top:10px;right:10px;outline:0 none}
                .tuij-list{margin-top:8px}
                .tuij-list a{margin-right:8px;color:#fff;font-size:12px}
                .tuij-list a:hover{text-decoration:underline;}
            </style>
            <div class="adhxwarpten">
                <div class="adhx clear_b">
                    <span>你想去的线路</span>
                </div>
                <div class="line-search">
                    <div class="search-combobox">
<form onsubmit="return false;">
                        <input type="text" id="searchhd" name="searchhd" class="searchtext" placeholder="请输入目的地、玩法" value="" >
                        <input type="submit" value="" class="searchbutton" onclick="javascript:window.open('http://hd.8264.com/search?title='+ jQuery('#searchhd').val()+'&bd_source=dianping&bd_position=1-1');">
</form>
                    </div>
                    <div class="tuij-list">
                        <a  href="javascript:void(0);" onclick="javascript:window.open('http://hd.8264.com/search?title=徒步&bd_source=dianping&bd_position=1-1');">徒步</a>
                        <a  href="javascript:void(0);" onclick="javascript:window.open('http://hd.8264.com/search?title=牛背山&bd_source=dianping&bd_position=1-1');">牛背山</a>
                        <a  href="javascript:void(0);" onclick="javascript:window.open('http://hd.8264.com/search?title=贡嘎&bd_source=dianping&bd_position=1-1');">贡嘎</a>
                        <a  href="javascript:void(0);" onclick="javascript:window.open('http://hd.8264.com/search?title=尼泊尔&bd_source=dianping&bd_position=1-1');">尼泊尔</a>
                        <a  href="javascript:void(0);" onclick="javascript:window.open('http://hd.8264.com/search?title=香格里拉&bd_source=dianping&bd_position=1-1');">香格里拉</a>
                        <a  href="javascript:void(0);" onclick="javascript:window.open('http://hd.8264.com/search?title=梅里雪山&bd_source=dianping&bd_position=1-1');">梅里雪山</a>
</div>
                </div>
            </div>
            <!--滑雪场广告结束-->
        </div>
    </div>


</div>
<!-- //AD -->
<!--去掉8264币-->
<div class="ui-grid-6 ui-grid-left">
    <!-- 点评赚8264币 -->
    <div class="review-adv-box" style="display: none;">
<div class="ui-block ui-block-content">
<div class="review-adv-bd" style="padding:10px 22px;">
<div class="review-adv-info">
<p style="padding:15px 0 12px 0px">参与点评得8264币，精美奖品等你来兑换</p>
<div class="adv-info-link">
<a class="btn-write" href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>#write">去写点评</a>
<a target="_blank" href="http://bbs.8264.com/forum-483-1.html">奖品列表</a>
<a target="_blank" href="http://bbs.8264.com/thread-1641700-1-1.html">详细规则</a>
</div>
</div>
<div style="float:right">
<img src="http://static.8264.com/static/css/dianping/images/dpad.png" alt="">
</div>
</div>
</div>
</div>
<!-- 户外学校广告 -->
<style>
.hotmudidibox{border:#e0e7eb solid 1px; border-bottom:0px; border-right:0px; margin-top:15px; width:655px;}
.hotmudidibox li{ width:130px; border-bottom:#e0e7eb solid 1px; border-right:#e0e7eb solid 1px; height:70px; float:left;}
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
</ul>
</div>
<!-- //户外学校广告 -->
    <!-- //点评赚8264币 -->
</div>
<div class="ui-grid-6 ui-grid-left">
    <!-- comment list -->
    <!-- 我的点评 -->
    <div id="mycomment">
        <?php if($mycomment) { ?>
        	<div class="review-comment-box">
<div class="ui-block ui-block-title">
<div class="ui-title ui-title-line">
<h3>我的点评</h3><span>假如您的点评没有奖励8264币，请联系工作人员QQ1919501975询问原因</span>
</div>
</div>
<div class="ui-block ui-block-content">
<div class="comment-main">
<div id="post_<?php echo $mycomment['pid'];?>" class="comment-list-box">
<div class="avatar-box">
<a href="home.php?mod=space&amp;uid=<?php echo $mycomment['authorid'];?>" class="user-avatar" target="_blank" rel="nofollow"><?php echo avatar($mycomment['authorid'], small); ?><span class="user-name"><?php echo $mycomment['author'];?></span>
</a>
</div>
<div class="comment-word">
<?php if($mycomment['starnum']) { ?>
                        <div class="rows-content row-color-1">
                            <div class="commAttr">
                                <i class="attrs-icon comm"></i>推荐
                            </div>
                            <div class="attrValues">
                                <div class="rating-level big-rating clist-rating">
                                    <span class="score-value score-value-<?php echo $mycomment['starnum']*2; ?>">
                                        <em></em>
                                    </span>
                                    <span>(<?php if($mycomment['starnum']==1) { ?>千万别去<?php } elseif($mycomment['starnum']==2) { ?>最好别去<?php } elseif($mycomment['starnum']==3) { ?>一般推荐<?php } elseif($mycomment['starnum']==4) { ?>重点推荐<?php } elseif($mycomment['starnum']==5) { ?>吐血推荐<?php } ?>)</span>
                                </div>
                            </div>
                        </div>
<?php } ?>

                        <div class="rows-content row-color-2">
                            <div class="commAttr">
                                <i class="attrs-icon date"></i>时间
                            </div>
                            <div class="attrValues">
                                <?php if(floor(($mycomment['ext2']-$mycomment['ext1'])/86400)==0) { ?>
                                <p><?php echo dgmdate($mycomment['ext1'], 'Y-m-d '); ?><?php echo $mycomment['ext4'];?>时 - <?php echo $mycomment['ext5'];?>时  共计<?php echo $mycomment['ext5']-$mycomment['ext4'];?>小时</p>
                                <?php } else { ?>
                                <p><?php echo dgmdate($mycomment['ext1'], 'Y-m-d '); ?> 至 <?php echo dgmdate($mycomment['ext2'], 'Y-m-d'); ?> 共<?php echo floor(($mycomment['ext2']-$mycomment['ext1'])/86400); ?>天</p>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="rows-content row-color-3">
                            <div class="commAttr">
                                <i class="attrs-icon price"></i>费用
                            </div>
                            <div class="attrValues">
                                <p><?php echo $mycomment['ext3'];?></p>
                            </div>
                        </div>
                        <div class="rows-content row-color-4">
                            <div class="commAttr">
                                <i class="attrs-icon note"></i>注意
                            </div>
                            <div class="attrValues">
                                <p><?php echo $mycomment['weakpoint'];?></p>
                            </div>
                        </div>
                        <div class="rows-content row-color-5">
                            <div class="commAttr">
                                <i class="attrs-icon complex"></i>综合
                            </div>
                            <div class="attrValues">
                                <p><?php echo $mycomment['message'];?></p>
                            </div>
                        </div>
                        <?php if($mycomment['attachlist']) { ?>
                        <div class="rows-content row-color-6">
                            <div class="commAttr">
                                <i class="attrs-icon picture"></i>图片
                            </div>
                            <div class="attrValues">
                                <ul class="attrPic-list">
                                    <?php if(is_array($mycomment['attachlist'])) foreach($mycomment['attachlist'] as $item) { ?>                                    <li>
                                        <a href="http://<?php if($item['serverid']==1) { ?>image<?php } elseif($item['serverid']==99) { ?>image1<?php } ?>.8264.com/<?php echo $item['dir'];?>/<?php echo $item['attachment'];?>" target="_blank" title="点击查看大图"><img src="<?php echo getimagethumb(80,80,2, $item['dir'].'/'.$item['attachment'], '', $item['serverid']); ?>" alt="<?php echo $mycomment['subject'];?>"></a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
<div class="rows-content row-color-6">
<div class="attrValues rows-detail">
<span class="rows-time"><?php echo dgmdate($mycomment['dateline']); ?></span>
<span class="rows-title"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $mycomment['tid'];?>" target="_blank"><?php echo $mycomment['subject'];?></a></span>
<div class="rows-praise">
<a href="javascript:void(0);" id="support_<?php echo $mycomment['pid'];?>" onclick="support(<?php echo $mycomment['pid'];?>);"><i class="rows-icon<?php if($mycomment['supports']) { ?> icon-praise<?php } ?>"></i>有用<em><?php if($mycomment['supports']) { ?>(<?php echo $mycomment['supports'];?>)<?php } ?></em></a>
</div>
</div>
</div>
                        <?php if($act=='showview' && $_G['uid']) { include template('dianping/cplist_comment'); } ?>
                    </div>
                         <?php if($mycomment['rate']) { ?><span class="b8264icon"></span><?php } ?>
</div>

</div>
</div>
</div>
<?php if($_GET['inajax'] == 1) { ?><?php dp_output(); } ?>
        <?php } ?>
    </div>
    <!-- //我的点评 -->
    <?php if(!$commentlist) { ?>
    <div style="margin:16px 0px 30px 0px; display:none;"><img src="http://static.8264.com/dianping/images/demo/tbyb.jpg"></div>
    <?php } ?>
    <?php if($commentlist) { ?>
    <div class="review-comment-box"><a id="comment"></a>
        <div class="ui-block ui-block-title">
            <div class="ui-title ui-title-line">
                <h3><?php echo $detail['subject'];?>的点评</h3>
            </div>
            <div class="ui-title ui-title-line star-s">
            	<input type="hidden" value='' class="snum">
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>" id='0'>全部(<?php echo $recordnum;?>)</a>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>" id='5'>5星</a>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>"  id='4'>4星</a>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>"  id='3'>3星</a>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>"  id='2'>2星</a>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>"  id='1'>1星</a>
</div>
        </div>
        <div style="margin:16px 0px 30px 0px; display:none;"><img src="http://static.8264.com/dianping/images/demo/tbyb.jpg"></div>
        <div class="ui-block ui-block-content">
            <div class="comment-main">
                <div id="commentlist">
                    <?php if(is_array($commentlist)) foreach($commentlist as $comment) { ?><div id="post_<?php echo $comment['pid'];?>" class="comment-list-box">
    <div class="avatar-box">
        <a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="user-avatar" target="_blank" rel="nofollow">
            <?php echo avatar($comment['authorid'], small); ?>            <span class="user-name"><?php echo $comment['author'];?></span>
        </a>
    </div>
    <div class="comment-word">
        <div class="rows-content row-color-1">
            <div class="commAttr">
                <i class="attrs-icon comm"></i>推荐
            </div>
            <div class="attrValues">
                <div class="rating-level big-rating clist-rating">
<span class="score-value score-value-<?php echo $comment['starnum']*2; ?>">
<em></em>
</span>
                    <span>(<?php if($comment['starnum']==1) { ?>千万别去<?php } elseif($comment['starnum']==2) { ?>最好别去<?php } elseif($comment['starnum']==3) { ?>一般推荐<?php } elseif($comment['starnum']==4) { ?>重点推荐<?php } elseif($comment['starnum']==5) { ?>吐血推荐<?php } ?>)</span>
                </div>
            </div>
        </div>
        <div class="rows-content row-color-2">
            <div class="commAttr">
                <i class="attrs-icon date"></i>时间
            </div>
            <div class="attrValues">
                <?php if(floor(($comment['ext2']-$comment['ext1'])/86400)==0) { ?>
                <p><?php echo dgmdate($comment['ext1'], 'Y-m-d '); ?><?php echo $comment['ext4'];?>时 - <?php echo $comment['ext5'];?>时  共计<?php echo $comment['ext5']-$comment['ext4'];?>小时</p>
                <?php } else { ?>
                <p><?php echo dgmdate($comment['ext1'], 'Y-m-d '); ?> 至 <?php echo dgmdate($comment['ext2'], 'Y-m-d'); ?> 共<?php echo floor(($comment['ext2']-$comment['ext1'])/86400); ?>天</p>
                <?php } ?>

            </div>
        </div>
        <div class="rows-content row-color-3">
            <div class="commAttr">
                <i class="attrs-icon price"></i>费用
            </div>
            <div class="attrValues">
                <p><?php echo $comment['ext3'];?></p>
            </div>
        </div>
        <div class="rows-content row-color-4">
            <div class="commAttr">
                <i class="attrs-icon note"></i>注意
            </div>
            <div class="attrValues">
                <p><?php echo $comment['weakpoint'];?></p>
            </div>
        </div>
        <div class="rows-content row-color-5">
            <div class="commAttr">
                <i class="attrs-icon complex"></i>综合
            </div>
            <div class="attrValues">
                <p><?php echo $comment['message'];?></p>
            </div>
        </div>
        <?php if($comment['attachlist']) { ?>
        <div class="rows-content row-color-6">
            <div class="commAttr">
                <i class="attrs-icon picture"></i>图片
            </div>
            <div class="attrValues">
                <ul class="attrPic-list">
                    <?php if(is_array($comment['attachlist'])) foreach($comment['attachlist'] as $item) { ?>                    <li>
                        <a href="http://<?php if($item['serverid']==1) { ?>image<?php } elseif($item['serverid']==99) { ?>image1<?php } ?>.8264.com/<?php echo $item['dir'];?>/<?php echo $item['attachment'];?>" target="_blank" title="点击查看大图"><img src="<?php echo getimagethumb(80,80,2, $item['dir'].'/'.$item['attachment'], '', $item['serverid']); ?>" alt="<?php echo $mycomment['subject'];?>"></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>
        <div class="rows-content row-color-6">
            <div class="attrValues rows-detail">
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=commentdetail&amp;tid=<?php echo $comment['tid'];?>&amp;pid=<?php echo $comment['pid'];?>&amp;uid=<?php echo $comment['uid'];?>" target="_blank"><span class="rows-time"><?php echo dgmdate($comment['dateline']); ?></span></a>
                <span class="rows-title"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $comment['tid'];?>" target="_blank"><?php echo $comment['subject'];?></a></span>
                <div class="rows-praise">
                    <a href="javascript:void(0);" id="support_<?php echo $comment['pid'];?>" onclick="support(<?php echo $comment['pid'];?>);"><i class="rows-icon<?php if($comment['supports']) { ?> icon-praise<?php } ?>"></i>有用<em><?php if($comment['supports']) { ?>(<?php echo $comment['supports'];?>)<?php } ?></em></a>
                </div>
            </div>
        </div>
        <?php if($act=='showview' && $_G['adminid'] == 1) { include template('dianping/cplist_comment'); } ?>
    </div>
    <?php if($comment['rate']) { ?><span class="b8264icon"></span><?php } ?>
</div>
<?php } if($act=='showview' && $multipage) { ?>
<!-- page -->
<div class="page-box-warpten"><?php echo $multipage;?></div>
<!-- //page -->
<?php } if($_GET['ajaxreply'] == 1) { ?><?php dp_output(); } if($act=='showview' && $_G['adminid'] == 1) { ?>
<form method="post" autocomplete="off" name="modactions" id="modactions">
    <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
    <input type="hidden" name="optgroup" />
    <input type="hidden" name="operation" />
    <input type="hidden" name="listextra" value="<?php echo $_G['gp_extra'];?>" />
</form>
<style>#mdly { margin: 20px 0 0 10px; padding: 0; width: 200px; height: auto; background: none; }</style>
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
                        <?php if($_G['adminid'] == 1) { ?>
                        <?php if($_G['group']['allowdelpost']) { ?><a href="javascript:;" onclick="modaction('delpost', '', '', 'forum.php?ctl=<?php echo $mod;?>&act=moderator')">删除</a><span class="pipe">|</span><?php } ?>
                        <?php if($_G['group']['allowstickreply']) { ?><a href="javascript:;" onclick="modaction('stickreply', '', '', 'forum.php?ctl=<?php echo $mod;?>&act=moderator')">置顶</a><?php } ?>
                        <?php } ?>
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
<?php } ?>                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- //comment list -->
</div>

<div class="pl-popup-wrap mod-edit-popup" id="edithtml" style="display:none;">
    <!-- comment public -->
    <div class="write-comment-box">
        <div class="ui-block ui-block-title">
            <div class="ui-title ui-title-line">
                <h3>修改点评</h3>
                <a href="javascript:void(0);" class="close-popup">关闭</a>
            </div>
        </div>
        <form method="post"  id="editform" action="" autocomplete="off">
            <input type="hidden" id="pid" name="pid" value="" size="2" />
            <input type="hidden" id="uid" name="uid" value="" size="2" />
            <div class="ui-block ui-block-content">
                <div class="comment-form-box">
                    <div class="rows-content row-color-1">
                        <div class="commAttr">
                            <i class="attrs-icon comm"></i>推荐
                        </div>
                        <div class="attrForms">
                            <div class="star-rating-box">
                                <ul class="star-rating-level stars1">
                                    <li><a class="one-star" id="star_1_e" value='1' href="javascript:void(0);" title="千万别去">100</a></li>
                                    <li><a class="two-stars" id="star_2_e" value='2' href="javascript:void(0);" title="最好别去">200</a></li>
                                    <li><a class="three-stars" id="star_3_e" value='3'  href="javascript:void(0);" title="一般推荐">300</a></li>
                                    <li><a class="four-stars" id="star_4_e" value='4' href="javascript:void(0);" title="重点推荐">400</a></li>
                                    <li><a class="five-stars" id="star_5_e" value='5' href="javascript:void(0);" title="吐血推荐">500</a></li>
                                </ul>
                                <span class="result stars1-tips"  style=""></span>
                                <input type="hidden" id="starnum_e" class="starnum" name="starnum" value="" size="2" />
                            </div>
                        </div>
                    </div>
                    <div class="rows-content row-color-2">
                        <div class="commAttr">
                            <i class="attrs-icon date"></i>时间
                        </div>
                        <div class="cont ">
                            <input name="datapicker[]" readonly class="timeText datapicker startPicker"  onclick="showcalendar(event, this, '', '', '', 28);" /> ---
                            <input name="datapicker[]" readonly class="timeText datapicker endPicker"  onclick="showcalendar(event, this, '', '', '', 28);"/>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="datapicker[]" class="timeText timeHour dataHour" maxlength="2"/>
                            <span class="timeHour">时 --- </span>
                            <input name="datapicker[]" class="timeText timeHour dataHour" maxlength="2"/>
                            <span class="timeHour">时</span>
                            <div id="date_error_e" style="padding-top:7px;"></div>
                        </div>
                    </div>
                    <div class="rows-content row-color-3">
                        <div class="commAttr">
                            <i class="attrs-icon price"></i>费用
                        </div>
                        <div class="attrForms">
                            <div class="issue-forms-group">
                                <textarea name="ext3" id="ext3_e" cols="30" rows="2" placeholder="列举自己出行的各项话费，车费、住宿费、门票、参加商业活动费用等"></textarea>
                                <div id="ext3_eTip" class="valid-tips-container"></div>
                                <div id="ext3_e_e" style="padding-top:7px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="rows-content row-color-4">
                        <div class="commAttr">
                            <i class="attrs-icon note"></i>注意
                        </div>
                        <div class="attrForms">
                            <div class="issue-forms-group">
                                <textarea name="weakpoint" id="weakpoint_e" cols="30" rows="2" placeholder="提醒他人需要注意的关键事项，如露营点、水源点、岔路口等"></textarea>
                                <div id="weakpoint_eTip" class="valid-tips-container"></div>
                                <div id="weakpoint_e_e" style="padding-top:7px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="rows-content row-color-5">
                        <div class="commAttr">
                            <i class="attrs-icon complex"></i>综合
                        </div>
                        <div class="attrForms">
                            <div class="issue-forms-group">
                                <textarea name="message" id="message_e" cols="30" rows="6" placeholder="从线路风景、难度、强度、所需装备等方面对线路进行描述，文字200字以上"></textarea>
                                <div id="message_eTip" class="valid-tips-container"></div>
                                <div id="message_e_e" style="padding-top:7px;"></div>
                            </div>
                        </div>
                    </div>
                    <!--start----编辑页添加图片上传表单-->
                    <div class="rows-content row-color-6">
    <div class="commAttr">
        <i class="attrs-icon picture"></i>图片
    </div>
    <dl class="pubDt50">
        <dt><span class="icoUpPic48x43"></span></dt>
        <dd>
            <input id="numimage_e" type="hidden" name="uploadfile" value="0"/>
            <div id="check_pic_upload_e">
                <div id="pic_upload_multiimg_e">
                    此内容需要 Adobe Flash Player 10.0.0 或更高版本
                    <script type="text/javascript">
                        var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
                        document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"
                        + pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
                    </script>
                </div>
            </div>
            <input type="button" name="button2" id="limit_pic_upload_e" value="" class="flup" style="display:none;">
            <span class="upload-arrow">最多上传3张</span>
            <span id="imagelisttemp_e" style="display: none;" class="attachpic">
                <b class="deleteimg" >删除</b>
                <input type="hidden" name="imgselect[]" value="" disabled="true"/>
            </span>
            <div class="clearfix"></div>
            <div id="imglist_e" class="readyPic">

            </div>
        </dd>
    </dl>
</div>                    <!--end----编辑页图片上传表单-->
                    <div class="rows-content row-color-6">
                        <div class="attrForms">
                            <div class="issue-submit-group">
                                <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
                                <input type="hidden" name="replypostsubmit" value="yes">
                                <input type="hidden" name="subject" value="" />
                                <input type="submit" name="submit" value="发布" class="btn-issue" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- //comment public -->
</div>
<?php if(!$mycomment) { ?>
<div class="ui-grid-6 ui-grid-left">
    <!-- comment public --><a id="write"></a>
    <div class="write-comment-box">
        <div class="ui-block ui-block-title">
            <div class="ui-title ui-title-line">
                <h3>写点评</h3>
            </div>
        </div>
        <form method="post"  id="postform" action="" autocomplete="off">
        <div class="ui-block ui-block-content">
            <div class="comment-form-box">
                <div class="rows-content row-color-1">
                    <div class="commAttr">
                        <i class="attrs-icon comm"></i>推荐
                    </div>
                    <div class="attrForms">
                        <div class="star-rating-box">
                            <ul class="star-rating-level stars1">
                                <li><a class="one-star" id="star_1" value='1' href="javascript:void(0);">100</a></li>
                                <li><a class="two-stars" id="star_2" value='2' href="javascript:void(0);">200</a></li>
                                <li><a class="three-stars" id="star_3" value='3'  href="javascript:void(0);">300</a></li>
                                <li><a class="four-stars" id="star_4" value='4' href="javascript:void(0);">400</a></li>
                                <li><a class="five-stars" id="star_5" value='5' href="javascript:void(0);">500</a></li>
                            </ul>
                            <span class="result stars1-tips"  style=""></span>
                            <div class="clearfix"></div>
                            <input type="hidden" id="starnum" class="starnum" name="starnum" value="" size="2" />
                            <div id="starnumTip" class="valid-tips-container" style="display: none;">
                                <div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请点击星星图标进行点评</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rows-content row-color-2">
                    <div class="commAttr">
                        <i class="attrs-icon date"></i>时间
                    </div>
                    <!--<div class="attrForms">
                        <div class="issue-forms-group">
                            <div class="date-input-wrapper">
                                <input id="ext1" name ="ext1" type="text" placeholder="开始时间"  onclick="showcalendar(event, this, '', '', '', 28);"/>
                                <label for="ext1" class="date-icon"></label>
                            </div>
                            <span class="sn-separator">---</span>
                            <div class="date-input-wrapper">
                                <input id="ext2" name="ext2" type="text" placeholder="结束时间"  onclick="showcalendar(event, this, '', '', '', 28);"/>
                                <label for="ext2" class="date-icon"></label>
                            </div>
                            <div class="time-input-wrapper">
                                <input type="text" placeholder="" name="ext4" id="ext4">
                            </div>
                            <span class="sn-separator">---</span>
                            <div class="time-input-wrapper">
                                <input type="text" placeholder="" name="ext5" id="ext5">
                            </div>
                        </div>
                    </div>-->
                    <div class="cont post">
                        <input name="datapicker[]" readonly class="timeText datapicker startPicker" onclick="showcalendar(event, this, '', '', '', 28);" onchange="changeDate()"/> ---
                        <input name="datapicker[]" readonly class="timeText datapicker endPicker" onclick="showcalendar(event, this, '', '', '', 28);"/>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="datapicker[]" class="timeText timeHour dataHour startHour" maxlength="2"/>
                        <span class="timeHour">时 --- </span>
                        <input name="datapicker[]" class="timeText timeHour dataHour endHour" maxlength="2"/>
                        <span class="timeHour">时</span>
                        <div id="date_error" style="padding-top:7px;"></div>
                    </div>

                </div>
                <div class="rows-content row-color-3">
                    <div class="commAttr">
                        <i class="attrs-icon price"></i>费用
                    </div>
                    <div class="attrForms">
                        <div class="issue-forms-group">
                            <textarea name="ext3" id="ext3" cols="30" rows="2" placeholder="列举自己出行的各项话费，车费、住宿费、门票、参加商业活动费用等"></textarea>
                            <div id="ext3Tip" class="valid-tips-container"></div>
                        </div>
                    </div>
                </div>
                <div class="rows-content row-color-4">
                    <div class="commAttr">
                        <i class="attrs-icon note"></i>注意
                    </div>
                    <div class="attrForms">
                        <div class="issue-forms-group">
                            <textarea name="weakpoint" id="weakpoint" cols="30" rows="2" placeholder="提醒他人需要注意的关键事项，如露营点、水源点、岔路口等"></textarea>
                            <div id="weakpointTip" class="valid-tips-container"></div>
                        </div>
                    </div>
                </div>
                <div class="rows-content row-color-5">
                    <div class="commAttr">
                        <i class="attrs-icon complex"></i>综合
                    </div>
                    <div class="attrForms">
                        <div class="issue-forms-group">
                            <textarea name="message" id="message" cols="30" rows="6" placeholder="从线路风景、难度、强度、所需装备等方面对线路进行描述，文字200字以上"></textarea>
                            <div id="messageTip" class="valid-tips-container"></div>
                        </div>
                    </div>
                </div>
                <!--start----发布页图片上传-->
                <?php if($_G['uid']) { ?>
<div class="rows-content row-color-6">
    <div class="commAttr">
        <i class="attrs-icon picture"></i>图片
    </div>
    <dl class="pubDt50">
        <dt><span class="icoUpPic48x43"></span></dt>
        <dd>
            <input id="numimage" type="hidden" name="uploadfile" value="0"/>
            <div id="check_pic_upload">
                <div id="pic_upload_multiimg">
                    此内容需要 Adobe Flash Player 10.0.0 或更高版本
                    <script type="text/javascript">
                        var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
                        document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"
                        + pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
                    </script>
                </div>
            </div>
            <input type="button" name="button2" id="limit_pic_upload" value="" class="flup" style="display:none;">
            <span class="upload-arrow">非必填，最多上传3张</span>
            <span id="imagelisttemp" style="display: none;" class="attachpic">
                <b class="deleteimg" >删除</b>
                <input type="hidden" name="imgselect[]" value="" disabled="true"/>
        </span>
            <div class="clearfix"></div>
            <div id="imglist" class="readyPic">
            </div>
        </dd>
    </dl>
    
</div>
<?php } else { ?>
<div class="rows-content row-color-6">
    <div class="commAttr">
        <i class="attrs-icon picture"></i>图片
    </div>
    <dl>
        <a href="http://www.8264.com/member.php?mod=logging&amp;action=login" class="d-login-jump">登录后可上传图片</a>
    </dl>
</div>
<?php } ?>
                <!--end-----发布页图片上传-->
                <?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
<div class="rows-content row-color-6">
<div class="commAttr">
<i class="attrs-icon picture"></i>验证码
</div>
<div class="attrForms">
<div class="issue-forms-group">
<input type="text" name="captcha" id="captcha" class="inputTxtShort borderEmbellish" style="width:50px;vertical-align: top;"/>
<a href="#" id="refreshCaptcha" title="点击刷新图片"><img src="/plugin.php?id=dailypicture:captcha" alt="点击刷新图片" /></a>
<input type="hidden" value="" id="yzm" name="yzm">
<span id="jg"></span>
</div>
</div>
</div>
<?php } ?>
                <div class="rows-content row-color-6">
                    <div class="attrForms">
                        <div class="issue-submit-group">
                            <input type="submit" name="submit" value="发布" class="btn-issue" />
                            <!-- 手机绑定提示 -->
                            <?php if(!$_G['member']['telstatus']) { ?>
                            <style type="text/css">.tips-binding__inside{background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:4px 0 0 10px;font-size:14px;color:#585858}.tips-binding__inside a{color:#ff7038;font-size:14px}.tips-binding__inside a:hover{color:#ff7038;font-size:14px}</style>
                            <span class="tips-binding__inside">注：写点评操作需绑定手机，<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">去绑定>></a></span>
                            <?php } ?>
                            <!-- //手机绑定提示 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- //comment public -->
</div>
<?php } ?>
</div>
</div>
<!-- side bar -->
<div class="col-sider">
    <div class="ui-grid-2">
        <div class="line-raking-box">
            <div class="ui-block ui-block-title">
                <div class="ui-title ui-title-line">
                    <h3>线路评分</h3>
                </div>
            </div>
            <div class="ui-block ui-block-content">
                <div class="rating-level big-rating bv-rating">
<span class="score-value score-value-<?php echo floor($detail['score']); ?>">
<em></em>
</span>
                    <strong><?php echo $detail['score'];?></strong>
                </div>
                <div class="reviews-count">
                    (<span class="num"><?php if($detail['cnum']) { ?><?php echo $detail['cnum'];?><?php } else { ?>0<?php } ?></span>人评分)
                </div>
                <div class="rw-rechart-con">
                    <div title="吐血推荐" class="rm-rechart-line">
                        <div class="rating-level small-rating rm-rating">
<span class="score-value score-value-10">
<em></em>
</span>
                        </div>
                        <div class="rm-rechart-bar">
                            <div class="rm-rechart-full" style="width:<?php echo $detail['percent5'];?>%;"></div>
                        </div>
                        <div class="rm-rechart-val"><?php echo $detail['percent5'];?>% (吐血推荐)</div>
                    </div>
                    <div title="重点推荐" class="rm-rechart-line">
                        <div class="rating-level small-rating rm-rating">
<span class="score-value score-value-8">
<em></em>
</span>
                        </div>
                        <div class="rm-rechart-bar">
                            <div class="rm-rechart-full" style="width:<?php echo $detail['percent4'];?>%;"></div>
                        </div>
                        <div class="rm-rechart-val"><?php echo $detail['percent4'];?>% (重点推荐)</div>
                    </div>
                    <div title="一般推荐" class="rm-rechart-line">
                        <div class="rating-level small-rating rm-rating">
<span class="score-value score-value-6">
<em></em>
</span>
                        </div>
                        <div class="rm-rechart-bar">
                            <div class="rm-rechart-full" style="width:<?php echo $detail['percent3'];?>%;"></div>
                        </div>
                        <div class="rm-rechart-val"><?php echo $detail['percent3'];?>% (一般推荐)</div>
                    </div>
                    <div title="最好别去" class="rm-rechart-line">
                        <div class="rating-level small-rating rm-rating">
<span class="score-value score-value-4">
<em></em>
</span>
                        </div>
                        <div class="rm-rechart-bar">
                            <div class="rm-rechart-full" style="width:<?php echo $detail['percent2'];?>%;"></div>
                        </div>
                        <div class="rm-rechart-val"><?php echo $detail['percent2'];?>% (最好别去)</div>
                    </div>
                    <div title="千万别去" class="rm-rechart-line">
                        <div class="rating-level small-rating rm-rating">
<span class="score-value score-value-2">
<em></em>
</span>
                        </div>
                        <div class="rm-rechart-bar">
                            <div class="rm-rechart-full" style="width:<?php echo $detail['percent1'];?>%;"></div>
                        </div>
                        <div class="rm-rechart-val"><?php echo $detail['percent1'];?>% (千万别去)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 引入开始 热门线路开始-->
    <div class="ui-grid-2 ui-grid-right">
        <div class="right-hot-line-warpten">
            <div class="ui-block ui-block-title">
                <div class="ui-title ui-title-line">
                    <h3>热门线路</h3>
                    <div class="ui-title-link"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=heats&amp;type=0&amp;timetype=0&amp;provinceid=0&amp;cityid=0&amp;page=1" target="_brank">more</a></div>
                </div>
            </div>
            <div class="ui-block ui-block-content">
                <div class="right-hot-line-box">
                    <ul class="right-hot-line">
                        <?php if(is_array($sidebar_list_hot)) foreach($sidebar_list_hot as $item) { ?>                        <li>
                            <h3 class="wlist-bd-title"><a href="dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $item['tid'];?>"><?php echo cutstr($item['subject'],35,''); ?></a></h3>
                            <div class="star-small-warpten">
                                <div class="rating-level small-rating right-rating">
<span class="score-value score-value-<?php echo floor($item['score']); ?>">
<em></em>
</span>
                                    <strong><?php echo $item['score'];?></strong>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <!--<div class="add-more">加载更多</div>-->
                </div>
            </div>
        </div>
    </div>
    <!-- 引入结束 热门线路结束-->
    <div class="ui-grid-2 ui-grid-right">
        <div class="right-hot-line-warpten">
            <div class="ui-block ui-block-title">
                <div class="ui-title ui-title-line">
                    <h3>同地区线路</h3>
                </div>
            </div>
            <div class="ui-block ui-block-content">
                <div class="right-hot-line-box">
                    <ul class="right-hot-line">
                        <?php if(is_array($sidebar_list_same)) foreach($sidebar_list_same as $item) { ?>                        <li>
                            <h3 class="wlist-bd-title"><a href="dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $item['tid'];?>"><?php echo cutstr($item['subject'],35,''); ?></a></h3>
                            <div class="star-small-warpten">
                                <div class="rating-level small-rating right-rating">
<span class="score-value score-value-<?php echo floor($item['score']); ?>">
<em></em>
</span>
                                    <strong><?php echo $item['score'];?></strong>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <!--<div class="add-more">加载更多</div>-->
                </div>
            </div>
        </div>
    </div>
    <!-- 引入开始 -->
    <div class="ui-grid-2 ui-grid-right">
    </div>
    <!-- 引入结束 -->

    <!-- 引入开始 -->
    <div class="ui-grid-2 ui-grid-right">
    </div>
    <!-- 引入结束 -->

    <?php if($hddata) { ?>
    <!--采集信息开始 hd_ad-->
<!--采集信息结束-->
    <?php } ?>
</div>
<!-- //side bar -->
</div>
</div>
</div>

<style>
.bbsfoothotlist{ background: #1a2b38; color: #ffffff; padding-bottom:45px;}
.topHill{  background:url(http://static.8264.com/static/image/common/bg_fourm_sprite.png) no-repeat 0 0; height: 16px;left: 0; position: relative; text-indent: -9999px; top: -16px; width: 175px}
</style>

<div class="bbsfoothotlist">
<div class="module">
<div class="topHill">顶部小山</div>
</div>
<div class="choiceness">
        <?php block_display('6905'); ?></div>
</div>
<div class="friendLink"><?php block_display('7009'); ?></div>
<script>
    (function($){
        $(function(){

            //添加点评
            $('#postform').submit(function(event){

                event.preventDefault();
                var starnum = $("#postform .starnum").val();
                var ext3 = $.trim($("#postform #ext3").val());
                var ext1 = $("#postform input[name='datapicker[]']").eq(0).val();
                var ext2   = $("#postform input[name='datapicker[]']").eq(1).val();
                var ext4  = $("#postform input[name='datapicker[]']").eq(2).val();
                var ext5   = $("#postform input[name='datapicker[]']").eq(3).val();
                if(ext1){
                    ext1 = getNumberTime(ext1);
                }if(ext2){
                    ext2 = getNumberTime(ext2);
                }
                if(!ext1){
                    show_errors('date_error','开始日期不能为空！');
                    return false;
                }
                if(!ext2){
                    show_errors('date_error','结束日期不能为空！');
                    return false;
                }
    			if(ext1==ext2){

                	if(ext4=='' || ext5==''  ){
                		show_errors('date_error','时间不能为空！');
                        return false;
                	}

                }
                var weakpoint = $.trim($("#postform #weakpoint").val());
                var message = $.trim($("#postform #message").val());
                //form表单初始化验证后进行二次验证
                if(starnum == 0){
                    $("#starnumTip").show();
                }
                if(weakpoint.length<50 || message.length <200 || starnum == 0 || ext3.length <10){
                    return false;
                }
                <?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
if (trim($("#postform #captcha").val())=="") {
showDialog('验证码不能为空');
return false;
}
if (trim($("#postform #yzm").val())=='0') {
showDialog('验证码输入错误');
return false;
}
<?php } ?>
//防止二次提交
$(":submit",this).attr("disabled","disabled");
                //图片aid获取
                var imgselect = new Array();
                $($("input[name='imgselect[]']:not(:disabled)")).each(function(){
                    imgselect.push($(this).val());
                });
                var postUrll='http://www.8264.com/dianping.php?mod=misc&act=dopost&model=<?php echo $mod;?>&do=newsave&tid=<?php echo $detail['tid'];?>';
                var stararray=['很差','较差','还行','推荐','力荐'];
                $.post(postUrll,{starnum:starnum,weakpoint:weakpoint,message:message,ext1:ext1,ext2:ext2,ext3:ext3,ext4:ext4,ext5:ext5,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes',imgselect:imgselect},
                        function(data){
                            if(data == '-1'){
                                alert('你需要登陆后才能评价');
                                window.location.href = 'http://www.8264.com/member.php?mod=logging&action=login';
                                return false;
                            }else if(data){
                                $('#mycomment').show();
                                $('#mycomment').html(data);
                                $('#postform').parent('.write-comment-box').remove();
                                $(document).scrollTop($('#mycomment').offset().top-60);
                            }
                        });
            });
            //修改点评
            $('#editform').submit(function(event){
                event.preventDefault();
                var starnum = $("#editform .starnum").val();
                var ext3 = $.trim($("#editform #ext3_e").val());
                var weakpoint = $.trim($("#editform #weakpoint_e").val());
                var message = $.trim($("#editform #message_e").val());
                var ext1 = getNumberTime($("#editform input[name='datapicker[]']").eq(0).val());
                var ext2 = getNumberTime($("#editform input[name='datapicker[]']").eq(1).val());
                var ext4 = $("#editform input[name='datapicker[]']").eq(2).val();
                var ext5 = $("#editform input[name='datapicker[]']").eq(3).val();

                //form表单初始化验证后进行二次验证
                if(starnum == 0){
                    $("#starnumTip").show();
                    return false;
                }
                if(weakpoint.length<50){
                    show_errors('weakpoint_e_e','您所填字数不足！');
                    return false;
                }
                if(message.length<200){
                    show_errors('message_e_e','您所填字数不足！');
                    return false;
                }
                if(ext3.length<10){
                    show_errors('ext3_e_e','您所填字数不足！');
                    return false;
                }
                if(!checkText(ext1, ext2, ext4, ext5, '', '', '', 'show_errors')){
        			return false;
        		}
                if(ext1 == ext2){
                    if(!ext4 || !ext5 || ext4>24 || ext5 > 24 || parseInt(ext4)!=ext4 || parseInt(ext5)!=ext5){
                        show_errors('date_error_e','请正确填写日期！');
                        return false;
                    }
                }
                //图片aid获取
                var imgselect = new Array();
                $($("input[name='imgselect[]']:not(:disabled)")).each(function(){
                    imgselect.push($(this).val());
                });
                var pid = $("#editform #pid").val();
                var postUrll='http://www.8264.com/dianping.php?mod=misc&act=dopost&model=<?php echo $mod;?>&do=editsave&tid=<?php echo $detail['tid'];?>';
                var stararray=['很差','较差','还行','推荐','力荐'];
                $.post(postUrll,{starnum:starnum,pid:pid,weakpoint:weakpoint,message:message,ext1:ext1,ext2:ext2,ext3:ext3,ext4:ext4,ext5:ext5,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes',imgselect:imgselect},
                        function(data){
                            if(data == '-2'){
                                alert('修改失败');
                                $('#overlay').remove();
                                $('#edithtml .editinput').val('');
                                $('#edithtml').hide();
                                return false;
                            }else if(data){
                                $('#post_'+pid).html(data);
                                $('#overlay').remove();
                                $('#edithtml .editinput').val('');
                                $('#edithtml').hide();
                            }
                        });
            });
            $(".stars1 a").click(function(){
                var starnum = $(this).attr('value');
                var title   = $(this).attr('title');
                $('.stars1 li a').removeClass('current-star-rating');
                $(this).addClass('current-star-rating');
                $('.starnum').val(starnum);
                $("#starnumTip").hide();
                $(this).parents('ul').siblings('.stars1-tips').html(title);
            });
            //获取修改
            $(".comment-main").delegate(".editclick","click",function(){
                var pid = $(this).attr('id');
                var url = 'http://www.8264.com/dianping.php?mod=misc&act=dopost&do=editpost';
                var tid =  <?php echo $detail['tid'];?>;

                $.ajax({
                    type: "GET",
                    url: url,
                    data: {pid:pid,tid:tid},
                    dataType: "json",
                    success: function(data){
                        $('#editform #weakpoint_e').val((data['weakpoint']));
                        $('#editform #ext3_e').val(data['ext3']);
                        $('#editform #message_e').val(data['message']);
                        $('#editform #pid').val(pid);
                        $('#editform .starnum').val(data['starnum']);
                        $('#editform #star_'+data['starnum']+'_e').addClass('current-star-rating');

                        $("#editform input[name='datapicker[]']").eq(0).val(data.ext1);
                        $("#editform input[name='datapicker[]']").eq(1).val(data.ext2);
                        if(data.ext1 == data.ext2){
                            $("#editform input[name='datapicker[]']").eq(2).val(data.ext4);
                            $("#editform input[name='datapicker[]']").eq(2).show();
                            $("#editform input[name='datapicker[]']").eq(2).next().show();
                            $("#editform input[name='datapicker[]']").eq(3).val(data.ext5);
                            $("#editform input[name='datapicker[]']").eq(3).show();
                            $("#editform input[name='datapicker[]']").eq(3).next().show();
                        }else{
                        	$("#editform .timeHour").hide();
                        }

                        if(typeof (data['attachlist']) == "object"){
                            //图片处理
                            var str = '';
                            $.each(data['attachlist'],function(i,v){
                                str += "<span class=\"attachpic\"  id=\"image_"+ v.aid+"\">";
                                str += "<img width=60 height=60 src=\"http://image1.8264.com/plugin/"+ v.attachment+"\">";
                                str += "<b class=\"deleteimg\">删除</b>";
                                str += "<input type=\"hidden\" value=\""+ v.aid+"\" name=\"imgselect[]\">";
                                str += "</span>";
                            });
                            $("#imglist_e").html(str);
                        }else{
                            $("#imglist_e").empty();
                        }
                    }
                });

                easyDialog.open({
                    container : 'edithtml'
                });

                /*start----编辑页图片上传之flash初始化*/
                var params = {site:"http://www.8264.com/misc.php%3fmod=swfupload%26type=image%26fid=<?php echo $fid;?>%26mtype=plugin%26twidth=60%26theight=60%26random="+Math.random()+"%26back=upload_image_success_e",buttonimg:"http://static.8264.com/dianping/images/icon/data/uploadnew.png"};
                swfobject.embedSWF("http://www.8264.com/static/flash/uploadforum.swf", "pic_upload_multiimg_e", "150", "45", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
                swfobject.createCSS("#pic_upload_multiimg_e", "text-align:left;");
                /*end----编辑页图片上传之flash初始化*/

            });

            //图片上传之删除功能
            $(".row-color-6").on("click", ".deleteimg", function() {
                $(this).parent().remove();
                if($("#imglist .overlimit").length > 0){
                    $("#imglist .overlimit:first").removeClass('overlimit').find('input:hidden').removeAttr('disabled');
                }else{
                    $("#numimage").val($("#numimage").val() - 1);
                }
            });
        });
    })(jQuery);
    jQuery(document).ready(function($) {
        $.formValidator.initConfig({
            formID: "postform",
            debug: false,
            submitOnce: false,
            onError:function(msg,obj,errorlist){
            }
        });
        //综合
        $('#message').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>从线路风景、难度、强度、所需装备等方面对线路进行描述，文字200字以上</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 400,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请填写综合信息，文字200字以上</span></div>'
        });

        //注意
        $('#weakpoint').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>提醒他人需要注意的关键事项，如露营点、水源点、岔路口等</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 100,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请详细填写 注意事项 不少于50字</span></div>'
        });
        //费用
        $('#ext3').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>列举自己出行的各项话费，车费、住宿费、门票、参加商业活动费用等</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 20,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>您的费用描述不够详细，请列举出行的各项费用</span></div>'
        });

        //编辑
        //综合
        $('#message_e').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>从线路风景、难度、强度、所需装备等方面对线路进行描述，文字200字以上</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 400,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请填写综合信息，文字200字以上</span></div>'
        });

        //注意
        $('#weakpoint_e').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>提醒他人需要注意的关键事项，如露营点、水源点、岔路口等</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 100,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请详细填写 注意事项 不少于50字</span></div>'
        });
        //费用
        $('#ext3_e').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>列举自己出行的各项话费，车费、住宿费、门票、参加商业活动费用等</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 20,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>您的费用描述不够详细，请列举出行的各项费用</span></div>'
        });
    });

  //表单验证前的检验
    function checkText(startTime,endTime,startHour,endHour,weak,msg,price,fun){
    	weak 		= jQuery.trim(weak);
    	price 		= jQuery.trim(price);
    	msg  		= jQuery.trim(msg);
    	startHour 	= parseInt(startHour);
    	endHour  	= parseInt(endHour);

    	if(!fun){
    		fun = '_showmsg'
    	}

    	var date 	      = new Date();
    	var curTime    	  = Math.floor(date.getTime()/1000);

    	if(!startTime){
    	    fun == 'show_errors' ?  eval(fun+'("date_error_e", "请选择开始时间")') : eval(fun+'("请选择开始时间")');
    		return false
    	}
    	if (startTime > curTime) {
    		fun == 'show_errors' ?  eval(fun+'("date_error_e", "开始时间需小于当前时间")') : eval(fun+'("开始时间需小于当前时间")');
    		return false;
    	}
    	if(!endTime){
    	    fun == 'show_errors' ?  eval(fun+'("date_error_e", "请选择结束时间")') : eval(fun+'("请选择结束时间")');
    		return false;
    	}
    	if (endTime > curTime) {
    	    fun == 'show_errors' ?  eval(fun+'("date_error_e", "结束时间需小于当前时间")') : eval(fun+'("结束时间需小于当前时间")');
    		return false;
    	}
    	if(startTime > endTime){
    	    fun == 'show_errors' ?  eval(fun+'("date_error_e", "结束时间需大于开始时间")') : eval(fun+'("结束时间需大于开始时间")');
    		return false;
    	}

    	if(startTime == endTime){
    		var curHour 	= date.getHours();
    		var tempJiange  = curTime - startTime;
    		if(!startHour && startHour!=0){
    		fun == 'show_errors' ?  eval(fun+'("date_error_e", "请填写开始时间")') : eval(fun+'("请填写开始时间")');
    			return false;
    		}
    		//当天才需要判断
    		if (tempJiange < 86400) {
    			if (startHour > curHour) {
                    fun == 'show_errors' ?  eval(fun+'("date_error_e", "开始时间需小于当前时间")') : eval(fun+'(开始时间需小于当前时间")');
    				return false;
    			}
    		}
    		if(!endHour){
                fun == 'show_errors' ? eval(fun+'("date_error_e", "请填写结束时间")') : eval(fun+'("请填写结束时间")');
    			return false;
    		}
    		//当天才需要判断
    		if (tempJiange < 86400) {
    			if (endHour > curHour) {
                    fun == 'show_errors' ?  eval(fun+'("date_error_e", "结束时间需小于当前时间")') : eval(fun+'("结束时间需小于当前时间")');
    				return false;
    			}
    		}
    		if (startHour >= endHour) {
                fun == 'show_errors' ?  eval(fun+'("date_error_e", "结束时间需大于开始时间")') : eval(fun+'("结束时间需大于开始时间1")');
    			return false;
    		}
    	}
    	return true;
    }
    function calendarCallback(obj){
        var parentObj  = obj.parentNode;
        var childNodes = parentObj.childNodes;
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
            show_errors("date_error", "线路的"+sign+"时间需小于当前时间");
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
            show_errors("date_error", "线路的结束时间需大于开始时间");
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
    function show_errors(element_id, msg){
        if(element_id != '') {
            var error_ele = '<div class="onError" id="" style="display: block;"><div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>'+msg+'</span></div></div>';
            jQuery('#' + element_id).html(error_ele).show();
        }
    }
    //将日期转为时间戳
    function getNumberTime(time){
        time = time.replace(/-/g,"/");
        var date = new Date(time);
        time = Math.floor(date.getTime()/1000);
        return time;
    }
    <?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
function vode(theform){
if (trim(theform.captcha.value)=="") {
showDialog('验证码不能为空');
return false;
}
if (theform.yzm.value=='0') {
showDialog('验证码输入错误');
return false;
}
return fastpostvalidateoutshop(theform);
}
//验证码
jQuery('#refreshCaptcha').click(function() {
jQuery(this).children('img').attr('src', '/plugin.php?id=dailypicture:captcha&_='+(new Date().getTime()));
jQuery('#jg').html("");
return false;
});
jQuery('#captcha').blur(function(){
 validate_captcha();
 return false;
});
function validate_captcha() {
jQuery.ajax({
async: false,
type: 'get',
url: '/plugin.php?id=dailypicture:validatecaptcha&captcha='+jQuery('#captcha').val(),
success : function(data) {
if (data==1) {
jQuery('#jg').html("");
jQuery('#jg').append('<img width="16" height="16" class="vm" src="static/image/common/check_right.gif">');
jQuery('#yzm').val('1');
}else{
jQuery('#jg').html("");
jQuery('#jg').append('<img width="16" height="16" class="vm" src="static/image/common/check_error.gif">');
jQuery('#yzm').val('0');
//jQuery('#captcha').val('');
}
}
});
};
<?php } ?>
</script><?php if($act=='showview') { ?>
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