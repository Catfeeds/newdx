<?php
require_once DISCUZ_ROOT.'./source/function/function_post.php';
require_once DISCUZ_ROOT.'./source/plugin/components/CachedataLogger.php';
require_once DISCUZ_ROOT.'./source/plugin/components/CachedataLogger_config.php';

class ForumOptionMudidi {
	function getAreaData() {
		$area = array(
			'0' => array(),
			'1' => array(),
		);
		
		$query = DB::query("SELECT * FROM ".DB::table('mudidi_region')." WHERE sn REGEXP '^1-3-[[:digit:]]+$' ORDER BY py ASC");
		while ($value = DB::fetch($query)) {
			$sub_query = DB::query("SELECT * FROM ".DB::table('mudidi_scapearea')." WHERE sn REGEXP '^{$value['sn']}-[[:digit:]]+-[[:digit:]]+$' ORDER BY py ASC");
			$array = array();
			while ($sub_value = DB::fetch($sub_query)) {
				$array[$sub_value['sn']] = array(
					'name' => mb_convert_encoding($sub_value['py'].'_'.$sub_value['name'], 'UTF-8', 'GBK')
				);
			}
			
			$area['0'][$value['sn']] = array(
				'name' => mb_convert_encoding($value['py'].'_'.$value['name'], 'UTF-8', 'GBK'),
				'child' => $array
			);
		}
		
		$query = DB::query("SELECT * FROM ".DB::table('mudidi_region')." WHERE sn != '1-3' AND sn REGEXP '^[[:digit:]]+-[[:digit:]]+$' ORDER BY py ASC");
		while ($value = DB::fetch($query)) {
			$sub_query = DB::query("SELECT * FROM ".DB::table('mudidi_scapearea')." WHERE sn REGEXP '^{$value['sn']}-[[:digit:]]+-[[:digit:]]+-[[:digit:]]+$' ORDER BY py ASC");
			$array = array();
			while ($sub_value = DB::fetch($sub_query)) {
				$array[$sub_value['sn']] = array(
					'name' => mb_convert_encoding($sub_value['py'].'_'.$sub_value['name'], 'UTF-8', 'GBK')
				);
			}
			
			$area['1'][$value['sn']] = array(
				'name' => mb_convert_encoding($value['py'].'_'.$value['name'], 'UTF-8', 'GBK'),
				'child' => $array
			);
		}
		
		return $area;
	}
	
	function getJsAreaSelectByTid($tid) {
		$sn = self::getSnByTid($tid);
		$array = array();
		if ($sn) {
			if (preg_match('/^(1-3)(.*)$/', $sn, $m)) {
				$array[0] = 0;
			} elseif (preg_match('/^(\d+)(.*)$/', $sn, $m)) {
				$array[0] = 1;
			}
			$subSnPre = $m[1];
			$subSn = $m[2];
			while (preg_match('/^-(\d+)(.*)$/', $subSn, $m)) {
				$subSnPre .= "-{$m[1]}";
				$subSn = $m[2];
				if ($m[1] != 0) {
					$array[] = $subSnPre;
				}
			}
		}
		return $array;
	}
	
	function getRalateTableNameByTypeId($typeid) {
		switch ($typeid) {
			case 1:
				return 'mudidi_scape';
				break;
			case 2:
				return 'mudidi_scapearea';
				break;
			case 3:
				return 'mudidi_region';
				break;
			default:
				return NULL;
				break;
		}
	}
	
	function getRalateByTid($tid) {
		$ralate_info = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE tid = {$tid}");
		if ($ralate_info)
			return $ralate_info;
		else
			return NULL;
	}
	
	function getRalateBySn($sn) {
		$ralate_info = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE sn = {$sn}");
		if ($ralate_info)
			return $ralate_info;
		else
			return NULL;
	}
	
	function getRegionIfParent($limit) {
		$array = array();
		
		$sql = "SELECT * FROM ".DB::table('mudidi_region')."
		        WHERE sn REGEXP '^([[:digit:]]+|1-3)$'";
				
		if ($limit) {
			$sql .= " LIMIT $limit";
		}
		
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		
		return $array;
	}
	
	function getScapeByTid($tid) {
		$query = DB::fetch_first("SELECT s.* FROM ".DB::table('mudidi_scape')." AS s
								 LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON s.sn = r.sn
								 WHERE r.tid = {$tid}");
		return $query;
	}
	
	function getScapeareaByTid($tid) {
		$query = DB::fetch_first("SELECT s.* FROM ".DB::table('mudidi_scapearea')." AS s
								 LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON s.sn = r.sn
								 WHERE r.tid = {$tid}");
		return $query;
	}
	
	function getRegionByTid($tid) {
		$query = DB::fetch_first("SELECT s.* FROM ".DB::table('mudidi_region')." AS s
								 LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON s.sn = r.sn
								 WHERE r.tid = {$tid}");
		return $query;
	}
	
	function getScapeBySn($sn) {
		return DB::fetch_first("SELECT * FROM ".DB::table('mudidi_scape')." AS s
							    LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = s.sn
								LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
								WHERE s.sn = '{$sn}'");
	}
	
	function getScapeareaBySn($sn) {
		return DB::fetch_first("SELECT * FROM ".DB::table('mudidi_scapearea')." AS s
							    LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = s.sn
								LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
								WHERE s.sn = '{$sn}'");
	}
	
	function getRegionBySn($sn) {
		return DB::fetch_first("SELECT * FROM ".DB::table('mudidi_region')." AS s
								LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = s.sn
								LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
								WHERE s.sn = '{$sn}'");
	}
	
	function getCountSubScapeByTid($tid) {
		$sn = self::getSnByTid($tid);
		
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table('mudidi_scape')." WHERE sn LIKE '{$sn}-%'");
	}
	
	function getSubScapeByTid($tid, $limit) {
		$scapearea = self::getScapeareaByTid($tid);
		$array = array();
		if ($scapearea['sn']) {
			$sql = "SELECT t.*, r.*, s.*, p.message FROM ".DB::table('forum_thread')." AS t
					LEFT JOIN ".DB::table('forum_post')." AS p ON p.tid = t.tid AND p.first = 1
					RIGHT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.tid = t.tid
					RIGHT JOIN ".DB::table('mudidi_scape')." AS s ON s.sn = r.sn
					WHERE r.sn LIKE '{$scapearea['sn']}-%'
					ORDER BY t.views DESC";
			if ($limit != NULL) {
				$sql .= " LIMIT $limit";
			}
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$array[] = $value;
			}
			return $array;
		}
		return $array;
	}
	
	function getCountSubScapeareaByTid($tid) {
		$sn = self::getSnByTid($tid);
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table('mudidi_scapearea')." WHERE sn LIKE '{$sn}-%'");
	}
	
	function getSubScapeareaByTid($tid, $limit=null) {
		$region = self::getRegionByTid($tid);
		if ($region['sn']) {
			return self::getSubScapeareaBySn($region['sn'], $limit);
		}
		return NULL;
	}
	
	function getSubScapeareaBySn($sn, $limit=null) {
		$array = array();
		if ($sn) {
			$sql = "SELECT t.*, s.*, r.tid, p.message FROM ".DB::table('mudidi_scapearea')." AS s
					RIGHT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = s.sn
					LEFT JOIN ".DB::table('forum_post')." AS p ON p.tid = r.tid AND p.first = 1
					LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
					WHERE r.type = 2 AND r.sn LIKE '{$sn}-%'
					ORDER BY s.tagsLevel DESC, t.views DESC";
			if ($limit != NULL) {
				$sql .= " LIMIT $limit";
			}
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$array[] = $value;
			}
		}
		return $array;
	}
	
	function getSubRegionByTid($tid, $limit) {
		$region = self::getRegionByTid($tid);
		$array = array();
		if ($region['sn']) {
			$sql = "SELECT s.*, r.tid, p.message FROM ".DB::table('mudidi_region')." AS s
					RIGHT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = s.sn
					LEFT JOIN ".DB::table('forum_post')." AS p ON p.tid = r.tid AND p.first = 1
					LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
					WHERE r.type = 3 AND r.sn REGEXP '^{$region['sn']}-[[:digit:]]+$'
					ORDER BY t.views DESC";
			if ($limit != NULL) {
				$sql .= " LIMIT $limit";
			}
			
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$array[] = $value;
			}
		}
		return $array;
	}
	
	function getBreadcrumbNavByTid($tid) {
		$forum = DB::fetch_first("SELECT * FROM ".DB::table('forum_forum')." AS f
						    LEFT JOIN ".DB::table('forum_thread')." AS t ON t.fid = f.fid
							WHERE t.tid = $tid");
		$string = '<a href="/forum-'.$forum['fid'].'-1.html">'.$forum['name'].'</a>';
		$ralate = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE tid = {$tid}");
		
		if ($ralate['sn'] && ($snNum = preg_match_all('/(\d+)-?/', $ralate['sn'], $m)) > 0) {
			for ($i = 0; $i < $snNum; ++$i) {
				if ($m[1][$i] == 0) {
					continue;
				}
				if ($i < 4) {
					$tablename = 'mudidi_region';
				} elseif ($i == 4) {
					$tablename = 'mudidi_scapearea';
				} elseif ($i == 5) {
					$tablename = 'mudidi_scape';
				}
				$query = DB::fetch_first("SELECT t.*, r.tid FROM ".DB::table($tablename)." as t
										 LEFT JOIN ".DB::table('mudidi_thread_ralation')." as r ON t.sn = r.sn
										 WHERE t.id = {$m[1][$i]}");
				$string .= ' <em>&rsaquo;</em> <a href="/thread-'.$query['tid'].'-1-1.html">'.$query['name'].'</a>';
			}
		}
		return $string;
	}
	
	function getLevelByTid($tid) {
		$sn = self::getSnByTid($tid);
		if ($sn) {
			$num = preg_match_all('/(\d+)-?/', $sn, $m);
			if (preg_match('/^1-3/', $sn)) {
				if ($num <= 2)
					return 1;
				else
					return 2;
			} else {
				if ($num == 1)
					return 1;
				else
					return 2;
			}
		}
		return NULL;
	}
	
	function getSnByTid($tid) {
		$ralate = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE tid = {$tid}");
		if ($ralate['sn']) {
			return $ralate['sn'];
		}
		return NULL;
	}
	
	function getTidBySn($sn) {
		$ralate = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE sn = '{$sn}'");
		if ($ralate['tid']) {
			return $ralate['tid'];
		}
		return NULL;
	}
	
	function deleteRalateData($condition) {
		$ralate = DB::query("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE $condition");
		while ($value = DB::fetch($ralate)) {
			switch ($value['type']) {
				case '1':
					$tablename = "mudidi_scape";
					break;
				case '2':
					$tablename = "mudidi_scapearea";
					break;
				case '3':
					$tablename = "mudidi_region";
					break;
				default:
					$tablename = NULL;
					break;
			}
			if ($tablename != NULL)
				DB::query("DELETE FROM ".DB::table($tablename)." WHERE sn = '{$value['sn']}'");
			DB::query("DELETE FROM ".DB::table('mudidi_info')." WHERE sn = '{$value['sn']}'");
			DB::query("DELETE FROM ".DB::table('mudidi_guide')." WHERE sn = '{$value['sn']}'");
			DB::query("DELETE FROM ".DB::table('mudidi_map')." WHERE sn = '{$value['sn']}'");
			DB::query("DELETE FROM ".DB::table('mudidi_album')." WHERE sn = '{$value['sn']}'");
			DB::query("DELETE FROM ".DB::table('mudidi_thread_ralation')." WHERE sn = '{$value['sn']}'");
		}
	}
	
	function getGuideBySql($sql) {
		if ($sql == NULL) {
			return NULL;
		}
		$query = DB::query($sql);
		$guideTidArr = $guideBlogidArr = $guideThreadCoverPic = $guideBlogCoverPic = array();
		
		while ($value = DB::fetch($query)) {
			if ($value['type'] == 1) {
                $guideTidArr[] = $value['typeid'];
                if ($value['coverPic']) {
                    $guideThreadCoverPic[$value['typeid']] = $value['coverPic'];
                }
			} elseif ($value['type'] == 2) {
                $guideBlogidArr[] = $value['typeid'];
                if ($value['coverPic']) {
                    $guideBlogCoverPic[$value['typeid']] = $value['coverPic'];
                }				
			}
		}
		
		require_once DISCUZ_ROOT.'./source/function/function_post.php'; 
		require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";
		$guideData = array();
		
		if ($guideTidArr) {
			$query = DB::query("SELECT p.tid, p.pid, p.subject, p.message, p.dateline, t.authorid, t.author, t.lastpost, t.lastposter, m.uid as lastposterid, t.views, t.replies
								FROM ".DB::table('forum_post')." AS p
								LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = p.tid AND p.first = 1
								LEFT JOIN ".DB::table('common_member')." AS m ON t.lastposter = m.username
								WHERE t.tid IN (".implode(',', $guideTidArr).")");
			while ($value = DB::fetch($query)) {
				$firstPicture = '';
				$isAttachment = false;
				$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
				$value['message'] = discuzcode($value['message'], 1, 0);

                if ($guideThreadCoverPic[$value['tid']]) {
                    $firstPicture = $guideThreadCoverPic[$value['tid']]!='#' ? $guideThreadCoverPic[$value['tid']] : '';
                } else {
			    	$attachs = getattach($value['pid']);
					if (!empty($attachs['imgattachs']['used'])) {
						foreach ($attachs['imgattachs']['used'] as $i => $item) {
							if (in_array($item['ext'], array('jpg', 'jpeg', 'bmp', 'gif', 'png'))) {
								/*修改攻略图片的读取方式*/
								$firstPicture = $item['url']."/".$item['attachment'];
								$isAttachment = true;
								break;
							}
						}
					}
					
					if (!$firstPicture && preg_match('/<img[^>]+?src="([^"]+)"/i', $value['message'], $m)) {
						$firstPicture = $m[1];
						$isAttachment = false;
					}
                }
				
				
				$value['message'] = messagecutstr($value['message']);
				$guideData[] = array(
					'type' => 1,
					'typeid' => $value['tid'],
					'subject' => $value['subject'],
					'message' => $value['message'],
					'dateline' => $value['dateline'],
					'author' => $value['author'],
					'authorid' => $value['authorid'],
					'lastposter' => $value['lastposter'],
					'lastposterid' => $value['lastposterid'],
					'views' => $value['views'],
					'replies' => $value['replies'],
					'firstPicture' => $firstPicture,
					'isAttachment' => $isAttachment,
					'lastpost' => $value['lastpost'],
				);
			}
		}
		
		if ($guideBlogidArr) {
			$query = DB::query("SELECT b.blogid, b.subject, b.dateline, b.uid, b.username, f.message, b.viewnum, b.replynum
								FROM ".DB::table('home_blog')." AS b
								LEFT JOIN ".DB::table('home_blogfield')." AS f ON b.blogid = f.blogid
								WHERE b.blogid IN (".implode(',', $guideBlogidArr).")");
			while ($value = DB::fetch($query)) {
				$firstPicture = '';
				$isAttachment = false;
				require_once libfile('function/blog');
                $value['message'] = blog_bbcode($value['message']);
				
                if ($guideBlogCoverPic[$value['blogid']]) {
                    $firstPicture = $guideBlogCoverPic[$value['blogid']]!='#' ? $guideBlogCoverPic[$value['blogid']] : '';
                } else {
				    if (preg_match('/<img[^>]+src="([^"]+)"/i', $value['message'], $m)) {
				    	$firstPicture = $m[1];
				    }
                }
				$comment = DB::fetch_first("SELECT * FROM ".DB::table('home_comment')."
											WHERE id={$value['blogid']} AND idtype='blogid'
											ORDER BY cid DESC
											LIMIT 1");
				$guideData[] = array(
					'type' => 2,
					'typeid' => $value['blogid'],
					'subject' => $value['subject'],
					'message' => $value['message'],
					'dateline' => $value['dateline'],
					'uid' => $value['uid'],
					'author' => $value['username'],
					'authorid' => $value['uid'],
					'lastposter' => ($comment['author']?$comment['author']:$value['username']),
					'lastposterid' => ($comment['uid']?$comment['uid']:$value['uid']),
					'lastpost' => ($comment['dateline']?$comment['dateline']:$value['dateline']),
					'views' => $value['viewnum'],
					'replies' => $value['replynum'],
					'firstPicture' => $firstPicture,
					'isAttachment' => $isAttachment,
				);
			}
		}
		
		if (($guideDataNum = count($guideData)) > 0) {
			for ($i = 0; $i < $guideDataNum; ++$i) {
				for ($j = $i + 1; $j < $guideDataNum; ++$j) {
					if ($guideData[$i]['dateline'] < $guideData[$j]['dateline']) {
						$t = $guideData[$i];
						$guideData[$i] = $guideData[$j];
						$guideData[$j] = $t;
					}
				}
			}
		}
		
		return $guideData;
	}
	
	function getGuideByTypeid($typeid = 0, $limit=null) {
		
		$snArray = array();
		$sql = "SELECT * FROM ".DB::table('mudidi_scape')." WHERE type = $typeid";
		if ($limit != NULL) {
			$sql .= " LIMIT $limit";
		}
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$snArray[] = "'{$value['sn']}'";
		}
		if (count($snArray) == 0) {
			return array();
		}
		$sns = implode(',', $snArray);
		
		$sql = "SELECT * FROM ".DB::table('mudidi_guide')." WHERE sn IN ($sns) AND state = 1 ORDER BY dateline DESC";
		if ($limit != NULL) {
			$sql .= " LIMIT $limit";
		}
		return self::getGuideBySql($sql);
	}
	
	function getGuideByTid($tid, $limit) {
		$sn = self::getSnByTid($tid);
		if (!$sn) {
			return NULL;
		}
		$sql = "SELECT * FROM ".DB::table('mudidi_guide')." WHERE sn = '$sn' AND state = 1 ORDER BY dateline DESC";
		if ($limit != NULL) {
			$sql .= " LIMIT $limit";
		}
		return self::getGuideBySql($sql);
	}
	
	function getGuideByRegionTid($regionTid, $limit) {
		$regionsn = self::getSnByTid($regionTid);
		if (!$regionsn) {
			return NULL;
		}
		$sql = "SELECT * FROM ".DB::table('mudidi_guide')." WHERE sn LIKE '$regionsn%' AND state = 1 ORDER BY dateline DESC";
		if ($limit != NULL) {
			$sql .= " LIMIT $limit";
		}
		return self::getGuideBySql($sql);
	}
	
	function getLastedGuide($limit) {
		$sql = "SELECT * FROM ".DB::table('mudidi_guide')." WHERE state = 1 ORDER BY dateline DESC";
		if ($limit != NULL) {
			$sql .= " LIMIT $limit";
		}
		return self::getGuideBySql($sql);
	}
	
	function getLastedActivity($order, $limit) {
		$today = strtotime(dgmdate(time(), 'Y-m-d'));

		$sql = "SELECT * FROM ".DB::table('forum_activity')." AS a
				INNER JOIN ".DB::table('forum_thread')." AS t ON t.special='4' AND a.tid = t.tid
				WHERE t.displayorder > '-1' AND a.starttimefrom > $today";
		
		if ($order != NULL) {
			$sql .= " ORDER BY $order";
		}
		
		if ($limit != NULL) {
			$sql .= " LIMIT $limit";
		}
		
		$array = array();
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}
	
	function getCountGuideByTid($tid) {
		$sn = self::getSnByTid($tid);
		if ($sn) {
			$query = DB::fetch_first("SELECT count(*) as count FROM ".DB::table('mudidi_guide')." WHERE sn = '$sn' AND state = 1");
			return $query['count'];
		}
		return 0;
	}
	
	function getCountGuideByRegionTid($tid) {
		$sn = self::getSnByTid($tid);
		if ($sn) {
			$query = DB::fetch_first("SELECT count(*) as count FROM ".DB::table('mudidi_guide')." WHERE sn LIKE '$sn%' AND state = 1");
			return $query['count'];
		}
		return 0;
	}
	
	function getRalateAlbumByTid($tid, $limit) {
        global $_G;
		$array = $albumIdsArr = array();
		
		$ralate = self::getRalateByTid($tid);
		$query = DB::query("SELECT albumid FROM ".DB::table('mudidi_album')." WHERE sn = '{$ralate['sn']}' AND state = 1 ORDER BY ordernum DESC");
		while ($value = DB::fetch($query)) {
			$albumIdsArr[] = $value['albumid'];
		}
		if ($albumIdsArr) {
			$albumIds = implode(',', $albumIdsArr);
		}
		
		$thread = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid=$tid LIMIT 1");
		if ($thread['subject']) {
			$sql = "SELECT * FROM ".DB::table('home_album')."
			        WHERE (".($albumIds?"albumid IN ($albumIds) OR ":"")."albumname LIKE '%{$thread['subject']}%') AND pic != ''
					ORDER BY ";
			if ($albumIds) {
				$sql .= "CASE ";
				foreach ($albumIdsArr as $i => $item) {
					$sql .= " WHEN albumid = $item THEN ".(99999-$i);
				}
				$sql .= " ELSE 0 END DESC,";
			}
			$sql .= " dateline DESC";
			if ($limit != NULL) {
				$sql .= " LIMIT $limit";
			}
			$query = DB::query($sql);
            /*引入附件服务器*/
			require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
			$attachserver = new attachserver;
            $all_server = $attachserver->get_server_domain('all');
            /*结束*/
			while ($value = DB::fetch($query)) {
                /*增加附件服务器域名*/
                $value['trueurl'] = ($value['serverid']>0 ? 'http://'.$all_server[$value['serverid']] : ($value['picflag']>1 ? $_G['setting']['ftp']['attachurl'] : '/data/attachment')).'/album/'.$value['pic'];
				$array[] = $value;
			}
		}
		return $array;
	}
	
	function getCountRalateAlbumByTid($tid) {
		$albumIdsArr = array();
		$ralate = self::getRalateByTid($tid);
		$query = DB::query("SELECT albumid FROM ".DB::table('mudidi_album')." WHERE sn = '{$ralate['sn']}' AND state = 1");
		while ($value = DB::fetch($query)) {
			$albumIdsArr[] = $value['albumid'];
		}
		if ($albumIdsArr) {
			$albumIds = implode(',', $albumIdsArr);
		}
		
		$thread = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid=$tid LIMIT 1");
		if ($thread['subject']) {
			$sql = "SELECT count(*) FROM ".DB::table('home_album')."
					WHERE (".($albumIds?"albumid IN ($albumIds) OR ":"")."albumname LIKE '%{$thread['subject']}%') AND pic != ''";
			return DB::result_first($sql);
		}
		return 0;
	}
	
	function getAllSkiData() {
		$array = array();
		$scapearea = array();
		$query = DB::query("SELECT s.*, r.tid FROM ".DB::table('mudidi_scape')." AS s 
						   LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON s.sn = r.sn
						   WHERE s.type = '1'");
		
		while ($value = DB::fetch($query)) {
			if (preg_match('/^1-3-\d+/', $value['sn'], $m) || preg_match('/^\d+-\d+/', $value['sn'], $m)) {
				if (!isset($array[$m[0]])) {
					$array[$m[0]] = array(
						'data' => array(),
						'child' => array(
							0 => $value
						)
					);
					$scapearea[$m[0]] = "'{$m[0]}'";
				} else {
					$array[$m[0]]['child'][] = $value;
				}
			}
		}
		
		if ($scapearea) {
			$query = DB::query("SELECT s.*, r.tid FROM ".DB::table('mudidi_region')." AS s
							    LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = s.sn
							    WHERE s.sn IN (".implode(',', $scapearea).")");
			while ($value = DB::fetch($query)) {
				$array[$value['sn']]['data'] = $value;
			}
		}
		return $array;
	}
	
	function getRalateActivityByKeyword($keyword, $limit) {
		return NULL;
		if ($keyword == NULL) {
			return NULL;
		}
		$sql = "SELECT * FROM ".DB::table('forum_activity')." AS a
				INNER JOIN ".DB::table('forum_thread')." AS t ON a.tid = t.tid
				WHERE t.subject LIKE '%$keyword%' AND t.displayorder > -1
				ORDER BY a.starttimeto DESC, t.views DESC";
		if ($limit != NULL) {
			$sql .= " LIMIT $limit";
		}
		$query = DB::query($sql);
		$array = array();
		while ($value = DB::fetch($query)) {
			$array[$value['tid']] = $value;
		}
		return $array;
	}
	
	function getWeatherInfo($jingdu, $weidu, $returnCurData=false) {
		if (is_numeric($jingdu) && is_numeric($weidu)) {
			$jingdu = number_format($jingdu, 6);
			$weidu = number_format($weidu, 6);
			$jingdu=$jingdu*1000000;
			$weidu=$weidu*1000000;
			$content = file_get_contents("http://www.google.com/ig/api?hl=zh-cn&weather=,,,$weidu,$jingdu");
			$content = mb_convert_encoding($content, 'UTF-8', 'GBK');
			if(stripos($content, 'xml') === false) return;
			$xml = simplexml_load_string($content);
			$array = array();
			try {
				if($xml){
					if($xml->weather->problem_cause || !$xml->weather->forecast_information){
						return null;
					}
					$date = $xml->weather->forecast_information->forecast_date->attributes();
					if($date){
						$current = $xml->weather->current_conditions;
						$condition = $current->condition->attributes();
						$temp_c = $current->temp_c->attributes();
						$humidity = $current->humidity->attributes();
						$icon = $current->icon->attributes();
						$wind = $current->wind_condition->attributes();
						$condition && $condition = $xml->weather->forecast_conditions->condition->attributes();
						$icon && $icon = $xml->weather->forecast_conditions->icon->attributes();
						
						
						foreach($xml->weather->forecast_conditions as $forecast) {
							$low = $forecast->low->attributes();
							$high = $forecast->high->attributes();
							$icon = $forecast->icon->attributes();
							$condition = $forecast->condition->attributes();
							$day_of_week = $forecast->day_of_week->attributes();
							
							$low = mb_convert_encoding($low, 'GBK', 'UTF-8');
							$high = mb_convert_encoding($high, 'GBK', 'UTF-8');
							$icon = mb_convert_encoding($icon, 'GBK', 'UTF-8');
							$condition = mb_convert_encoding($condition, 'GBK', 'UTF-8');
							$day_of_week = mb_convert_encoding($day_of_week, 'GBK', 'UTF-8');
							
							$array[] = array(
								'low' => $low,
								'high' => $high,
								'icon' => $icon,
								'condition' => $condition,
								'day_of_week' => $day_of_week,
							);
						}
					}else{
						return null;
					}
				}
			} catch(Exception $e) {
				return null;
			}
		} else {
			return null;
		}
		
		if (!$returnCurData) {
			return $array;
		} else {
			$condition = $xml->weather->current_conditions->condition->attributes();
			$temp_f = $xml->weather->current_conditions->temp_f->attributes();
			$temp_c = $xml->weather->current_conditions->temp_c->attributes();
			$humidity = $xml->weather->current_conditions->humidity->attributes();
			$icon = $xml->weather->current_conditions->icon->attributes();
			$wind_condition = $xml->weather->current_conditions->wind_condition->attributes();
			
			$condition = mb_convert_encoding($condition, 'GBK', 'UTF-8');
			$temp_f = mb_convert_encoding($temp_f, 'GBK', 'UTF-8');
			$temp_c = mb_convert_encoding($temp_c, 'GBK', 'UTF-8');
			$humidity = mb_convert_encoding($humidity, 'GBK', 'UTF-8');
			$icon = mb_convert_encoding($icon, 'GBK', 'UTF-8');
			$wind_condition = mb_convert_encoding($wind_condition, 'GBK', 'UTF-8');
			
			$curData = array(
				'condition'      => $condition,
				'temp_f'         => $temp_f,
				'temp_c'         => $temp_c,
				'humidity'       => $humidity,
				'icon'           => $icon,
				'wind_condition' => $wind_condition,
			);
			
			return array(
				'current_conditions'   => $curData,
				'forecast_information' => $array,
			);
		}
		
	}
	
	function getParentSn($sn) {
		return preg_replace('/-\d+$/', '', $sn);
	}
	
	function getHotScapeareaByRegionTid($regionTid, $limit) {
		$regionSn = self::getSnByTid($regionTid);
		$sql = "SELECT * FROM ".DB::table('forum_thread')." AS t
				RIGHT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON t.tid = r.tid
				RIGHT JOIN ".DB::table('mudidi_scapearea')." AS s ON r.sn = s.sn
				WHERE s.sn LIKE '$regionSn%'
				ORDER BY t.views DESC";
		if ($limit != NULL) {
			$sql .= " LIMIT $limit";
		}
		$query = DB::query($sql);
		$array = array();
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}
	
	/*首页目的地导航*/
	function getRegionInMudidiNav() {
		$query = DB::query("SELECT s.*, r.tid FROM ".DB::table('mudidi_region')." AS s
							RIGHT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON s.sn = r.sn
							WHERE s.id < 89");
		$array = array();
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}
	
	function getHotScape($limit) {
		$sql = "SELECT t.* FROM ".DB::table('forum_thread')." AS t
				LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON t.tid = r.tid
				WHERE r.type = 1
				ORDER BY t.views DESC";
		if ($limit != NULL)
			$sql .= " LIMIT $limit";
		
		$query = DB::query($sql);
		$array = array();
		
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}
	
	function getCommercectivityData($limit) {
		$time = time() - 1209600; // time = 60 * 60 * 24 * 14 = 1209600
		$sql = "SELECT * FROM ".DB::table('forum_thread')." WHERE fid = 5 AND displayorder  > -1 AND dateline > '$time' ORDER BY views DESC";
		if ($limit)
			$sql .= " LIMIT $limit";
		
		$query = DB::query($sql);
		$array = array();
		
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}
	
	function getInfoNav($sn) {
		$query = DB::query("SELECT * FROM ".DB::table('mudidi_info')." WHERE sn = '$sn' ORDER BY id ASC");
		$array = array();
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}
	
	function assignSkiData($data) {
		// 初始化
		$sliceNum = 30;
		$groupNum = 7;
		$array = array();
		$arrayItemCount = array();
		$orderData = array();
		
		for ($i = 0; $i < $groupNum; ++$i) {
			$array[$i] = array();
			$arrayItemCount[$i] = 0;
		}
		
		// 赋值
		foreach ($data as $item) {
			$orderData[] = $item;
		}
		
		// 排序
		$orderDataCount = count($orderData);
		for ($i = 0; $i < $orderDataCount - 1; ++$i) {
			for ($j = $i + 1; $j < $orderDataCount; ++$j) {
				if (count($orderData[$i]['child']) < count($orderData[$j]['child'])) {
					$t = $orderData[$i];
					$orderData[$i] = $orderData[$j];
					$orderData[$j] = $t;
				}
			}
		}
		$sliceNum = count($orderData[1]['child']) + 5;
		
		// 组合
		foreach ($orderData as $i => $item) {
			$minNum = $arrayItemCount[0];
			$minIndex = 0;
			foreach ($arrayItemCount as $j => $num) {
				if ($num < $minNum) {
					$minNum = $num;
					$minIndex = $j;
				}
			}
			$arrayItemCount[$minIndex] += count($item['child']);
			$item['child'] = array_slice($item['child'], 0, $sliceNum);
			$array[$minIndex][] = $item;
		}
		return $array;
	}
	
	// 记录访问信息
	function recordUser() {
		//DB::query("INSERT INTO ".DB::table('plugin_forumoption_request_log')." (ip, httpuseragent, requesturi, dateline) VALUES
				   //('{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['HTTP_USER_AGENT']}', '{$_SERVER['REQUEST_URI']}', '".time()."')");
	}
	
	function getMapBySn($sn, $limit) {
		$array = array();
		$sql = "SELECT * FROM ".DB::table('mudidi_map')." WHERE sn = '{$sn}' ORDER BY id DESC";
		
		if ($limit) {
			$sql .= " LIMIT $limit";
		}
		$query = DB::query($sql);
		
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		
		return $array;
	}
	
	function getCountMapBySn($sn) {
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table('mudidi_map')." WHERE sn = '{$sn}'");
	}
	
	function getParentSubjectBySn($sn) {
		global $forumoption_mudidi;
		do {
			$sn = $forumoption_mudidi->getParentSn($sn);
		} while (preg_match('/0$/', $sn));
		
		if ($sn && preg_match_all('/-/', $sn, $m) > 0) {
			$parentTid = $forumoption_mudidi->getTidBySn($sn);
			return DB::result_first("SELECT subject FROM ".DB::table('forum_thread')." WHERE tid = {$parentTid}");
		}
		return null;
	}
	
	function getThreadByFid($fid, $limit='0, 10', $order='dateline DESC') {
		$array = array();
		$query = DB::query("SELECT * FROM ".DB::table('forum_thread')."
						    WHERE displayorder > -1 AND closed = 0 AND fid = $fid
							ORDER BY $order
							LIMIT $limit");
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}
	
	/*
	 * 返回所有标签
	 */
	function getTagids() {
		$array = array();
		$query = DB::query("SELECT tagid FROM ".DB::table('mudidi_tags'));
		while ($value = DB::fetch($query)) {
			$array[] = $value['tagid'];
		}
		return $array;
	}
	
	function getTags() {
		$array = array();
		$query = DB::query("SELECT * FROM ".DB::table('mudidi_tags'));
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}
	
	function getTagsRalateByTid($tid) {
		$array = array();
		$query = DB::query("SELECT t.*, r.tagid AS is_active FROM ".DB::table('mudidi_tags')." AS t
						    LEFT JOIN ".DB::table('mudidi_tags_ralate')." AS r ON t.tagid = r.tagid AND r.tid = $tid");
		while ($value = DB::fetch($query)) {
			$value['is_active'] = !empty($value['is_active']) ? 1 : 0;
			$array[] = $value;
		}
		return $array;
	}
	
	function changeTagsRalate($tid, $need_tagids) {
		if (empty($need_tagids)) {
			$need_tagids = array();
		}
		$tags = self::getTagids();
		$del_tags = array_diff($tags, $need_tagids);
		foreach ($need_tagids as $tagid) {
			DB::query('REPLACE INTO '.DB::table('mudidi_tags_ralate')." (tagid, tid) VALUES ($tagid, $tid)");
		}
		foreach ($del_tags as $tagid) {
			DB::query('DELETE FROM '.DB::table('mudidi_tags_ralate')." WHERE tagid = $tagid AND tid = $tid");
		}
		self::changeTagsLevelByTid($tid);
	}
	
	function changeTagsLevelByTid($tid) {
		$tagsLevel = 0;
		$sn = self::getSnByTid($tid);
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('mudidi_tags_ralate')." WHERE tid = $tid");
		
		// tagsLevel = tags的数量
		DB::query("UPDATE ".DB::table('mudidi_scapearea')." SET tagsLevel = {$count} WHERE sn = '{$sn}'");
	}
	
	function getScapetype() {
		$array = array();
		$query = DB::query("SELECT * FROM ".DB::table('mudidi_scapetype'));
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}
	
	function getScapetypeByTypeid($typeid) {
		return DB::fetch_first("SELECT * FROM ".DB::table('mudidi_scapetype')." WHERE id = {$typeid}");
	}
	
	function getAllScapeDataByTypeid($typeid = 0) {
		$array = array();
		$scapearea = array();
		$query = DB::query("SELECT s.*, r.tid FROM ".DB::table('mudidi_scape')." AS s 
						   LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON s.sn = r.sn
						   WHERE s.type = '$typeid'");
		while ($value = DB::fetch($query)) {
			if (preg_match('/^1-3-\d+/', $value['sn'], $m) || preg_match('/^\d+-\d+/', $value['sn'], $m)) {
				if (!isset($array[$m[0]])) {
					$array[$m[0]] = array(
						'data' => array(),
						'child' => array(
							0 => $value
						)
					);
					$scapearea[$m[0]] = "'{$m[0]}'";
				} else {
					$array[$m[0]]['child'][] = $value;
				}
			}
		}
		
		// 由多条查询合并到一条
		if ($scapearea) {
			$query = DB::query("SELECT s.*, r.tid FROM ".DB::table('mudidi_region')." AS s
							    LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = s.sn
							    WHERE s.sn IN (".implode(',', $scapearea).")");
			while ($value = DB::fetch($query)) {
				$array[$value['sn']]['data'] = $value;
			}
		}
		return $array;
	}
}

$forumoption_mudidi = new CachedataLogger;
$forumoption_mudidi->class = 'ForumOptionMudidi';
$forumoption_mudidi->methods = $CachedateLogger_config['ForumOptionMudidi'];
if ($_GET['nocache'] == 1) {
	$forumoption_mudidi->forceRefreshCache = true;
}
