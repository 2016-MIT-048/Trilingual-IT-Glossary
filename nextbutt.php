<?php
$tot_rows = mysqli_num_rows($result);
echo "<br/><table style='background-image:url(page_back.gif)'><tr><td>";
echo "</td><td>";
if ($tot_rows % 10 > 0) {
    $tot_rows = ($tot_rows - $tot_rows % 10) + 10;
}
for ($j = 1; $j <= $tot_rows / 10 && $j <= 10; $j++) {
    if ($j == 1) {
        echo "<font color='red'>" . $j . "</font>&nbsp";
    } else {
        echo "<font color='blue'>" . $j . "</font>&nbsp";
    }
}
echo "</td><td>";
echo "<input type='button' class='next' name='next' id='$ids' onclick='getTable_view(this.name,this.id)'/>";
echo "</td></tr></table>";
?>