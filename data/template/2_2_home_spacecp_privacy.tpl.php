<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_privacy', 'common/header');
0
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/8264/common/header.htm', 1501671055, '2', './data/template/2_2_home_spacecp_privacy.tpl.php', './template/8264', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/default/home/spacecp_header.htm', 1501671055, '2', './data/template/2_2_home_spacecp_privacy.tpl.php', './template/8264', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/default/home/spacecp_footer.htm', 1501671055, '2', './data/template/2_2_home_spacecp_privacy.tpl.php', './template/8264', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/8264/common/footer.htm', 1501671055, '2', './data/template/2_2_home_spacecp_privacy.tpl.php', './template/8264', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/8264/common/header_common.htm', 1501671055, '2', './data/template/2_2_home_spacecp_privacy.tpl.php', './template/8264', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/default/common/simplesearchform.htm', 1501671055, '2', './data/template/2_2_home_spacecp_privacy.tpl.php', './template/8264', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/default/home/spacecp_header_name.htm', 1501671055, '2', './data/template/2_2_home_spacecp_privacy.tpl.php', './template/8264', 'home/spacecp_privacy')
|| checktplrefresh('./template/default/home/spacecp_privacy.htm', './template/default/home/spacecp_header_name.htm', 1501671055, '2', './data/template/2_2_home_spacecp_privacy.tpl.php', './template/8264', 'home/spacecp_privacy')
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
<link href="http://static.8264.com/static/css/home/home_spacecp.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css"><div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
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
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em>
<a href="home.php?mod=spacecp">设置</a> <em>&rsaquo;</em><?php if($actives['profile']) { ?>
个人资料
<?php } elseif($actives['verify']) { ?>
认证
<?php } elseif($actives['avatar']) { ?>
修改头像
<?php } elseif($actives['credit']) { ?>
积分
<?php } elseif($actives['usergroup']) { ?>
用户组
<?php } elseif($actives['privacy']) { ?>
隐私筛选
<?php } elseif($actives['sendmail']) { ?>
邮件提醒
<?php } elseif($actives['password']) { ?>
密码安全
<?php } elseif($actives['qq']) { ?>
QQ绑定
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><?php if($actives['profile']) { ?>
个人资料
<?php } elseif($actives['verify']) { ?>
认证
<?php } elseif($actives['avatar']) { ?>
修改头像
<?php } elseif($actives['credit']) { ?>
积分
<?php } elseif($actives['usergroup']) { ?>
用户组
<?php } elseif($actives['privacy']) { ?>
隐私筛选
<?php } elseif($actives['sendmail']) { ?>
邮件提醒
<?php } elseif($actives['password']) { ?>
密码安全
<?php } elseif($actives['qq']) { ?>
QQ绑定
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></h1>
<!--don't close the div here--><ul class="tb cl">
<li<?php echo $opactives['base'];?>><a href="home.php?mod=spacecp&amp;ac=privacy&amp;op=base">个人隐私设置</a></li>
<li<?php echo $opactives['feed'];?>><a href="home.php?mod=spacecp&amp;ac=privacy&amp;op=feed">个人动态发布设置</a></li>
<li<?php echo $opactives['filter'];?>><a href="home.php?mod=spacecp&amp;ac=privacy&amp;op=filter">动态筛选</a></li>
</ul>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=privacy&amp;op=<?php echo $operation;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />

<?php if($operation == 'base') { ?>
<p class="tbmu mbm">你可以完全控制哪些人可以看到你的主页上面的内容</p>
<table cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th>个人主页</th>
<td>
<select name="privacy[view][index]">
<option value="0"<?php echo $sels['view']['index']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['index']['1'];?>>相互关注的人可见</option>
<option value="2"<?php echo $sels['view']['index']['2'];?>>保密</option>
<option value="3"<?php echo $sels['view']['index']['3'];?>>仅注册用户可见</option>
</select>
</td>
</tr>
<tr>
<th>好友列表</th>
<td>
<select name="privacy[view][friend]">
<option value="0"<?php echo $sels['view']['friend']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['friend']['1'];?>>相互关注的人可见</option>
<option value="2"<?php echo $sels['view']['friend']['2'];?>>保密</option>
<option value="3"<?php echo $sels['view']['friend']['3'];?>>仅注册用户可见</option>
</select>
</td>
</tr>
<tr>
<th>留言板</th>
<td>
<select name="privacy[view][wall]">
<option value="0"<?php echo $sels['view']['wall']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['wall']['1'];?>>相互关注的人可见</option>
<option value="2"<?php echo $sels['view']['wall']['2'];?>>保密</option>
<option value="3"<?php echo $sels['view']['wall']['3'];?>>仅注册用户可见</option>
</select>
</td>
</tr>
<tr>
<th>动态</th>
<td>
<select name="privacy[view][home]">
<option value="0"<?php echo $sels['view']['home']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['home']['1'];?>>相互关注的人可见</option>
<option value="3"<?php echo $sels['view']['home']['3'];?>>仅注册用户可见</option>
</select>
</td>
</tr>
<tr>
<th>说说</th>
<td>
<select name="privacy[view][doing]">
<option value="0"<?php echo $sels['view']['doing']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['doing']['1'];?>>相互关注的人可见</option>
<option value="3"<?php echo $sels['view']['doing']['3'];?>>仅注册用户可见</option>
</select>
<p class="d">本隐私设置仅在其他用户查看你主页时有效。<br />在全站的记录列表中可能会出现你的记录。</p>
</td>
</tr>
<tr>
<th>日志</th>
<td>
<select name="privacy[view][blog]">
<option value="0"<?php echo $sels['view']['blog']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['blog']['1'];?>>相互关注的人可见</option>
<option value="3"<?php echo $sels['view']['blog']['3'];?>>仅注册用户可见</option>
</select>
<p class="d">本隐私设置仅在其他用户查看你主页时有效。<br />相关浏览权限需要在每篇日志中单独设置方可完全生效。</p>
</td>
</tr>
<tr>
<th>相册</th>
<td>
<select name="privacy[view][album]">
<option value="0"<?php echo $sels['view']['album']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['album']['1'];?>>相互关注的人可见</option>
<option value="3"<?php echo $sels['view']['album']['3'];?>>仅注册用户可见</option>
</select>
<p class="d">本隐私设置仅在其他用户查看你主页时有效。<br />相关浏览权限需要在每篇日志中单独设置方可完全生效。</p>
</td>
</tr>
<tr>
<th>分享</th>
<td>
<select name="privacy[view][share]">
<option value="0"<?php echo $sels['view']['share']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['share']['1'];?>>相互关注的人可见</option>
<option value="3"<?php echo $sels['view']['share']['3'];?>>仅注册用户可见</option>
</select>
<p class="d">本隐私设置仅在其他用户查看你主页时有效。<br />相关浏览权限需要在每篇日志中单独设置方可完全生效。</p>
</td>
</tr>
<?php if($_G['setting']['videophoto'] && $space['videophotostatus']) { ?>
<tr>
<th>&nbsp;</th>
<td><img src="<?php echo IMGDIR;?>/videophoto.gif" alt="" class="vm" /> 你已经通过视频认证，对于没有通过视频认证的用户，你可以设置以下权限:</td>
</tr>
<tr>
<th>查看认证照片</th>
<td>
<select name="privacy[view][videoviewphoto]">
<option value="0"<?php echo $sels['view']['videoviewphoto']['0'];?>>站点默认设置</option>
<option value="1"<?php echo $sels['view']['videoviewphoto']['1'];?>>允许 </option>
<option value="2"<?php echo $sels['view']['videoviewphoto']['2'];?>>禁止</option>
</select>
</td>
</tr>
<tr>
<th>向我申请好友</th>
<td>
<select name="privacy[view][videofriend]">
<option value="0"<?php echo $sels['view']['videofriend']['0'];?>>站点默认设置</option>
<option value="1"<?php echo $sels['view']['videofriend']['1'];?>>允许 </option>
<option value="2"<?php echo $sels['view']['videofriend']['2'];?>>禁止</option>
</select>
</td>
</tr>
<tr>
<th>向我打招呼</th>
<td>
<select name="privacy[view][videopoke]">
<option value="0"<?php echo $sels['view']['videopoke']['0'];?>>站点默认设置</option>
<option value="1"<?php echo $sels['view']['videopoke']['1'];?>>允许 </option>
<option value="2"<?php echo $sels['view']['videopoke']['2'];?>>禁止</option>
</select>
</td>
</tr>
<tr>
<th>给我留言</th>
<td>
<select name="privacy[view][videowall]">
<option value="0"<?php echo $sels['view']['videowall']['0'];?>>站点默认设置</option>
<option value="1"<?php echo $sels['view']['videowall']['1'];?>>允许 </option>
<option value="2"<?php echo $sels['view']['videowall']['2'];?>>禁止</option>
</select>
</td>
</tr>
<tr>
<th>评论我的信息</th>
<td>
<select name="privacy[view][videocomment]">
<option value="0"<?php echo $sels['view']['videocomment']['0'];?>>站点默认设置</option>
<option value="1"<?php echo $sels['view']['videocomment']['1'];?>>允许 </option>
<option value="2"<?php echo $sels['view']['videocomment']['2'];?>>禁止</option>
</select>
</td>
</tr>
<?php } ?>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="privacysubmit" value="true" class="pn pnp" /><strong>保存</strong></button></td>
</tr>
</table>

<?php } elseif($operation == 'feed') { ?>
<p class="tbmu mbm">系统会将你的各项动作反映到个人动态里，方便朋友了解你的动态。<br />你可以控制是否在下列动作发生时，在个人动态里发布相关信息。</p>
<table cellspacing="0" cellpadding="0" id="feed" class="tfm">
<tr>
<th>&nbsp;</th>
<td class="pcl">
<label><input type="checkbox" class="pc" name="privacy[feed][doing]" value="1"<?php echo $sels['feed']['doing'];?> />说说</label>
<label><input type="checkbox" class="pc" name="privacy[feed][blog]" value="1"<?php echo $sels['feed']['blog'];?> />撰写日志</label>
<label><input type="checkbox" class="pc" name="privacy[feed][upload]" value="1"<?php echo $sels['feed']['upload'];?> />上传图片</label>
<label><input type="checkbox" class="pc" name="privacy[feed][share]" value="1"<?php echo $sels['feed']['share'];?> />添加分享</label>
<label><input type="checkbox" class="pc" name="privacy[feed][friend]" value="1"<?php echo $sels['feed']['friend'];?> />添加好友</label>
<label><input type="checkbox" class="pc" name="privacy[feed][comment]" value="1"<?php echo $sels['feed']['comment'];?> />发表评论/留言</label>
<label><input type="checkbox" class="pc" name="privacy[feed][show]" value="1"<?php echo $sels['feed']['show'];?> />竞价排名</label>
<label><input type="checkbox" class="pc" name="privacy[feed][credit]" value="1"<?php echo $sels['feed']['credit'];?> />积分消费</label>
<label><input type="checkbox" class="pc" name="privacy[feed][invite]" value="1"<?php echo $sels['feed']['invite'];?> />邀请好友</label>
<label><input type="checkbox" class="pc" name="privacy[feed][task]" value="1"<?php echo $sels['feed']['task'];?> />完成任务</label>
<label><input type="checkbox" class="pc" name="privacy[feed][profile]" value="1"<?php echo $sels['feed']['profile'];?> />更新个人资料</label>
<label><input type="checkbox" class="pc" name="privacy[feed][click]" value="1"<?php echo $sels['feed']['click'];?> />对日志/图片表态</label>
<label><input type="checkbox" class="pc" name="privacy[feed][newthread]" value="1"<?php echo $sels['feed']['newthread'];?> />论坛发帖</label>
<label><input type="checkbox" class="pc" name="privacy[feed][newreply]" value="1"<?php echo $sels['feed']['newreply'];?> />论坛回帖</label>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="privacysubmit" value="true" class="pn pnp" /><strong>保存</strong></button></td>
</tr>
</table>

<?php } else { ?><?php $iconnames['wall'] = '留言板';
$iconnames['piccomment'] = '图片评论';
$iconnames['blogcomment'] = '日志评论';
$iconnames['sharecomment'] = '分享评论';
$iconnames['magic'] = '道具';
$iconnames['sharenotice'] = '分享通知';
$iconnames['clickblog'] = '日志表态';
$iconnames['clickpic'] = '图片表态';
$iconnames['credit'] = '积分';
$iconnames['doing'] = '说说';
$iconnames['pcomment'] = '话题点评';
$iconnames['post'] = '话题回复';
$iconnames['show'] = '排行榜';
$iconnames['task'] = '任务';
$iconnames['goods'] = '商品';
$iconnames['group'] = $_G[setting][navs][3][navname];
$iconnames['thread'] = '话题';
$iconnames['system'] = '系统';
$iconnames['friend'] = '好友';
$iconnames['debate'] = '辩论';
$iconnames['album'] = '相册';
$iconnames['blog'] = '日志';
$iconnames['poll'] = '投票';
$iconnames['activity'] = '活动';
$iconnames['reward'] = '悬赏';
$iconnames['share'] = '分享';
$iconnames['profile'] = '更新个人资料';
$iconnames['pusearticle'] = '生成文章'; ?><table cellspacing="0" cellpadding="0" class="tfm bbda">
<caption>
<h2 class="wx xw1">筛选规则一：屏蔽指定用户组的动态</h2>
<p class="xg1">你可以决定屏蔽哪些用户组的动态，屏蔽用户组内的组员所发布的动态都将被屏蔽掉(仅限查看好友的动态时生效)。</p>
</caption>
<tr>
<th>&nbsp;</th>
<td class="pcl"><?php if(is_array($groups)) foreach($groups as $key => $value) { ?><label><input type="checkbox" class="pc" name="privacy[filter_gid][<?php echo $key;?>]" value="<?php echo $key;?>"<?php if(isset($space['privacy']['filter_gid'][$key])) { ?> checked="checked"<?php } ?> /><?php echo $value;?></label>
<?php } ?>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<button type="submit" name="privacy2submit" value="true" class="pn pnp" /><strong>保存</strong></button>
<p class="d">你可以在自己的<a href="home.php?mod=space&amp;do=friend">好友列表</a>中，对好友进行分组，并可以对用户组进行改名。</span>
</td>
</tr>
</table>

<table cellspacing="0" cellpadding="0" class="tfm bbda">
<caption>
<h2 class="wx xw1">筛选规则二：屏蔽指定好友指定类型的动态</h2>
<p class="xg1">点击一下首页好友动态列表后面的屏蔽标志，就可以屏蔽指定好友指定类型的动态了。<br />下面列出的是你已经屏蔽的动态类型识别名和好友名，你可以选择是否取消屏蔽。</p>
</caption>
<?php if($icons) { ?>
<tr>
<th>&nbsp;</th>
<td class="pcl"><?php if(is_array($icons)) foreach($icons as $key => $icon) { ?><?php $uid = $uids[$key];$icon_uid="$icon|$uid"; ?><label>
<?php if(is_numeric($icon)) { ?>
<img src="http://appicon.manyou.com/icons/<?php echo $icon;?>" alt="" class="vm" />
<?php } else { ?>
<img src="<?php echo STATICURL;?>image/feed/<?php echo $icon;?>.gif" alt="" class="vm" />
<?php } ?>
<input type="checkbox" class="pc" name="privacy[filter_icon][<?php echo $icon_uid;?>]" value="1" checked="checked" /> 
<?php if(isset($iconnames[$icon])) { ?><?php echo $iconnames[$icon];?><?php } else { ?><?php echo $icon;?><?php } ?> (<?php if($users[$uid]) { ?><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $users[$uid];?></a><?php } else { ?>全部好友<?php } ?>)
</label>
<?php } ?>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="privacy2submit" value="true" class="pn pnp" /><strong>保存</strong></button></td>
</tr>
<?php } else { ?>
<tr>
<th>&nbsp;</th>
<td class="d">现在还没有屏蔽的动态类型</td>
</tr>
<?php } ?>
</table>

<table cellspacing="0" cellpadding="0" class="tfm">
<caption>
<h2 class="wx xw1">筛选规则三：屏蔽指定好友指定类型的通知</h2>
<p class="xg1">点击一下通知列表后面的屏蔽标志，就可以屏蔽指定好友指定类型的通知了。<br />下面列出的是你已经屏蔽的通知类型和好友名，你可以选择是否取消屏蔽。</p>
</caption>
<?php if($types) { ?>
<tr>
<th>&nbsp;</th>
<td><?php if(is_array($types)) foreach($types as $key => $type) { ?><?php $uid = $uids[$key];$type_uid="$type|$uid"; ?><label>
<input type="checkbox" class="pc" name="privacy[filter_note][<?php echo $type_uid;?>]" value="1" checked="checked" />
<?php if(isset($iconnames[$type])) { ?><?php echo $iconnames[$type];?><?php } else { ?><?php echo $type;?><?php } ?> (<?php if($users[$uid]) { ?><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $users[$uid];?></a><?php } else { ?>全部好友<?php } ?>)
</label>
<?php } ?>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="privacy2submit" value="true" class="pn pnp" /><strong>保存</strong></button></td>
</tr>
<?php } else { ?>
<tr>
<th>&nbsp;</th>
<td class="d">现在还没有屏蔽的动态类型</td>
</tr>
<?php } ?>
</table>
<?php } ?>
</form>
</div>
</div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">设置</h2>
<ul>
<?php if($_G['setting']['connect']['allow']) { ?>
<li<?php echo $actives['qq'];?>><a href="connect.php?mod=config">QQ绑定</a></li>
<?php } ?>
<li<?php echo $actives['avatar'];?>><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li<?php echo $actives['profile'];?>><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?php echo $actives['verify'];?>><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li<?php echo $actives['credit'];?>><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li<?php echo $actives['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li<?php echo $actives['privacy'];?>><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?><li<?php echo $actives['sendmail'];?>><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li><?php } ?>
<li<?php echo $actives['password'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>
</div></div>
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