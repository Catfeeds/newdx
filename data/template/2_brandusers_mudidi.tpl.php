<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<link rel="stylesheet" type="text/css" href="/source/plugin/brandusers/css/main.css" media="all" />
<div id="brandUsers">
<span id="brandUsers_wantuse" class="brandUsers_button">
<a href="#" class="brand_users_action">
<div class="pillar">
<div class="pillar_inner">
<em><?php echo $brandUsersNum['wantuse'];?></em>
</div>
</div>
<div class="text">我想去</div>
</a>
</span>

<span id="brandUsers_using" class="brandUsers_button">
<a href="#" class="brand_users_action">
<div class="pillar">
<div class="pillar_inner">
<em><?php echo $brandUsersNum['using'];?></em>
</div>
</div>
<div class="text">我去过</div>
</a>
</span>

</div>

<script src="/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
<?php if($user_attentions['wantuse'] ||  $user_attentions['using']) { ?>
var accomplish_var = 1;
<?php } else { ?>
var accomplish_var = 0;
<?php } ?>


var brandUsersNum = {
'wantuse': <?php echo $brandUsersNum['wantuse']; ?>,
'using': <?php echo $brandUsersNum['using']; ?>}

function initPillarHeight() {
var percentage = {}
var max = 1;
for (var i in brandUsersNum) {
if (max < brandUsersNum[i]) {
max = brandUsersNum[i];
}
}
for (var i in brandUsersNum) {
if (brandUsersNum[i] != 0) {
percentage[i] = (brandUsersNum[i] / max) * <?php echo PILLAR_HEIGHT;?> + "px";
} else {
percentage[i] = "0";
}
}
jQuery('#brandUsers_wantuse .pillar_inner').css('height', percentage['wantuse']);
jQuery('#brandUsers_using .pillar_inner').css('height', percentage['using']);
}
initPillarHeight();
function accomplish_button(type) {
accomplish_var = 1;
var pillar_inner_em = jQuery('#brandUsers_'+type+' .pillar_inner em');
pillar_inner_em.text(pillar_inner_em.text()-0+1);
brandUsersNum[type]++;
initPillarHeight();
if (type == 'using') {
jQuery('#likeitUsers').show();
jQuery('#likeitUsers_myface').show();
jQuery('.person_num em').text(jQuery('.person_num em').text()-0+1);
}
}
;(function($){
var publiced_alert_interval;
function show_publiced_alert(_this) {
clearInterval(publiced_alert_interval);
$('#publiced_alert').css({top: _this.offset().top+_this.outerHeight(1), left: _this.offset().left}).show();
}
$('.brandUsers_button').mouseout(function(){
clearInterval(publiced_alert_interval);
publiced_alert_interval = setInterval(function(){
$('#publiced_alert').hide();
}, 1000);
})

var tid = <?php echo $_G['tid'];?>;
<?php if(!$_G['uid']) { ?>
$('.brandUsers_button a').click(function(){
showWindow('login', 'member.php?mod=logging&action=login');hideWindow('register');
})
<?php } else { ?>
$('#brandUsers_wantuse a').click(function(){
var type = 'wantuse';
if (accomplish_var) {
show_publiced_alert($(this));
return false;
}
        if (!confirm("您是否确定提交?")) {
            return false;
        }
$.ajax({
            type: 'get',
            url: '/plugin.php?id=brandusers:attention&op=new&type='+type+'&tid='+tid,
            success: function(html){
                accomplish_button(type);
            }
        });
return false;
});

$('#brandUsers_using a').click(function(){
var type = 'using';
if (accomplish_var) {
show_publiced_alert($(this));
return false;
}
        if (!confirm("您是否确定提交?")) {
            return false;
        }
$.ajax({
            type: 'get',
            url: '/plugin.php?id=brandusers:attention&op=new&type='+type+'&tid='+tid,
            success: function(html){
                accomplish_button(type);
            }
        });
return false;
});
<?php } ?>

})(jQuery);
</script>


<div id="likeitUsers" style="<?php if($brandUsersNum['using']==0) { ?>display:none;<?php } ?>">
<h6>去过此景点的用户(<span class="person_num"><em><?php echo $brandUsersNum['using'];?></em>人</span>)</h6>
<ul class="user_list"><?php if(is_array($usingUsers)) foreach($usingUsers as $value) { ?><li>
<div class="img">
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" target="_blank" title="<?php echo $value['username'];?>">
<?php echo $value['avatar'];?>
</a>
</div>
<div class="text">
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" target="_blank" title="<?php echo $value['username'];?>">
<?php echo $value['username'];?>
</a>
</div>
</li>
<?php } if($_G['uid']) { ?>
<li id='likeitUsers_myface'>
<div class="img">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" title="<?php echo $_G['username'];?>"><?php echo avatar($_G[uid], 'small'); ?></a>
</div>
<div class="text">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" title="<?php echo $_G['username'];?>">
<?php echo $_G['username'];?>
</a>
</div>
</li>
<?php } ?>
</ul>
</div>

<div id="publiced_alert">
你己经表过态了
</div>
