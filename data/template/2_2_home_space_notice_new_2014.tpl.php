<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_notice_new_2014', 'home/space_notice_new_header');
0
|| checktplrefresh('./template/8264/home/space_notice_new_2014.htm', './template/8264/common/ewm_r.htm', 1509518163, '2', './data/template/2_2_home_space_notice_new_2014.tpl.php', './template/8264', 'home/space_notice_new_2014')
;?><?php include template('home/space_notice_new_header'); ?><div class="form-box profile weidumsg" id="notic_p">
<div class="info-hd">
<span class="notice_type"></span>
<span class="arrow" style="display:none;"></span>
<?php if($notify_type == 'invitation' && $datalist) { ?><!--<i class="deleteall">删除当前页</i>--><?php } if($notify_type == 'smessage') { ?><a href="home.php?mod=spacecp&amp;ac=pm" class="msgicon">发短消息</a><?php } ?>
</div>
<div class="info-bd">
<ul class="notelist">
<?php if($datalist) { if(! $notify_type || $notify_type == 'notification' ) { ?><?php echo ChildView('home/space_sub_notice', array('notifications' => $datalist, 'friends_list' => $friends_list)); } elseif($notify_type == 'invitation') { ?><?php echo ChildView('home/space_sub_invite', array('invitations' => $datalist, 'currPage' => $page)); } elseif($notify_type == 'friend') { ?><?php echo ChildView('home/space_sub_friend', array('friends' => $datalist)); } elseif($notify_type == 'greeting') { ?><?php echo ChildView('home/space_sub_poke', array('greetings' => $datalist, 'friends_list' => $friends_list, 'icons' => $icons)); } elseif($notify_type == 'smessage') { ?><?php echo ChildView('home/space_sub_msg', array('messages' => $datalist)); } } else { ?>
<li id="more_tips_new" style="text-align:center;">
<div style="font-size:14px; text-align:center; padding:10px 0px;">
<img src="http://static.8264.com/static/images/no_new_notice.png"/>
<span style="padding-top:10px; display:block;"><p>您当前没有 <em></em>可以显示</p></span>
</div>
</li>
<?php } ?>

</ul>
</div>
</div><style>
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.h13_ewm{ height:13px;}
.ewmbox{ width:160px; position: fixed !important; top: 215px; position: absolute; z-index: 10; float:right; color:#585858; }
.close_ewm{ width:11px; height:11px; background:url(http://static.8264.com/static/images/common/ewmclose.jpg) left top no-repeat; float:right; margin-bottom:2px; display:none;}
.close_ewm:hover{  background:url(http://static.8264.com/static/images/common/ewmclose_hover.jpg) left top no-repeat;}


</style>
<div class="ewmbox" style="display:none;">
<div class="clear_b h13_ewm"><a href="javascript:void(0)" class="close_ewm"></a></div><?php echo adshow("custom_468"); ?></div>
<script type="text/javascript">

//jQuery(function(){	
//	var isiOS 	  = navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod');
//    var isAndroid = navigator.userAgent.match('Android');
//    if (!isiOS && !isAndroid) {
//    	jQuery(".ewmbox").show();    	
//    	jQuery(".ewmbox").hover(
//			function () {
//			jQuery(".close_ewm",this).show();
//		  },
//		  function () {
//			jQuery(".close_ewm",this).hide();
//		  }
//		);
//		jQuery(".close_ewm").click(function(){
//			jQuery(".ewmbox").hide();
//		});   	
//    }
//	var ww = jQuery(window).width();   
//	var r_z = (ww-980)/2 -180;
//	if(r_z<0){
//		jQuery(".ewmbox").css("left",'0px');
//	}else{
//		jQuery(".ewmbox").css("left",r_z);
//	};
//	if(ww>1350){
//		jQuery(".ewmbox").show();
//	}else{
//		jQuery(".ewmbox").hide();
//	}	
//});

</script>
<?php if($multi ) { ?><span class="mulitpage"><?php echo $multi;?></span><?php } include template('home/space_notice_new_footer'); ?>