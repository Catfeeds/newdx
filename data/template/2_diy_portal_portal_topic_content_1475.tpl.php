<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1475', 'common/header_diy');
block_get('6891,6892,6897,6898,6894');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<title><?php if(!empty($topic['title'])) { ?>
<?php echo $topic['title'];?>
<?php } if(!empty($navtitle)) { ?>
<?php echo $navtitle;?> -
<?php } if($_G['setting']['bbname']) { ?>
<?php echo $_G['setting']['bbname'];?> -
<?php } ?></title> 
<?php echo $_G['setting']['seohead'];?>
<meta name="keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="generator" content="8264" />
<meta name="author" content="8264.com" />
<meta name="copyright" content="2001-2010" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?>
<?php echo $rsshead;?>
<?php } if($_G['basescript'] == 'forum') { if(!empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
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

<!--�Լ���ʽ��ʼ-->
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2013yazhan/style/style2.css"/>
<!--�Լ���ʽ����-->
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="�� DIY ���">
<img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" />
</a>
<?php } ?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>
<!--dx�������-->
<!--diy��ʽ��ʼ-->
<style id="diy_style" type="text/css">#framehmY4DR {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6891 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6891 .content {  margin:0px !important;}#frameK55ZFL {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6892 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6892 .content {  margin:0px !important;}#frame1X6Z7n {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_6893 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_6893 .content {  margin:0px !important;}#frametwOPD3 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_6894 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_6894 .content {  margin:0px !important;}#frameQKjiQs {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_6896 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_6896 .content {  margin:0px !important;}#frame3e4fCr {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:#000000 0px !important;}#portal_block_6897 {  background-image:none !important;background-color:transparent !important;margin:0px !important;}#portal_block_6897 .content {  margin:0px !important;}#framejsR41m {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_6898 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:0px !important;}#portal_block_6898 .content {  margin:0px !important;}</style>
<!--diy��ʽ����-->


<!--[if IE 6]>
<script src="http://static.8264.com/oldcms/moban/zt/2013yazhan/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2013yazhan/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->
<!--ͷ��������ʼ-->
<div class="topTips"></div>
<div class="topAd"></div>

<!--ͷ����������-->
<div class="showBox" style="display:none;">
<div class="topBanner"></div>
        
<div style="width:980px; margin:-10px auto 10px auto;">
            <div style="float:left;"><a href="http://bbs.8264.com/thread-1782497-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/01.jpg" border="0" /></a></div>
            <div style="float:right"><a href="http://bbs.8264.com/thread-1788533-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/02.jpg" border="0" /></a></div>
            <div style="clear:both; line-height:0px; height:0px; font-size:0;"></div>
        </div>
        
<div class="nav">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/nav_top.jpg" border="0" usemap="#Map" />
<map name="Map" id="Map">
<area shape="rect" coords="2,2,139,33" href="http://www.8264.com/" target="_blank"/>
<area shape="rect" coords="148,7,271,33" href="#news" />
<area shape="rect" coords="285,8,413,32" href="#cover" />
<area shape="rect" coords="425,7,549,31" href="#product" />
<area shape="rect" coords="564,7,686,32" href="#activity" />
<area shape="rect" coords="704,7,825,33" href="#mm" />
<area shape="rect" coords="842,4,958,34" href="#booth" />
</map>
</div>
<div>
<div class="wap">
<div class="min">
<div class="min_1">
<div class="min_1tit">��չ�۽�</div>
<div class="min_lm">
<div id="focus_turn">
<ul id="focus_pic">
<li class="current">
<a href="http://www.8264.com/viewnews-88107-page-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/jiaodian.jpg" />
</a>
  </li>
<li class="normal">
<a href="http://www.8264.com/viewnews-87595-page-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/jiaodian2.jpg" />
</a>
</li>
<li class="normal">
<a href="http://www.8264.com/viewnews-78021-page-1.html" target="_blank">
<img src="http://image1.8264.com/portal/201207/27/010523grfect2et7fg81r4.jpg" />
</a>
</li>
</ul>
<ul id="focus_tx">
<li class="current">
<a href="#" target="_blank"></a>
</li>
<li class="normal">
<a href="#" target="_blank"></a>
</li>
<li class="normal">
<a href="#" target="_blank"></a>
</li>
</ul>
<div id="focus_opacity"></div>
</div>
</div>
<div class="min_1tit">��չ�۽�</div>
<div class="min_lm" style="height:200px;  text-align:center;">
<a href="http://www.8264.com/viewnews-87595-page-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/jiaodian2.jpg"  width="288" height="240"/>
</a>
</div>
</div>
<div class="min_2">
<a name="news"></a>
<div class="min_1tit">չ��ͷ��</div>
<div class="min_lm" style="height:245px;">
<!--[diy=zhtt]--><div id="zhtt" class="area"><div id="framehmY4DR" class=" frame move-span cl frame-1"><div id="framehmY4DR_left" class="column frame-1-c"><div id="framehmY4DR_left_temp" class="move-span temp"></div><?php block_display('6891'); ?></div></div></div><!--[/diy]-->

</div>
<div class="min_1tit">
<a href="http://www.asian-outdoor.com/html/Exhibitors/News/Exhibition%20news/" target="_blank" style="color:#8F3F1E;">��չ��̬</a>
</div>
<div class="min_lm" style="height:200px;">
<!--[diy=zhdt]--><div id="zhdt" class="area"><div id="frameK55ZFL" class=" frame move-span cl frame-1"><div id="frameK55ZFL_left" class="column frame-1-c"><div id="frameK55ZFL_left_temp" class="move-span temp"></div><?php block_display('6892'); ?></div></div></div><!--[/diy]-->
</div>
</div>
<div class="min_3">
<div class="min_1tit">չ�ᵹ��ʱ</div>
<div class="min_lm" style="height:155px;">
<div class="min_31">
<script type="text/javascript">
var urodz= new Date("Jul 24,2013"); 
var now = new Date(); 
var ile = urodz.getTime() - now.getTime(); 
var dni = Math.floor(ile / (1000 * 60 * 60 * 24)); 

if (dni > 1) 
document.write(dni+1)
else if (dni == 1) 
document.write("2") 
else if (dni == 0) 
document.write("1") 
else 
document.write("�ѿ�ʼ")
</script>
</div>
</div>
<div class="min_1tit">��չ�ֲ�</div>
<div class="min_lm" style="height:95px;">
<div class="min_32">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/shouce_2.jpg" border="0" usemap="#Map2" />
<map name="Map2" id="Map2">
<area shape="rect" coords="12,7,61,30" href="http://www.asian-outdoor.com/downloads/Manual for Outdoor Visitor 2013.pdf" target="_blank" />
<area shape="rect" coords="137,11,190,31" href="http://www.asian-outdoor.com/html/Travel%20&%20Accomodation/Overview/" target="_blank"/>
<area shape="rect" coords="13,59,61,79" href="http://www.asian-outdoor.com/html/Travel%20&%20Accomodation/Overview/" target="_blank" />
<area shape="rect" coords="141,60,189,79" href="http://www.asian-outdoor.com/visitor-reg.html" target="_blank" />

</map>
</div>
</div>
<div class="min_1tit">8264�ر�߻�</div>
<div class="min_lm" style="height:133px;">
<div class="min_33">
<ul>
<li>
&#8226;&nbsp;
<a href="http://bbs.8264.com/thread-1788533-1-1.html">8264ʮ����¿�����¾ۻ�</a>
</li>
<li>
&#8226;&nbsp;
<a href="http://bbs.8264.com/thread-1782497-1-1.html">��ɽ���塪��8264������Ӹ߷���̳</a>
</li                          
>
</ul>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<a name="booth"></a>
<div class="title11">����չ��</div>
<div class="min11">
<div class="zwt">
<a href="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/J.pdf" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/J.jpg"  />
</a>
</div>
<div class="zwt">
<a href="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/H.pdf" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/H.jpg"  />
</a>
</div>
<div class="zwt">
<a href="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/I.pdf" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/I.jpg"  />
</a>
</div>
<div class="zwt">
<a href="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/K.pdf" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/K.jpg"  />
</a>
</div>
<div class="clear"></div>
</div>
<!--��ǩ����-->
<a name="cover"></a>
<div class="title11">2013�߶˷�̸</div>
<div class="min2">
<!--[diy=gdft]--><div id="gdft" class="area"><div id="frame3e4fCr" class=" frame move-span cl frame-1"><div id="frame3e4fCr_left" class="column frame-1-c"><div id="frame3e4fCr_left_temp" class="move-span temp"></div><?php block_display('6897'); ?></div></div></div><!--[/diy]-->

<div class="clear"></div>
</div>

<!--2012�߶˷�̸����-->
<div class="title11">2013ŷ�޻���չ</div>
<div class="min3">
<div class="min3_1">
<div>
<a href="http://www.8264.com/viewnews-77661-page-1.html" target="">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/ouzhouhuwaizhan1.jpg" />
</a>
</div>
<p>
�¹�����ʱ��7��14�գ��Ƶ���˹����Ϊ��4��ĵ�20��ŷ�޻���չ��˹̹�ĺ��������Ļ�������췽ͳ�����ݣ���������93�����Һ͵�����21465���ڣ�2012����21730�������������½���42�����ҵ�913չ�̡� 31�����ҵ�1042��ý����ߣ�2012: 1019)�����˴�չ��EOG���鳤Mark Held�Դ˴�չ���ܽ����"���ڵ�ǰ�ľ��û�����չ�Ὺʼǰ�����źܶ಻ȷ���ԡ�������չ���������ǵõ��Ĵ�-������Ȼ��Ӱ�컧���ҵ����Ҫ���أ�ͬʱ�ոչ�ȥ��2013�ϰ������ǵĲ�ҵҲ�����źܶ���ս��Ȼ�����������ҵ���ɱ����Ż�����չ�������Ƕ�δ���Գ���ϣ����
<a href="http://www.8264.com/viewnews-87821-page-1.html" target="_blank" style="color:#F00; margin-left:10px;">[ȫ��]</a>
<a href="http://www.8264.com/viewnews-87782-page-1.html" target="_blank"  style="color:#F00; margin-left:10px;">[����]</a>
<a href="http://www.8264.com/list/733" target="_blank"  style="color:#F00; margin-left:10px;">[�����������]</a>
</p>
</div>
<div class="min3_2">
<div class="imgbox2">
<div class="imgbox2_img">
<a href="http://www.8264.com/viewnews-77714-page-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/oz-zhanhuitiyan.jpg" />
</a>
</div>
<div class="imgbox2_text">
<a href="http://www.8264.com/viewnews-77714-page-1.html" target="_blank">չ������</a>
</div>
</div>
<div class="imgbox2">
<div class="imgbox2_img">
<a href="http://www.8264.com/viewnews-88026-page-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/chuangxinpin.jpg" />
</a>
</div>
<div class="imgbox2_text">
<a href="http://www.8264.com/viewnews-88026-page-1.html" target="_blank">չ�Ứ��</a>
</div>
</div>
<div class="imgbox2">
<div class="imgbox2_img">
<a href="http://www.8264.com/viewnews-87855-page-3.html" target="_blank">
<img src=
"http://static.8264.com/oldcms/moban/zt/2013yazhan/image/xiezixinpin1.jpg" />
</a>
</div>
<div class="imgbox2_text">
<a href="http://www.8264.com/viewnews-87855-page-3.html" target="_blank">Ь��ƪ</a>
</div>
</div>
<div class="imgbox2">
<div class="imgbox2_img">
<a href="http://www.8264.com/viewnews-88066-page-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/fuzhuangxinpin1.jpg" />
</a>
</div>
<div class="imgbox2_text">
<a href="http://www.8264.com/viewnews-88066-page-1.html" target="_blank">��װƪ</a>
</div>
</div>
<div class="imgbox2">
<div class="imgbox2_img">
<a href="http://www.8264.com/viewnews-87865-page-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/zhangpengxinpin.jpg" />
</a>
</div>
<div class="imgbox2_text">
<a href="http://www.8264.com/viewnews-87865-page-1.html" target="_blank">����ƪ</a>
</div>
</div>
<div class="imgbox2">
<div class="imgbox2_img">
<a href="http://www.8264.com/viewnews-88008-page-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/panyanjixian1.jpg" />
</a>
</div>
<div class="imgbox2_text">
<a href="http://www.8264.com/viewnews-88008-page-1.html" target="_blank">���Ҽ���ƪ</a>
</div>
</div>
<div class="clear"></div>
</div>
<div class="min3_3"> <b>2013ŷ�޻�����Ʋ�ҵ�󽱰䷢��Ʒ���</b>
<p>
8264��www.8264.com)Ѷ���¹�ʱ��7��11�գ�2013ŷ�޻���չ��7��11-14�գ��ڷƵ���˹����չ���������ڿ�Ļ��չ�����գ���8��ŷ�޻����ҵ��ƴ󽱻�����Ҳͬ�ڷ�����������ѡ��������27�����ҵ�316����Ʒ������2012��������25�����ҵ�322����2011��������23�����ҵ�301����2010��������28�����ҵ�328 ����09����18������242����Ʒ����
</p>
<a href="http://www.8264.com/viewnews-87784-page-1.html" target="_blank" style="color:#F00; float:right;">[ȫ��]</a>
<div class="clear"></div>
<div class="imgbox21">
<div class="imgbox21_img">
<a href="http://www.8264.com/viewnews-87784-page-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/pic0.jpg" />
</a>
</div>
<div class="imgbox21_text">
<a href="http://www.8264.com/viewnews-87784-page-1.html" target="_blank">ŷ�޻���չƪ</a>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<!--2012ŷ�޻���չ����-->
<a name="product"></a>
<div class="title11">2013���޻���չװ����Ʒ</div>
<div class="min4">
<div class="zhuangbeitop">
<div class="zhuangbeitop_l">
<iframe width="700" scrolling="no" height="270" frameborder="0" src="http://static.8264.com/oldcms/moban/zt/2013yazhan/zblunbo1.html" marginheight="0" marginwidth="0"></iframe>

</div>
<div class="zhuangbeitop_r">

<!--[diy=ispozblist]--><div id="ispozblist" class="area"><div id="framejsR41m" class=" frame move-span cl frame-1"><div id="framejsR41m_left" class="column frame-1-c"><div id="framejsR41m_left_temp" class="move-span temp"></div><?php block_display('6898'); ?></div></div></div><!--[/diy]-->

</div>
<div style="clear:both;"></div>
</div>
<div class="zhuangbeidown">
<!--[diy=zbtw]--><div id="zbtw" class="area"><div id="frametwOPD3" class=" frame move-span cl frame-1"><div id="frametwOPD3_left" class="column frame-1-c"><div id="frametwOPD3_left_temp" class="move-span temp"></div><?php block_display('6894'); ?></div></div></div><!--[/diy]-->
</div>
</div>
<!--2012ŷ�޻���չװ����Ʒ����-->
<a name="activity"></a>
<div class="title11">2013���޻���չװ�ٷ��</div>
<div class="min5">
<div class="imgbox3">
<div class="imgbox3_tit">
<div align="center">
<a href="http://www.asian-outdoor.com/html/Supportingprogramme/AWARD/" target="_blank"> <strong>���޻����ҵ��</strong>
</a>
</div>
</div>
<div>
<a href="http://www.asian-outdoor.com/html/Supportingprogramme/AWARD/" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/hd10.jpg" />
</a>
  </div>
<div class="imgbox3_text">
ʱ�䣺7��25��
<br />
�ص㣺չ���ֳ�
</div>
</div>
<div class="imgbox3">
<div class="imgbox3_tit">
<div align="center">
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Schedule/" target="_blank"> <strong>��ҵ��չ��̳</strong>
</a>
</div>
</div>
<div>
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Schedule/" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/hd11.jpg" />
</a>
  </div>
<div class="imgbox3_text">
ʱ�䣺7��25��
<br />
�ص㣺B02
</div>
</div>
<div class="imgbox3">
<div class="imgbox3_tit">
<div align="center">
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Slacklining/" target="_blank">
<strong>�����</strong>
</a>
</div>
</div>
<div>
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Slacklining/" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/hd12.jpg" />
</a>
  </div>
<div class="imgbox3_text">
ʱ�䣺7��24��-27��
<br />
�ص㣺չ���ֳ�
</div>
</div>
<div class="imgbox3">
<div class="imgbox3_tit">
<div align="center">
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Tent%20City/" target="_blank">
<strong>������</strong>
</a>
</div>
</div>
<div>
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Tent%20City/" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/hd13.jpg" />
</a>
  </div>
<div class="imgbox3_text">
ʱ�䣺7��24��-27��
<br />
�ص㣺C����D��
</div>
</div>
<div class="imgbox3">
<div class="imgbox3_tit">
<div align="center">
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Climbing%20Competitions/" target="_blank">
<strong>�ʵǽ�</strong>
<strong></strong>
</a>
</div>
</div>
<div>
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Climbing%20Competitions/" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/hd14.jpg" />
</a>
  </div>
<div class="imgbox3_text">
ʱ�䣺7��24��25��
<br />
�ص㣺C��������
</div>
</div>
<div class="imgbox3">
<div class="imgbox3_tit">
<div align="center">
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Fashion%20Show/" target="_blank">
<strong>��װ��</strong>
<strong></strong>
</a>
</div>
</div>
<div>
<a href="http://www.asian-outdoor.com/html/Supporting%20programme/Fashion%20Show/" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/hd15.jpg" />
</a>
  </div>
<div class="imgbox3_text">
ʱ�䣺7��24��27��
<br />
�ص㣺AB��¼��
</div>
</div>
<div class="clear"></div>
</div>
<!--2012���޻���չװ���ٷ������-->

<div class="title11">2013���޻���չ8264չλͼ��</div>
<div class="min6">
<div class="min6_l">
<img src="http://image1.8264.com/portal/201207/27/0206058tsw4dkhtu4hfszd.jpg" />
</div>
<div class="min6_r">
<div class="min6_r_img">
<img src="http://image1.8264.com/portal/201207/27/020614nk5nd5eey3xkte53.jpg" />
</div>
<div class="min6_r_img">
<img src="http://image1.8264.com/portal/201207/27/0206224woyyz8ewzoj2bz4.jpg" />
</div>
<div class="min6_r_img">
<img src="http://image1.8264.com/portal/201207/27/020630aaqddtpf7gqlq3p7.jpg" />
</div>
<div class="min6_r_img">
<img src="http://image1.8264.com/portal/201207/27/020638gtaqgz9sqkq3ag93.jpg" />
</div>
<div class="min6_r_img">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/zhanweitu01.jpg" />
</div>
<div class="min6_r_img">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/zhanweitu02.jpg" />
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<!--2012���޻���չ8264չλͼ������-->
<a name="mm"></a>
<div class="title11" style="display:none;">������Ů</div>
<div class="min7" style="display:none;">
<div class="min71">
<div class="min71_bigimg">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv01.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">��Ů</a>
</div>
</div>
<div class="min71_small">
<div class="min71_smallbox">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv04.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">������Ů</a>
</div>
</div>
<div class="min71_smallbox">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv05.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">�����ڸ�ɶ</a>
</div>
</div>
<div class="min71_smallbox">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv06.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">������Ů</a>
</div>
</div>
<div class="min71_smallbox">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv07.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">�ɰ�����Ů</a>
</div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="min71">
<div class="min71_small">
<div class="min71_smallbox1">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv08.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">����Ů��</a>
</div>
</div>
<div class="min71_smallbox1">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv02.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">����ѽ</a>
</div>
</div>
<div class="min71_smallbox1">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv03.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">���������</a>
</div>
</div>
<div class="min71_smallbox1">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv09.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">һ�Զ���Ů</a>
</div>
</div>
<div class="clear"></div>
</div>
<div class="min71_bigimg">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/meinv01.jpg" />
</a>
<div style="text-align:center; margin-top:5px;">
<a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">��Ů</a>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<!--������Ů����-->
<div class="bottom">
<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264���</a>
&nbsp;|&nbsp;
<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank" >������</a>
&nbsp;|&nbsp;
<a href="http://www.8264.com/zhuanti" target="_blank">�����ȵ�</a>
&nbsp;|&nbsp;
<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">��ϵ��ʽ</a>
&nbsp;|&nbsp;
<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank" >QQȺ����</a>
&nbsp;|&nbsp;
<a href="http://www.8264.com/link/" target="_blank">������ַ��ȫ</a>
<br>
�������ߣ�022-23708264&nbsp;|&nbsp;���棺022-23857291&nbsp;|&nbsp;��ַ������л�Է��ҵ԰����ï�Ƽ�԰C2��6��AB��Ԫ
<br>
<a href="http://bx.8264.com" target="_blank">�����з��գ�8264����������</a>
<a href="http://bx.8264.com">���Ᵽ��</a>
<br>
���˽�ӡʲô�������� ������Ӱʲô�������ߣ���ӭ����ý��ת�����ǵ�ԭ����Ʒ[ת����ע������]��8264&nbsp;��Ȩ����
<a href="http://www.miibeian.gov.cn/" target="_blank">��ICP��05004140��-10</a>
&nbsp;&nbsp;&nbsp;
<a href="http://static.8264.com/oldcms/moban/zt/2013yazhan/image/icp.jpg" target="_blank">ICP֤ ��B2-20110106</a>
</div>
<!--�ײ�����-->
</div>
</div>

</div>

<!--dx���뿪ʼ-->
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?><!--dx�������-->
<!--dx���뿪ʼ-->
<!--//waper����//-->
<?php if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb"> <em><?php if($_G['cache']['focus']['title']) { ?>
<?php echo $_G['cache']['focus']['title'];?>
<?php } else { ?>
վ���Ƽ�
<?php } ?></em> 
<span>
<a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="�ر�">�ر�</a>
</span>
</h3>
<hr class="l" />
<div class="detail">
<h4>
<a href="<?php echo $focus['url'];?>" target="_blank"><?php echo $focus['subject'];?></a>
</h4>
<p>
<?php if($focus['image']) { ?>
<a href="<?php echo $focus['url'];?>" target="_blank">
<img src="<?php echo $focus['image'];?>" onload="thumbImg(this, 1)" _width="58" _height="58" />
</a>
<?php } ?><?php echo $focus['summary'];?></p>
</div>
<hr class="l" />
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">�鿴</a>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; } ?>
<ul id="usersetup_menu" class="p_pop" style="display:none;">
<li>
<a href="home.php?mod=spacecp&amp;ac=avatar">�޸�ͷ��</a>
</li>
<li>
<a href="home.php?mod=spacecp&amp;ac=profile">��������</a>
</li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li>
<a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">��֤</a>
</li>
<?php } ?>
<li>
<a href="home.php?mod=spacecp&amp;ac=credit">����</a>
</li>
<li>
<a href="home.php?mod=spacecp&amp;ac=usergroup">�û���</a>
</li>
<li>
<a href="home.php?mod=spacecp&amp;ac=privacy">��˽ɸѡ</a>
</li>
<?php if($_G['setting']['sendmailday']) { ?>
<li>
<a href="home.php?mod=spacecp&amp;ac=sendmail">�ʼ�����</a>
</li>
<?php } ?>
<li>
<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">���밲ȫ</a>
</li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] >
0 && $module['adminid'] >= $_G['adminid'])) { ?>
<li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>>
<a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a>
</li>
<?php } } } ?>
</ul>
<?php if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly">
���� <?php echo $_G['member']['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ����
</div>
<div class="mncr"></div>
</div>
<?php } if(!$_G['setting']['bbclosed']) { if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_G['gp_do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<?php } ?><?php output(); ?><!--dx�������-->

<script src="http://www.8264.com/static/js/jquery-1.6.1.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($) {
setTimeout(function() {
$('.topAd').hide();
$('.topTips').show();
$('.showBox').show();
},
2000);

$('.topTips').click(function() {
$('.topTips').hide();
$('.showBox').hide();
$('.topAd').show();
setTimeout(function() {
$('.topAd').hide();
$('.topTips').show();
$('.showBox').show();
},
2000);
})
})(jQuery);
</script>
</body>
</html>