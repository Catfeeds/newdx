<?php
/**
 * @author JiangHong
 * @copyright 2014
 */
if ( ! defined( 'IN_ADMINCP' ) )
{
	exit( 'Access Denied' );
}
class CssadminCtl extends BackendCtl
{
	var $mymod;
	var $perpage = 500;     
	function __construct()
	{
		$this->mymod = m('csssrv');
	}
	function getlist()
	{
		$page = max(1, intval($_GET['page']));
		$start = ($page - 1) * $this->perpage;
		$list = $this->mymod->find(array('limit' => "{$start},{$this->perpage}", 'order' => "this.lastupdate DESC"));
		$data['list'] = $list;
		$data['now'] = TIMESTAMP;
		$this->assign($data);
		$this->display('common/header');
		$this->display('common/servers/csssrv/css_list');
		$this->display('common/footer');
	}
	function addnew(){
		$this->display('common/header');
		if($_POST){
			if(strlen(trim($_POST['name'])) < 5){
				echo "<b class='red'>���ύ����ʽ·��̫�̣�����ȷ</b>";
			}else{
				$name = trim(trim($_POST['name']), '/');
				$exis = $this->mymod->get(array('conditions' => "name = '{$name}'"));
				if($exis){
					$editstat = $this->mymod->edit($exis['cssid'], array('version' => $exis['version'] + 0.001, 'lastupdate' => TIMESTAMP));
					$this->_clearcache();
					echo $editstat ? "<b class='green'>���³ɹ�</b>" : "<b class='red'>����ʧ��</b>";
				}else{
					$datas = array(
						'name' => $name,
						'version' => 0.001,
						'createtime' => TIMESTAMP,
						'lastupdate' => TIMESTAMP,
						);
					$newid = $this->mymod->add($datas);
					if($newid > 0){
						$this->_clearcache();
						echo "<b class='green'>������</b>";
					}else{
						echo "<b class='red'>���ʧ��</b>";
					}
				}
			}
		}
		$this->display('common/footer');
	}
	function updatecss(){
		$this->display('common/header');
		$cid = intval($_GET['cid']);
		if($cid > 0){
			$exis = $this->mymod->get($cid);
			if($exis){
				$editstat = $this->mymod->edit($cid, array('version' => $exis['version'] + 0.001, 'lastupdate' => TIMESTAMP));
				$this->_clearcache();
				echo $editstat ? "<b class='green'>���³ɹ�</b>" : "<b class='red'>����ʧ��</b>";
			}else{
				echo "<b class='red'>����ʧ��</b>";
			}
		}else{
			echo "<b class='red'>���ʧ��</b>";
		}
		$this->display('common/footer');
	}
	function delcss(){
		$this->display('common/header');
		$cid = intval($_GET['cid']);
		if($cid > 0){
			$exis = $this->mymod->get($cid);
			if($exis){
				$editstat = $this->mymod->drop($cid);
				$this->_clearcache();
				echo $editstat > 0 ? "<b class='green'>ɾ���ɹ�</b>" : "<b class='red'>ɾ��ʧ��</b>";
			}else{
				echo "<b class='red'>ɾ��ʧ��</b>";
			}
		}else{
			echo "<b class='red'>ɾ��ʧ��</b>";
		}
		$this->display('common/footer');
	}
	function editcss(){
		$this->display('common/header');
		$cid = intval($_GET['cid']);
		if($cid > 0){
			$exis = $this->mymod->get($cid);
			if($exis){
				if($_POST['editcssbtn'] != 'yes'){
					$data['info'] = $exis;
					$this->assign($data);
					$this->display('common/servers/csssrv/css_edit');
				}else{
					$newname = trim(trim($_POST['name']), '/');
					$editstat = $this->mymod->edit($cid, array('version' => $exis['version'] + 0.001, 'name' => $newname, 'lastupdate' => TIMESTAMP));
					$this->_clearcache();
					echo $editstat ? "<b class='green'>���³ɹ�</b><script>hideWindow('editcss');</script>" : "<b class='red'>����ʧ��</b>";
				}
			}else{
				echo "<b class='red'>��������Ϣ�������ύ����</b>";
			}
		}else{
			echo "<b class='red'>�ύ�Ĳ�������</b>";
		}
		$this->display('common/footer');
	}
	function _clearcache(){
		memory('rm', 'cache_plugin_cssversion');
	}
}
?>