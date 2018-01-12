<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<link rel="stylesheet" type="text/css" href="source/plugin/brandusers/css/main.css" media="all" />
<div class="branduser" style=" overflow:hidden; padding-left:0;">
<a href="#" class="want">我喜欢</a>
<a href="#" class="used">我用过</a>
</div>

<div class="branduser_userlist" style="display:none;"><?php if(is_array($likeitUsers)) foreach($likeitUsers as $value) { ?><div class="user">
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>"><?php echo $value['avatar'];?></a>
        <div class="user_detail">
        	<?php echo $value['message'];?>
        </div>
</div>
    <?php } ?>
</div>

<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery('.branduser_userlist .user a').mouseover(function(){
jQuery(this).next('.user_detail').show();
}).mouseout(function(){
jQuery(this).next('.user_detail').hide();
});
jQuery.noConflict();

<?php if($user_attentions['want']) { ?>
var accomplish = 1;
<?php } else { ?>
var accomplish = 0;
<?php } if($user_attentions['used']) { ?>
var accomplishs = 2;
<?php } else { ?>
var accomplishs = 0;
<?php } if($user_attentions['worth']||$user_attentions['unworth']) { ?>
var accomplish1 = 3;
<?php } else { ?>
var accomplish1 = 0;
<?php } ?>



var MountionUsersNum = {
'want': <?php echo $MountionUsersNum['want']; ?>,
'used': <?php echo $MountionUsersNum['used']; ?>,
'worth': <?php echo $MountionUsersNum['worth']; ?>,
'unworth': <?php echo $MountionUsersNum['unworth']; ?>}

function accomplish_button(type) {
accomplish = 1;
//location.reload();
}

;(function($){
var publiced_alert_interval;
function show_publiced_alert(_this) {
clearInterval(publiced_alert_interval);
$('#publiced_alert').css({top: _this.offset().top+_this.outerHeight(1), left: _this.offset().left}).show();
}
$('.branduser a').mouseout(function(){
clearInterval(publiced_alert_interval);
publiced_alert_interval = setInterval(function(){
$('#publiced_alert').hide();
}, 1000);
})	
var tid = <?php echo $_G['tid'];?>;
<?php if(!$_G['uid']) { ?>
$('.branduser a').click(function(){
showWindow('login', 'member.php?mod=logging&action=login');hideWindow('register');
})
<?php } else { ?>
    $('.branduser .want').click(function(){
var type = 'want';
if (accomplish==1) {
show_publiced_alert($(this));			
return false;
}		
        $.ajax({
            type: 'get',			
            url: 'plugin.php?id=brandusers:producereceive&op=new&type='+type+'&tid='+tid,
            success: function(html) {
if ($('.product_stat .wawntuse .user_list li').size() >= 27) {
$('.product_stat .wawntuse .user_list li').last().remove();
}
$('.product_stat .wawntuse').show();
$('#wantuse_curuser').show();
$('#wawntuse_num').text($('#wawntuse_num').text()-0+1);
  accomplish = 1;

            }
        });
return false;
    });

$('.branduser .worth').click(function(){
var type = 'worth';
if (accomplish1==3) {
show_publiced_alert($(this));			
return false;
}		
        $.ajax({
            type: 'get',			
            url: 'plugin.php?id=brandusers:producereceive&op=new&type='+type+'&tid='+tid,
            success: function(html) {
    if ($('.product_stat .worth .user_list li').size() >= 27) {
$('.product_stat .worth .user_list li').last().remove();
}
$('.product_stat .worth').show();
$('#isworth_curuser').show();
$('#worth_num').text($('#worth_num').text()-0+1);
accomplish1 = 3;
            }
        });
return false;
    });

$('.branduser .unworth').click(function(){
var type = 'unworth';
if (accomplish1==3) {
show_publiced_alert($(this));			
return false;
}		
        $.ajax({
            type: 'get',			
            url: 'plugin.php?id=brandusers:producereceive&op=new&type='+type+'&tid='+tid,
            success: function(html) {
    if(html=="success"){
alert("成功！");
}else if(html=="repaly"){
alert("您已表态！");
}
            }
        });
return false;
    });	

$('.branduser .used').click(function(){
var type = 'used';
if (accomplish==2) {
show_publiced_alert($(this));
return false;
}
showWindow('productadd','/plugin.php?id=brandusers:productadd&tid='+tid+'&type='+type);
});	
<?php } ?>	
})(jQuery);
</script>
<div id="publiced_alert">
你己经表过态了
</div>