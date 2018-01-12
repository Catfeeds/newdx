<?php

class weather{
	
	const SEARCH_URL = "http://www.sogou.com/web?query=";
	const WEATHER_URL = "www.weather.com.cn";
	const TABLE_NAME = 'plugin_city_weather';
	
	const WEATHER_TEMPLATE = "/<h1[^>]*>(?<day>[^<]+?)\s+(?<week>[^<]*?)<\/h1>[^<]*<h2[^>]*>(?<time>[^<]*?)<\/h2>[^<]*<p[^>]*class=['\"]wea['\"][^>]*>(?<weather>[^<]*?)<\/p>[^<]*<p[^>]*class=['\"]tem['\"][^>]*><span[^>]*>(?<temp>[^<]*?)<\/span>[^<]*<i[^>]*>(?<tempunit>[^<]*?)<\/i>[^<]*<\/p>[^<]*<p[^>]*class=['\"]win['\"][^>]*>[^<]*<span[^>]*title=['\"](?<wind>[^'\"]*)['\"][^>]*>(?<windlevel>[^<]*?)<\/span>[^<]*<\/p>[^<]*<p[^>]*class=['\"](?:sunUp|sunDown)['\"][^>]*>(?<sun>[^<]*?)<\/p>/is";	
	
	public static function getweather($cityname, $focus = false)
	{
		$cityname = trim($cityname);
		if($cityname)
		{
			require_once libfile('function/filesock');
			$weatherinfo = DB::fetch_first("SELECT wid, url FROM " . DB::table('plugin_weathers') . " WHERE wname = '{$cityname}'");
			if(!$weatherinfo)
			{
				$url = weather::SEARCH_URL . urlencode("site:" . weather::WEATHER_URL . " {$cityname}今天天气预报");
				$content = _dfsockopen($url);
				preg_match_all("/<a[^>]*href=\"(?<url>http:\/\/" . weather::WEATHER_URL . "\/weather1d\/(?<wid>[^\"\.]*?)\.shtml)[\"]([^>]*)>(?<text>[\w\W]*?)<\/a>/is", $content, $matches, PREG_SET_ORDER);
				if(!empty($matches[0]))
				{
				$weatherid = trim($matches[0]['wid']);
				$weatherurl = trim($matches[0]['url']);
				$urltext = trim(iconv('utf-8', 'gbk', $matches[0]['text']));
				if(stripos($urltext, $cityname) === false)
				{
					return false;
				}
				DB::insert('plugin_weathers', array(
												'wid' => $weatherid,
												'wname' => $cityname,
												'dateline' => time(),
												'url' => $weatherurl));
				}
			}else{
				$weatherid = $weatherinfo['wid'];
				$weatherurl = $weatherinfo['url'];
			}
			if($weatherid && $weatherurl){
				$result = $result = memory('get', 'weatherinfo_id_' . $weatherid);
				if($focus || !$result)
				{
					$html = _dfsockopen($weatherurl);
					$html = preg_replace("/<(\w+)[^>]*?>\s*<\/\\1>/is", "", $html);
					$html = preg_replace("/<!DOCTYPE html>.*?<div[^>]*?id=\"today\"[^>]*?>(.*?)<\/div>.*<\/html>/is", "\\1", $html);
					$html = preg_replace("/(\S)?[\r\n](\S)?/i", "\\1\\2", $html);
					$html = iconv('utf-8', 'gbk', $html);
					//preg_match_all("/<li[^>]*>(?<text>.*?)<\/li>/is", $html, $match, PREG_PATTERN_ORDER);
					preg_match_all(weather::WEATHER_TEMPLATE, $html, $match, PREG_SET_ORDER);
					//var_dump($match);
					foreach($match as $val)
					{
						//$match2 = array();
						//preg_match_all(weather::WEATHER_TEMPLATE, $val, $match2, PREG_SET_ORDER);
						$result[] = array(
									'day' => $val['day'],
									'weekday' => $val['week'],
									'ampm' => $val['time'],
									'weather' => $val['weather'],
									'temp' => $val['temp'] . $val['tempunit'],
									'tempnumber' => $val['temp'],
									'tempunit' => $val['tempunit'],
									'wind' => $val['wind'] . $val['windlevel'],
									'windtype' => $val['wind'],
									'windlevel' => $val['windlevel'],
									'sun' => $val['sun']);
					}
					if(!empty($result))
					{
						memory('set', 'weatherinfo_id_' . $weatherid, $result, 3600);
					}
				}
				return $result;
			}
		}
		return false;
	}
}