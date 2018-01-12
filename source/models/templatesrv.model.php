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
		'dianping' => array('name' => '����ϵͳ', 'type' => array(
				'1' => '�б�ҳ',
				'2' => '��ϸҳ',
				'3' => '����ҳ',
				'4' => '���ۿ�ajax',
				'5' => 'ͼƬajax',)),
		'photo' => array('name' => 'ͼ������', 'type' => array(
				'1' => 'ͼ���б�',
				'2' => '����ͼ��',
				'3' => 'ͼ�������༭',
				'4' => 'ͼƬ�б��ajax')),
		'comment' => array('name' => '���۷���', 'type' => array('1' => '���ۿ�')),
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
			$name = empty($name) ? 'Ĭ��' . $this->modellist[$mod]['name'] . $this->modellist[$mod]['type'][$type] . 'ģ��' : $name;
			if ($lastver) {
				$nowver = $lastver['version'] + 0.001;
				$this->message = '�汾����Ϊ ' . $nowver . ' ';
				return $this->edit($lastver['tmpid'], array(
					'version' => $nowver,
					'lastupdate' => $nowtime,
					'name' => $name));
			} else {
				$this->message = '�½�ģ��';
				return $this->add(array(
					'template' => $template,
					'type' => $type,
					'model' => $mod,
					'name' => $name,
					'createtime' => $nowtime,
					'lastupdate' => $nowtime));
			}
		}
		$this->message = '�ύ�Ĳ���';
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
			$this->message = 'ģ���޸�';
			return $this->edit($lastver['tmpid'], $editdata) > 0 ? true : false;
		}
		$this->message = '�ύ�Ĳ���';
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