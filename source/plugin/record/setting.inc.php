<?php
	if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
		exit('Access Denied');
	}

	if(isset($_GET['mark'])){
		if($_GET['mark']=='0'){
			DB::query("UPDATE ".DB::table('plugin_record_mark')." SET `mark`='0' WHERE id=1");
		}else{
			DB::query("UPDATE ".DB::table('plugin_record_mark')." SET `mark`='1' WHERE id=1");
		}
	}

	if($_POST['add']){
		$tablecount=DB::result_first("SELECT tablecount FROM ".DB::table('plugin_record_mark')." WHERE id=1");
		$tablenum=DB::result_first("SELECT count(*) from ".DB::table('plugin_record_setting'));
		if($tablenum<$tablecount){
			if($_POST['tablename']){
				$result=DB::query('SELECT tablename FROM '.DB::table('plugin_record_setting'));
				while($row=DB::fetch($result)){
					$table[]=$row['tablename'];
				}
				if(!in_array($_POST['tablename'],$table)){
					$time=time();
					DB::query("INSERT INTO ".DB::table('plugin_record_setting')."(`tablename`,`time`,`insert`,`delete`,`update`,`select`,`replace`) VALUES('{$_POST['tablename']}','{$time}','{$_POST['insert']}','{$_POST['delete']}','{$_POST['update']}','{$_POST['select']}','{$_POST['replace']}')");
				}else{
					echo "<script>alert('�����Ѵ��ڣ���')</script>";
				}
			}else{
				echo "<script>alert('�������������')</script>";
			}
			record_setting_in_memcache();
		}else{
			echo "<script>alert('ͳ�Ƶı����Ѿ��ﵽ������ã���')</script>";
		}
	}

	if($_POST['edit']){
		$time=time();
		DB::query("UPDATE ".DB::table('plugin_record_setting')." SET `time`={$time},`insert`={$_POST['insert']},`delete`={$_POST['delete']},`update`={$_POST['update']},`select`={$_POST['select']},`replace`={$_POST['replace']} 	WHERE id={$_GET['tableid']}");
		record_setting_in_memcache();
	}

	if($_POST['count']){
		if($_POST['rediscount']){
			DB::query("UPDATE ".DB::table('plugin_record_mark')." SET `rediscount`='{$_POST['rediscount']}' WHERE id=1");
			memory('set','rediscount',$rediscount,0);
		}
		if($_POST['tablecount']){
			DB::query("UPDATE ".DB::table('plugin_record_mark')." SET `tablecount`='{$_POST['tablecount']}' WHERE id=1");
		}
	}

	$_GET['a']=empty($_GET['a'])?'list':$_GET['a'];
	if($_GET['a']=='del'){
		DB::query("DELETE FROM ".DB::table('plugin_record_setting')." WHERE id='{$_GET['tableid']}'");
		record_setting_in_memcache();
	}elseif($_GET['a']=='update'){
		record_setting_in_memcache();
		memory('set','rediscount',$rediscount,0);
	}

	$rediscount=DB::result_first("SELECT rediscount FROM ".DB::table('plugin_record_mark')." WHERE id=1");
	memory('set','rediscount',$rediscount,0);

	// $open_mark=DB::result_first("SELECT mark FROM ".DB::table('plugin_record_mark')." WHERE id=1");
	// memory('set','record_mark',$open_mark,0);

	$tablecount=DB::result_first("SELECT tablecount FROM ".DB::table('plugin_record_mark')." WHERE id=1");

?>
<hr/>
<a href=<?php echo ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=setting";?>>�б�</a> |
<a href=<?php echo ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=setting&a=add";?>>���</a> |
<a href=<?php echo 'plugin.php?id=record:enterdatabase';?>>�������</a> |
<a href=<?php echo ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=setting&a=update";?>>����</a> |
���״̬:<?php  echo $_G['cache']['plugin']['record']['config_open_or_close']?'������':'�ر���';echo '&nbsp;&nbsp;&nbsp;'; ?>
�ı�����<a href=<?php echo ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid"?>>����</a><br/>
memcache������:
<?php
	$mem = unserialize(memory('get','mem_record_setting'));
	print_r($mem);
?>
<br/>
<form action='' method='post'>
<input type='hidden' name='count' value='1'>
redis����¼����:<input type='text' name='rediscount' value='<?php echo $rediscount; ?>' size='10' />(Ŀǰ�Ѵ�:<?php require_once libfile('class/myredis');$redis = & myredis::instance();echo $redis->obj->lsize('redis_record'); ?>)
�������ͳ�Ʊ���:<input type='text' name='tablecount' value='<?php echo $tablecount; ?>' size='4' />
<input type='submit' value='�ύ����' />
</form>

<?php

	if($_GET['a']=='add'){
		$str='';
		$str.="<div><br/><table width='600'><form action='' method='post'>";
		$str.="<tr align='center'>";
		$str.="<input type='hidden' name='add' value='1' />";
		$str.="<td>������Ҫ��ӵı���</td><td><input type='text' name='tablename' size='50'/></td>";
		$str.="</tr>";
		$str.="<tr align='center'>";
		$str.="<td>SELECT: <input type='radio' name='select' checked='checked' value='1'/>�� <input type='radio' name='select' value='0'/>��</td>";
		$str.="<td>INSERT: <input type='radio' name='insert' checked='checked' value='1'/>�� <input type='radio' name='insert' value='0'/>��</td>";
		$str.="</tr>";
		$str.="<tr align='center'>";
		$str.="<td>UPDATE: <input type='radio' name='update' checked='checked' value='1'/>�� <input type='radio' name='update' value='0'/>��</td>";
		$str.="<td>DELETE: <input type='radio' name='delete' checked='checked' value='1'/>�� <input type='radio' name='delete' value='0'/>��</td>";
		$str.="</tr>";
		$str.="<tr align='center'>";
		$str.="<td>REPLACE:<input type='radio' name='replace' checked='checked' value='1'/>�� <input type='radio' name='replace' value='0'/>��</td>";
		$str.="<td><input type='submit' value='���'>&nbsp;&nbsp;&nbsp;<input type='reset' value='����'></td>";
		$str.="</tr></form></table></div>";
		echo $str;
	}elseif($_GET['a']=='edit'){
		$result=DB::query('SELECT * FROM '.DB::table('plugin_record_setting')." WHERE id={$_GET['tableid']}");
		$row=DB::fetch($result);
		$select=$row['select']?"checked='checked'":'';
		$reselect=!$row['select']?"checked='checked'":'';

		$insert=$row['insert']?"checked='checked'":'';
		$reinsert=!$row['insert']?"checked='checked'":'';

		$update=$row['update']?"checked='checked'":'';
		$reupdate=!$row['update']?"checked='checked'":'';

		$delete=$row['delete']?"checked='checked'":'';
		$redelete=!$row['delete']?"checked='checked'":'';

		$replace=$row['replace']?"checked='checked'":'';
		$rereplace=!$row['replace']?"checked='checked'":'';

		$str='';
		$str.="<div><table width='600' border='1'>";
		$str.="<form action='' method='post'>";
		$str.="<tr align='center'>";
		$str.="<input type='hidden' name='edit' value='1' />";
		$str.="<td width='300'>����</td><td width='300'>{$row[tablename]}</td>";
		$str.="</tr>";
		$str.="<tr align='center'>";
		$str.="<td>INSERT: <input type='radio' name='insert' {$insert} value='1'  />�� ";
		$str.="<input type='radio' name='insert' {$reinsert} value='0'  />��";
		$str.="</td>";
		$str.="<td>DELETE: <input type='radio' name='delete' {$delete} value='1'  />�� ";
		$str.="<input type='radio' name='delete' {$redelete} value='0'  />��";
		$str.="</td>";
		$str.="</tr>";
		$str.="<tr align='center'>";
		$str.="<td>UPDATE: <input type='radio' name='update' {$update} value='1'  />�� ";
		$str.="<input type='radio' name='update' {$reupdate} value='0' />��";
		$str.="</td>";
		$str.="<td>SELECT: <input type='radio' name='select' {$select} value='1'  />�� ";
		$str.="<input type='radio' name='select' {$reselect} value='0' />��";
		$str.="</td>";
		$str.="</tr>";
		$str.="<tr align='center'>";
		$str.="<td>REPLACE:<input type='radio' name='replace' {$replace} value='1'  />�� ";
		$str.="<input type='radio' name='replace' {$rereplace} value='0'  />��";
		$str.="</td>";
		$str.="<td><input type='submit' value='�޸�'>&nbsp;&nbsp;&nbsp;";
		$str.="</td>";
		$str.="</tr>";
		$str.="</form></table></div>";
		echo $str;
	}

	function record_setting_in_memcache(){
		$record_setting=array();
		$result=DB::query('SELECT `tablename`,`insert`,`delete`,`update`,`select`,`replace` FROM '.DB::table('plugin_record_setting'));
		while($row=DB::fetch($result)){
			$temp=array();
			foreach($row as $k=>$v){
				if($v=='1'){
					$temp[]=$k;
				}
			}
			$record_setting[$row['tablename']]=$temp;
		}
		$record_setting=serialize($record_setting);
		memory('set','mem_record_setting',$record_setting,0);
	}


?>
<div>
	<br/>
	<table width='800' border='1'>
		<tr align='center'><td>���</td><td>����</td><td>����޸�ʱ��</td><td>INSERT</td><td>DELETE</td><td>UPDATE</td><td>SELECT</td><td>REPLACE</td><td>����</td></tr>
		<?php
			$result=DB::query('SELECT * FROM '.DB::table('plugin_record_setting'));
			$i=1;
			while($row=DB::fetch($result)){
				echo "<tr align='center'><td>{$i}</td><td>{$row['tablename']}</td><td>".date('Y-m-d H:i:s',$row['time'])."</td><td>{$row['insert']}</td><td>{$row['delete']}</td><td>{$row['update']}</td><td>{$row['select']}</td><td>{$row['replace']}</td><td>
					<a href='".ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=setting&a=edit&tableid={$row['id']}'>�޸�</a> |
					<a href='".ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=setting&a=del&tableid={$row['id']}'>ɾ��</a>
				</td></tr>";
				$i++;
			}
		?>


	</table>
</div>
