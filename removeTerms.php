<?php
include('databaseconnection.php');
if (isset($_GET['Id'])) {
    $query ="DELETE FROM terms WHERE id=".$_GET['Id']."";
    mysqli_query($con,$query);
    header("Location:home2.php");
}
?>