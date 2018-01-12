// 取obj对象位置
function getXY(obj) {
	var rect = obj.getBoundingClientRect(),
	scrollTop = document.body.scrollTop || document.documentElement.scrollTop,
	scrollLeft = document.body.scrollLeft || document.documentElement.scrollLeft,
	isIE = window.ActiveXObject ? 2 : 0;
	var position ={};
	position.left = rect.left - isIE + scrollLeft;
	position.top = rect.top - isIE + scrollTop;
	return position;
}

// 光标之前的字符串
function posCursor(obj){
	var isIE = !(!document.all);
	var end=0;
	if(isIE){
		var sTextRange= document.selection.createRange();
		if(sTextRange.parentElement()== obj){
			var oTextRange = document.body.createTextRange();
			oTextRange.moveToElementText(obj);
			for (end = 0; oTextRange.compareEndPoints('StartToEnd', sTextRange) < 0; end ++){
				oTextRange.moveStart('character', 1);
			}
			for (var i = 0; i <= end; i ++){
				if (obj.value.charAt(i) == '\n'){
					end++;
				}
			}
		}
	} else{
		end = obj.selectionEnd;
	}
	return end;
}

// 统计字符串总长度中文字符为2，英文字符及数字为1
function getLength(obj){
	var realLength = 0, len = obj.length, charCode = -1;
	for (var i = 0; i < len; i++) {
		charCode = obj.charCodeAt(i);
		if (charCode >= 0 && charCode <= 128) realLength += 1;
		else realLength += 2;
	}
	return realLength;
}

function objChange(textarea, hiddenObj, atList){
	//取值
	var objString =  textarea.value;

	//记录光标当前位置
	var cursorPosition = posCursor(textarea);
	//光标之前的字符串
	var beforeCursorString = objString.substr(0,cursorPosition);
	//记录@在光表前出现的最近的位置
	var atLocation = beforeCursorString.lastIndexOf('@');
	//记录光标和光标前最近的@之间的字符串，记为标识符，判断其是否含有空格
	var indexString = objString.substr(atLocation,cursorPosition-atLocation);
	//记录从开始到光标前最近的@之间的字符串，用来定位
	var positionString = objString.substr(0,atLocation);

	if (beforeCursorString.indexOf('@') !=- 1 && indexString.indexOf(' ') == -1 && indexString.indexOf('\n') == -1) {
		//@开始
		// var followlist = ["昵称1","昵称2","昵称3"];
		var dom = '<li class="list-title">\u9009\u62e9\u6700\u8fd1@\u7684\u4eba\u6216\u76f4\u63a5\u8f93\u5165</li>';

		var followlist = function(inputchar){
			jQuery.getJSON(SITEURL+'forum.php', {mod:"misc", action:"followlist", username:inputchar}, function(followlist){
				if(followlist.length > 0) {
					for (var i = 0,len = followlist.length; i < len; i++) {
						dom += '<li class="list-content">'+ followlist[i]+'</li>';
					};
					atList.innerHTML = dom;
				} else {
					atList.style.display = 'none';
				}

				var listClick = atList.getElementsByTagName("li");
				for (var i = 1,len = listClick.length; i < len; i++) {
					listClick[i].onmouseover = (function(i) {
						return function() {
							for (var l = 1; l < len; l++) {
								listClick[l].className = 'list-content';
							};
							listClick[i].className = 'list-content list-active';
						}
					})(i);

					listClick[i].onclick = (function(i) {
						return function() {
							//将textarea分成三块，@之前的area1、@+联系人+' '的area2、光标之后的area3
							var area1 = objString.substr(0,atLocation);
							var area2 = '@' + listClick[i].innerHTML + ' ';
							var area3 = objString.substr(cursorPosition,getLength(objString) - cursorPosition);

							textarea.value = area1+area2+area3;
							atList.style.display = 'none';

							//定位光标
							var position = area1.length + area2.length;
							if (navigator.appName=="Microsoft Internet Explorer") {
								var range = textarea.createTextRange();
								range.move("character", position);
								range.select();
							}
							else {
								textarea.setSelectionRange(position, position);
								textarea.focus();
							}
						}
					})(i);
				};

			});
		}
		followlist(indexString.substring(1));

		atList.style.display = 'block';
		hiddenObj.innerHTML = positionString.replace(/\n/g,"<br/>") + '<span id="' + atList.id + '-at">@</span>';
		var at = document.getElementById(atList.id + "-at");
		var textarea_height = textarea.clientHeight - 20;
		atList.style.left = getXY(at).left + 10 + 'px';
		atList.style.top = getXY(at).top - textarea_height + 'px';
	} else{
		atList.style.display = 'none';
	}
}

function addListener(element, e, fn) {
	if (element.addEventListener) {
		element.addEventListener(e, fn, false);
	} else {
		element.attachEvent("on" + e, fn);
	}
}

function at(textarea, hiddenObj, atList) {
	if(textarea.addEventListener){
		textarea.addEventListener("keyup",function(){objChange(textarea, hiddenObj, atList)},false);
		textarea.addEventListener("mouseup",function(){objChange(textarea, hiddenObj, atList)},false);
	}else if(textarea.attachEvent){	// fix ie
		textarea.attachEvent("onkeyup",function(){objChange(textarea, hiddenObj, atList)});
		textarea.attachEvent("onmouseup",function(){objChange(textarea, hiddenObj, atList)});
	}
}
