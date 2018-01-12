/*在界面显示错误 
 * *element_id 元素id, 没有id的不进行显示 
 * *msg 显示的信息 
 * */
function show_errors(element_id, msg){
    if(element_id != '') {
        var error_ele = "<div class=wrong><div class=lft></div><div class=rht>" + msg + "</div></div>";
        jQuery('#' + element_id).html(error_ele).show();
    }    
}
/*covert string to timestamp*/
function getNumberTime(time){
    time = time.replace(/-/g,"/");
    var date = new Date(time);
    time = Math.floor(date.getTime()/1000);
    return time;    
}

/*focus on one textbox of date*/
function focus_on_date(form, startTime, endTime, startHour, endHour) {
	setTimeout(function() {
		if(! (startTime < endTime || startHour < endHour)) {
			if(! startTime || startTime == 0) {
				form.find("input[name='datapicker[]']").eq(0).trigger('click').focus();
				return;
			}

			if(! endTime || endTime == 0) {
				form.find("input[name='datapicker[]']").eq(1).trigger('click').focus();
				return;
			}

			if(startTime == endTime) {
				if(! startHour || startHour == 0) {
					form.find("input[name='datapicker[]']").eq(2).trigger('click').focus();
					return;
				}

				if(! endHour || endHour == 0 || endHour <= startHour) {
					form.find("input[name='datapicker[]']").eq(3).trigger('click').focus();
					return;
				}
			}
		}
	}, 30);
}