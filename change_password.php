<?php
include("header2.php");
?>
<table border="0"  cellspacing="1" cellpadding="2"  align="left" width="100%">
             <tr>
               <td colspan="2" align="center" class="font_size" bgcolor="#959595"><h4>Change the Password </h4>              
                   </td></tr>
<tr>
 <td bgcolor="#D3DDFF"> </td><td bgcolor="#B9C7C8" ><font color='red'><?php
if (isset($_GET['errp'])) {
    echo $_GET['errp'];
}
?></font>
 </td>
 </tr>
              <form  action="saveChangePassword.php" method="post">

               <tr><td  align="right" bgcolor="#D4D4D4" class="font">Old Password: </td>

                   <td  bgcolor="#ABADF1"><input type="password" name="oldpassword" size="40" value=""></td></tr>

               <tr><td  align="right" bgcolor="#D4D4D4" class="font">New Password: </td>

                   <td  bgcolor="#ABADF1"><input type="password" name="newpassword" size="40" ></td></tr>
                   
                 <tr><td  align="right" bgcolor="#D4D4D4" class="font">Confirm Password: </td>

                   <td  bgcolor="#ABADF1"><input type="password" name="confirmpass" size="40" ></td></tr>
                     

                <tr><td bgcolor="#D4D4D4" > </td>
                  <td   colspan=2 bgcolor="#ABADF1" ><input name="submit" type="submit" value="save Change"  /></td>
                </tr>

             </form>
               </table>

<?php
include("footer.php");
?>