<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


$mrytnum = 0;
if(isset($_COOKIE['mryt'])==""){
	
}else{
	$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
	$newnum = $mg['num'];
	if(isset($_COOKIE['mryt'])){
		$oldnum = $_COOKIE['mryt'];
		$mryt = $newnum-$oldnum;
		if($mryt>=1){
			$mrytnum = $mryt;
		}		
	}		
}

$kqmgnum = 0;
if(isset($_COOKIE['kqmg'])==""){

}else{
	$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
	$newnum = $mg['num'];	
	if(isset($_COOKIE['kqmg'])){
		$oldnum = $_COOKIE['kqmg'];
		$kqmg = $newnum-$oldnum;
		if($kqmg>=1){
			$kqmgnum = $kqmg;
		}
	}		
}
$xltjnum = 0;
if(isset($_COOKIE['xltj'])==""){

}else{
	$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
	$newnum = $mg['num'];	
	if(isset($_COOKIE['xltj'])){
		$oldnum = $_COOKIE['xltj'];
		$xltj = $newnum-$oldnum;
		if($xltj>=1){
			$xltjnum = $xltj;
		}
	}		
}
$yzxxnum = 0;
if(isset($_COOKIE['yzxx'])==""){

}else{
	$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
	$newnum = $mg['num'];	
	if(isset($_COOKIE['yzxx'])){
		$oldnum = $_COOKIE['yzxx'];
		$yzxx = $newnum-$oldnum;
		if($yzxx>=1){
			$yzxxnum = $yzxx;
		}
	}		
}
$jctjnum = 0;
if(isset($_COOKIE['jctj'])==""){
	
}else{
	$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
	$newnum = $mg['num'];	
	if(isset($_COOKIE['jctj'])){
		$oldnum = $_COOKIE['jctj'];
		$jctj = $newnum-$oldnum;
		if($jctj>=1){
			$jctjnum = $jctj;
		}
	}		
}

$zbtjnum = 0;
if(isset($_COOKIE['zbtj'])==""){
	
}else{
	$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('forum_thread')." at WHERE fid IN (480) AND displayorder>='0'");
	$newnum = $mg['num'];	
	if(isset($_COOKIE['zbtj'])){
		$oldnum = $_COOKIE['zbtj'];
		$zbtj = $newnum-$oldnum;
		if($zbtj>=1){
			$zbtjnum = $zbtj;
		}
	}		
}
if(($_G['fid']==480)){
	if(isset($_COOKIE['zbtj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('forum_thread')." WHERE fid IN (480) AND displayorder>='0'");
		$firstnum = $mg['num'];
		setcookie("zbtj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('forum_thread')." WHERE fid IN (480) AND displayorder>='0'");
		$newnum = $mg['num'];	
		if(isset($_COOKIE['zbtj'])){	
			setcookie("zbtj",$newnum, time()+365*24*60*60,'/','.8264.com');				
		}		
	}	
}

?>

