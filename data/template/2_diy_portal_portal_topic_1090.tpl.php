<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>神雕侠驴笑傲户外--2008情人节专题</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="http://static.8264.com/oldcms/moban/zt/lovewall/style/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://static.8264.com/oldcms/moban/zt/lovewall/css/style.css" type="text/css">
<link rel="stylesheet" href="http://static.8264.com/oldcms/moban/zt/lovewall/css/default.css" type="text/css">
<style type="text/css">
<!--
body {
background-image: url(bg.gif);
}
-->
</style>
<SCRIPT language="JavaScript1.2">
var Obj=''
var index=10000;//z-index;
document.onmouseup=onMouseUp
document.onmousemove=onMouseMove
function onMouseDown(Object){
Obj=Object.id
document.all(Obj).setCapture()
pX=event.x-document.all(Obj).style.pixelLeft;
pY=event.y-document.all(Obj).style.pixelTop;
}

function onMouseMove(){
if(Obj!=''){
document.all(Obj).style.left=event.x-pX;
document.all(Obj).style.top=event.y-pY;
}
}

function onMouseUp(){
if(Obj!=''){
document.all(Obj).releaseCapture();
Obj='';
}
}

function onFocus(obj){
       if(obj.style.zIndex!=index) {
               index = index + 2;
               var idx = index;
               obj.style.zIndex=idx;
       }
}

function onRemove(){
if (event){
lObj = event.srcElement ;
n=0;
while (lObj && n<2) {
lObj = lObj.parentElement ;
if(lObj.tagName=="DIV") n++;

}
}
var id=lObj.id
document.getElementById(id).removeNode(true);

}

function showLogin(n) {
var formAry = new Array ("formOne","formTwo")
var Obj = getObject(formAry[n])
if (Obj.style.display == "none") {
Obj.style.display = ""
}
else 
{
Obj.style.display = "none"
}
}

function getObject(objectId) {
    if(document.getElementById && document.getElementById(objectId)) {
// W3C DOM
return document.getElementById(objectId);
    } else if (document.all && document.all(objectId)) {
// MSIE 4 DOM
return document.all(objectId);
    } else if (document.layers && document.layers[objectId]) {
// NN 4 DOM.. note: this won't find nested layers
return document.layers[objectId];
    } else {
return false;
    }
}

function chkFM(obj) {
alert(obj.nickname.value);
if(obj.nickname.value == "") {
alert("\n\n\n请输入需要寻找人的署名!\n\n");
obj.nickname.focus();
return false;
}
return false;
}
</SCRIPT>
<style>
body {margin-left: 0px;margin-top: 0px;margin-right: 0px;margin-bottom: 0px;text-align:center;font-size:12px; color:#333333;}
</style>
</head>
<body>
<div class="warpper99">
    <div class="top99"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/banner.jpg" width="960" height="326" border="0"/></div>
    <div class="mid99">
    	<div class="left99"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#c5a6d2 solid 1px;">
  <tr>
    <td height="30" align="center" valign="middle" style="border-bottom:#999999 dotted 1px;"><span style="font-size:14px; font-weight:bold; text-align:center;">浪漫一刻</span></td>
    </tr>
  <tr>
    <td align="center" valign="middle"><table width="98%" border="0" cellspacing="0" cellpadding="0" style=" border-bottom:#999999 dotted 1px;">
      <tr>
        <td height="20" colspan="2" align="center" style="padding-top:2px;"><a href="http://bbs.8264.com/thread-48281-1-1.html" target="_blank">雪中浪漫</a></td>
        </tr>
      <tr>
        <td height="135" align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/01.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;"/></td>
        <td align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/02.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;" /></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td align="center" valign="middle"><table width="98%" border="0" cellspacing="0" cellpadding="0" style=" border-bottom:#999999 dotted 1px;">
      <tr>
        <td height="20" colspan="2" align="center" style="padding-top:2px;"><a href="http://bbs.8264.com/thread-82913-1-1.html" target="_blank">我们去度假</a></td>
        </tr>
      <tr>
        <td height="135" align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/04.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;"/></td>
        <td align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/03.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;" /></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td align="center" valign="middle"><table width="98%" border="0" cellspacing="0" cellpadding="0" style=" border-bottom:#999999 dotted 1px;">
      <tr>
        <td height="20" colspan="2" align="center" style="padding-top:2px;"><a href="http://bbs.8264.com/thread-83867-1-1.html" target="_blank">相识相恋</a></td>
        </tr>
      <tr>
        <td height="135" align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/06.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;"/></td>
        <td align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/05.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;" /></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td align="center" valign="middle"><table width="98%" border="0" cellspacing="0" cellpadding="0" style=" border-bottom:#999999 dotted 1px;">
      <tr>
        <td height="20" colspan="2" align="center" style="padding-top:2px;"><a href="http://bbs.8264.com/viewthread.php?tid=87223&amp;extra=page%3D1%26amp%3Bfilter%3Dtype%26amp%3Btypeid%3D13" target="_blank">我们的爱</a></td>
        </tr>
      <tr>
        <td height="135" align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/07.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;"/></td>
        <td align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/08.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;" /></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td align="center" valign="middle"><table width="98%" border="0" cellspacing="0" cellpadding="0" style=" border-bottom:#999999 dotted 1px;">
      <tr>
        <td height="20" colspan="2" align="center" style="padding-top:2px;"><a href="http://bbs.8264.com/viewthread.php?tid=86177&amp;extra=page%3D1%26amp%3Bfilter%3Dtype%26amp%3Btypeid%3D13" target="_blank">携手一生</a></td>
        </tr>
      <tr>
        <td height="135" align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/09.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;"/></td>
        <td align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/10.jpg" width="150" height="125" border="1" style="border:#999999 solid 1px;" /></td>
      </tr>
    </table></td>
    </tr>
</table></div>
        <div class="right99">
        <div style=" width:95%; padding:5px 5px 5px 5px; border:#999999 dotted 1px; line-height:1.5; text-align:left; margin-bottom:10px; background:#FFC6E9;"><b>[编者按]</b>08年的情人节在不知不觉中已悄悄走近，为了迎接这个浪漫的日子，我们特意为亲爱的“驴友”们制作了一组情人节专题??“神雕侠‘驴’ 笑傲户外”。<br>在这里不仅有驴友们的情侣秀展示，还会介绍多款户外情侣装备……<br>爱是一种感受，爱是一种体会，但爱更要大声地表达。08情人节，你有什么话要对他（她）说，可以在我们这里贴上你的留言，让“驴友”们一起见证！</div>
        <!--爱墙程序开始-->
<div id="bar">
<!--找回纸条弹出菜单-->
<div class="form" id="formOne" style="display:none">
<form name=schFM1 action="index.php" method="post" onsubmit="return chkFM(this.form);">
<input type="hidden" name="search" value="1">
<input type="text" value="输入用户署名" name="nickname" class="input" onclick="javascript:this.form.nickname.value=''"/><br />
将出现要找的纸条<br>
<input type=image src="http://static.8264.com/oldcms/moban/zt/lovewall/images/submit.gif" width="45" height="19" alt="" border="0" />
</form>
</div>
<!--找回纸条弹出菜单-->
<span class="white">已有留言 140条，赶紧贴上你想对他（她）说的话&nbsp;<img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/ico_smile.gif" align="absmiddle"></span>
</div>
<div id="contentarea">
<!----------------------------------------->
<DIV onmousedown="onFocus(this)" id="cc61" class="scrip1">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc61)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[61]条 2008-02-04 10:36:40　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">情人节让老公省下买玫瑰的钱，给我买香水，哈哈！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">从浪漫到现实</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc62" class="scrip6">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc62)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[62]条 2008-02-04 10:44:23　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">亲爱的，能给我买好多好多好东东么？我会乖乖的~~~~</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">乖乖</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc63" class="scrip5">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc63)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[63]条 2008-02-04 13:05:09　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">亲爱的妞妞宝贝，新的一年又到了，在这个浪漫的日子，送上我对你最深沉的爱和祝福：希望我的妞妞小宝贝每天都开心快乐，越来越漂亮，充满活力，永远健康。</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_20.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">地瓜</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc64" class="scrip1">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc64)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[64]条 2008-02-04 14:54:33　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝愿天下所爱的和被爱着的人,相互扶携,共同走完美好的一生...

珍惜所有,百锤不变的真理! HAPPY SATIN VALENTINE'S DAY</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_16.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">FRED</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc65" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc65)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[65]条 2008-02-04 18:45:14　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">123</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_14.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">hoho</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc66" class="scrip4">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc66)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[66]条 2008-02-04 20:48:24　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">心想事成</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_14.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">拉锁</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc67" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc67)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[67]条 2008-02-05 09:08:56　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">怎么就没有大胆表白的呢？！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">不解</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc68" class="scrip5">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc68)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[68]条 2008-02-05 11:13:00　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">神啊&nbsp;&nbsp;给我赐个妞来吧。。</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_12.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">jaty</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc69" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc69)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[69]条 2008-02-05 15:10:21　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">愿大家在新的一年里都能找到自己的另一半，当然小朋友除外^_^</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">kim</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc70" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc70)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[70]条 2008-02-05 15:10:52　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝所有驴友，有情人终成眷属</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_14.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">tony</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc71" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc71)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[71]条 2008-02-05 19:29:06　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">不错/我爱四川</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_16.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">盟友</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc72" class="scrip6">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc72)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[72]条 2008-02-05 21:24:22　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">倩英,新年快乐,I LOVE U</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_20.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">超</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc73" class="scrip6">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc73)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[73]条 2008-02-05 21:39:11　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝天下有情人终成眷属！！
也祝我爱的人，天天快乐！健健康康的！&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 嘿嘿</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_21.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">果</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc74" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc74)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[74]条 2008-02-06 12:55:31　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我的那个她是不会来这里的```默默的说下我喜欢和你在一起</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">黑翼</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc75" class="scrip5">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc75)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[75]条 2008-02-07 09:18:32　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">情人节？</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">酷</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc76" class="scrip5">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc76)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[76]条 2008-02-07 12:34:15　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我的那个他，你我会在这里相遇嘛?期望家人身体健康，朋友以及自己一切安好！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_19.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">小鱼</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc77" class="scrip5">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc77)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[77]条 2008-02-07 13:11:36　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">亲爱的乖乖，让我能在08新年遇见你，我会好好去爱你~~~</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_21.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">兜兜熊</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc78" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc78)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[78]条 2008-02-07 20:08:01　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">女孩都是可爱的。。。。。。</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">晚起的虫</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc79" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc79)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[79]条 2008-02-08 01:14:10　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">ＢＡＯ　</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc80" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc80)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[80]条 2008-02-08 01:18:52　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你，猫咪</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_16.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">熊猫</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc81" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc81)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[81]条 2008-02-08 16:21:44　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝愿爱我的人和我爱的人健健康康平平安安</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_14.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">牵手</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc82" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc82)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[82]条 2008-02-08 21:03:04　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">亲爱的豆豆：我爱你！永远！……希望从明年的这个时候起，我们可以永远在一起，再也不分离。</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_21.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">爱你的小花</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc83" class="scrip4">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc83)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[83]条 2008-02-08 22:12:48　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">只有懂得珍惜，才会知道拥有。。。。</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">愿做平常人</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc84" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc84)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[84]条 2008-02-09 15:23:00　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">张鹤：我爱你！希望我们能永远在一起，永不分开！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">孤?的弧线</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc85" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc85)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[85]条 2008-02-09 15:24:25　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">张鹤：我爱你！希望我们能永远在一起，永不分开！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_21.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">孤?的弧线</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc86" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc86)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[86]条 2008-02-11 12:12:12　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你,HELEN,我08年的梦想就是得到HELEN的青睐.</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">邱汉新</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc87" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc87)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[87]条 2008-02-11 16:28:29　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">08,我想和你一起去亚丁</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_20.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">一个人天荒地老</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc88" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc88)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[88]条 2008-02-11 16:30:00　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">梦想:08在亚丁见证你我的爱情</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_20.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">一个人天荒地老</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc89" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc89)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[89]条 2008-02-12 08:59:16　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝福所有的情人节日快乐！希望自己能在今年找到另一半！呵呵～</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_21.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">穿山豹热干面</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc90" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc90)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[90]条 2008-02-12 14:16:28　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你老婆我要带你环游世界</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">胖胖</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc91" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc91)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[91]条 2008-02-13 09:50:13　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">老婆老婆我爱你，就像老鼠爱大米。</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">大宝宝</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc92" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc92)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[92]条 2008-02-13 10:12:25　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">老婆，我想你</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_21.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">玄冰</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc93" class="scrip6">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc93)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[93]条 2008-02-13 10:36:51　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">老头子：

我爱你！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_17.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">金宝宝</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc94" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc94)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[94]条 2008-02-13 11:55:36　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">YY，我们会永远在一起的</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">你的YZ</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc95" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc95)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[95]条 2008-02-13 13:13:33　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">赶快抓紧时间^^^^^^^^^^^^^</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_22.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">UFO</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc96" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc96)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[96]条 2008-02-13 13:28:34　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我只想自由地活着....</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_17.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">鬼狼</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc97" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc97)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[97]条 2008-02-13 14:39:27　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇娇
都是你</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_19.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">都是你的名字</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc98" class="scrip6">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc98)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[98]条 2008-02-13 14:43:46　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">。。。。。。。。。。。。。。。。。。。。。。。。。。。。</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_13.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">老D</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc99" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc99)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[99]条 2008-02-13 14:44:09　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_13.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">tata</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc100" class="scrip1">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc100)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[100]条 2008-02-13 15:08:00　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">希望自己能找到一个可以与我执手听风、看雨、望日、醉月的人。呵呵。不过觉得好难好难。所以在这里只祝大家有情人终成眷属！！并好好的珍惜对方，找到自己喜欢的人不容易。</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_21.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">小碧</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc101" class="scrip5">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc101)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[101]条 2008-02-13 17:00:40　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">情人节了,没有好礼物,来点经济的,徒下步,手牵手.心更近了.好想在08年,事业更进一步,能够有更多的时间与银两陪老公陪女儿陪父母去户外,去感受大自然的美好.我要加油,我要努力.</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_13.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">100户外</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc102" class="scrip1">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc102)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[102]条 2008-02-13 23:13:51　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_12.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">痉挛</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc103" class="scrip1">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc103)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[103]条 2008-02-13 23:24:21　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_12.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">痉挛</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc104" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc104)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[104]条 2008-02-13 23:34:10　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你!情人节快乐!</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_12.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">汗颜哥哥</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc105" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc105)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[105]条 2008-02-14 09:46:53　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">121</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">222</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc106" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc106)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[106]条 2008-02-14 10:59:52　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">所有爱我的和我爱的人，都能快乐！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_19.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">玲</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc107" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc107)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[107]条 2008-02-14 11:35:49　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">没有情人的情人节</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">守夜人</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc108" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc108)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[108]条 2008-02-14 11:39:18　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">爱我的人天天快乐</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">光头</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc109" class="scrip3">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc109)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[109]条 2008-02-14 12:35:44　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝你永远快乐</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_12.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">铁佛</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc110" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc110)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[110]条 2008-02-14 13:41:59　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">许个愿望.....希望在2008年在到自己爱的人</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">无聊死的人</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc111" class="scrip3">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc111)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[111]条 2008-02-14 14:35:21　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">愿我的朋友们都有情人终成眷属</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">黛墨斋居士</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc112" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc112)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[112]条 2008-02-14 14:38:01　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">直接被抛弃的我，愿你幸福！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_20.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">11</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc113" class="scrip1">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc113)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[113]条 2008-02-14 16:42:36　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝我新的一年什么都好工作顺利，能找到一个喜欢的人，嘻嘻</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_21.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">爱儿</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc114" class="scrip6">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc114)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[114]条 2008-02-14 16:52:56　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你〔｛?去德、就?去吧’莪只想?新?始。。?｝&nbsp;&nbsp;&nbsp;&nbsp; {???该???, ?ㄋ?该???、} `¨‖洳? ．-要放?我 ┈_Ps: .?就不òò. 崾後悔 ○?ㄣ</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_16.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">?葑芯べ??</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc115" class="scrip5">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc115)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[115]条 2008-02-14 17:11:30　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">什么嘛！我只过没有情人的情人节，其它的免谈！??酷ルメェ！我靠！我拽！我玄！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">??酷ルメェ</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc116" class="scrip3">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc116)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[116]条 2008-02-14 17:29:18　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">情亻节？Ｐ！
　　　　　　　　　　　　　?莴?己???笙活
　　　　　　　　　这????</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_13.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">8ツ?ト?</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc117" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc117)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[117]条 2008-02-14 19:15:06　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝福各位情侣白头到老！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_13.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">聊鸽（神鹰）</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc118" class="scrip4">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc118)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[118]条 2008-02-14 19:53:01　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">希望下一个情人节不要再一个人过了，为自己加油！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_17.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">一剑</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc119" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc119)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[119]条 2008-02-14 22:22:19　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝愿大家情人节快乐，也祝愿自己在新的一年里有新的气象!呵呵</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_14.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">hengl</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc120" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc120)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[120]条 2008-02-15 01:09:03　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">今年情人节收到了一份最好的礼物.</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">5</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc121" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc121)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[121]条 2008-02-15 11:38:12　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">美好的事情总是稍纵即逝，so 请珍惜你所拥有的吧，祝有情人快乐</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_13.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">风</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc122" class="scrip6">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc122)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[122]条 2008-02-15 13:52:43　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">老公：
&nbsp;&nbsp;&nbsp;&nbsp;不去起士林吃西餐，改成水煮鱼其实也挺好的：）</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_15.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">mm</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc123" class="scrip1">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc123)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[123]条 2008-02-15 13:57:34　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">情人节那天，悄悄的送老婆一个礼物。</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_16.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">价值</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc124" class="scrip6">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc124)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[124]条 2008-02-15 15:02:34　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">情人节在悄无声息中度过：（</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_12.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">多多</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc125" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc125)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[125]条 2008-02-15 22:01:32　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">好浪漫，，好温馨，，，真心祝福！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">logofree</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc126" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc126)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[126]条 2008-02-19 15:24:32　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">只是365天中的一天，悄无声息的度过。希望明年能有些内容</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_16.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">苗苗</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc127" class="scrip4">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc127)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[127]条 2008-02-19 17:34:19　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">木木老婆我爱你</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_17.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">赵越</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc128" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc128)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[128]条 2008-02-24 12:32:23　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">啊</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_14.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">Kitty</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc129" class="scrip4">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc129)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[129]条 2008-04-11 21:14:36　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">因为工作的原因，我们99天不见了，尽管如此，我们还是彼此珍惜着对方，再过两个星期，三亚见！祝福我们，祝福小猴子，祝福所有的朋友！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_13.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">小鱼哈哈</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc130" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc130)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[130]条 2008-04-17 19:34:17　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你真是无聊&nbsp;&nbsp;我门离的太远 就是见不找你 你能来看我吗</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_16.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">袁国华</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc131" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc131)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[131]条 2008-04-30 12:37:41　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">UH</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc132" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc132)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[132]条 2008-05-08 04:15:49　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">love you</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc133" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc133)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[133]条 2008-05-19 23:35:56　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">想你的365天 豪</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">豪</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc134" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc134)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[134]条 2008-06-17 09:41:01　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">☆丹妮啊，我真的好想你，不知道你多会才能回来，亲爱的宝贝，我愿意爱你一生一世，都不变的☆</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">董鹏</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc135" class="scrip1">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc135)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[135]条 2008-06-17 14:39:55　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我的愿望是维护世界的和平!并且统一全人类!</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_20.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">宏人馆</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc136" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc136)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[136]条 2008-07-31 20:01:03　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">我爱你，小鱼哈哈！又好久不见了的！思念不知道变成了什么，但是我知道我真的很想你！有的时候真的很累，好想歇一歇，但是生活逼得我们不能停留！继续向前吧！ 也许生活原本就是如此！ 相信爱情能给我们带来期待的温暖！??祝愿我们，永远快乐！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">剑使独行</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc137" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc137)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[137]条 2008-08-07 09:46:15　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">美人，七夕快乐！本该是我们相会的日子哦！可是……我会想你的！</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_21.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">剑使独行</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc139" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc139)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[139]条 2008-08-07 15:48:47　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">谁都希望每个时候像谈恋爱时那么快乐,结婚后才发现我老公脾气很不好.</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">玛依娜</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc140" class="scrip7">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc140)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[140]条 2008-10-10 13:41:32　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">祝福</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">ww</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<DIV onmousedown="onFocus(this)" id="cc141" class="scrip2">
<TABLE border=0 cellpadding=0 cellspacing=0>
<TR>
<TD onmousedown="onMouseDown(cc141)" style="CURSOR: move" >
<div class="shead"><span onDblClick="onRemove()" title="双击关闭纸条">第[141]条 2008-10-10 16:56:03　<a style="CURSOR: hand" onclick="onRemove()" title="关闭纸条">×</a></span></div>
</TD>
</TR>
<TR>
<TD style="CURSOR:default">
<div class="sbody">fffff</div>
<div class="sbot"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/bpic_11.gif" class="left" border="0"><h2><a href="#"  style="font-size:16px;">fff</a></h2></div>
</TD>
</TR>
</TABLE>
</DIV>
<!----------------------------------------->
</div>
<!--end-->
        </div>
     <div class="bottom">
     	<table width="941" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:10px 0px 10px 0px;">
  <tr>
    <td colspan="6" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style=" padding-left:10px; font-size:14px; font-weight:bold; background:#ffd1f3; border-bottom:#999999 solid 1px; margin:5px 0px 5px 0px">
  <tr>
    <td height="25"><span style="font-size:14px; font-weight:bold;">我们爱在户外</span></td>
  </tr>
</table>
</td>
    </tr>
  <tr>
    <td align="center" valign="top"><table width="150" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="154" height="140" align="center" valign="middle" style="border:#666666 solid 1px;"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/1a.jpg" width="150" height="140" /></td>
      </tr>
      <tr>
        <td height="25" align="center" valign="middle">我们去郊游</td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="150" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="154" height="140" align="center" valign="middle" style="border:#666666 solid 1px;"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/2a.jpg" width="150" height="140" /></td>
      </tr>
      <tr>
        <td height="25" align="center" valign="middle">老公我那套装备</td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="150" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="154" height="140" align="center" valign="middle" style="border:#666666 solid 1px;"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/3a.jpg" width="150" height="140" /></td>
      </tr>
      <tr>
        <td height="25" align="center" valign="middle">装备买好秀一下</td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="150" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="154" height="140" align="center" valign="middle" style="border:#666666 solid 1px;"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/4a.jpg" width="150" height="140" /></td>
      </tr>
      <tr>
        <td height="25" align="center" valign="middle">手拉手去郊游</td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="150" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="154" height="140" align="center" valign="middle" style="border:#666666 solid 1px;"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/5a.jpg" width="150" height="140" /></td>
      </tr>
      <tr>
        <td height="25" align="center" valign="middle">在户外我们比翼双飞</td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="150" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="154" height="140" align="center" valign="middle" style="border:#666666 solid 1px;"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/6a.jpg" width="150" height="140" /></td>
      </tr>
      <tr>
        <td height="25" align="center" valign="middle">亲近自然</td>
      </tr>
    </table></td>
  </tr>
</table>
   	   <table width="98%" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px;">
  <tr>
    <td height="25" colspan="3" align="left" valign="middle" bgcolor="#FFD1F3" style="border-bottom:#999999 solid 1px;"><span style="font-size:14px; font-weight:bold;">&nbsp;&nbsp;情侣装备 对对碰</span></td>
    </tr>
  <tr>
    <td width="313" align="center" valign="middle" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:5px 0px 5px 0px;">
      <tr>
        <td align="center" valign="middle"><a href="http://shop.8264.com/brand-6-c0.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/11.gif" width="150" height="152" border="0" style=" border:#999999 solid 1px;"/></a></td>
        <td align="left" valign="top" style="padding:5px 5px 5px 5px; line-height:1.5;">抓绒衣也可以配对哦！这款抓绒衣有多多哦，采用的是粗细的羊羔绒面料，适合作为中间保暖层。款式修身，比一般的抓绒抗风能力强，打雪仗时穿着首选！</td>
      </tr>
    </table></td>
    <td width="314" align="center" valign="middle" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle"><a href="http://shop.8264.com/brand-60-c0.html" target="_blank";><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/12.gif" width="150" height="152" border="0" style=" border:#999999 solid 1px;"/></a></td>
        <td align="left" valign="top" style="padding:5px 5px 5px 5px; line-height:1.5;">OSPREY Crescent (月神)系列背包??男款70L，女款60L！它的诞生使舒适度和容量之间不再成为一对矛盾，因此，当仁不让的成为短途的最佳选择！是不是酷劲十足？</td>
      </tr>
    </table></td>
    <td width="314" align="center" valign="middle" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/13.gif" width="150" height="152" border="0" style=" border:#999999 solid 1px;"/></td>
        <td align="left" valign="top" style="padding:5px 5px 5px 5px; line-height:1.5;">路普（LOAP）情侣款式，浪漫温馨，各拼块均根据人体工程学精确设计，立体剪裁，力求舒适合体。背部的卡通图案为情侣们的户外生活增添了很多情趣。</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="middle" ><table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-top: #999999 dotted 1px; margin:5px 0px 8px 0px;">
      <tr>
        <td></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td align="center" valign="middle" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle"><a href="http://shop.8264.com/brand-35-c0.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/14.gif" width="150" height="152" border="0" style=" border:#999999 solid 1px;"/></a></td>
        <td align="left" valign="top" style="padding:5px 5px 5px 5px; line-height:1.5;">情侣帐篷之非常男女！SCALER的这款野营帐专为户外初级装备使用者设计和周末休闲旅游使用。款式简洁大方,使用方便,专为户外情侣的初级装备使用者设计和周末休闲旅游使用！</td>
      </tr>
    </table></td>
    <td width="314" align="center" valign="middle" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle"><a href="http://shop.8264.com/brand-35-c0.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/15.gif" width="150" height="152" border="0" style=" border:#999999 solid 1px;"/></a></td>
        <td align="left" valign="top" style="padding:5px 5px 5px 5px; line-height:1.5;">方便情侣使用，让情侣更贴心，它在使用的过程中，也可以分开两个睡袋单独使用，自备两个枕头，里料采用法兰绒，更贴近皮肤。??<strong>SCALER双人睡袋的自白书。</strong></td>
      </tr>
    </table></td>
    <td width="314" align="center" valign="middle" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle"><a href="http://shop.8264.com/brand-2-c0.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/lovewall/images/16.gif" width="150" height="152" border="0" style=" border:#999999 solid 1px;"/></a></td>
        <td align="left" valign="top" style="padding:5px 5px 5px 5px; line-height:1.5;">极星的这两款睡袋也不错啊，从颜色、款式上都蛮登对嘛！哈~~90%高蓬松度灰鹅绒保暖度非常之好！情人节出行的情侣驴们可以考虑一下哦~~</td>
      </tr>
    </table></td>
  </tr>
</table>
  </div>
  <div><style>
a{ text-decoration:none; color:#000000;}
a:hover{ text-decoration:underline;}

.bbb a{ color: #000000;text-decoration:none;}
.bbb a:hover{color:#cc0000;text-decoration:underline;}

</style>
<table width="958" border="0" align="center" cellpadding="0" cellspacing="0" style=" font-size:12px; margin-top:8px;" class="bbb">
  <tr>
    <td><table width="958" height="30" border="0" cellpadding="0" cellspacing="0" style="border-top:#686e5d solid 3px; background:#Cdd0c8;">
      <tr>
        <td align="center"><a href="http://www.8264.com/ziliao/about/aboutus.php"  >关于我们</a> | <a href="http://www.8264.com/list/531/" >联系我们</a> | <a href="http://www.8264.com/8954.html#pl"  >意见反馈</a> | <a href="http://www.8264.com/ziliao/sitemap.html"  >网站地图</a> | <a href="http://bbs.8264.com/forum-160-1.html"  >我要投稿</a> | <a href="http://www.8264.com/ziliao/about/ad2.php"  >广告服务</a> | <a href="http://www.8264.com/list/531/"  >编辑部的故事</a> | <a href="http://www.8264.com/sitelink/index.html" style="color:red">友情连接</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="20" align="center" valign="middle"><a href="http://www.8264.com/ziliao/about/ad2.php" style="color:red; font-weight:bold;">广告联系：022-23708264-818</a> Mail:admin8264.com <a href="http://www.miibeian.gov.cn/">津ICP备05004140号-1</a>   </td>
  </tr>
  <tr>
    <td height="20" align="center" valign="middle" style="color:#5f8c00;"> 户外是有风险的运动，8264提醒您务必注意安全问题</td>
  </tr>
  <tr>
    <td><table width="958" height="30" border="0" cellpadding="0" cellspacing="0" style="border:#004a9c solid 1px;">
      <tr>
        <td align="center" valign="middle"><span style="color:#004a9c;">合作项目：</span><a href="/">8264</a> | <a href="http://osm.8264.com/" target="_blank">户外经理人</a> | <a href="http://www.91ski.com/" target="_blank">就要滑雪网</a> | <a href="http://www.yododo.com/" target="_blank">游多多自助旅行网</a> | <a href="http://bbs.8264.com/" target="_blank">中国驴友论坛</a> | <a href="http://www.8844shop.com/" target="_blank">户外用品商城</a> | <a href="http://u.8264.com/" target="_blank">驴友录</a> | <a href="http://www.8264.com/pp/" target="_blank">户外美女</a> <div style="display:none;"><script src="http://js.tongji.cn.yahoo.com/141390/ystat.js" type="text/javascript" type="text/javascript"></script><noscript><a href="http://tongji.cn.yahoo.com"><img src="http://img.tongji.cn.yahoo.com/141390/ystat.gif"/></a></noscript></div></td>
      </tr>
    </table></td>
  </tr>
</table></div>
    </div>
<script type="text/javascript">
var elements = document.getElementById("contentarea").childNodes;
for (var i = 0; i < elements.length; i++) {
if(elements[i].tagName && elements[i].tagName=='DIV') {
elements[i].style.top = Math.ceil(350 * Math.random()) + "px"
elements[i].style.left = Math.ceil(360 * Math.random()) + "px";
}
}
</script>
</body>
</html>