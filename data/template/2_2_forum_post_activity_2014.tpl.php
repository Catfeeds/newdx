<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./template/8264/forum/post_activity_2014.htm', './template/8264/forum/post_newimage_2014_editor.htm', 1509518620, '2', './data/template/2_2_forum_post_activity_2014.tpl.php', './template/8264', 'forum/post_activity_2014')
|| checktplrefresh('./template/8264/forum/post_activity_2014.htm', './template/8264/common/editor_2014.htm', 1509518620, '2', './data/template/2_2_forum_post_activity_2014.tpl.php', './template/8264', 'forum/post_activity_2014')
;?>
<link href="http://static.8264.com/static/css/forum/a.min.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<style>
.futitle {margin-bottom:20px;}
.base-panel {padding-top:0;margin-top:-20px;}
.form-group {clear:both;}
.dq {height:36px;background-position:150px -381px;width:184px;z-index: 1200;margin-right: 10px;}
.dq .js {height:36px;width:140px;padding-left:10px;}
.comb-btn {cursor:pointer;}
.auto_down {-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;background: #fff none repeat scroll 0 0;border-color: -moz-use-text-color #d6d6d6 #d6d6d6;border-image: none;border-style: none solid solid;border-width: 0 1px 1px;display: none;height: 249px;left: 0px;overflow-x: hidden;overflow-y: auto;padding-top: 2px;position: absolute;top: 30px;z-index: 9999 !important;}
.auto_down a {padding-left:10px;margin:5px 0;display:block;}
.auto_down span {padding-left:10px;margin:5px 0;display:block;color:#43a6df;}
.auto_down a:hover {background-color:#CAE1FF;}
.dq_down {width:184px;z-index:1290;margin-top:2px!important;}
.dq_down a:hover {background-color:#CAE1FF;}
.actioninput {font-size:14px;}
.typeselect {z-index:196;}
.typeselect .showdowndiv {margin-top:-6px;}
.typeselect .showdowndiv a:hover {background-color:#CAE1FF;}
.place_down {background:#fff;display:none;height:auto;left:0;overflow-x:hidden;overflow-y:auto;padding-top:2px;position:absolute;top:37px;z-index:9999!important;width:494px;border:1px solid #dfdfdf;border-top:0 none;}
.place_down a {padding-left:10px;margin:5px 0;display:block;}
.place_down span {padding-left:10px;margin:5px 0;display:block;color:#43a6df;}
.place_down a:hover {background-color:#CAE1FF;}
#result1 {background:#fff;display:none;height:auto;left:0;overflow-x:hidden;overflow-y:auto;padding-top:2px;position:absolute;top:37px;z-index:9999!important;width:494px;border:1px solid #dfdfdf;border-top:0 none;}
.result1 div {padding-left:10px!important;margin:5px 0!important;}
#result {background:#fff;display:none;height:auto;left:0;overflow-x:hidden;overflow-y:auto;padding-top:2px;position:absolute;top:37px;z-index:9999!important;width:494px;border:1px solid #dfdfdf;border-top:0 none;}
.result div {padding-left:10px!important;margin:5px 0!important;}
.placerow {position:relative;}
#e_body {height:0;overflow:hidden;position:relative;}
#append_parent {display:none;}
#activityattach_image img {margin-top:10px;}
.op-btn{float:left;height:30px;line-height:30px;color:#58b1e5;text-align:center;border-radius:3px;margin-top:4px;}
.bg-c1{background-color:#58b1e5;color:#fff;padding:0 22px;}
.captions-box {position: relative;border: 1px solid #a9ccf0;box-shadow: 0 0 2px rgba(187,210,232,.3);width: 500px;margin-top: 10px;padding: 6px 12px 6px 26px;background-color: #eff6fc;display: none; color: #585858;}
.captions-box .tips-icon {position: absolute;width: 12px;height: 12px;left: 8px;top: 10px;background: url(http://static.8264.com/hd/pc/images/tps/v1/tipsicon.png)}
.captions-box p {font-size: 12px;line-height: 20px}

.webuploader-container {
position: relative;
}
.webuploader-element-invisible {
position: absolute !important;
clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
clip: rect(1px,1px,1px,1px);
}
.webuploader-pick {
position: relative;
display: inline-block;
cursor: pointer;
background: #58b1e5;
font-size: 14px;
color: #fff;
text-align: center;
        padding: 3px;
width: 140px;
        height:28px;
border-radius: 4px;
overflow: hidden;
}
.webuploader-pick-hover {
background: #00a2d4;
}

.webuploader-pick-disable {
opacity: 0.6;
pointer-events:none;
}
</style><?php $arrPlace = $activity[place] ? explode('，', $activity[place]) : array();
$activity[place] = str_replace('，', '-', $activity[place]); ?><!--第一步-->
<div class="base-panel step" style="overflow:hidden;">
<div class="main-content">
<div class="form-group" style="height:38px;z-index:160;*zoom:1">
<label class="control-label">活动标题：</label>
<div class="combobox-input">
<?php if($isfirstpost && !empty($_G['forum']['threadtypes']['types'])) { ?>
<div class="pbt_select needdown typeselect" style="height:36px;">
<div class="pbt_select_option_box showdowndiv" style="height:140px!important;"><?php if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $typeid => $name) { if($thread['typeid'] == $typeid || $_G['gp_typeid'] == $typeid) { ?><?php $nowselect_typeid = array('typeid' => $typeid, 'name' => strip_tags($name)); } ?>
<a hid="<?php echo $typeid;?>" href="javascript:void(0);"><?php echo strip_tags($name);; ?></a>
<?php } ?>
</div>
<span>
<?php if($nowselect_typeid) { ?>
<input type="hidden" name="typeid" id="typeid" value="<?php echo $nowselect_typeid['typeid'];?>" /><span><?php echo $nowselect_typeid['name'];?></span>
<?php } else { ?>
<input type="hidden" name="typeid" id="typeid" value="0"/><span style="color:#a5a5a5;">选择分类信息</span>
<?php } ?>
</span>
</div>
<?php } ?>
<input type="text" value="<?php echo $thread['subject'];?>" id="subject" name="subject" class="form-control" style="width:320px;" placeholder="标题严禁使用【】等异形符号，违者删帖">
</div>
</div>
<div class="form-group" style="z-index:159;*zoom:1;">
<label class="control-label">活动地点：</label>
<div class="combobox-input">
<div class="place-multiLine" <?php if($arrPlace) { ?>style="display:block;"<?php } ?>>
<?php if($arrPlace) { if(is_array($arrPlace)) foreach($arrPlace as $v) { ?><div class="place-component-block">
<strong class="place-name"><?php echo $v;?></strong>
<a href="javascript:void(0);" title="删除活动地点" class="place-menu-link delete-row">
<b class="icon-delete"></b>
</a>
<input type="hidden" name="activityplace[]" value="<?php echo $v;?>">
</div>
<?php } } ?>
</div>
<div style="position:relative;">
<input type="text" placeholder="请输入省，市，活动地点" id="scenicSpots" class="form-control w470 activityplace js">
<div class="place_down"></div>
</div>
</div>
</div>
<div style="clear:both;height:0;line-height:0;font-size:0;"></div>
<div class="form-group" style="z-index:158;*zoom:1;">
<label class="control-label">集合地点：</label>
<div class="combobox-input" style="position:relative;z-index:900">
<input type="text" placeholder="请输入地址" name="collectplace" id="collectplace" class="form-control w470" value="<?php echo $activity['collectplace'];?>">
<div id="result1" name="result1"></div>
<div id="result" name="result"></div>
<span id='collectprovince' style="display:none;"></span>
</div>
<div style="clear:both;height:0;line-height:0;font-size:0;"></div>
<div class="siteMap-box">
<div id="container" style="width:504px;height:200px;"></div>
<input type="hidden" name="lng" id="lng" autocomplete="off" readonly value="<?php echo $activity['lng'];?>" />
            <input type="hidden" name="lat" id="lat" autocomplete="off" readonly value="<?php echo $activity['lat'];?>" />
</div>
</div>
<div class="form-group" style="z-index:157;*zoom:1">
<label class="control-label">活动时间：</label>
<div class="combobox-input">
<div class="calendar-picker">
<input type="text" name="starttimefrom[1]" id="starttimefrom_1" onclick="showcalendar(event, this, true, false, false, 39)" autocomplete="off" value="<?php echo $activity['starttimefrom'];?>" class="calendar-input inittanchu">
<span class="calendar-icon"></span>
</div>
<span class="split">---</span>
<div class="calendar-picker">
<input type="text" onclick="showcalendar(event, this, true, false, false, 39)" autocomplete="off" id="starttimeto" name="starttimeto" value="<?php echo $activity['starttimeto'];?>" class="calendar-input inittanchu">
<span class="calendar-icon"></span>
</div>
<input type="hidden" id="starttimefrom_1_tag" value="<?php echo $activity['starttimefrom'];?>"/>
<input type="hidden" id="starttimeto_tag" value="<?php echo $activity['starttimeto'];?>"/>
</div>
</div>
<div class="form-group" style="z-index:157;*zoom:1">
<label class="control-label">报名截止时间：</label>
<div class="combobox-input">
<div class="calendar-picker">
<input type="text" name="activityexpiration" id="activityexpiration"  onclick="showcalendar(event, this, true, false, false, 39)" autocomplete="off" value="<?php echo $activity['expiration'];?>" class="calendar-input inittanchu" />
<span class="calendar-icon"></span>
</div>
</div>
</div>
<div class="form-group" style="z-index:156;*zoom:1">
<label class="control-label">活动玩法：</label>
<div class="combobox-input">
<div class="dq needdown">
<input type="text" id="activityclass" name="activityclass" value="<?php echo $activity['class'];?>" readonly class="actioninput js" <?php if($activitytypelist) { ?> onfocus="showselect(this, 'activityclass', 'activitytypelist');" <?php } ?> placeholder="选择活动玩法" />
<?php if($activitytypelist) { ?>
<div class="dq_down" id="activitytypelist"><?php if(is_array($activitytypelist)) foreach($activitytypelist as $type) { ?><a href="javascript:void(0);"><?php echo $type;?></a>
<?php } ?>
</div>
<?php } ?>
</div>
</div>
</div>
<div class="form-group div-adjust" style="z-index:155;*zoom:1">
<label class="control-label">活动性质：</label>
<div class="combobox-input" style="height:86px;">
<div class="activity-nature">
<div class="nature-item sy-nature <?php if($activity['nature'] == 2 || !$activity['nature']) { ?>nature-selected<?php } ?>">
<h3>商业</h3>
<p>组织者以盈利为目的或组织者不参与AA。</p>
</div>
<div class="nature-item aa-nature <?php if($activity['nature'] == 1) { ?>nature-selected<?php } ?>">
<h3>AA</h3>
<p>表示全体人员包括领队组织者均摊费用，多退少补。</p>
</div>
</div>
<input type="hidden" name="activitynature" id="activitynature" value="<?php if(!$activity['nature']) { ?>2<?php } else { ?><?php echo $activity['nature'];?><?php } ?>" />
</div>
</div>
<div class="form-group" style="z-index:154;*zoom:1">
<label class="control-label">俱乐部简称：</label>
<div class="combobox-input" style="position:relative;z-index:197;">
<input type="text" name="clubname" id="clubname" class="form-control w150 js" value="<?php echo $activity['clubname'];?>">
<input type="hidden" name="clubid" id="clubid" value="<?php echo $activity['clubid'];?>" />
<div class="auto_down" style="width:184px;">
<span>限8个字。</span><?php if(is_array($activityClubList)) foreach($activityClubList as $v) { ?><a href="javascript:void(0);"><?php echo $v;?></a>
<?php } ?>
</div>
<!--				<span class="tagTips-title">非必填</span>-->
</div>
</div>
<div class="form-group" style="z-index:153;*zoom:1">
<label class="control-label">手机号：</label>
<div class="combobox-input">
<input type="text" name="activitymobile" id="activitymobile" value="<?php echo $activity['mobile'];?>" class="form-control w150 js">
<span class="t" id="activitymobileSpan"><span style="color:red;">填写后可免费接收报名短信并推广到</span><a href="http://hd.8264.com/" target="_blank" style="color:blue;">8264活动平台</a></span>
<input type="hidden" name="activitymobileclaimnum" id="activitymobileclaimnum" value="">
</div>
</div>
<div class="form-group div-adjust" style="z-index:152;*zoom:1">
<label class="control-label">活动要求：</label>
<div class="combobox-input">
<input type="text" name="cost" id="cost" class="form-control w110" value="<?php echo $activity['cost'];?>" placeholder="费用">
<span class="t">元/人</span>

<input type="text" name="activitynumber" id="activitynumber" class="form-control w110" value="<?php echo $activity['number'];?>" placeholder="人数上限"/>
<span class="t">人</span>
                
                <?php if($_G['setting']['activitycredit'] && $_G['adminid'] == 1) { ?>
                <input type="text" name="activitycredit" id="activitycredit" class="form-control w110" value="<?php echo $activity['credit'];?>">
                <span class="t">枚8264币</span>
                <?php } else { ?>
                <input type="hidden" name="activitycredit" id="activitycredit" class="form-control w110" value="0">
                <?php } ?>
</div>
</div>
        <div class="form-group" style="z-index:156;*zoom:1">
<label class="control-label">报名填写表：</label>
<div class="combobox-input">
                <div class="dq needdown mr10" <?php if(!$tpllist) { ?>style='display:none;'<?php } ?>>
                    <input type="text" name="formname" id="formname" value="<?php echo $tpllist[$activity['formid']]['formname'];?>" readonly class="actioninput js" placeholder="选择报名模板" />
                    <div class="dq_down" id="formlist">
                        <?php if($tpllist) { ?>
                        <?php if(is_array($tpllist)) foreach($tpllist as $formid => $forminfo) { ?>                        <a href="javascript:void(0);" fid="<?php echo $formid;?>" onclick="usethisform(this)"><?php echo $forminfo['formname'];?></a>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="formid" id="formid" value="<?php echo $activity['formid'];?>">
                </div>
                <a href="http://www.8264.com/misc.php?mod=hd&amp;action=gohd" target="_blank" onclick="showDialog($('idoit').innerHTML, 'info', '提示')" class="op-btn <?php if(!$tpllist) { ?>bg-c1<?php } ?>">新建报名填写表</a>
</div>
            <div class="captions-box" style="display:block">
                <div class="tips-icon"></div>
                <p>1、默认报名填写表</p>
                <p>适合大部分活动收集报名信息。收集内容：真实姓名，电话号码，身份证号，人数，备注</p>
                <p>2、新建报名填写表</p>
                <p>若现有表格不符合要求，请点击新建报名填写表，自定义填写项，建立之后即可选择使用</p>
            </div> 
</div>
<?php if($allowpostimg) { ?>
<div class="form-group div-adjust" style="z-index:151;*zoom:1">
<label class="control-label">活动封面：</label>
<div class="combobox-input">
<!--<a href="javascript:void(0);" class="upload-cover-btn inittanchu" onclick="uploadWindow(function (aid, url){updateactivityattach(aid, url, 'http://image1.8264.com/forum')})"><?php if($activityattach['attachment']) { ?>更新活动图片<?php } else { ?>上传活动图片<?php } ?></a>-->
<input id="url_action" value="<?php echo $action;?>" type="hidden">
<input id="url_policy" value="<?php echo $policy;?>" type="hidden">
<input id="url_signature" value="<?php echo $sign;?>" type="hidden">
<input id="fileid" value="" type="hidden">
<input id="fid" value="<?php echo $_G['fid'];?>" type="hidden">
<input id="filename" name="filename" value="" type="hidden">
<input id="picPath" name="picPath" value="" type="hidden">


<div id="filePicker"><?php if($activityattach['attachment']) { ?>更新活动图片<?php } else { ?>上传活动图片<?php } ?></div>
<!--<span class="tagTips-title">请尽量上传650*400尺寸的图片，只能上传一张</span>-->
<input type="hidden" name="activityaid" id="activityaid" value="<?php echo $activity['aid'];?>" />
</div>
<div style="clear:both;height:0;line-height:0;font-size:0;"></div>
<div class="" id="activityattach_image">
<?php if($activity['thumb']) { ?>
<a href="<?php echo $activity['attachurl'];?>" target="_blank"><img class="spimg" src="<?php echo $activity['thumb'];?>" alt="" /></a>
<?php } ?>
</div>
            <div class="captions-box" style="display:block">
                <div class="tips-icon"></div>
                <p>只能上传一张，尽量上传650*400尺寸的图片;</p>
                <p>通过数据调查，上传精美图片可以提高报名量200%</p>
            </div>
</div>
<div style="clear:both;height:1px;"></div>
<?php } ?>
</div>
<div class="primaryButton-wrapper">
<a href="javascript:void(0);" class="comb-btn next-link inittanchu" onclick="tostep2()">下一步</a>
</div>
</div>
<!--第一步 end-->
<!--第二步-->
<div class="base-panel step" style="height:0;overflow:hidden;position:relative;">
<div class="sub-title" style="margin-top:30px;">
<h2 id="subject_show"></h2>
<a href="javascript:void(0);" class="prev-link" onclick="tostep1()">返回上一步</a>
</div>
<div class="main-content" id="activitycontent">
<div class="ft-content">
<div class="form-title">
<h3><i class="ui-title-icon ui-tTrip-icon"></i>行程介绍</h3>
</div>
<div class="input-wrap">
<textarea name="activitymessage[1]" id="info-input1" class="textarea" onpropertychange="this.style.height=this.scrollHeight+'px';" oninput="this.style.height=this.scrollHeight+'px';"><?php echo $postinfo['activitymessage']['0'];?></textarea>
</div>
</div>
<div class="ft-content">
<div class="form-title">
<h3><i class="ui-title-icon ui-tPrice-icon"></i>费用装备</h3>
</div>
<div class="input-wrap">
<textarea name="activitymessage[2]" id="info-input2" class="textarea" onpropertychange="this.style.height=this.scrollHeight+'px';" oninput="this.style.height=this.scrollHeight+'px';"><?php echo $postinfo['activitymessage']['1'];?></textarea>
</div>
</div>
<div class="ft-content">
<div class="form-title">
<h3><i class="ui-title-icon ui-tNotice-icon"></i>其他<span style="font-size:12px;color:#a8a8a8;margin-left:12px;">非必填</span></h3>
</div>
<div class="input-wrap">
<textarea name="activitymessage[3]" id="info-input3" class="textarea" onpropertychange="this.style.height=this.scrollHeight+'px';" oninput="this.style.height=this.scrollHeight+'px';"><?php echo $postinfo['activitymessage']['2'];?></textarea>
</div>
</div>
</div><div class="clboth pt26" id="<?php echo $editorid;?>_body">
<div class="fu_l">
<div class="editerbox">
<div id="<?php echo $editorid;?>_controls" class="edierbar clboth">
<a id="<?php echo $editorid;?>_bold" title="文字加粗" class="bold"></a>
<div class="font_size">
<a href="javascript:;" class="small" onclick="discuzcode('fontsize', 2);" title="小"  ></a>
<a href="javascript:;" class="medium" onclick="discuzcode('fontsize', 3);" title="中"  ></a>
<a href="javascript:;" class="large" onclick="discuzcode('fontsize', 4);" title="大"  ></a>
</div>

<div class="colorbox">
<a href="javascript:;" class="gray" title="灰色" onclick="discuzcode('forecolor', '#585858')" onmouseout="setEditorTip('')" onmouseover="setEditorTip('灰色')" ></a>
<a href="javascript:;" class="blue" title="蓝色" onclick="discuzcode('forecolor', 'Blue')" onmouseout="setEditorTip('')" onmouseover="setEditorTip('蓝色')" ></a>
<a href="javascript:;" class="red" title="红色" onclick="discuzcode('forecolor', 'Red')" onmouseout="setEditorTip('')" onmouseover="setEditorTip('红色')" ></a>
</div>

<div class="text_align">
<a id="<?php echo $editorid;?>_justifyleft" class="text_left" title="居左"></a>
<a id="<?php echo $editorid;?>_justifycenter" class="text_center" title="居中"></a>
</div>
<div class="fjicon">
<a title="添加链接" cate="link" class="linkicon" href="javascript:void(0);"></a>
<?php if($_G['forum']['allowmediacode']) { ?>
<a class="shipinicon" cate="shipin" title="添加视频" href="javascript:void(0);"></a>
<?php } if($_G['group']['allowpostattach']) { ?>
<a cate="fujian" class="fujianicon" title="添加附件" href="javascript:void(0);"><span class="tanhao" style="display: none;" id="<?php echo $editorid;?>_attachn"></span></a>
<?php } ?>
<div class="fujianout" cate="fujian" id="<?php echo $editorid;?>_attach_menu" style="display:none;<?php if(! $_G['forum']['allowmediacode']) { ?>left:40px;<?php } ?>">
<div class="bqtitle">
<a cate='listattach' href="javascript:;" class="zhong" >附件列表</a>
<?php if($allowuploadnum) { ?><a cate='uploadattach' href="javascript:;">普通上传</a><?php } ?>
<span class="close14_14_24w closepostion"></span>
</div>
<div class="fujiancon">
<div id="noattachtips" class="fujinaup listattach" <?php if(empty($attachs['used']) && empty($attachs['unused'])) { ?> style="display:block;"<?php } ?>>
<div class="imgupcon">
<p>本帖还没有附件</p>
<input name="" type="button" class="imgfjbutton" />
</div>
</div>
<div class="fujian_list listattach" <?php if(empty($attachs['used']) && empty($attachs['unused'])) { ?>style="display:none;"<?php } ?>>
<ul>
<li class="fujian_list_th clboth">
<span class="filename">文件名</span>
<span class="readpower needdown">
<?php if($_G['group']['allowsetattachperm']) { ?>
阅读权限
<em class="notecon showdowndiv">阅读权限按由高到低排列，高于或等于选中组的用户才可以阅读。</em>
<?php } ?>
</span>
<span class="info">描述</span>
</li>
</ul>
<span id="listofattach" style="display: block; position:relative">
<ul id="attachlist"></ul>
<div class="tsupfujian">以下是你上次上传但没有使用的附件</div>
<ul id="attachlist_old"></ul>
<div style="clear: both;"></div>
</span>
<div class="shuoming">点击文件名添加到帖子内容中，<em>"attach://"</em> 开头的附件地址支持任何人下载请谨慎添加</div>
</div>
<div class="fujinaup uploadattach" style="display:none;">
<ul class="clboth" id="attach_upload_body"></ul>
<div class="notice">
<p>
文件尺寸: 小于 8.7MB<br/>
可用扩展名: <?php echo str_replace(array('jpeg,','gif,','jpg,','png,') ,'' ,$_G['group']['attachextensions']) ?> <br/>
此处只允许上传除图片外的其他文件，上传图片请点击页面右侧上传按钮
</p>
<p id="attachbtn" style="text-align:center"></p>
<div class="noticetj" id="uploadbtn"><input name="" type="button" class="qxbutton" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="button" class="tjbutton" /></div>
<span id="uploadingtips">
<p style="text-align: center;"><img src="http://static.8264.com/static/image/common/uploading.gif" style="vertical-align: middle;"/></p>
<div class="noticeshangchuan">上传中，请稍后，您可以暂时关闭小窗口，上传完成后会提示您。</div>
</span>
</div>
</div>
</div>
</div>
<div class="shipinout" cate="shipin">
<div class="shipinclose"><span class="close14_14_24w closepostion"></span></div>
<div class="formshipin">
<span class="weblink"><input name="" type="text" class="input230" /><em>请输入视频文件地址</em></span>
<span class="w_h">
<em>宽：<input name="" type="text" class="input52" value="500" /></em>
<em>高：<input name="" type="text" class="input52" value="375" /></em>
</span>
<span class="fxauto clboth"><input name="" type="checkbox" value="" /><label>是否自动播放</label></span>
<span class="notice">支持优酷、土豆、56、酷六等视频网址<br>支持 wma avi rmvb mov swf flv 等音乐格式<br>示例：http://sever/movie.wma</span>
</div>
<div class="tjqx"><input name="" type="button" class="qxbutton" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="button" class="tjbutton tjb" /></div>
</div>
<div class="linkout" cate="link">
<div class="linkoutclose"><span class="close14_14_24w closepostion"></span></div>
<div class="formlink">
<span class="weblink"><input type="text" class="input230" /><em>请输入链接地址</em></span>
<span class="weblink"><input type="text" class="input230" /><em>请输入链接文字</em></span>
</div>
<div class="tjqx"><input type="button" class="qxbutton" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="tjbutton tjb" /></div>
</div>
</div>
<?php if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) { ?>
<!-- @提醒 -->
<div class="fjicon">
<a href="javascript:void(0);" class="aticon" onclick="atlist_show();"></a>
<div class="atpop out">
<div class="linkoutclose" onclick="javascript:atlist_hide();"><span class="close14_14_24w closepostion"></span></div>
<div class="formlink">
<span class="weblink"><input type="text" class="input230" name="username" onkeyup="atlist_get(this.value)" /><em>请输入您要@的用户名</em></span>
</div>
<div class="atlist" id="atlist"></div>
</div>
</div>
<!-- //@提醒 -->
<?php } ?>
<label id="<?php echo $editorid;?>_switcher" class="y" ><input id="<?php echo $editorid;?>_switchercheck" type="checkbox" class="pc" name="checkbox" value="0" <?php if(!$editor['editormode']) { ?>checked="checked"<?php } ?> onclick="switchEditor(this.checked?0:1)" />纯文本</label>
<div id="<?php echo $editorid;?>_button">
<div id="<?php echo $editorid;?>_adv_s0">
<a id="<?php echo $editorid;?>_paste"></a>
</div>
</div>
</div>
<div class="edt areatext" style="height: 400px;"><textarea name="<?php echo $editor['textarea'];?>" id="<?php echo $editorid;?>_textarea" class="pt" tabindex="2" rows="15"><?php echo $editor['value'];?></textarea></div><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/editor.css?<?php echo VERHASH;?>" />
<script src="http://static.8264.com/static/js/editor.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/bbcode.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var editorid = '<?php echo $editorid;?>';
var textobj = $(editorid + '_textarea');
var wysiwyg = (BROWSER.ie || BROWSER.firefox || (BROWSER.opera >= 9)) && parseInt('<?php echo $editor['editormode'];?>') == 1 ? 1 : 0;
var allowswitcheditor = parseInt('<?php echo $editor['allowswitcheditor'];?>');
var allowhtml = parseInt('<?php echo $editor['allowhtml'];?>');
var allowsmilies = parseInt('<?php echo $editor['allowsmilies'];?>');
var allowbbcode = parseInt('<?php echo $editor['allowbbcode'];?>');
var allowimgcode = parseInt('<?php echo $editor['allowimgcode'];?>');
var simplodemode = parseInt('<?php if($editor['simplemode'] > 0) { ?>1<?php } else { ?>0<?php } ?>');
var fontoptions = new Array("仿宋_GB2312", "黑体", "楷体_GB2312", "宋体", "新宋体", "微软雅黑", "Trebuchet MS", "Tahoma", "Arial", "Impact", "Verdana", "Times New Roman");
var custombbcodes = new Array();
<?php if($_G['cache']['bbcodes_display'][$_G['groupid']]) { if(is_array($_G['cache']['bbcodes_display'][$_G['groupid']])) foreach($_G['cache']['bbcodes_display'][$_G['groupid']] as $tag => $bbcode) { ?>custombbcodes["<?php echo $tag;?>"] = {'prompt' : '<?php echo $bbcode['prompt'];?>'};
<?php } } if($editor['simplemode'] > 0) { ?>
editorsimple();
<?php } ?>
</script>
<div class="aretzt clboth">
<span id="<?php echo $editorid;?>_tip" class="le"></span>
<span class="ri">
&nbsp;
<a href="javascript:;" onclick="discuzcode('svd');return false;" id="<?php echo $editorid;?>_svd">保存数据</a> |&nbsp;
<a href="javascript:;" onclick="discuzcode('rst');return false;" id="<?php echo $editorid;?>_rst">恢复数据</a>
</span>
</div></div>
</div>
<div class="fu_r">
<div class="imgfbbox" id="right_tools">
<div class="imgfbtitle">
<span class="zhong uploadpic">上传图片</span><span class="usealbum">使用相册</span>
</div>
<div class="uploadpicshow imgfbboxcon">
<div class="imgfbboxcon">
<div class="imgfbbox_1">
<div class="imgupbuttoncon">

<div style="margin:0 auto;width:208px;">
<input id="fid" value="<?php echo $_G['fid'];?>" type="hidden">
<input id="editorid" value="<?php echo $editorid;?>" type="hidden">
<input id="url_action" value="<?php echo $action;?>" type="hidden">
<input id="url_policy" value="<?php echo $policy;?>" type="hidden">
<input id="url_signature" value="<?php echo $sign;?>" type="hidden">

<div id="filePicker">请选择图片</div>
<div><p style="display:none;" id="uploadtips"></p></div>
</div>

<script src="http://static.8264.com/static/js/webuploader.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/webuploader_forum_start.js?<?php echo VERHASH;?>" type="text/javascript"></script>
</div>
<div class="imgmoreup">
<span class="imgmoreupicon"></span>
<span><img src="http://static.8264.com/static/images/common/imglistbg.jpg"/></span>
<span class="note">可批量上传50张图片<br/>单张图片不超过8.7M<br/>图片边长小于2500像素<br/>支持jpg、jpeg、gif、png格式</span>
</div>
<div style="display:none" id="uploadimagediv">
<div class="imglistcon clboth">
<ul id="uploadimagelist">
<?php if(!empty($imgattachs['used'])) { ?><?php $imagelist = $imgattachs['used']; include template('forum/ajax_imagelist'); ?>            				        <?php } ?>
                                    <?php if(!empty($imgattachs['unused'])) { ?>
                                    <?php $imagelist = $imgattachs['unused']; ?>                                    <?php include template('forum/ajax_imagelist'); ?>                                    <?php } ?>
</ul>
</div>
<span class="djaddtz">点击图片插入帖子，请勿拖拽</span>
<div class="bcxc">
<a href="javascript:;" id="savetoalbum">保存相册</a>
<a href="javascript:;" id="insertallimage">全部添加</a>
<div class="bcxcout_selectout" id="selectsavealbum" style="display:none;">
<div class="bcxcout_selectoutclose"><span class="close14_14_24w closepostion"></span></div>
<div class="xcselect needdown">
<span>请选择相册</span><input type="hidden" name="uploadalbum" value="0" />
<div class="xcselectout showdowndiv"><?php if(is_array($albumlist)) foreach($albumlist as $album) { ?><a href="javascript:;" albumid="<?php echo $album['albumid'];?>"><?php echo $album['albumname'];?></a>
<?php } ?>
<a href="javascript:;" albumid="0">+创建新相册</a>
</div>
</div>
<div class="xcgx clboth"><input name="insertall" type="checkbox" value="" class="inputfx"/><em>勾选可保存图片到您的相册</em></div>
</div>
<div class="bcxcout_selectout" id="createnewalbum" style="display:none;">
<div class="bcxcout_selectoutclose"><span class="close14_14_24w closepostion"></span></div>
<span class="cjxctitle">创建相册</span>
<div class="cjxcinput">
<input name="newalbum" type="text" class="cjxctext" />
</div>
<div class="cjxcbutton"><input name="" type="button" class="cjbutton"/>&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="button" class="qxbutton" /></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="usealbumshow imgfbboxcon" style="display:none;">
<?php if($albumlist) { ?>
<div class="xzxc needdown">
<span>选择相册</span>
<div class="xzxcout showdowndiv" style="display:none"><?php if(is_array($albumlist)) foreach($albumlist as $album) { ?>    					<a href="javascript:;" onclick="$('selectalbum_span').style.display = 'none';" albumid="<?php echo $album['albumid'];?>"><?php echo $album['albumname'];?></a>
    					<?php } ?>
</div>
</div>
<div class="b_a_dox" id="selectalbum_span">
<span class="imgmoreupicon_on"></span>
</div>
<div id="albumphoto">
<div class="imgmoreup_no">
<span><img src="http://static.8264.com/static/images/common/imglistbg_1.jpg"/></span>
<span class="cxwithoutimg_text">请从我的相册中选择图片</span>
</div>
</div>
<?php } else { ?>
<div class="imgmoreup_no">
<span><img src="http://static.8264.com/static/images/common/imglistbg_1.jpg"/></span>
<span class="cxwithoutimg_text">您的相册还没有照片</span>
</div>
<?php } ?>
</div>
</div>
</div>
<div style="clear: both;"></div>
</div>
<?php if($special != 4) { ?>
<style>    
.webuploader-container {
position: relative;
}
.webuploader-element-invisible {
position: absolute !important;
clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
    clip: rect(1px,1px,1px,1px);
}
.webuploader-pick {
position: relative;
display: inline-block;
cursor: pointer;
background: #00b7ee;
padding: 10px 15px;
font-size: 16px;
color: #fff;
text-align: center;
width:178px;
border-radius: 3px;
overflow: hidden;
}
.webuploader-pick-hover {
background: #00a2d4;
}

.webuploader-pick-disable {
opacity: 0.6;
pointer-events:none;
}
</style>
<?php } ?><input type="hidden" name="activitymessagecount" value="<?php echo $postinfo['activitymessagecount'];?>" id="activitymessagecount"/>

<div class="primaryButton-wrapper">
<?php if($_G['gp_action'] == 'edit') { ?>
<input type="hidden" name="editsubmit" value="true" id="postsubmit"/>
<input type="submit" class="comb-btn next-link" value="保存"/>
<?php } else { ?>
<input type="hidden" name="topicsubmit" value="true" id="postsubmit"/>
<input type="submit" class="comb-btn next-link" value="发布活动"/>
<?php } ?>
<a href="javascript:void(0);" class="prev-link" onclick="tostep1()">返回上一步</a>
</div>
</div>
<!--第二步 end-->
<div id="idoit" style="display:none;">
    <div style="color:#333;text-align:center;width:260px;padding:10px 0 10px;font-size:16px;">报名表是否新建完成？</div>
    <div class="gsh ptm pbm">
        <a href="javascript:void(0);" onclick="freshformlist()" class="pn pnc"><span>已完成</span></a>
    </div>
</div>

<script src="http://static.8264.com/static/js/webuploader.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/webuploader_huodong.js" type="text/javascript" type="text/javascript"></script>

<script type="text/javascript" reload="1">
//判断是活动，还是发奖品
function isActivityFunc() {

var isActivity = false;
var activitycredit = 0;
activitycredit = jQuery('#activitycredit').val() == '' ? 0 : parseInt(jQuery('#activitycredit').val(), 10);
var activitymessagecount = 0;
var gp_action = '<?php echo $_G['gp_action'];?>';

if (gp_action == 'edit') {
var activitymessagecount = parseInt(jQuery('#activitymessagecount').val(), 10);
}
if ((gp_action == 'newthread' && activitycredit == 0) || (gp_action == 'edit' && activitycredit == 0 && activitymessagecount > 1)) {
isActivity = true;
}
return isActivity;
}
function tostep1() {
jQuery('.step').eq(1).css({'height':'0'});
jQuery('.step').eq(1).find('#e_body').css({'height':'0'});
jQuery('.step').eq(0).show();
jQuery('.futitle').show();
}
function tostep2() {
var nummode = /^\d+$/;

<?php if($isfirstpost && !empty($_G['forum']['threadtypes']['types'])) { ?>
if($('postform').typeid.value == '0') {
showDialog('对不起，请选择子版分类', 'alert', '', function () { $('postform').typeid.focus() });
return false;
}
<?php } ?>

var tempValue = jQuery('#subject').val();
jQuery('#subject_show').html('').html(tempValue);
jQuery('.futitle').hide();
if(!tempValue) {
showDialog('对不起，请填写活动标题', 'alert', '', function () { $('postform').subject.focus() });
return false;
}

var hasActivityplaceVal = false;
jQuery("input[name='activityplace[]']").each(function(){
if (jQuery(this).val() != '') {
hasActivityplaceVal = true;
}
});
if(!hasActivityplaceVal) {
showDialog('对不起，请输入活动地点', 'alert', '', function () { jQuery('.activityplace').eq(0).focus() });
return false;
}
if($('postform').collectplace.value == '') {
showDialog('对不起，请输入集合地点', 'alert', '', function () { $('postform').collectplace.focus() });
return false;
}
if($('postform').lng.value == '' || $('postform').lat.value == '') {
showDialog('请修改集合地点，确保地址能在地图中显示。', 'alert', '', function () { $('postform').collectplace.focus() });
return false;
}
if($('postform').starttimefrom_1.value == '') {
showDialog('对不起，请输入活动时间', 'alert', '', function () { $('postform').starttimefrom_1.focus(); });
return false;
}
if($('postform').starttimeto.value == '') {
showDialog('对不起，请输入活动时间', 'alert', '', function () { $('postform').starttimeto.focus(); });
return false;
}
if($('postform').starttimefrom_1.value != '') {
var date0 = getNumberTime($('postform').starttimefrom_1.value);
var date1 = getNumberTime($('postform').starttimeto.value);
if (date0 > date1) {
showDialog('对不起，活动的结束时间应晚于开始时间', 'alert', '', function () { $('postform').starttimefrom_1.focus(); });
return false;
}
}
if($('postform').activityexpiration.value == '') {
showDialog('对不起，请输入报名截止日期', 'alert', '', function () { $('postform').activityexpiration.focus() });
return false;
}
var date0 = getNumberTime($('postform').starttimefrom_1.value);
var date1 = getNumberTime($('postform').activityexpiration.value);
if (date0 < date1) {
showDialog('对不起，报名截止日期应早于活动开始时间', 'alert', '', function () { $('postform').activityexpiration.focus(); });
return false;
}
if($('postform').activityclass.value == '') {
showDialog('对不起，请输入活动玩法', 'alert', '', function () { $('postform').activityclass.focus() });
return false;
}
if($('postform').activitynature.value == '0') {
showDialog('对不起，请选择活动性质', 'alert', '', function () { $('postform').activitynature.focus() });
return false;
}
var activitymobilemode = /^0?1[3|4|5|7|8][0-9]\d{8}$/;
if($('postform').activitymobile.value != ''&&!activitymobilemode.test($('postform').activitymobile.value)) {
showDialog('对不起，请输入正确的手机号', 'alert', '', function () { $('postform').activitymobile.focus() });
return false;
}
if (!nummode.test($('postform').cost.value) && $('postform').activitynature.value == '2') {
showDialog('对不起，请正确输入每人花销', 'alert', '', function () { $('postform').cost.focus() });
return false;
}
if($('postform').cost.value == '0' && $('postform').activitynature.value == '2') {
showDialog('对不起，请输入每人花销', 'alert', '', function () { $('postform').cost.focus() });
return false;
}
    if($('postform').formid.value == '0') {
showDialog('对不起，请选择报名填写表', 'alert', '', function () { $('postform').formname.focus() });
return false;
}
if($('postform').activityaid.value == '') {
showDialog('对不起，请上传活动图片', 'alert', '', function () {});
return false;
}

jQuery('.step').eq(0).hide();
jQuery('.step').eq(1).css({'height':'auto'});
jQuery('.step').eq(1).find('#e_body').css({'height':'auto'});

var isActivity = isActivityFunc();
if (isActivity) {
jQuery('#activitycontent').show();
jQuery('#e_body').hide();
} else {
jQuery('#activitycontent').hide();
jQuery('#e_body').show();
}

<?php if($_G['gp_action'] != 'edit') { ?>
var nowhdmobile = jQuery.trim(jQuery('#activitymobile').val());
jQuery.get('http://m.hd.8264.com/wap.php?app=api&act=ajaxGetMobile&isget=-1&mobile='+nowhdmobile+'&bbs_uid=<?php echo $_G['uid'];?>',function(data){},'jsonp');
<?php } ?>
}
function validateextra_activity() {

var isActivity = isActivityFunc();
if (isActivity) {
var obj = jQuery('#postform #info-input1');
if(obj.val() == '') {
showDialog('对不起，请填写行程介绍', 'alert', '', function () { obj.focus() });
return false;
}
var obj = jQuery('#postform #info-input2');
if(obj.val() == '') {
showDialog('对不起，请填写费用装备', 'alert', '', function () { obj.focus() });
return false;
}
}
return true;
}
//将日期转为时间戳
function getNumberTime(time){
    time = time.replace(/-/g,"/");
    var date = new Date(time);
    time = Math.floor(date.getTime()/1000);
    return time;
}
//设置活动时长标签
function setTagDays(startTime, endTime){
startTime   = getNumberTime(startTime);
endTime     = getNumberTime(endTime);
var days    = Math.floor((endTime - startTime)/86400)+1;
var tempObj = jQuery('.single-tag-starttimeto');
tempObj.find('span').html('').html(days+"日");
tempObj.removeClass('single-tag-default').show();
tempObj.find('.tag-info').show();

return days;
}
//增加活动地点
function addPlace(place) {

//去掉省市
var placeIndex = place.lastIndexOf(' - ');
place = placeIndex > -1 ? place.substring(0, placeIndex) : place;

var html = '';
html    +=  '<div class="place-component-block">';
html    +=  '<strong class="place-name">'+place+'</strong>';
html    +=  '<a href="javascript:void(0);" title="删除活动地点" class="place-menu-link delete-row"><b class="icon-delete"></b></a>';
html    +=  '<input type="hidden" name="activityplace[]" value="'+place+'">';
html    +=  '</div>';
jQuery('.place-multiLine').append(html).show();
jQuery('.activityplace').val('');
}
//过滤特殊字符，最多8个字
function dealText(keyword) {
keyword     = keyword.replace(/[~|`|!|@|#|$|%|^|&|*|\(|\)|_|\-|——|\+|=|\{|\[|\}|\]|\||\\|:|;|"|'|<|,|>|.|\?|/|·|！|￥|……|（|）|【|】|：|；|”|“|‘|’|《|，|》|。|？|、| |　]+/g, '');
var kindex  = 0;
var len     = 0;
for (var i=0; i<keyword.length; i++) {
iVal = keyword.charCodeAt(i);
len += iVal>127 || iVal==94 ? 2 : 1;
if (len <= 16) {
kindex = i;
}
}
kindex++;
keyword = len <= 16  ? keyword : keyword.substr(0,kindex);
return keyword;
}

</script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){

$('.base-panel .needdown').hover(function(event){
$(this).find('[class$=_down]').show();
}, function(event){
$(this).find('[class$=_down]').hide();
});
$(".base-panel").delegate('div[class$=_down]>a', 'click', function(){
var hid     = $(this).attr('hid');
var tempVal = $(this).text();
$(this).parent().hide();
if(hid) {
var tempobj = $(this).parent().siblings('input[type=hidden]').val(hid).siblings('span.js');
} else {
var tempobj = $(this).parent().siblings('input[type=text]');
}
tempobj.val(tempVal).end();

//活动地点
if (tempobj.hasClass('activityplace')) {
$('.activityplace').focus();
addPlace(tempVal);
}

});

$('.base-panel div.timesj>span.xlcf').click(function(event){
$(this).siblings('.timesj_down_ot').show();
});
$('.base-panel div.timesj>div.timesj_down_ot').mouseleave(function(event){
$(this).hide();
});
$('.base-panel div.timesj>div.timesj_down_ot>a').click(function(event){
$(this).parent().hide();
});

//活动性质
$('.nature-item').click(function(){
$(this).siblings().removeClass('nature-selected');
$(this).addClass('nature-selected');
if ($(this).hasClass('sy-nature')) {
$('#activitynature').val('2');
} else {
$('#activitynature').val('1');
}
});

$(".activityplace").keyup(function(){
var keyword = $(this).val();

//过滤特殊字符，最多8个字
keyword = dealText(keyword);
$(this).val(keyword);

var date = new Date();
var time = date.getTime();

var place_down = $(this).siblings('.place_down');
var html = '<span>限8个字，符号无效，空格生效。</span>';
if (keyword != '') {
var re  = /\w+/i;
var pos = keyword.search(re);
keyword = encodeURI(keyword);
if (pos < 0) {
$.post('forum.php?mod=misc&action=activitytermini&time='+time,{keyword:keyword},function(data){
var list = data.list;
for(var i=0;i<list.length;i++){
html += '<a href="javascript:void(0);">'+list[i]+'</a>';
}
$('.place_down').hide();
place_down.html('').html(html).show();
},'json');
} else {
place_down.html('').html(html).show();
}
} else {
$('.place_down').hide();
}
});
$('.activityplace').keydown(function(event){
if (event.keyCode == 32) {
var tempVal = $(this).val();
$(this).val('');
tempVal = tempVal.replace(/[ |　]+/g, '');
if (tempVal != '') {
addPlace(tempVal);
}
}
});
//俱乐部自动完成
$(".form-group").delegate('input.js', 'keyup', function(){
var findvalue = $(this).val();
var mydowndiv = $(this).siblings('div[class=auto_down]');
mydowndiv.show().find('a').hide();
if(findvalue != ''){
mydowndiv.find("a:contains('" + findvalue + "')").show().end();
}
mydowndiv.css('height', mydowndiv.find('a:visible').length < 9 ? 'auto' : '270px');
});
$("#clubname").keyup(function(){
var tempVal = $(this).val();

//过滤特殊字符，最多8个字
tempVal = dealText(tempVal);

$(this).val(tempVal);

});

//删除选项
$(".place-multiLine").delegate(".delete-row","click",function(){
var objParent = $(this).parents('.place-component-block');
objParent.remove();
$('.place_down').hide();

if ($('.place-component-block').length == 0) {
jQuery('.place-multiLine').hide();
}
});

//删掉开始的弹出框(编辑器带的)
si = setInterval(function(){
if ($('#append_parent #fwin_dialog').length > 0) {
$('#append_parent #fwin_dialog').remove();
$('#append_parent #fwin_dialog_cover').remove();
$('#append_parent').css({'display':'inline'});
clearInterval(si);
}
},500);
$('.inittanchu').click(function(){
$('#append_parent').css({'display':'inline'});
clearInterval(si);
});

//子版分类的样式
siTypeid = setInterval(function(){
var typeid = parseInt($('#typeid').val(), 10);
if (typeid > 0) {
$('#typeid').next().css({'color':'#585858'});
clearInterval(siTypeid);
}
},500);

//活动玩法的样式
siClass = setInterval(function(){
if ($('#activityclass').val() != '') {
$('#activityclass').next().css({'color':'#585858'});
clearInterval(siClass);
}
},500);

//使自动完成框消失
$(document).click(function(){
$('.place_down').hide();
$('.auto_down').hide();
$('#result1').hide();
$('#result').hide();

var tempVal = $('.activityplace').val();
$('.activityplace').val('');
tempVal = tempVal.replace(/[ |　]+/g, '');
if (tempVal != '') {
addPlace(tempVal);
}
});

//阻止回车提交
$('.combobox-input input').keydown(function(event){
if (event.keyCode == 13) {
return false;
}
});


$("#activitymobile").bind("input propertychange",function(){
var hdmobile = $.trim($('#activitymobile').val());
showactivitymobileSpan(hdmobile);
});

<?php if($_G['gp_action'] == 'edit') { ?>
var loadhdmobile ='<?php echo $activity['mobile'];?>';
showactivitymobileSpan(loadhdmobile);
<?php } else { ?>
jQuery.get('http://m.hd.8264.com/wap.php?app=api&act=ajaxGetMobile&isget=1&bbs_uid=<?php echo $_G['uid'];?>',function(data){
var loadhdmobile = data.mobile;
jQuery('#activitymobile').val(loadhdmobile);
showactivitymobileSpan(loadhdmobile);
},'jsonp');
<?php } ?>


})(jQuery);


function showactivitymobileSpan(hdmobile){
var activitymobilemode = /^0?1[3|4|5|8][0-9]\d{8}$/;
if(hdmobile != ''&&activitymobilemode.test(hdmobile)) {
jQuery.get('http://m.hd.8264.com/wap.php?app=api&act=ajaxMobilehd&mobile='+hdmobile+'&bbs_uid=<?php echo $_G['uid'];?>',function(data){
if(data.count >0){
jQuery('#activitymobileSpan').html('<a href="http://hd.8264.com/index.php?app=claim&amp;mobile='+hdmobile+'" target="_blank">活动平台上有<b style="color:#ff6639;font-size:16px;">'+data.count+'条</b>活动待认领，认领后报名量增加200%&nbsp;<u style="color:#ff6639;font-size:14px;">马上认领></u></a>');
jQuery('#activitymobileclaimnum').val(data.count);
}else{
jQuery('#activitymobileSpan').html('<span style="color:red;">填写后可免费接收报名短信并推广到</span><a href="http://hd.8264.com/" target="_blank" style="color:blue;">8264活动平台</a>');
jQuery('#activitymobileclaimnum').val('');
}
},'jsonp');
}else{
jQuery('#activitymobileSpan').html('<span style="color:red;">填写后可免费接收报名短信并推广到</span><a href="http://hd.8264.com/" target="_blank" style="color:blue;">8264活动平台</a>');
jQuery('#activitymobileclaimnum').val('');
}
}

</script>
<!-- 高德地图 -->
<script src="http://webapi.amap.com/maps?v=1.3&key=58e839fc201e927a2a4b5f0a16d8a0db" type="text/javascript"></script>
<script type="text/javascript">
var windowsArr = [];
var marker = [];
var mapObj = new AMap.Map("container", {
    resizeEnable: true,
        resizeEnable: true,
        center: [116.397428, 39.90923],//地图中心点
        zoom: 13,//地图显示的缩放级别
    keyboardEnable: false
});

document.getElementById("collectplace").onkeyup = keydown;
//输入提示
function autoSearch() {
    var keywords = document.getElementById("collectplace").value;
    var auto;
    //加载输入提示插件
    AMap.service(["AMap.Autocomplete"], function() {
        var autoOptions = {
            city: "" //城市，默认全国
        };
        auto = new AMap.Autocomplete(autoOptions);
        //查询成功时返回查询结果
        if (keywords.length > 0) {
            auto.search(keywords, function(status, result) {
                autocomplete_CallBack(result);
            });
        }
        else {
            document.getElementById("result1").style.display = "none";
        }
    });
}

//输出输入提示结果的回调函数
function autocomplete_CallBack(data) {
    var resultStr = "";
    var tipArr = data.tips;
    if (tipArr && tipArr.length > 0) {
        for (var i = 0; i < tipArr.length; i++) {
            resultStr += "<div id='divid" + (i + 1) + "' onmouseover='openMarkerTipById(" + (i + 1)
                    + ",this)' onclick='selectResult(" + i + ")' onmouseout='onmouseout_MarkerStyle(" + (i + 1)
                    + ",this)' style=\"font-size: 13px;cursor:pointer;padding:5px 5px 5px 5px;\"" + "data=" + tipArr[i].adcode + ">" + tipArr[i].name + "<span style='color:#C1C1C1;'>" + tipArr[i].district + "</span></div>";
        }
    }
    else {
        resultStr = '<div style="padding:10px;">π__π 亲,人家找不到结果!<br />要不试试：<br />1.请确保所有字词拼写正确<br />2.尝试不同的关键字<br />3.尝试更宽泛的关键字</div>';
    }
    document.getElementById("result1").curSelect = -1;
    document.getElementById("result1").tipArr = tipArr;
    document.getElementById("result1").innerHTML = resultStr;
    document.getElementById("result1").style.display = "block";
}

//输入提示框鼠标滑过时的样式
function openMarkerTipById(pointid, thiss) {  //根据id打开搜索结果点tip
    thiss.style.background = '#CAE1FF';
}

//输入提示框鼠标移出时的样式
function onmouseout_MarkerStyle(pointid, thiss) {  //鼠标移开后点样式恢复
    thiss.style.background = "";
}

//从输入提示框中选择关键字并查询
function selectResult(index) {
    if (index < 0) {
        return;
    }
    if (navigator.userAgent.indexOf("MSIE") > 0) {
        document.getElementById("collectplace").onpropertychange = null;
        document.getElementById("collectplace").onfocus = focus_callback;
    }
    //截取输入提示的关键字部分
    var text = document.getElementById("divid" + (index + 1)).innerHTML.replace(/<[^>].*?>.*<\/[^>].*?>/g, "");
    var cityCode = document.getElementById("divid" + (index + 1)).getAttribute('data');
    document.getElementById("collectplace").value = text;
    document.getElementById("result1").style.display = "none";
    //根据选择的输入提示关键字查询
    mapObj.plugin(["AMap.PlaceSearch"], function() {
        var msearch = new AMap.PlaceSearch();  //构造地点查询类
        AMap.event.addListener(msearch, "complete", placeSearch_CallBack); //查询成功时的回调函数
        msearch.setCity(cityCode);
        msearch.search(text);  //关键字查询查询
    });
    var p = jQuery("#result1 > #divid"+(index+1)+" > span").html();
    jQuery("#collectprovince").html(p);
}

//定位选择输入提示关键字
function focus_callback() {
    if (navigator.userAgent.indexOf("MSIE") > 0) {
        document.getElementById("collectplace").onpropertychange = autoSearch;
    }
}

//输出关键字查询结果的回调函数
function placeSearch_CallBack(data) {
    //清空地图上的InfoWindow和Marker
    windowsArr = [];
    marker = [];
    mapObj.clearMap();
    var resultStr1 = "";
    var poiArr = data.poiList.pois;
    var resultCount = poiArr.length;
    for (var i = 0; i < resultCount; i++) {
        resultStr1 += "<div id='divid" + (i + 1) + "' onmouseover='openMarkerTipById(" + i + ",this)' onmouseout='onmouseout_MarkerStyle(" + (i + 1) + ",this)' style=\"font-size: 12px;cursor:pointer;padding:0px 0 4px 2px; border-bottom:1px solid #C1FFC1;\"><table><tr><td><img src=\"http://webapi.amap.com/images/" + (i + 1) + ".png\"></td>" + "<td><h3><font color=\"#00a6ac\">名称: " + poiArr[i].name + "</font></h3>";
//            resultStr1 += createContent(poiArr[i].type, poiArr[i].address, poiArr[i].tel) + "</td></tr></table></div>";
        resultStr1 += createContent(poiArr[i].type, poiArr[i].address, poiArr[i].tel) + "<span style='display:none;' class='lng'>"+poiArr[i].location.getLng()+"</span><span style='display:none;' class='lat'>"+poiArr[i].location.getLat()+"</span></td></tr></table></div>";
    }
    mapObj.setFitView();

    document.getElementById("result").innerHTML = resultStr1;
    document.getElementById("result").style.display = "none";
    jQuery("#result div[id=divid1]").click();

    jQuery("#result").addClass('hasClick');
}

//infowindow显示内容
function parseStr(p){
    if(!p || p == "undefined" || p == " undefined"||p=="tel"){
        p="暂无";
    }
    return p;
}
function createContent(type, address, tel) {  //窗体内容
    type=parseStr(type);
    address=parseStr(address);
    tel=parseStr(tel);
    var s=[];
    s.push("地址：" +address);
    s.push("电话：" +tel);
    s.push("类型：" +type);
    return s.join("<br>");
}
function keydown(event) {
    var key = (event || window.event).keyCode;
    var result = document.getElementById("result1")
    var cur = result.curSelect;
    if (key === 40) {//down
        if (cur + 1 < result.childNodes.length) {
            if (result.childNodes[cur]) {
                result.childNodes[cur].style.background = '';
            }
            result.curSelect = cur + 1;
            result.childNodes[cur + 1].style.background = '#CAE1FF';
            document.getElementById("collectplace").value = result.tipArr[cur + 1].name;
        }
    } else if (key === 38) {//up
        if (cur - 1 >= 0) {
            if (result.childNodes[cur]) {
                result.childNodes[cur].style.background = '';
            }
            result.curSelect = cur - 1;
            result.childNodes[cur - 1].style.background = '#CAE1FF';
            document.getElementById("collectplace").value = result.tipArr[cur - 1].name;
        }
    } else if (key === 13) {
        var res = document.getElementById("result1");
        if (res && res['curSelect'] !== -1) {
            selectResult(document.getElementById("result1").curSelect);
        }
    } else {
        autoSearch();
    }
}

function setMapPoint(mapObj, lng1, lat1) {
AMap.service('AMap.Geocoder',function(){
        geocoder = new AMap.Geocoder({
        });
    })

mapObj.panTo(new AMap.LngLat(lng1, lat1));

//加载鹰眼
    mapObj.plugin(["AMap.OverView"], function () {
        view = new AMap.OverView();
        mapObj.addControl(view);
    });

    //初始化覆盖物
    mapObj.clearMap();
    marker = new AMap.Marker({
icon: "http://webapi.amap.com/images/marker_sprite.png",
position: new AMap.LngLat(lng1, lat1),
draggable: true,
cursor: 'move',
raiseOnDrag: true
    });
    marker.setMap(mapObj);  //在地图上添加点
    marker.setAnimation('AMAP_ANIMATION_DROP');
    mapObj.setCenter([lng1,lat1]);

    AMap.event.addListener(marker, 'dragend', function(e){
    	jQuery("#lng").val(e.lnglat.lng);
    	jQuery("#lat").val(e.lnglat.lat);
    	mapObj.setCenter([e.lnglat.lng,e.lnglat.lat]);

    	 //逆地理编码
        var lnglatXY=[e.lnglat.lng, e.lnglat.lat];//地图上所标点的坐标
        geocoder.getAddress(lnglatXY, function(status, result) {
            if (status === 'complete' && result.info === 'OK') {
province = result.regeocode.formattedAddress.replace('省', '省,');
province = province.replace('市', '市,');
province = province.replace('区', '区,');
              jQuery('#collectplace').val(province);
            }else{
               console.log('获取地址失败');
            }
        });
    });
}

function setMapPointByAddress(mapObj) {
if (jQuery("#result").hasClass('hasClick')) {
jQuery("#result").removeClass('hasClick');
return false;
}
jQuery("#lat").val('');
jQuery("#lng").val('');
    address = jQuery("#collectplace").val();

    AMap.service(["AMap.Geocoder"], function () { //加载地理编码
        geocoder = new AMap.Geocoder({
            radius: 1000,
            extensions: "all"
        });
        geocoder.getLocation(address, function (status, info) {
            var pointObj = info.geocodes;
            if (typeof(pointObj) == 'object') {
            jQuery.each(pointObj, function (n, value) {
                lng1 = value.location.lng;
                lat1 = value.location.lat;
            });

            jQuery("#lat").val(lat1);
            jQuery("#lng").val(lng1);
            mapObj.panTo(new AMap.LngLat(lng1, lat1));
            //加载鹰眼
            mapObj.plugin(["AMap.OverView"], function () {
                view = new AMap.OverView();
                mapObj.addControl(view);
            });
            //初始化覆盖物
        mapObj.clearMap();
        marker = new AMap.Marker({
icon: "http://webapi.amap.com/images/marker_sprite.png",
position: new AMap.LngLat(lng1, lat1),
draggable: true,
cursor: 'move',
raiseOnDrag: true
        });
        marker.setMap(mapObj);  //在地图上添加点
        marker.setAnimation('AMAP_ANIMATION_DROP');
        mapObj.setCenter([lng1,lat1]);

        AMap.event.addListener(marker, 'dragend', function(e){
        	jQuery("#lng").val(e.lnglat.lng);
    	jQuery("#lat").val(e.lnglat.lat);
    	mapObj.setCenter([e.lnglat.lng,e.lnglat.lat]);

    	 //逆地理编码
        var lnglatXY=[e.lnglat.lng, e.lnglat.lat];//地图上所标点的坐标
        geocoder.getAddress(lnglatXY, function(status, result) {
            if (status === 'complete' && result.info === 'OK') {
              jQuery('#collectplace').val(result.regeocode.formattedAddress);
            }else{
               console.log('获取地址失败');
            }
        });
        });
            } else {
showDialog('请修改集合地点，确保地址能在地图中显示。', 'alert', '', function () { jQuery('#collectplace').focus() });
return false;
            }
        });
    });
}

jQuery("#result").delegate('div[id^=divid]', 'click', function(){
var tempObj   = jQuery(this).find('td').eq(1);
var tempValue = tempObj.find('font').html();
tempValue     = tempValue.replace('名称:', '');
province = jQuery("#collectprovince").html();
province = province.replace('省', '省,');
province = province.replace('市', '市,');
province = province.replace('区', '区,');
jQuery("#collectplace").val(province + tempValue);
jQuery("#result").hide();

//已存在经纬度，可以直接加载地图
var lng1 = tempObj.find('.lng').html();
var lat1 = tempObj.find('.lat').html();
    jQuery("#lng").val(lng1);
    jQuery("#lat").val(lat1);

    if(lng1 && lat1){
        setMapPoint(mapObj, lng1, lat1);
    }
});
jQuery("#collectplace").blur(function(){
setTimeout(function(){
setMapPointByAddress(mapObj);
}, 1000);
});
function usethisform(thisObj){
    jQuery("#formid").val(jQuery(thisObj).attr('fid'));
}
function freshformlist(){
    var defalutobj = null;
    jQuery.get("misc.php", {mod:'hd',action:'getformlist'}, function (data){
        data = eval("("+data+")");
        if(data.status == 1){
            var html = '';
            for(formid in data.tpllist){
                html+= '<a href="javascript:void(0);" fid="'+formid+'" onclick="usethisform(this)">'+data.tpllist[formid]+'</a>';
            }
            jQuery("#formlist").html(html);
            defalutobj = jQuery("#formlist a").eq(0);
            jQuery("#formname").val(defalutobj.html());
            jQuery("#formid").val(defalutobj.attr('fid'));
            jQuery("#formid").parents('div').show();
            jQuery("a.bg-c1").removeClass('bg-c1');
            hideMenu('fwin_dialog', 'dialog');
        }else{
            alert('未检测到数据更新');
        }
    });
}
</script>
<script type="text/javascript">
jQuery(function () {
    //已存在经纬度，可以直接加载地图
    lng1 = jQuery("#lng").val();
    lat1 = jQuery("#lat").val();

    if(lng1 && lat1){
        setMapPoint(mapObj, lng1, lat1);
    }

});
</script>
<!-- 高德地图 end -->
