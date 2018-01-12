//提交原创给百度
function pushOriginalToBaidu() {
	jQuery.get("misc.php?mod=pushoriginal&url="+document.URL, function(data){
		var data_obj = jQuery.parseJSON(data);
		if(data_obj.success == 1) {
			alert("推送成功，今天还可推送" + data_obj.remain + "条");
		}else if(data_obj.remain_original == 0) {
			alert("今天达到推送上限了");
		}else{
			alert("error: " + data_obj.error +"\nmessage: " + data_obj.message);
		}

	});
}
