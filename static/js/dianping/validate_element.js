//���ļ�������֤��Ԫ��,������jquery���ڸ��ļ��в��ٴ�����.������Ҫ������_showmsg����
if(window.jQuery) {
	//��������֤,������֤
	function validate_textbox(selector, valitype, msg, al, callback) {
		var textbox  = '';
		if(typeof selector == 'object') {
			textbox = selector;
		}
		else {
			textbox = jQuery(selector);
		}
		if(typeof textbox != 'object') return;
		switch(valitype) {
			case 'num':
				//to do
				break;
			default :
				//validate textbox is empty or not
				var value = trim(textbox.val());
				if(value == '' || value == undefined) {
					if (msg && al) _showmsg(msg);
					else
						if(callback) callback();

					return false;
				}
				break;
		}
	}
	
	//������ʱ,�����ÿ�,�û�û����д����ʧȥ���,�ָ�Ĭ������
	function focus_blur(target_selector, sibling, callback) {
		if(target_selector == '' || target_selector == undefined) return;
		var target = (typeof target_selector == 'object') ? target_selector : jQuery(target_selector);
		target.focus(function() {
			if(sibling == 'prev') {
				! jQuery(this).val() && jQuery(this).prev().hide();
			}
			if(callback) callback();
		}).blur(function() {
			if(sibling == 'prev') {
				! jQuery(this).val() && jQuery(this).prev().show();
			}
			if(callback) callback();
		}).click(function() {
			target.trigger('focus');
		});

	}

	//ʹ�ø÷�����ʱ,selectdown�ĸ�ʽ�����climbpost.htmһ��
	/*<span class="inputTipsText2">
		<div class="qy selectdown" style="z-index:500;">
			<input type="hidden" name="province" value="" id="province" />
			<input type="text" value="��ѡ�񾭹�ʡ��" class="diqu js" readonly="readonly"/>	
			<div class="qy_down">							
				{loop $provinces $k $v}
				<a rel="{$k}" href="javascript:void(0);" class="province">{$v['cityname']}</a>
				{/loop}																	
			</div>
		</div>
	</span>
	*/
	function delegate_selectdown(selector, delegate_selector, option_selector, container_selecotr) {
		jQuery(selector).delegate(delegate_selector, 'mouseover', function(event){
			if (! jQuery(this).hasClass('noselected') && jQuery(this).find(option_selector).length > 0) {
				jQuery(this).find(container_selecotr).show();
			}		
		}).delegate(delegate_selector, 'mouseleave', function(event) {
			if (! jQuery(this).hasClass('noselected'))  jQuery(this).find(container_selecotr).hide();
		}).delegate(option_selector, 'click', function(event) {
			if(this.id == 'notips') return;
			var rel = jQuery(this).attr('rel');
			jQuery(this).parent().hide();

			if(rel){
				jQuery(this).parent().siblings('input[type=hidden]').val(rel).siblings('input.js').val(jQuery(this).text()).change().end();
				if(jQuery(this).attr('execute')) {
					var func_name = jQuery(this).attr('execute');
					if(func_name) {
						func_name = 'callback_' + func_name;
						if(typeof func_name !== 'undefined') {
							var tempclass = 'tempclass_' +  Math.floor((Math.random() * 10000));
							var params = {};
							params.select_value = rel;
							params.element = tempclass;
							jQuery(this).addClass(tempclass);
							//params['select_value'] = rel;
							//params['element'] = JSON.stringify();
							eval(func_name + '(' + JSON.stringify(params) + ')');
							jQuery(this).removeClass(tempclass);			
						}
					}
				}
			}
			else {
				jQuery(this).parent().siblings('input[type=text]').val(jQuery(this).text()).end();
			}

		});

	}

	//pleasue invoke <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&services=true&ak=dCS4gu0EpLStfWTvGRuD1SSB"></script>') before you use it
	function loadMap(region, address, container, longitude, latitude, callback) {
		if (! address) {return false};
		var map = new BMap.Map(container);
		if(longitude && latitude) {
			var point = new BMap.Point(longitude, latitude);
		}
		else {
			var point = new BMap.Point(116.383, 39.973);
		}

		var markerPosition = new Array();
		var opt = {type: BMAP_NAVIGATION_CONTROL_SMALL}
		map.addControl(new BMap.NavigationControl(opt));  
		//map.centerAndZoom(point, 13);										
		//������ַ������ʵ��  
		var myGeo = new BMap.Geocoder();  
		//����ַ���������ʾ�ڵ�ͼ�ϣ���������ͼ��Ұ 
		myGeo.getPoint(address, function(point){
			if (point) {
				map.centerAndZoom(point, 16);
				var marker = new BMap.Marker(point);  // ������ע
				map.addOverlay(marker);
				marker.enableDragging(true); // ���ñ�ע����ק
				var opts = {
					width : 110,     // ��Ϣ���ڿ��
					height: 50,     // ��Ϣ���ڸ߶�
					title : "��ʾ��Ϣ"  // ��Ϣ���ڱ���
				}
			
				markerPosition['lng'] = point['lng'];
				markerPosition['lat'] = point['lat'];
				if(callback) callback(markerPosition);

				var infoWindow = new BMap.InfoWindow("�϶��˱�ע����Ĭ��λ��", opts);  // ������Ϣ���ڶ���
				marker.addEventListener("mouseup", function(){
					var position = marker.getPosition();
					var s = confirm("�Ƿ���λ������ΪĬ��λ�ã�");
					if(s==true){
						markerPosition['lng'] = position['lng'];
						markerPosition['lat'] = position['lat'];

						marker.disableDragging(true); // ���ñ�ע������ק
						marker.removeEventListener("mouseup"); 
					}else{
						markerPosition['lng'] = point['lng'];
						markerPosition['lat'] = point['lat'];
					}
					
					if(callback) callback(markerPosition);											
				});								

				marker.openInfoWindow(infoWindow);
				jQuery("#" + container).css("display","");
			}else{
				_showmsg("�˵�ַ�ڵ�ͼ���޷��ҵ���");
			} 
		}, region);
		return markerPosition;
	}

	//empty, number, len, telephone
	function check_input(form, criteria) {
		var passed = true;
		var chkval = '';
		if(typeof form != 'object' || criteria == null || criteria == '') return false;
		jQuery.each(criteria, function(key, val) {
			chkval = ''; //clean chkval every time
			if(eval('form.' + key + '.length') > 1){
				//used to get 'radio' data
				 jQuery.each(eval('form.' + key), function(nk, nv) {
				 	if(nv.checked) {
				 		chkval = nv.value;
				 		return false;
				 	}
				 });
			}
			else {
				chkval = eval('form.' + key + '.value');
				chkval = chkval ? chkval.trim() : 'null';
			}
			
			jQuery.each(val, function(k, v) {
				if(k.indexOf('len') >= 0) {
					if(check_len('', k.replace(/[^<>=]+/g, ''), chkval, k.replace(/[^\d]+/, ''))) {
						_showmsg(v);
						passed = false;
						return passed;
					}
				}
				else {
					func = 'check_' + k;
					if(eval(func + '(' + null + ', \'' + chkval +'\')')) {
						_showmsg(v);
						passed = false;
						return passed;
					}
				}
				
			});
			
			return passed;
		});
		return passed;
	}

	function check_empty(origin, chkval) {
		if(chkval == origin || chkval == '' || chkval == 'null') {
			return true;
		}
		return false;
	}

	function check_number(origin, chkval) {
		if(chkval == origin || chkval == '' || chkval == 'null' || isNaN(chkval)) {
			return true;
		}
		return false;
	}

	function check_pnumber(origin, chkval) {
		if(chkval == origin || chkval == '' || chkval == 'null' || isNaN(chkval) || parseInt(chkval) <= 0) {
			return true;
		}
		return false;
	}

	function check_len(origin, symbol, chkval, limit) {
		if(origin == chkval || chkval == null) return true;
		var str = 'mb_strlen(\''+chkval+'\')' + symbol + limit;
		return eval(str); 
	}

	function check_telephone(origin, chkval) {
		if(chkval == origin || chkval == '' || chkval == 'null' || 
			(chkval.length != 7 && chkval.length != 11) || chkval.match(/^[\d]{7}|[\d]{11}$/) == 'null') {
			return true;
		}
		return false;
	}
	//get the length of obj,(the count of attributes)
	function objsize(obj) {
		if(typeof obj != 'object') return 0;
		var count = 0;
		jQuery.each(obj, function(k, v) {
			count++;
		});
		return count;
	}
}

