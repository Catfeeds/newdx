//�ύԭ�����ٶ�
function pushOriginalToBaidu() {
	jQuery.get("misc.php?mod=pushoriginal&url="+document.URL, function(data){
		var data_obj = jQuery.parseJSON(data);
		if(data_obj.success == 1) {
			alert("���ͳɹ������컹������" + data_obj.remain + "��");
		}else if(data_obj.remain_original == 0) {
			alert("����ﵽ����������");
		}else{
			alert("error: " + data_obj.error +"\nmessage: " + data_obj.message);
		}

	});
}
