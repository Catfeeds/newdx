/*-------------全局变量-----------------------*/
//便于浏览器兼容
//暂时只有ie的用法,一定要考虑浏览器的兼容性
var ns = (document.layers)?true:false
var ie = (document.all)? true:false

/* 
*功能:	返回对对象的类型
*/ 
Object.prototype.getType = function(){
	return typeof(this);	
}
/* 
*功能:	返回对对象的所有属性和方法
*/ 
Object.prototype.getAll = function(){
	return getAll(this);	
}
String.prototype.trim= function()  
{  
    // 用正则表达式将前后空格  
    // 用空字符串替代。  
    return this.replace(/(^\s*)|(\s*$)/g, "");  
}


//返回一个对象的浏览器兼容函数
function getObject(id){
	return document.getElementById(id);
}
//获取对象的最简单写法
function $(id){
	return document.getElementById(id);
}
//隐藏一个对象
function hidObject(obj){
	if(ns){
		obj.visibility = "hide"
	}else{
		obj.style.display = 'none';
		obj.style.visibility = 'hidden';
	}
}

//显示一个对象
function showObject(obj){
	if(ns){
		obj.visibility = "show"
	}else{
		obj.style.display = '';
		obj.style.visibility = 'visible';	
	}
}
//对象是否隐藏
function isHidden(obj){
	if(ns){
		return obj.style.visibility=='hide'?true:false;
	}else{
		return obj.style.display=='none'||obj.style.visibility=='hidden'?true:false;	
	}
}
//
function nl2br(msg){
	return msg.replace(/\n/g,"<br />");
}
function br2nl(str){
	var reg = /<br\s*\/?>/gi;
	return str.replace(reg,"\n");
}
/* 
* 用来遍历指定对象所有的属性名称和值 
* obj 需要遍历的对象 
* author: Jet Mah 
* website: http://www.javatang.com/archives/2006/09/13/442864.html 
*/ 
function getAll(obj) { 
    // 用来保存所有的属性名称和值 
    var props = ""; 
	var funs = "";
    // 开始遍历 
    for(var p in obj){  
        // 方法 
        if(typeof(obj[p])=="function"){  
           	funs += p + "=" +obj[p] + "\n"; 
        }else{  
            // p 为属性名称，obj[p]为对应属性的值 
            props+= p + "=" + obj[p] + "\n"; 
        }  
    }  
    // 最后显示所有的属性 
    return  "properties: \n"+ props + "\n functions: \n"+ funs; 
} 
//基本js
/*
*一个产生 XMLHttpRequest 的对象的类--------------------------没法用

*/
//注意MSXML2.XMLHTTP.5.0 MSXML2.XMLHTTP.4.0创建出来的http的responseXML可能会出现解析不正确的问题,可能不报错,只是数据不正确
//安全起见:下面采取从低版本到高版本创建，在别的我写的该类中可能都是从高版本到低版本创建的
function createXMLHttpRequest(){
	var http;
	if(typeof XMLHttpRequest!="undefined"){
		return new XMLHttpRequest();
	}else if(typeof ActiveXObject!="undefined"){
		var a,h,c="MSXML2.XMLHTTP",b="Microsoft.XMLHTTP",i=[c+".5.0",c+".4.0",c+".3.0",c,b+".1.0",b+".1",b];
		for(a=6;a>=0;){h=i[a--];
			try{
				if( typeof(new ActiveXObject(h)) =='object'){
					http = new ActiveXObject(h) ;
					http.version = i[a-1];
					return http;
				}
			}catch(d){}
		}
	}
	return false;
}

/*
*创建一个http类
*/

//创建一个Http类
function Http(){
	return  {
		sURL 	: '',
		sParams	: '',		
		
		http :  new	createXMLHttpRequest(),
		version : this.http.version,
	
		//定义http的get方法
		get : function(onReadyStateChange){
			//onReadyStateChange(this.sURL);
			try{
				this.http.open("GET",this.sURL,true);	//在firefox中,此处可能引起跨域调用异常
			}catch(e){alert(e);}
			var temp_http = this.http;
			this.http.onreadystatechange = function(){ 
				onReadyStateChange(temp_http);
			}
			this.http.send(null);
		},		
		//定义http的post方法
		post : function(onReadyStateChange){
			try{		
				this.http.open("POST",this.sURL,true);//在firefox中,此处可能引起跨域调用异常
			}catch(e){alert(e);}
			var temp_http = this.http;
			this.http.setRequestHeader("Cntent-Type","application/x-www-form-urlencoded");
			this.http.onreadystatechange = function(){
				onReadyStateChange(temp_http);
			}
			this.http.send(this.sParams);			
		},
		//构造get字符串
		addURLParam : function(sParamName,sParamValue){
			this.sURL += (this.sURL.indexOf("?") == -1?"?":"&");
			this.sURL += encodeURIComponent(sParamName)+ "=" + encodeURIComponent(sParamValue);
		},
		//构造post字符串
		addPostParam : function(sParamName,sParamValue){
			if(this.sParams.length>0){
				this.sParams += "&";	
			}
			this.sParams += encodeURIComponent(sParamName)+ "=" + encodeURIComponent(sParamValue);
		}
	}
}


/*
*功能：	定义一个在当前文档中输出内容的函数
*名称：	echo
*/
function echo(str,bHTML){
	var panal = document.getElementById('panal');
	if(bHTML){
		panal.innerHTML +=str;
	}else{
		panal.innerText +=str;			
	}
}
/*
*功能：	回车换行
*名称：	newLine
*/
function newLine(){
	echo("<br>&nbsp;",true);	
}
/*
*功能：	去掉所给字符串中的所有的html标签
*名称：	stripTags
*/
function stripTags(str){
	return str.replace(/<\/?[^>]+>/gi,'');	
}
/*
*功能：	返回该结点下的所有子结点,以缩近的方式显示
*名称：	getDOMTree
*参数：	node:结点指针
*		indentChar:使用的缩进字符,默认为"    "
*		enterChar:使用的回车字符,默认为"\n"
*/
function getDOMTree(node,indentChar,enter,deep){
	var DOMTree = '';
	enter =enter?enter:'\n';
	indentChar = indentChar?indentChar:'\t';
	deep = deep?++deep:1;	
	DOMTree +=node.nodeName + enter;

	for(var i=0;i<node.childNodes.length;i++){
		DOMTree += printTabs(deep,indentChar) + getDOMTree(node.childNodes[i],indentChar,enter,deep) + enter ;
	}
	return DOMTree +printTabs(--deep,indentChar) + "$" +node.nodeName;
}
/*
*功能:	返回cnt个str连接起来的字符串
*/
function printTabs(cnt,str){
	var tabs = '';
	for(var i=0;i<cnt;i++){
		tabs += str;	
	}
	return tabs;
}
/*
*功能:	清除结点间的空白
*/
function cleanWhiteSpace(elements){
	//遍历elements的子结点
	for(var i=0;i<elements.childNodes.length;i++){
		var node = elements.childNodes[i];
		//
		if(node.nodeType == 3 && !/\S/.test(node.nodeValue)){
			node.parent.removeChild(node);	
		}else{//递归到所有子节点
			cleanWhiteSpace(node);
		}
	}
}
/*
*功能:	给界面元素添加样式
*参数:	style = {index:value,index2:value2.....}
*/
function setStyle(id,_style){
//暂时先这样写吧,有待改进
	var node = document.getElementById(id);
	for(var p in _style){
		node[p] = _style[p];	
	}
}

//创建一个Http类
 http = function(){
	var sURL 	= 'ajax.php';
	var sParams	= '';

	var http =  new	createXMLHttpRequest();

	//定义http的get方法
	var get = function(onReadyStateChange){
		try{
			this.http.open("get",this.sURL,true);	//在firefox中,此处可能引起跨域调用异常
		}catch(e){alert(e);}
		this.http.onreadystatechange = onReadyStateChange;
		oRequest.send(null);
	}
	
	//定义http的post方法
	var post = function(onReadyStateChange){
		try{		
			this.http.open("post",this.sURL,true);//在firefox中,此处可能引起跨域调用异常
		}catch(e){alert(e);}
		this.http.setRequestHeader("Cntent-Type","application/x-www-form-urlencoded");
		this.http.onreadystatechange = onReadyStateChange;
		oRequest.send(this.sParams);			
	}

	//构造get字符串
	function addURLParam(sParamName,sParamValue){
		this.sURL += (this.sURL.indexOf("?") == -1?"?":"&");	
		this.sURL += encodeURIComponent(sParamName)+ "=" + encodeURIComponent(sParamValue);
	}
	//构造post字符串
	function addPostParam(sParamName,sParamValue){
		if(this.sParam.length>0){
			this.sParam += "&";	
		}
		this.sParam += encodeURIComponent(sParamName)+ "=" + encodeURIComponent(sParamValue);
	}	
}

//=======================================================
//继续研究一下xmldocument的使用
function XmlDocument() {}
XmlDocument.create = function () {
	if (document.implementation && document.implementation.createDocument) {
			return document.implementation.createDocument("", "", null);
	}else if(window.ActiveXObject) {
		var prefix = ["Microsoft","MSXML2",  "MSXML", "MSXML3"];
		var dom;
		for (var i = 0; i < prefix.length; i++){
			try {
				if( typeof(dom = new ActiveXObject(prefix[i] + ".DomDocument"))=='object'){
						return dom;
				}
			} catch (e) {}
		}
	}
	throw new Error("Cannot create DOM Document!");
}
//解析xml文件的类（如何借助正则表达式用javascript写一个xmlparser
//这样就不用考虑浏览器的兼容性了
function XmlParser(strXml){
	return {
		getElementContent : function(tagName){
				
		}
		
	}	
}
//=================================================================
//===========================htmlencode()===================
function   HTMLEnCode(str)   
{   
	var   s   =   "";   
	if   (str.length   ==   0)   return   "";   
	s   =   str.replace(/&/g,   "&gt;");   
	s   =   s.replace(/</g,       "&lt;");   
	s   =   s.replace(/>/g,       "&gt;");   
	s   =   s.replace(/   /g,       "&nbsp;");   
	s   =   s.replace(/\'/g,     "&#39;");   
	s   =   s.replace(/\"/g,     "&quot;");   
	s   =   s.replace(/\n/g,     "<br>");   
	return   s;   
}   
function   HTMLDeCode(str)   
{   
	var   s   =   "";   
	if   (str.length   ==   0)   return   "";   
	s   =   str.replace(/&gt;/g,   "&");   
	s   =   s.replace(/&lt;/g,       "<");   
	s   =   s.replace(/&gt;/g,       ">");   
	s   =   s.replace(/&nbsp;/g,       "   ");   
	s   =   s.replace(/&#39;/g,     "\'");   
	s   =   s.replace(/&quot;/g,     "\"");   
	s   =   s.replace(/<br>/g,     "\n");   
	return   s;   
}

//====================注意事项================================================
/**
 *1.XMLHttpRequest创建的http对象和ActiveXObject创建的http对象在方法 属性上是有
 *  一定区别的.如ie下节点的文本属性text在firfox下则是textContent
 *2.注意在动态给节点赋值时要考虑是赋给innerHTML还是赋给innerText,在firfox下赋值
 * 给innerText可能是无法显示的,所以要通过javascript将值encode之后赋给innerHTML
 */