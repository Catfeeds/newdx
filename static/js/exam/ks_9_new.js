function AutoNextExam(a) {
	try {
		if ("Y" == a) return setTimeout("gotoExam(orderNext)", 100), event.returnValue = !1, !1
	} catch (b) {}
}
function showExamTp(a) {
	if (!a) return "";
	var b = a;
	return b.indexOf("flv") > 0 ? '<div id="dhArea"></div>' : (b = getEmTp(b), '<p><img src="' + b + '" onclick="MaxEmTp();"></p>')
}
function MaxEmTp() {
	var a = jQuery("#ExamTit p img").attr("src");
	a = a.replace("mnks.cn/s/", "mnks.cn/"), 
		jQuery("#ExamTit p img").attr("src", a), 
		jQuery("#ExamTit p img").addClass("max"), 
		jQuery("#ExamTit p img").unbind("click"), 
		jQuery("#ExamTit p img").attr("onclick", ""), 
		jQuery("#ExamTit p img").click(function() {
		MinEmTp()
	})
}
function MinEmTp() {
	jQuery("#ExamTit p img").removeClass("max"), 
		jQuery("#ExamTit p img").unbind("click"), 
		jQuery("#ExamTit p img").attr("onclick", ""),
		jQuery("#ExamTit p img").click(function() {
		MaxEmTp()
	})
}
function gotoExamPre() {
	gotoExam(orderPre)
}
function gotoExamNext() {
	gotoExam(orderNext)
}
function gotoExam(a) {
	if (a = Math.abs(a), 1 > a) return ExamTip("已经是第一题了"), !1;
	a > ExamCount && (ExamTip("已经是最后一题了"), a = ExamCount), orderTmp = a, jQuery("#mkT3 i").html("<span>" + a + "</span>/" + ExamCount);
	var c = (ExamID[a], ExamTx[a]),
		d = ExamTm[a],
		e = ExamTp[a];
	ExamDa[a], SortID[a];
	jQuery("body,html").animate({
		scrollTop: 0
	}, 10);
	var h = d.split("<br/>"),
		i = h[0];
	var Em_len = (h.length-1);
	i = i || "";
	var j = h[1],
		k = h[2],
		l = h[3],
		m = h[4],
		x = h[5],
		y = h[6];
	if (j = j || "", k = k || "", l = l || "", m = m || "", x = x || "", y = y || "", 
		3 == c && (i += '<font style="margin-left:4px;color:#f26">[多选题]</font>'),
		sflag == 1 && (i += ' (题号：'+ExamID[a]+') '),
		jQuery("#ExamTit").html("<b>" + a + ".</b>&nbsp;&nbsp;" + i ), 
		jQuery("#ExamOptA").html(j), jQuery("#ExamOptB").html(k), 
		jQuery("#ExamOptC").html(l), jQuery("#ExamOptD").html(m), 
		(Em_len> 4 ? jQuery("#ExamOptE").html(x) : '') , (Em_len> 5 ? jQuery("#ExamOptF").html(y) : '') , 
		e.indexOf("flv") > 0 && (e = e.replace(/\aq2013_/g, ""), __qv__(dhFLV(e), 300, 120, document.getElementById("dhArea"))), 
		jQuery("#ExamOptB").removeClass("e"), 
		jQuery("#ExamOptD").removeClass("e"), 
		jQuery("#ExamOptE").removeClass("e"), 
		jQuery("#ExamOptF").removeClass("e"), 
		1 == c ? (jQuery("#ExamOptC").hide(), jQuery("#ExamOptD").hide(), jQuery("#ExamOptE").hide(), jQuery("#ExamOptF").hide(), jQuery("#ExamOptB").addClass("e")) : 
		(2 == c || 3 == c) && (jQuery("#ExamOptA").show(), 
			jQuery("#ExamOptB").show(), 
			( Em_len > 2 ? jQuery("#ExamOptC").show() : jQuery("#ExamOptC").hide() ), 
			( Em_len > 3 ? jQuery("#ExamOptD").show() : jQuery("#ExamOptD").hide() ), 
			(Em_len> 4 ? jQuery("#ExamOptE").show() : jQuery("#ExamOptE").hide()), 
			(Em_len> 5 ? jQuery("#ExamOptF").show() : jQuery("#ExamOptF").hide()),

			(Em_len == 2 && jQuery("#ExamOptB").addClass("e") ),
			(Em_len == 3 && jQuery("#ExamOptC").addClass("e") ),
			(Em_len == 4 && jQuery("#ExamOptD").addClass("e") ),
			(Em_len == 5 && jQuery("#ExamOptE").addClass("e") ),
			(Em_len == 6 && jQuery("#ExamOptF").addClass("e") )
//			(Em_len> 4 ? (Em_len> 5 ? jQuery("#ExamOptF").addClass("e") : jQuery("#ExamOptE").addClass("e") ) : jQuery("#ExamOptD").addClass("e") ) 
		),

		jQuery("#ExamArea h5").hide(), 
		jQuery("#ExamArea h5").html(""), 
		3 != c || (3 != c && ExamDaSel[orderTmp]) || 1 == ExamEnter || (jQuery("#ExamArea h5").show(), 
		jQuery("#ExamArea h5").html('<b><!--友情提醒：本题为多选题。-->&nbsp;</b><p onclick="gotoKey(\'OK\');" class="xk_b dxqd">确定 我选好了</p>')), KeyToView(), orderPre = a - 1, orderNext = a + 1, 0 == ExamEnter)
		//功能：自动跳过已经做过的题
		//for (; ExamDaSel[orderNext] && ExamCount > orderNext;) orderNext++;
	var n = a / ExamCount;
	n = 1e3 * n, n = Math.round(n), 1 > n && (n = 1), n = n / 10 + "%", jQuery("#mkT3").attr("title", "练习进度: " + n), 3 > a && (a = 3), a > ExamCount && (a = ExamCount - 0);
	var o = a - 2;
	0 >= o && (o = 1);
	var p = a + 0;
	0 >= p && (p = 1);
	if(ExamEnter == 1){
		for (var q = "", r = o; p >= r; r++) {
			var s = "";
			ExamDaSel[r] && (s = ExamDaSel[r] == ExamDa[r] ? ' class="r"' : ' class="e"'), q = q + "<u" + s + ">" + r + "</u>"
		}
	}else{
		for (var q = "", r = o; p >= r; r++) {
			var s = "";
			ExamDaSel[r] && (s = ExamDaSel[r] == ExamDa[r] ? ' class="d"' : ' class="d"'), q = q + "<u" + s + ">" + r + "</u>"
		}
	}
	1 == p ? q += "<u>&nbsp;</u><u>&nbsp;</u>" : 2 == p && (q += "<u>&nbsp;</u>"), jQuery("#mkT3 p b").html(q), q = "", EDS = ""
}
function gotoKey(a) {
	var b = ExamDaSel[orderTmp];
	if(b && !EDS){
		EDS = b;
	}
	var c = ExamTx[orderTmp];
//	if (b) return !1;
	if (1 == ExamEnter) return !1;
	b ? isAuto = "N" : isAuto = "Y", a = a.toUpperCase();
	
	if (3 == c) {
		isAuto = "Y";
		if ("OK" != a){
			return "A" == a && (EDS.indexOf("A") >= 0 ? (EDS = EDS.replace(/A/g, ""), jQuery("#ExamOptA").removeClass("kS")) : (EDS += "A", jQuery("#ExamOptA").addClass("kS"))), 
				"B" == a && (EDS.indexOf("B") >= 0 ? (EDS = EDS.replace(/B/g, ""), jQuery("#ExamOptB").removeClass("kS")) : (EDS += "B", jQuery("#ExamOptB").addClass("kS"))), 
				"C" == a && (EDS.indexOf("C") >= 0 ? (EDS = EDS.replace(/C/g, ""), jQuery("#ExamOptC").removeClass("kS")) : (EDS += "C", jQuery("#ExamOptC").addClass("kS"))), 
				"D" == a && (EDS.indexOf("D") >= 0 ? (EDS = EDS.replace(/D/g, ""), jQuery("#ExamOptD").removeClass("kS")) : (EDS += "D", jQuery("#ExamOptD").addClass("kS"))), 
				"E" == a && (EDS.indexOf("E") >= 0 ? (EDS = EDS.replace(/E/g, ""), jQuery("#ExamOptE").removeClass("kS")) : (EDS += "E", jQuery("#ExamOptE").addClass("kS"))), 
				"F" == a && (EDS.indexOf("F") >= 0 ? (EDS = EDS.replace(/F/g, ""), jQuery("#ExamOptF").removeClass("kS")) : (EDS += "F", jQuery("#ExamOptF").addClass("kS"))), 
				EDS = formatKey(EDS), !1;

		}
		if (a = EDS, !a) return alert("请给出答案！"), !1;
		jQuery("#ExamArea h5").hide(), jQuery("#ExamArea h5").html("")
	};
	ExamDaSel[orderTmp] = a, ("" == a || void 0 == a || void 0 == b) && (b = ""), KeyToView();
	try {} catch (d) {}
	AutoNextExam(isAuto)
}
function formatKey(a) {
	return a ? (a = a.toUpperCase(), svT = "", a.indexOf("A") >= 0 && (svT += "A"), a.indexOf("B") >= 0 && (svT += "B"), a.indexOf("C") >= 0 && (svT += "C"), a.indexOf("D") >= 0 && (svT += "D"), a.indexOf("E") >= 0 && (svT += "E"), a.indexOf("F") >= 0 && (svT += "F"), svT) : ""
}
function KeyToView() {
	var a = ExamDaSel[orderTmp];
	a = a.toUpperCase();
	var b = ExamDa[orderTmp],
		c = ExamTx[orderTmp];
	jQuery("#ExamOpt li").removeClass("kR"), 
	jQuery("#ExamOpt li").removeClass("kE"), 
	jQuery("#ExamOpt li").removeClass("kH"), 
	jQuery("#ExamOpt li").removeClass("kK"), 
		jQuery("#ExamOpt li").removeClass("kS"), 
		jQuery("#ExamOpt li").addClass("kH"), a ? 1 == ExamEnter ? 3 == c ? (
		a.indexOf("A") >= 0 ? b.indexOf("A") >= 0 ? jQuery("#ExamOptA").addClass("kR") : jQuery("#ExamOptA").addClass("kE") : b.indexOf("A") >= 0 && jQuery("#ExamOptA").addClass("kK"), 
		a.indexOf("B") >= 0 ? b.indexOf("B") >= 0 ? jQuery("#ExamOptB").addClass("kR") : jQuery("#ExamOptB").addClass("kE") : b.indexOf("B") >= 0 && jQuery("#ExamOptB").addClass("kK"), 
		a.indexOf("C") >= 0 ? b.indexOf("C") >= 0 ? jQuery("#ExamOptC").addClass("kR") : jQuery("#ExamOptC").addClass("kE") : b.indexOf("C") >= 0 && jQuery("#ExamOptC").addClass("kK"), 
		a.indexOf("D") >= 0 ? b.indexOf("D") >= 0 ? jQuery("#ExamOptD").addClass("kR") : jQuery("#ExamOptD").addClass("kE") : b.indexOf("D") >= 0 && jQuery("#ExamOptD").addClass("kK"),
		a.indexOf("E") >= 0 ? b.indexOf("E") >= 0 ? jQuery("#ExamOptE").addClass("kR") : jQuery("#ExamOptE").addClass("kE") : b.indexOf("E") >= 0 && jQuery("#ExamOptE").addClass("kK"),
		a.indexOf("F") >= 0 ? b.indexOf("F") >= 0 ? jQuery("#ExamOptF").addClass("kR") : jQuery("#ExamOptF").addClass("kE") : b.indexOf("F") >= 0 && jQuery("#ExamOptF").addClass("kK")
		) : ( a == b ? jQuery("#ExamOpt" + a).addClass("kR") : (jQuery("#ExamOpt" + b).addClass("kK"), jQuery("#ExamOpt" + a).addClass("kE"))) : 3 == c ? (
		a.indexOf("A") >= 0 && jQuery("#ExamOptA").addClass("kS"), 
		a.indexOf("B") >= 0 && jQuery("#ExamOptB").addClass("kS"), 
		a.indexOf("C") >= 0 && jQuery("#ExamOptC").addClass("kS"), 
		a.indexOf("D") >= 0 && jQuery("#ExamOptD").addClass("kS"),
		a.indexOf("E") >= 0 && jQuery("#ExamOptE").addClass("kS"),
		a.indexOf("F") >= 0 && jQuery("#ExamOptF").addClass("kS")
		) : (jQuery("#ExamOpt" + a).addClass("kS")) : 1 == ExamEnter && (3 == c ? (b.indexOf("A") >= 0 && jQuery("#ExamOptA").addClass("kK"), b.indexOf("B") >= 0 && jQuery("#ExamOptB").addClass("kK"), b.indexOf("C") >= 0 && jQuery("#ExamOptC").addClass("kK"), b.indexOf("D") >= 0 && jQuery("#ExamOptD").addClass("kK")) : (b = b.replace("对", "A"), b = b.replace("错", "B"), jQuery("#ExamOpt" + b).addClass("kK"))), 1 == ExamEnter && (jQuery("#ExamNote").hide(), ExamNoteView(""))
}
function ExamNoteView(a) {
	if ("close" == a) return jQuery("#ExamNote").hide(), !1;
	jQuery("#ENC").html("");
	var b = ExamNote[orderTmp];
	if (!b){
		var c = ExamNote[orderTmp];
		jQuery("#ENC").html(c), c || (c = "N404"), c.indexOf("404 Not Found") > 0 && (c = "N404"), b = c, c = "", ExamNote[orderTmp] = b
	}
	b = b.replace("N404", ""), 
	b || (b = "暂无分析"), 
	RightKeyVal = ExamDa[orderTmp], 
	RightKeyVal = RightKeyVal.replace("对", "正确"), 
	RightKeyVal = RightKeyVal.replace("错", "错误"), 
	b = "<strong>参考答案</strong>：" + RightKeyVal + "<br/><strong>本题分析</strong>：" + b;
	if(ExamTp[orderTmp] != ''){
		b += "<br><br><img src="+ ExamTp[orderTmp] +" />";
	}
	if(ExamVideo[orderTmp] != ''){
		b += '<span class="shipinbox"><iframe src="'+ ExamVideo[orderTmp] +'" frameborder=0 "allowfullscreen"></iframe></span>';
	}
	jQuery("#ENC").html(b); 
	jQuery("#ExamNote").slideDown(200); 
	b = "";
}
function ViewExamOrderKep(a) {
	if ("0px" == jQuery("#ExamOrderKep").css("height")) {
//		jQuery("#ExamOrderKep").show(), jQuery("#ExamOrderKep").animate({
//			height: "100%"
//		}, 200), jQuery("#ExamOrderKep p").css("width", Math.round(.95 * jQuery(window).width()) + "px");
		jQuery("#ExamOrderKep").show(), jQuery("#ExamOrderKep").animate({
			height: "100%"
		}, 200);
		var b = jQuery("#ExamOrderKep p").width(),
			c = Math.floor(b / 60),
			d = Math.ceil(ExamCount / c),
			e = Math.ceil(orderTmp / c);
		if (Math.round(60 * d) > Math.round(jQuery(window).height() - 120)) {
			if (e > 3) var f = 60 * Math.round(e - 3);
			else var f = 0;
			jQuery("#ExamOrderKep").scrollTop(f)
		}
		var b = 61 * c,
			g = Math.floor(Math.round(jQuery(window).width() - b) / 2);
//		jQuery("#ExamOrderKep p").css({
//			width: b,
//			left: g
//		});
		var h = 61 * d,
			h = h + 50;
//		jQuery("#ExamOrderKep p").css({
//			height: h,
//			padding: "50px 0 0 0"
//		});
		if(ExamEnter == 1){
			for (var i = "", j = 1; ExamCount >= j; j++) {
				var k = "",
					l = "";
				orderTmp == j && (l = " h"), ExamDaSel[j] && (k = ExamDaSel[j] == ExamDa[j] ? ' class="r"' : ' class="e"'), i = i + "<u" + k + ">" + j + "</u>"
			}
		}else{
			for (var i = "", j = 1; ExamCount >= j; j++) {
				var k = "",
					l = "";
				orderTmp == j && (l = " h"), ExamDaSel[j] && (k = ExamDaSel[j] == ExamDa[j] ? ' class="d"' : ' class="d"'), i = i + "<u" + k + ">" + j + "</u>"
			}
		}
		
		jQuery("#ExamOrderKep p").html(i), i = "", jQuery("#ExamOrderKep p").find("u").eq(Math.round(orderTmp - 1)).addClass("h"), jQuery("#ExamOrderKep p u").click(function() {
			gotoExam(jQuery(this).html())
		}), jQuery("#HR p").unbind("click"), jQuery("#HR p").attr("onclick", ""), jQuery("#HR p").click(function() {
			return ViewExamOrderKep(""), !1
		}), jQuery("#HR p img").attr("src", "http://sucimg.itc.cn/sblog/j68a8588cc9dc750080f74bc942fbd1b9"), jQuery("#HL p img").hide(), jQuery("#HC h2 a").html("<!--" + jQuery("#HC h2 a").html() + "-->\u9009\u9898")
	} else {
		jQuery("#ExamOrderKep").animate({
			height: "0px"
		}, 200), jQuery("#HR p").unbind("click"), jQuery("#HR p").attr("onclick", ""), jQuery("#HR p").click(function() {
			return BackPage("/autodown/"), !1
		}), jQuery("#HR p img").attr("src", "http://sucimg.itc.cn/sblog/j0fc3a42b802d9665015fb8e372608187"), jQuery("#HL p img").show();
		
	}
}
function goExamOrder(a) {
	if (a && !isNaN(a)) {
		if (a = Math.abs(a), 1 > a || a > ExamCount) return alert("题号输入超出范围［1～" + ExamCount + "］"), 
			jQuery("#ExamOrderV").val(""), jQuery("#ExamOrderV").focus(), !1;
		gotoExam(a), jQuery("#ExamOrderV").val("")
	}
	"0px" == jQuery("#ExamOrderArea").css("bottom") ? jQuery("#ExamOrderArea").animate({
		bottom: "48px"
	}, 200) : jQuery("#ExamOrderArea").animate({
		bottom: "0px"
	}, 200)
}
function ExamSubmitConfirm() {
	var a = 0;
	for (ExmC in Exams)"" != ExamDa[ExmC] && ExamDaSel[ExmC] && a++;
	var b = Math.round(Math.round(ExamCount) - Math.round(a));

	var url = '/exam.php?ctl=topic&act=ajaxcheckLogin';
	jQuery.ajax({
		type : 'POST',
		url : url,
		data : {'b':b},
		dataType : 'json',
		async: false,
		success:function(result){
			if(result == '0'){
				jQuery(".login").show();
				jQuery(".page").show();
			}else{
				if(b > 0){
					jQuery(".bg75black").show();
					jQuery(".noticepopbox").show();
					jQuery(".notice_left").html("您还有" + b + "道题没做，确认交卷吗？");
				}else{
					jQuery(".bg75black").show();
					jQuery(".noticepopbox").show();
					jQuery(".notice_left").html("确认交卷吗？");
				}
			}
		}
	});

	
}
function ExamSubmit() {
	ExamEnter = 1;
	var a = 0,
		b = 0,
		d = "",
		f = "",
		g = "",
		h = "";
	for (ExmC in Exams)"" != ExamDa[ExmC] && (ExamDaSel[ExmC] && (b++, ExamDaSel[ExmC] == ExamDa[ExmC] ? (a++) : (g = g + "," + ExamID[ExmC] + "-" + SortID[ExmC], h = h + "," + ExamDaSel[ExmC] )), d = d + "," + ExamID[ExmC] + "-" + SortID[ExmC], DaSel = ExamDaSel[ExmC], DaSel || (DaSel = "_"), f = f + "," + DaSel);
	var j = a;
	var rid = 0;
	a *= PointBase; 
	EPErr = g;

	var zql = (parseInt(a)/ExamCount);

	var url = '/exam.php?ctl=topic&act=postpoint';
	jQuery.ajax({
		type : 'POST',
		url : url,
		data : {'catid':ExamCatid, 'points':a, 'base':Exam_base, 'zql':zql, 'begintime':BeginDT, 'endtime':DT()},
		dataType : 'json',
		async: false,
		success:function(result){
			if(result == '-1'){
//				jQuery(".login").show();
//				jQuery(".page").show();
			}else{
	
				jQuery(".fenshu").html(a+"<i>分</i>");
				if(zql>=0 && zql<0.4){
					jQuery(".bg75black").hide();
					jQuery(".popbox span").html("确定不是手滑吗？");
					jQuery(".black70,.popbox ").addClass('flexShow');
				}else if(zql>=0.4 && zql<0.5){
					jQuery(".bg75black").hide();
					jQuery(".popbox span").html("你可能考了假分");
					jQuery(".black70,.popbox ").addClass('flexShow');
				}else if(zql>=0.5 && zql<0.6){
					jQuery(".bg75black").hide();
					jQuery(".popbox span").html("就差一点你就及格了！");
					jQuery(".black70,.popbox ").addClass('flexShow');
				}else if(zql>=0.6 && zql<0.7){
					jQuery(".bg75black").hide();
					jQuery(".popbox b").html("继续努力");
					jQuery(".popbox span").html("不用害怕回家找家长签字了");
					jQuery(".black70,.popbox ").addClass('flexShow');
				}else if(zql>=0.7 && zql<0.8){
					jQuery(".bg75black").hide();
					jQuery(".popbox b").html("继续努力");
					jQuery(".popbox span").html("放学别走，你需要补课！");
					jQuery(".black70,.popbox ").addClass('flexShow');
				}else if(zql>=0.8 && zql<0.9){
					jQuery(".bg75black").hide();
					jQuery(".popbox b").html("继续努力");
					jQuery(".popbox span").html("奖励你一朵小红花！");
					jQuery(".black70,.popbox ").addClass('flexShow');
				}else {
					var url = '/exam.php?ctl=topic&act=getimage';
					jQuery.ajax({
						type : 'POST',
						url : url,
						data : {'catid':ExamCatid, 'base':Exam_base},
						dataType : 'json',
						async: false,
						success:function(result){
							if(result.flag == '-1'){
								alert("非法参数");
							}
							if(result.flag == '1'){
								top.location = "/xuexiao/jiangzhuang.html";
							}
						}
					});
				}

				jQuery("#mkT7").hide(), 
				jQuery("#mkT8").show();

				jQuery("#mkT6").hide(), 
				jQuery("#mkT9").show();
			}
		}
	});
	
	
	
//	ExamCount == parseInt(a) ? MaskTip("得分", "<font color=#FF0000>恭喜！<br/><br/>您获得满分！太厉害了！！</font>", "查看错题", "重新考试", ExamReLoadErr, ExamReLoad, "", "", rid) : 
//	zql < 0.6 ? parseInt(a) > 0 ? MaskTip("得分", "很遗憾！<br/><br/>你才得了 " + a + " 分，没有过关。<br/><br/>继续加油哟！！", "查看错题", "重新考试", ExamReLoadErr, ExamReLoad, "", "", rid) : 
//	(MaskTip("得分", "太遗憾了！<br/><br/>你竟然得了 <font color=#FF0000 size=3><b>" + a + "</b></font> 分，不可思议。<br/><br/>继续加油哟！！", "", "", "", "", "重新考试", ExamReLoad, rid), 
//	jQuery(".MaskTip dl dd a.mtY").hide(), 
//	jQuery(".MaskTip dl dd a.mtN").hide()) : MaskTip("得分", "恭喜！\r\n你过关了！\r\n你的得分： " + a + " 分", "查看错题", "重新考试", MaskTip, ExamReLoad, "", "", rid), 
//	jQuery(".MaskTip dl dd a.mtY").addClass("orange"), jQuery(".MaskTip dl dd a.mtN").addClass("green"), 
//	KeyToView(), 
	
}
function ExamReLoad() {
	var a = top.location.href;
	if (ExamPageView) {
		var b = a.indexOf("?");
		b > 0 && (a = a.substr(0, b))
	}
	top.location = a
}
function ExamReLoadErr() {
	
	jQuery("#mkT7").hide();
	jQuery("#mkT8").show();
	jQuery(".black70,.popbox ").css('display','none');
	ViewExamOrderKep("");

	//var a = top.location.href,
		//b = a.indexOf("?");
	//b > 0 && (a = a.substr(0, b)), EPIDTmp && (a = a + "?ct=y"), top.location = a
}
function ExamLoadTip(a) {
	jQuery("#J-TitleTrigger").html('<h3 id="ExamTit"><br/><br/><br/>' + a + "<br/><br/><br/><br/><br/><br/></div>")
}
function ExamStart() {
	if (!ExamCount) return EPErr ? (alert("当前试卷没有错题！\n\n你真棒！"), location = "/" + kKm + "_fzks?epid=" + EPID, !1) : (jQuery("#J-TitleTrigger").html('<h3 id="ExamTit" onclick="ExamReLoad();"><br/><br/><br/>没有取到符合条件的试题！<br/><br/><br/><br/><a onclick="ExamReLoad();">点击这里重试...</a><br/><br/><br/><br/><br/><br/></h3>'), !1);
	jQuery("#ExamArea").html('<ul id="ExamOpt"><li id="ExamOptA"></li><li id="ExamOptB"></li><li id="ExamOptC"></li><li id="ExamOptD"></li><li id="ExamOptE"></li><li id="ExamOptF"></li></ul><h5></h5><h6></h6>'), jQuery("#ExamOptA").click(function() {
		gotoKey("A")
	}), jQuery("#ExamOptB").click(function() {
		gotoKey("B")
	}), jQuery("#ExamOptC").click(function() {
		gotoKey("C")
	}), jQuery("#ExamOptD").click(function() {
		gotoKey("D")
	}),jQuery("#ExamOptE").click(function() {
		gotoKey("E")
	}),jQuery("#ExamOptF").click(function() {
		gotoKey("F")
	}), jQuery("#ExamOrderArea").html('<p>转到第<input type="text" name="ExamOrderV" value="" onKeyUp="if(/D/.test(this.value)){alert(\'只能输入数字\');this.value=\'\';}" id="ExamOrderV">题 <input type="button" value="确定" id="ExamOrderQ"><input type="button" value="关闭" id="ExamOrderC"></p>');
	var a = "";
	if (a += '<a id="mkT3"><p class="eok"><b class="fcc"></b></p><i><span>123</span>/567</i></a>',
		a += '<a id="mkT1"><img src="' + ICO_Path + 'i-11.png"><b>上一题</b></a>', 
		a += '<a id="mkT2"><img src="' + ICO_Path + 'i-12.png"><b>下一题</b></a>', 
		a += '<a id="mkT3"><p class="eok"><b class="fcc"></b></p><i><span>123</span>/567</i></a>', 
		a += '<a id="mkT7"><img src="' + ICO_Path + 'i-07.png"><b>交卷</b></a>', 
		a += '<a id="mkT8"><img src="' + ICO_Path + 'i-09.png"><b>重新出卷</b></a>', 
		jQuery("#mkTools").html(a), a = "", jQuery("#mkT3 i").text(ExamCount), 
		jQuery("#mkT1").show(), jQuery("#mkT2").show(), jQuery("#mkT3").show(), 
		jQuery("#mkT51").hide(), jQuery("#mkT52").hide(), jQuery("#mkT52 b").addClass("hot"), 
		jQuery("#mkT6").show(), jQuery("#mkT9").hide(), jQuery("#mkT7").show(), jQuery("#mkT8").hide(), 
		jQuery("#mkT1").click(function() {
		gotoExamPre()
	}), jQuery("#mkT2").click(function() {
		gotoExamNext()
	}), jQuery("#mkT7").click(function() {
		ExamSubmitConfirm()
	}), jQuery("#mkT8").click(function() {
		ExamReLoad()
	}), jQuery("#mkT9").click(function() {
		jQuery("#ExamOrderKep").animate({
			height: "0px"
		}, 200);
		jQuery(".kspopcon").show();
		jQuery(".bg75black").show();
	}), jQuery("#mkT3").click(function() {
		ViewExamOrderKep("");
		jQuery(".black70,.popbox ").css('display','none');
	}), jQuery("#ExamOrderQ").click(function() {
		jQuery("#ExamOrderV").val() ? goExamOrder(jQuery("#ExamOrderV").val()) : jQuery("#ExamOrderV").focus()
	}), jQuery("#ExamOrderC").click(function() {
		goExamOrder("")
	}), jQuery("#ExamOrderKep").click(function() {
		ViewExamOrderKep("")
	}), jQuery("#ExamOrderKep").html('<p class="fcc"></p>'), jQuery("#ExamOrderKep").hide(), ExamPageView) {
		KeyToView(), jQuery("#mkT6").hide(), jQuery("#mkT7").hide(), jQuery("#mkT8").show();
		var b = "/" + kKm + "_fzks?epid=" + EPID,
			c = "/" + kKm + "_fzks?epid=" + EPID + "&ct=y";
		jQuery("#mkT51").click(function() {
			"" != EPErr ? top.location = c : ExamTip("当前试卷没有错题。你真棒！", 1e3)
		}), jQuery("#mkT52").click(function() {
			top.location = b
		}), EPIDct ? (jQuery("#mkT51").hide(), jQuery("#mkT52").show(), ExamTip("只看错题模式 开启", 1500)) : (jQuery("#mkT52").hide(), jQuery("#mkT51").show(), ExamTip("只看错题模式 关闭", 1500))
	}
	gotoExam(1), jQuery(".Content").hide()
}
function chkStart() {
	ExamCountY = "Y" + ExamCount, "Y" != ExamCountY && (ExamStart(), window.clearInterval(chkES))
}
var PointBase = 1;
var ExamS = 0,
	ExamEnter = ExamEnter || 0,
	ExamPageView = ExamPageView || "",
	TRun = 0,
	BeginDT = DT();
TRun = 1;
var orderTmp = 1,
	orderPre = 0,
	orderNext = 0,
	EDS = "",
	EPIDTmp = "",
	EPErr = EPErr || "",
	ExamCount = 0;
try {
	ExamCount = Exams.length - 1
} catch (e) {}
ExamLoadTip("试题读取中...");
var chkES = self.setInterval(chkStart, 100);