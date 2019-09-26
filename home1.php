<?php
include('header1.php');
$result = mysqli_query($con, "SELECT * FROM terms WHERE 1 ORDER BY term ASC");
$ids    = 0;
while ($row = mysqli_fetch_assoc($result)) {
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
    echo "<input type='hidden' name='current_page' id='current_page' value='1'/><table bgcolor='#FFFFFF' width='100%' height='82' style='border-collapse:collapse' border='1' class='table' align='left'>
<tr>
<th>Term</th>
<th>Tamil Meaning</th>
<th>Sinhala Meaning</th>
<th>Votes</th>
<th>More</th>
</tr>";
    if (!$result)
        echo "invalid";
    $all_ids = explode(",", $ids);
    $count   = count($all_ids);
    if (count($all_ids) > 10) {
        $count = 10;
    }
    for ($i = 0; $i < $count; $i++) {
        $id       = $all_ids[$i];
        $resulttv = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $id . "'");
        if ($row = mysqli_fetch_assoc($resulttv)) {
            echo "<tr>";
            $term = $row['term'];
            echo "<td width='20%'>" . $row['term'] . "<input type='hidden' name='butt' value='$term'/>";
?>
<a onclick="sayIt('<?php
            echo $term;
?>','en')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>
<?php
            echo "</td>";
            $term_id  = $row['id'];
            $tam_mean = $row['tamil_meaning'];
            echo "<td width='35%'>" . $row['tamil_meaning'] . "<input type='hidden' name='butt1' value='$tam_mean'/>";
?>
<a onclick="sayIt('<?php
            echo $tam_mean;
?>','ta')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>
<?php
            echo "</td>";
            $sin_mean = $row['sinhala_meaning'];
            echo "<td width='35%'>" . $row['sinhala_meaning'] . "<input type='hidden' name='butt2' value='$sin_mean'/>";
?>
<a onclick="sayIt('<?php
            echo $sin_mean;
?>','si')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>
<?php
            echo "</td>";
            $votes = $row['votes'];
            if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
                echo "<td width='7%'><a href='votes.php?tid=" . $row['id'] . "'>" . $votes . "</a></td>";
                echo "<td width='3%'><a href='moredetails.php?li=$term.$sin_mean.$tam_mean.$votes.$term_id'>More</a></td>";
            } else {
                echo "<td width='10%'>" . $votes . "</td>";
                echo "<td width='3%'><a href='moreForHome1.php?lih1=$term.$tam_mean.$sin_mean'>More</a></td>";
            }
            echo "</tr>";
        }
    }
    echo "</table></div></form>";
}
include('footer1.php');
?>