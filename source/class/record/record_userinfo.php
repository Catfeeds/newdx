<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('class/record');
class userinfo extends record
{
	var $_vars = array(
		'uid' => true,
		'username' => true,
		'nickname' => false,
		'password' => false,
		'email' => true,
		'realname' => false,
		'sex' => false,
		'birthday' => false,
		'birthplace' => false,
		'liveplace' => false,
		'telephone' => false,
		'certificatetype' => false,
		'certificateid' => false,
		'mobile' => false,
		'qq' => false,
		'msn' => false,
		'wangwang' => false,
		'school' => false,
		'education' => false,
		'vocation' => false,
		'company' => false,
		'joblevel' => false,
		'income' => false,
		'deliveryaddr' => false,
		'postcode' => false,
		'bindqq' => false,
		'bindsinaweibo' => false,
		'regtime' => true,
		'remark' => false,
		'action' => true,
		'capturetime' => true,
		);
	var $_relation = array(
		'nickname' => 'username',
		'sex' => 'gender',
		'birthday' => 'birthday',
		'birthplace' => 'birthcity',
		'liveplace' => 'residecity',
		'certificatetype' => 'idcardtype',
		'certificateid' => 'idcard',
		'wangwang' => 'taobao',
		'school' => 'graduateschool',
		'vocation' => 'occupation',
		'joblevel' => 'position',
		'income' => 'revenue',
		'deliveryaddr' => 'address',
		'postcode' => 'zipcode',
		'regtime' => 'regdate',
		'remark' => 'bio',
		'capturetime' => 'capturetime',
		);
	var $_typename = 'userinfo';
	function relation_birthday_handle($arr)
	{
		$month = strlen($arr['birthmonth']) == 1 ? '0'.$arr['birthmonth'] : $arr['birthmonth'];
		$day = strlen($arr['birthday']) == 1 ? '0'.$arr['birthday'] : $arr['birthday'];
		$return = (! empty($arr['birthyear']) && ! empty($month) && ! empty($day)) ? $arr['birthyear'].$month.$day : '';
		return $return;
	}
	function data_bindqq_handle()
	{
		return '';
	}
	function data_bindsinaweibo_handle()
	{
		return '';
	}
	function data_password_handle()
	{
		return '******';
	}
	function data_email_handle($email)
	{
		return empty($email) ? '未填写' : $email;
	}
	function data_certificatetype_handle($type)
	{
		$typearr = array(
			'身份证' => 111,
			'护照' => 414,
			'驾驶证' => 335,
			);
		$return = '';
		$type = trim($type);
		if (! empty($type)) {
			$return = $typearr[$type] > 0 ? $typearr[$type] : 111;
		}
		return $return;
	}
	function data_education_handle($edu)
	{
		$eduarr = array(
			'博士' => 1,
			'硕士' => 2,
			'本科' => 3,
			'专科' => 4,
			'中学' => 5,
			'小学' => 6,
			'其他' => 7);
		$return = '';
		$edu = trim($edu);
		if (! empty($edu)) {
			$return = $eduarr[$edu] > 0 ? $eduarr[$edu] : 7;
		}
		return $return;
	}
	function data_sex_handle($sex)
	{
		return in_array($sex, array(1, 2)) ? $sex : 0;
	}
}
?>