<?php
include_once 'config.php';
require_once 'databaseconnection.php';
if (!user_loggedin()) {
    header("Location:login.php");
}
?>