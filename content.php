<?php
session_start();
$semail = $_SESSION['email'];
include("header2.php");
echo '<div class="container" style="margin:7% auto;">
        <h4>Discussion</h4>
        <hr>
         <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title">Discuss your valuable ideas here</h4>
                </div> 
                 <div class="panel-body">';
$id  = $_GET['post_id'];
$sql = mysqli_query($con, "SELECT * from tblpost where post_Id='$id' ");
if ($sql == true) {
    while ($row = mysqli_fetch_assoc($sql)) {
        extract($row);
        $sel = mysqli_query($con, "SELECT * from user where email='$user_email' ");
        while ($row = mysqli_fetch_array($sel, MYSQLI_ASSOC)) {
            extract($row);
            echo "<label>Topic Title: </label> " . $title . "<br>";
            echo "<label>Date time posted: </label> " . $datetime;
            echo "<p class='well'>" . $content . "</p>";
            echo '<label>Posted By: </label>' . $first_name . ' ' . $last_name;
        }
    }
}
echo '<br>
               <div style="text-align: center"><label style="vertical-align: middle"><h1><u><b>Comments</b></u></h1></label></div><br>
              <div id="comments">';
$postid = $_GET['post_id'];
//findout the same postid(topic) comments
$sql    = mysqli_query($con, "SELECT * from tblcomment as c join user as u on c.user_email=u.email where post_Id='$postid' order by datetime");
$num    = mysqli_num_rows($sql);
if ($num > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
        echo "<label>Comment by: </label> " . $row['first_name'] . " " . $row['last_name'] . "<br>";
        echo '<label class="pull-right">' . $row['datetime'] . '</label>';
        echo "<p class='well'>" . $row['comment'] . "</p>";
    }
}
echo '</div>
              </div>
          </div>
          <hr>
            <div class="col-sm-5 col-md-5 sidebar">
          <h3>Comment</h3>
          <form method="POST">
            <textarea type="text" class="form-control" id="commenttxt"></textarea><br>
            <input type="hidden" id="postid" value="' . $_GET['post_id'] . '">
            <input type="hidden" id="userid" value="' . $_SESSION['email'] . '">
            <input type="submit" id="save" class="btn btn-success pull-right" value="Comment">
          </form>
        </div>
    </div>';
include('footer.php');