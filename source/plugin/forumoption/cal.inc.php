<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/******************
 *  ��·ָ������ *
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
	$lowtemperature=$_POST['lowtemperature']; //�������
	$highttemperature=$_POST['highttemperature']; //������
	
	$avgrain=floatval($_POST['avgrain']); //ƽ����ˮ
	$badrain=floatval($_POST['badrain']); //���Խ�ˮ
	
	
	$watertemp=floatval($_POST['watertemp']); //ˮ�¶���
	$badtemp=floatval($_POST['badtemp']); //����ˮ�¶���
	
	
	$avgdeep=floatval($_POST['avgdeep']); //ƽ������
	$mostdeep=floatval($_POST['mostdeep']); //���������
	
	$avgspeed=floatval($_POST['avgspeed']); //ƽ������
	$badspeed=floatval($_POST['badspeed']); //�������
	
	$landform=floatval($_POST['landform']); //����ָ��
	$wildlife=floatval($_POST['wildlife']); //Ұ������ָ��
	$attack=floatval($_POST['attack']); //����ָ��
	
	$danger = $wildlife*$attack;
	
	$degree = floatval($_POST['degree']); //��Ԯϵ��	
	$cha = abs($highttemperature-$lowtemperature);  //�¶Ȳ����
	
	
	
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
	$tal = 1+$low+$hig+$ab;   //����ָ��	
	
	$rain = $avgrain*0.6+$badrain*0.4;  //��ˮָ��
	$water = ($watertemp*$avgdeep*$avgspeed*0.6)+($badtemp*$mostdeep*$badspeed*0.4); //ˮ��ָ��

	$tals = ($tal*$landform*$danger*$degree)+$rain+$water;
	
	/*
	echo '����ָ����'.$tal;
	echo '����ָ����'.$landform;
	echo 'Σ��ָ����'.$danger;
	echo '��ˮָ����'.$rain;
	echo 'ˮ��ָ����'.$water;
	echo '��Ԯϵ����'.$degree;
	echo '���ֵ��'.$tals;
	exit;*/
	
	$tals = number_format($tals,1);		
	if($tal){
		echo $tals;exit;
	}else{
		echo 'error';
	}
	exit;
}
$pageTitle = '8264ͽ��·��������ϵ';
include template('forumoption:cal');