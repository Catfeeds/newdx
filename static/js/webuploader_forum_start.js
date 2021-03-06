var tipsnow = false;
var posonshow = false;
var maxnum = 50;

// 图片上传demo
jQuery(function() {
    var $ = jQuery,
        $list = $('#imgattachlist'),
        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 100 * ratio,
        thumbnailHeight = 100 * ratio,

        // Web Uploader实例
        uploader;

    // 初始化Web Uploader
    uploader = WebUploader.create({

        // 自动上传。
        auto: true,

        // swf文件路径
        swf: 'http://static.8264.com/static/flash/webuploader.swf',

        // 文件接收服务端。
        server: $("#url_action").val(),

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',
		
		threads: 1,

		fileNumLimit: maxnum,
		
		runtimeOrder: 'html5,flash',

        // 只允许选择文件，可选。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png,image/gif,image/bmp'
        },
		
		formData: {
			policy: $("#url_policy").val(),
			signature: $("#url_signature").val()
		}
    });
	
	// 当文件被加入队列之前触发
	uploader.on( 'beforeFileQueued', function( file ) {
		if($('#uploadimagelist>li').length >=  maxnum){
			if(!tipsnow){
				tipsnow = true;
				showDialog("当前最多只允许一次性添加 " + maxnum + " 张图片");
				$('#fwin_dialog_submit').click(function(){
					setTimeout(function(){tipsnow = false;}, 1000);
				})
			}
			return false;
		}
	});


    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
		$("#filePicker input").attr("disabled", true);

    });
	
	
	// 某个文件开始上传前触发，一个文件只会触发一次。
	uploader.on( 'uploadStart', function( file ) {
	});

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
	
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );

    });
	
	// 文件上传upyun以后，从upyun服务器获取返回值
	uploader.on('uploadAccept', function(obj, ret){

		if(ret.code == '200'){
		
			if(document.getElementById('watting_' + obj.file.id) == null){
				if($('#uploadimagelist>li').length >=  maxnum){
					if(!tipsnow){
						tipsnow = true;
						showDialog("当前最多只允许一次性添加 " + maxnum + " 张图片");
						$('#fwin_dialog_submit').click(function(){
							setTimeout(function(){tipsnow = false;}, 1000);
						})
					}
					return false;
				}
				$('#imagetemp').clone().attr('id', 'image_td_' + obj.file.id).attr('title', obj.file.name).appendTo('#uploadimagelist').show();

				if(!posonshow){
					var attachobj = $('#image_td_' + obj.file.id);
					var show_Windows = $('#uploadimagelist').parent();
					var show_WindowsPos = {top: show_Windows.offset().top, bottom: show_Windows.offset().top + show_Windows.height()};
					var attachPos = {top: attachobj.offset().top, bottom: attachobj.offset().top + attachobj.height()};
					var nowScroll = show_Windows.scrollTop();
					/*if(show_WindowsPos.top > attachPos.top){
						posonshow = true;
						show_Windows.scrollTop(nowScroll - show_WindowsPos.top + attachPos.top)
					}else*/ if(show_WindowsPos.bottom < attachPos.bottom){
						posonshow = true;
						show_Windows.scrollTop(nowScroll + attachPos.bottom - show_WindowsPos.bottom)
					}
				}
			}
			var fid = $("#fid").val();
			var editorid = $("editorid").val();
			var url = "misc.php?mod=swfupload&type=image&fid="+fid+"&operation=upyunform";
			$.ajax({
				type : 'POST',
				url : url,
				data : {'filesize':ret.file_size, 'type':ret.mimetype, 'url':ret.url, 'time':ret.time, 'raw':ret._raw, 'filename':obj.file.name},
				dataType : 'json',
				async: false,
				success:function(result){
					if(result.flag == 1){
						var attachobj = $('#image_td_' + obj.file.id);
						var show_Windows = $('#uploadimagelist').parent();
						var show_WindowsPos = {top: show_Windows.offset().top, bottom: show_Windows.offset().top + show_Windows.height()};
						var attachPos = {top: attachobj.offset().top, bottom: attachobj.offset().top + attachobj.height()};
						var nowScroll = show_Windows.scrollTop();
						

						posonshow = false;
						attachobj.find('.temppercent').remove();
						attachobj.find('img').attr('id', 'image_' + result.aid).attr('aid', result.aid).attr('src', attachserver_image + ret.url + "!t2w112h112").attr('bigthumb', attachserver_image + ret.url + "!t1w300h300").click(function(){
							if(! $(this).parent().hasClass('imgdeleted')){
								insertAttachimgTag(result.aid);
								$('#'+editorid+'_iframe').contents().trigger('keyup');
							}
						}).one('error', function(){
							$(this).attr('src', ' ');
							$(this).attr('src', attachserver_image + ret.url);
						}).show();
						result.rename_id_fun = function(){
							attachobj.attr('id', 'image_td_' + result.aid);
						}
						attachobj.find('a.close14_14_24w').click(function(){
							delImgAttach(result.aid);
						});
						attachobj.find('input.description').attr('name', 'attachnew[' + result.aid + '][description]').attr('id', 'image_desc_' + result.aid).end().show();
						$('#uploadimagediv').show().prev().hide();
						setTimeout(result.rename_id_fun, 2000);
						
						attachobj.find('input.albumabout').val(result.aid);
						if($('#selectsavealbum input[name=insertall]').is(':checked')){
							attachobj.find('input.albumabout').removeAttr('disabled');
						}
					}
				}
			});
			
			var url = "misc.php?mod=swfupload&operation=upyunformlog";
			$.ajax({
				type : 'POST',
				url : url,
				data : {'flag':1, 'noFenlou':1, 'reason':ret._raw},
				dataType : 'json',
				success:function(result){
					if(1){
						
					}
				}
			});
			
			
		}
	});

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).addClass('upload-state-done');
    });

    // 文件上传失败，现实上传出错。
    uploader.on( 'uploadError', function( file, reason ) {
		// 修改了webuploader.js 6886-6889行

		var rea = eval("("+reason+")");
		if(rea.message == 'authorization has expired'){
			showDialog("签名失效，请刷新页面后再上传图片。");
		}else{
			showDialog("图片上传失败，请刷新页面后再上传图片。");
		}

		//通过upyun cdn检测工具，获取目标upyun的ip、用户ip、用户省份、用户网络运营商
		$.getJSON("http://pubstatic.b0.upaiyun.com/?_upnode&t="+(+new Date()), function(json) {
			// 将form上传过程中出现的错误，记录到日志中
			var url = "misc.php?mod=swfupload&operation=upyunformlog";
			$.ajax({
				type : 'POST',
				url : url,
				data : {'flag':0, 'noFenlou':1, 'reason':reason, 'upyun_ip':json.addr, 'user_ip':json.remote_addr, 'user_location':json.remote_addr_location},
				dataType : 'json',
				success:function(result){
					if(1){
						
					}
				}
			});

		});

		
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });
	
	uploader.on( 'uploadFinished', function( file ) {
		$("#filePicker input").removeAttr("disabled");
    });

	// 当validate不通过时，会以派送错误事件的形式通知调用者。
	uploader.on('error', function( handler ) {
		
		if(handler == 'Q_EXCEED_NUM_LIMIT'){
			showDialog("当前最多只允许一次性添加 " + maxnum + " 张图片");
			$('#fwin_dialog_submit').click(function(){
				setTimeout(function(){tipsnow = false;}, 1000);
			})
		}else if(handler == 'Q_TYPE_DENIED'){
			showDialog("当前只允许上传图片类型文件");
			$('#fwin_dialog_submit').click(function(){
				setTimeout(function(){tipsnow = false;}, 1000);
			})
		}
	});
});