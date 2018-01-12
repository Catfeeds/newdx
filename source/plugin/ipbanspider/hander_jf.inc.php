<?php  header('Content-Type:text/html;charset=gbk');
if($_GET['stepnum']==1){
    session_start();
    ?>
    <div style="background:#FFF;padding:10px;margin:10px">
    <h4 style="text-align: center;margin:0px;">自助解锁系统</h4>
    <hr />
    <div style="font-size:15px;">
    <p><?php if($_G['uid']){
        echo "当前用户为：<b style='color:blue'>".$_G['username']."</b>,<span id='nextstep' style='cursor:pointer;color:#0099cc;font-weight:bold'>下一步</span>";
    }else{
        $_SESSION['forunban']=1;
        ?>
    您需要先 <span id="login_jf" style='cursor:pointer;color:#0099cc'>登录</span> 或 <span id="reg_jf" style='cursor:pointer;color:#0099cc'>注册</span>
    <?php } ?></p></div>
    </div>
    <?php
}else{
    if($_GET['stepnum']==2){
        $_SESSION['forunban']=null;
        ?>
        <div style="background:#FFF;padding:5px;margin:10px">
        <h4 style="text-align: center;margin:0px;">自助解锁系统</h4>
        <hr />
        <div style="height:105px;">
        <iframe id='yzm_one' width="190px" height="70px" src="plugin.php?id=ipbanspider:yzm&inajax=1" frameborder=0 scrolling='no'></iframe>
        <div id="yzm_ref" style="width:180px;height:60px;z-index: 200;position: relative;top:-60px;cursor:pointer;"></div>
        <div style="position: relative;top:-60px;">输入以上内容:<input type="text" value="" size="10" name="yzm"/>
        <input type="button" name="submit" value="解锁"/></div>
        <div id="yzm_tips" style="position:relative;left:180px;top:-120px;font-size:13px;color:red;width:100px;font-weight:bold"></div>
        </div>
        </div>
<?php
    }
}
?>