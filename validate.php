<?php
include_once 'databaseconnection.php';
$email    = $_POST['email'];
$password = $_POST['password'];
//np-next page, depent on the person nextpage will display (admin/user)
if (isset($_POST['fromPerson'])) {
    $np = $_POST['np'];
}
if ($email == "") {
    header("Location:login.php?err=Please enter user email");
} else if ($password == "") {
    header("Location:login.php?err=Please enter password");
} else {
    $pw = $_POST['password'];
    if (auth($email, md5($pw))) {
        session_start();
        $_SESSION['email']    = $email;
        $_SESSION['password'] = $password;
        $_SESSION['role']     = 1;
        $next_page            = "home2.php?" . $np;
        if (isset($np)) {
            $next_page = $np;
        }
        header("Location:" . $next_page);
    } else {
        header("Location:login.php?err=Your email or password incorrect!");
    }
}
?>