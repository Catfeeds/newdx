<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title>ISPO BEIJING 2015时尚运动展</title>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/201412ispo/style/style.css">
<script src="http://static.8264.com/oldcms/moban/zt/201412ispo/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/201412ispo/js/jquery.js" type="text/javascript" type="text/javascript"></script>
</head>

<body>
<div class="branner"></div>
<div class="fg"></div>
<div class="nav">
<div class="navcon">
<a href="javascript:void(0)">8264首页</a>
/
<a href="javascript:void(0)">展会动态</a>
/
<a href="javascript:void(0)">展会地图</a>
/
<a href="javascript:void(0)">互动专区</a> 
/
<a href="javascript:void(0)">专访</a>
/
<a href="javascript:void(0)">新品</a>
/
<a href="javascript:void(0)">历届回顾</a>
</div>
</div>
<div class="warpten">
<div class="clear_b mt25">
<!--轮播开始-->
<div class="lunbocon">
<ul class="lunboimg">
<li><a><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/l1.jpg"></a></li>
<li><a><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/l2.jpg"></a></li>
<li><a><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/l3.jpg"></a></li>
</ul>
</div>
<!--轮播结束-->
<!--新闻开始-->
<div class="newslistcon">
<script type="text/javascript" charset="utf-8">
// 调取新闻头条数据
jQuery(function ($) {
$.getJSON("http://www.8264.com/api/blockdata.php?bid=1", function(data){	
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
$.getJSON("http://www.8264.com/api/blockdata.php?bid=2", function(data){	
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
<!--新闻结束-->
<div class="newsrightcon">
<div class="newrightimg"><a><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/newsimg.jpg"/></a></div>
<div class="newsrightlist">
<ul>
<li><a href="http://www.8264.com/viewnews-97747-page-1.html" target="_blank">引爆运动指数ISPO 2015新品提前看</a></li>
<li><a href="http://www.8264.com/viewnews-97748-page-1.html" target="_blank">ISPO BEIJING跑步区之跑者看产业</a></li>
<li><a href="http://www.8264.com/viewnews-97750-page-1.html" target="_blank">SHANGHAI对话5位时尚圈运动达人</a></li>
<li><a href="http://www.8264.com/viewnews-97276-page-1.html" target="_blank">EOG秘书长Mark Held先生及会长Rolfschmid</a></li>
<li><a href="http://www.8264.com/viewnews-92848-page-1.html" target="_blank">ISPO北京2015举办提至1月慕尼黑之前</a></li>
<li><a href="http://www.8264.com/viewnews-97499-page-1.html" target="_blank">2015 BRANDNEW大奖50强名单公布</a></li>
</ul>
</div>
</div>
</div>
<div class="helpwarpten clear_b">
<ul>
<li><a href="http://www.ispo.com.cn/page/04aJ2zP/beijing/VISITORS/OPENING-HOURS-AND-LOCATION.html" target="_blank"class="first">日程</a></li>
<li><a href="http://www.ispo.com.cn/page/994J2zQ/beijing/VISITORS/Arrival-Accomodation.html" target="_blank"class="second">住宿</a></li>
<li><a href="http://www.weather.com.cn/weather/101010100.shtml" target="_blank"class="third">天气</a></li>
<li><a href="http://www.dianping.com/mylist/1328049" target="_blank"class="fourth">餐饮</a></li>
<li><a href="http://www.ispo.com.cn/page/04aJ2zP/beijing/VISITORS/OPENING-HOURS-AND-LOCATION.html" target="_blank"class="fifth">交通</a></li>
<li><a href="http://www.ispo.com.cn/page/dbcJ2DM/beijing/Media/Download.html" target="_blank"class="sixth">下载</a></li>
</ul>
</div>
<div class="mt30">
<div class="title">互动专区</div>
<div class="booktitle">
<span class="hover">会议</span>
<span>专区</span>
<span>活动</span>
</div>
<div id="action">
<!--会议开始-->
<div class="actionlist clear_b">
<ul>
<li>
  <a href="http://www.ispo.com.cn/forum/detail/e0cJ/212L1.html" target="_blank" class="img294"> <img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img7.jpg"> <span>中国民间攀岩高峰论坛</span> </a>
  <div class="info">
<span>28<br>1月</span>
<p>
<em class="weizhi">国家会议中心 三层会议区 会议室</em>
<em class="date">2015.1.28   14:00pm-15:55pm</em>							</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/e0cJ/6d9Q.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img5.jpg">
<span>亚太雪地产业论坛</span>						</a>
<div class="info">
<span>
<span>29<br>1月</span>							</span>
<p>
<em class="weizhi">会议区M-306B会议室</em>
<em class="date">09:30am-12:00am</em>							</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/e0cJ/0e1JU.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img8.jpg">
<span>中国运动时尚流行趋势论坛</span>						</a>
<div class="info">
<span>
<span>29<br>1月</span>							</span>
<p>
<em class="weizhi">会议区M-307会议室</em>
<em class="date">13:15pm-16:20pm</em>							</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/e0cJ/656JV.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img6.jpg">
<span>ISPO运动产业论坛</span>						</a>
<div class="info">
<span>
<span>30<br>1月</span>							</span>
<p>
<em class="weizhi">会议区M-307会议室</em>
<em class="date">09:25am-16:15pm</em>							</p>
</div>
</li>
</ul>
  </div>
<!--会议结束-->
<!--专区开始-->
<div class="actionlist clear_b" style="display:none;">
<ul>
<li>
<a href="http://www.ispo.com.cn/news/detail/58cJWzL.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img9.jpg">
<span>功能性纺织品流行趋势发布区</span>
</a>
<div class="info">
<span>全<br>天</span>
<p>
<em class="weizhi">4.316展位</em>
<em class="date">2015.1.28-2015.1.31</em>
</p>
</div>
</li>
<li>
<a href="http://award.ispo.com/en/Winner-2015/Winner-2015.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img10.jpg">
<span>ISPO AWARD 2015 获奖产品展示区</span>
</a>
<div class="info">
<span>全<br>天</span>
<p>
<em class="weizhi">2.219展位</em>
<em class="date">2015.1.28-2015.1.31</em>
</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/forum_list/36eL/b04J2EN.html#forum_9b8LY" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img11.jpg">
<span>ISPO 帐篷展区</span>
</a>
<div class="info">
<span>全<br>天</span>
<p>
<em class="weizhi">会议区M-311会议室</em>
<em class="date">2015.1.28-2015.1.31</em>
</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/news/detail/f09JXwQ" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img12.jpg">
<span>跑步区亮相 ISPO BEIJING 2015</span>
</a>
<div class="info">
<span>全<br>天</span>
<p>
<em class="weizhi">B1.102展位</em>
<em class="date">2015.1.28-2015.1.31</em>
</p>
</div>
</li>					
</ul>
</div>
<!--专区结束-->
<!--活动开始-->
<div class="actionlist clear_b" style="display:none;">
<ul>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/d6eJW.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img13.jpg">
<span>ISPO BEIJING 2015 新闻发布会</span>
</a>
<div class="info">
<span>
<i class="day">27</i>
<em class="mouth">1月</em>
</span>
<p>
<em class="weizhi">会议区M-301议室</em>
<em class="date">15:00pm-17:00pm</em>
</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/070JX.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img14.jpg">
<span>ISPO BEIJING 2015 开幕式</span>
</a>
<div class="info">
<span>
<i class="day">28</i>
<em class="mouth">1月</em>
</span>
<p>
<em class="weizhi">会议区三层观景平台 舞台区</em>
<em class="date">10:00am-10:30am</em>
</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/441LT.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img15.jpg">
<span>LOWA "中国十周年"品牌发布会</span>
</a>
<div class="info">
<span>
<i class="day">28</i>
<em class="mouth">1月</em>
</span>
<p>
<em class="weizhi">会议区三层观景平台 舞台区</em>
<em class="date">11:00am- 13:00pm</em>
</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/news/detail/18eJXwP" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img16.jpg">
<span>ISPO AWARD 亚洲产品奖颁奖典礼</span>
</a>
<div class="info">
<span>
<i class="day">28</i>
<em class="mouth">1月</em>
</span>
<p>
<em class="weizhi">会议区三层观景平台 舞台区</em>
<em class="date">13:30pm- 14:00pm</em>
</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/news/detail/78dJWDS.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img17.jpg">
<span>中国户外年度金犀牛奖颁奖典礼</span>
</a>
<div class="info">
<span>
<i class="day">29</i>
<em class="mouth">1月</em>
</span>
<p>
<em class="weizhi">会议区 多功能A厅</em>
<em class="date">17:00pm- 19:00pm</em>
</p>
</div>
</li>
<li>
<a href="http://www.ispo.com.cn/forum/detail/ed3K/664LX.html" target="_blank" class="img294">
<img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/img18.jpg">
<span>极限运动艺术展</span>
</a>
<div class="info">
<span>
<i class="day">天</i>
<em class="mouth">全</em>
</span>
<p>
<em class="weizhi">B2.226展位, 极限运动展区</em>
<em class="date">2015.1.28-2015.1.31</em>
</p>
</div>
</li>
</ul>
</div>
<!--活动结束-->
</div>
</div>
<div class="mt30">
<div class="title">展会装备</div>
<div class="clear_b mt30">
<div class="lunbobig">
<ul class="lunbobigimg">
<li><a href="http://www.8264.com/viewnews-98938-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/lb1.jpg"></a><span>CC营地灯全面升级 山力士携Maogear精彩亮相</span></li>
<li><a href="http://www.8264.com/viewnews-98902-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/lb2.jpg"></a><span>全球产品年度大奖-LASPORTIVA Batura</span></li>
<li><a href="http://www.8264.com/viewnews-98903-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/lb3.jpg"></a><span> 2015 ISPO 亚洲产品金奖-探路者极地工靴</span></li>
<li><a href="http://www.8264.com/viewnews-98876-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/lb4.jpg"></a><span>ISPO金奖：Fjallraven Expedition Down Parka No.1</span></li>
<li><a href="http://www.8264.com/viewnews-98875-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/lb5.jpg"></a><span>一双不用手穿的鞋 Treksta Hands Free 103 GTX</span></li>
</ul>
</div>
<div class="newsrightcon" style="width:275px;">
<div class="newsrightlist" style="padding-top:0px;">
<ul>
<li><a href="http://www.8264.com/viewnews-98947-page-1.html" target="_blank">2015北京ISPO展 纳丽德精彩不断上演闪耀全场</a></li>
<li><a href="http://www.8264.com/viewnews-98907-page-1.html" target="_blank">LOWA风雨十年 与Gerlinde共享8000M巅峰之路</a></li>
<li><a href="http://www.8264.com/viewnews-98912-page-1.html" target="_blank">亚太雪地产业论坛：中国滑雪产业的发展与挑战</a></li>
<li><a href="http://www.8264.com/viewnews-98881-page-1.html" target="_blank">跑步风行 ISPO BEIJING跑步主题专区现场火爆 </a></li>
<li><a href="http://www.8264.com/viewnews-98880-page-1.html" target="_blank">一汽大众参展ISPO Q7成了“安安静静的美男子”</a></li>
<li><a href="http://www.8264.com/viewnews-98871-page-1.html" target="_blank">探路者亮相ISPO BEIJING 携手高圆圆开启蜕变之旅</a></li>
<li><a href="http://www.8264.com/viewnews-98908-page-1.html" target="_blank">韩寒助阵骆驼户外时尚新品发布 现场分享户外心情</a></li>
<li><a href="http://www.8264.com/viewnews-98878-page-1.html" target="_blank">ISPO BEIJING 2015开幕 展商汇集 活动丰富</a></li>
</ul>
</div>
</div>			
</div>
<div class="eqlist clear_b">
<ul>
<li>
<a href="http://www.8264.com/viewnews-98904-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb1.jpg"/></a>
<a href="http://www.8264.com/viewnews-98904-page-1.html" target="_blank" class="name">HANWAG LHAMO 女士裸靴</a>
</li>
<li>
<a href="http://www.8264.com/viewnews-98877-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb2.jpg"/></a>
<a href="http://www.8264.com/viewnews-98877-page-1.html" target="_blank" class="name">ODLO打造完美贴身层</a>
</li>
<li>
<a href="http://www.8264.com/viewnews-98901-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb3.jpg"/></a>
<a href="http://www.8264.com/viewnews-98901-page-1.html" target="_blank" class="name">CAMEL骆驼喜马拉雅冲锋衣</a>
</li>
<li>
<a href="http://www.8264.com/viewnews-98897-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb4.jpg"/></a>
<a href="http://www.8264.com/viewnews-98897-page-1.html" target="_blank" class="name">老牌背客 GREGORY 换发青春</a>
</li>
<li>
<a href="http://www.8264.com/viewnews-98870-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb5.jpg"/></a>
<a href="http://www.8264.com/viewnews-98870-page-1.html" target="_blank" class="name">KAILAS七项大奖成ISPO最大赢家</a>
</li>
<li>
<a href="http://www.8264.com/viewnews-98864-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb6.jpg"/></a>
<a href="http://www.8264.com/viewnews-98864-page-1.html" target="_blank" class="name">创新40年 Eagle Creek引领户外圈新潮流</a>
</li>
<li>
<a href="http://www.8264.com/viewnews-98866-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb7.jpg"/></a>
<a href="http://www.8264.com/viewnews-98866-page-1.html" target="_blank" class="name">奈特科尔 TM06 3800流明小怪</a>
</li>
<li>
<a href="http://www.8264.com/viewnews-98863-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb8.jpg"/></a>
<a href="http://www.8264.com/viewnews-98863-page-1.html" target="_blank" class="name"> FENIX灯具产品线全领域覆盖</a>
</li>
<li>
<a href="http://www.8264.com/viewnews-98903-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb9.jpg"/></a>
<a href="http://www.8264.com/viewnews-98903-page-1.html" target="_blank" class="name">探路者极地工靴</a>
</li>
<li>
<a href="http://www.8264.com/viewnews-98876-page-1.html " target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zb10.jpg"/></a>
<a href="http://www.8264.com/viewnews-98876-page-1.html " target="_blank" class="name">Fjallraven Expedition Down Parka No.1</a>
</li>

</ul>
</div>
</div>
<div class="mt30">
<div class="title">展会访谈</div>
<div class="fangtanlist clear_b mt30">
<ul>
<li>
<div class="ftimg">
<a href="http://www.8264.com/viewnews-98847-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zf1.jpg"/></a>
<span></span>
</div>
<a href="http://www.8264.com/viewnews-98847-page-1.html" class="name">钟承湛：中国户外品牌要立足产品放眼全球</a>
</li>
<li>
<div class="ftimg">
<a href="http://www.8264.com/viewnews-98945-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zf2.jpg"/></a>
<span></span>
</div>
<a href="http://www.8264.com/viewnews-98945-page-1.html" class="name">骆驼总经理万金刚：做品牌关键要踏实</a>
</li>
<li>
<div class="ftimg">
<a href="http://www.8264.com/viewnews-98911-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zf3.jpg"/></a>
<span></span>
</div>
<a href="http://www.8264.com/viewnews-98911-page-1.html" class="name">NATHAN：为中国跑者带来更佳体验</a>
</li>
<li>
<div class="ftimg">
<a href="http://www.8264.com/viewnews-98882-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zf4.jpg"/></a>
<span></span>
</div>
<a href="http://www.8264.com/viewnews-98882-page-1.html" class="name">徐国庆:家庭户外将在3年内逐步增速 </a>
</li>
<li>
<div class="ftimg">
<a href="http://www.8264.com/viewnews-98920-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zf5.jpg"/></a>
<span></span>
</div>
<a href="http://www.8264.com/viewnews-98920-page-1.html" class="name">梁兵: 纳丽德“誉满十年，感恩有您”</a>
</li>
<li>
<div class="ftimg">
<a href="http://www.8264.com/viewnews-98946-page-1.html
" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zf6.jpg"/></a>
<span></span>
</div>
<a href="http://www.8264.com/viewnews-98946-page-1.html
" class="name">山脉户外CEO： 垂直电商提供更佳体验</a>
</li>
<li>
<div class="ftimg">
<a href="http://www.8264.com/viewnews-98879-page-1.html " target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zf7.jpg"/></a>
<span></span>
</div>
<a href="http://www.8264.com/viewnews-98879-page-1.html " class="name">PETZL全球市场总监：品牌活力来源</a>
</li>
<li>
<div class="ftimg">
<a href="http://www.8264.com/viewnews-98936-page-1.html " target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201412ispo/images/zf8.jpg"/></a>
<span></span>
</div>
<a href="http://www.8264.com/viewnews-98936-page-1.html " class="name">天石：促进人与人 人与自然的和谐共生</a>
</li>
</ul>
</div>
</div>
</div>
<div class="footer">
<div class="footercon clear_b">
<p class="footer_l">8264 版权所有 津ICP备05004140号-10 ICP证 津B2-20110106<br>
<a href="http://bx.8264.com" target="_blank">户外有风险，8264提醒您购买户外保险</a></p>
<p class="footer_r"><a target="_blank" href="http://www.8264.com/about-index.html">8264简介</a> | <a target="_blank" href="http://www.8264.com/about-contact.html">联系我们</a> | <a target="_blank" href="http://www.8264.com/about-adservice.html">广告服务</a> | <a target="_blank" href="http://www.8264.com/link/">户外网址大全</a> | <a target="_blank" href="http://www.8264.com/sitemap">网站地图</a></p>
</div>
</div>
</body>
</html>
