<?php

/**
 * @author JiangHong
 * @copyright 2015
 */
require_once DISCUZ_ROOT . './api/record/recordmodel.class.php';
$todaytime = strtotime(date('Y-m-d', time()));
$starttime = $_G['gp_starttime'] ? $_G['gp_starttime'] : $todaytime;
$endtime = $_G['gp_endtime'] ? $_G['gp_endtime'] : time();
$daytitle = !$_G['gp_starttime'] ? "今日" : ($starttime == 1 ? "所有" : date('Y-m-d H时', $starttime) . " ~ " . date('Y-m-d H时', $endtime));
$where = "`time` >= {$starttime} AND `time` <= {$endtime}";
$data = $counts = array();
$q = DB::query("SELECT fid, name FROM " . DB::table('forum_forum') . " WHERE type = 'forum'");
$fidname = array();
while($vv = DB::fetch($q))
{
	$fidname[$vv['fid']] = $vv['name'];
}
$sql = "SELECT count(*) as count, " . recordmodel::_FID . " FROM " . DB::table(recordmodel::_TABLENAME_NOPRE) . " WHERE {$where} GROUP BY " . recordmodel::_FID . " ORDER BY count DESC";
$q = DB::query($sql);
$first = true;
while($value = DB::fetch($q))
{
	$keyname = $value[recordmodel::_FID] ? ($fidname[$value[recordmodel::_FID]] ? $fidname[$value[recordmodel::_FID]] : 'fid:' . $value[recordmodel::_FID]) : '非版块';
	//$data[$keyname] = $value['count'];
	$showpie[] = "['{$keyname}', {$value[count]}]";
}
$baseurl = $_G['config']['web']['forum'] . "admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=threadshow";
?>
<ul>
	<li>
		<a href="<?php echo $baseurl; ?>">今日</a>
		<a href="<?php echo $baseurl; ?>&starttime=<?php echo strtotime(date('Y-m-d', strtotime('-1day'))); ?>&endtime=<?php echo strtotime('today'); ?>">昨日</a>
		<a href="<?php echo $baseurl; ?>&starttime=<?php echo strtotime(date('Y-m-d', strtotime('-3day'))); ?>">近三日</a>
		<a href="<?php echo $baseurl; ?>&starttime=<?php echo strtotime(date('Y-m-d', strtotime('-7day'))); ?>">近七日</a>
		<a href="<?php echo $baseurl; ?>&starttime=<?php echo strtotime(date('Y-m-d', strtotime('-1month'))); ?>">近一月</a>
		<a href="<?php echo $baseurl; ?>&starttime=1">所有</a>
	</li>
</ul>
<script src="<?php echo $_G['config']['web']['forum']; ?>static/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $_G['config']['web']['forum']; ?>source/plugin/interests/js/highcharts.js"></script>
<script src="<?php echo $_G['config']['web']['forum']; ?>source/plugin/interests/js/exporting.js"></script>
<script>
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '版块浏览分析 - <?php echo $daytitle; ?>'
        },
        xAxis: {
            type: 'category',
            labels: {
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '访问次数 (次)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '访问量: <b>{point.y:.1f} 次</b>'
        },
        series: [{
            name: 'Population',
            data: [<?php echo implode(',', $showpie); ?>],
            dataLabels: {
                enabled: false,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>
<div id="container" style="width: 100%; height: 600px; margin: 0 auto"></div>