<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('travelread_list', 'common/header_8264_1170_new');
0
|| checktplrefresh('./template/8264/forum/travelread_list.htm', './template/8264/common/header_8264_1170_new.htm', 1509517905, '2', './data/template/2_2_forum_travelread_list.tpl.php', './template/8264', 'forum/travelread_list')
|| checktplrefresh('./template/8264/forum/travelread_list.htm', './template/8264/common/footer_8264_1170_new.htm', 1509517905, '2', './data/template/2_2_forum_travelread_list.tpl.php', './template/8264', 'forum/travelread_list')
|| checktplrefresh('./template/8264/forum/travelread_list.htm', './template/8264/common/header_common.htm', 1509517905, '2', './data/template/2_2_forum_travelread_list.tpl.php', './template/8264', 'forum/travelread_list')
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
<link rel="stylesheet" href="http://static.8264.com/static/css/common/common_head_bottom.css">
<link rel="stylesheet" href="http://static.8264.com/static/css/forum/readmodel.css?v=4.0">
<style type="text/css">
.newswarpten {display:none!important;}
.site a.gt {
    background: rgba(0, 0, 0, 0) url("http://static.8264.com/dianping/images/icon/data/crumb_bg.gif") no-repeat scroll 100% 50%;
    margin-right: 4px;
    padding-right: 12px;
}
</style>
<!--[if IE 6]>
<![endif]-->
<!--[if lt ie 9]>
<style type="text/css">
</style>
<![endif]-->
<!--[if ie 7]>
<style type="text/css">
</style>
<![endif]-->
<div class="header">
<div class="layout">
<style type="text/css">
.dsad{position:absolute;right:230px;top:18px}
</style>
<div class="dsad"><?php echo adshow("custom_290"); ?></div>
<div class="icoHill">山</div>
<style type="text/css">.headerL{position:relative}.travel-notes__button{position:absolute;left:120px;top:12px;width:88px;height:32px;background-color:#ff5e33;box-shadow:0 4px 10px rgba(255, 94, 51, .4);border-radius:16px;text-align:center}.travel-notes__button--primary{display:block;height:100%;line-height:32px;color:#fff!important;font-size:14px;background:url(http://static.8264.com/static/images/jia.png) no-repeat 16px 10px;padding:0 16px 0 30px}</style>
<div class="headerL">
<h5>
<span class="country">
<a href="<?php echo $titleUrl;?>"><?php echo $placename;?>游记攻略</a>
</span>
</h5>
<div class="site">
<a href="http://www.8264.com/" class="gt">首页</a>
 	<a href="<?php echo $allUrl;?>" <?php if($level >= 1) { ?>class="gt"<?php } ?>>游记攻略</a>
 	<?php if($level >= 1&&$areaData['nationShow']['alias']) { ?><a href="<?php echo $areaData['nationShow']['url'];?>" <?php if($level > 1) { ?>class="gt"<?php } ?>><?php echo $areaData['nationShow']['alias'];?></a><?php } ?>
 	<?php if($level >= 2&&$areaData['provinceShow']['alias']) { ?><a href="<?php echo $areaData['provinceShow']['url'];?>" <?php if($level > 2) { ?>class="gt"<?php } ?>><?php echo $areaData['provinceShow']['alias'];?></a><?php } ?>
 	<?php if($level >= 3&&$areaData['cityShow']['alias']) { ?><a href="<?php echo $areaData['cityShow']['url'];?>" <?php if($level > 3) { ?>class="gt"<?php } ?>><?php echo $areaData['cityShow']['alias'];?></a><?php } ?>
 	<?php if($level >= 4&&$areaData['areaShow']['alias']) { ?><a href="<?php echo $areaData['areaShow']['url'];?>" <?php if($level > 4) { ?>class="gt"<?php } ?>><?php echo $areaData['areaShow']['alias'];?></a><?php } ?>
 	<?php if($level >= 5&&$areaData['poiShow']['alias']) { ?><a href="<?php echo $areaData['poiShow']['url'];?>"><?php echo $areaData['poiShow']['alias'];?></a><?php } ?>
</div>
<div class="travel-notes__button">
<a href="http://bbs.8264.com/forum-post-action-newthread-fid-52.html" class="travel-notes__button--primary"><i class="icon-jia"></i>写游记</a>
</div>
</div>
</div>
</div>
<div class="layout w980">
<div class="strgy-list-wrap"><?php if(is_array($travelList)) foreach($travelList as $v) { ?><?php $tempThread = $threadList[$v[tid]]; ?><?php $tempPlace  = $placeList[$v[tid]]; ?><!--一个游记-->
<div class="strgy-item">
<div class="module-face">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" target="_blank"><?php echo avatar($v[authorid], middle); ?></a>
</div>
<div class="module-title">
<h3>
<a href="<?php echo $_G['config']['web']['portal'];?>youji/<?php echo $v['tid'];?>.html" target="_blank"><?php echo $v['subject'];?></a>
</h3>
</div>
<div class="module-line">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" target="_blank" class="user-name"><?php echo $v['author'];?></a>
<!-- <span class="dt-date"><?php echo date('m-d', $tempThread['dateline']);; ?></span> --><?php if(is_array($tempPlace)) foreach($tempPlace as $val) { ?><?php $val[placeid] = ''.$val[placeid]; ?><span class="rg-tags"><a href="<?php echo $val['url'];?>" target="_blank"><?php echo $val['name'];?></a></span>
<?php } ?>
</div>
<div class="module-body">
<p><?php echo $v['summary']['text'];?></p>
</div>
<div class="module-pic"><?php if(is_array($v['summary']['img'])) foreach($v['summary']['img'] as $val) { ?><a href="<?php echo $_G['config']['web']['portal'];?>youji/<?php echo $v['tid'];?>.html" target="_blank" class="pic-item">

<img src="<?php echo $val;?><?php if(strpos($val, 'image1.8264.com') !== false) { ?>!t2w400h300<?php } ?>">
</a>
<?php } ?>
</div>
<div class="module-attent">
<div class="art-attentList">
<div class="attentList-content">
<div class="attentList-inner">
<span class="attent-num"><em><?php echo $tempThread['views'];?></em>人关注</span><?php if(is_array($v['viewsuids'])) foreach($v['viewsuids'] as $val) { ?><a href="home.php?mod=space&amp;uid=<?php echo $val;?>" target="_blank" class="avatar-img"><?php echo avatar($val, small); ?></a>
<?php } ?>
<a href="javascript:void(0);" class="more-link" style="cursor:auto;">更多</a>
</div>
</div>
</div>
</div>
</div>
<!--一个游记 end-->
<?php } ?>
</div>
<div class="strgy-page">
<?php if($multi) { ?><?php echo $multi;?><?php } ?>
</div>
</div>

<div id="J-MuiCatebar" class="mui-mbar-outer">
<div class="close-menu">
<a href="javascript:void(0);" class="close-button">展开</a>
</div>
<div class="mui-mbar-standard">
<div class="mui-mbar-tab mui-mbar-tab-hot">
<div class="mui-mbar-tab-title">热门旅行地<a href="<?php echo $allUrl;?>" title="查看全部热门旅行地" class="all-link">全部</a></div>
<ul class="card-label-list"><?php if(is_array($hotList)) foreach($hotList as $v) { ?><li>
<h3 class="art-tit"><a href="<?php echo $v['url'];?>"><?php echo $v['name'];?></a></h3>
<p class="art-count"><?php echo $v['actnum'];?>篇</p>
<span class="pipe-line"></span>
<div class="usr-list"><?php if(is_array($v['viewsuids'])) foreach($v['viewsuids'] as $val) { ?><a href="home.php?mod=space&amp;uid=<?php echo $val;?>" target="_blank"><?php echo avatar($val, small); ?></a>
<?php } ?>
</div>
</li>
<?php } ?>
</ul>
</div>
<div class="mui-mbar-tab mui-mbar-tab-domestic">
<div class="mui-mbar-tab-title">国内旅行地</div>
<div class="label-list"><?php if(is_array($domesticList)) foreach($domesticList as $v) { ?><a href="<?php echo $v['url'];?>" <?php if($placeid==$v['placeid'] && $level==$v['level']) { ?>class="active"<?php } ?>><?php echo $v['name'];?></a>
<?php } ?>
</div>
</div>
<div class="mui-mbar-tab mui-mbar-tab-abroad">
<div class="mui-mbar-tab-title">国外旅行地</div>
<div class="label-list"><?php if(is_array($abroadList)) foreach($abroadList as $v) { ?><a href="<?php echo $v['url'];?>" <?php if($placeid==$v['placeid'] && $level==$v['level']) { ?>class="active"<?php } ?>><?php echo $v['name'];?></a>
<?php } ?>
</div>
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
$('.module-pic .pic-item').each(function(index, el) {
var img_src = $(this).find('img').attr("src").indexOf("!t2w400h300");
var img_h = $(this).find('img').height();
if(img_src<0){
$(this).find('img').css({
"margin-top": -(img_h/2),
"position": "relative",
"top": "50%"
});
}
});
});

jQuery(document).ready(function($) {
$("#J-MuiCatebar").mouseover(function() {
$(this).find(".close-button").html("收起").end().css("right", "0");
}).mouseleave(function() {
$(this).find(".close-button").html("展开").end().css("right", "-452px");
});
});
jQuery(function(){
var ua = navigator.userAgent.toLowerCase();
var isIE6 = ua.indexOf('msie 6.0') > -1;
if(!isIE6){
var wh = jQuery(window).height();
var ch = jQuery('.strgy-list-wrap').height();
var calch = wh - 195 - ch;
if(ch < (wh-195)){
jQuery('.strgy-list-wrap').css("margin-bottom", calch);
}
}
});
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