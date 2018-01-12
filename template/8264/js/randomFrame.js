/*!
 * Random Frame Loader v1.0.1
 *
 * Copyright (c) 2009 Hal Guo
 * Dual licensed under the MIT and GPL licenses.
 *
 * Date: 2009-12-10 23:09:03 +0800 
 */
var randomFrame = function(){
  var pages = [];
  var max = 0;
  var frameObj;
  var frames = [];
  var seed;
  var rand;
  var bigRand;
  var getRand = function(maxRange){
       max = maxRange;
       seed = new Date().getMilliseconds();
       rand = Math.floor(Math.random(seed)*max);
       bigRand = Math.floor(Math.random(seed)*9999);
  };
    return {
    setPages:function(pageArray){
       pages = pageArray;   
       max = pages.length;
    },
    setFrames:function(frameArray){
       frames = frameArray;           
    },
    getRandomPage: function(frameId){
       getRand(pages.length);
        // say goodbye to cache by adding a big random parameter 
       var url = pages[rand]+"?r="+bigRand;
       frameObj = document.getElementById(frameId);
       frameObj.src = url;
    }, 
    getRandomFrame:function(){
       getRand(frames.length);
       document.getElementById(frames[rand]).style.display = "block";
    }
  };
 
};

 
//sample code 
var randMe = new randomFrame();
var frames = ['jupianyiFrame','franchiseFrame'];
randMe.setFrames(frames);
randMe.getRandomFrame();
