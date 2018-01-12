<?php

/**
 * @author gtl
 * 友情链接后台管理 --- 内链管理
 * 资讯 1|gp_catid
 * 论坛 2|gp_fid|gp_typeid
 * 点评 3|fid[|params:value]
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/config.inc.php';
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/flink.func.php';
$default_key = 'plugin_friendlylink_default_config';

//编辑操作
if($_GET['op'] == 'addsubmit'){
	$url = preg_replace('/\/admin\.php\?/i', '', $url);
	$url = preg_replace('/(&|\?)op=(.*)/i', '', $url);
	
	$data = $_POST;
	foreach($data as $field=>$values){
		foreach($values as $key=>$value){
			$insert_data[$key][$field] = $value;
		}
	}
	foreach($insert_data as $data){
		$tmp[] = "({$data['group']}, '{$data['keyword']}', '{$data['url']}', '{$data['identifie']}', '{$data['weight']}', '{$data['setinlink']}')";
	}
	if(!empty($tmp)){
		$tmp = implode(',',$tmp);
		$sql = "INSERT INTO " . DB::table('common_friendlink2_inlink') . "(`group`, `keyword`, `url`, `identifie`, `weight`, `setinlink`) VALUES".$tmp;
		$query = DB::query($sql);
		if($query){
			memory('rm', $default_key);
			cpmsg('添加成功', $url, 'succeed');
		}
		cpmsg('添加失败', $url, 'error');
	}
}elseif($_GET['op'] == 'editsubmit') {
	$id = (int)trim($_POST['id']);
	$field = trim($_POST['field']);
	$val = trim($_POST['val']);

	$cha = mb_detect_encoding($val);
	$val = iconv($cha,"GB2312",$val);
	
	$sql = "UPDATE " . DB::table('common_friendlink2_inlink') . " SET {$field} = '{$val}'  WHERE id = {$id}";
	$query = DB::query($sql);
	if($query){
		memory('rm', $default_key);
		cpmsg('编辑成功', $url, 'succeed');
	}
	cpmsg('编辑失败', $url, 'error');
}elseif($_GET['op'] == 'del'){	//删除操作
	$id = (int)$_GET['id'];
	if($id<1){
		cpmsg('参数错误', $url, 'error');
	}
	$sql = "DELETE FROM " . DB::table('common_friendlink2_inlink') . " WHERE id = {$id}";
	$query = DB::query($sql);
	if($query){
		memory('rm', $default_key);
		cpmsg('删除成功', $url, 'succeed');
	}
	cpmsg('删除失败', $url, 'error');
}elseif($_GET['op'] == 'init'){		//初始化操作
	$weight = $init_data = $inlinks = array();
	$addtime = time();
	$sql = "SELECT * FROM " . DB::table('common_friendlink2_inlink') . ' where `group` > 0';
	$query = DB::query($sql);
	while ($values = DB::fetch($query)) {
		$links[$values['id']]['group'] = $values['group'];
		$links[$values['id']]['keyword'] = $values['keyword'];
		$links[$values['id']]['url'] = $values['url'];
		$links[$values['id']]['identifie'] = $values['identifie'];
		$links[$values['id']]['setinlink'] = $values['setinlink'];
		$weight[$values['id']] = $values['weight']; //key 和 权重的对应关系
		if($values['identifie'] && $values['setinlink']){
			$inlinks[$values['id']] = $values['identifie']; //需要设置内链的内页id
		}
	}
	
	//随机获取数据
	foreach($inlinks as $k=>$w){
		$children = getroll($weight, $k, $links);
		foreach($children as $urlk=>$urlinfo){
			$insert_sql[] = "('{$urlinfo['keyword']}', '{$urlinfo['url']}', '', '', '{$links[$k]['identifie']}', 0, 0, '{$urlinfo['displayorder']}', '', '{$links[$k]['keyword']}', '{$links[$k]['url']}', 2, {$addtime}, 1)";
			$show_array[$links[$k]['group']][$links[$k]['url']][] = $urlinfo['url'];
		}
	}
	
	if(!$_GET['type']){
		print_r($show_array);die;
	}elseif($_GET['type'] == 'show_sql'){
		$insert_sql = "INSERT INTO " . DB::table('common_friendlink2') . "(`name`,`url`,`description`,`logo`,`identifie`,`ptype`,`type`,`displayorder`,`qq`,`site_outlink_name`,`site_outlink`,`ispass`,`addtime`,`link_type`) VALUES";
		foreach($insert_sql as $v){
			$insert_sql.$v.",<br/>";
		}
		echo $insert_sql;die;
	}elseif($_GET['type'] == 'update_table'){
		//删除所有内链
		$query = DB::query("DELETE FROM " . DB::table('common_friendlink2') . " WHERE link_type = 1");

		//插入数据
		$insert_sql = "INSERT INTO " . DB::table('common_friendlink2') . "(`name`,`url`,`description`,`logo`,`identifie`,`ptype`,`type`,`displayorder`,`qq`,`site_outlink_name`,`site_outlink`,`ispass`,`addtime`,`link_type`) VALUES".  implode(',', $insert_sql);
		$query = DB::query($insert_sql);

		//更新缓存
		foreach ($inlinks as $identifie) {
			$key = 'plugin_friendlylink_list_'.$identifie;
			memory('rm', $key);
		}

		$url = preg_replace('/\/admin\.php\?/i', '', $url);
		$url = preg_replace('/(&|\?)op=(.*)/i', '', $url);
		if($query){
			cpmsg('更新成功', $url, 'succeed');
		}
		cpmsg('更新失败', $url, 'error');
	}
}

//列表页展示
$links = array();
$sql = "SELECT * FROM " . DB::table('common_friendlink2_inlink') . " as fi where keyword <> '预留' order by fi.group>0,weight desc,id";
$query = DB::query($sql);
while ($values = DB::fetch($query)) {
	if(!$values['group']){
		$links[$values['id']]['name'] = $plugin_fk_relation[$values['id']];
		$links[$values['id']]['keyword'] = $values['keyword'];
		continue ;
	}
	$links[$values['group']]['child'][] = $values;
	$links[$values['group']]['sum'] += 1;
	$values['setinlink'] && $links[$values['group']]['setinlink'] += 1;
}

include template('friendlylink:list_inlink');
