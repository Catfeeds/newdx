<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>
#container ul li{float: left; margin-left: 10px;}
fieldset{padding: 10px;}
.selected{font-weight: bold;}
#modules{overflow:hidden;}
</style>
<div id="container">
<fieldset>
<h3><?php echo $mod;?>列表</h3>
<legend>搜索选项</legend>
<div>
<ul id="modules">
<?php if($modules) { ?>
<li id="module_all" <?php if($nowmodule=='') { ?>class="selected"<?php } ?>><a href="admin.php?action=plugins&amp;operation=config&amp;do=<?php echo $pluginid;?>&amp;identifier=dianping&amp;pmod=topic_manager">所有模块</a></li><?php if(is_array($modules)) foreach($modules as $k => $v) { ?><li id="module_<?php echo $v['srcid'];?>" <?php if($v['srcid']===$nowmodule) { ?>class="selected"<?php } ?>><a href="admin.php?action=plugins&amp;operation=config&amp;do=<?php echo $pluginid;?>&amp;identifier=dianping&amp;pmod=topic_manager&amp;fmod=<?php echo $v['srcid'];?>"><?php echo $v['mname'];?></a></li>
<?php } } else { ?>
<li>当前没有模块，请<a href="admin.php?action=plugins&amp;operation=config&amp;do=<?php echo $pluginid;?>&amp;identifier=dianping&amp;pmod=system_manager&amp;fmod=addmodules">添加</a></li>
<?php } ?>
</ul>
</div>
<br>
<div style="margin-left:10px;">
<form action="" method="POST">
<input type="hidden" name="search" value="1" />
名称:
<input type="text" name="kName" id="kName" size="18" value="<?php echo $search['kName'];?>" />
tid:
<input type="text" name="tid" id="tid" size="18" value="<?php echo $search['tid'];?>" />

<select name="ispublish" id="ispublish">
<option value=""  <?php if(empty($search['ispublish'])) { ?>selected="selected"<?php } ?>>全部</option>
<option value="0" <?php if($search['ispublish']=='0') { ?>selected="selected"<?php } ?>>己审核</option>
<option value="1" <?php if($search['ispublish']=='1') { ?>selected="selected"<?php } ?>>未审核</option>
</select>
<?php if(($ord[$nowmodule]=='skiing'||$ord[$nowmodule]=='equipment')&&$nowmodule) { ?>
排序:
<select name="orderby" id="orderby">
<option value="0" <?php if($search['orderby']=='0') { ?>selected="selected"<?php } ?>>发布时间</option>
<option value="1" <?php if($search['orderby']=='1') { ?>selected="selected"<?php } ?>>排序</option>
</select>
<select name="horl" id="horl">
<option value="0" <?php if($search['horl']=='0') { ?>selected="selected"<?php } ?>>降序</option>
<option value="1" <?php if($search['horl']=='1') { ?>selected="selected"<?php } ?>>升序</option>
</select>
<?php } ?>
<input type="submit" class="btn" value="搜索">&nbsp;&nbsp;&nbsp;(共检索到<span style="color:red"><?php echo $count;?></span>条记录)
<?php if($nowmodule=='line') { ?>
<span style="padding-left:15px;cursor: pointer;font-weight: bold;color:blue" id="resetHtmlall" url="admin.php?ctl=lineadmin&amp;act=resetHtml&amp;kid=all">重新生成所有</span>
<?php } ?>
</form>
</div>
<span style="clear: both;"></span>
</fieldset>
</div>
<form action="" method="post" id="guideForm">
<table class="tb tb2">
<tr class="header">
<th>主题</th>
<th>模块</th>
<th>回复数</th>
<th>发布时间</th>
        <?php if($nowmodule=='club' && $_G['uid']==3552231 || $_G['uid']==125851) { ?>
        <th>联系人</th>
        <th>联系方式</th>
        <?php } if($nowmodule=='mountain') { ?>
<th>发布作者</th>
<?php } if($nowmodule=='brand') { ?>
<th>是否招商</th>
<th>是否置顶</th>
<?php } ?>
<th><?php if($nowmodule) { if($nowmodule!='brand') { ?>排序<?php } else { ?>招商电话<?php } } ?></th>
<th>评分</th>
<th>评分变化</th>
<th>审核状态</th>
<th>操作</th>
</tr>
<?php if($threadlist['list']) { if(is_array($threadlist['list'])) foreach($threadlist['list'] as $val) { ?><tr>
<td>
<a href="http://www.8264.com/dianping.php?mod=<?php echo $val['scr'];?>&amp;act=showview&amp;tid=<?php echo $val['tid'];?>" target="_blank"><?php echo $val['subject'];?></a>
<?php if($nowmodule != 'mountain') { ?>
 &nbsp;&nbsp;<a href="http://u.8264.com/space-uid-<?php echo $val['authorid'];?>.html" target="_blank" style="color: red;">(<?php echo $val['author'];?>)</a>
<?php } if($nowmodule=='brand') { ?>
 &nbsp;&nbsp;<span id="<?php echo $val['tid'];?>ty" style="font-weight: bold;color: blue;cursor: pointer;" onclick="edit_bq(<?php echo $val['tid'];?>)"><img alt="" src="static/image/admincp/editable.gif"></span>&nbsp;
<?php } ?>
</td>
<td>
<?php echo $val['mod'];?>
</td>
<td>
<?php echo $val['replies'];?>
</td>
<td>
<?php echo $val['dateline'];?>
</td>
        <?php if($nowmodule=='club'&& $_G['uid']==3552231 || $_G['uid']==125851) { ?>
        <td><?php echo $val['contact'];?></td>
        <td>
            <?php if($val['tel']) { ?>
            电话：<?php echo $val['tel'];?>
            <br>
            <?php } ?>
            <?php if($val['weixin']) { ?>
            微信：<?php echo $val['weixin'];?><br>
            <?php } ?>
            <?php if($val['qq']) { ?>
            QQ：<?php echo $val['qq'];?>
            <?php } ?>

        </td>
        <?php } if($nowmodule=='mountain') { ?>
<td>
<a href="http://u.8264.com/space-uid-<?php echo $val['authorid'];?>.html" target="_blank" style="color: red;"><?php echo $val['author'];?></a>
</td>
<?php } if($nowmodule=='brand') { ?>
<td>
<?php if($val['bzs']) { ?><span style="color:green">招商中</span><?php } else { ?><span style="color:red">未招商</span><?php } ?>
</td>
<td>
<?php if($val['displayorder']==1) { ?><span style="color:green">置顶中</span><?php } else { ?><span style="color:red">未置顶</span><?php } ?>
</td>
<?php } ?>
<td>
<?php if($nowmodule) { if($nowmodule!='brand') { ?>
<input type="text" id="order_<?php echo $val['tid'];?>" onfocus="this.select();" onKeyDown="document.getElementById('submit_<?php echo $val['tid'];?>').style.visibility='visible'" onKeyPress="document.getElementById('submit_<?php echo $val['tid'];?>').style.visibility='visible'" onChange="document.getElementById('submit_<?php echo $val['tid'];?>').style.visibility='visible'" name="order_<?php echo $val['tid'];?>" size="2" value="<?php echo $val['orderby'];?>"/>&nbsp;
<input type="button" id="submit_<?php echo $val['tid'];?>" name="submit_<?php echo $val['tid'];?>" value="修改" style="visibility:hidden" onClick="checkvalue('order_<?php echo $val['tid'];?>');"/><input type="hidden" name="id" id="id" value="<?php echo $val['tid'];?>" />&nbsp;&nbsp;&nbsp;<span id="tip<?php echo $val['tid'];?>"></span>
<?php } else { ?>
<input type="text" id="order_<?php echo $val['tid'];?>" onfocus="this.select();" onKeyDown="document.getElementById('submit_<?php echo $val['tid'];?>').style.visibility='visible'" onKeyPress="document.getElementById('submit_<?php echo $val['tid'];?>').style.visibility='visible'" onChange="document.getElementById('submit_<?php echo $val['tid'];?>').style.visibility='visible'" name="order_<?php echo $val['tid'];?>" size="8" value="<?php echo $val['zstel'];?>"/>&nbsp;
<input type="button" id="submit_<?php echo $val['tid'];?>" name="submit_<?php echo $val['tid'];?>" value="修改" style="visibility:hidden" onClick="checkvaluebrand('order_<?php echo $val['tid'];?>');"/><input type="hidden" name="id" id="id" value="<?php echo $val['tid'];?>" />&nbsp;&nbsp;&nbsp;<span id="tip<?php echo $val['tid'];?>"></span>
<?php } } ?>
</td>
<td><b style="color: blue;"><?php echo $allfen[$val['tid']]['price'];?></b></td>
<td><?php if($allfen[$val['tid']]['lastchange'] == 0) { ?><b style="color:blue;">-</b><?php } else { if($allfen[$val['tid']]['lastchange'] == 1) { ?><b style="color:red;">∧</b><?php } else { ?><b style="color:green;">∨</b><?php } } ?></td>
<td>
<div id="sta_<?php echo $val['tid'];?>"><?php echo $val['status'];?></div>
</td>
<td>
<?php if($nowmodule=='brand') { ?>
<a class="zhaoshang" <?php if(($val['bzs']==1)) { ?>style="display:none"<?php } ?> href="<?php echo $url;?>&gid=<?php echo $val['id'];?>&zs=1">设为招商</a>
<a class="unzhaoshang" <?php if(($val['bzs']!=1)) { ?>style="display:none"<?php } ?> href="<?php echo $url;?>&gid=<?php echo $val['id'];?>&zs=0">取消招商</a>&nbsp;
&nbsp;
<a class="zding" <?php if(($val['displayorder']==1)) { ?>style='display:none' <?php } ?> href="<?php echo $url;?>&gid=<?php echo $val['id'];?>&zd=1">设为置顶</a>
<a class="buzhiding" <?php if(($val['displayorder']!=1)) { ?>style='display:none' <?php } ?> href="<?php echo $url;?>&gid=<?php echo $val['id'];?>&zd=0">取消置顶</a>
&nbsp;
<?php } if($nowmodule=='line') { ?>
<span><a class="maphtml" href="admin.php?ctl=lineadmin&amp;act=resetHtml&amp;kid=<?php echo $val['tid'];?>">重新生成地图</a></span>
&nbsp;
<?php } if($val['closed']==0) { ?>
<a href="<?php echo $url;?>&op=<?php echo $val['scr'];?>&tid=<?php echo $val['tid'];?>&isshow=1" onclick="return checkPass(<?php echo $val['tid'];?>);" class="shen_<?php echo $val['tid'];?>">通过</a>
<?php } else { ?>
<a href="<?php echo $url;?>&op=<?php echo $val['scr'];?>&tid=<?php echo $val['tid'];?>&isshow=0" onclick="return checkPass(<?php echo $val['tid'];?>);" class="shen_<?php echo $val['tid'];?>">不通过</a>
<?php } ?>
</td>
</tr>
<?php } } else { } ?>
</table>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
<div style="float:left;">

</div>
<div style="float:right;">
<?php echo $threadlist['multi'];?>
</div>
</div>
</form>
<style type="text/css">
.hover input, #chk_all {border: none;}
.fixsel input { vertical-align:middle; margin-right:10px;}
.div_content {background: none repeat scroll 0 0 #FEFEFE; border: 1px solid #639BB0; width:630px;}
.identity_title {border-bottom: 1px dashed #CCCCCC; padding: 5px 10px}
.identity_footer {border-top: 1px dashed #CCCCCC; padding: 2px 5px 5px 0; text-align: right; height:20px; padding-top:6px}
</style>
<div id="bq_add" class="div_content" style="position:absolute; z-index:999; padding:10px; line-height:1.8;display: none;">
<div class="identity_title">
<a href="javascript:void(0);" id="a_close" style="float:right"><img src="static/image/admincp/x.gif" width="16" height="16" border="0" /></a>
<b style="color: #F00" id="b_subject">请选择标签添加给：</b><span id="tip"></span>
<div style="clear:both;"></div>
</div>
<form id="frm_bq">
<input type="hidden" value="" name="tidd" id="tidd" />
<div id="bq_content" style="overflow: auto;height: 275px;"><?php if(is_array($pplist)) foreach($pplist as $values) { ?><div class="hover" style="display: block;float: left;" id="bq_rq">
<div id="dg_id" style="width: 300px;">
<input type="checkbox" value="<?php echo $values['id'];?>" name="chk_detail[]" flg="chk_detail_" id="chk_detail_<?php echo $values['id'];?>" /><label for="chk_detail[]"><?php echo $values['produce'];?></label></div>
</div>
<?php } ?>
</div>
</form>
<div class="identity_footer">
<a href="javascript:void(0);" id="a_enter">确定</a>
&nbsp;&nbsp;
<a href="javascript:void(0);" id="a_cancel" style="padding-right:5px">取消</a>
</div>
</div>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
//由于live可以绑定后来生成节点的该事件, 但是之前绑定的不会被清除, 会导致重复绑定, 重复发送请求. 在live之前先使用die清除之前的绑定.
function checkPass(x){
$('.shen_'+x).die('click').live("click",function(){
      var url=$(this).attr('href');
      var _this=$(this);
      $.ajax({
      type : 'GET',
      url : url,
      success:function(html){
      _this.css("display",'none');
      var urls = url.substr(0,url.length-1);
      var hre = url.substr(-1,5);
      if(hre==1){
   urls += +"0";
   $('#sta_'+x).html("<span style='color:green'>已审核</span>");
   _this.html("<a class='shen_"+x+"' onclick='return checkPass("+x+");' href="+urls+">不通过</a>").show();
      }else{
   urls += +"1";
   $('#sta_'+x).html("<span style='color:red'>未审核</span>");
   _this.html("<a class='shen_"+x+"' onclick='return checkPass("+x+");' href="+urls+">通过</a>").show();
      }
      }
      });
      return false;
});
return false;
}

function checkvaluebrand(m){
if(document.getElementById(m).value==""){
alert('请输入招商电话');
return false;
}else{
var dh = document.getElementById(m).value;
var id = jQuery("#"+m).next().next().val();
var str_url = 'plugin.php?id=dianping:ajax_updateproduce&op=zhaoshang&bid='+id;
jQuery.ajax({
url: str_url + '&dh='+dh,
type: "get",
success: function(msg){
if (msg=="success") {
jQuery("#tip"+id).html('');
jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('修改成功！');
}else if(msg=="error"){
jQuery("#tip"+id).html('');
jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('修改失败！');
}
jQuery('#submit_'+id).css("visibility","hidden");
}
});
}
}
function checkvalue(m){
if(document.getElementById(m).value==""){
alert('请输入排序号，数字越大排名越高');
return false;
}else{
var order = document.getElementById(m).value;
if(isNaN(order)){
alert("您填的不是一个数字");
return false;
}
var id = jQuery("#"+m).next().next().val();
var str_url = 'plugin.php?id=dianping:ajax_update&mod=<?php echo $nowmodule;?>&tid='+id;
jQuery.ajax({
url: str_url + '&type=px&order='+order,
type: "get",
success: function(msg){
if (msg=="success") {
jQuery("#tip"+id).html('');
jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('修改成功！');
}else if(msg=="error"||msg=="errors"){
jQuery("#tip"+id).html('');
jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('修改失败！');
}else if(msg=="cunzai"){
jQuery("#tip"+id).html('');
jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('产品名称已存在，修改失败！');
}
jQuery('#submit_'+id).css("visibility","hidden");
}
});
}
}

// 点击取消或关闭按钮时隐藏弹出层
jQuery('#a_close, #a_cancel').click(function () {
jQuery('#bq_add').hide();
});
jQuery('#a_close_zt, #a_cancel_zt').click(function () {
jQuery('#bq_zhuanti').hide();
});
//增加对重新生成地图的操作
<?php if($nowmodule=='line') { ?>
jQuery('.maphtml').click(function(){
var obs = this;
jQuery.ajax({
url: this.href,
type: 'get',
dataType: 'json',
success: function(json){
if(json.status == true){
obs.innerHTML = "<b style='color:green;'>成功</b>,点击查看";
obs.href = "<?php echo $_G['config']['web']['attach'];?>" + json.message;
obs.target = '_blank';
obs.className = '';
jQuery(obs).unbind('click');
}else{
switch(json.message){
case -1:
msg = "参数错误";break;
case -2:
msg = "轨迹文件不存在";break;
default:
msg = "未知错误";
}
obs.innerHTML = '<b style="color:red;">失败</b>' + msg;
}
}
});
return false;
});
var nowstart = 0;
function resetHtmlAll(){
var url = jQuery("#resetHtmlall").attr('url') + '&start=' + nowstart;
jQuery.ajax({
url: url,
type: 'get',
dataType: 'json',
success: function(json){
var msg = '';
if(json.success > 0){
msg = "成功生成<b style='color:green'>" + json.success + "</b>个 ";
}
if(json.errors > 0){
msg += "失败<b style='color:red'>" + json.errors + "</b>个 ";
}
if(json.shengyu > 0 && json.nextstart > 0){
msg += "剩余<b style='color:#E47A07'>" + json.shengyu + "</b>个 ";
nowstart = json.nextstart;
if(json.errors > 0){
msg += "点击继续";
jQuery("#resetHtmlall").one('click', resetHtmlAll);
}else{
msg += "5秒后将自动继续生成";
setTimeout(resetHtmlAll, 5000);
}
}else{
msg += " 全部生成完成，点击将重新生成";
jQuery('#resetHtmlall').one('click',resetAll);
}
jQuery("#resetHtmlall").html(msg);
}
});
}
function resetAll(){
nowstart = 0;
resetHtmlAll();
}
jQuery('#resetHtmlall').one('click', resetAll);
<?php } ?>
function edit_bq(tid){
jQuery(':checkbox[id^=chk_detail_]').removeAttr('checked').removeAttr('disabled');
var int_top = jQuery('#' + tid+'ty').offset().top;
if (jQuery(document).height() - jQuery('#' + tid+'ty').offset().top-jQuery('#' + tid+'ty').height() < jQuery("#bq_add").height() + 50) {
int_top = jQuery('#' + tid+'ty').offset().top - jQuery("#bq_add").height();
}
var int_left = jQuery('#' + tid+'ty').offset().left;
jQuery("#bq_add").css("left", int_left);
if(int_top < 0){
int_top = 0;
}
jQuery("#bq_add").css("top", int_top);
jQuery("#bq_add").show();
jQuery("#tidd").val(tid);
var td=jQuery('#' + tid+'ty').parents('td').find('a:first').text();
jQuery('#b_subject').text("");
jQuery('#tip').text("");
jQuery('#b_subject').text("请选择 ("+td+") 品牌下覆盖产品:");

var str_url = 'plugin.php?id=dianping:ajax_updateproduce&op=getids&tid='+tid;
jQuery.getJSON(
str_url,
function(data) {
jQuery.each(data, function (i,v) {
jQuery("#chk_detail_"+v).attr('checked', 'checked');
});
}
);
return false;
}
jQuery('#a_enter').click(function () {
var str_url = 'plugin.php?id=dianping:ajax_updateproduce';
var data = jQuery("#frm_bq").serialize();
var str_uid = jQuery.trim(jQuery('#tidd').val());
// 如果没有取到tid则不进行任何处理
if (!str_uid) {
return;
}
jQuery.ajax({
url: str_url + '&op=edit',
type: "get",
data: data,
success: function(msg){
if (msg=="success") {
jQuery("#tip").css("padding-left","10px").css("color","blue").html('修改成功！');
}else if(msg=="error"){
jQuery("#tip").css("padding-left","10px").css("color","blue").html('修改失败！');
}
jQuery('#bq_add').fadeOut('3000');
}
});
});
</script>



