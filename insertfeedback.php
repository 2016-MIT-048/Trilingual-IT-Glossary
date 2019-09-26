<?php
session_start();
include_once 'databaseconnection.php';
$email    = $_SESSION['email'];
$dd       = gmdate(DATE_ATOM, time());
$d        = explode("T", $dd);
$date     = $d[0];
$feedback = $_POST['newfeedback'];
if ($feedback == "") {
    header("Location:feedback.php?empt=Please enter your feedback");
} else {
    $username = '';
    $result2  = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "' ");
    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $username = $row['first_name'];
    }
    $feedback = $feedback . " ......by " . $username;
    $query    = "INSERT INTO user_feedback (email,date,feedback) values ('" . $email . "','" . $date . "','" . $feedback . "')";
    header("Location:feedback.php?empt=Your feedback is added");
    $rez = mysqli_query($con, $query);
    if (!$rez) {
        echo "INvalid" . mysqli_error($con);
    }
}
?>
