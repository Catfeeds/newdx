<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1464', 'common/header_diy');
block_get('6881,6882,6883');?>
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
<a id="diy-tg" href="javascript:openDiy();" title="打开 DIY 面板"><img src="<?php echo STATICURL;?>image/diy/panel-toggle.png" alt="DIY" /></a>
<?php } ?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<?php if($_GET['diy'] == 'yes' && (CURMODULE == 'topic' || $_G['group']['allowdiy']) && !empty($_G['style']['tplfile'])) { include template('common/header_diy'); } if(empty($topic) || $topic['useheader']) { ?><?php echo adshow("headerbanner/wp a_h"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_header'])) echo $_G['setting']['pluginhooks']['global_header']; } ?>   
<!--dx代码结束-->
<!--diy样式开始-->
<style id="diy_style" type="text/css">#framekXILei {  margin:0px !important;border:medium none !important;}#portal_block_6881 {  margin:0px !important;border:medium none !important;}#portal_block_6881 .content {  margin:0px !important;}#frameDun7AD {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_6882 {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_6882 .content {  margin:0px !important;}#framevUBv7q {  background-image:none !important;background-color:transparent !important;margin:0px !important;border:medium none !important;}#portal_block_2430 {  margin:0px !important;border:medium none !important;}#portal_block_2430 .content {  margin:0px !important;}#framepY6q66 {  margin:0px !important;border:#000000 none !important;background-color:transparent !important;background-image:none !important;}#portal_block_6883 {  margin:0px !important;border:#000000 none !important;background-color:transparent !important;background-image:none !important;}#portal_block_6883 .content {  margin:0px !important;}</style>
<!--diy样式结束-->
<!--自己样式开始-->
<link href="http://static.8264.com/oldcms/moban/zt/2013ninghai/style/style.css" rel="stylesheet" type="text/css" />
<!--自己样式结束-->

<div class="bgTop"></div>
<div class="warpper">
    
    <div class="mid1">
        <div class="mid_l">
            <!--//轮播宽度270 高度220//-->
            <!--[diy=lunbo]--><div id="lunbo" class="area"><div id="framekXILei" class=" frame move-span cl frame-1"><div id="framekXILei_left" class="column frame-1-c"><div id="framekXILei_left_temp" class="move-span temp"></div><?php block_display('6881'); ?></div></div></div><!--[/diy]-->
        </div>
        <div class="mid_m">
            <div class="mid_m_news">
                <h1><a href="#" target="_blank">2011年全国露营大会宁海县许家山圆满开幕[图]</a></h1>
                &nbsp;&nbsp;&nbsp;&nbsp;5月21日上午10点30分，著名登山家、国家体育总局登山运动管理中心副主任、国家登山队队长王勇峰高声宣布，“2011年全国露营大会开幕！”这标志着中国宁海·2011年全国露营大会开幕式活动正式启动，2011年全国露营大会由此拉开全年大幕。<a href="/66420.html" target="_blank" class="more">详细>></a>
            </div>
            <div class="mid_m_news">
                <h1><a href="http://bbs.8264.com/thread-767977-1-1.html" target="_blank">8264论坛对本次大会的图文报道帖</a></h1>
                &nbsp;&nbsp;&nbsp;&nbsp;2011全国露营大会开幕式，暨2011全国露营大会宁海站在宁波市宁海县许家山村顺利开幕，来自全国十多个城市的50多个俱乐部的2000多名驴友参加了本次大会，8264记者大鹏将为大家第一时间带来本次露营大会现场的报道，欢迎关注...<a href="http://bbs.8264.com/thread-767977-1-1.html" target="_blank"  class="more">详细>></a>
            </div>
        </div>
        <div class="mid_r">
            <div class="mid_rtitle">最新资讯 <span>NEWS</span></div>
            <div class="mid_rcon">
                <!--//最新资讯 8条//-->
                <!--[diy=zxlist]--><div id="zxlist" class="area"><div id="frameDun7AD" class=" frame move-span cl frame-1"><div id="frameDun7AD_left" class="column frame-1-c"><div id="frameDun7AD_left_temp" class="move-span temp"></div><?php block_display('6882'); ?></div></div></div><!--[/diy]-->
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="mid2">
        <div class="titlebg">大会活动</div>
        <div class="mid2con">
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="http://www.mytentlife.com/News/205.html" target="_blank">山地耐力越野赛</a></div>
                <a href="http://www.mytentlife.com/News/205.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/sdyy.jpg" /></a>
                <div class="mid2coninfor">5月21日12:30至16:30<br>地点:宁海县国家登山健身步道</div>
            </div>
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="http://www.mytentlife.com/News/206.html" target="_blank">技巧性走扁带争先赛</a></div>
                <a href="http://www.mytentlife.com/News/206.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/zbd.jpg" /></a>
                <div class="mid2coninfor">5月21日12:30至17:00<br>地点:许家山村营地</div>
            </div>
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="http://www.mytentlife.com/News/207.html" target="_blank">山地自行车赛</a></div>
                <a href="http://www.mytentlife.com/News/207.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/zxc.jpg" /></a>
                <div class="mid2coninfor">5月21日12:30至15:30<br>地点:许家山村营地</div>
            </div>
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="http://www.mytentlife.com/News/208.html" target="_blank">拼图+古村寻宝</a></div>
                <a href="http://www.mytentlife.com/News/208.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/dx.jpg" /></a>
                <div class="mid2coninfor">5月21日14:00至17:00<br>地点:许家山村石屋</div>
            </div>
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="#" target="_blank">音乐晚会</a></div>
                <a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/yywh.jpg" /></a>
                <div class="mid2coninfor">5月21日20:00-22:00<br>地点:许家山村营地</div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<div class="mid2">
        <div class="titlebg">休闲活动</div>
        <div class="mid2con">
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="http://www.mytentlife.com/News/205.html" target="_blank">山地耐力越野赛</a></div>
                <a href="http://www.mytentlife.com/News/205.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/sdyy.jpg" /></a>
                <div class="mid2coninfor">5月21日12:30至16:30<br>地点:宁海县国家登山健身步道</div>
            </div>
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="http://www.mytentlife.com/News/206.html" target="_blank">技巧性走扁带争先赛</a></div>
                <a href="http://www.mytentlife.com/News/206.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/zbd.jpg" /></a>
                <div class="mid2coninfor">5月21日12:30至17:00<br>地点:许家山村营地</div>
            </div>
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="http://www.mytentlife.com/News/207.html" target="_blank">山地自行车赛</a></div>
                <a href="http://www.mytentlife.com/News/207.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/zxc.jpg" /></a>
                <div class="mid2coninfor">5月21日12:30至15:30<br>地点:许家山村营地</div>
            </div>
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="http://www.mytentlife.com/News/208.html" target="_blank">拼图+古村寻宝</a></div>
                <a href="http://www.mytentlife.com/News/208.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/dx.jpg" /></a>
                <div class="mid2coninfor">5月21日14:00至17:00<br>地点:许家山村石屋</div>
            </div>
            <div class="mid2conimgall">
                <div class="mid2conname"><a href="#" target="_blank">音乐晚会</a></div>
                <a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/huodong/yywh.jpg" /></a>
                <div class="mid2coninfor">5月21日20:00-22:00<br>地点:许家山村营地</div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<div class="mid2">
        <div class="titlebg">现场图集</div>
        <div class="mid2con">
<!--//现场图集//-->
            <!--[diy=tuwen]--><div id="tuwen" class="area"><div id="framepY6q66" class=" frame move-span cl frame-1"><div id="framepY6q66_left" class="column frame-1-c"><div id="framepY6q66_left_temp" class="move-span temp"></div><?php block_display('6883'); ?></div></div></div><!--[/diy]-->
            <div class="clear"></div>
        </div>
    </div>
    <div class="mid2">
        <div class="titlebg">宁海风光</div>
        <div class="mid2con">
<div class="mid3_l">
            	<div class="mid3_ltitle">宁海概况</div>
                <div class="mid3_lcon">宁海，位于中国大陆海岸线中段，浙江省东部沿海，象山港和三门湾之间，天台山、四明山山脉交汇之处，计划单列市宁波市属县，国务院批准的第一批沿海对外开放地区之一。人口面积 全县下辖4个街道办事处、14个镇乡，人口60万，总面积1931平方公里，海岸线176公里。<a href="http://www.mytentlife.com/News/190.html" target="_blank">详细>></a></div>
                <div class="mid3_ltitle">许家山村营地</div>
                <div class="mid3_lcon">许家山村属于茶院乡许民行政村的一个自然村（其他还有民户田、许家、亦长坪、小庵4个自然村），位于宁海县东部、茶院乡西部，距县城13.5公里，距茶院乡政府3.1公里，平均海拔约200米。全村有277户，总人口720人 <a href="/66367.html" target="_blank">详细>></a></div>
            </div>
            <div class="mid3_r">
            
                <div class="lunbo_lall" id="sh_ce_p">
                    <div class="lunbo_l" id="ce_pic1" onmousemove="slide_ty(1)"><a href="http://www.mytentlife.com/News/190.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/fengguang/nhqj.jpg" /></a></div>
                    <div class="lunbo_l" id="ce_pic2" onmousemove="slide_ty(2)"><a href="/66375.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/fengguang/jqqd.jpg" /></a></div>
                    <div class="lunbo_l" id="ce_pic3" onmousemove="slide_ty(3)"><a href="http://www.8264.com/viewnews-66375-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/fengguang/wssk.jpg" /></a></div>
                    <div class="lunbo_l" id="ce_pic4" onmousemove="slide_ty(4)"><a href="http://www.8264.com/viewnews-66375-page-4.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/fengguang/hls.jpg" /></a></div>
                    <div class="lunbo_l" id="ce_pic5" onmousemove="slide_ty(5)"><a href="http://www.8264.com/viewnews-66375-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ninghai/images/fengguang/yhq.jpg" /></a></div>
                </div>
                <div class="lunbo_r">
                    <div class="lunbo_title1" id="sh_tip1" onmousemove="slide_ty(1)">宁海全景</div>
                    <div class="lunbo_title" id="sh_tip2" onmousemove="slide_ty(2)">强蛟群岛</div>
                    <div class="lunbo_title" id="sh_tip3" onmousemove="slide_ty(3)">长街伍山石窟</div>
                    <div class="lunbo_title" id="sh_tip4" onmousemove="slide_ty(4)">梁皇山</div>
                    <div class="lunbo_title" id="sh_tip5" onmousemove="slide_ty(5)">野鹤湫</div>
                	<div style="clear:both;"></div>
                </div>
                <div style="clear:both;"></div>
<script language="javascript">
                var _tnum;
                var tMyMar;
                var tSize=5;
                function slide_ty(v){
                for(i=1;i<=tSize;i++){
                document.getElementById("ce_pic"+i).style.display="none";
                document.getElementById("sh_tip"+i).className="lunbo_title";
                }
                document.getElementById("ce_pic"+v).style.display="";
                document.getElementById("sh_tip"+v).className="lunbo_title lunbo_title1";
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
</div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="bottom1"></div>
</div>
<div class="bottom"><a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264简介</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank">广告服务</a>&nbsp;|&nbsp;<a href="http://www.8264.com/list/531/" target="_blank">编辑部的故事</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/sitemap.html" target="_blank">站点地图</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">户外热点</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">联系方式</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank">QQ群联盟</a>&nbsp;|&nbsp;<a href="http://8.8264.com/job/" target="_blank">8264招聘</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">友情链接</a><br>
          服务热线：022-23708264&nbsp;|&nbsp;传真：022-23708323&nbsp;|&nbsp;地址：天津市新技术产业园华苑产业区华天道8号海泰信息广场C座1001号<br>
          <a href="http://bx.8264.com" target="_blank"><span>户外活动有风险，8264提醒您购买</span></a> <a href="http://bx.8264.com">户外保险</a><br>
          除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264&nbsp;版权所有   <a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-1</a>
</div>



<!--dx代码开始-->  
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?><?php updatesession(); ?><!--dx代码结束-->
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
