<?php
include('header1.php');
if (isset($_GET['lih1'])) {
    $word = $_GET['lih1'];
}
$arrr     = explode('.', $word);
$term     = $arrr[0];
$sin_mean = $arrr[1];
$tam_mean = $arrr[2];
$result   = mysqli_query($con, "SELECT * FROM terms WHERE term='" . $term . "' and sinhala_meaning='" . $sin_mean . "' and tamil_meaning='" . $tam_mean . "'");
echo "<table width='100%' height='82' border='1' class='table' style='border-collapse:collapse' align='left'>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td width='20%'>Term:</td><td width='80%'>" . $row['term'] . "</td></tr>";
    echo "<tr><td>Sinhala Meaning:</td><td>" . $row['sinhala_meaning'] . "<input type='hidden' name='butt1' value='$sin_mean'</td></tr>";
    echo "<tr><td>Tamil Meaning:</td><td>" . $row['tamil_meaning'] . "<input type='hidden' name='butt1' value='$tam_mean'</td></tr>";
    echo "<tr><td>Suggested by:</td><td>" . $row['suggested_by'] . "</td></tr>";
    echo "<tr><td>Suggested Date:</td><td>" . $row['suggested_date'] . "</td></tr>";
    echo "<tr><td>Checked by:</td><td>" . $row['checked_by'] . "</td></tr>";
    echo "<tr><td>Accepted Date:</td><td>" . $row['accepted_date'] . "</td></tr>";
    echo "<tr><td>Number of Votes:</td><td>" . $row['votes'] . "</td></tr>";
    echo "<tr><td>Comments:</td><td>" . $row['comments'] . "</td></tr>";
}
include('footer1.php');
?>