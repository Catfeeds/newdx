<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('list_850', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/portal/list_850.htm', './template/8264/common/header_8264_new.htm', 1509432222, 'diy', './data/template/2_diy_portal_list_850.tpl.php', 'data/diy', 'portal/list_850')
|| checktplrefresh('./template/8264/portal/list_850.htm', './template/8264/common/header_common.htm', 1509432222, 'diy', './data/template/2_diy_portal_list_850.tpl.php', 'data/diy', 'portal/list_850')
|| checktplrefresh('./template/8264/portal/list_850.htm', './template/8264/common/index_ad_top.htm', 1509432222, 'diy', './data/template/2_diy_portal_list_850.tpl.php', 'data/diy', 'portal/list_850')
;
block_get('7111,6997,7112,7113,7114,7132,7133,7134');?>
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
    <!--ͷ����洦��--><div>
<?php if($isShouYe == "index") { ?>    
<!--ͷ��������ʼ-->
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
<!-- ��ҳ������������-->
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
<!--��ҳ����������С��-->
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
<!--ͷ����������-->	
<?php } ?>
</div><!--ͷ����洦�� end-->
<div class="headerNav">
<div class="layout" id="heardnew">
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
<a href="<?php echo $_G['config']['web']['forum'];?>forum-12-1.html" class="first">�������</a>
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
        <li class="wan" style="width:67px;"><a href="http://www.8264.net/?from=top" class="topLink topLink_w_bg wkuan" target="_blank">ֵ����</a></li>
<li class="wan"><a href="http://bx.8264.com/?bbsbxnew" class="topLink topLink_w_bg wkuan" target="_blank">����</a></li>
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
<?php if(CURSCRIPT == 'forum') { ?><input type="hidden" name="nsid" value="2" /><?php } if(CURSCRIPT == 'question') { ?><input type="hidden" name="nsid" value="4" /><?php } ?>
<span id="searchTips" class="tips">����</span>
<input id="searchText" class="text" type="text" value="" name="q"/>
<input class="subButton" type="submit" value=""/>
</form>
</div>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; ?>
<div id="wp">
<!-- �ֻ�����ʾ -->
<?php if($_G['uid'] && !$_G['member']['telstatus']) { ?>
<style type="text/css">.realName{background-color:#fff2e5;box-shadow:0 0 1px #f5e2cf inset}.realName__container{width:980px;margin:0 auto;position:relative}.realName__close{position:absolute;right:0;overflow:hidden;top:22px}.realName__close--button{width:15px;height:15px;background:url(http://static.8264.com/static/images/close.png) no-repeat;text-indent:-99em;display:block}.realName__content{padding:15px 0;text-align:center}.realName__text{color:#4b3627;font-size:14px;background:url(http://static.8264.com/static/images/sos.png) no-repeat 0 50%;padding-left:30px}.realName__button--binding{display:inline-block;width:82px;height:28px;line-height:28px;border-radius:14px;font-size:14px;background-color:#ff5e33;color:#fefefe;box-shadow:0 4px 10px rgba(255,94,51,.44);margin-left:10px}.realName__button--binding:hover{color:#fefefe;text-decoration: none;}</style>
<div class="realName">
<div class="realName__container">
<div class="realName__close">
<a href="javascript:void(0);" class="realName__close--button">x</a>
</div>
<div class="realName__content">
<span class="realName__text">���ݹ�����ع涨�������Ȳ�����������ֻ��Ű󶨣�</span>
<a href="http://u.8264.com/home-setting.html#account-security" class="realName__button--binding">ȥ��</a>
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
<!-- //�ֻ�����ʾ -->
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/index2017.css">
<script src="http://static.8264.com/static/js/index_2017.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script>
<style id="diy_style" type="text/css">#framexEKux2 {  margin:0px !important;border:0px !important;}#portal_block_5094 {  margin:0px !important;border:0px !important;}#portal_block_5094 .content {  margin:0px !important;}#frameX85ynu {  margin:0px !important;border:0px !important;}#portal_block_5095 {  margin:0px !important;border:0px !important;}#portal_block_5095 .content {  margin:0px !important;}#framen4n263 {  margin:0px !important;border:0px !important;}#portal_block_5096 {  margin:0px !important;border:0px !important;}#portal_block_5096 .content {  margin:0px !important;}#frameo8N1N5 {  margin:0px !important;border:0px !important;}#portal_block_5097 {  margin:0px !important;border:0px !important;}#portal_block_5097 .content {  margin:0px !important;}#frameSku7o4 {  margin:0px !important;border:0px !important;}#portal_block_5098 {  margin:0px !important;border:0px !important;}#portal_block_5098 .content {  margin:0px !important;}#frameJ5h8Rm {  margin:0px !important;border:0px !important;}#frameHNCF9J {  margin:0px !important;border:0px !important;}#portal_block_5099 {  margin:0px !important;border:0px !important;}#portal_block_5099 .content {  margin:0px !important;}#portal_block_5100 {  margin:0px !important;border:0px !important;}#portal_block_5100 .content {  margin:0px !important;}#frameb6k38M {  margin:0px !important;border:0px !important;}#portal_block_5101 {  margin:0px !important;border:0px !important;}#portal_block_5101 .content {  margin:0px !important;}#frameBJDL6S {  margin:0px !important;border:0px !important;}#portal_block_5102 {  margin:0px !important;border:0px !important;}#portal_block_5102 .content {  margin:0px !important;}#frameH6Yh59 {  margin:0px !important;border:0px !important;}#portal_block_5108 {  margin:0px !important;border:0px !important;}#portal_block_5108 .content {  margin:0px !important;}#framempq3VI {  margin:0px !important;border:0px !important;}#portal_block_5119 {  margin:0px !important;border:0px !important;}#portal_block_5119 .content {  margin:0px !important;}#frameOToMVm {  margin:0px !important;border:0px !important;}#portal_block_5120 {  margin:0px !important;border:0px !important;}#portal_block_5120 .content {  margin:0px !important;}#frameH21GQY {  margin:0px !important;border:0px !important;}#portal_block_5121 {  margin:0px !important;border:0px !important;}#portal_block_5121 .content {  margin:0px !important;}#framek1TxV1 {  margin:0px !important;border:0px !important;}#portal_block_5152 {  margin:0px !important;border:0px !important;}#portal_block_5152 .content {  margin:0px !important;}#frameqIj62v {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5153 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5153 .content {  margin:0px !important;}#frame3UjfG6 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5154 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5154 .content {  margin:0px !important;}#framey3Jsng {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_5155 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_5155 .content {  margin:0px !important;}#frameIo6gEL {  margin:0px !important;border:0px !important;}#portal_block_5156 {  margin:0px !important;border:0px !important;}#portal_block_5156 .content {  margin:0px !important;}#framerpDB2g {  margin:0px !important;border:0px !important;}#portal_block_5157 {  margin:0px !important;border:0px !important;}#portal_block_5157 .content {  margin:0px !important;}#frame29Ol8W {  margin:0px !important;border:0px !important;}#portal_block_5158 {  margin:0px !important;border:0px !important;}#portal_block_5158 .content {  margin:0px !important;}#frame231hki {  margin:0px !important;border:0px !important;}#portal_block_5159 {  margin:0px !important;border:0px !important;}#portal_block_5159 .content {  margin:0px !important;}#frameJ8h461 {  margin:0px !important;border:0px !important;}#portal_block_5225 {  margin:0px !important;border:0px !important;}#portal_block_5225 .content {  margin:0px !important;}#frameGCLqcV {  margin:0px !important;border:0px !important;}#portal_block_5876 {  margin:0px !important;border:0px !important;}#portal_block_5876 .content {  margin:0px !important;}#frame99L9DO {  margin:0px !important;border:0px !important;}#portal_block_5877 {  margin:0px !important;border:0px !important;}#portal_block_5877 .content {  margin:0px !important;}#frame6jdMbC {  margin:0px !important;border:medium none !important;}#portal_block_6268 {  margin:0px !important;border:medium none !important;}#portal_block_6268 .content {  margin:0px !important;}#frameV7hB2B {  margin:0px !important;border:medium none !important;}#portal_block_6276 {  margin:0px !important;border:medium none !important;}#portal_block_6276 .content {  margin:0px !important;}#frameJIYq3z {  margin:0px !important;border:medium none !important;}#portal_block_6291 {  margin:0px !important;border:medium none !important;}#portal_block_6291 .content {  margin:0px !important;}#framewGkWlI {  margin:0px !important;border:medium none !important;}#portal_block_6292 {  margin:0px !important;border:medium none !important;}#portal_block_6292 .content {  margin:0px !important;}#framegeBx98 {  margin:0px !important;border:medium none !important;}#frameIZC5Dx {  margin:0px !important;border:medium none !important;}#portal_block_6293 {  margin:0px !important;border:medium none !important;}#portal_block_6293 .content {  margin:0px !important;}#portal_block_6295 {  margin:0px !important;border:medium none !important;}#portal_block_6295 .content {  margin:0px !important;}#frame5IxQ29 {  margin:0px !important;border:medium none !important;}#portal_block_6296 {  margin:0px !important;border:medium none !important;}#portal_block_6296 .content {  margin:0px !important;}#frameV7tcg7 {  margin:0px !important;border:medium none !important;}#portal_block_6297 {  margin:0px !important;border:medium none !important;}#portal_block_6297 .content {  margin:0px !important;}#frameWX441U {  margin:0px !important;border:medium none !important;}#portal_block_6298 {  margin:0px !important;border:medium none !important;}#portal_block_6298 .content {  margin:0px !important;}#frameE763r1 {  margin:0px !important;border:medium none !important;}#framed7wmR3 {  margin:0px !important;border:medium none !important;}#portal_block_6299 {  margin:0px !important;border:medium none !important;}#portal_block_6299 .content {  margin:0px !important;}#portal_block_6300 {  margin:0px !important;border:medium none !important;}#portal_block_6300 .content {  margin:0px !important;}#frame6e8eWP {  margin:0px !important;border:medium none !important;}#portal_block_6302 {  margin:0px !important;border:medium none !important;}#portal_block_6302 .content {  margin:0px !important;}#frameuPgWOC {  margin:0px !important;border:medium none !important;}#portal_block_6303 {  margin:0px !important;border:medium none !important;}#portal_block_6303 .content {  margin:0px !important;}#frameHr6Kco {  margin:0px !important;border:medium none !important;}#portal_block_6304 {  margin:0px !important;border:medium none !important;}#portal_block_6304 .content {  margin:0px !important;}#frame75N4s4 {  margin:0px !important;border:medium none !important;}#portal_block_6305 {  margin:0px !important;border:medium none !important;}#portal_block_6305 .content {  margin:0px !important;}#frame45fowP {  margin:0px !important;border:medium none !important;}#portal_block_6307 {  margin:0px !important;border:medium none !important;}#portal_block_6307 .content {  margin:0px !important;}#frameXVbP9P {  margin:0px !important;border:medium none !important;}#portal_block_6308 {  margin:0px !important;border:medium none !important;}#portal_block_6308 .content {  margin:0px !important;}#frame9B6v4F {  margin:0px !important;border:medium none !important;}#portal_block_6310 {  margin:0px !important;border:medium none !important;}#portal_block_6310 .content {  margin:0px !important;}#framenR8hX9 {  margin:0px !important;border:medium none !important;}#portal_block_6312 {  margin:0px !important;border:medium none !important;}#portal_block_6312 .content {  margin:0px !important;}#framee3qVls {  margin:0px !important;border:medium none !important;}#framedYm9Kz {  margin:0px !important;border:medium none !important;}#frameM179IN {  margin:0px !important;border:medium none !important;}#portal_block_6314 {  margin:0px !important;border:medium none !important;}#portal_block_6314 .content {  margin:0px !important;}#portal_block_6315 {  margin:0px !important;border:medium none !important;}#portal_block_6315 .content {  margin:0px !important;}#framev1kD1q {  margin:0px !important;border:medium none !important;}#portal_block_6316 {  margin:0px !important;border:medium none !important;}#portal_block_6316 .content {  margin:0px !important;}#frame8S7Whl {  margin:0px !important;border:medium none !important;}#portal_block_6317 {  margin:0px !important;border:medium none !important;}#portal_block_6317 .content {  margin:0px !important;}#frame3zqJE4 {  margin:0px !important;border:medium none !important;}#portal_block_6318 {  margin:0px !important;border:medium none !important;}#portal_block_6318 .content {  margin:0px !important;}#framefet7Z5 {  margin:0px !important;border:medium none !important;}#portal_block_6319 {  margin:0px !important;border:medium none !important;}#portal_block_6319 .content {  margin:0px !important;}#frame3T9BOI {  margin:0px !important;border:medium none !important;}#portal_block_6320 {  margin:0px !important;border:medium none !important;}#portal_block_6320 .content {  margin:0px !important;}#frame7FvQ13 {  margin:0px !important;border:medium none !important;}#portal_block_6321 {  margin:0px !important;border:medium none !important;}#portal_block_6321 .content {  margin:0px !important;}#frameBN4OqZ {  margin:0px !important;border:medium none !important;}#portal_block_6322 {  margin:0px !important;border:medium none !important;}#portal_block_6322 .content {  margin:0px !important;}#frame3QSUgF {  margin:0px !important;border:medium none !important;}#portal_block_6323 {  margin:0px !important;border:medium none !important;}#portal_block_6323 .content {  margin:0px !important;}#portal_block_6324 {  margin:0px !important;border:medium none !important;}#portal_block_6324 .content {  margin:0px !important;}#frameJZKwL5 {  margin:0px !important;border:medium none !important;}#portal_block_6325 {  margin:0px !important;border:medium none !important;}#portal_block_6325 .content {  margin:0px !important;}#frameMFo5Y3 {  margin:0px !important;border:medium none !important;}#frame13L581 {  margin:0px !important;border:medium none !important;}#portal_block_6329 {  margin:0px !important;border:medium none !important;}#portal_block_6329 .content {  margin:0px !important;}#framezLiVwL {  margin:0px !important;border:medium none !important;}#portal_block_6330 {  margin:0px !important;border:medium none !important;}#portal_block_6330 .content {  margin:0px !important;}#frame8M5H96 {  margin:0px !important;border:medium none !important;}#portal_block_6332 {  margin:0px !important;border:medium none !important;}#portal_block_6332 .content {  margin:0px !important;}#framecrURSj {  margin:0px !important;border:medium none !important;}#portal_block_6334 {  margin:0px !important;border:medium none !important;}#portal_block_6334 .content {  margin:0px !important;}#frameJyxx1v {  margin:0px !important;border:0px !important;}#portal_block_6364 {  margin:0px !important;border:0px !important;}#portal_block_6364 .content {  margin:0px !important;}#frame15Fsm3 {  margin:0px !important;border:0px !important;}#portal_block_6365 {  margin:0px !important;border:0px !important;}#portal_block_6365 .content {  margin:0px !important;}#frame21YgsU {  margin:0px !important;border:0px !important;}#portal_block_6366 {  margin:0px !important;border:0px !important;}#portal_block_6366 .content {  margin:0px !important;}#framePZX3vD {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6367 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6367 .content {  margin:0px !important;}#frame9ETWCp {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 !important;}#portal_block_6860 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 !important;}#portal_block_6860 .content {  margin:0px !important;}#frame86V8hd {  margin:0px !important;border:medium none !important;}#portal_block_6938 {  margin:0px !important;border:medium none !important;}#portal_block_6938 .content {  margin:0px !important;}#frame9B1MB1 {  margin:0px !important;border:medium none !important;}#portal_block_6939 {  margin:0px !important;border:medium none !important;}#portal_block_6939 .content {  margin:0px !important;}#frameywrn13 {  margin:0px !important;border:medium none !important;}#portal_block_6940 {  margin:0px !important;border:medium none !important;}#portal_block_6940 .content {  margin:0px !important;}#frameFi9kWc {  margin:0px !important;border:medium none !important;}#portal_block_6941 {  margin:0px !important;border:medium none !important;}#portal_block_6941 .content {  margin:0px !important;}#framek9766I {  margin:0px !important;border:medium none !important;}#portal_block_6942 {  margin:0px !important;border:medium none !important;}#portal_block_6942 .content {  margin:0px !important;}#frameFrpSCO {  margin:0px !important;border:medium none !important;}#portal_block_6943 {  margin:0px !important;border:medium none !important;}#portal_block_6943 .content {  margin:0px !important;}#framep5Xy2r {  margin:0px !important;border:medium none !important;}#portal_block_6945 {  margin:0px !important;border:medium none !important;}#portal_block_6945 .content {  margin:0px !important;}#frameh9uG8J {  margin:0px !important;border:medium none !important;}#portal_block_6946 {  margin:0px !important;border:medium none !important;}#portal_block_6946 .content {  margin:0px !important;}#frame35cR2e {  margin:0px !important;border:medium none !important;}#portal_block_6947 {  margin:0px !important;border:medium none !important;}#portal_block_6947 .content {  margin:0px !important;}#frameqq1i9b {  margin:0px !important;border:medium none !important;}#portal_block_6948 {  margin:0px !important;border:medium none !important;}#portal_block_6948 .content {  margin:0px !important;}#frameoyV3hi {  margin:0px !important;border:medium none !important;}#portal_block_6949 {  margin:0px !important;border:medium none !important;}#portal_block_6949 .content {  margin:0px !important;}#framehHN5IY {  margin:0px !important;border:medium none !important;}#portal_block_6950 {  margin:0px !important;border:medium none !important;}#portal_block_6950 .content {  margin:0px !important;}#frameM6XC96 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_6952 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_6952 .content {  margin:0px !important;}#framew9Pv91 {  background-color:transparent !important;background-image:none !important;margin:0px !important;}</style>
</head>

<body>
    <div class="w1100 mt20">
    	<!--ͷ����濪ʼ-->
<div class="clear_b">
        	<div class="adleft">
            	<!--��ҳ8264logo��С����SCARPA width="230" height="170" -->
            	<script type='text/javascript'><!--//<![CDATA[
               var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
               var m3_r = Math.floor(Math.random()*99999999999);
               if (!document.MAX_used) document.MAX_used = ',';
               document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
               document.write ("?zoneid=11");
               document.write ('&amp;cb=' + m3_r);
               if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
               document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
               document.write ("&amp;loc=" + escape(window.location));
               if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
               if (document.context) document.write ("&context=" + escape(document.context));
               if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
               document.write ("'><\/scr"+"ipt>");
            //]]>--></script>
                <span class="adtag"></span>
            </div>
            <div class="adright">
            	<div class="adbox">
                    <!--850_80-->
                    <script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=57");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script>
                	<span class="adtag"></span>
                </div>
                <div class="adbox mt10">
                    <!--850_80-->
                    <script type='text/javascript'><!--//<![CDATA[
                   var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
                   var m3_r = Math.floor(Math.random()*99999999999);
                   if (!document.MAX_used) document.MAX_used = ',';
                   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
                   document.write ("?zoneid=19");
                   document.write ('&amp;cb=' + m3_r);
                   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
                   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
                   document.write ("&amp;loc=" + escape(window.location));
                   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
                   if (document.context) document.write ("&context=" + escape(document.context));
                   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
                   document.write ("'><\/scr"+"ipt>");
                //]]>--></script>
                	<span class="adtag"></span>
                </div>
            </div>
        </div>
        <!--ͷ��������-->
        <div class="clear_b mt20">
        	<div class="ztbox">
            	<div class="zttitle">
                	<a href="http://www.8264.com/topic_list/" target="_blank"><i></i>�ר��</a>
                </div>
                <div class="ztlist">
                	<ul>
                        <?php block_display('7111'); ?>                    </ul>
                </div>
            </div>
            <div class="adright gray">
            	<div class="fontad clear_b">
                	<ul>
                        <li><?php echo adshow("custom_274"); ?></li>
                        <li><?php echo adshow("custom_275"); ?></li>
                        <li><?php echo adshow("custom_276"); ?></li>
                        <li><?php echo adshow("custom_277"); ?></li>
                        <li><?php echo adshow("custom_278"); ?></li>
                        <li><?php echo adshow("custom_279"); ?></li>
                        <li><?php echo adshow("custom_280"); ?></li>
                        <li><?php echo adshow("custom_281"); ?></li>
                    </ul>
                    <span class="adtag"></span>
                </div>
                <div class="adbox plr50 mtb10 clear_b">
                    <div style="float:left;">
                        <?php echo adshow("custom_453"); ?>                    </div>
                    <div style="float:right;">
                        <?php echo adshow("custom_454"); ?>                    </div>
                    <span class="adtag"></span></div>
            </div>
        </div>
        <!--��Ѷ��ʼ-->
        <div class="adbox mt20">
<script type='text/javascript'><!--//<![CDATA[
               var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
               var m3_r = Math.floor(Math.random()*99999999999);
               if (!document.MAX_used) document.MAX_used = ',';
               document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
               document.write ("?zoneid=13");
               document.write ('&amp;cb=' + m3_r);
               if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
               document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
               document.write ("&amp;loc=" + escape(window.location));
               if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
               if (document.context) document.write ("&context=" + escape(document.context));
               if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
               document.write ("'><\/scr"+"ipt>");
            //]]>--></script>
            <span class="adtag"></span>
      </div>
        <div class="mt20">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">��Ѷ</b>
                <div class="taglist">
                	<a href="http://www.8264.com/list/204/" target="_blank">װ��</a>
                    <a href="http://www.8264.com/list/746/" target="_blank">ר��</a>
                    <a href="http://www.8264.com/list/489/" target="_blank">ҵ��</a>
                    <a href="http://www.8264.com/list/733/" target="_blank">����</a>
                    <a href="http://www.8264.com/list/902/" target="_blank">����ͼ˵</a>
                </div>
                <a href="http://www.8264.com/list/751/" target="_blank" class="morelink">����</a>
            </div>
            <div class=" clear_b">
            	<div class="w740">
                	<!--��Ѷ��ʼ-->
                	<div class="">
                   <?php block_display('6997'); ?>                    </div>
                    <div class="">
                   <?php block_display('7112'); ?>                    </div>
                    <!--��Ѷ����-->
                </div>
                <div class="w300">
                	<div class="righttitle mt27" style="display:none;">װ����Ѷ</div>
                    <div class="zbzxbox" style="display:none;">
                        <div class="zbzxcon">
                            <!--װ��������ʼ-->
                            <?php if(is_array($article204_array)) foreach($article204_array as $artcle204_date => $article204_item) { ?>                            <div class="zbone">
                                <div class="zbtimebox">
                                    <span class="zbtimecon"><?php echo $artcle204_date;?></span>
                                    <div class="zbconlist">
                                         <?php if(is_array($article204_item)) foreach($article204_item as $val) { ?>                                        <a href="http://www.8264.com/viewnews-<?php echo $val['aid'];?>-page-1.html" target="_blank"><?php echo $val['title'];?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!--װ����������-->

                        </div>
                	</div>
                    <div class="adbox" style="margin-top:27px;">
<script type='text/javascript'><!--//<![CDATA[
                        var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
                        var m3_r = Math.floor(Math.random()*99999999999);
                        if (!document.MAX_used) document.MAX_used = ',';
                        document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
                        document.write ("?zoneid=5");
                        document.write ('&amp;cb=' + m3_r);
                        if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
                        document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
                        document.write ("&amp;loc=" + escape(window.location));
                        if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
                        if (document.context) document.write ("&context=" + escape(document.context));
                        if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
                        document.write ("'><\/scr"+"ipt>");
                        //]]>--></script>
                        <span class="adtag"></span>
                    </div>
                    <div class="adbox" style="margin-top:20px;">
                        <?php echo adshow("custom_461"); ?>                        <span class="adtag"></span>
                    </div>
                </div>
            </div>
        </div>
        <!--��Ѷ����-->

        <div class="adbox mt30">
<script type='text/javascript'><!--//<![CDATA[
               var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
               var m3_r = Math.floor(Math.random()*99999999999);
               if (!document.MAX_used) document.MAX_used = ',';
               document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
               document.write ("?zoneid=26");
               document.write ('&amp;cb=' + m3_r);
               if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
               document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
               document.write ("&amp;loc=" + escape(window.location));
               if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
               if (document.context) document.write ("&context=" + escape(document.context));
               if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
               document.write ("'><\/scr"+"ipt>");
            //]]>--></script>
            <span class="adtag"></span>
        </div>
        <div class="adbox mt10">
<script type='text/javascript'><!--//<![CDATA[
               var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
               var m3_r = Math.floor(Math.random()*99999999999);
               if (!document.MAX_used) document.MAX_used = ',';
               document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
               document.write ("?zoneid=14");
               document.write ('&amp;cb=' + m3_r);
               if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
               document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
               document.write ("&amp;loc=" + escape(window.location));
               if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
               if (document.context) document.write ("&context=" + escape(document.context));
               if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
               document.write ("'><\/scr"+"ipt>");
            //]]>--></script>
            <span class="adtag"></span>
        </div>
        <!--�μǿ�ʼ-->
        <div class="mt25">
        	<div class="bigtitlebox clear_b">
            	<b class="bigtitle">�μ�</b>
                <div class="taglist">
                	<a href="http://www.8264.com/youji/list-370976926840480-2-1.html" target="_blank">�Ĵ�</a>
                    <a href="http://www.8264.com/youji/list-370866516119456-2-1.html" target="_blank">����</a>
                    <a href="http://www.8264.com/youji/list-371031142404000-2-1.html" target="_blank">����</a>
                    <a href="http://www.8264.com/youji/list-371010400521888-1-1.html" target="_blank">�Ჴ��</a>
                    <a href="http://www.8264.com/list/881" target="_blank" class="xialudownload">100����·��������</a>
                </div>
                <a href="http://www.8264.com/youji/" target="_blank" class="morelink">����</a>
            </div>
            <div class=" clear_b">
            	<div class="w740">
                    <div><?php block_display('7113'); ?>                    </div>
                </div>
                <div class="w300">
                	<div class="righttitle mt27">�������е�<a href="http://www.8264.com/youji/" target="_blank" class="alllink">ȫ��</a></div>
                    <div class="hotmudidibox clear_b">
                        <ul>
                            <?php if(is_array($place_array)) foreach($place_array as $place_name) { ?>                            <li>
                                <a href="http://www.8264.com/youji/list-<?php echo $place_result[$place_name]['placeid'];?>-<?php echo $place_result[$place_name]['level'];?>-1.html" target="_blank">
                                    <span><?php echo $place_name;?></span>
                                    <em><?php echo $place_result[$place_name]['actnum'];?>ƪ</em>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="adbox" style="margin-top:15px;">
                    <?php echo adshow("custom_462"); ?>                    	<span class="adtag"></span>
                    </div>
                </div>
            </div>
        </div>
        <!--�μǽ���-->
        <div class="adbox mt30">
<script type='text/javascript'><!--//<![CDATA[
               var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
               var m3_r = Math.floor(Math.random()*99999999999);
               if (!document.MAX_used) document.MAX_used = ',';
               document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
               document.write ("?zoneid=15");
               document.write ('&amp;cb=' + m3_r);
               if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
               document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
               document.write ("&amp;loc=" + escape(window.location));
               if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
               if (document.context) document.write ("&context=" + escape(document.context));
               if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
               document.write ("'><\/scr"+"ipt>");
            //]]>--></script>
            <span class="adtag"></span>
        </div>
        <div class="mt25">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">����ѧУ</b>
                <div class="taglist">
                	<a href="http://www.8264.com/list/242" target="_blank">ͽ��</a>
                    <a href="http://www.8264.com/list/919" target="_blank">��ѩ</a>
                    <a href="http://www.8264.com/list/931" target="_blank">����</a>
                    <a href="http://www.8264.com/list/917" target="_blank">����</a>
                    <a href="http://www.8264.com/list/952" target="_blank">Ǳˮ</a>
                </div>
                <a href="http://www.8264.com/list/238/" target="_blank" class="morelink">����</a>
            </div>
            <div class=" clear_b">
            	<div class="w740">
                	<div class=""><?php block_display('7114'); ?>                    </div>
                </div>
                <div class="w300">
                	<div class="righttitle mt27">���⿼��</div>
                    <div class="mt20"><a href="http://www.8264.com/kaoshi/" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/kaoshiad.jpg"/></a></div>
                    <div class="kaoshilist mt20 clear_b" style="display:none;">
                    	<ul>
                        	<li><a href="#"><span>��ȫ����</span><em>8</em></a></li>
                            <li><a href="#"><span>��ȫ����</span><em>23</em></a></li>
                            <li><a href="#"><span>��ȫ����</span><em>123</em></a></li>
                            <li><a href="#"><span>��ȫ����</span><em>123</em></a></li>
                            <li><a href="#"><span>��ȫ����</span><em>123</em></a></li>
                            <li><a href="#"><span>��ȫ����</span><em>123</em></a></li>
                            <li><a href="#"><span>��ȫ����</span><em>123</em></a></li>
                            <li><a href="#"><span>��ȫ����</span><em>123</em></a></li>
                            <li><a href="#"><span>��ȫ����</span><em>123</em></a></li>
                            <li><a href="#"><span>��ȫ����</span><em>123</em></a></li>
                        </ul>
                    </div>
                    <div class="kaoshilist clear_b">
                    	<ul>
                        	<li><a href="http://www.8264.com/kaoshi/type-exam-cat-1.html" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/xuicon1.png"><span>�������</span></a></li>
                            <li><a href="http://www.8264.com/kaoshi/type-exam-cat-2.html" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/xuicon2.png"><span>��ȫ����</span></a></li>
                            <li class="end"><a href="http://www.8264.com/kaoshi/type-exam-cat-9.html" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/xuicon3.png"><span>��ѩ</span></a></li>
                        </ul>
                    </div>
                    <div class="righttitle" style="margin-top:36px;">������ѵ</div>
                    <div class="trainbox"><?php echo adshow("custom_455"); ?>                    </div>
                </div>
            </div>
        </div>
        <!--��·��ʼ-->
        <div class="mt25">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">��·</b>
                <a href="http://hd.8264.com/" class="hdad" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/hdad.png"/></a>
                <a href="http://hd.8264.com/" class="morelink" target="_blank">����</a>
            </div>
            <div class="clear_b">
            	<div class="w740">
                    <div class="hdtop clear_b">
                    <?php if(is_array($xl_result_left_one)) foreach($xl_result_left_one as $id => $item) { ?>                    	<div class="hdtopone <?php if($id>0) { ?> hdtoponeright <?php } ?>">
                            <?php if($item['goods_id']) { ?>
                                <div class="hdbigimg"><a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank"><img src="<?php echo $item['default_image'];?>" /></a></div>
                                <div class="hdtopinfobox">
                                    <a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank"><?php echo $item['title'];?></a>
                                    <div class="didian_datebox clear_b">
<span class="didianleft">
                                        	<b><i>&yen;</i><?php echo $item['price'];?></b>
                                            <em class="begin" style="display:none"><?php echo $item['start_place'];?></em>
                                            <em class="end" style="display:none;"><?php echo $item['end_place'];?></em>
                                        </span>
                                        <span class="dateright"><?php echo $item['start_place'];?>����</span>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="hdbigimg"><a href="<?php echo $item['url_pc'];?>" target="_blank"><img src="<?php echo $item['default_image'];?>" /></a></div>
                                <div class="hdtopinfobox">
                                    <a href="<?php echo $item['url_pc'];?>" target="_blank"><?php echo $item['title'];?></a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="hdlistbox">
                        <?php if(is_array($xl_result_left_two)) foreach($xl_result_left_two as $id => $item) { ?>                            <div class="hdlistone">
                                <div class="hdlistimg">
                                        <a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank"><img src="<?php echo $item['default_image'];?>"></a>
                                </div>
                                <div class="newsinfo">
                                    <div class="hdtitlebox clear_b">
                                        <h2><a href="http://hd.8264.com/xianlu-<?php echo $item['cate_id'];?>-0-0-0-1" class="channel" target="_blank"><?php echo $item['cate_name'];?></a><a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank"><?php echo $item['title'];?></a></h2>
                                    </div>
                                    <div class="hdinfocon">��<?php echo $item['store_name'];?>�ṩ����</div>
                                    <div class="hdinfobox clear_b">
<span class="didianleft" style="display:none;">
                                            <em class="begin"><?php echo $item['start_place'];?></em>
                                            <em class="end"><?php echo $item['end_place'];?></em>
                                        </span>
                                        <em class="timeicon"><?php echo $item['goods_spec']['m'];?>-<?php echo $item['goods_spec']['d'];?></em>
                                        <span class="liulan"><?php echo $item['start_place'];?>����</span>
                                        <b><i>&yen;</i><?php echo $item['price'];?></b>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="w300">
                    <div class="righttitle mt27">��ĩ�<a href="http://hd.8264.com/xianlu-0-0-0-<?php echo $xl_result_right['placecode'];?>-0-3-1?start=1" class="mudidi" target="_blank"><?php echo $xl_result_right['city'];?></a></div>
                    <div class="weektitlebox" id="weektitlebox" style="display:none;">
                        <?php if(is_array($xl_result_right['data'])) foreach($xl_result_right['data'] as $id => $item) { ?>                            <a href="#" class="<?php if($id == 0) { ?> act <?php } ?>"><?php echo $item['date'];?>��</a>
                        <?php } ?>
                    </div>
                    <div id="weekbox">
                        <?php if(is_array($xl_result_right['data'])) foreach($xl_result_right['data'] as $id => $item) { ?>                        <div class="weekbox" >
                            <!--������ʼ-->
                            <div class="weekcon">
                                <div class="weekdate">
                                    <b><?php echo $item['date'];?></b>
                                    <em><?php if($item['month']) { ?><?php echo $item['month'];?>��<?php } else { ?>����<?php } ?></em>
                                </div>
                                <div class="weekinfo">
                                    <a href="http://hd.8264.com/xianlu-<?php echo $item['goods_id'];?>" target="_blank"><?php echo $item['title'];?></a>
                                    <div class="weektxgz clear_b">
                                        <span><?php echo $item['store_name'];?></span>
                                    </div>
                                </div>
                            </div>
                            <!--��������-->
                        </div>
                        <?php } ?>
                    </div>
                    <div class="righttitle mt40">�����淨</div>
                    <div class="hotmudidibox clear_b" style=" margin-top:30px;">
                        <ul>
                            <?php if(is_array($xl_result_right_bottom)) foreach($xl_result_right_bottom as $item) { ?>                            <li>
                                <a href="http://hd.8264.com/xianlu-<?php echo $item['cate_id'];?>-0-0-0-0-0-2-1" target="_blank">
                                    <span><?php echo $item['cate_name'];?></span>
                                    <em><?php echo $item['count'];?>��</em>
                                </a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="http://hd.8264.com/xianlu-0-0-0-0-0-0-2-1" target="_blank">
                                   <i>ȫ��</i>
                                </a>
                            </li>
</ul>
                    </div>
                </div>
            </div>
        </div>
        <!--��·����-->
        <div class="adbox mt30">
            <?php echo adshow("custom_457"); ?>            <span class="adtag"></span>
        </div>
        <!--�ʴ������ʼ-->
        <div class="mt25">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">�ʴ𡤵���</b>
                <div class="taglist">
                	<a href="http://www.8264.com/wenda/list-0-10000062-1.html" target="_blank">�����˶�</a>
                    <a href="http://www.8264.com/wenda/list-0-10000015-1.html" target="_blank">ͽ��</a>
                    <a href="http://www.8264.com/wenda/list-0-10000007-1.html" target="_blank">���ⰲȫ</a>
                    <a href="http://www.8264.com/wenda/list-0-10000034-1.html" target="_blank">����</a>
                    <a href="http://www.8264.com/wenda/list-0-10000064-1.html" target="_blank">��ɽ</a>
                    <a href="http://www.8264.com/wenda/list-0-10000020-1.html" target="_blank">��ѩ</a>
                </div>
                <a href="http://www.8264.com/wenda/" target="_blank" class="morelink">����</a>
            </div>
            <div class=" clear_b mt25">
            	<div class="w740">
                	<!--�ʴ�ʼ-->
                	<div class="askbox clear_b">
                    	<div class="askcon">
                            <!--������ʼ-->
                            <!-- <?php if(is_array($question_list)) foreach($question_list as $question_one) { ?> -->
                            <div class="askone">
                                <div class="asktop">
                                    <?php echo $question_one['textauthoravatar'];?>
                                    <div class="askinfo">
                                        <span><?php echo $question_one['textauthor'];?></span><em>�ش��˸�����</em>
                                        <a href="http://www.8264.com/wenda/<?php echo $question_one['topicid'];?>.html" target="_blank"><?php echo $question_one['title'];?></a>
                                    </div>
                                </div>
                                <div class="answerbox">
                                    <div class="answercon">
                                        <?php echo $question_one['textrcontent'];?>
                                    </div>
                                </div>
                            </div>
                            <!-- <?php } ?> -->
                            <!--��������-->
                        </div>
                    </div>
                    <!--�ʴ����-->
                </div>
                <div class="w300">
<div class="dianpinglist">
                    	<div class="dianpingtitle" id="dianpingtitle">
                            <a href="http://www.8264.com/xianlu" class="act" target="_blank">��·</a>
                            <a href="http://www.8264.com/zhuangbei" target="_blank">װ��</a>
                            <a href="http://www.8264.com/shanfeng" target="_blank">ɽ��</a>
                            <a href="http://www.8264.com/xuechang" target="_blank">��ѩ��</a>
                        </div>
                        <div id="dianpingcong">
                            <div class="dianpingcon">
                                <!-- <?php if(is_array($linediList)) foreach($linediList as $k => $v) { ?> -->
                                <div class="dianpingone">
                                	<em class="fenshu"><?php if($v['price'] < 10) { ?><?php echo $v['price'];?><?php } else { echo intval($v['price']); } ?></em>
                                    <div class="dianpininfo">
                                    	<a href="http://www.8264.com/xianlu-<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank"><?php echo $v['name'];?></a>
                                        <span class="score-value score-value-<?php echo floor($v['price']); ?>">
                                        	<em></em>
                                        </span>
                                    </div>
                                </div>
                                <!-- <?php } ?> -->
                            </div>

                            <div class="dianpingcon" style="display:none">
                                <!-- <?php if(is_array($eqdiList)) foreach($eqdiList as $k => $v) { ?> -->
                                <div class="dianpingone">
                                	<em class="fenshu"><?php if($v['price'] < 10) { ?><?php echo $v['price'];?><?php } else { echo intval($v['price']); } ?></em>
                                    <div class="dianpininfo">
                                    	<a href="http://www.8264.com/zhuangbei-<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank"><?php echo $v['name'];?></a>
                                        <span class="score-value score-value-<?php echo floor($v['price']); ?>">
                                        	<em></em>
                                        </span>
                                    </div>
                                </div>
                                <!-- <?php } ?> -->
                            </div>

                            <div class="dianpingcon" style="display:none">
                                <!-- <?php if(is_array($mountainList)) foreach($mountainList as $k => $v) { ?> -->
                                <div class="dianpingone">
                                	<em class="fenshu"><?php if($v['price'] < 10) { ?><?php echo $v['price'];?><?php } else { echo intval($v['price']); } ?></em>
                                    <div class="dianpininfo">
                                    	<a href="http://www.8264.com/shanfeng-<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank"><?php echo $v['name'];?></a>
                                        <span class="score-value score-value-<?php echo floor($v['price']); ?>">
                                        	<em></em>
                                        </span>
                                    </div>
                                </div>
                                <!-- <?php } ?> -->
                            </div>

                            <div class="dianpingcon" style="display:none">
                                <!-- <?php if(is_array($skidiList)) foreach($skidiList as $k => $v) { ?> -->
                                <div class="dianpingone">
                                	<em class="fenshu"><?php if($v['price'] < 10) { ?><?php echo $v['price'];?><?php } else { echo intval($v['price']); } ?></em>
                                    <div class="dianpininfo">
                                    	<a href="http://www.8264.com/xuechang-<?php echo $v['tid'];?>" title="<?php echo $v['name'];?>" target="_blank"><?php echo $v['name'];?></a>
                                        <span class="score-value score-value-<?php echo floor($v['price']); ?>">
                                        	<em></em>
                                        </span>
                                    </div>
                                </div>
                                <!-- <?php } ?> -->
                            </div>



</div>
                    </div>
                </div>
            </div>
        </div>
        <!--�ʴ��������-->
        <!--���ʼ-->
        <div class="">
            <div class="bigtitlebox clear_b">
            	<b class="bigtitle">8264�</b>
                <a href="http://www.8264.com/link/marketing.html" target="_blank" class="morelink">����</a>
            </div>
            <div class=" clear_b mt25"><?php echo adshow("custom_458"); ?>            </div>
            <div class="clear_b bbstschannel">
            	<a href="http://www.8264.com/list/842/" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/mryt.jpg"></a>
                <a href="http://www.8264.com/pp" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/kqmg.jpg"></a>
                <a href="http://www.8264.com/list/880/" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/yzxx.jpg"></a>
                <a href="http://www.8264.com/list/912/" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/hwsys.jpg"></a>
                <a href="http://www.8264.com/list/871/" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/sfc.jpg"></a>
            </div>
        </div>
        <!--�����-->
    </div>
    <div class="difangbanbox">
    	<!--�ط���ʼ-->
    	<div class="w1100 clear_b pb26">
        	<div class="dfbone first">
            	<div class="dfbtitle">�ۺϰ�</div>
                <?php block_display('7132'); ?>            </div>
            <div class="dfbone middle">
            	<div class="dfbtitle">רҵ��</div><?php block_display('7133'); ?>            </div>
            <div class="dfbone end">
            	<div class="dfbtitle">�ط���</div>
                <?php block_display('7134'); ?>            </div>
        </div>
        <!--�ط�����-->
    </div>
    <div class="friendLinkbox">
    	<div class="w1100 border_t">
        	<div class="border_t_linght clear_b pt26">
            	<a target="_blank" href="http://hd.8264.com/mudidi">�������λ</a>
                <a target="_blank" href="http://www.ly.com/">ͬ����</a>
                <a target="_blank" href="http://www.mafengwo.cn/">��������ι���</a>
                <a target="_blank" href="http://www.tieyou.com/">��Ʊ</a>
                <a target="_blank" href="http://www.cncn.com/">����������</a>
                <a target="_blank" href="http://www.21rv.com/">21���ͷ�����</a>
                <a target="_blank" href="http://www.qyer.com/">������</a>
                <a target="_blank" href="http://travel.people.com.cn/GB/index.html">����������</a>
                <a target="_blank" href="http://www.kdnet.net/">��������</a>
                <a target="_blank" href="http://travel.163.com/">��������</a>
                <a target="_blank" href="http://trip.elong.com/">��������ָ��</a>
                <a target="_blank" href="http://www.tripadvisor.cn/">TripAdvisor</a>
                <a target="_blank" href="http://shanghai.anjuke.com/">�Ϻ�������</a>
                <a target="_blank" href="http://www.tvtour.com.cn/">����������</a>
                <a target="_blank" href="http://www.51766.com/">51766����</a>
                <a target="_blank" href="http://www.asian-outdoor.com/">���޻���չ</a>
                <a target="_blank" href="http://bbs.8264.com/thread-2099485-1-1.html">ϲ������</a>
                <a target="_blank" href="http://www.9tour.cn/">������</a>
                <a target="_blank" href="http://www.lvmama.com/">¿����������</a>
                <a target="_blank" href="http://www.mipang.com/">����������</a>
                <a target="_blank" href="http://www.deyi.com/">��������</a>
                <a target="_blank" href="http://www.xialv.com/">�����ܱ���</a>
                <a target="_blank" href="http://www.guolv.com/">����������</a>
                <a target="_blank" href="http://www.tianqi.com/">����Ԥ����ѯ</a>
                <a target="_blank" href="http://www.co188.com/">��ľ������</a>
                <a target="_blank" href="http://www.zhuna.cn/">�Ƶ�Ԥ��</a>
                <a target="_blank" href="http://www.docin.com/">������</a>
                <a target="_blank" href="http://www.meet99.com/">��Լ�þ�������</a>
                <a target="_blank" href="http://www.changtu.com/">��;����Ʊ</a>
                <a target="_blank" href="http://www.19lou.com/">19¥</a>
                <a target="_blank" href="http://www.8264.com/list/885">������ַ��ȫ</a>
                <a target="_blank" href="plugin.php?id=friendlylink:add&amp;type=1|0&amp;n=8264%BB%A7%CD%E2%D7%CA%D1%B6&amp;l=http%3A%2F%2Fwww.8264.com&amp;h=b93f35df7beb5d9d49ecb98b36d325ba">��������</a>
            </div>
        </div>
    </div>
    <!--�ײ���ʼ-->
    <div class="footerbox">
    	<div class=" w1100 clear_b">
        	<div class="footleftbox">
            	<div class="foot_left_top">
                	�����з��գ�8264����������<a href="http://bx.8264.com/?8264com" target="_blank">���Ᵽ��</a>
                    <a target="_blank" href="http://bbs.8264.com/member-clearcookies-formhash-d64f4f90.html" rel="nofollow">���COOKIE</a>
                    |
                    <a target="_blank" href="http://bbs.8264.com/misc-stat.html" rel="nofollow">վ��ͳ��</a>
                    |
                    <a target="_blank" href="http://www.8264.com/about-contact.html" rel="nofollow">��ϵ����</a>
                    |
                    <a href="http://www.8264.com/about-contact.html#q4" rel="nofollow">8264��Ƹ</a>
                    |
                    <a href="http://bbs.8264.com/misc-faq.html" rel="nofollow">����</a>
                    |
                    <a href="http://bbs.8264.com/thread-2317569-1-1.html" style="color:#00b4f9;">8264�ֻ�������</a>
                </div>
                <div class="foot_left_bottom">��ICP��05004140��-10&nbsp;&nbsp;&nbsp;ICP֤ ��B2-20110106&nbsp;&nbsp;&nbsp;�����һ�Ƽ����޹�˾��Ȩ����</div>
            </div>
            <div class="footrightbox">
            	<a class="qdcionbottom" href="http://na3.tjaic.gov.cn/netmonitor/query/ScrNetEntQuery/Display.do?show=1&amp;id=6eb59bd37f0000011ec3c0e5a59f7891-1-v-e-r-&amp;ztLOID=8b4b03e47f0000012b8f0a26c9a87e67" target="_blank"><img src="http://na3.tjaic.gov.cn/netmonitor/images/guohui.png" width="49px"></a>
            </div>
        </div>
    </div>
    <!--�ײ�����-->

<!-- ���λ����ҳ���½����չ�濪ʼ -->
<style>
.bottomclosebox{ height:15px;border:1px solid #e1e1e1; margin:0;padding:0;overflow:hidden; background:#f0f0f0; }
.closeltbutton{ background:url(http://static.8264.com/static/images/moban/index2013/images/closecamle.gif) 0 0 no-repeat; cursor: pointer;float: right;height: 13px; margin: 2px 5px 0 0;width: 39px;}
.closeltbutton:hover{ background:url(http://static.8264.com/static/images/moban/index2013/images/closecamle.gif) 0 -20px no-repeat; }
.smallcamelbox{ width:200px; height:217px; overflow: hidden; z-index: 2147483647; right: 0px; bottom: 0px; position: fixed!important; position: absolute;}
</style>
<div class="smallcamelbox">
<!-- ���λ������˫11��ҳ���½ǣ�С��390  -->
<script type='text/javascript'><!--//<![CDATA[
       var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
       var m3_r = Math.floor(Math.random()*99999999999);
       if (!document.MAX_used) document.MAX_used = ',';
       document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
       document.write ("?zoneid=7");
       document.write ('&amp;cb=' + m3_r);
       if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
       document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
       document.write ("&amp;loc=" + escape(window.location));
       if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
       if (document.context) document.write ("&context=" + escape(document.context));
       if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
       document.write ("'><\/scr"+"ipt>");
    //]]>--></script>
    <div class="bottomclosebox">
        <span class="closeltbutton"></span>
        <div style="clear:both; font-size:0px; line-height:0px; height:0px;"></div>
    </div>
</div>
<script type="text/javascript">
jQuery(function(){
jQuery(".closeltbutton").click(function(){
jQuery(".smallcamelbox").hide();
});
});
</script>

</body>
</html>
