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
			//*此处判断，当id太长了，将分割执行*//
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
			//*如果sql超过了一定数量，将会把多余的再次加入队列中*//
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
						// $logs->log_str("超出限制，重新加入队列[$_sql]");
					}
					catch ( exception $e )
					{
						$sql_log[] = $_sql;
						DB::query( $_sql, 'UNBUFFERED' );
						$insertcount++;
					}
				}
			}
			$logs->log_str( "点击量[{$args['views']}]共入库{$insertcount}条，拆分入队{$chafencount}条" );
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