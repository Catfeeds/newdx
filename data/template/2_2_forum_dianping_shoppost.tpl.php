<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('shoppost', 'forum/dianping/header');
0
|| checktplrefresh('./template/8264/forum/dianping/shoppost.htm', './template/8264/forum/dianping/header.htm', 1507860082, '2', './data/template/2_2_forum_dianping_shoppost.tpl.php', './template/8264', 'forum/dianping/shoppost')
|| checktplrefresh('./template/8264/forum/dianping/shoppost.htm', './template/8264/forum/dianping/footer.htm', 1507860082, '2', './data/template/2_2_forum_dianping_shoppost.tpl.php', './template/8264', 'forum/dianping/shoppost')
|| checktplrefresh('./template/8264/forum/dianping/shoppost.htm', './template/8264/common/header_8264_new.htm', 1507860082, '2', './data/template/2_2_forum_dianping_shoppost.tpl.php', './template/8264', 'forum/dianping/shoppost')
|| checktplrefresh('./template/8264/forum/dianping/shoppost.htm', './template/8264/common/ewm_r.htm', 1507860082, '2', './data/template/2_2_forum_dianping_shoppost.tpl.php', './template/8264', 'forum/dianping/shoppost')
|| checktplrefresh('./template/8264/forum/dianping/shoppost.htm', './template/8264/common/footer_8264_new.htm', 1507860082, '2', './data/template/2_2_forum_dianping_shoppost.tpl.php', './template/8264', 'forum/dianping/shoppost')
|| checktplrefresh('./template/8264/forum/dianping/shoppost.htm', './template/8264/common/header_common.htm', 1507860082, '2', './data/template/2_2_forum_dianping_shoppost.tpl.php', './template/8264', 'forum/dianping/shoppost')
|| checktplrefresh('./template/8264/forum/dianping/shoppost.htm', './template/8264/common/index_ad_top.htm', 1507860082, '2', './data/template/2_2_forum_dianping_shoppost.tpl.php', './template/8264', 'forum/dianping/shoppost')
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
<!--[if lte IE 7]>
 <script src="http://static.8264.com/static/js/dianping/json2.js" type="text/javascript"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/<?php echo $modstr;?>style.css?<?php echo VERHASH;?>" />
<div class="blackLayout" id="div_black"></div>
<div class="popBox" id="box_msg" style="display:none;">
<div class="bd w420">
<div class="popMessage">
<div class="messageText" id="bmsg_text"></div>
<button class="sureBlueBtn_182x43" id="bmsg_ok"></button>
</div>
<span class="closeBtn" id="bmsg_closeBtn">�ر�</span>
</div>
</div>


<script type="text/javascript">
document.body.onselectstart=function(){ return false;}
document.body.style="-moz-user-select:none";
</script>



<script type="text/javascript">
jQuery(document).ready(function($) {
$("#bmsg_ok, #bmsg_closeBtn").click(function(){
$("#div_black, #box_msg").hide();
});
$('#div_black').appendTo('body');
$("#div_black").css({ opacity: 0.8 });
$('#box_msg').appendTo('body');
var bodyheight = $("body").height();
$("#div_black").height(bodyheight);
$("#div_black").hide();
});
function _showmsg(text){
jQuery("#bmsg_text").text(text);
jQuery("#div_black, #box_msg").show();
}
</script>
<div class="header">
<div class="layout">
<div class="icoHill">&nbsp;</div>
<div class="headerL">
<h1><span class="country"><?php echo $modname;?></span></h1>
<div>
<div class="site">
<a href="<?php echo $_G['config']['web']['portal'];?>">��ҳ</a>
<?php if($modstr) { ?>
> <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist"><?php echo $modname;?></a>
<?php } if($viewdata['proname']&&$modstr!='shop') { ?>
> <strong><a href="<?php echo $url;?>&act=showlist&order=heats&page=1&pro=<?php echo $viewdata['pro'];?>"><?php echo $viewdata['proname'];?></a></strong>
<?php } elseif($pcid && $modstr=='equipment') { ?>
> <strong><a href="<?php echo $url;?>&act=showlist&order=heats&pcid=<?php echo $pcid;?>&cid=0&bid=0&page=1"><?php echo $pcname;?></a></strong>
<?php if($cid) { ?>> <a href="<?php echo $url;?>&act=showlist&order=heats&pcid=<?php echo $pcid;?>&cid=<?php echo $cid;?>&bid=0&page=1"><?php echo $cname;?></a><?php } } elseif($viewdata['pcname'] && $modstr=='equipment') { ?>
> <a href="<?php echo $url;?>&act=showlist&order=heats&pcid=<?php echo $viewdata['pcid'];?>&cid=0&bid=0&page=1"><?php echo $viewdata['pcname'];?></a>
> <strong><a href="<?php echo $url;?>&act=showlist&order=heats&pcid=<?php echo $viewdata['pcid'];?>&cid=<?php echo $viewdata['cid'];?>&bid=0&page=1"><?php echo $viewdata['cname'];?></a></strong>
<?php } elseif($viewdata['cname']  && $modstr=='equipment') { ?>
> <a href="<?php echo $url;?>&act=showlist&order=heats&cid=<?php echo $viewdata['cid'];?>&page=1"><?php echo $viewdata['cname'];?></a>

<?php } if($viewdata['shortsubject'] && $modstr!='equipment') { ?>
> <strong><a href="<?php echo $url;?>&act=showview&tid=<?php echo $viewdata['tid'];?>"><?php echo $viewdata['shortsubject'];?></a></strong>
<?php } if($modstr=='brand' && $pro) { ?>
><strong><a href="<?php echo $oldurl;?>&act=showlist&let=0&nat=0&cp=<?php echo $pro['id'];?>&order=score&page=1"><?php echo $pro['produce'];?></a></strong>
<?php } if($modstr=="line") { if($province) { ?>
>
<?php } elseif($city) { ?>
>
<?php } elseif($lType) { ?>
>
<?php } ?>
                    <!--��·�������Զ����ֶδ��� by lgt at 20140815-->
                    <?php if(($city || $province) && $lType==0) { ?>
                    <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist&order=lastpost&lType=0&lTime=<?php echo $lTime;?>&province=<?php echo $province;?>&city=<?php echo $city;?>&page=1">
                        <strong><?php echo $regionsList[$province]["cityname"];?><?php echo $cityList[$province][$city]["name"];?>���ι���</strong>
                    </a>
                    <?php } elseif($city || $province) { ?>
                    <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist&order=lastpost&lType=<?php echo $lType;?>&lTime=<?php echo $lTime;?>&province=<?php echo $province;?>&city=<?php echo $city;?>&page=1">
                        <strong><?php echo $regionsList[$province]["cityname"];?><?php echo $cityList[$province][$city]["name"];?>�ܱ�<?php echo $typelist[$lType]['name'];?>��·����</strong>
                    </a>
                    <?php } ?>
                    <!--��·�������Զ����ֶδ��� by lgt at 20140815-->
                    <?php } ?>
                <?php if($modstr=="diving" && $action !='new' && $action!='edit') { ?>
                    <?php if(($city || $province) && $type==0) { ?>
                    >
                        <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist&order=lastpost&type=0&provinceid=<?php echo $province;?>&cityid=<?php echo $city;?>&page=1">
                            <strong>2014<?php echo $proList[$province]["cityname"];?><?php echo $cityList[$province][$city]["cityname"];?><?php echo $modname;?>����</strong>
                        </a>
                    <?php } elseif($city || $province) { ?>
                    >
                        <a href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $modstr;?>&act=showlist&order=lastpost&type=<?php echo $type;?>&provinceid=<?php echo $province;?>&cityid=<?php echo $city;?>&page=1">
                            <strong>2014<?php echo $proList[$province]["cityname"];?><?php echo $cityList[$province][$city]["cityname"];?><?php echo $divtypeList[$type]['name'];?>����</strong>
                        </a>
                    <?php } ?>
                <?php } ?>
</div>
<?php if($regions && $citychange) { ?>
<span class="cityChange"><span id="cBtn">���л����У�</span>
<div class="cityList" id="cList">
<div class="list">
<a href="forum.php?ctl=<?php echo $modstr;?>&amp;act=showlist&amp;order=heats&amp;page=1">�й�</a><?php if(is_array($regions)) foreach($regions as $type) { if($type['count']>0) { ?><a href="forum.php?ctl=<?php echo $modstr;?>&amp;act=showlist&amp;order=heats&amp;page=1&amp;pro=<?php echo $type['pro'];?>"><?php echo $type['name'];?></a><?php } } ?>
</div>
<span class="topJJ">��</span><span class="topJJWrite">��</span>
</div>
</span>
<script type="text/javascript">
jQuery(document).ready(function($){
$('#cBtn').click(function(){
$('#cList').show();
});
$('#cList').mouseleave(function(){
$(this).hide();
});
});
</script>
<?php } ?>
</div>
</div>
<?php if($dianpingmodules) { ?>
<div class="headerR">
<div class="colNameList"><?php if(is_array($dianpingmodules)) foreach($dianpingmodules as $dm) { ?>                                        <?php if($dm['src']!="shop" && $dm['src']!="fishing" && $dm['src']!="diving" && $dm['src']!="climb") { ?>
                                        <a <?php if($modstr == $dm['src']) { ?>class="nowmod"<?php } ?> href="<?php echo $_G['config']['web']['portal'];?>forum.php?ctl=<?php echo $dm['src'];?>&act=showlist"><?php echo $dm['name'];?></a>
                                        <?php } } ?>
</div>
</div>
<?php } ?>
</div>
</div>
<style type="text/css">
#imglist .overlimit{display:none;}
#pic_upload_multiimg { vertical-align: middle; }
</style>
<script type="text/javascript">
jQuery.noConflict();
function shop_validate(theform) {
if(trim(theform.subject.value) == "") {
_show_msg('����д�����������');
return false;
} else if(mb_strlen(theform.subject.value) > 80) {
_show_msg('���Ļ���������Ƴ��� 80 ���ַ�������');
return false;
}
if (theform.uploadfile.value == '0') {
_show_msg('���ϴ�����ͼƬ��������ѡ��һ��');
return false;
}
if (theform.province.value=="") {
_show_msg('��ѡ�����������ʡ��');
return false;
}
if (theform.region.value=="") {
_show_msg('��ѡ������̵������ڳ���');
return false;
}
if (trim(theform.address.value)=="") {
_show_msg('����д���������ϸ��ַ');
return false;
}

if (!theform.type2.checked&&!theform.type1.checked) {
_show_msg('��ѡ�����������');
return false;
}

if (theform.type1.checked) {
if (trim(theform.market.value)=="") {
_show_msg('����д������������̳�����');
return false;
}
}
if (!theform.integrated.checked&&!theform.stores.checked) {
_show_msg('��ѡ��Ʒ�����');
return false;
}
if (theform.stores.checked) {
if (trim(theform.brand.value)=="") {
_show_msg('����д�������רӪƷ��');
return false;
}
}
if (theform.chain_yes.checked) {
if (trim(theform.chainbrand.value)=="") {
_show_msg('����д���������������');
return false;
}
}
if (trim(theform.link.value)=="") {
_show_msg('����д��ϵ�绰');
return false;
}
var p1 =/^\d{7,8}$/;
if (!p1.test(theform.link.value)){
_show_msg('������ĵ绰�����д���');
return false;
}
if (trim(theform.message.value)=="") {
_show_msg('����д������̼��');
return false;
}
if (mb_strlen(theform.message.value)<100){
_show_msg('������̼������������50��');
return false;
}
<?php if($_G['gp_action'] != 'edit' && checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
if (trim(theform.captcha.value)=="") {
_show_msg('��֤�벻��Ϊ��');
return false;
}
<?php } ?>
if($('postsubmit').name == 'editpost') {
return true;
}else if(in_array($('postsubmit').name, ['replypost','newpost'])) {
postsubmit(theform);
}
return false;
}
function _show_msg(text){
jQuery("#bmsg_text").text(text);
var bodyheight = jQuery("body").height();
jQuery("#div_black").height(bodyheight);
jQuery("#div_black, #box_msg").show();
}
</script>
<div class="layout mt50">
<div class="pubWeb">
<h1 class="tit20 mb45"><?php if(($action=='new')) { ?>����<?php echo $modname;?><?php } else { ?>�༭<?php echo $modname;?><?php } ?></h1>
<div class="bd">
<form method="post" autocomplete="off" id="postform" action="
<?php if($action=='new') { ?>
forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=new
<?php } elseif($action=='reply') { ?>
forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=reply&tid=<?php echo $_G['tid'];?>
<?php } elseif($action=='edit') { ?>
forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=edit&tid=<?php echo $_G['tid'];?>
<?php } ?>" onsubmit="return shop_validate(this);return false;">
<?php if(!empty($_G['gp_modthreadkey'])) { ?><input type="hidden" name="modthreadkey" id="modthreadkey" value="<?php echo $_G['gp_modthreadkey'];?>" /><?php } ?>
<input type="hidden" name="wysiwyg" id="<?php echo $editorid;?>_mode" value="<?php echo $editormode;?>" />
<input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="posttime" id="posttime" value="<?php echo TIMESTAMP;?>" />
<?php if($action == 'edit') { ?><input type="hidden" name="pid" value="<?php echo $editdata['pid'];?>" /><?php } ?>
<dl class="pubDt50">
<dt><span class="icoName48x43"></span></dt>
<dd>
<span class="inputTipsText">
<?php if($action=='new') { ?><label class="fs16"><?php echo $modname;?><?php echo $modsetting['mc'];?></label><?php } ?>
<input type="text" class="inputText w270" name="subject" id="subject" value="<?php echo $editdata['subject'];?>" />
</span>&nbsp;&nbsp;&nbsp;<span id="subjectError"></span>
<span class="icoRedStar">*</span>
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="icoUpPic48x43"></span></dt>
<dd>
<input id="numimage" type="hidden" name="uploadfile" value="0"/>
<div id="pic_upload_multiimg">
��������Ҫ Adobe Flash Player 11.1.0 ����߰汾
<script type="text/javascript">
var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"
+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
</script>
</div>
<div class="wzjs">ͼƬ�ߴ粻С��406px*244px����ѿ�߱�Ϊ5:3</div>
<span class="icoRedStar">*</span>

<div style="clear:both;"></div>
<div id="imglist" class="readyPic"></div>
</dd>
</dl>
<?php if($action == 'edit') { ?>
<dl class="pubDt50 getRegion">
<dt><span class="icoWeb48x43"></span></dt>
<dd>
<span class="inputTipsText2">
<div class="qy selectdown" style="z-index:500;">
<input type="hidden" name="province" id="province" value="<?php echo $nowregion['id'];?>" />
<span class="js"> <?php echo $nowregion['name'];?></span>
<div class="qy_down"><?php if(is_array($regions)) foreach($regions as $type) { ?><a rel="<?php echo $type['pro'];?>" href="javascript:void(0);" class="province"><?php echo $type['name'];?></a>
<?php } ?>
</div>
</div>
</span>
<span class="inputTipsText2">
<div class="qy selectdown " style="z-index:500;" >
<input type="hidden" name="region" id="region" value="<?php echo $editdata['reg'];?>" />
<span class="js" id="city">��ѡ�����</span>
<div class="qy_down"></div>
</div>
</span>
<span class="btn_p_s plus"></span>
</dd>
</dl>
<?php } else { ?>
<dl class="pubDt50 getRegion">
<dt><span class="icoWeb48x43"></span></dt>
<dd>
<span class="inputTipsText2">
<div class="qy selectdown" style="z-index:500;">
<input type="hidden" name="province" id="province" value="" />
<span class="js">��ѡ��ʡ��</span>
<div class="qy_down"><?php if(is_array($regions)) foreach($regions as $type) { ?><a rel="<?php echo $type['pro'];?>" href="javascript:void(0);" class="province"><?php echo $type['name'];?></a>
<?php } ?>
</div>
</div>
</span>
<span class="inputTipsText2">
<div class="qy selectdown " style="z-index:500;" >
<input type="hidden" name="region" id="region" value="" />
<span class="js" id="city">��ѡ�����</span>
<div class="qy_down"></div>
</div>
</span>
<span class="btn_p_s plus"></span>
</dd>
</dl>

<?php } ?>

<dl class="pubDt50">
<dt><span class="icoGps48x43"></span></dt>
<dd>
<span id="xq"></span>
<span class="inputTipsText">
<label class="fs16"<?php if($editdata['address']) { ?> style="display:none;"<?php } ?>><?php echo $modsetting['address'];?>����Ҫ�ظ���дʡ���е���</label>
<input type="text" class="inputText w360" name="address" id="address" value="<?php echo $editdata['address'];?>" />
</span>
<span class="mapLabel" id="mapBtn">��ͼ��ע</span><span class="icoRedStar">*</span>
<div class="googleMap" style="display: none;height:400px;" id="container"></div>
<input type="hidden" value="<?php echo $editdata['lon'];?>" id="longitude" name="lon">
<input type="hidden" value="<?php echo $editdata['lat'];?>" id="latitude" name="lat">
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="icoModel48x43"></span></dt>
<dd>
<span class="rdlx">��ѡ���������</span>
<input type="radio" name="shoptype" value="0" id="type2" <?php if($editdata['shop'] == 0) { ?> checked<?php } ?> >
<label for="street" class="ml10 fs214">�ֱߵ�</label>
<input type="radio" name="shoptype" value="1" id="type1" class="" <?php if($editdata['shop']) { ?> checked<?php } ?>>
<label for="market" class="fs214">�̳���</label> <b class="redStarIco"></b>
</dd>
</dl>
<dl class="shoptype" style="display: none;">
<dd>
<span class="inputTipsText">
<label class="fs16" <?php if($shop['market']) { ?> style="display:none;"<?php } ?>>�̳�����</label>
<input type="text" class="inputText w360" name="market" id="market" <?php if($shop['market']) { ?> value="<?php echo $shop['market'];?>" <?php } else { ?> disabled="true" <?php } ?> >
</span>
</dd>
</dl>
<dl class="shoptype" style="display: none;">
<dd>
<div class="marketSelBox" id="tp"></div>
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="icoCity48x43"></span></dt>
<dd>
<span class="rdlx">��ѡ��Ʒ�����</span>
<input type="radio" name="types" value="0" id="integrated" <?php if($editdata['sb'] == 0) { ?> checked<?php } ?>>
<label for="integrated" class="ml10 fs214">�ۺ�</label>
<input type="radio" class="" name="types" value="1" id="stores" <?php if($editdata['sb']) { ?> checked<?php } ?>>
<label for="stores" class="fs214">ר��</label> <b class="redStarIco"></b>
</dd>
</dl>
<dl class="jingying" style="display: none;">
<dd>
<span class="inputTipsText">
<label class="fs16" <?php if($sb['brand']) { ?> style="display:none;"<?php } ?> >רӪƷ��</label>
<input type="text" class="inputText w360" name="brand" id="brand" size="40" <?php if($sb['brand']) { ?> value="<?php echo $sb['brand'];?>" <?php } else { ?> disabled="true" <?php } ?>>
</span>
</dd>
</dl>
<dl class="jingying" style="display: none;">
<dd>
<div class="marketSelBox clearfix" id="jy" style="height: 32px;width: 840px; overflow: hidden;">
                        <?php if($brand) { ?>
                        <div class="clearfix" style="float:left; width:810px;">
                            <?php if(is_array($brand)) foreach($brand as $sb) { ?>                            <span class="market"><?php echo $sb['brand'];?></span>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <div class="clearfix" style="float:right;"><span id="more" style="cursor: pointer;color: #2D7ECF;">����</span></div>
</div>
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="icolnk48x43"></span></dt>
<dd>
<span class="rdlx">��ѡ���Ƿ�����</span>
<input type="radio" name="chain" value="0" id="chain_no" <?php if($editdata['cb'] == 0 || $editdata['cb'] == ''  ) { ?> checked<?php } ?>>
<label for="chain_no" class="ml10 fs214">��</label>
<input type="radio" class="" name="chain" value="1" id="chain_yes"<?php if($editdata['cb']) { ?> checked<?php } ?>>
<label for="chain_yes" class="fs214">��</label>
</dd>
</dl>
<dl class="ischain" style="display: none;">
<dd>
<span class="inputTipsText">
<label class="fs16" <?php if($cb['chainbrand']) { ?> style="display:none;"<?php } ?> >��������</label>
<input type="text" class="inputText w360" name="chainbrand" id="chainbrand" size="40" <?php if($cb['chainbrand']) { ?> value="<?php echo $cb['chainbrand'];?>" <?php } else { ?> disabled="true" <?php } ?>>
</span>
</dd>
</dl>
<dl class="ischain" style="display: none;">
<dd>
<div class="marketSelBox clearfix" id="ischain"  style="height: 32px;width: 840px; overflow: hidden;">
                            <?php if($chain) { ?>
                            <div class="clearfix" style="float:left; width:810px;">
                                <?php if(is_array($chain)) foreach($chain as $ch) { ?>                                <span class="market"><?php echo $ch['cbrandid'];?></span>
                                <?php } ?>
                            </div>
                            <?php } ?>
                            <div class="clearfix" style="float:right;"><span id="cbmore" style="cursor: pointer;color: #2D7ECF;">����</span></div>
</div>
</dd>
</dl>
<dl class="pubDt50">
<dt><span class="icoTel48x43"></span></dt>
<dd>
<b id="dh" style="padding-left: 5px;display: none;"></b>
<span class="inputTipsText">
<label class="fs16"<?php if($editdata['link']) { ?> style="display:none;"<?php } ?>>�磺58585678</label>
<input type="text" class="inputText w270" name="link" id="link" value="<?php echo $editdata['link'];?>" />
</span>
<div class="contTextArea">
<div class="inputTipsText">
<label class="fs14"<?php if($editdata['message']) { ?> style="display:none;"<?php } ?>><?php echo $modsetting['initpost'];?></label>
<textarea name="message" id="message" rows="6"><?php echo $editdata['message'];?></textarea>
</div>
</div>
</dd>
</dl>
<?php if($action != 'edit' && checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
<span>��֤�룺</span>
<div style="margin-top:-20px;margin-left:50px;margin-bottom:20px;">
<script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r=<?php echo time();?>" type="text/javascript"></script>	
</div>
<?php } ?>
<dl class="pubDt50">
<dt>&nbsp;</dt>
<dd>
<input type="hidden" name="<?php echo $action;?>postsubmit" value="yes">
<input type="submit" class="publish182x43" name="<?php echo $action;?>post" id="postsubmit" value="" />
</dd>
</dl>
</form>
</div>
</div>
</div>
<script src="http://api.map.baidu.com/api?v=1.5&services=true&ak=dCS4gu0EpLStfWTvGRuD1SSB" type="text/javascript"></script>
<script type="text/javascript">
;(function($){
$('#subject').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$('#address').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$('#link').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$('#message').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$('#market').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$('#brand').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$('#chainbrand').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});
$('#captcha').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
}).click(function(){
!$(this).val() && $(this).prev().hide();
});

<?php if($_G['gp_action'] != 'edit' && checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
//��֤��
$('#refreshCaptcha').click(function() {
$(this).children('img').attr('src', '/plugin.php?id=dailypicture:captcha&_='+(new Date().getTime()));
$('#jg').html("");
return false;
});
$('#captcha').blur(function(){
 validate_captcha();
});
function validate_captcha() {
$.ajax({
async: false,
type: 'get',
url: '/plugin.php?id=dailypicture:validatecaptcha&inajax=1&captcha='+$('#captcha').val(),
success : function(data) {
if (data==1) {
$('#jg').html('<img width="16" height="16" class="vm" src="static/image/common/check_right.gif">');
$('#yzm').val('1');
}else{
$('#jg').html('<img width="16" height="16" class="vm" src="static/image/common/check_error.gif">');
$('#yzm').val('0');
$('#captcha').val('');
}
}
});
};
<?php } ?>

$(document).on("click", "#imglist .deleteimg", function() {
$(this).parent().remove();
if($("#imglist .overlimit").length > 0){
$("#imglist .overlimit:first").removeClass('overlimit').find('input:hidden').removeAttr('disabled');
}else{
$("#numimage").val($("#numimage").val() - 1);
}
});
$(".inputTipsText2").delegate('.selectdown',"mouseover",function(event){
if ($(this).find('[class$=_down]>a').length > 0) {
$(this).find('[class$=_down]').show();
}
});
$(".inputTipsText2").delegate('.selectdown',"mouseout",function(event){
$(this).find('[class$=_down]').hide();
});

$(".inputTipsText2").delegate('div[class$=_down]>a',"click",function(){
var rel = $(this).attr('rel');
$(this).parent().hide();
if(rel){
$(this).parent().siblings('input[type=hidden]').val(rel).siblings('span.js').text($(this).text()).end();
if ($(this).hasClass("province")) {
var objcity  = $(this).parents(".inputTipsText2").next().find(".qy_down");
objcity.siblings('input[type=hidden]').val("").siblings('span.js').text("��ѡ�����").end();
$("#type1").attr("checked",false);
$(".shoptype").hide();
$("#market").val("");
$('#market').blur();
$('#address').val("");
$('#address').blur();
$("#xq").html("");
$('#dh').html("");
$("#container").css("display","none");
$("#market").attr("disabled","true");
var postData = "catid="+rel;
$.ajax({
type: 'post',
dataType: 'html',
url: "<?php echo $url;?>&act=ajaxGetRegion",
data: postData,
success: function(data){
objcity.html(data);
var aNum = objcity.find("a").length;
if (objcity.find("a").length < 9) {
objcity.css({"height":"auto"});
} else {
objcity.css({"height":"240px"});
}
//����ۡ�����û��ʡ�еĴ���
if (aNum == 0) {
objcity.siblings('input[type=hidden]').val(rel);
}
}
});
} else {
$("#type1").attr("checked",false);
$(".shoptype").hide();
$("#market").val("");
$('#market').blur();
$('#address').val("");
$('#address').blur();
$.getJSON("<?php echo $url;?>&act=ajaxGetArea",{sreg:rel},function(json){
if(json!=0){
$('#dh').html(json+' -').show();
}
});
$("#container").css("display","none");
$("#market").attr("disabled","true");
}
}else{
$(this).parent().siblings('input[type=text]').val($(this).text()).end();
}
});
<?php if($action=='edit') { ?>
$(".getRegion").each(function(i){
var tempProvince = $(this).find('input[type=hidden]').eq(0).attr("value");
var tempCity 	 = $(this).find('input[type=hidden]').eq(1).attr("value");
var objcity 	 = $(this).find(".inputTipsText2").eq(1).find(".qy_down");
var js 	 		 = $(this).find(".js").eq(1);
var postData 	 = "catid="+tempProvince;
$.ajax({
type: 'post',
dataType: 'html',
url: "<?php echo $url;?>&act=ajaxGetRegion",
data: postData,
success: function(data){
objcity.html(data);
var textCity = objcity.find('a[rel='+tempCity+']').text();
if (textCity != "") {
js.html(textCity);
}
var aNum = objcity.find("a").length;
if (aNum < 9) {
objcity.css({"height":"auto"});
} else {
objcity.css({"height":"240px"});
}
//����ۡ�����û��ʡ�еĴ���
if (aNum == 0) {
objcity.siblings('input[type=hidden]').val(tempProvince);
}
}
});
$.getJSON("<?php echo $url;?>&act=ajaxGetArea",{sreg:tempCity},function(json){
if(json!=0){
$('#dh').html(json+' -').show();
}
});
});
<?php } if($editdata['shop']) { ?>
var province = <?php echo $editdata['pro'];?>;
var region = <?php echo $editdata['reg'];?>;
$.getJSON("<?php echo $url;?>&act=ajaxGetMarket",{reg:region},function(json){
$("#tp").html("");
if(json){
$.each(json,function(index,array){
   var option = "<span class='market'>"+array['marketid']+"</span>";
   $("#tp").append(option);
});
}
});
$("#market").removeAttr("disabled").focus();
$(".shoptype").show();
<?php } else { ?>
$(".shoptype").hide();
<?php } if($editdata['sb']) { ?>
$(".jingying").show();
<?php } else { ?>
$(".jingying").hide();
<?php } if($editdata['cb']) { ?>
$(".ischain").show();
<?php } else { ?>
$(".ischain").hide();
<?php } ?>

//��֤�����Ƿ����ظ�����
$("#subject").keyup(function(){
var sub = $("#subject").val();
$.ajax({'type': 'GET',
'url': '<?php echo $url;?>&act=ajaxGetTitle',
'data': {'sub': sub},
'success': function(html){
   switch (html) {
case 'repeat':
jQuery('#subjectError').text('������Ļ���������Ƽ�������,���������').css({'color': '#db0000'}).show();
$("#postsubmit").attr('disabled',"true");
break;
case 'norepeat':
jQuery('#subjectError').text('').show();
$("#postsubmit").removeAttr("disabled");
break;
default:
break;
}
}
});
});
$("#more").click(function(){
if($("#jy").css("height")!='32px'){
$("#jy").css("height",'32px');
$("#more").text("����");
}else{
$("#more").text("����");
$("#jy").css("height","auto");
}
});
$("#cbmore").click(function(){
if($("#ischain").css("height")!='32px'){
$("#ischain").css("height",'32px');
$("#cbmore").text("����");
}else{
$("#cbmore").text("����");
$("#ischain").css("height","auto");
}
});
//��ѡ��������
$("#type1").change(function(){
var province = $("#province").val();
var region = $("#region").val();
if(province==""){
_show_msg("��ѡ������ʡ�ݣ�");
$("#type1").attr("checked",false);
return;
}
if(region==""){
_show_msg("��ѡ�����ڳ��У�");
$("#type1").attr("checked",false);
return;
}
$.getJSON("<?php echo $url;?>&act=ajaxGetMarket",{reg:region},function(json){
$("#tp").html("");
if(json){
$.each(json,function(index,array){
   var option = "<span class='market'>"+array['marketid']+"</span>";
   $("#tp").append(option);
});
}
});
$("#market").removeAttr("disabled");
$(".shoptype").show();
$("#market").focus();
});
$("#type2").change(function(){
$("#market").val("");
$("#market").attr("disabled","true");
$(".shoptype").hide();
});
$("#tp").on("click",'.market',function(){
var market = $(this).text();
$('#market').prev().hide();
$("#market").val('');
$("#market").val(market);
});
//����Ӫ����
$("#integrated").change(function(){
$("#brand").val("");
$("#brand").attr("disabled","true");
$(".jingying").hide();
});
$("#stores").change(function(){
$("#brand").removeAttr("disabled");
$(".jingying").show();
$("#brand").focus();
});
$("#jy .market").click(function(){
var brand = trim($(this).text());
$('#brand').prev().hide();
$("#brand").val('');
$("#brand").val(brand);
$("#jy").css("height",'32px');
$("#more").text("����");
});
//��������
$("#chain_yes").change(function(){
$("#chainbrand").removeAttr("disabled");
$(".ischain").show();
$("#chainbrand").focus();

});
$("#chain_no").change(function(){
$("#chainbrand").val("");
$("#chainbrand").attr("disabled","true");
$(".ischain").hide();
});
$("#ischain .market").click(function(){
var chain = trim($(this).text());
$('#chainbrand').prev().hide();
$("#chainbrand").val('');
$("#chainbrand").val(chain);
$("#ischain").css("height",'32px');
$("#cbmore").text("����");
});
//���ص�ͼ��Ϣ
   $("#mapBtn").click(function(){
var region = $("#city").text();
var address = $("#address").val();
if(region == "��ѡ�����"){
_show_msg("��ѡ�����ڳ��У�");
return;
}
if(trim(address) == ""){
_show_msg("����д������ϸ��ַ��");
$("#address").select();
$("#address").focus();
return;
}
var map = new BMap.Map("container");            // ����Mapʵ��
<?php if(empty($editdata['longitude']) && empty($editdata['latitude'])) { ?>
var point = new BMap.Point(116.383, 39.973);
<?php } else { ?>
var point = new BMap.Point(<?php echo $editdata['longitude'];?>, <?php echo $editdata['latitude'];?>);
<?php } ?>
var opt = {type: BMAP_NAVIGATION_CONTROL_SMALL}
map.addControl(new BMap.NavigationControl(opt));
//map.centerAndZoom(point, 13);
//������ַ������ʵ��
var myGeo = new BMap.Geocoder();
//����ַ���������ʾ�ڵ�ͼ�ϣ���������ͼ��Ұ
myGeo.getPoint(address, function(point){
if (point) {
map.centerAndZoom(point, 16);
var marker = new BMap.Marker(point);  // ������ע
map.addOverlay(marker);
marker.enableDragging(true); // ���ñ�ע����ק
var opts = {
width : 110,     // ��Ϣ���ڿ��
height: 50,     // ��Ϣ���ڸ߶�
title : "��ʾ��Ϣ"  // ��Ϣ���ڱ���
}
jQuery("#longitude").val(point['lng']);
jQuery("#latitude").val(point['lat']);
var infoWindow = new BMap.InfoWindow("�϶��˱�ע���ĵ���Ĭ��λ��", opts);  // ������Ϣ���ڶ���
marker.addEventListener("mouseup", function(){
var position = marker.getPosition();
var s = confirm("�Ƿ���λ������Ϊ�˵��̵�Ĭ��λ�ã�");
if(s==true){
jQuery("#longitude").val(position['lng']);
jQuery("#latitude").val(position['lat']);
marker.disableDragging(true); // ���ñ�ע������ק
marker.removeEventListener("mouseup");
}else{
jQuery("#longitude").val(point['lng']);
jQuery("#latitude").val(point['lat']);
}
});
marker.openInfoWindow(infoWindow);
$("#container").css("display","");
}else{
_show_msg("�˵�ַ�ڵ�ͼ���޷��ҵ���");
}
}, region);
return false;
})
//��ʾ��Ϣ
$(".borderEmbellish").focus(function(){
$(this).select();
});
})(jQuery);
</script>

<script src="static/js/newswfobject.js" type="text/javascript"></script>
<script type="text/javascript">
var params = {site:"<?php echo $_G['siteroot'];?>misc.php%3fmod=swfupload%26type=image%26fid=<?php echo $fid;?>%26mtype=plugin%26twidth=60%26theight=60%26back=uploadsuccess_back%26random=<?php echo random(4); ?>",buttonimg:"<?php echo $_G['siteroot'];?>static/image/common/uploadnew.png"};
swfobject.embedSWF("static/flash/uploadforum.swf", "pic_upload_multiimg", "208", "50", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
swfobject.createCSS("#pic_upload_multiimg", "text-align:left;");
<?php if(($action=='edit')) { ?>
ajaxget('forum.php?ctl=<?php echo $modstr;?>&act=getimglist<?php if($editdata['tid']) { ?>&tid=<?php echo $editdata['tid'];?><?php } if($editdata['pid']) { ?>&pid=<?php echo $editdata['pid'];?><?php } ?>', 'imglist');
<?php } ?>
</script>
<script>
var maxpic = <?php echo $imgselectlimit;?>;
function uploadsuccess_back(type, returndata) {
eval("var nattach = " + returndata + ";");
jQuery.noConflict();
;(function($){
switch(type){
case 1:
case 2:
var html = '';
html 	+= '<span id="imagelist_id_'+nattach.aid+'">';
html 	+= '<img src="' + nattach.thumbpic + '" />';
html 	+= '<b class="deleteimg">ɾ��</b>';
html 	+= '<input type="hidden" value="'+nattach.aid+'" name="imgselect[]">';
html 	+= '</span>';

$("#imglist").append(html);
var attachobj = $('#imagelist_id_' + nattach.aid);
attachobj.find('input').removeAttr('disabled').end().show();

attachobj.find('img').one('error', function(){
$(this).attr('src', ' ');
$(this).attr('src', nattach.thumbpic);
}).show();
break;
case 3:
break;
}
$('#imglist').find('span:gt(' + (maxpic - 1) + ')').addClass("overlimit").find('input').attr('disabled', true);

//�����ϴ�ͼƬ��
$("#numimage").attr("value", $('#imglist').find("span:not('.overlimit')").length);
})(jQuery);
}
</script><div class="layout mt30"></div><?php $this->myoutput(); ?><style>
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.h13_ewm{ height:13px;}
.ewmbox{ width:160px; position: fixed !important; top: 215px; position: absolute; z-index: 10; float:right; color:#585858; }
.close_ewm{ width:11px; height:11px; background:url(http://static.8264.com/static/images/common/ewmclose.jpg) left top no-repeat; float:right; margin-bottom:2px; display:none;}
.close_ewm:hover{  background:url(http://static.8264.com/static/images/common/ewmclose_hover.jpg) left top no-repeat;}


</style>
<div class="ewmbox" style="display:none;">
<div class="clear_b h13_ewm"><a href="javascript:void(0)" class="close_ewm"></a></div><?php echo adshow("custom_468"); ?></div>
<script type="text/javascript">

//jQuery(function(){	
//	var isiOS 	  = navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod');
//    var isAndroid = navigator.userAgent.match('Android');
//    if (!isiOS && !isAndroid) {
//    	jQuery(".ewmbox").show();    	
//    	jQuery(".ewmbox").hover(
//			function () {
//			jQuery(".close_ewm",this).show();
//		  },
//		  function () {
//			jQuery(".close_ewm",this).hide();
//		  }
//		);
//		jQuery(".close_ewm").click(function(){
//			jQuery(".ewmbox").hide();
//		});   	
//    }
//	var ww = jQuery(window).width();   
//	var r_z = (ww-980)/2 -180;
//	if(r_z<0){
//		jQuery(".ewmbox").css("left",'0px');
//	}else{
//		jQuery(".ewmbox").css("left",r_z);
//	};
//	if(ww>1350){
//		jQuery(".ewmbox").show();
//	}else{
//		jQuery(".ewmbox").hide();
//	}	
//});

</script>
</div>
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