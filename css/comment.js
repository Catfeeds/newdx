var G_src,G_page;
var G_http;
//ת��ĳҳ����������
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
	//����Ķ����õ������Լ�д��http�࣬���ص�xmldocument�����⣬�˷���������ʱ��
	//var http = new Http;
	//http.sURL = src+page+".xml";
	//http.http.setRequestHeader("If-Modified-Since","0");
	//http.get(receiveComment);

}
//��������
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
//ˢ������
function refreshComment(doc){
/* doc��title����������и�12�Ҿ�Ȼȡ�������˷�������ʱ��*/
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
		strTitle = '<table width="100%" cellspacing="0px"><tr><td align="left" class="pingluntd2">'+"  ["+dateTimeText+"]����:"+authorText+'</td>';
		strTitle += '<td align="right"  class="pingluntd2">'+' <a href="#recom" style=" font-size:12px" onclick="recomment('+commentSourceText+')" ><font color=black>���۴�����</font></a></td></tr>';
		strTitle += '</tab