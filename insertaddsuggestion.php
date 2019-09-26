<?php
session_start();
include_once 'databaseconnection.php';
$email                       = $_SESSION['email'];
$dd                          = gmdate(DATE_ATOM, time());
$d                           = explode("T", $dd);
$term                        = $_POST['term'];
$tamil_meaning               = $_POST['tamil_meaning'];
$sinhala_meaning             = $_POST['sinhala_meaning'];
$_SESSION['term']            = $term;
$_SESSION['tamil_meaning']   = $tamil_meaning;
$_SESSION['sinhala_meaning'] = $sinhala_meaning;
$suggested_date              = $d[0];
$votes                       = 0;
$comments                    = "";
$status                      = "Pending Review";
$err                         = "";
if ($term == "" || $tamil_meaning == "" || $sinhala_meaning == "") {
    $err = "yes";
    header("Location:Add_Suggestion.php?msgsu=Term and Tamil Meaning and Sinhala Meaning can not to be null........");
}
if ($err != "yes") {
    $resulte = mysqli_query($con, "SELECT * FROM suggestions WHERE term='" . $term . "' and tamil_meaning='" . $tamil_meaning . "' and sinhala_meaning='" . $sinhala_meaning . "'");
    if (!$resulte)
        echo "invalid";
    if (mysqli_num_rows($resulte) == 1) {
        header("Location:Add_Suggestion.php?msgsu=Suggestion is already exist.....");
    } else {
        $resultet = mysqli_query($con, "SELECT * FROM terms WHERE term='" . $term . "' and tamil_meaning='" . $tamil_meaning . "' and sinhala_meaning='" . $sinhala_meaning . "'");
        if (!$resultet)
            echo "invalid";
        if (mysqli_num_rows($resultet) == 1) {
            header("Location:Add_Suggestion.php?msgsu=Your Suggestion is already exist in Glossary.....");
        } else {
            $result = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "'");
            if (!$result)
                echo "invalid";
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $suggested_by = $row['first_name'];
                $getMaxId     = mysqli_query($con, "SELECT MAX(id) AS Max_Id FROM suggestions");
                if ($getMaxId) {
                    if ($row_Id = mysqli_fetch_array($getMaxId, MYSQLI_ASSOC)) {
                        $Max_Id = $row_Id['Max_Id'];
                        if ($Max_Id == 0) {
                            $Max_Id = 1;
                        } else {
                            $Max_Id = $Max_Id + 1;
                        }
                    }
                }
                $query = "INSERT INTO suggestions (id,term,tamil_meaning,sinhala_meaning,  suggested_by, suggested_date, status,votes,comments) VALUES ('" . $Max_Id . "', '" . $term . "','" . $tamil_meaning . "', '" . $sinhala_meaning . "', '" . $suggested_by . "', '" . $suggested_date . "','" . $status . "','" . $votes . "','" . $comments . "')";
                $rez   = mysqli_query($con, $query);
                if (!$rez) {
                    echo "Invalid" . mysql_error();
                }
                header("Location:Add_Suggestion.php?msgsu=Your Suggestion is added.......");
            }
        }
    }
}
?>