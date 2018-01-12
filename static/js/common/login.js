jQuery(document).ready(function($){
	$("#wp").css("height",$(".reg_bg_img>img").height());
	$(window).resize(function(){
		$("#wp").css("height",$(".reg_bg_img>img").height());
	});
	
	$("#getpassword").click(function(){
		$("#login_box").hide();
		$("#layer_lostpw_"+loginhash).show();
		return false;
	});
	$("#login_back").click(function(){
		$("#login_box").show();
		$("#layer_lostpw_"+loginhash).hide();
		return false;
	});
	
	$("#username_"+loginhash).focus(function(){
		$("#n_username_"+loginhash).html("");
	}).blur(function(){
		!$(this).val() && $("#n_username_"+loginhash).html(lang_login_id);
	});
	$("#username_"+loginhash).focus();
	$("#password3_"+loginhash).focus(function(){
		$("#n_password3_"+loginhash).html("");
	}).blur(function(){
		!$(this).val() && $("#n_password3_"+loginhash).html(lang_login_password);
	});
	
	$("#lostpw_username").focus(function(){
		$("#n_lostpw_username").html("");
	}).blur(function(){
		!$(this).val() && $("#n_lostpw_username").html(lang_username);
	});
	$("#lostpw_email").focus(function(){
		$("#n_lostpw_email").html("");
	}).blur(function(){
		!$(this).val() && $("#n_lostpw_email").html(lang_email);
	});
});