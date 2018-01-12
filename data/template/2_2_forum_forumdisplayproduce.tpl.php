<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplayproduce', 'common/header');
0
|| checktplrefresh('./template/default/forum/forumdisplayproduce.htm', './template/8264/common/header.htm', 1501537782, '2', './data/template/2_2_forum_forumdisplayproduce.tpl.php', './template/8264', 'forum/forumdisplayproduce')
|| checktplrefresh('./template/default/forum/forumdisplayproduce.htm', './template/8264/common/zbtjbbs.htm', 1501537782, '2', './data/template/2_2_forum_forumdisplayproduce.tpl.php', './template/8264', 'forum/forumdisplayproduce')
|| checktplrefresh('./template/default/forum/forumdisplayproduce.htm', './template/default/common/simplesearchform.htm', 1501537782, '2', './data/template/2_2_forum_forumdisplayproduce.tpl.php', './template/8264', 'forum/forumdisplayproduce')
|| checktplrefresh('./template/default/forum/forumdisplayproduce.htm', './template/default/forum/recommend.htm', 1501537782, '2', './data/template/2_2_forum_forumdisplayproduce.tpl.php', './template/8264', 'forum/forumdisplayproduce')
|| checktplrefresh('./template/default/forum/forumdisplayproduce.htm', './template/8264/common/footer.htm', 1501537782, '2', './data/template/2_2_forum_forumdisplayproduce.tpl.php', './template/8264', 'forum/forumdisplayproduce')
|| checktplrefresh('./template/default/forum/forumdisplayproduce.htm', './template/8264/common/header_common.htm', 1501537782, '2', './data/template/2_2_forum_forumdisplayproduce.tpl.php', './template/8264', 'forum/forumdisplayproduce')
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

<div id="wp" class="wp"><?php $isDefault = $_GET['orderby']==null ? true : false; ?><link rel="stylesheet" href="/source/plugin/produce/css/style.css" />
<script src="http://www.8264.com/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
</script>
<?php if($_G['forum']['ismoderator']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>
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
<a href="./" id="fjump"<?php if($_G['setting']['forumjump'] == 1) { ?> onmouseover="showMenu({'ctrlid':this.id})"<?php } ?> class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <?php echo $navigation;?>
</div>
</div>

<div id="goTop">
    <a href="#" class="cursor" onclick="javascript:void(0)"></a>
</div>
<script src="/source/plugin/produce/js/jQuery-gotop.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery('#goTop').goTop();
</script>



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


<style type="text/css">
#showtip {}
#showtip .showtx{width:100px;height:66px;z-index:88;background-color:#F7F7F7;border:1px solid #ccc;margin-top: 5px;margin-bottom: 10px;position: absolute;}
#showtip .showtx .sjx{background: url("http://www.8264.com/source/plugin/produce/images/sjx_float_.gif") no-repeat scroll 5px 0 transparent;height: 18px;left: -11px;position: absolute;top: 7px;width: 19px;}
.coljg{margin:4px 4.5px;}
</style>

<div id="showtip">
</div>
<script type="text/javascript">
;(function($) {
    $(function(){
$('.grid_4col .product_item .product_userinfo_face a').live('click', function() {			
if ($.browser.msie && $.browser.version == '6.0') {
var top = $(this).offset().top-6,
    left = $(this).offset().left+43;				
}else{
var top = $(this).offset().top -28,
    left = $(this).offset().left+43;
}
$('#showtip').empty().append(
$(this).parent('.product_userinfo_face').prev('.showtx').clone().css({top: top, left:left})
    );
return false;
});
$('body').live('click', function() {
    $('#showtip').empty();
})
});

})(jQuery);
</script>


<script type="text/javascript">
function test(tid){
showWindow('rankpanel','/plugin.php?id=produce:rankpanel&tid='+tid);		
return false;
}
</script>

<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
<div class="mn" style="display:none;">
<div class="bm bml">
<?php if($_G['forum']['banner'] && !$subforumonly) { ?><img src="<?php echo $_G['forum']['banner'];?>" width="100%" alt="<?php echo $_G['forum']['name'];?>" /><?php } ?>
<div class="bm_h cl">
<?php if($_G['page'] == 1 && $_G['forum']['rules']) { ?><span class="o"><img id="forum_rules_<?php echo $_G['fid'];?>_img" src="<?php echo IMGDIR;?>/collapsed_<?php echo $collapse['forum_rulesimg'];?>.gif" title="收起/展开" alt="收起/展开" onclick="toggle_collapse('forum_rules_<?php echo $_G['fid'];?>')" /></span><?php } ?>
<span class="y">
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=forum&amp;id=<?php echo $_G['fid'];?>&amp;handlekey=favoriteforum" id="a_favorite" class="fa_fav" onclick="showWindow(this.id, this.href, 'get', 0);">收藏本版</a>
<?php if(rssforumperm($_G['forum']) && $_G['setting']['rssstatus'] && !$_G['gp_archiveid'] && !$subforumonly) { ?><span class="pipe">|</span><a href="forum.php?mod=rss&amp;fid=<?php echo $_G['fid'];?>&amp;auth=<?php echo $rssauth;?>" class="fa_rss" target="_blank" title="RSS">订阅</a><?php } if(!empty($forumarchive)) { ?>
<span class="pipe">|</span><a id="forumarchive" href="javascript:;" class="fa_achv" onmouseover="showMenu(this.id)"><?php if($_G['gp_archiveid']) { ?><?php echo $forumarchive[$_G['gp_archiveid']]['displayname'];?><?php } else { ?>存档<?php } ?></a>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_forumaction'])) echo $_G['setting']['pluginhooks']['forumdisplay_forumaction']; if($_G['forum']['ismoderator']) { if($_G['forum']['recyclebin']) { ?>
<span class="pipe">|</span><a href="<?php if($_G['adminid'] == 1) { ?>admin.php?mod=forum&action=recyclebin&frames=yes<?php } elseif($_G['forum']['ismoderator']) { ?>forum.php?mod=modcp&action=recyclebins&fid=<?php echo $_G['fid'];?><?php } ?>" class="fa_bin" target="_blank">回收站</a>
<?php } if($_G['forum']['ismoderator'] && !$_G['gp_archiveid']) { ?>
<span class="pipe">|</span><strong>
<?php if($_G['forum']['status'] != 3) { ?>
<a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>">管理面板</a>
<?php } else { ?>
<a href="forum.php?mod=group&amp;action=manage&amp;fid=<?php echo $_G['fid'];?>">管理面板</a>
<?php } ?>
</strong>
<?php } if($_G['forum']['modworks']) { if($modnum) { ?><span class="pipe">|</span><a href="forum.php?mod=modcp&amp;action=moderate&amp;op=threads&amp;fid=<?php echo $_G['fid'];?>" target="_blank">待审核帖(<?php echo $modnum;?>)</a><?php } if($modusernum) { ?><span class="pipe">|</span><a href="forum.php?mod=modcp&amp;action=moderate&amp;op=members&amp;fid=<?php echo $_G['fid'];?>" target="_blank">待审核用户(<?php echo $modusernum;?>)</a><?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_modlink'])) echo $_G['setting']['pluginhooks']['forumdisplay_modlink']; } ?>
</span>
<h1 class="xs2">
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>"><?php echo $_G['forum']['name'];?></a>
<?php if(!$subforumonly) { ?><span class="xs1 xw0 i">今日: <strong class="xi1"><?php echo $_G['forum']['todayposts'];?></strong><span class="pipe">|</span>主题: <strong class="xi1"><?php echo $_G['forum']['threads'];?></strong></span><?php } ?>
</h1>
</div>
<div class="bm_c cl">
<?php if(!empty($_G['forum']['domain']) && !empty($_G['setting']['domain']['root']['forum'])) { ?>
<div class="pbn">本版域名:<a href="http://<?php echo $_G['forum']['domain'];?>.<?php echo $_G['setting']['domain']['root']['forum'];?>" id="group_link">http://<?php echo $_G['forum']['domain'];?>.<?php echo $_G['setting']['domain']['root']['forum'];?></a></div>
<?php } if($moderatedby) { ?><div class="pbn">版主: <span class="xi2"><?php echo $moderatedby;?></span></div><?php } if($_G['page'] == 1 && $_G['forum']['rules']) { ?>
<div id="forum_rules_<?php echo $_G['fid'];?>" style="<?php echo $collapse['forum_rules'];?>;">
<div class="pbm xg2"><?php echo $_G['forum']['rules'];?></div>
</div>
<?php } ?>
<div id="forumarchive_menu" class="p_pop" style="display:none">
<ul>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>">全部主题</a></li><?php if(is_array($forumarchive)) foreach($forumarchive as $id => $info) { ?><li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;archiveid=<?php echo $id;?>"><?php echo $info['displayname'];?> (<?php echo $info['threads'];?>)</a></li>
<?php } ?>
</ul>
</div>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_top'])) echo $_G['setting']['pluginhooks']['forumdisplay_top']; if($subexists && $_G['page'] == 1) { include template('forum/forumdisplay_subforum'); } ?>
<div class="drag">
<!--[diy=diy4]--><div id="diy4" class="area"></div><!--[/diy]-->
</div>
<?php if(!empty($_G['forum']['recommendlist'])) { ?>
<div class="bm bmw">
<div class="bm_h cl">
<h2>推荐主题</h2>
</div>
<div class="bm_c cl"><?php if($_G['forum']['recommendlist']['images'] && $_G['forum']['modrecommend']['imagenum']) { ?>
<div class="cl" style="width: <?php echo $_G['forum']['modrecommend']['imagewidth'];?>px; margin: 0 auto; float:left;">
<script type="text/javascript">
var slideSpeed = 5000;
var slideImgsize = [<?php echo $_G['forum']['modrecommend']['imagewidth'];?>,<?php echo $_G['forum']['modrecommend']['imageheight'];?>];
var slideBorderColor = '<?php echo SPECIALBORDER;?>';
var slideBgColor = '<?php echo COMMONBG;?>';
var slideImgs = new Array();
var slideImgLinks = new Array();
var slideImgTexts = new Array();
var slideSwitchColor = '<?php echo TABLETEXT;?>';
var slideSwitchbgColor = '<?php echo COMMONBG;?>';
var slideSwitchHiColor = '<?php echo SPECIALBORDER;?>';<?php if(is_array($_G['forum']['recommendlist']['images'])) foreach($_G['forum']['recommendlist']['images'] as $k => $imginfo) { ?>slideImgs[<?php echo $k+1; ?>] = '<?php echo $imginfo['filename'];?>';
slideImgLinks[<?php echo $k+1; ?>] = 'forum.php?mod=viewthread&tid=<?php echo $imginfo['tid'];?>';
slideImgTexts[<?php echo $k+1; ?>] = '<?php echo $imginfo['subject'];?>';
<?php } ?>
</script>
<script src="<?php echo $_G['setting']['jspath'];?>forum_slide.js?<?php echo VERHASH;?>" type="text/javascript"></script>
</div>
<?php } ?>
<div class="cl"<?php if($_G['forum']['recommendlist']['images'] && $_G['forum']['modrecommend']['imagenum']) { ?> style="margin-left: <?php echo $_G['forum']['modrecommend']['imagewidth'];?>px; padding-left: 20px;"<?php } ?>><?php unset($_G['forum']['recommendlist']['images']); ?><ul class="xl<?php if(!$_G['forum']['allowside']) { ?> xl2<?php } ?> cl"><?php if(is_array($_G['forum']['recommendlist'])) foreach($_G['forum']['recommendlist'] as $rtid => $recommend) { ?><li>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $rtid;?>" <?php echo $recommend['subjectstyles'];?> target="_blank"><?php echo $recommend['subject'];?></a>
</li>
<?php } ?>
</ul>
</div></div>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_middle'])) echo $_G['setting']['pluginhooks']['forumdisplay_middle']; if(!$subforumonly) { if($recommendgroups && !$_G['forum']['allowside']) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>推荐<?php echo $_G['setting']['navs']['3']['navname'];?></h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($recommendgroups)) foreach($recommendgroups as $key => $group) { ?><li>
<a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" title="<?php echo $group['name'];?>" target="_blank" class="avt"><img src="<?php echo $group['icon'];?>" alt="<?php echo $group['name'];?>"></a>
<p><a href="forum.php?mod=group&amp;fid=<?php echo $group['fid'];?>" target="_blank"><?php echo $group['name'];?></a></p>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($threadmodcount) { ?><div class="bm bmn hm xi2"><strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me&amp;type=thread&amp;from=&amp;filter=aduit">你有 <?php echo $threadmodcount;?> 个主题正等待审核中，点击查看</a></strong></div><?php } ?>            
      <?php } ?>	
</div>

<div class="box960"><?php $condition = array(); if($_GET['orderby']=='digest') { ?><?php $isDefault = 0; ?><?php $isFilter = 1; ?><?php $_G['gp_orderby']="digest"; } ?>	
<?php if(!empty($_GET['filter'])) { ?>
    <?php if($_GET['filter']=="cpxh" ) { ?><?php $isZrx = 1; ?>    <?php $_G['gp_orderby']="cpxh"; } if($_GET['filter']=="isworth" ) { ?><?php $isWorth = 1; ?>    <?php $_G['gp_orderby']="isworth"; } ?><?php $condition['digest'] = $_GET['filter']; } if($isDefault) { ?>	   <?php $products = ForumOptionProduce::loadCacheArray("zbindex"); } else { ?><?php $products = ForumOptionProduce::getProductList($condition, ($_G['gp_orderby']?$_G['gp_orderby']." DESC":null), (($_G['page']-1)*300).',40'); } ?><?php $products_array = array(array(), array(), array(), array()); $i = 0; if(count($products) > 3) { ?><?php $products_array[0][] = $products[0]; unset($products[0]); ?><?php $products_array[1][] = $products[1]; unset($products[1]); ?><?php $products_array[2][] = $products[2]; unset($products[2]); ?><?php $products = array_merge($products, array()); } ?><?php foreach ($products as $product): ?><?php $products_array[$i%4][] = $product; ?><?php ++$i; ?><?php endforeach; ?><?php include DISCUZ_ROOT.'/template/default/forum/viewthread_from_product.php'; ?>    <div class="grid_4col alpha">	
    	<?php if(false) { ?>
<div class="productSelectBox">
<ul class="pro_condition pro_button_list">
<li><a<?php if($isDefault) { ?> class="on"<?php } ?> href="<?php echo PORTAL_HOST;?>zb"><span>默认</span></a></li>
<li><a<?php if($_G['gp_orderby']=='dateline') { ?> class="on"<?php } ?> href="<?php echo PORTAL_HOST;?>zb-filter-author-orderby-dateline<?php echo $forumdisplayadd['author'];?><?php if($_G['gp_archiveid']) { ?>&archiveid=<?php echo $_G['gp_archiveid'];?><?php } ?>"><span>最新</span></a></li>
<li><a<?php if($_G['gp_orderby']=='heats' && !$isDefault) { ?> class="on"<?php } ?> href="<?php echo PORTAL_HOST;?>zb-filter-heat-orderby-heats<?php echo $forumdisplayadd['heat'];?><?php if($_G['gp_archiveid']) { ?>&archiveid=<?php echo $_G['gp_archiveid'];?><?php } ?>"><span>热门</span></a></li>				
<li><a<?php if($_G['gp_orderby']=='cpxh') { ?> class="on"<?php } ?> href="<?php echo PORTAL_HOST;?>zb-filter-cpxh-orderby-digest<?php echo $forumdisplayadd['cpxh'];?><?php if($_G['gp_archiveid']) { ?>&archiveid=<?php echo $_G['gp_archiveid'];?><?php } ?>"><span>真人秀</span></a></li>		
<li><a href="http://bbs.8264.com/forum-408-1.html?from=zb" target="_blank"><span>品牌列表</span></a></li>

<li><a href="<?php echo PORTAL_HOST;?>zb-type-2" target="_blank"><span>专题列表</span></a></li>

</ul><?php $cpdl = ForumOptionProduce::getTypeData(); if($cpdl) { ?>
<ul class="pro_class pro_button_list">
<li><a href="<?php echo PORTAL_HOST;?>zb" class="on all"><span>所有</span></a></li><?php if(is_array($cpdl)) foreach($cpdl as $dl) { ?><li><a href="<?php echo PORTAL_HOST;?>zb-type-<?php echo $dl['id'];?>" target="_parent"><span><img src="http://www.8264.com/template/8264/image/forum_produce/<?php echo $dl['id'];?>.gif" alt="<?php echo $dl['tname'];?>" /><?php echo $dl['tname'];?></span></a></li>
<?php } ?>
</ul>
<?php } ?>
</div>
<?php } ?><?php $daren = ForumOptionProduce::getZhuangbeiDaren(0); if($daren) { ?>
<div class="productSelectBox bordColor">
<div class="hrr"></div>
<h2>装备达人</h2>			
<div class="zbdr"><?php if(is_array($daren)) foreach($daren as $dr) { ?><div class="face">
<div class="tx"><a href="http://u.8264.com/home-space-uid-<?php echo $dr['uid'];?>-do-produce-view-me-from-space.html" target="_blank"><?php echo $dr['avatar'];?></a></div>							
<div class="descrip">
    <div class="triangle"><a href="http://u.8264.com/home-space-uid-<?php echo $dr['uid'];?>-do-produce-view-me-from-space.html" target="_blank"><?php echo $dr['uname'];?></a></div>
<span><?php echo $dr['description'];?></span>
    </div>	
</div>
<div class="drimage">
<ul class="drpic"><?php $pic = ForumOptionProduce::getPiclist($dr['tids']); if(is_array($pic)) foreach($pic as $pics) { ?><li><a href="<?php echo PORTAL_HOST;?>zb-<?php echo $pics['tid'];?>" target="_blank"><img src="<?php echo $pics['cptp'];?>" /></a></li>
<?php } ?>
</ul>
</div>
<div class="hr"></div>
<?php } ?>			
</div>					
</div>
<div class="productSelectBox">
<a href="http://bbs.8264.com/thread-1146523-1-1.html" target="_blank"><img src="source/plugin/produce/images/rhcwzbdr.png" style="margin-bottom: 10px;"/></a>
</div>
<?php } if(is_array($products_array['3'])) foreach($products_array['3'] as $product) { ?><div><?php render_product($product); ?></div>
<?php } ?>
    </div>
    <div class="grid_4col"><?php if(is_array($products_array['0'])) foreach($products_array['0'] as $product) { ?><div><?php render_product($product); ?></div>
<?php } ?>
    </div>
    <div class="grid_4col"><?php if(is_array($products_array['1'])) foreach($products_array['1'] as $product) { ?><div><?php render_product($product); ?></div>
<?php } ?>
    </div>
    <div class="grid_4col omega">
    <?php if(is_array($products_array['2'])) foreach($products_array['2'] as $product) { ?><div><?php render_product($product); ?></div>
<?php } ?>
    </div>
<div class="clear"></div>
<div id="loadding_ico">
<span>正在加载...</span>
</div>
    <div class="bm bw0 pgs cl">
<?php echo $multipage;?>
    </div>

<script src="/static/js/jquery.tmpl.min.js" type="text/javascript"></script><?php include DISCUZ_ROOT.'/template/default/forum/product_template.php'; ?><script type="text/javascript">
;(function($) {
function getMinHeightBoxIndex() {
var min_height = jQuery('.grid_4col').eq(0).height();
var min_index = 0;
var box_num = jQuery('.grid_4col').size();
for (var i = 1; i < box_num; ++i) {
if (jQuery('.grid_4col').eq(i).height() < min_height) {
min_height = jQuery('.grid_4col').eq(i).height();
min_index = i;
}
}
return min_index;
}

var load_lock = false,
page = <?php echo $page;?>,
ppp = 300,
offset = (page - 1) * ppp + 40,
limit = 20;

       

function auto_load(force) {
$('.product_item .stat span').css('display','block');
if (load_lock) {
return;
}

var window_height = $(window).scrollTop() + $(window).height() * 3,
loadding_ico_top = $('#loadding_ico').offset().top;			


if (force || window_height >= loadding_ico_top) {
var url = '/plugin.php?id=produce:ajax_products&offset='+offset+'&limit='+limit+'&orderby=<?php echo $_G['gp_orderby'];?><?php echo $isDefault ? '&default=1' : '' ?><?php echo $isFilter ? '&filter=digest' : '' ?><?php echo $isZrx ? '&filter=cpxh' : '' ?><?php echo $isWorth ? '&filter=isworth' : '' ?>';
               
load_lock = true;
$('#loadding_ico span').css('display', 'inline-block');
$.getJSON(
url,
function(data) {
if (typeof data !== 'undefine' && data.count > 0) {
for (var i in data.products) {
var product = data.products[i];
product['img_height'] = product['index_height'] > 0 ? product['index_height'] > 600 ? 600 : product['index_height']+'px' : 'auto';
$('#productTemplate').tmpl(data.products[i])
.css('display', 'none').appendTo($('.grid_4col').eq(getMinHeightBoxIndex())).fadeIn(1000);
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
auto_load(true);

})(jQuery);
</script>
</div>
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