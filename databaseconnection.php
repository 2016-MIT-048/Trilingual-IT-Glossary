<?php
include_once 'config.php';
$con = mysqli_connect($host, $user, $password);
if (!$con) {
    echo "Sorry Unable to connect with database " . mysqli_connect_error();
}
if (!mysqli_select_db($con, $dbname)) {
    die("Cannot connect to the Database " . mysqli_connect_error($link));
}
function userDetails()
{
    $host      = "localhost";
    $user      = "root";
    $password  = "";
    $dbname    = "2016mit048";
    $con       = mysqli_connect($host, $user, $password);
    $db_select = mysqli_select_db($con, $dbname);
    if (!$db_select) {
        die("Cannot connect to the Database " . mysqli_connect_error());
    }
    $sql    = "SELECT * FROM user WHERE email='" . $email . "' AND password='" . $pw . "'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        mysqli_free_result($result);
        return $result;
    } else {
        return null;
    }
}
function auth($email, $pw)
{
    $host      = "localhost";
    $user      = "root";
    $password  = "";
    $dbname    = "2016mit048";
    $con       = mysqli_connect($host, $user, $password);
    $db_select = mysqli_select_db($con, $dbname);
    if (!$db_select) {
        die("Cannot connect to the Database " . mysqli_connect_error());
    }
    $sql    = "SELECT * FROM user WHERE email='" . $email . "' AND password='" . $pw . "'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        mysqli_free_result($result);
        return true;
    } else {
        mysqli_free_result($result);
        return false;
    }
}
function user_loggedin()
{
    if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
        if (!auth($_SESSION['email'], $_SESSION['password'])) {
            return true;
        } else {
            return false;
        }
    }
}
?>