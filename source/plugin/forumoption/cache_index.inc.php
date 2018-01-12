<?php
session_start();
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
error_reporting(E_ALL);
set_time_limit(9999);
$url = ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=forumoption&pmod=cache_index";
$_SESSION['typeofindex']= isset($_SESSION['typeofindex']) ? $_SESSION['typeofindex'] : false;
$_SESSION['typeofindex']= (isset($_GET['cache_mod']) && !empty($_GET['cache_mod'])) ? $_GET['cache_mod'] :  $_SESSION['typeofindex'];
$_SESSION['typeofindex']= isset($_GET['reselect']) ? false : $_SESSION['typeofindex'];
if($_SESSION['typeofindex']){
    if(isset($_GET['stop']) && $_GET['stop']==1){
        $_SESSION['post_save']=null;
        $_SESSION['autonum']=null;
    }
    if($_SESSION['typeofindex']=='plugin_cache_brand'){
        if(isset($_POST['sf_auto'])||!empty($_SESSION['post_save'])){
            $_SESSION['post_save'] = (isset($_POST)&&!empty($_POST)) ? $_POST : $_SESSION['post_save'];
            $auto_num = isset($_SESSION['autonum']) ?  $_SESSION['autonum'] : 0;
            $update_id = $_SESSION['post_save']['update'][$auto_num];
            $next = $_SESSION['autonum'] = $auto_num+1;
            $time_start = time();
            //添加模块
            $result = DB::fetch_first("SELECT subject,authorid FROM ".DB::TABLE("forum_thread")." WHERE tid = $update_id");
            $keywords = get_keyword($result['subject']);
            $keywords_num = count($keywords);
            $home_id = $result['authorid'];
            if ($keywords_num > 0) {
                //查询相关的品牌文章
                if(in_array('articles',$_SESSION['post_save']['module'])){
                    $mod = 'articles';
                    if($_SESSION['post_save']['ifhc']==1){
                        $argmengts = get_argmengts($mod,$keywords);
                        update_cache($mod,$argmengts,$update_id);
                    }
                    if($_SESSION['post_save']['ifdl']==1){
                        update_dl($update_id,$mod,10);
                    }
                }
                //查询相关的专题
                if(in_array('topics',$_SESSION['post_save']['module'])){
                    $mod = 'topics';
                     if($_SESSION['post_save']['ifhc']==1){
                        $argmengts = get_argmengts($mod,$keywords);
                        update_cache($mod,$argmengts,$update_id);
                     }
                    if($_SESSION['post_save']['ifdl']==1){
                        update_dl($update_id,$mod,5);
                    }
                }
                //查询相关的装备
                if(in_array('zb',$_SESSION['post_save']['module'])){
                    $mod = 'zb';
                    if($_SESSION['post_save']['ifhc']==1){
                        $argmengts = get_argmengts($mod,$keywords);
                        update_cache($mod,$argmengts,$update_id);
                    }
                    if($_SESSION['post_save']['ifdl']==1){
                        update_dl($update_id,$mod,8);
                    }
                }
                //查询相关的打折体验
                if(in_array('dzty',$_SESSION['post_save']['module'])){
                    $mod = 'dzty';
                    if($_SESSION['post_save']['ifhc']==1){
                        $argmengts = get_argmengts($mod,$keywords);
                        update_cache($mod,$argmengts,$update_id);
                    }
                    if($_SESSION['post_save']['ifdl']){
                        update_dl($update_id,$mod,8);
                    }
                }
                //查询相关的日志
                if(in_array('blogs',$_SESSION['post_save']['module'])){
                    $mod = 'blogs';
                    if($_SESSION['post_save']['ifhc']==1){
                        $argmengts = get_argmengts($mod,$home_id);
                        update_cache($mod,$argmengts,$update_id);
                    }
                    if($_SESSION['post_save']['ifdl']==1){
                        update_dl($update_id,$mod,10);
                    }
                }
                //查询相关的相册
                if(in_array('photos',$_SESSION['post_save']['module'])){
                    $mod = 'photos';
                    if($_SESSION['post_save']['ifhc']==1){
                        $argmengts = get_argmengts($mod,$keywords);
                        update_cache($mod,$argmengts,$update_id);
                    }
                    if($_SESSION['post_save']['ifdl']==1){
                        update_dl($update_id,$mod,4);
                    }
                }
            }
            //模块结束
            $time_end = time();
            echo "<div style='position:absolute;left:20%;top:30%'><h1 style='font-size:18px;'>正在执行自动添加功能，每10秒自动执行一次，如需停止<a href='$url&stop=1'>点击此处返回</a></h1>";
            echo "<br/><fieldset style='padding:20px;'><legend><b>调试信息</b></legend><p>共选择自动运行的品牌数为：<span style='color:blue' >".count($_SESSION['post_save']['update'])."</span> 个</p>";
            echo "<p>当前更新的类型：";
            echo ($_SESSION['post_save']['ifhc']==1) ? "【总缓存】" : "";
            echo ($_SESSION['post_save']['ifdl']==1) ? "【队列】" : "";
            echo "</p>";
            echo "<p>当前选择的模块有【".implode("】【",$_SESSION['post_save']['module'])."】</p>";
            echo "<p>刚刚更新了第<span style='color:red'>".($auto_num+1)."</span>个品牌【品牌ID：<a title='点击查看品牌'  target='_blank' href='{$_G['config']['web']['forum']}thread-".$update_id."-1-1.html' ><b><u style='color:red'>".$update_id."</u></b></a>】 共用时<b style='color:green'>".($time_end-$time_start)."</b>秒</p>";
            if($next >= count($_SESSION['post_save']['update'])){
                echo "<p>全部更新完成，5秒后转入管理页面</p>";
                echo "<meta http-equiv='refresh'content=5;URL='$url'>";
            }else{
                echo "<p>下一个更新为第<span style='color:red'>".($next+1)."</span>个品牌【品牌ID：<a title='点击查看品牌'  target='_blank' href='{$_G['config']['web']['forum']}thread-".$_SESSION['post_save']['update'][$next]."-1-1.html' ><b><u style='color:red'>".$_SESSION['post_save']['update'][$next]."</u></b></a>】</p></fieldset></div>";
                echo "<meta http-equiv='refresh'content=10;URL='$url'>";
            }
            if($next>=count($_SESSION['post_save']['update'])){
                //session_unregister('post_save');
                //session_unregister('autonum');
                $_SESSION['post_save']=null;
                $_SESSION['autonum']=null;
            }
        }else{
        if(isset($_POST['update'])){
            $update = $_POST['update'];
            for($post_i=0;$post_i<count($update);$post_i++){
                $result = DB::fetch_first("SELECT subject,authorid FROM ".DB::TABLE("forum_thread")." WHERE tid = $update[$post_i]");
                $keywords = get_keyword($result['subject']);
                $keywords_num = count($keywords);
                $home_id = $result['authorid'];
                if ($keywords_num > 0) {
                    //查询相关的品牌文章
                    if(in_array('articles',$_POST['module'])){
                        $mod = 'articles';
                        if($_POST['ifhc']==1){
                            $argmengts = get_argmengts($mod,$keywords);
                            update_cache($mod,$argmengts,$update[$post_i]);
                        }
                        if($_POST['ifdl']==1){
                            update_dl($update[$post_i],$mod,10);
                        }
                    }
                    //查询相关的专题
                    if(in_array('topics',$_POST['module'])){
                        $mod = 'topics';
                         if($_POST['ifhc']==1){
                            $argmengts = get_argmengts($mod,$keywords);
                            update_cache($mod,$argmengts,$update[$post_i]);
                         }
                        if($_POST['ifdl']==1){
                            update_dl($update[$post_i],$mod,5);
                        }
                    }
                    //查询相关的装备
                    if(in_array('zb',$_POST['module'])){
                        $mod = 'zb';
                        if($_POST['ifhc']==1){
                            $argmengts = get_argmengts($mod,$keywords);
                            update_cache($mod,$argmengts,$update[$post_i]);
                        }
                        if($_POST['ifdl']==1){
                            update_dl($update[$post_i],$mod,8);
                        }
                    }
                    //查询相关的打折体验
                    if(in_array('dzty',$_POST['module'])){
                        $mod = 'dzty';
                        if($_POST['ifhc']==1){
                            $argmengts = get_argmengts($mod,$keywords);
                            update_cache($mod,$argmengts,$update[$post_i]);
                        }
                        if($_POST['ifdl']){
                            update_dl($update[$post_i],$mod,8);
                        }
                    }
                    //查询相关的日志
                    if(in_array('blogs',$_POST['module'])){
                        $mod = 'blogs';
                        if($_POST['ifhc']==1){
                            $argmengts = get_argmengts($mod,$home_id);
                            update_cache($mod,$argmengts,$update[$post_i]);
                        }
                        if($_POST['ifdl']==1){
                            update_dl($update[$post_i],$mod,10);
                        }
                    }
                    //查询相关的相册
                    if(in_array('photos',$_POST['module'])){
                        $mod = 'photos';
                        if($_POST['ifhc']==1){
                            $argmengts = get_argmengts($mod,$keywords);
                            update_cache($mod,$argmengts,$update[$post_i]);
                        }
                        if($_POST['ifdl']==1){
                            update_dl($update[$post_i],$mod,4);
                        }
                    }
                }
            }
        }
        //$query = DB::query("SELECT tid,subject FROM ".DB::table('forum_thread')." WHERE fid=408 and displayorder >=0 ");
        $query= DB::query("SELECT p.tid,p.subject FROM ".DB::table('forum_thread')." as p
        LEFT JOIN ".DB::table('plugin_cache_brand_index')." as i ON p.tid = i.tid
        LEFT JOIN ".DB::table('plugin_cache_brand_otherindex')." as o ON p.tid = o.id
        WHERE p.fid=408 and p.displayorder >=0 GROUP BY p.tid ORDER BY i.dateline DESC , o.dateline DESC");
        $all_produce = array();
        $last_update_10 = 0;
        $last_update = array();
        $all_keyword = array();
        while($value = DB::fetch($query)){
            /*if($last_update_10 < 10 && $value['dateline']>0){
                $last_update[] = $value;
                $last_update_10++;
            }*/
            $all_keyword[$value['tid']] = "";
            $keyword_sub = get_keyword($value['subject']);
            for($ii=0;$ii<count($keyword_sub);$ii++){
                $all_keyword[$value['tid']].= " ".$keyword_sub[$ii];
            }
            $all_produce[] = $value;
        }

        include dirname(__FILE__)."/template/cache_index.htm.php";
        }
    }else{
        echo "<div style='position:absolute;left:30%;top:30%'><h1>当前模块正在建设，请<a href='".$url."&reselect=1'>更换</a></h1></div>";
    }
}else{
    $tips="";
    if(isset($_POST) && !empty($_POST)){
        if($_POST['method']=='add'){
            $name = $_POST['name'];
            $type = $_POST['type'];
            if(preg_match("/^[a-zA-Z]{4,10}$/",$type)==0){
                $tips = "提交的英文名错误，要求只能是英文且在4-10位之间";
            }else{
                $table_num = DB::result_first("SELECT count(*) from ".DB::table('plugin_cache_tableindex')." WHERE name='$name' and type='$type'");
                if($table_num>0){
                    $tips = "提交的模块中文英文名已经存在请换一个";
                }else{
                    $data = array('name'=>$name,'type'=>$type,'table_name'=>"plugin_cache_$type");
                    DB::insert("plugin_cache_tableindex",$data);
                    $tips="模块建立成功...";
                    //建立模块缓存队列表
                    DB::query("CREATE TABLE  IF NOT EXISTS `pre_plugin_cache_$type` (
                              `id` int(10) unsigned NOT NULL,
                              `type` char(20) NOT NULL,
                              `id_array` varchar(250) NOT NULL DEFAULT '' COMMENT '缓存对列',
                              `limit` tinyint(2) unsigned NOT NULL DEFAULT '10',
                              `type_table` char(30) NOT NULL,
                              `dateline` int(10) NOT NULL default '0'
                            ) ENGINE=MyISAM DEFAULT CHARSET=gbk;");
                    $tips.="<br/>缓存队列表建立成功...";
                    //建立模块缓存数据表，需要访问P表的除外，P表读另一个缓存数据表
                    DB::query("CREATE TABLE  IF NOT EXISTS `pre_plugin_cache_".$type."_otherindex` (
                              `id` int(10) unsigned NOT NULL,
                              `type` char(20) NOT NULL,
                              `otherid` int(10) unsigned NOT NULL,
                              `dateline` int(10) unsigned NOT NULL DEFAULT '0',
                              `displayorder` tinyint(1) NOT NULL DEFAULT '0',
                              KEY `id` (`id`) USING BTREE,
                              KEY `otherid` (`otherid`) USING BTREE,
                              KEY `displayorder` (`id`,`otherid`,`displayorder`,`type`) USING BTREE
                            ) ENGINE=MyISAM DEFAULT CHARSET=gbk;
                    ");
                    $tips.="<br/>缓存数据表建立成功...";
                    //建立模块缓存数据表，需要访问P表的除外，P表读另一个缓存数据表
                    DB::query("CREATE TABLE  IF NOT EXISTS `pre_plugin_cache_".$type."_index` (
                              `tid` mediumint(8) unsigned NOT NULL,
                              `pid` int(10) unsigned NOT NULL,
                              `dateline` int(10) unsigned NOT NULL DEFAULT '0',
                              `type` char(20) NOT NULL,
                              `displayorder` tinyint(1) NOT NULL DEFAULT '0',
                              KEY `tid` (`tid`) USING BTREE,
                              KEY `pid` (`pid`) USING BTREE,
                              KEY `displayorder` (`displayorder`,`pid`,`tid`) USING BTREE
                            ) ENGINE=MyISAM DEFAULT CHARSET=gbk;
                    ");
                    $tips.="<br/>缓存P表数据表建立成功...";
                    //建立无结果状态表，未查到内容的将都保存在此表，直到有内容时才删除
                    DB::query("CREATE TABLE  IF NOT EXISTS `pre_plugin_cache_".$type."_noresult` (
                              `id` int(10) unsigned NOT NULL,
                              `type` char(20) NOT NULL DEFAULT '',
                              `dateline` int(10) NOT NULL DEFAULT '0',
                              PRIMARY KEY (`id`)
                            ) ENGINE=MyISAM DEFAULT CHARSET=gbk;
                    ");
                    $tips.="<br/>无结果状态表建立成功...";
                }
            }
        }
    }else{
        if(isset($_GET['delmod'])&&!empty($_GET['delmod'])){
            $deltable_type =array('type'=>$_GET['delmod']);
            DB::delete("plugin_cache_tableindex",$deltable_type);
            $tips = "模块删除完成...";
            //DB::query("DROP TABLE IF EXISTS `pre_plugin_cache_".$_GET['delmod']);
            $tips .="<br/>模块缓存队列表将继续保存以免误删...";
            //DB::query("DROP TABLE IF EXISTS `pre_plugin_cache_".$_GET['delmod']."_otherindex`;");
            $tips .="<br/>缓存数据表将继续保存以免误删...";
        }
    }
    $tablename_arr = array();
    $query=DB::query("SELECT * FROM ".DB::table('plugin_cache_tableindex'));
    while($value = DB::fetch($query)){
        $tablename_arr[] = $value;
    }
    include dirname(__FILE__)."/template/cache_select.htm.php";
}
function get_keyword($str){
    $keyword = array();
    if(preg_match("/(\(|（|\)|）)/",$str)==0){
        $keyword[0] = trim($str);//只有英文名称
        $keyword[0] = addcslashes($str,"\\'");
    }else{//含有中文名称
        $keyword[0] = trim(preg_replace("/(\(|（).*(\)|）)/",'',$str));
        $keyword[1] = trim(preg_replace("/.*(\(|（)(.*)(\)|）)/",'\2',$str));
        $keyword[0] = addcslashes($keyword[0],"\\'");
        $keyword[1] = addcslashes($keyword[1],"\\'");
    }
    return $keyword;
}
function get_updatetime_by_id($id,$mod){
    $produce = array();
    //2012-07-05 新增，查询是否为没有相关内容的品牌。和无内容的模块
    $query = DB::query("SELECT type,dateline FROM ".DB::TABLE('plugin_cache_brand_noresult')." WHERE id=$id");
    while($value = DB::fetch($query)){
        $produce[$value['type']]=get_time($value['dateline'])."过，并未发现内容";
    }
    //2012-07-05
    if($mod == "cache"){
        $query = DB::query("SELECT type,max(dateline) as dateline FROM ".DB::TABLE('plugin_cache_brand_index')."
                            where tid = $id
                            GROUP BY type
                           ");
        while($value = DB::fetch($query)){
            $produce[$value['type']]=get_time($value['dateline']);
        }
        $query = DB::query("SELECT type,max(dateline) as dateline FROM ".DB::TABLE('plugin_cache_brand_otherindex')."
                            where id = $id
                            GROUP BY type");
        while($value = DB::fetch($query)){
            $produce[$value['type']]=get_time($value['dateline']);
        }
    }elseif($mod == "dl"){
        $query = DB::query("SELECT type,dateline FROM ".DB::TABLE('plugin_cache_brand')." WHERE id = $id");
        while($value = DB::fetch($query)){
            $produce[$value['type']]=get_time($value['dateline']);
        }
    }
    $return = array();
    foreach($produce as $key => $value){
        $return[modname($key)] = $value;
    }
    return $return;
}
function get_time($time){
    //$lasttime = DB::result_first("SELECT dateline FROM ".DB::TABLE('plugin_produce_index')." WHERE t_tid = $id");
    $time = ($time!="") ? time() - $time : null;
    if($time == 0){
        return "刚刚更新";
    }
    if($time!=null){
        $return = "";
        if($time>=3600){
            $htime = floor($time/3600);
            $time = $time-$htime*3600;
            $return = $htime."小时";
        }
        if($time>=60){
            $mtime = floor($time/60);
            $time = $time-$mtime*60;
            $return .= $mtime."分钟";
        }
        $return .=$time."秒前更新";
    }else{
        $return = false;
    }
    return $return;
}
function modname($mod){
    $modname = array('articles'=>'文章模块',
                    'zb'=>'装备模块',
                    'dzty'=>'打折体验模块',
                    'topics'=>'专题模块',
                    'blogs'=>'空间日志模块',
                    'photos'=>'相册模块'
                    );
    return $modname[$mod];
}
function update_dl($tid,$type,$limit){
    $query=in_array($type,array("zb","dzty")) ? DB::query("SELECT pid from ".DB::table('plugin_cache_brand_index')." WHERE tid=$tid and type='".$type."'  and displayorder >=0  order by pid DESC limit 0,$limit") : DB::query("SELECT otherid from ".DB::table('plugin_cache_brand_otherindex')." WHERE id=$tid and type='".$type."'  and displayorder >=0  order by otherid DESC limit 0,$limit");
    $list = array();
    while($value = DB::fetch($query)){
        $list[]=in_array($type,array("zb","dzty")) ? $value['pid'] : $value['otherid'];
    }
    if(empty($list)){
        return false;
    }
    $where = array('id'=>$tid,'type'=>$type);
    if(DB::result_first("SELECT count(*) FROM ".DB::table('plugin_cache_brand_noresult')." WHERE id = $tid and type = '".$type."'")>0){

        DB::delete('plugin_cache_brand_noresult',$where);
    }else{
        $update = array('dateline'=>time());
        DB::update('plugin_cache_brand_noresult',$update,$where);
    }
    $arr['id_array'] = implode(",",$list);
    $arr['limit'] = $limit;
    $arr['dateline'] = time();
    if(DB::result_first("SELECT count(*) from ".DB::table('plugin_cache_brand')." WHERE id=$tid and type='".$type."'")==0){
        $arr['id'] = $tid;
        $arr['type'] = $type;
        $sql = DB::insert("plugin_cache_brand",$arr);
    }else{
        DB::update("plugin_cache_brand",$arr,$where);
    }
}
function get_argmengts($mod,$argmengt){
    $keywords = $argmengt;
	$keywords_num = count($keywords);
	$keyword_string ="";
	if (in_array($mod,array("articles","topics"))) {
        foreach ($keywords as $i => $item) {
	        $keyword_string .= "title LIKE '%{$item}%'";
	        if ($i < $keywords_num - 1) {
	        	$keyword_string .= " OR ";
	        }
        }
	}
    if (in_array($mod,array("zb","dzty"))){
        foreach ($keywords as $i => $item) {
        	$keyword_string .= "subject LIKE '%{$item}%' OR message LIKE '%{$item}%'";
        	if ($i < $keywords_num - 1) {
        		$keyword_string .= " OR ";
        	}
        }
	}
    if (in_array($mod,array("photos"))){
        foreach ($keywords as $i => $item) {
			$keyword_string .= "albumname LIKE '%{$item}%'";
			if ($i < $keywords_num - 1) {
				$keyword_string .= " OR ";
			}
		}
    }
    $argmengts['keyword_string'] = $keyword_string;
    if (in_array($mod,array("blogs"))){
        $argmengts['home_id'] = $argmengt;
    }
    return $argmengts;
}
function update_cache($mod,$argments,$tid){
    $keyword_string = in_array($mod,array("articles","topics","zb","dzty","photos")) ? $argments['keyword_string'] : "";
    $home_id = in_array($mod,array("blogs")) ? $argments['home_id'] : "";
    $his_id = "";
    switch ($mod) {
    	case "articles":
    	$sql = "SELECT aid FROM ".DB::table('portal_article_title')."	WHERE ".$keyword_string." GROUP BY aid ORDER BY aid DESC";
        $his_id = 'aid';
    	break;

    	case "zb":
    	$sql = "SELECT pid FROM ".DB::table('forum_post')." WHERE (fid = 7 OR fid = 120) AND subject != '' AND (".$keyword_string.")";
        $his_id = 'pid';
    	break;

        case "dzty":
    	$sql = "SELECT pid FROM ".DB::table('forum_post')." WHERE (fid = 174 OR fid = 378) AND subject != '' AND (".$keyword_string.")";
        $his_id = 'pid';
    	break;

        case "topics":
    	$sql = "SELECT topicid FROM ".DB::table('portal_topic')." WHERE closed = 0 AND ( ".$keyword_string.") ORDER BY topicid DESC";
        $his_id = 'topicid';
    	break;

        case "photos":
    	$sql = "SELECT albumid FROM ".DB::table('home_album')." WHERE  (friend=0 and ".$keyword_string.") ORDER BY albumid DESC";
        $his_id = 'albumid';
    	break;

        case "blogs":
    	$sql = "SELECT blogid FROM ".DB::table('home_blog')." WHERE uid = $home_id ORDER BY blogid DESC";
        $his_id = 'blogid';
    	break;

    	default:
   		return false;
    	break;
    }
    $query = DB::query($sql . " " . getSlaveID());
    $forum_post_cache=array();
    while($value = DB::fetch($query)){
        $forum_post_cache[]=$value;
    }
    if(empty($forum_post_cache)){
        $arr_noresult = array('id'=>$tid,'type'=>$mod,'dateline'=>time());
        if(DB::result_first("SELECT count(*) FROM ".DB::table('plugin_cache_brand_noresult')." WHERE id = $tid and type = '".$mod."'")==0){
            DB::insert('plugin_cache_brand_noresult',$arr_noresult);
        }else{
            $arr_no_result_update = array('dateline'=>time());
            $where = array('id'=>$tid,'type'=>$mod);
            DB::update('plugin_cache_brand_noresult',$arr_no_result_update,$where);
        }
    }else{
        if(DB::result_first("SELECT count(*) FROM ".DB::table('plugin_cache_brand_noresult')." WHERE id = $tid and type = '".$mod."'")>0){
            $where = array('id'=>$tid,'type'=>$mod);
            DB::delete('plugin_cache_brand_noresult',$where);
        }
    }
    if(in_array($mod,array("zb","dzty"))){
        for($fp=0;$fp<count($forum_post_cache);$fp++){
            $forum_post = array();
            $forum_post['pid']=$forum_post_cache[$fp][$his_id];
            $forum_post['dateline']=time();
            $forum_post['tid']=$tid;
            $forum_post['type']=$mod;
            if(DB::result_first("SELECT count(*) FROM ".DB::table('plugin_cache_brand_index')." where pid=".$forum_post['pid']." and tid=".$forum_post['tid']." and type='".$forum_post['type']."'")==0){
                DB::insert('plugin_cache_brand_index',$forum_post);
            }else{
                $up_date = array('dateline'=>time());
                $where = array('pid'=>$forum_post_cache[$fp][$his_id],'type'=>$mod,'tid'=>$tid);
                DB::update('plugin_cache_brand_index',$up_date,$where);
            }
        }
    }
    if(in_array($mod,array("articles","topics","photos","blogs"))){
        for($fp=0;$fp<count($forum_post_cache);$fp++){
            $forum_post = array();
            $forum_post['id']=$tid;
            $forum_post['otherid']=$forum_post_cache[$fp][$his_id];
            $forum_post['dateline']=time();
            $forum_post['type']=$mod;
            if(DB::result_first("SELECT count(*) FROM ".DB::table('plugin_cache_brand_otherindex')." where id=".$forum_post['id']." and otherid=".$forum_post['otherid']." and type='".$forum_post['type']."'")==0){
                DB::insert('plugin_cache_brand_otherindex',$forum_post);
            }else{
                $up_date = array('dateline'=>time());
                $where = array('otherid'=>$forum_post_cache[$fp][$his_id],'type'=>$mod,'id'=>$tid);
                DB::update('plugin_cache_brand_otherindex',$up_date,$where);
            }
        }
    }
}
?>
