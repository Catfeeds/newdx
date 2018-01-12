<?php

/**
 * Created by PhpStorm.
 * User: lgt
 * Date: 14-10-23
 * Time: ����9:52
 */
class attach
{
    public $attachlist;
    private $attachserver;

    function  __construct()
    {
        require_once DISCUZ_ROOT . './source/plugin/attachment_server/attachment_server.class.php';
        $this->attachserver = new attachserver;
        $this->attachlist = $this->attachserver->get_server_domain('all', '*');
    }

    /*
     * ��������ҳͷͼlogoͼ��ȡ
     * */
    function get_img($tid, $pid, $type = 'forum',$limit= 5)
    {
        if ($tid > 0) {
            $pids = $pid > 0 ? "AND pid = {$pid}" : '';
            $q = DB::query("SELECT aid, tid, pid, width, attachment, serverid, dir, filename FROM " . DB::table('forum_attachment') . " WHERE isimage = 1 AND tid = {$tid} {$pids} AND dir = '{$type}' ORDER BY dateline asc limit ". $limit .' '. getSlaveID());
            while ($v = DB::fetch($q)) {
                $v['url'] = 'http://' . $this->attachlist[$v['serverid']]['name'] . '/' . $type . '/';
                if (is_array($this->attachlist[$v['serverid']]['api'])) {
                    if ($this->attachlist[$v['serverid']]['api']['class'] && is_object($this->attachlist[$v['serverid']]['api']['class'])) {
                        $_callback = array($this->attachlist[$v['serverid']]['api']['class'], $this->attachlist[$v['serverid']]['api']['function']);
                    } else {
                        $_callback = $this->attachlist[$v['serverid']]['api']['function'];
                    }
                    $v['attachment'] .= call_user_func_array($_callback, array('forum', true, true, true));
                }
                $return[] = $v;
            }
        }
        return $return ? $return : array();
    }

    /*
     * ����ҳ��ʾͼƬ-��message�ĸ���ͼƬ��Ϣ��������ƥ��
     * */
    function handle_img($message)
    {
        global $_G;
        if (preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $message, $matches)) {
            $aids = $matches[1];
            foreach ($aids as $aid) {
                $attachment = DB::fetch_first("SELECT attachment,isimage,remote,width,serverid FROM " . DB::table('forum_attachment') . " WHERE aid='$aid' ".getSlaveID());
                if($attachment){
                    if ($attachment['isimage']) {
                        if ($attachment['serverid'] > 0) {
                            $path = "http://" . $this->attachlist[$attachment['serverid']]['name'] . "/forum/" . $attachment['attachment'];
                            $path .= $this->attachserver->getPreStr($this->attachlist[$attachment['serverid']], 'forum', true, true);
                        } elseif ($attachment['remote']) {
                            $path = $_G['setting']['ftp']['attachurl'] . 'forum/' . $attachment['attachment'];
                        } else {
                            $path = $_G['setting']['attachurl'] . 'forum/' . $attachment['attachment'];
                        }
                    }
                    if ($attachment['width'] > 610) {
                        $message = preg_replace("/\[attach\]" . $aid . "\[\/attach\]/i", '<img src="' . $path . '" alt="" width="610px;" />', $message);
                    } else {
                        $message = preg_replace("/\[attach\]" . $aid . "\[\/attach\]/i", '<img src="' . $path . '" alt="" />', $message);
                    }
                }
                
            }
            //������¼�����ڣ�����ʧ�ܵ�ȥ�����
            $message = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $message);
        }
        return $message;
    }

    /*
     * ����ϵͳ�����ͱ༭����-�Ա༭����message��ͼƬ�������ǰ����
     *
     * */
    static function parse_attach($data)
    {
        global $_G;
        $temp =  array();
        $new_img_edit = $_G['gp_attachnew'];
        if (preg_match('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $data)) {
            preg_match_all('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $data, $matches);
            $send_img = $matches[2];
            foreach ($new_img_edit as $key => $descon) {
                if (!in_array($key, $send_img)) {
                    unset($new_img_edit[$key]);
                }
            }
        } else {
            unset($new_img_edit);
        }
        $temp['new_img_edit'] = $new_img_edit;
        $temp['message'] = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $data);
        return $temp;
    }
     //��ʱע���η����������ڱ༭ҳ��ʱ���ڱ༭���Ҳ��б���ʾ���ϴ�����ͼƬ��
     /*function  getattach($pid, $posttime = 0, $showdir = 'forum', $limit = 100,$tid) {
        global $_G;

        require_once libfile('function/attachment');
        $attachs = $imgattachs = array();
        $sqladd1 = $posttime > 0 ? "AND a.dateline>'$posttime'" : '';
        if($showdir != 'all'){
            $sqladd1 .= " AND a.dir = '{$showdir}'";
        }
        $sqladd2 = $pid > 0 ? "OR a.pid='$pid'" : '';
        $tid = $tid > 0 ? "AND a.tid = '$tid'" : '';
        $query = DB::query("SELECT a.*, af.description
		FROM ".DB::table('forum_attachment')." a
		LEFT JOIN ".DB::table('forum_attachmentfield')." af USING(aid)
		WHERE (a.uid='$_G[uid]' $tid $sqladd1) $sqladd2 ORDER BY a.aid ASC LIMIT {$limit}");
        if(!empty($_G['fid']) && $_G['forum']['attachextensions']) {
            $allowext = str_replace(' ', '', $_G['forum']['attachextensions']);
            $allowext = explode(',', $allowext);
        } else {
            $allowext = '';
        }
        //���Ӷ�ȡ���Ӹ���ʱ�Ը������������ж�
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachment = new attachserver;
        $domain_all = $attachment->get_server_domain('all');

        while($attach = DB::fetch($query)) {
            if($attach['dir'] != $showdir && $showdir != 'all'){
                continue;
            }
            $attach['filenametitle'] = $attach['filename'];
            $attach['ext'] = fileext($attach['filename']);
            if($allowext && !in_array($attach['ext'], $allowext)) {
                continue;
            }
            $attach['filename'] = cutstr($attach['filename'], $_G['setting']['allowattachurl'] ? 25 : 30);
            $attach['attachsize'] = sizecount($attach['filesize']);
            $attach['dateline'] = dgmdate($attach['dateline']);
            $attach['filetype'] = attachtype($attach['ext']."\t".$attach['filetype']);
            if($attach['isimage'] < 1) {
                if($attach['isimage']) {
                    $attach['url'] = $attach['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl'];
                    $attach['width'] = $attach['width'] > 300 ? 300 : $attach['width'];
                }
                if($attach['pid']) {
                    $attachs['used'][] = $attach;
                } else {
                    $attachs['unused'][] = $attach;
                }
            } else {
                $attach['url'] = ($attach['remote'] ? $_G['setting']['ftp']['attachurl'] : ( $attach['serverid'] > 0 ? "http://".$domain_all[$attach['serverid']]."/" : $_G['setting']['attachurl'])).'/forum';
                $attach['width'] = $attach['width'] > 300 ? 300 : $attach['width'];
                if($attach['pid']) {
                    $imgattachs['used'][] = $attach;
                } else {
                    $imgattachs['unused'][] = $attach;
                }
            }
        }
        return array('attachs' => $attachs, 'imgattachs' => $imgattachs);
    }*/

    /*
     * �༭ҳ�潫���ϴ�����ͼƬչʾ����
     * */
      static function show_edit_img($pid,$tid,$mess){
          global $_G;
          if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
              $data['attachlist'] = self::getattach($pid, 0, 'forum',100,$tid);
              $data['imgattachs'] = $data['attachlist']['imgattachs'];
              unset($data['attachlist']);
              $imgused = $data['imgattachs']['used'];

              if(!empty($imgused)) {
                  foreach($imgused as $attach) {
                      $attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
                      $attachreplace[] = '[attachimg]'.$attach['aid'].'[/attachimg]';

                  }
              }
              $attachfind && $data['editdata']['message'] = preg_replace($attachfind, $attachreplace, $mess);
              return $data['editdata']['message'];

          }
      }

      /*��·Gps��ȡ
       * */
    function getGps($tid){
        $query =  DB::query("select * from ".DB::table('dianping_line_gpsattachment')." where tid = ".$tid);
        while($v = DB::fetch($query)){
            $gpsshow[] = $v;
        }
        return $gpsshow;
    }

    //��������ʱ���ͼƬ�ϴ�
    function  handle_comment_pic($imgselect, $tid, $pid, $uid ,$description = ''){
        if($tid > 0 && $pid > 0 && $uid > 0){
            $update = array(
                'readperm' => 0,
                'price' => 0,
                'tid' => $tid,
                'pid' => $pid,
                'uid' => $uid);

            foreach($imgselect as $_k => $_v){
                if(intval($_v) > 0){
                    DB::query("REPLACE INTO " . DB::table('forum_attachmentfield')." (aid, tid, pid, uid, description) VALUES ('{$_v}', '$tid', '$pid', '$uid', '$description')");
                }
            }
            /*�����ǰ���ӻظ�����ͼƬ�������ȡ��������ͼƬ�İ�*/
            DB::update('forum_attachment', array('tid' => 0, 'pid' => 0), array('tid' => $tid, 'pid' => $pid, 'dir' => 'plugin'));
            /*����ѡ���ͼƬ����������۰�*/
            DB::update('forum_attachment', $update, "aid IN(".dimplode($imgselect).")");
        }

    }


}
