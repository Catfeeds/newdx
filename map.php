<?php
require_once './banip.php';
if (!in_array($_GET['ctl'], array("index", "detail", "download"))) {
    exit("hacker attack");
}
define('APPTYPEID', 11);
define('CURSCRIPT', 'map');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

//缓存改为使用11511端口,注意master线上版本中配置必须为11511,rebuild可以根据开发环境中端口在本地做相应更改
$memory = &discuz_memcache::instance("10.28.206.72:11511", 1);
if (!$memory->enable) {
    exit('Cache system error.');
}
//缓存更改结束
$worlds = array(
    "亚洲" => array("日本", "韩国", "朝鲜", "蒙古", "越南", "中国", "泰国", "柬埔寨", "缅甸", "老挝", "马来西亚", "新加坡", "文莱", "菲律宾", "印度尼西亚", "东帝汶", "尼泊尔", "锡金", "不丹", "孟加拉国", "印度", "斯里兰卡", "马尔代夫", "哈萨克斯坦", "塔吉克斯坦", "乌兹别克斯坦", "土库曼斯坦", "格鲁吉亚", "阿塞拜疆", "亚美尼亚", "巴基斯坦", "阿富汗", "伊朗", "伊拉克", "科威特", "沙特阿拉伯", "巴林", "卡塔尔", "阿联酋", "阿曼", "也门", "叙利亚", "黎巴嫩", "约旦", "巴勒斯坦", "以色列", "塞普路斯", "土耳其"),
    "北美洲" => array("美国", "加拿大", "墨西哥", "危地马拉", "萨尔瓦多", "洪都拉斯", "尼加拉瓜", "哥斯达黎加", "巴拿马", "巴哈马", "古巴", "牙买加", "海地", "多米尼加", "伯利兹", "巴巴多斯", "格林纳达"),
    "南美洲" => array("哥伦比亚", "委内瑞拉", "圭亚那", "苏里南", "法属圭亚那", "厄瓜多尔", "秘鲁", "巴西", "玻利维亚", "智利", "阿根廷", "巴拉圭", "乌拉圭"),
    "大洋洲" => array("澳大利亚", "新西兰", "瑙鲁", "汤加", "巴布亚新几内亚", "所罗门群岛", "瓦努阿图", "斐济", "西萨摩亚", "基里巴斯", "马绍尔群岛", "帕劳"),
    "欧洲" => array("法国", "德国", "英国", "荷兰", "比利时", "卢森堡", "西班牙", "葡萄牙", "意大利", "奥地利", "瑞士", "匈牙利", "俄罗斯", "丹麦", "瑞典", "挪威", "芬兰", "冰岛", "爱沙尼亚", "拉托维亚", "立陶宛", "白俄罗斯", "乌克兰", "波兰", "捷克", "斯洛伐克", "爱尔兰", "摩纳哥", "克罗地亚", "马其顿", "罗马尼亚", "保加利亚", "阿尔巴尼亚", "希腊"),
    "非洲" => array("埃及", "利比亚", "突尼斯", "阿尔及利亚", "摩洛哥", "西撒哈拉", "毛里塔尼亚", "塞内加尔", "冈比亚", "马里", "布基纳法索", "佛得角", "几内亚比绍", "几内亚", "塞拉利昂", "利比里亚", "科特迪瓦", "加纳", "多哥", "贝宁", "尼日尔", "尼日利亚", "喀麦隆", "赤道几内亚", "乍得", "中非", "苏丹", "埃塞俄比亚", "吉布提", "索马里", "乌干达", "坦桑尼亚", "卢旺达", "布隆迪", "刚果", "加蓬", "圣多美", "安哥拉", "赞比亚", "马拉维", "莫桑比克", "科摩罗", "马达加斯加", "塞舌尔", "毛里求斯", "津巴布韦", "纳米比亚", "南非", "斯威士兰", "莱索托", "厄立特里亚", "肯尼亚")
);
if ($_GET['ctl'] == "index") {//列表页面
    $pageTitle = "2017最新地图查询，世界地图中文版，中国地图高清版下载 - 户外资料网8264.com";
    $metakeywords = "地图查询，世界地图中文版，全国地图高清版，地图下载";
    $metadescription = "最新地图高清版大图查询，提供各类地图下载，包括世界各国地图，中国地图，行政图，旅游地图等，为驴友们的出行提供帮助";
    include template('map/city');
} elseif ($_GET['ctl'] == "detail") {//详情页面
    if (is_numeric($_GET['id'])) {
        //获取导航链接
        if (!empty($_GET['id'])) {
            $mapid = addslashes($_GET['id']);
            $result_detail = DB::fetch_first("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE id=" . $mapid . getSlaveID());
        }
        if ($result_detail === false) {
            header("HTTP/1.1 404 Not Found");
            header('Status: 404');
            exit;
        }

		//屏蔽中国温度带地图5142
		if ($mapid=='5142'||$mapid=='5017'||$mapid=='5126'||$mapid=='5583') {
			header("HTTP/1.1 404 Not Found");
            header('Status: 404');
            exit;
		}

        //判断链接是否有link
        if ($result_detail['from'] == 1) {
            header("Location:http://www.8264.com/ditu/" . $result_detail['link'] . ".htm");
            exit();
        }
        $img_temp = explode("/", $result_detail['map_img']);
        $img_file = end($img_temp);
        if (!empty($result_detail['continent'])) {
            $continent_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is NULL limit 0,1" . getSlaveID());
            while ($continents = DB::fetch($continent_tmp)) {
                $continent_info[] = $continents;
            }
            $continent_id = $continent_info[0]['id'];
        }

        if (!empty($result_detail['nation'])) {
            $nation_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is NULL limit 0,1" . getSlaveID());
            while ($nations = DB::fetch($nation_tmp)) {
                $nation_info[] = $nations;
            }
            $nation_id = $nation_info[0]['id'];
        }

        if (!empty($result_detail['provience'])) {
            $provience_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience='" . $result_detail['provience'] . "' and city is NULL limit 0,1" . getSlaveID());
            while ($proviences = DB::fetch($provience_tmp)) {
                $provience_info[] = $proviences;
            }
            $provience_id = $provience_info[0]['id'];
        }
        //获取同级下其他地图
        $other_list = $memory->get("map_others_{$result_detail['id']}");
        if (empty($other_list)) {
            if (empty($result_detail['nation'])) {
                $other_list = array();
                $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is NULL and id!={$_GET['id']}" . getSlaveID());
                while ($nations_list = DB::fetch($nations_others_tmp)) {
                    $other_list[] = $nations_list;
                }
            } elseif (empty($result_detail['provience'])) {
                $other_list = array();
                $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is NULL and id!={$_GET['id']}" . getSlaveID());
                while ($nations_list = DB::fetch($nations_others_tmp)) {
                    $other_list[] = $nations_list;
                }
            } elseif (empty($result_detail['city']) && !empty($result_detail['provience'])) {
                $other_list = array();
                $proviences_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience='" . $result_detail['provience'] . "' and city is NULL and id!={$_GET['id']}" . getSlaveID());
                while ($proviences_list = DB::fetch($proviences_others_tmp)) {
                    $other_list[] = $proviences_list;
                }
            } elseif (empty($result_detail['area']) && !empty($result_detail['city'])) {
                $other_list = array();
                $citys_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE city='" . $result_detail['city'] . "' and area is NULL and id!={$_GET['id']}" . getSlaveID());
                while ($citys_list = DB::fetch($citys_others_tmp)) {
                    $other_list[] = $citys_list;
                }
            }
            $memory->set("map_others_{$result_detail['id']}", $other_list, 604800);
        }
        if (!empty($other_list)) {//取15条数据
            $other_list = array_slice($other_list, 0, 16);
        }
        if (!empty($other_list)) {
            foreach ($other_list as $k => $v) { //处理显示地图名称，在<a title中显示
                $other_list_res[$k]['id'] = $v['id'];
                $other_list_res[$k]['continent'] = $v['continent'];
                $other_list_res[$k]['nation'] = $v['nation'];
                $other_list_res[$k]['provience'] = $v['provience'];
                $other_list_res[$k]['city'] = $v['city'];
                $other_list_res[$k]['area'] = $v['area'];
                $other_list_res[$k]['map_name'] = $v['map_name'];
                $other_list_res[$k]['map_name_show'] = str_replace("地图", "", $v['map_name']);
                $other_list_res[$k]['map_img'] = $v['map_img'];
                $other_list_res[$k]['from'] = $v['from'];
                $other_list_res[$k]['link'] = $v['link'];
            }
        }
        //获取洲下的所有国家
        if (empty($result_detail['nation'])) {
            $nations_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is not NULL and provience is NULL group by nation" . getSlaveID());
            while ($nations_list = DB::fetch($nations_tmp)) {
                $nation_list[] = $nations_list;
            }
            $is_continent = true;
        }
        //获取国家下的所有省份
        if (empty($result_detail['provience'])) {
            $provience_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is not NULL and city is NULL group by provience" . getSlaveID());
            while ($proviences_list = DB::fetch($provience_tmp)) {
                $provience_list[] = $proviences_list;
            }
            //如果国家下面没有省份则显示市
            if (empty($provience_list)) {
                $is_nation = false;
                $city_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and city is not NULL and area is NULL group by city" . getSlaveID());
                while ($citys_list = DB::fetch($city_tmp)) {
                    $city_list[] = $citys_list;
                }
                $is_provience = empty($city_list) ? false : true;
            } else {
                $is_nation = true;
            }
        }
        //获取省份下的所有城市
        if (empty($result_detail['city']) && !empty($result_detail['provience'])) {
            $city_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience='" . $result_detail['provience'] . "' and city is not NULL and area is NULL and `from`=1 group by city" . getSlaveID());
            while ($citys_list = DB::fetch($city_tmp)) {
                $city_list[] = $citys_list;
            }
            $is_provience = true;
        }
        //获取同级下其他热门地图
        $other_rec_list = $memory->get("map_other_hot_{$result_detail['id']}");
        if (empty($other_rec_list)) {
            if (empty($result_detail['nation'])) {
                $other_rec_list = array();
                $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent!='" . $result_detail['continent'] . "' and nation is NULL and id!={$_GET['id']} ORDER BY RAND()" . getSlaveID());
                while ($nations_list = DB::fetch($nations_others_tmp)) {
                    $other_rec_list[] = $nations_list;
                }
            } elseif (empty($result_detail['provience'])) {
                $other_rec_list = array();
                $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation!='" . $result_detail['nation'] . "' and continent='{$result_detail['continent']}' and provience is NULL and id!={$_GET['id']} ORDER BY RAND()" . getSlaveID());
                while ($nations_list = DB::fetch($nations_others_tmp)) {
                    $other_rec_list[] = $nations_list;
                }
            } elseif (empty($result_detail['city']) && !empty($result_detail['provience'])) {
                $other_rec_list = array();
                $proviences_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience!='" . $result_detail['provience'] . "' and nation='{$result_detail['nation']}' and city is NULL and id!={$_GET['id']} ORDER BY RAND()" . getSlaveID());
                while ($proviences_list = DB::fetch($proviences_others_tmp)) {
                    $other_rec_list[] = $proviences_list;
                }
                if (empty($other_rec_list)) {
                    $other_rec_list = array();
                    $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is not NULL and id!={$_GET['id']} ORDER BY RAND()" . getSlaveID());
                    while ($nations_list = DB::fetch($nations_others_tmp)) {
                        $other_rec_list[] = $nations_list;
                    }
                }
            } elseif (empty($result_detail['area']) && !empty($result_detail['city'])) {
                $other_rec_list = array();
                $citys_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE city!='" . $result_detail['city'] . "' and provience='{$result_detail['provience']}' and area is NULL and id!={$_GET['id']} ORDER BY RAND()" . getSlaveID());
                while ($citys_list = DB::fetch($citys_others_tmp)) {
                    $other_rec_list[] = $citys_list;
                }
            }
            $memory->set("map_other_hot_{$result_detail['id']}", $other_rec_list, 604800);
        }

        if (!empty($other_rec_list)) {//取15条数据
            $other_rec_list = array_slice($other_rec_list, 0, 16);
        }
    } else {
        //获取导航链接
        if (!empty($_GET['id'])) {
            $mapid = mysql_real_escape_string($_GET['id']);
        }
        $result_detail = DB::fetch_first("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE `link`='" . $mapid . "'" . getSlaveID());
        if (!empty($result_detail)) {
            $map_id = $_GET['id'];
        }
        if ($result_detail === false) {
            header("HTTP/1.1 404 Not Found");
            header('Status: 404');
            exit;
        }
//		//屏蔽天津和台湾地图
//		if ($result_detail['provience'] =='天津'||$result_detail['provience'] =='台湾'||$mapid='cn'||$mapid='china') {
//			header("HTTP/1.1 404 Not Found");
//            header('Status: 404');
//            exit;
//		}

        $img_temp = explode("/", $result_detail['map_img']);
        $img_file = end($img_temp);
        if (!empty($result_detail['continent'])) {
            $continent_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is NULL limit 0,1" . getSlaveID());
            while ($continents = DB::fetch($continent_tmp)) {
                $continent_info[] = $continents;
            }
            $continent_id = $continent_info[0]['id'];
        }

        if (!empty($result_detail['nation'])) {
            $nation_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is NULL limit 0,1" . getSlaveID());
            while ($nations = DB::fetch($nation_tmp)) {
                $nation_info[] = $nations;
            }

            $nation_id = $nation_info[0]['id'];
        }

        if (!empty($result_detail['provience'])) {
            $provience_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience='" . $result_detail['provience'] . "' and city is NULL limit 0,1" . getSlaveID());
            while ($proviences = DB::fetch($provience_tmp)) {
                $provience_info[] = $proviences;
            }
            $provience_id = $provience_info[0]['id'];
        }
        //获取同级下其他地图
        $other_list = $memory->get("map_others_{$result_detail['id']}");
        if (empty($other_list)) {
            if (empty($result_detail['nation'])) {
                $other_list = array();
                $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is NULL and id!={$result_detail['id']}" . getSlaveID());
                while ($nations_list = DB::fetch($nations_others_tmp)) {
                    $other_list[] = $nations_list;
                }
            } elseif (empty($result_detail['provience'])) {
                $other_list = array();
                $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is NULL and id!={$result_detail['id']}" . getSlaveID());

                while ($nations_list = DB::fetch($nations_others_tmp)) {
                    $other_list[] = $nations_list;
                }
            } elseif (empty($result_detail['city']) && !empty($result_detail['provience'])) {
                $other_list = array();
                $proviences_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience='" . $result_detail['provience'] . "' and city is NULL and id!={$result_detail['id']}" . getSlaveID());
                while ($proviences_list = DB::fetch($proviences_others_tmp)) {
                    $other_list[] = $proviences_list;
                }
            } elseif (empty($result_detail['area']) && !empty($result_detail['city'])) {
                $other_list = array();
                $citys_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE city='" . $result_detail['city'] . "' and area is NULL and id!={$result_detail['id']}" . getSlaveID());
                while ($citys_list = DB::fetch($citys_others_tmp)) {
                    $other_list[] = $citys_list;
                }
            }
            $memory->set("map_others_{$result_detail['id']}", $other_list, 604800);
        }
        if (!empty($other_list)) {//取15条数据
            $other_list = array_slice($other_list, 0, 16);
        }
        if (!empty($other_list)) {
            foreach ($other_list as $k => $v) { //处理显示地图名称，在<a title中显示
                $other_list_res[$k]['id'] = $v['id'];
                $other_list_res[$k]['continent'] = $v['continent'];
                $other_list_res[$k]['nation'] = $v['nation'];
                $other_list_res[$k]['provience'] = $v['provience'];
                $other_list_res[$k]['city'] = $v['city'];
                $other_list_res[$k]['area'] = $v['area'];
                $other_list_res[$k]['map_name'] = $v['map_name'];
                $other_list_res[$k]['map_name_show'] = str_replace("地图", "", $v['map_name']);
                $other_list_res[$k]['map_img'] = $v['map_img'];
                $other_list_res[$k]['from'] = $v['from'];
                $other_list_res[$k]['link'] = $v['link'];
            }
        }

        //获取洲下的所有国家
        if (empty($result_detail['nation'])) {
            $nations_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is not NULL and provience is NULL group by nation" . getSlaveID());
            while ($nations_list = DB::fetch($nations_tmp)) {
                $nation_list[] = $nations_list;
            }
            $is_continent = empty($nation_list) ? false : true;
        }
        //获取国家下的所有省份
        if (empty($result_detail['provience'])) {
            if ($result_detail['nation'] == "中国") {
                $provience_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is not NULL and city is NULL and `from`=1 group by provience" . getSlaveID());
            } else {
                $provience_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is not NULL and city is NULL group by provience" . getSlaveID());
            }
            while ($proviences_list = DB::fetch($provience_tmp)) {
                $provience_list[] = $proviences_list;
            }
            //如果国家下面没有省份则显示市
            if (empty($provience_list)) {
                $is_nation = false;
                $city_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and city is not NULL and area is NULL and `from`=1 group by city" . getSlaveID());
                while ($citys_list = DB::fetch($city_tmp)) {
                    $city_list[] = $citys_list;
                }
                $is_provience = empty($city_list) ? false : true;
            } else {
                $is_nation = true;
            }
        }
        //获取省份下的所有城市
        if (empty($result_detail['city']) && !empty($result_detail['provience'])) {
            $city_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience='" . $result_detail['provience'] . "' and city is not NULL and area is NULL group by city order by id DESC" . getSlaveID());
            while ($citys_list = DB::fetch($city_tmp)) {
                $city_list[] = $citys_list;
            }
            $is_provience = empty($city_list) ? false : true;
        }
        //获取同级下其他热门地图
        $other_rec_list = $memory->get("map_other_hot_{$result_detail['id']}");
        if (empty($other_rec_list)) {
            if (empty($result_detail['nation'])) {
                $other_rec_list = array();
                $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent!='" . $result_detail['continent'] . "' and nation is NULL and id!={$result_detail['id']} ORDER BY RAND()" . getSlaveID());
                while ($nations_list = DB::fetch($nations_others_tmp)) {
                    $other_rec_list[] = $nations_list;
                }
            } elseif (empty($result_detail['provience'])) {
                $other_rec_list = array();
                $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation!='" . $result_detail['nation'] . "' and continent='{$result_detail['continent']}' and provience is NULL and id!={$result_detail['id']} ORDER BY RAND()" . getSlaveID());
                while ($nations_list = DB::fetch($nations_others_tmp)) {
                    $other_rec_list[] = $nations_list;
                }
            } elseif (empty($result_detail['city']) && !empty($result_detail['provience'])) {
                $other_rec_list = array();
                $proviences_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience!='" . $result_detail['provience'] . "' and nation='{$result_detail['nation']}' and city is NULL and id!={$result_detail['id']} ORDER BY RAND()" . getSlaveID());
                while ($proviences_list = DB::fetch($proviences_others_tmp)) {
                    $other_rec_list[] = $proviences_list;
                }
                if (empty($other_rec_list)) {
                    $other_rec_list = array();
                    $nations_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is not NULL and id!={$result_detail['id']} ORDER BY RAND()" . getSlaveID());
                    while ($nations_list = DB::fetch($nations_others_tmp)) {
                        $other_rec_list[] = $nations_list;
                    }
                }
            } elseif (empty($result_detail['area']) && !empty($result_detail['city'])) {
                $other_rec_list = array();
                $citys_others_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE city!='" . $result_detail['city'] . "' and provience='{$result_detail['provience']}' and area is NULL and id!={$result_detail['id']} ORDER BY RAND()" . getSlaveID());
                while ($citys_list = DB::fetch($citys_others_tmp)) {
                    $other_rec_list[] = $citys_list;
                }
            }
            $memory->set("map_other_hot_{$result_detail['id']}", $other_rec_list, 604800);
        }

        if (!empty($other_rec_list)) {//取15条数据
            $other_rec_list = array_slice($other_rec_list, 0, 16);
        }
    }
    //如果如首页进入
    if ($_SERVER["HTTP_REFERER"] == "http://www.8264.com/ditu/") {
        if (!empty($result_detail['nation']) && empty($result_detail['provience'])) {
            $pageTitle = "2017最新{$result_detail['nation']}地图查询，{$result_detail['nation']}地图高清版下载，{$result_detail['nation']}地图中文版大图 - 户外资料网8264.com";
        } elseif (!empty($result_detail['continent']) && empty($result_detail['nation'])) {
            $pageTitle = "2017最新{$result_detail['continent']}地图查询，{$result_detail['continent']}地图高清版下载，{$result_detail['continent']}地图中文版大图 - 户外资料网8264.com";
        } else {
            $pageTitle = "2017最新{$result_detail['map_name']}查询，{$result_detail['map_name']}高清版下载，{$result_detail['map_name']}中文版大图 - 户外资料网8264.com";
        }
    } elseif ($result_detail['nation'] == "中国" && empty($result_detail['city'])) {
        $pageTitle = "2017最新{$result_detail['map_name']}查询，{$result_detail['map_name']}高清版下载，{$result_detail['map_name']}中文版大图 - 户外资料网8264.com";
    } else {
        $pageTitle = "{$result_detail['map_name']}全图，{$result_detail['map_name']}高清版下载 - 户外资料网8264.com";
    }
    if ($result_detail['continent'] == "世界") {
        $metakeywords = "世界地图高清版，世界地图中文版，世界地图大图，世界地图下载，世界地图";
        $metadescription = "2017最新世界地图高清版大图查询，提供各类世界地图下载，包括世界各国地图，行政图，旅游地图等，为驴友们的出行提供帮助";
    } elseif (!empty($result_detail['continent']) && empty($result_detail['nation'])) {
        $metakeywords = "{$result_detail['continent']}地图，{$result_detail['continent']}地图中文版，{$result_detail['continent']}地图高清版";
        $metadescription = "2017最新{$result_detail['continent']}地图查询，提供{$result_detail['continent']}地图高清版，中文版下载，包括地形图，电子地图高清版等各类地图，为驴友出行提供帮助";
    } elseif (!empty($result_detail['nation']) && empty($result_detail['provience'])) {
        $metakeywords = "{$result_detail['nation']}地图，{$result_detail['nation']}地图高清版，{$result_detail['nation']}行政地图，{$result_detail['nation']}交通地图，{$result_detail['nation']}旅游地图，地图下载";
        $metadescription = "2017最新{$result_detail['nation']}地图查询，最新版{$result_detail['nation']}地图高清版全图，提供电子地图信息，包含行政地图、交通地图、旅游地图等各类地图下载，为驴友提供出行等实用信息";
    } elseif (!empty($result_detail['provience']) && empty($result_detail['city'])) {
        $metakeywords = "{$result_detail['provience']}地图高清版，{$result_detail['provience']}行政地图，{$result_detail['provience']}旅游地图，{$result_detail['provience']}交通地图，地图下载";
        $metadescription = "2017最新{$result_detail['provience']}地图查询，最新版{$result_detail['provience']}地图高清版全图，提供电子地图信息，包含{$result_detail['provience']}行政地图、交通地图、旅游景点地图等各类地图下载，为驴友提供出行等实用信息";
    } else {
        $metakeywords = "{$result_detail['city']}地图高清版，{$result_detail['city']}行政地图，{$result_detail['city']}旅游地图，{$result_detail['city']}交通地图，地图下载";
        $metadescription = "2017最新{$result_detail['city']}地图查询，最新版{$result_detail['city']}地图高清版全图，提供电子地图信息，包含{$result_detail['city']}行政地图、交通地图、旅游景点地图等各类地图下载，为驴友提供出行等实用信息";
    }
    //为面包屑链接
    $continent_nav_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is NULL and city is NULL and `from`=1 order by id desc limit 0,1" . getSlaveID());
    while ($continent_navs = DB::fetch($continent_nav_tmp)) {
        $continent_nav[] = $continent_navs;
    }

    $nation_nav_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and `from`=1 limit 0,1" . getSlaveID());
    while ($nation_navs = DB::fetch($nation_nav_tmp)) {
        $nation_nav[] = $nation_navs;
    }
    $provience_nav_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience='" . $result_detail['provience'] . "' and city is NULL and `from`=1 limit 0,1" . getSlaveID());
    while ($provience_navs = DB::fetch($provience_nav_tmp)) {
        $provience_nav[] = $provience_navs;
    }
    $result_detail['map_name'] = $result_detail['map_name'];
    foreach ($other_rec_list as $k => $v) {
        $other_rec_list[$k]['id'] = $v['id'];
        $other_rec_list[$k]['map_name'] = $v['map_name'];
    }
    if (strstr($result_detail['map_name'], "下载")) {
        $down_load_name = str_replace("下载", "", $result_detail['map_name']);
    } else {
        $down_load_name = $result_detail['map_name'];
    }
    $map_name = urlencode($result_detail['map_name']);
    $map_img = urlencode($result_detail['map_img']);
    $update_date=date("Y年m月d日",$result_detail['dateline']);
    include template('map/index');
} elseif ($_GET['ctl'] == "download") {//下载图片
    //正则校验下载路径
    preg_match_all("/http\:\/\/image1\.8264\.com\/plugin\/(.*)\.jpg/iUse", $_GET['map_img'], $chk_rs);
    if (!empty($chk_rs[0][0])) {
        header('Content-type: application/jpg');
        header('Content-Disposition: attachment; filename="' . $_GET['map_name'] . '.jpg"');
        readfile($_GET['map_img']);
        exit();
    } else {
        header("HTTP/1.1 404 Not Found");
        header('Status: 404');
        exit;
    }
}
