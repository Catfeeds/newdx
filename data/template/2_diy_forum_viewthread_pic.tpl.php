<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread_pic', 'common/header_8264');
0
|| checktplrefresh('./template/8264/forum/viewthread_pic.htm', './template/8264/common/header_8264.htm', 1509517894, 'diy', './data/template/2_diy_forum_viewthread_pic.tpl.php', './template/8264', 'forum/viewthread_pic')
|| checktplrefresh('./template/8264/forum/viewthread_pic.htm', './template/8264/common/nav_8264_top.htm', 1509517894, 'diy', './data/template/2_diy_forum_viewthread_pic.tpl.php', './template/8264', 'forum/viewthread_pic')
|| checktplrefresh('./template/8264/forum/viewthread_pic.htm', './template/8264/common/footer_8264lw.htm', 1509517894, 'diy', './data/template/2_diy_forum_viewthread_pic.tpl.php', './template/8264', 'forum/viewthread_pic')
|| checktplrefresh('./template/8264/forum/viewthread_pic.htm', './template/8264/common/header_common.htm', 1509517894, 'diy', './data/template/2_diy_forum_viewthread_pic.tpl.php', './template/8264', 'forum/viewthread_pic')
|| checktplrefresh('./template/8264/forum/viewthread_pic.htm', './template/8264/common/panel_8264.htm', 1509517894, 'diy', './data/template/2_diy_forum_viewthread_pic.tpl.php', './template/8264', 'forum/viewthread_pic')
|| checktplrefresh('./template/8264/forum/viewthread_pic.htm', './template/8264/common/footerCopyRight.htm', 1509517894, 'diy', './data/template/2_diy_forum_viewthread_pic.tpl.php', './template/8264', 'forum/viewthread_pic')
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
    <?php if(!empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
   		<link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_widthauto.css?<?php echo VERHASH;?>" />
    	<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
    <?php } ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'portal') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/template/8264/css/common/reset.css" />
<link rel="stylesheet" type="text/css" href="/template/8264/css/common/new_common.css" />
<?php } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_css_diy.css?<?php echo VERHASH;?>" />
<?php } ?>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript" type="text/javascript"></script>
<script>jQuery.noConflict();</script>
<!--[if IE 6]>
<script src="/template/8264/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="/template/8264/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?49299785f8cc72bacc96c9a5109227da";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="http://static.8264.com/static/image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
    <?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
    <?php include template('common/header_diy'); ?>    <?php } ?>
    <?php if(empty($topic) || $topic['useheader']) { ?>
    <?php echo adshow("headerbanner/wp a_h"); ?>    
    <?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; ?>
    <?php } ?>
<div id="wp" class="wp">
<link href="http://static.8264.com/static/css/forum/forum_viewthread.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/reset.css?<?php echo VERHASH;?>" />
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/new_common.css?<?php echo VERHASH;?>" />
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/pic_scan_newway.css?<?php echo VERHASH;?>" />
<!--新版头--><div class="top1">
<div class="nav960 clearfix" style="font-size:12px;">
<div class="top1_l">
<ul>
<li><a href="javascript:void(0)" class="top1_la">线上项目</a>
<div class="nav_xl top1_lxl xiangm"> <a href="http://www.8264.com/list/842" target="_blank" class="red">每日一图</a> <a href="http://www.8264.com/pp/" target="_blank" class="lan">铿锵玫瑰</a> <a href="http://www.8264.com/list/881" target="_blank" class="lv">线路推荐</a> <a href="http://www.8264.com/list/880" target="_blank" class="huang">勇者先行</a> <a href="http://www.8264.com/zhuangbei" target="_blank" class="red">装备推荐</a> </div>
</li>
<li><a href="javascript:void(0)"class="top1_la">线下项目</a>
<div class="nav_xl top1_lxl xiangm"> <a href="http://www.8264.com/topic/1458.html" target="_blank"class="lan">露营大会</a> <a href="http://www.8264.com/topic/1500.html" target="_blank"class="lv">滑雪比赛</a> </div>
</li>
<li><a href="http://www.8264.com/app/"class="top1_la_1">8264手机版</a></li>
</ul>
</div>
<div class="top1_r clearfix"><?php if($_G['uid']) { ?>

<strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="vwmy" target="_blank" title="访问我的空间"><?php echo $_G['member']['username'];?></a></strong>



<?php if($_G['group']['allowinvisible']) { ?>
<span id="loginstatus" class="">
<a href="member.php?mod=switchstatus" title="切换在线状态" onClick="ajaxget(this.href, 'loginstatus');doane(event);">
<?php if($_G['session']['invisible']) { ?>
隐身
<?php } else { ?>
在线
<?php } ?>
</a>
</span>
<?php } ?>


 <a href="home.php?mod=space&amp;do=friend">好友</a> 


<?php if($_G['setting']['regstatus'] > 1) { ?>
<a href="home.php?mod=spacecp&amp;ac=invite" class="">邀请</a> 
<?php } ?>


 <span id="usersetup" class="showmenu" onMouseOver="showMenu(this.id);">
<a href="home.php?mod=spacecp">设置</a>
</span>


 <a href="home.php?mod=space&amp;do=notice" id="myprompt"<?php if($_G['member']['newprompt']) { ?> class="new"<?php } ?>>提醒
<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?>
</a><span id="myprompt_check"></span>



 <a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>短消息
<?php if($_G['member']['newpm']) { ?>(<?php echo $_G['member']['newpm'];?>)<?php } ?></a>




<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?>
 <a href="portal.php?mod=portalcp">门户管理</a>
<?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
 <a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>
<?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?>
 <a href="admin.php" target="_blank">管理中心</a>
<?php } ?>




 <a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<strong><a id="loginuser"><?php echo $_G['cookie']['loginuser'];?></a></strong>


 
<a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">激活</a>


 <a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>


<?php } else { ?>
<a href="http://bbs.8264.com/connect.php?method=sina&amp;action=login&amp;op=init" class="log_wb">微博登陆</a>
<a href="http://bbs.8264.com/connect-login-op-init-referer-index.php-statfrom-login_simple.html" class="log_qq">QQ登陆</a>
<div style=" float:right;">
<a>欢迎来到8264!</a>
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href);hideWindow('login');"><?php echo $_G['setting']['reglinkname'];?></a>
<a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">登录</a></div>

<?php } ?>

</div>
</div>
</div>
<!--新版头-->
<div class="container">
<div class="content">
<div class="pic_title_yy">
<div class="pic_title_yy_l">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['forum_thread']['authorid'];?>" title="<?php echo $_G['forum_thread']['author'];?>"><?php echo avatar($_G[forum_thread][authorid],small); ?></a>

<p><a href="home.php?mod=space&amp;uid=<?php echo $_G['forum_thread']['authorid'];?>" title="<?php echo $_G['forum_thread']['author'];?>" target="_blank"><b><?php echo $_G['forum_thread']['author'];?></b></a><br><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>" id="thread_subject"><b><?php echo $_G['forum_thread']['subject'];?></b></a></p>
</div>
<div class="pic_title_yy_r">
发表于 <?php echo $post['dateline'];?>&nbsp;&nbsp;浏览数：<?php echo $_G['forum_thread']['views'];?>&nbsp;&nbsp;回复：<?php echo $_G['forum_thread']['replies'];?><br>

浏览模式：<span style="vertical-align:2px; padding:0px 5px 0px 0px;"><img src="http://static.8264.com/static/images/forum/markbig.png"></span><span style="color:#ffc000;">图片模式</span>&nbsp;&nbsp;<span style="vertical-align:1px; padding:0px 5px 0px 0px;"><img src="http://static.8264.com/static/images/forum/marklist.png"></span><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>">原帖模式</a>
</div>
<div style="clear:both;"></div>
</div>
<div id="rg-gallery" class="rg-gallery">
<div class="rg-thumbs">
<div class="es-carousel-wrapper">
<div class="rg-image-nav">
<a href="javascript:void(0)" class="rg-image-nav-prev" id="rg-prev">Previous Image</a>
<a href="javascript:void(0)" class="rg-image-nav-next" id="rg-next">Next Image</a>
</div>
<div class="show_menu">
<div class="piclist">
<ul><?php $countspic = count($pic_postlist) - 4 ; if(is_array($pic_postlist)) foreach($pic_postlist as $aidkey => $imagesrc) { ?><li><img src="<?php echo $aidkey;?>" data-large="<?php echo $imagesrc;?>"/></li>
<?php } ?>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="rg-image-wrapper">
<div><a name="pic" id="pic">&nbsp;</a><p>提示：支持键盘翻页 ←左 右→</p></div>
<div class="rg-caption-wrapper">
<div class="rg-caption">
<div class="display">
<img src="http://static.8264.com/static/images/ajax-loader.gif">
</div>
<div class="loading"></div>
</div>
</div>
<a href="javascript:void(0)"><div class="mouseleft"></div></a>
<a href="javascript:void(0)"><div class="mouseright"></div></a>
</div>
</div>
</div>
<div><input type="hidden" id="tid" value="<?php echo $_G['tid'];?>"></div>
<a href="javascript:void(0)"><div class="buttonleft"></div></a>
<a href="javascript:void(0)"><div class="buttonright"></div></a>

<!--[if IE 6]>
<script src="http://static.8264.com/static/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->

<script>
jQuery(function(){
jQuery(".show_menu .piclist ul li:first").addClass("selected");
jQuery(".rg-caption .display img").attr("src",jQuery(".selected img").attr("data-large"));
picload();

var scrollwidth = 800;
var showbox = jQuery('.show_menu');
var padding_showbox_right = parseFloat(showbox.css('padding-right')) + parseFloat(showbox.css('border-right-width'));
var padding_showbox_left = parseFloat(showbox.css('padding-left')) + parseFloat(showbox.css('border-left-width'));

function picload(){
jQuery('.rg-caption .display img').hide().attr("src",jQuery('.selected img').attr("data-large"));
jQuery('.rg-caption .loading').html("<img src='http://static.8264.com/static/images/ajax-loader.gif'>");
jQuery('.rg-caption .display img').load(function(){
chooseimgsize();
jQuery(this).fadeIn("3000");
jQuery('.rg-caption .loading').html("");
});
};

//加载图片（根据小图select属性 下面的大图随之变动）
jQuery('.piclist ul>li').live('click',function(){
jQuery(this).addClass('selected').siblings().removeClass('selected');
picload();
});

function topprev(){
var piclilength = jQuery('.piclist ul>li').length;
if(piclilength < 14){
return false;
}
var scorllobj = jQuery('.piclist');
var truewidth = showbox.offset().left - scorllobj.offset().left + padding_showbox_left;
if(!scorllobj.is(':animated')){
truewidth = truewidth < scrollwidth ? truewidth : scrollwidth;
scorllobj.animate({'left':'+='+truewidth},'slow');
}
}

function topnext(){
var piclilength = jQuery('.piclist ul>li').length;
if(piclilength < 14){
return false;
}
var scorllobj = jQuery('.piclist');
var lastli = scorllobj.find('li:last');
var piclistrightpos = lastli.offset().left + lastli.outerWidth() - padding_showbox_right;
var truewidth = piclistrightpos - showbox.offset().left - showbox.width();
if(!scorllobj.is(':animated')){
truewidth = truewidth < scrollwidth ? truewidth : scrollwidth;
scorllobj.animate({'left':'-='+truewidth},'slow');
}
}

jQuery('#rg-prev').click(function(){
topprev();
});

jQuery('#rg-next').click(function(){
picajax();
topnext();
});

jQuery('.buttonleft').click(function(){
var linum=jQuery('.selected').prevAll().length;
if(linum == 0){
return false;
}else{
jQuery('.selected').removeAttr('class').prev().addClass("selected");
picload();
}
zidongyouyi();
});

jQuery('.buttonright').click(function(){
var linums=jQuery('.selected').nextAll().length;
if(linums == 0){
return false;
}else if(linums == 2){
picajax();
jQuery('.selected').removeAttr('class').next().addClass("selected");
picload();
}else{
jQuery('.selected').removeAttr('class').next().addClass("selected");
picload();
}
zidongzuoyi();
});

jQuery(".mouseleft").click(function(){
var linum=jQuery('.selected').prevAll().length;
if(linum == 0){
return false;
}else{
jQuery('.selected').removeAttr('class').prev().addClass("selected");
picload();
}
zidongyouyi();
});

jQuery(".mouseright").click(function(){
var linums=jQuery('.selected').nextAll().length;
if(linums == 0){
return false;
}else if(linums == 2){
picajax();
jQuery('.selected').removeAttr('class').next().addClass("selected");
picload();
}else{
jQuery('.selected').removeAttr('class').next().addClass("selected");
picload();
}
zidongzuoyi();
});

//键盘左右键事件
jQuery(document).keydown(function(event){
//兼容
var e = window.event || event;
var k = e.keyCode || e.which;
//IE,firefox 兼容
var obj = e.srcElement ? e.srcElement : e.target;
if(k == "37" ){
var linum=jQuery('.selected').prevAll().length;
if(linum == 0){
return false;
}else{
jQuery('.selected').removeAttr('class').prev().addClass("selected");
picload();
}
zidongyouyi();
}else if(k == "39"){
var linums=jQuery('.selected').nextAll().length;
if(linums == 0){
return false;
}else if(linums == 2){
picajax();
jQuery('.selected').removeAttr('class').next().addClass("selected");
picload();
}else{
jQuery('.selected').removeAttr('class').next().addClass("selected");
picload();
}
zidongzuoyi();
}
});

//左右箭头
jQuery(".mouseleft").mouseover(function(){
jQuery(".buttonleft").css({ "background":"url(http://static.8264.com/static/images/forum/buttomleft.png) 10% 50% no-repeat"});
});
jQuery(".mouseleft").mouseout(function(){
jQuery(".buttonleft").css({ "background":""});
});
jQuery(".mouseright").mouseover(function(){
jQuery(".buttonright").css({ "background":"url(http://static.8264.com/static/images/forum/buttomright.png) 90% 50% no-repeat"});
});
jQuery(".mouseright").mouseout(function(){
jQuery(".buttonright").css({ "background":""});
});

jQuery(".buttonleft").mouseover(function(){
jQuery(".buttonleft").css({ "background":"url(http://static.8264.com/static/images/forum/buttomleft.png) 10% 50% no-repeat"});
});
jQuery(".buttonleft").mouseout(function(){
jQuery(".buttonleft").css({ "background":""});
});
jQuery(".buttonright").mouseover(function(){
jQuery(".buttonright").css({ "background":"url(http://static.8264.com/static/images/forum/buttomright.png) 90% 50% no-repeat"});
});
jQuery(".buttonright").mouseout(function(){
jQuery(".buttonright").css({ "background":""});
});

var begin=0;
var tid=document.getElementById("tid").value;
var piccount = <?php echo $countspic;?>;
jQuery('.piclist ul li:gt('+piccount+')').live('click',function(){
picajax();
});

function picajax(){
from = ++begin;
jQuery.get("/plugin.php?id=api:getpicbyviewthread", {inajax:1,tid:tid,from:from},
function(data){
if(data.length == 0){
return;
}
var obj=eval('('+data+')');
var objlength = obj.length;
for(var i=0;i<objlength;i++){
var picmin=obj[i][0];
var picmax=obj[i][1];
jQuery(".piclist ul").append("<li><img src='"+picmin+"' data-large='"+picmax+"'/></li>");
}
}
);
}

jQuery('ul li img').error(function(){
jQuery(this).attr("src","http://static.8264.com/static/images/tu_min.png");
});

jQuery('.rg-caption .display img').error(function(){
jQuery(this).attr("src","http://static.8264.com/static/images/tu.jpg");
});

//判断当前选中的图片 是否需要小图整体左移
function zidongzuoyi(){
var li_left = jQuery('.selected').offset().left;
var screen_width = jQuery(window).width()/1.6;
if(li_left > screen_width){
topnext();
}
}
//判断当前选中的图片 是否需要小图整体右移
function zidongyouyi(){
var li_left = jQuery('.selected').offset().left;
var screen_width = jQuery(window).width()/3;
if(li_left < screen_width){
topprev();
}
}
});
</script>
<script>
function chooseimgsize(){
jQuery(".rg-caption .display img").removeAttr("style");
var imgdivwidth = jQuery(window).width();
var imgwidth = jQuery(".rg-caption .display img").width();
if(imgwidth > imgdivwidth-150){
jQuery(".rg-caption .display img").css("width",imgdivwidth-150);
}
}
jQuery(window).resize(function(){
chooseimgsize();
});
</script>
<script>
var thisurl = this.location.href;
var thisurlnew = this.location.href+'#pic';

if(thisurl.lastIndexOf("#pic") == -1){
jQuery(".buttonleft").parent('a').attr('href',thisurlnew);
jQuery(".buttonright").parent('a').attr('href',thisurlnew);
jQuery(".mouseleft").parent('a').attr('href',thisurlnew);
jQuery(".mouseright").parent('a').attr('href',thisurlnew);
}else{
jQuery(".buttonleft").parent('a').attr('href',thisurl);
jQuery(".buttonright").parent('a').attr('href',thisurl);
jQuery(".mouseleft").parent('a').attr('href',thisurl);
jQuery(".mouseright").parent('a').attr('href',thisurl);
}
</script>
<script>
if (jQuery.browser.msie && (jQuery.browser.version == "6.0") && !jQuery.support.style) {
jQuery(".loading").css("display","none");
}
if (jQuery.browser.msie && (jQuery.browser.version == "7.0") && !jQuery.support.style) {
jQuery(".loading").css("display","none");
}
</script><!--网站底部 cms -->
<?php if(in_array($_G['fid'],array("408","471"))) { ?>
<script type="text/javascript">//<![CDATA[
ac_as_id = 72339;
ac_click_track_url = "";ac_format = 0;ac_mode = 1;
ac_width = 280;ac_height = 210;
//]]></script>
<script src="http://static.acs86.com/g.js" type="text/javascript"></script>
<?php } ?>
<div class="footer">
<div class="layout" style="margin:auto;"><div class="copyRight">
<p class="fr clearfix"><a href="http://www.8264.com/about-index.html" target="_blank">8264简介</a> | <a href="http://www.8264.com/about-contact.html" target="_blank">联系我们</a> | <a href="http://www.8264.com/about-adservice.html" target="_blank">广告服务</a> | <a href="http://www.8264.com/list/885" target="_blank">户外网址大全</a> | <a href="http://www.8264.com/sitemap" target="_blank">网站地图</a></p>
<p>津ICP备05004140号-10   ICP证 津B2-20110106</p>
<p>户外有风险，8264提醒您购买<a href="http://bx.8264.com/?8264com" target="_blank" style=" color:#2A85E8;">户外保险</a></p>
</div></div>
</div>
<!--网站底部 cms -->
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?></div>
<!--//waper结束//-->
<!--//论坛右下角弹窗 开始//-->
<?php if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb"> <em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?></em> <span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="关闭">关闭</a></span> </h3>
<hr class="l" />
<div class="detail">
<h4><a href="<?php echo $focus['url'];?>" target="_blank"><?php echo $focus['subject'];?></a></h4>
<p> <?php if($focus['image']) { ?> <a href="<?php echo $focus['url'];?>" target="_blank"><img src="<?php echo $focus['image'];?>" onload="thumbImg(this, 1)" _width="58" _height="58" /></a> <?php } ?> <?php echo $focus['summary'];?> </p>
</div>
<hr class="l" />
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">查看</a> </div>
<?php } ?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; } ?>
<!--//论坛右下角弹窗 结束//-->
<!--//网站头部设置下拉菜单 开始//-->
<ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar" class="touxian">修改头像</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile" class="ziliao">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit" class="jifen">积分</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup" class="yonghuzu" >用户组</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy" class="yinsishaixuan" >隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail" class="youjiantixing">邮件提醒</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password" class="mimaanquan">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { ?>     
     <?php if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { ?>    
     <?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
     <li <?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?> ><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>" <?php if($id=='myrepeats:memcp') { ?> class="majia"<?php } elseif($id=='sina_xweibo:home_binding') { ?>class="sina"<?php } elseif($id) { ?>class="qq"<?php } ?>><?php if($id=='sina_xweibo:home_binding') { ?>新浪绑定<?php } else { ?><?php echo $module['name'];?><?php } ?></a></li>     
 <?php } ?>        
     <?php } ?>
     <?php } ?>
</ul>
<!--//网站头部设置下拉菜单 结束//-->

<?php if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly"> 积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分 </div>
<div class="mncr"></div>
</div>
<?php } if(!$_G['setting']['bbclosed']) { ?> 
    <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?> 
    <script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script> 
    <?php } ?>
    <?php if(!isset($_G['cookie']['sendmail'])) { ?> 
    <script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script> 
    <?php } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script><script src="<?php echo $_G['setting']['jspath'];?>portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_G['gp_do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<?php } ?><?php output(); ?><script src=" http://www.baidu.com/js/opensug.js" type="text/javascript"></script>
<script src="http://www.8264.com/template/8264/js/common.js" type="text/javascript"></script>
<script type="text/javascript">
;(function($){    
$(".top1 ul li:has(div.nav_xl)").hover(function(){
$(this).children("div.nav_xl").stop(true,true).show();
},function(){
$(this).children("div.nav_xl").stop(true,true).hide();
});<!--// 网站头部 下拉//-->
$(".top2 ul li:has(div.nav_xl)").hover(function(){
$(this).children("div.nav_xl").stop(true,true).show();
},function(){
$(this).children("div.nav_xl").stop(true,true).hide();
});<!--// 网站头部简版nav 下拉//-->	
})(jQuery);
</script>








<script src="javascript/css.js" type="text/javascript"  type="text/javascript"></script>
<div id="myShow1" style="display:none;"></div>
<div id="myShow2" style="display:none;"></div>
<div id="myShow3" style="display:none;"></div>
<div id="myShow4" style="display:none;"></div>

</body>
</html>





