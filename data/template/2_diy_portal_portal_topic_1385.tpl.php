<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>2011�����̽���÷��ϱ���·��</title>
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
<body>
<div class="nav">
    	<a href="#" class="navone">����</a>
        <a href="#">���¶�̬</a>
        <a href="#">�ʵ�·��</a>
        <a href="#">�ʵ��ճ�</a>
        <a href="#">�ʵǶ�Ա</a>
        <a href="#">�����</a>
        <a href="#">���÷����</a>
        <a href="#">ͼƬ��</a>
        <div class="clear"></div>
    </div>
    <!--|||||||||||||||||nav����||||||||||||||||||||||||-->
    <div class="hb">
    	<div class="mian">
        	<div class="mianl">
            	<div id="myFocus" class="mF_expo2010">
                       <div class="loading"><span></span></div>
                        <!--���뻭��-->
                        	<ul class="pic">
                        		<!--�����б�-->
                                <li> <a href="http://www.8264.com/viewnews-71724-page-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/6.jpg"/></a></li>
                                <li> <a href="http://www.8264.com/viewnews-71724-page-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/5.jpg"/></a></li>
                                <li> <a href="http://www.8264.com/viewnews-71193-page-4.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/4.jpg"/></a></li>
                        		<li> <a href="http://bbs.8264.com/thread-336798-1-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/1.jpg"/></a></li>
                        		     <!--alt������Ϊ����-->
                        		<li> <a href="http://bbs.8264.com/thread-336798-1-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/2.jpg"/></a></li>
                        		<li> <a href="http://bbs.8264.com/thread-336798-1-1.html"target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/lunbo/3.jpg"/></a></li>
                      		</ul>
                </div>
                <!--||||||||||||||||||||�ֲ�����|||||||||||||||||||||||||||||-->
              	<div class="mianl_1">
                		<div class="mianl_1t">
                        	<span>�����</span>
                            <a href="http://www.8264.com/viewnews-70751-page-3.html" target="_blank">����>></a>
                        </div>
                        <div class="mianl_1w">
                        	<p>
                            	<span>��&nbsp;&nbsp;&nbsp;&nbsp;�</span>���<br />
                          <span >ְ&nbsp;&nbsp;&nbsp;&nbsp;ҵ��</span>The North Face�����˶�Ա,�������������Ļ����޹�˾�ܾ���,�����˶���ѵ����,��ɽ��<br />
                                <span >����ͣ�</span>�ߺ��μ����Ͱ�����˹��ʽ�ʵ�<br />
                                <span >�ʱ�䣺</span>10��31--11��5��<br />
                                <span >��ص㣺</span>�Ĵ�ʡ�Ĺ���ɽ�羰���Ĺ���ɽ���÷壨6250�ף�<br />
                                <span >����ݣ�</span>���������������ð�����˹��ʽ�ʵ�����ɽ�������Ĺ���ɽ���÷壬�����ʵ�����������ѡ��·�߳��ԵǶ�������ɹ����������Ĺ���ɽ���÷���·�ߣ�������Ϊ������İ�����˹��ʽ�Ƕ�����ɽ�塣<br />
                                <span >����㣺</span><br />
                                <span >1��</span>�Ĺ���ɽ���÷�����ɽ�߱ڶ����ڹ����⼫���ʵ���������ʢ�����͹����ʵǽ���ʵ���ʷ������ֻ��2005���й����״β���Χ���ķ�ʽ�������һ���״εǶ���2009�꣬�����������ʵ�����ϣ��������϶����������ϱ��Դ�·��&ldquo;����֮��&rdquo;�Ƕ���<br />
                                <span >2��</span>�����2006��10�£�2008��11�£�2009��11�·ݷֱ������ɽ��������ʵǡ�����06�����ڼ���̫�磬���¸ߵ�����ʯ��ѩ���ض�������08�꣬���ڴ�����������⣬��ʱ�Ĵ��Ǵ�5700�״�������09�꣬����4����������ķ�ʽ�ʵǣ��ھ��붥��100�׵�6140�״������ڴ�磬Ϊ�˷�ֹ���˶������������������Ĵ��ʵǣ����ڱصã���һ�ֻع�Ҳ�Ƕ�һ�δ��ʵǵ�һ�����������кܺõ�����͹����ԡ�<br />
                                <span >3��</span>�����ʵ������߹����ʵǽ�ĳ����������ʵ�����ܹ��ɹ���ͨ����¼Ƭ�ķ�ʽ�����չ�֣���Ȼ�ڹ����ʵǽ�����䶯��
                            </p>
                        </div>
                </div>
            <!--||||||||||||||||||||||||||||||||||||||||mianl_1����||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
                <div class="mianl_2">
                		<div class="mianl_2t">
                        		<span>�ʵǶ�Ա</span>
                        </div>
                        <div class="mianl_2w">
                           <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/renwu/sunbin.jpg" />
                           <p>
       ���������<br />
�������£�1978��&nbsp;&nbsp;���᣺�㽭����&nbsp;&nbsp;ѧ������ѧ����<br />
.2006��10�£�2008��11�£�2009��11�·������γ����ʵ����÷�<br />
.06�����ڼ���̫�磬���¸ߵ�����ʯ��ѩ���ض�������08�꣬���ڴ�����������⣬��ʱ�Ĵ��Ǵ�5700�״�������09�꣬�ھ��붥��100�׵�6140�״���Ϊ�˷�ֹ���˶�����<br />
                            <a href="http://www.8264.com/viewnews-70745-page-1.html" target="_blank"> ����>></a>

                           </p>
                        </div>
                		<div class="mianl_2w">
                           <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/renwu/lizongli.jpg" />
                           <p>
                           		������������<br />
�������£�1979��11��&nbsp;&nbsp;���᣺����&nbsp;&nbsp;ѧ������ѧ����<br />
.1992�������Ĵ�ʡ�����ִ�������ѵ��ʮ�ꡣ<br />
.2006����2008���ҵ���й��߼���ɽ�˲���ѵ�࣬���й������ĵ�һ���ɷ���������������ȫ�Ѳ���ѵ��ְҵ��ɽ�򵼣������ң��ʱ�����ɽ��ѩ����ɽ�򵼣���Ԯ�ȶ�������<br />
                              <a href="http://www.8264.com/portal.php?mod=view&amp;aid=70746" target="_blank"> ����>></a>

                           </p>
                        </div>
                </div>
             </div>
             <!--|||||||||||||||||||mianl����||||||||||||||||||||||||-->
             <div class="mianr">
               <div class="mianr_1"> <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/y1.jpg" />
                 <ul>
                   <li><a href="http://www.8264.com/viewnews-71724-page-1.html" target="_blank">.���֮·-2011����������Ĺ������÷��ʵǱ��� </a></li>
                   <li><a href="http://www.8264.com/viewnews-71518-page-1.html" target="_blank">.������Ϣ������13�ճɹ��Ƕ����ò��Ѱ�ȫ�³� </a></li>
                   <li><a href="http://www.8264.com/viewnews-71481-page-1.html" target="_blank">.��Ѷ����������������ϱ�ֱ����·�ߵǶ����� </a></li>
                   <li><a href="http://www.8264.com/viewnews-71479-page-1.html" target="_blank">.�������÷�12������������Ϣ ���쿪ʼ�嶥 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71460-page-1.html" target="_blank">.������������÷��ϱ���·���ʵǣ����ִ�5900 </a></li>
                   <li><a href="http://www.8264.com/viewnews-71422-page-1.html" target="_blank">.������������÷��ϱ���·���ʵǣ�10���ʵǿ�ʼ </a></li>
                   <li><a href="http://www.8264.com/viewnews-71289-page-1.html" target="_blank">.������������÷��ϱ���·���ʵǣ�ɽ�������� </a></li>
                   <li><a href="http://www.8264.com/viewnews-71257-page-1.html" target="_blank">.������������÷��ϱ���·���ʵǣ�������Ӫ </a></li>
                   <li><a href="http://www.8264.com/viewnews-71210-page-1.html" target="_blank">.������������÷��ϱ���·���ʵǣ��ִ���¡ </a></li>
                   <li><a href="http://www.8264.com/viewnews-71217-page-1.html" target="_blank">.2009��������÷��ϱڡ����֮·���ʵ���Ƶ </a></li>
                   <li><a href="http://www.8264.com/viewnews-71193-page-1.html" target="_blank">.������������÷��ϱ���·���ʵǣ�ǰ����¡ </a></li>
                   <li><a href="http://www.8264.com/viewnews-71116-page-1.html" target="_blank">.������������÷��ϱ���·���ʵǣ�������� </a></li>
                   <li><a href="http://www.8264.com/viewnews-71075-page-1.html" target="_blank">.2011�����̽���÷��ϱ���·�߼������� </a></li>
                   <li><a href="http://www.8264.com/viewnews-71082-page-1.html" target="_blank">.����߽������� ����7+2���վ�����[ͼ] </a></li>
                   <li><a href="http://www.8264.com/viewnews-70751-page-1.html" target="_blank">.2011���Ĺ���ɽ�۷��ϱ�ֱ���ʵǼƻ����� </a></li>
                   <li><a href="http://www.8264.com/viewnews-70745-page-1.html" target="_blank">.2011�����̽���÷��ϱ���·�߶�Ա-��� </a></li>
                   <li><a href="http://www.8264.com/viewnews-70746-page-1.html" target="_blank">.2011�����̽���÷��ϱ���·�߶�Ա-������ </a></li>
                   <li><a href="http://bbs.8264.com/thread-336798-1-1.html" target="_blank">.���֮·--���Ĺ���ɽ���÷���ʵ�[��ͼ]</a></li>
                   <li><a href="http://www.8264.com/viewnews-38830-page-1.html" target="_blank">.���ҵ�ɽ�ӽ���������÷��ʵǱ���[��ϸ��]</a></li>
                   <li><a href="http://www.8264.com/viewnews-57790-page-1.html" target="_blank">.Զ����ʿ����山�� ������Ƕ������[ͼ]</a></li>
                   <li><a href="http://www.8264.com/viewnews-68764-page-1.html" target="_blank">.����ҵ������ǽ����й������˶�רҵѧУ</a></li>
                 </ul>
               </div>
               <div class="mianr_2">
<div class="mianr_2t">
                            		<span>�ʵ�·��</span>
                            </div>
                            <div class="mianr_2w"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/jiefangzhilu.jpg" /></div>
                    
                    </div>
                    <div class="mianr_3"></div>
                    <div class="mianr_4">
                    		<div class="mianr_4t">
                            		<span>�����</span>
                            
                            </div>
                            <ul>
                                    <li>
<a href="http://www.8264.com/40279.html" target="_blank">.��� --һ��׷��� ׷��������climber</a></li>
                                    <li>
<a href="http://www.8264.com/viewnews-14003-page-1.html" target="_blank">.������ѵ����:�����������ܿ�ʹ[��ͼ]</a></li>
                                    <li>
<a href="http://www.8264.com/viewnews-38830-page-1.html" target="_blank">.���ҵ�ɽ�ӽ���������÷��ʵǱ���[��ϸ��]</a></li>
                                    <li>
<a href="http://bbs.8264.com/thread-336798-1-1.html" target="_blank">.���֮·--���Ĺ���ɽ���÷���ʵ�[��ͼ]</a></li>
                                    <li>
<a href="http://www.8264.com/viewnews-57790-page-1.html" target="_blank">
.Զ����ʿ����山�� ������Ƕ������[ͼ]</a></li>
                            		<li>
<a href="http://www.8264.com/54324.html" target="_blank">.�����ӳ�����������߷��������[��ͼ]</a></li>
                            </ul>
                    </div>
                    
             </div>
             <div class="clear"></div>            
        </div>
        <!--|||||||||||||||||||||mian ����|||||||||||||||||||||||||||-->
        <div class="js">
    		<div class="jst">
            		<span>���÷����</span>
                    <div class="clear"></div>
            </div>
            <div class="jsx">
            	<div class="jsx_l">
            	  <img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/datu.jpg" />
            	  <p>
                   	  &nbsp;&nbsp;&nbsp;&nbsp;�Ĺ���ɽ���÷壬����ľ��䣬�����ʵǵ�������һ������ʵ��񻰺ʹ����ɽ��һ�������ʵ������������Ľ��ţ�������ǰҪôѡ���ѣ�Ҫôһ�����С������������й�һ���ʵ��ߵ�ӡ�ǣ�Ҳ����ʧ���ߵ���ˮ��ֻ�������������;��ĵ��ʵ����ܹ�ժ����������...... <a href="http://bbs.8264.com/thread-718181-1-3.html" target="_blank">����>></a>                     
                    </p>
                </div>
                <div class="jsx_r">
                    <div class="lian">
                        <div class="img_b"><a href="http://www.8264.com/viewnews-4395-page-1.html " target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/1.jpg" /></a></div>
                        <div class="img_w"><a href="http://www.8264.com/viewnews-36121-page-1.html " target="_blank">��ɽ֮��-���÷�Ƕ���ʷ��¼</a></div>
                    </div>
                    <div class="lian">
                        <div class="img_b"><a href="http://bbs.8264.com/thread-12007-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/2.jpg" /></a></div>
                        <div class="img_w"><a href="http://bbs.8264.com/thread-12007-1-1.html" target="_blank">�����׵�-���÷��ʵ�ȫ����ͼ</a></div>
                    </div>
                    <div class="lian">
                        <div class="img_b"><a href="http://www.8264.com/35135.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/3.jpg" /></a></div>
                        <div class="img_w"><a href="http://www.8264.com/35135.html" target="_blank">���������÷�����ɽ���׵�</a></div>
                    </div>
                    <div class="lian">
                        <div class="img_b"><a href="http://www.8264.com/46785.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2011sgniang/images/yaom/4.jpg" /></a></div>
                        <div class="img_w"><a href="http://www.8264.com/46785.html" target="_blank">�϶����������÷������ϱ���·��</a></div>
                    </div>
<div class="clear"></div>
              	</div>
            </div>
    	</div>
        <div class="tj">
        		<div class="tjt">
                		<span>�ʵ�ͼƬ��</span>
                        <a href="#">����>></a>
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
    	<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264���</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank" >������</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">�����ȵ�</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">��ϵ��ʽ</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank" >QQȺ����</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">������ַ��ȫ</a><br>
          �������ߣ�022-23708264&nbsp;|&nbsp;���棺022-23857291&nbsp;|&nbsp;��ַ������л�Է��ҵ԰����ï�Ƽ�԰C2��6��AB��Ԫ<br>
          <a href="http://bx.8264.com" target="_blank">�����з��գ�8264����������</a> <a href="http://bx.8264.com">���Ᵽ��</a><br>
          ���˽�ӡʲô�������� ������Ӱʲô�������ߣ���ӭ����ý��ת�����ǵ�ԭ����Ʒ[ת����ע������]��8264&nbsp;��Ȩ����   <a href="http://www.miibeian.gov.cn/" target="_blank">��ICP��05004140��-10</a>&nbsp;&nbsp;&nbsp;<a href="http://www.8264.com/template/8264/image/icp.jpg" target="_blank">ICP֤ ��B2-20110106</a>
    </div>
</body>
</html>