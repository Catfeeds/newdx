<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<script type="text/javascript">
var default_tips = Array("�������ѯ������","��������ӵ�����","�������̻�����");
function input_tip(n,m){

	if(n.value==""){
		n.value=default_tips[m];
	}
}
function checkvalue(n,m){
		if(document.getElementById(m).value!=default_tips[n]){
			if(n==1){
				if(document.getElementById('add_other').value==default_tips[2]){
					alert('�������̻�����');
					return false;	
				}
			}
			return true;
		}
	alert('����������');
	return false;
}
</script>
<style>
#container_box{width:920px;margin:20px;}
.float{float:left;}
.clear{clear:both;}
.box{margin-bottom:10px;}
.cent{text-align:center}
input{margin:5px 10px;}
#container_box ul li{text-decoration:none;}
li,.vip_id,.vip_name,.vip_state,.vip_time{height:20px;}
.vip_id,.vip_name,.vip_state,.vip_time{padding:0 5px;}
.vip_name,.vip_state,.vip_time,.vip_cz,.vip_other,.vip_group{border-left:1px dotted #CCC;}
.vip_id{width:80px;}
.vip_name{width:120px;}
.vip_state{width:90px;}
.vip_time{width:180px;}
.vip_cz{width:40px;}
.vip_group{width:170px;}
.vip_other{width:180px;}
.vip_group input,.vip_group select,.vip_other input,.vip_other select{margin:0px;padding:0px}
#type_sort{margin-left:10px;}
a,a:hover{text-decoration:none;}
a:hover{color:#E74E45}
#container_box li{margin:5px 0; border-bottom:1px dashed #666}
#pagebox{height:18px;margin:1px auto;width:400px;}
#pagebox span{margin:10px;}
#tips{position:absolute;top:98px;left:270px;width:300px;text-align:center;border:#FC0 1px solid;background:#FCF798;color:#F00}
#tips b{margin:auto 3px;}
</style>
</head>
<body>
	<div id="container_box">
    	<form id="form_vip" action="" method="post">
    	<div class="box float clear" style="width:910px;height:30px;border:1px dotted #CCC;padding-left:10px;">
        ѡ���ѯ��ʽ��
        <input type="radio" name="search_type" value="uid" <?=$_POST['search_type']!='username' ? "checked" : ""?> />�˺�I&nbsp;D
        <input type="radio" name="search_type" value="username" <?=$_POST['search_type']=='username' ? "checked" : ""?>/>�˺�����
        <input type="text"id="search_word" name="search_word" value="�������ѯ������" onfocus=this.select() onMouseOver="this.select()" onChange="input_tip(this,0)" />
        <input type="submit" name="submit" value="��ѯ" onClick="return checkvalue(0,'search_word')" />
        |&nbsp;&nbsp;<a href="<?=ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=homefriend&pmod=friend_vip"?>">�鿴ȫ��</a>
        &nbsp;&nbsp;|&nbsp;&nbsp;<?php if($returntext){?><span style="height:28px;color:red;border:#FC0 1px solid;background:#FF6;color:#F00:"><?=$returntext?></span><?php } ?>
        </div></form>
        <div class="float clear" id="tips">��<b><?=$maxdata?></b>����Ϣ����ǰ��<b><?=$nowpage?></b>ҳ,��<b><?=$maxpage?></b>ҳ</div>
  		<div class="box float clear" style="width:920px;border:1px dotted #CCC;margin-top:10px;">
        	<div class="box float clear" style="width:920px;"><ul>
            <li>
            	<div class="vip_id float cent">
                	<a href="<?=tosort("uid",changestate(asc_desc_to_num($order_sort)))?>">�˺�I&nbsp;D</a>
					<?=($order_type=='uid')? "<span id='type_sort'>".sort_text(asc_desc_to_num($order_sort))."</span>" : ""?>
                </div>
            	<div class="vip_name float cent">
                	<a href="<?=tosort("username",changestate(asc_desc_to_num($order_sort)))?>">�˺�����</a>
					<?=($order_type=='username')? "<span id='type_sort'>".sort_text(asc_desc_to_num($order_sort))."</span>" : ""?>
                </div>
            	<div class="vip_state float cent">
                	<a href="<?=tosort("friendsetting",changestate(asc_desc_to_num($order_sort)))?>">��ǰ״̬</a>
					<?=($order_type=='friendsetting')? "<span id='type_sort'>".sort_text(asc_desc_to_num($order_sort))."</span>" : ""?>
                </div>
            	<div class="vip_time float cent">
                	<a href="<?=tosort("dateline",changestate(asc_desc_to_num($order_sort)))?>">����޸�ʱ��</a>
					<?=$order_type=='dateline' ? "<span id='type_sort'>".sort_text(asc_desc_to_num($order_sort))."</span>" : ""?>
                </div>
                <div class="vip_group float cent">
                	<a href="<?=tosort("gid",changestate(asc_desc_to_num($order_sort)))?>">Ĭ�Ϸ���</a>
					<?=$order_type=='gid' ? "<span id='type_sort'>".sort_text(asc_desc_to_num($order_sort))."</span>" : ""?>
                </div>
                <div class="vip_other float cent">
                	<a href="<?=tosort("other",changestate(asc_desc_to_num($order_sort)))?>">��ҵ�û�����</a>
					<?=$order_type=='other' ? "<span id='type_sort'>".sort_text(asc_desc_to_num($order_sort))."</span>" : ""?>
                </div>
                <div class="vip_cz float cent">
                	����
                </div>
            </li>
            <?php
			if(count($info)>0){
			for($i=0;$i<count($info);$i++){
			?>
            <li <?=checkstate($info[$i]['dateline']) ? "style='background:#FF9'" : ""?>>
            	<div class="vip_id float cent"><?=$info[$i]['uid']?></div>
                <div class="vip_name float cent"><?=$info[$i]['username']?></div>
                <div class="vip_state float cent"><a href="<?=$u_url."&updateid=".$info[$i]['uid']."&updatestate=".changestate($info[$i]['friendsetting'])?>"><?=totext($info[$i]['friendsetting'])?></a></div>
                <div class="vip_time float cent"><?=date("Y-m-d h:m:s",$info[$i]['dateline'])?><?=checkstate($info[$i]['dateline']) ? "<span style='color:red'>--  New</span>" : ""?></div>
                <div class="vip_group float">
                <form id="group_<?=$info[$i]['uid']?>" method="post" action="<?=$u_url?>">
                <select name="type_group" id="type_group"  onChange="document.getElementById('submt_<?=$info[$i]['uid']?>').style.visibility='visible'">
                <?php for($j=0;$j<8;$j++){ ?>
                	<option value="<?=$j?>" <?=($j==$info[$i]['gid']) ? "selected='selected'" : ""?>>
                    	<?=getgroupname($j)?>
                    </option>
                <?php } ?>
                </select>
                <input type="hidden" value="<?=$info[$i]['uid']?>" name="group_uid"/>
                <input type="submit" id="submt_<?=$info[$i]['uid']?>" name="sub_<?=$info[$i]['uid']?>" value="�޸�" style="visibility:hidden"/>
                </form>
                </div>
                <div class="vip_other float">
                <form id="other_<?=$info[$i]['uid']?>" method="post" action="<?=$u_url?>">
                <input id="otherinput_<?=$info[$i]['uid']?>" type="text" name="other" value="<?=$info[$i]['other']==""?"�������̻�����":$info[$i]['other']?>" onfocus=this.select() maxlength="20" onMouseOver="this.select()" onKeyDown="document.getElementById('subbmt_<?=$info[$i]['uid']?>').style.visibility='visible'" onKeyPress="document.getElementById('subbmt_<?=$info[$i]['uid']?>').style.visibility='visible'" onChange="document.getElementById('subbmt_<?=$info[$i]['uid']?>').style.visibility='visible'"/>
                <input type="hidden" value="<?=$info[$i]['uid']?>" name="other_uid"/>
                <input type="submit" id="subbmt_<?=$info[$i]['uid']?>" name="sub_<?=$info[$i]['uid']?>" value="�޸�" style="visibility:hidden" onClick="return checkvalue(2,'otherinput_<?=$info[$i]['uid']?>')"/>
                </form>
                </div>
                <div class="vip_cz float cent"><a href="<?=$u_url."&delid=".$info[$i]['uid']?>" onclick="return confirm('ȷ�����˼�¼ɾ��?')">ɾ��</a></div></li>
            <?php
			}
			}else{
			?>
            <li>��ǰ�����κμ�¼������������</li>
            <?php	
			}
			?>	
            </ul></div>
            <div class="clear float cent" style="margin:10px 100px 10px 100px;width:600px;height:20px;border-top:1px dotted #CCC;border-bottom:1px dotted #CCC;">		
            <?php		if($maxpage>1){	
			?>
			<div id="pagebox">
            	<?php if($maxpage>2){ ?><span><a href="<?=$u_url?>&nowpage=1">��ҳ</a></span><?php } ?>
                <?php if($nowpage>1){ ?><span><a href="<?=$u_url?>&nowpage=<?=($nowpage-1)?>">��һҳ</a></span><?php } ?>
                <?php if($nowpage<$maxpage){ ?><span><a href="<?=$u_url?>&nowpage=<?=($nowpage+1)?>">��һҳ</a></span><?php } ?>
                <?php if($maxpage>2){ ?><span><a href="<?=$u_url?>&nowpage=<?=$maxpage?>">���ҳ</a></span><?php } ?>
            </div>
            <?php
			}
			?>
            </div>
            <div class="clear float" style="width:800px;height:160px;padding:10px;">
            	<div class="float" style="width:350px;height:100px">
                <form id="form_add" action="" method="post">
                	��ѡ����ӷ�ʽ��&nbsp;&nbsp;&nbsp;&nbsp;
                	<input type="radio" name="add_type" value="uid" <?=$_POST['add_type']!='username' ? "checked" : ""?> />�˺�I&nbsp;D
       				<input type="radio" name="add_type" value="username" <?=$_POST['add_type']=='username' ? "checked" : ""?>/>�˺�����
                    <br/>
                    ��������ӵ����ݣ�
                    <input type="text" name="add_value" id="add_value" onfocus=this.select() onMouseOver="this.select()"  onChange="input_tip(this,1)" value="��������ӵ�����"/>
                    <br/>
                    ѡ���趨��ʽ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="add_setting" value="1" <?=$_POST['add_setting']==1 ? "checked" : ""?>/><span style="color:green">����</span>
                    <input type="radio" name="add_setting" value="0" <?=$_POST['add_setting']!=1 ? "checked" : ""?> /><span style="color:red">�ر�</span>
                    <br/>
                    ѡ��Ĭ�Ϸ��飺&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="group_add">
                    <?php for($m=0;$m<8;$m++){ ?>
                    	<option value="<?=$m?>" <?=$default_group==$m ? "selected='selected'" : ""?>><?=getgroupname($m)?></option>
                    <?php } ?>
                    </select> 
                    <br/>
                    �����̻����ƣ�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" id="add_other" name="add_other" maxlength="20"  onfocus=this.select() onMouseOver="this.select()"  value="�������̻�����"/>
                    <br/>
                    <input type="submit" name="sub_add" value="���" onClick="return checkvalue(1,'add_value')"/>
                </form>
                </div>
            </div>
        </div>	  
    </div>
</body>