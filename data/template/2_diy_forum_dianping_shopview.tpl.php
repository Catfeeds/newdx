<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('shopview', 'forum/dianping/header');
0
|| checktplrefresh('./template/8264/forum/dianping/shopview.htm', './template/8264/forum/dianping/header.htm', 1499888444, 'diy', './data/template/2_diy_forum_dianping_shopview.tpl.php', 'data/diy', 'forum/dianping/shopview')
|| checktplrefresh('./template/8264/forum/dianping/shopview.htm', './template/8264/forum/dianping/footer.htm', 1499888444, 'diy', './data/template/2_diy_forum_dianping_shopview.tpl.php', 'data/diy', 'forum/dianping/shopview')
|| checktplrefresh('./template/8264/forum/dianping/shopview.htm', './template/8264/common/header_8264_new.htm', 1499888444, 'diy', './data/template/2_diy_forum_dianping_shopview.tpl.php', 'data/diy', 'forum/dianping/shopview')
|| checktplrefresh('./template/8264/forum/dianping/shopview.htm', './template/8264/common/ewm_r.htm', 1499888444, 'diy', './data/template/2_diy_forum_dianping_shopview.tpl.php', 'data/diy', 'forum/dianping/shopview')
|| checktplrefresh('./template/8264/forum/dianping/shopview.htm', './template/8264/common/footer_8264_new.htm', 1499888444, 'diy', './data/template/2_diy_forum_dianping_shopview.tpl.php', 'data/diy', 'forum/dianping/shopview')
|| checktplrefresh('./template/8264/forum/dianping/shopview.htm', './template/8264/common/header_common.htm', 1499888444, 'diy', './data/template/2_diy_forum_dianping_shopview.tpl.php', 'data/diy', 'forum/dianping/shopview')
|| checktplrefresh('./template/8264/forum/dianping/shopview.htm', './template/8264/common/index_ad_top.htm', 1499888444, 'diy', './data/template/2_diy_forum_dianping_shopview.tpl.php', 'data/diy', 'forum/dianping/shopview')
|| checktplrefresh('./template/8264/forum/dianping/shopview.htm', './template/8264/common/taobao_ad_alert.htm', 1499888444, 'diy', './data/template/2_diy_forum_dianping_shopview.tpl.php', 'data/diy', 'forum/dianping/shopview')
;
block_get('6983');?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
    <meta name="apple-itunes-app" content="app-id=492167976">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
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
<a href="<?php echo $_G['config']['web']['portal'];?>wenda/?from=bbstop"  class="last">�ʴ�</a>
</dd>
</dl>
</li>
                <li class="wan" style="width:82px;" id="schoolpoplink"><a href="http://www.8264.com/xuexiao/?from=indexnavtop" class="topLink topLink_w_bg wkuan" target="_blank">����ѧУ</a><div class="navschoolpop"><img src="http://static.8264.com/static/image/common/xuexiaopop.png"></div></li>
                <li class="wan"><a href="http://hd.8264.com/?from=bbstop" class="topLink topLink_w_bg wkuan" target="_blank">�</a></li>
<?php if(!$is_site_index) { ?><li class="wan" style="width:67px;"><a href="http://pianyi.8264.com/?from=top" class="topLink topLink_w_bg wkuan" target="_blank">ֵ����</a></li><?php } ?>
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
<script type="text/javascript">var fid = <?php echo $_G['fid'];?>, tid = <?php echo $_G['tid'];?>;</script>
<script src="<?php echo $_G['setting']['jspath'];?>forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<style id="diy_style" type="text/css">#framepbv86W {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6983 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6983 .content {  margin:0px !important;}</style>
<script type="text/javascript">
var ie6=false;
if(/msie/.test(navigator.userAgent.toLowerCase()) && 'undefined' == typeof(document.body.style.maxHeight)){
ie6=true;
}

var postminchars = parseInt(0);
var postmaxchars = parseInt(0);
var disablepostctrl = parseInt('<?php echo $_G['group']['disablepostctrl'];?>');
var tid = <?php echo $viewdata['tid'];?>;
jQuery(document).ready(function($) {
$('#f_message').focus(function(){
!$(this).val() && $(this).prev().hide();
}).blur(function(){
!$(this).val() && $(this).prev().show();
});

$("#commentsList").on('click',".pg>a",function(e){
e.preventDefault();
var tempArr = this.href.split('-');
$.get('<?php echo $url;?>',{act:'ajaxreply',tid:parseInt(tempArr[1]),page:parseInt(tempArr[2])},function(data){
$("#commentsList>.h2Tit").nextAll().remove();
data && $("#commentsList>.h2Tit").after(data);
});
$("#commentsList>.h2Tit").after('<div style="padding: 0 0 10px 6px;"><img src="<?php echo $_G['siteurl'];?><?php echo STATICURL;?>image/common/loading.gif" style="vertical-align: top;"> ���ݶ�ȡ��...</div>');
$("#commentsList dl").remove();
$(document).scrollTop($('#commentsList').offset().top-60);
});

$("#bv_closeBtn").click(function(){
$("#div_black, #box_view").fadeOut(200);
});
$("#bm_closeBtn").click(function(){
$("#div_black, #box_map").fadeOut(200);
});
$("#lunbosmall li").eq(0).find('.black_48_48').hide();
$("#lunbosmall li").hover(function() {
$(this).find('.black_48_48').hide();
$(this).siblings().find('.black_48_48').show();
var index = $(this).index();
//$('#lunbobig li').eq(index).stop(true).fadeIn(0).siblings().delay(100).fadeOut(0);
$('#lunbobig li').eq(index).stop(true).fadeIn(0).siblings().fadeOut(0);
});
$("#starBox>span").click(function(){
if (ie6) {
$(this).prevAll().addBack().css({"background-position": "0 3px"});
$(this).nextAll().css({"background-position": "-17px 3px"});
$("#form_starNum").val(($(this).index()+1)/3);
} else {
$(this).prevAll().addBack().css({"background-position": "0 0"});
$(this).nextAll().css({"background-position": "-17px 0"});
$("#form_starNum").val($(this).index()+1);
}
});
$("#bv_starBox>span").click(function(){
$(this).prevAll().addBack().css({"background-position": "0 0"});
$(this).nextAll().css({"background-position": "-17px 0"});
$("#bv_starBox").next().html($(this).attr('title'));
if (ie6) {
$("#bv_starNum").val(($(this).index()+1)/3);
} else {
$("#bv_starNum").val($(this).index()+1);
}
});

$(document).on('click',"span[id^=editBtn_]",function(){
var p = $(this).parents('dl');
$("#box_view #pid").val(this.id.replace('editBtn_',''));
var star = p.find('#starnum').val() || 1;
var starDom = $("#bv_starBox>span").eq(star-1);
starDom.prevAll().addBack().css({"background-position": "0 0"});
starDom.nextAll().css({"background-position": "-17px 0"});
$("#bv_starBox").next().html(starDom.attr('title'));
$("#bv_starNum").val(star);
p.find('#goodpoint').html() && $("#box_view #goodpoint").val(p.find('#goodpoint').html().replace(/<br[^>]*>/gi,"\r\n"));
p.find('#weakpoint').html() && $("#box_view #weakpoint").val(p.find('#weakpoint').html().replace(/<br[^>]*>/gi,"\r\n"));
p.find('#message') && $("#box_view #message").val(p.find('#message').html().replace(/<br[^>]*>/gi,"\r\n"));
p.find('#price') && $("#box_view #price").val(p.find('#price').html());
$("#div_black, #box_view").fadeIn(200);
});
$("#boxSubmit").click(function(){
$('#bv_error').html('').hide();
var goodpoint = $("#box_view #goodpoint").val();
var weakpoint = $("#box_view #weakpoint").val();
var message = $("#box_view #message").val();
var price = $("#box_view #price").val();
var starnum = $("#bv_starNum").val();
var pid = $("#box_view #pid").val();
if(!checkText(goodpoint, weakpoint, message, 'bv_error', price)){
return false;
}
$.post('forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=reply&ext=edit&tid=<?php echo $_G['tid'];?>&inajax=1',
{pid:pid,starnum:starnum,goodpoint:goodpoint,weakpoint:weakpoint,message:message,price:price,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes'},function(data){
$("#box_view, #bv_loading").hide();
$("#boxSubmit").removeAttr('disabled');
if(data=='ok'){
_showmsg('�޸ĳɹ�');
} else if($($(data).find('root'))) {
_showmsg($(data).children('root').text().replace(/<script.*>.*<\/script>/i, ''));
} else {
_showmsg('�������������ԣ�');
}
});

var comment = $("#editBtn_"+pid).parents('dl');
comment.find('#starnum').val(starnum);
var starDom = comment.find('.starBox>span').eq(starnum-1);
starDom.prevAll().addBack().css({"background-position": "0 0"});
starDom.nextAll().css({"background-position": "-13px 0"});
comment.find('#goodpoint').html() && comment.find('#goodpoint').html(goodpoint.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('#weakpoint').html() && comment.find('#weakpoint').html(weakpoint.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('#message').html(message.replace(/(\r\n)|(\n)/gi,"<br/>"));
comment.find('#price').html(price);
$("#boxSubmit").attr('disabled','disabled');
$("#bv_loading").show();
});

$(document).on('click', "span[id^=supportBtn_]", function(){
var sid = this.id;
var pid = sid.replace('supportBtn_','');
var s_c = $(this).find('em').text() ? parseInt($(this).find('em').text().replace(/[^0-9]/ig, "")) : 0;
if(s_c == 0) $(this).addClass('active');
$(this).find('em').text('('+parseInt(s_c+1)+')');
$(this).attr('id', '');
$.get('forum.php?ctl=<?php echo $modstr;?>&act=support',{tid:'<?php echo $_G['tid'];?>',pid:pid},function(data){});
});

$("#from_post").submit(function(){
var starnum = $("#form_starNum").val();
var goodpoint = $("#f_goodpoint").val();
var weakpoint = $("#f_weakpoint").val();
var message = $("#f_message").val();
var price = $("#f_price").val();
if(!parseInt(starnum)){
_showmsg("��������ͼ����е���");
return false;
}
if(!checkText(goodpoint, weakpoint, message, '', price)){
return false;
}
$('#f_loading').show();
$('#from_post').parent('.writeCmt').hide();

$.post('forum.php?ctl=<?php echo $modstr;?>&act=dopost&do=reply&tid=<?php echo $_G['tid'];?>&inajax=1',
{starnum:starnum,goodpoint:goodpoint,weakpoint:weakpoint,message:message,price:price,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes'},function(data){
$('#f_loading').hide();
if(data=='ok'){
$('#myComment, #myComment li, #myComment .starBox').show();
$('#myComment .bottomCont>.ans').hide();
$('#myComment #starnum').val(starnum);
var starHtml = '';
for(var i=0;i<5;i++){
if(i<starnum){
starHtml += '<span class="redstar"></span>';
} else {
starHtml += '<span class="graystar"></span>';
}
}
$('#myComment .starBox').html(starHtml);
$('#myComment #goodpoint').html(goodpoint.replace(/(\r\n)|(\n)/gi,"<br/>"));
$('#myComment #weakpoint').html(weakpoint.replace(/(\r\n)|(\n)/gi,"<br/>"));
$('#myComment #message').html(message.replace(/(\r\n)|(\n)/gi,"<br/>"));
var d=new Date();
$('#myComment .date').html('������ '+d.getFullYear()+'-'+(parseInt(d.getMonth())+1)+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes());
$('#from_post').parent('.writeCmt').remove();
_showmsg('�����ɹ�');
} else if($($(data).find('root'))) {
$('#from_post').parent('.writeCmt').show();
_showmsg($(data).children('root').text().replace(/<script.*>.*<\/script>/i, ''));
} else {
$('#from_post').parent('.writeCmt').show();
_showmsg('�������������ԣ�');
}
});
return false;
});
function bv_error(msg){
$('#bv_error').html(msg).show();
}
function checkText(good,weak,msg,fun,price){
good = $.trim(good);
weak = $.trim(weak);
msg = $.trim(msg);
price = $.trim(price);
if(!fun){
fun = '_showmsg'
}
if(!good){
eval(fun+'("�����<?php echo $modname;?>���ŵ�")');
return false;
}
if(good.length<10){
eval(fun+'("���������<?php echo $modname;?>���ŵ㣬��������10���ַ�")');
return false;
}
if(!weak){
eval(fun+'("�����<?php echo $modname;?>�Ĳ���")');
return false;
}
if(weak.length<10){
eval(fun+'("���������<?php echo $modname;?>�Ĳ��㣬��������10���ַ�")');
return false;
}
if(!msg){
eval(fun+'("����д��<?php echo $modname;?>���ۺ�����")');
return false;
}
<?php if(!$my_comment['authorid'] && $viewdata['enable']==1) { ?>
if(initmsg && msg == initmsg){
eval(fun+'("����д��<?php echo $modname;?>���ۺ�����")');
return false;
}
<?php } ?>
if(msg.length < 10 || msg.length > 400){
eval(fun+'("��������д��<?php echo $modname;?>���ۺ����ۣ���������10���ַ�������400�ַ�")');
return false;
}
return true;
}

<?php if(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) || ($_G['groupid'] == 1 ||$_G['groupid']== 45))) { ?>
//ȡ����˲���
$('.guanli .setcancel').click(function(){
jQuery.ajax({
type: 'get',
url: 'forum.php?ctl=<?php echo $modstr;?>&act=checkit&type=0&tid='+tid,
success: function(html) {
if(checkreturn(html)){
jQuery('.guanli .setcancel').hide();
jQuery('.guanli .setpass').show();
jQuery('.skiName .tit').append('(δ���)');
}
}});
return false;
});
//���ͨ������
$('.guanli .setpass').click(function(){
jQuery.ajax({
type: 'get',
url: 'forum.php?ctl=<?php echo $modstr;?>&act=checkit&type=1&tid='+tid,
success: function(html) {
if(checkreturn(html)){
jQuery('.guanli .setcancel').show();
jQuery('.guanli .setpass').hide();
jQuery('.skiName .tit').text(jQuery('.skiName .tit').text().replace('(δ���)',''));
}
}});
return false;
});
var checkreturn = function (status) {
var msg = '����ʧ�ܣ�';
var success = false;
switch(status){
case '1':
msg='�����ɹ���';success=true;break;
case '-1':
msg='��û��Ȩ�޲�����';break;
}
showDialog(msg);return success;
}
<?php } if(!$_G['uid']) { ?>
$(document).on('keydown', '#f_goodpoint', saveUnLoginData);
$(document).on('keydown', '#f_weakpoint', saveUnLoginData);
$(document).on('keydown', '#f_message', saveUnLoginData);
function saveUnLoginData() {
saveUserdata(this.id + tid, this.value);
}
<?php } if(( $_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) )) { ?>
$('#glistBox').hover(function(){
$('#glist').show();
},function(){
$('#glist').hide();
});
<?php } ?>


$('.wydp_orangelink').mouseover(function() {
$('.wydp_warpten').css("display","");
});
$('.wydp_warpten').mouseleave(function() {
$('.wydp_warpten').css("display","none");
});
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

});
function loadUnloginData(name,id){
var ld = loadUserdata(name);
if(ld != '' && ld != null){
$(id).value = ld;
}
}
</script>
<div style="width:980px; margin:10px auto 10px auto"><?php echo adshow("custom_248"); ?></div>
<div id="ct" class="wp cl">
<div id="postlist" class="">
<div class="wap">
<div class="yuanjiao mian1">
<div class="mian1_left">

<div class="picShowL">
<!--�ֲ���ʼ-->
<div class="lunbo">
<div class="lunbobig">
<ul id="lunbobig"><?php $_ii = 0; if(is_array($piclist)) foreach($piclist as $pic) { ?><li <?php if($_ii > 0) { ?>style="display:none;"<?php } ?>><a title="����鿴ԭͼ" target="_blank" href="<?php echo $pic['url'];?><?php echo $pic['attachment'];?>"><img src="<?php echo getimagethumb(406,244,2,'plugin/'.$pic['attachment'], $pic['aid'], $pic['serverid']); ?>" /></a></li><?php $_ii++; } ?>
</ul>
</div>
<div class="lunbosmall" id="lunbosmall">
<ul><?php if(is_array($piclist)) foreach($piclist as $pic) { ?><li>
<a href="javascript:;"><img src="<?php echo getimagethumb(48,48,2,'plugin/'.$pic['attachment'], $pic['aid'], $pic['serverid']); ?>"/></a>
<div class="black_48_48"></div>
</li>
<?php } ?>
</ul>
</div>
</div>
<!--�ֲ�����-->
</div>

            <div class="mian1_left2">
            	<h1 class="skiName"><span class="tit"><?php echo $viewdata['name'];?></span></h1>
<?php if($province['name'] && $region['name']) { ?>
                	<p>
                	<b>��ַ��</b>
                	<?php if($province['name']==$region['name']) { ?>

                	<?php } else { ?>
                		<span><?php echo $province['name'];?></span>
                	<?php } ?>
                	<span><?php echo $region['name'];?></span>
                	<?php echo $viewdata['addr'];?>
                	</p>
<p><b>�绰��</b><?php echo $region['areacode'];?> - <?php echo $viewdata['link'];?></p>
<?php } if($sbrand['brand']) { ?>
                	<p><b>רӪƷ�ƣ�</b><?php echo $sbrand['brand'];?></p>
<?php } ?>
                <p>
                	<b>���ࣺ</b>
                	<?php if($viewdata['marketid']!=0) { ?>
                		�̳���
                	<?php } else { ?>
                		�ֱߵ�
                	<?php } ?>&nbsp;&nbsp;
                	<?php echo $market['market'];?>&nbsp;&nbsp;
                	<?php if($viewdata['cbrandid']) { ?>
<!--		                		<?php echo $cbrand['chainbrand'];?>����-->
                	<?php } else { ?>
                	<?php } ?>
</p>
                <!--<a class="liul">���&nbsp;<?php echo $viewdata['views'];?>��</a>--><a class="dianp">����&nbsp;<?php echo $viewdata['replies'];?>��</a>
</div>
<div class="clear"></div>
</div>
        <div class="mian1_right">
<div class="mian1_right1">
<h1>�ۺ�����</h1>
                <div class="pingf">
                <div class="interest_sectl" id="interest_sectl">
       					<div class="star_show"><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $star_data['price']/2) { if($star_data['price']/2-$i<1) { ?>halfstar<?php } else { ?>redstar<?php } } else { ?>graystar<?php } ?> colorstar"></span><?php endfor; ?><span class="num"><?php echo $star_data['price'];?></span>
<span class="text"></span>
</div>
                        <div class="peoples">
                            (<span class="num"><?php echo $star_data['count'];?></span>������)
                        </div>
                     <div class="star_list">
<div class="star" title="����">
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent5']*0.8 ?>px;"></span>
<span class="num"><?php echo $star_data['percent5'];?>%</span>
</div>
<div class="star" title="�Ƽ�">
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="graystar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent4']*0.8 ?>px;"></span>
<span class="num"><?php echo $star_data['percent4'];?>%</span>
</div>
<div class="star" title="����">
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent3']*0.8 ?>px;"></span>
<span class="num"><?php echo $star_data['percent3'];?>%</span>
</div>
<div class="star" title="�ϲ�">
<span class="redstar2"></span>
<span class="redstar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent2']*0.8 ?>px;"></span>
<span class="num"><?php echo $star_data['percent2'];?>%</span>
</div>
<div class="star" title="�ܲ�">
<span class="redstar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="graystar2"></span>
<span class="percent" style="width:<?php echo $star_data['percent1']*0.8 ?>px;"></span>
<span class="num"><?php echo $star_data['percent1'];?>%</span>
</div>
</div>
</div>
</div>
</div>
<?php if(( $_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && $_G['adminid']==1 )) { ?>
<div class="mian1_right2">
<div class="guanli" id="glistBox">
            	<a class="gl">����</a>
                <div class="gl_list" id="glist">
                	<ul>
<li>
<?php if(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'])) { ?>
<a href="<?php echo $url;?>&act=dopost&do=edit&tid=<?php echo $_G['tid'];?>&pid=<?php echo $viewdata['pid'];?>&page=1<?php if(!empty($_G['gp_modthreadkey'])) { ?>&modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>">�༭</a>
<?php } ?>
</li>
<li><?php if($_G['group']['allowdelpost']) { ?><a href="forum.php?ctl=<?php echo $modstr;?>&amp;act=deleteit&amp;tid=<?php echo $_G['tid'];?>" onclick="return confirm('ȷ��ɾ�����<?php echo $modname;?>��ɾ���󽫲��ɻָ���');">ɾ��</a><?php } ?></li>
<?php if(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid']) || ($_G['groupid'] == 1 ||$_G['groupid']== 45))) { ?>
<li class="setpass" <?php if($viewdata['enable']==1) { ?>style="display:none;"<?php } ?>><a class="tgsh" href="javascript:;">ͨ�����</a></li>
<li class="setcancel" <?php if($viewdata['enable']==0) { ?>style="display:none;"<?php } ?>><a class="qxsh" href="javascript:;">ȡ�����</a></li>
<?php } ?>
                    </ul>
                </div>
</div>
</div>
<?php } ?>
            <div class="clear"></div>
</div>
    <div class="clear"></div>
</div>
<div class="mian" id="page_content">
<div class="mian_left yuanjiao" id="left_8264">
        	<div>
<div class="mian_tit1">
<a href="<?php echo $url;?>&act=showview&tid=<?php echo $viewdata['tid'];?>#writecommon" class="wydp_orangelink">��Ҫ����</a>
<div class="wydp_warpten" style="display: none;">
<div class="wydp_border">
<div class="wydp_arrow"></div>
<div class="wydp_bluebg">д�����һ���Ʒ</div>
<div class="wydp_info">
<ul>
<li>
<span class="num_blue">1</span>
<span class="wydp_info_con">��д���Լ�����ʵ���ܣ��Ͻ���Ϯ</span>
<div class="clboth_0"></div>
</li>
<li>
<span class="num_blue">2</span>
<span class="wydp_info_con">����������8264�Һ��뵽��̳�һ���Ʒ</span>
<div class="clboth_0"></div>
</li>
</ul>
</div>
<a href="http://bbs.8264.com/forum-483-1.html" target="_blank" class="dh_bule"></a>
</div>
</div>
<?php echo $viewdata['subject'];?>����
<div class="clboth_0"></div>
</div>
<div class="dpjs">
<p><?php echo $viewdata['message'];?></p>
                </div>
<div class="commentBox" id="myComment"<?php if(!$my_comment || !$_G['uid']) { ?> style="display:none;"<?php } ?>>
<h2 class="h2Tit">�ҵĵ���&nbsp;&nbsp;&nbsp;<span style="color: #43A6E1; font-size: small;">�������ĵ���û�н���8264�ң�����ϵ������ԱQQ1919501975ѯ��ԭ��</span></h2>
<dl class="cmtDl">
<dd class="avatar"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank"><?php echo avatar($_G['uid'], small); ?></a></dd>
<dd class="cmtCont">
<div class="tit">
<span class="usrName"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" class="usrName"><?php echo $_G['username'];?></a></span>
<span class="date">������ <?php echo $my_comment['dateline'];?></span>
<span class="starBox"<?php if(!$my_comment['starnum']) { ?> style="display: none;"<?php } ?>><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $my_comment['starnum']) { ?>redstar<?php } else { ?>graystar<?php } ?>"></span><?php endfor; ?></span>
<?php if($my_comment['rate']) { ?>
<span class="bi"><a href="http://bbs.8264.com/forum-483-1.html" target="blank"><img align="absmiddle" title="����8264��" alt="����8264��" src="static/image/common/8264b.gif"></a></span>
<?php } ?>
<input type="hidden" name="" id="starnum" value="<?php echo $my_comment['starnum'];?>" />
</div>
<ul class="goodBad">
<li<?php if(!$my_comment['weakpoint']) { ?> style="display:none;"<?php } ?>>
<span class="leftIco bad">ȱ��</span>
<div class="cont"><p id="weakpoint"><?php echo $my_comment['weakpoint'];?></p></div>
</li>
<li<?php if(!$my_comment['goodpoint']) { ?> style="display:none;"<?php } ?>>
<span class="leftIco good">�ŵ�</span>
<div class="cont"><p id="goodpoint"><?php echo $my_comment['goodpoint'];?></p></div>
</li>
<li>
<span class="leftIco all">�ۺ�</span>
<div class="cont"><p id="message"><?php echo $my_comment['message'];?></p></div>
</li>
</ul>
</dd>
<dd class="bottomCont">
<span class="useful<?php if($my_comment['supports']>0) { ?> active<?php } ?>" title="�㲻�������Լ��ĵ���"><i></i>����<?php if(!$my_comment['supports']) { } else { ?>(<?php echo $my_comment['supports'];?>)<?php } ?></span>
<span class="ans" id="editBtn_<?php echo $my_comment['pid'];?>"><a href="javascript:;" style="color: #666;">�޸�</a></span>
<?php if($_G['adminid'] == 1 && !$my_comment['first']) { ?>
<span class="normal">
<label for="manage<?php echo $comment['pid'];?>">
<input type="checkbox" id="manage<?php echo $my_comment['pid'];?>" class="pc" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $my_comment['pid'];?>)" value="<?php echo $my_comment['pid'];?>" autocomplete="off" />
����
</label>
</span>
<?php } ?>
</dd>
</dl>
</div>
<div class="commentBox" id="commentsList">
<?php if($replylist) { ?>
                            <h2 class="h2Tit"><?php echo $viewdata['subject'];?>�ĵ���</h2><?php if(is_array($replylist)) foreach($replylist as $comment) { ?><dl class="cmtDl">
<dd class="avatar"><a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" target="_blank" rel="nofollow" ><?php echo avatar($comment[authorid], small); ?></a></dd>
<dd class="cmtCont">
<div class="tit">
<span class="usrName"><a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" target="_blank" rel="nofollow" class="usrName"><?php echo $comment['author'];?></a></span>
                                            <span style="color:#A8A8A8;float: left">������<a href="forum.php?ctl=shop&amp;act=showview&amp;tid=<?php echo $viewdata['tid'];?>" style="color:#A8A8A8;" title="<?php echo $viewdata['subject'];?>"><?php echo $viewdata['subject'];?></a>��</span>
                                            <span class="date">������ <?php echo $comment['dateline'];?></span>
<?php if($comment['starnum']) { ?>
<span class="starBox"><?php for ($i = 0; $i < 5; $i++): ?><span class="<?php if($i < $comment['starnum']) { ?>redstar<?php } else { ?>graystar<?php } ?>"></span><?php endfor; ?></span>
<input type="hidden" name="" id="starnum" value="<?php echo $comment['starnum'];?>" />
<?php } ?>
</div>
<ul class="goodBad">
<?php if($comment['weakpoint']) { ?>
<li>
<span class="leftIco bad">ȱ��</span>
<div class="cont"><p id="weakpoint"><?php echo $comment['weakpoint'];?></p></div>
</li>
<?php } if($comment['goodpoint']) { ?>
<li>
<span class="leftIco good">�ŵ�</span>
<div class="cont"><p id="goodpoint"><?php echo $comment['goodpoint'];?></p></div>
</li>
<?php } ?>
<li>
<span class="leftIco all">�ۺ�</span>
<div class="cont"><p id="message"><?php echo $comment['message'];?></p></div>
</li>
</ul>
</dd>
<dd class="bottomCont">
<span class="useful<?php if($comment['supports']>0) { ?> active<?php } ?>"
<?php if($_G['uid'] && !$supportlist[$comment['pid']]) { ?> id="supportBtn_<?php echo $comment['pid'];?>"<?php } if(!$_G['uid']) { ?> onclick="javascript:window.location.href = '<?php echo $_G['siteurl'];?>member.php?mod=logging&action=login';return false;"<?php } if($_G['uid']) { if($supportlist[$comment['pid']]) { ?>
title="���Ѿ����۹���"
<?php } else { ?>
title="����"
<?php } } else { ?>
title="��¼����ܽ�������"
<?php } ?>><i></i>����<em><?php if(!$comment['supports']) { } else { ?>(<?php echo $comment['supports'];?>)<?php } ?></em></span>
<?php if($_G['adminid'] == 1 && $comment['starnum']) { ?>
<span class="ans" id="editBtn_<?php echo $comment['pid'];?>"><a href="javascript:;" style="color: #666;">�޸�</a></span>
<?php } if($_G['adminid'] == 1 && !$comment['first']) { ?>
<span class="normal">
<label for="manage<?php echo $comment['pid'];?>">
<input type="checkbox" id="manage<?php echo $comment['pid'];?>" class="pc" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $comment['pid'];?>)" value="<?php echo $comment['pid'];?>" autocomplete="off" />
����
</label>&nbsp;
<a id="k_rate" style="color: #666;" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $comment['pid'];?>', 'get', -1);return false;" title="��8264��">����&nbsp;</a>
<?php if($comment['rate'] && $_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $comment['pid'];?>&amp;page=<?php echo $page;?>" onclick="showWindow('rate', this.href, 'get', -1)">��������</a>
<?php } ?>
</span>
<?php } ?>
</dd>
</dl>
<?php } ?>
<div class="pageBox mb25"><?php echo $replymulti;?></div>
<?php } ?>
</div>
</div>
<div id="writecommon"></div>
<?php if(!$my_comment['authorid'] && $viewdata['enable']==1) { ?>
<div style="padding: 0 0 6px 6px; display: none;" id="f_loading"><img src="/static/image/common/loading.gif" style="vertical-align: top;"> ���ݱ�����...</div>
<div class="writeCmt">
<h2 class="h2Tit">д����
<span class="starBox" id="starBox">
<span class="graystar" title="�ܲ�"></span>
<span class="graystar" title="�ϲ�"></span>
<span class="graystar" title="����"></span>
<span class="graystar" title="�Ƽ�"></span>
<span class="graystar" title="����"></span>
</span>
<span></span>
</h2>
<form method="post" id="from_post" autocomplete="off" action="<?php echo $url;?>&act=dopost&do=reply&tid=<?php echo $_G['tid'];?>">
<ul class="writeGoodBad">
<li class="mb30">
<span class="leftIco bad">����</span>
<div class="cont"><textarea name="weakpoint" rows="2" class="line3Area" id="f_weakpoint"></textarea></div>
</li>
<li class="mb30">
<span class="leftIco good">�ŵ�</span>
<div class="cont"><textarea name="goodpoint" rows="2" class="line3Area" id="f_goodpoint"></textarea></div>
</li>
<li class="mb18">
<span class="leftIco all">�ۺ�</span>
<div class="cont">
<label class="fs14"><?php echo $modsetting['initdianping'];?></label>
<textarea name="message" id="f_message" rows="6" class="line5Area "></textarea>
</div>
</li>
<li>
<div class="cont"><input <?php if($_G['uid']) { ?>type="submit"<?php } else { ?>type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')"<?php } ?> value="" class="publish182x43"></div>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="replypostsubmit" value="yes">
<input type="hidden" name="subject" value="" />
<input type="hidden" name="starnum" id="form_starNum" value="0" />
</li>
</ul>
</form>
</div>
<script type="text/javascript">
var initmsg = jQuery('#f_message').val();
</script>
<?php } ?>
</div>
</div>
        <div class="mian_right" id="right_8264">
<?php if($viewdata['lon'] && $viewdata['lat']) { ?><?php echo ChildView('forum/dianping/segment/showview/baidumap', array(
'longitude' => $viewdata['lon'],
'latitude' => $viewdata['lat'],
'name' => $viewdata['name'],
'canedit' => ((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (! in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']) && ($_G['groupid'] == 1))),
'address' => $viewdata['newaddress'],
'modstr' => $modstr,
'tid' => $viewdata['tid'],
'modname' => $modname,
'pro' => $province['name']
)); if($spfj) { ?>
            <div class="mian_rightbox yuanjiao">
            	<div class="mian_tit">
                        <p><?php echo $viewdata['subject'];?>�����ĵ���</p>
             	</div>
                <div class="ditu_t1"><?php if(is_array($spfj)) foreach($spfj as $fj) { ?>                	<div class="ditu_t1_m">
                		<a href="<?php echo $url;?>&act=showview&tid=<?php echo $fj['tid'];?>" class="dname" title="<?php echo $fj['subject'];?>"><?php echo $fj['subject'];?></a>
                        <div style=" margin-top:5px;">
                        	<div style=" float:left; padding-left:15px;"><?php $star = $fj['score']; if($star) { ?>
<span class="star"><?php for ($i = 0; $i < 5; $i++): if($i < $star/2) { ?><span class="redstar"></span><?php } else { ?><span class="graystar"></span><?php } ?><?php endfor; ?></span>
<?php } ?>
</div>
                                <div style=" float:right"><span><?php echo $fj['replies'];?></span>�˵���</div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php } } if($qt) { ?>
            <div class="mian_rightbox yuanjiao">
            	<div class="mian_tit">
<?php if($market) { ?>
            		<p><?php echo $market['market'];?>���������</p>
<?php } ?>
             	</div>
                <div class="ditu_t1"><?php if(is_array($qt)) foreach($qt as $fj) { ?>                	<div class="ditu_t1_m">
<div class="ditu_t1_mpic">
<a href="<?php echo $url;?>&act=showview&tid=<?php echo $fj['tid'];?>" title="<?php echo $fj['subject'];?>">
<img src="<?php echo getimagethumb(102,63,1,'plugin/'.$fj['sPic'], $fj['aid'], $fj['serverid']); ?>" />
</a>
</div>
                        <div class="ditu_t1_mtxt">
                        	<a href="<?php echo $url;?>&act=showview&tid=<?php echo $fj['tid'];?>" title="<?php echo $fj['subject'];?>"><?php echo $fj['subject'];?></a>
                            <div style=" margin-top:5px;"><?php $star = $fj['score']; if($star) { ?>
<span class="star"><?php for ($i = 0; $i < 5; $i++): if($i < $star/2) { ?><span class="redstar"></span><?php } else { ?><span class="graystar"></span><?php } ?><?php endfor; ?></span>
<?php } ?>
</div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php } if($dqls) { ?>
            <div class="mian_rightbox yuanjiao">
            	<div class="mian_tit">
<?php if($province&&$cbrand) { ?>
            		<p><?php echo $province['name'];?>����<span><?php echo $cbrand['chainbrand'];?></span></p>
<?php } ?>
             	</div>
                <div class="ditu_t1"><?php if(is_array($dqls)) foreach($dqls as $fj) { ?><div class="ditu_t1_m">
                		<a href="<?php echo $url;?>&act=showview&tid=<?php echo $fj['tid'];?>" class="dname1" title="<?php echo $fj['subject'];?>"><?php echo $fj['subject'];?></a>
                        <div style="float:right"><?php $star = $fj['score']; if($star) { ?>
<span class="star"><?php for ($i = 0; $i < 5; $i++): if($i < $star/2) { ?><span class="redstar"></span><?php } else { ?><span class="graystar"></span><?php } ?><?php endfor; ?></span>
<?php } ?>
</div>
                        <div class="clear"></div>
                        <div style="margin:5px 0 0 15px;"><?php echo $fj['addr'];?></div>
                    </div>
    <?php } ?>
                </div>
            </div>
<?php } if($arrCityNew) { ?>
            <div class="mian_rightbox yuanjiao">
            	<div class="mian_tit">
            		<p>ͬ�����µ���</p>
             	</div>
                <div class="ditu_t1"><?php if(is_array($arrCityNew)) foreach($arrCityNew as $fj) { ?>                	<div class="ditu_t1_m">
                		<a href="<?php echo $url;?>&act=showview&tid=<?php echo $fj['tid'];?>" class="dname" title="<?php echo $fj['subject'];?>"><?php echo $fj['subject'];?></a>
                        <div style=" margin-top:5px;">
                        	<div style=" float:left; padding-left:15px;"><?php $star = $fj['score']; if($star) { ?>
<span class="star"><?php for ($i = 0; $i < 5; $i++): if($i < $star/2) { ?><span class="redstar"></span><?php } else { ?><span class="graystar"></span><?php } ?><?php endfor; ?></span>
<?php } ?>
</div>

                                <div style=" float:right"><span><?php echo $fj['replies'];?></span>�˵���</div>
                                <div class="clear"></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php } if($arrCityHot) { ?>
            <div class="mian_rightbox yuanjiao">
            	<div class="mian_tit">
            		<p>ͬ�����ŵ���</p>
             	</div>
                <div class="ditu_t1"><?php if(is_array($arrCityHot)) foreach($arrCityHot as $fj) { ?>                	<div class="ditu_t1_m">
                		<a href="<?php echo $url;?>&act=showview&tid=<?php echo $fj['tid'];?>" class="dname" title="<?php echo $fj['subject'];?>"><?php echo $fj['subject'];?></a>
                        <div style=" margin-top:5px;">
                        	<div style=" float:left; padding-left:15px;"><?php $star = $fj['score']; if($star) { ?>
<span class="star"><?php for ($i = 0; $i < 5; $i++): if($i < $star/2) { ?><span class="redstar"></span><?php } else { ?><span class="graystar"></span><?php } ?><?php endfor; ?></span>
<?php } ?>
</div>
                                <div style=" float:right"><span><?php echo $fj['replies'];?></span>�˵���</div>
                                <div class="clear"></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
<?php } if(count($hotbrands) ) { ?>
<div class="mian_rightbox yuanjiao">
<div class="mian_tit">
<p>����Ʒ��</p>
</div>
<div class="brandList ditu_t1">
<ul><?php if(is_array($hotbrands)) foreach($hotbrands as $brand) { ?><li class="ditu_t1_m">
<div style="float: left; height: 45px; width:90px">
<img src="http://image.8264.com/forum/<?php echo $brand['showimg'];?>" alt="<?php echo $brand['subject'];?>"
width="90px;" height="45px;" />
</div>
<div>
<div class="brandName">
<a href="http://www.8264.com/pinpai-<?php echo $brand['tid'];?>" target="_blank"><?php echo $brand['subject'];?>
</a>
</div>
<div class="kb_list brandStar" style="margin-top:6px;">
<span class="kb_list"><?php for($i=1; $i<=5; $i++) : ?><span class="<?php if($i <= $brand['score']/2) { ?>
redstar
<?php } elseif($i > ($brand['score']/2 - 1)) { ?>
halfstar
<?php } else { ?>
graystar
<?php } ?>"></span><?php endfor; ?></span>
<span style="color:#F98361;"><?php echo $brand['score'];?></span>
</div>
</div>
<br style="float: none; clear: both;" />
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
</div>
        <div class="clear"></div>
</div>
</div>
</div>
<div class="popBox" id="box_view">
<div class="bd">
<div class="popWriteCmt">
<h2>
<span class="tit">�޸ĵ���</span>
<span class="tips"></span>
<span class="starBox" id="bv_starBox">
<span class="graystar" title="�ܲ�"></span>
<span class="graystar" title="�ϲ�"></span>
<span class="graystar" title="����"></span>
<span class="graystar" title="�Ƽ�"></span>
<span class="graystar" title="����"></span>
</span>
<span class="starTextTips"></span>
<input type="hidden" name="" id="bv_starNum" value="0" />
</h2>
<div style="color: red; display: none;" id="bv_error"></div>
<div style="padding: 0 0 6px 6px; display: none;" id="bv_loading"><img src="/static/image/common/loading.gif" style="vertical-align: top;"> ���ݱ�����...</div>
<form method="post" autocomplete="off" id="postform" action="<?php echo $url;?>&act=dopost&do=reply&ext=edit&page=<?php echo $_G['page'];?>&tid=<?php echo $_G['tid'];?>">
<ul class="writeGoodBad">
<li class="mb30">
<span class="leftIco bad">����</span>
<div class="cont"><textarea name="weakpoint" id="weakpoint" rows="2" class="line3Area"></textarea></div>
</li>
<li class="mb30">
<span class="leftIco good">�ŵ�</span>
<div class="cont"><textarea name="goodpoint" id="goodpoint" rows="2" class="line3Area"></textarea></div>
</li>
<li class="mb18">
<span class="leftIco all">�ۺ�</span>
<div class="cont"><textarea name="message" id="message" rows="6" class="line5Area "></textarea></div>
</li>
<li class="sub"><input type="button" value="" id="boxSubmit" class="modifi182x43"></li>
</ul>
<input type="hidden" name="pid" id="pid" value="0" />
</form>
</div>
<span class="closeBtn" id="bv_closeBtn">�ر�</span>
</div>
</div>

<form method="post" autocomplete="off" name="modactions" id="modactions">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="optgroup" />
<input type="hidden" name="operation" />
<input type="hidden" name="listextra" value="<?php echo $_G['gp_extra'];?>" />
</form>

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
<?php if($_G['forum']['ismoderator']) { if($_G['group']['allowdelpost']) { ?><a href="javascript:;" onclick="modaction('delpost', '', '', 'forum.php?ctl=<?php echo $modstr;?>&act=moderator')">ɾ��</a><span class="pipe">|</span><?php } if($_G['group']['allowstickreply']) { ?><a href="javascript:;" onclick="modaction('stickreply', '', '', 'forum.php?ctl=<?php echo $modstr;?>&act=moderator')">�ö�</a><?php } } if($_G['forum_thread']['pushedaid'] && $allowpostarticle) { ?><a href="javascript:;" onclick="modaction('pushplus', '', 'aid=<?php echo $_G['forum_thread']['pushedaid'];?>', 'portal.php?mod=portalcp&ac=article&op=pushplus')">��������</a><span class="pipe">|</span><?php } ?>
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
<script>
var tta = document.getElementsByTagName('textarea');
for(var i=0; i<tta.length; i++){
if(!isUndefined(tta[i].id)){
loadUnloginData(tta[i].id + tid, tta[i].id);
}
}
</script>
<div class="share_bd_warpten">
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
<li><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" id="m_k_favorite" onclick="showWindow(<?php if($_G['uid']) { ?>this.id, this.href, 'get', 0<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>);" class="sc"><b style="display: none;" id="favoritenumber"></b></a></li>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>" class="bbsli" title="���ص�����ҳ"></a></li>
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
var ww=$(window).width();
var s_bd_r=Math.max((ww-980)/2-60,0);
$(".share_bd_warpten").css("right",s_bd_r);
})(jQuery);

</script>
<style type="text/css">
.friendLink { background:#0f1f2b; padding: 15px 0; font: 12px/20px "Microsoft Yahei"; margin-top:20px; margin:30px auto 0px auto;}
.friendLinkcon{ width:980px; margin:0 auto;}
.friendLink span{ display:block; font-size:16px; line-height:18px; padding-bottom: 5px; color:#807f7f;}
.friendLink a { color: #807f7f; margin-right: 10px; display: inline; white-space: nowrap; text-decoration:none;}
.friendLink a:hover { color: #FFF; }
.mt30{ margin-top:0;}
</style>
<div class="friendLink">
<!--[diy=linkmore]--><div id="linkmore" class="area"><div id="framepbv86W" class=" frame move-span cl frame-1"><div id="framepbv86W_left" class="column frame-1-c"><div id="framepbv86W_left_temp" class="move-span temp"></div><?php block_display('6983'); ?></div></div></div><!--[/diy]-->
</div><div class="layout mt30"></div><?php $this->myoutput(); ?><style>
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
<?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
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
<?php } if(!($_G['siteurl'] == 'http://bbs.8264.com/' &&$_G['PHP_SELF'] == '/index.php' )) { ?><?php include(DISCUZ_ROOT.'./source/plugin/skiing/zhidemai_ad.php'); ?><?php $zhidemai_list_alert = ZhidemaiPianyiAd::pianyi_alert(10, 'top', 'jiu', '10027'); ?><div style="display:none;">
<!--��濪ʼ-->
<style>.zhidemaipopbox_y{bottom:0;height:100%;overflow:auto;position:fixed;right:0;top:0;width:100%;overflow-y:scroll;z-index:1902}.balckbg85popbg{background:#000000;bottom:0;left:0;opacity:0.85;position:fixed;right:0;top:0;z-index:1901}.zhidemaipopcon_y{position:relative;width:782px;margin:100px auto}.zhidemaititle_y{position:relative;text-align:center;border-radius:10px 10px 0 0}.zhidemaipopconlist_y{background:#fff;border-radius:0px 0px 10px 10px;overflow:hidden}.zhidemaimorelink{text-align:center;padding:23px 0px 0px 0px}.zhidemaimorelink a{font-size:16px;color:#ff6f53;border:#ff6f53 solid 1px;border-radius:30px;text-align:center;display:inline-block;padding:10px 90px;text-decoration:none}.zhidemaicloselink{background:url(http://static.8264.com/static/images/coupon/close-x.png) no-repeat;height:19px;width:22px;cursor:pointer;position:absolute;right:-32px;top:8px;display:block;z-index:99999}.product-item{width:300px;float:left;padding:25px 45px 45px}.item-price{margin-top:15px}.item-button{color:#fff;line-height:40px;font-size:0;margin-top:15px}.item-button a{width:144px;height:40px;font-size:16px;border-radius:20px;display:inline-block;text-align:center}.coupon-button{color:#fff;background-color:#ff512f;box-shadow:0 9px 18px rgba(198,60,33,.43)}.buy-button{color:#ff512f;background-color:#ffe0c1;margin-left:12px}
</style>
<div class="zhidemaiadpopbox_qianduan" style="display: none;">



<div class="balckbg85popbg"></div>
    <div class="zhidemaipopbox_y">
        <div class="zhidemaipopcon_y">
        
        	<div style=" display:none;">
                <div class="zhidemaititle_y"><img src="http://static.8264.com/static/images/coupon/slogen.png"></div>
                <?php echo adshow("custom_472"); ?>                <div class="zhidemaimorelink"><a href="http://pianyi.8264.com/goods/list-jiu-cid-10027.html" target="_blank">�鿴�����Ż�ȯ��Ʒ></a></div>
            </div>
            <a href="https://s.click.taobao.com/dcxaFhw" target="_blank"><img src="http://static.8264.com/static/ad/782-498.jpg"/></a>
            <i class="zhidemaicloselink"></i>
        </div>
    </div>
    
    
    
    
</div>





<script type="text/javascript">
jQuery(document).ready(function($) {
getcookie('couponAds_1') ? '' : $(".zhidemaiadpopbox_qianduan").show();
$(".zhidemaiadpopbox_qianduan").is(":hidden") ? "" : $("body").css("overflow","hidden");
$(".zhidemaicloselink").click(function() {
setcookie("couponAds_1", 1, 43200);
$("body").removeAttr("style");
$(".zhidemaiadpopbox_qianduan").hide();
});
});
</script>
<!--������-->
</div><?php } ?>


</body>
</html><?php output(); ?>