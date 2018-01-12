// JavaScript Document
function changecon(obj,id,title,url,color){
$('id').value=id;
$('name').value = title;
$('href').value = url;
$('color').value = color;
$('color_btn').style.backgroundColor =color;
$('daohangname').innerHTML ="更 改";
}
function changeurl(obj,cid,urlid,title,url,color){
$('cid').value=cid;
$('urlid').value=urlid;
$('name').value = title;
$('href').value = url;
$('color').value = color;
$('color_btn').style.backgroundColor =color;
$('daohangname').innerHTML ="更 改";
}
function strLenCalcnew(obj, checklen, maxlen) {
	var v = obj.value, charlen = 0, maxlen = !maxlen ? 200 : maxlen, curlen = maxlen, len = strlen(v);
	for(var i = 0; i < v.length; i++) {
		if(v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255) {
			curlen -= charset == 'utf-8' ? 2 : 1;
		}
	}
	if(curlen >= len) {
		$(checklen).innerHTML = curlen - len;
	} else {
		obj.value = getInterceptedStr(v, maxlen);
	}
}
// 得到字符串的真实长度（双字节换算为两个单字节）
function getStrActualLen(sChars)
{
	return sChars.replace(/[^\x00-\xff]/g,"xx").length;
}
// 截取固定长度子字符串 sSource为字符串maxlen为长度
function getInterceptedStr(sSource, iLen)
{
	if(sSource.replace(/[^\x00-\xff]/g,"xx").length <= iLen)
	{
		return sSource;
	}

	var str = "";
	var l = 0;
	var schar;
	for(var i=0; schar=sSource.charAt(i); i++)
	{
		str += schar;
		l += (schar.match(/[^\x00-\xff]/) != null ? 2 : 1);
		if(l >= iLen)
		{
			break;
		}
	}

	return str;
}
function setdisplay(id){
	if(document.getElementById(id).style.display=='none') document.getElementById(id).style.display='block';
	else document.getElementById(id).style.display='none';
	}
function showedit(id,display){
	
	var objs=document.getElementById(id).getElementsByTagName('span');
	
	for(var i=0;i<objs.length;i++){
		//alert(objs[i].className);
		if(objs[i].className=='admin_edit'){
			if(display) objs[i].style.display='inline-block';
			else objs[i].style.display='none';
		}
		if(objs[i].className=='admin_del'){
			if(display) objs[i].style.display='inline-block';
			else objs[i].style.display='none';
		}
	}
}