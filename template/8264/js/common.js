//文本框得到与失去焦点
function clearTxt(id,txt) {
	if (document.getElementById(id).value == txt)
		document.getElementById(id).value="" ;
	return ;
}
function fillTxt(id,txt) {
	if ( document.getElementById(id).value == "" )
		document.getElementById(id).value=txt;
	return ;
}

//焦点图片轮换
function $(id) { return document.getElementById(id); }

function addLoadEvent(func){
	var oldonload = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = func;
	} else {
		window.onload = function(){
			oldonload();
			func();
		}
	}
}

function addBtn() {
	if(!$('focus_turn')||!$('focus_pic')||!$('focus_tx')) return;
	var focusList = $('focus_pic').getElementsByTagName('li');
	if(!focusList||focusList.length==0) return;
	var btnBox = document.createElement('div');
	btnBox.setAttribute('id','focus_btn');
	var SpanBox ='';
	for(var i=1; i<=focusList.length; i++ ) {
		var spanList = '<span class="normal">'+i+'</span>';
		SpanBox += spanList;
	}
	btnBox.innerHTML = SpanBox;
	$('focus_turn').appendChild(btnBox);
	$('focus_btn').getElementsByTagName('span')[0].className = 'current';
}

function classNormal(){
	var focusList = $('focus_pic').getElementsByTagName('li');
	var btnList = $('focus_btn').getElementsByTagName('span');
	var txList = $('focus_tx').getElementsByTagName('li');
	for(var i=0; i<focusList.length; i++) {
		focusList[i].className='normal';
		btnList[i].className='normal';
		txList[i].className='normal';
	}
}

function classCurrent(n){
	var focusList = $('focus_pic').getElementsByTagName('li');
	var btnList = $('focus_btn').getElementsByTagName('span');
	var txList = $('focus_tx').getElementsByTagName('li');
	focusList[n].className='current';
	btnList[n].className='current';
	txList[n].className='current';
}

var autoKey = false;
function btnTurn() {
	if(!$('focus_turn')||!$('focus_pic')||!$('focus_tx') || !$('focus_btn')) return;
	$('focus_turn').onmouseover = function(){autoKey = true};
	$('focus_turn').onmouseout = function(){autoKey = false};	
	var focusList = $('focus_pic').getElementsByTagName('li');
	var btnList = $('focus_btn').getElementsByTagName('span');
	var txList = $('focus_tx').getElementsByTagName('li');
	for (var m=0; m<btnList.length; m++){
		btnList[m].onmouseover = function() {
			classNormal();
			this.className='current';
			var n=this.childNodes[0].nodeValue-1;
			focusList[n].className='current';
			txList[n].className='current';
		}
	}
}

addLoadEvent(addBtn);
addLoadEvent(btnTurn);
addLoadEvent(setautoturn);

function setautoturn() {
	setInterval('autoTurn()', 5000);
}

function autoTurn() {
	if(!$('focus_turn')||!$('focus_pic')||!$('focus_tx')) return;
	if (autoKey) return;
	var focusList = $('focus_pic').getElementsByTagName('li');
	var btnList = $('focus_btn').getElementsByTagName('span');
	var txList = $('focus_tx').getElementsByTagName('li');
	for(var i=0; i<focusList.length; i++) {
		if (focusList[i].className == 'current') {
			var currentNum = i;
		}
	}
	if (currentNum==focusList.length-1 ){
		classNormal();
		classCurrent(0);
	} else {
		classNormal();
		classCurrent(currentNum+1);
	}

}

//相册焦点图片切换
function imageFocus(){
	if(!$('image_focus')||!$('image_focus_big')||!$('image_focus_small')) return;
	var imageSmallLists= $('image_focus_small').getElementsByTagName('li');
	var imageBigLists= $('image_focus_big').getElementsByTagName('li');
	for(var i=0; i<imageSmallLists.length; i++){
		imageSmallLists[i].setAttribute('nodeNo',i);
	}
	for(var i=0; i<imageSmallLists.length; i++){
		imageSmallLists[i].onmouseover= function() {
			var n= this.getAttribute('nodeNo');
			for(var m=0; m<imageBigLists.length; m++){
				imageBigLists[m].className='';	
			}
			imageBigLists[n].className='current';		
		}
	}
}
addLoadEvent(imageFocus);

//搜索
function searchBox(){
	if(!$('more_search')||!$('search_box')) return;
	$('more_search').onclick=function(){
		$('search_box').className= '';
		$('more_search').style.display='none';
		$('close_search').style.display='block';
	}
	
	$('close_search').onclick=function(){
		$('search_box').className= 'fixoneline';
		$('more_search').style.display='block';
		$('close_search').style.display='none';
	}

}
addLoadEvent(searchBox);

function addseccode() {
	
	if(noseccode != 0) return;
	
	$('login_authcode_input').style.display = 'block';
	if($('login_authcode_img').style.display == 'block') {
		$('login_authcode_img').style.display='none';
	} 
	$('login_showclose').style.display = 'block';
	$('user_login_position').className = 'current';
}

function showseccode() {
	$('login_authcode_img').style.display='block';
	updateseccode();
}

function hidesec() {
	$('login_authcode_input').style.display = 'none';
	$('login_showclose').style.display = 'none';
	$('login_authcode_img').style.display = 'none';
	$('user_login_position').className = '';
}


// common class for 8264.com
var C8264 = function(){
  return {
    // 添加事件
    addEvent:function(elm, evType, fn, useCapture) {
      if (elm.addEventListener) 
      {
        elm.addEventListener(evType, fn, useCapture);
        return true;
      } else if (elm.attachEvent) {
        var r = elm.attachEvent('on' + evType, fn);
        return r;
      } else {
        elm['on' + evType] = fn;
      }
    },
    // 通过className获取元素
    getByClass:function(searchClass,node,tag) {
        var classElements = new Array();
        if ( node == null )
          node = document;
        if ( tag == null )
          tag = '*';
        var els = node.getElementsByTagName(tag);
        var elsLen = els.length;
        var pattern = new RegExp('(^|\\\\s)'+searchClass+'(\\\\s|$)');
        for (i = 0, j = 0; i < elsLen; i++) {
          if ( pattern.test(els[i].className) ) {
            classElements[j] = els[i];
            j++;
          }

        }
        return classElements;
    },
      browser:function(){
        var userAgent = navigator.userAgent.toLowerCase();
        return {
          version:(userAgent.match(/.+(?:rv|it|ra|ie)[/: ]([d.]+)/) || [0,'0'])[1],
          safari:/webkit/.test(userAgent),
          opera:/opera/.test(userAgent),
          msie:/msie/.test(userAgent) && !/opera/.test(userAgent),
          mozilla:/mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent)
        }
    }
               
  }
};
// common class for 8264.com
var C8264 = function(){
  return {
    // 添加事件
    addEvent:function(elm, evType, fn, useCapture) {
      if (elm.addEventListener) 
      {
        elm.addEventListener(evType, fn, useCapture);
        return true;
      } else if (elm.attachEvent) {
        var r = elm.attachEvent('on' + evType, fn);
        return r;
      } else {
        elm['on' + evType] = fn;
      }
    },
    // 通过className获取元素
    getByClass:function(searchClass,node,tag) {
        var classElements = new Array();
        if ( node == null )
          node = document;
        if ( tag == null )
          tag = '*';
        var els = node.getElementsByTagName(tag);
        var elsLen = els.length;
        var pattern = new RegExp('(^|\\\\s)'+searchClass+'(\\\\s|$)');
        for (i = 0, j = 0; i < elsLen; i++) {
          if ( pattern.test(els[i].className) ) {
            classElements[j] = els[i];
            j++;
          }

        }
        return classElements;
    },
    browser:function(){
        var userAgent = navigator.userAgent.toLowerCase();
        return {
          version:(userAgent.match(/.+(?:rv|it|ra|ie)[/: ]([d.]+)/) || [0,'0'])[1],
          safari:/webkit/.test(userAgent),
          opera:/opera/.test(userAgent),
          msie:/msie/.test(userAgent) && !/opera/.test(userAgent),
          mozilla:/mozilla/.test(userAgent) && !/(compatible|webkit)/.test(userAgent),
          ie6:/msie 6/.test(userAgent),
          ua: userAgent
        }
    }
  }
};
var c8 = new C8264();
function SimpleTabs(opts)
{
	this.opts = {
	  // autobind 为事件自动绑定	
		autobind: true,
    // 当前类
		activeclass: 'active',
    // 内容区前缀， 例如: 舌签id名为 dasha , 则其对应内容区id为 sq-dasha
		bodIdPrefix: 'sq-',
    // 事件类型 鼠标点击click或者悬停mouseover
    triggerEvent: 'mouseover'
	};
	this.tabs = [];
	//  当前舌签的索引值
	this.active = false;

	if ( !! opts )
		for ( var i in opts )
			this.opts[i] = opts[i];
}

SimpleTabs.prototype = {
	add: function(btn, opts, bod) {
		// if no bod is passed, try to find the tab body using the getBod function (getBod can be overridden)
		if ( ! bod )
			bod = this.getBod(btn);

		var idx = this.tabs.length;

		this.tabs[idx] = {
			idx: idx,
			btn: btn,
			bod: bod,
			opts: ( ! opts ? {} : opts )
		};

		// if autobind is true, then use the internal (poor) binding
		if ( this.opts.autobind )
			this.bind(idx);

		// if this tab is already set to active, set it to active internally
		if ( btn.className.indexOf(this.opts.activeclass) > -1 )
			this.activate(idx);

		return idx;
	},

	// returns the tabs idx corresponding to the tab button passed
	// useful if you have your own custom binding
	idxFromEl: function(el) {
		for ( var i=0; i < this.tabs.length; i++ )
			if ( this.tabs[i].btn == el )
				return i;

		return false;
	},

	get: function (idx) {  // returns active if no idx is specified
		if ( typeof idx == 'undefined' ) // no idx passed, get active
		{
			if ( false !== this.active )
				return this.tabs[this.active];
		}
		else
		{
			if ( this.tabs[idx] )
				return this.tabs[idx];
		}
		return false;
	},
	// activate a tab based on a tab idx
	activate: function(idx) {
		var targtab = this.get(idx);
		if ( ! targtab )
			return false;

		if ( false === ( targtab.opts.before && targtab.opts.before.call(this, targtab) ) )
			return false; // before returned false, cancel switch

		if ( false !== this.active ) // is there a previously active tab?
		{
			var active = this.get();
			if ( false === ( active.opts.beforeinactive && active.opts.beforeinactive.call(this, active) ) )
				return false;

			// remove active classnames for tab btn/bod
			new RegExp("\\$TESTONE","gm")
			active.btn.className = active.btn.className.replace(new RegExp(this.opts.activeclass,'gm'), '');
			if ( active.bod )
				active.bod.className = active.bod.className.replace(new RegExp(this.opts.activeclass,'gm'), '');

			active.opts.inactive && active.opts.inactive.call(this, active);
		}

		this.active = idx;

		targtab.btn.className += ' '+this.opts.activeclass;
		if ( targtab.bod )
			targtab.bod.className += ' '+this.opts.activeclass;

		targtab.opts.after && targtab.opts.after.call(this, targtab);
	},
	// 自动绑定事件
	// 当 { autobind: true }时有效 
	bind: function(idx) {
		var thisobj = this;
		c8.addEvent(this.tabs[idx].btn,this.opts.triggerEvent,function(e) {
			if ( ! e )  e = window.event;
			e.preventDefault && e.preventDefault();
			e.returnValue = false;
			thisobj.activate.call(thisobj, idx); 
			return false;
		});
	},
	// 根据舌签id找相应内容区 
	getBod: function(btn) {
		var id = this.opts.bodIdPrefix + ( btn.id && btn.id.indexOf('-') > -1 ? btn.id.split('-')[1] : btn.id );
		var n = document.getElementById(id);
		return n ? n : false;
	}
};


// page logic class for 8264.com
var P8264 = function(){
    return {
       loadTabs:function(tabsClass,eventType) {
          var tabarr = c8.getByClass(tabsClass);
          for ( var i=0; i < tabarr.length; i++ ) {
            var mytabs = new SimpleTabs({triggerEvent:eventType});
            var nodes = tabarr[i].getElementsByTagName('A');
            for ( var o=0; o < nodes.length; o++ ) {
              mytabs.add(nodes[o]);
            }
          }
        } 
    }
}; 

function insurego(evt){
   if(evt.preventDefault) {
	   evt.preventDefault();
   } else {
	   evt.returnValue = false;
   }

	var insuretype= document.getElementById('insuretype');
	
	var url = insuretype.options[insuretype.selectedIndex].value;
	insuretype.options[insuretype.selectedIndex].value = '';
	document.insureform.action = url;
	document.insureform.submit();

	//window.location.href = url;
	//window.event.returnValue=false;
	//return false;
}

var p8 = new P8264();
p8.loadTabs('sheqian','click');
p8.loadTabs('sheqian2','mouseover');
// ie6 下闪烁bug修复
if(c8.browser().ie6) document.execCommand("BackgroundImageCache", false, true);
