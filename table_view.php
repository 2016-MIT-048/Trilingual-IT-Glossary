<?php
if (!isset($_SESSION)) {
    session_start();
}
$n    = $_GET["q"];
$hint = "";
$all  = explode("_", $n);
$q    = $all[0];
if ($all[1] == "back") {
    $q = $q - 1;
}
if ($all[1] == "next") {
    $q = $q + 1;
}
include_once 'databaseconnection.php';
if ($n != "") {
    $ids      = $all[2];
    $all_ids  = explode(",", $ids);
    $t_ind    = count($all_ids) - 1;
    $table    = $all_ids[$t_ind];
    $result   = mysqli_query($con, "SELECT * FROM " . $table . " WHERE 1 ORDER BY term ASC");
    $ids      = "";
    $tot_rows = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if (empty($ids)) {
            $ids = $row['id'];
        } else {
            $ids = $ids . "," . $row['id'];
        }
    }
    $ids = $ids . "," . $table;
    if (mysqli_num_rows($result) > 10) {
        $hint = $hint . "<br/><table style='background-image:url(page_back.gif)'><tr><td>";
        if (($q - 1) * 10 - 1 > 0) {
            $hint = $hint . "<input type='button' class='back' id='$ids' name='back' onclick='getTable_view(this.name,this.id)'/>";
        }
        $hint = $hint . "</td><td>";
        if ($tot_rows % 10 > 0) {
            $tot_rows = ($tot_rows - $tot_rows % 10) + 10;
        }
        $j = (($q - 1) - ($q - 1) % 10) + 1;
        $n = $j;
        while ($j < $n + 10 && $j <= $tot_rows / 10) {
            if ($j == $q) {
                $hint = $hint . "<font color='red'>" . $j . "</font>&nbsp";
            } else {
                $hint = $hint . "<font color='blue'>" . $j . "</font>&nbsp";
            }
            $j++;
        }
        $hint = $hint . "</td><td>";
        if ($q * 10 <= $t_ind + 1) {
            $hint = $hint . "<input type='button' class='next' name='next' id='$ids' onclick='getTable_view(this.name,this.id)'/>";
        }
        $hint = $hint . "</td></tr></table>";
    }
    if (($q - 1) * 10 <= $t_ind + 1) {
        $hint = $hint . "<input type='hidden' name='current_page' id='current_page' value='$q'/><table bgcolor='#FFFFFF' width='100%' height='82' style='border-collapse:collapse' border='1' class='table' align='left'>
<tr>
<th>Term</th>
<th>Tamil Meaning</th>
<th>Sinhala Meaning</th>
<th>Votes</th>
<th>More</th>
</tr>";
    }
    if (!$result)
        $hint = $hint . "invalid";
    for ($i = $q * 10 - 10; $i < $q * 10 && $i < count($all_ids); $i++) {
        $id       = $all_ids[$i];
        $resulttv = mysqli_query($con, "SELECT * FROM " . $table . " WHERE id='" . $id . "'");
        if ($row = mysqli_fetch_array($resulttv, MYSQLI_ASSOC)) {
            $term     = $row['term'];
            $tam_mean = $row['tamil_meaning'];
            $sin_mean = $row['sinhala_meaning'];
            $hint     = $hint . "<tr>";
            $hint     = $hint . "<td width='20%'>" . $term;
            $hint     = $hint . '<a onClick="sayIt(\'' . $term . '\', \'en\')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>';
            $hint     = $hint . "</td>";
            $hint     = $hint . "<td width='35%'>" . $tam_mean;
            $hint     = $hint . '<a onClick="sayIt(\'' . $tam_mean . '\', \'ta\')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>';
            $hint     = $hint . "</td>";
            $hint     = $hint . "<td width='35%'>" . $sin_mean;
            $hint     = $hint . '<a onClick="sayIt(\'' . $sin_mean . '\', \'si\')" style="float:right"><img src="images/speaker.png" height="20" width="20"/></a>';
            $hint     = $hint . "</td>";
            $votes    = $row['votes'];
            $term_id  = $row['id'];
            if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
                $hint = $hint . "<td width='7%'><a href='votes.php?tid=" . $row['id'] . "'>" . $votes . "</a></td>";
                $hint = $hint . "<td width='3%'><a href='moredetails.php?li=$term.$sin_mean.$tam_mean.$votes.$term_id'>More</a></td>";
            } else {
                $hint = $hint . "<td width='10%'>" . $votes . "</td>";
                $hint = $hint . "<td width='3%'><a href='moreForHome1.php?lih1=$term.$tam_mean.$sin_mean'>More</a></td>";
            }
            $hint = $hint . "</tr>";
        }
    }
}
if (($q - 1) * 10 >= $t_ind + 1) {
    $hint = $hint .= "<font color='red'>No results for your search!</font>";
}
if (($q - 1) * 10 - 1 <= $all_ids[$t_ind - 1]) {
    $hint = $hint . "</table>";
}
if ($hint == "") {
    $response = "<font color='red'>No results for your search!</font>";
} else {
    $response = $hint;
}
echo $response;
?>