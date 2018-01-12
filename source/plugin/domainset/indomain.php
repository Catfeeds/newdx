<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
    $array=array("1"=>$_G['config']['host']['portal'],"2"=>$_G['config']['host']['forum'],"3"=>$_G['config']['host']['home']);
    $arr = memory('get','domainset_indomain');
	if(!$arr){
		$query = DB::query("SELECT reqaddress FROM ".DB::table('plugin_domainset')." where 1");
		$arr=array();
		while ($value = DB::fetch($query)) {
			$arr[] = $value['reqaddress'];
		}
        memory('set','domainset_indomain',$arr,3600);
	}
    $list=array();
    $list = memory('get','plugin_domain_indomain');
    if(!$list){
    	$query = DB::query("SELECT domain FROM ".DB::table('plugin_domain')." where 1");
    	while ($value = DB::fetch($query)) {
    		$list[] = $value['domain'];
    	}
        memory('set','plugin_domain_indomain',$list,3600);
    }
    $list[] = 'brand';	//后台无法增加专题二级域名，暂时加在此处，避免被跳转或者404
	//得到请求的域名
    $host= $_SERVER['HTTP_HOST'];
	$url = $_SERVER["REQUEST_URI"];
	$hoststr = substr($host,0,strpos($host, '.'));
	if(in_array($hoststr,$list)&&$url!='/'){
		if(!empty($_GET['inajax'])){

		}else{
			header('HTTP/1.1 404 Not Found');
			header('Status: 404');
			echo "<html><head><title>404 Not Found</title></head><body bgcolor='white'><center><h1>404 Not Found</h1></center><hr><center>Microsoft IIS 5.0 Pighead Edit 10006 indomain1</center></body></html>";
			exit;
		}
	}
	if(!in_array($host,$array)&&!in_array($host,$arr)&&!in_array($hoststr,$list)){
		header('HTTP/1.1 404 Not Found');
		header('Status: 404');
		echo "<html><head><title>404 Not Found</title></head><body bgcolor='white'><center><h1>404 Not Found</h1></center><hr><center>Microsoft IIS 5.0 Pighead Edit 10006 indomain2</center></body></html>";
		exit;
	}

	//其他域名的跳转判断
	if(!in_array($host,$array)&&in_array($host,$arr)){
    	    $query = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domainset')." where reqaddress='{$host}'");
	    	if($query){
			    $res=$query['resaddress'];
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: http://".$res."");exit;
	    	}else{
				header('HTTP/1.1 404 Not Found');
				header('Status: 404');
				echo "<html><head><title>404 Not Found</title></head><body bgcolor='white'><center><h1>404 Not Found</h1></center><hr><center>Microsoft IIS 5.0 Pighead Edit 10006 indomain3</center></body></html>";
				exit;

		    }
    }

?>
