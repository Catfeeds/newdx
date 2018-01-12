/*
 * $-gotop.js
 * @version 0.1
 */
;(function($) {
	$.fn.extend({
		goTop: function() {
			var that = this, ie6_timeout;				
			function check_gotop() {
				var win_scrolltop = $(window).scrollTop();			
				if (win_scrolltop > 0) {			
					right = '20px';
					$(that).css({right: right}).fadeIn(100);
					if ($.browser.msie && $.browser.version == '6.0') {
						clearTimeout(ie6_timeout);
						ie6_timeout = setTimeout(function() {
							$(that).stop().animate({
								top: $(window).height() - 80 + win_scrolltop
							}, 400);
						}, 200);
					}						
				} else {
						$(that).fadeOut(100);
				}			
			}
			$(window).resize(check_gotop).scroll(check_gotop);
			check_gotop();
			$(that).click(function() {
				$(window).scrollTop(0);
				return false;
			});
		}
	});
})(jQuery);
