<?php

/**
 *      �ɼ��������Ϣ
 *      by lv
 */

if(!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$operation = in_array($operation, array('add', 'edit')) ? $operation : 'list';
cpheader();
showsubmenu('�ɼ��������Ϣ',  array(
	array('�б�', "collecthddemand&operation=list", $operation == 'list')
));

if($operation == 'list') {
	
	if(submitcheck('collecthddemandsubmit')) {

		$perpage = intval($_G['gp_hiddenperpage']);
		$page    = intval($_G['gp_hiddenpage']);

		$aids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";		
		$url  = "action=collecthddemand&operation=list&&perpage={$perpage}&page={$page}";
		
		if ($_G['gp_optype'] == 'trash' && $aids) {	
			$attachids = array();
			$sql = "SELECT attachid FROM ".DB::table('portal_article_collecthddemand')." where aid in ({$aids}) " . getSlaveID();
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {
				$attachids[$v['attachid']] = $v['attachid'];
			}
			DB::delete('portal_article_collecthddemand', "aid in ({$aids})");
			if ($attachids) {
				$attachids = implode(',', $attachids);
				DB::delete('forum_attachment', "aid in ({$attachids})");
			}
			cpmsg('ɾ���ɹ�', $url, 'succeed');
		} else {
			cpmsg('article_choose_at_least_one_operation', $url, 'error');
		}

	} else {

		include_once libfile('function/portalcp');

		$mpurl   = ADMINSCRIPT.'?action=collecthddemand&operation='.$operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page    = max($_G['gp_page'], 1);
		if(!in_array($perpage, array(10,20,50,100))) $perpage = 50;
		
		$start  = ($page-1) * $perpage;
		$mpurl .= '&perpage='.$perpage;		
		
		showformheader('collecthddemand&operation=list');
		showtableheader('�ɼ��������Ϣ');
		showsubtitle(array('', '�ֻ���', '��ȥ��', '�淨','IP','����ʱ��'));

		$multipage = '';
		$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('portal_collecthddemand')." " . getSlaveID());
		if($count) {
			$sql = "SELECT * FROM ".DB::table('portal_collecthddemand')." order by id desc LIMIT {$start},{$perpage} " . getSlaveID();
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
						"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[id]\">",
						$value['colmobile'],
						$value['coltermini'],
						$value['colcategory'],
						$value['ip'],
						date("Y-m-d H:i:s", $value['timestamp'])
					));
			}
			$multipage = multi($count, $perpage, $page, $mpurl);
		}

		
		showsubmit('', '', '', '', $multipage);
		showtablefooter();
		showformfooter();
	}
} 
?>
