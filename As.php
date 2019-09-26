<?php
session_start();
$email = $_SESSION['email'];
if (isset($_GET['letter'])) {
    $letter = $_GET['letter'];
}
if (isset($_SESSION['languages'])) {
    $languagess = $_SESSION['languages'];
    $query      = "SELECT * FROM suggestions WHERE language='$languagess' AND (term LIKE '$letter%') ORDER BY term ASC";
} else {
    $query = "SELECT * FROM suggestions WHERE term LIKE '" . $letter . "%' ORDER BY term ASC";
}
include("headerforsuggestion.php");
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
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
    echo "<input type='hidden' name='current_page' id='current_page' value='1'/><table border='1' bgcolor='#FFFFFF' cellspacing='1' style='border-collapse:collapse' cellpadding='2'  align='left' width='100%'>
<tr>
<th>Term</th>
<th>Tamil Meaning</th>
<th>Sinhala Meaning</th>
<th>Suggested Meaning</th>
<th>Status</th>
<th>Suggested Date</th>
<th>Votes</th>
<th>More</th>
</tr>";
    $all_ids = explode(",", $ids);
    for ($i = 0; $i < 10; $i++) {
        $id       = $all_ids[$i];
        $resulttv = mysqli_query($con, "SELECT * FROM suggestions WHERE id='" . $id . "'");
        if ($row = mysqli_fetch_array($resulttv, MYSQLI_ASSOC)) {
            echo "<tr>";
            $term = $row['term'];
            echo "<td width='15%'>" . $row['term'] . "<input type='hidden' name='butt' value='$term'</td>";
            $sugg = $row['suggestion'];
            echo "<td width='20%'>" . $row['suggestion'] . "<input type='hidden' name='butt1' value='$sugg'</td>";
            echo "<td width='12%'>" . $row['status'] . "</td>";
            echo "<td width='10%'>" . $row['suggested_date'] . "</td>";
            $votes = $row['votes'];
            echo "<td width='7%'><a href='votesofsugg.php?err=$term.$sugg'>" . $votes . "</a></td>";
            echo "<td width='3%'><a href='updateSuggestionComment.php?lis=$term.$sugg.$votes'>More</a></td>";
            echo "</tr>";
        }
    }
    echo "</table></div></form>";
} else {
    echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' style='border-collapse:collapse' class='table' align='left'>";
    echo "<tr><td>No Suggestions for your Search</a></td></tr>";
    echo "</table>";
}
include("footer.php");
?>