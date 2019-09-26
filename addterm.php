<?php
session_start();
$term            = "";
$tamil_meaning   = "";
$sinhala_meaning = "";
if (isset($_SESSION['term'])) {
    $term = $_SESSION['term'];
    unset($_SESSION['term']);
}
if (isset($_SESSION['tamil_meaning'])) {
    $tamil_meaning = $_SESSION['tamil_meaning'];
    unset($_SESSION['tamil_meaning']);
}
if (isset($_SESSION['sinhala_meaning'])) {
    $sinhala_meaning = $_SESSION['sinhala_meaning'];
    unset($_SESSION['sinhala_meaning']);
}
include("header2.php");
?>
<table border="0"  cellspacing="1" cellpadding="2"  align="left" width="100%">
             <tr>
               <td colspan="2" align="center"  bgcolor="#869FFF"><font size="+3" face="Times New Roman">Add Term </font>
                   
                   </td></tr>
                   <tr>
                   <td colspan="2"><font color='green'>When you upload a csv file...values must be in this order:-Term,Tamil_meaning, Sinhala_meaning.</font></td></tr>
<tr>
                  <td   colspan=2 bgcolor="#ABADF1" align="left">
                  <form action="readfile.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" name="submit" value="Submit" />
</form>      
                  </td> 
                </tr>
                </table>
<form action="insertterm.php" method="post">
<table border="0"  cellspacing="1" cellpadding="2"  align="left" width="100%">                  
                <tr><td width="39%" align="center"> <font color='red'><b>  
                  

				  <?php
if (isset($_GET['msg'])) {
    echo $_GET['msg'];
}
if (isset($msg)) {
    echo $msg;
}
?>

</b></font></td></tr></table>

            <table border="0"  cellspacing="1" cellpadding="2"  align="left" width="100%">
            
            <tr><td  align="right" bgcolor="#D4D4D4" class="font" width="25%">Term : </td>
                   <td width="61%"  bgcolor="#ABADF1" width="75%">
                   <?php
echo "<input type='text' name='term' size='40' value='$term'>";
?>
             </td></tr>
            
        <tr><td  align="right" bgcolor="#D4D4D4" class="font" width="25%">    Tamil Meaning : </td>
                   <td  bgcolor="#ABADF1" width="75%">
                   <?php
echo "<input type='text' name='tamil_meaning' size='40' value='$tamil_meaning'>";
?>
                 </td></tr>
                   
                  <tr><td  align="right" bgcolor="#D4D4D4" class="font" width="25%"> Sinhala Meaning : </td>
                   <td  bgcolor="#ABADF1" width="75%">
                   <?php
echo "<input type='text' name='sinhala_meaning' size='40' value='$sinhala_meaning'>";
?>
                 </td></tr> 
                   
                <tr><td bgcolor="#D4D4D4" > </td>
                  <td   colspan=2 bgcolor="#ABADF1" align="left" ><input name="submit" type="submit" value="Add Term"  /></td>
                  </tr>
               </table>
                  </form>
<?php
include("footer.php");
?>