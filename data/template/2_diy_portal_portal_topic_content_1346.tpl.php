<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1346', 'common/header_diy');
block_get('1650,1686,1580,1617,1651,1685,1684,1618,1619,1620,1621');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<title><?php if(!empty($topic['title'])) { ?><?php echo $topic['title'];?> <?php } if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if($_G['setting']['bbname']) { ?><?php echo $_G['setting']['bbname'];?> - <?php } ?></title>
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
<script src="http://static.8264.com/oldcms/moban/zt/2011ispo/js/common.js" type="text/javascript" type="text/javascript" language="javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2011ispo/js/jquery-1.4.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2011ispo/js/jquery.lazy-1.3.1.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function(){
  jQuery.lazy({src:'http://static.8264.com/oldcms/moban/zt/2011ispo/js/jquery.darizi.js',name:'darizi',dependencies:{js:['http://static.8264.com/oldcms/moban/zt/2011ispo/js/jquery.countdown.js']},cache:true});
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
<style id="diy_style" type="text/css">#frame7On2Hm { margin:0px !important;border:medium none !important;}#portal_block_1580 { margin:0px !important;border:medium none !important;}#portal_block_1580 .content { margin:0px !important;}#frame379R63 { margin:0px !important;border:medium none !important;}#portal_block_1617 { margin:0px !important;border:medium none !important;}#portal_block_1617 .content { margin:0px !important;}#frameTQh4d7 { margin:0px !important;border:medium none !important;}#portal_block_1618 { margin:0px !important;border:medium none !important;}#portal_block_1618 .content { margin:0px !important;}#frameG76gUb { margin:0px !important;border:medium none !important;}#portal_block_1619 { margin:0px !important;border:medium none !important;}#portal_block_1619 .content { margin:0px !important;}#frameirp5us { margin:0px !important;border:medium none !important;}#portal_block_1620 { margin:0px !important;border:medium none !important;}#portal_block_1620 .content { margin:0px !important;}#framef2DU59 { margin:0px !important;border:medium none !important;}#portal_block_1621 { margin:0px !important;border:medium none !important;}#portal_block_1621 .content { margin:0px !important;}#frame33qbg6 { margin:0px !important;border:medium none !important;}#portal_block_1650 { margin:0px !important;border:medium none !important;}#portal_block_1650 .content { margin:0px !important;}#framet93u5j { margin:0px !important;border:medium none !important;}#portal_block_1651 { margin:0px !important;border:medium none !important;}#portal_block_1651 .content { margin:0px !important;}#frameyDdQ3v { margin:0px !important;border:medium none !important;}#portal_block_1684 { margin:0px !important;border:medium none !important;}#portal_block_1684 .content { margin:0px !important;}#frameGwv9Dh { margin:0px !important;border:medium none !important;}#portal_block_1685 { margin:0px !important;border:medium none !important;}#portal_block_1685 .content { margin:0px !important;}#frameOn4JZ4 { margin:0px !important;border:medium none !important;}#portal_block_1686 { margin:0px !important;border:medium none !important;}#portal_block_1686 .content { margin:0px !important;}</style>
<!--diy��ʽ����-->
<!--�Լ���ʽ��ʼ-->
<link href="http://static.8264.com/oldcms/moban/zt/2011ispo/style/style.css" rel="stylesheet" type="text/css" />
<!--�Լ���ʽ����-->
<div class="warpper">
<div class="warpper_960">
        <!--������ʼ-->
        <div class="navall"><a href="http://www.8264.com/" target="_blank">8264��ҳ</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/topic/1346.html#n1">չ�ᶯ̬</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n2">չ���ͼ</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n10">չλ���</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n3">����ר��</a>&nbsp;|&nbsp;<a href="http://www.8264.com/topic/1346.html#n4">ר��</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n5">��Ʒ</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n6">¿�ѿ�ispo</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n7">��Ƶ</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n8">����</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n9">��Ů</a></div>
        <!--��������-->
        <!--��һ���ֿ�ʼ-->
        <div class="mid">
        	<div class="l">
            	<!--�ֲ���ʼ-->
            	<div class="lunboall">
                	<div class="ltitle1">�����ע</div>
                    <div class="lunbo">
                        <!--//�ֲ�//-->
            			<!--[diy=lunbo]--><div id="lunbo" class="area"><div id="frame33qbg6" class=" frame move-span cl frame-1"><div id="frame33qbg6_left" class="column frame-1-c"><div id="frame33qbg6_left_temp" class="move-span temp"></div><?php block_display('1650'); ?></div></div></div><!--[/diy]-->
                    </div>
                </div>
                <!--�ֲ�����-->
                <div class="l2">
                	<div class="zhinantitle">��չָ��</div>
                    <div class="zn">
                    	<ul>
                        	<li><a href="http://www.8264.com/62842.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zn1.jpg"></a></li>
                            <li><a href="http://j.map.baidu.com/XIE3" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zn2.jpg"></a></li>
                            <li><a href="http://j.map.baidu.com/oIE3" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zn3.jpg"></a></li>
                            <li><a href="http://www.8264.com/62841.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zn4.jpg"></a></li>
                            <li><a href="http://www.weather.com.cn/weather/101010100.shtml" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zn5.jpg"></a></li>
                            <li><a href="http://www.8264.com/62843.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zn6.jpg"></a></li>
                        </ul>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </div>
            <div class="m">
            	<div class="m1">
                	<div class="mtitle">չ��ͷ��</div>
                    <div class="mcon">
<div class="toutiaocon">���߽������˶���Ʒ��ʱ��չ��2011��2��23����25���ڼ���У�8264����С�齫��Ϊ��������һ��չ����Ѷ����Ʒ��װ����Ʒ��Ѷ����ӭ����ע��ר�⡣</div>
                        <!--//չ��ͷ�� 10�� ���ⳤ��30//-->
            			<!--[diy=zhtt]--><div id="zhtt" class="area"><div id="frameOn4JZ4" class=" frame move-span cl frame-1"><div id="frameOn4JZ4_left" class="column frame-1-c"><div id="frameOn4JZ4_left_temp" class="move-span temp"></div><?php block_display('1686'); ?></div></div></div><!--[/diy]-->
 </div>
                </div>
                <div class="m1">
                	<div class="mtitle">չ�����<a name="n1"></a></div>
                    <div class="toutiaolist">
                        <!--//ͷ���б� 12�� ���ⳤ��30//-->
            			<!--[diy=ttlist]--><div id="ttlist" class="area"><div id="frame7On2Hm" class=" frame move-span cl frame-1"><div id="frame7On2Hm_left" class="column frame-1-c"><div id="frame7On2Hm_left_temp" class="move-span temp"></div><?php block_display('1580'); ?></div></div></div><!--[/diy]-->
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div class="r">
                <div class="darizi">
                    <div class="zhengjishi"><span class="shu"></span></div>
                    <div class="daojishi"><span class="shu"></span></div>
                    <div class="jieshule"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/bm.gif"></div>
                </div>
                <div class="r1">
                	<ul>
                    	<li><a href="http://bbs.8264.com/thread-669206-1-1.html"  style="color:#FF0000" target="_blank">8264"�޼ٻ���������"</a></li>
                        <li><a href="http://bbs.8264.com/thread-664541-1-1.html" style="color:#FF0000" target="_blank">2011��ISPO�ɷ�����ļ</a></li>
                        <li><a href="http://bbs.8264.com/thread-676667-1-1.html" style="color:#FF0000" target="_blank">�׽�ISPOȫ�������ۻ�</a></li>
<li><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=675549&amp;page=1&amp;extra=#pid11741732pid11741732" style="color:#FF0000" target="_blank"> 2011�걱��ISPO¿�Ѿۻ�</a></li>
                        <li><a href="http://bbs.8264.com/thread-677467-1-1.html" target="_blank">�����ǡ�ʯϿ�ش�Խ</a></li>
<li><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">ispo china 2011���ҽ�</a></li>
                        <li><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">ispo china ������껪</a></li>
                    </ul>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--��һ���ֽ���-->
        <!--ר�ÿ�ʼ-->
        <div class="mid">
        	<div class="title960">��&nbsp;&nbsp;&nbsp;&nbsp;ս<a name="n4"></a></div>
            <div class="zf">
                <div class="zf_l">
                    <div class="zfimgbg1" id="sh_tip1" onmousemove="slide_ty(1)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang13.jpg"></div>
                    <div class="zfimgbg" id="sh_tip2" onmousemove="slide_ty(2)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang14.jpg"></div>
                    <div class="zfimgbg" id="sh_tip3" onmousemove="slide_ty(3)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang15.jpg"></div>
                    <div class="zfimgbg" id="sh_tip4" onmousemove="slide_ty(4)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang16.jpg"></div>
                    <div class="zfimgbg" id="sh_tip5" onmousemove="slide_ty(5)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang17.jpg"></div>
                    <div class="zfimgbg" id="sh_tip6" onmousemove="slide_ty(6)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang18.jpg"></div>
                    <div class="zfimgbg" id="sh_tip7" onmousemove="slide_ty(7)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang19.jpg"></div>
                    <div class="zfimgbg" id="sh_tip8" onmousemove="slide_ty(8)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang20.jpg"></div>
                    <div class="zfimgbg" id="sh_tip9" onmousemove="slide_ty(9)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang21.jpg"></div>
                    <div class="zfimgbg" id="sh_tip10" onmousemove="slide_ty(10)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang22.jpg"></div>
                    <div class="zfimgbg" id="sh_tip11" onmousemove="slide_ty(11)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang23.jpg"></div>
                    <div class="zfimgbg" id="sh_tip12" onmousemove="slide_ty(12)"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang25.jpg"></div>
                    <div style="clear:both"></div>
                </div>
                <div class="zf_r" id="sh_ce_p">
                    <div class="zf_r_one" id="ce_pic1" onmousemove="slide_ty(1)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63500.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang013.jpg"/></a></div>
                    <div class="zf_imginfo">
                    <h1><a href="http://www.8264.com/63500.html" target="_blank">ע�س����Ƚ���չ �������ܾ���Martinר��</a></h1>Fjallraven��Hanwag����׷��߶�Ʒ�ʵ�Ʒ�ƣ�Ŀǰ�й��������г������̳�Ϊ������Hanwag��Ҫ���뻧��꣬��ΪFjallrave������רҵ��ƷҲ�������ճ����š�</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic2" onmousemove="slide_ty(2)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63540.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang014.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/63540.html" target="_blank">ʼ�ձ���ǰ�� 8264ר����ʯ������Ʒ��Osprey</a></h1>	Ospreyÿ��������Ƴ����ᾭ��5��6�����԰汾��������ͨ��Ospreyר�ŵĲ����ŶӺ�רҵ��Ҷ��²�Ʒ�������ܲ��ԣ�ͨ���������鷴���о�������Ϣ���Ӷ����õ���Ƶ��У����յ���һ���²�Ʒ��</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic3" onmousemove="slide_ty(3)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63539.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang015.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63539.html" target="_blank">8264ר������Oboz�ܲü洴ʼ��John Connelly </a></h1>					ObozԴ��������רע��ЬƷ��������з�������н����������̺����У����̶����˽⻧���˶��ߵ�ϸ������׷����ʵ�Ļ���ӡ����</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic4" onmousemove="slide_ty(4)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63543.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang016.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63543.html" target="_blank">�������ủ����� 8264չ��ר�ø��ز�Ʒ��</a></h1>					Kolumb�����ز����Դ�������й��Ļ���ɫ�Ļ���Ʒ��Ϊ���Σ��ӻ����Ѻ�����������������ϻ�����Ʒ����ҵ���ԣ�����ԡ���̼������������Ȼ��Ϊ����ġ��ủ�⡱���</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic5" onmousemove="slide_ty(5)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63546" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang017.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63546.html" target="_blank">������ʱ�е�һ����Ʒ�� 8264չ��˼����ר��</a></h1>					����˼����������Ʒ���޹�˾�������ڴ������ʱ�е�һ����Ʒ�ƣ�Ϊ������ϲ������İ�����ʿ�ṩһվʽ������Ʒ�ɹ�������</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic6" onmousemove="slide_ty(6)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63547.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang018.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63547.html" target="_blank">�������ƹ㴿��Ұ���Ļ� 8264չ���ƶ�ר��</a></h1>					�ƶ�YODOƷ�Ʊ��֡����С���������Ȼ���������������������Ұ���Ļ������й�������ȫ�½������������������顣</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic7" onmousemove="slide_ty(7)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63542.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang019.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63542.html" target="_blank">REI��Ʒ�����ܼ�Kevin �ͼ۸��ǳɹ�������</a></h1>	
REI���۵Ĳ�ֹ�ǲ�Ʒ���������ǵ����ʽ�����Ǻ��������ǵ����ʽ����֧�������߽���Ȼ�����ʽ��</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic8" onmousemove="slide_ty(8)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63549.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang020.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63549.html" target="_blank">���조�Ҹ����ƶ���԰�� 8264չ�����ߵ�ר��</a></h1>					���ߵѵ����������鲼ȫ��100������У�����Ϊ����¶Ӫ���ϻ��й����ٷ�����Ʒ�ƣ��й�����¶ӪЭ��Ψһָ����Ʒ��װ�����Ʒ����ȫ��ңң���ȡ�</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic9" onmousemove="slide_ty(9)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63551.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang021.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63551.html" target="_blank">����ԭ��̬�������м����� 8264չ�����ǿ�ר��</a></h1>	
SURETEX������Ϊ���Ⱞ�����ṩ��Ʒ�ʵĹ����������������ϵĲ�Ʒ�����С�ԭ��̬�������мҡ���Ʒ������������������Ʒ��Ƶ��У��������ḻ�Ĳ�Ʒϵ�С�</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic10" onmousemove="slide_ty(10)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63552.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang022.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63552.html" target="_blank">������ �Ҿ��С� 8264չ���ֳ�ר��caravaƷ��</a></h1>
CARAVA��Ϊרҵ����Ʒ��, �ᳫ��̼��������ں�רҵ������ʱ�����з�񣬳��������˴����黧���������ɫ����Ȼ��ӵ��������Ȼ��г֮����</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic11" onmousemove="slide_ty(11)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63553.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang023.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63553.html" target="_blank">רҵ���ⳬԽ���� 8264չ���ֳ�ר�ü���Ʒ��</a></h1>					����һֱ�������ڶ������̽���ߺ������������ǵ�ʵ�ʾ���ȥ���ϵ����Ʋ�Ʒ��������Ϊ���ڻ����˶���Ʒ�������ṩרҵ�����װװ����</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic12" onmousemove="slide_ty(12)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63548.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang025.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63834.html" target="_blank">Vasqueȫ�������ܼ� 2011�Ƴ�ϵ��רҵ��Ʒ</a></h1>					
VASQUE��1965��������������������֪����Red WingЬҵ��˾���ӹ�˾�����죬VASQUE��������Ѿ���Ϊ�˸���������Ь�ӵ�ͬ��ʡ�</div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <script language="javascript">
                var _tnum;
                var tMyMar;
                var tSize=12;
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
        <!--��̸��ʼ-->
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
                    	<div class="hudongimg"><a href="http://www.8264.com/63533.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/waiguan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/63533.html" style="color:#FF0000" target="_blank">չ��չ���⾰</a><br>�ص㣺�������һ�������<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/63510.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/8264zw.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/63510.html" style="color:#FF0000" target="_blank">8264չλ����</a><br>�ص㣺8264չλ<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-669206-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/wujiahuo.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-669206-1-1.html" style="color:#FF0000" target="_blank">8264"�޼ٻ���������"</a><br>�ص㣺8264չλ<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-664541-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/caifangtuan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-664541-1-1.html" style="color:#FF0000" target="_blank">2011��ISPO�ɷ�����ļ</a><br>�ص㣺8264չλ<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-676667-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/dianzhujuhui.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-676667-1-1.html" target="_blank">ȫ�������ۻ�</a><br>�ص㣺�ᱦ�����5082<br>ʱ�䣺24����8��</div>
                        <div style="clear:both;"></div>
                    </div>
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=675549&amp;page=1&amp;extra=#pid11741732pid11741732" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/lvyoujuhui.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=675549&amp;page=1&amp;extra=#pid11741732pid11741732" target="_blank">����ISPO¿�Ѿۻ�</a><br>�ص㣺���һ�������<br>ʱ�䣺23����6��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://u.8264.com/home-space-uid-34144490-do-album-picid-2608334.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/meiriyitu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://u.8264.com/home-space-uid-34144490-do-album-picid-2608334.html" target="_blank">8264��ɫ��ÿ��һͼ</a></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://8.8264.com/invest/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhaoshangpt.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://8.8264.com/invest/" target="_blank">����ƽ̨</a></div>
                        <div style="clear:both;"></div>
                    </div>
<!--div class="hudongall">
                    	<div class="hudongimg"><a href="http://bx.8264.com/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/baoxian.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bx.8264.com/" target="_blank">���Ᵽ��</a><br>ר�����¿�����<br></div>
                        <div style="clear:both;"></div>
                    </div-->
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment01">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/qiatan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">����Ǣ̸ר��</a><br>�ص㣺4.512չλ<br>ʱ�䣺2011��2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/qudao.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">�ٻ��������̻�
</a><br>�ص㣺չ����E-236������<br>ʱ�䣺2��23��ȫ��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/liuxingqushi.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">�������Ʒ�����
</a><br>�ص㣺4.608չλ<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuandai.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">�ɴ�������ר��</a><br>�ص㣺4.608չλ<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zpqu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">������</a><br>�ص㣺1.800չλ<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment02">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/yataixue.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">��̫ѩ�ز�ҵ��̳
</a><br>�ص㣺������M-306A������<br>ʱ�䣺2��24��ȫ��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/lingshoult.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">��������̳</a><br>�ص㣺������M-311������<br>ʱ�䣺2��25��ȫ��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/liuxing.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">����������̳</a><br>�ص㣺������M-308������<br>ʱ�䣺2��23��ȫ��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/huwaichanyelt.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">�й������ҵ��̳</a><br>�ص㣺������M-308������<br>ʱ�䣺2��24��ȫ��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/meiguolt.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">��������Э����̳</a><br>�ص㣺������M-306B������<br>ʱ�䣺2��23��24��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/dichan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">�й���ҵ�ز����</a><br>�ص㣺������M-311������<br>ʱ�䣺2��23��24��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/fanhuwai.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">�������ҵ��Ӣ��̳</a><br>�ص㣺չ����E-231������<br>ʱ�䣺2��23��ȫ��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shengtai.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">������̬��·������̳</a><br>�ص㣺չ����E-231������<br>ʱ�䣺2��24��ȫ��</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment03">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispopanyanjie.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">ispo china 2011���ҽ�</a><br>�ص㣺����������<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/paobu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">���������ܲ����껪</a><br>�ص㣺4.710չλ<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/huaban.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">ispo china ������껪
</a><br>�ص㣺����������<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment04">
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-669206-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/wujiahuo.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-669206-1-1.html" style="color:#FF0000" target="_blank">8264"�޼ٻ���������"</a><br>�ص㣺8264չλ<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-664541-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/caifangtuan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-664541-1-1.html" style="color:#FF0000" target="_blank">2011��ISPO�ɷ�����ļ</a><br>�ص㣺8264չλ<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/baihuojingying.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">�ٻ���ҵ��Ӣ֮ҹ
</a><br>�ص㣺����<br>ʱ�䣺2��22��18:00</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zouxiu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">ʱװ����װ��������
</a><br>�ص㣺4.710չλ ʱװ��װ��������<br>ʱ�䣺2��23-25��</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/jinxiniu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">��Ϭţ���佱����</a><br>�ص㣺�������๦��A��<br>ʱ�䣺2��24��17:30</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/banjiang.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">װ���󽱰佱����</a><br>�ص㣺4.710չλ<br>ʱ�䣺2��24��14:00</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <!--��̸����-->
        <!--װ����ʼ-->
        <div class="mid">
        	<div class="title960">չ��װ��<a name="n5"></a></div>
            <div class="zball">
            	<div class="zbgun">
                	<div class="gun" id="de">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td id="de1">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63667.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuangxinzb008.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63667.html" target="_blank">��������͸���Բ���</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63666.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuangxinzb009.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63666.html" target="_blank">���ӯ��Ʒ��ר��ɡ��</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63658.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuangxinzb010.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63658.html" target="_blank">��Ȼ���ݻ����������</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63662.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuangxinzb011.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63662.html" target="_blank">Trezeta����Ҷ������ɽЬ</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63664.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuangxinzb012.jpg"/></a></div>
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
                        <div class="zhantu"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zb223.jpg" width="390" height="220" border="0" /></div>
                        <div class="zhantutitle">
                            <div class="zhantutitle_l">8264ֱ��--װ����Ʒ</div>
                            <div class="zhantutitle_r"><a href="#" target="_blank">2011 ispo װ����������</a></div>
                            <div style="clear:both;"></div>
                        </div>
                        <div class="zhantunew">
                            <!--//װ�������б� 12�� //-->
                            <!--[diy=zblist]--><div id="zblist" class="area"><div id="frame379R63" class=" frame move-span cl frame-1"><div id="frame379R63_left" class="column frame-1-c"><div id="frame379R63_left_temp" class="move-span temp"></div><?php block_display('1617'); ?></div></div></div><!--[/diy]-->
                            <div style="clear:both;"></div>
                      </div>
                    </div>
                    <div class="mid7con_r">
                    <!--//װ��ͼ�� 9�� //-->
                    <!--[diy=zblisttw]--><div id="zblisttw" class="area"><div id="framet93u5j" class=" frame move-span cl frame-1"><div id="framet93u5j_left" class="column frame-1-c"><div id="framet93u5j_left_temp" class="move-span temp"></div><?php block_display('1651'); ?></div></div></div><!--[/diy]-->
                </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="zhuangbeinew">
<!--//չ��װ��ͼ���б� //-->
<!--[diy=zhzblistimg]--><div id="zhzblistimg" class="area"><div id="frameGwv9Dh" class=" frame move-span cl frame-1"><div id="frameGwv9Dh_left" class="column frame-1-c"><div id="frameGwv9Dh_left_temp" class="move-span temp"></div><?php block_display('1685'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
        <!--װ������-->
        <!--��Ƶ��ʼ-->
        <div class="mid">
        	<div class="title960">������Ƶ<a name="n7"></a></div>
            <div class="shipinall">
            	<div class="shipin_l" style=" width:370px; height:275px; font-size:24px; text-align:center; line-height:275px;">��Ƶ�ѹ���</div>
                <div class="shipin_r">
                	<ul>
                        <li><a href="http://www.8264.com/63525.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin013.jpg"/></a></li>
                        <li><a href="http://www.8264.com/63524.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin014.jpg"/></a></li>
                        <li><a href="http://www.8264.com/63529.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin015.jpg"/></a></li>
                        <li><a href="http://www.8264.com/63528.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin016.jpg"/></a></li>
                        <li><a href="http://www.8264.com/63527.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin017.jpg"/></a></li>
                        <li><a href="http://www.8264.com/63526.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin018.jpg"/></a></li>
                    	<li><a href="http://www.8264.com/63563.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin019.jpg"/></a></li>
                        <li><a href="http://www.8264.com/63564.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin020.jpg"/></a></li>
                        <li><a href="http://www.8264.com/63565.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin021.jpg"/></a></li>
                        <li><a href="http://www.8264.com/63566.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin022.jpg"/></a></li>
                        <li><a href="http://www.8264.com/63567.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin023.jpg"/></a></li>
                        <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shipin006.jpg"/></a></li>
                    </ul>
                    <div style="clear:both;"></div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
        <!--��Ƶ����-->
        <!--չλͼƬ��ʼ-->
        <div class="mid">
        	<div class="title960">չλͼƬ<a name="n10"></a></div>
            <div class="zwall">               
                <!--//չλͼƬ 10�� //-->
                <!--[diy=zwtp]--><div id="zwtp" class="area"><div id="frameyDdQ3v" class=" frame move-span cl frame-1"><div id="frameyDdQ3v_left" class="column frame-1-c"><div id="frameyDdQ3v_left_temp" class="move-span temp"></div><?php block_display('1684'); ?></div></div></div><!--[/diy]-->
                <div style="clear:both"></div>
            </div>
        </div>
        <!--չλͼƬ����-->
        <!--���ͻ�����ʼ-->
        <div class="mid">
        	<div class="mid3_l">
            	<div class="mid3_l_title">��չ���<a name="n6"></a></div>
                <div class="boke">
                    <!--//���������б� 24�� //-->
                    <!--[diy=bklist]--><div id="bklist" class="area"><div id="frameTQh4d7" class=" frame move-span cl frame-1"><div id="frameTQh4d7_left" class="column frame-1-c"><div id="frameTQh4d7_left_temp" class="move-span temp"></div><?php block_display('1618'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
</div>
            <div class="mid3_r">
            	<div class="mid3_r_title">չ��˲��<a name="n8"></a></div>
                <div class="hxone" id="listmarquee">
                	<!--//�����б� 3�� //-->
<!--[diy=hxlist]--><div id="hxlist" class="area"><div id="frameG76gUb" class=" frame move-span cl frame-1"><div id="frameG76gUb_left" class="column frame-1-c"><div id="frameG76gUb_left_temp" class="move-span temp"></div><?php block_display('1619'); ?></div></div></div><!--[/diy]-->
                    <script src="http://static.8264.com/oldcms/moban/zt/2011ispo/js/ScrollText.js" type="text/javascript"></script>
                    <script language="javascript" type="text/javascript">
                    window.onload = function()
                    {
                    var marquee = new ScrollText("listmarquee");
                    marquee.LineHeight = 60;
                    marquee.Amount = 1;
                    marquee.Timeout = 30;
                    marquee.Delay = 30;
                    marquee.Start();
                    }
                    </script>
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
                            <div class="ztcon" id="hhotcomment1">
                                <div class="ztconimg"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhanwei.jpg"/></div>
                                <div class="ztcon_r">
                                    <!--div class="brandall"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/testbrand.jpg"></a></div-->
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--����չ������-->
                            <!--1��չ��-->
                            <div class="ztcon" style="display:none" id="hhotcomment2">
                                <div class="ztconimg"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhanguan01.jpg" /></div>
                                <div class="ztcon_r">
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai001.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=290" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai002.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=193" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai003.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=512" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai004.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=798" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai005.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--1��չ������-->
                            <!--2��չ��-->
                            <div class="ztcon" style="display:none" id="hhotcomment3">
                                <div class="ztconimg"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhanguan02.jpg"/></div>
                                <div class="ztcon_r">
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=79" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai006.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=771" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai007.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=527" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai008.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=61" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai009.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=73" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai010.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=45" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai011.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=60" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai012.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=51" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai013.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/index.php?homepage=33775355" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai014.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=534" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai015.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=417" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai029.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=85" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai030.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=290" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai031.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=83" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai032.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--2��չ������-->
                            <!--3��չ��-->
                            <div class="ztcon" style="display:none" id="hhotcomment4">
                                <div class="ztconimg"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhanguan03.jpg"/></div>
                                <div class="ztcon_r">
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=251" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai016.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=202" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai017.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=1268" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai018.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=144" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai019.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=53" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai020.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=64" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai021.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=80" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai022.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=1131" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai023.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--3��չ������-->
                            <!--4��չ��-->
                            <div class="ztcon" style="display:none" id="hhotcomment5">
                                <div class="ztconimg"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhanguan04.jpg"/></div>
                                <div class="ztcon_r">
                                    
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=507" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai024.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=440" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai025.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=641" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai026.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=1734" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai027.jpg"></a></div>
                                    <div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=55" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai028.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=1745" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai033.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=207" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai034.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=794" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai035.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=236" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai036.jpg"></a></div>
<div class="brandall"><a href="http://8.8264.com/brand/show.php?itemid=120" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/pinpai037.jpg"></a></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--4��չ������-->
                        </div>
                        <script language="javascript">
                function settHotph_2(i)
                {
                 selecttHot2(i);
                }
                function selecttHot2(i)
                {
                  for(var id = 1;id<=5;id++)
                 {
                  var bb="hhotcomment"+id;
                  if(id==i)
                  document.getElementById(bb).style.display="";
                  else
                  document.getElementById(bb).style.display="none";
                 } 
                  for(var id = 1;id<=5;id++)
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
                            <div class="zg" id="hhotdiv1_2" onmouseover="settHotph_2(1);"><a href="javascript:void(0)" target="_self">���ݷֲ�</a></div>
                            <div class="zg1" id="hhotdiv2_2" onmouseover="settHotph_2(2);"><a href="javascript:void(0)" target="_self">1�Ź�</a></div>
                            <div class="zg1" id="hhotdiv3_2" onmouseover="settHotph_2(3);"><a href="javascript:void(0)" target="_self">2�Ź�</a></div>
                            <div class="zg1" id="hhotdiv4_2" onmouseover="settHotph_2(4);"><a href="javascript:void(0)" target="_self">3�Ź�</a></div>
                            <div class="zg1" id="hhotdiv5_2" onmouseover="settHotph_2(5);"><a href="javascript:void(0)" target="_self">4�Ź�</a></div>
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
                    	<li><a href="http://www.8264.com/portal-topic-topicid-1301.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo1.jpg"></a><br><a href="http://www.8264.com/portal-topic-topicid-1301.html" target="_blank">ipso china 2010ר��</a></li>
                        <li><a href="http://www.8264.com/topic/1215.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo2.jpg"></a><br><a href="http://www.8264.com/topic/1215.html" target="_blank">ipso china 2009ר��</a></li>
                        <li><a href="http://www.8264.com/topic/1076.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo3.jpg"></a><br><a href="http://www.8264.com/topic/1076.html" target="_blank">ipso china 2008ר��</a></li>
                        <li><a href="http://www.8264.com/topic/593.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo4.jpg"></a><br><a href="http://www.8264.com/topic/593.html" target="_blank">ipso china 2007ר��</a></li>
                        <li><a href="http://www.8264.com/topic/521.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo5.jpg"></a><br><a href="http://www.8264.com/topic/521.html" target="_blank">ipso china 2006ר��</a></li>
                    </ul>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--չ̨������ع˽���-->
        <!--��Ů��ʼ-->
        <div class="mid">
        	<div class="title960">չ����Ů<a name="n9"></a></div>
            <div class="meinvall">
            	<div>
                	<div class="meinv_l"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/mm.jpg"></a></div>
                    <div class="meinv_r">
                        <!--//��Ů���Ҳ� 12�� //-->
                        <!--[diy=mvuplist]--><div id="mvuplist" class="area"><div id="frameirp5us" class=" frame move-span cl frame-1"><div id="frameirp5us_left" class="column frame-1-c"><div id="frameirp5us_left_temp" class="move-span temp"></div><?php block_display('1620'); ?></div></div></div><!--[/diy]-->
                        <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div>
                    <!--//��Ů����һ�� 12�� //-->
                    <!--[diy=mvdownlist]--><div id="mvdownlist" class="area"><div id="framef2DU59" class=" frame move-span cl frame-1"><div id="framef2DU59_left" class="column frame-1-c"><div id="framef2DU59_left_temp" class="move-span temp"></div><?php block_display('1621'); ?></div></div></div><!--[/diy]-->
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
