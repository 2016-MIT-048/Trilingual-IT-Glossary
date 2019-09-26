<?php
//session_start();
if (!isset($_SESSION)) {
    session_start();
}
$language1 = "";
if (isset($_SESSION['language1'])) {
    $language1 = $_SESSION['language1'];
}
include_once 'config.php';
$con = mysqli_connect($host, $user, $password);
if (!$con) {
    echo "Sorry Unable to connect with database " . mysqli_connect_error();
}
$db_select = mysqli_select_db($con, $dbname);
if (!$db_select) {
    die("Cannot connect to the Database " . mysqli_connect_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>GMS</title>
<meta name="referrer" content="no-referrer" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php
echo $basedir;
?>/layout.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<script type="text/javascript" src="<?php
echo $basedir;
?>/js/jquery-1.10.2.min.js"/></script>
<script type="text/javascript" src="<?php
echo $basedir;
?>/js/custom.js"/></script>
<script type="text/javascript" src="<?php
echo $basedir;
?>/ckeditor/ckeditor.js"></script>  

<script src="typeahead.min.js"></script>
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'key',
        remote:'search_key.php?key=%QUERY',
        limit : 10
    }).on('typeahead:selected', function (obj, datum) {
   // console.log(obj);
   document.getElementById("h_key").value=datum['value'];
    //console.log(document.getElementById("h_key").value);
});
});
    </script>

    <script>
    function myFunction(){
        var val=document.getElementById("s_key").value;
        document.getElementById("h_key").value=val;
        console.log(document.getElementById("h_key").value);
    }
    </script>
    
<style type="text/css">
.bs-example{
    font-family: sans-serif;
    position: relative;
    margin: 50px;
}
.typeahead, .tt-query, .tt-hint {
    border: 2px solid #CCCCCC;
    border-radius: 8px;
    font-size: 24px;
    height: 30px;
    line-height: 30px;
    outline: medium none;
    padding-left: 8px;
    width: 396px;
}
.typeahead {
    background-color: #FFFFFF;
}
.typeahead:focus {
    border: 2px solid #0097CF;
}
.tt-query {
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
    color: #999999;
}
.tt-dropdown-menu {
    background-color: #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    margin-top: 12px;
    padding: 8px 0;
    width: 422px;
}
.tt-suggestion {
    //font-size: 24px;
    line-height: 24px;
    padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
    background-color: #0097CF;
    color: #FFFFFF;
}
.tt-suggestion p {
    margin: 0;
}
</style>

<style>
body {
    width:100%;
}
#page {
    position: relative;
    width:86%;
    margin-left:7%;
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
.font_size{font-size:10px; }
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

<?php
include_once 'scripts.php';
?>
</head>
<body background="body.png">
<audio src="" id="myAudio" class="speech" hidden></audio>
<div id="page">
<img src="header.png" width="100%" />
<table width='100%' border="0"  align="left" cellpadding="2"  cellspacing="1" style="background-image:url(page_back.gif)">             
              <tr>
                <td colspan="2" bgcolor="#006699">
                
                &nbsp;<a href="home1.php" ><b><font size="3" color="white">Home</font></b></a>
                  <?php
//if($user_type=="Admin")
//{
?>
               | <a href="login.php?np=addterm.php"><b><font size="3" color="white">Add Term</font></b></a>
                  <?php
//}
// if($user_type!="Admin")
//{
?>
               | <a href="login.php?np=Add_Suggestion.php"><b><font color="white">Suggest Term</font></b></a>
<?php
//}
?>
               | <a href="login.php?np=Suggestion.php" ><b><font color="white">New Suggestions</font></b> </a> 
            <?php
// if($user_type=="Admin")
//{
?>
              | <a href="login.php?np=user.php"><b><font color="white">User details</font></b></a>
                  <?php
//}
// if($user_type=="Admin")
//{
?>
               | <a href="feedback.php?np=feedback.php"><b><font color="white">Feedback</font></b></a>
                  <?php
//}
?>
               
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="login.php" ><b><font color="white">login</font></b></a> | <a href="register.php"><b><font color="white">Sign up</font></b></a></br>
  </tr>
                 
                
                

<tr>
  <td align="left" style="background-image:url(table_header.gif)">  
  <form action="search.php" method="post">
    <input type="hidden" name="h_key" id="h_key" value=""/>
        <input type="text" name="key" id="s_key" value=""  class="typeahead tt-query" placeholder="Search" onchange="myFunction()"/>
        <!--<input  type="text" name="typeahead" class="typeahead tt-query"  value="">-->
        
        <input type="submit" style="border: 2px solid #CCCCCC;border-radius: 8px;width:120px; height:35px" name="Search" class="tt-button" value="Search"  />
    </form></td>
</tr>
    <?php
echo "<tr><td colspan='2' bgcolor='#869FFF'> ";
echo "<a href='A' class='a'></a>|<a href='A1.php?letter=A'>A</a>
<a href='B' class='a'></a>|<a href='A1.php?letter=b'>B</a>                
                <a href='C' class='a'></a>|<a href='A1.php?letter=C'>C</a>
              <a href='D' class='a'></a>|<a href='A1.php?letter=D'>D</a>
               <a href='E' class='a'></a>|<a href='A1.php?letter=E'>E</a>
               <a href='F' class='a'></a>|<a href='A1.php?letter=F'>F</a>
               <a href='G' class='a'></a>|<a href='A1.php?letter=G'>G</a>
               <a href='H' class='a'></a>|<a href='A1.php?letter=H'>H</a>
               <a href='I' class='a'></a>|<a href='A1.php?letter=I'>I</a>
               <a href='J' class='a'></a>|<a href='A1.php?letter=J'>J</a>
               <a href='K' class='a'></a>|<a href='A1.php?letter=K'>K</a>
               <a href='L' class='a'></a>|<a href='A1.php?letter=L'>L</a>
               <a href='M' class='a'></a>|<a href='A1.php?letter=M'>M</a>
               <a href='N' class='a'></a>|<a href='A1.php?letter=N'>N</a>
               <a href='O' class='a'></a>|<a href='A1.php?letter=O'>O</a>
               <a href='P' class='a'></a>|<a href='A1.php?letter=P'>P</a>
               <a href='Q' class='a'></a>|<a href='A1.php?letter=Q'>Q</a>
               <a href='R' class='a'></a>|<a href='A1.php?letter=R'>R</a>
               <a href='S' class='a'></a>|<a href='A1.php?letter=S'>S</a>
               <a href='T' class='a'></a>|<a href='A1.php?letter=T'>T</a>
               <a href='U' class='a'></a>|<a href='A1.php?letter=U'>U</a>
               <a href='V' class='a'></a>|<a href='A1.php?letter=V'>V</a>
               <a href='W' class='a'></a>|<a href='A1.php?letter=W'>W</a>
               <a href='X' class='a'></a>|<a href='A1.php?letter=X'>X</a>
               <a href='Y' class='a'></a>|<a href='A1.php?letter=Y'>Y</a>
               <a href='Z' class='a'></a>|<a href='A1.php?letter=Z'>Z</a>
               </tr>        ";
?>               
</table>