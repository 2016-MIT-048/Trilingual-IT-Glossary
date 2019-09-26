<?php
session_start();
$semail=$_SESSION['email'];
include ("header2.php");
echo '<div class="container" style="margin:7% auto;">
    	
    	<hr>';

           echo '<br><div class="panel panel-success">
                    <div class="panel-heading">
                    <h3 class="panel-title">Terms for discussion</h3>
                    </div> 
                    <div class="panel-body">
                    <table class="table table-stripped">
                    <tr>
                    <th>Terms</th>
                    <th>Action</th>
                    </tr>';
                    $sel1 = mysqli_query($con,"SELECT * from tblpost");
                    while($row1=mysqli_fetch_array($sel1,MYSQLI_ASSOC)){
                        extract($row1);
                        echo '<tr>';
                        echo '<td>'.$title.'</td>';
                        echo '<td><a href="content.php?post_id='.$post_Id.'"><button class="btn btn-success">View</button></td>';
                        echo '</tr>';
                    }


                echo '</table>
                    </div>
                </div>';
        
include ('footer.php');
?>