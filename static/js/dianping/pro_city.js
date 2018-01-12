/**
 * Created by Administrator on 2014/11/25.
 */

jQuery(document).ready(function($) {
    var tc_dq_maxW = $(".tc_dq").width();
    var maxW = $(".tc_dq").parent().width();
    $('.province').hover(function() {
        $(".tc_dq").hide();
        $(".div_city").hide();
        clearTimeout(window.subbox_show);
        var catid = $(this).attr("value");
        if ($("#province_" + catid).length > 0) {
            $("#province_" + catid).show();
            $(".tc_dq").show();
        }
        $(".tc_dq").css({
            "width": "auto"
        });
        var tc_dqW = $(".tc_dq").width() + 1;
        tc_dqW = tc_dqW > tc_dq_maxW ? tc_dq_maxW : tc_dqW;
        $(".tc_dq").css({
            "width": tc_dqW
        });
        var left = $(this).position().left + Math.floor($(this).width() / 2) - Math.floor(tc_dq_maxW / 4) + (tc_dq_maxW - tc_dqW) / 2;
        left = left < 0 ? 0 : left;
        left = left + Math.floor(tc_dqW / 4) * 5 > maxW ? maxW - tc_dqW - 22 : left;
        $(".tc_dq").css({
            "top": $(this).position().top + 24,
            'left': left + "px"
        });
    }, function() {
        window.subbox_show = setTimeout(function() {
            $(".tc_dq").hide();
            $(".div_city").hide();
        }, 300);
    });
    $('.tc_dq').hover(function() {
        clearTimeout(window.subbox_show);
    }, function() {
        window.subbox_show = setTimeout(function() {
            $(".tc_dq").hide();
            $(".div_city").hide();
        }, 300);
    });
});


jQuery(document).ready(function($) {
    var tc_dq_maxW = $(".nav-list-more-box").width();
    var maxW = $(".nav-list-more-box").parent().width();
    $('.province_line').hover(function() {
        $(".nav-list-more-box").hide();
        $(".nav-list-wrap").hide();
        clearTimeout(window.subbox_show);
        var catid = $(this).attr("value");
        if ($("#province_" + catid).length > 0) {
            $("#province_" + catid).show().children().children('li:lt(20)').show();
            $(".nav-list-more-box").show();
        }
        $(".nav-list-more-box").css({
            "width": "auto"
        });
        var tc_dqW = $(".nav-list-more-box").width() + 1;
        tc_dqW = tc_dqW > tc_dq_maxW ? tc_dq_maxW : tc_dqW;
        $(".nav-list-more-box").css({
            "width": "470px"
        });
        var left = $(this).position().left + Math.floor($(this).width() / 2) - Math.floor(tc_dq_maxW / 4) + (tc_dq_maxW - tc_dqW) / 2;
        left = left < 0 ? 0 : left;
        left = left + Math.floor(tc_dqW / 4) * 5 > maxW ? maxW - tc_dqW - 22 : left;
        $(".nav-list-more-box").css({
            "top": $(this).position().top + 24,
            'left': left + "px"
        });
    }, function() {
        window.subbox_show = setTimeout(function() {
            $(".nav-list-more-box").hide();
            $(".nav-list-wrap").hide();
        }, 300);
    });
    $('.nav-list-more-box').hover(function() {
        clearTimeout(window.subbox_show);
    }, function() {
        window.subbox_show = setTimeout(function() {
            $(".nav-list-wrap li:gt(20)").hide();
            $(".nav-list-wrap ul").removeAttr("style");
            $(".nav-list-more-box").hide();
            $(".nav-list-wrap").hide();
            $(".link-add-more").show();
        }, 300);
    });
    //下拉菜单展开缩起
    // var anum = $(".line_con_gray>a").size();
    // if (anum > 17) {
    //     $(".line_con_gray").delegate(".arrow_d", "click", function() {
    //         $(this).removeClass("arrow_d").addClass("arrow_u");
    //         $(this).parent().css("height", "auto");
    //     });


    //     $(".line_con_gray").delegate(".arrow_u", "click", function() {
    //         $(this).removeClass("arrow_u").addClass("arrow_d");
    //         $(this).parent().css("height", "30px");
    //     });
    // } else {
    //     $(".arrow_u").hide();
    //     $(".arrow_d").hide();
    // }

    $(".nav-list-wrap").delegate('.link-add-more', 'click', function() {
        $(this).parent().find('li:hidden').show();
        $(this).parent().find('ul').css({
            "height": '240px',
            "overflow-y": 'scroll'
        });
        $(this).hide();
    });

	var _th = $(".headerNav").height();
	var _bh = $(".bottomNav").height() + 30;

	var _ch = $(".ui-container").height() + 30;
	var _wh = $(window).height();

	var _ah = _wh - _th - _bh;
	_ch = _ch > _ah ? "auto" : _ah;
	
	$("#container").css({
		"height": _ch
	});
});


var params = {site:"http://www.8264.com/misc.php%3fmod=swfupload%26type=image%26fid=$fid%26mtype=plugin%26twidth=60%26theight=60%26random="+Math.random()+"%26back=upload_image_success",buttonimg:"http://static.8264.com/dianping/images/icon/data/uploadnew.png"};
swfobject.embedSWF("http://www.8264.com/static/flash/uploadforum.swf", "pic_upload_multiimg", "160", "45", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
swfobject.createCSS("#pic_upload_multiimg", "text-align:left;");
jQuery("#numimage").val(0);
/*发布时图片上传成功逻辑处理*/
function upload_image_success(type, returndata) {
    if(jQuery("#numimage").val() >5){
        jQuery("#check_pic_upload").attr('style','display:none');
        jQuery("#limit_pic_upload").show();
    }
    eval("var nattach = " + returndata + ";");
    ;(function($){
    if(nattach.nowcount < 50 || type != 3){
    if(document.getElementById('image_' + nattach.fileid) == null){
    $('#imagelisttemp').clone().attr('id', 'image_' + nattach.fileid).attr('title', nattach.filename).prependTo('#imglist');
    }
    }
    var attachobj = $('#image_' + nattach.fileid);
    switch(type){
    case 1:
    attachobj.prepend('<img src="' + nattach.thumbpic + '" />').find('input').val(nattach.aid).removeAttr('disabled').end().attr('id', 'image_' + nattach.aid).show();
    break;
    case 2:
    attachobj.prepend('<img src="' + nattach.thumbpic + '" />').find('input').val(nattach.aid).removeAttr('disabled').end().attr('id', 'image_' + nattach.aid).show();
    break;
    case 3:
    break;
    }
    $('#imglist').find('span:gt(2)').attr('style','visibility:hidden').addClass("overlimit").find('input').attr('disabled', true);
    var num = $('#imglist>span:not(".overlimit")').length;//num+=num;
    $('#numimage').val(num);
    })(jQuery);
    }
//编辑时图片上传成功逻辑处理
function upload_image_success_e(type, returndata) {
    if(jQuery("#numimage").val() >3){
        jQuery("#check_pic_upload_e").attr('style','display:none');
        jQuery("#limit_pic_upload_e").show();
    }
    eval("var nattach = " + returndata + ";");
    ;(function($){
    if(nattach.nowcount < 50 || type != 3){
    if(document.getElementById('image_' + nattach.fileid) == null){
    $('#imagelisttemp_e').clone().attr('id', 'image_' + nattach.fileid).attr('title', nattach.filename).prependTo('#imglist_e');
    }
    }
    var attachobj = $('#image_' + nattach.fileid);
    switch(type){
    case 1:
    attachobj.prepend('<img src="' + nattach.thumbpic + '" />').find('input').val(nattach.aid).removeAttr('disabled').end().attr('id', 'image_' + nattach.aid).show();
    break;
    case 2:
    attachobj.prepend('<img src="' + nattach.thumbpic + '" />').find('input').val(nattach.aid).removeAttr('disabled').end().attr('id', 'image_' + nattach.aid).show();
    break;
    case 3:
    break;
    }
    $('#imglist_e').find('span:gt(2)').attr('style','visibility:hidden').addClass("overlimit").find('input').attr('disabled', true);
    var num = $('#imglist_e>span:not(".overlimit")').length;//num ++;
    $('#numimage').val(num);
    })(jQuery);
    }


//地域分配最新版js,by liushijie
/*$(".nav-list-box>a[id^=cbtn_]").hover(function(){
    var cid=this.id.replace('cbtn_','');
    clearTimeout(window.subbox_show);
    $(".nav-list-box>div").hide();
    $("#sub_list_"+cid).css({"top":$(this).position().top+30,'left':$(this).position().left}).show();
},function(){
    var cid=this.id.replace('cbtn_','');
    window.subbox_show=setTimeout("jQuery('#sub_list_"+cid+"').hide();",300);
});
$(".nav-list-box>div[id^=sub_list_]").hover(function(){
    clearTimeout(window.subbox_show);
},function(){
    window.subbox_show=setTimeout("jQuery('#"+this.id+"').hide();",300);
});*/
