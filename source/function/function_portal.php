<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_portal.php 14914 2010-08-17 03:24:34Z zhangguosheng $
 */

function category_remake($catid) {
	global $_G;

	$cat = $_G['cache']['portalcategory'][$catid];
	if(empty($cat)) return array();

	foreach ($_G['cache']['portalcategory'] as $value) {
		if($value['catid'] == $cat['upid']) {
			$cat['ups'][$value['catid']] = $value;
			$upid = $value['catid'];
			while(!empty($upid)) {
				if(!empty($_G['cache']['portalcategory'][$upid]['upid'])) {
					$upid = $_G['cache']['portalcategory'][$upid]['upid'];
					$cat['ups'][$upid] = $_G['cache']['portalcategory'][$upid];
				} else {
					$upid = 0;
				}
			}
		} elseif($value['upid'] == $cat['catid']) {
			$cat['subs'][$value['catid']] = $value;
		} elseif($value['upid'] == $cat['upid']) {
			$cat['others'][$value['catid']] = $value;
		}
	}
	if(!empty($cat['ups'])) $cat['ups'] = array_reverse($cat['ups'], TRUE);
	return $cat;
}

function getportalcategoryurl($catid) {
	if(empty($catid)) return '';
	loadcache('portalcategory');
	$portalcategory = getglobal('cache/portalcategory');
	if($portalcategory[$catid]) {
		return $portalcategory[$catid]['caturl'];
	} else {
		return '';
	}
}

//��ҳ-����Ѷ-��װ����Ѷ
//�ݹ��ѯװ����Ѷ
function getArtcile204($starttime, $endtime, $catids, $article204_array = array()){

	$limit = 3;
	if(count($article204_array) >= 1){
		$limit = 2;
	}
	$conditions = "catid in ({$catids}) and pic !='' and status='0' and dateline >= $starttime and dateline < $endtime ";
	$sql   = "SELECT aid,title FROM ".DB::table('portal_article_title')." WHERE {$conditions} ORDER BY dateline DESC LIMIT $limit " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		$article204_array[date('m-d', $starttime)][$v['aid']]['aid'] = $v['aid'];
		$article204_array[date('m-d', $starttime)][$v['aid']]['title'] = cutstr($v['title'], 72);
	}
	if(count($article204_array) >= 6){
		return $article204_array;
	}else{
		return getArtcile204($starttime-86400, $endtime-86400, $catids, $article204_array);
	}
}


/***����ѧУ  ר��  *********/
function xuexiaoStatistics($aid,$catid,$uid){
    //����֪ʶ
    /**$catShow = category_remake(238);
    $catShow["children"][] =  238;
    var_dump(dimplode($catShow["children"]));die;**/

    $zhishi_category = array('242','950','931','915','916','917','918','919','921','920','951','952','953','238');
    if($aid&&$uid&&in_array($catid,$zhishi_category)){
        $jiluOne =DB::fetch_first("SELECT * FROM " . DB::table('portal_article_xuexiao_statistics') . " WHERE aid ='{$aid}' AND catid ='{$catid}' AND uid = '{$uid}'  " . getSlaveID());
        if(!$jiluOne){

            $data['aid'] = $aid;
            $data['catid'] = $catid;
            $data['uid'] = $uid;
            $data['dateline'] = time();
            DB::insert('portal_article_xuexiao_statistics', $data);
        }
    }


}

/**
 * ��վ�ӻƽ̨ȡ���ݣ�������
 * $params ����Ĳ��� array
 * $appsecret ������Կ string
 * 
 * ���� $cache_key ��memchacheȡ���ݣ����û�����ݣ��ж��Ƿ�������־λ����־λ��������һ������
 * Ŀ�ģ���������ʱ�����û�л������ݣ�ֻ��һ������ȥ�ƽ̨�������ݡ�����ƽ̨���ع���
 */

function get_hd_data($params, $appsecret, $cache_key, $cache_time = '86400'){
	global $_G;

	$return_data = memory('get', $cache_key);
	if(!$return_data || ($_G['gp_nocache'] == 1 && $_G['groupid'] == 1) ){
		$rerurn_data_flag = memory('get', $cache_key."_flag");
		if($rerurn_data_flag && $_G['gp_nocache'] != 1 && $_G['groupid'] != 1){
			return false;
		}else{
			memory('set', $cache_key.'_flag', '1', 60);

			$url = global_build_url($params, $appsecret);
			$json_data = requestRemoteData($url);
			$data = json_decode($json_data, true);
			if ($data['errorCode'] == 0) {
				$return_data =  iconv_array($data['result'], 'UTF-8', 'GBK');
			}else{
				return false;
			}
			memory('set', $cache_key, $return_data, $cache_time);
		}
	}
	return $return_data;
}


?>