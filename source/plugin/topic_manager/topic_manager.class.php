<?php

/**
 * @author jianghong
 * @copyright jianghong
 * ���ڹ���ר�����̳���ӵĹ���
 */
class topic_manager{
    /**
     * @author jianghong
     * @version 2012.8.7
     * @todo ���ڶ�ȡ��ǰר��Ĺ���tid
     * @param $topicid ר��id
     * @return tid ����id
     */
    function get_tid_with_topicid($topicid){
        if(!is_numeric($topicid)){
            return false;
        }
        return DB::result_first("SELECT tid FROM ".DB::table('portal_topic')." WHERE topicid=$topicid and closed=0");
    }
    /**
     * @author jianghong
     * @version 2012.8.7
     * @todo ���ڶ�ȡ��ǰ���ӵĹ���topicid
     * @param tid ����id
     * @return topicid ר��id
     */
    function get_topicid_with_tid($tid){
        if(!is_numeric($tid)){
            return false;
        }
        return DB::result_first("SELECT topicid FROM ".DB::table('portal_topic')." WHERE tid=$tid and closed=0");
    }
    /**
     * @author jianghong
     * @version 2012.8.7
     * @todo ���ڶ�ȡ��ǰ���ӵ�����N������
     * @param $argments['tid'] ���ӵ�ID
     * @param $argments['num'] ��ѯ��������Ϣ����
     * @return array������Ϣ������
     */
    function get_comment_with_tid($argments){
        if(!is_array($argments)){
            return false;
        }
        $return=array();
        $sql="SELECT * FROM ".DB::table('forum_post')." WHERE tid=".$argments['tid']." and first=0 and invisible=0 order by dateline DESC limit ".$argments['num'];
        $query=DB::query($sql);
        while($values=DB::fetch($query)){
            $values['avatar'] = avatar($values['authorid'], 'small');
            $values['message']=preg_replace("/\[size=\d+\]/i","",$values['message']);
            $values['message']=preg_replace("/\[\/size\]/i","",$values['message']);
            $values['message']=preg_replace("/\[img\].*\[\/img\]/i","",$values['message']);
            $values['message']=preg_replace("/\[color=#\d+\].*\[\/color\]/i","",$values['message']);
            $values['message']=preg_replace("/\[url=([a-z0-9=?&\.]*)\]\[\/url\]/i","",$values['message']);
            $values['yw_message']=$values['message'];
            $values['yw_message']=preg_replace("/\[quote\].*\[\/quote\]/","",$values['yw_message']);
            //$values['yw_message']=preg_replace("/\[quote\].*\[\/quote\]/","",$values['yw_message']);
            //$values['yw_message']=preg_replace("/\[quote\]/","",$values['yw_message']);
            //$values['yw_message']=preg_replace("/\[\/quote\]/","",$values['yw_message']);
            if(preg_match("/\[quote\]/i",$values['message'])){
                $values['message']=preg_replace("/\[quote\]/i","<div class='quote'><blockquote>",$values['message']);
                $values['message']=preg_replace("/\[\/quote\]/i","</blockquote></div><span>",$values['message']);
            }else{
                $values['message']="<span>".$values['message'];
            }
            $values['message'].="</span>";
            $return[]=$values;
        }
        return $return;
    }
    /**
     * @author jianghong
     * @version 2012.8.7
     * @todo ��������ר���������
     * @param $argments['tid'] ����id
     * @param $argments['topicid'] ר��id
     * @return num ������Ч�ظ���
     */
    function get_reply_with_tid($argments){
        if(!is_array($argments)){
            return false;
        }
        $num=DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid=".$argments['tid']." and first=0 and invisible=0");
        return $num;
    }
    /**
     * @author jianghong
     * @version 2012.8.8
     * @todo ���ڹ������Ӻ�ר��
     * @param $argments['tid'] ����id
     * @param $argments['topicid'] ר��id
     * @param $argments['inajax'] �Ƿ�Ϊajax�����Ƿ���ʾ���
     * @return boolean 
     */
    function set_topic_tid($argments){
        if(!is_array($argments)){
            return false;
        }
        if($argments['tid']!=0){
            if(DB::result_first("SELECT count(*) FROM ".DB::table('forum_thread')." WHERE tid=".$argments['tid']." and displayorder>=0")==0){
                if($argments['inajax']){
                    echo "���Ӳ�����";
                }
                return false;
            }
            $title=DB::result_first("SELECT title FROM ".DB::table('portal_topic')." WHERE tid=".$argments['tid']);
            if(!empty($title)){
                if($argments['inajax']){
                    echo "�����Ѿ�������ר��[$title]��";
                }
                return false;
            }
        }
        $where=array('topicid'=>$argments['topicid']);
        $updates=array('tid'=>$argments['tid']);
        DB::update('portal_topic',$updates,$where);
        if($argments['inajax']){
            echo "�ɹ�";
        }
        return true;
    }
}
$topic_manager=new topic_manager;
?>