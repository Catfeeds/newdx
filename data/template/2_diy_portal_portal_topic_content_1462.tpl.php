<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1462', 'common/header_diy');
block_get('6880');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>2013中国（北京）国际体育用品博览会 | 体博会 | 8264 | 户外装备 | 科技装备</title>
<meta name="keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="generator" content="8264" />
<meta name="author" content="8264.com" />
<meta name="copyright" content="2001-2010" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
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

<script src="http://static.8264.com/oldcms/moban/zt/2013ispo/js/jquery-1.4.min.js" type="text/javascript"></script>
<link href="http://static.8264.com/oldcms/moban/zt/2013tibohui/style/style.css" rel="stylesheet" type="text/css" />
</head><body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
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
<!--dx代码结束--> 
<!--diy样式开始-->
<style id="diy_style" type="text/css">#framekN2tzL {  margin:0px !important;border:0px none !important;}#portal_block_6880 {  margin:0px !important;border:0px none !important;}#portal_block_6880 .content {  margin:0px !important;}</style>
<!--diy样式结束-->
<div class="warpten">
<div style="padding-top: 20px; background: #F4F4F4;"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/banner.jpg"/></div>
<div class="mid1">
<div style="padding-top:50px;">
<div class="lunbo">
<div id="focus_turn">
<ul id="focus_pic">
<li class="current"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=76210" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/lunbo/lb4.jpg" /></a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=75161" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/lunbo/lb1.jpg" /></a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=74493" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/lunbo/lb2.jpg" /></a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=76095" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/lunbo/lb3.jpg" /></a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=76211" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/lunbo/lb5.jpg" /></a></li>
</ul>
<div id="focus_opacity"></div>
<ul id="focus_tx">
<li class="current"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=76210" target="_blank">中央电视台记者采访体博会8264户外科技体验区</a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=75161" target="_blank">8264户外科技体验区 体博会展示思路欲颠覆传统</a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=74493" target="_blank">体博会祁玉麟：打造绿色低碳 助力民族品牌</a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=76095" target="_blank">8264户外科技体验区欣赏 尖端科技应用于户外鞋</a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=76211" target="_blank">体博会安踏展台现场伦敦奥运会冠军龙服揭晓</a></li>
</ul>
</div>
</div>
<div class="news1">
<div><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title1.jpg"/></div>
<div class="news1con">
<h2><a href="http://www.8264.com/viewnews-86332-page-1.html" target="_blank">第31届体博会众多看点将成为最值得关注一届</a></h2>
<ul>
<!--注：此处最多7条-->
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-81108-page-1.html" target="_blank">深耕产业服务大众 2013体博会厦门路演活动举行</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-76519-page-1.html" target="_blank">祁玉麟展望2013体博会 户外展区期待三大创新</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-81260-page-1.html" target="_blank">2012年大盘点 体博会招展形势及户外行业的发展</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-85352-page-1.html" target="_blank">体博会祁玉麟：231家企业报名参展面积过六千平</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-76107-page-1.html" target="_blank">体博会8264户外科技体验区 科技让户外更简单</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=75161" target="_blank">8264户外科技体验区 体博会展示思路欲颠覆传统</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-76519-page-1.html" target="_blank">祁玉麟展望2013体博会 户外展区期待三大创新</a></li>
</ul>
</div>
</div>
<div class="ty">
<div><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title2.jpg"/></div>
<p><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/1000.jpg"/><br>
8264户外科技体验区是由体博会官方委托8264全权负责规划建设和展示。2013年，8264户外科技体验区进入第五个年头，本届主题是“科技让户外更简单”。<a href="http://www.8264.com/viewnews-85877-page-1.html" target="_blank">[了解更多]</a></p>
</div>
<div class="clear"></div>
</div>
</div>
<div class="mid2">
<div class="mid2_l">
<div><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title3.jpg"/></div>
<div class="mid2_lcon">
<a href="http://www.8264.com/topic/1406.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/h-2012.jpg"/></a>
<a href="http://www.8264.com/portal-topic-topicid-1353.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/h1.jpg"/></a><a href="http://www.8264.com/portal-topic-topicid-1315.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/h2.jpg"/></a><a href="http://www.8264.com/portal-topic-topicid-1182.html " target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/h3.jpg"/></a><a href="http://www.8264.com/topic/1122.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/h4.jpg"/></a></div>
</div>
<div class="mid2_m">
<div><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title4.jpg" border="0" usemap="#Map"/>
<map name="Map" id="Map">
<area shape="rect" coords="337,4,375,16" href="#" />
</map>
</div>
<div class="mid2_mcon">
<ul>
<!--注：此处最多13条-->
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-76423-page-1.html" target="_blank">8264户外科技体验区GORE-TEX展区人气火爆</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76230" target="_blank">HIGHROCK天石携登珠峰装备参展户外科技体验区</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76229" target="_blank"> 中天房车参展8264户外科技体验区 推动房车文化</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76246" target="_blank">8264户外科技体验区欣赏 长浩极限抱石攀岩馆</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76285" target="_blank">8264户外科技体验区 狼歌户外净水器现场演示</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76284" target="_blank">8264户外科技体验区 泊途全系列三防产品参展</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76292" target="_blank">户外科技体验区 GARMONT立足功能 引领时尚</a>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76293" target="_blank">AEE参展户外科技体验区 分享户外运动激情视野</a>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76211" target="_blank">体博会安踏展台现场伦敦奥运会冠军龙服揭晓</a>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76294" target="_blank">户外科技智慧运动 EZON震撼亮相户外科技体验区</a>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76027" target="_blank">8264户外科技体验区欣赏 GARMONT鞋的卓越科技</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76095" target="_blank">8264户外科技体验区欣赏 尖端科技应用于户外鞋</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=75999" target="_blank">8264户外科技体验区欣赏 狼歌让你在户外畅饮</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=74493" target="_blank">体博会祁玉麟：打造绿色低碳 助力民族品牌</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=75412" target="_blank">国家体育总局马继龙 近1200家企业参展体博会</a></li>
</ul>
</div>
</div>
<div class="mid2_r">
<div><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title5.jpg"/></div>
<div class="mid2_rcon">
<p> &#8226;&nbsp;2013年5月31日-6月2日(五、六、日)<br>
09:30--17:00(16:30后停止入场)<br>
<br>
&#8226;&nbsp;2013年6月3日(星期一)<br>
9:00--12:00<br>
</p>
</div>
<div style="margin-top:10px;"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title6.jpg"/></div>
<div class="mid2_rcon1">
<ul>
<li><a href="http://www.sportshow.com.cn/30th/zoning/" target="_blank">展区规划</a></li>
<li><a href="http://www.sportshow.com.cn/30th/traffic/" target="_blank">交通信息</a></li>
<li><a href="http://www.sportshow.com.cn/30th/restaurant/" target="_blank">餐饮指南</a></li>
<li><a href="http://www.sportshow.com.cn/30th/travel/" target="_blank">酒店住宿</a></li>
<li><a href="http://www.sportshow.com.cn/30th/lecture/" target="_blank">会议论坛</a></li>
<li><a href="http://www.sportshow.com.cn/30th/show/" target="_blank">竞赛表演</a></li>
<li><a href="http://www.sportshow.com.cn/30th/business/" target="_blank">商务洽谈</a></li>
<li><a href="http://www.sportshow.com.cn/30th/training/" target="_blank">培训体验</a></li>
</ul>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
</div>
<div class="mid3">
<div style="text-align:center"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title7.jpg"/></div>
<div class="mid3con">


<!--[diy=news]--><div id="news" class="area"><div id="framekN2tzL" class=" frame move-span cl frame-1"><div id="framekN2tzL_left" class="column frame-1-c"><div id="framekN2tzL_left_temp" class="move-span temp"></div><?php block_display('6880'); ?></div></div></div><!--[/diy]-->
<div class="clear"></div>
</div>
</div>
</div>
<div class="bottom"> <a href="http://www.8264.com/about-index.html" target="_blank">8264简介</a>&nbsp;|&nbsp;<a href="http://www.8264.com/about-adservice.html" target="_blank" >广告服务</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">户外热点</a>&nbsp;|&nbsp;<a href="http://www.8264.com/about-contact.html" target="_blank">联系我们</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank">QQ群联盟</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">户外网址大全</a>&nbsp;|&nbsp;<a href="http://www.8264.com/sitemap" target="_blank">网站地图</a><br>
服务热线：022-23708264&nbsp;|&nbsp;传真：022-23857291&nbsp;|&nbsp;地址：天津市南开区华苑产业园区鑫茂科技园C2座AB单元6层<br>
<a href="http://bx.8264.com" target="_blank">户外活动有风险，8264提醒您购买</a> <a href="http://bx.8264.com">户外保险</a><br>
除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264&nbsp;版权所有 <a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-10</a>&nbsp;&nbsp;&nbsp;<a href="/template/8264/image/icp.jpg" target="_blank">ICP证 津B2-20110106</a></div>
<script src="http://static.8264.com/oldcms/moban/zt/2013tibohui/js/common.js" type="text/javascript" type="text/javascript" language="javascript"></script> 

<?php if(empty($topic) || ($topic['usefooter'])) { ?> <?php $focusid = getfocus_rand($_G[basescript]); ?> 
<?php if($focusid !== null) { ?> <?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb"> <em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?></em> <span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="关闭">关闭</a></span> </h3>
<hr class="l" />
<div class="detail">
<h4><a href="<?php echo $focus['url'];?>" target="_blank"><?php echo $focus['subject'];?></a></h4>
<p> 
<?php if($focus['image']) { ?> 
<a href="<?php echo $focus['url'];?>" target="_blank"><img src="<?php echo $focus['image'];?>" onload="thumbImg(this, 1)" _width="58" _height="58" /></a> 
<?php } ?> 
<?php echo $focus['summary'];?> </p>
</div>
<hr class="l" />
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">查看</a> </div>
<?php } ?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?> 
<?php } ?>

<ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { ?> <?php if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { ?> 
<?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a>
</li>
<?php } ?> 
<?php } ?> 
<?php } ?>
</ul>

<?php if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly"> 积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分 </div>
<div class="mncr"></div>
</div>
<?php } ?> 

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
<?php } ?> <?php output(); ?> 
<!--dx代码结束-->

</body>
</html>
