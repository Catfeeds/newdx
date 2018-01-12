var ie6=false;
if(/msie/.test(navigator.userAgent.toLowerCase()) && 'undefined' == typeof(document.body.style.maxHeight)){
	ie6=true;
}

jQuery(document).ready(function($) {
	$(".listbox li").hover(function(){
		$(this).find(".i_name").hide();
		$(this).find(".i_info").show();
		if(ie6){
			$(this).css('border-color','#cfcfcf');
		}
	}, function(){
		$(this).find(".i_info").hide();
		$(this).find(".i_name").show();
		if(ie6){
			$(this).css('border-color','#fff');
		}
	});

	$(document).bind("click",function(e){
		var target  = $(e.target);
		if(target.closest("#pm_box").length == 0 && target.closest("#pm_show").length == 0 ){
			$("#pm_box").hide();
		}
	})
	$('#pm_show').click(function(){
		$('#pm_box').toggle();
	});
	
	var tl_height=$('#typelist').height();
	$('#typelist').height(30);
	if(tl_height > 30){
		$('#tl_btn').show();
		$('#tl_btn').click(function(){
			if($('#tl_btn').attr('class') == 'downbtn'){
				$('#typelist,#typelist_tb').animate({height:tl_height}, 100);
				$('#tl_btn').attr('class','upbtn');
			} else {
				$('#typelist,#typelist_tb').animate({height:30}, 100);
				$('#tl_btn').attr('class','downbtn');
			}
		});
	}
	
	var bl_height=$('#blist').height();
	$('#blist').height(30);
	if(bl_height > 30){
		$('#bl_btn').show();
		$('#bl_btn').click(function(){
			if($('#bl_btn').attr('class') == 'downbtn'){
				$('#blist,#blist_tb').animate({height:bl_height}, 100);
				$('#bl_btn').attr('class','upbtn');
			} else {
				$('#blist,#blist_tb').animate({height:30}, 100);
				$('#bl_btn').attr('class','downbtn');
			}
		});
	}
	
	$("#typelist>a[id^=cbtn_]").hover(function(){
		var cid=this.id.replace('cbtn_','');
		clearTimeout(window.subbox_show);
		$("#typelist>div").hide();
		$("#sub_list_"+cid).css({"top":$(this).position().top+20,'left':$(this).position().left}).show();
	},function(){
		var cid=this.id.replace('cbtn_','');
		window.subbox_show=setTimeout("jQuery('#sub_list_"+cid+"').hide();",300);
	});
	$("#typelist>div[id^=sub_list_]").hover(function(){
		clearTimeout(window.subbox_show);
	},function(){
		window.subbox_show=setTimeout("jQuery('#"+this.id+"').hide();",300);
	});

	$("#bdiv div").each(function(){
		if($(this).html()==""){
			$('#bnav a').eq($(this).index()).hide();
		}
	});
	var _init_bbox=false;
	$('#bshow').click(function(){
		$('#bbox').toggle();
		if(!_init_bbox){
			var bnav_l=$('#bnav a:visible').length;
			var bbox_w=Math.max(bnav_l*26+20,560)
			$("#bbox").width(bbox_w);
			_init_bbox=true;
		}
	});
	$('#bnav a').mouseover(function(){
		$(this).addClass('select_z').siblings().removeClass('select_z');
		$('#bdiv div').eq($(this).index()).show().siblings().hide();
	});
	$(document).click(function(event) {
	    if (!$(event.target).closest('#bbox,#bshow').length) {
	        $('#bbox').hide();
	    };
	});
});