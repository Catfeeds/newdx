<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style>
.left{float:left;}
fieldset{width:250px;min-height:150px;padding:10px;}
.m{margin:5px 7px;}
#cbody{position: absolute;left:20px;top:50px;}
#cbody input{margin-left:10px;}
</style>
<script type="text/javascript">
var def_str = "����������";
function check(){
	var name = document.getElementById('name');
	var type = document.getElementById('type');
	if(name.value==def_str || name.value==""){
		alert("��������������");
		return false;
	}
	if(type.value==def_str || type.value==""){
		alert("������Ӣ������");
		return false;
	}
	return true;
}
</script>
</head>
<body>
<div id="cbody">
<div class="left"><fieldset>
<legend>����ģ��</legend>
<ul>
<?php if(count($tablename_arr)!=0){
		for($i=0;$i<count($tablename_arr);$i++){	
?> 
<li class="left m"><a href="<?=$url."&cache_mod=".$tablename_arr[$i]['table_name']?>"><?=$tablename_arr[$i]['name']."(".$tablename_arr[$i]['type'].")"?></a><a href="<?=$url."&delmod=".$tablename_arr[$i]['type']?>"><b style="color:red;" onClick="return confirm('ȷ�����˼�¼ɾ��?')">X</b></a></li>
<?php 
		}
}else{ ?>
<li>��ǰû��ģ�������</li>
<?php } ?>
</ul></fieldset></div>
<div class="left" style="margin-left:20px;"><form action="" method="post"><fieldset><legend>���ģ��</legend>
<p>��������<input id="name" type="text" name="name" value="����������" onFocus="this.select()" onMouseOver="this.select()"/></p>
<br/>
<p>Ӣ������<input id="type" type="text" name="type" value="����������" onFocus="this.select()" onMouseOver="this.select()"/></p>
<br/>
<p><input type="submit" name="submit" value="���" onClick="return check()"/>
	<input type="hidden" name="method" value="add"/></p>
<?=($tips)? "<p style='color:red'>".$tips."</p>" : ""?>
</fieldset></form></div>
</div>
</body>
</html>