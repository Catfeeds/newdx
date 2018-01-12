<?php
/**
 * @author blog.anchen8.net
 * @copyright 2012
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

if ($_GET['inajax'] && ! empty($_GET['method'])) {
	require_once DISCUZ_ROOT . "./source/plugin/logs/logs.class.php";
	$logs = new logs;
	$havenext = true;
	$nowpage = max(intval($_GET['nowpage']), 1);
	$perpage = 50;
	$start = ($nowpage - 1) * $perpage;
	$more = false;
	switch ($_GET['method']) {
		case 'search_type':
			$values = $logs->get_logs_set('type');
			$tips = "��־����";
			break;
		case 'search_yearmonth':
			$values = $logs->get_logs_set("key_ym_" . $_GET['key']);
			$tips = "����";
			break;
		case 'search_day':
			$values = $logs->get_logs_set("key_d_" . $_GET['key']);
			$tips = "����";
			break;
		case 'search_info':
			$values = $logs->read_logs($_GET['key']);
			$havenext = false;
			break;
		case 'getinfo':
			$day = substr($_GET['day'], -2);
			if (! $day) {
				$values = $logs->get_logs_type($_GET['type'], substr($_GET['yearmonth'], -6), $day);
			} else {
				$values = $logs->read_logs($_GET['day'], $start, $perpage * $nowpage);
				$maxlen = $logs->getlogslen($_GET['day']);
				if ($maxlen > ($nowpage * $perpage) || $nowpage > 1)
					$more = true;
			}
			$havenext = false;
			break;
		case 'del_logs':
			echo "ɾ������:[" . $_GET['type'] . "] ";
			echo ! empty($_GET['yearmonth']) ? "����[" . substr($_GET['yearmonth'], -6) . "]" : "�������� ";
			echo ! empty($_GET['day']) ? "����[" . substr($_GET['day'], -2) . "]" : " ��������";
			if ($logs->del_logs_type($_GET['type'], substr($_GET['yearmonth'], -6), substr($_GET['day'], -2))) {
				echo "�ɹ���";
			} else {
				echo "ʧ�ܣ�";
			}
			exit;
		default:
			$values = '';
			$tips = "�����";
			break;
	}
	if ($havenext) {
		$return = "<option value='" . ($_GET['method'] == 'search_type' ? 'default' : '') . "'>��ѡ��{$tips}</option>";
		if (empty($values))
			$values = array('��ǰû�пɹ�ѡ����');
		sort($values, SORT_NUMERIC);
		foreach ($values as $val) {
			$return .= "<option value='" . (empty($_GET['key']) ? '' : $_GET['key'] . "_") . "{$val}'>{$val}</option>";
		}
	} else {
		if ($more) {
			$return .= "<table style='width:90%'><tr>";
			$return .= $nowpage > 1 ? "<td width='33%' class='prev' page='" . ($nowpage - 1) . "'>�����" . ($nowpage - 1) . "ҳ</td>" : "<td width='33%' ></td>";
			$return .= '<td class="maxpage" width="33%">��' . ceil($maxlen / $perpage) . 'ҳ</td>';
			$return .= $nowpage < ceil($maxlen / $perpage) ? "<td width='33%' class='next' page='" . ($nowpage + 1) . "'>�����" . ($nowpage + 1) . "ҳ</td>" : "<td width='33%' ></td>";
			$return .= "</tr></table>";
		}
		$return .= <<< EOF
    <table style="width: 90%;">
    <tr class="header">
        <th width="15%">����</th>
        <th width="75%">����</th>
    </tr>
EOF;
		if (empty($values)) {
			$return .= <<< EOF
    <tr>
        <td colspan='2'>��ǰû���κ���Ϣ</td>
    </tr>
EOF;
		} else {
			foreach ($values as $values) {
				preg_match('/time:((?:\d{2}:){2}\d{2})\s*---\s*/i', $values, $match);
				$time = $match[1];
				if (substr($time, 0, 2) == date('H', time())) {
					$time = "<font color=red>" . $time . "</font>";
				}
				$info = str_replace($match[0], '', $values);
				$return .= <<< EOF
    <tr>
        <td width="15%"><p>$time</p></td>
        <td width="75%" style="max-width: 1100px;"><p>$info</p></td>
    </tr>
EOF;
			}
		}
		$return .= <<< EOF
    </table>
EOF;
		if ($more) {
			$return .= "<table style='width:90%'><tr>";
			$return .= $nowpage > 1 ? "<td width='33%' class='prev' page='" . ($nowpage - 1) . "'>�����" . ($nowpage - 1) . "ҳ</td>" : "<td width='33%' ></td>";
			$return .= '<td class="maxpage" width="33%">��' . ceil($maxlen / $perpage) . 'ҳ</td>';
			$return .= $nowpage < ceil($maxlen / $perpage) ? "<td width='33%' class='next' page='" . ($nowpage + 1) . "'>�����" . ($nowpage + 1) . "ҳ</td>" : "<td width='33%' ></td>";
			$return .= "</tr></table>";
		}
	}
	echo $return;
}
?>
