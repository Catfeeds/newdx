<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1371', 'common/header_diy');
block_get('2646,2647,2648,2649');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $topic['title'];?></title>
<meta name="Description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="Keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<!--[if IE 6]>
<script src="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->
<!-- diy ��ʼ -->
<style id="diy_style" type="text/css">#frame2pvLVu {  background-image:none !important;background-color:transparent !important;border:0px !important;}#frame5HYSoq {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#framedGPBsq {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#frame964EVv {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#frameMqEu8H {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_2646 {  margin:0px !important;border:0px !important;}#portal_block_2646 .content {  margin:0px !important;}#portal_block_2647 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_2647 .content {  margin:0px !important;}#portal_block_2648 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_2648 .content {  margin:0px !important;}#portal_block_2649 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_2649 .content {  margin:0px !important;}</style>
<base href="<?php echo $_G['siteurl'];?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?>
<?php echo $rsshead;?><?php } if($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') { if($_G['basescript'] == 'forum' && !empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
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
<!-- diy ���� -->
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<!-- diy ��ʼ -->
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="�� DIY ���"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>
<!-- diy ���� -->
<!-- header_zt start -->
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/css/style.css"/>
<div id="header_zt">
<div class="big_box">
<a href="http://www.500to5000.com/about.php" target="_blank" class="tit_a">�Ĺ����ɽ�ڽ���</a>
<a href="http://www.8264.com/portal.php?mod=view&amp;aid=68995" target="_blank" class="tit_b">ѩɽ���ֻ�</a>
<a href="#" target="_blank" class="tit_c">��Խѩɽ֮��</a>
<a href="http://www.8264.com/portal.php?mod=view&amp;aid=68996" target="_blank" class="tit_d">־Ը����ļ</a>
</div>
</div>
<!-- header_zt end -->
<!-- main_zt start -->
<div id="main_zt">
<div class="slide_box">
<div class="main_slide">
<!-- ��С 306x276 -->
<!--//hd�õ�//-->
<!--[diy=hd]--><div id="hd" class="area"><div id="frame2pvLVu" class=" frame move-span cl frame-1"><div id="frame2pvLVu_left" class="column frame-1-c"><div id="frame2pvLVu_left_temp" class="move-span temp"></div><?php block_display('2646'); ?></div></div></div><!--[/diy]-->
<!--//hd�õ�//-->
</div>
</div>
<div class="news_box">
<h2>
<a href="http://www.8264.com/viewnews-70367-page-1.html" target="_blank">2011�Ĺ���ɽ��ɽ����Ļ ��ɽ��Բѩɽ��</a>
</h2>
<ul class="art_list">
        <!--
         <li>��
<a href="#" target="_blank">����ó�����޹�˾����Ʒ�Ʒ���ó�����޹�˾����Ʒ��</a>
|
<a href="#" target="_blank">����ó�����޹�˾����Ʒ��</a>
</li>
             -->
&nbsp&nbsp&nbsp&nbsp���Ĺ���ɽ�羰��ʤ����������졢�Ĵ�ʡ��ɽ�����˶�Э��֧�֣���������Ʒ��KAILAS��VAUDE�����ġ�2011�Ĺ���ɽ��ɽ�ڡ���2011��ʮһ�ƽ����ڼ����������Ĺ���ɽ�ɹ��ٰ죬�н�ǧ��¿�Ѳ��뵽�˱��ε�ɽ����...
            <br>
            <br>
            <!--
         <li>��
<li>��
<a href="#" target="_blank">����ó�����޹�˾����Ʒ�Ʒ���ó�����޹�˾����Ʒ��</a>
|
<a href="#" target="_blank">����ó�����޹�˾����Ʒ��</a>
</li>
<li>��
<a href="#" target="_blank">����ó�����޹�˾����Ʒ�Ʒ���ó�����޹�˾����Ʒ��</a>
|
<a href="#" target="_blank">����ó�����޹�˾����Ʒ��</a>
</li>
</li>
             -->

</ul>
<h3>
        <!--<a href="#" target="_blank">�Ĺ����ɽ�ڵ�ɽ���ȵ㶯̬</a>-->
<a  target="_blank">��ɽ���ȵ㶯̬</a>
</h3>
<!--//news_list�б�//-->
<!--[diy=news_list]--><div id="news_list" class="area"><div id="frame964EVv" class=" frame move-span cl frame-1"><div id="frame964EVv_left" class="column frame-1-c"><div id="frame964EVv_left_temp" class="move-span temp"></div><?php block_display('2647'); ?></div></div></div><!--[/diy]-->
<!--//news_list�б�//-->
</div>
<div class="news_r_box">
<div class="mod_tit"><a href="http://www.500to5000.com/">2011�Ĺ���ɽ��ɽ�ڹ���</a></div>
<div class="mod_cont">
<a href="http://www.500to5000.com/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011kailas_siguniang/img/news_r.jpg" /></a>
</div>
</div>
<div class="mod_all">
<div class="mod_tit">ͼ�ı�����</div>
<div class="mod_cont pic_170px">
<!--//twpic����ͼƬ�б���ʽһByAndes//-->
<!--[diy=twpic]--><div id="twpic" class="area"><div id="framedGPBsq" class=" frame move-span cl frame-1"><div id="framedGPBsq_left" class="column frame-1-c"><div id="framedGPBsq_left_temp" class="move-span temp"></div><?php block_display('2648'); ?></div></div></div><!--[/diy]-->
<!--//twpic����ͼƬ�б���ʽһByAndes//-->
<div class="clear"></div>
</div>
</div>
<div class="mod_all">
<div class="mod_tit">¿�������Ĺ���ɽ��</div>
<div class="mod_cont pic_170px">
<!--//lypic����ͼƬ�б���ʽһByAndes//-->
<!--[diy=lypic]--><div id="lypic" class="area"><div id="frameMqEu8H" class=" frame move-span cl frame-1"><div id="frameMqEu8H_left" class="column frame-1-c"><div id="frameMqEu8H_left_temp" class="move-span temp"></div><?php block_display('2649'); ?></div></div></div><!--[/diy]-->
<!--//lypic����ͼƬ�б���ʽһByAndes//-->
<div class="clear"></div>
</div>
</div>
<div class="mod_all">
<div class="mod_tit"></div>
<div class="mod_cont tc_zt">
<div class="friend_link"></div>
</div>
</div>
<div class="clear"></div>
</div>
<!-- main_zt end -->
<!-- footer_zt start -->
<div id="footer_zt">
<p class="top_m">
<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264���</a>
|
<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank">������</a>
|
<a href="http://www.8264.com/list/531/" target="_blank">�༭���Ĺ���</a>
|
<a href="http://www.8264.com/template/8264/about/sitemap.html" target="_blank">վ���ͼ</a>
|
<a href="http://www.8264.com/zhuanti" target="_blank">�����ȵ�</a>
|
<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">��ϵ��ʽ</a>
|
<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank">QQȺ����</a>
|
<a href="http://8.8264.com/job/" target="_blank">8264��Ƹ</a>
|
<a href="http://www.8264.com/link/" target="_blank">��������</a>
</p>
<p> �������ߣ�022-23708264 | ���棺022-23857291 | ��ַ������л�Է��ҵ԰����ï��Ӫ�Ƽ�԰C2��6��AB��Ԫ</p>
<p>
<a href="http://bx.8264.com" target="_blank">�����з��գ�8264����������</a>
<a href="http://bx.8264.com">���Ᵽ��</a>
</p>
<p> ���˽�ӡʲô�������� ������Ӱʲô�������ߣ���ӭ����ý��ת�����ǵ�ԭ����Ʒ[ת����ע������]��8264 ��Ȩ����
<a href="http://www.miibeian.gov.cn/" target="_blank">��ICP��05004140��-10</a>
<a href="http://www.8264.com/template/8264/image/icp.jpg" target="_blank">ICP֤ ��B2-20110106</a>
</p>
</div>
<!-- footer_zt end -->
<!-- diy ��ʼ -->
<?php if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>
<!-- diy ���� -->
</body>
</html>
<!-- Andes Edition:2011-08-16 -->