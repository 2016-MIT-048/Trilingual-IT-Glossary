<?php
include('headerforsuggestion.php');
if (isset($_GET['err'])) {
    $word1 = $_GET['err'];
}
//explode()- breaks a string into an array
$arrr            = explode('.', $word1);
$term            = $arrr[0];
$tamil_meaning   = $arrr[1];
$sinhala_meaning = $arrr[2];
$result          = mysqli_query($con, "SELECT * FROM suggestions where term='" . $term . "' and tamil_meaning='" . $tamil_meaning . "' and sinhala_meaning='" . $sinhala_meaning . "' ");
echo "<form name='form'><div id='table_view'>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if (empty($ids)) {
        $ids = $row['id'];
    } else {
        $ids = $ids . "," . $row['id'];
    }
}
$ids = $ids . ",suggestions";
if (mysqli_num_rows($result) > 10) {
    include_once 'nextbutt.php';
}
if (!$result)
    echo "invalid";
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
    for ($i = 0; $i < 10; $i++) {
        $id       = $all_ids[$i];
        $resulttv = mysqli_query($con, "SELECT * FROM suggestions WHERE id='" . $id . "'");
        if ($row = mysqli_fetch_array($resulttv, MYSQLI_ASSOC)) {
            echo "<tr>";
            $term            = $row['term'];
            $tamil_meaning   = $row['tamil_meaning'];
            $sinhala_meaning = $row['sinhala_meaning'];
            echo "<td width='15%'>" . $row['term'] . "<input type='hidden' name='butt' value='$term'></td>";
            echo "<td width='15%'>" . $row['tamil_meaning'] . "<input type='hidden' name='butt1' value='$tamil_meaning'></td>";
            echo "<td width='15%'>" . $row['sinhala_meaning'] . "<input type='hidden' name='butt2' value='$sinhala_meaning'></td>";
            echo "<td width='12%'>" . $row['status'] . "</td>";
            echo "<td width='10%'>" . $row['suggested_date'] . "</td>";
            $votes = $row['votes'];
            echo "<td width='7%'><a href='votesofsugg.php?err=$term.$tamil_meaning.$sinhala_meaning'>" . $votes . "</a></td>";
            echo "<td width='3%'><a href='updateSuggestionComment.php?lis=$term.$tamil_meaning.$sinhala_meaning.$votes'>More</a></td>";
            echo "</tr>";
        }
    }
    echo "</table></div></form>";
}
echo "<table width='40%' height='82' border='0'  align='center'>";
echo "<th>People who like this</th>";
$resultlike = mysqli_query($con, "SELECT * FROM likesuggestion where  term='" . $term . "' AND tamil_meaning='" . $tamil_meaning . "' AND sinhala_meaning='" . $sinhala_meaning . "' ");
while ($row = mysqli_fetch_array($resultlike, MYSQLI_ASSOC)) {
    echo "<tr>";
	//$vuemail findout the voted user mail address
    $vuemail  = $row['email'];
    $result22 = mysqli_query($con, "SELECT * FROM user WHERE email='" . $vuemail . "' ");
    while ($row = mysqli_fetch_array($result22, MYSQLI_ASSOC)) {
        $username = $row['first_name'];
    }
    echo "<td width='15%'><font color='blue'>$username</font></td>";
    echo "</tr>";
}
echo "</table>";
include("footer.php");
?>
           