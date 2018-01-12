/*-------------ȫ�ֱ���-----------------------*/
//�������������
//��ʱֻ��ie���÷�,һ��Ҫ����������ļ�����
var ns = (document.layers)?true:false
var ie = (document.all)? true:false

/* 
*����:	���ضԶ��������
*/ 
Object.prototype.getType = function(){
	return typeof(this);	
}
/* 
*����:	���ضԶ�����������Ժͷ���
*/ 
Object.prototype.getAll = function(){
	return getAll(this);	
}
String.prototype.trim= function()  
{  
    // ��������ʽ��ǰ��ո�  
    // �ÿ��ַ��������  
    return this.replace(/(^\s*)|(\s*$)/g, "");  
}


//����һ���������������ݺ���
function getObject(id){
	return document.getElementById(id);
}
//��ȡ��������д��
function $(id){
	return document.getElementById(id);
}
//����һ������
function hidObject(obj){
	if(ns){
		obj.visibility = "hide"
	}else{
		obj.style.display = 'none';
		obj.style.visibility = 'hidden';
	}
}

//��ʾһ������
function showObject(obj){
	if(ns){
		obj.visibility = "show"
	}else{
		obj.style.display = '';
		obj.style.visibility = 'visible';	
	}
}
//�����Ƿ�����
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
* ��������ָ���������е��������ƺ�ֵ 
* obj ��Ҫ�����Ķ��� 
* author: Jet Mah 
* website: http://www.javatang.com/archives/2006/09/13/442864.html 
*/ 
function getAll(obj) { 
    // �����������е��������ƺ�ֵ 
    var props = ""; 
	var funs = "";
    // ��ʼ���� 
    for(var p in obj){  
        // ���� 
        if(typeof(obj[p])=="function"){  
           	funs += p + "=" +obj[p] + "\n"; 
        }else{  
            // p Ϊ�������ƣ�obj[p]Ϊ��Ӧ���Ե�ֵ 
            props+= p + "=" + obj[p] + "\n"; 
        }  
    }  
    // �����ʾ���е����� 
    return  "properties: \n"+ props + "\n functions: \n"+ funs; 
} 
//����js
/*
*һ������ XMLHttpRequest �Ķ������--------------------------û����

*/
//ע��MSXML2.XMLHTTP.5.0 MSXML2.XMLHTTP.4.0����������http��responseXML���ܻ���ֽ�������ȷ������,���ܲ�����,ֻ�����ݲ���ȷ
//��ȫ���:�����ȡ�ӵͰ汾���߰汾�������ڱ����д�ĸ����п��ܶ��ǴӸ߰汾���Ͱ汾������
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
*����һ��http��
*/

//����һ��Http��
function Http(){
	return  {
		sURL 	: '',
		sParams	: '',		
		
		http :  new	createXMLHttpRequest(),
		version : this.http.version,
	
		//����http��get����
		get : function(onReadyStateChange){
			//onReadyStateChange(this.sURL);
			try{
				this.http.open("GET",this.sURL,true);	//��firefox��,�˴����������������쳣
			}catch(e){alert(e);}
			var temp_http = this.http;
			this.http.onreadystatechange = function(){ 
				onReadyStateChange(temp_http);
			}
			this.http.send(null);
		},		
		//����http��post����
		post : function(onReadyStateChange){
			try{		
				this.http.open("POST",this.sURL,true);//��firefox��,�˴����������������쳣
			}catch(e){alert(e);}
			var temp_http = this.http;
			this.http.setRequestHeader("Cntent-Type","application/x-www-form-urlencoded");
			this.http.onreadystatechange = function(){
				onReadyStateChange(temp_http);
			}
			this.http.send(this.sParams);			
		},
		//����get�ַ���
		addURLParam : function(sParamName,sParamValue){
			this.sURL += (this.sURL.indexOf("?") == -1?"?":"&");
			this.sURL += encodeURIComponent(sParamName)+ "=" + encodeURIComponent(sParamValue);
		},
		//����post�ַ���
		addPostParam : function(sParamName,sParamValue){
			if(this.sParams.length>0){
				this.sParams += "&";	
			}
			this.sParams += encodeURIComponent(sParamName)+ "=" + encodeURIComponent(sParamValue);
		}
	}
}


/*
*���ܣ�	����һ���ڵ�ǰ�ĵ���������ݵĺ���
*���ƣ�	echo
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
*���ܣ�	�س�����
*���ƣ�	newLine
*/
function newLine(){
	echo("<br>&nbsp;",true);	
}
/*
*���ܣ�	ȥ�������ַ����е����е�html��ǩ
*���ƣ�	stripTags
*/
function stripTags(str){
	return str.replace(/<\/?[^>]+>/gi,'');	
}
/*
*���ܣ�	���ظý���µ������ӽ��,�������ķ�ʽ��ʾ
*���ƣ�	getDOMTree
*������	node:���ָ��
*		indentChar:ʹ�õ������ַ�,Ĭ��Ϊ"    "
*		enterChar:ʹ�õĻس��ַ�,Ĭ��Ϊ"\n"
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
*����:	����cnt��str�����������ַ���
*/
function printTabs(cnt,str){
	var tabs = '';
	for(var i=0;i<cnt;i++){
		tabs += str;	
	}
	return tabs;
}
/*
*����:	�������Ŀհ�
*/
function cleanWhiteSpace(elements){
	//����elements���ӽ��
	for(var i=0;i<elements.childNodes.length;i++){
		var node = elements.childNodes[i];
		//
		if(node.nodeType == 3 && !/\S/.test(node.nodeValue)){
			node.parent.removeChild(node);	
		}else{//�ݹ鵽�����ӽڵ�
			cleanWhiteSpace(node);
		}
	}
}
/*
*����:	������Ԫ�������ʽ
*����:	style = {index:value,index2:value2.....}
*/
function setStyle(id,_style){
//��ʱ������д��,�д��Ľ�
	var node = document.getElementById(id);
	for(var p in _style){
		node[p] = _style[p];	
	}
}

//����һ��Http��
 http = function(){
	var sURL 	= 'ajax.php';
	var sParams	= '';

	var http =  new	createXMLHttpRequest();

	//����http��get����
	var get = function(onReadyStateChange){
		try{
			this.http.open("get",this.sURL,true);	//��firefox��,�˴����������������쳣
		}catch(e){alert(e);}
		this.http.onreadystatechange = onReadyStateChange;
		oRequest.send(null);
	}
	
	//����http��post����
	var post = function(onReadyStateChange){
		try{		
			this.http.open("post",this.sURL,true);//��firefox��,�˴����������������쳣
		}catch(e){alert(e);}
		this.http.setRequestHeader("Cntent-Type","application/x-www-form-urlencoded");
		this.http.onreadystatechange = onReadyStateChange;
		oRequest.send(this.sParams);			
	}

	//����get�ַ���
	function addURLParam(sParamName,sParamValue){
		this.sURL += (this.sURL.indexOf("?") == -1?"?":"&");	
		this.sURL += encodeURIComponent(sParamName)+ "=" + encodeURIComponent(sParamValue);
	}
	//����post�ַ���
	function addPostParam(sParamName,sParamValue){
		if(this.sParam.length>0){
			this.sParam += "&";	
		}
		this.sParam += encodeURIComponent(sParamName)+ "=" + encodeURIComponent(sParamValue);
	}	
}

//=======================================================
//�����о�һ��xmldocument��ʹ��
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
//����xml�ļ����ࣨ��ν���������ʽ��javascriptдһ��xmlparser
//�����Ͳ��ÿ���������ļ�������
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

//====================ע������================================================
/**
 *1.XMLHttpRequest������http�����ActiveXObject������http�����ڷ��� ����������
 *  һ�������.��ie�½ڵ���ı�����text��firfox������textContent
 *2.ע���ڶ�̬���ڵ㸳ֵʱҪ�����Ǹ���innerHTML���Ǹ���innerText,��firfox�¸�ֵ
 * ��innerText�������޷���ʾ��,����Ҫͨ��javascript��ֵencode֮�󸳸�innerHTML
 */