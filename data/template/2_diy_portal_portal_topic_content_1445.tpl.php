<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1445', 'common/header_diy');
block_get('6619');?>
<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title><?php echo $topic['title'];?></title>
<link href="http://static.8264.com/oldcms/moban/zt/2013_meeting/css/reset.css" rel="stylesheet" type="text/css">
<!--[if IE 6]>
<script src="http://static.8264.com/oldcms/moban/zt/2013_meeting/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2013_meeting/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->
<script src="http://www.8264.com/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>

<!-- Diy Start -->
<base href="<?php echo $_G['siteurl'];?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?>
<?php echo $rsshead;?><?php } if($_G['basescript'] == 'forum') { if(!empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
<link rel="stylesheet" id="css_widthauto" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_widthauto.css?<?php echo VERHASH;?>" />
<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
<?php } ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'home' || $_G['basescript'] == 'userapp') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>home.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } elseif($_G['basescript'] == 'portal') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?>
<link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_css_diy.css?<?php echo VERHASH;?>" />
<?php } ?>

<link href="http://static.8264.com/oldcms/moban/zt/2013_meeting/css/style.css" rel="stylesheet" type="text/css">

</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?> 
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a> 
<?php } ?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?> <?php include template('common/header_diy'); ?> 
<?php } ?> 
<?php if(empty($topic) || $topic['useheader']) { ?> <?php echo adshow("headerbanner/wp a_h"); ?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; ?> 
<?php } ?> 
<style id="diy_style" type="text/css">#frameCny2N1 {  margin:0px !important;border:0px none !important;}#portal_block_6619 {  margin:0px !important;border:0px none !important;}#portal_block_6619 .content {  margin:0px !important;}</style>
<!-- Diy End -->

<div class="wrapper">
<div class="layout shadow">
<div class="topLayout"></div>
<div class="mainLayout">
<!-- 
<div class="pioneerCol">
<a href="<?php echo url;?>" class="mainPic" target="_blank"><img src="<?php echo pic;?>"></a>
<h3><?php echo title;?></h3>
<div class="blackLayout"></div>
</div>		
-->

<!--[diy=pioneerDiy]--><div id="pioneerDiy" class="area"><div id="frameCny2N1" class=" frame move-span cl frame-1"><div id="frameCny2N1_left" class="column frame-1-c"><div id="frameCny2N1_left_temp" class="move-span temp"></div><?php block_display('6619'); ?></div></div></div><!--[/diy]-->
</div>
</div>
<div class="layout footer"> <a href="http://www.8264.com/about-index.html" target="_blank">8264简介</a> | <a href="http://www.8264.com/about-contact.html" target="_blank">联系我们</a> | <a href="http://www.8264.com/about-adservice.html" target="_blank">广告服务</a> | <a href="http://www.8264.com/zhuanti" target="_blank">户外热点</a> | <a href="http://www.8264.com/link/" target="_blank">户外网址大全</a> | <a href="http://www.8264.com/sitemap" target="_blank">网站地图</a><br>
<a href="http://bx.8264.com" target="_blank"><span>户外活动有风险，8264提醒您购买</span></a> <a href="http://bx.8264.com"><span>户外保险</span></a><br>
除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264 版权所有 <a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-10</a> <a href="/template/8264/image/icp.jpg" target="_blank">ICP证 津B2-20110106</a> </div>
</div>
<script type="text/javascript">
jQuery.noConflict();
;(function($){	
   $(".pioneerCol").hover(function(){
                 $(this).addClass("pioneerColHover");         
             },function(){
                 $(this).removeClass("pioneerColHover");         
             }
    );
})(jQuery);
</script>

<!--dx代码开始--> 
<?php if(!$_G['setting']['bbclosed']) { ?> 
<?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?> 
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script> 
<?php } ?> 
<?php if(!isset($_G['cookie']['sendmail'])) { ?> 
<script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script> 
<?php } ?> 
<?php } ?> 
<?php if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?> 
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script> 
<script src="<?php echo $_G['setting']['jspath'];?>portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script> 
<?php } ?> 
<?php if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?> 
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script> 
<script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script> 
<?php } ?> 
<?php if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_G['gp_do'] != 'notice') { ?> 
<script type="text/javascript">noticeTitle();</script> 
<?php } ?> 
<!--dx代码结束-->

</body>
</html>
