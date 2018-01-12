<?php

/**
 * @author zhl
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once 'dianpingmod.model.php';
Class BrandModel extends DianpingmodModel{
	var $table = 'dianping_brand_info';
	var $prikey = 'id';
	var $alias = 'bd';
	var $_moduleid = 'brand';
	var $_vars = array(
		'pk' => 'id',
		'tid' => 'tid',
		'name' => 'subject',
		'cn' => 'cname',
		'en' => 'ename',
		'company' => 'company',
		'phone' => 'tel',
		'pic' => 'showimg',
		'city' => 'city',
		'nation' => 'nation',		
		'letter' => 'letter',
		'url' => 'url',		
		'address' => 'addr',
		'enable' => 'ispublish',
		'orderby' => 'displayorder',
		'serverid' => 'serverid',
		'zs' => 'zhaoshang',		
		'score' => 'score',
		'num' => 'cnum',
                'baid' => 'baid',
                'dir' => 'dir',
		'cptop' => 'ranklist',
		'lastrate' => 'lastrate',
		'lastscore' => 'lastscore',	
		'dateline' => 'dateline',
		'lastpost' => 'lastpost',
                'tel' => 'tel'
	);
	
	/**
	 * 读取模块的页面title
	 * @param String $type 类型（list,view,post）
	 * @return Array
	 */
	function getNavTitle($type = 'list'){
		$arr =array();
		if($type=='list'){
			$nats = '';
			$pageTitle = unserialize($this->_moduleinfo['title']);
			$metakeywords = unserialize($this->_moduleinfo['keyword']);
			$metadescription = unserialize($this->_moduleinfo['description']);
			if (! empty($_GET['let'])) {
			//	$let = $_GET['let'];				
			//	$lets = $this->_getLetterbyIndex();					
			//	$pageTitles = '按'.$lets[$let].'字母开头的户外运动品牌排行大全';				
			//	$pageTitle[$type] = $pageTitles;				
			}
			if (! empty($_GET['nat'])) {
				$nat = $_GET['nat'];				
				$nats = $this->_getBrandNationAtIndex($nat);
				$tit = '';				
				$pageTitles = $nats.$pageTitle[$type];				
				$pageTitle[$type] = $pageTitles;				
			}
			if (! empty($_GET['cp'])) {
				$cp = $_GET['cp'];				
				$pro = $this->_getProduceAtIndex($cp);			
				$pro['produce'] = $nats.$pro['produce'];
				$temp = str_replace('（国际品牌）','',$pro['produce']);
				$temp = str_replace('（国产品牌）','',$temp);						
				$temp = str_replace('品牌','',$temp);					
				$temp = str_replace('排行榜','',$temp);				
				$pageTitles = $pro['produce'].'|'.$temp.'什么牌子好 - 户外资料网';								
				$pageTitle[$type] = $pageTitles;				
			}			
			$arr = array(
			'pageTitle' => $pageTitle[$type],
			'metakeywords' => $metakeywords[$type],
			'metadescription' => $metadescription[$type],);			
		}elseif($type=='view'){
			$pageTitle = unserialize($this->_moduleinfo['title']);
			$metakeywords = unserialize($this->_moduleinfo['keyword']);
			$metadescription = unserialize($this->_moduleinfo['description']);
			if (! empty($_GET['tid'])) {
				$tid = $_GET['tid'];
				$subject = $this->_getSubjectBytid($tid);
			}
			$arr = array(
			'pageTitle' => str_replace('{subtitle}', $subject, $pageTitle[$type]),
			'metakeywords' => $subject.'，'.$metakeywords[$type],
			'metadescription' => $subject.'品牌介绍，联系电话地址，'.$subject.'用户口碑好评度打分，帮你全面了解'.$subject.$metadescription[$type]);				
		}elseif($type=='post'){
			$pageTitle = unserialize($this->_moduleinfo['title']);
			$metakeywords = unserialize($this->_moduleinfo['keyword']);
			$metadescription = unserialize($this->_moduleinfo['description']);
			$arr = array(
			'pageTitle' => $pageTitle[$type],
			'metakeywords' => $metakeywords[$type],
			'metadescription' => $metadescription[$type],);		
		}
		return $arr;
	}

    /**
     * 发布和修改数据
     * @param Array $postdata 提交的数据
     * @param Int $tid 提交的帖子TID，默认为空，当为空时是发帖
     * @param Int $pid 提交的帖子的PID，默认为空，当tid不为空，而pid为空时说明是回帖，当pid和tid都不为空时说明是编辑贴
     * @return bool
     */
    public function dopost($postdata, $tid = 0, $pid = 0)
    {
        global $_G;
        if(empty($postdata)) showmessage('post_sm_isnull', NULL);
        extract($postdata);
        $tid = intval($tid);
        $pid = intval($pid);
        if(trim($postdata['subject']) == '' && $pid == 0) {
            showmessage('post_sm_isnull');
        }
        if($pid == 0) $postdata['subject'] = dhtmlspecialchars(censor(trim($postdata['subject'])));
        $postdata['message'] = censor($postdata['message']);
        $attachment = self::getChildStatus('pic') ? 2 : 0;
        /*pid为0时是发新贴操作。*/
        if(empty($pid)){
            require_once libfile('function/post');
            if(checkflood()) {
                showmessage('post_flood_ctrl', '', array('floodctrl' => $_G['setting']['floodctrl']));
            } elseif(checkmaxpostsperhour()) {
                showmessage('post_flood_ctrl_posts_per_hour', '', array('posts_per_hour' => $_G['group']['maxpostsperhour']));
            }
            $posttableid = getposttableid('p');
            DB::query("INSERT INTO " . DB::table('forum_thread')." (fid, posttableid, author, authorid, subject, dateline, lastpost, lastposter, displayorder, digest, special, attachment, moderated, status, isgroup, closed) VALUES ('$this->_fid', '$posttableid', '$_G[username]', '$_G[uid]', '$subject', '$_G[timestamp]', '$_G[timestamp]', '$_G[username]', '', '', '', '{$attachment}', '', '0', '', '1')");
            $tid = DB::insert_id();
            $pid = insertpost(array(
                'fid' => $this->_fid,
                'tid' => $tid,
                'first' => 1,
                'author' => $_G['username'],
                'authorid' => $_G['uid'],
                'subject' => $postdata['subject'],
                'dateline' => $_G['timestamp'],
                'message' => $postdata['message'],
                'useip' => $_G['clientip'],
                'invisible' => '',
                'anonymous' => '',
                'usesig' => 0,
                'htmlon' => '',
                'bbcodeoff' => '',
                'smileyoff' => '',
                'parseurloff' => '',
                'attachment' => $attachment,
                'tags' => '',
            ));
            if($pid && getstatus(0, 1)){
                savepostposition($tid, $pid);
            }
            updatepostcredits('+', $_G['uid'], 'post', $this->_fid);
            require_once libfile('function/stat');
            DB::update('common_member_field_home', array('recentnote'=>$postdata['subject']), array('uid'=>$_G['uid']));
            $postdata['subject'] = str_replace("\t", ' ', $postdata['subject']);
            $lastpost = "$tid\t{$postdata[subject]}\t$_G[timestamp]\t$_G[username]";
            DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', threads=threads+1, posts=posts+1, todayposts=todayposts+1 WHERE fid='{$this->_fid}'", 'UNBUFFERED');
            updatestat('thread');
            // 更新图片附件
            require_once libfile('function/post');
            $new_img_edit && updateattach('', $tid, $pid, $new_img_edit, $_G['gp_attachdel'], $_G['gp_attachupdate'], $_G['uid']);

            $postdata['tid'] = $tid;
            $postdata['pid'] = $pid;
            $postdata['name'] = $postdata['subject'];
            $postdata['enable'] = 0;

            $postdata = array_merge($postdata, $this->picThreadHandle($imgselect, $tid, $pid, $_G['uid']));
            $argsment = $this->postdataHandle($postdata);
            $argsment['dateline'] = TIMESTAMP;//发布时间
            $this->add($argsment);
            $dianpingshow = m('dianpingshow');
            $dianpingshow->add(array('type' => 'forum', 'typeid' => $tid, 'fid' => $this->_fid));


            if($justreturn){return true;}
            showmessage("model_new_success", $_G['config']['web']['portal']."dianping.php?mod={$this->_moduleid}", array('name' => $this->_moduleinfo['mname']));
        }else{
            DB::update('forum_thread', array('subject' => $postdata['subject']), array('tid' => $tid));
            $updates = array(
                'subject' => $postdata['subject'],
                'message' => $postdata['message'],
                'useip' => $_G['clientip']
            );
            DB::update('forum_post', $updates, array('pid' => $pid));
            if($_G['forum']['ismoderator'] == 1){
                DB::update('forum_thread', array('moderated' => 1), array('tid' => $tid));
            }
            // 更新图片附件
            require_once libfile('function/post');
            $new_img_edit && updateattach('', $tid, $pid, $new_img_edit, $_G['gp_attachdel'], $_G['gp_attachupdate'], $_G['uid']);

            $postdata['tid'] = $tid;
            $postdata['pid'] = $pid;
            $postdata['name'] = $postdata['subject'];
            $postdata['enable'] = 0;
            if($postdata['self_define_city'] && ! $postdata['city']) {
                $mdCity = m('city');
                $city = $mdCity->add(array(
                    $mdCity->_vars['pId'] => $postdata['province'],
                    $mdCity->_vars['fid'] => $this->_fid,
                    $mdCity->_vars['name'] => $postdata['cityname'],
                    $mdCity->_vars['num'] => 0,

                ));
                $postdata['city'] = $city;
            }
            $postdata = array_merge($postdata, $this->picThreadHandle($imgselect, $tid, $pid, $_G['uid']));
            $argsment = $this->postdataHandle($postdata);
            $this->edit("{$this->_vars[tid]} = {$tid}", $argsment);

            showmessage("model_edit_success", $_G['config']['web']['portal']."dianping.php?mod={$this->_moduleid}&act=showview&tid={$tid}&pid={$pid}", array('name' => $this->_moduleinfo['mname']));

        }

    }

    /**
     * @see dianpingmod.model.php
     * 重载父类中的入库函数，对入库数据进行处理;
     */
    function postdataHandle($postdata){
        if ( isset( $postdata['imgselect'][0] ) && ! empty( $postdata['imgselect'][0] ) ) {
            $nowdata = $this->get( array('conditions' => "{$this->_vars[tid]} = {$postdata[tid]}") );
            if( $nowdata['baid'] != $postdata['imgselect'][0] ){
                require_once libfile( 'function/forum' );
                $_del = array();
                if ( $nowdata['baid'] > 0 ) {
                    $attach = DB::fetch_first( "SELECT aid, attachment, thumb, remote, serverid, dir FROM ".DB::table('forum_attachment')." WHERE aid = {$nowdata[baid]}" );
                    $_del[] = $attach['aid'];
                }
                $postdata['baid'] = $postdata['imgselect'][0];
                $_tmp = DB::fetch_first( "SELECT attachment, dir, serverid FROM " . DB::table('forum_attachment') . " WHERE aid = '{$postdata[baid]}'" );
                $postdata['pic'] = $_tmp['attachment'];
                $postdata['dir'] = $_tmp['dir'];
                $postdata['serverid'] = $_tmp['serverid'];
                DB::delete('forum_attachment', "aid IN(" . dimplode($_del) . ")");
            }else{
                
                $postdata['pic'] = $nowdata['showimg'];
                $postdata['serverid'] = $nowdata['serverid'];
            }
        }
        foreach( $this->_vars as $_k => $_v ){
            isset($postdata[$_k]) && $return[$_v] = $postdata[$_k];
            
        }
        return $return;
    }
	/**
	 * 读取详细页信息（详细页）
	 * @param $tid      int     帖子ID
	 */
	public function getview($tid)
	{
		global $_G;
		$viewdata = array();
		$cachedata = array();
		$select  = '';
		$enable = " AND {$this->alias}.{$this->_vars[enable]} = 1";
		if($_G['forum']['ismoderator'] == 1){
			$enable = '';
		}elseif(DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid = {$tid} AND authorid = {$_G[uid]} AND first = 1 " . getSlaveID())){
			$enable = '';
		}
		/*此处等post表模型建立后将完善修改*/
		$sql = "SELECT p.*".$this->_getSelect()." FROM {$this->table} {$this->alias} LEFT JOIN ".DB::table('forum_post')." p ON {$this->alias}.{$this->_vars[tid]} = p.tid WHERE {$this->alias}.{$this->_vars[tid]} = {$tid} AND p.fid={$this->_fid} AND p.first = 1 {$enable} " . getSlaveID();
		//echo $sql;exit;
		$viewdata = memory('get', 'cache_dianping_fid_'.$this->_fid.'_tid_' . $tid);
		if (! $viewdata){			
			$viewdata = DB::fetch_first($sql);
			memory('set', 'cache_dianping_fid_'.$this->_fid.'_tid_' . $tid, $viewdata, 30);
		}
		if(!empty($viewdata)){
			$viewdata = empty($cachedata[$tid]) ? $viewdata : array_merge($viewdata, $cachedata[$tid]);
			/*此处等thread表模型建立后将完善修改*/
			$viewdata = array_merge($viewdata, DB::fetch_first("SELECT views, replies FROM ".DB::table('forum_thread')." WHERE tid = {$tid}"));			
			require_once libfile('function/forumlist');			
			$viewdata['views'] += get_redis_views($tid, 'viewthread');
			/*更新帖子的点击量，放入缓存中，等待定期更新*/
			require_once libfile('class/myredis');
			$myredis = &myredis::instance();
			if ($myredis->connected)
			{
				$myredis->obj->hincrby('viewthread_number', $tid, 1);
			} else
			{
				DB::query("UPDATE LOW_PRIORITY ".DB::table('forum_thread')." SET views=views+1 WHERE tid='{$tid}'", 'UNBUFFERED');
			}
			$viewdata['subject'] = $viewdata['subject'];
			$viewdata['nationid'] = $viewdata['nation'];		
			$viewdata['nation'] = $this->_getBrandNationAtIndex($viewdata['nation']);		
			$viewdata['showimg'] = $this->_picHandle($viewdata['showimg'], $viewdata['serverid'],'forum');
			$viewdata['dateline'] = $this->_timeHandle($viewdata['dateline']);			
			$viewdata['shortsubject'] = cutstr($viewdata['subject'], 52);			
			$viewdata['message'] = $viewdata['message'];			
		}		
		/*读取评论信息*/
		return self::_viewDataHandle($viewdata);
	}
	//返回评论列表
	public function getComment($tid, $start = 0, $desc = true)
	{
		/*此处待post表模型建立后再完善*/
		$sql = "SELECT p.* FROM ".DB::table('forum_post')." p WHERE p.tid = {$tid} and p.first = 0 and invisible=0 ORDER BY p.dateline ".($desc ? 'DESC' : 'ASC')." LIMIT {$start},{$this->commentlimit} " . getSlaveID();
		$q = DB::query($sql);
		$comments = array();
		$dianping = m('dianping');
		$mod_dianping_support = m('dianpingsupport');
		while ($v = DB::fetch($q))
		{
			$logs = $dianping->getRatebypid($v['authorid'],$v['pid']);
			$v['message'] = str_replace('thumbImg(this)','thumbImg(this,null,757)',$v["message"]);			
			//$v['message'] = $this->_messageHandle($v['message']);
			if($logs){
				$v['starnum'] = $logs['starnum'];
				$v['supports'] = $logs['supports'];
				$v['goodpoint'] = $logs['goodpoint'];
				$v['weakpoint'] = $logs['weakpoint'];
			}else{
				$support = memory('get', 'support_pid_' . $v['pid']);
				if (! $support){			
					$support = $mod_dianping_support->get(array('fields' => 'COUNT(*) AS count', 'index_key' => '', 'conditions' => " pid=$v[pid]"));
					memory('set', 'support_pid_' . $v['pid'], $support, 60);
				}				
				$v['supports'] = $support['count'];				
			}			
			$comments[$v['pid']] = $v;
		}
		return $comments;
	}

	//查找每个用户打了多少分
	function getStarByRalateid($type, $typeid, $uid, $ralateid) {
		if($uid&&$ralateid){
			$starid = DB::result_first("SELECT id FROM ".DB::table('dianping_star_statistics')." WHERE type = '$type' AND typeid = '$typeid'");
			return $starid ? DB::fetch_first("SELECT * FROM ".DB::table('dianping_star_logs')." WHERE starid = $starid AND uid = $uid AND pid = $ralateid") : NULL;
		}else{
			return NULL;
		}
	}
	/**
	 * 对详细页数据进行处理
	 * @param array $data 传入的详细数据
	 * @return array
	 */
	function _viewDataHandle($data){
		if(!empty($data)){
			if($data['enable'] == 0){
				$data['subject'] .= '';
			}
		}
		return $data;
	}
	
	
	function _getSubjectBytid($tid){
		if($tid){			
			$info = DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE tid = '$tid'");
			return $info['subject'];
		}else{
			return null;	
		}		
	}
	
	function getTypeBytIdanduid($tid,$uid){
		$user_attentions = array(
			'likeit' => NULL,
			'wantuse' => NULL,
			'using' => NULL,
		);		
		$query = DB::query("SELECT * FROM ".DB::table('dianping_brand_users')." WHERE uid = {$uid} AND tid = {$tid}");
		while ($value = DB::fetch($query)) {
			$user_attentions[$value['type']] = $value;
		}
		return $user_attentions;
	}
	
	//2012-06-27 新增，读取缓存索引信息	
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
	  //2012-06-27 新增，通过索引更新信息
	function get_info_by_index($method,$result){
	    $allmethod = array("articles","zb","dzty","topics","blogs","photos");
	    //echo "<p>方法$method:";
	    if(!in_array($method, $allmethod)){
	      // echo "不在方法中";
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
		    $sql = "SELECT pid,authorid,tid,subject FROM ".DB::table('forum_post')." WHERE subject != '' AND pid in($dl_id)  ORDER BY tid desc LIMIT ".$result[$method]['limit'] . " " . getSlaveID();
		    break;
	    }
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
	
	//品牌俱乐部调用装备个数
	function getShareNumberAtBrand($tid){
		if($tid){
			return DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_equipment_info')." WHERE brandtid={$tid} and ispublish=1");
		}
	}	
	
	//品牌俱乐部的二级页面调用该品牌下的所有分享信息
	function getShareBytId($tid){
		if($tid){
			$array=array();
			$sql="SELECT i.showimg,i.serverid,i.dir,t.subject,t.tid FROM ".DB::table('dianping_equipment_info')." AS i
					LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid
					WHERE i.ispublish=1 AND t.displayorder >= 0 AND t.closed = 0 AND i.brandtid=$tid
					ORDER BY t.dateline DESC Limit 0,45 " . getSlaveID();			
			$query=DB::query($sql);		
			while ($value = DB::fetch($query)) {
				$value['showimg'] = $value['dir']."/".$value['showimg'];
				$array[] = $value;
			}	
			return $array;
		}
	}	
	/**
	 * 更新数量
	 * 
	 * @author 
	 */
	function _updateCount(){		
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_brand_info')." AS bd
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = bd.tid where 1 = 1 and t.displayorder!=-1 and bd.ispublish=1");
		$dianingmodules = m('dianpingmodules');
		$dianingmodules->setConfig("srcid = '{$this->_moduleid}'", array('maxcount' => $count));
	}
	
	/**
	* 获得个数
	*/
	function getMaxCount($condition){
		if($this->_moduleinfo['maxcount'] > 0 && empty($condition)){
			return $this->_moduleinfo['maxcount'];
		}else{				
			$count = $this->get(array('fields' => 'COUNT(*) AS count', 'index_key' => '', 'conditions' => "{$this->_vars[enable]} = 1{$condition}"));
			return $count['count'];
		}
	}
	/*
	* 返回我喜欢头像列表
	*/
	function getLikeitUsersAtNew($tid) {	
		if($tid){
			$users = array();
			$query = DB::query("SELECT b.id, b.uid, m.username FROM ".DB::table('dianping_brand_users')." AS b
						LEFT JOIN ".DB::table('common_member')." AS m
						ON b.uid = m.uid
						WHERE b.tid = {$tid} AND b.type='likeit'
						ORDER BY b.id DESC
						LIMIT 30");
			while ($value = DB::fetch($query)) {
			   $value['avatar'] = avatar($value['uid'], 'small');
			   $users[] = $value;
			}
			return $users;
		}else{
			return null;
		}		
	}
		
	/*
	* 返回个数
	*/
	function getBrandUsersNum($tid,$type) {
		if($tid&&$type){
			$query = DB::fetch_first("SELECT count(b.id) as num FROM ".DB::table('dianping_brand_users')." AS b
					WHERE b.tid = {$tid} AND b.type='$type'");	
			return $query['num'];
		}else{
			return 0;
		}	
	}
	/**
	 * 品牌首字母获取
	 */
	function _getLetterbyIndex($id=0) {		
		$arr=array();	
		$arr=array("1"=>"A","2"=>"B","3"=>"C","4"=>"D","5"=>"E","6"=>"F","7"=>"G","8"=>"H","9"=>"I","10"=>"J","11"=>"K","12"=>"L","13"=>"M","14"=>"N","15"=>"O","16"=>"P","17"=>"Q","18"=>"R","19"=>"S","20"=>"T","21"=>"U","22"=>"V","23"=>"W","24"=>"X","25"=>"Y","26"=>"Z");
		return $arr;
	}
	//获得招商信息	
	function _getZsInfoatIndex(){
		$arr = array();
		$query = DB::query("SELECT t.tid,t.views,t.replies,b.subject,b.showimg,b.dir,b.serverid FROM ".DB::table('dianping_brand_info')." as b LEFT JOIN ".DB::table('forum_thread')." AS t ON b.tid = t.tid WHERE b.zhaoshang = 1 order by t.dateline asc limit 7 " . getSlaveID());
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		$alldomain = $attachserver->get_server_domain('all');
		while ($value = DB::fetch($query)) {		
			$name = $value['subject'];
			if(stripos($name,"（")){
				$sp = stripos($name,"（");
				$en =  mb_substr($name,0,$sp);
				$cn =  mb_substr($name,$sp,strlen($name));
				$value['ename'] = $en;
				$value['cname'] = $cn;	
			}elseif(stripos($name,"(")){
				$sp = stripos($name,"(");
				$en =  mb_substr($name,0,$sp);
				$cn =  mb_substr($name,$sp,strlen($name));
				$value['ename'] = $en;
				$value['cname'] = $cn;	
			}else{
				$value['ename'] = $name;
			}
            $value['showimg'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/":"/data/attachment/").$value['dir']."/".$value['showimg'];
			$arr[] = $value;
		}
		return $arr;
	}
	/**
	 * 覆盖产品
	 */
	function _getProduceAtIndex($id=0) {
		$categorys = m('categorys');
		if($id){			
			$cp = $categorys->get(array('fields' => 'cid as id,name as produce','conditions' => 'enable = 1 AND cid ='.$id));
			if($cp){
				return $cp;
			}else{
				return null;
			}
		}
		$arr=array();	
		$cplist = $categorys->find(array('fields' => 'cid as id,name as produce','conditions' => 'enable = 1 AND fatherid = 24'));		
		if($cplist){			
			foreach ($cplist as $row) {				 
				$num = DB::result_first("SELECT count(*) FROM ".DB::table('dianping_brand_info')." WHERE  FIND_IN_SET('$row[id]',ranklist)",0);				
				if($num){
					$row['num'] = $num;
					$arr[] = $row;		
				}						
			}
		}		

		return $arr;		
	}
	
	/**
	 * 覆盖产品类别
	 */
	function _getProduceTypeAtIndex($id=0) {
		$categorys = m('categorys');
		$arr=array();	
		if($id){			
			$cplist = $categorys->find(array('fields' => 'cid as id,name as produce','conditions' => 'enable = 1 AND fatherid = 24 and  cid in ('.$id.')'));
			if($cplist){				
				foreach ($cplist as $row) {					
					$temp = str_replace('户外','',$row['produce']);	
					$temp = str_replace('（国际品牌）','',$temp);
					$temp = str_replace('（国产品牌）','',$temp);						
					$temp = str_replace('品牌','',$temp);					
					$temp = str_replace('排行榜','',$temp);		
					$temp = iconv('GBK','UTF-8',$temp);
					$arr[] = $temp;						
				}				
			}else{
				return null;
			}			
		}		
		return $arr;		
	}	
	
	function getXmlbybrand(){		
		global $_G;		
		require_once libfile('function/forumlist');	
		$blist = $list = array();	
		$sql = 'SELECT t.subject, t.replies, t.views,t.fid,t.displayorder, t.dateline , bd.*, bd.id AS pk , bd.tid AS tid , bd.subject AS name , bd.cname AS cn , bd.ename AS en , bd.company AS company , bd.tel AS phone , bd.showimg AS pic , bd.city AS city , bd.nation AS nation , bd.letter AS letter , bd.url AS url , bd.addr AS address , bd.ispublish AS enable , bd.displayorder AS orderby , bd.serverid AS serverid , bd.zhaoshang AS zs , bd.score AS score , bd.cnum AS num , bd.ranklist AS cptop FROM ' . DB::table('dianping_brand_info') . ' bd LEFT JOIN ' . DB::table('forum_thread') . ' t ON t.tid = bd.tid WHERE t.fid = 408 AND bd.ispublish = 1 AND bd.ispublish = 1 and t.displayorder!=-1 ORDER BY t.displayorder DESC ,t.heats DESC LIMIT 0,1000 ' . getSlaveID();
		$blist = memory('get', 'getbrandbyxml');
		if (! $blist){			
			$q = DB::query($sql);
			while ($v = DB::fetch($q))
			{
				$v['picpath'] = 'plugin/'.$v['pic'];
				$v['pic'] = $this->_picHandle($v['pic'], $v['serverid'],'forum'); 
				$v['views'] += get_redis_views($v['tid'], 'viewthread');
				$v['address'] = $this->_addressHandle($v['address'], $v['pro'], 1);
				$v['dateline'] = $this->_timeHandle($v['dateline'], 'Y-m-d');
				$v['proname'] = $this->_getRegionName($v['pro']);
				$v['shortsubject'] = cutstr($v['subject'], 18, '');
				$v['shortsubjectmore'] = cutstr($v['subject'], 18, '');
				$list[$v['tid']] = $v;
			}
			foreach ($list as $value) {
				$name = $value['subject'];			
				if(stripos($name,"（")){
					$sp = stripos($name,"（");
					$en =  mb_substr($name,0,$sp);
					$cn =  mb_substr($name,$sp,strlen($name));
					$value['ename'] = $en;
					$value['ename'] = $cn;	
				}elseif(stripos($name,"(")){
					$sp = stripos($name,"(");
					$en =  mb_substr($name,0,$sp);
					$cn =  mb_substr($name,$sp,strlen($name));
					$value['ename'] = $en;
					$value['cname'] = $cn;	
				 }else{
					$value['ename'] = $name;
				 }
				 $value['country'] = $this->_getBrandNationAtIndex($value['nation']);
				 $value['nation'] = $value['area']=='中国' ? '国内' : '国际';				 
 				 $value['nation'] = iconv('GBK','UTF-8',$value['nation']);
				 $value['group'] = iconv('GBK','UTF-8',"户外用品");
				 $value['cn'] = iconv('GBK','UTF-8//IGNORE',$value['cn']);
				 $value['en'] = iconv('GBK','UTF-8',$value['en']);
				 $value['url'] = iconv('GBK','UTF-8',$value['url']);
				 $value['subject'] = iconv('GBK','UTF-8',$value['subject']);
				 $value['country'] = iconv('GBK','UTF-8',$value['country']);				
				 $value['type'] = $this->_getProduceTypeAtIndex($value['ranklist']);
				 $value['url'] = $this->xmlencode($value['url']);	
				 if(stripos($value['url'],'|')){
					$url = substr($value['url'],0,strpos($value['url'],'|'));
					if($url){
						$value['url'] = substr($value['url'],strpos($value['url'],'|')+1);
					}					
				}else{
					$value['url'] = $value['url'];
				}				
				$value['showurl'] = substr($value['url'],7,strlen($value['url']));
				$blist[] = $value;
				 
			}	
			memory('set', 'getbrandbyxml', $blist, 84600);
		}		
		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";  
		$xml .= "<DOCUMENT>\n"; 		  
		foreach ($blist as $data) {  
			$xml .= $this->_create_item($data['subject'], $data['group'], $data['country'], $data['type'],$data['nation'],$data['score'],$data['cn'],$data['en'],$data['pic'],$data['url'],$data['showurl']);
		} 		  
		$xml .= "</DOCUMENT>";		
		header("Content-type: text/xml"); 
		echo $xml;exit;
	}
	
	function xmlencode($tag)
	{
		$tag = str_replace("&", "&amp;", $tag);
		return $tag;
	}
	
	function _create_item($subject, $group, $country, $type, $nation,$rank,$name,$nameEnglish,$logo,$url,$showurl)  
	{  
	    $item = "<item>\n";
	    $item .= "<key>".$subject."</key>\n";
	    $item .= "<display>";
	    $item .= "<group>".$group."</group>\n";  
	    $item .= "<country>" .$country . "</country>\n ";
		foreach ($type as $data) { 
			$item .= "<type>" . $data . "</type> \n";
		}
	    $item .= "<nation>" . $nation . "</nation> \n";
	    $item .= "<rank>" . $rank . "</rank> \n";	   
	    $item .= "<name>" . $name . "</name> \n";	      
	    $item .= "<nameEnglish>" . $nameEnglish . "</nameEnglish>\n ";
	    $item .= "<logo>" . $logo . "</logo>\n ";
	    $item .= "<url>" . $url . "</url> \n";
	    $item .= "<showurl>" . $showurl . "</showurl> \n";
	    $item .= "</display> \n";  
	    $item .= "</item> \n\n";	   
	    return $item;  
	}



	
	/**
	 * 处理图片
	 * @param String $picurl 图片地址
	 * @param Int $serverid 附件服务器ID
	 * @param String $f 存储的文件夹名
	 * @return String
	 * @access private
	 */
	function _picHandle($picurl, $serverid = 0, $f = 'plugin'){
		if(self::getChildStatus('pic') && $serverid > 0){
			/*开启了图片模块，才引入附件服务器类*/
			if(empty($this->alldomain)){
				require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
				$attachserver = new attachserver;
				$this->alldomain = $attachserver->get_server_domain('all');
			}
			$picurl = 'http://'.$this->alldomain[$serverid].'/'.$f.'/'.$picurl;
		}
		return $picurl;
	}	
	/**
	 * 品牌国籍
	 */
	function _getBrandNationAtIndex($id=0) {		
		$arr=array();
		$categorys = m('categorys');
		if($id){		
			$gj = $categorys->get(array('fields' => 'cid as id,name as area','conditions' => 'enable = 1 AND cid ='.$id));			
			if($gj){		
				return $gj['area'];
			}else{
				return null;
			}			
		}
		$categorys = $categorys->find( array(
						'index_key' => '',
						'fields' => 'cid,name',
						'conditions' => 'fatherid=124 and enable=1') );
		foreach ( $categorys as $row )
		{
			$row['rid'] = $row['cid'];		
			$row['area'] = $row['name'];
			$arr[] = $row;	
		}	
		return $arr;
	}
	
	/**
	 * 处理message（过滤等）
	 * @param String $message
	 * @return String
	 * @access private
	 */
	function _messageHandle($message,$pid){
		global $_G;
		require_once libfile('function/newdiscuzcode');
		$message = discuzcode($message,$pid);			
		if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $message, $matches)) {
				$aids = $matches[1];
				require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
				$attachserver = new attachserver;
				$domain  = $attachserver->get_server_domain("all");
				foreach ($aids as $aid) {
					$attachment = DB::fetch_first("SELECT attachment,isimage,remote,width,serverid FROM ".DB::table('forum_attachment')." WHERE aid='$aid'");
					if ($attachment['isimage']) {
						if($attachment['serverid']>0){							
							$path = "http://".$domain[$attachment['serverid']]."/forum/".$attachment['attachment'];
						}elseif($attachment['remote']){
							$path = $_G['setting']['ftp']['attachurl'].'forum/'.$attachment['attachment'];
						}else{
							$path = $_G['setting']['attachurl'].'forum/'.$attachment['attachment'];
						}
					}
					if($attachment['width']>610){
						$message = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" width="610px;" />', $message);
					}else{
						$message = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" />', $message);	
					}
				}					
		}
		return $message;
	}				
	//获取品牌在排行榜中的名次
	function getBrandRanking($cpid,$tid){
				$cpid=explode(',', $cpid);
				$rankName=array();
				$prolist=array();
				$pro=$this->_getProduceAtIndex();	
				foreach ($pro as $key=>$value){
					$prolist[$value['id']]=$value['produce'];
					$proid_array[$key]=$value['id'];
				}

				foreach ($cpid as $k=>$v){
					if(in_array($v, $proid_array)){	
						$where = " FIND_IN_SET('{$v}',{$this->alias}.{$this->_vars[cptop]})";
						$cplist = $this->getlist(array(
								'where' => $where,
								'order' => " ORDER BY t.displayorder DESC,bd.score DESC,bd.id DESC "
						));	
						$cplist=array_values($cplist);
						foreach ($cplist as $key=>$value){
								if($value['tid']==$tid){
									$ranking=$key+1;
									break;
								}
						}
						$rankName[$k]['produce']=$prolist[$v]."第".$ranking."名";
						$rankName[$k]['cp']=$v;
					}
				}
				return $rankName;
	}	
	//获取热门品牌
	function getHotBrand($count=20, $fields='subject', $orders = array('displayorder' => 'DESC','heats' => 'DESC')){
		$alias = $this->alias;
		if(is_array($fields)) {
			foreach ($fields as $value) {
				if($this->_vars[$value]) {
					$search_fields .= "{$alias}.{$this->_vars[$value]}, ";
				}
				else {
					$search_fields .= "t.{$value}, ";
				}
			}
			$search_fields .= ' t.tid';
		}
		else {
			$search_fields ="t.tid, {$alias}.{$fields}";
		}
		$sql = "SELECT $search_fields FROM {$this->table} $alias LEFT JOIN " . DB::table('forum_thread') . " t on t.tid = {$this->alias}.{$this->_vars[tid]} " . getSlaveID();

		if($orders) {
			$order = 'ORDER BY';
			foreach ((array)$orders as $key => $value) {
				if(in_array($key, $this->_vars)) {
					$order .= " {$alias}.{$this->_vars[$key]} {value}, ";
				}
				else {
					$order .= " t.{$key} {$value}, ";
				}
			}
			$order = rtrim($order, ', ');
		}
		$sql .= " WHERE t.fid={$this->_fid} AND t.displayorder!=-1  AND {$alias}.{$this->_vars['enable']}=1 {$order} limit {$count}";

		$result = array();
		//底层没有封装相关的方法
		$resource = DB::query($sql);
		while ($row = DB::fetch($resource)) {
			$result[] = $row;
		}
		mysql_free_result($resource);
		return $result;
	}
}
?>