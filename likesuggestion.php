<?php
session_start();
$email = $_SESSION['email'];
include('databaseconnection.php');
if (isset($_GET['lis'])) {
    $word = $_GET['lis'];
}
$arrr            = explode('.', $word);
$term            = $arrr[0];
$tamil_meaning   = $arrr[1];
$sinhala_meaning = $arrr[2];
$votes           = $arrr[3];
$like            = $arrr[4];
$term_id         = $arrr[5];
//term_id -> liketable
$result2         = mysqli_query($con, "SELECT * FROM suggestions WHERE id='" . $term_id . "'");
while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    $votes = $row['votes'];
}
$votesn = 0;
if ($like == 'like') {
    $votesn = $votes + 1;
    $query  = "INSERT INTO likesuggestion (email,term,tamil_meaning,sinhala_meaning) VALUES ('" . $email . "', '" . $term . "','" . $tamil_meaning . "','" . $sinhala_meaning . "')";
    $rez    = mysqli_query($con, $query);
} else {
    $votesn = $votes - 1;
    mysqli_query($con, "DELETE  FROM likesuggestion where '" . $term_id . "'");
}
mysqli_query($con, "UPDATE suggestions SET votes ='" . $votesn . "'
WHERE id='" . $term_id . "'");
header("Location:updateSuggestionComment.php?lis=$term.$tamil_meaning.$sinhala_meaning.$votesn.$term_id");
?>