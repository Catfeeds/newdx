<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title>2014年西藏第一届运动大会</title>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/201409xz/style/style.css">
<script src="http://static.8264.com/oldcms/moban/zt/201409xz/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/201409xz/js/jquery.js" type="text/javascript"></script>
</head>

<body>
<div class="branner"></div>
<div class="mid1">
<div class="w980">
<div class="clear_b">
<ul class="titleimg">
<li>
<div class="imgcon"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/t1.jpg"/><span class=" displaynone"></span></div>
</li>
<li>
<div class="imgcon"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/t2.jpg"/><span></span></div>
</li>
<li>
<div class="imgcon"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/t3.jpg"/><span></span></div>
</li>
<li>
<div class="imgcon"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/t4.jpg"/><span></span></div>
</li>
<li>
<div class="imgcon"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/t5.jpg"/><span></span></div>
</li>
<li>
<div class="imgcon"><a href="javascript:void(0)"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/t6.jpg"/></a><span></span></div>
</li>
</ul>
</div>
</div>
</div>
<div class="mid2">
<div class="w980">
<ul class="bigimg">
<li><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/c1.jpg"></li>
<li class="displaynone"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/c2.jpg"></li>
<li class="displaynone"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/c3.jpg"></li>
<li class="displaynone"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/c4.jpg"></li>
<li class="displaynone"><img src="http://static.8264.com/oldcms/moban/zt/201409xz/images/c5.jpg"></li>
</ul>
</div>
<div class="arrow"></div>
</div>
<div class="footer">
<div class="footercon">
<p class="footer_l">8264 版权所有 津ICP备05004140号-10 ICP证 津B2-20110106<br>
<a href="http://bx.8264.com" target="_blank">户外有风险，8264提醒您购买户外保险</a></p>
<p class="footer_r"><a target="_blank" href="http://www.8264.com/about-index.html">8264简介</a> | <a target="_blank" href="http://www.8264.com/about-contact.html">联系我们</a> | <a target="_blank" href="http://www.8264.com/about-adservice.html">广告服务</a> | <a target="_blank" href="http://www.8264.com/link/">户外网址大全</a> | <a target="_blank" href="http://www.8264.com/sitemap">网站地图</a></p>
<div class="clear"></div>
</div>
</div>
<script>

$(function(){
$(".titleimg li").mouseenter(function(){	
$("span",this).addClass("displaynone").parent().parent().siblings().children().children().removeClass("displaynone");
var index = $(this).index();
$(".bigimg li").eq(index).fadeIn().siblings().hide(0);
});	
});
</script>

</body>
</html>
