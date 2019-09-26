<?php
session_start();
include('databaseconnection.php');
$oldemail      = $_SESSION['email'];
$email         = $_POST['email'];
$firstname     = $_POST['first'];
$lastname      = $_POST['last'];
$gender        = $_POST['gender'];
$dob           = $_POST['dob'];
$country       = $_POST['country'];
$language      = $_POST['language'];
$qualification = $_POST['qualification'];
$linked_in     = $_POST['linked_in'];
$short_bio     = $_POST['short_bio'];
if ($email == "" || $firstname == "" || $lastname == "" || $gender == "" || $dob == "" || $country == "" || $language == "" || $qualification == "" || $short_bio == "") {
    header("Location:account_setting.php?msgsa=Please enter all required data");
} else {
    mysqli_query($con, "UPDATE user SET email='" . $email . "', first_name='" . $firstname . "', last_name='" . $lastname . "', gender='" . $gender . "', date_of_birth='" . $dob . "', country='" . $country . "', language='" . $language . "',qualification='" . $qualification . "',linked_in='" . $linked_in . "',short_bio='" . $short_bio . "'
WHERE email = '" . $oldemail . "'");
    header("Location:account_setting.php?msgsa=Changes are saved.....");
}
?>