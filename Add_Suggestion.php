<?php
session_start();
include("header2.php");
?>
             <form action="insertaddsuggestion.php" method="post">
<table border="0"  cellspacing="1" cellpadding="2"  align="left" width="100%">
             <tr>
               <td colspan="2" align="center" class="font_size" bgcolor="#869FFF" ><font size="+3" face="Times New Roman" >Suggest Term</font>                   
                   </td></tr>
<tr><td colspan="2"><font color='red'><b><?php
if (isset($_GET['msgsu'])) {
    echo $_GET['msgsu'];
}
?></b></font></td></tr>
               <tr><td  align="right" bgcolor="#D4D4D4" class="font" width="25%">Term : </td>
               <td  bgcolor="#ABADF1" width="75%">
               <?php
$term = "";
if (isset($_SESSION['term'])) {
    $term = $_SESSION['term'];
    unset($_SESSION['term']);
}
echo "<input type='text' name='term' size='40' value='$term'>";
?>
              </td></tr>
       
<table border="0"  cellspacing="1" cellpadding="2"  align="left" width="100%">           
                 <tr><td  align="right" bgcolor="#D4D4D4" class="font" width="25%">Tamil Meaning : </td>
                   <td  bgcolor="#ABADF1" width="75%">
                   <?php
$tamil_meaning = "";
if (isset($_SESSION['tamil_meaning'])) {
    $tamil_meaning = $_SESSION['tamil_meaning'];
    unset($_SESSION['tamil_meaning']);
}
echo "<input type='text' name='tamil_meaning' size='40' value='$tamil_meaning'>";
?>
</td></tr>    
<table border="0"  cellspacing="1" cellpadding="2"  align="left" width="100%">           
                 <tr><td  align="right" bgcolor="#D4D4D4" class="font" width="25%">Sinhala Meaning : </td>
                   <td  bgcolor="#ABADF1" width="75%">
<?php
$sinhala_meaning = "";
if (isset($_SESSION['sinhala_meaning'])) {
    $sinhala_meaning = $_SESSION['sinhala_meaning'];
    unset($_SESSION['sinhala_meaning']);
}
echo "<input type='text' name='sinhala_meaning' size='40' value='$sinhala_meaning'>";
?>
                  
<tr><td bgcolor="#D4D4D4" ></td>
                  <td   colspan=2 bgcolor="#ABADF1" align="right" ><input name="submit" type="submit" value="Suggest Term"  /></td>
                </tr>              
               </table>
             </form>
<?php
include("footer.php");
?>