jQuery(function($){
	//����֤
	$("#btn_list .postactbutton").click( function () {
		$.getJSON("http://bbs.8264.com/forum.php?mod=misc&action=userbind&op=check&jsoncallback=?", function(data){
			if ( data.uid == discuz_uid ) {
				window.location.href = $("#btn_list .postactbutton").attr("href");;
				return false;
			} else {
				$(".bgblack70").show();
				$(".popbigbox").show();
				var window_h = $(window).height();
				var resultbox_h = $(".bdresultbox").height();
				var mt_resultbox = eval ( (window_h - resultbox_h)/2 );
				$(".bdresultbox").css("margin-top" , mt_resultbox + "px");

				var loginzaiwaibox_h = $(".loginzaiwaibox").height();
				var mt_loginzaiwaibox = eval ( (window_h - loginzaiwaibox_h)/2 );
				$(".loginzaiwaibox").css("margin-top" , mt_loginzaiwaibox + "px");
			}
		});
		return false;
	});

	//��½��
	$("#zw_login .loginbutton").click( function () {
		var tel = $("#zw_login .sjhboxinput").val(); //��ȡ�ֻ���
		var telReg = !!tel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
		//����ֻ����벻��ͨ����֤
		if(telReg == false){
			$(".errorinfobox").html("�ֻ��Ÿ�ʽ����");
		} else {
			var password = $("#zw_login .passwordboxinput").val();
			$.getJSON("http://bbs.8264.com/forum.php?mod=misc&action=userbind&op=login&mobile="+tel+"&password="+password+"&jsoncallback=?", function(data){
				if(data.errorCode) {
					$(".errorinfobox").html(data.errorReason);
				} else if(data.msg == 200) {
					$("#zw_login").hide();
					$("#zw_binded").show();
				}
			});
		}
		$(".errorinfobox").html();
	});

	//ע���
	$("#zw_reg .loginbutton").click( function () {
		var tel = $("#zw_reg .sjhboxinput").val(); //��ȡ�ֻ���
		var telReg = !!tel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
		//����ֻ����벻��ͨ����֤
		if(telReg == false){
			$(".errorinfobox").html("�ֻ��Ÿ�ʽ����");
		} else {
			var yzm = $("#zw_reg .yzmboxinput").val();
			var username = $("#zw_reg .ncboxinput").val();
			var password = $("#zw_reg .passwordboxinput").val();
			$.getJSON("http://bbs.8264.com/forum.php?mod=misc&action=userbind&op=reg&mobile="+tel+"&password="+password+"&vcode="+yzm+"&username="+username+"&jsoncallback=?", function(data){
				if(data.errorCode) {
					$(".errorinfobox").html(data.errorReason);
				} else if(data.msg == 200) {
					$("#zw_reg").hide();
					$("#zw_binded").show();
				}
			});
		}
		$(".errorinfobox").html();
	});

	//�����ť�رշ�ƽ�͵�����
	$(".close_black_50").click( function () {
		$("#zw_bind").show();
		$("#zw_binded").hide();
		$("#zw_reg").hide();
		$("#zw_login").hide();
		$(".errorinfobox").html("");
		$(".bgblack70").hide();
		$(".popbigbox").hide();
	});

	//�����ȡ��֤��
	$("#sendbutton").click( function () {

		var tel = $("#zw_reg .sjhboxinput").val(); //��ȡ�ֻ���
		var telReg = !!tel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
		//����ֻ����벻��ͨ����֤
		if(telReg == false){
			$(".errorinfobox").html("�ֻ��Ÿ�ʽ����");
		} else {
			send_button(this);

			$.getJSON("http://bbs.8264.com/forum.php?mod=misc&action=userbind&op=sendcode&mobile="+tel+"&jsoncallback=?", function(data){
				if(data.errorCode) {
					$(".errorinfobox").html(data.errorReason);
				} else if(data.msg == 200) {
					$(".errorinfobox").html("��֤���ѷ��ͣ������");
				}
			});
		}
		$(".errorinfobox").html();
	});

	var wait= 60;
	function send_button(o) {
		if (wait == 0) {
			//$(o).removeClass("fsyzmdisable");
			$(o).text("��ȡ��֤��");
			$(o).removeAttr("disabled");
			wait = 60;
		} else {
			//$(o).addClass("fsyzmdisable");
			$(o).attr("disabled", true);
			$(o).text("���·���(" + wait + ")");
			wait--;
			setTimeout(function() {
				send_button(o);
			},
			1000);
		}
	}

	//�ж�������Ƿ�֧�� placeholder
	if(!placeholderSupport()){   // �ж�������Ƿ�֧�� placeholder
		$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			}
		}).blur(function() {
			var input = $(this);
			if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
			}
		}).blur();
	};

	function placeholderSupport() {
		return 'placeholder' in document.createElement('input');
	}

});
