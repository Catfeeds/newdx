var xllist = new Array();
var dzlist = new Array();
//����������
xllist[1] = new Array();
xllist[1]['id'] =  '8';
xllist[1]['img'] =  'http://image.8264.com/album/200906/29/16723445_12462401847mJu.gif';
xllist[1]['title'] =  '�ƶȳ���ʵ��������';

xllist[2] = new Array();
xllist[2]['id'] =  '391';
xllist[2]['img'] =  'http://8.8264.com/file/upload/201103/31/13-58-58-99-4592.gif';
xllist[2]['title'] =  'ɽ��·���������Ƹ�';

xllist[3] = new Array();
xllist[3]['id'] =  '111';
xllist[3]['img'] =  'http://8.8264.com/file/upload/201203/27/14-29-43-50-1.gif';
xllist[3]['title'] =  '���ֳ��У�ʱ������';

xllist[4] = new Array();
xllist[4]['id'] =  '710';
xllist[4]['img'] =  'http://8.8264.com/file/upload/201202/14/11-18-38-88-1.gif';
xllist[4]['title'] =  'ŵ���ĳ���ʵ�������� ';

xllist[5] = new Array();
xllist[5]['id'] =  '555';
xllist[5]['img'] =  'http://8.8264.com/file/upload/201109/05/09-50-37-92-1.gif';
xllist[5]['title'] =  'U-UP���м�����';

xllist[6] = new Array();
xllist[6]['id'] =  '564';
xllist[6]['img'] =  'http://8.8264.com/file/upload/201109/15/09-42-19-53-1.gif';
xllist[6]['title'] =  '�궡ͼ������������';

xllist[7] = new Array();
xllist[7]['id'] =  '176';
xllist[7]['img'] =  'http://image.8264.com/album/200911/3/121546_1257235911Yx47.gif';
xllist[7]['title'] =  '����ͷ��յ�Ͷ��';

xllist[8] = new Array();
xllist[8]['id'] =  '214';
xllist[8]['img'] =  'http://image.8264.com/album/201008/24/16723445_1282628769lnJK.jpg';
xllist[8]['title'] =  'Pinewood����Ʒ������';

xllist[9] = new Array();
xllist[9]['id'] =  '460';
xllist[9]['img'] =  'http://8.8264.com/file/upload/201203/30/16-06-24-63-1.gif';
xllist[9]['title'] =  'AI ONE����������';

xllist[10] = new Array();
xllist[10]['id'] =  '483';
xllist[10]['img'] =  'http://8.8264.com/file/upload/201107/12/14-46-00-56-4539.gif';
xllist[10]['title'] =  '˹����רҵ�����ˮ��';


//���ڰ�����
dzlist[0] = new Array();
dzlist[0]['id'] =  '384';
dzlist[0]['img'] =  'http://8.8264.com/file/upload/201107/08/15-41-21-97-1.gif';
dzlist[0]['title'] =  '���ǿͻ�������';

dzlist[2] = new Array();
dzlist[2]['id'] =  '195';
dzlist[2]['img'] =  'http://image.8264.com/album/201001/4/16723445_1262593677877w.jpg';
dzlist[2]['title'] =  '���ʨ(kingtex)Ʒ������';

dzlist[3] = new Array();
dzlist[3]['id'] =  '266';
dzlist[3]['img'] =  'http://8.8264.com/file/upload/201011/17/09-42-27-16-28.jpg';
dzlist[3]['title'] =  '����ʯȫ������';

dzlist[4] = new Array();
dzlist[4]['id'] =  '218';
dzlist[4]['img'] =  'http://image.8264.com/album/201010/8/16723445_1286517590AGPu.gif';
dzlist[4]['title'] =  'ʮ��� �����ֱ�����';

dzlist[5] = new Array();
dzlist[5]['id'] =  '9';
dzlist[5]['img'] =  'http://image.8264.com/album/200905/15/4_1242365053797M.jpg';
dzlist[5]['title'] =  '�����߻�����Ʒȫ������';

dzlist[6] = new Array();
dzlist[6]['id'] =  '210';
dzlist[6]['img'] =  'http://8.8264.com/file/upload/201011/11/10-59-56-27-1.jpg';
dzlist[6]['title'] =  'SWS����˹������Ʒȫ������';

dzlist[7] = new Array();
dzlist[7]['id'] =  '217';
dzlist[7]['img'] =  'http://image.8264.com/album/201010/8/121546_1286502561H2Ca.jpg';
dzlist[7]['title'] =  'SUNY ���о�����';

dzlist[8] = new Array();
dzlist[8]['id'] =  '552';
dzlist[8]['img'] =  'http://8.8264.com/file/upload/201108/30/16-23-13-96-438.jpg';
dzlist[8]['title'] =  '�����Ʒ��ȫ������ ';

dzlist[9] = new Array();
dzlist[9]['id'] =  '46';
dzlist[9]['img'] =  'http://image.8264.com/album/200906/2/16723445_1243930799Tyts.jpg';
dzlist[9]['title'] =  'TTISSƷ�ƻ�ѩϵ������';

dzlist[10] = new Array();
dzlist[10]['id'] =  '290';
dzlist[10]['img'] =  'http://8.8264.com/file/upload/201011/30/10-49-24-47-1.gif';
dzlist[10]['title'] =  '������ñ�����������';



//��һ������������arr��,�������num�����ظ��� 
function getArrayItems(arr, num) { 
	//�½�һ������,����������鸴�ƹ���,��������,����Ҫֱ�Ӳ������������; 
	var temp_array = new Array(); 
	for (var index in arr) { 
		temp_array.push(arr[index]); 
	} 
	//ȡ������ֵ��,�����ڴ����� 
	var return_array = new Array(); 
	for (var i = 0; i<num; i++) { 
		//�ж�������黹�п���ȡ����Ԫ��,�Է��±�Խ�� 
		if (temp_array.length>0) { 
			//�������в���һ��������� 
			var arrIndex = Math.floor(Math.random()*temp_array.length); 
			//������������Ķ�Ӧ������Ԫ��ֵ���Ƴ��� 
			return_array[i] = temp_array[arrIndex]; 
			//Ȼ��ɾ��������������Ԫ��,��ʱ��temp_array��Ϊ�µ����� 
			temp_array.splice(arrIndex, 1); 
		} else { 
			//������������ȡ���,�˳�ѭ��,�������鱾��ֻ��10��,��Ҫ��ȡ��20��. 
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
