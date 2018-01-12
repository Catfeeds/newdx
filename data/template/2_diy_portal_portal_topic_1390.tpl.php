<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>The North Face 北美新品发布会</title>
</head>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/TNF/style.css"/>
<body>

<div class="wai">
<div class="banner"></div>
<div class="jiaodian">
        	<div class="lun">
        		<div id="myFocus" class="mF_expo2010">
            		<div class="loading"><span></span></div><!--载入画面-->
            			<ul class="pic"><!--内容列表-->
                            <li><a href="#"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger3.jpg" /></a></li><!--alt的内容为标题-->
                            <li><a href="#"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger2.jpg" /></a></li>
                            <li><a href="#"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger1.jpg" /></a></li>
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
</div>
            <div class="jiaodian1">
<div class="jiaodian_t">
                	<span>焦点关注</span>
                    <em style="display:none"><a href="#" target="_blank">更多>></a></em>
                </div>
                <div class="jiaodianw">
                            <h3>打入“北脸”内部 见证TNF“真身”</h3>
                            <p>
                            国内户外领域经常看到这个牌子，身在北美看到了这个相熟的身影，又怎能错过，于是我见证了一个大牌的"真身"！！！
</p>
                </div>
                <div class="jiaodianw" style="border-bottom:none;">
                		
                            <a href="http://bbs.8264.com/thread-1071029-4-1.html" target="_blank"><h3>TABS Pack和flashdry科技全新亮相</h3></a>

<p>
 本次新品发布会上重点展示了ABS Pack和flashdry两项最新科技，其中ABS Pack，他是关于雪崩的紧急救生产品。这项快干技术胜于the north face以前市场上任何快干技术。

</p>
                </div>
            </div>
            <div class="jiaodian2">
<div class="jiaodian_t" style="width:230px;">
                	<span>TNF发布会</span>
                    <em style="display:none"><a href="#" target="_blank">更多>></a></em>
                </div>
                <div class="log"><a href="#" target="_blank"> <img src="http://static.8264.com/oldcms/moban/zt/TNF/images/logo.jpg" /></a></div>
                <div class="jiaodian2w">
                    	<h4>TNF2011年新品发布会</h4>
                        <p>
                        时间：2011年11月30日-12月3日<br />
地点：美国旧金山<br />
主题：EXPERIENCE THE NORTH FACE <br />THE SUMMIT & EYOND
                    </p>
                </div>
            </div>
        </div>
        <div class="mian">
        	<div class="mianl">
<div class="mianl_t">
                	<span>The North Face 运动员介绍</span>
                    <em><a href="http://www.thenorthface.com.cn/catalog/sc-brand/dean-karnazes.html
" target="_blank">更多>></a></em>
                </div>
                <div class="mianl_js">
                		<div class="mianl_jst">
                			<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger22.jpg" /></a></div>
                        <div class="mianl_jsw">
                        	The North Face<br />
作为国际户外知名品牌，拥有强大的运动员团队。其中包括登山运动员团队、攀岩运动员团队、滑雪运动员团队以及耐力跑运动员团队等。这些运动员团队中有像DeanKarnazes那样挑战极限自我突破的耐力跑运动员，也有像ConradAnker那样为梦想执着追求的攀登者。
                        </div>
                </div>
                <div style="height:15px; display:inline;"></div>
                <div class="mianl_js">
                		<div class="mianl_jst">
                			<a href="http://www.thenorthface.com.cn/catalog/sc-brand/dean-karnazes.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger5.jpg" /></a></div>
                <div class="mianl_jsw">
                        	姓名：Dean Karnazes<br />
曾被《时代》杂志评为"全世界100位最具影响力的人物之一不仅自己不断突破个人极限，还鼓励无数运动员充分发挥他们的潜能。《男性健身》杂志这样评价他，"Dean Karnazes可能是世界上最有男子气概的男性。"面对技术水平和背景经历各不相同的运动员，他都给予热心帮助，正是这种独特魅力让他显得非常与众不同。
                        </div>
                </div>
                <div style="height:15px; display:inline;"></div>
                <div class="mianl_js">
                		<div class="mianl_jst">
                			<a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger6.jpg" /></a></div>
                        <div class="mianl_jsw">
                        	姓名：Ian Mclntosh<br />
IanMclntosh从不掩饰自己的喜好，这也正是他作为运动员的特点。"我喜欢高山滑雪，喜欢在整座山上滑雪。我喜欢那些线条和回转。对我来说，这就是滑雪的乐趣。选好一面山，然后开始滑，从山顶一直滑到山脚。一直不停，中间如果想要腾空飞起，随时可以腾空。"24岁的Mclntosh从2岁不到就开始滑雪。
                        </div>
                </div>
                <div style="height:15px; display:inline;"></div>
                <div class="mianl_js" style="border-bottom:none;">
                		<div class="mianl_jst">
                			<a href="http://www.thenorthface.com.cn/catalog/sc-brand/conrad-anker.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger7.jpg" /></a></div>
                        <div class="mianl_jsw">
                        	姓名：Conrad Anker<br />
简单一点说，ConradAnker的强项就是攀登世界上最具技术挑战的地形。为了追求这个目标，他从阿拉斯加和南极洲的山峰一路攀登到巴塔哥尼亚和巴芬岛的大岩壁以及喜马拉雅山的雄伟高峰。Conrad在南极洲探险长达十年之久，并在三个地区首攀成功。1997年攀登了地处Queen Maud Land地区、海拔2500英尺的Rakekniven大岩壁。
                        </div>
                </div>          
            </div>
            <div class="mianr">
            		<div class="mianr_1">
<div class="mianr_t">
                			<span>最新资讯</span>
                    		<em style="display:none"><a href="#" target="_blank">更多>></a></em>
                		</div>
                        <ul>
                        	<li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-15999214-fromuid-34626185.html" target="_blank">.TNF本次活动可以说是一次运动员见面会</a></li>
                            <li><a href="http://www.8264.com/viewnews-72108-page-1.html" target="_blank">.新科技发布会—ABS救生技术</a></li>
                            <li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16121460-fromuid-34626185.html" target="_blank">.The North Face 50公里耐力赛RACE</a></li>
                            <li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16005780-fromuid-34626185.html" target="_blank">.TNF现场展示的产品受到大家的欢迎</a></li>
                            <li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16013618-fromuid-34626185.html" target="_blank">.TNF活动现场设置了攀岩体验设备</a></li>
                            <li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16118547-fromuid-34626185.html" target="_blank">.马林岬 一日徒步 体验异国户外氛围</a></li>
                        </ul>
                    </div>
                    <div class="mianr_2">
<div class="mianr_t">
                			<span>最新图文资讯</span>
                    		<em style="display:none"><a href="#" target="_blank">更多>></a></em>
                		</div>
                        <div class="mianr_2tu">
                        	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16013439-fromuid-34626185.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger4.jpg" /></a></div> 
                        <div class="mianr_2wen">
                            <p>
                            <a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16013439-fromuid-34626185.html" target="_blank">
&nbsp;在雪崩的时候，依靠背包两侧气囊的作用保证人体浮于下泻的雪流，而不至于迅速埋在雪窝里。这一特性，几乎能保证近乎一半的雪崩遇害者能……</a>
                            </p>
                        </div>      
                    </div>
            </div>
            
        </div>
        <div class="zongb">
        	<div class="title">
                <span>The North Face 总部</span>
                <em><a href="#" target="_blank">更多>></a></em>
            </div>
            <div class="tuw">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger8.jpg" /><br /><br />前台接待休息区</a>
            </div>
<div class="tuw">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger43.jpg" /><br /><br />壁画展示厅</a>
            </div>
<div class="tuw">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger10.jpg" /><br /><br />滑雪服体验区</a>
            </div>
<div class="tuw">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger21.jpg" /><br /><br />休闲娱乐室</a>
            </div>
        </div>
        <div class="waituw" style="height:370px;">
        	<div class="title">
                <span>The North Face 旧金山旗舰店</span>
                <em><a href="http://www.8264.com/viewnews-72125-page-1.html" target="_blank">更多>></a></em>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger11.jpg" /><br /><br />TNF旧金山旗舰店</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger12.jpg" /><br /><br />三层的整体景象</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger13.jpg" /><br /><br />鞋品销售区</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger14.jpg" /><br /><br />冲锋衣、抓绒衣</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger15.jpg" /><br /><br />攀岩装备展示</a>
            </div>
            			<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger16.jpg" /><br /><br />睡袋及配件站</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger17.jpg" /><br /><br />箱包搭配点</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger18.jpg" /><br /><br />童装娱乐区</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger19.jpg" /><br /><br />滑雪全套装备</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger20.jpg" /><br /><br />慢跑服装展</a>
            </div>
        </div>
<div class="waituw" style="height:350px;">
        	<div class="title">
                <span>The North Face 耐力跑</span>
                <em><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16121460-fromuid-34626185.html" target="_blank">更多>></a></em>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger23.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger24.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger25.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger26.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger27.jpg" /><br /><br /> </a>
            </div>
            			<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger28.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger29.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger30.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger31.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger32.jpg" /><br /><br /> </a>
            </div>
        </div>
<div class="waituw1">
        	<div class="title">
                <span>The North Face 新品介绍</span>
                <em><a href="http://www.thenorthface.com.cn/catalog/index.html" target="_blank">更多>></a></em>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/mens-jackets-vests/Mens-Elysium-Jacket.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger33.jpg" /><br /><br />男子的 极乐世界 夹克</a>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/womens-jackets-vests/Womens-Closer-Triclimate-Jacket.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger34.jpg" /><br /><br />女式TRICLIMATE夹克</a>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/womens-jackets-vests/Womens-Glitchin-Down-Jacket.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger35.jpg" /><br /><br />女式GLITCHIN DOWN</a>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/mens-jackets-vests/Mens-Glitchin-Down-Jacket.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger36.jpg" /><br /><br />男式专业攀登功能负</a>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/womens-footwear/Womens-Destiny-Down.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger37.jpg" /><br /><br />舒适保暖的系带靴</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059631-pid-15939910-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger38.jpg" /><br /><br />男款保暖休闲鞋</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059631-pid-15940309-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger39.jpg" /><br /><br />女款都市风格靴</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059687-pid-15940511-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger40.jpg" /><br /><br />Prophet 65（登山背包）</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059350-pid-15933672-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger41.jpg" /><br /><br />男式雪地保暖内衣</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059350-pid-15937023-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger42.jpg" /><br /><br />女款三合一夹克</a>
            </div>
        </div>
        
        <div class="bottom">
    	<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264简介</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank" >广告服务</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">户外热点</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">联系方式</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank" >QQ群联盟</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">户外网址大全</a><br>
          服务热线：022-23708264&nbsp;|&nbsp;传真：022-23857291&nbsp;|&nbsp;地址：天津市华苑产业园区鑫茂科技园C2座6层AB单元<br>
          <a href="http://bx.8264.com" target="_blank">户外活动有风险，8264提醒您购买</a> <a href="http://bx.8264.com">户外保险</a><br>
          除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264&nbsp;版权所有   <a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-10</a>&nbsp;&nbsp;&nbsp;<a href="http://www.8264.com/template/8264/image/icp.jpg" target="_blank">ICP证 津B2-20110106</a>
    </div>
        
</div>
</body>
</html>
