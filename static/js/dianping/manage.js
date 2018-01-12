//主题审核
jQuery(function(){
	jQuery(".op-audit").click(function(e){
		e.preventDefault();
		jQuery.get(this.href, function(msg){
			msg && jQuery(".op-audit").toggle() && jQuery("#info_status").toggle();
		});
	});
});
function stickreply(pid)
{
	jQuery.get('dianping.php?mod=misc&act=comment&do=stickreply', {pid:pid}, function(data){
	  easyDialog.open({
			container : {
				header : '置顶操作',
				content : data
			}
		});
	});
}

function stickreplybtn()
{
	var pid = jQuery("#pid").val();
	var mode = jQuery('input[name="mode"]:checked').val();
	var reason = jQuery("#reason").val();
	var formhash = jQuery("#formhash").val();
	var sendreasonpm = jQuery("#sendreasonpm").val();

	if(!reason){
		alert("请填写操作理由");
		return false;
	}
	jQuery.post('dianping.php?mod=misc&act=comment&do=stickreply', {pid:pid,mode:mode,reason:reason,formhash:formhash,sendreasonpm:sendreasonpm,stickreplybtn:true}, function(data){
		if(data){
			alert('操作完成');
		}
	});
}

function delpost(pid)
{
	jQuery.get('dianping.php?mod=misc&act=comment&do=delpost', {pid:pid}, function(data){
	  easyDialog.open({
			container : {
				header : '删除点评',
				content : data
			}
		});
	});
}

function delpostbtn()
{
	var pid = jQuery("#pid").val();
	var reason = jQuery("#reason").val();
	var formhash = jQuery("#formhash").val();
	var sendreasonpm = jQuery("#sendreasonpm").val();

	if(!reason){
		alert("请填写操作理由");
		return false;
	}
	jQuery.post('dianping.php?mod=misc&act=comment&do=delpost', {pid:pid,reason:reason,formhash:formhash,sendreasonpm:sendreasonpm,delpostbtn:true}, function(data){
		if(data){
			jQuery("#post_"+pid).slideUp(1000);
			// alert('操作完成');
		}
	});
}
