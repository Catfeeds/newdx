/*!
 * jQuery Darizi 
 * Copyright 2009-2010, HaoChong Guo
 *
 * 大日子
 * Dual licensed under the MIT or GPL Version 2 licenses.
 */
(function($) {
	$.fn.extend({
		darizi: function(settings) {
			var defaults = {
				bigDay: '',
				endDay: '',
				last: 0
			}
			var options = $.extend(defaults, settings);
			//options.bigDay = new Date(options.bigDay);
			options.endDay = new Date(options.bigDay.getTime() + options.last * 24 * 60 * 60 * 1000);

			function onExpired() {
				if (options.endDay.getTime() > options.bigDay.getTime()) {
					$('.jieshudaojishi').countdown({ until: options.endDay, onExpiry: onExpired });
					$('.lastTimer').countdown({
						since: options.bigDay,
						sinceExpire: options.endDay,
						onExpiry: onExpired
					});
					$('.zhengjishi .shu').countdown({
						since: options.bigDay,
						layout: '{ds}',
						sinceExpire: options.endDay,
						onExpiry: gameOver
					});
				}

			}
        function gameOver() {
            $('.zhengjishi').hide();
			$('.jieshule').show();
        }
			return this.each(function() {
				var o = options;

				$('.daojishi .shu').countdown({
					until: o.bigDay,
					layout: '{ds}',
					//layout: '{dn} 天 {hn} 小时 {mn} 分 {sn} 秒',
					alwaysExpire: true,
					onExpiry: function(){
						$(this).parent().hide();
						$('.zhengjishi').show();
						onExpired(); 
					} 
				});
			});
		}
	});
})(jQuery);

