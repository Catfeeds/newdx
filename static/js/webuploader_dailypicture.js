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
        auto: false,

        // swf文件路径
        swf: 'http://static.8264.com/static/flash/webuploader.swf',

        // 文件接收服务端。
        server: $("#url_action").val(),

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick : {id : "#filePicker",

			//只能选择一个文件上传

			multiple: false},		

		//限制只能上传一个文件

		fileNumLimit: 1, 
		
		fileSizeLimit: 10000000,

		threads: 1,

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
	
    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
		$("#fileid").val(file.id);
		$("#pic_tips").html(file.name);
		$("#filePicker input").attr("disabled", true);
    });

	$("#start_submit").on('click', function () {
			if ($('#username').val() == '') {
				alert('昵称不可为空');
				return false;
			}
			if ($('#contact').val() == '') {
				alert('常用邮箱不可为空');
				return false;
			}
			if ($('#fileid').val() == '') {
				alert('请上传作品');
				return false;
			}

			if ($('#pic-pub-form .picName').val() == '') {
				alert('作品名称不可为空');
				return false;
			}
			if ($('#pic-pub-form .picDescription').val() == '') {
				alert('作品描述不可为空');
				return false;
			}

			if ($('#captcha').val() == '') {
				alert('验证码不可为空');
				return false;
			}

			if (!validate_captcha()) {
				alert('验证码错误');
				$('#refreshCaptcha').click();
				$('#captcha').val('');
				return false;
			}

			$("#start_submit").attr("disabled",true).html("图片上传中");
			var filename = $("#pic_tips").html();
			$("#pic_tips").html(filename+" <span style='color:green;font-weight:bold;'>上传中</span>");
            uploader.upload();
    });
	
	// 文件上传upyun以后，从upyun服务器获取返回值
	uploader.on('uploadAccept', function(obj, ret){
		if(ret.code == '200'){
			$("#picPath").val(ret.url);
			$("#filename").val(obj.file.name);

			$('#pic-pub-form').submit();
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
			alert("签名失效，请刷新页面后再上传图片。");
		}else{
			$('#pic_tips').html(file.name+" <span style='color:red;font-weight:bold;'>上传失败！</span>");
			$('#fileid').val("");
			$('#start_submit').html("请刷新页面");
			alert("图片上传失败，请刷新页面后再上传图片。");
		}

		//通过upyun cdn检测工具，获取目标upyun的ip、用户ip、用户省份、用户网络运营商
		$.getJSON("http://pubstatic.b0.upaiyun.com/?_upnode&t="+(+new Date()), function(json) {
			// 将portalcp article form上传过程中出现的错误，记录到日志中
			var url = "/plugin.php?id=dailypicture:public";
			$.ajax({
				type : 'POST',
				url : url,
				data : {'islog':1 , 'reason':reason, 'upyun_ip':json.addr, 'user_ip':json.remote_addr, 'user_location':json.remote_addr_location},
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
		if(handler == 'Q_EXCEED_SIZE_LIMIT'){
			alert("文件太大，请选择小于9M的文件");
		}
	});
});


$('#refreshCaptcha').click(function() {
	$(this).children('img').attr('src', '/plugin.php?id=dailypicture:captcha&_='+(new Date().getTime()));
	return false;
});

function validate_captcha() {
	var vaild = false;
	$.ajax(
		{
			async: false,
			type: 'get',
			url: '/plugin.php?id=dailypicture:validatecaptcha&captcha='+$('#captcha').val(),
			success : function(data) {
				if (data==1) {
					vaild = true;
				}
			}
		}
	);
	return vaild;
}