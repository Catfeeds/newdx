/*
 * 图片分楼的相关js
 * @author:JiangHong
 */

var maxid = 0;
var nowid = 0;
var mytid = 0;
var myalbumid = 0;
var uploadStat = 0;
var album_num = 0;
var attachnum = 0;
var nowpic = 0;
var topindex = 50;
function dosort(obj , type , evt){
	var obj_typeid = $(type);
	$(type+'_txt').innerHTML = obj.innerHTML;
	obj_typeid.value = obj.getAttribute(type);
	obj.parentNode.style.display = 'none';
	if($(type+'_select')) $(type+'_select').id = '';
	obj.id = type+'_select';
	if (window.event) {  
		event.cancelBubble = true;  
	}else if (evt){  
		evt.stopPropagation();  
	}
}
function selectalbum(obj){
	var allalbums = obj.parentNode.getElementsByTagName('li');
	var album_num = allalbums.length;
	if(allalbums.item(0).style.display == 'none' || allalbums.item(album_num-1).style.display == 'none'){
		obj_sh(allalbums , '');
	}else{
		obj_sh(allalbums , 'none');
		obj_sh(obj , '');
		document.getElementById('savealbumname').value = obj.className;
		if(obj.className!=''){
			ajaxget('plugin.php?id=picupload:albumlist&abid=' + obj.className , 'albumlist');
		}
	}
	if (window.event) {  
		event.cancelBubble = true;  
	}else if (evt){  
		evt.stopPropagation();  
	}
}
function obj_sh(objs , status){
	var objs_len = objs.length;
	if(objs_len > 1){
		for(i=0;i<objs_len;i++){
			objs.item(i).style.display = status;
		}
	}else{
		objs.style.display = status;
	}
}
function tipsalbum(url , status){
	var showdiv = document.getElementById('floattips');
	var showimg = document.getElementById('albumtipsimg');
	showdiv.style.display = status;
	showimg.src = url;
}
function hideObjByTime(id, time){
	var infunc_hide = function(){
		jQuery.noConflict();
		;(function($){
			$('#' + id).slideUp(300);
		})(jQuery);
	}
	setTimeout(infunc_hide, time);
}
function showmynext(obj){
	jQuery.noConflict();
	;(function($){
		$(obj).show().siblings('img').remove();
	})(jQuery);
}
function loadingflashok(){
	jQuery.noConflict();
	;(function($){
		$('#flashloading').hide();
	})(jQuery);
}
var tipsnow = false;
function uploadsuccess(type, returndata){
	eval("var nattach = " + returndata + ";");
	jQuery.noConflict();
	;(function($){
		$('#imgattachlist>div.needdelete').remove();
		$('#albumaddexiststips').hide();
		function showmymsg(text, percent, fileid, filename){
			if(fileid != null){
				$('#watting_' + fileid + ' .wattingtitle').text(text);
				if(percent > 0){
					$('#watting_' + fileid + ' .wattingpercent').text(percent + ' %');
				}else{
					$('#watting_' + fileid + ' .wattingpercent').text('');
				}
				$('#watting_' + fileid + ' .messagetips').text(filename);
				$('#watting_' + fileid).show();
			}
		}
		if(document.getElementById('watting_' + nattach.fileid) == null){
			if($('#imgattachlist>div.wattingdiv').length >=  maxnum){
				if(!tipsnow){
					tipsnow = true;
					showDialog("当前只允许一次性分楼 " + maxnum + " 张图片，您当前上传的图片，会在下次使用，您可以提交此次分楼贴后，再次通过图片分楼回复功能追加图片");
					$('#fwin_dialog_submit').click(function(){
						setTimeout(function(){tipsnow = false;}, 10000);
					})
				}
				return;
			}
			$('#watting').clone().attr('id', 'watting_' + nattach.fileid).attr('title', nattach.filename).appendTo('#imgattachlist').show();
		}
		var thisdivid = $('#watting_' + nattach.fileid);
		switch(type){
			case 1:
			case 2:
				thisdivid.find('.wattings').remove().end()
						.find('.attachshows').show().end()
						.find('input.albumtype').remove().end()
						.find('input.albumurl').remove().end()
						.find('.side_r_one_img').css({backgroundImage:'url(' + nattach.thumbpic.replace(/t2w100h100/, "t12w100h100") + ')'}).end()
						.find('.side_r_one_img .attachpic_load').attr('src', nattach.thumbpic).attr('bigsrc', attachserver + nattach.type + "/" + nattach.pic).one('error', function(){
							$(this).attr('src', ' ').next('img').show().end().attr('src', nattach.thumbpic);
						}).removeClass('attachpic_load');
				thisdivid.find('input.attachimage').val(nattach.aid).end()
						.find('input.attach_delete').attr('name', 'attachnew[' + nattach.aid + '][delete]').end()
						.find('input.attach_new').attr('name', 'attachnew[' + nattach.aid + ']').val(nattach.aid).end()
						.find('textarea.textshow').attr('name', 'attachnew[' + nattach.aid + '][description]').attr('onkeydown', "saveUserdata('descrip_image_" + nattach.aid + "',this.value);").end()
						.removeClass('loading');
				if(type == 2){
					tipsnow = false;
				}
				break;
			case 3:
				var percent = Math.floor((nattach.nowcount * 100) / nattach.maxcount);
				showmymsg(nattach.text, percent, nattach.fileid , nattach.filename);
				break;
			case 4:
				showmymsg(nattach.text, 0, nattach.fileid);
				break;
			case 5:
				if(thisdivid.find('input.albumurl').val() == nattach.albumpic){
					var mytopfix = thisdivid.offset().top - 30;
					$('#albumaddexiststips').css({left:thisdivid.offset().left + 50, top:mytopfix}).show();
 					hideObjByTime('albumaddexiststips', 1000); 					
				}else{
					thisdivid.find('.wattings').remove().end()
							.find('.attachshows').show().end()
							.find('input.attach_new').remove().end()
							.find('input.attachimage').remove().end()
							.find('input.attach_delete').attr('name', 'album').end()
							.find('.side_r_one_img').prepend("<img onload='showmynext(this);' class='attachimg' bigsrc='" + nattach.albumpic + "' src='" + nattach.thumbpic + "'/>").end()
							.find('input.albumtype').attr('name', 'attachnew[' + nattach.albumpicid + '][type]').val('album').removeAttr('disabled').end()
							.find('input.albumurl').attr('name', 'attachnew[' + nattach.albumpicid + '][url]').val(nattach.albumpic).removeAttr('disabled').end()
							.find('textarea.textshow').attr('name', 'attachnew[' + nattach.albumpicid + '][description]').attr('onkeydown', "saveUserdata('descrip_image_album_" + nattach.albumpicid + "',this.value);").end()
							.removeClass('loading');
					var value = loadUserdata('descrip_image_album_' + nattach.albumpicid);
					if(value != '' && value != null)
					{
						thisdivid.find('textarea.textshow').val(value).show().addClass('attachshows').end().find('textarea.texttips').removeClass('attachshows').hide();
					}
				}
				var top = thisdivid.offset().top - 150 > 0 ? thisdivid.offset().top - 150 : 0;
				window.scrollTo(0, top);
				break;
		}
		var nowhavepicnum = $('#imgattachlist>div.wattingdiv').length;
		$('#img_num').text(nowhavepicnum);
		$('#img_sy').text(maxnum - nowhavepicnum);
		$('#pic_tools_tips').show();
		$('#imgattachlist').sortable({opacity: 0.6, cursor: 'move'});		
	})(jQuery);
}

function show_focus(obj){var nextnode = nextNode(obj);obj.style.display = 'none';nextnode.style.display = '';nextnode.focus();}
function nextNode(obj){if(obj.nextSibling.nodeType == 1){return obj.nextSibling;}else{return nextNode(obj.nextSibling);}}
function num_show(){maxid = album_num + attachnum;var synum = maxnum - maxid;$('img_num').innerHTML = maxid;$('img_sy').innerHTML = synum;if(synum < 0){$('img_sy').style.color = 'red';}else{$('img_sy').style.color = '';}}
var righttool = $('righttool');
var toolstop = $('tools_top');
righttool.style.position = 'absolute';
toolstop.style.position = 'absolute';
var startindex = righttool.offsetTop;
var toolstopindex = toolstop.offsetTop;
righttool.style.position = '';
toolstop.style.position = '';
function calpostion(){var hex = document.documentElement.scrollTop || document.body.scrollTop;if(hex >= toolstopindex){changestyle(toolstop,'zIndex',topindex);changestyle(toolstop,'paddingTop','1px');changestyle(righttool,'zIndex',topindex);changestyle($('pic_tools_tips'),'zIndex',topindex);changestyle($('tips_tzjx'),'zIndex',topindex);changestyle($('pic_tools_tips'),'paddingBottom','5px');changestyle($('tips_tzjx'),'paddingBottom','5px');if(!window.XMLHttpRequest){changestyle(toolstop,'position','absolute');changestyle(toolstop,'top',hex + 'px');changestyle(righttool,'position','absolute');changestyle(righttool,'top',hex + 40 + 'px');changestyle($('pic_tools_tips'),'position','absolute');changestyle($('pic_tools_tips'),'top',hex + 30 + 'px');changestyle($('tips_tzjx'),'position','absolute');changestyle($('tips_tzjx'),'top',hex + 30 + 'px');}else{changestyle(toolstop,'position','fixed');changestyle(toolstop,'top','0px');changestyle(righttool,'position','fixed');changestyle(righttool,'top','40px');changestyle($('pic_tools_tips'),'position','fixed');changestyle($('pic_tools_tips'),'top','30px');changestyle($('tips_tzjx'),'position','fixed');changestyle($('tips_tzjx'),'top','30px');}}else{changestyle(toolstop,'position','');changestyle(toolstop,'top','');changestyle(toolstop,'paddingBottom','');changestyle(toolstop,'zIndex','');changestyle(righttool,'position','');changestyle(righttool,'top','');changestyle(righttool,'zIndex','');changestyle($('pic_tools_tips'),'position','');changestyle($('pic_tools_tips'),'top','');changestyle($('pic_tools_tips'),'zIndex','');changestyle($('pic_tools_tips'),'paddingBottom','');changestyle($('tips_tzjx'),'position','');changestyle($('tips_tzjx'),'top','');changestyle($('tips_tzjx'),'zIndex','');changestyle($('tips_tzjx'),'paddingBottom','');}}
function changestyle(obj,key,value){if(obj!=null && eval('obj.style.'+key+'!=value')){eval('obj.style.'+key+' = value');}}
jQuery.noConflict();
;(function($){
	if($('#typeidlist').height() > 500){$('#typeidlist').height('500px');}
	$('#descriptionallpic').click(function(){
		if($(this).is(':checked')){
			$(this).parents('.col_side_r').removeClass('smallpiclist');
			$('#descriptionSelect').show();
		}else{
			$(this).parents('.col_side_r').addClass('smallpiclist');
			$('#descriptionSelect').hide();
		}
	});
	$('#imgattachlist').sortable({opacity: 0.6, cursor: 'move'});
	var warpwidth = $('#wp div.wrap:first').width();
	$("#imgattachlist").on('mouseover mouseout', '.x_buttom', function(){
		$(this).toggleClass('_z');
	});
	$("#imgattachlist").on('focus', '.side_r_one_text textarea', function(){
		$(this).parents('.side_r_one').addClass('_d');
	});
	$('#imgattachlist').on('focus', '.side_r_one_text .texttips', function(){
		$(this).hide().siblings('.textshow').show().focus();
	});
	$('#imgattachlist').on('blur', '.side_r_one_text textarea', function(){
		$(this).parents('.side_r_one').removeClass('_d');
		if($(this).val() == '') $(this).hide().siblings('.texttips').show();
	});
	$('#imgattachlist').on('click' , 'div.deletepicbtn', function(){
		if($(this).children('input:hidden').val() == 1)
		{
			$(this).parent().find('.side_r_one_dele').hide().end().find('textarea').removeAttr('disabled').end().end().children('input:hidden').val(0);
		}else{
			if($(this).children('input.attach_delete').attr('name') == 'album'){
				$(this).parents('.wattingdiv').remove();
			}else{
				$(this).parent().find('.side_r_one_dele').show().end().find('textarea').attr('disabled', true).end().end().children('input:hidden').val(1);
			}
		}
	});
	$('#beforeattach').click(function(){
		$(".wattingdiv input:hidden[name='beforeattach']").val($(this).is(':checked') ? 1 : 0);
	});
	$('#albumlist_ajax').on('mouseover', 'ul.imglistcon li', function(){
		$(this).find('a').show();
	});
	$('#albumlist_ajax').on('mouseout', 'ul.imglistcon li', function(){
		$(this).find('a').hide();
	});
	$('#albumlist_ajax').on('click', 'ul.imglistcon li:not(.errorpic)', function(){
		var mypicid = $(this).attr('albumpicid');
		uploadsuccess(5,"{fileid:'album_" + mypicid + "', albumpic:'" + $(this).children('img').attr('bigpic') + "', albumpicid:" + mypicid + ", thumbpic:'" + $(this).children('img').attr('src') + "', filename:'" + $(this).children('img').attr('title') + "'}");
	});
	$('#selectalbum_list>a').click(function(){
		myalbumid = $(this).attr('albumid');
	});
	function ajaxpostreturnHandle(data){
		if(! data.error){
			nowid++;
			if(data.first == 1){
				mytid = data.tid;
				$('#imgattachlist>div.wattingdiv').find('input[name=action]').val('reply').end().find('input[name=tid]').val(mytid);
			}
			if(data.albumid > 0){
				myalbumid = data.albumid;
				$('#imgattachlist>div.wattingdiv input[name=albumid]').val(data.albumid);
			}
			$('#imgattachlist>div.wattingdiv:first').remove();
			process_upload(nowid, nowid + $('#imgattachlist>div.wattingdiv form').length);
                        if(data.displayorder){
                            showDialog("你的帖子因含有敏感词或者版块限制需要审核，请耐心等待。");
                        }
                        
			if($('#imgattachlist>div.wattingdiv:not(.loading) form').length > 0){
				setTimeout(ajaxpostToThread, ajaxper);
			}else if($('#imgattachlist>div.wattingdiv form').length > 0){
				showDialog('您仍有图片在上传，若放弃上传请点击 <a href="' + data.url + '">查看帖子</a>，或等候全部上传完后再点击发表帖子<a href="javascript:;" onclick="fwin_dialog_submit.click();tjbuttom.click();">继续分楼</a>');
				$('input.tjbuttom').show();
			}else if(data.del == 1){
				showDialog('您选择的图片已经都删除完毕，您可以<a href="javascript:;" onclick="fwin_dialog_submit.click();">继续上传图片进行分楼</a>或<a href="' + data.url + '">回到版区</a>');
				nowid = 0;
				$('input.tjbuttom').show();				
			}else if(data.erweima == 1){
				var url 	 = "plugin.php?id=picupload:erweima";
                var postData = 'tid='+data.tid+'&extra='+data.extra;
                $.post(url, postData, function(data){
                    $('#append_parent').html('');
                    $('#wp').html('').append(data);
                });
			}else{
				window.location.href = data.url;
			}
		}else{
			if(data.why){
				showDialog(data.why);
				$('input.tjbuttom').show();				
			}else{
				showDialog('发生意外错误，请<a href="javascript:;" onclick="fwin_dialog_submit.click();tjbuttom.click();">点击继续发送</a>！');
				$('input.tjbuttom').show();
			}
		}
	}
	function ajaxpostToThread(){
		var firstform = $('#imgattachlist>div.wattingdiv form:first');
		if(firstform.parent().hasClass('loading')){
			showDialog('当前即将上传的图片还未上传完，您可以等上传完后再<a href="javascript:;" onclick="fwin_dialog_submit.click();tjbuttom.click();">继续分楼</a>，或拖动图片改变分楼顺序');
			$('input.tjbuttom').show();return;
		}
		if(mytid == 0){
			if(formactiontype == 'newthread'){
				firstform.find('input[name=action]').val('newthread').end().find('input[name=typeid]').remove().end().append('<input type="hidden" name="typeid" value="' + $('#typeid').val() + '" />').find('input[name=subject]').remove().end().append('<input type="hidden" name="subject" value="' + $('#subject').val() + '" />');
			}else{
				if($('#tid').val() > 0){
					mytid = $('#tid').val();
				}else{
					showDialog('当前发生意外错误，请重新刷新页面');
					$('input.tjbuttom').show();
				}
			}
		}
		if($('#typeid').val() > 0){firstform.find('input[name=typeid]').val($('#typeid').val()).removeAttr('disabled');}
		if(mytid > 0){
			firstform.find('input[name=tid]').val(mytid).end().find('input[name=action]').val('reply');
		}
		if($('#savetoalbum').is(':checked')){
			firstform.find('input[name=savetoalbum]').removeAttr('disabled');
			if(myalbumid == 0){
				firstform.find('input[name=newalbumname]').remove().end().append('<input name="newalbumname" type="hidden" value="' + $('#newalbumname').val() + '" />');
				}
			firstform.find('input[name=albumid]').val(myalbumid).removeAttr('disabled');
		}else{
			firstform.find('input[name=savetoalbum]').attr('disabled', true).end().find('input[name=newalbumname]').remove().end().find('input[name=albumid]').removeAttr('disabled');
		}
		if($('#imgattachlist>div.wattingdiv:not(.loading) form').length == 1){firstform.append('<input type="hidden" name="finish" value="1" />');}
		firstform.ajaxSubmit({
			dataType: 'json',
			success:ajaxpostreturnHandle,
			error:ajaxpostErrorHandle});
	}
	function ajaxpostErrorHandle(){
		showDialog('发生意外错误，请刷新页面或<a href="javascript:;" onclick="fwin_dialog_submit.click();tjbuttom.click();">重试</a>！');
		$('input.tjbuttom').show();
	}
	$('input.tjbuttom').click(function(){
		formsubject = $('#subject').val();
		formtypeid = $('#typeid').val();
		if(formsubject.length <= 2){
			showDialog('标题不能为空或标题太短');
			return;
		}
		if(formtypeid == 0){
			showDialog('请选择帖子分类');
			return;
		}
		if($('#savetoalbum').is(':checked')){
			if(myalbumid == 0 && $('#newalbumname').val().length < 2){
				showDialog('您选择了保存图片到帖子但并未选择保存的相册或您填写的新建相册名太短');
				return;
			}
		}
		$(this).hide();
		if($('#imgattachlist>div.wattingdiv:not(.loading) form').length > 0){
			ajaxpostToThread();
		}else{
			showDialog('当前没有图片，请上传图片或从相册中选择图片添加');
			$(this).show();
		}
	});
	$('#selectalbum_list').bind('mouseover mouseout', function(event){
		switch(event.type){
			case 'mouseover' :
				$(this).show();break;
			case 'mouseout' :
				$(this).hide();break;
		}
	});
	$('.selectalbum_save').bind('mouseover mouseout', function(event){
		switch(event.type){
			case 'mouseover' :
				$('#selectalbum_list').show();break;
			case 'mouseout' :
				$('#selectalbum_list').hide();break;
		}
	});
	$('#typeidlist').bind('mouseover mouseout', function(event){
		switch(event.type){
			case 'mouseover' :
				$(this).show();break;
			case 'mouseout' :
				$(this).hide();break;
		}
	});
	$('#useajaxalbum').bind('mouseover mouseout', function(event){
		switch(event.type){
			case 'mouseover' :
				$(this).show();break;
			case 'mouseout' :
				$(this).hide();break;
		}
	});
	$('.selectft').bind('mouseover mouseout', function(event){
		switch(event.type){
			case 'mouseover' :
				$('#typeidlist').show();break;
			case 'mouseout' :
				$('#typeidlist').hide();break;
		}
	});
	$('.selectalbum').bind('mouseover mouseout', function(event){
		switch(event.type){
			case 'mouseover' :
				$('#useajaxalbum').show();break;
			case 'mouseout' :
				$('#useajaxalbum').hide();break;
		}
	});
	$('#tools_top').css('width',warpwidth);
	$('#pic_tools_tips').css('width',$('div.col_main div.col_side_r:first').width());
	$('#tips_tzjx').css('width',$('div.col_main div.col_side_r:first').width());
	function process_upload(now,max){if($('#process').length>0){var nowprocess = (now/max)*100+'%';if(now<=max){$('#process').width(nowprocess);$('#tpisoffl b').eq(0).css('color','#4695B4').html(now).end().eq(1).html(max);}}else{showDialog('<div class="ttt"><span id="tpisoffl">正在分楼 (<b>'+now+'</b>/<b>'+max+'</b>)</span></div>','notice');$('#fwin_dialog h3').remove();$('#fwin_dialog').addClass('forprocess');$('#fwin_dialog td.m_c div.c.altw').append('<div id="backgroundprocess"><div id="process"></div></div>');$('#fwin_dialog div.alert_info p').remove();$('#fwin_dialog td.m_c p.o.pns').remove();}};
	$(window).scroll(function(){
		if($('#imgattachlist>div.wattingdiv').length > 0){calpostion();}
	});
	$('#wp').css('min-height', document.documentElement.clientHeight - 125);
})(jQuery);