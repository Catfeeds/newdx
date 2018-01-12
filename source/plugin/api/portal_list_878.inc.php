<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
$offset = $_GET['offset'] ? $_GET['offset'] : 0;
$limit = $_GET['limit'] ? $_GET['limit'] : 20;
$json = array(
    'error_code' => 1
);
/*
$query = DB::query("SELECT * FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>'' ORDER BY aid DESC LIMIT $limit OFFSET $offset");
$array = array();
require_once DISCUZ_ROOT.'./source/function/function_post.php';
require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";	
while ($value = DB::fetch($query)) {
	if($value['idtype']=='tid'&& $value['id']!=0){				
		$comment = DB::fetch_first("SELECT replies,views FROM ".DB::table('forum_thread')." WHERE tid='$value[id]' LIMIT 0,1");
		$value['commentnum'] = $comment['replies'];
		$value['viewnum'] = $comment['views'];		
		$str = "SELECT * FROM ".DB::table('forum_post')." WHERE tid='$value[id]' and first<>'1' and invisible=0 order by dateline desc LIMIT 0,3";
		$query = DB::query($str);
		while ($value = DB::fetch($query)) {
			$value['uid'] = "http://u.8264.com/home.php?mod=space&uid=".$post['authorid'];
			$value['lastpost'] = $post['author'];
			$value['dateline'] = dgmdate($post['dateline']);
			$value['content'] =  $post['message'];
			$value['content'] = preg_replace('/\[quote.*?\](.*)\[\/quote\]/', '', $value['content']);
			$value['content'] = preg_replace('/\[img.*?\](.*)\[\/img\]/', '', $value['content']);
			$value['content'] = preg_replace('/\[code.*?\](.*)\[\/code\]/', '', $value['content']);
			$value['content'] = preg_replace('/\[attach.*?\](.*)\[\/attach\]/', '', $value['content']);
			$value['content'] = preg_replace('/\[url.*?\](.*)\[\/url\]/', '', $value['content']);
			$value['content'] = preg_replace('/\[size.*?\](.*)\[\/size\]/', '', $value['content']);
			$value['content'] = preg_replace('/\[media.*?\](.*)\[\/media\]/', '', $value['content']);
			$value['content'] = preg_replace('/\[audio.*?\](.*)\[\/audio\]/', '', $value['content']);
			$value['content'] = preg_replace('/\[wma.*?\](.*)\[\/wma\]/', '', $value['content']);
			$value['content'] =  discuzcode($value['content']);
			$value['content'] =  messagecutstr($value['content'],50);
		}				
		//$value['message'] = preg_replace('/(&nbsp;)+/', '', $value['message']);
	}else{
		$comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");		
		$value['commentnum'] = $comment['commentnum'];
	}
	$value['dateline'] = $value['dateline'] ? $value['dateline'] : null;
	$value['content'] = mb_convert_encoding(strip_tags(trim($value['content'])), 'utf-8', 'gbk');
	$value['title'] = mb_convert_encoding($value['title'], 'utf-8', 'gbk');
	$value['lastpost'] = mb_convert_encoding($value['lastpost'], 'utf-8', 'gbk');
	$value['pic'] = ($value['remote'] == 1 ? $_G['setting']['ftp']['attachurl'].'portal/' : "http://www.8264.com/data/attachment/portal/").$value['pic'];
	$array[] = $value;
}*/
function getKqmgList($offset,$limit){
/*加入附件服务器*/
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
$domainall = $attachserver->get_server_domain('all');
/*结束*/
	$query = DB::query("SELECT aid,title,url,pic,remote,serverid,id,idtype FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>'' ORDER BY aid DESC LIMIT $limit OFFSET $offset");
	$array = array();
	require_once DISCUZ_ROOT.'./source/function/function_post.php';
	require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";	
	while ($value = DB::fetch($query)) {
		if($value['idtype']=='tid'&& $value['id']!=0){				
			$comment = DB::fetch_first("SELECT replies,views,authorid FROM ".DB::table('forum_thread')." WHERE tid='$value[id]' LIMIT 0,1");
			$value['commentnum'] = $comment['replies'];
			$value['viewnum'] = $comment['views'];			
			$str = "SELECT * FROM ".DB::table('forum_post')." WHERE tid='$value[id]' and authorid<>'$comment[authorid]' and first<>'1' and invisible=0 order by dateline desc LIMIT 0,3";
			$querys = DB::query($str);	
			$list = array();
			while ($values = DB::fetch($querys)) {
				$values['avatar'] = avatar($values['authorid'], 'small');
				$values['authorid'] = $_G['config']['web']['home']."home.php?mod=space&uid=".$values['authorid'];				
				$values['content'] = preg_replace('/\[quote.*?\](.*)\[\/quote\]/', '', $values['message']);
				$values['content'] = preg_replace('/\[img.*?\](.*)\[\/img\]/', '', $values['content']);
				$values['content'] = preg_replace('/\[code.*?\](.*)\[\/code\]/', '', $values['content']);
				$values['content'] = preg_replace('/\[attach.*?\](.*)\[\/attach\]/', '', $values['content']);
				$values['content'] = preg_replace('/\[url.*?\](.*)\[\/url\]/', '', $values['content']);
				$values['content'] = preg_replace('/\[size.*?\](.*)\[\/size\]/', '', $values['content']);
				$values['content'] = preg_replace('/\[media.*?\](.*)\[\/media\]/', '', $values['content']);
				$values['content'] = preg_replace('/\[audio.*?\](.*)\[\/audio\]/', '', $values['content']);
				$values['content'] = preg_replace('/\[wma.*?\](.*)\[\/wma\]/', '', $values['content']);			
				$values['content'] = preg_replace('/(&nbsp;)+/', '', $values['content']);
				$values['content'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $values['content']);
				$values['content'] = str_replace('　','',$values['content']);	
				$values['content'] =  discuzcode($values['content']);			
				$values['content'] =  messagecutstr($values['content'],50);				
				$values['content'] = mb_convert_encoding(strip_tags(trim($values['content'])), 'utf-8', 'gbk');
				$values['author'] = mb_convert_encoding(strip_tags(trim($values['author'])), 'utf-8', 'gbk');
				$list[]=array("uid"=>$values['authorid'],"uname"=>$values['author'],"tx"=>$values['avatar'],"nr"=>trim($values['content']));
				$value['arr'] = $list;
			}			
		}else{
			$comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");		
			$value['commentnum'] = $comment['commentnum'];
			$value['viewnum'] = $comment['viewnum'];
		}
		$value['arr'] = $value['arr'];	
		$value['title'] = mb_convert_encoding($value['title'], 'utf-8', 'gbk');
		$value['pic'] = ($value['remote'] == 1 ? $_G['setting']['ftp']['attachurl']."portal/" : ($value['serverid'] > 0 ? "http://".$domainall[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];		
		$array[] = $value;
	}	
	return $array;
}
$array = array();
$name = 'kqmg';
function loadCacheArray($name,$offset=0,$limit){
	try{		
		$filename = "cat_878";
		$aray_index = "list_$offset_".$name;
		static $cache_array = NULL;
		if ($cache_array == NULL) {
            if($_G['uid']==1){
                ForumOptionCache::deleteCache($filename);
            }
			$cache_array = ForumOptionCache::loadCache($filename, $aray_index);
		}
		if (isset($cache_array[$aray_index])) {
			$cache_item = $cache_array[$aray_index];
		} else {
			$cache_item = array();
		}
		if ($cache_item && isset($cache_item['cacheTime'])) {
			//缓存时间：3*3600=10800
			if (time() - 10800 < $cache_item['cacheTime']) {					
				return $cache_item['content'];
			}
		}
		$item_array = array('cacheTime'=>time());
		$item_array['content'] = getKqmgList($offset,$limit);
		$cache_array[$aray_index] = $item_array;			
		ForumOptionCache::writeCache($filename, $cache_array);
		return $item_array['content'];		
	}catch(Exception $e){
		return array();
	}
}
$array = loadCacheArray('kqmg',$offset,$limit);
if ($array) {
	$json['pics'] = $array;
	$json['count'] = count($array);
	$json['error_code'] = 0;
}
echo json_encode($json);