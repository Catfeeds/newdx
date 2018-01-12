<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$fid = $_GET['fid'];
$localforum_id=$_GET['fup']?$_GET['fup']:'76';
require_once libfile('class/myredis');
$myredis = & myredis::instance(6378);
if($_GET['m_del']){
	DB::query("DELETE FROM ".DB::TABLE('plugin_master_manager')." WHERE f_id = $fid and typeid = ".$_GET['m_del']['type']." and b_name = '".$_GET['m_del']['name']."'");
	$myredis->obj->expire('plugin_master_manager_all',0);
	$message_tips = "删除完成";
}
if ($_GET['m_edit']) {
//	print_r($_GET['m_edit']);
	DB::query("UPDATE ".DB::TABLE('plugin_master_manager')." SET ifdisplay = ".$_GET['m_edit']['value'].",addtime=".time()." WHERE f_id = $fid and typeid = ".$_GET['m_edit']['type']." AND b_name = '".$_GET['m_edit']['name']."'");
	$myredis->obj->expire('plugin_master_manager_all',0);
	$message_tips = "修改完成";
}
if (!empty($_POST)) {
	//DB::query("DELETE FROM ".DB::table('plugin_forumoption_town_recommends')." WHERE fid = $fid");
	//print_r($_POST);
	//submit=1表示为左侧增加版主操作
	$state = array();
	if ($_POST['submit']==1) {
		foreach ($_POST['mastergp'] as $master){
			$cot = DB::fetch_first("SELECT count(*) NUM,ifdisplay FROM ".DB::TABLE('plugin_master_manager')." WHERE f_id = $fid and typeid = ".$_POST['forum_id']." AND b_name = '$master'");
			echo "<br/>";
			if ($cot['NUM']==1) {
				if ($cot['ifdisplay']!=$_POST['ifdisplay']) {
					DB::query("UPDATE ".DB::TABLE('plugin_master_manager')." SET ifdisplay = ".$_POST['ifdisplay'].",addtime=".time()." WHERE f_id = $fid and typeid = ".$_POST['forum_id']." AND b_name = '$master'");
				}
			}else{
				DB::query("INSERT INTO ".DB::TABLE('plugin_master_manager')."(b_name,f_id,typeid,ifdisplay,displayorder,addtime,fup) VALUES('$master',$fid,".$_POST['forum_id'].",".$_POST['ifdisplay'].",0,".time().",$localforum_id)");
			}
		}
		$myredis->obj->expire('plugin_master_manager_all',0);
		$message_tips = "添加/修改完成";
	}
//	cpmsg('修改设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_town', 'succeed');
}
$threads = $partname = $parts = $infolist = array();
$forum = DB::fetch_first("SELECT * FROM ".DB::table('forum_forum')." WHERE fid = $fid");
$query = DB::query("SELECT typeid,name FROM ".DB::TABLE('forum_threadclass')." WHERE fid = $fid and displayorder >=0");
while ($values = DB::fetch($query)) {
	$partname[$values['typeid']] = $values['name'];
	$parts[] = $values;
}
//print_r($partname);
$query = DB::fetch_first("SELECT moderators from ".DB::TABLE('forum_forumfield')." where fid = $fid");
$mastersgroup = explode("	",$query['moderators']);
//print_r($mastersgroup);
$query = DB::query("SELECT * FROM ".DB::TABLE('plugin_master_manager')." WHERE f_id = $fid ORDER BY b_name");
while ($values = DB::fetch($query)) {
	$infolist[] = $values;
}
$query = DB::query("SELECT fid,name FROM ".DB::table('forum_forum')." WHERE fup = $localforum_id");
while ($allf = DB::fetch($query)) {
	$allforum[] = $allf;
}
//print_r($allforum);
//函数，设定15秒内更新的数据将加亮显示
function checkstate($time){
	$t = time() - $time;
	if ($t <= 15) {
		return true;
	}
	return false;
}
?>
<style type="text/css">
.left{float:left;}
.box{height:150px;}
ul,li{text-decoration:none;}
.titlebox{text-align:center;}
.selectbox{width:150px;height:150px;}
.contr{clear:both;height:30px;margin:15px 0px;}
.contr p input{margin:10px 10px 5px 10px;}
.left table{margin-left:40px;border:1px #BBB dotted;text-align:center;}
.left table td{border-top:1px #BBB dotted;border-left:1px #BBB dotted;}
</style>
<body>
<div class="left" style="position:absolute;left:50px;top:50px;min-width:300px">
<form action="" method="post" id="town_edit_form_add">
<input type="hidden" name="submit" value="1" />
<div class="contr">
<p class="titlebox">当前<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=forumoption&pmod=admincp_town&op=editmaster&fid=<?php echo $forum['fid']; ?>&fup=<?php echo $localforum_id; ?>">编辑</a>
地区【&nbsp;
<select>
	<?php foreach($allforum as $rows){ ?>
		<option title="点击进入【<?=$rows['name']?>】编辑版主" onClick="location.href='<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=forumoption&pmod=admincp_town&op=editmaster&fid=<?=$rows['fid']?>&fup=<?php echo $localforum_id; ?>'" <?=($forum['fid']==$rows['fid']) ? "selected style='background:#CCC;'" : "";?> value="<?=$rows['fid']?>"><?=$rows['name']?></option>
	<?php } ?>
</select>
&nbsp;】
</p>
</div>
<div class="left box" style="width:150px;height:150px;">
<?php	if (count($parts)==0) { ?>
	<!-- <p class="titlebox">当前编辑地区【<a href="http://bbs.8264.com/forum-<?php echo $forum['fid']; ?>-1.html" target="_blank" title="<?php echo $forum['name']; ?>"><?=$forum['name']?></a>】版块没有地区</p>-->
<?php
	$message_tips="当前编辑地区【<a href='{$_G['config']['web']['forum']}forum-".$forum['fid']."-1.html' target='_blank' title='点击进入".$forum['name']."分区'>".$forum['name']."</a>】版块没有地区,<a href='".ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=forumoption&pmod=admincp_town'>点击此处返回</a>";
	}else{
?>
	<select name="forum_id"  size="10" id="forum_id" class="selectbox">
<?php
		foreach($parts as $part) {
?>
		<option onClick="listchange(this.value,this.title)" title="<?=$part['name']?>" value="<?=$part['typeid']?>"><?=$part['name']?></option>
<?php
		}
?>
	</select>
<?php
		}
?>
</div>
<div class="left box" style="margin-left:30px;width:90px;height:150px;">
<?php	if (count($mastersgroup)==0) { ?>
	$message_tips="当前编辑地区【<a href='<?php echo $_G['config']['web']['forum']; ?>forum-".$forum['fid']."-1.html' target='_blank' title='点击进入".$forum['name']."分区'>".$forum['name']."</a>】版块没有版主,<a href='".ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=forumoption&pmod=admincp_town'>点击此处返回</a>";
<?php
		}else{
?>
	<div style="border:1px dotted #bbb">
		当前可选版主：<br/>
<?php
		for ($i = 0; $i < count($mastersgroup); $i++) {
?>
		<label for="master_<?=$i; ?>" title="点击选择此版主--[<?=$mastersgroup[$i]?>]">
				<input type="checkbox" name="mastergp[]" id="master_<?=$i;?>" value="<?=$mastersgroup[$i]; ?>" />
				<?=$mastersgroup[$i]; ?>
			</label><br/>
<?php
		}
?>
	<div style="margin:20px 5px;">
	<input name="ifdisplay" type="radio" value="1" checked/>主版权限<br/>
	<input name="ifdisplay" type="radio" value="0" />分区权限
	</div>
	</div>
<?php
		}
?>
</div>
<div class="contr"><p>
<?php if (count($mastersgroup)!=0 && count($parts)!=0){ ?>
<input type="submit" value="提交" title="按 Enter 键可随时提交你的修改" name="addsubmit" id="submit_addsubmit" class="btn" onClick="return checkbd();"/>
<?php } ?>
<input type="button" class="btn" value="返回" onClick="location.href='<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=forumoption&pmod=admincp_town'"/></p></div>
</form>
<p style="background:#FFC;text-align:center;position:absolute;top:340px;border:1px #FC0 solid;color:red;<?= $message_tips ? "display:block;" : "display:none;"?>" id="tips"><?=$message_tips ? $message_tips : ""?></p>
</div>
<form action="" method="post" id="town_edit_form_update">
<input type="hidden" name="submit" value="2" />
<div class="left" style="position:absolute;left:350px;top:50px;" id="listmessage">
<div class="contr">
<p class="titlebox">当前编辑地区【<a href="<?php echo $_G['config']['web']['forum']; ?>forum-<?php echo $forum['fid']; ?>-1.html" target="_blank" title="点击进入【<?php echo $forum['name']; ?>】版块"><?=$forum['name']?></a><span id="select_partname"></span>】版块现有版主设置</p>
</div>
<?php showtableheader(); ?>
<tr><td style="width:80px"><b>版主</b></td><td style="width:60px"><b>所属地区</b></td><td style="width:80px"><b>主版块状态</b></td><td style="width:160px"><b>加入时间</b></td>
<!-- <td><b>排序</b></td> -->
<td style="width:40px"><b>操作</b></td></tr>
<?php
	if (count($infolist) == 0) {
?>
<tr><td colspan="5">当前地方版块没有版主设置，请从右边选择设置</td></tr>
<?php
	}else{
	foreach($infolist as $m_list){ ?>
	<tr <?=checkstate($m_list['addtime'])? "style='background:#ddd;'":""?> name="list_tb[<?=$m_list['typeid']?>]">
		<td><?=$m_list['b_name']?></td><td><?=$partname[$m_list['typeid']]?></td>
		<td><?=($m_list['ifdisplay']==1) ? "<a href='".ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=forumoption&pmod=admincp_town&op=editmaster&fid=".$fid."&m_edit[name]=".$m_list['b_name']."&fup=$localforum_id&m_edit[type]=".$m_list['typeid']."&m_edit[value]=0' style='color:green;'>显示</a>" : "<a href='".ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=forumoption&pmod=admincp_town&op=editmaster&fid=".$fid."&m_edit[name]=".$m_list['b_name']."&fup=$localforum_id&m_edit[type]=".$m_list['typeid']."&m_edit[value]=1' style='color:red;'>隐藏</a>";?></td>
		<td><?=date("Y-m-d h:m:s",$m_list['addtime'])?></td>
		<!-- <td><input type="text" size="3" maxlength="3" name="displayorder_<?=$m_list['b_id']?>" value="<?=$m_list['displayorder']?>"/></td>-->
		<td><a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=forumoption&pmod=admincp_town&op=editmaster&fid=<?php echo $forum['fid']; ?>&fup=<?php echo $localforum_id; ?>&m_del[name]=<?=$m_list['b_name']?>&m_del[type]=<?=$m_list['typeid']?>" onClick="return confirm('确定将此记录删除?')">删除</a></td>
	</tr>
<?php }
	}
?>
<?php showtablefooter(); ?>
</div>
<!-- <input type="submit" value="提交" title="按 Enter 键可随时提交你的修改" name="editsubmit" id="submit_editsubmit" class="btn"/>-->
</form>
<span style="color:#F60;position:absolute;left:100px;top:430px;cursor:pointer;" onClick="hiddenall('table-row')">不见了？点击查看全部信息</span>
<span style="position:absolute;right:10px;bottom:60px;">当前版本:ver 1.2</span>
</body>
<script type="text/javascript">
function checkbd(){
	if(document.getElementById('forum_id').value==""){
		tips('请选择地区');
		return false;
	}
	var i=j=0;
	var mastergp = document.getElementsByName('mastergp[]');
	while(i < mastergp.length){
		if(mastergp.item(i).checked){
			j++;
		}
		i++;
	}
	if(j==0){
		tips('请至少选择一个版主');
		return false;
		}
	return true;
}
function tips(str){
	document.getElementById('tips').innerHTML = str;
	document.getElementById('tips').style.display = "block";
	}
function hiddenall(statue){
	var all_tr = document.getElementById('listmessage').getElementsByTagName('tr');
	for(i=1;i<all_tr.length;i++){
		all_tr.item(i).style.display = statue;
		}
	}
function listchange(partid,partname){
	var name = "list_tb["+partid+"]";
	document.getElementById('select_partname').innerHTML="-"+partname;
	hiddenall("none");
	var select_part = document.getElementsByName(name);
		if(select_part.length==0){
		tips('当前选择的地区【'+partname+'】是没有版主设置的，请添加');
		return;
		}else{
			document.getElementById('tips').style.display = "none";
			}
	for(i=0;i<select_part.length;i++){
		select_part.item(i).style.display = "table-row";
		}
}
</script>
