<?php /**
 * @author JiangHong
 * @copyright 2013
 */
if ( ! defined( 'IN_ADMINCP' ) )
{
	exit( 'Access Denied' );
}
class CategorysadminCtl extends BackendCtl
{
	function newcate()
	{
		global $_G;
		$post = $_POST;
		$category = m( 'categorys' );
		$_newid = $category->add( array(
			'name' => iconv( 'utf-8', 'gbk', $post['cname'] ),
			'fatherid' => $post['parent'],
			'dateline' => $_G['timestamp'],
			'enable' => 1 ) );
		if ( $_newid > 0 )
		{
			$childs = $category->find( array( 'conditions' => 'fatherid = ' . $_newid ) );
			$_arr = array();
			foreach ( $childs as $_cid )
			{
				$_arr[] = $_cid['cid'];
			}
			if ( $_arr )
			{
				$_arr = implode( ',', $_arr );
				$category->edit( $_newid, array( 'childids' => $_arr ) );
			}
			echo '添加完成';
		}
		else
		{
			echo '添加失败';
		}
	}
	function shownewcatedialog()
	{
		global $_G;
		$fatherid = $_G['gp_fatherid'];
		$category = m( 'categorys' );
		if ( $fatherid > 0 )
		{
			$info = $category->get( $fatherid );
		}
		else
		{
			$info = array( 'name' => '总结点', 'cid' => 0 );
		}
		$this->assign( 'info', $info );
		$this->display( 'common/header' );
		$this->display( 'forum/dianping/categorysadmin_addnew' );
		$this->display( 'common/footer' );

	}
	function getview()
	{
		global $_G;
		$categorys = m( 'categorys' );
		$allNode = $categorys->findAll();
		$childs = array();
		$allnodeids = $allNode;
		foreach ( $allNode as $_k => $_v )
		{
			if(($_G['timestamp'] - $_v['dateline']) < 30) $allNode[$_k]['color'] = 'green';
			$childs[$_v['fatherid']][$_k] = $_v;
			if ( in_array( $_v['fatherid'], $allnodeids ) )
				unset( $allnodeids[$_v['fatherid']] );
		}
		$allnodeids = array_keys( $allnodeids );
		$allNode[0]['name'] = "总结点";
		$data['childs'] = $childs;
		$data['allnodeids'] = $allnodeids;
		$data['allNode'] = $allNode;
		$this->assign( $data );
		$this->display( 'common/header' );
		$this->display( 'forum/dianping/categorysadmin_showview' );
		$this->display( 'common/footer' );
	}
	function editcate()
	{
		global $_G;
		$categorys = m( 'categorys' );
		if ( $_G['gp_editid'] > 0 )
		{
			if ( $_G['gp_editsubmit'] != 'yes' )
			{
				$info = $categorys->get( $_G['gp_editid'] );
				$count = $categorys->find( array(
					'index_key' => '',
					'fields' => 'count(*)',
					'conditions' => 'fatherid=' . $_G['gp_editid'] ) );
				$info['count'] = $count;
				$info['time'] = date( 'Y-m-d H:i:s', $info['dateline'] );
				$this->assign( 'info', $info );
				$this->display( 'common/header' );
				$this->display( 'forum/dianping/categorysadmin_editcate' );
				$this->display( 'common/footer' );
			}
			else
			{
				$update = array(
					'enable' => intval( $_G['gp_enable'] ),
					'dateline' => $_G['timestamp'],
					);
				$newname = trim(iconv('utf-8', 'gbk', $_G['gp_editname']));
				if(! empty($newname)) $update['name'] = $newname;
				$categorys->edit( $_G['gp_editid'], $update );
				echo '修改完成';
			}
		}
		else
		{
			echo '参数错误';
		}
	}
} ?>