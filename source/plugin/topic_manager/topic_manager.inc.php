<?php
if(isset($_POST)){
    if(isset($_POST['inajax']) && $_POST['inajax']==1){
        if(isset($_POST['method']) && $_POST['method']=='topic_tid'){
            require dirname(__file__)."/topic_manager.class.php";
            header('Content-Type:text/html;charset=gbk');
            if(!is_numeric($_POST['topicid']) || !is_numeric($_POST['tid'])){
                echo "Ìá½»id´íÎó";
                exit();
            }
            $topic_manager->set_topic_tid(array('topicid'=>$_POST['topicid'],'tid'=>$_POST['tid'],'inajax'=>'1'));
        }
    }else{
        echo "error!";
    }
}
?>