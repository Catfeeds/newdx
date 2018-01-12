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
			$tips = "日志类型";
			break;
		case 'search_yearmonth':
			$values = $logs->get_logs_set("key_ym_" . $_GET['key']);
			$tips = "年月";
			break;
		case 'search_day':
			$values = $logs->get_logs_set("key_d_" . $_GET['key']);
			$tips = "日期";
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
			echo "删除类型:[" . $_GET['type'] . "] ";
			echo ! empty($_GET['yearmonth']) ? "年月[" . substr($_GET['yearmonth'], -6) . "]" : "所有年月 ";
			echo ! empty($_GET['day']) ? "日期[" . substr($_GET['day'], -2) . "]" : " 所有日期";
			if ($logs->del_logs_type($_GET['type'], substr($_GET['yearmonth'], -6), substr($_GET['day'], -2))) {
				echo "成功！";
			} else {
				echo "失败！";
			}
			exit;
		default:
			$values = '';
			$tips = "相关项";
			break;
	}
	if ($havenext) {
		$return = "<option value='" . ($_GET['method'] == 'search_type' ? 'default' : '') . "'>请选择{$tips}</option>";
		if (empty($values))
			$values = array('当前没有可供选择项');
		sort($values, SORT_NUMERIC);
		foreach ($values as $val) {
			$return .= "<option value='" . (empty($_GET['key']) ? '' : $_GET['key'] . "_") . "{$val}'>{$val}</option>";
		}
	} else {
		if ($more) {
			$return .= "<table style='width:90%'><tr>";
			$return .= $nowpage > 1 ? "<td width='33%' class='prev' page='" . ($nowpage - 1) . "'>点击第" . ($nowpage - 1) . "页</td>" : "<td width='33%' ></td>";
			$return .= '<td class="maxpage" width="33%">共' . ceil($maxlen / $perpage) . '页</td>';
			$return .= $nowpage < ceil($maxlen / $perpage) ? "<td width='33%' class='next' page='" . ($nowpage + 1) . "'>点击第" . ($nowpage + 1) . "页</td>" : "<td width='33%' ></td>";
			$return .= "</tr></table>";
		}
		$return .= <<< EOF
    <table style="width: 90%;">
    <tr class="header">
        <th width="15%">年月</th>
        <th width="75%">日期</th>
    </tr>
EOF;
		if (empty($values)) {
			$return .= <<< EOF
    <tr>
        <td colspan='2'>当前没有任何信息</td>
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
			$return .= $nowpage > 1 ? "<td width='33%' class='prev' page='" . ($nowpage - 1) . "'>点击第" . ($nowpage - 1) . "页</td>" : "<td width='33%' ></td>";
			$return .= '<td class="maxpage" width="33%">共' . ceil($maxlen / $perpage) . '页</td>';
			$return .= $nowpage < ceil($maxlen / $perpage) ? "<td width='33%' class='next' page='" . ($nowpage + 1) . "'>点击第" . ($nowpage + 1) . "页</td>" : "<td width='33%' ></td>";
			$return .= "</tr></table>";
		}
	}
	echo $return;
}
?>
