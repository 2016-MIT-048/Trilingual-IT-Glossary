<?php
session_start();
$email = $_SESSION['email'];
include("headerforsuggestion.php");
if (isset($_GET['msg'])) {
    echo $_GET['msg'];
}
$result = mysqli_query($con, "SELECT * FROM suggestions WHERE 1 ORDER BY term ASC");
if (!$result)
    echo "invalid";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    $ids = 0; {
    if (empty($ids)) {
        $ids = $row['id'];
    } else {
        $ids = $ids . "," . $row['id'];
    }
}
$ids = $ids . ",suggestions";
echo "<form name='form'><div id='table_view'>";
if (mysqli_num_rows($result) > 10) {
    include_once 'nextbutt.php';
}
if (mysqli_num_rows($result) >= 1) {
    echo "<input type='hidden' name='current_page' id='current_page' value='1'/><table border='1' bgcolor='#FFFFFF' cellspacing='1' cellpadding='2'  align='left' width='100%' style='border-collapse:collapse'>
<tr>
<th>Term</th>
<th>Tamil Meaning</th>
<th>Sinhala Meaning</th>
<th>Status</th>
<th>Suggested Date</th>
<th>Votes</th>
<th>More</th>
</tr>";
    $all_ids = explode(",", $ids);
    $count   = count($all_ids);
    if (count($all_ids) > 10) {
        $count = 10;
    }
    for ($i = 0; $i < $count; $i++) {
        $id       = $all_ids[$i];
        $resulttv = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $id . "'");
        if ($row = mysqli_fetch_array($resulttv, MYSQLI_ASSOC)) {
            echo "<tr>";
            $term = $row['term'];
            echo "<td width='15%'>" . $term . "<input type='hidden' name='butt' value='$term'</td>";
            echo "<td width='15%'>" . $row['tamil_meaning'] . "</td>";
            echo "<td width='15%'>" . $row['sinhala_meaning'] . "</td>";
            echo "<td width='12%'>" . $row['status'] . "</td>";
            echo "<td width='10%'>" . $row['suggested_date'] . "</td>";
            $term_id = $row['id'];
            $votes   = $row['votes'];
            echo "<td width='7%'><a href='votesofsugg.php?err=$term.$tamil_meaning.$sinhala_meaning'>" . $votes . "</a></td>";
            echo "<td width='3%'><a href='updateSuggestionComment.php?lis=$term.$tamil_meaning.$sinhala_meaning.$votes.$term_id'>More</a></td>";
            echo "</tr>";
        }
    }
    echo "</table></div></form>";
} else {
    echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' class='table' align='left' style='border-collapse:collapse'>";
    echo "<tr><td>No New Suggestions</td></tr>";
    echo "</table>";
}
include("footer.php");
?>
 