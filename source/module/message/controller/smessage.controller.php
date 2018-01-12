<?php
class Smessage_Controller {
	function show() {
		global $_G;
		$page = $_GET['page'] <= 0 ? 1 :  intval($_GET['page']);

		$perPage = 20;
		loaducenter();
		$datalist = uc_message_show($_G['uid'], $page, $perPage, 100);
		$counts = uc_message_getCount($_G['uid'], 'both');
		if($counts['total'] <= $perPage) {
			return array('datalist' => $datalist);
		}
		else {
			$multi = multi($counts['total'], $perPage, $page, 'home.php?mod=space&do=notice&type=smessage');
			return array('datalist' => $datalist, 'multi' => $multi);
		}
	}

	function delete() {
		global $_G;

		$pmid = empty($_G['gp_pmid'])? 0 : floatval($_G['gp_pmid']);
		$deluid = empty($_G['gp_deluid']) ? 0 : floatval($_G['gp_deluid']);
		$folder = $_G['gp_folder'] == 'inbox' ? 'inbox' : 'outbox';

		loaducenter();
		$is_new = uc_pm_is_new($_G['uid'], $deluid, $pmid);
		if($is_new) {
			DB::query('UPDATE ' . DB::table('common_member') . " SET newpm=newpm-1 WHERE uid='{$_G['uid']}'");
		}

		if($deluid) {
			$retrun = uc_pm_deleteuser($_G['uid'], array($deluid));
			$pmid = $deluid;
		} else {
			$retrun = uc_pm_delete($_G['uid'], $folder, array($pmid));
		}
		if($retrun>0) {
			return array('exit' => 'success');
		} else {
			exit('fail');
		}
		
	}
}