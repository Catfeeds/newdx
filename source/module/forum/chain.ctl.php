<?php
/**
 * @author Apple
 * @copyright 2016.8
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ChainCtl extends DianpingCtl{
	var $modname = 'chain';

	/**
	 * 显示发布页--参考forum.base.php相应方法
	 */

	function _newpost($data) {

		global $_G;
		if (! $_G['uid'] && ! ((! $_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])))) {
			$this->showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
		} elseif (empty($_G['forum']['allowpost'])) {
			if (! $_G['forum']['postperm'] && ! $_G['group']['allowpost']) {
				$this->showmessage('postperm_none_nopermission_dianping', null, array(), array('login' => 1));
			} elseif ($_G['forum']['postperm'] && ! forumperm($_G['forum']['postperm'])) {
				showmessagenoperm('postperm', $this->mod->_fid, $_G['forum']['formulaperm']);
			}
		} elseif ($_G['forum']['allowpost'] == -1) {
			$this->showmessage('post_forum_newthread_nopermission');
		}
		if (! $_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
			$this->showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
		}

		//用来检查积分限制的
		checklowerlimit('post', 0, 1, $this->mod->_fid);
		$_G['fid'] =  $this->mod->_fid;

		if (! submitcheck('newpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			//表单
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] = 'new';

			require_once DISCUZ_ROOT.'./config/config_dianping.php';
			$category = $dp_category['chain']['category'];

			$data['category'] = $category ? $category : array();

			/// 初始化编辑器相关设置
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

			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				require_once libfile('function/post');
				$data['attachlist'] = getattach(0);
				$data['attachs']  	= $data['attachlist']['attachs'];
				$data['imgattachs'] = $data['attachlist']['imgattachs'];
				unset($data['attaclist']);

				//个人相册加载
				$albumlist = array();
				if($_G['uid']) {
					$query = DB::query("SELECT albumid, albumname, picnum FROM ".DB::table('home_album')." WHERE uid='$_G[uid]' ORDER BY updatetime DESC");
					while($value = DB::fetch($query)) {
						if($value['picnum']) {
							$albumlist[] = $value;
						}
					}
				}
				$data['albumlist'] = $albumlist;
			}

			require_once libfile('dianping/zone','class');
			$foreigndb = new zone();
			//  国内省及市信息读取
			$data['provinces'] = $foreigndb->get_region();

			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			//提交
			$postdata  = array_merge($_GET, $_POST);

			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic')){
				$this->showmessage('model_need_pic');
			}

			//处理编辑器图片
			$new_img_edit = $_G['gp_attachnew'];
			if(preg_match('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $postdata['message'])){
				preg_match_all('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $postdata['message'], $matches);
				$send_img=$matches[2];
				foreach($new_img_edit as $key=>$descon){
					if(!in_array($key, $send_img)){
						unset($new_img_edit[$key]);
					}
				}
			}else{
				unset($new_img_edit);
			}
			$postdata['new_img_edit'] = $new_img_edit;
			$postdata['message'] = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $postdata['message']);
			$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
			$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));

			$this->mod->dopost($postdata);
		}
	}

	//编辑点评帖内容页
	function _editpost($data) {

		global $_G;
		$tid = intval($_G['gp_tid']);
		$pid = intval($_G['gp_pid']);
		if ($pid <= 0 || $tid <= 0)
			$this->showmessage('nopidandtid');
		if (! submitcheck('editpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$this->mod->initPost($data);

			$data['action'] = 'edit';
			$data['editdata'] = $this->mod->getview($tid);

			$pro_id = $data['editdata'][$this->mod->_vars['province']];

			require_once DISCUZ_ROOT.'./config/config_dianping.php';
			$category = $dp_category['chain']['category'];
			$data['category']	= $category ? $category : array();

			$mdRegion = m('regions');
			$data['cities'] = $mdRegion->getCitiesByProvince($pro_id);
			require_once libfile('dianping/zone','class');
			$foreigndb = new zone();
			$data['provinces'] = $foreigndb->get_region();
			$data['editdata']['addr']=$data['provinces'][$pro_id] ?  str_replace($data['provinces'][$pro_id]['cityname'],'', $data['editdata']['addr']) : $data['editdata']['addr'];
			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$postdata = array_merge($_GET, $_POST);

			$message = $this->mod->initPost($postdata, true);

			if($message) {
				$this->showmessage($message, '', array(), array());
			}
			$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
			$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
			$this->mod->dopost($postdata);
		}
	}


}



?>
