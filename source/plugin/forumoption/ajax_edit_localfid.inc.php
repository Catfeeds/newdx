<?php
if(isset($_GET['inajax']) && $_GET['inajax']==1){
    $newfid=$_GET['newfid'];
    if(!is_numeric($newfid)){
        echo "�ύ������ֵ";
    }else{
		if($_GET['method']=='add'){
			if(DB::result_first("SELECT count(*) FROM ".DB::table('plugin_master_manager_setting')." WHERE setting_name='fup' and setting_value = {$newfid}")==0){
				DB::insert("plugin_master_manager_setting",array('setting_name'=>'fup','setting_value'=>$newfid));
				memory('rm','master_manager_setting');
				echo '�޸����';
			}else{
				echo '�Ѿ����ڵİ��id';
			}
		}else{
			$num = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_master_manager')." WHERE fup=".$newfid);
			DB::delete("plugin_master_manager_setting",array('setting_name'=>'fup','setting_value'=>$newfid));
			DB::delete("plugin_master_manager",array('fup'=>$newfid));
			memory('rm','master_manager_setting');
			echo "��{$num}�������趨��Ϣ��ɾ��";
		}
    }
}
?>