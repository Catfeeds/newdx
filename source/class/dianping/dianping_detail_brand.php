<?php
/**
 *	品牌点评详情个性信息处理
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/class/dianping/dianping_detail.php';
class detail_brand extends detail
{
	/**
	 * 品牌详细页面获取右侧相关内容
	 */
	function get_info_by_index($method,$result){
	    $allmethod = array("articles","zb","dzty","topics","blogs","photos");

	    if(!in_array($method, $allmethod)){

	       return false;
	    }

	    if(empty($result[$method])){
		return null;
	    }
	    $dl_id = $result[$method]['id_array'];
	    switch ($method) {
		    case "articles" :
		    $sql = "SELECT aid, title, pic, remote,serverid, dateline FROM ".DB::table('portal_article_title')."	WHERE aid in($dl_id)  GROUP BY aid ORDER BY aid DESC LIMIT ".$result[$method]['limit'];
		    break;
		    case "topics" :
		    $sql = "SELECT topicid,title,cover FROM ".DB::table('portal_topic')." WHERE closed = 0 AND topicid in($dl_id)  ORDER BY topicid DESC LIMIT ".$result[$method]['limit'];
		    break;
		    case "blogs" :
		    $sql = "SELECT blogid,uid,subject FROM ".DB::table('home_blog')." WHERE blogid in($dl_id)  ORDER BY blogid DESC LIMIT ".$result[$method]['limit'];
		    break;
		    case "photos" :
		    $sql = "SELECT * FROM ".DB::table('home_album')." WHERE  (friend=0 and albumid in($dl_id))  ORDER BY albumid DESC LIMIT ".$result[$method]['limit'];
		    break;
		    default:
		  	  $sql = "SELECT pid,authorid,tid,subject FROM ".DB::table('forum_post')." WHERE subject != '' AND pid in($dl_id)  ORDER BY tid desc LIMIT ".$result[$method]['limit'];
		    break;
	    }
	    $sql .= ' '.getSlaveID();
	    $query = DB::query($sql);
	    $return = false;

	    /*加入附件服务器*/
	    require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";

	    $attachserver = new attachserver;

	    $alldomain = $attachserver->get_server_domain('all');
	    /*结束*/

	    while($value = DB::fetch($query)){

			if(in_array($method,array("zb","dzty"))){

			    $value['avatar'] = avatar($value['authorid'], 'small');

			}

		$pic_domain = (isset($value['remote']) && $value['remote']>0) ? $_G['setting']['ftp']['attachurl'] : ((isset($value['serverid']) && $value['serverid']>0) ? "http://".$alldomain[$value['serverid']]."/" : "/data/attachment/");

		if($method=='photos'){

		    if($value['friend']!= 4){

			$value['pic'] =$pic_domain."album/".$value['pic'];

		    }

		}
		if($method=='articles' && !empty($value['pic'])){
		    $value['pic'] =$pic_domain."portal/".$value['pic'];
		}
		$return[] = $value;
	    }
	    return $return;
	}

	/**
	 * 读取缓存索引信息
	 */
	function get_cache_index($key,$module){
	    if($module==""){
		//echo "模块未选择";
		return false;
	    }
	    $query=DB::fetch_first("SELECT * FROM ".DB::table('plugin_cache_tableindex')." WHERE type='".$module."'");
	    if(empty($query)){
		//echo "当前模块不存在";
		return false;
	    }
	    $tablename = $query['table_name'];
	    $tid = (int)$key;
	    $query=DB::query("SELECT * FROM ".DB::TABLE('plugin_cache_brand')." where id=$tid");
	    while($value=DB::fetch($query)){
			$info[$value['type']]=$value;
	    }
	    return $info;
	}

	function getProduceAtIndex($cplist,$id=0) {
		$arr=array();
		if($cplist){
			foreach ($cplist as $key=>$row) {
				$num = DB::result_first("SELECT count(*) FROM ".DB::table('dianping_brand_info')." WHERE  FIND_IN_SET('$key',ranklist)",0);
				if($num){
					$arr[$key]['num'] = $num;
					$arr[$key]['name'] = $row;
					$arr[$key]['cid'] = $key;
				}
			}
		}
		return $arr;
	}
	/**
	 * //计算排名顺序
	 * @param unknown_type $id
	 */
	function rank($id){
			$query=DB::query("SELECT tid FROM ".DB::table('dianping_brand_info')." WHERE  FIND_IN_SET('$id',ranklist) ORDER BY score DESC,id DESC ");
			while ($array=DB::fetch($query)){
				$cplist[]=$array;
			}
			return $cplist;
	}
	/**
	 * 获取品牌在排行榜中的名次
	 */
	function getBrandRanking($ranklist,$cpid,$tid){
				$cpid=explode(',', $cpid);
				$rankName=array();
				foreach ($ranklist as $key=>$value){
					$proid_array[$key]=$key; //排行榜cid
				}
				foreach ($cpid as $k=>$v){
					if(in_array($v, $proid_array)){
						$cplist=array_values($this->rank($v));
						foreach ($cplist as $key=>$value){
								if($value['tid']==$tid){
								   	$ranking=$key+1;
									break;
								}
						}
						$rankName[$k]['name']=$ranklist[$v];
						$rankName[$k]['cp']=$v;
						$rankName[$k]['ranking']=$ranking;
					}
				}
				return $rankName;
	}

}
