<?php
require_once './banip.php';
if (!in_array($_GET['ctl'], array("provinces", "more_city", "city", "history", "forecast", "index", "entry", "get_citylist_by_ajax"))) {
    exit("hacker attack");
}
define('APPTYPEID', 9);
define('CURSCRIPT', 'weather');
define('WEATHERAPIKEY', '142eef0f45cb364ade3cf18e007edfb6');
define('APIURL', 'http://m.hd.8264.com/index.php');
require './source/class/class_core.php';
$discuz = &discuz_core::instance();
$discuz->init();

//天气的缓存改为使用11511端口,注意master线上版本中配置必须为11511,rebuild可以根据开发环境中端口在本地做相应更改
$memory = &discuz_memcache::instance("10.28.206.72:11511", 1);
if (!$memory->enable) {
    exit('Cache system error.');
}
//缓存更改结束

if ($_GET['redirect'] == "weather") {
    include_once DISCUZ_ROOT . './source/plugin/forumoption/include.php';
    $ip = $_G["clientip"];
    //$ip = "111.160.225.106";
    $zaiwaiCN = $forumOption->getStateByIp($ip);
    if (!empty($zaiwaiCN)) {
        $cur_location = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_spell_by_name&stoken=" . generate_stoken("get_weather_spell_by_name") . "&zaiwaiCN=" . iconv("GBK", "UTF-8", $zaiwaiCN)), true);
        header("Location:http://www.8264.com/weather/" . $cur_location['spell'] . "/");
        exit();
    } else {
        header("Location:http://www.8264.com/weather/");
        exit();
    }
}

//公共方法
function multi_array_sort($multi_array, $sort_key, $sort = SORT_ASC) {
    if (is_array($multi_array)) {
        foreach ($multi_array as $row_array) {
            if (is_array($row_array)) {
                $key_array[] = $row_array[$sort_key];
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
    array_multisort($key_array, $sort, $multi_array);
    return $multi_array;
}

//生成接口stoken
function generate_stoken($action) {
    return md5(date('Y-m-d', time()) . '#$@%!*' . $action);
}

//地区列表模块(通用)
$weather_area_list = $memory->get('weather_area');
if (empty($weather_area_list)) {
    $weather_area_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_area_list&stoken=" . generate_stoken("get_weather_area_list")), true);
    if (!empty($weather_area_list)) {
        $weather_area_list = iconv_array($weather_area_list, "UTF-8", "GBK");
        $memory->set('weather_area', $weather_area_list, 604800);
    } else {
        exit("API error");
    }
}
//定位所在城市
$result['data']['city'] = array();
if (!empty($result['data']['city'])) {
    $cur_city = str_replace("市", "", $result['data']['city']);
} else {
    if (!empty($_GET['area'])) {
        $weather_area_name = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_name_by_spell&spell=" . iconv("GBK", "UTF-8", $_GET['area']) . "&pspell=" . iconv("GBK", "UTF-8", $_GET['pspell']) . "&stoken=" . generate_stoken("get_weather_name_by_spell")), true);

        $cur_city = iconv("UTF-8", "GBK", $weather_area_name['name']);
        if (empty($cur_city)) {
            header("Location:http://www.8264.com/weather/");
            exit();
        }
        $parent_area = iconv("UTF-8", "GBK", $weather_area_name['parent_name']);
        $parent_spell = iconv("UTF-8", "GBK", $weather_area_name['parent_spell']);
    } else {
        $cur_city = '北京';
        $parent_area = iconv("UTF-8", "GBK", $weather_area_name['parent_name']);
        $parent_spell = iconv("UTF-8", "GBK", $weather_area_name['parent_spell']);
        $weather_area_name['speller'] = 'beijing';
    }
}
$hot_city=array(
		'heilongjia'	=> array('qiqihaer', 'jixi', 'hegang','huangyashan', 'daqing', 'yichun', 'jiamusi', 'qitaihe', 'mudanjiang', 'heihe'),
		'liaoning'    => array('shenyang', 'dalian', 'anshan', 'yingkou', 'panjin', 'jinzhou', 'fushun', 'benxi', 'liaoyang', 'dandong'),
		'henan'    =>array('zhengzhou', 'kaifeng', 'luoyang', 'pingdingshan', 'anyang', 'hebi', 'xinxiang', 'jiaozhuo', 'puyang', 'xuchang'),
		'hebei'    =>array('shijiazhuang', 'tangshan', 'qinhuangdao', 'handan', 'xingtai', 'baoding', 'zhangjiakou', 'chengde', 'cangzhou', 'langfang'),
		'jilin'    =>array('changchun', 'jiutai', 'yushu', 'dehui', 'jilin', 'jiaohe', 'huadian', 'shulan', 'panshi', 'siping'),
		'shanxi'    =>array('taiyuan', 'datong', 'yangquan', 'changzhi', 'jincheng', 'shuozhou', 'jinzhou', 'yuncheng', 'xinzhou', 'linfen'),
		'qinghai'    =>array('xining'),
		'shandong'    =>array('jinan', 'qingdao', 'zibo', 'zaozhuang', 'dongying', 'yantai', 'weifang', 'jining', 'taian', 'weihai'),
		'jiangsu'    =>array('nanjing', 'wuxi', 'xuzhou', 'changzhou', 'suzhou', 'nantong', 'lianyungang', 'huaian', 'yancheng', 'yangzhou'),
		'anhui'    =>array('hefei', 'wuhu', 'bangbu', 'huainan', 'maanshan', 'huaibei', 'tongling', 'anqing', 'tongcheng', 'huangshan'),
		'fujian'    =>array('fuzhou', 'xiamen', 'putian', 'sanming', 'quanzhou', 'zhangzhou', 'nanping', 'longyan', 'ningde', 'anxi'),
		'jiangxi'    =>array('nachang', 'jiujiang', 'shangrao', 'fuzhou', 'yichun', 'jian', 'ganzhou', 'jingdezhen', 'pingxiang', 'xinyu'),
		'guangdong'    =>array('guangzhou', 'shenzhen', 'zhuhai', 'shantou', 'foshan', 'shaoguan', 'zhanjiang', 'zhaoqing', 'jiangmen', 'maoming'),
		'taiwan'    =>array('taibei', 'gaoxiong', 'jilong', 'taizhong', 'tainan', 'xinzhu', 'jiayi', 'hualian', 'nantou', 'yunlin'),
		'hainan'    =>array('haikou', 'sanya', 'qionghai', 'wenchang', 'wanning', 'dingan', 'tunchang', 'zhongsha', 'xisha', 'baisha')
);
if ($_GET['ctl'] == "provinces") {
    if ($_GET['province'] == "") {
        header("Location:http://www.8264.com/weather/");
        exit();
    }
    //省份列表模块
    $weather_provinces_list = $memory->get('weather_provinces');
    if (empty($weather_provinces_list)) {
        $weather_provinces_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_provinces_list&stoken=" . generate_stoken("get_weather_provinces_list")), true);
        $weather_provinces_list = iconv_array($weather_provinces_list, "UTF-8", "GBK");
        $memory->set('weather_provinces', $weather_provinces_list, 604800);
    }
    if (!empty($_GET['province'])) {
        $weather_area_name = json_decode(requestRemoteData(APIURL . "?app=api&act=get_provience_name_by_spell&province=" . iconv("GBK", "UTF-8", $_GET['province']) . "&pspell=" . iconv("GBK", "UTF-8", $_GET['pspell']) . "&stoken=" . generate_stoken("get_provience_name_by_spell")), true);
        $cur_province = iconv("UTF-8", "GBK", $weather_area_name['name']);
    } else {
        $cur_province = '北京';
    }

    //根据省份名称查询天气
    $weather_province_city_list = $memory->get($_GET['province'] . 'weather_province_city_list');
    if (empty($weather_province_city_list)) {
        $weather_province_city_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_citys_by_province&pname=" . iconv("GBK", "UTF-8", $_GET['province']) . "&stoken=" . generate_stoken("get_weather_citys_by_province")), true);
        $weather_province_city_list = iconv_array($weather_province_city_list, "UTF-8", "GBK");
		foreach($weather_province_city_list as $k=>$v){
        	if($v['pspell']==$_GET['province']){
        		if(in_array($v['spell'],$hot_city[$_GET['province']])){
	        		$weather_province_city_list[$k]["sort"]=1;
	        	}else{
	        		$weather_province_city_list[$k]["sort"]=0;
	        	}
        	}
        }
		$sort = array(
			'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
			'field'     => 'sort',       //排序字段
		);
		$arrSort = array();
		foreach($weather_province_city_list AS $uniqid => $row){
			foreach($row AS $key=>$value){
				$arrSort[$key][$uniqid] = $value;
			}
		}
		if($sort['direction']){
			array_multisort($arrSort[$sort['field']], constant($sort['direction']), $weather_province_city_list);
		}
        $memory->set($_GET['province'] . 'weather_province_city_list', $weather_province_city_list, 604800);
    }
	$perpage = 10;
	$page = max($_GET['page'], 1);
	$start = ($page-1) * $perpage;
	$city_num=count($weather_province_city_list);
	$page_all=ceil($city_num/$perpage);
	$weather_province_city_list = array_slice($weather_province_city_list, $start, $perpage);
	foreach ($weather_province_city_list as $k => $v) {
        //天气预报接口模块
        $weather_city_forecast = $memory->get("weather_" . $v['spell'] . date("Ymd"));
        if (empty($weather_city_forecast)) {
            $ch = curl_init();
            // $url = 'http://apis.baidu.com/heweather/weather/free?city=' . iconv("GBK", "UTF-8", $v['name']);
            $url = 'http://apis.baidu.com/heweather/pro/weather?city=' . iconv("GBK", "UTF-8", $v['name']);
            $header = array(
                'apikey: ' . WEATHERAPIKEY,
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $res = curl_exec($ch);
            $weather_city_forecast = iconv_array(json_decode($res, TRUE), "UTF-8", "GBK");

            json_decode(requestRemoteData(APIURL . "?app=api&act=monitor_weather_open_api&ip=" . $_G["clientip"] . "&area=".$v['spell']."&loc=provinces&stoken=" . generate_stoken("monitor_weather_open_api")), true);
            $memory->set("weather_" . $v['spell'] . date("Ymd"), $weather_city_forecast, 28800);
        }

        if ($weather_city_forecast['HeWeather data service 3.0'][0]['status'] != 'unknown city') {
            $weather_forecast_city_result[$k]['city'] = $v['name'];
            $weather_forecast_city_result[$k]['spell'] = $v['spell'];
            $weather_forecast_city_result[$k]['pspell'] = $v['pspell'];
            $weather_forecast_city_result[$k]['maxTemp'] = $weather_city_forecast['HeWeather data service 3.0'][0]['daily_forecast'][0]['tmp']['max'];
            $weather_forecast_city_result[$k]['minTemp'] = $weather_city_forecast['HeWeather data service 3.0'][0]['daily_forecast'][0]['tmp']['min'];
            $weather_forecast_city_result[$k]['weather'] = $weather_city_forecast['HeWeather data service 3.0'][0]['now']['cond']['txt'];
            $weather_forecast_city_result[$k]['wind_dir'] = $weather_city_forecast['HeWeather data service 3.0'][0]['now']['wind']['dir'];
            $weather_forecast_city_result[$k]['wind_power'] = $weather_city_forecast['HeWeather data service 3.0'][0]['now']['wind']['sc'];
        }

        $max_temp+=intval($weather_city_forecast['HeWeather data service 3.0'][0]['daily_forecast'][0]['tmp']['max']);
        $min_temp+=intval($weather_city_forecast['HeWeather data service 3.0'][0]['daily_forecast'][0]['tmp']['min']);
    }
    $province_max_tmp = multi_array_sort($weather_forecast_city_result, "maxTemp", SORT_DESC);
    $province_min_tmp = multi_array_sort($weather_forecast_city_result, "minTemp", SORT_ASC);
    $province_avg_max_temp = intval($max_temp / count($weather_province_city_list));
    $province_avg_min_temp = intval($min_temp / count($weather_province_city_list));
    $province_max_tempure = $province_max_tmp[0]['maxTemp'];
    $province_min_tempure = $province_min_tmp[0]['minTemp'];

    $pageTitle = "{$cur_province}天气预报,{$cur_province}" . intval(date("m")) . "月天气预报,{$cur_province}7天天气预报,{$cur_province}天气预报一周 - 户外资料网8264.com";
    $metakeywords = "{$cur_province}天气预报,{$cur_province}" . intval(date("m")) . "月气温,{$cur_province}7天天气预测";
    $metadescription = "";
    include template('weather/provinces');
} elseif ($_GET['ctl'] == "more_city"){
	if (!empty($_GET['province'])) {
		$weather_area_name = json_decode(requestRemoteData(APIURL . "?app=api&act=get_provience_name_by_spell&province=" . iconv("GBK", "UTF-8", $_GET['province']) . "&pspell=" . iconv("GBK", "UTF-8", $_GET['pspell']) . "&stoken=" . generate_stoken("get_provience_name_by_spell")), true);
		$cur_province = iconv("UTF-8", "GBK", $weather_area_name['name']);
	} else {
		$cur_province = '北京';
	}

	$weather_province_city_list = $memory->get($_GET['province'] . 'weather_province_city_list');
	if (empty($weather_province_city_list)) {
		$weather_province_city_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_citys_by_province&pname=" . iconv("GBK", "UTF-8", $_GET['province']) . "&stoken=" . generate_stoken("get_weather_citys_by_province")), true);
		$weather_province_city_list = iconv_array($weather_province_city_list, "UTF-8", "GBK");
		foreach($weather_province_city_list as $k=>$v){
			if($v['pspell']==$_GET['province']){
				if(in_array($v['spell'],$hot_city[$_GET['province']])){
					$weather_province_city_list[$k]["sort"]=1;
				}else{
					$weather_province_city_list[$k]["sort"]=0;
				}
			}
		}
		$sort = array(
			'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
			'field'     => 'sort',       //排序字段
		);
		$arrSort = array();
		foreach($weather_province_city_list AS $uniqid => $row){
			foreach($row AS $key=>$value){
				$arrSort[$key][$uniqid] = $value;
			}
		}
		if($sort['direction']){
			array_multisort($arrSort[$sort['field']], constant($sort['direction']), $weather_province_city_list);
		}
		$memory->set($_GET['province'] . 'weather_province_city_list', $weather_province_city_list, 604800);
	}
	$perpage = 10;
	$page = max($_GET['page'], 1);
	$start = ($page-1) * $perpage;
	$weather_province_city_list = array_slice($weather_province_city_list, $start, $perpage);
	foreach ($weather_province_city_list as $k => $v) {
		//天气预报接口模块
		$weather_city_forecast = $memory->get("weather_" . $v['spell'] . date("Ymd"));
		if (empty($weather_city_forecast)) {
			$ch = curl_init();
			$url = 'http://apis.baidu.com/heweather/weather/free?city=' . iconv("GBK", "UTF-8", $v['name']);
			$header = array(
					'apikey: ' . WEATHERAPIKEY,
			);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			$res = curl_exec($ch);
			$weather_city_forecast = iconv_array(json_decode($res, TRUE), "UTF-8", "GBK");

			json_decode(requestRemoteData(APIURL . "?app=api&act=monitor_weather_open_api&ip=" . $_G["clientip"] . "&area=".$v['spell']."&loc=provinces&stoken=" . generate_stoken("monitor_weather_open_api")), true);
			$memory->set("weather_" . $v['spell'] . date("Ymd"), $weather_city_forecast, 28800);
		}

		if ($weather_city_forecast['HeWeather data service 3.0'][0]['status'] != 'unknown city') {
			$weather_forecast_city_result[$k]['city'] = $v['name'];
			$weather_forecast_city_result[$k]['spell'] = $v['spell'];
			$weather_forecast_city_result[$k]['pspell'] = $v['pspell'];
			$weather_forecast_city_result[$k]['maxTemp'] = $weather_city_forecast['HeWeather data service 3.0'][0]['daily_forecast'][0]['tmp']['max'];
			$weather_forecast_city_result[$k]['minTemp'] = $weather_city_forecast['HeWeather data service 3.0'][0]['daily_forecast'][0]['tmp']['min'];
			$weather_forecast_city_result[$k]['weather'] = $weather_city_forecast['HeWeather data service 3.0'][0]['now']['cond']['txt'];
			$weather_forecast_city_result[$k]['wind_dir'] = $weather_city_forecast['HeWeather data service 3.0'][0]['now']['wind']['dir'];
			$weather_forecast_city_result[$k]['wind_power'] = $weather_city_forecast['HeWeather data service 3.0'][0]['now']['wind']['sc'];
		}
    }
	include template('weather/sub_province');
} elseif ($_GET['ctl'] == "city") {
    //省份列表模块
    $weather_provinces_list = $memory->get('weather_provinces');
    if (empty($weather_provinces_list)) {
        $weather_provinces_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_provinces_list&stoken=" . generate_stoken("get_weather_provinces_list")), true);
        if (!empty($weather_provinces_list)) {
            $weather_provinces_list = iconv_array($weather_provinces_list, "UTF-8", "GBK");
            $memory->set('weather_provinces', $weather_provinces_list, 604800);
        } else {
            exit("API error");
        }
    }
    $pageTitle = "全国城市天气预报," . intval(date("m")) . "月天气预报,全国7天天气预报,全国天气预报一周 - 户外资料网8264.com";
    $metakeywords = "全国天气预报," . intval(date("m")) . "月天气预报,7天天气预测,天气预测";
    $metadescription = "";
    include template('weather/city');
} elseif ($_GET['ctl'] == "history") {
    $weather_provinces_list = $memory->get('weather_provinces');
    if (empty($weather_provinces_list)) {
        $weather_provinces_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_provinces_list&stoken=" . generate_stoken("get_weather_provinces_list")), true);
        if (!empty($weather_provinces_list)) {
            $weather_provinces_list = iconv_array($weather_provinces_list, "UTF-8", "GBK");
            $memory->set('weather_provinces', $weather_provinces_list, 604800);
        } else {
            exit("API error");
        }
    }
    $weather_history_result = $memory->get('weather_history_result' . $_GET['area'] . $_GET['dateline']);
    $weather_history_result = array();
    if (empty($weather_history_result)) {
        $weather_area_name = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_name_by_spell&spell=" . iconv("GBK", "UTF-8", $_GET['area']) . "&pspell=" . iconv("GBK", "UTF-8", $_GET['pspell']) . "&stoken=" . generate_stoken("get_weather_name_by_spell")), true);
        if (!empty($weather_area_name)) {
            $cur_city = iconv("UTF-8", "GBK", $weather_area_name['name']);
            $curtimestamp = strtotime($_GET['dateline'] . '01');
            $firstday = date('Y', $curtimestamp) . '-' . date('n-01', $curtimestamp);
            $lastday = date('Y', $curtimestamp) . '-' . date('n-d', strtotime("$firstday +1 month -1 day"));
            $weather_history_data = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_history_data_by_city&city=" . iconv("GBK", "UTF-8", $cur_city) . "&sdate=" . $firstday . "&edate=" . $lastday . "&stoken=" . generate_stoken("get_weather_history_data_by_city")), true);
            if (!empty($weather_history_data)) {
                foreach (iconv_array($weather_history_data['data'], "UTF-8", "GBK") as $k => $v) {
                    $weekarray = array("日", "一", "二", "三", "四", "五", "六");
                    $weather_history_result['data'][$k]['date'] = $v['dateline'] . " 星期" . $weekarray[date("w", strtotime($v['dateline']))];
                    $weather_history_result['data'][$k]['maxTem'] = $v['maxtemperature'];
                    $weather_history_result['data'][$k]['minTem'] = $v['mintemperature'];
                    $weather_history_result['data'][$k]['weather'] = $v['weather'];
                    $weather_history_result['data'][$k]['winddirection'] = $v['winddirection'];
                    $weather_history_result['data'][$k]['windpower'] = $v['windpower'];
                    $total_mintemperature+=$v['mintemperature'];
                    $total_maxtemperature+=$v['maxtemperature'];
                }
                $weather_history_result['avg_max_tem'] = intval($total_maxtemperature / 30);
                $weather_history_result['avg_min_tem'] = intval($total_mintemperature / 30);
                $weather_history_result['max_tem'] = $weather_history_data['max_temp'];
                $weather_history_result['min_temp'] = $weather_history_data['min_temp'];
                $memory->set('weather_history_result' . $_GET['area'] . $_GET['dateline'], $weather_history_result, 3600);
            } else {
                exit("API error");
            }
        } else {
            exit("API error");
        }
    }
    $area = isset($_GET['area']) ? $_GET['area'] : 'beijing';
    $show_dateline = date('Y年n月', strtotime($_GET['dateline'] . "01"));

    //根据地区名称查询同级地区
    $weather_parallel_area_list = $memory->get($_GET['area'] . 'weather_parallel_area_list');
    if (empty($weather_parallel_area_list)) {
        $weather_parallel_area_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_parallel_area_by_name&spell=" . iconv("GBK", "UTF-8", $_GET['area']) . "&pspell=" . iconv("GBK", "UTF-8", $_GET['pspell']) . "&stoken=" . generate_stoken("get_parallel_area_by_name")), true);
        $weather_parallel_area_list = iconv_array($weather_parallel_area_list, "UTF-8", "GBK");
        $memory->set($_GET['area'] . 'weather_parallel_area_list', $weather_parallel_area_list, 604800);
    }
    $show_history_date = date("Ym");
    $pageTitle = "{$show_dateline}{$cur_city}历史天气查询,{$cur_city}" . date('n', strtotime($_GET['dateline'] . "01")) . "月份天气气温 - 户外资料网8264.com";
    $metakeywords = "{$cur_city}历史天气,{$cur_city}" . date('n', strtotime($_GET['dateline'] . "01")) . "月气温";
    $metadescription = "";
    include template('weather/history');
} elseif ($_GET['ctl'] == "forecast") {
    $forecast_result = $memory->get('weather_forecast_list' . $_GET['area'] . $_GET['duration']);
    $forecast_result = array();
    if (empty($forecast_result)) {
        //为了能够获取到URL跳转后的内容，需要用file_get_contents
        $weather_forecast_list = file_get_contents("http://" . $_GET['area'] . ".tianqi.com/30/");
        //获取未来长期天气数据
        $preg = "/<ul>.*<li class=\"t1\">.*<\/li>.*<li class=\"t2\">(.*)<span>(.*)<\/span><\/li>.*<li class=\"t3\">(.*)<\/li>.*<li class=\"t4\">(.*)<\/li>.*<li class=\"t5\">(.*)<\/li>.*<\/ul>/iUse";
        preg_match_all($preg, iconv("GBK", "UTF-8", $weather_forecast_list), $rs);
        if (empty($rs[0])) {
            header("Location:http://www.8264.com/weather/");
            exit();
        }
        $forecast_result = array();
        for ($i = 0; $i < $_GET['duration']; $i++) {
            $forecast_result[$i]['dateline'] = date("Y-n-j", strtotime('+' . $i . 'day'));
            $weekarray = array("日", "一", "二", "三", "四", "五", "六");
            $forecast_result[$i]['week'] = "星期" . $weekarray[date("w", strtotime($forecast_result[$i]['dateline']))];
            $forecast_result[$i]['weather'] = trim(end(explode("\r\n", strip_tags($rs[2][$i * 2]))));
            $forecast_result[$i]['tempure'] = trim(strip_tags($rs[3][$i * 2]));
            $forecast_result[$i]['mintempure'] = trim(strip_tags($rs[3][($i * 2) + 1]));
            $forecast_result[$i]['wind_dir'] = trim(strip_tags($rs[4][$i * 2]));
            $forecast_result[$i]['wind_power'] = trim(strip_tags($rs[5][$i * 2]));
        }
        $forecast_result = iconv_array($forecast_result, "UTF-8", "GBK");
        $memory->set('weather_forecast_list' . $_GET['area'] . $_GET['duration'], $forecast_result, 86400);
    }
    if (!empty($_GET['area'])) {
        $weather_area_name = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_name_by_spell&spell=" . iconv("GBK", "UTF-8", $_GET['area']) . "&pspell=" . iconv("GBK", "UTF-8", $_GET['pspell']) . "&stoken=" . generate_stoken("get_weather_name_by_spell")), true);
        $cur_city = iconv("UTF-8", "GBK", $weather_area_name['name']);
    } else {
        $cur_city = '北京';
        $weather_area_name['speller'] = 'beijing';
    }
    //根据地区名称查询同级地区
    $weather_parallel_area_list = $memory->get($_GET['area'] . 'weather_parallel_area_list');
    if (empty($weather_parallel_area_list)) {
        $weather_parallel_area_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_parallel_area_by_name&spell=" . iconv("GBK", "UTF-8", $_GET['area']) . "&pspell=" . iconv("GBK", "UTF-8", $_GET['pspell']) . "&stoken=" . generate_stoken("get_parallel_area_by_name")), true);
        $weather_parallel_area_list = iconv_array($weather_parallel_area_list, "UTF-8", "GBK");
        $memory->set($_GET['area'] . 'weather_parallel_area_list', $weather_parallel_area_list, 604800);
    }

    $pageTitle = "{$cur_city}{$_GET['duration']}天天气预报,{$cur_city}{$_GET['duration']}天天气气温查询 - 户外资料网8264.com";
    $metakeywords = "{$cur_city}{$_GET['duration']}天天气预报,{$cur_city}{$_GET['duration']}天气温查询";
    $metadescription = "";
    include template('weather/forecast');
} elseif ($_GET['is_ajax'] == 1 && $_GET['ctl'] == "get_citylist_by_ajax") {
    //定位所在城市
    if (!empty($_GET['area'])) {
        $weather_area_name = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_name_by_spell&spell=" . iconv("GBK", "UTF-8", $_GET['area']) . "&pspell=" . iconv("GBK", "UTF-8", $_GET['pspell']) . "&stoken=" . generate_stoken("get_weather_name_by_spell")), true);
        $cur_city = iconv("UTF-8", "GBK", $weather_area_name['name']);
    } else {
        $cur_city = '北京';
        $weather_area_name['speller'] = 'beijing';
    }
    $html = '<div class="loacdcity">
                    <dl class="clear_b">
                        <dt><b>当前城市：</b></dt>
                        <dd>
                        <a href="http://www.8264.com/weather/' . $weather_area_name['pspell'] . '/' . $weather_area_name['spell'] . '/" target="_blank">' . $cur_city . '</a>
                        </dd>
                    </dl>
                </div>
                <div class="loacdcity">
                    <dl class="clear_b">
                        <dt><b>热门城市：</b></dt>
                        <dd>
                            <a href="http://www.8264.com/weather/sichuan/chengdu/" target="_blank">成都</a>
                            <a href="http://www.8264.com/weather/beijing/beijing/" target="_blank">北京市</a>
                            <a href="http://www.8264.com/weather/tianjin/tianjin/" target="_blank">天津市</a>
                            <a href="http://www.8264.com/weather/hebei/" target="_blank">河北省</a>
                            <a href="http://www.8264.com/weather/sx/" target="_blank">山西省</a>
                            <a href="http://www.8264.com/weather/neimenggu/" target="_blank">内蒙古自治区</a>
                            <a href="http://www.8264.com/weather/liaoning/" target="_blank">辽宁省</a>
                            <a href="http://www.8264.com/weather/jilin/" target="_blank">吉林省</a>
                            <a href="http://www.8264.com/weather/heilongjiang/" target="_blank">黑龙江省</a>
                            <a href="http://www.8264.com/weather/shanghai/" target="_blank">上海市</a>
                            <a href="http://www.8264.com/weather/jiangsu/" target="_blank">江苏省</a>
                            <a href="http://www.8264.com/weather/zhejiang/" target="_blank">浙江省</a>
                            <a href="http://www.8264.com/weather/anhui/" target="_blank">安徽省</a>
                            <a href="http://www.8264.com/weather/fujian/" target="_blank">福建省</a>
                            <a href="http://www.8264.com/weather/jiangxi/" target="_blank">江西省</a>
                        </dd>
                    </dl>
                </div>';

    foreach ($weather_area_list as $k => $v) {
        $innerHTML.='<div class="loacdcity othercity">
                    <dl class="clear_b">
                        <dt><a href="http://www.8264.com/weather/' . $v['spell'] . '/" target="_blank">' . $v['name'] . '</a></dt>
                        <dd>';
        foreach ($v['areas'] as $kk => $vv) {
            $innerHTML.='<a href="http://www.8264.com/weather/' . $vv['pspell'] . '/' . $vv['spell'] . '/" target="_blank">' . $vv['name'] . '</a>';
        }
        $innerHTML.= '</dd>
                    </dl>
                </div>';
    }
    echo $html . $innerHTML;
    die;
} else {
    $weather_provinces_list = $memory->get('weather_provinces');
    if (empty($weather_provinces_list)) {
        $weather_provinces_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_weather_provinces_list&stoken=" . generate_stoken("get_weather_provinces_list")), true);
        $weather_provinces_list = iconv_array($weather_provinces_list, "UTF-8", "GBK");
        $memory->set('weather_provinces', $weather_provinces_list, 604800);
    }

    //天气预报接口模块
    $area = isset($_GET['area']) ? $_GET['area'] : 'beijing';
    $weather_forecast = $memory->get("weather_" . $area . date("Ymd"));
    if (empty($weather_forecast)) {
        $ch = curl_init();
        $url = 'http://apis.baidu.com/heweather/pro/weather?city=' . iconv("GBK", "UTF-8", $cur_city);
        $header = array(
            'apikey: ' . WEATHERAPIKEY,
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = curl_exec($ch);
        json_decode(requestRemoteData(APIURL . "?app=api&act=monitor_weather_open_api&ip=" . $_G["clientip"] . "&loc=index&area=".$area."&stoken=" . generate_stoken("monitor_weather_open_api")), true);
        if (!empty($res)) {
            $weather_forecast = iconv_array(json_decode($res, TRUE), "UTF-8", "GBK");
            $memory->set("weather_" . $area . date("Ymd"), $weather_forecast, 28800);
        } else {
            exit('API error');
        }
    }
    if ($weather_forecast['HeWeather data service 3.0'][0]['status'] == "unknown city") {
        header("Location:http://www.8264.com/weather/");
        exit();
    }
    $weather_forecast_result['update_date'] = date("H:i", strtotime($weather_forecast['HeWeather data service 3.0'][0]['basic']['update']['loc']));
    $weather_forecast_result['current_date'] = date("Y年m月d日");
    $weekarray = array("日", "一", "二", "三", "四", "五", "六");
    $weather_forecast_result['current_week'] = "星期" . $weekarray[date("w", time())];
    $weather_forecast_result['temperature'] = $weather_forecast['HeWeather data service 3.0'][0]['now']['tmp'];
    $weather_forecast_result['weather'] = $weather_forecast['HeWeather data service 3.0'][0]['now']['cond']['txt'];
    $weather_forecast_result['code'] = $weather_forecast['HeWeather data service 3.0'][0]['now']['cond']['code'];
    $weather_forecast_result['wind_dir'] = $weather_forecast['HeWeather data service 3.0'][0]['now']['wind']['dir'];
    $weather_forecast_result['wind_power'] = $weather_forecast['HeWeather data service 3.0'][0]['now']['wind']['sc'];
    $weather_forecast_result['aqi'] = $weather_forecast['HeWeather data service 3.0'][0]['aqi']['city']['aqi'];
    $weather_forecast_result['drsg'] = $weather_forecast['HeWeather data service 3.0'][0]['suggestion']['drsg']['brf'];
    $weather_forecast_result['minTemp'] = $weather_forecast['HeWeather data service 3.0'][0]['daily_forecast'][0]['tmp']['min'];
    $weather_forecast_result['maxTemp'] = $weather_forecast['HeWeather data service 3.0'][0]['daily_forecast'][0]['tmp']['max'];

    foreach ($weather_forecast['HeWeather data service 3.0'][0]['hourly_forecast'] as $k => $v) {
        $weather_forecast_result['hourly_forecast'][$k]['date'] = date("Y-n-j", strtotime($v['date']));
        $weather_forecast_result['hourly_forecast'][$k]['time'] = date("H:i", strtotime($v['date']));
        $weather_forecast_result['hourly_forecast'][$k]['weather'] = $weather_forecast_result['weather'];
        $weather_forecast_result['hourly_forecast'][$k]['temperature'] = $v['tmp'];
        $weather_forecast_result['hourly_forecast'][$k]['wind_dir'] = $v['wind']['dir'];
        $weather_forecast_result['hourly_forecast'][$k]['wind_power'] = $v['wind']['sc'];
    }
    $weather_forecast_result['hourly_forecast'] = array_slice($weather_forecast_result['hourly_forecast'], 0, 3);
    foreach ($weather_forecast['HeWeather data service 3.0'][0]['daily_forecast'] as $k => $v) {
        $weather_forecast_result['daily_forecast'][$k]['date'] = $v['date'];
        $weather_forecast_result['daily_forecast'][$k]['week'] = "星期" . $weekarray[date("w", strtotime($v['date']))];
        $weather_forecast_result['daily_forecast'][$k]['weather'] = $v['cond']['txt_n'];
        $weather_forecast_result['daily_forecast'][$k]['code'] = $v['cond']['code_d'];
        $weather_forecast_result['daily_forecast'][$k]['temperature'] = $v['tmp']['max'];
        $weather_forecast_result['daily_forecast'][$k]['wind_dir'] = $v['wind']['dir'];
        $weather_forecast_result['daily_forecast'][$k]['wind_power'] = $v['wind']['sc'];
        $weather_forecast_result['daily_forecast'][$k]['minTemp'] = $v['tmp']['min'];
        $weather_forecast_result['daily_forecast'][$k]['maxTemp'] = $v['tmp']['max'];
    }

    $weather_forecast_result['daily_forecast'] = array_slice($weather_forecast_result['daily_forecast'], 0, 7);
    //根据地区名称查询同级地区
    $weather_parallel_area_list = $memory->get($_GET['area'] . 'weather_parallel_area_list');
    if (empty($weather_parallel_area_list)) {
        $weather_parallel_area_list = json_decode(requestRemoteData(APIURL . "?app=api&act=get_parallel_area_by_name&spell=" . iconv("GBK", "UTF-8", $_GET['area']) . "&pspell=" . iconv("GBK", "UTF-8", $_GET['pspell']) . "&stoken=" . generate_stoken("get_parallel_area_by_name")), true);
        $weather_parallel_area_list = iconv_array($weather_parallel_area_list, "UTF-8", "GBK");
        $memory->set($_GET['area'] . 'weather_parallel_area_list', $weather_parallel_area_list, 604800);
    }

    $history_show = date("Ym");
    $pageTitle = "{$cur_city}天气预报,{$cur_city}" . date("n") . "月天气预报,{$cur_city}7天天气预报,{$cur_city}天气预报一周 - 户外资料网8264.com";
    $metakeywords = "{$cur_city}天气预报,{$cur_city}" . date("n") . "月天气,{$cur_city}7天天气";
    $metadescription = "";
    include template('weather/index');
}
?>
