<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title>2014�����ص�һ���˶����</title>
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
<p class="footer_l">8264 ��Ȩ���� ��ICP��05004140��-10 ICP֤ ��B2-20110106<br>
<a href="http://bx.8264.com" target="_blank">�����з��գ�8264�����������Ᵽ��</a></p>
<p class="footer_r"><a target="_blank" href="http://www.8264.com/about-index.html">8264���</a> | <a target="_blank" href="http://www.8264.com/about-contact.html">��ϵ����</a> | <a target="_blank" href="http://www.8264.com/about-adservice.html">������</a> | <a target="_blank" href="http://www.8264.com/link/">������ַ��ȫ</a> | <a target="_blank" href="http://www.8264.com/sitemap">��վ��ͼ</a></p>
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
