<?php
/**
 * 户外学校小程序接口
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ExamIndexCtl extends FrontendCtl{

	function __construct()
	{
		parent::__construct();
	}

    //户外学校视频列表
	function video()
	{
        $page = max($_GET['page'], 1);
		$perpage = 10;
		$start = ($page - 1) * $perpage;

		$memKey = 'cache_exam_video_list_'.$page;

		//若是mencache已到期，则重新缓存
		//memory('rm', $memKey);
		if (!$videoList = memory('get', $memKey)) {
            $videoList = $this->_getVideoList($start, $perpage);
			memory('set', $memKey, $videoList, 3600*5);
		}


		if(!empty($videoList)) {
			$returnData = array_values($videoList);
		}else{
			$returnData = array('error'=>true , 'errorinfo'=>"没有更多了");
		}

		encodeData($returnData);
	}

    //户外学校视频详情
    function video_detail(){
        $video_id = (int) $_GET['video_id'];
        if(!$video_id){
            $returnData = array('error'=>true , 'errorinfo'=>"视频不存在");
            encodeData($returnData);
        }
        $memKey = 'cache_exam_video_'.$video_id;

        if (!$video = memory('get', $memKey)) {
            $video = $this->_getVideoDetail($video_id);
            memory('set', $memKey, $video, 3600*5);
        }
        if(!empty($video)) {
            $returnData = $video;
        }else {
            $returnData = array('error' => true, 'errorinfo' => "没有更多了");
        }
        encodeData($returnData);

    }

    //户外学校视频浏览统计
    function video_view(){
        $video_id = intval($_POST['$video_id']);
        if(!$video_id){
            $returnData = array('error'=>true , 'errorinfo'=>"视频不存在");
            encodeData($returnData);
        }

        $memKey = 'cache_exam_video_'.$video_id;

        if (!$video = memory('get', $memKey)) {
            $video = $this->_getVideoDetail($video_id);
            memory('set', $memKey, $video, 3600*5);
        }
        if($video){
            DB::update('exam_video', array('view' => $video['view'] + 1), "id='{$video_id}'");
        }else{
            $returnData = array('error'=>true , 'errorinfo'=>"视频不存在");
            encodeData($returnData);
        }
        $returnData = array('error'=>false);
        encodeData($returnData);
    }

    //获取学校视频列表
    protected function _getVideoList($start, $perpage){
        $video = array();
        $query = DB::query("SELECT * FROM " . DB::table('exam_video') . " WHERE is_show = 1 and is_free = 1 order by createtime desc limit $start,$perpage" . getSlaveID());
        while ($row = DB::fetch($query)) {
            $video[] = $row;
        }
        return $video;
    }

    //获取学校视频详情
    protected function _getVideoDetail($video_id){
        return DB::fetch_first("SELECT * FROM " . DB::table('exam_video') . " WHERE id=".$video_id.getSlaveID());
    }



}
?>
