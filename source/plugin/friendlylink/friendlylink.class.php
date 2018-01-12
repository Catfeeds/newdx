<?php

/**
 * @author gtl
 * �°���������
 * @filesource friendlylink.class.php
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/config.inc.php';

class plugin_friendlylink {

	function __construct() {
		
	}

	/**
	 * @version 1.0 ֻ���б�ҳ��ʾ
	 * @global array $_G
	 * @return string
	 */
	function global_friendlylink() {
		global $_G;
		global $_ENV;

		//�����ݿ� �ؼ���=>���� ����
		$default_key = 'plugin_friendlylink_default_config';
		$default = memory('get', $default_key);
		if (!is_array($default)) {
			$sql = "SELECT * FROM " . DB::table('common_friendlink2_inlink');
			$query = DB::query($sql);
			while ($values = DB::fetch($query)) {
				if(!$values['group']){
					$default[$values['id']]['keyword'] = $values['keyword'];
					continue ;
				}
				$default[$values['group']]['child'][$values['id']]['keyword'] = $values['keyword'];
				$default[$values['group']]['child'][$values['id']]['identifie'] = $values['identifie'];
			}
		
			if (!$default) {
				$default = array();
			}
			memory('set', $default_key, $default, 86400);
		}

		/**
		 * �ҳ��б�ҳ���
		 * @todo �Ѿ��ҳ��˱��,�����ٿ������Ƿ��Ͻ�
		 */
		if (CURSCRIPT == 'portal' && in_array(CURMODULE, array('index', 'list'))) { // ��Ѷ���Ż����б� pre_portal_category
			$typestr = P_FRIENDLYLINK_PORTAL . '|' . (int) $_G['gp_catid'];
			$outlinkname = $default[P_FRIENDLYLINK_PORTAL]['keyword'];
			$outlink = "http://www.8264.com";
			if($_G['gp_catid']){
				$outlink = "http://www.8264.com/list/".(int) $_G['gp_catid']."/";
			}
			//�Ƿ���Ĭ������
			foreach($default[P_FRIENDLYLINK_PORTAL]['child'] as $item){
				if($item['identifie'] == $typestr){
					$outlinkname = $item['keyword'];
					continue;
				}
			}
		} elseif (CURSCRIPT == 'forum' && in_array(CURMODULE, array('index', 'forumdisplay'))) { //��̳ pre_forum_forum
			$typestr = P_FRIENDLYLINK_FORUM . '|' . (int) $_G['gp_fid'] . '|' . (int) $_G['gp_typeid'];
			$outlinkname = $default[P_FRIENDLYLINK_FORUM]['keyword'];
			$outlink = "http://bbs.8264.com";
			if(CURMODULE == 'forumdisplay'){
				$outlink = "http://bbs.8264.com/forum-".(int) $_G['gp_fid']."-1.html";
				//�����������в�ѯ��Ӧ�Ķ�������
				if(is_array($_ENV['domain']['list'])){
					foreach($_ENV['domain']['list'] as $domain=>$finfo){
						if($finfo['id'] == $_G['gp_fid'] && $finfo['typeid'] == 0 ){
							$outlink = "http://".$domain;
						}
					}
				}
			}
			if($_G['gp_typeid']){
				$outlink = "http://bbs.8264.com/forum-forumdisplay-fid-{$_G['gp_fid']}-typeid-{$_G['gp_typeid']}-filter-typeid.html";
			}
			//�Ƿ���Ĭ������
			foreach($default[P_FRIENDLYLINK_FORUM]['child'] as $item){
				if($item['identifie'] == $typestr){
					$outlinkname = $item['keyword'];
					continue;
				}
			}
		} elseif (CURSCRIPT == 'dianping' && array_key_exists(CURMODULE, $_G['config']['fids'])) { //����ϵͳ��ĳҳ
			if ($_G['fid'] && $_G['gp_act'] == 'showlist') {
				$typestr = P_FRIENDLYLINK_DIANPING . '|' . $_G['fid'];
				$outlinkname = $default[P_FRIENDLYLINK_DIANPING]['keyword'];
				switch ($_G['fid']) {
					case 408: //����Ʒ��
						$outlink = 'http://www.8264.com/pinpai';
						if($_G['gp_nat']){
							$typestr.='|nat:'.$_G['gp_nat'];
							$outlink = 'http://www.8264.com/pinpai-'.$_G['gp_nat'].'-0-0-4-1';
						}
						break;
						
					case 490: //������Ʒ��
						$outlink = 'http://www.8264.com/zhuangbei.html';
						if($_G['gp_pcid']){
							$typestr.='|pcid:'.$_G['gp_pcid'];
							$outlink = 'http://www.8264.com/zhuangbei-'.$_G['gp_pcid'].'-0-0-5-1.html';
						}
						break;
						
					case 471: //�����
						$outlink = 'http://www.8264.com/dianpu';
						if($_G['gp_pid']){
							$typestr.='|pid:'.$_G['gp_pid'];
							$outlink = 'http://www.8264.com/dianpu-'.$_G['gp_pid'].'-0-0-0-0-4-1';
						}
						break;
						
					case 497: //��������
						$outlink = 'http://www.8264.com/panpa';
						if($_G['gp_type']){
							$typestr.='|type:'.$_G['gp_type'];
							$outlink = 'http://www.8264.com/panpa/list-'.$_G['gp_type'].'-0-0-0-1-1.html';
						}
						break;
						
					case 477: //��ѩ��
						$outlink = 'http://www.8264.com/xuechang';
						if($_G['gp_pro']){
							$typestr.='|pro:'.$_G['gp_pro'];
							$outlink = 'http://www.8264.com/xuechang-'.$_G['gp_pro'].'-5-1';
						}
						break;
						
					case 498: //Ǳˮ��
						$outlink = 'http://www.8264.com/qianshui/';
						if($_G['gp_type']){
							$typestr.='|type:'.$_G['gp_type'];
							$outlink = 'http://www.8264.com/qianshui/list-'.$_G['gp_type'].'-0-0-1-1.html';
						}
						break;
						
					case 392: //ɽ��
						$outlink = 'http://www.8264.com/shanfeng';
						if($_G['gp_dq']){
							$typestr.='|dq:'.$_G['gp_dq'];
							$outlink = 'http://www.8264.com/shanfeng-4-dq-'.$_G['gp_dq'].'-gd-0-page-1';
						}
						break;
						
					case 494: //��·
						$outlink = 'http://www.8264.com/xianlu';
						if($_G['gp_type']){
							$typestr.='|type:'.$_G['gp_type'];
							$outlink = 'http://www.8264.com/xianlu-'.$_G['gp_type'].'-0-0-0-4-1';
						}
						break;
						
					case 499: //����
						$outlink = 'http://www.8264.com/diaoyu/';
						if($_G['gp_type']){
							$typestr.='|type:'.$_G['gp_type'];
							$outlink = 'http://www.8264.com/diaoyu/list-'.$_G['gp_type'].'-0-0-0-1-1.html';
						}
						break;
						
					case 501: //������ֲ�
						$outlink = 'http://www.8264.com/dianping-club-act-showlist.html';
						if($_G['gp_provinceid']){
							$typestr.='|provinceid:'.$_G['gp_provinceid'];
							$outlink = 'http://www.8264.com/dianping-club-act-showlist-order-lastpost-gongsitype-0-provinceid-'.$_G['gp_provinceid'].'-cityid-0-page-1.html';
						}
						break;
					default:
						$outlink = 'http://www.8264.com/zhuangbei.html';
						break;
				}
				//�Ƿ���Ĭ������
				foreach($default[P_FRIENDLYLINK_DIANPING]['child'] as $item){
					if($item['identifie'] == $typestr){
						$outlinkname = $item['keyword'];
						continue;
					}
				}
			}
		}

		//�Ƿ������һ��
		if (empty($typestr)) {
			return;
		}

		//ͨ��get�洢��ǰҳ��Ϣ
		$hash = md5($typestr.$outlinkname.$outlink.md5('46ea7e'));

		/**
		 * �ӻ���������ݣ�ģ��ƴ��
		 */
		$key = 'plugin_friendlylink_list_'.$typestr;
		$data = memory('get', $key);
		if (!is_array($data)) {
			$sql = "SELECT * FROM " . DB::table('common_friendlink2') . " where identifie='{$typestr}' and ispass=2 order by displayorder,id";
			$query = DB::query($sql);
			while ($values = DB::fetch($query)) {
				$data[] = $values;
			}
			if (!$data) {
				$data = array();
			}
			memory('set', $key, $data, 86400);
		}
		
		$html = '';
		foreach ($data as $k => $url_item) {
			$html.= '	<a title="' . $url_item['name'] . '" target="_blank" href="' . $url_item['url'] . '">' . $url_item['name'] . '</a>';
		}
		$html .= '		<a title="��������" target="_blank" href="plugin.php?id=friendlylink:add&type=' . $typestr . '&n='.urlencode($outlinkname).'&l='.urlencode($outlink).'&h='.$hash.'">��������</a>
					';
		
		return $html;
	}

}
?>


