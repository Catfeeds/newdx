<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 防爬虫和统计程序的页面嵌入
 * @filesource ipbanspider.class.php
 */

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
class plugin_ipbanspider{
    public $setting;
    public $open;
    public $canban;
    public $ip;
    public $agent;
    public $user;
    public $url;
    public $redis;
    public $rule;
    private $spider;
    private $micotime;
    private $black;
    private $white;
    private $deep;
    private $md5bs_logon;
    private $md5bs_nologon;
    protected $pre = "BanIpSpider_";
    function plugin_ipbanspider(){
        global $_G;
        //loadcache('plugin');
        $this->setting = $_G['cache']['plugin']['ipbanspider'];
        $this->open = $this->setting['ip_on'];
        $this->canban = $this->setting['ban_on'];
        if($this->setting['redis_per']) $this->pre = $this->setting['redis_per'];
        $this->ip = $_G['clientip'];
        $this->user = empty($_G['uid']) ? '' : "<a target='__blank' href='{$_G[config][web][home]}{$_G[uid]}'>{$_G[username]}</a>";
        $this->agent = trim($_SERVER['HTTP_USER_AGENT']);
        $this->url = $_SERVER['SERVER_NAME'].($_SERVER['REQUEST_URI']=='/' ? '':$_SERVER['REQUEST_URI']);
        $this->micotime = microtime(true);
        $this->setting['record_pertime'] = $this->setting['record_pertime'] > 0 ? $this->setting['record_pertime'] : 5;
        $this->setting['record_pernum'] = $this->setting['record_pernum'] > 0 ? $this->setting['record_pernum'] : 10;
        if($_G['uid']){
        	$this->md5bs_logon = md5("{$this->ip}_{$_G['uid']}_{$this->agent}");
        }
        $this->md5bs_nologon = md5("{$this->ip}_nolog_{$this->agent}");
    }
    public function common(){
        if($this->open){
            self::check();
        }
    }
    function init(){
        require_once libfile('class/myredis');
        $this->redis = & myredis::instance(6379);
        //change db
        $this->redis->SELECTDB(1);
        if(empty($this->rule)){
            if (!$this->redis->Exists($this->pre.'config_rules')){
                $q = DB::query("SELECT * FROM ".DB::table('plugin_ipbanspider_rules'));
                while($v = DB::fetch($q)){
                    $this->redis->hashset($this->pre.'config_rules' ,$v['rid'] ,serialize($v));
                }
            }
            $this->rule = $this->redis->HGETALL($this->pre.'config_rules');
        }
    }
    function ban($time , $rule=array()){
        if($time > 0 && $this->canban){
            if($this->redis->zScore($this->pre.'blacklist' ,$this->ip)===false){
                $deepban = self::getdeepban();
                $res = '[<b class="blue">'.date('Y-m-d H:i:s' ,$this->micotime).'</b>]用户[<b class="blue">'.(empty($this->user) ? '' : $this->user).'</b>]IP[<b class="blue">'.$this->ip.'</b>]访问了[<b class="red">'.$rule['mynum'].'</b>]次因规则[<b class="green">'.$rule['name'].'</b>]<b class="red">被封</b>';
                if($deepban > 0){
                    $time = $time + $rule['bantime'] * $deepban;
                    $res .= '<br />'.$this->deep;
                }
                $this->redis->ZADD($this->pre.'blacklist' ,$this->micotime ,$this->ip);
                $this->redis->hashset($this->pre.'unbantime' , $this->ip ,$time);
                $this->redis->ZADD($this->pre.'history_ban_'.$this->ip , $this->micotime, $res);
                $this->redis->EXPIRE($this->pre.'history_ban_'.$this->ip, 3600*24*15);
            }
            $this->black = true;
        }
    }
    function record(){
        $this->redis->ZADD($this->pre.'ALLIP' ,$this->micotime ,$this->ip);
        if(!$this->setting['record_white'] && $this->white) return;
        if($this->spider==1 && !$this->setting['record_safespider']) return;
        $arr = array(
                    'agent' => $this->agent ,
                    'url' => $this->url ,
                    'time' => $this->micotime ,
                    'user' => $this->user ,
                    );
        $this->redis->ZADD($this->pre.'COMMON_IP_'.$this->ip.'_zset' ,$this->micotime ,serialize($arr));
        $cachetime = $this->setting['tjtime'] > 0 ? $this->setting['tjtime'] : 10;
        $this->redis->EXPIRE($this->pre.'COMMON_IP_'.$this->ip.'_zset' ,$cachetime*60);
        if(!$this->white && $this->spider==0 && !empty($this->rule)){
            foreach($this->rule as $rn){
                $rule = unserialize($rn);
                if($rule['num'] > 0){
                    $rule['mynum'] = $this->redis->zCount($this->pre.'COMMON_IP_'.$this->ip.'_zset' ,$this->micotime-$rule['pertime'] ,$this->micotime);
                    if($rule['mynum'] >= $rule['num']){
                        $time = time() + $rule['bantime'];
                        self::ban($time ,$rule);
                    }
                }
                if($this->black) break;
            }
        }
        $this->redis->zRemRangeByScore($this->pre.'COMMON_IP_'.$this->ip.'_zset' ,0 ,$this->micotime-$cachetime*60);
        if(substr(time() , -2) == '00') $this->redis->zRemRangeByScore($this->pre.'ALLIP' ,0 ,$this->micotime-$cachetime*60*2);
    }
    function check(){
        $write = true;$this->white = false;$this->black = false;$this->spider = 0;
        if(!empty($this->setting['url_not'])) $write = self::getly($this->setting['url_not'] ,'||');
        if($write === false) return;
        self::init();
        if($this->redis->sIsMember($this->pre.'whitelist_linshi_logon_' . str_replace('.', '_', $this->ip), $this->md5bs_logon) || $this->redis->sIsMember($this->pre.'whitelist_linshi_nologon_' . str_replace('.', '_', $this->ip), $this->md5bs_nologon)){
        	return;
        }
        global $_G;
        if($_G['uid'] > 0 && $this->redis->sIsMember($this->pre.'whitelist_by_uid', $_G['uid'])){
        	return;
        }
        if(! $this->white && $this->redis->zScore($this->pre.'blacklist' ,$this->ip)!==false){
            if(time() > $this->redis->hashget($this->pre.'unbantime' , $this->ip)){
                self::unban();
                return;
            }
            $this->black = true;
            self::isbanned();
        }else{
            if($this->redis->sIsMember($this->pre.'whitelist' ,$this->ip)){
                $this->white = true;
            }else{
                self::testspider();
            }
            if($this->redis->sIsMember($this->pre.'config_doubtip_set' ,$this->ip)){
                $write = true;
            }else{
                $write = false;
                $nownum = $this->redis->incr($this->pre.'_record_ip_'.$this->ip);
                if($this->redis->ttl($this->pre.'_record_ip_'.$this->ip) == -1) $this->redis->EXPIRE($this->pre.'_record_ip_'.$this->ip ,$this->setting['record_pertime']);
                if($nownum >= $this->setting['record_pernum']){
                    $this->redis->sAdd($this->pre.'config_doubtip_set' ,$this->ip);
                    if($this->redis->ttl($this->pre.'config_doubtip_set')==-1){
                        $this->redis->EXPIRE($this->pre.'config_doubtip_set' ,3600*24);
                    }
                    $write = true;
                }
            }
            $write && self::record();
        }
    }
    function getly($str ,$need ,$type = true){
        $return = true;
        $f = $type;
        $strarr = explode($need ,$str);
        foreach($strarr as $s){
            $s = trim($s);
            if(empty($s)) continue;
            if($type && $return===false) return false;
            if(strpos($s ,'&&')!==false){
                $return = $return && self::getly($s ,'&&' ,false);
            }
            $f = $type ? ($f && stripos($this->url ,$s) === false) : ($f || stripos($this->url ,$s) === false) ;
        }
        return $return && $f;
    }
    function unban($user = ''){
        global $_G;
        if($this->redis->zScore($this->pre.'blacklist' ,$this->ip)!==false){
            $this->redis->delete($this->pre.'COMMON_IP_'.$this->ip.'_zset' ,0);
            $this->redis->zRem($this->pre.'blacklist' ,$this->ip);
            $this->redis->hashdel($this->pre.'unbantime' ,$this->ip);
            $res = '[<b class="blue">'.date('Y-m-d H:i:s' ,$this->micotime).'</b>]黑名单内IP：[<b class="red">'.$this->ip.'</b>]'.(empty($user) ? '到期自动' : '用户[<b class="blue">'.$user.'</b>]自助').'<b class="green">解封</b>';
            $this->redis->ZADD($this->pre.'history_unban_'.$this->ip ,$this->micotime ,$res);
            $this->redis->EXPIRE($this->pre.'history_unban_'.$this->ip, 3600*24*15);
        }
    }
    function spider_getkey($friend){
        return $this->pre.'config_spider_'.($friend == 0 ? 'danger' : 'friend').'_zset';
    }
    function testspider(){
        if(stripos($this->agent ,'spider')!==false || stripos($this->agent ,'bot')!==false) $this->redis->zIncrBy($this->pre.'config_allspider' ,1 ,$this->agent);
        $dangerspiders = $this->redis->zRevRange(self::spider_getkey(0) ,0 ,-1);
        if(!empty($dangerspiders)){
            foreach($dangerspiders as $dsp){
                if(stripos($this->agent ,$dsp)!==false){
                    $this->spider = -1;
                    $this->redis->zIncrBy(self::spider_getkey(0) ,1 ,$dsp);
                    self::isbanned();
                    break;
                }
            }
        }
        $friendspiders = $this->redis->zRevRange(self::spider_getkey(1) ,0 ,-1);
        if(!empty($friendspiders)){
            foreach($friendspiders as $fsp){
                if(stripos($this->agent ,$fsp)!==false){
                    $this->spider = 1;
                    $this->redis->zIncrBy(self::spider_getkey(1) ,1 ,$fsp);
                    break;
                }
            }
        }
    }
    function getbantimes(){
        return $this->redis->ZCARD($this->pre.'history_ban_'.$this->ip);
    }
    function getdeepban(){
        $deepbanper = $this->setting['deepbanper'] ? intval($this->setting['deepbanper']) : 5;
        $mytimes = self::getbantimes();
        $deeptimes = floor($mytimes/$deepbanper);
        $this->deep = '因封号次数<b class="red">'.$mytimes.'</b>为惩罚基数<b class="blue">'.$deepbanper.'</b>的<b class="red">'.$deeptimes.'倍</b>故增加<b class="blue">'.$deeptimes.'倍</b>封号时间';
        return $deeptimes;
    }
    function isbanned(){
    	global $_G;
        header('HTTP/1.1 503 Service Temporarily Unavailable');
        header('Status: 503 Service Temporarily Unavailable');
        header('Retry-After: 600');
        //$style = "<style>#hander{position: relative;left:".rand(-100,100)."px;top:".rand(20,50)."px;cursor:pointer;font-weight:bold;color:red;}#handerlogin{position: absolute;display:none;background:#CCC;}</style>";
        $style = "";
        $baseurl = empty($_SERVER['HTTP_HOST']) ? $_G['config']['web']['portal'] : 'http://' . $_SERVER['HTTP_HOST'] . '/';
        include template('ipbanspider:errortips');
        exit();
    }
    function global_footer()
    {
    	//return "<script>jQuery.post('/api/record/recordinfo.php', {fid:'{$_G[fid]}', tid:'{$_G[tid]}', ip:'{$this->ip}', agent:'{$this->agent}', uid:'{$_G[uid]}'}, function(data){});\nconsole.log('fid:{$_G[fid]}|tid:{$_G[tid]}|ip:{$this->ip}|agent:{$this->agent}|uid:{$_G[uid]}');</script>";
    	$jsstring = "";
    	if(stripos($this->agent ,'spider')!==false || stripos($this->agent ,'bot')!==false)
    	{
    		//蜘蛛将不记录
    		return '';
    	}
    	global $_G;
		if($_G['tid'] > 0 && $_G['forum_thread']['subject'] && $_G['fid'] > 0){
    		/*$jsstring = <<<EOF
<script>
jQuery(document).ready(function(){
	var starttime = new Date();
	jQuery(window).bind('beforeunload',function(){
		var endtime = new Date();
		var endfuc = function(){
			console.log('time_end,exit');
		}
		jQuery.ajax({
				async: false,
				type: 'POST',
				url:'/api/record/recordinfo.php',
				data: {fid:'{$_G[fid]}', tid:'{$_G[tid]}', ip:'{$this->ip}', agent:'{$this->agent}', uid:'{$_G[uid]}', stime:starttime.getTime(), etime:endtime.getTime()},
				success: function(data){console.log(data);},
				error: function(){console.log('error')},
				timeout: 1000,
				});
	})
});
</script>
EOF;*/
			$jsstring = <<<EOF
<script>
jQuery(document).ready(function(){
	var starttime = new Date();
	var endtime = new Date();
	var endfuc = function(){
		console.log('time_end,exit');
	}
	jQuery.ajax({
			async: true,
			type: 'POST',
			url:'/api/record/recordinfo.php',
			data: {fid:'{$_G[fid]}', tid:'{$_G[tid]}', title:'{$_G[forum_thread][subject]}', ip:'{$this->ip}', agent:'{$this->agent}', uid:'{$_G[uid]}', stime:starttime.getTime(), etime:endtime.getTime()},
			success: function(data){console.log(data);},
			error: function(){console.log('error')},
			timeout: 5000
			});
});
</script>
EOF;
		}
		// return $jsstring;
    }
}
?>
