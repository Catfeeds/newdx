<?php
/**
 * Created by PhpStorm.
 * User: Lgt
 * Date: 14-10-15
 * Time: ����11:19
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class zone
{
    function get_foreign($first_alias = '', $second_alias = '')
    {
        if ($first_alias && $second_alias) {
            $sql = "SELECT country_id as {$first_alias} , country_name as {$second_alias} FROM " . DB::table('plugin_foreign_country');
        } else {
            $sql = "SELECT country_id , country_name FROM " . DB::table('plugin_foreign_country');
        }
        $foreign_countries = array();
        $query = DB::query($sql);
        while ($countries = DB::fetch($query)) {
            $foreign_countries[$countries['codeid']] = $countries;
        }
        return $foreign_countries;
    }

    /**
     * ��ȡ����ʡ�е���
     * @param Int $codeid ʡ��id��Ĭ��Ϊ0����ʱ����������ʡ
     * @param Int $showlevel ��ʾ����1Ϊֻ���ص�ǰ����2Ϊ������һ������������Ϣ����child�ֶ��У�3Ϊ������һ��Ҳ���ص���Ӧ������child��
     * @return Array
     */
    function get_region($codeid = 0, $showlevel = 1)
    {
        $_where = '';
        $return = array();
        $mylevel = substr($codeid, 2, 4) == '0000' ? 1 : (substr($codeid, 4, 2) == '00' ? 2 : 3);
        if ($codeid > 0) {
            $_where = "codeid = {$codeid} ";
        } else {
            $_where = "level <= " . $showlevel;
        }
        if ($mylevel < 3) {
            switch ($showlevel) {
                case 1:
                    break;
                case 2:
                    $_where .= $mylevel == 1 ? "OR (shengid = {$codeid} AND level = 2)" : "OR (shiid = {$codeid} AND level = 3)";
                    break;
                case 3:
                    $_where .= $mylevel == 1 ? "OR shengid = {$codeid}" : "OR shiid = {$codeid}";
                    break;
            }
        }
        if (!empty($_where)) {
            $sql = "SELECT cityname, shengid, shiid ,codeid FROM " . DB::table('plugin_city_code') . " where " . ltrim($_where, 'OR');
        }
        $_query = DB::query($sql);
        while ($provinces = DB::fetch($_query)) {
            $_temp[$provinces['codeid']] = $provinces;
        }
        foreach ($_temp as $_k => $_v) {
            switch ($mylevel) {
                case 1:
                    if ($_v['shengid'] == 0) {
                        $return[$_k] = $_v;
                    } elseif ($_v['shiid'] == 0) {
                        $return[$_v['shengid']]['child'][$_k] = $_v;
                    } else {
                        $return[$_v['shengid']]['child'][$_v['shiid']]['child'][$_k] = $_v;
                    }
                    break;
                case 2:
                    if ($_v['shiid'] == 0) {
                        $return[$_k] = $_v;
                    } else {
                        $return[$_v['shiid']]['child'][$_k] = $_v;
                    }
                    break;
                case 3:
                    if ($_v['cityname']) {
                        $_v['cityname'] = str_replace('ʡ', '', $_v['cityname']);
                        $_v['cityname'] = str_replace('��', '', $_v['cityname']);
                        $_v['cityname'] = str_replace('����', '', $_v['cityname']);
                        $_v['cityname'] = str_replace('׳��', '', $_v['cityname']);
                        $_v['cityname'] = str_replace('ά���', '', $_v['cityname']);
                        $_v['cityname'] = str_replace('������', '', $_v['cityname']);
                        $_v['cityname'] = str_replace('�ر�������', '', $_v['cityname']);
                    }
                    $return[$_k] = $_v;
                    break;
            }
        }
        return $return;
    }

    /*��·�б�ҳ����ѡ��󣬶�չʾ����·��ȡ��·��������*/
    function getlinecross($tid){
        $query =  DB::query("SELECT province,city FROM ".DB::table('dianping_line_cross')." where tid = ".$tid .' ORDER BY id asc');
        while($rt = DB::fetch($query)){
            $linecross[] = $rt;
        }
        return $linecross;
    }

    /*��·ͬ����ʡ�л�ȡtid��������ȡ��Ӧ����·*/
    function getsamecross($tid,$proids,$limit){
        $query =  DB::query("SELECT distinct tid FROM ".DB::table('dianping_line_cross')." where tid <> ".$tid .' and province = '.$proids.' ORDER BY id desc limit '.$limit );
        while($rt = DB::fetch($query)){
            $linecross[] = $rt;
        }
        foreach($linecross as $k => $v){
            $tid_arr[] = $v['tid'];
        }
        $tids = implode(',',$tid_arr);
        return $tids;
    }
    //��ȡ��·line_region�����Ϣ����line_cross���cityid��Ӧ���������������
    function getlineregion(){
        $query =  DB::query("SELECT id,provinceid,name,num FROM ".DB::table('dianping_line_region').' where num > 0  ORDER BY num desc , id asc');
        while($rt = DB::fetch($query)){
            $lineregion_[] = $rt;
        }
        foreach($lineregion_ as $key => $val){
            $lineregion['onlycity'][$val['id']]= $val;
            $lineregion['onlypro'][$val['provinceid']][$val['id']]=$val;
            $lineregion['allpro'][$val['provinceid']] += $val['num'];
        }
        return  $lineregion;
    }
    //��������������ȡ��·
    function  getcrosslist($where){
        $query = DB::query("SELECT tid, province, city, ltype, ltime FROM ".DB::table("dianping_line_cross")." where ".$where." order by id asc" );
        while($rt = DB::fetch($query)){
            $crosslist[] = $rt;
        }
        return $crosslist;
    }
}