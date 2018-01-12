<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>8月 色“彩”装备全“型”出动</title>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/css/style.css"/>
<script src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/js/jquery.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/js/bootmlun.js" type="text/javascript"></script>
</head>

<body>
<div class="top"></div>
<div class="wap">
<div class="banner"></div>
    <div class="min1">
    	<div class="min1_l">
        		<div id="myFocus" class="mF_expo2010">
            		<div class="loading"><span></span></div><!--载入画面-->
            			<ul class="pic"><!--内容列表-->
                            <li><a href="http://www.8264.com/viewnews-76602-page-1.html"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/lunbo3.jpg" alt="HASKI正式签约文章马伊琍 携手开启不凡征程"/></a></li><!--alt的内容为标题-->
                            <li><a href="http://bbs.8264.com/thread-1330952-1-1.html"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/lunbo2.jpg" alt="Phenix防水面料三剑客，“锋”雨无阻"/></a></li>
<li><a href="http://www.8264.com/topic/1417.html"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/lunbo4.jpg" alt="智能控温 天然奢华——KROCEUS美丽诺羊毛"/></a></li>
            		</ul>
        		</div>
                <script type="text/javascript">
var myFocus={
//Design By Koen @ 2010.7.x
//http://hi.baidu.com/koen_li
//koen_lee@qq.com
$:function(id){return document.getElementById(id);},
$$:function(tag,obj){return (typeof obj=='object'?obj:this.$(obj)).getElementsByTagName(tag);},
linear:function(t,b,c,d){return c*t/d + b;},
easeIn:function(t,b,c,d){return c*(t/=d)*t*t*t + b;},
easeOut:function(t,b,c,d){return -c*((t=t/d-1)*t*t*t - 1) + b;},
opa:function(obj,v){
if(v!=undefined) {v=v>100?100:(v<0?0:v); obj.style.filter = "alpha(opacity=" + v + ")"; obj.style.opacity = (v / 100);}
else return (document.all)?((obj.filters.alpha)?obj.filters.alpha.opacity:100):((obj.style.opacity)?obj.style.opacity*100:100);
},
move:function(obj,dir,val,type,spd,fn){
var t=0,b=parseInt(obj.style[dir])||0,c=val-b,d=spd||50,st=type||'linear',m=c>0?'ceil':'floor';
if(obj[dir+'timer']) clearInterval(obj[dir+'timer']);
obj[dir+'timer']=setInterval(function(){
if(t<d){obj.style[dir]=Math[m](myFocus[st](t++,b,c,d))+'px';}
else {clearInterval(obj[dir+'timer']);fn&&fn.call(myFocus);}
},10);return this;
},
fade:function(obj,type,spd,fn){
var o=this.opa(obj),m=spd||5;
if(o==0) obj.style.display='';
if(type=='out') m=-m;
if(obj.fadeTimer) clearInterval(obj.fadeTimer);
obj.fadeTimer=setInterval(function(){
o+=m;myFocus.opa(obj,o);
if(o<=0) obj.style.display='none';
if(o>=100||o<=0){clearInterval(obj.fadeTimer);fn&&fn.call(myFocus);}
},10);return this;
},
addList:function(obj,cla,arr){
var s=[],n=this.$$('li',this.$$('ul',obj)[0]).length,num=cla.length;
for(var j=0;j<num;j++){
s.push('<ul class='+cla[j]+'>');
for(var i=0;i<n;i++){s.push('<li>'+(cla[j]=='num'?(i+1):(cla[j]=='txt'?this.$$('li',obj)[i].innerHTML.replace(/\<img.*?\>/i,this.$$('img',obj)[i].alt):''))+'<span></span></li>')};
s.push('</ul>');
}; obj.innerHTML+=s.join('');
},
setting:function(par){//设置DOM/文档加载就绪后执行的任务
if(window.attachEvent){window.attachEvent('onload',function(){myFocus[par.style](par)});}
　　		else{window.addEventListener('load',function(){myFocus[par.style](par)},false);}
},
mF_expo2010:function(par){
var box=this.$(par.id),t=par.time*1000;
this.addList(box,['txt-bg','txt','num-bg','num']);
var pic=this.$$('ul',box)[0],txt=this.$$('ul',box)[2],num=this.$$('ul',box)[4],img=this.$$('li',pic),tip=this.$$('li',txt);
var H=tip[0].clientHeight+60;
var n=img.length;
var index=0;
for(var i=0;i<img.length;i++){this.opa(img[i],0); img[i].style.display='none'; tip[i].style.bottom=-H+'px'}
box.removeChild(this.$$('div',box)[0]);
this.fade(img[index],'in');
this.move(tip[index],'bottom',0,'easeOut',40)
this.$$('li',num)[index].className='current';
var run=function(idx){
myFocus.fade(img[index],'out');
myFocus.move(tip[index],'bottom',-H,'easeIn',10);
myFocus.$$('li',num)[index].className='';
if(index==n-1) index=-1;
var N=idx!=undefined?idx:index+1;
myFocus.fade(img[N],'in');
myFocus.move(tip[N],'bottom',0,'easeOut',40);
myFocus.$$('li',num)[N].className='current';
index=N;
}
var auto=setInterval(function(){run()},t);
for (var j=0;j<n;j++){
this.$$('li',num)[j].j=j;
this.$$('li',num)[j].onclick=function(){run(this.j)}
this.$$('li',num)[j].onmouseover=function(){if(!this.className) this.className = 'hover';}
this.$$('li',num)[j].onmouseout=function(){if(this.className=='hover') this.className ='';}
}
box.onmouseover=function(){clearInterval(auto);}
    	box.onmouseout=function(){auto=setInterval(function(){run()},t);}
}
}
myFocus.setting({style:'mF_expo2010',id:'myFocus',time:2});//style为风格样式，id为焦点图ID，time为每帧间隔时间(秒) 
</script>
        
<!--        	<div id="focus_turn">
                <ul id="focus_pic">
                    <li class="current"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/test1.jpg" /></a></li>
                    <li class="normal"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/test2.jpg" /></a></li>
                    <li class="normal"><a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/test3.jpg" /></a></li>
                </ul>
                <ul id="focus_tx">
                    <li class="current"><a href="#" target="_blank">111111</a></li>
                    <li class="normal"><a href="#" target="_blank">22222</a></li>
                    <li class="normal"><a href="#" target="_blank">33333</a></li>
                </ul>
        		<div id="focus_opacity"></div>
    		</div>-->
        </div>
        <div class="min1_r">
        	<h1>8月“色彩装备 全型出动”</h1>
            <p>  8月走进色彩户外，骄傲的红，神秘的黑，清高的白；色彩如果会说话，就把你的个性说给户外听吧！是登上山顶后的呐喊，是穿越丛林后的低语，是溯溪涉水时的喧哗......
甘于无声无息注定在这个盛夏不是它的季节，亮出自己才是你走进户外的最臻表白。来吧，从色彩开始我们的户外之旅。</p>
            <ol>
                <li><a href="http://www.8264.com/zb-1297838" target="_blank"> 真金不怕火炼 传世精品 骚包者不容错过装备</a></li>
                <li><a href="http://www.8264.com/zb-1301579" target="_blank"> 格子控钟情格子衫 各大品牌的速干格子衬衣</a></li>
                <li><a href="http://www.8264.com/zb-1304628" target="_blank"> 装备绝非玩概念 超轻帐篷大开会 实用加实惠</a></li>
                <li><a href="http://www.8264.com/zb-1311539" target="_blank"> 买东西买实惠 好装备真心不贵 200元徒步鞋</a></li>
<li><a href="http://www.8264.com/zb-1318272" target="_blank"> 非屌丝专用战靴 欧美品质 国人价格 请勿拍砖</a></li>
                <li><a href="http://www.8264.com/zb-1321993" target="_blank"> 超薄无极限 防风更有效 国产性价比皮肤风衣</a></li>
            </ol>
        </div>
        <div class="clear"></div>
    </div>
    <div class="tilte">新品推荐<br />New Product Recommendation</div>
    <div class="min2">
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78527-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new1.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>KROCEUS 女士抓绒</h2>
                <p>款号：12BEMPL349  市场价：490元</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78717-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new2.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>Kolumb超轻风衣</h2>
                <p>款号：10850/20665 零售价：799元</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78498-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new3.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>探路者冲锋衣</h2>
                <p>款号：TABA92266  市场价：769元</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78734-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new4.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>Shehe超轻薄皮肤风衣</h2>
                <p>款号：94214 市场价：528元</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78735-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new5.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>Northern Sun长袖衬衣</h2>
                <p>款号：1CS2250 市场价：760元</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78750-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new6.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>acome 舒门女士夹克</h2>
                <p>款号：AG122J2002</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78725-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new7.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>YODO男款冲锋衣</h2>
                <p>款号：D21031 市场价：899元</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt">
            	<a href="http://bbs.8264.com/portal.php?mod=view&amp;aid=78570" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new8.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>牧高笛炫彩帐篷</h2>
                <p>款号：NXZ1229001 价格998元</p>
            </div>
        </div>
        <div class="clear"	></div>
    </div>
    <div class="tilte">热门推荐<br />
      Hot Product Recommendation</div>
    <div class="min3">
    	<div class="img_box">
        	<div class="img_boxt"><a href="http://bbs.8264.com/portal.php?mod=view&amp;aid=78562" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot1.jpg" /></a></div>
<div class="img_boxw">
            	<h2>Actionfox帽子围巾组合</h2>
                <p>款号：340-1246 市场价：258元</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78724-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot2.jpg" /></a></div>
<div class="img_boxw">
            	<h2>CARAVA 皮肤风衣</h2>
                <p>款号：552082 价格：468元</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=78731" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot3.jpg" /></a></div>
<div class="img_boxw">
            	<h2>  sandstone 情侣皮肤风衣</h2>
                <p>款号：821-0048 价格：399元</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=78745" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot4.jpg" /></a></div>
<div class="img_boxw">
            	<h2>天石长须鲸睡袋</h2>
                <p>款号：N2320311250 价格：971元</p>
            </div>
</div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=78740" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot5.jpg" /></a></div>
<div class="img_boxw">
            	<h2>KingCamp扶手椅</h2>
                <p>款号：KC3849 价格：298元</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78721-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot6.jpg" /></a></div>
<div class="img_boxw">
            	<h2>Yisijia 皮肤风衣</h2>
                <p>款号：615112738 价格：428元</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78493-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot7.jpg" /></a></div>
<div class="img_boxw">
            	<h2>思凯乐女款冲锋衣</h2>
                <p>款号：F3026339 价格：1090元</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=1345972" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot8.jpg" /></a></div>
<div class="img_boxw">
            	<h2>爬山虎沙滩裤</h2>
                <p>款号：CKFX 02 </p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://bbs.8264.com/portal.php?mod=view&amp;aid=78577" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot9.jpg" /></a></div>
<div class="img_boxw">
            	<h2>雷斯洛 鞋带工具</h2>
                <p>款号：KLL-03-2PK01 价格：12元</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78527-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot10.jpg" /></a></div>
<div class="img_boxw">
            	<h2>KROCEUS女士冲锋衣</h2>
                <p>款号：12BEOTL033 价格：1090元</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78562-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot11.jpg" /></a></div>
<div class="img_boxw">
            	<h2>Actionfox 单肩背包</h2>
                <p>款号：414-1261 价格：368元</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78783-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot12.jpg" /></a></div>
<div class="img_boxw">
            	<h2>ROYALWAY 冲锋衣</h2>
                <p>款号：ROM3137CS 价格：898元</p>
            </div>
        </div>
        <div class="clear"	></div>
    </div>
</div>
    <div class="tilte">背包装备推荐<br />Bag Product Recommendation</div>
    <div class="min4">
    	<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78498-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag1.jpg" /></a></div>
<div class="img_boxw">
            	<h2>探路者45L背包</h2>
                <p>款号：TEBA90010 价格：899元</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78493-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag2.jpg" /></a></div>
<div class="img_boxw">
            	<h2>思凯乐Nikita38L背包</h2>
                <p>款号：z3321031 价格：686</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78785-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag3.jpg" /></a></div>
<div class="img_boxw">
            	<h2>牧高笛超轻背包</h2>
                <p>货号;ZXA1224004 价格：798元</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78785-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag4.jpg" /></a></div>
<div class="img_boxw">
            	<h2>牧高笛先锋背包</h2>
                <p>货号：ZXA1224004 价格：798元</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://detail.tmall.com/item.htm?spm=a1z10.3.17.15&amp;id=13110961162&amp;" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag5.jpg" /></a></div>
<div class="img_boxw">
            	<h2>Doite登山包</h2>
                <p>款号：6653  价格：742元</p>
            </div>
        </div>

        <div class="clear"></div>
    </div>
    <div class="min5">
  	  <div class="focus">
  	    <ul class="rslides f426x240">
  <li>
  	        <a href="http://www.8264.com/viewnews-78724-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/xie6.jpg" /></a>
          </li>
  	      <li>
  	        <a href="http://www.8264.com/viewnews-78717-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/xie2.jpg" /></a>
          </li>
  	      <li>
  	        <a href="http://www.8264.com/portal.php?mod=view&amp;aid=78748" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/xie4.jpg" /></a>
          </li>
    <li>
            <a href="http://www.8264.com/viewnews-78734-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/xie1.jpg" /></a>
          </li>
  	<li>
            <a href="http://www.8264.com/viewnews-78799-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/xie3.jpg" /></a>
          </li>
  	<li>
            <a href="http://www.8264.com/viewnews-78747-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/xie5.jpg" /></a>
          </li>
        </ul>
  	  </div>
       
    </div>
 
</div>
<div class="bottom">
    <div class="bottom2"><a href="http://www.8264.com/about-index.html" target="_blank">8264简介</a>&nbsp;|&nbsp;<a href="http://www.8264.com/about-contact.html" target="_blank">联系我们</a>&nbsp;|&nbsp;<a href="http://www.8264.com/about-adservice.html" target="_blank">广告服务</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">户外热点</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">户外网址大全</a>&nbsp;|&nbsp;<a href="http://www.8264.com/sitemap" target="_blank">网站地图</a><br><a href="http://bx.8264.com" target="_blank"><span>户外活动有风险，8264提醒您购买</span></a> <a href="http://bx.8264.com"><span>户外保险</span></a><br>          除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264&nbsp;版权所有   <a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-10</a>&nbsp;&nbsp;&nbsp;<a href="/template/8264/image/icp.jpg" target="_blank">ICP证 津B2-20110106</a></div>
</div>
</body>
</html>