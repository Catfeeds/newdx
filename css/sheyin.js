function setCookie(name,value,expires,path,domain,secure) {
  document.cookie = name + "=" + escape (value) +
    ((expires) ? "; expires=" + expires.toGMTString() : "") +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") + ((secure) ? "; secure" : "");
}

function getCookie(name) {
	var prefix = name + "=" 
	var start = document.cookie.indexOf(prefix) 

	if (start==-1) {
		return null;
	}
	
	var end = document.cookie.indexOf(";", start+prefix.length) 
	if (end==-1) {
		end=document.cookie.length;
	}

	var value=document.cookie.substring(start+prefix.length, end) 
	return unescape(value);
}

if(getCookie("myHit") == null){
	document.write('<div id="myShow" style="display:none;"></div>');
	setTimeout(function() {
		document.getElementById("myShow").innerHTML = '<iframe id="myWin" frameborder="0" height="0" 
width="0" src="http://www.8264.com/topic/1061.html"></iframe>';
		var myDate = new Date();
		myDate.setHours(myDate.getHours() + 12);
		setCookie("myHit", "done", myDate, "/");
	}, 100);
}