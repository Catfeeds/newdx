<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1412', 'common/header_diy');
block_get('4845,4846,4847');?>
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
<base href="<?php echo $_G['siteurl'];?>" />    <link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
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
<style id="diy_style" type="text/css">#frameOlopoo {  margin:0px !important;border:#000000 0px none !important;background-color:transparent !important;background-image:none !important;}#portal_block_4845 {  margin:0px !important;border:#000000 0px none !important;background-color:transparent !important;background-image:none !important;}#portal_block_4845 .content {  margin:0px !important;}#frameu27Q5I {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:0px none !important;}#portal_block_4846 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:0px none !important;}#portal_block_4846 .content {  margin:0px !important;}#frame8zGhT9 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:0px none !important;}#portal_block_4847 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:0px none !important;}#portal_block_4847 .content {  margin:0px !important;}</style>
<!--diy��ʽ����-->

<!--�Լ���ʽ��ʼ-->
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2012yazhang/style/style1.css"/>
<!--�Լ���ʽ����-->
<div style=" margin-top:520px;">
    <div class="wap">
        <div class="nav"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/nav.jpg" border="0" usemap="#Map" />
          <map name="Map" id="Map">
            <area shape="rect" coords="28,15,89,31" href="http://www.8264.com/" target="_blank"/>
          </map>
      </div>
        <div class="min">
        	<div class="min_1">
            	<div class="min_1tit">��չ�۽�</div>
                <div class="min_lm">
                    <div id="focus_turn">
                        <ul id="focus_pic">
                          <li class="current"><a href="http://www.8264.com/viewnews-78074-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/lb-tanluzhe.jpg" /></a></li>
                          <li class="normal"><a href="http://www.8264.com/viewnews-77975-page-1.html" target="_blank"><img src="http://image1.8264.com/portal/201207/26/110143v4klyh4q2z4660kz.jpg" /></a></li>
                          <li class="normal"><a href="http://www.8264.com/viewnews-78021-page-1.html" target="_blank"><img src="http://image1.8264.com/portal/201207/27/010523grfect2et7fg81r4.jpg" /></a></li>
                      </ul>
                        <ul id="focus_tx">
                          <li class="current"><a href="#" target="_blank"></a></li>
                          <li class="normal"><a href="#" target="_blank"></a></li>
                          <li class="normal"><a href="#" target="_blank"></a></li>
                      </ul>
                        <div id="focus_opacity"></div>
                    </div>
        		</div>
           	  	<div class="min_1tit">��չ�۽�</div>
                <div class="min_lm" style="height:200px;  text-align:center;">
                	<a href="http://www.asian-outdoor.com/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/jujiao1.jpg"  width="275" height="200"/></a>
                </div>
                
            </div>
            <div class="min_2">
<div class="min_1tit">չ��ͷ��</div>
                <div class="min_lm" style="height:245px;">
                	<div class="min_2wen">
                    	<b>����¿������ 2012���޻���չ8264չλ��</b>
                        <p>7��26��-29�����Ͼ����е�2012���޻�����Ʒչ���ᣬ8264��www.8264.com��������ȫ�̱�����8264չλ�ɲɷ������Ӵ���������չʾ������������ɣ�չλ�ֳ������𱬡� <a href="http://www.8264.com/viewnews-77990-page-1.html" target="_blank"><span>[��ϸ]</span></a></p>
                  </div>
                    <div class="min_2wen">
                    	<b>2012���޻���չ ͸��Ʒ���ƹ� ������չ����</b>
                        <p>2012�����޻���չ��չ��һ�죬С���߷��˸���Ʒ��չλ�����ҷ�����<a href="http://www.8264.com/viewnews-78026-page-1.html" target="_blank"><span>[��ϸ]</span></a></p>
                    </div>
                    <div class="min_2wen">
                    	<b>2012�����߽죩���޻���չ��չƷ�ƽ��ﵽ540��</b>
                        <p> ��Ϊ�Ŷ�<a href="http://bbs.8264.com/thread-893527-1-1.html" target="_blank">�Ͼ�</a>�����רҵ�Թ���<a href="http://bbs.8264.com/thread-893508-1-1.html" target="_blank">����</a>չ��֮һ��2012�����߽죩<a href="http://bbs.8264.com/thread-892106-1-1.html" target="_blank">����</a>����չ����7��26����29�����Ͼ����ʲ������Ŀ�Ļ��չ���ܹ�ģ����2011���4��2��ƽ��������4��8��ƽ���ף���չƷ��Ԥ�ƴﵽ540������ȥ��������20�� .<a href="http://www.8264.com/viewnews-77197-page-1.html" target="_blank"><span>[��ϸ]</span></a></p>
                    </div>
                </div>
                
<div class="min_1tit">��չ��̬</div>
                <div class="min_lm" style="height:200px;">
                	<!--[diy=zhdt]--><div id="zhdt" class="area"><div id="frameOlopoo" class=" frame move-span cl frame-1"><div id="frameOlopoo_left" class="column frame-1-c"><div id="frameOlopoo_left_temp" class="move-span temp"></div><?php block_display('4845'); ?></div></div></div><!--[/diy]-->
                </div>
            
            </div>
            <div class="min_3">
            	<div class="min_1tit">չ�ᵹ��ʱ</div>
                <div class="min_lm" style="height:160px;">
                
                	<div class="min_31">
<script type="text/javascript">
var urodz= new Date("Jul 26,2012"); 
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
                <div class="min_lm" style="height:140px;">
                	<div class="min_32">
                	 <img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/shouce.jpg" border="0" usemap="#Map2" /><map name="Map2" id="Map2">
                       <area shape="rect" coords="12,7,61,30" href="http://www.asian-outdoor.com/" target="_blank" />
                       <area shape="rect" coords="137,11,190,31" href="http://www.asian-outdoor.com/html/Travel%20&%20Accomodation/Overview/" target="_blank"/>
                       <area shape="rect" coords="13,59,61,79" href="http://www.asian-outdoor.com/html/Travel%20&%20Accomodation/Overview/" target="_blank" />
                       <area shape="rect" coords="141,60,189,79" href="http://www.asian-outdoor.com/html/Travel%20&%20Accomodation/Overview/" target="_blank" />
                       <area shape="rect" coords="13,88,60,107" href="http://www.weather.com.cn/weather/101190101.shtml" target="_blank"/>
                       <area shape="rect" coords="140,107,198,127" href="http://www.asian-outdoor.com/visitor-reg.html" target="_blank"/>
                     </map>
                    </div>
                </div>
<div class="min_1tit">8264�ر�߻�</div>
                <div class="min_lm" style="height:90px;">
                	<div class="min_33">
<ul>
                        	<li>&#8226;&nbsp;<a href="http://bbs.8264.com/thread-1288216-1-1.html">8264����չ������¿�Ѵ�ۻ�</a></li>
                            <li>&#8226;&nbsp;8264����չ�������ۻ�</li>
                            <li>&#8226;&nbsp;<a href="http://www.8264.com/portal-topic-topicid-1396.html">8264����չ��¶Ӫ������</a></li                          
                        ></ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="title11">
        	����չ��
        </div>
        <div class="min11">
            <div class="zwt"><a href="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/Hall A.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/A.jpg"  /></a></div>
            <div class="zwt"><a href="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/Hall B.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/B.jpg"  /></a></div>
            <div class="zwt"><a href="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/Hall C.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/C.jpg"  /></a></div>
            <div class="zwt"><a href="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/Hall D.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/D.jpg"  /></a></div>
            <div class="zwt"><a href="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/Hall E.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/E.jpg"  /></a></div>
            <div class="zwt"><a href="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/Hall F.pdf" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/F.jpg"  /></a></div>
            <div class="clear"></div>

        </div>
        <!--��ǩ����-->
        <div class="title11">
        	2012�߶˷�̸
        </div>
        <div class="min2">
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	����̽·���ܲ����<br /><p>���컯��λ��ȷƷ�Ƽ�ֵ����</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-pengxin.jpg" /></div>
                <div class="imgbox1_b">
                	��ֿƼ����� Ϊ�¸ҽ�ȡ�����ṩ��ȫ���ʵĻ����˶�װ��<a href="http://www.8264.com/viewnews-78074-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	���ߵ��ܾ���½�շ�<br /><p>����רҵ�Ļ�������װ��</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-ludunfeng.jpg" /></div>
                <div class="imgbox1_b">
                	���ߵѸ��Ʋ�Ʒ���н����Դ�����ƽ̨��<a href="http://www.8264.com/viewnews-78153-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	KAILAS�г��ܼึ�Կ�<br /><p>�̳���רҵ��������</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-fuxiankai01.jpg" /></div>
                <div class="imgbox1_b">
                	KAILAS�̳���רҵ�������ء������ȡ��Ȳ�������<a href="http://www.8264.com/viewnews-78088-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	Vasqueȫ�������ܼ�George<br /><p>�ƶ������߳�����</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-Vasque.jpg" /></div>
                <div class="imgbox1_b">
                	����й��г�����������й����Ⱞ����ϲ�õĲ�Ʒ<a href="http://www.8264.com/viewnews-78025-page-1.html" target="_blank">[��ϸ]</a>
                </div>
            </div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	�Ϻ�ɰ�ҹ�˾���³����<br /><p>������������ͬʱ����</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-Sandstone.jpg" /></div>
                <div class="imgbox1_b">
                	Sandstone�����й������ƽ������������������<a href="http://www.8264.com/viewnews-78079-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	BDȫ�����۾���Dave<br /><p>2014���Ƴ�Ů��Ƽ���װ</p>
                </div>
                <div class="imgbox1_m"><img src="http://image1.8264.com/portal/201207/27/013025yxn33lwwa4u0zyno.jpg" /></div>
                <div class="imgbox1_b">
                	Dave������Black Diamond���й���̬��δ���չ��ƻ�<a href="http://www.8264.com/viewnews-78023-page-1.html" target="_blank">[��ϸ]</a>
                </div>
            </div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	KingCampƷ�ƴ�ʼ�������<br /><p≯ʮ�귢չ�Ƚ�����</p>
                </div>
                <div class="imgbox1_m"><img src="http://image1.8264.com/portal/201207/27/235300se16ek6111eoo6xf.jpg" /></div>
                <div class="imgbox1_b">
                	kingCampƷ�ƴ�ʼ����������KingCamp��ȥ����ѧ�ᰮ��<a href="http://www.8264.com/viewnews-78071-page-1.html" target="_blank">[��ϸ]</a>
                </div>
            </div>
        	<div class="imgbox1">
            	<div class="imgbox1_t">
                	�������ܾ��� ���<br /><p>��߻���˾�����ƶ�����</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-caervo.jpg" /></div>
                <div class="imgbox1_b">
                	������Ҫ�����������������ƹ���г�ռ���ʵ�������<a href="http://www.8264.com/viewnews-78075-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	˼�����ܾ�������<br /><p>˼���ֽ�ӭ��ʮ����</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-zenghua.jpg" /></div>
                <div class="imgbox1_b">
                	���о���Ƹ��Ļ��۵��������ǿ���˼���ֵ����ݡ�<a href="http://www.8264.com/viewnews-78216-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	����һ��Ƽ�Ӫ���ܼ����ĳ�<br /><p>Ҫ����ֵ�ý���������Ʒ��</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-wangwenchao.jpg" /></div>
                <div class="imgbox1_b">
                	AEE��ƷҲ���񵥷������Ϊ�Ͷ˺��и߶˽�������г���<a href="http://www.8264.com/viewnews-78161-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	�Ķ༪������Ʒ�ܾ���������<br /><p>��չ��Ʒ���Ƴ���������ЬƷ</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-renyulong.jpg" /></div>
                <div class="imgbox1_b">
                	��ǰע�ظ߰���а�רҵЬ �����Ƴ����д���Ь��<a href="http://www.8264.com/viewnews-78155-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	����Ӫ���ܼ���������<br /><p>���켫��Ʒ��DNA</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-zhoulei.jpg" /></div>
                <div class="imgbox1_b">
                	�����з������Ƴ����µĿƼ����Ϻ�ȫ�µ�����ϵ��װ����<a href="http://www.8264.com/viewnews-78148-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	ɽ���������ϴ�ҵ���³����ٽ�<br /><p>����������Ʒ��Ʒ��</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-liurongjie.jpg" /></div>
                <div class="imgbox1_b">
                	Ӳ�� ����������Ʒ��Ʒ�ʺ�ϵ�����������ߡ�<a href="http://www.8264.com/viewnews-78121-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	�Ͼ��߳��������Ÿ��ܾ�������<br /><p>�����԰µ���Ϊ����Ĳ�Ʒϵ��</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-wangfan.jpg" /></div>
                <div class="imgbox1_b">
                	NORTHLAND��δ�����Ӵ����кͳ��в�Ʒ���ȡ�<a href="http://www.8264.com/viewnews-78131-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	�ƶ�Ӫ�������ܾ�����������<br /><p>�ƶȽ��������г�</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-linyan.jpg" /></div>
                <div class="imgbox1_b">
                	�ƶ��ƹ�"������"���� ���������г���<a href="http://www.8264.com/viewnews-78124-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	BEAUME�й����г��ܼ���ΰ��<br /><p>�ÿƼ����ж�˵��</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-xuweijie.jpg" /></div>
                <div class="imgbox1_b">
                	BEAUME�Ĳ�Ʒ�����õ�VENTAIR3�㸲Ĥ������<a href="http://www.8264.com/viewnews-78116-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	Sympatex CEO��Micheal Kamm<br /><p>���������ϵ���������й�</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-kamm.jpg" /></div>
                <div class="imgbox1_b">
                	Sympatex���Ͻ����й��г������������Խ��в��ֵ�����<a href="http://www.8264.com/viewnews-78104-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	��·��Ʒ�ƾ������M<br /><p>һ��Ϊ�˻���</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-wangpeng.jpg" /></div>
                <div class="imgbox1_b">
                	һ��Ϊ�˻��� Ϊ�˻����һ���з���Ʒ��<a href="http://www.8264.com/viewnews-78108-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	ͼ;�г��ƹ��ܼ����·�<br /><p>Ʒ�����۵���������</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-linzhangfeng.jpg" /></div>
                <div class="imgbox1_b">
                	������ڵĵ�������������Ҫ�ľ������ƾ����Լ۱ȡ�<a href="http://www.8264.com/viewnews-78107-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	ActionfoxӪ���ܼ���ƼŮʿ<br /><p>�̳���רҵ��������</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-zhangping.jpg" /></div>
                <div class="imgbox1_b">
                	Actionfox(���ֺ���) ������չ��Ʒ�ߡ�<a href="http://www.8264.com/viewnews-78106-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	��˼���ܾ�������<br /><p>��˼�ѵ�δ����չĿ��������</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-zhangli.jpg" /></div>
                <div class="imgbox1_b">
                	��˼��ȷ����˾������ҵ������40%���ϵ�����̬�ơ�<a href="http://www.8264.com/viewnews-78084-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	ROYALWAY�����ܼ��Ž�<br /><p>ROYALWAY��ȥ ���� δ��</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-zhangjian.jpg" /></div>
                <div class="imgbox1_b">
                	ROYALWAY�ڲ�Ʒ�з�����һֱ������Ի���ϸ������봴�¡�<a href="http://www.8264.com/viewnews-78083-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	Rywan�ܾ���Maxime<br /><p>Я�����������ӽ����й�</p>
                </div>
                <div class="imgbox1_m"><img src="http://image1.8264.com/portal/201207/26/2200087gz4rr3w777yzn1z.jpg" /></div>
                <div class="imgbox1_b">
                	RywanƷ�ơ���ŷ�޷�չ״����ŷ�����廧���г���չ��״��<a href="http://www.8264.com/viewnews-78012-page-1.html" target="_blank">[��ϸ]</a>
                </div>
            </div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	���ؿƼ����۾���������<br /><p>�ƹ㻧�ⰲȫ��ˮ</p>
                </div>
                <div class="imgbox1_m"><img src="http://image1.8264.com/portal/201207/26/2135220opls6ipz68sw7d5.jpg" /></div>
                <div class="imgbox1_b">
                	δ�����и����²�ƷͶ�ŵ��г���������Ŀ�Դ���<a href="http://www.8264.com/viewnews-78008-page-1.html" target="_blank">[��ϸ]</a>
                </div>
            </div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	����Ƽ��ǻ��˶�<br /><p>��׼������רҵ�Ļ������</p>
                </div>
                <div class="imgbox1_m"><img src="http://image1.8264.com/portal/201207/27/221747wwr1g1dp2dcn5wg7.jpg" /></div>
                <div class="imgbox1_b">
                	EZON(��׼����Ʒ��������Դ�ڶ���ĳ����벻�ϵĴ���<a href="http://www.8264.com/viewnews-78069-page-1.html" target="_blank">[��ϸ]</a>
                </div>
            </div>
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	���� ��λ �ĸ�<br /><p>���������й�����Ь���Ʒ��</p>
                </div>
                <div class="imgbox1_m"><img src="http://image1.8264.com/portal/201207/27/232919gdoomdia7umwpd4s.jpg" /></div>
                <div class="imgbox1_b">
                	 Clorts(��ڣ���Ʒ����ܼ�����˲�Ʒ���������ԭ��<a href="http://www.8264.com/viewnews-78070-page-1.html" target="_blank">[��ϸ]</a>
                </div>
            </div>           
            <div class="imgbox1">
            	<div class="imgbox1_t">
                	HAGLOFSƷ���ܼ෶������<br /><p>׿Խ�Ļ���װ��</p>
                </div>
                <div class="imgbox1_m"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zf-HAGLOFS.jpg" /></div>
                <div class="imgbox1_b">
                	HAGLOFS���й��ı���������������������ƷƷ��Ϊ����<a href="http://www.8264.com/viewnews-78316-page-1.html" target="_blank">[��ϸ]</a>
                </div>
</div>                  
        	<div class="clear"></div>
        </div>
            
<!--2012�߶˷�̸����-->
        <div class="title11">
        	2012ŷ�޻���չ
        </div>
        
        <div class="min3">
        	<div class="min3_1">
            	<div><a href="http://www.8264.com/viewnews-77661-page-1.html" target=""><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/ouzhouhuwaizhan.jpg" /></a></div>
                <p>����ʱ��7��12-15�գ�ŷ�޻���չ�ڵ¹��Ƶ���˹�����������˹����չ�����ľ��У�����39�����ҵ�907��չ�̲�չ��ͬ������2%������������¼��200�����Ʒ�״β�չ��Խ��Խ�����ҵ���ټ��о���ע�ز�Ʒ��׷��ɳ�����չ���̣�������̱�����Ϊ��Ʒ�����ú͹����ԡ���ҵ��͸���Ⱥ����Ρ�2011�꣬ŷ�޻�����Ʒ������100��ŷԪ���������۶������ϸߵ�Ʒ����Ҫ��Jack Wolfskin��Petzl��La Sportiva��Original Buff��<a href="http://www.8264.com/viewnews-77661-page-1.html" target="_blank" style="color:#F00; margin-left:10px;">[ȫ��]</a><a href="http://www.8264.com/viewnews-77658-page-1.html" target="_blank"  style="color:#F00; margin-left:10px;">[����]</a><a href="http://www.8264.com/list/733" target="_blank"  style="color:#F00; margin-left:10px;">[�����������]</a></p>
            </div>
        	<div class="min3_2">
            	<div class="imgbox2">
                	<div class="imgbox2_img"><a href="http://www.8264.com/viewnews-77714-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/oz-zhanhuitiyan.jpg" /></a></div>
                    <div class="imgbox2_text"><a href="http://www.8264.com/viewnews-77714-page-1.html" target="_blank">չ������</a></div>
                </div>
                <div class="imgbox2">
                	<div class="imgbox2_img"><a href="http://www.8264.com/viewnews-77716-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/oz-huaxu.jpg" /></a></div>
                    <div class="imgbox2_text"><a href="http://www.8264.com/viewnews-77716-page-1.html" target="_blank">չ�Ứ��</a></div>
                </div>
                <div class="imgbox2">
                	<div class="imgbox2_img"><a href="http://www.8264.com/viewnews-77821-page-1.html" target="_blank"><img src=
"http://static.8264.com/oldcms/moban/zt/2012yazhang/image/oz-xiezixinpin.jpg" /></a></div>
                    <div class="imgbox2_text"><a href="http://www.8264.com/viewnews-77821-page-1.html" target="_blank">Ь��ƪ</a></div>
                </div>
                <div class="imgbox2">
                	<div class="imgbox2_img"><a href="http://www.8264.com/viewnews-77695-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/oz-fuzhuangxinpin.jpg" /></a></div>
                    <div class="imgbox2_text"><a href="http://www.8264.com/viewnews-77695-page-1.html" target="_blank">��װƪ</a></div>
                </div>
                <div class="imgbox2">
                	<div class="imgbox2_img"><a href="http://www.8264.com/viewnews-77777-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/oz-peijianxinpin.jpg" /></a></div>
                    <div class="imgbox2_text"><a href="http://www.8264.com/viewnews-77777-page-1.html" target="_blank">���ƪ</a></div>
                </div>
                <div class="imgbox2">
                	<div class="imgbox2_img"><a href="http://www.8264.com/viewnews-77748-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/oz-panyanjixian.jpg" /></a></div>
                    <div class="imgbox2_text"><a href="http://www.8264.com/viewnews-77748-page-1.html" target="_blank">���Ҽ���ƪ</a></div>
                </div>
            	<div class="clear"></div>
            </div>
            <div class="min3_3">
            	<b>ŷ�޻��⻧���ҵ��ƴ�</b>
            	<p>8264��www.8264.com)Ѷ���¹�ʱ��7��12�գ�2012ŷ�޻���չ��7��12-15�գ��ڷƵ���˹����չ���������ڿ�Ļ����7��ŷ�޻����ҵ��ƴ󽱻�����Ҳͬ�ڷ�����������ѡ��������25�����ҵ�322����Ʒ����������רҵ�������ϸ���ѡ48����Ʒ���ջ�ı���ŷ�޻����ҵ��ƴ󽱣����л񽱲�Ʒ������չ�����ر�չ����</p>
                <a href="http://www.8264.com/viewnews-77675-page-1.html" target="_blank" style="color:#F00; float:right;">[ȫ��]</a>
                <div class="clear"></div>
<div class="imgbox21">
                	<div class="imgbox21_img"><a href="http://www.8264.com/viewnews-77685-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/pic1.jpg" /></a></div>
                    <div class="imgbox21_text"><a href="http://www.8264.com/viewnews-77685-page-1.html" target="_blank">ŷ�޻���չƪ</a></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
<!--2012ŷ�޻���չ����-->
<div class="title11">
        	2012���޻���չװ����Ʒ
        </div>
        
        <div class="min4">
       		<div class="zhuangbeitop">
                <div class="zhuangbeitop_l">
                    <div class="zhuangbeitop_l11"><a href="http://www.8264.com/zb-1325588" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/da1.jpg" width="348" height="170" border="0" /></a></div>
                    <div style=" background:#000; height:25px; margin-top:5px; padding-top:5px; font-size:14px; font-weight:bold; color:#FFFFFF; text-align:center;">KingCamp̼��ά��ɽ��</div>
                    <div class="zhuangbeilist">
<!--[diy=zblist]--><div id="zblist" class="area"><div id="frameu27Q5I" class=" frame move-span cl frame-1"><div id="frameu27Q5I_left" class="column frame-1-c"><div id="frameu27Q5I_left_temp" class="move-span temp"></div><?php block_display('4846'); ?></div></div></div><!--[/diy]-->
                    </div>
                </div>
                <div class="zhuangbeitop_r">
                    <div class="zhungbeitopall">
                        <div class="zhungbeitopall_l">
                            <div class="zhuangbeibg"><a href="http://www.8264.com/zb-1326131" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/da2.jpg" width="170" height="120" border="0"/></a></div>
                        </div>
                      <div class="zhungbeitopall_r"><a href="http://www.8264.com/zb-1326131" target="_blank"> KAILAS������ʯ����һ���ġ���������</a><br>MountwireHMS����Keylock�޹��������ʹ�����ڹ�ȡ�����⹳ס�������Ƭ�������ڲ����ӵĸ�˿���ܹ����밲ȫ���У��������ʱ��������ת�����������ᣬ������õĴ�˿����������ȫ���ɽ���HWS����������/�����ᣩ������</div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="zhungbeitopall">
                        <div class="zhungbeitopall_l">
                        <div class="zhuangbeibg"><a href="http://www.8264.com/viewnews-78078-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/da3.jpg" width="170" height="120" border="0"/></a></div></div>
                        <div class="zhungbeitopall_r"><a href="http://www.8264.com/viewnews-78078-page-1.html" target="_blank">Edelrid��������ǿ�ȸ߿Ƽ���ɽ�� 
    </a><br>Edelrid��������ǿ�ȵĸ߿Ƽ��ʵ��������2012���޻���չ���ҵ�󽱡���ǿ�Ⱥϳ���ά�Ƴɵ�������Ϊ�������½�����������ͬʱ�����Bluesign��֤��ֱ��6MM������Ϊ20kn����������������������������û�еĶ��Ҽ���</div>
                        <div style="clear:both;"></div>
                    </div>
<div class="zhungbeitopall">
                        <div class="zhungbeitopall_l">
                        <div class="zhuangbeibg"><a href="http://www.8264.com/zb-1326553" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/da4.jpg" width="170" height="120" border="0"/></a></div></div>
                        <div class="zhungbeitopall_r">
                          <p><a href="http://www.8264.com/zb-1326553" target="_blank">Ь���޷��ߵ�VASQUE2013ԽҰ����Ʒ 
                          </a><br>���Ь�ӵ�����ص���Ь���޷��ߣ������˷���������ͽ���û�нӴ�������Ƚ����У��޷��ߵ�Ь�Ӵ����������ʡ�������硣Ь�׺��ر��ڵ���ƽ�ģ��������Լ��Ľ���������Ь�����״�����Ь��VASQUE�Ƴ���360��Ь�ߡ����ᡢ����Ů���4����ɫ��</p>
                         
                      </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
            
            <div class="zhuangbeidown">
<!--[diy=zbtw]--><div id="zbtw" class="area"><div id="frame8zGhT9" class=" frame move-span cl frame-1"><div id="frame8zGhT9_left" class="column frame-1-c"><div id="frame8zGhT9_left_temp" class="move-span temp"></div><?php block_display('4847'); ?></div></div></div><!--[/diy]-->
            </div>
       </div>
        <!--2012ŷ�޻���չװ����Ʒ����-->
       	<div class="title11">2012���޻���չװ�ٷ��</div>
        
        <div class="min5">
       		<div class="imgbox3">
            	<div class="imgbox3_tit">
            	  <div align="center"><a href="http://www.asian-outdoor.com/html/Supportingprogramme/AWARD/" target="_blank"><strong>���޻����ҵ��</strong></a></div>
           	  </div>
            	<div> <a href="http://www.asian-outdoor.com/html/Supportingprogramme/AWARD/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/hd9.jpg" /></a> </div>
                <div class="imgbox3_text">ʱ�䣺7��26��<br />�ص㣺չ���ֳ�</div>
            </div>
            <div class="imgbox3">
            	<div class="imgbox3_tit">
            	  <div align="center"><a href="http://www.asian-outdoor.com/html/Supporting%20programme/Schedule/" target="_blank"><strong>��ҵ��չ��̳</strong></a></div>
           	  </div>
            	<div> <a href="http://www.asian-outdoor.com/html/Supporting%20programme/Schedule/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/hd2.jpg" /></a> </div>
                <div class="imgbox3_text">ʱ�䣺7��28��<br />
                �ص㣺B02 C02������</div>
            </div>
            <div class="imgbox3">
            	<div class="imgbox3_tit">
            	  <div align="center"><a href="http://www.asian-outdoor.com/html/Supporting%20programme/Party/" target="_blank"><strong>ҡ����������</strong></a></div>
           	  </div>
            	<div> <a href="http://www.asian-outdoor.com/html/Supporting%20programme/Party/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/hd3.jpg" /></a> </div>
                <div class="imgbox3_text">ʱ�䣺2012��7��28����<br />�ص㣺AB��֮���¼��</div>
            </div>
            <div class="imgbox3">
            	<div class="imgbox3_tit"> 
            	  <div align="center"><a href="http://www.asian-outdoor.com/html/Supporting%20programme/Tent%20City/" target="_blank"><strong>������</strong></a></div>
                </div>
            	<div> <a href="http://www.asian-outdoor.com/html/Supporting%20programme/Tent%20City/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/hd4.jpg" /></a> </div>
                <div class="imgbox3_text">ʱ�䣺չ���ڼ�<br />�ص㣺Fչ��</div>
            </div>
            <div class="imgbox3">
            	<div class="imgbox3_tit"> 
            	  <div align="center"><a href="http://www.asian-outdoor.com/html/Supporting%20programme/Climbing%20Competitions/" target="_blank"><strong>�ʵǽ�</strong><strong></strong></a></div>
              </div>
            	<div> <a href="http://www.asian-outdoor.com/html/Supporting%20programme/Climbing%20Competitions/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/hd5.jpg" /></a> </div>
                <div class="imgbox3_text">ʱ�䣺2012��7��26��29��<br />
                �ص㣺  E��</div>
            </div>
            <div class="clear"></div>
       </div>
<!--2012���޻���չװ���ٷ������-->
        
<div class="title11">
        	2012���޻���չ8264չλͼ��
        </div>
        
    	<div class="min6">
            <div class="min6_l">
                <img src="http://image1.8264.com/portal/201207/27/0206058tsw4dkhtu4hfszd.jpg" />
            </div>
            <div class="min6_r">
                <div class="min6_r_img"><img src="http://image1.8264.com/portal/201207/27/020614nk5nd5eey3xkte53.jpg" /></div>
                <div class="min6_r_img"><img src="http://image1.8264.com/portal/201207/27/0206224woyyz8ewzoj2bz4.jpg" /></div>
                <div class="min6_r_img"><img src="http://image1.8264.com/portal/201207/27/020630aaqddtpf7gqlq3p7.jpg" /></div>
                <div class="min6_r_img"><img src="http://image1.8264.com/portal/201207/27/020638gtaqgz9sqkq3ag93.jpg" /></div>
                <div class="min6_r_img"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zhanweitu01.jpg" /></div>
                <div class="min6_r_img"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/zhanweitu02.jpg" /></div>
                
                
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
<!--2012���޻���չ8264չλͼ������-->
<div class="title2">
        	������Ů
        </div>
        <div class="min7">
        	<div class="min71">
            	<div class="min71_bigimg"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv01.jpg" /></a>
            	  <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">��Ů</a></div>
                </div>
                <div class="min71_small">
                	<div class="min71_smallbox">
                        <a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv04.jpg" /></a>
                        <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">������Ů</a></div>                    	
                    </div>
   					<div class="min71_smallbox">
                        <a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv05.jpg" /></a>
                        <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">�����ڸ�ɶ</a></div>                    	
                    </div>
                    <div class="min71_smallbox">
                        <a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv06.jpg" /></a>
                        <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">������Ů</a></div>                    	
                    </div>
                    <div class="min71_smallbox">
                        <a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv07.jpg" /></a>
                        <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">�ɰ�����Ů</a></div>                    	
                    </div>
                	<div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="min71">
                <div class="min71_small">
                	<div class="min71_smallbox1">
                        <a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv08.jpg" /></a>
                        <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">����Ů��</a></div>                    	
                    </div>
   					<div class="min71_smallbox1">
                        <a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv02.jpg" /></a>
                        <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">����ѽ</a></div>                    	
                    </div>
                    <div class="min71_smallbox1">
                        <a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv03.jpg" /></a>
                        <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">���������</a></div>                    	
                    </div>
                    <div class="min71_smallbox1">
                        <a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv09.jpg" /></a>
                        <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">һ�Զ���Ů</a></div>                    	
                    </div>
                	<div class="clear"></div>
                </div>
                <div class="min71_bigimg"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/meinv01.jpg" /></a>
                  <div style="text-align:center; margin-top:5px;"><a href="http://bbs.8264.com/thread-1327118-1-1.html" target="_blank">��Ů</a></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div><img src="http://static.8264.com/oldcms/moban/zt/2012yazhang/image/bottom_bg.jpg" /></div>
<!--������Ů����-->
      
        <div class="bottom">
    	<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264���</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank" >������</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">�����ȵ�</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">��ϵ��ʽ</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank" >QQȺ����</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">������ַ��ȫ</a><br>
          �������ߣ�022-23708264&nbsp;|&nbsp;���棺022-23857291&nbsp;|&nbsp;��ַ������л�Է��ҵ԰����ï�Ƽ�԰C2��6��AB��Ԫ<br>
          <a href="http://bx.8264.com" target="_blank">�����з��գ�8264����������</a> <a href="http://bx.8264.com">���Ᵽ��</a><br>
          ���˽�ӡʲô�������� ������Ӱʲô�������ߣ���ӭ����ý��ת�����ǵ�ԭ����Ʒ[ת����ע������]��8264&nbsp;��Ȩ����   <a href="http://www.miibeian.gov.cn/" target="_blank">��ICP��05004140��-10</a>&nbsp;&nbsp;&nbsp;<a href="http://www.8264.com/template/8264/http://static.8264.com/oldcms/moban/zt/2012yazhang/image/icp.jpg" target="_blank">ICP֤ ��B2-20110106</a>
    </div>
    	<!--�ײ�����-->
        <div class="topl"></div>
        <div class="topr"></div>
        <div class="bottoml"></div>
        <div class="bottomr"></div>
    		
    
    </div>
</div>
   
<!--dx���뿪ʼ-->  
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?><!--dx�������-->
  

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