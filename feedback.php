<?php
session_start();
$semail = $_SESSION['email'];
include("header2.php");
echo "<form action='insertfeedback.php' method='POST' name='form'>";
echo "<table border='0'  cellspacing='1' cellpadding='3'  align='left' width='100%' style='border-collapse:collapse'>";
echo "<tr></tr>";
echo "<tr ><td align='right'>";
echo "<font color='blue'>Add your feedback here :</font>";
echo "<input type='text' name='newfeedback' size='40' value=''>";
echo "<input name='submit' type='submit' value='Add feedback'  />";
echo " </td></tr>";
echo "</table>";
echo "</br>";
if (isset($_GET['empt'])) {
    $me = $_GET['empt'];
    echo "<font color='green'>$me</font>";
}
echo "</form>";
echo "<form action='#' method='POST' name='form'>";
$rem = '';
if (isset($_POST['delete'])) {
    $id  = $_GET['id'] + $_POST['current_feedback'] - 1;
    $rem = mysqli_query($con, "DELETE FROM user_feedback WHERE id='" . $id . "'");
    if ($rem) {
        $rem = "succ";
        echo '<font color="green">Successfully removed!</font>';
    }
    if (!$rem) {
        echo '<font color="red">Sorry,unable to remove!</font>';
    }
}
if (isset($_GET['id']) && $rem != "succ") {
    $getemail = mysqli_query($con, "SELECT * FROM user_feedback WHERE id='" . $_GET['id'] . "'");
    if ($r_f = mysqli_fetch_array($getemail, MYSQLI_ASSOC)) {
        $email = $r_f['email'];
    }
    $que = mysqli_query($con, "SELECT * FROM user_feedback WHERE id='" . $_GET['id'] . "'");
    if (mysqli_num_rows($que) > 0) {
        echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' style='border-collapse:collapse' class='table' align='left'><tr><td width='15%'>feedback:</td><td width='85%' colspan='2'>";
        if ($row = mysqli_fetch_array($que, MYSQLI_ASSOC)) {
            echo "<div id='feedback'><input type='hidden' name='current_feedback' id='current_feedback' value='1'/><table bgcolor='#FFFFFF' width='100%'><tr><td colspan='2'>" . $row['feedback'] . "</td></tr><tr><td>";
            if (mysqli_num_rows($que) > 1) {
            }
            echo "</td><td>";
            if (mysqli_num_rows($que) > 0) {
                $resultut = mysqli_query($con, "SELECT * FROM system_user WHERE email='" . $semail . "' ");
                if ($resultut) {
                    if ($rowut = mysqli_fetch_array($resultut, MYSQLI_ASSOC)) {
                        $user_type = $rowut['user_type'];
                    }
                }
                if ($user_type == "Admin") {
                    echo "<input type='submit' name='delete' class='delete' value=''/>";
                } else if ($semail == $email) {
                    echo "<input type='submit' name='delete' class='delete' value=''/>";
                }
            }
            echo "</td></tr></table>";
        }
        echo "</div></td></tr></table>";
    }
}
//working part
if (!isset($_GET['id']) || (isset($_GET['id']) && $rem == "succ")) {
    $result = mysqli_query($con, "SELECT * FROM user_feedback ");
    if (mysqli_num_rows($result) == 0) {
        echo '<font color="red">Sorry,there is no feedback</font>';
    }
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellspacing='1' cellpadding='2'  align='left' width='100%' style='border-collapse:collapse'>";
        echo "<tr bgcolor='#FFFFFF'>
<th>Date</th>
<th>Feedback</th>
</tr>";
        if (!$result)
            echo "invalid";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td width='5%'>" . $row['date'] . "</td>";
            echo "<td width='30%'>" . $row['feedback'] . "</td>";
            echo "<td width='3%'>";
			//compare two string -> strcmp
            if (strcmp($row['email'], $_SESSION['email']) == 0) {
                echo "<a href='feedback.php?id=" . $row['id'] . "'>More</a>";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
echo "</form>";
include('footer.php');
?>
