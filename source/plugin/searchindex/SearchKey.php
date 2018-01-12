<?php
require_once DISCUZ_ROOT.'./source/plugin/components/CachedataLogger.php';
require_once DISCUZ_ROOT.'./source/plugin/components/CachedataLogger_config.php';
require_once DISCUZ_ROOT.'./source/plugin/searchindex/common.php';
require_once DISCUZ_ROOT.'./source/function/function_home.php';
require_once DISCUZ_ROOT.'./source/function/function_post.php';
require_once DISCUZ_ROOT.'./source/function/function_misc.php';

class SearchKey {
	public static function getKeywords($conditions=array(), $limit='0, 90') {
        $query = DB::query("SELECT * FROM ".DB::table('plugin_searchkey_searchindex')."
                            WHERE state = 1
						    ORDER BY searchid DESC
						    LIMIT $limit");
		$array = array();
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}

	public static function getKeywordsCount() {
		return DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('plugin_searchkey_searchindex').' WHERE state = 1');
	}

	public static function getBlodsByKeyArr($keyArr, $where) {
		$array = array();
		$query = DB::query("SELECT b.*,bf.pic, bf.message FROM ".DB::table('home_blog')." b
						    LEFT JOIN ".DB::table('home_blogfield')." bf ON bf.blogid=b.blogid
							where 1 AND {$where}
							order by b.blogid desc
							LIMIT 0,20 " . getSlaveID());
		while($value = DB::fetch($query)){
			$value['date'] = dgmdate($value['dateline'], 'Y-m-d');
			$value['avatar'] = avatar($value['uid'], 'small');
			$value['message'] = str_replace('¡¡','',$value['message']);
			$value['message'] = getstr($value['message'], 255, 0, 0, 0, -1);
			$value['message'] = trim($value['message']);
			$array[] = $value;
		}
		return $array;
	}

	public static function getForumsByKeyArr($keyArr, $where) {
		$array = array();
		$query = DB::query("SELECT t.*, p.message FROM ".DB::table('forum_thread')." AS t
							LEFT JOIN ".DB::table('forum_post')." AS p ON p.tid = t.tid AND p.first = 1
						    WHERE t.isgroup='0' AND t.displayorder>='0' AND {$where}
						    ORDER BY t.lastpost DESC
						    LIMIT 15 " . getSlaveID());
		while($value = DB::fetch($query)) {
			$value['month'] = date('m', $value['dateline']);
			$value['day'] = date('d', $value['dateline']);
			$value['message'] = messagecutstr($value['message'], 100);
			$array[$value['tid']] = procthread($value, 'Y-m-d');
		}
		return $array;
	}

	public static function getPortalByKeyArr($keyArr, $where) {
		$array = array();
		$query = DB::query("SELECT at.*,ac.viewnum, ac.commentnum FROM ".DB::table('portal_article_title')." at
						   LEFT JOIN ".DB::table('portal_article_count')." ac ON at.aid=ac.aid
						   where 1 AND {$where} order by at.aid desc LIMIT 0,13 " . getSlaveID());
		while($value = DB::fetch($query)){
			$i++;
			$value['dateline'] = dgmdate($value['dateline'], 'Y-m-d');
			$value['summary'] = preg_replace("/[\s]+/", '', $value['summary']);
			$array[] = $value;
		}
		return $array;
	}

	public static function getNeighborSearchKeyByKid($kid, $limit=24) {
		$array = array();
		if($kid==null){
			return null;
		}
		$query = DB::query("SELECT searchid, keywords FROM ".DB::table('plugin_searchkey_searchindex')."
						    where searchid > {$kid} and state = 1
							order by searchid asc
							LIMIT ".($limit/2));
		while($value = DB::fetch($query)){
			$array[] = $value;
		}
		$leftlimit = $limit - count($array);
		$query = DB::query("SELECT searchid, keywords FROM ".DB::table('plugin_searchkey_searchindex')."
						   where searchid < {$kid} and state = 1
						   order by searchid desc
						   LIMIT ".$leftlimit);
		while($value = DB::fetch($query)){
			$array[] = $value;
		}
		return $array;
	}

	public static function getKeywordByKid($kid) {
		return DB::fetch_first("SELECT * FROM ".DB::table('plugin_searchkey_searchindex')." WHERE searchid='$kid'");
	}

	public static function getAddwhereByKeyArr($keyArr) {
		$addwhere['portal'] = $addwhere['forum'] = $addwhere['blog'] = false;
		if (!empty($keyArr['rule'])) {
			$rulestrarr = array('(', ')', '&&', '##');
			foreach ($rulestrarr as $rs) {
				$rulestrcount += substr_count($keyArr['rule'], $rs);
			}
			if ($rulestrcount > 0) {
				$rulestr = str_replace($rulestrarr, array('', '', '&dfadf&', '&dfadf&'), $keyArr['rule']);
				$rulearr = explode('&dfadf&', $rulestr);
				$addwhere['portal'] = createrulewhere($keyArr['rule'], $rulearr, 'portal');
				$addwhere['forum'] = createrulewhere($keyArr['rule'], $rulearr, 'forum');
				$addwhere['blog'] = createrulewhere($keyArr['rule'], $rulearr, 'blog');
				if (!$addwhere['blog']) {
					$addwhere['blog'] = orstr($keyArr['keywords'],"b.subject like");
				}
				if (!$addwhere['portal']) {
					$addwhere['portal'] = orstr($keyArr['keywords'],"at.title LIKE");
				}
			}
		}

		if (!$addwhere['blog']) {
			$addwhere['blog'] = orstr($keyArr['keywords'],"b.subject like");
		}
		if (!$addwhere['portal']) {
			$addwhere['portal'] = orstr($keyArr['keywords'],"at.title LIKE");
		}
		if (!$addwhere['forum']) {
			$addwhere['forum'] = orstr($keyArr['keywords'],"t.subject LIKE");
		}
		return $addwhere;
	}
}

$forumoption_key = new CachedataLogger;
$forumoption_key->class = 'SearchKey';
$forumoption_key->methods = $CachedateLogger_config['SearchKey'];
//$forumoption_key->forceRefreshCache = true;
if ($_GET['nocache'] == 1) {
	$forumoption_key->forceRefreshCache = true;
}
