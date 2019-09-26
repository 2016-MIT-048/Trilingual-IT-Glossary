<?php
session_start();
$email = $_SESSION['email'];
if (isset($_GET['letter'])) {
    $letter = $_GET['letter'];
}
include("header2.php");
if (isset($_SESSION['lang'])) {
    $lang  = $_SESSION['lang'];
    $query = "SELECT * FROM terms WHERE language='$lang' AND (term LIKE '$letter%') ORDER BY term ASC";
} else {
    $lower = strtolower($letter);
    $query = "SELECT * FROM terms WHERE term LIKE '$letter%' OR term LIKE '$lower%' ORDER BY term ASC";
}
$ids    = 0;
$result = mysqli_query($con, $query);
$ids    = "";
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
    echo "<input type='hidden' name='current_page' id='current_page' value='1'/><table bgcolor='#FFFFFF' width='100%' height='82' style='border-collapse:collapse' border='1' class='table' align='left'>";
    echo "<tr>
<th >Term</th>
<th>Tamil Meaning</th>
<th>Sinhala Meaning</th>
<th>Votes</th>
<th>More</th>
</tr>";
    if (!$result)
        echo "invalid";
    $all_ids = explode(",", $ids);
    for ($i = 0; $i < sizeof($all_ids); $i++) {
        $id       = $all_ids[$i];
        $resulttv = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $id . "'");
        if ($row = mysqli_fetch_array($resulttv, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td width='20%'>" . $row['term'];
            $term = $row['term'];
?>
<a onclick="sayIt('<?php
            echo $term;
?>','en')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>
<?php
            echo "</td>";
            $tam_mean = $row['tamil_meaning'];
            echo "<td width='35%'>" . $row['tamil_meaning'];
?>
<a onclick="sayIt('<?php
            echo $tam_mean;
?>','ta')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>
<?php
            echo "</td>";
            $sin_mean = $row['sinhala_meaning'];
            echo "<td width='35%'>" . $row['sinhala_meaning'];
?>
<a onclick="sayIt('<?php
            echo $sin_mean;
?>','si')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>
<?php
            echo "</td>";
            $term_nn_id = $row['id'];
            $votes      = $row['votes'];
            echo "<td width='7%'><a href='votes.php?err=$term.$tam_mean.$sin_mean'>" . $votes . "</a></td>";
            echo "<td width='3%'><a href='moredetails.php?li=$term.$tam_mean.$sin_mean.$votes.$term_nn_id'>More</a></td>";
            echo "</tr>";
        }
    }
    echo "</table></div></form>";
} else {
    echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' class='table' align='left' style='border-collapse:collapse'>";
    echo "<tr><td>No results for your search</td></tr>";
    echo "</table>";
}
include('footer.php');
?>