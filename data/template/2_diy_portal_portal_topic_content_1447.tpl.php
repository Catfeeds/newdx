<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal_topic_content_1447', 'common/header_diy');
block_get('6862,6863,6864,6865,6866,6867,6868,6870');?>
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
<script src="http://static.8264.com/oldcms/moban/zt/2013ispo/js/jquery-1.4.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2013ispo/js/jquery.lazy-1.3.1.js" type="text/javascript"></script>
<script>
  $(document).ready(function(){
        jQuery.lazy({src:'http://static.8264.com/oldcms/moban/zt/2013ispo/js/jquery.darizi.js',name:'darizi',dependencies:{js:['http://static.8264.com/oldcms/moban/zt/2013ispo/js/jquery.countdown.js']},cache:true});
        // 大日子
        var ndate = new Date(2013,1,27); 
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
<style id="diy_style" type="text/css">#frameKusMq7 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6862 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_6862 .content {  margin:0px !important;}#frameyEiwuV {  margin:0px !important;border:none !important;}#portal_block_6863 {  margin:0px !important;border:none !important;}#portal_block_6863 .content {  margin:0px !important;}#frame5DoCl3 {  margin:0px !important;border:none !important;}#portal_block_6864 {  margin:0px !important;border:none !important;}#portal_block_6864 .content {  margin:0px !important;}#frame2v21TW {  margin:0px !important;border:none !important;}#portal_block_6865 {  margin:0px !important;border:none !important;}#portal_block_6865 .content {  margin:0px !important;}#frame4Ph23f {  margin:0px !important;border:none !important;}#portal_block_6866 {  margin:0px !important;border:none !important;}#portal_block_6866 .content {  margin:0px !important;}#frameC96TX7 {  margin:0px !important;border:none !important;}#portal_block_6867 {  margin:0px !important;border:none !important;}#portal_block_6867 .content {  margin:0px !important;}#framenxcD6i {  margin:0px !important;border:none !important;}#portal_block_6868 {  margin:0px !important;border:none !important;}#portal_block_6868 .content {  margin:0px !important;}#framerB33V7 {  margin:0px !important;border:none !important;}#portal_block_6870 {  margin:0px !important;border:none !important;}#portal_block_6870 .content {  margin:0px !important;}</style>
<!--diy样式结束-->
<link href="http://static.8264.com/oldcms/moban/zt/2013ispo/style/style.css" rel="stylesheet" type="text/css" />
<div class="branner"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/branner1.jpg"/></div>
<div class="navwarpper">
<div class="navcon"><a target="_blank" href="http://www.8264.com/">8264首页</a>&nbsp;&nbsp;<a href="/topic/1447.html#n1">展会动态</a> | <a href="http://static.8264.com/oldcms/moban/zt/2013ispo/ziliao/2013_ISPO_zw%20.pdf">展会地图</a> | <a href="/topic/1447.html#n3">互动专区</a> | <a href="http://www.8264.com/topic/1447.html#n4">专访</a> | <a href="/topic/1447.html#n5">新品</a> | <a href="/topic/1447.html#n6">驴友看ispo</a> | <a href="/topic/1447.html#n8">花絮</a></div>
</div>
<div class="warpper">
<!--第一模块开始 头条/展会快讯-->
    <div class="mid">
    	<div class="l1">
        	<!--轮播开始-->
            <div class="lunbo">
                <div id="focus_turn">
                    <ul id="focus_pic">
                        <li class="current"><a href="http://www.8264.com/viewnews-83470-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/lunbo/lb5.jpg" /></a></li>
                        <li class="normal"><a href="http://www.8264.com/viewnews-83024-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/lunbo/lb2.jpg" /></a></li>
                        <li class="normal"><a href="http://www.8264.com/viewnews-83096-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/lunbo/lb3.jpg" /></a></li>
<li class="normal"><a href="http://bbs.8264.com/thread-1616987-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/lunbo/lb4.jpg" /></a></li>
                    </ul>
                    <ul id="focus_tx">
                        <li class="current"><a href="http://www.8264.com/viewnews-83470-page-1.html" target="_blank">8264巅峰户外运动学校公益领队培训揭牌</a></li>
                        <li class="normal"><a href="http://www.8264.com/viewnews-83024-page-1.html" target="_blank">ISPO MUNICH 2013开幕 展商2481家创纪录</a></li>
                        <li class="normal"><a href="http://www.8264.com/viewnews-83096-page-1.html" target="_blank">ISPO AWARD 2013大奖揭晓</a></li>
<li class="normal"><a href="http://bbs.8264.com/thread-1616987-1-1.html" target="_blank">ISPO MUNICH 2013 冰雪产品欣赏</a></li>
                    </ul>
                    <div id="focus_opacity"></div>
                </div>
            </div>
            <!--轮播结束-->
            <div class="title">观展指南</div>
            <table width="307" border="0" cellspacing="0" cellpadding="0" class="gzzn">
                <tr>
                    <td valign="bottom" align="left"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/z1.jpg"/></a></td>
                    <td valign="bottom" align="right"><a href="http://j.map.baidu.com/XIE3" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/z2.jpg"/></a></td>
                </tr>
                <tr>
                    <td valign="bottom" align="left"><a href="http://map.baidu.com/?newmap=1&amp;l=15&amp;tn=B_NORMAL_MAP&amp;c=12957145,4839149&amp;cc=bj&amp;i=-1|-1|-1&amp;s=nb%26c%3D131%26wd%3D%E5%AE%BE%E9%A6%86%26on_gel%3D1%26l%3D15%26gr%3D1%26uid%3D7f507ae588813cb716c8f6c0%26nb_x%3D12957460.53%26nb_y%3D4839137.4&amp;sc=0" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/z3.jpg"/></a></td>
                    <td valign="bottom" align="right"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=144" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/z4.jpg"/></a></td>
                </tr>
                <tr>
                    <td valign="bottom" align="left"><a href="http://www.weather.com.cn/weather/101010100.shtml" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/z5.jpg"/></a></td>
                    <td valign="bottom" align="right"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/z6.jpg"/></a></td>
                </tr>
            </table>
        </div>
        <div class="m1"><a name="n1"></a>
        	<div class="title">焦点关注</div>
            
            <div class="newstoutiao">
                <h3 class="newstitle"><a href="http://www.8264.com/viewnews-83571-page-1.html" target="_blank">北京ISPO圆满落幕 参展品牌数量增长10%</a></h3>
                <p class="newscon">本届展会再次打破多项记录：国家会议中心共迎接27,876名专业观众(+14%)、415家展商(+18%)、567个品牌(+10%)，使用展览面积40,000平米(+ 14%)。也就是说，ISPO BEIJING 2013在各个方面均取得了两位数增长。</p>
<h3 class="newstitle"><a href="http://www.8264.com/viewnews-83470-page-1.html" target="_blank">8264巅峰户外运动学校公益领队培训揭牌</a></h3>
                <p class="newscon">8264携巅峰户外运动学校共同举办的全国公益领队专业培训揭牌仪式今天（2月28日）在ISPO展会现场完美落幕。到场嘉宾和观众二百余人，歌手老狼及众多户外达人出席本次揭牌仪式</p>
            </div>
            <div class="title">展会快讯</div>
            <div class="newslist">
            	<ul>
                    <!--[diy=isponewslist]--><div id="isponewslist" class="area"><div id="frameKusMq7" class=" frame move-span cl frame-1"><div id="frameKusMq7_left" class="column frame-1-c"><div id="frameKusMq7_left_temp" class="move-span temp"></div><?php block_display('6862'); ?></div></div></div><!--[/diy]-->
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <div class="r1">
        	<div class="title"></div>
            <div class="r1con">
            	<div class="darizi">
                    <div class="zhengjishi"><span class="shu"></span></div>
                    <div class="daojishi"><span class="shu"></span></div>
                    <div class="jieshule"></div>
                </div>
                <div class="r1newslist">
                	<ul>
                    	<li><a href="http://beijing.ispo.com.cn/templates_home_article.aspx?classid=928777282620" target="_blank">驴友在线注册预约观展</a></li>
<li><a href="http://www.8264.com/viewnews-83470-page-1.html" target="_blank">8264巅峰户外运动学校揭牌仪式</a></li>
                        <li><a href="http://bbs.8264.com/thread-1619193-1-1.html" target="_blank">第三届8264驴友公益晚宴</a></li>
                        <li><a href="http://bbs.8264.com/thread-1609763-1-1.html" target="_blank">2013 8264户外节合作招募</a></li>
                        <li><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=161" target="_blank">2013 ISPO 运动产业论坛</a></li>
                        

                    </ul>
                </div>
                <div class="r1_logo"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/8264_logo_right.jpg"/></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!--第一模块结束-->
    <!--第三模块开始 互动专区-->
    <div class="mid">
    	<div class="title">互动专区</div><a name="n3"></a>
<div class="fangtan">
          <div class="hudongl">
              <div id="hotttdiv1_2" onmouseover="setttHotph_2(1);"><div id="hotttdiv1_3" class="sheqian"></div></div>
              <div id="hotttdiv2_2" onmouseover="setttHotph_2(2);"><div id="hotttdiv2_3" class="sheqian1"></div></div>
              <div id="hotttdiv3_2" onmouseover="setttHotph_2(3);"><div id="hotttdiv3_3" class="sheqian1"></div></div>
              <div id="hotttdiv4_2" onmouseover="setttHotph_2(4);"><div id="hotttdiv4_3" class="sheqian1"></div></div>
              <div id="hotttdiv5_2" onmouseover="setttHotph_2(5);"><div id="hotttdiv5_3" class="sheqian1"></div></div>
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
          <div class="hudongr" style=" display:;" id="hotttcomment01">
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=160" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/liuxing.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=160" target="_blank">中国运动时尚流行趋势论坛</a><br>地点：E-232会议室<br>时间：2月27日全天<br>&nbsp;</div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=140" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/yataixue.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=140" target="_blank">亚太雪地产业论坛APSC</a><br>地点：会议区M-306A会议室<br>时间：2月28日全天</div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=161" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/chanye.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=161" target="_blank">2013 ISPO 运动产业论坛</a><br>地点：展览区E-232会议室<br>时间：3月1日全天</div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=159" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/lingshoult.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=159" target="_blank">2013 ISPO中国儿童户外发展论坛</a><br>地点：展览区E-231会议室<br>时间：3月1日下午</div>
                  <div style="clear:both;"></div>
              </div>
          </div>
          <div class="hudongr" style=" display:none;" id="hotttcomment02">
              
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://beijing.ispo.com.cn/templates_home_article.aspx?classid=095614625495" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/liuxing.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://beijing.ispo.com.cn/templates_home_article.aspx?classid=095614625495" target="_blank">流行趋势发布区</a><br></div>
                  <div style="clear:both;"></div>
              </div>
          </div>
          <div class="hudongr" style=" display:none;" id="hotttcomment03">

          </div>
          <div class="hudongr" style=" display:none;" id="hotttcomment04">
              <div class="hudongall">
                  <div class="hudongimg"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/jinxiniu.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="#" target="_blank">第七届金犀牛奖颁奖典礼</a><br>&nbsp;<br>&nbsp;<br>&nbsp;</div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=162" target="_blank"><img src="http://beijing.ispo.com.cn/images/news/banff_title.png" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://beijing.ispo.com.cn/templates_detail.aspx?id=162" target="_blank">班夫山地电影节世界巡展中国站推介会</a><br>国家会议中心三层 报告厅<br>3月2日 3:15-5:30</div>
                  <div style="clear:both;"></div>
              </div>
          </div>
          <div class="hudongr" style=" display:none;" id="hotttcomment05">
              <div class="hudongall">
                  <div class="hudongimg"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/hudong/8264.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="#" target="_blank">8264展位欣赏</a><br>地点：B3.103<br>&nbsp;</div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://bbs.8264.com/thread-1619193-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/lvyoujuhui.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://bbs.8264.com/thread-1619193-1-1.html" target="_blank">8264公益爱心晚宴</a><br>地点：B3.103 8264展位集合<br>时间：2月27日18点</div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://bbs.8264.com/thread-1597899-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/hudong/dianfeng.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://bbs.8264.com/thread-1597899-1-1.html" target="_blank">8264·巅峰户外运动学校揭牌仪式</a><br>地点：展会现场T台区<br>时间：2月28日15:30-16:30</div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://www.8264.com/list/880" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/hudong/yong.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://www.8264.com/list/880" target="_blank">8264栏目<br>《勇者先行》</a></div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://www.8264.com/list/842" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2012ispo/images/meiriyitu.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://www.8264.com/list/842" target="_blank">8264栏目<br>《每日一图》</a></div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://www.8264.com/pp" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/hudong/meigui.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://www.8264.com/pp" target="_blank">8264栏目<br>《铿锵玫瑰》</a></div>
                  <div style="clear:both;"></div>
              </div>
              <div class="hudongall">
                  <div class="hudongimg"><a href="http://bbs.8264.com/thread-1609763-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/hudong/luying.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://bbs.8264.com/thread-1609763-1-1.html" target="_blank">8264户外节</a><br>联系人：阿索：13920440860</div>
                  <div style="clear:both;"></div>
              </div>
  <div class="hudongall">
                  <div class="hudongimg"><a href="http://www.8264.com/list/881" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/hudong/xianlu.jpg" width="120" height="80" border="0" /></a></div>
                  <div class="hudongwen"><a href="http://www.8264.com/list/881" target="_blank">8264户外线路推荐</a></div>
                  <div style="clear:both;"></div>
              </div>
          </div>
          <div style="clear:both"></div>
</div>
    </div>
    <!--第三模块结束-->
    <!--第四模块开始  ISPO MUNICH-->
    <div class="mid">
    	<div class="title">ISPO MUNICH 2013 8264现场报道</div>
<div class="mid4">
        	<div class="l4">
            	<a href="http://www.8264.com/viewnews-83024-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013ispo/images/ouzhan.jpg"/></a>
                <p>德国时间2月3日，ISPO MUNICH 2013在一片白雪皑皑中拉开帷幕。在为期4天的展示中，将有来自全球100多个国家和地区的2481家参展商参展（2012年2344家展商），达到历史上最多纪录，展示净面积超过10.3万平米，并且所有展位在展会开始前两月即已全部被预订完毕，ISPO MUNICH当之无愧的全球第一运动展。<a href="http://www.8264.com/viewnews-83024-page-1.html" target="_blank" style="color:#FF0000">[详细报道]</a></p>
            </div>
            <div class="m4">
                <!--[diy=ispo_mgwtw]--><div id="ispo_mgwtw" class="area"><div id="frameyEiwuV" class=" frame move-span cl frame-1"><div id="frameyEiwuV_left" class="column frame-1-c"><div id="frameyEiwuV_left_temp" class="move-span temp"></div><?php block_display('6863'); ?></div></div></div><!--[/diy]-->
                <div class="clear"></div>
            </div>
            <div class="r4">
            	<ul>
                	<!-- 15条<li>&#8226;&nbsp;<a href="#" target="_blank">全国100多个城市，并成为国际露营联合会中国区官方合作品牌，中国汽车露营协会唯一指定用品，装备类产品</a></li>-->
                    <!--[diy=ispo_rgw]--><div id="ispo_rgw" class="area"><div id="frame5DoCl3" class=" frame move-span cl frame-1"><div id="frame5DoCl3_left" class="column frame-1-c"><div id="frame5DoCl3_left_temp" class="move-span temp"></div><?php block_display('6864'); ?></div></div></div><!--[/diy]-->
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--第四模块结束-->
<!--第二模块开始-->
    
    <!--第二模块结束-->
    
    <!--0225第五模块开始  展会装备-->
    <div class="mid">
    	<div class="title">展会装备</div><a name="n5"></a>
        <div class="mid4">
        	<div class="zblunbo">
            	<iframe width="700" scrolling="no" height="270" frameborder="0" marginwidth="0" marginheight="0" src="http://static.8264.com/oldcms/moban/zt/2013ispo/zblunbo.html"></iframe>
            </div>
            <div class="r5">
            	<ul>
                    <!--[diy=ispozblist]--><div id="ispozblist" class="area"><div id="frame2v21TW" class=" frame move-span cl frame-1"><div id="frame2v21TW_left" class="column frame-1-c"><div id="frame2v21TW_left_temp" class="move-span temp"></div><?php block_display('6865'); ?></div></div></div><!--[/diy]-->
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="zbimglist">
            <!--[diy=ispozbimglist]--><div id="ispozbimglist" class="area"><div id="frame4Ph23f" class=" frame move-span cl frame-1"><div id="frame4Ph23f_left" class="column frame-1-c"><div id="frame4Ph23f_left_temp" class="move-span temp"></div><?php block_display('6866'); ?></div></div></div><!--[/diy]-->
            <div class="clear"></div>
        </div>
    </div>
    <!--0225第五模块结束-->
    <!--0225第六模块开始-->
    <div class="mid">
    	<div class="title">展会访谈</div><a name="n4"></a>
        <div class="mid4">
            <!--[diy=ispozfimglist]--><div id="ispozfimglist" class="area"><div id="frameC96TX7" class=" frame move-span cl frame-1"><div id="frameC96TX7_left" class="column frame-1-c"><div id="frameC96TX7_left_temp" class="move-span temp"></div><?php block_display('6867'); ?></div></div></div><!--[/diy]-->
            <div class="clear"></div>
        </div>
    </div>
    <!--0225第六模块结束-->
    <!--0225第七模块开始-->
    <div class="mid">
    	<div class="title">驴友观展</div><a name="n6"></a>
        <div class="mid4">
        	<div class="wybg"></div>
            <div class="wylist">
            	<ul>
                    <!--[diy=ispowylist]--><div id="ispowylist" class="area"><div id="framenxcD6i" class=" frame move-span cl frame-1"><div id="framenxcD6i_left" class="column frame-1-c"><div id="framenxcD6i_left_temp" class="move-span temp"></div><?php block_display('6868'); ?></div></div></div><!--[/diy]-->
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--0225第七模块结束-->
    <!--0225第八模块开始-->
    <div class="mid">
    	<div class="title">展会花絮</div><a name="n8"></a>
        <div class="mid4">
            <div class="conimg" id="de">
                <table width="100%"  cellspacing="0" cellpadding="0">
                    <tr>
                        <td id="de1">
                            <table width="100%"  cellspacing="0" cellpadding="0">
                                <tr>
                                    <!--[diy=hx]--><div id="hx" class="area"><div id="framerB33V7" class=" frame move-span cl frame-1"><div id="framerB33V7_left" class="column frame-1-c"><div id="framerB33V7_left_temp" class="move-span temp"></div><?php block_display('6870'); ?></div></div></div><!--[/diy]--> 
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
                var speed01 = 20 //速度数值越大速度越慢
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
    <!--0225第八模块结束-->
    
    
    
    
</div>
<div class="footer">
<div class="footercon">
<p class="footer_l">8264 版权所有 津ICP备05004140号-10 ICP证 津B2-20110106<br><a href="http://bx.8264.com" target="_blank">户外有风险，8264提醒您购买户外保险</a></p>
    <p class="footer_r"><a target="_blank" href="http://www.8264.com/about-index.html">8264简介</a> | <a target="_blank" href="http://www.8264.com/about-contact.html">联系我们</a> | <a target="_blank" href="http://www.8264.com/about-adservice.html">广告服务</a> | <a target="_blank" href="http://www.8264.com/link/">户外网址大全</a> | <a target="_blank" href="http://www.8264.com/sitemap">网站地图</a></p>
    <div class="clear"></div>
    </div>
</div>
<script src="http://static.8264.com/oldcms/moban/zt/2013ispo/js/common.js" type="text/javascript" type="text/javascript" language="javascript"></script>
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


<!-- 广告位：ispo专题广告 -->
<script type="text/javascript" >BAIDU_CLB_SLOT_ID = "598667";</script>
<script src="http://cbjs.baidu.com/js/o.js" type="text/javascript"></script>


</body>
</html>
