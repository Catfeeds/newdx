<?php
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

require_once 'dianpingmod.model.php';
class  ClimbModel extends DianpingmodModel {
	var $table = 'dianping_climb_info';
	//var $prikey = 'id';
	var $alias = 'climb';
	var $_moduleid = 'climb';

/*	var $_vars = array(
		'pk' 		=> 'id',
		'tid' 		=> 'tid',
		'name' 		=> 'cName',
		'pic' 		=> 'cPic',
		'type' 	=> 'type',
		'pType' => 'cPtype',
        'cLink'=>'cLink',
		'enable' 	=> 'isPublish',
		'pro' => 'cProvince',
		'city' => 'cCityId',
		'address' => 'cAddress',
		'longitude' => 'longitude',		
		'latitude' => 'latitude',
		'posttime' => 'posttime',
		'score'    	=> 'score',
		'num'		=> 'cnum',
		'lastrate'	=> 'lastrate',
		'lastscore' => 'lastscore',
		'lastpost' => 'lastpost'
		
	);*/
    var $_vars = array(
        'pk' 		=> 'id',
        'tid' 		=> 'tid',
        'name' 		=> 'subject',
        'pic' 		=> 'showimg',
        'type' 	=> 'type',
        'placetype' => 'placetype',
        'tel'=>'tel',
        'enable' 	=> 'ispublish',
        'pro' => 'provinceid',
        'city' => 'cityid',
        'address' => 'addr',
        'longitude' => 'lon',
        'latitude' => 'lat',
        'posttime' => 'dateline',
        'score'    	=> 'score',
        'num'		=> 'cnum',
        'lastrate'	=> 'lastrate',
        'lastscore' => 'lastscore',
        'lastpost' => 'lastpost',
        'serverid' => 'serverid'

    );
	/**
	 * ��ȡ������
	 * @access public
	 * @param int $tid
	 * @return Array
	 */
	public function getData($where, $fields='*',$order="id asc"){
		$arrParam = array();
		if ($where) {
			$arrParam['conditions'] = $where;
		}
		$arrParam['order'] = $order;
		$arrParam['fields'] = $fields;
		return $this->find($arrParam, false);
	}

	//�����ͱ༭��ʱ�򹫹�����
	function initPost(&$data, $submit=false) {
		global $_G;
		$data['pro'] = $data['pro'] ? $data['pro'] : $data['provinceid'];
		if($submit) {
			//����������������, ���û������ƻ�js��ǰ̨��֤, �轫������ɾ��, �û�����ͨ�����Թ���,�޸�Ĭ���ṩ��ֵ,�˴���Ҫ������֤
			$typelist = (array)$this->_getTypeClass();
			//�ô���pre_pluugin_dianping_modules���й�,���ܸı�typeclassid�е�˳��
			$typecount = count($typelist);
			$climbTypeList = $typecount >= 1 ? current($typelist) : array();
			$placeTypelist = $typecount >= 2 ? next($typelist) : array();

			//validate subject
			if(! $data['subject'] || strlen($data['subject']) > 80) {
				return 'post_params_exist_error';
			}

			//validate climb type
			if(! $data['type']) {
				return 'post_params_exist_error';
			}

			//validate climb place
			if($data['placetype'] && ! $placeTypelist[$data['placetype']]) {
				return 'post_params_exist_error';
			}

			//validate climb address
			if(! $data['provinceid'] || ! $data['address'] || ! $data['longitude'] || ! $data['latitude']) {
				return 'post_params_exist_error';
			}

			$mdregions = m('regions');
			if($data['city'] == $data['provinceid']) {
				$c_province = $mdregions->find(array('fields' => 'codeid',
						'conditions' => "codeid='{$data[city]}' AND shengid=0",
						'limit' => 1

				));
			}
			else {
				$c_province = $mdregions->find(array('fields' => 'codeid',
						'conditions' => "codeid='{$data[city]}' AND shengid='{$data[provinceid]}'",
						'limit' => 1

				));
			}
			
			if(! $c_province) {
				return 'post_params_exist_error';
			}

			//��֤�Ƿ����Ҫpicģ��
			if (empty($data['imgselect']) && $this->getChildStatus('pic')){
				return 'model_need_pic';
			}
			$new_img_edit = $_G['gp_attachnew'];
			if(preg_match('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $data['message'])){
				preg_match_all('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $data['message'], $matches);
				$send_img=$matches[2];
				foreach($new_img_edit as $key=>$descon){
					if(!in_array($key, $send_img)){
						unset($new_img_edit[$key]);
					}
				}
			}else{
				unset($new_img_edit);
			}
			$data['new_img_edit'] = $new_img_edit;
			$data['message'] = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $data['message']);
			$data['message'] = trim($data['message']);

		}
		else {
			$data['shorttitle'] = '';
			
			$typelist = (array)$this->_getTypeClass();
			//�ô���pre_pluugin_dianping_modules���й�,���ܸı�typeclassid�е�˳��
			$typecount = count($typelist);
			$data['climbTypeList'] = $typecount >= 1 ? current($typelist) : array();
			$data['placeTypelist'] = $typecount >= 2 ? next($typelist) : array();
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->_moduleid}";

			// ��ʼ���༭���������
			$data['editorid'] = 'e';
			$_G['setting']['editoroptions'] = str_pad(decbin($_G['setting']['editoroptions']), 2, 0, STR_PAD_LEFT);
			$data['editor'] = array(
					'editormode' => $_G['setting']['editoroptions']{0},
					'allowswitcheditor' => $_G['setting']['editoroptions']{1},
					'allowhtml' => 1,
					'allowsmilies' => 0,
					'allowbbcode' => 1,
					'allowimgcode' => 1,
					'allowresize' => 1,
					'textarea' => 'message',
					'simplemode' => !isset($_G['cookie']['editormode_'.$data['editorid']]) ? 1 : $_G['cookie']['editormode_'.$data['editorid']],
			);

			$mdregions = m('regions');
			$data['provinces'] = $mdregions->getAllProvinces('codeid,cityname');

			require_once libfile('function/post');	
			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				$data['attachlist'] = getattach($pid, 0, 'all');
				$data['attachs'] = $data['attachlist']['attachs'];
				$data['imgattachs'] = $data['attachlist']['imgattachs'];				
				unset($data['attachlist']);
				$attachfind = $attachreplace = array();
				if(!empty($data['attachs']['used'])) {
					foreach($data['attachs']['used'] as $attach) {
						if($attach['isimage']) {
							$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
							$attachreplace[] = '[attachimg]'.$attach['aid'].'[/attachimg]';
						}
					}
				}
				if(!empty($data['imgattachs']['used'])) {
					foreach($data['imgattachs']['used'] as $attach) {
						$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
						$attachreplace[] = '[attachimg]'.$attach['aid'].'[/attachimg]';
					}
				}
				$attachfind && $data['editdata']['message'] = preg_replace($attachfind, $attachreplace, $data['editdata']['message']);
			}
			$data['imgattachs']['unused'] = !$sortid ? $data['imgattachs']['unused'] : '';

			//����������
			if($_G['uid']) {
				$albumlist = array();
				$query = DB::query("SELECT albumid, albumname, picnum FROM ".DB::table('home_album')." WHERE uid='$_G[uid]' ORDER BY updatetime DESC");
				while($value = DB::fetch($query)) {
					if($value['picnum']) {
						$albumlist[] = $value;
					}
				}
				$data['albumlist'] = $albumlist;
			}
		}

	}

	//ʹ�ñ༭���ύ��, html��ǩ�����˱仯, �账��༭��������. �÷����Ǽ򻯺�ķ���,��ִ���˺ܶ����, ��ʱû�з���bug.
	function bbcode2htmlcode($message) {
		require_once libfile('function/newdiscuzcode');
		return discuzcode($message);
	}
}
