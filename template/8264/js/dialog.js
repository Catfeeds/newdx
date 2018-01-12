jQuery(function() {
	var params = getParameters();
	var width = params['width'] ? params['width'] : 500;
	params['view'] = jQuery('#' + params['view_id']).html();
	/*Because if transmit a html view afert the tag script, it fails all the time.
	clear the view, or error will occure when submit,
	*/
	jQuery('#' + params['view_id']).html('');

	var dialog_wrapper = '<div id="dialog_wrapper" style="width: ' + width + 'px;">' + 
							'<div id="wrapper_header" style="border: red 1px solid;">' + 
								'<div id="wrapper_title" class="left"><span class="title">' + params['title'] + '</span></div>' +
								'<div id="wrapper_close" class="right">' + 
									'<span>x</span>' +
								'</div>' + 
							'</div>' + 
							'<div id="wrapper_body" style="border: red 1px solid;">' + params['view']+ '</div>' +
						'</div>';

	var Dialog = {
		show: function() {
			//no $, or you will get exception: $ is not a function.
			var body = jQuery(document).find('body').eq(0);
			this._applyMask();

			body.append(dialog_wrapper);
			this.adjust();
		},
		close: function() {
			jQuery('#dialog_wrapper').hide();
			this.Mask.hide();
		},
		load_css: function() {
			if(! this.Load_css) {
				add_css();
				this.Load_css = true;
			}
		},
		adjust: function() {
			var dialog = jQuery('#dialog_wrapper');
			var dialog_with = dialog.width();
			var dialog_height = dialog.height();
			var screen_with = jQuery(document).width();
			var screen_height = jQuery(document).height();
			var scroll_height = jQuery(document).scrollTop();

			var dialog_top = (screen_height - dialog_height)/2  - 150;

			dialog_top = dialog_top > 0 ?  dialog_top : scroll_height;

			dialog.css('left', (screen_with - dialog_with)/2).css('top', dialog_top);
		},
		_applyMask: function() {
			var mask = this.Mask;
			if(! mask) {
				var mask_div = '<div id="dialog_mask"></div>';
				jQuery(document).find('body').eq(0).append(mask_div);
				mask = this.Mask = jQuery('#dialog_mask');
			}
			mask.width(jQuery(document).width() + jQuery(document).scrollLeft);
			mask.height(jQuery(document).height() + jQuery(document).scrollTop());
		},
		Mask: '',
		Load_css: false,
	};

	Dialog.load_css();
	Dialog.show();

	jQuery('#wrapper_close span').click(function() {
		Dialog.close();
	});



	function getParameters() {
		var http_params = document.getElementsByTagName('script');

		if(! http_params || http_params == undefined) {

			return {'view': 'Parameters transmit failed!'};
		}
		var params_arr = new Array();
		for(var i=0; i<http_params.length; i++) {
			var src = http_params[i].src;
			if(src.indexOf('dialog') > 0 && src.indexOf('?') > 0) {
				var des_str = src.substring(src.indexOf('?') + 1);
				var des_arr = des_str.split('&');
				for(var j=0; j<des_arr.length; j++) {
					var temp = des_arr[j].split('=');
					try{
						params_arr[temp[0]] = jQuery("<div />").html(decodeURI(temp[1])).html();
					}
					catch(e) {
						//URIError: malformed URI sequence
						params_arr[temp[0]] = temp[1];
					}
					
				}
				break;
			}
		}

		return params_arr;
	}

	function add_css() {
		var css_style = '<style type="text/css">' +
			'#dialog_wrapper {z-index: 1500; position: absolute; }' +
			'.right {float: right; }' +
			'.left {float: left; }' +
			'#wrapper_close span {margin-right: 20px; cursor: pointer;}' +
			'#wrapper_header {height: 40px; line-height: 40px; background-color: blue;}' + 
			'#wrapper_title span.title{margin-left: 10px; color: #EBEBEB; font-weight: 700; }' +
			'#dialog_mask {background:#CCC;opacity:0.3;filter:alpha(opacity=30);left:0; position:absolute; top:0; width:100%; z-index:1000;}'
		'</style>';

		jQuery(document).find('head').eq(0).append(css_style);
	}
});