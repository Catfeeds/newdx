jQuery(function(){			
	//չ����������л�
	jQuery('.j-rw-toggle').click(function(){
		var subSpan = jQuery(this).find('span');
		var subI	= jQuery(this).find('i');		
		var prev	= jQuery(this).prev();		
		var height	= prev.find('.span_height').html();
		if (subI.hasClass('icon-unfold-m')) {
			subSpan.html('����');
			subI.addClass('icon-fold-m').removeClass('icon-unfold-m');
			prev.animate({height:height},300);
		} else {
			subSpan.html('չ��');
			subI.addClass('icon-unfold-m').removeClass('icon-fold-m');
			prev.animate({height:90},300);
		}
	});
	jQuery('.txt-details-info.realheight').each(function(){
		var height 		= jQuery(this).height();
		var parentobj   = jQuery(this).parent();
		if (height <= 90) {
			parentobj.find('.j-rw-toggle').remove();
			parentobj.find('.showheight').css({'height':'auto'});
			if (parentobj.hasClass('bd')) {
				parentobj.css({'padding-bottom':'0'});
			} else {
				parentobj.parent().css({'padding-bottom':'0'});
			}
		} else {
			parentobj.find('.span_height').html(jQuery(this).height());						
		}
		jQuery(this).remove();
	});
	
	//��
	jQuery('a[id^=supportBtn_]').on('click', function(){
		var arrId 	= jQuery(this).attr('id').split('_');
		var pid 	= arrId[1];
		var thisObj	= jQuery(this);
		if (thisObj.hasClass('active')) {return false;}
		jQuery.get('dianping.php?mod=misc&act=comment&do=support',{pid:pid},function(data){
			if(data == '-1'){
				alert('����Ҫ��½���������');
				window.location.href = 'http://www.8264.com/member.php?mod=logging&action=login';
				return false;
			}else if(data == '-2'){
				alert('�㲻�������Լ��ĵ���');return false;
			}else if(data == '-3'){
				alert('���Ѿ����۹���');return false;
			}else{
				thisObj.addClass("active").attr('id', '');
				thisObj.find('em').html('����'+data);
			}										
		});
		return false;
	});
	
});