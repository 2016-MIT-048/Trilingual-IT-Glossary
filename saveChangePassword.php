<?php
session_start();
include('databaseconnection.php');
$password    = $_SESSION['password'];
$email       = $_SESSION['email'];
$oldpass     = $_POST['oldpassword'];
$newpass     = $_POST['newpassword'];
$md5newpass  = md5($newpass);
$confirmpass = $_POST['confirmpass'];
if ($oldpass == "" || $newpass == "" || $confirmpass == "") {
    header("Location:change_password.php?errp=Please enter all fields!");
} else {
    if ($password == $oldpass) {
        if (strlen($newpass) <= 5) {
            header("Location:change_password.php?errp=Password must have six character!");
        } else {
            if ($newpass == $confirmpass) {
                mysqli_query($con, "UPDATE user SET password = '" . $md5newpass . "'
WHERE email = '" . $email . "'");
                header("Location:change_password.php?errp=Your Password is changed........");
            } else {
                header("Location:change_password.php?errp=Please Confirm password!");
            }
        }
    } else {
        header("Location:change_password.php?errp=Incorrect old password!");
    }
}
?>
