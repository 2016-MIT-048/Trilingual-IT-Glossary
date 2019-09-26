<?php
session_start();
include('databaseconnection.php');
$email  = $_SESSION['email'];
$result = mysqli_query($con, "SELECT * FROM system_user WHERE email='" . $email . "'");
if (!$result)
    echo "invalid";
if (mysqli_num_rows($result) == 1) {
    $dd                          = gmdate(DATE_ATOM, time());
    $d                           = explode("T", $dd);
    $term                        = $_POST['term'];
    $sinhala_meaning             = $_POST['sinhala_meaning'];
    $tamil_meaning               = $_POST['tamil_meaning'];
    $_SESSION['sinhala_meaning'] = $sinhala_meaning;
   $_SESSION['term']            = $term;
    $_SESSION['tamil_meaning']   = $tamil_meaning;
    $suggested_date              = $d[0];
    $accepted_date               = $d[0];
    $votes                       = 0;
    $err                         = "";
    $comments                    = "";
	
    
   
	if ($term == "" || $sinhala_meaning == "" || $tamil_meaning == "") {
        $err = "yes";
        header("Location:addterm.php?msg=Term, Sinhala meaning and Tamil meaning cannot be null.......");	
    } else {
        $resulte = mysqli_query($con, "SELECT * FROM terms WHERE term='" . $term . "' and sinhala_meaning='" . $sinhala_meaning . "' and tamil_meaning='" . $tamil_meaning . "'");
        if (!$resulte)
            echo "invalid";
        if (mysqli_num_rows($resulte) == 1) {
            $err = "yes";
            header("Location:addterm.php?msg=Term and Accepted meaning are already exist.....");
        }
    }
    if ($err != "yes") {
        $result = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "'");
        if (!$result)
            echo "invalid";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $username = $row['first_name'];
        }
    }
    $query = "INSERT INTO terms (term, tamil_meaning, sinhala_meaning, suggested_by, suggested_date, checked_by, accepted_date, votes, comments) VALUES ('" . $term . "', '" . $tamil_meaning . "', '" . $sinhala_meaning . "', '" . $username . "', '" . $suggested_date . "', '" . $username . "', '" . $accepted_date . "','" . $votes . "','" . $comments . "')";
    $rez   = mysqli_query($con, $query);
    if (!$rez) {
        echo "INvalid" . mysqli_error($con);
    } else {
        header("Location:addterm.php?msg=term is added........");
    }
} else {
    header("Location:addterm.php?msg=administrator only allow to add term....you can suggest term");
}
?>