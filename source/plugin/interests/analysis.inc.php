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
$sql = "SELECT count(*) as count, " . recordmodel::_BROWSER_NAME . " FROM " . DB::table(recordmodel::_TABLENAME_NOPRE) . " WHERE {$where} GROUP BY " . recordmodel::_BROWSER_NAME . " ORDER BY count DESC";
$q = DB::query($sql);
$first = true;
while($value = DB::fetch($q))
{
	$keyname = $value[recordmodel::_BROWSER_NAME] ? $value[recordmodel::_BROWSER_NAME] : 'Others';
	//$data[$keyname] = $value['count'];
	$showpie[] = "['{$keyname}', {$value[count]}]";
}
$baseurl = $_G['config']['web']['forum'] . "admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=analysis";
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
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '用户浏览器分布图 - <?php echo $daytitle; ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: '占有率',
            data: [<?php echo implode(',', $showpie); ?>]
        }]
    });
});
</script>
<div id="container" style="width: 800px; height: 600px; margin: 0 auto"></div>