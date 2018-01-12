var xllist = new Array();
var dzlist = new Array();
//限量版招商
xllist[1] = new Array();
xllist[1]['id'] =  '8';
xllist[1]['img'] =  'http://image.8264.com/album/200906/29/16723445_12462401847mJu.gif';
xllist[1]['title'] =  '悠度诚招实力经销商';

xllist[2] = new Array();
xllist[2]['id'] =  '391';
xllist[2]['img'] =  'http://8.8264.com/file/upload/201103/31/13-58-58-99-4592.gif';
xllist[2]['title'] =  '山林路邀您共创财富';

xllist[3] = new Array();
xllist[3]['id'] =  '111';
xllist[3]['img'] =  'http://8.8264.com/file/upload/201203/27/14-29-43-50-1.gif';
xllist[3]['title'] =  '快乐出行，时尚舒适';

xllist[4] = new Array();
xllist[4]['id'] =  '710';
xllist[4]['img'] =  'http://8.8264.com/file/upload/201202/14/11-18-38-88-1.gif';
xllist[4]['title'] =  '诺可文诚邀实力加盟商 ';

xllist[5] = new Array();
xllist[5]['id'] =  '555';
xllist[5]['img'] =  'http://8.8264.com/file/upload/201109/05/09-50-37-92-1.gif';
xllist[5]['title'] =  'U-UP诚招加盟商';

xllist[6] = new Array();
xllist[6]['id'] =  '564';
xllist[6]['img'] =  'http://8.8264.com/file/upload/201109/15/09-42-19-53-1.gif';
xllist[6]['title'] =  '玛丁图背包火热招商';

xllist[7] = new Array();
xllist[7]['id'] =  '176';
xllist[7]['img'] =  'http://image.8264.com/album/200911/3/121546_1257235911Yx47.gif';
xllist[7]['title'] =  '零库存低风险低投入';

xllist[8] = new Array();
xllist[8]['id'] =  '214';
xllist[8]['img'] =  'http://image.8264.com/album/201008/24/16723445_1282628769lnJK.jpg';
xllist[8]['title'] =  'Pinewood户外品牌招商';

xllist[9] = new Array();
xllist[9]['id'] =  '460';
xllist[9]['img'] =  'http://8.8264.com/file/upload/201203/30/16-06-24-63-1.gif';
xllist[9]['title'] =  'AI ONE诚邀加盟商';

xllist[10] = new Array();
xllist[10]['id'] =  '483';
xllist[10]['img'] =  'http://8.8264.com/file/upload/201107/12/14-46-00-56-4539.gif';
xllist[10]['title'] =  '斯丽德专业户外防水剂';


//大众版招商
dzlist[0] = new Array();
dzlist[0]['id'] =  '384';
dzlist[0]['img'] =  'http://8.8264.com/file/upload/201107/08/15-41-21-97-1.gif';
dzlist[0]['title'] =  '数星客户外招商';

dzlist[2] = new Array();
dzlist[2]['id'] =  '195';
dzlist[2]['img'] =  'http://image.8264.com/album/201001/4/16723445_1262593677877w.jpg';
dzlist[2]['title'] =  '金帝狮(kingtex)品牌招商';

dzlist[3] = new Array();
dzlist[3]['id'] =  '266';
dzlist[3]['img'] =  'http://8.8264.com/file/upload/201011/17/09-42-27-16-28.jpg';
dzlist[3]['title'] =  '凯乐石全面招商';

dzlist[4] = new Array();
dzlist[4]['id'] =  '218';
dzlist[4]['img'] =  'http://image.8264.com/album/201010/8/16723445_1286517590AGPu.gif';
dzlist[4]['title'] =  '十点半 户外手表招商';

dzlist[5] = new Array();
dzlist[5]['id'] =  '9';
dzlist[5]['img'] =  'http://image.8264.com/album/200905/15/4_1242365053797M.jpg';
dzlist[5]['title'] =  '步行者户外用品全国招商';

dzlist[6] = new Array();
dzlist[6]['id'] =  '210';
dzlist[6]['img'] =  'http://8.8264.com/file/upload/201011/11/10-59-56-27-1.jpg';
dzlist[6]['title'] =  'SWS塞沃斯户外用品全国招商';

dzlist[7] = new Array();
dzlist[7]['id'] =  '217';
dzlist[7]['img'] =  'http://image.8264.com/album/201010/8/121546_1286502561H2Ca.jpg';
dzlist[7]['title'] =  'SUNY 诚招经销商';

dzlist[8] = new Array();
dzlist[8]['id'] =  '552';
dzlist[8]['img'] =  'http://8.8264.com/file/upload/201108/30/16-23-13-96-438.jpg';
dzlist[8]['title'] =  '曼哥夫品牌全面招商 ';

dzlist[9] = new Array();
dzlist[9]['id'] =  '46';
dzlist[9]['img'] =  'http://image.8264.com/album/200906/2/16723445_1243930799Tyts.jpg';
dzlist[9]['title'] =  'TTISS品牌滑雪系列招商';

dzlist[10] = new Array();
dzlist[10]['id'] =  '290';
dzlist[10]['img'] =  'http://8.8264.com/file/upload/201011/30/10-49-24-47-1.gif';
dzlist[10]['title'] =  '给您最好保护诚信招商';



//从一个给定的数组arr中,随机返回num个不重复项 
function getArrayItems(arr, num) { 
	//新建一个数组,将传入的数组复制过来,用于运算,而不要直接操作传入的数组; 
	var temp_array = new Array(); 
	for (var index in arr) { 
		temp_array.push(arr[index]); 
	} 
	//取出的数值项,保存在此数组 
	var return_array = new Array(); 
	for (var i = 0; i<num; i++) { 
		//判断如果数组还有可以取出的元素,以防下标越界 
		if (temp_array.length>0) { 
			//在数组中产生一个随机索引 
			var arrIndex = Math.floor(Math.random()*temp_array.length); 
			//将此随机索引的对应的数组元素值复制出来 
			return_array[i] = temp_array[arrIndex]; 
			//然后删掉此索引的数组元素,这时候temp_array变为新的数组 
			temp_array.splice(arrIndex, 1); 
		} else { 
			//数组中数据项取完后,退出循环,比如数组本来只有10项,但要求取出20项. 
			break; 
		} 
	} 
	return return_array; 
} 
function urlrequest(paras){ 
	var url = location.href;  
	var paraString = url.substring(url.indexOf("?")+1,url.length).split("&");  
	var paraObj = {}  
	for (i=0; j=paraString[i]; i++){  
		paraObj[j.substring(0,j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=")+1,j.length);  
	}  
	var returnValue = paraObj[paras.toLowerCase()];  
	if(typeof(returnValue)=="undefined"){  
		return "";  
	}else{  
		return returnValue; 
	}
}
