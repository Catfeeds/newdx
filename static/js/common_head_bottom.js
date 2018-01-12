jQuery(document).ready(function($) {
	//顶部导航下拉
	$(".headerNav .nav li").hover(function() {
		$(this).children("dl").show().end().children('a').css('background', '#344654').end().siblings().each(function(){
			$(this).children('dl').hide().end().children('a').removeAttr('style');
		});
	}, function() {
		$(this).children("dl").hide().end().children('a').removeAttr('style');
	});
	$('.head_login_info>li:not(.notHover)').hover(function(){
		// if(timer_showmsg){clearTimeout(timer_showmsg);}
		$(this).children('div').slideDown(200).end().children('a').addClass('head_login_icon24_24_zhong').end().siblings().each(function(){
			$(this).children('div').stop(true,true).hide().end().children('a').removeClass('head_login_icon24_24_zhong');
		});
	}, function(){
		$(this).children('div').stop(true,true).slideUp(300, function(){
			$(this).siblings('a').removeClass('head_login_icon24_24_zhong');
		});
	});
	// 头部搜索框提示
	$('#searchText').focus(function(){
		$('#searchTips').hide();
	}).blur(function(){
		if(!$(this).val()) {
			$('#searchTips').show();
		}
	});
});