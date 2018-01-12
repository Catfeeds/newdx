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
				echo "<b class='red'>您提交的样式路径太短，不正确</b>";
			}else{
				$name = trim(trim($_POST['name']), '/');
				$exis = $this->mymod->get(array('conditions' => "name = '{$name}'"));
				if($exis){
					$editstat = $this->mymod->edit($exis['cssid'], array('version' => $exis['version'] + 0.001, 'lastupdate' => TIMESTAMP));
					$this->_clearcache();
					echo $editstat ? "<b class='green'>更新成功</b>" : "<b class='red'>更新失败</b>";
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
						echo "<b class='green'>添加完成</b>";
					}else{
						echo "<b class='red'>添加失败</b>";
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
				echo $editstat ? "<b class='green'>更新成功</b>" : "<b class='red'>更新失败</b>";
			}else{
				echo "<b class='red'>更新失败</b>";
			}
		}else{
			echo "<b class='red'>添加失败</b>";
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
				echo $editstat > 0 ? "<b class='green'>删除成功</b>" : "<b class='red'>删除失败</b>";
			}else{
				echo "<b class='red'>删除失败</b>";
			}
		}else{
			echo "<b class='red'>删除失败</b>";
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
					echo $editstat ? "<b class='green'>更新成功</b><script>hideWindow('editcss');</script>" : "<b class='red'>更新失败</b>";
				}
			}else{
				echo "<b class='red'>不存在信息，参数提交错误</b>";
			}
		}else{
			echo "<b class='red'>提交的参数错误</b>";
		}
		$this->display('common/footer');
	}
	function _clearcache(){
		memory('rm', 'cache_plugin_cssversion');
	}
}
?>