<?php
include('databaseconnection.php');
if (isset($_POST['save_button'])) {
  $term_id=$_POST['term_id'];
  $term=$_POST['butt'];
  $tamil_meaning=$_POST['butt1'];
  $sinhala_meaning=$_POST['buts1'];
  $votes=$_POST['votes'];
  $query ="UPDATE terms SET term ='".$term."',tamil_meaning='".$tamil_meaning."',sinhala_meaning='".$sinhala_meaning."' WHERE id=".$term_id."";
  mysqli_query($con,$query);
 header("Location:moredetails.php?li=$term.$tamil_meaning.$sinhala_meaning.$votes.$term_id");
}

?>