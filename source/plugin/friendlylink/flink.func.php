<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function clear_server($id) {
	$sql = "SELECT identifie FROM " . DB::table('common_friendlink2') . " where id=" . $id;
	$query = DB::query($sql);
	$values = DB::fetch($query);
	$key = 'plugin_friendlylink_list_'.$values['identifie'];
	memory('rm', $key);
}

function checkqq($str) {
	if (preg_match("/^[\d]{5,15}$/", $str)) {
		return true;
	}
	return false;
}

function checkurl($s) {
	return preg_match('/^http[s]?:\/\/' .
					'(([0-9]{1,3}\.){3}[0-9]{1,3}' . // IP��ʽ��URL- 199.194.52.184  
					'|' . // ����IP��DOMAIN��������  
					'([0-9a-z_!~*\'()-]+\.)*' . // ����- www.  
					'([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.' . // ��������  
					'[a-z]{2,6})' . // first level domain- .com or .museum  
					'(:[0-9]{1,4})?' . // �˿�- :80  
					'((\/\?)|' . // a slash isn't required if there is no file name  
					'(\/[0-9a-zA-Z_!~\'
    \.;\?:@&=\+\$,%#-\/^\*\|]*)?)$/', $s) == 1;
}
//�����gbk�����ַ�����
function abslength($s) {
	$a = str_split($s);
	return count($a);
}

/**
 * @param array $weight Ȩ��  ����array('a'=>10,'b'=>20,'c'=>50) 
 * @return string key   ����  
 */
function roll($weight = array()) {
	$roll = rand(1, array_sum($weight));
	$_tmpW = 0;
	$rollnum = 0;
	foreach ($weight as $k => $v) {
		$min = $_tmpW;
		$_tmpW += $v;
		$max = $_tmpW;
		if ($roll > $min && $roll <= $max) {
			$rollnum = $k;
			break;
		}
	}
	return $rollnum;
}

function getroll($weight, $outkey, $links){
	$return = array();
	unset($weight[$outkey]);
	$count = min(15,count($weight));
	for($i=0; $i<$count; $i++){
		$tmp = roll($weight);
		unset($weight[$tmp]);
		$return[] = $links[$tmp];
	}
	return $return;
}