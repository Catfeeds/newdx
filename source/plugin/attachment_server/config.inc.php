<?php

/**
 * @author jianghong
 * @todu 后台附件服务器通讯插件的设置模块
 * @version 2012-09-17
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

require_once dirname(__file__)."/attachment_server.class.php";

$attachserver = new attachserver;
if(isset($_POST['inajax'])){
    if(isset($_POST['mod'])){
        $attachserver->edit_server($_POST);
    }
    exit;
}
if(isset($_POST)){
    if(isset($_POST['name']) && isset($_POST['domain']) && isset($_POST['api'])){
        $attachserver->add_server($_POST);
    }
}
$servers = $attachserver->show_server();
$config = $attachserver->config_manage('','show');
?>
<style>
.blue{color:blue;}
.green{color:green;}
.red{color:red;}
.hidden{visibility: hidden;}
.edit{margin-left:15px;font-weight:bold;}
#config p{margin:5px auto;}
</style>
<div id="config"><br /><p>通讯间隔数字串:<input class="edit" type="text" name="safe_string" value="<?php echo $config['safe_string'];?>"/>&nbsp;<input name="change" type="button" value="修改"/><span style="margin:0px 10px;font-weight:bold;"></span>当前显示为<span class="blue"><?php echo $attachserver->print_safestring(); ?></span></p>
<p>PS:通讯字符串用来分隔返回信息，例如通讯数字串为：8264，则程序会使用<span class="blue">||||-|8|-|2|-|6|-|4|-||||</span>来分隔返回信息</p>
<p>是否开启图片传送附件服务器:<span style="font-weight: bold;margin-left:20px;" id="open_close"><?php echo $attachserver->open_close(); ?></span></p></div>
<div>
<?php showtableheader();?>
<tr><th>附件服务器(域名)</th><th>附件服务器IP或域名</th><th>接口文件</th><th>状态</th><th>使用空间</th></tr>
<tr>
<form action="" method="post">
    <td><input type="text" name="name" /></td>
    <td><input type="text" name="domain" /></td>
    <td><input type="text" name="api" value="/api.php" /></td>
    <td><input type="submit" name="submit" value="添加"/></td>
    <td></td>
</form>
</tr>
<?php if(empty($servers)){ ?>
<tr><td colspan="5">当前没有附件服务器，请添加</td></tr>
<?php }else{
    foreach($servers as $server){ ?>
<tr id="server_<?php echo $server['serverid']; ?>">
    <td><input type="text" name="name" value="<?php echo $server['name']; ?>"/><a class="edit hidden" href="javascript:;">修&nbsp;&nbsp;改&nbsp;&nbsp;</a></td>
    <td><input type="text" name="domain" value="<?php echo $server['domain']; ?>"/><a class="edit hidden" href="javascript:;">修&nbsp;&nbsp;改&nbsp;&nbsp;</a></td>
    <td><input type="text" name="api" value="<?php echo $server['api']; ?>"/><a class="edit hidden" href="javascript:;">修&nbsp;&nbsp;改&nbsp;&nbsp;</a></td>
    <td><a class="status" href="javascript:;"><?php echo $server['status']==1?"<b class='green'>使用中</b>":"<b class='red'>关闭中</b>"; ?></a></td>
    <td><input type="button" name="calspace" value="校验" style='margin-right:10px;'/><span><?php echo $server['space_value']." <b class='blue'>".$attachserver->cal_space($server['space_type'])."</b>"; ?><span></span></td>
</tr>
<?php }
 } ?>
<?php showtablefooter(); ?>
</div>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($) {
    $("input[type=submit]").click(function(){
        if($("input[name=server_name]").val()!="" && $("input[name=server_domain]").val()!="" && $("input[name=server_api]").val()!=""){
            return true;
        }
        alert('不能为空');
        return false;
    });
    $("input[type=text]").mouseover(function(){
        $(this).select();
    });
    $("input[type=text]").keydown(function(){
        $(this).siblings(".edit").removeClass('green').html("修改").removeClass('hidden');
    });
    $("a.edit").click(function(){
        var $obj = $(this);
        var $input = $(this).prev();
        if($input.val()!=""){
            $.post("plugin.php?id=attachment_server:config",{
                inajax:1,
                serverid:$obj.parent().parent().attr('id'),
                mod:$input.attr('name'),
                value:$input.val()
            },function(data,textStatus){
                $obj.addClass('green').html(data);
            })
        }else{
            alert('不能为空');
            $input.select();
        }
    });
    $(".status").click(function(){
        var $obj = $(this);
        $.post("plugin.php?id=attachment_server:config",{
            inajax:1,
            mod:'sataus',
            serverid:$obj.parent().parent().attr('id')
        },function(data,textStatus){
            $obj.html(data);
        });
    });
    $("#config p input[type=button]").click(function(){
        var $obj = $(this);
        var $prev = $obj.prev();
        if($prev.val()!=""){
            $.post("plugin.php?id=attachment_server:config",{
                inajax:1,
                mod:'config',
                method:$prev.attr('class'),
                name:$prev.attr('name'),
                value:$prev.attr('value')
            },function(data,textStatus){
                var color_class = 'red';
                if(data=='修改完成'){
                    color_class = 'green';
                    $.post("plugin.php?id=attachment_server:config",{
                        inajax:1,
                        mod:'ref_safe'
                    },function(datad,textStatusd){
                        $obj.next().next().html(datad);
                    });
                }
                $obj.next('span').html(data).attr('class',color_class);
            });
        }else{
            alert('不能为空');
            $prev.select();
        }
    });
    $("#open_close").click(function(){
        $.post("plugin.php?id=attachment_server:config",{
            inajax:1,
            method:'change',
            mod:'config'
        },function(data,textStatus){
            $("#open_close").html(data);
        });
    });
    $("td input[name=calspace]").click(function(){
        var $next = $(this).next();
        var $parent = $(this).parent().parent();
        var $domain = $parent.find("input[name=domain]").val();
        var $api = $parent.find("input[name=api]").val();
        $.post("plugin.php?id=attachment_server:ver_space",{
            inajax:1,
            domain:$domain,
            api:$api,
            serverid:$parent.attr('id')
        },function(data,textStatus){
            $next.html(data);
        });
    });
})(jQuery);
</script>
