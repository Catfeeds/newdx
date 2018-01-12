<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title>ISPO SHANGHAI 2015时尚运动展</title>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/201505ispo/style/style.css">
<script src="http://static.8264.com/oldcms/moban/zt/201505ispo/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/201505ispo/js/jquery.js" type="text/javascript"></script>
</head>

<body>
<div class="branner"></div>
<div class="warpten">
<div class="clear_b pt55">
<div class="helpbox">
<a href="http://www.ispo.com.cn/page/c22JSzJ/shanghai/Visitor/Arrival-Accomodation/Hotel.html" class="icon1"></a>
<a href="http://www.ispo.com.cn/page/52bJ2DR/shanghai/Visitor/Opening-Hours-And-Location.html" class="icon2"></a>
<a href="http://www.ispo.com.cn/page/52bJSzK/shanghai/Visitor/Arrival-Accomodation/traffic.html" class="icon3"></a>
<a href="#" class="icon4"></a>
</div>
<div class="newslistcon">
<script type="text/javascript" charset="utf-8">
// 调取新闻头条数据
jQuery(function ($) {
$.getJSON("http://www.8264.com/api/blockdata.php?bid=4", function(data){	
var enterbox =$("#news_top_con");
$.each(data, function(i,item){
var content = '<a href="  '+ item.url +' " target="_blank" class="newstop">'+ item.title +'</a><p>'+ item.description +'</p>';
enterbox.append(content);
if ( i == 0 ) return false;
});
});
});
</script>
<div class="newstopcon" id="news_top_con">

</div>
<script type="text/javascript" charset="utf-8">
// 调取新闻头条数据
jQuery(function ($) {
$.getJSON("http://www.8264.com/api/blockdata.php?bid=3", function(data){	
var enterbox =$("#newslist_con");
$.each(data, function(i,item){
var content = '<li><a href="  '+ item.url +' " target="_blank"> '+ item.title +' </a><span> '+ item.showdate +' </span></li>';
enterbox.append(content);
if ( i == 5 ) return false;
});
});
});
</script>
<div class="newslist">
<ul id="newslist_con">

</ul>
</div>
</div>
<div class="newsrightcon">
<div class="newrightimg"><a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/newsimg.jpg"/></a></div>
<script type="text/javascript" charset="utf-8">
// 调取新闻头条数据
jQuery(function ($) {
$.getJSON("http://www.8264.com/api/blockdata.php?bid=5", function(data){	
var enterbox =$("#newslist_right");
$.each(data, function(i,item){
var content = '<li><a href="  '+ item.url +' " target="_blank"> '+ item.title +' </a></li>';
enterbox.append(content);
if ( i == 5 ) return false;
});
});
});
</script>
<div class="newsrightlist">
<ul id="newslist_right">
</ul>
</div>
</div>
</div>
<div class="title"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/title1.jpg"/></div>
<div class="titles"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/titles1.jpg"/></div>
<table width="0" border="0" cellspacing="0" cellpadding="0" class="meettable">
<tbody>
<tr>
<td rowspan="3" class="meetimg"><a href="http://www.ispo.com.cn/forum/detail/e0cJ/aa8OW.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/water.jpg"/><span class="bluebgb"></span><span class="wenzi"></span></a></td>
<th>时间</th>
<th>主题</th>
<th>演讲嘉宾</th>
</tr>
<tr>
<td>2015年07月02日<br>15:00-16:00</td>
<td>桨板运动的世界：皮划艇的人生境遇</td>
<td>
<b>Nigel Foster</b><br>
英国国家独木舟委员会（BCU）教练，首个最<br>
年轻的完成环冰岛的划桨者。<br>
</td>
</tr>
<tr>
<td>2015年07月03日<br>
10:00-11:00</td>
<td>农场生活姿态：打造你的划桨运动生意 </td>
<td>
<b>Darren Bush</b><br>
Rutabaga Paddlesports公司 总裁<br>
美国户外行业协会(OIA)理事会成员。<br>
</td>
</tr>
</tbody>
</table>
<div class="titles"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/titles2.jpg"/></div>
<div class="xmlist clear_b">
<ul>
<li><a href="http://www.ispo.com.cn/page/354JSwN/shanghai/Exhibitor/water-sports.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/m1.jpg"><em class="bluebg"></em><span>ISPO SHANGHAI<br>水上专区</span></a></li>
<li><a href="http://www.ispo.com.cn/page/834JSwO/shanghai/Exhibitor/City-Fitness.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/m2.jpg"><em class="bluebg"></em><span>ISPO SHANGHAI<br>城市健身</span></a></li>
<li><a href="http://www.ispo.com.cn/page/f44JSwQ/shanghai/Exhibitor/ACTION-SPORTS.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/m3.jpg"><em class="bluebg"></em><span>ISPO SHANGHAI<br>极限潮流专区</span></a></li>
</ul>
</div>
<div class="titles"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/titles3.jpg"/></div>
<div class="actlist clear_b">
<ul>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/5a3OV.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/act1.jpg"/>
<i class="bluebgb"></i>
<em class="redbg">总活动</em>
<span>Open demo day体验日<br><i>2015年07月05日</i></span>
</a>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/612OU.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/act2.jpg"/>
<i class="bluebgb"></i>
<em class="bluebg">水上专区</em>
<span>水上走扁带大赛<br><i>地点：N1馆水上运动展区ISPO SHANGHAI室内水池</i></span>
</a>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/5f0OT.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/act4.jpg"/>
<i class="bluebgb"></i>
<em class="bluebg">水上专区</em>
<span>花式皮划艇表演<br><i>地点：N1馆水上运动展区ISPO SHANGHAI室内水池</i></span>
</a>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/41fOS.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/act3.jpg"/>
<i class="bluebgb"></i>
<em class="bluebg">水上专区</em>
<span>水上瑜伽表演<br><i>地点：N1馆水上运动展区ISPO SHANGHAI室内水池</i></span>
</a>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/1f5OY.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/act7.jpg"/>
<i class="bluebgb"></i>
<em class="greenbg">健身专区</em>
<span>中国国际健身大会<br><i>2015年07月02日-04日</i></span>
</a>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/068OX.html" target="_blank">
<img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/act6.jpg"/>
<i class="bluebgb"></i>
<em class="yellowbg">极限潮流</em>
<span>ISPO全国青少年旱地冰球俱乐部冠军赛<br><i>2015年07月02日-04日</i></span>
</a>
</li>
</ul>
</div>
<!--新模块开始-->
<div class="title"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/title5.jpg"/></div>
<div class="zbtitlebq">
<a href="http://www.8264.com/viewnews-101494-page-1.html" target="_blank" class="hover">健身跑步</a>
<a href="http://www.8264.com/viewnews-101501-page-1.html" target="_blank">水上运动</a>
<a href="http://www.8264.com/viewnews-101504-page-1.html" target="_blank">运动潮流</a>
</div>
<div id="zblistbq">
<div class="eqlist clear_b">
<ul>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img1.jpg"/>
<span class="name">骨传导蓝牙耳机</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img2.jpg"/>
<span class="name">2XU 超薄运动上衣</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img3.jpg"/>
<span class="name">Smartwool PhD功能性跑步袜</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img4.jpg"/>
<span class="name">ZERO RUNNER无冲击跑步机</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img5.jpg"/>
<span class="name">巍得健身Core Stix</span>
</a>
</li>
</ul>
</div>
<div class="eqlist clear_b" style="display:none;">
<ul>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img6.jpg"/>
<span class="name">Clipper旅行者级独木舟</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img7.jpg"/>
<span class="name">IPX8级多功能防水游泳MP3</span>
</a>
</li>
</ul>
</div>
<div class="eqlist clear_b" style="display:none;">
<ul>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img8.jpg"/>
<span class="name">Chaco凉鞋</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img9.jpg"/>
<span class="name">CHUMS 潮款棉竹T裇</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img10.jpg"/>
<span class="name">G-form护具</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img11.jpg"/>
<span class="name">THETHING工装铺棉外套</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img12.jpg"/>
<span class="name">Ipanema 人字拖</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img13.jpg"/>
<span class="name">OUTDOOR TECH大龟壳</span>
</a>
</li>
</ul>
</div>
</div>
<div class="titlefont"><a href="http://www.8264.com/viewnews-101518-page-1.html" target="_blank">户外装备</a></div>
<div class="eqlist clear_b">
<ul>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img14.jpg"/>
<span class="name">Halo徒步背包</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img15.jpg"/>
<span class="name">CamelBak单水瓶运动腰包</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img16.jpg"/>
<span class="name">飞游35L专业登山包</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img17.jpg"/>
<span class="name">Hardbone天山背包</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img18.jpg"/>
<span class="name">Pacsafe露营包</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img19.jpg"/>
<span class="name">ULVANG 高科技羊毛袜</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img20.jpg"/>
<span class="name">山拓SANTO速干帽</span>

</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img21.jpg"/>
<span class="name">Mechanix手套</span>
</a>
</li>
<li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img22.jpg"/>
<span class="name">Marmot超级云母外套</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img23.jpg"/>
<span class="name">TITTALLON滑雪衣</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img24.jpg"/>
<span class="name">小驴安蒂儿童弹力冲锋衣</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img25.jpg"/>
<span class="name">ESGUARD女款超透气外套</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img26.jpg"/>
<span class="name">LP压缩衣</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img27.jpg"/>
<span class="name">Fjallraven High Coast</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img28.jpg"/>
<span class="name">Alocs套锅</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img29.jpg"/>
<span class="name">Dome安全带</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img30.jpg"/>
<span class="name">安逸派 家庭营帐篷</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img31.jpg"/>
<span class="name">Humangear便利软管瓶</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img32.jpg"/>
<span class="name">Jetboil 集体炊事系统</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img33.jpg"/>
<span class="name">Sea to Summit充气睡垫</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img34.jpg"/>
<span class="name">EGOMAN手持GPS</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img35.jpg"/>
<span class="name">Fenix口袋小直PD25</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img36.jpg"/>
<span class="name">ForeamX1</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img37.jpg"/>
<span class="name">纳丽德手电</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img38.jpg"/>
<span class="name">Steiner望远镜</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img39.jpg"/>
<span class="name">Turning Point户外铁锹</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img40.jpg"/>
<span class="name">攻蚁"光棱"旋转营灯</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img41.jpg"/>
<span class="name">印第安帐篷</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img42.jpg"/>
<span class="name">恒星X2 一体炉</span>
</a>
</li>
            <li>
<a><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img43.jpg"/>
<span class="name">奈特科尔EC4S</span>
</a>
</li>
</ul>
</div>
<!--新模块结束-->	
<div class="title" style="display:none;"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/title2.jpg"/></div>
<div class="clear_b mt30" style="display:none;">
<div class="lunbobig">
<ul class="lunbobigimg">
<li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img1.jpg"></a><span>1背包大师Gregory创始人Wayne ISPO现场讲解</span></li>
<li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img1.jpg"></a><span>2背包大师Gregory创始人Wayne ISPO现场讲解</span></li>
<li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img1.jpg"></a><span>3背包大师Gregory创始人Wayne ISPO现场讲解</span></li>
<li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img1.jpg"></a><span>4背包大师Gregory创始人Wayne ISPO现场讲解</span></li>
<li><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/img1.jpg"></a><span>5背包大师Gregory创始人Wayne ISPO现场讲解</span></li>
</ul>
</div>
<div class="newsrightcon" style="width:275px;">
<div class="newsrightlist" style="padding-top:0px;">
<script type="text/javascript" charset="utf-8">
// 调取新闻头条数据
jQuery(function ($) {
$.getJSON("http://www.8264.com/api/blockdata.php?bid=6", function(data){	
var enterbox =$("#zbnews");
$.each(data, function(i,item){
var content = '<li><a href="  '+ item.url +' " target="_blank"> '+ item.title +' </a></li>';
enterbox.append(content);
if ( i == 7 ) return false;
});
});
});
</script>
<ul id="zbnews">
</ul>
</div>
</div>
</div>
<div class="eqlist clear_b" style="display:none;">
<script type="text/javascript" charset="utf-8">
// 调取新闻头条数据
jQuery(function ($) {
$.getJSON("http://www.8264.com/api/blockdata.php?bid=7", function(data){	
var enterbox =$("#zbimglist");
$.each(data, function(i,item){
var content = '<li><a href=" '+ item.url +' " target="_blank"><img src=" ' + item.showimg + '"/><span class="name">'+ item.title +' </span></a></li>';
enterbox.append(content);
if ( i == 9 ) return false;
});
});
});
</script>
<ul id="zbimglist">
</ul>
</div>
<div class="title" style="display:none;"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/title3.jpg"/></div>
<div class="fangtanlist clear_b mt30" style="display:none;">
<script type="text/javascript" charset="utf-8">
// 调取新闻头条数据
jQuery(function ($) {
$.getJSON("http://www.8264.com/api/blockdata.php?bid=8", function(data){
var enterbox =$("#ftimglist");
$.each(data, function(i,item){
var content = '<li><div class="ftimg"><a href=" '+ item.url +' " target="_blank"><img src=" ' + item.showimg + ' "/></a><span></span></div><a href="'+ item.url +'" class="name">'+ item.title +'</a></li>';
enterbox.append(content);
if ( i == 30 ) return false;
});
});
});
</script>
<ul id="ftimglist">
</ul>
</div>
</div>
<div class="footer">
<div class="footercon clear_b">
<p class="footer_l">8264 版权所有 津ICP备05004140号-10 ICP证 津B2-20110106<br>
<a href="http://bx.8264.com" target="_blank">户外有风险，8264提醒您购买户外保险</a></p>
<p class="footer_r"><a target="_blank" href="http://www.8264.com/about-index.html">8264简介</a> | <a target="_blank" href="http://www.8264.com/about-contact.html">联系我们</a> | <a target="_blank" href="http://www.8264.com/about-adservice.html">广告服务</a> | <a target="_blank" href="http://www.8264.com/link/">户外网址大全</a> | <a target="_blank" href="http://www.8264.com/sitemap">网站地图</a></p>
</div>
</div>

<div class="adfd">
<div class="adfd980">
<div class="close"></div>
<div class="ewm"><img src="http://static.8264.com/oldcms/moban/zt/201505ispo/images/ewm.jpg"/></div>
<a href="http://app.zaiwai.com/android_download" target="_blank" class="android"></a>
<a href="https://itunes.apple.com/cn/app/zai-wai/id942808722?mt=8" target="_blank" class="apple"></a>
</div>
</div>
</body>
</html>
