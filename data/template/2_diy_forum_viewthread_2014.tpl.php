<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/common/header_8264_new.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/common/fastnavigation.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/forum/viewthread_node_2014.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/forum/viewthread_fastpost_2014.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/common/weixin_share.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/common/camel_ad.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/common/footer_forum_8264_new.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/common/header_common.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/common/index_ad_top.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/forum/viewthread_node_body_2014.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/common/seditor_new_2014.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
|| checktplrefresh('./template/8264/forum/viewthread_2014.htm', './template/8264/common/footer_8264_new.htm', 1509517866, 'diy', './data/template/2_diy_forum_viewthread_2014.tpl.php', './template/8264', 'forum/viewthread_2014')
;
block_get('6905');?>
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
<link href="http://static.8264.com/static/css/forum/forum_viewthread.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/viewthread.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<script src="http://static.8264.com/static/js/common/viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script type="text/javascript">var fid = parseInt('<?php echo $_G['fid'];?>'), tid = parseInt('<?php echo $_G['tid'];?>');</script>
<?php if($modmenu['thread'] || $modmenu['post']) { ?>
<script src="http://static.8264.com/static/js/forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>

<script src="http://static.8264.com/static/js/forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">zoomstatus = parseInt(<?php echo $_G['setting']['zoomstatus'];?>);var imagemaxwidth = '<?php echo IMAGEMAXWIDTH;?>';var aimgcount = new Array();</script>

<div class="header">
<div class="layout">
<style>
.dsad{ position:absolute; left:590px; top:18px;}
</style>
<div class="dsad"><?php echo adshow("custom_290"); ?></div>
<div class="icoHill">ɽ</div>
<div class="headerL">
<?php if($_G['forum']['extra']['localname']) { ?>
<div class="whereIs" style="display: none;"><?php echo $_G['forum']['extra']['localname'];?></div>
<?php } ?>
<h5><span class="country"><a href="<?php echo $forumnameurl;?>"><?php echo $_G['forum']['name'];?></a></span></h5>
<div class="site">
<a href="<?php echo $_G['config']['web']['portal'];?>" title="��ҳ" id="fjump"<?php if($_G['setting']['forumjump'] == 1) { ?> onmouseover="showMenu({'ctrlid':this.id})"<?php } ?>>��ҳ</a>
<?php echo $navigation;?>
<?php if($_G['forum_thread']['typeid'] && $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]) { ?>
    <?php $dm=$forumOption->getdomainbyfidandtypeid($_G['fid'],$_G[forum_thread][typeid]); ?>    <?php if($dm) { ?>
     <em>&rsaquo;</em> <a href="http://<?php echo $dm;?>.8264.com/" class="fl_name"><?php echo $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']];?></a>
    <?php } else { ?>
     <em>&rsaquo;</em> <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=typeid&amp;typeid=<?php echo $_G['forum_thread']['typeid'];?>" class="fl_name"><?php echo $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']];?></a>
    <?php } } ?>
 <em>&rsaquo;</em> <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>" class="titleoverflow200"><?php echo $_G['forum_thread']['subject'];?><div class="boxtm"></div></a>
</div>
</div>
<div class="headerR">
<div class="bbsNumCount">
<div class="numBox">
<p class="num"><?php echo $_G['forum']['threads'];?></p>
<p class="day">����</p>
</div>
<div class="numBox">
<p class="num"><?php echo $_G['forum']['todayposts'];?></p>
<p class="day">����</p>
</div>
</div>
</div><style>
.nav_t_p_a{ width:980px; border:#d8d8d8 solid 1px; position:absolute; top:52px; right:0px;z-index: 6363;background: #fff; box-shadow: 0 2px 5px #CCCCCC}
.nav_t_p_a dl{ display:table; border-bottom:#d8d8d8 solid 1px; width:100%; margin:0;  padding:11px 0px 6px 0px; background:url(http://static.8264.com/static/image/common/bbsnavbg.jpg) -21px 0px repeat-y;}
.nav_t_p_a dl.without_b{ border-bottom:none 0;}
.nav_t_p_a dt{ float:left; width:94px; margin:0px; padding:0px; text-indent:15px; height:100%;font-size:12px; color:#fff;}
.nav_t_p_a dd{ margin:0px; padding:0px; overflow:hidden;}
.nav_t_p_a dd a{ margin:0px 20px 5px 0px; display:inline-block; white-space: nowrap;}
.nav_t_p_a dd a:hover{ color:#43A6DF;}
.headerL .site .xlsj{ padding:0px 16px 0px 0px; background:url(http://static.8264.com/static/image/common/arrow_xl.jpg) 51px 7px no-repeat; }
.headerL .site .xlsj_down{ padding:0px 16px 0px 0px; background:url(http://static.8264.com/static/image/common/arrow_xl.jpg) 51px -8px no-repeat; }

</style>
<?php if($catlist) { ?>
<div class="nav_t_p_a" style="display: none;"><?php if(is_array($catlist)) foreach($catlist as $key => $cat) { ?><dl <?php if($cat['extra']['classname']) { ?>class="bg"<?php } ?>>
<dt><?php echo $cat['name'];?></dt>		
<?php if($cat['forumcolumns'] == 0) { ?>
<dd><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { ?><?php $forum['domain']=$alldomainwithfid[$forumid]; ?> <?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forumid; ?><a href="<?php echo $forumurl;?>">
<i><?php echo $forumlist[$forumid]['name'];?></i>								
</a>
<?php } ?>
</dd>
<?php } else { ?>
<dd><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { ?><?php $forum['domain']=$alldomainwithfid[$forumid]; ?> <?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forumid; ?> 

<?php if($forumlist[$forumid]['extra']['localname'] != '') { } else { } ?>

<a href="<?php if($forumlist[$forumid]['redirect']) { ?><?php echo $forumlist[$forumid]['redirect'];?>" target="_blank"<?php } else { ?><?php echo $forumurl;?>"<?php } ?> ><?php echo $forumlist[$forumid]['name'];?> <?php if($forumid == 493) { } else { } ?></a>



<?php } ?>
</dd>
<?php } ?>		
</dl>

<?php } ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){	
$('.site .xlsj, .nav_t_p_a').hover(function(){	
clearTimeout(window.acCtrl);		
$(".nav_t_p_a").show();
},function(){		
window.acCtrl=setTimeout(function(){$(".nav_t_p_a").hide();},300);
});
})
</script>
<?php } ?>		

</div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_top'])) echo $_G['setting']['pluginhooks']['viewthread_top']; ?>

<div style="width:980px; margin:10px auto 0px auto; position:relative;">
<!-- ���λ����̳��������ҳ-kailas -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://ads.8264.com/www/delivery/ajs.php':'http://ads.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=22");
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


<div class="layout mt10"><?php echo adshow("text/layout"); ?></div>


<div style="width:980px; margin:10px auto 10px auto; position:relative;">
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://stats.8264.com/www/delivery/ajs.php':'http://stats.8264.com/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=88");
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


<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>


<div class="layout pb16" style="position:relative;">
<div class="forum_post">
<span id="btn_box" class="forum_post_button" style="display:none;">
<?php if($_G['forum']['threadsorts'] && $_G['forum']['threadsorts']['templatelist']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $name) { ?><button id="newspecial" class="pn pnc" onclick="location.href='forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?>&extra=<?php echo $extra;?>&sortid=<?php echo $id;?>'"><strong>��Ҫ<?php echo $name;?></strong></button>
<?php } } else { if(!$_G['forum_thread']['is_archived']) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>" title="������"  style="display: block; width:133px; height:43px;"></a>
<?php } } if($_G['uid']) { ?>
<em id="btn_list" class="forum_post_outcon" style="display: none;">
<em class="forum_post_out">
<?php if(!$_G['forum']['allowspecialonly']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>">��������</a><?php } if($_G['group']['allowpostpoll']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">����ͶƱ</a><?php } if($_G['group']['allowpostreward']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">��������</a><?php } if($_G['group']['allowpostdebate']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">�������</a><?php } if($_G['group']['allowpostactivity']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=4">����</a><?php } if($_G['group']['allowposttrade']) { ?><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=2">������Ʒ</a><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a>
<?php } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;sortid=<?php echo $id;?>"><?php echo $threadsorts;?></a>
<?php } } } ?>
</em>
</em>
<?php } ?>
</span>
<?php if($allowpostreply && !$_G['forum_thread']['archiveid']) { ?>
<a class="huf_button" href="javascript:;" onclick="showWindow(<?php if($_G['uid']) { ?>'reply','forum.php?mod=post&action=reply&fid=<?php echo $_G['fid'];?>&tid=<?php echo $_G['tid'];?>'<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)" title="�ظ�"></a>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbutton_top'])) echo $_G['setting']['pluginhooks']['viewthread_postbutton_top']; ?>
</div>
<div class="list_pager">
<?php if(!$postcount && !$_G['forum_thread']['archiveid']) { ?>
<div class="lcsrcon clboth">
        <style>
.zi div{ display:inline;}
.lcsrcon .zi{ font-size:0px;}
.lcsrcon .zi a{ font-size:12px;}
        </style>
<span class="zi" style="font-size:12px;">��</span><span class="zi" style="font-size:12px;">��</span><span class="lcsr" title="���س�������ת��ָ��¥��"><input type="text" onkeydown="if(event.keyCode==13) {window.location='forum.php?mod=redirect&ptid=<?php echo $_G['tid'];?>&authorid=<?php echo $_G['gp_authorid'];?>&postno='+this.value;return false;}" /></span>
<span class="zi" style="font-size:12px;">¥</span>
</div>
<?php } ?>
<?php echo $multipage;?>
</div>
</div>

<?php if($modmenu['post']) { ?>
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
<h3>ѡ��&nbsp;<strong id="mdct" class="xi1"></strong>&nbsp;ƪ: </h3>
<?php if($_G['forum']['ismoderator']) { if($_G['group']['allowwarnpost']) { ?><a href="javascript:;" onclick="modaction('warn')">����</a><span class="pipe">|</span><?php } if($_G['group']['allowbanpost']) { ?><a href="javascript:;" onclick="modaction('banpost')">����</a><span class="pipe">|</span><?php } if($_G['group']['allowdelpost']) { ?><a href="javascript:;" onclick="modaction('delpost')">ɾ��</a><span class="pipe">|</span><?php } if($_G['group']['allowstickreply']) { ?><a href="javascript:;" onclick="modaction('stickreply')">�ö�</a><span class="pipe">|</span><?php } } if($_G['forum_thread']['pushedaid'] && $allowpostarticle) { ?><a href="javascript:;" onclick="modaction('pushplus', '', 'aid=<?php echo $_G['forum_thread']['pushedaid'];?>', 'portal.php?mod=portalcp&ac=article&op=pushplus')">��������</a><span class="pipe">|</span><?php } ?>
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
<?php } if($modmenu['thread']) { ?>
<div class="layout">
<div class="glxm" id="modmenu"><?php $modopt=0; if($_G['forum']['ismoderator']) { if($_G['group']['allowdelpost']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(3, 'delete', <?php echo $_G['forum_thread']['typeid'];?>)">ɾ��</a><?php } if($_G['group']['allowbumpthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(3, 'down', <?php echo $_G['forum_thread']['typeid'];?>)">����</a><?php } if($_G['group']['allowstickthread'] && ($_G['forum_thread']['displayorder'] <= 3 || $_G['adminid'] == 1) && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(1, 'stick', <?php echo $_G['forum_thread']['typeid'];?>)">�ö�</a><?php } if($_G['group']['allowhighlightthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(1, 'highlight', <?php echo $_G['forum_thread']['typeid'];?>)">����</a><?php } if($_G['group']['allowdigestthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(1, 'digest', <?php echo $_G['forum_thread']['typeid'];?>)">����</a><?php } if($_G['group']['allowrecommendthread'] && !empty($_G['forum']['modrecommend']['open']) && $_G['forum']['modrecommend']['sort'] != 1 && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(1, 'recommend', <?php echo $_G['forum_thread']['typeid'];?>)">�Ƽ�</a><?php } if($_G['group']['allowstampthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('stamp')">ͼ��</a><?php } if($_G['group']['allowstamplist'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('stamplist')">ͼ��</a><?php } if($_G['group']['allowclosethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(4, '', <?php echo $_G['forum_thread']['typeid'];?>)"><?php if(!$_G['forum_thread']['closed']) { ?>�ر�<?php } else { ?>��<?php } ?></a><?php } if($_G['group']['allowmovethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(2, 'move', <?php echo $_G['forum_thread']['typeid'];?>)">�ƶ�</a><?php } if($_G['group']['allowedittypethread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modthreads(2, 'type', <?php echo $_G['forum_thread']['typeid'];?>)">����</a><?php } if(!$_G['forum_thread']['special'] && !$_G['forum_thread']['is_archived']) { if($_G['group']['allowcopythread'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('copy')">����</a><?php } if($_G['group']['allowmergethread'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('merge')">�ϲ�</a><?php } if($_G['group']['allowrefund'] && $_G['forum_thread']['price'] > 0) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('refund')">��������</a><?php } } if($_G['group']['allowsplitthread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('split')">�ָ�</a><?php } if($_G['group']['allowrepairthread'] && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('repair')">�޸�</a><?php } if($_G['forum_thread']['is_archived'] && $_G['adminid'] == 1) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('restore', '', 'archiveid=<?php echo $_G['forum_thread']['archiveid'];?>')">ȡ���浵</a><?php } if($_G['forum_firstpid']) { if($_G['group']['allowwarnpost']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('warn', '<?php echo $_G['forum_firstpid'];?>')">����</a><?php } if($_G['group']['allowbanpost']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('banpost', '<?php echo $_G['forum_firstpid'];?>')">����</a><?php } } if($_G['group']['allowremovereward'] && $_G['forum_thread']['special'] == 3 && !$_G['forum_thread']['is_archived']) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('removereward')">�Ƴ�����</a><?php } if($_G['forum']['status'] == 3 && in_array($_G['adminid'], array('1','2')) && $_G['forum_thread']['closed'] < 1) { ?><a href="javascript:;" onclick="modthreads(5, 'recommend_group', <?php echo $_G['forum_thread']['typeid'];?>);return false;">�Ƶ����</a><?php } } if($allowblockrecommend) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('recommend', '<?php echo $_G['forum_firstpid'];?>', 'op=recommend&idtype=<?php if($_G['forum_thread']['isgroup']) { ?>gtid<?php } else { ?>tid<?php } ?>&id=<?php echo $_G['tid'];?>', 'portal.php?mod=portalcp&ac=portalblock')">����</a><?php } if($allowpusharticle && $allowpostarticle) { ?><?php $modopt++ ?><a href="javascript:;" onclick="modaction('push', '<?php echo $_G['forum_firstpid'];?>', 'op=push&idtype=tid&id=<?php echo $_G['tid'];?>', 'portal.php?mod=portalcp&ac=index')">����</a><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_modoption'])) echo $_G['setting']['pluginhooks']['viewthread_modoption']; ?>
</div>
</div>
<?php } ?>

<div class="layout">
<div class="plctitle_new clboth">
<?php if($_G['forum_thread']['stamp'] == 0 && $_G['forum_thread']['rate'] > 0) { ?>
<span class="bcion16_16" title="����8264��"></span>
<?php } if($_G['forum_thread']['typeid'] && $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]) { if(!IS_ROBOT && ($_G['forum']['threadtypes']['listable'] || $_G['forum']['status'] == 3)) { if($dm) { ?>
<a href="http://<?php echo $dm;?>.8264.com/" class="fl_name"><?php echo $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']];?></a>
<?php } else { ?>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=typeid&amp;typeid=<?php echo $_G['forum_thread']['typeid'];?>" class="fl_name"><?php echo $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']];?></a>
<?php } } else { ?>
<a href="javascript:;" class="fl_name"><?php echo $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']];?></a>
<?php } } if($threadsorts && $_G['forum_thread']['sortid']) { ?>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=sortid&amp;sortid=<?php echo $_G['forum_thread']['sortid'];?>" class="fl_name"><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></a>
<?php } ?>

<h1 class="ts_name" id="thread_subject"><?php echo $_G['forum_thread']['subject'];?></h1>
<?php if(!IS_ROBOT) { ?>
<a href="<?php echo $_G['siteurl'];?>forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?><?php echo $fromuid;?>" title="���Ʊ�������" onclick="return copyThreadUrl(this)" class="ftcpy">[��������]</a>
<?php } ?>
<span class="ch_r tzrht">�鿴��<?php echo $_G['forum_thread']['views'];?> | �ظ���<?php echo $_G['forum_thread']['replies'];?>
</span>
</div>
</div>

<div class="layout" id="postlist"><?php $postcount = 0; if(is_array($postlist)) foreach($postlist as $post) { ?><div class="lxch_new clboth" id="post_<?php echo $post['pid'];?>">
<div id="pid<?php echo $post['pid'];?>"><?php $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']); ?><?php
$authorverifys = <<<EOF


EOF;
 if($_G['setting']['verify']['enabled']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && $post['verify'.$vid] == 1) { 
$authorverifys .= <<<EOF

<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid={$vid}" target="_blank">
EOF;
 if($verify['icon']) { 
$authorverifys .= <<<EOF
<img src="{$verify['icon']}" class="vm" alt="{$verify['title']}" title="{$verify['title']}" />
EOF;
 } else { 
$authorverifys .= <<<EOF
{$verify['title']}
EOF;
 } 
$authorverifys .= <<<EOF
</a>&nbsp;

EOF;
 } } } 
$authorverifys .= <<<EOF


EOF;
?>

<div class="lxch_l">
<?php echo $post['newpostanchor'];?> <?php echo $post['lastpostanchor'];?>
<?php if($post['authorid'] && $post['username'] && !$post['anonymous']) { if($_G['setting']['authoronleft']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="name_id_new" rel="nofollow"><?php echo $post['author'];?></a><?php echo $authorverifys;?>
<?php } } ?>

<div class="t_img_new" id="uboxbtn_<?php echo $post['pid'];?>" style="z-index:2;">
<?php if($_G['setting']['bannedmessages'] & 2 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || ($post['status'] & 1))) { ?>
<!--<span>ͷ������</span>--><?php echo avatar(0); } elseif($post['avatar'] && $showavatars) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank"  rel="nofollow"><?php echo avatar($post['authorid']); ?></a>
<div class="lctx_t" id="ubox_<?php echo $post['pid'];?>">
<div class="lctx_tcon">
<div class="lctx_tcon_n">
<div class="cltx_head clboth">
<div class="cltxbox"><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" rel="nofollow"><?php echo avatar($post['authorid'], small); ?></a></div>
<div class="clnameinfo">
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="name" rel="nofollow"><?php echo $post['author'];?></a>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;gid=<?php echo $post['groupid'];?>" target="_blank" rel="nofollow"><?php echo $post['authortitle'];?></a>
<?php if($post['medals']) { ?>
<span class="riicon"><?php if(is_array($post['medals'])) foreach($post['medals'] as $medal) { ?><img src="http://static.8264.com/static/image/common/<?php echo $medal['image'];?>" alt="<?php echo $medal['name'];?>" title="<?php echo $medal['name'];?>" />
<?php } ?>
</span>
<?php } ?>
</div>
</div>
<div class="ueser_forum_info">
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=thread&amp;type=thread&amp;view=me&amp;from=space" rel="nofollow">����<span><?php echo $post['threads'];?></span></a>
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=thread&amp;type=reply&amp;view=me&amp;from=space" rel="nofollow">����<span><?php echo $post['posts'];?></span></a>
<!--						<a href="forum.php?mod=viewthread&amp;tid=1641700">8264��<span><?php echo $post['extcredits5'];?></span></a>-->
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=friend" class="withoutb_r" rel="nofollow">��ע<span><?php echo $post['friends'];?></span></a>
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=friend&amp;view=fans" class="withoutb_r" rel="nofollow">��˿<span><?php echo $post['fans'];?></span></a>
</div>
<div class="send_friend clboth">
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $post['authorid'];?>&amp;touid=<?php echo $post['authorid'];?>&amp;pmid=0&amp;daterange=2&amp;pid=<?php echo $post['pid'];?>" onclick="hideMenu('userinfo<?php echo $post['pid'];?>');showWindow(<?php if(!$_G['uid']) { ?>'login','member.php?mod=logging&action=login'<?php } else { ?>'sendpm', this.href<?php } ?>)" title="������Ϣ" class="send">������</a>
<div class="update_ucache" id="updateuserinfo_<?php echo $post['pid'];?>"><a href="javascript:;" onclick="ajaxget('plugin.php?id=api:userinfoupdate&uid=<?php echo $post['authorid'];?>' ,'updateuserinfo_<?php echo $post['pid'];?>');">ˢ�»���</a></div>
<?php if($post['authorid'] != $_G['uid']) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>&amp;handlekey=addfriendhk_<?php echo $post['authorid'];?>" id="a_friend_li_<?php echo $post['pid'];?>" onclick="showWindow(<?php if(!$_G['uid']) { ?>'login','member.php?mod=logging&action=login'<?php } else { ?>this.id, this.href, 'get', 1, {'ctrlid':this.id,'pos':'00'}<?php } ?>);" class="friend">��ע</a>
<?php } ?>
</div>
</div>
</div>
</div>
<?php } ?>
</div>

<?php if($post['medals']) { ?>
<span class="hzicon_1"><?php if(is_array($post['medals'])) foreach($post['medals'] as $medal) { ?><img src="http://static.8264.com/static/image/common/<?php echo $medal['image'];?>" alt="<?php echo $medal['name'];?>" title="<?php echo $medal['name'];?>" /><?php } ?>
</span>
<?php } if($post['extcredits5']) { ?><a href="forum.php?mod=viewthread&amp;tid=1641700" class="info_new orangelink">8264�� <i class="orange"><?php echo $post['extcredits5'];?></i> <?php echo $_G['setting']['extcredits']['5']['unit'];?></a><?php } ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=thread&amp;type=reply&amp;view=me&amp;from=space" target="_blank" class="info_new alink" rel="nofollow">������<?php echo $post['threads']+$post['posts']; ?> ��</a>
<span class="info_new">���ߣ�<?php echo $post['oltime'];?> Сʱ</span>
<span class="info_new">ע�᣺<?php echo $post['regdate'];?></span>

<?php if($_G['group']['allowedituser'] || $_G['group']['allowbanuser'] || ($_G['forum']['ismoderator'] && $_G['group']['allowviewip'] && !$post['first'])) { ?>
<span class="info_new">
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowviewip']) { ?>
<a href="forum.php?mod=topicadmin&amp;action=getip&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="ajaxmenu(this, 0, 0, 2);doane(event)">IP</a>&nbsp;
<?php } if($_G['group']['allowedituser']) { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?frames=yes&action=members&operation=search&uid=<?php echo $post['authorid'];?>&submit=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?php echo $post['authorid'];?><?php } ?>" target="_blank">�༭</a>&nbsp;
<?php } if($_G['group']['allowbanuser']) { if($_G['adminid'] == 1) { ?>
<a href="admin.php?action=members&amp;operation=ban&amp;username=<?php echo $post['usernameenc'];?>&amp;frames=yes" target="_blank">��ֹ</a>&nbsp;
<?php } else { ?>
<a href="forum.php?mod=modcp&amp;action=member&amp;op=ban&amp;uid=<?php echo $post['authorid'];?>" target="_blank">��ֹ</a>&nbsp;
<?php } } ?>
<a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?php echo $post['usernameenc'];?>" target="_blank">����</a>
</span>
<?php } ?>
</div>

<div class="lxch_r">
<div class="lc_bs_new clboth">
<?php if($post['authorid'] && !$post['anonymous']) { if(!$_G['setting']['authoronleft']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="xi2" rel="nofollow"><?php echo $post['author'];?></a><?php echo $authorverifys;?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
����
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; } elseif(!$post['authorid'] && !$post['username']) { ?>
�ο�
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; } ?>
<span class="fby" id="authorposton<?php echo $post['pid'];?>">
<style type="text/css">
.lc_bs_new span.fby div{display:inline;}
.fby a{ color:#949494;}
</style>
<?php if($postcount==0) { ?>
������
<?php } else { ?>
������
<?php } ?>
<?php echo $post['dateline'];?>


</span>

<!--��ע��ϵ-->
<?php if($post['first'] == 1 && $_G['uid'] != $post['authorid']) { ?>
<style type="text/css">
.first-follow .btn-28 {
    border-radius: 2px;
    float: left;
    font-size: 12px;
    height: 28px;
    line-height: 28px;
    margin-left: 8px;
    padding: 0 12px;
    text-align: center;
    margin-top:3px;
}
.first-follow .p-btn-d {
    background-color: #fff;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}
.first-follow .p-btn-c {
    background-color: #ff7e00;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    color: #fff;
}
.first-follow .icon-f {
    background: rgba(0, 0, 0, 0) url("http://static.8264.com/static/images/icon/attent_15x59.png") no-repeat scroll 0 0;
    display: inline-block;
    height: 13px;
    margin: -2px 5px 0 0;
    vertical-align: middle;
    width: 13px;
}
.first-follow .icon-add-f {
    background-position: -1px -48px;
}
.first-follow .icon-focus-f {
    background-position: -1px -24px;
}
.first-follow .layer-list {
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.17);
    position: absolute;
    text-align: center;
    width: 100px;
    z-index: 101;
}
.first-follow .layer-list a {
    display: block;
    font-size: 14px;
    height: 28px;
    line-height: 28px;
}
.first-follow .layer-list a:hover {
    background-color:#f3f3f3;
    color:#ff7e00;
}
</style>
<div style="float:left;position:relative;z-index:1;" class="first-follow">
<?php if(empty($post['mutual'])) { if($_G['uid']) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>" class="p-btn-c btn-28 addfollow" id="ajax_follow_me_<?php echo $post['authorid'];?>">
<?php } else { ?>
<a href="member.php?mod=logging&amp;action=login" class="p-btn-c btn-28">
<?php } ?>
<i class="icon-f icon-add-f"></i>��ע
</a>

<?php } elseif($post['mutual'] == 1) { ?>
<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" onmouseover="showMenu_uc(this.id,'35','1');" id="followselect">
<i class="icon-f icon-focus-f"></i>�ѹ�ע
</a>
<?php } elseif($post['mutual'] == 2) { ?>
<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" onmouseover="showMenu_uc(this.id,'35','1');" id="followselect">
<i class="icon-f icon-addtwo-f"></i>�����ע
</a>
<?php } if($post['mutual']) { ?>
<div class="layer-list" id="followselect_menu" style="display:none;">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=<?php echo $post['authorid'];?>" id="friend_group_<?php echo $post['authorid'];?>" class="setgroup">
<span class="t">���÷���</span>
</a>
<a href="javascript:void(0);" rel="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?php echo $post['authorid'];?>&amp;confirm=1"  class="unfollow">
<span class="t">ȡ����ע</span>
</a>
</div>
<?php } ?>
</div>
<script type="text/javascript">
jQuery(function(){
//��ӹ�ע
jQuery(".first-follow").delegate(".addfollow","click",function(){
showWindow(jQuery(this).attr('id'), jQuery(this).attr('href'), 'get', 0);
});

//ȡ����ע
jQuery(".layer-list").delegate(".unfollow","click",function(){
var url = jQuery(this).attr('rel');
dconfirm('ȡ����ע', 'ȷ��ȡ����ע��?', function() {
jQuery.post(url, '', function(data) {
if(data == 'success') {
var html = '<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>" class="p-btn-c btn-28 addfollow" id="ajax_follow_me_<?php echo $post['authorid'];?>"><i class="icon-f icon-add-f"></i>��ע</a>';
jQuery('.first-follow').html('').html(html);
showDialog("<p>ȡ����ע�ɹ�</p>", 'notice', '','' , 0, '', '', '', '', 2);
}
});
});
});

//���÷���
jQuery(".layer-list").delegate(".setgroup","click",function(){
showWindow(jQuery(this).attr('id'), jQuery(this).attr('href'), 'get', 0);
});
});
function showMenu_uc(id,top,left) {
showMenu(id);
jQuery('#'+id+'_menu').css({'top':top+'px'});
if (left) {
jQuery('#'+id+'_menu').css({'left':left+'px'});
}
}
function callback_follow_successfully(mutual, uid) {
if (mutual == 1) {
var html = '<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" id="followselect"><i class="icon-f icon-focus-f"></i>�ѹ�ע</a>';
} else if (mutual == 2) {
var html = '<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" id="followselect"><i class="icon-f icon-addtwo-f"></i>�����ע</a>';
}
html += '<div class="layer-list" id="followselect_menu" style="display:none;">';
html += '<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=';
//			html += uid;
html += uid;
html += '" id="friend_group_'+uid+'" class="setgroup"><span class="t">���÷���</span></a>';
html += '<a href="javascript:void(0);" rel="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid='+uid+'&amp;confirm=1"  class="unfollow"><span class="t">ȡ����ע</span></a>';
html += '</div>';
jQuery('.first-follow').html('').html(html);
jQuery('.first-follow .button_hover').mouseover(function(){
showMenu_uc(jQuery(this).attr('id'),'35','1');
});
//ȡ����ע
jQuery(".layer-list").delegate(".unfollow","click",function(){
var url = jQuery(this).attr('rel');
dconfirm('ȡ����ע', 'ȷ��ȡ����ע��?', function() {
jQuery.post(url, '', function(data) {
if(data == 'success') {
var html = '<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>" class="p-btn-c btn-28 addfollow" id="ajax_follow_me_<?php echo $post['authorid'];?>"><i class="icon-f icon-add-f"></i>��ע</a>';
jQuery('.first-follow').html('').html(html);
showDialog("<p>ȡ����ע�ɹ�</p>", 'notice', '','' , 0, '', '', '', '', 2);
}
});
});
});
//���÷���
jQuery(".layer-list").delegate(".setgroup","click",function(){
showWindow(jQuery(this).attr('id'), jQuery(this).attr('href'), 'get', 0);
});
}
</script>
<?php } ?>
<!--��ע��ϵ end-->

<?php if(!IS_ROBOT) { ?>
<a href="<?php echo $_G['siteurl'];?><?php if($post['first']) { ?>forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?><?php echo $fromuid;?><?php } else { ?>forum.php?mod=redirect&goto=findpost&ptid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?><?php echo $fromuid;?><?php } ?>" class="lc_bs_no" title="���Ʊ�������" id="postnum<?php echo $post['pid'];?>" onclick="setCopy(this.href, '���ӵ�ַ�Ѿ����Ƶ�������');return false;">
<?php if(!empty($postno[$post['number']])) { ?><?php echo $postno[$post['number']];?><?php } else { ?><em><?php echo $post['number'];?></em><?php echo $postno['0'];?><?php } ?>
</a>
<?php } ?>

<span class="tzgn">
<?php if($post['authorid'] && !$post['anonymous']) { if($post['invisible'] == 0) { if(!IS_ROBOT && !$_G['gp_authorid'] && !$_G['forum_thread']['archiveid']) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>&amp;authorid=<?php echo $post['authorid'];?>" rel="nofollow">ֻ��������</a>
<?php } elseif(!$_G['forum_thread']['archiveid']) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>" rel="nofollow">��ʾȫ������</a>
<?php } } } if(!IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']) { if($ordertype != 1) { ?>
| <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;ordertype=1" rel="nofollow">�������</a>
<?php } else { ?>
| <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;ordertype=2" rel="nofollow">�������</a>
<?php } if($post['invisible'] == 0) { } if($_G['forum_thread']['readperm']) { ?>| <em class="xg2">�Ķ�Ȩ�� <?php echo $_G['forum_thread']['readperm'];?></em><?php } } if($_G['forum_scan_way_button'] == 1 && $post['first'] ) { ?>
| <a href="tupian-<?php echo $_G['tid'];?>.html#pic" target="_blank">ֻ��������ͼ</a>
<?php } ?>
</span>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_sidetop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_sidetop'][$postcount]; ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_sidebottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_sidebottom'][$postcount]; if($post['first']) { if($_G['forum_threadstamp']) { ?><div id="threadstamp"><img src="http://static.8264.com/static/image/stamp/<?php echo $_G['forum_threadstamp']['url'];?>" title="<?php echo $_G['forum_threadstamp']['text'];?>" /></div><?php } } if(!$post['first'] && $_G['forum_thread']['special'] == 5) { ?>
<label class="pdbts pdbts_<?php echo intval($post['stand']); ?>">
<?php if($post['stand'] == 1) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=1" title="ֻ������">����</a>
<?php } elseif($post['stand'] == 2) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=2" title="ֻ������">����</a>
<?php } else { ?><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=0" title="ֻ������">����</a><?php } if($post['stand']) { ?>
<a class="b" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" id="voterdebate_<?php echo $post['pid'];?>" onclick="ajaxmenu(this);doane(event);">֧�� <?php echo $post['voters'];?></a>
<?php } ?>
</label>
<?php } ?>

<div class="clboth">
<div class="ad_info">
<?php if($post['number']<6) { ?><?php echo adshow("thread/a_pt/2/$postcount"); } if($_G['forum_thread']['readmodel'] ==1&&$post['first']) { ?>
    <div style="text-align:center; padding:30px 0px 10px 0px;">
<a target="_blank" href="http://www.8264.com/youji/<?php echo $_G['tid'];?>.html?from=8264bbs">
<img  src="http://static.8264.com/static/image/common/ydbicon.png">
</a>
</div>
<?php } if($_G['forum_thread']['readmodel'] ==2&&$post['first']) { ?>
    <div style="text-align:center; padding:30px 0px 10px 0px;">
<a target="_blank" href="http://www.8264.com/wenzhang/<?php echo $_G['tid'];?>.html?from=8264bbs">
<img  src="http://static.8264.com/static/image/common/wzbicon.png">
</a>
</div>
<?php } if($post['first']) { if($post['tags'] || $relatedkeywords) { ?>
<div class="ptg">
<?php if($post['tags']) { ?><?php echo $post['tags'];?><?php } if($relatedkeywords) { ?><span><?php echo $relatedkeywords;?></span><?php } ?>
</div>
<?php } } ?>
</div>
</div><div class="bjcon_new">
<?php if($post['warned']) { ?>
<span class="y"><a href="forum.php?mod=misc&amp;action=viewwarning&amp;tid=<?php echo $_G['tid'];?>&amp;uid=<?php echo $post['authorid'];?>" title="�ܵ�����" onclick="showWindow('viewwarning', this.href)"><img src="http://static.8264.com/static/image/common/warning.gif" alt="�ܵ�����" /></a></span>
<?php } if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
<div class="locked">��ʾ: <em>���߱���ֹ��ɾ�� �����Զ�����</em></div>
<?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
<div class="locked">��ʾ: <em>����������Ա���������</em></div>
<?php } elseif($needhiddenreply) { ?>
<div class="locked">���������߿ɼ�</div>
<?php } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop'][$postcount]; if($_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
<div class="locked">��ʾ: <em>���߱���ֹ��ɾ�� �����Զ����Σ�ֻ�й���Ա�ɼ�</em></div>
<?php } elseif($post['status'] & 1) { ?>
<div class="locked">��ʾ: <em>����������Ա��������Σ�ֻ�й���Ա�ɼ�</em></div>
<?php } if($post['first']) { if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
<div class="locked">
<em class="y"><a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" onclick="showWindow('pay', this.href)">��¼</a></em>
��������, �۸�: <strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?> </strong>
</div>
<?php } if($threadsort && $threadsortshow) { if($threadsortshow['typetemplate']) { ?>
<?php echo $threadsortshow['typetemplate'];?>
<?php } elseif($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
<div class="typeoption">
<?php if($threadsortshow['optionlist'] == 'expire') { ?>
����Ϣ�Ѿ�����
<?php } else { ?>
<table summary="������Ϣ" cellpadding="0" cellspacing="0" class="cgtl mbm">
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
<div class="locked">����: <em><?php if($_G['uid']) { ?>�����ڵ��û����޷����ػ�鿴����<?php } else { ?>����Ҫ<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);return false;">��¼</a>�ſ������ػ�鿴������û���˺ţ�<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="ע���˺�"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em></div>
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
<h3 class="psth xs1">�����Ƽ�</h3><?php if(is_array($sticklist)) foreach($sticklist as $rpost) { ?><div class="pstl xs1">
<div class="psta" style='z-index:1;position:absolute'><a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" c="1" rel="nofollow"><?php echo $rpost['avatar'];?></a></div>
<div class="psti">
<p>
<a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" class="xi2 xw1" rel="nofollow"><?php echo $rpost['author'];?></a>
                        ������<?php echo $rpost['position'];?>¥
<span class="xi2">
&nbsp;<a href="javascript:;" onclick="window.open('forum.php?mod=redirect&goto=findpost&ptid=<?php echo $rpost['tid'];?>&pid=<?php echo $rpost['pid'];?>')" class="xi2">�鿴��������</a>
<?php if($_G['group']['allowstickreply']) { ?>&nbsp;<a href="javascript:;" onclick="modaction('stickreply', <?php echo $rpost['pid'];?>, '&undo=yes')" class="xi2">����ö�</a><?php } ?>
</span>
</p>
<div class="mtn"><?php echo $rpost['message'];?></div>
</div>
</div>
<?php } ?>
</div>
<?php } if($post['number']==1 && $_G['uid'] && 1!=1) { ?>
<!-- ����Ҫ��ȡ��1¥���ٻظ����������Ҫ�ٻָ���ȥ���������� && 1!=1 -->
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
<textarea name="message" class="t_note" id="fastreplymessage">¥��˵��̫�����ˣ���������һ�£�</textarea>
<div class="areatext" id="fastreply-message-hidden" contenteditable="true"></div>
<div id="fastreply-atlist"></div>
</div>
<div class="lcksfu clboth">
<span class="lcksfu_l" id="fastreply_btnbox">
<button class="lcksfubotton" value="true" name="replysubmit" id="fastreplysubmit" type="submit"></button>
<!-- �ֻ�����ʾ -->
<?php if(!$_G['member']['telstatus']) { ?>
<style type="text/css">.tips-binding__inside{float:left;background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:4px 0 0 10px;font-size:14px;color:#585858}.tips-binding__inside a{color:#ff7038;font-size:14px}.tips-binding__inside a:hover{color:#ff7038;font-size:14px}</style>
<span class="tips-binding__inside">ע��������������ֻ���<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">ȥ��>></a></span>
<?php } ?>
<!-- //�ֻ�����ʾ -->
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="<classname>"><sec><i id="sec<hash>_menu" class="yzmimg" style="display:none"><sec></i></span>
EOF;
?>
<div class="twyzm clboth fastreplysec"><?php include template('common/seccheck'); ?></div>
<?php } ?>
</span>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;repquote=<?php echo $post['pid'];?>" onclick="switchAdvanceMode(this.href);doane(event);" class="lcksfu_r">�߼�ģʽ</a>
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
<span class="pfnum"><?php echo count($postlist[$post['pid']]['totalrate']);; ?>��</span>
<span class="pfzi">����</span>
<span class="pficon6_11"></span>
<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)">�鿴ȫ������</a>
</div>
<?php } ?>
<div id="post_rate_<?php echo $post['pid'];?>"></div>
<?php if($_G['setting']['ratelogon']) { ?>
<table class="ratl">
<tr>
<th class="xw1" width="120"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="�鿴ȫ������">���� <span class="xi1"><?php echo count($postlist[$post['pid']]['totalrate']);; ?></span> ������</a></th><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { ?><th width="50"><i><?php echo $_G['setting']['extcredits'][$id]['title'];?></i></th>
<?php } ?>
<th>
<a href="javascript:;" onclick="toggleRatelogCollapse('ratelog_<?php echo $post['pid'];?>', this);" class="y xi2 op"><?php if(!empty($_G['cookie']['ratecollapse'])) { ?>չ��<?php } else { ?>����<?php } ?></a>
<i>����</i>
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
������:&nbsp;<?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($score > 0) { ?>
<span class="xi1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?></span>&nbsp;
<?php } else { ?>
<span class="xg1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?></span>&nbsp;
<?php } } ?>
&nbsp;<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="�鿴ȫ������" class="xi2">�鿴ȫ������</a>
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
<?php if($commentcount[$post['pid']]) { ?><span class="dpnum"><?php echo $commentcount[$post['pid']];?>��</span><?php } ?>
<span class="dpzi">����</span>
<span class="dpicon6_11"></span>
<a href="javascript:;" class="shouqi" id="clist_btn_<?php echo $post['pid'];?>">����</a>
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
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;postid=<?php echo $comment['pid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $comment['forpid'];?>&amp;cid=<?php echo $comment['id'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=commentreply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">�ظ�</a>
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $comment['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>�鿴ȫ��</a>
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
<span class="hf">�ظ�</span>
<a href="#" target="_blank" class="name_second"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $reply['comment'];?></span>
</span>
<span class="second" style="display:none;">
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $reply['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>�鿴ȫ��</a>
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
<div class="pg"><a href="javascript:;" onclick="ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>&page=2', 'comment_<?php echo $post['pid'];?>')">��һҳ</a></div>
</div>
<?php } } ?>
</div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount]; } ?>
</div>
<?php if(!IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']) { if(!empty($lastmod['modaction']) && $_G['groupid'] == 1) { ?>
<div class="gldivfst clboth" ><a href="forum.php?mod=misc&amp;action=viewthreadmod&amp;tid=<?php echo $_G['tid'];?>" title="����ģʽ" onclick="showWindow('viewthreadmod', this.href)">�������� <?php echo $lastmod['modusername'];?> �� <?php echo $lastmod['moddateline'];?> <?php echo $lastmod['modaction'];?></a></div>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_useraction'])) echo $_G['setting']['pluginhooks']['viewthread_useraction']; } } ?>

<div class="lcbottom clboth">
<?php if(!$_G['forum_thread']['archiveid']) { ?>
<div class="gldiv_l">
<?php if($post['invisible'] == 0) { if($allowpostreply) { ?>
<a class="hficon" href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=reply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">�ظ�</a>
<?php } } if($_G['group']['raterange'] && $post['authorid'] && !$post['first'] && $post['invisible'] == 0) { ?>
<a id="p_rate_btn" class="pficon" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?>', 'get', -1);return false;">����</a>
<?php } if($_G['group']['raterange'] && $post['authorid'] && $post['first']) { ?>
<a id="p_rate_btn" class="pficon" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?>', 'get', -1);return false;" title="<?php echo count($postlist[$post['pid']]['totalrate']);; ?> ������">����</a>
<?php } if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>
<a id="p_edit_btn" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_G['gp_modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>��ӹ�̨����<?php } else { ?>�༭<?php } ?></a>
<?php } ?>
</div>
<div class="gldiv_r">
<?php if($post['invisible'] == -2 && !$post['first']) { ?>
<span class="xg1">(�����)</span>
<?php } if($post['first'] && $post['invisible'] == -3) { ?>
<a href="forum.php?mod=misc&amp;action=pubsave&amp;tid=<?php echo $_G['tid'];?>">����</a>
<?php } if(!(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'])) && $_G['uid'] && $post['authorid'] == $_G['uid']) { ?>
<a href="forum.php?mod=misc&amp;action=postappend&amp;tid=<?php echo $post['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;page=<?php echo $page;?>" onClick="showPostWin('postappend', this.href)">����</a>
<?php } if(!$post['first'] && $modmenu['post']) { ?>
<span>
<label for="manage<?php echo $post['pid'];?>">
<input type="checkbox" id="manage<?php echo $post['pid'];?>" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $post['pid'];?>)" value="<?php echo $post['pid'];?>" autocomplete="off" />����
</label>
</span>
<?php } if($post['invisible'] == 0) { if($post['first'] && $_G['uid'] && $_G['uid'] == $post['authorid'] && !in_array($_G['fid'], array(7,378))) { ?>
<a href="misc.php?mod=invite&amp;action=thread&amp;id=<?php echo $_G['tid'];?>" onclick="showWindow('invite', this.href, 'get', 0);">����</a>
<?php } if($_G['forum_thread']['special'] == 3 && ($_G['forum']['ismoderator'] && (!$_G['setting']['rewardexpiration'] || $_G['setting']['rewardexpiration'] > 0 && ($_G['timestamp'] - $_G['forum_thread']['dateline']) / 86400 > $_G['setting']['rewardexpiration']) || $_G['forum_thread']['authorid'] == $_G['uid']) && $post['authorid'] != $_G['forum_thread']['authorid'] && $post['first'] == 0 && $_G['uid'] != $post['authorid'] && $_G['forum_thread']['price'] > 0) { ?>
<a href="javascript:;" onclick="setanswer(<?php echo $post['pid'];?>, '<?php echo $_G['gp_from'];?>')">��Ѵ�</a>
<?php } if($post['rate'] && $_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $page;?>" onclick="showWindow('rate', this.href, 'get', -1)">��������</a>
<?php } if($post['authorid'] != $_G['uid'] && $_G['uid']) { ?>
<a href="javascript:;" onclick="showWindow('miscreport<?php echo $post['pid'];?>', 'misc.php?mod=report&rtype=post&rid=<?php echo $post['pid'];?>', 'get', -1);return false;" id="report_btn" style="display: none;">�ٱ�</a>
<?php } } if($post['first']) { ?>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" id="m_k_favorite" onclick="showWindow(<?php if($_G['uid']) { ?>this.id, this.href, 'get', 0<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>);" title="<?php echo $_G['forum_thread']['favtimes'];?>���ղ�" style="display: none;">�ղ�(<b id="favoritenumber"><?php echo $_G['forum_thread']['favtimes'];?></b>)</a>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postfooter'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postfooter'][$postcount]; ?>
</div>
<div style="clear:both;"></div>
<?php } ?>
</div>

<?php if($post['first'] && $_G['forum_thread']['special'] == 5 && $_G['forum_thread']['displayorder'] >= 0) { ?>
<ul class="ttp cl">
<li style="display:inline;margin-left:12px"><strong class="bw0">������ɸѡ: </strong></li>
<li<?php if(!isset($_G['gp_stand'])) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>" hidefocus="true">ȫ��</a></li>
<li<?php if($_G['gp_stand'] == 1) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;stand=1" hidefocus="true">����</a></li>
<li<?php if($_G['gp_stand'] == 2) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;stand=2" hidefocus="true">����</a></li>
<li<?php if(isset($_G['gp_stand']) && $_G['gp_stand'] == 0) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;stand=0" hidefocus="true">����</a></li>
</ul>
<?php } ?>
</div>

<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_endline'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_endline'][$postcount]; ?>

</div>
</div>
<?php if($post['number']==1) { ?>
<div class="border_b8"></div>
<?php } elseif($post['number']==2) { ?>
<div class="border_b8"></div>
    <?php } elseif($post['number']==3) { ?><?php echo adshow("custom_374"); } else { ?>
<div class="border_b8"></div>
<?php } ?><?php $postcount++; } ?>
<div id="postlistreply" class="pl"><div id="post_new" class="viewthread_table" style="display: none; border: none;"></div></div>
</div>

<form method="post" autocomplete="off" name="modactions" id="modactions">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="optgroup" />
<input type="hidden" name="operation" />
<input type="hidden" name="listextra" value="<?php echo $_G['gp_extra'];?>" />
</form>
<?php echo $_G['forum_tagscript'];?>

<div class="layout fenyebbscon"><?php echo $multipage;?></div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbutton_top'])) echo $_G['setting']['pluginhooks']['viewthread_postbutton_top']; ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_middle'])) echo $_G['setting']['pluginhooks']['viewthread_middle']; ?>
<!--[diy=diyfastposttop]--><div id="diyfastposttop" class="area"></div><!--[/diy]-->

<?php if($_G['setting']['fastpost'] && $allowpostreply && !$_G['forum_thread']['archiveid'] && ($_G['forum']['status'] != 3 || $_G['isgroupuser'])) { ?><script type="text/javascript">
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
<option value="">ѡ��۵�</option>
<option value="0">����</option>
<option value="1">����</option>
<option value="2">����</option>
</select>
</div>
<script type="text/javascript">simulateSelect('stand');</script>
</div>
<?php } ?>

<div class="pinglunmid"  style="width:705px;">
<div class="edierbar clboth">
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_func_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_func_extra']; ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra'])) echo $_G['setting']['pluginhooks']['viewthread_fastpost_ctrl_extra']; ?><?php $seditor = array('fastpost', array('bold', 'color'), $guestreply ? 1 : 0); if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="���ּӴ�" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="���ɫ"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="��ɫ"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="��ɫ"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="ͼƬ" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?>>Image</a>
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
<?php } ?><a class="gjms" href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="return switchAdvanceMode(this.href)">�ϴ�ͼƬ�����߼�ģʽ</a>
</div>
<div class="areatext">
<?php if(!$guestreply) { ?>
<textarea rows="5" cols="80" name="message" id="fastpostmessage" onKeyDown="seditor_ctlent(event, <?php if($_G['gp_ordertype'] != 1) { ?>'fastpostvalidate($(\'fastpostform\'))'<?php } else { ?>'$(\'fastpostform\').submit()'<?php } ?>);" tabindex="4" class="pt"  style="width:675px;"></textarea>
<div class="areatext" id="message-hidden" contenteditable="true"></div>
<div id="atlist"></div>
<?php } else { ?>
<div class="pt hm" style="border: none;">
����Ҫ��¼��ſ��Ի���
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">��¼</a>
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
<!-- �ֻ�����ʾ -->
<?php if(!$_G['member']['telstatus']) { ?><span class="tips-binding">ע��������������ֻ���<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">ȥ��>></a></span><?php } ?>
<!-- //�ֻ�����ʾ -->
</div>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="subject" value="" />
<?php if($_G['gp_ordertype'] != 1 && empty($_G['gp_from'])) { ?>
<script type="text/javascript">if(getcookie('fastpostrefresh') == 1) {$('fastpostrefresh').checked=true;}</script>
<?php } ?>

</div>

<div style="float:right;width:160px;height:150px;border:1px solid #e3e3e3;padding:9px;">
<!-- ��̳����_���ӻظ��Ҳ�_���ߵ� 402--><?php echo adshow("custom_478"); ?></div>



</div>

</form>
<?php if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) { ?>
<!-- @���� -->
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

// �������ı���������ʱ����AT��ʾ�б�
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
<?php } } ?>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_bottom'])) echo $_G['setting']['pluginhooks']['viewthread_bottom']; if($_G['setting']['visitedforums'] || $oldthreads) { ?>
<div id="visitedforums_menu" class="<?php if($oldthreads) { ?>visited_w <?php } ?>p_pop blk cl" style="display: none;">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if($_G['setting']['visitedforums']) { ?>
<td id="v_forums">
<h3 class="mbn pbn bbda xg1">������İ��</h3>
<ul>
<?php echo $_G['setting']['visitedforums'];?>
</ul>
</td>
<?php } if($oldthreads) { ?>
<td id="v_threads">
<h3 class="mbn pbn bbda xg1">�����������</h3>
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
<div style="font-size:14px; margin:10px 0;">��QQ�˺ţ����ɷ���QQ�ռ�����Ѷ΢��</div>
<div><a href="connect.php?mod=config&amp;connect_autoshare=1" target="_blank"><img src="http://static.8264.com/static/image/common/qq_bind.gif" align="absmiddle" style="margin-top:5px;" /></a></div>
</div>
<input type="hidden" id="connect_thread_title" name="connect_thread_title" value="<?php echo $_G['forum_thread']['subject'];?>" />
</div>
<?php } if(!IS_ROBOT && $_G['setting']['threadmaxpages'] > 1) { ?>
<script type="text/javascript">document.onkeyup = function(e){keyPageScroll(e, <?php if($page > 1) { ?>1<?php } else { ?>0<?php } ?>, <?php if($page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']) { ?>1<?php } else { ?>0<?php } ?>, 'forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?><?php if($_G['gp_authorid']) { ?>&authorid=<?php echo $_G['gp_authorid'];?><?php } ?>', <?php echo $page;?>);}</script>
<?php } ?>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>
<div class="share_bd_warpten" style="bottom:10px;">
<ul class="bbs_share_sc">
<li><a href="http://bbs.8264.com/thread-791154-1-1.html" target="_blank" class="kfhelf"></a></li>
<li class="ps_re" id="share">
<a href="javascript:;" class="share"></a>
<div class="bdsharebuttonbox share_bd" data-tag="share_1">
<a href="javascript:;" class="sina" data-cmd="tsina"></a>
<a href="javascript:;" class="qq" data-cmd="qzone"></a>
<a href="javascript:;" class="wb" data-cmd="tqq"></a>
<a href="javascript:;" class="wx" data-cmd="weixin"></a>
</div>
</li>
<li><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" id="m_k_favorite" onclick="showWindow(<?php if($_G['uid']) { ?>this.id, this.href, 'get', 0<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>);" class="sc"></a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>" class="bbsli" title="���������б�"></a></li>
<li id="gotop_50"><a style="display: none;" href="javascript:;" class="gotop_50"></a></li>
</ul>
</div>
<script src="http://static.8264.com/static/js/layer/layer.js" type="text/javascript" type="text/javascript"></script>
<script>
function quick_reply_form() {
layer.open({
  type: 2,
  title: '��������װ��',
  shadeClose: false,
  shade: 0.8,
  area: ['710px', '600px'],
  content: 'plugin.php?id=forumoption:quick_reply&tpl=equipment&mod=equipment&des_type=<?php echo $_G['fid'];?>'
});
}
window._bd_share_config = {
common : {
//�˴�����ͨ������
},
share : [
//�˴����÷���ť����
{"tag" : "share_1", "bdSize" : 32}
]
}
with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
(function($){
var ww=$(window).width();
var s_bd_r=Math.max((ww-980)/2-60,0);
$(".share_bd_warpten").css("right",s_bd_r);
})(jQuery);
</script>
<?php if($_G['fid']==64) { ?>
<script type="text/javascript">
window.TOUSU = { selector: 't_f'};
</script>
<script src="http://jubao.8264.com/public/js/tousu.js" type="text/javascript"></script>
<?php } ?>
<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=button&amp;mini=1&amp;uid=39357" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<!-- Baidu Button END -->

</div><!-- End wp --><style type="text/css">
    .side-float{
        position: fixed;
        width: 161px;
        height: 149px;
        bottom: 260px;
        margin-left: 500px;
        background: url(http://static.8264.com/static/images/tps/v1/scan-161-149.png) no-repeat;
        display: none;
    }
    .side-a{
        display: block;
        width: 100%;
        height: 100%;
    }
    .side-float .side-close{
        position: absolute;
        width: 10px;
        height: 10px;
        right: 1px;
        top: 8px;
        cursor: pointer;
        z-index: 999999;
    }
</style>

<div class="side-float">
    <a class="side-a" href="http://u.8264.com/home-task-do-view-id-1264.html" target="_blank" id="qr_src"></a>
    <span class="side-close"></span>
</div>
<script>
    /*jQuery.get("home.php?mod=task", {is_qr_display:1},function(data) {
        if(data.taskid > 0){
            jQuery('#qr_src').attr('href','home.php?mod=task&do=view&id='+data.taskid);
        }
    },'json');*/

//��ע�͵�
//    if(!getcookie("qr-dialog")) {
//        jQuery(".side-float").show();
//    }
//    jQuery(".side-close").click(function (){
//        jQuery(".side-float").hide();
//        setcookie("qr-dialog", 1, 86400);
//    });
//    jQuery(function(){
//        var width_q = jQuery(window).width();
//        var r_z = (width_q-980)/2 -170;
//        if(r_z<0){
//            jQuery(".side-float").css("right",'0px');
//        }else{
//            jQuery(".side-float").css("right",r_z);
//        };
//    });
</script><?php echo adshow("custom_443"); if($_G['fid'] == 186 ) { ?><?php echo adshow("custom_447"); } ?><div class="clearfix"></div>
<div class="footer">
<div class="layout" style="padding: 26px 0px 26px 0px; position:relative;">
<div class="topHill">����Сɽ</div>
<!-- ��ѡ -->
<div class="choiceness"><?php block_display('6905'); ?></div>
</div>

<?php if(empty($gid) && empty($_G['fid']) && ($_G['cache']['forumlinks']['forum']['index']['0'] || $_G['cache']['forumlinks']['forum']['index']['1'] || $_G['cache']['forumlinks']['forum']['index']['2'])) { ?>
<div class="friendLink">
<div class="layout">
<ul>
<?php if($_G['cache']['forumlinks']['forum']['index']['0']) { ?>
<?php echo $_G['cache']['forumlinks']['forum']['index']['0'];?>
<?php } if($_G['cache']['forumlinks']['forum']['index']['1']) { ?>
<?php echo $_G['cache']['forumlinks']['forum']['index']['1'];?>
<?php } if($_G['cache']['forumlinks']['forum']['index']['2']) { ?>
<?php echo $_G['cache']['forumlinks']['forum']['index']['2'];?>
<?php } ?>
</ul>
</div>
</div>
<?php } if($_G['fid'] && ($_G['cache']['forumlinks']['forum'][$_G['fid']]['0'] || $_G['cache']['forumlinks']['forum'][$_G['fid']]['1'] || $_G['cache']['forumlinks']['forum'][$_G['fid']]['2'])) { ?>
<div class="friendLink">
<div class="layout">
<ul>
<?php if($_G['cache']['forumlinks']['forum'][$_G['fid']]['0']) { ?>
<?php echo $_G['cache']['forumlinks']['forum'][$_G['fid']]['0'];?>
<?php } if($_G['cache']['forumlinks']['forum'][$_G['fid']]['1']) { ?>
<?php echo $_G['cache']['forumlinks']['forum'][$_G['fid']]['1'];?>
<?php } if($_G['cache']['forumlinks']['forum'][$_G['fid']]['2']) { ?>
<?php echo $_G['cache']['forumlinks']['forum'][$_G['fid']]['2'];?>
<?php } ?>
</ul>
</div>
</div>
<?php } ?></div>
<!-- �������� -->
<style>
.friendLink{ background: #0f1f2b; padding: 15px 0 18px 0px;}
.friendLink a { color: #807f7f; display: inline; margin-right: 10px; white-space: nowrap; font-size:12px;}
.friendLink a:hover { color: #fff; text-decoration:none;}
</style>
<div class="friendLink">
<div class="layout w980">
<?php if(!empty($_G['setting']['pluginhooks']['global_friendlylink'])) echo $_G['setting']['pluginhooks']['global_friendlylink']; ?>
</div>
</div>
<div class="bottomNav">
<div class="layout" style="position:relative;">
<div class="copyright">
<p><a href="http://www.miitbeian.gov.cn/" target="_blank">��ICP��05004140��-10</a> ICP֤ ��B2-20110106&nbsp;&nbsp;&nbsp;�����һ�Ƽ����޹�˾��Ȩ����</p>
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


        <?php if($_GET['mod'] =='index') { ?>
        <style>
.qdcionbottom{ position:absolute; left:509px; top:0px;}
.qdcionbottom img{ width:49px; height:44px;}
        </style>
        <a href='http://na3.tjaic.gov.cn/netmonitor/query/ScrNetEntQuery/Display.do?show=1&id=6eb59bd37f0000011ec3c0e5a59f7891-1-v-e-r-&ztLOID=8b4b03e47f0000012b8f0a26c9a87e67' class="qdcionbottom" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/guohui.png" /></a>
        <?php } ?>



</div>
</div>
<?php if($nobottomad !== false) { ?>
<!-- ҳ��ײ��������ű� -->
<script src="http://static.8264.com/static/js/jquery.cookie.js" type="text/javascript" type="text/javascript"></script>
<style>
  .newswarpten{ position:absolute; position:fixed!important; bottom:0px; display:none; left:50%;z-index: 999}
  .newstopone{ height:46px;  font-size:14px; background: url(http://static.8264.com/static/image/common/kxbg.png) 0px -1px no-repeat #fffff6; border:#e0d3be solid 1px;  float:left; border-right:0 none;}
  .newstopone .linktitle_4587{ float:left; margin:12px 0px 0px 70px; display:inline;}
  .newstopone .linktitle_4587 a{ font-size:16px; color:#064361; text-decoration:none;}
  .newstopone .linktitle_4587 a:hover{ font-size:16px; color:#ff7e00; text-decoration:none;}
  .newstopone .close16_16{ width:16px; height:16px; float:right; cursor:pointer; background:url(http://static.8264.com/static/image/common/kxbgarrowclose.png) -47px -1px no-repeat; margin:16px 0px 0px 10px; display:inline;}
  .newstopone .close16_16:hover{background:url(http://static.8264.com/static/image/common/kxbgarrowclose.png) -1px -1px no-repeat;}
  .newsarrow{ width:18px; height:48px; background:url(http://static.8264.com/static/image/common/kxbgarrow.png) left top no-repeat; float:right;}
</style>
<body>
<div class="newswarpten">
  <div class="newstopone">
    <div style="display: inline-block;padding-left: 70px;height: 46px;line-height: 46px;"><?php echo adshow("custom_294"); ?></div>
    <span class="close16_16"></span>
  </div>
  <div class="newsarrow"></div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
  var tiao = jQuery(".newswarpten").width();
  jQuery(".newswarpten").css( 'margin-left' , -tiao/2 );
  var t_time = Date.parse(new Date());
  var cookietime = jQuery.cookie('showboxtime');
  if(!cookietime){
    jQuery(".newswarpten").show();
  };
  if(t_time >= cookietime){
     jQuery(".newswarpten").show();
  };
  jQuery('.close16_16,.linktitle_4587 a').click(function(){
    var t_time = Date.parse(new Date());
    jQuery.cookie('showboxtime',t_time+3600*24*1000,{expires:30,domain:'8264.com',path:'/'});
    jQuery(".newswarpten").hide();
  });
});
</script>
<!-- //ҳ��ײ��������ű� -->
<?php } if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
    <div class="crly">
        ���� <?php echo $_G['member']['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ����
    </div>
    <div class="mncr"></div>
    </div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; if(!$_G['setting']['bbclosed']) { ?> <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
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
<?php if(($_G['mod'] == 'viewthread' || $_GET['act'] == 'showview' || $_GET['act'] == 'commentdetail' || $_G['mod'] == 'view' || $_GET['ctl'] == 'topic')) { ?>
<script type="text/javascript">
var _gaq = _gaq || [];
<?php if($_G['mod'] == 'view') { ?>
_gaq.push(['tid', '<?php echo $_GET['aid'];?>']);
_gaq.push(['type', '3']);
<?php } elseif($_GET['ctl'] == 'topic') { ?><?php $_G['tid'] = $topic['topicid'] ? $topic['topicid'] : 1; ?>_gaq.push(['tid', '<?php echo $_G['tid'];?>']);
_gaq.push(['type', '6']);
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