<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>8�� ɫ���ʡ�װ��ȫ���͡�����</title>
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
            		<div class="loading"><span></span></div><!--���뻭��-->
            			<ul class="pic"><!--�����б�-->
                            <li><a href="http://www.8264.com/viewnews-76602-page-1.html"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/lunbo3.jpg" alt="HASKI��ʽǩԼ���������P Я�ֿ�����������"/></a></li><!--alt������Ϊ����-->
                            <li><a href="http://bbs.8264.com/thread-1330952-1-1.html"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/lunbo2.jpg" alt="Phenix��ˮ���������ͣ����桱������"/></a></li>
<li><a href="http://www.8264.com/topic/1417.html"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/lunbo4.jpg" alt="���ܿ��� ��Ȼ�ݻ�����KROCEUS����ŵ��ë"/></a></li>
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
setting:function(par){//����DOM/�ĵ����ؾ�����ִ�е�����
if(window.attachEvent){window.attachEvent('onload',function(){myFocus[par.style](par)});}
����		else{window.addEventListener('load',function(){myFocus[par.style](par)},false);}
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
myFocus.setting({style:'mF_expo2010',id:'myFocus',time:2});//styleΪ�����ʽ��idΪ����ͼID��timeΪÿ֡���ʱ��(��) 
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
        	<h1>8�¡�ɫ��װ�� ȫ�ͳ�����</h1>
            <p>  8���߽�ɫ�ʻ��⣬�����ĺ죬���صĺڣ���ߵİף�ɫ�������˵�����Ͱ���ĸ���˵���������ɣ��ǵ���ɽ������ź����Ǵ�Խ���ֺ�ĵ������Ϫ��ˮʱ������......
����������Ϣע�������ʢ�Ĳ������ļ��ڣ������Լ��������߽�����������ס����ɣ���ɫ�ʿ�ʼ���ǵĻ���֮�á�</p>
            <ol>
                <li><a href="http://www.8264.com/zb-1297838" target="_blank"> ����»��� ������Ʒ ɧ���߲��ݴ��װ��</a></li>
                <li><a href="http://www.8264.com/zb-1301579" target="_blank"> ���ӿ���������� ����Ʒ�Ƶ��ٸɸ��ӳ���</a></li>
                <li><a href="http://www.8264.com/zb-1304628" target="_blank"> װ����������� ��������󿪻� ʵ�ü�ʵ��</a></li>
                <li><a href="http://www.8264.com/zb-1311539" target="_blank"> ������ʵ�� ��װ�����Ĳ��� 200Ԫͽ��Ь</a></li>
<li><a href="http://www.8264.com/zb-1318272" target="_blank"> �ǌ�˿ר��սѥ ŷ��Ʒ�� ���˼۸� ������ש</a></li>
                <li><a href="http://www.8264.com/zb-1321993" target="_blank"> �����޼��� �������Ч �����Լ۱�Ƥ������</a></li>
            </ol>
        </div>
        <div class="clear"></div>
    </div>
    <div class="tilte">��Ʒ�Ƽ�<br />New Product Recommendation</div>
    <div class="min2">
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78527-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new1.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>KROCEUS Ůʿץ��</h2>
                <p>��ţ�12BEMPL349  �г��ۣ�490Ԫ</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78717-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new2.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>Kolumb�������</h2>
                <p>��ţ�10850/20665 ���ۼۣ�799Ԫ</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78498-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new3.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>̽·�߳����</h2>
                <p>��ţ�TABA92266  �г��ۣ�769Ԫ</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78734-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new4.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>Shehe���ᱡƤ������</h2>
                <p>��ţ�94214 �г��ۣ�528Ԫ</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78735-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new5.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>Northern Sun�������</h2>
                <p>��ţ�1CS2250 �г��ۣ�760Ԫ</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78750-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new6.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>acome ����Ůʿ�п�</h2>
                <p>��ţ�AG122J2002</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt">
            	<a href="http://www.8264.com/viewnews-78725-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new7.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>YODO�п�����</h2>
                <p>��ţ�D21031 �г��ۣ�899Ԫ</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt">
            	<a href="http://bbs.8264.com/portal.php?mod=view&amp;aid=78570" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_new8.jpg" /></a>
            </div>
<div class="img_boxw">
            	<h2>���ߵ��Ų�����</h2>
                <p>��ţ�NXZ1229001 �۸�998Ԫ</p>
            </div>
        </div>
        <div class="clear"	></div>
    </div>
    <div class="tilte">�����Ƽ�<br />
      Hot Product Recommendation</div>
    <div class="min3">
    	<div class="img_box">
        	<div class="img_boxt"><a href="http://bbs.8264.com/portal.php?mod=view&amp;aid=78562" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot1.jpg" /></a></div>
<div class="img_boxw">
            	<h2>Actionfoxñ��Χ�����</h2>
                <p>��ţ�340-1246 �г��ۣ�258Ԫ</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78724-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot2.jpg" /></a></div>
<div class="img_boxw">
            	<h2>CARAVA Ƥ������</h2>
                <p>��ţ�552082 �۸�468Ԫ</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=78731" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot3.jpg" /></a></div>
<div class="img_boxw">
            	<h2>  sandstone ����Ƥ������</h2>
                <p>��ţ�821-0048 �۸�399Ԫ</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=78745" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot4.jpg" /></a></div>
<div class="img_boxw">
            	<h2>��ʯ���뾨˯��</h2>
                <p>��ţ�N2320311250 �۸�971Ԫ</p>
            </div>
</div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/portal.php?mod=view&amp;aid=78740" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot5.jpg" /></a></div>
<div class="img_boxw">
            	<h2>KingCamp������</h2>
                <p>��ţ�KC3849 �۸�298Ԫ</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78721-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot6.jpg" /></a></div>
<div class="img_boxw">
            	<h2>Yisijia Ƥ������</h2>
                <p>��ţ�615112738 �۸�428Ԫ</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78493-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot7.jpg" /></a></div>
<div class="img_boxw">
            	<h2>˼����Ů������</h2>
                <p>��ţ�F3026339 �۸�1090Ԫ</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://bbs.8264.com/forum.php?mod=viewthread&amp;tid=1345972" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot8.jpg" /></a></div>
<div class="img_boxw">
            	<h2>��ɽ��ɳ̲��</h2>
                <p>��ţ�CKFX 02 </p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://bbs.8264.com/portal.php?mod=view&amp;aid=78577" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot9.jpg" /></a></div>
<div class="img_boxw">
            	<h2>��˹�� Ь������</h2>
                <p>��ţ�KLL-03-2PK01 �۸�12Ԫ</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78527-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot10.jpg" /></a></div>
<div class="img_boxw">
            	<h2>KROCEUSŮʿ�����</h2>
                <p>��ţ�12BEOTL033 �۸�1090Ԫ</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78562-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot11.jpg" /></a></div>
<div class="img_boxw">
            	<h2>Actionfox ���米��</h2>
                <p>��ţ�414-1261 �۸�368Ԫ</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78783-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/hot12.jpg" /></a></div>
<div class="img_boxw">
            	<h2>ROYALWAY �����</h2>
                <p>��ţ�ROM3137CS �۸�898Ԫ</p>
            </div>
        </div>
        <div class="clear"	></div>
    </div>
</div>
    <div class="tilte">����װ���Ƽ�<br />Bag Product Recommendation</div>
    <div class="min4">
    	<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78498-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag1.jpg" /></a></div>
<div class="img_boxw">
            	<h2>̽·��45L����</h2>
                <p>��ţ�TEBA90010 �۸�899Ԫ</p>
            </div>
        </div>
<div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78493-page-3.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag2.jpg" /></a></div>
<div class="img_boxw">
            	<h2>˼����Nikita38L����</h2>
                <p>��ţ�z3321031 �۸�686</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78785-page-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag3.jpg" /></a></div>
<div class="img_boxw">
            	<h2>���ߵѳ��ᱳ��</h2>
                <p>����;ZXA1224004 �۸�798Ԫ</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://www.8264.com/viewnews-78785-page-2.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag4.jpg" /></a></div>
<div class="img_boxw">
            	<h2>���ߵ��ȷ汳��</h2>
                <p>���ţ�ZXA1224004 �۸�798Ԫ</p>
            </div>
        </div>
        <div class="img_box">
        	<div class="img_boxt"><a href="http://detail.tmall.com/item.htm?spm=a1z10.3.17.15&amp;id=13110961162&amp;" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/201208_8264_zt/images/img_bag5.jpg" /></a></div>
<div class="img_boxw">
            	<h2>Doite��ɽ��</h2>
                <p>��ţ�6653  �۸�742Ԫ</p>
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
    <div class="bottom2"><a href="http://www.8264.com/about-index.html" target="_blank">8264���</a>&nbsp;|&nbsp;<a href="http://www.8264.com/about-contact.html" target="_blank">��ϵ����</a>&nbsp;|&nbsp;<a href="http://www.8264.com/about-adservice.html" target="_blank">������</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">�����ȵ�</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">������ַ��ȫ</a>&nbsp;|&nbsp;<a href="http://www.8264.com/sitemap" target="_blank">��վ��ͼ</a><br><a href="http://bx.8264.com" target="_blank"><span>�����з��գ�8264����������</span></a> <a href="http://bx.8264.com"><span>���Ᵽ��</span></a><br>          ���˽�ӡʲô�������� ������Ӱʲô�������ߣ���ӭ����ý��ת�����ǵ�ԭ����Ʒ[ת����ע������]��8264&nbsp;��Ȩ����   <a href="http://www.miibeian.gov.cn/" target="_blank">��ICP��05004140��-10</a>&nbsp;&nbsp;&nbsp;<a href="/template/8264/image/icp.jpg" target="_blank">ICP֤ ��B2-20110106</a></div>
</div>
</body>
</html>