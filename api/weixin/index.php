<?php
error_reporting(0);
set_time_limit(0);

//require_once('../../external/fb.ext.php');
require_once('../../source/class/class_core.php');
require_once('../../source/class/class_sockpost.php');

$discuz = & discuz_core::instance();
$discuz->init();

//最新资讯
$content = array();
$date	 = date('Y_m_d');

//require_once('../../source/plugin/dianping/dianping.fun.php');
//$mdArticleTitle	= m("portal_article_title");

//$aids 	  = array("871", "886", "887", "888", "889", "890", "891", "892", "893", "894", "895", "896", "897", "898", "899", "900", "901");	
//$where    = "{$mdArticleTitle->alias}.status=0 and {$mdArticleTitle->alias}.catid in (".dimplode($aids).") and {$mdArticleTitle->alias}.pic <> {$mdArticleTitle->alias}.mpic and {$mdArticleTitle->alias}.mpic <> '' and {$mdArticleTitle->alias}.pic <> ''";
//$ltjxList = $mdArticleTitle->find(array("fields"=>"{$mdArticleTitle->alias}.*", "conditions"=>$where, "order"=>"{$mdArticleTitle->alias}.dateline desc", "limit"=>"59,1"), false);
//
//print_r($ltjxList);

echo '88';

/*$res  = @file_get_contents("http://m.zaiwai.com/wap.php?app=api&act=getData&data_type=category&type_id=4&limit=0-6");
$res = json_decode($res, true);
//$res = object_array($res);
print_r($res);

function object_array($array)
{
   if(is_object($array))
   {
    $array = (array)$array;
   }
   if(is_array($array))
   {
    foreach($array as $key=>$value)
    {
     $array[$key] = object_array($value);
    }
   }
   return $array;
}*/

exit();