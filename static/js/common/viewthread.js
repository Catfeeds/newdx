jQuery(document).ready(function($){
	$("#btn_box").hover(function(){
		$("#btn_list").show();
	},function(){
		$("#btn_list").hide();
	});
	$("#btn_box_down").hover(function(){
		$("#btn_list_down").show();
	},function(){
		$("#btn_list_down").hide();
	});
	$("div[id^=uboxbtn_]").hover(function(){
		$("#"+this.id.replace("btn","")).show();
	},function(){
		$("#"+this.id.replace("btn","")).hide();
	});
	$(document).on("click","a[id^=clist_btn_]",function(){
		var clist_box = $("#"+this.id.replace("clist_btn","comment"));
		if($(this).attr("class")=="shouqi"){
			$(this).removeClass("shouqi");
			$(this).text("展开");
			clist_box.stop().slideUp(200);
		} else {
			$(this).addClass("shouqi");
			$(this).text("收起");
			clist_box.stop().slideDown(200);
		}
	});
	$(document).on("mouseenter","div[id^=post_], #postlistreply",function(){
		$(this).find("#report_btn").show();
		$(this).find("#m_k_favorite").show();
	});
	$(document).on("mouseleave","div[id^=post_], #postlistreply",function(){
		$(this).find("#report_btn").hide();
		$(this).find("#m_k_favorite").hide();
	});
	
	$(document).on("mouseenter","li[id^=comments_]",function(){
		$(this).find(".second").show();
	});
	$(document).on("mouseleave","li[id^=comments_]",function(){
		$(this).find(".second").hide();
	});

	$(document).on('blur focusin focusout', '.twyzm.clboth>span>input[type=text]', function(event){
		switch(event.type){
			case 'focusin':
				$('#' + $(this).parent().attr('id') + '_menu').show();break;
			case 'blur':
			case 'focusout':
				$('#' + $(this).parent().attr('id') + '_menu').hide();break;
		}
	}).on('mouseover mouseout', '.twyzm.clboth>span', function(event){
		switch(event.type){
			case 'mouseover' :
				$('#' + this.id + '_menu').show();break;
			case 'mouseout' :
			    $('#' + this.id + '_menu').hide();break;
		}
	});
	//鼠标移入分享后向左边弹出分享按钮
	$("#share").hover(
		function () {
		$(".share_bd",this).show();
		},
		function () {
		$(".share_bd",this).hide();
		}
	);
//返回顶部按钮
	if($(window).scrollTop() > 10){$("#gotop_50 a").show();}	
	$(window).scroll( function(){
		if($(window).scrollTop()>10){
			$("#gotop_50 a").show();
		}else{
			$("#gotop_50 a").hide();	
		}
	});
	$("#gotop_50").click(function(){ 
		$("html,body").animate({ scrollTop: 0 },500);
	});
});