<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style>
#cache_index {margin-top:10px;width:450px;height:550px;overflow:scroll;border:2px dotted #999;padding:5px;}
#cache_index ul li{margin-right:5px;margin-bottom:2px;border:1px dotted #CCC;padding:1px;2px;}
#option_list h3{text-align:center;margin-top:5px;}
#option_list{margin-tip:10px;border:1px #FF0 solid;padding:5px;width:150px;position:absolute;left:500px;top:55px;}
#tips{border:1px #FF0 solid;position:absolute;left:700px;top:55px;width:150px;height:220px;padding:5px;}
#tips b,#tips p{color:red;}
#tips div{margin:10px;}
#tips div input{margin-left:15px;}
#lastupdate{border:1px #FF0 solid;position:absolute;left:700px;top:320px;width:150px;height:230px;padding:5px;}
#lastupdate ul li{margin-top:5px; width:150px;overflow:hidden; white-space:nowrap;}
.titlelist{float:right;margin-right:20px;}
</style>
<script type="text/javascript">
var def_back = "white";
var def_color = "#555555";
function num_ref(){
		var num = 0;
	var checkbox = document.getElementsByName('update[]');
	var len = checkbox.length;
	for(mm=0;mm<len;mm++){
		if(checkbox.item(mm).checked==true){
			num++;
		}
	}
	document.getElementById('tip').innerHTML=num;
}
function changecolor(obj){
	if(obj.firstChild.firstChild.checked == true){
		obj.style.background="#CCC";
		obj.style.color="black";
	}else{
		obj.style.background=def_back;
		obj.style.color=def_color;
	}
	num_ref();
}
function all_check(n){
	var checkbox = document.getElementsByName('update[]');
	var len = checkbox.length;
	if(n==1){
	for(mm=0;mm<len;mm++){
		checkbox.item(mm).checked=true;
		checkbox.item(mm).parentNode.parentNode.style.background="#CCC";
		checkbox.item(mm).parentNode.parentNode.color="black";
	}
	document.getElementById('allselect').setAttribute("onClick","all_check(0)");
	document.getElementById('allselect').setAttribute("value","ȫ��ѡ");
	}else{
		for(mm=0;mm<len;mm++){
		checkbox.item(mm).checked=false;
		checkbox.item(mm).parentNode.parentNode.style.background=def_back;
		checkbox.item(mm).parentNode.parentNode.color=def_color;
		}
	document.getElementById('allselect').setAttribute("onClick","all_check(1)");
	document.getElementById('allselect').setAttribute("value","ȫѡ");
	}
	num_ref();
}
function checksub(){
	if(document.getElementById('tip').innerHTML>3 && document.getElementById('cache_all').checked==true && document.getElementById('sf_auto').checked==false){
		alert('��ѡ�������������ܻ��棬���Բ���ѡ��3�����ϵ�Ʒ�ƣ���ѡ������Ʒ��');
		return false;
	}
	var mod = document.getElementsByName('module[]');
	var mod_num=0;
	for(i=0;i<mod.length;i++){
		if(mod.item(i).checked==true){
			mod_num++;	
		}
	}
	if(mod_num==0){
		alert('������ѡ��һ��ģ��');
		return false;	
	}
	if(document.getElementById('tip').innerHTML!=0){
		if(document.getElementById('sf_auto').checked==true && document.getElementById('tip').innerHTML>3 && document.getElementById('cache_all').checked==true ){
		return confirm('ȷ��ͨ���Զ����ɹ�������ʱ���Զ����ɻ��棿');
		}else{
			return true;
		}
		
	}	
	alert("����ѡ��һ��");
	return false;
}
function select_allmod(n){
	var mod = document.getElementsByName('module[]');
	var button = document.getElementById('select_all_mod')
	if(n==1){
		for(i=0;i<mod.length;i++){
			mod.item(i).checked = true;
		}
		button.setAttribute("onClick","select_allmod(0)");
		button.setAttribute("value","ȫ��ѡ");
	}
	if(n==0){
		for(i=0;i<mod.length;i++){
			mod.item(i).checked = false;
		}
		button.setAttribute("onClick","select_allmod(1)");
		button.setAttribute("value","ȫѡ");
	}
}
</script>
</head>
<body>
<?php if(isset($_POST['sf_auto']) && $_POST['sf_auto']==1){ ?>
<!--<meta   http-equiv='refresh'content=5;URL='<?=$url?>'>
<div style='position:absolute;left:30%;top:30%'><h1>����ִ���Զ���ӹ��ܣ�ÿ15���Զ�ִ��һ�Σ�����ֹͣ<a href="<?=$auto_url?>">����˴�����</a></h1></div>-->
<?php }else{ ?>
<form action="" method="post">
<div id="cache_index">
	<ul>
	<?php if(count($all_produce)>0){ 
		for($i=0;$i<count($all_produce);$i++){
			$cache_time = get_updatetime_by_id($all_produce[$i]['tid'],'cache');
			$dl_time = get_updatetime_by_id($all_produce[$i]['tid'],'dl');
	?>
    	<li onClick="changecolor(this)"><span  title="id:<?=$all_produce[$i]['tid']?> | �ؼ���:<?=$all_keyword[$all_produce[$i]['tid']]?>"><input type="checkbox" name="update[]" value="<?=$all_produce[$i]['tid']?>"><?=$all_produce[$i]['subject']?></span><span class="titlelist"  <?=!empty($dl_time) ? "style='color:green;font-weight:bold'" : "style='color:red;font-weight:bold'" ?>  title="<?php if(!empty($dl_time)){ print_r($dl_time);}else{echo "���޸���";}?>">����</span><span class="titlelist" <?=!empty($cache_time) ? "style='color:green;font-weight:bold'" : "style='color:red;font-weight:bold'" ?> title="<?php if(!empty($cache_time)){ print_r($cache_time);}else{echo "���޸���";}?>">�ܻ���</span>
        </li>
    <?php }
		}
	 ?>
    </ul>
</div>
<div id="option_list">
<h3>ѡ������»����ģ��</h3>
<p><input type="checkbox" name="module[]" value="articles">����(articles)</p>
<p><input type="checkbox" name="module[]" value="zb">װ��(zb)</p>
<p><input type="checkbox" name="module[]" value="dzty">��������(dzty)</p>
<p><input type="checkbox" name="module[]" value="topics">ר��(topics)</p>
<p><input type="checkbox" name="module[]" value="blogs">����(blogs)</p>
<p><input type="checkbox" name="module[]" value="photos">���(photos)</p>
<br/>
<p style="padding-left:15px;"><input type="button" name="select_all_mod" id="select_all_mod" onClick="select_allmod(1)" value="ȫѡ"><span id="sf_auto_span"  style="margin-left:10px;"><input type="checkbox" name="sf_auto" value="1" id="sf_auto" checked>�Զ�����</span></p>
<hr>
<h3>ѡ���Ƿ���¶���</h3>
<p><input type="radio" name="ifdl" value="1" checked>��<input type="radio" name="ifdl" value="0">��</p>
<hr>
<h3 title="�����ʾ�Ƿ���»���ѡ�Ĭ�ϲ�����" style="cursor:pointer;" onClick="document.getElementById('option_cache').style.display='block'">�� �����ܻ��� ��</h3>
<div id="option_cache" style="display:none"  title="�����ʾ�Ƿ���»���ѡ�Ĭ�ϲ�����" onClick="document.getElementById('option_cache').style.visibility='visible'"><p style="color:red">ע�⣺�����LIKE�ܱ������,����ѡ��Ʒ��</p>
<p><input type="radio" name="ifhc" value="1" id="cache_all">��<input type="radio" name="ifhc" value="0" checked>��</p></div>
</div>
<div id="tips">
<div>��ǰΪ��Ʒģ�飬<a href="<?=$url."&reselect=1"?>" >����</a></div>
<div>��ǰ����<b><?=count($all_produce)?></b>��Ʒ��</div>
<div>��ǰ��ѡ��<b id="tip">0</b>��Ʒ��</div>
<div><input type="submit" value="�ύ" name="submit" onClick="return checksub();"/>
	 <input type="button" value="ȫѡ" name="allselect" id="allselect" onClick="all_check(1)"/>
</div>
<div><p><b>ע�⣺</b></p>
<p>��һ��ʹ����ѡ������ܻ��棡</p>
</div>
</div>
<?php if(!empty($last_update)){ ?>
<div id="lastupdate">
<p><b>���µ�ʮ���и��µ�Ʒ��</b></p>
<hr color="#999999">
<ul>
<?php for($j=0;$j<$last_update_10;$j++){ ?>
	<li><b style="margin-right:8px;"><?=($j+1)?></b><span><?=$last_update[$j]['subject']?></span></li>	
<?php } ?>
</ul></div>
<?php } ?>
</form>
<?php } ?>
</body>
</html>
