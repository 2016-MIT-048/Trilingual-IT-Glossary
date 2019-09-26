<?php
session_start();
$email = $_SESSION['email'];
$key   = '';
if (isset($_GET['visugg'])) {
    $key = $_GET['visugg'];
}
if ($_POST['Search']) {
    $key = $_POST['h_key'];
}
if (isset($_GET['viaddglo'])) {
    $key = $_GET['viaddglo'];
}
$query = "SELECT * FROM terms WHERE term LIKE '%$key%' OR tamil_meaning LIKE '%$key%' OR sinhala_meaning LIKE '%$key%' ORDER BY votes DESC";
include('header2.php');
$result = mysqli_query($con, $query);
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
<th>Term</th>
<th>Tamil Meaning</th>
<th>Sinhala Meaning</th>
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
            echo "<td width='20%'>" . $row['term'];
            $term = $row['term'];
?>
<a onclick="sayIt('<?php
            echo $term;
?>','en')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>
<?php
            echo "</td>";
            $term     = $row['term'];
            $sin_mean = $row['sinhala_meaning'];
            $tam_mean = $row['tamil_meaning'];
            echo "<td width='35%'>" . $row['tamil_meaning'];
?>
<a onclick="sayIt('<?php
            echo $tam_mean;
?>','ta')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>
<?php
            echo "</td>";
            echo "<td width='35%'>" . $row['sinhala_meaning'];
?>
<a onclick="sayIt('<?php
            echo $sin_mean;
?>','si')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>
<?php
            echo "</td>";
            $votes   = $row['votes'];
            $term_id = $row['id'];
            echo "<td width='7%'><a href='votes.php?tid=" . $row['id'] . "'>" . $votes . "</a></td>";
            echo "<td width='3%'><a href='moredetails.php?li=$term.$sin_mean.$tam_mean.$votes.$term_id'>More</a></td>";
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
