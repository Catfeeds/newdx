<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('articleread_show', 'common/header_8264_1170_new');
0
|| checktplrefresh('./template/8264/forum/articleread_show.htm', './template/8264/common/header_8264_1170_new.htm', 1509517865, '2', './data/template/2_2_forum_articleread_show.tpl.php', './template/8264', 'forum/articleread_show')
|| checktplrefresh('./template/8264/forum/articleread_show.htm', './template/8264/forum/travelread_comment_body.htm', 1509517865, '2', './data/template/2_2_forum_articleread_show.tpl.php', './template/8264', 'forum/articleread_show')
|| checktplrefresh('./template/8264/forum/articleread_show.htm', './template/8264/forum/travelread_comment_body.htm', 1509517865, '2', './data/template/2_2_forum_articleread_show.tpl.php', './template/8264', 'forum/articleread_show')
|| checktplrefresh('./template/8264/forum/articleread_show.htm', './template/8264/dianping/showview_credit_narrow.htm', 1509517865, '2', './data/template/2_2_forum_articleread_show.tpl.php', './template/8264', 'forum/articleread_show')
|| checktplrefresh('./template/8264/forum/articleread_show.htm', './template/8264/common/footer_8264_1170_new.htm', 1509517865, '2', './data/template/2_2_forum_articleread_show.tpl.php', './template/8264', 'forum/articleread_show')
|| checktplrefresh('./template/8264/forum/articleread_show.htm', './template/8264/common/header_common.htm', 1509517865, '2', './data/template/2_2_forum_articleread_show.tpl.php', './template/8264', 'forum/articleread_show')
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
<!--[if ie 7]>
<style type="text/css">
.stragy-titbar .pb-time{color:#fff;}
.attent-wrapper .left-joint,.attent-wrapper .right-joint,.attent-wrapper .attentList-content,.pf-opt .btn-bed,.btn-30px em,.userlist-wrap a,.userlist-wrap .comment-num,{display:inline;zoom:1}
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
<div id="forumPage">
<div class="headerNav">
<div class="layout">
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
<?php if(CURMODULE == 'readmodeltravel') { ?><input type="hidden" name="nsid" value="3" /><?php } ?>
<span id="searchTips" class="tips">搜索</span>
<input id="searchText" class="text" type="text" value="" name="q"/>
<input class="subButton" type="submit" value=""/>
</form>
</div>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; ?>
<div id="wp">
<link rel="stylesheet" href="http://static.8264.com/static/css/forum/readmodel.css">
<style type="text/css">
body {background-color:#efefef;}
.newswarpten {display:none!important;}
.art-content p {text-align:left!important;}
.site a.gt {
    background: rgba(0, 0, 0, 0) url("http://static.8264.com/dianping/images/icon/data/crumb_bg.gif") no-repeat scroll 100% 50%;
    margin-right: 4px;
    padding-right: 12px;
}
</style>
<script src="http://static.8264.com/static/js/forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script src="http://static.8264.com/static/js/jquery.lazyload.min.js" type="text/javascript" type="text/javascript"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {
jQuery("#appd-wrap-open-cnt").on('click', function() {
var e = jQuery(this);
jQuery("#appd-wrap-open-cnt").animate({
left: "-100%"
},300,function(){
jQuery(this).parent().hide();
jQuery("#fl-pop-wrap-cntr").animate({
left: "0%"
},800,function(){
}).parent().show();;
});

});
jQuery("#appd_wrap_close").on('click', function() {
var e = jQuery(this);
jQuery("#fl-pop-wrap-cntr").animate({
left: "-100%"
},300,function(){
jQuery(this).parent().hide();
jQuery("#appd-wrap-open-cnt").animate({
left: "0%"
},800,function(){
}).parent().show();;
});
});
});
</script>
<div id="forumPage">
<div class="header">
<div class="layout">
<style type="text/css">
.dsad{position:absolute;right:230px;top:18px}
</style>
<div class="dsad"><?php echo adshow("custom_290"); ?></div>
<div class="icoHill">山</div>
<div class="headerL">
<h5><span class="country"><a href="<?php echo $forumnameurl;?>"><?php echo $_G['forum']['name'];?></a></span></h5>
<div class="site">
<a href="http://www.8264.com/" class="gt">首页</a>
<a href="http://bbs.8264.com/" class="gt xlsj">驴友论坛</a>
<?php echo $navigation;?>
<?php if($threadShow['typeid'] && $_G['forum']['threadtypes']['types'][$threadShow['typeid']]) { ?>
    <?php $dm=$forumOption->getdomainbyfidandtypeid($_G['fid'],$threadShow['typeid']); ?>    <?php if($dm) { ?>
    <a href="http://<?php echo $dm;?>.8264.com/" class="gt"><?php echo $_G['forum']['threadtypes']['types'][$threadShow['typeid']];?></a>
    <?php } else { ?>
    <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=typeid&amp;typeid=<?php echo $threadShow['typeid'];?>" class="gt"><?php echo $_G['forum']['threadtypes']['types'][$threadShow['typeid']];?></a>
    <?php } } ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>" class="titleoverflow200"><?php echo $threadShow['subject'];?></a>
</div>
</div>
<div class="headerR">
<div class="bbsNumCount">
<div class="numBox">
<p class="num"><?php echo $_G['forum']['threads'];?></p>
<p class="day">主题</p>
</div>
<div class="numBox">
<p class="num"><?php echo $_G['forum']['todayposts'];?></p>
<p class="day">今日</p>
</div>
</div>
</div>
<style type="text/css">
.nav_t_p_a{width:980px;border:#d8d8d8 solid 1px;position:absolute;top:52px;left:0;z-index:6363;background:#fff;box-shadow: 0 2px 5px #ccc}
.nav_t_p_a dl{display:table;border-bottom:#d8d8d8 solid 1px;width:100%;margin:0;padding:11px 0 6px 0;background:url(http://static.8264.com/static/image/common/bbsnavbg.jpg) -21px 0px repeat-y}
.nav_t_p_a dl.without_b{border-bottom:0 none}
.nav_t_p_a dt{float:left;width:94px;margin:0;padding:0;text-indent:15px;height:100%;font-size:12px;color:#fff}
.nav_t_p_a dd{margin:0px;padding:0px;overflow:hidden}
.nav_t_p_a dd a{margin:0 20px 5px 0;display:inline-block;white-space:nowrap}
.nav_t_p_a dd a:hover{color:#43a6df}
.headerL .site .xlsj{padding:0 16px 0 0;background:url(http://static.8264.com/static/image/common/arrow_xl.jpg) 51px 7px no-repeat}
.headerL .site .xlsj_down{padding:0 16px 0 0;:url(http://static.8264.com/static/image/common/arrow_xl.jpg) 51px -8px no-repeat}
</style>
<div class="nav_t_p_a" style="display: none;">
<dl class="bg">
<dt>驴行天下</dt>
<dd>
<a href="http://bbs.8264.com/forum-12-1.html">户外大厅</a>
<a href="http://bbs.8264.com/forum-5-1.html">商业活动|线路</a>
<a href="http://bbs.8264.com/forum-161-1.html">AA相约</a>
<a href="http://bbs.8264.com/forum-52-1.html">游记攻略</a>
<a href="http://bbs.8264.com/forum-39-1.html">户外摄影</a>
<a href="http://bbs.8264.com/forum-56-1.html">我秀我户外</a>
<a href="http://bbs.8264.com/forum-69-1.html">走出国门</a>
<a href="http://bbs.8264.com/forum-146-1.html">户外美食</a>
<a href="http://bbs.8264.com/forum-163-1.html">有问必答</a>
<a href="http://bbs.8264.com/forum-42-1.html">视频|下载</a>
<a href="http://bbs.8264.com/forum-58-1.html">户外经理人</a>
<a href="http://bbs.8264.com/forum-489-1.html">户外先锋营</a>
</dd>
</dl>
<dl class="bg">
<dt>户外运动</dt>
<dd>
<a href="http://bbs.8264.com/forum-24-1.html">山伍成群</a>
<a href="http://bbs.8264.com/forum-135-1.html">岩壁芭蕾</a>
<a href="http://bbs.8264.com/forum-88-1.html">骑行天下</a>
<a href="http://bbs.8264.com/forum-179-1.html">钓鱼</a>
<a href="http://bbs.8264.com/forum-178-1.html">探洞|绳索运用</a>
<a href="http://bbs.8264.com/forum-447-1.html">水上运动</a>
<a href="http://bbs.8264.com/forum-186-1.html">滑雪</a>
<a href="http://bbs.8264.com/forum-66-1.html">自驾|拼车</a>
<a href="http://bbs.8264.com/forum-495-1.html">跑步|越野跑</a>
</dd>
</dl>
<dl class="bg">
<dt>户外装备</dt>
<dd>
<a href="http://bbs.8264.com/forum-7-1.html">装备天下</a>
<a href="http://bbs.8264.com/forum-490-1.html">装备库</a>
<a href="http://bbs.8264.com/forum-53-1.html">装备交易</a>
<a href="http://bbs.8264.com/forum-408-1.html">户外品牌排行榜</a>
<a href="http://bbs.8264.com/forum-169-1.html">非户外装备交易区</a>
<a href="http://www.7jia2.com/?from=bbs" target="_blank">驴友商城</a>
</dd>
</dl>
<dl class="bg">
<dt>地方论坛</dt>
<dd>
<a href="http://bbs.8264.com/forum-158-1.html">安徽</a>
<a href="http://bbs.8264.com/forum-101-1.html">北京</a>
<a href="http://bbs.8264.com/forum-166-1.html">重庆</a>
<a href="http://bbs.8264.com/forum-113-1.html">福建</a>
<a href="http://bbs.8264.com/forum-110-1.html">甘肃</a>
<a href="http://bbs.8264.com/forum-112-1.html">广东</a>
<a href="http://bbs.8264.com/forum-108-1.html">广西</a>
<a href="http://bbs.8264.com/forum-176-1.html">贵州</a>
<a href="http://bbs.8264.com/forum-117-1.html">海南</a>
<a href="http://bbs.8264.com/forum-104-1.html">河北</a>
<a href="http://bbs.8264.com/forum-106-1.html">河南</a>
<a href="http://bbs.8264.com/forum-164-1.html">湖北</a>
<a href="http://bbs.8264.com/forum-114-1.html">湖南</a>
<a href="http://bbs.8264.com/forum-159-1.html">黑龙江</a>
<a href="http://bbs.8264.com/forum-116-1.html">吉林</a>
<a href="http://bbs.8264.com/forum-109-1.html">江苏</a>
<a href="http://bbs.8264.com/forum-111-1.html">江西</a>
<a href="http://bbs.8264.com/forum-115-1.html">辽宁</a>
<a href="http://bbs.8264.com/forum-170-1.html">内蒙古</a>
<a href="http://bbs.8264.com/forum-143-1.html">宁夏</a>
<a href="http://bbs.8264.com/forum-177-1.html">青海</a>
<a href="http://bbs.8264.com/forum-103-1.html">山东</a>
<a href="http://bbs.8264.com/forum-165-1.html">山西</a>
<a href="http://bbs.8264.com/forum-107-1.html">陕西</a>
<a href="http://bbs.8264.com/forum-48-1.html">上海</a>
<a href="http://bbs.8264.com/forum-102-1.html">四川</a>
<a href="http://bbs.8264.com/forum-100-1.html">天津</a>
<a href="http://bbs.8264.com/forum-171-1.html">新疆</a>
<a href="http://bbs.8264.com/forum-105-1.html">云南</a>
<a href="http://bbs.8264.com/forum-147-1.html">浙江</a>
</dd>
</dl>
<dl class="bg">
<dt>人在驴途</dt>
<dd>
<a href="http://bbs.8264.com/forum-141-1.html">公益爱心</a>
<a href="http://bbs.8264.com/forum-60-1.html">文字和闲聊</a>
<a href="http://bbs.8264.com/forum-409-1.html">户外知识</a>
<a href="http://bbs.8264.com/forum-440-1.html">8264驴友之家住宿</a>
<a href="http://bbs.8264.com/forum-185-1.html">驴行服务</a>
</dd>
</dl>
<dl class="bg">
<dt>管理中心</dt>
<dd>
<a href="http://bbs.8264.com/forum-17-1.html">论坛事务</a>
<a href="http://bbs.8264.com/forum-483-1.html">兑换礼品</a>
<a href="http://bbs.8264.com/forum-43-1.html">版主中心</a>
</dd>
</dl>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
$('.site .xlsj, .nav_t_p_a').hover(function(){
clearTimeout(window.acCtrl);
$(".nav_t_p_a").show();
},function(){
window.acCtrl=setTimeout(function(){
$(".nav_t_p_a").hide();
},300);
});
})
</script>
</div>
</div>
<div id="content">
<div class="main-rect">
<div class="col-main">
<div class="blk-container blk-BGContainer">
<h1 class="art-title"><?php echo $travelShow['subject'];?></h1>
<div class="art-info">
<a href="home.php?mod=space&amp;uid=<?php echo $travelShow['authorid'];?>" class="user-name"><?php echo $travelShow['author'];?></a>
<span class="pub-time"><?php echo date('Y-m-d H:i', $travelShow['dateline']); ?></span>
<?php if($_G['groupid'] ==1) { ?>
<script src="http://static.8264.com/static/js/pushoriginaltobaidu.js" type="text/javascript" type="text/javascript"></script>
<a href="javascript:;" onclick="pushOriginalToBaidu();" style="color:#CC0000;">[推送到百度原创]</a>
<?php } ?>
</div>
<div class="art-attentList">
<div class="attentList-content">
<div class="attentList-inner">
<span class="attent-num"><em><?php echo $threadShow['views'];?></em>人关注</span><?php if(is_array($viewsuids)) foreach($viewsuids as $v) { ?><a href="home.php?mod=space&amp;uid=<?php echo $v;?>"><?php echo avatar($v, small); ?></a>
<?php } ?>
<a href="javascript:void(0);" class="more-link">更多</a>
</div>
</div>
</div>
<div class="art-content"><?php require_once DISCUZ_ROOT.'./source/plugin/articlekeywords/include.php'; ?><?php $articleKeywords = new ArticleKeywords(); ?><?php echo $articleKeywords->parseArticle($message); ?></div>
<div class="art-page">
<?php if($multi) { ?><div class="art-page"><?php echo $multi;?></div><?php } ?>
</div>
</div>
<?php if($nearestList) { ?>
<div class="blk-container-other"><?php if(is_array($nearestList)) foreach($nearestList as $v) { ?><div class="content-aboutArt">
<div class="blk-recomItem">
<a href="<?php echo $v['url'];?>">
<img src="<?php echo $v['pic'];?>" alt="">
<h3><?php echo $v['subject'];?></h3>
</a>
</div>
</div>
<?php } ?>
</div>
<?php } ?>

<!--评论-->
<div class="blk-comment">
<h1 class="blkc-title">网友评论</h1>
<div class="comment-form">
<?php if($_G['uid']) { ?>
<div class="avatar">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>"><?php echo avatar($_G['uid'], small); ?></a>
</div>
<form method="post" autocomplete="off" id="fastpostform" name="fastpostform" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes&amp;infloat=yes" onsubmit="return commentPost(this.id, 'return_fastpost')">
<div class="post-box-cont">
<textarea name="message" id="message" class="comment-notes" placeholder=""></textarea>
<button type="submit" class="btn-comment" id="fastpostsubmit">评论</button>
</div>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="subject" value="" />
<input type="hidden" name="is_readmodel" value="1" />
<input type="hidden" name="handlekey" value="fastpost" />
<div id="return_fastpost" style="display:none;"></div>
</form>
<?php } else { ?>
<div class="avatar">
<a href="javascript:void(0);" style="cursor:auto;"><?php echo avatar($_G['uid'], small); ?></a>
</div>
<div class="post-box-cont">
<div class="hm" style="line-height:68px;">
你需要登录后才可以回帖
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">登录</a>
| <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="showWindow('register', this.href)" class="xi2"><?php echo $_G['setting']['reglinkname'];?></a>
<?php if($_G['setting']['connect']['allow']) { ?>
| <a href="<?php echo $_G['connect']['login_url'];?>&statfrom=viewthread_fastpost" target="_top" rel="nofollow"><img src="<?php echo IMGDIR;?>/qq_login.gif" class="vm" /></a>
<?php } ?>
<button type="submit" class="btn-comment" id="fastpostsubmit">评论</button>
</div>
</div>
<?php } ?>
</div>
<div class="comment-content">
<ul class="comment-navbar-nav">
<li <?php if($travelShow['rcnt']) { ?>class="active"<?php } ?>>推荐评论</li>
<li <?php if(!$travelShow['rcnt']) { ?>class="active"<?php } ?>>全部评论</li>
</ul>
<!--推荐评论-->
<div id="tabs-recommendComment" class="commentContainer"><?php $commentList  = $rList; ?><?php $multiComment = $multiR; ?><?php $page = 1; ?><?php $type = 'rList'; ?><div id="<?php echo $type;?>_<?php echo $page;?>">
<ul class="post-list"><?php if(is_array($commentList)) foreach($commentList as $v) { ?><li class="pl-post">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-avatar"><?php echo avatar($v['authorid'], small); ?></a>							
<div class="pl-post-body">
<div class="pl-post-header">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-user"><?php echo $v['author'];?></a>
<!-- <span class="pl-time"><?php echo $v['dateline'];?></span> -->
<a href="javascript:void(0);" class="pl-btn-reply">回复</a>
</div>
<div class="pl-post-content">
<p><?php echo $v['message'];?></p>
</div>
<!--回复框-->
<form method="post" autocomplete="off" id="replyform_<?php echo $type;?>_<?php echo $v['pid'];?>" name="replyform_<?php echo $type;?>_<?php echo $v['pid'];?>" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $v['pid'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes&amp;infloat=yes" onsubmit="return commentPost(this.id, 'return_fastpost')">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="is_readmodel" value="1" />
<input type="hidden" name="handlekey" value="fastpost" />								
<!--<input type="hidden" value="reply" name="handlekey">-->
<input type="hidden" value="q|<?php echo $v['authorid'];?>|<?php echo $v['author'];?>" name="noticeauthor">
<input type="hidden" value="" name="noticetrimstr">
<input type="hidden" value="<?php echo $v['noticeauthormsg'];?>" name="noticeauthormsg">
<input type="hidden" value="<?php echo $v['pid'];?>" name="reppost">
<div class="pl-reply-box">
<div class="pl-reply-box-content textarea">
<textarea name="message"></textarea>
</div>
<div class="pl-reply-box-footer">
<button type="submit" class="pl-btn-submit" id="fastpostsubmit" style="cursor:pointer;">回复</button>		
</div>
</div>
</form>			
<!--回复框 end-->
</div>
<?php if(!empty($blockquote[$v['pid']])) { ?><?php $temp = $blockquote[$v[pid]]; ?><ul class="pl-post-children">
<li class="pl-post">
<div class="pl-post-body">
<div class="pl-post-header">
<?php echo $temp['message_quote_author'];?>
<!-- <span class="pl-time"><?php echo $temp['message_quote_dateline'];?></span> -->
</div>
<div class="pl-post-content">
<p><?php echo $temp['message_quote_content'];?></p>
</div>
</div>
</li>
</ul>
<?php } ?>
</li>
<?php } ?>
</ul>
<?php if($multiComment) { ?><div class="art-page artComment-page"><?php echo $multiComment;?></div><?php } ?>
</div></div>
<!--推荐评论 end-->
<!--所有评论-->
<div id="tabs-allComments" class="commentContainer" style="display:none;"><?php $commentList  = $cList; ?><?php $multiComment = $multiC; ?><?php $page = 1; ?><?php $type = 'cList'; ?><div id="<?php echo $type;?>_<?php echo $page;?>">
<ul class="post-list"><?php if(is_array($commentList)) foreach($commentList as $v) { ?><li class="pl-post">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-avatar"><?php echo avatar($v['authorid'], small); ?></a>							
<div class="pl-post-body">
<div class="pl-post-header">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-user"><?php echo $v['author'];?></a>
<!-- <span class="pl-time"><?php echo $v['dateline'];?></span> -->
<a href="javascript:void(0);" class="pl-btn-reply">回复</a>
</div>
<div class="pl-post-content">
<p><?php echo $v['message'];?></p>
</div>
<!--回复框-->
<form method="post" autocomplete="off" id="replyform_<?php echo $type;?>_<?php echo $v['pid'];?>" name="replyform_<?php echo $type;?>_<?php echo $v['pid'];?>" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $v['pid'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes&amp;infloat=yes" onsubmit="return commentPost(this.id, 'return_fastpost')">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="is_readmodel" value="1" />
<input type="hidden" name="handlekey" value="fastpost" />								
<!--<input type="hidden" value="reply" name="handlekey">-->
<input type="hidden" value="q|<?php echo $v['authorid'];?>|<?php echo $v['author'];?>" name="noticeauthor">
<input type="hidden" value="" name="noticetrimstr">
<input type="hidden" value="<?php echo $v['noticeauthormsg'];?>" name="noticeauthormsg">
<input type="hidden" value="<?php echo $v['pid'];?>" name="reppost">
<div class="pl-reply-box">
<div class="pl-reply-box-content textarea">
<textarea name="message"></textarea>
</div>
<div class="pl-reply-box-footer">
<button type="submit" class="pl-btn-submit" id="fastpostsubmit" style="cursor:pointer;">回复</button>		
</div>
</div>
</form>			
<!--回复框 end-->
</div>
<?php if(!empty($blockquote[$v['pid']])) { ?><?php $temp = $blockquote[$v[pid]]; ?><ul class="pl-post-children">
<li class="pl-post">
<div class="pl-post-body">
<div class="pl-post-header">
<?php echo $temp['message_quote_author'];?>
<!-- <span class="pl-time"><?php echo $temp['message_quote_dateline'];?></span> -->
</div>
<div class="pl-post-content">
<p><?php echo $temp['message_quote_content'];?></p>
</div>
</div>
</li>
</ul>
<?php } ?>
</li>
<?php } ?>
</ul>
<?php if($multiComment) { ?><div class="art-page artComment-page"><?php echo $multiComment;?></div><?php } ?>
</div></div>
<!--所有评论 end-->
</div>
</div>
<!--评论 end-->

</div>
</div>
<div class="main-extra">
<div class="col-sub">
<?php if($latestList) { ?>
<div class="latest-posts">
<h3 class="sub-title">最新帖子</h3>
<ul><?php if(is_array($latestList)) foreach($latestList as $v) { ?><li>
<a href="<?php echo $v['url'];?>"><?php echo $v['subject'];?></a>
<p class="lp-time"><?php echo $v['dateline'];?></p>
</li>
<?php } ?>
</ul>
</div>
<?php } if($hotList) { ?>
<div class="subImg-list hot-posts">
<h3 class="sub-title">热门帖子</h3>
<ul><?php if(is_array($hotList)) foreach($hotList as $v) { ?><li>
<a href="<?php echo $v['url'];?>" class="targ-img">
<img src="<?php echo $v['pic'];?>" alt="<?php echo $v['subject'];?>">
</a>
<p><a href="<?php echo $v['url'];?>"><?php echo $v['subject'];?></a></p>
</li>
<?php } ?>
</ul>
</div>
<?php } ?>

<!--户外学校广告-->
            <div  style="height: 300px;width:263px;overflow: hidden;background-color: #fff; margin-top: 20px;">
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
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.hotmudidibox{border:#e0e7eb solid 1px; border-bottom:0px; border-right:0px; margin-top:15px; width:262px;}
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
            </div>


</div>
</div>
</div>
<div id="J-share" class="fx-share fx-artShare">
<div class="share-standard">
<div class="" style="position:relative;">
<p class="share-num"><em><?php echo $shareCnt;?></em>分享</p><?php if(is_array($shareuids)) foreach($shareuids as $v) { ?><a href="home.php?mod=space&amp;uid=<?php echo $v;?>"><?php echo avatar($v, small); ?></a>
<?php } ?>
<a href="javascript:void(0);" class="share-link">我要分享</a>
<div style="width:0;height:200px;position:absolute;top:270px;left:60px;overflow:hidden;" id="qrcodediv"><img src="qrcode.php?output=1&amp;url=<?php echo $shareurl;?>&amp;size=9" style="width:200px!important;height:200px!important;"></div>
</div>
</div>
</div>
</div>
<div class="fl-open-wrap" style="display:block">
<div class="fl-open-wrap-cntr" id="appd-wrap-open-cnt"></div>
</div>
<div id="J-popLogin" class="pop-comment-wrap">
<div id="fl-pop-wrap-cntr" class="fl-pop-wrap-cntr fl-art-cntr" style="left:-100%">
<div class="fl-pop-wrap-cntr-bg"></div>
<div class="pcw-content">
<div class="comment-main">
<h1>作者写的很辛苦，随手赏个<em>评论</em>吧！</h1>
<div class="userlist-wrap"><?php if(is_array($commentuids)) foreach($commentuids as $v) { ?><a href="home.php?mod=space&amp;uid=<?php echo $v;?>"><?php echo avatar($v, small); ?></a>
<?php } ?>
<a href="javascript:void(0);" class="more-link">更多</a>
<span class="comment-num"><em><?php echo $travelShow['ccnt'];?></em>人已评</span>
</div>
</div>

<div class="commentLogin-body">
<?php if($_G['uid']) { ?>
<form method="post" autocomplete="off" id="fastpostform1" name="fastpostform1" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes&amp;infloat=yes" onsubmit="return commentPost(this.id, 'return_fastpost')">
<div class="fl-pop-form">
<textarea name="message" id="message" placeholder=""></textarea>
</div>
<button type="submit" class="btn-d-r" id="fastpostsubmit" style="cursor:pointer;">评论</button>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="subject" value="" />
<input type="hidden" name="is_readmodel" value="1" />
<input type="hidden" name="handlekey" value="fastpost" />
</form>
<?php } else { ?>
<div class="fl-pop-form">
<p>你需要登录后才可以评论<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)">登录</a>|<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="showWindow('register', this.href)">注册</a></p>
</div>
<a href="javascript:void(0);" class="btn-d-r">评论</a>
<?php } ?>
</div>
<a href="javascript:void(0);" id="appd_wrap_close" class="pop-close"><span class="close-x">关闭</span></a>

</div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
//顶部导航下拉
$(".headerNav .nav li").hover(function() {
$(this).children("dl").show().end().children('a').css('background', '#344654').end().siblings().each(function(){
$(this).children('dl').hide().end().children('a').removeAttr('style');
});
}, function(){
$(this).children("dl").hide().end().children('a').removeAttr('style');
});
$('.head_login_info>li:not(.notHover)').hover(function(){
// if(timer_showmsg){clearTimeout(timer_showmsg);}
$(this).children('div').slideDown(200).end().children('a').addClass('head_login_icon24_24_zhong').end().siblings().each(function(){
$(this).children('div').stop(true,true).hide().end().children('a').removeClass('head_login_icon24_24_zhong');
});
}, function(){
$(this).children('div').stop(true,true).slideUp(300, function(){
$(this).siblings('a').removeClass('head_login_icon24_24_zhong');
});
});
// 头部搜索框提示
$('#searchText').focus(function(){
$('#searchTips').hide();
}).blur(function(){
if(!$(this).val()) {
$('#searchTips').show();
}
});
});


jQuery(document).ready(function($) {
$(".post-list .pl-bd").hover(function() {
$(this).children().find(".pl-btn-reply").show();
}, function() {
$(this).children().find(".pl-btn-reply").hide();
});

var ie6=!-[1,]&&!window.XMLHttpRequest;
if (!ie6) {
$(window).scroll(function(){
scrollfun();
});
function scrollfun(){
var s_top = $(window).scrollTop();
s_top > 155 ? $("#J-share").css("top", "10px") : $("#J-share").removeAttr("style");
}
}
});

jQuery(function (){
    //图片延时加载
    jQuery(".lazy").lazyload({
    	effect:"fadeIn",
    	appear: function(){
}
    });
    jQuery('.comment-navbar-nav li').click(function(){
    	jQuery(this).siblings().removeClass('active');
    	jQuery(this).addClass('active');
    	var index = jQuery(this).index();
    	var obj   = jQuery('.commentContainer');
    	obj.hide();
    	obj.eq(index).show();
    });
    jQuery(".commentContainer").delegate("a[ajaxtarget=allPage]","click",function(){
    	var href = jQuery(this).attr('href').match(/\d+/g);
    	var page = parseInt(href, 10);
    	var obj = jQuery('#cList_'+page);
    	if (obj.length > 0) {
    		obj.show();
    		obj.siblings().hide();
    		return true;
    	}
    	jQuery.post('forum.php?mod=readmodelarticle&action=incComment&tid=<?php echo $tid;?>&type=cList&page='+page, '', function(data){
    		jQuery('#tabs-allComments').append(data);
    		var obj = jQuery('#cList_'+page);
    		obj.show();
    		obj.siblings().hide();
    		jQuery('.pg a.prev').html('上一页');
    	});
});
jQuery(".commentContainer").delegate("a[ajaxtarget=recommendPage]","click",function(){
    	var href = jQuery(this).attr('href').match(/\d+/g);
    	var page = parseInt(href, 10);
    	var obj = jQuery('#rList_'+page);
    	if (obj.length > 0) {
    		obj.show();
    		obj.siblings().hide();
    		return true;
    	}
    	jQuery.post('forum.php?mod=readmodelarticle&action=incComment&tid=<?php echo $tid;?>&type=rList&page='+page, '', function(data){
    		jQuery('#tabs-recommendComment').append(data);
    		var obj = jQuery('#rList_'+page);
    		obj.show();
    		obj.siblings().hide();
    		jQuery('.pg a.prev').html('上一页');
    	});
});
    jQuery('.pg a.prev').html('上一页');

jQuery(".commentContainer").delegate(".pl-post-body", "mouseenter", function (event) {
    	jQuery(this).children().find(".pl-btn-reply").show();
    }).delegate(".pl-post-body", "mouseleave", function (event) {
      	jQuery(this).children().find(".pl-btn-reply").hide();
    });

jQuery(".commentContainer").delegate(".pl-btn-reply","click",function(){
var uid = '<?php echo $_G['uid'];?>';
uid = parseInt(uid, 10);
if (uid == 0) {
location.href = 'member.php?mod=logging&action=login';
}
jQuery(this).hasClass("open") ? jQuery(this).removeClass("open") + jQuery(this).parents(".pl-post-body").find(".pl-reply-box").hide() : jQuery(this).addClass("open") + jQuery(this).parents(".pl-post-body").find(".pl-reply-box").show();
});

jQuery("#fastpostform").keyup(function(){
var tempobj = jQuery(this).find('#fastpostsubmit');
jQuery(this).find('#message').val() == '' ? tempobj.css({'background-color':'#aeaeae'}) : tempobj.css({'background-color':'#ff8d6a'});
});

jQuery(".share-link").click(function(){
var btnObj = jQuery('.share-link');
var actObj = jQuery('#qrcodediv');
if (btnObj.hasClass('show')) {
actObj.css({'border':'0'});
actObj.animate({
width: "0%"
},300,function(){
btnObj.removeClass('show');
});
} else {
actObj.css({'border':'1px solid #999'});
actObj.animate({
width: "200px"
},300,function(){
btnObj.addClass('show');
});
}
});
$(".mui-tab").hover(function() {
$(".mui-tab-tip", this).addClass('animated shake').show();
}, function() {
$(".mui-tab-tip", this).removeClass('animated shake').hide();
});
$("#gotop").click(function() {
var body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
body.animate({scrollTop: 0}, 80);
});
});
</script>
<script type="text/javascript">
function succeedhandle_fastpost (url, message, values) {
location.reload();
}
function succeedhandle_reply (url, message, values) {
location.reload();
}

function commentPost(id, returnobj) {
var uid = '<?php echo $_G['uid'];?>';
uid = parseInt(uid, 10);
if(jQuery('#'+id+' #message').val() == '' || uid == 0){return false;}
jQuery('#'+id+' #fastpostsubmit').attr('disabled', true);
ajaxpost(id, returnobj);
}
</script></div>
<div class="bottomNav">
<div class="layout">
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
</div>
</div>
<?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
    <div class="crly">
        积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分
    </div>
    <div class="mncr"></div>
    </div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?>
</div>

<?php if(!$_G['setting']['bbclosed']) { ?> <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
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
<?php if(($_G['mod'] == 'viewthread' || $_GET['act'] == 'showview' || $_GET['act'] == 'commentdetail' || $_G['mod'] == 'view' || $_G['mod'] == 'readmodeltravel')) { if($_G['mod'] == 'readmodeltravel' && !empty($placeid)) { ?><?php $_G['tid'] = substr($placeid, -5, 5); } ?>
<script type="text/javascript">
var _gaq = _gaq || [];
<?php if($_G['mod'] == 'view') { ?>
_gaq.push(['tid', '<?php echo $_GET['aid'];?>']);
_gaq.push(['type', '3']);
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
<?php } elseif($_G['mod'] == 'readmodeltravel') { ?>
_gaq.push(['type', '5']);
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