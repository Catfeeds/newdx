<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if(!empty($uploadResponse)) { ?>
<uploadResponse>
<message><?php if($status=="success") { ?>���<?php } else { ?><?php echo $uploadfiles;?><?php } ?></message>
<status><?php echo $status;?></status>
<proid><?php echo $proid;?></proid>
<albumid><?php echo $albumid;?></albumid>
<picid><?php echo $picid;?></picid>
<?php if($fileurl) { ?><filepath><?php echo $fileurl;?></filepath><?php } ?>
</uploadResponse>
<?php } else { ?>
<parameter>
<?php if($iscamera) { ?>
<images><?php if(is_array($dirarr)) foreach($dirarr as $key => $val) { ?><categories name="<?php echo $val['0'];?>" directory="<?php echo $val['1'];?>"><?php if(is_array($val['2'])) foreach($val['2'] as $ikey => $value) { ?><img name="<?php echo $value;?>"/>
<?php } ?>
</categories>
<?php } ?>
</images>
<?php } elseif($isdoodle) { ?>
<background><?php if(is_array($filearr)) foreach($filearr as $key => $filename) { ?><bg url="<?php echo STATICURL;?>image/doodle/big/<?php echo $filename;?>" thumb="<?php echo STATICURL;?>image/doodle/thumb/<?php echo $filename;?>"/>
<?php } ?>
</background>
<?php } elseif($isupload) { ?>
<allowsExtend>
<extend depict="All Image File(*.jpg,*.jpeg,*.gif,*.png)">*.jpg,*.gif,*.png,*.jpeg</extend>
</allowsExtend>
<?php } ?>
<language>
<create>����</create>
<notCreate>ȡ��</notCreate>
<albumName>�����</albumName>
<createTitle>���������</createTitle>
<categoryDesc>������</categoryDesc>
<categoryPrompt>��ѡ��������</categoryPrompt>
<?php if(!$isdoodle) { ?>
<okbtn>����</okbtn>
<cancelbtn>�鿴</cancelbtn>
<?php if($isupload) { ?>
<fileName>�ļ���</fileName>
<depict>����(�����޸�)</depict>
<size>�ļ���С</size>
<stat>�ϴ�����</stat>
<aimAlbum>�ϴ���:</aimAlbum>
<browser>���</browser>
<delete>ɾ��</delete>
<upload>�ϴ�</upload>
<okTitle>�ϴ����</okTitle>
<okMsg>�����ļ��ϴ����!</okMsg>
<uploadTitle>�����ϴ�</uploadTitle>
<uploadMsg1>�ܹ���</uploadMsg1>
<uploadMsg2>���ļ��ȴ��ϴ�,�����ϴ���</uploadMsg2>
<uploadMsg3>���ļ�</uploadMsg3>
<bigFile>�ļ�����</bigFile>
<uploaderror>�ϴ�ʧ��</uploaderror>
<?php } elseif($iscamera) { ?>
<desultory>ץ��</desultory>
<series>����</series>
<save>����</save>
<pageup>��һҳ</pageup>
<pagedown>��һҳ</pagedown>
<clearbg>������</clearbg>
<reload>����</reload>
<cancel>ȡ��</cancel>
<siteerror>��������,ϵͳ����ʧ��</siteerror>
<ver1>������FlashPlayer 9.0.45���ϰ汾��Ĳ������汾Ϊ</ver1>
<ver2>������</ver2>
<refuse>����Ļ����ϼ�⵽����ͷ����ܾ�������ͷ��ʹ��</refuse>
<countdown>����</countdown>
<second>��</second>
<nocam>����Ļ�����û�м�⵽����ͷ�����������ͷ�豸����ʹ����</nocam>
<autoShooting>������</autoShooting>
<explain>��������:</explain>
<okTitle>�ϴ����</okTitle>
<okMsg>��ͷ���ϴ����</okMsg>
<saveTitle>�����ϴ�</saveTitle>
<saveToNote>���浽</saveToNote>
<saveMsg1>�ܹ���</saveMsg1>
<saveMsg2>�Ŵ�ͷ��,���ڱ����</saveMsg2>
<saveMsg3>�Ŵ�ͷ����</saveMsg3>
<?php } } else { ?>
<reload>�ػ�</reload>
<save>����</save>
<notDraw>û���κ�Ϳѻ�������޷�����</notDraw>
<?php } ?>
</language>
<config>
<userid><?php echo $_G['uid'];?></userid>
<hash><?php echo $hash;?></hash>
<maxupload><?php echo $max;?></maxupload>
<uploadurl><?php echo $uploadurl;?></uploadurl>
<feedurl><?php echo $feedurl;?></feedurl>
<albumurl><?php echo $albumurl;?></albumurl>
<categoryStat><?php echo $categorystat;?></categoryStat>
<categoryRequired><?php echo $categoryrequired;?></categoryRequired>
<?php if($iscamera) { ?>
<countdown>3</countdown>
<countBy>2000</countBy>
<?php } ?>
</config>
<?php if($isdoodle) { ?>
<filters>
<filter id="0">����</filter>
<filter id="1">��Ӱ</filter>
<filter id="2">ģ��</filter>
<filter id="3">����</filter>
<filter id="4">ˮ��</filter>
<filter id="5">�罦</filter>
<filter id="6">����</filter>
</filters>
<?php } ?>
<albums>
<album id="-1">��ѡ�����</album><?php if(is_array($albums)) foreach($albums as $key => $value) { ?><album id="<?php echo $value['albumid'];?>"><?php echo $value['albumname'];?></album>
<?php } ?>
<album id="add">+���������</album>
</albums>
<?php if($_G['setting']['albumcategorystat'] && $categorys) { ?>
<categorys>
<category catid="0">ѡ�����</category><?php if(is_array($categorys)) foreach($categorys as $key => $value) { if($value['level'] == 0) { ?>
<category catid="<?php echo $key;?>"><?php echo $value['catname'];?></category><?php if(is_array($value['children'])) foreach($value['children'] as $catid) { ?><category catid="<?php echo $categorys[$catid]['catid'];?>">--<?php echo $categorys[$catid]['catname'];?></category><?php if(is_array($categorys[$catid]['children'])) foreach($categorys[$catid]['children'] as $catid2) { ?><category catid="<?php echo $categorys[$catid2]['catid'];?>">----<?php echo $categorys[$catid2]['catname'];?></category>
<?php } } } } ?>
</categorys>
<?php } ?>
</parameter>
<?php } ?>