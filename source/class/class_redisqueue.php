<?php
/**
 * @author JiangHong
 * @copyright 2014
 */
class QueueExpection extends Exception
{
	public function __construct( $message, $code, exception $previous = null )
	{
		parent::__construct( $message, $code );
	}

	public function __toString()
	{
		return "ERROR " . __class__ . " [{$this->code}]: {$this->message}\n";
	}
}

class QueueRedisConnectErrorException extends QueueExpection
{
	public function __construct( $message, $code = 0, exception $previous = null )
	{
		parent::__construct( $message, 401, $previous );
	}
}

class QueueAddErrorException extends QueueExpection
{
	public function __construct( $message, $code = 0, exception $previous = null )
	{
		parent::__construct( $message, 402, $previous );
	}
}

class QueueReadErrorException extends QueueExpection
{
	public function __construct( $message, $code = 0, exception $previous = null )
	{
		parent::__construct( $message, 403, $previous );
	}
}

class redisqueue
{
	public $redis;
	private $resavedata;
	private $queuename;
	public function __construct( $port = 6382 )
	{
		global $_G;
		if ( ! $_G['config']['memory']['redis'] || ! array_key_exists( $port, $_G['config']['memory']['redis'] ) )
		{
			return false;
		}
		require_once libfile( 'class/myredis' );
		$this->redis = &myredis::instance( $port );
		if ( ! $this->redis->connected )
		{
			throw new QueueRedisConnectErrorException( "redis connect to {$port} is error" );
		}
		return true;
	}

	public function addQueue( $class, $func, $args, $queuename )
	{
		$arr = array(
			'class' => $class,
			'function' => $func,
			'args' => $args );
		if ( ! $this->redis->RPUSH( strtoupper( $queuename ) . "_QUEUE_CRON", serialize( $arr ) ) )
		{
			throw new QueueAddErrorException( "add queue error with class {$class},function {$function} and argments " . var_export( $args, true ) );
		}
		return true;
	}

	public function getQueue( $key )
	{
		try
		{
			$this->resavedata[$key] = $this->redis->LPOP( $this->queuename . "_QUEUE_CRON" );
		}
		catch ( exception $e )
		{
			throw new QueueReadErrorException( "read queue error with queue {$this->queuename}_QUEUE_CRON" );
		}
		if ( $this->resavedata[$key] !== false )
		{
			$this->resavedata[$key] = unserialize( $this->resavedata[$key] );
		}
		return $this->resavedata[$key];
	}

	public function doQueue( $queuename, $limit = 100 )
	{
		$this->queuename = strtoupper( $queuename );
		register_shutdown_function( array( $this, '_resavefunc' ) );
		try
		{
			for ( $i = 0; $i < $limit; $i++ )
			{
				$data = $this->getQueue( $i );
				$classfile = libfile('class/' . $data['class']);
				if(file_exists($classfile)){
					require_once $classfile;
				}
				if(class_exists($data['class'])){
					$classobj = new $data['class'];
					if(method_exists($classobj, $data['function'])){
						$return = call_user_func(array($classobj, $data['function']), $data['args']);
						if($return){
							unset($this->resavedata[$i]);
						}
					}
				}
			}
			return true;
		}catch(Exception $e){
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('queue_error');
			$logs->log_str($e->getMessage());
			return false;
		}
	}
	public function _resavefunc()
	{
		if ( ! empty( $this->resavedata ) )
		{
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('queue_error');
			foreach($this->resavedata as $k => $v)
			{
				if($v){
					$v['args']['errorcount']++;
					if($v['args']['errorcount'] >= 5 ){
						$logs->log_str("errorcount >= 5 | " . var_export($v, true));
					}else{
						try{					
							$this->addQueue($v['class'], $v['function'], $v['args'], $this->queuename);
						}catch(Exception $e){
							$logs->log_str($e->getMessage());
							unset($this->resavedata[$k]);
							$this->_resavefunc();
						}
					}
					unset($this->resavedata[$k]);
				}
			}
		}
	}
}
