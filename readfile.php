<?php
session_start();
include('databaseconnection.php');
$email  = $_SESSION['email'];
//only administrator can add the term
$result = mysqli_query($con, "SELECT * FROM system_user WHERE email='$email'");
if (!$result) {
    header("Location:addterm.php?msg= invalid.........");
}
if (mysqli_num_rows($result) == 1) {
    $dd      = gmdate(DATE_ATOM, time());
    $d       = explode("T", $dd);
    $date    = $d[0];
    $result2 = mysqli_query($con, "SELECT * FROM user WHERE email='$email' ");
    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $username = $row['first_name'];
    }
    if ($_FILES["file"]["error"] > 0) {
        header("Location:addterm.php?msg= Error: " . $_FILES["file"]["error"] . "........<br />");
    }
    if (file_exists("Upload/" . $_FILES["file"]["name"])) {
        header("Location:addterm.php?msg= File name already exists.........");
    } else {
        move_uploaded_file($_FILES["file"]["tmp_name"], "Upload/" . $_FILES["file"]["name"]);
        $suggested_by = $_SESSION['email'];
        $checked_by   = $_SESSION['email'];
        date_default_timezone_set("Asia/Colombo");
        $t_date = date("Y-m-d");
        $file   = fopen(__DIR__ . '/Upload/' . $_FILES["file"]["name"], 'r');
        $Litems = "";
        $msg    = "";
        while (($line = fgetcsv($file)) !== FALSE) {
            $vals            = "";
            $term            = $line[0];
            $tamil_meaning   = $line[1];
            $sinhala_meaning = $line[2];
            $resulte         = mysqli_query($con, "select * from terms where term='$term' and sinhala_meaning='$sinhala_meaning' and tamil_meaning='$tamil_meaning'");
            if (mysqli_num_rows($resulte) > 0) {
                $msg = " but some values already exist.....";
            } else {
                $vals = "('" . $term . "','" . $tamil_meaning . "','" . $sinhala_meaning . "','" . $suggested_by . "','" . $t_date . "','" . $checked_by . "',null,0,''" . ")";
                if (empty($Litems)) {
                    $Litems = $vals;
                } else {
                    $Litems = $Litems . "," . $vals;
                }
            }
        }
        fclose($file);
        if ($Litems != "") {
            $sql = "INSERT INTO terms (term,tamil_meaning,sinhala_meaning,suggested_by,suggested_date,checked_by,accepted_date,votes,comments) VALUES" . $Litems;
            if (mysqli_query($con, $sql)) {
                header("Location:addterm.php?msg= File is added" . $msg);
            } else {
                header("Location:addterm.php?msg=Unable to add this file.........");
            }
        } else {
            header("Location:addterm.php?msg=Term, Sinhala meaning and Tamil meaning cannot be null.........");
        }
    }
    mysqli_close($con);
} else {
    header("Location:addterm.php?msg=administrator only allow to add term....you can suggest term");
}