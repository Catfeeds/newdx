<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/******************
 *  线路指数计算 *
 ****************/
$tp = $_GET['tp'];
if($tp=='qdzs'){
	$times=floatval($_POST['times']);
	$endure=floatval($_POST['endure']);
	$distance=floatval($_POST['distance']);
	$verticality=floatval($_POST['verticality']);
	$supply=floatval($_POST['supply']);
	$tal = $times*$endure*$distance*$verticality*$supply;
	$tal = number_format($tal,1);	
	if($tal){
		echo $tal;exit;
	}else{
		echo 'error';
	}
	exit;
}
if($tp=='wxzs'){
	$lowtemperature=$_POST['lowtemperature']; //最低气温
	$highttemperature=$_POST['highttemperature']; //高气温
	
	$avgrain=floatval($_POST['avgrain']); //平均降水
	$badrain=floatval($_POST['badrain']); //恶略降水
	
	
	$watertemp=floatval($_POST['watertemp']); //水温度数
	$badtemp=floatval($_POST['badtemp']); //恶略水温度数
	
	
	$avgdeep=floatval($_POST['avgdeep']); //平均度数
	$mostdeep=floatval($_POST['mostdeep']); //最深深度数
	
	$avgspeed=floatval($_POST['avgspeed']); //平均流速
	$badspeed=floatval($_POST['badspeed']); //最快流速
	
	$landform=floatval($_POST['landform']); //地形指数
	$wildlife=floatval($_POST['wildlife']); //野生动物指数
	$attack=floatval($_POST['attack']); //攻击指数
	
	$danger = $wildlife*$attack;
	
	$degree = floatval($_POST['degree']); //救援系数	
	$cha = abs($highttemperature-$lowtemperature);  //温度差计算
	
	
	
	$low=0;
	$hig=0;
	$ab=0;
	if($lowtemperature<0){
		$ww = (abs($lowtemperature)/5);
		$bs = ceil($ww);
		$low = $bs*0.5;
	}
	if($highttemperature>26){
		$ht= $highttemperature-26;
		$hight = (abs($ht)/5);
		$cd = ceil($hight);			
		$hig = $cd*0.4;
	}
	if($cha>15){
		$pt = $cha-15;
		$ch = ($pt/5);
		$cc = ceil($ch);
		$ab = $cc*0.5;
	}		
	$tal = 1+$low+$hig+$ab;   //气温指数	
	
	$rain = $avgrain*0.6+$badrain*0.4;  //降水指数
	$water = ($watertemp*$avgdeep*$avgspeed*0.6)+($badtemp*$mostdeep*$badspeed*0.4); //水文指数

	$tals = ($tal*$landform*$danger*$degree)+$rain+$water;
	
	/*
	echo '气温指数：'.$tal;
	echo '地形指数：'.$landform;
	echo '危险指数：'.$danger;
	echo '降水指数：'.$rain;
	echo '水温指数：'.$water;
	echo '救援系数：'.$degree;
	echo '结果值：'.$tals;
	exit;*/
	
	$tals = number_format($tals,1);		
	if($tal){
		echo $tals;exit;
	}else{
		echo 'error';
	}
	exit;
}
$pageTitle = '8264徒步路线评价体系';
include template('forumoption:cal');