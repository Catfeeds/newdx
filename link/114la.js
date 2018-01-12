(function(){
	var html = '<div style="display:none;"><img src="http://img.tongji.linezing.com/352431/tongji.gif" />';
	var sn = window.location.search;
	if(sn && sn.length >= 3 && sn.length <21 &&window.location.pathname =="/"){
		switch(sn){
			case '?alicall':
				html+='<script src="http://s11.cnzz.com/stat.php?id=2084822&web_id=2084822" language="JavaScript"></script>';
				break;
			case '?hang':
				html+='<script src="http://s4.cnzz.com/stat.php?id=2145497&web_id=2145497" language="JavaScript"></script>';
				break;
			case '?setup':
                html+='<script src="http://s15.cnzz.com/stat.php?id=2294331&web_id=2294331" language="JavaScript"></script>';
			    break;
			case '?alex':
				html+='<script src="http://s9.cnzz.com/stat.php?id=2153744&web_id=2153744" language="JavaScript"></script>';
				break;
			case '?good':
				html+='<script src="http://s9.cnzz.com/stat.php?id=2166499&web_id=2166499" language="JavaScript"></script>';
				break;
			case '?wgho':
				html+='<script src="http://s9.cnzz.com/stat.php?id=2166507&web_id=2166507" language="JavaScript"></script>';
				break;
			case '?ie567':
				html+='<script src="http://s9.cnzz.com/stat.php?id=2166511&web_id=2166511" language="JavaScript"></script>';
				break;
			case '?pengxiaoyu2800':
				html+='<script src="http://s9.cnzz.com/stat.php?id=2166514&web_id=2166514" language="JavaScript"></script>';
				break;
			case '?iemate':
				html+='<script src=" http://s11.cnzz.com/stat.php?id=2225146&web_id=2225146" language="JavaScript"></script>';
				break;
		}
	}	
	html+='</div>';
	document.writeln(html);
})();
