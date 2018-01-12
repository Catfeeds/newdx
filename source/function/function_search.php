<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_search.php 19467 2011-01-04 06:36:33Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
function searchkey($keyword, $field, $returnsrchtxt = 0) {
	$srchtxt = '';
	if($field && $keyword) {
		if(preg_match("(AND|\+|&|\s)", $keyword) && !preg_match("(OR|\|)", $keyword)) {
			$andor = ' AND ';
			$keywordsrch = '1';
			$keyword = preg_replace("/( AND |&| )/is", "+", $keyword);
		} else {
			$andor = ' OR ';
			$keywordsrch = '0';
			$keyword = preg_replace("/( OR |\|)/is", "+", $keyword);
		}
		$keyword = str_replace('*', '%', addcslashes($keyword, '%_'));
		$srchtxt = $returnsrchtxt ? $keyword : '';
		foreach(explode('+', $keyword) as $text) {
			$text = trim($text);
			if($text) {
				$keywordsrch .= $andor;
				$keywordsrch .= str_replace('{text}', $text, $field);
			}
		}
		$keyword = " AND ($keywordsrch)";
	}
	return $returnsrchtxt ? array($srchtxt, $keyword) : $keyword;
}

function highlight($text, $words, $prepend) {
	$text = str_replace('\"', '"', $text);
	foreach($words AS $key => $replaceword) {
		$text = str_replace($replaceword, '<highlight>'.$replaceword.'</highlight>', $text);
	}
	return "$prepend$text";
}

function bat_highlight($message, $words, $color = '#ff0000') {
	if(!empty($words)) {
		$highlightarray = explode(' ', $words);
		$sppos = strrpos($message, chr(0).chr(0).chr(0));
		if($sppos !== FALSE) {
			$specialextra = substr($message, $sppos + 3);
			$message = substr($message, 0, $sppos);
		}
		$message = preg_replace(array("/(^|>)([^<]+)(?=<|$)/sUe", "/<highlight>(.*)<\/highlight>/siU"), array("highlight('\\2', \$highlightarray, '\\1')", "<strong><font color=\"$color\">\\1</font></strong>"), $message);
		if($sppos !== FALSE) {
			$message = $message.chr(0).chr(0).chr(0).$specialextra;
		}
	}
	return $message;
}

// 纵横搜索补丁 热门推荐词 BEGIN
// 通过接口获取站点推荐词
function getRecWordsBySId() {
    global $_G;
 
    $s_id = $_G['setting']['my_siteid'];
    $my_sitekey= $_G['setting']['my_sitekey'];
    $data = array();
    $ts = time();
 
    if ($s_id) {
        $kname = 'search_recommend_words_' . $s_id;
        loadcache($kname);
 
        if (isset($_G['cache'][$kname]['ts']) && (TIMESTAMP - $_G['cache'][$kname]['ts'] <= 21600)) {
            $data = $_G['cache'][$kname]['result'];
        } else {
            $api_url = 'http://api.discuz.qq.com/search/recwords/get';
            $need_num = 14;
            $params = array(
                'need_num' => $need_num,
                'need_random' => false,
                'response_format' => 'php',
                's_id' => $s_id,
                'version' => '1'
            );
            ksort($params);
            $params['sig'] = md5(http_build_query($params, '', '&') . '|' . $my_sitekey . '|' . $ts);
            $params['ts'] = $ts;
            $response = dfsockopen($api_url, 0, http_build_query($params, '', '&'), '', false, $_G['setting']['cloud_api_ip']);
            $result = (array) unserialize($response);
     
            if (isset($result['status']) && $result['status'] === 0) {
                $data = $result['result'];
                if ($data) {
                    save_syscache($kname, array('ts' => TIMESTAMP, 'result' => $data));
                }
            }
        }
    }
    return $data;
}
 
// 兼容20111010补丁包新添的makeSearchSignUrl()方法
if (!function_exists('makeSearchSignUrl')) {
    function makeSearchSignUrl() {
        global $_G;
 
        $url = '';
        $params = array();
        $my_search_data = unserialize($_G['setting']['my_search_data']);
        $my_siteid = $_G['setting']['my_siteid'];
        $my_sitekey= $_G['setting']['my_sitekey'];
        require_once libfile('function/cloud');
        if($my_search_data['status'] && getcloudappstatus('search') && $my_siteid) {
            $my_extgroupids = array();
            $_extgroupids = explode("\t", $_G['member']['extgroupids']);
            foreach($_extgroupids as $v) {
                if ($v) {
                    $my_extgroupids[] = $v;
                }
            }
            $my_extgroupids_str = implode(',', $my_extgroupids);
            $params = array('sId' => $my_siteid,
                'ts' => time(),
                'cuId' => $_G['uid'],
                'cuName' => $_G['username'],
                'gId' => intval($_G['groupid']),
                'agId' => intval($_G['adminid']),
                'egIds' => $my_extgroupids_str,
                // 'fIds' => $params['fIds'],
                'fmSign' => '',
            );
            $groupIds = array($params['gId']);
            if ($params['agId']) {
                $groupIds[] = $params['agId'];
            }
            if ($my_extgroupids) {
                $groupIds = array_merge($groupIds, $my_extgroupids);
            }
 
            $groupIds = array_unique($groupIds);
            foreach($groupIds as $v) {
                $key = 'ugSign' . $v;
                $params[$key] = '';
            }
            $params['sign'] = md5(implode('|', $params) . '|' . $my_sitekey);
     
            $params['charset'] = $_G['charset'];
            $mySearchData = unserialize($_G['setting']['my_search_data']);
            if ($mySearchData['domain']) {
                $domain = $mySearchData['domain'];
            } else {
                $domain = 'search.discuz.qq.com';
            }
            $url = 'http://' . $domain . '/f/discuz';
        }
        return !empty($url) ? array($url, $params) : array();
    }
}
// 纵横搜索补丁 热门推荐词 END


?>