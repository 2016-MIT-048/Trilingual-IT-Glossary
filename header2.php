<?php
//session_start();
if (!isset($_SESSION)) {
    session_start();
}
include_once 'usercheck.php';
if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
    var img = document.images['captchaimg'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>GMS</title>
<meta name="referrer" content="no-referrer" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php
echo $basedir;
?>/layout.css" />
    <link rel="stylesheet" type="text/css" href="<?php
echo $basedir;
?>/css/global.css">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="<?php
echo $basedir;
?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php
echo $basedir;
?>/css/bootstrap.min.css">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!--Script-->
    <script src="<?php
echo $basedir;
?>/js/jquery.js"></script>
    <script src="<?php
echo $basedir;
?>/js/jquery.min.js"></script>
    <script src="<?php
echo $basedir;
?>/js/bootstrap.js"></script>
    <script src="<?php
echo $basedir;
?>/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--<script type="text/javascript" src="<?php
echo $basedir;
?>/js/jquery-1.10.2.min.js"/></script>-->
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
<table width='100%' border="1"  align="left" cellpadding="2"  cellspacing="1" style="background-image:url(page_back.gif)">
<tr>
                <td colspan="2">
                <?php
$user_type = 0;
$email     = $_SESSION['email'];
$resultut  = mysqli_query($con, "SELECT * FROM system_user WHERE email='" . $email . "'");
if (mysqli_num_rows($resultut) > 0) {
    if ($rowut = mysqli_fetch_assoc($resultut)) {
        $user_type             = $rowut['user_type'];
        $_SESSION['user_type'] = $rowut['user_type'];
    }
} else {
    $_SESSION['user_type'] = "normal_user";
}
?>
             &nbsp;<a href="home2.php" ><b>Home</b></a>
                <?php
if ($user_type == "Admin" || $user_type == "Secondary Admin") {
?>
             | <a href="addterm.php"><b>Add Term</b></a>
                <?php
}
if ($user_type !== "Admin") {
?>
               | <a href="Add_Suggestion.php"><b>Suggest Term</b></a>
                <?php
}
?>
             | <a href="Suggestion.php" ><b>Suggestions</b> </a> 
                <?php
if ($user_type == "Admin") {
?>
               | <a href="user.php"><b>User Details</b></a>
                  <?php
}
?>
               | <a href="feedback.php"><b>Feedback</b></a>
     <?php {
?>
               | <a href="forum.php"><b>Forum</b></a>
                  <?php
}
?>            
                  
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="account_setting.php" ><b >Account Setting</b></a>|  <a href="logout.php" ><b >logout</b></a>
                <?php
if (strcmp($user_type, "Admin") == 0 || strcmp($user_type, "Secondary Admin") == 0) {
?>
|  <a href="#quest"> <b>Post a Question For Forum</b></a>
 <?php
}
?>   
  
  </td></tr></br>
 <form action="search.php" method="post">                 
              <tr>

<td align="left" style="background-image:url(table_header.gif);padding-bottom:8px">
  <!--<input type="text" name="key" size="40" value="">-->
  
       <!-- <input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Type your Query">-->
        <!--<input type="text" name="typeahead" class="typeahead" size="40" value="">-->
        <input type="hidden" name="h_key" id="h_key" value=""/>
        <input type="text" name="key" id="s_key" value=""  class="typeahead tt-query" placeholder="Search" onchange="myFunction()"/>
        <!--<input  type="text" name="typeahead" class="typeahead tt-query"  value="">-->
        
        <input type="submit" style="border: 2px solid #CCCCCC;border-radius: 8px;width:120px; height:35px" name="Search" class="tt-button" value="Search"  /> 
       <br>
    </td>           
            </tr>  
</form>
<div class="my-quest" id="quest">
    <div> 
    <label>Terms for discussion</label>
    <br>
    <br>
        <form method="POST" action="question-function.php">
                    <label>Add Terms</label>
                <input type="text" class="form-control" name="title"required>
                <br>
                <label>Content</label>
                <textarea name="content"class="form-control">
                </textarea>
               <br>
                <input type="hidden" name="useremail" value='<?php
echo $_SESSION['email'];
?>'>
                <input type="submit" class="btn btn-success pull-right" value="Post">
           </form><br>
        <hr>
          <a href="" class="pull-right">Close</a>
      </div>
</div>
        <?php
echo "<tr><td colspan='2' bgcolor='#869FFF'> ";
echo "<a href='A' class='a'></a>|<a href='A.php?letter=A'>A</a>
                <a href='B' class='a'></a>|<a href='A.php?letter=b'>B</a>                
                <a href='C' class='a'></a>|<a href='A.php?letter=C'>C</a>
              <a href='D' class='a'></a>|<a href='A.php?letter=D'>D</a>
               <a href='E' class='a'></a>|<a href='A.php?letter=E'>E</a>
               <a href='F' class='a'></a>|<a href='A.php?letter=F'>F</a>
               <a href='G' class='a'></a>|<a href='A.php?letter=G'>G</a>
               <a href='H' class='a'></a>|<a href='A.php?letter=H'>H</a>
               <a href='I' class='a'></a>|<a href='A.php?letter=I'>I</a>
               <a href='J' class='a'></a>|<a href='A.php?letter=J'>J</a>
               <a href='K' class='a'></a>|<a href='A.php?letter=K'>K</a>
               <a href='L' class='a'></a>|<a href='A.php?letter=L'>L</a>
               <a href='M' class='a'></a>|<a href='A.php?letter=M'>M</a>
               <a href='N' class='a'></a>|<a href='A.php?letter=N'>N</a>
               <a href='O' class='a'></a>|<a href='A.php?letter=O'>O</a>
               <a href='P' class='a'></a>|<a href='A.php?letter=P'>P</a>
               <a href='Q' class='a'></a>|<a href='A.php?letter=Q'>Q</a>
               <a href='R' class='a'></a>|<a href='A.php?letter=R'>R</a>
               <a href='S' class='a'></a>|<a href='A.php?letter=S'>S</a>
               <a href='T' class='a'></a>|<a href='A.php?letter=T'>T</a>
               <a href='U' class='a'></a>|<a href='A.php?letter=U'>U</a>
               <a href='V' class='a'></a>|<a href='A.php?letter=V'>V</a>
               <a href='W' class='a'></a>|<a href='A.php?letter=W'>W</a>
               <a href='X' class='a'></a>|<a href='A.php?letter=X'>X</a>
               <a href='Y' class='a'></a>|<a href='A.php?letter=Y'>Y</a>
               <a href='Z' class='a'></a>|<a href='A.php?letter=Z'>Z</a>
               </tr>        ";
?>
</table>