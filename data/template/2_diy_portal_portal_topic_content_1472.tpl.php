<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1472', 'common/header_diy');
block_get('6887,6889');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��ʹ����ɽ������Ľ���</title>
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
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
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
<style id="diy_style" type="text/css">#frame892T7Q {  margin:0px !important;border:#000000 none !important;background-color:transparent !important;background-image:none !important;}#portal_block_6887 {  margin:0px !important;border:#000000 none !important;background-color:transparent !important;background-image:none !important;}#portal_block_6887 .content {  margin:0px !important;}#frameJ9gO4E {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6889 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6889 .content {  margin:0px !important;}</style>
<!--diy��ʽ����-->
<link href="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/style/style.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/js/DD_belatedPNG_css.js" type="text/javascript"></script>'/
<![endif]-->

<div class="midcon branner">
<div class="brannercon"></div>
</div>
<div class="midcon"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/title1.jpg"></div>
<div class="midcon mid1">
<div class="sideleft mid1side shan_list shan_lists">
        <span>2004��9��25�� ׿���ѷ�ChoOyo��8201�ף���������߷�  �Ƕ� [��һ��]</span>
        <span>2009��5��14�� ���������Everest��8844�ף������һ�߷�  �Ƕ� [�ڶ���]</span>
        <span>2009��9��28�� ϣ�İ����Shisha Pangma��8027�ף������ʮ�ĸ߷� �Ƕ� [������]</span>
        <span>2010��5��13��  ���������Dhaulagiri��8172�ף�������߸߷� �Ƕ� [������]</span>
        <span>2010��9�� ����˹³��Manaslu��8156�ף�����ڰ˸߷�  �Ƕ� [������]</span>
        <span>2011��5�� �ɳ��¼η�Kanchenjunga��8586�ף���������߷�  �Ƕ� [������]</span>
        <span>2011��7��  ���沼³ķI��Gasherbrum1��8068�ף������ʮһ�߷� ����������δ���</span>
        <span>2012��4��20��  �����ն��ɷ�AnnaPurna��8091�ף������ʮ�߷� �Ƕ� [������]</span>
        <span>2012��5��10��  ��³��Makalu��8463�ף��������߷� �Ƕ� [�ڰ���]</span>
        <span>2012��5��19��  ���ӷ�Lhotse��8516�ף� ������ĸ߷�  �Ƕ� [�ھ���]</span>
        <span>2012��7��31��  �Ǹ���K2(8611�ף�����ڶ��߷� [��ʮ��]</span>
        <p>�������14����ʣ4���������������ط壨����8126�� ����ھŸ߷壩�����尢�ط壨����8047�� �����ʮ���߷壩�����沼³ķI�壨����8068�� �����ʮһ�߷壩II�壨����8035�� �����ʮ���߷� ��</p>
        <div class="ck">
        	<h5>�Ľ�������˺�</h5>
            <em>�� �ţ�6226 0975 5879 9939���׾�׿���Ľ������ӣ�</em>
            <em>�����У��������������л��ȳ�֧��</em>
        </div>
    </div>
    <div class="sideright mid1side shan_list">
        <span>2007��5��  ��֯����"�½�ơ������ɽ��"�ʵ���壬5����Ա�Ƕ�[��һ��]</span>
        <span>2008��10��  ����9����Ա�Ƕ�׿���ѷ壨����8201�ף�[�ڶ���]</span>
        <span>2009��5�� ��֯����"�й���ͨ����ɽ��"�ʵ���壬8����Ա�Ƕ�</span>
        <span>2009��9�� ��֯���������֧����ɽ�Ӹ������ʵ�����˹³�壨8163�ף���8����Ա�Ƕ�[������]</span>
        <span>2010��5��  ����������ӵǶ�������߸߷��������壨8167�ף�[������]</span>
        <span>2010��10�� �����������ɽ���ٴεǶ�����˹³��</span>
        <span>2011��5�� �ɹ��Ƕ���������߷�---�ɳ��¼η壨���� 8586 �ף�[������]</span>
        <span>2011��8�� �ɹ��Ƕ����沼³ķII�壨8035��[������]��I�壨8068��[������]</span>
        <span>2011��10�� �ʶӵ����γɹ��Ƕ�����ڰ˸߷�---����˹³��</span>
        <span>2012��4�� �ɹ��Ƕ�����8091�׵İ����ն��ɷ�[�ڰ���]</span>
        <span>2012��5�� �ɹ��Ƕ�����8516�׵����ӷ�[�ھ���]</span>
        <span>2012��7�� �ɹ��Ƕ�����8611�׵�K2��8611�ף�[��ʮ��]</span>
        <span>2013��4�� �ɹ��Ƕ�����8463�׵�������ĸ߷���³��[��ʮһ��]</span>
        <p>�������14����ʣ3���������������ط壨����8126�� ����ھŸ߷壩�����尢�ط壨����8047�� �����ʮ���߷壩��ϣ�İ���壨����8027�� �����ʮ�ĸ߷壩��ʮ���߷壩��ϣ�İ���壨����8027�� �����ʮ�ĸ߷壩</p>
        <div class="ck">
        	<h5>�������˺�</h5>     
            <em>�� �ţ�6217 8583 0000 6982 376�������ƣ����֮�ӣ�</em>
            <em>�����У��й�������³ľ����ʯ��֧��</em>
            <em>�� �ţ�104881007017</em>
        </div>
    </div>
</div>
<div class="midcon mid1 cf">
<div class="sideleft mid1side">
    	<span>��ǰ�ɷã�</span>
        <a href="#" target="_blank">��磺���ڵ�ɽ����ȫ���������K2�ʵ�</a>
        <a href="#" target="_blank">ִ���ĵ�ɽ����磺�ʵ�K2����ѧ��ܶ�</a>
    </div>
    <div class="sideright mid1side">
    	<span>��ǰ�ɷã�</span>
        <a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a>
        <a href="#" target="_blank">Ů�����е��Ľ��壺�ʵ����еĴ�ɽ[��ͼ]</a>
    </div>
</div>
<div class="midcon mid1">
<div class="sideleft mid1side">
    	<ul class="imgbigwarpten">
        	<li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
        </ul>
    </div>
    <div class="sideright  mid1side">
    	<ul class="imgbigwarpten">
        	<li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">�Ľ��壺��ɽ�Ǻ��Լ����ĶԻ��Ĺ���[��Ƶ]</a></div></li>
        </ul>
    </div>
</div>
<div class="midcon mid2">
<div class="sideleft news">
    	<h5 class="title">�¼�����</h5>
        <!--[diy=news]--><div id="news" class="area"><div id="frame892T7Q" class=" frame move-span cl frame-1"><div id="frame892T7Q_left" class="column frame-1-c"><div id="frame892T7Q_left_temp" class="move-span temp"></div><?php block_display('6887'); ?></div></div></div><!--[/diy]-->
    </div>
    <div class="sideright wynews">
    	<h5 class="title" style="text-indent:20px;">���Ѽ���</h5>
        <div class="scrollnews">
            	<ul>
                    <!--[diy=diaoyan]--><div id="diaoyan" class="area"><div id="frameJ9gO4E" class=" frame move-span cl frame-1"><div id="frameJ9gO4E_left" class="column frame-1-c"><div id="frameJ9gO4E_left_temp" class="move-span temp"></div><?php block_display('6889'); ?></div></div></div><!--[/diy]-->
                </ul>
            </div>
    </div>
</div>
<div class="midcon" style=" padding:15px 0px 0px 0px;"><?php show_topic_comment() ?>    <style>#topic_replay_comment{ width:900px !important;}</style>
</div>

<div class="bottom">
<div class="bottomcon">
    	<p class="footer_l">8264 ��Ȩ���� ��ICP��05004140��-10 ICP֤ ��B2-20110106<br><a href="http://bx.8264.com" target="_blank">�����з��գ�8264�����������Ᵽ��</a></p>
    <p class="footer_r"><a target="_blank" href="http://www.8264.com/about-index.html">8264���</a> | <a target="_blank" href="http://www.8264.com/about-contact.html">��ϵ����</a> | <a target="_blank" href="http://www.8264.com/about-adservice.html">������</a> | <a target="_blank" href="http://www.8264.com/link/">������ַ��ȫ</a> | <a target="_blank" href="http://www.8264.com/sitemap">��վ��ͼ</a></p>
    	<div class="clear"></div>
    </div>
</div>

<script type="text/javascript">
jQuery(".imgbigwarpten li").mouseover(function(){
jQuery(".tan",this).show();
}).mouseout(function(){
jQuery(".tan",this).hide();
});

jQuery(function(){
var jQuerythis = jQuery(".scrollnews");
var scrollTimer;
jQuerythis.hover(function(){
clearInterval(scrollTimer);
},function(){
scrollTimer = setInterval(function(){
 scrollNews( jQuerythis );
}, 3000 );
}).trigger("mouseleave");
});
function scrollNews(obj){
var jQueryself = obj.find("ul:first"); 
var lineHeight = jQueryself.find("li:first").height(); //��ȡ�и�
jQueryself.animate({ "marginTop" : -lineHeight +"px" }, 600 , function(){
jQueryself.css({marginTop:0}).find("li:first").appendTo(jQueryself); //appendTo��ֱ���ƶ�Ԫ��
})
};
</script>





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
<script src="http://static.8264.com/oldcms/moban/zt/2013tibohui/js/common.js" type="text/javascript" type="text/javascript" language="javascript"></script> 

</body>
</html>
