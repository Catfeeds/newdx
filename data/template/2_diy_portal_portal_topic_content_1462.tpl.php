<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1462', 'common/header_diy');
block_get('6880');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>2013�й�������������������Ʒ������ | �岩�� | 8264 | ����װ�� | �Ƽ�װ��</title>
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
<a id="diy-tg" href="javascript:openDiy();" title="�� DIY ���"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a> 
<?php } ?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?> <?php include template('common/header_diy'); ?> 
<?php } ?> 
<?php if(empty($topic) || $topic['useheader']) { ?> <?php echo adshow("headerbanner/wp a_h"); ?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; ?> 
<?php } ?> 
<!--dx�������--> 
<!--diy��ʽ��ʼ-->
<style id="diy_style" type="text/css">#framekN2tzL {  margin:0px !important;border:0px none !important;}#portal_block_6880 {  margin:0px !important;border:0px none !important;}#portal_block_6880 .content {  margin:0px !important;}</style>
<!--diy��ʽ����-->
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
<li class="current"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=76210" target="_blank">�������̨���߲ɷ��岩��8264����Ƽ�������</a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=75161" target="_blank">8264����Ƽ������� �岩��չʾ˼·���߸���ͳ</a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=74493" target="_blank">�岩�������룺������ɫ��̼ ��������Ʒ��</a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=76095" target="_blank">8264����Ƽ����������� ��˿Ƽ�Ӧ���ڻ���Ь</a></li>
<li class="normal"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=76211" target="_blank">�岩�ᰲ̤չ̨�ֳ��׶ذ��˻�ھ���������</a></li>
</ul>
</div>
</div>
<div class="news1">
<div><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title1.jpg"/></div>
<div class="news1con">
<h2><a href="http://www.8264.com/viewnews-86332-page-1.html" target="_blank">��31���岩���ڶ࿴�㽫��Ϊ��ֵ�ù�עһ��</a></h2>
<ul>
<!--ע���˴����7��-->
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-81108-page-1.html" target="_blank">�����ҵ������� 2013�岩������·�ݻ����</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-76519-page-1.html" target="_blank">������չ��2013�岩�� ����չ���ڴ�������</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-81260-page-1.html" target="_blank">2012����̵� �岩����չ���Ƽ�������ҵ�ķ�չ</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-85352-page-1.html" target="_blank">�岩�������룺231����ҵ������չ�������ǧƽ</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-76107-page-1.html" target="_blank">�岩��8264����Ƽ������� �Ƽ��û������</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=75161" target="_blank">8264����Ƽ������� �岩��չʾ˼·���߸���ͳ</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-76519-page-1.html" target="_blank">������չ��2013�岩�� ����չ���ڴ�������</a></li>
</ul>
</div>
</div>
<div class="ty">
<div><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title2.jpg"/></div>
<p><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/1000.jpg"/><br>
8264����Ƽ������������岩��ٷ�ί��8264ȫȨ����滮�����չʾ��2013�꣬8264����Ƽ�����������������ͷ�����������ǡ��Ƽ��û�����򵥡���<a href="http://www.8264.com/viewnews-85877-page-1.html" target="_blank">[�˽����]</a></p>
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
<!--ע���˴����13��-->
<li>&#8226;&nbsp;<a href="http://www.8264.com/viewnews-76423-page-1.html" target="_blank">8264����Ƽ�������GORE-TEXչ��������</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76230" target="_blank">HIGHROCK��ʯЯ�����װ����չ����Ƽ�������</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76229" target="_blank"> ���췿����չ8264����Ƽ������� �ƶ������Ļ�</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76246" target="_blank">8264����Ƽ����������� ���Ƽ��ޱ�ʯ���ҹ�</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76285" target="_blank">8264����Ƽ������� �Ǹ軧�⾻ˮ���ֳ���ʾ</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76284" target="_blank">8264����Ƽ������� ��;ȫϵ��������Ʒ��չ</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76292" target="_blank">����Ƽ������� GARMONT���㹦�� ����ʱ��</a>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76293" target="_blank">AEE��չ����Ƽ������� �������˶�������Ұ</a>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76211" target="_blank">�岩�ᰲ̤չ̨�ֳ��׶ذ��˻�ھ���������</a>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76294" target="_blank">����Ƽ��ǻ��˶� EZON�����໧��Ƽ�������</a>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76027" target="_blank">8264����Ƽ����������� GARMONTЬ��׿Խ�Ƽ�</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=76095" target="_blank">8264����Ƽ����������� ��˿Ƽ�Ӧ���ڻ���Ь</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=75999" target="_blank">8264����Ƽ����������� �Ǹ������ڻ��⳩��</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=74493" target="_blank">�岩�������룺������ɫ��̼ ��������Ʒ��</a></li>
<li>&#8226;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=75412" target="_blank">���������ܾ������ ��1200����ҵ��չ�岩��</a></li>
</ul>
</div>
</div>
<div class="mid2_r">
<div><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title5.jpg"/></div>
<div class="mid2_rcon">
<p> &#8226;&nbsp;2013��5��31��-6��2��(�塢������)<br>
09:30--17:00(16:30��ֹͣ�볡)<br>
<br>
&#8226;&nbsp;2013��6��3��(����һ)<br>
9:00--12:00<br>
</p>
</div>
<div style="margin-top:10px;"><img src="http://static.8264.com/oldcms/moban/zt/2013tibohui/images/title6.jpg"/></div>
<div class="mid2_rcon1">
<ul>
<li><a href="http://www.sportshow.com.cn/30th/zoning/" target="_blank">չ���滮</a></li>
<li><a href="http://www.sportshow.com.cn/30th/traffic/" target="_blank">��ͨ��Ϣ</a></li>
<li><a href="http://www.sportshow.com.cn/30th/restaurant/" target="_blank">����ָ��</a></li>
<li><a href="http://www.sportshow.com.cn/30th/travel/" target="_blank">�Ƶ�ס��</a></li>
<li><a href="http://www.sportshow.com.cn/30th/lecture/" target="_blank">������̳</a></li>
<li><a href="http://www.sportshow.com.cn/30th/show/" target="_blank">��������</a></li>
<li><a href="http://www.sportshow.com.cn/30th/business/" target="_blank">����Ǣ̸</a></li>
<li><a href="http://www.sportshow.com.cn/30th/training/" target="_blank">��ѵ����</a></li>
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
<div class="bottom"> <a href="http://www.8264.com/about-index.html" target="_blank">8264���</a>&nbsp;|&nbsp;<a href="http://www.8264.com/about-adservice.html" target="_blank" >������</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">�����ȵ�</a>&nbsp;|&nbsp;<a href="http://www.8264.com/about-contact.html" target="_blank">��ϵ����</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank">QQȺ����</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">������ַ��ȫ</a>&nbsp;|&nbsp;<a href="http://www.8264.com/sitemap" target="_blank">��վ��ͼ</a><br>
�������ߣ�022-23708264&nbsp;|&nbsp;���棺022-23857291&nbsp;|&nbsp;��ַ��������Ͽ�����Է��ҵ԰����ï�Ƽ�԰C2��AB��Ԫ6��<br>
<a href="http://bx.8264.com" target="_blank">�����з��գ�8264����������</a> <a href="http://bx.8264.com">���Ᵽ��</a><br>
���˽�ӡʲô�������� ������Ӱʲô�������ߣ���ӭ����ý��ת�����ǵ�ԭ����Ʒ[ת����ע������]��8264&nbsp;��Ȩ���� <a href="http://www.miibeian.gov.cn/" target="_blank">��ICP��05004140��-10</a>&nbsp;&nbsp;&nbsp;<a href="/template/8264/image/icp.jpg" target="_blank">ICP֤ ��B2-20110106</a></div>
<script src="http://static.8264.com/oldcms/moban/zt/2013tibohui/js/common.js" type="text/javascript" type="text/javascript" language="javascript"></script> 

<?php if(empty($topic) || ($topic['usefooter'])) { ?> <?php $focusid = getfocus_rand($_G[basescript]); ?> 
<?php if($focusid !== null) { ?> <?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb"> <em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>վ���Ƽ�<?php } ?></em> <span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="�ر�">�ر�</a></span> </h3>
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
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">�鿴</a> </div>
<?php } ?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?> 
<?php } ?>

<ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar">�޸�ͷ��</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile">��������</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">��֤</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit">����</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup">�û���</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy">��˽ɸѡ</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail">�ʼ�����</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">���밲ȫ</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { ?> <?php if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { ?> 
<?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a>
</li>
<?php } ?> 
<?php } ?> 
<?php } ?>
</ul>

<?php if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly"> ���� <?php echo $_G['member']['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ���� </div>
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
<!--dx�������-->

</body>
</html>
