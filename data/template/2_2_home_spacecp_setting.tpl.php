<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_setting', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/home/setting.css?<?php echo VERHASH;?>">
<div class="container main-container">
<div class="module user-setting-wrap">
<div class="mt-menu-tree">
<ul class="nav nav-tabs nav-stacked">
<li class="active">
<a href="home-setting.html#profile" dataUrl="#profile"><s class="menu-nav-icon icon-1">������Ϣ</s>������Ϣ</a>
</li>
<li>
<a href="home-setting.html#contact-info" dataUrl="#contact-info"><s class="menu-nav-icon icon-2">��ϵ����</s>��ϵ����</a>
</li>
<li>
<a href="home-setting.html#account-security" dataUrl="#account-security"><s class="menu-nav-icon icon-3">�˺Ű�ȫ</s>�˺Ű�ȫ</a>
</li>
<!--<li>
<a href="home-setting.html#sns" dataUrl="#sns"><s class="menu-nav-icon icon-4">�˺Ű�</s>�˺Ű�</a>
</li>-->
<li>
<a href="home-setting.html#privacy" dataUrl="#privacy"><s class="menu-nav-icon icon-5">��˽����</s>��˽����</a>
</li>
</ul>
</div>
<div class="setting-form">
<form method="post" autocomplete="off" action="home.php?mod=setting&amp;ac=savedata">
<div class="main-wrap">
<div class="form-box profile" id="profile">
<div class="info-hd">
<span>������Ϣ</span><?php if(1 != 1) { ?><a href="javascript:void(0);" data-toggle="modal" data-target="#modal-pinfo">��������</a><?php } ?>
</div>
<div class="info-bd">
<table class="setting-profile-table">
<tbody>
<tr>
<th><label for="">�û�����</label></th>
<td><span><?php echo $_G['member']['username'];?></span></td>
</tr>
<tr>
<th><label for="">�Ա�</label></th>
<td>
<div class="radio-inline">
<label>
<input type="radio" value="1" name="profile[gender]"<?php if($profile_info['gender']==1) { ?> checked="ehecked"<?php } ?>>��
</label>
</div>
<div class="radio-inline">
<label>
<input type="radio" value="2" name="profile[gender]"<?php if($profile_info['gender']==2) { ?> checked="ehecked"<?php } ?>>Ů
</label>
</div>
<div class="radio-inline">
<label>
<input type="radio" value="0" name="profile[gender]"<?php if($profile_info['gender']==0) { ?> checked="ehecked"<?php } ?>>����
</label>
</div>
</td>
</tr>
<tr>
<th><label for="">��ס���У�</label></th>
<td>
<?php echo $province_html;?>
<?php echo $city_html;?>
</td>
</tr>
<tr>
<th><label for="">��ʵ������</label></th>
<td><input type="text" name="profile[realname]" value="<?php echo $profile_info['realname'];?>"></td>
</tr>
<tr>
<th><label for="">֤���ţ�</label></th>
<td><input type="text" name="profile[idcard]" value="<?php echo $profile_info['idcard'];?>"></td>
</tr>
<tr>
<th><label for="">ʱ����</label></th>
<td><?php $timeoffset = array(
		'9999' => 'ʹ��ϵͳĬ��',
		'-12' => '(GMT -12:00) �������п˵�, ����ֻ���',
		'-11' => '(GMT -11:00) ��;��, ��Ħ��Ⱥ��',
		'-10' => '(GMT -10:00) ������',
		'-9' => '(GMT -09:00) ����˹��',
		'-8' => '(GMT -08:00) ̫ƽ��ʱ��(�����ͼ��ô�), �Ừ��',
		'-7' => '(GMT -07:00) ɽ��ʱ��(�����ͼ��ô�), ����ɣ��',
		'-6' => '(GMT -06:00) �в�ʱ��(�����ͼ��ô�), ī�����',
		'-5' => '(GMT -05:00) ����ʱ��(�����ͼ��ô�), �����, ����, ����',
		'-4' => '(GMT -04:00) ������ʱ��(���ô�), ������˹, ����˹',
		'-3.5' => '(GMT -03:30) Ŧ����',
		'-3' => '(GMT -03:00) ��������, ����ŵ˹����˹, ���ζ�, ������Ⱥ��',
		'-2' => '(GMT -02:00) �д�����, ��ɭ��Ⱥ��, ʥ�����õ�',
		'-1' => '(GMT -01:00) ����Ⱥ��, ��ý�Ⱥ�� [�������α�׼ʱ��] ������, �׶�, ��˹��, ����������',
		'0' => '(GMT) �����������������֣����������׶أ���˹��������ά��',
		'1' => '(GMT +01:00) ����, ��³����, �籾����, �����, ����, ����',
		'2' => '(GMT +02:00) �ն�����, ����������, �Ϸ�, ��ɳ',
		'3' => '(GMT +03:00) �͸��, ���ŵ�, Ī˹��, �����',
		'3.5' => '(GMT +03:30) �º���',
		'4' => '(GMT +04:00) ��������, �Ϳ�, ��˹����, �ر���˹',
		'4.5' => '(GMT +04:30) ������',
		'5' => '(GMT +05:00) Ҷ�����ձ�, ��˹����, ������, ��ʲ��',
		'5.5' => '(GMT +05:30) ����, �Ӷ�����, �����˹, �µ���',
		'5.75' => '(GMT +05:45) �ӵ�����',
		'6' => '(GMT +06:00) ����ľͼ, ������, �￨, ����������',
		'6.5' => '(GMT +06:30) ����',
		'7' => '(GMT +07:00) ����, ����, �żӴ�',
		'8' => '(GMT +08:00) ����, ���, ��˹, �¼���, ̨��',
		'9' => '(GMT +09:00) ����, ����, �׶�, ����, �ſ�Ŀ�',
		'9.5' => '(GMT +09:30) ��������, �����',
		'10' => '(GMT +10:00) ������, �ص�, ī����, Ϥ��, ������',
		'11' => '(GMT +11:00) ��ӵ�, �¿��������, ������Ⱥ��',
		'12' => '(GMT +12:00) �¿���, �����, 쳼�, ���ܶ�Ⱥ��'); ?><select name="member[timeoffset]"><?php if(is_array($timeoffset)) foreach($timeoffset as $key => $desc) { ?><option value="<?php echo $key;?>"<?php if($key==$space['timeoffset']) { ?> selected="selected"<?php } ?>><?php echo $desc;?></option>
<?php } ?>
</select>
</td>
</tr>
</tbody>
</table>
<div class="setting-profile-avtar"><?php echo avatar($space[uid], big, false, false, false, '', true); ?><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">�޸�ͷ��</a>
</div>
<div style="clear:both;"></div>
</div>
</div>
<div class="form-box contact-info" id="contact-info">
<div class="info-hd">
<span>��ϵ����</span><?php if(1 != 1) { ?><a href="javascript:void(0);" data-toggle="modal" data-target="#modal-cinfo">��������</a><?php } ?>
</div>
<div class="info-bd">
<table class="setting-continfo-table">
<tr>
<th><label for="">�ֻ��ţ�</label></th>
<td><input type="text" name="profile[mobile]" value="<?php echo $profile_info['mobile'];?>"></td>
</tr>
<tr>
<th><label for="">QQ��</label></th>
<td><input type="text" name="profile[qq]" value="<?php echo $profile_info['qq'];?>"></td>
</tr>
<tr>
<th><label for="">�������䣺</label></th>
<td><input type="text" name="profile[field1]" value="<?php echo $profile_info['used_email'];?>"></td>
</tr>
<tr>
<th><label for="">������ϵ�绰��</label></th>
<td><input type="text" name="profile[field2]" value="<?php echo $profile_info['used_mobile'];?>"></td>
</tr>
<tr>
<th><label for="">�ʼĵ�ַ��</label></th>
<td><input type="text" name="profile[address]" value="<?php echo $profile_info['address'];?>"></td>
</tr>
</table>
</div>
</div>
<div class="form-box account-security" id="account-security">
<div class="info-hd">
<span>�˺Ű�ȫ</span>
</div>
<div class="info-bd">
<table class="setting-security-table">
<tr>
<th><label for="">�ֻ��󶨣�</label></th>
<td id="user-tel"><?php echo substr_replace($_G['member']['telephone'], '****', 3, 4);; ?><span class="load"><?php if($_G['member']['telstatus']) { ?>�Ѱ�<?php } else { ?>�ȴ���<?php } ?></span>
<?php if($_G['member']['telstatus']) { ?>
<a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-unbindtel">�����ֻ���</a>
<?php } else { ?>
<a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-bindtel">���ֻ���</a>
<?php } ?>
</td>
</tr>
<tr>
<th><label for="">ע�����䣺</label></th>
<td>
<?php echo $space['email'];?>
<span class="load"><?php if($space['emailstatus']) { ?>����֤<?php } else { ?>�ȴ���֤...<?php } ?></span>
<?php if(!$space['emailstatus']) { ?><a href="javascript:void(0);" onclick="resendmail();">�ط��ʼ�</a>
<span class="pipe">|</span><?php } ?>
<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-email">��������</a>
</td>
</tr>
<tr>
<th><label for="">��¼���룺</label></th>
<td>
<span class="form-static">******</span>
<a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-pass">�޸�</a>
</td>
</tr>
<tr>
<th><label for="">��ȫ���ʣ�</label></th>
<td>
<span class="form-static"><?php if($secques_status) { ?>������<?php } else { ?>δ����<?php } ?></span>
<a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-answ">�޸�</a>
</td>
</tr>
</table>
</div>
</div>
<!--<div class="form-box account-setting"><a id="sns"></a>
<div class="info-hd">
<span>�˺Ű�</span>
</div>
<div class="info-bd">
<p>���ʺſ��԰�������Ȥͬ����������ѡ�</p>
<div class="controls">
<div class="bindling-item">
<img src="/static/images/wb.jpg" alt="" class="icn size68">
<div class="bindling-tools">
<p>�������΢��<span>��δ�󶨣�</span></p>
<a href="javascript:void(0);" class="btn-bindling">������΢��</a>
</div>
</div>
<div class="bindling-item">
<img src="/static/images/wb.jpg" alt="" class="icn size68">
<div class="bindling-tools binding-lock">
<p>���Ѿ���QQ�ʺţ�<em>TLĬ��</em></p>
<div class="sync-wrap">
<label class="checkbox-inline">
<input type="checkbox">����
</label>
<label class="checkbox-inline">
<input type="checkbox">��¼
</label>
<label class="checkbox-inline">
<input type="checkbox">��־
</label>
<label class="checkbox-inline">
<input type="checkbox">��ӷ���
</label>
<label class="checkbox-inline">
<input type="checkbox">�Ż�����
</label>
<a href="javascript:void(0);" class="btn-sync">����ͬ��</a>
</div>
</div>
</div>
</div>
<p>�㻹û�����룬�ʺŴ��ڲ���ȫ״̬��<a href="javascript:void(0);">����ȥ������¼����>></a></p>
</div>
</div>-->
<div class="form-box privacy" id="privacy">
<div class="info-hd">
<span>��˽����</span>
</div>
<div class="info-bd">
<h3 class="pri-tit">������ҳ����</h3>
<table class="setting-homepage-table">
<tbody>
<tr>
<th>
<label for="">���԰壺</label>
</th>
<td>
<select name="privacy[view][wall]">
<option value="0"<?php echo $sels['view']['wall']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['wall']['1'];?>>�໥��ע���˿ɼ�</option>
<option value="2"<?php echo $sels['view']['wall']['2'];?>>����</option>
<option value="3"<?php echo $sels['view']['wall']['3'];?>>��ע���û��ɼ�</option>
</select>
</td>
<th>
<label for="">����</label>
</th>
<td>
<select name="privacy[view][share]">
<option value="0"<?php echo $sels['view']['share']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['share']['1'];?>>�໥��ע���˿ɼ�</option>
<option value="3"<?php echo $sels['view']['share']['3'];?>>��ע���û��ɼ�</option>
</select>
</td>
</tr>
<tr>
<th>
<label for="">˵˵��</label>
</th>
<td>
<select name="privacy[view][doing]">
<option value="0"<?php echo $sels['view']['doing']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['doing']['1'];?>>�໥��ע���˿ɼ�</option>
<option value="3"<?php echo $sels['view']['doing']['3'];?>>��ע���û��ɼ�</option>
</select>
</td>
<th>
<label for="">��־��</label>
</th>
<td>
<select name="privacy[view][blog]">
<option value="0"<?php echo $sels['view']['blog']['0'];?>>����</option>
<option value="1"<?php echo $sels['view']['blog']['1'];?>>�໥��ע���˿ɼ�</option>
<option value="3"<?php echo $sels['view']['blog']['3'];?>>��ע���û��ɼ�</option>
</select>
</td>
</tr>
</tbody>
</table>
<?php if(1 != 1) { ?>
<h3 class="pri-tit">��̬��������</h3>
<p>ѡ�е���Ϊ����չ������ĸ��˶�̬�б��С�</p>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][doing]" value="1"<?php echo $sels['feed']['doing'];?> />˵˵
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][blog]" value="1"<?php echo $sels['feed']['blog'];?> />׫д��־
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][newthread]" value="1"<?php echo $sels['feed']['newthread'];?> />��̳����
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][upload]" value="1"<?php echo $sels['feed']['upload'];?> />�ϴ�ͼƬ
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][share]" value="1"<?php echo $sels['feed']['share'];?> />��ӷ���
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][invite]" value="1"<?php echo $sels['feed']['invite'];?> />�������
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][friend]" value="1"<?php echo $sels['feed']['friend'];?> />��Ӻ���
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][comment]" value="1"<?php echo $sels['feed']['comment'];?> />��������/����
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][newreply]" value="1"<?php echo $sels['feed']['newreply'];?> />��̳����
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][show]" value="1"<?php echo $sels['feed']['show'];?> />��������
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][credit]" value="1"<?php echo $sels['feed']['credit'];?> />��������
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][click]" value="1"<?php echo $sels['feed']['click'];?> />����־/ͼƬ��̬
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][profile]" value="1"<?php echo $sels['feed']['profile'];?> />���¸�������
</label>
<label class="checkbox-inline span3">
<input type="checkbox" name="privacy[feed][task]" value="1"<?php echo $sels['feed']['task'];?> />�������
</label>
<?php } ?>
<div class="clearfix"></div>
<h3 class="pri-tit">��������</h3>
<p>�������㱻���εĺ��Ѽ��������ͣ����"�ָ�"����ȡ����������Ρ�</p><?php $iconnames['wall'] = '���԰�';
$iconnames['piccomment'] = 'ͼƬ����';
$iconnames['blogcomment'] = '��־����';
$iconnames['sharecomment'] = '��������';
$iconnames['magic'] = '����';
$iconnames['sharenotice'] = '����֪ͨ';
$iconnames['clickblog'] = '��־��̬';
$iconnames['clickpic'] = 'ͼƬ��̬';
$iconnames['credit'] = '����';
$iconnames['doing'] = '˵˵';
$iconnames['pcomment'] = '�������';
$iconnames['post'] = '����ظ�';
$iconnames['show'] = '���а�';
$iconnames['task'] = '����';
$iconnames['goods'] = '��Ʒ';
$iconnames['group'] = $_G[setting][navs][3][navname];
$iconnames['thread'] = '����';
$iconnames['system'] = 'ϵͳ';
$iconnames['friend'] = '����';
$iconnames['debate'] = '����';
$iconnames['album'] = '���';
$iconnames['blog'] = '��־';
$iconnames['poll'] = 'ͶƱ';
$iconnames['activity'] = '�';
$iconnames['reward'] = '����';
$iconnames['share'] = '����';
$iconnames['profile'] = '���¸�������';
$iconnames['pusearticle'] = '��������';
$iconnames['click'] = '��־/ͼƬ��̬';
$iconnames['ext_blog_feed'] = '��־�Ķ�����';
$iconnames['ext_friend_feed'] = '�����Ķ�����';
$iconnames['report'] = '�ٱ�����'; ?><table class="setting-shielding-table">
<thead>
<tr>
<th>��������</th>
<th>��������</th>
<th>�����û�</th>
<th>����</th>
</tr>
</thead>
<tbody>
<?php if($icons || $types) { if(is_array($icons)) foreach($icons as $key => $icon) { ?><?php $uid = $uids[$key];$icon_uid="$icon|$uid";$dom_id=$icon.'_'.$uid; ?><tr id="<?php echo $dom_id;?>">
<td>��̬����</td>
<td><?php if(isset($iconnames[$icon])) { ?><?php echo $iconnames[$icon];?><?php } else { ?><?php echo $icon;?><?php } ?></td>
<td><?php if($users[$uid]) { ?><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $users[$uid];?></a><?php } else { ?>ȫ������<?php } ?></td>
<td><span class="ope-icn" onclick="filter_cancel('filter_icon','<?php echo $icon_uid;?>');">�ָ�</span></td>
</tr>
<?php } if(is_array($types)) foreach($types as $key => $type) { ?><?php $uid = $uids[$key];$type_uid="$type|$uid"; ?><tr id="<?php echo $type;?>_<?php echo $uid;?>">
<td>֪ͨ����</td>
<td><?php if(isset($iconnames[$type])) { ?><?php echo $iconnames[$type];?><?php } else { ?><?php echo $type;?><?php } ?></td>
<td><?php if($users[$uid]) { ?><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $users[$uid];?></a><?php } else { ?>ȫ������<?php } ?></td>
<td><span class="ope-icn" onclick="filter_cancel('filter_note','<?php echo $type_uid;?>');">�ָ�</span></td>
</tr>
<?php } } else { ?>
<tr>
<td colspan="4">�������μ�¼</td>
</tr>
<?php } ?>
</tbody>
</table>
<p>���������ĳ����ע���飬����֮�󽫲�����ʾ��������ڹ�ע�Ķ�̬��<a href="http://u.8264.com/home-space-do-friend.html" target="_blank">�ҵĹ�ע���� >></a></p>
<?php if(1 != 1) { if(is_array($groups)) foreach($groups as $key => $value) { ?><label class="checkbox-inline span4">
<input type="checkbox" name="privacy[filter_gid][<?php echo $key;?>]" value="<?php echo $key;?>"<?php if(isset($space['privacy']['filter_gid'][$key])) { ?> checked="checked"<?php } ?> /><?php echo $value;?>
</label>
<?php } } ?>
</div>
</div>
<div class="form-box form-footer">
<button type="submit" class="btn-save" name="dosave" value="true">����</button>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>" class="goHomepage" target="_blank">ǰ���ҵĸ�����ҳ >></a>
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
<h3>�޸�ͷ��</h3>
<span class="close" data-dismiss="modal">�ر�</span>
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
<h3>�޸�����</h3>
<span class="close" data-dismiss="modal">�ر�</span>
</div>
<div class="sec-cont">
<div class="form-group">
<label class="control-label" for="">���룺</label>
<div class="input-bx">
<input type="password" name="oldpassword" id="oldpwd" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">���䣺</label>
<div class="input-bx">
<input type="hidden" name="oldemail" value="<?php echo $space['email'];?>" id="oldmail" />
<input type="text" name="email" value="<?php echo $space['email'];?>" id="email" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="changemail">����</button>
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
<h3>�޸ĵ�¼����</h3>
<span class="close" data-dismiss="modal">�ر�</span>
</div>
<div class="sec-cont">
<div class="form-group">
<label class="control-label" for="">�����룺</label>
<div class="input-bx">
<input type="password" name="oldpassword" id="oldpassword" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">�����룺</label>
<div class="input-bx">
<input type="password" name="newpassword" id="newpassword" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">ȷ�����룺</label>
<div class="input-bx">
<input type="password" name="newpassword2" id="newpassword2" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="password_save">����</button>
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
<h3>�޸İ�ȫ����</h3>
<span class="close" data-dismiss="modal">�ر�</span>
</div>
<div class="sec-cont">
<div class="form-group">
<label class="control-label" for="">���룺</label>
<div class="input-bx">
<input type="password" name="oldpassword" id="oldpw" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">��ȫ���ʣ�</label>
<div class="input-bx">
<select name="questionidnew" id="questionidnew">
<option value="0">�ް�ȫ����</option>
<option value="1">ĸ�׵�����</option>
<option value="2">үү������</option>
<option value="3">���׳����ĳ���</option>
<option value="4">������һλ��ʦ������</option>
<option value="5">����˼�������ͺ�</option>
<option value="6">����ϲ���Ĳ͹�����</option>
<option value="7">��ʻִ�������λ����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">�ش�</label>
<div class="input-bx">
<input type="text" name="answernew" id="answernew" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="question_save">����</button>
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
<h3>��������</h3>
<span class="close" data-dismiss="modal">�ر�</span>
</div>
<div class="sec-cont privacy-data">
<div class="form-group">
<label class="control-label" for="">�Ա�</label>
<div class="input-bx">
<select name="privacy[profile][gender]" id="gender">
<option value="0"<?php if($space['privacy']['profile']['gender']==0) { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($space['privacy']['profile']['gender']==1) { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($space['privacy']['profile']['gender']==3) { ?> selected="selected"<?php } ?>>����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">��ס���У�</label>
<div class="input-bx">
<select name="privacy[profile][residecity]" id="residecity">
<option value="0"<?php if($space['privacy']['profile']['residecity']==0) { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($space['privacy']['profile']['residecity']==1) { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($space['privacy']['profile']['residecity']==3) { ?> selected="selected"<?php } ?>>����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">��ʵ������</label>
<div class="input-bx">
<select name="privacy[profile][realname]" id="realname">
<option value="0"<?php if($space['privacy']['profile']['realname']==0) { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($space['privacy']['profile']['realname']==1) { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($space['privacy']['profile']['realname']==3) { ?> selected="selected"<?php } ?>>����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">֤���ţ�</label>
<div class="input-bx">
<select name="privacy[profile][idcard]" id="idcard">
<option value="0"<?php if($space['privacy']['profile']['idcard']==0) { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($space['privacy']['profile']['idcard']==1) { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($space['privacy']['profile']['idcard']==3) { ?> selected="selected"<?php } ?>>����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="dosave" value="" id="privacy_save">����</button>
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
<h3>��������</h3>
<span class="close" data-dismiss="modal">�ر�</span>
</div>
<div class="sec-cont privacy2-data">
<div class="form-group">
<label class="control-label" for="">�ֻ��ţ�</label>
<div class="input-bx">
<select name="privacy[profile][mobile]" id="mobile">
<option value="0"<?php if($space['privacy']['profile']['mobile']==0) { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($space['privacy']['profile']['mobile']==1) { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($space['privacy']['profile']['mobile']==3) { ?> selected="selected"<?php } ?>>����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">QQ��</label>
<div class="input-bx">
<select name="privacy[profile][qq]" id="qq">
<option value="0"<?php if($space['privacy']['profile']['qq']==0) { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($space['privacy']['profile']['qq']==1) { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($space['privacy']['profile']['qq']==3) { ?> selected="selected"<?php } ?>>����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">�������䣺</label>
<div class="input-bx">
<select name="privacy[profile][field1]" id="field1">
<option value="0"<?php if($space['privacy']['profile']['field1']==0) { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($space['privacy']['profile']['field1']==1) { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($space['privacy']['profile']['field1']==3) { ?> selected="selected"<?php } ?>>����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">������ϵ�绰��</label>
<div class="input-bx">
<select name="privacy[profile][field2]" id="field2">
<option value="0"<?php if($space['privacy']['profile']['field2']==0) { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($space['privacy']['profile']['field2']==1) { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($space['privacy']['profile']['field2']==3) { ?> selected="selected"<?php } ?>>����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">�ʼĵ�ַ��</label>
<div class="input-bx">
<select name="privacy[profile][address]" id="address">
<option value="0"<?php if($space['privacy']['profile']['address']==0) { ?> selected="selected"<?php } ?>>����</option>
<option value="1"<?php if($space['privacy']['profile']['address']==1) { ?> selected="selected"<?php } ?>>���ѿɼ�</option>
<option value="3"<?php if($space['privacy']['profile']['address']==3) { ?> selected="selected"<?php } ?>>����</option>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="dosave" value="" id="privacy_save2">����</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>

<!-- �ֻ��� -->
<style type="text/css">
.input-bx{height:35px;line-height:35px}.get-code{width:120px;height:33px;line-height:33px;border:1px solid #ff942b;color:#ff7e00;background:#fff; float:left;text-align:center;margin-left:10px}.get-code:link{color:#ff7e00;}.tips-buttom{background:#fff7e7;height:44px;line-height:44px;text-align:center;font-size:12px;border-radius:0 0 6px 6px}.tips-buttom img{margin:-3px 4px 0 0}
</style>
<div class="modal fade" id="modal-bindtel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>�ֻ���</h3>
<span class="close" data-dismiss="modal">�ر�</span>
</div>
<div class="sec-cont">
<div class="form-group">
<label class="control-label" for="">�ֻ��ţ�</label>
<div class="input-bx">
<input type="text" name="telphone" id="telphone" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">��֤�룺</label>
<div class="input-bx">
<input type="text" name="telcode" value="" id="telcode" autocomplete="off" style="width: 187px;float: left;" /> <input type="button" class="get-code" name="get-code" value="��ȡ��֤��" id="sendtelcode" />
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
<button type="button" class="btn-save" name="btn-save" value="" id="bindtel">�ύ</button>
</div>
</div>
</div>
<div class="tips-buttom">
<p><img src="http://static.8264.com/static/images/tips-hollow.png" alt="">�ղ�����֤��������룬��ϵ����ԱQQ��7171608</p>
</div>
</div>
</div>
</div>
</div>
<!-- �ֻ���� -->
<div class="modal fade" id="modal-unbindtel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="thickbox">
<div class="tit-bx">
<h3>�ֻ�������</h3>
<span class="close" data-dismiss="modal">�ر�</span>
</div>
<div class="sec-cont unbindteldiv1">
<div class="form-group">
<label class="control-label" for="">���ֻ��ţ�</label>
<div class="input-bx">
<span><?php echo substr_replace($_G['member']['telephone'], '****', 3, 4);; ?></span>
</div>
</div>
<div class="form-group">
<label class="control-label" for="">��֤�룺</label>
<div class="input-bx">
<input type="text" name="telcode" value="" id="telcodeold" autocomplete="off" style="width: 187px;float: left;" /> <input type="button" class="get-code" name="get-code" value="��ȡ��֤��" id="sendtelcodeold" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="unbindtelnext">��һ��</button>
</div>
</div>
</div>
<div class="sec-cont unbindteldiv2" style="display: none;">
<div class="form-group">
<label class="control-label" for="">�ֻ��ţ�</label>
<div class="input-bx">
<input type="text" name="telphone" id="telphone2" />
</div>
</div>
<div class="form-group">
<label class="control-label" for="">��֤�룺</label>
<div class="input-bx">
<input type="text" name="telcode" value="" id="telcode2" autocomplete="off" style="width: 187px;float: left;" /> <input type="button" class="get-code" name="get-code" value="��ȡ��֤��" id="sendtelcode2" />
</div>
</div>
<div class="form-group">
<label class="control-label" for=""></label>
<div class="input-bx">
<button type="button" class="btn-save" name="btn-save" value="" id="unbindtel">�ύ</button>
</div>
</div>
</div>
<div class="tips-buttom">
<p><img src="http://static.8264.com/static/images/tips-hollow.png" alt="">�����ֻ��ţ���ϵ����ԱQQ��7171608</p>
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
val.value="��ȡ��֤��";
countdown = 60;
val.style = ''
} else {
val.setAttribute('style','background-color:#f0f0f0;border-color:#dfdfdf;color:#aaa;cursor:default');
val.setAttribute("disabled", true);
val.value = countdown + "s�����»�ȡ";
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
jQuery.get("home.php", {"mod": "setting", "ac": "resend"},function(data){if(data){alert('�ѷ���');}else{alert('��ʱ���������ظ�����');}});
}

function filter_cancel(type,str) {
jQuery.get("home.php",{"mod":"setting", "ac":"filter_cancel","privacy_type":type,"privacy_str":str},
function(data){
if(data){
str = str.replace('|','_');
jQuery('#'+str).remove();
if(jQuery(".setting-shielding-table > tbody > tr").length == 0) {
jQuery(".setting-shielding-table > tbody").html('<tr><td colspan="4">�������μ�¼</td></tr>');
}
}else{alert('�ָ�ʧ��');}
});
}

jQuery(function() {
//������Ϣ��������
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
alert('����ɹ�');
jQuery(".modal").modal('hide');
return false;
}else{
alert('δ֪����������!');return false;
}
});
});
//��ϵ���ϱ�������
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
alert('����ɹ�');
jQuery(".modal").modal('hide');
return false;
}else{
alert('δ֪����������!');return false;
}
});
});
//��������
jQuery("#changemail").click(function(){
var oldpassword = jQuery("#oldpwd").val();
var oldmail = jQuery("#oldmail").val();
var email = jQuery("#email").val();
if(oldpassword == ''){alert('�����벻��Ϊ�գ�������');return false;}
if(oldmail == email){alert('����û�б仯�������޸�');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"changemail","dosave":"true","formhash":"<?php echo FORMHASH;?>","oldpassword":oldpassword,"oldmail":oldmail,"email":email},
function(msg){
if(msg == -1){
alert('���������������');return false;
}else if(msg == -2){
alert('�����벻��Ϊ�գ�������');return false;
}else if(msg == -3){
alert('����û�б仯�������޸�');return false;
}else if(msg == -4){
alert('Email��ַ��Ч');return false;
}else if(msg == -5){
alert('Email��������ʹ�õ���������');return false;
}else if(msg == -6){
alert('��Email��ַ�Ѿ���ע��');return false;
}else if(msg == 1){
//jQuery("#modal-tips h3").text("�޸ĳɹ�����֤�ʼ��Ѿ����͵������䣬��ע�����");
//jQuery("#modal-tips").fadeIn("slow");
//setTimeout(function() {
//	jQuery("#modal-tips").fadeOut("slow");
//}, 3000);
alert('�޸ĳɹ�����֤�ʼ��Ѿ����͵������䣬��ע�����');
jQuery(".modal").modal('hide');
}else{
alert('δ֪����������!');return false;
}
});
});
//�޸�����
jQuery("#password_save").click(function(){
var oldpassword = jQuery("#oldpassword").val();
var newpassword = jQuery("#newpassword").val();
var newpassword2 = jQuery("#newpassword2").val();
if(oldpassword == '' || newpassword == ''){alert('������������벻��Ϊ�գ�������');return false;}
if(newpassword.length < 6 || newpassword.length > 16 || /^[0-9]+$/.test(newpassword)){alert('�����볤������6-16λ֮�ڣ��ҷ�ȫ���֣�������');return false;}
if(newpassword == oldpassword){alert('�¾����벻��һ����������');return false;}
if(newpassword != newpassword2){alert('�����������벻һ�£�������');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"password_save","dosave":"true","formhash":"<?php echo FORMHASH;?>","oldpassword":oldpassword,"newpassword":newpassword,"newpassword2":newpassword2},
function(msg){
if(msg == -1){
alert('���������������');return false;
}else if(msg == -2){
alert('�����벻��Ϊ�գ�������');return false;
}else if(msg == -3){
alert('�����������벻һ�£�������');return false;
}else if(msg == -4){
alert('����������Ƿ��ַ���������');return false;
}else if(msg == -5){
alert('���볤������6-16λ֮�ڣ��ҷ�ȫ���֣�������');return false;
}else if(msg == -9){
alert('�¾����벻��һ����������');return false;
}else if(msg == 1){
alert('����ɹ�');
jQuery(".modal").modal('hide');
}else{
alert('δ֪����������!');return false;
}
});
});
//�޸İ�ȫ����
jQuery("#question_save").click(function(){
var oldpassword = jQuery("#oldpw").val();
var questionidnew = jQuery("#questionidnew").val();
var answernew = jQuery("#answernew").val();
if(oldpassword == ''){alert('�����벻��Ϊ�գ�������');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"question_save","dosave":"true","formhash":"<?php echo FORMHASH;?>","oldpassword":oldpassword,"questionidnew":questionidnew,"answernew":answernew},
function(msg){
if(msg == -1){
alert('���������������');return false;
}else if(msg == -2){
alert('�����벻��Ϊ�գ�������');return false;
}else if(msg == -3){
alert('�𰸲���Ϊ�գ�������');return false;
}else if(msg == 1){
alert('����ɹ�');
jQuery(".modal").modal('hide');
}else{
alert('δ֪����������!');return false;
}
});
});
//��ȡ�ֻ�������֤��
jQuery("#sendtelcode").click(function(){
var telphone = jQuery("#telphone").val();
var geetest_challenge = jQuery("input[name='geetest_challenge']").val();
var geetest_validate = jQuery("input[name='geetest_validate']").val();
var geetest_seccode = jQuery("input[name='geetest_seccode']").val();
if(telphone == ''){alert('�ֻ��Ų���Ϊ�գ�������');return false;}
if(geetest_challenge == '' || geetest_validate == '' || geetest_seccode == ''){alert('�����϶��·���֤����֤ͨ�����ٷ�����');return false;}
countDown(this);
jQuery.post("home.php",{"mod":"setting", "ac":"sendtelcode","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone,"geetest_challenge":geetest_challenge,"geetest_validate":geetest_validate,"geetest_seccode":geetest_seccode},
// jQuery.post("home.php",{"mod":"setting", "ac":"sendtelcode","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone},
function(msg){
if(msg == -1){
alert('�ֻ��Ų���Ϊ�գ�������');return false;
}else if(msg == -2){
alert('�ֻ��Ÿ�ʽ����������');return false;
}else if(msg == -3){
alert('������֤�벻��Ϊ�գ�������');return false;
}else if(msg == -4){
alert('������֤�����������');return false;
}else if(msg == -5){
alert('���ŷ���ʧ�ܣ�������Σ�����ϵ�ͷ�');return false;
}else if(msg == -6){
alert('���ŷ����쳣�����Ժ�����');return false;
}else if(msg == -7){
alert('�����Ĺ���Ƶ���������Сʱ����');return false;
}else if(msg == -8){
alert('ͬһ����30s��ֻ�ܷ���һ�Σ����Ժ�����');return false;
}else if(msg == -9){
                            alert('ͬһ����1Сʱ�ڷ��ͳ���3�Σ����Ժ�����');return false;
                        }else if(msg == -10){
                            alert('���ֻ����Ѱ󶨹������ʺţ��뻻������');return false;
                        }else if(msg == 1){
alert('���ŷ�����ɣ����Ժ����');
}else{
alert('δ֪����������!');return false;
}
});
});
//���ֻ�������
jQuery("#bindtel").click(function(){
var telphone = jQuery("#telphone").val();
var telcode = jQuery("#telcode").val();
if(telphone == ''){alert('�ֻ��Ų���Ϊ�գ�������');return false;}
if(telcode == ''){alert('�ֻ�������֤�벻��Ϊ�գ�������');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"bindtel","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone,"telcode":telcode},
function(msg){
if(msg == -1){
alert('�ֻ��Ų���Ϊ�գ�������');return false;
}else if(msg == -2){
alert('�ֻ��Ų��Ϸ���������');return false;
}else if(msg == -3){
alert('�ֻ�������֤�벻��Ϊ�գ�������');return false;
}else if(msg == -4){
alert('�ֻ�������֤�����������');return false;
}else if(msg == -5){
alert('���ֻ����Ѱ󶨹������ʺţ��뻻������');return false;
}else if(msg == 1){
alert('�󶨳ɹ�');
jQuery("#user-tel").html(telphone+'<span class="load">�Ѱ�</span><a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-unbindtel">�����ֻ���</a>');
jQuery(".modal").modal('hide');
}else{
alert('δ֪����������!');return false;
}
});
});
//�����󶨻�ȡ�ֻ�������֤��
jQuery("#sendtelcodeold").click(function(){
countDown(this);
jQuery.post("home.php",{"mod":"setting", "ac":"sendtelcodeold","dosave":"true","formhash":"<?php echo FORMHASH;?>",},
function(msg){
if(msg == -5){
alert('���ŷ���ʧ�ܣ�������Σ�����ϵ�ͷ�');return false;
}else if(msg == -6){
alert('���ŷ����쳣�����Ժ�����');return false;
}else if(msg == -7){
alert('�����Ĺ���Ƶ���������Сʱ����');return false;
}else if(msg == -8){
alert('ͬһ����30s��ֻ�ܷ���һ�Σ����Ժ�����');return false;
}else if(msg == -9){
alert('ͬһ����1Сʱ�ڷ��ͳ���3�Σ����Ժ�����');return false;
}else if(msg == 1){
alert('���ŷ�����ɣ����Ժ����');
}else{
alert('δ֪����������!');return false;
}
});
});
jQuery("#unbindtelnext").click(function(){
var telcode = jQuery("#telcodeold").val();

if(telcode == ''){alert('���ֻ�������֤�벻��Ϊ�գ�������');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"unbindtelold","dosave":"true","formhash":"<?php echo FORMHASH;?>","telcode":telcode},
function(msg){
if(msg == -3){
alert('�ֻ�������֤�벻��Ϊ�գ�������');return false;
}else if(msg == -4){
alert('�ֻ�������֤�����������');return false;
}else if(msg == -5){
alert('���ֻ����Ѱ󶨹������ʺţ��뻻������');return false;
}else if(msg == 1){
jQuery(".unbindteldiv1").hide();
jQuery(".unbindteldiv2").show();
}else{
alert('δ֪����������!');return false;
}
});
});
//���ֻ�������
jQuery("#unbindtel").click(function(){
var telphone = jQuery("#telphone2").val();
var telcode = jQuery("#telcode2").val();
var telcodeold = jQuery("#telcodeold").val();
if(telphone == ''){alert('�ֻ��Ų���Ϊ�գ�������');return false;}
if(telcode == ''){alert('�ֻ�������֤�벻��Ϊ�գ�������');return false;}
if(telcodeold == ''){alert('���ֻ�������֤�벻��Ϊ�գ�������');return false;}
jQuery.post("home.php",{"mod":"setting", "ac":"unbindtel","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone,"telcode":telcode,"telcodeold":telcodeold},
function(msg){
if(msg == -1){
alert('�ֻ��Ų���Ϊ�գ�������');return false;
}else if(msg == -2){
alert('�ֻ��Ų��Ϸ���������');return false;
}else if(msg == -3){
alert('�ֻ�������֤�벻��Ϊ�գ�������');return false;
}else if(msg == -4){
alert('���ֻ�������֤�벻��Ϊ�գ�������');return false;
}else if(msg == -5){
alert('���ֻ�������֤����֤��ͨ����������');return false;
}else if(msg == -6){
alert('���ֻ�������֤�����������');return false;
}else if(msg == -7){
alert('���ֻ����Ѱ󶨹������ʺţ��뻻������');return false;
}else if(msg == 1){
alert('�󶨳ɹ�');
jQuery("#user-tel").html(telphone+'<span class="load">�Ѱ�</span><a href="javascript:void(0);" class="modify-icn" data-toggle="modal" data-target="#modal-unbindtel">�����ֻ���</a>');
jQuery(".modal").modal('hide');
}else{
alert('δ֪����������!');return false;
}
});
});
//�����ֻ�������֤��
jQuery("#sendtelcode2").click(function(){
var telphone = jQuery("#telphone2").val();
if(telphone == ''){alert('�ֻ��Ų���Ϊ�գ�������');return false;}
countDown(this);
jQuery.post("home.php",{"mod":"setting", "ac":"sendtelcode2","dosave":"true","formhash":"<?php echo FORMHASH;?>","telphone":telphone},
function(msg){
if(msg == -1){
alert('�ֻ��Ų���Ϊ�գ�������');return false;
}else if(msg == -2){
alert('�ֻ��Ÿ�ʽ����������');return false;
}else if(msg == -5){
alert('���ŷ���ʧ�ܣ�������Σ�����ϵ�ͷ�');return false;
}else if(msg == -6){
alert('���ŷ����쳣�����Ժ�����');return false;
}else if(msg == -7){
alert('�����Ĺ���Ƶ���������Сʱ����');return false;
}else if(msg == -8){
alert('ͬһ����30s��ֻ�ܷ���һ�Σ����Ժ�����');return false;
}else if(msg == 1){
alert('���ŷ�����ɣ����Ժ����');
}else{
alert('δ֪����������!');return false;
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