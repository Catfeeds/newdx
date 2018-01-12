<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: misc_invite.php 15922 2010-08-30 04:02:10Z liulanbo $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
//论坛首页帖子精选加载更多的调取
if($_G['gp_action'] == 'tiezigengduo') {
	$page = $_POST['page'];
        $limit = $_POST['limit'];        
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        $array_gengduo = array();
        $query = DB::query("SELECT aid,title,uid,username,url,pic,remote,id,idtype,serverid,author,summary FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>'' and id <>'' ORDER BY aid DESC LIMIT $page,$limit");

        require_once DISCUZ_ROOT.'./source/function/function_post.php';
        require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";
        while ($value = DB::fetch($query)) {
        $value['titles'] = trim(substr($value['title'],0,strripos($value['title'],' ')));

        if($value['idtype']=='tid'&& $value['id']!=0){
        $comment = DB::fetch_first("SELECT subject,replies,views,authorid,author FROM ".DB::table('forum_thread')." WHERE tid='$value[id]' LIMIT 0,1");
        $value['commentnum'] = $comment['replies'];
        $value['subject'] = $comment['subject'];
        
        $list_zuozhe = array();
        $zuozhe_tx = avatar($comment['authorid'], 'small');
        $list_zuozhe[]=array("uid"=>$comment['authorid'],"uname"=>$comment['author'],"tx"=>$zuozhe_tx);
        
        $post_content = DB::fetch_first("SELECT message FROM ".DB::table('forum_post')." WHERE tid='$value[id]' and first=1");
        $value['viewnum'] = $comment['views'];
        $str = "SELECT * FROM ".DB::table('forum_post')." WHERE tid='$value[id]' and authorid<>'$comment[authorid]' and first<>'1' and invisible=0 order by dateline desc LIMIT 0,1";
        $querys = DB::query($str);
        $list = array();
        while ($values = DB::fetch($querys)) {
                $values['avatar'] = avatar($values['authorid'], 'small');
                $values['zuozhe_avatar'] = avatar($comment['authorid'], 'small');
                $values['authorid'] = $_G['config']['web']['home']."home.php?mod=space&uid=".$values['authorid'];
                $values['content'] = preg_replace('/\[quote.*?\](.*)\[\/quote\]/', '', $post_content['message']);
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
                $values['content'] =  messagecutstr($values['content'],100);
                $values['lastpost'] = dgmdate($values['dateline'], 'u');
                $list[]=array("uid"=>$values['authorid'],"uname"=>$values['author'],"tx"=>$values['avatar'],"nr"=>trim($values['content']),"lastpost"=>$values['lastpost']);
                $value['arr'] = $list;
                
        }
            }else{
                    $comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");
                    $value['commentnum'] = $comment['commentnum'];
                    $value['viewnum'] = $comment['viewnum'];
            }
            $value['arr'] = $value['arr'];
            $value['arr_zuozhe'] = $list_zuozhe;
            $value['pic'] = ($value['remote'] == 1 ? $_G['setting']['ftp']['attachurl']."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
            $array_gengduo[] = $value;
        }
        include template("forum/bbs_new_tiezijingxuan_more");
}
?>
