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
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="http://static.8264.com/static/image/diy/panel-toggle.png" alt="DIY" /></a>
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
<li><a href="javascript:void(0)" class="top1_la">线上项目</a>
<div class="nav_xl top1_lxl xiangm"> <a href="http://www.8264.com/list/842" target="_blank" class="red">每日一图</a> <a href="http://www.8264.com/pp/" target="_blank" class="lan">铿锵玫瑰</a> <a href="http://www.8264.com/list/881" target="_blank" class="lv">线路推荐</a> <a href="http://www.8264.com/list/880" target="_blank" class="huang">勇者先行</a> <a href="http://www.8264.com/zhuangbei" target="_blank" class="red">装备推荐</a> </div>
</li>
<li><a href="javascript:void(0)"class="top1_la">线下项目</a>
<div class="nav_xl top1_lxl xiangm"> <a href="http://www.8264.com/topic/1458.html" target="_blank"class="lan">露营大会</a> <a href="http://www.8264.com/topic/1500.html" target="_blank"class="lv">滑雪比赛</a> </div>
</li>
<li><a href="http://www.8264.com/app/"class="top1_la_1">8264手机版</a></li>
</ul>
</div>
<div class="top1_r clearfix"><?php if($_G['uid']) { ?>

<strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="vwmy" target="_blank" title="访问我的空间"><?php echo $_G['member']['username'];?></a></strong>



<?php if($_G['group']['allowinvisible']) { ?>
<span id="loginstatus" class="">
<a href="member.php?mod=switchstatus" title="切换在线状态" onClick="ajaxget(this.href, 'loginstatus');doane(event);">
<?php if($_G['session']['invisible']) { ?>
隐身
<?php } else { ?>
在线
<?php } ?>
</a>
</span>
<?php } ?>


 <a href="home.php?mod=space&amp;do=friend">好友</a> 


<?php if($_G['setting']['regstatus'] > 1) { ?>
<a href="home.php?mod=spacecp&amp;ac=invite" class="">邀请</a> 
<?php } ?>


 <span id="usersetup" class="showmenu" onMouseOver="showMenu(this.id);">
<a href="home.php?mod=spacecp">设置</a>
</span>


 <a href="home.php?mod=space&amp;do=notice" id="myprompt"<?php if($_G['member']['newprompt']) { ?> class="new"<?php } ?>>提醒
<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?>
</a><span id="myprompt_check"></span>



 <a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>短消息
<?php if($_G['member']['newpm']) { ?>(<?php echo $_G['member']['newpm'];?>)<?php } ?></a>




<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?>
 <a href="portal.php?mod=portalcp">门户管理</a>
<?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
 <a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>
<?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?>
 <a href="admin.php" target="_blank">管理中心</a>
<?php } ?>




 <a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<strong><a id="loginuser"><?php echo $_G['cookie']['loginuser'];?></a></strong>


 
<a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">激活</a>


 <a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>


<?php } else { ?>
<a href="http://bbs.8264.com/connect.php?method=sina&amp;action=login&amp;op=init" class="log_wb">微博登陆</a>
<a href="http://bbs.8264.com/connect-login-op-init-referer-index.php-statfrom-login_simple.html" class="log_qq">QQ登陆</a>
<div style=" float:right;">
<a>欢迎来到8264!</a>
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href);hideWindow('login');"><?php echo $_G['setting']['reglinkname'];?></a>
<a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">登录</a></div>

<?php } ?>

</div>
</div>
</div>
<!--简版头导航开始-->
<div class="top2">
<div class="nav960 clearfix">
    <div class="top2_l"><a href="http://www.8264.com/"><img src="/template/8264/css/moban/1024newslw/images/8264_logo.png" /></a></div>
    <div class="top2_r">
        <ul>
            <li><a href="http://www.8264.com/" style="background:none">首页</a></li>
            <li><a href="http://www.8264.com/list/201/">资讯</a>
                <div class="nav_xl" style="width:115px;">
                    <div class="zx"><a href="http://www.8264.com/list/204/" >装备</a><a href="http://dengshan.8264.com/" >登山</a><a href="http://www.8264.com/list/751/" >商业</a><a href="http://www.8264.com/list/238/" >知识</a><a href="http://www.8264.com/list/232/" >攀岩</a><a href="http://www.8264.com/list/746/" >专访</a><a href="http://www.8264.com/topic_list/" >专题</a></div>
                 </div>
            </li>
            <li><a href="http://www.8264.com/pinpai" >品牌</a>
                <div class="nav_xl">
                    <div class="sy"><a href="http://bbs.8264.com/forum-459-1.html" >招&nbsp;&nbsp;&nbsp;聘</a><a href="http://www.8264.com/dianpu" >店&nbsp;&nbsp;&nbsp;铺</a></div>
                 </div>
            </li>
            <li><a href="http://bbs.8264.com/forum-433-1.html" >目的地</a>
                <div class="nav_xl" style="width:130px;">
                     <div class="cx"><a href="http://yueban.com/" >约伴</a> <a href="/ditu/" >地图</a> <a href="http://www.8264.com/xuechang" >滑雪场</a> <a href="http://u.8264.com/home-space-do-activity-view-all-order-hot-date-default-class.html" >活动</a> <a href="http://bbs.8264.com/forum-392-1.html" >山峰</a> <a href="http://bbs.8264.com/forum-440-1.html" >旅&nbsp;&nbsp;&nbsp;舍</a> <a href="http://bx.8264.com/?bbsbxnew" >保险</a> <a href="http://www.8264.com/list/881" >攻略</a> </div>
                 </div>
            </li>
            <li><a href="http://www.7jia2.com/" >商城</a>
                <div class="nav_xl">
                    <div class="zb"> <a href="http://tuan.7jia2.com/?from=8264daohang" >团&nbsp;&nbsp;&nbsp;购</a> <a href="http://tmh.7jia2.com/?from=8264daohang" >特卖会</a></div>
                 </div>
            </li>
            <li><a href="http://bbs.8264.com/" >驴友论坛</a>
                <div class="nav_xl">
                    <div class="sq"><a href="http://u.8264.com/" >驴友录</a> <a href="http://www.8264.com/list/871/" >精&nbsp;&nbsp;&nbsp;选</a> </div>
                 </div>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
    </div>
</div>
<!--简版头导航结束--><link href="/source/plugin/whither/css/qdzs.css?c=2" rel="stylesheet" type="text/css" />
<div class="q_w_title">
<h2 class="biaotititle">8264徒步线路评价体系</h2>
    <p class="w_q_infor">8264徒步线路<span class="q_bule">强度指数</span>和<span class="w_red">危险度指数</span>是基于徒步穿越行程中气温、地形、时间等因素综合定义的一套测量标准，仅作为衡量线路强度和危险度的参考，并不作为唯一依据。</p>
    </div>
<!--强度开始-->
<div class="mid_qw qd">
        <h3><img src="/source/plugin/whither/css/image/q_banner.jpg"/></h3>
        <div>
          <table border="0" cellspacing="0" cellpadding="0" class="table_form">
              <form id="pic-pub-form" name="form1" method="post" action="">
              <tr>
                  <th><b class="b_red">*</b>时间：</th>
                  <td>
                  <select name="times" id="times">								
                      <option value="1">1-2天</option>
                      <option value="1.5">3天</option>
                      <option value="2.5">4-5天</option>
                      <option value="3">6-7天</option>
                      <option value="5">8-10天</option>
                      <option value="6.5">11-15天</option>
                      <option value="7.5">16-20天</option>
                      <option value="9">21-30天</option>
                      <option value="10">31天以上</option>
                  </select>（天）<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="从徒步起点开始，到徒步终点为止，正常情况下完成行程所需要的时间。以天为单位。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_0">
                  </td>
              </tr>
              <tr>
                  <th><b class="b_red">*</b>初始负重：</th>
                  <td>
                   <select name="endure" id="endure">								
                      <option value="1"><5</option>
                      <option value="1.5">5-10</option>
                      <option value="2">11-15</option>
                      <option value="2.5">16-20</option>
                      <option value="3">21-25</option>
                      <option value="4">26-35</option>
                      <option value="5">>35</option>			
                    </select>（Kg）<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="在正常装备条件下（不包括极端轻量化和极端非轻量化装备），在徒步者独立背负自身所需所有装备的情况下。徒步行程开始时，徒步者身上背负的装具、装备、给养重量的总和。包括但不限于背包，睡袋，防潮垫，帐篷，食品，水。但不包括其它重量较大的特种装备，例如重量较大的单反相机等。以Kg为计量。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_1">
                  </td>
              </tr>
              <tr>
                  <th><b class="b_red">*</b>日均行程：</th>
                  <td>
                   <select name="distance" id="distance">								
                      <option value="1"><=10</option>
                      <option value="2">11-15</option>
                      <option value="3.5">16-20</option>
                      <option value="4.5">21-25</option>
                      <option value="5">25+</option>									
                   </select>（Km）<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="在整个徒步穿越行程中，平均每天完成的线路的水平距离，以公里（Km）为单位。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_4">
                  </td>
              </tr>
              <tr>
                  <th><b class="b_red">*</b>日均垂直行程：</th>
                  <td>
                  <select name="verticality" id="verticality">								
                      <option value="1"><=700</option>
                      <option value="2">700-1200</option>
                      <option value="3">1200-2000</option>
                      <option value="4">2000-3000</option>
                      <option value="5">>3000</option>									
                  </select>（m）<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="在整个徒步穿越行程中，平均每天完成的线路的垂直距离之和（数值为上升距离和下降距离之和），并且上升行程和下降行程不抵消。以米（m）为单位。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_2">
                  </td>
              </tr>
              <tr>
                  <th><b class="b_red">*</b>补给指数：</th>
                  <td>
                  <select name="supply" id="supply">								
                      <option value="0.5">10+</option>
                      <option value="0.7">7-10</option>
                      <option value="0.8">5-6</option>
                      <option value="0.9">1-4</option>
                      <option value="1.5">无</option>									
                  </select>（次）<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="单位为次，指从徒步起点开始到徒步终点为止，在预定行进线路上可以确认的固定补给点（有人值守，可以补充人工制成品食物和部分装备的补给点）的遭遇次数。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_3">
                  </td>
              </tr>
              <tr>
                  <th>&nbsp;</th>
                  <td><input type="submit" name="button" id="button" value="" class="q_t" /></td>
              </tr>
              </form>
          </table>
          <div class="dycon">
强度指数：在最适宜该线路徒步穿越的季节，天气良好的状态下，完成该穿越线路所经受的强度。同时也可用于测量自己所在季节穿越的强度</div>
          <div style="clear:both"></div>
        </div>
        <div class="fengping_q"></div>
        <!--强度结果开始-->
        <div class="jieguo" id="qd">
          <span class="close"></span>
          <h4>危险度指数</h4>
          <p>0.5</p>
        </div>
        <!--强度结果结束-->
    </div>
    <!--强度结束-->
    
<!--危险开始-->
    <div class="mid_qw wx">
        <h3><img src="/source/plugin/whither/css/image//w_banner.jpg"/></h3>
        <div>
            <table border="0" cellspacing="0" cellpadding="0" class="table_form">
                <form id="pic-pub-form1" name="form2" method="post" action="">
                <tr>
                    <th><b class="b_red">*</b>气温：</th>
                    <td><?php $arr=array(50,49,48,47,46,45,44,43,42,41,40,39,38,37,36,35,34,33,32,31,30,29,28,27,26,25,24,23,22,21,20,19,18,17,16,15,14,13,12,11,10,9,8,7,6,5,4,3,2,1,0,-1,-2,-3,-4,-5,-6,-7,-8,-9,-10,-11,-12,-13,-14,-15,-16,-17,-18,-19,-20,-21,-22,-23,-24,-25,-26,-27,-28,-29,-30,-31,-32,-33,-34,-35,-36,-37,-38,-39,-40); ?><select name="lowtemperature" id="lowtemperature">								
 <option value="">请选择最低气温</option>								
 <?php if(is_array($arr)) foreach($arr as $ar) { ?> <option value="<?php echo $ar;?>"><?php echo $ar;?></option>
 <?php } ?>											
</select>（摄氏度）
                        <select name="highttemperature" id="highttemperature">								
<option value="">请选择最高气温</option><?php if(is_array($arr)) foreach($arr as $ar) { ?><option value="<?php echo $ar;?>"><?php echo $ar;?></option>
<?php } ?>		
</select>（摄氏度）&nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="从徒步行程开始到结束，所经历的最高温度和最低温度。最低温度越低难度越大，对行程影响越大;最高温度越高难度越大，对行程影响越大;温差越大，对行程影响越大。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_10">
                    </td>
                </tr>
                <tr>
                    <th>降水情况：</th>
                    <td>
                        <select name="avgrain" id="avgrain">								
 <option value="0">请选择平均降水程度</option>
 <option value="1.1">小雨</option>
 <option value="1.5">中雨</option>
 <option value="2">大雨</option>
 <option value="3">暴雨</option>
 <option value="5">大暴雨</option>
 <option value="1.1">小雪</option>
 <option value="1.3">中雪</option>
 <option value="1.8">大雪</option>
 <option value="3">暴雪</option>
 <option value="1.1">轻雾</option>
 <option value="1.5">雾</option>
 <option value="1.8">大雾</option>
 <option value="2.2">浓雾</option>
 <option value="3">强浓雾</option>
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="badrain" id="badrain">								
 <option value="0">请选择最恶劣降水程度</option>
 <option value="1.1">小雨</option>
 <option value="1.5">中雨</option>
 <option value="2">大雨</option>
 <option value="3">暴雨</option>
 <option value="5">大暴雨</option>
 <option value="1.1">小雪</option>
 <option value="1.3">中雪</option>
 <option value="1.8">大雪</option>
 <option value="3">暴雪</option>
 <option value="1.1">轻雾</option>
 <option value="1.5">雾</option>
 <option value="1.8">大雾</option>
 <option value="2.2">浓雾</option>
 <option value="3">强浓雾</option>							
</select>&nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="表示降水对徒步行程的影响，如果行程中无降水则对行程无影响。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_11">
                    </td>
                </tr>
               
                <tr>
                    <th><b class="b_red">*</b>地形：</th>
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
</select> &nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="危险度（平均）1.0的路面为平坦坚实地面，摩擦系数不小于干燥砂石路，5.0为必须依赖器材保护才可通过的道路。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_12">
                    </td>
                </tr>
          
                <tr>
                    <th>水温：</th>
                    <td>
                       <select name="watertemp" id="watertemp">								
 <option value="0">请选择平均水温</option>
 <option value="1.8">0-10(0＜=平均水温＜=10)</option>
 <option value="1.3">10-20(10＜平均水温＜=20)</option>
 <option value="1.5">20-35(20＜平均水温＜=35)</option>
 <option value="1.6">35-50(35＜平均水温＜=50)</option>								
</select>（摄氏度）
                        <select name="badtemp" id="badtemp">								
 <option value="0">请选择最恶劣水温</option>
 <option value="1.8">0-10(0＜=恶劣水温＜=10)</option>
 <option value="1.3">10-20(10＜恶劣水温＜=20)</option>
 <option value="1.5">20-35(20＜恶劣水温＜=35)</option>
 <option value="1.6">35-50(35＜恶劣水温＜=50)</option>									
</select>（摄氏度）&nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="用于需要涉水过河的线路。水温越低、水深越大、流速越高，对线路行程的影响越大。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_13">
                  </td>
                </tr>
                <tr>
                    <th>深度：</th>
                    <td>
                        <select name="avgdeep" id="avgdeep">
 <option value="0">请选择平均深度</option>
 <option value="1.1">10厘米以内</option>
 <option value="1.3">10-20(10＜平均深度＜=20)</option>
 <option value="1.4">20-40(20＜平均深度＜=40)</option>
 <option value="1.6">40-60(40＜平均深度＜=60)</option>
 <option value="1.9">60-90(60＜平均深度＜=90)</option>
 <option value="2.2">90-120(90＜平均深度＜=120)</option>
 <option value="3">120厘米以上</option>									
   </select>（cm）&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <select name="mostdeep" id="mostdeep">								
 <option value="0">请选择最深深度</option>
 <option value="1.1">10厘米以内</option>
 <option value="1.3">10-20(10＜最深深度＜=20)</option>
 <option value="1.4">20-40(20＜最深深度＜=40)</option>
 <option value="1.6">40-60(40＜最深深度＜=60)</option>
 <option value="1.9">60-90(60＜最深深度＜=90)</option>
 <option value="2.2">90-120(90＜最深深度＜=120)</option>
 <option value="3">120厘米以上</option>									
   </select>（cm）&nbsp;&nbsp; 
                    </td>
                </tr>
                <tr>
                    <th>流速：</th>
                    <td>
                         <select name="avgspeed" id="avgspeed">								
 <option value="0">请选择平均流速</option>
 <option value="1.1"><=0.2</option>
 <option value="1.2">0.2-0.5(0.2＜平均流速＜=0.5)</option>
 <option value="1.6">0.5-1.0(0.5＜平均流速＜=1.0)</option>
 <option value="2.0">1.0-2.0(1.0＜平均流速＜=2.0)</option>
 <option value="2.8">2.0-3.0(2.0＜平均流速＜=3.0)</option>
 <option value="3">3.0+</option>
   </select>（米/秒）&nbsp;&nbsp;
                        <select name="badspeed" id="badspeed">								
 <option value="0">请选择最恶劣流速</option>
 <option value="1.1"><=0.2</option>
 <option value="1.2">0.2-0.5(0.2＜恶劣流速＜=0.5)</option>
 <option value="1.6">0.5-1.0(0.5＜恶劣流速＜=1.0)</option>
 <option value="2.0">1.0-2.0(1.0＜恶劣流速＜=2.0)</option>
 <option value="2.8">2.0-3.0(2.0＜恶劣流速＜=3.0)</option>
 <option value="3">3.0+</option>							
   </select>（米/秒）&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <th><b class="b_red">*</b>野生动物：</th>
                    <td>
                        <select name="wildlife" id="wildlife">								
 <option value="0">请选择伤害程度</option>
 <option value="1.1">骚扰</option>
 <option value="1.8">致病</option>
 <option value="2.5">致伤</option>
 <option value="4">致死</option>	
   </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <select name="attack" id="attack">								
 <option value="0">请选择攻击情况</option>
 <option value="2">主动攻击</option>
 <option value="1.1">被动攻击</option>
   </select>&nbsp;&nbsp; <img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="指在整个行程过程中，可能遇到的野生动物侵害的程度。指数越高危险越大。危险取决于两个方面：1、遭遇野生动物受到伤害的程度 2、野生动物是否具有主动攻击性。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_16">
                    </td>
                </tr>
                <tr>
                    <th><b class="b_red">*</b>救援难度系数：</th>
                    <td>
<select name="degree" id="degree">								
  <option value="1">0-1天</option>
  <option value="1.1">1-2天</option>
  <option value="1.2">2-5天</option>
  <option value="1.4">5-10天</option>
  <option value="1.8">10天以上</option>	
 </select>&nbsp;&nbsp;<img src="static/image/common/faq.gif" onmouseover="showTip(this)" tip="指一旦出现事故需要外界救援，外界由救援出发点（D点）到达救援对象的最长时间。D点：救援队到达被救援对象，只能通过步行或驮队方式到达的最远端。" alt="Tip" style="margin:0; vertical-align:middle; padding:2px 0 4px" id="tip_17">
                    </td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td><input type="submit" name="button" id="buttonRisk" value="" class="w_t"/></td>
                </tr>
                </form>
            </table>
            <div class="dycon">危险度指数：在最适宜该线路徒步穿越的季节，在以正常概率遭遇此线路常见的自然因素（雨水等）使，完成该穿越线路所承受的危险程度。</div>
            <div style="clear:both"></div>
        </div>
        <div class="fengping_w"></div>
        <!--危险结果开始-->
        <div class="jieguo" id="wx">
            <span class="close"></span>
            <h4>危险度指数</h4>
            <p>0.5</p>
        </div>
        <!--危险结果结束-->
        
</div>
    <!--危险开始-->
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
var times=parseFloat($('#times').val());  //时间
var endure=parseFloat($('#endure').val()); //负重
var distance=parseFloat($('#distance').val()); //行程
var verticality=parseFloat($('#verticality').val()); //垂直行程
var supply=parseFloat($('#supply').val()); //补给次数
var tp='qdzs';
var str_url = 'plugin.php?id=forumoption:cal&tp='+tp;
$.ajax({           
url: str_url,
type: 'post',
data:{ times: times, endure: endure, distance: distance, verticality: verticality, supply: supply }			
}).done(function(data){
$('.jieguo h4').html("");
$('.jieguo p').html("");
$('.jieguo h4').html("强度指数");
$('.jieguo p').html(data);
$('.fengping_q').show();	
$('#qd').show();			
}).fail(function(){ alert("数据读取错误！"); }); 	
return false;
    });	
$('#pic-pub-form1').submit(function() {		
var lowtemperature=parseInt($('#lowtemperature').val()); //得到最低温度
var highttemperature=parseInt($('#highttemperature').val()); //得到最高温度		

var avgrain = parseFloat($('#avgrain').val()); //平均降水
var badrain = parseFloat($('#badrain').val()); //最恶劣降水				

var watertemp = parseFloat($('#watertemp').val());  //平均水温
var badtemp = parseFloat($('#badtemp').val());  //恶劣水温			

var avgdeep = parseFloat($('#avgdeep').val()); //平均深度
var mostdeep = parseFloat($('#mostdeep').val()); //最深深度


var avgspeed = parseFloat($('#avgspeed').val()); //平均流速
var badspeed = parseFloat($('#badspeed').val()); //最快流速

var landform = parseFloat($('#landform').val());  //地形指数
//var water = (watertemp*avgdeep*avgspeed*0.6)+(badtemp*mostdeep*badspeed*0.4); //水文指数		

var wildlife = parseFloat($('#wildlife').val()); //野生动物		
var attack = parseFloat($('#attack').val()); //攻击指数		

if($('#lowtemperature').val()==''||$('#highttemperature').val()==''){
alert('请选择气温情况');
return false;
}
if(lowtemperature>highttemperature){
alert('最低温度不能比最高温度高');
return false;
}
/*
if(avgrain==0||badrain==0){
alert('请选择降水情况');return false;
}*/

if(watertemp!=0||badtemp!=0){
if(watertemp=='1.8'){
   if(badtemp!='1.8'){
 alert('水温选择不正确');return false;		
   }			   
}else{
if(badtemp=='1.8'){
 alert('水温选择不正确');return false;
}
if(watertemp>badtemp){
alert('平均水温不能大于最恶劣水温');return false;	
}	
}		
if(watertemp==0||badtemp==0){
alert('水温选择不完整');return false;
}				
}		
if(avgdeep!=0||mostdeep!=0){
if(avgdeep==0||mostdeep==0){
alert('深度选择不完整');return false;
}
if(avgdeep>mostdeep){
alert('平均深度不能大于最深深度');return false;				
}		
}
if(avgspeed!=0||badspeed!=0){
if(avgspeed==0||badspeed==0){
alert('流速选择不完整');return false;							
}			
if(avgspeed>badspeed){
alert('平均流速不能大于最快流速');return false;				
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
var tal = 1+low+hig+ab;   //气温指数		
alert('气温指数:'+tal);		


alert('降水指数:'+rain);

alert('地形指数:'+landform);

water = water.toFixed(2);		
alert('水文指数:'+water);

var danger = wildlife*attack;		
alert('危险指数:'+danger);
*/		
if(wildlife==0||attack==0){
alert('请选择野生动物危险指数！');return false;
}		
var degree = parseFloat($('#degree').val()); //救援难度系数		
var tp='wxzs';
var str_url = 'plugin.php?id=forumoption:cal&tp='+tp;
$.ajax({           
url: str_url,
type: 'post',
data:{lowtemperature:lowtemperature,highttemperature:highttemperature,avgrain:avgrain,badrain:badrain,watertemp:watertemp,badtemp:badtemp,avgdeep:avgdeep,mostdeep:mostdeep,avgspeed:avgspeed,badspeed:badspeed,landform:landform,wildlife:wildlife,attack:attack,degree:degree}
}).done(function(data){
$('.jieguo h4').html("");
$('.jieguo p').html("");
$('.jieguo h4').html("危险度指数");
$('.jieguo p').html(data);
$('#wx').show();
$('.fengping_w').show();
}).fail(function(){ alert("参数选择不正确，计算错误！"); }); 	
return false;
    });   
}(jQuery));
</script><!--网站底部 cms -->
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
<p class="fr clearfix"><a href="http://www.8264.com/about-index.html" target="_blank">8264简介</a> | <a href="http://www.8264.com/about-contact.html" target="_blank">联系我们</a> | <a href="http://www.8264.com/about-adservice.html" target="_blank">广告服务</a> | <a href="http://www.8264.com/list/885" target="_blank">户外网址大全</a> | <a href="http://www.8264.com/sitemap" target="_blank">网站地图</a></p>
<p>津ICP备05004140号-10   ICP证 津B2-20110106</p>
<p>户外有风险，8264提醒您购买<a href="http://bx.8264.com/?8264com" target="_blank" style=" color:#2A85E8;">户外保险</a></p>
</div></div>
</div>
<!--网站底部 cms -->
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?></div>
<!--//waper结束//-->
<!--//论坛右下角弹窗 开始//-->
<?php if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb"> <em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?></em> <span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="关闭">关闭</a></span> </h3>
<hr class="l" />
<div class="detail">
<h4><a href="<?php echo $focus['url'];?>" target="_blank"><?php echo $focus['subject'];?></a></h4>
<p> <?php if($focus['image']) { ?> <a href="<?php echo $focus['url'];?>" target="_blank"><img src="<?php echo $focus['image'];?>" onload="thumbImg(this, 1)" _width="58" _height="58" /></a> <?php } ?> <?php echo $focus['summary'];?> </p>
</div>
<hr class="l" />
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">查看</a> </div>
<?php } ?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; } ?>
<!--//论坛右下角弹窗 结束//-->
<!--//网站头部设置下拉菜单 开始//-->
<ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar" class="touxian">修改头像</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile" class="ziliao">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit" class="jifen">积分</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup" class="yonghuzu" >用户组</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy" class="yinsishaixuan" >隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail" class="youjiantixing">邮件提醒</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password" class="mimaanquan">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { ?>     
     <?php if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { ?>    
     <?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
     <li <?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?> ><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>" <?php if($id=='myrepeats:memcp') { ?> class="majia"<?php } elseif($id=='sina_xweibo:home_binding') { ?>class="sina"<?php } elseif($id) { ?>class="qq"<?php } ?>><?php if($id=='sina_xweibo:home_binding') { ?>新浪绑定<?php } else { ?><?php echo $module['name'];?><?php } ?></a></li>     
 <?php } ?>        
     <?php } ?>
     <?php } ?>
</ul>
<!--//网站头部设置下拉菜单 结束//-->

<?php if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly"> 积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分 </div>
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
});<!--// 网站头部 下拉//-->
$(".top2 ul li:has(div.nav_xl)").hover(function(){
$(this).children("div.nav_xl").stop(true,true).show();
},function(){
$(this).children("div.nav_xl").stop(true,true).hide();
});<!--// 网站头部简版nav 下拉//-->	
})(jQuery);
</script>








<script src="javascript/css.js" type="text/javascript"  type="text/javascript"></script>
<div id="myShow1" style="display:none;"></div>
<div id="myShow2" style="display:none;"></div>
<div id="myShow3" style="display:none;"></div>
<div id="myShow4" style="display:none;"></div>

</body>
</html>





