<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: misc_error.php 6790 2010-03-25 12:30:53Z cnteacher $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if($_G['gp_action'] == 'savecol'){


	$insert_data = array();
	$insert_data['coltermini']=dhtmlspecialchars(trim($_G['gp_coltermini'])); 
	$insert_data['colcategory']=dhtmlspecialchars(trim($_G['gp_colcategory'])); 
	$insert_data['colmobile']=dhtmlspecialchars(trim($_G['gp_colmobile'])); 

	$insert_data['ip'] = $_G['clientip'];
	$insert_data['timestamp'] = $_G['timestamp'];


	$insert_data = iconv_array($insert_data,"UTF-8","GBK");

	//避免发布的内容被注入script
	foreach ($insert_data as $key => $value) {
		$insert_data[$key] = str_ireplace(array("body", "create", "script", "src"), array("bo dy", "cre ate", "scri pt", "sr c"), $value);
	}

	$return = DB::insert('portal_collecthddemand', $insert_data);

	echo json_encode($return);
}
?>