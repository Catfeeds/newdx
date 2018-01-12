<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread_portal', 'common/header');
0
|| checktplrefresh('./template/default/forum/viewthread_portal.htm', './template/8264/common/header.htm', 1509007557, 'diy', './data/template/2_diy_forum_viewthread_portal.tpl.php', './template/8264', 'forum/viewthread_portal')
|| checktplrefresh('./template/default/forum/viewthread_portal.htm', './template/default/common/simplesearchform.htm', 1509007557, 'diy', './data/template/2_diy_forum_viewthread_portal.tpl.php', './template/8264', 'forum/viewthread_portal')
|| checktplrefresh('./template/default/forum/viewthread_portal.htm', './template/8264/forum/viewthread_node_body_2014.htm', 1509007557, 'diy', './data/template/2_diy_forum_viewthread_portal.tpl.php', './template/8264', 'forum/viewthread_portal')
|| checktplrefresh('./template/default/forum/viewthread_portal.htm', './template/default/forum/viewthread_from_node.htm', 1509007557, 'diy', './data/template/2_diy_forum_viewthread_portal.tpl.php', './template/8264', 'forum/viewthread_portal')
|| checktplrefresh('./template/default/forum/viewthread_portal.htm', './template/8264/forum/viewthread_fastpost_2014.htm', 1509007557, 'diy', './data/template/2_diy_forum_viewthread_portal.tpl.php', './template/8264', 'forum/viewthread_portal')
|| checktplrefresh('./template/default/forum/viewthread_portal.htm', './template/8264/common/footer.htm', 1509007557, 'diy', './data/template/2_diy_forum_viewthread_portal.tpl.php', './template/8264', 'forum/viewthread_portal')
|| checktplrefresh('./template/default/forum/viewthread_portal.htm', './template/8264/common/header_common.htm', 1509007557, 'diy', './data/template/2_diy_forum_viewthread_portal.tpl.php', './template/8264', 'forum/viewthread_portal')
|| checktplrefresh('./template/default/forum/viewthread_portal.htm', './template/8264/forum/viewthread_node_body_2014.htm', 1509007557, 'diy', './data/template/2_diy_forum_viewthread_portal.tpl.php', './template/8264', 'forum/viewthread_portal')
|| checktplrefresh('./template/default/forum/viewthread_portal.htm', './template/8264/common/seditor_new_2014.htm', 1509007557, 'diy', './data/template/2_diy_forum_viewthread_portal.tpl.php', './template/8264', 'forum/viewthread_portal')
;?>
<?php $specialarr = array(0 => array('thread', '帖子'), 1 => array('poll', '投票'), 2 => array('trade', '商品'), 3 => array('reward', '悬赏'), 4 => array('activity', '活动'), 5 => array('debate', '辩论'));
$specialtype = $specialarr[$_G['forum_thread']['special']];
$_G[home_tpl_titles][] = $navsubject;
$_G[home_tpl_titles][] = $specialtype[1];
$_G[home_tpl_titles][] = '门户'; ?><!doctype html>
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
<?php if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?><?php echo $rsshead;?><?php } if($_G['basescript'] == 'forum') { if($_G['basescript'] == 'forum' && ($_G['uid'] && (empty($_G['cookie']['widthauto']) || $_G['cookie']['widthauto']==1)) && empty($_G['disabledwidthauto'])) { ?>
<link rel="stylesheet" id="css_widthauto" type="text/css" href="http://static.8264.com/static/css/common/widthauto.css?<?php echo VERHASH;?>" />
<?php } ?>
<script src="http://static.8264.com/static/js/forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="http://static.8264.com/static/js/home.js?<?php echo VERHASH;?>" type="text/javascript" ></script>

<?php } elseif($_G['basescript'] == 'portal') { ?>
<script src="http://static.8264.com/static/js/portal.js?<?php echo VERHASH;?>" type="text/javascript" ></script>
<?php } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<script src="http://static.8264.com/static/js/portal.js?<?php echo VERHASH;?>" type="text/javascript" ></script>
<?php } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/css_diy.css?<?php echo VERHASH;?>" />
<?php } ?><?php $user_IP = ($_SERVER["HTTP_CDN_SRC_IP"]); ?><style type="text/css">
a.keyword{color:#000 !important; text-decoration:none;}
</style>
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
<?php } else { ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?49299785f8cc72bacc96c9a5109227da";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
<?php } ?>
</head>



<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="http://static.8264.com/static/image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?>    <?php if($_G['setting']['mobile']['allowmobile'] && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')) { ?>
    	<div class="xi1 bm bm_c">
            您现在使用手机浏览器 - <a href="<?php echo $_G['siteurl'];?>forum.php?mobile=yes">进入手机版</a> <span class="xg1">|</span> <a href="<?php echo $_G['setting']['mobile']['nomobileurl'];?>">继续访问不再提示</a>
        </div>
<?php } if((($_GET['tid']=='1372056'||$_G['tid']=='1372056') && $_GET['auto']==2 && empty($_G['uid']))) { ?>
   <script type="text/javascript">
widthauto(1);
changimgwidth();
   </script>
<?php } ?>
    <div class="topnav cl">
<p class="y navinf">
<?php if($_G['uid']) { ?>
<strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="vwmy"<?php if($_G['setting']['connect']['allow'] && $_G['member']['conisbind']) { ?> style="background:url(http://static.8264.com/static/image/common/connect_qq.gif) no-repeat scroll 0 0px;padding-left:20px"<?php } ?> target="_blank" title="访问我的空间"><?php echo $_G['member']['username'];?></a></strong>

<?php if($_G['group']['allowinvisible']) { ?><span id="loginstatus" class="xg1"><a href="http://u.8264.com/member.php?mod=switchstatus" title="切换在线状态" onClick="ajaxget(this.href, 'loginstatus');doane(event);"><?php if($_G['session']['invisible']) { ?>隐身<?php } else { ?>在线<?php } ?></a></span><?php } ?>
                <?php if($_G['setting']['taskon']) { ?>
<span class="pipe">|</span>
<?php if(empty($_G['cookie']['taskdoing_'.$_G['uid']])) { ?>
<a href="home.php?mod=task&amp;item=new">任务</a>
<?php } else { ?>
<a href="home.php?mod=task&amp;item=doing" id="task_ntc" class="new">进行中的任务</a>
<?php } } ?><span class="pipe">|</span><a href="home.php?mod=space&amp;do=friend">好友</a> <?php if($_G['setting']['regstatus'] > 1) { ?><a href="home.php?mod=spacecp&amp;ac=invite" class="xg1">邀请</a> <?php } ?>

<span class="pipe">|</span><span id="usersetup" class="xg1 showmenu" onMouseOver="showMenu(this.id);"><a href="home.php?mod=spacecp">设置</a></span>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1']; ?>
<span style="display:none;"><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1']; ?></span>
<span class="pipe">|</span><a href="http://u.8264.com/home.php?mod=space&amp;do=notice" id="myprompt"<?php if($_G['member']['newprompt']) { ?> class="new"<?php } ?>>提醒<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?></a><span id="myprompt_check"></span>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=notice&amp;type=smessage" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>短消息<?php if($_G['member']['newpm']) { ?>(<?php echo $_G['member']['newpm'];?>)<?php } ?></a>
<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?><span class="pipe">|</span><a href="portal.php?mod=portalcp">门户管理</a><?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?><span class="pipe">|</span><a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a><?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?><span class="pipe">|</span><a href="admin.php" target="_blank">管理中心</a><?php } ?>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php if(!$_G['cookie']['forcewidthauto']) { ?>
<span class="pipe">|</span><a id="wh" href="javascript:;" onClick="widthauto(this)"><?php if($_G['cookie']['widthauto']==2 || !$_G['uid']) { ?>切换到宽版<?php } else { ?>切换到窄版<?php } ?></a>
<?php } } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<strong><a id="loginuser"><?php echo $_G['cookie']['loginuser'];?></a></strong>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">激活</a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } else { if($_G['setting']['connect']['allow']) { ?>
<span class="pipe">|</span>
<?php } ?>
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href);hideWindow('login');"><?php echo $_G['setting']['reglinkname'];?></a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">登录</a>
<?php } ?>
</p>

<ul class="cl">
<li class="navlogo" style="border:none;"><a href="<?php echo $_G['setting']['siteurl'];?>" style="border:none;" title="<?php echo $_G['setting']['bbname'];?>"><?php echo $_G['setting']['bbname'];?></a></li>

</ul>
</div>

  	<div id="hd">
<div class="wp">
<div class="hdc cl">
<h2><a href="<?php echo $_G['setting']['siteurl'];?>" title="<?php echo $_G['setting']['bbname'];?>"><img src="http://static.8264.com/static/image/common/logo.gif" alt="8264" border="0" /></a></h2>
                <!--//论坛头部广告//-->
                <?php if($_G['basescript'] == 'forum' && $_GET['mod'] != 'viewthread') { if($_G['fid']) { ?>
<div id="hdggs">
<?php if(isset($forumOption) && $forumOption->getHeaderAd() != '') { ?><?php echo $forumOption->getHeaderAd(); } else { } ?>
<div style="clear:both;"></div>
                </div>
<?php } else { ?>
 <div id="hdggs">
<div style="width:190px; height:60px;float:left;"><?php echo adshow("custom_68"); ?></div>
<div style="width:460px; height:60px;float:right;margin-right:10px;"><?php echo adshow("custom_214"); ?></div>
                </div>
<?php } ?>
                <?php } elseif($_G['basescript'] == 'forum' && $_GET['mod'] == 'viewthread') { ?>
                <div id="hdggs">
<?php if(isset($forumOption) && $forumOption->getHeaderAd() != '') { ?><?php echo $forumOption->getHeaderAd(); } else { ?>
<div style="float:right;">

</div>
<?php } ?>
                </div>
                <?php } elseif($_G['basescript'] == 'home' && $_GET['mod'] == 'space' && $_GET['do'] == 'activity') { ?>
                <div id="hdggs">
                    <?php echo adshow("custom_20"); ?>                </div>
                <?php } elseif($_G['basescript'] == 'home' && $_GET['mod'] == 'space' && $_GET['do'] == 'notice') { ?>
                <div id="hdggs">
                    
                </div>
                <?php } elseif($_G['basescript'] == 'home' && ($_G['PHP_SELF'] == "/index.php"||$_GET['view'] == "we")) { ?>
                <div id="hdggs">
<div style="width: 700px;float: right;">
<?php if(($_G['PHP_SELF'] == "/index.php")) { ?>
<div style="float: right;">

</div>
<?php } if(($_GET['view'] == "we"&&$_G['PHP_SELF'] != "/index.php")) { ?>
<div style="float: right;width:300px;height:60px;">
</div>
<?php } ?>
<div style=" width:220px; height:60px; float:right; line-height:1.6; margin-right:10px;">				    
</div>
</div>
                </div>
                <?php } elseif($_G['basescript'] == 'home' && $_G['PHP_SELF'] == "/home.php") { ?>
                <div id="hdggs">
                    
                </div>
                <?php } elseif($_G['basescript'] == 'group') { ?>
                <div id="hdggs">
                    <?php echo adshow("custom_31"); ?>                </div>
                <?php } elseif($_G['basescript'] == 'plugin' && substr($_G['gp_id'], 0, 11) == 'searchindex') { ?>
                <div id="hdggs">
                    <?php echo adshow("custom_33"); ?>                </div>
                <?php } if($_G['basescript'] == 'portal' && $_GET['catid']=='874') { ?>

                <div style="width:690px; float:right;">
                <div style=" width:220px; height:60px; float:left; line-height:1.6; padding-top:10px;">
                <b style="color:#F00;">今日团购：</b>
                <?php echo adshow("custom_129"); ?>                </div>
                <div style=" width:468px; float:right;"><?php echo adshow("custom_130"); ?></div>
                <div style="clear:both;"></div>
                </div>

<?php } ?>
            </div>
<div id="qmenu_menu" class="p_pop" style="display: none; zoom: 1;">
<?php if($_G['uid']) { ?>
<ul><?php if(is_array($_G['setting']['mynavs'])) foreach($_G['setting']['mynavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
<li><?php echo $nav['code'];?></li>
<?php } } ?>
</ul>
<?php if($_G['uid'] && !empty($_G['style']['extstyle'])) { ?>
<div class="sslct cl">
<span class="sslct_btn" onClick="extstyle('')" title="默认"><i>&nbsp;</i></span><?php if(is_array($_G['style']['extstyle'])) foreach($_G['style']['extstyle'] as $extstyle) { ?><span class="sslct_btn" onClick="extstyle('<?php echo $extstyle['0'];?>')" title="<?php echo $extstyle['1'];?>"><i style='background:<?php echo $extstyle['2'];?>'>&nbsp;</i></span>
<?php } ?>
</div>
<?php } } else { ?>
<p class="reg_tip">
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href)" class="xi2">注册新用户，开通自己的个人中心</a>
</p>
<?php } ?>
</div>

<div id="nv">
<a href="home.php" id="qmenu" onMouseOver="showMenu(this.id)">我的中心</a>
<ul><?php $mnid = getcurrentnav(); ?>                    <?php if($_G['fid']==52||$_G['fid']==392||$_G['fid']==433||preg_match('/whither:\w+/i', $_G['gp_id'])) { ?>
                    <?php $mnid = 'mn_Nda15'; ?>                    <?php } if(in_array($_G['basescript'], array('misc', 'group'))) { ?><?php $mnid = 'mn_home'; } ?>

                    <?php if($mnid=='mn_group') { ?>
                    <?php $mnid = 'mn_home'; ?>                    <?php } ?>

                    <?php if($_G['fid']==408) { ?>
                    <?php $mnid = 'mn_N1245'; ?>                    <?php } ?>

                    <?php if($_GET['do']=='activity' && $mnid=='mn_home') { ?>
                    <?php $mnid = 'mn_Nda15'; ?>                    <?php } ?>

                    <?php if($_G['catid']==874) { ?>
                    <?php $mnid='mn_forum'; ?>                    <?php } ?>

                    <style type="text/css">
#nv a { float: left; height: 33px;padding: 0; }
#nv a b {padding:0 20px;}
#nv a { color: <?php echo MENUTEXT;?>; }
#nv a:hover { text-decoration:none; }
#nv li span { display: none; }
#nv li.a { margin-left: -1px; <?php echo MENUHOVERBGCODE;?>;background: url("http://static.8264.com/static/image/common/bbs_nav_act_l.jpg") no-repeat; padding-right:0;}
#nv li.a b {background: url(http://static.8264.com/static/image/common/bbs_nav_act_r.jpg) no-repeat right top;height:33px;display:block;float:left;}
#nv li.a a { color: #333; }
</style><?php if(is_array($_G['setting']['navs'])) foreach($_G['setting']['navs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
                        <?php $nav['nav'] = preg_replace('/(<a[^>]+>)([^<]+)/i', '\1<b>\2</b>', $nav['nav']); if($mnid==$nav['navid']) { ?><?php $nav['nav'] = preg_replace('/ onmouseover="[^"]+"/i', '', $nav['nav']); } ?>
                        <li <?php if($mnid == $nav['navid']) { ?>class="a"<?php } ?><?php echo $nav['nav'];?>></li><?php } } ?>
</ul>
</div>
<?php if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
<ul class="p_pop h_pop" id="plugin_menu" style="display: none"><?php if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { ?> <?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
 <li><?php echo $module['url'];?></li>
 <?php } } ?>
</ul>
<?php } ?>


<?php echo $_G['setting']['menunavs'];?>

            <?php preg_match('/<ul[^>]+?id="'.$mnid.'_menu"[^>]+>(.+?)<\/ul>/i', $_G[setting][menunavs], $m); ?>            <?php $_G['setting']['subnavs'][$mnid] = $m[1]; ?>            <?php $_G['setting']['navsubhover'] = 1; ?><div id="mu" class="cl">
<?php if($_G['setting']['subnavs']) { if(is_array($_G['setting']['subnavs'])) foreach($_G['setting']['subnavs'] as $navid => $subnav) { if($_G['setting']['navsubhover'] || $mnid == $navid) { ?>
<ul class="cl <?php if($mnid == $navid) { ?>current<?php } ?>" id="snav_<?php echo $navid;?>" style="display:<?php if($mnid != $navid) { ?>none<?php } ?>">
<?php echo $subnav;?>
</ul>
<?php } } } ?>
</div><?php echo adshow("subnavbanner/a_mu"); ?></div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>

<div id="wp" class="wp">
<script type="text/javascript">var fid = parseInt('<?php echo $_G['fid'];?>'), tid = parseInt('<?php echo $_G['tid'];?>');</script>
<?php if($_G['forum']['ismoderator']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<form method="post" autocomplete="off" name="modactions" id="modactions">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="optgroup" />
<input type="hidden" name="operation" />
<input type="hidden" name="listextra" value="<?php echo $_G['gp_extra'];?>" />
</form>
<?php } ?>

<script src="<?php echo $_G['setting']['jspath'];?>forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">zoomstatus = parseInt(<?php echo $_G['setting']['zoomstatus'];?>);var imagemaxwidth = '<?php echo IMAGEMAXWIDTH;?>';var aimgcount = new Array();</script>

<div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="搜索本版">搜索本版</label></li>
EOF;
?><?php } if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><input type="radio" id="mod_article" class="pr" name="mod" value="portal"
EOF;
 if(CURSCRIPT == 'portal') { 
$slist[portal] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[portal] .= <<<EOF
 /><label for="mod_article" title="搜索文章">文章</label></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><input type="radio" id="mod_thread" class="pr" name="mod" value="forum"
EOF;
 if(CURSCRIPT == 'forum' && !$_G['fid']) { 
$slist[forum] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[forum] .= <<<EOF
 /><label for="mod_thread" title="搜索{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
EOF;
?><?php } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><input type="radio" id="mod_blog" class="pr" name="mod" value="blog"
EOF;
 if(CURSCRIPT == 'home' && $do != 'album') { 
$slist[blog] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[blog] .= <<<EOF
 /><label for="mod_blog" title="搜索日志">日志</label></li>
EOF;
?><?php } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><input type="radio" id="mod_album" class="pr" name="mod" value="album"
EOF;
 if(CURSCRIPT == 'home' && $do == 'album') { 
$slist[album] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[album] .= <<<EOF
 /><label for="mod_album" title="搜索相册">相册</label></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><input type="radio" id="mod_group" class="pr" name="mod" value="group"
EOF;
 if(CURSCRIPT == 'group' || $_G['basescript']=='group') { 
$slist[group] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[group] .= <<<EOF
 /><label for="mod_group" title="搜索{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="搜索用户">用户</label></li>
EOF;
?>
<?php if($slist) { ?>
<div id="sc" class="y">
<form id="scform" method="post" autocomplete="off" onsubmit="searchFocus($('srchtxt'))" action="<?php echo $_G['siteurl'];?>search.php?searchsubmit=yes" target="_blank">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<table cellspacing="0" cellpadding="0">
<tr>
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">搜索</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="请输入搜索内容" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">搜索</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?><div class="z">
<a href="./" id="fjump"<?php if($_G['setting']['forumjump'] == 1) { ?> onmouseover="showMenu({'ctrlid':this.id})"<?php } ?> class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <?php echo $navigation;?> <em>&rsaquo;</em> 查看主题
</div>
</div>

<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm vw pl">
<div class="h">
<h1 class="ph hm"><?php echo $_G['forum_thread']['subject'];?></h1>
<p class="xg1">
发布者:
<?php if($_G['forum_thread']['author'] && $_G['forum_thread']['authorid']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $_G['forum_thread']['authorid'];?>"><?php echo $_G['forum_thread']['author'];?></a>
<?php } else { if($_G['forum']['ismoderator']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $_G['forum_thread']['authorid'];?>">匿名</a>
<?php } else { ?>
匿名
<?php } } ?>
<span class="pipe">|</span>
发布时间: <?php echo dgmdate($_G[forum_thread][dateline]); ?><span class="pipe">|</span>
查看数: <?php echo $_G['forum_thread']['views'];?><span class="pipe">|</span>
评论数: <?php echo $_G['forum_thread']['replies'];?>
<?php if($_G['group']['raterange'] && $post['authorid']) { ?>
<span class="pipe">|</span><a href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&from=<?php echo $_G['gp_from'];?><?php } ?>');return false;">评分</a>
<?php } if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] < $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>
<span class="pipe">|</span><a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_G['gp_modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<?php } else { ?>编辑</a><?php } } if($_G['uid'] && $_G['uid'] == $_G['forum_thread']['authorid']) { ?>
<span class="pipe">|</span><a href="misc.php?mod=invite&amp;action=thread&amp;id=<?php echo $_G['tid'];?>" class="xg1" onclick="showWindow('invite', this.href, 'get', 0);">邀请</a>
<?php } ?>
<span class="pipe">|</span><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>" class="xg1">帖子模式</a>
</p>
</div>
<?php if(empty($_G['gp_page']) || $_G['gp_page'] < 2) { ?>
<div class="d">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><div class="bjcon_new">
<?php if($post['warned']) { ?>
<span class="y"><a href="forum.php?mod=misc&amp;action=viewwarning&amp;tid=<?php echo $_G['tid'];?>&amp;uid=<?php echo $post['authorid'];?>" title="受到警告" onclick="showWindow('viewwarning', this.href)"><img src="http://static.8264.com/static/image/common/warning.gif" alt="受到警告" /></a></span>
<?php } if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽</em></div>
<?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽</em></div>
<?php } elseif($needhiddenreply) { ?>
<div class="locked">此帖仅作者可见</div>
<?php } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop'][$postcount]; if($_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽，只有管理员可见</em></div>
<?php } elseif($post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽，只有管理员可见</em></div>
<?php } if($post['first']) { if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
<div class="locked">
<em class="y"><a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" onclick="showWindow('pay', this.href)">记录</a></em>
付费主题, 价格: <strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?> </strong>
</div>
<?php } if($threadsort && $threadsortshow) { if($threadsortshow['typetemplate']) { ?>
<?php echo $threadsortshow['typetemplate'];?>
<?php } elseif($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
<div class="typeoption">
<?php if($threadsortshow['optionlist'] == 'expire') { ?>
该信息已经过期
<?php } else { ?>
<table summary="分类信息" cellpadding="0" cellspacing="0" class="cgtl mbm">
<caption><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></caption>
<tbody><?php if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { if($option['type'] != 'info') { ?>
<tr>
<th><?php echo $option['title'];?>:</th>
<td><?php if($option['value']) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?>-<?php } ?></td>
</tr>
<?php } } ?>
</tbody>
</table>
<?php } ?>
</div>
<?php } } } ?>

<div class="t_fsz_new <?php if(!$_G['forum_thread']['special']) { } else { } ?>">
<?php if($post['first']) { if(!$_G['forum_thread']['special']) { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } elseif($_G['forum_thread']['special'] == 1) { include template('forum/viewthread_poll'); } elseif($_G['forum_thread']['special'] == 2) { include template('forum/viewthread_trade'); } elseif($_G['forum_thread']['special'] == 3) { include template('forum/viewthread_reward'); } elseif($_G['forum_thread']['special'] == 4) { include template('forum/viewthread_activity'); } elseif($_G['forum_thread']['special'] == 5) { include template('forum/viewthread_debate'); } elseif($threadplughtml) { ?>
<?php echo $threadplughtml;?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } } else { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } if($post['attachment']) { ?>
<div class="locked">附件: <em><?php if($_G['uid']) { ?>你所在的用户组无法下载或查看附件<?php } else { ?>你需要<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);return false;">登录</a>才可以下载或查看附件。没有账号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="注册账号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em></div>
<?php } elseif(($post['imagelist'] || $post['attachlist'])) { if(!($post['first'] && $_G['forum_thread']['special'] == 4)) { ?>
<div class="pattl">
zxZX
<?php if($post['imagelist']) { ?>
<?php echo $post['imagelist'];?>
<?php } if($post['attachlist']) { ?>
<?php echo $post['attachlist'];?>
<?php } ?>
</div>
<?php } } ?>
</div>

<?php if($post['first'] && $sticklist) { ?>
<div>
<h3 class="psth xs1">回帖推荐</h3><?php if(is_array($sticklist)) foreach($sticklist as $rpost) { ?><div class="pstl xs1">
<div class="psta" style='z-index:1;position:absolute'><a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" c="1" rel="nofollow"><?php echo $rpost['avatar'];?></a></div>
<div class="psti">
<p>
<a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" class="xi2 xw1" rel="nofollow"><?php echo $rpost['author'];?></a>
                        发表于<?php echo $rpost['position'];?>楼
<span class="xi2">
&nbsp;<a href="javascript:;" onclick="window.open('forum.php?mod=redirect&goto=findpost&ptid=<?php echo $rpost['tid'];?>&pid=<?php echo $rpost['pid'];?>')" class="xi2">查看完整内容</a>
<?php if($_G['group']['allowstickreply']) { ?>&nbsp;<a href="javascript:;" onclick="modaction('stickreply', <?php echo $rpost['pid'];?>, '&undo=yes')" class="xi2">解除置顶</a><?php } ?>
</span>
</p>
<div class="mtn"><?php echo $rpost['message'];?></div>
</div>
</div>
<?php } ?>
</div>
<?php } if($post['number']==1 && $_G['uid'] && 1!=1) { ?>
<!-- 波总要求取消1楼快速回复，如后面需要再恢复，去掉上面条件 && 1!=1 -->
<form method="post" autocomplete="off" id="fastreplyform" onsubmit="$('fastreplysubmit').disabled=true;jQuery('#fastreplymessage').focus();ajaxpost('fastreplyform', 'return_fastreply', 'return_fastreply', 'onerror', 'fastreplysubmit', fastreply_refun);return false;" action="forum.php?mod=post&amp;infloat=yes&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;replysubmit=yes">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" fwin="reply">
<input type="hidden" name="handlekey" value="reply">
<input type="hidden" name="noticeauthor" value="q|<?php echo $post['authorid'];?>|<?php echo $post['author'];?>">
<input type="hidden" name="noticetrimstr" value="<?php echo $fastreply_noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $fastreply_noticeauthormsg;?>" />
<input type="hidden" name="reppost" value="<?php echo $post['pid'];?>">

<div class="lchf">
<div id="return_fastreply"></div>
<div style="overflow: hidden; height: 100px;">
<textarea name="message" class="t_note" id="fastreplymessage">楼主说的太精彩了，快来点评一下！</textarea>
<div class="areatext" id="fastreply-message-hidden" contenteditable="true"></div>
<div id="fastreply-atlist"></div>
</div>
<div class="lcksfu clboth">
<span class="lcksfu_l" id="fastreply_btnbox">
<button class="lcksfubotton" value="true" name="replysubmit" id="fastreplysubmit" type="submit"></button>
<!-- 手机绑定提示 -->
<?php if(!$_G['member']['telstatus']) { ?>
<style type="text/css">.tips-binding__inside{float:left;background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:4px 0 0 10px;font-size:14px;color:#585858}.tips-binding__inside a{color:#ff7038;font-size:14px}.tips-binding__inside a:hover{color:#ff7038;font-size:14px}</style>
<span class="tips-binding__inside">注：回帖操作需绑定手机，<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">去绑定>></a></span>
<?php } ?>
<!-- //手机绑定提示 -->
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="<classname>"><sec><i id="sec<hash>_menu" class="yzmimg" style="display:none"><sec></i></span>
EOF;
?>
<div class="twyzm clboth fastreplysec"><?php include template('common/seccheck'); ?></div>
<?php } ?>
</span>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;repquote=<?php echo $post['pid'];?>" onclick="switchAdvanceMode(this.href);doane(event);" class="lcksfu_r">高级模式</a>
</div>
</div>
</form>
<script type="text/javascript">
jQuery("#fastreplymessage").focus(function(){
if(jQuery(this).attr('class')=='t_note'){
jQuery(this).removeClass('t_note');
jQuery(this).val('');
}
});
function fastreply_refun(){
jQuery('#fastreplymessage').val('');
$('fastreplysubmit').disabled=false;
var body=(window.opera) ? (document.compatMode == "CSS1Compat" ? jQuery('html') : jQuery('body')) : jQuery('html,body');
if(jQuery('#return_fastreply').html().indexOf('succeed')>-1){
body.animate({scrollTop:jQuery('#comment_<?php echo $post['pid'];?>').position().top-100},0);
}
}
</script>
<?php } if(!empty($post['ratelog'])) { ?>
<div class="clboth mt16" id="ratelog_<?php echo $post['pid'];?>">
<?php if(!$_G['setting']['ratelogon']) { ?>
<div class="pftitle clboth">
<span class="pficon16_16"></span>
<span class="pfnum"><?php echo count($postlist[$post['pid']]['totalrate']);; ?>人</span>
<span class="pfzi">评分</span>
<span class="pficon6_11"></span>
<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)">查看全部评分</a>
</div>
<?php } ?>
<div id="post_rate_<?php echo $post['pid'];?>"></div>
<?php if($_G['setting']['ratelogon']) { ?>
<table class="ratl">
<tr>
<th class="xw1" width="120"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分">已有 <span class="xi1"><?php echo count($postlist[$post['pid']]['totalrate']);; ?></span> 人评分</a></th><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { ?><th width="50"><i><?php echo $_G['setting']['extcredits'][$id]['title'];?></i></th>
<?php } ?>
<th>
<a href="javascript:;" onclick="toggleRatelogCollapse('ratelog_<?php echo $post['pid'];?>', this);" class="y xi2 op"><?php if(!empty($_G['cookie']['ratecollapse'])) { ?>展开<?php } else { ?>收起<?php } ?></a>
<i>理由</i>
</th>
</tr>
<tbody class="ratl_l"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><tr id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>">
<td>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a> <a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" rel="nofollow"><?php echo $ratelog['username'];?></a>
</td><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($ratelog['score'][$id] > 0) { ?>
<td class="xi1"> + <?php echo $ratelog['score'][$id];?></td>
<?php } else { ?>
<td class="xg1"><?php echo $ratelog['score'][$id];?></td>
<?php } } ?>
<td class="xg1"><?php echo $ratelog['reason'];?></td>
</tr>
<?php } ?>
</tbody>
</table>
<p class="ratc">
总评分:&nbsp;<?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($score > 0) { ?>
<span class="xi1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?></span>&nbsp;
<?php } else { ?>
<span class="xg1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?></span>&nbsp;
<?php } } ?>
&nbsp;<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分" class="xi2">查看全部评分</a>
</p>
<?php } else { ?>
<div class="clboth">
<ul class="pftoulist clboth"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><li>
<div id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>_menu" class="attp" style="display: none;">
<p class="crly"><?php echo $ratelog['reason'];?> &nbsp;&nbsp;<?php if(is_array($ratelog['score'])) foreach($ratelog['score'] as $id => $score) { if($score > 0) { ?>
<em><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></em>
<?php } else { ?>
<span><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></span>
<?php } } ?>
</p>
<p class="mncr"></p>
</div>
<p id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="tx"><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a></p>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" class="name" rel="nofollow"><?php echo $ratelog['username'];?></a>
</li>
<?php } ?>
<div style="clear:both;"></div>
</ul>
</div>
<?php } ?>
</div>
<?php } else { ?>
<div id="post_rate_div_<?php echo $post['pid'];?>"></div>
<?php } ?>

<div class="clboth mt16">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<div class="dptitle clboth">
<span class="dpicon16_16"></span>
<?php if($commentcount[$post['pid']]) { ?><span class="dpnum"><?php echo $commentcount[$post['pid']];?>人</span><?php } ?>
<span class="dpzi">点评</span>
<span class="dpicon6_11"></span>
<a href="javascript:;" class="shouqi" id="clist_btn_<?php echo $post['pid'];?>">收起</a>
</div>
<?php } ?>
<div class="clboth" id="comment_<?php echo $post['pid'];?>">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<ul class="dplistcon"><?php if(is_array($comments[$post['pid']])) foreach($comments[$post['pid']] as $comment) { ?><li id="comments_<?php echo $comment['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $comment['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="name" rel="nofollow"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $comment['comment'];?></span>
</span>
<?php if($comment['forpid'] <> 0) { ?>
<span class="second" style="display:none;">
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;postid=<?php echo $comment['pid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $comment['forpid'];?>&amp;cid=<?php echo $comment['id'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=commentreply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">回复</a>
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $comment['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<?php } ?>
<span class="hfreveiw">
<span class="time"><?php echo $comment['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_comreply('delcomment', <?php echo $comment['id'];?>,'','',<?php echo count($comment['replyComment']) ?>);"></a>
<?php } ?>
</span>
</li>
<?php if(!empty($comment['replyComment'])) { if(is_array($comment['replyComment'])) foreach($comment['replyComment'] as $reply) { ?><li id="comments_<?php echo $reply['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $reply['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="name" rel="nofollow"><?php echo $reply['author'];?></a>
<span class="hf">回复</span>
<a href="#" target="_blank" class="name_second"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $reply['comment'];?></span>
</span>
<span class="second" style="display:none;">
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $reply['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<span class="hfreveiw">
<span class="time"><?php echo $reply['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_delcomreply('delcomment', <?php echo $part['id'];?>,'','',<?php echo $comment['pid'];?>)"></a>
<?php } ?>
</span>
</li>
<?php } } } ?>
</ul>
<?php if($commentcount[$post['pid']] > $_G['setting']['commentnumber']) { ?>
<div class="dpfy clboth">
<div class="pg"><a href="javascript:;" onclick="ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>&page=2', 'comment_<?php echo $post['pid'];?>')">下一页</a></div>
</div>
<?php } } ?>
</div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount]; } ?>
</div>
<?php if($post['first'] && !$_G['forum_thread']['archiveid']) { if(!empty($lastmod['modaction'])) { ?><div class="modact xs1"><a href="forum.php?mod=misc&amp;action=viewthreadmod&amp;tid=<?php echo $_G['tid'];?>" title="帖子模式" onclick="showWindow('viewthreadmod', this.href)">本主题由 <?php echo $lastmod['modusername'];?> 于 <?php echo $lastmod['moddateline'];?> <?php echo $lastmod['modaction'];?></a></div><?php } ?>
<div class="xs1 uo<?php if($_G['group']['allowrecommend'] && $_G['setting']['recommendthread']['status']) { ?> nrate<?php } ?>">
<?php if($post['invisible'] == 0) { if($_G['group']['raterange'] && $post['authorid']) { ?>
<a id="k_rate" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?>', 'get', -1);return false;" title="<?php echo count($postlist[$post['pid']]['totalrate']);; ?> 人评分">评分</a>
<?php } ?>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" id="k_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('favoritenumber').innerHTML + ' 人收藏'">收藏<span id="favoritenumber"><?php echo $_G['forum_thread']['favtimes'];?></span></a>
<a href="home.php?mod=spacecp&amp;ac=share&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" id="k_share" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('sharenumber').innerHTML + ' 人分享'">分享<span id="sharenumber"><?php echo $_G['forum_thread']['sharetimes'];?></span></a>
<?php if($_G['perm']['allowrecommend'] && $_G['setting']['recommendthread']['status']) { ?>
<a id="recommend_add" href="forum.php?mod=misc&amp;action=recommend&amp;do=add&amp;tid=<?php echo $_G['tid'];?>" <?php if($_G['uid']) { ?>onclick="ajaxmenu(this, 3000, 1, 0, '43', 'recommendupdate(<?php echo $_G['group']['allowrecommend'];?>)');return false;"<?php } else { ?> onclick="showWindow('login', this.href)"<?php } ?> onmouseover="this.title = $('recommendv_add').innerHTML + ' 人<?php echo $_G['setting']['recommendthread']['addtext'];?>'"><?php echo $_G['setting']['recommendthread']['addtext'];?><span id="recommendv_add"><?php echo $_G['forum_thread']['recommend_add'];?></span></a>
<a id="recommend_subtract" href="forum.php?mod=misc&amp;action=recommend&amp;do=subtract&amp;tid=<?php echo $_G['tid'];?>" <?php if($_G['uid']) { ?>onclick="ajaxmenu(this, 3000, 1, 0, '43', 'recommendupdate(-<?php echo $_G['group']['allowrecommend'];?>)');return false;"<?php } else { ?> onclick="showWindow('login', this.href)"<?php } ?> onmouseover="this.title = $('recommendv_subtract').innerHTML + ' 人<?php echo $_G['setting']['recommendthread']['subtracttext'];?>'"><?php echo $_G['setting']['recommendthread']['subtracttext'];?><span id="recommendv_subtract"><?php echo $_G['forum_thread']['recommend_sub'];?></span></a>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_useraction'])) echo $_G['setting']['pluginhooks']['viewthread_useraction']; ?>
</div>
<?php } ?>
</td>
</tr>
</table>
</div>
<?php } if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>
</div>

<div class="bm vw pl" id="comment">
<div class="bm_h cl">
<h2>最新评论</h2>
</div>
<div class="bm_c"><?php if(is_array($postlist)) foreach($postlist as $postid => $post) { if($postid && !$post['first']) { ?>
<div id="post_<?php echo $post['pid'];?>" class="xld xlda mbm"><?php $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']); ?><dl class="bbda cl">
<?php if($post['author'] && !$post['anonymous']) { ?>
<dd class="m avt"><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>"><?php echo avatar($post[authorid], small); ?></a></dd>
<?php } else { ?>
<dd class="m avt"><img src="<?php echo STATICURL;?>image/magic/hidden.gif" alt="hidden" /></dd>
<?php } ?>
<dt>
<span class="y xw0">
<?php if(!$post['first'] && $_G['forum_thread']['special'] == 5) { ?>
<label class="pdbts pdbts_<?php echo intval($post['stand']); ?>">
<?php if($post['stand'] == 1) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=1<?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" title="只看正方">正方</a>
<?php } elseif($post['stand'] == 2) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=2<?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" title="只看反方">反方</a>
<?php } else { ?><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=0<?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" title="只看中立">中立</a><?php } if($post['stand']) { ?>
<a class="b" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" id="voterdebate_<?php echo $post['pid'];?>" onclick="ajaxmenu(this);doane(event);">支持 <?php echo $post['voters'];?></a>
<?php } ?>
</label>
<?php } if($_G['forum_thread']['special'] == 3 && ($_G['forum']['ismoderator'] && (!$_G['setting']['rewardexpiration'] || $_G['setting']['rewardexpiration'] > 0 && ($_G['timestamp'] - $_G['forum_thread']['dateline']) / 86400 > $_G['setting']['rewardexpiration']) || $_G['forum_thread']['authorid'] == $_G['uid']) && $post['authorid'] != $_G['forum_thread']['authorid'] && $post['first'] == 0 && $_G['uid'] != $post['authorid'] && $_G['forum_thread']['price'] > 0) { ?>
<a href="javascript:;" onclick="setanswer(<?php echo $post['pid'];?>, '<?php echo $_G['gp_from'];?>')">最佳答案</a>
<?php } if($_G['group']['raterange'] && $post['authorid']) { ?>
<a href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&from=<?php echo $_G['gp_from'];?><?php } ?>', 'get', -1);return false;">评分</a>
<?php } if($allowpostreply && $post['invisible'] == 0) { if($post['allowcomment']) { ?>
<a href="javascript:;" onclick="showWindow('comment', 'forum.php?mod=misc&action=comment&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>&extra=<?php echo $_G['gp_extra'];?>&page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&from=<?php echo $_G['gp_from'];?><?php } if($_G['forum_thread']['special'] == 127) { ?>&special=<?php echo $specialextra;?><?php } ?>', 'get', 0)">点评</a>
<?php } ?>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;reppost=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="showWindow('reply', this.href)">回复</a>
<?php if(!$needhiddenreply) { ?>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="showWindow('reply', this.href)">引用</a>
<?php } } if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>
<a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_G['gp_modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<?php } else { ?>编辑</a><?php } } ?>

</span>
<?php if($post['authorid'] && !$post['anonymous']) { if(!$_G['setting']['authoronleft']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="xi2"><?php echo $post['author'];?></a><?php echo $authorverifys;?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="author_<?php echo $post['pid'];?>">发表于</em>
<?php if($post['invisible'] == 0) { if(!IS_ROBOT && !$_G['gp_authorid'] && !$_G['forum_thread']['archiveid']) { ?>
<span class="pipe">|</span><a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>&amp;authorid=<?php echo $post['authorid'];?>" rel="nofollow">只看该作者</a>
<?php } elseif(!$_G['forum_thread']['archiveid']) { ?>
<span class="pipe">|</span><a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>" rel="nofollow">显示全部帖子</a>
<?php } } } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
匿名
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="author_<?php echo $post['pid'];?>">发表于</em>
<?php } elseif(!$post['authorid'] && !$post['username']) { ?>
游客
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="author_<?php echo $post['pid'];?>">发表于</em>
<?php } ?>
<span class="xg1 xw0"><?php echo $post['dateline'];?></span>
</dt>
<dd class="z"><div class="bjcon_new">
<?php if($post['warned']) { ?>
<span class="y"><a href="forum.php?mod=misc&amp;action=viewwarning&amp;tid=<?php echo $_G['tid'];?>&amp;uid=<?php echo $post['authorid'];?>" title="受到警告" onclick="showWindow('viewwarning', this.href)"><img src="http://static.8264.com/static/image/common/warning.gif" alt="受到警告" /></a></span>
<?php } if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽</em></div>
<?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽</em></div>
<?php } elseif($needhiddenreply) { ?>
<div class="locked">此帖仅作者可见</div>
<?php } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop'][$postcount]; if($_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽，只有管理员可见</em></div>
<?php } elseif($post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽，只有管理员可见</em></div>
<?php } if($post['first']) { if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
<div class="locked">
<em class="y"><a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" onclick="showWindow('pay', this.href)">记录</a></em>
付费主题, 价格: <strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?> </strong>
</div>
<?php } if($threadsort && $threadsortshow) { if($threadsortshow['typetemplate']) { ?>
<?php echo $threadsortshow['typetemplate'];?>
<?php } elseif($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
<div class="typeoption">
<?php if($threadsortshow['optionlist'] == 'expire') { ?>
该信息已经过期
<?php } else { ?>
<table summary="分类信息" cellpadding="0" cellspacing="0" class="cgtl mbm">
<caption><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></caption>
<tbody><?php if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { if($option['type'] != 'info') { ?>
<tr>
<th><?php echo $option['title'];?>:</th>
<td><?php if($option['value']) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?>-<?php } ?></td>
</tr>
<?php } } ?>
</tbody>
</table>
<?php } ?>
</div>
<?php } } } ?>

<div class="t_fsz_new <?php if(!$_G['forum_thread']['special']) { } else { } ?>">
<?php if($post['first']) { if(!$_G['forum_thread']['special']) { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } elseif($_G['forum_thread']['special'] == 1) { include template('forum/viewthread_poll'); } elseif($_G['forum_thread']['special'] == 2) { include template('forum/viewthread_trade'); } elseif($_G['forum_thread']['special'] == 3) { include template('forum/viewthread_reward'); } elseif($_G['forum_thread']['special'] == 4) { include template('forum/viewthread_activity'); } elseif($_G['forum_thread']['special'] == 5) { include template('forum/viewthread_debate'); } elseif($threadplughtml) { ?>
<?php echo $threadplughtml;?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } } else { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } if($post['attachment']) { ?>
<div class="locked">附件: <em><?php if($_G['uid']) { ?>你所在的用户组无法下载或查看附件<?php } else { ?>你需要<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);return false;">登录</a>才可以下载或查看附件。没有账号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="注册账号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em></div>
<?php } elseif(($post['imagelist'] || $post['attachlist'])) { if(!($post['first'] && $_G['forum_thread']['special'] == 4)) { ?>
<div class="pattl">
zxZX
<?php if($post['imagelist']) { ?>
<?php echo $post['imagelist'];?>
<?php } if($post['attachlist']) { ?>
<?php echo $post['attachlist'];?>
<?php } ?>
</div>
<?php } } ?>
</div>

<?php if($post['first'] && $sticklist) { ?>
<div>
<h3 class="psth xs1">回帖推荐</h3><?php if(is_array($sticklist)) foreach($sticklist as $rpost) { ?><div class="pstl xs1">
<div class="psta" style='z-index:1;position:absolute'><a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" c="1" rel="nofollow"><?php echo $rpost['avatar'];?></a></div>
<div class="psti">
<p>
<a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" class="xi2 xw1" rel="nofollow"><?php echo $rpost['author'];?></a>
                        发表于<?php echo $rpost['position'];?>楼
<span class="xi2">
&nbsp;<a href="javascript:;" onclick="window.open('forum.php?mod=redirect&goto=findpost&ptid=<?php echo $rpost['tid'];?>&pid=<?php echo $rpost['pid'];?>')" class="xi2">查看完整内容</a>
<?php if($_G['group']['allowstickreply']) { ?>&nbsp;<a href="javascript:;" onclick="modaction('stickreply', <?php echo $rpost['pid'];?>, '&undo=yes')" class="xi2">解除置顶</a><?php } ?>
</span>
</p>
<div class="mtn"><?php echo $rpost['message'];?></div>
</div>
</div>
<?php } ?>
</div>
<?php } if($post['number']==1 && $_G['uid'] && 1!=1) { ?>
<!-- 波总要求取消1楼快速回复，如后面需要再恢复，去掉上面条件 && 1!=1 -->
<form method="post" autocomplete="off" id="fastreplyform" onsubmit="$('fastreplysubmit').disabled=true;jQuery('#fastreplymessage').focus();ajaxpost('fastreplyform', 'return_fastreply', 'return_fastreply', 'onerror', 'fastreplysubmit', fastreply_refun);return false;" action="forum.php?mod=post&amp;infloat=yes&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;replysubmit=yes">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" fwin="reply">
<input type="hidden" name="handlekey" value="reply">
<input type="hidden" name="noticeauthor" value="q|<?php echo $post['authorid'];?>|<?php echo $post['author'];?>">
<input type="hidden" name="noticetrimstr" value="<?php echo $fastreply_noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $fastreply_noticeauthormsg;?>" />
<input type="hidden" name="reppost" value="<?php echo $post['pid'];?>">

<div class="lchf">
<div id="return_fastreply"></div>
<div style="overflow: hidden; height: 100px;">
<textarea name="message" class="t_note" id="fastreplymessage">楼主说的太精彩了，快来点评一下！</textarea>
<div class="areatext" id="fastreply-message-hidden" contenteditable="true"></div>
<div id="fastreply-atlist"></div>
</div>
<div class="lcksfu clboth">
<span class="lcksfu_l" id="fastreply_btnbox">
<button class="lcksfubotton" value="true" name="replysubmit" id="fastreplysubmit" type="submit"></button>
<!-- 手机绑定提示 -->
<?php if(!$_G['member']['telstatus']) { ?>
<style type="text/css">.tips-binding__inside{float:left;background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:4px 0 0 10px;font-size:14px;color:#585858}.tips-binding__inside a{color:#ff7038;font-size:14px}.tips-binding__inside a:hover{color:#ff7038;font-size:14px}</style>
<span class="tips-binding__inside">注：回帖操作需绑定手机，<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">去绑定>></a></span>
<?php } ?>
<!-- //手机绑定提示 -->
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="<classname>"><sec><i id="sec<hash>_menu" class="yzmimg" style="display:none"><sec></i></span>
EOF;
?>
<div class="twyzm clboth fastreplysec"><?php include template('common/seccheck'); ?></div>
<?php } ?>
</span>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;repquote=<?php echo $post['pid'];?>" onclick="switchAdvanceMode(this.href);doane(event);" class="lcksfu_r">高级模式</a>
</div>
</div>
</form>
<script type="text/javascript">
jQuery("#fastreplymessage").focus(function(){
if(jQuery(this).attr('class')=='t_note'){
jQuery(this).removeClass('t_note');
jQuery(this).val('');
}
});
function fastreply_refun(){
jQuery('#fastreplymessage').val('');
$('fastreplysubmit').disabled=false;
var body=(window.opera) ? (document.compatMode == "CSS1Compat" ? jQuery('html') : jQuery('body')) : jQuery('html,body');
if(jQuery('#return_fastreply').html().indexOf('succeed')>-1){
body.animate({scrollTop:jQuery('#comment_<?php echo $post['pid'];?>').position().top-100},0);
}
}
</script>
<?php } if(!empty($post['ratelog'])) { ?>
<div class="clboth mt16" id="ratelog_<?php echo $post['pid'];?>">
<?php if(!$_G['setting']['ratelogon']) { ?>
<div class="pftitle clboth">
<span class="pficon16_16"></span>
<span class="pfnum"><?php echo count($postlist[$post['pid']]['totalrate']);; ?>人</span>
<span class="pfzi">评分</span>
<span class="pficon6_11"></span>
<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)">查看全部评分</a>
</div>
<?php } ?>
<div id="post_rate_<?php echo $post['pid'];?>"></div>
<?php if($_G['setting']['ratelogon']) { ?>
<table class="ratl">
<tr>
<th class="xw1" width="120"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分">已有 <span class="xi1"><?php echo count($postlist[$post['pid']]['totalrate']);; ?></span> 人评分</a></th><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { ?><th width="50"><i><?php echo $_G['setting']['extcredits'][$id]['title'];?></i></th>
<?php } ?>
<th>
<a href="javascript:;" onclick="toggleRatelogCollapse('ratelog_<?php echo $post['pid'];?>', this);" class="y xi2 op"><?php if(!empty($_G['cookie']['ratecollapse'])) { ?>展开<?php } else { ?>收起<?php } ?></a>
<i>理由</i>
</th>
</tr>
<tbody class="ratl_l"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><tr id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>">
<td>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a> <a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" rel="nofollow"><?php echo $ratelog['username'];?></a>
</td><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($ratelog['score'][$id] > 0) { ?>
<td class="xi1"> + <?php echo $ratelog['score'][$id];?></td>
<?php } else { ?>
<td class="xg1"><?php echo $ratelog['score'][$id];?></td>
<?php } } ?>
<td class="xg1"><?php echo $ratelog['reason'];?></td>
</tr>
<?php } ?>
</tbody>
</table>
<p class="ratc">
总评分:&nbsp;<?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($score > 0) { ?>
<span class="xi1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?></span>&nbsp;
<?php } else { ?>
<span class="xg1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?></span>&nbsp;
<?php } } ?>
&nbsp;<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分" class="xi2">查看全部评分</a>
</p>
<?php } else { ?>
<div class="clboth">
<ul class="pftoulist clboth"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><li>
<div id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>_menu" class="attp" style="display: none;">
<p class="crly"><?php echo $ratelog['reason'];?> &nbsp;&nbsp;<?php if(is_array($ratelog['score'])) foreach($ratelog['score'] as $id => $score) { if($score > 0) { ?>
<em><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></em>
<?php } else { ?>
<span><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></span>
<?php } } ?>
</p>
<p class="mncr"></p>
</div>
<p id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="tx"><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a></p>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" class="name" rel="nofollow"><?php echo $ratelog['username'];?></a>
</li>
<?php } ?>
<div style="clear:both;"></div>
</ul>
</div>
<?php } ?>
</div>
<?php } else { ?>
<div id="post_rate_div_<?php echo $post['pid'];?>"></div>
<?php } ?>

<div class="clboth mt16">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<div class="dptitle clboth">
<span class="dpicon16_16"></span>
<?php if($commentcount[$post['pid']]) { ?><span class="dpnum"><?php echo $commentcount[$post['pid']];?>人</span><?php } ?>
<span class="dpzi">点评</span>
<span class="dpicon6_11"></span>
<a href="javascript:;" class="shouqi" id="clist_btn_<?php echo $post['pid'];?>">收起</a>
</div>
<?php } ?>
<div class="clboth" id="comment_<?php echo $post['pid'];?>">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<ul class="dplistcon"><?php if(is_array($comments[$post['pid']])) foreach($comments[$post['pid']] as $comment) { ?><li id="comments_<?php echo $comment['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $comment['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="name" rel="nofollow"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $comment['comment'];?></span>
</span>
<?php if($comment['forpid'] <> 0) { ?>
<span class="second" style="display:none;">
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;postid=<?php echo $comment['pid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $comment['forpid'];?>&amp;cid=<?php echo $comment['id'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=commentreply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">回复</a>
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $comment['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<?php } ?>
<span class="hfreveiw">
<span class="time"><?php echo $comment['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_comreply('delcomment', <?php echo $comment['id'];?>,'','',<?php echo count($comment['replyComment']) ?>);"></a>
<?php } ?>
</span>
</li>
<?php if(!empty($comment['replyComment'])) { if(is_array($comment['replyComment'])) foreach($comment['replyComment'] as $reply) { ?><li id="comments_<?php echo $reply['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $reply['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="name" rel="nofollow"><?php echo $reply['author'];?></a>
<span class="hf">回复</span>
<a href="#" target="_blank" class="name_second"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $reply['comment'];?></span>
</span>
<span class="second" style="display:none;">
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $reply['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<span class="hfreveiw">
<span class="time"><?php echo $reply['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_delcomreply('delcomment', <?php echo $part['id'];?>,'','',<?php echo $comment['pid'];?>)"></a>
<?php } ?>
</span>
</li>
<?php } } } ?>
</ul>
<?php if($commentcount[$post['pid']] > $_G['setting']['commentnumber']) { ?>
<div class="dpfy clboth">
<div class="pg"><a href="javascript:;" onclick="ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>&page=2', 'comment_<?php echo $post['pid'];?>')">下一页</a></div>
</div>
<?php } } ?>
</div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount]; } ?>
</div>
</dd>

</dl>


<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_endline'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_endline'][$postcount]; ?>

</div>
<?php } } ?>
<div id="postlistreply" class="xld xlda mbm"><div id="post_new" class="viewthread_table" style="display: none"></div></div>
<?php if($multipage) { ?>
<div class="pgs cl"><?php echo $multipage;?></div>
<?php } ?>
</div>

<?php if($_G['setting']['fastpost'] && $allowpostreply && !$_G['forum_thread']['archiveid']) { ?>
<div class="bm_c"><script type="text/javascript">
var postminchars = parseInt('<?php echo $_G['setting']['minpostsize'];?>');
var postmaxchars = parseInt('<?php echo $_G['setting']['maxpostsize'];?>');
var disablepostctrl = parseInt('<?php echo $_G['group']['disablepostctrl'];?>');
</script>

<div class=" layout pingluncon" id="f_pst">
<form method="post" autocomplete="off" id="fastpostform" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes<?php if($_G['gp_ordertype'] != 1) { ?>&amp;infloat=yes&amp;handlekey=fastpost<?php } if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>"<?php if($_G['gp_ordertype'] != 1) { ?> onSubmit="return fastpostvalidate(this)"<?php } ?>>

<?php if(empty($_G['gp_from'])) { ?>
<div class="pingluntou">
<?php if($_G['uid']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" rel="nofollow"><?php echo avatar($_G['uid'],'small'); ?></a>
<?php } else { echo avatar(0,'small'); } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_side'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_side']; ?>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_content'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_content']; ?>
<div class="pinglun">
<span id="fastpostreturn"></span>

<?php if($_G['forum_thread']['special'] == 5 && empty($firststand)) { ?>
<div class="pbt cl">
<div class="ftid sslt">
<select id="stand" name="stand">
<option value="">选择观点</option>
<option value="0">中立</option>
<option value="1">正方</option>
<option value="2">反方</option>
</select>
</div>
<script type="text/javascript">simulateSelect('stand');</script>
</div>
<?php } ?>

<div class="pinglunmid"  style="width:705px;">
<div class="edierbar clboth">
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_func_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_func_extra']; ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra']; ?><?php $seditor = array('fastpost', array('bold', 'color'), $guestreply ? 1 : 0); if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="深灰色"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="蓝色"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="红色"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?>>Image</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('simpleupload', $seditor['1'])) { ?>
<div class="bq_fjimg" id="uploadpic">
<a href="javascript:;" class="fjimg"></a>
</div><?php require_once libfile('class/simpleupload'); ?><?php $flashstring = simpleUpload::getFlashStr("uploadpic", 24, 23); ?><?php echo $flashstring;?>
<script>
function flashcallback(type, data){
eval("var objbtn = " + data);
switch(type){
case -1:
//alert(objbtn.text);
break;
case 1:
//alert(objbtn.text);alert(objbtn.picurl);
jQuery("#<?php echo $seditor['0'];?>message").val(jQuery("#<?php echo $seditor['0'];?>message").val() + "[img]" + objbtn.picurl + "[/img]");
break;
}
}
</script>
<?php } ?><a class="gjms" href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="return switchAdvanceMode(this.href)">上传图片请点击高级模式</a>
</div>
<div class="areatext">
<?php if(!$guestreply) { ?>
<textarea rows="5" cols="80" name="message" id="fastpostmessage" onKeyDown="seditor_ctlent(event, <?php if($_G['gp_ordertype'] != 1) { ?>'fastpostvalidate($(\'fastpostform\'))'<?php } else { ?>'$(\'fastpostform\').submit()'<?php } ?>);" tabindex="4" class="pt"  style="width:675px;"></textarea>
<div class="areatext" id="message-hidden" contenteditable="true"></div>
<div id="atlist"></div>
<?php } else { ?>
<div class="pt hm" style="border: none;">
你需要登录后才可以回帖
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">登录</a>
| <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="showWindow('register', this.href)" class="xi2"><?php echo $_G['setting']['reglinkname'];?></a>
<?php if($_G['setting']['connect']['allow']) { ?>
| <a href="<?php echo $_G['connect']['login_url'];?>&statfrom=viewthread_fastpost" target="_top" rel="nofollow"><img src="<?php echo IMGDIR;?>/qq_login.gif" class="vm" /></a>
<?php } ?>
</div>
<?php } ?>
</div>
</div>


<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="<classname>"><sec><i id="sec<hash>_menu" class="yzmimg" style="display:none"><sec></i></span>
EOF;
?>
<div class="twyzm clboth"><?php include template('common/seccheck'); ?></div>
<?php } ?>
<style type="text/css">.post-button{overflow:hidden;margin-top:12px}.post-button .kshf{float:left;margin-top:0}.tips-binding{float:left;background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:8px 0 0 15px;font-size:14px;color:#585858}.tips-binding a{color:#ff7038;font-size:14px}</style>
<div class="post-button">
<button <?php if(!$guestreply) { ?>type="submit" <?php } else { ?>type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')" <?php } ?>name="replysubmit" id="fastpostsubmit" class="kshf" value="" tabindex="5"></button>
<!-- 手机绑定提示 -->
<?php if(!$_G['member']['telstatus']) { ?><span class="tips-binding">注：回帖操作需绑定手机，<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">去绑定>></a></span><?php } ?>
<!-- //手机绑定提示 -->
</div>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="subject" value="" />
<?php if($_G['gp_ordertype'] != 1 && empty($_G['gp_from'])) { ?>
<script type="text/javascript">if(getcookie('fastpostrefresh') == 1) {$('fastpostrefresh').checked=true;}</script>
<?php } ?>

</div>

<div style="float:right;width:160px;height:150px;border:1px solid #e3e3e3;padding:9px;">
<!-- 论坛详情_帖子回复右侧_牧高笛 402--><?php echo adshow("custom_478"); ?></div>



</div>

</form>
<?php if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) { ?>
<!-- @提醒 -->
<script src="http://static.8264.com/static/js/at.js" type="text/javascript"></script>
<script type="text/javascript">
window.onload = function () {
<?php if($page == 1) { ?>
var fastreply_textarea = document.getElementById("fastreplymessage");
var fastreply_hiddenObj = document.getElementById("fastreply-message-hidden");
var fastreply_atList = document.getElementById("fastreply-atlist");
at(fastreply_textarea, fastreply_hiddenObj, fastreply_atList);
<?php } ?>
var textarea = document.getElementById("fastpostmessage");
var hiddenObj = document.getElementById("message-hidden");
var atList = document.getElementById("atlist");
at(textarea, hiddenObj, atList);

// 操作非文本框区域外时隐藏AT提示列表
addListener(document, "click",
function(evt) {
var evt = window.event ? window.event: evt,
target = evt.srcElement || evt.target;

if (target.id != "fastpostmessage" && target.id != "atlist" && target.id != "fastreplymessage" && target.id != "fastreply-atlist" ) {
document.getElementById("atlist").style.display = "none";
<?php if($page == 1) { ?>document.getElementById("fastreply-atlist").style.display = "none";<?php } ?>
}
});

}
</script>
<?php } ?>
</div>
<?php } ?>
</div>

</div>
<div class="sd">
<?php if($_G['setting']['visitedforums']) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>浏览过的版块</h2>
</div>
<div class="bm_c xl xl2 cl">
<ul>
<?php echo $_G['setting']['visitedforums'];?>
</ul>
</div>
</div>
<?php } if($oldthreads) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>浏览过的帖子</h2>
</div>
<div class="bm_c xl xl1">
<ul><?php if(is_array($oldthreads)) foreach($oldthreads as $oldtid => $oldsubject) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $oldtid;?>&amp;from=portal"><?php echo $oldsubject;?></a></li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_side_bottom'])) echo $_G['setting']['pluginhooks']['viewthread_side_bottom']; ?>
<div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>
</div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div></div>
<?php if(empty($topic) || ($topic['usefooter'])) { ?>
<style type="text/css">
.focus{ float:right;}
.sitefocuslist li { background: url(http://static.8264.com/static/images/dot.gif) 0px 7px no-repeat; padding-left: 10px; margin-bottom: 3px;}
.sitefocuslist li a,#sitefocus h3 a,#sitefocus h3 a:visited{ color:#186dd7; font-size: 12px;}
.sitefocuslist li a:hover{ color:#e00000;}
#sitefocus h3 em a:hover{color:red;}
</style>
<?php if($_G['fid']!=489) { ?>
<div id="sitefocus" class="focus" style="display:none;"></div><?php $focusid = getfocus_rand($_G['basescript']); if(getcookie('nofocus_difanban')!=1 && $discuz ) { ?>
<script type="text/javascript">
ajaxget('plugin.php?id=forumoption:ajaxip&difangban=1&focusid=<?php echo $focusid;?>', 'sitefocus');
</script>
<?php } elseif(getcookie('nofocus_'.$focusid) != 1 && $discuz && $focusid !== null) { ?>
<script type="text/javascript">
ajaxget('plugin.php?id=forumoption:ajaxip&difangban=0&focusid=<?php echo $focusid;?>', 'sitefocus');
</script>
<?php } } ?><?php echo adshow("footerbanner/wp a_f/1"); ?><?php echo adshow("footerbanner/wp a_f/2"); ?><?php echo adshow("footerbanner/wp a_f/3"); ?><?php echo adshow("float/a_fl/1"); ?><?php echo adshow("float/a_fr/2"); ?><?php echo adshow("couplebanner/a_fl a_cb/1"); ?><?php echo adshow("couplebanner/a_fr a_cb/2"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?>
<div id="ft" class="wp cl" style="padding:10px 0px 0px 0px;">
<div id="flk" class="y">
<p>
<strong><a href="http://bbs.8264.com/member.php?mod=clearcookies&amp;formhash=<?php echo formhash();; ?>" target="_blank">清除COOKIE</a></strong><span class="pipe">|</span><?php $fnavcount=0; if(is_array($_G['setting']['footernavs'])) foreach($_G['setting']['footernavs'] as $nav) { if($nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) ||
!$nav['type'] && ($nav['id'] == 'stat' && $_G['group']['allowstatdata'] || $nav['id'] == 'report' && $_G['uid'] || $nav['id'] == 'archiver' || $nav['id'] == 'mobile'))) { if($nav['id'] == 'mobile' && $_G['setting']['mobile']['allowmobile'] != 1) { ?><?php continue; } ?><?php echo $nav['code'];?><span class="pipe">|</span><?php } } if($_G['setting']['icp']) { ?>( <a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $_G['setting']['icp'];?></a> )<?php } if($_G['setting']['statcode']) { ?><?php echo $_G['setting']['statcode'];?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?>
</p>
<p class="xs0">
<span id="debuginfo">
<?php if(debuginfo()) { ?> Processed in <?php echo $_G['debuginfo']['time'];?> second(s), <?php echo $_G['debuginfo']['queries'];?> queries
<?php if($_G['gzipcompress']) { ?>, Gzip On<?php } if($_G['memory']) { ?>, <?php echo ucwords($_G['memory']); ?> On<?php } ?>.
<?php } ?>
</span>
</p>
</div>
<div id="frt">
<p style="color:#333">户外有风险，8264提醒您购买<a href="http://bx.8264.com/?8264com" target="_blank" style=" color:#2A85E8;">户外保险</a><?php if(!empty($_G['setting']['boardlicensed'])) { ?> <a href="http://license.comsenz.com/?pid=1&amp;host=<?php echo $_SERVER['HTTP_HOST'];?>" target="_blank">Licensed</a><?php } ?></p>
<p class="xs0"></p>
</div>
<?php if($_G['extcnzz']) { ?>
<div style="display:none;"><?php if(is_array($_G['extcnzz'])) foreach($_G['extcnzz'] as $value) { ?><?php echo $value;?>
<?php } ?>
</div>
<?php } ?><?php updatesession(); ?></div><?php } ?><ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?></ul><?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly">
积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分
</div>
<div class="mncr"></div>
</div>
<?php } if(!$_G['setting']['bbclosed']) { if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?><script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script><script src="http://static.8264.com/static/js/portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
<script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_G['gp_do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<?php } ?>
</body>
</html><?php output(); ?>