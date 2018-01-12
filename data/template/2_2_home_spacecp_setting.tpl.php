<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_setting', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/home/setting.css?<?php echo VERHASH;?>">
<div class="container main-container">
<div class="module user-setting-wrap">
<div class="mt-menu-tree">
<ul class="nav nav-tabs nav-stacked">
<li class="active">
<a href="home-setting.html#profile" dataUrl="#profile"><s class="menu-nav-icon icon-1">个人信息</s>个人信息</a>
</li>
<li>
<a href="home-setting.html#contact-info" dataUrl="#contact-info"><s class="menu-nav-icon icon-2">联系资料</s>联系资料</a>
</li>
<li>
<a href="home-setting.html#account-security" dataUrl="#account-security"><s class="menu-nav-icon icon-3">账号安全</s>账号安全</a>
</li>
<!--<li>
<a href="home-setting.html#sns" dataUrl="#sns"><s class="menu-nav-icon icon-4">账号绑定</s>账号绑定</a>
</li>-->
<li>
<a href="home-setting.html#privacy" dataUrl="#privacy"><s class="menu-nav-icon icon-5">隐私设置</s>隐私设置</a>
</li>
</ul>
</div>
<div class="setting-form">
<form method="post" autocomplete="off" action="home.php?mod=setting&amp;ac=savedata">
<div class="main-wrap">
<div class="form-box profile" id="profile">
<div class="info-hd">
<span>个人信息</span><?php if(1 != 1) { ?><a href="javascript:void(0);" data-toggle="modal" data-target="#modal-pinfo">保密设置</a><?php } ?>
</div>
<div class="info-bd">
<table class="setting-profile-table">
<tbody>
<tr>
<th><label for="">用户名：</label></th>
<td><span><?php echo $_G['member']['username'];?></span></td>
</tr>
<tr>
<th><label for="">性别：</label></th>
<td>
<div class="radio-inline">
<label>
<input type="radio" value="1" name="profile[gender]"<?php if($profile_info['gender']==1) { ?> checked="ehecked"<?php } ?>>男
</label>
</div>
<div class="radio-inline">
<label>
<input type="radio" value="2" name="profile[gender]"<?php if($profile_info['gender']==2) { ?> checked="ehecked"<?php } ?>>女
</label>
</div>
<div class="radio-inline">
<label>
<input type="radio" value="0" name="profile[gender]"<?php if($profile_info['gender']==0) { ?> checked="ehecked"<?php } ?>>保密
</label>
</div>
</td>
</tr>
<tr>
<th><label for="">居住城市：</label></th>
<td>
<?php echo $province_html;?>
<?php echo $city_html;?>
</td>
</tr>
<tr>
<th><label for="">真实姓名：</label></th>
<td><input type="text" name="profile[realname]" value="<?php echo $profile_info['realname'];?>"></td>
</tr>
<tr>
<th><label for="">证件号：</label></th>
<td><input type="text" name="profile[idcard]" value="<?php echo $profile_info['idcard'];?>"></td>
</tr>
<tr>
<th><label for="">时区：</label></th>
<td><?php $timeoffset = array(
		'9999' => '使用系统默认',
		'-12' => '(GMT -12:00) 埃尼威托克岛, 夸贾林环礁',
		'-11' => '(GMT -11:00) 中途岛, 萨摩亚群岛',
		'-10' => '(GMT -10:00) 夏威夷',
		'-9' => '(GMT -09:00) 阿拉斯加',
		'-8' => '(GMT -08:00) 太平洋时间(美国和加拿大), 提华纳',
		'-7' => '(GMT -07:00) 山区时间(美国和加拿大), 亚利桑那',
		'-6' => '(GMT -06:00) 中部时间(美国和加拿大), 墨西哥城',
		'-5' => '(GMT -05:00) 东部时间(美国和加拿大), 波哥大, 利马, 基多',
		'-4' => '(GMT -04:00) 大西洋时间(加拿大), 加拉加斯, 拉巴斯',
		'-3.5' => '(GMT -03:30) 纽芬兰',
		'-3' => '(GMT -03:00) 巴西利亚, 布宜诺斯艾利斯, 乔治敦, 福克兰群岛',
		'-2' => '(GMT -02:00) 中大西洋, 阿森松群岛, 圣赫勒拿岛',
		'-1' => '(GMT -01:00) 亚速群岛, 佛得角群岛 [格林尼治标准时间] 都柏林, 伦敦, 里斯本, 卡萨布兰卡',
		'0' => '(GMT) 卡萨布兰卡，都柏林，爱丁堡，伦敦，里斯本，蒙罗维亚',
		'1' => '(GMT +01:00) 柏林, 布鲁塞尔, 哥本哈根, 马德里, 巴黎, 罗马',
		'2' => '(GMT +02:00) 赫尔辛基, 加里宁格勒, 南非, 华沙',
		'3' => '(GMT +03:00) 巴格达, 利雅得, 莫斯科, 奈洛比',
		'3.5' => '(GMT +03:30) 德黑兰',
		'4' => '(GMT +04:00) 阿布扎比, 巴库, 马斯喀特, 特比利斯',
		'4.5' => '(GMT +04:30) 坎布尔',
		'5' => '(GMT +05:00) 叶卡特琳堡, 伊斯兰堡, 卡拉奇, 塔什干',
		'5.5' => '(GMT +05:30) 孟买, 加尔各答, 马德拉斯, 新德里',
		'5.75' => '(GMT +05:45) 加德满都',
		'6' => '(GMT +06:00) 阿拉木图, 科伦坡, 达卡, 新西伯利亚',
		'6.5' => '(GMT +06:30) 仰光',
		'7' => '(GMT +07:00) 曼谷, 河内, 雅加达',
		'8' => '(GMT +08:00) 北京, 香港, 帕斯, 新加坡, 台北',
		'9' => '(GMT +09:00) 大阪, 札幌, 首尔, 东京, 雅库茨克',
		'9.5' => '(GMT +09:30) 阿德莱德, 达尔文',
		'10' => '(GMT +10:00) 堪培拉, 关岛, 墨尔本, 悉尼, 海参崴',
		'11' => '(GMT +11:00) 马加丹, 新喀里多尼亚, 所罗门群岛',
		'12' => '(GMT +12:00) 奥克兰, 惠灵顿, 斐济, 马绍尔群岛'); ?><select name="member[timeoffset]"><?php if(is_array($timeoffset)) foreach($timeoffset as $key => $desc) { ?><option value="<?php echo $key;?>"<?php if($key==$space['timeoffset']) { ?> selected="selected"<?php } ?>><?php echo $desc;?></option>
<?php } ?>
</select>
</td>
</tr>
</tbody>
</table>
<div class="setting-profile-avtar"><?php echo avatar($space[uid], big, false, false, false, '', true); ?><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">修改头像</a>
</div>
<div style="clear:both;"></div>
</div>
</div>
<div class="form-box contact-info" id="contact-info">
<div class="info-hd">
<span>联系资料</span><?php if(1 != 1) { ?><a href="javascript:void(0);" data-toggle="modal" data-target="#modal-cinfo">保密设置</a><?php } ?>
</div>
<div class="info-bd">
<table class="setting-continfo-table">
<tr>
<th><label for="">手机号：</label></th>
<td><input type="text" name="profile[mobile]" value="<?php echo $profile_info['mobile'];?>"></td>
</tr>
<tr>
<th><label for="">QQ：</label></th>
<td><input type="text" name="profile[qq]" value="<?php echo $profile_info['qq'];?>"></td>
</tr>
<tr>
<th><label for="">常用邮箱：</label></th>
<td><input type="text" name="profile[field1]" value="<?php echo $profile_info['used_email'];?>"></td>
</tr>
<tr>
<th><label for="">紧急联系电话：</label></th>
<td><input type="text" name="profile[field2]" value="<?php echo $profile_info['used_mobile'];?>"></td>
</tr>
<tr>
<th><label for="">邮寄地址：</label></th>
<td><input type="text" name="profile[address]" value="<?php echo $profile_info['address'];?>"></td>
</tr>
</table>
</div>
</div>
<div class="form-box account-security" id="account-security">
<div class="info-hd">
<span>账号安全</span>
</div>
<div class="info-bd">
<table class="setting-security-table">
<tr>
<th><label for="">手机绑定：</label></th>
<td id="user-tel"><?php echo substr_replace($_G['member']['telephone'], '****', 3, 4);; ?><span class="load"><?php if($_G['member']['telstatus']) { ?>已绑定<?php } else { ?>等待绑定<?php } ?></span>
<?php if($_G['member']['telstatus']) { ?>
<a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-unbindtel">更换手机号</a>
<?php } else { ?>
<a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-bindtel">绑定手机号</a>
<?php } ?>
</td>
</tr>
<tr>
<th><label for="">注册邮箱：</label></th>
<td>
<?php echo $space['email'];?>
<span class="load"><?php if($space['emailstatus']) { ?>已验证<?php } else { ?>等待验证...<?php } ?></span>
<?php if(!$space['emailstatus']) { ?><a href="javascript:void(0);" onclick="resendmail();">重发邮件</a>
<span class="pipe">|</span><?php } ?>
<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-email">更换邮箱</a>
</td>
</tr>
<tr>
<th><label for="">登录密码：</label></th>
<td>
<span class="form-static">******</span>
<a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-pass">修改</a>
</td>
</tr>
<tr>
<th><label for="">安全提问：</label></th>
<td>
<span class="form-static"><?php if($secques_status) { ?>已设置<?php } else { ?>未设置<?php } ?></span>
<a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-answ">修改</a>
</td>
</tr>
</table>
</div>
</div>
<!--<div class="form-box account-setting"><a id="sns"></a>
<div class="info-hd">
<span>账号绑定</span>
</div>
<div class="info-bd">
<p>绑定帐号可以把您的乐趣同步给更多好友。</p>
<div class="controls">
<div class="bindling-item">
<img src="/static/images/wb.jpg" alt="" class="icn size68">
<div class="bindling-tools">
<p>你的新浪微博<span>（未绑定）</span></p>
<a href="javascript:void(0);" class="btn-bindling">绑定新浪微博</a>
</div>
</div>
<div class="bindling-item">
<img src="/static/images/wb.jpg" alt="" class="icn size68">
<div class="bindling-tools binding-lock">
<p>你已经绑定QQ帐号：<em>TL默扬</em></p>
<div class="sync-wrap">
<label class="checkbox-inline">
<input type="checkbox">发帖
</label>
<label class="checkbox-inline">
<input type="checkbox">记录
</label>
<label class="checkbox-inline">
<input type="checkbox">日志
</label>
<label class="checkbox-inline">
<input type="checkbox">添加分享
</label>
<label class="checkbox-inline">
<input type="checkbox">门户文章
</label>
<a href="javascript:void(0);" class="btn-sync">设置同步</a>
</div>
</div>
</div>
</div>
<p>你还没有密码，帐号处于不安全状态。<a href="javascript:void(0);">立即去创建登录密码>></a></p>
</div>
</div>-->
<div class="form-box privacy" id="privacy">
<div class="info-hd">
<span>隐私设置</span>
</div>
<div class="info-bd">
<h3 class="pri-tit">个人主页设置</h3>
<table class="setting-homepage-table">
<tbody>
<tr>
<th>
<label for="">留言板：</label>
</th>
<td>
<select name="privacy[view][wall]">
<option value="0"<?php echo $sels['view']['wall']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['wall']['1'];?>>相互关注的人可见</option>
<option value="2"<?php echo $sels['view']['wall']['2'];?>>保密</option>
<option value="3"<?php echo $sels['view']['wall']['3'];?>>仅注册用户可见</option>
</select>
</td>
<th>
<label for="">分享：</label>
</th>
<td>
<select name="privacy[view][share]">
<option value="0"<?php echo $sels['view']['share']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['share']['1'];?>>相互关注的人可见</option>
<option value="3"<?php echo $sels['view']['share']['3'];?>>仅注册用户可见</option>
</select>
</td>
</tr>
<tr>
<th>
<label for="">说说：</label>
</th>
<td>
<select name="privacy[view][doing]">
<option value="0"<?php echo $sels['view']['doing']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['doing']['1'];?>>相互关注的人可见</option>
<option value="3"<?php echo $sels['view']['doing']['3'];?>>仅注册用户可见</option>
</select>
</td>
<th>
<label for="">日志：</label>
</th>
<td>
<select name="privacy[view][blog]">
<option value="0"<?php echo $sels['view']['blog']['0'];?>>公开</option>
<option value="1"<?php echo $sels['view']['blog']['1'];?>>相互关注的人可见</option>
<option value="3"<?php echo $sels['view']['blog']['3'];?>>仅注册用户可见</option>
</select>
</td>
</tr>
</tbody>
</table>
<?php if(1 != 1) { ?>
<h3 class="pri-tit">动态公开设置</h3>
<p>选中的行为，将展现在你的个人动态列表中。</p>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][doing]" value="1"<?php echo $sels['feed']['doing'];?> />说说
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][blog]" value="1"<?php echo $sels['feed']['blog'];?> />撰写日志
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][newthread]" value="1"<?php echo $sels['feed']['newthread'];?> />论坛发帖
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][upload]" value="1"<?php echo $sels['feed']['upload'];?> />上传图片
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][share]" value="1"<?php echo $sels['feed']['share'];?> />添加分享
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][invite]" value="1"<?php echo $sels['feed']['invite'];?> />邀请好友
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][friend]" value="1"<?php echo $sels['feed']['friend'];?> />添加好友
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][comment]" value="1"<?php echo $sels['feed']['comment'];?> />发表评论/留言
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][newreply]" value="1"<?php echo $sels['feed']['newreply'];?> />论坛回帖
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][show]" value="1"<?php echo $sels['feed']['show'];?> />竞价排名
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][credit]" value="1"<?php echo $sels['feed']['credit'];?> />积分消费
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][click]" value="1"<?php echo $sels['feed']['click'];?> />对日志/图片表态
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][profile]" value="1"<?php echo $sels['feed']['profile'];?> />更新个人资料
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][task]" value="1"<?php echo $sels['feed']['task'];?> />完成任务
</label>
<?php } ?>
<div class="clearfix"></div>
<h3 class="pri-tit">屏蔽设置</h3>
<p>以下是你被屏蔽的好友及屏蔽类型，点击"恢复"可以取消对其的屏蔽。</p><?php $iconnames['wall'] = '留言板';
$iconnames['piccomment'] = '图片评论';
$iconnames['blogcomment'] = '日志评论';
$iconnames['sharecomment'] = '分享评论';
$iconnames['magic'] = '道具';
$iconnames['sharenotice'] = '分享通知';
$iconnames['clickblog'] = '日志表态';
$iconnames['clickpic'] = '图片表态';
$iconnames['credit'] = '积分';
$iconnames['doing'] = '说说';
$iconnames['pcomment'] = '话题点评';
$iconnames['post'] = '话题回复';
$iconnames['show'] = '排行榜';
$iconnames['task'] = '任务';
$iconnames['goods'] = '商品';
$iconnames['group'] = $_G[setting][navs][3][navname];
$iconnames['thread'] = '话题';
$iconnames['system'] = '系统';
$iconnames['friend'] = '好友';
$iconnames['debate'] = '辩论';
$iconnames['album'] = '相册';
$iconnames['blog'] = '日志';
$iconnames['poll'] = '投票';
$iconnames['activity'] = '活动';
$iconnames['reward'] = '悬赏';
$iconnames['share'] = '分享';
$iconnames['profile'] = '更新个人资料';
$iconnames['pusearticle'] = '生成文章';
$iconnames['click'] = '日志/图片表态';
$iconnames['ext_blog_feed'] = '日志阅读邀请';
$iconnames['ext_friend_feed'] = '文章阅读邀请';
$iconnames['report'] = '举报提醒'; ?><table class="setting-shielding-table">
<thead>
<tr>
<th>屏蔽类型</th>
<th>屏蔽内容</th>
<th>屏蔽用户</th>
<th>操作</th>
</tr>
</thead>
<tbody>
<?php if($icons || $types) { if(is_array($icons)) foreach($icons as $key => $icon) { ?><?php $uid = $uids[$key];$icon_uid="$icon|$uid";$dom_id=$icon.'_'.$uid; ?><tr id="<?php echo $dom_id;?>">
<td>动态屏蔽</td>
<td><?php if(isset($iconnames[$icon])) { ?><?php echo $iconnames[$icon];?><?php } else { ?><?php echo $icon;?><?php } ?></td>
<td><?php if($users[$uid]) { ?><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $users[$uid];?></a><?php } else { ?>全部好友<?php } ?></td>
<td><span class="ope-icn" onclick="filter_cancel('filter_icon','<?php echo $icon_uid;?>');">恢复</span></td>
</tr>
<?php } if(is_array($types)) foreach($types as $key => $type) { ?><?php $uid = $uids[$key];$type_uid="$type|$uid"; ?><tr id="<?php echo $type;?>_<?php echo $uid;?>">
<td>通知屏蔽</td>
<td><?php if(isset($iconnames[$type])) { ?><?php echo $iconnames[$type];?><?php } else { ?><?php echo $type;?><?php } ?></td>
<td><?php if($users[$uid]) { ?><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $users[$uid];?></a><?php } else { ?>全部好友<?php } ?></td>
<td><span class="ope-icn" onclick="filter_cancel('filter_note','<?php echo $type_uid;?>');">恢复</span></td>
</tr>
<?php } } else { ?>
<tr>
<td colspan="4">暂无屏蔽记录</td>
</tr>
<?php } ?>
</tbody>
</table>
<p>你可以屏蔽某个关注分组，屏蔽之后将不再显示这个分组内关注的动态。<a href="http://u.8264.com/home-space-do-friend.html" target="_blank">我的关注分组 >></a></p>
<?php if(1 != 1) { if(is_array($groups)) foreach($groups as $key => $value) { ?><label class="checkbox-inline span4">
<input type="checkbox" name="privacy[filter_gid][<?php echo $key;?>]" value="<?php echo $key;?>"<?php if(isset($space['privacy']['filter_gid'][$key])) { ?> checked="checked"<?php } ?> /><?php echo $value;?>
</label>
<?php } } ?>
</div>
</div>
<div class="form-box form-footer">
<button type="submit" class="btn-save" name="dosave" value="true">保存</button>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>" class="goHomepage" target="_blank">前往我的个人主页 >></a>
</div>
</div>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</form>
</div>
</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>修改头像</h3>
<span class="close" data-dismiss="modal">关闭</span>
</div>
<div class="sec-cont">
<div class="form-group">
<form method="post" autocomplete="off" action="home.php?mod=setting&amp;ac=avatar&amp;ref">
<script type="text/javascript">document.write(AC_FL_RunContent('<?php echo implode("','", $uc_avatarflash);; ?>'));</script>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</form>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>修改邮箱</h3>
<span class="close" data-dismiss="modal">关闭</span>
</div>
<div class="sec-cont">
<div class="form-group">
<label class="control-label" for="">密码：</label>
<div class="input-bx">
<input type="password" name="oldpassword" id="oldpwd" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">邮箱：</label>
<div class="input-bx">
<input type="hidden" name="oldemail" value="<?php echo $space['email'];?>" id="oldmail" />
<input type="text" name="email" value="<?php echo $space['email'];?>" id="email" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="changemail">保存</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>修改登录密码</h3>
<span class="close" data-dismiss="modal">关闭</span>
</div>
<div class="sec-cont">
<div class="form-group">
<label class="control-label" for="">旧密码：</label>
<div class="input-bx">
<input type="password" name="oldpassword" id="oldpassword" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">新密码：</label>
<div class="input-bx">
<input type="password" name="newpassword" id="newpassword" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">确认密码：</label>
<div class="input-bx">
<input type="password" name="newpassword2" id="newpassword2" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="password_save">保存</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-answ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>修改安全提问</h3>
<span class="close" data-dismiss="modal">关闭</span>
</div>
<div class="sec-cont">
<div class="form-group">
<label class="control-label" for="">密码：</label>
<div class="input-bx">
<input type="password" name="oldpassword" id="oldpw" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">安全提问：</label>
<div class="input-bx">
<select name="questionidnew" id="questionidnew">
<option value="0">无安全提问</option>
<option value="1">母亲的名字</option>
<option value="2">爷爷的名字</option>
<option value="3">父亲出生的城市</option>
<option value="4">你其中一位老师的名字</option>
<option value="5">你个人计算机的型号</option>
<option value="6">你最喜欢的餐馆名称</option>
<option value="7">驾驶执照最后四位数字</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">回答：</label>
<div class="input-bx">
<input type="text" name="answernew" id="answernew" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="question_save">保存</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php if(1 != 1) { ?>
<div class="modal fade" id="modal-pinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>保密设置</h3>
<span class="close" data-dismiss="modal">关闭</span>
</div>
<div class="sec-cont privacy-data">
<div class="form-group">
<label class="control-label" for="">性别：</label>
<div class="input-bx">
<select name="privacy[profile][gender]" id="gender">
<option value="0"<?php if($space['privacy']['profile']['gender']==0) { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if($space['privacy']['profile']['gender']==1) { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if($space['privacy']['profile']['gender']==3) { ?> selected="selected"<?php } ?>>保密</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">居住城市：</label>
<div class="input-bx">
<select name="privacy[profile][residecity]" id="residecity">
<option value="0"<?php if($space['privacy']['profile']['residecity']==0) { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if($space['privacy']['profile']['residecity']==1) { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if($space['privacy']['profile']['residecity']==3) { ?> selected="selected"<?php } ?>>保密</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">真实姓名：</label>
<div class="input-bx">
<select name="privacy[profile][realname]" id="realname">
<option value="0"<?php if($space['privacy']['profile']['realname']==0) { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if($space['privacy']['profile']['realname']==1) { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if($space['privacy']['profile']['realname']==3) { ?> selected="selected"<?php } ?>>保密</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">证件号：</label>
<div class="input-bx">
<select name="privacy[profile][idcard]" id="idcard">
<option value="0"<?php if($space['privacy']['profile']['idcard']==0) { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if($space['privacy']['profile']['idcard']==1) { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if($space['privacy']['profile']['idcard']==3) { ?> selected="selected"<?php } ?>>保密</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="dosave" value="" id="privacy_save">保存</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-cinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>保密设置</h3>
<span class="close" data-dismiss="modal">关闭</span>
</div>
<div class="sec-cont privacy2-data">
<div class="form-group">
<label class="control-label" for="">手机号：</label>
<div class="input-bx">
<select name="privacy[profile][mobile]" id="mobile">
<option value="0"<?php if($space['privacy']['profile']['mobile']==0) { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if($space['privacy']['profile']['mobile']==1) { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if($space['privacy']['profile']['mobile']==3) { ?> selected="selected"<?php } ?>>保密</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">QQ：</label>
<div class="input-bx">
<select name="privacy[profile][qq]" id="qq">
<option value="0"<?php if($space['privacy']['profile']['qq']==0) { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if($space['privacy']['profile']['qq']==1) { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if($space['privacy']['profile']['qq']==3) { ?> selected="selected"<?php } ?>>保密</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">常用邮箱：</label>
<div class="input-bx">
<select name="privacy[profile][field1]" id="field1">
<option value="0"<?php if($space['privacy']['profile']['field1']==0) { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if($space['privacy']['profile']['field1']==1) { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if($space['privacy']['profile']['field1']==3) { ?> selected="selected"<?php } ?>>保密</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">紧急联系电话：</label>
<div class="input-bx">
<select name="privacy[profile][field2]" id="field2">
<option value="0"<?php if($space['privacy']['profile']['field2']==0) { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if($space['privacy']['profile']['field2']==1) { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if($space['privacy']['profile']['field2']==3) { ?> selected="selected"<?php } ?>>保密</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">邮寄地址：</label>
<div class="input-bx">
<select name="privacy[profile][address]" id="address">
<option value="0"<?php if($space['privacy']['profile']['address']==0) { ?> selected="selected"<?php } ?>>公开</option>
<option value="1"<?php if($space['privacy']['profile']['address']==1) { ?> selected="selected"<?php } ?>>好友可见</option>
<option value="3"<?php if($space['privacy']['profile']['address']==3) { ?> selected="selected"<?php } ?>>保密</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="dosave" value="" id="privacy_save2">保存</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>

<!-- 手机绑定 -->
<style type="text/css">
.input-bx{height:35px;line-height:35px}.get-code{width:120px;height:33px;line-height:33px;border:1px solid #ff942b;color:#ff7e00;background:#fff; float:left;text-align:center;margin-left:10px}.get-code:link{color:#ff7e00;}.tips-buttom{background:#fff7e7;height:44px;line-height:44px;text-align:center;font-size:12px;border-radius:0 0 6px 6px}.tips-buttom img{margin:-3px 4px 0 0}
</style>
<div class="modal fade" id="modal-bindtel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>手机绑定</h3>
<span class="close" data-dismiss="modal">关闭</span>
</div>
<div class="sec-cont">
<div class="form-group">
<label class="control-label" for="">手机号：</label>
<div class="input-bx">
<input type="text" name="telphone" id="telphone" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">验证码：</label>
<div class="input-bx">
<input type="text" name="telcode" value="" id="telcode" autocomplete="off" style="width: 187px;float: left;" /> <input type="button" class="get-code" name="get-code" value="获取验证码" id="sendtelcode" />
</div>
</div>
<div class="form-group" style="height: 28px;">
<label class="control-label" for=""></label>
<div class="input-bx" style="float: left;">
<script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r=<?php echo time();?>" type="text/javascript"></script>
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="bindtel">提交</button>
</div>
</div>
</div>
<div class="tips-buttom">
<p><img src="http://static.8264.com/static/images/tips-hollow.png" alt="">收不到验证码或国外号码，联系管理员QQ：7171608</p>
</div>
</div>
</div>
</div>
</div>
<!-- 手机解绑 -->
<div class="modal fade" id="modal-unbindtel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>手机更换绑定</h3>
<span class="close" data-dismiss="modal">关闭</span>
</div>
<div class="sec-cont unbindteldiv1">
<div class="form-group">
<label class="control-label" for="">旧手机号：</label>
<div class="input-bx">
<span><?php echo substr_replace($_G['member']['telephone'], '****', 3, 4);; ?></span>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">验证码：</label>
<div class="input-bx">
<input type="text" name="telcode" value="" id="telcodeold" autocomplete="off" style="width: 187px;float: left;" /> <input type="button" class="get-code" name="get-code" value="获取验证码" id="sendtelcodeold" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="unbindtelnext">下一步</button>
</div>
</div>
</div>
<div class="sec-cont unbindteldiv2" style="display: none;">
<div class="form-group">
<label class="control-label" for="">手机号：</label>
<div class="input-bx">
<input type="text" name="telphone" id="telphone2" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">验证码：</label>
<div class="input-bx">
<input type="text" name="telcode" value="" id="telcode2" autocomplete="off" style="width: 187px;float: left;" /> <input type="button" class="get-code" name="get-code" value="获取验证码" id="sendtelcode2" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="unbindtel">提交</button>
</div>
</div>
</div>
<div class="tips-buttom">
<p><img src="http://static.8264.com/static/images/tips-hollow.png" alt="">忘记手机号，联系管理员QQ：7171608</p>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-tips" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3></h3>
</div>
</div>
</div>
</div>
</div>

<div class="mask"></div>

<script src="http://static.8264.com/static/js/fixedsticky.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
var countdown=60;
function countDown(val) {
if (countdown == 0) {
val.removeAttribute("disabled");
val.value="获取验证码";
countdown = 60;
val.style = ''
} else {
val.setAttribute('style','background-color:#f0f0f0;border-color:#dfdfdf;color:#aaa;cursor:default');
val.setAttribute("disabled", true);
val.value = countdown + "s后重新获取";
countdown--;

setTimeout(function() {
countDown(val)
},1000)
}
}

jQuery( '.form-footer' ).fixedsticky();
function changecity(province) {
if(province == null) return false;
jQuery.get("home.php", {"mod": "setting", "ac": "getcity", "province": province},
function(data){
jQuery("#city").html(data);
},"html");
}

function resendmail() {
jQuery.get("home.php", {"mod": "setting", "ac": "resend"},function(data){if(data){alert('已发送');}else{alert('短时间内请勿重复发送');}});
}

function filter_cancel(type,str) {
jQuery.get("home.php",{"mod":"setting", "ac":"filter_cancel","privacy_type":type,"privacy_str":str},
function(data){
if(data){
str = str.replace('|','_');
jQuery('#'+str).remove();
if(jQuery(".setting-shielding-table > tbody > tr").length == 0) {
jQuery(".setting-shielding-table > tbody").html('<tr><td colspan="4">暂无屏蔽记录</td></tr>');
}
}else{alert('恢复失败');}
});
}

jQuery(function() {
//个人信息保密设置
jQuery("#privacy_save").click(function(){
var url = '{';
jQuery(".privacy-data select[name^='privacy']").each(function(i,item){
url = url + '"' + item.name + '":"' + item.value + '",';
});
url = url + "'mod':'setting', 'ac':'privacy_save','dosave':'true','formhash':'<?php echo FORMHASH;?>'}";
eval("url = "+url);
jQuery.post("home.php", url,
function(msg){
if(msg == 1){
alert('保存成功');
jQuery(".modal").modal('hide');
return false;
}else{
alert('未知错误，请重试!');return false;
}
});
});
//联系资料保密设置
jQuery("#privacy_save2").click(function(){
var url = '{';
jQuery(".privacy2-data select[name^='privacy']").each(function(i,item){
url = url + '"' + item.name + '":"' + item.value + '",';
});
url = url + "'mod':'setting', 'ac':'privacy_save','dosave':'true','formhash':'<?php echo FORMHASH;?>'}";
eval("url = "+url);
jQuery.post("home.php", url,
function(msg){
if(msg == 1){
alert('保存成功');
jQuery(".modal").modal('hide');
return false;
}else{
alert('未知错误，请重试!');return false;
}
});
});
//更换邮箱
jQuery("#changemail").click(function(){
var oldpassword = jQuery("#oldpwd").val();
var oldmail = jQuery("#oldmail").val();
var email = jQuery("#email").val();
if(oldpassword == ''){alert('旧密码不能为空，请重试');return false;}
if(oldmail == email){alert('邮箱没有变化，无需修改');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"changemail","dosave":"true","formhash":"<?php echo FORMHASH;?>","oldpassword":oldpassword,"oldmail":oldmail,"email":email},
function(msg){
if(msg == -1){
alert('旧密码错误，请重试');return false;
}else if(msg == -2){
alert('旧密码不能为空，请重试');return false;
}else if(msg == -3){
alert('邮箱没有变化，无需修改');return false;
}else if(msg == -4){
alert('Email地址无效');return false;
}else if(msg == -5){
alert('Email包含不可使用的邮箱域名');return false;
}else if(msg == -6){
alert('该Email地址已经被注册');return false;
}else if(msg == 1){
//jQuery("#modal-tips h3").text("修改成功，验证邮件已经发送到您邮箱，请注意查收");
//jQuery("#modal-tips").fadeIn("slow");
//setTimeout(function() {
//	jQuery("#modal-tips").fadeOut("slow");
//}, 3000);
alert('修改成功，验证邮件已经发送到您邮箱，请注意查收');
jQuery(".modal").modal('hide');
}else{
alert('未知错误，请重试!');return false;
}
});
});
//修改密码
jQuery("#password_save").click(function(){
var oldpassword = jQuery("#oldpassword").val();
var newpassword = jQuery("#newpassword").val();
var newpassword2 = jQuery("#newpassword2").val();
if(oldpassword == '' || newpassword == ''){alert('旧密码或新密码不能为空，请重试');return false;}
if(newpassword.length < 6 || newpassword.length > 16 || /^[0-9]+$/.test(newpassword)){alert('新密码长度需在6-16位之内，且非全数字，请重试');return false;}
if(newpassword == oldpassword){alert('新旧密码不能一样，请重试');return false;}
if(newpassword != newpassword2){alert('两次输入密码不一致，请重试');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"password_save","dosave":"true","formhash":"<?php echo FORMHASH;?>","oldpassword":oldpassword,"newpassword":newpassword,"newpassword2":newpassword2},
function(msg){
if(msg == -1){
alert('旧密码错误，请重试');return false;
}else if(msg == -2){
alert('旧密码不能为空，请重试');return false;
}else if(msg == -3){
alert('两次输入密码不一致，请重试');return false;
}else if(msg == -4){
alert('新密码包含非法字符，请重试');return false;
}else if(msg == -5){
alert('密码长度需在6-16位之内，且非全数字，请重试');return false;
}else if(msg == -9){
alert('新旧密码不能一样，请重试');return false;
}else if(msg == 1){
alert('保存成功');
jQuery(".modal").modal('hide');
}else{
alert('未知错误，请重试!');return false;
}
});
});
//修改安全提问
jQuery("#question_save").click(function(){
var oldpassword = jQuery("#oldpw").val();
var questionidnew = jQuery("#questionidnew").val();
var answernew = jQuery("#answernew").val();
if(oldpassword == ''){alert('旧密码不能为空，请重试');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"question_save","dosave":"true","formhash":"<?php echo FORMHASH;?>","oldpassword":oldpassword,"questionidnew":questionidnew,"answernew":answernew},
function(msg){
if(msg == -1){
alert('旧密码错误，请重试');return false;
}else if(msg == -2){
alert('旧密码不能为空，请重试');return false;
}else if(msg == -3){
alert('答案不能为空，请重试');return false;
}else if(msg == 1){
alert('保存成功');
jQuery(".modal").modal('hide');
}else{
alert('未知错误，请重试!');return false;
}
});
});
//获取手机短信验证码
jQuery("#sendtelcode").click(function(){
var telphone = jQuery("#telphone").val();
var geetest_challenge = jQuery("input[name='geetest_challenge']").val();
var geetest_validate = jQuery("input[name='geetest_validate']").val();
var geetest_seccode = jQuery("input[name='geetest_seccode']").val();
if(telphone == ''){alert('手机号不能为空，请重试');return false;}
if(geetest_challenge == '' || geetest_validate == '' || geetest_seccode == ''){alert('请先拖动下方验证码验证通过后再发短信');return false;}
countDown(this);
jQuery.post("home.php",{"mod":"setting", "ac":"sendtelcode","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone,"geetest_challenge":geetest_challenge,"geetest_validate":geetest_validate,"geetest_seccode":geetest_seccode},
// jQuery.post("home.php",{"mod":"setting", "ac":"sendtelcode","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone},
function(msg){
if(msg == -1){
alert('手机号不能为空，请重试');return false;
}else if(msg == -2){
alert('手机号格式有误，请重试');return false;
}else if(msg == -3){
alert('滑动验证码不能为空，请重试');return false;
}else if(msg == -4){
alert('滑动验证码错误，请重试');return false;
}else if(msg == -5){
alert('短信发送失败，如遇多次，请联系客服');return false;
}else if(msg == -6){
alert('短信发送异常，请稍候重试');return false;
}else if(msg == -7){
alert('您发的过于频繁，请过几小时再试');return false;
}else if(msg == -8){
alert('同一号码30s内只能发送一次，请稍候再试');return false;
}else if(msg == -9){
                            alert('同一号码1小时内发送超过3次，请稍候再试');return false;
                        }else if(msg == -10){
                            alert('该手机号已绑定过其他帐号，请换号重试');return false;
                        }else if(msg == 1){
alert('短信发送完成，请稍候接收');
}else{
alert('未知错误，请重试!');return false;
}
});
});
//绑定手机号设置
jQuery("#bindtel").click(function(){
var telphone = jQuery("#telphone").val();
var telcode = jQuery("#telcode").val();
if(telphone == ''){alert('手机号不能为空，请重试');return false;}
if(telcode == ''){alert('手机短信验证码不能为空，请重试');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"bindtel","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone,"telcode":telcode},
function(msg){
if(msg == -1){
alert('手机号不能为空，请重试');return false;
}else if(msg == -2){
alert('手机号不合法，请重试');return false;
}else if(msg == -3){
alert('手机短信验证码不能为空，请重试');return false;
}else if(msg == -4){
alert('手机短信验证码错误，请重试');return false;
}else if(msg == -5){
alert('该手机号已绑定过其他帐号，请换号重试');return false;
}else if(msg == 1){
alert('绑定成功');
jQuery("#user-tel").html(telphone+'<span class="load">已绑定</span><a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-unbindtel">更换手机号</a>');
jQuery(".modal").modal('hide');
}else{
alert('未知错误，请重试!');return false;
}
});
});
//更换绑定获取手机短信验证码
jQuery("#sendtelcodeold").click(function(){
countDown(this);
jQuery.post("home.php",{"mod":"setting", "ac":"sendtelcodeold","dosave":"true","formhash":"<?php echo FORMHASH;?>",},
function(msg){
if(msg == -5){
alert('短信发送失败，如遇多次，请联系客服');return false;
}else if(msg == -6){
alert('短信发送异常，请稍候重试');return false;
}else if(msg == -7){
alert('您发的过于频繁，请过几小时再试');return false;
}else if(msg == -8){
alert('同一号码30s内只能发送一次，请稍候再试');return false;
}else if(msg == -9){
alert('同一号码1小时内发送超过3次，请稍候再试');return false;
}else if(msg == 1){
alert('短信发送完成，请稍候接收');
}else{
alert('未知错误，请重试!');return false;
}
});
});
jQuery("#unbindtelnext").click(function(){
var telcode = jQuery("#telcodeold").val();

if(telcode == ''){alert('旧手机短信验证码不能为空，请重试');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"unbindtelold","dosave":"true","formhash":"<?php echo FORMHASH;?>","telcode":telcode},
function(msg){
if(msg == -3){
alert('手机短信验证码不能为空，请重试');return false;
}else if(msg == -4){
alert('手机短信验证码错误，请重试');return false;
}else if(msg == -5){
alert('该手机号已绑定过其他帐号，请换号重试');return false;
}else if(msg == 1){
jQuery(".unbindteldiv1").hide();
jQuery(".unbindteldiv2").show();
}else{
alert('未知错误，请重试!');return false;
}
});
});
//绑定手机号设置
jQuery("#unbindtel").click(function(){
var telphone = jQuery("#telphone2").val();
var telcode = jQuery("#telcode2").val();
var telcodeold = jQuery("#telcodeold").val();
if(telphone == ''){alert('手机号不能为空，请重试');return false;}
if(telcode == ''){alert('手机短信验证码不能为空，请重试');return false;}
if(telcodeold == ''){alert('旧手机短信验证码不能为空，请重试');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"unbindtel","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone,"telcode":telcode,"telcodeold":telcodeold},
function(msg){
if(msg == -1){
alert('手机号不能为空，请重试');return false;
}else if(msg == -2){
alert('手机号不合法，请重试');return false;
}else if(msg == -3){
alert('手机短信验证码不能为空，请重试');return false;
}else if(msg == -4){
alert('旧手机短信验证码不能为空，请重试');return false;
}else if(msg == -5){
alert('旧手机短信验证码验证不通过，请重试');return false;
}else if(msg == -6){
alert('新手机短信验证码错误，请重试');return false;
}else if(msg == -7){
alert('该手机号已绑定过其他帐号，请换号重试');return false;
}else if(msg == 1){
alert('绑定成功');
jQuery("#user-tel").html(telphone+'<span class="load">已绑定</span><a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-unbindtel">更换手机号</a>');
jQuery(".modal").modal('hide');
}else{
alert('未知错误，请重试!');return false;
}
});
});
//换绑手机短信验证码
jQuery("#sendtelcode2").click(function(){
var telphone = jQuery("#telphone2").val();
if(telphone == ''){alert('手机号不能为空，请重试');return false;}
countDown(this);
jQuery.post("home.php",{"mod":"setting", "ac":"sendtelcode2","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone},
function(msg){
if(msg == -1){
alert('手机号不能为空，请重试');return false;
}else if(msg == -2){
alert('手机号格式有误，请重试');return false;
}else if(msg == -5){
alert('短信发送失败，如遇多次，请联系客服');return false;
}else if(msg == -6){
alert('短信发送异常，请稍候重试');return false;
}else if(msg == -7){
alert('您发的过于频繁，请过几小时再试');return false;
}else if(msg == -8){
alert('同一号码30s内只能发送一次，请稍候再试');return false;
}else if(msg == 1){
alert('短信发送完成，请稍候接收');
}else{
alert('未知错误，请重试!');return false;
}
});
});
jQuery('.mt-menu-tree ul').affix({
  	offset: {
    	top: 74
  	}
});
jQuery('body').scrollspy({ target: '.mt-menu-tree' });
});
</script><?php $nobottomad = false; include template('common/footer_8264_new'); ?>