<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthreadproduce', 'common/header');
0
|| checktplrefresh('./template/default/forum/viewthreadproduce.htm', './template/8264/common/header.htm', 1501558350, 'diy', './data/template/2_diy_forum_viewthreadproduce.tpl.php', './template/8264', 'forum/viewthreadproduce')
|| checktplrefresh('./template/default/forum/viewthreadproduce.htm', './template/8264/common/zbtjbbs.htm', 1501558350, 'diy', './data/template/2_diy_forum_viewthreadproduce.tpl.php', './template/8264', 'forum/viewthreadproduce')
|| checktplrefresh('./template/default/forum/viewthreadproduce.htm', './template/default/common/simplesearchform.htm', 1501558350, 'diy', './data/template/2_diy_forum_viewthreadproduce.tpl.php', './template/8264', 'forum/viewthreadproduce')
|| checktplrefresh('./template/default/forum/viewthreadproduce.htm', './template/default/forum/viewthread_fastpostproduce.htm', 1501558350, 'diy', './data/template/2_diy_forum_viewthreadproduce.tpl.php', './template/8264', 'forum/viewthreadproduce')
|| checktplrefresh('./template/default/forum/viewthreadproduce.htm', './template/default/forum/viewthread_from_node_produce.htm', 1501558350, 'diy', './data/template/2_diy_forum_viewthreadproduce.tpl.php', './template/8264', 'forum/viewthreadproduce')
|| checktplrefresh('./template/default/forum/viewthreadproduce.htm', './template/8264/common/footer.htm', 1501558350, 'diy', './data/template/2_diy_forum_viewthreadproduce.tpl.php', './template/8264', 'forum/viewthreadproduce')
|| checktplrefresh('./template/default/forum/viewthreadproduce.htm', './template/8264/common/header_common.htm', 1501558350, 'diy', './data/template/2_diy_forum_viewthreadproduce.tpl.php', './template/8264', 'forum/viewthreadproduce')
|| checktplrefresh('./template/default/forum/viewthreadproduce.htm', './template/8264/common/seditor_2014.htm', 1501558350, 'diy', './data/template/2_diy_forum_viewthreadproduce.tpl.php', './template/8264', 'forum/viewthreadproduce')
|| checktplrefresh('./template/default/forum/viewthreadproduce.htm', './template/8264/forum/viewthread_node_body_2014.htm', 1501558350, 'diy', './data/template/2_diy_forum_viewthreadproduce.tpl.php', './template/8264', 'forum/viewthreadproduce')
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
<link rel="stylesheet" href="/source/plugin/produce/css/style.css?v=2" />
<script src="/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
</script>
<script type="text/javascript">var fid = parseInt('<?php echo $_G['fid'];?>'), tid = parseInt('<?php echo $_G['tid'];?>');</script>
<?php if($modmenu['thread'] || $modmenu['post']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>

<script src="<?php echo $_G['setting']['jspath'];?>forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">zoomstatus = parseInt(<?php echo $_G['setting']['zoomstatus'];?>);var imagemaxwidth = '<?php echo IMAGEMAXWIDTH;?>';var aimgcount = new Array();</script>
<div style="margin:10px 0">	<style type="text/css">
/* 装备推荐底部 Start */
.layout:after { content: ""; display: block; clear: both; visibility: hidden; }
.layout { zoom: 1; }
.floatL { float: left; display: inline; }
.floatR { float: right; display: inline; }
.layout { margin: 0 auto; width: 960px; }
.mt10 { margin-top: 10px; }
/* */
.gearLayout { height: 310px; overflow: hidden; text-align: center; border: 1px solid #DDD; border-radius: 5px 5px 0 0; background: #F3F3F3 url(http://www.8264.com/template/8264/css/moban/gear/bg_gearlayout.png) no-repeat 80px 0px; color: #555; font-size: 12px; }
.gearLayout a { text-decoration: none; color: #555; }
.gearLayout a:hover { text-decoration: none; color: #2a85e8; }
.gearLayout .tips { padding-left: 10px; color: #666; font-weight: 100; font-size: 12px; }
.gearLayout h2 { text-align: left; padding-left: 8px; font: 700 14px/38px "microsoft yahei"; color: #333; }
.gearLayout h2 a{ float:right; margin:0px 15px 0px 0px;}
.gearLayout li { float: left; display: inline; margin-left: 10px; margin-bottom: 10px; width: 177px; height: 260px; border: 1px solid #DDD; background: #FFF; }
.gearLayout li .p-tit { line-height: 30px; border-bottom: 1px dotted #CCC; }
.gearLayout li .p-img { padding: 10px 0; }
.gearLayout li .p-img img { width: 155px; height: 155px; }
.gearLayout li .p-name { line-height: 20px; border-top: 1px dotted #CCC; padding: 5px 0; }
/* 装备推荐底部  End */
</style>
<script type="text/javascript" charset="utf-8">
// 调取商城商品数据
jQuery(function ($) {
$.ajax({
url: 'plugin.php?id=api:lymgoods',
data: {'location': '1'},
dataType: 'json',
type: 'get',
success: function (data) {
if (!data.err) {
var mall = data.mall;
var tuan = data.tuan;
var container = $('.gearLayout');
container.append('<h2>驴友商城装备推荐</h2>');
$.each(data.tuan, function(k, i) {
var content = '<li><p class="p-tit"AK>' + i.goods_name + '</p>' + 
'<p class="p-img"><a href="http://www.lvyoumall.com/tuan/goods-' + i.goods_id + '" target="_blank"><img src="' + i.image_url + '"></a></p>' +
'<p class="p-name">团购价：' + i.price + '元</p></li>';
container.append(content);
});
$.each(data.mall, function(k, i) {
var content = '<li><p class="p-tit"AK>' + i.goods_name + '</p>' + 
'<p class="p-img"><a href="http://www.lvyoumall.com/goods/' + i.goods_id + '" target="_blank"><img src="' + i.image_url + '"></a></p>' +
'<p class="p-name">会员价：' + i.price + '元</p></li>';
container.append(content);
});
} else {
$('.mt10').empty();
}
},
error: function (data) {
$('.mt10').empty();
}
})
});
</script>
<div class="mt10">
<ul class="gearLayout">

</ul>
</div>
<script type="text/javascript">
;(function($){
    function resize_style() {
        var width = 177;
        var max_width = $('.gearLayout').width()-2;
        var item_num = parseInt(max_width / width);
        var item_margin = parseInt((max_width % width) / (item_num + 2) / 2);
        var padding_left = item_margin;
        $('.gearLayout li').css({'margin-left': (2*padding_left)+'px'});
        $('.gearLayout li > div').css({'margin-left':item_margin+'px', 'margin-right':item_margin+'px'});
    }	
    $(window).resize(resize_style);
    $("#wh").live("mouseleave",function(){		
        resize_style();
});
$("#wh").live("click",function(){		
        resize_style();
});
$("#wh").live("mouseenter",function(){
        resize_style();
    });
setTimeout(function(){
        resize_style();
    }, 200)
})(jQuery);
</script></div>
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
<a href="./" id="fjump"<?php if($_G['setting']['forumjump'] == 1) { ?> onmouseover="showMenu({'ctrlid':this.id})"<?php } ?> class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a><?php echo $navigation;?> <em>&rsaquo;</em> <?php echo $_G['forum_thread']['short_subject'];?>
</div>
</div>

<div id="goTop">
    <a href="#" class="cursor" onclick="javascript:void(0)"></a>
</div>
<script src="/source/plugin/produce/js/jQuery-gotop.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery('#goTop').goTop();
</script>





<style type="text/css">
#showtip {}
#showtip .showtx{width:100px;height:66px;z-index:88;background-color:#F7F7F7;border:1px solid #ccc;margin-top: 5px;margin-bottom: 10px;position: absolute;}
#showtip .showtx .sjx{background: url("http://www.8264.com/source/plugin/produce/images/sjx_float_.gif") no-repeat scroll 5px 0 transparent;height: 18px;left: -11px;position: absolute;top: 7px;width: 19px;}
</style>
<div id="showtip">
</div>
<script type="text/javascript">
;(function($) {
    $(function(){
$('.product_list .pimglist2 li a').live('click', function() {
if ($.browser.msie && $.browser.version == '6.0') {
var top = $(this).offset().top -10,
    left = $(this).offset().left+61;				
    }else if ($.browser.msie && $.browser.version == '8.0') {
var top = $(this).offset().top -60,
    left = $(this).offset().left+61;				
    }else{				
var top = $(this).offset().top -50,
left = $(this).offset().left+61;			
}
$('#showtip').empty().append(
$(this).parent('.product_list .pimglist2 li').prev('.showtx').clone().css({top: top, left:left})
    );
return false;
});
$('.product_stat .wawntuse .user_list li .img').live('click', function() {

var top = $(this).offset().top -26,
left = $(this).offset().left+40;			
$('#showtip').empty().append(
$(this).parent('.product_stat .wawntuse .user_list li').prev('.showtx').clone().css({top: top, left:left})
    );
return false;
});

$('.product_stat .used .user_list li .img').live('click', function() {			
var top = $(this).offset().top -12,
left = $(this).offset().left+40;			
$('#showtip').empty().append(
$(this).parent('.product_stat .used .user_list li').prev('.showtx').clone().css({top: top, left:left})
    );
return false;
});

$('.usersprice .userbox .userlist .list .jiagetx a').live('click', function() {			
if ($.browser.msie && $.browser.version == '8.0') {
var top = $(this).offset().top -20,
    left = $(this).offset().left+32;				
    }else{
var top = $(this).offset().top -8,
left = $(this).offset().left+32;
}
$('#showtip').empty().append(
$(this).parent('.usersprice .userbox .userlist .list .jiagetx').prev('.showtx').clone().css({top: top, left:left})
    );
return false;
});

$('.xlda .m a').live('click', function() {
var top = $(this).offset().top -6,
left = $(this).offset().left+62;				
$('#showtip').empty().append(
$(this).parent('.xlda .m').prev('.showtx').clone().css({top: top, left:left})
    );
return false;
});

$('.psta a').live('click', function() {
if ($.browser.msie && $.browser.version == '8.0') {		
var top = $(this).offset().top-30,
left = $(this).offset().left+32;
}else{
var top = $(this).offset().top-19,
left = $(this).offset().left+32;
}
$('#showtip').empty().append(
$(this).parent('.psta').prev('.showtx').clone().css({top: top, left:left})
    );
return false;
});

$('body').live('click', function() {
    $('#showtip').empty();
})
});
})(jQuery);
</script>








<?php if(!empty($_G['setting']['pluginhooks']['viewthread_top'])) echo $_G['setting']['pluginhooks']['viewthread_top']; ?>
<!--此处去掉了广告-->
<?php if(!$_G['uid']) { ?>
<div id="logon-pop-wrap" style="display: none;">
<div class="click_close" onclick="closeRegisterIntro();"></div>
<form id="logon-pop-form" method="post" action="">
<h2 class="logon-pop-desc f14">请<a href="member.php?mod=logging&amp;action=login" class="ured">登录</a>或<a href="member.php?mod=register" class="ured">注册</a>，分享您的装备，与更多好友交流！ </h2>
<div class="pop_login2">
<a class="signup" onclick="showWindow('register', this.href);hideWindow('login');" href="member.php?mod=register">立即注册</a>	
<span class="text">
 己有帐号?
<a class="login" onclick="showWindow('login', this.href);hideWindow('register');" href="member.php?mod=logging&amp;action=login">点击登录</a>
</span>
</div>
</form>
</div>
<script type="text/javascript">
function closeRegisterIntro() {
document.getElementById('logon-pop-wrap').style.display = 'none';
return false;
} 
</script>
<?php } ?>

<div id="bianlan">
<div style="display: none;" id="sideBarContents">
<div class="list">
  <div class="list_1"><?php $cpdl = ForumOptionProduce::getTypeData(); if($cpdl) { if(is_array($cpdl)) foreach($cpdl as $dl) { if($dl['id']==41) { ?>
<a target="_parent" href="<?php echo PORTAL_HOST;?>zb-type-<?php echo $dl['id'];?>"><img src="http://www.8264.com/template/8264/image/forum_produce/<?php echo $dl['id'];?>.gif" alt="<?php echo $dl['tname'];?>" />工具仪器</a>
<?php } elseif(($dl['id']==72)) { ?>
<a target="_parent" href="<?php echo PORTAL_HOST;?>zb-type-<?php echo $dl['id'];?>"><img src="http://www.8264.com/template/8264/image/forum_produce/<?php echo $dl['id'];?>.gif" alt="<?php echo $dl['tname'];?>" />炉具餐具</a>
<?php } else { ?>
<a target="_parent" href="<?php echo PORTAL_HOST;?>zb-type-<?php echo $dl['id'];?>"><img src="http://www.8264.com/template/8264/image/forum_produce/<?php echo $dl['id'];?>.gif" alt="<?php echo $dl['tname'];?>" /><?php echo $dl['tname'];?></a>				
<?php } } } ?>
  </div>		  
  <div class="list_2"><?php if(is_array($cpdl)) foreach($cpdl as $type) { ?><?php $secondType = ForumOptionProduce::getTypeNextDatas($type['id']); ?>    <div id="<?php echo $type['id'] ?>" class="item"<?php if($type['id'] != '27') { ?> style="display:none;"<?php } ?>><?php if(is_array($secondType)) foreach($secondType as $sec_type) { if($sec_type['tparent']==$type['id']) { ?>
<a href="<?php echo PORTAL_HOST;?>zb-type-<?php echo $sec_type['id'];?>"><?php echo $sec_type['tname'];?></a>
<?php } } ?>
</div>
<?php } ?>
  </div>
</div>	
    </div>
<div style="display: none;" id="sideBarContents_02">
        <div class="brandlist">
<div class="list_1">
<a class="selected" target="_blank" href="javascript:;">A</a>
<a target="_blank" href="javascript:;">B</a>
<a target="_blank" href="javascript:;">C</a>
<a target="_blank" href="javascript:;">D</a>
<a target="_blank" href="javascript:;">E</a>
<a target="_blank" href="javascript:;">F</a>
<a target="_blank" href="javascript:;">G</a>
<a target="_blank" href="javascript:;">H</a>
<a target="_blank" href="javascript:;">I</a>
<a target="_blank" href="javascript:;">J</a>
<a target="_blank" href="javascript:;">K</a>
<a target="_blank" href="javascript:;">L</a>
<a target="_blank" href="javascript:;">M</a>
<a target="_blank" href="javascript:;">N</a>
<a target="_blank" href="javascript:;">O</a>
<a target="_blank" href="javascript:;">P</a>
<a target="_blank" href="javascript:;">Q</a>
<a target="_blank" href="javascript:;">R</a>
<a target="_blank" href="javascript:;">S</a>
<a target="_blank" href="javascript:;">T</a>
<a target="_blank" href="javascript:;">U</a>
<a target="_blank" href="javascript:;">V</a>
<a target="_blank" href="javascript:;">W</a>
<a target="_blank" href="javascript:;">X</a>
<a target="_blank" href="javascript:;">Y</a>
<a target="_blank" href="javascript:;">Z</a>
            </div>
<div class="list_2"><?php $brandList = ForumOptionProduce::getBrandNumberAtBianlian(); ?><?php $f_letter_list = explode(' ', 'A B C D E F G H I J K L M N O P Q R S T U V W X Y Z'); if(is_array($f_letter_list)) foreach($f_letter_list as $f_letter) { ?><div id="<?php echo $f_letter ?>" class="item"<?php if($f_letter != 'A') { ?> style="display:none;"<?php } ?>><?php if(is_array($brandList[$f_letter])) foreach($brandList[$f_letter] as $item) { ?><a style="width: 140px;" target="_blank" href="http://www.8264.com/zb-brand-<?php echo $item['tid'];?>"><?php echo $item['subject'];?></a>
<?php } ?>					
</div>
<?php } ?>			   
</div>			
</div>
</div>
<div id="sideBarTab">
<a href="http://www.8264.com/zb-public"><div id="sideBarTab_03"></div></a>
<div id="sideBarTab_01"></div>
<div id="sideBarTab_02"></div>
<div class="sideBarTab_close"><img onclick="close_wind()" style="display:none" id="sideBarTab_close" src="http://www.8264.com/source/plugin/produce/images/close.png"></div>
</div>
</div>
<script type="text/javascript">
function close_wind(){
 jQuery('#sideBarContents').fadeOut(1000);
 jQuery('#sideBarTab_close').fadeOut(1000);
 jQuery('#sideBarContents_02').fadeOut(1000);
}
;(function($) {
$(function(){
$('#bianlan .list .list_1 a:first').addClass('selected');
$('#bianlan .list .list_1 a ').live('click', function(){
$('#bianlan .list .list_1 a').removeClass('selected');
$(this).addClass('selected');	
var url=$(this).attr('href');
var txt = url.slice(28);
$('#bianlan .list .list_2 .item').hide(1000);
var show ="#"+txt;
$(show).fadeIn(1500);
return false;
});		
$('#sideBarTab_01').live('click', function() {
 $('#sideBarContents_02').hide();
    $('#sideBarContents').fadeIn(1000);
$('#sideBarTab_close').fadeIn(1000);
});
$('#sideBarTab_02').live('click', function() {
$('#sideBarContents').hide();
    $('#sideBarContents_02').fadeIn(1000);
$('#sideBarTab_close').fadeIn(1000);
});		
$('#bianlan .brandlist .list_1 a').live('click', function(){
$('#bianlan .brandlist .list_1 a').removeClass('selected');
$(this).addClass('selected');	
var zifu = $('#bianlan .brandlist .list_1 .selected').text();
$('#bianlan .brandlist .list_2 .item').hide(1000);
var show ="#"+zifu;
$(show).fadeIn(1500);
return false;
})
});
})(jQuery);
</script>


<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="wp cl">
<?php if($_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
<ul class="p_pop" id="newspecial_menu" style="display: none">
<?php if(!$_G['forum']['allowspecialonly']) { ?><li><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>">发表帖子</a></li><?php } if($_G['group']['allowpostpoll']) { ?><li class="poll"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">发起投票</a></li><?php } if($_G['group']['allowpostreward']) { ?><li class="reward"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">发布悬赏</a></li><?php } if($_G['group']['allowpostdebate']) { ?><li class="debate"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">发起辩论</a></li><?php } if($_G['group']['allowpostactivity']) { ?><li class="activity"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=4">发起活动</a></li><?php } if($_G['group']['allowposttrade']) { ?><li class="trade"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=2">出售商品</a></li><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<li class="popupmenu_option"<?php if($_G['setting']['threadplugins'][$tpid]['icon']) { ?> style="background-image:url(<?php echo $_G['setting']['threadplugins'][$tpid]['icon'];?>)"<?php } ?>><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a></li>
<?php } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<li class="popupmenu_option"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;sortid=<?php echo $id;?>"><?php echo $threadsorts;?></a></li>
<?php } } } ?>
</ul>
<?php } if($modmenu['post']) { ?>
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
<?php if($_G['forum']['ismoderator']) { if($_G['group']['allowwarnpost']) { ?><a href="javascript:;" onclick="modaction('warn')">警告</a><span class="pipe">|</span><?php } if($_G['group']['allowbanpost']) { ?><a href="javascript:;" onclick="modaction('banpost')">屏蔽</a><span class="pipe">|</span><?php } if($_G['group']['allowdelpost']) { ?><a href="javascript:;" onclick="modaction('delpost')">删除</a><span class="pipe">|</span><?php } if($_G['group']['allowstickreply']) { ?><a href="javascript:;" onclick="modaction('stickreply')">置顶</a><span class="pipe">|</span><?php } } if($_G['forum_thread']['pushedaid'] && $allowpostarticle) { ?><a href="javascript:;" onclick="modaction('pushplus', '', 'aid=<?php echo $_G['forum_thread']['pushedaid'];?>', 'portal.php?mod=portalcp&ac=article&op=pushplus')">文章连载</a><span class="pipe">|</span><?php } ?>
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
<?php } ?>
<style>
.clear{ clear:both;}
.brandmid{ margin:auto; margin-bottom:8px;}
.brand_yyall{ border-top:none;}
.brand_yy_f_l{ float:left; width:555px;}
.brand_yy_f_l li{ padding:5px 0px 5px 0px; text-align:left;}
.brand_yy_f_r{ float:right;width:122px;}
.brand_yy_f_r img{ width:110px; height:60px; border:#eee solid 1px; padding:5px;}
.brand_dipu{ background:#f4f4f4; text-align:center; padding:7px 0px 5px 0px; margin-top:5px;}
.brand_yy2{ width:100%; border-top:#eee solid 1px; margin-top:10px; padding-top:10px;}
.brand_yy2 a{ color:#4a85a7;}
.brand_yy2 a:hover{ color:#4a85a7;}
.brand_yy2 span{ float:left; margin-right:20px;} 
.brand_yy2 li{ padding:5px 0px 5px 0px;}
.brand_yy3{ width:100%; border-top:#eee solid 1px; margin-top:10px; padding-top:10px; line-height:1.7;}
.brand_yy3 em{ color:#4a85a7;}
.jianjieall{ width:690px; border:#eee solid 1px; border-top:0; text-align:center;}
.jianjieall img{width:620px; display:block; margin:0 auto; padding:5px 0 0 0;}
.jianjiealltitle{ height:21px; padding:5px 0px 0px 60px; background:url(http://bbs.8264.com/static/image/brand/long_lb.jpg) top left repeat-x; font-size:14px; font-weight: bold;}
.jianjieallcon{ width:670px; padding:10px; line-height:1.7;}
.brand_yyall_r{ width:250px; float:right;}
.brandr_1{ margin-bottom:10px;}
.brandr_box{ width:248px; border:#ebebeb solid 1px;overflow:hidden;}
.brandr_title{ width:236px; height:30px; line-height:30px; padding:0 10px; margin:auto; font-size:12px; font-weight:bold; background:url(http://bbs.8264.com/static/image/brand/sbox_h.jpg) top repeat-x;}
.brandr_con{ width:248px; padding-bottom:10px;}
.brandr_con li{ width:224px; height:25px; padding:2px 5px 2px 10px; margin:0px; overflow:hidden; line-height:25px;background:url(http://bbs.8264.com/static/image/common/dot.gif) 0 12px no-repeat !important;}
.brandr_title1{ height:20px; padding:10px 0px 0px 10px; font-size:12px; font-weight:bold; border-bottom: #e4edf4 solid 4px;}
.brandr_con1{ width:250px; padding-bottom:10px;}
.brandr_con1 li{ width:235px; height:20px; padding:5px 5px 0px 10px; overflow:hidden; line-height:1.8;}
.brandr_title2{ width:236px; height:20px; padding:10px 0px 0px 10px; margin:auto; font-size:12px; font-weight:bold; background:url(http://bbs.8264.com/static/image/brand/title2.jpg) top repeat-x;}
.brandr_title3{ width:236px; height:20px; padding:10px 0px 0px 10px; margin:auto; font-size:12px; font-weight:bold; background:url(http://bbs.8264.com/static/image/brand/toptitle.jpg) top repeat-x;}
.brandr_title4{ width:240px; height:20px; padding:15px 0px 0px 10px; margin:auto; font-size:12px; font-weight:bold; background:url(http://bbs.8264.com/static/image/brand/brandt.jpg) top repeat-x;}
.brandr_con4{ width:250px; background:url(http://bbs.8264.com/static/image/brand/brand_rbg.jpg) top repeat-y;}
.brandr_con4 li{ width:235px; height:20px; padding:5px 5px 0px 10px; overflow:hidden; line-height:1.8;}
.brandr_b4{ width:250px; height:8px; background:url(http://bbs.8264.com/static/image/brand/brandb.jpg) bottom no-repeat;}

#postlist{ border:none;overflow:hidden;width:960px;margin:0 auto;}
#postlist .postlistl{float:left; width:692px;}
#postlist .postlistr{float:right; width:250px;}
.vw dd .pcb{width:600px;}

/*
.bbda{padding-left:0 !important;}
.bbda dt, .bbda dd{float:left !important;display:block !important;margin-left:0 !important;width:615px;}
.bbda .avt{margin-right:8px;width:auto !important;}*/
</style>    
   
<div id="postlist" class="pl bm bmw"><?php $pro = ForumOptionProduce::getProduceInfo($post['tid']); if(($pro['type']==0)) { ?>
<div class="postlistl"><?php $postcount = 0; if(is_array($postlist)) foreach($postlist as $aa => $post) { ?><div id="post_<?php echo $post['pid'];?>">        
<div class="box960">
<div class="prod_lib">
<!--<div class="prod_lib_nav"></div>-->
<div class="prod_lib_main">        
<?php if($post['first']) { ?>
<div class="prod_lib_content_l">
<div class="userinfo">
<div class="user">
<span class="image"><?php echo $post['avatar'];?></span>
<span class="text"><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank"><?php echo $post['author'];?></a></span>
</div><?php $sharenum = ForumOptionProduce::getShareNumber($post['authorid']); ?>   
<div class="stats">
<div class="item">
<a href="http://u.8264.com/home-space-uid-<?php echo $post['authorid'];?>-do-produce-view-me-from-space.html" target="_blank"><div class="name">分享装备</div></a>
<a href="http://u.8264.com/home-space-uid-<?php echo $post['authorid'];?>-do-produce-view-me-from-space.html" target="_blank"><div class="value"><?php echo $sharenum;?></div></a>
</div>
</div>
<ul class="infolist">
<li>
<strong>用 户 组：</strong>
<span><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;gid=<?php echo $post['groupid'];?>" target="_blank"><?php echo $post['authortitle'];?></a></span>
</li>
<li>
<strong>积&nbsp;&nbsp;&nbsp;&nbsp;分：</strong>
<span> <?php echo $post['credits'];?></span>
</li>
<li>
<strong>等&nbsp;&nbsp;&nbsp;&nbsp;级：</strong>
<span><?php showstars($post['stars']); ?></span>
</li>
</ul>

<ul class="buttonlist">
<li class="add_friend">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>&amp;handlekey=addfriendhk_<?php echo $post['authorid'];?>" id="a_friend_li_<?php echo $post['pid'];?>" onclick="showWindow(this.id, this.href, 'get', 1, {'ctrlid':this.id,'pos':'00'});" title="加好友" class="xi2"><em></em>加好友</a>					
</li>
<li class="send_message">
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $post['authorid'];?>&amp;touid=<?php echo $post['authorid'];?>&amp;pmid=0&amp;daterange=2&amp;pid=<?php echo $post['pid'];?>&amp;tid=<?php echo $post['tid'];?>" onclick="showWindow('sendpm', this.href);" title="发消息" class="xi2"><em></em>发消息</a>							
</li>
</ul>                    
<div class="enter_button">
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" title="串个门" class="xi2">点击进入他/她的空间</a>
</div>
</div><?php $share = ForumOptionProduce::getAllproduceRandbyNum(10); ?>    
<?php if($share) { ?>
<div class="product_list">
<div class="ptitle">更多分享</div>
<div class="pcontent">
<ul class="pimglist1"> <?php if(is_array($share)) foreach($share as $thread) { ?>  
<li>
<a title="<?php echo $thread['title'];?>" href="<?php echo PORTAL_HOST;?>zb-<?php echo $thread['tid'];?>" target="_blank"><img src="<?php echo $thread['image'];?>" /></a>
</li>
<?php } ?>   
</ul>        
</div>
</div>
<?php } ?>

<div id="fix-layer">					
<ul id="fix-buttons">
<li class="op1">
<a href="<?php echo PORTAL_HOST;?>zb?from=zbcaidan">首页</a>
</li>
<li class="op2">
<a href="<?php echo PORTAL_HOST;?>zb-public?from=zbcaidan">分享</a>
</li>
<li class="op3">
<a href="<?php echo PORTAL_HOST;?>zb-<?php echo $_G['tid'];?>#f_pst?from=zbcaidan">评论</a>
</li>
<li class="op4">
<a href="<?php echo PORTAL_HOST;?>zb-type-<?php echo $pro['cplx'];?>?from=zbcaidan" title="更多<?php echo $cpxl['tname'];?>分享">分类</a>
</li>
<li class="op5">
<?php if($brand) { ?>
<a href="<?php echo PORTAL_HOST;?>zb-brand-<?php echo $brand['tid'];?>?from=zbcaidan" title="更多<?php echo $brand['subject'];?>分享">品牌</a>
<?php } else { ?>
<a href="<?php echo PORTAL_HOST;?>zb-brand--1?from=zbcaidan">品牌</a>
<?php } ?>
</li>
<li class="op6">
<?php if($brand) { ?>
<a href="<?php echo PORTAL_HOST;?>zb-type-<?php echo $pro['cplx'];?>-brand-<?php echo $brand['tid'];?>?from=zbcaidan" title="更多<?php echo $brand['subject'];?> <?php echo $cpxl['tname'];?>分享">更多</a>
<?php } else { ?>
<a href="<?php echo PORTAL_HOST;?>zb-type-<?php echo $pro['cplx'];?>-brand--1?from=zbcaidan">更多</a>
<?php } ?>
</li>
</ul>

</div>


<script type="text/javascript">
;(function($) {
var btns_top = $('#fix-layer').offset().top;
$(window).scroll(function() {
if ($(document).scrollTop() - 110 > btns_top) {
if ($.browser.msie && $.browser.version == '6.0') {
var top = ($(document).scrollTop() + 5) + 'px';
$('#fix-layer').css({
'position': 'absolute',
'top': top
});
} else {
$('#fix-layer').css({
'position': 'fixed',
'top': '5px'
});
}
$('#fix-layer').show();
} else {
$('#fix-layer').css({
'position': 'static'
});
$('#fix-layer').hide();
}
})
})(jQuery);
</script>			
</div>
<?php } ?>                          
  <?php $pro = ForumOptionProduce::getProduceInfo($post['tid']); if($pro) { ?>
<script type="text/javascript">
//jQuery('.productNavHorizontal .firstType li a[href*="type-<?php echo $pro['cpdl'];?>"]').addClass('on').mouseover();
</script>
<div class="prod_lib_content_r">
<?php if($post['first']) { ?>
<div class="brand_info">
<div class="product_inner">						
<div class="product_info">
<h1><?php echo $pro['cpmc'];?></h1>							
<span><?php if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>

<span class="operate" id="operate">								

<span class="operate_button">
<span class="inner">
操作
<i class="tria"></i>
</span>
</span>

<ul class="operate_list">
<li>
<a href="<?php echo PORTAL_HOST;?>zb-edit-tid-<?php echo $_G['tid'];?>-pid-<?php echo $post['pid'];?><?php if(!empty($_G['gp_modthreadkey'])) { ?>&modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>-page-<?php echo $page;?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<?php } else { ?>编辑<?php } ?></a>
</li>
<li>
<?php if($_G['group']['allowdelpost']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(3, 'delete')">删除</a><?php } ?>
</li>
<?php if($_G['groupid'] == 1 ||$_G['groupid']== 45 ) { ?>
<li class="setzr" <?php if($pro['cpxh']==1) { ?>style="display:none;"<?php } ?>><a class="cpzr" href="#">设为真人秀</a></li>
<li class="setcancel" <?php if($pro['cpxh']==0) { ?>style="display:none;"<?php } ?>><a class="cpqx" href="#">取消标签设定</a></li>
<li class="setdigest" <?php if($pro['digest']==1) { ?>style="display:none;"<?php } ?>><a class="digest" href="#">设为精华</a></li>
<li class="cancel" <?php if($pro['digest']==0) { ?>style="display:none;"<?php } ?>><a class="canceldigest" href="#">取消精华设置</a></li>
<li class="setzd" style="display:none;"><a class="displayorder" href="#">置顶</a></li>
<li class="cancelzd" style="display:none;"><a class="canceldisplayorder" href="#">取消置顶</a></li>
<li class="adc"><a class="czfz" href="javascript:;">操作分值</a></li>
<script type="text/javascript">
var tid = <?php echo $_G['tid'];?>;
;(function($) {
$('.product_info .setzr').click(function(){								
var type = 'zr';											 
 $.ajax({
   type: 'get',			
   url: 'plugin.php?id=produce:ajax_updatecpxh&cpxh='+type+'&tid='+tid,
   success: function(html) {
   if(html=='success'){
   showDialog('设置真人秀成功');
   $('.product_info .setzr').hide();												
   $('.product_info .setcancel').show();															
   }else{
   showDialog('设置失败');
   }
   }
   });
   return false;
});										
$('.product_info .setcancel').click(function(){									
 var type = 'qx';
  $.ajax({
type: 'get',			
url: 'plugin.php?id=produce:ajax_updatecpxh&cpxh='+type+'&tid='+tid,
success: function(html) {																											
if(html=='success'){
showDialog('设置成功');
$('.product_info .setcancel').hide();
$('.product_info .setzr').show();					
}else{
showDialog('设置失败');
}
}
});
return false;
});										
//设置帖子为精华帖操作
$('.product_info .setdigest').click(function(){
var type = 'set';
$.ajax({
type: 'get',			
url: 'plugin.php?id=produce:ajax_updatecpdigest&op='+type+'&tid='+tid,
success: function(html) {																											
if(html=='success'){
showDialog('设置精华帖成功');
$('.product_info .setdigest').hide();
$('.product_info .cancel').show();																		
}else{
showDialog('设置失败');
}
}
});
return false;	
});
//取消帖子精华设置
$('.product_info .cancel').click(function(){
var type = 'cancel';
$.ajax({
type: 'get',			
url: 'plugin.php?id=produce:ajax_updatecpdigest&op='+type+'&tid='+tid,
success: function(html) {																											
if(html=='success'){
showDialog('取消精华帖成功');
$('.product_info .cancel').hide();														
$('.product_info .setdigest').show();													
}else{
showDialog('取消失败');
}
}
});
return false;	
});
//设置帖子为置顶操作
$('.product_info .setzd').click(function(){
var type = 'setzd';
$.ajax({
type: 'get',			
url: 'plugin.php?id=produce:ajax_updatecpdigest&op='+type+'&tid='+tid,
success: function(html) {																											
if(html=='success'){
showDialog('置顶成功');
$('.product_info .setzd').hide();
$('.product_info .cancelzd').show();																		
}else{
showDialog('设置失败');
}
}
});
return false;	
});
//取消置顶设置
$('.product_info .cancelzd').click(function(){
var type = 'cancelzd';
$.ajax({
type: 'get',			
url: 'plugin.php?id=produce:ajax_updatecpdigest&op='+type+'&tid='+tid,
success: function(html) {																											
if(html=='success'){
showDialog('取消置顶成功');
$('.product_info .cancelzd').hide();														
$('.product_info .setzd').show();													
}else{
showDialog('取消失败');
}
}
});
return false;	
});

//操作分值
$('.product_info .czfz').click(function(){																							
showWindow('rankpanel','/plugin.php?id=produce:rankpanel&tid='+tid);		
return false;	
});
})(jQuery);
</script>
<?php } ?>  
</ul>
</span>
<script type="text/javascript">
jQuery('#operate').hover(function() {
jQuery(this).find('.operate_button')
.addClass('operate_button_hover')
.next('.operate_list').show();
}, function() {
jQuery(this).find('.operate_button')
.removeClass('operate_button_hover')
.next('.operate_list').hide();
})
</script>
 <?php } ?></span>	
<div class="product_img">                    
<a href="http://www.8264.com/plugin.php?id=produce:showimage&amp;img=<?php echo $pro['tid'];?>" target="_blank" title="点击查看原图"><img src="<?php echo $pro['cptp'];?>.thumb600.jpg"/></a>                            
</div>
<script type="text/javascript">
var img_max = 600;
if (jQuery('.brand_info .product_img img').width() > img_max) {
jQuery('.brand_info .product_img img').width(img_max);
}
</script>
<div id="info" style="width:650px; padding:0px; float:left;">
<div class="textinfo"><?php $cpdl = ForumOptionProduce::getLxbyproduce($pro['cpdl']); ?>                                                   <?php $string = ForumOptionProduce::getPoduceTypeStringBytId($pro['cplx'],$pro['cpdl']); ?><?php $brand = ForumOptionProduce::getBrandByTid($pro['cppp']); ?>                      
<?php if($string) { ?>
<p>                           
<?php echo $string;?>                                
<?php if($brand) { ?>
> <a href="<?php echo PORTAL_HOST;?>zb-brand-<?php echo $brand['tid'];?>"><?php echo $brand['subject'];?></a>
<?php } else { ?>                                
> <a href="<?php echo PORTAL_HOST;?>zb-brand--1">其他品牌</a>
<?php } ?>	
</p>                          		
<?php } ?>
<p>

</p>
</div>
<?php if($pro['cpjg']) { ?>
<div class="textinfo">
<p>购买价格：￥<?php echo $pro['cpjg'];?></p>
</div>
<?php } if(false&&file_exists(DISCUZ_ROOT.'./source/plugin/produce/priceinclude.php')) { ?><?php include(DISCUZ_ROOT.'./source/plugin/produce/priceinclude.php'); } ?>
<div class="reply_num" style="font-size:14px;">
<a href="<?php echo $_SERVER['REQUEST_URI'];?>#comment"><img src="http://www.8264.com/source/plugin/whither/css/images/icon1.png" title="回复" /></a>
<span><?php echo $_G['forum_thread']['replies'];?></span>条评论
<img src="http://www.8264.com/source/plugin/whither/css/images/icon2.png" title="查看" class="icon2" />
<span><?php echo $_G['forum_thread']['views'];?></span>次查看
</div>                         
<?php if(file_exists(DISCUZ_ROOT.'./source/plugin/brandusers/produceinclude.php')) { ?><?php include(DISCUZ_ROOT.'./source/plugin/brandusers/produceinclude.php'); } ?>									
<div class="reply_num">
<?php if($pro['isused']) { ?>
<span style="font-size:14px;"><?php echo $post['author'];?></span><font style="font-size:14px; color:#666666">真实用过此款装备！</font>
<?php } ?>								
</div>

<div class="reply_num" style="float:right;">

</div> 
</div>    
</div>
</div>
<div class="product_stat"><?php $wants = ForumOptionProduce::getWantitUsers($post['tid'],'want'); ?><?php $wnum = ForumOptionProduce::getNumber($post['tid'],'want'); ?><?php $useds = ForumOptionProduce::getWantitUsers($post['tid'],'used'); ?><?php $usednum = ForumOptionProduce::getNumber($post['tid'],'used'); ?>      

<div class="wawntuse" <?php if($wants==null) { ?> style="display:none"<?php } ?>>
<h5>我喜欢(<span id="wawntuse_num"><?php echo $wnum;?></span>)</h5>
<ul class="user_list">									
<li id="wantuse_curuser" style="display:none"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" title="<?php echo $_G['username'];?>"><?php echo avatar($_G['uid'], 'small'); ?></a></li><?php if(is_array($wants)) foreach($wants as $thread) { ?><?php $sharenum = ForumOptionProduce::getShareNumber($thread[uid]); ?><?php $state = ForumOptionProduce::getMemberState($thread[uid]); ?><div class="showtx">
<div class="sjx">               
</div>
<div style="padding: 7px;">
<a href="home.php?mod=space&amp;uid=<?php echo $thread['uid'];?>" target="_blank">个人空间</a><span style="font-size: 12px;line-height: 12px;position: absolute;right: 7px;top: 4px;cursor: pointer;">x</span><br>
<a href="http://u.8264.com/home-space-uid-<?php echo $thread['uid'];?>-do-produce-view-me-from-space.html" target="_blank">装备分享(<?php echo $sharenum;?>)</a><br>
<a onclick="showWindow('showMsgBox', this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $thread['uid'];?>&amp;touid=<?php echo $thread['uid'];?>&amp;pmid=0&amp;daterange=2" target="_blank">发消息
<?php if($_G['setting']['vtonlinestatus'] && $thread['uid']) { if(($_G['setting']['vtonlinestatus'] == 2 && $_G['forum_onlineauthors'][$thread['uid']]) || ($_G['setting']['vtonlinestatus'] == 1 && (TIMESTAMP - $state['lastactivity'] <= 10800) && !$state['authorinvisible'])) { ?>
<img class="vm" title="在线" alt="online" src="static/image/common/ol.gif">
<?php } else { ?>
<img class="vm" title="离线" alt="online" src="static/image/common/out.jpg">
<?php } } ?>
</a>   
</div>                    
</div>
<li><a class="img" href="home.php?mod=space&amp;uid=<?php echo $thread['uid'];?>" target="_blank" title="<?php echo $thread['username'];?>"><?php echo $thread['avatar'];?></a></li>
<?php } ?>  
</ul>
</div>                 
  
  <?php if($useds) { ?>
<div class="used">
<h5>我用过<span id="used_num">(<?php echo $usednum;?>)</span></h5>
<ul class="user_list"><?php if(is_array($useds)) foreach($useds as $thread) { ?><?php $sharenum = ForumOptionProduce::getShareNumber($thread[uid]); ?><?php $state = ForumOptionProduce::getMemberState($thread[uid]); ?><div class="showtx">
<div class="sjx">               
</div>
<div style="padding: 7px;">
<a href="home.php?mod=space&amp;uid=<?php echo $thread['uid'];?>" target="_blank">个人空间</a><span style="font-size: 12px;line-height: 12px;position: absolute;right: 7px;top: 4px;cursor: pointer;">x</span><br>
<a href="http://u.8264.com/home-space-uid-<?php echo $thread['uid'];?>-do-produce-view-me-from-space.html" target="_blank">装备分享(<?php echo $sharenum;?>)</a><br>
<a onclick="showWindow('showMsgBox', this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $thread['uid'];?>&amp;touid=<?php echo $thread['uid'];?>&amp;pmid=0&amp;daterange=2" target="_blank">发消息<?php if($_G['setting']['vtonlinestatus'] && $thread['uid']) { if(($_G['setting']['vtonlinestatus'] == 2 && $_G['forum_onlineauthors'][$thread['uid']]) || ($_G['setting']['vtonlinestatus'] == 1 && (TIMESTAMP - $state['lastactivity'] <= 10800) && !$state['authorinvisible'])) { ?><img class="vm" title="在线" alt="online" src="static/image/common/ol.gif"><?php } else { ?><img class="vm" title="离线" alt="online" src="static/image/common/out.jpg"><?php } } ?>
</a>   
</div>                    
</div>
<li id="used_<?php echo $thread['id'];?>">
<a href="home.php?mod=space&amp;uid=<?php echo $thread['uid'];?>" target="_blank" class="img"><?php echo $thread['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['uid'];?>" target="_blank" class="name"><?php echo $thread['username'];?></a>
<span class="quotes_begin"><span class="quotes_end">
<?php echo $thread['message'];?>
</span></span>
<?php if($thread['price']) { ?>
<span class="price"><?php echo $thread['price'];?>元购买</span>
<?php } if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { if($_G['groupid'] == 1 ||$_G['groupid']== 45 ) { ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span style="font-size:12px;"><a class="plsc_<?php echo $thread['id'];?>" href="#"><font style="color:#0069A0">删除</font></a></span>
<script type="text/javascript">
;(function($) {	
$('.product_stat .plsc_<?php echo $thread['id'];?>').click(function(){									
var puid = <?php echo $thread['id'];?>;
var uuid = <?php echo $thread['uid'];?>;
var ttid = <?php echo $_G['tid'];?>;								
$.ajax({
  type: 'get',			
  url: 'plugin.php?id=produce:ajax_deletecpused&puid='+puid+'&uuid='+uuid+'&ttid='+ttid,
  success: function(html) {																											
  if(html=='success'){
  showDialog('删除成功');
  location.reload();
  }else{
  showDialog('删除失败');
  }
  }
  });
return false;									
});
})(jQuery);	
</script>
<?php } } ?>
</li>
<?php } ?>  
</ul>
</div>
  <?php } ?>                
  
</div>
</div>
<div class="brand_info_more">
<h2>产品详情</h2>
<div class="brand_info_more_cont">

 <br><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,680)',$post["message"]); ?><?php echo $post['message'];?>
<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>

</div>                
</div>				
 

<?php if($sticklist) { ?>
<div class="bm vw pl" id="comment" style="width:698px;">
  <div class="bm_h cl">
  <h2>精彩评论</h2>
  </div>
  <div>
  <?php if(is_array($sticklist)) foreach($sticklist as $rpost) { ?>        
  <div class="pstl xs1" style="padding-top:10px; padding-left:10px;"><?php $sharenum = ForumOptionProduce::getShareNumber($rpost['authorid']); ?> <div class="showtx">
<div class="sjx">               
</div>
<div style="padding: 7px;">
<a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" target="_blank">个人空间</a><span style="font-size: 12px;line-height: 12px;position: absolute;right: 7px;top: 4px;cursor: pointer;">x</span><br>
<a href="http://u.8264.com/home-space-uid-<?php echo $rpost['authorid'];?>-do-produce-view-me-from-space.html" target="_blank">装备分享(<?php echo $sharenum;?>)</a><br>
<a onclick="showWindow('showMsgBox', this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $rpost['authorid'];?>&amp;touid=<?php echo $rpost['authorid'];?>&amp;pmid=0&amp;daterange=2" target="_blank">发消息
<?php if($_G['setting']['vtonlinestatus'] && $rpost['authorid']) { if(($_G['setting']['vtonlinestatus'] == 2 && $_G['forum_onlineauthors'][$rpost['authorid']]) || ($_G['setting']['vtonlinestatus'] == 1 && (TIMESTAMP - $post['lastactivity'] <= 10800) && !$post['authorinvisible'])) { ?>
<img class="vm" title="在线" alt="online" src="static/image/common/ol.gif">
<?php } else { ?>
<img class="vm" title="离线" alt="online" src="static/image/common/out.jpg">
<?php } } ?>
</a>   
</div>                    
  </div>
  <div class="psta"><a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" c="1"><?php echo $rpost['avatar'];?></a></div>
  <div class="psti">
  <p>
  <a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" class="xi2 xw1"><?php echo $rpost['author'];?></a> 
  <span class="xi2">
  &nbsp;
  <?php if($_G['group']['allowstickreply']) { ?>&nbsp;<a href="javascript:;" onclick="modaction('stickreply', <?php echo $rpost['pid'];?>, '&undo=yes')" class="xi2">解除置顶</a><?php } ?>
  </span>
  </p>
  <div class="mtn">
  <?php $rpost['message']=str_replace('thumbImg(this)','thumbImg(this,null,680)',$rpost["message"]); ?><?php echo $rpost['message'];?>
   <?php if(!empty($aimgs[$rpost['pid']])) { ?>
   <script type="text/javascript" reload="1">aimgcount[<?php echo $rpost['pid'];?>] = [<?php echo implode(',', $aimgs[$rpost['pid']]);; ?>];attachimgshow(<?php echo $rpost['pid'];?>);</script>
   <?php } ?> 
  </div>
  </div>
  </div>					 
  <?php } ?>
  </div>
</div> 
<?php } ?>


<div class="brand_comments_write">					
<?php if($_G['setting']['fastpost'] && $allowpostreply && !$_G['forum_thread']['archiveid'] && ($_G['forum']['status'] != 3 || $_G['isgroupuser'])) { ?>            
 <script type="text/javascript">

var postminchars = parseInt(1);

var postmaxchars = parseInt('<?php echo $_G['setting']['maxpostsize'];?>');

var disablepostctrl = parseInt('<?php echo $_G['group']['disablepostctrl'];?>');

</script>



<div id="f_pst" class="pl<?php if(empty($_G['gp_from'])) { ?> bm bmw<?php } ?>">

<form method="post" autocomplete="off" id="fastpostproduceform" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes<?php if($_G['gp_ordertype'] != 1) { ?>&amp;infloat=yes&amp;handlekey=fastpost<?php } if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>"<?php if($_G['gp_ordertype'] != 1) { ?> onSubmit="return fastpostvalidateproduce(this)"<?php } ?>>

<?php if(empty($_G['gp_from'])) { ?>

<table cellspacing="0" cellpadding="0">

<tr>

<td class="plc">

<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_content'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_content']; ?>



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



<div class="cl">

<?php if(empty($_G['gp_from']) && $_G['setting']['fastsmilies']) { ?><div id="fastsmiliesdiv" class="y"><div id="fastsmiliesdiv_data"></div></div><?php } ?>

<div<?php if(empty($_G['gp_from']) && $_G['setting']['fastsmilies']) { ?> class="hasfsl"<?php } ?>>

<div class="tedt<?php if(!($_G['forum_thread']['special'] == 5 && empty($firststand))) { ?> mtn<?php } ?>">

<div class="bar">

<span class="y">

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_func_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_func_extra']; if($_G['setting']['magicstatus'] && !empty($_G['setting']['magics']['doodle'])) { ?>

<a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=fastpostmessage&amp;from=fastpost" onclick="showWindow(this.id, this.href, 'get', 0)"><?php echo $_G['setting']['magics']['doodle'];?></a>

<span class="pipe">|</span>

<?php } ?>

<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="return switchAdvanceMode(this.href)">上传图片请点击高级模式</a>



</span><?php $seditor = array('fastpost', array('bold', 'color', 'img', 'link', 'quote', 'code', 'smilies'), $guestreply ? 1 : 0); ?><?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra']; if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="深灰色"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="蓝色"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="红色"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<style type="text/css">
#pmimg_menu #pmimg_param_1 {width:93%!important;}
</style>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?> style="margin-left:5px;">图片</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>表情</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } ?></div>

<div class="area">

<?php if(!$guestreply) { ?>

<textarea rows="5" cols="80" name="message" id="fastpostmessage" onKeyDown="seditor_ctlent(event, <?php if($_G['gp_ordertype'] != 1) { ?>'fastpostvalidate($(\'fastpostform\'))'<?php } else { ?>'$(\'fastpostform\').submit()'<?php } ?>);" tabindex="4" class="pt"></textarea>

<?php } else { ?>

<div class="pt hm">你需要登录后才可以回帖 <a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">登录</a> | <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="showWindow('register', this.href)" class="xi2"><?php echo $_G['setting']['reglinkname'];?></a><?php if($_G['setting']['connect']['allow']) { ?> | <a href="<?php echo $_G['connect']['login_url'];?>&statfrom=viewthread_fastpostbrand" target="_top" rel="nofollow"><img src="<?php echo IMGDIR;?>/qq_login.gif" class="vm" /></a><?php } ?></div>

<?php } ?>

</div>

</div>

<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id)"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>

<div class="mtm sec"><?php include template('common/seccheck'); ?></div>

<?php } ?>

<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />

<input type="hidden" name="subject" value="" />

                        <div style="padding-top:4px;">希望您的评论，能为大家提供一个全面并客观的参考意见。所以请不要发任何无实际意义的评论内容。</div>

<p class="ptm">

<button <?php if(!$guestreply) { ?>type="submit" <?php } else { ?>type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')" <?php } ?>name="replysubmit" id="fastpostsubmit" class="pn vm" value="replysubmit" tabindex="5"><strong>发表回复</strong></button>

</p>

</div>

</div>

<?php if(empty($_G['gp_from'])) { ?>

</td>

       

</tr>

</table>

<?php } ?>

</form>

</div>            
<?php } ?>               
</div>




<div class="brand_comments">
<div class="bm vw pl">
<div class="bm_h cl">
<h2>最新评论</h2>
</div>                
<div class="bm_c">
<div id="commentsList">
<div id="postlistreply" class="xld xlda mbm"><div id="post_new" class="viewthread_table" style="display: none;border: none;"></div></div>
 <?php if(is_array($postlist)) foreach($postlist as $postid => $post) { if($postid && !$post['first']) { ?>		
<div id="post_<?php echo $post['pid'];?>" class="xld xlda mbm"><?php $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']); ?><dl class="bbda cl" id="pid<?php echo $post['pid'];?>" style="width:605px;overflow:hidden;">		
<?php if($post['author'] && !$post['anonymous']) { ?><?php $sharenum = ForumOptionProduce::getShareNumber($post['authorid']); ?><div class="showtx">
<div class="sjx">               
</div>
<div style="padding: 7px;">
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank">个人空间</a><span style="font-size: 12px;line-height: 12px;position: absolute;right: 7px;top: 4px;cursor: pointer;">x</span><br>
<a href="http://u.8264.com/home-space-uid-<?php echo $post['authorid'];?>-do-produce-view-me-from-space.html" target="_blank">装备分享(<?php echo $sharenum;?>)</a><br>
<a onclick="showWindow('showMsgBox', this.href, 'get', 0);" href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $post['authorid'];?>&amp;touid=<?php echo $post['authorid'];?>&amp;pmid=0&amp;daterange=2" target="_blank">发消息</a>   
</div>                    
</div>
<dd class="m avt" style="margin-bottom:0;padding-bottom:8px;"><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>"><?php echo avatar($post[authorid], small); ?></a></dd>
<?php } else { ?>
<dd class="m avt" style="margin-bottom:0;padding-bottom:8px;"><img src="<?php echo STATICURL;?>image/magic/hidden.gif" alt="hidden" /></dd>
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
<?php } if($allowpostreply && $post['invisible'] == 0) { ?>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;reppost=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="showWindow('reply', this.href)">回复</a>
<?php if(!$needhiddenreply) { ?>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="showWindow('reply', this.href)">引用</a>
<?php } } if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>
<a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_G['gp_modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<?php } else { ?>编辑</a><?php } } ?>
</span>
<?php if($post['authorid'] && !$post['anonymous']) { if(!$_G['setting']['authoronleft']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="xi2"><?php echo $post['author'];?></a><?php echo $authorverifys;?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; ?>
<em id="author_<?php echo $post['pid'];?>"><?php echo $post['author'];?></em>
<?php } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
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
<?php } if($post['number']==1 && $_G['uid']) { ?>
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
<div style="text-align:right;">
<?php if(!$post['first'] && $modmenu['post']) { ?>
<span class="y">
<label for="manage<?php echo $post['pid'];?>">
<input type="checkbox" id="manage<?php echo $post['pid'];?>" class="pc" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $post['pid'];?>)" value="<?php echo $post['pid'];?>" autocomplete="off" />
管理
</label>
</span>
<?php } ?>
</div>
</dd>

</dl>


<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_endline'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_endline'][$postcount]; ?>

</div>
<?php } } if($multipage) { ?>
<div class="pgs cl"><?php echo $multipage;?></div>
<?php } ?>
</div>
</div>		
</div>			
</div>	
</div>			

<?php } ?>	
<?php } ?>		
</div>
</div>
</div>
<div class="clear"></div>
</div>		
<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>       
</div>
    <?php $postcount++; } ?>
</div>

</div>
<?php } else { ?>
<style type="text/css">
#postlist .postlistl{width: 960px;}
#postlist .postlistl .opt{float: right;margin-right: 5px;}
</style>
<div class="postlistl"><?php if(is_array($postlist)) foreach($postlist as $aa => $post) { if($post['first']) { ?>
<div class="zbbqtitle">	
<?php if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { if($_G['group']['allowdelpost']) { ?><?php $modopt++ ?><a class="opt" href="javascript:;" onclick="modthreads(3, 'delete')">删除</a><?php } ?>
<a class="opt" href="http://bbs.8264.com/forum.php?mod=post&amp;action=edit&amp;fid=437&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=1&amp;bq=2">编辑</a>
<?php } ?>		
</div>	
<div class="team-top-intro">
<div class="intro-l">
<div class="ico"></div>
<h5><?php echo $pro['cpmc'];?></h5>
<p>
 <?php $post['message']=trim(str_replace('<br />','',$post[message])); ?> <?php if($post['message']!="") { ?>
 <?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,680)',$post["message"]); ?><?php echo $post['message'];?>
 <?php if(!empty($aimgs[$post['pid']])) { ?>
 <script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
 <?php } ?>
 <?php } else { ?>
 这个专辑的装备已经好到无法用语言来描述啦！！！
 <?php } ?>
</p>
</div>
<div class="intro-r">
<div class="count-num">
<p><span>宝贝</span><b><?php echo $pro['count'];?></b></p>
<p><span>浏览</span><b><?php echo $_G['forum_thread']['views'];?></b></p>
</div>
</div>
</div>	
<?php } } ?><?php $products = ForumOptionProduce::getBqProducebyId($pro['tid']); ?><?php $products_array = array(array(), array(),array(), array()); $i = 0; if(count($products) > 3) { ?><?php $products_array[0][] = $products[0]; unset($products[0]); ?><?php $products_array[1][] = $products[1]; unset($products[1]); ?><?php $products_array[2][] = $products[2]; unset($products[2]); ?><?php $products_array[3][] = $products[3]; unset($products[3]); ?><?php $products = array_merge($products, array()); } ?><?php foreach ($products as $product): ?><?php $products_array[$i%4][] = $product; ?><?php ++$i; ?><?php endforeach; ?><style type="text/css">
.bm_box{padding: 0px;}	
.grid_4col_zb{width: 232px;}
</style>
<div class="bqbox" style="width: 960px;float: left;margin-top: 4px;"><?php include DISCUZ_ROOT.'/template/default/forum/viewthread_from_product.php'; ?><div class="grid_4col_zb alpha_zb"><?php if(is_array($products_array['0'])) foreach($products_array['0'] as $product) { ?><div><?php render_product($product); ?></div>
<?php } ?>
</div>
<div class="grid_4col_zb"><?php if(is_array($products_array['1'])) foreach($products_array['1'] as $product) { ?><div><?php render_product($product); ?></div>
<?php } ?>
</div>
<div class="grid_4col_zb"><?php if(is_array($products_array['2'])) foreach($products_array['2'] as $product) { ?><div><?php render_product($product); ?></div>
<?php } ?>
</div>
<div class="grid_4col_zb omega_zb"><?php if(is_array($products_array['3'])) foreach($products_array['3'] as $product) { ?><div><?php render_product($product); ?></div>
<?php } ?>
</div>
<div class="clear"></div>
<div id="loadding_ico">
<span>正在加载...</span>
</div>
<script src="/static/js/jquery.tmpl.min.js" type="text/javascript"></script><?php include DISCUZ_ROOT.'/template/default/forum/product_template.php'; ?><script type="text/javascript">
;(function($) {
function getMinHeightBoxIndex() {
var min_height = jQuery('.grid_4col_zb').eq(0).height();
var min_index = 0;
var box_num = jQuery('.grid_4col_zb').size();
for (var i = 1; i < box_num; ++i) {
if (jQuery('.grid_4col_zb').eq(i).height() < min_height) {
min_height = jQuery('.grid_4col_zb').eq(i).height();
min_index = i;
}
}
return min_index;
}

var load_lock = false,
page = <?php echo $page;?>,
ppp = 100,
offset = (page - 1) * ppp + 30,
limit = 30,
tid = <?php echo $post['tid'];?>

function auto_load(force) {
if (load_lock) {
return;
}

var window_height = $(window).scrollTop() + $(window).height() * 3,
loadding_ico_top = $('#loadding_ico').offset().top;


if (force || window_height >= loadding_ico_top) {
var url = '/plugin.php?id=produce:ajax_getproductbycpxh&offset='+offset+'&limit='+limit+'&tid='+tid;

load_lock = true;
$('#loadding_ico span').css('display', 'inline-block');
$.getJSON(
url,
function(data) {
if (typeof data !== 'undefine' && data.count > 0) {
for (var i in data.products) {
var product = data.products[i];
product['img_height'] = product['index_height'] > 0 ? product['index_height'] > 600 ? 600 : product['index_height']+'px' : 'auto';
$('#productTemplate').tmpl(data.products[i]).css('display', 'none').appendTo($('.grid_4col_zb').eq(getMinHeightBoxIndex())).fadeIn(1000);
}
}											
// 返回数据为limit(数据完整返回)
// 己加载数据小于每页最大数据
if (data.count == limit && offset + limit < ppp * page) {
var num = ppp * page - (offset + limit);
offset += num < limit ? num : limit;
load_lock = false;
}										
$('#loadding_ico span').css('display', 'none');
}
);
}
}						

$(window).scroll(function() {
auto_load();			
}).resize(function() {								
auto_load();
});		
})(jQuery);
</script>											
</div>

</div>	
</div>
<?php } ?>




<form method="post" autocomplete="off" name="modactions" id="modactions">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="optgroup" />
<input type="hidden" name="operation" />
<input type="hidden" name="listextra" value="<?php echo $_G['gp_extra'];?>" />
</form>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_middle'])) echo $_G['setting']['pluginhooks']['viewthread_middle']; ?>
<!--[diy=diyfastposttop]--><div id="diyfastposttop" class="area"></div><!--[/diy]-->


<?php if(!empty($_G['setting']['pluginhooks']['viewthread_bottom'])) echo $_G['setting']['pluginhooks']['viewthread_bottom']; if($_G['setting']['visitedforums'] || $oldthreads) { ?>
<div id="visitedforums_menu" class="<?php if($oldthreads) { ?>visited_w <?php } ?>p_pop blk cl" style="display: none;">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if($_G['setting']['visitedforums']) { ?>
<td id="v_forums">
<h3 class="mbn pbn bbda xg1">浏览过的版块</h3>
<ul>
<?php echo $_G['setting']['visitedforums'];?>
</ul>
</td>
<?php } if($oldthreads) { ?>
<td id="v_threads">
<h3 class="mbn pbn bbda xg1">浏览过的帖子</h3>
<ul class="xl"><?php if(is_array($oldthreads)) foreach($oldthreads as $oldtid => $oldsubject) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $oldtid;?>"><?php echo $oldsubject;?></a></li>
<?php } ?>
</ul>
</td>
<?php } ?>
</tr>
</table>
</div>
<?php } if($_G['setting']['forumjump']) { ?>
<div class="p_pop" id="fjump_menu" style="display: none">
<?php echo $forummenu;?>
</div>
<?php } if($_G['setting']['connect']['allow'] && $page == 1) { ?>
<script type="text/javascript">
var connect_uin = '<?php echo $_G['member']['conuin'];?>';
var connect_sid = '<?php echo $_G['setting']['connectsiteid'];?>';
var connect_share_api = '<?php echo $_G['connect']['share_api'];?>';
var connect_t_api = '<?php echo $_G['connect']['t_api'];?>';
var connect_thread_info = {
thread_id: '<?php echo $_G['tid'];?>',
post_id: '<?php echo $_G['connect']['first_post']['pid'];?>',
s_id: '<?php echo $_G['setting']['connectsiteid'];?>',
uin: '<?php echo $_G['member']['conuin'];?>',
forum_id: '<?php echo $_G['fid'];?>',
author_id: '<?php echo $_G['connect']['first_post']['authorid'];?>',
author: '<?php echo $_G['connect']['first_post']['author'];?>',
access_token: '<?php echo $_G['cookie']['client_token'];?>',
share_channel: '<?php echo $_G['connect']['share_channel'];?>'
};

connect_autoshare = '<?php echo $_G['gp_connect_autoshare'];?>';
connect_isbind = '<?php echo $_G['member']['conisbind'];?>';
if(connect_autoshare == 1 && connect_isbind) {
_attachEvent(window, 'load', function(){
connect_share(connect_share_api, connect_uin, connect_sid);
});
}
</script>
<div id="connect_share_unbind" style="display: none;">
<div class="c hm">
<div style="font-size:14px; margin:10px 0;">绑定QQ账号，轻松分享到QQ空间与腾讯微博</div>
<div><a href="connect.php?mod=config&amp;connect_autoshare=1" target="_blank"><img src="<?php echo IMGDIR;?>/qq_bind.gif" align="absmiddle" style="margin-top:5px;" /></a></div>
</div>
<input type="hidden" id="connect_thread_title" name="connect_thread_title" value="<?php echo $_G['forum_thread']['subject'];?>" />
</div>
<?php } if(!IS_ROBOT && $_G['setting']['threadmaxpages'] > 1) { ?>
<script type="text/javascript">document.onkeyup = function(e){keyPageScroll(e, <?php if($page > 1) { ?>1<?php } else { ?>0<?php } ?>, <?php if($page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']) { ?>1<?php } else { ?>0<?php } ?>, 'forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?><?php if($_G['gp_authorid']) { ?>&authorid=<?php echo $_G['gp_authorid'];?><?php } ?>', <?php echo $page;?>);}</script>
<?php } ?>
</div>
<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>
<script src="http://static.acs86.com/g.js" type="text/javascript"></script></div>
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