<?php

$CachedateLogger_config = $cacheArray = array();

//����Ŀ�ĵ�����
foreach(explode(' ', 'getJsAreaSelectByTid getRalateTableNameByTypeId getRalateBySn getRegionIfParent getScapeByTid getScapeareaByTid getRegionByTid getScapeBySn getScapeareaBySn getRegionBySn getCountSubScapeByTid getSubScapeByTid getCountSubScapeareaByTid getSubScapeareaByTid getSubScapeareaBySn getSubRegionByTid getBreadcrumbNavByTid getSnByTid getTidBySn getGuideBySql getGuideByTid getGuideByRegionTid getLastedGuide getLastedActivity getCountGuideByTid getCountGuideByRegionTid getRalateAlbumByTid getCountRalateAlbumByTid getAllSkiData getRalateActivityByKeyword getHotScapeareaByRegionTid getRegionInMudidiNav getHotScape getCommercectivityData getInfoNav getMapBySn getCountMapBySn getParentSubjectBySn getThreadByFid') as $item) {
	$cacheArray[$item] = array(
		'cacheTime' => 86400,
	);
}
$cacheArray['getWeatherInfo'] = array(
	'cacheTime' => 43200,
);
$CachedateLogger_config['ForumOptionMudidi'] = $cacheArray;




//����ɽ������
$cacheArray = array();
foreach(explode(' ', 'getRalateArticles getRalateZb getActivityInfo getSfzhuantiInfo getSfactivity getRalateXc') as $item) {
	$cacheArray[$item] = array(
		'cacheTime' => 86400,
	);
}
$cacheArray['getWeatherInfo'] = array(
	'cacheTime' => 43200,
);
$CachedateLogger_config['ForumOptionMountion'] = $cacheArray;



//����Ʒ��ģ��
$cacheArray = array();
foreach(explode(' ', 'getRalateArticles getRalateZb getRalateDzty getRalateTopics getRalatePhotos getAttractInvestmentIds getHomeBlogs') as $item) {
	$cacheArray[$item] = array(
		'cacheTime' => 86400000,
	);
}
$CachedateLogger_config['ForumOptionBrand'] = $cacheArray;


// ���ùؼ���
$cacheArray = array();
foreach(explode(' ', 'getKeywords getKeywordsCount') as $item) {
	$cacheArray[$item] = array(
		'cacheTime' => 86400,
	);
}
foreach(explode(' ', 'getBlodsByKeyArr getForumsByKeyArr getPortalByKeyArr getNeighborSearchKeyByKid getKeywordByKid getAddwhereByKeyArr') as $item) {
	$cacheArray[$item] = array(
		'cacheTime' => 864000 * 3,
	);
}
$CachedateLogger_config['SearchKey'] = $cacheArray;
