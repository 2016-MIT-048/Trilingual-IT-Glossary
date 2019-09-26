<?php
session_start();
include("header1.php");
?>
<table border="0"  cellspacing="1" cellpadding="2"  align="left" width="100%">
              <form action="validate.php" method="post"><tr>
              <th  colspan=2  align="left" ><b >Login</b></br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <?php
if (isset($_GET['err'])) {
    echo $_GET['err'];
}
?></th>
              </tr>
               <tr><td  align="right" bgcolor="#D4D4D4" class="font">E-mail: </td>

                   <td  bgcolor="#ABADF1"><input type="email" name="email" size="40" value=""></td></tr>

               <tr><td  align="right" bgcolor="#D4D4D4" class="font">Password: </td>

                   <td  bgcolor="#ABADF1"><input type="password" name="password" size="40" ></td></tr>

                <tr><td bgcolor="#D4D4D4" >
               <?php
$np = "";
if (isset($_GET['np'])) {
    $np = $_GET['np'];
    echo "<input type='hidden' name='np' value='" . $np . "'/>";
} else {
    echo "<input type='hidden' name='np' value='" . $np . "'/>";
}
?>
               </td>
                  <td   colspan=2 bgcolor="#ABADF1" ><input  type="submit" value="Login"  /> </td>
                </tr>

             </form>

              <tr><td colspan=2 class="index" bgcolor="#D4D4D4"align="center"><font face="arial">Don't have Account</font> </td></tr>

             <tr><td align="center" colspan=2 bgcolor="#D4D4D4" ><font face="arial"><a href="register.php">Create a New Account</a></font>
             </td></tr>
               </table>
<?php
include("footer1.php");
?>
