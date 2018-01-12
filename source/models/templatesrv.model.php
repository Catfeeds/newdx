<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class TemplatesrvModel extends BaseModel
{
	var $table = 'plugin_servers_template';
	var $prikey = 'tmpid';
	var $alias = 'srvtmp';
	var $modellist = array(
		'dianping' => array('name' => '点评系统', 'type' => array(
				'1' => '列表页',
				'2' => '详细页',
				'3' => '发布页',
				'4' => '评论框ajax',
				'5' => '图片ajax',)),
		'photo' => array('name' => '图集服务', 'type' => array(
				'1' => '图集列表',
				'2' => '单个图集',
				'3' => '图集发布编辑',
				'4' => '图片列表的ajax')),
		'comment' => array('name' => '评论服务', 'type' => array('1' => '评论框')),
		);
	var $message = '';
	function getmodels()
	{
		return $this->modellist;
	}
	function AddTemplate($template, $type, $mod, $name = '')
	{
		$type = intval($type);
		$nowtime = time();
		if (! empty($template) && $type >= 0 && ! empty($mod)) {
			$lastver = $this->get("{$this->alias}.template = '{$template}' AND {$this->alias}.type = '{$type}' AND {$this->alias}.model = '{$mod}'");
			$name = empty($name) ? '默认' . $this->modellist[$mod]['name'] . $this->modellist[$mod]['type'][$type] . '模板' : $name;
			if ($lastver) {
				$nowver = $lastver['version'] + 0.001;
				$this->message = '版本更新为 ' . $nowver . ' ';
				return $this->edit($lastver['tmpid'], array(
					'version' => $nowver,
					'lastupdate' => $nowtime,
					'name' => $name));
			} else {
				$this->message = '新建模板';
				return $this->add(array(
					'template' => $template,
					'type' => $type,
					'model' => $mod,
					'name' => $name,
					'createtime' => $nowtime,
					'lastupdate' => $nowtime));
			}
		}
		$this->message = '提交的参数';
		return false;
	}
	function EditTemplate($tmpid, $template = '', $type = '', $mod = '', $name = '')
	{
		if (empty($template) && empty($type) && empty($mod))
			return false;
		$nowtime = time();
		$lastver = $this->get($tmpid);
		if ($lastver) {
			$editdata['name'] = ! empty($name) ? $name : $lastver['name'];
			$editdata['template'] = ! empty($template) ? $template : $lastver['template'];
			$editdata['type'] = ! empty($type) ? $type : $lastver['type'];
			$editdata['model'] = ! empty($mod) ? $mod : $lastver['model'];
			$editdata['lastupdate'] = $nowtime;
			$editdata['version'] = $lastver['version'] + 0.001;
			$this->message = '模板修改';
			return $this->edit($lastver['tmpid'], $editdata) > 0 ? true : false;
		}
		$this->message = '提交的参数';
		return false;
	}
	function getlist($find = array())
	{
		$conditions = '';
		foreach ($find as $k => $v) {
			$conditions .= "AND {$this->alias}.$k = '$v'";
		}
		$conditions = ltrim($conditions, 'AND');
		$list = $this->findAll(array('conditions' => $conditions));
		$return = array();
		foreach ($list as $_v) {
			$_v['modname'] = $this->modellist[$_v['model']]['name'];
			$_v['typename'] = $this->modellist[$_v['model']]['type'][$_v['type']];
			$_v['createtime'] = date('Y-m-d H:i:s', $_v['createtime']);
			$_v['lastupdate'] = date('Y-m-d H:i:s', $_v['lastupdate']);
			$return[] = $_v;
		}
		return $return;
	}
}
?>