<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('view_bangdan_2016', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/portal/view_bangdan_2016.htm', './template/8264/common/header_8264_new.htm', 1509519467, 'diy', './data/template/2_diy_portal_view_bangdan_2016.tpl.php', './template/8264', 'portal/view_bangdan_2016')
|| checktplrefresh('./template/8264/portal/view_bangdan_2016.htm', './template/8264/common/camel_ad.htm', 1509519467, 'diy', './data/template/2_diy_portal_view_bangdan_2016.tpl.php', './template/8264', 'portal/view_bangdan_2016')
|| checktplrefresh('./template/8264/portal/view_bangdan_2016.htm', './template/8264/common/footer_8264_new.htm', 1509519467, 'diy', './data/template/2_diy_portal_view_bangdan_2016.tpl.php', './template/8264', 'portal/view_bangdan_2016')
|| checktplrefresh('./template/8264/portal/view_bangdan_2016.htm', './template/8264/common/header_common.htm', 1509519467, 'diy', './data/template/2_diy_portal_view_bangdan_2016.tpl.php', './template/8264', 'portal/view_bangdan_2016')
|| checktplrefresh('./template/8264/portal/view_bangdan_2016.htm', './template/8264/common/index_ad_top.htm', 1509519467, 'diy', './data/template/2_diy_portal_view_bangdan_2016.tpl.php', './template/8264', 'portal/view_bangdan_2016')
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
<?php if($_GET['aid'] == 98960) { ?>
<style>
html {
filter:progid:DXImageTransForm.Microsoft.BasicImage(grayscale=1);
overflow-y:scroll;
-webkit-filter: grayscale(100%);
-moz-filter: grayscale(100%);
-ms-filter: grayscale(100%);
-o-filter: grayscale(100%);
filter: grayscale(100%);
filter: gray; 
}
.ad_border{ display:none;}
body {filter:gray}
</style>
<?php } ?>

<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/view.css?<?php echo VERHASH;?>" />
<style id="diy_style" type="text/css"></style>
<script src="http://static.8264.com/static/js/forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
zoomstatus = parseInt(<?php echo $_G['setting']['zoomstatus'];?>), imagemaxwidth = '<?php echo IMAGEMAXWIDTH;?>', aimgcount = new Array();
jQuery(document).ready(function($){
$("#sidebar>a").hover(function(){
$(this).addClass("zhong").siblings().removeClass("zhong");
$("#sidebox>div").eq($(this).index()).show().siblings().hide();
});
var c_all=<?php echo $article['commentnum'];?>;
var c_count=$("#commentlist>li").length;
$("#more_cbtn").click(function(){
var c_show=$("#commentlist>li:visible").length;
if(c_count-c_show>0){
for(i=-1;i<33;i++){
$("#commentlist>li").eq(c_show+i).show();
}
if($("#commentlist>li:visible").length == c_count){
if(c_count == c_all){
$("#more_cbtn").text("û�и���������").unbind("click");
}
}
} else {
$("#more_clink").click();
}
});
$("#message").focus(function(){
if($(this).hasClass('t_note')){
$(this).removeClass('t_note');
$(this).val("");
}
}).blur(function(){
if($.trim($(this).val())==""){
$(this).addClass('t_note');
$(this).val("˵��ʲô��...");
}
});
});
</script>

<div class="w980 pt10">
<div class="clear_b pt10">
<div class="l_660">
<div class="fl_dh" style=" position:relative;">
<a href="http://www.8264.com/" class="syq">��ҳ</a><?php if(is_array($cat['ups'])) foreach($cat['ups'] as $value) { ?><a href="http://www.8264.com/list/<?php echo $value['catid'];?>/" class="syq"><?php echo $value['catname'];?> </a>
<?php } ?>
<a href="http://www.8264.com/list/<?php echo $cat['catid'];?>/" class="dpdq"><?php echo $cat['catname'];?></a>
<a href="<?php echo $_G['config']['web']['portal'];?>viewnews-<?php echo $article['aid'];?>-page-1.html" class="zpdq"><?php echo $article['title'];?></a>
                <style>
.kongad{ width:50px; height:25px; display:block; position:absolute; top:0px; right:0px; z-index:10;}
.fl_dh div{ display:none;}
                </style>
                <div style="line-height:0px; height:0px; font-size:0px; clear:both;"></div>
</div>
<h1 class="titlebig">
<?php echo $article['title'];?>
<?php if($article['status'] == 1) { ?>
(�����)
<?php } elseif($article['status'] == 2) { ?>
(�Ѻ���)
<?php } ?>
</h1>
<div class="newsinfo">
<?php if($article['from']) { ?>
��Դ��
<?php if($article['fromurl']) { ?>
<a href="<?php echo $article['fromurl'];?>" target="_blank"><?php echo $article['from'];?></a>
<?php } else { ?>
<span><?php echo $article['from'];?></span>
<?php } } ?>
���ߣ�
<?php if($article['author']) { ?>
<span><?php echo $article['author'];?></span>
<?php } else { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $article['uid'];?>"><?php echo $article['username'];?></a>
<?php } ?>
���ʱ�䣺<span><?php echo $article['dateline'];?></span>

<?php if($_G['group']['allowmanagearticle'] || ($_G['group']['allowpostarticle'] && $article['uid'] == $_G['uid'] && (empty($_G['group']['allowpostarticlemod']) || $_G['group']['allowpostarticlemod'] && $article['status'] == 1)) || $categoryperm[$value['catid']]['allowmanage']) { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;op=edit&amp;aid=<?php echo $article['aid'];?>&amp;page=<?php echo $_GET['page'];?>">�༭</a>
<?php if($article['status']> 0 && ($_G['group']['allowmanagearticle'] || $categoryperm[$value['catid']]['allowmanage'])) { ?>
<span>|</span><a href="portal.php?mod=portalcp&amp;ac=article&amp;op=verify&amp;aid=<?php echo $article['aid'];?>" id="article_verify_<?php echo $article['aid'];?>" onClick="showWindow(this.id, this.href, 'get', 0);">���</a>
<?php } else { ?>
<span>|</span><a href="portal.php?mod=portalcp&amp;ac=article&amp;op=delete&amp;aid=<?php echo $article['aid'];?>" id="article_delete_<?php echo $article['aid'];?>" onClick="showWindow(this.id, this.href, 'get', 0);">ɾ��</a>
<?php } } ?>
</div>
<div class="ad_border">
            	<!--�������-->
            <?php echo adshow("custom_360"); ?></div>
<div class="newscon">
<?php if(file_exists(DISCUZ_ROOT.'./source/plugin/articlekeywords/include.php')&&$article['catid']!='910') { ?><?php require_once DISCUZ_ROOT.'./source/plugin/articlekeywords/include.php'; ?><?php $articleKeywords = new ArticleKeywords(); ?><?php echo $articleKeywords->parseArticle($content[content]); } else { ?>
<?php echo $content['content'];?>
<?php } ?>
<div class="artPage clear_b"><?php if($multi) { ?><?php echo $multi;?><?php } ?></div>
</div>
<?php if($article['related']) { ?>
<div class="title_l_r clear_b"><span class="l">����Ȥ������</span></div>
<div class="interest clear_b">
<ul><?php if(is_array($article['related'])) foreach($article['related'] as $value) { ?><li><a title="<?php echo $value['title'];?>" target="_blank" href="viewnews-<?php echo $value['aid'];?>-page-1.html?from=view"><?php echo $value['title'];?></a></li>
<?php } ?>
</ul>
</div>
<?php } ?>
            <div style="margin:10px 0;">
           <?php echo adshow("custom_344"); ?>            </div>
<div style="margin:10px 0; border:#E5E5E5 solid 1px;">
<!-- ���λ��������ϸ_��� 404--><?php echo adshow("custom_404"); ?></div>
<div class="read_box">
<script type="text/javascript">
var uid = <?php echo $_G['uid'];?> ? <?php echo $_G['uid'];?> : 0;
var aid =<?php echo $_GET['aid'];?>;
var title ="<?php echo $article['title'];?>";
var url = "http://www.8264.com/viewnews-<?php echo $_GET['aid'];?>-page-1.html";
var pic = "<?php echo $article['pic'];?>";
if(pic=='http://bbs.8264.com/data/attachment/portal/'||pic=='http://image.8264.com/portal/'||pic.match(/^http:\/\/image1\.8264\.com\/(portal|forum)\/(!t\d+(w\d+h\d+)?(x\d+m\d+)?)?$/i) != null||pic==''){
pic = 'http://static.8264.com/static/image/common/nopic.gif';
}
var cat =new Array();
cat[0] = "<?php echo $cat['catname'];?>";
cat[1] = "<?php echo getportalcategoryurl($cat['catid']); ?>";
var cat1 = new Array();<?php if(is_array($cat['ups'])) foreach($cat['ups'] as $value) { ?>cat1[0] = "<?php echo $value['catname'];?>";
cat1[1] = "<?php echo getportalcategoryurl($value['catid']); ?>";
<?php } ?>
var   arr   =   new   Array();
arr[0] = cat;
arr[1] = cat1;
var catname = new Array();
catname[0]= cat1[0];
catname[1]= "<?php echo $cat['catname'];?>";
window["_BFD"] = window["_BFD"] || {};
_BFD.BFD_INFO = {
user_id : uid,	// ��ǰ�û���user_id��string���͡�ע�⣺user_id�����û�����ʵע������������ע�����ı��,δ��¼�û�ͳһʹ��0���߿�ֵ'';
iid : aid,  	//���µ�id��
title : title,  			//��ǰ���µ����ƣ�string���ͣ�
url : url,		// ��ǰ���µ���������url��string����
imgSrc : pic,//���µ�����ͼ
category : catname, 	// ��ǰ���µ�����������ƣ�һά����
categoryDetail : arr//��ǰ���µ�����������ƺ����ӣ���ά����
};
_BFD.script = document.createElement("script");
_BFD.script.type = 'text/javascript';
_BFD.script.async = true;
_BFD.script.charset = 'utf-8';
_BFD.script.src = (('https:' == document.location.protocol?'https://ssl-static1':'http://static1')+'.baifendian.com/service/huwaiziliao/hwzl_article.js');
document.getElementsByTagName("head")[0].appendChild(_BFD.script);
</script>
</div>
<?php if($article['allowcomment']==1) { ?>
<div class="hf_w">
<form id="cform" name="cform" action="<?php echo $form_url;?>" method="post" autocomplete="off" onsubmit="if(jQuery('#message').hasClass('t_note')||jQuery.trim(jQuery('#message').val())==''){return false;}">
<input type="hidden" name="portal_referer" value="portal.php?mod=view&amp;aid=<?php echo $aid;?>#comment">
<input type="hidden" name="aid" value="<?php echo $aid;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
<input type="hidden" name="replysubmit" value="true">
<input type="hidden" name="referer" value="portal.php?mod=view&amp;aid=<?php echo $aid;?>#comment" />
<input type="hidden" name="id" value="<?php echo $article['id'];?>" />
<input type="hidden" name="idtype" value="<?php echo $article['idtype'];?>" />
<input type="hidden" name="commentsubmit" value="true" />

<div class="hf">
<textarea name="message" rows="3" class="hf_textarea t_note" id="message" onkeydown="ctrlEnter(event, 'commentsubmit_btn');">˵��ʲô��...</textarea>
</div>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF

<sec><span id="sec<hash>" onclick="showMenu(this.id);"><sec></span>
<div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>

EOF;
?>
<div class="mtm mtm1 twyzm clear_b"><?php include template('common/seccheck'); ?></div>
<?php } ?>
<button type="submit" name="commentsubmit_btn" id="commentsubmit_btn" value="true" class="hfbutton">����</button>
</form>
</div>
<?php } ?>
<div class="pt25" id="comment">
<div class="title_l_r clear_b">
<span class="l">��������</span>
</div>
<?php if($commentlist) { ?>
<div class="pinluncon">
<ul id="commentlist"><?php $n=1; if(is_array($commentlist)) foreach($commentlist as $comment) { ?><li<?php if($n>33) { ?> style="display:none;"<?php } ?>>
<a name="comment_anchor_<?php echo $comment['cid'];?>"></a>
<?php if(!empty($comment['uid'])) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['uid'];?>" class="touxiang48"><?php echo $comment['avatar'];?></a>
<?php } ?>
<div class="pinglun_r">
<div class="pl_info_cz">
<span class="l">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['uid'];?>"><?php echo $comment['username'];?></a>
<span class="jgd">&#8226;</span>
<span><?php echo dgmdate($comment[dateline]); ?></span>
</span>
<?php if($comment['allowop']) { ?>
<span class="r">
<a href="javascript:;" onclick="portal_comment_requote(<?php echo $comment['cid'];?>);">����</a>
<?php if(($_G['group']['allowmanagearticle'] || $_G['uid'] == $comment['uid']) && $_G['groupid'] != 7) { ?>
<a href="portal.php?mod=portalcp&amp;ac=comment&amp;op=edit&amp;cid=<?php echo $comment['cid'];?>" id="c_<?php echo $comment['cid'];?>_edit" onclick="showWindow(this.id, this.href, 'get', 0);">�༭</a>
<a href="portal.php?mod=portalcp&amp;ac=comment&amp;op=delete&amp;cid=<?php echo $comment['cid'];?>" id="c_<?php echo $comment['cid'];?>_delete" onclick="showWindow(this.id, this.href, 'get', 0);">ɾ��</a>
<?php } ?>
</span>
<?php } ?>
</div>
<div class="pl_con">
<span><?php if($_G['adminid']==1 || $comment['uid']==$_G['uid'] || $comment['status']==0) { ?><?php echo $comment['message'];?><?php } else { ?>���δͨ��<?php } ?></span>
</div>
</div>
</li>
<?php if(!empty($aimgs[$comment['cid']])) { ?>
<script type="text/javascript" reload="1">
aimgcount[<?php echo $comment['cid'];?>] = [<?php echo implode(',', $aimgs[$comment['cid']]);; ?>];attachimgshow(<?php echo $comment['cid'];?>);
</script>
<?php } ?><?php $n++; } ?>
</ul>
</div>
<?php if($article['commentnum'] > 33) { ?>
<div class="ckplmore" id="more_cbtn">�鿴��������</div>
<?php } } else { ?>
<div class="no_comment">
<img src="http://static.8264.com/static/images/portal/sofa.jpg" border="0"><br>
��û�����ۣ�ɳ����������
</div>
<?php } ?>
</div>
</div>
<div class="r_260">
<div style="">
               <!-- ���λ������ҳ�Ҳ�kroceus405 --><?php echo adshow("custom_405"); ?></div>
<div class="dslink ad_border mt20"><?php echo adshow("custom_23"); ?></div>
<div class="mt20">
<div class="title_l_r clear_b"><span class="l"><a href="javascript:void(0)">�༭</a>�Ƽ�����</span></div>
<!--[diy=diybjtj]-->
<div id="diybjtj" class="area"></div>
<!--[/diy]-->
</div>

<div class="mt20">
<div class="title_l_r clear_b"><span class="l">����</span><a href="http://www.zaiwai.com/" class="ra">����</a></div>
<div class="list_news_25">
<ul>
<!--[diy=qnw]-->
<div id="qnw" class="area"></div>
<!--[/diy]-->
</ul>
</div>
</div>

<div class="mt20" style="display:none;">
<div class="title_l_r clear_b"><span class="l">ͽ��·��</span><a href="http://www.columbiasports.cn/campaign/" class="ra" target="_blank">����</a></div>
<!--[diy=xltjxz]-->
<div id="xltjxz" class="area"></div>
<!--[/diy]-->
</div>
<div class="gnlistwarpten pt20">
<div class="gnlist clear_b">
<a href="<?php echo $_G['config']['web']['portal'];?>list/842" target="_blank" class="mryt"></a>
<a href="<?php echo $_G['config']['web']['portal'];?>pp" target="_blank" class="kqmg"></a>
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei" target="_blank" class="zbtj"></a>
<a href="<?php echo $_G['config']['web']['portal'];?>list/880" target="_blank" class="yzxx"></a>
<a href="http://www.8264.com/xianlu" target="_blank" class="xltj"></a>
<a href="<?php echo $_G['config']['web']['portal'];?>list/871" target="_blank" class="ltjx"></a>
</div>
</div>
<div class="pt20">
<div class="title_l_r clear_b title_l_r_bt_n"><span class="l">�ڱ����а�</span></div>
<div class="q_warpten" id="sidebar">
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei.html" target="_blank" class="zhong">װ����</a>
<a href="<?php echo $_G['config']['web']['portal'];?>pinpai" target="_blank">Ʒ��</a>
<a href="<?php echo $_G['config']['web']['portal'];?>xianlu" target="_blank">��·</a>
<a href="<?php echo $_G['config']['web']['portal'];?>xuechang" target="_blank" class="end">��ѩ��</a>
</div>
<div class="dpcon" id="sidebox">
<div class="hxc">
<ul><?php if(is_array($zb_list)) foreach($zb_list as $zb) { ?><li>
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei-<?php echo $zb['tid'];?>-1.html" class="xcimg" target="_blank" title="<?php echo $zb['subject'];?>"><img src="<?php echo getimagethumb(60,60,2,$zb['picpath'],$zb['aid'],$zb['serverid']); ?>"/></a>
<div class="xc_r">
<a href="<?php echo $_G['config']['web']['portal'];?>zhuangbei-<?php echo $zb['tid'];?>-1.html" target="_blank" title="<?php echo $zb['subject'];?>"><?php echo $zb['subject'];?></a>
<div class="starwarpten">
<?php if($zb['score']!='0.0') { ?><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $zb['score']/2) { if($zb['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; ?><span class="fs"><?php echo $zb['score'];?></span>
<?php } else { ?>
<span class="no">��������</span>
<?php } ?>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
<div class="hxc brand" style="display:none">
<ul><?php if(is_array($pp_list)) foreach($pp_list as $pp) { ?><li>
<a href="<?php echo $_G['config']['web']['portal'];?>pinpai-<?php echo $pp['tid'];?>" class="brand" target="_blank" title="<?php echo $pp['subject'];?>"><img src="http://image.8264.com/<?php echo $pp['dir'];?>/<?php echo $pp['showimg'];?>" /></a>
<div class="xc_r brand_r">
<a href="<?php echo $_G['config']['web']['portal'];?>pinpai-<?php echo $pp['tid'];?>" target="_blank" title="<?php echo $pp['subject'];?>"><?php echo $pp['subject'];?></a>
<div class="starwarpten">
<?php if($pp['score']!='0.0') { ?><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $pp['score']/2) { if($pp['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; ?><span class="fs"><?php echo $pp['score'];?></span>
<?php } else { ?>
<span class="no">��������</span>
<?php } ?>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
<div class="hxc dp" style="display:none">
<ul><?php if(is_array($xl_list)) foreach($xl_list as $xl) { ?><li>
<div class="xc_r dp_r">
<a href="<?php echo $_G['config']['web']['portal'];?>xianlu-<?php echo $xl['tid'];?>" target="_blank" title="<?php echo $xl['subject'];?>"><?php echo $xl['subject'];?></a>
<div class="starwarpten">
<?php if($xl['score']!='0.0') { ?><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $xl['score']/2) { if($xl['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; ?><span class="fs"><?php echo $xl['score'];?></span>
<?php } else { ?>
<span class="no">��������</span>
<?php } ?>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
<div class="hxc" style="display:none">
<ul><?php if(is_array($xc_list)) foreach($xc_list as $xc) { ?><li>
<a href="<?php echo $_G['config']['web']['portal'];?>xuechang-<?php echo $xc['tid'];?>" class="xcimg" target="_blank" title="<?php echo $xc['subject'];?>"><img src="<?php echo getimagethumb(60,60,2,$xc['picpath'],$xc['aid'],$xc['serverid']); ?>"/></a>
<div class="xc_r">
<a href="<?php echo $_G['config']['web']['portal'];?>xuechang-<?php echo $xc['tid'];?>" target="_blank" title="<?php echo $xc['subject'];?>"><?php echo $xc['subject'];?></a>
<div class="starwarpten">
<?php if($xc['score']!='0.0') { ?><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $xc['score']/2) { if($xc['score']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?>"></span><?php endfor; ?><span class="fs"><?php echo $xc['score'];?></span>
<?php } else { ?>
<span class="no">��������</span>
<?php } ?>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer" style="position:relative;">
<div class="layout" style="padding: 20px 0px 26px 0px; position:relative">
<div class="topHill">����Сɽ</div>
<div class="choiceness"><?php block_display('6905'); ?></div>
</div>
    <?php echo adshow("custom_443"); ?><div class="share_bd_warpten">
<ul class="bbs_share_sc">
<li class="ps_re" id="share">
<a href="javascript:;" class="share"></a>
<div class="bdsharebuttonbox share_bd" data-tag="share_1">
<a href="javascript:;" class="sina" data-cmd="tsina"></a>
<a href="javascript:;" class="qq" data-cmd="qzone"></a>
<a href="javascript:;" class="wb" data-cmd="tqq"></a>
<a href="javascript:;" class="wx" data-cmd="weixin"></a>
</div>
</li>
<li><a href="http://www.8264.com/list/<?php echo $article['catid'];?>/" class="bbsli" title="�����б�"></a></li>
<li id="gotop_50"><a style="display: none;" href="javascript:;" class="gotop_50"></a></li>
</ul>
</div>
<script>
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
//���������������ߵ�������ť
$("#share").hover(
function () {
$(".share_bd",this).show();
},
function () {
$(".share_bd",this).hide();
}
);
//���ض�����ť
if($(window).scrollTop() > 10){$("#gotop_50 a").show();}
$(window).scroll( function(){
if($(window).scrollTop()>10){
$("#gotop_50 a").show();
}else{
$("#gotop_50 a").hide();
}
});
$("#gotop_50").click(function(){
$("html,body").animate({ scrollTop: 0 },500);
});




})(jQuery);
</script>
<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=button&amp;mini=1&amp;uid=39357" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<script>
jQuery(function (){
jQuery("p.dpcon span").each(function(i){
var dph = jQuery(this).height();
//var url = jQuery(this).parent().prev('span').find('a').attr('href');
if (dph>86){
jQuery(this).height(86).append("<i class='morelink'></i>");
}
});
});



jQuery(function (){
jQuery("p.bangdanbox span").each(function(i){
var dph = jQuery(this).height();
//var url = jQuery(this).parent().prev('span').find('a').attr('href');
if (dph>86){
jQuery(this).height(86).append("<i></i>");
}
});
});
</script>
<!-- Baidu Button END --></div>
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