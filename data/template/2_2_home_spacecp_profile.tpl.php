<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_profile', 'common/header');
0
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/8264/common/header.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/home/spacecp_header.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/home/spacecp_footer.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/home/spacecp_profile_nav.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/8264/common/seditor_2014.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/home/spacecp_footer.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/8264/common/footer.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/8264/common/header_common.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/common/simplesearchform.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/home/spacecp_header_name.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
|| checktplrefresh('./template/default/home/spacecp_profile.htm', './template/default/home/spacecp_header_name.htm', 1509433882, '2', './data/template/2_2_home_spacecp_profile.tpl.php', './template/8264', 'home/spacecp_profile')
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
������ŮͼƬ_¿��ͼƬ_����Ļ�����Ů��Ƭ
<?php } else { ?>
            <?php echo $metakeywords;?>
            <?php if($_G['setting']['bbname']) { ?> - <?php echo $_G['setting']['bbname'];?><?php } } } else { ?>
            <?php if($_GET['do']=="produce"&&$_G['uid']) { ?>
               <?php echo $navtitle;?><?php echo "��װ������"; ?>             <?php } elseif($_G['basescript']=='group') { if($_G['uid']) { ?>
<?php echo $navtitle;?>
<?php } else { ?><?php $navtitle ='Ⱥ�� - 8264'; ?><?php echo $navtitle;?>
<?php } } else { ?><?php $navtitle = preg_replace('/�ļ�¼/', '��΢��', $navtitle); if(!empty($topic['title'])) { ?><?php echo $topic['title'];?><?php } if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if($_G['setting']['bbname']) { ?><?php echo $_G['setting']['bbname'];?><?php } ?>
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
/* ͷ��������� */
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
/* ��̳��ҳ Start */
.layout { width: 980px; margin: 0 auto; }
.layoutLeft { float: left; display: inline; width: 660px; }
.layoutRight { float: right; display: inline; width: 260px; }
.w980 { width: 980px; margin: 0 auto; }
.oldad .textAdBox{width: 100%;}
.wp .oldad{width: 98%;}

/* ͷ��������� */
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
//ͳ�ƾɰ�Ŀ�ĵ�
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
<a id="diy-tg" href="javascript:openDiy();" title="�� DIY ���"><img src="http://static.8264.com/static/image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?>    <?php if($_G['setting']['mobile']['allowmobile'] && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')) { ?>
    	<div class="xi1 bm bm_c">
            ������ʹ���ֻ������ - <a href="<?php echo $_G['siteurl'];?>forum.php?mobile=yes">�����ֻ���</a> <span class="xg1">|</span> <a href="<?php echo $_G['setting']['mobile']['nomobileurl'];?>">�������ʲ�����ʾ</a>
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
<strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="vwmy"<?php if($_G['setting']['connect']['allow'] && $_G['member']['conisbind']) { ?> style="background:url(http://static.8264.com/static/image/common/connect_qq.gif) no-repeat scroll 0 0px;padding-left:20px"<?php } ?> target="_blank" title="�����ҵĿռ�"><?php echo $_G['member']['username'];?></a></strong>

<?php if($_G['group']['allowinvisible']) { ?><span id="loginstatus" class="xg1"><a href="http://u.8264.com/member.php?mod=switchstatus" title="�л�����״̬" onClick="ajaxget(this.href, 'loginstatus');doane(event);"><?php if($_G['session']['invisible']) { ?>����<?php } else { ?>����<?php } ?></a></span><?php } ?>
                <?php if($_G['setting']['taskon']) { ?>
<span class="pipe">|</span>
<?php if(empty($_G['cookie']['taskdoing_'.$_G['uid']])) { ?>
<a href="home.php?mod=task&amp;item=new">����</a>
<?php } else { ?>
<a href="home.php?mod=task&amp;item=doing" id="task_ntc" class="new">�����е�����</a>
<?php } } ?><span class="pipe">|</span><a href="home.php?mod=space&amp;do=friend">����</a> <?php if($_G['setting']['regstatus'] > 1) { ?><a href="home.php?mod=spacecp&amp;ac=invite" class="xg1">����</a> <?php } ?>

<span class="pipe">|</span><span id="usersetup" class="xg1 showmenu" onMouseOver="showMenu(this.id);"><a href="home.php?mod=spacecp">����</a></span>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1']; ?>
<span style="display:none;"><?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1']; ?></span>
<span class="pipe">|</span><a href="http://u.8264.com/home.php?mod=space&amp;do=notice" id="myprompt"<?php if($_G['member']['newprompt']) { ?> class="new"<?php } ?>>����<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?></a><span id="myprompt_check"></span>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=notice&amp;type=smessage" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>����Ϣ<?php if($_G['member']['newpm']) { ?>(<?php echo $_G['member']['newpm'];?>)<?php } ?></a>
<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?><span class="pipe">|</span><a href="portal.php?mod=portalcp">�Ż�����</a><?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?><span class="pipe">|</span><a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>����</a><?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?><span class="pipe">|</span><a href="admin.php" target="_blank">��������</a><?php } ?>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">�˳�</a>
<?php if(!$_G['cookie']['forcewidthauto']) { ?>
<span class="pipe">|</span><a id="wh" href="javascript:;" onClick="widthauto(this)"><?php if($_G['cookie']['widthauto']==2 || !$_G['uid']) { ?>�л������<?php } else { ?>�л���խ��<?php } ?></a>
<?php } } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<strong><a id="loginuser"><?php echo $_G['cookie']['loginuser'];?></a></strong>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">����</a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">�˳�</a>
<?php } else { if($_G['setting']['connect']['allow']) { ?>
<span class="pipe">|</span>
<?php } ?>
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href);hideWindow('login');"><?php echo $_G['setting']['reglinkname'];?></a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">��¼</a>
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
                <!--//��̳ͷ�����//-->
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
                <b style="color:#F00;">�����Ź���</b>
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
<span class="sslct_btn" onClick="extstyle('')" title="Ĭ��"><i>&nbsp;</i></span><?php if(is_array($_G['style']['extstyle'])) foreach($_G['style']['extstyle'] as $extstyle) { ?><span class="sslct_btn" onClick="extstyle('<?php echo $extstyle['0'];?>')" title="<?php echo $extstyle['1'];?>"><i style='background:<?php echo $extstyle['2'];?>'>&nbsp;</i></span>
<?php } ?>
</div>
<?php } } else { ?>
<p class="reg_tip">
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href)" class="xi2">ע�����û�����ͨ�Լ��ĸ�������</a>
</p>
<?php } ?>
</div>

<div id="nv">
<a href="home.php" id="qmenu" onMouseOver="showMenu(this.id)">�ҵ�����</a>
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
<link href="http://static.8264.com/static/css/home/home_spacecp.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<style type="text/css">
#td_interest { line-height:1.8; padding-right:20px;}
#td_interest label {}
input.pc { margin-right:7px;}
.tfm input { vertical-align:middle;}
</style><div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="��������">��������</label></li>
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
 /><label for="mod_article" title="��������">����</label></li>
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
 /><label for="mod_thread" title="����{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
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
 /><label for="mod_blog" title="������־">��־</label></li>
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
 /><label for="mod_album" title="�������">���</label></li>
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
 /><label for="mod_group" title="����{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="�����û�">�û�</label></li>
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
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">����</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="��������������" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">����</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?><div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em>
<a href="home.php?mod=spacecp">����</a> <em>&rsaquo;</em><?php if($actives['profile']) { ?>
��������
<?php } elseif($actives['verify']) { ?>
��֤
<?php } elseif($actives['avatar']) { ?>
�޸�ͷ��
<?php } elseif($actives['credit']) { ?>
����
<?php } elseif($actives['usergroup']) { ?>
�û���
<?php } elseif($actives['privacy']) { ?>
��˽ɸѡ
<?php } elseif($actives['sendmail']) { ?>
�ʼ�����
<?php } elseif($actives['password']) { ?>
���밲ȫ
<?php } elseif($actives['qq']) { ?>
QQ��
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><?php if($actives['profile']) { ?>
��������
<?php } elseif($actives['verify']) { ?>
��֤
<?php } elseif($actives['avatar']) { ?>
�޸�ͷ��
<?php } elseif($actives['credit']) { ?>
����
<?php } elseif($actives['usergroup']) { ?>
�û���
<?php } elseif($actives['privacy']) { ?>
��˽ɸѡ
<?php } elseif($actives['sendmail']) { ?>
�ʼ�����
<?php } elseif($actives['password']) { ?>
���밲ȫ
<?php } elseif($actives['qq']) { ?>
QQ��
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></h1>
<!--don't close the div here--><?php if($validate) { ?>
<p class="tbmu mbm">����Ա��������ע�����룬������ע��ԭ�������ύ����</p>
<form action="member.php?mod=regverify" method="post" autocomplete="off">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<table summary="��������" cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th>���ԭ��</th>
<td><?php echo $validate['remark'];?></td>
<td>&nbsp;</td>
</tr>
<tr>
<th>ע��ԭ��</th>
<td><input type="text" class="px" name="regmessagenew" value="" /></td>
<td>&nbsp;</td>
</tr>
<tr>
<th>&nbsp;</th>
<td colspan="2">
<button type="submit" name="verifysubmit" value="true" class="pn pnp" /><strong>�����ύ����</strong></button>
</td>
</tr>
</table>
</div></div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">����</h2>
<ul>
<?php if($_G['setting']['connect']['allow']) { ?>
<li<?php echo $actives['qq'];?>><a href="connect.php?mod=config">QQ��</a></li>
<?php } ?>
<li<?php echo $actives['avatar'];?>><a href="home.php?mod=spacecp&amp;ac=avatar">�޸�ͷ��</a></li>
<li<?php echo $actives['profile'];?>><a href="home.php?mod=spacecp&amp;ac=profile">��������</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?php echo $actives['verify'];?>><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">��֤</a></li>
<?php } ?>
<li<?php echo $actives['credit'];?>><a href="home.php?mod=spacecp&amp;ac=credit">����</a></li>
<li<?php echo $actives['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">�û���</a></li>
<li<?php echo $actives['privacy'];?>><a href="home.php?mod=spacecp&amp;ac=privacy">��˽ɸѡ</a></li>
<?php if($_G['setting']['sendmailday']) { ?><li<?php echo $actives['sendmail'];?>><a href="home.php?mod=spacecp&amp;ac=sendmail">�ʼ�����</a></li><?php } ?>
<li<?php echo $actives['password'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">���밲ȫ</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>
</div></div>
<?php } else { if($operation == 'password') { ?>
<p class="bbda pbm mbm"><?php if(!$_G['setting']['connect']['allow'] || !$conisregister) { ?>�������дԭ��������޸����������<?php } else { ?>��Ŀǰʹ�õ���QQ�˺Ű󶨱�վ����������������ö������룬ֻ�������˶��������վ��Ҫ��д�������Ӧ���ܲſ�ʹ��<?php } ?></p>
<form action="home.php?mod=spacecp&amp;ac=profile" method="post" autocomplete="off" onsubmit="return profilecheck()">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<table summary="��������" cellspacing="0" cellpadding="0" class="tfm">
<?php if(!$_G['setting']['connect']['allow'] || !$conisregister) { ?>
<tr>
<th><strong class="rq" title="����">*</strong>������</th>
<td><input type="password" name="oldpassword" id="oldpassword" class="px" /></td>
</tr>
<?php } ?>
<tr>
<th>������</th>
<td>
<input type="password" name="newpassword" id="newpassword" class="px" />
<p class="d">�粻��Ҫ�������룬�˴�������</p>
</td>
</tr>
<tr>
<th>ȷ��������</th>
<td>
<input type="password" name="newpassword2" id="newpassword2"class="px" />
<p class="d">�粻��Ҫ�������룬�˴�������</p>
</td>
</tr>
<tr id="contact"<?php if($_G['gp_from'] == 'contact') { ?> style="background-color: <?php echo SPECIALBG;?>;"<?php } ?>>
<th>Email</th>
<td>
<input type="text" name="emailnew" id="emailnew" value="<?php echo $space['email'];?>" class="px" />
<p class="d">
<?php if($space['emailstatus']) { ?>
<img src="<?php echo IMGDIR;?>/mail_active.png" alt="����֤" class="vm" /> <span class="xi1">��ǰ�����Ѿ���֤����</span>
<?php } else { ?>
<img src="<?php echo IMGDIR;?>/mail_inactive.png" alt="δ��֤" class="vm" /> <span class="xi1">����ȴ���֤��...</span><br />
								ϵͳ�Ѿ�������䷢����һ����֤�����ʼ���������ʼ���������֤���<br>
								���û���յ���֤�ʼ�������Ը���һ�����䣬����<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password&amp;resend=1" class="xi2">���½�����֤�ʼ�</a>
<?php } ?>
</p>
<?php if($_G['setting']['regverify'] == 1 && (($_G['group']['grouptype'] == 'member' && $_G['adminid'] == 0) || $_G['groupid'] == 8)) { ?><p class="d">!����ĵ�ַ��ϵͳ���޸�������벢������֤����Ч�ԣ�������</p><?php } ?>
</td>
</tr>

<tr>
<th>��ȫ����</th>
<td>
<select name="questionidnew" id="questionidnew">
<option value="" selected>����ԭ�еİ�ȫ���ʺʹ�</option>
<option value="0">�ް�ȫ����</option>
<option value="1">ĸ�׵�����</option>
<option value="2">үү������</option>
<option value="3">���׳����ĳ���</option>
<option value="4">������һλ��ʦ������</option>
<option value="5">����˼�������ͺ�</option>
<option value="6">����ϲ���Ĳ͹�����</option>
<option value="7">��ʻִ�������λ����</option>
</select>
<p class="d">��������ð�ȫ���ʣ���¼ʱ��������Ӧ����Ŀ���ܵ�¼</p>
</td>
</tr>

<tr>
<th>�ش�</th>
<td>
<input type="text" name="answernew" id="answernew" class="px" />
<p class="d">���������µİ�ȫ���ʣ����ڴ������</p>
</td>
</tr>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php $sectpl = '<tr><th><sec></th><td><sec><p class="d"><sec></p></td>'; include template('common/seccheck'); } ?>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="pwdsubmit" value="true" class="pn pnp" /><strong>����</strong></button></td>
</tr>
</table>
<input type="hidden" name="passwordsubmit" value="true" />
</form>
<?php } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_top'])) echo $_G['setting']['pluginhooks']['spacecp_profile_top']; ?><ul class="tb cl">
<?php if($operation != 'verify') { ?>
<li <?php echo $opactives['base'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=base">��������</a></li>
<li <?php echo $opactives['contact'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=contact">��ϵ��ʽ</a></li>
<li <?php echo $opactives['info'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=info">������Ϣ</a></li>
<li <?php echo $opactives['bbs'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=bbs"><?php echo $_G['setting']['navs']['2']['navname'];?>��Ϣ</a></li>
<!-- // 120328 wistar ���������ñ�ǩ START-->
<li <?php echo $opactives['identity'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=identity">�������</a></li>
<!-- // 120328 wistar ���������ñ�ǩ END-->
<?php if($_G['setting']['allowspacedomain'] && $_G['setting']['domain']['root']['home'] && checkperm('domainlength')) { ?>
<li <?php echo $opactives['domain'];?>><a href="home.php?mod=spacecp&amp;ac=domain">�ҵĿռ�����</a></li>
<?php } ?>
        <?php if($tt=='new') { ?>
        <li style=" margin-left:5px;display:inline;margin-right: 8px; margin-top:-2px;"><a style="padding:0; background:none; border:none;" href="home.php?mod=task&amp;item=new"><img src="http://static.8264.com/static/image/task/newertask.gif" /></a></li>
        <?php } } else { if($_G['setting']['verify']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available']) { ?>
<li <?php echo $opactives['verify'.$vid];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid=<?php echo $vid;?>"><?php echo $verify['title'];?></a></li>
<?php } } } if($_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li <?php echo $opactives['videophoto'];?>><a href="home.php?mod=spacecp&amp;ac=videophoto">��Ƶ��֤</a></li>
<?php } } if(!empty($_G['setting']['plugins']['spacecp_profile'])) { if(is_array($_G['setting']['plugins']['spacecp_profile'])) foreach($_G['setting']['plugins']['spacecp_profile'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;op=profile&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul><?php if($vid) { ?>
<p class="tbms mtm"><?php if($showbtn) { ?>������Ϣͨ����˺󽫲����ٴ��޸�,�ύ�������ĵȴ��˲飡<?php } else { ?>��ϲ����������֤���ͨ�������Ѳ��ܶ����������������޸ġ�<?php } ?></p>
<?php } ?>
<iframe id="frame_profile" name="frame_profile" style="display: none"></iframe>
<form action="<?php if($operation != 'plugin') { ?>home.php?mod=spacecp&ac=profile&op=<?php echo $operation;?><?php } else { ?>home.php?mod=spacecp&ac=plugin&op=profile&id=<?php echo $_G['gp_id'];?><?php } ?>" method="post" enctype="multipart/form-data" autocomplete="off"<?php if($operation != 'plugin') { ?> target="frame_profile"<?php } ?>>
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<?php if($_G['gp_vid']) { ?>
<input type="hidden" value="<?php echo $_G['gp_vid'];?>" name="vid" />
<?php } ?>
<table cellspacing="0" cellpadding="0" class="tfm">
<tr class="bbda">
<th>�û���</th>
<td style="width:700px"><?php echo $_G['member']['username'];?></td>
<td>&nbsp;</td>
</tr><?php if(is_array($settings)) foreach($settings as $key => $value) { if($value['available']) { ?>
<tr class="bbda" <?php if($key=='field3') { ?>style="display:none"<?php } ?>>
<th id="th_<?php echo $key;?>"><?php if($value['required']) { ?><strong class="rq" title="����">*</strong><?php } ?><?php echo $value['title'];?></th>
<td id="td_<?php echo $key;?>">
<?php echo $htmls[$key];?>
</td>
<td class="p">
<?php if($value['showinthread'] || $vid) { ?>
<input type="hidden" name="privacy[<?php echo $key;?>]" value="3" />
<?php } else { ?>
<select name="privacy[<?php echo $key;?>]">
<option value="0"<?php if($privacy[$key] == "0") { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($privacy[$key] == "1") { ?> selected="selected"<?php } ?>>�໥��ע���˿ɼ�</option>
<option value="3"<?php if($privacy[$key] == "3") { ?> selected="selected"<?php } ?>>����</option>
</select>
<?php } ?>
</td>
</tr>
<?php } } ?>

<!-- // 120320 wistar �û����ѡ�� START -->
<?php if($arr_identity) { ?>
<div id="note_tip"></div>
<div class="col-title" id="div_move_tip" style="display:none">
<div class="start"></div>
<div class="end"></div>
����Ϊ���Ƽ��� <span id="span_count" style="color:red"></span> ���߼���ݣ�����ɹ������ܸ����������
</div>
<script src="http://static.8264.com/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
// ��ѡ�е����ID
var active_obj_id = '';
var str_identitys = '<?php echo $str_identitys;?>';
var arr_identitys = str_identitys.split(',');
jQuery.noConflict();

jQuery(function ($) {
// �ύ��ť����
$('#profilesubmitbtn').remove();
// ���������ʾ����
$('#a_showidentitys').hover(function (e) {
if ($('#div_identitys>ul').is(':empty')) {
return;
}
$('#div_identitys').stop(true,true).fadeToggle();
});
// ɸѡ��ť����ɸѡ�˵�����ʾ����
$('#a_select').click(function (e) {
$('#div_item').fadeToggle();
});
// �����հ״�ɸѡ�˵�����ʧ
$(document).click(function (event) {
var str_id = event.target.id;
// �������㲻�Ǵ��������㵯���¼���td��td�е�div��div�е�spanԪ�ز��Ҳ����ǵ����㱾��ʱ������������
if(str_id != 'div_item' && str_id != 'a_select') {
jQuery('#div_item').fadeOut();
}
});
// ɸѡ�˵�����ʽ����
$('#div_item div').css({'cursor':'pointer'}).mouseenter(function () {
$(this).css('background','red');
}).mouseleave(function () {
// ����ǵ�ǰѡ�в˵��������ʽ
if ($(this).attr('id') != active_obj_id) {
$(this).css('background', '');
}
});

// �ύ�����
$('.application.btn_0').click(function (e) {
var obj_this = $(this);
var arr_iid = obj_this.attr('id').split('_');
var iid = arr_iid[1];
if (!iid || iid <= 0) {return;}
$.ajax({
url: 'home.php?mod=spacecp&ac=profile&op=<?php echo $operation;?>&req_type=ajax&op=add_identity&iid=' + iid,
type: 'get',
dataType: 'json',
success: function (msg) {
if (msg.status != 'success') {
tipIn('����ʧ�ܣ������ԣ�');
} else {
tipIn('���������ѳɹ������Լ��������ݣ�');
obj_this.unbind('click').removeClass('btn_0').addClass('btn_1');
$('#div_identity_' + iid).attr('status', '1');
// ��ȡ��������¿�����������
var obj_jq_div_identity = $('div[identity_id=' + iid + ']').filter('[status=0],[status=3]');
var int_sub_identity_count = obj_jq_div_identity.size();
// ����п�ѡ���������뵽�Ƽ��б��õ�������ʽ����
if (int_sub_identity_count > 0) {
var int_div_tip_h = $('#div_move_tip').height();
$('#div_move_tip').fadeIn(0).css({'opacity': '0', 'height': '0', 'margin': '0'}).insertAfter(obj_this.parent()).animate({'opacity': '1', 'height': int_div_tip_h}, 800);
// ���ø���
$('#span_count').text(int_sub_identity_count);
var obj_iterate = null;
obj_jq_div_identity.each(function (i) {
var int_oh = $(this).height();
obj_iterate = i == 0 ? $('#div_move_tip') : obj_iterate;
var obj_this = reset_button($(this), 1);
obj_this.css({'opacity': '0', 'height': '0'}).insertAfter(obj_iterate).animate({'opacity': '1', 'height': int_oh}, 800, function () {$(this).css({'height': ''})});
obj_iterate = $(this);
});
}
// �ҵ��������Ӹ���ӵ����
$('#div_identitys>ul').append($('<li>' + $('#h5_title_' + iid).text() +'</li>'));
arr_identitys.push(iid);
/* ��������ʽ��ʾ */
// ��ȡ��������¿�����������
//											var obj_jq_div_identity = $('div[identity_id=' + iid + ']').filter('[status=0],[status=3]').clone();
//											var int_sub_identity_count = obj_jq_div_identity.size();
//											// ����п�ѡ���������뵽�Ƽ��б��õ�������ʽ����
//											if (int_sub_identity_count > 0) {
//												obj_jq_div_identity.each (function () {
//													$('#div_commend_identity').append(clone_div_identity($(this), iid));
//												});
//												// ���ø���
//												$('#span_count').text(int_sub_identity_count);
//												// ��ʾ
//												$('#div_mask').css({'height': $(document).height(), 'opacity':0.5}).fadeIn(800);
//												$('#div_commend').fadeIn(800);
//											}
}
},
error: function (msg) {
tipIn('����ʧ�ܣ������ԣ�');
}
});
});

// ��ʾ���ύ���������
$('.application-sub.btn_sub_0, .application-sub.btn_sub_3, .application-sub.btn_sub_5').live('click', function (e) {
var obj_this = $(this);
var arr_class = obj_this.attr('class').split(' ');
var arr_idd = obj_this.attr('id').split('_');
var iid = arr_idd[2];
var idd = arr_idd[3];
if (!iid || !idd || iid <= 0 || idd <= 0) {return;}
if ($('#div_reason_' + idd).is(':visible')) {
//									var str_reason = escape($('#txta_' + idd).val());
var str_reason = $('#txta_' + idd).val();
$.ajax({
url: 'home.php?mod=spacecp&ac=profile&op=<?php echo $operation;?>&req_type=ajax&op=app_detail',
type: 'post',
data: {'iid':iid, 'idd':idd, 'app_reason':str_reason},
dataType: 'json',
contentType : "application/x-www-form-urlencoded; charset=utf-8",
success: function (msg) {
if (msg.status != 'success') {
tipIn('����ʧ�ܣ������ԣ�');
} else {
tipIn('����������Ҫ��ˣ����Լ��������ݣ�');
$('#div_reason_' + idd).fadeOut();
obj_this.unbind('click').removeClass(arr_class[1]).addClass('btn_sub_2').insertAfter($('#div_reason_' + idd));
$('#div_identity_' + iid + '_' + idd).attr('status', '2');
}
},
error: function (msg) {
tipIn('����ʧ�ܣ������ԣ�');
}
});
} else {
if (arr_identitys.length > 0) {
if (jQuery.inArray(iid, arr_identitys) >= 0) {
$('#span_iidtip_' + idd).remove();
}
}
$(this).removeClass(arr_class[1]).addClass('btn_sub_5');
$('#div_reason_' + idd).append($(this)).fadeIn('slow');
}
});

// �Ƽ����е����������
//							$('div[id^=commend_div_btn_sub_]').live('click', function (e) {
//								var obj_this = $(this);
//								var arr_class = obj_this.attr('class').split(' ');
//								var arr_idd = obj_this.attr('id').split('_');
//								var iid = arr_idd[4];
//								var idd = arr_idd[5];
//								if (!iid || !idd || iid <= 0 || idd <= 0) {return;}
//								var str_reason = escape($('#commend_txta_' + idd).val());
//								if ($('#commend_div_reason_' + arr_idd[5]).is(':visible')) {
//									$.ajax({
//										url: 'home.php?mod=spacecp&ac=profile&op=<?php echo $operation;?>&req_type=ajax&op=app_detail',
//										type: 'post',
//										data: {'iid':iid, 'idd':idd, 'app_reason':str_reason},
//										dataType: 'json',
//										success: function (msg) {
//											close_div_commend();
//											if (msg.status != 'success') {
//												tipIn('����ʧ�ܣ������ԣ�');
//											} else {
//												tipIn('����������Ҫ��ˣ����Լ��������ݣ�');
//												$('#div_btn_sub_' + iid + '_' + idd).unbind('click').text('������').removeClass(arr_class[1]).addClass('div_btn_sub_2');
//												$('#div_identity_' + idd).attr('status', '2');
//											}
//										},
//										error: function (msg) {
//											close_div_commend();
//											tipIn('����ʧ�ܣ������ԣ�');
//										}
//									});
//								} else {
//									$(this).text('�ύ');
//									$('#commend_div_reason_' + arr_idd[5]).append($(this)).fadeIn('slow');
//								}
//							});

// ������ر�
//							$('#span_close').click(function (e) {
//								close_div_commend();
//							});

// ɸѡѡ��
$('#li_item_all').click(function (e) {
identity_fadeOut(0, $(this));
});
$('#li_item_allow').click(function (e) {
identity_fadeOut(0, $(this));
});
$('#li_item_applying').click(function (e) {
identity_fadeOut(2, $(this));
});
$('#li_item_applied').click(function (e) {
identity_fadeOut(1, $(this));
});

// ɸѡ�˵���껮��������ʾ
$('#li_item_all, #li_item_allow, #li_item_applying, #li_item_applied').hover(
function () {
$(this).css('background', 'white');
},
function () {
$(this).css('background', '');
}
);
});

// �رյ�����
//						function close_div_commend () {
//							jQuery('#div_mask, #div_commend').fadeOut(800);
//							jQuery('#div_commend_identity').empty();
//						}
// ���Ƽ����Ԫ���޸����������ԭԪ�����Խ�������
//						function clone_div_identity (obj, iid) {
//							// �޸������div��ID����
//							obj.attr('id', 'commend_' + obj.attr('id'));
//							// ������������div���޸���ID���Ժ�����Ϊ��ʼ״̬�����أ�
//							var obj_jq_reason = obj.children('[id^=div_reason_]');
//							obj_jq_reason.attr('id', 'commend_' + obj_jq_reason.attr('id')).css('display', 'none');
//							// �����ύ��ť�������ť�Ѿ����������뵽��������div���������²��뵽���div�к��޸�ID
//							var obj_jq_btn = obj.children('[id^=div_btn_sub_]').length ? obj.children('[id^=div_btn_sub_]') : obj_jq_reason.children('[id^=div_btn_sub_]');
//							obj_jq_btn.attr('id', 'commend_' + obj_jq_btn.attr('id')).text('����').insertAfter(obj_jq_reason, obj);
//							// ������������textarea���޸���ID
//							var obj_jq_txta = obj_jq_reason.children('[id^=txta_]');
//							obj_jq_txta.attr('id', 'commend_' + obj_jq_txta.attr('id'));
//							return obj;
//						}

// ���ɸѡ
function identity_fadeOut (status, obj_jq) {
// ���ѡȡ��ɸѡ��Ϊ��ѡ�е�ɸѡ���򲻽����ٴ�ɸѡ
if (obj_jq.attr('id') == active_obj_id) {
return;
}
// ��¼��ǰɸѡ���ID
active_obj_id = obj_jq.attr('id');
// ͨ��ID������Ӧɸѡ
switch (active_obj_id) {
// ��ʾ�������
case 'li_item_all' :
jQuery('#div_move_tip').fadeOut(0);
jQuery('div[id^=div_identity_]').fadeIn();
break;
// ��ʾ������Ϳ�������������
case 'li_item_allow' :
if (jQuery('div[id^=div_identity_][status=0], div[id^=div_identity_][status=3]').size() > 0) {
jQuery('#div_move_tip').fadeOut(0);
jQuery('div[id^=div_identity_]').fadeOut();
jQuery('div[id^=div_identity_][status=0], div[id^=div_identity_][status=3]').fadeIn();
} else {
tipIn('���޿��������ݣ�');
}
break;
// ����status������ʾ�����С�����ɹ���������������
default:
if (jQuery('div[id^=div_identity_][status=' + status + ']').size() > 0) {
jQuery('#div_move_tip').fadeOut(0);
jQuery('div[id^=div_identity_]').fadeOut();
jQuery('div[id^=div_identity_][status=' + status + ']').fadeIn();
} else {
var str_tip = '';
switch (status) {
case 1:
str_tip = '��������ɹ�����ݣ�';
break;
case 2:
str_tip = '���������е���ݣ�';
break;
case 4:
str_tip = '���޲����������ݣ�';
break;
default:
break;
}
tipIn(str_tip);
}
break;
}

// ����ɸѡ�˵�
jQuery('#div_item').fadeOut();
// �������ɸѡ�˵���ʽ
jQuery('#div_item li').css('color', '');
// ��ѡ�е�ɸѡ�˵������ʽ
obj_jq.css('color', 'red');
}

// ���ð�ť���ԡ������Ѵ򿪵���������Ԫ��
function reset_button (obj, type) {
var arr_idd = obj.attr('id').split('_');
var int_iid = obj.attr('identity_id');
var int_status = obj.attr('status');
var int_idd = arr_idd[3];
var int_btnid = '[id^=btn_sub_' + int_iid + '_' + int_idd + ']';
var obj_reason = obj.children('[id^=div_reason_' + int_idd + ']');
var obj_btn = obj.children(int_btnid).length ? obj.children(int_btnid) : obj_reason.children(int_btnid);
var arr_class = obj_btn.attr('class').split(' ');
if (type == 1) {
jQuery(int_btnid).removeClass(arr_class[1]).addClass('btn_sub_0').insertAfter('#div_remark_tip_' + int_idd);
jQuery('#p_deny_reason_' + int_idd).remove();
obj_reason.fadeOut(0);
} else {
jQuery(int_btnid).removeClass(arr_class[1]).addClass('btn_sub_' + int_status).insertAfter('#div_remark_tip_' + int_idd);
obj_reason.fadeOut();
}
return obj;
}

// �ر���������
function close_reason(div_id) {
if (!div_id) {return;}
reset_button (jQuery('#' + div_id), 2);
}

// ������������֪���ˡ��ı�����״̬
function cancel_tip (app_id, iid, idd) {
if (!app_id || !iid || !idd) {
return;
}
jQuery.ajax({
url: 'home.php?mod=spacecp&ac=profile&op=<?php echo $operation;?>&req_type=ajax&op=cancel_tip&app_id=' + app_id,
type: 'get',
dataType: 'json',
success: function (msg) {
jQuery('#div_remark_tip_' + idd).fadeOut();
jQuery('#btn_sub_' + iid + '_' + idd).removeClass('btn_sub_3').addClass('btn_sub_0');
},
error: function (msg) {
jQuery('#div_remark_tip_' + idd).fadeOut();
jQuery('#btn_sub_' + iid + '_' + idd).removeClass('btn_sub_3').addClass('btn_sub_0');
}
});
}
// ��ʾ������ʾ
function tipIn (text) {
// ���㵯����ʾ����
var x = (jQuery(window).width() - jQuery('#note_tip').width()) / 2;
var y = jQuery(document).scrollTop() + jQuery(window).height() / 2 - 50;
jQuery('#note_tip').text(text).css({display: 'block', left:x, top:y, opacity:'0'}).stop().animate({ opacity:'1'}, 1500, function() {
setTimeout(tipOut, 1000);
});
}
// ���ز�����ʾ
function tipOut() {
jQuery('#note_tip').animate({opacity: '0'}, 1000);
}
</script>
<link rel="stylesheet" type="text/css" href="template/default/common/spacecp_indeitity.css" />
<tr>
<td colspan="3">
<div class="identity-col">
<div class="identity-col-tit">
<a href="javascript:void(0);" class="my-identity" id="a_showidentitys">�ҵ����</a>
<a href="javascript:void(0);" class="my-filter" id="a_select">ɸѡ���</a>
</div>
<div class="identity-col-cont">
<div class="my-identity-more" id="div_identitys" style="display:none">
<ul><?php if(is_array($arr_identitys)) foreach($arr_identitys as $identity) { ?><li <?php if($identity['iter'] == 1) { ?>class="first"<?php } ?>>
<?php echo $identity['identity_name'];?>
</li>
<?php } ?>
</ul>
</div>
<div class="my-filter-more" id="div_item" style="display:none">
<ul>
<li id="li_item_all" class="first" style="color:red">
ȫ�����
</li>
<li id="li_item_allow">
�������
</li>
<li id="li_item_applying">
�����е�
</li>
<li id="li_item_applied">
�ѳɹ���
</li>
</ul>
</div><?php if(is_array($arr_identity)) foreach($arr_identity as $identity) { ?><div id="div_identity_<?php echo $identity['id'];?>" status="<?php if($identity['identity_status']) { ?><?php echo $identity['identity_status'];?><?php } else { ?>0<?php } ?>" class="identity-col-cont-col">
<h5 class="tit" id="h5_title_<?php echo $identity['id'];?>"><?php echo $identity['identity_entity'];?></h5>
<p><?php echo $identity['description'];?></p>
<h5 class="tit mt30">����˵��</h5>
<div class="min-height">
<p><?php echo $identity['remark'];?></p>
</div>
<input type="button" class="application btn_<?php echo $identity['identity_status'];?>" id="btn_<?php echo $identity['id'];?>">
<div class="clear"></div>
</div>
<?php } if(is_array($arr_detail)) foreach($arr_detail as $identity) { ?><div id="div_identity_<?php echo $identity['identity']['id'];?>_<?php echo $identity['id'];?>" identity_id="<?php echo $identity['identity']['id'];?>" status="<?php if($identity['identity_status']) { ?><?php echo $identity['identity_status'];?><?php } else { ?>0<?php } ?>" class="identity-col-cont-col">
<h5 class="tit"><?php echo $identity['subname'];?></h5>
<p><?php echo $identity['description'];?></p>
<h5 class="tit mt30">����˵��</h5>
<div class="min-height" id="div_remark_tip_<?php echo $identity['id'];?>">
<p><?php echo $identity['remark'];?><!-- <a href="#" class="nowgo"></a> --></p>
<?php if($identity['identity_status'] == 3) { ?>
<div class="tips" id="p_deny_reason_<?php echo $identity['id'];?>">���������Ѿ����ܾ���ԭ��Ϊ��<?php echo $identity['deny_reason'];?>... <a href="javascript:void(0);" style="color:blue" onclick="cancel_tip('<?php echo $identity['app_id'];?>', '<?php echo $identity['identity']['id'];?>', '<?php echo $identity['id'];?>')">֪����</a></div>
<?php } ?>
</div>
<input type="button" id="btn_sub_<?php echo $identity['identity']['id'];?>_<?php echo $identity['id'];?>" class="application-sub btn_sub_<?php echo $identity['identity_status'];?>" />
<?php if($identity['identity_status'] != 1 && $identity['identity_status'] != 2 && $identity['identity_status'] != 4) { ?>
<div id="div_reason_<?php echo $identity['id'];?>" class="input-sec" style="display:none;">
<h3><a href="javascript:void(0);" onclick="close_reason('div_identity_<?php echo $identity['identity']['id'];?>_<?php echo $identity['id'];?>')" class="close-reason">close</a>��������</h3>
<textarea id="txta_<?php echo $identity['id'];?>" class="application-second-text"></textarea>
<p>�����Լ������ľ����Ա��������<br><span id="span_iidtip_<?php echo $identity['id'];?>">������������Զ����� <font color="red"><?php echo $identity['identity']['identity_entity'];?> </font>������飩</span></p>
</div>
<?php } ?>
</div>
<?php } ?>
</div>
</div>
</td>
</tr>
<?php } ?>
<!-- // 120320 wistar �û����ѡ�� END -->

<?php if($operation == 'bbs') { if($allowcstatus) { ?>
<tr>
<th id="th_customstatus">�Զ���ͷ��</th>
<td id="td_customstatus"><input type="text" value="<?php echo $space['customstatus'];?>" name="customstatus" id="customstatus" class="px" /></td>
<td>&nbsp;</td>
</tr>
<?php } if($_G['group']['maxsigsize']) { ?>
<tr>
<th id="th_sightml">����ǩ��</th>
<td id="td_sightml">
<div class="tedt">
<div class="bar">
<span class="y"><a href="javascript:;" onclick="$('signhtmlpreview').innerHTML = bbcode2html($('sightmlmessage').value)">Ԥ��</a></span>
<?php if($_G['group']['allowsigbbcode']) { if($_G['group']['allowsigimgcode']) { ?><?php $seditor = array('sightml', array('bold', 'color', 'img', 'link', 'smilies')); } else { ?><?php $seditor = array('sightml', array('bold', 'color', 'link', 'smilies')); } if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="���ּӴ�" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="���ɫ"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="��ɫ"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="��ɫ"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<style type="text/css">
#pmimg_menu #pmimg_param_1 {width:93%!important;}
</style>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="ͼƬ" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?> style="margin-left:5px;">ͼƬ</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>����</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } } ?>
</div>
<div class="area">
<textarea rows="3" cols="80" name="sightml" id="sightmlmessage" class="pt" onkeydown="ctrlEnter(event, 'profilesubmitbtn');"><?php echo $space['sightml'];?></textarea>
</div>
</div>
<div id="signhtmlpreview"></div>
<script src="http://static.8264.com/static/js/bbcode.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">var forumallowhtml = 0,allowhtml = 0,allowsmilies = 0,allowbbcode = parseInt('<?php echo $_G['group']['allowsigbbcode'];?>'),allowimgcode = parseInt('<?php echo $_G['group']['allowsigimgcode'];?>');var DISCUZCODE = [];DISCUZCODE['num'] = '-1';DISCUZCODE['html'] = [];</script>
</td>
<td>&nbsp;</td>
</tr>
<?php } ?>
<tr>
<th id="th_timeoffset">ʱ��</th>
<td id="td_timeoffset"><?php $timeoffset = array(
		'9999' => 'ʹ��ϵͳĬ��',
		'-12' => '(GMT -12:00) �������п˵�, ����ֻ���',
		'-11' => '(GMT -11:00) ��;��, ��Ħ��Ⱥ��',
		'-10' => '(GMT -10:00) ������',
		'-9' => '(GMT -09:00) ����˹��',
		'-8' => '(GMT -08:00) ̫ƽ��ʱ��(�����ͼ��ô�), �Ừ��',
		'-7' => '(GMT -07:00) ɽ��ʱ��(�����ͼ��ô�), ����ɣ��',
		'-6' => '(GMT -06:00) �в�ʱ��(�����ͼ��ô�), ī�����',
		'-5' => '(GMT -05:00) ����ʱ��(�����ͼ��ô�), �����, ����, ����',
		'-4' => '(GMT -04:00) ������ʱ��(���ô�), ������˹, ����˹',
		'-3.5' => '(GMT -03:30) Ŧ����',
		'-3' => '(GMT -03:00) ��������, ����ŵ˹����˹, ���ζ�, ������Ⱥ��',
		'-2' => '(GMT -02:00) �д�����, ��ɭ��Ⱥ��, ʥ�����õ�',
		'-1' => '(GMT -01:00) ����Ⱥ��, ��ý�Ⱥ�� [�������α�׼ʱ��] ������, �׶�, ��˹��, ����������',
		'0' => '(GMT) �����������������֣����������׶أ���˹��������ά��',
		'1' => '(GMT +01:00) ����, ��³����, �籾����, �����, ����, ����',
		'2' => '(GMT +02:00) �ն�����, ����������, �Ϸ�, ��ɳ',
		'3' => '(GMT +03:00) �͸��, ���ŵ�, Ī˹��, �����',
		'3.5' => '(GMT +03:30) �º���',
		'4' => '(GMT +04:00) ��������, �Ϳ�, ��˹����, �ر���˹',
		'4.5' => '(GMT +04:30) ������',
		'5' => '(GMT +05:00) Ҷ�����ձ�, ��˹����, ������, ��ʲ��',
		'5.5' => '(GMT +05:30) ����, �Ӷ�����, �����˹, �µ���',
		'5.75' => '(GMT +05:45) �ӵ�����',
		'6' => '(GMT +06:00) ����ľͼ, ������, �￨, ����������',
		'6.5' => '(GMT +06:30) ����',
		'7' => '(GMT +07:00) ����, ����, �żӴ�',
		'8' => '(GMT +08:00) ����, ���, ��˹, �¼���, ̨��',
		'9' => '(GMT +09:00) ����, ����, �׶�, ����, �ſ�Ŀ�',
		'9.5' => '(GMT +09:30) ��������, �����',
		'10' => '(GMT +10:00) ������, �ص�, ī����, Ϥ��, ������',
		'11' => '(GMT +11:00) ��ӵ�, �¿��������, ������Ⱥ��',
		'12' => '(GMT +12:00) �¿���, �����, 쳼�, ���ܶ�Ⱥ��'); ?><select name="timeoffset"><?php if(is_array($timeoffset)) foreach($timeoffset as $key => $desc) { ?><option value="<?php echo $key;?>"<?php if($key==$space['timeoffset']) { ?> selected="selected"<?php } ?>><?php echo $desc;?></option>
<?php } ?>
</select>
<p class="mtn">��ǰʱ�� : <?php echo dgmdate($_G[timestamp]); ?></p>
<p class="d">������ֵ�ǰ��ʾ��ʱ�����㱾��ʱ������Сʱ����ô����Ҫ�����Լ���ʱ�����á�</p>
</td>
<td>&nbsp;</td>
</tr>
<?php } elseif($operation == 'contact') { ?>
<tr>
<th id="th_sightml">Email</th>
<td id="td_sightml"><?php echo $space['email'];?>&nbsp;(<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password&amp;from=contact#contact">�޸�</a>)</td>
<td>&nbsp;</td>
</tr>
<?php } if($operation == 'plugin') { ?><?php include(template($_G['gp_id'])); } if($showbtn) { ?>
<tr>
<th>&nbsp;</th>
<td colspan="2">
<input type="hidden" name="profilesubmit" value="true" />
<button type="submit" name="profilesubmitbtn" id="profilesubmitbtn" value="true" class="pn pnp" /><strong>����</strong></button>
<span id="submit_result" class="rq"></span>						
</td>
</tr>
<?php } ?>
</table>
<?php if(!empty($_G['setting']['pluginhooks']['spacecp_profile_bottom'])) echo $_G['setting']['pluginhooks']['spacecp_profile_bottom']; ?>
</form>
<script type="text/javascript">
function show_error(fieldid, extrainfo) {
var elem = $('th_'+fieldid);
if(elem) {
elem.className = "rq";
fieldname = elem.innerHTML;
extrainfo = (typeof extrainfo == "string") ? extrainfo : "";
$('submit_result').innerHTML = " ���������� " + fieldname + extrainfo;
}
}
function show_success() {
showDialog('���ϸ��³ɹ�!', 'notice', '��ʾ��Ϣ', null, 0);
setTimeout(function(){
top.window.location.href = top.window.location.href;
}, 3000);
}
</script>
<?php } ?>
</div>
</div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">����</h2>
<ul>
<?php if($_G['setting']['connect']['allow']) { ?>
<li<?php echo $actives['qq'];?>><a href="connect.php?mod=config">QQ��</a></li>
<?php } ?>
<li<?php echo $actives['avatar'];?>><a href="home.php?mod=spacecp&amp;ac=avatar">�޸�ͷ��</a></li>
<li<?php echo $actives['profile'];?>><a href="home.php?mod=spacecp&amp;ac=profile">��������</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?php echo $actives['verify'];?>><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">��֤</a></li>
<?php } ?>
<li<?php echo $actives['credit'];?>><a href="home.php?mod=spacecp&amp;ac=credit">����</a></li>
<li<?php echo $actives['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">�û���</a></li>
<li<?php echo $actives['privacy'];?>><a href="home.php?mod=spacecp&amp;ac=privacy">��˽ɸѡ</a></li>
<?php if($_G['setting']['sendmailday']) { ?><li<?php echo $actives['sendmail'];?>><a href="home.php?mod=spacecp&amp;ac=sendmail">�ʼ�����</a></li><?php } ?>
<li<?php echo $actives['password'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">���밲ȫ</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>
</div></div>
<?php } ?>
</div>
<div id="div_mask"></div></div>
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
<strong><a href="http://bbs.8264.com/member.php?mod=clearcookies&amp;formhash=<?php echo formhash();; ?>" target="_blank">���COOKIE</a></strong><span class="pipe">|</span><?php $fnavcount=0; if(is_array($_G['setting']['footernavs'])) foreach($_G['setting']['footernavs'] as $nav) { if($nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) ||
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
<p style="color:#333">�����з��գ�8264����������<a href="http://bx.8264.com/?8264com" target="_blank" style=" color:#2A85E8;">���Ᵽ��</a><?php if(!empty($_G['setting']['boardlicensed'])) { ?> <a href="http://license.comsenz.com/?pid=1&amp;host=<?php echo $_SERVER['HTTP_HOST'];?>" target="_blank">Licensed</a><?php } ?></p>
<p class="xs0"></p>
</div>
<?php if($_G['extcnzz']) { ?>
<div style="display:none;"><?php if(is_array($_G['extcnzz'])) foreach($_G['extcnzz'] as $value) { ?><?php echo $value;?>
<?php } ?>
</div>
<?php } ?><?php updatesession(); ?></div><?php } ?><ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar">�޸�ͷ��</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile">��������</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">��֤</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit">����</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup">�û���</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy">��˽ɸѡ</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail">�ʼ�����</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">���밲ȫ</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?></ul><?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly">
���� <?php echo $_G['member']['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ����
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