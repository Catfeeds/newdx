<?php
//判断是否由手机访问（20140526 edit by lishuaiquan）
$agent   = strtolower($_SERVER['HTTP_USER_AGENT']);  
$iphone  = (strpos($agent, 'iphone')) ? true : false; 
$android = (strpos($agent, 'android')) ? true : false;
if (empty($_COOKIE["goWebFromM"]) && ( $iphone || $android)) {
	if ($_GET['mod'] == "index") {
		$url = "http://m.8264.com";		
	}
	if ($_GET['mod'] == "list") {
		$cateList = array("201","202","203","224","528","228","227","231","232","486","235","844","775","234","204","209","211","207","208","212","792","218","219","222","220","214","216","215","223","751","489","733","746","238","239","242","241");
		$cateList = array_flip($cateList);		
		$url = isset($cateList[$_GET['catid']]) ? "http://m.8264.com/list/{$_GET['catid']}" : "";		
	}
	if ($_GET['mod'] == "view") {
		$url = "http://m.8264.com/viewnews-{$_GET['aid']}-page-1.html";		
	}	
	if (!empty($url)) {
		header("Location:{$url}");
		exit();
	}
}