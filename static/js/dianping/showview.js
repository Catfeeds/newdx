//����ҳajax��ҳ
jQuery(document).ready(function($){
	$("#commentlist").on('click',".pg>a",function(e){
		e.preventDefault();
		var snum=$('.snum').val();
		$.get(this.href, {ajaxreply:1,starnum:snum}, function(data){
			data && $("#commentlist").html(data);
		});
		$(document).scrollTop($('#commentlist').offset().top-60);
	});
	$(".star-s").on('click',"a",function(e){
		e.preventDefault();
		$.get(this.href, {ajaxreply:1,starnum:this.id}, function(data){
			data && $("#commentlist").html(data);
		});
		$('.snum').attr('value',this.id);
		$(document).scrollTop($('#commentlist').offset().top-60);
	});
	//�ر��޸ĵ���
	$('.close-popup').click(function(){
		$('#overlay').remove();
		$('#edithtml .editinput').val('');
		$('#edithtml').hide();
	});
});

//���ð�ť
function support(pid){
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
			jQuery("#support_"+pid+ " > i").addClass("icon-praise");
			jQuery("#support_"+pid+ " > em").html(data);
		}
	});
}
