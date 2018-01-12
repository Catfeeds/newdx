// JavaScript Document

jQuery(function(){
	var shuliang = jQuery(".imgbig li").size();
	jQuery(".lunbocon_lm").append("<div class='doit'></div>"); 
	for ( i=0 ; i< shuliang ;i){
	i++	
	jQuery(".doit").append("<span></span>");
	};
	jQuery(".doit span").eq(0).addClass("zhong");
	
	jQuery(".imgbig li").eq(0).show().siblings().hide();
	
	jQuery(".doit span").mouseover(function(){
		jQuery(this).addClass("zhong").siblings().removeClass("zhong");
		var index=jQuery(".doit span").index(this);
		jQuery(".imgbig li").eq(index).show().siblings().hide();
	});
	
	jQuery(".bbsfb_geer").hover(
		function () {
			jQuery(".forum_post_out89",this).show();
		},
		function () {
			jQuery(".forum_post_out89",this).hide();
		}
	);
			
});	

jQuery(function(){	
	var r_offset_top = jQuery("#dignwei").offset().top;
	var scrolltop = r_offset_top - jQuery(window).height()
	jQuery(document).scroll( function(){
		if( jQuery(window).scrollTop()>scrolltop){	
			jQuery("#f_r_p").addClass("f_r_p");
		}else{
			jQuery("#f_r_p").removeClass("f_r_p");
		}
		
		if( jQuery(window).scrollTop()+jQuery(window).height() > jQuery(".footer").offset().top){
			var bottom_h =  jQuery(window).scrollTop()+jQuery(window).height() - jQuery(".footer").offset().top
			jQuery("#f_r_p").css('bottom',bottom_h);	
		}
		else{
			jQuery("#f_r_p").css('bottom','0');	
		}
		
	});	
});