//create by JiangHong
var maptype = BMAP_HYBRID_MAP;
var waypoint_label_size_x = 20;
var waypoint_label_size_y = -30;
var waypoint_label_style = {display:'none', borderColor:'yellow'};
// var lvpng = 'http://bbs.8264.com/static/images/lv_move_small.gif';
// var lvpng = 'http://bbs.8264.com/static/images/manwalk.gif';
var lvpng = 'http://bbs.8264.com/static/images/qizi.png';
var lvsize_x = 24;
var lvsize_y = 30;
var lvoffset_x = 12;
var lvoffset_y = -15;
var lvlabelshow = true;
var lvlabeloffset_x = 0;
var lvlabeloffset_y = 30;
var copyrightshow = true;
var copyright_anchor = BMAP_ANCHOR_BOTTOM_LEFT;
var copyright_offset_x = 0;
var copyright_offset_y = -18;
var copyright_id = 8264;
var copyright_content = '<a target="_blank" href="http://bbs.8264.com"><img src="http://bbs.8264.com/static/image/common/bbs_logo.png"/></a>';
var shownavctl = true;
var showscactl = true;
var showoverview = false;
var showoverview_isopen = false;
var showoverview_anchor = BMAP_ANCHOR_TOP_LEFT;
var showoverview_size_x = 150;
var showoverview_size_y = 150;
var showoverview_offset_x = 0;
var showoverview_offset_y = 0;
var maptypectlshow = false;
var maptypectl_arr =[BMAP_NORMAL_MAP, BMAP_HYBRID_MAP, BMAP_SATELLITE_MAP];
var trk_canplay = true;
var play_timer = 50;
var end_timer = 2000;
var start_tips = "准备出发喽！";
var end_tips = "到达终点，我要瞬移回起点啦！！";
var navctlctl_anchor = BMAP_ANCHOR_TOP_LEFT;
var navctlctl_offset_x = 10;
var navctlctl_offset_y = 40;
var navctlctl_showzoom = false;
var navctlctl_type = BMAP_NAVIGATION_CONTROL_LARGE;

var BROWSER = {};
var USERAGENT = navigator.userAgent.toLowerCase();
browserVersion({'ie':'msie','firefox':'','chrome':'','opera':'','safari':'','mozilla':'','webkit':'','maxthon':'','qq':'qqbrowser'});
if(BROWSER.safari) {
	BROWSER.firefox = true;
}
BROWSER.opera = BROWSER.opera ? opera.version() : 0;
HTMLNODE = document.getElementsByTagName('head')[0].parentNode;
if(BROWSER.ie) {
	HTMLNODE.className = 'ie_all ie' + parseInt(BROWSER.ie);
}
function browserVersion(types) {
	var other = 1;
	for(i in types) {
		var v = types[i] ? types[i] : i;
		if(USERAGENT.indexOf(v) != -1) {
			var re = new RegExp(v + '(\\/|\\s)([\\d\\.]+)', 'ig');
			var matches = re.exec(USERAGENT);
			var ver = matches != null ? matches[2] : 0;
			other = ver !== 0 && v != 'mozilla' ? 0 : other;
		}else {
			var ver = 0;
		}
		eval('BROWSER.' + i + '= ver');
	}
	BROWSER.other = other;
}