// JavaScript Document
jQuery(function() {

	jQuery("#shuqian_sh .title_b_16 a").mouseover(function() {
		jQuery(this).addClass("xz").siblings().removeClass("xz");
		var index = jQuery("#shuqian_sh .title_b_16 a").index(this);
		jQuery("#shuqian_sh .title_g_h3 span").eq(index).removeClass("bgwithout").siblings().addClass("bgwithout");
		jQuery("#shuqian_sh .tw_list_660>div").eq(index).show().siblings().hide();
	});

	jQuery("#shuqian_zd .title_b_16 a").mouseover(function() {
		jQuery(this).addClass("xz").siblings().removeClass("xz");
		var index = jQuery("#shuqian_zd .title_b_16 a").index(this);
		jQuery("#shuqian_zd .title_g_h3 span").eq(index).removeClass("bgwithout").siblings().addClass("bgwithout");
		jQuery("#shuqian_zd .tw_list_660 ul").eq(index).show().siblings().hide();
	});


	jQuery("#zb_gl a").mouseover(function() {
		var index = jQuery("#zb_gl a").index(this);
		jQuery("#zb_gl_d span").eq(index).removeClass("withoutboreder").siblings().addClass("withoutboreder");
		jQuery(".zb_gl>div").eq(index).show().siblings().hide();
	});



	//点击下拉，只能点击三下
	jQuery("#shangye ul li:gt(5)").hide();
	jQuery("#huwai ul li:gt(5)").hide();
	var i = 1;
	var bs = 6;
	jQuery(".addmore").click(function() {
		jQuery(".tw_list_660").removeClass("h775");
		if (i < 3) {
			bs = bs + 6;
			jQuery("#shangye ul li:lt(" + bs + ")").show();
			jQuery("#huwai ul li:lt(" + bs + ")").show();
			i++;
		} else {
			jQuery("#more_sy").attr("href", "http://www.8264.com/portal-list-catid-238-page-2.html");
			jQuery("#more_hw").attr("href", "http://www.8264.com/portal-list-catid-914-page-2.html");
		}
	});

	//点击加载后右侧浮动算值
	var r_offset_top = jQuery("#dignwei").offset().top;
	var scrolltop = r_offset_top - jQuery(window).height()
	jQuery(document).scroll(function() {
		if (jQuery(window).scrollTop() > scrolltop) {
			jQuery("#f_r_p").addClass("f_r_p");
		} else {
			jQuery("#f_r_p").removeClass("f_r_p");
		}

		if (jQuery(window).scrollTop() + jQuery(window).height() > jQuery(".zcdw").offset().top) {
			var bottom_h = jQuery(window).scrollTop() + jQuery(window).height() - jQuery(".zcdw").offset().top;
			jQuery("#f_r_p").css('bottom', bottom_h);
		} else {
			jQuery("#f_r_p").css('bottom', '0');
		}

	});



});