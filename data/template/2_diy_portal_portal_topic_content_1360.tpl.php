<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1360', 'common/header_diy');
block_get('2464,2465,2466,2467');?>
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
<base href="<?php echo $_G['siteurl'];?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
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
<style id="diy_style" type="text/css">#frameqQzryK { margin:0px !important;border:medium none !important;}#portal_block_2464 { margin:0px !important;border:medium none !important;}#portal_block_2464 .content { margin:0px !important;}#frame82DzYG { background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2465 { background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2465 .content { margin:0px !important;}#framecjTUdS { background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2466 { background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2466 .content { margin:0px !important;}#framesnP9hN { background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2467 { background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2467 .content { margin:0px !important;}</style>
<!--diy��ʽ����-->
<!--�Լ���ʽ��ʼ-->
<link href="http://static.8264.com/oldcms/moban/zt/kalaspy/style/style.css" rel="stylesheet" type="text/css" />
<!--�Լ���ʽ����-->

</head>

<body>
<div class="warpper">
<div class="banner"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/branner.jpg" border="0" /></div>
    <div class="mid">
        <div class="mid1">
            <div class="mid_l">
                <!--//�ֲ����270 �߶�220//-->
            	<!--[diy=lunbo]--><div id="lunbo" class="area"><div id="frameqQzryK" class=" frame move-span cl frame-1"><div id="frameqQzryK_left" class="column frame-1-c"><div id="frameqQzryK_left_temp" class="move-span temp"></div><?php block_display('2464'); ?></div></div></div><!--[/diy]-->
            </div>
            <div class="mid_m">
                <div class="mid_m_news">
                    <h1><a href="/66874.html" target="_blank">KAILAS�����Ľ�ȫ���������ҽ�����Բ����Ļ</a></h1>
                    
&nbsp;&nbsp;&nbsp;&nbsp;2011��KAILAS�������Ľ�ȫ���������ҽ�����������Բ����Ļ�������������������ȫ����ʡ���С��۰�̨����������ҵ����Э�ᡢ��ž�����רԺУ���ط���ؾ��ֲ���21֧���顢94������������ѡ�ֲ��������У���������Ϊ19�꣬������С�߽�Ϊ8�ꡣ<a href="/66874.html" target="_blank">��ϸ>></a>
                </div>
              <div class="mid_m_news">
                  <h1><a href="/66871.html" target="_blank" style="color:#FF0000">���¸���Ŀ�ܳɼ�</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://bbs.8264.com/thread-780827-1-1.html" target="_blank" style="color:#0000FF">����ͼ����Ƶ����</a></h1>
                    &nbsp;&nbsp;&nbsp;&nbsp;6��3����5�գ�������������Ϊ���ת��2011����Ľ�ȫ���������ҽ�����ʵ�����ҽ�������������http://bbs.8264.com/thread-780827-1-1.html�����������ֳ���ͼƬ�Լ���Ƶ����ӭ������ѹ�ע��<a href="http://bbs.8264.com/thread-780827-1-1.html" target="_blank">��ϸ>></a>                </div>
            </div>
            <div class="mid_r">
                <div class="mid_rcontitle"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/new_left.jpg" border="0" /></div>
                <div class="mid_rtitle">������Ѷ</div>
                <div class="mid_rcon">
                    <!--//������Ѷ 8��//-->
                	<!--[diy=zxlist]--><div id="zxlist" class="area"><div id="frame82DzYG" class=" frame move-span cl frame-1"><div id="frame82DzYG_left" class="column frame-1-c"><div id="frame82DzYG_left_temp" class="move-span temp"></div><?php block_display('2465'); ?></div></div></div><!--[/diy]-->
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="mid2">
        	<div class="titlebg">����С����</div>
            <div class="mid2con">
                <div class="mid2conimgall">
                    <a href="/66768.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/xiao/x1.jpg" /></a>
                    <div class="mid2conname"><a href="/66768.html" target="_blank">���޷�</a></div>
                    <div class="mid2coninfor">11��<br>���ݳ��������Ҿ��ֲ�</div>
                </div>
                <div class="mid2conimgall">
                    <a href="/viewnews-66768-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/xiao/x2.jpg" /></a>
                    <div class="mid2conname"><a href="/viewnews-66768-page-2.html" target="_blank">����</a></div>
                    <div class="mid2coninfor">16��<br>�����������Ҿ��ֲ�</div>
                </div>
                <div class="mid2conimgall">
                    <a href="/viewnews-66768-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/xiao/x3.jpg" /></a>
                    <div class="mid2conname"><a href="/viewnews-66768-page-3.html" target="_blank">������</a></div>
                    <div class="mid2coninfor">15��<br>�����������Ҿ��ֲ�</div>
                </div>
                <div class="mid2conimgall">
                    <a href="/viewnews-66768-page-4.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/xiao/x4.jpg" /></a>
                    <div class="mid2conname"><a href="/viewnews-66768-page-4.html" target="_blank">�Ƶ���</a></div>
                    <div class="mid2coninfor">10��<br>�����������Ҿ��ֲ�</div>
                </div>
                <div class="mid2conimgall">
                    <a href="/viewnews-66768-page-5.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/xiao/x5.jpg" /></a>
                    <div class="mid2conname"><a href="/viewnews-66768-page-5.html" target="_blank">��ܲ��</a></div>
                    <div class="mid2coninfor">10��<br>���ڵ�ɽЭ��</div>
                </div>
<div class="mid2conimgall">
                    <a href="/viewnews-66768-page-6.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/xiao/x6.jpg" /></a>
                    <div class="mid2conname"><a href="/viewnews-66768-page-6.html" target="_blank">������</a></div>
                    <div class="mid2coninfor">12��<br>���ڵ�ɽЭ��</div>
                </div>
<div class="mid2conimgall">
                    <a href="/viewnews-66768-page-7.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/xiao/x7.jpg" /></a>
                    <div class="mid2conname"><a href="/viewnews-66768-page-7.html" target="_blank">�ݵ�</a></div>
                    <div class="mid2coninfor">9��<br>���ڵ�ɽЭ��</div>
                </div>
<div class="mid2conimgall">
                    <a href="/viewnews-66768-page-8.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/xiao/x8.jpg" /></a>
                    <div class="mid2conname"><a href="/viewnews-66768-page-8.html" target="_blank">����</a></div>
                    <div class="mid2coninfor">11��<br>���ڵ�ɽЭ��</div>
                </div>
            	<div class="clear"></div>
        </div>
        </div>

        <!--�ֳ�ͼƬ����Ƶλ-->
<div class="mid2">
        	<div class="titlebg">�ֳ�ͼƬ</div>
            <div class="mid2con">
                <!--//�ֳ�ͼ��//-->
            	<!--[diy=tuwen]--><div id="tuwen" class="area"><div id="framecjTUdS" class=" frame move-span cl frame-1"><div id="framecjTUdS_left" class="column frame-1-c"><div id="framecjTUdS_left_temp" class="move-span temp"></div><?php block_display('2466'); ?></div></div></div><!--[/diy]-->
            <div class="clear"></div>
        </div>
        </div>
        <div class="mid2">
        	<div class="titlebg">�ֳ���Ƶ</div>
            <div class="mid2con">
                <!--//�ֳ���Ƶ//-->
            	<!--[diy=sp]--><div id="sp" class="area"><div id="framesnP9hN" class=" frame move-span cl frame-1"><div id="framesnP9hN_left" class="column frame-1-c"><div id="framesnP9hN_left_temp" class="move-span temp"></div><?php block_display('2467'); ?></div></div></div><!--[/diy]-->
            	<div class="clear"></div>
        	</div>
        </div>

        <div class="mid2">
        	<div class="titlebg">KAILASȫ������װ���Ƽ�</div>           
            <div class="mid2con">
                <div class="conimg" id="de">
                    <table width="100%"  cellspacing="0" cellpadding="0">
                        <tr>
                            <td id="de1">
                                <table width="100%"  cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><div class="img"><a href="http://www.kailas.com.cn/cn/html/product/201104021403253.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/zhuangbei/zb1.jpg"  /></a></div></td>
                                        <td><div class="img"><a href="http://www.kailas.com.cn/cn/html/product/201104021416066.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/zhuangbei/zb2.jpg"  /></a></div></td>
                                        <td><div class="img"><a href="http://www.kailas.com.cn/cn/html/product/201101171435523.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/zhuangbei/zb3.jpg"  /></a></div></td>
                                        <td><div class="img"><a href="http://www.kailas.com.cn/cn/html/product/201101171454282.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/zhuangbei/zb4.jpg"  /></a></div></td>
                                        <td><div class="img"><a href="http://www.kailas.com.cn/cn/html/product/201101171454282.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/zhuangbei/zb5.jpg"  /></a></div></td>
                                        <td><div class="img"><a href="http://www.kailas.com.cn/cn/html/product/201103191508022.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/zhuangbei/zb6.jpg"  /></a></div></td>
<td><div class="img"><a href="http://www.kailas.com.cn/cn/html/product/201103191508022.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/zhuangbei/zb7.jpg"  /></a></div></td>
<td><div class="img"><a href="http://www.kailas.com.cn/cn/html/product/201104091444404.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/zhuangbei/zb8.jpg"  /></a></div></td>
<td><div class="img"><a href="http://www.kailas.com.cn/cn/html/product/201104091444404.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/kalaspy/images/zhuangbei/zb9.jpg"  /></a></div></td>
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
        </div>
    </div>
    <div class="bottom"><a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264���</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank">������</a>&nbsp;|&nbsp;<a href="http://www.8264.com/list/531/" target="_blank">�༭���Ĺ���</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/sitemap.html" target="_blank">վ���ͼ</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">�����ȵ�</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">��ϵ��ʽ</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank">QQȺ����</a>&nbsp;|&nbsp;<a href="http://8.8264.com/job/" target="_blank">8264��Ƹ</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">��������</a><br>
          �������ߣ�022-23708264&nbsp;|&nbsp;���棺022-23708323&nbsp;|&nbsp;��ַ��������¼�����ҵ԰��Է��ҵ�������8�ź�̩��Ϣ�㳡C��1001��<br>
          <a href="http://bx.8264.com" target="_blank"><span>�����з��գ�8264����������</span></a> <a href="http://bx.8264.com">���Ᵽ��</a><br>
          ���˽�ӡʲô�������� ������Ӱʲô�������ߣ���ӭ����ý��ת�����ǵ�ԭ����Ʒ[ת����ע������]��8264&nbsp;��Ȩ����   <a href="http://www.miibeian.gov.cn/" target="_blank">��ICP��05004140��-1</a>
</div>
</div>
<!--dx���뿪ʼ-->  
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?><!--dx�������-->
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

