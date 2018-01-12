<?php

/**
 * @author jianghong
 * @todu ��̨����������ͨѶ���������ģ��
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
<div id="config"><br /><p>ͨѶ������ִ�:<input class="edit" type="text" name="safe_string" value="<?php echo $config['safe_string'];?>"/>&nbsp;<input name="change" type="button" value="�޸�"/><span style="margin:0px 10px;font-weight:bold;"></span>��ǰ��ʾΪ<span class="blue"><?php echo $attachserver->print_safestring(); ?></span></p>
<p>PS:ͨѶ�ַ��������ָ�������Ϣ������ͨѶ���ִ�Ϊ��8264��������ʹ��<span class="blue">||||-|8|-|2|-|6|-|4|-||||</span>���ָ�������Ϣ</p>
<p>�Ƿ���ͼƬ���͸���������:<span style="font-weight: bold;margin-left:20px;" id="open_close"><?php echo $attachserver->open_close(); ?></span></p></div>
<div>
<?php showtableheader();?>
<tr><th>����������(����)</th><th>����������IP������</th><th>�ӿ��ļ�</th><th>״̬</th><th>ʹ�ÿռ�</th></tr>
<tr>
<form action="" method="post">
    <td><input type="text" name="name" /></td>
    <td><input type="text" name="domain" /></td>
    <td><input type="text" name="api" value="/api.php" /></td>
    <td><input type="submit" name="submit" value="���"/></td>
    <td></td>
</form>
</tr>
<?php if(empty($servers)){ ?>
<tr><td colspan="5">��ǰû�и����������������</td></tr>
<?php }else{
    foreach($servers as $server){ ?>
<tr id="server_<?php echo $server['serverid']; ?>">
    <td><input type="text" name="name" value="<?php echo $server['name']; ?>"/><a class="edit hidden" href="javascript:;">��&nbsp;&nbsp;��&nbsp;&nbsp;</a></td>
    <td><input type="text" name="domain" value="<?php echo $server['domain']; ?>"/><a class="edit hidden" href="javascript:;">��&nbsp;&nbsp;��&nbsp;&nbsp;</a></td>
    <td><input type="text" name="api" value="<?php echo $server['api']; ?>"/><a class="edit hidden" href="javascript:;">��&nbsp;&nbsp;��&nbsp;&nbsp;</a></td>
    <td><a class="status" href="javascript:;"><?php echo $server['status']==1?"<b class='green'>ʹ����</b>":"<b class='red'>�ر���</b>"; ?></a></td>
    <td><input type="button" name="calspace" value="У��" style='margin-right:10px;'/><span><?php echo $server['space_value']." <b class='blue'>".$attachserver->cal_space($server['space_type'])."</b>"; ?><span></span></td>
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
        alert('����Ϊ��');
        return false;
    });
    $("input[type=text]").mouseover(function(){
        $(this).select();
    });
    $("input[type=text]").keydown(function(){
        $(this).siblings(".edit").removeClass('green').html("�޸�").removeClass('hidden');
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
            alert('����Ϊ��');
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
                if(data=='�޸����'){
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
            alert('����Ϊ��');
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
