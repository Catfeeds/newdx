<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1397', 'common/header_diy');
block_get('3880,3884,3874,3875,3881,3883,3876,3877,3882,3878,3879');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<title>ISPO BEIJING |�˶�չ|ʱ��չ|����չ|����չ|������Ʒչ| �����˶���Ʒ��ʱ��չ| 2012 ispo</title>
<?php echo $_G['setting']['seohead'];?>

<meta name="keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="generator" content="8264" />
<meta name="author" content="8264.com" />
<meta name="copyright" content="2001-2010" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<base href="<?php echo $_G['siteurl'];?>" />
<!--�Լ�js��ʼ-->
<script src="http://static.8264.com/oldcms/moban/zt/2012ispo/js/common.js" type="text/javascript" type="text/javascript" language="javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2012ispo/js/jquery-1.4.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2012ispo/js/jquery.lazy-1.3.1.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function(){
  jQuery.lazy({src:'http://static.8264.com/oldcms/moban/zt/2012ispo/js/jquery.darizi.js',name:'darizi',dependencies:{js:['http://static.8264.com/oldcms/moban/zt/2012ispo/js/jquery.countdown.js']},cache:true});
  // ������
  var ndate = new Date(2012,1,22); 
  jQuery('.darizi').darizi({ bigDay:ndate,last:3});

});
</script>
<!--�Լ�js����--><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
 
 <?php if(defined('CURMODULE') && ($_G['basescript'] == 'forum' || $_G['basescript'] == 'group') && (CURMODULE == 'index' || CURMODULE == 'forumdisplay' || CURMODULE == 'group')) { ?><?php echo $rsshead;?><?php } if($_G['basescript'] == 'forum') { if(!empty($_G['cookie']['widthauto']) && empty($_G['disabledwidthauto'])) { ?>
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
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>
<a id="diy-tg" href="javascript:openDiy();" title="�� DIY ���"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>   
<!--dx�������-->
<!--diy��ʽ��ʼ-->
<style id="diy_style" type="text/css">#frameJLaWDL {  margin:0px !important;border:medium none !important;}#portal_block_3874 {  margin:0px !important;border:medium none !important;}#portal_block_3874 .content {  margin:0px !important;}#frame4MG42a {  margin:0px !important;border:medium none !important;}#portal_block_3875 {  margin:0px !important;border:medium none !important;}#portal_block_3875 .content {  margin:0px !important;}#frames8esue {  margin:0px !important;border:medium none !important;}#portal_block_3876 {  margin:0px !important;border:medium none !important;}#portal_block_3876 .content {  margin:0px !important;}#frameo4k4j4 {  margin:0px !important;border:medium none !important;}#portal_block_3877 {  margin:0px !important;border:medium none !important;}#portal_block_3877 .content {  margin:0px !important;}#frameNJXzx8 {  margin:0px !important;border:medium none !important;}#portal_block_3878 {  margin:0px !important;border:medium none !important;}#portal_block_3878 .content {  margin:0px !important;}#framewc9NaI {  margin:0px !important;border:medium none !important;}#portal_block_3879 {  margin:0px !important;border:medium none !important;}#portal_block_3879 .content {  margin:0px !important;}#frameA7EoO4 {  margin:0px !important;border:medium none !important;}#portal_block_3880 {  margin:0px !important;border:medium none !important;}#portal_block_3880 .content {  margin:0px !important;}#frameGKBOz7 {  margin:0px !important;border:medium none !important;}#portal_block_3881 {  margin:0px !important;border:medium none !important;}#portal_block_3881 .content {  margin:0px !important;}#frame5arRTv {  margin:0px !important;border:medium none !important;}#portal_block_3882 {  margin:0px !important;border:medium none !important;}#portal_block_3882 .content {  margin:0px !important;}#frameYjAK3o {  margin:0px !important;border:medium none !important;}#portal_block_3883 {  margin:0px !important;border:medium none !important;}#portal_block_3883 .content {  margin:0px !important;}#frame214221 {  margin:0px !important;border:medium none !important;}#portal_block_3884 {  margin:0px !important;border:medium none !important;}#portal_block_3884 .content {  margin:0px !important;}</style>
<!--diy��ʽ����-->
<!--�Լ���ʽ��ʼ-->
<link href="http://static.8264.com/oldcms/moban/zt/2012ispo/style/style.css" rel="stylesheet" type="text/css" />
<!--�Լ���ʽ����-->
<div class="warpper">
<div class="warpper_960">
        <!--������ʼ-->
        <div class="navall"><a href="http://www.8264.com/" target="_blank">8264��ҳ</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/topic/1397.html#n1">չ�ᶯ̬</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n2">չ���ͼ</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n10">չλ���</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n3">����ר��</a>&nbsp;|&nbsp;<a href="http://www.8264.com/topic/1397.html#n4">ר��</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n5">��Ʒ</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n6">¿�ѿ�ispo</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n7">��Ƶ</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n8">����</a>&nbsp;|&nbsp;<a href="/topic/1397.html#n9">��Ů</a></div>
        <!--��������-->
        <!--��һ���ֿ�ʼ-->
        <div class="mid">
        	<div class="l">
            	<!--�ֲ���ʼ-->
            	<div class="lunboall">
                	<div class="ltitle1">�����ע</div>
                    <div class="lunbo">
                        <!--//�ֲ�//-->
            			<!--[diy=lunbo]--><div id="lunbo" class="area"><div id="frameA7EoO4" class=" frame move-span cl frame-1"><div id="frameA7EoO4_left" class="column frame-1-c"><div id="frameA7EoO4_left_temp" class="move-span temp"></div><?php block_display('3880'); ?></div></div></div><!--[/diy]-->
                    </div>
                </div>
                <!--�ֲ�����-->
                <div class="l2">
                	<div class="zhinantitle">��չָ��</div>
                    <div class="zn">
                    	<ul>
                        	<li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73366" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn1.jpg"></a></li>
                            <li><a href="http://j.map.baidu.com/XIE3" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn2.jpg"></a></li>
                            <li><a href="http://j.map.baidu.com/oIE3" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn3.jpg"></a></li>
                            <li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73367" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn4.jpg"></a></li>
                            <li><a href="http://www.weather.com.cn/weather/101010100.shtml" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn5.jpg"></a></li>
                            <li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73368" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zn6.jpg"></a></li>
                        </ul>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </div>
            <div class="m">
            	<div class="m1">
                	<div class="mtitle">չ��ͷ��</div>
                    <div class="mcon">
<div class="toutiaocon">�ڰ˽������˶���Ʒ��ʱ��չ��2012��2��22����25���ڼ���У�8264����С�齫��Ϊ��������һ��չ����Ѷ����Ʒ��װ����Ʒ��Ѷ����ӭ����ע��ר�⡣</div>
                        <!--//չ��ͷ�� 10�� ���ⳤ��30//-->
            			<!--[diy=zhtt]--><div id="zhtt" class="area"><div id="frame214221" class=" frame move-span cl frame-1"><div id="frame214221_left" class="column frame-1-c"><div id="frame214221_left_temp" class="move-span temp"></div><?php block_display('3884'); ?></div></div></div><!--[/diy]-->
 </div>
                </div>
                <div class="m1">
                	<div class="mtitle">չ���Ѷ<a name="n1"></a></div>
                    <div class="toutiaolist">
                        <!--//ͷ���б� 12�� ���ⳤ��30//-->
            			<!--[diy=ttlist]--><div id="ttlist" class="area"><div id="frameJLaWDL" class=" frame move-span cl frame-1"><div id="frameJLaWDL_left" class="column frame-1-c"><div id="frameJLaWDL_left_temp" class="move-span temp"></div><?php block_display('3874'); ?></div></div></div><!--[/diy]-->
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div class="r">
                <div class="darizi">
                    <div class="zhengjishi"><span class="shu"></span></div>
                    <div class="daojishi"><span class="shu"></span></div>
                    <div class="jieshule"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/bm.gif"></div>
                </div>
                <div class="r1">
                	<ul>
                    	<li><a href="http://www.ispo.com.cn/beijing/templates_home_article.aspx?classid=928777282620"  style="color:#FF0000" target="_blank">¿������ע��ԤԼ��չ</a></li>
                        <li><a href="http://bbs.8264.com/thread-1145472-1-1.html" style="color:#FF0000" target="_blank">�ڶ���8264¿�ѹ�������</a></li>
                        <li><a href="http://bbs.8264.com/forum-viewthread-tid-1141385-fromuid-34143033.html" target="_blank">8264ÿ��һͼȫ��Ѳ��չ</a></li>
<li><a href="http://bbs.8264.com/thread-1002655-1-1.html" target="_blank">2012¶Ӫ����������</a></li>
                        <li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73373" target="_blank">2012 �й�������������̳</a></li>
<li><a href="http://www.8264.com/viewnews-73751-page-1.html" target="_blank">�������Ϭţ���佱����</a></li>
<li><a href="http://www.8264.com/portal.php?mod=view&amp;aid=73369" target="_blank">KAILAS��Ī���׵Ƿ����</a></li>
<li><a href="http://bbs.8264.com/forum-viewthread-tid-1150917-fromuid-34170351.html" target="_blank">26�ն���ɽһ�մ�Խ</a></li>

                    </ul>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--��һ���ֽ���-->
        <!--ר�ÿ�ʼ-->
        <div class="mid">
        	<div class="title960"><a href="http://www.8264.com/portal-list-catid-746.html">չ���̸</a><a name="n4"></a></div>
            <div class="zf">
                <div class="zf_l">
                    <div class="zfimgbg1" id="sh_tip1" onmousemove="slide_ty(1)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/herundong.jpg"></div>
                    <div class="zfimgbg" id="sh_tip2" onmousemove="slide_ty(2)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/phenix.jpg"></div>
                    <div class="zfimgbg" id="sh_tip3" onmousemove="slide_ty(3)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/toread.jpg"></div>

                    <div class="zfimgbg" id="sh_tip4" onmousemove="slide_ty(4)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kingcamp.jpg"></div>
                    <div class="zfimgbg" id="sh_tip5" onmousemove="slide_ty(5)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/northland.jpg"></div>
                    <div class="zfimgbg" id="sh_tip6" onmousemove="slide_ty(6)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/Kroceus.jpg"></div>
                    <div class="zfimgbg" id="sh_tip7" onmousemove="slide_ty(7)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/youdo.jpg"></div>
                    <div class="zfimgbg" id="sh_tip8" onmousemove="slide_ty(8)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/vb.jpg"></div>
                    <div class="zfimgbg" id="sh_tip9" onmousemove="slide_ty(9)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/shanlinlu.jpg"></div>
                    <div class="zfimgbg" id="sh_tip10" onmousemove="slide_ty(10)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kolumb.jpg"></div>
                    <div class="zfimgbg" id="sh_tip11" onmousemove="slide_ty(11)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/yisijia.jpg"></div>
                    <div class="zfimgbg" id="sh_tip12" onmousemove="slide_ty(12)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/huofeng.jpg"></div>
<div class="zfimgbg" id="sh_tip13" onmousemove="slide_ty(13)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/Gregory.jpg"></div>
<div class="zfimgbg" id="sh_tip14" onmousemove="slide_ty(14)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ACTIONFOX.jpg"></div>
<div class="zfimgbg" id="sh_tip15" onmousemove="slide_ty(15)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kingcamp2.jpg"></div>
<div class="zfimgbg" id="sh_tip16" onmousemove="slide_ty(16)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ZEROFIT.jpg"></div>
<div class="zfimgbg" id="sh_tip17" onmousemove="slide_ty(17)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/phenix2.jpg"></div>
<div class="zfimgbg" id="sh_tip18" onmousemove="slide_ty(18)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kailas.jpg"></div>
<div class="zfimgbg" id="sh_tip19" onmousemove="slide_ty(19)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ozark.jpg"></div>
<div class="zfimgbg" id="sh_tip20" onmousemove="slide_ty(20)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/DexShell.jpg"></div>
<div class="zfimgbg" id="sh_tip21" onmousemove="slide_ty(21)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/shuxingke.jpg"></div>
<div class="zfimgbg" id="sh_tip22" onmousemove="slide_ty(22)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/CORDURA.jpg"></div>
<div class="zfimgbg" id="sh_tip23" onmousemove="slide_ty(23)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/scarpa.jpg"></div>
<div class="zfimgbg" id="sh_tip24" onmousemove="slide_ty(24)"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/dauter.jpg"></div>
                    <div style="clear:both"></div>
                </div>
                <div class="zf_r" id="sh_ce_p">
<div class="zf_r_one" id="ce_pic1" onmousemove="slide_ty(1)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73730.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/herundongd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73730.html" target="_blank">8264����ר�� ���ߵ������ʹ����[��Ƶ]</a></h1>					 ISPO BEIJING 2012չ����е��ڶ��죬���ߵ���������ˡ�����Ӱ�Ǻ���ݰ��չ�ᣬ��ϯ���ߵѡ���ɫ�ж� �̶�ȫ�ǡ����滷���ж����״η�����ʽ..</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic2" onmousemove="slide_ty(2)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73721.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/phenixd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73721.html" target="_blank">Phenix��װɫ�ʴ���ʦ�Բ� ��Ʒ������ѧ��</a></h1>					
�ձ�����ʱ�г�����������һ�㣬����������ǰ��չ�Ĺ����С����ڣ����������ճ�����Ҳ�ǳ����Ĵ���������ͨ������������ý���������...</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic3" onmousemove="slide_ty(3)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73691.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/toreadd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73691.html" target="_blank">ISPO BEIJING 2012 �ɷ�̽·���ܾ������</a></h1>2��22-25�գ�2012 ISPO BEIJING�ڹ��һ������ľ��У�8264�Դ˽��б����ɷá�������8264��̽·���ܾ�����꿲ɷ�...��</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic4" onmousemove="slide_ty(4)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73696.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kingcampd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73696.html" target="_blank">������Ұ����� ����Ʒ������ ������ͥ����</a></h1>					2012�꣬������Ұ�ڲ�Ʒϵ�п����Ͻ�ͻ���ص㣬�����⡢Ʒ�ࡢƷ�ֽ�Χ��Ӫ������һ���ļ�����2010�꣬������Ұ�����������ͥ���⡱�����Χ�Ƽ�ͥ��������һϵ�е�����</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic5" onmousemove="slide_ty(5)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73694" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/northlandd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73694.html" target="_blank">ר��ŵʫ������ 2012��Ʒ�ƹ滮�׸�ִ����</a></h1>					2011�꣬ŵʫ��Ʒ����ȷ��Ʒ�Ʒ�չĿ���볤Զ�滮��2012�꽫��ŵʫ��Ʒ�Ʒ�չ�滮�ĵ�һ��ִ���ꡣ�⽫����ŵʫ��Ʒ�����������������Ż�����Ӧ�����ϵȶ෽����¾ٴ롣</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic6" onmousemove="slide_ty(6)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73706.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/Kroceusd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73706.html" target="_blank">��KROCEUS ��չ��������ռ�и�����г��ݶ�</a></h1>					KROCEUS��Ҫ�������Ŀ��أ��ص㷢չ���г��������г��ݶ���о�����չ�����г���ȥ���°��꿪��8��9�ң�����һЩ�д����ԵĻ���꣬��������չ����ȡ��һ����ͻ�ơ�</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic7" onmousemove="slide_ty(7)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73676.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/youdod.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73676.html" target="_blank">�ƶ�Ʒ��ȫ�¶�λ ISPO BEIJING2112�ƶ�ר��</a></h1>	
��һ���ƶ���ֱӪ�귽�����ĳ��ԣ������Ž�����������ꡣ�ڶ����ƶȽ�Ʒ�ƶ�λ��ԭ����"��;��������"��չΪ"��ĩ��������װ����һƷ��"...</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic8" onmousemove="slide_ty(8)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73738.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/vbm.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73738.html" target="_blank">Vibram�й��ܾ������ �����˽�������ָЬ</a></h1>					8264��Vibram�й��ܾ�����ۺ��й������ܾ���Joe���вɷã�������ָЬ���ܡ���Щ�й�����Ʒ����ʹ��VibramЬ���Լ�������׼����ָЬ���й�������������..</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic9" onmousemove="slide_ty(9)">
                    <div class="zf_imgb"><a href="http://www.8264.com/viewnews-73736-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/shanlinlud.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/viewnews-73736-page-1.html" target="_blank">ɽ��·ר�� δ������ɽ��·Ҫ������ҵ����</a></h1>	
��ɽ��·Ʒ����1992�������Ǽ�����������������Ҫ���������ۻ����˶����Ρ�1996��Ϊ�˹�˾��ȫ��ս�ԣ��ں����������������أ�����Ա����2000��...</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic10" onmousemove="slide_ty(10)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73732.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kolumbd.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/73732.html" target="_blank">Kolumb��ά�� ��ʵ��Ӫ���� ץ�ü�ֵ������</a></h1>
��ע��KolumbƷ�Ƶ�ʱ���뺽���ҡ����ײ��������������������ֺ�̽�����Ǻ����ľ��񣬵����Ǹ���ע�����˶������е���Ȥ�����KolumbƷ�ƵĿں��ǡ����ڷ��֡�</div>
                    </div>
<div class="zf_r_one" id="ce_pic11" onmousemove="slide_ty(11)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73654.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/yisijiad.jpg"/></a></div>
                    <div class="zf_imginfo">
                    <h1><a href="http://www.8264.com/73654.html" target="_blank">��˼����ȫ�� ȫϵ�в�Ʒ �̳����� ׷������</a></h1>����ISPOչ�ᣬ��˼��Ʒ�ƽ��ص�չʾ2012�����¿�Ƥ���������Ʒ�������Ʒ����˼��������ձ�������Ŀǰ��������Ҳ�ǳ���</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic12" onmousemove="slide_ty(12)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73653.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/huofengd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73653.html" target="_blank">�����й�����¯����NO.1 ר�û�����춥</a></h1>	
    ���Ʒ��������רҵ����¯���߷����²�Ʒ���з�����רҵ�Ļ���¯����Ʒ�ƣ����ڸ������кܸߵ��г�ռ���ʡ�Ȼ�����۶�ǻ��Ʒ�ƵĽ���Ŀ�꣬���Ʒ�ƽ����㳤Զ...</div>
                    </div>
<div class="zf_r_one" id="ce_pic13" onmousemove="slide_ty(13)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73655.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/Gregoryd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73655.html" target="_blank">Gregory���� 2012�꽫�ص����Ƴ��п��</a></h1>	
Gregory�����й����꣬ǰ�������Ƽ����2011�꣬�����˳��п��Ʒ��2012�꣬���ص��ƹ���п��Ʒ...</div>
                    </div>
<div class="zf_r_one" id="ce_pic14" onmousemove="slide_ty(14)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73843.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ACTIONFOXd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73843.html" target="_blank">ActionfoxЯ��Ʒ���Ь��չispoŬ�������Ʒ��</a></h1>	
2011���Actionfox�Ѿ��������Ŀ�꣬��������ҵ���Ȳ�������Ҳʵ��ȫ�����۵��Ȳ�����...</div>
                    </div>
<div class="zf_r_one" id="ce_pic15" onmousemove="slide_ty(15)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73821.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kingcamp2d.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73821.html" target="_blank">KingCamp��ʼ�������̸ʮ�괴ҵ��չ����</a></h1>	
��2002�����������ҵ��λ��ְ������촴���˻���Ʒ��KingCamp�����������ɹ���Ʒ�ơ����������������...</div>
                    </div>
<div class="zf_r_one" id="ce_pic16" onmousemove="slide_ty(16)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73826.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ZEROFITd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73826.html" target="_blank">����ר�� ZEROFIT����߶˻���ѹ����������</a></h1>	
ׯ����������ר���н�����ѹ���˶����µ�ȫ��չʷ���书�������Լ�ZEROFITƷ�������ɫ�Ĳ�ͬ���������޷�Ӻϼ���...</div>
                    </div>
<div class="zf_r_one" id="ce_pic17" onmousemove="slide_ty(17)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73825.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/phenixd2.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73825.html" target="_blank">PHENIX�ｨ�� �á�������ѧ������Ӱ�컧����</a></h1>	
PHENIXƷ���ܾ����ｨ������8264չλ�����˼��ߵ�ר�ã���PHENIXƷ�ƶԻ����ʱ�е�̬��...</div>
                    </div>
<div class="zf_r_one" id="ce_pic18" onmousemove="slide_ty(18)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73824.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/kailasd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73824.html" target="_blank">KAILASδ��֮·����������רҵ�����ʵ�Ʒ��</a></h1>	
�ɷ���KAILASƷ���г��ܼึ�Կ�̸���˺ܶ���ڻ�����ҵ��KAILAS�ķ�չ���Ƽ�δ���Ķ�λ�Լ�2012��������չ�滮������...</div>
                    </div>
<div class="zf_r_one" id="ce_pic19" onmousemove="slide_ty(19)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73823.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/ozarkd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73823.html" target="_blank">OzarkƷ���ܼ���� �ƶ�Ozark��Ԫ���Ƚ���չ</a></h1>	
������Ʒ���ܼ��������8264չλ�����˼��ߵ�ר�ã��������а�����Ʒ�Ƶķ�չ˼·���²�Ʒ�ص�͵������������ش��˼��ߵ�����...</div>
                    </div>
<div class="zf_r_one" id="ce_pic20" onmousemove="slide_ty(20)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73819.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/DexShelld.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73819.html" target="_blank">DexShell���ʷ�ˮ͸ʪΪ���� �ṩרҵ��������</a></h1>	
���Ż����˶����εĲ���������죬���ϸ���������Ļ���������������Ҳ�������һ������Ҫ����˳���������Goretex��ˮЬѥ...</div>
                    </div>
<div class="zf_r_one" id="ce_pic21" onmousemove="slide_ty(21)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73814.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/shuxingked.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73814.html" target="_blank">���ǿ��ܾ���Ҷ���� ��ǿͶ������Ʒ���ƹ�</a></h1>	
��һ����Ʒ���ƹ㷽�棬�Ա���ISPO���Ͼ����޻���չΪƷ��Ӫ����չʾƽ̨��ͬʱ�����������¡��书ɽ�����...</div>
                    </div>
<div class="zf_r_one" id="ce_pic22" onmousemove="slide_ty(22)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73803.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/CORDURAd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/7803.html" target="_blank">8264ר��CORDURAȫ���г��ܼ�Cindy McNaull</a></h1>	
������Ʒ��Ь������������չ���ص㡣�����Ѿ����˶�Ʒ��ADIDAS,PUMA��Ь��Ʒ��CONVERSE��Ʒ����һЩͽ��/Զ�����Ĳ�Ʒ���к���...</div>
                    </div>
<div class="zf_r_one" id="ce_pic23" onmousemove="slide_ty(23)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73747.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/scarpad.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73747.html" target="_blank">Scarpa CEO Sandro Ϊ�й�¿�Ѵ���������Ʒ</a></h1>	
SCARPA��ϯִ�й�Sandro���й��ܾ��������������Ҫ��2012�����й���ν��з�չ�滮����Ʒ���ܡ�����ȫ��ЬƷ��չ���Ƶ�...</div>
                    </div>
<div class="zf_r_one" id="ce_pic24" onmousemove="slide_ty(23)">
                    <div class="zf_imgb"><a href="http://www.8264.com/73746.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuanfang/dauterd.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/73746.html" target="_blank">Deuter�����߹� �������������Ʒ����[��Ƶ]</a></h1>	
Deuter�����أ�ȫ�����۾���Jones���й��ܾ�����ʻ���������Ҫ�����˶����ϱ����ķ�չ��������й�������չ����...</div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <script language="javascript">
                var _tnum;
                var tMyMar;
                var tSize=24;
                function slide_ty(v){
                for(i=1;i<=tSize;i++){
                document.getElementById("ce_pic"+i).style.display="none";
                document.getElementById("sh_tip"+i).className="zfimgbg1";
                }
                document.getElementById("ce_pic"+v).style.display="";
                document.getElementById("sh_tip"+v).className="zfimgbg";
                _tnum=v; 
                clearInterval(tMyMar);
                tMyMar=setInterval("tGunDong()",1000);
                }
                function tGunDong(){
                if((_tnum+1)>tSize)
                _tnum=1;
                else	
                _tnum=_tnum+1;
                slide_ty(_tnum);
                }
                slide_ty(1);
                </script>
        <!--ר�ý���-->
        <!--����ר����ʼ-->
        <div class="mid">
        	<div class="title960">����ר��<a name="n3"></a></div>
            <div class="fangtan">
            	<div class="hudongl">
                	<div id="hotttdiv5_2" onmouseover="setttHotph_2(5);"><div id="hotttdiv5_3" class="sheqian"></div></div>
                	<div id="hotttdiv1_2" onmouseover="setttHotph_2(1);"><div id="hotttdiv1_3" class="sheqian1"></div></div>
            		<div id="hotttdiv2_2" onmouseover="setttHotph_2(2);"><div id="hotttdiv2_3" class="sheqian1"></div></div>
            		<div id="hotttdiv3_2" onmouseover="setttHotph_2(3);"><div id="hotttdiv3_3" class="sheqian1"></div></div>
            		<div id="hotttdiv4_2" onmouseover="setttHotph_2(4);"><div id="hotttdiv4_3" class="sheqian1"></div></div>
                </div>
                <script language="javascript">
function setttHotph_2(i)
{
 selectttHot2(i);
}
function selectttHot2(i)
{
  for(var id = 1;id<=5;id++)
 {
  var bbb="hotttcomment0"+id;
  if(id==i)
  document.getElementById(bbb).style.display="";
  else
  document.getElementById(bbb).style.display="none";
 } 
  for(var id = 1;id<=5;id++)
 {
  var bb="hotttdiv"+id+"_3";
  if(id==i)
  document.getElementById(bb).className="sheqian1";
  else
  document.getElementById(bb).className="sheqian";
 } 
}
</script>
<div class="hudongr" style=" display:;" id="hotttcomment05">
    <div class="hudongall">
                    	<div class="hudongimg"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/waiguan.jpg" width="120" height="80" border="0" /></div>
                        <div class="hudongwen"><span style="color:#F00">չ��չ���⾰</span><br>�ص㣺�������һ�������<br>ʱ�䣺2��22-25��</div>
                        <div style="clear:both;"></div>
                    </div>
      <div class="hudongall">
                    	<div class="hudongimg"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/8264zw.jpg" width="120" height="80" border="0" /></div>
                        <div class="hudongwen">8264չλ����<br>�ص㣺B3.111<br>ʱ�䣺2��22-25��</div>
                        <div style="clear:both;"></div>
                    </div>
    
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-1145472-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/lvyoujuhui.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-1145472-1-1.html" style="color:#F00"target="_blank">8264���氮������</a><br>�ص㣺���һ�������<br>ʱ�䣺23����6��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://u.8264.com/home-space-uid-34144490-do-album-picid-2608334.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/meiriyitu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://u.8264.com/home-space-uid-34144490-do-album-picid-2608334.html"  style="color:#F00"target="_blank">8264��ɫ��ÿ��һͼ</a></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/topic/1396.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/campingxiaotu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/topic/1396.html" style="color:#F00" target="_blank">8264¶Ӫ���</a></div>
                        <div style="clear:both;"></div>
                    </div>
<!--div class="hudongall">
                    	<div class="hudongimg"><a href="http://bx.8264.com/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/baoxian.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bx.8264.com/" target="_blank">���Ᵽ��</a><br>ר�����¿�����<br></div>
                        <div style="clear:both;"></div>
                    </div-->
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment01">
            <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_home_list.aspx?classid=008801888650" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/qiatan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_home_list.aspx?classid=008801888650" style="color:#F00"target="_blank">����Ʒ�ƴ���Ǣ̸��</a><br>
                          �ص㣺B1.103չλ<br>ʱ�䣺2011��2��22-24��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                   	  <div class="hudongimg"><a href="http://www.8264.com/viewnews-73366-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/liuxingqushi.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73366-page-1.html" style="color:#F00" target="_blank">�������Ʒ�����
</a><br>�ص㣺B1.116չλ<br>ʱ�䣺2��22-24��</div>
                        <div style="clear:both;"></div>
                  </div>
                    <div class="hudongall">
                   	  <div class="hudongimg"><a href="http://www.8264.com/viewnews-73366-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zpqu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73366-page-1.html" style="color:#F00" target="_blank">������</a><br>�ص㣺B2.222չλ<br>ʱ�䣺2��22-24��</div>
                        <div style="clear:both;"></div>
                  </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment02">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=140" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/yataixue.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=140" style="color:#F00"target="_blank">��̫ѩ�ز�ҵ��̳</a><br>�ص㣺������E306A������<br>ʱ�䣺2��23��ȫ��<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=159" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/lingshoult.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=159" style="color:#F00"target="_blank">��������̳</a><br>�ص㣺չ����E-232������<br>ʱ�䣺2��25��ȫ��<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=160" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shishangyundongqushi.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=160" style="color:#F00" target="_blank">�й��˶�ʱ������������̳</a><br>�ص㣺չ����E-232������<br>ʱ�䣺2��22��ȫ��</div>
                        <div style="clear:both;"></div>
                    </div>
                	<div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=161" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/huwaichanyelt.jpg" width="120" height="80" border="0" /></a></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=161" style="color:#F00" target="_blank">�й������ҵ��̳</a><br>�ص㣺չ����E-232������<br>ʱ�䣺2��24��ȫ��<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/viewnews-73574-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/CORDURA_lunta.jpg" width="120" height="80" border="0" /></a></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73574-page-1.html" style="color:#F00" target="_blank">CORDURA����װ���������ֻ�</a><br>
                      �ص㣺չ����¥�Ļ�����<br>ʱ�䣺2��23�� 9:00</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both;"></div>
                 </div>
       
                <div class="hudongr" style=" display:none;" id="hotttcomment03">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/viewnews-73366-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/sifei.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73366-page-1.html"style="color:#F00" target="_blank">NATOOKE X�ٿ��Ļ�����PK</a><br>�ص㣺0.001չλ������<br>
                        ʱ�䣺2��22-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=192" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/paobu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=192" target="_blank">���������ܲ����껪</a><br>�ص㣺B1.118չλ��̨��<br>ʱ�䣺2��22-25��<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=189" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/huaban.jpg" width="120" height="80" border="0" /></a></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=189" style="color:#F00"target="_blank">�����˶�����ϵ����
</a><br>
�ص㣺0.122չλ������<br>
ʱ�䣺2��22-24��<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment04">
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=162" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/banfu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispo.com.cn/beijing/templates_detail.aspx?id=162" style="color:#FF0000" target="_blank">���ɽ�ص�Ӱ���ƽ鼰ר��</a><br> �ص㣺B1.118չλ ��̨��<br>
                        ʱ�䣺2��22-24��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/viewnews-73366-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73366-page-1.html" style="color:#FF0000" target="_blank">�ϵ��޶�-��ɽ�³���Ԯ��</a><br>
                        �ص㣺1�Ź���ڴ�<br>
                        ʱ�䣺2��22-25�� ÿ��4��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                   	  <div class="hudongimg"><a href="http://u.8264.com/home.php?mod=space&amp;uid=125851&amp;do=album&amp;picid=1386452&amp;goto=down#pic_block" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zouxiu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://u.8264.com/home.php?mod=space&amp;uid=125851&amp;do=album&amp;picid=1386452&amp;goto=down#pic_block" style="color:#F00" target="_blank">ʱװ����װ��������</a><br>�ص㣺B1.118չλ ��̨��<br>ʱ�䣺2��22-23��<br />&nbsp;</div>
                        <div style="clear:both;"></div>
                  </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/viewnews-73751-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/jinxiniu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/viewnews-73751-page-1.html" style="color:#F00" target="_blank">��Ϭţ���佱����</a><br>�ص㣺�������๦��A��<br>
                        ʱ�䣺2��234��17:30</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <!--����ר������-->
        <!--װ����ʼ-->
        <div class="mid">
        	<div class="title960">չ��װ��<a name="n5"></a></div>
            <div class="zball">
            	<div class="zbgun" style="display:none">
                	<div class="gun" id="de">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td id="de1">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63667.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb008.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63667.html" target="_blank">��������͸���Բ���</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63666.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb009.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63666.html" target="_blank">���ӯ��Ʒ��ר��ɡ��</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63658.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb010.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63658.html" target="_blank">��Ȼ���ݻ����������</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63662.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb011.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63662.html" target="_blank">Trezeta����Ҷ������ɽЬ</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63664.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/chuangxinzb012.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63664.html" target="_blank">kailas������ĳ����</a></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td id="de2">&nbsp;</td>
                            </tr>
                        </table>
                        <SCRIPT language=JavaScript type=text/javascript>
                            function GetObj01(objName){
                                if(document.getElementById){
                                    return eval('document.getElementById("' + objName + '")');
                                }else if(document.layers){
                                    return eval("document.layers['" + objName +"']");
                                }else{
                                    return eval('document.all.' + objName);
                                }
                            }
                              var speed01=20//�ٶ���ֵԽ���ٶ�Խ��
                              GetObj01("de2").innerHTML=GetObj01("de1").innerHTML
                              function Marquee01(){
                                  if(GetObj01("de").scrollLeft<=0)
                                  GetObj01("de").scrollLeft=GetObj01("de1").offsetWidth
                                  else{
                                    GetObj01("de").scrollLeft--
                                  }
                              }
                              var MyMar01=setInterval(Marquee01,speed01)
                              GetObj01("de").onmouseover=function() {clearInterval(MyMar01)}
                              GetObj01("de").onmouseout=function() {MyMar01=setInterval(Marquee01,speed01)}
                              </SCRIPT>
</div>
                </div>
            	<div>
                    <div class="mid7con_l">
                        <div class="zhantu"><a href="http://www.8264.com/73723.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhuangbei/d2.jpg" width="390" height="220" border="0" /></a></div>
                        <div class="zhantutitle">
                            <div class="zhantutitle_l">8264ֱ��--װ����Ʒ</div>
                            <div class="zhantutitle_r"><a href="http://www.8264.com/73723.html" target="_blank">KAILASչλ�ʵ����Ľ���</a></div>
                            <div style="clear:both;"></div>
                        </div>
                        <div class="zhantunew">
                            <!--//װ�������б� 12�� //-->
                            <!--[diy=zblist]--><div id="zblist" class="area"><div id="frame4MG42a" class=" frame move-span cl frame-1"><div id="frame4MG42a_left" class="column frame-1-c"><div id="frame4MG42a_left_temp" class="move-span temp"></div><?php block_display('3875'); ?></div></div></div><!--[/diy]-->
                            <div style="clear:both;"></div>
                      </div>
                    </div>
                    <div class="mid7con_r">
                    <!--//װ��ͼ�� 9�� //-->
                    <!--[diy=zblisttw]--><div id="zblisttw" class="area"><div id="frameGKBOz7" class=" frame move-span cl frame-1"><div id="frameGKBOz7_left" class="column frame-1-c"><div id="frameGKBOz7_left_temp" class="move-span temp"></div><?php block_display('3881'); ?></div></div></div><!--[/diy]-->
                </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="zhuangbeinew">
<!--//չ��װ��ͼ���б� //-->
<!--[diy=zhzblistimg]--><div id="zhzblistimg" class="area"><div id="frameYjAK3o" class=" frame move-span cl frame-1"><div id="frameYjAK3o_left" class="column frame-1-c"><div id="frameYjAK3o_left_temp" class="move-span temp"></div><?php block_display('3883'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
        <!--װ������-->
        <!--��Ƶ��ʼ-->
        <div class="mid">
        	<div class="title960">������Ƶ<a name="n7"></a></div>
            <div class="shipinall">
            	<div class="shipin_l"><a href="http://www.8264.com/73730.html" target="_blank" title="8264����ר�� ���ߵ������ʹ����"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/d2.jpg" width="370" height="275" /></a></div>
                <div class="shipin_r">
                	<ul>
                        <li><a href="http://www.8264.com/73730.html" target="_blank" title="���ز�Ʒ��չλ��Ƶ����"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp1.jpg"/></a></li>
                        <li><a href="http://www.8264.com/73687.html" target="_blank" title="KingCampƷ��չλ��Ƶ����"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp2.jpg"/></a></li>
                        <li><a href="http://www.8264.com/73688.html" target="_blank" title="���FMS-F3������ġ����桱����ʽҰӪ��¯"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp3.jpg"/></a></li>
                        <li><a href="http://www.8264.com/73689.html" target="_blank" title="���ڿƼ�ǰ�� Clortsδ���пɳ���Ь���ع�"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp4.jpg"/></a></li>
                        <li><a href="http://www.8264.com/73723.html" target="_blank" title="ISPO BEIJING 2012 KAILASչλ�ʵ����Ľ���"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp5.jpg"/></a></li>
<li><a href="http://www.8264.com/737230.html" target="_blank" title="ISPO BEIJING2012 VAUDE���ֵã�չλ��Ƶ����"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp6.jpg"/></a></li>
<li><a href="http://www.8264.com/73733.html" target="_blank" title="ɽ��·��BOULEVARD���п�����"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp7.jpg"/></a></li>
<li><a href="http://www.8264.com/73754.html" target="_blank" title="G-1000���ϼ���Ʒ"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp8.jpg"/></a></li>
<li><a href="http://www.8264.com/73729.html" target="_blank" title="һ˫������������ϪЬ"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp9.jpg"/></a></li>
<li><a href="http://www.8264.com/73728.html" target="_blank" title="³��ѷ������ɽ��ȫ������"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp10.jpg"/></a></li>
<li><a href="http://www.8264.com/73722.html" target="_blank" title="�ʽ�RG860���������ֻ�"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp11.jpg"/></a></li>
<li><a href="http://www.8264.com/73734.html" target="_blank" title="������������е��� SanSegal�����ϵ��"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/shipin/sp12.jpg"/></a></li>
                        
                    </ul>
                    <div style="clear:both;"></div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
        <!--��Ƶ����-->
        <!--���ͻ�����ʼ-->
        <div class="mid">
        	<div class="mid3_l">
            	<div class="mid3_l_title">¿�ѹ�չ<a name="n6"></a></div>
                <div class="boke">
                    <!--//���������б� 24�� //-->
                    <!--[diy=bklist]--><div id="bklist" class="area"><div id="frames8esue" class=" frame move-span cl frame-1"><div id="frames8esue_left" class="column frame-1-c"><div id="frames8esue_left_temp" class="move-span temp"></div><?php block_display('3876'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
</div>
            <div class="mid3_r">
            	<div class="mid3_r_title">չ��˲��<a name="n8"></a></div>
                <div class="hxone">
                	<!--//�����б� 3�� //-->
<!--[diy=hxlist]--><div id="hxlist" class="area"><div id="frameo4k4j4" class=" frame move-span cl frame-1"><div id="frameo4k4j4_left" class="column frame-1-c"><div id="frameo4k4j4_left_temp" class="move-span temp"></div><?php block_display('3877'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
            </div>
        	<div style="clear:both"></div>
        </div>
        <!--���ͻ�������-->
        <!--չ̨������ع˿�ʼ-->
        <div class="mid">
        	<div class="mid3_l">
            	<div class="mid3_l_title">����չ��<a name="n2"></a></div>
                <div class="mid3_l_con">
                	<div class="mid3_l_con_one">
                        <div class="ztconall">
                            <!--����չ����ʼ-->
                            <div class="ztcon" id="hhotcomment1" style="text-align:center; padding:10px 0;">
                                <a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/dall.jpg" width="585" height="350" border="0"/></a>
                            </div>
                            <!--����չ������-->
                            <!--1��չ��-->
                            <div class="ztcon" style="display:none" id="hhotcomment2">
                                <div class="ztconimg"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/d1.jpg" /></a></div>
                                <div class="ztcon_r">
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-799129-1-1.html " target="_blank" title="չλA1.508"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/06/067ca75f07e29bc8daf2798531a7b14f.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-799188-1-1.html " target="_blank" title="չλA1.620"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/34/34af0f061ba5b8332bd0d4d6ecaca109.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-800688-1-1.html " target="_blank" title="չλA1.142"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c8/c8e33843d12b9a5b5d4c6d977ad73d1e.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-886439-1-1.html " target="_blank" title="չλA1.509"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/8a/8a31768baa473ab5045dbf155998f147.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-831314-1-1.html " target="_blank" title="չλA1.146"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/36/36185219f06458751547e9be37338f8a.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-802734-1-1.html " target="_blank" title="չλA1.511"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/2f/2ff2956d48346bdbfd0e4670bf872cfd.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-890460-1-1.html " target="_blank" title="չλA1.420"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/8a/8a3f19c62c43a31532a5d8da9dfd2ffc.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-877297-1-1.html " target="_blank" title="չλA1.136"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/47/47d9a392cf73761df66fe8db8b75eedc.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-1074696-1-1.html " target="_blank" title="չλA1.405"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/23/23937194c5e180d1f091e7babdbd313a.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-825526-1-1.html " target="_blank" title="չλA1.307"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f9/f959a9f109bae0f8bbe98991c3b8a4c5.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-831845-1-1.html " target="_blank" title="չλA1.206"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f3/f3127593553b4420b91afff27a55cb7b.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-880037-1-1.html " target="_blank" title="չλA1.207"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c8/c856d1925d15a31737b5836eb3724e1a.jpg"></a></div>
                                    
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--1��չ������-->
                            <!--2��չ��-->
                            <div class="ztcon" style="display:none" id="hhotcomment3">
                                <div class="ztconimg"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/d2.jpg" /></a></div>
                                <div class="ztcon_r">
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-800772-1-1.html " target="_blank" title="չλA2.502"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c7/c7fae000f2d0c6a5ddee4f944ed665c8.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-877153-1-1.html " target="_blank" title="չλA2.506"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/60/6015d359ed8dd1cced2e0b91dab59e99.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-800839-1-1.html " target="_blank" title="չλA2.408"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/80/80bdae0b3cc642138de2fd05e421b000.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-834858-1-1.html " target="_blank" title="չλA2.403"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/33/337c4d02302fc5b6c7708e0ba3314ca0.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-1129952-1-1.html " target="_blank" title="չλA2.306"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/bd/bdd9e5082096488d1dce05df58f40dea.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-820173-1-1.html " target="_blank" title="չλA2.305"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/3c/3c6c4e02465db91e4db0bf40c2577327.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-825388-1-1.html " target="_blank" title="չλA2.208"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/11/11018cbe16bc66039654303abeba099d.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-799344-1-1.html " target="_blank" title="չλA2.205"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/18/181c7eb7ce794b88e81ec0df6c9aedf3.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-801521-1-1.html " target="_blank" title="չλA2.102"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/cd/cd4d13c38d2d7885f45660292c9900bc.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-802589-1-1.html  " target="_blank" title="չλA2.106"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/6b/6bd27b90b4af0ac88deac913e5da0615.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-799222-1-1.html  " target="_blank" title="չλA2.108"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/26/262af4de8528628259ac9c6bb3ba386e.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-799156-1-1.html   " target="_blank" title="չλA2.108"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c2/c23d7495a40b74b7573c839da2e2d1bf.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-799131-1-1.html  " target="_blank" title="չλA2.210"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/4c/4cda895353f6f15ef70ba618b0785b75.jpg"></a></div>
                                     <div class="brandall"><a href="http://bbs.8264.com/thread-829753-1-1.html " target="_blank" title="չλA2.203"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/57/5756e9402f909efb76bb525a1a4bbdfb.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--2��չ������-->
                            <!--3��չ��-->
                            <div class="ztcon" style="display:none" id="hhotcomment4">
                                <div class="ztconimg"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/d3.jpg" /></a></div>
                                <div class="ztcon_r">
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-807406-1-1.html " target="_blank" title="չλA3.206"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/55/55031f41a6c6481c1d001bf285ccd091.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-801379-1-1.html " target="_blank" title="չλA3.202"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/24/24772dd6c636d6052479957c01e19e9a.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-820061-1-1.html " target="_blank" title="չλA3.310"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/88/883f1efea8879feff1b3c71c0e641e8d.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-820184-1-1.html " target="_blank" title="չλA3.310"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/d9/d9202769059a4d9ea03a286432b660da.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799188-1-1.html " target="_blank" title="չλA3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/34/34af0f061ba5b8332bd0d4d6ecaca109.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-1049662-1-1.html " target="_blank" title="չλA3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/9d/9d4e79c33e72c3fd42bdeaef69cbc720.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799166-1-1.html " target="_blank" title="չλA3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/3b/3b3fdab5a2f17db9daa11764a2f19a14.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799128-1-1.html " target="_blank" title="չλA3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/7e/7e2a6f127bab6b1e17ca11f2ab13d4ce.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799110-1-1.html " target="_blank" title="չλA3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/ad/ad18507bc95b2b5b7696ebb0d1e5f46b.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799178-1-1.html " target="_blank" title="չλA3.303"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/32/3262c7286e42a09dfc0fb6920ddfa9f8.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-802511-1-1.html " target="_blank" title="չλA3.305"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/77/7733e3ae377b9150db0eebd2c8a50e20.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-825457-1-1.html " target="_blank" title="չλA3.301"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/01/016c82efb75983d0e5d72e848f1cdba7.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-838604-1-1.html " target="_blank" title="չλA3.412"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/1b/1b72c12ccd1ca32157e743796e0ea47d.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-836621-1-1.html " target="_blank" title="չλA3.412"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/60/6041c6e5ddc778244ef69f4fe6e868a7.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-839252-1-1.html " target="_blank" title="չλA3.201"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/5a/5a5537623ba49951e3cc80ebc654f383.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-799145-1-1.html " target="_blank" title="չλA3.102"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/da/dab65ac402878a610353950ab66ec203.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-808638-1-1.html " target="_blank" title="չλA3.308"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/2d/2d99f11db0b4896dd9dd1358a390535f.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-808633-1-1.html " target="_blank" title="չλA3.308"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/02/02a3681a74c858067589f50fbbe0cc3a.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-808639-1-1.html " target="_blank" title="չλA3.308"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f9/f91c423264bd41be1431fbf33acbd99b.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-800821-1-1.html " target="_blank" title="չλA3.402"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/ef/ef891ea4223f3955e02c3e38c022e6a3.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-872545-1-1.html " target="_blank" title="չλA3.207"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/61/611865afa58c03afb98e5ddc4c4f531e.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-829820-1-1.html " target="_blank" title="չλA3.207"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/a0/a031cc3f4517cd0ea3bcf8fc7b39c8fc.jpg"></a></div>
                                   <div class="brandall"><a href="http://bbs.8264.com/thread-807443-1-1.html " target="_blank" title="չλA3.108"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/03/0328995b5c09f2cd390c6198b25273e5.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--3��չ������-->
                            <!--4��չ��-->
                            <div class="ztcon" style="display:none" id="hhotcomment5">
                                <div class="ztconimg"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/d4.jpg" /></a></div>
                                <div class="ztcon_r">
                                    
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-848961-1-1.html " target="_blank" title="չλA4.402"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/78/7855047181d57882d9aa014f32909391.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-1007350-1-1.html " target="_blank" title="չλA4.503"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/64/64cc27b54cd40df2151eadd5ccacc8d6.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-801554-1-1.html " target="_blank" title="չλA4.302"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/26/2684e1bdd20b42b3119eb877851c1dbe.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-801286-1-1.html " target="_blank" title="չλA4.302"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/66/669f344d01f92d1c7d107f057518c753.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-890607-1-1.html " target="_blank" title="չλA4.306"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/00/00953ed3f13b12156259ad0b97b2d0ca.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-811068-1-1.html " target="_blank" title="չλA4.308"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/90/90857862ec279112a99bfef8563d5da8.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-819947-1-1.html " target="_blank" title="չλA4.301"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/89/895f54a153edb8be8600c8ed92cad504.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-1109747-1-1.html " target="_blank" title="չλA4.301"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/11/11faf2f055a2b40e2053a919a086633d.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-801564-1-1.html " target="_blank" title="չλA4.301A"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/b6/b67d86098f60e577c1abf724182ff3fd.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-807454-1-1.html " target="_blank" title="չλA4.202"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/64/64567675de48952365b78d42a64fa382.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-830375-1-1.html " target="_blank" title="չλA4.206"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/1a/1a9acd44545e08ef8b278089fc58105c.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-806043-1-1.html " target="_blank" title="չλA4.208"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/96/9644d37d68133a23048e909cbe89953a.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-862654-1-1.html " target="_blank" title="չλA4.212"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/75/75cbf791d590527dcfbe61dd741884b1.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-949985-1-1.html " target="_blank" title="չλA4.102"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/83/83df5c73b779ec4d00351606ae73a165.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-1040187-1-1.html" target="_blank" title="չλA4.106"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/10/10f55450c96eee1b7cbe4db5a2e373d2.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-802747-1-1.html " target="_blank" title="չλA4.110"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f4/f4e22436ee090f427d2da9442f4bcb63.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-825630-1-1.html " target="_blank" title="չλA4.103"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/27/2708883d8a87131769b662198d89312c.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-872441-1-1.html  " target="_blank" title="չλA4.120"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c1/c1bfa898fda76b1fde1ab37c9210bc98.jpg"></a></div>
                                    <div class="brandall"><a href="http://bbs.8264.com/thread-886651-1-1.html " target="_blank" title="չλA4.203"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/c2/c2c357e282ca3fb250bba6ba6a6259c8.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--4��չ������-->
                            <!--B1/B2/B3չ��-->
                            <div class="ztcon" style="display:none" id="hhotcomment6">
                                <div class="ztconimg1"><a href="http://www.ispo.com.cn/beijing/uploadfiles/Download/ISPO_BEIJING_2012_VISITOR_PLANNER.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/zhanting/db.jpg" /></a></div>
                                <div class="ztcon_r1">
                                <div class="brandall"><a href="http://bbs.8264.com/thread-835056-1-1.html " target="_blank" title="չλB1.101"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/8a/8aaaad48fcf5d3351b680c13ff5da9f0.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-964835-1-1.html " target="_blank" title="չλB1.101"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/89/89a33cc59e1cbdff677decbfd5c9f0ec.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-833405-1-1.html " target="_blank" title="չλB1.107"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/97/9749995fbff0c1a08fb2eaf11cbe071d.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-839974-1-1.html " target="_blank" title="չλB2.102"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/a6/a61c0dfe1a32776acdde5c2a6de096e6.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-806844-1-1.html " target="_blank" title="չλB2.101"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/16/16ce993b76cbba09673b885dc847d1cb.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-849156-1-1.html " target="_blank" title="չλB2.106"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/f5/f5c9402b1bc4ddb8c39d30ea77cd5699.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-890677-1-1.html " target="_blank" title="չλB2.110"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/ff/ffbb35baa17ee999fd07027b76a30242.jpg"></a></div>
                                <div class="brandall"><a href="http://bbs.8264.com/thread-886671-1-1.html " target="_blank" title="չλB2.120"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/22/2262b6aa3cdbab2cbd53146916e1b747.jpg"></a></div> 
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--B1/B2/B3չ������-->
                        </div>
                        <script language="javascript">
                function settHotph_2(i)
                {
                 selecttHot2(i);
                }
                function selecttHot2(i)
                {
                  for(var id = 1;id<=6;id++)
                 {
                  var bb="hhotcomment"+id;
                  if(id==i)
                  document.getElementById(bb).style.display="";
                  else
                  document.getElementById(bb).style.display="none";
                 } 
                  for(var id = 1;id<=6;id++)
                 {
                  var bb="hhotdiv"+id+"_2";
                  if(id==i)
                  document.getElementById(bb).className="zg";
                  else
                  document.getElementById(bb).className="zg1";
                 } 
                }
                </script>
                        <div class="ztr">
                            <div class="zg" id="hhotdiv1_2" onmouseover="settHotph_2(1);"><a href="javascript:void(0)" target="_self">չ��ȫ��</a></div>
                            <div class="zg1" id="hhotdiv2_2" onmouseover="settHotph_2(2);"><a href="javascript:void(0)" target="_self">A1�Ź�</a></div>
                            <div class="zg1" id="hhotdiv3_2" onmouseover="settHotph_2(3);"><a href="javascript:void(0)" target="_self">A2�Ź�</a></div>
                            <div class="zg1" id="hhotdiv4_2" onmouseover="settHotph_2(4);"><a href="javascript:void(0)" target="_self">A3�Ź�</a></div>
                            <div class="zg1" id="hhotdiv5_2" onmouseover="settHotph_2(5);"><a href="javascript:void(0)" target="_self">A4�Ź�</a></div>
                            <div class="zg1" id="hhotdiv6_2" onmouseover="settHotph_2(6);"><a href="javascript:void(0)" target="_self">B1/B2/B3</a></div>
                            <div style="clear:both;"></div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div class="mid3_r">
            	<div class="mid3_r_title">����ع�</div>
                <div class="mid3_r_con">
                	<ul>
                    	<li><a href="http://www.8264.com/topic/1346.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo6.jpg"></a><br><a href="http://www.8264.com/topic/1346.html" target="_blank">ispo china 2011ר��</a></li>
<li><a href="http://www.8264.com/portal-topic-topicid-1301.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo1.jpg"></a><br><a href="http://www.8264.com/portal-topic-topicid-1301.html" target="_blank">ispo china 2010ר��</a></li>
                        <li><a href="http://www.8264.com/topic/1215.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo2.jpg"></a><br><a href="http://www.8264.com/topic/1215.html" target="_blank">ispo china 2009ר��</a></li>
                        <li><a href="http://www.8264.com/topic/1076.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo3.jpg"></a><br><a href="http://www.8264.com/topic/1076.html" target="_blank">ispo china 2008ר��</a></li>
                        <li><a href="http://www.8264.com/topic/593.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/ispo4.jpg" /></a><br>
                      <a href="http://www.8264.com/topic/593.html" target="_blank">ispo china 2007ר��</a></li>
                    </ul>
              </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--չ̨������ع˽���-->
<!--չλͼƬ��ʼ-->
        <div class="mid">
        	<div class="title960">չλͼƬ<a name="n10"></a></div>
            <div class="zwall">               
                <!--//չλͼƬ 10�� //-->
                <!--[diy=zwtp]--><div id="zwtp" class="area"><div id="frame5arRTv" class=" frame move-span cl frame-1"><div id="frame5arRTv_left" class="column frame-1-c"><div id="frame5arRTv_left_temp" class="move-span temp"></div><?php block_display('3882'); ?></div></div></div><!--[/diy]-->
                <div style="clear:both"></div>
            </div>
        </div>
        <!--չλͼƬ����-->
        <!--��Ů��ʼ-->
        <div class="mid">
        	<div class="title960">չ����Ů<a name="n9"></a></div>
            <div class="meinvall">
            	<div>
                	<div class="meinv_l"><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=1156476&amp;page=1#pid17234233" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/meinvd2.jpg"></a></div>
                    <div class="meinv_r">
                        <!--//��Ů���Ҳ� 12�� //-->
                        <!--[diy=mvuplist]--><div id="mvuplist" class="area"><div id="frameNJXzx8" class=" frame move-span cl frame-1"><div id="frameNJXzx8_left" class="column frame-1-c"><div id="frameNJXzx8_left_temp" class="move-span temp"></div><?php block_display('3878'); ?></div></div></div><!--[/diy]-->
                        <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div>
                    <!--//��Ů����һ�� 12�� //-->
                    <!--[diy=mvdownlist]--><div id="mvdownlist" class="area"><div id="framewc9NaI" class=" frame move-span cl frame-1"><div id="framewc9NaI_left" class="column frame-1-c"><div id="framewc9NaI_left_temp" class="move-span temp"></div><?php block_display('3879'); ?></div></div></div><!--[/diy]-->
<div style="clear:both;"></div>  
                </div>
            </div>
        </div>
        <!--��Ů����-->
        <!--�ײ���ʼ-->
        <div class="bottom"><a href="/template/8264/about/aboutus.htm" target="_blank">8264���</a>&nbsp;|&nbsp;<a href="/template/8264/about/ggservice/index.html" target="_blank" style="color:#FF0000;">������</a>&nbsp;|&nbsp;<a href="/list/531/" target="_blank">�༭���Ĺ���</a>&nbsp;|&nbsp;<a href="/template/8264/about/sitemap.html" target="_blank">վ���ͼ</a>&nbsp;|&nbsp;<a href="/template/8264/about/aboutus.htm" target="_blank">��ϵ��ʽ</a>&nbsp;|&nbsp;<a href="http://buy.8264.com/" target="_blank">��������</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/thread-457062-1-1.html" target="_blank" style="color:#FF0000;">QQȺ����</a>&nbsp;|&nbsp;<a href="http://8.8264.com/job/" target="_blank">8264��Ƹ</a>&nbsp;|&nbsp;<a href="/template/8264/about/link/link.htm" target="_blank">��������</a><br>�������ߣ�022-23708264&nbsp;|&nbsp;���棺022-23708323&nbsp;|&nbsp;��ַ��������¼�����ҵ԰��Է��ҵ�������8�ź�̩��Ϣ�㳡C��1001��<br><a href="http://bx.8264.com" target="_blank" style="color:#53792e;">�����з��գ�8264����������</a> <a href="http://bx.8264.com" style="color:#53792e;">���Ᵽ��</a><br>���˽�ӡʲô�������� ������Ӱʲô�������ߣ���ӭ����ý��ת�����ǵ�ԭ����Ʒ[ת����ע������]��8264&nbsp;��Ȩ����   <a href="http://www.miibeian.gov.cn/" target="_blank">��ICP��05004140��-1</a></div>
        <!--�ײ�����-->
</div>
    
    
    
<!--dx���뿪ʼ-->  
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?><!--dx�������-->
    
</div>
<!--dx���뿪ʼ-->



<!--//waper����//-->
<?php if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb">
<em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>վ���Ƽ�<?php } ?></em>
<span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="�ر�">�ر�</a></span>
</h3>
<hr class="l" />
<div class="detail">
<h4><a href="<?php echo $focus['url'];?>" target="_blank"><?php echo $focus['subject'];?></a></h4>
<p>
<?php if($focus['image']) { ?>
<a href="<?php echo $focus['url'];?>" target="_blank"><img src="<?php echo $focus['image'];?>" onload="thumbImg(this, 1)" _width="58" _height="58" /></a>
<?php } ?>
<?php echo $focus['summary'];?>
</p>
</div>
<hr class="l" />
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">�鿴</a>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; } ?>

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
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
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
</body>
</html>
