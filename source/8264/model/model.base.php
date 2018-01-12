<?php

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

// �������һ��һ
define('HAS_ONE', 1);
// �����������
define('BELONGS_TO', 2);
// �������һ�Զ�
define('HAS_MANY', 3);
// ���������Զ�
define('HAS_AND_BELONGS_TO_MANY', 4);
// ��ձ����
define('DROP_CONDITION_TRUNCATE', 'TRUNCATE');

/**
 * ����ģ�ͻ���
 *
 * @author 8264TEAM 130823
 * @example ��������ģ���ļ���������xxxx.model.php��������������XxxxModel
 *
 */
class BaseModel extends Object {

	var $db = null;
	// ��ӳ������ݿ��
	var $table = '';
	// ����
	var $prikey = '';
	// ����
	var $alias = '';
	// ģ�͵�����
	var $_name = '';
	// ��ǰ׺
	var $_prefix = '';
	// ������֤����
	var $_autov = array();
	// ��ѯͳ��
	var $_last_query_count = -1;
	// ��ʱ������ɾ��������
	var $_dropped_data = array();
	// ��ϵ(�����ϵʱ��ֻ��belongs_to�Լ�has_and_belongs_to_many��Ҫָ��reverse�����ϵ)
	var $_relation = array();

	function __construct($params, $db) {
		$this->BaseModel($params, $db);
	}

	/**
	 * ���췽��
	 *
	 * @author 8264TEAM
	 * @param array $params
	 * @param object $db
	 */
	function BaseModel($params, $db) {
		$this->db = $db;
		$this->alias || $this->alias = $this->table;
		$this->_prefix = $this->db->tablepre;
		$this->table = $this->_prefix . $this->table;
		if (!empty($params)) {
			foreach ($params as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	/**
	 * ��ȡģ������
	 *
	 * @author 8264TEAM
	 * @return string ������
	 */
	function getName() {
		return $this->_name;
	}

	/**
	 * ��ȡ��һ����¼
	 *
	 * @author 8264TEAM
	 * @param mixed $params ��ѯ����
	 * @return array ��ѯ���
	 */
	function get($params) {
		$data = $this->find($params);
		if (!is_array($data)) {
			return array();
		}
		return current($data);
	}

	/**
	 * ����һ�������ҳ��������(����������ģ�ͣ�ֱ��ͨ��JOIN�������ѯ)
	 *
	 * @author 8264TEAM
	 * @param mixed $params ��ѯ����
	 * @param boolean $has_key ��ѯ����Ƿ������������
	 * @return array ��ѯ���
	 */
	function find($params = array(), $has_key = true) {
		extract($this->_initFindParams($params));

		// ��ѯ�ֶ�
		$fields = $this->getRealFields($fields);
		$fields || $fields = '*';

		// ���� ����
		$tables = $this->table . ' ' . $this->alias;

		// ������(LEFT JOIN)
		$join_result = $this->_joinModel($tables, $join);

		// ���������������������Ĭ����Ҫ��ѯ�ֶκ��������
		if ($index_key == $this->prikey || (is_array($index_key) && in_array($this->prikey, $index_key))) {
			$fields .= ",{$this->alias}.{$this->prikey}";
		}

		// ����(WHERE)
		$conditions = $this->_getConditions($conditions, true);

		// ����(ORDER BY)
		$order && $order = ' ORDER BY ' . $this->getRealFields($order);

		// ��ҳ(LIMIT)
		$limit && $limit = ' LIMIT ' . $limit;
		if ($count) {
			$this->_updateLastQueryCount("SELECT COUNT(*) as c FROM {$tables}{$conditions}");
		}

		// ������SQL
		$sql = "SELECT {$fields} FROM {$tables}{$conditions}{$order}{$limit}";
		$arr_result = $index_key && $has_key ? $this->db->getAllWithIndex($sql, $index_key) : $this->db->getAll($sql);
		return $arr_result;
	}

	/**
	 * �������Ҷ�Զ��ϵ�ļ�¼
	 *
	 * @author 8264TEAM
	 * @param mixed $params
	 * @return array
	 */
	function findAll($params = array()) {
		$params = $this->_initFindParams($params);
		extract($params);
		// ���ҳ�ͨ��JOIN��õ����ݼ�
		$pri_data = $this->find($params);
		if (!empty($include) && !empty($pri_data)) {
			$ids = array();
			if ($index_key != $this->prikey) {
				foreach ($pri_data as $pk => $pd) {
					$ids[] = $pd[$this->prikey];
				}
			} else {
				$ids = array_keys($pri_data);
			}

			foreach ($include as $relation_name => $find_param) {
				if (is_string($find_param)) {
					$relation_name = $find_param;
					$find_param = array();
				}

				// ���λ�ȡ�������ݣ�������ŷ������ݼ���
				$related_data = $this->getRelatedData($relation_name, $ids, $find_param);

				is_array($related_data) && $pri_data = $this->assemble($relation_name, $related_data, $pri_data);
			}
		}

		return $pri_data;
	}

	/**
	 * ��ȡһ�Զ࣬��Զ�Ĺ�������
	 *
	 * @author 8264TEAM
	 * @param string $relation_name ��ϵ����
	 * @param array $ids ���������ֵ�б�
	 * @param array $find_param ����������
	 * @return void
	 */
	function getRelatedData($relation_name, $ids, $find_param = array()) {
		$relation_info = $this->getRelation($relation_name);
		$model = & m($relation_info['model']);
		if (empty($ids)) {
			$this->_error('no_ids_to_assoc', $model->getName());

			return false;
		}

		if ($relation_info['type'] != HAS_MANY && $relation_info['type'] != HAS_AND_BELONGS_TO_MANY) {
			$this->_error('invalid_assoc_model', $model->getName());

			return false;
		}

		$alias = $model->alias;
		// ����Ƕ�Զ��ϵ�������ӵı�ı���Ϊָ���������м����������Ϊģ�͵ı���
		if ($relation_info['type'] == HAS_AND_BELONGS_TO_MANY) {
			$be_related = $model->getRelation($relation_info['reverse']);
			$alias = isset($be_related['alias']) ? $be_related['alias'] : $be_related['middle_table'];
		}

		// �����ѯ����
		$conditions = $alias . '.' . $relation_info['foreign_key'] . ' ' . db_create_in($ids);
		$conditions .= $relation_info['ext_limit'] ?
				' AND ' . $this->_getExtLimit($relation_info['ext_limit'], $alias) : '';
		$conditions .= is_string($find_param['conditions']) ? ' AND ' . $find_param['conditions'] : '';
		$find_param['conditions'] = $conditions;


		// ��ѯ�ֶ�
		$find_param['fields'] = !empty($find_param['fields']) ?
				$find_param['fields'] . ',' . $alias . '.' . $relation_info['foreign_key'] : '';
		switch ($relation_info['type']) {
			case HAS_MANY:
				break;
			case HAS_AND_BELONGS_TO_MANY:
				$find_param['join'] = !empty($find_param['join']) ?
						$find_param['join'] . ',' . $relation_info['reverse'] : $relation_info['reverse'];
				empty($find_param['order']) && $find_param['order'] = $model->alias . ".{$model->prikey} DESC";
				$find_param['index_key'] = array($relation_info['foreign_key'], $model->prikey);
				break;
		}

		return $model->find($find_param);
	}

	/**
	 * ���һ����¼
	 *
	 * @author 8264TEAM
	 * @param array $data
	 * @return mixed
	 */
	function add($data, $compatible = false) {
		if (empty($data) || !$this->dataEnough($data)) {
			return false;
		}

		$data = $this->_valid($data);
		if (!$data) {
			$this->_error('no_valid_data');
			return false;
		}
		$insert_info = $this->_getInsertInfo($data);
		$mode = $compatible ? 'REPLACE' : 'INSERT';
		
		$this->db->query("{$mode} INTO {$this->table} {$insert_info['fields']} VALUES {$insert_info['values']}");
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			if ($insert_info['length'] > 1) {
				for ($i = $insert_id; $i < $insert_id + $insert_info['length']; $i++) {
					$id[] = $i;
				}
			} else {
				// ��ӵ�����¼
				$id = $insert_id;
			}
		}

		return $id;
	}

	/**
	 * ��Ӷ�Զ�������м���������
	 *
	 * @author 8264TEAM
	 * @param string $relation_name
	 * @param int $id
	 * @param mixed $ids
	 * @return bool
	 */
	function createRelation($relation_name, $id, $ids) {
		return $this->_relationLink('create', $relation_name, $id, $ids);
	}

	/**
	 * ���¶�Զ��ϵ�еĹ�ϵ����
	 *
	 * @author 8264TEAM
	 * @param string $rela
	 * @param int $id
	 * @param mixed $ids
	 * @param mixed $update_values
	 * @return bool
	 */
	function updateRelation($relation_name, $id, $ids, $update_values) {
		return $this->_relationLink('update', $relation_name, $id, $ids, $update_values);
	}

	/**
	 * ȥ����Զ�Ĺ�������
	 *
	 * @author 8264TEAM
	 * @param string $relation_name (��ɾ����ϵ����)
	 * @param mixed $conditions ����
	 * @param array $ids ����ģ�͵�����ֵ����(��ӵ����ID�б�),��Ϊ��
	 * @return bool
	 */
	function unlinkRelation($relation_name, $conditions, $ids = null) {
		return $this->_relationLink('drop', $relation_name, $conditions, $ids);
	}

	/**
	 * �Զ�Զ���������
	 *
	 * @author 8264TEAM
	 * @param
	 * @return void
	 */
	function _relationLink($action, $relation_name, $id, $ids, $update_values = array()) {
		if ((empty($ids) && $action == 'create') || !$id || !$relation_name) {
			$this->_error('relation_link_param_error');
			return false;
		}
		$relation_info = $this->getRelation($relation_name);
		if ($relation_info['type'] !== HAS_AND_BELONGS_TO_MANY) {
			// �����Ƕ�Զ�Ĺ�ϵ����֧�ִ�����ϵ����
			$this->_error('relation_link_not_support_type');
			return false;
		}

		// ������ģ�͵ķ��������Ϣ
		$model = & m($relation_info['model']);
		$be_related = $model->getRelation($relation_info['reverse']);
		if ($be_related['type'] !== HAS_AND_BELONGS_TO_MANY) {
			$this->_error('be_related_link_not_support_type');
			return false;
		}

		// ��ʼ�����ӽ��в���
		switch ($action) {
			// ��������
			case 'create':
				$data = array();

				// �γ�һ��ͳһ��array(1, 2, 3)�������
				if (is_numeric($ids)) {
					$ids = array($ids);
				} elseif (is_string($ids)) {
					$ids = explode(',', $ids);
					array_unique($ids);
				}
				$ext_limit_data = is_array($relation_info['ext_limit']) ? $relation_info['ext_limit'] : array();
				// ��������з�������������array(1, 2, 3)��ģ�����Ϊָֻ���˱������������ֵ
				foreach ($ids as $key => $value) {
					$related_data = array();

					// �����ڹ������е����ֵ
					$related_data[$relation_info['foreign_key']] = $id;

					// ָ���˳�������ֵ�������ֵ
					if (is_array($value)) {
						// ����ڹ������е����ֵ
						$related_data[$be_related['foreign_key']] = intval($key);

						// ��������������չ���ݺϲ�
						$related_data = array_merge($related_data, $value);
					} else { //��ָ���˱������������ֵ
						// ����ڹ������е����ֵ
						$related_data[$be_related['foreign_key']] = intval($value);
					}

					// �������
					$data[] = array_merge($related_data, $ext_limit_data);
				}
				$insert_info = $this->_getInsertInfo($data);

				// ��������
				return $this->db->query("REPLACE INTO {$this->_prefix}{$relation_info['middle_table']}{$insert_info['fields']} VALUES{$insert_info['values']}");
				break;
			case 'update':
				if (empty($update_values)) {
					return false;
				}
				if (is_string($update_values)) {
					$update_fields = $update_values;
				} elseif (is_array($update_values)) {
					$update_fields = array();
					foreach ($update_values as $_field => $_value) {
						$update_fields[] = "{$_field}='{$_value}'";
					}
					$update_fields = implode(',', $update_fields);
				} else {
					return false;
				}

				return $this->db->query("UPDATE {$this->_prefix}{$relation_info['middle_table']} SET {$update_fields} WHERE {$relation_info['foreign_key']} = {$id} AND {$be_related['foreign_key']} " . db_create_in($ids));
				break;

			// ɾ������
			case 'drop':
				// �����֣�����Ϊ��ɾ��������$id�й����Ĺ�ϵ
				if (is_numeric($id)) {
					// ����������һ��ֵ�������ָ��������ģ�͵�����ֵ
					$where = "{$relation_info['foreign_key']}=" . $id;

					// ָ���˱�����ģ�͵�����ֵ���򽫸��޶���������
					$where .=!empty($ids) ? " AND {$be_related['foreign_key']} " . db_create_in($ids) : '';
				} elseif (is_array($id)) {  //��һ�����飬����Ϊɾ��������$id�б��е������й�ϵ�Ĺ�ϵ
					// ��������������һ�����飬���ʾҪɾ���������Ϊָ�����ϵĹ���������������£��޷�ָ��������ģ�͵�����ֵ
					$where = "{$relation_info['foreign_key']} " . db_create_in($id);
				} elseif (is_string($id)) {
					// ��һ���ַ���������Ϊ���Զ�������������Ʋ���
					$where = $id;
				}

				$where .= is_array($relation_info['ext_limit']) ? ' AND ' . $this->_getExtLimit($relation_info['ext_limit']) : '';

				return $this->db->query("DELETE FROM {$this->_prefix}{$relation_info['middle_table']} WHERE {$where}");
				break;
		}

		return true;
	}

	/**
	 * �򻯸��²���
	 *
	 * @author 8264TEAM
	 * @param array $edit_data
	 * @param mixed $conditions
	 * @return bool
	 */
	function edit($conditions, $edit_data) {
		if (empty($edit_data)) {
			return false;
		}
		$edit_data = $this->_valid($edit_data);
		if (!$edit_data) {
			return false;
		}
		$edit_fields = $this->_getSetFields($edit_data);
		$conditions = $this->_getConditions($conditions, false);
		$this->db->query("UPDATE {$this->table} SET {$edit_fields}{$conditions}");
		return $this->db->affected_rows();
	}

	/**
	 * ��ɾ����¼����
	 *
	 * @author 8264TEAM
	 * @param mixed $ids
	 * @return int
	 */
	function drop($conditions, $fields = '') {
		if (empty($conditions)) {
			return;
		}
		if ($conditions === DROP_CONDITION_TRUNCATE) {
			$conditions = '';
		} else {
			$conditions = $this->_getConditions($conditions, false);
		}

		// ����ɾ���ļ�¼������ֵ�����ڹ���ɾ��ʱʹ��
		$fields && $fields = ',' . $fields;

		// ���Ǹ�ƿ������ɾ�����������ǳ���ʱ��������
		$this->_saveDroppedData("SELECT {$this->prikey}{$fields} FROM {$this->table}{$conditions}");

		$droped_data = $this->getDroppedData();
		if (empty($droped_data)) {
			return 0;
		}

		$this->db->query("DELETE FROM {$this->table}{$conditions}");
		$affectedRows = $this->db->affected_rows();
		if ($affectedRows > 0) {
			// ɾ����������
			$this->dropDependentData(array_keys($droped_data));
		}

		return $affectedRows;
	}

	/**
	 * ɾ����������
	 *
	 * @author 8264TEAM
	 * @param mixed $keys ���������ֵ����
	 * @return bool
	 */
	function dropDependentData($keys) {
		if (empty($keys)) {
			$this->_error('keys_is_empty');

			return false;
		}
		if (is_numeric($keys)) {
			$keys = array($keys);
		} elseif (is_string($keys)) {
			$keys = explode(',', $keys);
		}

		// ��ȡ���й�ϵ
		$relation = $this->getRelation();
		if (empty($relation)) {
			return true;
		}

		// ���ν���ϵ�е���������ɾ��
		foreach ($relation as $relation_name => $relation_info) {
			// ����Ƕ�Զ��ϵ����ֻ����������е�����
			if ($relation_info['type'] === HAS_AND_BELONGS_TO_MANY) {
				$this->unlinkRelation($relation_name, $keys);
			} elseif ($relation_info['dependent'] && $relation_info['type'] !== BELONGS_TO) {
				// �����ָ����dependent�����ԣ������dropɾ��֮
				if ($relation_info['model'] != $this->_name) {
					// ��������ģ�Ͳ��Ǳ�����ֱ��ʹ��mȡ��ģ�Ͷ���
					$model = & m($relation_info['model']);
				} else {
					// ����Ҫ����һ���µ�ģ�Ͷ����Ա������ʱ����Ӱ��
					$model = & m($relation_info['model'], array(), true);
				}

				// ��ʼɾ��
				$ext_limit = (isset($relation_info['ext_limit']) && $relation_info['ext_limit']) ? ' AND ' . $this->_getExtLimit($relation_info['ext_limit']) : '';

				// Ĭ���޶���Ϊ����
				$limit_keys = $keys;

				// ������������һ��һӵ�еĹ�ϵ���趨�˲ο���ʱ��˵���������ֵ���Ǳ��������ֵ�����ǲο�����ֵ������޶����ǲο�����Ҫ�ҳ��ο�����ֵ�ļ���
				if ($relation_info['type'] == HAS_ONE && isset($relation_info['refer_key'])) {
					// �ҳ��ο���ֵ�ļ���,����Ĳο���ֵ����
					$limit_keys = $this->db->getCol("SELECT DISTINCT {$relation_info['refer_key']} FROM {$this->table} WHERE {$this->prikey} " . db_create_in($keys));
					if ($limit_keys === false) {
						continue;
					}
				}

				// �������=�޶���(Ĭ��Ϊ����)�Ķ�ɾ��
				$conditions = "{$relation_info['foreign_key']} " . db_create_in($limit_keys) . $ext_limit;

				// ɾ������
				$model->drop($conditions);
			}
		}
	}

	/**
	 * ��ȡ��չ����
	 *
	 * @author 8264TEAM
	 * @param array $ext_limit
	 * @param  string $alias
	 * @return string
	 */
	function _getExtLimit($ext_limit, $alias = null) {
		if (!$ext_limit) {
			return;
		}
		$str = '';
		$pre = '';
		if ($alias) {
			$pre = "{$alias}.";
		}
		foreach ($ext_limit as $_k => $_v) {
			$str .= $str == '' ? " {$pre}{$_k} = '{$_v}'" : " AND {$pre}{$_k} = '{$_v}'";
		}

		return $str;
	}

	/**
	 * ��ȡʱʱ�������ɾ����¼
	 *
	 * @author 8264TEAM
	 * @return array
	 */
	function getDroppedData() {
		return $this->_dropped_data;
	}

	/**
	 * ��ȡͳ����
	 *
	 * @author 8264TEAM
	 * @return int
	 */
	function getCount() {
		return $this->_last_query_count;
	}

	/**
	 * ��ʱ������ɾ���ļ�¼����
	 *
	 * @author 8264TEAM
	 * @param string $sql
	 * @return void
	 */
	function _saveDroppedData($sql) {
		$this->_dropped_data = $this->db->getAllWithIndex($sql, $this->prikey);
	}

	/**
	 * ���²�ѯͳ����
	 *
	 * @author 8264TEAM
	 * @param string $sql
	 * @return void
	 */
	function _updateLastQueryCount($sql) {
		$this->_last_query_count = $this->db->getOne($sql);
	}

	/**
	 * ��ȡ�������
	 *
	 * @author 8264TEAM
	 * @param mixed $conditions
	 * @return string
	 */
	function _getConditions($conditions, $if_add_alias = false) {
		$alias = '';
		if ($if_add_alias) {
			$alias = $this->alias . '.';
		}
		if (is_numeric($conditions)) {
			// �����һ�����ֻ������ַ���������Ϊ��������ֵ
			return " WHERE {$alias}{$this->prikey} = {$conditions}";
		} elseif (is_string($conditions)) {
			// ������ַ���������Ϊ����SQL�Զ�������
			if (substr($conditions, 0, 6) == 'index:') {
				$value = substr($conditions, 6);
				return $value ? " WHERE {$alias}{$this->prikey}='{$value}'" : '';
			} else {
				return $conditions ? ' WHERE ' . $conditions : '';
			}
		} elseif (is_array($conditions)) {
			// ��������飬����Ϊ����һ����������
			if (empty($conditions)) {
				return '';
			}
			foreach ($conditions as $_k => $_v) {
				if (!$_v) {
					unset($conditions[$_k]);
				}
			}
			$conditions = array_unique($conditions);

			return ' WHERE ' . $alias . $this->prikey . ' ' . db_create_in($conditions);
		} elseif (is_null($conditions)) {
			return '';
		}
	}

	/**
	 * ��ȡ�����ֶ�
	 *
	 * @author 8264TEAM
	 * @param array $data
	 * @return string
	 */
	function _getSetFields($data) {
		if (!is_array($data)) {
			return $data;
		}
		$fields = array();
		foreach ($data as $_k => $_v) {
			!is_array($_v) && $fields[] = "{$_k}='{$_v}'";
		}

		return implode(',', $fields);
	}

	/**
	 * ��ȡ��ѯʱ���ֶ��б�
	 *
	 * @author 8264TEAM
	 * @param string $fields Ҫ��ȡ���ֶ���
	 * @return string ��������ֶ���
	 */
	function getRealFields($fields) {
		$fields = preg_replace('/([a-zA-Z0-9_]+)\.([a-zA-Z0-9_*]+)/e', "\$this->_getFieldTable('\\1') . '.\\2'", $fields);
		return $fields;
	}

	/**
	 * �����ֶ�����
	 *
	 * @author 8264TEAM
	 * @param string $owner ���������
	 * @return string ���������
	 */
	function _getFieldTable($owner) {
		// �����this��ֱ�ӷ��ظ�ģ�ͱ���
		if ($owner == 'this') {
			return $this->alias;
		} else {
			// ��û�и�ģ�Ͷ�����ԭ������
			$m = m($owner);
			if ($m === false) {
				return $owner;
			}
			// ���ظ�ģ�ͱ���
			return $m->alias;
		}
	}

	/**
	 * ��ȡ���������SQL
	 *
	 * @author 8264TEAM
	 * @param array $data
	 * @return string
	 */
	function _getInsertInfo($data) {
		reset($data);
		$fields = array();
		$values = array();
		$length = 1;
		if (key($data) === 0 && is_array($data[0])) {
			$length = count($data);
			foreach ($data as $_k => $_v) {
				foreach ($_v as $_f => $_fv) {
					$is_array = is_array($_fv);
					($_k == 0 && !$is_array) && $fields[] = $_f;
					!$is_array && $values[$_k][] = "'{$_fv}'";
				}
				$values[$_k] = '(' . implode(',', $values[$_k]) . ')';
			}
		} else {
			foreach ($data as $_k => $_v) {
				$is_array = is_array($_v);
				!$is_array && $fields[] = $_k;
				!$is_array && $values[] = "'{$_v}'";
			}
			$values = '(' . implode(',', $values) . ')';
		}
		$fields = '(' . implode(',', $fields) . ')';
		is_array($values) && $values = implode(',', $values);

		return compact('fields', 'values', 'length');
	}

	/**
	 * ��֤���ݺϷ��ԣ���ֻ��֤vrule��ָ�����ֶΣ�����ֻ��$data����������ֵʱ����֤
	 *
	 * @author 8264TEAM
	 * @param array $data
	 * @return mixed
	 */
	function _valid($data) {
		if (empty($this->_autov) || empty($data) || !is_array($data)) {
			return $data;
		}
		$max = $filter = $reg = $default = $valid = '';
		reset($data);
		$is_multi = (key($data) === 0 && is_array($data[0]));
		if (!$is_multi) {
			$data = array($data);
		}
		foreach ($this->_autov as $_k => $_v) {
			if (is_array($_v)) {
				$required = (isset($_v['required']) && $_v['required']) ? true : false;
				$type = isset($this->_autov[$_k]['type']) ? $this->_autov[$_k]['type'] : 'string';
				$min = isset($this->_autov[$_k]['min']) ? $this->_autov[$_k]['min'] : 0;
				$max = isset($this->_autov[$_k]['max']) ? $this->_autov[$_k]['max'] : 0;
				$filter = isset($this->_autov[$_k]['filter']) ? $this->_autov[$_k]['filter'] : '';
				$valid = isset($this->_autov[$_k]['valid']) ? $this->_autov[$_k]['valid'] : '';
				$reg = isset($this->_autov[$_k]['reg']) ? $this->_autov[$_k]['reg'] : '';
				$default = isset($this->_autov[$_k]['default']) ? $this->_autov[$_k]['default'] : '';
			} else {
				preg_match_all('/([a-z]+)(\((\d+),(\d+)\))?/', $_v, $result);
				$type = $result[1];
				$min = $result[3];
				$max = $result[4];
			}
			foreach ($data as $_sk => $_sd) {
				$has_set = isset($data[$_sk][$_k]);
				if (!$has_set) {
					continue;
				}

				// �޸���д0ʱ���϶�Ϊ������û��д��������� tina 20130417
				if ($required && $data[$_sk][$_k] == '' && $data[$_sk][$_k] !== 0) {
					$this->_error("required_field", $_k);

					return false;
				}

				// ���е��ˣ�˵�����ֶβ��Ǳ��������Ϊ��

				$value = $data[$_sk][$_k];

				// Ĭ��ֵ
				if (!$value && $default) {
					$data[$_sk][$_k] = function_exists($default) ? $default() : $default;
					continue;
				}

				// �����ǿ�ֵ����û��Ҫ������֤���ȣ������Զ���͹��ˣ���Ϊ���Ѿ���һ����ֵ��
				if (!$value) {
					continue;
				}

				// ��С|��������
				if ($type == 'string') {
					$strlen = strlen($value);
					if ($min != 0 && $strlen < $min) {
						$this->_error('autov_length_lt_min', $_k);
						return false;
					}
					if ($max != 0 && $strlen > $max) {
						$this->_error('autov_length_gt_max', $_k);
						return false;
					}
				} else {
					if ($min != 0 && $value < $min) {
						$this->_error('autov_value_lt_min', $_k);
						return false;
					}
					if ($max != 0 && $value > $max) {
						$this->_error('autov_value_gt_max', $_k);
						return false;
					}
				}

				// ����
				if ($reg) {
					if (!preg_match($reg, $value)) {
						$this->_error('check_match_error', $_k);
						return false;
					}
				}

				// �Զ�����֤
				if ($valid && function_exists($valid)) {
					$result = $valid($value);
					if ($result !== true) {
						$this->_error($result);
						return false;
					}
				}

				// ����
				if ($filter) {
					$funs = explode(',', $filter);
					foreach ($funs as $fun) {
						function_exists($fun) && $value = $fun($value);
					}
					$data[$_sk][$_k] = $value;
				}
			}
		}
		if (!$is_multi) {
			$data = $data[0];
		}

		return $data;
	}

	/**
	 * ��ʼ����ѯ����
	 *
	 * @author 8264TEAM
	 * @param array $params ��ѯ����
	 * @return array ��ȫ���Ĳ�ѯ����
	 */
	function _initFindParams($params) {
		$arr = array(
			'include' => array(),
			'join' => '',
			'conditions' => '',
			'order' => '',
			'fields' => '',
			'limit' => '',
			'count' => false,
			'index_key' => $this->prikey,
		);
		// �������Ĳ�ѯ���������飬��ȫĬ�ϲ�ѯ������������ַ�������Ϊ�ǲ�ѯ����where����
		if (is_array($params)) {
			return array_merge($arr, $params);
		} else {
			$arr['conditions'] = $params;
			return $arr;
		}
	}

	/**
	 * ��ָ���ķ�ʽLEFT JOINָ����ϵ�ı�
	 *
	 * @author 8264TEAM
	 * @param string $table
	 * @param string $join_object
	 * @return string
	 */
	function _joinModel(&$table, $join) {
		$result = false;
		if (empty($join)) {
			return false;
		}

		// ��ȡҪ�����Ĺ�ϵ��
		$relation = preg_split('/,\s*/', $join);
		array_walk($relation, create_function('&$item, $key', '$item=trim($item);'));

		foreach ($relation as $_r) {
			// ��ȡ��ϵ��Ϣ���ж�ÿ��ģ�������Ƿ��д�relation
			if (!($_mi = $this->getRelation($_r))) {
				// û�иù�ϵ������
				continue;
			}

			// ������ϵΪ$_mi��ģ��
			$join_string = $this->_getJoinString($_mi);
			if ($join_string) {
				// ����
				$table .= $join_string;
				$result = true;
			}
		}

		return $result;
	}

	function _getJoinString($relation_info) {
		switch ($relation_info['type']) {
			case HAS_ONE:
				$model = & m($relation_info['model']);

				// ��������
				$ext_limit = '';
				// ����ϵ�ǰ��������ı�������Ϊ�п��ܴ��ڶ��JOIN�����ҿ��ܴ���ͬ���ֶΡ�
				$relation_info['ext_limit'] && $ext_limit = ' AND ' . $this->_getExtLimit($relation_info['ext_limit'], $model->alias);

				// ��ȡ�ο�����Ĭ���Ǳ�������(ֱ��ӵ��)������Ϊ���ӵ��
				$refer_key = isset($relation_info['refer_key']) ? $relation_info['refer_key'] : $this->prikey;

				// ����ο���=������
				return " LEFT JOIN {$model->table} {$model->alias} ON {$this->alias}.{$refer_key}={$model->alias}.{$relation_info['foreign_key']}{$ext_limit}";
				break;
			case BELONGS_TO:
				// ���ڹ�ϵ��ӵ����һ������Ĺ�ϵ
				$model = & m($relation_info['model']);
				$be_related = $model->getRelation($relation_info['reverse']);
				if (empty($be_related)) {
					// û���ҵ������ϵ
					$this->_error('no_reverse_be_found', $relation_info['model']);

					return '';
				}
				$ext_limit = '';
				!empty($relation_info['ext_limit']) && $ext_limit = ' AND ' . $this->_getExtLimit($relation_info['ext_limit'], $this->alias);
				// ��ȡ�ο�����Ĭ�����������
				$refer_key = isset($be_related['refer_key']) ? $be_related['refer_key'] : $model->prikey;

				// �������=���ο���
				return " LEFT JOIN {$model->table} {$model->alias} ON {$this->alias}.{$be_related['foreign_key']} = {$model->alias}.{$refer_key}{$ext_limit}";
				break;
			case HAS_AND_BELONGS_TO_MANY:
				// �����м����������=�м�����
				$malias = isset($relation_info['alias']) ? $relation_info['alias'] : $relation_info['middle_table'];
				$ext_limit = '';
				$relation_info['ext_limit'] && $ext_limit = ' AND ' . $this->_getExtLimit($relation_info['ext_limit'], $malias);
				return " LEFT JOIN {$this->_prefix}{$relation_info['middle_table']} {$malias} ON {$this->alias}.{$this->prikey} = {$malias}.{$relation_info['foreign_key']}{$ext_limit}";
				break;
		}
	}

	/**
	 * ��ȡ��ϵ��Ϣ
	 *
	 * @author 8264TEAM
	 * @param string $relation_name
	 * @return array
	 */
	function getRelation($relation_name = null) {
		return !is_null($relation_name) ? $this->_relation[$relation_name] : $this->_relation;
	}

	/**
	 * ��ȡָ����ϵ���͵Ĺ�����Ϣ
	 *
	 * @author 8264TEAM
	 * @param int $relation
	 * @return array
	 */
	protected function getRelationByType($relation) {
		// �������й�ϵ
		if (empty($relation)) {
			return $this->_relation;
		}
		$arr = array();
		foreach ($this->_relation as $relation_name => $relation_info) {
			if ($relation_info['relation'] == $relation) {
				$arr[$relation_name] = $relation_info;
			}
		}
		return $arr;
	}

	/**
	 * �������
	 *
	 * @author 8264TEAM
	 * @param string $relation_name ��ϵ����
	 * @param array $assoc_data ����������
	 * @param array $pri_data ��������
	 * @return array
	 */
	private function assemble($relation_name, $assoc_data, $pri_data) {
		if (empty($pri_data) || empty($assoc_data)) {
			$this->_error('assemble_data_empty');
			return $pri_data;
		}

		// ��ȡ��ϵ��Ϣ
		$relation_info = $this->getRelation($relation_name);
		$model = & m($relation_info['model']);

		// ѭ�������ݼ�
		foreach ($pri_data as $pk => $pd) {
			// ѭ�������ݼ�
			foreach ($assoc_data as $ak => $ad) {
				// �����������ֵ�����ĵ����ֵ���ʱ�������������ݼ��뵽���������м�Ϊ$model->alias��������
				if ($pd[$this->prikey] == $ad[$relation_info['foreign_key']]) {
					$pd[$model->alias][$ak] = $ad;
					// ����ѭ������
					unset($assoc_data[$ak]);
				}
			}
			$pri_data[$pk] = $pd;
		}
		return $pri_data;
	}

	/**
	 * ��֤���б����ֶ��Ƿ���ȫ
	 *
	 * @author 8264TEAM
	 * @param array $data Ҫ��������ݼ�
	 * @return boolean true���ǣ�false����
	 */
	private function dataEnough($data) {
		$required_fields = $this->getRequiredFields();
		if (empty($required_fields)) {
			return true;
		}
		$is_multi = (key($data) === 0 && is_array($data[0]));
		foreach ($required_fields as $field) {
			if ($is_multi) {
				foreach ($data as $key => $value) {
					if (!isset($value[$field])) {
						$this->_error('data_not_enough', $field);
						return false;
					}
				}
			} else {
				if (!isset($data[$field])) {
					$this->_error('data_not_enough', $field);
					return false;
				}
			}
		}
		return true;
	}

	/**
	 * ��ȡ������ֶ��б�
	 *
	 * @author 8264TEAM
	 * @return array �����ֶ��б�
	 */
	private function getRequiredFields() {
		$fields = array();
		if (is_array($this->_autov)) {
			foreach ($this->_autov as $key => $value) {
				if (isset($value['required']) && $value['required']) {
					$fields[] = $key;
				}
			}
		}
		return $fields;
	}

	/**
	 * ����ͳ��
	 */
	function getOne($sql) {
		return $this->db->getOne($sql);
	}

	function getRow($sql) {
		return $this->db->getRow($sql);
	}

	function getCol($sql) {
		return $this->db->getCol($sql);
	}

	function getAll($sql) {
		return $this->db->getAll($sql);
	}

}

?>
