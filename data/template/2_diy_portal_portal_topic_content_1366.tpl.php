<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1366', 'common/header_diy');
block_get('2496,2495,2497,2508,2663,2669,2664,2651,2667,2655,2668');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php if(!empty($topic['title'])) { ?><?php echo $topic['title'];?><?php } if(!empty($navtitle)) { ?><?php echo $navtitle;?> -<?php } if($_G['setting']['bbname']) { ?><?php echo $_G['setting']['bbname'];?> -<?php } ?></title>
<meta name="Description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="Keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />

<!--[if IE 6]>

<script src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>

<script src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/js/DD_belatedPNG_css.js" type="text/javascript"></script>

<![endif]-->

<!-- diy ��ʼ -->

<style id="diy_style" type="text/css">#frameS1L8nI {  margin:0px !important;border:0px !important;}#portal_block_2495 {  margin:0px !important;border:0px !important;}#portal_block_2495 .content {  margin:0px !important;}#frameT6ZUUF {  margin:0px !important;border:0px !important;}#portal_block_2496 {  margin:0px !important;border:0px !important;}#portal_block_2496 .content {  margin:0px !important;}#frame9u37Qf {  margin:0px !important;border:0px !important;}#portal_block_2497 {  margin:0px !important;border:0px !important;}#portal_block_2497 .content {  margin:0px !important;}#frameT5vP61 {  margin:0px !important;border:0px !important;}#portal_block_2508 {  margin:0px !important;border:0px !important;}#portal_block_2508 .content {  margin:0px !important;}#frameqvE5SB {  margin:0px !important;}#frame3wyJ94 {  margin:0px !important;}#frame2s13pX {  margin:0px !important;}#frameh4nED9 {  margin:0px !important;}#frame9E47uR {  margin:0px !important;}</style>
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

</head><body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;" style="background: url(http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/bg_y_all.jpg) repeat-y center top;">

<!-- diy ��ʼ -->

<?php if(($_G['mod']!='topic' && $_G['group']['allowdiy'] && !empty($_G['style']['tplfile'])) || (!empty($_G['style']['tplfile']) && $_G['mod']=='topic' && (($_G['group']['allowaddtopic'] && $topic['uid']==$_G['uid']) || $_G['group']['allowmanagetopic']))) { ?>

<a id="diy-tg" href="javascript:openDiy();" title="�� DIY ���"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>

<?php } ?>

<div id="append_parent"></div>
<div id="ajaxwaitid"></div>

<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>

<!-- diy ���� -->

<!-- header_zt start -->

<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011tents_congress/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011tents_congress/css/style_20110720.css"/>
<div id="header_zt">
</div>

<!-- header_zt end -->

<!-- main_zt start -->

<div id="main_zt">
<div class="main_zt_l">
<div id="main_slide">

<!--//hd�õ�//-->

<!--[diy=hd]--><div id="hd" class="area"><div id="frameT6ZUUF" class=" frame move-span cl frame-1"><div id="frameT6ZUUF_left" class="column frame-1-c"><div id="frameT6ZUUF_left_temp" class="move-span temp"></div><?php block_display('2496'); ?></div></div><div id="frame73n8DI" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1���</span></div><div id="frame73n8DI_left" class="column frame-1-c"><div id="frame73n8DI_left_temp" class="move-span temp"></div></div></div><div id="framewh6Gvs" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1���</span></div><div id="framewh6Gvs_left" class="column frame-1-c"><div id="framewh6Gvs_left_temp" class="move-span temp"></div></div></div><div id="framec3hwIT" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1���</span></div><div id="framec3hwIT_left" class="column frame-1-c"><div id="framec3hwIT_left_temp" class="move-span temp"></div></div></div><div id="framerf8u7b" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1���</span></div><div id="framerf8u7b_left" class="column frame-1-c"><div id="framerf8u7b_left_temp" class="move-span temp"></div></div></div><div id="frameUClHU2" class="frame move-span cl frame-1"><div class="title frame-title"><span class="titletext">1���</span></div><div id="frameUClHU2_left" class="column frame-1-c"><div id="frameUClHU2_left_temp" class="move-span temp"></div></div></div></div><!--[/diy]-->

<!--//hd�õ�//-->

</div>
</div>
<div class="main_zt_c">
<div class="news_c">
<h2>
<a href="http://bbs.8264.com/thread-787548-1-1.html" style="color:#FF0000" target="_blank">8264¶Ӫ������վ���ȱ�����</a>
</h2>
<p> 2011��6�£�8264ȫ��¶Ӫ���ȫ��������ʱ�����գ���½����ȫ��7��ʡ�гɹ��ٰ죬¿���ǲ������������ǿ�ҡ�Ŀǰȫ������վ���ڻ��ȱ����У�¿���ǻ��ڵ�ʲô�����������ɡ� <b>��������</b>:
<a href="http://bbs.8264.com/forum-viewthread-tid-1046240-fromuid-34143033.html" class="more" target="_blank"></a>
</p>
<h3>
<a href="http://bbs.8264.com/forum-viewthread-tid-827599-fromuid-34170351.html" target="_blank">2012��8264ȫ��¶Ӫ�����غ��������ļ��</a>
</h3>
<p>2011�꣬8264ȫ��¶Ӫ����ڸ����ܵ�¿���ǵ�����֧������롣ת����ĩ��2012���8264ȫ��¶Ӫ���Ҳ��ʼ�������ɵĳﱸ�����ˣ��ֳ��и��ط�վ������飬������ѯ��8264¶Ӫ��Ḻ���ˣ����� �绰��13920440860 </p>
</div>
</div>
<div class="main_zt_r">
<div class="news_r">
<div class="mod_tit">������Ѷ</div>
<div class="mod_cont art_275px">

<!--//zzzx���������б���ʽһByAndes//-->

<!--[diy=zzzx]--><div id="zzzx" class="area"><div id="frameS1L8nI" class=" frame move-span cl frame-1"><div id="frameS1L8nI_left" class="column frame-1-c"><div id="frameS1L8nI_left_temp" class="move-span temp"></div><?php block_display('2495'); ?></div></div></div><!--[/diy]-->

<!--//zzzx���������б���ʽһByAndes//-->

</div>
</div>
</div>
<div class="main_zt_all">
<div class="mod_tit bg2">ȫ����վ</div>
<div class="mod_cont pic_225px">
<div class="pic_box">
<a href="http://bbs.8264.com/thread-793394-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/fenz/1.jpg" ></a>
<p><b>��һվ:����վ(�ѽ���)</b></p>
<p>ʱ���䣺6��18��-19��</p>
<p>�ء��㣺�ػʵ����������</p>
<p>�ˡ�����501�ˡ�
<a href="http://bbs.8264.com/thread-793394-1-1.html" target="_blank" style="color:#0000FF">ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-787309-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/fenz/2.jpg" ></a>
<p><b>�ڶ�վ:����վ</b></p>
<p>ʱ���䣺7��23-24��</p>
<p>�ء��㣺����������ɳ��</p>
<p>�ˡ�����312�ˡ�
<a href="http://bbs.8264.com/forum-viewthread-tid-827599-fromuid-34170351.html" target="_blank" style="color:#0000FF">ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-813132-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn84.jpg" border="0" ></a>
<p><b>����վ:������վ</b></p>
<p>ʱ���䣺8��13-14��</p>
<p>�ء��㣺��������ѩ������԰��</p>
<p>
<a href="http://bbs.8264.com/thread-842743-4-1.html" class="more" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-781549-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn86.jpg" ></a>
<p><b>����վ:����վ</b></p>
<p>ʱ���䣺8��20��-21��</p>
<p>�ء��㣺�����������к����羰��</p>
<p>
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=876382&amp;page=2#pid14357960" class="more" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-795303-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn87.jpg" ></a>
<p><b>����վ:���ɹ�վ</b></p>
<p>ʱ���䣺8��13��-14��</p>
<p>�ء��㣺���ɹŰ�ͷϣ�����ʲ�ԭ����</p>
<p>
<a href="http://bbs.8264.com/thread-842587-1-1.html" class="more" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-819168-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn88.jpg" ></a>
<p><b>����վ:�ൺվ</b></p>
<p>ʱ���䣺8��6��-7��</p>
<p>�ء��㣺�ൺ�п�������ɳ̲</p>
<p>
<a href="http://bbs.8264.com/thread-961201-1-1.html" class="more" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-817853-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/fenz/7.jpg" ></a>
<p><b>����վ:����վ</b></p>
<p>ʱ���䣺8��27��-28��</p>
<p>�ء��㣺����ʡ������̶̳����ɳ̲</p>
<p>
<a href="http://bbs.8264.com/thread-876497-1-1.html" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-819106-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn36.jpg" ></a>
<p><b>�ڰ�վ:����վ</b></p>
<p>ʱ���䣺9��10��-11��</p>
<p>�ء��㣺����ʡ�������������ԭ����</p>
<p>
<a href="http://bbs.8264.com/thread-949670-1-1.html" class="more" target="_blank" style="color:#0000FF">ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-825721-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn89.jpg" ></a>
<p><b>�ھ�վ:ɽ������վ</b></p>
<p>ʱ���䣺8��6��-7��</p>
<p>�ء��㣺ɽ��ʡ���ϳ���԰��԰����</p>
<p>
<a href="http://bbs.8264.com/thread-838350-1-1.html" class="more" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-830380-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn80.jpg" ></a>
<p><b>��ʮվ:�ػʵ�վ</b></p>
<p>ʱ���䣺9��10��-11��</p>
<p>�ء��㣺�ӱ�ʡ���ػʵ�����䵺</p>
<p>
<a href="http://bbs.8264.com/thread-949662-1-1.html" class="more" target="_blank"  style="color:#0000FF">ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-835206-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn85.jpg" ></a>
<p><b>��ʮһվ:����վ</b></p>
<p>ʱ���䣺8��27��-28��</p>
<p>�ء��㣺���� ��ɳ�Ŷ�</p>
<p>
<a href="http://bbs.8264.com/thread-876459-1-1.html" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-842051-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn90.jpg" ></a>
<p><b>��ʮ��վ:�½�վ</b></p>
<p>ʱ���䣺9��8��-10��</p>
<p>�ء��㣺�½�����</p>
<p>
<a href="http://bbs.8264.com/thread-949665-1-1.html" class="more" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-848710-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn81.jpg" ></a>
<p><b>��ʮ��վ:�ൺ��ɽվ</b></p>
<p>ʱ���䣺9��17��-18��</p>
<p>�ء��㣺���ൺ��ɽ����Ӻ�̲</p>
<p>
<a href="http://bbs.8264.com/thread-961201-1-1.html" class="more" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-1023818-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn91.jpg" ></a>
<p><b>��ʮ��վ:��������վ</b></p>
<p>ʱ���䣺10��29��-30��</p>
<p>�ء��㣺����������ɽ����Ү�򼰰���ɽ�羰��</p>
<p>
<a href="http://bbs.8264.com/thread-1023818-1-1.html" class="more" target="_blank" style="color:#00F">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-890779-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn75.jpg" ></a>
<p><b>��ʮ��վ:ɽ����ׯվ</b></p>
<p>ʱ���䣺9��17��-18��</p>
<p>�ء��㣺ɽ��ʡ��ׯ��ỳ���������԰����</p>
<p>
<a href="http://bbs.8264.com/thread-890779-15-1.html" class="more" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-957273-fromuid-34170351.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/fenz/16.jpg" ></a>
<p><b>��ʮ��վ:��������վ</b></p>
<p>ʱ���䣺9��24��-25��</p>
<p>�ء��㣺��������ɽ����ɽ�羰��</p>
<p>
<a href="http://bbs.8264.com/thread-974716-1-1.html" class="more" target="_blank" style="color:#0000FF">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-1050803-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn107.jpg" ></a>
<p><b>��ʮ��վ:�����人վ</b></p>
<p>ʱ���䣺11��19��-20��</p>
<p>�ء��㣺�人�л�����ľ����ط羰��</p>
<p>
<a href="http://bbs.8264.com/thread-1050803-1-1.html" class="more" target="_blank" style="color:#00F">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/thread-1057408-1-1.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn124.jpg" ></a>
<p><b>��ʮ��վ:����վ</b></p>
<p>ʱ���䣺11��26��-27��</p>
<p>�ء��㣺����.����.����ɽ����ɭ�ֹ�԰</p>
<p>
<a href="http://bbs.8264.com/thread-1057408-1-1.html" class="more" target="_blank" style="color:#00F">����鿴�ֳ�ͼ��</a>
</p>
</div>
<div class="clear"></div>
</div>
</div>
<div class="main_zt_all">
<div class="mod_tit bg1" id="tab_box">
<div class="sheqian2">
<span class="tit">��վͼ��</span>
<div class="tib_l" id="roll_button_left"></div>
<div class="tic">
<div id="roll" style="width:783px;height:35px;padding-left:5px;overflow:hidden; position:relative;">
<div id="roll_inner" style="overflow:hidden;">
<a href="javascript:void(0)" class="tab old_zhan" id="s1">����վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s2">����վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s3">������վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s4">����վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s5">���ɹ�վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s6">�ൺվ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s7">����վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s8">����վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s9">����վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s10">�ػʵ�վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s11">����վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s12">�½�վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s13">��ɽվ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s14">����վ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s15">��ׯվ</a>
<a href="javascript:void(0)" class="tab old_zhan" id="s16">����վ</a>
<a href="javascript:void(0)" class="tab active" id="s17">����վ</a>
<a href="javascript:void(0)" class="tab" id="s18">����վ</a>
</div>
</div>
</div>
<div class="tib_r" id="roll_button_right"></div>
<div style="clear:both;"></div>
<script src="http://www.8264.com/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

jQuery.noConflict();

;(function($){



var button_num = $('#roll a').length;

var button_width = 87;



if (button_num > 9) {

$('#roll_inner').css({width: button_width*button_num+"px"});



$('#roll_button_left').click(function(){

$('#roll').stop(1,1);

var scroll_left = $('#roll').scrollLeft() - button_width;

$('#roll').animate({

scrollLeft: scroll_left+"px"

}, 500)

});



$('#roll_button_right').click(function(){

$('#roll').stop(1,1);

var scroll_left = $('#roll').scrollLeft() + button_width;

$('#roll').animate({

scrollLeft: scroll_left+"px"

}, 500)

});

}

$('#roll').scrollLeft(button_width * 5);

})(jQuery);

</script>
</div>
</div>
<div class="sheqianbody">
<div class="mod_cont pic_165px neirong" id="sq-s1">

<!--//fzpic����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic]--><div id="fzpic" class="area"><div id="frame9u37Qf" class=" frame move-span cl frame-1"><div id="frame9u37Qf_left" class="column frame-1-c"><div id="frame9u37Qf_left_temp" class="move-span temp"></div><?php block_display('2497'); ?></div></div></div><!--[/diy]-->

<!--//fzpic����ͼƬ�б���ʽһByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s2">

<!--//fzpic2����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic2]--><div id="fzpic2" class="area"><div id="frameT5vP61" class=" frame move-span cl frame-1"><div id="frameT5vP61_left" class="column frame-1-c"><div id="frameT5vP61_left_temp" class="move-span temp"></div><?php block_display('2508'); ?></div></div></div><!--[/diy]-->

<!--//fzpic2����ͼƬ�б���ʽһByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s3">

<!--//fzpic3����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic3]--><div id="fzpic3" class="area"><div id="frame3wyJ94" class=" frame move-span cl frame-1"><div id="frame3wyJ94_left" class="column frame-1-c"><div id="frame3wyJ94_left_temp" class="move-span temp"></div><?php block_display('2663'); ?></div></div></div><!--[/diy]-->

<!--//fzpic3����ͼƬ�б���ʽһByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s4">

<!--//fzpic4����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic4]--><div id="fzpic4" class="area"><div id="frame9E47uR" class=" frame move-span cl frame-1"><div id="frame9E47uR_left" class="column frame-1-c"><div id="frame9E47uR_left_temp" class="move-span temp"></div><?php block_display('2669'); ?></div></div></div><!--[/diy]-->

<!--//fzpic4����ͼƬ�б���ʽһByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s5">

<!--//fzpic5����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic5]--><div id="fzpic5" class="area"><div id="frame53p5er" class="frame move-span cl frame-1"><div id="frame53p5er_left" class="column frame-1-c"><div id="frame53p5er_left_temp" class="move-span temp"></div><?php block_display('2664'); ?></div></div></div><!--[/diy]-->

<!--//fzpic5����ͼƬ�б���ʽһByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s6">

<!--//fzpic6����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic6]--><div id="fzpic6" class="area"><div id="frameP2Q2EC" class="frame move-span cl frame-1"><div id="frameP2Q2EC_left" class="column frame-1-c"><div id="frameP2Q2EC_left_temp" class="move-span temp"></div><?php block_display('2651'); ?></div></div></div><!--[/diy]-->

<!--//fzpic6����ͼƬ�б���ʽһByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s7">

<!--//fzpic7����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic7]--><div id="fzpic7" class="area"><div id="frame2s13pX" class=" frame move-span cl frame-1"><div id="frame2s13pX_left" class="column frame-1-c"><div id="frame2s13pX_left_temp" class="move-span temp"></div><?php block_display('2667'); ?></div></div></div><!--[/diy]-->

<!--//fzpic7����ͼƬ�б���ʽһByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s8">

<!-- �����ڼ���뿪ʼ ������ɾ����������� -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-949670-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn1.jpg" alt="����¶Ӫ���ȫ���ɹ�" /></a>
<a href="http://bbs.8264.com/forum-viewthread-tid-949670-fromuid-34626185.html" target="_blank" class="text">����¶Ӫ���ȫ���ɹ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14652404-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn2.jpg" alt="�����¿���ǽ����Ż���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14652404-fromuid-34626185.html" target="_blank" class="text">�����¿���ǽ����Ż���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14652420-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn3.jpg" alt="����������ɫ�Ĵ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14652420-fromuid-34626185.html" target="_blank" class="text">����������ɫ�Ĵ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14668007-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn4.jpg" alt="¶Ӫ�������Ĳ�ԭһ��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14668007-fromuid-34626185.html" target="_blank" class="text">¶Ӫ�������Ĳ�ԭһ��</a>

</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14668069-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn5.jpg" alt="���ص�¿�����ø�����ӭ��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14668069-fromuid-34626185.html" target="_blank" class="text">���ص�¿�����ø�����ӭ��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14670748-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn6.jpg" alt="����¿�Ѵ�Ӫ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14670748-fromuid-34626185.html" target="_blank" class="text">����¿�Ѵ�Ӫ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14670985-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn7.jpg" alt="¿������������ʳ�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14670985-fromuid-34626185.html" target="_blank" class="text">¿������������ʳ�����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14671544-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn8.jpg" alt="������ԭ��ӭ8264��¿����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14671544-fromuid-34626185.html" target="_blank" class="text">������ԭ��ӭ8264��¿����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14671870-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn9.jpg" alt="��ԭ�ϵ�"��ɫ"" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14671870-fromuid-34626185.html" target="_blank" class="text">��ԭ�ϵġ���ɫ��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14676154-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn10.jpg" alt="����������н���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14676154-fromuid-34626185.html" target="_blank" class="text">����������н���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14676230-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn11.jpg" alt="�ַ����Ϸ��Ŀ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14676230-fromuid-34626185.html" target="_blank" class="text">�ַ����Ϸ��Ŀ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14690336-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn12.jpg" alt="������ԭ������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14690336-fromuid-34626185.html" target="_blank" class="text">������ԭ������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14690498-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn13.jpg" alt="¶Ӫ���¿�ѵ�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14690498-fromuid-34626185.html" target="_blank" class="text">¶Ӫ���¿�ѵ�����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14691174-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn14.jpg" alt="��ĳ���������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14691174-fromuid-34626185.html" target="_blank" class="text">��ĳ���������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14692553-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn15.jpg" alt="����ף��¶Ӫ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949670-pid-14692553-fromuid-34626185.html" target="_blank" class="text">����ף��¶Ӫ���</a>
</div>

<!-- �����ڼ������� ������ɾ����������� -->

<div style="display:none">

<!--//fzpic8����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic8]--><div id="fzpic8" class="area"></div><!--[/diy]-->

<!--//fzpic8����ͼƬ�б���ʽһByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s9">

<!--//fzpic9����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic9]--><div id="fzpic9" class="area"><div id="frameqvE5SB" class=" frame move-span cl frame-1"><div id="frameqvE5SB_left" class="column frame-1-c"><div id="frameqvE5SB_left_temp" class="move-span temp"></div><?php block_display('2655'); ?></div></div></div><!--[/diy]-->

<!--//fzpic9����ͼƬ�б���ʽһByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s10">

<!-- �����ڼ���뿪ʼ ������ɾ����������� -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644226-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn16.jpg" alt="¶Ӫ�����ֳ�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644226-fromuid-34626185.html" target="_blank" class="text">¶Ӫ�����ֳ�����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644903-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn17.jpg" alt="8264¶Ӫ�����ʵ��˿" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644903-fromuid-34626185.html" target="_blank" class="text">8264¶Ӫ�����ʵ��˿</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644927-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn18.jpg" alt="�����������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14644927-fromuid-34626185.html" target="_blank" class="text">�����������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645052-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn19.jpg" alt="8264����ɳ̲�ܱ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645052-fromuid-34626185.html" target="_blank" class="text">8264����ɳ̲�ܱ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645094-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn20.jpg" alt="Ҳ�ù������ܻ��������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645094-fromuid-34626185.html" target="_blank" class="text">Ҳ�ù������ܻ��������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645108-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn21.jpg" alt="Ϊ¿���ǰ佱" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645108-fromuid-34626185.html" target="_blank" class="text">Ϊ¿���ǰ佱</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645173-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn22.jpg" alt="8264��־�ԵĴ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645173-fromuid-34626185.html" target="_blank" class="text">8264��־�ԵĴ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645287-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn23.jpg" alt="��䵺��׳��Ӫ��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645287-fromuid-34626185.html" target="_blank" class="text">��䵺��׳��Ӫ��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645502-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn24.jpg" alt="¿���Ƿ׷�����ǩ������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645502-fromuid-34626185.html" target="_blank" class="text">¿���Ƿ׷�����ǩ������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645582-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn25.jpg" alt="����8264��Ʒ����Ů��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645582-fromuid-34626185.html" target="_blank" class="text">����8264��Ʒ����Ů��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645920-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn26.jpg" alt="¶Ӫ��Ṳͬ����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645920-fromuid-34626185.html" target="_blank" class="text">¶Ӫ��Ṳͬ����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646163-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn27.jpg" alt="¿���������ճ�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646163-fromuid-34626185.html" target="_blank" class="text">¿���������ճ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646203-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn28.jpg" alt="ͬ��8264" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646203-fromuid-34626185.html" target="_blank" class="text">ͬ��8264</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14647854-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn29.jpg" alt="�����Ԯ�Ӳμ�¶Ӫ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14647854-fromuid-34626185.html" target="_blank" class="text">�����Ԯ�Ӳμ�¶Ӫ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653398-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn30.jpg" alt="����ı�����ʼ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653398-fromuid-34626185.html" target="_blank" class="text">����ı�����ʼ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14647944-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn31.jpg" alt="��������ʳ��¿��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14647944-fromuid-34626185.html" target="_blank" class="text">��������ʳ��¿��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653579-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn32.jpg" alt="�����Ů�μ�¶Ӫ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653579-fromuid-34626185.html" target="_blank" class="text">�����Ů�μ�¶Ӫ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653593-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn33.jpg" alt="�ͷ�ɫ�ʵ�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14653593-fromuid-34626185.html" target="_blank" class="text">�ͷ�ɫ�ʵ�����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645999-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn34.jpg" alt="�͸��������8264ÿ��һͼ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14645999-fromuid-34626185.html" target="_blank" class="text">�͸��������8264ÿ��һͼ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646163-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn35.jpg" alt="�峿������ɳ̲" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949662-pid-14646163-fromuid-34626185.html" target="_blank" class="text">�峿������ɳ̲</a>
</div>

<!-- �����ڼ������� ������ɾ����������� -->

<div style="display:none">

<!--//fzpic10����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic10]--><div id="fzpic10" class="area"></div><!--[/diy]-->

<!--//fzpic10����ͼƬ�б���ʽһByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s11">

<!-- �����ڼ������� ������ɾ����������� -->

<!--//fzpic11����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic11]--><div id="fzpic11" class="area"><div id="frameh4nED9" class=" frame move-span cl frame-1"><div id="frameh4nED9_left" class="column frame-1-c"><div id="frameh4nED9_left_temp" class="move-span temp"></div><?php block_display('2668'); ?></div></div></div><!--[/diy]-->

<!--//fzpic11����ͼƬ�б���ʽһByAndes//-->

<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s12">

<!-- �����ڼ���뿪ʼ ������ɾ����������� -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn37.jpg" alt="����8264����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="text">����8264����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn38.jpg" alt="¶Ӫ��������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="text">¶Ӫ��������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893924-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn39.jpg" alt="׳�۵Ŀ�Ļʽ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893924-fromuid-34626185.html" target="_blank" class="text">׳�۵Ŀ�Ļʽ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893936-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn40.jpg" alt="��ɮ�ľ��˱���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893936-fromuid-34626185.html" target="_blank" class="text">��ɮ�ľ��˱���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893945-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn41.jpg" alt="���������������Ը��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893945-fromuid-34626185.html" target="_blank" class="text">���������������Ը��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn42.jpg" alt="���µ�������ɫ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14752371-fromuid-34626185.html" target="_blank" class="text">���µ�������ɫ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893928-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn43.jpg" alt="���ֵ�С¿" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-949665-pid-14893928-fromuid-34626185.html" target="_blank" class="text">���ֵ�С¿</a>
</div>

<!-- �����ڼ������� ������ɾ����������� -->

<div style="display:none">

<!--//fzpic12����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic12]--><div id="fzpic12" class="area"></div><!--[/diy]-->

<!--//fzpic12����ͼƬ�б���ʽһByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s13">

<!-- �����ڼ���뿪ʼ ������ɾ����������� -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14747901-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn46.jpg" alt="¶Ӫ���ȫ��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14747901-fromuid-34626185.html" target="_blank" class="text">¶Ӫ���ȫ��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14747935-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn47.jpg" alt="�������ַǷ�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14747935-fromuid-34626185.html" target="_blank" class="text">�������ַǷ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748009-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn48.jpg" alt="¿����½���Ľ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748009-fromuid-34626185.html" target="_blank" class="text">¿����½���Ľ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748097-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn49.jpg" alt="�����ź��������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748097-fromuid-34626185.html" target="_blank" class="text">�����ź��������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748119-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn50.jpg" alt="8264�������¿�ѳ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748119-fromuid-34626185.html" target="_blank" class="text">8264�������¿�ѳ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748154-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn51.jpg" alt="��ῪĻʽ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748154-fromuid-34626185.html" target="_blank" class="text">��ῪĻʽ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748220-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn52.jpg" alt="ȫ��¿�Ѻ�Ӱ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14748220-fromuid-34626185.html" target="_blank" class="text">ȫ��¿�Ѻ�Ӱ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755105-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn53.jpg" alt="ҹɫ�µ�¶Ӫ������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755105-fromuid-34626185.html" target="_blank" class="text">ҹɫ�µ�¶Ӫ������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755124-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn54.jpg" alt="������ɫ�ʰ�쵵�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755124-fromuid-34626185.html" target="_blank" class="text">������ɫ�ʰ�쵵�����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755148-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn55.jpg" alt="�����ĳ�"��"" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14755148-fromuid-34626185.html" target="_blank" class="text">�����ĳ�������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14766543-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn56.jpg" alt="���ַǷ�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14766543-fromuid-34626185.html" target="_blank" class="text">���ַǷ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14767998-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn57.jpg" alt="¿������������ʳ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14767998-fromuid-34626185.html" target="_blank" class="text">¿������������ʳ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14768033-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn58.jpg" alt="ȫ�һ�������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14768033-fromuid-34626185.html" target="_blank" class="text">ȫ�һ�������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14768087-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn59.jpg" alt="ͬ��8264�ٰ�¶Ӫ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961201-pid-14768087-fromuid-34626185.html" target="_blank" class="text">ͬ��8264�ٰ�¶Ӫ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961195-pid-14771657-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn82.jpg" alt="�κӱ���Ҳ�ܼ��鰡" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-961195-pid-14771657-fromuid-34626185.html" target="_blank" class="text">�κӱ���Ҳ�ܼ��鰡</a>
</div>

<!-- �����ڼ������� ������ɾ����������� -->

<div style="display:none">

<!--//fzpic13����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic13]--><div id="fzpic13" class="area"></div><!--[/diy]-->

<!--//fzpic13����ͼƬ�б���ʽһByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s14">

<!-- �����ڼ���뿪ʼ ������ɾ����������� -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453281-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn92.jpg" alt="¿����½����Ӫ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453281-fromuid-34626185.html" target="_blank" class="text">¿����½����Ӫ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453364-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn93.jpg" alt="�μӱ�����¿����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453364-fromuid-34626185.html" target="_blank" class="text">�μӱ�����¿����</a><a href="http://www.sunrisetj.com" title="�����ڳ�"></a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453376-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn94.jpg" alt="����ֳ���̨" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15453376-fromuid-34626185.html" target="_blank" class="text">����ֳ���̨</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454040-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn95.jpg" alt="�ƺƵ����ĳ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454040-fromuid-34626185.html" target="_blank" class="text">�ƺƵ����ĳ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454137-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn96.jpg" alt="����15������ɽ����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454137-fromuid-34626185.html" target="_blank" class="text">����15������ɽ����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454246-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn97.jpg" alt="�����˼��ͣ�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454246-fromuid-34626185.html" target="_blank" class="text">�����˼��ͣ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454246-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn98.jpg" alt="�Ҹ���һ����¿����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454246-fromuid-34626185.html" target="_blank" class="text">�Ҹ���һ����¿����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454405-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn99.jpg" alt="��Ů����Ա��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454405-fromuid-34626185.html" target="_blank" class="text">��Ů����Ա��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454405-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn100.jpg" alt="��ɽ ǩ�� ������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15454405-fromuid-34626185.html" target="_blank" class="text">��ɽ ǩ�� ������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15456907-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn101.jpg" alt="��ů���"����վ"" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15456907-fromuid-34626185.html" target="_blank" class="text">��ů��衰����վ��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15457820-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn102.jpg" alt="׳�۵ĳ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15457820-fromuid-34626185.html" target="_blank" class="text">׳�۵ĳ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15457918-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn103.jpg" alt="

�����е�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15457918-fromuid-34626185.html" target="_blank" class="text"> �����е�����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465533-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn104.jpg" alt="��г��ҵ�ĺش�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465533-fromuid-34626185.html" target="_blank" class="text">��г��ҵ�ĺش�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465645-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn105.jpg" alt="��ֳ�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465645-fromuid-34626185.html" target="_blank" class="text">��ֳ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465905-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn106.jpg" alt="ȫ�Ҹ�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1023818-pid-15465905-fromuid-34626185.html" target="_blank" class="text">ȫ�Ҹ�����</a>
</div>

<!-- �����ڼ������� ������ɾ����������� -->

<div style="display:none">

<!--//fzpic14����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic14]--><div id="fzpic14" class="area"></div><!--[/diy]-->

<!--//fzpic14����ͼƬ�б���ʽһByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s15">

<!-- �����ڼ���뿪ʼ ������ɾ����������� -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14779553-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn73.jpg" alt="������н�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14779553-fromuid-34626185.html" target="_blank" class="text">������н�����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14779885-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn74.jpg" alt="���е���������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14779885-fromuid-34626185.html" target="_blank" class="text">���е���������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818453-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn76.jpg" alt="¿������Ȼ����Ľ�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818453-fromuid-34626185.html" target="_blank" class="text">¿������Ȼ����Ľ�����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818123-fromuid-34626185.html" target="_blank" class="pic"><img src="images/jiangpin/yn77.jpg" alt="¶Ӫ��ῪĻʽ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818123-fromuid-34626185.html" target="_blank" class="text">¶Ӫ��ῪĻʽ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818259-fromuid-34626185.html" target="_blank" class="pic"><img src="images/jiangpin/yn78.jpg" alt="¿�����������Լ�������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818259-fromuid-34626185.html" target="_blank" class="text">¿�����������Լ�������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818411-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn79.jpg" alt="̨��ׯ�ų���ϲ�������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-890779-pid-14818411-fromuid-34626185.html" target="_blank" class="text">̨��ׯ�ų���ϲ�������</a>
</div>

<!-- �����ڼ������� ������ɾ����������� -->

<div style="display:none">

<!--//fzpic14����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic14]--><div id="fzpic14" class="area"></div><!--[/diy]-->

<!--//fzpic14����ͼƬ�б���ʽһByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s16">

<!-- �����ڼ���뿪ʼ ������ɾ����������� -->

<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931658-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn60.jpg" alt="8264�����������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931658-fromuid-34626185.html" target="_blank" class="text">8264�����������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=974716&amp;page=2#pid14931765" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn61.jpg" alt="¿�������е�Ц��" /></a>
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=974716&amp;page=2#pid14931765" target="_blank" class="text">¿�������е�Ц��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=974716&amp;page=2#pid14931779" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn62.jpg" alt="�ֳ��Ļ" /></a>
<a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=974716&amp;page=2#pid14931779" target="_blank" class="text">�ֳ��Ļ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931886-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn63.jpg" alt="�߲ʳ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931886-fromuid-34626185.html" target="_blank" class="text">�߲ʳ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931894-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn64.jpg" alt="���ǳ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14931894-fromuid-34626185.html" target="_blank" class="text">���ǳ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932071-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn65.jpg" alt="¶Ӫ��ῪĻʽ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932071-fromuid-34626185.html" target="_blank" class="text">¶Ӫ��ῪĻʽ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932095-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn66.jpg" alt="ҹɫ�µľ�ɫ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932095-fromuid-34626185.html" target="_blank" class="text">ҹɫ�µľ�ɫ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934260-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn67.jpg" alt="���ߵ��ֳ�����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934260-fromuid-34626185.html" target="_blank" class="text">���ߵ��ֳ�����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934397-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn68.jpg" alt="�ֳ���ʽ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934397-fromuid-34626185.html" target="_blank" class="text">�ֳ���ʽ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934448-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn69.jpg" alt="��¿���ǰ취��Ʒ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14934448-fromuid-34626185.html" target="_blank" class="text">��¿���ǰ취��Ʒ</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923754-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn70.jpg" alt="���е�¶Ӫ������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923754-fromuid-34626185.html" target="_blank" class="text">���е�¶Ӫ������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923771-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn71.jpg" alt="����¿�ѻ��һ��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923771-fromuid-34626185.html" target="_blank" class="text">����¿�ѻ��һ��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923997-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn72.jpg" alt="¿���ǹ������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974385-pid-14923997-fromuid-34626185.html" target="_blank" class="text">¿���ǹ������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932095-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn66.jpg" alt="ҹɫ�µľ�ɫ" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-974716-pid-14932095-fromuid-34626185.html" target="_blank" class="text">ҹɫ�µľ�ɫ</a>
</div>

<!-- �����ڼ������� ������ɾ����������� -->

<div style="display:none">

<!--//fzpic16����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic16]--><div id="fzpic16" class="area"></div><!--[/diy]-->

<!--//fzpic16����ͼƬ�б���ʽһByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong active" id="sq-s17">

<!-- �����ڼ���뿪ʼ ������ɾ����������� -->
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-1050803-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn108.jpg" alt="ף������ɹ�" /></a>
<a href="http://bbs.8264.com/forum-viewthread-tid-1050803-fromuid-34626185.html" target="_blank" class="text">ף������ɹ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15798910-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn109.jpg" alt="־Ը�߼���������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15798910-fromuid-34626185.html" target="_blank" class="text">־Ը�߼���������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15800322-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn110.jpg" alt="�峿¿����һ���٤" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15800322-fromuid-34626185.html" target="_blank" class="text">�峿¿����һ���٤</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15805221-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn111.jpg" alt="����Χ��������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15805221-fromuid-34626185.html" target="_blank" class="text">����Χ��������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807355-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn112.jpg" alt=""��"�еĻ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807355-fromuid-34626185.html" target="_blank" class="text">�������еĻ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807492-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn113.jpg" alt="ľ����ԭ¶Ӫ����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807492-fromuid-34626185.html" target="_blank" class="text">ľ����ԭ¶Ӫ����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807559-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn114.jpg" alt="8264��������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807559-fromuid-34626185.html" target="_blank" class="text">8264��������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807635-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn115.jpg" alt="����ĸ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807635-fromuid-34626185.html" target="_blank" class="text">����ĸ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807635-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn116.jpg" alt="DJ�����ֳ����մﵽ�߳�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807635-fromuid-34626185.html" target="_blank" class="text">DJ�����ֳ����մﵽ�߳�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807665-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn117.jpg" alt="���ĵ�¿����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807665-fromuid-34626185.html" target="_blank" class="text">���ĵ�¿����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807962-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn118.jpg" alt="Ӫ����Ϸ��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807962-fromuid-34626185.html" target="_blank" class="text">Ӫ����Ϸ��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807962-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn119.jpg" alt="��������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15807962-fromuid-34626185.html" target="_blank" class="text">��������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15808425-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn120.jpg" alt="ӭ���˵�һ�Ƴ���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15808425-fromuid-34626185.html" target="_blank" class="text">ӭ���˵�һ�Ƴ���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15833527-fromuid-34626185.htmlt" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn121.jpg" alt="�ڻ���ֻ�п���..." /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15833527-fromuid-34626185.html" target="_blank" class="text">�ڻ���ֻ�п���...</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15833704-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn122.jpg" alt="����CS��¶Ӫ�ں�ඣ�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1050803-pid-15833704-fromuid-34626185.html" target="_blank" class="text">����CS��¶Ӫ�ں�ඣ�</a>
</div>

<!-- �����ڼ������� ������ɾ����������� -->

<div style="display:none">

<!--//fzpic14����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic14]--><div id="fzpic14" class="area"></div><!--[/diy]-->

<!--//fzpic14����ͼƬ�б���ʽһByAndes//-->

</div>
<div class="clear"></div>
</div>
<div class="mod_cont pic_165px neirong" id="sq-s18">

<!-- �����ڼ���뿪ʼ ������ɾ����������� -->
<div class="pic_box">
<a href="http://bbs.8264.com/forum-viewthread-tid-1057408-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn125.jpg" alt="����ֳ�" /></a>
<a href="http://bbs.8264.com/forum-viewthread-tid-1057408-fromuid-34626185.html" target="_blank" class="text">����ֳ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899337-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn126.jpg" alt="��ᱨ����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899337-fromuid-34626185.html" target="_blank" class="text">��ᱨ����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899373-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn127.jpg" alt="¶Ӫ����ֳ�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899373-fromuid-34626185.html" target="_blank" class="text">¶Ӫ����ֳ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899373-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn128.jpg" alt="���ֻ��׼��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899373-fromuid-34626185.html" target="_blank" class="text">���ֻ��׼��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899381-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn129.jpg" alt="�μ���ʳ��¿����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899381-fromuid-34626185.html" target="_blank" class="text">�μ���ʳ��¿����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn130.jpg" alt="������ɫ���ֳ��ƹ�" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="text">������ɫ���ֳ��ƹ�</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn131.jpg" alt="�ֶӵ���������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="text">�ֶӵ���������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899424-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn132.jpg" alt="������ɫ���ֹı���" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899424-fromuid-34626185.htmll" target="_blank" class="text">������ɫ���ֹı���</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899438-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn133.jpg" alt="���ĳ齱����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899438-fromuid-34626185.html" target="_blank" class="text">���ĳ齱����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899445-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn134.jpg" alt="С¿����Ҳ��������" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899445-fromuid-34626185.html" target="_blank" class="text">С¿����Ҳ��������</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899460-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn135.jpg" alt="���������ҹ��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899460-fromuid-34626185.html" target="_blank" class="text">���������ҹ��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899460-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn136.jpg" alt="�����¿����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899460-fromuid-34626185.html" target="_blank" class="text">�����¿����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15909919-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn137.jpg" alt="��¿���ݴ����" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15909919-fromuid-34626185.html" target="_blank" class="text">��¿���ݴ����</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15909919-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn138.jpg" alt="��ֳ���ͷӿ��" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15909919-fromuid-34626185.html" target="_blank" class="text">��ֳ���ͷӿ��</a>
</div>
<div class="pic_box">
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/jiangpin/yn139.jpg" alt="�������빷��ʯͷ�ķ緶" /></a>
<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1057408-pid-15899401-fromuid-34626185.html" target="_blank" class="text">�������빷��ʯͷ�ķ緶</a>
</div>
<!-- �����ڼ������� ������ɾ����������� -->

<div style="display:none">

<!--//fzpic14����ͼƬ�б���ʽһByAndes//-->

<!--[diy=fzpic14]--><div id="fzpic14" class="area"></div><!--[/diy]-->

<!--//fzpic14����ͼƬ�б���ʽһByAndes//-->

</div>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
<div class="main_zt_all">
<div class="mod_tit bg2">ȫ��������<span class="tit_textad">����Ǣ̸������	�绰��13920440860</span></div>
<div class="support pic_100px">
<a href="http://www.kailas.com.cn" target="_blank" class="pic"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/03/032f60fc2b41b046508fe6884d8acbaf.jpg" title="KAILAS������ʯ������װ��" /></a>
<a href="http://www.jack-wolfskin.com/" target="_blank" class="pic"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/a5/a574a5c82bb4d07176a5d972803653a9.jpg" title="JACK WOLFSKIN����צ�� ����װ��" /></a>
<a href="http://www.ten-thirty.com" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/tenthirty.jpg" title="Ten-Thirty�ֱ�" /></a>
<a href="http://www.ruggear.net" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/langjie.jpg" title="�ʽ继�������ֻ�" /></a>
<a href="http://www.xmjoin-tech.com" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/zhenyi.jpg" title="BOTOO���������ֻ�" /></a>
<a href="http://www.robinsonoutdoor.cn" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/robinson.jpg" title="³��ѷ����" /></a>
<a href="http://www.highrock.com.cn" target="_blank" class="pic"><img src="http://static.8264.com/oldcms/moban/zt/2011tents_congress/images/zanzhu/highrock.jpg" title="��ʯ����" /></a>
<a href="http://www.cnbulin.com/index1.asp" target="_blank" class="pic"><img src="http://bbs.8264.com/data/attachment/threadpic/100x50/d8/d8182a14187f0c477c874b086cde5b3c.jpg" title="�¸��ߴ���" /></a>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
</div>

<!-- main_zt end -->

<!-- footer_zt start -->

<div class="clear"></div>
<script src="http://www.8264.com/template/8264/js/common.js" type="text/javascript" type="text/javascript"></script>
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
<p> �������ߣ�022-23708264 | ���棺022-23708264 | ��ַ������л�Է��ҵ԰����ï��Ӫ�Ƽ�԰C2��6��AB��Ԫ</p>
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

<!-- Andes Edition:2011-07-13 -->