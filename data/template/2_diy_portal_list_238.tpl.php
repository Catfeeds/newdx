<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('list_238', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/portal/list_238.htm', './template/8264/common/header_8264_new.htm', 1509517867, 'diy', './data/template/2_diy_portal_list_238.tpl.php', 'data/diy', 'portal/list_238')
|| checktplrefresh('./template/8264/portal/list_238.htm', './template/8264/common/zhidemai.htm', 1509517867, 'diy', './data/template/2_diy_portal_list_238.tpl.php', 'data/diy', 'portal/list_238')
|| checktplrefresh('./template/8264/portal/list_238.htm', './template/8264/common/hd_ad.htm', 1509517867, 'diy', './data/template/2_diy_portal_list_238.tpl.php', 'data/diy', 'portal/list_238')
|| checktplrefresh('./template/8264/portal/list_238.htm', './template/8264/common/weixin_share_bottom.htm', 1509517867, 'diy', './data/template/2_diy_portal_list_238.tpl.php', 'data/diy', 'portal/list_238')
|| checktplrefresh('./template/8264/portal/list_238.htm', './template/8264/common/float_guide.htm', 1509517867, 'diy', './data/template/2_diy_portal_list_238.tpl.php', 'data/diy', 'portal/list_238')
|| checktplrefresh('./template/8264/portal/list_238.htm', './template/8264/common/ewm_l.htm', 1509517867, 'diy', './data/template/2_diy_portal_list_238.tpl.php', 'data/diy', 'portal/list_238')
|| checktplrefresh('./template/8264/portal/list_238.htm', './template/8264/common/footer_8264_new.htm', 1509517867, 'diy', './data/template/2_diy_portal_list_238.tpl.php', 'data/diy', 'portal/list_238')
|| checktplrefresh('./template/8264/portal/list_238.htm', './template/8264/common/header_common.htm', 1509517867, 'diy', './data/template/2_diy_portal_list_238.tpl.php', 'data/diy', 'portal/list_238')
|| checktplrefresh('./template/8264/portal/list_238.htm', './template/8264/common/index_ad_top.htm', 1509517867, 'diy', './data/template/2_diy_portal_list_238.tpl.php', 'data/diy', 'portal/list_238')
;
block_get('7131,7130,7129,7128,7127,7126,7125,7124,7123,7122,7121,7120,7119,7137,7139,7141,7143,7146,7148,7152,7155,7157,7159,7161,7064,7063,7069,7086,7085,7096,7095,7135,7136,7138,7140,7142,7144,7145,7147,7149,7150,7151,7153,7154,7156,7158,7160,7162,7065,7066,2831');?>
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
<!-- //手机绑定提示 --><?php $list = array(); ?><?php $isrightlist = $cat['catid']  == 224 ? 1 : 0; ?><?php $cat['subs'] = 1 ?><?php $wheresql = category_get_wheresql($cat); ?><?php $list = category_get_list($cat, $wheresql, $page); ?><link href="http://static.8264.com/static/css/portal/list_919.css" rel="stylesheet" type="text/css">
<style id="diy_style" type="text/css">#frameVNknkG {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_283 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_283 .content {  margin:0px !important;}#frameH8OOb9 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_284 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_284 .content {  margin:0px !important;}#framezoKdZh {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_285 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_285 .content {  margin:0px !important;}#framef017us {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_286 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_286 .content {  margin:0px !important;}#frameauYWwL {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_287 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_287 .content {  margin:0px !important;}#framemADsNU {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_288 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_288 .content {  margin:0px !important;}#framemm50I9 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_289 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_289 .content {  margin:0px !important;}#frame7CeRz4 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_290 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_290 .content {  margin:0px !important;}#frameZllK2F {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_291 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_291 .content {  margin:0px !important;}#frameN2Fpf7 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_292 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_292 .content {  margin:0px !important;}#frameIMM25v {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_293 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_293 .content {  margin:0px !important;}#frame88UU5S {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_294 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_294 .content {  margin:0px !important;}#frameZ8I78D {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_295 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_295 .content {  margin:0px !important;}#frame8uibzu {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_296 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_296 .content {  margin:0px !important;}#frameReeZzR {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_297 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_297 .content {  margin:0px !important;}#frame488zXJ {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_298 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_298 .content {  margin:0px !important;}#framefNFJyZ {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_299 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_299 .content {  margin:0px !important;}#framenlyUXy {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_300 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_300 .content {  margin:0px !important;}#frame7WDDi0 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_301 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_301 .content {  margin:0px !important;}#frame934oMn {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_302 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_302 .content {  margin:0px !important;}#framel1k8Bb {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#frameNTJm0J {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_304 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_304 .content {  margin:0px !important;}#frameXXFL18 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_305 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_305 .content {  margin:0px !important;}#portal_block_303 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_303 .content {  margin:0px !important;}#frame5WDd0c {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_306 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_306 .content {  margin:0px !important;}#framekwzwLk {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_307 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_307 .content {  margin:0px !important;}#framef0Ff06 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_308 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_308 .content {  margin:0px !important;}#frame663Jss {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_309 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_309 .content {  margin:0px !important;}#frame8QLB8s {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_310 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_310 .content {  margin:0px !important;}#frameNRKh8F {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_311 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_311 .content {  margin:0px !important;}#frame0srCrb {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_312 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_312 .content {  margin:0px !important;}#framezy3gAS {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_313 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_313 .content {  margin:0px !important;}#frameiKI67m {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_314 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_314 .content {  margin:0px !important;}#framelYLmLH {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_315 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_315 .content {  margin:0px !important;}#frameBU88s3 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#frameI4CDCb {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_317 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_317 .content {  margin:0px !important;}#frameSS3VM3 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_318 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_318 .content {  margin:0px !important;}#framephpCr4 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_319 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_319 .content {  margin:0px !important;}#framep9xs6b {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_1540 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_1540 .content {  margin:0px !important;}#framepgDLne {  margin:0px !important;border:medium none !important;}#portal_block_1544 {  margin:0px !important;border:medium none !important;}#portal_block_1544 .content {  margin:0px !important;}#frameKhvhQk {  margin:0px !important;border:medium none !important;}#portal_block_130 {  margin:0px !important;border:#000000 !important;}#portal_block_130 .content {  margin:0px !important;}#frameZ66iP5 {  margin:0px !important;border:medium none !important;}#framex0i3kh {  margin:0px !important;border:medium none !important;}#portal_block_131 {  margin:0px !important;border:#000000 !important;}#portal_block_131 .content {  margin:0px !important;}#frame50RZrL {  margin:0px !important;border:medium none !important;}#portal_block_132 .content {  margin:0px !important;}#portal_block_132 {  margin:0px !important;border:medium none !important;}#frameN4d466 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_133 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_133 .content {  margin:0px !important;}#frameAJr3yi {  margin:0px !important;border:medium none !important;}#portal_block_134 {  margin:0px !important;border:medium none !important;}#portal_block_134 .content {  margin:0px !important;}#framejMyhHy {  margin:0px !important;border:medium none !important;}#frameSQ7dPY {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_136 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_136 .content {  margin:0px !important;}#frameVec0lZ {  margin:0px !important;border:medium none !important;}#portal_block_137 {  margin:0px !important;border:medium none !important;}#portal_block_137 .content {  margin:0px !important;}#framef4Y4kf {  margin:0px !important;border:medium none !important;}#portal_block_138 {  margin:0px !important;border:medium none !important;}#portal_block_138 .content {  margin:0px !important;}#frame4yGFTZ {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_139 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#frame4B74NO {  margin:0px !important;border:medium none !important;}#portal_block_140 {  margin:0px !important;border:medium none !important;}#portal_block_140 .content {  margin:0px !important;}#frame1lBFx1 {  margin:0px !important;border:medium none !important;}#portal_block_141 {  margin:0px !important;border:medium none !important;}#portal_block_141 .content {  margin:0px !important;}#frameZLuFx4 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_142 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_142 .content {  margin:0px !important;}#framedRjAh2 {  margin:0px !important;border:medium none !important;}#portal_block_143 {  margin:0px !important;border:medium none !important;}#portal_block_143 .content {  margin:0px !important;}#frameg3j6JU {  margin:0px !important;border:medium none !important;}#portal_block_144 {  margin:0px !important;border:medium none !important;}#portal_block_144 .content {  margin:0px !important;}#frameA7Q75G {  margin:0px !important;border:medium none !important;}#portal_block_145 {  margin:0px !important;border:medium none !important;}#portal_block_145 .content {  margin:0px !important;}#framemkqGG3 {  margin:0px !important;border:medium none !important;}#frameE7vIXV {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_147 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_147 .content {  margin:0px !important;}#frameF7Xgv3 {  margin:0px !important;border:medium none !important;}#portal_block_148 {  margin:0px !important;border:medium none !important;}#portal_block_148 .content {  margin:0px !important;}#frame5O8w4w {  margin:0px !important;border:medium none !important;}#frame7N6IbZ {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#frameNceNbh {  margin:0px !important;border:medium none !important;}#portal_block_151 {  margin:0px !important;border:medium none !important;}#portal_block_151 .content {  margin:0px !important;}#framejtKyqE {  margin:0px !important;border:medium none !important;}#portal_block_152 {  margin:0px !important;border:medium none !important;}#portal_block_152 .content {  margin:0px !important;}#framepZW919 {  margin:0px !important;border:medium none !important;}#portal_block_153 {  margin:0px !important;border:medium none !important;}#portal_block_153 .content {  margin:0px !important;}#frame5J93b9 {  margin:0px !important;border:medium none !important;}#portal_block_154 {  margin:0px !important;border:medium none !important;}#portal_block_154 .content {  margin:0px !important;}#frame6Qif8o {  margin:0px !important;border:medium none !important;}#portal_block_155 {  margin:0px !important;border:medium none !important;}#portal_block_155 .content {  margin:0px !important;}#frameeulGZ9 {  margin:0px !important;border:medium none !important;}#portal_block_156 {  margin:0px !important;border:medium none !important;}#portal_block_156 .content {  margin:0px !important;}#frameQUqMUM {  margin:0px !important;border:medium none !important;}#portal_block_157 {  margin:0px !important;border:medium none !important;}#portal_block_157 .content {  margin:0px !important;}#frameI9t6s9 {  margin:0px !important;border:medium none !important;}#frameWzu9a6 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#framePPTOzP {  margin:0px !important;border:medium none !important;}#portal_block_1429 {  margin:0px !important;border:medium none !important;}#portal_block_1429 .content {  margin:0px !important;}#frameJcuIHV {  margin:0px !important;border:0px !important;}#portal_block_135 {  margin:0px !important;border:medium none !important;}#portal_block_135 .content {  margin:0px !important;}#frame69oyiL {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_1536 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#frameykCQ22 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_1541 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_1541 .content {  margin:0px !important;}#portal_block_150 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_150 .content {  margin:0px !important;}#frameSxqVod {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_1542 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:transparent !important;}#portal_block_1542 .content {  margin:0px !important;}#portal_block_139 .content {  margin:0px !important;}#portal_block_1523 {  margin:0px !important;border:medium none !important;}#portal_block_1523 .content {  margin:0px !important;}#portal_block_1536 .content {  margin:0px !important;}#portal_block_146 {  margin:0px !important;border:medium none !important;}#portal_block_146 .content {  margin:0px !important;}#portal_block_149 {  margin:0px !important;border:medium none !important;}#portal_block_149 .content {  margin:0px !important;}#portal_block_1530 {  margin:0px !important;border:medium none !important;}#portal_block_1530 .content {  margin:0px !important;}#portal_block_1563 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:transparent !important;}#portal_block_1563 .content {  margin:0px !important;}#frameoVIj58 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:transparent !important;}#portal_block_1564 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:transparent !important;}#portal_block_1564 .content {  margin:0px !important;}#portal_block_2499 {  margin:0px !important;border:medium none !important;}#portal_block_2499 .content {  margin:0px !important;}#frame8md82y {  margin:0px !important;border:medium none !important;}#frame95BW7r {  margin:0px !important;border:0px !important;}#portal_block_3909 {  margin:0px !important;border:0px !important;}#portal_block_3909 .content {  margin:0px !important;}#frameP9v6n4 {  margin:0px !important;border:0px !important;}#portal_block_4017 {  margin:0px !important;border:0px !important;}#portal_block_4017 .content {  margin:0px !important;}#framekhuu7v {  margin:0px !important;border:0px !important;}#portal_block_4018 {  margin:0px !important;border:0px !important;}#portal_block_4018 .content {  margin:0px !important;}#framel3kq61 {  margin:0px !important;border:0px !important;}#portal_block_4019 {  margin:0px !important;border:0px !important;}#portal_block_4019 .content {  margin:0px !important;}#framezK781N {  margin:0px !important;border:0px !important;}#framess3Nlf {  margin:0px !important;border:0px !important;}#portal_block_4021 {  margin:0px !important;border:0px !important;}#portal_block_4021 .content {  margin:0px !important;}#portal_block_4020 {  margin:0px !important;border:0px !important;}#portal_block_4020 .content {  margin:0px !important;}#frame1WcecZ {  margin:0px !important;border:0px !important;}#portal_block_4048 {  margin:0px !important;border:#000000 0px !important;}#portal_block_4048 .content {  margin:0px !important;}#frame1VX6c2 {  margin:0px !important;border:0px !important;}#portal_block_4049 {  margin:0px !important;border:0px !important;}#portal_block_4049 .content {  margin:0px !important;}#framegLH5vZ {  margin:0px !important;border:0px !important;}#portal_block_4024 {  margin:0px !important;border:0px !important;}#portal_block_4024 .content {  margin:0px !important;}#frame272mdf {  margin:0px !important;border:0px !important;}#portal_block_4025 {  margin:0px !important;border:0px !important;}#portal_block_4025 .content {  margin:0px !important;}#frame866PVu {  margin:0px !important;border:0px !important;}#frame2ejiG1 {  margin:0px !important;border:0px !important;}#frame7YVlRB {  margin:0px !important;border:0px !important;}#portal_block_4026 {  margin:0px !important;border:0px !important;}#portal_block_4026 .content {  margin:0px !important;}#portal_block_4027 {  margin:0px !important;border:medium none !important;}#portal_block_4028 {  margin:0px !important;border:0px !important;}#portal_block_4028 .content {  margin:0px !important;}#frame1kmDW7 {  margin:0px !important;border:0px !important;}#portal_block_4029 {  margin:0px !important;border:0px !important;}#portal_block_4029 .content {  margin:0px !important;}#frame2xZ5X2 {  margin:0px !important;border:0px !important;}#portal_block_4030 {  margin:0px !important;border:0px !important;}#portal_block_4030 .content {  margin:0px !important;}#frameWPW6MW {  margin:0px !important;border:medium none !important;}#portal_block_4050 {  margin:0px !important;border:medium none !important;}#portal_block_4050 .content {  margin:0px !important;}#frameLfyNFR {  margin:0px !important;border:medium none !important;}#portal_block_4051 {  margin:0px !important;border:medium none !important;}#portal_block_4051 .content {  margin:0px !important;}#frameVO8hHx {  margin:0px !important;border:none !important;background-color:transparent !important;background-image:none !important;}#portal_block_4822 {  margin:0px !important;border:none !important;background-color:transparent !important;background-image:none !important;}#portal_block_4822 .content {  margin:0px !important;}</style>

<div class="header">
<div class="layout">
<div class="icoHill">&nbsp;</div>
<div class="headerL">
<h1><span class="country"><?php echo $cat['catname'];?></span></h1>
<div class="site">
<a href="<?php echo $_G['config']['web']['portal'];?>">首页</a>
> <a href="http://www.8264.com/list/238/">户外知识</a>
                                <?php if($cat['catid'] !=238 ) { ?>
                                > <a href="<?php echo $_G['config']['web']['portal'];?>list/<?php echo $cat['catid'];?>/"><?php echo $cat['catname'];?></a>
                                <?php } ?>

</div>
</div>

        <!--百度分享开始-->
        <div class="headerR" style="top:5px;">
        <div class="bdsharebuttonbox"><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a></div>
<script>
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":[],"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
        </div>
        <!--百度分享结束-->
</div>
</div>
<div class="warpper">
<?php if($cat['catid'] == 919) { ?>
    <?php block_display('7131'); ?>    <?php } elseif($cat['catid'] == 915) { ?>
    <?php block_display('7130'); ?>    <?php } elseif($cat['catid'] == 953) { ?>
    <?php block_display('7129'); ?>    <?php } elseif($cat['catid'] == 952) { ?>
    <?php block_display('7128'); ?>    <?php } elseif($cat['catid'] == 951) { ?>
    <?php block_display('7127'); ?>    <?php } elseif($cat['catid'] == 921) { ?>
    <?php block_display('7126'); ?>    <?php } elseif($cat['catid'] == 918) { ?>
    <?php block_display('7125'); ?>    <?php } elseif($cat['catid'] == 917) { ?>
    <?php block_display('7124'); ?>    <?php } elseif($cat['catid'] == 920) { ?>
    <?php block_display('7123'); ?>    <?php } elseif($cat['catid'] == 931) { ?>
    <?php block_display('7122'); ?>    <?php } elseif($cat['catid'] == 950) { ?>
    <?php block_display('7121'); ?>    <?php } elseif($cat['catid'] == 242) { ?>
    <?php block_display('7120'); ?>    <?php } elseif($cat['catid'] == 916) { ?>
    <?php block_display('7119'); ?>    <?php } elseif($cat['catid'] == 966) { ?>
    <?php block_display('7137'); ?>    <?php } elseif($cat['catid'] == 968) { ?>
    <?php block_display('7139'); ?>    <?php } elseif($cat['catid'] == 967) { ?>
    <?php block_display('7141'); ?>    <?php } elseif($cat['catid'] == 969) { ?>
    <?php block_display('7143'); ?>    <?php } elseif($cat['catid'] == 970) { ?>
    <?php block_display('7146'); ?>    <?php } elseif($cat['catid'] == 973) { ?>
    <?php block_display('7148'); ?>    <?php } elseif($cat['catid'] == 971) { ?>
    <?php block_display('7152'); ?>    <?php } elseif($cat['catid'] == 974) { ?>
    <?php block_display('7155'); ?>    <?php } elseif($cat['catid'] == 975) { ?>
    <?php block_display('7157'); ?>    <?php } elseif($cat['catid'] == 977) { ?>
    <?php block_display('7159'); ?>    <?php } elseif($cat['catid'] == 976) { ?>
    <?php block_display('7161'); ?>    <?php } ?>

    <div class="w980">
    	<!-- 值得买 -->
            <?php include(DISCUZ_ROOT.'./source/plugin/skiing/hd_zw.php'); ?>            <?php $zhidemai_list = ForumOptionHuoDong::pianyi_sidebar(6, 'top', 'jiu', '10027'); ?>            <?php if($zhidemai_list) { ?>
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
<div class="w980">
    	<!--左侧开始-->
<div class="l660">
            <ul class="newlistcon">
                <?php if(is_array($list['list'])) foreach($list['list'] as $value) { ?>                <?php $datearr1 = explode(" ",$value[dateline]);
                        $datearr2 = explode("-",$datearr1[0]);
                        $value['summary'] = str_replace("　　","",$value['summary']); ?>                <li>
                    <a href="portal.php?mod=view&amp;aid=<?php echo $value['aid'];?>" class="newlistimg" target="_blank"><img src="<?php echo $value['pic'];?>"><i><?php echo $value['catname'];?></i></a>
                    <div class="newlist_r">
                        <h3><a href="portal.php?mod=view&amp;aid=<?php echo $value['aid'];?>" title='<?php echo $value['title'];?>' target='_blank'><?php echo $value['title'];?></a></h3>
                        <span><?php echo $value['summary'];?></span>
                        <div style="padding:10px 0px 0px 0px; color:#999;">
                            <em style="padding:0px 20px 0px 0px;">作者：<?php if($value['author']) { ?><?php echo $value['author'];?><?php } else { ?><?php echo $value['username'];?><?php } ?>&nbsp;&nbsp;来源于：<?php if($value['from']) { ?><?php echo $value['from'];?><?php } else { ?>8264<?php } ?></em>
                            <em>时间：<?php echo date('Y-m-d', $value['dateline_ori']); ?></em>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php if($list['multi']) { ?>
            <div class="listPageBox">
                <div class="pg"><?php echo $list['multi'];?></div>
            </div>
            <?php } ?>
        </div>
        <!--左侧结束-->
<!--右侧开始-->
        <div class="r300">
            <?php block_display('7064'); ?>        	<?php if($cat['catid'] == 919) { ?>
            <?php block_display('7063'); ?>            <?php } elseif($cat['catid'] == 915) { ?>
            <?php block_display('7069'); ?>            <?php } elseif($cat['catid'] == 931) { ?>
            <?php block_display('7086'); ?>            <?php } elseif($cat['catid'] == 920) { ?>
            <?php block_display('7085'); ?>            <?php } elseif($cat['catid'] == 242) { ?>
            <?php block_display('7096'); ?>            <?php } elseif($cat['catid'] == 950) { ?>
            <?php block_display('7095'); ?>            <?php } elseif($cat['catid'] == 952) { ?>
            <?php block_display('7135'); ?>            <?php } elseif($cat['catid'] == 918) { ?>
            <?php block_display('7136'); ?>            <?php } elseif($cat['catid'] == 966) { ?>
            <?php block_display('7138'); ?>            <?php } elseif($cat['catid'] == 968) { ?>
            <?php block_display('7140'); ?>            <?php } elseif($cat['catid'] == 967) { ?>
            <?php block_display('7142'); ?>            <?php } elseif($cat['catid'] == 969) { ?>
            <?php block_display('7144'); ?>            <?php } elseif($cat['catid'] == 970) { ?>
            <?php block_display('7145'); ?>            <?php } elseif($cat['catid'] == 916) { ?>
            <?php block_display('7147'); ?>            <?php } elseif($cat['catid'] == 973) { ?>
            <?php block_display('7149'); ?>            <?php } elseif($cat['catid'] == 951) { ?>
            <?php block_display('7150'); ?>            <?php } elseif($cat['catid'] == 917) { ?>
            <?php block_display('7151'); ?>            <?php } elseif($cat['catid'] == 971) { ?>
    <?php block_display('7153'); ?>            <?php } elseif($cat['catid'] == 953) { ?>
            <?php block_display('7154'); ?>            <?php } elseif($cat['catid'] == 974) { ?>
            <?php block_display('7156'); ?>            <?php } elseif($cat['catid'] == 975) { ?><?php block_display('7158'); ?>            <?php } elseif($cat['catid'] == 977) { ?>
            <?php block_display('7160'); ?>            <?php } elseif($cat['catid'] == 976) { ?><?php block_display('7162'); ?>            <?php } ?>

            <?php if($cat['catid'] != 919) { ?>
            <div class="mt10">
<a href="http://static.8264.com/oldcms/jiesheng/index.htm" rel="nofollow" target="_blank">
<img width="298" height="80" border="0" src="http://static.8264.com/static/images/moban/1024newslw/images/1048253cphjjj754i4q84r.jpg">
</a>
</div>
<div class="mt10">
<a href="http://static.8264.com/oldcms/outgames/index.htm" rel="nofollow" target="_blank">
<img width="298" height="80" border="0" src="http://static.8264.com/static/images/moban/1024newslw/images/104737y6lsty6zyustrzys.jpg">
</a>
</div>
<div class="mt10">
<a href="http://static.8264.com/oldcms/maoxian/index.htm" rel="nofollow" target="_blank">
<img width="298" height="80" border="0" src="http://static.8264.com/static/images/moban/1024newslw/images/104704d8m8kdbtvva5k8b8.jpg">
</a>
</div>
            <?php } ?>

            <?php if($hddata) { ?>
            <!--采集信息开始 hd_ad-->
<!--采集信息结束-->
            <?php } ?>

            <!--JD广告开始-->
            <!-- common/adv_jd_300 -->            <!--JD广告结束-->

            <div style="margin:10px 0 0 0;"><?php echo adshow("custom_433"); ?></div>
        </div>
        <!--右侧结束-->
</div>

    <div style ="background: #1a2b38;color: #ffffff; margin-top: 45px; padding:10px 0px 30px;">
        <div style="position:relative;width: 980px; margin: 0 auto;">
            <div style=" background: url(http://static.8264.com/static/image/common/bg_fourm_sprite.png) no-repeat; height: 16px; left: 0; position: absolute; text-indent: -9999px; top: -26px; width: 175px;"></div>
        </div>
        <div class="choiceness">
        	<?php if($cat['catid'] == 919) { ?>
            <?php block_display('7065'); ?>            <?php } elseif($cat['catid'] == 915) { ?>
            <?php block_display('7066'); ?>            <?php } else { ?>
            <?php block_display('2831'); ?>            <?php } ?>
        </div>
    </div><?php echo adshow("custom_445"); ?></div><style type="text/css">
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
</script><div class="float-guide" style="display:none;">
<ul>
<li>
<a href="http://www.8264.com/list/842" class="photoDay">每日一图</a>
<?php if($mrytnum>0) { ?>
<span class="new"><?php echo $mrytnum;?></span>
<?php } ?>
</li>
<li>
<a href="http://www.8264.com/pp/" class="steelRose">铿锵玫瑰</a>
<?php if($kqmgnum>0) { ?>
<span class="new"><?php echo $kqmgnum;?></span>
<?php } ?>
</li>
<li style="display:none;">
<a href="http://www.8264.com/list/881" class="lineRec">线路推荐</a>
<?php if($xltjnum>0) { ?>
<span class="new"><?php echo $xltjnum;?></span>
<?php } ?>
</li>
<li>
<a href="http://www.8264.com/list/871" class="bbsRec">论坛精选</a>
<?php if($jctjnum>0) { ?>
<span class="new"><?php echo $jctjnum;?></span>
<?php } ?>
</li>
<li>
<a href="http://hd.8264.com/" class="zwxl" target="_blank">活动平台</a>
</li>
<li>
<a href="http://www.8264.com/list/912/" class="hwsy" target="_blank">户外摄影师</a>
<?php if($hwsysnum>0) { ?>
<span class="new"><?php echo $hwsysnum;?></span>
<?php } ?>
</li>
</ul>
<script type="text/javascript">
;(function($){
var width = $(window).width();
var csswd = (width-980)/2+990;
$('.float-guide').css("right",csswd);
})(jQuery);
</script>
<style type="text/css">
/* 右侧固定导航 */
.float-guide { width: 122px; padding: 5px; float: left; position: fixed; top: 35%; _position: absolute; _bottom: auto; _top:expression(eval(document.documentElement.scrollTop));
_margin-top: 20%; border: 1px solid #e9e9e9; background-color: #fdfdfd; border-radius: 3px; }
.float-guide a { display: block; height: 36px; text-indent: 40px; font: 14px/36px "Microsoft YaHei"; color: #637a94; background-color: #FFF; border-radius: 3px; }
.float-guide a:hover { color: #FFF; background-color: #637a94; text-decoration: none; }
.float-guide .photoDay { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px 9px;}
.float-guide .photoDay:hover { background-position: 11px -181px; }
.float-guide .steelRose { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -31px;}
.float-guide .steelRose:hover { background-position: 11px -222px; }
.float-guide .lineRec { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -67px;}
.float-guide .lineRec:hover { background-position: 11px -258px; }
.float-guide .braveFirst { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -103px;}
.float-guide .braveFirst:hover { background-position: 11px -293px; }
.float-guide .equipRec { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -137px;}
.float-guide .equipRec:hover { background-position: 11px -327px; }
.float-guide .bbsRec { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -405px;}
.float-guide .bbsRec:hover { background-position: 11px -443px; }



.float-guide .zwxl { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -481px;}
.float-guide .zwxl:hover { background-position: 11px -516px; }

.float-guide .hwsy { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 10px -554px;}
.float-guide .hwsy:hover { background-position: 10px -590px; }

/* Add 气泡 2013-07-01 */
.float-guide ul li { position: relative; }
.float-guide ul li .new { position: absolute; top: -5px; right: -10px; width: 30px; height: 14px; background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 0 -380px; font-size: 9px; line-height: 11px; color: #FFF; text-align: center; cursor: pointer; }
</style>
</div>
<style>
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.h13_ewm{ height:13px;}
.ewmbox{ width:160px; position: fixed !important; _position: absolute; z-index: 1; top:370px;  _top:expression(eval(document.documentElement.scrollTop)); float:right; color:#585858;}
.close_ewm{ width:11px; height:11px; background:url(http://static.8264.com/static/images/common/ewmclose.jpg) left top no-repeat; float:right; margin-bottom:2px; display:none;}
.close_ewm:hover{  background:url(http://static.8264.com/static/images/common/ewmclose_hover.jpg) left top no-repeat;}
.ewmwarpten{ width:110px; font-size:12px; background:#efefef; text-align:center; font-family:"Microsoft YaHei",Tahoma,Helvetica,SimSun,sans-serif; padding:4px 0px 10px 0px; display:block; color:#1e6d9b; text-decoration:none;}

</style>
<div class="ewmbox" style="display:none;">
<div class="clear_b h13_ewm"><a href="javascript:void(0)" class="close_ewm"></a></div><?php echo adshow("custom_468"); ?></div>
<script type="text/javascript">

jQuery(function(){	
var isiOS 	  = navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod');
    var isAndroid = navigator.userAgent.match('Android');
    if (!isiOS && !isAndroid) {
    	jQuery(".ewmbox").show();    	
    	jQuery(".ewmbox").hover(
function () {
jQuery(".close_ewm",this).show();
  },
  function () {
jQuery(".close_ewm",this).hide();
  }
);
jQuery(".close_ewm").click(function(){
jQuery(".ewmbox").hide();
});   	
    }
var ww = jQuery(window).width();   
var r_z = (ww-980)/2 -180;
if(r_z<0){
jQuery(".ewmbox").css("right",'0px');
}else{
jQuery(".ewmbox").css("right",r_z);
};
if(ww>1350){
jQuery(".ewmbox").show();
}else{
jQuery(".ewmbox").hide();
}	
});

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