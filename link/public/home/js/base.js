/**
 * ==========================================
 * base.js
 * Copyright (c) 2010 wwww.114la.com
 * Author: cai@115.com
 * ==========================================
 */
 
var mini=(function(){var b=/(?:[\w\-\\.#]+)+(?:\[\w+?=([\'"])?(?:\\\1|.)+?\1\])?|\*|>/ig,g=/^(?:[\w\-_]+)?\.([\w\-_]+)/,f=/^(?:[\w\-_]+)?#([\w\-_]+)/,j=/^([\w\*\-_]+)/,h=[null,null];function d(o,m){m=m||document;var k=/^[\w\-_#]+$/.test(o);if(!k&&m.querySelectorAll){return c(m.querySelectorAll(o))}if(o.indexOf(",")>-1){var v=o.split(/,/g),t=[],s=0,r=v.length;for(;s<r;++s){t=t.concat(d(v[s],m))}return e(t)}var p=o.match(b),n=p.pop(),l=(n.match(f)||h)[1],u=!l&&(n.match(g)||h)[1],w=!l&&(n.match(j)||h)[1],q;if(u&&!w&&m.getElementsByClassName){q=c(m.getElementsByClassName(u))}else{q=!l&&c(m.getElementsByTagName(w||"*"));if(u){q=i(q,"className",RegExp("(^|\\s)"+u+"(\\s|$)"))}if(l){var x=m.getElementById(l);return x?[x]:[]}}return p[0]&&q[0]?a(p,q):q}function c(o){try{return Array.prototype.slice.call(o)}catch(n){var l=[],m=0,k=o.length;for(;m<k;++m){l[m]=o[m]}return l}}function a(w,p,n){var q=w.pop();if(q===">"){return a(w,p,true)}var s=[],k=-1,l=(q.match(f)||h)[1],t=!l&&(q.match(g)||h)[1],v=!l&&(q.match(j)||h)[1],u=-1,m,x,o;v=v&&v.toLowerCase();while((m=p[++u])){x=m.parentNode;do{o=!v||v==="*"||v===x.nodeName.toLowerCase();o=o&&(!l||x.id===l);o=o&&(!t||RegExp("(^|\\s)"+t+"(\\s|$)").test(x.className));if(n||o){break}}while((x=x.parentNode));if(o){s[++k]=m}}return w[0]&&s[0]?a(w,s):s}var e=(function(){var k=+new Date();var l=(function(){var m=1;return function(p){var o=p[k],n=m++;if(!o){p[k]=n;return true}return false}})();return function(m){var s=m.length,n=[],q=-1,o=0,p;for(;o<s;++o){p=m[o];if(l(p)){n[++q]=p}}k+=1;return n}})();function i(q,k,p){var m=-1,o,n=-1,l=[];while((o=q[++m])){if(p.test(o[k])){l[++n]=o}}return l}return d})();

if ( typeof Ylmf == 'undefined' ) {
    var Ylmf = {};
}

Function.prototype.method = function(name,fn) {
    this.prototype[name]=fn;
    return this;
};
if (!Array.prototype.forEach) {
    Array.method('forEach',
    function(fn, thisObj) {
        var scope = thisObj || window;
        for (var i = 0,
        j = this.length; i < j; ++i) {
            fn.call(scope, this[i], i, this);
        }
    }).method('every',
    function(fn, thisObj) {
        var scope = thisObj || window;
        for (var i = 0,
        j = this.length; i < j; ++i) {
            if (!fn.call(scope, this[i], i, this)) {
                return false;
            }
        }
        return true;
    }).method('some',
    function(fn, thisObj) {
        var scope = thisObj || window;
        for (var i = 0,
        j = this.length; i < j; ++i) {
            if (fn.call(scope, this[i], i, this)) {
                return true;
            }
        }
        return false;
    }).method('map',
    function(fn, thisObj) {
        var scope = thisObj || window;
        var a = [];
        for (var i = 0,
        j = this.length; i < j; ++i) {
            a.push(fn.call(scope, this[i], i, this));
        }
        return a;
    }).method('filter',
    function(fn, thisObj) {
        var scope = thisObj || window;
        var a = [];
        for (var i = 0,
        j = this.length; i < j; ++i) {
            if (!fn.call(scope, this[i], i, this)) {
                continue;
            }
            a.push(this[i]);
        }
        return a;
    }).method('indexOf',
    function(el, start) {
        var start = start || 0;
        for (var i = start,
        j = this.length; i < j; ++i) {
            if (this[i] === el) {
                return i;
            }
        }
        return - 1;
    }).method('lastIndexOf',
    function(el, start) {
        var start = start || this.length;
        if (start >= this.length) {
            start = this.length;
        }
        if (start < 0) {
            start = this.length + start;
        }
        for (var i = start; i >= 0; --i) {
            if (this[i] === el) {
                return i;
            }
        }
        return - 1;
    });
}

(function() {
    Ylmf.register = function(REG) {
		function __$(el){
			
			if(typeof el=="string"){
				var elArr =  mini(el);
				
				if(!elArr||elArr=="" || typeof(elArr) == "undefined"=="undefined"){
					//alert("No $!");
					return false;
				}
				
				
				if(elArr.length==1){
					this.el = elArr[0];
				}else if(elArr.length>1){
					this.el = elArr;
				}
			}else if(el.nodeType ==1){
				this.el = el;
			}
			 
		};
        __$.method(REG.each,function(fn){
			if(!this.el){
			//	fn.call(this,false);
				return
			}						 
			if(!this.el.length){
				fn.call(this,this.el);
			}else{			 
				for(var i= 0,len = this.el.length; i<len; ++i){
					fn.call(this,this.el[i]);
				}
			}
			return this;
		}).method(REG.hasClass, function(c,fn){	
			this.each(function(el){
				var col = el.className.split(/\s+/).toString();
				var result = (col.indexOf(c)>-1)?true:false;
				(function(){
					fn(result);	  
				})();
			});
			return this;
		}).method(REG.addClass, function(classNames){	
			this.each(function(el){
				var col = (classNames || "").split(/\s+/);
				for(var i = 0; i < col.length; i++){
					var item = col[i];
					this.hasClass(el,function(b){
						if(!b){
							el.className += (el.className ? " " : "") + item;
						}
					
					})
				}

			});
			return this;
		}).method(REG.removeClass, function(c){	
			this.each(function(el){
				if(c != undefined){
					var col = el.className.split(/\s+/);
					var hasCol = [];
					for(var i =0,len = col.length;i<len;++i){
						var item = col[i];
						
						if(item!=c){
							hasCol.push(item);
						}					
						
					}
					
					el.className = hasCol.join(" ");
				}else{
					el.className = "";
				}

	
			});
			return this;
		}).method(REG.replaceClass, function(oc,nc){
	
			this.removeClass(oc);
			this.addClass(nc);
			return this;
		}).method(REG.setStyle, function(prop,val){	
			this.each(function(el){
				el.style[prop] = val;
			});
			return this;
		}).method(REG.setCSS, function(styles) {
            for(var prop in styles){
				if(!styles.hasOwnProperty(prop)) continue;
				this.setStyle(prop,styles[prop]);
			}
            return this;
			
        }).method(REG.getStyle,function(prop,fn){
				var currentStyle = null;
			
				if(document.defaultView){// firefox,opera,safari
					currentStyle =  document.defaultView.getComputedStyle(this.el,null).getPropertyValue(prop);
				} else {//ie
					prop=prop.replace(/\-([a-z])([a-z]?)/ig,function(prop,a,b){return a.toUpperCase()+b.toLowerCase();});//转化为驼峰写法
					currentStyle =  this.el["currentStyle"][prop];
				}
				fn.call(this,currentStyle);
			
			return this;
		}).method(REG.show,function(n){
			if(n==0){
				this.setStyle("display","");
			}else if(n==1){
				this.setStyle("display","");
			}else{
				this.setStyle("display","block");
			}
			return this;
		}).method(REG.hide,function(){
			this.setStyle("display","none");
			return this;
		}).method(REG.toggle,function(){
			this.each(function(el){
				if(el.style.display =="none"){
					el.style.display="block";
					
				}else{
					el.style.display="none";
				}
			});
			return this;
		}).method(REG.on,function(type,fn){

			var add = function(el){
				var f = function(){

					fn(el)
				};
				if(window.addEventListener){
					el.addEventListener(type,f,false);
				}else if(window.attachEvent){
					el.attachEvent('on'+type,f);
				}	
			}
			if(!this.el){
				return;
			}
			
			if(this.el.length==0){
				add(this.el);
			}else{
				this.each(function(el){
					add(el);
				});
			}
			return this;
		}).method(REG.getRect,function(fn){
			var oRect = this.el.getBoundingClientRect();
			
			fn.call(this,oRect)
			
			return this;
		}).method(REG.create,function(el,o,cb){
			var el = document.createElement(el);
            for ( prop in o ) {
                el.setAttribute(prop, o[prop]);
            }
            if (cb) {
                cb.call(this, el);
            }
			
			return this;
		}).method(REG.append,function(element){
			this.el.appendChild(element);
			return this;
		}).method(REG.remove,function(element){
			if(element){
				this.el.removeChild(element);
			}
			return this;
		});
        
        window[REG.namespace] = function(el) {
            return new __$(el);
        };
        // sugar array shortcuts
        window[REG.namespace].forEach = Array.prototype.forEach;
        window[REG.namespace].every = Array.prototype.every;
        window[REG.namespace].some = Array.prototype.some;
        window[REG.namespace].map = Array.prototype.map;
        window[REG.namespace].filter = Array.prototype.filter;
				
        Ylmf.extendChain = function(name, fn) {
            __$.method(name, fn);
        };
		
		
    };
})();

Ylmf.register({
    namespace : '_$',
	each:'each',
	addClass:'addClass',
	hasClass:'hasClass',
	removeClass:'removeClass',
	replaceClass:'replaceClass',
	setStyle:'setStyle',
	getStyle:'getStyle',
	setCSS:'setCSS',
	show:'show',
	hide:'hide',
	toggle:'toggle',
	on:'on',
	getRect:'getRect',
	append:'append',
	create:'create',
	remove:'remove'
});
var Yl = {
	getHost:function (A) {
    	var _ = A || location.host,
    	$ = _.indexOf(":");
    	return ($ == -1) ? _: _.substring(0, $)
	},
	getFocus :function(el){
		var txt =el.createTextRange();      
		txt.moveStart('character',el.value.length);      
		txt.collapse(true);      
		txt.select();
	},
	loadFrame:function(iframe,callback){
		if (Browser.isIE){  //ie
			iframe.onreadystatechange = function(){
				callback();
			};
		}else{ //w3c
			iframe.onload = function(){
				callback();
			};
		}
	},
	trim: function(_$) {
		_$ = _$.replace(/(^\u3000+)|(\u3000+$)/g, "");
		_$ = _$.replace(/(^ +)|( +$)/g, "");
		return _$
	},
	
	encodeText:function($) {
		$ = $.replace(/</g, "&lt;");
		$ = $.replace(/>/g, "&gt;");
		$ = $.replace(/\'/g, "&#39;");
		$ = $.replace(/\"/g, "&#34;");
		$ = $.replace(/\\/g, "&#92;");
		$ = $.replace(/\[/g, "&#91;");
		$ = $.replace(/\]/g, "&#93;");
		return $
	},
	
	decodeHtml:function($) {
		$ = $.replace(/&lt;/g, "<");
		$ = $.replace(/&gt;/g, ">");
		$ = $.replace(/&#39;/g, "'");
		$ = $.replace(/&#34;/g, '"');
		$ = $.replace(/&#92;/g, "\\");
		$ = $.replace(/&#91;/g, "[");
		$ = $.replace(/\&#93;/g, "]");
		return $
	},
	createFrame:function(o){
		if(!o||!o.src){return}
		var s = o.src,
		w = o.width || "100%",
		h = o.height || "100%",
		Frame = format('<iframe src="#{src}" width="#{width}" height="#{height}" scrolling="no" frameborder="0" allowtransparency="true"></iframe>',{
			src: s,
			width: w,
			height: h
		})
		return Frame;
	},
	getType:function (o) {
  		var _t; return ((_t = typeof(o)) == "object" ? o==null && "null" || Object.prototype.toString.call(o).slice(8,-1):_t).toLowerCase();
	},
	
	setStyle:function(A, $) {
		var _ = document.styleSheets[0];
		if (_.addRule) {
			A = A.split(",");
			for (var C = 0,
			B = A.length; C < B; C++) _.addRule(A[C], $)
		} else if (_.insertRule) _.insertRule(A + " { " + $ + " }", _.cssRules.length)
	},
	
	addFav:function (title) {
		var title = title || document.getElementsByTagName("title")[0].innerHTML;
		if( document.all ) {
			window.external.AddFavorite(location.href, title);
		}else if (window.sidebar) {
			window.sidebar.addPanel(title, location.href,"");
		} else if( window.opera && window.print ) {
			return true;
		}
	},
	setHome:function(obj,hostname){
		if(!Browser.isIE){
			alert("您的浏览器不支持自动设置主页，请使用浏览器菜单手动设置。")
			return;
		}
		var host = hostname;
		if(!host){
			host = window.location.href;
		}
			obj.style.behavior = 'url(#default#homepage)';
			obj.setHomePage(host);
	}

},
Browser = (function() {
		var H = navigator.userAgent,
		F = 0,
		E = 0,
		I = 0,
		D = 0,
		A = 0,
		_ = 0,
		C = 0,
		B;
		if (H.indexOf("Chrome") > -1 && /Chrome\/(\d+(\.d+)?)/.test(H)) C = RegExp.$1;
		if (H.indexOf("Safari") > -1 && /Version\/(\d+(\.\d+)?)/.test(H)) F = RegExp.$1;
		if (window.opera && /Opera(\s|\/)(\d+(\.\d+)?)/.test(H)) I = RegExp.$2;
		if (H.indexOf("Gecko") > -1 && H.indexOf("KHTML") == -1 && /rv\:(\d+(\.\d+)?)/.test(H)) A = RegExp.$1;
		if (/MSIE (\d+(\.\d+)?)/.test(H)) D = RegExp.$1;
		if (/Firefox(\s|\/)(\d+(\.\d+)?)/.test(H)) _ = RegExp.$2;
		if (H.indexOf("KHTML") > -1 && /AppleWebKit\/([^\s]*)/.test(H)) E = RegExp.$1;
		try {
			B = !!external.max_version
		} catch($) {}
		function G() {
			var _ = false;
			if (navigator.plugins) for (var B = 0; B < navigator.plugins.length; B++) if (navigator.plugins[B].name.toLowerCase().indexOf("shockwave flash") >= 0) _ = true;
			if (!_) {
				try {
					var $ = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
					if ($) _ = true
				} catch(A) {
					_ = false
				}
			}
			return _
		}
		return ({
			isStrict: document.compatMode == "CSS1Compat",
			isChrome: C,
			isSafari: F,
			isWebkit: E,
			isOpera: I,
			isGecko: A,
			isIE: D,
			isFF: _,
			isMaxthon: B,
			isFlash: G(),
			isCookie: (navigator.cookieEnabled) ? true: false
		})
})(),
Cookie = {
	set:function(name,value,expires,path,domain){
		if(typeof expires=="undefined"){
			expires=new Date(new Date().getTime()+1000*3600*24*365);
		}
		
		document.cookie=name+"="+escape(value)+((expires)?"; expires="+expires.toGMTString():"")+((path)?"; path="+path:"; path=/")+((domain)?";domain="+domain:"");
		
	},
	get:function(name){
		var arr=document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
		if(arr!=null){
			return unescape(arr[2]);
		}
		return null;
	},
	 is: function(name) {
        var value = this.get(name);
        return (value != null && value != "") ? true: false;
    },
    remove: function(name, domain) {
        domain = domain || this.domain;
        if (this.is(name)){
			document.cookie = name + "=" + ((this.path) ? "; path=" + this.path: "") + ((this.domain) ? "; domain=" + domain: "") + "; expires=Thu, 01-Jan-70 00:00:01 GMT";
		}
    },
	clear:function(name,path,domain){
		if(this.get(name)){
		document.cookie=name+"="+((path)?"; path="+path:"; path=/")+((domain)?"; domain="+domain:"")+";expires=Fri, 02-Jan-1970 00:00:00 GMT";
		}
	}
}
,
qAjax = function(url, callback) {

		var xhr;
		if(typeof XMLHttpRequest !== 'undefined') xhr = new XMLHttpRequest();
		else {
			var versions = ["Microsoft.XmlHttp", 
			 				"MSXML2.XmlHttp",
			 			    "MSXML2.XmlHttp.3.0", 
			 			    "MSXML2.XmlHttp.4.0",
			 			    "MSXML2.XmlHttp.5.0"];
			 for(var i = 0, len = versions.length; i < len; i++) {
			 	try {
			 		xhr = new ActiveXObject(versions[i]);
			 		break;
			 	}
			 	catch(e){}
			 } // end for
		}
		xhr.onreadystatechange = ensureReadiness;
		function ensureReadiness() {
			if(xhr.readyState < 4) {
				return;
			}
			
			if(xhr.status !== 200) {
				return;
			}
			if(xhr.readyState === 4) {
				callback(xhr);
			}			
		}
		xhr.open('GET', url, true);
		xhr.send('');
	
},
XSAjax = (function() {
/*
XSAjax.send({
	url:<string>,
	json:[{p1:value1,p2:value2}],
	before:[fn],
	after:[fn],
	charset:[string]
})					 
*/					 
    function jsontoUrl(_) {
        var $ = [];
        if (!_) return "";
        for (var A in _){ 
			$.push(A + "=" + encodeURIComponent(_[A]));
		}
        return $.join("&")
    }
    function formatUrl(url, p) {
        var ra = "";

        if (!url) return "";
        if (!!p) ra = p + "&";
        //_ += "ra=" + Math.random();
        ra += "ra="+ (new Date()).getTime();
		
		if ( - 1 < url.indexOf("?")) {
			return url + "&" + ra;
		}
		
        return url + "?" + ra
    }
    function createJS(D) {
        if (!D || !D.url){return;}
        if (D.before && typeof D.before == "function") {
			D.before();
		}
        var params = "", JS, URI;
        params = jsontoUrl(D.json);
        URI = formatUrl(D.url, params);
        JS = document.createElement("SCRIPT");
        JS.type = "text/javascript";
        JS.src = URI;
		JS.charset = D.charset||"gb2312";

        if (Browser.isIE){ 
			JS.onreadystatechange = function() {
				if (JS.readyState == "complete" || JS.readyState == "loaded") {
					//document.getElementsByTagName("head")[0].removeChild(JS);
					if (D.after && typeof D.after == "function"){
						
						D.after()
					}
				}
        	};
		}else {
			JS.onload = function() {
            	document.getElementsByTagName("head")[0].removeChild(JS);
            	if (D.after && typeof D.after == "function"){
					D.after()
				}
        	};
		}
        document.getElementsByTagName("head")[0].appendChild(JS)
    }
    function _send(_) {
        window.setTimeout(function() {
            var A = _;
            createJS(A)
        },0)
    }
    return {
        send: _send
    }
})(),

cache = (function() {
    var cacheBox = {};
    function _get(name) {
        if (cacheBox[name]) return cacheBox[name];
        return null
    }
    function _set(name, value, A) {
        if (!A) {cacheBox[name] = value;}
        else {
            if (Yl.getType(cacheBox[name])!="array"){ cacheBox[name] = [];}
            cacheBox[name].push(value)
        }
    }
    function _remove(name) {
        delete cacheBox[name]
    }
    function _is(name) {
        return (_get(name) == null) ? false: true
    }
    return {
        get: _get,
        set: _set,
        is: _is,
        remove: _remove
    }
})(),
format = function(_, B) {
    if (arguments.length > 1) {
        var F = format,
        H = /([.*+?^=!:${}()|[\]\/\\])/g,
        C = (F.left_delimiter || "{").replace(H, "\\$1"),
        A = (F.right_delimiter || "}").replace(H, "\\$1"),
        E = F._r1 || (F._r1 = new RegExp("#" + C + "([^" + C + A + "]+)" + A, "g")),
        G = F._r2 || (F._r2 = new RegExp("#" + C + "(\\d+)" + A, "g"));
        if (typeof(B) == "object") return _.replace(E,
        function(_, A) {
            var $ = B[A];
            if (typeof $ == "function") $ = _$(A);
            return typeof($) == "undefined" ? "": $
        });
        else if (typeof(B) != "undefined") {
            var D = Array.prototype.slice.call(arguments, 1),
            $ = D.length;
            return _.replace(G,
            function(A, _) {
                _ = parseInt(_, 10);
                return (_ >= $) ? A: D[_]
            })
        }
    }
    return _
}
function DOMReady(f){
  if (/(?!.*?compatible|.*?webkit)^mozilla|opera/i.test(navigator.userAgent)){ // Feeling dirty yet?
    document.addEventListener("DOMContentLoaded", f, false);
  }  else {
    window.setTimeout(f,0);
  }
}


if(Browser.isIE=='6.0'){
	document.execCommand("BackgroundImageCache", false, true);
}



function pngfix(img){
	if(Browser.isIE!=="6.0"){return;}
		var imgStyle = "display:inline-block; " + img.style.cssText;
		var strNewHTML = "<span class=\"" + img.className + "\" title=\"" + img.title + "\" style=\"width:" + img.clientWidth + "px; height:" + img.clientHeight + "px;" + imgStyle + ";" + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + img.src + "', sizingMethod='crop');\"></span>";
		img.outerHTML = strNewHTML;
}//ie6 png

