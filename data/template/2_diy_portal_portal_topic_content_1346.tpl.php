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
<!--自己js开始-->
<script src="http://static.8264.com/oldcms/moban/zt/2011ispo/js/common.js" type="text/javascript" type="text/javascript" language="javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2011ispo/js/jquery-1.4.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2011ispo/js/jquery.lazy-1.3.1.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function(){
  jQuery.lazy({src:'http://static.8264.com/oldcms/moban/zt/2011ispo/js/jquery.darizi.js',name:'darizi',dependencies:{js:['http://static.8264.com/oldcms/moban/zt/2011ispo/js/jquery.countdown.js']},cache:true});
  // 大日子
  var ndate = new Date(2012,1,22); 
  jQuery('.darizi').darizi({ bigDay:ndate,last:3});

});
</script>
<!--自己js结束--><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
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
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>   
<!--dx代码结束-->
<!--diy样式开始-->
<style id="diy_style" type="text/css">#frame7On2Hm { margin:0px !important;border:medium none !important;}#portal_block_1580 { margin:0px !important;border:medium none !important;}#portal_block_1580 .content { margin:0px !important;}#frame379R63 { margin:0px !important;border:medium none !important;}#portal_block_1617 { margin:0px !important;border:medium none !important;}#portal_block_1617 .content { margin:0px !important;}#frameTQh4d7 { margin:0px !important;border:medium none !important;}#portal_block_1618 { margin:0px !important;border:medium none !important;}#portal_block_1618 .content { margin:0px !important;}#frameG76gUb { margin:0px !important;border:medium none !important;}#portal_block_1619 { margin:0px !important;border:medium none !important;}#portal_block_1619 .content { margin:0px !important;}#frameirp5us { margin:0px !important;border:medium none !important;}#portal_block_1620 { margin:0px !important;border:medium none !important;}#portal_block_1620 .content { margin:0px !important;}#framef2DU59 { margin:0px !important;border:medium none !important;}#portal_block_1621 { margin:0px !important;border:medium none !important;}#portal_block_1621 .content { margin:0px !important;}#frame33qbg6 { margin:0px !important;border:medium none !important;}#portal_block_1650 { margin:0px !important;border:medium none !important;}#portal_block_1650 .content { margin:0px !important;}#framet93u5j { margin:0px !important;border:medium none !important;}#portal_block_1651 { margin:0px !important;border:medium none !important;}#portal_block_1651 .content { margin:0px !important;}#frameyDdQ3v { margin:0px !important;border:medium none !important;}#portal_block_1684 { margin:0px !important;border:medium none !important;}#portal_block_1684 .content { margin:0px !important;}#frameGwv9Dh { margin:0px !important;border:medium none !important;}#portal_block_1685 { margin:0px !important;border:medium none !important;}#portal_block_1685 .content { margin:0px !important;}#frameOn4JZ4 { margin:0px !important;border:medium none !important;}#portal_block_1686 { margin:0px !important;border:medium none !important;}#portal_block_1686 .content { margin:0px !important;}</style>
<!--diy样式结束-->
<!--自己样式开始-->
<link href="http://static.8264.com/oldcms/moban/zt/2011ispo/style/style.css" rel="stylesheet" type="text/css" />
<!--自己样式结束-->
<div class="warpper">
<div class="warpper_960">
        <!--导航开始-->
        <div class="navall"><a href="http://www.8264.com/" target="_blank">8264首页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/topic/1346.html#n1">展会动态</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n2">展会地图</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n10">展位风采</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n3">互动专区</a>&nbsp;|&nbsp;<a href="http://www.8264.com/topic/1346.html#n4">专访</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n5">新品</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n6">驴友看ispo</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n7">视频</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n8">花絮</a>&nbsp;|&nbsp;<a href="/topic/1346.html#n9">美女</a></div>
        <!--导航结束-->
        <!--第一部分开始-->
        <div class="mid">
        	<div class="l">
            	<!--轮播开始-->
            	<div class="lunboall">
                	<div class="ltitle1">焦点关注</div>
                    <div class="lunbo">
                        <!--//轮播//-->
            			<!--[diy=lunbo]--><div id="lunbo" class="area"><div id="frame33qbg6" class=" frame move-span cl frame-1"><div id="frame33qbg6_left" class="column frame-1-c"><div id="frame33qbg6_left_temp" class="move-span temp"></div><?php block_display('1650'); ?></div></div></div><!--[/diy]-->
                    </div>
                </div>
                <!--轮播结束-->
                <div class="l2">
                	<div class="zhinantitle">观展指南</div>
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
                	<div class="mtitle">展会头条</div>
                    <div class="mcon">
<div class="toutiaocon">第七届亚洲运动用品与时尚展于2011年2月23日至25日期间举行，8264报道小组将会为您带来第一手展会资讯，各品牌装备新品资讯，欢迎您关注本专题。</div>
                        <!--//展会头条 10条 标题长度30//-->
            			<!--[diy=zhtt]--><div id="zhtt" class="area"><div id="frameOn4JZ4" class=" frame move-span cl frame-1"><div id="frameOn4JZ4_left" class="column frame-1-c"><div id="frameOn4JZ4_left_temp" class="move-span temp"></div><?php block_display('1686'); ?></div></div></div><!--[/diy]-->
 </div>
                </div>
                <div class="m1">
                	<div class="mtitle">展会进程<a name="n1"></a></div>
                    <div class="toutiaolist">
                        <!--//头条列表 12条 标题长度30//-->
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
                    	<li><a href="http://bbs.8264.com/thread-669206-1-1.html"  style="color:#FF0000" target="_blank">8264"无假货店铺联盟"</a></li>
                        <li><a href="http://bbs.8264.com/thread-664541-1-1.html" style="color:#FF0000" target="_blank">2011年ISPO采访团招募</a></li>
                        <li><a href="http://bbs.8264.com/thread-676667-1-1.html" style="color:#FF0000" target="_blank">首届ISPO全国店主聚会</a></li>
<li><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=675549&amp;page=1&amp;extra=#pid11741732pid11741732" style="color:#FF0000" target="_blank"> 2011年北京ISPO驴友聚会</a></li>
                        <li><a href="http://bbs.8264.com/thread-677467-1-1.html" target="_blank">长峪城—石峡关穿越</a></li>
<li><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">ispo china 2011攀岩节</a></li>
                        <li><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">ispo china 滑板嘉年华</a></li>
                    </ul>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--第一部分结束-->
        <!--专访开始-->
        <div class="mid">
        	<div class="title960">论&nbsp;&nbsp;&nbsp;&nbsp;战<a name="n4"></a></div>
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
                    <h1><a href="http://www.8264.com/63500.html" target="_blank">注重长期稳健发展 北极狐总经理Martin专访</a></h1>Fjallraven和Hanwag都是追求高端品质的品牌，目前中国的销售市场还是商场为主，而Hanwag主要进入户外店，因为Fjallrave不仅有专业产品也可休闲日常穿着。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic2" onmousemove="slide_ty(2)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63540.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang014.jpg"/></a></div>
                    <div class="zf_imginfo">
    <h1><a href="http://www.8264.com/63540.html" target="_blank">始终背包前行 8264专访钻石级背包品牌Osprey</a></h1>	Osprey每款背包最终推出都会经历5到6个测试版本，在美国通过Osprey专门的测试团队和专业玩家对新产品进行性能测试，通过亲身体验反复研究反馈信息，从而运用到设计当中，最终诞生一个新产品。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic3" onmousemove="slide_ty(3)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63539.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang015.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63539.html" target="_blank">8264专访美国Oboz总裁兼创始人John Connelly </a></h1>					Oboz源于美国，专注于鞋品的制造和研发，设计中将环保理念蕴含其中，最大程度上了解户外运动者的细节需求，追求真实的户外印迹。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic4" onmousemove="slide_ty(4)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63543.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang016.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63543.html" target="_blank">倡导“轻户外理念” 8264展会专访哥仑步品牌</a></h1>					Kolumb（哥仑步）以打造最具中国文化特色的户外品牌为己任，从环境友好型社会理念出发，结合户外用品的行业特性，提出以“低碳环保，轻松自然”为导向的“轻户外”理念。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic5" onmousemove="slide_ty(5)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63546" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang017.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63546.html" target="_blank">树白领时尚第一户外品牌 8264展会思凯乐专访</a></h1>					北京思凯乐旅游用品有限公司，致力于打造白领时尚第一户外品牌，为国内外喜爱户外的白领人士提供一站式户外用品采购及服务。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic6" onmousemove="slide_ty(6)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63547.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang018.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63547.html" target="_blank">致力于推广纯正野餐文化 8264展会悠度专访</a></h1>					悠度YODO品牌秉持“休闲、健康、自然、环保”的理念，将纯正的野餐文化带到中国，传播全新健康户外休闲生活体验。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic7" onmousemove="slide_ty(7)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63542.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang019.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63542.html" target="_blank">REI产品整合总监Kevin 低价格不是成功的因素</a></h1>	
REI销售的不止是产品，还是人们的生活方式，我们很重视人们的生活方式，并支持这种走进自然的生活方式。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic8" onmousemove="slide_ty(8)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63549.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang020.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63549.html" target="_blank">打造“幸福的移动花园” 8264展会牧高笛专访</a></h1>					牧高笛的销售渠道遍布全国100多个城市，并成为国际露营联合会中国区官方合作品牌，中国汽车露营协会唯一指定用品，装备类产品销量全国遥遥领先。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic9" onmousemove="slide_ty(9)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63551.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang021.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63551.html" target="_blank">秉承原生态户外旅行家理念 8264展会数星客专访</a></h1>	
SURETEX致力于为户外爱好者提供高品质的功能性与舒适性相结合的产品，秉承“原生态户外旅行家”的品牌理念，将该理念融入产品设计当中，开发出丰富的产品系列。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic10" onmousemove="slide_ty(10)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63552.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang022.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63552.html" target="_blank">“我想 我就行” 8264展会现场专访carava品牌</a></h1>
CARAVA作为专业户外品牌, 提倡低碳户外生活，融合专业户外与时尚休闲风格，倡导户外人大胆体验户外生活、与绿色大自然相拥，体验自然和谐之美。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic11" onmousemove="slide_ty(11)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63553.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang023.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63553.html" target="_blank">专业户外超越梦想 8264展会现场专访极星品牌</a></h1>					极星一直保持与众多资深户外探险者合作，借助他们的实际经验去不断地完善产品，致力于为国内户外运动用品零售商提供专业户外服装装备。</div>
                    </div>
                    <div class="zf_r_one" id="ce_pic12" onmousemove="slide_ty(12)">
                    <div class="zf_imgb"><a href="http://www.8264.com/63548.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhuanfang025.jpg"/></a></div>
                    <div class="zf_imginfo">
<h1><a href="http://www.8264.com/63834.html" target="_blank">Vasque全球销售总监 2011推出系列专业新品</a></h1>					
VASQUE于1965年在美国成立，是世界知名的Red Wing鞋业公司的子公司。今天，VASQUE这个名字已经成为了高质量户外鞋子的同义词。</div>
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
        <!--专访结束-->
        <!--访谈开始-->
        <div class="mid">
        	<div class="title960">互动专区<a name="n3"></a></div>
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
                        <div class="hudongwen"><a href="http://www.8264.com/63533.html" style="color:#FF0000" target="_blank">展会展馆外景</a><br>地点：北京国家会议中心<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.8264.com/63510.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/8264zw.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.8264.com/63510.html" style="color:#FF0000" target="_blank">8264展位欣赏</a><br>地点：8264展位<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-669206-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/wujiahuo.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-669206-1-1.html" style="color:#FF0000" target="_blank">8264"无假货店铺联盟"</a><br>地点：8264展位<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-664541-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/caifangtuan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-664541-1-1.html" style="color:#FF0000" target="_blank">2011年ISPO采访团招募</a><br>地点：8264展位<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-676667-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/dianzhujuhui.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-676667-1-1.html" target="_blank">全国店主聚会</a><br>地点：丰宝恒大厦5082<br>时间：24号晚8点</div>
                        <div style="clear:both;"></div>
                    </div>
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=675549&amp;page=1&amp;extra=#pid11741732pid11741732" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/lvyoujuhui.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=675549&amp;page=1&amp;extra=#pid11741732pid11741732" target="_blank">北京ISPO驴友聚会</a><br>地点：国家会议中心<br>时间：23日晚6点</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://u.8264.com/home-space-uid-34144490-do-album-picid-2608334.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/meiriyitu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://u.8264.com/home-space-uid-34144490-do-album-picid-2608334.html" target="_blank">8264特色：每日一图</a></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://8.8264.com/invest/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhaoshangpt.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://8.8264.com/invest/" target="_blank">招商平台</a></div>
                        <div style="clear:both;"></div>
                    </div>
<!--div class="hudongall">
                    	<div class="hudongimg"><a href="http://bx.8264.com/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/baoxian.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bx.8264.com/" target="_blank">户外保险</a><br>专门针对驴友设计<br></div>
                        <div style="clear:both;"></div>
                    </div-->
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment01">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/qiatan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">代理洽谈专区</a><br>地点：4.512展位<br>时间：2011年2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/qudao.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">百货渠道招商会
</a><br>地点：展览区E-236会议室<br>时间：2月23日全天</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/liuxingqushi.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">流行趋势发布区
</a><br>地点：4.608展位<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuandai.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">可穿戴技术专区</a><br>地点：4.608展位<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zpqu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">帐篷区</a><br>地点：1.800展位<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment02">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/yataixue.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">亚太雪地产业论坛
</a><br>地点：会议区M-306A会议室<br>时间：2月24日全天</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/lingshoult.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">零售商论坛</a><br>地点：会议区M-311会议室<br>时间：2月25日全天</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/liuxing.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">流行趋势论坛</a><br>地点：会议区M-308会议室<br>时间：2月23日全天</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/huwaichanyelt.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">中国户外产业论坛</a><br>地点：会议区M-308会议室<br>时间：2月24日全天</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/meiguolt.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">美国户外协会论坛</a><br>地点：会议区M-306B会议室<br>时间：2月23、24日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/dichan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">中国商业地产年会</a><br>地点：会议区M-311会议室<br>时间：2月23、24日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/fanhuwai.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">泛户外产业精英论坛</a><br>地点：展览区E-231会议室<br>时间：2月23日全天</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/shengtai.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">户外生态线路建设论坛</a><br>地点：展览区E-231会议室<br>时间：2月24日全天</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment03">
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispopanyanjie.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">ispo china 2011攀岩节</a><br>地点：序厅攀岩区<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/paobu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">北京冬季跑步嘉年华</a><br>地点：4.710展位<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/huaban.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">ispo china 滑板嘉年华
</a><br>地点：序厅滑板区<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div class="hudongr" style=" display:none;" id="hotttcomment04">
<div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-669206-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/wujiahuo.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-669206-1-1.html" style="color:#FF0000" target="_blank">8264"无假货店铺联盟"</a><br>地点：8264展位<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://bbs.8264.com/thread-664541-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/caifangtuan.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://bbs.8264.com/thread-664541-1-1.html" style="color:#FF0000" target="_blank">2011年ISPO采访团招募</a><br>地点：8264展位<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/baihuojingying.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">百货商业精英之夜
</a><br>地点：北京<br>时间：2月22日18:00</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zouxiu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">时装表演装备发布秀
</a><br>地点：4.710展位 时装和装备发布区<br>时间：2月23-25日</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/jinxiniu.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">金犀牛奖颁奖典礼</a><br>地点：会议区多功能A厅<br>时间：2月24日17:30</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="hudongall">
                    	<div class="hudongimg"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/banjiang.jpg" width="120" height="80" border="0" /></a></div>
                        <div class="hudongwen"><a href="http://www.ispochina.com.cn/chinese/Intro_01.aspx?rootid=043836193697&amp;classid=427600418222" target="_blank">装备大奖颁奖典礼</a><br>地点：4.710展位<br>时间：2月24日14:00</div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <!--访谈结束-->
        <!--装备开始-->
        <div class="mid">
        	<div class="title960">展会装备<a name="n5"></a></div>
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
                                                    <div class="wen"><a href="http://www.8264.com/63667.html" target="_blank">户外面料透气性测试</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63666.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuangxinzb009.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63666.html" target="_blank">香港盈威品牌专利伞包</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63658.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuangxinzb010.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63658.html" target="_blank">天然蔺草会呼吸防潮垫</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63662.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuangxinzb011.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63662.html" target="_blank">Trezeta“百叶窗”登山鞋</a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="imgall">
                                                    <div class="imgallimg"><a href="http://www.8264.com/63664.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/chuangxinzb012.jpg"/></a></div>
                                                    <div class="wen"><a href="http://www.8264.com/63664.html" target="_blank">kailas会呼吸的冲锋衣</a></div>
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
                              var speed01=20//速度数值越大速度越慢
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
                            <div class="zhantutitle_l">8264直击--装备新品</div>
                            <div class="zhantutitle_r"><a href="#" target="_blank">2011 ispo 装备给力集结</a></div>
                            <div style="clear:both;"></div>
                        </div>
                        <div class="zhantunew">
                            <!--//装备文字列表 12条 //-->
                            <!--[diy=zblist]--><div id="zblist" class="area"><div id="frame379R63" class=" frame move-span cl frame-1"><div id="frame379R63_left" class="column frame-1-c"><div id="frame379R63_left_temp" class="move-span temp"></div><?php block_display('1617'); ?></div></div></div><!--[/diy]-->
                            <div style="clear:both;"></div>
                      </div>
                    </div>
                    <div class="mid7con_r">
                    <!--//装备图文 9条 //-->
                    <!--[diy=zblisttw]--><div id="zblisttw" class="area"><div id="framet93u5j" class=" frame move-span cl frame-1"><div id="framet93u5j_left" class="column frame-1-c"><div id="framet93u5j_left_temp" class="move-span temp"></div><?php block_display('1651'); ?></div></div></div><!--[/diy]-->
                </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="zhuangbeinew">
<!--//展会装备图文列表 //-->
<!--[diy=zhzblistimg]--><div id="zhzblistimg" class="area"><div id="frameGwv9Dh" class=" frame move-span cl frame-1"><div id="frameGwv9Dh_left" class="column frame-1-c"><div id="frameGwv9Dh_left_temp" class="move-span temp"></div><?php block_display('1685'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
        <!--装备结束-->
        <!--视频开始-->
        <div class="mid">
        	<div class="title960">给力视频<a name="n7"></a></div>
            <div class="shipinall">
            	<div class="shipin_l" style=" width:370px; height:275px; font-size:24px; text-align:center; line-height:275px;">视频已过期</div>
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
        <!--视频结束-->
        <!--展位图片开始-->
        <div class="mid">
        	<div class="title960">展位图片<a name="n10"></a></div>
            <div class="zwall">               
                <!--//展位图片 10条 //-->
                <!--[diy=zwtp]--><div id="zwtp" class="area"><div id="frameyDdQ3v" class=" frame move-span cl frame-1"><div id="frameyDdQ3v_left" class="column frame-1-c"><div id="frameyDdQ3v_left_temp" class="move-span temp"></div><?php block_display('1684'); ?></div></div></div><!--[/diy]-->
                <div style="clear:both"></div>
            </div>
        </div>
        <!--展位图片结束-->
        <!--博客花絮开始-->
        <div class="mid">
        	<div class="mid3_l">
            	<div class="mid3_l_title">观展随感<a name="n6"></a></div>
                <div class="boke">
                    <!--//博客评论列表 24条 //-->
                    <!--[diy=bklist]--><div id="bklist" class="area"><div id="frameTQh4d7" class=" frame move-span cl frame-1"><div id="frameTQh4d7_left" class="column frame-1-c"><div id="frameTQh4d7_left_temp" class="move-span temp"></div><?php block_display('1618'); ?></div></div></div><!--[/diy]-->
                    <div style="clear:both;"></div>
                </div>
</div>
            <div class="mid3_r">
            	<div class="mid3_r_title">展会瞬间<a name="n8"></a></div>
                <div class="hxone" id="listmarquee">
                	<!--//花絮列表 3条 //-->
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
        <!--博客花絮结束-->
        <!--展台和往届回顾开始-->
        <div class="mid">
        	<div class="mid3_l">
            	<div class="mid3_l_title">网上展厅<a name="n2"></a></div>
                <div class="mid3_l_con">
                	<div class="mid3_l_con_one">
                        <div class="ztconall">
                            <!--虚拟展厅开始-->
                            <div class="ztcon" id="hhotcomment1">
                                <div class="ztconimg"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/zhanwei.jpg"/></div>
                                <div class="ztcon_r">
                                    <!--div class="brandall"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/testbrand.jpg"></a></div-->
                                    <div style="clear:both;"></div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <!--虚拟展厅结束-->
                            <!--1号展厅-->
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
                            <!--1号展厅结束-->
                            <!--2号展厅-->
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
                            <!--2号展厅结束-->
                            <!--3号展厅-->
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
                            <!--3号展厅结束-->
                            <!--4号展厅-->
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
                            <!--4号展厅结束-->
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
                            <div class="zg" id="hhotdiv1_2" onmouseover="settHotph_2(1);"><a href="javascript:void(0)" target="_self">场馆分部</a></div>
                            <div class="zg1" id="hhotdiv2_2" onmouseover="settHotph_2(2);"><a href="javascript:void(0)" target="_self">1号馆</a></div>
                            <div class="zg1" id="hhotdiv3_2" onmouseover="settHotph_2(3);"><a href="javascript:void(0)" target="_self">2号馆</a></div>
                            <div class="zg1" id="hhotdiv4_2" onmouseover="settHotph_2(4);"><a href="javascript:void(0)" target="_self">3号馆</a></div>
                            <div class="zg1" id="hhotdiv5_2" onmouseover="settHotph_2(5);"><a href="javascript:void(0)" target="_self">4号馆</a></div>
                            <div style="clear:both;"></div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div class="mid3_r">
            	<div class="mid3_r_title">往届回顾</div>
                <div class="mid3_r_con">
                	<ul>
                    	<li><a href="http://www.8264.com/portal-topic-topicid-1301.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo1.jpg"></a><br><a href="http://www.8264.com/portal-topic-topicid-1301.html" target="_blank">ipso china 2010专题</a></li>
                        <li><a href="http://www.8264.com/topic/1215.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo2.jpg"></a><br><a href="http://www.8264.com/topic/1215.html" target="_blank">ipso china 2009专题</a></li>
                        <li><a href="http://www.8264.com/topic/1076.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo3.jpg"></a><br><a href="http://www.8264.com/topic/1076.html" target="_blank">ipso china 2008专题</a></li>
                        <li><a href="http://www.8264.com/topic/593.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo4.jpg"></a><br><a href="http://www.8264.com/topic/593.html" target="_blank">ipso china 2007专题</a></li>
                        <li><a href="http://www.8264.com/topic/521.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/ispo5.jpg"></a><br><a href="http://www.8264.com/topic/521.html" target="_blank">ipso china 2006专题</a></li>
                    </ul>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--展台和往届回顾结束-->
        <!--美女开始-->
        <div class="mid">
        	<div class="title960">展会美女<a name="n9"></a></div>
            <div class="meinvall">
            	<div>
                	<div class="meinv_l"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011ispo/images/mm.jpg"></a></div>
                    <div class="meinv_r">
                        <!--//美女上右侧 12条 //-->
                        <!--[diy=mvuplist]--><div id="mvuplist" class="area"><div id="frameirp5us" class=" frame move-span cl frame-1"><div id="frameirp5us_left" class="column frame-1-c"><div id="frameirp5us_left_temp" class="move-span temp"></div><?php block_display('1620'); ?></div></div></div><!--[/diy]-->
                        <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div>
                    <!--//美女下面一行 12条 //-->
                    <!--[diy=mvdownlist]--><div id="mvdownlist" class="area"><div id="framef2DU59" class=" frame move-span cl frame-1"><div id="framef2DU59_left" class="column frame-1-c"><div id="framef2DU59_left_temp" class="move-span temp"></div><?php block_display('1621'); ?></div></div></div><!--[/diy]-->
<div style="clear:both;"></div>  
                </div>
            </div>
        </div>
        <!--美女结束-->
        <!--底部开始-->
        <div class="bottom"><a href="/template/8264/about/aboutus.htm" target="_blank">8264简介</a>&nbsp;|&nbsp;<a href="/template/8264/about/ggservice/index.html" target="_blank" style="color:#FF0000;">广告服务</a>&nbsp;|&nbsp;<a href="/list/531/" target="_blank">编辑部的故事</a>&nbsp;|&nbsp;<a href="/template/8264/about/sitemap.html" target="_blank">站点地图</a>&nbsp;|&nbsp;<a href="/template/8264/about/aboutus.htm" target="_blank">联系方式</a>&nbsp;|&nbsp;<a href="http://buy.8264.com/" target="_blank">户外网购</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/thread-457062-1-1.html" target="_blank" style="color:#FF0000;">QQ群联盟</a>&nbsp;|&nbsp;<a href="http://8.8264.com/job/" target="_blank">8264招聘</a>&nbsp;|&nbsp;<a href="/template/8264/about/link/link.htm" target="_blank">友情链接</a><br>服务热线：022-23708264&nbsp;|&nbsp;传真：022-23708323&nbsp;|&nbsp;地址：天津市新技术产业园华苑产业区华天道8号海泰信息广场C座1001号<br><a href="http://bx.8264.com" target="_blank" style="color:#53792e;">户外活动有风险，8264提醒您购买</a> <a href="http://bx.8264.com" style="color:#53792e;">户外保险</a><br>除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264&nbsp;版权所有   <a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-1</a></div>
        <!--底部结束-->
</div>
    
    
    
<!--dx代码开始-->  
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?><!--dx代码结束-->
    
</div>
<!--dx代码开始-->



<!--//waper结束//-->
<?php if(empty($topic) || ($topic['usefooter'])) { ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb">
<em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?></em>
<span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="关闭">关闭</a></span>
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
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">查看</a>
</div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; } ?>

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
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>

<?php if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly">
积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分
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
<?php } ?><?php output(); ?><!--dx代码结束-->
</body>
</html>
