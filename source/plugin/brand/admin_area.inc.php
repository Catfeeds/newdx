<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


require_once DISCUZ_ROOT."/source/plugin/forumoption/include.php";

if ($_GET['op']=='newnation') {
	$include_path = dirname(__file__).'/admincp/newnation.php';
	include $include_path;
	exit;
}
$url = $_SERVER['QUERY_STRING'];

if ($_GET['del'] == 1 && $_GET['rid']) {
	$url = preg_replace('/(&|\?)rid=\d+/i', '', $url);
	$url = preg_replace('/(&|\?)del=1/i', '', $url);
	$id = $_GET['rid'];
	$dq = DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE nation = '$id'");
	if($dq){
		cpmsg('�й���������ʱ����ɾ����tid='.$dq['tid'], $url, 'error');
	}else{
		DB::query("delete from ".DB::table('plugin_brand_area')." WHERE rid=".$id);
		cpmsg('ɾ���ɹ�', $url, 'succeed');
	}
    exit;
}

$where = " WHERE 1=1";
$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_brand_area')." $where");
$array = array();

$query = DB::query("SELECT * FROM ".DB::table('plugin_brand_area')."
		    $where LIMIT ".($page - 1)*$ppp.", $ppp");
while ($value = DB::fetch($query)) {
	$value['num'] =  DB::result_first("SELECT count(*) FROM ".DB::table('dianping_brand_info')." where nation=$value[rid]");
	$array[] = $value;
}
echo '<tr><td colspan="5"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=brand&pmod=admin_area&op=newnation">����¹�����Ϣ</a></td></tr>';
echo '<form action="" method="post" id="commentForm">';
showtableheader();
echo '<tr class="header"><th width="50%">����</th><th width="40%">�����µ�Ʒ�Ƹ���</th><th width="10%">����</th></tr>';
foreach ($array as $i => $value) {
    echo '<tr><td>'.$value['area'].'</td>'.
         '<td>'.$value['num'].'</td>'.
         '<td>'.
         '&nbsp;&nbsp;'.
		 '<a  href="'.$_SERVER['REQUEST_URI'].'&rid='.$value['rid'].'&del=1" onclick="return confirmOperate();">ɾ��</a>'.
		 '</td></tr>';
}
showtablefooter();

?>

</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">


function confirmOperate() {
    return confirm("��ȷ��Ҫִ�д˲�����");
}
</script>
