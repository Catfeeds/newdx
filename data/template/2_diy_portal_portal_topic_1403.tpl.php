<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>The North Face&reg; 2012北京国际越野挑战赛</title>
</head>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/TNF1/style.css"/>
<body>


<div class="wai">
<div class="banner"></div>
<div class="jiaodian">
        	<div class="lun">
        		<div id="myFocus" class="mF_expo2010">
            		<div class="loading"><span></span></div><!--载入画面-->
            			<ul class="pic"><!--内容列表-->
                            <li><a href="http://www.8264.com/viewnews-76058-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger3.jpg" /></a></li><!--alt的内容为标题-->
                            <li><a href="http://bbs.8264.com/thread-1245781-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger2.jpg" /></a></li>
                            <li><a href="http://www.8264.com/viewnews-76079-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger1.jpg" /></a></li>
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
                                                        <a href="http://www.8264.com/viewnews-76079-page-1.html" target="_blank">
                            <h3>TNF100 耐力跑"新人"闪耀百公里赛道

</h3></a>
                            <p>
                            作为第一次参加此项赛事的&ldquo;新人&rdquo;，Kami战胜了去年赛事的卫冕冠军刘君彦和被中国跑友称为"邢姐"的邢如伶，获得了本届赛事的冠军。后两人分别获得了第二和第三名。
  </p>
                </div>
                <div class="jiaodianw" style="border-bottom:none;">
                		
                            <a href="http://bbs.8264.com/thread-1245781-1-1.html" target="_blank">
                            <h3>TNF 100 十公里赛现场花絮

</h3></a>

<p>
8264讯 12日上午继100公里及50公里双人徒步比赛开始之后第四届2012年TheNorthFace100越野挑战赛10公里、50公里比赛项目在十三陵水库坝底平台正式开跑。</p>
                </div>
            </div>
            <div class="jiaodian2">
<div class="jiaodian_t" style="width:230px;">
                	<span>TNF 100 时间表</span>
                    <em style="display:none"><a href="#" target="_blank">更多>></a></em>
                </div>
                <div class="log"><a href="#" target="_blank"> <img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/logo.jpg" /></a></div>
                <div class="jiaodian2w">
                    	<h4>TNF 100 时间安排</h4>
                        <p>
                        时间：2012年5月12日<br />
地点：北京<br />
主题：跑出你人生最野的路 <br />
                    </p>
                </div>
            </div>
        </div>
        <div class="mian">
        	<div class="mianl">
<div class="mianl_t">
                	<span>The North Face 耐力跑运动员</span>
                    <em><a href="http://www.thenorthface.com.cn/catalog/sc-brand/dean-karnazes.html
" target="_blank">更多>></a></em>
                </div>
                <div class="mianl_js">
                		<div class="mianl_jst">
                			<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger22.jpg" /></a></div>
                        <div class="mianl_jsw">
                        	The North Face<br />
作为国际户外知名品牌，拥有强大的运动员团队。其中包括登山运动员团队、攀岩运动员团队、滑雪运动员团队以及耐力跑运动员团队等。国内The North Face 100公里赛也涌现出了许多专业或业余的耐力跑运动员，如：100KM 女子组冠军邢如伶、男子组亚军运艳桥等。
                        </div>
                </div>
                <div style="height:15px; display:inline;"></div>
                <div class="mianl_js">
                		<div class="mianl_jst">
                			<a href="http://www.thenorthface.com.cn/catalog/sc-brand/dean-karnazes.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger5.jpg" /></a></div>
                <div class="mianl_jsw">
                        	姓名：Diane Van Deren<br />
               	  极限长跑运动员、世界级的耐力跑运动员，从100英里越野跑，到雪地赛跑，再到lditarod超长邀请赛......Diane一次次客服困难应对各种挑战。其人生格言：“我用双腿传达内心想法，激励他人赢得取得成功。我珍惜每一个冲过终点线的瞬间”。每一位言行一致，勇于冒险并与她分享冒险机会的人，都是她最忠心的伙伴。</div>
                </div>
                <div style="height:15px; display:inline;"></div>
                <div class="mianl_js">
                		<div class="mianl_jst">
                			<a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger6.jpg" /></a></div>
                        <div class="mianl_jsw">
                        	姓名：邢如伶<br />
她的运动生涯始于38岁，并多次在各种马拉松赛事和户外运动赛中取得好成绩。从2009年The North Face100 耐力跑挑战赛女子组冠军开始，她走出了自己的耐力跑之路，2011年再次The North Face100 耐力跑挑战赛北京站比赛获得女子组亚军；同年8月，在UTMB环勃朗峰耐力跑比赛CCC赛程98公里比赛中，从1800名参赛者中脱颖而出。
                        </div>
                </div>
                <div style="height:15px; display:inline;"></div>
                <div class="mianl_js" style="border-bottom:none;">
                		<div class="mianl_jst">
                			<a href="http://www.thenorthface.com.cn/catalog/sc-brand/conrad-anker.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger7.jpg" /></a></div>
                        <div class="mianl_jsw">
                        	姓名：运艳桥<br />
比较喜欢富于挑战的生活，高中时喜欢上了马拉松，进入大学后就转移到耐力跑这一项目上，因为他说跑步能给他带来快乐。在2009年举办的The North Face100 耐力跑挑战赛北京站中，他犹如一匹半道上杀出的黑马，轻松获得男子组第二名，又在2009年的新加坡 The North Face100 耐力跑挑战赛中获得冠军。
                        </div>
                </div>
                <div style="height:15px; display:inline;"></div>
                          
            </div>
            <div class="mianr">
            		<div class="mianr_1">
<div class="mianr_t">
                			<span>最新资讯</span>
                    		<em style="display:none"><a href="#" target="_blank">更多>></a></em>
                		</div>
                        <ul>
                        <li><a href="http://www.8264.com/viewnews-76075-page-1.html" target="_blank">.TNF100北京国际越野挑战赛落下帷幕</a></li>
                        <li><a href="http://www.8264.com/viewnews-76079-page-1.html" target="_blank">.TNF100耐力跑"新人"闪耀百公里赛道</a></li>
                          <li><a href="http://www.8264.com/viewnews-76058-page-1.html" target="_blank">.TheNorthFace100越野挑战赛图片花絮</a></li>
                          <li><a href="http://www.8264.com/viewnews-76053-page-1.html" target="_blank">.TNF100越野挑战赛今日凌晨正式开跑</a></li>
                          <li><a href="http://u.8264.com/home-space-uid-50811-do-blog-id-401274.html" target="_blank">.The North Face 运动员面对面</a></li>

                            <li><a href="http://u.8264.com/home-space-uid-50811-do-blog-id-401151.html" target="_blank">.The North Face "去野"主题活动启动</a></li>
                        </ul>
                    </div>
                    <div class="mianr_2">
<div class="mianr_t">
                			<span>百公里挑战赛全路线图</span>
                    		<em style="display:none"><a href="#" target="_blank">更多>></a></em>
                		</div>
                        <div class="mianr_2tu">
                        	<a href="http://www.thenorthface100.com.cn/download/TNF100_All%20Map.jpg" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger4.jpg" /></a></div> 
                        <div class="mianr_2wen">
                            <p>
                           
&nbsp;&nbsp;&nbsp;&nbsp;整个活动范围至居庸关长城、十三陵水库周边、蟒山国家森林公园、虎峪自然风景区等北京市昌平区内部分道路、景区、山地！


                            </p>
                        </div>      
                    </div>
            </div>
            
        </div>
        <div class="zongb">
        	<div class="title">
                <span>The North Face 100 2012北京国际越野挑战赛线路图</span>
                <em><a href="http://www.thenorthface100.com.cn/macth.php?cid=38" target="_blank">更多>></a></em>
            </div>
            <div class="tuw">
            	<a href="http://www.thenorthface100.com.cn/download/TNF100_50KM.jpg" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger8.jpg" /><br /><br />
            	50公里路线图</a>
        </div>
<div class="tuw">
            	<a href="http://www.thenorthface100.com.cn/download/TNF100_100KM.jpg" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger43.jpg" /><br /><br />
            	100公里线路图</a>
        </div>
<div class="tuw">
            	<a href="http://www.thenorthface100.com.cn/download/TNF100_10KM.jpg" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger10.jpg" /><br /><br />
            	10公里线路图</a>
        </div>
<div class="tuw">
            	<a href="http://www.thenorthface100.com.cn/download/TNF100_ct50km.jpg" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger21.jpg" /><br /><br />
            	双人徒步线路图</a>
            </div>
        </div>
        <div class="waituw" style="height:370px;">
        	<div class="title">
                <span>The North Face 100 2012 北京耐力跑图集</span>
                <em><a href="http://bbs.8264.com/thread-1245781-1-1.html" target="_blank">更多>></a></em>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger11.jpg" /><br /><br /></a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger12.jpg" /><br /><br /></a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger13.jpg" /><br /><br /></a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger14.jpg" /><br /><br /></a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger15.jpg" /><br /><br /></a>
            </div>
            			<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger16.jpg" /><br /><br /></a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger17.jpg" /><br /><br /></a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger18.jpg" /><br /><br /></a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger19.jpg" /><br /><br /></a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger20.jpg" /><br /><br /></a>
            </div>
        </div>
<div class="waituw" style="height:350px;">
        	<div class="title">
                <span>The North Face 100 2011旧金山50英里耐力跑回顾</span>
                <em><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16121460-fromuid-34626185.html" target="_blank">更多>></a></em>
    </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger23.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger24.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger25.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger26.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger27.jpg" /><br /><br /> </a>
            </div>
            			<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger28.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger29.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger30.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger31.jpg" /><br /><br /> </a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger32.jpg" /><br /><br /> </a>
            </div>
        </div>
<div class="waituw1">
        	<div class="title">
                <span>The North Face 耐力跑产品推荐</span>
                <em><a href="#" target="_blank">更多>></a></em>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?id=92&amp;cid=1" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger33.jpg" /><br /><br />女款v型领卫衣</a>
          </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?id=88&amp;cid=1" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger34.jpg" /><br /><br />男款防臭T恤</a>
  </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?cid=15" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger35.jpg" /><br /><br />男款轻质通风短裤</a>
          </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?id=29&amp;cid=15" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger36.jpg" /><br /><br />
           	  女款运动短裤</a>
          </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?cid=16" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger37.jpg" /><br /><br />男款越野跑鞋</a>
          </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?id=56&amp;cid=16" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger38.jpg" /><br /><br />女款轻便跑鞋</a>
          </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?cid=2" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger39.jpg" /><br /><br />耐力赛专用水壶袋</a>
          </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?id=70&amp;cid=2" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger40.jpg" /><br /><br />终极耐力跑水袋包</a>
          </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?cid=9" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger41.jpg" /><br /><br />
           	  男款透气防水夹克</a>
          </div>
<div class="tuw2">
            	<a href="http://www.thenorthface100.com.cn/tshirt.php?id=38&amp;cid=9" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF1/images/tiger42.jpg" /><br /><br />女款超轻防水跑步夹克</a>
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
