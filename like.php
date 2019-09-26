<?php
session_start();
$email = $_SESSION['email'];
include('databaseconnection.php');
if (isset($_GET['li'])) {
    $word = $_GET['li'];
}
$arrr      = explode('.', $word);
$term      = $arrr[0];
$tam_mean  = $arrr[1];
$sin_mean  = $arrr[2];
$like      = $arrr[3];
$term_n_id = $arrr[4];
$result2   = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $term_n_id . "' AND term='" . $term . "'");
$term_id   = "";
while ($row = mysqli_fetch_assoc($result2)) {
    $votes   = $row['votes'];
    $term_id = $row['id'];
}
if ($like == 'like') {
    $votesn = $votes + 1;
    $query  = "INSERT INTO liketable (email,term_id) VALUES ('" . $email . "', '" . $term_id . "')";
    $rez    = mysqli_query($con, $query);
} else {
    $votesn = $votes - 1;
    mysqli_query($con, "DELETE  FROM liketable where email='" . $email . "' AND term_id='" . $term_id . "'");
}
mysqli_query($con, "UPDATE terms SET votes ='" . $votesn . "'
WHERE id='" . $term_id . "'");
header("Location:moredetails.php?li=$term.$tam_mean.$sin_mean.$votesn.$term_id");
?>