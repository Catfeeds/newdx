<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>
#container ul li{float: left; margin-left: 10px;}
fieldset{padding: 10px;}
.selected{font-weight: bold;}
.tdLimitWidth { word-break: break-all; overflow: hidden; }
.tb2 td { vertical-align: top; }
</style>
<div id="container">
<fieldset>
<h3><?php echo $mod;?>�б�</h3>
<legend>����ѡ��</legend>
<div>
<div style="margin-left:10px;">
<form action="" method="POST">
<input type="hidden" name="search" value="1" />
<select name="fmod" id="fmod">
<option value="">����ģ��</option><?php if(is_array($modules)) foreach($modules as $k => $v) { ?><option value="<?php echo $v['srcid'];?>" <?php if($v['srcid']===$nowmodule) { ?>selected="selected"<?php } ?>><?php echo $v['mname'];?></option>
<?php } ?>
</select>
<select name="search_type" id="search_type">
<option value="message" <?php if($search_type=='message' ) { ?>selected="selected"<?php } ?>>�ۺ�</option>
<option value="threadName" <?php if($search_type=='threadName' ) { ?>selected="selected"<?php } ?>>����</option>
<option value="author" <?php if($search_type=='author' ) { ?>selected="selected"<?php } ?>>����</option>	
</select>
<input type="text" name="search_key" value="<?php echo $search_key;?>">
<input type="submit" class="btn" value="����">&nbsp;&nbsp;&nbsp;(��������<span style="color:red"><?php echo $count;?></span>����¼)
<?php if($nowmodule=='line') { ?>
<span style="padding-left:15px;cursor: pointer;font-weight: bold;color:blue" id="resetHtmlall" url="admin.php?ctl=lineadmin&amp;act=resetHtml&amp;kid=all">������������</span>
<?php } ?>
<span><a href="javascript:void(0);" id="checkAll">ȫѡ</a>/<a href="javascript:void(0);" id="invert">��ѡ</a></span>
<span><a href="javascript:void(0);" id="deleteCheck">ɾ��ѡ��</a></span>
</form>
</div>
<ul id="modules">
<?php if($modules) { ?>
<li id="module_all" <?php if($nowmodule=='') { ?>class="selected"<?php } ?>><a href="admin.php?action=plugins&amp;operation=config&amp;do=<?php echo $pluginid;?>&amp;identifier=dianping&amp;pmod=dianping_manager">����ģ��</a></li><?php if(is_array($modules)) foreach($modules as $k => $v) { ?><li id="module_<?php echo $v['srcid'];?>" <?php if($v['srcid']===$nowmodule) { ?>class="selected"<?php } ?>><a href="admin.php?action=plugins&amp;operation=config&amp;do=<?php echo $pluginid;?>&amp;identifier=dianping&amp;pmod=dianping_manager&amp;fmod=<?php echo $v['srcid'];?>"><?php echo $v['mname'];?></a></li>
<?php } } else { ?>
<li>��ǰû��ģ�飬��<a href="admin.php?action=plugins&amp;operation=config&amp;do=<?php echo $pluginid;?>&amp;identifier=dianping&amp;pmod=system_manager&amp;fmod=addmodules">���</a></li>
<?php } ?>
</ul>
</div>
<span style="clear: both;"></span>
</fieldset>
</div>


<form action="" method="post" id="guideForm">
<table class="tb tb2">
<tr class="header">
<th  width="2%"></th>
<?php if($nowmodule) { ?>
<th>���</th>
<?php } ?>
<th>����<?php if($bicount) { ?>(8264�ң�<?php echo $bicount;?>)<?php } ?></th>	
<?php if($nowmodule&&$nowmodule!='mountain') { ?>
<th style="width:20%">�ŵ�</th>
<th style="width:20%">ȱ��</th>
<?php } ?>
<th style="width:30%">�ۺ�</th>
<th style="width:10%">��������</th>
<th style="width:8%"><?php if($nowmodule) { ?>����&nbsp;&nbsp;<a href="admin.php?action=plugins&amp;operation=config&amp;do=<?php echo $pluginid;?>&amp;identifier=dianping&amp;pmod=dianping_manager&amp;fmod=<?php echo $nowmodule;?>&amp;orderby=order">����</a><?php } ?></th>
<th style="width:5%">����</th>
<th style="width:5%">����ʱ��</th>
<th style="width:5%">����</th>
</tr>
<?php if($array) { if(is_array($array)) foreach($array as $val) { ?><tr>
<td><input type="checkbox" name="checkPid[]" value="<?php echo $val['pid'];?>" id="checkPid<?php echo $val['pid'];?>"></td>
<?php if($nowmodule) { ?>
<td>
<?php echo $val[$val['pid']]['number'];?>
</td>
<?php } ?>
<td>
<a href="http://u.8264.com/home-space-uid-<?php echo $val['authorid'];?>-do-thread-view-me-from-space.html" target="_blank"><?php echo $val['author'];?></a>&nbsp;&nbsp;
<?php if($val['rate']) { ?><img align="absmiddle" title="����8264��" alt="����8264��" src="static/image/common/8264b.gif">&nbsp;&nbsp;<?php } ?>
<br>
<?php if($val['coin']) { ?>(<?php echo $val['coin'];?>)<?php } ?>				 
</td>
<?php if($nowmodule&&$nowmodule!='mountain') { ?>
<td>
<div class="tdLimitWidth"><?php echo $val['goodpoint'];?></div>
</td>
<td>
<div class="tdLimitWidth"><?php echo $val['weakpoint'];?></div>
</td>
<?php } ?>
<td>
<div class="tdLimitWidth"><?php echo $val['message'];?></div>
</td>
<td>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $val['srcid'];?>&amp;act=showview&amp;tid=<?php echo $val['tid'];?>" target="_blank"><?php echo $val['threadName'];?></a>
</td>
<td>
<?php if($nowmodule) { if($val['starnum']>=1) { ?>
<input type="text" id="order_<?php echo $val['pid'];?>" onfocus="this.select();" onKeyDown="document.getElementById('submit_<?php echo $val['pid'];?>').style.visibility='visible'" onKeyPress="document.getElementById('submit_<?php echo $val['pid'];?>').style.visibility='visible'" onChange="document.getElementById('submit_<?php echo $val['pid'];?>').style.visibility='visible'" name="order_<?php echo $val['pid'];?>" size="2" value="<?php echo $val['showorder'];?>"/>&nbsp;
<input type="button" id="submit_<?php echo $val['pid'];?>" name="submit_<?php echo $val['pid'];?>" value="�޸�" style="visibility:hidden" onClick="checkvalue('order_<?php echo $val['pid'];?>');"/><input type="hidden" name="id" id="id" value="<?php echo $val['pid'];?>" />&nbsp;&nbsp;&nbsp;<span id="tip<?php echo $val['pid'];?>"></span>
<?php } } ?>
</td>
<td>
<span style="color:red"><?php echo $val['starnum'];?></span>
</td>
<td>
<?php echo $val['dateline'];?>
</td>
<td>
   <a href="<?php echo $urls;?>&pid=<?php echo $val['pid'];?>&del=1<?php if($val['srcid']) { ?>&fmod=<?php echo $val['srcid'];?><?php } ?>" onclick="return confirm('ȷ��ɾ���˵�����Ϣ��');">ɾ��</a>
</td>
</tr>	
<?php } } ?>
</table>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
<div style="float:left;">

</div>
<div style="float:right;">
<?php echo $multi;?>
</div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
jQuery(function(){
jQuery('#checkAll').click(function(){
jQuery('input[name="checkPid[]"]').attr('checked','checked');
});
jQuery('#invert').click(function(){
jQuery("input[name='checkPid[]']").each(function() {
jQuery(this).attr("checked", !jQuery(this).attr("checked"));
});
});
jQuery('#deleteCheck').click(function(){
if(jQuery("input[name='checkPid[]']:checked").length>0){
if(confirm("��ȷ��Ҫɾ����", function() { }, null)){
 jQuery("#guideForm").submit();
}else{
return false;
}
}else{
alert('��ѡ��Ҫɾ������Ϣ��');
}

});

});
function checkvalue(m){
if(document.getElementById(m).value==""){
alert('����������ţ�����Խ������Խ��');
return false;
}else{
var order = document.getElementById(m).value;
if(isNaN(order)){
alert("����Ĳ���һ������");
return false;
}
var id = jQuery("#"+m).next().next().val();
var str_url = 'plugin.php?id=dianping:ajax_updateskiing&tid='+id;
jQuery.ajax({
url: str_url + '&type=pl&order='+order,
type: "get",
success: function(msg){
if (msg=="success") {
jQuery("#tip"+id).html('');
jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('�޸ĳɹ���');
}else if(msg=="error"){
jQuery("#tip"+id).html('');
jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('�޸�ʧ�ܣ�');
}else if(msg=="cunzai"){
jQuery("#tip"+id).html('');
jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('�����Ѵ��ڣ��޸�ʧ�ܣ�');						
}
jQuery('#submit_'+id).css("visibility","hidden");
}				
});
}		
}
</script>