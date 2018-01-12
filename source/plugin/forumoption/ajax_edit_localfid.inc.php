<?php
if(isset($_GET['inajax']) && $_GET['inajax']==1){
    $newfid=$_GET['newfid'];
    if(!is_numeric($newfid)){
        echo "提交错误数值";
    }else{
		if($_GET['method']=='add'){
			if(DB::result_first("SELECT count(*) FROM ".DB::table('plugin_master_manager_setting')." WHERE setting_name='fup' and setting_value = {$newfid}")==0){
				DB::insert("plugin_master_manager_setting",array('setting_name'=>'fup','setting_value'=>$newfid));
				memory('rm','master_manager_setting');
				echo '修改完成';
			}else{
				echo '已经存在的板块id';
			}
		}else{
			$num = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_master_manager')." WHERE fup=".$newfid);
			DB::delete("plugin_master_manager_setting",array('setting_name'=>'fup','setting_value'=>$newfid));
			DB::delete("plugin_master_manager",array('fup'=>$newfid));
			memory('rm','master_manager_setting');
			echo "有{$num}条版主设定信息被删除";
		}
    }
}
?>