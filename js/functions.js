
function refreshCaptcha()
{
    var img = document.images['captchaimg'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}


function assValue(name,val)
{
document.getElementById(name).value=val;
}


function getHttpRequest()
{
if(window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
return xmlhttp;
}


function getInputs()
{
var xmlhttp;    
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   document.getElementById("Wri_Language").innerHTML=xmlhttp.responseText;
    }
 }
xmlhttp.open("GET","Wri_Language.php",true);
xmlhttp.send();
}


function getTable_view(func,ids)
{
var xmlhttp;    
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   document.getElementById("table_view").innerHTML=xmlhttp.responseText;
    }
 }
 var curr_page=document.forms["form"]["current_page"].value;
var page=curr_page+"_"+func+"_"+ids;
xmlhttp.open("GET","table_view.php?q="+page,true);
xmlhttp.send();
}


function getComments(func,id)
{
var xmlhttp;    
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   document.getElementById("comments").innerHTML=xmlhttp.responseText;
    }
 }
 var curr_comm=document.forms["form"]["current_comm"].value;
var c=curr_comm+"_"+func+"_"+id;
xmlhttp.open("GET","comments.php?q="+c,true);
xmlhttp.send();
}


function getfeedback(func,id)
{
var xmlhttp;    
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   document.getElementById("feedback").innerHTML=xmlhttp.responseText;
    }
 }
 var curr_comm=document.forms["form"]["current_feedback"].value;
var c=curr_comm+"_"+func+"_"+id;
xmlhttp.open("GET","getfeedback.php?q="+c,true);
xmlhttp.send();
}

function sayIt(text,lang) {
    text=encodeURIComponent(text);
    var url="https://translate.google.com/translate_tts?ie=UTF-8&client=tw-ob&tl="+lang+"&q="+text;
    var audio = document.getElementById("myAudio");
    audio.src = url;
//        try {
        audio.load();
	audio.play();
// }
// catch(err) {
// 	alert(err);
// 	}
}
