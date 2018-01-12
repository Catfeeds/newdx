jQuery(document).ready(function($){
	$("#wp").css("height",$(".reg_bg_img>img").height());
	$(window).resize(function(){
		$("#wp").css("height",$(".reg_bg_img>img").height());
	});

	$("#r_username").focus(function(){
		$("#n_username").text("");
		if(!cUname){
			$("#m_username").css("visibility","visible").attr("class", "noteinfo").text(lang_register_username_tips);
		}
	}).blur(function(){
		if(!cUname){
			checkUsername($("#r_username").val());
		}
	}).change(function(){
		cUname = false;
	});
	$("#r_username").focus();
	$("#r_password").focus(function(){
		$("#n_password").text("");
		if(!cPwd){
			$("#m_password").css("visibility","visible").attr("class", "noteinfo").text("请输入6-16位密码，不能全数字");
		}
	}).blur(function(){
		pass = jQuery.trim($("#r_password").val());
		
		if(!cPwd){
			if(!$.trim($("#r_password").val())){
				r_error("请输入6-16位密码，不能全数字", "m_password");
				return;
			}else if(pass.length < 6 || pass.length > 16) {
				r_error(pass.length < 6 ? '密码小于 6 个字符' : '密码超过 16 个字符', 'm_password');
				return;
			}else if(pass.indexOf("<") != -1 || pass.indexOf(">") != -1 || (/[^\w]/).test(pass)){
				r_error('密码不能包含特殊字符、“>”和“<”', 'm_password');
				return;
			}else if(/^[0-9]+$/.test(pass)){
				r_error('密码不能全为数字', 'm_password');
				return;
			}
			r_success("m_password");
			cPwd = true;
			checkPassword();
		}
	}).change(function(){
		cPwd = false;
	});
	$("#r_password2").focus(function(){
		$("#n_password2").text("");
		if(!cPwd2){
			$("#m_password2").css("visibility","visible").attr("class", "noteinfo").text(lang_register_repassword_tips);
		}
	}).blur(function(){
		if(!cPwd2){
			if(!$.trim($("#r_password2").val())){
				r_error(lang_register_repassword_tips, "m_password2");
				return;
			}
			checkPassword();
		}
	}).change(function(){
		cPwd2 = false;
	});
	//$("#r_email").focus(function(){
	//	$("#n_email").text("");
	//	if(!cEml){
	//		$("#m_email").css("visibility","visible").attr("class", "noteinfo").text(lang_register_email_tips);
	//	}
	//}).blur(function(){
	//	if(!cEml){
	//		emailMenuOp(3, null, "r_email");
	//	}
	//}).change(function(){
	//	cEml = false;
	//}).click(function(e){
	//	emailMenu(e, "r_email");
	//}).keyup(function(e){
	//	emailMenu(e, "r_email");
	//}).keydown(function(e){
	//	emailMenuOp(4, e, "r_email");
	//});
});
var cUname = false, cPwd = false, cPwd2 = true, cEml = true;
function checksubmit() {
    var is_verify = regIsAppearVerify();
    if(is_verify){
        jQuery('.yzm').show();
    }
    if(base_file == 'connect.php'){
        cPwd = cPwd2 = true;
    }
	if((cUname && cPwd && cPwd2 && cEml) || activation_reg){
		ajaxpost('registerform', 'r_message', 'r_message');
		jQuery("#r_message").show();
		return;
	} else {
		return false;
	}
}
function r_error(msg, id){
	jQuery("#"+id).attr("class","noteerror").html(msg);
}
function r_success(id){
	jQuery("#"+id).attr("class","noteright").html("");
}
function r_wait(id){
	jQuery("#"+id).attr("class","noteinfo").html('<img src="'+s_url+'image/common/loading.gif" /> 检测中...');
}
function checkUsername(username){
	username = jQuery.trim(username);
	if(username.match(/<|"/ig)) {
		r_error('用户名包含敏感字符', 'm_username');
		return;
	}
	var unlen = username.replace(/[^\x00-\xff]/g, "**").length;
	if(unlen < 3 || unlen > 15) {
		r_error(unlen < 3 ? '用户名小于 3 个字符' : '用户名超过 15 个字符', 'm_username');
		return;
	}
	r_wait('m_username');
	var x = new Ajax();
	x.get('forum.php?mod=ajax&inajax=yes&infloat=register&handlekey=register&ajaxmenu=1&action=checkusername&username=' + (BROWSER.ie && document.charset == 'utf-8' ? encodeURIComponent(username) : username), function(msg) {
		if(msg == 'succeed') {
			r_success('m_username');
			cUname = true;
		} else if(msg !== '') {
			r_error(msg, 'm_username');
		}
	});
}
function checkPassword(){
	if(jQuery.trim(jQuery("#r_password").val())!=jQuery.trim(jQuery("#r_password2").val())){
		r_error("两次输入的密码不一致", "m_password2");
		cPwd2 = false;
		return;
	} else {
		r_success("m_password2");
		cPwd2 = true;
	}
}
function regIsAppearVerify(){
    var flag = false;
    var url = 'forum.php?mod=ajax&inajax=yes&infloat=register&handlekey=register&ajaxmenu=1&action=regIsAppearVerify';
    url = decodeURI(url);
    jQuery.ajax({
        async:false ,
        type: 'POST',
        url: url,
        data: '',
        dataType: 'json',
        success: function(data){
            flag = data.is_yzm;
        }
    });
    return flag;
}
/*function checkEmail(email) {
	email = jQuery.trim(email);
	if(email.match(/<|"/ig)) {
		r_error('Email 包含敏感字符', "m_email");
		return;
	}
	if(email.length<5){
		r_error('请输入正确的邮箱地址', "m_email");
		return;
	}
	r_wait('m_email');
	var x = new Ajax();
	x.get('forum.php?mod=ajax&inajax=yes&infloat=register&handlekey=register&ajaxmenu=1&action=checkemail&email=' + email, function(msg) {
		if(msg == 'succeed') {
			r_success('m_email');
			cEml = true;
		} else if(msg !== '') {
			r_error(msg, 'm_email');
		}
	});
}

var emailMenuST = null, emailMenui = 0, emaildomains = ['qq.com', '163.com', 'sina.com', 'sohu.com', 'yahoo.cn', 'gmail.com', 'hotmail.com'];
function emailMenuOp(op, e, id) {
	if(op == 3 && BROWSER.ie && BROWSER.ie < 7) {
		checkEmail(jQuery("#r_email").val());
	}
	if(!$('emailmore_menu')) {
		return;
	}
	if(op == 1) {
		$('emailmore_menu').style.display = 'none';
	} else if(op == 2) {
		showMenu({'ctrlid':'emailmore','pos': '13!'});
	} else if(op == 3) {
		emailMenuST = setTimeout(function () {
			emailMenuOp(1, id);
			checkEmail(jQuery("#r_email").val());
		}, 500);
	} else if(op == 4) {
		e = e ? e : window.event;
		var obj = $(id);
		if(e.keyCode == 13) {
			var v = obj.value.indexOf('@') != -1 ? obj.value.substring(0, obj.value.indexOf('@')) : obj.value;
			obj.value = v + '@' + emaildomains[emailMenui];
			doane(e);
		}
	} else if(op == 5) {
		var as = $('emailmore_menu').getElementsByTagName('a');
		for(i = 0;i < as.length;i++){
			as[i].className = '';
		}
	}
}
function emailMenu(e, id) {
	if(BROWSER.ie && BROWSER.ie < 7) {
		return;
	}
	e = e ? e : window.event;
	var obj = $(id);
	if(obj.value.indexOf('@') != -1) {
		jQuery("#emailmore_menu").css('display','none');
		return;
	}
	var value = e.keyCode;
	var v = obj.value;
	if(!obj.value.length) {
		emailMenuOp(1);
		return;
	}

	if(value == 40) {
	emailMenui++;
	if(emailMenui >= emaildomains.length) {
		emailMenui = 0;
	}
	} else if(value == 38) {
		emailMenui--;
		if(emailMenui < 0) {
			emailMenui = emaildomains.length - 1;
		}
	} else if(value == 13) {
  		$('emailmore_menu').style.display = 'none';
  		return;
 	}
	if(!$('emailmore_menu')) {
		menu = document.createElement('div');
		menu.id = 'emailmore_menu';
		menu.style.display = 'none';
		menu.className = 'p_pop';
		$('append_parent').appendChild(menu);
	}
	var s = '<ul>';
	for(var i = 0; i < emaildomains.length; i++) {
		s += '<li><a href="javascript:;" onmouseover="emailMenuOp(5)" ' + (emailMenui == i ? 'class="a" ' : '') + 'onclick="jQuery(\'#r_email\').val(this.innerHTML);display(\'emailmore_menu\');">' + v + '@' + emaildomains[i] + '</a></li>';
	}
	s += '</ul>';
	$('emailmore_menu').innerHTML = s;
	emailMenuOp(2);
}*/