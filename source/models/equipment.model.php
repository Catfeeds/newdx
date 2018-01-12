<?php

/**
 * װ������ģ��
 *
 * @author lxp 20131029
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once 'dianpingmod.model.php';
Class EquipmentModel extends DianpingmodModel{
	var $table = 'dianping_equipment_info';
	var $prikey = 'id';
	var $alias = 'equ';
	var $_moduleid = 'equipment';
	var $_vars = array(
		'pk' => 'id',
		'tid' => 'tid',
		'cid' => 'cid',  // ����id
		'cname' => 'cname',  // ��������
		'pcid' => 'pcid',  // ��������id
		'pcname' => 'pcname', // ������������
		'name' => 'subject',
		'pic' => 'showimg',
		'sn' => 'model',
		'price' => 'price',  // �ο��۸�
		'tids' => 'relatedtid',  // ��ϸҳ��������id
		'bid' => 'brandid',  // Ʒ��id
		'bname' => 'brandname',  // Ʒ������
		'btid' => 'brandtid',  // Ʒ��tid
		'enable' => 'ispublish',
		'serverid' => 'serverid',
		'orderby' => 'displayorder',
		'score' => 'score',
		'num' => 'cnum',
		'kaid' => 'kaid',
		'dir' => 'dir',
		'lastrate' => 'lastrate',
		'lastscore' => 'lastscore',
		'dateline' =>'dateline',
		'lastpost' =>'lastpost',
		'dgurl' =>'dgurl',
	);

	/**
	 * ȡ������Ʒ��
	 *
	 * @author lxp 20140224
	 * @return array
	 */
	function getListBrandlist($data){
		$conditions = "";
		if($data['pcid']){
			$conditions .= "pcid={$data['pcid']} AND ";
		}
		if($data['cid']){
			$conditions .= "cid={$data['cid']} AND ";
		}

		$current_brand = $this->find(array(
			'fields' => 'brandid, brandname,COUNT(*) AS bcount',
			'conditions' => $conditions."ispublish=1 GROUP BY brandid",
			'order' => 'bcount DESC',
			'index_key' => 'brandid'
		));
		if($current_brand){
			$mod_brand = m('brand');
			$bids = implode(',', array_keys($current_brand));
			$b_info = $mod_brand->find(array(
					'fields' => 'id,subject AS brandname,tid as brandtid,letter',
					'conditions' => "id IN ($bids)"
			));
			foreach ($current_brand as $bid => $brand){
				if($bid > 0){
					$current_brand[$bid] = array_merge($brand, $b_info[$bid]);
				}
			}
		}
		return $current_brand;
	}
	/**
	 * @see dianpingmod.model.php
	 * ���ظ����е���⺯������������ݽ��д���;
	 */
	function postdataHandle($postdata){
		//���ӶԷ�����޸�
		if ( isset( $postdata['headimgselect'] ) && ! empty( $postdata['headimgselect'] ) ) {
			$nowdata = $this->get( array('conditions' => "{$this->_vars[tid]} = {$postdata[tid]}") );
			if( $nowdata['kaid'] != $postdata['headimgselect'] ){
				require_once libfile( 'function/forum' );
				$_del = array();
				if ( $nowdata['kaid'] > 0 ) {
					$attach = DB::fetch_first( "SELECT aid, attachment, thumb, remote, serverid, dir FROM ".DB::table('forum_attachment')." WHERE aid = {$nowdata[kaid]}" );
					dunlink( $attach, $attach['dir'] );
					$_del[] = $attach['aid'];
				}
				$postdata['kaid'] = $postdata['headimgselect'];
				$_tmp = DB::fetch_first( "SELECT attachment, dir, serverid FROM " . DB::table('forum_attachment') . " WHERE aid = '{$postdata[kaid]}'" );
				$postdata['pic'] = $_tmp['attachment'];
				$postdata['dir'] = $_tmp['dir'];
				$postdata['serverid'] = $_tmp['serverid'];
				DB::update('forum_attachment', array('tid' => $postdata['tid'], 'pid' => $postdata['pid']), array('aid' => $postdata['kaid']));
				if ( ! empty( $postdata['headdelete'] ) && is_array( $postdata['headdelete'] ) ) {
					$_q = DB::query( "SELECT aid, attachment, thumb, remote, serverid, dir FROM " . DB::table( 'forum_attachment' ) . " WHERE aid IN(" . dimplode( $postdata['headdelete'] ) . ")" );
					while( $_v = DB::fetch( $_q ) ) {
						dunlink($_v, $_v['dir']);
						$_del[] = $_v['aid'];
					}
				}
				DB::delete('forum_attachment', "aid IN(" . dimplode($_del) . ")");
			}else{
				$postdata['pic'] = $nowdata['showimg'];
				$postdata['serverid'] = $nowdata['serverid'];
			}
		}
                foreach($this->_vars as $_k => $_v){
                    isset($postdata[$_k]) && $return[$_v] = $postdata[$_k];

            }

        return $return;
	}
	/**
	 * ���ط��ط���Ŀ¼
	 * @see dianpingmod.model.php
	 */
	function _getFMDir($data){
		if ( ! empty( $data['dir'] ) ) {
			return $data['dir'] . '/';
		}
		return 'plugin/';
	}


	function getTidsbyNopic(){
		$arr = array();
		$arr = $this->findAll(array(
			'fields' => 'tid,showimg,dir',
			'order' => 'tid DESC',
			'index_key' => 'tid'
			));
		if($arr){
			$doman = "http://image.8264.com/";
			$num = 0;
			foreach ($arr as $bid => $equ){
				if(!file_exists($doman.$equ['dir']."/".$equ['showimg'])){
					echo $equ['tid']."<br>";
					$num++;
				}
			}
			echo "����".$num."��װ��û��ԭͼ";exit;
		}
	}
}

?>
