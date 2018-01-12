<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title>加拿大第五届滑雪时尚发布会</title>
<link type="text/css" rel="stylesheet" href="http://static.8264.com/oldcms/moban/zt/fashion2014/css1.css" />
<script src="http://static.8264.com/oldcms/moban/zt/fashion2014/js/jquery-1.8.0.min.js" type="text/javascript" ></script>
<script src="http://static.8264.com/oldcms/moban/zt/fashion2014/js/jquery.jslides.js" type="text/javascript" ></script>
<script src="http://static.8264.com/oldcms/moban/zt/fashion2014/js/js.js" type="text/javascript"></script>
<script>

window.onload=function(){
var oDiv=document.getElementById('hudong');
var oUl=oDiv.getElementsByTagName('div')[0];
var aLi=oUl.getElementsByTagName('dl');
var spead=-1;
oUl.innerHTML=oUl.innerHTML+oUl.innerHTML;
oUl.style.height=aLi[0].offsetHeight*aLi.length+'px';
function move(){
if(oUl.offsetTop>0){
oUl.style.top=-oUl.offsetHeight/2+'px';
}
if(oUl.offsetTop<-oUl.offsetHeight/2){
oUl.style.top='0';
}

oUl.style.top=oUl.offsetTop+parseInt(spead)+'px';
}
timer=setInterval(move,30)
oDiv.onmouseover=function(){
clearInterval(timer);
}
oDiv.onmouseout=function(){
timer=setInterval(move,30)
}


}


</script>
</head>

<body>
<div class="nav_bg clearfix">
<div class="nav_box">
<ul class="nav clearfix">
<li><a target="_blank" class="nav_active" href="http://www.nanshanski.com/web_cn/content.asp?id=489">首页</a></li>
<li class="li_posi"><a target="_blank" href="http://www.nanshanski.com/web_cn/content.asp?id=563">参赛须知</a><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/baoming_03.png"></li>
<li><a target="_blank" href="http://www.nanshanski.com/web_cn/content.asp?id=319">赛事规则</a></li>
<li><a target="_blank" href="http://www.nanshanski.com/web_cn/content.asp?id=562">日程安排</a></li>
<li><a target="_blank" href="http://www.nanshanski.com/web_cn/content.asp?id=564">奖项设置</a></li>
<li><a target="_blank" href="http://www.nanshanski.com/web_cn/content.asp?id=570">加拿大滑雪</a></li>
<li><a target="_blank" href="http://www.nanshanski.com/web_cn/picture.Asp?ID=36">往期赛事</a></li>
<li><a target="_blank" href="http://www.nanshanski.com/web_cn/content.asp?id=566">历届国际裁判</a></li>
<li><a target="_blank" href="http://www.nanshanski.com/web_cn/content_huodong.asp?id=275">其它活动</a></li>
</ul>
<div class="back">
<a href="http://www.nanshanski.com/">返回南山滑雪官网</a>
</div>
</div>
</div>	
<div id="full-screen-slider">
<ul id="slides">
<li style="background:url('http://static.8264.com/oldcms/moban/zt/fashion2014/images/bannner1_02.jpg') no-repeat center center"><a href=" http://www.nanshanski.com/web_cn/content.asp?id=561" target="_blank"></a></li>
<li style="background:url('http://static.8264.com/oldcms/moban/zt/fashion2014/images/banner_two_02.jpg') no-repeat center center"><a href="http://www.nanshanski.com/web_cn/content.asp?id=570" target="_blank"></a></li>
<li style="background:url('http://static.8264.com/oldcms/moban/zt/fashion2014/images/banner2_02.jpg') no-repeat center center"><a href="http://www.nanshanski.com/web_cn/content.asp?id=562" target="_blank"></a></li>

</ul>
</div>
<div class="summary active_news clear " id="active_news">
<div class="nav_box">
<h1><img  src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/event_news_03.jpg"/></h1>
<p class="more_information"><a href="http://www.nanshanski.com/web_cn/content.asp?id=576" target="_blank">更多活动资讯</a></p>
<ul class="information_pic clearfix">
<li><a href="http://www.nanshanski.com/web_cn/content.asp?id=561" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/info_pic1_05.jpg"></a></li>
<li><a href="http://www.nanshanski.com/web_cn/content.asp?id=563" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/info_pic2_10.jpg"></a></li>
<li><a href="http://www.nanshanski.com/web_cn/content.asp?id=568" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/info_pic3_12.jpg"></a></li>
<li style="margin: 0;"><a href="http://www.nanshanski.com/web_cn/content.asp?id=571" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/info_pic4_11.jpg"></a></li>
</ul>
</div>

</div>
<div class="summary " id="jindu">
<div class="nav_box">
<h1><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jindu_title_14.jpg"/></h1>
<p class="jindu"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jindu_10.jpg"></p>
</div>
</div>
<div class="summary clear" id="jingcai">
<div class="nav_box">
<h1><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jingcai_title_03.jpg"/></h1>
<p>
<p class="shipin"><embed style="margin: 33px 0 0 241px;" src="http://www.tudou.com/v/1jGyxJrVJ4E/&resourceId=0_04_05_99/v.swf" target="_blank" width="700" height="411"></embed></p>
<a href="http://www.nanshanski.com/web_cn/content.asp?id=474" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/tuji_title_22.jpg"></a>
<a href="http://www.nanshanski.com/web_cn/content.asp?id=474" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jingcai_pic1_23.jpg" /></a>
<a href="http://www.nanshanski.com/web_cn/content.asp?id=474" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jingcai_pic1_03.jpg" /></a>
<a href="http://www.nanshanski.com/web_cn/content.asp?id=474" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jingcai_pic2_03.jpg" /></a>
<a href="http://www.nanshanski.com/web_cn/content.asp?id=474" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jingcai_pic3_05.jpg" /></a>
</p>
</div>
</div>
<div class="summary clear" id="jiangpin">
<div class="nav_box">
<h1><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jingpin_title_30.jpg"/></h1>
<p class="clearfix">
<a class="fl"  href="http://www.nanshanski.com/web_cn/content.asp?id=564" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jp_pic1_15.jpg" /></a>
<a class="fl"  href="http://www.nanshanski.com/web_cn/content.asp?id=564" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jp_pic2_16.jpg" /></a>
</p>
</div>
</div>
<div class="jianada clear" id="jianada">
<div class="nav_box">
<h1><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jianada_29.png"/></h1>
<div class="clearfix jianada_dl">
<dl>
<dt><a href="http://www.nanshanski.com/web_cn/content.asp?id=570" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jnd_pic1_32.png"></a></dt>
</dl>
<dl>
<dt><a href="http://www.nanshanski.com/web_cn/content.asp?id=570" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jnd_pic2_34.png"></a></dt>
</dl>
<dl class="last_dl">
<dt><a href="http://www.nanshanski.com/web_cn/content.asp?id=570" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jnd_pic3_36.png"></a></dt>
</dl>
<dl>
<dt><a href="http://www.nanshanski.com/web_cn/content.asp?id=570" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jnd_pic4_41.png"></a></dt>
</dl>
<dl>
<dt><a href="http://www.nanshanski.com/web_cn/content.asp?id=570" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jnd_pic5_42.png"></a></dt>
</dl>
<dl class="last_dl">
<dt><a href="http://www.nanshanski.com/web_cn/content.asp?id=570" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/jnd_pic6_43.png"></a></dt>
</dl>
</div>
</div>
</div>
<div class="summary " id="good_people">
<div class="nav_box">
<h1><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/caipan_title_18.jpg"/></h1>
<ul class="last_people clearfix">
<li><a href="http://www.nanshanski.com/web_cn/content.asp?id=332" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/good_pic1_37.jpg"></a></li>
<li style="margin-top: 140px;"><a href="http://www.nanshanski.com/web_cn/content.asp?id=388" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/good_pic2_43.jpg"></a></li>
<li><a href="http://www.nanshanski.com/web_cn/content.asp?id=465" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/good_pic3_39.jpg"></a></li>
<li style="margin-top: 140px;"><a href="http://www.nanshanski.com/web_cn/content.asp?id=463" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/good_pic4_46.jpg"></a></li>
<li><a href="http://www.nanshanski.com/web_cn/content.asp?id=575" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/good_pic5_41.jpg"></a></li>
</ul>
<p style="padding-bottom: 70px;"> 
<a style="margin-left: 213px;" target="_blank" href="http://www.nanshanski.com/web_cn/picture.Asp?ID=36"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/btn1_35.jpg"></a>
<a style="margin-left: 233px;" target="_blank" href="http://www.nanshanski.com/web_cn/content.asp?id=458"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/btn2_37.jpg"></a>	
</p>
</div>
</div>
<div class="summary " id="other_active">
<div class="nav_box">
<h1><a href="http://www.nanshanski.com/web_cn/content_huodong.asp?id=275" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/active_title_68.jpg"/></a></h1>
<ul class="clearfix">
<li><a target="_blank" href="http://www.nanshanski.com/web_cn/Content_zixun.Asp?ID=578"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/other_pic1_72.jpg"></a></li>
<li><a target="_blank" href="http://www.nanshanski.com/web_cn/content.asp?id=567"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/other_pic2_74.jpg"></a></li>
<li style="margin-right: 0;"><a target="_blank" href="http://www.nanshanski.com/web_cn/Content_zixun.Asp?ID=577"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/other_pic3_76.jpg"></a></li>
</ul>
</div>
</div>
<div class="hezuo" id="hezuo">
<div class="nav_box">
<h1><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/hezuo_title_70.jpg"/></h1>
<ul class="clearfix">
<li><a target="_blank" href="http://zh-keepexploring.canada.travel"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/logo_84.jpg"></a></li>
<li><a target="_blank" href="http://www.hellobc.com.cn/"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/logo_86.jpg"></a></li>
<li><a target="_blank" href="http://www.toread.com.cn"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/logo_88.jpg"></a></li>
<li><a target="_blank" href="http://www.sino-aee.com"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/logo_90.jpg"></a></li>
<li style="margin-right: 0;"><a target="_blank" href="http://www.nanshanski.com/web_cn/htc/"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/logo_92.jpg"></a></li>
<li><a target="_blank" href="http://www.reima.com.cn/"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/logo_99.jpg"></a></li>
<li><a target="_blank" href="http://www.skier.com.cn/"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/logo_100.jpg"></a></li>
<li><a target="_blank" href="http://www.elansports.com/pc.asp"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/logo_101.jpg"></a></li>
<li><a target="_blank" href="http://www.nordica.com/china/"><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/logo_102.jpg"></a></li>
</ul>
</div>
</div>
<div class="footer_bg">
<div class="nav_box">
<p><a href="http://www.nanshanski.com/web_cn/Content_guanyu.Asp?ID=20">雪场简介</a>|<a href="http://www.nanshanski.com/web_cn/Content_guanyu.Asp?ID=52">招聘信息</a>|<a href="http://www.nanshanski.com/web_cn/Content_guanyu.Asp?ID=228">合作伙伴</a>|<a href="http://www.nanshanski.com/web_cn/Content_guanyu.Asp?ID=53">友情链接</a>|<a href="http://www.nanshanski.com/web_cn/Content_guanyu.Asp?ID=54">联系我们 </a>|<a href="http://www.nanshanski.com/web_cn/Content_zhoubian.Asp?ID=269">滑雪者的行为准则</a></p>
<p>Copyright 2008 北京南山滑雪滑水度假村有限公司 版权所有 南山滑雪预定：010-89091909?????活动咨询：010-84411182</p>
</div>
</div>
<dl class="fix">
<dt><img src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/right_weixin_03.jpg" width="110"></dt>
<dd><a href="#active_news">活动新闻</a></dd>
<dd><a href="#jindu">活动进度</a></dd>
<dd><a href="#jingcai">现场精彩</a></dd>
<dd><a href="#jiangpin">活动奖品</a></dd>
<dd><a href="#jianada">加拿大风情</a></dd>
<dd><a href="#good_people">国际裁判</a></dd>
<dd><a href="#other_active">其他活动</a></dd>
<dd><a class="lasta" href="#hezuo">合作伙伴</a></dd
><dd style="border: none; background: none;"><img width="112px" src="http://static.8264.com/oldcms/moban/zt/fashion2014/images/fix_18.png"></dd>
</dl>


</body>
</html>
