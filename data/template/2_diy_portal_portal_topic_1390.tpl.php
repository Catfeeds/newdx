<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>The North Face ������Ʒ������</title>
</head>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/TNF/style.css"/>
<body>

<div class="wai">
<div class="banner"></div>
<div class="jiaodian">
        	<div class="lun">
        		<div id="myFocus" class="mF_expo2010">
            		<div class="loading"><span></span></div><!--���뻭��-->
            			<ul class="pic"><!--�����б�-->
                            <li><a href="#"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger3.jpg" /></a></li><!--alt������Ϊ����-->
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
</div>
            <div class="jiaodian1">
<div class="jiaodian_t">
                	<span>�����ע</span>
                    <em style="display:none"><a href="#" target="_blank">����>></a></em>
                </div>
                <div class="jiaodianw">
                            <h3>���롰�������ڲ� ��֤TNF������</h3>
                            <p>
                            ���ڻ������򾭳�����������ӣ����ڱ�������������������Ӱ�������ܴ���������Ҽ�֤��һ�����Ƶ�"����"������
</p>
                </div>
                <div class="jiaodianw" style="border-bottom:none;">
                		
                            <a href="http://bbs.8264.com/thread-1071029-4-1.html" target="_blank"><h3>TABS Pack��flashdry�Ƽ�ȫ������</h3></a>

<p>
 ������Ʒ���������ص�չʾ��ABS Pack��flashdry�������¿Ƽ�������ABS Pack�����ǹ���ѩ���Ľ���������Ʒ�������ɼ���ʤ��the north face��ǰ�г����κο�ɼ�����

</p>
                </div>
            </div>
            <div class="jiaodian2">
<div class="jiaodian_t" style="width:230px;">
                	<span>TNF������</span>
                    <em style="display:none"><a href="#" target="_blank">����>></a></em>
                </div>
                <div class="log"><a href="#" target="_blank"> <img src="http://static.8264.com/oldcms/moban/zt/TNF/images/logo.jpg" /></a></div>
                <div class="jiaodian2w">
                    	<h4>TNF2011����Ʒ������</h4>
                        <p>
                        ʱ�䣺2011��11��30��-12��3��<br />
�ص㣺�����ɽ�ɽ<br />
���⣺EXPERIENCE THE NORTH FACE <br />THE SUMMIT & EYOND
                    </p>
                </div>
            </div>
        </div>
        <div class="mian">
        	<div class="mianl">
<div class="mianl_t">
                	<span>The North Face �˶�Ա����</span>
                    <em><a href="http://www.thenorthface.com.cn/catalog/sc-brand/dean-karnazes.html
" target="_blank">����>></a></em>
                </div>
                <div class="mianl_js">
                		<div class="mianl_jst">
                			<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger22.jpg" /></a></div>
                        <div class="mianl_jsw">
                        	The North Face<br />
��Ϊ���ʻ���֪��Ʒ�ƣ�ӵ��ǿ����˶�Ա�Ŷӡ����а�����ɽ�˶�Ա�Ŷӡ������˶�Ա�Ŷӡ���ѩ�˶�Ա�Ŷ��Լ��������˶�Ա�Ŷӵȡ���Щ�˶�Ա�Ŷ�������DeanKarnazes������ս��������ͻ�Ƶ��������˶�Ա��Ҳ����ConradAnker����Ϊ����ִ��׷����ʵ��ߡ�
                        </div>
                </div>
                <div style="height:15px; display:inline;"></div>
                <div class="mianl_js">
                		<div class="mianl_jst">
                			<a href="http://www.thenorthface.com.cn/catalog/sc-brand/dean-karnazes.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger5.jpg" /></a></div>
                <div class="mianl_jsw">
                        	������Dean Karnazes<br />
������ʱ������־��Ϊ"ȫ����100λ���Ӱ����������֮һ�����Լ�����ͻ�Ƹ��˼��ޣ������������˶�Ա��ַ������ǵ�Ǳ�ܡ������Խ�����־������������"Dean Karnazes�����������������������ŵ����ԡ�"��Լ���ˮƽ�ͱ�������������ͬ���˶�Ա�������������İ������������ֶ������������Ե÷ǳ����ڲ�ͬ��
                        </div>
                </div>
                <div style="height:15px; display:inline;"></div>
                <div class="mianl_js">
                		<div class="mianl_jst">
                			<a href="#" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger6.jpg" /></a></div>
                        <div class="mianl_jsw">
                        	������Ian Mclntosh<br />
IanMclntosh�Ӳ������Լ���ϲ�ã���Ҳ��������Ϊ�˶�Ա���ص㡣"��ϲ����ɽ��ѩ��ϲ��������ɽ�ϻ�ѩ����ϲ����Щ�����ͻ�ת��������˵������ǻ�ѩ����Ȥ��ѡ��һ��ɽ��Ȼ��ʼ������ɽ��һֱ����ɽ�š�һֱ��ͣ���м������Ҫ�ڿշ�����ʱ�����ڿա�"24���Mclntosh��2�겻���Ϳ�ʼ��ѩ��
                        </div>
                </div>
                <div style="height:15px; display:inline;"></div>
                <div class="mianl_js" style="border-bottom:none;">
                		<div class="mianl_jst">
                			<a href="http://www.thenorthface.com.cn/catalog/sc-brand/conrad-anker.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger7.jpg" /></a></div>
                        <div class="mianl_jsw">
                        	������Conrad Anker<br />
��һ��˵��ConradAnker��ǿ������ʵ���������߼�����ս�ĵ��Ρ�Ϊ��׷�����Ŀ�꣬���Ӱ���˹�Ӻ��ϼ��޵�ɽ��һ·�ʵǵ����������ǺͰͷҵ��Ĵ��ұ��Լ�ϲ������ɽ����ΰ�߷塣Conrad���ϼ���̽�ճ���ʮ��֮�ã����������������ʳɹ���1997���ʵ��˵ش�Queen Maud Land����������2500Ӣ�ߵ�Rakekniven���ұڡ�
                        </div>
                </div>          
            </div>
            <div class="mianr">
            		<div class="mianr_1">
<div class="mianr_t">
                			<span>������Ѷ</span>
                    		<em style="display:none"><a href="#" target="_blank">����>></a></em>
                		</div>
                        <ul>
                        	<li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-15999214-fromuid-34626185.html" target="_blank">.TNF���λ����˵��һ���˶�Ա�����</a></li>
                            <li><a href="http://www.8264.com/viewnews-72108-page-1.html" target="_blank">.�¿Ƽ������ᡪABS��������</a></li>
                            <li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16121460-fromuid-34626185.html" target="_blank">.The North Face 50����������RACE</a></li>
                            <li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16005780-fromuid-34626185.html" target="_blank">.TNF�ֳ�չʾ�Ĳ�Ʒ�ܵ���ҵĻ�ӭ</a></li>
                            <li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16013618-fromuid-34626185.html" target="_blank">.TNF��ֳ����������������豸</a></li>
                            <li><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16118547-fromuid-34626185.html" target="_blank">.����� һ��ͽ�� ������������Χ</a></li>
                        </ul>
                    </div>
                    <div class="mianr_2">
<div class="mianr_t">
                			<span>����ͼ����Ѷ</span>
                    		<em style="display:none"><a href="#" target="_blank">����>></a></em>
                		</div>
                        <div class="mianr_2tu">
                        	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16013439-fromuid-34626185.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger4.jpg" /></a></div> 
                        <div class="mianr_2wen">
                            <p>
                            <a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16013439-fromuid-34626185.html" target="_blank">
&nbsp;��ѩ����ʱ�����������������ҵ����ñ�֤���帡����к��ѩ������������Ѹ������ѩ�����һ���ԣ������ܱ�֤����һ���ѩ���������ܡ���</a>
                            </p>
                        </div>      
                    </div>
            </div>
            
        </div>
        <div class="zongb">
        	<div class="title">
                <span>The North Face �ܲ�</span>
                <em><a href="#" target="_blank">����>></a></em>
            </div>
            <div class="tuw">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger8.jpg" /><br /><br />ǰ̨�Ӵ���Ϣ��</a>
            </div>
<div class="tuw">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger43.jpg" /><br /><br />�ڻ�չʾ��</a>
            </div>
<div class="tuw">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger10.jpg" /><br /><br />��ѩ��������</a>
            </div>
<div class="tuw">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger21.jpg" /><br /><br />����������</a>
            </div>
        </div>
        <div class="waituw" style="height:370px;">
        	<div class="title">
                <span>The North Face �ɽ�ɽ�콢��</span>
                <em><a href="http://www.8264.com/viewnews-72125-page-1.html" target="_blank">����>></a></em>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger11.jpg" /><br /><br />TNF�ɽ�ɽ�콢��</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger12.jpg" /><br /><br />��������徰��</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger13.jpg" /><br /><br />ЬƷ������</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger14.jpg" /><br /><br />����¡�ץ����</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger15.jpg" /><br /><br />����װ��չʾ</a>
            </div>
            			<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger16.jpg" /><br /><br />˯�������վ</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger17.jpg" /><br /><br />��������</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger18.jpg" /><br /><br />ͯװ������</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger19.jpg" /><br /><br />��ѩȫ��װ��</a>
            </div>
<div class="tuw1">
            	<a><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger20.jpg" /><br /><br />���ܷ�װչ</a>
            </div>
        </div>
<div class="waituw" style="height:350px;">
        	<div class="title">
                <span>The North Face ������</span>
                <em><a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1071029-pid-16121460-fromuid-34626185.html" target="_blank">����>></a></em>
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
                <span>The North Face ��Ʒ����</span>
                <em><a href="http://www.thenorthface.com.cn/catalog/index.html" target="_blank">����>></a></em>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/mens-jackets-vests/Mens-Elysium-Jacket.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger33.jpg" /><br /><br />���ӵ� �������� �п�</a>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/womens-jackets-vests/Womens-Closer-Triclimate-Jacket.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger34.jpg" /><br /><br />ŮʽTRICLIMATE�п�</a>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/womens-jackets-vests/Womens-Glitchin-Down-Jacket.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger35.jpg" /><br /><br />ŮʽGLITCHIN DOWN</a>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/mens-jackets-vests/Mens-Glitchin-Down-Jacket.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger36.jpg" /><br /><br />��ʽרҵ�ʵǹ��ܸ�</a>
            </div>
<div class="tuw2">
            	<a href="http://www.thenorthface.com.cn/catalog/sc-gear/womens-footwear/Womens-Destiny-Down.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger37.jpg" /><br /><br />���ʱ�ů��ϵ��ѥ</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059631-pid-15939910-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger38.jpg" /><br /><br />�пů����Ь</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059631-pid-15940309-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger39.jpg" /><br /><br />Ů��з��ѥ</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059687-pid-15940511-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger40.jpg" /><br /><br />Prophet 65����ɽ������</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059350-pid-15933672-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger41.jpg" /><br /><br />��ʽѩ�ر�ů����</a>
            </div>
<div class="tuw2">
            	<a href="http://bbs.8264.com/forum-redirect-goto-findpost-ptid-1059350-pid-15937023-fromuid-34626185.html"><img src="http://static.8264.com/oldcms/moban/zt/TNF/images/tiger42.jpg" /><br /><br />Ů������һ�п�</a>
            </div>
        </div>
        
        <div class="bottom">
    	<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">8264���</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/ggservice/index.html" target="_blank" >������</a>&nbsp;|&nbsp;<a href="http://www.8264.com/zhuanti" target="_blank">�����ȵ�</a>&nbsp;|&nbsp;<a href="http://www.8264.com/template/8264/about/aboutus.htm" target="_blank">��ϵ��ʽ</a>&nbsp;|&nbsp;<a href="http://bbs.8264.com/plugin.php?id=drc_qqgroup:main" target="_blank" >QQȺ����</a>&nbsp;|&nbsp;<a href="http://www.8264.com/link/" target="_blank">������ַ��ȫ</a><br>
          �������ߣ�022-23708264&nbsp;|&nbsp;���棺022-23857291&nbsp;|&nbsp;��ַ������л�Է��ҵ԰����ï�Ƽ�԰C2��6��AB��Ԫ<br>
          <a href="http://bx.8264.com" target="_blank">�����з��գ�8264����������</a> <a href="http://bx.8264.com">���Ᵽ��</a><br>
          ���˽�ӡʲô�������� ������Ӱʲô�������ߣ���ӭ����ý��ת�����ǵ�ԭ����Ʒ[ת����ע������]��8264&nbsp;��Ȩ����   <a href="http://www.miibeian.gov.cn/" target="_blank">��ICP��05004140��-10</a>&nbsp;&nbsp;&nbsp;<a href="http://www.8264.com/template/8264/image/icp.jpg" target="_blank">ICP֤ ��B2-20110106</a>
    </div>
        
</div>
</body>
</html>
