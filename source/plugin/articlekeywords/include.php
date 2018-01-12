<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/articlekeywords/cache.php';

global $articlekeyword_links;
function link_to_code($metches) {
	global $articlekeyword_links;
	static $i = -1;
	++$i;
	$articlekeyword_links[$i] = $metches[0];
	return "%%%%tag$i%%%%";
}

function code_to_link($metches) {
	global $articlekeyword_links;
	return $articlekeyword_links[$metches[1]];
}
/**
 * ���������滻�ַ���
 * $needle : ��Ҫ�滻���ַ�
 * $replace : �滻��ʲô�ַ�
 * $haystack : ��Ҫ�������ַ���
 * $postype : �滻���࣬1Ϊ��Сд���֣�0Ϊ������
 */
function str_replace_once($needle, $replace, $haystack , $postype=1) {
	$needle = (string)$needle;
	$pos = $postype==1 ? strpos($haystack, $needle) : stripos($haystack, $needle);
	if ($pos === false) {
	  return $haystack;
	}
	return substr_replace($haystack, $replace, $pos, strlen($needle));
}
class ArticleKeywords
{
	//��������ģʽ�滻��mode=0ΪĬ��ֻ���ؼ����滻Ϊ���ӣ�mode=1Ϊ�滻Ϊ��������ʽ��Ʒ������(Ʒ�Ƽ�飬��Ʒ������)
    public function parseArticle($article, $mode=0)
    {
		global $articlekeyword_links,$_G;
        $articlekeyword_links = array();
		/*ת���������ӣ���Ƶ��js��ǩ��������������*/
		$article = preg_replace_callback('/\<(a|script|embed|param|img)[^>]*>(.*?<\/\1>)?/i', 'link_to_code', $article);
		/*ת������html���ñ�ǩ����*/
		$article = preg_replace_callback('/\<(font|size|color|align|p|strong)[^>]*>/iUS', 'link_to_code', $article);
		$needparse = $this->getKeywordsCache();
        foreach($needparse as $key => $link){
			if(in_array($key,array('RAN','YES','zbbidRelation')) || is_numeric($key)) continue;
			//��ǰ���ڵ�outdo����֪�ǹ��˵�ʲô��zbbid����Ʒ��-��Ʒ���ϵ�������滻����
			if($key=='outdo'){

			}else{
				if($link['type']=='brand' && $mode==1){
					list( ,$brandtid) = explode("-", $link['link']);	//ֱ�Ӵ��Ѵ滺���е�����ȡƷ��ID����װ��������
					$thislink = '<a href="'.$link['link'].'" class="keyword" target="_blank">'.$key.'</a> (<a href="'.$link['link'].'" class="keyword" target="_blank" title="'.$key.'Ʒ�Ƶļ�飬����鿴">Ʒ�Ƽ��</a>��<a href="http://www.8264.com/zhuangbei-0-0-'.$needparse['zbbidRelation'][$brandtid].'-5-1" class="keyword" target="_blank" title="'.$key.'Ʒ�ƵĲ�Ʒ�⣬����鿴">��Ʒ</a>) ';
				}else{
					$thislink = '<a href="'.$link['link'].'" class="keyword" target="_blank">'.$key.'</a>';
				}
				// eval("\$article = str_replace_once(\$key , \$thislink , \$article , ".($link['type']=='brand' ? "0" : "1").");");
				$article = $link['type']=='brand' ? str_replace_once($key , $thislink , $article , 0) : str_replace_once($key , $thislink , $article , 1);
			}
        }
		/*������ת������ת����ԭ������*/
		$article = preg_replace_callback('/%%%%tag(\d+)%%%%/', 'code_to_link', $article);
        return $article;
    }

    private function getKeywords()
    {
        $keywords = array();
        $notinarr = array('����','����','�Ϸ�');
        //����
		/*
        $query= DB::query("SELECT mr.*, r.tid FROM ".DB::table('mudidi_scapearea')." AS mr
                           LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = mr.sn");
        while ($value = DB::fetch($query)) {
            if(in_array($value['name'],$notinarr)){
                continue;
            }
            $keywords[$value['name']]['link'] = getglobal('config/web/forum')."thread-{$value['tid']}-1-1.html";
            $keywords[$value['name']]['type'] = "spot";
        }
		//����
        $query= DB::query("SELECT mr.*, r.tid FROM ".DB::table('mudidi_region')." AS mr
                           LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = mr.sn");
        while ($value = DB::fetch($query)) {
            if(in_array($value['name'],$notinarr)){
                continue;
            }
			$keywords[$value['name']]['type'] = "region";
            $keywords[$value['name']]['link'] = getglobal('config/web/forum')."thread-{$value['tid']}-1-1.html";
        }*/
		//��Ӷ�ɽ���ȡ�ؼ���
		$query = DB::query("SELECT o.tid, o.value FROM ".DB::table('forum_typeoptionvar')." AS o
						   RIGHT JOIN ".DB::table('forum_thread')." AS t ON o.tid = t.tid
						   WHERE o.fid = 392 AND o.optionid = 144
								  AND t.displayorder >= 0 AND t.closed = 0 AND o.value != '' AND o.value != '��'");
		while ($value = DB::fetch($query)) {
            if(in_array($value['value'],$notinarr)){
                continue;
            }
            $keywords[$value['value']]['link'] = getglobal('config/web/portal')."shanfeng-{$value['tid']}";
            $keywords[$value['value']]['type'] = "shanfeng";
        }
		/**
		 * Ʒ�ƹؼ��ֶ�ȡ
		 * array zbbidRelation ������ȡƷ����װ�����Ӧ��ϵ 2014��7��25��
		 * ���ڽ��װ�����Ʒ��Ʒ�ƹҹ��滻ʱ��Ʒ�Ʒ���ID��װ�������ID��һ��
		 */
		// $query = DB::query("SELECT id, tid , ename , cname FROM ".DB::table('dianping_brand_info')." WHERE ispublish = 1");
		// while ($value = DB::fetch($query)) {
		// 	if(in_array($value['ename'],$notinarr) || in_array($value['cname'],$notinarr)){
  //               continue;
  //           }
		// 	if(!empty($value['ename'])){
		// 		$keywords[$value['ename']]['link'] = getglobal('config/web/portal')."pinpai-{$value['tid']}";
		// 		$keywords[$value['ename']]['type'] = "brand";
		// 	}
		// 	if(!empty($value['cname'])){
		// 		$keywords[$value['cname']]['link'] = getglobal('config/web/portal')."pinpai-{$value['tid']}";
		// 		$keywords[$value['cname']]['type'] = "brand";
		// 	}
		// 	$keywords['zbbidRelation'][$value['tid']] = $value['bid'];
		// }
        $query = DB::query("SELECT * FROM ".DB::table('plugin_articlekeywords')." WHERE enabled = 1 ORDER BY CASE WHEN 1 THEN -LENGTH(keyword) END");
        while ($value = DB::fetch($query)) {
            if(in_array($value['value'],$notinarr)){
                continue;
            }
            $keywords[$value['keyword']]['link'] = $value['link'];
            $keywords[$value['keyword']]['type'] = "admin";
        }
        return $keywords;
    }

	private function getKeywordsCache() {
		global $_G;
		static $isfilecache, $allowmem;
		$now = time();
		$keywordData = array();
		//����memcache�����ж� modify by wangqi 20121011
		if($isfilecache === null) {
			$isfilecache = getglobal('config/cache/type') == 'file';
			$allowmem = memory('check');
		}
		if ($allowmem){
			if($_G['gp_nocache'] == 1) memory('rm', 'cache_articlekeywords');
			$keywordData = memory('get', 'cache_articlekeywords');
			if(!empty($keywordData)) return $keywordData;
		}
		if ($isfilecache && empty($keywordData)){
			$cache = new PluginCache();
			$cache->filename_pre = 'articlekeywords_';
			$cacheData = $cache->loadCache('data');
			if (isset($cacheData['dateline']) && ($cacheData['dateline'] + 3600 * 24) > $now) {
				$keywordData = $cacheData['data'];
				return $keywordData;
			}
		}
		$keywordData = $this->getKeywords();
		if (!$keywordData) {
			return null;
		}
		$allowmem && (memory('set', 'cache_articlekeywords', $keywordData, 3600 * 24));
		if ($isfilecache){
			$cacheData = array(
				'data' => $keywordData,
				'dateline' => $now,
			);
			$cache->writeCache('data', $cacheData);
		}
		//end
		return $keywordData;
	}
}
