<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

function updateCacheInfo(){
	static $isfilecache, $allowmem;
	//增加memcache缓存判断 modify by wangqi 20121011 (暂时不取消文件缓存)
	if($isfilecache === null) {
		$isfilecache = getglobal('config/cache/type') == 'file';
		$allowmem = memory('check');
	}
	$sql = "SELECT * FROM ".DB::table('plugin_domain')." where 1";
	$query = DB::query($sql);
	$arr = array();
	while ($value = DB::fetch($query)) {
		$arr[] = $value;
	}
	$str="<?php ";
	for($i=0;$i<count($arr);$i++){
		$str .= "\$domain['list']['".$arr[$i]['domain'].".{$_G['setting']['domain']['root']['forum']}'] = array('id'=>".$arr[$i]['fid'].",'idtype'=>'forum','filter'=>'typeid','typeid'=>".$arr[$i]['typeid'].");";
		$domain['list']["{$arr[$i]['domain']}.{$_G['setting']['domain']['root']['forum']}"] = array('id'=>$arr[$i]['fid'],'idtype'=>'forum','filter'=>'typeid','typeid'=>$arr[$i]['typeid']);
	}
	$str .=" ?>";
	$allowmem && (memory('set', 'cache_mydomain', $domain));
	/**加入memcache**/
	require DISCUZ_ROOT.'./config/config_global.php';
	$memcache = new Memcache;
	$memcache->addServer($_config['memory']['memcache']['server'], $_config['memory']['memcache']['port']);
	$memcache->connect($_config['memory']['memcache']['server'], $_config['memory']['memcache']['port']) or die("Memcache can't connect");
	$memcache->delete('vjPs0B_domain');
	memory('rm','plugin_domain_indomain');
	memory('rm','plugin_domain_get_domain_by_fidtypid_hUkNbv');
	memory('rm','plugin_domain_get_domain_typeid_0_hSdVe');
	/**以上加入memcache**/
	//file_put_contents(DISCUZ_ROOT.'data/cache/cache_mydomain.php',$str);
	//end

}


if($_POST){
	$typeid = $_POST['typeid'];
	$id = $_POST['id'];
	$domain = str_replace(" ","",trim($_POST['domain']));
	$domain = strtolower($domain);
	$fid = $_POST['fid'];

	if($typeid){
		$dm  = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domain')." where typeid=$typeid");
		if($dm){
			DB::query("update ".DB::table('plugin_domain')." set domain ='".$domain."' where id=$id");
			updateCacheInfo();
		}else{
			$dn  = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domain')." where domain='".$domain."'");
			if($dn){
				echo "您填写的域名已经存在！";exit;
				return;
			}
			DB::query("insert into ".DB::table('plugin_domain')." values(null,'".$domain."','".$fid."','".$typeid."')");
			updateCacheInfo();
		}
	}else{
		$dm  = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domain')." where fid=$fid and typeid=0");
		if($dm){
			DB::query("update ".DB::table('plugin_domain')." set domain ='".$domain."' where id=$dm[id]");
			updateCacheInfo();
		}else{
			$dn  = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domain')." where domain='".$domain."'");
			if($dn){
				echo "您填写的域名已经存在！";exit;
				return;
			}
			DB::query("insert into ".DB::table('plugin_domain')." values(null,'".$domain."','".$fid."',0)");
			updateCacheInfo();
		}
	}
}
$sql = "SELECT * FROM ".DB::table('forum_forum')." where status<>'3' ORDER BY type<>'group',displayorder";
$query = DB::query($sql);
$arr = array();
while ($value = DB::fetch($query)) {
	$value['domain'] = DB::result_first("SELECT domain FROM ".DB::table('plugin_domain')." where fid=$value[fid] and typeid=0");
	$arr[] = $value;
}

if($_GET['op']=='edit'&&$_GET['fid']){
	$fid = $_GET['fid'];
	$sql = "SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid";
	$query = DB::query($sql);
	$list = array();
	while ($value = DB::fetch($query)) {
		$value['domain'] = DB::result_first("SELECT domain FROM ".DB::table('plugin_domain')." where fid=$value[fid] and typeid=$value[typeid]");
		$value['id'] = DB::result_first("SELECT id FROM ".DB::table('plugin_domain')." where typeid=$value[typeid]");
		$list[] = $value;
	}
}
?>
<script type="text/javascript">
function checkvalue(m){
	//if(document.getElementById(m).value==""){
	//	alert('请输入内容');
	//	return false;
	//}else{
		return true;
	//}
}
</script>
<style>
#box{border: 1px solid #ccc;float: left;margin: 10px 0 20px 0;width: 55%;padding: 10px}
input {margin: 3px 0px;}
table {border-collapse: collapse;}
.tb {clear: both;margin-top: 8px;width: 100%;}
.header{font-weight: bold;}
#adddomain{}
</style>

<?php if($_GET['op']=='edit'&&$_GET['fid']){ ?>
<?php showtableheader(); ?>
	  <tr>
		<td class="header">版块名称</td>
		<td class="header">版块地址</td>
		<td class="header">域名</td>
		<td class="header">&nbsp;</td>
	  </tr>
	  <?php foreach ($list as $value): ?>
	  <form id="other_<?php echo $value['typeid']; ?>" method="post" action="">
			<tr>
			  <td><?php echo $value['name']; ?></td>
			  <td><?php echo $_G['setting']['domain']['app']['forum']; ?>/forum-forumdisplay-fid-<input type="text" name="fid" readonly="true" size="4" value="<?php echo $_GET['fid']; ?>"/>-filter-typeid-typeid-<input type="text" name="typeid" readonly="true" size="4" value="<?php echo $value['typeid']; ?>"/>.html</td>
			  <td>http://<input type="text" id="domain_<?php echo $value['typeid']; ?>" name="domain" size="10" onfocus=this.select() onKeyDown="document.getElementById('subbmt_<?php echo $value['typeid'];?>').style.visibility='visible'" onKeyPress="document.getElementById('subbmt_<?php echo $value['typeid'];?>').style.visibility='visible'" onChange="document.getElementById('subbmt_<?php echo $value['typeid'];?>').style.visibility='visible'" value="<?php echo $value['domain']==""?"":$value['domain']; ?>"/>.<?php echo $_G['setting']['domain']['root']['forum']; ?></td>
			  <td><input type="hidden" name="id" value="<?php echo $value['id'];?>"/><input type="submit" id="subbmt_<?php echo $value['typeid'];?>" name="sub_<?php echo $value['typeid'];?>" value="修改" style="visibility:hidden" onClick="return checkvalue('domain_<?php echo $value['typeid']; ?>')"/></td>

			</tr>
	  </form>
	  <?php endforeach; ?>
<?php showtablefooter(); ?>
<?php }else{ ?>
<?php showtableheader(); ?>
	  <tr>
		<td class="header">版块名称</td>
		<td class="header">版块地址</td>
		<td class="header">域名</td>
		<td class="header">&nbsp;</td>
		<td class="header">操作</td>
	  </tr>
	  <?php foreach ($arr as $value): ?>
	  <form id="other_<?php echo $value['fid']; ?>" method="post" action="">
			<tr>
			  <td><?php echo $value['name']; ?></td>
			  <td><?php echo $_G['config']['web']['forum'];?>forum-<input type="text" name="fid" readonly="true" size="4" value="<?php echo $value['fid']; ?>"/>-1.html</td>
			  <td>http://<input type="text" id="domain_<?php echo $value['fid']; ?>" name="domain" size="10" onfocus=this.select() onKeyDown="document.getElementById('subbmt_<?php echo $value['fid'];?>').style.visibility='visible'" onKeyPress="document.getElementById('subbmt_<?php echo $value['fid'];?>').style.visibility='visible'" onChange="document.getElementById('subbmt_<?php echo $value['fid'];?>').style.visibility='visible'" value="<?php echo $value['domain']==""?"":$value['domain']; ?>"/>.<?php echo $_G['setting']['domain']['root']['forum']; ?></td>
			  <td><input type="submit" id="subbmt_<?php echo $value['fid'];?>" name="sub_<?php echo $value['fid'];?>" value="修改" style="visibility:hidden" onClick="return checkvalue('domain_<?php echo $value['fid']; ?>')"/></td>
			  <td><?php echo '<a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=tzset&op=edit&fid='.$value['fid'].'">编辑</a>'; ?></td>
			</tr>
	  </form>
	  <?php endforeach; ?>
<?php showtablefooter(); ?>
<?php } ?>

