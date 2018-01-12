jQuery(function(){
	   jQuery(".top2_r ul li:has(div.nav_xl)").hover(function(){
			jQuery(this).children("div.nav_xl").stop(true,true).slideDown(400);
        },function(){
		    jQuery(this).children("div.nav_xl").stop(true,true).slideUp("fast");
		})
})
