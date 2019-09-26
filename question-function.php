<?php

include "databaseconnection.php";
 					date_default_timezone_set("Asia/Taipei");
                        $datetime=date("Y-m-d h:i:s");
extract($_POST);
//echo $title.'<br>';
//echo $content.'<br>';
//echo $category.'<br>';
//echo $datetime.'<br>';
//echo $userid.'<br>';
try{
$sql = "INSERT INTO tblpost(title,content,datetime,user_email) VALUES ('".$title."','".$content."','".$datetime."','".$useremail."')";
$res = mysqli_query($con,$sql);
}
catch(Exception $e)
{
	echo 'Message: ' .$e->getMessage();
}
//echo 'Hello ... '.$res;

if($res==true)
                            {
                                   echo '<script language="javascript">';
                                    echo 'alert("Post Successfully")';
                                    echo '</script>';
                                    echo '<meta http-equiv="refresh" content="0;url=forum.php" />';
                            }

?>
