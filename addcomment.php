<?php
		include "databaseconnection.php";
        $comment = mysqli_real_escape_string($con,$_POST['comment']);
        $userid = $_POST['userid'];
        $postid = $_POST['postid'];
        date_default_timezone_set("Asia/Taipei");
        $datetime=date("Y-m-d h:i:s");
        $comment = mysqli_query($con,"Insert into tblcomment (comment,post_Id,user_email,datetime) values ('$comment','$postid','$userid','$datetime') ");
        $sql = mysqli_query($con,"SELECT * from tblcomment as c join user as u on c.user_email=u.email where post_Id='$postid' and c.user_email='$userid' 
        					and c.datetime='$datetime'");

	 while($row=mysqli_fetch_assoc($sql)){
                    echo "<label>Comment by: </label> ".$row['first_name']." ".$row['last_name']."<br>";
                     echo '<label class="pull-right">'.$row['datetime'].'</label>';
                     echo "<p class='well'>".$row['comment']."</p>";
              }



              ?>