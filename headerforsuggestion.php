<?php
// session_start();
include_once 'usercheck.php';
if (isset($_SESSION['languages'])) {
    $languages = $_SESSION['languages'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>GMS Suggestion</title>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"/></script>
        <script type="text/javascript" src="js/custom.js"/></script>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<style>
body {
    width:100%;
}
#page {
    position: relative;
    width:86%;
    margin-left:7%;
    background-color:#FFFFFF;
background-image:url(page_back.gif);
}
.table, .td, .th
{
border:1px solid blue;

}
th
{
background-image:url(table_header.gif);
color:white;
}
td
{
padding:8px;
}


.font{font-family:"Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;}
.font_size{font-size:42px; }
.a:link {color:blue; text-decoration:none}    
.a:visited {color:blue; text-decoration:none;} 
.a:hover {color:red; text-decoration:underline;}  
.a:active {color:green; text-decoration:none;} 
a:link {color:blue; text-decoration:none}    
a:visited {color:blue; text-decoration:none;} 
a:hover {color:red; text-decoration:underline;}  
a:active {color:green; text-decoration:none;}  
.style1 {font-size: 36px}
body,td,th {
    font-family:"Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
}

input.back{ float: left; background:url(images/back.png) no-repeat 6px 5px; width: 25px; height:25px; border: 0; cursor: pointer;}
input.next{ float: left; background:url(images/next.png) no-repeat 6px 5px; width: 25px; height:25px; border: 0; cursor: pointer;}
input.delete{ float: left; background:url(images/drop.png) no-repeat 6px 5px; width: 50px; height:50px; border: 0; cursor: pointer;}
</style>
<script type="text/javascript">
function assValue(name,val)
{
document.getElementById(name).value=val;
}
</script>
<script type="text/javascript">
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
</script>
<script type="text/javascript">
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
</script>
<script type="text/javascript">
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
</script>
<script type="text/javascript">
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
</script>
</head>

<body background="body.png"><div id="page">
<img src="header.png" width="100%" />
<table width='100%' border="0"  align="left" cellpadding="2"  cellspacing="1" style="background-image:url(page_back.gif)">
<tr>
                <td colspan="2">
<?php
$user_type = 0;
$email     = $_SESSION['email'];
//get the mail address from system_user table. only administrator email available in the system table
$resultut  = mysqli_query($con, "SELECT * FROM system_user WHERE email='" . $email . "'");
if ($resultut) {
    if ($rowut = mysqli_fetch_array($resultut, MYSQLI_ASSOC)) {
        $user_type = $rowut['user_type'];
    }
}
?>                
                  &nbsp;<a href="home2.php" ><b>Home</b></a>
<?php
if ($user_type == "Admin") {
?>
                | <a href="addterm.php"><b>Add Term</b></a>
<?php
}
?>
<?php
if ($user_type != "Admin") {
?>
                | <a href="Add_Suggestion.php" id="sugg_term"><b>Suggest Term</b></a>
<?php
}
?>
                | <a href="Suggestion.php" ><b><font color='#006666'>Suggestions</font></b> </a> 
                   <?php
if ($user_type == "Admin") {
?>
                | <a href="user.php"><b>User Details</b></a>
                  <?php
}
if ($user_type == "Admin") {
?>
                | <a href="feedback.php"><b>Feedback</b></a>
                  <?php
}
?>

                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="account_setting.php" ><b >Account Setting</b></a>|  <a href="logout.php" ><b >logout</b></a></td></tr></br>                  
                 
       <tr>  <td align="left" style="background-image:url(table_header.gif)"><form action="searchsuggestion.php" method="post">
<input type="text" name="key" size="40" value="">
  <input type="submit" name="Search"  value="Search" style="width:120px; height:30px; " />  <br></form></td>

              
              <?php
echo "<tr><td colspan='2' bgcolor='#869FFF'> ";
echo "<a href='A' class='a'></a>|<a href='As.php?letter=A'>A</a>
<a href='B' class='a'></a>|<a href='As.php?letter=b'>B</a>                
                <a href='C' class='a'></a>|<a href='As.php?letter=C'>C</a>
              <a href='D' class='a'></a>|<a href='As.php?letter=D'>D</a>
               <a href='E' class='a'></a>|<a href='As.php?letter=E'>E</a>
               <a href='F' class='a'></a>|<a href='As.php?letter=F'>F</a>
               <a href='G' class='a'></a>|<a href='As.php?letter=G'>G</a>
               <a href='H' class='a'></a>|<a href='As.php?letter=H'>H</a>
               <a href='I' class='a'></a>|<a href='As.php?letter=I'>I</a>
               <a href='J' class='a'></a>|<a href='As.php?letter=J'>J</a>
               <a href='K' class='a'></a>|<a href='As.php?letter=K'>K</a>
               <a href='L' class='a'></a>|<a href='As.php?letter=L'>L</a>
               <a href='M' class='a'></a>|<a href='As.php?letter=M'>M</a>
               <a href='N' class='a'></a>|<a href='As.php?letter=N'>N</a>
               <a href='O' class='a'></a>|<a href='As.php?letter=O'>O</a>
               <a href='P' class='a'></a>|<a href='As.php?letter=P'>P</a>
               <a href='Q' class='a'></a>|<a href='As.php?letter=Q'>Q</a>
               <a href='R' class='a'></a>|<a href='As.php?letter=R'>R</a>
               <a href='S' class='a'></a>|<a href='As.php?letter=S'>S</a>
               <a href='T' class='a'></a>|<a href='As.php?letter=T'>T</a>
               <a href='U' class='a'></a>|<a href='As.php?letter=U'>U</a>
               <a href='V' class='a'></a>|<a href='As.php?letter=V'>V</a>
               <a href='W' class='a'></a>|<a href='As.php?letter=W'>W</a>
               <a href='X' class='a'></a>|<a href='As.php?letter=X'>X</a>
               <a href='Y' class='a'></a>|<a href='As.php?letter=Y'>Y</a>
               <a href='Z' class='a'></a>|<a href='As.php?letter=Z'>Z</a>
               </tr>        ";
?>  
</table>
<table border='0' bgcolor='#FFFFFF' cellspacing='1' width='100%' cellpadding='2'  align='left' width='960px'>
    <tr><td colspan='2'>
        <a href='ToBeDiscussSugg.php'>To Be Discussed</a> </br> <a href='PendingReviewSugg.php'>Pending Review</a>
    </td></tr>  
</table>
