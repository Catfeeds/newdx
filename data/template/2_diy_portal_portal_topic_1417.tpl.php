<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/css/style.css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>天然奢华  KROCEUS天然美丽诺羊毛</title>
</head>
<body>
<div class="banner"></div>
<div class="main">
  <div class="essay1">
    <div class="essay1-left">
      <div id="myFocus" class="mF_expo2010">
        <div class="loading"><span></span></div>
        <!--载入画面-->
        <ul class="pic">
          <li><a href="#"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/tiger3.jpg" /></a></li>
          <!--alt的内容为标题-->
          <li><a href="#"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/tiger2.jpg" /></a></li>
          <li><a href="#"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/tiger1.jpg" /></a></li>
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
var auto=setInterval(function(){run()},t)
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
    <div class="essay1-middle">
      <div class="title"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/essay1-title.png" /></div>
      <div>
        <p> 都说户外的衣服已经出了具备户外功能以外都开始沿着时尚的路线走了，其实夏季更能体验户外的衣服具有时尚性，尤其是速干T恤,速干衬衣，很显然从外表已经很难分辨出是否是户外的衣服&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.8264.com/viewnews-76664-page-1.html" target="_blank">详细>></a> </p>
      </div>
      <span><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/line-heng.png" /></span>
      <div class="title2"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/essay2-title.png" /></div>
      <div>
        <p>在寒冷环境下的保温性，Merino纤维具有天然卷曲性形成空气层，帮助身体自然保暖在温暖环境中的热调节，Merino纤维具有天然的隔热和透气性能，当外界温度较低的时候
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.8264.com/portal.php?mod=view&amp;aid=78162" target="_blank">详细>></a></p>
      </div>
    </div>
    <div class="middle-line"><span><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/line-shu.png" /></span></div>
    <div class="essay1-right">
      <div class="title2"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/essay2-title2.png" /></div>
      <div class="essay1-ad2"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/essay-ad2.png" /></div>
      <div class="content">
        <p>KROCEUS 源自拉丁语，取大地原色之意，简称 KR,寓意呼唤人们寻求户外环保自然之真实，用脚步丈量地球的美丽，用足迹传递发现和体验。 </p>
        <p> KROCEUS 系上市公司上海嘉麟杰纺织品股份有限公司（股票代码：002486））旗下品牌，在户外高端功能面料上拥有无可效仿的优势。率先与全方位顶级户外面料专家——美
          国Polartec实现战略合作，成为中国唯一获得与Polartec在内层、中层、外层全面合作的户外品牌。同时，将澳大利亚美丽诺羊毛 MERINO 引入户外领域，为消费者提供纯天然户
          外新奢品。</p>
        <p>更重要的是，凭借强有力的制造能力及快速市场响应机制，KROCEUS 不断进行多功能户外服装研发，以智能科技力与消费者共同达成与自然为友的生活理念。 <a href="http://bbs.8264.com/thread-807406-1-1.html" target="_blank">详细>></a></p>
      </div>
    </div>
  </div>
  <div class="essay2"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/Kroceus1.png" /></div>
  <div class="essay3">
    <div class="essay3-title"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/essay3-title.png" /></div>
    <div class="essay3-fir">
      <div  class="essay3-content">
        <div class="essay3-people">
          <div class="people-photo"><a href="http://bbs.8264.com/thread-653237-1-1.html" target="_blank"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/tiyan1.jpg" /></a></div>
          <div class="people-quote">
            <h3>KROCEUS独家女式短袖</h3>
            <p>——KROCEUS的美丽诺羊毛会呼吸，其透气性（呼吸性）极佳，所选羊毛的多孔纤维结构吸湿和排汗能力强，可吸收35％自重的水分，良好的排汗、透湿功能可保证即使人体出汗也不会使身体冰冷，仍能保持皮肤干爽 <a href="http://bbs.8264.com/thread-653237-1-1.html" target="_blank">详细>></a></p>
          </div>
        </div>
      </div>
      <div class="essay3-content">
        <div class="essay3-people">
          <div class="people-photo"> <a href="http://bbs.8264.com/thread-653207-1-1.html" target="_blank"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/tiyan2.jpg" /> </a></div>
          <div class="people-quote">
            <h3>KROCEUS美丽诺羊毛T恤</h3>
            <p>——纯新羊毛的标志证明了它的血统和出身。这件衣服有很好的弹性，柔滑的手感，轻，和以往穿过的速干T还是有挺大的区别的，这也是我第一次尝试在夏季穿着羊毛材质的T恤. <a href="http://bbs.8264.com/thread-653207-1-1.html" target="_blank">详细>></a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="essay3-fir">
      <div  class="essay3-content">
        <div class="essay3-people">
          <div class="people-photo"><a href="http://bbs.8264.com/thread-653200-1-1.html" target="_blank"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/tiyan3.jpg" /> </a></div>
          <div class="people-quote">
            <h3>KROCEUS男士短袖Polo衫</h3>
            <p>——典款式设计：前三扣衣领，弹力领子，弹力袖口，底部双线收底，商标位于左胸前，简洁大方，不愧为大家风范啊！内部缝纫平整，所有联结均为锁边或包边，没有发现任何的线头，成衣的衫身部分没有出现接缝 <a href="http://bbs.8264.com/thread-653200-1-1.html" target="_blank">详细>></a></p>
          </div>
        </div>
      </div>
      <div  class="essay3-content">
        <div class="essay3-people">
          <div class="people-photo"><a href="http://bbs.8264.com/thread-653191-1-1.html" target="_blank"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/tiyan4.jpg" /> </a></div>
          <div class="people-quote">
            <h3>KROCEUS运动羊毛</h3>
            <p>——在阳光下烈晒，普通的快干衣物，皮肤会出现发烫的感觉，因为其他衣物不具备防臭作用，出汗很多时，身上会发出汗臭的感觉。kroceus羊毛衫具有呼吸功能，而且还具有棉织衣物的感觉，很舒服。出汗后也不 <a href="http://bbs.8264.com/thread-653191-1-1.html" target="_blank">详细>></a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="essay3-content2">
      <p  class="p1"> 美丽诺羊毛100% KROCEUS(KR)羊毛T恤试穿体验</p>
      <p class="p2">　羊毛是一种高级材质，同时羊毛也是理想的功能内衣材料，具有柔软的质感、极强的保暖能力，和相当的排汗速干。羊毛T恤在夏天穿着的时候其舒适度是其他面料无法比拟的，今天小编拿到的是一件KROCEUS(KR)采用100%美丽诺羊毛所制作的圆领T恤。下面就带大家来一起了解一下。美丽诺羊毛又被称为超细美丽诺羊毛，是因为其纤维格外细致，直径在19.5微米以下，最好的美丽诺羊毛直径可达到11.7微米以下，是羊毛品种中最细的。而普美丽诺羊毛衣通羊毛则要粗得多。　 　 <a href="#" target="_blank">详细>></a><a href="http://www.8264.com/portal.php?mod=view&amp;aid=77628" target="_blank"></a></p>
    </div>
  </div>
  <div class="essay4"> <img  class="essay4-title"  src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/essay4-title.jpg" />
    <div class="list">
      <ul>
        <li> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/huodong1.jpg" /> </li>
        <li> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/huodong2.jpg" /> </li>
        <li> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/huodong3.jpg" /> </li>
        <li> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/huodong4.jpg" /> </li>
        <li> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/huodong5.jpg" /> </li>
      </ul>
    </div>
  </div>
  <div class="essay5">
    <div class="essay5-title"><img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/essay5-title.png" /></div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin1.jpg" /> </div>
      <div class="list2-wenzi">
        <p>男式短袖半襟衫</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin2.jpg" /> </div>
      <div class="list2-wenzi">
        <p>男式羊毛短袖POLO衫</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin3.jpg" /> </div>
      <div class="list2-wenzi">
        <p>男式羊毛短袖衬衫</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin4.jpg" /> </div>
      <div class="list2-wenzi">
        <p>男式羊毛短袖圆T恤</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin5.jpg" /> </div>
      <div class="list2-wenzi">
        <p>男式羊毛开衫</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin6.jpg" /> </div>
      <div class="list2-wenzi">
        <p>女式羊毛背心</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin7.jpg" /> </div>
      <div class="list2-wenzi">
        <p>女式羊毛蝙蝠衫</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin8.jpg" /> </div>
      <div class="list2-wenzi">
        <p>女式羊毛长裤</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin9.jpg" /> </div>
      <div class="list2-wenzi">
        <p>女式羊毛短袖POLO衫</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin10.jpg" /> </div>
      <div class="list2-wenzi">
        <p>女式羊毛短袖V领衫</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin11.jpg" /> </div>
      <div class="list2-wenzi">
        <p>女式羊毛短袖连帽衫</p>
      </div>
    </div>
    <div class="list2">
      <div class="list2-img">  <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/chanpin12.jpg" /> </div>
      <div class="list2-wenzi">
        <p>女式羊毛开衫</p>
      </div>
    </div>
  </div>
  <div class="essay6"> <img  class="essay6-title" src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/essay6-title.png" />
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu1.jpg" /> </div>
        <div class="list3-wenzi">
          <p>北京大成翠微店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu2.jpg" /> </div>
        <div class="list3-wenzi">
          <p>北京金源燕莎店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu3.jpg" /> </div>
        <div class="list3-wenzi">
          <p>北京牡丹园翠微店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu4.jpg" /> </div>
        <div class="list3-wenzi">
          <p>大连麦凯乐店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu5.jpg" /> </div>
        <div class="list3-wenzi">
          <p>大连新玛特新华店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu6.jpg" /> </div>
        <div class="list3-wenzi">
          <p>杭州杭大店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu7.jpg" /> </div>
        <div class="list3-wenzi">
          <p>上海港汇店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu8.jpg" /> </div>
        <div class="list3-wenzi">
          <p>上海久光店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu9.jpg" /> </div>
        <div class="list3-wenzi">
          <p>上海又一城店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu10.jpg" /> </div>
        <div class="list3-wenzi">
          <p>沈阳千盛店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu11.jpg" /> </div>
        <div class="list3-wenzi">
          <p>沈阳铁西新玛特店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu12.jpg" /> </div>
        <div class="list3-wenzi">
          <p>沈阳卓展店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu13.jpg" /> </div>
        <div class="list3-wenzi">
          <p>西安东二环百盛店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu14.jpg" /> </div>
        <div class="list3-wenzi">
          <p>西安钟楼开元店</p>
        </div>
      </div>
    </div>
    <div class="list">
      <div class="list3">
        <div class="list3-img"> <img src="http://static.8264.com/oldcms/moban/zt/2012_0731KROCEUS/images/dianpu15.jpg" /> </div>
        <div class="list3-wenzi">
          <p>郑州金博大店</p>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<div class="footer"> <a target="_blank" href="http://www.8264.com/about-index.html">8264简介</a> &nbsp;|&nbsp; <a  target="_blank" href="http://www.8264.com/about-adservice.html">广告服务</a> &nbsp;|&nbsp; <a target="_blank" href="http://www.8264.com/zhuanti">户外热点</a> &nbsp;|&nbsp; <a target="_blank" href="http://www.8264.com/about-contact.html">联系我们</a> &nbsp;|&nbsp; <a target="_blank" href="http://www.8264.com/link/">户外网址大全</a> &nbsp;|&nbsp; <a target="_blank" href="http://www.8264.com/sitemap">网站地图</a> <br>
  服务热线：022-23708264&nbsp;|&nbsp;传真：022-23857291&nbsp;|&nbsp;地址：天津市南开区华苑产业园区鑫茂科技园C2座AB单元6层 <br>
  <a target="_blank" href="http://bx.8264.com"> <span >户外活动有风险，8264提醒您购买</span> </a> <a href="http://bx.8264.com"> <span >户外保险</span> </a> <br>
  除了脚印什么都不留下 除了摄影什么都不带走，欢迎各种媒体转载我们的原创作品[转载请注明出处]。8264&nbsp;版权所有 <a target="_blank" href="http://www.miibeian.gov.cn/">津ICP备05004140号-10</a> <a target="_blank" href="/template/8264/image/icp.jpg">ICP证 津B2-20110106</a> </div>
</body>
</html>
