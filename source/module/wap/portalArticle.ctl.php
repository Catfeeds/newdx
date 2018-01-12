<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class PortalArticleCtl extends FrontendCtl{

	private $mdArticleTitle;
	private $mdArticleContent;
	private $mdForumThread;
	private $mdArticleCount;
	private $mdForumPost;
	private $mdForumAttachment;

	function __construct()
	{
		parent::__construct();

		$this->mdArticleTitle		= m("portal_article_title");
		$this->mdArticleContent		= m("portal_article_content");
		$this->mdForumThread		= m("forum_thread");
		$this->mdArticleCount		= m("portal_article_count");
		$this->mdForumPost			= m("forum_post");
		$this->mdForumAttachment	= m("forum_attachment");
	}

	//��ʾ�б�--�ο�module/portal/portal_list.php
	function showlist()
	{
		global $_G;
		global $returnData;

		//��������
		$_G['gp_catid'] = $catid = max(0,intval($_G['gp_catid']));
		$perpage = $_G['gp_perpage'] ? intval($_G['gp_perpage']) : 15;
		$page 	 = $_G['gp_page'] ? max(1,intval($_G['gp_page'])) : 1;
		$start 	 = ($page - 1) * $perpage;

		if(empty($catid)) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'list_choose_category')));
		}

		$portalcategory = &$_G['cache']['portalcategory'];
		$catShow 	= isset($portalcategory[$catid]) ? $portalcategory[$catid] : array();
		$fabledAids = array('9999'=>1,'9998'=>1);//�鹹���������ࣺ9999:ȫ������;9998��ɽ��,������ɽ(224),����(232)
		if(empty($catShow) && !isset($fabledAids[$catid])) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'list_category_noexist')));
		}
		require_once libfile('function/portalcp');
		$categoryperm = getallowcategory($_G['uid']);

		if($catShow['closed'] && !$_G['group']['allowdiy'] && !$categoryperm[$catid]['allowmanage'] && !isset($fabledAids[$catid])) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'list_category_is_closed')));
		}

		//�ⲿ������ת
		if(!empty($catShow['url'])) {
			encodeData(array("url"=>$catShow['url']));
		}

		//������̳��ѡ
		$catLtjx = array("871", "886", "887", "888", "889", "890", "891", "892", "893", "894", "895", "896", "897", "898", "899", "900", "901");
		$catLtjx = array_flip($catLtjx);
		if(isset($catLtjx[$catid])){//��̳��ѡ
			$name	= 'jctj';
			$returnData["articleList"]	= $this->_loadCacheArray($name, $catid, $page, $perpage);
		} elseif ($catid == 842) {//ÿ��һͼ
			$name	= 'mryt';
			$returnData["articleList"]	= $this->_loadCacheArray($name, $catid, $page, $perpage);
		} elseif ($catid == 880) {//��������
			$name	= 'yzxx';
			$returnData["articleList"]	= $this->_loadCacheArray($name, $catid, $page, $perpage);
		} elseif ($catid == 878) {//���õ��
			$name	= 'kqmg';
			$returnData["articleList"]	= $this->_loadCacheArray($name, $catid, $page, $perpage);
		} elseif ($catid == 912) {//������Ӱʦ
			$name	= 'hwsys';
			$returnData["articleList"]	= $this->_loadCacheArray($name, $catid, $page, $perpage);
		} else {

			//�����༰�����ࡢ�ֵܷ��ࡢ�ӷ���
			if ($catid == 9999) {
				$catShow["children"] = array("201","202","203","224","528","228","227","231","232","486","235","844","775","234","204","209","211","207","208","212","792","218","219","222","220","214","216","215","223","751","489","733","746","238","239","242","241");
			} elseif ($catid == 9998) {
				$catShow1 = category_remake(224);
				$catShow2 = category_remake(232);
				$catShow["catname"]  = 'ɽ��';
				$catShow["children"] = array_merge($catShow1["children"], $catShow2["children"]);
			} else {
				$catShow = category_remake($catid);
				$catShow["children"][] =  $catid;
			}
			$where   = "{$this->mdArticleTitle->alias}.status='0' and {$this->mdArticleTitle->alias}.catid IN (".dimplode($catShow["children"]).")";
			$rcTotal = $this->mdArticleTitle->getCount($where);
			if ($rcTotal) {
				$articleList = $this->mdArticleTitle->find(array("fields"=>"{$this->mdArticleTitle->alias}.*", "conditions"=>$where, "order"=>"{$this->mdArticleTitle->alias}.dateline desc", "limit"=>"$start,$perpage"), false);
			}

			$aids = array();
			foreach ($articleList as $k=>$v) {
				if ($catid == 902) {
					//����ѡ��ԭͼ����ͼƬ����,��һ������������ֵ,�ڶ�������Ϊ0,����������Ϊ5
					$v['pic']  = getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, 'portal/'.$v['pic'], 0, $v['serverid']);
					$aids[$v['aid']] = $v['aid'];
				} else {
					$v['pic'] 	  = $v['pic'] ? getimagethumb(130,90,22,'portal/'.$v['pic'], 0, $v['serverid']) : "";
				}
				$v['catname'] = $v['catid'] == $catShow['catid'] ? $catShow['catname'] : $portalcategory[$v['catid']]['catname'];
				$articleList[$k] = $v;
			}

			//��ȡ����ͳ����Ϣ
			if ($aids) {
				$aids = implode(",", $aids);
				$articleCountList = $this->mdArticleCount->find(array("fields"=>'viewnum', "conditions"=>"aid in ({$aids})"));
				$returnData["articleCountList"] = $articleCountList;
			}

			$returnData["articleList"] 		= $articleList;
			$returnData["catname"] 			= $catShow["catname"];
			$returnData["start"] 	   		= $start;
		}

		$returnData["description"] 		= $catShow["description"];
		$returnData["keyword"] 			= $catShow["keyword"];

		encodeData($returnData);
	}

	//����ͨ�÷���--�ο�module/portal/portal_list.php
	function _loadCacheArray($name, $catid, $page = 1, $perpage = 100){
		global $_G;
		try{
			$start 	 		= ($page - 1) * $perpage;
			$filename		= "wap_cat_{$catid}_{$start}_{$perpage}";
			$array_index 	= "wap_list_{$catid}_{$start}_{$perpage}_{$name}";
			static $cache_array = NULL;
			if ($cache_array == NULL) {
	            if($_G['uid'] == 1){
	                ForumOptionCache::deleteCache($filename);
	            }
	            ForumOptionCache::deleteCache($filename);
				$cache_array = ForumOptionCache::loadCache($filename, $array_index);
			}

			$cache_item = isset($cache_array[$array_index]) ? $cache_array[$array_index] : array();
			if ($cache_item && isset($cache_item['cacheTime'])) {
				//����ʱ�䣺3*3600=10800
				if (time() - 10800 < $cache_item['cacheTime']) {
					return $cache_item['content'];
				}
			}
			$item_array = array('cacheTime'=>time());
			switch ($name) {
				case 'jctj':
				case 'mryt':
				case 'yzxx':
				case 'kqmg':
				case 'hwsys':
					$item_array['content'] = $this->_getJctjList($catid, $page, $perpage); break;
				default:
					$item_array['content'] = array();break;
			}
			$cache_array[$array_index] = $item_array;
			ForumOptionCache::writeCache($filename, $cache_array);
			return $item_array['content'];
		}catch(Exception $e){
			return array();
		}
	}

	//��̳��ѡ�б�
	function _getJctjList($catid, $page = 1,$perpage=40){
		global $_G;
		global $returnData;

		$start 	 = ($page - 1) * $perpage;
		$where   = "status=0 and pic <> mpic and mpic <> '' and pic <> ''";
		$where  .= $catid == 871 ? " and catid in (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901)" : " and catid in ($catid)";
		$articleTitleList = $this->mdArticleTitle->find(array("fields"=>"aid,catid,title,url,pic,mpic,serverid,dateline", "conditions"=>$where, "order"=>"aid desc", "limit"=>"$start,$perpage"), false);
		$result  = array();
		$tids    = array();
		foreach ($articleTitleList as $v) {
			$v['pic']  	= $v['mpic'] ? getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, 'portal/'.$v['mpic'], 0, $v['serverid']) : "";
			unset($v['mpic']);

			//����url
			$v['url'] = str_replace('picture', 'thread', $v['url']);
			if (strrpos($v['url'], 'viewthread') === false) {
				preg_match("/thread-(\d+)-/is", $v['url'], $matA);
			} else {
				preg_match("/viewthread-tid-(\d+)-/is", $v['url'], $matA);
			}

			$v['tid'] 		   = $matA[1];
			if (empty($v['tid'])) {continue;}
			$tids[$v['tid']]   = $v['tid'];
			$result[$v['tid']] = $v;
		}

		//������ӵĻظ����������
		if ($tids) {
			$tids = implode(',', $tids);
			$query = DB::query("SELECT t.tid, t.views,t.replies
				FROM ".DB::table('forum_thread')." t
				WHERE t.tid in ({$tids})
				ORDER BY t.tid desc
				". getSlaveID());
			while($v = DB::fetch($query)) {
				$result[$v['tid']]['views']   = $v['views'];
				$result[$v['tid']]['replies'] = $v['replies'];
			}
		}

		//��ҳ
		$rcTotal = $this->mdArticleTitle->getCount($where);
		$pageCnt = ceil($rcTotal / $perpage);
		$returnData["pager"] = array(
			"pageCnt"  => $pageCnt,
			"queryStr" => "catid={$catid}",
			"prevPage" => $page == 1 ? 1 : $page - 1,
			"nextPage" => $page == $pageCnt ? $pageCnt : $page + 1,
			"currPage" => $page
		);

		return $result;
	}

	//��ʾ�б�--�ο�module/portal/portal_view.php
	function showview()
	{
		global $_G;
		global $returnData;

		//��������
		$aid 	 = empty($_G['gp_aid']) ? 0 : intval($_G['gp_aid']);
		$perpage = 1;
		$page    = max(1,intval($_G['gp_page']));
		$start 	 = ($page - 1) * $perpage;

		//�ж��Ƿ���aid
		if(empty($aid)) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'view_no_article_id')));
		}

		//���������Ϣ
		$articleShow = $this->mdArticleTitle->get(array("conditions"=>"aid='{$aid}'", "limit"=>"0,1"));
		require_once libfile('function/portalcp');
		$permission = getallowcategory($_G['uid']);

		//�ж������Ƿ����
		if(empty($articleShow) || ($articleShow['status'] > 0 && $articleShow['uid'] != $_G['uid'] && !$_G['group']['allowmanagearticle'] && empty($permission[$articleShow['catid']]['allowmanage']) && $_G['adminid'] != 1 && $_G['gp_modarticlekey'] != modauthkey($articleShow['aid']))) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'view_article_no_exist')));
		}

		//��ȡ����ͳ����Ϣ
		$articleCountShow = $this->mdArticleCount->get(array("conditions"=>"aid='{$aid}'", "limit"=>"0,1"));
		if($articleCountShow) {$articleShow = array_merge($articleCountShow, $articleShow);}

		//��portal_article_count�����¼ӻ�༭����
		if($articleCountShow) {
			$this->mdArticleCount->edit("aid='{$aid}'", array("catid"=>$articleShow["catid"],"dateline"=>$articleShow["dateline"],"viewnum"=>$articleCountShow["viewnum"]+1));
		} else {
			$this->mdArticleCount->add(array("aid"=>$aid,"catid"=>$articleShow["catid"],"dateline"=>$articleShow["dateline"],"viewnum"=>1));
		}

		//�ⲿ������ת
		if(!empty($articleShow['url'])) {
			encodeData(array("url"=>$articleShow['url']));
		}

		//�����༰�����ࡢ�ֵܷ��ࡢ�ӷ���
		$catShow = category_remake($articleShow["catid"]);

		//�����еķ�ҳ
		$contentShow = array();
		$multi   	 = '';
		if ($start > 0) {
			$contentList = $this->mdArticleContent->find(array("conditions"=>"aid='$aid'", "order"=>"pageorder asc", "limit"=>"1,{$articleShow["contents"]}"),false);
			foreach ($contentList as $k=>$v) {
				if ($k == 0) {
					$contentShow = $v;
				} else {
					$contentShow["content"] .= $v["content"];
				}
			}
		} else {
			$contentShow = $this->mdArticleContent->get(array("conditions"=>"aid='$aid'", "order"=>"pageorder asc", "limit"=>"{$start},1"));
		}

		//��ҳ:http://www.8264.com/viewnews-68-page-1.html
//		$multi = multi($articleShow['contents'], $perpage, $page, "http://m.8264.com/index.php?d=portal&c=article&m=showview&aid=$aid");

		$org = array();
		if($articleShow['idtype'] == 'tid' || $contentShow['idtype']=='pid') {
			require_once libfile('function/discuzcode');
			$posttable = getposttablebytid($articleShow['id']);

			if($contentShow['idtype']=='pid') {
				$firstpost = DB::fetch_first("SELECT p.first, p.authorid AS uid, p.author AS username, p.dateline, p.message, p.smileyoff, p.bbcodeoff, p.htmlon, p.attachment, p.pid, t.displayorder FROM ".DB::table($posttable)." p LEFT JOIN ".DB::table('forum_thread')." t USING(tid) WHERE p.pid='$contentShow[id]' AND p.tid='$articleShow[id]' " . getSlaveID());
			} else {
				$firstpost = DB::fetch_first("SELECT p.first, p.authorid AS uid, p.author AS username, p.dateline, p.message, p.smileyoff, p.bbcodeoff, p.htmlon, p.attachment, p.pid, t.displayorder FROM ".DB::table($posttable)." p LEFT JOIN ".DB::table('forum_thread')." t USING(tid) WHERE p.tid='$articleShow[id]' AND p.first='1' " . getSlaveID());
			}
			if(!empty($firstpost) && $firstpost['displayorder'] != -1) {
				$attachpids = -1;
				$attachtags = $aimgs = array();
				$firstpost['message'] = $contentShow['content'];
				if($firstpost['attachment']) {
					if($_G['group']['allowgetattach']) {
						$attachpids .= ",$firstpost[pid]";
						if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $firstpost['message'], $matchaids)) {
							$attachtags[$firstpost['pid']] = $matchaids[1];
						}
					} else {
						$firstpost['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $firstpost['message']);
					}
				}

				$post = array();
				$post[$firstpost['pid']] = $firstpost;
				if($attachpids != '-1') {
					require_once libfile('function/attachment');
					parseattach($attachpids, $attachtags, $post);
				}

				$contentShow['content'] = $post[$firstpost['pid']]['message'];
				$contentShow['pid'] 	= $firstpost['pid'];
				unset($post);

			} else {
				//�����Ӳ����ڣ���Ϊ��ͨ������
				$this->mdArticleTitle->edit("aid='{$aid}'", array("id"=>0,"idtype"=>""));
				$this->mdArticleContent->edit("aid='{$aid}'", array("id"=>0,"idtype"=>""));
			}
		} elseif($articleShow['idtype'] == 'blogid') {
			$org = DB::fetch_first("SELECT * FROM ".DB::table('home_blog')." WHERE blogid='$articleShow[id]'");
			if(empty($org)) {
				//�����Ͳ����ڣ���Ϊ��ͨ������
				$this->mdArticleTitle->edit("aid='{$aid}'", array("id"=>0,"idtype"=>""));
			}
		}

		if (!empty($contentShow)) {

			//������������flash�Ĵ���:http://www.8264.com/viewnews-48445-page-1.html
			require_once libfile('function/blog');
			$contentShow['content'] = blog_bbcode($contentShow['content']);

			//���������������صĴ���:http://www.8264.com/viewnews-63363-page-1.html
			$ss_url = 'http://www.8264.com/'; // �뽫�����ӵ�ַ��Ϊ���� SS վ���ַ������
			$findarr = array(
				$ss_url.'batch.download.php?aid=', // �������ص�ַ
				$ss_url.'attachments/',  // ����ͼƬĿ¼
				$ss_url.'images/base/attachment.gif',  // ��������ͼ��
				"<p></p>",
				"<P></P>"
			);
			$replacearr = array(
				'portal.php?mod=attachment&id=',
				$_G['setting']['attachurl'].'/portal/',
				STATICURL.'image/filetype/attachment.gif',
				"",
				""
			);
			$contentShow['content'] = str_replace($findarr, $replacearr, $contentShow['content']);
			/*�˴���Ǩ��CDN����2014��9��23��0��0��0��ǰ�ĸ�����ַ�����CDN��ַ*/
			if($contentShow['dateline'] < 1411401600){
				$contentShow['content'] = str_replace($_G['config']['web']['attach'], "http://image1.8264.com/", $contentShow['content']);
			}
			/*����*/
			//�����������е�ͼƬ���н��ʴ���
			$contentShow['content'] = dealTextPic($contentShow['content']);

			//�����������еı����д���,��ʱ�Ȳ���ʾ
			$contentShow['content'] = preg_replace('/(<table.*>.*<\/table>)/isU', '<div class="table-container" style="display:none;"><div class="scrollable-holder"><div class="scroller">\1</div></div></div>', $contentShow['content']);
		}

        //����ѧУר��ͳ�ƿ�ʼ
        xuexiaoStatistics_wap($aid,$articleShow["catid"],$_G['gp_uid']);
        //����ѧУר��ͳ�ƽ���

		//�������
		$article['related'] 	= array();
		$article_related_limit  = $_G['newtpl']?6:5;
		$sql = "SELECT a.aid,a.title,a.dateline
			FROM ".DB::table('portal_article_related')." r
			LEFT JOIN ".DB::table('portal_article_title')." a ON a.aid=r.raid
			WHERE r.aid='$aid' ORDER BY r.displayorder limit $article_related_limit";
		$relatedList = $this->mdArticleTitle->getAll($sql);

		$returnData["articleShow"] 		= $articleShow;
		$returnData["contentShow"] 		= $contentShow;
		$returnData["catShow"] 			= $catShow;
//		$returnData["multi"] 			= $multi;
		$returnData["relatedList"] 		= $relatedList;
		$returnData["navtitle"] 		= $articleShow['title'].($page>1?" ( $page )":'').' - '.$catShow['catname'];
		$returnData["metakeywords"] 	= $articleShow['title'];
		$returnData["metadescription"] 	= $articleShow['summary'] ? $articleShow['summary'] : $articleShow['title'];

		encodeData($returnData);
	}

	//�ۺϱ�ǩ�б�--�ο�source/class/block/portal/block_article.php��getdata()
	function showlistbytag()
	{
		global $_G;
		global $returnData;

		//��������
		$perpage = $_G['gp_perpage'] ? intval($_G['gp_perpage']) : 15;
		$page 	 = $_G['gp_page'] ? max(1,intval($_G['gp_page'])) : 1;
		$start 	 = ($page - 1) * $perpage;

		if(empty($_G['gp_tagid'])) {
			encodeData(array('error'=>true , 'errorinfo'=>"û����ȷָ��Ҫ�ۺϱ�ǩ"));
		}

		$tags   = explode(",", $_G['gp_tagid']);
		$article_tags = array();
		$arrTagsName  = array();
		foreach($tags as $v) {
			$v = intval($v);
			if ($v < 1 || $v > 8) {continue;}
			$article_tags[$v] = 1;
			$arrTagsName[$v]  = $_G["setting"]["article_tags"][$v];
		}

		if (empty($article_tags)) {
			encodeData(array('error'=>true , 'errorinfo'=>"û����ȷָ��Ҫ�ۺϱ�ǩ"));
		}

		$portalcategory = &$_G['cache']['portalcategory'];

		$where  = "{$this->mdArticleTitle->alias}.status='0' and {$this->mdArticleTitle->alias}.url = '' ";

		include_once libfile('function/portalcp');
		$tagValue = article_make_tag($article_tags);
		if($tagValue > 0) {
			$where .= " and ({$this->mdArticleTitle->alias}.tag & $tagValue) = $tagValue";
		} else {
			encodeData(array('error'=>true , 'errorinfo'=>"û����ȷָ��Ҫ�ۺϱ�ǩ"));
		}
		$rcTotal = $this->mdArticleTitle->getCount($where);
		if ($rcTotal) {
			$articleList = $this->mdArticleTitle->find(array("fields"=>"{$this->mdArticleTitle->alias}.*", "conditions"=>$where, "order"=>"{$this->mdArticleTitle->alias}.dateline desc", "limit"=>"$start,$perpage"), false);
		}
		foreach ($articleList as $k=>$v) {
			$v['pic'] 	  = $v['pic'] ? getimagethumb(130,90,22,'portal/'.$v['pic'], 0, $v['serverid']) : "";
			$v['catname'] = $v['catid'] == $catShow['catid'] ? $catShow['catname'] : $portalcategory[$v['catid']]['catname'];
			$articleList[$k] = $v;
		}

		$returnData["articleList"] 	= $articleList;
		$returnData["catname"] 		= implode(" | ", $arrTagsName);
		$returnData["start"] 	   	= $start;

		encodeData($returnData);
	}

}
?>
