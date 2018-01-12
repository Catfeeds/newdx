function picMove_eleme(text){
  var div = document.createElement("div");
  var pic = document.createElement("div");
  var text_1 = document.createTextNode("¹Ø±Õ");
  var b = document.createElement("b");
  document.body.appendChild(div);
  div.appendChild(pic);
  div.appendChild(b);
  b.appendChild(text_1);
  div.setAttribute("id","floatPic");
  pic.setAttribute("class","pic");
  pic.innerHTML=text;
}
function picMove(){
  var myPic=document.getElementById("floatPic");
  var b = myPic.getElementsByTagName("b")[0];
  var cw=document.documentElement.clientWidth;
  var ch=document.documentElement.clientHeight;
  var top =document.documentElement.scrollTop;
  b.onclick = function(){
     this.parentNode.style.display="none";
     //clearInterval(mytime);
   }
   if(cw<=1024){myPic.style.right = 0+"px";}
   if(cw>1024 && ch<800){myPic.style.right = 0+"px";}
   if(cw>1024 && ch>800) {myPic.style.right = 0;}
   
   myPic.style.top=top + ch-230+"px";
}
setInterval ("picMove()",200);
