<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('cal', 'common/header_8264');
0
|| checktplrefresh('./source/plugin/forumoption/template/cal.htm', './template/8264/common/header_8264.htm', 1502930105, 'forumoption', './data/template/2_forumoption_cal.tpl.php', './source/plugin/forumoption/template', 'cal')
|| checktplrefresh('./source/plugin/forumoption/template/cal.htm', './template/8264/common/nav_8264_top.htm', 1502930105, 'forumoption', './data/template/2_forumoption_cal.tpl.php', './source/plugin/forumoption/template', 'cal')
|| checktplrefresh('./source/plugin/forumoption/template/cal.htm', './template/8264/common/nav_8264_jian.htm', 1502930105, 'forumoption', './data/template/2_forumoption_cal.tpl.php', './source/plugin/forumoption/template', 'cal')
|| checktplrefresh('./source/plugin/forumoption/template/cal.htm', './template/8264/common/footer_8264lw.htm', 1502930105, 'forumoption', './data/template/2_forumoption_cal.tpl.php', './source/plugin/forumoption/template', 'cal')
|| checktplrefresh('./source/plugin/forumoption/template/cal.htm', './template/8264/common/header_common.htm', 1502930105, 'forumoption', './data/template/2_forumoption_cal.tpl.php', './source/plugin/forumoption/template', 'cal')
|| checktplrefresh('./source/plugin/forumoption/template/cal.htm', './template/8264/common/panel_8264.htm', 1502930105, 'forumoption', './data/template/2_forumoption_cal.tpl.php', './source/plugin/forumoption/template', 'cal')
|| checktplrefresh('./source/plugin/forumoption/template/cal.htm', './template/8264/common/footerCopyRight.htm', 1502930105, 'forumoption', './data/template/2_forumoption_cal.tpl.php', './source/plugin/forumoption/template', 'cal')
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
    <?php if(!empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
   		<link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_widthauto.css?<?php echo VERHASH;?>" />
    	<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
    <?php } ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'portal') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/template/8264/css/common/reset.css" />
<link rel="stylesheet" type="text/css" href="/template/8264/css/common/new_common.css" />
<?php } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_css_diy.css?<?php echo VERHASH;?>" />
<?php } ?>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript" type="text/javascript"></script>
<script>jQuery.noConflict();</script>
<!--[if IE 6]>
<script src="/template/8264/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="/template/8264/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?49299785f8cc72bacc96c9a5109227da";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="�� DIY ���"><img src="http://static.8264.com/static/image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
    <?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
    <?php include template('common/header_diy'); ?>    <?php } ?>
    <?php if(empty($topic) || $topic['useheader']) { ?>
    <?php echo adshow("headerbanner/wp a_h"); ?>    
    <?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; ?>
    <?php } ?>
<div id="wp" class="wp">
<link rel="stylesheet" type="text/css" href="/template/8264/css/common/reset.css" />
<link rel="stylesheet" type="text/css" href="/template/8264/css/common/new_common.css" />
<link rel="stylesheet" href="/source/plugin/skiing/css/reset.css?v=1" />
<link rel="stylesheet" href="/source/plugin/skiing/css/style.css?v=1" /><div class="top1">
<div class="nav960 clearfix" style="font-size:12px;">
<div class="top1_l">
<ul>
<li><a href="javascript:void(0)" class="top1_la">������Ŀ</a>
<div class="nav_xl top1_lxl xiangm"> <a href="http://www.8264.com/list/842" target="_blank" class="red">ÿ��һͼ</a> <a href="http://www.8264.com/pp/" target="_blank" class="lan">���õ��</a> <a href="http://www.8264.com/list/881" target="_blank" class="lv">��·�Ƽ�</a> <a href="http://www.8264.com/list/880" target="_blank" class="huang">��������</a> <a href="http://www.8264.com/zhuangbei" target="_blank" class="red">װ���Ƽ�</a> </div>
</li>
<li><a href="javascript:void(0)"class="top1_la">������Ŀ</a>
<div class="nav_xl top1_lxl xiangm"> <a href="http://www.8264.com/topic/1458.html" target="_blank"class="lan">¶Ӫ���</a> <a href="http://www.8264.com/topic/1500.html" target="_blank"class="lv">��ѩ����</a> </div>
</li>
<li><a href="http://www.8264.com/app/"class="top1_la_1">8264�ֻ���</a></li>
</ul>
</div>
<div class="top1_r clearfix"><?php if($_G['uid']) { ?>

<strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="vwmy" target="_blank" title="�����ҵĿռ�"><?php echo $_G['member']['username'];?></a></strong>



<?php if($_G['group']['allowinvisible']) { ?>
<span id="loginstatus" class="">
<a href="member.php?mod=switchstatus" title="�л�����״̬" onClick="ajaxget(this.href, 'loginstatus');doane(event);">
<?php if($_G['session']['invisible']) { ?>
����
<?php } else { ?>
����
<?php } ?>
</a>
</span>
<?php } ?>


 <a href="home.php?mod=space&amp;do=friend">����</a> 


<?php if($_G['setting']['regstatus'] > 1) { ?>
<a href="home.php?mod=spacecp&amp;ac=invite" class="">����</a> 
<?php } ?>


 <span id="usersetup" class="showmenu" onMouseOver="showMenu(this.id);">
<a href="home.php?mod=spacecp">����</a>
</span>


 <a href="home.php?mod=space&amp;do=notice" id="myprompt"<?php if($_G['member']['newprompt']) { ?> class="new"<?php } ?>>����
<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?>
</a><span id="myprompt_check"></span>



 <a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>����Ϣ
<?php if($_G['member']['newpm']) { ?>(<?php echo $_G['member']['newpm'];?>)<?php } ?></a>




<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?>
 <a href="portal.php?mod=portalcp">�Ż�����</a>
<?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
 <a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>����</a>
<?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?>
 <a href="admin.php" target="_blank">��������</a>
<?php } ?>




 <a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">�˳�</a>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<strong><a id="loginuser"><?php echo $_G['cookie']['loginuser'];?></a></strong>


 
<a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">����</a>


 <a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">�˳�</a>


<?php } else { ?>
<a href="http://bbs.8264.com/connect.php?method=sina&amp;action=login&amp;op=init" class="log_wb">΢����½</a>
<a href="http://bbs.8264.com/connect-login-op-init-referer-index.php-statfrom-login_simple.html" class="log_qq">QQ��½</a>
<div style=" float:right;">
<a>��ӭ����8264!</a>
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href);hideWindow('login');"><?php echo $_G['setting']['reglinkname'];?></a>
<a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">��¼</a></div>

<?php } ?>

</div>
</div>
</div>
<!--���ͷ������ʼ-->
<div class="top2">
<div class="nav960 clearfix">
    <div class="top2_l"><a href="http://www.8264.com/"><img src="/template/8264/css/moban/1024newslw/images/8264_logo.png" /></a></div>
    <div class="top2_r">
        <ul>
            <li><a href="http://www.8264.com/" style="background:none">��ҳ</a></li>
            <li><a href="http://www.8264.com/list/201/">��Ѷ</a>
                <div class="nav_xl" style="width:115px;">
                    <div class="zx"><a href="http://www.8264.com/list/204/" >װ��</a><a href="http://dengshan.8264.com/" >��ɽ</a><a href="http://www.8264.com/list/751/" >��ҵ</a><a href="http://www.8264.com/list/238/" >֪ʶ</a><a href="http://www.8264.com/list/232/" >����</a><a href="http://www.8264.com/list/746/" >ר��</a><a href="http://www.8264.com/topic_list/" >ר��</a></div>
                 </div>
            </li>
            <li><a href="http://www.8264.com/pinpai" >Ʒ��</a>
                <div class="nav_xl">
                    <div class="sy"><a href="http://bbs.8264.com/forum-459-1.html" >��&nbsp;&nbsp;&nbsp;Ƹ</a><a href="http://www.8264.com/dianpu" >��&nbsp;&nbsp;&nbsp;��</a></div>
                 </div>
            </li>
            <li><a href="http://bbs.8264.com/forum-433-1.html" >Ŀ�ĵ�</a>
                <div class="nav_xl" style="width:130px;">
                     <div class="cx"><a href="http://yueban.com/" >Լ��</a> <a href="/ditu/" >��ͼ</a> <a href="http://www.8264.com/xuechang" >��ѩ��</a> <a href="http://u.8264.com/home-space-do-activity-view-all-order-hot-date-default-class.html" >�</a> <a href="http://bbs.8264.com/forum-392-1.html" >ɽ��</a> <a href="http://bbs.8264.com/forum-440-1.html" >��&nbsp;&nbsp;&nbsp;��</a> <a href="http://bx.8264.com/?bbsbxnew" >����</a> <a href="http://www.8264.com/list/881" >����</a> </div>
                 </div>
            </li>
            <li><a href="http://www.7jia2.com/" >�̳�</a>
                <div class="nav_xl">
                    <div class="zb"> <a href="http://tuan.7jia2.com/?from=8264daohang" >��&nbsp;&nbsp;&nbsp;��</a> <a href="http://tmh.7jia2.com/?from=8264daohang" >������</a></div>
                 </div>
            </li>
            <li><a href="http://bbs.8264.com/" >¿����̳</a>
                <div class="nav_xl">
                    <div class="sq"><a href="http://u.8264.com/" >¿��¼</a> <a href="http://www.8264.com/list/871/" >��&nbsp;&nbsp;&nbsp;ѡ</a> </div>
                 </div>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
    </div>
</div>
<!--���ͷ��������--><link href="/source/plugin/whither/css/qdzs.css?c=2" rel="stylesheet" type="text/css" />
<div class="q_w_title">
<h2 class="biaotititle">8264ͽ����·������ϵ</h2>
    <p class="w_q_infor">8264ͽ����·<span class="q_bule">ǿ��ָ��</span>��<span class="w_red">Σ�ն�ָ��</span>�ǻ���ͽ����Խ�г������¡����Ρ�ʱ��������ۺ϶����һ�ײ�����׼������Ϊ������·ǿ�Ⱥ�Σ�նȵĲο���������ΪΨһ���ݡ�</p>
    </div>
<!--ǿ�ȿ�ʼ-->
<div class="mid_qw qd">
        <h3><img src="/source/plugin/whither/css/image/q_banner.jpg"/></h3>
        <div>
          <table border="0" cellspacing="0" cellpadding="0" class="table_form">
              <form id="pic-pub-form" name="form1" method="post" action="">
              <tr>
                  <th><b class="b_red">*</b>ʱ�䣺</th>
                  <td>
                  <select name="times" id="times">								
                      <option value="1">1-2��</option>
                      <option value="1.5">3��</option>
                      <option value="2.5">4-5��</option>
                      <option value="3">6-7��</option>
                      <option value="5">8-10��</option>
                      <option value="6.5">11-15��</option>
                      <option value="7.5">16-20��</option>
                      <option value="9">21-30��</option>
                      <option value="10">31������</option>
                  </select>���죩<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="��ͽ����㿪ʼ����ͽ���յ�Ϊֹ���������������г�����Ҫ��ʱ�䡣����Ϊ��λ��" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_0">
                  </td>
              </tr>
              <tr>
                  <th><b class="b_red">*</b>��ʼ���أ�</th>
                  <td>
                   <select name="endure" id="endure">								
                      <option value="1"><5</option>
                      <option value="1.5">5-10</option>
                      <option value="2">11-15</option>
                      <option value="2.5">16-20</option>
                      <option value="3">21-25</option>
                      <option value="4">26-35</option>
                      <option value="5">>35</option>			
                    </select>��Kg��<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="������װ�������£������������������ͼ��˷�������װ��������ͽ���߶�������������������װ��������¡�ͽ���г̿�ʼʱ��ͽ�������ϱ�����װ�ߡ�װ���������������ܺ͡������������ڱ�����˯���������棬����ʳƷ��ˮ�������������������ϴ������װ�������������ϴ�ĵ�������ȡ���KgΪ������" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_1">
                  </td>
              </tr>
              <tr>
                  <th><b class="b_red">*</b>�վ��г̣�</th>
                  <td>
                   <select name="distance" id="distance">								
                      <option value="1"><=10</option>
                      <option value="2">11-15</option>
                      <option value="3.5">16-20</option>
                      <option value="4.5">21-25</option>
                      <option value="5">25+</option>									
                   </select>��Km��<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="������ͽ����Խ�г��У�ƽ��ÿ����ɵ���·��ˮƽ���룬�Թ��Km��Ϊ��λ��" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_4">
                  </td>
              </tr>
              <tr>
                  <th><b class="b_red">*</b>�վ���ֱ�г̣�</th>
                  <td>
                  <select name="verticality" id="verticality">								
                      <option value="1"><=700</option>
                      <option value="2">700-1200</option>
                      <option value="3">1200-2000</option>
                      <option value="4">2000-3000</option>
                      <option value="5">>3000</option>									
                  </select>��m��<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="������ͽ����Խ�г��У�ƽ��ÿ����ɵ���·�Ĵ�ֱ����֮�ͣ���ֵΪ����������½�����֮�ͣ������������г̺��½��г̲����������ף�m��Ϊ��λ��" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_2">
                  </td>
              </tr>
              <tr>
                  <th><b class="b_red">*</b>����ָ����</th>
                  <td>
                  <select name="supply" id="supply">								
                      <option value="0.5">10+</option>
                      <option value="0.7">7-10</option>
                      <option value="0.8">5-6</option>
                      <option value="0.9">1-4</option>
                      <option value="1.5">��</option>									
                  </select>���Σ�<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="��λΪ�Σ�ָ��ͽ����㿪ʼ��ͽ���յ�Ϊֹ����Ԥ���н���·�Ͽ���ȷ�ϵĹ̶������㣨����ֵ�أ����Բ����˹��Ƴ�Ʒʳ��Ͳ���װ���Ĳ����㣩������������" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_3">
                  </td>
              </tr>
              <tr>
                  <th>&nbsp;</th>
                  <td><input type="submit" name="button" id="button" value="" class="q_t" /></td>
              </tr>
              </form>
          </table>
          <div class="dycon">
ǿ��ָ�����������˸���·ͽ����Խ�ļ��ڣ��������õ�״̬�£���ɸô�Խ��·�����ܵ�ǿ�ȡ�ͬʱҲ�����ڲ����Լ����ڼ��ڴ�Խ��ǿ��</div>
          <div style="clear:both"></div>
        </div>
        <div class="fengping_q"></div>
        <!--ǿ�Ƚ����ʼ-->
        <div class="jieguo" id="qd">
          <span class="close"></span>
          <h4>Σ�ն�ָ��</h4>
          <p>0.5</p>
        </div>
        <!--ǿ�Ƚ������-->
    </div>
    <!--ǿ�Ƚ���-->
    
<!--Σ�տ�ʼ-->
    <div class="mid_qw wx">
        <h3><img src="/source/plugin/whither/css/image//w_banner.jpg"/></h3>
        <div>
            <table border="0" cellspacing="0" cellpadding="0" class="table_form">
                <form id="pic-pub-form1" name="form2" method="post" action="">
                <tr>
                    <th><b class="b_red">*</b>���£�</th>
                    <td><?php $arr=array(50,49,48,47,46,45,44,43,42,41,40,39,38,37,36,35,34,33,32,31,30,29,28,27,26,25,24,23,22,21,20,19,18,17,16,15,14,13,12,11,10,9,8,7,6,5,4,3,2,1,0,-1,-2,-3,-4,-5,-6,-7,-8,-9,-10,-11,-12,-13,-14,-15,-16,-17,-18,-19,-20,-21,-22,-23,-24,-25,-26,-27,-28,-29,-30,-31,-32,-33,-34,-35,-36,-37,-38,-39,-40); ?><select name="lowtemperature" id="lowtemperature">								
 <option value="">��ѡ���������</option>								
 <?php if(is_array($arr)) foreach($arr as $ar) { ?> <option value="<?php echo $ar;?>"><?php echo $ar;?></option>
 <?php } ?>											
</select>�����϶ȣ�
                        <select name="highttemperature" id="highttemperature">								
<option value="">��ѡ���������</option><?php if(is_array($arr)) foreach($arr as $ar) { ?><option value="<?php echo $ar;?>"><?php echo $ar;?></option>
<?php } ?>		
</select>�����϶ȣ�&nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="��ͽ���г̿�ʼ��������������������¶Ⱥ�����¶ȡ�����¶�Խ���Ѷ�Խ�󣬶��г�Ӱ��Խ��;����¶�Խ���Ѷ�Խ�󣬶��г�Ӱ��Խ��;�²�Խ�󣬶��г�Ӱ��Խ��" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_10">
                    </td>
                </tr>
                <tr>
                    <th>��ˮ�����</th>
                    <td>
                        <select name="avgrain" id="avgrain">								
 <option value="0">��ѡ��ƽ����ˮ�̶�</option>
 <option value="1.1">С��</option>
 <option value="1.5">����</option>
 <option value="2">����</option>
 <option value="3">����</option>
 <option value="5">����</option>
 <option value="1.1">Сѩ</option>
 <option value="1.3">��ѩ</option>
 <option value="1.8">��ѩ</option>
 <option value="3">��ѩ</option>
 <option value="1.1">����</option>
 <option value="1.5">��</option>
 <option value="1.8">����</option>
 <option value="2.2">Ũ��</option>
 <option value="3">ǿŨ��</option>
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="badrain" id="badrain">								
 <option value="0">��ѡ������ӽ�ˮ�̶�</option>
 <option value="1.1">С��</option>
 <option value="1.5">����</option>
 <option value="2">����</option>
 <option value="3">����</option>
 <option value="5">����</option>
 <option value="1.1">Сѩ</option>
 <option value="1.3">��ѩ</option>
 <option value="1.8">��ѩ</option>
 <option value="3">��ѩ</option>
 <option value="1.1">����</option>
 <option value="1.5">��</option>
 <option value="1.8">����</option>
 <option value="2.2">Ũ��</option>
 <option value="3">ǿŨ��</option>							
</select>&nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="��ʾ��ˮ��ͽ���г̵�Ӱ�죬����г����޽�ˮ����г���Ӱ�졣" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_11">
                    </td>
                </tr>
               
                <tr>
                    <th><b class="b_red">*</b>���Σ�</th>
                    <td>
                   <select name="landform" id="landform">								
 <option value="1.0">1.0</option>
 <option value="1.1">1.1</option>
 <option value="1.2">1.2</option>
 <option value="1.3">1.3</option>
 <option value="1.4">1.4</option>
 <option value="1.5">1.5</option>
 <option value="1.6">1.6</option>
 <option value="1.7">1.7</option>
 <option value="1.8">1.8</option>
 <option value="1.9">1.9</option>
 <option value="2.0">2.0</option>
 <option value="2.1">2.1</option>
 <option value="2.2">2.2</option>
 <option value="2.3">2.3</option>
 <option value="2.4">2.4</option>
 <option value="2.5">2.5</option>
 <option value="2.6">2.6</option>
 <option value="2.7">2.7</option>
 <option value="2.8">2.8</option>
 <option value="2.9">2.9</option>
 <option value="3.0">3.0</option>
 <option value="3.1">3.1</option>
 <option value="3.2">3.2</option>
 <option value="3.3">3.3</option>
 <option value="3.4">3.4</option>
 <option value="3.5">3.5</option>
 <option value="3.6">3.6</option>
 <option value="3.7">3.7</option>
 <option value="3.8">3.8</option>
 <option value="3.9">3.9</option>
 <option value="4.0">4.0</option>
 <option value="4.1">4.1</option>
 <option value="4.2">4.2</option>
 <option value="4.3">4.3</option>
 <option value="4.4">4.4</option>
 <option value="4.5">4.5</option>
 <option value="4.6">4.6</option>
 <option value="4.7">4.7</option>
 <option value="4.8">4.8</option>
 <option value="4.9">4.9</option>
 <option value="5.0">5.0</option>
</select> &nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="Σ�նȣ�ƽ����1.0��·��Ϊƽ̹��ʵ���棬Ħ��ϵ����С�ڸ���ɰʯ·��5.0Ϊ�����������ı����ſ�ͨ���ĵ�·��" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_12">
                    </td>
                </tr>
          
                <tr>
                    <th>ˮ�£�</th>
                    <td>
                       <select name="watertemp" id="watertemp">								
 <option value="0">��ѡ��ƽ��ˮ��</option>
 <option value="1.8">0-10(0��=ƽ��ˮ�£�=10)</option>
 <option value="1.3">10-20(10��ƽ��ˮ�£�=20)</option>
 <option value="1.5">20-35(20��ƽ��ˮ�£�=35)</option>
 <option value="1.6">35-50(35��ƽ��ˮ�£�=50)</option>								
</select>�����϶ȣ�
                        <select name="badtemp" id="badtemp">								
 <option value="0">��ѡ�������ˮ��</option>
 <option value="1.8">0-10(0��=����ˮ�£�=10)</option>
 <option value="1.3">10-20(10������ˮ�£�=20)</option>
 <option value="1.5">20-35(20������ˮ�£�=35)</option>
 <option value="1.6">35-50(35������ˮ�£�=50)</option>									
</select>�����϶ȣ�&nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="������Ҫ��ˮ���ӵ���·��ˮ��Խ�͡�ˮ��Խ������Խ�ߣ�����·�г̵�Ӱ��Խ��" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_13">
                  </td>
                </tr>
                <tr>
                    <th>��ȣ�</th>
                    <td>
                        <select name="avgdeep" id="avgdeep">
 <option value="0">��ѡ��ƽ�����</option>
 <option value="1.1">10��������</option>
 <option value="1.3">10-20(10��ƽ����ȣ�=20)</option>
 <option value="1.4">20-40(20��ƽ����ȣ�=40)</option>
 <option value="1.6">40-60(40��ƽ����ȣ�=60)</option>
 <option value="1.9">60-90(60��ƽ����ȣ�=90)</option>
 <option value="2.2">90-120(90��ƽ����ȣ�=120)</option>
 <option value="3">120��������</option>									
   </select>��cm��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <select name="mostdeep" id="mostdeep">								
 <option value="0">��ѡ���������</option>
 <option value="1.1">10��������</option>
 <option value="1.3">10-20(10��������ȣ�=20)</option>
 <option value="1.4">20-40(20��������ȣ�=40)</option>
 <option value="1.6">40-60(40��������ȣ�=60)</option>
 <option value="1.9">60-90(60��������ȣ�=90)</option>
 <option value="2.2">90-120(90��������ȣ�=120)</option>
 <option value="3">120��������</option>									
   </select>��cm��&nbsp;&nbsp; 
                    </td>
                </tr>
                <tr>
                    <th>���٣�</th>
                    <td>
                         <select name="avgspeed" id="avgspeed">								
 <option value="0">��ѡ��ƽ������</option>
 <option value="1.1"><=0.2</option>
 <option value="1.2">0.2-0.5(0.2��ƽ�����٣�=0.5)</option>
 <option value="1.6">0.5-1.0(0.5��ƽ�����٣�=1.0)</option>
 <option value="2.0">1.0-2.0(1.0��ƽ�����٣�=2.0)</option>
 <option value="2.8">2.0-3.0(2.0��ƽ�����٣�=3.0)</option>
 <option value="3">3.0+</option>
   </select>����/�룩&nbsp;&nbsp;
                        <select name="badspeed" id="badspeed">								
 <option value="0">��ѡ�����������</option>
 <option value="1.1"><=0.2</option>
 <option value="1.2">0.2-0.5(0.2���������٣�=0.5)</option>
 <option value="1.6">0.5-1.0(0.5���������٣�=1.0)</option>
 <option value="2.0">1.0-2.0(1.0���������٣�=2.0)</option>
 <option value="2.8">2.0-3.0(2.0���������٣�=3.0)</option>
 <option value="3">3.0+</option>							
   </select>����/�룩&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <th><b class="b_red">*</b>Ұ�����</th>
                    <td>
                        <select name="wildlife" id="wildlife">								
 <option value="0">��ѡ���˺��̶�</option>
 <option value="1.1">ɧ��</option>
 <option value="1.8">�²�</option>
 <option value="2.5">����</option>
 <option value="4">����</option>	
   </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <select name="attack" id="attack">								
 <option value="0">��ѡ�񹥻����</option>
 <option value="2">��������</option>
 <option value="1.1">��������</option>
   </select>&nbsp;&nbsp; <img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="ָ�������г̹����У�����������Ұ�������ֺ��ĳ̶ȡ�ָ��Խ��Σ��Խ��Σ��ȡ�����������棺1������Ұ�������ܵ��˺��ĳ̶� 2��Ұ�������Ƿ�������������ԡ�" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_16">
                    </td>
                </tr>
                <tr>
                    <th><b class="b_red">*</b>��Ԯ�Ѷ�ϵ����</th>
                    <td>
<select name="degree" id="degree">								
  <option value="1">0-1��</option>
  <option value="1.1">1-2��</option>
  <option value="1.2">2-5��</option>
  <option value="1.4">5-10��</option>
  <option value="1.8">10������</option>	
 </select>&nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="ָһ�������¹���Ҫ����Ԯ������ɾ�Ԯ�����㣨D�㣩�����Ԯ������ʱ�䡣D�㣺��Ԯ�ӵ��ﱻ��Ԯ����ֻ��ͨ�����л��Զӷ�ʽ�������Զ�ˡ�" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_17">
                    </td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td><input type="submit" name="button" id="buttonRisk" value="" class="w_t"/></td>
                </tr>
                </form>
            </table>
            <div class="dycon">Σ�ն�ָ�����������˸���·ͽ����Խ�ļ��ڣ���������������������·��������Ȼ���أ���ˮ�ȣ�ʹ����ɸô�Խ��·�����ܵ�Σ�ճ̶ȡ�</div>
            <div style="clear:both"></div>
        </div>
        <div class="fengping_w"></div>
        <!--Σ�ս����ʼ-->
        <div class="jieguo" id="wx">
            <span class="close"></span>
            <h4>Σ�ն�ָ��</h4>
            <p>0.5</p>
        </div>
        <!--Σ�ս������-->
        
</div>
    <!--Σ�տ�ʼ-->
<script type="text/javascript">
jQuery.noConflict();
;(function($) {	
$('#qd').hide();
$('.fengping_q').hide();
$('#wx').hide();
$('.fengping_w').hide();

$('#qd span').click(function(){		
$('#qd').hide();
$('.fengping_q').hide();
});

$('#wx span').click(function(){		
$('#wx').hide();
$('.fengping_w').hide();
});

   $('#pic-pub-form').submit(function() {    		
var times=parseFloat($('#times').val());  //ʱ��
var endure=parseFloat($('#endure').val()); //����
var distance=parseFloat($('#distance').val()); //�г�
var verticality=parseFloat($('#verticality').val()); //��ֱ�г�
var supply=parseFloat($('#supply').val()); //��������
var tp='qdzs';
var str_url = 'plugin.php?id=forumoption:cal&tp='+tp;
$.ajax({           
url: str_url,
type: 'post',
data:{ times: times, endure: endure, distance: distance, verticality: verticality, supply: supply }			
}).done(function(data){
$('.jieguo h4').html("");
$('.jieguo p').html("");
$('.jieguo h4').html("ǿ��ָ��");
$('.jieguo p').html(data);
$('.fengping_q').show();	
$('#qd').show();			
}).fail(function(){ alert("���ݶ�ȡ����"); }); 	
return false;
    });	
$('#pic-pub-form1').submit(function() {		
var lowtemperature=parseInt($('#lowtemperature').val()); //�õ�����¶�
var highttemperature=parseInt($('#highttemperature').val()); //�õ�����¶�		

var avgrain = parseFloat($('#avgrain').val()); //ƽ����ˮ
var badrain = parseFloat($('#badrain').val()); //����ӽ�ˮ				

var watertemp = parseFloat($('#watertemp').val());  //ƽ��ˮ��
var badtemp = parseFloat($('#badtemp').val());  //����ˮ��			

var avgdeep = parseFloat($('#avgdeep').val()); //ƽ�����
var mostdeep = parseFloat($('#mostdeep').val()); //�������


var avgspeed = parseFloat($('#avgspeed').val()); //ƽ������
var badspeed = parseFloat($('#badspeed').val()); //�������

var landform = parseFloat($('#landform').val());  //����ָ��
//var water = (watertemp*avgdeep*avgspeed*0.6)+(badtemp*mostdeep*badspeed*0.4); //ˮ��ָ��		

var wildlife = parseFloat($('#wildlife').val()); //Ұ������		
var attack = parseFloat($('#attack').val()); //����ָ��		

if($('#lowtemperature').val()==''||$('#highttemperature').val()==''){
alert('��ѡ���������');
return false;
}
if(lowtemperature>highttemperature){
alert('����¶Ȳ��ܱ�����¶ȸ�');
return false;
}
/*
if(avgrain==0||badrain==0){
alert('��ѡ��ˮ���');return false;
}*/

if(watertemp!=0||badtemp!=0){
if(watertemp=='1.8'){
   if(badtemp!='1.8'){
 alert('ˮ��ѡ����ȷ');return false;		
   }			   
}else{
if(badtemp=='1.8'){
 alert('ˮ��ѡ����ȷ');return false;
}
if(watertemp>badtemp){
alert('ƽ��ˮ�²��ܴ��������ˮ��');return false;	
}	
}		
if(watertemp==0||badtemp==0){
alert('ˮ��ѡ������');return false;
}				
}		
if(avgdeep!=0||mostdeep!=0){
if(avgdeep==0||mostdeep==0){
alert('���ѡ������');return false;
}
if(avgdeep>mostdeep){
alert('ƽ����Ȳ��ܴ����������');return false;				
}		
}
if(avgspeed!=0||badspeed!=0){
if(avgspeed==0||badspeed==0){
alert('����ѡ������');return false;							
}			
if(avgspeed>badspeed){
alert('ƽ�����ٲ��ܴ����������');return false;				
}			
}

/*
if(lowtemperature<0){
var ww = (Math.abs(lowtemperature)/5);
var bs = (Math.ceil(ww));
low = bs*0.5;
}
if(highttemperature>26){
var ht= highttemperature-26;
var hight = (Math.abs(ht)/5);
var  cd = (Math.ceil(hight));			
hig = cd*0.4;
}
if(cha>15){
var pt = cha-15;
var ch = (Math.abs(pt)/5);
var cc = (Math.ceil(ch));
ab = cc*0.5;
}			
var tal = 1+low+hig+ab;   //����ָ��		
alert('����ָ��:'+tal);		


alert('��ˮָ��:'+rain);

alert('����ָ��:'+landform);

water = water.toFixed(2);		
alert('ˮ��ָ��:'+water);

var danger = wildlife*attack;		
alert('Σ��ָ��:'+danger);
*/		
if(wildlife==0||attack==0){
alert('��ѡ��Ұ������Σ��ָ����');return false;
}		
var degree = parseFloat($('#degree').val()); //��Ԯ�Ѷ�ϵ��		
var tp='wxzs';
var str_url = 'plugin.php?id=forumoption:cal&tp='+tp;
$.ajax({           
url: str_url,
type: 'post',
data:{lowtemperature:lowtemperature,highttemperature:highttemperature,avgrain:avgrain,badrain:badrain,watertemp:watertemp,badtemp:badtemp,avgdeep:avgdeep,mostdeep:mostdeep,avgspeed:avgspeed,badspeed:badspeed,landform:landform,wildlife:wildlife,attack:attack,degree:degree}
}).done(function(data){
$('.jieguo h4').html("");
$('.jieguo p').html("");
$('.jieguo h4').html("Σ�ն�ָ��");
$('.jieguo p').html(data);
$('#wx').show();
$('.fengping_w').show();
}).fail(function(){ alert("����ѡ����ȷ���������"); }); 	
return false;
    });   
}(jQuery));
</script><!--��վ�ײ� cms -->
<?php if(in_array($_G['fid'],array("408","471"))) { ?>
<script type="text/javascript">//<![CDATA[
ac_as_id = 72339;
ac_click_track_url = "";ac_format = 0;ac_mode = 1;
ac_width = 280;ac_height = 210;
//]]></script>
<script src="http://static.acs86.com/g.js" type="text/javascript"></script>
<?php } ?>
<div class="footer">
<div class="layout" style="margin:auto;"><div class="copyRight">
<p class="fr clearfix"><a href="http://www.8264.com/about-index.html" target="_blank">8264���</a> | <a href="http://www.8264.com/about-contact.html" target="_blank">��ϵ����</a> | <a href="http://www.8264.com/about-adservice.html" target="_blank">������</a> | <a href="http://www.8264.com/list/885" target="_blank">������ַ��ȫ</a> | <a href="http://www.8264.com/sitemap" target="_blank">��վ��ͼ</a></p>
<p>��ICP��05004140��-10   ICP֤ ��B2-20110106</p>
<p>�����з��գ�8264����������<a href="http://bx.8264.com/?8264com" target="_blank" style=" color:#2A85E8;">���Ᵽ��</a></p>
</div></div>
</div>
<!--��վ�ײ� cms -->
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?></div>
<!--//waper����//-->
<!--//��̳���½ǵ��� ��ʼ//-->
<?php if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb"> <em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>վ���Ƽ�<?php } ?></em> <span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="�ر�">�ر�</a></span> </h3>
<hr class="l" />
<div class="detail">
<h4><a href="<?php echo $focus['url'];?>" target="_blank"><?php echo $focus['subject'];?></a></h4>
<p> <?php if($focus['image']) { ?> <a href="<?php echo $focus['url'];?>" target="_blank"><img src="<?php echo $focus['image'];?>" onload="thumbImg(this, 1)" _width="58" _height="58" /></a> <?php } ?> <?php echo $focus['summary'];?> </p>
</div>
<hr class="l" />
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">�鿴</a> </div>
<?php } ?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; } ?>
<!--//��̳���½ǵ��� ����//-->
<!--//��վͷ�����������˵� ��ʼ//-->
<ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar" class="touxian">�޸�ͷ��</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile" class="ziliao">��������</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">��֤</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit" class="jifen">����</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup" class="yonghuzu" >�û���</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy" class="yinsishaixuan" >��˽ɸѡ</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail" class="youjiantixing">�ʼ�����</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password" class="mimaanquan">���밲ȫ</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { ?>     
     <?php if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { ?>    
     <?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
     <li <?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?> ><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>" <?php if($id=='myrepeats:memcp') { ?> class="majia"<?php } elseif($id=='sina_xweibo:home_binding') { ?>class="sina"<?php } elseif($id) { ?>class="qq"<?php } ?>><?php if($id=='sina_xweibo:home_binding') { ?>���˰�<?php } else { ?><?php echo $module['name'];?><?php } ?></a></li>     
 <?php } ?>        
     <?php } ?>
     <?php } ?>
</ul>
<!--//��վͷ�����������˵� ����//-->

<?php if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly"> ���� <?php echo $_G['member']['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ���� </div>
<div class="mncr"></div>
</div>
<?php } if(!$_G['setting']['bbclosed']) { ?> 
    <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?> 
    <script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script> 
    <?php } ?>
    <?php if(!isset($_G['cookie']['sendmail'])) { ?> 
    <script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script> 
    <?php } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script><script src="<?php echo $_G['setting']['jspath'];?>portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_G['gp_do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<?php } ?><?php output(); ?><script src=" http://www.baidu.com/js/opensug.js" type="text/javascript"></script>
<script src="http://www.8264.com/template/8264/js/common.js" type="text/javascript"></script>
<script type="text/javascript">
;(function($){    
$(".top1 ul li:has(div.nav_xl)").hover(function(){
$(this).children("div.nav_xl").stop(true,true).show();
},function(){
$(this).children("div.nav_xl").stop(true,true).hide();
});<!--// ��վͷ�� ����//-->
$(".top2 ul li:has(div.nav_xl)").hover(function(){
$(this).children("div.nav_xl").stop(true,true).show();
},function(){
$(this).children("div.nav_xl").stop(true,true).hide();
});<!--// ��վͷ�����nav ����//-->	
})(jQuery);
</script>








<script src="javascript/css.js" type="text/javascript"  type="text/javascript"></script>
<div id="myShow1" style="display:none;"></div>
<div id="myShow2" style="display:none;"></div>
<div id="myShow3" style="display:none;"></div>
<div id="myShow4" style="display:none;"></div>

</body>
</html>





