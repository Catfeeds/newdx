/**
 * ==========================================
 * config.js
 * Copyright (c) 2010 wwww.114la.com
 * Author: cai@115.com
 * ==========================================
 */

var Config = {
    Mail: [{
        val: 0
    }, { //163.com
        action: "http://reg.163.com/CheckUser.jsp",
        params: {
            url: "http://fm163.163.com/coremail/fcg/ntesdoor2?lightweight=1&verifycookie=1&language=-1&style=15",
            username: "#{u}",
            password: "#{p}"
        }
    }, { //126.com
        action: "https://reg.163.com/logins.jsp",
        params: {
            domain: "126.com",
            username: "#{u}@126.com",
            password: "#{p}",
            url: "http://entry.mail.126.com/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26language%3D0%26style%3D-1"
        }
    }, { //vip.163.com
        action: "https://ssl1.vip.163.com/logon.m",
        params: {
            username: "#{u}",
            password: "#{p}",
            enterVip: true
        }
    }, { //sina.com
        action: "http://mail.sina.com.cn/cgi-bin/login.cgi",
        params: {
            u: "#{u}",
            psw: "#{p}"
        }
    }, { //vip.sina.com
        action: "http://vip.sina.com.cn/cgi-bin/login.cgi",
        params: {
            user: "#{u}",
            pass: "#{p}"
        }
    }, { //yahoo.com.cn
        action: "https://edit.bjs.yahoo.com/config/login",
        params: {
            login: "#{u}@yahoo.com.cn",
            passwd: "#{p}",
            domainss: "yahoo",
            ".intl": "cn",
            ".src": "ym"
        }
    }, { //yahoo.cn
        action: "https://edit.bjs.yahoo.com/config/login",
        params: {
            login: "#{u}@yahoo.cn",
            passwd: "#{p}",
            domainss: "yahoocn",
            ".intl": "cn",
            ".done": "http://mail.cn.yahoo.com/inset.html"
        }
    }, { //sohu.com
        action: "http://passport.sohu.com/login.jsp",
        params: {
            loginid: "#{u}@sohu.com",
            passwd: "#{p}",
            fl: "1",
            vr: "1|1",
            appid: "1000",
            ru: "http://login.mail.sohu.com/servlet/LoginServlet",
            ct: "1173080990",
            sg: "5082635c77272088ae7241ccdf7cf062"
        }
    }, { //tom.com
        action: "http://login.mail.tom.com/cgi/login",
        params: {
            user: "#{u}",
            pass: "#{p}"
        }
    }, { //21cn.com
        action: "http://passport.21cn.com/maillogin.jsp",
        params: {
            UserName: "#{u}@21cn.com",
            passwd: "#{p}",
            domainname: "21cn.com"
        }
    }, { //yeah.net
        action: "https://reg.163.com/logins.jsp",
        params: {
            domain: "yeah.net",
            username: "#{u}@yeah.net",
            password: "#{p}",
            url: "http://entry.mail.yeah.net/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26style%3D-1"
        }
    }, { //tianya
        action: "http://www.tianya.cn/user/loginsubmit.asp",
        params: {
            vwriter: "#{u}",
            vpassword: "#{p}"
        }
    }, { //百度帐号
        action: "http://passport.baidu.com/?login",
        params: {
            u: "http://passport.baidu.com/center",
            username: "#{u}",
            password: "#{p}"
        }
    }, { //renren
        action: "http://passport.renren.com/PLogin.do",
        params: {
            email: "#{u}",
            password: "#{p}",
            origURL: "http://www.renren.com/Home.do",
            domain: "renren.com"
        }
    }, { //51.com
        action: "http://passport.51.com/login.5p",
        params: {
            passport_51_user: "#{u}",
            passport_51_password: "#{p}",
            gourl: "http%3A%2F%2Fmy.51.com%2Fwebim%2Findex.php"
        }
    }, { //chinaren
        action: "http://passport.sohu.com/login.jsp",
        params: {
            loginid: "#{u}@chinaren.com",
            passwd: "#{p}",
            fl: "1",
            vr: "1|1",
            appid: "1005",
            ru: "http://profile.chinaren.com/urs/setcookie.jsp?burl=http://alumni.chinaren.com/",
            ct: "1174378209",
            sg: "84ff7b2e1d8f3dc46c6d17bb83fe72bd"
        }
    
    }, {
        val: 0
    }, {
        action: "http://www.kaixin001.com/",
        type: "link"
    }, {
        action: "http://qzone.qq.com/",
        type: "link"
    }, {
        action: "http://mail.qq.com/cgi-bin/loginpage",
        type: "link"
    }, {
    
        action: "http://mail.139.com/",
        type: "link"
    }, {
        action: "http://gmail.google.com/",
        type: "link"
    }, {
        action: "http://www.qiaoqiao_hotmail.com/",
        type: "link"
    }, {
    
        action: "http://www.188.com/",
        type: "link"
    }],
	banner:{
		b4:{
			img:"static/images/banner/taoke12060.jpg",
			url:"http://pindao.huoban.taobao.com/channel/channelMall.htm?pid=mm_10005319_0_0"
		}
	},
	Track:[
		[]
	],
	Keywords:[]  

}

function getProId(proName){
    var ProId;
    CityArr.forEach(function(element, index, array){
        if (element[0] == proName) {
            ProId = element[2]
        }
    })
    return ProId
}

function getCityId(ProId, CityName){
    var CityId;
    CityArr.forEach(function(element, index, array){
        if (element[0] == CityName && element[1] == ProId) {
            CityId = element[2]
        }
    })
    return CityId
}
var Calendar = (function(){
    /*农历日历*/
    var lunarInfo = [0x04bd8,0x04ae0,0x0a570,0x054d5,0x0d260,0x0d950,0x16554,0x056a0,0x09ad0,0x055d2,0x04ae0,0x0a5b6,0x0a4d0,0x0d250,0x1d255,0x0b540,0x0d6a0,0x0ada2,0x095b0,0x14977,0x04970,0x0a4b0,0x0b4b5,0x06a50,0x06d40,0x1ab54,0x02b60,0x09570,0x052f2,0x04970,0x06566,0x0d4a0,0x0ea50,0x06e95,0x05ad0,0x02b60,0x186e3,0x092e0,0x1c8d7,0x0c950,0x0d4a0,0x1d8a6,0x0b550,0x056a0,0x1a5b4,0x025d0,0x092d0,0x0d2b2,0x0a950,0x0b557,0x06ca0,0x0b550,0x15355,0x04da0,0x0a5b0,0x14573,0x052b0,0x0a9a8,0x0e950,0x06aa0,0x0aea6,0x0ab50,0x04b60,0x0aae4,0x0a570,0x05260,0x0f263,0x0d950,0x05b57,0x056a0,0x096d0,0x04dd5,0x04ad0,0x0a4d0,0x0d4d4,0x0d250,0x0d558,0x0b540,0x0b6a0,0x195a6,0x095b0,0x049b0,0x0a974,0x0a4b0,0x0b27a,0x06a50,0x06d40,0x0af46,0x0ab60,0x09570,0x04af5,0x04970,0x064b0,0x074a3,0x0ea50,0x06b58,0x055c0,0x0ab60,0x096d5,0x092e0,0x0c960,0x0d954,0x0d4a0,0x0da50,0x07552,0x056a0,0x0abb7,0x025d0,0x092d0,0x0cab5,0x0a950,0x0b4a0,0x0baa4,0x0ad50,0x055d9,0x04ba0,0x0a5b0,0x15176,0x052b0,0x0a930,0x07954,0x06aa0,0x0ad50,0x05b52,0x04b60,0x0a6e6,0x0a4e0,0x0d260,0x0ea65,0x0d530,0x05aa0,0x076a3,0x096d0,0x04bd7,0x04ad0,0x0a4d0,0x1d0b6,0x0d250,0x0d520,0x0dd45,0x0b5a0,0x056d0,0x055b2,0x049b0,0x0a577,0x0a4b0,0x0aa50,0x1b255,0x06d20,0x0ada0,0x14b63];
    var Gan = new Array("甲", "乙", "丙", "丁", "戊", "己", "庚", "辛", "壬", "癸");
    var Zhi = new Array("子", "丑", "寅", "卯", "辰", "巳", "午", "未", "申", "酉", "戌", "亥");
    var now = new Date();
    var SY = now.getFullYear();
    var SM = now.getMonth();
    var SD = now.getDate();
    function cyclical(num){
        return (Gan[num % 10] + Zhi[num % 12])
    }
    function lYearDays(y){
        var i, sum = 348;
        for (i = 0x8000; i > 0x8; i >>= 1) 
            sum += (lunarInfo[y - 1900] & i) ? 1 : 0;
        return (sum + leapDays(y))
    }
    function leapDays(y){
        if (leapMonth(y)) 
            return ((lunarInfo[y - 1900] & 0x10000) ? 30 : 29);
        else 
            return (0)
    }
    function leapMonth(y){
        return (lunarInfo[y - 1900] & 0xf)
    }
    function monthDays(y, m){
        return (lunarInfo[y - 1900] & (0x10000 >> m)) ? 30 : 29
    }
    function Lunar(objDate){
        var i, leap = 0, temp = 0;
        var baseDate = new Date(1900, 0, 31);
        var offset = (objDate - baseDate) / 86400000;
        this.dayCyl = offset + 40;
        this.monCyl = 14;
        for (i = 1900; i < 2050 && offset > 0; i++) {
            temp = lYearDays(i);
            offset -= temp;
            this.monCyl += 12
        }
        if (offset < 0) {
            offset += temp;
            i--;
            this.monCyl -= 12
        }
        this.year = i;
        this.yearCyl = i - 1864;
        leap = leapMonth(i);
        this.isLeap = false;
        for (i = 1; i < 13 && offset > 0; i++) {
            if (leap > 0 && i == (leap + 1) && this.isLeap == false) {
                --i;
                this.isLeap = true;
                temp = leapDays(this.year)
            }
            else {
                temp = monthDays(this.year, i)
            }
            if (this.isLeap == true && i == (leap + 1)) {
                this.isLeap = false
            }
            offset -= temp;
            if (this.isLeap == false) {
                this.monCyl++
            }
        }
        if (offset == 0 && leap > 0 && i == leap + 1) {
            if (this.isLeap) {
                this.isLeap = false
            }
            else {
                this.isLeap = true;
                --i;
                --this.monCyl
            }
        }
        if (offset < 0) {
            offset += temp;
            --i;
            --this.monCyl
        }
        this.month = i;
        this.day = offset + 1
    }
    
    function cDay(m, d){
        var nStr1 = ['日', '一', '二', '三', '四', '五', '六', '七', '八', '九', '十'];
        var nStr2 = ['初', '十', '廿', '卅'];
        var s;
        if (m > 10) {
            s = '十' + nStr1[m - 10]
        }
        else {
            s = nStr1[m]
        }
		if(s=='一'){
			s='正';
		}
        s += '月';
        switch (d) {
            case 10:
                s += '初十';
                break;
            case 20:
                s += '二十';
                break;
            case 30:
                s += '三十';
                break;
            default:
                s += nStr2[Math.floor(d / 10)];
                s += nStr1[parseInt(d % 10)]
        }
        return (s)
    }
    
    function solarDay2(){
    	
        var lDObj = new Lunar(new Date(SY, SM, SD));
        var tt = cDay(lDObj.month, lDObj.day);
        return (tt)
    }
    function showToday(){
        var weekStr = "日一二三四五六";
        var template = '<a href="http://tool.114la.com/live/calendar/" rel="nr" title="点击查看万年历" target="_blank">#{YY}年#{MM}月#{DD}日 星期#{week} </a>';
        var day = format(template, {
            YY: SY,
            MM: SM + 1,
            DD: SD,
            week: weekStr.charAt(now.getDay())
        
        });
        return day;
    }
	
	function showdate(){
		SD = SD+1;
		var m = SM<9?('0'+(SM+1)):SM+1;
		var d = SD+1<10?('0'+SD):SD;
		return (SY+'-'+m+'-'+d);
	}
	function cncal(){
		var cacal = '<a href="http://tool.115.com/live/calendar/" rel="nr" title="点击查看万年历" target="_blank">农历 '+ solarDay2() +'</a>';
		return cacal;
	}
    
    return {
        day: showToday,
		cnday :cncal,
		date:showdate
    }
    
})();

