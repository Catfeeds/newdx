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

//�����Ϊʹ��11511�˿�,ע��master���ϰ汾�����ñ���Ϊ11511,rebuild���Ը��ݿ��������ж˿��ڱ�������Ӧ����
$memory = &discuz_memcache::instance("10.28.206.72:11511", 1);
if (!$memory->enable) {
    exit('Cache system error.');
}
//������Ľ���
$worlds = array(
    "����" => array("�ձ�", "����", "����", "�ɹ�", "Խ��", "�й�", "̩��", "����կ", "���", "����", "��������", "�¼���", "����", "���ɱ�", "ӡ��������", "������", "�Ჴ��", "����", "����", "�ϼ�����", "ӡ��", "˹������", "�������", "������˹̹", "������˹̹", "���ȱ��˹̹", "������˹̹", "��³����", "�����ݽ�", "��������", "�ͻ�˹̹", "������", "����", "������", "������", "ɳ�ذ�����", "����", "������", "������", "����", "Ҳ��", "������", "�����", "Լ��", "����˹̹", "��ɫ��", "����·˹", "������"),
    "������" => array("����", "���ô�", "ī����", "Σ������", "�����߶�", "�鶼��˹", "�������", "��˹�����", "������", "�͹���", "�Ű�", "�����", "����", "�������", "������", "�ͰͶ�˹", "�����ɴ�"),
    "������" => array("���ױ���", "ί������", "������", "������", "����������", "��϶��", "��³", "����", "����ά��", "����", "����͢", "������", "������"),
    "������" => array("�Ĵ�����", "������", "�³", "����", "�Ͳ����¼�����", "������Ⱥ��", "��Ŭ��ͼ", "쳼�", "����Ħ��", "�����˹", "���ܶ�Ⱥ��", "����"),
    "ŷ��" => array("����", "�¹�", "Ӣ��", "����", "����ʱ", "¬ɭ��", "������", "������", "�����", "�µ���", "��ʿ", "������", "����˹", "����", "���", "Ų��", "����", "����", "��ɳ����", "����ά��", "������", "�׶���˹", "�ڿ���", "����", "�ݿ�", "˹�工��", "������", "Ħ�ɸ�", "���޵���", "�����", "��������", "��������", "����������", "ϣ��"),
    "����" => array("����", "������", "ͻ��˹", "����������", "Ħ���", "��������", "ë��������", "���ڼӶ�", "�Ա���", "����", "�����ɷ���", "��ý�", "�����Ǳ���", "������", "��������", "��������", "���ص���", "����", "���", "����", "���ն�", "��������", "����¡", "���������", "է��", "�з�", "�յ�", "���������", "������", "������", "�ڸɴ�", "̹ɣ����", "¬����", "��¡��", "�չ�", "����", "ʥ����", "������", "�ޱ���", "����ά", "Īɣ�ȿ�", "��Ħ��", "����˹��", "�����", "ë����˹", "��Ͳ�Τ", "���ױ���", "�Ϸ�", "˹��ʿ��", "������", "����������", "������")
);
if ($_GET['ctl'] == "index") {//�б�ҳ��
    $pageTitle = "2017���µ�ͼ��ѯ�������ͼ���İ棬�й���ͼ��������� - ����������8264.com";
    $metakeywords = "��ͼ��ѯ�������ͼ���İ棬ȫ����ͼ����棬��ͼ����";
    $metadescription = "���µ�ͼ������ͼ��ѯ���ṩ�����ͼ���أ��������������ͼ���й���ͼ������ͼ�����ε�ͼ�ȣ�Ϊ¿���ǵĳ����ṩ����";
    include template('map/city');
} elseif ($_GET['ctl'] == "detail") {//����ҳ��
    if (is_numeric($_GET['id'])) {
        //��ȡ��������
        if (!empty($_GET['id'])) {
            $mapid = addslashes($_GET['id']);
            $result_detail = DB::fetch_first("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE id=" . $mapid . getSlaveID());
        }
        if ($result_detail === false) {
            header("HTTP/1.1 404 Not Found");
            header('Status: 404');
            exit;
        }

		//�����й��¶ȴ���ͼ5142
		if ($mapid=='5142'||$mapid=='5017'||$mapid=='5126'||$mapid=='5583') {
			header("HTTP/1.1 404 Not Found");
            header('Status: 404');
            exit;
		}

        //�ж������Ƿ���link
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
        //��ȡͬ����������ͼ
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
        if (!empty($other_list)) {//ȡ15������
            $other_list = array_slice($other_list, 0, 16);
        }
        if (!empty($other_list)) {
            foreach ($other_list as $k => $v) { //������ʾ��ͼ���ƣ���<a title����ʾ
                $other_list_res[$k]['id'] = $v['id'];
                $other_list_res[$k]['continent'] = $v['continent'];
                $other_list_res[$k]['nation'] = $v['nation'];
                $other_list_res[$k]['provience'] = $v['provience'];
                $other_list_res[$k]['city'] = $v['city'];
                $other_list_res[$k]['area'] = $v['area'];
                $other_list_res[$k]['map_name'] = $v['map_name'];
                $other_list_res[$k]['map_name_show'] = str_replace("��ͼ", "", $v['map_name']);
                $other_list_res[$k]['map_img'] = $v['map_img'];
                $other_list_res[$k]['from'] = $v['from'];
                $other_list_res[$k]['link'] = $v['link'];
            }
        }
        //��ȡ���µ����й���
        if (empty($result_detail['nation'])) {
            $nations_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is not NULL and provience is NULL group by nation" . getSlaveID());
            while ($nations_list = DB::fetch($nations_tmp)) {
                $nation_list[] = $nations_list;
            }
            $is_continent = true;
        }
        //��ȡ�����µ�����ʡ��
        if (empty($result_detail['provience'])) {
            $provience_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is not NULL and city is NULL group by provience" . getSlaveID());
            while ($proviences_list = DB::fetch($provience_tmp)) {
                $provience_list[] = $proviences_list;
            }
            //�����������û��ʡ������ʾ��
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
        //��ȡʡ���µ����г���
        if (empty($result_detail['city']) && !empty($result_detail['provience'])) {
            $city_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience='" . $result_detail['provience'] . "' and city is not NULL and area is NULL and `from`=1 group by city" . getSlaveID());
            while ($citys_list = DB::fetch($city_tmp)) {
                $city_list[] = $citys_list;
            }
            $is_provience = true;
        }
        //��ȡͬ�����������ŵ�ͼ
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

        if (!empty($other_rec_list)) {//ȡ15������
            $other_rec_list = array_slice($other_rec_list, 0, 16);
        }
    } else {
        //��ȡ��������
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
//		//��������̨���ͼ
//		if ($result_detail['provience'] =='���'||$result_detail['provience'] =='̨��'||$mapid='cn'||$mapid='china') {
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
        //��ȡͬ����������ͼ
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
        if (!empty($other_list)) {//ȡ15������
            $other_list = array_slice($other_list, 0, 16);
        }
        if (!empty($other_list)) {
            foreach ($other_list as $k => $v) { //������ʾ��ͼ���ƣ���<a title����ʾ
                $other_list_res[$k]['id'] = $v['id'];
                $other_list_res[$k]['continent'] = $v['continent'];
                $other_list_res[$k]['nation'] = $v['nation'];
                $other_list_res[$k]['provience'] = $v['provience'];
                $other_list_res[$k]['city'] = $v['city'];
                $other_list_res[$k]['area'] = $v['area'];
                $other_list_res[$k]['map_name'] = $v['map_name'];
                $other_list_res[$k]['map_name_show'] = str_replace("��ͼ", "", $v['map_name']);
                $other_list_res[$k]['map_img'] = $v['map_img'];
                $other_list_res[$k]['from'] = $v['from'];
                $other_list_res[$k]['link'] = $v['link'];
            }
        }

        //��ȡ���µ����й���
        if (empty($result_detail['nation'])) {
            $nations_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE continent='" . $result_detail['continent'] . "' and nation is not NULL and provience is NULL group by nation" . getSlaveID());
            while ($nations_list = DB::fetch($nations_tmp)) {
                $nation_list[] = $nations_list;
            }
            $is_continent = empty($nation_list) ? false : true;
        }
        //��ȡ�����µ�����ʡ��
        if (empty($result_detail['provience'])) {
            if ($result_detail['nation'] == "�й�") {
                $provience_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is not NULL and city is NULL and `from`=1 group by provience" . getSlaveID());
            } else {
                $provience_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE nation='" . $result_detail['nation'] . "' and provience is not NULL and city is NULL group by provience" . getSlaveID());
            }
            while ($proviences_list = DB::fetch($provience_tmp)) {
                $provience_list[] = $proviences_list;
            }
            //�����������û��ʡ������ʾ��
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
        //��ȡʡ���µ����г���
        if (empty($result_detail['city']) && !empty($result_detail['provience'])) {
            $city_tmp = DB::query("SELECT * FROM " . DB::table('plugin_seo_map') . " WHERE provience='" . $result_detail['provience'] . "' and city is not NULL and area is NULL group by city order by id DESC" . getSlaveID());
            while ($citys_list = DB::fetch($city_tmp)) {
                $city_list[] = $citys_list;
            }
            $is_provience = empty($city_list) ? false : true;
        }
        //��ȡͬ�����������ŵ�ͼ
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

        if (!empty($other_rec_list)) {//ȡ15������
            $other_rec_list = array_slice($other_rec_list, 0, 16);
        }
    }
    //�������ҳ����
    if ($_SERVER["HTTP_REFERER"] == "http://www.8264.com/ditu/") {
        if (!empty($result_detail['nation']) && empty($result_detail['provience'])) {
            $pageTitle = "2017����{$result_detail['nation']}��ͼ��ѯ��{$result_detail['nation']}��ͼ��������أ�{$result_detail['nation']}��ͼ���İ��ͼ - ����������8264.com";
        } elseif (!empty($result_detail['continent']) && empty($result_detail['nation'])) {
            $pageTitle = "2017����{$result_detail['continent']}��ͼ��ѯ��{$result_detail['continent']}��ͼ��������أ�{$result_detail['continent']}��ͼ���İ��ͼ - ����������8264.com";
        } else {
            $pageTitle = "2017����{$result_detail['map_name']}��ѯ��{$result_detail['map_name']}��������أ�{$result_detail['map_name']}���İ��ͼ - ����������8264.com";
        }
    } elseif ($result_detail['nation'] == "�й�" && empty($result_detail['city'])) {
        $pageTitle = "2017����{$result_detail['map_name']}��ѯ��{$result_detail['map_name']}��������أ�{$result_detail['map_name']}���İ��ͼ - ����������8264.com";
    } else {
        $pageTitle = "{$result_detail['map_name']}ȫͼ��{$result_detail['map_name']}��������� - ����������8264.com";
    }
    if ($result_detail['continent'] == "����") {
        $metakeywords = "�����ͼ����棬�����ͼ���İ棬�����ͼ��ͼ�������ͼ���أ������ͼ";
        $metadescription = "2017���������ͼ������ͼ��ѯ���ṩ���������ͼ���أ��������������ͼ������ͼ�����ε�ͼ�ȣ�Ϊ¿���ǵĳ����ṩ����";
    } elseif (!empty($result_detail['continent']) && empty($result_detail['nation'])) {
        $metakeywords = "{$result_detail['continent']}��ͼ��{$result_detail['continent']}��ͼ���İ棬{$result_detail['continent']}��ͼ�����";
        $metadescription = "2017����{$result_detail['continent']}��ͼ��ѯ���ṩ{$result_detail['continent']}��ͼ����棬���İ����أ���������ͼ�����ӵ�ͼ�����ȸ����ͼ��Ϊ¿�ѳ����ṩ����";
    } elseif (!empty($result_detail['nation']) && empty($result_detail['provience'])) {
        $metakeywords = "{$result_detail['nation']}��ͼ��{$result_detail['nation']}��ͼ����棬{$result_detail['nation']}������ͼ��{$result_detail['nation']}��ͨ��ͼ��{$result_detail['nation']}���ε�ͼ����ͼ����";
        $metadescription = "2017����{$result_detail['nation']}��ͼ��ѯ�����°�{$result_detail['nation']}��ͼ�����ȫͼ���ṩ���ӵ�ͼ��Ϣ������������ͼ����ͨ��ͼ�����ε�ͼ�ȸ����ͼ���أ�Ϊ¿���ṩ���е�ʵ����Ϣ";
    } elseif (!empty($result_detail['provience']) && empty($result_detail['city'])) {
        $metakeywords = "{$result_detail['provience']}��ͼ����棬{$result_detail['provience']}������ͼ��{$result_detail['provience']}���ε�ͼ��{$result_detail['provience']}��ͨ��ͼ����ͼ����";
        $metadescription = "2017����{$result_detail['provience']}��ͼ��ѯ�����°�{$result_detail['provience']}��ͼ�����ȫͼ���ṩ���ӵ�ͼ��Ϣ������{$result_detail['provience']}������ͼ����ͨ��ͼ�����ξ����ͼ�ȸ����ͼ���أ�Ϊ¿���ṩ���е�ʵ����Ϣ";
    } else {
        $metakeywords = "{$result_detail['city']}��ͼ����棬{$result_detail['city']}������ͼ��{$result_detail['city']}���ε�ͼ��{$result_detail['city']}��ͨ��ͼ����ͼ����";
        $metadescription = "2017����{$result_detail['city']}��ͼ��ѯ�����°�{$result_detail['city']}��ͼ�����ȫͼ���ṩ���ӵ�ͼ��Ϣ������{$result_detail['city']}������ͼ����ͨ��ͼ�����ξ����ͼ�ȸ����ͼ���أ�Ϊ¿���ṩ���е�ʵ����Ϣ";
    }
    //Ϊ���м����
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
    if (strstr($result_detail['map_name'], "����")) {
        $down_load_name = str_replace("����", "", $result_detail['map_name']);
    } else {
        $down_load_name = $result_detail['map_name'];
    }
    $map_name = urlencode($result_detail['map_name']);
    $map_img = urlencode($result_detail['map_img']);
    $update_date=date("Y��m��d��",$result_detail['dateline']);
    include template('map/index');
} elseif ($_GET['ctl'] == "download") {//����ͼƬ
    //����У������·��
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
