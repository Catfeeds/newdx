<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('showmessage_2014', 'common/header_8264_new');?>
<?php if(!$_G['inajax']) { include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/common/showmessage.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<?php if(!$param['wechatshare']) { ?><!--��չʾ��ά�������ʾ��ʱ���������js-->
<script type="text/javascript">
var ie6=false,ie7=false;
if(navigator.appName == 'Microsoft Internet Explorer'){
if(navigator.appVersion.replace(/[ ]/g,"").indexOf('MSIE6.0')>-1){
ie6=true;
}
if(navigator.appVersion.replace(/[ ]/g,"").indexOf('MSIE7.0')>-1){
ie7=true;
}
}

jQuery(document).ready(function($){
var h_ext = 0;
if(ie6 || ie7){
h_ext = 160;
}
$("#wp").css("height",$(window).height()-284+h_ext);
$(window).resize(function(){
$("#wp").css("height",$(window).height()-284+h_ext);
});
});
</script>
<?php } } else { include template('common/header_ajax'); } if($param['wechatshare']) { ?>
<!--//�������ʱ ҳ����ʾ start-->
<style type="text/css">
  		.mod-wrap{
  			position: relative;
  			width: 830px;
  			background-color: #fff;
  			margin: 75px auto;
  			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  			border-radius: 5px;
padding:0px 0px 50px 0px;
  		}
.title-inner{height: 80px;background-color: #f9f9f9;border-radius: 5px 5px 0 0;text-align: center;border-bottom:#e5e5e5 dashed 1px;	}
  		.publish-success{display: inline-block;	background: url(http://static.8264.com/static/images/tps/v1/SATiXX-2tTxIl-190-123.png) -150px -3px no-repeat;font-size: 24px;padding-left: 50px;height: 40px;line-height: 40px;margin: 20px 0;font-weight:bold;}
  		.wechat-content{
  			position: relative;
  			padding-top: 16px;
  			text-align: center;
  		}
  		.wechat-content .vcode-img{
  			width: 152px;
  			height: 152px;
  			border: 1px solid #eee;
  			padding: 7px;
  			background: url(http://static.8264.com/static/images/tps/v1/ewmthbg.jpg) no-repeat 3px 7px;
  			margin:0 auto;
  		}
  		.wechat-content .vcode-img img{
  			width: 152px;
  			height: 152px;
  		}
  		.wechat-content p{
  			margin: 0;
  		}
  		.wechat-content .w-info{
  			font-size: 14px;
  			color: #585858;
  			margin-top: 15px;
  			margin-bottom: 10px;
  		}
  		.wechat-content .w-tips{
  			font-size: 14px;
  			color: #666;
  		}
  		.btn-skip{
  			position: absolute;
  			-webkit-border-radius: 3px;
  			-moz-border-radius: 3px;
  			border-radius: 3px;
  			color: #43a3dd;
  			font-size: 12px;
  			border: 1px solid #43a3dd;
  			padding: ;
  			width: 60px;
  			height: 26px;
  			line-height: 26px;
  			right: 38px;
  			bottom: 20px;
  			text-align: center;
text-decoration:none;
  		}
  		.icon-wechat{
  			display: inline-block;
  			width: 21px;
  			height: 17px;
  			background: url(http://static.8264.com/static/images/tps/v1/SATiXX-2tTxIl-190-123.png) -161px -92px no-repeat;
  			vertical-align: -3px;
  			margin-right: 6px;
  		}
  		.c-tx1{
  			color: #f87354
  		}
/*��Ծ��ʼ*/


.gray420-70{ background:#f5f5f5; margin:0 auto; width:420px; padding:16px 0px 16px 0px; overflow:hidden;}
.gray420-70con{}
.gray420-70con li{ float:left; margin:0px 0px 10px 0px; font-size:14px; color:#767676; display:inline; white-space:nowrap;}
.item-check{position:relative;font-weight:normal;display:block;font-size:14px;padding-left:33px;margin:0;}
.item-check input[type="checkbox"]{position:absolute;opacity:0;filter:alpha(opacity=0);*opacity:1;*filter:alpha(opacity=100);width:14px;height:14px;cursor:pointer;outline:0 none;margin:0;top:5px;left:14px;z-index:102}
.item-check input[type="checkbox"]:checked+.input-hack{background:url('http://static.8264.com/static/images/tps/v1/fxboxbg.png') 0px 0px no-repeat;opacity:1;filter:alpha(opacity=100)}
.item-check .input-hack{background:url('http://static.8264.com/static/images/tps/v1/fxboxbg.png') 0px -32px no-repeat;position:absolute;top:5px;left:14px;width:14px;height:14px;*background:none;*display:none}
.input-checkbox{*float:left;*margin-top:10px}
/*��Ծ����*/
.bigfont{ text-align:center; padding:25px 0px 0px 0px; font-size:16px; color:#585858;}
.wechat-content{ padding:30px 0px 0px 100px;}
.wechat-content li{ width:209px; height:70px; padding:80px 0px 0px 0px; float:left; margin:0px 10px 0px 0px; font-size:14px; color:#fff; text-align:center;}
.wechat-content li.icon1{ background: url(http://static.8264.com/static/images/tps/v1/hdicons1.png) center 26px no-repeat #43a3dd ;}
  		.wechat-content li.icon2{ background: url(http://static.8264.com/static/images/tps/v1/hdicons2.png) center 26px no-repeat #438fdd ;}
.wechat-content li.icon3{ background: url(http://static.8264.com/static/images/tps/v1/hdicons3.png) center 26px no-repeat #437ddd ;}
.wechat-content li.icon11{ background: url(http://static.8264.com/static/images/tps/v1/hdicons11.png) center 26px no-repeat #43a3dd ;}
  		.wechat-content li.icon21{ background: url(http://static.8264.com/static/images/tps/v1/hdicons21.png) center 26px no-repeat #438fdd ;}
.wechat-content li.icon31{ background: url(http://static.8264.com/static/images/tps/v1/hdicons31.png) center 26px no-repeat #437ddd ;}
.gohdindex{ display:block; border-radius:20px; border:#43a3dd solid 1px; font-size:14px; color:#43a3dd; margin:30px auto 0px auto; width:160px; height:44px; background:url(http://static.8264.com/static/images/tps/v1/gohd.png) 127px 17px no-repeat; text-indent:21px; line-height:44px; text-align:left;}
.gohdindex:hover{ text-decoration:none;}
.gohdindex.small{margin:0px 0px 0px 18px; display:inline-block; _display:inline; _zoom:1; height:32px; background-position:68px 12px; width:95px; line-height:32px;}
.smallfont{ font-size:14px; color:#666; text-align:left; padding:20px 0px 0px 56px;}
.yhzbox{ font-size:16px; color:#333; padding:25px 0px 0px 0px;}
/*8264���Ʒ�б�*/
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.hdright{ overflow:hidden; padding:0px 0px 0px 56px; text-align:left;}
.hdone{ width:220px;; height:184px; float:left; margin:18px 24px 0px 0px;}
.hdone a{ font-size:14px; color:#333; line-height:1.5; text-decoration:none;}
.hdone img{ width:220px;; height:122px;}
.hdimg{ width:220px; height:122px; position:relative;}
.hdinfobox{ border:#ebebeb solid 1px; height:53px; background:#fff; padding:7px 13px 0px 13px;}
.hdjiadate{ position: absolute; bottom:0px; left:0px; background: url("http://static.8264.com/static/images/lte9bg.png") left bottom no-repeat; height:34px; width:100%;}
.hdjiadate span{ float:left; color:#fff; font-size:12px; padding:9px 0px 0px 9px;}
.hdjiadate em{ float:right; color:#fff; font-size:20px; font-style:normal;  padding:0px 9px 0px 0px;}
.hdjiadate i{ font-size:18px; padding:0px 3px 0px 0px;  font-style:normal;}
  	</style>
<div class="mod-wrap">
<div class="title-inner">
<span class="publish-success"><?php echo $param['info_activity'];?></span>
</div>
<div class="bigfont">
<?php if($param['info_activity'] == '�����ɹ�') { ?>
            <!--�����ɹ�-->
            <?php include(DISCUZ_ROOT.'./source/plugin/skiing/hd_zw.php'); ?>            <?php $huodong_zaiwai = ForumOptionHuoDong::getDataByCity($_G['fid']); ?>            <?php if($huodong_zaiwai) { ?>
            <script type="text/javascript">
              function nofind(obj,image){
                obj.src=image;
                obj.onerror=null; //���Ʋ�Ҫһֱ����
              }
            </script>
            <div class="smallfont">�����û���û���ϲ�����»</div>
            <div class="hdright clear_b">
              <?php if(is_array($huodong_zaiwai)) foreach($huodong_zaiwai as $k => $hd) { ?>                <div class="hdone">
                    <a target="_blank" href="<?php echo $hd['url_pc'];?>">
                        <div class="hdimg">
                                <img onerror="nofind(this,'<?php echo $hd['default_image2'];?>!list2016325');" title="<?php echo $hd['title'];?>" alt="<?php echo $hd['title'];?>" src="<?php echo $hd['default_image'];?>!list2016325">
                            <div class="hdjiadate">
                                <span><?php echo date("m/d", $hd['start_time']);; ?> <?php echo $hd['start_place'];?>����</span>
                                <em><i>��</i><?php echo $hd['price'];?></em>
                            </div>
                        </div>
                        <div class="hdinfobox"><?php echo cutstr($hd['title'], 52);; ?></div>
                    </a>
                </div>
              <?php } ?>
            </div>
            <?php } ?>
    		<div class="yhzbox">8264�ƽ̨�������淨��ǧ��·�������ҵ�����Ҫ��<a href="http://hd.8264.com/" target="_blank" class="gohdindex small">ȥ����</a></div>
<?php } else { ?>


<a href="http://bbs.8264.com/thread-5422622-1-1.html" target="_blank" style="text-decoration:underline;">�����������ؾ��ֲ��Ŷӻ�����ҵ��ͼ�Ĳ�ï�� 8264�����������ֲ�</a>
<?php } ?>
</div>
<a href="<?php echo $url_forward;?>" class="btn-skip">����</a>
</div>

<script type="text/javascript">
  	jQuery(document).ready(function() {
  		var wh = jQuery(window).height();
  		wh > 664 ? jQuery("#wp").css("height", wh - 199) : '';
  	});
</script>
<!--//�������ʱ ҳ����ʾ end-->
<?php } elseif($_G['gp_is_uc']) { ?>
<?php echo $show_message;?>
<script>
jQuery(function(){
var alerttype = '<?php echo $alerttype;?>';
jQuery('.altw').addClass('dhinfo plr');
if (alerttype == 'alert_error') {
jQuery('.alert_info').addClass('erroricon').removeClass('alert_info');
jQuery('.alert_error').addClass('erroricon').removeClass('alert_error');
}
jQuery('.alert_info').addClass('successicon').removeClass('alert_info');
//	mode = in_array(mode, ['confirm', 'notice', 'info', 'right']) ? mode : 'alert';
jQuery('.flb').hide();
jQuery('.pns').hide();
jQuery('#fwin_dialog_cover').remove();

jQuery('.dhinfo').append('<a href="javascript:void(0);" onclick="hideMenu(\'fwin_dialog\', \'dialog\');" class="closebtn"></a>');
});
</script>
<?php } elseif($param['msgtype'] == 1 || $param['msgtype'] == 2 && !$_G['inajax']) { if($param['login']) { ?><script type="text/javascript">showWindow('login', 'member.php?mod=logging&action=login');</script><?php } if($message == 'login_succeed') { ?>
<div class="ts590 clboth" style="margin-top:160px;">
<div class="l_400">
<span class="b_b">
<?php echo $_G['username'];?>
<em><?php echo $show_message;?></em>
</span>
<?php if($url_forward) { if(!$param['redirectmsg']) { ?>
<a href="<?php echo $url_forward;?>" class="hard_s">�����������û���Զ���ת������������</a>
<?php } else { ?>
<a href="<?php echo $url_forward;?>" class="link_ts">��� <?php echo $refreshsecond;?> ���������δ��ʼ������������</a>
<?php } } elseif($allowreturn) { ?>
<script type="text/javascript">
if(history.length > (BROWSER.ie ? 0 : 1)) {
document.write('<a href="javascript:history.back();" class="fhup"></a>');
}
</script>
<?php } if($_GET['mod']=='post'&&$_GET['fid']==437&&$_G['uid']) { ?>
<a href="http://www.8264.com/zb" class="link_ts">������ﷵ��װ��������ҳ</a>
<?php } ?>
</div>
<div class="r_102"></div>
</div>
<?php } else { ?>
<div class="ts590_white" style="margin-top:160px;">
<?php if($alerttype == "alert_error") { ?>
<span class="error_icon mb_15"></span>
<?php } elseif($alerttype == "alert_right") { ?>
<span class="right_icon mb_15"></span>
<?php } else { ?>
<span class="notice_icon mb_15"></span>
<?php } ?>
<p>
<span class="info_r_w"><?php echo $show_message;?></span>
<?php if($url_forward) { if(!$param['redirectmsg']) { ?>
<a href="<?php echo $url_forward;?>" class="link_ts">�����������û���Զ���ת������������</a>
<?php } else { ?>
<a href="<?php echo $url_forward;?>" class="link_ts">��� <?php echo $refreshsecond;?> ���������δ��ʼ������������</a>
<?php } } elseif($allowreturn) { ?>
<script type="text/javascript">
if(history.length > (BROWSER.ie ? 0 : 1)) {
document.write('<a href="javascript:history.back();" class="fhup"></a>');
}
</script>
<?php } if($message == '2014_logout_succeed') { ?>
<a href="member.php?mod=clearcookies&amp;formhash=<?php echo FORMHASH;?>" class="qc"></a>
<?php } if($_GET['mod']=='post'&&$_GET['fid']==437&&$_G['uid']) { ?>
<a href="http://www.8264.com/zhuangbei.html" class="link_ts">������ﷵ��װ��������ҳ</a>
<?php } ?>
</p>
</div>
<?php } if($_GET['aid']) { ?>
<script type="text/javascript">
window["_BFD"] = window["_BFD"] || {};
_BFD.BFD_INFO = {
iid : '<?php echo $_GET['aid'];?>'; 	//�����µ�id�ţ���ɾ�����µ�id�ţ�
};
_BFD.script = document.createElement("script");
_BFD.script.type = 'text/javascript';
_BFD.script.async = true;
_BFD.script.charset = 'utf-8';
_BFD.script.src = (('https:' == document.location.protocol?'https://ssl-static1':'http://static1')+'.baifendian.com/service/huwaiziliao/hwzl_delete.js');
document.getElementsByTagName("head")[0].appendChild(_BFD.script);
</script>
<?php } } elseif($param['msgtype'] == 2) { ?>
<h3 class="flb"><em>��ʾ��Ϣ</em><?php if($_G['inajax']) { ?><span><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" title="�ر�">�ر�</a></span><?php } ?></h3>
<div class="c altw">
<div class="<?php echo $alerttype;?>"><?php echo $show_message;?></div>
</div>
<?php if($param['login']) { ?>
<p class="o pns">
<button type="button" class="pn pnc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');showWindow('login', 'member.php?mod=logging&action=login');"><strong>��¼</strong></button>
<?php if(!$_G['setting']['bbclosed']) { ?>
<button type="button" class="pn pnc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');showWindow('register', 'member.php?mod=<?php echo $_G['setting']['regname'];?>');"><em><?php echo $_G['setting']['reglinkname'];?></em></button>
<?php } ?>
<button type="button" class="pn" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"><em>ȡ��</em></button>
</p>
<?php } else { ?>
<p class="o pns"><button type="button" class="pn pnc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"><strong>�ر�</strong></button></p>
<?php } } else { ?>
<?php echo $show_message;?>
<?php } if(!$_G['inajax']) { include template('common/footer_8264_new'); } else { include template('common/footer_ajax'); } ?>
