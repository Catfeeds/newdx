jQuery(document).ready(function($) {
	// ��̳��ҳ�ײ������Ƽ�����Ӧ�߶�
	function resize_style() {
		var width = 235;
		var max_width = $('.choicenessList').width();
		var item_num = parseInt(max_width / width);
		var item_margin = parseInt((max_width % width) / (item_num + 1) / 2);
		var padding_left = item_margin;
		$('.wFull .choicenessList li').css({
			'margin-left': (2 * padding_left) + 'px'
		});
	}
	$(window).resize(resize_style);	
	setTimeout(function() {
		resize_style();
	}, 200);

	//������������
	$(".headerNav .nav li").hover(function() {
		$(this).find("dl").stop().fadeIn(100);
	}, function() {
		$(this).find("dl").stop().fadeOut(100);
	});

	//����ͷ������
	$(".loginInfo li").hover(function() {
		$(this).find(".infoPopup").stop().fadeIn(100);
	}, function() {
		$(this).find(".infoPopup").stop().fadeOut(100);
	});

	//������Ϣ�򵯳�
	$(".loginInfo li.eMailLi").mouseover(function() {
		$(".messagePopup").show();
	});
	$(".messagePopup .closeBtn").click(function() {
		$(".messagePopup").hide();
	});


	// ͷ����������ʾ
	$('#searchText').focus(function(){
		$('#searchTips').hide();
	}).blur(function(){
		if(!$(this).val()) {
			$('#searchTips').show();
		}
	});
	
	
	// ͨ��������ϳ�����Ŀlogo
	
	$(".jxtj li").hover(function(){
		$("a",this).show();
	},function(){
		$("a",this).hide();
	});
	
	
	
	
});


