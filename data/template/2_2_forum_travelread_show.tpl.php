<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('travelread_show', 'common/header_8264_1170_new');
0
|| checktplrefresh('./template/8264/forum/travelread_show.htm', './template/8264/common/header_8264_1170_new.htm', 1509517871, '2', './data/template/2_2_forum_travelread_show.tpl.php', './template/8264', 'forum/travelread_show')
|| checktplrefresh('./template/8264/forum/travelread_show.htm', './template/8264/dianping/showview_credit_narrow.htm', 1509517871, '2', './data/template/2_2_forum_travelread_show.tpl.php', './template/8264', 'forum/travelread_show')
|| checktplrefresh('./template/8264/forum/travelread_show.htm', './template/8264/forum/travelread_comment_body.htm', 1509517871, '2', './data/template/2_2_forum_travelread_show.tpl.php', './template/8264', 'forum/travelread_show')
|| checktplrefresh('./template/8264/forum/travelread_show.htm', './template/8264/forum/travelread_comment_body.htm', 1509517871, '2', './data/template/2_2_forum_travelread_show.tpl.php', './template/8264', 'forum/travelread_show')
|| checktplrefresh('./template/8264/forum/travelread_show.htm', './template/8264/common/footer_8264_1170_new.htm', 1509517871, '2', './data/template/2_2_forum_travelread_show.tpl.php', './template/8264', 'forum/travelread_show')
|| checktplrefresh('./template/8264/forum/travelread_show.htm', './template/8264/common/header_common.htm', 1509517871, '2', './data/template/2_2_forum_travelread_show.tpl.php', './template/8264', 'forum/travelread_show')
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
//ͳ�ƾɰ�Ŀ�ĵ�
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
<a id="diy-tg" style="z-index:9999" href="javascript:openDiy();" title="�� DIY ���"><img src="http://static.8264.com/static/image/diy/panel-toggle.png" alt="DIY" /></a>
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
<a href="<?php echo $_G['config']['web']['portal'];?>list/238/" class="topLink">֪ʶ</a>
<dl>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>list/751/" class="first">ҵ����Ѷ</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>list/238/">֪ʶ</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>list/204/">����װ��</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>topic_list/" class="last">ר��</a>
</dd>
</dl>
</li>
<li>
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei.html" class="topLink">����</a>
<dl>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei.html" class="first">������Ʒ</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>pinpai">Ʒ��</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>dianpu">�����</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>xuechang">��ѩ��</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>shanfeng">ɽ��</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>xianlu">��·</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>panpa/">����</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>qianshui/">Ǳˮ��</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>diaoyu/">���㳡��</a>
</dd>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>julebu/">������ֲ�</a>
</dd>
                        <dd>
<a href="<?php echo $_G['config']['web']['portal'];?>kezhan/" class="last">�����ջ</a>
</dd>
</dl>
</li>
<li>
<a href="<?php echo $_G['config']['web']['forum'];?>" class="topLink">��̳</a>
<dl>
<dd>
<a href="<?php echo $_G['config']['web']['portal'];?>list/871/" class="first">��ѡ</a>
</dd>
                        <dd>
<a href="<?php echo $_G['config']['web']['portal'];?>youji/?from=bbstop">�μ�</a>
</dd>
                        <dd>
<a href="<?php echo $_G['config']['web']['portal'];?>wenda/?from=bbstop">�ʴ�</a>
</dd>
                        <dd>
<a href="http://www.8264.com/list/842">ÿ��һͼ</a>
</dd>
                        <dd>
<a href="http://www.8264.com/pp">���õ��</a>
</dd>
                        <dd>
<a href="http://www.8264.com/list/912">������Ӱʦ</a>
</dd>
                        <dd>
<a href="http://www.8264.com/list/880" class="last">��������</a>
</dd>
</dl>
</li>
                <li class="wan" style="width:82px;" id="schoolpoplink"><a href="http://www.8264.com/xuexiao/?from=indexnavtop" class="topLink topLink_w_bg wkuan" target="_blank">����ѧУ</a><div class="navschoolpop"><img src="http://static.8264.com/static/image/common/xuexiaopop.png"></div></li>
                
                
                
                <li>
                	<a href="http://hd.8264.com/?from=bbstop" class="topLink" target="_blank">�</a>
                    <dl>
                        <dd>
<a href="http://bbs.8264.com/forum-161-1.html" class="first last" target="_blank">���</a>
</dd>
                        
</dl>
                </li>
                
                
                
<li class="wan"><a href="http://bx.8264.com/?bbsbxnew" class="topLink topLink_w_bg wkuan" target="_blank">����</a></li>
                <li class="shop8264nav">
<a href="https://8264.tmall.com/" class="topLink" target="_blank">8264�̳�</a>
<dl>
                        <dd>
<a href="https://8264.tmall.com/" class="first" target="_blank">8264��è</a>

</dd>
                        <dd>
<a href="https://shop440022528.taobao.com/" target="_blank">8264�Ա�</a>

</dd>
                         <dd>
<a href="https://mall.jd.com/index-650855.html" class="last"  target="_blank">8264����</a>
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
<a href="<?php echo $_G['config']['web']['forum'];?>forum.php?mod=forumdisplay&fid=483" class="bicon" target="_blank" title="��������<?php echo $_G['member']['extcredits5'];?>ö8264�ң����ȥ�һ���Ʒ">
<?php } else { ?>
<a href="<?php echo $_G['config']['web']['forum'];?>forum.php?mod=viewthread&tid=1641700" class="bicon" target="_blank" title="����������8264�ң�����������׬ȡ">
<?php } ?><?php echo $_G['member']['extcredits5'];?>ö
</a>
</div>
<ul class="myidcz">
<li><a class="wdtz" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-uid-<?php echo $_G['uid'];?>-do-thread-view-me-from-space.html">�ҵ�����</a></li>
<li><a class="wdxc" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-uid-<?php echo $_G['uid'];?>-do-album-view-me.html">�ҵ����</a></li>
<li><a class="myLog" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-uid-<?php echo $_G['uid'];?>-do-blog-view-me-from-space.html">�ҵ���־</a></li>
<li><a class="myFriend" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-uid-<?php echo $_G['uid'];?>-do-friend.html">�ҵĹ�ע</a></li>
<li><a class="sc" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-space-do-favorite.html">�ҵ��ղ�</a></li>
<li><a class="myrenwu" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-task-item-new.html">�ҵ�����</a></li>
<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?>
<li><a class="myDoor" target="_blank" href="<?php echo $_G['config']['web']['portal'];?>portal.php?mod=portalcp">�Ż�����</a></li>
<?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?>
<li><a class="myCenter" target="_blank" href="<?php echo $_G['config']['web']['forum'];?>admin.php">��������</a></li>
<?php } ?>
<li><a class="myAccount" target="_blank" href="<?php echo $_G['config']['web']['home'];?>home-setting.html">�˻�����</a></li>
<li><a class="myQuit" href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">�˳�</a></li>
</ul>
</div>
</li>
</ul>
<?php } else { ?>
<ul class="noLogin">
<li><a href="<?php echo $_G['config']['web']['forum'];?>member.php?mod=logging&action=login" onClick="showWindow('login', this.href);hideWindow('register');" class="loginIco">��¼</a></li>
<li><a href="<?php echo $_G['config']['web']['forum'];?>member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href);hideWindow('login');" href="" class="regIco"><?php echo $_G['setting']['reglinkname'];?></a></li>
</ul>
<?php } ?>
<div class="searchTopNav">
<form id="scform" autocomplete="off" action="http://so.8264.com/cse/search" target="_blank">
<input type="hidden" name="s" value="9963133823733045431" />
<?php if(CURMODULE == 'readmodeltravel') { ?><input type="hidden" name="nsid" value="3" /><?php } ?>
<span id="searchTips" class="tips">����</span>
<input id="searchText" class="text" type="text" value="" name="q"/>
<input class="subButton" type="submit" value=""/>
</form>
</div>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; ?>
<div id="wp">
<!--<link rel="stylesheet" href="http://192.168.1.227/static.css.com/global/1.0.1/css/layout-forum.css">-->
<link rel="stylesheet" href="http://static.8264.com/static/css/forum/readmodel.css">
<style type="text/css">
.newswarpten {display:none!important;}
.art-content p {text-align:left!important;}
</style>
<script src="http://static.8264.com/static/js/forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script src="http://static.8264.com/static/js/jquery.lazyload.min.js" type="text/javascript" type="text/javascript"></script>

<!--ͷ�� end-->
<div class="strategy-banner">
<div class="lazy-showBG">
<div class="header-bg" style="background-image:url(<?php echo $_G['config']['web']['static'];?>/static/images/forum/readmodelTravel/bg<?php echo $travelShow['bgpic'];?>.jpg);"></div>
</div>
<div class="strategy-header">
<div class="layout">
<div class="blk-crumbNav">
<a href="http://www.8264.com/" class="cate-name">��ҳ</a><em>|</em>
<a href="http://www.8264.com/youji/" class="cate-name">�μǹ���</a><?php if(is_array($placeList)) foreach($placeList as $v) { ?><em>|</em>
<a href="<?php echo $v['url'];?>" class="cate-name"><?php echo $v['name'];?></a>
<?php } ?>
</div>
<div class="stragy-titbar">
<div class="stragy-title">
<h1><?php echo $travelShow['subject'];?></h1>
</div>
<div class="stragy-thumb">
<p><a href="home.php?mod=space&amp;uid=<?php echo $travelShow['authorid'];?>" class="user-name"><?php echo $travelShow['author'];?></a></p>
<!-- <p class="pb-time"><?php echo date('m-d H:i', $threadShow['dateline']); ?></p> -->
<?php if($_G['groupid'] ==1) { ?>
<script src="http://static.8264.com/static/js/pushoriginaltobaidu.js" type="text/javascript" type="text/javascript"></script>
<p><a href="javascript:;" onclick="pushOriginalToBaidu();" style="color: #FFF;">[���͵��ٶ�ԭ��]</a></p>
<?php } ?>
</div>
</div>
<div class="attent-wrapper">
<div class="left-joint"></div>
<div class="attentList-content">
<div class="attentList-inner">
<span class="attent-num"><em><?php echo $threadShow['views'];?></em>�˹�ע</span><?php if(is_array($viewsuids)) foreach($viewsuids as $v) { ?><a href="home.php?mod=space&amp;uid=<?php echo $v;?>"><?php echo avatar($v, small); ?></a>
<?php } ?>
<a href="javascript:void(0);" class="more-link">����</a>
</div>
</div>
<div class="right-joint"></div>
</div>
</div>
</div>
</div>
<!--ͷ�� end-->
<div id="content">

<div class="main-rect">
<!--����-->
<div class="col-main">
<div class="blk-container">
<div class="art-content"><?php require_once DISCUZ_ROOT.'./source/plugin/articlekeywords/include.php'; ?><?php $articleKeywords = new ArticleKeywords(); ?><?php echo $articleKeywords->parseArticle($message); ?></div>
<div class="art-page">
<?php if($multi) { ?><div class="art-page"><?php echo $multi;?></div><?php } ?>
</div>
<div style="text-align:center;"><img src="http://static.8264.com/static/images/moban/1024newslw/images/newewm2.png" width="180"><img src="http://static.8264.com//static/images/moban/1024newslw/images/newewm.png" width="180"></div>
</div>
</div>
<!--���� end-->
<!--�Ҳ๤����-->
<div class="side-float">
<div class="mui-tab">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $travelShow['tid'];?>" class="icon-history" title="�鿴ԭ��"></a>
<div class="mui-tab-tip">
<div class="mui-tab-tip-t">����ԭ��</div>
<div class="mui-tab-tip-arr"></div>
</div>
</div>
<div class="mui-tab">
<a onclick="showWindow(this.id, this.href, 'get', 0);" id="m_k_favorite" href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $travelShow['tid'];?>" class="icon-favorites"></a>
<span id="favoritenumber" style="display:none;"></span>
<div class="mui-tab-tip">
<div class="mui-tab-tip-t">�ղر���</div>
<div class="mui-tab-tip-arr"></div>
</div>
</div>
<div class="mui-tab">
<a href="javascript:void(0);" class="icon-gotop" id="gotop"></a>
</div>
</div>
<!--�Ҳ๤���� end-->
</div>
<div class="main-extra-v3">
<div class="col-sub">
<div class="author-profile">
<h3 class="sub-title">��������</h3>
<div class="pf-wrap">
<div class="pf-photo">
<p class="photo-wrap">
<a href="home.php?mod=space&amp;uid=<?php echo $travelShow['authorid'];?>" target="_blank"><?php echo avatar($travelShow['authorid'], middle); ?></a>
</p>
</div>
<div class="pf-username">
<h1 class="username"><a href="home.php?mod=space&amp;uid=<?php echo $travelShow['authorid'];?>" target="_blank"><?php echo $travelShow['author'];?></a></h1>
</div>
<p class="pf-intro"><a href="home.php?mod=space&amp;uid=<?php echo $travelShow['authorid'];?>" target="_blank"><?php echo $space['group']['grouptitle'];?></a></p>
<div class="pf-opt">
<div class="opt-box">
<div class="btn-bed">
<a href="home.php?mod=space&amp;uid=<?php echo $travelShow['authorid'];?>&amp;do=thread&amp;view=me&amp;from=space" class="btn-d btn-30px" target="_blank"><em class="icon-square"></em>����</a>
</div>
<div class="btn-bed">
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $travelShow['authorid'];?>&amp;touid=<?php echo $travelShow['authorid'];?>&amp;pmid=0&amp;daterange=2" onclick="showWindow('sendpm', this.href)" class="btn-d btn-30px"><em class="icon-mess"></em>��˽��</a>
</div>
</div>
</div>
</div>
</div>
<?php if($releList) { ?>
<div class="subImg-list">
<h3 class="sub-title">����μ�</h3>
<ul><?php $index = 0; if(is_array($tids2)) foreach($tids2 as $v) { ?><?php $temp = $releList[$v]; if($temp && $index < 3) { ?>
<li>
<a href="<?php echo $_G['config']['web']['portal'];?>youji/<?php echo $temp['tid'];?>.html" class="targ-img">
<img src="<?php echo $temp['pic'];?>" alt="<?php echo $temp['subject'];?>">
</a>
<p><a href="<?php echo $_G['config']['web']['portal'];?>youji/<?php echo $temp['tid'];?>.html"><?php echo $temp['subject'];?></a></p>
<div class="view-num"><i class="icon-view"></i><?php echo $temp['views'];?></div>
</li><?php $index++; } } ?>
</ul>
</div>
<?php } ?>
<div class="appAdv-wrap">
<div class="zw-qr"><?php echo adshow("custom_367"); ?></div>
</div>
            <div class="appAdv-wrap appAdv-wrap_1">
<div class="zw-qr"><?php echo adshow("custom_419"); ?></div>
</div>

<!--JD��濪ʼ--><!-- common/adv_jd_300 -->      <!--JD������-->

      <!--����ѧУ���-->
      <div style="height: 300px;width:263px;overflow: hidden;">
      <div class="review-adv-box" style="display: none;">
<div class="ui-block ui-block-content">
<div class="review-adv-bd" style="padding:10px 22px;">
<div class="review-adv-info">
<p style="padding:15px 0 12px 0px">���������8264�ң�������Ʒ�������һ�</p>
<div class="adv-info-link">
<a class="btn-write" href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>#write">ȥд����</a>
<a target="_blank" href="http://bbs.8264.com/forum-483-1.html">��Ʒ�б�</a>
<a target="_blank" href="http://bbs.8264.com/thread-1641700-1-1.html">��ϸ����</a>
</div>
</div>
<div style="float:right">
<img src="http://static.8264.com/static/css/dianping/images/dpad.png" alt="">
</div>
</div>
</div>
</div>
<!-- ����ѧУ��� -->
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
        <span>��ȫ���ȿ���</span>
        <em>268��</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-1.html" target="_blank">
        <span>�����������</span>
        <em>187��</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-18.html" target="_blank">
        <span>Ұ�����濼��</span>
        <em>91��</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-15.html" target="_blank">
        <span>ͽ��֪ʶ����</span>
        <em>77��</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-5.html" target="_blank">
        <span>��ɽ֪ʶ����</span>
        <em>49��</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-3.html" target="_blank">
        <span>����֪ʶ����</span>
        <em>43��</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-8.html" target="_blank">
        <span>�ܲ�֪ʶ����</span>
        <em>71��</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-16.html" target="_blank">
        <span>¶Ӫ֪ʶ����</span>
        <em>56��</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-21.html" target="_blank">
        <span>����װ������</span>
        <em>72��</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-24.html" target="_blank">
        <span>������Ӱ����</span>
        <em>84��</em>
    </a>
</li>
</ul>
</div>
<!-- //����ѧУ��� -->
      </div>

</div>
</div>
</div>
<!--����-->
<div id="comment">
<div class="layout">
<div class="blk-comment">
<h1 class="blkc-title">��������</h1>
<div class="comment-form">
<?php if($_G['uid']) { ?>
<div class="avatar">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>"><?php echo avatar($_G['uid'], small); ?></a>
</div>
<form method="post" autocomplete="off" id="fastpostform" name="fastpostform" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes&amp;infloat=yes" onsubmit="return commentPost(this.id, 'return_fastpost')">
<div class="post-box-cont">
<textarea name="message" id="message" class="comment-notes" placeholder=""></textarea>
<button type="submit" class="btn-comment" id="fastpostsubmit">����</button>
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
����Ҫ��¼��ſ��Ի���
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">��¼</a>
| <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="showWindow('register', this.href)" class="xi2"><?php echo $_G['setting']['reglinkname'];?></a>
<?php if($_G['setting']['connect']['allow']) { ?>
| <a href="<?php echo $_G['connect']['login_url'];?>&statfrom=viewthread_fastpost" target="_top" rel="nofollow"><img src="<?php echo IMGDIR;?>/qq_login.gif" class="vm" /></a>
<?php } ?>
<button type="submit" class="btn-comment" id="fastpostsubmit">����</button>
</div>
</div>
<?php } ?>
</div>
<div class="comment-content">
<ul class="comment-navbar-nav">
<li <?php if($travelShow['rcnt']) { ?>class="active"<?php } ?>>�Ƽ�����</li>
<li <?php if(!$travelShow['rcnt']) { ?>class="active"<?php } ?>>ȫ������</li>
</ul>
<!--�Ƽ�����-->
<div id="tabs-recommendComment" class="commentContainer"><?php $commentList  = $rList; ?><?php $multiComment = $multiR; ?><?php $page = 1; ?><?php $type = 'rList'; ?><div id="<?php echo $type;?>_<?php echo $page;?>">
<ul class="post-list"><?php if(is_array($commentList)) foreach($commentList as $v) { ?><li class="pl-post">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-avatar"><?php echo avatar($v['authorid'], small); ?></a>							
<div class="pl-post-body">
<div class="pl-post-header">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-user"><?php echo $v['author'];?></a>
<!-- <span class="pl-time"><?php echo $v['dateline'];?></span> -->
<a href="javascript:void(0);" class="pl-btn-reply">�ظ�</a>
</div>
<div class="pl-post-content">
<p><?php echo $v['message'];?></p>
</div>
<!--�ظ���-->
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
<button type="submit" class="pl-btn-submit" id="fastpostsubmit" style="cursor:pointer;">�ظ�</button>		
</div>
</div>
</form>			
<!--�ظ��� end-->
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
<!--�Ƽ����� end-->
<!--��������-->
<div id="tabs-allComments" class="commentContainer" style="display:none;"><?php $commentList  = $cList; ?><?php $multiComment = $multiC; ?><?php $page = 1; ?><?php $type = 'cList'; ?><div id="<?php echo $type;?>_<?php echo $page;?>">
<ul class="post-list"><?php if(is_array($commentList)) foreach($commentList as $v) { ?><li class="pl-post">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-avatar"><?php echo avatar($v['authorid'], small); ?></a>							
<div class="pl-post-body">
<div class="pl-post-header">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-user"><?php echo $v['author'];?></a>
<!-- <span class="pl-time"><?php echo $v['dateline'];?></span> -->
<a href="javascript:void(0);" class="pl-btn-reply">�ظ�</a>
</div>
<div class="pl-post-content">
<p><?php echo $v['message'];?></p>
</div>
<!--�ظ���-->
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
<button type="submit" class="pl-btn-submit" id="fastpostsubmit" style="cursor:pointer;">�ظ�</button>		
</div>
</div>
</form>			
<!--�ظ��� end-->
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
<!--�������� end-->
</div>
</div>
</div>
</div>
<!--���� end-->
<div id="J-share" class="fx-share">
<div class="share-standard">
<div class="" style="position:relative;">
<p class="share-num"><em><?php echo $shareCnt;?></em>����</p><?php if(is_array($shareuids)) foreach($shareuids as $v) { ?><a href="home.php?mod=space&amp;uid=<?php echo $v;?>"><?php echo avatar($v, small); ?></a>
<?php } ?>
<a href="javascript:void(0);" class="share-link">��Ҫ����</a>
<div style="width:0;height:200px;position:absolute;top:270px;left:60px;overflow:hidden;" id="qrcodediv"><img src="qrcode.php?output=1&amp;url=<?php echo $shareurl;?>&amp;size=9" style="width:200px!important;height:200px!important;"></div>
</div>
</div>
</div>
<!--�ײ�������-->
<div class="fl-open-wrap">
<div class="fl-open-wrap-cntr" id="appd-wrap-open-cnt"></div>
</div>
<div id="J-popLogin" class="pop-comment-wrap">
<div id="fl-pop-wrap-cntr" class="fl-pop-wrap-cntr">
<div class="fl-pop-wrap-cntr-bg"></div>
<div class="pcw-content">
<div class="comment-main">
<h1>����д�ĺ����࣬�����͸�<em>����</em>�ɣ�</h1>
<div class="userlist-wrap"><?php if(is_array($commentuids)) foreach($commentuids as $v) { ?><a href="home.php?mod=space&amp;uid=<?php echo $v;?>"><?php echo avatar($v, small); ?></a>
<?php } ?>
<a href="javascript:void(0);" class="more-link">����</a>
<span class="comment-num"><em><?php echo $travelShow['ccnt'];?></em>������</span>
</div>
</div>
<div class="commentLogin-body">
<?php if($_G['uid']) { ?>
<form method="post" autocomplete="off" id="fastpostform1" name="fastpostform1" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes&amp;infloat=yes" onsubmit="return commentPost(this.id, 'return_fastpost')">
<div class="fl-pop-form">
<textarea name="message" id="message" placeholder=""></textarea>
</div>
<button type="submit" class="btn-d-r" id="fastpostsubmit" style="cursor:pointer;">����</button>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="subject" value="" />
<input type="hidden" name="is_readmodel" value="1" />
<input type="hidden" name="handlekey" value="fastpost" />
</form>
<?php } else { ?>
<div class="fl-pop-form">
<p>����Ҫ��¼��ſ�������<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)">��¼</a>|<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="showWindow('register', this.href)">ע��</a></p>
</div>
<a href="javascript:void(0);" class="btn-d-r">����</a>
<?php } ?>
</div>
<a href="javascript:void(0);" id="appd-wrap-close" class="pop-close has-closed"><span class="close-x">�ر�</span></a>
</div>
</div>
</div>
<!--�ײ������� end-->
<script type="text/javascript">
jQuery(function (){
    //ͼƬ��ʱ����
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
    	jQuery.post('forum.php?mod=readmodeltravel&action=incComment&tid=<?php echo $tid;?>&type=cList&page='+page, '', function(data){
    		jQuery('#tabs-allComments').append(data);
    		var obj = jQuery('#cList_'+page);
    		obj.show();
    		obj.siblings().hide();
    		jQuery('.pg a.prev').html('��һҳ');
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
    	jQuery.post('forum.php?mod=readmodeltravel&action=incComment&tid=<?php echo $tid;?>&type=rList&page='+page, '', function(data){
    		jQuery('#tabs-recommendComment').append(data);
    		var obj = jQuery('#rList_'+page);
    		obj.show();
    		obj.siblings().hide();
    		jQuery('.pg a.prev').html('��һҳ');
    	});
});
    jQuery('.pg a.prev').html('��һҳ');

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
jQuery(document).ready(function($) {
jQuery("#appd-wrap-open-cnt").on('click', function() {
var e = jQuery(this);
$("#appd-wrap-close").addClass("has-closed");
setcookie("showreadtravelreply", 0, 1*3600);
jQuery("#appd-wrap-open-cnt").animate({
left: "-100%"
},300,function(){
jQuery(this).parent().hide();
jQuery("#fl-pop-wrap-cntr").animate({
left: "0%"
},800,function(){
}).parent().show();
});
});
jQuery("#appd-wrap-close").on('click', function() {
var e = jQuery(this);
jQuery(this).removeClass("has-closed");
setcookie("showreadtravelreply", 1, 1*3600);
jQuery("#fl-pop-wrap-cntr").animate({
left: "-100%"
},300,function(){
jQuery(this).parent().hide();
jQuery("#appd-wrap-open-cnt").animate({
left: "0%"
},800,function(){
}).parent().show();
});
});
});

jQuery('.share-link').click(function(){
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
</script>
<script type="text/javascript">
jQuery(document).ready(function($) {
var ie6=!-[1,]&&!window.XMLHttpRequest;
if (!ie6) {
var navtop = $(".appAdv-wrap_1").offset().top + 400;
$(window).scroll(function(){
scrollfun();
});
function scrollfun(){
var s_top = $(window).scrollTop();
$("#J-popLogin").is(":hidden") ? $(".side-float").css("bottom","20px") : $(".side-float").css("bottom","140px");
s_top > navtop ? $(".side-float").animate({opacity: 'show'}, 500) + $(".w8h6-list-1").css({"position":"fixed", "top": 0 ,"width": "310px"}) : $(".side-float").animate({opacity: 'hide'}, 500) + $(".w8h6-list-1").removeAttr("style");
s_top > 410 ? $("#J-share").css("top", "10px") : $("#J-share").removeAttr("style");

//if($("#appd-wrap-close").hasClass("has-closed")&&getcookie('showreadtravelreply') != 1){
//	s_top > 1500 ? $("#J-popLogin").show() + $("#fl-pop-wrap-cntr").css("left","0%") : "";
//}

if(s_top > 1500){
if($("#appd-wrap-close").hasClass("has-closed")&&getcookie('showreadtravelreply') != 1){
$("#J-popLogin").show();
$("#fl-pop-wrap-cntr").css("left","0%");
}else{
$("#J-popLogin").hide();
$("#appd-wrap-close").removeClass("has-closed");
$("#fl-pop-wrap-cntr").css("left","-100%");
$("#appd-wrap-open-cnt").parent().show();
$("#appd-wrap-open-cnt").css("left","0%");
}
}

}
}
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

</script></div>
<div class="bottomNav">
<div class="layout">
<div class="copyright">
<p>��ICP��05004140��-10 ICP֤ ��B2-20110106&nbsp;&nbsp;&nbsp;�����һ�Ƽ����޹�˾��Ȩ����</p>
<p>�����з��գ�8264����������<a href="http://bx.8264.com/?8264com" target="_blank">���Ᵽ��</a></p>
</div>
<div class="someLink">
<a target="_blank" href="http://bbs.8264.com/member-clearcookies-formhash-d64f4f90.html" rel="nofollow">���COOKIE</a>
|
<?php if($_G['group']['allowstatdata']) { ?>
<a target="_blank" href="http://bbs.8264.com/misc-stat.html" rel="nofollow">վ��ͳ��</a> |
<?php } ?>
<a target="_blank" href="http://www.8264.com/about-contact.html" rel="nofollow">��ϵ����</a>
|
<a href="http://www.8264.com/about-contact.html#q4" rel="nofollow">8264��Ƹ</a>
|
<a href="http://bbs.8264.com/misc-faq.html" rel="nofollow">����</a>
<span class="app">
<a href="http://bbs.8264.com/thread-2317569-1-1.html" target="_blank" class="appIco_95x27" rel="nofollow"></a>
</span>
</div>
</div>
</div>
<?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
    <div class="crly">
        ���� <?php echo $_G['member']['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ����
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
<!-- �����Զ����� -->
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
<!-- //�����Զ����� -->
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