<?php
include('header2.php');
if (isset($_GET['tid'])) {
    $term_id = $_GET['tid'];
}
$term     = "";
$term_id  = "";
$resulttv = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $term_id . "'");
if ($row = mysqli_fetch_array($resulttv, MYSQLI_ASSOC)) {
    $term = $row['term'];
}
echo "<table width='30%' height='82' border='0'  align='center'>";
echo "<th colspan='3'>People Who like the term " . $term . " are..</th>";
$resultlike = mysqli_query($con, "SELECT * FROM liketable where term_id='" . $term_id . "'");
while ($row = mysqli_fetch_array($resultlike, MYSQLI_ASSOC)) {
    echo "<tr>";
    $email    = $row['email'];
    $result22 = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "' ");
    while ($row = mysqli_fetch_array($result22, MYSQLI_ASSOC)) {
        echo "<td width='15%'><font color='blue'>" . $row['first_name'] . "</font></td>";
        echo "<td width='15%'><font color='blue'>" . $row['last_name'] . "</font></td>";
        echo "<td width='15%'><font color='blue'>" . $email . "</font></td>";
    }
    echo "</tr>";
}
echo "</table>";
include("footer.php");
?>