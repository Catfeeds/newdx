<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1472', 'common/header_diy');
block_get('6887,6889');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>沉痛悼念山友杨春风饶剑峰</title>
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
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a> 
<?php } ?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { ?> <?php include template('common/header_diy'); ?> 
<?php } ?> 
<?php if(empty($topic) || $topic['useheader']) { ?> <?php echo adshow("headerbanner/wp a_h"); ?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; ?> 
<?php } ?> 
<!--dx代码结束--> 
<!--diy样式开始-->
<style id="diy_style" type="text/css">#frame892T7Q {  margin:0px !important;border:#000000 none !important;background-color:transparent !important;background-image:none !important;}#portal_block_6887 {  margin:0px !important;border:#000000 none !important;background-color:transparent !important;background-image:none !important;}#portal_block_6887 .content {  margin:0px !important;}#frameJ9gO4E {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6889 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6889 .content {  margin:0px !important;}</style>
<!--diy样式结束-->
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
        <span>2004年9月25日 卓奥友峰ChoOyo（8201米）世界第六高峰  登顶 [第一座]</span>
        <span>2009年5月14日 珠穆朗玛峰Everest（8844米）世界第一高峰  登顶 [第二座]</span>
        <span>2009年9月28日 希夏邦马峰Shisha Pangma（8027米）世界第十四高峰 登顶 [第三座]</span>
        <span>2010年5月13日  道拉吉里峰Dhaulagiri（8172米）世界第七高峰 登顶 [第四座]</span>
        <span>2010年9月 马纳斯鲁峰Manaslu（8156米）世界第八高峰  登顶 [第五座]</span>
        <span>2011年5月 干城章嘉峰Kanchenjunga（8586米）世界第三高峰  登顶 [第六座]</span>
        <span>2011年7月  迦舒布鲁姆I峰Gasherbrum1（8068米）世界第十一高峰 因遭遇车祸未完成</span>
        <span>2012年4月20日  安纳普尔纳峰AnnaPurna（8091米）世界第十高峰 登顶 [第七座]</span>
        <span>2012年5月10日  马卡鲁峰Makalu（8463米）世界第五高峰 登顶 [第八座]</span>
        <span>2012年5月19日  洛子峰Lhotse（8516米） 世界第四高峰  登顶 [第九座]</span>
        <span>2012年7月31日  乔戈里K2(8611米）世界第二高峰 [第十座]</span>
        <p>距离完成14座仅剩4座：南迦帕尔巴特峰（海拔8126米 世界第九高峰）、布洛阿特峰（海拔8047米 世界第十二高峰）、迦舒布鲁姆I峰（海拔8068米 世界第十一高峰）II峰（海拔8035米 世界第十三高峰 ）</p>
        <div class="ck">
        	<h5>饶剑峰捐助账号</h5>
            <em>账 号：6226 0975 5879 9939：米君卓（饶剑峰妻子）</em>
            <em>开户行：招商银行深圳市华侨城支行</em>
        </div>
    </div>
    <div class="sideright mid1side shan_list">
        <span>2007年5月  组织带领"新疆啤酒珠峰登山队"攀登珠峰，5名队员登顶[第一座]</span>
        <span>2008年10月  带领9名队员登顶卓奥友峰（海拔8201米）[第二座]</span>
        <span>2009年5月 组织带领"中国联通珠峰登山队"攀登珠峰，8名队员登顶</span>
        <span>2009年9月 组织带领国内首支民间登山队赴境外攀登马纳斯鲁峰（8163米），8名队员登顶[第三座]</span>
        <span>2010年5月  带领国内民间队登顶世界第七高峰道拉吉里峰（8167米）[第四座]</span>
        <span>2010年10月 带领国内民间登山队再次登顶马纳斯鲁峰</span>
        <span>2011年5月 成功登顶世界第三高峰---干城章嘉峰（海拔 8586 米）[第五座]</span>
        <span>2011年8月 成功登顶迦舒布鲁姆II峰（8035）[第六座]、I峰（8068）[第七座]</span>
        <span>2011年10月 率队第三次成功登顶世界第八高峰---马纳斯鲁峰</span>
        <span>2012年4月 成功登顶海拔8091米的安纳普尔纳峰[第八座]</span>
        <span>2012年5月 成功登顶海拔8516米的洛子峰[第九座]</span>
        <span>2012年7月 成功登顶海拔8611米的K2（8611米）[第十座]</span>
        <span>2013年4月 成功登顶海拔8463米的世界第四高峰马卡鲁峰[第十一座]</span>
        <p>距离完成14座仅剩3座：南迦帕尔巴特峰（海拔8126米 世界第九高峰）、布洛阿特峰（海拔8047米 世界第十二高峰）、希夏邦马峰（海拔8027米 世界第十四高峰）第十二高峰）、希夏邦马峰（海拔8027米 世界第十四高峰）</p>
        <div class="ck">
        	<h5>杨春风捐助账号</h5>     
            <em>账 号：6217 8583 0000 6982 376：杨起云（杨春风之子）</em>
            <em>开户行：中国银行乌鲁木齐市石化支行</em>
            <em>行 号：104881007017</em>
        </div>
    </div>
</div>
<div class="midcon mid1 cf">
<div class="sideleft mid1side">
    	<span>生前采访：</span>
        <a href="#" target="_blank">杨春风：国内登山者完全有能力完成K2攀登</a>
        <a href="#" target="_blank">执著的登山者杨春风：攀登K2让我学会很多</a>
    </div>
    <div class="sideright mid1side">
    	<span>生前采访：</span>
        <a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a>
        <a href="#" target="_blank">女儿眼中的饶剑峰：攀登心中的大山[组图]</a>
    </div>
</div>
<div class="midcon mid1">
<div class="sideleft mid1side">
    	<ul class="imgbigwarpten">
        	<li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
        </ul>
    </div>
    <div class="sideright  mid1side">
    	<ul class="imgbigwarpten">
        	<li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
            <li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013yangchunfeng/images/test.jpg" /></a><div class="tan"><a href="#" target="_blank">饶剑峰：登山是和自己内心对话的过程[视频]</a></div></li>
        </ul>
    </div>
</div>
<div class="midcon mid2">
<div class="sideleft news">
    	<h5 class="title">事件报道</h5>
        <!--[diy=news]--><div id="news" class="area"><div id="frame892T7Q" class=" frame move-span cl frame-1"><div id="frame892T7Q_left" class="column frame-1-c"><div id="frame892T7Q_left_temp" class="move-span temp"></div><?php block_display('6887'); ?></div></div></div><!--[/diy]-->
    </div>
    <div class="sideright wynews">
    	<h5 class="title" style="text-indent:20px;">好友祭文</h5>
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
    	<p class="footer_l">8264 版权所有 津ICP备05004140号-10 ICP证 津B2-20110106<br><a href="http://bx.8264.com" target="_blank">户外有风险，8264提醒您购买户外保险</a></p>
    <p class="footer_r"><a target="_blank" href="http://www.8264.com/about-index.html">8264简介</a> | <a target="_blank" href="http://www.8264.com/about-contact.html">联系我们</a> | <a target="_blank" href="http://www.8264.com/about-adservice.html">广告服务</a> | <a target="_blank" href="http://www.8264.com/link/">户外网址大全</a> | <a target="_blank" href="http://www.8264.com/sitemap">网站地图</a></p>
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
var lineHeight = jQueryself.find("li:first").height(); //获取行高
jQueryself.animate({ "marginTop" : -lineHeight +"px" }, 600 , function(){
jQueryself.css({marginTop:0}).find("li:first").appendTo(jQueryself); //appendTo能直接移动元素
})
};
</script>





<?php if(empty($topic) || ($topic['usefooter'])) { ?> <?php $focusid = getfocus_rand($_G[basescript]); ?> 
<?php if($focusid !== null) { ?> <?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="sitefocus">
<h3 class="flb"> <em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?></em> <span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('sitefocus').style.display='none'" class="flbc" title="关闭">关闭</a></span> </h3>
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
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">查看</a> </div>
<?php } ?> 
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?> 
<?php } ?>

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
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { ?> <?php if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { ?> 
<?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a>
</li>
<?php } ?> 
<?php } ?> 
<?php } ?>
</ul>

<?php if($upgradecredit !== false) { ?>
<div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly"> 积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分 </div>
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
<!--dx代码结束-->
<script src="http://static.8264.com/oldcms/moban/zt/2013tibohui/js/common.js" type="text/javascript" type="text/javascript" language="javascript"></script> 

</body>
</html>
