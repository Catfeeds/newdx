<?php
/**
 * @author JiangHong
 * @copyright 2014
 */

/**
 * viewshandle
 * 
 * @package 8264master_two
 * @author JiangHong
 * @copyright 2014
 * @version $Id$
 * @access public
 */
class viewshandle
{
	private $limit_sql_length = 10000;
	private $limit_sql_count = 5;
	public function todatabase( $args )
	{
		require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
		$logs = new logs( 'views_cron' );
		if ( $args['viewscol'] && $args['views'] && $args['table'] && $args['idcol'] && $args['ids'] )
		{
			//*�˴��жϣ���id̫���ˣ����ָ�ִ��*//
			if ( strlen( $args['ids'] ) > $this->limit_sql_length )
			{
				$i = 0;
				foreach ( explode( ',', trim( $args['ids'], ',' ) ) as $_id )
				{
					$id_arr[$i] .= $_id > 0 ? "," . intval( $_id ) : '';
					if ( strlen( $id_arr[$i] ) > $this->limit_sql_length )
					{
						$i++;
					}
				}
			}
			else
			{
				$id_arr[0] = $args['ids'];
			}
			//*���sql������һ������������Ѷ�����ٴμ��������*//
			$limit = $this->limit_sql_count;
			require_once libfile( 'class/redisqueue' );
			$redisqueue = new redisqueue( 6382 );
			$insertcount = $chafencount = 0;
			foreach ( $id_arr as $_mids )
			{
				$_sql = "UPDATE LOW_PRIORITY " . DB::table( $args['table'] ) . " SET {$args['viewscol']}={$args['viewscol']}+'{$args['views']}' WHERE {$args['idcol']} IN (0{$_mids})";
				if ( $limit > 0 )
				{
					DB::query( $_sql, 'UNBUFFERED' );
					$insertcount++;
					$sql_log[] = $_sql;
					$limit--;
				}
				else
				{
					try
					{
						$redisqueue->addQueue( 'viewshandle', 'todatabase', array(
							'viewscol' => $args['viewscol'],
							'views' => $args['views'],
							'idcol' => $args['idcol'],
							'ids' => $_mids,
							'table' => $args['table'] ), 'viewstodatabase' );
						$chafencount++;
						// $logs->log_str("�������ƣ����¼������[$_sql]");
					}
					catch ( exception $e )
					{
						$sql_log[] = $_sql;
						DB::query( $_sql, 'UNBUFFERED' );
						$insertcount++;
					}
				}
			}
			$logs->log_str( "�����[{$args['views']}]�����{$insertcount}����������{$chafencount}��" );
			return true;
		}
		else
		{
			$elogs = new logs( 'viewshandle' );
			$elogs->log_array( $args, 'errorargs' );
			return false;
		}
	}
}
?>