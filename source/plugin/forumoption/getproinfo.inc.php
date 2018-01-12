<?php
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';


$cpdl = $_GET['cpdl'];
$cpxl = $_GET['cpxl'];
$pp = $_GET['cppp'];
$mc = $_GET['mc'];
$tids = $_GET['tids'];

$mc = mb_convert_encoding($_GET['mc'],'GBK','UTF-8');

$where = '';
if ($cpdl!=''&&$cpdl!=0) {
	$where .= " AND r.cpdl ='$cpdl'";
}
if($cpxl!=''&&$cpxl!=0) {
	$where .= " AND r.cplx='$cpxl'";
}
if($pp!=''&&$pp!=0) {
	$where .= " AND r.cppp='$pp'";
}
if(!empty($mc)) {
    $mc = str_replace(" ","%",$mc);   
	$where .= " AND r.cpmc LIKE '%$mc%' ";
}
if(!empty($tids)){
    $where.=" AND (t.tid in ($tids))";
}
$brandData = ForumOptionProduce::getInfoBycpdl($where);
echo json_encode($brandData);






