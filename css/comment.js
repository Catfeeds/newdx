var G_src,G_page;
var G_http;
//转到某页，发送请求
function goPage(src,page){
	
	G_src = src;
	G_page = page;
	//
	var ie,firfox;
	try{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		ie = true;
	}catch(e){
		xmlhttp =  new XMLHttpRequest();
		firfox = true;
	}
	G_http = xmlhttp;
	//alert(src+page+".xml");
	try{
	xmlhttp.onreadystatechange = receiveComment;
	xmlhttp.open("GET", src+page+".xml", true);
	xmlhttp.setRequestHeader("If-Modified-Since","0");
	xmlhttp.send(null);
	}catch(t){
		alert(t.message);
	}
	//下面的东西用的是我自己写的http类，返回的xmldocument有问题，浪费了我两天时间
	//var http = new Http;
	//http.sURL = src+page+".xml";
	//http.http.setRequestHeader("If-Modified-Since","0");
	//http.get(receiveComment);

}
//接受数据
function receiveComment(){
	var http = G_http;
	if(http.readyState == 4 ){
		if(http.status == 200){
			//alert(http.responseText);
			//alert(http.responseXML);
			refreshComment(http.responseXML);
		}	
	}		
}
//刷新评论
function refreshComment(doc){
/* doc的title组件中明明有个12我居然取不到，浪费我两天时间*/
	var src = G_src;
	var page = G_page;
	var pageSize = 10;
	
	var allcommentsDiv= document.getElementById("allcomments");		
	var pageInfo = document.getElementById('pageInfo');
	var pageNav = document.getElementById('pageNav');
	var pageInfo2 = document.getElementById('pageInfo2');
	var pageNav2 = document.getElementById('pageNav2');
	
	var titles = doc.getElementsByTagName("title").item(0);
	var items = doc.getElementsByTagName("item");
	var table = document.createElement("table");
	//alert(titles);
	allcommentsDiv.innerHTML = '';
	allcommentsDiv.appendChild(table);
	table.width = "100%";
	var tbody = document.createElement("tbody");
	table.appendChild(tbody);
	var lastItem = pageSize*page;
	var total = ie?titles.text:titles.textContent;
	if(lastItem>total){lastItem = total;}

	for(var i=0;i<items.length;i++){
		var authorRow = document.createElement("tr");
		var authorCell = document.createElement("td");
		tbody.appendChild(authorRow);
		authorRow.appendChild(authorCell);
		node = items.item(i);
		
		dateTime = node.getElementsByTagName("pubDate").item(0);
		articleLink = node.getElementsByTagName("link").item(0);
		commentSource = node.getElementsByTagName("source").item(0);
		author = node.getElementsByTagName("author").item(0);
		dateTimeText 		= ie?dateTime.text:dateTime.textContent;
		articleLinkText		= ie?articleLink.text:articleLink.textContent;
		commentSourceText	= ie?commentSource.text:commentSource.textContent;
		authorText			= ie?author.text:author.textContent;
		strTitle = '<table width="100%" cellspacing="0px"><tr><td align="left" class="pingluntd2">'+"  ["+dateTimeText+"]作者:"+authorText+'</td>';
		strTitle += '<td align="right"  class="pingluntd2">'+' <a href="#recom" style=" font-size:12px" onclick="recomment('+commentSourceText+')" ><font color=black>评论此条↑</font></a></td></tr>';
		strTitle += '</tab