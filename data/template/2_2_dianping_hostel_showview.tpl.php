<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('hostel_showview', 'dianping/header');
0
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/header.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/nav.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/common/zhidemai.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/showview_content.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/showview_credit.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/hostel_mycomment.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/climb_comment.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/replyedit_pic_upload.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/reply_pic_upload.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/sidebar_map.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/dianping/footer.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/common/header_8264_new.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/common/ewm_r.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/common/weixin_share.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/common/footer_8264_new.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/common/header_common.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
|| checktplrefresh('./template/8264/dianping/hostel_showview.htm', './template/8264/common/index_ad_top.htm', 1509517904, '2', './data/template/2_2_dianping_hostel_showview.tpl.php', './template/8264', 'dianping/hostel_showview')
;
block_get('6905,7012');?>
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
<!-- �µ�����ʼ -->
<link rel="stylesheet" href="http://static.8264.com/dianping/style/layout_review.css?<?php echo VERHASH;?>">
<script src="http://static.8264.com/dianping/js/common.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script>
<?php if($act == 'showview' && $_G['adminid'] == 1) { ?>
<script type="text/javascript">var fid = parseInt('<?php echo $dp_modules[$mod]['fid'];?>'), tid = parseInt('<?php echo $tid;?>');</script>
<script src="http://static.8264.com/static/js/forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/forum_moderator.css?<?php echo VERHASH;?>" />
<?php } ?>
<script src="http://static.8264.com/static/js/newswfobject.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/dianping/easydialog.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/dianping/pro_city.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/formValidator-4.0.1.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/forum/forum_calendar.css?<?php echo VERHASH;?>" />
<div id="container" class="ui-container">
<div class="global-common-header">
<div class="module">
<div class="global-marks">
<div class="ui-block ui-block-title">
<div class="ui-title">
<h2><?php echo $dp_modules[$mod]['cname'];?></h2>
</div>
</div>
<div class="ui-crumbs ui-crumbs-box textoverflow">
<a href="http://www.8264.com/" title="��վ��ҳ">��ҳ</a>
<span>&gt;</span>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist" title="<?php echo $dp_modules[$mod]['cname'];?>"><?php echo $dp_modules[$mod]['cname'];?></a>
<?php echo $subnav;?>
<?php if($tid && $detail['subject']) { ?>
<span>&gt;</span>
<strong><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>" title="<?php echo $detail['subject'];?>" class="last"><?php echo $detail['subject'];?></a></strong>
<?php } if($bid) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=<?php echo $order;?>&amp;pcid=<?php echo $pcid;?>&amp;cid=<?php echo $cid;?>&amp;bid=0<?php if($min || $max) { ?>&amp;min=<?php echo $min;?>&amp;max=<?php echo $max;?><?php } ?>&amp;page=1" class="condition"><?php echo $brandlist[$bid]['subject'];?></a><?php } ?>
</div>
<?php if($act=='showview') { if($mod=='skiing' && $act=='showview') { ?>
<em class="city-change">
<em class="city-blue">���л����У�</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($region)) foreach($region as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;pro=<?php echo $k;?>&amp;page=1"><?php echo $v['name'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='shop') { ?>
<em class="city-change">
<em class="city-blue">���л����У�</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($arr_region)) foreach($arr_region as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;pid=<?php echo $k;?>&amp;rid=0&amp;sid=0&amp;cid=0&amp;bid=0&amp;order=lastpost&amp;page=1"><?php echo $v['name'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='climb' ) { ?>
<em class="city-change">
<em class="city-blue">���л����У�</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($proList)) foreach($proList as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;type=0&amp;placetype=0&amp;provinceid=<?php echo $k;?>&amp;cityid=0&amp;page=1"><?php echo $v['cityname'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='diving') { ?>
<em class="city-change">
<em class="city-blue">���л����У�</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($proList)) foreach($proList as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;type=0&amp;provinceid=<?php echo $k;?>&amp;cityid=0&amp;page=1"><?php echo $v['cityname'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='mountain') { ?>
<em class="city-change">
<em class="city-blue">���л����У�</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($cate_dq)) foreach($cate_dq as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;dq=<?php echo $k;?>&amp;gd=0&amp;page=1"><?php echo $v;?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='line') { ?>
<em class="city-change">
<em class="city-blue">���л����У�</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($proList)) foreach($proList as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;type=0&amp;timetype=0&amp;provinceid=<?php echo $k;?>&amp;cityid=0&amp;page=1"><?php echo $regionList[$k]['cityname'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } elseif($mod=='fishing') { ?>
<em class="city-change">
<em class="city-blue">���л����У�</em>
<div class="city-list-box">
<div class="city-list-warpten"><?php if(is_array($proList)) foreach($proList as $k => $v) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;type=0&amp;isfree=0&amp;provinceid=<?php echo $k;?>&amp;cityid=0&amp;order=lastpost&amp;page=1"><?php echo $v['cityname'];?></a>
<?php } ?>
</div>
</div>
</em>
<?php } } ?>

</div>
<ul class="global-nav"><?php if(is_array($dp_modules)) foreach($dp_modules as $v) { ?>                        <?php if($v['enable']==1 && $v['mname']!="shop" && $v['mname']!="fishing" && $v['mname']!="diving" && $v['mname']!="climb") { ?>
                        <li class="global-nav-item<?php if($v['mname']==$mod) { ?> global-nav-item-current<?php } ?>">
                                <a href="http://www.8264.com/dianping.php?mod=<?php echo $v['mname'];?>&amp;act=showlist" title="<?php echo $v['cname'];?>"><?php echo $v['cname'];?></a>
                        </li>
                        <?php } } ?>
</ul>
<div class="hill-icon"></div>
</div>
</div>

<!--��ѩͨ����濪ʼ-->

<?php if(($_G['fid'] != 490)) { ?>
<style>
.global-common-content{ margin:0px 0px 30px;}
</style>
<?php } ?>
<style>
    .review-item-detail .chenglishijian {
    width: 15px;
    height: 15px;
    float: left;
    background: url(http://static.8264.com/static/images/dianping/shijian2.png) 0 0 no-repeat;
    margin: 1px 5px 0 0;
    }
    .review-item-detail .lingdui {
    width: 15px;
    height: 15px;
    float: left;
    background: url(http://static.8264.com/static/images/dianping/lingdui2.png) 0 0 no-repeat;
    margin: 1px 5px 0 0;
    }
    .review-item-detail .type {
    width: 15px;
    height: 15px;
    float: left;
    background: url(http://static.8264.com/static/images/dianping/zizhi2.png) 0 0 no-repeat;
    margin: 1px 5px 0 0;
    }

</style>
<div class="global-common-content">
<div class="module">
<!-- ֵ���� --><?php include(DISCUZ_ROOT.'./source/plugin/skiing/hd_zw.php'); ?><?php $zhidemai_list = ForumOptionHuoDong::pianyi_sidebar(6, 'top', 'jiu', '10027'); if($zhidemai_list) { ?>
<div class="ui-grid-12 ui-grid-full" style="margin-top:20px;">
<style>
    .zhidemaiwidth{ width:980px;}
    .zhidemaibox .zhidemailist_new li{width:144px; overflow:hidden;}
    .zhidemaibox .zhidemailist_new li img{ width:144px;}
</style><style>
/*
.zhidemaibox{ width:1100px;}

.zhidemaibox{width:980px;}
.zhidemaibox .zhidemailist_new li{width:144px; overflow:hidden;}
.zhidemaibox .zhidemailist_new li img{ width:144px;}
*/
.zhidemaibox{margin:0 auto; overflow: hidden;}
.zhidemailist_new a:hover{ text-decoration:none;}
i{ font-style:normal;}
img{ border:0;}
.zhidemailist_new:after{content: ""; display: block; clear: both; visibility: hidden;}
.zhidemailist_new{ zoom: 1;}
.zhidemailist_new{ width:1100px; overflow:hidden; margin:0 auto;}
.zhidemailist_new ul{ width:1200px;height: 268px;overflow: hidden;}
.zhidemailist_new li{ float:left; width:164px; border:#e5e5e5 solid 1px; padding:6px; margin:0px 6px 0px 0px; display:inline; position:relative;}
.zhidemailist_new li img{ width:164px;}
.zhidemailist_new li .zbname_b{ display:block; text-align:center; font-size:12px; color:#585858; margin-top:8px; height:22px; overflow:hidden; line-height:1.6;}
.zhidemailist_new li .zbname_b i{ color:#e14150;}
.zhidemailist_new li .zbinfo_c{ font-size:14px; color:#e14150; display:block; height:30px; overflow:hidden; text-align:center; font-weight:bold;}
.count_down{ font-size:14px; text-align:center; position: absolute;  color:#fff; position:absolute; top:0px; left:0px; right:0px; bottom:0px; width:100%; background:rgba(0,0,0,.7);}
.count_down_con{ z-index: 1; position:absolute; left:0px; right:0px; top:25%; }
.count_down_con b{ display:block; font-weight:normal; padding:0px 0px 5px 0px;}
.count_down em{ background:#232323; border-radius:3px; display:inline-block; font-size:14px; color:#fadf00; text-align:center; margin:0px 5px; padding:0px 3px; font-weight:bold; font-style:normal;}
.twolink a{ width:49%; float:left; height:30px; line-height:30px; color:#fff; text-align:center; font-size:12px; background:#f42f02;}
.twolink a.rightlink{ width:49%; float:right;}
.onelink a{ width:100%; float:left; height:30px; line-height:30px; color:#fff; text-align:center; font-size:12px; background:#f42f02;}
.onelink b{ width:100%; float:left; height:30px; line-height:30px; color:#fff; text-align:center; font-size:12px; background:#aaa; font-weight:normal;}
.onelink em{ font-style:normal;}
.zhidemaititlebox{ background: url(http://static.8264.com/static/images/common/zdmtitletongtiao.jpg) top center no-repeat; height: 46px;  width: 100%; padding: 0px 0px 10px 0px;}
.zhidemaititlebox a{ height:46px; display:block;}
</style>

<div class="zhidemaibox zhidemaiwidth">
    <div class="zhidemaititlebox" style="display:none;"><a href="https://8264.tmall.com/search.htm?spm=a220o.1000855.w11360013-15189811505.5.4732a2bdxZPV2E&amp;search=y&amp;orderType=defaultSort" target="_blank"></a></div>
    <div class="zhidemailist_new">
        <ul>

        <?php if(is_array($zhidemai_list)) foreach($zhidemai_list as $k => $item) { ?>            <?php if(!$item['union_url'] && !$item['lq_url'] && !$item['price_jian']) $item['url'] = $item['tg_url']; ?>            <?php if($k <= 5) { ?>
            <li>
                <a href="<?php echo $item['url'];?>" target="_blank">
                    <img src="<?php echo $item['img'];?>">
                    <span class="zbname_b"><?php echo $item['title'];?></span>
                    <span class="zbinfo_c">���ּ�&yen;<?php echo number_format(($item['discount_price']-$item['price_jian']), 1);; ?></span>
                </a>
                <?php if($item['lq_url']) { ?>
                    <?php if($item['union_url']) { ?>
                    <div class="twolink"><a href="<?php echo $item['union_url'];?>" target="_blank" rel="nofollow" style="width:100%;">�섻<?php echo number_format($item['price_jian']);; ?>Ԫ������</a></div>
                    <?php } else { ?>
                    <div class="twolink"><a href="<?php echo $item['lq_url'];?>" target="_blank" rel="nofollow">�섻&yen;<?php echo number_format($item['price_jian']);; ?></a><a href="<?php echo $item['tg_url'];?>" class="rightlink" target="_blank" rel="nofollow">ȥ����</a></div>
                    <?php } ?>
                <?php } else { ?>
                <div class="onelink"><a href="<?php echo $item['tg_url'];?>" target="_blank" rel="nofollow">��������</a></div>
                <?php } ?>
                <?php if($item['starttime'] > $_G['timestamp']) { ?>
                <div class="count_down">
                    <div class="count_down_con">
                    <b>����������ʼ����</b>
                    <span class="countdown" starttime="<?php echo $_G['timestamp'];?>" endtime="<?php echo $item['starttime'];?>"></span>
                    <div><a href="<?php echo $item['tg_url'];?>" target="_blank" style="padding: 12px 0 0; display: inline-block; color: #f96015; text-align: center; text-shadow: 1px 2px 2px rgba(8, 8, 8, 0.85);letter-spacing: 1px;font-size: 13px;border-bottom: 1px solid #f96015;line-height: 1.3">ֱ�ӹ���</a></div>
                    </div>
                </div>
                <?php } ?>
            </li>
            <?php } ?>
        <?php } ?>
        </ul>
    </div>
</div>
<script src="http://static.8264.com/static/js/jquery.countdown.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
//dom������ִ��
jQuery(function($){
    $('.countdown').each(function(i, v) {
        if (!$(this).attr('endtime')){
            return;
        }
        var _this = this;
        var str = '';
        new N.countDown({
            startTime : $(this).attr('starttime') * 1000,
            endTime : $(this).attr('endtime') * 1000,
            callback : function(day, hour, minute, second) {
                str = '<span>' + (day != 0 ? '<em>' + day + '</em>' + "��" : '') + '<em>' + formatNum(hour) + '</em>' + ":" + '<em>' + formatNum(minute) + '</em>' + ":" + '<em>' + formatNum(second) + '</em></span>';

                $(_this).html(str);

                if (day == 0 && hour == 0 && minute == 0 && second == 0) {
                    window.location.reload();
                }
            }
        });
        function formatNum(n) {
            return n < 10 ? '0' + n : n;
        }
    });
});
</script>
</div>
<?php } ?>
<!-- //ֵ���� -->
<div style="margin-top:20px;display: none;">
                <?php $bottom_ads = array('416', '409', '417'); $bottom_ad = rand(0, 2); $bottom_ad_id = $bottom_ads[$bottom_ad]; ?><?php echo adshow("custom_$bottom_ad_id"); ?>                </div>
                <div style=" width:980px; margin:10px auto 10px auto;"><?php echo adshow("custom_432"); ?></div>
<div class="col-main">
<div class="main-wrap">
<div class="ui-grid-6 ui-grid-left">
    <!--detail-->
    <div class="review-left-top">
        <div class="ui-block ui-block-title">
            <div class="ui-title">
                <h1><?php echo $detail['subject'];?> <span id="info_status" <?php if($detail['ispublish']==1) { ?>style="display:none;"<?php } ?>>(δ���)</span></h1>
                <?php if($_G['adminid']==1) { ?>
                <?php include template('dianping/cplist_thread'); ?>                <?php } ?>
                <?php if($detail['ispublish']==0  && $_G['adminid']!=1) { ?>
                <a href="http://www.8264.com/forum.php?ctl=<?php echo $mod;?>&amp;act=dopost&amp;do=edit&amp;tid=<?php echo $detail['tid'];?>&amp;pid=<?php echo $detail['pid'];?>" class="op-edit">
                    <span class="ui-title-manage">�༭</span>
                </a>
                <?php } ?>
            </div>
        </div>
        <div class="ui-block ui-block-content">
            <div class="review-item-info">
                <div class="review-gallery">
                    <div class="review-booth">
                        <ul class="review-pic-box">
                            <?php if(is_array($piclist)) foreach($piclist as $pic) { ?>                            <li>
                                <a  title="����鿴ԭͼ" target="_blank" href="<?php echo $pic['url'];?><?php echo $pic['attachment'];?>">
                                    <img src="<?php echo getimagethumb(322,322,11, 'plugin/'.$pic['attachment'], $pic['aid'], $pic['serverid']); ?>">
                                </a>
                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                    <ul class="review-booth-tbumb">
                        <?php if(is_array($piclist)) foreach($piclist as $pic) { ?>                        <li class="pic-selected">
                            <div class="pic-item">
                                <a href="javascript:;" target="_blank">
                                    <img src="<?php echo getimagethumb(48,48,2,'plugin/'.$pic['attachment'], $pic['aid'], $pic['serverid']); ?>" style="width: 48px;height: 48px;">
                                </a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="review-attribute">
                    <div class="attribute-top-content">
                        <div class="rating-level big-rating bv-rating">
                            <span class="score-value score-value-<?php echo floor($detail['score']); ?>">
                                <em></em>
                            </span>
                            <strong><?php echo $detail['score'];?></strong>
                        </div>
                        <div class="reviews-count">
                            (<span class="num"><?php if($detail['cnum']) { ?><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>#comment"><?php echo $detail['cnum'];?></a><?php } else { ?>0<?php } ?></span>������)
                        </div>
                        <div class="rw-rechart-con">
                            <div title="�ǳ�����" class="rm-rechart-line">
                                <div class="rating-level small-rating rm-rating">
                                    <span class="score-value score-value-10">
                                        <em></em>
                                    </span>
                                </div>
                                <div class="rm-rechart-bar">
                                    <div class="rm-rechart-full" style="width:<?php echo $detail['percent5'];?>%;"></div>
                                </div>
                                <div class="rm-rechart-val"><?php echo $detail['percent5'];?>% (����)</div>
                            </div>
                            <div title="����" class="rm-rechart-line">
                                <div class="rating-level small-rating rm-rating">
                                    <span class="score-value score-value-8">
                                        <em></em>
                                    </span>
                                </div>
                                <div class="rm-rechart-bar">
                                    <div class="rm-rechart-full" style="width:<?php echo $detail['percent4'];?>%;"></div>
                                </div>
                                <div class="rm-rechart-val"><?php echo $detail['percent4'];?>% (�Ƽ�)</div>
                            </div>
                            <div title="��" class="rm-rechart-line">
                                <div class="rating-level small-rating rm-rating">
                                    <span class="score-value score-value-6">
                                        <em></em>
                                    </span>
                                </div>
                                <div class="rm-rechart-bar">
                                    <div class="rm-rechart-full" style="width:<?php echo $detail['percent3'];?>%;"></div>
                                </div>
                                <div class="rm-rechart-val"><?php echo $detail['percent3'];?>% (����)</div>
                            </div>
                            <div title="��" class="rm-rechart-line">
                                <div class="rating-level small-rating rm-rating">
                                    <span class="score-value score-value-4">
                                        <em></em>
                                    </span>
                                </div>
                                <div class="rm-rechart-bar">
                                    <div class="rm-rechart-full" style="width:<?php echo $detail['percent2'];?>%;"></div>
                                </div>
                                <div class="rm-rechart-val"><?php echo $detail['percent2'];?>% (�ϲ�)</div>
                            </div>
                            <div title="�ǳ���" class="rm-rechart-line">
                                <div class="rating-level small-rating rm-rating">
                                    <span class="score-value score-value-2">
                                        <em></em>
                                    </span>
                                </div>
                                <div class="rm-rechart-bar">
                                    <div class="rm-rechart-full" style="width:<?php echo $detail['percent1'];?>%;"></div>
                                </div>
                                <div class="rm-rechart-val"><?php echo $detail['percent1'];?>% (�ܲ�)</div>
                            </div>
                        </div>
                        <div class="review-item-detail">
                            <?php if($detail['chenglishijian']) { ?>
                            <span class="detail-item ">
                                <i class="ui-icon chenglishijian"></i>����ʱ�䣺<?php echo $detail['chenglishijian'];?>��
                            </span>
                            <?php } ?>
<!--                            <span class="detail-item tel">
                                <i class="ui-icon"></i>��ϵ��ʽ��<?php if($detail['tel']) { ?><?php echo $detail['tel'];?><?php } else { ?>δ��д<?php } ?>
                            </span>-->
                            <span class="detail-item address">
                                <i class="ui-icon"></i>���ڵأ�<?php echo $countries[$detail['provinceid']]['cityname'];?><?php echo $countries[$detail['cityid']]['cityname'];?>
                            </span>
                            <?php if($detail['lingduinum'] > 0) { ?>
                            <span class="detail-item ">
                                <i class="ui-icon lingdui"></i>��֤��ӣ�<?php echo $detail['lingduinum'];?>��
                            </span>
                            <?php } ?>
                            <?php if($detail['gongsitype']) { ?>
                            <span class="detail-item ">
                                <i class="ui-icon type"></i>��˾���ʣ�<?php echo $cate_type[$detail['gongsitype']];?>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //detail -->
</div>
<div class="ui-grid-6 ui-grid-left">
    <!-- content -->
    <div class="review-intro">
<div class="ui-block ui-block-title">
<div class="ui-title ui-title-line" style="zoom:1;">
<h3><?php echo $detail['subject'];?><?php if($mod=='brand') { ?>Ʒ��<?php } ?>���</h3>
                        <?php if($detail['ispublish']!=0) { ?>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>#write" class="ui-title-link"><i class="ui-icon ui-review-icon"></i>��Ҫ����</a>
                        <?php } ?>
<!--��Ҫ����������ʼ-->
<div class="wydp_warpten">
<div class="wydp_arrow"></div>
<div class="wydp_bluebg">д�����һ���Ʒ</div>
<div class="wydp_info">
<ul>
<li><span class="num_blue">1</span><span class="wydp_info_con">��д���Լ�����ʵ���ܣ��Ͻ���Ϯ</span></li>
<li>
<span class="num_blue">2</span>
<span class="wydp_info_con">����������8264�Һ��뵽��̳�һ���Ʒ</span>
</li>
</ul>
</div>
<a class="dh_bule" target="_blank" href="http://bbs.8264.com/forum-483-1.html">ȥ�һ�</a>
</div>
<!--��Ҫ������������-->
<div style=" font-size:0px; clear:both; height:0px; line-height:0px;"></div>
</div>
</div>
<div class="ui-block ui-block-content">
<div class="intro-main">
<?php echo $plug_content_top;?>
<p>
<?php echo $detail['message'];?>
</p>
<div class="J-more view-more" style="display:none;"><a href="javascript:void(0)">�鿴����</a></div>
</div>
</div>
</div>
    <!-- //content -->
</div>
<!--ȥ��8264��-->
<div class="ui-grid-6 ui-grid-left">
    <!-- ����׬8264�� -->
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
.hotmudidibox{border:#e0e7eb solid 1px; border-bottom:0px; border-right:0px; margin-top:15px; width:655px;}
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
    <!-- //����׬8264�� -->
</div>
<div class="ui-grid-6 ui-grid-left">
    <!-- comment list -->
    <!-- �ҵĵ��� -->
    <div id="mycomment">
        <?php if($mycomment) { ?>
        	<div class="review-comment-box">
<div class="ui-block ui-block-title">
<div class="ui-title ui-title-line">
<h3>�ҵĵ���</h3><span class="note">�������ĵ���û�н���8264�ң�����ϵ������ԱQQ1919501975ѯ��ԭ��</span>
</div>
</div>
<div class="ui-block ui-block-content">
<div class="comment-main">
<div id="post_<?php echo $mycomment['pid'];?>" class="comment-list-box">
<div class="avatar-box">
<a href="home.php?mod=space&amp;uid=<?php echo $mycomment['authorid'];?>" class="user-avatar" target="_blank" rel="nofollow"><?php echo avatar($mycomment['authorid'], small); ?><span class="user-name"><?php echo $mycomment['author'];?></span>
</a>
</div>
<div class="comment-word">
<?php if($mycomment['starnum']) { ?>
<div class="rows-content row-color-1">
<div class="commAttr">
<i class="attrs-icon comm"></i>�Ƽ�
</div>
<div class="attrValues">
<div class="rating-level big-rating clist-rating">
<span class="score-value score-value-<?php echo $mycomment['starnum']*2; ?>">
<em></em>
</span>
<span>(<?php if($mycomment['starnum']==1) { ?>�ܲ�<?php } elseif($mycomment['starnum']==2) { ?>�ϲ�<?php } elseif($mycomment['starnum']==3) { ?>����<?php } elseif($mycomment['starnum']==4) { ?>�Ƽ�<?php } elseif($mycomment['starnum']==5) { ?>����<?php } ?>)</span>
</div>
</div>
</div>
<?php } if($mycomment['weakpoint']) { ?>
<div class="rows-content row-color-2">
<div class="commAttr">
<i class="attrs-icon note"></i>����
</div>
<div class="attrValues">
<p><?php echo $mycomment['weakpoint'];?></p>
</div>
</div>
<?php } if($mycomment['goodpoint']) { ?>
<div class="rows-content row-color-3">
<div class="commAttr">
<i class="attrs-icon date"></i>�ŵ�
</div>
<div class="attrValues">
<p><?php echo $mycomment['goodpoint'];?></p>
</div>
</div>
<?php } ?>
<div class="rows-content row-color-5">
<div class="commAttr">
<i class="attrs-icon complex"></i>�ۺ�
</div>
<div class="attrValues">
<p><?php echo $mycomment['message'];?></p>
</div>
</div>
<?php if($mycomment['attachlist']) { ?>
<div class="rows-content row-color-6">
<div class="commAttr">
<i class="attrs-icon picture"></i>ͼƬ
</div>
<div class="attrValues">
<ul class="attrPic-list"><?php if(is_array($mycomment['attachlist'])) foreach($mycomment['attachlist'] as $item) { ?><li>
<a href="http://<?php if($item['serverid']==1) { ?>image<?php } elseif($item['serverid']==99) { ?>image1<?php } ?>.8264.com/<?php echo $item['dir'];?>/<?php echo $item['attachment'];?>" target="_blank" title="����鿴��ͼ"><img src="<?php echo getimagethumb(80,80,2, $item['dir'].'/'.$item['attachment'], '', $item['serverid']); ?>" alt="<?php echo $mycomment['subject'];?>"></a>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
<div class="rows-content row-color-6">
<div class="attrValues rows-detail">
<span class="rows-time"><?php echo dgmdate($mycomment['dateline']); ?></span>
<span class="rows-title"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $mycomment['tid'];?>" target="_blank"><?php echo $mycomment['subject'];?></a></span>
<div class="rows-praise">
<a href="javascript:void(0);" id="support_<?php echo $mycomment['pid'];?>" onclick="support(<?php echo $mycomment['pid'];?>);"><i class="rows-icon<?php if($mycomment['supports']) { ?> icon-praise<?php } ?>"></i>����<em><?php if($mycomment['supports']) { ?>(<?php echo $mycomment['supports'];?>)<?php } ?></em></a>
</div>
</div>
</div>
                        <?php if($act=='showview' && $_G['uid']) { include template('dianping/cplist_comment'); } ?>
</div>
                       <?php if($mycomment['rate']) { ?><span class="b8264icon"></span><?php } ?>
</div>

</div>
</div>
</div>
<?php if($_GET['inajax'] == 1) { ?><?php dp_output(); } ?>
        <?php } ?>
    </div>
    <!-- //�ҵĵ��� -->
    <?php if(!$commentlist) { ?>
    <div style="margin:16px 0px 30px 0px; display:none;"><img src="http://static.8264.com/dianping/images/demo/ppyb.jpg"></div>
    <?php } ?>
    <?php if($commentlist) { ?>
    <div class="review-comment-box"><a id="comment"></a>
        <div class="ui-block ui-block-title">
            <div class="ui-title ui-title-line">
                <h3><?php echo $detail['subject'];?>�ĵ���</h3>
            </div>
            <div class="ui-title ui-title-line star-s">
                <input type="hidden" value='' class="snum">
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>" id='0'>ȫ��(<?php echo $recordnum;?>)</a>
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>" id='5'>5��</a>
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>"  id='4'>4��</a>
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>"  id='3'>3��</a>
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>"  id='2'>2��</a>
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>"  id='1'>1��</a>
            </div>
        </div>
        <div style="margin:16px 0px 30px 0px; display:none;"><img src="http://static.8264.com/dianping/images/demo/ppyb.jpg"></div>
        <div class="ui-block ui-block-content">
            <div class="comment-main">
                <div id="commentlist">
                    <?php if(is_array($commentlist)) foreach($commentlist as $comment) { ?><div id="post_<?php echo $comment['pid'];?>" class="comment-list-box">
    <div class="avatar-box">
        <a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="user-avatar" target="_blank" rel="nofollow">
            <?php echo avatar($comment['authorid'], small); ?>            <span class="user-name"><?php echo $comment['author'];?></span>
        </a>
    </div>
<div class="comment-word">
<div class="rows-content row-color-2">
<div class="commAttr">
<i class="attrs-icon comm"></i>�Ƽ�
</div>
<div class="attrValues">
<div class="rating-level big-rating clist-rating">
<span class="score-value score-value-<?php echo $comment['starnum']*2; ?>">
<em></em>
</span>
<span>(<?php if($comment['starnum']==1) { ?>�ܲ�<?php } elseif($comment['starnum']==2) { ?>�ϲ�<?php } elseif($comment['starnum']==3) { ?>����<?php } elseif($comment['starnum']==4) { ?>�Ƽ�<?php } elseif($comment['starnum']==5) { ?>����<?php } ?>)</span>
</div>
</div>
</div>
        <div class="rows-content row-color-3">
            <div class="commAttr">
                <i class="attrs-icon date"></i>����
            </div>
            <div class="attrValues">
                <p><?php echo $comment['weakpoint'];?></p>
            </div>
        </div>
<div class="rows-content row-color-4">
<div class="commAttr">
<i class="attrs-icon date"></i>�ŵ�
</div>
<div class="attrValues">
<p><?php echo $comment['goodpoint'];?></p>
</div>
</div>

<div class="rows-content row-color-5">
<div class="commAttr">
<i class="attrs-icon complex"></i>�ۺ�
</div>
<div class="attrValues">
<p><?php echo $comment['message'];?></p>
</div>
</div>
        <?php if($comment['attachlist']) { ?>
        <div class="rows-content row-color-6">
            <div class="commAttr">
                <i class="attrs-icon picture"></i>ͼƬ
            </div>
            <div class="attrValues">
                <ul class="attrPic-list">
                    <?php if(is_array($comment['attachlist'])) foreach($comment['attachlist'] as $item) { ?>                    <li>
                        <a href="http://<?php if($item['serverid']==1) { ?>image<?php } elseif($item['serverid']==99) { ?>image1<?php } ?>.8264.com/<?php echo $item['dir'];?>/<?php echo $item['attachment'];?>" target="_blank" title="����鿴��ͼ"><img src="<?php echo getimagethumb(80,80,2, $item['dir'].'/'.$item['attachment'], '', $item['serverid']); ?>" alt="<?php echo $mycomment['subject'];?>"></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>
        <div class="rows-content row-color-6">
            <div class="attrValues rows-detail">
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=commentdetail&amp;tid=<?php echo $comment['tid'];?>&amp;pid=<?php echo $comment['pid'];?>&amp;uid=<?php echo $comment['uid'];?>" target="_blank"><span class="rows-time"><?php echo dgmdate($comment['dateline']); ?></span></a>
                <span class="rows-title"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $comment['tid'];?>" target="_blank"><?php echo $comment['subject'];?></a></span>
                <div class="rows-praise">
                    <a href="javascript:void(0);" id="support_<?php echo $comment['pid'];?>" onclick="support(<?php echo $comment['pid'];?>);"><i class="rows-icon<?php if($comment['supports']) { ?> icon-praise<?php } ?>"></i>����<em><?php if($comment['supports']) { ?>(<?php echo $comment['supports'];?>)<?php } ?></em></a>
                </div>
            </div>
        </div>
        <?php if($act=='showview' && $_G['adminid'] == 1) { include template('dianping/cplist_comment'); } ?>

</div>
    <?php if($comment['rate']) { ?><span class="b8264icon"></span><?php } ?>
</div>
<?php } if($act=='showview' && $multipage) { ?>
<!-- page -->
<div class="page-box-warpten"><?php echo $multipage;?></div>
<!-- //page -->
<?php } if($_GET['ajaxreply'] == 1) { ?><?php dp_output(); } if($act=='showview' && $_G['adminid'] == 1) { ?>
<form method="post" autocomplete="off" name="modactions" id="modactions">
    <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
    <input type="hidden" name="optgroup" />
    <input type="hidden" name="operation" />
    <input type="hidden" name="listextra" value="<?php echo $_G['gp_extra'];?>" />
</form>
<style>#mdly { margin: 20px 0 0 10px; padding: 0; width: 200px; height: auto; background: none; }</style>
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
                        <?php if($_G['adminid'] == 1) { ?>
                        <?php if($_G['group']['allowdelpost']) { ?><a href="javascript:;" onclick="modaction('delpost', '', '', 'forum.php?ctl=<?php echo $mod;?>&act=moderator')">ɾ��</a><span class="pipe">|</span><?php } ?>
                        <?php if($_G['group']['allowstickreply']) { ?><a href="javascript:;" onclick="modaction('stickreply', '', '', 'forum.php?ctl=<?php echo $mod;?>&act=moderator')">�ö�</a><?php } ?>
                        <?php } ?>
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
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- //comment list -->
</div>

<div class="pl-popup-wrap mod-edit-popup" id="edithtml" style="display:none;">
    <!-- comment public -->
    <div class="write-comment-box">
        <div class="ui-block ui-block-title">
            <div class="ui-title ui-title-line">
                <h3>�޸ĵ���</h3>
                <a href="javascript:void(0);" class="close-popup">�ر�</a>
            </div>
        </div>
        <form method="post"  id="editform" action="" autocomplete="off">
            <input type="hidden" id="pid" name="pid" value="" size="2" />
            <input type="hidden" id="uid" name="uid" value="" size="2" />
            <div class="ui-block ui-block-content">
                <div class="comment-form-box">
                    <div class="rows-content row-color-1">
                        <div class="commAttr">
                            <i class="attrs-icon comm"></i>�Ƽ�
                        </div>
                        <div class="attrForms">
                            <div class="star-rating-box">
                                <ul class="star-rating-level stars1">
                                    <li><a class="one-star" id="star_1_e" value='1' href="javascript:void(0);" title="�ܲ�">100</a></li>
                                    <li><a class="two-stars" id="star_2_e" value='2' href="javascript:void(0);" title="�ϲ�">200</a></li>
                                    <li><a class="three-stars" id="star_3_e" value='3'  href="javascript:void(0);" title="����">300</a></li>
                                    <li><a class="four-stars" id="star_4_e" value='4' href="javascript:void(0);" title="�Ƽ�">400</a></li>
                                    <li><a class="five-stars" id="star_5_e" value='5' href="javascript:void(0);" title="����">500</a></li>
                                </ul>
                                <span class="result stars1-tips"  style=""></span>
                                <input type="hidden" id="starnum_e" class="starnum" name="starnum" value="" size="2" />
                            </div>
                        </div>
                    </div>
                    <div class="rows-content row-color-3">
                        <div class="commAttr">
                            <i class="attrs-icon price"></i>����
                        </div>
                        <div class="attrForms">
                            <div class="issue-forms-group">
                                <textarea name="weakpoint" id="weakpoint_e" class="editinput" cols="30" rows="2" ></textarea>
                                <div id="weakpoint_eTip" class="valid-tips-container"></div>
                            </div>
                        </div>
                    </div>
                    <div class="rows-content row-color-4">
                        <div class="commAttr">
                            <i class="attrs-icon note"></i>�ŵ�
                        </div>
                        <div class="attrForms">
                            <div class="issue-forms-group">
                                <textarea name="goodpoint" id="goodpoint_e" class="editinput" cols="30" rows="2"></textarea>
                                <div id="goodpoint_eTip" class="valid-tips-container"></div>
                            </div>
                        </div>
                    </div>
                    <div class="rows-content row-color-5">
                        <div class="commAttr">
                            <i class="attrs-icon complex"></i>�ۺ�
                        </div>
                        <div class="attrForms">
                            <div class="issue-forms-group">
                                <textarea name="message" id="message_e" class="editinput" cols="30" rows="6" ></textarea>
                                <div id="message_eTip" class="valid-tips-container"></div>
                            </div>
                        </div>
                    </div>
                    <!--start----�༭ҳ���ͼƬ�ϴ���-->
                    <div class="rows-content row-color-6">
    <div class="commAttr">
        <i class="attrs-icon picture"></i>ͼƬ
    </div>
    <dl class="pubDt50">
        <dt><span class="icoUpPic48x43"></span></dt>
        <dd>
            <input id="numimage_e" type="hidden" name="uploadfile" value="0"/>
            <div id="check_pic_upload_e">
                <div id="pic_upload_multiimg_e">
                    ��������Ҫ Adobe Flash Player 10.0.0 ����߰汾
                    <script type="text/javascript">
                        var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
                        document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"
                        + pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
                    </script>
                </div>
            </div>
            <input type="button" name="button2" id="limit_pic_upload_e" value="" class="flup" style="display:none;">
            <span class="upload-arrow">����ϴ�3��</span>
            <span id="imagelisttemp_e" style="display: none;" class="attachpic">
                <b class="deleteimg" >ɾ��</b>
                <input type="hidden" name="imgselect[]" value="" disabled="true"/>
            </span>
            <div class="clearfix"></div>
            <div id="imglist_e" class="readyPic">

            </div>
        </dd>
    </dl>
</div>                    <!--end----�༭ҳͼƬ�ϴ���-->
                    <div class="rows-content row-color-6">
                        <div class="attrForms">
                            <div class="issue-submit-group">
                                <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
                                <input type="hidden" name="replypostsubmit" value="yes">
                                <input type="hidden" name="subject" value="" />
                                <input type="submit" name="submit" value="����" class="btn-issue" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- //comment public -->
</div>
<?php if($detail['ispublish']!=0) { if(!$mycomment) { ?>
<div class="ui-grid-6 ui-grid-left">
    <!-- comment public --><a id="write"></a>
    <div class="write-comment-box">
        <div class="ui-block ui-block-title">
            <div class="ui-title ui-title-line">
                <h3>д����</h3>
            </div>
        </div>
        <form method="post"  id="postform" action="" autocomplete="off">
        <div class="ui-block ui-block-content">
            <div class="comment-form-box">
                <div class="rows-content row-color-1">
                    <div class="commAttr">
                        <i class="attrs-icon comm"></i>�Ƽ�
                    </div>
                    <div class="attrForms">
                        <div class="star-rating-box">
                            <ul class="star-rating-level stars1">
                                <li><a class="one-star" id="star_1" value='1' href="javascript:void(0);" title="�ܲ�">100</a></li>
                                <li><a class="two-stars" id="star_2" value='2' href="javascript:void(0);" title="�ϲ�">200</a></li>
                                <li><a class="three-stars" id="star_3" value='3'  href="javascript:void(0);" title="����">300</a></li>
                                <li><a class="four-stars" id="star_4" value='4' href="javascript:void(0);" title="�Ƽ�">400</a></li>
                                <li><a class="five-stars" id="star_5" value='5' href="javascript:void(0);" title="����">500</a></li>
                            </ul>
                            <span class="result stars1-tips"  style=""></span>
                            <div class="clearfix"></div>
                            <input type="hidden" id="starnum" class="starnum" name="starnum" value="" size="2" />
                            <div id="starnumTip" class="valid-tips-container" style="display: none;">
                                <div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>��������ͼ����е���</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rows-content row-color-3">
                    <div class="commAttr">
                        <i class="attrs-icon price"></i>����
                    </div>
                    <div class="attrForms">
                        <div class="issue-forms-group">
                            <textarea name="weakpoint" id="weakpoint" cols="30" rows="2" placeholder="����д�ÿ�ջ�Ĳ���֮��"></textarea>
                            <div id="weakpointTip" class="valid-tips-container"></div>
                        </div>
                    </div>
                </div>
                <div class="rows-content row-color-4">
                    <div class="commAttr">
                        <i class="attrs-icon note"></i>�ŵ�
                    </div>
                    <div class="attrForms">
                        <div class="issue-forms-group">
                            <textarea name="goodpoint" id="goodpoint" cols="30" rows="2" placeholder="����д�ÿ�ջ���ŵ�"></textarea>
                            <div id="goodpointTip" class="valid-tips-container"></div>
                        </div>
                    </div>
                </div>
                <div class="rows-content row-color-5">
                    <div class="commAttr">
                        <i class="attrs-icon complex"></i>�ۺ�
                    </div>
                    <div class="attrForms">
                        <div class="issue-forms-group">
                            <textarea name="message" id="message" cols="30" rows="6" placeholder="����д�ÿ�ջ���ۺ�����"></textarea>
                            <div id="messageTip" class="valid-tips-container"></div>
                        </div>
                    </div>
                </div>
                <!--start----����ҳͼƬ�ϴ�-->
                <?php if($_G['uid']) { ?>
<div class="rows-content row-color-6">
    <div class="commAttr">
        <i class="attrs-icon picture"></i>ͼƬ
    </div>
    <dl class="pubDt50">
        <dt><span class="icoUpPic48x43"></span></dt>
        <dd>
            <input id="numimage" type="hidden" name="uploadfile" value="0"/>
            <div id="check_pic_upload">
                <div id="pic_upload_multiimg">
                    ��������Ҫ Adobe Flash Player 10.0.0 ����߰汾
                    <script type="text/javascript">
                        var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
                        document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"
                        + pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
                    </script>
                </div>
            </div>
            <input type="button" name="button2" id="limit_pic_upload" value="" class="flup" style="display:none;">
            <span class="upload-arrow">�Ǳ������ϴ�3��</span>
            <span id="imagelisttemp" style="display: none;" class="attachpic">
                <b class="deleteimg" >ɾ��</b>
                <input type="hidden" name="imgselect[]" value="" disabled="true"/>
        </span>
            <div class="clearfix"></div>
            <div id="imglist" class="readyPic">
            </div>
        </dd>
    </dl>
    
</div>
<?php } else { ?>
<div class="rows-content row-color-6">
    <div class="commAttr">
        <i class="attrs-icon picture"></i>ͼƬ
    </div>
    <dl>
        <a href="http://www.8264.com/member.php?mod=logging&amp;action=login" class="d-login-jump">��¼����ϴ�ͼƬ</a>
    </dl>
</div>
<?php } ?>
                <!--end-----����ҳͼƬ�ϴ�-->
                <?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
                    <div class="rows-content row-color-6">
                        <div class="commAttr">
                            <i class="attrs-icon picture"></i>��֤��
                        </div>
                        <div class="attrForms">
                            <div class="issue-forms-group">
                                <input type="text" name="captcha" id="captcha" class="inputTxtShort borderEmbellish" style="width:50px;vertical-align: top;"/>
                                <a href="#" id="refreshCaptcha" title="���ˢ��ͼƬ"><img src="/plugin.php?id=dailypicture:captcha" alt="���ˢ��ͼƬ" /></a>
                                <input type="hidden" value="" id="yzm" name="yzm">
                                <span id="jg"></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="rows-content row-color-6">
                    <div class="attrForms">
                        <div class="issue-submit-group">
                            <input type="submit" name="submit" value="����" class="btn-issue" />
                            <!-- �ֻ�����ʾ -->
                            <?php if(!$_G['member']['telstatus']) { ?>
                            <style type="text/css">.tips-binding__inside{background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:4px 0 0 10px;font-size:14px;color:#585858}.tips-binding__inside a{color:#ff7038;font-size:14px}.tips-binding__inside a:hover{color:#ff7038;font-size:14px}</style>
                            <span class="tips-binding__inside">ע��д������������ֻ���<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">ȥ��>></a></span>
                            <?php } ?>
                            <!-- //�ֻ�����ʾ -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </form>
    </div>
    <!-- //comment public -->
</div>
<?php } } ?>
</div>
</div>
<!-- side bar -->
<div class="col-sider">
    <div class="ui-grid-2 ui-grid-right">
        <?php if($detail['lon'] && $detail['lat']) { ?>
        <style>
/*��ʱ��ŵ�ͼ��ʽ************************************************/
       /* ��ʾԭͼ��ť��ʼ*********************************/
     /* .ckdt {
            position: absolute;
            right: 0;
            top: 0;
        }
        .ckdt a {
            background: none repeat scroll 0 0 #000;
            color: #fff;
            display: block;
            font: 14px/28px "Microsoft Yahei";
            height: 28px;
            opacity: 0.7;
            text-align: center;
            width: 100px;
        }
        .popBox {
            display: none;
            position: fixed;
            _position: absolute;
            top: 10%;
            _top: expression(eval(document.documentElement.scrollTop));
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
        }*/
    /*��ʾԭͼ��ť����*********************************/
    /*��ͼ��ͼ���㿪ʼ**************************************************************/
    /*.popBox .w750 {
        width: 750px;
    }
    .popBox .bd {
        position: relative;
        width: 720px;
        margin: 135px auto 0;
        background: #FFF;
        border-radius: 3px;
    }
    .popGoogleMap {
        margin: 0 35px;
        padding: 30px 0 20px 0;
    }
    .popGoogleMap h2 {
        font: 22px/26px "Microsoft Yahei";
        color: #000;
        margin-bottom: 10px;
    }

    .bd .closeBtn {
        position: absolute;
        display: block;
        top: -14px;
        right: -16px;
        width: 40px;
        height: 40px;
        background: url(../../images/dianping/ski_sprite.png) no-repeat -150px -450px;
        text-indent: -9999px;
        cursor: pointer;
    }*/
    /*��ͼ��ͼ�������********************************************************************/

</style>
<div class="right-map-warpten">
    <div class="ui-block ui-block-title">
        <div class="ui-title ui-title-line">
            <h3>��ͼ</h3>
        </div>
    </div>
    <div class="ui-block ui-block-content">
        <div class="right-map-warpten">
            <div class="map">
                <!--show map start------------------------------------------------>
                <div class="bd">
                    <div class="box">
                        <div id="mapPoint" style="height: 270px;"></div>
                        <div class="ckdt"><a href="javascript:;" id="ckdtBtn">�鿴��ͼ</a></div>
                    </div>
                    <input type="hidden" value="" id="longitude" name="longitude">
                    <input type="hidden" value="" id="latitude" name="latitude">
                    <input type="hidden" value="<?php echo $detail['addr'];?>" id="sAddress" name="sAddress">
                    <!--<input type="hidden" value="<?php echo $detail['pro'];?>" id="pro" name="pro">-->
                    <input type="hidden" value="<?php echo $detail['tid'];?>" id="tid" name="tid">

                    <div class="mark"><span class="zs">ע����ͼλ�ñ�ע�����ο������������ʵ�ʵ�·��ʵ��ϢΪ׼</span></div>
                    <script src="http://api.map.baidu.com/api?v=1.3&services=true" type="text/javascript"></script>
                    <script type="text/javascript">
                        var long = <?php echo $detail['lon'];?>;
                        var lat = <?php echo $detail['lat'];?>;
                        var map = new BMap.Map("mapPoint");
                        var point = new BMap.Point(long, lat);
                        map.centerAndZoom(point, 15);
                        map.disableDoubleClickZoom(); // ����˫���Ŵ�
                        var opts = {type: BMAP_NAVIGATION_CONTROL_SMALL}
                        map.addControl(new BMap.NavigationControl(opts));
                        var marker = new BMap.Marker(point); // ������ע
                        map.addOverlay(marker); // ����ע��ӵ���ͼ��
                    </script>
                </div>
                <!--show map end------------------------------------------------->
            </div>
            <div class="info">ע����ͼλ�ñ�ע�����ο������������ʵ�ʵ�·��ʵ��ϢΪ׼</div>
        </div>
    </div>
</div>
<!--��ʱע�͵���ͼ�༭ҳ��start------------------------------------------------------------------->
<!--<div class="popBox" id="box_map">
    <div class="bd w750">
        <div class="popGoogleMap">
            <h2><?php echo $detail['name'];?></h2>
            <?php if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid'])&&($_G['groupid'] == 1))) { ?>
            <span id="bm_edit" style="cursor: pointer;">�޸ı�ע</span>
            <div id="bm_editbox" style="display: none;">
                <h3>��ַ��<?php echo $detail['newaddress'];?>��<span class="cBlue" id="bm_mark" style="cursor: pointer;">��ͼ�ϱ�ע</span>��</h3>
                <div class="searchMap">
                    <input type="text" class="textInput" id="bm_text" />
                    <input type="submit" class="searchBtn" value="" id="bm_search" />
                    <span class="tips">������ַ�����ĸ�ʽ���£�ʡ+����+����+�ֵ�<em class="emTop">��</em></span>
                </div>
            </div>
            <?php } ?>
            <div class="mapBox" id="popmap" style="height:400px;"></div>
        </div>
        <span class="closeBtn" id="bm_closeBtn">�ر�</span>
    </div>
</div>-->
<!--��ʱע�͵���ͼ�༭ҳ��end------------------------------------------------------------------->
<script style="text/javascript" >
    $('#ckdtBtn').click(function() {
        $("#div_black, #box_map").fadeIn(200);
        var long = <?php echo $detail['lon'];?>;
        var lat = <?php echo $detail['lat'];?>;
        var map = new BMap.Map("popmap");
        var point = new BMap.Point(long, lat);
        map.centerAndZoom(point, 15);
        map.disableDoubleClickZoom(); // ����˫���Ŵ�
        var opts = {type: BMAP_NAVIGATION_CONTROL_SMALL}
        map.addControl(new BMap.NavigationControl(opts));
        var marker = new BMap.Marker(point); // ������ע
        map.addOverlay(marker); // ����ע��ӵ���ͼ��

        $('#bm_edit').click(function(){
            map.enableScrollWheelZoom();
            marker.enableDragging(true); // ���ñ�ע����ק
            var opts = {
                width : 110,     // ��Ϣ���ڿ��
                height: 50,     // ��Ϣ���ڸ߶�
                title : "��ʾ��Ϣ"  // ��Ϣ���ڱ���
            }
            var infoWindow = new BMap.InfoWindow("�϶��˱�ע���ĵ���λ��", opts);  // ������Ϣ���ڶ���
            marker.addEventListener("mouseup", function(){
                var position = marker.getPosition();
                var t = confirm('�Ƿ���λ������Ϊ�˵��̵�Ĭ��λ�ã�');
                if(t==true){
                    marker.disableDragging(true); // ���ñ�ע������ק
                    marker.removeEventListener("mouseup");
                    $("#longitude").val(position['lng']);
                    $("#latitude").val(position['lat']);
                    $.get('forum.php?ctl=<?php echo $modstr;?>&act=editmap&tid='+tid,{lng:$("#longitude").val(), lat:$("#latitude").val()},function(){
                        showDialog("�����޸����ύ,ˢ��ҳ��ɿ�����Ч����","notice");
                        $('#bm_editbox, #div_black, #box_map').hide();
                        $('#bm_edit').show();
                        marker.closeInfoWindow(infoWindow);
                        map.disableScrollWheelZoom();
                    });
                }else{

                }
            });
            marker.openInfoWindow(infoWindow);
            $('#bm_editbox').show();
            $('#bm_edit').hide();
            //	showWindow('editmap','/plugin.php?id=skiing:editmap&tid='+tid+'&edit=1');
        });
    })
</script>

        <?php } ?>
    </div>

    <?php if($list) { ?>
    <div class="ui-grid-2 ui-grid-right">
        <!-- � -->
        <div class="right-hot-warpten">
            <div class="ui-block ui-block-title">
                <div class="ui-title ui-title-line">
                    <h3>TA�Ļ</h3>
<!--                    <div class="ui-title-link"><a href="http://u.8264.com/home-space-uid-<?php echo $detail['jids'];?>-do-ownactivity-type-orig.html" target="_brank">����</a></div>-->
                </div>
            </div>
            <div class="ui-block ui-block-content">
                <div class="common-list-box hot-list-box">
                    <ul class="hot-list">
                        <?php if(is_array($list)) foreach($list as $k => $item) { ?>                        <li>
                            <div class="imgbox">
                                <a href="http://bbs.8264.com/thread-<?php echo $item['tid'];?>-1-1.html" target="_brank">
                                    <img src="<?php echo $attachList[$item['aid']];?>" alt="">
                                </a>
                            </div>
                            <div class="list-bd">
                                <h3 class="ilist-bd-title">
                                    <a href="http://bbs.8264.com/thread-<?php echo $item['tid'];?>-1-1.html" target="_brank" title="<?php echo $item['subject'];?>" class="<?php if($k<1) { ?>blue<?php } elseif($k<3) { ?>orange<?php } ?>"><?php echo cutstr($item['subject'],45,''); ?>                                    </a>
                                </h3>
                                <div class="rating-level small-rating hot-rating">
                                    <span style="margin-top:5px;">
                                        <?php $starttimefrom = date('Y-m-d', $item[starttimefrom]); ?>                                        <?php if($item['starttimeto']) { ?><?php echo $starttimefrom;?> �� <?php echo date('Y-m-d', $item[starttimeto]) ?> <?php } else { ?><?php echo $starttimefrom;?><?php } ?>
                                    </span>
                                </div>
                            </div>
                        </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
        <!-- //� -->
    </div>
    <?php } ?>





    <?php if($sidebar_list_hot) { ?>
    <div class="ui-grid-2 ui-grid-right">
        <!-- HOT -->
        <div class="right-hot-warpten">
            <div class="ui-block ui-block-title">
                <div class="ui-title ui-title-line">
                    <h3>����</h3>
                    <div class="ui-title-link"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=heats&amp;provinceid=0&amp;cityid=0&amp;page=1" target="_brank">����</a></div>
                </div>
            </div>
            <div class="ui-block ui-block-content">
                <div class="common-list-box hot-list-box">
                    <ul class="hot-list">
                        <?php if(is_array($sidebar_list_hot)) foreach($sidebar_list_hot as $k => $item) { ?>                        <li>
                            <div class="imgbox"><a href="dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $item['tid'];?>"><img src="<?php echo getimagethumb(60,60,2, $item['dir'].'/'.$item['showimg'], 0, $item['serverid']); ?>" alt=""></a></div>
                            <div class="list-bd">
                                <h3 class="ilist-bd-title"><a href="dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $item['tid'];?>" class="<?php if($k<1) { ?>blue<?php } elseif($k<3) { ?>orange<?php } ?>"><?php echo cutstr($item['subject'],18,''); ?></a></h3>
                                <div class="rating-level small-rating hot-rating">
                                    <span class="score-value score-value-<?php echo floor($item['score']); ?>">
                                        <em></em>
                                    </span>
                                    <strong><?php echo $item['score'];?></strong>
                                </div>
                                <span class="comm-num"><i class="ui-icon icon-comm"></i><?php if($item['cnum']) { ?><?php echo $item['cnum'];?><?php } else { ?>0<?php } ?>�˲������</span>
                                <span class="fire <?php if($k<1) { ?>orange<?php } elseif($k<3) { ?>blue<?php } ?>"></span>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- //HOT -->
    </div>
    <?php } ?>
    <?php if($sidebar_list_same) { ?>
    <div class="ui-grid-2 ui-grid-right">
        <div class="right-same-area-warpten">
            <div class="ui-block ui-block-title">
                <div class="ui-title ui-title-line">
                    <h3>ͬ����</h3>
                    <div class="ui-title-link"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist&amp;order=lastpost&amp;provinceid=<?php echo $detail['provinceid'];?>&amp;cityid=0&amp;page=1" target="_brank">����</a></div>
                </div>
            </div>
            <div class="ui-block ui-block-content">
                <div class="right-same-area-box">
                    <ul class="right-same-area">
                        <?php if(is_array($sidebar_list_same)) foreach($sidebar_list_same as $k => $item) { ?>                        <li>
                            <h3 class="wlist-bd-title"><a href="dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $item['tid'];?>" class="<?php if($k<1) { ?>orange<?php } elseif($k<3) { ?>blue<?php } ?>"><?php echo cutstr($item['subject'],18,''); ?></a></h3>
                            <div class="rating-level small-rating same-rating">
                                                <span class="score-value score-value-<?php echo floor($item['score']); ?>" title="<?php echo floor($item['score']); ?>��">
                                                    <em></em>
                                                </span>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>


    <!-- ���뿪ʼ -->
    <div class="ui-grid-2 ui-grid-right">
    </div>
    <!-- ������� -->

    <!-- ���뿪ʼ -->
    <div class="ui-grid-2 ui-grid-right">
    </div>
    <!-- ������� -->

    <!-- ���뿪ʼ -->
    <div class="ui-grid-2 ui-grid-right">
    </div>
    <!-- ������� -->
</div>
<!-- //side bar -->
</div>
</div>
</div>

<style>
.bbsfoothotlist{ background: #1a2b38; color: #ffffff; padding-bottom:45px;}
.topHill{  background:url(http://static.8264.com/static/image/common/bg_fourm_sprite.png) no-repeat 0 0; height: 16px;left: 0; position: relative; text-indent: -9999px; top: -16px; width: 175px}
</style>

<div class="bbsfoothotlist">
<div class="module">
<div class="topHill">����Сɽ</div>
</div>
<div class="choiceness">
        <?php block_display('6905'); ?></div>
</div>

<div class="friendLink">
    <?php block_display('7012'); ?></div>
<script>
    (function($){
        $(function(){
            //��ӵ���
            $('#postform').submit(function(event){

                event.preventDefault();
                var starnum = $("#postform .starnum").val();
                var goodpoint = $.trim($("#postform #goodpoint").val());
                var weakpoint = $.trim($("#postform #weakpoint").val());
                var message = $.trim($("#postform #message").val());

                //form����ʼ����֤����ж�����֤
                if(starnum == 0){
                    $("#starnumTip").show();
                }
                if(weakpoint.length<5 || goodpoint.length <5 || message.length <5 || starnum == 0){
                    return false;
                }
                <?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
                if (trim($("#postform #captcha").val())=="") {
                    showDialog('��֤�벻��Ϊ��');
                    return false;
                }
                if (trim($("#postform #yzm").val())=='0') {
                    showDialog('��֤���������');
                    return false;
                }
                <?php } ?>
                 //��ֹ�����ύ
                $(":submit",this).attr("disabled","disabled");
                //ͼƬaid��ȡ
                var imgselect = new Array();
                $($("input[name='imgselect[]']:not(:disabled)")).each(function(){
                    imgselect.push($(this).val());
                });
                var postUrll='http://www.8264.com/dianping.php?mod=misc&act=dopost&model=<?php echo $mod;?>&do=newsave&tid=<?php echo $detail['tid'];?>';
                var stararray=['�ܲ�','�ϲ�','����','�Ƽ�','����'];
                $.post(postUrll,{starnum:starnum,goodpoint:goodpoint,weakpoint:weakpoint,message:message,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes',imgselect:imgselect},
                        function(data){
                            if(data == '-1'){
                                alert('����Ҫ��½���������');
                                window.location.href = 'http://www.8264.com/member.php?mod=logging&action=login';
                                return false;
                            }else if(data){
                                $('#mycomment').show();
                                $('#mycomment').html(data);
                                $('#postform').parent('.write-comment-box').remove();
                                $(document).scrollTop($('#mycomment').offset().top-60);
                            }
                        });
            });
            //�޸ĵ���
            $('#editform').submit(function(event){
                event.preventDefault();
                var starnum = $("#editform .starnum").val();
                var goodpoint = $.trim($("#editform #goodpoint_e").val());
                var weakpoint = $.trim($("#editform #weakpoint_e").val());
                var message = $.trim($("#editform #message_e").val());

                //form����ʼ����֤����ж�����֤
                if(starnum == 0){
                    $("#starnumTip").show();
                }
                if(weakpoint.length<10 || goodpoint.length <10 || message.length <10 || starnum == 0){
                    return false;
                }
                //ͼƬaid��ȡ
                var imgselect = new Array();
                $($("input[name='imgselect[]']:not(:disabled)")).each(function(){
                    imgselect.push($(this).val());
                });
                var pid = $("#editform #pid").val();
                var postUrll='http://www.8264.com/dianping.php?mod=misc&act=dopost&model=<?php echo $mod;?>&do=editsave&tid=<?php echo $detail['tid'];?>';
                var stararray=['�ܲ�','�ϲ�','����','�Ƽ�','����'];
                $.post(postUrll,{starnum:starnum,goodpoint:goodpoint,pid:pid,weakpoint:weakpoint,message:message,formhash:'<?php echo FORMHASH;?>',replypostsubmit:'yes',imgselect:imgselect},
                        function(data){
                            if(data == '-2'){
                                alert('�޸�ʧ��');
                                $('#overlay').remove();
                                $('#edithtml .editinput').val('');
                                $('#edithtml').hide();
                                return false;
                            }else if(data){
                                $('#post_'+pid).html(data);
                                $('#overlay').remove();
                                $('#edithtml .editinput').val('');
                                $('#edithtml').hide();
                            }
                        });
            });
            $(".stars1 a").click(function(){
                var starnum = $(this).attr('value');
                var title   = $(this).attr('title');
                $('.stars1 li a').removeClass('current-star-rating');
                $(this).addClass('current-star-rating');
                $('.starnum').val(starnum);
                $("#starnumTip").hide();
                $(this).parents('ul').siblings('.stars1-tips').html(title);
            });
            //��ȡ�޸�
            $(".comment-main").delegate(".editclick","click",function(){
                var pid = $(this).attr('id');
                var url = 'http://www.8264.com/dianping.php?mod=misc&act=dopost&do=editpost';
                var tid =  <?php echo $detail['tid'];?>;

                $.ajax({
                    type: "GET",
                    url: url,
                    data: {pid:pid,tid:tid},
                    dataType: "json",
                    success: function(data){
                        $('#editform #weakpoint_e').val((data['weakpoint']));
                        $('#editform #goodpoint_e').val(data['goodpoint']);
                        $('#editform #message_e').val(data['message']);
                        $('#editform #pid').val(pid);
                        $('#editform .starnum').val(data['starnum']);
                        $('#editform #star_'+data['starnum']+'_e').addClass('current-star-rating');

                        if(typeof (data['attachlist']) == "object"){
                            //ͼƬ����
                            var str = '';
                            $.each(data['attachlist'],function(i,v){
                                str += "<span class=\"attachpic\"  id=\"image_"+ v.aid+"\">";
                                str += "<img width=60 height=60 src=\"http://image1.8264.com/plugin/"+ v.attachment+"\">";
                                str += "<b class=\"deleteimg\">ɾ��</b>";
                                str += "<input type=\"hidden\" value=\""+ v.aid+"\" name=\"imgselect[]\">";
                                str += "</span>";
                            });
                            $("#imglist_e").html(str);
                        }else{
                            $("#imglist_e").empty();
                        }
                    }
                });

                easyDialog.open({
                    container : 'edithtml'
                });

                /*start----�༭ҳͼƬ�ϴ�֮flash��ʼ��*/
                var params = {site:"http://www.8264.com/misc.php%3fmod=swfupload%26type=image%26fid=<?php echo $fid;?>%26mtype=plugin%26twidth=60%26theight=60%26random="+Math.random()+"%26back=upload_image_success_e",buttonimg:"http://static.8264.com/dianping/images/icon/data/uploadnew.png"};
                swfobject.embedSWF("http://www.8264.com/static/flash/uploadforum.swf", "pic_upload_multiimg_e", "160", "45", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
                swfobject.createCSS("#pic_upload_multiimg_e", "text-align:left;");
                /*end----�༭ҳͼƬ�ϴ�֮flash��ʼ��*/

            });

            //ͼƬ�ϴ�֮ɾ������
            $(".row-color-6").on("click", ".deleteimg", function() {
                $(this).parent().remove();
                if($("#imglist .overlimit").length > 0){
                    $("#imglist .overlimit:first").removeClass('overlimit').find('input:hidden').removeAttr('disabled');
                }else{
                    $("#numimage").val($("#numimage").val() - 1);
                }
            });
        });
    })(jQuery);
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $.formValidator.initConfig({
            formID: "postform",
            debug: false,
            submitOnce: false,
            onError:function(msg,obj,errorlist){
            }
        });
        //�ۺ�
        $('#message').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д�ÿ�ջ���ۺ����ۡ�</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 10,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ÿ�ջ���ۺ����ۣ���������10���ַ���</span></div>'
        });
        //ȱ��
        $('#weakpoint').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д�ÿ�ջ�Ĳ���֮����</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 10,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ÿ�ջ�Ĳ���֮������������10���ַ���</span></div>'
        });
        //�ŵ�
        $('#goodpoint').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д�ÿ�ջ���ŵ�</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 10,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ÿ�ջ���ŵ㣬��������10���ַ�</span></div>'
        });

        /*�޸�ҳ�潻��*/
        //�ۺ�
        $('#message_e').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д�ÿ�ջ���ۺ����ۡ�</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 10,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ÿ�ջ���ۺ����ۣ���������10���ַ���</span></div>'
        });
        //ȱ��
        $('#weakpoint_e').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д�ÿ�ջ�Ĳ���֮����</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 10,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ÿ�ջ�Ĳ���֮������������10���ַ���</span></div>'
        });
        //�ŵ�
        $('#goodpoint_e').formValidator({
            onShow: '',
            onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д�ÿ�ջ���ŵ�</span></div>',
            onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
            defaultValue: ""
        }).inputValidator({
            min: 10,
            empty:false,
            onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ÿ�ջ���ŵ㣬��������10���ַ�</span></div>'
        });
    });
    <?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
    //��֤��
    jQuery('#refreshCaptcha').click(function() {
        jQuery(this).children('img').attr('src', '/plugin.php?id=dailypicture:captcha&_='+(new Date().getTime()));
        jQuery('#jg').html("");
        return false;
    });
    jQuery('#captcha').blur(function(){
         validate_captcha();
         return false;
    });
    function validate_captcha() {
        jQuery.ajax({
            async: false,
            type: 'get',
            url: '/plugin.php?id=dailypicture:validatecaptcha&captcha='+jQuery('#captcha').val(),
            success : function(data) {
                if (data==1) {
                    jQuery('#jg').html("");
                    jQuery('#jg').append('<img width="16" height="16" class="vm" src="static/image/common/check_right.gif">');
                    jQuery('#yzm').val('1');
                }else{
                    jQuery('#jg').html("");
                    jQuery('#jg').append('<img width="16" height="16" class="vm" src="static/image/common/check_error.gif">');
                    jQuery('#yzm').val('0');
                    //jQuery('#captcha').val('');
                }
            }
        });
    };
    <?php } ?>
</script><?php if($act=='showview') { ?>
<script src="http://static.8264.com/static/js/dianping/showview.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script>
<?php if($_G['adminid']==1) { ?><script src="http://static.8264.com/static/js/dianping/manage.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script><?php } } ?><style>
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
<?php if($act=='showview') { ?>
<li><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $tid;?>" id="m_k_favorite" onclick="showWindow(<?php if($_G['uid']) { ?>this.id, this.href, 'get', 0<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>);" class="sc"><b style="display: none;" id="favoritenumber"></b></a></li>
<?php } ?>
<li><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showlist" class="bbsli" title="����<?php echo $dp_modules[$mod]['cname'];?>��ҳ"></a></li>
<li id="gotop_50"><a  href="javascript:;" class="gotop_50"></a></li>
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
if($(window).scrollTop() > 10){$("#gotop_50").show();}	
$(window).scroll( function(){
if($(window).scrollTop()>10){
$("#gotop_50").show();
}else{
$("#gotop_50").hide();	
}
});
$("#gotop_50").click(function(){ 
$("html,body").animate({ scrollTop: 0 },500);
});		
})(jQuery);
</script>
<script type="text/javascript"> 
document.body.onselectstart=function(){ return false;}
</script><style type="text/css">
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
</script><?php dp_output(); ?></div>
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