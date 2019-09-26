<?php
session_start();
if (isset($_GET['letter'])) {
    $letter = $_GET['letter'];
}
if (isset($_SESSION['language1'])) {
    $language1 = $_SESSION['language1'];
    $query     = "SELECT * FROM terms WHERE language='$language1' AND (term LIKE '$letter%') ORDER BY term ASC";
} else {
    $query = "SELECT * FROM terms WHERE term LIKE '$letter%' ORDER BY term ASC";
}
include("header1.php");
$result = mysqli_query($con, $query);
$ids    = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if (empty($ids)) {
        $ids = $row['id'];
    } else {
        $ids = $ids . "," . $row['id'];
    }
}
$ids = $ids . ",terms";
echo "<form name='form'><div id='table_view'>";
if (mysqli_num_rows($result) > 10) {
    include_once 'nextbutt.php';
}
if (mysqli_num_rows($result) >= 1) {
    echo "<input type='hidden' name='current_page' id='current_page' value='1'/><table width='100%' bgcolor='#FFFFFF' height='82' border='1' class='table' align='left' style='border-collapse:collapse'>
<tr>
<th >Term</th>
<th>Tamil Meaning</th>
<th>Sinhala Meaning</th>
<th>Votes</th>
<th>More</th>
</tr>";
    $all_ids = explode(",", $ids);
    for ($i = 0; $i < 10; $i++) {
        $id       = $all_ids[$i];
        $resulttv = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $id . "'");
        if ($row = mysqli_fetch_array($resulttv, MYSQLI_ASSOC)) {
            echo "<tr>";
            $term = $row['term'];
            echo "<td width='20%'>" . $row['term'] . "<input type='hidden' name='butt' value='$term'</td>";
            $tam_mean = $row['tamil_meaning'];
            echo "<td width='35%'>" . $row['tamil_meaning'] . "<input type='hidden' name='butt1' value='$tam_mean'</td>";
            $sin_mean = $row['sinhala_meaning'];
            echo "<td width='35%'>" . $row['sinhala_meaning'] . "<input type='hidden' name='butt1' value='$sin_mean'</td>";
            echo "<td width='10%'>" . $row['votes'] . "</td>";
            echo "<td width='3%'><a href='moreForHome1.php?lih1=$term.$tam_mean.$sin_mean'>More</a></td>";
            echo "</tr>";
        }
    }
    echo "</table></div></form>";
} else {
    echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' class='table' align='left' style='border-collapse:collapse'>";
    echo "<tr><td>No results for your search</td></tr>";
    echo "</table>";
}
include('footer1.php');
?>