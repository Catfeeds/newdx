<?php

/**
 * @author JiangHong
 * @copyright 2015
 */
require_once DISCUZ_ROOT . './api/record/recordmodel.class.php';
$todaytime = strtotime(date('Y-m-d', time()));
$starttime = $_G['gp_starttime'] ? $_G['gp_starttime'] : $todaytime;
$endtime = $_G['gp_endtime'] ? $_G['gp_endtime'] : time();
$daytitle = !$_G['gp_starttime'] ? "����" : ($starttime == 1 ? "����" : date('Y-m-d Hʱ', $starttime) . " ~ " . date('Y-m-d Hʱ', $endtime));
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
		<a href="<?php echo $baseurl; ?>">����</a>
		<a href="<?php echo $baseurl; ?>&starttime=<?php echo strtotime(date('Y-m-d', strtotime('-1day'))); ?>&endtime=<?php echo strtotime('today'); ?>">����</a>
		<a href="<?php echo $baseurl; ?>&starttime=<?php echo strtotime(date('Y-m-d', strtotime('-3day'))); ?>">������</a>
		<a href="<?php echo $baseurl; ?>&starttime=<?php echo strtotime(date('Y-m-d', strtotime('-7day'))); ?>">������</a>
		<a href="<?php echo $baseurl; ?>&starttime=<?php echo strtotime(date('Y-m-d', strtotime('-1month'))); ?>">��һ��</a>
		<a href="<?php echo $baseurl; ?>&starttime=1">����</a>
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
            text: '�û�������ֲ�ͼ - <?php echo $daytitle; ?>'
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
            name: 'ռ����',
            data: [<?php echo implode(',', $showpie); ?>]
        }]
    });
});
</script>
<div id="container" style="width: 800px; height: 600px; margin: 0 auto"></div>