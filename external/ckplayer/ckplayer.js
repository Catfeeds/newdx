/*
JavaScript Document
ckplayer5.4,�����������http://www.ckplayer.com,��ӭ�����ķ���ṩ����ҷ���
�������ȫ��ѣ�����������ҵ�����ҵ����վ�������Ҫ��ҵ��Ȩ�Ļ�������ϵQQ:14926108,����ʱע��������ҵ��Ȩ������˵������ҵ��Ȩ�ĺ���ѵİ汾������ȫ��ͬ�����Ҽ������޸ĳ��Լ��ġ�
*/
function ckcpt() { //�Զ������ͼƬ��flash����������Լ�������Ӷ���Զ����ͼƬ����flash,��ע��ǰ��Ķ�Ҫ�����һ����������������ţ���Ϊ���������һ�����ü�
    var cpt = "";
    cpt += 'sch_lr.png,0,2,14,-36|';
    //�ֱ���ͼƬ��flash��ַ��ˮƽ���뷽ʽ����ֱ���뷽ʽ��ˮƽƫ��������ֱƫ����
    cpt += 'sch_lr.png,2,2,-15,-36|';
    return cpt;
}
function ckstyle() { //�����ܵķ��
    var ck = new Object();
    ck.cpath = 'ckplayer/assets/'; //�����·��
    ck.mylogo = 'logo.swf';
    ck.logo = 'cklogo.png,2,100,20';
    ck.buffer = 'buffer.swf';
    ck.controlbar = 'images_buttom_bg.png';
    ck.cplay = 'images_Play_out.png,images_Play_on.png';
    ck.cpause = 'images_Pause_out.png,images_Pause_on.png';
    ck.pausec = 'images_Pause_Scgedyke.png,images_Pause_Scgedyke_on.png';
    ck.sound = 'images_Sound_out.png,images_Sound_on.png';
    ck.mute = 'images_Mute_out.png,images_Mute_on.png';
    ck.full = 'images_Full_out.png,images_Full_on.png';
    ck.general = 'images_General_out.png,images_General_on.png';
    ck.cvolume = 'images_Volume_back.png,images_Volume_on.png,images_Volume_Float.png';
    ck.schedule = 'images_Schedule_bg.png,images_Schedule_load.png,images_Schedule_play.png,images_Schedule.png';
    ck.fast = 'images_Fashf_out.png,images_Fashf_on.png,images_Fashr_out.png,images_Fashr_on.png';
    ck.advmute = 'images_v_off.png,images_v_on.png';
    ck.advjump = 'images_adv_skip.png';
    ck.advclose = 'images_close_adv.png';
    ck.control_r = '"",2,1,-75,-100';
    ck.control_c = '"",1,1,-165,-90';
	ck.control_c2 = '"",1,1,-165,-90';
    //�Ҳ������ť���ļ�������
    ck.setup = '0,1,1,1';
    //�������ã��Ƿ�ʹ���������1��ʹ������0�ǲ�ʹ�ã��Ƿ�֧�ֵ�����ͣ1��֧��0��֧�֣��Ƿ�֧��˫��ȫ��1��֧��0��֧��,�ڲ���ǰ��flash���ʱ�Ƿ�ͬʱ������Ƶ
    ck.pm_spac = '|';
    //��Ƶ��ַ�������Ĭ��ʹ�ö��ţ������Ƶ��ַ�ﱾ����ڶ��ŵĻ���Ҫ��������һ���������ע�⣬��ʹֻ��һ����ƵҲ��Ҫ����
    ck.pm_ctbar = '1,2,0,-30,0,30,0,1,5000';
    //�������Ĳ���������ֶ������,��7�����������ö�λ��ʽ(0����Զ�λ��1�����Զ�λ)
    //0����һ������Ĳ���˵����Ĭ��1:�м���룬�����¶��룬����ߵľ��룬Y��ƫ���������ұߵľ��룬�߶ȣ���λ��ʽ�����ط�ʽ(0�����أ�1ȫ��ʱ���أ�2������)������ʱ��
    //1���ڶ�������Ĳ���˵���������Ҷ��룬�����¶��룬xƫ������yƫ�ƣ���ȣ��߶ȣ���λ��ʽ�����ط�ʽ(0�����أ�1ȫ��ʱ���أ�2������)������ʱ��
    ck.pm_sch = '1,2,15,-37,15,5,0,14,8';
    //�������Ĳ���������ֶ��������ǰ��7���������տ������ģ���8���������϶���ť�Ŀ���9���������϶���ť�ĸ�
    ck.pm_play = '0,2,0,-30';
    //���ź���ͣ��ť������
    ck.pm_clock = '0,2,40,-25,70';
    //�Ѳ���ʱ�������Ϳ��
    ck.pm_clock2 = '0,2,70,-25,70';
    //��ʱ�������Ϳ��
    ck.pm_full = '2,2,-35,-30';
    //ȫ����ȡ��ȫ����ť������
    ck.pm_vol = '2,2,-95,-18,53,4,6,12';
    //�������ڿ�����꣬��ȣ��߶ȣ��϶���ť�Ŀ��,�߶�
    ck.pm_sound = '2,2,-130,-30';
    //������ȡ������������
    ck.pm_fastf = '2,2,-13,-39';
    //�����ť������
    ck.pm_fastr = '0,2,0,-39';
    //���˰�ť������
    ck.pm_fasttime = '10';
    //����Ϳ��˵�����
    ck.pm_video_bottom = '35,35';
    //��Ƶ��ײ��ľ��룬���ĵײ��ο�����-�ò����������뵽��վ�鿴
    ck.pm_video_bo = '200,1';
    //��Ƶ����ʱ��-Ĭ��200����,�Ƿ��Ż���Ƶ-Ĭ��Ϊ1�Ż�
    ck.pm_pa = '0,30';
    //�Ƿ��Զ������м���ͣ��ť��λ��-Ĭ��0�Զ�����1�ǲ��Զ��������м���ͣ��ť��͸����
    ck.pm_buffer_wh = '30,30';
    //����ͼƬ�Ŀ�Ͷ�
    ck.pm_pr = '0x000000,0xfdfdfd,0xffffff,6,30,80,18,5';
    //��ʾ�򱳾���ɫ,�߿���ɫ,���ֵ���ɫ,�߿�Ļ���,��ʾ��͸����,����͸����,��ʾ��ĸ߶�,�밴ť�ľ���
    ck.pm_advmaskap = '50';
    //����ǰ�ù��ʱ�ײ�͸����0-100,ֻ��flash��Ч����Ƶʱ���Զ����ؿ�������ͼƬʱ���Զ����ó�0����Ϊ������
    ck.pm_advstatus = '1,3,280,30';
    //ǰ�ù���Ƿ���ʾ������ť(0/1),λ��(0/1/2/3),x,y
    ck.pm_advjp = '1,0,3,190,30';
    //ǰ�ù���Ƿ���ʾ������水ť,������ť��������(ֵ0/1,0��ֱ����ת,1�Ǵ���js:function ckadjump(){}),���뷽ʽ,x,y
    ck.pm_advtime = '100,3,100,30';
    //ǰ�ù�浹��ʱ�ı���,���뷽ʽ,x,y
    ck.pm_advmarquee = '1,1,2,50,-60,50,18,0,0,15,3000,1,20,0x000000';
    //�������Ĳ���������ֶ������,��8�����������ö�λ��ʽ(0����Զ�λ��1�����Զ�λ)
    //0����һ������Ĳ���˵�����Ƿ���ʾ��Ĭ��1:�м���룬�����¶��룬����ߵľ��룬Y��ƫ���������ұߵľ��룬�߶ȣ���λ��ʽ����������0����1���ϣ��������о࣬�ƶ���λ���أ��ƶ���λʱ�������Ϲ���ʱÿ��ͣ��ʱ�䣬������ɫ
    //1���ڶ�������Ĳ���˵���������Ҷ��룬�����¶��룬xƫ������yƫ�ƣ���ȣ��߶ȣ���λ��ʽ����������0����1���ϣ�������ʱ�ĸ߶ȣ������о࣬�ƶ���λ���أ��ƶ���λʱ�������Ϲ���ʱÿ��ͣ��ʱ�䣬������ɫ
    //�Ƿ���ʾ�ײ����(0/1),������ɫ,�߶�,��ߵľ���,�ұߵľ���,������ľ���,�����ľ���(0��ֹ),��϶ʱ��(ԽСԽ��,���鲻С��20),������������Ҫ��function ckmarqueeadv(){return '�������'}
    ck.advmarquee = '';
    ck.pm_advms = '1,3,40,55';
    //��������Ƿ���ʾ�رհ�ť(0/1),λ��(0/1/2/3),x,y
    ck.pm_load = '70,20,0,40,{font color="#FFFFFF"}�Ѽ���[$prtage]%{/font},{font color="#FFFFFF"}����ʧ��{/font}';
    //������Ƶ�ٷֱȵ�λ��Ĭ�Ͼ��У�����˵�������,�߶�,��ƫ�ƣ���/��������ƫ��(��/��),�ַ�[$prtage]�����Զ��滻�ɰٷֱȵ�����,����ʧ�ܵ���ʾ
    ck.pm_buffer = '25,20,0,0,{font color="#FFFFFF"}[$buffer]%{/font}';
    //��Ƶ����ٷֱȵ�λ��Ĭ�Ͼ��У�����˵�������,�߶�,��ƫ�ƣ���/��������ƫ��(��/��),ֻ��ʾ�ٷֱ�����
    ck.statustrue =0;
    ck.pr_play = '�������';
    ck.pr_pause = '�����ͣ';
    ck.pr_mute = '�������';
    ck.pr_nomute = 'ȡ������';
    ck.pr_full = '���ȫ��';
    ck.pr_nofull = '�˳�ȫ��';
    ck.pr_fastf = '���';
    ck.pr_fastr = '����';
    ck.pr_time = '[$Time]';
    //[$Time]���Զ��滻Ŀǰ������ʾ
    ck.pr_volume = '[$Volume]';
    //[$Volume]���Զ��滻����
    ck.pr_clock = '{font color="#FFFFFF" size="12"}[$Time]{/font}';
    //���ﶨ�����ʱ�����ʾ������ͬʱ���滻����������[$Time]�ᱻ�滻���Ѳ���ʱ�䣬[$TimeAll]�ᱻ�滻����ʱ��
    ck.pr_clock2 = '{font color="#FFFFFF" size="12"}| [$TimeAll]{/font}';
    //ͬpr_clock,���������ȵģ���Ҫ��Ϊ�˷����ڲ�ͬ�ĵط������Ѳ���ʱ�����ʱ��
    ck.pr_adv = '{font color="#FFFFFF" size="12"}���ʣ�ࣺ{font color="#FF0000" size="14"}{b}[$Second]{/b}{/font} ��{/font}';
    ck.myweb = '"",""';
    ck.cpt_list = ckcpt();
    return ck;
}
function ckplayer_hqurl(str){var webagreement=document.location.protocol;var dqljurl=unescape(window.location.href).replace("file:///","");var dqweburl=document.location.protocol+'//'+document.location.hostname;var lagree='';var iswb=0;var geturl='';var geturlt='';var strs=new Array();strs=str.split('//');if(strs.length>0){lagree=strs[0]+'//'}var httpgreenall="http|https|ftp|rtsp|mms|ftp|rtmp";var httparray=new Array();httparray=httpgreenall.split('|');for(i=0;i<httparray.length;i++){if((httparray[i]+'://')==lagree){iswb=1;break}}if(iswb==0){if(str.substr(0,1)=='/'){geturlt=dqweburl+str}else{geturl=dqljurl.substring(0,dqljurl.lastIndexOf("/")+1).replace("\\","/");strt=str.replace('../','./');var str2=new Array();str2=strt.split('./');var str2length=str2.length;var strs=strt.replace('./','');var urlt=new Array();urlt=geturl.split('/');var jqcd=urlt.length-str2length;for(i=0;i<(jqcd);i++){geturlt+=urlt[i]+'/'}geturlt+=strs}}else{geturlt=str}return geturlt;}
function swfupload() {
    this.ckplayer_url = '';
    this.ckplayer_flv = '';
    this.ckplayer_pat = '';
    this.ckplayer_style = 1;
    this.ckplayer_default = 0;
    this.ckplayer_xml = '';
    this.ckplayer_volume = 50;
    this.ckplayer_play = 1;
    this.ckplayer_width = 600;
    this.ckplayer_height = 400;
    this.ckplayer_bgcolor = '#000000';
    this.ckplayer_allowFullScreen = false;
    this.ckplayer_loadimg = '';
    this.ckplayer_pauseflash = '';
    this.ckplayer_pauseurl = '';
    this.ckplayer_loadadv = '';
    this.ckplayer_loadurl = '';
    this.ckplayer_loadtime = 0;
    this.ckplayer_endstatus = 0;
    this.swfwrite = function(str) {
        if (this.ckplayer_url) {
            this.ckplayer_url = ckplayer_hqurl(this.ckplayer_url)
        }
        if (this.ckplayer_flv) {
            this.ckplayer_flv = ckplayer_hqurl(this.ckplayer_flv)
        }
        var swfhtml = '';
        swfhtml += '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="' + this.ckplayer_width + '" height="' + this.ckplayer_height + '" id="ckplayer_' + str + '" align="middle">';
        swfhtml += '		<param name="movie" value="' + this.ckplayer_url + '" />';
        swfhtml += '		<param name="quality" value="high" />';
        swfhtml += '		<param name="bgcolor" value="' + this.ckplayer_bgcolor + '" />';
        swfhtml += '		<param name="wmode" value="transparent" />';
        swfhtml += '		<param name="allowScriptAccess" value="sameDomain" />';
        swfhtml += '      <param name="allowFullScreen" value="' + this.ckplayer_allowFullScreen + '" />';
        swfhtml += '      <param name="Flashvars" value="v=' + this.ckplayer_volume + '&p=' + this.ckplayer_play + '&f=' + this.ckplayer_flv + '&i=' + this.ckplayer_loadimg + '&d=' + this.ckplayer_pauseflash + '&u=' + this.ckplayer_pauseurl + '&l=' + this.ckplayer_loadadv + '&r=' + this.ckplayer_loadurl + '&t=' + this.ckplayer_loadtime + '&e=' + this.ckplayer_endstatus + '&a=' + this.ckplayer_pat + '&s=' + this.ckplayer_style + '&x=' + this.ckplayer_xml + '&c=' + this.ckplayer_default + '" />';
        swfhtml += '      <embed src="' + this.ckplayer_url + '" flashvars="v=' + this.ckplayer_volume + '&p=' + this.ckplayer_play + '&f=' + this.ckplayer_flv + '&i=' + this.ckplayer_loadimg + '&d=' + this.ckplayer_pauseflash + '&u=' + this.ckplayer_pauseurl + '&l=' + this.ckplayer_loadadv + '&r=' + this.ckplayer_loadurl + '&t=' + this.ckplayer_loadtime + '&e=' + this.ckplayer_endstatus + '&a=' + this.ckplayer_pat + '&s=' + this.ckplayer_style + '&x=' + this.ckplayer_xml + '&c=' + this.ckplayer_default + '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="' + this.ckplayer_width + '" height="' + this.ckplayer_height + '" allowFullScreen="' + this.ckplayer_allowFullScreen + '"></embed>';
        swfhtml += '	</object>';
        document.getElementById(str).style.width = this.ckplayer_width + 'px';
        document.getElementById(str).style.height = this.ckplayer_height + 'px';
        document.getElementById(str).style.backgroundColor = this.ckplayer_bgcolor;
        document.getElementById(str).innerHTML = swfhtml;
    }
}