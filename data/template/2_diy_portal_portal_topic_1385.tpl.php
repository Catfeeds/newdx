<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>2011孙斌再探幺妹峰南壁新路线</title>
</head>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2011sgniang/style.css"/>
<!--[if IE 6]>
<script src="http://static.8264.com/oldcms/moban/zt/2011sgniang/iepng/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2011sgniang/iepng/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->
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
<body>
<div class="nav">
    	<a href="#" class="navone">活动简介</a>
        <a href="#">最新动态</a>
        <a href="#">攀登路线</a>
        <a href="#">攀登日程</a>
        <a href="#">攀登队员</a>
        <a href="#">以往活动</a>
        <a href="#">幺妹峰介绍</a>
        <a href="#">图片集</a>
        <div class="clear"></div>
    </div>
    <!--|||||||||||||||||nav结束||||||||||||||||||||||||-->
    <div class="hb">
    	<div class="mian">
        	<div class="mianl">
            	<div id="myFocus" class="mF_expo2010">
                       <div class="loading"><span></span></div>
                        <!--载入画面-->
                        	<ul class="pic">
                        		<!--内容列表-->
                                <li> <a href="http://www.8264.com/viewnews-71724-page-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/6.jpg"/></a></li>
                                <li> <a href="http://www.8264.com/viewnews-71724-page-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/5.jpg"/></a></li>
                                <li> <a href="http://www.8264.com/viewnews-71193-page-4.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/4.jpg"/></a></li>
                        		<li> <a href="http://bbs.8264.com/thread-336798-1-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/1.jpg"/></a></li>
                        		     <!--alt的内容为标题-->
                        		<li> <a href="http://bbs.8264.com/thread-336798-1-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/2.jpg"/></a></li>
                        		<li> <a href="http://bbs.8264.com/thread-336798-1-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/3.jpg"/></a></li>
                      		</ul>
                </div>
                <!--||||||||||||||||||||轮播结束|||||||||||||||||||||||||||||-->
              	<div class="mianl_1">
                		<div class="mianl_1t">
                        	<span>活动介绍</span>
                            <a href="http://www.8264.com/viewnews-70751-page-3.html" target="_blank">更多>></a>
                        </div>
                        <div class="mianl_1w">
                        	<p>
                            	<span>人&nbsp;&nbsp;&nbsp;&nbsp;物：</span>孙斌<br />
                          <span >职&nbsp;&nbsp;&nbsp;&nbsp;业：</span>The North Face赞助运动员,北京爱峰体育文化有限公司总经理,户外运动培训教练,高山向导<br />
                                <span >活动类型：</span>高海拔技术型阿尔卑斯方式攀登<br />
                                <span >活动时间：</span>10月31--11月5日<br />
                                <span >活动地点：</span>四川省四姑娘山风景区四姑娘山幺妹峰（6250米）<br />
                                <span >活动内容：</span>孙斌和其搭档李宗立采用阿尔卑斯方式攀登邛崃山脉主峰四姑娘山幺妹峰，本次攀登沿着他们自选的路线尝试登顶，如果成功，将开创四姑娘山幺妹峰新路线，并且是为数不多的阿尔卑斯方式登顶这座山峰。<br />
                                <span >活动亮点：</span><br />
                                <span >1、</span>四姑娘山幺妹峰由于山高壁陡，在国内外极限攀登领域享有盛誉，就国内攀登界的攀登历史来讲，只有2005年中国人首次采用围攻的方式与外国人一起首次登顶，2009年，有另外两个攀登者组合（周鹏、严冬冬）沿着南壁自创路线&ldquo;自由之魂&rdquo;登顶。<br />
                                <span >2、</span>孙斌与2006年10月，2008年11月，2009年11月份分别对这座山峰进行了攀登。其中06年由于季节太早，气温高导致落石流雪严重而放弃；08年，由于搭档出现身体问题，临时改搭档后登达5700米处放弃；09年，采用4人两个结组的方式攀登，在距离顶峰100米的6140米处，由于大风，为了防止冻伤而放弃。本次是孙斌第四次攀登，势在必得，是一种回归也是对一次次攀登的一个交代，具有很好的悬念和故事性。<br />
                                <span >3、</span>技术攀登引领者国内攀登界的潮流，本次攀登如果能够成功并通过纪录片的方式深入的展现，必然在国内攀登界引起轰动。
                            </p>
                        </div>
                </div>
            <!--||||||||||||||||||||||||||||||||||||||||mianl_1结束||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
                <div class="mianl_2">
                		<div class="mianl_2t">
                        		<span>攀登队员</span>
                        </div>
                        <div class="mianl_2w">
                           <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/renwu/sunbin.jpg" />
                           <p>
       姓名：孙斌<br />
出生年月：1978年&nbsp;&nbsp;籍贯：浙江杭州&nbsp;&nbsp;学历：大学本科<br />
.2006年10月，2008年11月，2009年11月份曾三次尝试攀登幺妹峰<br />
.06年由于季节太早，气温高导致落石流雪严重而放弃；08年，由于搭档出现身体问题，临时改搭档后登达5700米处放弃；09年，在距离顶峰100米的6140米处，为了防止冻伤而放弃<br />
                            <a href="http://www.8264.com/viewnews-70745-page-1.html" target="_blank"> 更多>></a>

                           </p>
                        </div>
                		<div class="mianl_2w">
                           <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/renwu/lizongli.jpg" />
                           <p>
                           		姓名：李宗利<br />
出生年月：1979年11月&nbsp;&nbsp;籍贯：重庆&nbsp;&nbsp;学历：大学本科<br />
.1992年曾在四川省体育局从事体育训练十年。<br />
.2006年至2008年毕业于中国高级登山人才培训班，是中国培养的第一批由法国教练经过两年全脱产培训的职业高山向导，集攀岩，攀冰，高山滑雪，登山向导，救援等多项资质<br />
                              <a href="http://www.8264.com/portal.php?mod=view&amp;aid=70746" target="_blank"> 更多>></a>

                           </p>
                        </div>
                </div>
             </div>
             <!--|||||||||||||||||||mianl结束||||||||||||||||||||||||-->
             <div class="mianr">
               <div class="mianr_1"> <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/y1.jpg" />
                 <ul>
                   <li><a href="http://www.8264.com/viewnews-71724-page-1.html" target="_blank">.解放之路-2011孙斌李宗利四姑娘幺妹峰攀登报告 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71518-page-1.html" target="_blank">.最新消息：斌利13日成功登顶幺妹并已安全下撤 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71481-page-1.html" target="_blank">.快讯：孙斌李宗利疑似南壁直上新路线登顶幺妹 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71479-page-1.html" target="_blank">.斌利幺妹峰12日上午最新消息 今天开始冲顶 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71460-page-1.html" target="_blank">.孙斌李宗利幺妹峰南壁新路线攀登：将抵达5900 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71422-page-1.html" target="_blank">.孙斌李宗利幺妹峰南壁新路线攀登：10日攀登开始 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71289-page-1.html" target="_blank">.孙斌李宗利幺妹峰南壁新路线攀登：山上运物资 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71257-page-1.html" target="_blank">.孙斌李宗利幺妹峰南壁新路线攀登：进军大本营 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71210-page-1.html" target="_blank">.孙斌李宗利幺妹峰南壁新路线攀登：抵达日隆 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71217-page-1.html" target="_blank">.2009年孙斌幺妹峰南壁“解放之路”攀登视频 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71193-page-1.html" target="_blank">.孙斌李宗利幺妹峰南壁新路线攀登：前往日隆 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71116-page-1.html" target="_blank">.孙斌李宗利幺妹峰南壁新路线攀登：斌利相会 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71075-page-1.html" target="_blank">.2011孙斌将再探幺妹峰南壁新路线即将启程 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71082-page-1.html" target="_blank">.孙斌走进三夫讲堂 讲述7+2的险峻故事[图] </a></li>
                   <li><a href="http://www.8264.com/viewnews-70751-page-1.html" target="_blank">.2011年四姑娘山幺峰南壁直上攀登计划介绍 </a></li>
                   <li><a href="http://www.8264.com/viewnews-70745-page-1.html" target="_blank">.2011孙斌再探幺妹峰南壁新路线队员-孙斌 </a></li>
                   <li><a href="http://www.8264.com/viewnews-70746-page-1.html" target="_blank">.2011孙斌再探幺妹峰南壁新路线队员-李宗利 </a></li>
                   <li><a href="http://bbs.8264.com/thread-336798-1-1.html" target="_blank">.解放之路--记四姑娘山幺妹峰的攀登[组图]</a></li>
                   <li><a href="http://www.8264.com/viewnews-38830-page-1.html" target="_blank">.国家登山队教练孙斌幺妹峰攀登报告[详细版]</a></li>
                   <li><a href="http://www.8264.com/viewnews-57790-page-1.html" target="_blank">.远征瑞士艾格峰北壁 孙斌高清登顶艾格峰[图]</a></li>
                   <li><a href="http://www.8264.com/viewnews-68764-page-1.html" target="_blank">.孙斌：我的理想是建立中国户外运动专业学校</a></li>
                 </ul>
               </div>
               <div class="mianr_2">
<div class="mianr_2t">
                            		<span>攀登路线</span>
                            </div>
                            <div class="mianr_2w"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/jiefangzhilu.jpg" /></div>
                    
                    </div>
                    <div class="mianr_3"></div>
                    <div class="mianr_4">
                    		<div class="mianr_4t">
                            		<span>以往活动</span>
                            
                            </div>
                            <ul>
                                    <li>
<a href="http://www.8264.com/40279.html" target="_blank">.孙斌 --一个追求简单 追求完美的climber</a></li>
                                    <li>
<a href="http://www.8264.com/viewnews-14003-page-1.html" target="_blank">.孙斌的培训生活:在天堂中享受苦痛[组图]</a></li>
                                    <li>
<a href="http://www.8264.com/viewnews-38830-page-1.html" target="_blank">.国家登山队教练孙斌幺妹峰攀登报告[详细版]</a></li>
                                    <li>
<a href="http://bbs.8264.com/thread-336798-1-1.html" target="_blank">.解放之路--记四姑娘山幺妹峰的攀登[组图]</a></li>
                                    <li>
<a href="http://www.8264.com/viewnews-57790-page-1.html" target="_blank">
.远征瑞士艾格峰北壁 孙斌高清登顶艾格峰[图]</a></li>
                            		<li>
<a href="http://www.8264.com/54324.html" target="_blank">.孙斌带队出征北美洲最高峰麦金利峰[组图]</a></li>
                            </ul>
                    </div>
                    
             </div>
             <div class="clear"></div>            
        </div>
        <!--|||||||||||||||||||||mian 结束|||||||||||||||||||||||||||-->
        <div class="js">
    		<div class="jst">
            		<span>幺妹峰介绍</span>
                    <div class="clear"></div>
            </div>
            <div class="jsx">
            	<div class="jsx_l">
            	  <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/datu.jpg" />
            	  <p>
                   	  &nbsp;&nbsp;&nbsp;&nbsp;四姑娘山幺妹峰，永恒的经典，技术攀登的象征，一座造就攀登神话和传奇的山，一座检验攀登者肉体和心灵的界门，在它面前要么选择超脱，要么一无所有。它的岩脉上有过一流攀登者的印记，也有着失利者的泪水，只有真正有勇气和决心的攀登者能够摘得它的荣誉...... <a href="http://bbs.8264.com/thread-718181-1-3.html" target="_blank">更多>></a>                     
                    </p>
                </div>
                <div class="jsx_r">
                    <div class="lian">
                        <div class="img_b"><a href="http://www.8264.com/viewnews-4395-page-1.html " target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/1.jpg" /></a></div>
                        <div class="img_w"><a href="http://www.8264.com/viewnews-36121-page-1.html " target="_blank">蜀山之后-幺妹峰登顶历史记录</a></div>
                    </div>
                    <div class="lian">
                        <div class="img_b"><a href="http://bbs.8264.com/thread-12007-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/2.jpg" /></a></div>
                        <div class="img_w"><a href="http://bbs.8264.com/thread-12007-1-1.html" target="_blank">国人首登-幺妹峰攀登全程组图</a></div>
                    </div>
                    <div class="lian">
                        <div class="img_b"><a href="http://www.8264.com/35135.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/3.jpg" /></a></div>
                        <div class="img_w"><a href="http://www.8264.com/35135.html" target="_blank">美国人幺妹峰西南山脊首登</a></div>
                    </div>
                    <div class="lian">
                        <div class="img_b"><a href="http://www.8264.com/46785.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/4.jpg" /></a></div>
                        <div class="img_w"><a href="http://www.8264.com/46785.html" target="_blank">严冬冬周鹏幺妹峰中央南壁新路线</a></div>
                    </div>
<div class="clear"></div>
              	</div>
            </div>
    	</div>
        <div class="tj">
        		<div class="tjt">
                		<span>攀登图片集</span>
                        <a href="#">更多>></a>
                </div>
                <div class="tjx">
                		<img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lun1.jpg" />
                        <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lun1.jpg" />
                        <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lun1.jpg" />
                        <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lun1.jpg" />
                        <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lun1.jpg" />
                        <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lun1.jpg" />
                        <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lun1.jpg" />
                        <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lun1.jpg" />
                </div>
        </div>
    </div>
    <div class="bottom">
    	<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264简介</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank" >广告服务</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">户外热点</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">联系方式</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank" >QQ群联盟</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">户外网址大全</a><br>
          服务热线：022-23708264&nbsp;|&nbsp;传真：022-23857291&nbsp;|&nbsp;地址：天津市华苑产业园区鑫茂科技园C2座6层AB单元<br>
          <a href="http://bx.8264.com" target="_blank">户外活动有风险，8264提醒您购买</a> <a href="http://bx.8264.com">户外保险</a><br>
          除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264&nbsp;版权所有   <a href="http://www.miibeian.gov.cn/" target="_blank">津ICP备05004140号-10</a>&nbsp;&nbsp;&nbsp;<a href="http://www.8264.com/template/8264/image/icp.jpg" target="_blank">ICP证 津B2-20110106</a>
    </div>
</body>
</html>